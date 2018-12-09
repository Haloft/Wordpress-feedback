<div class="wrap">

      <?php
      global $wpdb;
      $count=$wpdb->get_var("SELECT COUNT(id) FROM " . $wpdb->prefix . "wsf_feedback");
      $average=$wpdb->get_var("SELECT ROUND(AVG(feedback_value) , 1) FROM " . $wpdb->prefix . "wsf_feedback");?>
      <h2><?php _e('Feedbacks' . '&nbsp' . '(' . $count . ')'  , PLUGIN_NAME);?></h2>
      <h3><?php _e("Average:" .   '&nbsp' .  $average   , PLUGIN_NAME);?> </h3>
      <?php
      $table_name=$wpdb->prefix . "wsf_feedback";

      $sql="SELECT * FROM " .$table_name . " ORDER BY id";

      $feedbacks=$wpdb->get_results($sql);

      if ($feedbacks) {
        foreach ($feedbacks as $feedback) {
            print $feedback->feedback_value . '&nbsp' . $feedback->feedback_text . "<br>";

        }
      }
     ?>
</div>
