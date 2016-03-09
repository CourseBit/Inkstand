<?php

namespace Inkstand\ResourceLibraryBundle\Form\Type;

use Inkstand\Bundle\CoreBundle\Form\Type\FileReferenceType;
use Inkstand\Bundle\CourseBundle\Entity\Course;
use Inkstand\ResourceLibraryBundle\Model\TopicInterface;
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
        $builder->add('state', 'choice', array(
            'choices' => array(
                TopicInterface::STATE_PUBLISHED => 'Published',
                TopicInterface::STATE_DRAFT => 'Draft (hidden)'
            )
        ));
        $builder->add('thumbnailFileReference', new FileReferenceType(), array(
            'label' => 'Thumbnail',
            'required' => false
        ));
        $builder->add('description', 'textarea', array(
            'attr' => array('class' => 'wysiwyg-editor')
        ));
        $builder->add('excerpt', 'textarea', array(

        ));
        $builder->add('showInLibrary', 'choice', array(
            'choices' => array('1' => 'Yes', '0' => 'No'),
            'label' => 'Show in Library',
            'expanded' => true,
            'help_text' => 'Topics can be listed on the main library page for quick access.'
        ));
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