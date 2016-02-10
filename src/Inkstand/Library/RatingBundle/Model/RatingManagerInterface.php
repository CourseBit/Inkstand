<?php

namespace Inkstand\Library\RatingBundle\Model;

use FOS\UserBundle\Model\UserInterface;
use Symfony\Component\Form\Extension\Core\Type\FormType;

/**
 * Interface to be implemented by rating managers. This adds an additional level
 * of abstraction between your application, and the actual repository.
 *
 * All changes to ratings should happen through this interface.
 *
 * @author Joseph Conradt <joseph.conradt@coursebit.net>
 */
interface RatingManagerInterface
{
    /**
     * Return all ratings
     *
     * @return \Traversable
     */
    public function findAll();

    /**
     * Return rating by criteria
     *
     * @param array $criteria
     * @return RatingInterface
     */
    public function findOneBy(array $criteria);

    /**
     * Return rating by criteria
     *
     * @param array $criteria
     * @return \Traversable
     */
    public function findBy(array $criteria);

    /**
     * Return new rating instance
     *
     * @return RatingInterface
     */
    public function create();

    /**
     * Persist rating
     *
     * @param RatingInterface $rating
     */
    public function update(RatingInterface $rating);

    /**
     * Delete rating
     *
     * @param RatingInterface $rating
     */
    public function delete(RatingInterface $rating);

    /**
     * Return rating fully qualified class name
     *
     * @return string
     */
    public function getClass();

    /**
     * Calculate and return the rating average for all user reviews belonging to rating
     *
     * @param RateableInterface $rateable
     * @return float
     */
    public function getOverallRating(RateableInterface $rateable);
}