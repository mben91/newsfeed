<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {

        $auth_checker = $this->get('security.authorization_checker');
        # e.g: $auth_checker->isGranted('ROLE_ADMIN');

        // Get our Token (representing the currently logged in user)
        $token = $this->get('security.token_storage')->getToken();

        // Get our user from that token
        $user = $token->getUser();

        print_r($user);die;

        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', array(
            'base_dir' => realpath($this->container->getParameter('kernel.root_dir').'/..').DIRECTORY_SEPARATOR,
        ));
    }
}
