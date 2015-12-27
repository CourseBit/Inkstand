<?php

namespace Inkstand\Bundle\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller as Controller2;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\JsonResponse;

class FileController extends Controller2
{
    /**
     * @Route("/file/get-file-system", name="inkstand_core_file_get_file_system")
     */
    public function getFileSystemAction()
    {
        $filesystem = $this->get('oneup_flysystem.inkstand_filesystem');
        $contents = $filesystem->listContents();

        return new JsonResponse($contents);
    }
}