<?php

namespace Inkstand\ResourceLibraryBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Inkstand\Library\RatingBundle\Model\RateableInterface;
use Inkstand\Library\RatingBundle\Model\RatingInterface;
use Inkstand\Library\TagBundle\Model\TagEntryInterface;
use Inkstand\Library\TagBundle\Model\TaggableInterface;
use Inkstand\ResourceLibraryBundle\Model\ResourceInterface;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Resource
 */
class Resource implements ResourceInterface, RateableInterface//, TaggableInterface
{
    /**
     * @var integer
     */
    private $resourceId;

    /**
     * @var string
     */
    private $name;

    /**
     * @var integer
     */
    private $resourceFileReferenceId;

    /**
     * @var string
     *
     */
    private $description;

    /**
     * @var integer
     *
     */
    private $topicId;

    /**
     * @var integer
     */
    private $ratingId;

    /**
     */
    private $resourceFileReference = null;

    /**
     */
    private $topic;

    /**
     * @var
     */
    private $rating = null;

    /**
     * @var array
     */
    private $tagEntries;

    private $tags;

    // Important
    public function getTag()
    {
        $tags = new ArrayCollection();

        foreach($this->tagEntries as $tagEntry)
        {
            $tags[] = $tagEntry->getTag();
        }

        return $tags;
    }
    // Important
    public function setTag($tags)
    {
        foreach($tags as $tag)
        {
            $tagEntry = new ResourceTagEntry();

            $tagEntry->setResource($this);
            $tagEntry->setResourceId($this->getResourceId());
            $tagEntry->setTag($tag);
            $tagEntry->setTagId($tag->getTagId());

            $this->addTagEntry($tagEntry);
        }

    }

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->tagEntries = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Get resourceId
     *
     * @return integer 
     */
    public function getResourceId()
    {
        return $this->resourceId;
    }

    /**
     * For taggable
     *
     * @return integer
     */
    public function getObjectId()
    {
        return $this->getResourceId();
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Resource
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
     * Set resourceFileReferenceId
     *
     * @param integer $resourceFileReferenceId
     * @return Resource
     */
    public function setResourceFileReferenceId($resourceFileReferenceId)
    {
        $this->resourceFileReferenceId = $resourceFileReferenceId;

        return $this;
    }

    /**
     * Get resourceFileReferenceId
     *
     * @return integer 
     */
    public function getResourceFileReferenceId()
    {
        return $this->resourceFileReferenceId;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Resource
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
     * Set topicId
     *
     * @param integer $topicId
     * @return Resource
     */
    public function setTopicId($topicId)
    {
        $this->topicId = $topicId;

        return $this;
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
     * Set resourceFileReference
     *
     * @param \Inkstand\Bundle\CoreBundle\Entity\FileReference $resourceFileReference
     * @return Resource
     */
    public function setResourceFileReference(\Inkstand\Bundle\CoreBundle\Entity\FileReference $resourceFileReference = null)
    {
        $this->resourceFileReference = $resourceFileReference;

        return $this;
    }

    /**
     * Get resourceFileReference
     *
     * @return \Inkstand\Bundle\CoreBundle\Entity\FileReference 
     */
    public function getResourceFileReference()
    {
        return $this->resourceFileReference;
    }

    /**
     * Set topic
     *
     * @param \Inkstand\ResourceLibraryBundle\Entity\Topic $topic
     * @return Resource
     */
    public function setTopic(\Inkstand\ResourceLibraryBundle\Entity\Topic $topic = null)
    {
        $this->topic = $topic;

        return $this;
    }

    /**
     * Get topic
     *
     * @return \Inkstand\ResourceLibraryBundle\Entity\Topic 
     */
    public function getTopic()
    {
        return $this->topic;
    }

    /**
     * Set ratingId
     *
     * @param integer $ratingId
     * @return Resource
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
     * @return Resource
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

    /**
     * Add tagEntry
     *
     * @param TagEntryInterface $tagEntry
     * @return Resource
     */
    public function addTagEntry($tagEntry)
    {
        $this->tagEntries[] = $tagEntry;

        return $this;
    }

    /**
     * Remove tagEntry
     *
     * @param TagEntryInterface $tagEntry
     */
    public function removeTagEntry($tagEntry)
    {
        $this->tagEntries->removeElement($tagEntry);
    }

    /**
     * Get tagEntries
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getTagEntries()
    {
        return $this->tagEntries;
    }
}
