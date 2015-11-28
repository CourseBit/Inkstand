<?php

namespace Inkstand\Bundle\CourseBundle\Tests;

use Inkstand\Bundle\CourseBundle\Entity\Course;
use Inkstand\Bundle\CourseBundle\Service\CourseService;
use Symfony\Component\HttpKernel\Tests\KernelTest;

class CourseServiceTest extends KernelTest
{
    /**
     * @var EntityManager
     */
    private $em;

    /**
     * @var CourseService
     */
    private $courseService;

    protected function setUp()
    {
        $kernel = static::createKernel();
        $kernel->boot();
        $this->em = $kernel->getContainer()->get('doctrine.orm.entity_manager');
        $this->courseService = $kernel->getContainer()->get('inkstand_course.course');
        $this->em->beginTransaction();
    }

    /**
     * Rollback changes.
     */
    protected function tearDown()
    {
        $this->em->rollback();
    }

    public function createCourse()
    {
        $course = new Course();

        // Create course enrollment types

    }
}