<?php

/**
 * Plugin
 *
 * @package Topper Pack
 * @since 1.0.0
 */

namespace TopperPack;

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}

/**
 * Plugin class.
 *
 * The main class that initiates and runs the addon.
 *
 * @since 1.0.0
 */
final class Plugin {

	/**
	 * Minimum Elementor Version
	 *
	 * @since 1.0.0
	 * @var string Minimum Elementor version required to run the addon.
	 */
	const MINIMUM_ELEMENTOR_VERSION = '3.20.0';

	/**
	 * Minimum PHP Version
	 *
	 * @since 1.0.0
	 * @var string Minimum PHP version required to run the addon.
	 */
	const MINIMUM_PHP_VERSION = '7.4';

	/**
	 * Instance
	 *
	 * @since 1.0.0
	 * @access private
	 * @static
	 * @var \TopperPack\Plugin The single instance of the class.
	 */
	private static $_instance = null;

	/**
	 * Instance
	 *
	 * Ensures only one instance of the class is loaded or can be loaded.
	 *
	 * @since 1.0.0
	 * @access public
	 * @static
	 * @return \TopperPack\Plugin An instance of the class.
	 */
	public static function instance() {

		if (is_null(self::$_instance)) {
			self::$_instance = new self();
		}

		do_action('TopperPack_loaded');

		return self::$_instance;
	}

	/**
	 * Constructor
	 *
	 * Perform some compatibility checks to make sure basic requirements are meet.
	 * If all compatibility checks pass, initialize the functionality.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function __construct() {
		if ($this->is_compatible()) {
			add_action('elementor/init', [$this, 'init']);
		}
	}

	/**
	 * Compatibility Checks
	 *
	 * Checks whether the site meets the addon requirement.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function is_compatible() {

		// Check if Elementor installed and activated
		if (!did_action('elementor/loaded')) {
			add_action('admin_notices', [$this, 'admin_notice_missing_main_plugin']);
			return false;
		}

		// Check for required Elementor version
		if (!version_compare(ELEMENTOR_VERSION, self::MINIMUM_ELEMENTOR_VERSION, '>=')) {
			add_action('admin_notices', [$this, 'admin_notice_minimum_elementor_version']);
			return false;
		}

		// Check for required PHP version
		if (version_compare(PHP_VERSION, self::MINIMUM_PHP_VERSION, '<')) {
			add_action('admin_notices', [$this, 'admin_notice_minimum_php_version']);
			return false;
		}

		return true;
	}

	/**
	 * Admin notice
	 *
	 * Warning when the site doesn't have Elementor installed or activated.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function admin_notice_missing_main_plugin() {

		if (isset($_GET['activate']))
			unset($_GET['activate']); // phpcs:ignore WordPress.Security.NonceVerification.Recommended

		$message = sprintf(
			/* translators: 1: Plugin name 2: Elementor */
			esc_html__('"%1$s" requires "%2$s" to be installed and activated.', 'topper-pack'),
			'<strong>' . esc_html__('Topper Pack', 'topper-pack') . '</strong>',
			'<strong>' . esc_html__('Elementor', 'topper-pack') . '</strong>'
		);

		printf('<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', wp_kses_post($message));
	}

	/**
	 * Admin notice
	 *
	 * Warning when the site doesn't have a minimum required Elementor version.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function admin_notice_minimum_elementor_version() {

		if (isset($_GET['activate']))
			unset($_GET['activate']); // phpcs:ignore WordPress.Security.NonceVerification.Recommended

		$message = sprintf(
			/* translators: 1: Plugin name 2: Elementor 3: Required Elementor version */
			esc_html__('"%1$s" requires "%2$s" version %3$s or greater.', 'topper-pack'),
			'<strong>' . esc_html__('Topper Pack', 'topper-pack') . '</strong>',
			'<strong>' . esc_html__('Elementor', 'topper-pack') . '</strong>',
			self::MINIMUM_ELEMENTOR_VERSION
		);

		printf('<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', wp_kses_post($message));
	}

	/**
	 * Admin notice
	 *
	 * Warning when the site doesn't have a minimum required PHP version.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function admin_notice_minimum_php_version() {

		if (isset($_GET['activate']))
			unset($_GET['activate']); // phpcs:ignore WordPress.Security.NonceVerification.Recommended

		$message = sprintf(
			/* translators: 1: Plugin name 2: PHP 3: Required PHP version */
			esc_html__('"%1$s" requires "%2$s" version %3$s or greater.', 'topper-pack'),
			'<strong>' . esc_html__('Topper Pack', 'topper-pack') . '</strong>',
			'<strong>' . esc_html__('PHP', 'topper-pack') . '</strong>',
			self::MINIMUM_PHP_VERSION
		);

		printf('<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', wp_kses_post($message));
	}

	/**
	 * Initialize
	 *
	 * Load the addons functionality only after Elementor is initialized.
	 *
	 * Fired by `elementor/init` action hook.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function init() {

		$this->topppa_include_files();
		$this->topppa_register_extensions();

		// Register widgets
		add_action('elementor/elements/categories_registered', [$this, 'topppa_widget_categories']);
		add_action('elementor/widgets/register', [$this, 'topppa_register_widgets']);

		// Register assets
		//add_action('wp_enqueue_scripts', [$this, 'topppa_register_assets']);

		// Only load Assets Manager when enabled
		if ('yes' === get_option('topppa_assets_manager')) {
			add_action('wp_enqueue_scripts', [$this, 'topppa_load_assets']);
		} else {
			add_action('wp_enqueue_scripts', [$this, 'topppa_register_assets']);
		}

		// Initialize fonts handler
		require_once TOPPPA_INC_PATH . 'class-topppa-fonts.php';
		\TopperPack\TOPPPA_Fonts::instance();

		if (is_admin()) {
			add_action('after_enqueue_scripts', [$this, 'topppa_register_assets'], 5);
			add_action('elementor/editor/after_enqueue_scripts', [$this, 'nested_elements'], 5);
			add_action('elementor/editor/after_enqueue_scripts', [$this, 'topppa_register_editor_assets'], 10);
		} else {
			add_action('wp_enqueue_scripts', [$this, 'topppa_register_assets'], 5);
		}
	}

	/**
	 * Register Widgets
	 *
	 * Load widgets files and register new Elementor widgets.
	 *
	 * Fired by `elementor/widgets/register` action hook.
	 *
	 * @param \Elementor\Widgets_Manager $widgets_manager Elementor widgets manager.
	 */
	public function topppa_register_widgets($widgets_manager) {
		// List of widgets with their option keys and configuration
		$widgets = [
			// Standard widgets (auto-generated file names)
			'topppa_logo_widget' => 'TOPPPA_Logo_Widget',
			'topppa_header_info_widget' => 'TOPPPA_Header_Info_Widget',
			'topppa_button_widget' => 'TOPPPA_Button_Widget',
			'topppa_social_widget' => 'TOPPPA_Social_Widget',
			'topppa_header_menu_widget' => 'TOPPPA_Header_Menu_Widget',
			'topppa_service_widget' => 'TOPPPA_Service_Widget',
			'topppa_counter_widget' => 'TOPPPA_Counter_Widget',
			'topppa_testimonial_widget' => 'TOPPPA_Testimonial_Widget',
			'topppa_brand_logo_widget' => 'TOPPPA_Brand_Logo_Widget',
			'topppa_blog_widget' => 'TOPPPA_Blog_Widget',
			'topppa_breadcrumb_widget' => 'TOPPPA_Breadcrumb_Widget',
			'topppa_list_item_widget' => 'TOPPPA_List_Item_Widget',
			'topppa_faq_widget' => 'TOPPPA_Faq_Widget',
			'topppa_team_widget' => 'TOPPPA_Team_Widget',
			'topppa_icon_box_widget' => 'TOPPPA_Icon_Box_Widget',
			'topppa_item_box_widget' => 'TOPPPA_Item_Box_Widget',
			'topppa_contact_form_widget' => 'TOPPPA_Contact_Form_Widget',
			'topppa_image_widget' => 'TOPPPA_Image_Widget',
			'topppa_video_button_widget' => 'TOPPPA_Video_Button_Widget',
			'topppa_advanced_tab_widget' => 'TOPPPA_Advanced_Tab_Widget',
			'topppa_pricing_table_widget' => 'TOPPPA_Pricing_Table_Widget',
			'topppa_post_title_widget' => 'TOPPPA_Post_Title_Widget',
			'topppa_page_title_widget' => 'TOPPPA_Page_Title_Widget',
			'topppa_post_image_widget' => 'TOPPPA_Post_Image_Widget',
			'topppa_post_meta_widget' => 'TOPPPA_Post_Meta_Widget',
			'topppa_post_content_widget' => 'TOPPPA_Post_Content_Widget',
			'topppa_post_share_widget' => 'TOPPPA_Post_Share_Widget',
			'topppa_post_tags_widget' => 'TOPPPA_Post_Tags_Widget',
			'topppa_shop_widget' => 'TOPPPA_Shop_Widget',
			'topppa_slider_widget' => 'TOPPPA_Slider_Widget',
			'topppa_countdown_widget' => 'TOPPPA_Countdown_Widget',
			'topppa_gallery_widget' => 'TOPPPA_Gallery_Widget',
			'topppa_product_thumbnail_widget' => 'TOPPPA_Product_Thumbnail_Widget',
			'topppa_product_price_widget' => 'TOPPPA_Product_Price_Widget',
			'topppa_product_rating_and_review_widget' => 'TOPPPA_Product_Rating_And_Reviews_Widget',
			'topppa_product_title_widget' => 'TOPPPA_Product_Title_Widget',
			'topppa_product_cart_button_widget' => 'TOPPPA_Product_Cart_Button_Widget',
			'topppa_product_categories_tags_widget' => 'TOPPPA_Product_Categories_Tags_Widget',
			'topppa_accordion_image_widget' => 'TOPPPA_Accordion_Image_Widget',
			'topppa_product_description_widget' => 'TOPPPA_Product_Description_Widget',
			'topppa_product_additional_info_widget' => 'TOPPPA_Product_Additional_Info_Widget',
			'topppa_product_review_comment_widget' => 'TOPPPA_Product_Review_Comment_Widget',
			'topppa_product_mini_cart_button_widget' => 'TOPPPA_Product_Mini_Cart_Button_Widget',
			'topppa_flip_box_widget' => 'TOPPPA_Flip_Box_Widget',
			'topppa_hotspot_widget' => 'TOPPPA_Hotspot_Widget',
			'topppa_mailchimp_widget' => 'TOPPPA_Mailchimp_Widget',
			'topppa_post_comment_widget' => 'TOPPPA_Post_comment_Widget',
			'topppa_product_cart_page_widget' => 'TOPPPA_Product_Cart_Page_Widget',
			'topppa_product_checkout_page_widget' => 'TOPPPA_Product_Checkout_Page_Widget',
			'topppa_progress_bar_widget' => 'TOPPPA_Progress_Bar_Widget',
			'topppa_search_box_widget' => 'TOPPPA_Search_Box_Widget',
			'topppa_timeline_widget' => 'TOPPPA_Timeline_Widget',
			'topppa_weform_widget' => 'TOPPPA_WeForm_Widget',
			'topppa_wp_forms_widget' => 'TOPPPA_Wp_Forms_Widget',
			'topppa_heading_widget' => 'TOPPPA_Heading_Widget',
			'topppa_audio_player_widget' => 'TOPPPA_Audio_Player_Widget',
			'topppa_image_slider_widget' => 'TOPPPA_Image_Slider_Widget',
			'topppa_service_slider_widget' => 'TOPPPA_Service_Slider_Widget',
			'topppa_toggle_widget' => 'TOPPPA_Toggle_Widget',
			'topppa_trade_coin_widget' => 'TOPPPA_Trade_Coin_Widget',
			'topppa_data_table_widget' => 'TOPPPA_Data_Table_Widget',

			// trip
			'topppa_trip_search_widget' => 'TOPPPA_Trip_Search_Widget',
			'topppa_trip_taxonomy_module_widget' => 'TOPPPA_Trip_Taxonomy_Module_Widget',
			'topppa_trip_module_widget' => 'TOPPPA_Trip_Module_Widget',
			'topppa_trip_module_v2_widget' => 'TOPPPA_Trip_Module_v2_Widget',

			'topppa_trip_activities_module_widget' => 'TOPPPA_Trip_Activities_Module_Widget',
			'topppa_trip_activities_taxonomy_widget' => 'TOPPPA_Trip_Activities_Taxonomy_Widget',
			'topppa_trip_activities_tab_module_widget' => 'TOPPPA_Trip_Activities_Tab_Module_Widget',
			'topppa_trip_activities_accordion_widget' => 'TOPPPA_Trip_Activities_Accordion_Widget',
			'topppa_trip_activities_grid_widget' => 'TOPPPA_Trip_Activities_Grid_Widget',

			'topppa_trip_types_module_widget' => 'TOPPPA_Trip_Types_Module_Widget',
			'topppa_trip_types_taxonomy_widget' => 'TOPPPA_Trip_Types_Taxonomy_Widget',
			'topppa_trip_types_tab_module_widget' => 'TOPPPA_Trip_Types_Tab_Module_Widget',

			'topppa_trip_destination_module_widget' => 'TOPPPA_Trip_Destination_Module_Widget',
			'topppa_trip_destination_taxonomy_widget' => 'TOPPPA_Trip_Destination_Taxonomy_Widget',
			'topppa_trip_destination_tab_module_widget' => 'TOPPPA_Trip_Destination_Tab_Module_Widget',
			'topppa_trip_destination_tab_v2_module_widget' => 'TOPPPA_Trip_Destination_Tab_V2_Module_Widget',
			'topppa_trip_destination_tab_v3_module_widget' => 'TOPPPA_Trip_Destination_Tab_V3_Module_Widget',
			// end trip
			'topppa_dropdown_taxonomy_widget' => 'TOPPPA_Dropdown_Taxonomy_Widget',
			'topppa_text_reveal_widget' => 'TOPPPA_Text_Reveal_Widget',
			'topppa_image_tab_widget' => 'TOPPPA_Image_Tab_Widget',
			'topppa_slider_v2_widget' => 'TOPPPA_Slider_V2_Widget',
			'topppa_slider_v3_widget' => 'TOPPPA_Slider_V3_Widget',
			'topppa_marquee_widget' => 'TOPPPA_Marquee_Widget',
			'topppa_vertical_marquee_widget' => 'TOPPPA_Vertical_Marquee_Widget',
			'topppa_animated_slider_widget' => 'TOPPPA_Animated_Slider_Widget',
			'topppa_sticky_header_widget' => 'TOPPPA_Sticky_Header_Widget',
			'topppa_accordion_service_widget' => 'TOPPPA_Accordion_Service_Widget',
			'topppa_hero_banner_one_widget' => 'TOPPPA_Hero_Banner_One_Widget',
			// Special cases with custom file names or namespaces
			'topppa_mega_menu' => [
				'class' => 'TopperPack\Widgets\TOPPPA_Mega_Menu_Widget',
				'file' => 'topppa-mega-menu-widget.php'
			],

		];

		foreach ($widgets as $option_key => $widget_config) {
			if ('yes' !== get_option($option_key)) {
				continue;
			}

			// Handle both simple and complex configurations
			$widget_class = is_array($widget_config) ? $widget_config['class'] : $widget_config;
			$file_name = is_array($widget_config) ? $widget_config['file'] : strtolower(str_replace('_', '-', $option_key)) . '.php';

			$file_path = TOPPPA_WIDGETS_PATH . $file_name;

			if (!file_exists($file_path)) {
				continue;
			}

			require_once($file_path);

			if (!class_exists($widget_class)) {
				continue;
			}

			$widgets_manager->register(new $widget_class());
		}
	}

	/**
	 * Register Extensions
	 *
	 * Load extension files.
	 *
	 */

	function topppa_register_extensions() {

		if ('yes' === get_option('topppa_sticky_section')) {
			require_once(TOPPPA_EXTENSIONS_PATH . 'sticky-section.php');
		}

		if ('yes' === get_option('topppa_scroll_to_top')) {
			require_once(TOPPPA_EXTENSIONS_PATH . 'scroll-to-top/scroll-to-top.php');
		}

		if ('yes' === get_option('topppa_custom_css')) {
			require_once(TOPPPA_EXTENSIONS_PATH . 'custom-css.php');
		}

		if ('yes' === get_option('topppa_container_hover_effects')) {
			require_once(TOPPPA_EXTENSIONS_PATH . 'hover-effect.php');
		}

		if ('yes' === get_option('interactive_animations')) {
			require_once(TOPPPA_EXTENSIONS_PATH . 'interactive-animations.php');
		}

		if ('yes' === get_option('topppa_tooltip_section')) {
			require_once(TOPPPA_EXTENSIONS_PATH . 'tooltip.php');
		}

		if ('yes' === get_option('topppa_motion_text')) {
			require_once(TOPPPA_EXTENSIONS_PATH . 'motion-text.php');
		}
		if ('yes' === get_option('topppa_dots_particle_animation')) {
			require_once(TOPPPA_EXTENSIONS_PATH . 'dots-particale-animation.php');
		}

		if ('yes' === get_option('topppa_wrapper_link')) {
			require_once(TOPPPA_EXTENSIONS_PATH . 'wrapper-link.php');
		}

		if ('yes' === get_option('topppa_conditional_display')) {
			require_once(TOPPPA_EXTENSIONS_PATH . 'conditional-display/conditional-display.php');
		}

		if ('yes' === get_option('topppa_hover_image_viewer')) {
			require_once(TOPPPA_EXTENSIONS_PATH . 'hover-image-viewer.php');
		}
	}

	/**
	 * Include Files
	 *
	 * Load files.
	 *
	 * Fired by `elementor/init` action hook.
	 *
	 * @param \Elementor\Controls_Manager $controls_manager Elementor controls manager.
	 */
	public function topppa_include_files() {
		require_once TOPPPA_ADMIN_PATH . 'dashboard.php';
		require_once(TOPPPA_INC_PATH . 'controls/init.php');
		require_once(TOPPPA_INC_PATH . 'helper.php');
		require_once(TOPPPA_INC_PATH . 'utilities.php');
		require_once(TOPPPA_PATH . 'traits/traits.php');
		require_once(TOPPPA_INC_PATH . 'theme-builder/class-theme-builder.php');
		if ('yes' === get_option('topppa_product_mini_cart_button_widget')) {
			require_once(TOPPPA_INC_PATH . 'woocommerce/class-topppa-woo-mini-cart.php');
			require_once(TOPPPA_INC_PATH . 'woocommerce/class-woocommerce-config.php');
		}

		// Load the base trait first — REQUIRED
		require_once TOPPPA_PATH . 'traits/global-component.php';

		/**
		 * Load Pro Classes and Traits
		 */
		if (defined('TOPPPA_PRO_PATH')) {

			// Load classes
			$pro_classes = [
				'includes/class-element-base.php',
				'includes/class-nested-element-base.php',
			];

			foreach ($pro_classes as $class_file) {
				$file_path = TOPPPA_PRO_PATH . $class_file;
				if (file_exists($file_path)) {
					require_once $file_path;
				}
			}

			// Load traits
			$pro_traits = [
				'traits/carousel-component.php',
				'traits/animation-component.php',
				'traits/item-style-component.php',
				'traits/global-component.php',
			];

			foreach ($pro_traits as $trait_file) {
				$file_path = TOPPPA_PRO_PATH . $trait_file;
				if (file_exists($file_path)) {
					require_once $file_path;
				}
			}
		}
		// Then load the conditional trait loader
		require_once TOPPPA_INC_PATH . 'trait-global-component-loader.php';

		// Load Features
		$features = [
			'topppa_custom_icon' => 'custom-icon/init.php',
			'topppa_smooth_scroller' => 'smooth-scroller/init.php',
			'topppa_mega_menu' => 'mega-menu/init.php',
			'topppa_template_library' => 'template-library/init.php',
		];

		foreach ($features as $option => $path) {
			if ('yes' === get_option($option)) {
				require_once TOPPPA_INC_PATH . $path;
			}
		}

		// Load Settings Import/Export (always available)
		require_once TOPPPA_INC_PATH . 'settings-import/init.php';

		//Load Ready Site Importer (always available)
		if (file_exists(TOPPPA_INC_PATH . 'import/class-ready-site-importer.php')) {
			require_once TOPPPA_INC_PATH . 'import/class-ready-site-importer.php';
		}

		// Initialize import functionality
		if (file_exists(TOPPPA_INC_PATH . 'import/init.php')) {
			require_once TOPPPA_INC_PATH . 'import/init.php';
		}
	}

	// Register CSS and JS files for Site
	public function topppa_register_assets() {

		// Bootstrap
		wp_register_style('bootstrap', TOPPPA_ASSETS_URL . 'vendor/bootstrap/bootstrap.min.css', [], TOPPPA_VER);
		wp_register_style('magnific-popup', TOPPPA_ASSETS_URL . 'vendor/magnific-popup/magnific-popup.css', [], TOPPPA_VER);
		wp_register_script('bootstrap', TOPPPA_ASSETS_URL . 'vendor/bootstrap/bootstrap.min.js', ['jquery'], TOPPPA_VER, true);
		wp_enqueue_style('magnific-popup');
		wp_enqueue_style('bootstrap');
		wp_enqueue_script('bootstrap');

		// swiper slider
		wp_register_script('appear-js', TOPPPA_ASSETS_URL . 'vendor/js/topppa-appear.min.js', ['jquery'], TOPPPA_VER, true);
		wp_register_script('count-to', TOPPPA_ASSETS_URL . 'vendor/js/count-to.js', ['jquery'], TOPPPA_VER, true);
		wp_register_script('counter-up', TOPPPA_ASSETS_URL . 'vendor/js/counterup.min.js', ['jquery'], TOPPPA_VER, true);
		wp_enqueue_script('appear-js');
		wp_enqueue_script('counter-up');
		wp_enqueue_script('count-to');

		wp_register_script('magnific-popup', TOPPPA_ASSETS_URL . 'vendor/magnific-popup/jquery.magnific-popup-min.js', ['jquery'], TOPPPA_VER, true);
		wp_register_script('topppa-slider-widget', TOPPPA_ASSETS_URL . 'js/widgets/topppa-slider-widget.min.js', ['jquery', 'magnific-popup'], TOPPPA_VER, true);
		wp_enqueue_script('magnific-popup');


		// Register GSAP as a core dependency
		wp_register_script('gsap', TOPPPA_ASSETS_URL . 'vendor/gsap/gsap.min.js', [], TOPPPA_VER, true);
		// Force footer placement even if another plugin registered same handle earlier
		wp_script_add_data('gsap', 'group', 1);
		wp_enqueue_script('gsap');

		// Load ScrollTrigger for features/widgets that need it
		if (
			'yes' === get_option('topppa_cursor_effect') ||
			'yes' === get_option('topppa_smooth_scroller') ||
			'yes' === get_option('topppa_text_reveal_widget')
		) {
			wp_register_script('ScrollTrigger', TOPPPA_ASSETS_URL . 'vendor/gsap/ScrollTrigger.min.js', ['gsap'], TOPPPA_VER, true);
			wp_script_add_data('ScrollTrigger', 'group', 1);
			wp_enqueue_script('ScrollTrigger');
		}

		wp_register_script('swiper', TOPPPA_ASSETS_URL . 'vendor/swiper/swiper-bundle.min.js', ['jquery'], TOPPPA_VER, true);
		wp_register_script('topppa-swiper-script', TOPPPA_ASSETS_URL . 'vendor/swiper/topppa-swiper-script.min.js', ['jquery', 'swiper'], TOPPPA_VER, true);
		wp_register_style('swiper', TOPPPA_ASSETS_URL . 'vendor/swiper/swiper-bundle.min.css', [], TOPPPA_VER);
		wp_enqueue_script('swiper');
		wp_enqueue_script('topppa-swiper-script');
		wp_enqueue_style('swiper');


		wp_register_style('fontawesome', TOPPPA_ASSETS_URL . 'vendor/fontawesome/fontawesome.min.css', [], TOPPPA_VER, false);
		wp_enqueue_style('fontawesome');


		if ('yes' === get_option('topppa_sticky_section')) {
			wp_register_style('topppa-sticky-section', TOPPPA_ASSETS_URL . 'css/extensions/topppa-sticky-section.css', [], TOPPPA_VER);
			wp_register_script('topppa-sticky-section', TOPPPA_ASSETS_URL . 'js/extensions/topppa-sticky-section.min.js', ['jquery'], TOPPPA_VER, true);
			wp_enqueue_style('topppa-sticky-section');
			wp_enqueue_script('topppa-sticky-section');
		}
		if ('yes' === get_option('topppa_assets_manager')) {
			wp_register_style('topppa-site-style', TOPPPA_ASSETS_URL . 'css/topppa-site-style.css', [], TOPPPA_VER);
			wp_register_script('topppa-site-script', TOPPPA_ASSETS_URL . 'js/topppa-site-script.min.js', ['jquery'], TOPPPA_VER, true);
			wp_enqueue_style('topppa-site-style');
			wp_enqueue_script('topppa-site-script');
		} else {
			wp_register_style('topppa-all-style', TOPPPA_ASSETS_URL . 'css/topppa-all-style.css', [], TOPPPA_VER);
			wp_register_script('topppa-all-script', TOPPPA_ASSETS_URL . 'js/topppa-all-script.min.js', ['jquery', 'gsap'], TOPPPA_VER, true);
			wp_enqueue_style('topppa-all-style');
			wp_enqueue_script('topppa-all-script');
		}

		// Enqueue WooCommerce styles on WooCommerce pages
		if (class_exists('WooCommerce') && (is_woocommerce() || is_cart() || is_checkout() || is_account_page())) {
			wp_register_style('topppa-woocommerce', TOPPPA_ASSETS_URL . 'css/woocommerce/topppa-woocommerce.css', [], TOPPPA_VER);
			wp_enqueue_style('topppa-woocommerce');
		}
	}

	// Conditionally enqueue assets based on widget usage
	public function topppa_load_assets() {

		$css_output = '';
		$js_output = '';

		// Always start with empty files to prevent accumulation
		file_put_contents(TOPPPA_ASSETS_PATH . 'css/topppa-site-style.css', '');
		file_put_contents(TOPPPA_ASSETS_PATH . 'js/topppa-site-script.min.js', '');

		// Widgets Assets
		if ('yes' === get_option('topppa_logo_widget')) {
			$css_output .= file_get_contents(TOPPPA_ASSETS_PATH . 'css/widgets/topppa-logo-widget.css');
		}

		if ('yes' === get_option('topppa_header_info_widget')) {
			$css_output .= file_get_contents(TOPPPA_ASSETS_PATH . 'css/widgets/topppa-header-info-widget.css');
		}

		if ('yes' === get_option('topppa_button_widget')) {
			$css_output .= file_get_contents(TOPPPA_ASSETS_PATH . 'css/widgets/topppa-button-widget.css');
			$js_output .= file_get_contents(TOPPPA_ASSETS_PATH . 'js/widgets/topppa-button-widget.min.js');
		}

		if ('yes' === get_option('topppa_social_widget')) {
			$css_output .= file_get_contents(TOPPPA_ASSETS_PATH . 'css/widgets/topppa-social-widget.css');
		}

		if ('yes' === get_option('topppa_header_menu_widget')) {
			$css_output .= file_get_contents(TOPPPA_ASSETS_PATH . 'css/widgets/topppa-header-menu-widget.css');
			$js_output .= file_get_contents(TOPPPA_ASSETS_PATH . 'js/widgets/topppa-header-menu-widget.min.js');
		}
		if ('yes' === get_option('topppa_breadcrumb_widget')) {
			$css_output .= file_get_contents(TOPPPA_ASSETS_PATH . 'css/widgets/topppa-breadcrumb-widget.css');
		}
		if ('yes' === get_option('topppa_service_widget')) {
			$css_output .= file_get_contents(TOPPPA_ASSETS_PATH . 'css/widgets/topppa-service-widget.css');
		}

		if ('yes' === get_option('topppa_testimonial_widget')) {
			$css_output .= file_get_contents(TOPPPA_ASSETS_PATH . 'css/widgets/topppa-testimonial-widget.css');
		}

		if ('yes' === get_option('topppa_brand_logo_widget')) {
			$css_output .= file_get_contents(TOPPPA_ASSETS_PATH . 'css/widgets/topppa-brand-logo-widget.css');
		}

		if ('yes' === get_option('topppa_mega_menu')) {
			$js_output .= file_get_contents(TOPPPA_ASSETS_PATH . 'js/widgets/topppa-mega-menu-widget.min.js');
			$css_output .= file_get_contents(TOPPPA_ASSETS_PATH . 'css/widgets/topppa-mega-menu-widget.css');
		}

		if ('yes' === get_option('topppa_counter_widget')) {
			$js_output .= file_get_contents(TOPPPA_ASSETS_PATH . 'js/widgets/topppa-counter-widget.min.js');
			$css_output .= file_get_contents(TOPPPA_ASSETS_PATH . 'css/widgets/topppa-counter-widget.css');
		}

		if ('yes' === get_option('topppa_blog_widget')) {
			$js_output .= file_get_contents(TOPPPA_ASSETS_PATH . 'js/widgets/topppa-blog-widget.min.js');
			$css_output .= file_get_contents(TOPPPA_ASSETS_PATH . 'css/widgets/topppa-blog-widget.css');
		}

		if ('yes' === get_option('topppa_list_item_widget')) {
			$css_output .= file_get_contents(TOPPPA_ASSETS_PATH . 'css/widgets/topppa-list-item-widget.css');
		}

		if ('yes' === get_option('topppa_item_box_widget')) {
			$css_output .= file_get_contents(TOPPPA_ASSETS_PATH . 'css/widgets/topppa-item-box-widget.css');
		}

		if ('yes' === get_option('topppa_icon_box_widget')) {
			$css_output .= file_get_contents(TOPPPA_ASSETS_PATH . 'css/widgets/topppa-icon-box-widget.css');
		}

		if ('yes' === get_option('topppa_contact_form_widget')) {
			$css_output .= file_get_contents(TOPPPA_ASSETS_PATH . 'css/widgets/topppa-contact-form-widget.css');
		}

		if ('yes' === get_option('topppa_image_widget')) {
			$css_output .= file_get_contents(TOPPPA_ASSETS_PATH . 'css/widgets/topppa-image-widget.css');
			$js_output .= file_get_contents(TOPPPA_ASSETS_PATH . 'js/widgets/topppa-image-widget.min.js');
		}

		if ('yes' === get_option('topppa_video_button_widget')) {
			$css_output .= file_get_contents(TOPPPA_ASSETS_PATH . 'css/widgets/topppa-video-button-widget.css');
			$js_output .= file_get_contents(TOPPPA_ASSETS_PATH . 'js/widgets/topppa-video-button-widget.min.js');
		}

		if ('yes' === get_option('topppa_advanced_tab_widget')) {
			$css_output .= file_get_contents(TOPPPA_ASSETS_PATH . 'css/widgets/topppa-advanced-tab-widget.css');
		}

		if ('yes' === get_option('topppa_pricing_table_widget')) {
			$css_output .= file_get_contents(TOPPPA_ASSETS_PATH . 'css/widgets/topppa-pricing-table-widget.css');
		}

		if ('yes' === get_option('topppa_faq_widget')) {
			$css_output .= file_get_contents(TOPPPA_ASSETS_PATH . 'css/widgets/topppa-faq-widget.css');
		}
		if ('yes' === get_option('topppa_post_title_widget')) {
			$css_output .= file_get_contents(TOPPPA_ASSETS_PATH . 'css/widgets/topppa-post-title-widget.css');
		}
		if ('yes' === get_option('topppa_page_title_widget')) {
			$css_output .= file_get_contents(TOPPPA_ASSETS_PATH . 'css/widgets/topppa-page-title-widget.css');
		}
		if ('yes' === get_option('topppa_post_meta_widget')) {
			$css_output .= file_get_contents(TOPPPA_ASSETS_PATH . 'css/widgets/topppa-post-meta-widget.css');
		}
		if ('yes' === get_option('topppa_post_content_widget')) {
			$css_output .= file_get_contents(TOPPPA_ASSETS_PATH . 'css/widgets/topppa-post-content-widget.css');
		}
		if ('yes' === get_option('topppa_post_share_widget')) {
			$css_output .= file_get_contents(TOPPPA_ASSETS_PATH . 'css/widgets/topppa-post-share-widget.css');
			$js_output .= file_get_contents(TOPPPA_ASSETS_PATH . 'js/widgets/topppa-post-share.min.js');
		}
		if ('yes' === get_option('topppa_post_tags_widget')) {
			$css_output .= file_get_contents(TOPPPA_ASSETS_PATH . 'css/widgets/topppa-post-tags-widget.css');
		}


		if ('yes' === get_option('topppa_team_widget')) {
			$css_output .= file_get_contents(TOPPPA_ASSETS_PATH . 'css/widgets/topppa-team-widget.css');
		}
		if ('yes' === get_option('topppa_heading_widget')) {
			$css_output .= file_get_contents(TOPPPA_ASSETS_PATH . 'css/widgets/topppa-heading-widget.css');
			$js_output .= file_get_contents(TOPPPA_ASSETS_PATH . 'js/widgets/topppa-heading-widget.min.js');
		}

		if ('yes' === get_option('topppa_flip_box_widget')) {
			$css_output .= file_get_contents(TOPPPA_ASSETS_PATH . 'css/widgets/topppa-flip-box-widget.css');
			$js_output .= file_get_contents(TOPPPA_ASSETS_PATH . 'js/widgets/topppa-flip-box-widget.min.js');
		}
		if ('yes' === get_option('topppa_slider_widget')) {
			$css_output .= file_get_contents(TOPPPA_ASSETS_PATH . 'css/widgets/topppa-slider-widget.css');
			$js_output .= file_get_contents(TOPPPA_ASSETS_PATH . 'js/widgets/topppa-slider-widget.min.js');
		}
		if ('yes' === get_option('topppa_countdown_widget')) {
			$css_output .= file_get_contents(TOPPPA_ASSETS_PATH . 'css/widgets/topppa-countdown-widget.css');
			$js_output .= file_get_contents(TOPPPA_ASSETS_PATH . 'js/widgets/topppa-countdown.min.js');
		}
		if ('yes' === get_option('topppa_gallery_widget')) {
			$css_output .= file_get_contents(TOPPPA_ASSETS_PATH . 'css/widgets/topppa-gallery-widget.css');
		}
		if ('yes' === get_option('topppa_hotspot_widget')) {
			$css_output .= file_get_contents(TOPPPA_ASSETS_PATH . 'css/widgets/topppa-hotspot-widget.css');
			$js_output .= file_get_contents(TOPPPA_ASSETS_PATH . 'js/widgets/topppa-hotspot-widget.min.js');
		}
		if ('yes' === get_option('topppa_timeline_widget')) {
			$js_output .= file_get_contents(TOPPPA_ASSETS_PATH . 'js/widgets/topppa-timeline-widget.min.js');
			$css_output .= file_get_contents(TOPPPA_ASSETS_PATH . 'css/widgets/topppa-timeline-widget.css');
		}
		if ('yes' === get_option('topppa_shop_widget')) {
			$css_output .= file_get_contents(TOPPPA_ASSETS_PATH . 'css/widgets/topppa-shop-widget.css');
			$js_output .= file_get_contents(TOPPPA_ASSETS_PATH . 'js/widgets/topppa-shop-widget.min.js');
		}
		if ('yes' === get_option('topppa_product_thumbnail_widget')) {
			$css_output .= file_get_contents(TOPPPA_ASSETS_PATH . 'css/widgets/topppa-product-thumbnail-widget.css');
			$js_output .= file_get_contents(TOPPPA_ASSETS_PATH . 'js/widgets/topppa-product-thumbnail-widget.min.js');
		}
		if ('yes' === get_option('topppa_product_price_widget')) {
			$css_output .= file_get_contents(TOPPPA_ASSETS_PATH . 'css/widgets/topppa-product-price-widget.css');
		}
		if ('yes' === get_option('topppa_product_title_widget')) {
			$css_output .= file_get_contents(TOPPPA_ASSETS_PATH . 'css/widgets/topppa-product-title-widget.css');
		}
		if ('yes' === get_option('topppa_product_cart_button_widget')) {
			$css_output .= file_get_contents(TOPPPA_ASSETS_PATH . 'css/widgets/topppa-product-cart-button-widget.css');
		}
		if ('yes' === get_option('topppa_product_categories_tags_widget')) {
			$css_output .= file_get_contents(TOPPPA_ASSETS_PATH . 'css/widgets/topppa-product-categories-tags-widget.css');
		}
		if ('yes' === get_option('topppa_product_review_comment_widget')) {
			$css_output .= file_get_contents(TOPPPA_ASSETS_PATH . 'css/widgets/topppa-product-review-comment-widget.css');
		}
		if ('yes' === get_option('topppa_product_checkout_page_widget')) {
			$css_output .= file_get_contents(TOPPPA_ASSETS_PATH . 'css/widgets/topppa-product-checkout-page-widget.css');
		}
		if ('yes' === get_option('topppa_product_cart_page_widget')) {
			$css_output .= file_get_contents(TOPPPA_ASSETS_PATH . 'css/widgets/topppa-product-cart-page-widget.css');
		}
		if ('yes' === get_option('topppa_product_mini_cart_button_widget')) {
			$css_output .= file_get_contents(TOPPPA_ASSETS_PATH . 'css/widgets/topppa-product-mini-cart-button-widget.css');
			$js_output .= file_get_contents(TOPPPA_ASSETS_PATH . 'js/widgets/topppa-product-mini-cart-button-widget.min.js');
		}
		if ('yes' === get_option('topppa_mailchimp_widget')) {
			$css_output .= file_get_contents(TOPPPA_ASSETS_PATH . 'css/widgets/topppa-mailchimp-widget.css');
		}

		if ('yes' === get_option('topppa_progress_bar_widget')) {
			$css_output .= file_get_contents(TOPPPA_ASSETS_PATH . 'css/widgets/topppa-progress-bar-widget.css');
		}
		if ('yes' === get_option('topppa_accordion_image_widget')) {
			$js_output .= file_get_contents(TOPPPA_ASSETS_PATH . 'js/widgets/topppa-accordion-image.min.js');
			$css_output .= file_get_contents(TOPPPA_ASSETS_PATH . 'css/widgets/topppa-accordion-image-widget.css');
		}

		if ('yes' === get_option('topppa_audio_player_widget')) {
			$css_output .= file_get_contents(TOPPPA_ASSETS_PATH . 'css/widgets/topppa-audio-player-widget.css');
		}

		if ('yes' === get_option('topppa_image_slider_widget')) {
			$js_output .= file_get_contents(TOPPPA_ASSETS_PATH . 'js/widgets/topppa-image-slider-widget.min.js');
			$css_output .= file_get_contents(TOPPPA_ASSETS_PATH . 'css/widgets/topppa-image-slider-widget.css');
		}

		if ('yes' === get_option('topppa_service_slider_widget')) {
			$css_output .= file_get_contents(TOPPPA_ASSETS_PATH . 'css/widgets/topppa-service-slider-widget.css');
		}

		if ('yes' === get_option('topppa_toggle_widget')) {
			$css_output .= file_get_contents(TOPPPA_ASSETS_PATH . 'css/widgets/topppa-toggle-widget.css');
		}

		if ('yes' === get_option('topppa_text_reveal_widget')) {
			$js_output .= file_get_contents(TOPPPA_ASSETS_PATH . 'js/widgets/topppa-text-reveal-widget.min.js');
			$css_output .= file_get_contents(TOPPPA_ASSETS_PATH . 'css/widgets/topppa-text-reveal-widget.css');
		}

		if ('yes' === get_option('topppa_image_tab_widget')) {
			$css_output .= file_get_contents(TOPPPA_ASSETS_PATH . 'css/widgets/topppa-image-tab-widget.css');
			$js_output .= file_get_contents(TOPPPA_ASSETS_PATH . 'js/widgets/topppa-image-tab-widget.min.js');
		}

		if ('yes' === get_option('topppa_slider_v2_widget')) {
			$css_output .= file_get_contents(TOPPPA_ASSETS_PATH . 'css/widgets/topppa-slider-v2-widget.css');
			$js_output .= file_get_contents(TOPPPA_ASSETS_PATH . 'js/widgets/topppa-slider-v2-widget.min.js');
		}
		if ('yes' === get_option('topppa_slider_v3_widget')) {
			$css_output .= file_get_contents(TOPPPA_ASSETS_PATH . 'css/widgets/topppa-slider-v3-widget.css');
			$js_output .= file_get_contents(TOPPPA_ASSETS_PATH . 'js/widgets/topppa-slider-v3-widget.min.js');
		}

		if ('yes' === get_option('topppa_marquee_widget')) {
			$css_output .= file_get_contents(TOPPPA_ASSETS_PATH . 'css/widgets/topppa-marquee-widget.css');
			$js_output .= file_get_contents(TOPPPA_ASSETS_PATH . 'js/widgets/topppa-marquee-widget.min.js');
		}

		if ('yes' === get_option('topppa_vertical_marquee_widget')) {
			$css_output .= file_get_contents(TOPPPA_ASSETS_PATH . 'css/widgets/topppa-vertical-marquee-widget.css');
			$js_output .= file_get_contents(TOPPPA_ASSETS_PATH . 'js/widgets/topppa-vertical-marquee-widget.min.js');
		}

		if ('yes' === get_option('topppa_trade_coin_widget')) {
			$css_output .= file_get_contents(TOPPPA_ASSETS_PATH . 'css/widgets/topppa-trade-coin-widget.css');
			$js_output .= file_get_contents(TOPPPA_ASSETS_PATH . 'js/widgets/topppa-trade-coin-widget.min.js');
		}

		if ('yes' === get_option('topppa_search_box_widget')) {
			$css_output .= file_get_contents(TOPPPA_ASSETS_PATH . 'css/widgets/topppa-search-box-widget.css');
		}
		if ('yes' === get_option('topppa_data_table_widget')) {
			$css_output .= file_get_contents(TOPPPA_ASSETS_PATH . 'css/widgets/topppa-data-table-widget.css');
		}

		if ('yes' === get_option('topppa_dropdown_taxonomy_widget')) {
			$css_output .= file_get_contents(TOPPPA_ASSETS_PATH . 'css/widgets/topppa-dropdown-taxonomy-widget.css');
			$js_output .= file_get_contents(TOPPPA_ASSETS_PATH . 'js/widgets/topppa-dropdown-taxonomy-widget.min.js');
		}

		if ('yes' === get_option('topppa_animated_slider_widget')) {
			$css_output .= file_get_contents(TOPPPA_ASSETS_PATH . 'css/widgets/topppa-animated-slider-widget.css');
			$js_output .= file_get_contents(TOPPPA_ASSETS_PATH . 'js/widgets/topppa-animated-slider.min.js');
		}

		if ('yes' === get_option('topppa_sticky_header_widget')) {
			$css_output .= file_get_contents(TOPPPA_ASSETS_PATH . 'css/widgets/topppa-sticky-header-widget.css');
		}
		if ('yes' === get_option('topppa_accordion_service_widget')) {
			$css_output .= file_get_contents(TOPPPA_ASSETS_PATH . 'css/widgets/topppa-accordion-service-widget.css');
			$js_output .= file_get_contents(TOPPPA_ASSETS_PATH . 'js/widgets/topppa-accordion-service-widget.min.js');
		}
		if ('yes' === get_option('topppa_hero_banner_one_widget')) {
			$css_output .= file_get_contents(TOPPPA_ASSETS_PATH . 'css/widgets/topppa-hero-banner-one-widget.css');
			$js_output .= file_get_contents(TOPPPA_ASSETS_PATH . 'js/widgets/topppa-hero-banner-one-widget.min.js');
		}
		// trip
		if (
			'yes' === get_option('topppa_trip_taxonomy_module_widget') ||
			'yes' === get_option('topppa_trip_destination_taxonomy_widget') ||
			'yes' === get_option('topppa_trip_activities_taxonomy_widget') ||
			'yes' === get_option('topppa_trip_types_taxonomy_widget')
		) {
			$css_output .= file_get_contents(TOPPPA_ASSETS_PATH . 'css/widgets/topppa-trip-tex-module-widget.css');
		}
		if (
			'yes' === get_option('topppa_trip_activities_grid_widget')
		) {
			$css_output .= file_get_contents(TOPPPA_ASSETS_PATH . 'css/widgets/topppa-trip-activities-grid-widget.css');
			$js_output .= file_get_contents(TOPPPA_ASSETS_PATH . 'js/widgets/topppa-trip-activities-grid-widget.min.js');
		}
		if (
			'yes' === get_option('topppa_trip_module_widget') ||
			'yes' === get_option('topppa_trip_activities_tab_module_widget') ||
			'yes' === get_option('topppa_trip_types_tab_module_widget')
		) {
			$css_output .= file_get_contents(TOPPPA_ASSETS_PATH . 'css/widgets/topppa-trip-tab-module-widget.css');
		}
		if ('yes' === get_option('topppa_trip_activities_accordion_widget')) {
			$css_output .= file_get_contents(TOPPPA_ASSETS_PATH . 'css/widgets/topppa-trip-activities-accordion-widget.css');
			$js_output .= file_get_contents(TOPPPA_ASSETS_PATH . 'js/widgets/topppa-trip-activities-accordion-widget.min.js');
		}
		if ('yes' === get_option('topppa_trip_destination_tab_module_widget')) {
			$css_output .= file_get_contents(TOPPPA_ASSETS_PATH . 'css/widgets/topppa-trip-destination-tab-v1-widget.css');
			$js_output .= file_get_contents(TOPPPA_ASSETS_PATH . 'js/widgets/topppa-trip-destination-widget.min.js');
		}

		if (
			'yes' === get_option('topppa_trip_module_v2_widget') ||
			'yes' === get_option('topppa_trip_activities_module_widget') ||
			'yes' === get_option('topppa_trip_destination_module_widget') ||
			'yes' === get_option('topppa_trip_types_module_widget')
		) {
			$css_output .= file_get_contents(TOPPPA_ASSETS_PATH . 'css/widgets/topppa-trip-module-v2-widget.css');
			$js_output .= file_get_contents(TOPPPA_ASSETS_PATH . 'js/widgets/topppa-popup-widget.min.js');
		}

		if ('yes' === get_option('topppa_trip_types_tab_module_widget')) {
			$css_output .= file_get_contents(TOPPPA_ASSETS_PATH . 'css/widgets/topppa-trip-destination-tab-v2-widget.css');
		}
		if ('yes' === get_option('topppa_trip_destination_tab_v3_module_widget')) {
			$css_output .= file_get_contents(TOPPPA_ASSETS_PATH . 'css/widgets/topppa-trip-destination-tab-v3-widget.css');
		}

		if ('yes' === get_option('topppa_trip_search_widget')) {
			$css_output .= file_get_contents(TOPPPA_ASSETS_PATH . 'css/widgets/topppa-trip-search-widget.css');
		}

		// Extensions Assets
		if ('yes' === get_option('topppa_sticky_section')) {
			$css_output .= file_get_contents(TOPPPA_ASSETS_PATH . 'css/extensions/topppa-sticky-section.css');
			$js_output .= file_get_contents(TOPPPA_ASSETS_PATH . 'js/extensions/topppa-sticky-section.min.js');
		}

		if ('yes' === get_option('topppa_scroll_to_top')) {
			$css_output .= file_get_contents(TOPPPA_ASSETS_PATH . 'css/extensions/topppa-scroll-to-top.css');
		}

		if ('yes' === get_option('topppa_sticky_section')) {
			$js_output .= file_get_contents(TOPPPA_ASSETS_PATH . 'js/extensions/topppa-wrapper-link.min.js');
		}

		if ('yes' === get_option('interactive_animations')) {
			$css_output .= file_get_contents(TOPPPA_ASSETS_PATH . 'css/extensions/topppa-interactive-animations.css');
			$js_output .= file_get_contents(TOPPPA_ASSETS_PATH . 'js/extensions/interactive-animations.min.js');
		}

		if ('yes' === get_option('topppa_tooltip_section')) {
			$js_output .= file_get_contents(TOPPPA_ASSETS_PATH . 'js/extensions/topppa-tooltip.min.js');
		}

		if ('yes' === get_option('topppa_motion_text')) {
			$js_output .= file_get_contents(TOPPPA_ASSETS_PATH . 'js/extensions/topppa-motion-text.min.js');
		}
		if ('yes' === get_option('topppa_dots_particle_animation')) {
			$css_output .= file_get_contents(TOPPPA_ASSETS_PATH . 'css/extensions/topppa-dots-particle-animation.css');
			$js_output .= file_get_contents(TOPPPA_ASSETS_PATH . 'js/extensions/topppa-dots-particle-animation.min.js');
		}

		if ('yes' === get_option('topppa_hover_image_viewer')) {
			$css_output .= file_get_contents(TOPPPA_ASSETS_PATH . 'css/extensions/topppa-hover-image-viewer.css');
			$js_output .= file_get_contents(TOPPPA_ASSETS_PATH . 'js/extensions/topppa-hover-image-viewer.min.js');
		}

		// Combine CSS
		if ($css_output) {
			// Get the compiled global styles from the dedicated global-only CSS file
			$global_styles = file_get_contents(TOPPPA_ASSETS_PATH . 'css/topppa-global-only.css');
			$css_output = $global_styles . $css_output;
			file_put_contents(TOPPPA_ASSETS_PATH . 'css/topppa-site-style.css', $css_output);
		}

		// Combine JS
		if ($js_output) {
			file_put_contents(TOPPPA_ASSETS_PATH . 'js/topppa-site-script.min.js', $js_output);
		}
	}

	/**
	 * Add custom category.
	 *
	 * @param $elements_manager
	 */
	function topppa_widget_categories($elements_manager) {

		$elements_manager->add_category(
			'topper-pack',
			[
				'title' => esc_html__('Topper Pack', 'topper-pack'),
				'icon' => 'fa fa-plug',
			]
		);
	}

	/**
	 * Enqueue nested elements in editor
	 *
	 * @return void
	 */
	public function nested_elements() {
		if (defined('TOPPPA_PRO_ASSETS_URL')) {
			if (\Elementor\Plugin::instance()->editor->is_edit_mode()) {
				wp_enqueue_script('topppa-nested-elements', TOPPPA_PRO_ASSETS_URL . '/vendor/nested-elements/nested-elements.js', [], TOPPPA_VER, true);
			}
		}
	}


	/**
	 * Register assets for Elementor editor
	 *
	 * @return void
	 */
	public function topppa_register_editor_assets() {
		// Check if we're in Elementor editor mode
		if (\Elementor\Plugin::instance()->editor->is_edit_mode()) {
			// Enqueue Swiper for editor
			wp_enqueue_script('swiper', TOPPPA_ASSETS_URL . 'vendor/swiper/swiper-bundle.min.js', ['jquery'], TOPPPA_VER, true);
			wp_enqueue_script('topppa-swiper-script', TOPPPA_ASSETS_URL . 'vendor/swiper/topppa-swiper-script.js', ['jquery', 'swiper'], TOPPPA_VER, true);
			wp_enqueue_style('swiper', TOPPPA_ASSETS_URL . 'vendor/swiper/swiper-bundle.min.css', [], TOPPPA_VER);
		}
	}
}
