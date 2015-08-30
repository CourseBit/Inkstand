<?php

namespace Inkstand\Bundle\CourseBundle\Service;


abstract class AbstractEnrollmentService
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
}