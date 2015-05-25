<?php

namespace Inkstand\Bundle\CourseBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\InheritanceType("SINGLE_TABLE")
 * @ORM\DiscriminatorColumn(name="activity_type_discriminator", type="string")
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
     * @ORM\Column(name="activity_type_id", type="integer")
     */
    private $activityTypeId;

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
     * @ORM\Column(name="slug", type="string", length=255)
     */
    private $slug;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text")
     */
    private $description;

    /**
     * @var integer
     *
     * @ORM\Column(name="sort_order", type="integer")
     */
    private $sortOrder;

    /**
     * @ORM\ManyToOne(targetEntity="Module", inversedBy="activities")
     * @ORM\JoinColumn(name="module_id", referencedColumnName="module_id")
     */
    private $module;

    /**
     * @ORM\ManyToOne(targetEntity="Inkstand\Bundle\CourseBundle\Entity\ActivityType", inversedBy="activities")
     * @ORM\JoinColumn(name="activity_type_id", referencedColumnName="activity_type_id")
     */
    protected $activityType;

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
     * Set slug
     *
     * @param string $slug
     * @return Activity
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Get slug
     *
     * @return string 
     */
    public function getSlug()
    {
        return $this->slug;
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
     * @param \Inkstand\Bundle\CourseBundle\Entity\ActivityType $activityType
     * @return Activity
     */
    public function setActivityType(\Inkstand\Bundle\CourseBundle\Entity\ActivityType $activityType = null)
    {
        $this->activityType = $activityType;

        return $this;
    }

    /**
     * Get activityType
     *
     * @return \Inkstand\Bundle\CourseBundle\Entity\ActivityType 
     */
    public function getActivityType()
    {
        return $this->activityType;
    }

    /**
     * Set sortOrder
     *
     * @param integer $sortOrder
     * @return Activity
     */
    public function setSortOrder($sortOrder)
    {
        $this->sortOrder = $sortOrder;

        return $this;
    }

    /**
     * Get sortOrder
     *
     * @return integer 
     */
    public function getSortOrder()
    {
        return $this->sortOrder;
    }
}
