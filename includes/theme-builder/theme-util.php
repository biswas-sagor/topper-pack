<?php
/**
 * Theme Builder Utilities (safe, non-recursive, backwards-compatible)
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
use TopperPack\Includes\Theme_Builder\TOPPPA_Theme_Builder;

/**
 * Internal helper: normalize template type to a safe string key
 *
 * @param mixed $template_type
 * @return string
 */
function _topppa_normalize_template_type( $template_type ) {
	$key = is_string( $template_type ) ? $template_type : (string) $template_type;
	$key = trim( $key );
	return $key;
}

/**
 * Utility function to check if a template type is enabled
 *
 * Backwards-compatible behavior:
 * - Same function name and signature.
 * - Same filter hook: "topppa_{$template_type}_enabled".
 * - Same Elementor availability check.
 * - Same truthiness: returns boolean.
 * - Adds recursion guard & robust cache reset.
 *
 * @param string $template_type The template type to check
 * @return bool
 */
function topppa_template_enabled( $template_type ) {
	// Static caches and re-entry guards (per template type)
	static $cache   = array();
	static $running = array();

	$template_type = _topppa_normalize_template_type( $template_type );

	// Special internal command to clear static cache (used by topppa_clear_template_util_cache)
	if ( '__reset__' === $template_type ) {
		$cache   = array();
		$running = array();
		return true;
	}

	// Serve from cache
	if ( array_key_exists( $template_type, $cache ) ) {
		return $cache[ $template_type ];
	}

	// Prevent infinite recursion / re-entrancy
	if ( isset( $running[ $template_type ] ) ) {
		// Conservative fallback: disabled while resolving to avoid loops
		return false;
	}
	$running[ $template_type ] = true;

	// Early return if Elementor is not available
	if ( ! class_exists( '\Elementor\Plugin' ) ) {
		$cache[ $template_type ] = false;
		unset( $running[ $template_type ] );
		return false;
	}

	// Get setting safely
	$template_id = TOPPPA_Theme_Builder::get_settings( $template_type, '' );
	$status      = ! empty( $template_id );

	/**
	 * Apply filters without allowing recursive bounce-back.
	 * If we're already running this exact filter, skip to raw status to avoid loops.
	 */
	$hook   = "topppa_{$template_type}_enabled";
	$result = ( function () use ( $hook, $status ) {
		// doing_filter() is true if the current filter is in the stack
		if ( function_exists( 'doing_filter' ) && doing_filter( $hook ) ) {
			return (bool) $status;
		}
		return (bool) apply_filters( $hook, (bool) $status );
	} )();

	$cache[ $template_type ] = (bool) $result;

	unset( $running[ $template_type ] );
	return $cache[ $template_type ];
}

/**
 * Utility function to get template ID
 *
 * Backwards-compatible behavior:
 * - Same function name and signature.
 * - Same filter hook: "get_topppa_{$template_type}_id".
 * - Same Elementor availability check.
 * - Returns int|false (never empty string).
 * - Adds recursion guard & robust cache reset.
 *
 * @param string $template_type The template type
 * @return int|false
 */
function topppa_get_template_id( $template_type ) {
	static $cache   = array();
	static $running = array();

	$template_type = _topppa_normalize_template_type( $template_type );

	// Special internal command to clear static cache (used by topppa_clear_template_util_cache)
	if ( '__reset__' === $template_type ) {
		$cache   = array();
		$running = array();
		return true;
	}

	// Serve from cache
	if ( array_key_exists( $template_type, $cache ) ) {
		return $cache[ $template_type ];
	}

	// Prevent infinite recursion / re-entrancy
	if ( isset( $running[ $template_type ] ) ) {
		return false;
	}
	$running[ $template_type ] = true;

	// Early return if Elementor is not available
	if ( ! class_exists( '\Elementor\Plugin' ) ) {
		$cache[ $template_type ] = false;
		unset( $running[ $template_type ] );
		return false;
	}

	$template_id = TOPPPA_Theme_Builder::get_settings( $template_type, '' );
	if ( '' === $template_id ) {
		$template_id = false;
	}

	$hook = "get_topppa_{$template_type}_id";

	$template_id = ( function () use ( $hook, $template_id ) {
		if ( function_exists( 'doing_filter' ) && doing_filter( $hook ) ) {
			return $template_id;
		}
		return apply_filters( $hook, $template_id );
	} )();

	// Normalize type (ensure int|false)
	if ( false !== $template_id ) {
		$template_id = (int) $template_id;
		if ( $template_id <= 0 ) {
			$template_id = false;
		}
	}

	$cache[ $template_type ] = $template_id;
	unset( $running[ $template_type ] );

	return $cache[ $template_type ];
}

/**
 * Clear static caches for template functions
 *
 * Reflection cannot unset a function's static vars reliably.
 * Instead, we message the functions themselves with the __reset__ command.
 */
function topppa_clear_template_util_cache() {
	// Clear both utility function caches
	topppa_template_enabled( '__reset__' );
	topppa_get_template_id( '__reset__' );
}

// Hook to clear cache when theme builder posts are saved or deleted
add_action( 'save_post', function( $post_id ) {
	if ( get_post_type( $post_id ) === 'topppa-theme-builder' ) {
		topppa_clear_template_util_cache();
	}
}, 10, 1 );

add_action( 'delete_post', function( $post_id ) {
	if ( get_post_type( $post_id ) === 'topppa-theme-builder' ) {
		topppa_clear_template_util_cache();
	}
}, 10, 1 );

/**
 * Convenience wrappers (unchanged API)
 */

function topppa_header_enabled() {
	return topppa_template_enabled( 'header' );
}

function topppa_footer_enabled() {
	return topppa_template_enabled( 'footer' );
}

function get_topppa_header_id() {
	return topppa_get_template_id( 'header' );
}

function get_topppa_footer_id() {
	return topppa_get_template_id( 'footer' );
}

function topppa_single_page_enabled() {
	return topppa_template_enabled( 'single-page' );
}

function get_topppa_single_page_id() {
	return topppa_get_template_id( 'single-page' );
}

function topppa_single_enabled() {
	return topppa_template_enabled( 'single-post' );
}

function get_topppa_single_post_id() {
	return topppa_get_template_id( 'single-post' );
}

function get_topppa_error_404_id() {
	return topppa_get_template_id( 'error-404' );
}

function topppa_archive_enabled() {
	return topppa_template_enabled( 'archive' );
}

function get_topppa_archive_id() {
	return topppa_get_template_id( 'archive' );
}

function get_topppa_single_product_id() {
	$single_product_id = false;

	if ( function_exists( 'is_product' ) && is_product() ) {
		$single_product_id = TOPPPA_Theme_Builder::get_settings( 'single-product', '' );
		if ( '' === $single_product_id ) {
			$single_product_id = false;
		}
	}

	return apply_filters( 'get_topppa_single_product_id', $single_product_id );
}

function get_topppa_product_archive_id() {
	$product_archive_id = false;

	// Guard WooCommerce conditional tags existence to avoid fatals if WC is disabled.
	$is_shop              = function_exists( 'is_shop' ) ? is_shop() : false;
	$is_archive           = function_exists( 'is_archive' ) ? is_archive() : false;
	$is_product_taxonomy  = function_exists( 'is_product_taxonomy' ) ? is_product_taxonomy() : false;
	$is_product_category  = function_exists( 'is_product_category' ) ? is_product_category() : false;
	$is_product_tag       = function_exists( 'is_product_tag' ) ? is_product_tag() : false;
	$is_woocommerce       = function_exists( 'is_woocommerce' ) ? is_woocommerce() : false;

	if ( $is_shop || $is_archive || $is_product_taxonomy || $is_product_category || $is_product_tag || $is_woocommerce ) {
		$product_archive_id = TOPPPA_Theme_Builder::get_settings( 'product-archive', '' );
		if ( '' === $product_archive_id ) {
			$product_archive_id = false;
		}
	}

	return apply_filters( 'get_topppa_product_archive_id', $product_archive_id );
}

function topppa_render_header() {
	if ( false == apply_filters( 'enable_topppa_render_header', true ) ) {
		return;
	}
	TOPPPA_Theme_Builder::get_header_content();
}

function topppa_render_footer() {
	if ( false == apply_filters( 'enable_topppa_render_footer', true ) ) {
		return;
	}
	TOPPPA_Theme_Builder::get_footer_content();
}

function topppa_render_single() {
	if ( false == apply_filters( 'enable_topppa_render_single', true ) ) {
		return;
	}
	TOPPPA_Theme_Builder::get_single_content();
}

function topppa_render_archive() {
	if ( false == apply_filters( 'enable_topppa_render_archive', true ) ) {
		return;
	}
	TOPPPA_Theme_Builder::get_archive_content();
}

function topppa_render_page_title() {
	if ( false == apply_filters( 'enable_topppa_render_page_title', true ) ) {
		return;
	}
	TOPPPA_Theme_Builder::get_page_title_content();
}

// Fallback for is_plugin_active
if ( ! function_exists( 'is_plugin_active' ) ) {
	require_once ABSPATH . 'wp-admin/includes/plugin.php';
}

if ( ! is_plugin_active( 'topper-pack/topper-pack.php' ) ) {
	if ( ! function_exists( 'topppa_theme_builder_render_at_location' ) ) {
		function topppa_theme_builder_render_at_location( $location ) {
			$module  = TOPPPA_Theme_Builder::instance();
			$content = false;

			switch ( $location ) {
				case 'header':
					$content = $module::get_header_content();
					break;
				case 'footer':
					$content = $module::get_footer_content();
					break;
				case 'page-title':
					$content = $module::get_page_title_content();
					break;
				case 'single':
					$content = $module::get_single_content();
					break;
				case 'archive':
					$content = $module::get_archive_content();
					break;
				// Locations other than Header, Footer, Single Post, Single Page or Archive will render Single template.
				case 'default':
				default:
					$content = $module::get_single_content();
			}

			return $content;
		}
	}
}

function topppa_page_title_enabled() {
	return topppa_template_enabled( 'page-title' );
}

/**
 * Check if we're currently in Elementor editor mode
 * This prevents theme builder elements from showing in the editor
 */
function topppa_is_elementor_editor_mode() {
	// Check if Elementor is active and we're in editor mode
	if ( class_exists( '\Elementor\Plugin' ) ) {
		// Method 1: Check if we're in preview mode
		if ( \Elementor\Plugin::instance()->preview && \Elementor\Plugin::instance()->preview->is_preview_mode() ) {
			return true;
		}
		
		// Method 2: Check if we're in editor mode
		if ( \Elementor\Plugin::instance()->editor && \Elementor\Plugin::instance()->editor->is_edit_mode() ) {
			return true;
		}
	}
	
	// Method 3: Check body classes (fallback)
	if ( function_exists( 'get_body_class' ) ) {
		$body_classes = get_body_class();
		if ( in_array( 'elementor-editor-active', $body_classes ) || 
			 in_array( 'elementor-editor-preview', $body_classes ) ) {
			return true;
		}
	}
	
	return false;
}

function get_topppa_page_title_id() {
	return topppa_get_template_id( 'page-title' );
}

function get_topppa_cart_id() {
	return topppa_get_template_id( 'cart' );
}

function topppa_cart_enabled() {
	return topppa_template_enabled( 'cart' );
}

function get_topppa_checkout_id() {
	return topppa_get_template_id( 'checkout' );
}

function topppa_checkout_enabled() {
	return topppa_template_enabled( 'checkout' );
}