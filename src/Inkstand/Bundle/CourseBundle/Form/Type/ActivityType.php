<?php

namespace Inkstand\Bundle\CourseBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormEvent;

use Inkstand\Activity\ForumBundle\Form\Type\ForumPreferencesType;

class ActivityType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options) 
    {
        $builder->add('activityTypeId', 'hidden');
        $builder->add('moduleId', 'hidden');
        $builder->add('name', 'text', array(
            'attr' => array('class' => 'form-control'),
            'label_attr' => array('class' => 'col-sm-2 control-label'),
            'required' => true
        ));
        $builder->add('slug', 'text', array(
            'attr' => array('class' => 'form-control'),
            'label_attr' => array('class' => 'col-sm-2 control-label'),
            'required' => true
        ));
        $builder->add('description', 'textarea', array(
            'attr' => array('class' => 'wysiwyg form-control'),
            'label_attr' => array('class' => 'col-sm-2 control-label')
        ));
        $builder->add('forumPreferences', new ForumPreferencesType());
        $builder->add('save', 'submit');
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
        return 'activity';
    }
}