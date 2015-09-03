<?php
/*
 * https://codex.wordpress.org/Plugin_API/Action_Reference
 */
require_once dirname(__FILE__).'/Skudler.php';

class SkudlerHooks extends Skudler {


    public function __construct()
    {
        parent::__construct();

        if($this->options['skudler_enabled'])
            $this->addHooks();
    }

    protected function addHooks()
    {
        $this->addUserRegisterHook();
        $this->addWpLoginHook();
    }

    public function addUserRegisterHook()
    {
        add_action('user_register', array($this, 'registerHook'));

    }

    public function addWpLoginHook()
    {
        add_action('wp_login', array($this, 'loginHook'), 10, 2);
    }

    public function registerHook($userId)
    {
        if($this->options['skudler_register_status']) {
            $user = get_user_by('id', $userId);
            $formattedUser = array(
                'displayname'   => $user->display_name,
                'first_name'    => $user->first_name,
                'last_name'     => $user->last_name,
                'email'         => $user->user_email,
            );

            @$this->api->addSubscription($this->options['skudler_register_event'], $formattedUser);
        }

    }

    public function loginHook($user_login, $user)
    {
        if($this->options['skudler_login_status']) {
            $formattedUser = array(
                'displayname'   => $user->display_name,
                'first_name'    => $user->first_name,
                'last_name'     => $user->last_name,
                'email'         => $user->user_email,
            );

            @$this->api->addSubscription($this->options['skudler_login_event'], $formattedUser);
        }

    }

}