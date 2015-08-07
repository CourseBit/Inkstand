<?php

namespace Inkstand\Bundle\UserBundle\Service;

/**
 * Service for user business logic
 *
 * Class UserService
 * @package Inkstand\Bundle\UserBundle\Service
 */
class UserService
{
    protected $entityManager;
    protected $userRepository;

    /**
     * @param $entityManager
     */
    public function __construct($entityManager)
    {
        $this->entityManager = $entityManager;
        $this->userRepository = $entityManager->getRepository('InkstandUserBundle:User');
    }

    /**
     * Return all users
     *
     * @return mixed
     */
    public function findAll()
    {
        return $this->userRepository->findAll();
    }

    /**
     * Return a single user by userId
     *
     * @return
     */
     public function findOneByUserId($userId)
     {
         return $this->userRepository->findOneById($userId);
     }
}
