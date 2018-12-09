<?php
class WP_Simple_Feedback_Class {
    public function __construct() {
        load_plugin_textdomain(PLUGIN_NAME,false, basename( dirname( __FILE__) ) . '/languages');

        add_action("init",array($this,"init"));
        add_action('widgets_init' ,array($this,'register_widget'));
        add_action('admin_menu', array($this,"setup_admin_menu"));

    }

    public function init() {
      wp_register_style("wpstyle",plugins_url("css/style.css",__FILE__));
      add_shortcode('feedback',array($this,"feedback_shortcode"));
    }

    public function register_widget() {
      register_widget('WP_Simple_Feedback_Widget');
}
      public function feedback_shortcode() {
        include_once(plugin_dir_path(__FILE__) . "wp-simple-feedback-feedback.php");
      }
        public function setup_admin_menu() {
         add_menu_page(PLUGIN_NAME,__("Feedback",PLUGIN_NAME),"manage_options",PLUGIN_NAME,array($this,"admin_page"));
          add_submenu_page(PLUGIN_NAME,__("Target Settings",PLUGIN_NAME),__("Target Settings",PLUGIN_NAME),"manage_options",PLUGIN_NAME,array($this,"admin_page"));
          add_submenu_page(PLUGIN_NAME,__("Feedbacks",PLUGIN_NAME),__("Feedbacks",PLUGIN_NAME),"manage_options","submenu1",array($this,"admin_feedbacks"));
        }


      public function admin_page() {
        include_once(plugin_dir_path(__FILE__) . "Admin/wp-settings.php");
      }
      public function admin_feedbacks() {
          include_once(plugin_dir_path(__FILE__) . "Admin/wp-feedbacks.php");
      }

}

add_action('plugins_loaded','wp_simple_feedback_plugin_init');

function wp_simple_feedback_plugin_init() {
  $wp_simple_feedback_plugin=new WP_Simple_Feedback_Class();
}
