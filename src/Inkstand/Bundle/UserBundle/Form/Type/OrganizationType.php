<?php

namespace Inkstand\Bundle\UserBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class OrganizationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('name', 'text');
        $builder->add('actions', 'form_actions', array(
            'buttons' => array(
                'save' => array(
                    'type' => 'submit',
                    'options' => array(
                        'label' => 'Submit',
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

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Inkstand\Bundle\UserBundle\Entity\Organization',
        ));
    }

    // BC for SF < 2.7
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $this->configureOptions($resolver);
    }

    public function getName()
    {
        return 'organization';
    }
}
