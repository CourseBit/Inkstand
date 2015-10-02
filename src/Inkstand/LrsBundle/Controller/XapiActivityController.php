<?php

namespace Inkstand\LrsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class XapiActivityController extends Controller
{
    /**
     * @Route("/activities", name="inkstand_lrs_activity_index")
     * @Method({"GET"})
     * @throws \Exception
     * @param Request $request
     * @return Response|JsonResponse
     */
    public function indexAction(Request $request)
    {
        $activityId = $request->get('activityId', null);
        if(null === $activityId) {
            throw new \Exception("Required parameter 'activityId' cannot be null.");
        }

        $response = new Response();

        $activity = $this->get('inkstand_lrs.activity')->findOneByActivityId($activityId);
        if(null === $activity) {
            $response->setStatusCode(404);
            return $response;
        }
        $response->setStatusCode(200);
        $response->headers->set('Content-Type', 'application/json');
        $response->setContent($this->get('inkstand_lrs.activity')->normalize($activity));
        return $response;
    }
}