<?php

namespace Inkstand\Bundle\UserBundle\Controller;

use Inkstand\Bundle\CoreBundle\Controller\Controller;
use Inkstand\Bundle\UserBundle\Entity\Organization;
use Inkstand\Bundle\UserBundle\Form\Type\OrganizationType;
use Inkstand\Bundle\UserBundle\Model\OrganizationInterface;
use Inkstand\Bundle\UserBundle\Model\OrganizationManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

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

            return $this->redirect($this->generateUrl('inkstand_user_organization_index'));
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
        $organization = $this->get('inkstand_user.organization_manager')->findOneByOrganizationId($organizationId);

        if($organization === null) {
            throw new NotFoundHttpException('Organization not found.');
        }

        $organizationForm = $this->createForm(new OrganizationType(), $organization, array(
            'action' => $this->generateUrl('inkstand_user_organization_edit', array('organizationId' => $organizationId)),
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

            return $this->redirect($this->generateUrl('inkstand_user_organization_index'));
        }

        return array(
            'organizationForm' => $organizationForm->createView()
        );
    }

    /**
     * @Route("/user/organization/delete/{organizationId}", name="inkstand_user_organization_delete")
     * @Template
     * @param integer $organizationId
     * @return array
     */
    public function deleteAction($organizationId)
    {
        /** @var OrganizationInterface $organization */
        $organization = $this->get('inkstand_user.organization_manager')->findOneByOrganizationId($organizationId);

        if($organization === null) {
            throw new NotFoundHttpException('Organization not found.');
        }

        $this->denyAccessUnlessGranted('delete', $organization);

        $formBuilder = $this->createFormBuilder();

        if(count($organization->getChildren()) > 0) {
            $formBuilder->add('reassignId', 'entity', array(
                'class' => 'Inkstand\Bundle\UserBundle\Entity\Organization',
                'property' => 'name',
                'placeholder' => 'Don\'t reassign',
                'label' => 'Reassign users'
            ));
            $formBuilder->add('deleteUsers', 'choice', array(
                'choices' => array('1' => 'Yes', '0' => 'No'),
                'expanded' => true,
                'data' => '0',
                'label' => 'Delete users'
            ));
        }

        $formBuilder->add('submit', 'submit', array(
            'label' => 'Delete',
            'attr' => array(
                'class' => 'btn btn-danger'
            )
        ));

        return array(
            'organization' => $organization,
            'organizationDeleteForm' => $formBuilder->getForm()->createView()
        );
    }

    /**
     * Display list of Organizations User has access to
     *
     * @Route("/user/organization", name="inkstand_user_organization_index")
     * @Template
     */
    public function indexAction()
    {
        $this->denyAccessUnlessGranted('view', new Organization());

        /** @var OrganizationManagerInterface $organizationManager */
        $organizationManager = $this->get('inkstand_user.organization_manager');
        $organizations = $organizationManager->findMyOrganizations($this->getUser());

        return array(
            'organizations' => $organizations,
            'newOrganization' => new Organization()
        );
    }
}