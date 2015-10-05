<?php

namespace Inkstand\Bundle\CoreBundle\Service;

class RoleService
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
}