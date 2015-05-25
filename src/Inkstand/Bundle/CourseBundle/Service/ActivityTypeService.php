<?php

namespace Inkstand\Bundle\CourseBundle\Service;

class ActivityTypeService
{
    protected $entityManager;
    protected $repository;

    public function __construct($entityManager)
    {
        $this->entityManager = $entityManager;
        $this->repository = $this->entityManager->getRepository('InkstandCourseBundle:ActivityType');
    }

    /**
     * @param $activityTypeId
     * @return mixed
     */
    public function findOneByActivityTypeId($activityTypeId)
    {
        return $this->repository->findOneByActivityTypeId($activityTypeId);
    }
}