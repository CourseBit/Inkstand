<?php

namespace Inkstand\Bundle\CoreBundle\Service;

use Inkstand\Bundle\CoreBundle\Entity\Context;
use Symfony\Component\Config\Definition\Exception\Exception;

class ContextService
{
    const CONTEXT_COURSE = 'course';
    const CONTEXT_SYSTEM = CONTEXT_SYSTEM;

    private $context;
    private $course;

    private $entityManager;
    private $repository;
    private $tokenStorage;
    private $contextRoleAssignmentService;

    public function __construct($entityManager, $contextRoleAssignmentService, $tokenStorage)
    {
        $this->entityManager = $entityManager;
        $this->repository = $this->entityManager->getRepository('InkstandCoreBundle:Context');
        $this->contextRoleAssignmentService = $contextRoleAssignmentService;
        $this->tokenStorage = $tokenStorage;
    }

    public function setContext($objectContext, $object = null, $createIfNull = false)
    {
        if(!empty($this->context)) {
            throw new Exception('Context already set, cannot set it again.');
        }

        $user = $this->getUser();

        if(null === $user) {

        }

        switch($objectContext) {
            case CONTEXT_COURSE:
                $this->course = $object;
                $context = $this->findContext($objectContext, $object->getCourseId());
                if(null === $context) {
                    if($createIfNull) {
                        $context = $this->createContext($objectContext, $object->getCourseId());
                    } else {
                        throw new Exception('Context not found. Context: ' . $objectContext . '. ObjectId: ' . $object->getCourseId());
                    }
                }
                $this->context = $context;
                break;

            case CONTEXT_SYSTEM:
                $this->context = new Context();
                $this->context->setContextType(CONTEXT_SYSTEM);
                break;

            default:
                throw new Exception('Unknown context ' . strval($objectContext));
                break;
        }


        $userContextRoleAssignments = $this->contextRoleAssignmentService->getUserRoleAssignments($user->getId(), $this->context->getContextId());
        dump($userContextRoleAssignments);
        foreach($userContextRoleAssignments as $contextRoleAssignment) {
            $user->addRole($contextRoleAssignment->getRole());
        }

        dump($user);
    }

    public function getContext()
    {
        if(empty($this->context)) {
            throw new Exception('Context was not set. Did you forget to set in your controller?');
        }

        return $this->context;
    }

    public function getCourse()
    {
        return $this->course;
    }

    public function createContext($contextType, $objectId)
    {
        $context = new Context();
        $context->setContextType($contextType);
        $context->setObjectId($objectId);
        $this->entityManager->persist($context);
        $this->entityManager->flush();
        return $context;
    }

    private function findContextByObjectId($objectId)
    {
        return $this->repository->findContextByObjectId($objectId);
    }

    private function findContext($contextType, $objectId, $userId = null)
    {
        return $this->repository->findContext($contextType, $objectId, $userId);
    }

    private function getUser()
    {
        if (null === $token = $this->tokenStorage->getToken()) {
            return;
        }

        if (!is_object($user = $token->getUser())) {
            // e.g. anonymous authentication
            return;
        }

        return $user;
    }
}