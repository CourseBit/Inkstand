<?php

namespace Inkstand\ResourceLibraryBundle\Model;

use Inkstand\ResourceLibraryBundle\Form\Type\ResourceType;
use Inkstand\ResourceLibraryBundle\Model\ResourceInterface;
use Inkstand\ResourceLibraryBundle\Model\ResourceManagerInterface;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\Form\FormTypeInterface;

abstract class ResourceManager implements ResourceManagerInterface
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
     * Return new resource instance
     *
     * @return ResourceInterface
     */
    public function create()
    {
        $class = $this->getClass();
        /** @var ResourceInterface $resource */
        $resource = new $class;

        return $resource;
    }

    /**
     * Build form for resource
     *
     * @param ResourceInterface $resource
     * @return FormTypeInterface
     */
    public function getForm(ResourceInterface $resource)
    {
        $resourceType = $this->formFactory->create(new ResourceType(), $resource);



        if(empty($resource->getResourceId())) {
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