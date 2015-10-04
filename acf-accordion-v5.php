<?php

class acf_field_accordion extends acf_field {
	
	/*
	*  __construct
	*
	*  This function will setup the field type data
	*
	*  @type	function
	*  @date	5/03/2014
	*  @since	5.0.0
	*
	*  @param	n/a
	*  @return	n/a
	*/
	
	function __construct() {

		$this->name = 'accordion';
		$this->label = __('Accordion Tab', 'acf-accordion');
		$this->category = 'layout';
		
		$this->defaults = array(
			'value'			=> false, // prevents acf_render_fields() from attempting to load value
			'icon_class'	=> 'dashicons-arrow-right'
		);

		// Settings
		$this->settings = array(
			'icons'		=>	plugin_dir_url( __FILE__ ) . 'icons/icons.json'
		);

		$this->l10n = array();
		
    	parent::__construct();
    	
	}
	
	/*
	*  render_field_settings()
	*
	*  Create extra settings for your field. These are visible when editing a field
	*
	*  @type	action
	*  @since	3.6
	*  @date	23/01/13
	*
	*  @param	$field (array) the $field being edited
	*  @return	n/a
	*/
	
	function render_field_settings( $field ) {
		
		/*
		*  acf_render_field_setting
		*
		*  This function will create a setting for your field. Simply pass the $field parameter and an array of field settings.
		*  The array of settings does not require a `value` or `prefix`; These settings are found from the $field array.
		*
		*  More than one setting can be added by copy/paste the above code.
		*  Please note that you must also have a matching $defaults value for the field name (font_size)
		*/
		
		// acf_render_field_setting( $field, array(
		// 	'label'			=> __('Icon class','acf-accordion'),
		// 	'instructions'	=> __('You can add any icon class from the <a href="https://developer.wordpress.org/resource/dashicons/" target="_blank">Developer Resources: Dashicons</a>','acf-accordion'),
		// 	'type'			=> 'text',
		// 	'name'			=> 'icon_class',
		// ));

		$json_file = wp_remote_get($this->settings['icons']);
		$json_file = wp_remote_retrieve_body( $json_file );
		$json_content = @json_decode( $json_file, true );
		
		if ( !isset( $json_content['icons'] ) ){
			_e('No icons found', 'acf-accordion');
			return;
		}

		$icons = array();

		foreach ( $json_content['icons'] as $icon ) {
			$icons[$icon['icon']['class']] = $icon['icon']['name'];
		}

		acf_render_field_setting( $field, array(
			'label'			=> __('Icon','acf-accordion'),
			'type'			=> 'select',
			'id'			=> $field['ID'] . 'accordion-select',
			'name'			=> 'icon_class',
			'choices'		=> $icons,
		));

		?>
		<script>
			(function($){				
				var ID = '<?php echo $field['ID'] ?>';
				jQuery("#"+ID+"accordion-select").select2({
					formatResult: format,
					formatSelection: format,
				});
				function format(o) {
					if (!o.id) {
						return o.text; // optgroup
					} else {
						return "<i class='accordion dashicons " + o.id + "' style='margin-right: 5px;'></i>" + o.text;
					}
				}
			})(jQuery);
		</script>
		<?php
	}
	
	
	/*
	*  render_field()
	*
	*  Create the HTML interface for your field
	*
	*  @param	$field (array) the $field being rendered
	*
	*  @type	action
	*  @since	3.6
	*  @date	23/01/13
	*
	*  @param	$field (array) the $field being edited
	*  @return	n/a
	*/
	
	function render_field( $field ) {		
		?>
		<h2><span class="dashicons-before <?php echo esc_attr( $field['icon_class'] ) ?>"></span><?php echo esc_attr( $field['label'] ) ?></h2>
		<?php
	}
	
		
	/*
	*  input_admin_enqueue_scripts()
	*
	*  This action is called in the admin_enqueue_scripts action on the edit screen where your field is created.
	*  Use this action to add CSS + JavaScript to assist your render_field() action.
	*
	*  @type	action (admin_enqueue_scripts)
	*  @since	3.6
	*  @date	23/01/13
	*
	*  @param	n/a
	*  @return	n/a
	*/
	
	function input_admin_enqueue_scripts() {
		
		$dir = plugin_dir_url( __FILE__ );
		$dir = apply_filters( "acf/accordion/dir", $dir );
		
		// register & include JS
		wp_register_script( 'acf-input-accordion', "{$dir}js/input.js" );
		wp_enqueue_script('acf-input-accordion');
		
		// register & include CSS
		wp_register_style( 'acf-input-accordion', "{$dir}css/input.css" );
		wp_enqueue_style('acf-input-accordion');
		
	}
	
	
	/*
	*  field_group_admin_enqueue_scripts()
	*
	*  This action is called in the admin_enqueue_scripts action on the edit screen where your field is edited.
	*  Use this action to add CSS + JavaScript to assist your render_field_options() action.
	*
	*  @type	action (admin_enqueue_scripts)
	*  @since	3.6
	*  @date	23/01/13
	*
	*  @param	n/a
	*  @return	n/a
	*/

	function field_group_admin_enqueue_scripts() {

		$dir = plugin_dir_url( __FILE__ );
		$dir = apply_filters( "acf/accordion/dir", $dir );

		// register & include CSS
		wp_register_style( 'acf-admin-accordion', "{$dir}css/accordion-admin.css" );
		wp_enqueue_style( 'acf-admin-accordion' );

	}

}

// create field
new acf_field_accordion();

?>