<?php

namespace Inkstand\Bundle\CoreBundle\Service;

use Inkstand\Bundle\CoreBundle\Entity\Voter;
use Inkstand\Bundle\CoreBundle\Entity\VoterAction;
use Symfony\Component\DependencyInjection\ContainerAware;

class VoterService
{
    protected $entityManager;
    protected $repository;
    protected $serviceContainer;

    private $voterServiceIds = array();

    public function __construct($entityManager, $serviceContainer)
    {
        $this->entityManager = $entityManager;
        $this->repository = $entityManager->getRepository('InkstandCoreBundle:Voter');
        $this->serviceContainer = $serviceContainer;
    }

    public function findAll()
    {
        return $this->repository->findAll();
    }

    public function findOneByService($service) {
        return $this->repository->findOneByService($service);
    }

    public function updateVoters($verbose = false)
    {
        $existingVoters = $this->findAll();
        $voterServiceIds = $this->voterServiceIds;

        $newVotersCount = 0;
        $updatedVotersCount = 0;
        $newVoterActionsCount = 0;
        $updatedVoterActionsCount = 0;

        foreach($existingVoters as $existingVoter) {
            if(in_array($existingVoter->getService(), $voterServiceIds)) {
                unset($voterServiceIds[$existingVoter->getService()]);
            }
        }

        foreach($voterServiceIds as $voterServiceId) {
            if($this->findOneByService($voterServiceId) == null) {
                $voter = new Voter();
                $voter->setService($voterServiceId);
                $this->entityManager->persist($voter);
                $newVotersCount++;
            }
        }

        $this->entityManager->flush();

        $voters = $this->findAll();

        foreach($voters as $voter) {
            if($this->serviceContainer->has($voter->getService())) {
                $voterService = $this->serviceContainer->get($voter->getService());
                $actions = $voterService->getSupportedAttributes();

                foreach($actions as $action) {
                    if($this->actionExists($voter, $action)) {
                        // update if needed
                    } else {
                        $voterAction = new VoterAction();
                        $voterAction->setName($action);
                        $voterAction->setVoterId($voter->getVoterId());
                        $voterAction->setVoter($voter);
                        $voter->addVoterAction($voterAction);
                        $this->entityManager->persist($voterAction);
                        $newVoterActionsCount++;
                    }
                }
                $this->entityManager->flush();
            }
        }

        if($verbose) {
            echo PHP_EOL;
            echo sprintf('    %s new Voter(s)', $newVotersCount);
            echo PHP_EOL;
            echo sprintf('    %s updated Voter(s)', $updatedVotersCount);
            echo PHP_EOL;
            echo sprintf('    %s new Voter Action(s),', $newVotersCount);
            echo PHP_EOL;
            echo sprintf('    %s updated Voter Action(s)', $updatedVoterActionsCount);
            echo PHP_EOL . PHP_EOL;
        }
    }

    public function addVoter($serviceId)
    {
        $this->voterServiceIds[] = $serviceId;
    }

    public function actionExists(Voter $voter, $actionName)
    {
        foreach($voter->getVoterActions() as $voterAction) {
            if($voterAction->getName() == $actionName) {
                return true;
            }
        }

        return false;
    }
}