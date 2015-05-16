<?php

namespace Inkstand\Activity\ForumBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ForumPreferences
 *
 * @ORM\Table(name="forum_preferences")
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
     * Get forumPreferencesId
     *
     * @return integer 
     */
    public function getForumPreferencesId()
    {
        return $this->forumPreferencesId;
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
}
