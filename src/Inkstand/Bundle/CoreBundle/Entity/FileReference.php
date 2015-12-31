<?php

namespace Inkstand\Bundle\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * FileReference
 *
 * @ORM\Table(name="lms_file_reference")
 * @ORM\Entity(repositoryClass="Inkstand\Bundle\CoreBundle\Entity\FileReferenceRepository")
 */
class FileReference
{
    /**
     * @var integer
     *
     * @ORM\Column(name="file_reference_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $fileReferenceId;

    /**
     * @var integer
     *
     * @ORM\Column(name="filesystem_id", type="integer")
     */
    private $filesystemId;

    /**
     * @var string
     *
     * @ORM\Column(name="path", type="string", length=255)
     */
    private $path;


    /**
     * Get fileReferenceId
     *
     * @return integer 
     */
    public function getFileReferenceId()
    {
        return $this->fileReferenceId;
    }

    /**
     * Set filesystemId
     *
     * @param integer $filesystemId
     * @return FileReference
     */
    public function setFilesystemId($filesystemId)
    {
        $this->filesystemId = $filesystemId;

        return $this;
    }

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
     * Set path
     *
     * @param string $path
     * @return FileReference
     */
    public function setPath($path)
    {
        $this->path = $path;

        return $this;
    }

    /**
     * Get path
     *
     * @return string 
     */
    public function getPath()
    {
        return $this->path;
    }
}
