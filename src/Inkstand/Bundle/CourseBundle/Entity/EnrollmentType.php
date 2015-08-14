<?php

namespace Inkstand\Bundle\CourseBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * EnrollmentType
 *
 * @ORM\Table("enrollment_type")
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
}
