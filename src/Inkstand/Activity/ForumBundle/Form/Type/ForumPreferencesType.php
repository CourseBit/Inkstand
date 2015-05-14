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
        $builder->add('forumId', 'hidden');
        $builder->add('locked', 'choice', array(
            'choices'  => array('1' => 'Yes'),
            'required' => false,
            'multiple' => true,
            'expanded' => true,
        ));
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {

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