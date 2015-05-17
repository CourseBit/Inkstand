<?php

namespace Inkstand\Bundle\ThemeBundle\Form\Extension;

use Symfony\Component\Form\AbstractTypeExtension;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class InputAddonExtension extends AbstractTypeExtension
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->setAttribute('input_addon', $options['input_addon']);
    }

    public function buildView(FormView $view, FormInterface $form, array $options)
    {
        $view->vars['input_addon'] = $form->getConfig()->getAttribute('input_addon');
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'input_addon' => null,
        ));
    }

    public function getExtendedType()
    {
        return 'form';
    }
}
