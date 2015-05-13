<?php

namespace Inkstand\Activity\ForumBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

use Inkstand\Bundle\CourseBundle\Entity\Activity;

/**
 * Activity
 *
 * @ORM\Table(name="activity")
 * @ORM\Entity(repositoryClass="Inkstand\Bundle\CourseBundle\Entity\ActivityRepository")
 */
class Forum extends Activity
{
    /**
     * @ORM\OneToMany(targetEntity="ForumThread", mappedBy="forum")
     */
    protected $forumThreads;
    
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->forumThreads = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add forumThreads
     *
     * @param \Inkstand\Activity\ForumBundle\Entity\ForumThread $forumThreads
     * @return Forum
     */
    public function addForumThread(\Inkstand\Activity\ForumBundle\Entity\ForumThread $forumThreads)
    {
        $this->forumThreads[] = $forumThreads;

        return $this;
    }

    /**
     * Remove forumThreads
     *
     * @param \Inkstand\Activity\ForumBundle\Entity\ForumThread $forumThreads
     */
    public function removeForumThread(\Inkstand\Activity\ForumBundle\Entity\ForumThread $forumThreads)
    {
        $this->forumThreads->removeElement($forumThreads);
    }

    /**
     * Get forumThreads
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getForumThreads()
    {
        return $this->forumThreads;
    }
}
