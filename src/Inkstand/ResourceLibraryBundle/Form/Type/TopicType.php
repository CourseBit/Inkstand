<?php

namespace Inkstand\ResourceLibraryBundle\Form\Type;

use Inkstand\Bundle\CoreBundle\Form\Type\FileReferenceType;
use Inkstand\Bundle\CourseBundle\Entity\Course;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class TopicType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $topicId = $options['data']->getTopicId();
        $submitLabel = empty($topicId) ? 'Add Topic' : 'Update Topic';

        $builder->add('name', 'text');
        $builder->add('description', 'textarea');
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
        return 'topic';
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Inkstand\ResourceLibraryBundle\Entity\topic',
        ));
    }
}