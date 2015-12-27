<?php

namespace Inkstand\Bundle\CoreBundle\Service;

use Inkstand\Bundle\CoreBundle\Entity\Setting;

class SettingService
{
    protected $entityManager;
    protected $repository;

    private $cachedSettings;

    public function __construct($entityManager)
    {
        $this->entityManager = $entityManager;
        $this->repository = $entityManager->getRepository('InkstandCoreBundle:Setting');
    }

    /**
     * Get all settings, either from cache or database
     *
     * TODO: Make this truly cached with Doctrine or something similar
     *
     * @return array
     */
    public function getSettings()
    {
        $this->checkSettings();

        return $this->cachedSettings;
    }

    /**
     * Populate cachedSettings if empty
     */
    private function checkSettings()
    {
        // Grab from cache if populated, otherwise get all settings from database
        if(null === $this->cachedSettings) {
            $settings = $this->repository->findAll();

            $this->cachedSettings = array();

            // Key array by setting name
            foreach($settings as $setting) {
                $this->cachedSettings[$setting->getName()] = $setting;
            }
        }
    }

    /**
     * Get setting by name
     *
     * @param $name
     * @return Setting|null
     */
    public function get($name)
    {
        $this->checkSettings();

        if(array_key_exists($name, $this->cachedSettings)) {
            return $this->cachedSettings[$name];
        }

        return null;
    }
}