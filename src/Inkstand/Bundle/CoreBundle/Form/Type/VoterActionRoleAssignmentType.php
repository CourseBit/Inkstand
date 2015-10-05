<?php

namespace Inkstand\Bundle\CoreBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class VoterActionRoleAssignmentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('voterActionRoleAssignmentId', 'hidden');
        $builder->add('voterActionId', 'hidden');
        $builder->add('roleId', 'hidden');
        $builder->add('allow', 'choice', array(
            'choices' => array(1 => '<i class="fa fa-check text-success"></i> Allow', 0 => '<i class="fa fa-times text-danger"></i> Forbid', 2 => '<i class="fa fa-link text-info"></i> Inherit'),
            'expanded' => true,
            'multiple' => false
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