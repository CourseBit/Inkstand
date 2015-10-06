<?php

namespace Inkstand\Bundle\CoreBundle\Controller;

use Inkstand\Bundle\CoreBundle\Controller\Controller;
use Inkstand\Bundle\CoreBundle\Entity\Role;
use Inkstand\Bundle\CoreBundle\Entity\VoterActionRoleAssignment;
use Inkstand\Bundle\CoreBundle\Form\Type\VoterActionRoleAssignmentType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class RoleController extends Controller
{
    /**
     * @Route("/role", name="inkstand_core_role_list")
     * @Template()
     */
    public function listAction()
    {
        $this->setContext(CONTEXT_SYSTEM, null, true);

        $roles = $this->get('inkstand_core.role')->findAll();

        return array(
            'roles' => $roles
        );
    }

    /**
     * @Route("/role/edit/{roleId}", name="inkstand_core_role_edit")
     * @Template()
     */
    public function editAction(Request $request, $roleId)
    {
        if(is_null($role = $this->get('inkstand_core.role')->findOneByRoleId($roleId))) {
            throw new NotFoundHttpException($this->get('translator')->trans('role.notfound'));
        }

        $voterActions = $this->get('inkstand_core.voter_action')->findAll();

        foreach($role->getVoterActionRoleAssignments() as $voterActionRoleAssignment) {
            unset($voterActions[$voterActionRoleAssignment->getVoterActionId()]);
        }

        foreach($voterActions as $voterAction) {
            $voterActionRoleAssignment = new VoterActionRoleAssignment();
            $voterActionRoleAssignment->setVoterActionId($voterAction->getVoterActionId());
            $voterActionRoleAssignment->setVoterAction($voterAction);
            $voterActionRoleAssignment->setRoleId($role->getRoleId());
            $voterActionRoleAssignment->setRole($role);
            $voterActionRoleAssignment->setAllow(Role::ROLE_ACTION_INHERIT);
            $role->addVoterActionRoleAssignment($voterActionRoleAssignment);
        }

        $roleForm = $this->createFormBuilder($role)
            ->add('name', 'text', array())
            ->add('label', 'text')
            ->add('description', 'text')
            ->add('voterActionRoleAssignments', 'collection', array('type' => new VoterActionRoleAssignmentType()))
            ->add('submit', 'submit', array('label' => 'role.edit.submit', 'attr' => array('class' => 'btn btn-primary')))
            ->getForm();

        $roleForm->handleRequest($request);

        if($roleForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($role);
            $em->flush();

            $session = $request->getSession();
            $session->getFlashBag()->add('success', $this->get('translator')->trans('role.edited', array('%name%' => $role->getName())));

            return $this->redirect($this->generateUrl('inkstand_core_role_edit', array('roleId' => $role->getRoleId())));
        }

        return array(
            'roleForm' => $roleForm->createView()
        );
    }
}