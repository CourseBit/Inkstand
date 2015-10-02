<?php

namespace Inkstand\Bundle\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Voter
 *
 * @ORM\Table("voter")
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
     * @ORM\OneToMany(targetEntity="VoterAction", mappedBy="voter")
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
