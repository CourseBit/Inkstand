<?php

namespace Inkstand\Bundle\CoreBundle\Service;

class VoterActionService
{
    protected $entityManager;
    protected $repository;

    public function __construct($entityManager)
    {
        $this->entityManager = $entityManager;
        $this->repository = $this->entityManager->getRepository('InkstandCourseBundle:VoterAction');
    }
}