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
                'name'        => $activity->getDefinitionName(),
                'description' => $activity->getDefinitionDescription(),
                'type'        => $activity->getDefinitionType(),
                'moreInfo'    => $activity->getDefinitionMoreInfo(),
                'extensions'  => $activity->getDefinitionExtensions()
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
            $activity->setDefinitionExtensions(isset($activityData['definition']['extensions']) ? $activityData['definition']['extensions'] : null);
        }

        return $activity;
    }
}