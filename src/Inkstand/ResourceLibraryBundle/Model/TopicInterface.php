<?php

namespace Inkstand\ResourceLibraryBundle\Model;

interface TopicInterface
{
    /**
     * Get topicId
     *
     * @return integer
     */
    public function getTopicId();

    /**
     * Set name
     *
     * @param string $name
     * @return Topic
     */
    public function setName($name);

    /**
     * Get name
     *
     * @return string
     */
    public function getName();

    /**
     * Set description
     *
     * @param string $description
     * @return Topic
     */
    public function setDescription($description);

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription();
}