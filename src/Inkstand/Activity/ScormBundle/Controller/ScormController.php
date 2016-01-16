<?php

namespace Inkstand\Activity\ScormBundle\Controller;

use Inkstand\Activity\ScormBundle\Entity\Scorm;
use Inkstand\Activity\ScormBundle\Entity\ScormPreferences;
use Inkstand\Activity\ScormBundle\Service\ScormService;
use Inkstand\Bundle\CoreBundle\Entity\FileReference;
use Inkstand\Bundle\CourseBundle\Entity\Activity;
use Inkstand\Bundle\CourseBundle\Service\ActivityService;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ScormController extends Controller
{
    /**
     * @Route("/scorm/file/{activityId}/{relativePath}", name="inkstand_scorm_file", requirements={"relativePath"=".+"})
     * @param $request Request
     * @param $relativePath string Path to the file in the scorm package
     * @return Response
     */
    public function fileAction(Request $request, $activityId, $relativePath)
    {
        /* @var $activityService ActivityService */
        $activityService = $this->get('activity_service');
        /* @var $scormService ScormService */
        $scormService = $this->get('inkstand_scorm.scorm');
        /* @var $scorm Scorm */
        $scorm = $activityService->findOneByActivityId($activityId);
        /* @var $scormPreferences ScormPreferences */
        $scormPreferences = $this->getDoctrine()->getRepository('InkstandScormBundle:ScormPreferences')->findOneByActivityId($scorm->getActivityId());//$scorm->getPreferences();
        /* @var $scormPackageFileReference FileReference */
        $scormPackageFileReference = $scormPreferences->getScormPackageFileReference();

        $fileInfo = pathinfo($scormPackageFileReference->getPath());

        $cachePath = $this->container->getParameter('kernel.cache_dir');
        $filePath = sprintf('%s/scorm/%s/%s', $cachePath, $fileInfo['filename'], $relativePath);

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
    public function viewAction(Request $request, Activity $activity)
    {
        return array(
            'activity' => $activity
        );
    }
}