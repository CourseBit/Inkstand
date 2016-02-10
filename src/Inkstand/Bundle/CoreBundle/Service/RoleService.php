<?php

namespace Inkstand\Bundle\CoreBundle\Service;

use Inkstand\Bundle\CoreBundle\Entity\Role;
use Inkstand\Bundle\CoreBundle\Entity\VoterActionRoleAssignment;
use Symfony\Component\Security\Core\Authorization\Voter\VoterInterface;
use FOS\UserBundle\Model\UserInterface;

class RoleService implements RoleServiceInterface
{
    protected $entityManager;
    protected $repository;

    public function __construct($entityManager)
    {
        $this->entityManager = $entityManager;
        $this->repository = $entityManager->getRepository('InkstandCoreBundle:Role');
    }

    public function findAll($toArray = false)
    {
        return $this->repository->findAll($toArray);
    }

    public function findOneByRoleId($roleId)
    {
        return $this->repository->findOneByRoleId($roleId);
    }

    public function findOneByName($name)
    {
        return $this->repository->findOneByName($name);
    }

    public function findAllCached()
    {
        if(empty($this->cachedRoleData)) {
            $this->cachedRoleData = $this->repository->findAllCached();
        }

        return $this->cachedRoleData;
    }

    /**
     * Clear cached role results
     */
    public function clearCache()
    {
        $cacheDriver = $this->entityManager->getConfiguration()->getResultCacheImpl();
        $cacheDriver->delete('role_data');
    }

    /**
     * Check if any user role is granted to perform action
     *
     * @param UserInterface $user
     * @param $attribute
     * @param VoterInterface $voter
     * @throws \Exception
     * @return bool
     */
    public function isUserGranted(UserInterface $user, $attribute, VoterInterface $voter)
    {
        $granted = false;
        foreach($user->getUserRoles() as $userRole) {
            if($this->isRoleGranted($userRole, $attribute, $voter)) {
                $granted = true;
            }
        }
        return $granted;
    }

    /**
     * Check if a role is granted to perform an action.
     *
     * This recursively checks parent roles until a role is either denied or allowed, allowing for inheritance.
     *
     * @param Role $role
     * @param $attribute
     * @param VoterInterface $voter
     * @throws \Exception
     * @throws \LogicException
     * @return bool
     */
    public function isRoleGranted(Role $role, $attribute, VoterInterface $voter)
    {
        /** @var Role $cachedRole */

        $cachedRoles = $this->findAllCached();
        if(empty($cachedRoles)) {
            throw new \Exception('Cached roles are missing.');
        }

        if(!array_key_exists($role->getRoleId(), $cachedRoles)) {
            throw new \LogicException('Role missing from cached role data. Did you forget to clear role cache?');
        }

        $cachedRole = $cachedRoles[$role->getRoleId()];

        /** @var VoterActionRoleAssignment $roleAssignment */
        foreach($cachedRole->getVoterActionRoleAssignments() as $roleAssignment) {
            if ($roleAssignment->getVoterAction()->getVoter()->getClassName() != get_class($voter)) {
                continue;
            }

            if ($roleAssignment->getVoterAction()->getName() != $attribute) {
                continue;
            }

            if ($roleAssignment->getAllow() == Role::ROLE_ACTION_INHERIT) {
                if(null !== $cachedRole->getParent()) {
                    return $this->isRoleGranted($cachedRole->getParent(), $attribute, $voter);
                } else {
                    return false;
                }
            } elseif ($roleAssignment->getAllow() == Role::ROLE_ACTION_ALLOW) {
                return true;
            } elseif ($roleAssignment->getAllow() == Role::ROLE_ACTION_FORBID) {
                return false;
            }
        }
    }
}