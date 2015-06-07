<?php

namespace Inkstand\Bundle\CourseBundle\Service;

use Inkstand\Bundle\CourseBundle\Entity\Enrollment;

class EnrollmentService
{
    protected $entityManager;
    protected $repository;

    public function __construct($entityManager)
    {
        $this->entityManager = $entityManager;
        $this->repository = $this->entityManager->getRepository('InkstandCourseBundle:Enrollment');
    }

    /**
     * Enroll a single user user to a single course
     *
     * @param $user
     * @param $course
     */
    public function enroll($user, $course)
    {
        $enrollment = new Enrollment();
        $enrollment->setUser($user);
        $enrollment->setUserId($user->getId());
        $enrollment->setCourse($course);
        $enrollment->setCourseId($course->getCourseId());
        $this->entityManager->persist($enrollment);
        $this->entityManager->flush();
    }

    /**
     * Enroll multiple users to a single course
     *
     * @param array $users
     * @param $course
     */
    public function enrollUsers(array $users, $course)
    {
        // Insert enrollments in batches
        $batchSize = 20;
        $i = 0;

        foreach($users as $user) {
            $enrollment = new Enrollment();
            $enrollment->setUser($user);
            $enrollment->setCourse($course);
            $this->entityManager->persist($enrollment);

            if(($i++ % $batchSize) == 0) {
                $this->entityManager->flush();
                $this->entityManager->clear();
            }
        }
        $this->entityManager->flush();
        $this->entityManager->clear();
    }
}