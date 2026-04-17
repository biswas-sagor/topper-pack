<?php

use \TopperPack\Includes\Controls\Controls_Manager as TopperPack_Controls_Manager;
use \Elementor\Controls_Manager;
use \Elementor\Widget_Base;

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}

/**
 * Elementor topppa Product Price Widget.
 *
 * Elementor widget that displays the product price.
 *
 * @since 1.0.0
 */
class TOPPPA_Product_Price_Widget extends Widget_Base {

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
		return 'topppa_product_price_widget';
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
		return TOPPPA_EPWB . esc_html__('Product Price', 'topper-pack');
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
		return 'eicon-price-list';
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
		return ['product', 'price', 'store', 'woocommerce', 'topppa', 'topperpack'];
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
		return 'https://doc.topperpack.com/docs/woocommerce-widgets/product-price/';
	}

	/**
	 * Register Product Price Widget controls.
	 *
	 * Add input fields to allow the user to customize the widget settings.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function register_controls() {
		$this->start_controls_section(
			'content_section',
			[
				'label' => esc_html__('Settings', 'topper-pack'),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'use_selected_product',
			[
				'label'        => esc_html__('Select Specific Product?', 'topper-pack'),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__('Yes', 'topper-pack'),
				'label_off'    => esc_html__('No', 'topper-pack'),
				'return_value' => 'yes',
				'default'      => '',
			]
		);
		$this->add_control(
			'selected_product',
			[
				'label'     => esc_html__('Select Product', 'topper-pack'),
				'type'      => Controls_Manager::SELECT,
				'options'   => $this->get_all_products(),
				'default'   => '',
				'condition' => [
					'use_selected_product' => 'yes',
				],
			]
		);
		$this->add_control(
			'enable_link',
			[
				'label'        => esc_html__('Link to Product Page?', 'topper-pack'),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__('Yes', 'topper-pack'),
				'label_off'    => esc_html__('No', 'topper-pack'),
				'return_value' => 'yes',
				'default'      => '',
			]
		);
		$this->add_control(
			'link_target',
			[
				'label'     => esc_html__('Link Target', 'topper-pack'),
				'type'      => Controls_Manager::SELECT,
				'options'   => [
					'_self'  => esc_html__('Same Tab', 'topper-pack'),
					'_blank' => esc_html__('New Tab', 'topper-pack'),
				],
				'default'   => '_self',
				'condition' => [
					'enable_link' => 'yes',
				],
			]
		);
		$this->add_control(
			'custom_price',
			[
				'label'       => esc_html__('Custom Price', 'topper-pack'),
				'type'        => Controls_Manager::TEXT,
				'input_type'  => 'number',
				'placeholder' => esc_html__('Enter custom price', 'topper-pack'),
				'default'     => '',
			]
		);
		$this->end_controls_section();

		// <==========>
		// <==========> PRICE STYLES <==========>

		$this->start_controls_section(
			'store_price_styles',
			[
				'label' => esc_html__('Price', 'topper-pack'),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_responsive_control(
			'store_price_direction',
			[
				'label' => esc_html__('Alignment', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'options' => [
					'row' => [
						'title' => esc_html__('Left', 'topper-pack'),
						'icon' => 'eicon-h-align-right',
					],
					'row-reverse' => [
						'title' => esc_html__('Right', 'topper-pack'),
						'icon' => 'eicon-h-align-left',
					],
				],
				'default' => 'row',
				'toggle' => true,
				'selectors' => [
					'{{WRAPPER}} .topppa-product-price del bdi, .topppa-product-price bdi' => 'flex-direction: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'store_price_typo',
				'label' => __('Typography', 'topper-pack'),
				'selector' => ' {{WRAPPER}} .topppa-product-price bdi, .topppa-product-price',
			]
		);
		$this->add_responsive_control(
			'store_price_color',
			[
				'label' => esc_html__('Color', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .topppa-product-price bdi, .topppa-product-price' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_responsive_control(
			'store_price_hcolor',
			[
				'label' => esc_html__('Hover Color', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .topppa-product-price a bdi:hover' => 'color: {{VALUE}};',
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
					'{{WRAPPER}} .topppa-product-price bdi' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .topppa-product-price bdi' => 'Padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
				'selector' => ' {{WRAPPER}} .topppa-product-price del bdi',
			]
		);
		$this->add_responsive_control(
			'pre_price_color',
			[
				'label' => esc_html__('Color', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .topppa-product-price del bdi' => 'color: {{VALUE}};',
					'{{WRAPPER}} .topppa-product-price del' => 'color: {{VALUE}};',
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
					'{{WRAPPER}} .topppa-product-price del bdi' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .topppa-product-price del bdi' => 'Padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();
	}

	/**
	 * Get all products.
	 *
	 * Retrieve all WooCommerce products for selection in the widget controls.
	 *
	 * @since 1.0.0
	 * @access protected
	 * @return array Product options.
	 */
	protected function get_all_products() {
		$products = get_posts(['post_type' => 'product', 'numberposts' => -1]);
		$options  = [];
		if (!is_wp_error($products)) {
			foreach ($products as $product) {
				$options[$product->ID] = $product->post_title;
			}
		}
		return $options;
	}

	/**
	 * Render product price widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();

		// Check if WooCommerce is installed and active
		if (!class_exists('WooCommerce')) {
			echo '<div class="elementor-alert elementor-alert-warning">';
			echo esc_html__('WooCommerce is not installed. Please install and activate WooCommerce to use this widget.', 'topper-pack');
			echo '</div>';
			return;
		}

		// Check if we're in theme builder
		$is_theme_builder = \Elementor\Plugin::$instance->editor->is_edit_mode();

		$product_id = '';

		// If a specific product is selected, use that
		if (!empty($settings['use_selected_product']) && !empty($settings['selected_product'])) {
			$product_id = $settings['selected_product'];
		} elseif (is_product() && !$is_theme_builder) {
			global $product;
			if ($product) {
				$product_id = $product->get_id();
			}
		}

		// If no product selected and not in theme builder, show warning
		if (!$product_id && !$is_theme_builder) {
			echo '<div class="elementor-alert elementor-alert-warning">';
			echo esc_html__('No product available.', 'topper-pack');
			echo '</div>';
			return;
		}

		// Get product price and format
		$product_price = '';
		if ($is_theme_builder) {
			// Show dummy price in theme builder
			$product_price = '<del><bdi><span class="woocommerce-Price-currencySymbol">$</span>' . esc_html__('99.99', 'topper-pack') . '</bdi></del> <bdi><span class="woocommerce-Price-currencySymbol">$</span>' . esc_html__('79.99', 'topper-pack') . '</bdi>';
		} else {
			$product = wc_get_product($product_id);
			// If invalid product, show warning
			if (!$product) {
				echo '<div class="elementor-alert elementor-alert-warning">';
				echo esc_html__('Invalid product selected.', 'topper-pack');
				echo '</div>';
				return;
			}
			$product_price = $settings['custom_price'] ? wc_price($settings['custom_price']) : $product->get_price_html();
		}

		// Link to product page if enabled
		$product_link = '';
		if (!empty($settings['enable_link']) && 'yes' === $settings['enable_link']) {
			$product_link = $is_theme_builder ? '#' : get_permalink($product_id);
		}

		// Check if product has a price and render
		if (!empty($product_price)) {
			echo '<div class="topppa-product-price">';
			if ($product_link) {
				// Open link if enabled
				echo '<a href="' . esc_url($product_link) . '" target="' . esc_attr($settings['link_target']) . '">';
			}
			echo wp_kses_post($product_price);
			if ($product_link) {
				// Close link
				echo '</a>';
			}
			echo '</div>';
		} else {
			echo '<div class="elementor-alert elementor-alert-warning">';
			echo esc_html__('No price available for this product.', 'topper-pack');
			echo '</div>';
		}
	}
}
