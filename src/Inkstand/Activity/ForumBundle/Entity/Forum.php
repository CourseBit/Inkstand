<?php

namespace Inkstand\Activity\ForumBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

use Inkstand\Bundle\CourseBundle\Entity\Activity;

/**
 * Forum
 *
 * @ORM\Table(name="activity")
 * @ORM\Entity(repositoryClass="Inkstand\Bundle\CourseBundle\Entity\ActivityRepository")
 */
class Forum extends Activity
{
    /**
     * @ORM\OneToMany(targetEntity="ForumDiscussion", mappedBy="forum")
     */
    protected $forumDiscussions;

    /**
     * @var \Inkstand\Bundle\CourseBundle\Entity\ActivityType
     */
    protected $activityType;

    /**  
     * @ORM\OneToOne(targetEntity="ForumPreferences")
     * @ORM\JoinColumn(name="preferences_id", referencedColumnName="forum_preferences_id")
     */
    private $forumPreferences;
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->forumDiscussions = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add forumDiscussions
     *
     * @param \Inkstand\Activity\ForumBundle\Entity\ForumDiscussion $forumDiscussions
     * @return Forum
     */
    public function addForumDiscussion(\Inkstand\Activity\ForumBundle\Entity\ForumDiscussion $forumDiscussions)
    {
        $this->forumDiscussions[] = $forumDiscussions;

        return $this;
    }

    /**
     * Remove forumDiscussions
     *
     * @param \Inkstand\Activity\ForumBundle\Entity\ForumDiscussion $forumDiscussions
     */
    public function removeForumDiscussion(\Inkstand\Activity\ForumBundle\Entity\ForumDiscussion $forumDiscussions)
    {
        $this->forumDiscussions->removeElement($forumDiscussions);
    }

    /**
     * Get forumDiscussions
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getForumDiscussions()
    {
        return $this->forumDiscussions;
    }

    /**
     * Set forumPreferences
     *
     * @param \Inkstand\Activity\ForumBundle\Entity\ForumPreferences $forumPreferences
     * @return Forum
     */
    public function setForumPreferences(\Inkstand\Activity\ForumBundle\Entity\ForumPreferences $forumPreferences = null)
    {
        $this->forumPreferences = $forumPreferences;

        return $this;
    }

    /**
     * Get forumPreferences
     *
     * @return \Inkstand\Activity\ForumBundle\Entity\ForumPreferences 
     */
    public function getForumPreferences()
    {
        return $this->forumPreferences;
    }
}
