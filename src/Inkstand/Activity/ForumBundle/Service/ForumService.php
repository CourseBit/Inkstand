<?php

namespace Inkstand\Activity\ForumBundle\Service;

use Inkstand\Activity\ForumBundle\Entity\Forum;
use Inkstand\Activity\ForumBundle\Entity\ForumPreferences;

class ForumService
{
    protected $entityManager;
    protected $repository;

    public function __construct($entityManager)
    {
        $this->entityManager = $entityManager;
        $this->repository = $this->entityManager->getRepository('InkstandCourseBundle:Course');
    }

    public function getNewEntity()
    {
        return new Forum();
    }

    public function getNewPreferences()
    {
        return new ForumPreferences();
    }
}