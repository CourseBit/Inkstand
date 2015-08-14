<?php

namespace Inkstand\Bundle\CourseBundle\Enrollment;

class ManualEnrollment implements EnrollmentTypeInterface
{
    /**
     * {@inheritdoc }
     *
     * @return string
     */
    public function getLabel()
    {
        return 'enrollment.manual_enrollment.label';
    }
}