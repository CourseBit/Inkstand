<?php

namespace Inkstand\Bundle\CourseBundle\EnrollmentType;


abstract class AbstractEnrollmentType
{
    protected $enrollmentService;

    public function __construct($enrollmentService)
    {
        $this->enrollmentService = $enrollmentService;
    }

    public function getController()
    {
        return null;
    }

    public abstract function getName();
}