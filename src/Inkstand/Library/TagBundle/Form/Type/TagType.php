<?php

namespace Inkstand\Library\TagBundle\Form\Type;

use Inkstand\Library\TagBundle\Model\TagInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class TagType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('name', 'text', array(
            'label' => 'tag.name'
        ));
        $builder->add('uniqueName', 'text', array(
            'label' => 'tag.unique_name'
        ));
        $builder->add('required', 'choice', array(
            'label' => 'tag.required',
            'choices' => array('1' => 'Yes', '0' => 'No')
        ));
        $builder->add('defaultValue', 'text', array(
            'label' => 'tag.default_value'
        ));
        $builder->add('choices', 'textarea', array(
            'label' => 'tag.choices'
        ));
    }

    public function getName()
    {
        return 'tag';
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Inkstand\Library\TagBundle\Entity\Tag',
        ));
    }
}