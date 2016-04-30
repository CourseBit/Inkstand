<?php

namespace Inkstand\ResourceLibraryBundle\Controller;

use FOS\UserBundle\Model\UserInterface;
use Inkstand\Bundle\CoreBundle\Controller\Controller;
use Inkstand\Bundle\UserBundle\Model\OrganizationInterface;
use Inkstand\Library\CalendarBundle\Model\CalendarManagerInterface;
use Inkstand\Library\TagBundle\Model\TagInterface;
use Inkstand\ResourceLibraryBundle\Doctrine\ResourceTagManager;
use Inkstand\ResourceLibraryBundle\Entity\Resource;
use Inkstand\ResourceLibraryBundle\Entity\Topic;
use Inkstand\ResourceLibraryBundle\Form\Type\ResourceType;
use Inkstand\ResourceLibraryBundle\Model\ResourceManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class LibraryController extends Controller
{
    /**
     * @Route("/library", name="inkstand_resource_library_index")
     * @Template
     */
    public function indexAction()
    {
        /** @var ResourceManagerInterface $resourceManager */
        $resourceManager = $this->get('inkstand_resource_library.resource_manager');
        /** @var ResourceTagManager $resourceTagManager */
        $resourceTagManager = $this->get('inkstand_resource_library.resource_tag_manager');
        $resources = $resourceManager->findAll();

        $topics = $this->get('inkstand_resource_library.topic')->findAllShownInLibrary();

        $filterForm = $this->createFormBuilder();
        $filterForm->add('topics', 'entity', array(
            'class' => 'Inkstand\ResourceLibraryBundle\Entity\Topic',
            'property' => 'name',
            'expanded' => true,
            'multiple' => true
        ));
        /** @var TagInterface $resourceTag */
        foreach($resourceTagManager->findAll() as $resourceTag) {

            $choices = explode(PHP_EOL, $resourceTag->getChoices());
            // Set keys the same as values
            $choices = array_combine($choices, $choices);
            switch($resourceTag->getType()) {
                case TagInterface::TYPE_TEXT:
                    $filterForm->add(ResourceType::TAG_FIELD_PREFIX . $resourceTag->getCode(), 'text', array(
                        'label' => $resourceTag->getName(),
                        'mapped' => false,
                    ));
                    break;
                case TagInterface::TYPE_DROPDOWN:
                case TagInterface::TYPE_CHECKBOX:
                    $choices = explode(PHP_EOL, $resourceTag->getChoices());
                    // Set keys the same as values
                    $choices = array_combine($choices, $choices);
                    $filterForm->add(ResourceType::TAG_FIELD_PREFIX . $resourceTag->getCode(), 'choice', array(
                        'label' => $resourceTag->getName(),
                        'mapped' => false,
                        'choices' => $choices,
                        'expanded' => true,
                        'multiple' => true,
                    ));
                    break;
            }
        }
        $filterForm->add('submit', 'submit', array(
            'label' => 'Apply Filters',
            'attr' => array('class' => 'btn btn-primary')
        ));
        $filterForm = $filterForm->getForm();

        $gridColumnsForm = $resourceManager->getGridColumnsForm($this->generateUrl('inkstand_resource_library_grid_columns_form'), $this->getUser());

        /** @var CalendarManagerInterface $calendarManager */
        $calendarManager = $this->get('inkstand_calendar.calendar_manager');
        $calendar = $calendarManager->findOneByCode($this->getUser()->getOrganization()->getName());

        return array(
            'resources' => $resources,
            'newResource' => new Resource(),
            'newResourceTag' => $resourceTagManager->create(),
            'newTopic' => new Topic(),
            'topics' => $topics,
            'filterForm' => $filterForm->createView(),
            'gridColumnsForm' => $gridColumnsForm->createView(),
            'calendar' => $calendar
        );
    }

    /**
     * @Route("/library/schedule", name="inkstand_resource_library_schedule")
     * @Template
     */
    public function scheduleAction()
    {
        /** @var ResourceManagerInterface $resourceManager */
        $resourceManager = $this->get('inkstand_resource_library.resource_manager');
        /** @var CalendarManagerInterface $calendarManager */
        $calendarManager = $this->get('inkstand_calendar.calendar_manager');

        /** @var UserInterface $user */
        $user = $this->getUser();

        /** @var OrganizationInterface $organization */
        if (!$organization = $user->getOrganization()) {
            throw new \LogicException('You do not belong to an organization');
        }

        $calendar = $calendarManager->getCalendar($organization->getName());
        $resources = $resourceManager->findAll();

        return array(
            'calendar' => $calendar,
            'resources' => $resources
        );
    }
}