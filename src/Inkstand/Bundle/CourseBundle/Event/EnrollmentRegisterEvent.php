<?php

namespace Inkstand\Bundle\CourseBundle\Event;

use Symfony\Component\EventDispatcher\Event;

class EnrollmentRegisterEvent extends Event
{
    protected $enrollmentTypes = array();

    /**
     * Register enrollment type for courses to use for enrollment
     *
     * @author Joseph Conradt (joseph.conradt@coursebit.net)
     * @param string $enrollmentType
     */
    public function registerEnrollmentType($enrollmentType)
    {
        $this->enrollmentTypes[] = $enrollmentType;
    }

    /**
     * Called from EnrollmentService to get all registered enrollment types
     *
     *
     * @return array
     */
    public function getEnrollmentTypes()
    {
        return $this->enrollmentTypes;
    }
}