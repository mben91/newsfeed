<?php

namespace NewsfeedBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {

        // $auth_checker = $this->get('security.authorization_checker');
        // # e.g: $auth_checker->isGranted('ROLE_ADMIN');
        //
        // // Get our Token (representing the currently logged in user)
        // $token = $this->get('security.token_storage')->getToken();
        // 
        // // Get our user from that token
        // $user = $token->getUser();
        //
        // print_r($user);die;

        return $this->render('NewsfeedBundle:Default:index.html.twig');
    }

}
