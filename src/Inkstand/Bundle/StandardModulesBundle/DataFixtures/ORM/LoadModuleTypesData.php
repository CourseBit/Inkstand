<?php

namespace Inkstand\Bundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Inkstand\Bundle\CourseBundle\Entity\ActivityType;

class LoadModulesTypeData implements FixtureInterface
{
	public function load(ObjectManager $manager)
	{
		$externalLinkType = new ActivityType();
		$externalLinkType->setName('external_link');

		$manager->persist($externalLinkType);
		$manager->flush();
	}
}