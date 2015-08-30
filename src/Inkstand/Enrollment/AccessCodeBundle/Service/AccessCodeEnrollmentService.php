<?php

namespace Inkstand\Enrollment\AccessCodeBundle\Service;

use Inkstand\Bundle\CourseBundle\Service\AbstractEnrollmentService;
use Inkstand\Enrollment\AccessCodeBundle\Entity\AccessCodeSettings;
use Inkstand\Enrollment\AccessCodeBundle\Form\Type\AccessCodeSettingsType;

class AccessCodeEnrollmentService extends AbstractEnrollmentService
{
    protected $entityManager;
    protected $accessCodeSettingsRepository;

    public function __construct($enrollmentService, $entityManager)
    {
        $this->entityManager = $entityManager;
        $this->accessCodeSettingsRepository = $this->entityManager->getRepository('InkstandAccessCodeBundle:AccessCodeSettings');
        parent::__construct($enrollmentService);
    }

    public function getController()
    {
        return 'InkstandAccessCodeBundle:AccessCodeEnrollment';
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
}