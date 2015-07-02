<?php

namespace Inkstand\Bundle\CoreBundle\Widget;


interface WidgetInterface
{
    public function getId();
    public function getName();
    public function getPartial();
    public function getOrder();
}