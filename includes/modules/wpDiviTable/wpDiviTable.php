<?php

/**
 * 
 * --------------------
 * WP Divi Table Module
 * --------------------
 * 
 * */


class WP_Divi_Table extends ET_Builder_Module {


	//data members
	public $slug       = 'wp_divi_table';

	public $vb_support = 'on';

	public $child_slug = 'wp_divi_table_row';

	public $text_domain = 'wp-divi-table';


	//initialize
	public function init() {

		$this->name 	= esc_html__( 'Divi Table', $this->domain_text );

		$this->icon		= '5';

	}


	//set fields
	public function get_fields() {

		return array();

	}


	//advanced fields
	function get_advanced_fields_config() {

		$advanced_fields = array(

			'background'			=> false,

			'margin_padding'  => array(

				'css' => array(

					'important' => 'all',

				),
				
			),

		);

		return $advanced_fields;

	}


	//render html
	public function render( $unprocessed_props, $content, $render_slug ) {
		
		// Render module content
		return sprintf(

			'<div class="wp-divi-table">

				<table>

					<tbody>%1$s</tbody>

				</table>

			</div>',

			et_sanitized_previously( $this->content )
			
		);

	}

}

new WP_Divi_Table;