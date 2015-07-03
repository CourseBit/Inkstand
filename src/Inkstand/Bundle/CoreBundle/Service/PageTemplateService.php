<?php

namespace Inkstand\Bundle\CoreBundle\Service;

/**
 * Class PageTemplateService
 * @package Inkstand\Bundle\CoreBundle\Service
 */
class PageTemplateService
{
    protected $entityManager;
    protected $pageTemplateRepository;
    protected $widgetService;

    public function __construct($entityManager, $widgetService)
    {
        $this->entityManager = $entityManager;
        $this->pageTemplateRepository = $this->entityManager->getRepository('InkstandCoreBundle:PageTemplate');
        $this->widgetService = $widgetService;
    }

    public function getWidgetsForTemplate($pageTemplateId)
    {
        $pageTemplate = $this->pageTemplateRepository->findOneByPageTemplateId($pageTemplateId);
        $pageTemplateWidgets = $pageTemplate->getPageTemplateWidgets();
        $widgets = array();
        foreach($pageTemplateWidgets as $pageTemplateWidget) {
            $widgets[] = $this->widgetService->getWidgetById($pageTemplateWidget->getWidgetId());
        }
        dump($widgets);
        return $widgets;
    }
}