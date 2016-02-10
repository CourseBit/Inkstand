<?php

namespace Inkstand\Library\RatingBundle\Model;
use FOS\UserBundle\Model\UserInterface;
use Inkstand\Library\RatingBundle\Form\Type\UserReviewType;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\FormFactoryInterface;

/**
 * Abstract User Review Manager implementation which can be used as base class for your
 * concrete manager.
 *
 * @author Joseph Conradt <joseph.conradt@coursebit.net>
 */
abstract class UserReviewManager implements UserReviewManagerInterface
{
    /**
     * @var FormFactoryInterface
     */
    private $formFactory;

    /**
     * @param FormFactoryInterface $formFactory
     */
    public function __construct(FormFactoryInterface $formFactory)
    {
        $this->formFactory = $formFactory;
    }

    /**
     * Return new user review instance
     *
     * @return UserReviewInterface
     */
    public function create()
    {
        $class = $this->getClass();
        return new $class;
    }

    /**
     * Build form for user review
     *
     * @param UserReviewInterface $userReview
     * @return FormType
     */
    public function getForm(UserReviewInterface $userReview = null)
    {
        $userReviewType = $this->formFactory->create(new UserReviewType(), $userReview);

        $userReviewType->add('submit', 'submit', array(
            'label' => 'rating.submit',
            'attr' => array('class' => 'btn btn-primary')
        ));

        return $userReviewType;
    }
}