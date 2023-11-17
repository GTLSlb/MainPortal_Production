<?php
/**
 * Admin Class
 *
 * Handles the Admin side functionality of plugin
 *
 * @package WP Team Showcase and Slider
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class Tsas_Admin {

	function __construct() {

		// Action to add admin menu
		add_action( 'admin_menu', array($this, 'tsas_register_menu'), 12 );

		// Admin init process
		add_action( 'admin_init', array($this, 'tsas_admin_init_process') );

		// Add Filter custom Post column
		add_filter( 'manage_edit-team_showcase_post_columns', array( $this, 'wp_tsas_register_custom_column_headings' ) );
		add_action( 'manage_posts_custom_column', array( $this, 'wp_tsas_register_custom_columns' ) );
	
		// Manage Category Shortcode Columns
		add_filter("manage_tsas-category_custom_column", array( $this, 'tsas_category_columns' ), 10, 3);
		add_filter("manage_edit-tsas-category_columns", array( $this, 'tsas_category_manage_columns') );

		// Action to register admin menu
		add_action( 'admin_menu', array( $this, 'wp_tsas_meta_box_setup' ) );

		// Action to save metabox
		add_action( 'save_post', array( $this, 'wp_tsas_meta_box_save' ) );

		// Add Action for social meta box
		add_action( 'admin_menu', array( $this, 'wp_tsas_meta_box_setup_social' ) );

		// Action to save metabox
		add_action( 'save_post', array( $this, 'wp_tsas_meta_box_social_save' ) );

		// Action to add metabox
		add_action( 'add_meta_boxes', array( $this, 'wp_tsas_post_sett_metabox'), 10, 2 );

		// Action to add little JS code in admin footer
		add_action( 'admin_footer', array($this, 'wp_tsas_upgrade_page_link_blank') );
	}

	/**
	 * Function to add menu
	 * 
	 * @package  WP Team Showcase and Slider
	 * @since 1.0.0
	 */
	function tsas_register_menu() {

		// How it work page
		add_submenu_page( 'edit.php?post_type='.WP_TSAS_POST_TYPE, __('How it works, our plugins and offers', 'wp-team-showcase-and-slider'), __('How It Works', 'wp-team-showcase-and-slider'), 'manage_options', 'tsas-designs', array($this, 'tsas_designs_page') );

		// Register plugin premium page
		//add_submenu_page( 'edit.php?post_type='.WP_TSAS_POST_TYPE, __('Join $0 Pro Trail -  WP Team Showcase and Slider', 'wp-team-showcase-and-slider'), '<span style="color:#ff2700">'.__('Join $0 Pro Trail', 'wp-team-showcase-and-slider').'</span>', 'manage_options', 'tsas-premium', array($this, 'tsas_premium_page') );
		add_submenu_page( 'edit.php?post_type='.WP_TSAS_POST_TYPE, __('Upgrade To PRO - Team Showcase and Slider', 'wp-team-showcase-and-slider'), '<span class="wpos-upgrade-pro" style="color:#ff2700">' . __('Upgrade To Premium ', 'wp-team-showcase-and-slider') . '</span>', 'manage_options', 'tsas-upgrade-pro', array($this, 'wp_tsas_redirect_page') );
		add_submenu_page( 'edit.php?post_type='.WP_TSAS_POST_TYPE, __('Bundle Deal - Team Showcase and Slider', 'wp-team-showcase-and-slider'), '<span class="wpos-upgrade-pro" style="color:#ff2700">' . __('Bundle Deal', 'wp-team-showcase-and-slider') . '</span>', 'manage_options', 'tsas-bundle-deal', array($this, 'wp_tsas_redirect_page') );
	}

	/**
	 * Premium Page Html
	 * 
	 * @package  WP Team Showcase and Slider
	 * @since 1.0.0
	 */
	// function tsas_premium_page() {
	// 	include_once( WP_TSAS_DIR . '/includes/admin/settings/trail-premium.php' );
	// }

	/**
	 * How It Work Page Html
	 * 
	 * @since 1.0
	 */
	function wp_tsas_redirect_page() {
	}

	/**
	 * Getting Started Page Html
	 * 
	 * @package  WP Team Showcase and Slider
	 * @since 1.0.0
	 */
	function tsas_designs_page() {
		include_once( WP_TSAS_DIR . '/includes/admin/wp-tsas-how-it-work.php' );
	}

	/**
	 * Function to notification transient
	 * 
	 * @package WP Team Showcase and Slider
	 * @since 1.5.2
	 */
	function tsas_admin_init_process() {

		global $typenow, $pagenow;

		$current_page = isset( $_REQUEST['page'] ) ? $_REQUEST['page'] : '';

		// If plugin notice is dismissed
	    if( isset($_GET['message']) && $_GET['message'] == 'tsas-plugin-notice' ) {
	    	set_transient( 'tsas_install_notice', true, 604800 );
	    }

	    // Redirect to external page for upgrade to menu
	    if( $typenow == WP_TSAS_POST_TYPE ) {

	    	if( $current_page == 'tsas-upgrade-pro' ) {

	    		wp_redirect( WP_TSAS_PLUGIN_LINK_UPGRADE );
	    		exit;
	    	}

	    	if( $current_page == 'tsas-bundle-deal' ) {

	    		wp_redirect( WP_TSAS_PLUGIN_BUNDLE_LINK );
	    		exit;
	    	}
	    }
	}

	/**
	 * Add Function Display post column name
	 * 
	 * @package WP Team Showcase and Slider
	 * @since 2.3
	 */
	function wp_tsas_register_custom_columns ( $column_name ) {
		global $wpdb, $post;

		switch ( $column_name ) {

			case 'image_team':
				$value = '';

				$value = wp_tsas_get_image( get_the_ID(), 40 ,'square');

				echo $value;
			break;

			default:
			break;

		}
	}

	/**
	 * Add Function Display post column Headings
	 * 
	 * @package WP Team Showcase and Slider
	 * @since 2.3
	 */
	function wp_tsas_register_custom_column_headings ( $defaults ) {
		$new_columns = array( 'image_team' => __( 'Image', 'wp-team-showcase-and-slider' ) );

		$last_item = '';

		if ( isset( $defaults['date'] ) ) { unset( $defaults['date'] ); }

		if ( count( $defaults ) > 2 ) {
			$last_item = array_slice( $defaults, -1 );

			array_pop( $defaults );
		}
		$defaults = array_merge( $defaults, $new_columns );

		if ( $last_item != '' ) {
			foreach ( $last_item as $k => $v ) {
				$defaults[$k] = $v;
				break;
			}
		}

		return $defaults;
	}

	/**
	 * Add Function Display post category columns name
	 * 
	 * @package WP Team Showcase and Slider
	 * @since 2.3
	 */
	function tsas_category_manage_columns($theme_columns) {
	    $new_columns = array(
	            'cb' => '<input type="checkbox" />',
	            'name' => __('Name'),
	            'teamshocase_shortcode' => __( 'Team Showcase Category Shortcode', 'wp-team-showcase-and-slider' ),
	            'slug' => __('Slug'),
	            'posts' => __('Posts')
				);
	    return $new_columns;
	}

	/**
	 * Add Function Display post category columns
	 * 
	 * @package WP Team Showcase and Slider
	 * @since 2.3
	 */
	function tsas_category_columns($out, $column_name, $theme_id) {
	    $theme = get_term($theme_id, 'tsas_category');
	    switch ($column_name) {

	        case 'title':
	            echo get_the_title();
	        break;
	        case 'teamshocase_shortcode':
			echo '[wp-team category="' . $theme_id. '"]<br />';
			echo '[wp-team-slider category="' . $theme_id. '"]';
	        break;

	        default:
	            break;
	    }
	    return $out;
	}

	/**
	 * Add meta box Action
	 * 
	 * @package WP Team Showcase and Slider
	 * @since 2.3
	 */
	function wp_tsas_meta_box_setup () {

		// Team Details
		add_meta_box( 'team-details', __( 'Team Details', 'wp-team-showcase-and-slider' ), array($this, 'wp_tsas_meta_box_content'), 'team_showcase_post', 'normal', 'high' );
	}

	/**
	 * Add meta box content
	 * 
	 * @package WP Team Showcase and Slider
	 * @since 2.3
	 */
	function wp_tsas_meta_box_content () {

		global $post_id;
		$fields = get_post_custom( $post_id );
		$field_data = tsas_get_custom_fields_settings();

		$html = '';
		$html .= wp_nonce_field( 'wp_tsas_meta_box_save', 'wp_tsas_noonce' );
		if ( 0 < count( $field_data ) ) {
			$html .= '<table class="form-table">' . "\n";
			$html .= '<tbody>' . "\n";

			foreach ( $field_data as $k => $v ) {
				$data = $v['default'];
				if ( isset( $fields['_' . $k] ) && isset( $fields['_' . $k][0] ) ) {
					$data = $fields['_' . $k][0];

				}

				$html .= '<tr valign="top"><th scope="row"><label for="' . esc_attr( $k ) . '">' . $v['name'] . '</label></th><td><input name="' . esc_attr( $k ) . '" type="text" id="' . esc_attr( $k ) . '" class="regular-text" value="' . esc_attr( $data ) . '" />' . "</br>";
				$html .= '<span class="description">' . $v['description'] . '</span>' . "\n";
				$html .= '</td><tr/>' . "\n";
			}

			$html .= '</tbody>' . "\n";
			$html .= '</table>' . "\n";
		}

		echo $html;
	}

	/**
	 * Add meta box save function
	 * 
	 * @package WP Team Showcase and Slider
	 * @since 2.3
	 */
	function wp_tsas_meta_box_save ( $post_id ) {

		global $post, $messages;
		// Verify
		if ( ( get_post_type( $post_id) != 'team_showcase_post' ) ) {
			return $post_id;
		}
		if ( ! isset( $_POST['wp_tsas_noonce'] ) ) {
			return $post_id;
		}
		if ( ! wp_verify_nonce( $_POST['wp_tsas_noonce'], 'wp_tsas_meta_box_save' ) ) {
			return $post_id;
		}
		if ( 'page' == $_POST['post_type'] ) {
			if ( ! current_user_can( 'edit_page', $post_id ) ) {
				return $post_id;
			}
		} else {
			if ( ! current_user_can( 'edit_post', $post_id ) ) {
				return $post_id;
			}
		}

		$field_data = tsas_get_custom_fields_settings();
		$fields = array_keys( $field_data );

		foreach ( $fields as $f ) {

			${$f} = strip_tags(trim($_POST[$f]));

			if ( 'url' == $field_data[$f]['type'] ) {
				${$f} = esc_url( ${$f} );
			}

			if ( get_post_meta( $post_id, '_' . $f ) == '' ) {
				add_post_meta( $post_id, '_' . $f, ${$f}, true );
			} elseif( ${$f} != get_post_meta( $post_id, '_' . $f, true ) ) {
				update_post_meta( $post_id, '_' . $f, ${$f} );
			} elseif ( ${$f} == '' ) {
				delete_post_meta( $post_id, '_' . $f, get_post_meta( $post_id, '_' . $f, true ) );
			}
		}
	}

	/**
	 * Add meta box for social details
	 * 
	 * @package WP Team Showcase and Slider Pro
	 * @since 2.3
	 */
	function wp_tsas_meta_box_setup_social () {
		add_meta_box( 'team-details-social', __( 'Social Details', 'wp-team-showcase-and-slider' ), array($this, 'wp_tsas_meta_box_content_social' ), 'team_showcase_post', 'normal', 'high' );
	}

	/**
	 * Add meta box for social content
	 * 
	 * @package WP Team Showcase and Slider
	 * @since 2.3
	 */
	function wp_tsas_meta_box_content_social () {

		global $post_id;
		$fields = get_post_custom( $post_id );
		$field_data = get_custom_fields_settings_social();

		$html = '';
		$html .= wp_nonce_field( 'wp_tsas_meta_box_social_save', 'wp_tsas_social_noonce' );
		if ( 0 < count( $field_data ) ) {
			$html .= '<table class="form-table">' . "\n";
			$html .= '<tbody>' . "\n";

			foreach ( $field_data as $k => $v ) {
				$data = $v['default'];
				if ( isset( $fields['_' . $k] ) && isset( $fields['_' . $k][0] ) ) {
					$data = $fields['_' . $k][0];
				}

				$html .= '<tr valign="top"><th scope="row"><label for="' . esc_attr( $k ) . '">' . $v['name'] . '</label></th><td><input name="' . esc_attr( $k ) . '" type="URL" id="' . esc_attr( $k ) . '" class="regular-text" value="' . esc_attr( $data ) . '" />' . "</br>";
				$html .= '<span class="description">' . $v['description'] . '</span>' . "\n";
				$html .= '</td><tr/>' . "\n";
			}

			$disable_field_data = get_custom_fields_settings_disable_social();

			foreach ( $disable_field_data as $k => $v ) {
				$html .= '<tr class="tsas-pro-feature"><th scope="row">' . $v['name'] . '<span class="tsas-pro-tag">PRO</span></th><td><input name="' . esc_attr( $k ) . '" type="URL" class="regular-text" value="" disabled="" />' . "<br/>";
				$html .= '<span class="description">' . $v['desc'] . '</span>'.' <strong>'. sprintf( __( 'Utilize this <a href="%s" target="_blank">Premium Features</a> to get best of this plugin.', 'wp-team-showcase-and-slider'), WP_TSAS_PLUGIN_LINK_UNLOCK).'</strong>';
				$html .= '</td><tr/>' . "\n";
			}

			$html .= '</tbody>' . "\n";
			$html .= '</table>' . "\n";
		}

		echo $html;
	}

	/**
	 * meta box for social content save function
	 * 
	 * @package WP Team Showcase and Slider Pro
	 * @since 2.3
	 */
	function wp_tsas_meta_box_social_save ( $post_id ) {
		global $post, $messages;
		// Verify
		if ( ( get_post_type( $post_id) != 'team_showcase_post' ) ) {
			return $post_id;
		}
		if ( ! isset( $_POST['wp_tsas_social_noonce'] ) ) {
			return $post_id;
		}
		if ( ! wp_verify_nonce( $_POST['wp_tsas_social_noonce'], 'wp_tsas_meta_box_social_save' ) ) {
			return $post_id;
		}
		if ( 'page' == $_POST['post_type'] ) {
			if ( ! current_user_can( 'edit_page', $post_id ) ) {
				return $post_id;
			}
		} else {
			if ( ! current_user_can( 'edit_post', $post_id ) ) {
				return $post_id;
			}
		}

		$field_data = get_custom_fields_settings_social();
		$fields = array_keys( $field_data );

		foreach ( $fields as $f ) {

			${$f} = strip_tags(trim($_POST[$f]));
			
			if ( 'url' == $field_data[$f]['type'] ) {

				${$f} = esc_url( ${$f} );
			}

			if ( get_post_meta( $post_id, '_' . $f ) == '' ) {
				

				add_post_meta( $post_id, '_' . $f, ${$f}, true );
			} elseif( ${$f} != get_post_meta( $post_id, '_' . $f, true ) ) {
				update_post_meta( $post_id, '_' . $f, ${$f} );
			} elseif ( ${$f} == '' ) {
				delete_post_meta( $post_id, '_' . $f, get_post_meta( $post_id, '_' . $f, true ) );
			}
		}
	}

	/**
	 * Post Settings Metabox
	 * 
	 * @package WP Team Showcase and Slider
	 * @since 1.4.1
	 */
	function wp_tsas_post_sett_metabox( $post_type, $post ) {
		add_meta_box( 'tsas-post-metabox-pro', __('More Premium - Settings', 'wp-team-showcase-and-slider'), array($this, 'tsas_post_sett_box_callback_pro'), WP_TSAS_POST_TYPE, 'normal', 'high' );
	}

	/**
	 * Function to handle 'premium ' metabox HTML
	 * 
	 * @package WP Team Showcase and Slider
	 * @since 1.4.1
	 */
	function tsas_post_sett_box_callback_pro( $post ) {		
		include_once( WP_TSAS_DIR .'/includes/admin/metabox/tsas-post-setting-metabox-pro.php');
	}

	/**
	 * Add JS snippet to admin footer to add target _blank in upgrade link
	 * 
	 * @package WP Team Showcase and Slider
	 * @since 1.0.0
	 */
	function wp_tsas_upgrade_page_link_blank() {

		global $wpos_upgrade_link_snippet;

		// Redirect to external page
		if( empty( $wpos_upgrade_link_snippet ) ) {

			$wpos_upgrade_link_snippet = 1;
	?>
		<script type="text/javascript">
			(function ($) {
				$('.wpos-upgrade-pro').parent().attr( { target: '_blank', rel: 'noopener noreferrer' } );
			})(jQuery);
		</script>
	<?php }
	}
}

$tsas_Admin = new Tsas_Admin();