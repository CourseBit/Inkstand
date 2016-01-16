<?php

namespace Inkstand\Activity\ScormBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ScormPreferences
 *
 * @ORM\Table(name="lms_scorm_preferences")
 * @ORM\Entity
 */
class ScormPreferences
{
    /**
     * @var integer
     *
     * @ORM\Column(name="scorm_preferences_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $scormPreferencesId;

    /**
     * @var integer
     *
     * @ORM\Column(name="activity_id", type="integer")
     */
    private $activityId;

    /**
     * @var string
     *
     * @ORM\Column(name="scorm_version", type="string", length=255)
     */
    private $scormVersion;

    /**
     * @var integer
     *
     * @ORM\Column(name="scorm_package_file_reference_id", type="integer")
     */
    private $scormPackageFileReferenceId;

    /**
     * @var
     *
     * @ORM\ManyToOne(targetEntity="Inkstand\Bundle\CoreBundle\Entity\FileReference", cascade={"persist"})
     * @ORM\JoinColumn(name="scorm_package_file_reference_id", referencedColumnName="file_reference_id", nullable=true)
     */
    private $scormPackageFileReference;

    /**
     * Get scormPreferencesId
     *
     * @return integer 
     */
    public function getScormPreferencesId()
    {
        return $this->scormPreferencesId;
    }

    /**
     * Set activityId
     *
     * @param integer $activityId
     * @return ScormPreferences
     */
    public function setActivityId($activityId)
    {
        $this->activityId = $activityId;

        return $this;
    }

    /**
     * Get activityId
     *
     * @return integer
     */
    public function getActivityId()
    {
        return $this->activityId;
    }

    /**
     * Set scormVersion
     *
     * @param string $scormVersion
     * @return ScormPreferences
     */
    public function setScormVersion($scormVersion)
    {
        $this->scormVersion = $scormVersion;

        return $this;
    }

    /**
     * Get scormVersion
     *
     * @return string 
     */
    public function getScormVersion()
    {
        return $this->scormVersion;
    }

    /**
     * Set scormPackageFileReferenceId
     *
     * @param integer $scormPackageFileReferenceId
     * @return ScormPreferences
     */
    public function setScormPackageFileReferenceId($scormPackageFileReferenceId)
    {
        $this->scormPackageFileReferenceId = $scormPackageFileReferenceId;

        return $this;
    }

    /**
     * Get scormPackageFileReferenceId
     *
     * @return integer 
     */
    public function getScormPackageFileReferenceId()
    {
        return $this->scormPackageFileReferenceId;
    }

    /**
     * Set scormPackageFileReference
     *
     * @param \Inkstand\Bundle\CoreBundle\Entity\FileReference $scormPackageFileReference
     * @return ScormPreferences
     */
    public function setScormPackageFileReference(\Inkstand\Bundle\CoreBundle\Entity\FileReference $scormPackageFileReference = null)
    {
        $this->scormPackageFileReference = $scormPackageFileReference;

        return $this;
    }

    /**
     * Get scormPackageFileReference
     *
     * @return \Inkstand\Bundle\CoreBundle\Entity\FileReference 
     */
    public function getScormPackageFileReference()
    {
        return $this->scormPackageFileReference;
    }
}
