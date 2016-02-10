<?php

namespace Inkstand\Library\RatingBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Inkstand\Library\RatingBundle\Model\RatingInterface;
use Inkstand\Library\RatingBundle\Model\UserReviewInterface;

/**
 * RatingReference
 *
 * @ORM\Table("lib_rating")
 * @ORM\Entity
 */
class Rating implements RatingInterface
{
    /**
     * @var integer
     *
     * @ORM\Column(name="rating_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $ratingId;

    /**
     * @ORM\OneToMany(targetEntity="UserReview", mappedBy="rating", cascade={"persist"})
     */
    private $userReviews;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->userReviews = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Get ratingId
     *
     * @return integer 
     */
    public function getRatingId()
    {
        return $this->ratingId;
    }

    /**
     * Add userReviews
     *
     * @param UserReviewInterface $userReview
     * @return Rating
     */
    public function addUserReview(UserReviewInterface $userReview)
    {
        $this->userReviews[] = $userReview;

        return $this;
    }

    /**
     * Remove userReviews
     *
     * @param UserReviewInterface $userReview
     */
    public function removeUserReview(UserReviewInterface $userReview)
    {
        $this->userReviews->removeElement($userReview);
    }

    /**
     * Get userReviews
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getUserReviews()
    {
        return $this->userReviews;
    }
}
