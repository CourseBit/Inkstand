<?php

namespace Inkstand\ResourceLibraryBundle\Controller;

use Inkstand\Bundle\CoreBundle\Controller\Controller;
use Inkstand\ResourceLibraryBundle\Entity\Resource;
use Inkstand\ResourceLibraryBundle\Entity\Topic;
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
        /** @var  $resourceService */
        $resourceService = $this->get('inkstand_resource_library.resource');
        $resources = $resourceService->findAll();
        $topics = $this->get('inkstand_resource_library.topic')->findAllShownInLibrary();

        return array(
            'resources' => $resources,
            'newResource' => new Resource(),
            'newTopic' => new Topic(),
            'topics' => $topics
        );
    }
}