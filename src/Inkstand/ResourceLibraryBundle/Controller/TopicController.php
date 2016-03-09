<?php

namespace Inkstand\ResourceLibraryBundle\Controller;

use Inkstand\Bundle\CoreBundle\Controller\Controller;
use Inkstand\ResourceLibraryBundle\Entity\Topic;
use Inkstand\ResourceLibraryBundle\Form\Type\TopicType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class TopicController extends Controller
{
    /**
     * @Route("/library/topic", name="inkstand_resource_library_topic_index")
     * @Template
     * @param Request $request
     * @return array
     */
    public function indexAction(Request $request)
    {
        $topics = $this->get('inkstand_resource_library.topic')->findAll();

        return array(
            'topics' => $topics
        );
    }

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
     * @Route("/library/topic/edit/{topicId}", name="inkstand_resource_library_topic_edit")
     * @Template
     */
    public function editAction(Request $request, $topicId)
    {
        $topic = $this->get('inkstand_resource_library.topic')->findOneByTopicId($topicId);

        if($topic === null) {
            throw new NotFoundHttpException('Topic not found.');
        }

        $topicForm = $this->createForm(new TopicType(), $topic, array(
            'action' => $this->generateUrl('inkstand_resource_library_topic_edit', array('topicId' => $topicId)),
            'method' => 'POST'
        ));

        $topicForm->handleRequest($request);

        // TODO: Check if the cancel button was clicked

        if($topicForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($topic);
            $em->flush();

            $session = $request->getSession();
            $session->getFlashBag()->add('success', $this->get('translator')->trans('course.edited', array('%name%' => $topic->getName())));

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
     * @return array
     */
    public function viewAction(Request $request, $topicId)
    {
        $topic = $this->get('inkstand_resource_library.topic')->findOneByTopicId($topicId);
        $resources = $this->get('inkstand_resource_library.resource')->findBy(array('topicId' => $topic->getTopicId()));

        if(null === $topic) {
            throw new NotFoundHttpException('Topic not found.');
        }

        return array(
            'topic' => $topic,
            'resources' => $resources
        );
    }
}