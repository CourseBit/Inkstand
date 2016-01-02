<?php

namespace Inkstand\Activity\ScormBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ScormController extends Controller
{
    /**
     * @Route("/scorm/file/{relativePath}", name="inkstand_scorm_file", requirements={"relativePath"=".+"})
     * @param $request Request
     * @param $relativePath string Path to the file in the scorm package
     * @return Response
     */
    public function fileAction(Request $request, $relativePath)
    {
        $cachePath = $this->container->getParameter('kernel.cache_dir');
        $filePath = sprintf('%s/scorm/HelloWorld/%s', $cachePath, $relativePath);

        if(!file_exists($filePath)) {
            throw new NotFoundHttpException();
        }

        $fileInfo = finfo_open(FILEINFO_MIME_TYPE);
        $mimeType = finfo_file($fileInfo, $filePath);
        finfo_close($fileInfo);

        $fileContents = file_get_contents($filePath);

        return new Response($fileContents, 200, array('Content-Type' => $mimeType, 'Cache-Control' => 'public'));
    }

    /**
     * @Route("/scorm/view", name="inkstand_scorm_view")
     * @Template
     * @param Request $request
     * @return array
     */
    public function viewAction(Request $request)
    {
        return array();
    }
}