<?php

namespace Inkstand\Bundle\CoreBundle\Voter;

use Symfony\Component\Security\Core\Authorization\Voter\AbstractVoter as BaseVoter;

abstract class AbstractVoter extends BaseVoter
{
    protected $voterService;

    public function __construct($voterService) {
        $this->voterService = $voterService;
    }

    public function getSupportedAttributes()
    {
        throw new \Exception('Must declare getSupportedAttributes() method in voter.');
    }

    public abstract function getDefaultRoleAssignments();
}