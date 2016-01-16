<?php

namespace Inkstand\Activity\ScormBundle\Service;

use Inkstand\Activity\ScormBundle\Form\Type\ScormPreferencesType;
use Inkstand\Activity\ScormBundle\Entity\Scorm;
use Inkstand\Activity\ScormBundle\Entity\ScormPreferences;
use Inkstand\Bundle\CoreBundle\Entity\FileReference;
use Inkstand\Bundle\CoreBundle\Service\FilesystemService;
use Inkstand\Bundle\CoreBundle\Entity\Filesystem;
use Symfony\Component\Filesystem\Filesystem as SFilesystem;

class ScormService
{
    /**
     * @var FilesystemService
     */
    private $filesystemService;
    private $cacheDir;

    /**
     * @param $filesystemService FilesystemService
     * @param $cacheDir string Symfony cache directory path
     */
    public function __construct($filesystemService, $cacheDir)
    {
        $this->filesystemService = $filesystemService;
        $this->cacheDir = $cacheDir;
    }

    public function getNewEntity()
    {
        return new Scorm();
    }

    public function getNewPreferences()
    {
        return new ScormPreferences();
    }

    public function getPreferencesFormType()
    {
        return new ScormPreferencesType();
    }

    public function getController()
    {
        return 'InkstandScormBundle:Scorm';
    }

    public function cacheScormPackage(FileReference $fileReference)
    {
        /* @var $filesystem Filesystem */
        $filesystem = $this->filesystemService->getFilesystemByFileReference($fileReference);

        $sourcePathInfo = pathinfo($fileReference->getPath());

        $scormCachePath = sprintf('%s/scorm/%s', $this->cacheDir, $sourcePathInfo['filename']);

        $destinationFile = sprintf('%s/%s', $scormCachePath, $sourcePathInfo['basename']);

        // Symfony Filesystem component
        $sFilesystem = new SFilesystem();

        // For now, remove all existing files
        if(file_exists($scormCachePath)) {
            $sFilesystem->remove($scormCachePath);
        }

        $sFilesystem->mkdir($scormCachePath);

        $sourceStream = $filesystem->getApi()->readStream($fileReference->getPath());
        $destinationStream = fopen($destinationFile, 'w');

        while(!feof($sourceStream)) {
            $buffer = fread($sourceStream, 512);  // use a buffer of 512 bytes
            fwrite($destinationStream, $buffer);
        }

        $zip = new \ZipArchive();
        $zip->open($destinationFile);
        $zip->extractTo($scormCachePath);
        $zip->close();

        $zip = null;

        $sFilesystem->chmod($destinationFile, '0600');

        $sFilesystem->remove($destinationFile);
    }
}