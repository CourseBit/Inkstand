<?php

namespace Inkstand\Bundle\CoreBundle\Model;

interface VehicleManagerInterface
{
    /**
     * Check if engine has enough power to pull something
     *
     * @param VehicleInterface $vehicle
     */
    public function checkEnginePower(VehicleInterface $vehicle);
}