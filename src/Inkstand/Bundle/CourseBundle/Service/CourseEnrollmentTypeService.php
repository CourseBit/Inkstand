<?php

namespace Inkstand\Bundle\CourseBundle\Service;

class CourseEnrollmentTypeService
{
    protected $entityManager;
    protected $repository;

    public function __construct($entityManager)
    {
        $this->entityManager = $entityManager;
        $this->repository = $this->entityManager->getRepository('InkstandCourseBundle:CourseEnrollmentType');
    }

    /**
     * @param $courseEnrollmentTypeId
     * @return mixed
     */
    public function findOneByCourseEnrollmentTypeId($courseEnrollmentTypeId)
    {
        return $this->repository->findOneByCourseEnrollmentTypeId($courseEnrollmentTypeId);
    }
}