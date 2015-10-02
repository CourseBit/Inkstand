<?php

namespace Inkstand\Bundle\CoreBundle\Service;


class ContextRoleAssignmentService
{

    protected $entityManager;
    protected $repository;

    public function __construct($entityManager)
    {
        $this->entityManager = $entityManager;
        $this->repository = $this->entityManager->getRepository('InkstandCoreBundle:ContextRoleAssignment');
    }

    public function getUserRoleAssignments($userId, $contextId)
    {
        return $this->repository->findBy(array('userId' => $userId, 'contextId' => $contextId));
    }
}