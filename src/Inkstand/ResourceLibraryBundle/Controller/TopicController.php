<?php

namespace Inkstand\ResourceLibraryBundle\Controller;

use Inkstand\Bundle\CoreBundle\Controller\Controller;
use Inkstand\ResourceLibraryBundle\Entity\Topic;
use Inkstand\ResourceLibraryBundle\Form\Type\TopicType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;

class TopicController extends Controller
{
    /**
     * @Route("/library/topic/add", name="inkstand_resource_library_topic_add")
     * @Template
     */
    public function addAction(Request $request)
    {
        $topic = new Topic();

        $this->denyAccessUnlessGranted('add', $topic);

        $topicForm = $this->createForm(new TopicType(), $topic, array(
            'action' => $this->generateUrl('inkstand_resource_library_topic_add'),
            'method' => 'POST'
        ));

        $topicForm->handleRequest($request);

        if ($topicForm->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $em->persist($topic);
            $em->flush();

            $session = $request->getSession();
            $session->getFlashBag()->add('success', $this->get('translator')->trans('course.added', array('%name%' => $topic->getName())));

            return $this->redirect($this->generateUrl('inkstand_resource_library_index'));
        }

        return array(
            'topicForm' => $topicForm->createView()
        );
    }

    /**
     * @Route("/library/topic/view/{topicId}", name="inkstand_resource_library_topic_view")
     * @Template
     * @param Request $request
     * @param $topicId
     */
    public function viewAction(Request $request, $topicId)
    {

    }
}