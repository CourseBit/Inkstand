<?php

namespace Inkstand\ResourceLibraryBundle\Model;

use Inkstand\Library\RatingBundle\Model\RateableInterface;
use Inkstand\Library\TagBundle\Model\TagEntryInterface;
use Inkstand\Library\TagBundle\Model\TagEntryManagerInterface;
use Inkstand\Library\TagBundle\Model\TaggableInterface;
use Inkstand\Library\TagBundle\Model\TagInterface;
use Inkstand\Library\TagBundle\Model\TagManagerInterface;
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
     * @var TagManagerInterface
     */
    private $resourceTagManager;

    /**
     * @var TagEntryManagerInterface
     */
    private $resourceTagEntryManager;

    /**
     * @param FormFactoryInterface $formFactory
     */
    public function __construct(FormFactoryInterface $formFactory,  $resourceTagManager,
                                 $resourceTagEntryManager)
    {
        $this->formFactory = $formFactory;
        $this->resourceTagManager = $resourceTagManager;
        $this->resourceTagEntryManager = $resourceTagEntryManager;
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

//        $resourceTags = $this->resourceTagManager->findAll();
//
//        $tagEntries = $resource->getTagEntries();
//        $tagEntriesArray = array();
//
//        // Key array by tag id for easy retrieval
//        /** @var TagEntryInterface $tagEntry */
//        foreach($tagEntries as $tagEntry) {
//            $tagEntriesArray[$tagEntry->getTagId()] = $tagEntry;
//        }
//
//        /** @var TagInterface $resourceTag */
//        foreach($resourceTags as $resourceTag) {
//
//            if(array_key_exists($resourceTag->getTagId(), $tagEntriesArray)) {
//                $tagEntry = $tagEntriesArray[$resourceTag->getTagId()];
//            } else {
//                $tagEntry = $this->resourceTagEntryManager->create($resourceTag, $resource);
//            }
//
//            switch($resourceTag->getType()) {
//                case TagInterface::TYPE_TEXT:
//                    $resourceType->add($resourceTag->getUniqueName(), 'text', array(
//                        'label' => $resourceTag->getName(),
//                        'mapped' => false,
//                        'data' => $tagEntry->getValue()
//                    ));
//                    break;
//            }
//        }

        $resourceId = $resource->getResourceId();
        if(empty($resourceId)) {
            $label = 'tag.add';
        } else {
            $label = 'tag.edit';
        }

        $resourceType->add('submit', 'submit', array(
            'label' => $label,
            'attr' => array('class' => 'btn btn-primary')
        ));

        return $resourceType;
    }
}