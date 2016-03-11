<?php

namespace Inkstand\Library\TagBundle\Model;


interface TagEntryManagerInterface
{
    /**
     * Create new tag entry
     *
     * @return TagEntryInterface
     */
    public function create(TagInterface $tag, TaggableInterface $object);

    /**
     * Get full class name to tag entry
     *
     * @return string
     */
    public function getClass();
}