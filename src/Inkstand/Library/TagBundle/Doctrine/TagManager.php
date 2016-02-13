<?php

namespace Inkstand\Library\TagBundle\Doctrine;

use Doctrine\ORM\EntityManagerInterface;
use Inkstand\Library\TagBundle\Model\TagInterface;
use Inkstand\Library\TagBundle\Model\TagManager as BaseTagManager;

class TagManager extends BaseTagManager
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
    public function update(TagInterface $tag)
    {
        $this->objectManager->persist($tag);
        $this->objectManager->flush();
    }

    /**
     * {@inheritdoc}
     */
    public function delete(TagInterface $userReview)
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