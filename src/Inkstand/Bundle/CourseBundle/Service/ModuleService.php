<?php

namespace Inkstand\Bundle\CourseBundle\Service;

class ModuleService
{
    protected $entityManager;
    protected $repository;

    public function __construct($entityManager)
    {
        $this->entityManager = $entityManager;
        $this->repository = $this->entityManager->getRepository('InkstandCourseBundle:Module');
    }

    /**
     * @param $moduleId
     * @return mixed
     */
    public function findOneByModuleId($moduleId)
    {
        return $this->repository->findOneByModuleId($moduleId);
    }
}