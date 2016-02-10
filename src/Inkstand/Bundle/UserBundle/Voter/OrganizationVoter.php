<?php

namespace Inkstand\Bundle\UserBundle\Voter;

use Inkstand\Bundle\CoreBundle\Entity\Role;
use Inkstand\Bundle\CoreBundle\Voter\AbstractVoter;
use Symfony\Component\Security\Core\User\UserInterface;

class OrganizationVoter extends AbstractVoter
{
    const ADD = 'add';
    const VIEW = 'view';
    const EDIT = 'edit';
    const DELETE = 'delete';
    const ADD_USER = 'add_user';

    public function getSupportedAttributes()
    {
        return array(self::ADD, self::VIEW, self::EDIT, self::DELETE, self::ADD_USER);
    }

    public function getDefaultRoleAssignments()
    {
        return array(
            self::ADD => 'ROLE_ADMIN',
            self::VIEW => 'ROLE_STUDENT',
            self::EDIT => 'ROLE_ADMIN',
            self::DELETE => 'ROLE_ADMIN',
            self::ADD_USER => 'ROLE_ADMIN'
        );
    }

    protected function getSupportedClasses()
    {
        return array('Inkstand\Bundle\UserBundle\Entity\Organization');
    }

    protected function isUserGranted($attribute, $course, $user = null)
    {
        switch($attribute) {
            case self::VIEW:
            break;
        }

        return true;
    }
}