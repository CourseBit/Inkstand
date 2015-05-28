<?php

namespace Inkstand\Bundle\CourseBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use Inkstand\Bundle\CourseBundle\Entity\Course;

/**
 * inkstand_course_catalog_index  /course/catalog
 */
class CourseCatalogController extends Controller
{
	/**
	 * @Route("/course/catalog/{categoryId}", name="inkstand_course_catalog_index", defaults={"categoryId" = null})
	 * @Template
	 */
	public function indexAction($categoryId)
	{
		$categories = null;
		$category = null;

		if(empty($categoryId)) {
			$categories = $this->get('course_category_service')->findAll();

			// return array(
			// 	'categories' => $categories
			// );
		} else {
			$category = $this->get('course_category_service')->findOneByCategoryId($categoryId);

			// return array(
			// 	'category' => $category
			// );
		}

		return array(
			'categories' => $categories,
			'category' => $category
		);
	}
}