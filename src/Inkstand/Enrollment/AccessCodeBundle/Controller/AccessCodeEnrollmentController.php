<?php

namespace Inkstand\Enrollment\AccessCodeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class AccessCodeEnrollmentController extends Controller
{
    public function enrollPageAction(Request $request, $course)
    {
        $accessCodeForm = $this->getAccessCodeForm($course->getCourseId());

        return $this->render('InkstandAccessCodeBundle:AccessCodeEnrollment:enroll_page.html.twig', array(
            'accessCodeForm' => $accessCodeForm->createView()
        ));
    }

    /**
     * @Route("/submit", name="inkstand_access_code_submit")
     * @param Request $request
     */
    public function submitAction(Request $request)
    {
        $accessCodeForm = $this->getAccessCodeForm();
        $accessCodeForm->handleRequest($request);

        $courseId = $accessCodeForm->get('courseId')->getData();
        $course = $this->get('course_service')->findOneByCourseId($courseId);

        // If code was correct...
        $this->get('enrollment_service')->enrollUser($this->getUser(), $course, 'accessCode');
        return $this->redirect($this->generateUrl('inkstand_course_view', array('slug' => $course->getSlug())));
    }

    /**
     * @param $courseId
     * @return object
     */
    public function getAccessCodeForm($courseId = null)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('inkstand_access_code_submit'))
            ->add('courseId', 'hidden', array(
                'data' => $courseId
            ))
            ->add('accessCode', 'text', array(
                'label' => 'accesscode'
            ))
            ->add('submit', 'submit', array(
                'label' => 'enrollment.enroll',
                'attr' => array(
                    'class' => 'btn btn-default'
                )
            ))
            ->getForm();
    }
}