<?php

namespace Inkstand\Bundle\CoreBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class FilePickerType extends AbstractType
{
    public function configureOptions(OptionsResolver $resolver)
    {

    }

    public function getParent()
    {
        return 'text';
    }

    public function getName()
    {
        return "filePicker";
    }
}