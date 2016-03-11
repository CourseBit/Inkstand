<?php

namespace Inkstand\Library\TagBundle\Model;

abstract class TagEntryManager implements TagEntryManagerInterface
{
    /**
     * Create new tag entry
     *
     * @return TagEntryInterface
     */
    public function create(TagInterface $tag, TaggableInterface $object)
    {
        $class = $this->getClass();
        /** @var TagEntryInterface $tagEntry */
        $tagEntry = new $class;
        $tagEntry->setObject($object);
        $tagEntry->setObjectId($object->getObjectId());
        $tagEntry->setTag($tag);
        $tagEntry->setTagId($tag->getTagId());

        return $tagEntry;
    }
}