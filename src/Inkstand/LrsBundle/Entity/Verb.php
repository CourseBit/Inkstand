<?php

namespace Inkstand\LrsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * Verb
 *
 * @ORM\Table("lrs_verb")
 * @ORM\Entity
 */
class Verb
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
     * @ORM\Column(name="verb_id", type="string", length=2083)
     */
    private $verbId;

    /**
     * @var array
     *
     * @ORM\Column(name="display", type="json_array")
     */
    private $display;

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
     * Set verbId
     *
     * @param string $verbId
     * @return Verb
     */
    public function setVerbId($verbId)
    {
        $this->verbId = $verbId;

        return $this;
    }

    /**
     * Get verbId
     *
     * @return string 
     */
    public function getVerbId()
    {
        return $this->verbId;
    }

    /**
     * Set display
     *
     * @param array $display
     * @return Verb
     */
    public function setDisplay($display)
    {
        $this->display = $display;

        return $this;
    }

    /**
     * Get display
     *
     * @return array 
     */
    public function getDisplay()
    {
        return $this->display;
    }
}
