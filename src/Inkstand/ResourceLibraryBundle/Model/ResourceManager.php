<?php

namespace Inkstand\ResourceLibraryBundle\Model;

use Inkstand\Bundle\CoreBundle\Service\SettingService;
use Inkstand\Bundle\UserBundle\Entity\User;
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
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormTypeInterface;
use Symfony\Component\HttpFoundation\ParameterBag;

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
     * @var SettingService
     */
    private $settingService;

    /**
     * @param FormFactoryInterface $formFactory
     */
    public function __construct(FormFactoryInterface $formFactory, $resourceTagManager,
                                 $resourceTagEntryManager, $settingService)
    {
        $this->formFactory = $formFactory;
        $this->resourceTagManager = $resourceTagManager;
        $this->resourceTagEntryManager = $resourceTagEntryManager;
        $this->settingService = $settingService;
    }

    /**
     * @param $resourceId
     * @return ResourceInterface
     */
    public function findOneByResourceId($resourceId)
    {
        return $this->findOneBy(array('resourceId' => $resourceId));
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
     * Persist resource and any related tags in form
     *
     * @param ResourceInterface $resource
     * @param FormTypeInterface $resourceForm
     */
    public function updateWithForm(ResourceInterface $resource, FormInterface $resourceForm)
    {
        $this->update($resource);

        /** @var FormInterface $formElement */
        foreach($resourceForm as $formElement) {
            if(strpos($formElement->getName(), ResourceType::TAG_FIELD_PREFIX) > -1) {
                $tagCode = str_replace(ResourceType::TAG_FIELD_PREFIX, '', $formElement->getName());
                $tag = $this->resourceTagManager->findOneByCode($tagCode);

                if(empty($tag)) {
                    throw new \LogicException('Found tag ' . $tagCode . ' in form, but it does not exist in the database.');
                }

                $tagEntry = $this->resourceTagEntryManager->findOneBy(array('objectId' => $resource->getResourceId(), 'tagId' => $tag->getTagId()));
                if(empty($tagEntry)) {
                    $tagEntry = $this->resourceTagEntryManager->create($tag, $resource);

                }
                $tagEntry->setValue($formElement->getData());
                $this->resourceTagEntryManager->update($tagEntry);
            }
        }
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

        $resourceTags = $this->resourceTagManager->findAll();

        $tagEntries = $resource->getTagEntries();
        $tagEntriesArray = array();

        // Key array by tag id for easy retrieval
        /** @var TagEntryInterface $tagEntry */
        foreach($tagEntries as $tagEntry) {
            $tagEntriesArray[$tagEntry->getTagId()] = $tagEntry;
        }

        /** @var TagInterface $resourceTag */
        foreach($resourceTags as $resourceTag) {

            if(array_key_exists($resourceTag->getTagId(), $tagEntriesArray)) {
                $tagEntry = $tagEntriesArray[$resourceTag->getTagId()];
            } else {
                $tagEntry = $this->resourceTagEntryManager->create($resourceTag, $resource);
            }

            switch($resourceTag->getType()) {
                case TagInterface::TYPE_TEXT:
                    $resourceType->add(ResourceType::TAG_FIELD_PREFIX . $resourceTag->getCode(), 'text', array(
                        'label' => $resourceTag->getName(),
                        'mapped' => false,
                        'data' => $tagEntry->getValue(),
                        'required' => $resourceTag->getRequired()
                    ));
                    break;
                case TagInterface::TYPE_DROPDOWN:
                    $choices = explode(PHP_EOL, $resourceTag->getChoices());
                    // Set keys the same as values
                    $choices = array_combine($choices, $choices);
                    $resourceType->add(ResourceType::TAG_FIELD_PREFIX . $resourceTag->getCode(), 'choice', array(
                        'label' => $resourceTag->getName(),
                        'mapped' => false,
                        'data' => $tagEntry->getValue(),
                        'choices' => $choices,
                        'empty_value' => 'Choose ' . $resourceTag->getName(),
                        'expanded' => false,
                        'multiple' => false,
                        'required' => $resourceTag->getRequired()
                    ));
                    break;
                case TagInterface::TYPE_CHECKBOX:
                    $choices = explode(PHP_EOL, $resourceTag->getChoices());
                    // Set keys the same as values
                    $choices = array_combine($choices, $choices);
                    $resourceType->add(ResourceType::TAG_FIELD_PREFIX . $resourceTag->getCode(), 'choice', array(
                        'label' => $resourceTag->getName(),
                        'mapped' => false,
                        'data' => explode(PHP_EOL, $tagEntry->getValue()),
                        'choices' => $choices,
                        'expanded' => true,
                        'multiple' => true,
                        'required' => $resourceTag->getRequired()
                    ));
                    break;
            }
        }

        $resourceId = $resource->getResourceId();
        if(empty($resourceId)) {
            $label = 'resource.add';
        } else {
            $label = 'resource.edit';
        }

        $resourceType->add('submit', 'submit', array(
            'label' => $label,
            'attr' => array('class' => 'btn btn-primary')
        ));

        return $resourceType;
    }

//    public function filter($resources)
//    {
//        $filters = array(
//            'audience' => array(
//                'value' => 'Highschool'
//            )
//        );
//        /** @var TaggableInterface $resource */
//        foreach($resources as $resource)
//        {
//            $tagEntries = $resource->getTagEntries();
//            $tags = array();
//
//            /** @var TagEntryInterface $tagEntry */
//            foreach($tagEntries as $tagEntry) {
//                if(!array_key_exists($tagEntry->getTag()->getTagId(), $tags)) {
//                    $tags[$tagEntry->getTag()->getCode()] = $tagEntry->getTag();
//                }
//            }
//
//            $tagMatch = false;
//
//            /** @var TagInterface $tag */
//            foreach($tags as $tag) {
//                if(array_key_exists($tag->getCode(), array_keys($filters))) {
//                    $tagMatch = true;
//                }
//            }
//
//            if($tagMatch) {
//                /** @var TagEntryInterface $tagEntry */
//                foreach($tagEntries as $tagEntry) {
//                    foreach($filters as $code => $filter) {
//                        if($code == $tagEntry->getTag()->getCode()) {
//                            if($tagEntry->getValue() == $filter['value'])
//                        }
//                    }
//                }
//            }
//        }
//    }

    /**
     * Get form for changing grid columns
     *
     * @param string $actionUrl
     * @param User $user
     * @return FormInterface
     */
    public function getGridColumnsForm($actionUrl, User $user)
    {
        $builder = $this->formFactory->createBuilder('form');

        $tagOptions = $this->resourceTagManager->getOptions();

        if($user->getOrganization()) {
            // TODO: Use organization code when it's added
            $settingName = $user->getOrganization()->getName() . 'gridColumns';
        } else {
            $settingName = $user->getUsername() . 'gridColumns';
        }

        $tagCodes = $this->settingService->get($settingName);
        if(!empty($tagCodes) && !empty($tagCodes->getValue())) {
            $choices = json_decode($tagCodes->getValue());
        } else {
            $choices = array();
        }

        $builder->add('tags', 'choice', array(
            'choices' => $tagOptions,
            'label' => '',
            'expanded' => true,
            'multiple' => true,
            'data' => $choices
        ));

        $builder->setAction($actionUrl);

        return $builder->getForm();
    }
}