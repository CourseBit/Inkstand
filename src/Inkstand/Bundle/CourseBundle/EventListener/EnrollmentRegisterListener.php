<?php

namespace Inkstand\Bundle\CourseBundle\EventListener;

use Inkstand\Bundle\CourseBundle\Event\EnrollmentRegisterEvent;

class EnrollmentRegisterListener
{
    public function onEnrollmentRegister(EnrollmentRegisterEvent $event)
    {
        $event->registerEnrollmentType('inkstand_course.enrollment.manual_enrollment');
    }
}