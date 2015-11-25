<?php

namespace Inkstand\Bundle\CoreBundle\Service;

use Inkstand\Bundle\CoreBundle\Entity\Voter;
use Inkstand\Bundle\CoreBundle\Entity\VoterAction;
use Inkstand\Bundle\CoreBundle\Entity\VoterActionRoleAssignment;
use Inkstand\Bundle\CoreBundle\Voter\AbstractVoter;
use Symfony\Component\DependencyInjection\ContainerAware;

class VoterService
{
    protected $entityManager;
    protected $repository;
    protected $serviceContainer;
    protected $voterActionService;
    protected $voterActionRoleAssignmentService;
    protected $roleService;

    private $voterServiceIds = array();

    public function __construct($entityManager, $roleService, $voterActionService, $voterActionRoleAssignmentService, $serviceContainer)
    {
        $this->entityManager = $entityManager;
        $this->repository = $entityManager->getRepository('InkstandCoreBundle:Voter');
        $this->roleService = $roleService;
        $this->voterActionService = $voterActionService;
        $this->voterActionRoleAssignmentService = $voterActionRoleAssignmentService;
        $this->serviceContainer = $serviceContainer;
    }

    public function findAll()
    {
        return $this->repository->findAll();
    }

    public function findOneByService($service) {
        return $this->repository->findOneByService($service);
    }

    public function findOneByClassName($className)
    {
        return $this->repository->findOneByClassName($className);
    }

    public function updateVoters($verbose = false)
    {
        $existingVoters = $this->findAll();
        $voterServiceIds = $this->voterServiceIds;

        $stats = array(
            'newVotersCount' => 0,
            'updatedVotersCount' => 0,
            'newVoterActionsCount' => 0,
            'updatedVoterActionsCount' => 0,
            'newVoterActionRoleAssignments' => 0
        );

        foreach($existingVoters as $existingVoter) {
            if(in_array($existingVoter->getService(), $voterServiceIds)) {
                unset($voterServiceIds[$existingVoter->getService()]);
            }
        }

        foreach($voterServiceIds as $voterServiceId) {
            if($this->findOneByService($voterServiceId) == null) {
                $voterService = $this->serviceContainer->get($voterServiceId);
                $voter = new Voter();
                $voter->setService($voterServiceId);
                $voter->setClassName(get_class($voterService));
                $this->entityManager->persist($voter);
                $stats['newVotersCount']++;
            }
        }

        $this->entityManager->flush();

        // TODO: Do we really need to find them all again? ($existingVoters)
        $voters = $this->findAll();
        $roles = $this->roleService->findAll();

        foreach($voters as $voter) {
            if($this->serviceContainer->has($voter->getService())) {
                $voterService = $this->serviceContainer->get($voter->getService());

                $voter->setClassName(get_class($voterService));
                $this->entityManager->persist($voter);

                if(!$voterService instanceof AbstractVoter) {
                    throw new \Exception('Voter must inherit from Inkstand\Bundle\CoreBundle\Voter\AbstractVoter. Did you forget to extend?');
                }

                $actions = $voterService->getSupportedAttributes();
                $defaultRoleAssignments = $voterService->getDefaultRoleAssignments();

                foreach($actions as $action) {
                    if($voterAction = $this->getActionFromVoter($voter, $action)) {
                        // update if needed
                        //$voterAction = $this->voterActionService->findOne($voter->getVoterId(), $action);
                    } else {
                        $voterAction = new VoterAction();
                        $voterAction->setName($action);
                        $voterAction->setVoterId($voter->getVoterId());
                        $voterAction->setVoter($voter);
                        $voter->addVoterAction($voterAction);
                        $this->entityManager->persist($voterAction);
                        $stats['newVoterActionsCount']++;
                    }

                    if(!empty($roleName = $defaultRoleAssignments[$voterAction->getName()])) {
                        $role = $roles[$roleName];
                        // Check for existing role assignment (we don't want to overwrite any preexisting configuration)
                        if(!$this->voterActionRoleAssignmentService->hasRoleWithAction($role->getRoleId(), $voterAction->getVoterActionId())) {
                            // There's no existing role assignment, so create one for this role, for this action
                            $newVoterActionRoleAssignment = new VoterActionRoleAssignment();
                            $newVoterActionRoleAssignment->setAllow(1);
                            $newVoterActionRoleAssignment->setRole($role);
                            $newVoterActionRoleAssignment->setRoleId($role->getRoleId());
                            $newVoterActionRoleAssignment->setVoterAction($voterAction);
                            $newVoterActionRoleAssignment->setVoterActionId($voterAction->getVoterActionId());
                            $this->entityManager->persist($newVoterActionRoleAssignment);
                            $stats['newVoterActionRoleAssignments']++;
                        }
                    }
                    $this->entityManager->flush();
                }
                $this->entityManager->flush();
            }
        }

        if($verbose) {
            echo PHP_EOL;
            echo sprintf('    %s new Voter(s)', $stats['newVotersCount']);
            echo PHP_EOL;
            echo sprintf('    %s updated Voter(s)', $stats['updatedVotersCount']);
            echo PHP_EOL;
            echo sprintf('    %s new Voter Action(s),', $stats['newVotersCount']);
            echo PHP_EOL;
            echo sprintf('    %s updated Voter Action(s)', $stats['updatedVoterActionsCount']);
            echo PHP_EOL;
            echo sprintf('    %s new Voter Action Role Assignment(s)', $stats['newVoterActionRoleAssignments']);
            echo PHP_EOL . PHP_EOL;
        }
    }

    public function addVoter($serviceId)
    {
        $this->voterServiceIds[] = $serviceId;
    }

    private function getActionFromVoter(Voter $voter, $actionName)
    {
        foreach($voter->getVoterActions() as $voterAction) {
            if($voterAction->getName() == $actionName) {
                return $voterAction;
            }
        }
        return null;
    }

    public function isRoleGranted($roleName, $voterClassName, $actionName)
    {
        $voter = $this->findOneByClassName($voterClassName);
        $voterAction = $this->voterActionService->findOneBy(array('voterId' => $voter->getVoterId(), 'name' => $actionName));
        $role = $this->roleService->findOneByName($roleName);

        $assignment = $this->voterActionRoleAssignmentService->getAssignmentWith($role->getRoleId(), $voterAction->getVoterActionId());

        dump($assignment);

        if($assignment->getAllow() == 0) {
            return false;
        } else if($assignment->getAllow() == 1) {
            return true;
        } else {
            // TODO: Check child roles for permission
            dump("Inherit role, default to forbid");
            return false;
        }
    }
}