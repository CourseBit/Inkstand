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
     * @ORM\Column(name="forum_id", type="integer", nullable=true)
     */
    private $forumId;

    /**
     * @var string
     *
     * @ORM\Column(name="locked", type="boolean")
     */
    private $locked;

    /**  
     * @ORM\OneToOne(targetEntity="Forum")
     * @ORM\JoinColumn(name="forum_id", referencedColumnName="preferences_id")
     */
    private $forum;

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
     * Set forumId
     *
     * @param integer $forumId
     * @return ForumPreferences
     */
    public function setForumId($forumId)
    {
        $this->forumId = $forumId;

        return $this;
    }

    /**
     * Get forumId
     *
     * @return integer 
     */
    public function getForumId()
    {
        return $this->forumId;
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
     * Set forum
     *
     * @param \Inkstand\Activity\ForumBundle\Entity\Forum $forum
     * @return ForumPreferences
     */
    public function setForum(\Inkstand\Activity\ForumBundle\Entity\Forum $forum = null)
    {
        $this->forum = $forum;

        return $this;
    }

    /**
     * Get forum
     *
     * @return \Inkstand\Activity\ForumBundle\Entity\Forum 
     */
    public function getForum()
    {
        return $this->forum;
    }
}
