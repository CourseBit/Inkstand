<?php

namespace Inkstand\Bundle\CoreBundle\Form\Type;

use Inkstand\Bundle\CoreBundle\Entity\Role;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class VoterActionRoleAssignmentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        //$builder->add('voterActionRoleAssignmentId', 'hidden');
        $builder->add('voterActionId', 'hidden');
        $builder->add('roleId', 'hidden');
        $builder->add('allow', 'choice', array(
            'choices' => array(
                Role::ROLE_ACTION_ALLOW => '<i class="fa fa-check text-success"></i> Allow',
                Role::ROLE_ACTION_FORBID => '<i class="fa fa-times text-danger"></i> Forbid',
                Role::ROLE_ACTION_INHERIT => '<i class="fa fa-link text-info"></i> Inherit'),
            'expanded' => true,
            'multiple' => false,
            'attr' => array('class' => 'radio-inline'),
            'label' => false
        ));
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Inkstand\Bundle\CoreBundle\Entity\VoterActionRoleAssignment',
        ));
    }

    public function getName()
    {
        return 'voterActionRoleAssignment';
    }
}