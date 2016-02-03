<?php

namespace Inkstand\Bundle\UserBundle\Controller;

use Inkstand\Bundle\CoreBundle\Controller\Controller;
use Inkstand\Bundle\UserBundle\Entity\Organization;
use Inkstand\Bundle\UserBundle\Form\Type\OrganizationType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;

class OrganizationController extends Controller
{
    /**
     * @Route("/user/organization/add", name="inkstand_user_organization_add")
     * @Template
     * @param Request $request
     * @param $categoryId
     * @return array|\Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function addAction(Request $request)
    {
        $organization = new Organization();

        $this->denyAccessUnlessGranted('add', $organization);

        $organizationForm = $this->createForm(new OrganizationType(), $organization, array(
            'action' => $this->generateUrl('inkstand_user_organization_add'),
            'method' => 'POST'
        ));

        $organizationForm->handleRequest($request);

        if($organizationForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($organization);
            $em->flush();

            $session = $request->getSession();
            $session->getFlashBag()->add('success', 'Organization added.');

            return $this->redirect($this->generateUrl('inkstand_user_organization_list'));
        }

        return array(
            'organizationForm' => $organizationForm->createView(),
        );
    }

    /**
     * @Route("/user/organization/edit/{organizationId}", name="inkstand_user_organization_edit")
     * @Template
     * @param Request $request
     * @param integer $organizationId
     * @return array|\Symfony\Component\HttpFoundation\RedirectResponse
     * @throws NotFoundHttpException
     */
    public function editAction(Request $request, $organizationId)
    {
        $organization = $this->get('inkstand_user.organization')->findOneByOrganizationId($organizationId);

        if($organization === null) {
            throw new NotFoundHttpException('Organization not found.');
        }

        $organizationForm = $this->createForm(new OrganizationType(), $organization, array(
            'action' => $this->generateUrl('inkstand_user_organization_edit', array('organization' => $organizationId)),
            'method' => 'POST'
        ));

        $organizationForm->handleRequest($request);

        // TODO: Check if the cancel button was clicked

        if($organizationForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($organization);
            $em->flush();

            $session = $request->getSession();
            $session->getFlashBag()->add('success', 'Organization edited.');

            return $this->redirect($this->generateUrl('inkstand_user_organization_list'));
        }

        return array(
            'organizationForm' => $organizationForm->createView()
        );
    }
}