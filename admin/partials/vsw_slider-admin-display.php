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

<div class="wrap">

  <h1><?php echo $this->settings_title; ?> Settings</h1>

  <form method="post" action="">
    <?php settings_fields( $this->plugin_name . '-settings' ); ?>
    <?php do_settings_sections( $this->plugin_name . '-settings' ); ?>
    <?php submit_button(); ?>
  </form>

  <?php
    if( isset( $_POST['submit'] ) ) {
      update_option( $this->plugin_name. '-settings', $_POST[$this->plugin_name . '-settings'] );
    }
  ?>
</div>
