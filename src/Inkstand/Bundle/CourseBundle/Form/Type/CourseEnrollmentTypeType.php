<?php

namespace Inkstand\Bundle\CourseBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class CourseEnrollmentTypeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('courseId', 'hidden')
            ->add('enrollmentTypeId', 'hidden')
            ->add('enabled', 'choice', array(
                'choices' => array('0' => 'Disabled', '1' => 'Enabled'),
                'expanded' => true,
                'multiple' => false
            ));
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