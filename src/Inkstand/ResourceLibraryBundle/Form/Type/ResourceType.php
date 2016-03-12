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
    const TAG_FIELD_PREFIX = 'resource_tag_field_';

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
            'attr' => array('class' => 'wysiwyg-editor'),
            'required' => false
        ));
        $builder->add('topics', 'entity', array(
            'class' => 'InkstandResourceLibraryBundle:Topic',
            'property' => 'name',
            'expanded' => false,
            'multiple' => true
        ));
    }

    public function getName()
    {
        return 'resource';
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'allow_extra_fields' => true,
            'data_class' => 'Inkstand\ResourceLibraryBundle\Entity\Resource',
        ));
    }
}