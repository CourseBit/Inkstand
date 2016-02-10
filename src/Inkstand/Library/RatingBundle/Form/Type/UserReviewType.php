<?php

namespace Inkstand\Library\RatingBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class UserReviewType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('ratingId', 'hidden');
        $builder->add('value', 'choice', array(
            'choices' => array(
                '0.2' => '1/5 stars',
                '0.4' => '2/5 stars',
                '0.6' => '3/5 stars',
                '0.8' => '4/5 stars',
                '1' => '5/5 stars',
            ),
            'label' => 'Rating'
        ));
        $builder->add('title', 'text');
        $builder->add('comment', 'textarea');
    }

    public function getName()
    {
        return 'userReview';
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Inkstand\Library\RatingBundle\Entity\UserReview',
        ));
    }
}