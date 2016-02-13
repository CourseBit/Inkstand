<?php

namespace Inkstand\ResourceLibraryBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
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
}
