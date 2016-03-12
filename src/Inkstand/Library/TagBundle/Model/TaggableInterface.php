<?php

namespace Inkstand\Library\TagBundle\Model;

interface TaggableInterface
{
    /**
     * Get name of taggable object.
     *
     * Can be a name column on the model, or something generated for user to see.
     *
     * @return string
     */
    public function getName();

    /**
     * Add tagEntry
     *
     * @param TagEntryInterface $tagEntry
     * @return Resource
     */
    public function addTagEntry(TagEntryInterface $tagEntry);

    /**
     * Remove tagEntry
     *
     * @param TagEntryInterface $tagEntry
     */
    public function removeTagEntry(TagEntryInterface $tagEntry);

    /**
     * Get tagEntries
     *
     * @return array
     */
    public function getTagEntries();

    /**
     * Return ID of taggable object
     *
     * @return integer
     */
    public function getObjectId();
}