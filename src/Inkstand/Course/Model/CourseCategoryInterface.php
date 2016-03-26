<?php

namespace Inkstand\Course\Model;


interface CourseCategoryInterface
{
    /**
     * Get categoryId
     *
     * @return integer
     */
    public function getCategoryId();

    /**
     * Set name
     *
     * @param string $name
     * @return CourseCategoryInterface
     */
    public function setName($name);

    /**
     * Get name
     *
     * @return string
     */
    public function getName();

    /**
     * Set code
     *
     * @param string $code
     * @return CourseCategoryInterface
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
     * @return CourseCategoryInterface
     */
    public function setDescription($description);

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription();

    /**
     * Set featuredImageFileId
     *
     * @param integer $featuredImageFileId
     * @return CourseCategoryInterface
     */
    public function setFeaturedImageFileId($featuredImageFileId);

    /**
     * Get featuredImageFileId
     *
     * @return integer
     */
    public function getFeaturedImageFileId();

    /**
     * Set parentId
     *
     * @param integer $parentId
     * @return CourseCategoryInterface
     */
    public function setParentId($parentId);

    /**
     * Get parentId
     *
     * @return integer
     */
    public function getParentId();

    /**
     * Add child
     *
     * @param CourseCategoryInterface $child
     * @return CourseCategoryInterface
     */
    public function addChild(CourseCategoryInterface $child);

    /**
     * Remove child
     *
     * @param CourseCategoryInterface $child
     */
    public function removeChild(CourseCategoryInterface $child);

    /**
     * Get children
     *
     * @return \Traversable
     */
    public function getChildren();

    /**
     * Set parent
     *
     * @param CourseCategoryInterface $parent
     * @return CourseCategoryInterface
     */
    public function setParent(CourseCategoryInterface $parent = null);

    /**
     * Get parent
     *
     * @return CourseCategoryInterface
     */
    public function getParent();

    /**
     * Add course
     *
     * @param CourseInterface $course
     * @return CourseCategoryInterface
     */
    public function addCourse(CourseInterface $course);

    /**
     * Remove course
     *
     * @param CourseInterface $course
     */
    public function removeCourse(CourseInterface $course);

    /**
     * Get courses
     *
     * @return \Traversable
     */
    public function getCourses();

    /**
     * Set featuredImage
     *
     * @param FileReferenceInterface $featuredImage
     * @return CourseCategoryInterface
     */
    public function setFeaturedImage(FileReferenceInterface $featuredImage = null);

    /**
     * Get featuredImage
     *
     * @return FileReferenceInterface
     */
    public function getFeaturedImage();
}