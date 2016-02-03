<?php

namespace Inkstand\Bundle\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Voter
 *
 * @ORM\Table("lms_voter")
 * @ORM\Entity
 */
class Voter
{
    /**
     * @var integer
     *
     * @ORM\Column(name="voter_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $voterId;

    /**
     * @var string
     *
     * @ORM\Column(name="service", type="string", length=255)
     */
    private $service;

    /**
     * @var string
     * @ORM\Column(name="class_name", type="string", length=255)
     */
    private $className;

    /**
     * @ORM\OneToMany(targetEntity="VoterAction", mappedBy="voter", cascade={"remove"})
     */
    private $voterActions;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->voterActions = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Get voterId
     *
     * @return integer 
     */
    public function getVoterId()
    {
        return $this->voterId;
    }

    /**
     * Set service
     *
     * @param string $service
     * @return Voter
     */
    public function setService($service)
    {
        $this->service = $service;

        return $this;
    }

    /**
     * Get service
     *
     * @return string 
     */
    public function getService()
    {
        return $this->service;
    }

    /**
     * Set className
     *
     * @param string $className
     * @return Voter
     */
    public function setClassName($className)
    {
        $this->className = $className;

        return $this;
    }

    /**
     * Get className
     *
     * @return string
     */
    public function getClassName()
    {
        return $this->className;
    }

    /**
     * Add voterActions
     *
     * @param \Inkstand\Bundle\CoreBundle\Entity\VoterActions $voterActions
     * @return Voter
     */
    public function addVoterAction(\Inkstand\Bundle\CoreBundle\Entity\VoterAction $voterActions)
    {
        $this->voterActions[] = $voterActions;

        return $this;
    }

    /**
     * Remove voterActions
     *
     * @param \Inkstand\Bundle\CoreBundle\Entity\VoterActions $voterActions
     */
    public function removeVoterAction(\Inkstand\Bundle\CoreBundle\Entity\VoterAction $voterActions)
    {
        $this->voterActions->removeElement($voterActions);
    }

    /**
     * Get voterActions
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getVoterActions()
    {
        return $this->voterActions;
    }
}
