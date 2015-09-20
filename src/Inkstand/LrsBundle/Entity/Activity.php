<?php

namespace Inkstand\LrsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * Activity
 *
 * @ORM\Table("lrs_activity")
 * @ORM\Entity
 * @UniqueEntity("activityId")
 */
class Activity
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="activity_id", type="string", length=2083)
     */
    private $activityId;

    /**
     * @var string
     *
     * @ORM\Column(name="object_type", type="string", length=8)
     */
    private $objectType;

    /**
     * @var array
     *
     * @ORM\Column(name="definition_name", type="json_array")
     */
    private $definitionName;

    /**
     * @var array
     *
     * @ORM\Column(name="definition_description", type="json_array")
     */
    private $definitionDescription;

    /**
     * @var string
     *
     * @ORM\Column(name="definition_type", type="string", length=2083)
     */
    private $definitionType;

    /**
     * @var string
     *
     * @ORM\Column(name="definition_more_info", type="string", length=2083)
     */
    private $definitionMoreInfo;

    /**
     * @var array
     *
     * @ORM\Column(name="definition_extensions", type="json_array")
     */
    private $definitionExtensions;

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set activityId
     *
     * @param string $activityId
     * @return Activity
     */
    public function setActivityId($activityId)
    {
        $this->activityId = $activityId;

        return $this;
    }

    /**
     * Get activityId
     *
     * @return string 
     */
    public function getActivityId()
    {
        return $this->activityId;
    }

    /**
     * Set objectType
     *
     * @param string $objectType
     * @return Activity
     */
    public function setObjectType($objectType)
    {
        $this->objectType = $objectType;

        return $this;
    }

    /**
     * Get objectType
     *
     * @return string 
     */
    public function getObjectType()
    {
        return $this->objectType;
    }

    /**
     * Set definitionName
     *
     * @param array $definitionName
     * @return Activity
     */
    public function setDefinitionName($definitionName)
    {
        $this->definitionName = $definitionName;

        return $this;
    }

    /**
     * Get definitionName
     *
     * @return array 
     */
    public function getDefinitionName()
    {
        return $this->definitionName;
    }

    /**
     * Set definitionDescription
     *
     * @param array $definitionDescription
     * @return Activity
     */
    public function setDefinitionDescription($definitionDescription)
    {
        $this->definitionDescription = $definitionDescription;

        return $this;
    }

    /**
     * Get definitionDescription
     *
     * @return array 
     */
    public function getDefinitionDescription()
    {
        return $this->definitionDescription;
    }

    /**
     * Set definitionType
     *
     * @param string $definitionType
     * @return Activity
     */
    public function setDefinitionType($definitionType)
    {
        $this->definitionType = $definitionType;

        return $this;
    }

    /**
     * Get definitionType
     *
     * @return string 
     */
    public function getDefinitionType()
    {
        return $this->definitionType;
    }

    /**
     * Set definitionMoreInfo
     *
     * @param string $definitionMoreInfo
     * @return Activity
     */
    public function setDefinitionMoreInfo($definitionMoreInfo)
    {
        $this->definitionMoreInfo = $definitionMoreInfo;

        return $this;
    }

    /**
     * Get definitionMoreInfo
     *
     * @return string 
     */
    public function getDefinitionMoreInfo()
    {
        return $this->definitionMoreInfo;
    }

    /**
     * Set definitionExtensions
     *
     * @param array $definitionExtensions
     * @return Activity
     */
    public function setDefinitionExtensions($definitionExtensions)
    {
        $this->definitionExtensions = $definitionExtensions;

        return $this;
    }

    /**
     * Get definitionExtensions
     *
     * @return array 
     */
    public function getDefinitionExtensions()
    {
        return $this->definitionExtensions;
    }
}
