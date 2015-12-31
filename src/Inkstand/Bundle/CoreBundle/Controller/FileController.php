<?php

namespace Inkstand\Bundle\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller as Controller2;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class FileController extends Controller2
{
    /**
     * @Route("/file/get-file-system", name="inkstand_core_file_get_file_system")
     */
    public function getFileSystemAction()
    {
        $filesystem = $this->get('oneup_flysystem.inkstand_filesystem');
        $contents = $filesystem->listContents("/", true);
        return new JsonResponse($contents);
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

        $filesystem = $this->get('oneup_flysystem.inkstand_filesystem');

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
        $dir = $request->get("dir");
        $filesystem = $this->get('oneup_flysystem.inkstand_filesystem');

        if(!$filesystem->has($dir)) {
            $filesystem->createDir($dir);
        }

        return new JsonResponse(array('allgood' => $dir));
    }
}