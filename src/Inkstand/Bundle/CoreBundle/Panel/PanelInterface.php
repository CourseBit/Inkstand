<?php

namespace Inkstand\Bundle\CoreBundle\Panel;


interface PanelInterface
{
    /**
     * Return controller syntax bundle:controller:action
     *
     * @return string
     */
    public function getController();

    /**
     * Return unique name for Panel
     *
     * @return string
     */
    public function getName();
}