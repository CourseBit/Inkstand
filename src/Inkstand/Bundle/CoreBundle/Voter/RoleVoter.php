<?php

namespace Inkstand\Bundle\CoreBundle\Voter;

use Inkstand\Bundle\CoreBundle\Voter\AbstractVoter;
use Symfony\Component\Security\Core\User\UserInterface;

class RoleVoter extends AbstractVoter
{
    const ADD = 'add';
    const VIEW = 'view';
    const EDIT = 'edit';
    const DELETE = 'delete';

    public function getSupportedAttributes()
    {
        return array(self::ADD, self::VIEW, self::EDIT, self::DELETE);
    }

    public function getDefaultRoleAssignments()
    {
        return array(
            self::ADD => 'ROLE_ADMIN',
            self::VIEW => 'ROLE_STUDENT',
            self::EDIT => 'ROLE_ADMIN',
            self::DELETE => 'ROLE_ADMIN'
        );
    }

    protected function getSupportedClasses()
    {
        return array('Inkstand\Bundle\CoreBundle\Entity\Role');
    }

    protected function isUserGranted($attribute, $role, $user = null)
    {
        $user->getRoles();

        foreach($user->getRoles() as $roleName) {
            if($this->isRoleGranted($roleName, $attribute)) {
                return true;
            }
        }

        return false;
    }

    protected function isRoleGranted($roleName, $actionName)
    {
        return $this->voterService->isRoleGranted($roleName, get_class($this), $actionName);
    }
}