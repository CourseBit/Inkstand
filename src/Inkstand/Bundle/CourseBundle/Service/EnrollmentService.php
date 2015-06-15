<?php

namespace Inkstand\Bundle\CourseBundle\Service;

use Inkstand\Bundle\CourseBundle\Entity\Enrollment;
use Inkstand\Bundle\CourseBundle\Event\EnrollmentEvent;
use Inkstand\Bundle\CourseBundle\Event\EnrollmentEvents;

class EnrollmentService
{
    protected $entityManager;
    protected $eventDispatcher;
    protected $repository;

    public function __construct($entityManager, $eventDispatcher)
    {
        $this->entityManager = $entityManager;
        $this->eventDispatcher = $eventDispatcher;
        $this->repository = $this->entityManager->getRepository('InkstandCourseBundle:Enrollment');
    }

    /**
     * Enroll a single user user to a single course
     *
     * @param $user
     * @param $course
     */
    public function enrollUser($user, $course)
    {
        $enrollment = new Enrollment();
        $enrollment->setUser($user);
        $enrollment->setUserId($user->getId());
        $enrollment->setCourse($course);
        $enrollment->setCourseId($course->getCourseId());

        $event = new EnrollmentEvent($enrollment);
        $this->eventDispatcher->dispatch(EnrollmentEvents::ENROLL_PRE, $event);

        $this->entityManager->persist($enrollment);
        $this->entityManager->flush();

        $event = new EnrollmentEvent($enrollment);
        $this->eventDispatcher->dispatch(EnrollmentEvents::ENROLL_POST, $event);
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

            $event = new EnrollmentEvent($enrollment);
            $this->eventDispatcher->dispatch(EnrollmentEvents::ENROLL_PRE, $event);

            $this->entityManager->persist($enrollment);

            $event = new EnrollmentEvent($enrollment);
            $this->eventDispatcher->dispatch(EnrollmentEvents::ENROLL_POST, $event);

            if(($i++ % $batchSize) == 0) {
                $this->entityManager->flush();
                $this->entityManager->clear();
            }
        }
        $this->entityManager->flush();
        $this->entityManager->clear();
    }

    /**
     * Unenroll a single user from a course
     *
     * @param $user
     * @param $course
     * @throws \Exception
     */
    public function unenrollUser($user, $course)
    {
        $enrollment = $this->repository->findOneByUserAndCourse($user, $course);

        if($enrollment == null) {
            throw new \Exception(sprintf('Tried to unenroll user (%s) that was not enrolled (%s)', $user->getUsername(), $course->getName()));
        }

        $event = new EnrollmentEvent($enrollment);
        $this->eventDispatcher->dispatch(EnrollmentEvents::UNENROLL_PRE, $event);

        $this->entityManager->remove($enrollment);

        $event = new EnrollmentEvent($enrollment);
        $this->eventDispatcher->dispatch(EnrollmentEvents::UNENROLL_POST, $event);
    }

    /**
     * Unenroll multiple users from a course
     *
     * @param array $users
     * @param $course
     * @throws \Exception
     */
    public function unenrollUsers(array $users, $course)
    {
        // Remove enrollments in batches
        $batchSize = 20;
        $i = 0;

        foreach($users as $user) {
            $enrollment = $this->repository->findOneByUserAndCourse($user, $course);

            if($enrollment == null) {
                throw new \Exception(sprintf('Tried to unenroll user (%s) that was not enrolled (%s)', $user->getUsername(), $course->getName()));
            }

            $event = new EnrollmentEvent($enrollment);
            $this->eventDispatcher->dispatch(EnrollmentEvents::UNENROLL_PRE, $event);

            $this->entityManager->remove($enrollment);

            $event = new EnrollmentEvent($enrollment);
            $this->eventDispatcher->dispatch(EnrollmentEvents::UNENROLL_POST, $event);

            if(($i++ % $batchSize) == 0) {
                $this->entityManager->flush();
                $this->entityManager->clear();
            }
        }
        $this->entityManager->flush();
        $this->entityManager->clear();
    }

    /**
     * Check if a user is enrolled to a course
     *
     * @param $user
     * @param $course
     * @return boolean
     */
    public function isUserEnrolled($user, $course)
    {
        return $this->repository->findOneByUserAndCourse($user, $course) != null;
    }
}