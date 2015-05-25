<?php

namespace Inkstand\Bundle\CourseBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormEvent;

use Inkstand\Activity\ForumBundle\Form\Type\ForumPreferencesType;

class ActivityType extends AbstractType
{
    private $preferences;

    public function __construct($preferences) 
    {
        $this->preferences = $preferences;
    }

    public function buildForm(FormBuilderInterface $builder, array $options) 
    {
        $builder->add('activityTypeId', 'hidden');
        $builder->add('moduleId', 'hidden');
        $builder->add('name', 'text', array(
            'attr' => array('class' => 'form-control'),
            'label_attr' => array('class' => 'col-sm-2 control-label'),
            'required' => true
        ));
        $builder->add('slug', 'text', array(
            'attr' => array('class' => 'form-control'),
            'label_attr' => array('class' => 'col-sm-2 control-label'),
            'required' => true
        ));
        $builder->add('description', 'textarea', array(
            'attr' => array('class' => 'wysiwyg form-control'),
            'label_attr' => array('class' => 'col-sm-2 control-label')
        ));
        $builder->add('preferences', new \Inkstand\Activity\ForumBundle\Form\Type\ForumPreferencesType());
        $builder->add('actions', 'form_actions', array(
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
                'save'
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

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Inkstand\Bundle\CourseBundle\Entity\Activity',
        ));
    }

    public function getParent()
    {
        return 'form';
    }

    public function getName()
    {
        return 'activity';
    }
}