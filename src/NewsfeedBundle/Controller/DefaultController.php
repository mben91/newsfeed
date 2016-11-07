<?php

namespace NewsfeedBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class DefaultController extends Controller
{
  /**
   * @Route("/", name="homepage")
   */
    public function indexAction()
    {
        return $this->render('NewsfeedBundle:Default:index.html.twig');
    }

}
