<?php

namespace Inkstand\Bundle\UserBundle\Voter;

use Inkstand\Bundle\CoreBundle\Voter\AbstractVoter;
use Symfony\Component\Security\Core\User\UserInterface;

class UserVoter extends AbstractVoter
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
        return array('Inkstand\Bundle\UserBundle\Entity\User');
    }

    protected function isUserGranted($attribute, $user, $user = null)
    {
        $user->getRoles();

        $isRollAllowed = false;

        foreach($user->getRoles() as $roleName) {
            if($this->isRoleGranted($roleName, $attribute)) {
                $isRollAllowed = true;
            }
        }

        if(!$isRollAllowed) {
            return false;
        }

        switch($attribute) {
            case self::ADD:

                break;

            case self::VIEW:
                break;

            case self::EDIT:
                return true;
                break;

            case self::DELETE:

                break;
        }

        return false;
    }

    protected function isRoleGranted($roleName, $actionName)
    {
        return $this->voterService->isRoleGranted($roleName, get_class($this), $actionName);
    }
}