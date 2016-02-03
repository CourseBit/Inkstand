<?php

namespace Inkstand\Bundle\CoreBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class VoterDeleteCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('voter:delete')
            ->setDescription('Deletes voter definitions in database');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->getContainer()->get('inkstand_core.voter')->deleteVoters(true);

        $output->writeln('Done deleting Voters.');
    }
}