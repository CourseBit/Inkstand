<?php

namespace Inkstand\LrsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Agent
 *
 * @ORM\Table("lrs_actor")
 * @ORM\Entity
 */
class Actor
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
     * @ORM\Column(name="object_type", type="string", length=6)
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
     * @ORM\Column(name="parent_id", type="integer", nullable=true)
     */
    private $parentId = null;

    /**
     * @ORM\OneToMany(targetEntity="Actor", mappedBy="parent")
     */
    private $members;

    /**
     * @ORM\ManyToOne(targetEntity="Actor", inversedBy="children")
     * @ORM\JoinColumn(name="parent_id", referencedColumnName="id", nullable=true)
     */
    private $parent;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->children = new \Doctrine\Common\Collections\ArrayCollection();
    }

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
     * @return Agent
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
     * @return Agent
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
     * @return Agent
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
     * @return Agent
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
     * @return Agent
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
     * @return Agent
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
     * @return Agent
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

    /**
     * Set parentId
     *
     * @param integer $parentId
     * @return Actor
     */
    public function setParentId($parentId)
    {
        $this->parentId = $parentId;

        return $this;
    }

    /**
     * Get parentId
     *
     * @return integer 
     */
    public function getParentId()
    {
        return $this->parentId;
    }

    /**
     * Add members
     *
     * @param \Inkstand\LrsBundle\Entity\Actor $members
     * @return Actor
     */
    public function addMember(\Inkstand\LrsBundle\Entity\Actor $members)
    {
        $this->members[] = $members;

        return $this;
    }

    /**
     * Remove members
     *
     * @param \Inkstand\LrsBundle\Entity\Actor $members
     */
    public function removeMember(\Inkstand\LrsBundle\Entity\Actor $members)
    {
        $this->members->removeElement($members);
    }

    /**
     * Get members
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getMembers()
    {
        return $this->members;
    }

    /**
     * Set parent
     *
     * @param \Inkstand\LrsBundle\Entity\Actor $parent
     * @return Actor
     */
    public function setParent(\Inkstand\LrsBundle\Entity\Actor $parent = null)
    {
        $this->parent = $parent;

        return $this;
    }

    /**
     * Get parent
     *
     * @return \Inkstand\LrsBundle\Entity\Actor 
     */
    public function getParent()
    {
        return $this->parent;
    }
}
