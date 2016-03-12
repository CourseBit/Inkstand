<?php

namespace Inkstand\Library\TagBundle\Model;


interface TagEntryManagerInterface
{
    /**
     * Return all tags
     *
     * @return \Traversable
     */
    public function findAll();

    /**
     * Return tag by criteria
     *
     * @param array $criteria
     * @return TagInterface
     */
    public function findOneBy(array $criteria);

    /**
     * Return tags by criteria
     *
     * @param array $criteria
     * @return \Traversable
     */
    public function findBy(array $criteria);

    /**
     * Create new tag entry
     *
     * @return TagEntryInterface
     */
    public function create(TagInterface $tag, TaggableInterface $object);

    /**
     * @param TagEntryInterface $tag
     * @return mixed
     */
    public function update(TagEntryInterface $tag);

    /**
     * Get full class name to tag entry
     *
     * @return string
     */
    public function getClass();
}