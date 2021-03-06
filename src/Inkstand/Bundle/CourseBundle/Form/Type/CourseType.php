<?php

namespace Inkstand\Bundle\CourseBundle\Form\Type;

use Inkstand\Bundle\CoreBundle\Form\Type\FileReferenceType;
use Inkstand\Bundle\CourseBundle\Entity\Course;
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
        $courseId = $options['data']->getCourseId();
        $submitLabel = empty($courseId) ? 'course.form.add' : 'course.form.update';

        $builder
            ->add('name', 'text', array(
                'label' => 'name',
                'attr' => array(
                    'placeholder' => 'course.form.name.placeholder',
                )
            ))
            ->add('slug', 'text', array(
                'label' => 'slug',
                'help_text' => 'course.form.slug.help',
                'input_addon' => '/course/view/',     
                'attr' => array(
                    'placeholder' => 'course.form.slug.placeholder',
                )
            ))
            ->add('state', 'choice', array(
                'choices' => array(
                    Course::STATE_HIDDEN => 'Draft',
                    Course::STATE_PUBLISHED => 'Published'
                ),
                'label' => 'course.state',
                'data' => 1
            ))
            ->add('categoryId', 'choice', array(
                'choices' => $this->courseCategoryService->getFormattedList(),
                'label' => 'course.category',
                'placeholder' => 'course.form.category.placeholder'
            ))
            ->add('description', 'textarea', array(
                'attr' => array('class' => 'wysiwyg'),
            ))
            ->add('identifier', 'text', array(
                'label' => 'identifier',
                'help_text' => 'course.form.identifier.help'
            ))
            ->add('featuredImage', new FileReferenceType(), array(
                'label' => 'Featured Image'
            ))
            ->add('actions', 'form_actions', array(
                'buttons' => array(
                    'save' => array(
                        'type' => 'submit', 
                        'options' => array(
                            'label' => $submitLabel,
                            'attr' => array(
                                'class' => 'btn btn-primary'
                            )
                        )
                    ),
                    'cancel' => array(
                        'type' => 'submit', 
                        'options' => array(
                            'label' => 'button.cancel',
                            'attr' => array(
                                'class' => 'btn btn-default'
                            )
                        )
                    ),
                )
            ));
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