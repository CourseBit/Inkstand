<?php

namespace Inkstand\Activity\ForumBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * /forum/discussion/view/{slug} 
 */
class ForumDiscussionController extends Controller
{
	/**
	 * @Route("/forum/discussion/view/{slug}", name="inkstand_forum_discussion_view")
	 * @param mixed $slug Discussion slug or ID 
	 */
	public function viewAction($slug)
	{


		return $this->render('InkstandForumBundle:ForumDiscussion:view.html.twig', array());
	}
}