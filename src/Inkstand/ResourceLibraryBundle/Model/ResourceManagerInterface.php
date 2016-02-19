<?php

namespace Inkstand\ResourceLibraryBundle\Model;

interface ResourceManagerInterface
{
    /**
     * Return all resources
     *
     * @return \Traversable
     */
    public function findAll();

    /**
     * Return resource by criteria
     *
     * @param array $criteria
     * @return ResourceInterface
     */
    public function findOneBy(array $criteria);

    /**
     * Return resources by criteria
     *
     * @param array $criteria
     * @return \Traversable
     */
    public function findBy(array $criteria);

    /**
     * Return new $resource instance
     *
     * @return ResourceInterface
     */
    public function create();

    /**
     * Persist $resource
     *
     * @param ResourceInterface $resource
     */
    public function update(ResourceInterface $resource);

    /**
     * Delete $resource
     *
     * @param ResourceInterface $resource
     */
    public function delete(ResourceInterface $resource);

    /**
     * Return $resource fully qualified class name
     *
     * @return string
     */
    public function getClass();

    /**
     * Build form for $resource
     *
     * @param ResourceInterface $resource
     * @return ResourceInterface
     */
    public function getForm(ResourceInterface $resource);
}