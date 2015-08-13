<?php

namespace Inkstand\Bundle\CourseBundle\Event;

final class EnrollmentEvents
{
    const ENROLL_PRE = 'inkstand.course.enroll_pre';
    const ENROLL_POST = 'inkstand.course.enroll_post';
    const UNENROLL_PRE = 'inkstand.course.unenroll_pre';
    const UNENROLL_POST = 'inkstand.course.unenroll_post';
    const ENROLLMENT_REGISTER = 'inkstand.course.enrollment_register';
}