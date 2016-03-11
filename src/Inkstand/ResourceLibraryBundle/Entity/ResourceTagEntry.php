<?php

namespace Inkstand\ResourceLibraryBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ResourceTagEntry
 */
class ResourceTagEntry
{
    /**
     * @var integer
     */
    private $tagEntryId;

    /**
     * @var integer
     */
    private $resourceId;

    /**
     * @var integer
     */
    private $tagId;

    /**
     * @var string
     */
    private $value;

    private $resource;

    private $tag;

    /**
     * Get id
     *
     * @return integer 
     */
    public function getTagEntryId()
    {
        return $this->tagEntryId;
    }

    /**
     * Set resourceId
     *
     * @param integer $resourceId
     * @return ResourceTagEntry
     */
    public function setResourceId($resourceId)
    {
        $this->resourceId = $resourceId;

        return $this;
    }

    /**
     * Get resourceId
     *
     * @return integer 
     */
    public function getResourceId()
    {
        return $this->resourceId;
    }

    /**
     * Set tagId
     *
     * @param integer $tagId
     * @return ResourceTagEntry
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
     * @return ResourceTagEntry
     */
    public function setValue($value)
    {
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
     * Set resource
     *
     * @param \Inkstand\ResourceLibraryBundle\Entity\Resource $resource
     * @return ResourceTagEntry
     */
    public function setResource(\Inkstand\ResourceLibraryBundle\Entity\Resource $resource = null)
    {
        $this->resource = $resource;

        return $this;
    }

    /**
     * Get resource
     *
     * @return \Inkstand\ResourceLibraryBundle\Entity\Resource 
     */
    public function getResource()
    {
        return $this->resource;
    }

    /**
     * Set tag
     *
     * @param \Inkstand\ResourceLibraryBundle\Entity\ResourceTag $tag
     * @return ResourceTagEntry
     */
    public function setTag(\Inkstand\ResourceLibraryBundle\Entity\ResourceTag $tag)
    {
        $this->tag = $tag;

        return $this;
    }

    /**
     * Get tag
     *
     * @return \Inkstand\ResourceLibraryBundle\Entity\ResourceTag 
     */
    public function getTag()
    {
        return $this->tag;
    }
}
