<?php

namespace Inkstand\ResourceLibraryBundle\Service;


use Inkstand\ResourceLibraryBundle\Entity\Topic;

class TopicService
{
    private $entityManager;
    private $topicRepository;

    public function __construct($entityManager)
    {
        $this->entityManager = $entityManager;
        $this->topicRepository = $this->entityManager->getRepository('InkstandResourceLibraryBundle:Topic');
    }

    /**
     * Return all Topics
     *
     * @return array|null
     */
    public function findAll()
    {
        return $this->topicRepository->findAll();
    }
}