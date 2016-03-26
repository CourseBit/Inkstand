<?php

namespace Inkstand\Course\Model;

interface CourseInterface
{
    const STATE_HIDDEN = 0;
    const STATE_PUBLISHED = 1;

    /**
     * Get courseId
     *
     * @return integer
     */
    public function getCourseId();

    /**
     * Set name
     *
     * @param string $name
     * @return CourseInterface
     */
    public function setName($name);

    /**
     * Get name
     *
     * @return string
     */
    public function getName();

    /**
     * Set slug
     *
     * @param string $slug
     * @return CourseInterface
     */
    public function setSlug($slug);

    /**
     * Get slug
     *
     * @return string
     */
    public function getSlug();

    /**
     * Set code
     *
     * @param string $code
     * @return CourseInterface
     */
    public function setCode($code);

    /**
     * Get code
     *
     * @return string
     */
    public function getCode();

    /**
     * Set description
     *
     * @param string $description
     * @return CourseInterface
     */
    public function setDescription($description);

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription();

    /**
     * Set featuredImage
     *
     * @param FileReferenceInterface $featuredImage
     * @return CourseInterface
     */
    public function setFeaturedImage(FileReferenceInterface $featuredImage);

    /**
     * Get featuredImage
     *
     * @return FileReferenceInterface
     */
    public function getFeaturedImage();

    /**
     * Set categoryId
     *
     * @param integer $categoryId
     * @return CourseInterface
     */
    public function setCategoryId($categoryId);

    /**
     * Get categoryId
     *
     * @return integer
     */
    public function getCategoryId();

    /**
     * Set state
     *
     * @param integer $state
     * @return CourseInterface
     */
    public function setState($state);

    /**
     * Get state
     *
     * @return integer
     */
    public function getState();

    /**
     * Set category
     *
     * @param CourseCategoryInterface
     * @return CourseInterface
     */
    public function setCategory(CourseCategoryInterface $category = null);

    /**
     * Get category
     *
     * @return CourseCategoryInterface
     */
    public function getCategory();

    /**
     * Add module
     *
     * @param ModuleInterface $module
     * @return CourseInterface
     */
    public function addModule(ModuleInterface $module);

    /**
     * Remove module
     *
     * @param ModuleInterface $module
     */
    public function removeModule(ModuleInterface $module);

    /**
     * Get modules
     *
     * @return \Traversable
     */
    public function getModules();

    /**
     * Add courseEnrollmentType
     *
     * @param CourseEnrollmentTypeInterface $courseEnrollmentType
     * @return CourseInterface
     */
    public function addCourseEnrollmentType(CourseEnrollmentTypeInterface $courseEnrollmentType);

    /**
     * Remove courseEnrollmentTypes
     *
     * @param CourseEnrollmentTypeInterface $courseEnrollmentTypes
     */
    public function removeCourseEnrollmentType(CourseEnrollmentTypeInterface $courseEnrollmentType);

    /**
     * Get courseEnrollmentTypes
     *
     * @return \Traversable
     */
    public function getCourseEnrollmentTypes();
}