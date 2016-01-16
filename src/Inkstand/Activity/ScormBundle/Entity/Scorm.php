<?php

namespace Inkstand\Activity\ScormBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

use Inkstand\Bundle\CourseBundle\Entity\Activity;

/**
 * Scorm
 *
 * @ORM\Table(name="activity")
 * @ORM\Entity(repositoryClass="Inkstand\Bundle\CourseBundle\Entity\ActivityRepository")
 */
class Scorm extends Activity
{
    /**
     * ForumPreferences
     */
    private $preferences;

    public function setPreferences($preferences)
    {
        $this->preferences = $preferences;

        return $this;
    }

    public function getPreferences()
    {
        return $this->preferences;
    }

    /**
     * @var \Inkstand\Bundle\CourseBundle\Entity\ActivityType
     */
    protected $activityType;


    /**
     * Set activityType
     *
     * @param \Inkstand\Bundle\CourseBundle\Entity\ActivityType $activityType
     * @return Scorm
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
