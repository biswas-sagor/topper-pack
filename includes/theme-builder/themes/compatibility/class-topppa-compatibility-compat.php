<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
use TopperPack\Includes\Theme_Builder\TOPPPA_Theme_Builder;


/**
 * Astra theme compatibility.
 */
class TOPPPA_Compatibility_Compat {
	private static $instance;

	public static function instance() {
		if ( ! isset( self::$instance ) ) {
			self::$instance = new TOPPPA_Compatibility_Compat();

			add_action( 'wp', array( self::$instance, 'hooks' ) );
		}

		return self::$instance;
	}

	public function hooks() {
		// Add conditional full-width hooks for Astra theme
		add_action( 'template_redirect', array( $this, 'setup_conditional_fullwidth' ), 5 );
		
		if ( topppa_header_enabled() ) {
			add_action( 'template_redirect', array( $this, 'setup_header_compatibility' ), 10 );
			add_action( 'astra_header', 'topppa_render_header' );
		}

		if ( topppa_footer_enabled() ) {
			add_action( 'template_redirect', array( $this, 'setup_footer_compatibility' ), 10 );
			add_action( 'astra_footer', 'topppa_render_footer' );
		}

		if ( topppa_page_title_enabled() ) {
			// Do not render page title on the front page or in Elementor editor mode
			if ( is_front_page() || $this->is_elementor_editor_mode() ) {
				// Also guard the renderer via filter for any direct calls
				add_filter( 'enable_topppa_render_page_title', function( $enabled ) {
					return false;
				}, 10 );
			} else {
				add_action( 'template_redirect', array( $this, 'setup_page_title_compatibility' ), 10 );
				
				// Single Astra hook for page title - prevents duplication
				add_action( 'astra_content_before', 'topppa_render_page_title' );
			}
		}

		if ( topppa_single_enabled() || topppa_archive_enabled() || get_topppa_error_404_id() || topppa_single_page_enabled() ) {
			add_filter( 'template_include', array( $this, 'override_single' ), 11 );
		}
	}

	public function setup_header_compatibility() {
		remove_action( 'astra_header', 'astra_header_markup' );

		if ( class_exists( 'Astra_Builder_Helper' ) && Astra_Builder_Helper::$is_header_footer_builder_active ) {
			remove_action( 'astra_header', array( Astra_Builder_Header::get_instance(), 'prepare_header_builder_markup' ) );
		}
	}

	public function setup_footer_compatibility() {
		remove_action( 'astra_footer', 'astra_footer_markup' );

		if ( class_exists( 'Astra_Builder_Helper' ) && Astra_Builder_Helper::$is_header_footer_builder_active ) {
			remove_action( 'astra_footer', array( Astra_Builder_Footer::get_instance(), 'footer_markup' ) );
		}
	}

	public function setup_page_title_compatibility() {
		// Remove Astra's default page title/breadcrumb
		remove_action( 'astra_content_before', 'astra_content_before' );
		remove_action( 'astra_content_after', 'astra_content_after' );
		
		// Remove Astra's page header
		remove_action( 'astra_content_before', 'astra_page_header' );
		remove_action( 'astra_content_before', 'astra_single_header' );
		
		// Remove Astra's breadcrumb
		remove_action( 'astra_content_before', 'astra_breadcrumbs' );
		
		// Remove Astra's page title
		remove_action( 'astra_content_before', 'astra_page_title' );
		remove_action( 'astra_content_before', 'astra_single_title' );
		
		// Remove Astra's archive title
		remove_action( 'astra_content_before', 'astra_archive_title' );
		
		// Remove Astra's content top
		remove_action( 'astra_content_before', 'astra_content_top' );
		
		// Remove Astra's content bottom
		remove_action( 'astra_content_after', 'astra_content_bottom' );
	}

	/**
	 * Check if we're in Elementor editor mode
	 * This prevents page title from showing in the editor
	 */
	private function is_elementor_editor_mode() {
		return topppa_is_elementor_editor_mode();
	}

	/**
	 * Check if the current page uses Elementor
	 * This determines whether to apply full-width CSS
	 */
	private function is_elementor_page() {
		// Check if we're on a singular page/post
		if ( ! is_singular() ) {
			return false;
		}
		
		// Check if Elementor is active
		if ( ! class_exists( '\Elementor\Plugin' ) ) {
			return false;
		}
		
		// Get the current post ID
		$post_id = get_the_ID();
		if ( ! $post_id ) {
			return false;
		}
		
		// Check if Elementor is used on this page
		$elementor_data = get_post_meta( $post_id, '_elementor_data', true );
		if ( empty( $elementor_data ) ) {
			return false;
		}
		
		// Check if Elementor is enabled for this page
		$elementor_enabled = get_post_meta( $post_id, '_elementor_edit_mode', true );
		if ( $elementor_enabled !== 'builder' ) {
			return false;
		}
		
		return true;
	}

	/**
	 * Force page-builder layout for Elementor pages
	 * This is Astra's most effective full-width layout
	 */
	public function force_fullwidth_layout( $layout ) {
		return 'page-builder';
	}

	/**
	 * Force page template to ensure layout is applied
	 */
	public function force_page_template( $template ) {
		return 'page-builder.php';
	}

	/**
	 * Add full-width body class for Elementor pages
	 */
	public function add_fullwidth_body_class( $classes ) {
		$classes[] = 'ast-page-builder-template';
		$classes[] = 'ast-full-width-content';
		return $classes;
	}

	/**
	 * Force container class to be page-builder
	 */
	public function force_container_class( $classes ) {
		// Force page-builder class
		$classes = array( 'ast-container', 'ast-page-builder-template' );
		return $classes;
	}

	/**
	 * Force full-width start - opens full-width container
	 */
	public function force_fullwidth_start() {
		echo '<div class="ast-container ast-page-builder-template" style="max-width: 100%; width: 100%; padding: 0; margin: 0;">';
	}

	/**
	 * Force full-width end - closes full-width container
	 */
	public function force_fullwidth_end() {
		echo '</div>';
	}



	/**
	 * Setup conditional full-width for Astra theme
	 * Uses PHP hooks instead of CSS to modify container structure
	 */
	public function setup_conditional_fullwidth() {
		// Only apply full-width when Elementor is used on the page
		if ( ! $this->is_elementor_page() ) {
			return;
		}
		
		// Force Astra to use page-builder layout (full-width for Elementor)
		add_filter( 'astra_get_content_layout', array( $this, 'force_fullwidth_layout' ) );
		add_filter( 'astra_content_layout', array( $this, 'force_fullwidth_layout' ) );
		
		// Override Astra's page template to ensure layout is applied
		add_filter( 'astra_page_template', array( $this, 'force_page_template' ) );
		
		// Override Astra's container classes
		add_filter( 'astra_container_class', array( $this, 'force_container_class' ) );
		
		// Add body class for full-width
		add_filter( 'body_class', array( $this, 'add_fullwidth_body_class' ) );
		
		// Hook into Astra's content area early
		add_action( 'astra_content_before', array( $this, 'force_fullwidth_start' ), 1 );
		add_action( 'astra_content_after', array( $this, 'force_fullwidth_end' ), 999 );
	}

	public function override_single() {

		if ( is_404() ) {
			require TOPPPA_INC_PATH . 'theme-builder/themes/default/topppa-header-footer-single.php';
		}
		if ( is_page() ) {
			require TOPPPA_INC_PATH . 'theme-builder/themes/default/topppa-header-footer-single.php';
		}
		if ( is_single() ) {
			require TOPPPA_INC_PATH . 'theme-builder/themes/default/topppa-header-footer-single.php';
		}
		if ( is_archive() ) {
			require TOPPPA_INC_PATH . 'theme-builder/themes/default/topppa-header-footer-archive.php';
		}
	}
}

TOPPPA_Compatibility_Compat::instance();
