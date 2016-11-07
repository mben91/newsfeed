<?php

namespace UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use UserBundle\Form\RegistrationFormType;
use UserBundle\Entity\User;

class RegistrationController extends Controller
{
    /**
     * @Route("/signup", name="signup")
     */
     public function registerAction(Request $request)
    {
        $em  = $this->getDoctrine()->getManager();
        $user = new User();
        $form = $this->createForm(RegistrationFormType::class, $user, array(
            'action' => $this->generateUrl('signup'),
            'method' => 'POST',
        ));

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $userData = $form->getData();
            $checkEmail = $this->getDoctrine()->getRepository('UserBundle:User')->findOneByEmail( $userData->getEmail() );
            if ($checkEmail) {
              $this->addFlash('error', 'Genus created!');
              return $this->redirectToRoute('signup');

            }
            $em->persist($userData);
            $em->flush();
            return $this->redirectToRoute('task_success');
        }
         return $this->render('UserBundle:Registration:signup.html.twig', array(
             'form' => $form->createView(),
         ));

    }

}
