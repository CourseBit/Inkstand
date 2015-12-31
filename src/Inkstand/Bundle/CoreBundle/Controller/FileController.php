<?php

namespace Inkstand\Bundle\CoreBundle\Controller;

use Inkstand\Bundle\CoreBundle\Entity\Filesystem;
use Inkstand\Bundle\CoreBundle\Service\FilesystemService;
use Symfony\Bundle\FrameworkBundle\Controller\Controller as Controller2;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class FileController extends Controller2
{
    /**
     * @Route("/file/get-filesystems", name="inkstand_core_file_get_file_system")
     */
    public function getFilesystemsAction()
    {
        /* @var $filesystemService FilesystemService */
        $filesystemService = $this->get('inkstand_core.filesystem');
        $filesystems = $filesystemService->findAll();

        $filesystemsArray = array();

        /* @var $filesystem Filesystem */
        foreach($filesystems as $filesystem) {
            $filesystemsArray[] = array(
                'filesystemId' => $filesystem->getFilesystemId(),
                'contents' => $this->get(sprintf('oneup_flysystem.%s_filesystem', $filesystem->getName()))->listContents("/", true),
                'name' => $filesystem->getName(),
                'currentDir' => ''
            );
        }

        return new JsonResponse($filesystemsArray);
    }

    /**
     * @Route("/file/upload", name="inkstand_core_file_upload")
     * @param $request
     * @return JsonResponse
     */
    public function uploadAction(Request $request)
    {
        /* @var $file \Symfony\Component\HttpFoundation\File\UploadedFile */
        $file = $request->files->get('file');

        $path = $request->get('currentDir');
        $filesystemName = $request->get('filesystemName');

        $filesystem = $this->get(sprintf('oneup_flysystem.%s_filesystem', $filesystemName));

        if ($file->isValid()) {
            $stream = fopen($file->getRealPath(), 'r+');

//            if($filesystem->has($file->getClientOriginalName())) {
//                $i = 2;
//                while(true) {
//
//                }
//            }


            if(!empty($path)) {
                $filePath = $path . "/" . $file->getClientOriginalName();
            } else {
                $filePath = $file->getClientOriginalName();
            }

            $filesystem->writeStream($filePath, $stream);
            fclose($stream);
        }

        return new JsonResponse(array('allgood'));
    }

    /**
     * @Route("/file/new-folder", name="inkstand_core_new_folder")
     * @param $request
     * @return JsonResponse
     */
    public function newFolderAction(Request $request)
    {
        $dir = $request->get('dir');
        $filesystemName = $request->get('filesystemName');
        $filesystem = $this->get(sprintf('oneup_flysystem.%s_filesystem', $filesystemName));

        if(!$filesystem->has($dir)) {
            $filesystem->createDir($dir);
        }

        return new JsonResponse(array('allgood' => $dir));
    }

    /**
     * @Route("/file/download", name="inkstand_core_file_download")
     * @param Request $request
     * @return Response
     */
    public function downloadAction(Request $request)
    {
        $filesystem = $this->get('oneup_flysystem.inkstand_filesystem');

        $fileContents = $filesystem->read('airplanevsvolcano.png');

        return new Response($fileContents, 200, array('Content-Type' => 'image/png'));
    }
}