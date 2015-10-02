<?php

namespace Inkstand\LrsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('InkstandLrsBundle:Default:index.html.twig', array('name' => $name));
    }
}
