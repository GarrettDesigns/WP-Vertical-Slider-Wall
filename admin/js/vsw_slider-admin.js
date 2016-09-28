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


  $(function() {
      var slideLength = $('.slide').length,
          data = {
            'action': 'save_slide_data',
          },
          optionTableName = ajax_object.option_table_name;

      appendAddSlideButton();
      addNewSlide(slideLength, optionTableName);
  });

  function appendAddSlideButton() {
    var addSlideInput = '<tr>' +
                          '<td>' +
                            '<input type="button" class="add-slide-button button" value="Add Slide">' +
                          '</td>' +
                        '</tr>';

    $('.form-table').append(addSlideInput);
   }

  function newSlide(slideLength, parentSlider, optionTableName) {
      return '<tr class="slide">' +
                '<td>' +
                  '<img class="" src="">' +
                  '<input type="button" name="'+ optionTableName + '[' + parentSlider + '][slide_' + slideLength + '][slide_image]" class="button" value="upload image">' +
                '</td>' +
                '<td>' +
                  '<input type="text" name="'+ optionTableName + '[' + parentSlider + '][slide_' + slideLength + '][slide_title]" class="regular-text" value="">' +
                '</td>' +
                '<td>' +
                  '<input type="text" name="'+ optionTableName + '[' + parentSlider + '][slide_' + slideLength + '][slide_link]" class="regular-text" value="">' +
                '</td>' +
              '</tr>';
  }

   function addNewSlide(slideLength, optionTableName) {

    $('.add-slide-button').on('click', function() {

      var sliders = $(this).parents('table'),
          sliderClassArray = sliders.attr('class').split(' '),
          parentSlider = sliderClassArray[0],
          parentSliderClass = $('.' + parentSlider),
          lastSlide = parentSliderClass.find('.slide').last();

      slideLength++;

      if(parentSliderClass.find('.slide').length != 0) {
        $(newSlide(slideLength, parentSlider, optionTableName)).insertAfter(lastSlide);
      } else {
        parentSliderClass.append(newSlide(slideLength, parentSlider));
      }
    });
   }

})( jQuery );
