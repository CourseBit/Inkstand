<?php

namespace Inkstand\ResourceLibraryBundle\Doctrine;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\EntityManagerInterface;
use Inkstand\Library\TagBundle\Model\TagEntryManagerInterface;
use Inkstand\Library\TagBundle\Model\TagInterface;
use Inkstand\Library\TagBundle\Model\TagManagerInterface;
use Inkstand\ResourceLibraryBundle\Model\ResourceManager as BaseResourceManager;
use Inkstand\ResourceLibraryBundle\Model\ResourceInterface;
use Symfony\Component\Form\FormFactoryInterface;

class ResourceManager extends BaseResourceManager
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
    public function __construct(FormFactoryInterface $formFactory,  $resourceTagManager,
                                 $resourceTagEntryManager, ObjectManager $objectManager, $class)
    {
        $this->objectManager = $objectManager;
        $this->class = $class;
        $this->repository = $objectManager->getRepository($class);

        parent::__construct($formFactory, $resourceTagManager, $resourceTagEntryManager);
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
    public function update(ResourceInterface $resource)
    {
        $this->objectManager->persist($resource);
        $this->objectManager->flush();
    }

    /**
     * {@inheritdoc}
     */
    public function delete(ResourceInterface $resource)
    {
        $this->objectManager->remove($resource);
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