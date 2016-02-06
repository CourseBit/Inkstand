<?php

namespace Inkstand\Library\RatingBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Model\UserInterface;
use Inkstand\Library\RatingBundle\Model\RatingInterface;

/**
 * Rating
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
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="comment", type="text")
     */
    private $comment;

    /**
     * @var integer
     *
     * @ORM\Column(name="helpful_count", type="integer")
     */
    private $helpfulCount;

    /**
     * @var integer
     *
     * @ORM\Column(name="unhelpful_count", type="integer")
     */
    private $unhelpfulCount;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created", type="datetime")
     */
    private $created;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="modifed", type="datetime")
     */
    private $modifed;

    /**
     * @ORM\ManyToOne(targetEntity="Inkstand/Bundle/UserBundle/Entity/User")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $user;

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
     * Set value
     *
     * @param float $value
     * @return Rating
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
     * @return Rating
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
     * @return Rating
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
     * @return Rating
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
     * @return Rating
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
     * @return Rating
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
     * @return Rating
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
     * Set modifed
     *
     * @param \DateTime $modifed
     * @return Rating
     */
    public function setModifed(\DateTime $modifed)
    {
        $this->modifed = $modifed;

        return $this;
    }

    /**
     * Get modifed
     *
     * @return \DateTime 
     */
    public function getModifed()
    {
        return $this->modifed;
    }

    /**
     * Set user
     *
     * @param UserInterface $user
     * @return Rating
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
}
