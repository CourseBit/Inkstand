<?php

namespace Inkstand\Bundle\UserBundle\Form\Type;

use Inkstand\Bundle\CoreBundle\Service\RoleServiceInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{
    private $edit;

    public function __construct($edit = false) {
        $this->edit = $edit;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $userId = $options['data']->getId();
        $submitLabel = empty($userId) ? 'user.form.add' : 'user.edit';

        $builder
            ->add('firstname', 'text', array(
                'label' => 'user.firstname'
            ))
            ->add('lastname', 'text', array(
                'label' => 'user.lastname'
            ))
            ->add('username', 'text', array(
                'label' => 'user.username',
            ))
            ->add('email', 'text', array(
                'label' => 'email'
            ))
            ->add('userRoles', 'entity', array(
                'class' => 'Inkstand\Bundle\CoreBundle\Entity\Role',
                'property' => 'label',
                'expanded' => true,
                'multiple' => true
            ))
            ->add('image', 'text', array(
                'label' => 'Image'
            ))
            ->add('bio', 'textarea', array(
                'label' => 'Bio'
            ))
            ->add('country', 'text', array(
                'label' => 'Country'
            ))
            ->add('city', 'text', array(
                'label' => 'City'
            ))
            ->add('twitter', 'text', array(
                'label' => 'Twitter'
            ))
            ->add('plainPassword', 'password', array(
                'label' => $this->edit === true ? 'user.newpassword' : 'user.password',
                'help_text' => 'user.newpassword.desc',
                'required' => false
            ))
            ->add('enabled', 'choice', array(
                'label' => 'user.enabled',
                'choices' => array('1' => 'yes', '2' => 'no'),
                'expanded' => true,
                'multiple' => false
            ));

            $buttonsArray = array(
                'save' => array(
                    'type' => 'submit',
                    'options' => array(
                        'label' => $submitLabel,
                        'attr' => array(
                            'class' => 'btn btn-primary'
                        )
                    )
                ),
            );

            if(empty($userId)) {
                $buttonsArray['saveAndAddAnother'] = array(
                    'type' => 'submit',
                    'options' => array(
                        'label' => 'user.form.add.another',
                        'attr' => array(
                            'class' => 'btn btn-primary'
                        )
                    )
                );
            }

            $buttonsArray['cancel'] = array(
                'type' => 'submit',
                'options' => array(
                    'label' => 'button.cancel',
                    'attr' => array(
                        'class' => 'btn btn-default'
                    )
                )
            );

            $builder->add('actions', 'form_actions', array(
                'buttons' => $buttonsArray
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
