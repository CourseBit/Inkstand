<?php

namespace Inkstand\Bundle\CourseBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Module
 *
 * @ORM\Table("lms_module")
 * @ORM\Entity(repositoryClass="Inkstand\Bundle\CourseBundle\Entity\ModuleRepository")
 */
class Module
{
    /**
     * @var integer
     *
     * @ORM\Column(name="module_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $moduleId;

    /**
     * @var integer
     *
     * @ORM\Column(name="course_id", type="integer")
     */
    private $courseId;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text")
     */
    private $description;

    /**
     * @ORM\ManyToOne(targetEntity="Course", inversedBy="modules")
     * @ORM\JoinColumn(name="course_id", referencedColumnName="course_id")
     */
    private $course;

    /**
     * @ORM\OneToMany(targetEntity="Activity", mappedBy="module", cascade={"remove"})
     */
    protected $activities;

    /**
     * Get moduleId
     *
     * @return integer 
     */
    public function getModuleId()
    {
        return $this->moduleId;
    }

    /**
     * Set courseId
     *
     * @param integer $courseId
     * @return Module
     */
    public function setCourseId($courseId)
    {
        $this->courseId = $courseId;

        return $this;
    }

    /**
     * Get courseId
     *
     * @return integer 
     */
    public function getCourseId()
    {
        return $this->courseId;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Module
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Module
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set course
     *
     * @param \Inkstand\Bundle\CourseBundle\Entity\Course $course
     * @return Module
     */
    public function setCourse(\Inkstand\Bundle\CourseBundle\Entity\Course $course = null)
    {
        $this->course = $course;

        return $this;
    }

    /**
     * Get course
     *
     * @return \Inkstand\Bundle\CourseBundle\Entity\Course 
     */
    public function getCourse()
    {
        return $this->course;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->activities = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add activity
     *
     * @param \Inkstand\Bundle\CourseBundle\Entity\Activity $activity
     * @return Module
     */
    public function addActivity(\Inkstand\Bundle\CourseBundle\Entity\Activity $activity)
    {
        $this->activities[] = $activity;

        return $this;
    }

    /**
     * Remove activities
     *
     * @param \Inkstand\Bundle\CourseBundle\Entity\Activity $activities
     */
    public function removeActivity(\Inkstand\Bundle\CourseBundle\Entity\Activity $activities)
    {
        $this->activities->removeElement($activities);
    }

    /**
     * Get activities
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getActivities()
    {
        return $this->activities;
    }
}
