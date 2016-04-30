<?php

namespace Inkstand\Library\CalendarBundle\Controller;

use Inkstand\Bundle\CoreBundle\Controller\Controller;
use Inkstand\Library\CalendarBundle\Model\CalendarManagerInterface;
use Inkstand\Library\CalendarBundle\Model\EventInterface;
use Inkstand\Library\CalendarBundle\Model\EventManager;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class EventController extends Controller
{
    /**
     * Save event from json
     * 
     * @param Request $request
     * @return JsonResponse
     */
    public function saveAction(Request $request)
    {
        $eventData = $request->get('event');
        $eventData = json_decode($eventData, true);

        /** @var EventManager $eventManager */
        $eventManager = $this->get('inkstand_calendar.event_manager');
        /** @var CalendarManagerInterface $calendarManager */
        $calendarManager = $this->get('inkstand_calendar.calendar_manager');

        /** @var EventInterface $event */
        $event = $eventManager->findOneByEventId($eventData['id']);

        if (empty($event)) {
            $event = $eventManager->create();
        }
        
        $event->fromArray($eventData);

        $calendar = $calendarManager->findOneByCalendarId($eventData['calendarId']);
        $event->setCalendar($calendar);
        
        $eventManager->update($event);

        return new JsonResponse(array('status' => 'success'));
    }
    
    public function addAction(Request $request)
    {
        $eventData = $request->get('event');
        $eventData = json_decode($eventData, true);

        /** @var EventManager $eventManager */
        $eventManager = $this->get('inkstand_calendar.event_manager');

        /** @var EventInterface $event */
        $event = $eventManager->create();
        $event->fromArray($eventData);
        $eventManager->update($event);

        return new JsonResponse(array('status' => 'success'));
    }
}