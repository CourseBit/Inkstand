<?php

namespace Inkstand\LrsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class XapiStatementController extends Controller
{
    /**
     * @Route("/statements", name="inkstand_lrs_statement_index")
     * @Method({"GET"})
     * @throws \Exception
     * @param Request $request
     * @return Response|JsonResponse
     */
    public function indexAction(Request $request)
    {
        $statementId       = $request->get('statementId', null);
        $voidedStatementId = $request->get('voidedStatementId', null);
        $agent             = $request->get('agent', null);
        $verb              = $request->get('verb', null);
        $activity          = $request->get('activity', null);
        $registration      = $request->get('registration', null);
        $relatedActivities = $request->get('related_activities', null);
        $relatedAgents     = $request->get('related_agents', null);
        $since             = $request->get('since', null);
        $until             = $request->get('until', null);
        $limit             = $request->get('limit', null);
        $format            = $request->get('format', null);
        $attachments       = $request->get('attachments', null);
        $ascending         = $request->get('ascending', null);

        $response = new Response();
        $response->headers->set('Content-Type', 'application/json');

        if($statementId != null && $voidedStatementId != null) {
            $response->setStatusCode(400);
            $response->setContent(json_encode(array('message' => $this->get('translator')->trans('statements.error.both_ids_present'))));
            return $response;
        }

        if($statementId != null || $voidedStatementId != null) {
            if($agent != null || $verb != null || $activity != null || $registration != null || $relatedActivities != null || $relatedAgents != null || $since != null || $until != null || $limit != null || $ascending != null) {
                $response->setStatusCode(400);
                $response->setContent(json_encode(array('message' => $this->get('translator')->trans('statements.error.ids_with_invalid_params'))));
                return $response;
            }
        }

        // Fetch a single Statement
        if($statementId != null) {
            $statement = $this->get('inkstand_lrs.statement')->findOneByStatementId($statementId);
            if($statement == null) {
                $response->setStatusCode(404);
                return $response;
            }
            $statementJson = $this->get('inkstand_lrs.statement')->normalize($statement);
            $response->setContent($statementJson);
            return $response;
        }
    }
}