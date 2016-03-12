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
     * @Route("/tag/add/{tagManagerServiceId}", name="inkstand_tag_add")
     * @Template
     * @param Request $request
     * @param string $tagManager
     * @return array
     */
    public function addAction(Request $request, $tagManagerServiceId)
    {
        $tagManager = $this->getTagManager($tagManagerServiceId);
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
     * @Route("/tag/edit/{tagManagerServiceId}/{tagId}", name="inkstand_tag_edit")
     * @Template
     * @param Request $request
     * @param string $tagManagerServiceId
     * @param integer $tagId
     * @return array
     */
    public function editAction(Request $request, $tagManagerServiceId, $tagId)
    {
        $tagManager = $this->getTagManager($tagManagerServiceId);
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
     * @Route("/tag/delete/{tagManagerServiceId}/{tagId}", name="inkstand_tag_delete")
     * @Template
     * @param Request $request
     * @param $tagManagerServiceId
     * @param $tagId
     * @return array|\Symfony\Component\HttpFoundation\RedirectResponse
     * @throws \Exception
     */
    public function deleteAction(Request $request, $tagManagerServiceId, $tagId)
    {
        $tagManager = $this->getTagManager($tagManagerServiceId);
        $tag = $tagManager->findOneBy(array('tagId' => $tagId));

        if(empty($tag)) {
            throw new NotFoundHttpException('tag.notfound');
        }

        $deleteForm = $this->createFormBuilder()
            ->add('delete', 'submit', array(
                'label' => 'tag.delete',
                'attr' => array('class' => 'btn btn-danger')
            ))
            ->getForm();

        if ($this->getRequest()->isMethod('POST')) {

            $deleteForm->handleRequest($request);

            if ($deleteForm->get('delete')->isClicked()) {
                $tagManager->delete($tag);

                $this->addSuccessMessage('tag.delete.success');

                return $this->redirect($this->generateUrl('inkstand_tag_list', array('tagManagerServiceId' => $tagManagerServiceId)));
            }
        }

        return array(
            'tag' => $tag,
            'deleteForm' => $deleteForm->createView()
        );
    }

    /**
     * @Route("/tag/list/{tagManagerServiceId}", name="inkstand_tag_list")
     * @Template
     * @param Request $request
     * @param integer $category
     * @return array
     */
    public function listAction(Request $request, $tagManagerServiceId)
    {
        $tagManager = $this->getTagManager($tagManagerServiceId);
        $tags = $tagManager->findAll();

        return array(
            'tags' => $tags,
            'tagManagerServiceId' => $tagManagerServiceId
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