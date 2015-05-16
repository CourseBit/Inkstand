<?php

namespace Inkstand\Activity\ForumBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Inkstand\Bundle\CourseBundle\Entity\ActivityType;

class LoadForumTypeData implements FixtureInterface
{
	public function load(ObjectManager $manager)
	{
		$externalLinkType = new ActivityType();
		$externalLinkType->setName('Forum');
		$externalLinkType->setBundleName('InkstandForumBundle');

		$manager->persist($externalLinkType);
		$manager->flush();
	}
}