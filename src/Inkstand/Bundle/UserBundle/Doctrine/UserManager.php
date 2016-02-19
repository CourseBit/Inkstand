<?php

namespace Inkstand\Bundle\UserBundle\Doctrine;

use Doctrine\ORM\EntityManager;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Security\Core\Authorization\Voter\VoterInterface;
use FOS\UserBundle\Model\UserInterface;
use Inkstand\Bundle\UserBundle\Model\UserManager as BaseUserManager;

/**
 * Service for user business logic
 *
 * Class UserManager
 * @package Inkstand\Bundle\UserBundle\Doctrine
 */
class UserManager extends BaseUserManager
{
    protected $entityManager;
    protected $class;
    protected $repository;

    /**
     * UserManager constructor.
     *
     * @param EntityManager $entityManager
     * @param string        $class
     */
    public function __construct(EntityManager $entityManager, $validator, $class)
    {
        $this->entityManager = $entityManager;
        $this->repository = $entityManager->getRepository($class);

        $metadata = $entityManager->getClassMetadata($class);
        $this->class = $metadata->getName();

        parent::__construct($validator);
    }

    /**
     * {@inheritDoc}
     */
    public function findUserBy(array $criteria)
    {
        return $this->repository->findBy($criteria);
    }

    /**
     * {@inheritDoc}
     */
    public function findOneUserBy(array $criteria)
    {
        return $this->repository->findOneBy($criteria);
    }

    /**
     * {@inheritDoc}
     */
    public function findUsers()
    {
        return $this->repository->findAll();
    }

    /**
     * {@inheritDoc}
     */
    public function update(UserInterface $user)
    {
        $this->entityManager->persist($user);
        $this->entityManager->flush();
    }

    /**
     * {@inheritDoc}
     */
    public function deleteUser(UserInterface $user)
    {
        $this->entityManager->remove($user);
        $this->entityManager->flush();
    }

    public function parseUserFile(UploadedFile $file)
    {


        return parent::parseUserFile($file);
    }
}
