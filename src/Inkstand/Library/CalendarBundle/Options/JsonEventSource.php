<?php

namespace Inkstand\Library\CalendarBundle\Options;

class JsonEventSource extends EventSource
{
    /**
     * @var string
     */
    private $url;

    public function jsonSerialize()
    {
        $data = array(
            'url' => $this->url,
        );

        return array_merge($data, parent::jsonSerialize());
    }

    /**
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @param string $url
     */
    public function setUrl($url)
    {
        $this->url = $url;
    }
}