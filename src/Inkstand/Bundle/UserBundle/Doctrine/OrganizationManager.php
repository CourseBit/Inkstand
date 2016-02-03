<?php

namespace Inkstand\Bundle\UserBundle\Doctrine;

use Doctrine\ORM\EntityManager;
use Inkstand\Bundle\UserBundle\Entity\Organization;
use Inkstand\Bundle\UserBundle\Model\OrganizationInterface;
use Inkstand\Bundle\UserBundle\Model\OrganizationManager as BaseOrganizationManager;

class OrganizationManager extends BaseOrganizationManager
{
    protected $entityManager;
    protected $class;
    protected $repository;

    public function __construct(EntityManager $entityManager, $class)
    {
        $this->entityManager = $entityManager;
        $this->repository = $entityManager->getRepository($class);

        $metadata = $entityManager->getClassMetadata($class);
        $this->class = $metadata->getName();
    }

    public function findOrganizations()
    {
        return $this->repository->findAll();
    }
}