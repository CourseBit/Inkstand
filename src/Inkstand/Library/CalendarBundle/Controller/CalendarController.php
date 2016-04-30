<?php

namespace Inkstand\Library\CalendarBundle\Controller;

use Inkstand\Bundle\CoreBundle\Controller\Controller;
use Inkstand\Library\CalendarBundle\Model\CalendarInterface;
use Inkstand\Library\CalendarBundle\Options\CalendarOptions;
use Inkstand\Library\CalendarBundle\Options\JsonEventSource;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class CalendarController extends Controller
{
    public function indexAction()
    {
        $calendar = $this->get('inkstand_calendar.calendar_manager')->findOneByCalendarId(1);
        
        return $this->render('InkstandCalendarBundle:Calendar:index.html.twig', array(
            'calendar' => $calendar
        ));
    }

    public function renderAction(CalendarInterface $calendar)
    {
        $eventSource = new JsonEventSource();
        $eventSource->setUrl($this->generateUrl('inkstand_calendar_json', array('calendarId' => $calendar->getCalendarId())));
        $calendarOptions = new CalendarOptions();
        $calendarOptions->addEventSource($eventSource);
        $calendar->setCalendarOptions($calendarOptions);

        return $this->render('InkstandCalendarBundle:Calendar:render.html.twig', array(
            'calendar' => $calendar
        ));
    }

    /**
     * @param Request $request
     * @param integer $calendarId
     * @return JsonResponse
     */
    public function jsonAction(Request $request, $calendarId)
    {
        $start = $request->get('start');
        $end   = $request->get('end');

        $start = \DateTime::createFromFormat('Y-m-d', $start);
        $end   = \DateTime::createFromFormat('Y-m-d', $end);

        $events = $this->get('inkstand_calendar.event_manager')->findEvents($calendarId, $start, $end);

        return new JsonResponse($events);
    }
}