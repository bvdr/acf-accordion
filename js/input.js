(function($){


	function initialize_field( $el ) {

		//$el.doStuff();

	}


	if( typeof acf.add_action !== 'undefined' ) {

		/*
		 *  ready append (ACF5)
		 *
		 *  These are 2 events which are fired during the page load
		 *  ready = on page load similar to $(document).ready()
		 *  append = on new DOM elements appended via repeater field
		 *
		 *  @type	event
		 *  @date	20/07/13
		 *
		 *  @param	$el (jQuery selection) the jQuery element which contains the ACF fields
		 *  @return	n/a
		 */

		acf.add_action('ready', function( $el ){

			// search $el for fields of type 'accordion'
			acf.get_fields({ type : 'accordion' }, $el).each(function(){

				initialize_field( $(this) );
				$(this).nextUntil(".acf-field-tab, .acf-field-accordion").wrapAll('<div class="acf-field acf-accordion-group"></div>');
			});

			$(".acf-field-accordion").click(function () {
				var toggler = $(this);
				if ( toggler.hasClass("opened") ) {
					toggler.removeClass('opened');
					toggler.next(".acf-accordion-group").removeClass("opened");
				} else {
					$(".acf-field-accordion.opened").removeClass('opened').next(".acf-accordion-group").removeClass("opened");
					toggler.addClass('opened').next(".acf-accordion-group").addClass("opened").children('.acf-field').each(function(){
						$(this).removeClass('hidden-by-tab');
					});;
					refresh_fields_google_map();
				}
			});

			// refreshes the gravity forms map field
			function refresh_fields_google_map(){

				var googleMaps = $('.acf-field-google-map');

				for (var i = 0; i < googleMaps.length; i++) {

					var fieldId = $(googleMaps[i]).attr('data-key');

					acf.fields.google_map.refresh(fieldId);

				}
			}

		});


	} else {


		/*
		 *  acf/setup_fields (ACF4)
		 *
		 *  This event is triggered when ACF adds any new elements to the DOM.
		 *
		 *  @type	function
		 *  @since	1.0.0
		 *  @date	01/01/12
		 *
		 *  @param	event		e: an event object. This can be ignored
		 *  @param	Element		postbox: An element which contains the new HTML
		 *
		 *  @return	n/a
		 */

		$(document).on('acf/setup_fields', function(e, postbox){

			$(postbox).find('.field[data-field_type="accordion"]').each(function(){

				initialize_field( $(this) );
				$(this).nextUntil(".field_type-tab, .field_type-accordion").wrapAll('<div class="acf-accordion-group"></div>');

			});

			jQuery(".field_type-accordion").on('click', function () {
				var toggler = $(this);
				if ( toggler.hasClass("opened") ) {
					toggler.removeClass('opened');
					toggler.next(".acf-accordion-group").removeClass("opened");
				} else {
					$(".field_type-accordion.opened").removeClass('opened');
					toggler.addClass('opened');
					$(".acf-accordion-group.opened").removeClass("opened");
					toggler.next(".acf-accordion-group").addClass("opened");
					refresh_fields_google_map();
				}
			});

			// refreshes the gravity forms map field
			function refresh_fields_google_map(){

				var googleMaps = $('.acf-field-google-map');

				for (var i = 0; i < googleMaps.length; i++) {

					var fieldId = $(googleMaps[i]).attr('data-key');

					acf.fields.google_map.refresh(fieldId);

				}
			}

		});
	}
})(jQuery);