<?php

namespace Inkstand\ResourceLibraryBundle\Service;


use Inkstand\ResourceLibraryBundle\Entity\Topic;
use Inkstand\ResourceLibraryBundle\Model\TopicInterface;

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

    /**
     * @param int $state
     * @return mixed
     */
    public function findAllShownInLibrary($state = TopicInterface::STATE_PUBLISHED)
    {
        return $this->topicRepository->findBy(array('showInLibrary' => 1, 'state' => $state));
    }

    /**
     * @return mixed
     */
    public function findAllPublished()
    {
        return $this->topicRepository->findBy(array('state' => TopicInterface::STATE_PUBLISHED));
    }

    public function findOneByTopicId($topic)
    {
        return $this->topicRepository->findOneByTopicId($topic);
    }
}