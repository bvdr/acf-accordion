<?php

class acf_field_accordion extends acf_field {
	// vars
	var $settings, // will hold info such as dir / path
		$defaults; // will hold default field options

	/*
	*  __construct
	*
	*  Set name / label needed for actions / filters
	*
	*  @since	3.6
	*  @date	23/01/13
	*/
	
	function __construct()
	{
		// vars
		$this->name = 'accordion';
		$this->label = __('Accordion Tab');
		$this->category = __("Layout",'acf'); // Basic, Content, Choice, etc
		$this->defaults = array(
			'icon_class' => 'dashicons-arrow-right'
		);

    	parent::__construct();
    	
    	// settings
		$this->settings = array(
			'path'		=> apply_filters('acf/helpers/get_path', __FILE__),
			'dir'		=> apply_filters('acf/helpers/get_dir', __FILE__),
			'icons'		=>	plugin_dir_url( __FILE__ ) . 'icons/icons.json',
			'version'	=> '1.0.0'
		);
	}
	
	
	/*
	*  create_options()
	*
	*  Create extra options for your field. This is rendered when editing a field.
	*  The value of $field['name'] can be used (like below) to save extra data to the $field
	*
	*  @type	action
	*  @since	3.6
	*  @date	23/01/13
	*
	*  @param	$field	- an array holding all the field's data
	*/
	
	function create_options( $field ) {

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

		$key = $field['name'];
		$ID = $field['key'];
		// Create Field Options HTML ?>
		<tr class="field_option field_option_<?php echo $this->name; ?>">
			<td class="label">
				<label><?php _e("Icon",'acf-accordion'); ?></label>
			</td>
			<td>
				<?php				
				do_action('acf/create_field', array(
					'type'  		=> 'select',
					'name'  		=> 'fields[' . $key . '][icon_class]',
					'value' 		=> $field['icon_class'],
					'id'			=> $ID . 'accordion-select',
					'choices'		=> $icons,
				));
				?>
			</td>
		</tr>
		<script>
			(function($){				
				var ID = '<?php echo $ID ?>';
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
	*  create_field()
	*
	*  Create the HTML interface for your field
	*
	*  @param	$field - an array holding all the field's data
	*
	*  @type	action
	*  @since	3.6
	*  @date	23/01/13
	*/
	
	function create_field( $field )	{
		// create Field HTML
		?>
			<h2><span class="dashicons-before <?php echo esc_attr( $field['icon_class'] ) ?>"></span><?php echo esc_attr( $field['label'] ) ?></h2>
		<?php
	}
	
	
	/*
	*  input_admin_enqueue_scripts()
	*
	*  This action is called in the admin_enqueue_scripts action on the edit screen where your field is created.
	*  Use this action to add CSS + JavaScript to assist your create_field() action.
	*
	*  $info	http://codex.wordpress.org/Plugin_API/Action_Reference/admin_enqueue_scripts
	*  @type	action
	*  @since	3.6
	*  @date	23/01/13
	*/

	function input_admin_enqueue_scripts()
	{
		// Note: This function can be removed if not used

		$dir = $this->settings['dir'];
		$dir = apply_filters( "acf/accordion/dir", $dir );

		// register ACF scripts
		wp_register_script( 'acf-input-accordion', $dir . 'js/input.js', array('acf-input'), $this->settings['version'] );
		wp_register_style( 'acf-input-accordion', $dir . 'css/input.css', array('acf-input'), $this->settings['version'] );
		
		
		// scripts
		wp_enqueue_script(array('acf-input-accordion'));

		// styles
		wp_enqueue_style(array('acf-input-accordion'));		
	}
	
	/*
	*  field_group_admin_enqueue_scripts()
	*
	*  This action is called in the admin_enqueue_scripts action on the edit screen where your field is edited.
	*  Use this action to add CSS + JavaScript to assist your create_field_options() action.
	*
	*  $info	http://codex.wordpress.org/Plugin_API/Action_Reference/admin_enqueue_scripts
	*  @type	action
	*  @since	3.6
	*  @date	23/01/13
	*/

	function field_group_admin_enqueue_scripts()
	{
		$dir = plugin_dir_url( __FILE__ );

		// register & include CSS
		wp_register_style( 'acf-admin-accordion', "{$dir}css/accordion-admin.css" );
		wp_enqueue_style( 'acf-admin-accordion' );

		// register & include CSS + JS for FontIconPicker
		wp_register_script( 'acf-select2-js', "{$dir}js/select2/select2.min.js" );
		wp_enqueue_script( 'acf-select2-js' );
		wp_register_style( 'acf-select2-css', "{$dir}js/select2/select2.css" );
		wp_enqueue_style( 'acf-select2-css' );
	}

	
	/*
	*  load_value()
	*
		*  This filter is applied to the $value after it is loaded from the db
	*
	*  @type	filter
	*  @since	3.6
	*  @date	23/01/13
	*
	*  @param	$value - the value found in the database
	*  @param	$post_id - the $post_id from which the value was loaded
	*  @param	$field - the field array holding all the field options
	*
	*  @return	$value - the value to be saved in the database
	*/
	
	function load_value( $value, $post_id, $field )
	{
		// Note: This function can be removed if not used
		return $value;
	}
	
	
	/*
	*  update_value()
	*
	*  This filter is applied to the $value before it is updated in the db
	*
	*  @type	filter
	*  @since	3.6
	*  @date	23/01/13
	*
	*  @param	$value - the value which will be saved in the database
	*  @param	$post_id - the $post_id of which the value will be saved
	*  @param	$field - the field array holding all the field options
	*
	*  @return	$value - the modified value
	*/
	
	function update_value( $value, $post_id, $field )
	{
		// Note: This function can be removed if not used
		return $value;
	}
	
	
	/*
	*  format_value()
	*
	*  This filter is applied to the $value after it is loaded from the db and before it is passed to the create_field action
	*
	*  @type	filter
	*  @since	3.6
	*  @date	23/01/13
	*
	*  @param	$value	- the value which was loaded from the database
	*  @param	$post_id - the $post_id from which the value was loaded
	*  @param	$field	- the field array holding all the field options
	*
	*  @return	$value	- the modified value
	*/
	
	function format_value( $value, $post_id, $field )
	{
		// defaults?
		/*
		$field = array_merge($this->defaults, $field);
		*/
		
		// perhaps use $field['preview_size'] to alter the $value?
		
		
		// Note: This function can be removed if not used
		return $value;
	}
	
	
	/*
	*  format_value_for_api()
	*
	*  This filter is applied to the $value after it is loaded from the db and before it is passed back to the API functions such as the_field
	*
	*  @type	filter
	*  @since	3.6
	*  @date	23/01/13
	*
	*  @param	$value	- the value which was loaded from the database
	*  @param	$post_id - the $post_id from which the value was loaded
	*  @param	$field	- the field array holding all the field options
	*
	*  @return	$value	- the modified value
	*/
	
	function format_value_for_api( $value, $post_id, $field )
	{
		// defaults?
		/*
		$field = array_merge($this->defaults, $field);
		*/
		
		// perhaps use $field['preview_size'] to alter the $value?
		
		
		// Note: This function can be removed if not used
		return $value;
	}
	
	
	/*
	*  load_field()
	*
	*  This filter is applied to the $field after it is loaded from the database
	*
	*  @type	filter
	*  @since	3.6
	*  @date	23/01/13
	*
	*  @param	$field - the field array holding all the field options
	*
	*  @return	$field - the field array holding all the field options
	*/
	
	function load_field( $field )
	{
		// Note: This function can be removed if not used
		return $field;
	}
	
	
	/*
	*  update_field()
	*
	*  This filter is applied to the $field before it is saved to the database
	*
	*  @type	filter
	*  @since	3.6
	*  @date	23/01/13
	*
	*  @param	$field - the field array holding all the field options
	*  @param	$post_id - the field group ID (post_type = acf)
	*
	*  @return	$field - the modified field
	*/

	function update_field( $field, $post_id )
	{
		// Note: This function can be removed if not used
		return $field;
	}
	
}

// create field
new acf_field_accordion();

?>