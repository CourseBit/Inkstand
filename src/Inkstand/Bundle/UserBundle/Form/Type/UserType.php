<?php

namespace Inkstand\Bundle\UserBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $userId = $options['data']->getId();
        $submitLabel = empty($userId) ? 'user.form.add' : 'user.form.update';

        $builder
            ->add('username', 'text', array(
                'label' => 'user.username',
            ))
            ->add('email', 'text', array(
                'label' => 'email'
            ))
            ->add('plainPassword', 'password', array(
                'label' => 'user.password'
            ))
            ->add('enabled', 'choice', array(
                'label' => 'user.enabled',
                'choices' => array('1' => 'yes', '2' => 'no'),
                'expanded' => true,
                'multiple' => false
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
        return 'user';
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Inkstand\Bundle\UserBundle\Entity\User',
        ));
    }
}