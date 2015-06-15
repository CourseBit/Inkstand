<?php

namespace Inkstand\Bundle\CourseBundle\Event;

use Symfony\Component\EventDispatcher\Event;
use Inkstand\Bundle\CourseBundle\Entity\Enrollment;

class EnrollmentEvent extends Event
{
    protected $enrollment;

    public function __construct(Enrollment $enrollment)
    {
        $this->enrollment = $enrollment;
    }

    public function getEnrollment()
    {
        return $this->enrollment;
    }
}