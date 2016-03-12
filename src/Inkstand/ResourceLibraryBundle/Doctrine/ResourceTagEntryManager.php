<?php

namespace Inkstand\ResourceLibraryBundle\Doctrine;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\EntityManagerInterface;
use Inkstand\Library\TagBundle\Model\TagEntryInterface;
use Inkstand\Library\TagBundle\Model\TagEntryManager;
use Symfony\Component\Form\FormFactoryInterface;

class ResourceTagEntryManager extends TagEntryManager
{
    /**
     * @var EntityManagerInterface
     */
    private $objectManager;

    /**
     * @var \Doctrine\Common\Persistence\ObjectRepository
     */
    private $repository;

    /**
     * @var string
     */
    private $class;

    /**
     * @param FormFactoryInterface $formFactory
     * @param ObjectManager $objectManager
     * @param $class
     */
    public function __construct(ObjectManager $objectManager, $class)
    {
        $this->objectManager = $objectManager;
        $this->class = $class;
        $this->repository = $objectManager->getRepository($class);
    }

    /**
     * {@inheritdoc}
     */
    public function findAll()
    {
        return $this->repository->findAll();
    }

    /**
     * {@inheritdoc}
     */
    public function findOneBy(array $criteria)
    {
        return $this->repository->findOneBy($criteria);
    }

    /**
     * {@inheritdoc}
     */
    public function findBy(array $criteria)
    {
        return $this->repository->findBy($criteria);
    }

    /**
     * {@inheritdoc}
     */
    public function update(TagEntryInterface $tag)
    {
        $this->objectManager->persist($tag);
        $this->objectManager->flush();
    }

    /**
     * {@inheritdoc}
     */
    public function delete(TagEntryInterface $userReview)
    {
        $this->objectManager->remove($userReview);
        $this->objectManager->flush();
    }

    /**
     * {@inheritdoc}
     */
    public function getClass()
    {
        return $this->class;
    }
}