<?php

namespace Inkstand\Bundle\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller as BaseController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class Controller extends BaseController
{
    const MESSAGE_SUCCESS = 'success';
    const MESSAGE_DANGER = 'danger';
    const MESSAGE_WARNING = 'warning';
    const MESSAGE_INFO = 'info';

    /**
     * Send success flash message
     *
     * @param $message
     * @param array $messageParams
     */
    public function addSuccessMessage($message, $messageParams = array())
    {
        $this->addMessage(self::MESSAGE_SUCCESS, $message, $messageParams);
    }

    /**
     * Send danger flash message
     *
     * @param $message
     * @param array $messageParams
     */
    public function addDangerMessage($message, $messageParams = array())
    {
        $this->addMessage(self::MESSAGE_DANGER, $message, $messageParams);
    }

    /**
     * Send warning flash message
     *
     * @param $message
     * @param array $messageParams
     */
    public function addWarningMessage($message, $messageParams = array())
    {
        $this->addMessage(self::MESSAGE_WARNING, $message, $messageParams);
    }

    /**
     * Send info flash message
     *
     * @param $message
     * @param array $messageParams
     */
    public function addInfoMessage($message, $messageParams = array())
    {
        $this->addMessage(self::MESSAGE_INFO, $message, $messageParams);
    }

    /**
     * Send flash message
     *
     * @param $messageType
     * @param $message
     * @param array $messageParams
     */
    public function addMessage($messageType, $message, $messageParams = array())
    {
        $session = $this->getRequest()->getSession();
        $session->getFlashBag()->add($messageType, $this->get('translator')->trans($message, $messageParams));
    }

    /**
     * Get request
     *
     * Note: Base getRequest method is deprecated and will be removed in Symfony 3.0. Adding this here for when that
     * happens.
     *
     * @return mixed
     */
    public function getRequest()
    {
        return $this->container->get('request_stack')->getCurrentRequest();
    }
}