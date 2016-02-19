<?php

namespace Inkstand\Library\TagBundle\Model;

interface TagEntryInterface
{
    /**
     * Get tagEntryId
     *
     * @return integer
     */
    public function getTagEntryId();

    /**
     * Set tagId
     *
     * @param integer $tagId
     * @return TagEntry
     */
    public function setTagId($tagId);

    /**
     * Get tagId
     *
     * @return integer
     */
    public function getTagId();

    /**
     * Set value
     *
     * @param string $value
     * @return TagEntry
     */
    public function setValue($value);

    /**
     * Get value
     *
     * @return string
     */
    public function getValue();

    /**
     * Set objectId
     *
     * @param integer $objectId
     * @return TagEntry
     */
    public function setObjectId($objectId);

    /**
     * Get objectId
     *
     * @return integer
     */
    public function getObjectId();

    public function setTag(TagInterface $tag);

    public function getTag();

    public function setObject($object);

    public function getObject();
}