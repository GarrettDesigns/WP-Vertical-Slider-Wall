(function( $ ) {
	'use strict';

	/**
	 * All of the code for your admin-facing JavaScript source
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

  var counter = 1;

  $(function() {
      var data = {
        'action': 'save_slide_data',
        'slide_data': ajax_object
      };

      appendAddSlideButton();
      addNewSlide();
  });

  function appendAddSlideButton() {
    var addSlideInput = '<tr>' +
                          '<td>' +
                            '<input type="button" class="add-slide-button button" value="Add Slide">' +
                          '</td>' +
                        '</tr>';

    $('.form-table').append(addSlideInput);
   }

   function addNewSlide() {

    var lastSlide = $('.slide').last(),
        newSlide = function(counter) {
          return '<tr class="slide">' +
                    '<td>' +
                      '<img class="" src="">' +
                      '<input type="button" name="'+ ajax_object.option_table_name + '[slider_one][slide_' + counter + '][slide_image]" class="button" value="Upload Image">' +
                    '</td>' +
                    '<td>' +
                      '<input type="text" name="'+ ajax_object.option_table_name + '[slider_one][slide_' + counter + '][slide_title]" class="regular-text" value="">' +
                    '</td>' +
                    '<td>' +
                      '<input type="text" name="'+ ajax_object.option_table_name + '[slider_one][slide_' + counter + '][slide_link]" class="regular-text" value="">' +
                    '</td>' +
                  '</tr>';
        }


     $('.add-slide-button').on('click', function() {

      if(!$('.slide')) {
        $('.form-table').append(newSlide(counter));
      } else {
        $(newSlide(counter)).insertAfter(lastSlide);
      }
      
      counter++;
    });
   }

})( jQuery );
