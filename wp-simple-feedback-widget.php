<?php
class WP_Simple_Feedback_Widget extends WP_Widget {
    public function __construct() {
      parent::__construct(
        'wp-simple-feedback-widget',
        __('Feedback',PLUGIN_NAME),
          array('description' =>__('Displays number of feedbacks',PLUGIN_NAME),)
        );
    }

    public function widget($args,$instance) {
      global $wpdb;

      $feedback_count=$wpdb->get_var("SELECT COUNT(id) FROM " . $wpdb->prefix . "wsf_feedback");

      print "<aside class='widget'>";
      print "<p>" . __('Number of feedbacks',PLUGIN_NAME) . "<br />" . $feedback_count . "</p>";
      print "</aside>";
    }

    public function form($instance) {
      //There is no settings for the administrator.
    }

    public function update($new_instance,$old_instance) {
      //No information needs to be saved.
    }
}
