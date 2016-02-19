<?php

namespace Inkstand\ResourceLibraryBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Inkstand\Library\RatingBundle\Model\RateableInterface;
use Inkstand\Library\RatingBundle\Model\RatingInterface;
use Inkstand\Library\TagBundle\Model\TagEntryInterface;
use Inkstand\ResourceLibraryBundle\Model\ResourceInterface;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Resource
 *
 * @ORM\Table("lms_resource")
 * @ORM\Entity
 */
class Resource implements ResourceInterface, RateableInterface
{
    /**
     * @var integer
     *
     * @ORM\Column(name="resource_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $resourceId;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var integer
     *
     * @ORM\Column(name="resource_file_reference_id", type="integer", nullable=true)
     */
    private $resourceFileReferenceId;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text")
     */
    private $description;

    /**
     * @var integer
     *
     * @ORM\Column(name="topic_id", type="integer")
     */
    private $topicId;

    /**
     * @var integer
     *
     * @ORM\Column(name="rating_id", type="integer", nullable=true)
     */
    private $ratingId;

    /**
     * @ORM\ManyToOne(targetEntity="Inkstand\Bundle\CoreBundle\Entity\FileReference", cascade={"persist"})
     * @ORM\JoinColumn(name="resource_file_reference_id", referencedColumnName="file_reference_id", nullable=true)
     */
    private $resourceFileReference = null;

    /**
     * @ORM\ManyToOne(targetEntity="Topic", inversedBy="resources")
     * @ORM\JoinColumn(name="topic_id", referencedColumnName="topic_id")
     */
    private $topic;

    /**
     * @var
     *
     * @ORM\OneToOne(targetEntity="Inkstand\Library\RatingBundle\Entity\Rating", cascade={"remove", "persist"})
     * @ORM\JoinColumn(name="rating_id", referencedColumnName="rating_id", nullable=true)
     */
    private $rating = null;

    /**
     * @var array
     *
     * @ORM\OneToMany(targetEntity="ResourceTagEntry", mappedBy="object", cascade={"persist"})
     */
    private $tagEntries = null;

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
    public function addTagEntry(TagEntryInterface $tagEntry)
    {
        $this->tagEntries[] = $tagEntry;

        return $this;
    }

    /**
     * Remove tagEntry
     *
     * @param TagEntryInterface $tagEntry
     */
    public function removeTagEntry(TagEntryInterface $tagEntry)
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
