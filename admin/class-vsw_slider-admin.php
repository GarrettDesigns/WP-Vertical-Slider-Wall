<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       www.garrettryandesign.com
 * @since      1.0.0
 *
 * @package    Vsw_slider
 * @subpackage Vsw_slider/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Vsw_slider
 * @subpackage Vsw_slider/admin
 * @author     Garrett Kucinski <garrett.kucinski@gmail.com>
 */
class Vsw_slider_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * The main settings heading of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $settings_title;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version, $settings_title ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;
    $this->settings_title = $settings_title;


	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Vsw_slider_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Vsw_slider_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/vsw_slider-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Vsw_slider_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Vsw_slider_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */
    wp_enqueue_media();
		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/vsw_slider-admin.js', array( 'jquery' ), $this->version, false );
    wp_localize_script( $this->plugin_name, 'ajax_object', array( 'ajax_url' => admin_url( 'admin-ajax.php' ), 'option_table_name' => $this->plugin_name . '-settings' ) );
	}

  /**
	 * Register the main menu for the admin area.
	 *
	 * @since 1.0.0
	 */

  public function add_plugin_admin_menu_page() {
    add_menu_page(
      'WP Vertical Slider Wall Settings',
      'WP Vertical Slider Wall',
      'manage_options',
      'vsw-admin-menu',
      array( $this, 'vsw_menu_page_content_callback' ),
      'dashicons-schedule'
    );
  }

  public function vsw_menu_page_content_callback() {
    include_once( 'partials/vsw_slider-admin-display.php' );
  }

  public function vsw_settings_init() {

    $plugin_settings = $this->plugin_name . '-settings';

    register_setting( $plugin_settings, $plugin_settings );

    add_settings_section(
      'vsw_slider_one_settings_section',
      'These are the settings for this slider',
      array( $this, 'slider_one_settings_section_callback' ),
      $plugin_settings
    );

    add_settings_field(
      'slide_image_upload',
      'Slider Data',
      array( $this, 'generate_custom_slide_inputs' ),
      $plugin_settings,
      'vsw_slider_one_settings_section',
      array( 'class' => 'widefat' )
    );
  }

  public function slider_one_settings_section_callback() {
    echo '<p>Using the input below you may assign an image, title, and link for each slide in this slider <br> As well as input a main image, title and link for each slider group</p>';
  }

  public function generate_custom_slide_inputs() {
    $plugin_settings = $this->plugin_name . '-settings';
    $options = get_option( $plugin_settings );
  }

  public function render_sliders() {
    $sliders = get_option( $this->plugin_name . '-settings' );

    $slider_one = $sliders['slider_one'];
    $slider_two = $sliders['slider_two'];
    $slider_three = $sliders['slider_three'];
    $slider_four = $sliders['slider_four'];

    echo '<div id="vsw_slider">';
      self::render_single_slider( $slider_one, $sliders );
      self::render_single_slider( $slider_two, $sliders );
      self::render_single_slider( $slider_three, $sliders );
      self::render_single_slider( $slider_four, $sliders );
    echo '</div>';
  }

  public function render_single_slider( $slider, $sliders ) {

    $slider_title = $slider['slider_title'];
    $slider_title_link = $slider['slider_title_link'];
    $slider_main_image = wp_get_attachment_image_url( $slider['slider_main_image_id'], 'full' );

    $html = '';

      $html .= '<div class="col no-hover">';
        $html .= '<h2 class="slider-title"><a href="' . $slider_title_link . '">' . $slider_title . '</a></h2>';
        $html .= '<div class="responsive">';
          $html .= '<a href="' . $slider_title_link . '"><img src="' . $slider_main_image . '"></a>';
        $html .= '</div>';
        $html .= '<div class="vsw_slider">';
        foreach( $slider['slides'] as $slide ) {
          // Set up variables for outputting slider values
          $slide_link = $slide["slide_link"];
          $slide_url = wp_get_attachment_image_url( $slide["slide_image_id"], "full");
          $slide_title = isset( $slide["slide_title"] ) && !empty( $slide["slide_title"] ) ? $slide["slide_title"] : "";

          // Output slider markup with dynamic values
            $html .= '<div class="vsw_slide">';
              $html .= '<a href="' . $slide_link  . '"><img src="' . $slide_url . '" alt="vertical slider image"></a>';
              $html .= '<span class="slide-title">' . $slide_title . '</span>';
            $html .= '</div>';
        }
        $html .= '</div>';
      $html .= '</div>';

    echo $html;
  }

  public function register_shortcodes() {
    add_shortcode( 'vsw_slider_wall', array( $this, 'render_sliders' ) );
  }
}
