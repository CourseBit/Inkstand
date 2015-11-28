<?php

namespace Inkstand\Bundle\CourseBundle\Service;

use Inkstand\Bundle\CourseBundle\Entity\EnrollmentType;
use Inkstand\Bundle\CourseBundle\Service\Enrollment\AbstractEnrollmentService;

class EnrollmentTypeService
{
    protected $entityManager;
    protected $repository;
    protected $serviceContainer;

    /**
     * This is populated by a CompilerPass and contains all the EnrollmentType service IDs
     *
     * @var array
     */
    private $enrollmentTypeServiceIds = array();

    public function __construct($entityManager, $serviceContainer)
    {
        $this->entityManager = $entityManager;
        $this->repository = $this->entityManager->getRepository('InkstandCourseBundle:EnrollmentType');
        $this->serviceContainer = $serviceContainer;
    }

    /**
     * This method is called by a CompilerPass. Do not call this method directly.
     *
     * @param string $enrollmentTypeServiceId
     */
    public function addEnrollmentType($enrollmentTypeServiceId)
    {
        $this->enrollmentTypeServiceIds[] = $enrollmentTypeServiceId;
    }

    public function findAll()
    {
        return $this->repository->findAll();
    }

    public function updateEnrollmentTypes($verbose = false)
    {
        $existingEnrollmentTypes = $this->findAll();

        foreach($this->enrollmentTypeServiceIds as $enrollmentTypeServiceId) {
            if(!$this->serviceContainer->has($enrollmentTypeServiceId)) {
                throw new \Exception(sprintf('EnrollmentType service %s not found.', $enrollmentTypeServiceId));
            }

            $enrollmentTypeService = $this->serviceContainer->get($enrollmentTypeServiceId);

            $enrollmentType = null;

            foreach($existingEnrollmentTypes as $existingEnrollmentType) {
                if($existingEnrollmentType->getService() == $enrollmentTypeServiceId) {
                    // Update existing EnrollmentType
                    $enrollmentType = $existingEnrollmentType;
                    break;
                }
            }

            if(null == $enrollmentType) {
                $enrollmentType = new EnrollmentType();
            }

            $enrollmentType->setName($enrollmentTypeService->getName());
            $enrollmentType->setService($enrollmentTypeServiceId);
            $this->entityManager->persist($enrollmentType);
        }

        $this->entityManager->flush();
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