<?php

namespace Inkstand\Bundle\UserBundle\Model;


use FOS\UserBundle\Model\UserInterface;

abstract class OrganizationManager implements OrganizationManagerInterface
{
    /**
     * Find all Organizations user has access to
     *
     * @param UserInterface $user
     * @return array Organizations
     */
    public function findMyOrganizations(UserInterface $user)
    {
        /** @var OrganizationInterface $userOrganization */
        $userOrganization = $user->getOrganization();
        if(null !== $userOrganization) {
            $userOrganizations = $this->getChildrenRecursive($userOrganization);
            $userOrganizations[$userOrganization->getOrganizationId()] = $userOrganization;
            return $userOrganizations;
        }
        return null;
    }

    /**
     * @param $organizationId
     * @return OrganizationInterface|null
     */
    public function findOneByOrganizationId($organizationId)
    {
        return $this->findOneBy(array('organizationId' => $organizationId));
    }

    /**
     * Return all children for Organization recursively
     *
     * @param OrganizationInterface $organization
     * @param array $childOrganizations
     * @return array
     */
    public function getChildrenRecursive(OrganizationInterface $organization, &$childOrganizations = array())
    {
        /** @var OrganizationInterface $childOrganization */
        foreach($organization->getChildren() as $childOrganization) {
            $childOrganizations[$childOrganization->getOrganizationId()] = $childOrganization;
            $this->getChildrenRecursive($childOrganization, $childOrganizations);
        }

        return $childOrganizations;
    }
}