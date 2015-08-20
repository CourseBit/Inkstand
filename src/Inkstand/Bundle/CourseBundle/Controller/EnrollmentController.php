<?php

namespace Inkstand\Bundle\CourseBundle\Controller;

use Inkstand\Bundle\CourseBundle\Entity\Course;
use Inkstand\Bundle\CourseBundle\Entity\CourseEnrollmentType;
use Inkstand\Bundle\CourseBundle\Entity\Enrollment;
use Inkstand\Bundle\CourseBundle\Event\EnrollmentEvent;
use Inkstand\Bundle\CourseBundle\Form\Type\CourseEnrollmentTypeType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
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
     * @param Request $request
     * @param integer $courseId ID of course to configure enrollment
     * @return array
     */
    public function enrollmentAction(Request $request, $courseId)
    {
        $course = $this->get('course_service')->findOneByCourseId($courseId);

        // TODO: Optimize this and make it look pretty
        $enrollmentTypes = $this->get('enrollment_type_service')->findAll();
        $currentEnrollments = $course->getCourseEnrollmentTypes();
        foreach($currentEnrollments as $currentEnrollment) {
            foreach($enrollmentTypes as $key => $enrollmentType) {
                if($enrollmentType->getEnrollmentTypeId() == $currentEnrollment->getEnrollmentTypeId()) {
                    unset($enrollmentTypes[$key]);
                }
            }
        }
        foreach($enrollmentTypes as $enrollmentType) {
            $newCourseEnrollmenType = new CourseEnrollmentType();
            $newCourseEnrollmenType->setCourseId($course->getCourseId());
            $newCourseEnrollmenType->setCourse($course);
            $newCourseEnrollmenType->setEnrollmentTypeId($enrollmentType->getEnrollmentTypeId());
            $newCourseEnrollmenType->setEnrollmentType($enrollmentType);
            $newCourseEnrollmenType->setEnabled(0);
            $course->addCourseEnrollmentType($newCourseEnrollmenType);
        }

        // Persist new CourseEnrollmentType's that weren't already in the database
        $em = $this->getDoctrine()->getManager();
        $em->persist($course);
        $em->flush();

        $form = $this->createFormBuilder($course)
            ->add('courseEnrollmentTypes', 'collection', array('type' => new CourseEnrollmentTypeType()))
            ->add('save', 'submit', array(
                'label' => 'button.save',
                'attr' => array(
                    'class' => 'btn btn-primary'
                )
            ))
            ->getForm();

        $form->handleRequest($request);

        if($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($course);
            $em->flush();

            $session = $request->getSession();
            $session->getFlashBag()->add('success', $this->get('translator')->trans('enrollment.edited', array('%name%' => $course->getName())));

            return $this->redirect($this->generateUrl('inkstand_course_enrollment', array('courseId' => $course->getCourseId())));
        }

        return array(
            'form' => $form->createView(),
            //'enrollmentTypes' => $enrollmentTypes,
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