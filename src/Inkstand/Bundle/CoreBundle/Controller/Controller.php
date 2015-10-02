<?php

namespace Inkstand\Bundle\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller as BaseController;

class Controller extends BaseController
{
    public function setContext($objectContext, $object = null, $createIfNull = false)
    {
        $this->get('inkstand_core.context')->setContext($objectContext, $object, $createIfNull);
    }
}