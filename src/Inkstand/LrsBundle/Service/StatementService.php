<?php

namespace Inkstand\LrsBundle\Service;

use Inkstand\LrsBundle\Entity\Statement;

class StatementService
{
    protected $repository;

    public function __construct($entityManager)
    {
        $this->entityManager = $entityManager;
        $this->repository = $this->entityManager->getRepository('InkstandLrsBundle:Statement');
    }

    public function findOneByStatementId($statementId) {
        return $this->repository->findOneByStatementId($statementId);
    }

//    public function getStatementByStatementId($statementId) {
//        $statement = $this->findOneByStatementId($statementId);
//        if(null == $statement) {
//            return null;
//        }
//
//        $statement
//    }

    public function normalize(Statement $statement, $toArray = false)
    {
        $statementData = array(
            'id'     => $statement->getStatementId(),
            'actor'  => $statement->getActorId(),
            'verb'   => $statement->getVerbId(),
            'object' => $statement->getObjectActivityId(),
            'result' => array(
                'score' => array(
                    'scaled' => $statement->getResultScoreScaled(),
                    'raw'    => $statement->getResultScoreRaw(),
                    'min'    => $statement->getResultScoreMin(),
                    'max'    => $statement->getResultScoreMax()
                ),
                'success'    => $statement->getResultSuccess(),
                'completion' => $statement->getResultCompletion(),
                'response'   => $statement->getResultResponse(),
                'duration'   => $statement->getResultDuration(),
                'extensions' => $statement->getResultExtensions()
            ),
            'context' => array(
                'registration' => $statement->getContextRegistration(),
                'instructor'   => $statement->getContextInstructorId(),
                'team'         => $statement->getContextTeamId(),
                'contextActivities' => '',
                'revision' => $statement->getContextRevision(),
                'platform' => $statement->getContextPlatform(),
                'language' => $statement->getContextLanguage(),
                'statement' => $statement->getContextStatementRefId(),
                'extensions' => $statement->getContextExtensions(),
            ),
            'timestamp' => $statement->getTimestamp(),
            'stored' => $statement->getStored(),
            'authority' => $statement->getAuthorityId(),
            'version' => $statement->getVersion(),
            'attachments' => ''
        );

        if(true === $toArray) {
            return $statementData;
        }
        return json_encode($statementData);
    }

    public function denormalize($statementJson) {
        return new Statement();
    }
}