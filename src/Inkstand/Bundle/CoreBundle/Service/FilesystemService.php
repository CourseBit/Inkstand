<?php

namespace Inkstand\Bundle\CoreBundle\Service;

use Inkstand\Bundle\CoreBundle\Entity\Filesystem;
use Inkstand\Bundle\CoreBundle\Entity\FileReference;
use Symfony\Component\DependencyInjection\ContainerAware;

class FilesystemService extends ContainerAware
{
    protected $entityManager;
    protected $repository;

    private $filesystemServiceTemplate = 'oneup_flysystem.%s_filesystem';

    public function __construct($entityManager)
    {
        $this->entityManager = $entityManager;
        $this->repository = $this->entityManager->getRepository('InkstandCoreBundle:Filesystem');
    }

    public function findAll()
    {
        $filesystems = $this->repository->findAll();

        /* @var $filesystem Filesystem */
        foreach($filesystems as &$filesystem) {
            $filesystem->setApi($this->getApi($filesystem));
        }

        return $filesystems;
    }

    public function findOneByFilesystemId($filesystemId)
    {
        /* @var $filesystem Filesystem */
        $filesystem = $this->repository->findOneByFilesystemId($filesystemId);
        $filesystem->setApi($this->getApi($filesystem));
        return $filesystem;
    }

    /**
     * Get the Filesystem associated with a FileReference
     *
     * @param FileReference $fileReference
     * @return mixed
     */
    public function getFilesystemByFileReference(FileReference $fileReference)
    {
        return $this->findOneByFilesystemId($fileReference->getFilesystemId());
    }

    /**
     * Get filesystem API for Filesystem
     *
     * @param Filesystem $filesystem
     * @return object
     */
    public function getApi(Filesystem $filesystem)
    {
        if($this->container->has(sprintf($this->filesystemServiceTemplate, $filesystem->getName()))) {
            return $this->container->get(sprintf($this->filesystemServiceTemplate, $filesystem->getName()));
        }
    }
}
