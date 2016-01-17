<?php

namespace Inkstand\Bundle\CoreBundle\Service;

use FOS\UserBundle\Model\UserInterface;
use Inkstand\Bundle\CoreBundle\Entity\Role;
use Symfony\Component\Security\Core\Authorization\Voter\VoterInterface;

interface RoleServiceInterface
{
    public function findAll($toArray = false);
    public function findOneByRoleId($roleId);
    public function findOneByName($name);
    public function findAllCached();
    public function isUserGranted(UserInterface $user, $attribute, VoterInterface $voter);
    public function isRoleGranted(Role $role, $attribute, VoterInterface $voter);
}