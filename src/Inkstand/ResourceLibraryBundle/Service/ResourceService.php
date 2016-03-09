<?php

namespace Inkstand\ResourceLibraryBundle\Service;

class ResourceService
{
    private $entityManager;
    private $resourceRepository;

    public function __construct($entityManager)
    {
        $this->entityManager = $entityManager;
        $this->resourceRepository = $this->entityManager->getRepository('InkstandResourceLibraryBundle:Resource');
    }

    /**
     * Return all Resources
     *
     * @return array|null
     */
    public function findAll()
    {
        return $this->resourceRepository->findAll();
    }

    public function findBy($criteria)
    {
        return $this->resourceRepository->findBy($criteria);
    }

    public function findOneByResourceId($resourceId)
    {
        return $this->resourceRepository->findOneByResourceId($resourceId, array('name' => 'DESC'));
    }
}