<?php

namespace Inkstand\Bundle\CourseBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * Class EnrollmentController
 *
 * Routes:
 * inkstand_course_enroll /course/enroll/{courseId}
 *
 * @package Inkstand\Bundle\CourseBundle\Controller
 */
class EnrollmentController extends Controller
{
    /**
     * @Route("/course/enroll/{courseId}", name="inkstand_course_enroll")
     * @Template
     */
	public function enrollAction($courseId)
    {
        $course = $this->get('course_service')->findOneByCourseId($courseId);

        return array(
            'course' => $course
        );
    }
}