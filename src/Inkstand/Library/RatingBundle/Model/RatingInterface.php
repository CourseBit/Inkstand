<?php

namespace Inkstand\Library\RatingBundle\Model;

use FOS\UserBundle\Model\UserInterface;

/**
 * Model for a user rating.
 *
 * Exmaple: User rates Course XZY 4 out of 5 stars.
 *
 * Ratings values are stored in a 0 - 1 range. Allowing for a flexible presentation. For example: 0.6 can be converted
 * to 3/5 stars. Or 6/10 stars. Or 60/100. Etc. Ratings can be associated with any other entities with a OneToMany
 * relationship.
 *
 * Interface RatingInterface
 * @package Inkstand\Library\RatingBundle\Model
 */
interface RatingInterface
{
    public function getRatingId();
    public function setValue($value);
    public function getValue();
    public function setUserId($userId);
    public function getUserId();
    public function setTitle($title);
    public function getTitle();
    public function setComment($comment);
    public function getComment();
    public function setHelpfulCount($helpfulCount);
    public function getHelpfulCount();
    public function setUnhelpfulCount($unhelpfulCount);
    public function getUnhelpfulCount();
    public function setCreated(\DateTime $created);
    public function getCreated();
    public function setModifed(\DateTime $modifed);
    public function getModifed();
    public function setUser(UserInterface $user = null);
    public function getUser();
}