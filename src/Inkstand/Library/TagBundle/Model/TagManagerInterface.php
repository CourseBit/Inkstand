<?php

namespace Inkstand\Library\TagBundle\Model;

use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\FormTypeInterface;

interface TagManagerInterface
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
     * Return tag by code
     *
     * @param $code
     * @return TagInterface
     */
    public function findOneByCode($code);

    /**
     * Return tags by criteria
     *
     * @param array $criteria
     * @return \Traversable
     */
    public function findBy(array $criteria);

    /**
     * Get tag options for form choices
     *
     * @return array
     */
    public function getOptions();

    /**
     * Return new tag instance
     *
     * @return TagInterface
     */
    public function create();

    /**
     * Persist tag
     *
     * @param TagInterface $userReview
     */
    public function update(TagInterface $userReview);

    /**
     * Delete tag
     *
     * @param TagInterface $userReview
     */
    public function delete(TagInterface $userReview);

    /**
     * Return tag fully qualified class name
     *
     * @return string
     */
    public function getClass();

    /**
     * Build form for tag
     *
     * @param TagInterface $tag
     * @return FormTypeInterface
     */
    public function getForm(TagInterface $tag);
}