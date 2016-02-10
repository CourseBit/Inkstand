<?php

namespace Inkstand\Library\RatingBundle\Model;

/**
 * Link between an object and a set of UserReviews
 *
 * Interface RatingReferenceInterface
 * @package Inkstand\Library\RatingBundle\Model
 */
interface RatingInterface
{
    public function getRatingId();
    public function addUserReview(UserReviewInterface $userReview);
    public function removeUserReview(UserReviewInterface $userReview);
    public function getUserReviews();
}