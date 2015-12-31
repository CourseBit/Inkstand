<?php

namespace Inkstand\Bundle\CoreBundle\Setting;

/**
 * General site settings that are important for overall operation
 *
 * Class SiteSettings
 * @package Inkstand\Bundle\CoreBundle\Setting
 */
class SiteSettings extends AbstractSettings
{
    /**
     * @inheritdoc
     */
    public function build()
    {
        $this->add('inkstand_core_setting_sitename', 'text', array(
            'label' => 'Site Title'
        ));
        $this->add('inkstand_core_setting_companyname', 'text', array(
            'label' => 'Company'
        ));
        $this->add('inkstand_core_setting_url', 'text', array(
            'help_text' => 'This is the URL of your Inkstand LMS instance.',
            'label' => 'Web Address'
        ), 'http://inkstand.org');
        $this->add('inkstand_core_search_index', 'choice', array(
            'label' => 'Search Index',
            'help_text' => 'Allow search engines to index Inkstand and your content.',
            'choices' => array('1' => 'Yes', '0' => 'No'),
            'expanded' => true,
        ), '1');
    }
}