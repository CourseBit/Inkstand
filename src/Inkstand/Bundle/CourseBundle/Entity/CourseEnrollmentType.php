<?php

namespace Inkstand\Bundle\CourseBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CourseEnrollmentType
 *
 * @ORM\Table("course_enrollment_type")
 * @ORM\Entity
 */
class CourseEnrollmentType
{
    /**
     * @var integer
     *
     * @ORM\Column(name="course_enrollment_type_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $courseEnrollmentTypeId;

    /**
     * @var integer
     *
     * @ORM\Column(name="course_id", type="integer")
     */
    private $courseId;

    /**
     * @var integer
     *
     * @ORM\Column(name="enrollment_type_id", type="integer")
     */
    private $enrollmentTypeId;

    /**
     * @var boolean
     *
     * @ORM\Column(name="enabled", type="boolean")
     */
    private $enabled;

    /**
     * @ORM\ManyToOne(targetEntity="Course", inversedBy="courseEnrollmentTypes")
     * @ORM\JoinColumn(name="course_id", referencedColumnName="course_id")
     */
    private $course;

    /**
     * Get courseEnrollmentTypeId
     *
     * @return integer 
     */
    public function getCourseEnrollmentTypeId()
    {
        return $this->courseEnrollmentTypeId;
    }

    /**
     * Set courseId
     *
     * @param integer $courseId
     * @return CourseEnrollmentTypes
     */
    public function setCourseId($courseId)
    {
        $this->courseId = $courseId;

        return $this;
    }

    /**
     * Get courseId
     *
     * @return integer 
     */
    public function getCourseId()
    {
        return $this->courseId;
    }

    /**
     * Set enrollmentTypeId
     *
     * @param integer $enrollmentTypeId
     * @return CourseEnrollmentTypes
     */
    public function setEnrollmentTypeId($enrollmentTypeId)
    {
        $this->enrollmentTypeId = $enrollmentTypeId;

        return $this;
    }

    /**
     * Get enrollmentTypeId
     *
     * @return integer 
     */
    public function getEnrollmentTypeId()
    {
        return $this->enrollmentTypeId;
    }

    /**
     * Set enabled
     *
     * @param boolean $enabled
     * @return CourseEnrollmentTypes
     */
    public function setEnabled($enabled)
    {
        $this->enabled = $enabled;

        return $this;
    }

    /**
     * Get enabled
     *
     * @return boolean 
     */
    public function getEnabled()
    {
        return $this->enabled;
    }
}
