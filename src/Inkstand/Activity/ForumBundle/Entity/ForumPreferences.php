<?php

namespace Inkstand\Activity\ForumBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ForumPreferences
 *
 * @ORM\Table(name="lms_forum_preferences")
 * @ORM\Entity
 */
class ForumPreferences
{
    /**
     * @var integer
     *
     * @ORM\Column(name="forum_preferences_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $forumPreferencesId;

    /**
     * @var integer
     *
     * @ORM\Column(name="activity_id", type="integer")
     */
    private $activityId;

    /**
     * @var string
     *
     * @ORM\Column(name="locked", type="boolean")
     */
    private $locked;

    /**
     * @var string
     *
     * @ORM\Column(name="one_discussion_per_user", type="boolean")
     */
    private $oneDiscussionPerUser;

    /**
     * @var string
     *
     * @ORM\Column(name="forum_type", type="string")
     */
    private $forumType;

    /**
     * Get forumPreferencesId
     *
     * @return integer 
     */
    public function getForumPreferencesId()
    {
        return $this->forumPreferencesId;
    }

    /**
     * Set activityId
     *
     * @param integer $activityId
     * @return ForumPreferences
     */
    public function setActivityId($activityId)
    {
        $this->activityId = $activityId;

        return $this;
    }

    /**
     * Get activityId
     *
     * @return integer 
     */
    public function getActivityId()
    {
        return $this->activityId;
    }

    /**
     * Set locked
     *
     * @param boolean $locked
     * @return ForumPreferences
     */
    public function setLocked($locked)
    {
        $this->locked = $locked;

        return $this;
    }

    /**
     * Get locked
     *
     * @return boolean 
     */
    public function getLocked()
    {
        return $this->locked;
    }

    /**
     * Set oneDiscussionPerUser
     *
     * @param boolean $oneDiscussionPerUser
     * @return ForumPreferences
     */
    public function setOneDiscussionPerUser($oneDiscussionPerUser)
    {
        $this->oneDiscussionPerUser = $oneDiscussionPerUser;

        return $this;
    }

    /**
     * Get oneDiscussionPerUser
     *
     * @return boolean 
     */
    public function getOneDiscussionPerUser()
    {
        return $this->oneDiscussionPerUser;
    }

    /**
     * Set forumType
     *
     * @param string $forumType
     * @return ForumPreferences
     */
    public function setForumType($forumType)
    {
        $this->forumType = $forumType;

        return $this;
    }

    /**
     * Get forumType
     *
     * @return string 
     */
    public function getForumType()
    {
        return $this->forumType;
    }
}
