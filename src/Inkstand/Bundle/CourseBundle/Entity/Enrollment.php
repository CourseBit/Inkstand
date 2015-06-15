<?php

namespace Inkstand\Bundle\CourseBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Enrollment
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Inkstand\Bundle\CourseBundle\Entity\EnrollmentRepository")
 */
class Enrollment
{
    /**
     * @var integer
     *
     * @ORM\Column(name="enrollment_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $enrollmentId;

    /**
     * @var integer
     *
     * @ORM\Column(name="course_id", type="integer")
     */
    private $courseId;

    /**
     * @var integer
     *
     * @ORM\Column(name="user_id", type="integer")
     */
    private $userId;

    /**
     * @ORM\ManyToOne(targetEntity="Course", inversedBy="enrollments")
     * @ORM\JoinColumn(name="course_id", referencedColumnName="course_id")
     */
    private $course;

    /**
     * @ORM\ManyToOne(targetEntity="Inkstand\Bundle\UserBundle\Entity\User")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $user;

    /**
     * Get enrollmentId
     *
     * @return integer 
     */
    public function getEnrollmentId()
    {
        return $this->enrollmentId;
    }

    /**
     * Set courseId
     *
     * @param integer $courseId
     * @return Enrollment
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
     * Set userId
     *
     * @param integer $userId
     * @return Enrollment
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;

        return $this;
    }

    /**
     * Get userId
     *
     * @return integer 
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * Set course
     *
     * @param \Inkstand\Bundle\CourseBundle\Entity\Course $course
     * @return Enrollment
     */
    public function setCourse(\Inkstand\Bundle\CourseBundle\Entity\Course $course = null)
    {
        $this->course = $course;

        return $this;
    }

    /**
     * Get course
     *
     * @return \Inkstand\Bundle\CourseBundle\Entity\Course 
     */
    public function getCourse()
    {
        return $this->course;
    }

    /**
     * Set user
     *
     * @param \Inkstand\Bundle\UserBundle\Entity\User $user
     * @return Enrollment
     */
    public function setUser(\Inkstand\Bundle\UserBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \Inkstand\Bundle\UserBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }
}
