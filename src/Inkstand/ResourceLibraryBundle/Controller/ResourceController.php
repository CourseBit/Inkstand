<?php

namespace Inkstand\ResourceLibraryBundle\Controller;

use Inkstand\Bundle\CoreBundle\Controller\Controller;
use Inkstand\ResourceLibraryBundle\Entity\Resource;
use Inkstand\ResourceLibraryBundle\Form\Type\ResourceType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;

class ResourceController extends Controller
{
    /**
     * @Route("/library/resource/add", name="inkstand_resource_library_resource_add")
     * @Template
     */
    public function addAction(Request $request)
    {
        $resource = new Resource();

        $this->denyAccessUnlessGranted('add', $resource);

        $resourceForm = $this->createForm(new ResourceType(), $resource, array(
            'action' => $this->generateUrl('inkstand_resource_library_resource_add'),
            'method' => 'POST'
        ));

        $resourceForm->handleRequest($request);

        if($resourceForm->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $em->persist($resource);
            $em->flush();

            $session = $request->getSession();
            $session->getFlashBag()->add('success', $this->get('translator')->trans('course.added', array('%name%' => $resource->getName())));

            return $this->redirect($this->generateUrl('inkstand_resource_library_index'));
        }

        return array(
            'resourceForm' => $resourceForm->createView()
        );
    }

    /**
     * @Route("/library/resource/edit/{resourceId}", name="inkstand_resource_library_resource_edit")
     * @Template
     */
    public function editAction(Request $request, $resourceId)
    {
        $resource = $this->get('inkstand_resource_library.resource')->findOneByResourceId($resourceId);

        if($resource === null) {
            throw new NotFoundHttpException('Resource not found.');
        }

        $resourceForm = $this->createForm(new ResourceType(), $resource, array(
            'action' => $this->generateUrl('inkstand_resource_library_resource_edit', array('resourceId' => $resourceId)),
            'method' => 'POST'
        ));

        $resourceForm->handleRequest($request);

        // TODO: Check if the cancel button was clicked

        if($resourceForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($resource);
            $em->flush();

            $session = $request->getSession();
            $session->getFlashBag()->add('success', $this->get('translator')->trans('course.edited', array('%name%' => $resource->getName())));

            return $this->redirect($this->generateUrl('inkstand_resource_library_index'));
        }

        return array(
            'resourceForm' => $resourceForm->createView()
        );
    }

    /**
     * @Route("/library/resource/delete", name="inkstand_resource_library_resource_delete")
     * @Template
     */
    public function deleteAction()
    {

    }

    /**
     * @Route("/library/resource/download", name="inkstand_resource_library_resource_download")
     * @Template
     */
    public function downloadAction()
    {

    }

    /**
     * Render single Resource
     *
     * @Template
     * @param Resource $resource
     * @return array
     */
    public function renderAction(Resource $resource)
    {
        return array(
            'resource' => $resource
        );
    }
}