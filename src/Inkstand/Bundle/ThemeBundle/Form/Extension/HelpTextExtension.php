<?php

namespace Inkstand\Bundle\ThemeBundle\Form\Extension;

use Symfony\Component\Form\AbstractTypeExtension;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class HelpTextExtension extends AbstractTypeExtension
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->setAttribute('help_text', $options['help_text']);
    }

    public function buildView(FormView $view, FormInterface $form, array $options)
    {
        $view->vars['help_text'] = $form->getConfig()->getAttribute('help_text');
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'help_text' => null,
        ));
    }

    public function getExtendedType()
    {
        return 'form';
    }
}
