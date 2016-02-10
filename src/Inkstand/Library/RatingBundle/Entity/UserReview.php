<?php

namespace Inkstand\Library\RatingBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Model\UserInterface;
use Inkstand\Library\RatingBundle\Model\RatingInterface;
use Inkstand\Library\RatingBundle\Model\UserReviewInterface;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Rating
 *
 * @ORM\Table("lib_user_review")
 * @ORM\Entity
 */
class UserReview implements UserReviewInterface
{
    /**
     * @var integer
     *
     * @ORM\Column(name="user_review_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $userReviewId;

    /**
     * @var integer
     *
     * @ORM\Column(name="rating_id", type="integer")
     */
    private $ratingId;

    /**
     * @var float
     *
     * @ORM\Column(name="value", type="float")
     */
    private $value;

    /**
     * @var integer
     *
     * @ORM\Column(name="user_id", type="integer")
     */
    private $userId;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255, nullable=true)
     */
    private $title = null;

    /**
     * @var string
     *
     * @ORM\Column(name="comment", type="text", nullable=true)
     */
    private $comment = null;

    /**
     * @var integer
     *
     * @ORM\Column(name="helpful_count", type="integer")
     */
    private $helpfulCount = 0;

    /**
     * @var integer
     *
     * @ORM\Column(name="unhelpful_count", type="integer")
     */
    private $unhelpfulCount = 0;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created", type="datetime")
     */
    private $created;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="modified", type="datetime")
     */
    private $modified;

    /**
     * @ORM\ManyToOne(targetEntity="Inkstand\Bundle\UserBundle\Entity\User")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity="Rating", inversedBy="userReviews")
     * @ORM\JoinColumn(name="rating_id", referencedColumnName="rating_id")
     */
    private $rating;

    /**
     * Get userReviewId
     *
     * @return integer 
     */
    public function getUserReviewId()
    {
        return $this->userReviewId;
    }

    /**
     * Set value
     *
     * @param float $value
     * @return UserReview
     */
    public function setValue($value)
    {
        if($value < 0 || $value > 1) {
            throw new \LogicException(sprintf('Rating value must be between 0 and 1 inclusively. %s given.', $value));
        }
        $this->value = $value;

        return $this;
    }

    /**
     * Get value
     *
     * @return float 
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Set userId
     *
     * @param integer $userId
     * @return UserReview
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;

        return $this;
    }

    /**
     * Get userId
     *
     * @return integer 
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * Set title
     *
     * @param string $title
     * @return UserReview
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string 
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set comment
     *
     * @param string $comment
     * @return UserReview
     */
    public function setComment($comment)
    {
        $this->comment = $comment;

        return $this;
    }

    /**
     * Get comment
     *
     * @return string 
     */
    public function getComment()
    {
        return $this->comment;
    }

    /**
     * Set helpfulCount
     *
     * @param integer $helpfulCount
     * @return UserReview
     */
    public function setHelpfulCount($helpfulCount)
    {
        $this->helpfulCount = $helpfulCount;

        return $this;
    }

    /**
     * Get helpfulCount
     *
     * @return integer 
     */
    public function getHelpfulCount()
    {
        return $this->helpfulCount;
    }

    /**
     * Set unhelpfulCount
     *
     * @param integer $unhelpfulCount
     * @return UserReview
     */
    public function setUnhelpfulCount($unhelpfulCount)
    {
        $this->unhelpfulCount = $unhelpfulCount;

        return $this;
    }

    /**
     * Get unhelpfulCount
     *
     * @return integer 
     */
    public function getUnhelpfulCount()
    {
        return $this->unhelpfulCount;
    }

    /**
     * Set created
     *
     * @param \DateTime $created
     * @return UserReview
     */
    public function setCreated(\DateTime $created)
    {
        $this->created = $created;

        return $this;
    }

    /**
     * Get created
     *
     * @return \DateTime 
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * Set modified
     *
     * @param \DateTime $modified
     * @return UserReview
     */
    public function setModified(\DateTime $modified)
    {
        $this->modified = $modified;

        return $this;
    }

    /**
     * Get modified
     *
     * @return \DateTime 
     */
    public function getModified()
    {
        return $this->modified;
    }

    /**
     * Set user
     *
     * @param UserInterface $user
     * @return UserReview
     */
    public function setUser(UserInterface $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return UserInterface
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set ratingId
     *
     * @param integer $ratingId
     * @return UserReview
     */
    public function setRatingId($ratingId)
    {
        $this->ratingId = $ratingId;

        return $this;
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
     * Set rating
     *
     * @param RatingInterface $rating
     * @return UserReview
     */
    public function setRating(RatingInterface $rating = null)
    {
        $this->rating = $rating;

        return $this;
    }

    /**
     * Get rating
     *
     * @return RatingInterface
     */
    public function getRating()
    {
        return $this->rating;
    }
}
