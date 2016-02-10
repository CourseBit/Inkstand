<?php

namespace Inkstand\Library\RatingBundle\Model;
use FOS\UserBundle\Model\UserInterface;
use Symfony\Component\Form\Extension\Core\Type\FormType;

/**
 * Interface to be implemented by user review managers. This adds an additional level
 * of abstraction between your application, and the actual repository.
 *
 * All changes to user reviews should happen through this interface.
 *
 * @author Joseph Conradt <joseph.conradt@coursebit.net>
 */
interface UserReviewManagerInterface
{
    /**
     * Return all user reviews
     *
     * @return \Traversable
     */
    public function findAll();

    /**
     * Return user review by criteria
     *
     * @param array $criteria
     * @return UserReviewInterface
     */
    public function findOneBy(array $criteria);

    /**
     * Return user reviews by criteria
     *
     * @param array $criteria
     * @return \Traversable
     */
    public function findBy(array $criteria);

    /**
     * Return new user review instance
     *
     * @return UserReviewInterface
     */
    public function create();

    /**
     * Persist user review
     *
     * @param UserReviewInterface $userReview
     */
    public function update(UserReviewInterface $userReview);

    /**
     * Delete user review
     *
     * @param UserReviewInterface $userReview
     */
    public function delete(UserReviewInterface $userReview);

    /**
     * Return user review fully qualified class name
     *
     * @return string
     */
    public function getClass();

    /**
     * Build form for user to submit review based on rating and user
     *
     * @param UserReviewInterface $userReview
     * @return FormType
     */
    public function getForm(UserReviewInterface $userReview);
}