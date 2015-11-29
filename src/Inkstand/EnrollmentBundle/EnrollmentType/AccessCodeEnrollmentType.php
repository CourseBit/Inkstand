<?php

namespace Inkstand\EnrollmentBundle\EnrollmentType;

use Inkstand\EnrollmentBundle\Entity\AccessCodeSettings;
use Inkstand\EnrollmentBundle\Form\Type\AccessCodeSettingsType;

class AccessCodeEnrollmentType extends AbstractEnrollmentType
{
    protected $entityManager;
    protected $accessCodeSettingsRepository;

    public function __construct($enrollmentService, $entityManager)
    {
        $this->entityManager = $entityManager;
        $this->accessCodeSettingsRepository = $this->entityManager->getRepository('InkstandEnrollmentBundle:AccessCodeSettings');
        parent::__construct($enrollmentService);
    }

    public function getController()
    {
        return 'InkstandEnrollmentBundle:AccessCodeEnrollment';
    }

    public function getSettingsForm()
    {
        return new AccessCodeSettingsType();
    }

    public function getSettings($courseId)
    {
        $accessCodeSettings = $this->accessCodeSettingsRepository->findOneByCourseId($courseId);
        if($accessCodeSettings == null) {
            return new AccessCodeSettings();
        }
        return $accessCodeSettings;
    }

    public function getName()
    {
        return 'access_code';
    }
}