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
		
		acf.add_action('ready append', function( $el ){
			
			// search $el for fields of type 'accordion'
			acf.get_fields({ type : 'accordion'}, $el).each(function(){
				
				initialize_field( $(this) );
				
			});

            //<![CDATA[
            (function ($) {
                jQuery(".acf-tab-button").click(function () {
                    jQuery(".acf-field-accordion").removeClass('active')
                    jQuery(".acf-field-accordion").nextUntil(".field_type-tab, .acf-field-accordion, script").css("display", "none");
                });
                jQuery(".acf-field-accordion").nextUntil(".field_type-tab, .acf-field-accordion, script").css("display", "none");
                jQuery(".acf-field-accordion").click(function () {
                    jQuery(".acf-field-accordion").nextUntil(".field_type-tab, .acf-field-accordion, script").css("display", "none");
                    if ($(this).hasClass("active")) {
                        jQuery(this).removeClass('active')
                    } else {
                        jQuery('.acf-field-accordion').removeClass('active')
                        jQuery(this).addClass('active').nextUntil(".field_type-tab, .acf-field-accordion, script").css("display", "block");
                    }
                });
            })(jQuery);
            //]]>
			
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
				
			});

            //<![CDATA[
            (function ($) {
                jQuery(".acf-tab-button").click(function () {
                    jQuery(".field_type-accordion").removeClass('active')
                    jQuery(".field_type-accordion").nextUntil(".field_type-tab, .field_type-accordion, script").css("display", "none");
                });
                jQuery(".field_type-accordion").nextUntil(".field_type-tab, .field_type-accordion, script, div[style='display:none']").css("display", "none");
                jQuery(".field_type-accordion").click(function () {
                    jQuery(".field_type-accordion").nextUntil(".field_type-tab, .field_type-accordion, script").css("display", "none");
                    if ($(this).hasClass("active")) {
                        jQuery(this).removeClass('active')
                    } else {
                        jQuery('.field_type-accordion').removeClass('active')
                        jQuery(this).addClass('active').nextUntil(".field_type-tab, .field_type-accordion, script").css("display", "block");
                    }
                });
            })(jQuery);
            //]]>
		
		});
	
	
	}


})(jQuery);
