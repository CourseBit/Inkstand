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
<<<<<<< HEAD
        /** @var ResourceManagerInterface $resourceService */
        $resourceManager = $this->get('inkstand_resource_library.resource_manager');
        $resources = $resourceManager->findAll();
=======
        /** @var  $resourceService */
        $resourceService = $this->get('inkstand_resource_library.resource');
        $resources = $resourceService->findAll();
        $topics = $this->get('inkstand_resource_library.topic')->findAllShownInLibrary();
>>>>>>> 050c7dc901aec6feed27894f3d0f03adfdd840d8

        return array(
            'resources' => $resources,
            'newResource' => new Resource(),
            'newTopic' => new Topic(),
            'topics' => $topics
        );
    }
}