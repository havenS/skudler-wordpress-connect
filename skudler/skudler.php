<?php
/**
 * Plugin Name: Skudler Connect
 * Plugin URI: http://www.skudler.com/doc/wordpress
 * Description: This plugin allow you to connect you website to the Skudler platform
 * Version: Version 1.0.0
 * Author: Skudler
 * Author URI:  http://www.skudler.com/
 * License: GPL2 license
 */

require_once dirname(__FILE__) . '/class/SkudlerHooks.php';
require_once dirname(__FILE__) . '/class/SkudlerAdmin.php';

$skudler = is_admin() ? new SkudlerAdmin() : new SkudlerHooks();