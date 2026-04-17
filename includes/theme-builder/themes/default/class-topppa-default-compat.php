<?php

namespace TopperPack\Themes;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
use TopperPack\Includes\Theme_Builder\TOPPPA_Theme_Builder;

/**
 * Default theme compatibility.
 */
class TOPPPA_Default_Compat {
	
	private $header_rendered = false;
	private $footer_rendered = false;
	private $hooks_initialized = false;
	
	public function __construct() {
		// Defer expensive operations until actually needed
		add_action( 'template_redirect', array( $this, 'hooks' ), 1 );
	}
	
	public function hooks() {
		// Prevent multiple initialization
		if ( $this->hooks_initialized ) {
			return;
		}
		$this->hooks_initialized = true;

		// Early return if no theme builder templates are configured
		if ( ! $this->has_any_templates() ) {
			return;
		}

		// Enqueue CSS to fix container constraints from themes
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_container_fix_css' ) );

		if ( topppa_header_enabled() ) {
			add_action( 'get_header', array( $this, 'override_header' ) );
			add_action( 'topppa_header', 'topppa_render_header' );
		}

		if ( topppa_footer_enabled() ) {
			add_action( 'get_footer', array( $this, 'override_footer' ) );
			add_action( 'topppa_footer', 'topppa_render_footer' );
		}
		
		if ( topppa_page_title_enabled() ) {
			// Do not render page title on the front page or in Elementor editor mode
			if ( is_front_page() || $this->is_elementor_editor_mode() ) {
				// Also guard the renderer via filter for any direct calls
				add_filter( 'enable_topppa_render_page_title', function( $enabled ) {
					return false;
				}, 10 );
			} else {
				add_action( 'topppa_page_title', 'topppa_render_page_title' );
				// Simple hook to display page title after header
				add_action( 'wp_head', array( $this, 'add_page_title_to_page' ), 999 );
			}
		}

		if ( topppa_single_enabled() || topppa_archive_enabled() || get_topppa_error_404_id() || topppa_single_page_enabled() ) {
			add_filter( 'template_include', array( $this, 'override_single' ), 11 );
		}
	}

	/**
	 * Check if we're in Elementor editor mode
	 * This prevents page title from showing in the editor
	 */
	private function is_elementor_editor_mode() {
		return topppa_is_elementor_editor_mode();
	}

	/**
	 * Enqueue CSS to fix container constraints from themes
	 */
	public function enqueue_container_fix_css() {
		wp_enqueue_style(
			'topppa-compatibility',
			TOPPPA_INC_URL . 'theme-builder/assets/css/compatibility.css',
			array(),
			TOPPPA_VER,
			'all'
		);
	}

	/**
	 * Check if any theme builder templates are configured
	 * This prevents unnecessary hook setup when no templates exist
	 */
	private function has_any_templates() {
		static $has_templates = null;
		
		if ( $has_templates !== null ) {
			return $has_templates;
		}

		// Quick check for any configured templates
		$template_checks = array(
			'header', 'footer', 'page-title', 'single-page', 
			'single-post', 'error-404', 'archive'
		);

		foreach ( $template_checks as $template_type ) {
			if ( TOPPPA_Theme_Builder::get_settings( $template_type, '' ) !== '' ) {
				$has_templates = true;
				return true;
			}
		}

		$has_templates = false;
		return false;
	}

	public function override_header() {
		// Prevent infinite loops
		if ( $this->header_rendered ) {
			return;
		}
		$this->header_rendered = true;

		// Include our custom header template
		include TOPPPA_INC_PATH . 'theme-builder/themes/default/topppa-header.php';
		
		// Prevent the theme's header from loading
		$templates = array( 'header.php' );
		ob_start();
		locate_template( $templates, true );
		ob_get_clean();
	}
	
	public function override_footer() {
		// Prevent infinite loops
		if ( $this->footer_rendered ) {
			return;
		}
		$this->footer_rendered = true;

		// Include our custom footer template
		include TOPPPA_INC_PATH . 'theme-builder/themes/default/topppa-footer.php';
		
		// Prevent the theme's footer from loading
		$templates = array( 'footer.php' );
		ob_start();
		locate_template( $templates, true );
		ob_get_clean();
	}

	public function render_page_title() {
		require TOPPPA_INC_PATH . 'theme-builder/themes/default/topppa-page-title.php';
	}

	public function add_page_title_to_page() {
		// Only enqueue if we have page title content and we're not in Elementor editor mode
		if ( ! topppa_page_title_enabled() || $this->is_elementor_editor_mode() ) {
			return;
		}

		// Get page title content first
		ob_start();
		do_action( 'topppa_page_title' );
		$page_title_content = ob_get_clean();
		
		if ( empty( $page_title_content ) ) {
			return;
		}

		// Enqueue the dedicated page title script
		wp_enqueue_script( 
			'topppa-page-title', 
			TOPPPA_INC_URL . 'theme-builder/assets/js/topppa-page-title.js', 
			array( 'jquery' ), 
			TOPPPA_VER, 
			true 
		);
		
		// Output the page title content as a JavaScript variable
		?>
		<script>
		var topppa_page_title_content = <?php echo json_encode( $page_title_content ); ?>;
		</script>
		<?php
	}

	public function override_single( $template ) {
		// Return the appropriate template path instead of requiring directly
		if ( is_404() && get_topppa_error_404_id() ) {
			$new_template = TOPPPA_INC_PATH . 'theme-builder/themes/default/topppa-header-footer-single.php';
			if ( file_exists( $new_template ) ) {
				return $new_template;
			}
		}
		
		if ( is_page() && topppa_single_page_enabled() ) {
			$new_template = TOPPPA_INC_PATH . 'theme-builder/themes/default/topppa-header-footer-single.php';
			if ( file_exists( $new_template ) ) {
				return $new_template;
			}
		}
		
		if ( is_single() && topppa_single_enabled() ) {
			$new_template = TOPPPA_INC_PATH . 'theme-builder/themes/default/topppa-header-footer-single.php';
			if ( file_exists( $new_template ) ) {
				return $new_template;
			}
		}
		
		if ( is_archive() && topppa_archive_enabled() ) {
			$new_template = TOPPPA_INC_PATH . 'theme-builder/themes/default/topppa-header-footer-archive.php';
			if ( file_exists( $new_template ) ) {
				return $new_template;
			}
		}

		// Return original template if no conditions match
		return $template;
	}

}

new TOPPPA_Default_Compat();