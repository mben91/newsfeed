<?php

use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Routing\Route;

$collection = new RouteCollection();

$collection->add('newsfeed_homepage', new Route('/', array(
    '_controller' => 'NewsfeedBundle:Default:index',
)));

return $collection;
