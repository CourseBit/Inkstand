<?php

namespace Inkstand\Bundle\CourseBundle\Service;

class ActivityTypeService
{
    protected $entityManager;
    protected $repository;

    /**
     * This is populated by a CompilerPass and contains all the ActivityType service IDs
     *
     * @var array
     */
    private $activityTypeServiceIds = array();

    public function __construct($entityManager)
    {
        $this->entityManager = $entityManager;
        $this->repository = $this->entityManager->getRepository('InkstandCourseBundle:ActivityType');
    }

    /**
     * This method is called by a CompilerPass. Do not call this method directly.
     *
     * @param string $serviceId
     */
    public function addActivityType($serviceId)
    {
        $this->activityTypeServiceIds[] = $serviceId;
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