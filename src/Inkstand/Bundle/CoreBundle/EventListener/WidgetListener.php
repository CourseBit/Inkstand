<?php

namespace Inkstand\Bundle\CoreBundle\EventListener;


use Inkstand\Bundle\CoreBundle\Event\WidgetEvent;
use Inkstand\Bundle\CoreBundle\Widget\CalendarWidget;

class WidgetListener
{
    public function onWidgetRegister(WidgetEvent $event)
    {
        $event->registerWidget(new CalendarWidget());
    }
}