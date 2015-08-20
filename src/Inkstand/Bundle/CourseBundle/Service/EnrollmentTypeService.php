<?php

namespace Inkstand\Bundle\CourseBundle\Service;


class EnrollmentTypeService
{
    protected $entityManager;
    protected $repository;

    public function __construct($entityManager)
    {
        $this->entityManager = $entityManager;
        $this->repository = $this->entityManager->getRepository('InkstandCourseBundle:EnrollmentType');
    }

    public function findAll()
    {
        return $this->repository->findAll();
    }
}