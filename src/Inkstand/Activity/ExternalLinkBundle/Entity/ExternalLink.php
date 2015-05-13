<?php

namespace Inkstand\Activity\ExternalLinkBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

use Inkstand\Bundle\CourseBundle\Entity\Activity;

/**
 * ExternalLink
 *
 * @ORM\Table(name="activity")
 * @ORM\Entity(repositoryClass="Inkstand\Bundle\CourseBundle\Entity\ActivityRepository")
 */
class ExternalLink extends Activity
{
	
}