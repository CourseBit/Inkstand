<?php

namespace Inkstand\Library\TagBundle\Model;

use Inkstand\Library\TagBundle\Form\Type\TagType;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\Form\FormTypeInterface;

abstract class TagManager implements TagManagerInterface
{
    /**
     * @var FormFactoryInterface
     */
    private $formFactory;

    /**
     * @param FormFactoryInterface $formFactory
     */
    public function __construct(FormFactoryInterface $formFactory)
    {
        $this->formFactory = $formFactory;
    }

    /**
     * Return new tag instance
     *
     * @return TagInterface
     */
    public function create()
    {
        $class = $this->getClass();
        /** @var TagInterface $tag */
        $tag = new $class;

        return $tag;
    }

    /**
     * Build form for tag
     *
     * @param TagInterface $tag
     * @return FormTypeInterface
     */
    public function getForm(TagInterface $tag)
    {
        $tagType = $this->formFactory->create(new TagType($this->getClass()), $tag);

        if(empty($tag->getTagId())) {
            $label = 'tag.add';
        } else {
            $label = 'tag.edit';
        }

        $tagType->add('submit', 'submit', array(
            'label' => $label,
            'attr' => array('class' => 'btn btn-primary')
        ));

        return $tagType;
    }
}