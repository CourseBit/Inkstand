<?php

namespace Inkstand\Bundle\CoreBundle\Form\Type;

use Inkstand\Bundle\CoreBundle\Form\Type\FilePickerType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class FileReferenceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        //$builder->add('fileReferenceId', 'hidden');
        $builder->add('filesystemId', 'hidden', array(
            'attr' => array(
                'data-file' => 'filesystemId'
            )
        ));
        $builder->add('path', new FilePickerType(), array(
            'attr' => array(
                'data-file' => 'path'
            )
        ));
    }

    public function getName()
    {
        return 'fileReference';
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Inkstand\Bundle\CoreBundle\Entity\FileReference',
        ));
    }
}
