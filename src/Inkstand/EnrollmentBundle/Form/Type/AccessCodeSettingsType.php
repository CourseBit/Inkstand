<?php

namespace Inkstand\EnrollmentBundle\Form\Type;

use Inkstand\Bundle\CourseBundle\Entity\Course;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class AccessCodeSettingsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('accessCode', 'text', array(
                'label' => 'enrollment.access_code',
                'help_text' => 'enrollment.access_code.help'
            ))
            ->add('expires', 'choice', array(
                'choices' => array(1 => 'yes', 0 => 'no'),
                'expanded' => true,
                'label' => 'enrollment.access_code.expires',
                'help_text' => 'enrollment.access_code.expires.help'
            ))
            ->add('dateExpires', 'date', array(
                'label' => 'enrollment.access_code.date_expires',
                'help_text' => 'enrollment.access_code.date_expires.help'
            ))
            ->add('actions', 'form_actions', array(
                'buttons' => array(
                    'save' => array(
                        'type' => 'submit', 
                        'options' => array(
                            'label' => 'button.save',
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
        return 'accessCodeSettings';
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Inkstand\Enrollment\AccessCodeBundle\Entity\AccessCodeSettings',
        ));
    }
}