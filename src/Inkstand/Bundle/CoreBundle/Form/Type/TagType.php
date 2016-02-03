<?php

namespace Inkstand\Bundle\CoreBundle\Form\Type;

use Inkstand\Bundle\CoreBundle\Form\Type\FilePickerType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class TagType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('name', 'text');
        $builder->add('uniqueName', 'text');
        $builder->add('expanded', 'choice', array(
            'choices' => array('1' => 'Yes', '0' => 'No')
        ));
        $builder->add('multiple', 'choice', array(
            'choices' => array('1' => 'Yes', '0' => 'No')
        ));
        $builder->add('required', 'choice', array(
            'choices' => array('1' => 'Yes', '0' => 'No')
        ));
        $builder->add('defaultValue', 'text');
    }

    public function getName()
    {
        return 'tag';
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Inkstand\Bundle\CoreBundle\Entity\Tag',
        ));
    }
}
