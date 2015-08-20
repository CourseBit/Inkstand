<?php

namespace Inkstand\Bundle\CourseBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Form\FormView;

class CourseEnrollmentTypeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('courseId', 'hidden')
            ->add('enrollmentTypeId', 'hidden')
            ->add('enabled', 'choice', array(
                'choices' => array('1' => 'Enabled', '0' => 'Disabled'),
                'expanded' => true,
                'multiple' => false
            ))
            ->add('enrollmentType', new EnrollmentTypeType());
    }

    public function getName()
    {
        return 'courseEnrollmentType';
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Inkstand\Bundle\CourseBundle\Entity\CourseEnrollmentType',
        ));
    }
}