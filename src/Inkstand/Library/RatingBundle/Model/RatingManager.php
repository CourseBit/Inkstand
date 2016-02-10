<?php

namespace Inkstand\Library\RatingBundle\Model;

use FOS\UserBundle\Model\UserInterface;
use Inkstand\Library\RatingBundle\Form\Type\UserReviewType;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\FormFactoryInterface;

/**
 * Abstract User Review Manager implementation which can be used as base class for your
 * concrete manager.
 *
 * @author Joseph Conradt <joseph.conradt@coursebit.net>
 */
abstract class RatingManager implements RatingManagerInterface
{
    /**
     * @var FormFactoryInterface
     */
    private $formFactory;

    /**
     * @var UserReviewManagerInterface
     */
    private $userReviewManager;

    /**
     * @param UserReviewManagerInterface $userReviewManager
     * @param FormFactoryInterface $formFactory
     */
    public function __construct(UserReviewManagerInterface $userReviewManager, FormFactoryInterface $formFactory)
    {
        $this->formFactory = $formFactory;
        $this->userReviewManager = $userReviewManager;
    }

    /**
     * Return new rating instance
     *
     * @return RatingInterface
     */
    public function create()
    {
        $class = $this->getClass();
        return new $class;
    }

    /**
     * Calculate and return the rating average for all user reviews belonging to rating
     *
     * @param RateableInterface $rateable
     * @return float
     */
    public function getOverallRating(RateableInterface $rateable)
    {
        $total = 0;
        $count = 0;
        $overallRating = 0;

        $rating = $rateable->getRating();

        if(null === $rating) {
            return 0;
        }

        $userReviews = $rating->getUserReviews();

        if(empty($userReviews)) {
            return 0;
        }

        /** @var UserReviewInterface $userReview */
        foreach($userReviews as $userReview) {
            $total += $userReview->getValue();
            $count++;
        }

        if($count > 0) {
            $overallRating = round($total / $count, 2);
        }
        return $overallRating;
    }
}