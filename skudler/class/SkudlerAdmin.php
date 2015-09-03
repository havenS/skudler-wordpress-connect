<?php
require_once dirname(__FILE__).'/Skudler.php';

class SkudlerAdmin extends Skudler {

    protected $version = '1.0';
    protected $plugin_name ='Skudler Connect';

    public function __construct()
    {
        parent::__construct();
        $this->addAdminMenu();

        if(isset($_POST['option_page']) && $_POST['option_page'] == 'skudler-group')
            $this->processForm($_POST);

    }

    public function addAdminMenu()
    {
        add_action( 'admin_menu', array( $this, 'addPluginPage' ) );
    }

    public function addPluginPage()
    {
        wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . '../assets/css/admin.css', array(), $this->version, 'all' );
        wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . '../assets/js/admin.js', array( 'jquery' ), $this->version, false );

        add_menu_page( 'Skudler API Configuration', 'Skudler', 'activate_plugins', 'skudler', array($this, 'displayAdminPage'), 'http://localhost:3000/packages/skudler_base/assets/images/logo-circle.png', 75);
    }

    public function displayAdminPage()
    {
        // Récupération des champs
        $fields = $this->getFields();

        // Ajout des champs en liste blanche
        $this->registerFields($fields);

        // Récupération des valeurs des champs
        $options 	= $this->getOptions($fields);

        $this->initApi();

        if(isset($_POST['api'], $_POST['api_action']) && $_POST['api_action'] == 'checkCredential'){
            $this->callCheckCredential();
        }

        $apiStatus 	= $this->getApiStatus();

        $sites = $apiStatus ? $this->api->getSites() : array();

        if($options['skudler_site_id']){
            $events = $this->api->getEvents($options['skudler_site_id']);
        }

        include dirname(dirname(__FILE__)).'/views/admin.php';
    }

    protected function registerFields($fields)
    {
        foreach($fields as $f){
            register_setting( 'skudler-group', $f );
        }
    }

    protected function getApiStatus()
    {
        return $this->api_key != '' && $this->api_token != '' && get_option('skudler_api_status');
    }

    protected function callCheckCredential()
    {
        $call = $this->api->getSites(false);

        $this->setApiStatus($call && $call->status == 'success');
    }

    protected function setApiStatus($status)
    {
        return update_option('skudler_api_status', $status);
    }

    protected function processForm($form)
    {
        foreach($this->getFields() as $field){
            if(isset($form[$field])){
                update_option($field, $form[$field]);
            }
        }
    }

}