<?php
class WP_DiviTable extends DiviExtension {

	/**
	 * The gettext domain for the extension's translations.
	 *
	 * @since 1.0.0
	 *
	 * @var string
	 */
	public $gettext_domain = 'wp-divi-table';

	/**
	 * The extension's WP Plugin name.
	 *
	 * @since 1.0.0
	 *
	 * @var string
	 */
	public $name = 'wp-divi-table';

	/**
	 * The extension's version
	 *
	 * @since 1.0.0
	 *
	 * @var string
	 */
	public $version = '1.0.0';

	/**
	 * WP_Divi_Table constructor.
	 *
	 * @param string $name
	 * @param array  $args
	 */
	public function __construct( $name = 'wp-divi-table', $args = array() ) {

		$this->plugin_dir              = plugin_dir_path( __FILE__ );

		$this->plugin_dir_url          = plugin_dir_url( $this->plugin_dir );

		parent::__construct( $name, $args );
	}
}

new WP_DiviTable;
