<?php
wp_enqueue_style('wpstyle');
 ?>


<div class="wrap">
  <?php
  global $wpdb;
  $name="";
  $description="";
  $table_name=$wpdb->prefix . "wsf_target";

  if (isset($_POST["event"])) {
    ?>

    <div class='updated'>
      <p>
        <?php
        $name=sanitize_text_field($_POST["event"]);
        $description=sanitize_text_field($_POST["description"]);
        $table_name=$wpdb->prefix . "wsf_target";

        $event=$wpdb->get_row("SELECT * FROM " . $table_name);
        if ($event==null) {
          $wpdb->insert (
            $table_name,
            array(
              'name' => $name,
              'description' => $description,
              'active' => true

            )
          );
        }
        else {
          $id=$event->id;
          $wpdb->update (
            $table_name,
            array(
              'name' => $name,
              'description' => $description,
              'active' => true
            ),
            array('id'=>$id)
          );
        }
        _e('Settings saved.',PLUGIN_NAME);
        ?>
      </p>
    </div>
    <?php
  } else {
    $event=$wpdb->get_row("SELECT * FROM " . $table_name);
    if ($event!=null) {
      $name=$event->name;
      $description=$event->description;
    }
  }


   ?>
<h2><?php _e('Target Settings', PLUGIN_NAME);?></h2>
<form method="post" action="">
  <table class="form-table">
    <tbody>
      <tr valign="top">
        <th scope="row">
          <label for="name"><?php _e('Name', PLUGIN_NAME);?>:</label>
        </th>
    <td>
      <input id="event" name='event' size='30' maxlength='30'>
    </td>
  </tr>
  <tr valign="top">
    <th scope="row">
      <label for="description"><?php _e('Description', PLUGIN_NAME);?>:</label>
    </th>
<td>
  <textarea id="description" name='description'></textarea>
  </td>
</tr>
</tbody>
</table>
<input type="submit" class='button button-primary' value='<?php _e('Save',PLUGIN_NAME) ?>'>
</form>
</div>
