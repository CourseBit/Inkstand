<?php

namespace Inkstand\Bundle\CoreBundle\Doctrine;

use Inkstand\Bundle\CoreBundle\Model\VehicleInterface;
use Inkstand\Bundle\CoreBundle\Model\VehicleManager as BaseVehicleManager;

class VehicleManager extends BaseVehicleManager
{
    /**
     * {@inheritdoc}
     */
    public function checkEnginePower(VehicleInterface $vehicle)
    {
        if($vehicle->getEngine()->getNumberCylinders() >= 6) {
            return true;
        }
    }
}