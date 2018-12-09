<?php
wp_enqueue_style('wpstyle');

global $wpdb;
$name="";
$description="";
$fback="";
$additional_information="";


$table_name=$wpdb->prefix . "wsf_target";
$target=$wpdb->get_row("SELECT * FROM " . $table_name);

if ($target!=null) {
  $description=$target->description;
  $name=$target->name;

}

if (isset($_POST["post"])) {
  ?>
  <div class='updated'>
    <p>
      <?php
        if ($target!=null) {
        $target_id=$target->id;
        $table_name=$wpdb->prefix . "wsf_feedback";

        $wpdb->insert (
          $table_name,
          array(
            'feedback_value' => $_POST['fback'],
            'feedback_text' => $_POST['additional_information'],
            $wpdb->prefix . 'wsf_target_id' => $target_id
          )
        );
    }

}
       ?>
     </p>
   </div>


<div class="entry content">

    <h3>  <?php print $name;?></h3>

      <?php print $description;?>

    <form method="post" action="">
      <label for=""><h4><?php _e('Feedback', PLUGIN_NAME); ?>:</h4></label>
      <input id="fback" name="fback"  type="radio" value="5">Erinomainen<br>
      <input id="fback" type="radio" name="fback" value="4">Hyvä<br>
      <input id="fback" type="radio" name="fback" value="3">Melko hyvä<br>
      <input id="fback" type="radio" name="fback" value="2">Tyydyttävä<br>
      <input id="fback" type="radio" name="fback" value="1">Heikko<br>

      <label for="additional_information"><h4><?php _e('Free word', PLUGIN_NAME); ?>:</h4></label>
      <textarea id="additional_information" name="additional_information"></textarea>
      <div class="buttons">
        <input type="submit" name="post" value="<?php _e('Send', PLUGIN_NAME);?>">

      </div>
    </form>
  </div>
