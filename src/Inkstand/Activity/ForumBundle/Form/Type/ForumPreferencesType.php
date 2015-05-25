<?php

namespace Inkstand\Activity\ForumBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormEvent;

class ForumPreferencesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options) 
    {
        $builder->add('activityId', 'hidden');
        $builder->add('locked', 'choice', array(
            'choices'  => array('1' => 'Yes', '0' => 'No'),
            // 'required' => false,
            // 'multiple' => true,
            'expanded' => true,
        ));
        $builder->add('forumType', 'choice', array(
            'choices'  => array(
                'full' => 'Full discussions',
                'single' => 'Single discussion'
            ),
        ));
        $builder->add('oneDiscussionPerUser', 'choice', array(
            'choices'  => array('1' => 'Yes', '0' => 'No'),
            // 'required' => false,
            // 'multiple' => true,
            'expanded' => true,
        ));
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Inkstand\Activity\ForumBundle\Entity\ForumPreferences',
        ));
    }

    public function getParent()
    {
        return 'form';
    }

    public function getName()
    {
        return 'forumPreferences';
    }
}