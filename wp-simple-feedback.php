<?php
/*
Plugin Name: WP Simple Feedback
Plugin URI: http://www.foo.com
Description: Example Wordpress plugin.
Version 0.1
Author: Arto Halonen
Author URI: www.google.fi
License: GPLv2 or later
*/
define("PLUGIN_NAME","wp-simple-feedback");

include_once('wp-simple-feedback-database-creation.php');
include_once('wp-simple-feedback-widget.php');
include_once('wp-simple-feedback-class.php');


register_activation_hook(__FILE__,array('WP_Simple_Feedback_Setup','activate'));
register_uninstall_hook(__FILE__,array('WP_Simple_Feedback_Setup','uninstall'));

 ?>
