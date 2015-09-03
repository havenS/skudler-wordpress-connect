<?php
require_once dirname(dirname(__FILE__)).'/lib/skudler-api/src/SkudlerAPI.php';

class Skudler {

    protected $api;
    protected $api_key;
    protected $api_token;

    protected $options;

    public function __construct()
    {
        $fields         = $this->getFields();
        $this->options  = $this->getOptions($fields);

        $this->initApi();
    }

    public function getFields()
    {
        return array(
            'skudler_enabled',

            'skudler_api_key',
            'skudler_api_token',

            'skudler_site_id',

            'skudler_register_status',
            'skudler_register_event',

            'skudler_login_status',
            'skudler_login_event',
        );
    }

    public function getOptions($fields)
    {
        $options = array();

        foreach($fields as $f){
            $options[$f] = esc_attr( get_option($f) );
        }
        $this->api_key      = $options['skudler_api_key'];
        $this->api_token    = $options['skudler_api_token'];

        return $options;
    }

    protected function initApi()
    {
        $this->api = new \Skudler\SkudlerAPI($this->api_key, $this->api_token);
    }

}