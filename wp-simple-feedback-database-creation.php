<?php
class WP_Simple_Feedback_Setup {
      public static function activate() {
      global $wpdb;
      $table_name1=$wpdb->prefix . "wsf_target";
      $sql = "CREATE TABLE IF NOT EXISTS $table_name1 (
        id int(11) PRIMARY KEY AUTO_INCREMENT,
        name varchar(50) NOT NULL,
        description text,
        active bool
      );";

      require_once(ABSPATH . "wp-admin/includes/upgrade.php");
      dbDelta($sql);

      $table_name2=$wpdb->prefix . "wsf_feedback";
      $sql = "CREATE TABLE IF NOT EXISTS " . $table_name2 . "( ";
      $sql .= "id int PRIMARY KEY AUTO_INCREMENT,";
      $sql .= "time timestamp DEFAULT CURRENT_TIMESTAMP NOT NULL,";
      $sql .= "feedback_value int(11) NOT NULL,";
      $sql .= "feedback_text text NOT NULL,";
      $sql .= $table_name1 . "_id int not null,";
      $sql .= "INDEX par_ind (" . $table_name1 . "_id),";
      $sql .= "FOREIGN KEY (" . $table_name1. "_id) REFERENCES " . $table_name1 . "(id) ";
      $sql .= "ON DELETE RESTRICT);";

      require_once(ABSPATH . "wp-admin/includes/upgrade.php");
      dbDelta($sql);
      add_option("wp-simple-feedback-db-version", "0.1");
    }
    public static function uninstall() {
      global $wpdb;
      $table_name = $wpdb->prefix . "wsf_feedback";
      $sql = "DROP TABLE IF EXISTS $table_name;";
      $wpdb->query($sql);
      $table_name = $wpdb->prefix . "wsf_target";
      $sql = "DROP TABLE IF EXISTS $table_name;";
      $wpdb->query($sql);
      delete_option("demo_browser_db_version");
    }
}
