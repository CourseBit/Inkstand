<?php

namespace Inkstand\ResourceLibraryBundle\Twig;

use Inkstand\Bundle\CoreBundle\Service\SettingService;
use Inkstand\Bundle\UserBundle\Entity\User;
use Inkstand\Library\TagBundle\Model\TagEntryInterface;
use Inkstand\Library\TagBundle\Model\TaggableInterface;
use Inkstand\Library\TagBundle\Model\TagInterface;
use Inkstand\Library\TagBundle\Model\TagManagerInterface;
use Symfony\Component\Config\Resource\ResourceInterface;
use Symfony\Component\Security\Core\SecurityContext;

class GridColumnsExtension extends \Twig_Extension
{
    /**
     * @var TagManagerInterface
     */
    private $resourceTagManager;

    /**
     * @var SettingService
     */
    private $settingService;

    /**
     * @var SecurityContext
     */
    private $context;

    public function __construct(TagManagerInterface $resourceTagManager, SettingService $settingService, SecurityContext $context)
    {
        $this->resourceTagManager = $resourceTagManager;
        $this->settingService = $settingService;
        $this->context = $context;
    }

    public function getFunctions()
    {
        return array(
            'gridColumnsHeading' => new \Twig_SimpleFunction('grid_columns_headings', array($this, 'gridColumnsHeading'), array(
                'is_safe' => array('html'),
                'needs_environment' => true
            )),
            'gridColumnsData' => new \Twig_SimpleFunction('grid_columns_data', array($this, 'gridColumnsData'), array(
                'is_safe' => array('html'),
                'needs_environment' => true
            ))
        );
    }

    public function gridColumnsHeading(\Twig_Environment $twig)
    {
        $user = $this->context->getToken()->getUser();

        $allTags = $this->resourceTagManager->findAll();

        if($user->getOrganization()) {
            // TODO: Use organization code when it's added
            $settingName = $user->getOrganization()->getName() . 'gridColumns';
        } else {
            $settingName = $user->getUsername() . 'gridColumns';
        }

        $headings = array();

        $tagCodes = $this->settingService->get($settingName);
        if(!empty($tagCodes) && !empty($tagCodes->getValue())) {
            $tagCodes = json_decode($tagCodes->getValue());
            foreach($tagCodes as $tagCode) {
                /** @var TagInterface $tag */
                foreach($allTags as $tag) {
                    if($tagCode == $tag->getCode()) {
                        $headings[] = $tag->getName();
                    }
                }
            }
        }

        return $twig->render('InkstandResourceLibraryBundle:extension:grid-columns-headings.html.twig', array(
            'headings' => $headings
        ));
    }

    public function gridColumnsData(\Twig_Environment $twig, TaggableInterface $resource)
    {
        $user = $this->context->getToken()->getUser();

        $tagEntries = $resource->getTagEntries();

        if($user->getOrganization()) {
            // TODO: Use organization code when it's added
            $settingName = $user->getOrganization()->getName() . 'gridColumns';
        } else {
            $settingName = $user->getUsername() . 'gridColumns';
        }

        $data = array();

        $tagCodes = $this->settingService->get($settingName);
        if(!empty($tagCodes) && !empty($tagCodes->getValue())) {
            $tagCodes = json_decode($tagCodes->getValue());
            foreach($tagCodes as $tagCode) {
                $tagData = '';
                /** @var TagEntryInterface $tagEntry */
                foreach($tagEntries as $tagEntry) {
                    if($tagCode == $tagEntry->getTag()->getCode()) {
                        $tagData = $tagEntry->getValue();
                    }
                }
                $data[] = $tagData;
            }
        }

        return $twig->render('InkstandResourceLibraryBundle:extension:grid-columns-data.html.twig', array(
            'data' => $data
        ));
    }

    public function getName()
    {
        return 'grid_columns_extension';
    }
}