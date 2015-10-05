<?php

namespace Inkstand\Bundle\CourseBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ActivityType
 *
 * @ORM\Table(name="lms_activity_type")
 * @ORM\Entity(repositoryClass="Inkstand\Bundle\CourseBundle\Entity\ActivityTypeRepository")
 */
class ActivityType
{
    /**
     * @var integer
     *
     * @ORM\Column(name="activity_type_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $activityTypeId;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="bundle_name", type="string", length=255)
     */
    private $bundleName;

    /**
     * @ORM\OneToMany(targetEntity="Activity", mappedBy="module", cascade={"remove"})
     */
    private $activities;
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->activities = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Get activityTypeId
     *
     * @return integer 
     */
    public function getActivityTypeId()
    {
        return $this->activityTypeId;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return ActivityType
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
     * Add activities
     *
     * @param \Inkstand\Bundle\CourseBundle\Entity\Activity $activities
     * @return ActivityType
     */
    public function addActivity(\Inkstand\Bundle\CourseBundle\Entity\Activity $activities)
    {
        $this->activities[] = $activities;

        return $this;
    }

    /**
     * Remove activities
     *
     * @param \Inkstand\Bundle\CourseBundle\Entity\Activity $activities
     */
    public function removeActivity(\Inkstand\Bundle\CourseBundle\Entity\Activity $activities)
    {
        $this->activities->removeElement($activities);
    }

    /**
     * Get activities
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getActivities()
    {
        return $this->activities;
    }

    /**
     * Set bundleName
     *
     * @param string $bundleName
     * @return ActivityType
     */
    public function setBundleName($bundleName)
    {
        $this->bundleName = $bundleName;

        return $this;
    }

    /**
     * Get bundleName
     *
     * @return string 
     */
    public function getBundleName()
    {
        return $this->bundleName;
    }
}
