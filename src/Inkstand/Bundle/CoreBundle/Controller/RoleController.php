<?php

namespace Inkstand\Bundle\CoreBundle\Controller;

use Inkstand\Bundle\CoreBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class RoleController extends Controller
{
    /**
     * @Route("/role", name="inkstand_core_role_list")
     * @Template()
     */
    public function listAction()
    {
        $this->setContext(CONTEXT_SYSTEM, null, true);

        $roles = array(
            array('name' => 'ROLE_ADMIN'),
            array('name' => 'ROLE_STUDENT'),
            array('name' => 'ROLE_MENTOR'),
        );

        return array(
            'roles' => $roles
        );
    }

    /**
     *
     */
    public function editAction()
    {

    }
}