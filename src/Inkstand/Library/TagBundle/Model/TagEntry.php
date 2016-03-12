<?php

namespace Inkstand\Library\TagBundle\Model;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Inkstand\Library\TagBundle\Model\TagInterface;

abstract class TagEntry implements TagEntryInterface
{
    /**
     * @var integer
     */
    protected $tagEntryId;

    /**
     * @var string
     */
    protected $value;

    /**
     * @var integer
     */
    protected $objectId;

    /**
     * @var mixed
     */
    protected $object;

    /**
     * @var integer
     */
    protected $tagId;

    /**
     * @var TagInterface
     */
    protected $tag;

    /**
     * Get tagEntryId
     *
     * @return integer 
     */
    public function getTagEntryId()
    {
        return $this->tagEntryId;
    }

    /**
     * Set tagId
     *
     * @param integer $tagId
     * @return TagEntry
     */
    public function setTagId($tagId)
    {
        $this->tagId = $tagId;

        return $this;
    }

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
     * Set value
     *
     * @param string $value
     * @return TagEntry
     */
    public function setValue($value)
    {
        if(is_array($value)) {
            $value = implode(PHP_EOL, $value);
        }
        $this->value = $value;

        return $this;
    }

    /**
     * Get value
     *
     * @return string 
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Set objectId
     *
     * @param integer $objectId
     * @return TagEntry
     */
    public function setObjectId($objectId)
    {
        $this->objectId = $objectId;

        return $this;
    }

    /**
     * Get objectId
     *
     * @return integer
     */
    public function getObjectId()
    {
        return $this->objectId;
    }

    /**
     * Set object
     *
     * @param mixed $object
     * @return TagEntry
     */
    public function setObject(TaggableInterface $object)
    {
        $this->object = $object;

        return $this;
    }

    /**
     * Get object
     *
     * @return TaggableInterface
     */
    public function getObject()
    {
        return $this->object;
    }

    /**
     * Set tag
     *
     * @param TagInterface $tag
     * @return TagEntry
     */
    public function setTag(TagInterface $tag = null)
    {
        $this->tag = $tag;

        return $this;
    }

    /**
     * Get tag
     *
     * @return TagInterface
     */
    public function getTag()
    {
        return $this->tag;
    }
}
