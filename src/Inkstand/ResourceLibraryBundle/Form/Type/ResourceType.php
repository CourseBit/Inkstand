<?php

namespace Inkstand\ResourceLibraryBundle\Form\Type;

use Inkstand\Bundle\CoreBundle\Form\Type\FileReferenceType;
use Inkstand\Bundle\CourseBundle\Entity\Course;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
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
        $builder->add('description', 'textarea');
        $builder->add('topic', 'entity', array(
            'class' => 'InkstandResourceLibraryBundle:Topic',
            'property' => 'name',
            'expanded' => false,
            'multiple' => false
        ));

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