<?php

namespace Inkstand\Library\TagBundle\Voter;

use Inkstand\Bundle\CoreBundle\Entity\Role;
use Inkstand\Bundle\CoreBundle\Voter\AbstractVoter;
use Symfony\Component\Security\Core\User\UserInterface;

class TagVoter extends AbstractVoter
{
    const ADD = 'add';
    const EDIT = 'edit';
    const DELETE = 'delete';

    public function getSupportedAttributes()
    {
        return array(self::ADD, self::EDIT, self::DELETE);
    }

    public function getDefaultRoleAssignments()
    {
        return array(
            self::ADD => 'ROLE_ADMIN',
            self::EDIT => 'ROLE_ADMIN',
            self::DELETE => 'ROLE_ADMIN'
        );
    }

    protected function getSupportedClasses()
    {
        return array('Inkstand\Library\TagBundle\Model\Tag');
    }

    protected function isUserGranted($attribute, $course, $user = null)
    {
        return true;
    }
}