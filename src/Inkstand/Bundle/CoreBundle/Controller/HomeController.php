<?php

namespace Inkstand\Bundle\CoreBundle\Controller;

use Inkstand\Bundle\CoreBundle\Entity\Setting;
use Inkstand\Bundle\CoreBundle\Event\DashboardEvent;
use Inkstand\Bundle\CoreBundle\Event\DashboardEvents;
use Inkstand\Bundle\CoreBundle\Form\Type\SettingType;
use Inkstand\Bundle\CoreBundle\Setting\SiteSettings;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * Controller for "home" pages, like the dashboard
 *
 * inkstand_home      /
 * inkstand_dashboard /dashboard
 */
class HomeController extends Controller
{
	/**
	 * Homepage of Inkstand. This action will forward to controllers based on criteria.
	 *
	 * @Route("/", name="inkstand_home")
	 */
	public function indexAction()
	{
		$forwardController = 'InkstandCoreBundle:Home:dashboard';

		$user = $this->getUser();

		if(empty($user)) {
			$forwardController = 'FOSUserBundle:Security:login';
		}

		return $this->forward($forwardController);
	}

	/**
	 * @Route("/dashboard", name="inkstand_dashboard")
	 * @Template
	 */
	public function dashboardAction()
	{
		$user = $this->getUser();
		$enrollments = $this->get('enrollment_service')->getEnrolledCourses($user);
        $widgetService = $this->get('widget_service');
        $widgets = $widgetService->getWidgets();

		return array(
			'enrollments' => $enrollments
		);
	}

	/**
	 * @Route("/help", name="inkstand_help")
	 * @Template
	 */
	public function helpAction()
	{
		return array();
	}

	/**
	 * @Route("/settings/{settingName}", name="inkstand_settings")
	 * @Template
	 */
	public function settingsAction(Request $request, $settingName)
	{
		if(!$this->has('setting.' . $settingName)) {
			throw new NotFoundHttpException('Setting page could not be found.');
		}

		$siteSettings = $this->get('setting.' . $settingName);

		$siteSettings->build();

		$settingsForm = $this->createFormBuilder();

		foreach($siteSettings->getSettings() as $setting) {
			$settingsForm->add($setting->getName(), $setting->getType(), $setting->getOptions());
			$settingsForm->get($setting->getName())->setData($setting->getValue());
		}

		$settingsForm->add('actions', 'form_actions', array(
			'buttons' => array(
				'save' => array(
					'type' => 'submit',
					'options' => array(
						'label' => 'Save',
						'attr' => array(
							'class' => 'btn btn-primary'
						)
					)
				),
				'cancel' => array(
					'type' => 'submit',
					'options' => array(
						'label' => 'button.cancel',
						'attr' => array(
							'class' => 'btn btn-default'
						)
					)
				),
			)
		));

		$settingsForm = $settingsForm->getForm();

		$settingsForm->handleRequest($request);

		if($settingsForm->isValid()) {
			$em = $this->getDoctrine()->getManager();
			foreach($settingsForm->getData() as $settingName => $settingValue) {
				$setting = $siteSettings->get($settingName);

				if(null === $setting) {
					throw new Exception('Submitted setting does not exist');
				}

				$setting->setValue($settingValue);

				$em->persist($setting);
			}
			$em->flush();

			$session = $request->getSession();
			$session->getFlashBag()->add('success', 'Settings updated successfully!');
		}

		return array(
			'settingsForm' => $settingsForm->createView()
		);
	}
}
