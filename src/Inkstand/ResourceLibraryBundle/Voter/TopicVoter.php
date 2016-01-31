<?php

namespace Inkstand\ResourceLibraryBundle\Voter;

use Inkstand\Bundle\CoreBundle\Entity\Role;
use Inkstand\Bundle\CoreBundle\Voter\AbstractVoter;
use Symfony\Component\Security\Core\User\UserInterface;

class TopicVoter extends AbstractVoter
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
            self::ADD => 'ROLE_CONTENT_MANAGER',
            self::VIEW => 'ROLE_STUDENT',
            self::EDIT => 'ROLE_CONTENT_MANAGER',
            self::DELETE => 'ROLE_CONTENT_MANAGER'
        );
    }

    protected function getSupportedClasses()
    {
        return array('Inkstand\ResourceLibraryBundle\Entity\Topic');
    }

    protected function isUserGranted($attribute, $course, $user = null)
    {
        return true;
    }
}