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

    /**
     * @var \Inkstand\Bundle\CourseBundle\Entity\ActivityType
     */
    protected $activityType;


    /**
     * Set activityType
     *
     * @param \Inkstand\Bundle\CourseBundle\Entity\ActivityType $activityType
     * @return ExternalLink
     */
    public function setActivityType(\Inkstand\Bundle\CourseBundle\Entity\ActivityType $activityType = null)
    {
        $this->activityType = $activityType;

        return $this;
    }

    /**
     * Get activityType
     *
     * @return \Inkstand\Bundle\CourseBundle\Entity\ActivityType 
     */
    public function getActivityType()
    {
        return $this->activityType;
    }
}
