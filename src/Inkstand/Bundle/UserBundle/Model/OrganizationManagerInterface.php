<?php

namespace Inkstand\Bundle\UserBundle\Model;


use FOS\UserBundle\Model\UserInterface;

interface OrganizationManagerInterface
{
    /**
     * @param array $criteria
     * @return array
     */
    public function findBy(array $criteria);

    /**
     * @param array $criteria
     * @return OrganizationInterface|null
     */
    public function findOneBy(array $criteria);

    /**
     * Find all Organizations
     *
     * @return array
     */
    public function findOrganizations();

    /**
     * Find all Organizations user has access to
     *
     * @param UserInterface $user
     * @return array Organizations
     */
    public function findMyOrganizations(UserInterface $user);

    /**
     * @param $organizationId
     * @return OrganizationInterface|null
     */
    public function findOneByOrganizationId($organizationId);

    /**
     * Return all children for Organization recursively
     *
     * @param OrganizationInterface $organization
     * @param array $childOrganizations
     * @return array
     */
    public function getChildrenRecursive(OrganizationInterface $organization, &$childOrganizations = array());
}