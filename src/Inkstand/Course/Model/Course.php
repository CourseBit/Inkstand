<?php

namespace Inkstand\Course\Model;

abstract class Course implements CourseInterface
{
    /**
     * @var integer
     */
    protected $courseId;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $slug;

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
     * @var integer
     */
    protected $categoryId;

    /**
     * @var integer
     */
    protected $state;

    /**
     * TODO: Change to interface
     * @var FileReferenceInterface
     */
    protected $featuredImage;

    /**
     * @var CourseCategoryInterface
     */
    protected $category;

    /**
     * @var \Traversable
     */
    protected $modules;

    /**
     * @var \Traversable
     */
    protected $courseEnrollmentTypes;

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
     * @return CourseInterface
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
     * Set slug
     *
     * @param string $slug
     * @return CourseInterface
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
     * Set code
     *
     * @param string $code
     * @return CourseInterface
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
     * @return CourseInterface
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
     * @param FileReferenceInterface $featuredImage
     * @return CourseInterface
     */
    public function setFeaturedImage(FileReferenceInterface $featuredImage)
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

    /**
     * Set categoryId
     *
     * @param integer $categoryId
     * @return CourseInterface
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
     * @return CourseInterface
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
     * @param CourseCategoryInterface
     * @return CourseInterface
     */
    public function setCategory(CourseCategoryInterface $category = null)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get category
     *
     * @return CourseCategoryInterface
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * Add module
     *
     * @param ModuleInterface $module
     * @return CourseInterface
     */
    public function addModule(ModuleInterface $module)
    {
        $this->modules[] = $module;

        return $this;
    }

    /**
     * Remove module
     *
     * @param ModuleInterface $module
     */
    public function removeModule(ModuleInterface $module)
    {
        $this->modules->removeElement($module);
    }

    /**
     * Get modules
     *
     * @return \Traversable
     */
    public function getModules()
    {
        return $this->modules;
    }

    /**
     * Add courseEnrollmentType
     *
     * @param CourseEnrollmentTypeInterface $courseEnrollmentType
     * @return CourseInterface
     */
    public function addCourseEnrollmentType(CourseEnrollmentTypeInterface $courseEnrollmentType)
    {
        $this->courseEnrollmentTypes[] = $courseEnrollmentType;

        return $this;
    }

    /**
     * Remove courseEnrollmentTypes
     *
     * @param CourseEnrollmentTypeInterface $courseEnrollmentTypes
     */
    public function removeCourseEnrollmentType(CourseEnrollmentTypeInterface $courseEnrollmentType)
    {
        $this->courseEnrollmentTypes->removeElement($courseEnrollmentType);
    }

    /**
     * Get courseEnrollmentTypes
     *
     * @return \Traversable
     */
    public function getCourseEnrollmentTypes()
    {
        return $this->courseEnrollmentTypes;
    }
}