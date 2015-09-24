<?php

namespace Inkstand\LrsBundle\Test\Service;

use Inkstand\LrsBundle\Service\ActivityService;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Validator\Validator;

/**
 * https://github.com/adlnet/xAPI-Spec/blob/master/xAPI.md#414-object
 *
 * testActivityUniqueness() -- An Activity id MUST be unique.
 * An Activity id MUST always reference the same Activity.
 * An Activity id SHOULD use a domain that the creator is authorized to use for this purpose.
 * An Activity id SHOULD be created according to a scheme that makes sure all Activity ids within that domain remain unique.
 *
 * Class ActivityServiceTest
 * @package Inkstand\LrsBundle\Test\Service
 */
class ActivityServiceTest extends KernelTestCase
{
    /**
     * @var EntityManager
     */
    private $em;

    /**
     * @var ActivityService
     */
    private $activityService;

    /**
     * @var Validator
     */
    private $validator;

    protected function setUp()
    {
        $kernel = static::createKernel();
        $kernel->boot();
        $this->em = $kernel->getContainer()->get('doctrine.orm.entity_manager');
        $this->activityService = $kernel->getContainer()->get('inkstand_lrs.activity');
        $this->validator = $kernel->getContainer()->get('validator');
        $this->em->beginTransaction();
    }

    /**
     * Rollback changes.
     */
    public function tearDown()
    {
        $this->em->rollback();
    }

    public function getActivityData()
    {
        $activityData = array(
            'id' => 'http://inkstand.org/xapi/test/1234',
            'objectType' => 'Activity',
            'definition' => array(
                'name' => array(
                    'en_US' => 'Test'
                ),
                'description' => array(
                    'en_US' => 'Test description'
                ),
                'type' => 'http://inkstand.org/xapi/test',
                'moreInfo' => 'http://inkstand.org/xapi/test/info',
                'interactionType' => 'test',
                'correctResponsesPattern' => array('test', 'test'),
                'choices' => array('test', 'test'),
                'scale' => array('test', 'test'),
                'source' => array('test', 'test'),
                'target' => array('test', 'test'),
                'steps' => array('test', 'test'),
                'extensions' => array(
                    'http://inkstand.org/extensions/test_data' => 'this_is_arbitrary'
                )
            )
        );

        return $activityData;
    }

    /**
     * @covers ActivityService::normalize
     */
    public function testActivityServiceDenormalize()
    {
        $activityData = $this->getActivityData();
        $activityJson = json_encode($activityData);
        $activity = $this->activityService->denormalize($activityJson);

        $this->assertEquals($activity->getActivityId(), $activityData['id']);
        $this->assertEquals($activity->getObjectType(), $activityData['objectType']);
        $this->assertEquals($activity->getDefinitionName(), $activityData['definition']['name']);
        $this->assertEquals($activity->getDefinitionDescription(), $activityData['definition']['description']);
        $this->assertEquals($activity->getDefinitionType(), $activityData['definition']['type']);
        $this->assertEquals($activity->getDefinitionMoreInfo(), $activityData['definition']['moreInfo']);
        $this->assertEquals($activity->getDefinitionInteractionType(), $activityData['definition']['interactionType']);
        $this->assertEquals($activity->getDefinitionCorrectResponsesPattern(), $activityData['definition']['correctResponsesPattern']);
        $this->assertEquals($activity->getDefinitionChoices(), $activityData['definition']['choices']);
        $this->assertEquals($activity->getDefinitionScale(), $activityData['definition']['scale']);
        $this->assertEquals($activity->getDefinitionSource(), $activityData['definition']['source']);
        $this->assertEquals($activity->getDefinitionTarget(), $activityData['definition']['target']);
        $this->assertEquals($activity->getDefinitionSteps(), $activityData['definition']['steps']);
        $this->assertEquals($activity->getDefinitionExtensions(), $activityData['definition']['extensions']);
    }

    /**
     * @covers ActivityService::denormalize
     */
    public function testActivityServiceNormalize()
    {
        $activityData = $this->getActivityData();
        $activityJson = json_encode($activityData);
        $activity = $this->activityService->denormalize($activityJson);

        $this->assertTrue(is_string($this->activityService->normalize($activity)));
        $this->assertTrue(is_array($this->activityService->normalize($activity, true)));

        $activityData2 = json_decode($this->activityService->normalize($activity), true);

        $this->assertEquals($activityData2['id'], $activityData['id']);
        $this->assertEquals($activityData2['objectType'], $activityData['objectType']);
        $this->assertEquals($activityData2['definition']['name'], $activityData['definition']['name']);
        $this->assertEquals($activityData2['definition']['description'], $activityData['definition']['description']);
        $this->assertEquals($activityData2['definition']['type'], $activityData['definition']['type']);
        $this->assertEquals($activityData2['definition']['moreInfo'], $activityData['definition']['moreInfo']);
        $this->assertEquals($activityData2['definition']['interactionType'], $activityData['definition']['interactionType']);
        $this->assertEquals($activityData2['definition']['correctResponsesPattern'], $activityData['definition']['correctResponsesPattern']);
        $this->assertEquals($activityData2['definition']['choices'], $activityData['definition']['choices']);
        $this->assertEquals($activityData2['definition']['scale'], $activityData['definition']['scale']);
        $this->assertEquals($activityData2['definition']['source'], $activityData['definition']['source']);
        $this->assertEquals($activityData2['definition']['target'], $activityData['definition']['target']);
        $this->assertEquals($activityData2['definition']['steps'], $activityData['definition']['steps']);
        $this->assertEquals($activityData2['definition']['extensions'], $activityData['definition']['extensions']);
    }

    /**
     * Make sure activities cannot have the same activityId per spec
     */
    public function testActivityUniqueness()
    {
        $activity = $this->activityService->denormalize(json_encode($this->getActivityData()));
        $this->em->persist($activity);
        $this->em->flush();

        $newActivity = clone $activity;

        $constraintViolationList = $this->validator->validate($newActivity);
        $this->assertEquals($constraintViolationList->count(), 1);

        $this->assertEquals($constraintViolationList->get(0)->getInvalidValue(), $activity->getActivityId());
    }

    public function testActivityAllFields()
    {
        $activity = $this->activityService->denormalize(json_encode($this->getActivityData()));

        $constraintViolationList = $this->validator->validate($activity);
        $this->assertEquals($constraintViolationList->count(), 0);
    }

    public function testActivityRequiredFieldsOnly()
    {
        $activityData = array(
            'id' => 'http://inkstand.org/xapi/test/1234'
        );
        $activity = $this->activityService->denormalize(json_encode($activityData));

        $constraintViolationList = $this->validator->validate($activity);
        $this->assertEquals($constraintViolationList->count(), 0);
    }
}