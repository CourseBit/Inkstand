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
     * @var string
     *
     * @ORM\Column(name="definition_interaction_type", type="string", length=25)
     */
    private $definitionInteractionType;

    /**
     * @var array
     *
     * @ORM\Column(name="definition_correct_responses_pattern", type="json_array")
     */
    private $definitionCorrectResponsesPattern;

    /**
     * @var array
     *
     * @ORM\Column(name="definition_choices", type="json_array")
     */
    private $definitionChoices;

    /**
     * @var array
     *
     * @ORM\Column(name="definition_scale", type="json_array")
     */
    private $definitionScale;

    /**
     * @var array
     *
     * @ORM\Column(name="definition_source", type="json_array")
     */
    private $definitionSource;

    /**
     * @var array
     *
     * @ORM\Column(name="definition_target", type="json_array")
     */
    private $definitionTarget;

    /**
     * @var array
     *
     * @ORM\Column(name="definition_steps", type="json_array")
     */
    private $definitionSteps;

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

    /**
     * Set definitionInteractionType
     *
     * @param string $definitionInteractionType
     * @return Activity
     */
    public function setDefinitionInteractionType($definitionInteractionType)
    {
        $this->definitionInteractionType = $definitionInteractionType;

        return $this;
    }

    /**
     * Get definitionInteractionType
     *
     * @return string 
     */
    public function getDefinitionInteractionType()
    {
        return $this->definitionInteractionType;
    }

    /**
     * Set definitionCorrectResponsesPattern
     *
     * @param array $definitionCorrectResponsesPattern
     * @return Activity
     */
    public function setDefinitionCorrectResponsesPattern($definitionCorrectResponsesPattern)
    {
        $this->definitionCorrectResponsesPattern = $definitionCorrectResponsesPattern;

        return $this;
    }

    /**
     * Get definitionCorrectResponsesPattern
     *
     * @return array 
     */
    public function getDefinitionCorrectResponsesPattern()
    {
        return $this->definitionCorrectResponsesPattern;
    }

    /**
     * Set definitionChoices
     *
     * @param array $definitionChoices
     * @return Activity
     */
    public function setDefinitionChoices($definitionChoices)
    {
        $this->definitionChoices = $definitionChoices;

        return $this;
    }

    /**
     * Get definitionChoices
     *
     * @return array 
     */
    public function getDefinitionChoices()
    {
        return $this->definitionChoices;
    }

    /**
     * Set definitionScale
     *
     * @param array $definitionScale
     * @return Activity
     */
    public function setDefinitionScale($definitionScale)
    {
        $this->definitionScale = $definitionScale;

        return $this;
    }

    /**
     * Get definitionScale
     *
     * @return array 
     */
    public function getDefinitionScale()
    {
        return $this->definitionScale;
    }

    /**
     * Set definitionSource
     *
     * @param array $definitionSource
     * @return Activity
     */
    public function setDefinitionSource($definitionSource)
    {
        $this->definitionSource = $definitionSource;

        return $this;
    }

    /**
     * Get definitionSource
     *
     * @return array 
     */
    public function getDefinitionSource()
    {
        return $this->definitionSource;
    }

    /**
     * Set definitionTarget
     *
     * @param array $definitionTarget
     * @return Activity
     */
    public function setDefinitionTarget($definitionTarget)
    {
        $this->definitionTarget = $definitionTarget;

        return $this;
    }

    /**
     * Get definitionTarget
     *
     * @return array 
     */
    public function getDefinitionTarget()
    {
        return $this->definitionTarget;
    }

    /**
     * Set definitionSteps
     *
     * @param array $definitionSteps
     * @return Activity
     */
    public function setDefinitionSteps($definitionSteps)
    {
        $this->definitionSteps = $definitionSteps;

        return $this;
    }

    /**
     * Get definitionSteps
     *
     * @return array 
     */
    public function getDefinitionSteps()
    {
        return $this->definitionSteps;
    }
}
