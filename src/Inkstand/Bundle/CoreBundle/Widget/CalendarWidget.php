<?php

namespace Inkstand\Bundle\CoreBundle\Widget;

class CalendarWidget implements WidgetInterface
{
    public function getId()
    {
        return 'calendar_widget';
    }

    public function getName()
    {
        return 'calendar_widget.name';
    }

    public function getPartial()
    {
        return 'InkstandCoreBundle:partial:calendar_widget.html.twig';
    }

    public function getOrder() {}
}