<?php

namespace Inkstand\Bundle\CourseBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="lms_course_category")
 */
class CourseCategory
{
	/**
	 * @ORM\Column(name="category_id", type="integer")
	 * @ORM\Id
	 * @ORM\GeneratedValue(strategy="AUTO")
	 */
	protected $categoryId;

	/**
	 * @ORM\Column(type="string", length=255)
	 */
	protected $name;

	/**
	 * @ORM\Column(type="string", length=50, nullable=true)
	 */
	protected $abbreviation;

	/**
	 * @ORM\Column(type="string")
	 */
	protected $identifier;

	/**
	 * @ORM\Column(type="string")
	 */
	protected $description;

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
	 * @ORM\Column(name="parent_id", type="integer", nullable=true)
	 */
	protected $parentId = null;

	/**
	 * @ORM\OneToMany(targetEntity="CourseCategory", mappedBy="parent")
	 */
	protected $children;

	/**
	 * @ORM\ManyToOne(targetEntity="CourseCategory", inversedBy="children")
	 * @ORM\JoinColumn(name="parent_id", referencedColumnName="category_id", nullable=true)
	 */
	protected $parent;

	/**
	 * @ORM\OneToMany(targetEntity="Course", mappedBy="category")
	 */
	protected $courses;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->children = new \Doctrine\Common\Collections\ArrayCollection();
        $this->courses = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set name
     *
     * @param string $name
     * @return CourseCategory
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
     * @return CourseCategory
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
     * Set indentifier
     *
     * @param string $identifier
     * @return CourseCategory
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
     * @return CourseCategory
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
     * Set featuredImageFileId
     *
     * @param string $featuredImageFileId
     * @return CourseCategory
     */
    public function setFeaturedImageFileId($featuredImageFileId)
    {
        $this->featuredImageFileId = $featuredImageFileId;

        return $this;
    }

    /**
     * Get featuredImageFileId
     *
     * @return string
     */
    public function getFeaturedImageFileId()
    {
        return $this->featuredImageFileId;
    }

    /**
     * Set parentId
     *
     * @param integer $parentId
     * @return CourseCategory
     */
    public function setParentId($parentId)
    {
        $this->parentId = $parentId;

        return $this;
    }

    /**
     * Get parentId
     *
     * @return integer
     */
    public function getParentId()
    {
        return $this->parentId;
    }

    /**
     * Add children
     *
     * @param \Inkstand\Bundle\CourseBundle\Entity\CourseCategory $children
     * @return CourseCategory
     */
    public function addChild(\Inkstand\Bundle\CourseBundle\Entity\CourseCategory $children)
    {
        $this->children[] = $children;

        return $this;
    }

    /**
     * Remove children
     *
     * @param \Inkstand\Bundle\CourseBundle\Entity\CourseCategory $children
     */
    public function removeChild(\Inkstand\Bundle\CourseBundle\Entity\CourseCategory $children)
    {
        $this->children->removeElement($children);
    }

    /**
     * Get children
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getChildren()
    {
        return $this->children;
    }

    /**
     * Set parent
     *
     * @param \Inkstand\Bundle\CourseBundle\Entity\CourseCategory $parent
     * @return CourseCategory
     */
    public function setParent(\Inkstand\Bundle\CourseBundle\Entity\CourseCategory $parent = null)
    {
        $this->parent = $parent;

        return $this;
    }

    /**
     * Get parent
     *
     * @return \Inkstand\Bundle\CourseBundle\Entity\CourseCategory
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * Add courses
     *
     * @param \Inkstand\Bundle\CourseBundle\Entity\Course $courses
     * @return CourseCategory
     */
    public function addCourse(\Inkstand\Bundle\CourseBundle\Entity\Course $courses)
    {
        $this->courses[] = $courses;

        return $this;
    }

    /**
     * Remove courses
     *
     * @param \Inkstand\Bundle\CourseBundle\Entity\Course $courses
     */
    public function removeCourse(\Inkstand\Bundle\CourseBundle\Entity\Course $courses)
    {
        $this->courses->removeElement($courses);
    }

    /**
     * Get courses
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCourses()
    {
        return $this->courses;
    }

    /**
     * Set featuredImage
     *
     * @param \Inkstand\Bundle\CoreBundle\Entity\FileReference $featuredImage
     * @return CourseCategory
     */
    public function setFeaturedImage(\Inkstand\Bundle\CoreBundle\Entity\FileReference $featuredImage = null)
    {
        $this->featuredImage = $featuredImage;

        return $this;
    }

    /**
     * Get featuredImage
     *
     * @return \Inkstand\Bundle\CoreBundle\Entity\FileReference 
     */
    public function getFeaturedImage()
    {
        return $this->featuredImage;
    }
}
