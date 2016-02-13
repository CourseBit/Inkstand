<?php

namespace Inkstand\Library\TagBundle\Controller;

use Inkstand\Bundle\CoreBundle\Controller\Controller;
use Inkstand\Library\TagBundle\Model\TagManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;

class TagController extends Controller
{
    /**
     * @Route("/tag/add/{category}", name="inkstand_tag_add")
     * @Template
     * @param Request $request
     * @param string $category
     * @return array
     */
    public function addAction(Request $request, $category)
    {
        /** @var TagManagerInterface $tagManager */
        $tagManager = $this->get('inkstand_tag.tag_manager');

        $tag = $tagManager->create($category);

        $tagForm = $tagManager->getForm($tag);

        $tagForm->handleRequest($request);

        if($tagForm->isValid()) {
            $tagManager->update($tag);

            $this->addSuccessMessage('tag.add.success');
        }

        return array(
            'tagForm' => $tagForm->createView()
        );
    }
}