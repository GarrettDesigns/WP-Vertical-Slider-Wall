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
          optionTableName = ajax_object.option_table_name;

      appendAddSlideButton();
      addNewSlide(slideLength, optionTableName);
      addSlideImage();
      removeSlideImage();
      removeSlide();
      switchTabs();
  });

  function appendAddSlideButton() {
    var addSlideInput = '<tr>' +
                          '<td>' +
                            '<input type="button" class="add-slide-button button" value="Add Slide">' +
                          '</td>' +
                        '</tr>';

    $('.slider').append(addSlideInput);
   }

  function newSlide(slideLength, parentSlider, optionTableName) {
      var optionTableName = ajax_object.option_table_name;

      return '<tr class="slide">' +
                '<td>' +
                  '<img style="max-width: 200px; max-height: 200px; overflow: hidden;" class="slide_image_preview" src="">' +
                  '<input type="hidden" value="" name="' + optionTableName + '[' + parentSlider + '][slides][slide_' + slideLength + '][slide_image_id]">' +
                  '<input type="button" class="image_upload_button button" value="upload image">' +
                '</td>' +
                '<td>' +
                  '<input type="text" name="'+ optionTableName + '[' + parentSlider + '][slides][slide_' + slideLength + '][slide_title]" class="regular-text" value="">' +
                '</td>' +
                '<td>' +
                  '<input type="text" name="'+ optionTableName + '[' + parentSlider + '][slides][slide_' + slideLength + '][slide_link]" class="regular-text" value="">' +
                '</td>' +
                '<td>' +
                  '<a class="remove-slide-link" href="#">Remove Slide</a>' +
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

      addSlideImage();
    });
   }

  function switchTabs(sessionData) {
    var sliderContainer = $('.slider-container');

    $('.nav-tab-wrapper').on('click', 'a', function() {
        $('.nav-tab-wrapper').find('a').removeClass('nav-tab-active');
        $(this).addClass('nav-tab-active');
        sliderContainer.hide();
        sliderContainer.eq($(this).index()).show();
        return false;
    });
  }

  function addSlideImage() {

    var slide = $('.slide');

    slide.on( 'click', '.image_upload_button, .edit-image-button', function( event ){

      var thisButton = $(this),
          currentSlide = thisButton.parents('.slide');

      event.preventDefault();

      // If the media frame already exists, reopen it.
      if ( frame ) {
        frame.open();
        return;
      }

      // Create a new media frame
      var frame = wp.media({
        title: 'Select or Upload Media Of Your Chosen Persuasion',
        button: {
          text: 'Use this media'
        },
        multiple: true  // Set to true to allow multiple files to be selected
      });


      // When an image is selected in the media frame...
      frame.on( 'select', function() {

        // Get media attachment details from the frame state
        var attachment = frame.state().get('selection').first().toJSON();

        // Send the attachment URL to our custom image input field.
        currentSlide.find('.slide_image_preview').attr('src', attachment.url);

        // Send the attachment id to our hidden input
        currentSlide.find('.image_upload_id').val( attachment.id );

        // Hide the add image link
        thisButton.addClass( 'hidden' );

        // Unhide the remove image link
        delImgLink.removeClass( 'hidden' );
      });

      // Finally, open the modal on click
      frame.open();
    });
  }

  function removeSlideImage() {
    var delImgLink = $('.remove-image-button');
    // DELETE IMAGE LINK
    delImgLink.on( 'click', function( event ){

    var thisButton = $(this),
        currentSlide = thisButton.parents('.slide');

      event.preventDefault();

      // Clear out the preview image
      currentSlide.find('.slide_image_preview').attr( 'src', '' );

      // Un-hide the add image link
      currentSlide.find('.image_upload_button').removeClass( 'hidden' );

      // Hide the delete image link
      currentSlide.find('.image-preview-container').addClass( 'hidden' );

      // Delete the image id from the hidden input
      currentSlide.find('.image_upload_id').val( '' );

    });
  }

  function removeSlide() {
    $('.remove-slide-link').on('click', function(e) {
      e.preventDefault();
      $(this).parents('.slide').remove();
    });
  }


})( jQuery );
