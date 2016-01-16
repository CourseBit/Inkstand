<?php

namespace Inkstand\EnrollmentBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class SelfEnrollmentController extends Controller
{
    public function enrollPageAction(Request $request, $course)
    {
        $selfEnrollmentForm = $this->getSelfEnrollmentForm($course);

        return $this->render('InkstandEnrollmentBundle:SelfEnrollment:enroll_page.html.twig', array(
            'selfEnrollmentForm' => $selfEnrollmentForm->createView(),
            'course' => $course
        ));
    }

    /**
     * @Route("/submit", name="inkstand_enrollment_self_submit")
     * @param Request $request
     * @return null
     */
    public function submitAction(Request $request)
    {
        $selfEnrollmentForm = $this->getSelfEnrollmentForm();
        $selfEnrollmentForm->handleRequest($request);

        $courseId = $selfEnrollmentForm->get('courseId')->getData();
        $course = $this->get('course_service')->findOneByCourseId($courseId);

        $this->get('enrollment_service')->enrollUser($this->getUser(), $course, 'self');
        return $this->redirect($this->generateUrl('inkstand_course_view', array('slug' => $course->getSlug())));
    }

    /**
     * @param $course
     * @return object
     */
    public function getSelfEnrollmentForm($course = null)
    {
        $courseId = !empty($course) ? $course->getCourseId() : '';
        $courseName = !empty($course) ? $course->getName() : '';

        return $this->createFormBuilder()
            ->setAction($this->generateUrl('inkstand_enrollment_self_submit'))
            ->add('courseId', 'hidden', array(
                'data' => $courseId
            ))
            ->add('submit', 'submit', array(
                'label' => 'Enroll into ' . $courseName,
                'attr' => array(
                    'class' => 'btn btn-default'
                )
            ))
            ->getForm();
    }
}