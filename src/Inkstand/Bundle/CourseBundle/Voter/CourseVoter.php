<?php

namespace Inkstand\Bundle\CourseBundle\Voter;

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

    protected function isGranted($attribute, $course, $user = null)
    {
        $user->getRoles();

        switch($attribute) {
            case self::ADD:

                break;

            case self::VIEW:
                break;

            case self::EDIT:
                // this assumes that the data object has a getOwner() method
                // to get the entity of the user who owns this data object
                if ($user->getId() === $post->getOwner()->getId()) {
                    return true;
                }

                break;

            case self::DELETE:

                break;
        }

        return false;
    }

    protected function isRoleGranted($role, $action)
    {

    }
}