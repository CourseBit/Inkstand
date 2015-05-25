<?php

namespace Inkstand\Bundle\CourseBundle\Service;

class CourseService
{
    protected $entityManager;
    protected $repository;

    public function __construct($entityManager)
    {
        $this->entityManager = $entityManager;
        $this->repository = $this->entityManager->getRepository('InkstandCourseBundle:Course');
    }

    /**
     * Find one course by the course slug. Slug can also be the course ID
     *
     * @param $slug
     * @return mixed
     */
    public function findOneBySlug($slug)
    {
        if(is_numeric($slug)) {
            // Lookup course by course_id
            return $this->repository->findOneByCourseId($slug);
        } else {
            // Lookup course by slug
            return $this->repository->findOneBySlug($slug);
        }
    }

    /**
     * @param $courseId
     * @return mixed
     */
    public function findOneByCourseId($courseId)
    {
        return $this->repository->findOneByCourseId($courseId);
    }
}