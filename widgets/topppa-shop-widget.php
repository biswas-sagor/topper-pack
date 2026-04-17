<?php

/**
 * Elementor topppa Shop Widget.
 *
 * @package TopperPack
 * @since 1.0.0
 */

use TopperPack\Trait_Loader\Global_Component_Loader;
use \TopperPack\Includes\Controls\Controls_Manager as TopperPack_Controls_Manager;
use Elementor\Controls_Manager;

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}

/**
 * Class TOPPPA_Shop_Widget
 *
 * @package TopperPack
 * @since 1.0.0
 */
class TOPPPA_Shop_Widget extends \Elementor\Widget_Base {

	/**
	 * Global Component Loader
	 *
	 * @package TopperPack
	 */
	use Global_Component_Loader;

	/**
	 * Get widget name.
	 *
	 * Retrieve widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'topppa_shop_widtget';
	}

	/**
	 * Get widget title.
	 *
	 * Retrieve widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget title.
	 */
	public function get_title() {
		return TOPPPA_EPWB . esc_html__('Shop', 'topper-pack');
	}

	/**
	 * Get widget icon.
	 *
	 * Retrieve widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-cart-light';
	}

	/**
	 * Get widget categories.
	 *
	 * Retrieve the list of categories the widget belongs to.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return array Widget categories.
	 */
	public function get_categories() {
		return ['topper-pack'];
	}

	/**
	 * Get widget keywords.
	 *
	 * Retrieve the list of keywords the widget belongs to.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return array Widget keywords.
	 */
	public function get_keywords() {
		return ['topppa', 'widget', 'shop', 'store', 'product', 'topperpack'];
	}

	/**
	 * Get custom help URL.
	 *
	 * Retrieve a URL where the user can get more information about the widget.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget help URL.
	 */
	public function get_custom_help_url() {
		return 'https://doc.topperpack.com/docs/woocommerce-widgets/shop/';
	}

	/**
	 * Get custom URL for image.
	 *
	 * Retrieve a URL where the user can get more information about the image.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget image URL.
	 */
	public function get_custom_image_url() {
		return 'https://topperpack.com/assets/widgets/shop-widget/';
	}

	/**
	 * Register Pricing Table Widget controls.
	 *
	 * Add input fields to allow the user to customize the widget settings.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function register_controls() {
		$options = array();
		$args = array(
			'taxonomy' => 'product_cat',
			'hide_empty' => false,
		);
		$terms = get_terms($args);
		if (!is_wp_error($terms) && !empty($terms)) {
			foreach ($terms as $key => $term) {
				if (is_object($term)) {
					$options[$term->term_id] = $term->name;
				} elseif (is_array($term)) {
					$options[$term['term_id']] = $term['name'];
				}
			}
		}
		// <========================> topppa SERVICE STYLES <========================>
		$base_url = $this->get_custom_image_url();
		$this->start_controls_section(
			'topppa_styles',
			[
				'label' => esc_html__('Styles', 'topper-pack'),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'topppa_widget_styles',
			[
				'label' => esc_html__('Choose Style', 'topper-pack'),
				'type' => TopperPack_Controls_Manager::IMAGECHOOSE,
				'default' => 'style_one',
				'options' => [
					'style_one' => [
						'title' => esc_html__('Style 1', 'topper-pack'),
						'imagelarge' => $base_url . 'topppa-shop-1.jpg',
						'imagesmall' => $base_url . 'topppa-shop-1.jpg',
						'width' => '100%',
					],
					'style_two' => [
						'title' => esc_html__('style 2', 'topper-pack'),
						'imagelarge' => $base_url . 'topppa-shop-2.jpg',
						'imagesmall' => $base_url . 'topppa-shop-2.jpg',
						'width' => '100%',
					],
					'style_three' => [
						'title' => esc_html__('Style 3', 'topper-pack'),
						'imagelarge' => $base_url . 'topppa-shop-3.jpg',
						'imagesmall' => $base_url . 'topppa-shop-3.jpg',
						'width' => '100%',
					],
					'style_four' => [
						'title' => esc_html__('Style 4', 'topper-pack'),
						'imagelarge' => $base_url . 'topppa-shop-4.jpg',
						'imagesmall' => $base_url . 'topppa-shop-4.jpg',
						'width' => '100%',
					],
					'style_five' => [
						'title' => esc_html__('Style 5', 'topper-pack'),
						'imagelarge' => $base_url . 'topppa-shop-5.jpg',
						'imagesmall' => $base_url . 'topppa-shop-5.jpg',
						'width' => '100%',
					],
				],
			]
		);
		$this->end_controls_section();

		// <==========>
		// <==========> QUERY OPTIONS <==========>
		$this->start_controls_section(
			'query_options',
			[
				'label' => esc_html__('Product Query', 'topper-pack'),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'store_cat_enable',
			[
				'label' => esc_html__('Enable Product By Cat', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Show', 'topper-pack'),
				'label_off' => esc_html__('Hide', 'topper-pack'),
				'return_value' => 'yes',
				'default' => 'no',
			]
		);

		$this->add_control(
			'store_cat',
			[
				'label' => __('Select Categories', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SELECT2,
				'multiple' => true,
				'options' => $this->get_product_categories(),
				'condition' => [
					'store_cat_enable' => 'yes',
				],
			]
		);

		$this->add_control(
			'orderby',
			[
				'label' => esc_html__('Order by', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'none',
				'options' => [
					'none' => esc_html__('None', 'topper-pack'),
					'ID' => esc_html__('ID', 'topper-pack'),
					'date' => esc_html__('Date', 'topper-pack'),
					'name' => esc_html__('Name', 'topper-pack'),
					'title' => esc_html__('Title', 'topper-pack'),
					'comment_count' => esc_html__('Comment count', 'topper-pack'),
					'rand' => esc_html__('Random', 'topper-pack'),
				],
			]
		);

		$this->add_control(
			'order',
			[
				'label' => esc_html__('Order', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'ASC',
				'options' => [
					'ASC' => esc_html__('ASC', 'topper-pack'),
					'DESC' => esc_html__('DESC', 'topper-pack'),
				],
			]
		);

		$this->add_control(
			'display_item',
			[
				'label' => esc_html__('Display Items', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'min' => 1,
				'max' => 1000,
				'step' => 1,
				'default' => 3,
			]
		);

		// Additional Query Controls
		$this->add_control(
			'price_range',
			[
				'label' => esc_html__('Price Range', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [''],
				'range' => [
					'min' => 0,
					'max' => 1000,
					'step' => 1,
				],
				'default' => [
					'min' => 0,
					'max' => 1000,
				],
				'description' => esc_html__('Set the price range for products.', 'topper-pack'),
			]
		);

		// Sort Options
		$this->add_control(
			'show_sorting',
			[
				'label' => esc_html__('Show Sorting', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Show', 'topper-pack'),
				'label_off' => esc_html__('Hide', 'topper-pack'),
				'return_value' => 'yes',
				'default' => 'no',
				'separator' => 'before',
			]
		);

		$this->add_control(
			'show_results_count',
			[
				'label' => esc_html__('Show Results Count', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Show', 'topper-pack'),
				'label_off' => esc_html__('Hide', 'topper-pack'),
				'return_value' => 'yes',
				'default' => 'no',
			]
		);

		$this->add_control(
			'show_pagination',
			[
				'label' => esc_html__('Show Pagination', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Show', 'topper-pack'),
				'label_off' => esc_html__('Hide', 'topper-pack'),
				'return_value' => 'yes',
				'default' => 'no',
				'condition' => [
					'enable_slider!' => 'yes',
				]
			]
		);

		$this->add_control(
			'products_per_page',
			[
				'label' => esc_html__('Products Per Page', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'min' => 1,
				'max' => 100,
				'step' => 1,
				'default' => 9,
				'condition' => [
					'show_pagination' => 'yes',
					'enable_slider!' => 'yes',
				],
			]
		);

		$this->add_control(
			'stock_status',
			[
				'label' => esc_html__('Stock Status', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'all',
				'options' => [
					'all' => esc_html__('All', 'topper-pack'),
					'instock' => esc_html__('In Stock', 'topper-pack'),
					'outofstock' => esc_html__('Out of Stock', 'topper-pack'),
				],
				'description' => esc_html__('Filter products by stock status.', 'topper-pack'),
			]
		);

		$this->add_control(
			'featured_products',
			[
				'label' => esc_html__('Featured Products Only', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Yes', 'topper-pack'),
				'label_off' => esc_html__('No', 'topper-pack'),
				'return_value' => 'yes',
				'default' => 'no',
				'description' => esc_html__('Show only featured products.', 'topper-pack'),
			]
		);

		$this->add_control(
			'product_tags_enable',
			[
				'label' => esc_html__('Enable Product By Tags', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Show', 'topper-pack'),
				'label_off' => esc_html__('Hide', 'topper-pack'),
				'return_value' => 'yes',
				'default' => 'no',
			]
		);

		$this->add_control(
			'product_tags',
			[
				'label' => __('Select Tags', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SELECT2,
				'multiple' => true,
				'options' => $this->get_product_tags(),
				'condition' => [
					'product_tags_enable' => 'yes',
				],
			]
		);

		$this->add_control(
			'on_sale_products',
			[
				'label' => esc_html__('On Sale Products Only', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Yes', 'topper-pack'),
				'label_off' => esc_html__('No', 'topper-pack'),
				'return_value' => 'yes',
				'default' => 'no',
				'description' => esc_html__('Show only products that are on sale.', 'topper-pack'),
			]
		);

		$this->add_control(
			'product_ratings',
			[
				'label' => esc_html__('Minimum Rating', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => '0',
				'options' => [
					'0' => esc_html__('All', 'topper-pack'),
					'1' => esc_html__('1 Star', 'topper-pack'),
					'2' => esc_html__('2 Stars', 'topper-pack'),
					'3' => esc_html__('3 Stars', 'topper-pack'),
					'4' => esc_html__('4 Stars', 'topper-pack'),
					'5' => esc_html__('5 Stars', 'topper-pack'),
				],
				'description' => esc_html__('Filter products by minimum rating.', 'topper-pack'),
			]
		);

		$this->add_control(
			'product_type',
			[
				'label' => esc_html__('Product Type', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'all',
				'options' => [
					'all' => esc_html__('All', 'topper-pack'),
					'simple' => esc_html__('Simple', 'topper-pack'),
					'variable' => esc_html__('Variable', 'topper-pack'),
					'grouped' => esc_html__('Grouped', 'topper-pack'),
					'external' => esc_html__('External', 'topper-pack'),
				],
				'description' => esc_html__('Filter products by type.', 'topper-pack'),
			]
		);

		$this->add_control(
			'exclude_products',
			[
				'label' => esc_html__('Exclude Products', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SELECT2,
				'multiple' => true,
				'options' => $this->get_all_products(),
				'description' => esc_html__('Exclude specific products from the query.', 'topper-pack'),
			]
		);

		$this->end_controls_section();

		// <==========>
		// <==========> PRODUCT OPTIONS <==========>
		$this->start_controls_section(
			'product_options',
			[
				'label' => esc_html__('Product Options', 'topper-pack'),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		$this->topppa_get_global_button_effects_controls([
			'topppa_widget_styles' => ['style_three', 'style_four']
		]);

		$this->add_control(
			'product_image_size',
			[
				'label' => esc_html__('Product Image Size', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'woocommerce_thumbnail',
				'options' => [
					'thumbnail' => esc_html__('Thumbnail', 'topper-pack'),
					'medium' => esc_html__('Medium', 'topper-pack'),
					'large' => esc_html__('Large', 'topper-pack'),
					'full' => esc_html__('Full', 'topper-pack'),
					'woocommerce_thumbnail' => esc_html__('WooCommerce Thumbnail', 'topper-pack'),
					'woocommerce_single' => esc_html__('WooCommerce Single', 'topper-pack'),
				],
				'description' => esc_html__('Choose the size of the product images.', 'topper-pack'),
			]
		);
		$this->add_control(
			'enable_title',
			[
				'label' => esc_html__('Enable Title', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Show', 'topper-pack'),
				'label_off' => esc_html__('Hide', 'topper-pack'),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);
		$this->topppa_global_title_tag(['enable_title' => 'yes']);
		$this->add_control(
			'title_word_count',
			[
				'label' => __('Title Word Count', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'default' => 10,
				'description' => __('Set the maximum number of words to display in the title. Leave blank to show the full title.', 'topper-pack'),
				'condition' => [
					'enable_title' => 'yes'
				]
			]
		);
		$this->topppa_global_image_animation();
		$this->add_control(
			'title_divider',
			[
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_control(
			'enable_price',
			[
				'label' => esc_html__('Enable Price', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Show', 'topper-pack'),
				'label_off' => esc_html__('Hide', 'topper-pack'),
				'return_value' => 'yes',
			]
		);
		$this->add_control(
			'price_divider',
			[
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_control(
			'enable_price_prefix',
			[
				'label' => esc_html__('Enable Price Prefix', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Show', 'topper-pack'),
				'label_off' => esc_html__('Hide', 'topper-pack'),
				'return_value' => 'yes',
				'default' => 'no',
				'description' => esc_html__('Add custom text before the price.', 'topper-pack'),
				'condition' => [
					'enable_price' => 'yes',
				],
			]
		);
		$this->add_control(
			'price_prefix_text',
			[
				'label' => esc_html__('Price Prefix Text', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__('From ', 'topper-pack'),
				'placeholder' => esc_html__('Enter prefix text', 'topper-pack'),
				'condition' => [
					'enable_price_prefix' => 'yes',
					'enable_price' => 'yes',
				],
			]
		);
		$this->add_control(
			'enable_price_suffix',
			[
				'label' => esc_html__('Enable Price Suffix', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Show', 'topper-pack'),
				'label_off' => esc_html__('Hide', 'topper-pack'),
				'return_value' => 'yes',
				'default' => 'no',
				'description' => esc_html__('Add custom text after the price.', 'topper-pack'),
				'condition' => [
					'enable_price' => 'yes',
				],
			]
		);
		$this->add_control(
			'price_suffix_text',
			[
				'label' => esc_html__('Price Suffix Text', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__(' per item', 'topper-pack'),
				'placeholder' => esc_html__('Enter suffix text', 'topper-pack'),
				'condition' => [
					'enable_price_suffix' => 'yes',
					'enable_price' => 'yes',
				],
			]
		);
		$this->add_control(
			'enable_description',
			[
				'label' => esc_html__('Enable Description', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Show', 'topper-pack'),
				'label_off' => esc_html__('Hide', 'topper-pack'),
				'return_value' => 'yes',
				'default' => 'no',
			]
		);
		$this->add_control(
			'description_word_limit',
			[
				'label' => esc_html__('Description Word Limit', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'min' => 1,
				'max' => 100,
				'step' => 1,
				'default' => 20,
				'condition' => [
					'enable_description' => 'yes',
				],
			]
		);
		$this->add_control(
			'btn_divider',
			[
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_control(
			'enable_add_to_cart_button',
			[
				'label' => esc_html__('Enable Add to Cart Button', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Show', 'topper-pack'),
				'label_off' => esc_html__('Hide', 'topper-pack'),
				'return_value' => 'yes',
				'default' => 'yes',
				'description' => esc_html__('Show or hide the add to cart button for products.', 'topper-pack'),
			]
		);
		$this->add_control(
			'cart_btn_style',
			[
				'label' => esc_html__('Cart Button Style', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'icon',
				'options' => [
					'icon' => esc_html__('Icon Only', 'topper-pack'),
					'button' => esc_html__('Button Style', 'topper-pack'),
				],
				'condition' => [
					'enable_add_to_cart_button' => 'yes',
				],
			]
		);
		$this->add_control(
			'enable_cart_text',
			[
				'label' => esc_html__('Enable Cart Text', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Show', 'topper-pack'),
				'label_off' => esc_html__('Hide', 'topper-pack'),
				'return_value' => 'yes',
				'default' => 'yes',
				'condition' => [
					'enable_add_to_cart_button' => 'yes',
				],
			]
		);
		$this->add_control(
			'add_to_cart_text',
			[
				'label' => esc_html__('Add to Cart Text', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__('Add to cart', 'topper-pack'),
				'placeholder' => esc_html__('Enter add to cart text', 'topper-pack'),
				'condition' => [
					'enable_cart_text' => 'yes',
					'enable_add_to_cart_button' => 'yes',
				],
			]
		);
		$this->add_control(
			'view_cart_text',
			[
				'label' => esc_html__('View Cart Text', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__('View Cart', 'topper-pack'),
				'placeholder' => esc_html__('Enter view cart text', 'topper-pack'),
				'description' => esc_html__('Text displayed after product is added to cart.', 'topper-pack'),
				'condition' => [
					'enable_cart_text' => 'yes',
					'enable_add_to_cart_button' => 'yes',
				],
			]
		);
		$this->add_control(
			'enable_ajax_cart',
			[
				'label' => esc_html__('Enable AJAX Add to Cart', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Yes', 'topper-pack'),
				'label_off' => esc_html__('No', 'topper-pack'),
				'return_value' => 'yes',
				'default' => 'yes',
				'description' => esc_html__('Prevent page reload when adding products to cart.', 'topper-pack'),
				'condition' => [
					'enable_add_to_cart_button' => 'yes',
				],
			]
		);
		$this->add_control(
			'enable_cart_icon',
			[
				'label' => esc_html__('Enable Cart Icon', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Show', 'topper-pack'),
				'label_off' => esc_html__('Hide', 'topper-pack'),
				'return_value' => 'yes',
				'default' => 'yes',
				'condition' => [
					'enable_add_to_cart_button' => 'yes',
				],
			]
		);
		$this->add_control(
			'add_to_cart_icon',
			[
				'label' => esc_html__('Add to Cart Icon', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::ICONS,
				'default' => [
					'value' => 'fas fa-cart-arrow-down',
					'library' => 'fa-solid',
				],
				'condition' => [
					'enable_cart_icon' => 'yes',
					'enable_add_to_cart_button' => 'yes',
				],
			]
		);
		$this->add_control(
			'quantity_divider',
			[
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => [
					'enable_add_to_cart_button' => 'yes',
				],
			]
		);
		$this->add_control(
			'enable_quantity',
			[
				'label' => esc_html__('Enable Quantity Input', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Show', 'topper-pack'),
				'label_off' => esc_html__('Hide', 'topper-pack'),
				'return_value' => 'yes',
				'default' => 'no',
				'description' => esc_html__('Enable quantity input to allow users to select the number of products to add to cart.', 'topper-pack'),
				'condition' => [
					'enable_add_to_cart_button' => 'yes',
				],
			]
		);
		$this->add_control(
			'quantity_default',
			[
				'label' => esc_html__('Default Quantity', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'min' => 1,
				'max' => 100,
				'step' => 1,
				'default' => 1,
				'condition' => [
					'enable_quantity' => 'yes',
					'enable_add_to_cart_button' => 'yes',
				],
				'description' => esc_html__('Set the default quantity value.', 'topper-pack'),
			]
		);
		$this->add_control(
			'quantity_min',
			[
				'label' => esc_html__('Minimum Quantity', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'min' => 1,
				'max' => 100,
				'step' => 1,
				'default' => 1,
				'condition' => [
					'enable_quantity' => 'yes',
					'enable_add_to_cart_button' => 'yes',
				],
				'description' => esc_html__('Set the minimum quantity value.', 'topper-pack'),
			]
		);
		$this->add_control(
			'quantity_max',
			[
				'label' => esc_html__('Maximum Quantity', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'min' => 1,
				'max' => 1000,
				'step' => 1,
				'default' => 10,
				'condition' => [
					'enable_quantity' => 'yes',
					'enable_add_to_cart_button' => 'yes',
				],
				'description' => esc_html__('Set the maximum quantity value.', 'topper-pack'),
			]
		);
		$this->add_control(
			'rating_divider',
			[
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_control(
			'enable_rating',
			[
				'label' => esc_html__('Enable Rating', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Show', 'topper-pack'),
				'label_off' => esc_html__('Hide', 'topper-pack'),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);
		$this->add_control(
			'enable_sale',
			[
				'label' => esc_html__('Enable Sale Badge', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Yes', 'topper-pack'),
				'label_off' => esc_html__('No', 'topper-pack'),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);
		$this->add_control(
			'show_sale_badge',
			[
				'label' => esc_html__('Show Sale Badge', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Yes', 'topper-pack'),
				'label_off' => esc_html__('No', 'topper-pack'),
				'return_value' => 'yes',
				'default' => 'yes',
				'condition' => [
					'enable_sale' => 'yes',
				],
			]
		);
		$this->add_control(
			'sale_text',
			[
				'label' => esc_html__('Sale Text', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__('Sale!', 'topper-pack'),
				'condition' => [
					'enable_sale' => 'yes',
					'show_sale_badge' => 'yes',
				],
			]
		);
		$this->add_control(
			'stock_divider',
			[
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_control(
			'enable_stock_status',
			[
				'label' => esc_html__('Enable Stock Status', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Show', 'topper-pack'),
				'label_off' => esc_html__('Hide', 'topper-pack'),
				'return_value' => 'yes',
				'default' => 'no',
				'description' => esc_html__('Display product stock status (In stock, Out of stock, On backorder).', 'topper-pack'),
			]
		);
		$this->add_control(
			'stock_in_text',
			[
				'label' => esc_html__('In Stock Text', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__('In stock', 'topper-pack'),
				'condition' => [
					'enable_stock_status' => 'yes',
				],
			]
		);
		$this->add_control(
			'stock_out_text',
			[
				'label' => esc_html__('Out of Stock Text', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__('Out of stock', 'topper-pack'),
				'condition' => [
					'enable_stock_status' => 'yes',
				],
			]
		);
		$this->add_control(
			'stock_backorder_text',
			[
				'label' => esc_html__('On Backorder Text', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__('On backorder', 'topper-pack'),
				'condition' => [
					'enable_stock_status' => 'yes',
				],
			]
		);

		$this->add_control(
			'quick_view_divider',
			[
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_control(
			'enable_quick_view',
			[
				'label' => esc_html__('Enable Quick View', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Show', 'topper-pack'),
				'label_off' => esc_html__('Hide', 'topper-pack'),
				'return_value' => 'yes',
				'default' => 'no',
			]
		);
		$this->add_control(
			'enable_wishlist',
			[
				'label' => esc_html__('Enable Wishlist', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Show', 'topper-pack'),
				'label_off' => esc_html__('Hide', 'topper-pack'),
				'return_value' => 'yes',
				'default' => 'no',
			]
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'related_products_section',
			[
				'label' => esc_html__('Related Products', 'topper-pack'),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'show_related_products',
			[
				'label' => esc_html__('Show Related Products', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Yes', 'topper-pack'),
				'label_off' => esc_html__('No', 'topper-pack'),
				'return_value' => 'yes',
				'default' => 'no',
			]
		);

		$this->add_control(
			'related_products_notice',
			[
				'type' => \Elementor\Controls_Manager::RAW_HTML,
				'raw' => esc_html__('Note: Related products will only display on single product pages where WooCommerce product context is available.', 'topper-pack'),
				'content_classes' => 'elementor-panel-alert elementor-panel-alert-info',
				'condition' => [
					'show_related_products' => 'yes',
				],
			]
		);

		$this->add_control(
			'related_products_count',
			[
				'label' => esc_html__('Number of Related Products', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'min' => 1,
				'max' => 20,
				'step' => 1,
				'default' => 3,
				'condition' => [
					'show_related_products' => 'yes',
				],
			]
		);

		$this->end_controls_section();

		// <==========>
		// <==========> Product Content Order <==========>
		$this->start_controls_section(
			'content_order',
			[
				'label' => esc_html__('Content Order', 'topper-pack'),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		// Enable/Disable Content Order
		$this->add_control(
			'enable_order',
			[
				'label' => esc_html__('Enable Content Order', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Enable', 'topper-pack'),
				'label_off' => esc_html__('Disable', 'topper-pack'),
				'return_value' => 'yes',
				'default' => 'no',
				'description' => esc_html__('Enable this option to customize the order of product content elements.', 'topper-pack'),
			]
		);

		// Content Display Type
		$this->add_responsive_control(
			'content_display',
			[
				'label' => esc_html__('Content Layout', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'flex',
				'options' => [
					'' => esc_html__('Default', 'topper-pack'),
					'flex' => esc_html__('Flexbox', 'topper-pack'),
				],
				'selectors' => [
					'{{WRAPPER}} .topppa-store-content' => 'display: {{VALUE}};',
				],
				'condition' => [
					'enable_order' => 'yes'
				],
				'description' => esc_html__('Choose "Flexbox" to enable flexible content ordering and alignment.', 'topper-pack'),
			]
		);

		// Content Direction
		$this->add_responsive_control(
			'content_direction',
			[
				'label' => esc_html__('Content Direction', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'options' => [
					'column' => [
						'title' => esc_html__('Column', 'topper-pack'),
						'icon' => 'eicon-v-align-top',
					],
					'column-reverse' => [
						'title' => esc_html__('Column Reverse', 'topper-pack'),
						'icon' => 'eicon-v-align-bottom',
					],
					'row' => [
						'title' => esc_html__('Row', 'topper-pack'),
						'icon' => 'eicon-h-align-right',
					],
					'row-reverse' => [
						'title' => esc_html__('Row Reverse', 'topper-pack'),
						'icon' => 'eicon-h-align-left',
					],
				],
				'toggle' => true,
				'selectors' => [
					'{{WRAPPER}} .topppa-store-content' => 'flex-direction: {{VALUE}};',
				],
				'condition' => [
					'enable_order' => 'yes',
					'content_display' => 'flex'
				],
				'description' => esc_html__('Set the direction of content elements. Choose "Column" for vertical layout or "Row" for horizontal layout.', 'topper-pack'),
			]
		);
		$this->add_control(
			'title_order',
			[
				'label' => esc_html__('Title Order', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'min' => 1,
				'max' => 10,
				'step' => 1,
				'selectors' => [
					'{{WRAPPER}} .topppa-product-wrp .product-items .topppa-store-content .topppa-store-title a' => 'order: {{VALUE}};',
				],
				'condition' => [
					'content_display' => 'flex',
					'enable_order' => 'yes'
				],
				'description' => esc_html__('Set the order of the product title. Lower numbers appear first.', 'topper-pack'),
			]
		);
		$this->add_control(
			'description_order',
			[
				'label' => esc_html__('Description Order', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'min' => 1,
				'max' => 10,
				'step' => 1,
				'selectors' => [
					'{{WRAPPER}} .topppa-product-description' => 'order: {{VALUE}};',
				],
				'condition' => [
					'content_display' => 'flex',
					'enable_order' => 'yes'
				],
				'description' => esc_html__('Set the order of the product description. Lower numbers appear first.', 'topper-pack'),
			]
		);
		$this->add_control(
			'price_order',
			[
				'label' => esc_html__('Price Order', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'min' => 1,
				'max' => 10,
				'step' => 1,
				'selectors' => [
					'{{WRAPPER}} .topppa-store-price-wrp' => 'order: {{VALUE}};',
				],
				'condition' => [
					'content_display' => 'flex',
					'enable_order' => 'yes'
				],
				'description' => esc_html__('Set the order of the product price. Lower numbers appear first.', 'topper-pack'),
			]
		);
		$this->add_control(
			'rating_order',
			[
				'label' => esc_html__('Rating Order', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'min' => 1,
				'max' => 10,
				'step' => 1,
				'selectors' => [
					'{{WRAPPER}} .prodcut-rating' => 'order: {{VALUE}};',
				],
				'condition' => [
					'content_display' => 'flex',
					'enable_order' => 'yes'
				],
				'description' => esc_html__('Set the order of the product rating. Lower numbers appear first.', 'topper-pack'),
			]
		);
		$this->add_control(
			'stock_order',
			[
				'label' => esc_html__('Stock Status Order', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'min' => 1,
				'max' => 10,
				'step' => 1,
				'selectors' => [
					'{{WRAPPER}} .topppa-stock-status' => 'order: {{VALUE}};',
				],
				'condition' => [
					'content_display' => 'flex',
					'enable_order' => 'yes'
				],
				'description' => esc_html__('Set the order of the stock status. Lower numbers appear first.', 'topper-pack'),
			]
		);
		$this->add_control(
			'button_order',
			[
				'label' => esc_html__('Button Order', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'min' => 1,
				'max' => 10,
				'step' => 1,
				'selectors' => [
					'{{WRAPPER}} .topppa-btn-wrapper' => 'order: {{VALUE}};',
				],
				'condition' => [
					'content_display' => 'flex',
					'enable_order' => 'yes'
				],
				'description' => esc_html__('Set the order of the product button. Lower numbers appear first.', 'topper-pack'),
			]
		);
		$this->end_controls_section();

		// <==========>
		// <==========> SLIDER OPTIONS <==========>
		$this->start_controls_section(
			'slider_options',
			[
				'label' => esc_html__('Slider Options', 'topper-pack'),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'enable_slider',
			[
				'label' => esc_html__('Slider', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Yes', 'topper-pack'),
				'label_off' => esc_html__('No', 'topper-pack'),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);
		$this->add_control(
			'enable_slider_auto_loop',
			[
				'label' => esc_html__('Auto Loop', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Yes', 'topper-pack'),
				'label_off' => esc_html__('No', 'topper-pack'),
				'return_value' => 'yes',
				'default' => 'yes',
				'condition' => [
					'enable_slider' => 'yes',
				],
			]
		);

		$this->add_control(
			'enable_rtl',
			[
				'label' => esc_html__('RTL Mode', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Yes', 'topper-pack'),
				'label_off' => esc_html__('No', 'topper-pack'),
				'return_value' => 'yes',
				'default' => 'no',
				'condition' => [
					'enable_slider' => 'yes',
				],
			]
		);

		$this->add_control(
			'slide_show_lagrge_item',
			[
				'label' => esc_html__('Items (Large )', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'min' => 1,
				'max' => 6,
				'step' => 1,
				'default' => 1,
				'condition' => [
					'enable_slider' => 'yes',
				],
			]
		);
		$this->add_control(
			'slide_show_teblet_item',
			[
				'label' => esc_html__('Items (Tabel)', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'min' => 1,
				'max' => 6,
				'step' => 1,
				'default' => 1,
				'condition' => [
					'enable_slider' => 'yes',
				],
			]
		);
		$this->add_control(
			'slide_show_mobile_item',
			[
				'label' => esc_html__('Items (Mobile)', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'min' => 1,
				'max' => 6,
				'step' => 1,
				'default' => 1,
				'condition' => [
					'enable_slider' => 'yes',
				],
			]
		);
		$this->add_control(
			'slide_show_extra_mobile_item',
			[
				'label' => esc_html__('Items (Small Mobile)', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'min' => 1,
				'max' => 6,
				'step' => 1,
				'default' => 1,
				'condition' => [
					'enable_slider' => 'yes',
				],
			]
		);
		$this->add_control(
			'slider_space_between',
			[
				'label'   => __('Spacing (px)', 'topper-pack'),
				'type'    => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
						'step' => 1,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 24,
				],
				'condition' => [
					'enable_slider' => 'yes',
				],
			]
		);
		$this->add_control(
			'slide_speed',
			[
				'label' => esc_html__('Autoplay Delay (ms)', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'min' => 100,
				'max' => 10000,
				'step' => 100,
				'default' => 2000,
				'condition' => [
					'enable_slider' => 'yes',
				],
			]
		);

		$this->add_control(
			'slider_speed',
			[
				'label' => esc_html__('Transition Speed (ms)', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'min' => 100,
				'max' => 5000,
				'step' => 100,
				'default' => 600,
				'condition' => [
					'enable_slider' => 'yes',
				],
			]
		);
		$this->add_control(
			'enable_dots',
			[
				'label'        => esc_html__('Dots', 'topper-pack'),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => esc_html__('On', 'topper-pack'),
				'label_off'    => esc_html__('Off', 'topper-pack'),
				'return_value' => 'yes',
				'default'      => 'no',
				'condition' => [
					'enable_slider' => 'yes',
				],
			]
		);
		$this->add_control(
			'enable_arrow',
			[
				'label'        => esc_html__('Enable Arrow', 'topper-pack'),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => esc_html__('On', 'topper-pack'),
				'label_off'    => esc_html__('Off', 'topper-pack'),
				'return_value' => 'yes',
				'default'      => 'yes',
				'condition' => [
					'enable_slider' => 'yes',
				],
			]
		);
		$this->add_control(
			'select_arrow',
			[
				'label' => esc_html__('Arrow Styles', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'style_one',
				'options' => [
					'arrow_one' => esc_html__('Style One', 'topper-pack'),
					'arrow_two' => esc_html__('Style Two', 'topper-pack'),
				],
				'condition' => [
					'enable_arrow' => 'yes',
					'enable_slider' => 'yes',
				],
			]
		);
		$this->add_control(
			'style_arrow_type',
			[
				'label' => esc_html__('Select Arrow Type', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'options' => [
					'text' => [
						'title' => esc_html__('Default', 'topper-pack'),
						'icon' => 'eicon-animation-text',
					],
					'arrow_icons' => [
						'title' => esc_html__('Icon', 'topper-pack'),
						'icon' => 'eicon-info-circle',
					],
				],
				'default' => 'text',
				'condition' => [
					'enable_slider' => 'yes',
					'enable_arrow' => 'yes',
				],
			]
		);
		$this->add_control(
			'default_arrow_notice',
			[
				'type' => \Elementor\Controls_Manager::ALERT,
				'alert_type' => 'success',
				'content' => esc_html__('Default Arrow', 'topper-pack'),
				'condition' => [
					'enable_arrow' => 'yes',
					'enable_slider' => 'yes',
					'style_arrow_type' => 'text',
				]
			]
		);
		$this->add_control(
			'left_arrow_icon',
			[
				'label' => esc_html__('Left Arrow Icon', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::ICONS,
				'default' => [
					'value' => 'fas fa-arrow-left',
					'library' => 'fa-solid',
				],
				'condition' => [
					'enable_arrow' => 'yes',
					'enable_slider' => 'yes',
					'style_arrow_type' => 'arrow_icons',
				],
			]
		);
		$this->add_control(
			'right_arrow_icon',
			[
				'label' => esc_html__('RIght Arrwo Icon', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::ICONS,
				'default' => [
					'value' => 'fas fa-arrow-right',
					'library' => 'fa-solid',
				],
				'condition' => [
					'enable_arrow' => 'yes',
					'enable_slider' => 'yes',
					'style_arrow_type' => 'arrow_icons',
				],
			]
		);
		$this->add_control(
			'column_options',
			[
				'label' => esc_html__('Column Options', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => [
					'enable_slider!' => 'yes',
				],
			]
		);
		$this->add_control(
			'desktop_col',
			[
				'label'   => __('Columns On Desktop', 'topper-pack'),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'default' => 'col-xl-4',
				'options' => [
					'col-xl-12' => __('1 Column', 'topper-pack'),
					'col-xl-6'  => __('2 Column', 'topper-pack'),
					'col-xl-4'  => __('3 Column', 'topper-pack'),
					'col-xl-3'  => __('4 Column', 'topper-pack'),
					'col-xl-2'  => __('6 Column', 'topper-pack'),
				],
				'condition' => [
					'enable_slider!' => 'yes',
				],
			]
		);
		$this->add_control(
			'laptop_col',
			[
				'label'   => __('Columns for Laptop', 'topper-pack'),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'default' => 'col-lg-4',
				'options' => [
					'col-lg-12' => __('1 Column', 'topper-pack'),
					'col-lg-6'  => __('2 Column', 'topper-pack'),
					'col-lg-4'  => __('3 Column', 'topper-pack'),
					'col-lg-3'  => __('4 Column', 'topper-pack'),
					'col-lg-2'  => __('6 Column', 'topper-pack'),
				],
				'condition' => [
					'enable_slider!' => 'yes',
				],
			]
		);
		$this->add_control(
			'tab_col',
			[
				'label'   => __('Columns On Tablet', 'topper-pack'),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'default' => 'col-md-6',
				'description' => esc_html__('Column Options is Not working If you Select The Slide', 'topper-pack'),
				'options' => [
					'col-md-12' => __('1 Column', 'topper-pack'),
					'col-md-6'  => __('2 Column', 'topper-pack'),
					'col-md-4'  => __('3 Column', 'topper-pack'),
					'col-md-3'  => __('4 Column', 'topper-pack'),
					'col-md-2'  => __('6 Column', 'topper-pack'),
				],
				'condition' => [
					'enable_slider!' => 'yes',
				],
			]
		);
		$this->end_controls_section();

		//===============================//
		//======= BOX STYLE ============//
		//=============================//
		$this->start_controls_section(
			'section_box',
			[
				'label' => esc_html__('Box Style', 'topper-pack'),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_responsive_control(
			'box_overflow',
			[
				'label' => esc_html__('Overflow', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'unset',
				'options' => [
					'unset' => esc_html__('Default', 'topper-pack'),
					'auto' => esc_html__('Auto', 'topper-pack'),
					'visible'  => esc_html__('Visible', 'topper-pack'),
					'hidden'  => esc_html__('Hidden', 'topper-pack'),
				],
				'selectors' => [
					'{{WRAPPER}} .product-items' => 'overflow: {{VALUE}};',
				],
			]
		);
		$this->add_responsive_control(
			'box_margin',
			[
				'label' => esc_html__('Margin', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .product-items' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'box_padding',
			[
				'label' => esc_html__('Padding', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .product-items' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->start_controls_tabs(
			'shop_box_style_tabs'
		);

		$this->start_controls_tab(
			'shop_box_style_normal_tab',
			[
				'label' => esc_html__('Normal', 'topper-pack'),
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'store_box_box_bg',
				'types' => ['classic', 'gradient', 'video'],
				'selector' => '{{WRAPPER}} .product-items',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'store_box_border',
				'selector' => '{{WRAPPER}} .product-items',
			]
		);
		$this->add_responsive_control(
			'store_box_box_radius',
			[
				'label' => esc_html__('Border Radius', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .product-items' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'store_box_box_shadow',
				'selector' => '{{WRAPPER}} .product-items',
			]
		);
		$this->end_controls_tab();

		$this->start_controls_tab(
			'shop_box_style_hover_tab',
			[
				'label' => esc_html__('Hover', 'topper-pack'),
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'box_hbg',
				'types' => ['classic', 'gradient', 'video'],
				'selector' => '{{WRAPPER}} .product-items:hover',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'box_hborder',
				'selector' => '{{WRAPPER}} .product-items:hover',
			]
		);
		$this->add_responsive_control(
			'box_hradius',
			[
				'label' => esc_html__('Border Radius', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .product-items:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'box_hshadow',
				'selector' => '{{WRAPPER}} .product-items:hover',
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();

		//==================================//
		//======= IAMGE STYLE =============//
		//================================//
		$this->start_controls_section(
			'store_img',
			[
				'label' => esc_html__('Image', 'topper-pack'),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_responsive_control(
			'store_image_height',
			[
				'label' => esc_html__('Height', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px', '%', 'em', 'rem', 'custom'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .topppa-product-wrp .topppa-store-product-img' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'store_image_width',
			[
				'label' => esc_html__('Width', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px', '%', 'em', 'rem', 'custom'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .topppa-product-wrp .topppa-store-product-img' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'store_img_size',
			[
				'label' => esc_html__('Object Fit', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'cover',
				'options' => [
					'auto' => esc_html__('Auto', 'topper-pack'),
					'cover' => esc_html__('Cover', 'topper-pack'),
					'contain' => esc_html__('Contain', 'topper-pack'),
					'unset' => esc_html__('Unset', 'topper-pack'),
				],
				'selectors' => [
					'{{WRAPPER}} .topppa-product-wrp .topppa-store-product-img img' => 'object-fit: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'store_image_border',
				'selector' => '{{WRAPPER}} .topppa-product-wrp .topppa-store-product-img',
			]
		);
		$this->add_responsive_control(
			'store_image_border_radius',
			[
				'label' => esc_html__('Border Radius', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .topppa-product-wrp .topppa-store-product-img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'store_image_box_shadow',
				'selector' => '{{WRAPPER}} .topppa-product-wrp .topppa-store-product-img',
			]
		);
		$this->add_responsive_control(
			'store_image_margin',
			[
				'label' => esc_html__('Margin', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .topppa-product-wrp .topppa-store-product-img' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'store_image_padding',
			[
				'label' => esc_html__('Padding', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .topppa-product-wrp .topppa-store-product-img' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();

		//=====================================//
		//======= CONTENT  STYLE =============//
		//===================================//
		$this->start_controls_section(
			'store_content_style_options',
			[
				'label' => esc_html__('Content', 'topper-pack'),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_responsive_control(
			'content_align',
			[
				'label' => esc_html__('Alignment', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'options' => [
					'start' => [
						'title' => esc_html__('Left', 'topper-pack'),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => esc_html__('Center', 'topper-pack'),
						'icon' => 'eicon-text-align-center',
					],
					'end' => [
						'title' => esc_html__('Right', 'topper-pack'),
						'icon' => 'eicon-text-align-right',
					],
				],
				'toggle' => true,
				'selectors' => [
					'{{WRAPPER}} .cart-button.topppa-btn-wrapper' => 'justify-content: {{VALUE}};',
					'{{WRAPPER}} .topppa-product-wrp .product-items .topppa-store-content .topppa-store-price-wrp' => 'justify-content: {{VALUE}};',
					'{{WRAPPER}} .topppa-product-wrp .product-items .topppa-store-content' => 'text-align: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'store_content_box_bg',
				'types' => ['classic', 'gradient', 'video'],
				'selector' => '{{WRAPPER}} .topppa-product-wrp .product-items .topppa-store-content',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'store_content_border',
				'selector' => '{{WRAPPER}} .topppa-product-wrp .product-items .topppa-store-content',
			]
		);
		$this->add_responsive_control(
			'store_content_radius',
			[
				'label' => esc_html__('Border Radius', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .topppa-product-wrp .product-items .topppa-store-content' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'store_content_shadow',
				'selector' => '{{WRAPPER}} .topppa-product-wrp .product-items .topppa-store-content',
			]
		);
		$this->add_responsive_control(
			'store_content_box_margin',
			[
				'label' => esc_html__('Margin', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em', 'rem', 'custom'],
				'selectors' => [
					'{{WRAPPER}} .topppa-product-wrp .product-items .topppa-store-content' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'store_content_box_padding',
			[
				'label' => esc_html__('Padding', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em', 'rem', 'custom'],
				'selectors' => [
					'{{WRAPPER}} .topppa-product-wrp .product-items .topppa-store-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->start_controls_tabs(
			'store_cotent_style_tabs'
		);
		$this->start_controls_tab(
			'store_title_style',
			[
				'label' => esc_html__('Title', 'topper-pack'),
				'condition' => [
					'enable_title' => 'yes'
				]
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'store_title_typo',
				'label' => __('Typography', 'topper-pack'),
				'selector' => ' {{WRAPPER}} .topppa-product-wrp .product-items .topppa-store-content .topppa-store-title a ',
			]
		);
		$this->add_responsive_control(
			'store_title_color',
			[
				'label' => esc_html__('Color', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .topppa-product-wrp .product-items .topppa-store-content .topppa-store-title a' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_responsive_control(
			'store_title_hcolor',
			[
				'label' => esc_html__('Hover Color', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .topppa-product-wrp .product-items .topppa-store-content .topppa-store-title a:hover' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_responsive_control(
			'store_title_margin',
			[
				'label' => esc_html__('Margin', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .topppa-product-wrp .product-items .topppa-store-content .topppa-store-title a' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'store_title_padding',
			[
				'label' => esc_html__('Padding', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .topppa-product-wrp .product-items .topppa-store-content .topppa-store-title a' => 'Padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_tab();

		$this->start_controls_tab(
			'store_price_style',
			[
				'label' => esc_html__('Price', 'topper-pack'),
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'title_typo',
				'label' => __('Typography', 'topper-pack'),
				'selector' => ' {{WRAPPER}} .topppa-product-wrp .product-items .topppa-store-content .topppa-store-price-wrp bdi',
			]
		);
		$this->add_responsive_control(
			'store_price_color',
			[
				'label' => esc_html__('Color', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .topppa-product-wrp .product-items .topppa-store-content .topppa-store-price-wrp bdi' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_responsive_control(
			'store_price_hcolor',
			[
				'label' => esc_html__('Hover Color', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .topppa-product-wrp .product-items .topppa-store-content .topppa-store-price-wrp bdi:hover' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_responsive_control(
			'store_price_margin',
			[
				'label' => esc_html__('Margin', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .topppa-store-price-wrp' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'store_price_padding',
			[
				'label' => esc_html__('Padding', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .topppa-store-price-wrp' => 'Padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'previous_price',
			[
				'label' => esc_html__('Previous Price', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'pre_price_typo',
				'label' => __('Typography', 'topper-pack'),
				'selector' => ' {{WRAPPER}} .topppa-product-wrp .product-items .topppa-store-content .topppa-store-price-wrp del bdi',
			]
		);
		$this->add_responsive_control(
			'pre_price_color',
			[
				'label' => esc_html__('Color', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .topppa-product-wrp .product-items .topppa-store-content .topppa-store-price-wrp del bdi' => 'color: {{VALUE}};',
					'{{WRAPPER}} .topppa-product-wrp .product-items .topppa-store-content .topppa-store-price-wrp del' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_responsive_control(
			'pre_price_margin',
			[
				'label' => esc_html__('Margin', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .topppa-product-wrp .product-items .topppa-store-content .topppa-store-price-wrp del bdi' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'pre_price_padding',
			[
				'label' => esc_html__('Padding', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .topppa-product-wrp .product-items .topppa-store-content .topppa-store-price-wrp del bdi' => 'Padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		// Price Prefix Styles
		$this->add_control(
			'price_prefix_heading',
			[
				'label' => esc_html__('Price Prefix', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => [
					'enable_price_prefix' => 'yes',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'price_prefix_typo',
				'label' => __('Typography', 'topper-pack'),
				'selector' => '{{WRAPPER}} .topppa-product-wrp .product-items .topppa-store-content .topppa-store-price-wrp .topppa-price-prefix',
				'condition' => [
					'enable_price_prefix' => 'yes',
				],
			]
		);
		$this->add_responsive_control(
			'price_prefix_color',
			[
				'label' => esc_html__('Color', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .topppa-product-wrp .product-items .topppa-store-content .topppa-store-price-wrp .topppa-price-prefix' => 'color: {{VALUE}};',
				],
				'condition' => [
					'enable_price_prefix' => 'yes',
				],
			]
		);
		$this->add_responsive_control(
			'price_prefix_margin',
			[
				'label' => esc_html__('Margin', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .topppa-product-wrp .product-items .topppa-store-content .topppa-store-price-wrp .topppa-price-prefix' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'enable_price_prefix' => 'yes',
				],
			]
		);

		// Price Suffix Styles
		$this->add_control(
			'price_suffix_heading',
			[
				'label' => esc_html__('Price Suffix', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => [
					'enable_price_suffix' => 'yes',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'price_suffix_typo',
				'label' => __('Typography', 'topper-pack'),
				'selector' => '{{WRAPPER}} .topppa-product-wrp .product-items .topppa-store-content .topppa-store-price-wrp .topppa-price-suffix',
				'condition' => [
					'enable_price_suffix' => 'yes',
				],
			]
		);
		$this->add_responsive_control(
			'price_suffix_color',
			[
				'label' => esc_html__('Color', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .topppa-product-wrp .product-items .topppa-store-content .topppa-store-price-wrp .topppa-price-suffix' => 'color: {{VALUE}};',
				],
				'condition' => [
					'enable_price_suffix' => 'yes',
				],
			]
		);
		$this->add_responsive_control(
			'price_suffix_margin',
			[
				'label' => esc_html__('Margin', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .topppa-product-wrp .product-items .topppa-store-content .topppa-store-price-wrp .topppa-price-suffix' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'enable_price_suffix' => 'yes',
				],
			]
		);
		$this->end_controls_tab();

		$this->start_controls_tab(
			'store_desc_style',
			[
				'label' => esc_html__('Description', 'topper-pack'),
				'condition' => [
					'enable_description' => 'yes'
				]
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'dec_typo',
				'label' => esc_html__('Typography', 'topper-pack'),
				'selector' => '{{WRAPPER}} .topppa-product-description',
			]
		);
		$this->add_responsive_control(
			'dec_color',
			[
				'label' => esc_html__('Color', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .topppa-product-description' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_responsive_control(
			'dec_margin',
			[
				'label' => esc_html__('Margin', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .topppa-product-description' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'dec_padding',
			[
				'label' => esc_html__('Padding', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .topppa-product-description' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();

		//=================================//
		//======= CART STYLE =============//
		//===============================//
		$this->start_controls_section(
			'sale_styles',
			[
				'label' => esc_html__('Sale', 'topper-pack'),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
				'condition' => [
					'enable_sale' => 'yes'
				]
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'offer_bg',
				'types' => ['classic', 'gradient', 'video'],
				'selector' => '{{WRAPPER}} .topppa-product-wrp .product-items .topppa-store-product-img .topppa-product-offer',
			]
		);
		$this->add_responsive_control(
			'text_align',
			[
				'label' => esc_html__('Alignment', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => esc_html__('Left', 'topper-pack'),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => esc_html__('Center', 'topper-pack'),
						'icon' => 'eicon-text-align-center',
					],
					'right' => [
						'title' => esc_html__('Right', 'topper-pack'),
						'icon' => 'eicon-text-align-right',
					],
				],
				'default' => 'center',
				'toggle' => true,
				'selectors' => [
					'{{WRAPPER}} .topppa-product-wrp .product-items .topppa-store-product-img .topppa-product-offer' => 'text-align: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'offer_typo',
				'label' => __('Typography', 'topper-pack'),
				'selector' => ' {{WRAPPER}} .topppa-product-wrp .product-items .topppa-store-product-img .topppa-product-offer',
			]
		);
		$this->add_responsive_control(
			'offer_color',
			[
				'label' => esc_html__('Color', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .topppa-product-wrp .product-items .topppa-store-product-img .topppa-product-offer' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'sale_bg',
				'types' => ['classic', 'gradient', 'video'],
				'selector' => '{{WRAPPER}} .topppa-product-wrp .product-items .topppa-store-product-img .topppa-product-offer',
			]
		);
		$this->add_responsive_control(
			'sale_border_radius',
			[
				'label' => esc_html__('Border Radius', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .topppa-product-wrp .product-items .topppa-store-product-img .topppa-product-offer' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'sale_border',
				'selector' => '{{WRAPPER}} .topppa-product-wrp .product-items .topppa-store-product-img .topppa-product-offer',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'sale_box_shadow',
				'selector' => '{{WRAPPER}} .topppa-product-wrp .product-items .topppa-store-product-img .topppa-product-offer',
			]
		);
		$this->add_responsive_control(
			'offer_margin',
			[
				'label' => esc_html__('Margin', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .topppa-product-wrp .product-items .topppa-store-product-img .topppa-product-offer' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'offer_padding',
			[
				'label' => esc_html__('Padding', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .topppa-product-wrp .product-items .topppa-store-product-img .topppa-product-offer' => 'Padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'sale_positions_controls',
			[
				'label' => esc_html__('Position Controls', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_responsive_control(
			'sale_position_left_right',
			[
				'label' => esc_html__('Left To Right', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px', '%', 'em', 'rem', 'custom'],
				'range' => [
					'px' => [
						'min' => -1000,
						'max' => 1000,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .topppa-product-wrp .product-items .topppa-store-product-img .topppa-product-offer' => 'left: {{SIZE}}{{UNIT}};',
				],
				'description' => esc_html__('Adjust the horizontal position of the sale badge relative to the product image. Use positive values to move right, negative values to move left. Enter "auto" to use default positioning.', 'topper-pack'),
			]
		);
		$this->add_responsive_control(
			'sale_position_right_left',
			[
				'label' => esc_html__('Right To Left', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px', '%', 'em', 'rem', 'custom'],
				'range' => [
					'px' => [
						'min' => -1000,
						'max' => 1000,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .topppa-product-wrp .product-items .topppa-store-product-img .topppa-product-offer' => 'right: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'sale_position_top_bottom',
			[
				'label' => esc_html__('Top To Bottom', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px', '%', 'em', 'rem', 'custom'],
				'range' => [
					'px' => [
						'min' => -1000,
						'max' => 1000,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .topppa-product-wrp .product-items .topppa-store-product-img .topppa-product-offer' => 'top: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'sale_position_bottom_top',
			[
				'label' => esc_html__('Bottom To Top', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px', '%', 'em', 'rem', 'custom'],
				'range' => [
					'px' => [
						'min' => -1000,
						'max' => 1000,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .topppa-product-wrp .product-items .topppa-store-product-img .topppa-product-offer' => 'bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'rating_styles',
			[
				'label' => esc_html__('Rating', 'topper-pack'),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
				'condition' => [
					'enable_rating' => 'yes'
				]
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'rating_typo',
				'selector' => '{{WRAPPER}} .topppa-product-wrp .product-items .prodcut-rating i',
			]
		);
		$this->add_responsive_control(
			'rating_color',
			[
				'label'     => esc_html__('Color', 'topper-pack'),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .topppa-product-wrp .product-items .prodcut-rating i' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_responsive_control(
			'rating_margin',
			[
				'label'      => esc_html__('Margin', 'topper-pack'),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors'  => [
					'{{WRAPPER}} .topppa-product-wrp .product-items .prodcut-rating i' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'rating_padding',
			[
				'label'      => esc_html__('Padding', 'topper-pack'),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors'  => [
					'{{WRAPPER}} .topppa-product-wrp .product-items .prodcut-rating i' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'stock_status_styles',
			[
				'label' => esc_html__('Stock Status', 'topper-pack'),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
				'condition' => [
					'enable_stock_status' => 'yes'
				]
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'stock_background',
				'types' => ['classic', 'gradient', 'video'],
				'selector' => '{{WRAPPER}} .topppa-product-wrp .product-items .topppa-stock-status',
			]
		);
		$this->add_responsive_control(
			'stock_width',
			[
				'label' => esc_html__('Width', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px', '%', 'em', 'rem', 'custom'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .topppa-product-wrp .product-items .topppa-stock-status' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'stock_typography',
				'selector' => '{{WRAPPER}} .topppa-stock-status',
			]
		);
		$this->add_responsive_control(
			'stock_in_color',
			[
				'label'     => esc_html__('In Stock Color', 'topper-pack'),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .topppa-stock-status.in-stock' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_responsive_control(
			'stock_out_color',
			[
				'label'     => esc_html__('Out of Stock Color', 'topper-pack'),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .topppa-stock-status.out-of-stock' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_responsive_control(
			'stock_backorder_color',
			[
				'label'     => esc_html__('Backorder Color', 'topper-pack'),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .topppa-stock-status.on-backorder' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_responsive_control(
			'stock_background',
			[
				'label' => esc_html__('Background Color', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .topppa-stock-status' => 'background-color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'stock_border',
				'selector' => '{{WRAPPER}} .topppa-stock-status',
			]
		);
		$this->add_responsive_control(
			'stock_border_radius',
			[
				'label' => esc_html__('Border Radius', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .topppa-stock-status' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'stock_margin',
			[
				'label'      => esc_html__('Margin', 'topper-pack'),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors'  => [
					'{{WRAPPER}} .topppa-stock-status.on-backorder' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .topppa-stock-status.out-of-stock' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .topppa-stock-status.in-stock' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'stock_padding',
			[
				'label'      => esc_html__('Padding', 'topper-pack'),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors'  => [
					'{{WRAPPER}} .topppa-stock-status.on-backorder' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .topppa-stock-status.out-of-stock' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .topppa-stock-status.in-stock' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();

		// <==========>
		// <==========> ACTION STYLE <==========>

		$this->start_controls_section(
			'action_box_styles',
			[
				'label' => esc_html__('Actions', 'topper-pack'),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'left_img_positions_controls',
			[
				'label' => esc_html__('Position Controls', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_responsive_control(
			'left_img_position_left_right',
			[
				'label' => esc_html__('Left To Right', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px', '%', 'em', 'rem', 'custom'],
				'range' => [
					'px' => [
						'min' => -1000,
						'max' => 1000,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'.topppa-product-wrp .product-items .topppa-store-product-img .actions' => 'left: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'left_img_position_right_left',
			[
				'label' => esc_html__('Right To Left', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px', '%', 'em', 'rem', 'custom'],
				'range' => [
					'px' => [
						'min' => -1000,
						'max' => 1000,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .topppa-product-wrp .product-items .topppa-store-product-img .actions' => 'right: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'left_img_position_top_bottom',
			[
				'label' => esc_html__('Top To Bottom', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px', '%', 'em', 'rem', 'custom'],
				'range' => [
					'px' => [
						'min' => -1000,
						'max' => 1000,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .topppa-product-wrp .product-items .topppa-store-product-img .actions' => 'top: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'left_img_position_bottom_top',
			[
				'label' => esc_html__('Bottom To Top', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px', '%', 'em', 'rem', 'custom'],
				'range' => [
					'px' => [
						'min' => -1000,
						'max' => 1000,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .topppa-product-wrp .product-items .topppa-store-product-img .actions' => 'bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'actions_box_direction',
			[
				'label' => esc_html__('Direction', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => [
					'row' => esc_html__('Row', 'topper-pack'),
					'row-reverse' => esc_html__('Row Reverse', 'topper-pack'),
					'column' => esc_html__('Column', 'topper-pack'),
					'column-reverse' => esc_html__('Column Reverse', 'topper-pack'),
				],
				'selectors' => [
					'{{WRAPPER}} .topppa-product-wrp .product-items .topppa-store-product-img .actions' => 'flex-direction: {{VALUE}};',
				],
			]
		);
		$this->add_responsive_control(
			'actions_box_align',
			[
				'label' => esc_html__('Alignment', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => esc_html__('Left', 'topper-pack'),
						'icon' => 'eicon-align-start-h',
					],
					'center' => [
						'title' => esc_html__('Center', 'topper-pack'),
						'icon' => 'eicon-align-center-h',
					],
					'right' => [
						'title' => esc_html__('Right', 'topper-pack'),
						'icon' => 'eicon-align-end-h',
					],
				],
				'toggle' => true,
				'selectors' => [
					'{{WRAPPER}} .topppa-product-wrp .product-items .topppa-store-product-img .actions' => 'align-items: {{VALUE}};',
				],
			]
		);
		$this->add_responsive_control(
			'actions_box_gap',
			[
				'label' => esc_html__('Gap', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px', '%', 'em', 'rem', 'custom'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .topppa-product-wrp .product-items .topppa-store-product-img .actions' => 'gap: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'actions_box_bg',
				'label' => esc_html__('Background', 'topper-pack'),
				'types' => ['classic', 'gradient', 'video'],
				'selector' => '{{WRAPPER}} .topppa-product-wrp .product-items .topppa-store-product-img .actions',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'actions_box_border',
				'label' => esc_html__('Border', 'topper-pack'),
				'selector' => '{{WRAPPER}} .topppa-product-wrp .product-items .topppa-store-product-img .actions',
			]
		);
		$this->add_responsive_control(
			'actions_box_radius',
			[
				'label' => esc_html__('Border Radius', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .topppa-product-wrp .product-items .topppa-store-product-img .actions' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'actions_box_shadow',
				'label' => esc_html__('Box Shadow', 'topper-pack'),
				'selector' => '{{WRAPPER}} .topppa-product-wrp .product-items .topppa-store-product-img .actions',
			]
		);
		$this->add_responsive_control(
			'actions_box_margin',
			[
				'label' => esc_html__('Margin', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .topppa-product-wrp .product-items .topppa-store-product-img .actions' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'actions_box_padding',
			[
				'label' => esc_html__('Padding', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .topppa-product-wrp .product-items .topppa-store-product-img .actions' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'actions__icon',
			[
				'label' => esc_html__('Icons Style', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_responsive_control(
			'action_width',
			[
				'label' => esc_html__('Width', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px', '%', 'em', 'rem', 'custom'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 45,
				],
				'selectors' => [
					'{{WRAPPER}}  .topppa-product-wrp .product-items .topppa-store-product-img .actions a' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'action_height',
			[
				'label' => esc_html__('Height', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px', '%', 'em', 'rem', 'custom'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 45,
				],
				'selectors' => [
					'{{WRAPPER}}  .topppa-product-wrp .product-items .topppa-store-product-img .actions a' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'action_border',
				'selector' => '{{WRAPPER}} .topppa-product-wrp .product-items .topppa-store-product-img .actions a',
			]
		);
		$this->add_responsive_control(
			'action_radius',
			[
				'label' => esc_html__('Border Radius', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .topppa-product-wrp .product-items .topppa-store-product-img .actions a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'cart_typo',
				'selector' => '{{WRAPPER}} .topppa-product-wrp .product-items .topppa-store-product-img .actions a',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'actions_bg',
				'types' => ['classic', 'gradient', 'video'],
				'selector' => '{{WRAPPER}} .topppa-product-wrp .product-items .topppa-store-product-img .actions a',
			]
		);
		$this->add_responsive_control(
			'cart_color',
			[
				'label'     => esc_html__('Color', 'topper-pack'),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .topppa-product-wrp .product-items .topppa-store-product-img .actions a' => 'color: {{VALUE}}',
					'{{WRAPPER}} .topppa-product-wrp .product-items .topppa-store-product-img .actions a svg path' => 'fill: {{VALUE}}',
				],
			]
		);
		$this->add_responsive_control(
			'cart_hcolor',
			[
				'label'     => esc_html__('Hover Color', 'topper-pack'),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .topppa-product-wrp .product-items .topppa-store-product-img .actions a:hover' => 'color: {{VALUE}}',
					'{{WRAPPER}} .topppa-product-wrp .product-items .topppa-store-product-img .actions a:hover svg path' => 'fill: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'svg_divider',
			[
				'label' => esc_html__('Svg Icon', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_responsive_control(
			'wishlist_width',
			[
				'label' => esc_html__('Width', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px', '%', 'em', 'rem', 'custom'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 23,
				],
				'selectors' => [
					'{{WRAPPER}} .topppa-product-wrp .product-items .topppa-store-product-img .actions .yith-wcwl-add-to-wishlist-button.yith-wcwl-add-to-wishlist-button--anchor svg.yith-wcwl-icon-svg' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'wishlist_height',
			[
				'label' => esc_html__('Height', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px', '%', 'em', 'rem', 'custom'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 23,
				],
				'selectors' => [
					'{{WRAPPER}} .topppa-product-wrp .product-items .topppa-store-product-img .actions .yith-wcwl-add-to-wishlist-button.yith-wcwl-add-to-wishlist-button--anchor svg.yith-wcwl-icon-svg' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'cart_margin',
			[
				'label'      => esc_html__('Margin', 'topper-pack'),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors'  => [
					'{{WRAPPER}} .topppa-product-wrp .product-items .topppa-store-product-img .actions a' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'cart_padding',
			[
				'label'      => esc_html__('Padding', 'topper-pack'),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors'  => [
					'{{WRAPPER}} .topppa-product-wrp .product-items .topppa-store-product-img .actions a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();

		// <========================> CART BUTTON STYLES <========================>
		$this->start_controls_section(
			'topppa_btn_style',
			[
				'label' => esc_html__('Cart Button', 'topper-pack'),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
				'condition' => [
					'enable_add_to_cart_button' => 'yes',
				],
			]
		);

		$this->add_responsive_control(
			'flex_direction',
			[
				'label' => esc_html__('Flex Direction', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'row',
				'options' => [
					'row' => esc_html__('Row', 'topper-pack'),
					'row-reverse'  => esc_html__('Row Reverse', 'topper-pack'),
					'column' => esc_html__('Column', 'topper-pack'),
					'column-reverse' => esc_html__('Column Reverse', 'topper-pack'),
				],
				'selectors' => [
					'{{WRAPPER}} .topppa-product-wrp .product-items .topppa-store-content .cart-button .button-quntity-n-cart' => 'flex-direction: {{VALUE}};',
				],
				'condition' => [
					'topppa_widget_styles' => ['style_three', 'style_four']
				]
			]
		);
		$this->add_responsive_control(
			'align_items',
			[
				'label' => esc_html__('Item Alignment', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'options' => [
					'flex-start' => [
						'title' => esc_html__('Left', 'topper-pack'),
						'icon' => 'eicon-align-start-h',
					],
					'center' => [
						'title' => esc_html__('Center', 'topper-pack'),
						'icon' => 'eicon-align-center-v',
					],
					'flex-end' => [
						'title' => esc_html__('Right', 'topper-pack'),
						'icon' => 'eicon-align-end-h',
					],
				],
				'toggle' => true,
				'selectors' => [
					'{{WRAPPER}} .topppa-product-wrp .product-items .topppa-store-content .cart-button .button-quntity-n-cart' => 'align-items: {{VALUE}};',
				],
				'condition' => [
					'topppa_widget_styles' => ['style_three', 'style_four']
				]
			]
		);
		$this->add_responsive_control(
			'justify_content',
			[
				'label' => esc_html__('Justify Content', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'options' => [
					'flex-start' => [
						'title' => esc_html__('Left', 'topper-pack'),
						'icon' => 'eicon-justify-start-h',
					],
					'center' => [
						'title' => esc_html__('Center', 'topper-pack'),
						'icon' => 'eicon-justify-center-h',
					],
					'flex-end' => [
						'title' => esc_html__('Right', 'topper-pack'),
						'icon' => 'eicon-justify-end-h',
					],
				],
				'toggle' => true,
				'selectors' => [
					'{{WRAPPER}} .topppa-product-wrp .product-items .topppa-store-content .cart-button .button-quntity-n-cart' => 'justify-content: {{VALUE}};',
				],
				'condition' => [
					'flex_direction' => ['row', 'row-reverse'],
					'topppa_widget_styles' => ['style_three', 'style_four']
				],
			]
		);
		$this->add_responsive_control(
			'align_content',
			[
				'label' => esc_html__('Align Content', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'options' => [
					'flex-start' => [
						'title' => esc_html__('Left', 'topper-pack'),
						'icon' => 'eicon-justify-start-h',
					],
					'center' => [
						'title' => esc_html__('Center', 'topper-pack'),
						'icon' => 'eicon-justify-center-h',
					],
					'flex-end' => [
						'title' => esc_html__('Right', 'topper-pack'),
						'icon' => 'eicon-justify-end-h',
					],
					'space-between' => [
						'title' => esc_html__('Space Between', 'topper-pack'),
						'icon' => 'eicon-justify-space-between-h',
					],
					'space-around' => [
						'title' => esc_html__('Space Around', 'topper-pack'),
						'icon' => 'eicon-justify-space-around-h',
					],
					'space-evenly' => [
						'title' => esc_html__('Space Evenly', 'topper-pack'),
						'icon' => 'eicon-justify-space-evenly-h',
					],
				],
				'toggle' => true,
				'selectors' => [
					'{{WRAPPER}} .topppa-product-wrp .product-items .topppa-store-content .cart-button .button-quntity-n-cart' => 'align-content: {{VALUE}};',
				],
				'condition' => [
					'flex_direction' => ['column', 'column-reverse'],
					'topppa_widget_styles' => ['style_three', 'style_four']
				],
			]
		);
		$this->add_responsive_control(
			'cartbtn_width',
			[
				'label' => esc_html__('Width', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px', '%', 'em', 'rem', 'custom'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .topppa-product-wrp.style-four .product-items .topppa-store-product-img .cart-button .topppa-btn' => 'width: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'topppa_widget_styles' => 'style_four'
				]
			]
		);
		$this->add_responsive_control(
			'topppa_btn_icon_gap',
			[
				'label'      => esc_html__('Icon Gap', 'topper-pack'),
				'type'       => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px', '%'],
				'range'      => [
					'px' => [
						'min'  => 0,
						'max'  => 100,
						'step' => 1,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .topppa-product-wrp.style-three .product-items .topppa-store-content .cart-button .topppa-btn, .topppa-product-wrp .product-items .topppa-store-product-img .cart-button .topppa-btn' => 'gap: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'topppa_show_icon' => 'yes'
				]
			]
		);

		$this->start_controls_tabs(
			'topppa_btn_content_tabs'
		);

		$this->start_controls_tab(
			'topppa_btn_normal',
			[
				'label' => __('Normal', 'topper-pack'),
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'topppa_btn_typo',
				'selector' => '{{WRAPPER}} .topppa-product-wrp.style-three .product-items .topppa-store-content .cart-button .topppa-btn, .topppa-product-wrp .product-items .topppa-store-product-img .cart-button .topppa-btn',
			]
		);

		$this->add_responsive_control(
			'topppa_btn_color',
			[
				'label'     => esc_html__('Color', 'topper-pack'),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .topppa-product-wrp.style-three .product-items .topppa-store-content .cart-button .topppa-btn span, .topppa-product-wrp .product-items .topppa-store-product-img .cart-button .topppa-btn' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'topppa_btn_background',
				'types' => ['classic', 'gradient', 'video'],
				'selector' => '{{WRAPPER}} .topppa-product-wrp.style-three .product-items .topppa-store-content .cart-button .topppa-btn, {{WRAPPER}} .topppa-product-wrp .product-items .topppa-store-product-img .cart-button .topppa-btn',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name'     => 'topppa_btn_border',
				'label'    => esc_html__('Border', 'topper-pack'),
				'selector' => '{{WRAPPER}} .topppa-product-wrp.style-three .product-items .topppa-store-content .cart-button .topppa-btn, .topppa-product-wrp .product-items .topppa-store-product-img .cart-button .topppa-btn',
			]
		);

		$this->add_responsive_control(
			'topppa_btn_border_radius',
			[
				'label'      => esc_html__('Border Radius', 'topper-pack'),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors'  => [
					'{{WRAPPER}} .topppa-product-wrp.style-three .product-items .topppa-store-content .cart-button .topppa-btn, .topppa-product-wrp .product-items .topppa-store-product-img .cart-button .topppa-btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'topppa_btn_box_shadow',
				'label'    => esc_html__('Shadow', 'topper-pack'),
				'selector' => '{{WRAPPER}} .topppa-product-wrp.style-three .product-items .topppa-store-content .cart-button .topppa-btn, .topppa-product-wrp .product-items .topppa-store-product-img .cart-button .topppa-btn',
			]
		);

		$this->add_control(
			'topppa_btn_icon_styles',
			[
				'label' => esc_html__('Icon Styles', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'topppa_btn_icon_width',
			[
				'label' => esc_html__('Width', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px', '%', 'em', 'rem', 'custom'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .topppa-product-wrp.style-three .product-items .topppa-store-content .cart-button .topppa-btn, .topppa-product-wrp .product-items .topppa-store-product-img .cart-button .topppa-btn i' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'topppa_btn_icon_height',
			[
				'label' => esc_html__('Height', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px', '%', 'em', 'rem', 'custom'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .topppa-product-wrp.style-three .product-items .topppa-store-content .cart-button .topppa-btn, .topppa-product-wrp .product-items .topppa-store-product-img .cart-button .topppa-btn i' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'topppa_btn_icon_content_typography',
				'selector' => '{{WRAPPER}} .topppa-product-wrp.style-three .product-items .topppa-store-content .cart-button .topppa-btn, .topppa-product-wrp .product-items .topppa-store-product-img .cart-button .topppa-btn i',
			]
		);
		$this->add_responsive_control(
			'topppa_btn_icon_color',
			[
				'label' => esc_html__('Color', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .topppa-product-wrp.style-three .product-items .topppa-store-content .cart-button .topppa-btn, .topppa-product-wrp .product-items .topppa-store-product-img .cart-button .topppa-btn i' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'topppa_btn_icon_bg',
				'types' => ['classic', 'gradient', 'video'],
				'selector' => '{{WRAPPER}} .topppa-product-wrp.style-three .product-items .topppa-store-content .cart-button .topppa-btn, .topppa-product-wrp .product-items .topppa-store-product-img .cart-button .topppa-btn i',
			]
		);
		$this->add_responsive_control(
			'topppa_btn_icon_border_radius',
			[
				'label' => esc_html__('Border Radius', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .topppa-product-wrp.style-three .product-items .topppa-store-content .cart-button .topppa-btn, .topppa-product-wrp .product-items .topppa-store-product-img .cart-button .topppa-btn i' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'topppa_btn_margin',
			[
				'label'      => esc_html__('Margin', 'topper-pack'),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors'  => [
					'{{WRAPPER}} .topppa-product-wrp.style-three .product-items .topppa-store-content .cart-button .topppa-btn, .topppa-product-wrp .product-items .topppa-store-product-img .cart-button .topppa-btn' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'topppa_btn_padding',
			[
				'label'      => esc_html__('Padding', 'topper-pack'),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors'  => [
					'{{WRAPPER}} .topppa-product-wrp.style-three .product-items .topppa-store-content .cart-button .topppa-btn, .topppa-product-wrp .product-items .topppa-store-product-img .cart-button .topppa-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'topppa_btn_hover',
			[
				'label' => __('Hover', 'topper-pack'),
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'topppa_btn_typography_hover',
				'selector' => '{{WRAPPER}} .topppa-product-wrp.style-three .product-items .topppa-store-content .cart-button .topppa-btn:hover, {{WRAPPER}} .topppa-product-wrp.style-three .product-items .topppa-store-content .cart-button .topppa-btn:hover',
			]
		);

		$this->add_responsive_control(
			'topppa_btn_color_hover',
			[
				'label'     => esc_html__('Color', 'topper-pack'),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .topppa-product-wrp.style-three .product-items .topppa-store-content .cart-button .topppa-btn:hover span, .topppa-product-wrp .product-items .topppa-store-product-img .cart-button .topppa-btn:hover' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'topppa_btn_background_hover',
				'types' => ['classic', 'gradient', 'video'],
				'selector' => '{{WRAPPER}} .topppa-product-wrp.style-three .product-items .topppa-store-content .cart-button .topppa-btn::after, {{WRAPPER}} .topppa-product-wrp .product-items .topppa-store-product-img .cart-button .topppa-btn::after',
				'condition' => [
					'topppa_btn_styles' => ['style_three', 'style_six', 'style_seven']
				]
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'topppa_btn_background_hover2',
				'types' => ['classic', 'gradient', 'video'],
				'selector' => '{{WRAPPER}} .topppa-product-wrp.style-three .product-items .topppa-store-content .cart-button .topppa-btn::after, {{WRAPPER}} .topppa-product-wrp.style-three .product-items .topppa-store-content .cart-button .topppa-btn::before, {{WRAPPER}} .topppa-product-wrp .product-items .topppa-store-product-img .cart-button .topppa-btn::after, {{WRAPPER}} .topppa-product-wrp .product-items .topppa-store-product-img .cart-button .topppa-btn::before',
				'condition' => [
					'topppa_btn_styles!' => ['style_three', 'style_six', 'style_seven', 'style_twelve'],
				]
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name'     => 'topppa_btn_border_hover',
				'label'    => esc_html__('Border', 'topper-pack'),
				'selector' => '{{WRAPPER}} .topppa-product-wrp.style-three .product-items .topppa-store-content .cart-button .topppa-btn:hover, .topppa-product-wrp .product-items .topppa-store-product-img .cart-button .topppa-btn:hover',
			]
		);

		$this->add_responsive_control(
			'topppa_btn_border_radius_hover',
			[
				'label'      => esc_html__('Border Radius', 'topper-pack'),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors'  => [
					'{{WRAPPER}} .topppa-product-wrp.style-three .product-items .topppa-store-content .cart-button .topppa-btn:hover, .topppa-product-wrp .product-items .topppa-store-product-img .cart-button .topppa-btn:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'topppa_btn_box_shadow_hover',
				'label'    => esc_html__('Shadow', 'topper-pack'),
				'selector' => '{{WRAPPER}} .topppa-product-wrp.style-three .product-items .topppa-store-content .cart-button .topppa-btn:hover, .topppa-product-wrp .product-items .topppa-store-product-img .cart-button .topppa-btn:hover',
			]
		);

		$this->add_control(
			'topppa_btn_icon_hstyles',
			[
				'label' => esc_html__('Icon Styles', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'topppa_btn_icon_hborder_radius',
			[
				'label' => esc_html__('Border Radius', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .topppa-product-wrp.style-three .product-items .topppa-store-content .cart-button .topppa-btn:hover i, .topppa-product-wrp .product-items .topppa-store-product-img .cart-button .topppa-btn:hover i' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'topppa_btn_icon_icolor',
			[
				'label' => esc_html__('Color', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .topppa-product-wrp.style-three .product-items .topppa-store-content .cart-button .topppa-btn:hover i, .topppa-product-wrp .product-items .topppa-store-product-img .cart-button .topppa-btn:hover i' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'topppa_btn_icon_hbgcolor',
				'types' => ['classic', 'gradient', 'video'],
				'selector' => '{{WRAPPER}} .topppa-product-wrp.style-three .product-items .topppa-store-content .cart-button .topppa-btn:hover i, .topppa-product-wrp .product-items .topppa-store-product-img .cart-button .topppa-btn:hover i',
				'condition' => [
					'topppa_btn_styles!' => 'style_eight'
				]
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'topppa_btn_icon_hbgcolor2',
				'types' => ['classic', 'gradient', 'video'],
				'selector' => '{{WRAPPER}} .topppa-product-wrp.style-three .product-items .topppa-store-content .cart-button .topppa-btn:hover i::before, .topppa-product-wrp .product-items .topppa-store-product-img .cart-button .topppa-btn:hover i::before',
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();

		// Quantity Input Styles
		$this->add_control(
			'quantity_style_heading',
			[
				'label' => esc_html__('Quantity Input', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => [
					'enable_quantity' => 'yes',
				],
			]
		);

		$this->add_responsive_control(
			'quantity_width',
			[
				'label' => esc_html__('Width', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px', '%', 'em', 'rem'],
				'range' => [
					'px' => [
						'min' => 40,
						'max' => 200,
						'step' => 1,
					],
					'%' => [
						'min' => 10,
						'max' => 100,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 60,
				],
				'selectors' => [
					'{{WRAPPER}} .topppa-product-wrp .product-items .topppa-store-content .cart-button .topppa-quantity-input' => 'width: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'enable_quantity' => 'yes',
				],
			]
		);

		$this->add_responsive_control(
			'quantity_height',
			[
				'label' => esc_html__('Height', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px', 'em', 'rem'],
				'range' => [
					'px' => [
						'min' => 25,
						'max' => 80,
						'step' => 1,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 40,
				],
				'selectors' => [
					'{{WRAPPER}} .topppa-product-wrp .product-items .topppa-store-content .cart-button .topppa-quantity-input' => 'height: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'enable_quantity' => 'yes',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'quantity_typography',
				'selector' => '{{WRAPPER}} .topppa-product-wrp .product-items .topppa-store-content .cart-button .topppa-quantity-input',
				'condition' => [
					'enable_quantity' => 'yes',
				],
			]
		);

		$this->add_responsive_control(
			'quantity_color',
			[
				'label' => esc_html__('Color', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .topppa-product-wrp .product-items .topppa-store-content .cart-button .topppa-quantity-input' => 'color: {{VALUE}};',
				],
				'condition' => [
					'enable_quantity' => 'yes',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'quantity_background',
				'types' => ['classic', 'gradient', 'video'],
				'selector' => '{{WRAPPER}} .topppa-product-wrp .product-items .topppa-store-content .cart-button .topppa-quantity-input',
				'condition' => [
					'enable_quantity' => 'yes',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'quantity_border',
				'selector' => '{{WRAPPER}} .topppa-product-wrp .product-items .topppa-store-content .cart-button .topppa-quantity-input',
				'condition' => [
					'enable_quantity' => 'yes',
				],
			]
		);

		$this->add_responsive_control(
			'quantity_border_radius',
			[
				'label' => esc_html__('Border Radius', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .topppa-product-wrp .product-items .topppa-store-content .cart-button .topppa-quantity-input' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'enable_quantity' => 'yes',
				],
			]
		);

		$this->add_responsive_control(
			'quantity_margin',
			[
				'label' => esc_html__('Margin', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .topppa-product-wrp .product-items .topppa-store-content .cart-button .topppa-quantity-input' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'enable_quantity' => 'yes',
				],
			]
		);

		$this->add_responsive_control(
			'quantity_padding',
			[
				'label' => esc_html__('Padding', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .topppa-product-wrp .product-items .topppa-store-content .cart-button .topppa-quantity-input' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'enable_quantity' => 'yes',
				],
			]
		);
		$this->end_controls_section();

		// <==========>
		// <==========> BOX STYLES <==========>

		$this->start_controls_section(
			'quick_view_box_styles',
			[
				'label' => esc_html__('Quick View Box', 'topper-pack'),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name'     => 'quick_view_box_bg',
				'label'    => esc_html__('Popup Background', 'topper-pack'),
				'types'    => ['classic', 'gradient'],
				'selector' => '.quick-view-{{ID}} .topppa-quick-view-wrap',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'quick_view_box_border',
				'label' => esc_html__('Border', 'topper-pack'),
				'selector' => '.quick-view-{{ID}} .topppa-quick-view-wrap',
			]
		);
		$this->add_responsive_control(
			'quick_view_box_radius',
			[
				'label' => esc_html__('Border Radius', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'.quick-view-{{ID}} .topppa-quick-view-wrap' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'quick_view_box_shadow',
				'label' => esc_html__('Box Shadow', 'topper-pack'),
				'selector' => '.quick-view-{{ID}} .topppa-quick-view-wrap',
			]
		);
		$this->add_responsive_control(
			'quick_view_box_margin',
			[
				'label' => esc_html__('Margin', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'.quick-view-{{ID}} .topppa-quick-view-wrap' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'quick_view_box_box_padding',
			[
				'label' => esc_html__('Padding', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'.quick-view-{{ID}} .topppa-quick-view-wrap' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'qv_content',
			[
				'label' => esc_html__('Quick View Content', 'topper-pack'),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->start_controls_tabs(
			'qv_content_style_tabs'
		);
		$this->start_controls_tab(
			'qv_price_title_tab',
			[
				'label' => esc_html__('Title', 'topper-pack'),
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'qv_price_title_typo',
				'selector' => '.quick-view-{{ID}} .topppa-quick-view-wrap .topppa-quick-view-content-box .topppa-product-title h2',
			]
		);
		$this->add_responsive_control(
			'qv_price_title_color',
			[
				'label'     => esc_html__('Color', 'topper-pack'),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'.quick-view-{{ID}} .topppa-quick-view-wrap .topppa-quick-view-content-box .topppa-product-title h2' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_responsive_control(
			'qv_price_title_jcolor',
			[
				'label'     => esc_html__('Color', 'topper-pack'),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'.quick-view-{{ID}} .topppa-quick-view-wrap .topppa-quick-view-content-box .topppa-product-title h2:hover' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_responsive_control(
			'qv_price_title_margin',
			[
				'label'      => esc_html__('Margin', 'topper-pack'),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors'  => [
					'.quick-view-{{ID}} .topppa-quick-view-wrap .topppa-quick-view-content-box .topppa-product-title h2' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'qv_price_title_padding',
			[
				'label'      => esc_html__('Padding', 'topper-pack'),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors'  => [
					'.quick-view-{{ID}} .topppa-quick-view-wrap .topppa-quick-view-content-box .topppa-product-title h2' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_tab();

		$this->start_controls_tab(
			'qv_price_style_tab',
			[
				'label' => esc_html__('Price', 'topper-pack'),
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'qv_price_typo',
				'selector' => '.quick-view-{{ID}} .topppa-quick-view-wrap .topppa-quick-view-price.topppa-product-price p',
			]
		);
		$this->add_responsive_control(
			'qv_price_color',
			[
				'label'     => esc_html__('Color', 'topper-pack'),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'.quick-view-{{ID}} .topppa-quick-view-wrap .topppa-quick-view-price.topppa-product-price p' => 'color: {{VALUE}}',
					'.quick-view-{{ID}} .topppa-quick-view-wrap .topppa-quick-view-price.topppa-product-price p ins' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_responsive_control(
			'qv_main_price_color',
			[
				'label'     => esc_html__('Main Price Color', 'topper-pack'),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'.quick-view-{{ID}} .topppa-quick-view-wrap .topppa-quick-view-price.topppa-product-price p del' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_responsive_control(
			'qv_price_margin',
			[
				'label'      => esc_html__('Margin', 'topper-pack'),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors'  => [
					'.quick-view-{{ID}} .topppa-quick-view-wrap .topppa-quick-view-price.topppa-product-price p' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'qv_price_padding',
			[
				'label'      => esc_html__('Padding', 'topper-pack'),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors'  => [
					'.quick-view-{{ID}} .topppa-quick-view-wrap .topppa-quick-view-price.topppa-product-price p' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'quick_view_offer_styles',
			[
				'label' => esc_html__('Quick View Offer Price', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'quick_view_offer_typo',
				'selector' => '.quick-view-{{ID}} .topppa-quick-view-wrap .topppa-product-offer',
			]
		);
		$this->add_responsive_control(
			'quick_view_offer_color',
			[
				'label'     => esc_html__('Color', 'topper-pack'),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'.quick-view-{{ID}} .topppa-quick-view-wrap .topppa-product-offer' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'quick_view_sale_bg',
				'types' => ['classic', 'gradient', 'video'],
				'selector' => '.quick-view-{{ID}} .topppa-quick-view-wrap .topppa-product-offer',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'quick_view_offer_border',
				'selector' => '.quick-view-{{ID}} .topppa-quick-view-wrap .topppa-product-offer',
			]
		);
		$this->add_responsive_control(
			'quick_view_sale_border_radius',
			[
				'label' => esc_html__('Border Radius', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'.quick-view-{{ID}} .topppa-quick-view-wrap .topppa-product-offer' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'quick_view_offer_box_shadow',
				'selector' => '.quick-view-{{ID}} .topppa-quick-view-wrap .topppa-product-offer',
			]
		);
		$this->add_responsive_control(
			'quick_view_offer_padding',
			[
				'label'      => esc_html__('Padding', 'topper-pack'),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors'  => [
					'.quick-view-{{ID}} .topppa-quick-view-wrap .topppa-product-offer' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_tab();

		$this->start_controls_tab(
			'qv_rating_tab',
			[
				'label' => esc_html__('Rating', 'topper-pack'),
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'qv_rating_typo',
				'selector' => '.quick-view-{{ID}} .topppa-quick-view-wrap .topppa-quick-view-content-box .topppa-product-rating',
			]
		);
		$this->add_responsive_control(
			'qv_rating_color',
			[
				'label'     => esc_html__('Color', 'topper-pack'),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'.quick-view-{{ID}} .topppa-quick-view-wrap .topppa-quick-view-content-box .topppa-product-rating' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_responsive_control(
			'qv_rating_margin',
			[
				'label'      => esc_html__('Margin', 'topper-pack'),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors'  => [
					'.quick-view-{{ID}} .topppa-quick-view-wrap .topppa-quick-view-content-box .topppa-product-rating' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'qv_rating_padding',
			[
				'label'      => esc_html__('Padding', 'topper-pack'),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors'  => [
					'.quick-view-{{ID}} .topppa-quick-view-wrap .topppa-quick-view-content-box .topppa-product-rating' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_tab();

		$this->start_controls_tab(
			'qv_desc_tab',
			[
				'label' => esc_html__('Desc', 'topper-pack'),
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'qv_desc_typo',
				'selector' => '.quick-view-{{ID}} .topppa-quick-view-wrap .topppa-quick-view-content-box .topppa-product-description .woocommerce-product-details__short-description p',
			]
		);
		$this->add_responsive_control(
			'qv_desc_color',
			[
				'label'     => esc_html__('Color', 'topper-pack'),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'.quick-view-{{ID}} .topppa-quick-view-wrap .topppa-quick-view-content-box .topppa-product-description .woocommerce-product-details__short-description p' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_responsive_control(
			'qv_desc_margin',
			[
				'label'      => esc_html__('Margin', 'topper-pack'),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors'  => [
					'.quick-view-{{ID}} .topppa-quick-view-wrap .topppa-quick-view-content-box .topppa-product-description .woocommerce-product-details__short-description p' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'qv_desc_padding',
			[
				'label'      => esc_html__('Padding', 'topper-pack'),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors'  => [
					'.quick-view-{{ID}} .topppa-quick-view-wrap .topppa-quick-view-content-box .topppa-product-description .woocommerce-product-details__short-description p' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();

		// Quick View Cart Button
		$this->start_controls_section(
			'qv_cart_content',
			[
				'label' => esc_html__('Quick View Cart Button', 'topper-pack'),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'qv_cart_flex_direction',
			[
				'label' => esc_html__('Flex Direction', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'row',
				'options' => [
					'row' => esc_html__('Row', 'topper-pack'),
					'row-reverse'  => esc_html__('Row Reverse', 'topper-pack'),
					'column' => esc_html__('Column', 'topper-pack'),
					'column-reverse' => esc_html__('Column Reverse', 'topper-pack'),
				],
				'selectors' => [
					'.quick-view-{{ID}} .topppa-quick-view-wrap .topppa-quick-view-content-box .topppa-product-cart-and-quantity form' => 'flex-direction: {{VALUE}};',
				],
			]
		);
		$this->add_responsive_control(
			'qv_cart_align_items',
			[
				'label' => esc_html__('Item Alignment', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'options' => [
					'flex-start' => [
						'title' => esc_html__('Left', 'topper-pack'),
						'icon' => 'eicon-align-start-h',
					],
					'center' => [
						'title' => esc_html__('Center', 'topper-pack'),
						'icon' => 'eicon-align-center-v',
					],
					'flex-end' => [
						'title' => esc_html__('Right', 'topper-pack'),
						'icon' => 'eicon-align-end-h',
					],
				],
				'toggle' => true,
				'selectors' => [
					'.quick-view-{{ID}} .topppa-quick-view-wrap .topppa-quick-view-content-box .topppa-product-cart-and-quantity form' => 'align-items: {{VALUE}};',
				],
			]
		);
		$this->add_responsive_control(
			'qv_cart_justify_content',
			[
				'label' => esc_html__('Justify Content', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'options' => [
					'flex-start' => [
						'title' => esc_html__('Left', 'topper-pack'),
						'icon' => 'eicon-justify-start-h',
					],
					'center' => [
						'title' => esc_html__('Center', 'topper-pack'),
						'icon' => 'eicon-justify-center-h',
					],
					'flex-end' => [
						'title' => esc_html__('Right', 'topper-pack'),
						'icon' => 'eicon-justify-end-h',
					],
				],
				'toggle' => true,
				'selectors' => [
					'.quick-view-{{ID}} .topppa-quick-view-wrap .topppa-quick-view-content-box .topppa-product-cart-and-quantity form' => 'justify-content: {{VALUE}};',
				],
				'condition' => [
					'flex_direction' => ['row', 'row-reverse'],
				],
			]
		);
		$this->add_responsive_control(
			'qv_cart_align_content',
			[
				'label' => esc_html__('Align Content', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'options' => [
					'flex-start' => [
						'title' => esc_html__('Left', 'topper-pack'),
						'icon' => 'eicon-justify-start-h',
					],
					'center' => [
						'title' => esc_html__('Center', 'topper-pack'),
						'icon' => 'eicon-justify-center-h',
					],
					'flex-end' => [
						'title' => esc_html__('Right', 'topper-pack'),
						'icon' => 'eicon-justify-end-h',
					],
					'space-between' => [
						'title' => esc_html__('Space Between', 'topper-pack'),
						'icon' => 'eicon-justify-space-between-h',
					],
					'space-around' => [
						'title' => esc_html__('Space Around', 'topper-pack'),
						'icon' => 'eicon-justify-space-around-h',
					],
					'space-evenly' => [
						'title' => esc_html__('Space Evenly', 'topper-pack'),
						'icon' => 'eicon-justify-space-evenly-h',
					],
				],
				'toggle' => true,
				'selectors' => [
					'.quick-view-{{ID}} .topppa-quick-view-wrap .topppa-quick-view-content-box .topppa-product-cart-and-quantity form' => 'align-content: {{VALUE}};',
				],
				'condition' => [
					'flex_direction' => ['column', 'column-reverse'],
				],
			]
		);
		$this->add_responsive_control(
			'qv_cart_width',
			[
				'label' => esc_html__('Gap', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px', '%', 'em', 'rem', 'custom'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'.quick-view-{{ID}} .topppa-quick-view-wrap .topppa-quick-view-content-box .topppa-product-cart-and-quantity form' => 'gap: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->start_controls_tabs(
			'qv_cart_style_tabs'
		);
		$this->start_controls_tab(
			'qv_input_tab',
			[
				'label' => esc_html__('Input', 'topper-pack'),
			]
		);
		$this->add_responsive_control(
			'qv_input_width',
			[
				'label' => esc_html__('Width', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px', '%', 'em', 'rem', 'custom'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'.quick-view-{{ID}} .topppa-quick-view-wrap .topppa-quick-view-content-box .topppa-product-cart-and-quantity form .quantity input' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'qv_input_height',
			[
				'label' => esc_html__('Height', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px', '%', 'em', 'rem', 'custom'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'.quick-view-{{ID}} .topppa-quick-view-wrap .topppa-quick-view-content-box .topppa-product-cart-and-quantity form .quantity input' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'qv_input_typo',
				'selector' => '.quick-view-{{ID}} .topppa-quick-view-wrap .topppa-quick-view-content-box .topppa-product-cart-and-quantity form .quantity input',
			]
		);
		$this->add_responsive_control(
			'qv_input_color',
			[
				'label'     => esc_html__('Color', 'topper-pack'),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'.quick-view-{{ID}} .topppa-quick-view-wrap .topppa-quick-view-content-box .topppa-product-cart-and-quantity form .quantity input' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'qv_input_border',
				'selector' => '.quick-view-{{ID}} .topppa-quick-view-wrap .topppa-quick-view-content-box .topppa-product-cart-and-quantity form .quantity input',
			]
		);
		$this->add_responsive_control(
			'qv_input_border_radius',
			[
				'label' => esc_html__('Border Radius', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'.quick-view-{{ID}} .topppa-quick-view-wrap .topppa-quick-view-content-box .topppa-product-cart-and-quantity form .quantity input' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'qv_input_box_shadow',
				'selector' => '.quick-view-{{ID}} .topppa-quick-view-wrap .topppa-quick-view-content-box .topppa-product-cart-and-quantity form .quantity input',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'qv_input_background',
				'types' => ['classic', 'gradient', 'video'],
				'selector' => '.quick-view-{{ID}} .topppa-quick-view-wrap .topppa-quick-view-content-box .topppa-product-cart-and-quantity form .quantity input',
			]
		);
		$this->add_responsive_control(
			'qv_input_margin',
			[
				'label'      => esc_html__('Margin', 'topper-pack'),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors'  => [
					'.quick-view-{{ID}} .topppa-quick-view-wrap .topppa-quick-view-content-box .topppa-product-cart-and-quantity form .quantity input' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'qv_input_padding',
			[
				'label'      => esc_html__('Padding', 'topper-pack'),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors'  => [
					'.quick-view-{{ID}} .topppa-quick-view-wrap .topppa-quick-view-content-box .topppa-product-cart-and-quantity form .quantity input' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_tab();

		$this->start_controls_tab(
			'qv_cart_btn_tab',
			[
				'label' => esc_html__('Button', 'topper-pack'),
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'qv_cart_btn_typo',
				'selector' => '.quick-view-{{ID}} .topppa-quick-view-wrap .topppa-quick-view-content-box button.single_add_to_cart_button.button.alt',
			]
		);
		$this->add_responsive_control(
			'qv_cart_btn_color',
			[
				'label'     => esc_html__('Color', 'topper-pack'),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'.quick-view-{{ID}} .topppa-quick-view-wrap .topppa-quick-view-content-box button.single_add_to_cart_button.button.alt' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_responsive_control(
			'qv_cart_btn_hcolor',
			[
				'label'     => esc_html__('Hover Color', 'topper-pack'),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'.quick-view-{{ID}} .topppa-quick-view-wrap .topppa-quick-view-content-box button.single_add_to_cart_button.button.alt:hover' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'qv_cart_btn_background',
				'types' => ['classic', 'gradient', 'video'],
				'selector' => '.quick-view-{{ID}} .topppa-quick-view-wrap .topppa-quick-view-content-box button.single_add_to_cart_button.button.alt',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'qv_cart_btn_hbackground',
				'label' => esc_html__('Hover Background', 'topper-pack'),
				'types' => ['classic'],
				'selector' => '.quick-view-{{ID}} .topppa-quick-view-wrap .topppa-quick-view-content-box button.single_add_to_cart_button.button.alt:hover',
				'fields_options' => [
					'background' => [
						'label' => esc_html__('Hover Background', 'topper-pack'),
					],
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'qv_cart_btn_border',
				'selector' => '.quick-view-{{ID}} .topppa-quick-view-wrap .topppa-quick-view-content-box button.single_add_to_cart_button.button.alt',
			]
		);
		$this->add_responsive_control(
			'qv_cart_btn_border_radius',
			[
				'label' => esc_html__('Border Radius', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'.quick-view-{{ID}} .topppa-quick-view-wrap .topppa-quick-view-content-box button.single_add_to_cart_button.button.alt' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'qv_cart_btn_box_shadow',
				'selector' => '.quick-view-{{ID}} .topppa-quick-view-wrap .topppa-quick-view-content-box button.single_add_to_cart_button.button.alt',
			]
		);
		$this->add_responsive_control(
			'qv_cart_btn_margin',
			[
				'label'      => esc_html__('Margin', 'topper-pack'),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors'  => [
					'.quick-view-{{ID}} .topppa-quick-view-wrap .topppa-quick-view-content-box button.single_add_to_cart_button.button.alt' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'qv_cart_btn_padding',
			[
				'label'      => esc_html__('Padding', 'topper-pack'),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors'  => [
					'.quick-view-{{ID}} .topppa-quick-view-wrap .topppa-quick-view-content-box button.single_add_to_cart_button.button.alt' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_tab();

		$this->start_controls_tab(
			'qv_meta_tab',
			[
				'label' => esc_html__('Meta', 'topper-pack'),
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'qv_meta_typo',
				'selector' => '.quick-view-{{ID}} .topppa-quick-view-wrap .topppa-quick-view-content-box .product_meta span',
			]
		);
		$this->add_responsive_control(
			'qv_meta_color',
			[
				'label'     => esc_html__('Color', 'topper-pack'),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'.quick-view-{{ID}} .topppa-quick-view-wrap .topppa-quick-view-content-box .product_meta span, .quick-view-{{ID}} .topppa-quick-view-wrap .topppa-quick-view-content-box .product_meta span a' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_responsive_control(
			'qv_meta_hcolor',
			[
				'label'     => esc_html__('Hover Color', 'topper-pack'),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'.quick-view-{{ID}} .topppa-quick-view-wrap .topppa-quick-view-content-box .product_meta span, .quick-view-{{ID}} .topppa-quick-view-wrap .topppa-quick-view-content-box .product_meta span a:hover' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'qv_meta_border',
				'selector' => '.quick-view-{{ID}} .topppa-quick-view-wrap .topppa-quick-view-content-box .product_meta span',
			]
		);
		$this->add_responsive_control(
			'qv_meta_border_radius',
			[
				'label' => esc_html__('Border Radius', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'.quick-view-{{ID}} .topppa-quick-view-wrap .topppa-quick-view-content-box .product_meta span' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'qv_meta_box_shadow',
				'selector' => '.quick-view-{{ID}} .topppa-quick-view-wrap .topppa-quick-view-content-box .product_meta span',
			]
		);
		$this->add_responsive_control(
			'qv_meta_margin',
			[
				'label'      => esc_html__('Margin', 'topper-pack'),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors'  => [
					'.quick-view-{{ID}} .topppa-quick-view-wrap .topppa-quick-view-content-box .product_meta span' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'qv_meta_padding',
			[
				'label'      => esc_html__('Padding', 'topper-pack'),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors'  => [
					'.quick-view-{{ID}} .topppa-quick-view-wrap .topppa-quick-view-content-box .product_meta span' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();

		$this->start_controls_section(
			'qv_close_tab',
			[
				'label' => esc_html__('Close Button', 'topper-pack'),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'qv_close_typo',
				'selector' => '.quick-view-{{ID}} button.mfp-close',
			]
		);
		$this->add_responsive_control(
			'qv_close_color',
			[
				'label'     => esc_html__('Color', 'topper-pack'),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'.quick-view-{{ID}} button.mfp-close' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_responsive_control(
			'qv_close_hcolor',
			[
				'label'     => esc_html__('Hover Color', 'topper-pack'),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'.quick-view-{{ID}} button.mfp-close:hover' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'qv_close_background',
				'types' => ['classic', 'gradient', 'video'],
				'selector' => '.quick-view-{{ID}} button.mfp-close',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'qv_close_hbackground',
				'label' => esc_html__('Hover Background', 'topper-pack'),
				'types' => ['classic'],
				'selector' => '.quick-view-{{ID}} button.mfp-close',
				'fields_options' => [
					'background' => [
						'label' => esc_html__('Hover Background', 'topper-pack'),
					],
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'qv_close_order',
				'selector' => '.quick-view-{{ID}} button.mfp-close',
			]
		);
		$this->add_responsive_control(
			'qv_close_border_radius',
			[
				'label' => esc_html__('Border Radius', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'.quick-view-{{ID}} button.mfp-close' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'qv_close_box_shadow',
				'selector' => '.quick-view-{{ID}} button.mfp-close',
			]
		);
		$this->add_responsive_control(
			'qv_close_margin',
			[
				'label'      => esc_html__('Margin', 'topper-pack'),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors'  => [
					'.quick-view-{{ID}} button.mfp-close' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'qv_close_padding',
			[
				'label'      => esc_html__('Padding', 'topper-pack'),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors'  => [
					'.quick-view-{{ID}} button.mfp-close' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'dote_content_option',
			[
				'label' => esc_html__('Dots Style', 'topper-pack'),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
				'condition' => [
					'enable_dots' => 'yes',
					'enable_slider' => 'yes',
				],
			]
		);
		$this->add_responsive_control(
			'dote_gap',
			[
				'label'      => esc_html__('Gap', 'topper-pack'),
				'type'       => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px', '%', 'custom'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 300,
						'step' => 1,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .topppa-dote-pagination' => 'gap: {{SIZE}}{{UNIT}};',
				],
				'default' => [
					'unit' => 'px',
					'size' => 24,
				],
			]
		);
		$this->add_responsive_control(
			'dote_align',
			[
				'label' => esc_html__('Alignment', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'options' => [
					'flex-start' => [
						'title' => esc_html__('Left', 'topper-pack'),
						'icon' => 'eicon-justify-start-h',
					],
					'center' => [
						'title' => esc_html__('Center', 'topper-pack'),
						'icon' => 'eicon-justify-center-h',
					],
					'flex-end' => [
						'title' => esc_html__('Right', 'topper-pack'),
						'icon' => 'eicon-justify-end-h',
					],
				],
				'toggle' => true,
				'selectors' => [
					'{{WRAPPER}} .topppa-dote-pagination' => 'justify-content: {{VALUE}};',
				],
			]
		);
		$this->add_responsive_control(
			'dote_height',
			[
				'label'      => esc_html__('Height', 'topper-pack'),
				'type'       => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px', '%', 'custom'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default' => [
					'unit' => 'px',
				],
				'selectors'  => [
					'{{WRAPPER}} .swiper-pagination-bullets span.swiper-pagination-bullet' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'dote_width',
			[
				'label'      => esc_html__('Width', 'topper-pack'),
				'type'       => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px', '%', 'custom'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default' => [
					'unit' => 'px',
				],
				'selectors'  => [
					'{{WRAPPER}} .swiper-pagination-bullets span.swiper-pagination-bullet' => 'Width: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'dote_background',
				'label' => esc_html__('Background', 'topper-pack'),
				'types' => ['classic', 'gradient', 'video'],
				'selector' => '{{WRAPPER}} .topppa-dote-pagination span',
				'fields_options' => [
					'background' => [
						'label' => esc_html__('Background', 'topper-pack'),
						'default' => 'classic',
					],
				],
			]
		);
		$this->add_responsive_control(
			'dote_opacity',
			[
				'label' => esc_html__('Opacity', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1,
						'step' => .1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .topppa-dote-pagination span' => 'opacity: {{SIZE}};',
				],
			]
		);
		$this->add_responsive_control(
			'dote_scale',
			[
				'label' => esc_html__('Border Scale', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default' => [
					'size' => 1,
				],
				'selectors' => [
					'{{WRAPPER}} .topppa-dote-pagination .swiper-pagination-bullet:after' => 'transform: translate(-50%, -50%) scale({{SIZE}});',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name'     => 'dote_border',
				'label'    => esc_html__('Border', 'topper-pack'),
				'selector' => '{{WRAPPER}} .topppa-dote-pagination .swiper-pagination-bullet:after',
			]
		);
		$this->add_responsive_control(
			'dote_border_radius',
			[
				'label'      => esc_html__('Border Radius', 'topper-pack'),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors'  => [
					'{{WRAPPER}} .topppa-dote-pagination .swiper-pagination-bullet:after' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'active_styles',
			[
				'label' => esc_html__('Active Styles', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_responsive_control(
			'position_x',
			[
				'label' => esc_html__('Postition X', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px', '%', 'em', 'rem', 'custom'],
				'range' => [
					'px' => [
						'min' => -200,
						'max' => 500,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .topppa-dote-pagination .swiper-pagination-bullet:after' => 'left: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'position_y',
			[
				'label' => esc_html__('Postition Y', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px', '%', 'em', 'rem', 'custom'],
				'range' => [
					'px' => [
						'min' => -200,
						'max' => 500,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .topppa-dote-pagination .swiper-pagination-bullet:after' => 'top: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'active_dote_height',
			[
				'label'      => esc_html__('Height', 'topper-pack'),
				'type'       => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px', '%', 'custom'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default' => [
					'unit' => 'px',
				],
				'selectors'  => [
					'{{WRAPPER}} .swiper-pagination-bullets span.swiper-pagination-bullet-active' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'active_dote_width',
			[
				'label'      => esc_html__('Width', 'topper-pack'),
				'type'       => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px', '%', 'custom'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default' => [
					'unit' => 'px',
				],
				'selectors'  => [
					'{{WRAPPER}} .swiper-pagination-bullets span.swiper-pagination-bullet-active' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'active_dote_background',
				'label' => esc_html__('Background', 'topper-pack'),
				'types' => ['classic', 'gradient', 'video'],
				'selector' => '{{WRAPPER}} .topppa-dote-pagination .swiper-pagination-bullet-active',
				'fields_options' => [
					'background' => [
						'label' => esc_html__('Background', 'topper-pack'),
						'default' => 'classic',
					],
				],
			]
		);
		$this->add_responsive_control(
			'dote_active_opacity',
			[
				'label' => esc_html__('Opacity', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1,
						'step' => .1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .topppa-dote-pagination .swiper-pagination-bullet-active' => 'opacity: {{SIZE}};',
				],
			]
		);
		$this->add_responsive_control(
			'dote_ascale',
			[
				'label' => esc_html__('Border Scale', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default' => [
					'size' => 1,
				],
				'selectors' => [
					'{{WRAPPER}} .topppa-dote-pagination .swiper-pagination-bullet-active:after' => 'transform: translate(-50%, -50%) scale({{SIZE}});',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name'     => 'active_dote_border',
				'label'    => esc_html__('Border', 'topper-pack'),
				'selector' => '{{WRAPPER}} .topppa-dote-pagination .swiper-pagination-bullet-active:after',
			]
		);
		$this->add_responsive_control(
			'active_dote_border_radius',
			[
				'label'      => esc_html__('Border Radius', 'topper-pack'),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors'  => [
					'{{WRAPPER}} .topppa-dote-pagination .swiper-pagination-bullet-active:after' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'dote_Margin',
			[
				'label'      => esc_html__('Margin', 'topper-pack'),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors'  => [
					'{{WRAPPER}} .topppa-dote-pagination' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'dote_padding',
			[
				'label'      => esc_html__('Padding', 'topper-pack'),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors'  => [
					'{{WRAPPER}} .topppa-dote-pagination' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();

		// <==========>
		// <==========> SHOP TOOLBAR STYLES <==========>
		$this->start_controls_section(
			'shop_toolbar_styles',
			[
				'label' => esc_html__('Shop Toolbar', 'topper-pack'),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'shop_toolbar_gap',
			[
				'label' => esc_html__('Gap', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px', '%', 'em', 'rem', 'custom'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
						'step' => 5,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .main-wrapper .topppa-shop-toolbar' => 'gap: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'shop_toolbar_flex_direction',
			[
				'label' => esc_html__('Flex Direction', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'row',
				'options' => [
					'row' => esc_html__('Row', 'topper-pack'),
					'row-reverse'  => esc_html__('Row Reverse', 'topper-pack'),
					'column' => esc_html__('Column', 'topper-pack'),
					'column-reverse' => esc_html__('Column Reverse', 'topper-pack'),
				],
				'selectors' => [
					'{{WRAPPER}} .main-wrapper .topppa-shop-toolbar' => 'flex-direction: {{VALUE}};',
				],
			]
		);
		$this->add_responsive_control(
			'shop_toolbar_align_items',
			[
				'label' => esc_html__('Item Alignment', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'options' => [
					'flex-start' => [
						'title' => esc_html__('Left', 'topper-pack'),
						'icon' => 'eicon-align-start-h',
					],
					'center' => [
						'title' => esc_html__('Center', 'topper-pack'),
						'icon' => 'eicon-align-center-v',
					],
					'flex-end' => [
						'title' => esc_html__('Right', 'topper-pack'),
						'icon' => 'eicon-align-end-h',
					],
				],
				'toggle' => true,
				'selectors' => [
					'{{WRAPPER}} .main-wrapper .topppa-shop-toolbar' => 'align-items: {{VALUE}};',
				],
			]
		);
		$this->add_responsive_control(
			'shop_toolbar_justify_content',
			[
				'label' => esc_html__('Justify Content', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'options' => [
					'flex-start' => [
						'title' => esc_html__('Left', 'topper-pack'),
						'icon' => 'eicon-justify-start-h',
					],
					'center' => [
						'title' => esc_html__('Center', 'topper-pack'),
						'icon' => 'eicon-justify-center-h',
					],
					'flex-end' => [
						'title' => esc_html__('Right', 'topper-pack'),
						'icon' => 'eicon-justify-end-h',
					],
					'space-between' => [
						'title' => esc_html__('Space Between', 'topper-pack'),
						'icon' => 'eicon-justify-space-between-h',
					],
				],
				'toggle' => true,
				'selectors' => [
					'{{WRAPPER}} .main-wrapper .topppa-shop-toolbar' => 'justify-content: {{VALUE}};',
				],
				'condition' => [
					'flex_direction' => ['row', 'row-reverse'],
				],
			]
		);
		$this->add_responsive_control(
			'shop_toolbar_align_content',
			[
				'label' => esc_html__('Align Content', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'options' => [
					'flex-start' => [
						'title' => esc_html__('Left', 'topper-pack'),
						'icon' => 'eicon-justify-start-h',
					],
					'center' => [
						'title' => esc_html__('Center', 'topper-pack'),
						'icon' => 'eicon-justify-center-h',
					],
					'flex-end' => [
						'title' => esc_html__('Right', 'topper-pack'),
						'icon' => 'eicon-justify-end-h',
					],
					'space-between' => [
						'title' => esc_html__('Space Between', 'topper-pack'),
						'icon' => 'eicon-justify-space-between-h',
					],
				],
				'toggle' => true,
				'selectors' => [
					'{{WRAPPER}} .main-wrapper .topppa-shop-toolbar' => 'align-content: {{VALUE}};',
				],
				'condition' => [
					'flex_direction' => ['column', 'column-reverse'],
				],
			]
		);

		$this->start_controls_tabs(
			'count_style_tabs'
		);

		$this->start_controls_tab(
			'style_normal_tab',
			[
				'label' => esc_html__('Count', 'topper-pack'),
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'toolbar_typography',
				'label' => esc_html__('Typography', 'topper-pack'),
				'selector' => '{{WRAPPER}} .topppa-shop-toolbar, {{WRAPPER}} .topppa-results-count, {{WRAPPER}} .topppa-sorting',
			]
		);

		$this->add_control(
			'toolbar_text_color',
			[
				'label' => esc_html__('Text Color', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .topppa-shop-toolbar' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'toolbar_background_color',
				'types' => ['classic', 'gradient', 'video'],
				'selector' => '{{WRAPPER}} .topppa-shop-toolbar',
			]
		);

		$this->add_responsive_control(
			'toolbar_padding',
			[
				'label' => esc_html__('Padding', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .topppa-shop-toolbar' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'toolbar_margin',
			[
				'label' => esc_html__('Margin', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .topppa-shop-toolbar' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_tab();

		$this->start_controls_tab(
			'Sort_tab',
			[
				'label' => esc_html__('Sort', 'topper-pack'),
			]
		);
		$this->add_control(
			'sorting_heading',
			[
				'label' => esc_html__('Sorting Dropdown', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'sorting_typography',
				'label' => esc_html__('Typography', 'topper-pack'),
				'selector' => '{{WRAPPER}} .topppa-sorting select',
			]
		);

		$this->add_control(
			'sorting_text_color',
			[
				'label' => esc_html__('Text Color', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .topppa-sorting select' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'sorting_background_color',
				'types' => ['classic', 'gradient', 'video'],
				'selector' => '{{WRAPPER}} .topppa-sorting select',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'sorting_border',
				'label' => esc_html__('Border', 'topper-pack'),
				'selector' => '{{WRAPPER}} .topppa-sorting select',
			]
		);

		$this->add_responsive_control(
			'sorting_border_radius',
			[
				'label' => esc_html__('Border Radius', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .topppa-sorting select' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'sorting_padding',
			[
				'label' => esc_html__('Padding', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .topppa-sorting select' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();

		// <==========>
		// <==========> PAGINATION STYLES <==========>

		$this->start_controls_section(
			'arrow_content_option',
			[
				'label' => esc_html__('Arrow Style Option', 'topper-pack'),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
				'condition' => [
					'enable_arrow' => 'yes',
					'enable_slider' => 'yes',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'arrow_typography',
				'selector' => '{{WRAPPER}} .shop-slider-arrow .button',
			]
		);
		$this->add_responsive_control(
			'arrow_height',
			[
				'label' => esc_html__('Height', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px', '%', 'em', 'rem', 'custom'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 200,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .shop-slider-arrow .button' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'arrow_width',
			[
				'label' => esc_html__('Width', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px', '%', 'em', 'rem', 'custom'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 200,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .shop-slider-arrow .button' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'arrow_gap',
			[
				'label'      => esc_html__('Gap', 'topper-pack'),
				'type'       => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px', '%'],
				'range'      => [
					'px' => [
						'min'  => 0,
						'max'  => 100,
						'step' => 1,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .shop-slider-arrow.arrow-two' => 'gap: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'select_arrow' => 'arrow_two'
				]
			]
		);
		$this->add_responsive_control(
			'arrow_top',
			[
				'label' => esc_html__('Top', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px', '%', 'em', 'rem', 'custom'],
				'range' => [
					'px' => [
						'min' => -300,
						'max' => 300,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default' => [
					'unit' => 'px',
				],
				'selectors' => [
					'{{WRAPPER}} .shop-slider-arrow.arrow-two' => 'top: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'select_arrow' => 'arrow_two'
				]
			]
		);
		$this->start_controls_tabs(
			'arrow_style_tabs'
		);
		$this->start_controls_tab(
			'arrow_normal_tabs',
			[
				'label' => __('Normal', 'topper-pack'),
			]
		);
		$this->add_responsive_control(
			'arrow_color',
			[
				'label'     => esc_html__('Color', 'topper-pack'),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .shop-slider-arrow .button' => 'color: {{VALUE}}',
					'{{WRAPPER}} .shop-slider-arrow .button svg path' => 'fill: {{VALUE}}',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'arrow_background',
				'label' => esc_html__('Background', 'topper-pack'),
				'types' => ['classic', 'gradient', 'video'],
				'selector' => '{{WRAPPER}} .shop-slider-arrow .button',
				'fields_options' => [
					'background' => [
						'label' => esc_html__('Background', 'topper-pack'),
						'default' => 'classic',
					],
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name'     => 'arrow_border',
				'label'    => esc_html__('Border', 'topper-pack'),
				'selector' => '{{WRAPPER}} .shop-slider-arrow .button',
			]
		);
		$this->add_responsive_control(
			'arrow_border_radius',
			[
				'label'      => esc_html__('Border Radius', 'topper-pack'),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors'  => [
					'{{WRAPPER}} .shop-slider-arrow .button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'arrow_hover_tabs',
			[
				'label' => __('Hover', 'topper-pack'),
			]
		);
		$this->add_responsive_control(
			'arrow_color_hover',
			[
				'label'     => esc_html__('Hover Color', 'topper-pack'),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .shop-slider-arrow .button:hover' => 'color: {{VALUE}}',
					'{{WRAPPER}} .shop-slider-arrow .button:hover svg path' => 'fill: {{VALUE}}',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'arrow_background_hover',
				'label' => esc_html__('Background', 'topper-pack'),
				'types' => ['classic', 'gradient', 'video'],
				'selector' => '{{WRAPPER}} .shop-slider-arrow .button:hover',
				'fields_options' => [
					'background' => [
						'label' => esc_html__('Background', 'topper-pack'),
						'default' => 'classic',
					],
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name'     => 'arrow_border_hover',
				'label'    => esc_html__('Border', 'topper-pack'),
				'selector' => '{{WRAPPER}} .shop-slider-arrow .button:hover',
			]
		);
		$this->add_responsive_control(
			'arrow_border_radius_hover',
			[
				'label'      => esc_html__('Border Radius', 'topper-pack'),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors'  => [
					'{{WRAPPER}} .shop-slider-arrow .button:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'arrow_active_tabs',
			[
				'label' => __('Active', 'topper-pack'),
			]
		);
		$this->add_responsive_control(
			'arrow_color_active',
			[
				'label'     => esc_html__('Color', 'topper-pack'),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .shop-slider-arrow .topppa-arrow-next.button' => 'color: {{VALUE}}',
					'{{WRAPPER}} .shop-slider-arrow .topppa-arrow-next.button svg path' => 'fill: {{VALUE}}',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'arrow_background_active',
				'label' => esc_html__('Background', 'topper-pack'),
				'types' => ['classic', 'gradient', 'video'],
				'selector' => '{{WRAPPER}} .shop-slider-arrow .topppa-arrow-next.button',
				'fields_options' => [
					'background' => [
						'label' => esc_html__('Background', 'topper-pack'),
						'default' => 'classic',
					],
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name'     => 'arrow_border_active',
				'label'    => esc_html__('Border', 'topper-pack'),
				'selector' => '{{WRAPPER}} .shop-slider-arrow .topppa-arrow-next.button',
			]
		);

		$this->add_control(
			'arrow_active_hover_styles',
			[
				'label' => esc_html__('Hover Styles', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_responsive_control(
			'arrow_color_active_hover',
			[
				'label'     => esc_html__('Color', 'topper-pack'),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .shop-slider-arrow .topppa-arrow-next.button:hover' => 'color: {{VALUE}}',
					'{{WRAPPER}} .shop-slider-arrow .topppa-arrow-next.button:hover svg path' => 'fill: {{VALUE}}',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'arrow_background_active_hover',
				'label' => esc_html__('Background', 'topper-pack'),
				'types' => ['classic', 'gradient', 'video'],
				'selector' => '{{WRAPPER}} .shop-slider-arrow .topppa-arrow-next.button:hover',
				'fields_options' => [
					'background' => [
						'label' => esc_html__('Background', 'topper-pack'),
						'default' => 'classic',
					],
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name'     => 'arrow_border_active_hover',
				'label'    => esc_html__('Border', 'topper-pack'),
				'selector' => '{{WRAPPER}} .shop-slider-arrow .topppa-arrow-next.button:hover',
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->add_responsive_control(
			'arrow_Margin',
			[
				'label'      => esc_html__('Margin', 'topper-pack'),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors'  => [
					'{{WRAPPER}} .shop-slider-arrow .button' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'arrow_padding',
			[
				'label'      => esc_html__('Padding', 'topper-pack'),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors'  => [
					'{{WRAPPER}} .shop-slider-arrow .button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();
	}

	// Helper function to get all product categories
	protected function get_product_categories() {
		$categories = get_terms(['taxonomy' => 'product_cat', 'hide_empty' => false]);
		$options = [];
		if (!is_wp_error($categories) && !empty($categories)) {
			foreach ($categories as $category) {
				if (is_object($category)) {
					$options[$category->term_id] = $category->name;
				} elseif (is_array($category)) {
					$options[$category['term_id']] = $category['name'];
				}
			}
		}
		return $options;
	}

	// Helper function to get all product tags
	protected function get_product_tags() {
		$tags = get_terms(['taxonomy' => 'product_tag', 'hide_empty' => false]);
		$options = [];
		if (!is_wp_error($tags) && !empty($tags)) {
			foreach ($tags as $tag) {
				if (is_object($tag)) {
					$options[$tag->term_id] = $tag->name;
				} elseif (is_array($tag)) {
					$options[$tag['term_id']] = $tag['name'];
				}
			}
		}
		return $options;
	}

	// Helper function to get all products
	protected function get_all_products() {
		$products = get_posts(['post_type' => 'product', 'numberposts' => -1]);
		$options = [];
		if (!is_wp_error($products) && !empty($products)) {
			foreach ($products as $product) {
				if (is_object($product)) {
					$options[$product->ID] = $product->post_title;
				} elseif (is_array($product)) {
					$options[$product['ID']] = $product['post_title'];
				}
			}
		}
		return $options;
	}

	/**
	 * Render logo widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render() {
		// Enable WooCommerce AJAX add to cart support
		if (class_exists('WooCommerce')) {
			wp_enqueue_script('wc-add-to-cart');
			wp_localize_script('wc-add-to-cart', 'wc_add_to_cart_params', array(
				'ajax_url' => admin_url('admin-ajax.php'),
				'wc_ajax_url' => WC_AJAX::get_endpoint('%%endpoint%%'),
				'i18n_view_cart' => esc_attr__('View cart', 'topper-pack'),
				'cart_url' => apply_filters('woocommerce_add_to_cart_redirect', wc_get_cart_url(), null),
				'is_cart' => is_cart(),
				'cart_redirect_after_add' => get_option('woocommerce_cart_redirect_after_add')
			));
		}

		// Check if WooCommerce is installed and activated
		if (!class_exists('WooCommerce')) {
			echo '<div class="elementor-alert elementor-alert-warning">';
			echo esc_html__('WooCommerce is not installed. Please install and activate WooCommerce to use this widget.', 'topper-pack');
			echo '</div>';
			return;
		}

		$settings = $this->get_settings_for_display();
		$allowed_html = [
			'a' => [
				'href' => [],
				'title' => [],
				'target' => [],
			],
			'br' => [],
			'strong' => [],
			'em' => [],
		];
		global $product;

		// Get current page for pagination
		$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

		// Handle sorting
		$sort_options = array(
			'menu_order' => esc_html__('Default sorting', 'topper-pack'),
			'popularity' => esc_html__('Sort by popularity', 'topper-pack'),
			'rating' => esc_html__('Sort by average rating', 'topper-pack'),
			'date' => esc_html__('Sort by latest', 'topper-pack'),
			'price' => esc_html__('Sort by price: low to high', 'topper-pack'),
			'price-desc' => esc_html__('Sort by price: high to low', 'topper-pack'),
		);

		$orderby_value = isset($_GET['orderby']) ? wc_clean(wp_unslash($_GET['orderby'])) : apply_filters('woocommerce_default_catalog_orderby', get_option('woocommerce_default_catalog_orderby'));

		// Ensure visibility.
		$args = array(
			'posts_per_page' => $settings['show_pagination'] === 'yes' ? $settings['products_per_page'] : $settings['display_item'],
			'post_type' => 'product',
			'paged' => $paged,
			'orderby' => 'menu_order', // Default orderby
			'order' => 'ASC' // Default order
		);

		// Apply sorting based on selected option
		switch ($orderby_value) {
			case 'popularity':
				$args['meta_key'] = 'total_sales';
				$args['orderby'] = 'meta_value_num';
				$args['order'] = 'DESC';
				break;
			case 'rating':
				$args['meta_key'] = '_wc_average_rating';
				$args['orderby'] = 'meta_value_num';
				$args['order'] = 'DESC';
				break;
			case 'date':
				$args['orderby'] = 'date';
				$args['order'] = 'DESC';
				break;
			case 'price':
				$args['meta_key'] = '_price';
				$args['orderby'] = 'meta_value_num';
				$args['order'] = 'ASC';
				break;
			case 'price-desc':
				$args['meta_key'] = '_price';
				$args['orderby'] = 'meta_value_num';
				$args['order'] = 'DESC';
				break;
			default:
				// Use the default orderby and order from settings if no GET parameter
				if (!isset($_GET['orderby'])) {
					$args['orderby'] = esc_attr($settings['orderby']);
					$args['order'] = esc_attr($settings['order']);
				}
				break;
		}

		// Price Range Filter
		if (!empty($settings['price_range']['min']) && !empty($settings['price_range']['max'])) {
			$args['meta_query'][] = [
				'key' => '_price',
				'value' => [$settings['price_range']['min'], $settings['price_range']['max']],
				'compare' => 'BETWEEN',
				'type' => 'NUMERIC'
			];
		}

		// Stock Status Filter
		if ($settings['stock_status'] !== 'all') {
			$args['meta_query'][] = [
				'key' => '_stock_status',
				'value' => $settings['stock_status'],
			];
		}

		// Featured Products Filter
		if ($settings['featured_products'] === 'yes') {
			$args['tax_query'][] = [
				'taxonomy' => 'product_visibility',
				'field' => 'name',
				'terms' => 'featured',
			];
		}

		// Product Category Filter
		if ('yes' == $settings['store_cat_enable'] && !empty($settings['store_cat'])) {
			$args['tax_query'][] = array(
				'taxonomy' => 'product_cat',
				'field' => 'term_id',
				'terms' => $settings['store_cat']
			);
		}

		// Product Tags Filter
		if ('yes' == $settings['product_tags_enable'] && !empty($settings['product_tags'])) {
			$args['tax_query'][] = [
				'taxonomy' => 'product_tag',
				'field' => 'term_id',
				'terms' => $settings['product_tags'],
			];
		}

		// On Sale Products Filter
		if ('yes' == $settings['on_sale_products']) {
			$args['post__in'] = array_merge([0], wc_get_product_ids_on_sale());
		}

		// Product Ratings Filter
		if (!empty($settings['product_ratings']) && $settings['product_ratings'] != '0') {
			$args['meta_query'][] = [
				'key' => '_wc_average_rating',
				'value' => $settings['product_ratings'],
				'compare' => '>=',
				'type' => 'NUMERIC',
			];
		}

		// Product Type Filter
		if ($settings['product_type'] !== 'all') {
			$args['tax_query'][] = [
				'taxonomy' => 'product_type',
				'field' => 'slug',
				'terms' => $settings['product_type'],
			];
		}

		// Exclude Products Filter
		if (!empty($settings['exclude_products'])) {
			$args['post__not_in'] = $settings['exclude_products']; // phpcs:ignore WordPressVIPMinimum.Performance.WPQueryParams.PostNotIn_post__not_in
		}

		// Related Products Filter
		if ($settings['show_related_products'] === 'yes') {
			// Get related products based on the current context
			$related_products = array();

			// If we're on a single product page, get related products for that product
			if (is_product() && isset($GLOBALS['product']) && is_a($GLOBALS['product'], 'WC_Product')) {
				$related_products = wc_get_related_products($GLOBALS['product']->get_id(), $settings['related_products_count']);
			}
			// If we're in a theme builder or editor context, show some sample related products
			elseif (\Elementor\Plugin::$instance->editor->is_edit_mode() || isset($_REQUEST['action']) && $_REQUEST['action'] === 'elementor') {
				// Get some sample products for demonstration
				$sample_products_query = new \WP_Query(array(
					'post_type' => 'product',
					'posts_per_page' => $settings['related_products_count'],
					'post__not_in' => array(get_the_ID()),
					'orderby' => 'rand'
				));

				if ($sample_products_query->have_posts()) {
					while ($sample_products_query->have_posts()) {
						$sample_products_query->the_post();
						$related_products[] = get_the_ID();
					}
					wp_reset_postdata();
				}
			}
			// For archive pages, we could show related products based on category or tags
			// But this would require more complex logic to determine which product to use as reference

			if (!empty($related_products)) {
				$args['post__in'] = $related_products;
				$args['orderby'] = 'post__in'; // phpcs:ignore WordPressVIPMinimum.Performance.WPQueryParams.PostNotIn_orderby
			} else {
				// If no related products found, don't show any products
				$args['post__in'] = array(0);
			}
		}

		$p = new \WP_Query($args);

		// Button Style Classes
		$style_classes = [
			'style_one' => 'style-one',
			'style_two' => 'style-two',
			'style_three' => 'style-three',
			'style_four' => 'style-four',
			'style_five' => 'style-five',
			'style_six' => 'style-six',
			'style_seven' => 'style-seven',
			'style_eight' => 'style-eight',
			'style_nine' => 'style-nine',
			'style_ten' => 'style-ten',
			'style_eleven' => 'style-eleven',
			'style_twelve' => 'style-twelve',
			'style_thirteen' => 'style-thirteen',
			'style_fourteen' => 'style-fourteen',
			'style_fifteen' => 'style-fifteen',
		];
		$select_arrow = [
			'arrow_one' => 'arrow-one',
			'arrow_two' => 'arrow-two',
		];
		$arrow = isset($select_arrow[$settings['select_arrow']]) ? $select_arrow[$settings['select_arrow']] : '';
		// Get the class name based on the selected style or fallback to an empty string.
		$column = $settings['desktop_col'] . ' ' . $settings['laptop_col'] . ' ' . $settings['tab_col'];
		$class = isset($style_classes[$settings['topppa_widget_styles']]) ? $style_classes[$settings['topppa_widget_styles']] : '';
		$btn_class = isset($style_classes[$settings['topppa_btn_styles']]) ? $style_classes[$settings['topppa_btn_styles']] : '';
		$html_tag = isset($settings['html_tag']) ? $settings['html_tag'] : 'h3';
		$SliderId = wp_rand(1241, 3256); // phpcs:ignore WordPress.WP.AlternativeFunctions.rand_rand

		// Get total product count for results counter
		$total_products = $p->found_posts;
		$current_page = max(1, $paged);
		$products_per_page = $settings['show_pagination'] === 'yes' ? (int) $settings['products_per_page'] : (int) $settings['display_item'];
		$start_product = ($current_page - 1) * $products_per_page + 1;
		$end_product = min($current_page * $products_per_page, $total_products);
?>
		<div class="main-wrapper">
			<?php if ($settings['show_sorting'] === 'yes' || $settings['show_results_count'] === 'yes') : ?>
				<div class="topppa-shop-toolbar">
					<?php if ($settings['show_results_count'] === 'yes') : ?>
						<div class="topppa-results-count">
						<span>
						<?php
						printf(
							/* translators: 1: first product number, 2: last product number, 3: total number of products */
							esc_html__( 'Showing %1$d%2$d of %3$d results', 'topper-pack' ),
							absint( $start_product ),
							absint( $end_product ),
							absint( $total_products )
						);
						?>
						</span>


						</div>
					<?php endif; ?>

					<?php if ($settings['show_sorting'] === 'yes') : ?>
						<div class="topppa-sorting">
							<form method="get" class="topppa-ordering">
								<select name="orderby" class="orderby">
									<?php foreach ($sort_options as $value => $label) : ?>
										<option value="<?php echo esc_attr($value); ?>" <?php selected($orderby_value, $value); ?>><?php echo esc_html($label); ?></option>
									<?php endforeach; ?>
								</select>
								<input type="hidden" name="paged" value="1" />
								<?php
								// Keep query string vars intact
								foreach ($_GET as $key => $val) {
									if ('orderby' === $key || 'submit' === $key) {
										continue;
									}
									echo '<input type="hidden" name="' . esc_attr($key) . '" value="' . esc_attr($val) . '" />';
								}
								?>
							</form>
						</div>
						<script>
							(function($) {
								'use strict';
								$(document).ready(function() {
									$('.topppa-sorting select').on('change', function() {
										$(this).closest('form').submit();
									});
								});
							})(jQuery);
						</script>
					<?php endif; ?>
				</div>
			<?php endif; ?>

			<div class="topppa-product-wrp <?php echo esc_attr($class); ?> <?php echo esc_attr($settings['enable_slider'] === 'yes' ? 'swiper topppa-swiper-slider topppa-swiper-slider-' . $SliderId : 'no-swiper'); ?>" <?php if ($settings['enable_slider'] === 'yes') : ?>
				data-slides-per-view="<?php echo esc_attr($settings['slide_show_lagrge_item']); ?>"
				data-space-between="<?php echo esc_attr($settings['slider_space_between']['size']); ?>"
				data-auto-loop="<?php echo esc_attr($settings['enable_slider_auto_loop']); ?>"
				data-slide-speed="<?php echo esc_attr($settings['slide_speed']); ?>"
				data-slider-speed="<?php echo esc_attr($settings['slider_speed']); ?>"
				data-enable-dote="<?php echo esc_attr($settings['enable_dots']); ?>"
				data-enable-arrow="<?php echo esc_attr($settings['enable_arrow']); ?>"
				data-large-items="<?php echo esc_attr($settings['slide_show_lagrge_item']); ?>"
				data-tablet-items="<?php echo esc_attr($settings['slide_show_teblet_item']); ?>"
				data-mobile-items="<?php echo esc_attr($settings['slide_show_mobile_item']); ?>"
				data-extra-mobile-items="<?php echo esc_attr($settings['slide_show_extra_mobile_item']); ?>"
				data-enable-rtl="<?php echo esc_attr($settings['enable_rtl']); ?>"
				<?php endif; ?>>
				<div class="topppa-products <?php echo esc_attr($settings['enable_slider'] === 'yes' ? 'swiper-wrapper' : 'row'); ?>">
					<?php while ($p->have_posts()):
						$p->the_post();
						global $product;
						if (!is_a($product, 'WC_Product')) {
							$product = wc_get_product(get_the_ID());
						}
						$product_id = $product->get_id();
					?>
						<div class="<?php echo esc_attr($class); ?> <?php echo esc_attr($settings['enable_slider'] === 'yes' ? 'swiper-slide' : $column); ?>">
							<div class="product-items">
								<div class="topppa-store-product-img">
									<!-- IMAGE SHAPES -->
									<?php if ($settings['post_img_anim'] === 'anim_one' || $settings['post_img_anim'] === 'anim_rotate') : ?>
										<span class="image-anim image-anim1 <?php echo esc_attr($settings['post_img_anim'] === 'anim_rotate' ? 'v2' : ''); ?>"></span>
									<?php endif; ?>

									<?php if ($settings['post_img_anim'] === 'anim_two') : ?>
										<span class="image-anim image-anim2"></span>
									<?php endif; ?>

									<?php if ($settings['post_img_anim'] === 'anim_three') : ?>
										<span class="image-anim image-anim3"></span>
									<?php endif; ?>
									<?php
									// Get the selected image size from the widget settings
									$image_size = $settings['product_image_size'];

									// Display the product image with the selected size
									the_post_thumbnail($image_size, ['class' => 'img-responsive']);
									?>
									<?php
									if ($settings['enable_sale'] === 'yes'):
										if ($product->is_on_sale()) {
											echo '<div class="topppa-product-offer">';
											$regular_price = $product->get_regular_price();
											$sale_price = $product->get_sale_price();
											if (!empty($regular_price) && !empty($sale_price)) {
												$percentage = round((($regular_price - $sale_price) / $regular_price) * 100);
												echo '<span class="discount-label offer-label">' . esc_html($settings['sale_text']) . '</span>';
												echo '<span class="discount-percent offer-label">' . '-' . esc_html($percentage) . '%</span>';
											}
											echo '</div>';
										}
									endif; ?>

									<?php if ($settings['enable_add_to_cart_button'] === 'yes') : ?>
										<div class="cart-button topppa-btn-wrapper <?php echo esc_attr($btn_class); ?>">
											<?php if ($settings['enable_quantity'] === 'yes') : ?>
												<input type="number"
													class="topppa-quantity-input"
													value="<?php echo esc_attr($settings['quantity_default']); ?>"
													min="<?php echo esc_attr($settings['quantity_min']); ?>"
													max="<?php echo esc_attr($settings['quantity_max']); ?>"
													data-product-id="<?php echo esc_attr($product->get_id()); ?>" />
											<?php endif; ?>
											<?php if ($settings['cart_btn_style'] === 'button') : ?>
												<?php woocommerce_template_loop_add_to_cart(); ?>
											<?php else : ?>
												<?php
												if (!is_a($product, 'WC_Product')) {
													$product = wc_get_product(get_the_ID());
												}
												?>
												<a href="<?php echo esc_url($product->add_to_cart_url()); ?>"
													class="topppa-btn topppa-cart-btn product-shopping-icon cart-icon add_to_cart_button ajax_add_to_cart"
													data-product_id="<?php echo esc_attr($product->get_id()); ?>"
													data-product_sku="<?php echo esc_attr($product->get_sku()); ?>"
													data-quantity="<?php echo esc_attr($settings['quantity_default']); ?>"
													data-view-cart-text="<?php echo esc_attr($settings['view_cart_text']); ?>"
													data-ajax-cart="<?php echo esc_attr($settings['enable_ajax_cart']); ?>"
													aria-label="<?php echo esc_html($settings['add_to_cart_text']); ?>">
													<?php if ($settings['enable_cart_text'] === 'yes') : ?>
														<?php echo esc_attr($settings['add_to_cart_text']); ?>
													<?php endif; ?>
													<?php if ($settings['enable_cart_icon'] === 'yes') : ?>
														<i class="fas fa-cart-arrow-down"></i>
													<?php endif; ?>
												</a>
											<?php endif; ?>
										</div>
									<?php endif; ?>

									<div class="actions">
										<?php if ($settings['enable_add_to_cart_button'] === 'yes' && $settings['topppa_widget_styles'] !== 'style_three' && $settings['topppa_widget_styles'] !== 'style_four'): ?>
											<?php if ($settings['cart_btn_style'] === 'button'): ?>
												<?php woocommerce_template_loop_add_to_cart(); ?>
											<?php else: ?>
												<?php
												if (!is_a($product, 'WC_Product')) {
													$product = wc_get_product(get_the_ID());
												}
												?>
												<a href="<?php echo esc_url($product->add_to_cart_url()); ?>"
													class="product-shopping-icon cart-icon add_to_cart_button ajax_add_to_cart"
													data-product_id="<?php echo esc_attr($product->get_id()); ?>"
													data-product_sku="<?php echo esc_attr($product->get_sku()); ?>"
													aria-label="<?php echo esc_attr__('Add to cart', 'topper-pack'); ?>">
													<i class="fas fa-cart-arrow-down"></i>
												</a>
											<?php endif; ?>
										<?php endif; ?>
										<?php if ($settings['enable_wishlist'] === 'yes' && function_exists('yith_wcwl_install_plugin_fw')) : ?>
											<?php echo do_shortcode('[yith_wcwl_add_to_wishlist]'); ?>
										<?php endif; ?>

										<?php if ($settings['enable_quick_view'] === 'yes') : ?>
											<a href="#" class="quick-view-icon popup-with-zoom-content" data-product-id="<?php echo esc_attr($product_id); ?>">
												<i class="fas fa-eye"></i>
											</a>
										<?php endif; ?>
									</div>

								</div>
								<div class="topppa-store-content">
									<?php if ('yes' === $settings['enable_stock_status']): ?>
										<div class="topppa-stock-status wrapper">
											<?php
											global $product;
											if (!is_a($product, 'WC_Product')) {
												$product = wc_get_product(get_the_ID());
											}

											// Get the stock status
											$stock_status = $product->get_stock_status();
											$stock_class = '';
											$stock_text = '';

											// Determine the stock status text and class
											switch ($stock_status) {
												case 'instock':
													$stock_class = 'in-stock';
													$stock_text = !empty($settings['stock_in_text']) ? $settings['stock_in_text'] : esc_html__('In stock', 'topper-pack');
													break;
												case 'outofstock':
													$stock_class = 'out-of-stock';
													$stock_text = !empty($settings['stock_out_text']) ? $settings['stock_out_text'] : esc_html__('Out of stock', 'topper-pack');
													break;
												case 'onbackorder':
													$stock_class = 'on-backorder';
													$stock_text = !empty($settings['stock_backorder_text']) ? $settings['stock_backorder_text'] : esc_html__('On backorder', 'topper-pack');
													break;
												default:
													$stock_class = 'in-stock';
													$stock_text = !empty($settings['stock_in_text']) ? $settings['stock_in_text'] : esc_html__('In stock', 'topper-pack');
													break;
											}

											echo '<span class="topppa-stock-status ' . esc_attr($stock_class) . '">' . esc_html($stock_text) . '</span>';
											?>
										</div>
									<?php endif; ?>
									<?php
									if ($settings['enable_title'] === 'yes') {
										$title = get_the_title();
										if (!empty($settings['title_word_count'])) {
											$title = wp_trim_words($title, $settings['title_word_count'], '');
										}
										echo '<' . esc_attr($settings['title_tag'] ?? 'h3') . ' class="topppa-store-title">';
										echo '<a href="' . esc_url(get_the_permalink()) . '">' . esc_html($title) . '</a>';
										echo '</' . esc_attr($settings['title_tag'] ?? 'h3') . '>';
									}
									?>

									<!-- Add Product Description Here -->
									<?php if ('yes' === $settings['enable_description']): ?>
										<div class="topppa-product-description">
											<?php
											// Get the product description
											$description = get_the_excerpt();

											// Apply word limit if set
											$word_limit = $settings['description_word_limit'];
											if ($word_limit > 0) {
												$description = wp_trim_words($description, $word_limit, '');
											}

											// Output the description
											echo wp_kses_post($description);
											?>
										</div>
									<?php endif; ?>

									<?php if ('yes' === $settings['enable_price']) : ?>
										<div class="topppa-store-price-wrp">
											<?php if ('yes' === $settings['enable_price_prefix'] && !empty($settings['price_prefix_text'])): ?>
												<span class="topppa-price-prefix"><?php echo esc_html($settings['price_prefix_text']); ?></span>
											<?php endif; ?>
											<?php woocommerce_template_loop_price(); ?>
											<?php if ('yes' === $settings['enable_price_suffix'] && !empty($settings['price_suffix_text'])): ?>
												<span class="topppa-price-suffix"><?php echo esc_html($settings['price_suffix_text']); ?></span>
											<?php endif; ?>
										</div>
									<?php endif; ?>

									<?php if ('yes' === $settings['enable_rating']): ?>
										<div class="prodcut-rating">
											<?php
											global $product;
											if (!is_a($product, 'WC_Product')) {
												$product = wc_get_product(get_the_ID());
											}

											// Get the average rating and round it down
											$rating_amount = $product->get_average_rating();
											$round_rating = floor($rating_amount);

											for ($i = 1; $i <= 5; $i++) {
												if ($i <= $round_rating) {
													// Full star
													echo '<i class="fas fa-star"></i>';
												} elseif ($i === $round_rating + 1 && $rating_amount !== $round_rating) {
													// Partial star
													$partial_percentage = ($rating_amount - $round_rating) * 100;
													echo '<i class="fas fa-star" style="clip-path: inset(0 ' . esc_attr(100 - $partial_percentage) . '% 0 0);"></i>';
													echo '<i class="far fa-star"></i>';
												} else {
													// Empty star
													echo '<i class="far fa-star"></i>';
												}
											}
											?>
										</div>
									<?php endif; ?>

									<?php if ($settings['enable_add_to_cart_button'] === 'yes' && $settings['topppa_widget_styles'] === 'style_three'): ?>
										<div class="cart-button topppa-btn-wrapper <?php echo esc_attr($btn_class); ?>">
											<div class="button-quntity-n-cart">
												<?php if ($settings['enable_quantity'] === 'yes') : ?>
													<input type="number"
														class="topppa-quantity-input"
														value="<?php echo esc_attr($settings['quantity_default']); ?>"
														min="<?php echo esc_attr($settings['quantity_min']); ?>"
														max="<?php echo esc_attr($settings['quantity_max']); ?>"
														data-product-id="<?php echo esc_attr($product->get_id()); ?>" />
												<?php endif; ?>
												<?php if ($settings['cart_btn_style'] === 'button') : ?>
													<?php woocommerce_template_loop_add_to_cart(); ?>
												<?php else : ?>
													<?php
													if (!is_a($product, 'WC_Product')) {
														$product = wc_get_product(get_the_ID());
													}
													?>
													<a href="<?php echo esc_url($product->add_to_cart_url()); ?>"
														class="topppa-btn topppa-cart-btn product-shopping-icon cart-icon add_to_cart_button ajax_add_to_cart"
														data-product_id="<?php echo esc_attr($product->get_id()); ?>"
														data-product_sku="<?php echo esc_attr($product->get_sku()); ?>"
														data-quantity="<?php echo esc_attr($settings['quantity_default']); ?>"
														data-view-cart-text="<?php echo esc_attr($settings['view_cart_text']); ?>"
														data-ajax-cart="<?php echo esc_attr($settings['enable_ajax_cart']); ?>"
														aria-label="<?php echo esc_attr($settings['add_to_cart_text']); ?>">

														<?php // Display text if enabled and cart button style is not 'button'
														?>
														<?php if ($settings['enable_cart_text'] === 'yes' && $settings['cart_btn_style'] !== 'button') : ?>
															<span class="topppa-add-to-cart-text"><?php echo esc_html($settings['add_to_cart_text']); ?></span>
														<?php endif; ?>

														<?php // Display icon if enabled and cart button style is not 'button'
														?>
														<?php if ($settings['enable_cart_icon'] === 'yes' && $settings['cart_btn_style'] !== 'button') : ?>
															<span class="topppa-add-to-cart-icon">
																<?php \Elementor\Icons_Manager::render_icon($settings['add_to_cart_icon'], ['aria-hidden' => 'true']); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- Already escaped by elementor 
																?>
															</span>
														<?php endif; ?>
													</a>
											</div>
										<?php endif; ?>
										</div>
									<?php endif; ?>
								</div>
								<div id="quick-view-<?php echo esc_attr($product->get_id()); ?>"
									class="quick-view-<?php echo esc_attr($this->get_id()); ?> quick-view-content mfp-hide container">

									<div class="topppa-quick-view-wrap">
										<div class="row">
											<div class="col-md-6">
												<div class="topppa-quick-view-img topppa-store-product-img">
													<?php the_post_thumbnail('full', array('class' => 'img-responsive')); ?>
													<?php
													if ($settings['enable_sale'] === 'yes'):
														if ($product->is_on_sale()) {
															echo '<div class="topppa-product-offer">';
															$regular_price = $product->get_regular_price();
															$sale_price = $product->get_sale_price();
															if (!empty($regular_price) && !empty($sale_price)) {
																$percentage = round((($regular_price - $sale_price) / $regular_price) * 100);
																if ('yes' === $settings['show_sale_badge']) {
																	echo '<span class="discount-label offer-label">' . esc_html($settings['sale_text']) . '</span>';
																}
																echo '<span class="discount-percent offer-label">' . '-' . esc_html($percentage) . '%</span>';
															}
															echo '</div>';
														}
													?>
													<?php endif; ?>
												</div>
											</div>
											<div class="col-md-6">
												<div class="topppa-quick-view-content-box">
													<div class="topppa-product-price topppa-quick-view-price">
														<?php woocommerce_template_single_price(); ?>
													</div>
													<a href="<?php the_permalink(); ?>" class="topppa-product-title"><?php woocommerce_template_loop_product_title(); ?></a>
													<div class="topppa-product-rating">
														<?php
														global $product;
														if (!is_a($product, 'WC_Product')) {
															$product = wc_get_product(get_the_ID());
														}

														// Get the average rating and round it down
														$rating_amount = $product->get_average_rating();
														$round_rating = floor($rating_amount);

														for ($i = 1; $i <= 5; $i++) {
															if ($i <= $round_rating) {
																// Full star
																echo '<i class="fas fa-star"></i>';
															} elseif ($i === $round_rating + 1 && $rating_amount !== $round_rating) {
																// Partial star
																$partial_percentage = ($rating_amount - $round_rating) * 100;
																echo '<i class="fas fa-star" style="clip-path: inset(0 ' . esc_attr(100 - $partial_percentage) . '% 0 0);"></i>';
																echo '<i class="far fa-star"></i>';
															} else {
																// Empty star
																echo '<i class="far fa-star"></i>';
															}
														}
														?>
													</div>

													<div class="topppa-product-description">
														<?php woocommerce_template_single_excerpt();
														?>
													</div>

													<div class="topppa-product-cart-and-quantity"><?php woocommerce_template_single_add_to_cart(); ?></div>
													<?php woocommerce_template_single_meta(); ?>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					<?php endwhile;
					wp_reset_query(); // phpcs:ignore WordPress.WP.DiscouragedFunctions.wp_reset_query_wp_reset_query 
					?>
				</div>
			</div>
			<?php if ($settings['enable_dots'] === 'yes' && $settings['enable_slider'] === 'yes') : ?>
				<div class="topppa-topppa-dote-pagination-<?php echo esc_attr($SliderId); ?> topppa-dote-pagination topppa-topppa-dote-pagination"></div>
			<?php endif; ?>
			<?php if ($settings['enable_arrow'] === 'yes' && $settings['enable_slider'] === 'yes') : ?>
				<div class="shop-slider-arrow <?php echo esc_attr($arrow); ?>">
					<?php if ($settings['style_arrow_type'] === 'text') : ?>
						<div class="topppa-arrow-prev topppa-brand-logo-button-prev-<?php echo esc_attr($SliderId); ?> button">
							<?php echo esc_html__('Prev', 'topper-pack'); ?>
						</div>
						<div class="topppa-arrow-next topppa-brand-logo-button-next-<?php echo esc_attr($SliderId); ?> button">
							<?php echo esc_html__('Next', 'topper-pack'); ?>
						</div>
					<?php else : ?>
						<div class="topppa-arrow-prev topppa-brand-logo-button-prev-<?php echo esc_attr($SliderId); ?> button">
							<?php \Elementor\Icons_Manager::render_icon($settings['left_arrow_icon'], ['aria-hidden' => 'true']); ?>
						</div>
						<div class="topppa-arrow-next topppa-brand-logo-button-next-<?php echo esc_attr($SliderId); ?> button">
							<?php \Elementor\Icons_Manager::render_icon($settings['right_arrow_icon'], ['aria-hidden' => 'true']); ?>
						</div>
					<?php endif; ?>
				</div>
			<?php endif; ?>
			<?php if ($settings['show_pagination'] === 'yes' && $settings['enable_slider'] !== 'yes') : ?>
				<div class="topppa-pagination">
				<?php
				$big = 999999999; // phpcs:ignore WordPress.WP.AlternativeFunctions.rand_rand
				echo wp_kses_post(
					paginate_links(
						array(
							'base'      => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
							'format'    => '?paged=%#%',
							'current'   => max( 1, absint( $paged ) ),
							'total'     => absint( $p->max_num_pages ),
							'prev_text' => '&laquo;',
							'next_text' => '&raquo;',
							'type'      => 'list',
						)
					)
				);
				?>

				</div>
			<?php endif; ?>
		</div>
<?php
	}
}