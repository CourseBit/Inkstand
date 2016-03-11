<?php

namespace Inkstand\Bundle\CoreBundle\Model;

interface EngineInterface
{
    /**
     * @return integer
     */
    public function getNumberCylinders();

    /**
     * @param integer $numberOfCylinders
     */
    public function setNumberCylinders($numberOfCylinders);
}