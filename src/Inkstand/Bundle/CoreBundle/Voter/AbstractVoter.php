<?php

namespace Inkstand\Bundle\CoreBundle\Voter;

use Inkstand\Bundle\CoreBundle\Service\RoleServiceInterface;
use Symfony\Component\Intl\Exception\NotImplementedException;
use Symfony\Component\Security\Core\Authorization\Voter\AbstractVoter as BaseVoter;

/**
 * Class AbstractVoter
 * @package Inkstand\Bundle\CoreBundle\Voter
 */
abstract class AbstractVoter extends BaseVoter
{
    /**
     * @var RoleServiceInterface
     */
    private $roleService;

    /**
     * @param RoleServiceInterface $roleService
     */
    public function __construct(RoleServiceInterface $roleService)
    {
        $this->roleService = $roleService;
    }

    /**
     * @return RoleServiceInterface
     */
    public function getRoleService()
    {
        return $this->roleService;
    }

    /**
     * Capture call from BaseVoter to first check if user has permission via roles. Then call abstract method for
     * evaluating custom granted logic.
     *
     * @param string $attribute
     * @param object $course
     * @param null $user
     * @return bool
     */
    protected function isGranted($attribute, $object, $user = null)
    {
        // First check if user has permission
        if(!$this->getRoleService()->isUserGranted($user, $attribute, $this)) {
            return false;
        }

        return $this->isUserGranted($attribute, $object, $user);
    }

    /**
     * @throws \Exception
     */
    public function getSupportedAttributes()
    {
        throw new NotImplementedException('Must declare getSupportedAttributes() method in voter.');
    }

    /**
     * @return mixed
     */
    public abstract function getDefaultRoleAssignments();

    /**
     * @param $attribute
     * @param $object
     * @param $user
     * @return bool
     */
    protected abstract function isUserGranted($attribute, $object, $user);
}