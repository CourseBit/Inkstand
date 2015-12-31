<?php

namespace Inkstand\Bundle\CoreBundle\Twig;

use Inkstand\Bundle\CoreBundle\Service\SettingService;

class SettingExtension extends \Twig_Extension
{
    /**
     * @var SettingService
     */
    private $settingService;

    public function __construct($settingService)
    {
        $this->settingService = $settingService;
    }

    public function getFunctions()
    {
        return array(
            'setting' => new \Twig_SimpleFunction('setting', array($this, 'setting'))
        );
    }

    public function setting($name)
    {
        $setting = $this->settingService->get($name);
        if(empty($setting)) {
            return null;
        }
        return $setting->getValue();
    }
    
    public function getName()
    {
        return 'setting_extension';
    }
}