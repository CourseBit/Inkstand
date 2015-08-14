<?php

namespace Inkstand\Bundle\CourseBundle\Controller;

use Inkstand\Bundle\CourseBundle\Entity\Enrollment;
use Inkstand\Bundle\CourseBundle\Event\EnrollmentEvent;
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
     * @Route("/course/enrollment/{courseId}", name="inkstand_course_enrollment")
     * @Template
     */
    public function enrollmentAction($courseId)
    {
        $course = $this->get('course_service')->findOneByCourseId($courseId);

        $enrollmentTypes = $this->get('enrollment_service')->getEnrollmentTypes();

        //dump($enrollmentTypes);

//        foreach($enrollmentTypes as $enrollmentType)
//        {
//            dump($this->get($enrollmentType)->getLabel());
//        }

        return array(
            'enrollmentTypes' => $enrollmentTypes,
            'course' => $course
        );
    }

    /**
     * @Route("/course/enroll/{courseId}", name="inkstand_course_enroll")
     * @Template
     */
	public function enrollAction($courseId)
    {
        $course = $this->get('course_service')->findOneByCourseId($courseId);

//        $enrollmentService = $this->get('enrollment_service');
//
//        $user = $this->getUser();
//
//        $enrollmentService->enrollUser($user,$course);


        $event = new EnrollmentEvent(new Enrollment());
        $eventDispatcher = $this->get('event_dispatcher');

//        $eventDispatcher->addListener('inkstand.course.enroll_pre', function() {
//           echo("here2");
//        });

        $eventDispatcher->dispatch('inkstand.course.enroll_pre', $event);

        return array(
            'course' => $course
        );
    }
}