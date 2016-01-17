<?php

namespace Inkstand\Bundle\CoreBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class RoleCacheClearCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('role:cache')
            ->setDescription('Clears and rebuilds role data cache.');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->getContainer()->get('inkstand_core.role')->clearCache();

        $output->writeln('Deleted role data cache. Cache will be rebuilt on next request.');
    }
}