<?php
/**
 * Created by PhpStorm.
 * User: Joe
 * Date: 1/3/2016
 * Time: 4:30 PM
 */

namespace Inkstand\EnrollmentBundle\EnrollmentType;


class SelfEnrollmentType extends AbstractEnrollmentType
{
    protected $entityManager;

    public function __construct($enrollmentService, $entityManager)
    {
        $this->entityManager = $entityManager;
        parent::__construct($enrollmentService);
    }

    public function getController()
    {
        return 'InkstandEnrollmentBundle:SelfEnrollment';
    }

    public function getSettingsForm()
    {
        return null;
    }

    public function getSettings($courseId)
    {
        return null;
    }

    public function getName()
    {
        return 'self';
    }
}