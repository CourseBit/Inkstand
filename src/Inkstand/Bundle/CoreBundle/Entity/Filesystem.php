<?php

namespace Inkstand\Bundle\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Filesystem
 *
 * @ORM\Table(name="lms_filesystem")
 * @ORM\Entity
 */
class Filesystem
{
    /**
     * @var integer
     *
     * @ORM\Column(name="filesystem_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $filesystemId;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var
     */
    private $api;


    /**
     * Get filesystemId
     *
     * @return integer 
     */
    public function getFilesystemId()
    {
        return $this->filesystemId;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Filesystem
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
     * Set api
     *
     * @param string $api
     * @return Filesystem
     */
    public function setApi($api)
    {
        $this->api = $api;

        return $this;
    }

    /**
     * Get api
     *
     * @return string
     */
    public function getApi()
    {
        return $this->api;
    }
}
