<?php

namespace Inkstand\Bundle\CoreBundle\Panel;

class PanelCollector
{
    private $panelTypes;

    public function addPanel(PanelInterface $panel)
    {
        $this->panelTypes[] = $panel;
    }
}