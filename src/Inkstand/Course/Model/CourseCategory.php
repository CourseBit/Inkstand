<?php

namespace Inkstand\Bundle\CourseBundle\Entity;


use Inkstand\Course\Model\CourseCategoryInterface;
use Inkstand\Course\Model\CourseInterface;

abstract class CourseCategory
{
    /**
     * @var integer
     */
    protected $categoryId;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $code;

    /**
     * @var string
     */
    protected $description;

    /**
     * @var integer
     */
    protected $featuredImageFileId;

    /**
     * @var FilterReferenceInterface
     */
    protected $featuredImage;

    /**
     * @var integer
     */
    protected $parentId = null;

    /**
     * @var \Traversable
     */
    protected $children;

    /**
     * @var CourseCategoryInterface
     */
    protected $parent;

    /**
     * @var \Traversable
     */
    protected $courses;

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
     * @return CourseCategoryInterface
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
     * Set code
     *
     * @param string $code
     * @return CourseCategoryInterface
     */
    public function setCode($code)
    {
        $this->code = $code;

        return $this;
    }

    /**
     * Get code
     *
     * @return string
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return CourseCategoryInterface
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
     * @param integer $featuredImageFileId
     * @return CourseCategoryInterface
     */
    public function setFeaturedImageFileId($featuredImageFileId)
    {
        $this->featuredImageFileId = $featuredImageFileId;

        return $this;
    }

    /**
     * Get featuredImageFileId
     *
     * @return integer
     */
    public function getFeaturedImageFileId()
    {
        return $this->featuredImageFileId;
    }

    /**
     * Set parentId
     *
     * @param integer $parentId
     * @return CourseCategoryInterface
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
     * Add child
     *
     * @param CourseCategoryInterface $child
     * @return CourseCategoryInterface
     */
    public function addChild(CourseCategoryInterface $child)
    {
        $this->children[] = $child;

        return $this;
    }

    /**
     * Remove child
     *
     * @param CourseCategoryInterface $child
     */
    public function removeChild(CourseCategoryInterface $child)
    {
        $this->children->removeElement($child);
    }

    /**
     * Get children
     *
     * @return \Traversable
     */
    public function getChildren()
    {
        return $this->children;
    }

    /**
     * Set parent
     *
     * @param CourseCategoryInterface $parent
     * @return CourseCategoryInterface
     */
    public function setParent(CourseCategoryInterface $parent = null)
    {
        $this->parent = $parent;

        return $this;
    }

    /**
     * Get parent
     *
     * @return CourseCategoryInterface
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * Add course
     *
     * @param CourseInterface $course
     * @return CourseCategoryInterface
     */
    public function addCourse(CourseInterface $course)
    {
        $this->courses[] = $course;

        return $this;
    }

    /**
     * Remove course
     *
     * @param CourseInterface $course
     */
    public function removeCourse(CourseInterface $course)
    {
        $this->courses->removeElement($course);
    }

    /**
     * Get courses
     *
     * @return \Traversable
     */
    public function getCourses()
    {
        return $this->courses;
    }

    /**
     * Set featuredImage
     *
     * @param FileReferenceInterface $featuredImage
     * @return CourseCategoryInterface
     */
    public function setFeaturedImage(FileReferenceInterface $featuredImage = null)
    {
        $this->featuredImage = $featuredImage;

        return $this;
    }

    /**
     * Get featuredImage
     *
     * @return FileReferenceInterface
     */
    public function getFeaturedImage()
    {
        return $this->featuredImage;
    }
}
