<?php

namespace Inkstand\Library\RatingBundle\Doctrine;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\EntityManagerInterface;
use Inkstand\Library\RatingBundle\Model\RatingInterface;
use Inkstand\Library\RatingBundle\Model\RatingManager as BaseRatingManager;
use Inkstand\Library\RatingBundle\Model\UserReviewManagerInterface;
use Symfony\Component\Form\FormFactoryInterface;

class RatingManager extends BaseRatingManager
{
    /**
     * @var EntityManagerInterface
     */
    private $objectManager;

    /**
     * @var \Doctrine\Common\Persistence\ObjectRepository
     */
    private $ratingRepository;

    /**
     * @var string
     */
    private $class;

    /**
     * @param UserReviewManagerInterface $userReviewManager
     * @param FormFactoryInterface $formFactory
     * @param ObjectManager $objectManager
     * @param string $class
     */
    public function __construct(UserReviewManagerInterface $userReviewManager, FormFactoryInterface $formFactory, ObjectManager $objectManager, $class)
    {
        $this->objectManager = $objectManager;
        $this->ratingRepository = $objectManager->getRepository($class);
        $this->class = $class;

        parent::__construct($userReviewManager, $formFactory);
    }

    /**
     * {@inheritdoc}
     */
    public function findAll()
    {
        return $this->ratingRepository->findAll();
    }

    /**
     * {@inheritdoc}
     */
    public function findOneBy(array $criteria)
    {
        return $this->ratingRepository->findOneBy($criteria);
    }

    /**
     * {@inheritdoc}
     */
    public function findBy(array $criteria)
    {
        return $this->ratingRepository->findBy($criteria);
    }

    /**
     * {@inheritdoc}
     */
    public function update(RatingInterface $rating)
    {
        $this->objectManager->persist($rating);
        $this->objectManager->flush();
    }

    /**
     * {@inheritdoc}
     */
    public function delete(RatingInterface $rating)
    {
        $this->objectManager->remove($rating);
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