<?php

namespace Inkstand\Activity\ExternalLinkBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Inkstand\Bundle\CourseBundle\Entity\ActivityType;

class LoadExternalLinkTypeData implements FixtureInterface
{
	public function load(ObjectManager $manager)
	{
		$externalLinkType = new ActivityType();
		$externalLinkType->setName('External Link');
		$externalLinkType->setBundleName('InkstandExternalLinkBundle');

		$manager->persist($externalLinkType);
		$manager->flush();
	}
}