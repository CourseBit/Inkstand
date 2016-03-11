<?php

namespace Inkstand\ResourceLibraryBundle\Form\Type;

use Inkstand\Bundle\CoreBundle\Form\Type\FileReferenceType;
use Inkstand\Bundle\CourseBundle\Entity\Course;
use Inkstand\Library\TagBundle\Model\TagEntryInterface;
use Inkstand\Library\TagBundle\Model\TagInterface;
use Inkstand\ResourceLibraryBundle\Model\ResourceInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

use Inkstand\Bundle\CourseBundle\Form\Type\MetricType;

class ResourceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $resourceId = $options['data']->getResourceId();
        $submitLabel = empty($resourceId) ? 'Add Resource' : 'Update Resource';

        $builder->add('name', 'text');
        $builder->add('resourceFileReference', new FileReferenceType(), array(
            'label' => 'File',
            'required' => false
        ));
        $builder->add('thumbnailFileReference', new FileReferenceType(), array(
            'label' => 'Thumbnail',
            'required' => false
        ));
        $builder->add('description', 'textarea',array(
            'attr' => array('class' => 'wysiwyg-editor')
        ));
        $builder->add('topic', 'entity', array(
            'class' => 'InkstandResourceLibraryBundle:Topic',
            'property' => 'name',
            'expanded' => false,
            'multiple' => false
        ));

        $builder->add('Tag' , 'entity' , array(
            'class'    => 'InkstandResourceLibraryBundle:ResourceTag' ,
            'property' => 'name' ,
            'expanded' => true ,
            'multiple' => true ,
        ));;
//        $builder->add('tagEntries', 'collection', array(
//            'type' => new ResourceTagEntryType(),
//        ));
//
//        $builder->addEventListener(FormEvents::PRE_SET_DATA, function (FormEvent $event) {
//            /** @var ResourceInterface $resource */
//            $resource = $event->getData();
//            $form = $event->getForm();
//
//            dump($resource->getTagEntries());
//
//            /** @var TagEntryInterface $tagEntry */
//            foreach($resource->getTagEntries() as $tagEntry) {
//                /** @var TagInterface $tag */
//                $tag = $tagEntry->getTag();
//                $form->add($tag->getUniqueName(), $tag->getType(), array(
//                    'label' => $tag->getName()
//                ));
//            }
//        });
    }

    public function getName()
    {
        return 'resource';
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Inkstand\ResourceLibraryBundle\Entity\Resource',
        ));
    }
}