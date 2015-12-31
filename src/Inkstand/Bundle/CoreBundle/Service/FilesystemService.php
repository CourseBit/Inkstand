<?php

namespace Inkstand\Bundle\CoreBundle\Service;

class FilesystemService
{
    protected $entityManager;
    protected $repository;

    public function __construct($entityManager)
    {
        $this->entityManager = $entityManager;
        $this->repository = $this->entityManager->getRepository('InkstandCoreBundle:Filesystem');
    }

    public function findAll()
    {
        return $this->repository->findAll();
    }
}
