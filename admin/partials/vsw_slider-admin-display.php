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

  $slider_one_options = isset( $options['slider_one'] ) ? $options['slider_one'] : array();
  $slider_two_options = isset( $options['slider_two'] ) ? $options['slider_two'] : array();
  $slider_three_options = isset( $options['slider_three'] ) ? $options['slider_three'] : array();
  $slider_four_options = isset( $options['slider_four'] ) ? $options['slider_four'] : array();

  $slider_one_slides = !empty( $slider_one_options['slides'] ) ? $slider_one_options['slides'] : array();
  $slider_two_slides = !empty( $slider_two_options['slides'] ) ? $slider_two_options['slides'] : array();
  $slider_three_slides = !empty( $slider_three_options['slides'] ) ? $slider_three_options['slides'] : array();
  $slider_four_slides = !empty( $slider_four_options['slides'] ) ? $slider_four_options['slides'] : array();

  $counter = 0;
?>

<div class='wrap'>

<h1><?php echo $this->settings_title; ?> Settings</h1>


  <form method='post' action='options.php'>
<table class="form-table">
  <tr>
    <td>
      <label for="<?php echo $this->plugin_name . '-settings'; ?>[slides_to_show]">Slides to Show</label>
      <input type="text" name="<?php echo $this->plugin_name . '-settings'; ?>[slides_to_show]" value="<?php echo isset( $options['slides_to_show'] ) ? $options['slides_to_show'] : 1;  ?>">
    </td  >
  </tr>
</table>

<h2 class="nav-tab-wrapper">
	<a href="#" class="nav-tab nav-tab-active">Slider One</a>
	<a href="#" class="nav-tab">Slider Two</a>
	<a href="#" class="nav-tab">Slider Three</a>
	<a href="#" class="nav-tab">Slider Four</a>
</h2>

    <?php settings_fields( $this->plugin_name . '-settings' ); ?>
    <?php do_settings_sections( $this->plugin_name . '-settings' ); ?>
    <div class="slider-container slider_one_container">
    <table class="widefat">
      <thead>
        <tr class="row-title">
          <th>
            Main Slider Display Image
          </th>
          <th class="row-title">
            Slider Title
          </th>
          <th class="row-title">
            Slider Title Link
          </th>
          <th class="row-title">
            Slider Description
          </th>
        </tr>
      </thead>
      <tbody>
        <tr class="slider-info">
          <td>
            <input type='hidden' class="image_upload_id" name='<?php echo $this->plugin_name; ?>-settings[slider_one][slider_main_image_id]' value='<?php echo isset ( $slider_one_options["slider_main_image_id"] ) ? $slider_one_options["slider_main_image_id"] : ''; ?>'>
            <div class="image-preview-container">
              <span class="image-controls remove-image-button">X</span>
              <span class="image-controls edit-image-button">E</span>
              <img class='slide_image_preview' src='<?php echo isset( $slider_one_options['slider_main_image_id'] ) ? wp_get_attachment_image_url( $slider_one_options['slider_main_image_id'], 'thumbnail' ) : ''; ?>'>
            </div>
              <input type='button' class='image_upload_button button <?php echo ( !empty( $slider_one_options["slider_main_image_id"] ) ) ? "hidden" : ""; ?>' value='upload image'>
          </td>
          <td>
            <input type="text" name="<?php echo $this->plugin_name . '-settings'; ?>[slider_one][slider_title]" value="<?php echo isset( $slider_one_options["slider_title"] ) ? $slider_one_options["slider_title"] : '';  ?>">
          </td>
          <td>
            <input type="text" name="<?php echo $this->plugin_name . '-settings'; ?>[slider_one][slider_title_link]" value="<?php echo isset( $slider_one_options["slider_title_link"] ) ? $slider_one_options["slider_title_link"] : '';  ?>">
          </td>
          <td>
            <textarea name="<?php echo $this->plugin_name . '-settings'; ?>[slider_one][slider_description]" rows="8" cols="40"><?php echo isset( $slider_one_options["slider_description"] ) ? $slider_one_options["slider_description"] : ''; ?></textarea>
          </td>
        </tr>
      </tbody>
    </table>
    <?php submit_button(); ?>
    <table class="form-table">
      <tr>
        <td>
          <h4>Slides</h4>
        </td>
      </tr>
    </table>
    <table class="slider_one slider widefat">
      <thead>
        <tr class="row-title">
          <th>
            Slide Image Preview
          </th>
          <th class="row-title">
            Slide Title
          </th>
          <th class="row-title">
            Slide Image Link
          </th>
          <th></th>
        </tr>
      </thead>
      <tbody>
      <?php if ( count( $slider_one_options ) ) : ?>
        <?php foreach ( $slider_one_slides as $slide ) : ?>
              <tr class='slide' colspan="3">
                <td>
                  <input type='hidden' class="image_upload_id" name='<?php echo $this->plugin_name; ?>-settings[slider_one][slides][slide_<?php echo $counter; ?>][slide_image_id]' value='<?php echo isset ( $slide["slide_image_id"] ) ? $slide["slide_image_id"] : ''; ?>'>
                  <div class="image-preview-container">
                    <span class="image-controls remove-image-button">X</span>
                    <span class="image-controls edit-image-button">E</span>
                    <img class='slide_image_preview' src='<?php echo isset( $slide['slide_image_id'] ) ? wp_get_attachment_image_url( $slide['slide_image_id'], 'thumbnail' ) : ''; ?>'>
                  </div>
                  <input type='button' class='image_upload_button button <?php echo ( !empty( $slide["slide_image_id"] ) ) ? "hidden" : ""; ?>' value='upload image'>
                </td>
                <td>
                  <input type='text' name='<?php echo $this->plugin_name; ?>-settings[slider_one][slides][slide_<?php echo $counter; ?>][slide_title]' class='regular-text' value='<?php echo isset ( $slide['slide_title'] ) ? $slide['slide_title'] : ''; ?>'>
                </td>
                <td>
                  <input type='text' name='<?php echo $this->plugin_name; ?>-settings[slider_one][slides][slide_<?php echo $counter; ?>][slide_link]' class='regular-text' value='<?php echo isset( $slide['slide_link'] ) ? $slide['slide_link'] : ''; ?>'>
                </td>
                <td>
                  <a class="remove-slide-link" href="#">Remove Slide</a>
                </td>
              </tr>
            <?php $counter++; ?>
        <?php endforeach; ?>
      <?php endif; ?>
    </tbody>
    </table>
    </div>
    <div class="slider-container slider_two_container">
    <table class="widefat">
    <thead>
      <tr>
        <th>
          Slider Image Preview
        </th>
        <th>
          Slider Title
        </th>
        <th>
          Slider Title Link
        </th>
        <th>
          Slider Description
        </th>
      </tr>
    </thead>
    <tbody>
      <tr class="slider-info">
        <td>
          <input type='hidden' class="image_upload_id" name='<?php echo $this->plugin_name; ?>-settings[slider_two][slider_main_image_id]' value='<?php echo isset ( $slider_two_options["slider_main_image_id"] ) ? $slider_two_options["slider_main_image_id"] : ''; ?>'>
          <div class="image-preview-container">
            <span class="image-controls remove-image-button">X</span>
            <span class="image-controls edit-image-button">E</span>
            <img class='slide_image_preview' src='<?php echo isset( $slider_two_options['slider_main_image_id'] ) ? wp_get_attachment_image_url( $slider_two_options['slider_main_image_id'], 'thumbnail' ) : ''; ?>'>
          </div>
            <input type='button' class='image_upload_button button <?php echo ( !empty( $slider_two_options["slider_main_image_id"] ) ) ? "hidden" : ""; ?>' value='upload image'>
        </td>
        <td>
          <input type="text" name="<?php echo $this->plugin_name . '-settings'; ?>[slider_two][slider_title]" value="<?php echo isset( $slider_two_options["slider_title"] ) ? $slider_two_options["slider_title"] : '';  ?>">
        </td>
        <td>
          <input type="text" name="<?php echo $this->plugin_name . '-settings'; ?>[slider_two][slider_title_link]" value="<?php echo isset( $slider_two_options["slider_title_link"] ) ? $slider_two_options["slider_title_link"] : '';  ?>">
        </td>
        <td>
          <textarea name="<?php echo $this->plugin_name . '-settings'; ?>[slider_two][slider_description]" rows="8" cols="40"><?php echo isset( $slider_two_options["slider_description"] ) ? $slider_two_options["slider_description"] : ''; ?></textarea>
        </td>
      </tr>
    </tbody>
    </table>
    <?php submit_button(); ?>
    <table class="form-table">
      <tr>
        <td>
          <h4>Slides</h4>
        </td>
      </tr>
    </table>
    <table class="slider_two slider widefat">
      <thead>
        <tr class="row-title">
          <th>
            Slide Image Preview
          </th>
          <th class="row-title">
            Slide Title
          </th>
          <th class="row-title">
            Slide Image Link
          </th>
          <th></th>
        </tr>
      </thead>
      <tbody>
      <?php if ( count( $slider_two_options ) ) : ?>
        <?php foreach ( $slider_two_slides as $slide ) : ?>
              <tr class='slide' colspan="3">
                <td>
                  <input type='hidden' class="image_upload_id" name='<?php echo $this->plugin_name; ?>-settings[slider_two][slides][slide_<?php echo $counter; ?>][slide_image_id]' value='<?php echo $slide["slide_image_id"]; ?>'>
                  <div class="image-preview-container">
                    <span class="image-controls remove-image-button">X</span>
                    <span class="image-controls edit-image-button">E</span>
                    <img class='slide_image_preview' src='<?php echo wp_get_attachment_image_url( $slide['slide_image_id'], 'thumbnail' ); ?>'>
                  </div>
                  <input type='button' class='image_upload_button button <?php echo ( !empty( $slide["slide_image_id"] ) ) ? "hidden" : ""; ?>' value='upload image'>
                </td>
                <td>
                  <input type='text' name='<?php echo $this->plugin_name; ?>-settings[slider_two][slides][slide_<?php echo $counter; ?>][slide_title]' class='regular-text' value='<?php echo isset ( $slide['slide_title'] ) ? $slide['slide_title'] : ''; ?>'>
                </td>
                <td>
                  <input type='text' name='<?php echo $this->plugin_name; ?>-settings[slider_two][slides][slide_<?php echo $counter; ?>][slide_link]' class='regular-text' value='<?php echo isset( $slide['slide_link'] ) ? $slide['slide_link'] : ''; ?>'>
                </td>
                <td>
                  <a class="remove-slide-link" href="#">Remove Slide</a>
                </td>
              </tr>
            <?php $counter++; ?>
        <?php endforeach; ?>
      <?php endif; ?>
    </tbody>
  </table>
</div>
      <div class="slider-container slider_three_container">
      <table class="widefat">
    <thead>
      <tr>
        <th>
          Slider Image Preview
        </th>
        <th>
          Slider Title
        </th>
        <th>
          Slider Title Link
        </th>
        <th>
          Slider Description
        </th>
      </tr>
    </thead>
    <tbody>
      <tr class="slider-info">
        <td>
          <input type='hidden' class="image_upload_id" name='<?php echo $this->plugin_name; ?>-settings[slider_three][slider_main_image_id]' value='<?php echo isset ( $slider_three_options["slider_main_image_id"] ) ? $slider_three_options["slider_main_image_id"] : ''; ?>'>
          <div class="image-preview-container">
            <span class="image-controls remove-image-button">X</span>
            <span class="image-controls edit-image-button">E</span>
            <img class='slide_image_preview' src='<?php echo isset( $slider_three_options['slider_main_image_id'] ) ? wp_get_attachment_image_url( $slider_three_options['slider_main_image_id'], 'thumbnail' ) : ''; ?>'>
          </div>
            <input type='button' class='image_upload_button button <?php echo ( !empty( $slider_three_options["slider_main_image_id"] ) ) ? "hidden" : ""; ?>' value='upload image'>
        </td>
        <td>
          <input type="text" name="<?php echo $this->plugin_name . '-settings'; ?>[slider_three][slider_title]" value="<?php echo isset( $slider_three_options["slider_title"] ) ? $slider_three_options["slider_title"] : '';  ?>">
        </td>
        <td>
          <input type="text" name="<?php echo $this->plugin_name . '-settings'; ?>[slider_three][slider_title_link]" value="<?php echo isset( $slider_three_options["slider_title_link"] ) ? $slider_three_options["slider_title_link"] : '';  ?>">
        </td>
        <td>
          <textarea name="<?php echo $this->plugin_name . '-settings'; ?>[slider_three][slider_description]" rows="8" cols="40"><?php echo isset( $slider_three_options["slider_description"] ) ? $slider_three_options["slider_description"] : ''; ?></textarea>
        </td>
      </tr>
    </tbody>
    </table>
    <?php submit_button(); ?>
    <table class="form-table">
      <tr>
        <td>
          <h4>Slides</h4>
        </td>
      </tr>
    </table>
      <table class="slider_three slider widefat">
      <thead>
        <tr class="row-title">
          <th>
            Slide Image Preview
          </th>
          <th class="row-title">
            Slide Title
          </th>
          <th class="row-title">
            Slide Image Link
          </th>
          <th></th>
        </tr>
      </thead>
      <tbody>
      <?php if ( count( $slider_three_options ) ) : ?>
        <?php foreach ( $slider_three_slides as $slide ) : ?>
              <tr class='slide' colspan="3">
                <td>
                  <input type='hidden' class="image_upload_id" name='<?php echo $this->plugin_name; ?>-settings[slider_three][slides][slide_<?php echo $counter; ?>][slide_image_id]' value='<?php echo $slide["slide_image_id"]; ?>'>
                  <div class="image-preview-container">
                    <span class="image-controls remove-image-button">X</span>
                    <span class="image-controls edit-image-button">E</span>
                    <img class='slide_image_preview' src='<?php echo isset( $slide['slide_image_id'] ) ? wp_get_attachment_image_url( $slide['slide_image_id'], 'thumbnail' ) : ''; ?>'>
                  </div>
                  <input type='button' class='image_upload_button button <?php echo ( !empty( $slide["slide_image_id"] ) ) ? "hidden" : ""; ?>' value='upload image'>
                </td>
                <td>
                  <input type='text' name='<?php echo $this->plugin_name; ?>-settings[slider_three][slides][slide_<?php echo $counter; ?>][slide_title]' class='regular-text' value='<?php echo isset ( $slide['slide_title'] ) ? $slide['slide_title'] : ''; ?>'>
                </td>
                <td>
                  <input type='text' name='<?php echo $this->plugin_name; ?>-settings[slider_three][slides][slide_<?php echo $counter; ?>][slide_link]' class='regular-text' value='<?php echo isset( $slide['slide_link'] ) ? $slide['slide_link'] : ''; ?>'>
                </td>
                <td>
                  <a class="remove-slide-link" href="#">Remove Slide</a>
                </td>
              </tr>
            <?php $counter++; ?>
        <?php endforeach; ?>
      <?php endif; ?>
    </tbody>
    </table>
  </div>
  <div class="slider-container slider_four_container">
  <table class="widefat">
    <thead>
      <tr>
        <th>
          Slider Image Preview
        </th>
        <th>
          Slider Title
        </th>
        <th>
          Slider Title Link
        </th>
        <th>
          Slider Description
        </th>
      </tr>
    </thead>
    <tbody>
      <tr class="slider-info">
        <td>
          <input type='hidden' class="image_upload_id" name='<?php echo $this->plugin_name; ?>-settings[slider_four][slider_main_image_id]' value='<?php echo isset ( $slider_four_options["slider_main_image_id"] ) ? $slider_four_options["slider_main_image_id"] : ''; ?>'>
          <div class="image-preview-container">
            <span class="image-controls remove-image-button">X</span>
            <span class="image-controls edit-image-button">E</span>
            <img class='slide_image_preview' src='<?php echo isset( $slider_four_options['slider_main_image_id'] ) ? wp_get_attachment_image_url( $slider_four_options['slider_main_image_id'], 'thumbnail' ) : ''; ?>'>
          </div>
            <input type='button' class='image_upload_button button <?php echo ( !empty( $slider_four_options["slider_main_image_id"] ) ) ? "hidden" : ""; ?>' value='upload image'>
        </td>
        <td>
          <input type="text" name="<?php echo $this->plugin_name . '-settings'; ?>[slider_four][slider_title]" value="<?php echo isset( $slider_four_options["slider_title"] ) ? $slider_four_options["slider_title"] : '';  ?>">
        </td>
        <td>
          <input type="text" name="<?php echo $this->plugin_name . '-settings'; ?>[slider_four][slider_title_link]" value="<?php echo isset( $slider_four_options["slider_title_link"] ) ? $slider_four_options["slider_title_link"] : '';  ?>">
        </td>
        <td>
          <textarea name="<?php echo $this->plugin_name . '-settings'; ?>[slider_four][slider_description]" rows="8" cols="40"><?php echo isset( $slider_four_options["slider_description"] ) ? $slider_four_options["slider_description"] : ''; ?></textarea>
        </td>
      </tr>
    </tbody>
    </table>
    <?php submit_button(); ?>
    <table class="form-table">
      <tr>
        <td>
          <h4>Slides</h4>
        </td>
      </tr>
    </table>
    <table class="slider_four slider widefat">
      <thead>
        <tr class="row-title">
          <th>
            Slide Image Preview
          </th>
          <th class="row-title">
            Slide Title
          </th>
          <th class="row-title">
            Slide Image Link
          </th>
          <th></th>
        </tr>
      </thead>
      <tbody>
      <?php if ( count( $slider_four_options ) ) : ?>
        <?php foreach ( $slider_four_slides as $slide ) : ?>
              <tr class='slide' colspan="3">
                <td>
                  <input type='hidden' class="image_upload_id" name='<?php echo $this->plugin_name; ?>-settings[slider_four][slides][slide_<?php echo $counter; ?>][slide_image_id]' value='<?php echo $slide["slide_image_id"]; ?>'>
                  <div class="image-preview-container">
                    <span class="image-controls remove-image-button">X</span>
                    <span class="image-controls edit-image-button">E</span>
                    <img class='slide_image_preview' src='<?php echo isset( $slide['slide_image_id'] ) ? wp_get_attachment_image_url( $slide['slide_image_id'], 'thumbnail' ) : ''; ?>'>
                  </div>
                  <input type='button' class='image_upload_button button <?php echo ( !empty( $slide["slide_image_id"] ) ) ? "hidden" : ""; ?>' value='upload image'>
                </td>
                <td>
                  <input type='text' name='<?php echo $this->plugin_name; ?>-settings[slider_four][slides][slide_<?php echo $counter; ?>][slide_title]' class='regular-text' value='<?php echo isset ( $slide['slide_title'] ) ? $slide['slide_title'] : ''; ?>'>
                </td>
                <td>
                  <input type='text' name='<?php echo $this->plugin_name; ?>-settings[slider_four][slides][slide_<?php echo $counter; ?>][slide_link]' class='regular-text' value='<?php echo isset( $slide['slide_link'] ) ? $slide['slide_link'] : ''; ?>'>
                </td>
                <td>
                  <a class="remove-slide-link" href="#">Remove Slide</a>
                </td>
              </tr>
            <?php $counter++; ?>
        <?php endforeach; ?>
      <?php endif; ?>
    </tbody>
    </table>
  </div>
    <?php submit_button(); ?>
  </form>
</div>
