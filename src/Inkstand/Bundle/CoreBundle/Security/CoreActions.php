<?php

namespace Inkstand\Bundle\CoreBundle\Security;

class CoreActions
{
    public function getActions()
    {
        return array(
            'coreActions' => array(
                'test_action' => array('defaultRoles' => array('ROLE_ADMIN'))
            )
        );
    }
}