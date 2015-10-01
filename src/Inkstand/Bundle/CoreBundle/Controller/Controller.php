<?php

namespace Inkstand\Bundle\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller as BaseController;

class Controller extends BaseController
{
    public function setContext($obectContext, $object = null, $createIfNull = false)
    {
        dump("Setting context");
        $this->get('inkstand_core.context')->setContext($obectContext, $object, $createIfNull);
    }
}