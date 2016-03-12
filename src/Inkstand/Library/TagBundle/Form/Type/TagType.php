<?php

namespace Inkstand\Library\TagBundle\Form\Type;

use Inkstand\Library\TagBundle\Model\TagInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class TagType extends AbstractType
{
    private $class;

    public function __construct($class)
    {
        $this->class = $class;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('name', 'text', array(
            'label' => 'tag.name',
            'required' => true
        ));
        $builder->add('code', 'text', array(
            'label' => 'tag.code',
            'help_text' => 'tag.code.help'
        ));
        $builder->add('type', 'choice', array(
            'label' => 'tag.type',
            'choices' => array(
                TagInterface::TYPE_TEXT => 'tag.text',
                TagInterface::TYPE_DROPDOWN => 'tag.dropdown',
                TagInterface::TYPE_CHECKBOX => 'tag.checkbox'
            )
        ));
        $builder->add('required', 'choice', array(
            'label' => 'tag.required',
            'choices' => array('1' => 'Yes', '0' => 'No'),
            'expanded' => true
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
            'data_class' => $this->class,
            'required' => false
        ));
    }
}