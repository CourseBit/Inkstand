<?php

namespace Inkstand\Bundle\CourseBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormEvent;

class CourseMetricType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options) {

        $builder->add('courseMetricId', 'hidden');
        $builder->add('name', 'text', array(
            'attr' => array('class' => 'form-control'),
            'label_attr' => array('class' => 'col-sm-2 control-label'),
            'required' => true
        ));
        $builder->add('valueType', 'choice', array(
            'choices' => array(
                'text' => 'Text', 'number' => 'Number', 'choice' => 'Choice'
            ),
            'attr' => array('class' => 'form-control'),
            'label_attr' => array('class' => 'col-sm-2 control-label'),
            'required' => true,
            'data' => 'text',
        ));
        $builder->add('searchable', 'choice', array(
            'choices' => array('1' => 'Yes', '0' => 'No'),
            'expanded' => true,
            'multiple' => false,
            'label_attr' => array('class' => 'col-sm-2 control-label'),
            'required' => true,
            'data' => '0'
        ));
        $builder->add('required', 'choice', array(
            'choices' => array('1' => 'Yes', '0' => 'No'),
            'expanded' => true,
            'multiple' => false,
            'label_attr' => array('class' => 'col-sm-2 control-label'),
            'required' => true,
            'data' => '0'
        ));
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
        return 'courseMetric';
    }
}