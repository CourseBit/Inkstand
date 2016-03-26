<?php

namespace Inkstand\Bundle\CourseBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Course
 *
 * @ORM\Table("lms_course")
 * @ORM\Entity(repositoryClass="Inkstand\Bundle\CourseBundle\Entity\CourseRepository")
 */
class Course
{
    const STATE_HIDDEN = 0;
    const STATE_PUBLISHED = 1;

    /**
     * @var integer
     *
     * @ORM\Column(name="course_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $courseId;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $abbreviation;

    /**
     * @var string
     *
     * @ORM\Column(name="slug", type="string", length=255)
     */
    private $slug;

    /**
     * @var string
     *
     * @ORM\Column(name="identifier", type="string", length=255, nullable=true)
     */
    private $identifier;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255)
     */
    private $description;

    /**
     * @ORM\Column(name="featured_image_file_id", type="integer", nullable=true)
     */
    protected $featuredImageFileId;

    /**
     * @ORM\ManyToOne(targetEntity="Inkstand\Bundle\CoreBundle\Entity\FileReference", cascade={"persist"})
     * @ORM\JoinColumn(name="featured_image_file_id", referencedColumnName="file_reference_id", nullable=true)
     */
    protected $featuredImage;

    /**
     * @var integer
     *
     * @ORM\Column(name="category_id", type="integer")
     */
    private $categoryId;

    /**
     * @var integer
     *
     * @ORM\Column(name="state", type="integer")
     */
    private $state;

    /**
     * @ORM\ManyToOne(targetEntity="CourseCategory", inversedBy="courses")
     * @ORM\JoinColumn(name="category_id", referencedColumnName="category_id")
     */
    private $category;

    /**
     * @ORM\OneToMany(targetEntity="Module", mappedBy="course")
     */
    private $modules;

    /**
     * @ORM\OneToMany(targetEntity="CourseEnrollmentType", mappedBy="course", cascade={"persist"})
     */
    private $courseEnrollmentTypes;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->modules = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return Course
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
     * Set abbreviation
     *
     * @param string $abbreviation
     * @return Course
     */
    public function setAbbreviation($abbreviation)
    {
        $this->abbreviation = $abbreviation;

        return $this;
    }

    /**
     * Get abbreviation
     *
     * @return string
     */
    public function getAbbreviation()
    {
        return $this->abbreviation;
    }

    /**
     * Set slug
     *
     * @param string $slug
     * @return Course
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Get slug
     *
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Set identifier
     *
     * @param string $identifier
     * @return Course
     */
    public function setIdentifier($identifier)
    {
        $this->identifier = $identifier;

        return $this;
    }

    /**
     * Get identifier
     *
     * @return string
     */
    public function getIdentifier()
    {
        return $this->identifier;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Course
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
     * Set featuredImage
     *
     * @param string $featuredImage
     * @return Course
     */
    public function setFeaturedImage($featuredImage)
    {
        $this->featuredImage = $featuredImage;

        return $this;
    }

    /**
     * Get featuredImage
     *
     * @return string
     */
    public function getFeaturedImage()
    {
        return $this->featuredImage;
    }

    /**
     * Set categoryId
     *
     * @param integer $categoryId
     * @return Course
     */
    public function setCategoryId($categoryId)
    {
        $this->categoryId = $categoryId;

        return $this;
    }

    /**
     * Get categoryId
     *
     * @return integer
     */
    public function getCategoryId()
    {
        return $this->categoryId;
    }

    /**
     * Set state
     *
     * @param integer $state
     * @return Course
     */
    public function setState($state)
    {
        $this->state = $state;

        return $this;
    }

    /**
     * Get state
     *
     * @return integer
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * Set category
     *
     * @param \Inkstand\Bundle\CourseBundle\Entity\CourseCategory $category
     * @return Course
     */
    public function setCategory(\Inkstand\Bundle\CourseBundle\Entity\CourseCategory $category = null)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get category
     *
     * @return \Inkstand\Bundle\CourseBundle\Entity\CourseCategory
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * Add modules
     *
     * @param \Inkstand\Bundle\CourseBundle\Entity\Module $modules
     * @return Course
     */
    public function addModule(\Inkstand\Bundle\CourseBundle\Entity\Module $modules)
    {
        $this->modules[] = $modules;

        return $this;
    }

    /**
     * Remove modules
     *
     * @param \Inkstand\Bundle\CourseBundle\Entity\Module $modules
     */
    public function removeModule(\Inkstand\Bundle\CourseBundle\Entity\Module $modules)
    {
        $this->modules->removeElement($modules);
    }

    /**
     * Get modules
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getModules()
    {
        return $this->modules;
    }

    /**
     * Add courseEnrollmentTypes
     *
     * @param \Inkstand\Bundle\CourseBundle\Entity\CourseEnrollmentType $courseEnrollmentTypes
     * @return Course
     */
    public function addCourseEnrollmentType(\Inkstand\Bundle\CourseBundle\Entity\CourseEnrollmentType $courseEnrollmentTypes)
    {
        $this->courseEnrollmentTypes[] = $courseEnrollmentTypes;

        return $this;
    }

    /**
     * Remove courseEnrollmentTypes
     *
     * @param \Inkstand\Bundle\CourseBundle\Entity\CourseEnrollmentType $courseEnrollmentTypes
     */
    public function removeCourseEnrollmentType(\Inkstand\Bundle\CourseBundle\Entity\CourseEnrollmentType $courseEnrollmentTypes)
    {
        $this->courseEnrollmentTypes->removeElement($courseEnrollmentTypes);
    }

    /**
     * Get courseEnrollmentTypes
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCourseEnrollmentTypes()
    {
        return $this->courseEnrollmentTypes;
    }
}
