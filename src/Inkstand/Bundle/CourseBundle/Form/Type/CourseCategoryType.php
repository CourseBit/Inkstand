<?php

namespace Inkstand\Bundle\CourseBundle\Form\Type;

use Inkstand\Bundle\CourseBundle\Entity\Course;
use Inkstand\Bundle\CourseBundle\Service\CourseCategoryService;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

use Inkstand\Bundle\CourseBundle\Form\Type\MetricType;

class CourseCategoryType extends AbstractType
{
    /**
     * @var CourseCategoryService
     */
    protected $courseCategoryService;

    public function __construct($courseCategoryService)
    {
        $this->courseCategoryService = $courseCategoryService;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $courseCategoryId = $options['data']->getCategoryId();
        $submitLabel = empty($courseCategoryId) ? 'course.form.add' : 'course.form.update';

        if(!empty($courseCategoryId)) {
            dump($options['data']);
            $categoryOptions = $this->courseCategoryService->getFormattedList(' / ', array($options['data']));
        } else {
            $categoryOptions = $this->courseCategoryService->getFormattedList();
        }

        $builder
            ->add('name', 'text', array(
                'label' => 'name',
                'attr' => array(
                    'placeholder' => 'course.category.form.name.placeholder',
                )
            ))
            ->add('parentId', 'choice', array(
                'choices' => $categoryOptions,
                'label' => 'course.category',
                'placeholder' => (count($categoryOptions) > 0) ? 'course.form.category.placeholder' : 'course.form.category.placeholder.none',
                'disabled' => (count($categoryOptions) > 0) ? false : true,
                'required' => false
            ))
            ->add('description', 'textarea', array(
                'attr' => array('class' => 'wysiwyg'),
            ))
            ->add('identifier', 'text', array(
                'label' => 'identifier',
                'help_text' => 'course.form.identifier.help'
            ))
            ->add('featuredImage', 'text', array(
                'label' => 'Featured Image',
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
        return 'courseCategory';
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Inkstand\Bundle\CourseBundle\Entity\CourseCategory',
        ));
    }
}
