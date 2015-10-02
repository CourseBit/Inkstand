<?php

namespace Inkstand\LrsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * StatementRef
 *
 * @ORM\Table("lrs_statement_ref")
 * @ORM\Entity
 */
class StatementRef
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
     * @ORM\Column(name="object_yype", type="string", length=12)
     */
    private $objectType;

    /**
     * @var string
     *
     * @ORM\Column(name="statement_id", type="string", length=36)
     */
    private $statementId;


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
     * @return StatementRef
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
     * Set statementId
     *
     * @param string $statementId
     * @return StatementRef
     */
    public function setStatementId($statementId)
    {
        $this->statementId = $statementId;

        return $this;
    }

    /**
     * Get statementId
     *
     * @return string 
     */
    public function getStatementId()
    {
        return $this->statementId;
    }
}
