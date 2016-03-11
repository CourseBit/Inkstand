<?php

namespace Inkstand\Bundle\CoreBundle\Model;

/**
 * Interface VehicleInterface
 * @package Inkstand\Bundle\CoreBundle\Model
 */
interface VehicleInterface
{
    /**
     * @return EngineInterface
     */
    public function getEngine();

    /**
     * @param EngineInterface $engine
     */
    public function setEngine(EngineInterface $engine);
}