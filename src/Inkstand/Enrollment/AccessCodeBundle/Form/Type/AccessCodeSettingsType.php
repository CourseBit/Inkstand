<?php

namespace Inkstand\Enrollment\AccessCodeBundle\Form\Type;

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
                'label' => 'access_code',
                'help_text' => 'access_code.help'
            ))
            ->add('expires', 'date', array(
                'label' => 'access_code.expires',
                'help_text' => 'access_code.expires.help'
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