<?php

namespace UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use FOS\UserBundle\Controller\RegistrationController as BaseController;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;

class RegistrationController extends Controller
{
    /**
     * @Route("/")
     */
    public function indexAction()
    {
        return $this->render('UserBundle:Registration:index.html.twig');
    }

    /**
     * @Route("/signup")
     */
     public function registerAction(Request $request)
     {
         $form = $this->container->get('fos_user.registration.form.factory');
         $formHandler = $this->container->get('fos_user.registration.form.type');
         $confirmationEnabled = $this->container->getParameter('fos_user.registration.confirmation.enabled');

         $process = $formHandler->process($confirmationEnabled);
         if ($process) {
             $user = $form->getData();

             /*****************************************************
              * Add new functionality (e.g. log the registration) *
              *****************************************************/
             $this->container->get('logger')->info(
                 sprintf('New user registration: %s', $user)
             );

             if ($confirmationEnabled) {
                 $this->container->get('session')->set('fos_user_send_confirmation_email/email', $user->getEmail());
                 $route = 'fos_user_registration_check_email';
             } else {
                 $this->authenticateUser($user);
                 $route = 'fos_user_registration_confirmed';
             }

             $this->setFlash('fos_user_success', 'registration.flash.user_created');
             $url = $this->container->get('router')->generate($route);

             return new RedirectResponse($url);
         }

         return $this->container->get('templating')->renderResponse('FOSUserBundle:Registration:register.html.twig', array(
             'form' => $form->createView(),
         ));
     }


}
