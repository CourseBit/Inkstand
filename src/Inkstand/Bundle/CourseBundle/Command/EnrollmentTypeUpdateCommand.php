<?php

namespace Inkstand\Bundle\CourseBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class EnrollmentTypeUpdateCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('enrollment_type:update')
            ->setDescription('Updates enrollment type definitions in database');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->getContainer()->get('inkstand_course.enrollment_type')->updateEnrollmentTypes(true);

        $output->writeln('Done updating EnrollmentTypes.');
    }
}