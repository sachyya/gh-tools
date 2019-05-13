<?php
/**
 * Transient cleaner.
 *
 * @package gh
 */

if ( ! function_exists( 'gh_transient_cleaner_add_toolbar_button' ) ) :

	/**
	 * Add menu item in admin bar.
	 *
	 * @since 1.0.0
	 *
	 * @param WP_Admin_Bar $admin_bar WP_Admin_Bar object.
	 */
	function gh_transient_cleaner_add_toolbar_button( $admin_bar ) {

		if ( ! is_admin() || ! current_user_can( 'manage_options' ) ) {
			return;
		}

		$menu_args = array(
		  'id'    => 'gh-clean-button',
		  'href'  => '#',
		);

		$menu_args['title']         = __( 'Clean', 'gh' );
		$menu_args['meta']['class'] = '';

		$admin_bar->add_menu( $menu_args );

	}

endif;

add_action( 'admin_bar_menu', 'gh_transient_cleaner_add_toolbar_button', 110 );

/**
 * Load scripts.
 *
 * @since 1.0
 */
function gh_transient_cleaner_wp_admin_scripts() {
	?>
	  <script>
	  jQuery(document).ready(function($){
	    $('body').on('click','#wp-admin-bar-gh-clean-button a',function(e){
	      e.preventDefault();
	      var $this = $(this);
	      jQuery.ajax({
	         type : "post",
	         dataType : "json",
	         url : ajaxurl,
	         data : {action: "gh_cleaner"},
	         success: function(response) {
	            if( 1 == response.status ) {
	                $this.html( response.new_message );
	            }
	         }
	      })
	    });
	  });
	  </script>
	<?php
}
add_action( 'admin_footer', 'gh_transient_cleaner_wp_admin_scripts' );


function gh_cleaner_callback() {
	$output = array();

	global $wpdb;

	$count = $wpdb->query(
		"DELETE FROM $wpdb->options
		WHERE option_name LIKE '\_transient\_%'
		OR option_name LIKE '\_site\_transient\_%'"
	);

	$output['status'] = 1;
	$output['new_message'] = __( 'Cleaned', 'gh' );
	wp_send_json( $output );

}

add_action( 'wp_ajax_gh_cleaner', 'gh_cleaner_callback' );
add_action( 'wp_ajax_nopriv_gh_cleaner', 'gh_cleaner_callback' );
