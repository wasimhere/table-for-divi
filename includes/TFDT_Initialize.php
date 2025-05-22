<?php

//Exit if accessed directly
if(!defined('ABSPATH')){

	exit();

}

class TFDT_Initialize extends DiviExtension {

	/**
	 * The gettext domain for the extension's translations.
	 *
	 * @since 1.0.0
	 *
	 * @var string
	 */
	public $gettext_domain = 'table-for-divi';

	/**
	 * The extension's WP Plugin name.
	 *
	 * @since 1.0.0
	 *
	 * @var string
	 */
	public $name = 'table-for-divi';

	/**
	 * The extension's version
	 *
	 * @since 1.0.0
	 *
	 * @var string
	 */
	public $version = '1.0.0';

	/**
	 * TableForDivi constructor.
	 *
	 * @param string $name
	 * @param array  $args
	 */
	public function __construct( $name = 'table-for-divi', $args = array() ) {

		$this->plugin_dir              = plugin_dir_path( __FILE__ );

		$this->plugin_dir_url          = plugin_dir_url( $this->plugin_dir );

		parent::__construct( $name, $args );


		//add admin notice to show review notification
    add_action( 'admin_notices', [$this, 'tfdt_add_review_notification'] );

    //ajax action to dismiss review notification
    add_action( 'wp_ajax_tfdt_dismiss_review_notification', [$this, 'tfdt_dismiss_review_notification'] );

	}


	/**
   * 
   * add admin notice to show review notification
   * 
   * Add the review notification in WordPress Admin
   * 
   * */
  public function tfdt_add_review_notification() {

    // Check if the plugin is activated and the user is an admin
    if ( current_user_can( 'administrator' ) && is_plugin_active( 'table-for-divi/table-for-divi.php' ) ) {

      // Check if the user has already dismissed or reviewed the plugin
      $notification_status = get_option( 'tfdt_review_notification_status', '' );

      // Only show the notification if the user hasn't dismissed it or left a review
      if ( empty( $notification_status ) ) {
          
        ?>

          <div class="notice notice-info is-dismissible" id="tfdt-review-notification">
            
            <p><strong>Enjoying Table for Divi?</strong> We would love to hear your feedback! Please leave us a review on the WordPress plugin page.</p>
            
            <p>

              <a href="https://wordpress.org/plugins/table-for-divi/#reviews" target="_blank" class="button button-primary">Leave a Review</a>

              <button class="button button-secondary" id="tfdt-dismiss-review-notification" style="margin-left: 10px;">No Thanks</button>

            </p>

          </div>

          <script>
              document.getElementById('tfdt-dismiss-review-notification').addEventListener('click', function() {
                  var ajax_url = "<?php echo esc_url(admin_url('admin-ajax.php')); ?>";
                  var data = {
                      action: 'tfdt_dismiss_review_notification'
                  };

                  fetch(ajax_url, {
                      method: 'POST',
                      body: new URLSearchParams(data),
                  })
                  .then(response => response.text())
                  .then(response => {
                      document.getElementById('tfdt-review-notification').style.display = 'none';
                  });
              });
          </script>

        <?php

      }

    }

	}



	/**
   * 
   * ajax action to dismiss review notification
   * 
   * Function to handle the dismiss action
   * 
   * */
  public function tfdt_dismiss_review_notification() {
      
    update_option( 'tfdt_review_notification_status', 'dismissed' );

    wp_die(); // Terminate the request

  }

	
}

new TFDT_Initialize;
