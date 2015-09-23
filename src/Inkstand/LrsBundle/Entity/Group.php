<?php

namespace Inkstand\LrsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Group2
 *
 * @ORM\Table("lrs_group")
 * @ORM\Entity
 */
class Group
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="objectType", type="string", length=5)
     */
    private $objectType;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=100)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="mbox", type="string", length=128)
     */
    private $mbox;

    /**
     * @var string
     *
     * @ORM\Column(name="mbox_sha1sum", type="string", length=40)
     */
    private $mbox_sha1sum;

    /**
     * @var string
     *
     * @ORM\Column(name="openid", type="string", length=2083)
     */
    private $openid;

    /**
     * @var string
     *
     * @ORM\Column(name="account_home_page", type="string", length=2083)
     */
    private $accountHomePage;

    /**
     * @var string
     *
     * @ORM\Column(name="account_name", type="string", length=2083)
     */
    private $accountName;

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set objectType
     *
     * @param string $objectType
     * @return Group2
     */
    public function setObjectType($objectType)
    {
        $this->objectType = $objectType;

        return $this;
    }

    /**
     * Get objectType
     *
     * @return string 
     */
    public function getObjectType()
    {
        return $this->objectType;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Group2
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
     * Set mbox
     *
     * @param string $mbox
     * @return Group
     */
    public function setMbox($mbox)
    {
        $this->mbox = $mbox;

        return $this;
    }

    /**
     * Get mbox
     *
     * @return string 
     */
    public function getMbox()
    {
        return $this->mbox;
    }

    /**
     * Set mbox_sha1sum
     *
     * @param string $mboxSha1sum
     * @return Group
     */
    public function setMboxSha1sum($mboxSha1sum)
    {
        $this->mbox_sha1sum = $mboxSha1sum;

        return $this;
    }

    /**
     * Get mbox_sha1sum
     *
     * @return string 
     */
    public function getMboxSha1sum()
    {
        return $this->mbox_sha1sum;
    }

    /**
     * Set openid
     *
     * @param string $openid
     * @return Group
     */
    public function setOpenid($openid)
    {
        $this->openid = $openid;

        return $this;
    }

    /**
     * Get openid
     *
     * @return string 
     */
    public function getOpenid()
    {
        return $this->openid;
    }

    /**
     * Set accountHomePage
     *
     * @param string $accountHomePage
     * @return Group
     */
    public function setAccountHomePage($accountHomePage)
    {
        $this->accountHomePage = $accountHomePage;

        return $this;
    }

    /**
     * Get accountHomePage
     *
     * @return string 
     */
    public function getAccountHomePage()
    {
        return $this->accountHomePage;
    }

    /**
     * Set accountName
     *
     * @param string $accountName
     * @return Group
     */
    public function setAccountName($accountName)
    {
        $this->accountName = $accountName;

        return $this;
    }

    /**
     * Get accountName
     *
     * @return string 
     */
    public function getAccountName()
    {
        return $this->accountName;
    }
}
