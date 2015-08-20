<?php
/**
 * Created by PhpStorm.
 * User: Joe
 * Date: 8/13/2015
 * Time: 9:35 PM
 */

namespace Inkstand\Bundle\CourseBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class EnrollmentTypeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', 'text', array(
                'mapped' => false
            ));
    }

    public function getName()
    {
        return 'enrollmentType';
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Inkstand\Bundle\CourseBundle\Entity\EnrollmentType',
        ));
    }
}