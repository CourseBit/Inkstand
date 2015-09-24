<?php

namespace Inkstand\LrsBundle\Service;

use Inkstand\LrsBundle\Entity\Activity;

class ActivityService
{
    protected $repository;

    public function __construct($entityManager)
    {
        $this->entityManager = $entityManager;
        $this->repository = $this->entityManager->getRepository('InkstandLrsBundle:Activity');
    }

    public function findOneByActivityId($activityId)
    {
        return $this->repository->findOneByActivityId($activityId);
    }

    /**
     * Return an Activity as JSON or an array
     *
     * @param Activity $activity
     * @param bool|false $toArray
     * @return array|string
     */
    public function normalize(Activity $activity, $toArray = false)
    {
        $activityData = array(
            'id' => $activity->getActivityId(),
            'objectType' => $activity->getObjectType(),
            'definition' => array(
                'name'                    => $activity->getDefinitionName(),
                'description'             => $activity->getDefinitionDescription(),
                'type'                    => $activity->getDefinitionType(),
                'moreInfo'                => $activity->getDefinitionMoreInfo(),
                'interactionType'         => $activity->getDefinitionInteractionType(),
                'correctResponsesPattern' => $activity->getDefinitionCorrectResponsesPattern(),
                'choices'                 => $activity->getDefinitionChoices(),
                'scale'                   => $activity->getDefinitionScale(),
                'source'                  => $activity->getDefinitionSource(),
                'target'                  => $activity->getDefinitionTarget(),
                'steps'                   => $activity->getDefinitionSteps(),
                'extensions'              => $activity->getDefinitionExtensions()
            )
        );

        if(true === $toArray) {
            return $activityData;
        }
        return json_encode($activityData);
    }

    /**
     * Convert JSON to Activity
     *
     * @param $activityJson
     * @return Activity
     */
    public function denormalize($activityJson)
    {
        $activityData = json_decode($activityJson, true);

        $activity = new Activity();

        $activity->setActivityId(isset($activityData['id']) ? $activityData['id'] : null);
        $activity->setObjectType(isset($activityData['objectType']) ? $activityData['objectType'] : null);
        if(isset($activityData['definition'])) {
            $activity->setDefinitionName(isset($activityData['definition']['name']) ? $activityData['definition']['name'] : null);
            $activity->setDefinitionDescription(isset($activityData['definition']['description']) ? $activityData['definition']['description'] : null);
            $activity->setDefinitionType(isset($activityData['definition']['type']) ? $activityData['definition']['type'] : null);
            $activity->setDefinitionMoreInfo(isset($activityData['definition']['moreInfo']) ? $activityData['definition']['moreInfo'] : null);
            $activity->setDefinitionInteractionType(isset($activityData['definition']['interactionType']) ? $activityData['definition']['interactionType'] : null);
            $activity->setDefinitionCorrectResponsesPattern(isset($activityData['definition']['correctResponsesPattern']) ? $activityData['definition']['correctResponsesPattern'] : null);
            $activity->setDefinitionChoices(isset($activityData['definition']['choices']) ? $activityData['definition']['choices'] : null);
            $activity->setDefinitionScale(isset($activityData['definition']['scale']) ? $activityData['definition']['scale'] : null);
            $activity->setDefinitionSource(isset($activityData['definition']['source']) ? $activityData['definition']['source'] : null);
            $activity->setDefinitionTarget(isset($activityData['definition']['target']) ? $activityData['definition']['target'] : null);
            $activity->setDefinitionSteps(isset($activityData['definition']['steps']) ? $activityData['definition']['steps'] : null);
            $activity->setDefinitionExtensions(isset($activityData['definition']['extensions']) ? $activityData['definition']['extensions'] : null);
        }

        return $activity;
    }
}