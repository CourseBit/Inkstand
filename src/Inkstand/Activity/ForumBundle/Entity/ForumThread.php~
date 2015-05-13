<?php

namespace Inkstand\Activity\ForumBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ForumThread
 *
 * @ORM\Table(name="forum_thread")
 * @ORM\Entity
 */
class ForumThread
{
    /**
     * @var integer
     *
     * @ORM\Column(name="forum_thread_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $forumThreadId;

    /**
     * @var integer
     *
     * @ORM\Column(name="forumId", type="integer")
     */
    private $forumId;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="body", type="text")
     */
    private $body;

    /**
     * @ORM\ManyToOne(targetEntity="Forum", inversedBy="forumThreads")
     * @ORM\JoinColumn(name="forum_id", referencedColumnName="activity_id")
     */
    private $forum;


    /**
     * Get forumThreadId
     *
     * @return integer 
     */
    public function getForumThreadId()
    {
        return $this->forumThreadId;
    }

    /**
     * Set forumId
     *
     * @param integer $forumId
     * @return ForumThread
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
     * Set title
     *
     * @param string $title
     * @return ForumThread
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
     * Set body
     *
     * @param string $body
     * @return ForumThread
     */
    public function setBody($body)
    {
        $this->body = $body;

        return $this;
    }

    /**
     * Get body
     *
     * @return string 
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * Set forum
     *
     * @param \Inkstand\Activity\ForumBundle\Entity\Forum $forum
     * @return ForumThread
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
