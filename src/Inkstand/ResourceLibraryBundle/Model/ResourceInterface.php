<?php

namespace Inkstand\ResourceLibraryBundle\Model;

use Inkstand\Library\RatingBundle\Model\RatingInterface;

interface ResourceInterface
{
    /**
     * Get resourceId
     *
     * @return integer
     */
    public function getResourceId();

    /**
     * Set name
     *
     * @param string $name
     * @return Resource
     */
    public function setName($name);

    /**
     * Get name
     *
     * @return string
     */
    public function getName();

    /**
     * Set resourceFileReferenceId
     *
     * @param integer $resourceFileReferenceId
     * @return Resource
     */
    public function setResourceFileReferenceId($resourceFileReferenceId);

    /**
     * Get resourceFileReferenceId
     *
     * @return integer
     */
    public function getResourceFileReferenceId();

    /**
     * Set description
     *
     * @param string $description
     * @return Resource
     */
    public function setDescription($description);

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription();
    /**
     * Set topicId
     *
     * @param integer $topicId
     * @return Resource
     */
    public function setTopicId($topicId);

    /**
     * Get topicId
     *
     * @return integer
     */
    public function getTopicId();

    /**
     * Set resourceFileReference
     *
     * @param \Inkstand\Bundle\CoreBundle\Entity\FileReference $resourceFileReference
     * @return Resource
     */
    public function setResourceFileReference(\Inkstand\Bundle\CoreBundle\Entity\FileReference $resourceFileReference = null);

    /**
     * Get resourceFileReference
     *
     * @return \Inkstand\Bundle\CoreBundle\Entity\FileReference
     */
    public function getResourceFileReference();

    /**
     * Set topic
     *
     * @param \Inkstand\ResourceLibraryBundle\Entity\Topic $topic
     * @return Resource
     */
    public function setTopic(\Inkstand\ResourceLibraryBundle\Entity\Topic $topic = null);

    /**
     * Get topic
     *
     * @return \Inkstand\ResourceLibraryBundle\Entity\Topic
     */
    public function getTopic();

    /**
     * Set ratingId
     *
     * @param integer $ratingId
     * @return Resource
     */
    public function setRatingId($ratingId);

    /**
     * Get ratingId
     *
     * @return integer
     */
    public function getRatingId();

    /**
     * Set rating
     *
     * @param RatingInterface $rating
     * @return Resource
     */
    public function setRating(RatingInterface $rating = null);

    /**
     * Get rating
     *
     * @return RatingInterface
     */
    public function getRating();
}