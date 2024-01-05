<?php

//Exit if accessed directly
if(!defined('ABSPATH')){

	exit();

}

/**
 * 
 * --------------------
 * tableForDiviModule
 * --------------------
 * 
 * */


class TFDT_Module extends ET_Builder_Module {


	//data members
	public $slug       = 'tfdt_module';

	public $vb_support = 'on';

	public $child_slug = 'tfdt_module_row';
	

	//initialize
	public function init() {

		$this->name 	= esc_html__( 'Divi Table', 'table-for-divi' );

		$this->icon		= '5';

	}


	//set fields
	public function get_fields() {

		return array();

	}


	//advanced fields
	function get_advanced_fields_config() {

		$advanced_fields = array(

			'background'				=> false,

			'margin_padding'  	=> array(

				'css' => array(

					'important' => 'all',

				),
				
			),

			'link_options'			=> false,

			'borders'						=> false,

			'box_shadow'				=> false,

			'button'						=> false,

			'filters'						=> false,

			'fonts'							=> false,

			'animation'					=> false,

			'text'							=> false,

			'transform'					=> false,

		);

		return $advanced_fields;

	}


	//render html
	public function render( $unprocessed_props, $content, $render_slug ) {
		
		// Render module content
		return sprintf(

			'<div class="table-for-divi">

				<table>

					<tbody>%1$s</tbody>

				</table>

			</div>',

			et_sanitized_previously( $this->content )
			
		);

	}

}

new TFDT_Module;