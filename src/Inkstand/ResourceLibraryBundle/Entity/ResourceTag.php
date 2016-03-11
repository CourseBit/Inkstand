<?php

namespace Inkstand\ResourceLibraryBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ResourceTag
 */
class ResourceTag
{
    /**
     * @var integer
     */
    private $tagId;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $type;

    /**
     * @var string
     */
    private $defaultValue;

    /**
     * @var string
     */
    private $choices;

    /**
     * @var string
     */
    private $uniqueName;

    /**
     * @var boolean
     */
    private $required;

    private $tagEntries;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getTagId()
    {
        return $this->tagId;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return ResourceTag
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
     * Set type
     *
     * @param string $type
     * @return ResourceTag
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return string 
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set defaultValue
     *
     * @param string $defaultValue
     * @return ResourceTag
     */
    public function setDefaultValue($defaultValue)
    {
        $this->defaultValue = $defaultValue;

        return $this;
    }

    /**
     * Get defaultValue
     *
     * @return string 
     */
    public function getDefaultValue()
    {
        return $this->defaultValue;
    }

    /**
     * Set choices
     *
     * @param string $choices
     * @return ResourceTag
     */
    public function setChoices($choices)
    {
        $this->choices = $choices;

        return $this;
    }

    /**
     * Get choices
     *
     * @return string 
     */
    public function getChoices()
    {
        return $this->choices;
    }

    /**
     * Set uniqueName
     *
     * @param string $uniqueName
     * @return ResourceTag
     */
    public function setUniqueName($uniqueName)
    {
        $this->uniqueName = $uniqueName;

        return $this;
    }

    /**
     * Get uniqueName
     *
     * @return string 
     */
    public function getUniqueName()
    {
        return $this->uniqueName;
    }

    /**
     * Set required
     *
     * @param boolean $required
     * @return ResourceTag
     */
    public function setRequired($required)
    {
        $this->required = $required;

        return $this;
    }

    /**
     * Get required
     *
     * @return boolean 
     */
    public function getRequired()
    {
        return $this->required;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->tagEntries = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add tagEntries
     *
     * @param \Inkstand\ResourceLibraryBundle\Entity\ResourceTagEntry $tagEntries
     * @return ResourceTag
     */
    public function addTagEntry(\Inkstand\ResourceLibraryBundle\Entity\ResourceTagEntry $tagEntries)
    {
        $this->tagEntries[] = $tagEntries;

        return $this;
    }

    /**
     * Remove tagEntries
     *
     * @param \Inkstand\ResourceLibraryBundle\Entity\ResourceTagEntry $tagEntries
     */
    public function removeTagEntry(\Inkstand\ResourceLibraryBundle\Entity\ResourceTagEntry $tagEntries)
    {
        $this->tagEntries->removeElement($tagEntries);
    }

    /**
     * Get tagEntries
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getTagEntries()
    {
        return $this->tagEntries;
    }
}
