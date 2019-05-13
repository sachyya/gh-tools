<?php
/**
 * Quick links.
 *
 * @package gh
 */

if ( ! function_exists( 'gh_quick_links_add_toolbar_items' ) ) :

	/**
	 * Add menu item in admin bar.
	 *
	 * @since 1.0.0
	 *
	 * @param WP_Admin_Bar $admin_bar WP_Admin_Bar object.
	 */
	function gh_quick_links_add_toolbar_items( $admin_bar ) {

		if ( ! is_admin() || ! current_user_can( 'manage_options' ) ) {
			return;
		}

		// Theme switcher.
		$current_theme = wp_get_theme();
		$all_themes    = wp_get_themes();

		$admin_bar->add_menu( array(
			'id'    => 'gh-theme-switcher',
			'title' => $current_theme->get( 'Name' ),
			'href'  => admin_url( 'themes.php?theme=' . get_stylesheet() ),
		));

		$redirect_to = $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'] ;

		if ( ! empty( $all_themes ) ) {

			foreach ( $all_themes as $key => $theme ) {

				// Add menu items.
				$admin_bar->add_menu( array(
					'id'     => 'gh-theme-switcher-' . $key,
					'parent' => 'gh-theme-switcher',
					'title'  => $theme->get( 'Name' ),
					'href'   => add_query_arg( array(
						'ghts-switch' => $key,
						'ghts-go'     => esc_url( $redirect_to ),
					), admin_url() ),
				));

			} // End foreach.

		} // End if.

	}

endif;

add_action( 'admin_bar_menu', 'gh_quick_links_add_toolbar_items', 110 );

if ( ! function_exists( 'gh_quick_links_switch_theme' ) ) :

	/**
	 * Switch theme.
	 *
	 * @since 1.0.0
	 */
	function gh_quick_links_switch_theme() {

		if ( isset( $_GET['ghts-switch'] ) && ! empty( $_GET['ghts-switch'] ) ) {
			$theme = wp_get_theme( $_GET['ghts-switch'] );
			$go_url = admin_url( 'themes.php?activated=true' );
			if ( isset( $_REQUEST['ghts-go'] ) && ! empty( $_REQUEST['ghts-go'] ) ) {
				$go_url = $_REQUEST['ghts-go'];
			}
			if ( false === $theme->errors() ) {
				switch_theme( $theme->get_stylesheet() );
				wp_redirect( $go_url );
				exit;
			}
		}

	}

endif;

add_action( 'init', 'gh_quick_links_switch_theme' );

if ( ! function_exists( 'gh_quick_links_add_custom_styling' ) ) :

	/**
	 * Custom CSS.
	 *
	 * @since 1.0.0
	 */
	function gh_quick_links_add_custom_styling() {
		?>
	    <style>
	        #wp-admin-bar-gh-theme-switcher ul {
	            height: 100%;
	            max-height: 500px;
	        }
	        #wp-admin-bar-gh-theme-switcher ul {
	            overflow: hidden;
	            overflow-y: auto;
	        }
	    </style>
	    <?php
	}

endif;

add_action( 'admin_head', 'gh_quick_links_add_custom_styling' );
