<?php

namespace Inkstand\ResourceLibraryBundle\Controller;

use Inkstand\Bundle\CoreBundle\Controller\Controller;
use Inkstand\ResourceLibraryBundle\Entity\Resource;
use Inkstand\ResourceLibraryBundle\Entity\Topic;
use Inkstand\ResourceLibraryBundle\Model\ResourceManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class LibraryController extends Controller
{
    /**
     * @Route("/library", name="inkstand_resource_library_index")
     * @Template
     */
    public function indexAction()
    {
        /** @var ResourceManagerInterface $resourceService */
        $resourceManager = $this->get('inkstand_resource_library.resource_manager');
        $resources = $resourceManager->findAll();

        return array(
            'resources' => $resources,
            'newResource' => new Resource(),
            'newTopic' => new Topic()
        );
    }
}