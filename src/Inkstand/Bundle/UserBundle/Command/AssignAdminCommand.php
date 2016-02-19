<?php

namespace Inkstand\Bundle\UserBundle\Command;

use Inkstand\Bundle\CoreBundle\Service\RoleServiceInterface;
use Inkstand\Bundle\UserBundle\Model\UserManagerInterface;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class AssignAdminCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('user:assign:admin')
            ->setDescription('Assigns user as admin.')
            ->addArgument('username', InputArgument::REQUIRED);
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        /** @var UserManagerInterface $userManager */
        $userManager = $this->getContainer()->get('inkstand_user.user_manager');
        /** @var RoleServiceInterface $roleService */
        $roleService = $this->getContainer()->get('inkstand_core.role');

        $user = $userManager->findOneUserBy(array('username' => $input->getArgument('username')));
        $adminRole = $roleService->findOneByName('ROLE_ADMIN');

        $user->addUserRole($adminRole);

        $userManager->update($user);

        $output->writeln('Done installing default Roles.');
    }
}