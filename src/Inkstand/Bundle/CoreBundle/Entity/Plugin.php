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
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", nullable=true)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="homepage", type="string", nullable=true)
     */
    private $homepage;

    /**
     * @var array
     *
     * @ORM\Column(name="authors", type="json_array", nullable=true)
     */
    private $authors;

    /**
     * @var array
     *
     * @ORM\Column(name="support", type="json_array", nullable=true)
     */
    private $support;

    /**
     * @var string
     *
     * @ORM\Column(name="bundle_class", type="string", length=255)
     */
    private $bundleClass;

    /**
     * @var string
     *
     * @ORM\Column(name="bundle_title", type="string", length=255)
     */
    private $bundleTitle;

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
     * @var \DateTime
     *
     * @ORM\Column(name="date_installed", type="datetime")
     */
    private $dateInstalled;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_updated", type="datetime")
     */
    private $dateUpdated;

    /**
     * Get pluginId
     *
     * @return integer 
     */
    public function getPluginId()
    {
        return $this->pluginId;
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

    /**
     * Set name
     *
     * @param string $name
     * @return Plugin
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Plugin
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set homepage
     *
     * @param string $homepage
     * @return Plugin
     */
    public function setHomepage($homepage)
    {
        $this->homepage = $homepage;

        return $this;
    }

    /**
     * Get homepage
     *
     * @return string 
     */
    public function getHomepage()
    {
        return $this->homepage;
    }

    /**
     * Set authors
     *
     * @param array $authors
     * @return Plugin
     */
    public function setAuthors($authors)
    {
        $this->authors = $authors;

        return $this;
    }

    /**
     * Get authors
     *
     * @return array 
     */
    public function getAuthors()
    {
        return $this->authors;
    }

    /**
     * Set support
     *
     * @param array $support
     * @return Plugin
     */
    public function setSupport($support)
    {
        $this->support = $support;

        return $this;
    }

    /**
     * Get support
     *
     * @return array 
     */
    public function getSupport()
    {
        return $this->support;
    }

    /**
     * Set bundleTitle
     *
     * @param string $bundleTitle
     * @return Plugin
     */
    public function setBundleTitle($bundleTitle)
    {
        $this->bundleTitle = $bundleTitle;

        return $this;
    }

    /**
     * Get bundleTitle
     *
     * @return string 
     */
    public function getBundleTitle()
    {
        return $this->bundleTitle;
    }

    /**
     * Set dateInstalled
     *
     * @param \DateTime $dateInstalled
     * @return Plugin
     */
    public function setDateInstalled($dateInstalled)
    {
        $this->dateInstalled = $dateInstalled;

        return $this;
    }

    /**
     * Get dateInstalled
     *
     * @return \DateTime
     */
    public function getDateInstalled()
    {
        return $this->dateInstalled;
    }

    /**
     * Set dateUpdated
     *
     * @param \DateTime $dateUpdated
     * @return Plugin
     */
    public function setDateUpdated($dateUpdated)
    {
        $this->dateUpdated = $dateUpdated;

        return $this;
    }

    /**
     * Get dateUpdated
     *
     * @return \DateTime
     */
    public function getDateUpdated()
    {
        return $this->dateUpdated;
    }
}
