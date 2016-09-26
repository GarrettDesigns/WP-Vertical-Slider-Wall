<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       www.garrettryandesign.com
 * @since      1.0.0
 *
 * @package    Vsw_slider
 * @subpackage Vsw_slider/admin/partials
 */
?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->

<?php
  $options = get_option( $this->plugin_name . '-settings' );
  $slider_one_options = $options['slider_one'];
  $counter = 0;
  var_dump( $slider_one_options );
?>

<div class='wrap'>

  <h1><?php echo $this->settings_title; ?> Settings</h1>

  <form method='post' action=''>
    <?php settings_fields( $this->plugin_name . '-settings' ); ?>
    <table class="widefat form-table">
    <?php foreach ( $slider_one_options as $option ) : ?>
      <?php var_dump( $counter ); var_dump( $option ); ?>
          <tr class='slide'>
            <td>
              <img class='' src=''>
              <input type='button' name='<?php echo $this->plugin_name; ?>-settings[slider_one][slide_'<?php $counter; ?>'][slide_image]' class='button' value='upload image'>
            </td>
            <td>
              <input type='text' name='<?php echo $this->plugin_name; ?>-settings[slider_one][slide_'<?php $counter; ?>'][slide_title]' class='regular-text' value='<?php echo $option['slide_title']; ?>'>
            </td>
            <td>
              <input type='text' name='<?php echo $this->plugin_name; ?>-settings[slider_one][slide_'<?php $counter; ?>'][slide_link]' class='regular-text' value='<?php echo $option['slide_link']; ?>'>
            </td>
          </tr>
          <?php $counter++; var_dump( $counter ); ?>
    <?php endforeach; ?>
    </table>
    <?php submit_button(); ?>
  </form>

  <?php
    if( isset( $_POST['submit'] ) ) {
      update_option( $this->plugin_name. '-settings', $_POST[$this->plugin_name . '-settings'] );
    }
  ?>
</div>
