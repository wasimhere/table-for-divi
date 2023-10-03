<?php
/**
 * 
 * --------------------
 * WP Divi Table Row
 * --------------------
 * 
 * */

class WP_Divi_Table_Row extends ET_Builder_Module {


	//data members
	public $slug      	= 'wp_divi_table_row';

	public $type 				= 'child';

	public $vb_support 	= 'on';

	public $text_domain = 'wp-divi-table';

	public $total_columns = 20;

	protected function _render_module_wrapper( $output = '', $render_slug = '' ) {
	    
    return $output;

	} 


	function init() {

		// Module name
		$this->name = esc_html__( 'Table Row', $this->text_domain );

		// Default label for module item. Basically if $this->child_title_var and $this->child_title_fallback_var
		// attributes are empty, this default text will be used instead as item label
		$this->advanced_setting_title_text = esc_html__( 'Table Row', 'et_builder' );

		// Module item's modal title
		$this->settings_text = esc_html__( 'Table Row Settings', 'et_builder' );


		$column_toggle_array = array();


		for($x = 1; $x <= $this->total_columns; $x++):

			$column_toggle_array['column' . $x] = esc_html__( 'Column ' . $x, $this->text_domain );

		endfor;


		$this->settings_modal_toggles  = array(

			// Content tab's slug is "general"
			'general'		=> array(

				'toggles' => $column_toggle_array,

			)

		);

	}


	/**
	 * Module's specific fields
	 *
	 * @since 1.0.0
	 *
	 * @return array
	 */
	function get_fields() {

		$field_array = array();


		for($x = 1; $x <= $this->total_columns; $x++):

			$field_array['text' . $x] = array(

				'label'           => esc_html__( 'Text', $this->text_domain ),

				'type'            => 'textarea',

				'toggle_slug'     => 'column' . $x,

			);

			$field_array['tag' . $x] = array(

				'label'           => esc_html__( 'Tag', $this->text_domain ),

				'type'            => 'select',

				'default'					=> 'td',

				'options'         => array(

					'td' => esc_html__( 'td', 'et_builder' ),

					'th'  => esc_html__( 'th', 'et_builder' ),

				),

				'toggle_slug'     => 'column' . $x,

			);

			$field_array['text_align' . $x] = array(

				'label'           => esc_html__( 'Text Align', $this->text_domain ),

				'type'            => 'select',

				'default'					=> '',

				'options'         => array(

					'' 				=> esc_html__( 'Select', 'et_builder' ),

					'left' 		=> esc_html__( 'Left', 'et_builder' ),

					'right'  	=> esc_html__( 'Right', 'et_builder' ),

					'center'  => esc_html__( 'Center', 'et_builder' ),

				),

				'toggle_slug'     => 'column' . $x,

			);

			$field_array['rowspan' . $x] = array(

				'label'           => esc_html__( 'Rowspan', $this->text_domain ),

				'type'            => 'range',

				'range_settings'	=> array(

					'min'		=> 1,

					'step'	=> 1,

				),

				'toggle_slug'     => 'column' . $x,

			);

			$field_array['colspan' . $x] = array(

				'label'           => esc_html__( 'Colspan', $this->text_domain ),

				'type'            => 'range',

				'range_settings'	=> array(

					'min'		=> 1,

					'step'	=> 1,

				),

				'toggle_slug'     => 'column' . $x,

			);

			$field_array['width' . $x] = array(

				'label'           => esc_html__( 'Width (with units)', $this->text_domain ),

				'type'            => 'text',

				'toggle_slug'     => 'column' . $x,

			);

		endfor;


		$field_array['classes'] = array(

			'label'				=> esc_html__( 'CSS Class', $this->text_domain ),

			'type'				=> 'text',

			'tab_slug' 		=> 'custom_css',

			'toggle_slug'	=> 'classes',

		);


		//return fields
		return $field_array;

	}


	//advanced fields
	function get_advanced_fields_config() {

		$advanced_fields = array(

			'background'				=> false,

			'margin_padding'  	=> false,

			'max_width'					=> false,

			'link_options'			=> false,

			'borders'						=> false,

			'box_shadow'				=> false,

			'button'						=> false,

			'filters'						=> false,

			'fonts'							=> false,

			'animation'					=> false,

			'transform'					=> false,

		);

		return $advanced_fields;

	}


	/**
	 * Render module output
	 *
	 * @since 1.0.0
	 *
	 * @param array  $attrs       List of unprocessed attributes
	 * @param string $content     Content being processed
	 * @param string $render_slug Slug of module that is used for rendering output
	 *
	 * @return string module's rendered output
	 */
	function render( $attrs, $content = null, $render_slug ) {

		$classes = (!empty($this->props['classes']) ? 'class="' . $this->props['classes'] . '"' : '');

		$output_string = '<tr ' . $classes . '>';

		for($x = 1; $x <= $this->total_columns; $x++):

			if(!empty(et_sanitized_previously( $this->props['text' . $x] ))):

				$output_string .= sprintf(

					'<%1$s %2$s %3$s %4$s %5$s>

							%6$s

						</%1$s>',

					esc_html( $this->props['tag' . $x] ),

					(!empty($this->props['colspan' . $x]) ? 'colspan="' . $this->props['colspan' . $x] . '"' : ''),

					(!empty($this->props['rowspan' . $x]) ? 'rowspan="' . $this->props['rowspan' . $x] . '"' : ''),

					(!empty($this->props['text_align' . $x]) ? 'align="' . $this->props['text_align' . $x] . '"' : ''),

					(!empty($this->props['width' . $x]) ? 'width="' . $this->props['width' . $x] . '"' : ''),

					et_sanitized_previously( $this->props['text' . $x] ),

				);

			endif;

		endfor;

		$output_string .= '</tr>';


		// Render module content
		return $output_string;

	}

}

new WP_Divi_Table_Row;
