<?php

if ( ! defined( 'ABSPATH' ) ) {
  exit;
}

class TFDT_Initialize {

  /**
   * Extension version.
   *
   * @var string
   */
  public $version = '2.0.0';

  /**
   * Constructor to initialize hooks.
   */
  public function __construct() {

    // Admin notices and AJAX for review notification
    add_action( 'admin_notices', [ $this, 'tfdt_add_review_notification' ] );
    add_action( 'wp_ajax_tfdt_dismiss_review_notification', [ $this, 'tfdt_dismiss_review_notification' ] );

    // Admin notice for migration reminder
    add_action( 'admin_notices', [ $this, 'tfdt_add_migration_notice' ] );

    // Admin Menu & Migration actions
    add_action( 'admin_menu', [ $this, 'tfdt_register_admin_menu' ] );
    add_action( 'admin_post_tfdt_run_migration', [ $this, 'tfdt_handle_migration' ] );
  }

  /**
   * Add review notification in WordPress Admin.
   */
  public function tfdt_add_review_notification() {
    if ( current_user_can( 'administrator' ) && is_plugin_active( 'table-for-divi/table-for-divi.php' ) ) {
      $notification_status = get_option( 'tfdt_review_notification_status', '' );

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
                  var ajax_url = "<?php echo esc_url( admin_url( 'admin-ajax.php' ) ); ?>";
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
   * AJAX action to dismiss review notification.
   */
  public function tfdt_dismiss_review_notification() {
    update_option( 'tfdt_review_notification_status', 'dismissed' );
    wp_die();
  }

  /**
   * Add dashboard notice if migration has not been run yet.
   */
  public function tfdt_add_migration_notice() {
    if ( current_user_can( 'manage_options' ) && is_plugin_active( 'table-for-divi/table-for-divi.php' ) ) {
      $migration_status = get_option( 'tfdt_migration_completed', 'no' );

      if ( 'yes' !== $migration_status ) {
        // Skip showing the banner if user is already on the migration page to avoid redundancy
        $current_screen = function_exists( 'get_current_screen' ) ? get_current_screen() : null;
        if ( $current_screen && 'toplevel_page_tfdt-migration' === $current_screen->id ) {
          return;
        }
        ?>
        <div class="notice notice-warning" style="border-left-color: #f59e0b;">
          <p><strong>Table for Divi:</strong> You have legacy table modules that need to be updated to the Divi 5 architecture.</p>
          <p>
            <a href="<?php echo esc_url( admin_url( 'admin.php?page=tfdt-migration' ) ); ?>" class="button button-primary">Go to Migration Page</a>
          </p>
        </div>
        <?php
      }
    }
  }

  /**
   * Register the Table for Divi admin menu page with a table icon.
   */
  public function tfdt_register_admin_menu() {
    add_menu_page(
      'Table for Divi Migration',
      'Table for Divi',
      'manage_options',
      'tfdt-migration',
      [ $this, 'tfdt_render_admin_page' ],
      'dashicons-editor-table',
      58
    );
  }

  /**
   * Render the admin migration dashboard page.
   */
  public function tfdt_render_admin_page() {
    if ( ! current_user_can( 'manage_options' ) ) {
      return;
    }

    $migration_status = get_option( 'tfdt_migration_completed', 'no' );
    $migrated = ( 'yes' === $migration_status );
    ?>
    <div class="wrap">
      <h1>Table for Divi Migration</h1>

      <!-- Main Card Container -->
      <div style="background: #ffffff; border: 1px solid #eaeaea; border-radius: 12px; padding: 35px; margin-top: 20px; box-shadow: 0 4px 20px rgba(0,0,0,0.05);">
        
        <h2 style="margin-top: 0; font-size: 18px; font-weight: 600; color: #1d2327; border-bottom: 1px solid #f0f0f1; padding-bottom: 15px;">Migration Status</h2>
        
        <?php if ( $migrated ) : ?>
          <div style="display: flex; align-items: center; gap: 12px; background: #edfaf1; border: 1px solid #c8e6c9; padding: 20px; border-radius: 8px; margin-top: 20px;">
            <span style="font-size: 24px;">🎉</span>
            <div>
              <p style="margin: 0 0 4px 0; font-size: 16px; font-weight: 600; color: #2e7d32;">Migration Complete</p>
              <p style="margin: 0; color: #555555; font-size: 13px;">All legacy table modules are fully updated to the Divi 5 architecture.</p>
            </div>
          </div>
        <?php else : ?>
          <div style="display: flex; align-items: center; gap: 12px; background: #fff8e1; border: 1px solid #ffe082; padding: 20px; border-radius: 8px; margin: 20px 0;">
            <span style="font-size: 24px;">⚠️</span>
            <div>
              <p style="margin: 0 0 4px 0; font-size: 15px; font-weight: 600; color: #8a6d3b;">Action Required: Backup Recommended</p>
              <p style="margin: 0; color: #555555; font-size: 13px; line-height: 1.5;">Before running the migration, please create a complete <strong>backup of your database and website files</strong>. Having a backup ensures you can easily restore your data if any unforeseen issues occur.</p>
            </div>
          </div>

          <form method="POST" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>" style="margin-top: 25px;">
            <input type="hidden" name="action" value="tfdt_run_migration">
            <?php wp_nonce_field( 'tfdt_migration_nonce_action', 'tfdt_migration_nonce' ); ?>
            
            <button type="submit" class="button" style="background: linear-gradient(135deg, #326BFF 0%, #1959FF 100%); color: #ffffff; border: none; border-radius: 8px; padding: 12px 28px; font-size: 15px; font-weight: 600; height: auto; cursor: pointer; box-shadow: 0 4px 12px rgba(25,89,255,0.25); transition: opacity 0.2s;" onclick="return confirm('Are you sure you have taken a backup and want to proceed with the migration?');">
              Migrate All Tables to Divi 5
            </button>
          </form>
        <?php endif; ?>

      </div>
    </div>
    <?php
  }

  /**
   * Handle the form submission to run migration.
   */
  public function tfdt_handle_migration() {
    if ( ! current_user_can( 'manage_options' ) ) {
      wp_die( 'Unauthorized user.' );
    }

    // Verify nonce
    if ( ! isset( $_POST['tfdt_migration_nonce'] ) || ! wp_verify_nonce( $_POST['tfdt_migration_nonce'], 'tfdt_migration_nonce_action' ) ) {
      wp_die( 'Security check failed.' );
    }

    global $wpdb;

    // Find all posts/pages containing tfdt_module references
    // phpcs:ignore WordPress.DB.DirectDatabaseQuery.DirectQuery, WordPress.DB.DirectDatabaseQuery.NoCaching
    $posts = $wpdb->get_results(
      "SELECT ID, post_content FROM {$wpdb->posts} WHERE post_content LIKE '%tfdt_module%'"
    );

    if ( ! empty( $posts ) ) {
      foreach ( $posts as $post ) {
        $content = $post->post_content;

        // Pattern 1: Match Divi shortcode block wrapper and decode its JSON attributes safely to automatically strip out escaped unicode characters like \u0022
        $content = preg_replace_callback( '/(<!-- wp:divi\/shortcode-module\s+({.*?})\s*-->)(.*?)(<!-- \/wp:divi\/shortcode-module -->)/s', function( $matches ) {
          $json_str = $matches[2];
          $block_data = json_decode( $json_str, true );

          if ( json_last_error() === JSON_ERROR_NONE && isset( $block_data['shortcodeName'] ) && 'tfdt_module' === $block_data['shortcodeName'] && isset( $block_data['innerHTML'] ) ) {
            // innerHTML is now fully unescaped (real quotes, real ampersands, etc.)
            $raw_shortcode = $block_data['innerHTML'];
            return $this->tfdt_convert_shortcode_to_blocks( $raw_shortcode );
          }

          return $matches[0];
        }, $content );

        // Pattern 2: Match any remaining raw shortcodes outside of block wrappers
        $raw_pattern = '/\[tfdt_module([^\]]*)\](.*?)\[\/tfdt_module\]/s';

        $content = preg_replace_callback( $raw_pattern, function( $matches ) {
          $full_shortcode = $matches[0];
          return $this->tfdt_convert_shortcode_to_blocks( $full_shortcode );
        }, $content );

        // Update post content in database if changes were made
        if ( $content !== $post->post_content ) {

          // phpcs:ignore WordPress.DB.DirectDatabaseQuery.DirectQuery, WordPress.DB.DirectDatabaseQuery.NoCaching
          $wpdb->update(
            $wpdb->posts,
            [ 'post_content' => $content ],
            [ 'ID' => $post->ID ],
            [ '%s' ],
            [ '%d' ]
          );
          
        }
      }
    }

    // Mark migration as completed in wp_options
    update_option( 'tfdt_migration_completed', 'yes' );

    // Redirect back to the admin page
    wp_safe_redirect( admin_url( 'admin.php?page=tfdt-migration' ) );
    exit;
  }

  /**
   * Helper function to convert a single [tfdt_module] shortcode string into Divi 5 block markup.
   */
  private function tfdt_convert_shortcode_to_blocks( $shortcode_string ) {
    // Match [tfdt_module ...](inner rows)[/tfdt_module]
    if ( ! preg_match( '/\[tfdt_module([^\]]*)\](.*?)\[\/tfdt_module\]/s', $shortcode_string, $matches ) ) {
      return $shortcode_string;
    }

    $inner_content = $matches[2];

    // Parse inner rows: [tfdt_module_row ...]
    $row_pattern = '/\[tfdt_module_row([^\]]*)\]/s';
    $rows_html = '';

    preg_match_all( $row_pattern, $inner_content, $row_matches );

    if ( ! empty( $row_matches[1] ) ) {
      foreach ( $row_matches[1] as $row_attr_str ) {
        $atts = shortcode_parse_atts( $row_attr_str );
        if ( empty( $atts ) ) {
          continue;
        }

        $cells_html = '';

        // Loop through up to 20 columns dynamically
        for ( $i = 1; $i <= 20; $i++ ) {
          $text_key       = "text{$i}";
          $tag_key        = "tag{$i}";
          $text_align_key = "text_align{$i}";
          $rowspan_key    = "rowspan{$i}";
          $colspan_key    = "colspan{$i}";
          $width_key      = "width{$i}";
          $css_class_key  = "css_class{$i}";

          // Check if this column has text defined
          if ( isset( $atts[ $text_key ] ) && '' !== trim( $atts[ $text_key ] ) ) {
            $cell_json = [
              'title'          => [ 'innerContent' => [ 'desktop' => [ 'value' => $atts[ $text_key ] ] ] ],
              'builderVersion' => '5.2.1',
            ];

            // Optional attributes mapping
            if ( isset( $atts[ $tag_key ] ) && '' !== trim( $atts[ $tag_key ] ) ) {
              $cell_json['tagField'] = [ 'innerContent' => [ 'desktop' => [ 'value' => $atts[ $tag_key ] ] ] ];
            }

            if ( isset( $atts[ $text_align_key ] ) && '' !== trim( $atts[ $text_align_key ] ) ) {
              $cell_json['textAlign'] = [ 'innerContent' => [ 'desktop' => [ 'value' => $atts[ $text_align_key ] ] ] ];
            }

            if ( isset( $atts[ $rowspan_key ] ) && '' !== trim( $atts[ $rowspan_key ] ) ) {
              $cell_json['rowspan'] = [ 'innerContent' => [ 'desktop' => [ 'value' => (string) $atts[ $rowspan_key ] ] ] ];
            }

            if ( isset( $atts[ $colspan_key ] ) && '' !== trim( $atts[ $colspan_key ] ) ) {
              $cell_json['colspan'] = [ 'innerContent' => [ 'desktop' => [ 'value' => (string) $atts[ $colspan_key ] ] ] ];
            }

            if ( isset( $atts[ $width_key ] ) && '' !== trim( $atts[ $width_key ] ) ) {
              $cell_json['width'] = [ 'innerContent' => [ 'desktop' => [ 'value' => $atts[ $width_key ] ] ] ];
            }

            if ( isset( $atts[ $css_class_key ] ) && '' !== trim( $atts[ $css_class_key ] ) ) {
              $cell_json['customCssClass'] = [ 'innerContent' => [ 'desktop' => [ 'value' => $atts[ $css_class_key ] ] ] ];
            }

            if ( ! empty( $cells_html ) ) {
              $cells_html .= "\r\n\r\n";
            }

            $cells_html .= sprintf(
              '<!-- wp:tfdt/table-cell %s /-->',
              wp_json_encode( $cell_json, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE )
            );
          }
        }

        // Build Row Block
        $row_json = [ 'builderVersion' => '5.2.1' ];
        $rows_html .= sprintf(
          "<!-- wp:tfdt/table-row %s -->\r\n%s\r\n<!-- /wp:tfdt/table-row -->\r\n",
          wp_json_encode( $row_json, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE ),
          $cells_html
        );
      }
    }

    // Build Module Block
    $module_json = [ 'builderVersion' => '5.2.1' ];
    $module_json['tableTheme'] = [ 'innerContent' => [ 'desktop' => [ 'value' => 'no-style' ] ] ];
    return sprintf(
      "<!-- wp:tfdt/table-module %s -->\r\n%s<!-- /wp:tfdt/table-module -->",
      wp_json_encode( $module_json, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE ),
      $rows_html
    );
  }

}

new TFDT_Initialize();