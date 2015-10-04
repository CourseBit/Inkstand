<?php

namespace Inkstand\LrsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * Statement
 *
 * @ORM\Table("lrs_statement")
 * @ORM\Entity
 */
class Statement
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
     * @ORM\Column(name="statement_id", type="string", length=36, options={"fixed" = true})
     */
    private $statementId;

    /**
     * @var integer
     *
     * @ORM\Column(name="actor_id", type="integer")
     */
    private $actorId;

    /**
     * @var integer
     *
     * @ORM\Column(name="verb_id", type="integer")
     */
    private $verbId;

    /**
     * @var integer
     *
     * @ORM\Column(name="object_activity_id", type="integer")
     */
    private $objectActivityId;

    /**
     * @var integer
     *
     * @ORM\Column(name="object_actor_id", type="integer")
     */
    private $objectActorId;

    /**
     * @var integer
     *
     * @ORM\Column(name="object_substatement_id", type="integer")
     */
    private $objectSubstatementId;

    /**
     * @var integer
     *
     * @ORM\Column(name="object_statement_ref_id", type="integer")
     */
    private $objectStatementRefId;

    /**
     * @var string
     *
     * @ORM\Column(name="result_score_scaled", type="decimal", nullable=true)
     */
    private $resultScoreScaled;

    /**
     * @var string
     *
     * @ORM\Column(name="result_score_raw", type="decimal"), nullable=true
     */
    private $resultScoreRaw;

    /**
     * @var string
     *
     * @ORM\Column(name="result_score_min", type="decimal", nullable=true)
     */
    private $resultScoreMin;

    /**
     * @var string
     *
     * @ORM\Column(name="result_score_max", type="decimal", nullable=true)
     */
    private $resultScoreMax;

    /**
     * @var boolean
     *
     * @ORM\Column(name="result_success", type="boolean", nullable=true)
     */
    private $resultSuccess;

    /**
     * @var boolean
     *
     * @ORM\Column(name="result_completion", type="boolean", nullable=true)
     */
    private $resultCompletion;

    /**
     * @var string
     *
     * @ORM\Column(name="result_response", type="string", nullable=true)
     */
    private $resultResponse;

    /**
     * @var string
     *
     * @ORM\Column(name="result_duration", type="string", length=40, nullable=true)
     */
    private $resultDuration;

    /**
     * @var array
     *
     * @ORM\Column(name="result_extensions", type="json_array", nullable=true)
     */
    private $resultExtensions;

    /**
     * @var string
     *
     * @ORM\Column(name="context_registration", type="string", length=36, options={"fixed" = true}, nullable=true)
     */
    private $contextRegistration;

    /**
     * @var integer
     *
     * @ORM\Column(name="context_instructor_id", type="integer", nullable=true)
     */
    private $contextInstructorId;

    /**
     * @var integer
     *
     * @ORM\Column(name="context_team_id", type="integer", nullable=true)
     */
    private $contextTeamId;

    /**
     * @var string
     *
     * @ORM\Column(name="context_revision", type="string", nullable=true)
     */
    private $contextRevision;

    /**
     * @var string
     *
     * @ORM\Column(name="context_platform", type="string", length=50, nullable=true)
     */
    private $contextPlatform;

    /**
     * @var string
     *
     * @ORM\Column(name="context_language", type="string", length=50, nullable=true)
     */
    private $contextLanguage;

    /**
     * @var integer
     *
     * @ORM\Column(name="context_statement_ref_id", type="integer", nullable=true)
     */
    private $contextStatementRefId;

    /**
     * @var array
     *
     * @ORM\Column(name="context_extensions", type="json_array", nullable=true)
     */
    private $contextExtensions;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="timestamp", type="datetimetz", nullable=true)
     */
    private $timestamp;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="stored", type="datetimetz", nullable=true)
     */
    private $stored;

    /**
     * @var integer
     *
     * @ORM\Column(name="authority_id", type="integer", nullable=true)
     */
    private $authorityId;

    /**
     * @var string
     *
     * @ORM\Column(name="version", type="string", length=7, nullable=true)
     */
    private $version;

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
     * Set statementId
     *
     * @param string $statementId
     * @return Statement
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

    /**
     * Set actorId
     *
     * @param integer $actorId
     * @return Statement
     */
    public function setActorId($actorId)
    {
        $this->actorId = $actorId;

        return $this;
    }

    /**
     * Get actorId
     *
     * @return integer 
     */
    public function getActorId()
    {
        return $this->actorId;
    }

    /**
     * Set verbId
     *
     * @param integer $verbId
     * @return Statement
     */
    public function setVerbId($verbId)
    {
        $this->verbId = $verbId;

        return $this;
    }

    /**
     * Get verbId
     *
     * @return integer 
     */
    public function getVerbId()
    {
        return $this->verbId;
    }

    /**
     * Set objectActivityId
     *
     * @param integer $objectActivityId
     * @return Statement
     */
    public function setObjectActivityId($objectActivityId)
    {
        $this->objectActivityId = $objectActivityId;

        return $this;
    }

    /**
     * Get objectActivityId
     *
     * @return integer 
     */
    public function getObjectActivityId()
    {
        return $this->objectActivityId;
    }

    /**
     * Set objectActorId
     *
     * @param integer $objectActorId
     * @return Statement
     */
    public function setObjectActorId($objectActorId)
    {
        $this->objectActorId = $objectActorId;

        return $this;
    }

    /**
     * Get objectActorId
     *
     * @return integer 
     */
    public function getObjectActorId()
    {
        return $this->objectActorId;
    }

    /**
     * Set objectSubstatementId
     *
     * @param integer $objectSubstatementId
     * @return Statement
     */
    public function setObjectSubstatementId($objectSubstatementId)
    {
        $this->objectSubstatementId = $objectSubstatementId;

        return $this;
    }

    /**
     * Get objectSubstatementId
     *
     * @return integer 
     */
    public function getObjectSubstatementId()
    {
        return $this->objectSubstatementId;
    }

    /**
     * Set objectStatementRefId
     *
     * @param integer $objectStatementRefId
     * @return Statement
     */
    public function setObjectStatementRefId($objectStatementRefId)
    {
        $this->objectStatementRefId = $objectStatementRefId;

        return $this;
    }

    /**
     * Get objectStatementRefId
     *
     * @return integer 
     */
    public function getObjectStatementRefId()
    {
        return $this->objectStatementRefId;
    }

    /**
     * Set resultScoreScaled
     *
     * @param string $resultScoreScaled
     * @return Statement
     */
    public function setResultScoreScaled($resultScoreScaled)
    {
        $this->resultScoreScaled = $resultScoreScaled;

        return $this;
    }

    /**
     * Get resultScoreScaled
     *
     * @return string 
     */
    public function getResultScoreScaled()
    {
        return $this->resultScoreScaled;
    }

    /**
     * Set resultScoreRaw
     *
     * @param string $resultScoreRaw
     * @return Statement
     */
    public function setResultScoreRaw($resultScoreRaw)
    {
        $this->resultScoreRaw = $resultScoreRaw;

        return $this;
    }

    /**
     * Get resultScoreRaw
     *
     * @return string 
     */
    public function getResultScoreRaw()
    {
        return $this->resultScoreRaw;
    }

    /**
     * Set resultScoreMin
     *
     * @param string $resultScoreMin
     * @return Statement
     */
    public function setResultScoreMin($resultScoreMin)
    {
        $this->resultScoreMin = $resultScoreMin;

        return $this;
    }

    /**
     * Get resultScoreMin
     *
     * @return string 
     */
    public function getResultScoreMin()
    {
        return $this->resultScoreMin;
    }

    /**
     * Set resultScoreMax
     *
     * @param string $resultScoreMax
     * @return Statement
     */
    public function setResultScoreMax($resultScoreMax)
    {
        $this->resultScoreMax = $resultScoreMax;

        return $this;
    }

    /**
     * Get resultScoreMax
     *
     * @return string 
     */
    public function getResultScoreMax()
    {
        return $this->resultScoreMax;
    }

    /**
     * Set resultSuccess
     *
     * @param boolean $resultSuccess
     * @return Statement
     */
    public function setResultSuccess($resultSuccess)
    {
        $this->resultSuccess = $resultSuccess;

        return $this;
    }

    /**
     * Get resultSuccess
     *
     * @return boolean 
     */
    public function getResultSuccess()
    {
        return $this->resultSuccess;
    }

    /**
     * Set resultCompletion
     *
     * @param boolean $resultCompletion
     * @return Statement
     */
    public function setResultCompletion($resultCompletion)
    {
        $this->resultCompletion = $resultCompletion;

        return $this;
    }

    /**
     * Get resultCompletion
     *
     * @return boolean 
     */
    public function getResultCompletion()
    {
        return $this->resultCompletion;
    }

    /**
     * Set resultResponse
     *
     * @param string $resultResponse
     * @return Statement
     */
    public function setResultResponse($resultResponse)
    {
        $this->resultResponse = $resultResponse;

        return $this;
    }

    /**
     * Get resultResponse
     *
     * @return string 
     */
    public function getResultResponse()
    {
        return $this->resultResponse;
    }

    /**
     * Set resultDuration
     *
     * @param string $resultDuration
     * @return Statement
     */
    public function setResultDuration($resultDuration)
    {
        $this->resultDuration = $resultDuration;

        return $this;
    }

    /**
     * Get resultDuration
     *
     * @return string 
     */
    public function getResultDuration()
    {
        return $this->resultDuration;
    }

    /**
     * Set resultExtensions
     *
     * @param array $resultExtensions
     * @return Statement
     */
    public function setResultExtensions($resultExtensions)
    {
        $this->resultExtensions = $resultExtensions;

        return $this;
    }

    /**
     * Get resultExtensions
     *
     * @return array 
     */
    public function getResultExtensions()
    {
        return $this->resultExtensions;
    }

    /**
     * Set contextRegistration
     *
     * @param string $contextRegistration
     * @return Statement
     */
    public function setContextRegistration($contextRegistration)
    {
        $this->contextRegistration = $contextRegistration;

        return $this;
    }

    /**
     * Get contextRegistration
     *
     * @return string 
     */
    public function getContextRegistration()
    {
        return $this->contextRegistration;
    }

    /**
     * Set contextInstructorId
     *
     * @param integer $contextInstructorId
     * @return Statement
     */
    public function setContextInstructorId($contextInstructorId)
    {
        $this->contextInstructorId = $contextInstructorId;

        return $this;
    }

    /**
     * Get contextInstructorId
     *
     * @return integer 
     */
    public function getContextInstructorId()
    {
        return $this->contextInstructorId;
    }

    /**
     * Set contextTeamId
     *
     * @param integer $contextTeamId
     * @return Statement
     */
    public function setContextTeamId($contextTeamId)
    {
        $this->contextTeamId = $contextTeamId;

        return $this;
    }

    /**
     * Get contextTeamId
     *
     * @return integer 
     */
    public function getContextTeamId()
    {
        return $this->contextTeamId;
    }

    /**
     * Set contextRevision
     *
     * @param string $contextRevision
     * @return Statement
     */
    public function setContextRevision($contextRevision)
    {
        $this->contextRevision = $contextRevision;

        return $this;
    }

    /**
     * Get contextRevision
     *
     * @return string 
     */
    public function getContextRevision()
    {
        return $this->contextRevision;
    }

    /**
     * Set contextPlatform
     *
     * @param string $contextPlatform
     * @return Statement
     */
    public function setContextPlatform($contextPlatform)
    {
        $this->contextPlatform = $contextPlatform;

        return $this;
    }

    /**
     * Get contextPlatform
     *
     * @return string 
     */
    public function getContextPlatform()
    {
        return $this->contextPlatform;
    }

    /**
     * Set contextLanguage
     *
     * @param string $contextLanguage
     * @return Statement
     */
    public function setContextLanguage($contextLanguage)
    {
        $this->contextLanguage = $contextLanguage;

        return $this;
    }

    /**
     * Get contextLanguage
     *
     * @return string 
     */
    public function getContextLanguage()
    {
        return $this->contextLanguage;
    }

    /**
     * Set contextStatementRefId
     *
     * @param integer $contextStatementRefId
     * @return Statement
     */
    public function setContextStatementRefId($contextStatementRefId)
    {
        $this->contextStatementRefId = $contextStatementRefId;

        return $this;
    }

    /**
     * Get contextStatementRefId
     *
     * @return integer 
     */
    public function getContextStatementRefId()
    {
        return $this->contextStatementRefId;
    }

    /**
     * Set contextExtensions
     *
     * @param array $contextExtensions
     * @return Statement
     */
    public function setContextExtensions($contextExtensions)
    {
        $this->contextExtensions = $contextExtensions;

        return $this;
    }

    /**
     * Get contextExtensions
     *
     * @return array 
     */
    public function getContextExtensions()
    {
        return $this->contextExtensions;
    }

    /**
     * Set timestamp
     *
     * @param \DateTime $timestamp
     * @return Statement
     */
    public function setTimestamp($timestamp)
    {
        $this->timestamp = $timestamp;

        return $this;
    }

    /**
     * Get timestamp
     *
     * @return \DateTime 
     */
    public function getTimestamp()
    {
        return $this->timestamp;
    }

    /**
     * Set stored
     *
     * @param \DateTime $stored
     * @return Statement
     */
    public function setStored($stored)
    {
        $this->stored = $stored;

        return $this;
    }

    /**
     * Get stored
     *
     * @return \DateTime 
     */
    public function getStored()
    {
        return $this->stored;
    }

    /**
     * Set authorityId
     *
     * @param integer $authorityId
     * @return Statement
     */
    public function setAuthorityId($authorityId)
    {
        $this->authorityId = $authorityId;

        return $this;
    }

    /**
     * Get authorityId
     *
     * @return integer 
     */
    public function getAuthorityId()
    {
        return $this->authorityId;
    }

    /**
     * Set version
     *
     * @param string $version
     * @return Statement
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
