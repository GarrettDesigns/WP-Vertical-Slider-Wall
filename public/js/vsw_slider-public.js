(function( $ ) {
	'use strict';

	/**
	 * All of the code for your public-facing JavaScript source
	 * should reside in this file.
	 *
	 * Note: It has been assumed you will write jQuery code here, so the
	 * $ function reference has been prepared for usage within the scope
	 * of this function.
	 *
	 * This enables you to define handlers, for when the DOM is ready:
	 *
	 * $(function() {
	 *
	 * });
	 *
	 * When the window is loaded:
	 *
	 * $( window ).load(function() {
	 *
	 * });
	 *
	 * ...and/or other possibilities.
	 *
	 * Ideally, it is not considered best practise to attach more than a
	 * single DOM-ready or window-load handler for a particular page.
	 * Although scripts in the WordPress core, Plugins and Themes may be
	 * practising this, we should strive to set a better example in our own work.
	 */

      jQuery(document).ready(function() {
        var counter = 1;

        jQuery(window).resize(function() {
          jQuery('.vsw_slider').slick('resize');
          jQuery('.vsw_slider').slick('reInit');
        });

        jQuery(window).on('orientationchange', function() {
          jQuery('.vsw_slider').slick('resize');
          jQuery('.vsw_slider').slick('reInit');
        });

        jQuery('.col').each(function() {
          jQuery(this).addClass('col' + counter);
          counter++;
        });

        jQuery('.col').hover(function() {
          jQuery(this).removeClass('no-hover').addClass('hover');
        }, function() {
          jQuery('.col').addClass('no-hover').removeClass('hover');
        });

        jQuery('.vsw_slider').slick({
          'dots': false,
          'verticalSwiping': true,
          'vertical': true,
          'slidesToShow': slider_settings.slides_to_show,
          'prevArrow': '<span class="vsw_prev_arrow"></span>',
          'nextArrow': '<span class="vsw_next_arrow"></span>'
        });
      });

})( jQuery );
