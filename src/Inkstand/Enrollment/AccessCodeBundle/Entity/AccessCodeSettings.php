<?php

namespace Inkstand\Enrollment\AccessCodeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Settings
 *
 * @ORM\Table("lms_access_code_settings")
 * @ORM\Entity
 */
class AccessCodeSettings
{
    /**
     * @var integer
     *
     * @ORM\Column(name="access_code_settings_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $accessCodeSettingsId;

    /**
     * @var integer
     *
     * @ORM\Column(name="course_id", type="integer")
     * @Assert\NotBlank()
     */
    private $courseId;

    /**
     * @var string
     *
     * @ORM\Column(name="access_code", type="string", length=255)
     * @Assert\Length(
     *      min = 2,
     *      max = 255
     * )
     */
    private $accessCode;

    /**
     * @var boolean
     *
     * @ORM\Column(name="expires", type="boolean")
     */
    private $expires;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_expires", type="datetime")
     * @Assert\Date()
     */
    private $dateExpires;

    /**
     * @var integer
     * @ORM\Column(name="course_enrollment_type_id", type="integer", nullable=false)
     */
    private $courseEnrollmentTypeId;

    /**
     * Get accessCodeSettingsId
     *
     * @return integer 
     */
    public function getAccessCodeSettingsId()
    {
        return $this->accessCodeSettingsId;
    }

    /**
     * Set accessCode
     *
     * @param string $accessCode
     * @return Settings
     */
    public function setAccessCode($accessCode)
    {
        $this->accessCode = $accessCode;

        return $this;
    }

    /**
     * Get accessCode
     *
     * @return string 
     */
    public function getAccessCode()
    {
        return $this->accessCode;
    }

    /**
     * Set courseEnrollmentTypeId
     *
     * @param integer $courseEnrollmentTypeId
     * @return AccessCodeSettings
     */
    public function setCourseEnrollmentTypeId($courseEnrollmentTypeId)
    {
        $this->courseEnrollmentTypeId = $courseEnrollmentTypeId;

        return $this;
    }

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
     * @return AccessCodeSettings
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
     * Set expires
     *
     * @param boolean $expires
     * @return AccessCodeSettings
     */
    public function setExpires($expires)
    {
        $this->expires = $expires;

        return $this;
    }

    /**
     * Get expires
     *
     * @return boolean 
     */
    public function getExpires()
    {
        return $this->expires;
    }

    /**
     * Set dateExpires
     *
     * @param \DateTime $dateExpires
     * @return AccessCodeSettings
     */
    public function setDateExpires($dateExpires)
    {
        $this->dateExpires = $dateExpires;

        return $this;
    }

    /**
     * Get dateExpires
     *
     * @return \DateTime 
     */
    public function getDateExpires()
    {
        return $this->dateExpires;
    }
}
