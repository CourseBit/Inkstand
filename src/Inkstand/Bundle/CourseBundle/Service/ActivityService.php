<?php

namespace Inkstand\Bundle\CourseBundle\Service;

class ActivityService
{
    protected $entityManager;
    protected $repository;

    public function __construct($entityManager)
    {
        $this->entityManager = $entityManager;
        $this->repository = $this->entityManager->getRepository('InkstandCourseBundle:Activity');
    }

    /**
     * Find one activity by the activity slug. Slug can also be the activity ID
     *
     * @param $slug
     * @return mixed
     */
    public function findOneBySlug($slug)
    {
        if(is_numeric($slug)) {
            // Lookup activity by activityId
            return $this->repository->findOneByActivityId($slug);
        } else {
            // Lookup activity by slug
            return $this->repository->findOneBySlug($slug);
        }
    }

    /**
     * @param $activityId
     * @return mixed
     */
    public function findOneByActivityId($activityId)
    {
        return $this->repository->findOneByActivityId($activityId);
    }
}