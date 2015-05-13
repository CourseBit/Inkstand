<?php

namespace Inkstand\Bundle\CourseBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\InheritanceType("SINGLE_TABLE")
 * @ORM\DiscriminatorColumn(name="activity_type_id", type="integer")
 */
class Activity
{
    /**
     * @var integer
     *
     * @ORM\Column(name="activity_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $activityId;

    /**
     * @var integer
     *
     * @ORM\Column(name="module_id", type="integer")
     */
    private $moduleId;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text")
     */
    private $description;

    /**
     * @ORM\ManyToOne(targetEntity="Module", inversedBy="activities")
     * @ORM\JoinColumn(name="module_id", referencedColumnName="module_id")
     */
    private $module;

    /**
     * @ORM\ManyToOne(targetEntity="ActivityType", inversedBy="activities")
     * @ORM\JoinColumn(name="activity_type_id", referencedColumnName="activity_type_id")
     */
    private $activityType;

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
     * Set moduleId
     *
     * @param integer $moduleId
     * @return Activity
     */
    public function setModuleId($moduleId)
    {
        $this->moduleId = $moduleId;

        return $this;
    }

    /**
     * Get moduleId
     *
     * @return integer 
     */
    public function getModuleId()
    {
        return $this->moduleId;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Activity
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
     * Set description
     *
     * @param string $description
     * @return Activity
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set activityTypeId
     *
     * @param integer $activityTypeId
     * @return Activity
     */
    public function setActivityTypeId($activityTypeId)
    {
        $this->activityTypeId = $activityTypeId;

        return $this;
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
     * Set module
     *
     * @param \Inkstand\Bundle\CourseBundle\Entity\Module $module
     * @return Activity
     */
    public function setModule(\Inkstand\Bundle\CourseBundle\Entity\Module $module = null)
    {
        $this->module = $module;

        return $this;
    }

    /**
     * Get module
     *
     * @return \Inkstand\Bundle\CourseBundle\Entity\Module 
     */
    public function getModule()
    {
        return $this->module;
    }

    /**
     * Set activityType
     *
     * @param \Inkstand\Bundle\CourseBundle\Entity\Activity $activityType
     * @return Activity
     */
    public function setActivityType(\Inkstand\Bundle\CourseBundle\Entity\Activity $activityType = null)
    {
        $this->activityType = $activityType;

        return $this;
    }

    /**
     * Get activityType
     *
     * @return \Inkstand\Bundle\CourseBundle\Entity\Activity 
     */
    public function getActivityType()
    {
        return $this->activityType;
    }
}
