<?php

namespace Inkstand\Bundle\UserBundle\Model;


interface OrganizationManagerInterface
{
    /**
     * Find all Organizations
     *
     * @return array
     */
    public function findOrganizations();
}