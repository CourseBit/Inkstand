<?php

namespace Inkstand\Activity\ScormBundle\Form\Type;

use Inkstand\Bundle\CoreBundle\Form\Type\FileReferenceType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormEvent;

class ScormPreferencesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('activityId', 'hidden');
        $builder->add('scormVersion', 'choice', array(
            'choices' => array(
                'scorm12' => 'SCORM 1.2',
                'scorm2004' => 'SCORM 2004'
            )
        ));
        $builder->add('scormPackageFileReference', new FileReferenceType());
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Inkstand\Activity\ScormBundle\Entity\ScormPreferences',
        ));
    }

    public function getParent()
    {
        return 'form';
    }

    public function getName()
    {
        return 'scormPreferences';
    }
}