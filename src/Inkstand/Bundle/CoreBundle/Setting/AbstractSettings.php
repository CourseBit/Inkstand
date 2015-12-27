<?php

namespace Inkstand\Bundle\CoreBundle\Setting;

use Inkstand\Bundle\CoreBundle\Entity\Setting;
use Inkstand\Bundle\CoreBundle\Service\SettingService;

/**
 * Used for creating general settings pages.
 *
 * Class AbstractSettings
 * @package Inkstand\Bundle\CoreBundle\Setting
 */
abstract class AbstractSettings
{
    /**
     * Array of Settings added by child classes
     *
     * @var array
     */
    private $settings;

    /**
     * @var SettingService
     */
    private $settingService;

    /**
     * Construct. Also call build() on child class to get settings
     *
     * @param $settingService
     */
    public function __construct($settingService)
    {
        $this->settingService = $settingService;
        $this->build();
    }

    /**
     * Add setting
     *
     * @param Setting $setting
     */
    public function addSetting(Setting $setting)
    {
        $this->settings[$setting->getName()] = $setting;
    }

    /**
     * Add setting
     *
     * @param $name Setting and form element name
     * @param $type Form field type
     * @param array $options Form field options
     * @param string $defaultValue
     */
    public function add($name, $type, $options = array(), $defaultValue = null)
    {
        $setting = new Setting();
        $setting->setName($name);
        $setting->setValue($defaultValue);

        $allSettings = $this->settingService->getSettings();

        if(array_key_exists($setting->getName(), $allSettings)) {
            $setting = $allSettings[$setting->getName()];
        }

        $setting->setType($type);
        $setting->setOptions($options);

        $this->addSetting($setting);
    }

    /**
     * Get setting by name
     *
     * @param $name
     * @return Setting|null
     */
    public function get($name)
    {
        if(array_key_exists($name, $this->settings)) {
            return $this->settings[$name];
        }

        return null;
    }

    /**
     * Get all settings
     *
     * @return array
     */
    public function getSettings()
    {
        return $this->settings;
    }

    /**
     * Called to get setting definitions. Child classes should implement and use add() and addSetting() to build form.
     *
     * @return mixed
     */
    public abstract function build();
}