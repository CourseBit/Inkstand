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

        // Delete any missing
        foreach($existingEnrollmentTypes as $key => $existingEnrollmentType) {
            $serviceExists = false;
            foreach($this->enrollmentTypeServiceIds as $enrollmentTypeServiceId) {
                if($existingEnrollmentType->getService() == $enrollmentTypeServiceId) {
                    $serviceExists = true;
                }
            }
            if(!$serviceExists) {
                $this->entityManager->remove($existingEnrollmentType);
                $this->entityManager->flush();
                unset($existingEnrollmentTypes[$key]);
            }
        }

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
        $enrollmentService = $this->serviceContainer->get($enrollmentType->getService());
        if(!is_a($enrollmentService, 'Inkstand\EnrollmentBundle\EnrollmentType\AbstractEnrollmentType')) {
            throw new \Exception(sprintf('Invalid enrollment service. %s must extend Inkstand\EnrollmentBundle\EnrollmentType\AbstractEnrollmentType', get_class($enrollmentService)));
        }
        return $enrollmentService;
    }
}