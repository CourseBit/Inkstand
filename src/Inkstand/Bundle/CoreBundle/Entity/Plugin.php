<?php

namespace Inkstand\Bundle\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Plugin
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Inkstand\Bundle\CoreBundle\Entity\PluginRepository")
 */
class Plugin
{
    /**
     * @var integer
     *
     * @ORM\Column(name="plugin_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $pluginId;

    /**
     * @var string
     *
     * @ORM\Column(name="bundle_class", type="string", length=255)
     */
    private $bundleClass;

    /**
     * @var integer
     *
     * @ORM\Column(name="enabled", type="integer")
     */
    private $enabled;

    /**
     * @var string
     *
     * @ORM\Column(name="version", type="string", length=255)
     */
    private $version;


    /**
     * Get pluginId
     *
     * @return integer 
     */
    public function getPluginId()
    {
        return $this->pluginIdId;
    }

    /**
     * Set bundleClass
     *
     * @param string $bundleClass
     * @return Plugin
     */
    public function setBundleClass($bundleClass)
    {
        $this->bundleClass = $bundleClass;

        return $this;
    }

    /**
     * Get bundleClass
     *
     * @return string 
     */
    public function getBundleClass()
    {
        return $this->bundleClass;
    }

    /**
     * Set enabled
     *
     * @param integer $enabled
     * @return Plugin
     */
    public function setEnabled($enabled)
    {
        $this->enabled = $enabled;

        return $this;
    }

    /**
     * Get enabled
     *
     * @return integer 
     */
    public function getEnabled()
    {
        return $this->enabled;
    }

    /**
     * Set version
     *
     * @param string $version
     * @return Plugin
     */
    public function setVersion($version)
    {
        $this->version = $version;

        return $this;
    }

    /**
     * Get version
     *
     * @return string 
     */
    public function getVersion()
    {
        return $this->version;
    }
}
