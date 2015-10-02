<?php

namespace Inkstand\Bundle\CoreBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class VoterUpdateCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('voter:update')
            ->setDescription('Updates voter definitions in database');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->getContainer()->get('inkstand_core.voter')->updateVoters();

        $output->writeln('Voters updated.');
    }
}