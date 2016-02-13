<?php

namespace Inkstand\Library\TagBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Inkstand\Library\TagBundle\Model\TagInterface;

/**
 * Tag
 */
class Tag implements TagInterface
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
     * @var array
     */
    private $choices;

    /**
     * @var string
     */
    private $uniqueName;

    /**
     * @var string
     */
    private $category;

    /**
     * @var boolean
     */
    private $required = 0;

    /**
     * Get tagId
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
     * @return TagInterface
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
     * @return TagInterface
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
     * @return TagInterface
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
     * @param array $choices
     * @return TagInterface
     */
    public function setChoices($choices)
    {
        $this->choices = $choices;

        return $this;
    }

    /**
     * Get choices
     *
     * @return array 
     */
    public function getChoices()
    {
        return $this->choices;
    }

    /**
     * Set uniqueName
     *
     * @param string $uniqueName
     * @return TagInterface
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
     * Set category
     *
     * @param string $category
     * @return TagInterface
     */
    public function setCategory($category)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get category
     *
     * @return string
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * Set required
     *
     * @param boolean $required
     * @return TagInterface
     */
    public function setRequired($required)
    {
        $this->required = $required;

        return $this;
    }

    /**
     * Get required
     *
     * @return string
     */
    public function getRequired()
    {
        return $this->required;
    }
}
