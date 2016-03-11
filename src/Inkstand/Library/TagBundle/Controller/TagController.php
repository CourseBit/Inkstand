<?php

namespace Inkstand\Library\TagBundle\Controller;

use Inkstand\Bundle\CoreBundle\Controller\Controller;
use Inkstand\Library\TagBundle\Model\TagManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\Form\FormTypeInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class TagController extends Controller
{
    /**
     * @Route("/tag/add/{tagManager}", name="inkstand_tag_add")
     * @Template
     * @param Request $request
     * @param string $tagManager
     * @return array
     */
    public function addAction(Request $request, $tagManager)
    {
        $tagManager = $this->getTagManager($tagManager);
        $tag = $tagManager->create();

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

    /**
     * @Route("/tag/edit/{tagId}", name="inkstand_tag_edit")
     * @Template
     * @param Request $request
     * @param integer $tagId
     * @return array
     */
    public function editAction(Request $request, $tagId)
    {
        $tagManager = $this->getTagManager();
        $tag = $tagManager->findOneBy(array('tagId' => $tagId));

        if(empty($tag)) {
            throw new NotFoundHttpException('tag.notfound');
        }

        $tagForm = $tagManager->getForm($tag);

        $tagForm->handleRequest($request);

        if($tagForm->isValid()) {
            $tagManager->update($tag);

            $this->addSuccessMessage('tag.edit.success');
        }

        return array(
            'tagForm' => $tagForm->createView()
        );
    }

    /**
     * @Route("/tag/list/{category}", name="inkstand_tag_list")
     * @Template
     * @param Request $request
     * @param integer $category
     * @return array
     */
    public function listAction(Request $request, $category)
    {
        $tagManager = $this->getTagManager();
        $tags = $tagManager->findByCategory($category);

        return array(
            'tags' => $tags,
            'category' => $category
        );
    }

    /**
     * Get tag manager
     *
     * @throws \Exception
     * @return TagManagerInterface
     */
    public function getTagManager($tagManagerServiceId)
    {
        if($this->has($tagManagerServiceId)) {
            $tagManager = $this->get($tagManagerServiceId);

            if(!is_a($tagManager, 'Inkstand\Library\TagBundle\Model\TagManagerInterface')) {
                //throw new \Exception('Requested service is not a tag manager.');
            }

            return $tagManager;
        }

        throw new \Exception('Tag manager not found.');
    }
}