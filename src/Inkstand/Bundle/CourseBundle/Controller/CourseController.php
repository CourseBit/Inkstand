<?php

namespace Inkstand\Bundle\CourseBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use Inkstand\Bundle\CourseBundle\Entity\Course;

/**
 * inkstand_course_index  /course
 * inkstand_course_view   /course/view/{slug}
 * inkstand_course_add    /course/add/{categoryId}
 * inkstand_course_manage /course/manage
 */
class CourseController extends Controller
{
	/**
	 * Course index page
	 *
	 * @Route("/course", name="inkstand_course_index")
	 * @Template
	 */
	public function indexAction()
	{
		return $this->forward('InkstandCourseBundle:Course:list');
	}

	/**
	 * View a course
	 *
	 * @Route("/course/view/{slug}", name="inkstand_course_view")
     * @Template
     * @param mixed $slug Either the course_id or course_slug
     * @return array
     */
	public function viewAction($slug)
	{
		$course = $this->get('course_service')->findOneBySlug($slug);

		if(is_null($course)) {
            throw new NotFoundHttpException($this->get('translator')->trans('course.notfound'));
        }

		if(!$this->get('enrollment_service')->isUserEnrolled($this->getUser(), $course)) {
			return $this->forward('InkstandCourseBundle:Course:enroll', array('courseId' => $course->getCourseId()));
		}

        // TODO: Use an activity type service
		$activityTypes = $this->getDoctrine()
			->getRepository('InkstandCourseBundle:ActivityType')
		    ->findAll();

		return array(
			'course' => $course,
			'activityTypes' => $activityTypes,
			'pageHeading' => $course->getName()
		);
	}

	/**
	 * @Route("/course/list", name="inkstand_course_list")
	 * @Template
	 */
	public function listAction()
	{
		$courses = $this->get('course_service')->findAll();

	    return array(
	    	'courses' => $courses,
            'pageHeading' => ''
	    );
	}

    /**
     * Add a course
     *
     * @Route("/course/add/{categoryId}", name="inkstand_course_add", defaults={"categoryId" = null})
     * @Template
     * @param Request $request
     * @param int $categoryId
     * @return array
     */
	public function addAction(Request $request, $categoryId)
	{
		$course = new Course();

		// If route has categoryId, set that category on the course so it defaults in the form
		if(!empty($categoryId)) {
			$courseCategory = $this->get('course_category_service')->findOneByCategoryId($categoryId);
		    $course->setCategoryId($courseCategory->getCategoryId());
		}

		$courseForm = $this->createForm('course', $course, array(
			'action' => $this->generateUrl('inkstand_course_add'),
			'method' => 'POST'
		));

		$courseForm->handleRequest($request);

		if($courseForm->isValid()) {

			// Add category entity to course
			$courseCategory = $this->get('course_category_service')->findOneByCategoryId($course->getCategoryId());

		    $course->setCategory($courseCategory);

			$em = $this->getDoctrine()->getManager();
			$em->persist($course);
			$em->flush();

			$session = $request->getSession();
	        $session->getFlashBag()->add('success', $this->get('translator')->trans('course.added', array('%name%' => $course->getName())));

	        return $this->redirect($this->generateUrl('inkstand_course_view', array('slug' => $course->getSlug())));
	    }

		return array(
			'courseForm' => $courseForm->createView(),
			'pageHeading' => $this->get('translator')->trans('course.form.add')
		);
	}

	/**
	 * Edit existing course
	 *
	 * @Route("/course/edit/{courseId}", name="inkstand_course_edit")
	 * @Template
     * @param Request $request
     * @param int $courseId ID of course to edit
     * @return array
	 */
	public function editAction(Request $request, $courseId)
	{
		$course = $this->get('course_service')->findOneByCourseId($courseId);

	    if($course === null) {
	    	throw new NotFoundHttpException($this->get('translator')->trans('course.notfound'));
	    }

		$courseForm = $this->createForm('course', $course, array(
			'action' => $this->generateUrl('inkstand_course_edit', array('courseId' => $courseId)),
			'method' => 'POST'
		));

		$courseForm->handleRequest($request);

        // TODO: Check if the cancel button was clicked

		if($courseForm->isValid()) {
			$em = $this->getDoctrine()->getManager();
			$em->persist($course);
			$em->flush();

			$session = $request->getSession();
	        $session->getFlashBag()->add('success', $this->get('translator')->trans('course.edited', array('%name%' => $course->getName())));

	        return $this->redirect($this->generateUrl('inkstand_course_view', array('slug' => $course->getSlug())));
	    }

		return array(
            'course' => $course,
			'courseForm' => $courseForm->createView(),
			'pageHeading' => $course->getName()
		);
	}

    /**
     * Delete a course
     *
     * @Route("/course/delete/{courseId}", name="inkstand_course_delete")
     * @param int $courseId ID of course to delete
     * @return array
     */
	public function deleteAction($courseId)
    {
        $request = $this->getRequest();

        $course = $this->getDoctrine()
            ->getRepository('InkstandCourseBundle:Course')
            ->findOneByCourseId($courseId);

        if (empty($course)) {
            throw new NotFoundHttpException($this->get('translator')->trans('course.notfound'));
        }

        $deleteForm = $this->createFormBuilder()
            ->add('delete', 'submit', array(
                'label' => $this->get('translator')->trans('course.form.delete'),
            ))
            ->add('cancel', 'submit', array(
                'label' => $this->get('translator')->trans('button.cancel'),
            ))
            ->getForm();

        if ($this->getRequest()->isMethod('POST')) {

            $deleteForm->handleRequest($request);

            if ($deleteForm->get('delete')->isClicked()) {
                $em = $this->getDoctrine()->getManager();
                $em->remove($course);
                $em->flush();

                $session = $this->getRequest()->getSession();
                $session->getFlashBag()->add('success', $this->get('translator')->trans('course.deleted', array('%name%' => $course->getName())));

                // TODO: Where should this redirect since course is deleted?
                return $this->redirect($this->generateUrl('inkstand_home'));
            }
        }

        return array(
            'course' => $course,
            'deleteForm' => $deleteForm->createView()
        );
    }

	/**
	 * @Route("/course/manage", name="inkstand_course_manage")
	 * @Template
	 */
	public function manageAction()
	{
		return array();
	}

	/**
	 * Display options for enrolling into a course
	 *
	 * @Route("/course/enroll/{courseId}", name="inkstand_course_enroll")
	 * @Template
	 * @param Request $request
	 * @param int $courseId ID of course to enroll
	 * @return array
	 */
    public function enrollAction(Request $request, $courseId)
	{
		$course = $this->get('course_service')->findOneByCourseId($courseId);

		if (is_null($course)) {
			throw new NotFoundHttpException($this->get('translator')->trans('course.notfound'));
		}



		return array(
			'course' => $course
		);
	}
}
