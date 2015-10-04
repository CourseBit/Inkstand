<?php

namespace Inkstand\Bundle\CoreBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class RoleInstallCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('role:install')
            ->setDescription('Installs default roles to the database.');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->getContainer()->get('inkstand_core.scripts.role')->installDefaultRoles(true);

        $output->writeln('Done installing default Roles.');
    }
}