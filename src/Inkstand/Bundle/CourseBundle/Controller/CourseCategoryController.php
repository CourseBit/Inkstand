<?php

namespace Inkstand\Bundle\CourseBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class CourseCategoryController extends Controller
{
	/**
	 * View a list of course categories
	 *
	 * @Route("/category")
	 */
	public function indexAction() {

	}

	/**
	 * View a single course category
	 * 
	 * @param mixed $slug Required route parameter. Either the category_id or category_slug 
	 * @Route("/category/view{slug}")
	 */
	public function viewAction($slug) {

		$category = null;

		if(is_numeric($slug)) {
			// get category by category_id
			$category = $this->getDoctrine()
		        ->getRepository('InkstandCourseBundle:CourseCategory')
		        ->findOneByCategoryId($slug);
		} else {
			// get category by URL slug
			$category = $this->getDoctrine()
		        ->getRepository('InkstandCourseBundle:CourseCategory')
		        ->findOneBySlug($slug);
		}

		if($category === null) {
			throw $this->createNotFoundException($this->get('translator')->trans('Category not found'));
		}

		return $this->render('InkstandCourseBundle:CourseCategory:view.html.twig', array(
			'category' => $category,
			'pageHeader' => $category->getName()
		)); 
	}
}