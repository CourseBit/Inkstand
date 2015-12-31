<?php

namespace Inkstand\Bundle\CoreBundle\Service;

class FileReferenceService
{
    protected $entityManager;
    protected $repository;

    public function __construct($entityManager)
    {
        $this->entityManager = $entityManager;
        $this->repository = $this->entityManager->getRepository('InkstandCoreBundle:FileReference');
    }

    public function findAll()
    {
        return $this->repository->findAll();
    }

    public function findOneByFileReferenceId($fileReferenceId)
    {
        return $this->repository->findOneByFileReferenceId($fileReferenceId);
    }
}
