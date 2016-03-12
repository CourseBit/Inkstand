<?php

namespace Inkstand\ResourceLibraryBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Inkstand\Library\TagBundle\Model\Tag;

/**
 * ResourceTag
 */
class ResourceTag extends Tag
{

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->tagEntries = new \Doctrine\Common\Collections\ArrayCollection();
    }

}
