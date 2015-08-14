<?php

namespace Inkstand\Bundle\CourseBundle\Enrollment;

interface EnrollmentTypeInterface
{
    /**
     * Return human readable label for this enrollment type.
     * NOTE: Strongly recommended to use translations, so return a translation key instead of the actual text
     * Example: return 'enrollment.manual_enrollment.label';
     *
     * @return mixed
     */
    public function getLabel();
}