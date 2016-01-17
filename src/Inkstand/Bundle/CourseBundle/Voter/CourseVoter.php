<?php

namespace Inkstand\Bundle\CourseBundle\Voter;

use Inkstand\Bundle\CoreBundle\Entity\Role;
use Inkstand\Bundle\CoreBundle\Voter\AbstractVoter;
use Symfony\Component\Security\Core\User\UserInterface;

class CourseVoter extends AbstractVoter
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
        return array('Inkstand\Bundle\CourseBundle\Entity\Course');
    }

    protected function isUserGranted($attribute, $course, $user = null)
    {
        switch($attribute) {
            case self::ADD:
                break;

            case self::VIEW:
                return true;
                break;

            case self::EDIT:
                break;

            case self::DELETE:
                break;
        }

        return false;
    }
}