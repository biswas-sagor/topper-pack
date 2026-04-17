<?php

namespace TopperPack\Includes\Theme_Builder;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use TopperPack\Traits\Singleton;
use TopperPack\Includes\Theme_Builder\Conditions\TOPPPA_Conditions;
use Elementor;
use TopperPack\Includes\TOPPPA_Helper;

class TOPPPA_Theme_Builder {
	use Singleton;

	public $dir;

	public $template;

	private static $elementor;
	
	private static $template_cache = array();
	private static $settings_cache = null;

	private function __construct() {

		$this->template = get_template();
		$this->dir      = dirname( __FILE__ ) . '/';

		add_action( 'admin_menu', array( $this, 'topppa_tb_admin_menu' ) );

		// Clear cache when posts are saved
		add_action( 'save_post', array( $this, 'clear_template_cache' ) );
		add_action( 'delete_post', array( $this, 'clear_template_cache' ) );

		$is_elementor_callable = ( defined( 'ELEMENTOR_VERSION' ) && is_callable( 'Elementor\Plugin::instance' ) ) ? true : false;

		$compatibility_themes = array( 'astra' );

		// If no match is found, set up fallback support.
		if ( ! in_array( $this->template, $compatibility_themes ) ) {
			add_action( 'init', array( $this, 'setup_fallback_support' ) );
		} else {
			require TOPPPA_INC_PATH . 'theme-builder/themes/compatibility/class-topppa-compatibility-compat.php';
		}

		if ( $is_elementor_callable ) {
			// Initialize Elementor with error handling
			try {
				self::$elementor = Elementor\Plugin::instance();
			} catch ( Exception $e ) {
				return;
			}

			$this->include_files();

			add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
			add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_admin_scripts' ) );
			add_filter( 'body_class', array( $this, 'body_class' ) );

			if ( class_exists( 'WooCommerce' ) && topppa_can_use_premium_features()) {
				// Single Product.
				add_filter( 'wc_get_template_part', array( $this, 'get_product_page_woocommerce_template' ), 99, 3 );
				add_filter( 'template_include', array( $this, 'get_product_page_elementor_template' ), 999 );
				add_action( 'topppa_template_woocommerce_product_content', array( $this, 'get_product_content_elementor' ), 5 );
				add_action( 'topppa_template_woocommerce_product_content', array( $this, 'get_product_default_data' ), 10 );

				// Cart Page
				add_filter( 'template_include', array( $this, 'get_cart_page_elementor_template' ), 999 );
				add_action( 'topppa_template_woocommerce_cart_content', array( $this, 'get_cart_content_elementor' ), 5 );

				// Checkout Page
				add_filter( 'template_include', array( $this, 'get_checkout_page_elementor_template' ), 999 );
				add_action( 'topppa_template_woocommerce_checkout_content', array( $this, 'get_checkout_content_elementor' ), 5 );
				
				// Order Received Page - Let WooCommerce handle it naturally
				// add_filter( 'template_include', array( $this, 'get_order_received_page_elementor_template' ), 999 );
				// add_action( 'topppa_template_woocommerce_order_received_content', array( $this, 'get_order_received_content_elementor' ), 5 );
				
				// Product Archive Page.
				add_action( 'template_redirect', array( $this, 'topppa_product_archive_template' ), 999 );
				add_filter( 'template_include', array( $this, 'topppa_redirect_product_archive_template' ), 999 );
				add_action( 'topppa_template_woocommerce_archive_product_content', array( $this, 'topppa_archive_product_page_content' ) );
			}

			add_shortcode( 'topppa_theme_builder', array( $this, 'render_template' ) );
		}

	}

	/**
	 * Clear template cache when posts are modified
	 */
	public function clear_template_cache( $post_id ) {
		// Only clear cache for theme builder posts
		if ( get_post_type( $post_id ) === 'topppa-theme-builder' ) {
			self::$template_cache = array();
			self::$settings_cache = null;
		}
	}

	public function setup_fallback_support() {

		require_once TOPPPA_INC_PATH . 'theme-builder/themes/default/class-topppa-default-compat.php';
	}

	public function include_files() {
		require_once TOPPPA_INC_PATH . 'theme-builder/admin/class-admin.php';
		require_once $this->dir . 'theme-util.php';

		// Load WPML & Polylang Compatibility if WPML is installed and activated.
		if ( defined( 'ICL_SITEPRESS_VERSION' ) || defined( 'POLYLANG_BASENAME' ) ) {
			require_once $this->dir . 'compatibility/class-theme-wpml-compatibility.php';
		}

		require_once $this->dir . 'conditions/class-topppa-conditions.php';
	}

	/**
	 * Enqueue CSS for a specific template
	 *
	 * @param int $template_id The template ID
	 */
	private function enqueue_template_css( $template_id ) {
		if ( ! $template_id ) {
			return;
		}

		if ( class_exists( '\Elementor\Core\Files\CSS\Post' ) ) {
			$css_file = new \Elementor\Core\Files\CSS\Post( $template_id );
		} elseif ( class_exists( '\Elementor\Post_CSS_File' ) ) {
			$css_file = new \Elementor\Post_CSS_File( $template_id );
		} else {
			return;
		}

		$css_file->enqueue();
	}

	public function enqueue_scripts() {
		// Early return if no templates are configured
		$template_ids = $this->get_all_template_ids();
		$has_templates = array_filter( $template_ids );
		
		if ( empty( $has_templates ) ) {
			return;
		}

		// Enqueue Elementor styles only if needed
		if ( class_exists( '\Elementor\Plugin' ) ) {
			$elementor = \Elementor\Plugin::instance();
			if ( method_exists( $elementor->frontend, 'enqueue_styles' ) ) {
				$elementor->frontend->enqueue_styles();
			}
		}

		if ( class_exists( '\ElementorPro\Plugin' ) ) {
			$elementor_pro = \ElementorPro\Plugin::instance();
			if ( method_exists( $elementor_pro, 'enqueue_styles' ) ) {
				$elementor_pro->enqueue_styles();
			}
		}

		// Enqueue CSS only for active templates
		foreach ( $template_ids as $template_id ) {
			if ( $template_id ) {
				$this->enqueue_template_css( $template_id );
			}
		}
	}

	public function enqueue_admin_scripts() {
		global $pagenow;
		$screen = get_current_screen();

		if ( ( 'topppa-theme-builder' === $screen->id && ( 'post.php' === $pagenow || 'post-new.php' === $pagenow ) ) || ( 'edit.php' === $pagenow && 'edit-topppa-theme-builder' === $screen->id ) ) {
			wp_enqueue_style( 'topppa-hf-admin-style', TOPPPA_INC_URL . 'theme-builder/assets/css/topppa-theme-admin.css', array(), TOPPPA_VER );
			wp_enqueue_script( 'topppa-hf-admin-script', TOPPPA_INC_URL . 'theme-builder/assets/js/topppa-theme-admin.js', array(), TOPPPA_VER, true );
		}
	}

	public function body_class( $classes ) {
		// Use cached template IDs
		$template_ids = $this->get_all_template_ids();

		if ( $template_ids['header'] ) {
			$classes[] = 'topppa-theme-header';
		}

		if ( $template_ids['footer'] ) {
			$classes[] = 'topppa-theme-footer';
		}

		if ( $template_ids['page_title'] ) {
			$classes[] = 'topppa-theme-page-title';
		}

		if ( $template_ids['single_page'] ) {
			$classes[] = 'topppa-theme-single-page';
		}

		if ( $template_ids['single_post'] ) {
			$classes[] = 'topppa-theme-single-post';
		}

		if ( $template_ids['error_404'] ) {
			$classes[] = 'topppa-theme-error-404';
		}

		if ( $template_ids['archive'] ) {
			$classes[] = 'topppa-theme-archive';
		}

		$classes[] = 'topppa-template-' . $this->template;
		$classes[] = 'topppa-stylesheet-' . get_stylesheet();

		return $classes;
	}

	public static function get_header_content() {
		$header_id = get_topppa_header_id();

		if ( ! $header_id ) {
			return false;
		}

		// Safety check for Elementor
		if ( ! self::$elementor || ! method_exists( self::$elementor->frontend, 'get_builder_content_for_display' ) ) {
			return false;
		}

		echo '<header id="masthead" class="topppa-site-header" role="banner" >';
		echo self::$elementor->frontend->get_builder_content_for_display( $header_id );//phpcs:ignore
		echo '</header>';

		return true;
	}

	public static function get_footer_content() {
		$footer_id = get_topppa_footer_id();

		if ( ! $footer_id ) {
			return false;
		}

		// Safety check for Elementor
		if ( ! self::$elementor || ! method_exists( self::$elementor->frontend, 'get_builder_content_for_display' ) ) {
			return false;
		}

		echo self::$elementor->frontend->get_builder_content_for_display( $footer_id );//phpcs:ignore

		return true;
	}

	public static function get_single_content() {
		$current_post = get_the_ID();

		if ( is_404( $current_post ) ) {
			return self::get_error_404_content();
		}

		if ( is_page( $current_post ) || is_attachment( $current_post ) ) {
			return self::get_single_page_content();
		}

		if ( is_single( $current_post ) ) {
			return self::get_single_post_content();
		}

		return false;
	}

	public static function get_single_page_content() {
		$single_page_id = get_topppa_single_page_id();

		if ( ! $single_page_id ) {
			return false;
		}

		echo self::$elementor->frontend->get_builder_content_for_display( $single_page_id ); //phpcs:ignore

		return true;
	}

	public static function get_single_post_content() {
		$single_post_id = get_topppa_single_post_id();

		if ( ! $single_post_id ) {
			return false;
		}

		echo self::$elementor->frontend->get_builder_content_for_display( $single_post_id );//phpcs:ignore

		return true;
	}

	public static function get_error_404_content() {
		$error_404_id = get_topppa_error_404_id();

		if ( ! $error_404_id ) {
			return false;
		}

		echo self::$elementor->frontend->get_builder_content_for_display( $error_404_id );//phpcs:ignore

		return true;
	}

	public static function get_page_title_content() {
		$page_title_id = get_topppa_page_title_id();

		if ( ! $page_title_id ) {
			return false;
		}

		echo '<div class="topppa-page-title-wrapper">';
		echo self::$elementor->frontend->get_builder_content_for_display( $page_title_id );//phpcs:ignore
		echo '</div>';

		return true;
	}

	public static function get_archive_content() {
		$archive_id = get_topppa_archive_id();

		if ( ! $archive_id ) {
			return false;
		}

		echo ( self::$elementor->frontend->get_builder_content_for_display( $archive_id ) ); //phpcs:ignore

		return true;
	}

	public static function get_product_archive_content() {
		$archive_id = get_topppa_product_archive_id();

		if ( ! $archive_id ) {
			return false;
		}

		echo ( self::$elementor->frontend->get_builder_content_for_display( $archive_id ) );//phpcs:ignore

		return true;
	}

	/**
	 * Get cached template settings to avoid multiple DB queries
	 */
	public static function get_settings( $setting = '', $default = '' ) {
		// Handle specific template type requests
		if ( 'header' === $setting || 'footer' === $setting || 'page-title' === $setting || 'single-page' === $setting || 'single-post' === $setting || 'error-404' === $setting || 'archive' === $setting || 'single-product' === $setting || 'product-archive' === $setting || 'cart' === $setting || 'checkout' === $setting ) {
			$templates = self::get_template_id( $setting );

			$template = ! is_array( $templates ) ? $templates : $templates[0];

			$template = apply_filters( "topppa_hf_get_settings_{$setting}", $template );

			return $template;
		}

		// Cache all settings in one query for other settings
		if ( self::$settings_cache === null ) {
			self::$settings_cache = get_option( 'topppa_theme_builder_settings', array() );
		}

		if ( empty( $setting ) ) {
			return self::$settings_cache;
		}

		return isset( self::$settings_cache[ $setting ] ) ? self::$settings_cache[ $setting ] : $default;
	}

	/**
	 * Get cached template IDs to avoid repeated function calls
	 */
	private function get_all_template_ids() {
		if ( ! empty( self::$template_cache ) ) {
			return self::$template_cache;
		}

		// Get all template IDs in one go
		$template_functions = array(
			'header' => 'get_topppa_header_id',
			'footer' => 'get_topppa_footer_id',
			'single_page' => 'get_topppa_single_page_id',
			'single_post' => 'get_topppa_single_post_id',
			'error_404' => 'get_topppa_error_404_id',
			'archive' => 'get_topppa_archive_id',
			'page_title' => 'get_topppa_page_title_id'
		);

		foreach ( $template_functions as $key => $function ) {
			if ( function_exists( $function ) ) {
				self::$template_cache[ $key ] = $function();
			} else {
				self::$template_cache[ $key ] = false;
			}
		}

		return self::$template_cache;
	}

	/**
	 * Legacy method for compatibility
	 */
	public static function get_template_id( $type ) {
		$option = array(
			'location'  => 'topppa_hf_include_locations',
			'exclusion' => 'topppa_hf_exclude_locations',
			'users'     => 'topppa_hf_target_user_roles',
		);
		
		$templates = TOPPPA_Conditions::instance()->get_posts_by_conditions( 'topppa-theme-builder', $option );
		
		$template_ids = array();

		foreach ( $templates as $template ) {
			if ( get_post_meta( absint( $template['id'] ), 'topppa_hf_template_type', true ) === $type ) {
				$template_ids[] = $template['id'];
			}
		}

		return empty( $template_ids ) ? '' : $template_ids;
	}

	public function render_template( $atts ) {
		$atts = shortcode_atts(
			array(
				'id' => '',
			),
			$atts,
			'topppa_theme_builder'
		);

		$id = ! empty( $atts['id'] ) ? apply_filters( 'topppa_hf_render_shortcode', intval( $atts['id'] ) ) : '';

		if ( empty( $id ) ) {
			return '';
		}

		if ( class_exists( '\Elementor\Core\Files\CSS\Post' ) ) {
			$css_file = new \Elementor\Core\Files\CSS\Post( $id );
		} elseif ( class_exists( '\Elementor\Post_CSS_File' ) ) {
			$css_file = new \Elementor\Post_CSS_File( $id );
		}

		$css_file->enqueue();

		return self::$elementor->frontend->get_builder_content_for_display( $id );
	}

	public function get_product_page_woocommerce_template( $template, $slug, $name ) {
		if ( 'content' === $slug && 'single-product' === $name ) {
			if ( get_topppa_single_product_id() ) {
				$template = TOPPPA_PRO_INC_PATH . 'theme-builder/templates/woocommerce/single-product.php';
			}
		}

		return $template;
	}

	public function get_product_page_elementor_template( $template ) {
		if ( is_embed() ) {
			return $template;
		}

		if ( is_singular( 'product' ) ) {
			if ( get_topppa_single_product_id() ) {
				$page_template = get_post_meta( get_the_ID(), '_wp_page_template', true );

				if ( 'elementor_header_footer' === $page_template ) {
					$template = TOPPPA_PRO_INC_PATH . 'theme-builder/templates/woocommerce/single-product-fullwidth.php';
				} elseif ( 'elementor_canvas' === $page_template ) {
					$template = TOPPPA_PRO_INC_PATH . 'theme-builder/templates/woocommerce/single-product-canvas.php';
				}
			}
		}

		return $template;
	}

	public function get_product_content_elementor() {
		if ( get_topppa_single_product_id() ) {
			$template_id = get_topppa_single_product_id();
			echo ( Elementor\Plugin::instance()->frontend->get_builder_content_for_display( $template_id ) );//phpcs:ignore
		} else {
			the_content();
		}
	}

	public function get_product_default_data() {
		WC()->structured_data->generate_product_data();
	}

	public function topppa_product_archive_template() {
		$archive_template_id = 0;
		if ( defined( 'WOOCOMMERCE_VERSION' ) ) {
			$termobj            = get_queried_object();
			$get_all_taxonomies = TOPPPA_Helper::topppa_get_taxonomies();

			if ( is_shop() || ( is_tax( 'product_cat' ) && is_product_category() ) || ( is_tax( 'product_tag' ) && is_product_tag() ) || ( isset( $termobj->taxonomy ) && is_tax( $termobj->taxonomy ) && array_key_exists( $termobj->taxonomy, $get_all_taxonomies ) ) ) {
				$product_shop_custom_page_id = get_topppa_product_archive_id(); // getting the product archive id.
				// Archive Layout Control.
				$topppatermlayoutid = 0;
				if ( ( is_tax( 'product_cat' ) && is_product_category() ) || ( is_tax( 'product_tag' ) && is_product_tag() ) ) {

					$product_archive_custom_page_id = get_topppa_product_archive_id();

					// Get Meta Value.
					$topppatermlayoutid = get_term_meta( $termobj->term_id, 'topppa_selectcategory_layout', true ) ? get_term_meta( $termobj->term_id, 'topppa_selectcategory_layout', true ) : '0';

					if ( ! empty( $product_archive_custom_page_id ) && '0' == $topppatermlayoutid ) {
						$topppatermlayoutid = $product_archive_custom_page_id;
					}
				}
				if ( '0' != $topppatermlayoutid ) {
					$archive_template_id = $topppatermlayoutid;
				} else {
					if ( ! empty( $product_shop_custom_page_id ) ) {
						$archive_template_id = $product_shop_custom_page_id;
					}
				}
				return $archive_template_id;
			}

			return $archive_template_id;
		}
	}

	public function topppa_redirect_product_archive_template( $template ) {
		$archive_template_id = $this->topppa_product_archive_template();
		$templatefile        = array();
		$templatefile[]      = 'templates/woocommerce/archive-product.php';
		if ( '0' != $archive_template_id ) {
			$template = locate_template( $templatefile );
			if ( ! $template || ( ! empty( $status_options['template_debug_mode'] ) && current_user_can( 'manage_options' ) ) ) {
				$template = TOPPPA_PRO_INC_PATH . 'theme-builder/templates/woocommerce/archive-product.php';
			}
			$page_template_slug = get_page_template_slug( $archive_template_id );
			if ( 'elementor_header_footer' === $page_template_slug ) {
				$template = TOPPPA_PRO_INC_PATH . 'theme-builder/templates/woocommerce/archive-product-fullwidth.php';
			} elseif ( 'elementor_canvas' === $page_template_slug ) {
				$template = TOPPPA_PRO_INC_PATH . 'theme-builder/templates/woocommerce/archive-product-canvas.php';
			}
		}

		if ( is_cart() ) {
			$template = locate_template( $templatefile );
			if ( ! $template || ( ! empty( $status_options['template_debug_mode'] ) && current_user_can( 'manage_options' ) ) ) {
				$template = TOPPPA_PRO_INC_PATH . 'theme-builder/templates/woocommerce/cart.php';
			}
		}
		
		if ( is_checkout() ) {
			$template = locate_template( $templatefile );
			if ( ! $template || ( ! empty( $status_options['template_debug_mode'] ) && current_user_can( 'manage_options' ) ) ) {
				$template = TOPPPA_PRO_INC_PATH . 'theme-builder/templates/woocommerce/checkout.php';
			}
		}

		return $template;
	}

	public function topppa_archive_product_page_content( $post ) {
		$archive_template_id = $this->topppa_product_archive_template();
		if ( '0' != $archive_template_id ) {
			echo class_exists( '\Elementor\Plugin' ) ? ( Elementor\Plugin::instance()->frontend->get_builder_content_for_display( $archive_template_id ) ) : '';//phpcs:ignore
		} else {
			the_content(); }
	}

	public function topppa_tb_admin_menu() {
		add_submenu_page(
			'topper-pack',
			__( 'Theme Builder', 'topper-pack' ),
			__( 'Theme Builder', 'topper-pack' ),
			'edit_pages',
			'edit.php?post_type=topppa-theme-builder',
			'',
			5
		);
	}

	public function get_cart_page_elementor_template( $template ) {
		if ( is_embed() ) {
			return $template;
		}

		if ( is_cart() ) {
			if ( get_topppa_cart_id() ) {
				$page_template = get_post_meta( get_topppa_cart_id(), '_wp_page_template', true );

				if ( 'elementor_header_footer' === $page_template ) {
					$template = TOPPPA_PRO_INC_PATH . 'theme-builder/templates/woocommerce/cart-fullwidth.php';
				} elseif ( 'elementor_canvas' === $page_template ) {
					$template = TOPPPA_PRO_INC_PATH . 'theme-builder/templates/woocommerce/cart-canvas.php';
				} else {
					$template = TOPPPA_PRO_INC_PATH . 'theme-builder/templates/woocommerce/cart.php';
				}
			}
		}

		return $template;
	}

	public function get_cart_content_elementor() {
		if ( get_topppa_cart_id() ) {
			$template_id = get_topppa_cart_id();
			echo self::$elementor->frontend->get_builder_content_for_display( $template_id );//phpcs:ignore
		} else {
			// Add Bootstrap container wrapper for default cart
			echo '<div class="container">';
			wc_get_template( 'cart/cart.php' );
			echo '</div>';
		}
	}

	public function get_checkout_page_elementor_template( $template ) {
		if ( is_embed() ) {
			return $template;
		}

		if ( is_checkout() ) {
			if ( get_topppa_checkout_id() ) {
				$page_template = get_post_meta( get_topppa_checkout_id(), '_wp_page_template', true );

				if ( 'elementor_header_footer' === $page_template ) {
					$template = TOPPPA_PRO_INC_PATH . 'theme-builder/templates/woocommerce/checkout-fullwidth.php';
				} elseif ( 'elementor_canvas' === $page_template ) {
					$template = TOPPPA_PRO_INC_PATH . 'theme-builder/templates/woocommerce/checkout-canvas.php';
				} else {
					$template = TOPPPA_PRO_INC_PATH . 'theme-builder/templates/woocommerce/checkout.php';
				}
			}
		}

		return $template;
	}

	public function get_checkout_content_elementor() {
		// Don't interfere with order received page - let WooCommerce handle it naturally
		if ( is_wc_endpoint_url( 'order-received' ) ) {
			return;
		}

		if ( get_topppa_checkout_id() ) {
			$template_id = get_topppa_checkout_id();
			echo self::$elementor->frontend->get_builder_content_for_display( $template_id );//phpcs:ignore
		} else {
			// Ensure WooCommerce is active
			if ( ! class_exists( 'WooCommerce' ) ) {
				return;
			}

			// Ensure checkout object is initialized
			if ( ! is_object( WC()->checkout() ) ) {
				WC()->checkout = new WC_Checkout();
			}

			// Get the checkout object and pass it to the template
			$checkout = WC()->checkout();
			
			// Add Bootstrap container wrapper for default checkout
			echo '<div class="container">';
			include WC()->plugin_path() . '/templates/checkout/form-checkout.php';
			echo '</div>';
		}
	}

}

TOPPPA_Theme_Builder::instance();


