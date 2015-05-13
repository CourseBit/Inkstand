<?php

namespace Inkstand\Activity\ExternalLinkBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class ExternalLinkController extends Controller
{
	public function viewAction($activity) 
	{
		die("Viewing external link");
	}
}