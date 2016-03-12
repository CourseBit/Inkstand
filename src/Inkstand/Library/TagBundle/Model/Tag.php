<?php

namespace Inkstand\Library\TagBundle\Model;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Inkstand\Library\TagBundle\Model\TagInterface;

/**
 * Tag
 */
abstract class Tag implements TagInterface
{
    /**
     * @var integer
     */
    protected $tagId;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $type;

    /**
     * @var string
     */
    protected $defaultValue = '';

    /**
     * @var array
     */
    protected $choices = '';

    /**
     * @var string
     */
    protected $code;

    /**
     * @var boolean
     */
    protected $required = 0;

    /**
     * @var array
     */
    protected $tagEntries;

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
     * @return Tag
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
     * @return Tag
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
     * @return Tag
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
     * @return Tag
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
     * Set code
     *
     * @param string $code
     * @return Tag
     */
    public function setCode($code)
    {
        $this->code = $code;

        return $this;
    }

    /**
     * Get code
     *
     * @return string 
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Set required
     *
     * @param boolean $required
     * @return Tag
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
     * Add tagEntries
     *
     * @param TagEntryInterface $tagEntries
     * @return Tag
     */
    public function addTagEntry(TagEntryInterface $tagEntries)
    {
        $this->tagEntries[] = $tagEntries;

        return $this;
    }

    /**
     * Remove tagEntries
     *
     * @param TagEntryInterface $tagEntries
     */
    public function removeTagEntry(TagEntryInterface $tagEntries)
    {
        $this->tagEntries->removeElement($tagEntries);
    }

    /**
     * Get tagEntries
     *
     * @return array
     */
    public function getTagEntries()
    {
        return $this->tagEntries;
    }
}
