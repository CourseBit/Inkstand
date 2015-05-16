<?php

namespace Inkstand\Bundle\CourseBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

use Inkstand\Bundle\CourseBundle\Form\Type\MetricType;

class CourseType extends AbstractType
{
    protected $courseCategoryService;

    public function __construct($courseCategoryService) 
    {
        $this->courseCategoryService = $courseCategoryService;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('courseId', 'hidden')
            ->add('name', 'text')
            ->add('slug', 'text')
            ->add('categoryId', 'choice', array(
                'choices' => $this->courseCategoryService->getFormattedList(),
                'label' => 'Category'
            ))
            ->add('identifier', 'text', array(
                'attr' => array('class' => 'form-control'),
                'label_attr' => array('class' => 'col-sm-2 control-label')
            ))
            ->add('description', 'textarea', array(
                'attr' => array('class' => 'wysiwyg form-control'),
                'label_attr' => array('class' => 'col-sm-2 control-label')
            ))
            ->add('abbreviation', 'text', array(
                'attr' => array('class' => 'form-control'),
                'label_attr' => array('class' => 'col-sm-2 control-label')
            ))
            ->add('featuredImage', 'text', array(
                'attr' => array('class' => 'form-control'),
                'label_attr' => array('class' => 'col-sm-2 control-label'),
            ))
            
            ->add('save', 'submit');
    }

    public function getName()
    {
        return 'course';
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Inkstand\Bundle\CourseBundle\Entity\Course',
        ));
    }
}