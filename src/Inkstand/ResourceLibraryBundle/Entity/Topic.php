<?php

namespace Inkstand\ResourceLibraryBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Inkstand\ResourceLibraryBundle\Model\ResourceInterface;
use Inkstand\ResourceLibraryBundle\Model\TopicInterface;

/**
 * Topic
 *
 * @ORM\Table("lms_resource_topic")
 * @ORM\Entity
 */
class Topic implements TopicInterface
{
    /**
     * @var integer
     *
     * @ORM\Column(name="topic_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $topicId;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text")
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="excerpt", type="text")
     */
    private $excerpt;

    /**
     * @var integer
     */
    private $state = 2;

    /**
     * @var bool
     */
    private $showInLibrary = 1;

    private $thumbnailFileReferenceId;

    private $thumbnailFileReference;

    private $resources;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->resources = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Get topicId
     *
     * @return integer 
     */
    public function getTopicId()
    {
        return $this->topicId;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Topic
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Topic
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set excerpt
     *
     * @param string $excerpt
     * @return Topic
     */
    public function setExcerpt($excerpt)
    {
        $this->excerpt = $excerpt;

        return $this;
    }

    /**
     * Get excerpt
     *
     * @return string
     */
    public function getExcerpt()
    {
        return $this->excerpt;
    }

    /**
     * Set state
     *
     * @param string $state
     * @return Topic
     */
    public function setState($state)
    {
        $this->state = $state;

        return $this;
    }

    /**
     * Get state
     *
     * @return string
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * Set showInLibrary
     *
     * @param string $showInLibrary
     * @return Topic
     */
    public function setShowInLibrary($showInLibrary)
    {
        $this->showInLibrary = $showInLibrary;

        return $this;
    }

    /**
     * Get showInLibrary
     *
     * @return string
     */
    public function getShowInLibrary()
    {
        return $this->showInLibrary;
    }

    /**
     * Add resources
     *
     * @param ResourceInterface $resources
     * @return Topic
     */
    public function addResource(ResourceInterface $resources)
    {
        $this->resources[] = $resources;

        return $this;
    }

    /**
     * Remove resource
     *
     * @param ResourceInterface $resource
     */
    public function removeResource(ResourceInterface $resource)
    {
        $this->resources->removeElement($resource);
    }

    /**
     * Get resources
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getResources()
    {
        return $this->resources;
    }

    /**
     * Set thumbnailFileReferenceId
     *
     * @param integer $thumbnailFileReferenceId
     * @return Topic
     */
    public function setThumbnailFileReferenceId($thumbnailFileReferenceId)
    {
        $this->thumbnailFileReferenceId = $thumbnailFileReferenceId;

        return $this;
    }

    /**
     * Get thumbnailFileReferenceId
     *
     * @return integer 
     */
    public function getThumbnailFileReferenceId()
    {
        return $this->thumbnailFileReferenceId;
    }

    /**
     * Set thumbnailFileReference
     *
     * @param \Inkstand\Bundle\CoreBundle\Entity\FileReference $thumbnailFileReference
     * @return Topic
     */
    public function setThumbnailFileReference(\Inkstand\Bundle\CoreBundle\Entity\FileReference $thumbnailFileReference = null)
    {
        $this->thumbnailFileReference = $thumbnailFileReference;

        return $this;
    }

    /**
     * Get thumbnailFileReference
     *
     * @return \Inkstand\Bundle\CoreBundle\Entity\FileReference 
     */
    public function getThumbnailFileReference()
    {
        return $this->thumbnailFileReference;
    }
}
