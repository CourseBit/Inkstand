<?php

namespace Inkstand\Bundle\CourseBundle\Service;

use Inkstand\Bundle\CourseBundle\Entity\EnrollmentType;
use Inkstand\Bundle\CourseBundle\Service\Enrollment\AbstractEnrollmentService;

class EnrollmentTypeService
{
    protected $entityManager;
    protected $repository;
    protected $serviceContainer;

    public function __construct($entityManager, $serviceContainer)
    {
        $this->entityManager = $entityManager;
        $this->repository = $this->entityManager->getRepository('InkstandCourseBundle:EnrollmentType');
        $this->serviceContainer = $serviceContainer;
    }

    public function findAll()
    {
        return $this->repository->findAll();
    }

    /**
     * Grabs the service for the specified EnrollmentType
     *
     * @param EnrollmentType $enrollmentType
     * @return AbstractEnrollmentService
     * @throws \Exception
     */
    public function getServiceForEnrollmentType(EnrollmentType $enrollmentType)
    {
        $enrollmentService = $this->serviceContainer->get(sprintf('enrollment.%s.service', $enrollmentType->getName()));
        if(!is_a($enrollmentService, 'Inkstand\Bundle\CourseBundle\Service\AbstractEnrollmentService')) {
            throw new \Exception(sprintf('Invalid enrollment service. %s must extend Inkstand\Bundle\CourseBundle\Service\AbstractEnrollmentService', get_class($enrollmentService)));
        }
        return $this->serviceContainer->get(sprintf('enrollment.%s.service', $enrollmentType->getName()));
    }
}