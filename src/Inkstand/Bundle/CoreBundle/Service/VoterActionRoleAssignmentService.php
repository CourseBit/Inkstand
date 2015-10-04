<?php

namespace Inkstand\Bundle\CoreBundle\Service;

class VoterActionRoleAssignmentService
{
    protected $entityManager;
    protected $repository;

    public function __construct($entityManager)
    {
        $this->entityManager = $entityManager;
        $this->repository = $this->entityManager->getRepository('InkstandCoreBundle:VoterActionRoleAssignment');
    }

    public function hasRoleWithAction($roleId, $voterActionId)
    {
        return !empty($this->repository->findOneBy(array('roleId' => $roleId, 'voterActionId' => $voterActionId)));
    }
}