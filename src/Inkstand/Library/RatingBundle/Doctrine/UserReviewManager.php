<?php

namespace Inkstand\Library\RatingBundle\Doctrine;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\EntityManagerInterface;
use Inkstand\Library\RatingBundle\Model\RatingManagerInterface;
use Inkstand\Library\RatingBundle\Model\UserReviewInterface;
use Inkstand\Library\RatingBundle\Model\UserReviewManager as BaseUserReviewManager;
use Symfony\Component\Form\FormFactoryInterface;

class UserReviewManager extends BaseUserReviewManager
{
    /**
     * @var ObjectManager
     */
    private $objectManager;

    /**
     * @var string
     */
    private $class;

    /**
     * @var \Doctrine\Common\Persistence\ObjectRepository
     */
    private $userReviewRepository;

    /**
     * @param FormFactoryInterface $formFactory
     * @param ObjectManager $objectManager
     * @param $class
     */
    public function __construct(FormFactoryInterface $formFactory, ObjectManager $objectManager, $class)
    {
        $this->objectManager = $objectManager;
        $this->class = $class;
        $this->userReviewRepository = $objectManager->getRepository($class);

        parent::__construct($formFactory);
    }

    /**
     * {@inheritdoc}
     */
    public function findAll()
    {
        return $this->userReviewRepository->findAll();
    }

    /**
     * {@inheritdoc}
     */
    public function findOneBy(array $criteria)
    {
        return $this->userReviewRepository->findOneBy($criteria);
    }

    /**
     * {@inheritdoc}
     */
    public function findBy(array $criteria)
    {
        return $this->userReviewRepository->findBy($criteria);
    }

    /**
     * {@inheritdoc}
     */
    public function update(UserReviewInterface $userReview)
    {
        if(!$userReview->getCreated()) {
            $userReview->setCreated(new \DateTime());
        }
        $userReview->setModified(new \DateTime());
        $this->objectManager->persist($userReview);
        $this->objectManager->flush();
    }

    /**
     * {@inheritdoc}
     */
    public function delete(UserReviewInterface $userReview)
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