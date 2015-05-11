<?php

namespace Inkstand\Bundle\CourseBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ActivityType
 *
 * @ORM\Table(name="activity_type")
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
     * @ORM\OneToMany(targetEntity="Activity", mappedBy="activityType")
     */
    private $activities;

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
     * Constructor
     */
    public function __construct()
    {
        $this->activities = new \Doctrine\Common\Collections\ArrayCollection();
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
}
