<?php

namespace Inkstand\Bundle\CourseBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * EnrollmentType
 *
 * @ORM\Table("lms_enrollment_type")
 * @ORM\Entity
 */
class EnrollmentType
{
    /**
     * @var integer
     *
     * @ORM\Column(name="enrollment_type_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $enrollmentTypeId;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var
     *
     * @ORM\Column(name="service", type="string", length=255)
     */
    private $service;

    /**
     * @ORM\OneToMany(targetEntity="CourseEnrollmentType", mappedBy="enrollmentType", cascade={"remove"})
     */
    private $courseEnrollmentTypes;

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
     * Set name
     *
     * @param string $name
     * @return EnrollmentType
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set service
     *
     * @param string $service
     * @return EnrollmentType
     */
    public function setService($service)
    {
        $this->service = $service;

        return $this;
    }

    /**
     * Get service
     *
     * @return string
     */
    public function getService()
    {
        return $this->service;
    }

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->courseEnrollmentTypes = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add courseEnrollmentTypes
     *
     * @param \Inkstand\Bundle\CourseBundle\Entity\Module $courseEnrollmentTypes
     * @return EnrollmentType
     */
    public function addCourseEnrollmentType(\Inkstand\Bundle\CourseBundle\Entity\Module $courseEnrollmentTypes)
    {
        $this->courseEnrollmentTypes[] = $courseEnrollmentTypes;

        return $this;
    }

    /**
     * Remove courseEnrollmentTypes
     *
     * @param \Inkstand\Bundle\CourseBundle\Entity\Module $courseEnrollmentTypes
     */
    public function removeCourseEnrollmentType(\Inkstand\Bundle\CourseBundle\Entity\Module $courseEnrollmentTypes)
    {
        $this->courseEnrollmentTypes->removeElement($courseEnrollmentTypes);
    }

    /**
     * Get courseEnrollmentTypes
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getCourseEnrollmentTypes()
    {
        return $this->courseEnrollmentTypes;
    }
}
