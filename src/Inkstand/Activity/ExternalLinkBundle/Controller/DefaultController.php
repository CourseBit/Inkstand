<?php

namespace Inkstand\Activity\ExternalLinkBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('InkstandExternalLinkBundle:Default:index.html.twig', array('name' => $name));
    }
}
