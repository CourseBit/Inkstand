<?php

namespace Inkstand\ResourceLibraryBundle\Model;

use Inkstand\Bundle\UserBundle\Entity\User;
use Inkstand\ResourceLibraryBundle\Model\ResourceInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormTypeInterface;

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
     * @param $resourceId
     * @return mixed
     */
    public function findOneByResourceId($resourceId);

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
     * Persist resource and any related tags in form
     *
     * @param ResourceInterface $resource
     * @param FormTypeInterface $form
     */
    public function updateWithForm(ResourceInterface $resource, FormInterface $form);

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

    /**
     * Get form for changing grid columns
     *
     * @param string $actionUrl
     * @param User $user
     * @return FormInterface
     */
    public function getGridColumnsForm($actionUrl, User $user);
}