<?php

use \TopperPack\Includes\Controls\Controls_Manager as TopperPack_Controls_Manager;
use \Elementor\Controls_Manager;
use \Elementor\Widget_Base;

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}

/**
 * Elementor topppa Pricing Table Widget.
 *
 * Elementor widget that inserts an embbedable content into the page, from any given URL.
 *
 * @since 1.0.0
 */
class TOPPPA_Product_Title_Widget extends \Elementor\Widget_Base {

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
		return 'topppa_product_title_widget';
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
		return TOPPPA_EPWB . esc_html__('Product Title/Excerpt', 'topper-pack');
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
		return 'eicon-price-table';
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
		return ['topppa', 'widget', 'title', 'product', 'topperpack'];
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
		return 'https://doc.topperpack.com/docs/woocommerce-widgets/product-title/';
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
		$this->start_controls_section(
			'content_section',
			[
				'label' => esc_html__('Settings', 'topper-pack'),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'show_title',
			[
				'label'        => esc_html__('Show Title', 'topper-pack'),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__('Yes', 'topper-pack'),
				'label_off'    => esc_html__('No', 'topper-pack'),
				'return_value' => 'yes',
				'default'      => 'yes',
			]
		);

		$this->add_control(
			'title_source',
			[
				'label'     => esc_html__('Title Source', 'topper-pack'),
				'type'      => Controls_Manager::SELECT,
				'options'   => [
					'default'  => esc_html__('Default Product Title', 'topper-pack'),
					'custom'   => esc_html__('Custom Title', 'topper-pack'),
					'specific' => esc_html__('Specific Product Title', 'topper-pack'),
				],
				'default'   => 'default',
				'condition' => [
					'show_title' => 'yes',
				],
			]
		);

		$this->add_control(
			'custom_title',
			[
				'label'       => esc_html__('Custom Title', 'topper-pack'),
				'type'        => Controls_Manager::TEXT,
				'default'     => '',
				'placeholder' => esc_html__('Enter your custom title', 'topper-pack'),
				'condition'  => [
					'show_title'    => 'yes',
					'title_source' => 'custom',
				],
			]
		);

		$this->add_control(
			'specific_product',
			[
				'label'     => esc_html__('Select Product for Title', 'topper-pack'),
				'type'      => Controls_Manager::SELECT,
				'options'   => $this->get_all_products(),
				'default'   => '',
				'condition' => [
					'show_title'    => 'yes',
					'title_source' => 'specific',
				],
			]
		);

		$this->add_control(
			'title_link_type',
			[
				'label'     => esc_html__('Title Link Type', 'topper-pack'),
				'type'      => Controls_Manager::SELECT,
				'options'   => [
					'default' => esc_html__('Default Product Link', 'topper-pack'),
					'custom'  => esc_html__('Custom Link', 'topper-pack'),
					'none'    => esc_html__('No Link', 'topper-pack'),
				],
				'default'   => 'none',
				'condition' => [
					'show_title' => 'yes',
				],
			]
		);

		$this->add_control(
			'custom_title_link',
			[
				'label'       => esc_html__('Custom Title Link', 'topper-pack'),
				'type'        => Controls_Manager::URL,
				'placeholder' => esc_html__('https://your-link.com', 'topper-pack'),
				'condition'   => [
					'show_title'      => 'yes',
					'title_link_type' => 'custom',
				],
			]
		);

		$this->add_control(
			'show_excerpt',
			[
				'label'        => esc_html__('Show Excerpt', 'topper-pack'),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__('Yes', 'topper-pack'),
				'label_off'    => esc_html__('No', 'topper-pack'),
				'return_value' => 'yes',
				'default'      => 'yes',
			]
		);

		$this->add_control(
			'excerpt_source',
			[
				'label'     => esc_html__('Excerpt Source', 'topper-pack'),
				'type'      => Controls_Manager::SELECT,
				'options'   => [
					'default'  => esc_html__('Default Product Excerpt', 'topper-pack'),
					'custom'   => esc_html__('Custom Excerpt', 'topper-pack'),
					'specific' => esc_html__('Specific Product Excerpt', 'topper-pack'),
				],
				'default'   => 'default',
				'condition' => [
					'show_excerpt' => 'yes',
				],
			]
		);

		$this->add_control(
			'custom_excerpt',
			[
				'label'       => esc_html__('Custom Excerpt', 'topper-pack'),
				'type'        => Controls_Manager::TEXTAREA,
				'default'     => '',
				'placeholder' => esc_html__('Enter your custom excerpt', 'topper-pack'),
				'condition'   => [
					'show_excerpt'   => 'yes',
					'excerpt_source' => 'custom',
				],
			]
		);

		$this->add_control(
			'specific_product_excerpt',
			[
				'label'     => esc_html__('Select Product for Excerpt', 'topper-pack'),
				'type'      => Controls_Manager::SELECT,
				'options'   => $this->get_all_products(),
				'default'   => '',
				'condition' => [
					'show_excerpt'   => 'yes',
					'excerpt_source' => 'specific',
				],
			]
		);

		$this->end_controls_section();

		// Title Styles
		$this->start_controls_section(
			'title_styles',
			[
				'label'     => esc_html__('Title', 'topper-pack'),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'show_title' => 'yes',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'title_typography',
				'selector' => '{{WRAPPER}} .topppa-product-title',
			]
		);

		$this->add_control(
			'title_color',
			[
				'label'     => esc_html__('Color', 'topper-pack'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .topppa-product-title' => 'color: {{VALUE}}',
					'{{WRAPPER}} .topppa-product-title a' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'title_hcolor',
			[
				'label'     => esc_html__('Hover Color', 'topper-pack'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .topppa-product-title a:hover' => 'color: {{VALUE}}',
				],
				'condition' => [
					'title_link_type!' => 'none'
				]
			]
		);

		$this->add_responsive_control(
			'title_margin',
			[
				'label'      => esc_html__('Margin', 'topper-pack'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors'  => [
					'{{WRAPPER}} .topppa-product-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'title_padding',
			[
				'label'      => esc_html__('Padding', 'topper-pack'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors'  => [
					'{{WRAPPER}} .topppa-product-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		// Excerpt Styles
		$this->start_controls_section(
			'excerpt_styles',
			[
				'label'     => esc_html__('Excerpt', 'topper-pack'),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'show_excerpt' => 'yes',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'excerpt_typography',
				'selector' => '{{WRAPPER}} .topppa-product-excerpt',
			]
		);

		$this->add_control(
			'excerpt_color',
			[
				'label'     => esc_html__('Color', 'topper-pack'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .topppa-product-excerpt' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_responsive_control(
			'excerpt_margin',
			[
				'label'      => esc_html__('Margin', 'topper-pack'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors'  => [
					'{{WRAPPER}} .topppa-product-excerpt' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'excerpt_padding',
			[
				'label'      => esc_html__('Padding', 'topper-pack'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors'  => [
					'{{WRAPPER}} .topppa-product-excerpt' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		// Title Container Styles
		$this->start_controls_section(
			'title_container_styles',
			[
				'label' => esc_html__('Title Container', 'topper-pack'),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'show_title' => 'yes',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'title_container_background',
				'types' => ['classic', 'gradient', 'video'],
				'selector' => '{{WRAPPER}} .topppa-product-title-and-excerpt',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'title_container_border',
				'selector' => '{{WRAPPER}} .topppa-product-title-and-excerpt',
			]
		);

		$this->add_responsive_control(
			'title_container_border_radius',
			[
				'label' => esc_html__('Border Radius', 'topper-pack'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .topppa-product-title-and-excerpt' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'title_container_box_shadow',
				'selector' => '{{WRAPPER}} .topppa-product-title-and-excerpt',
			]
		);

		$this->add_responsive_control(
			'title_container_padding',
			[
				'label' => esc_html__('Padding', 'topper-pack'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .topppa-product-title-and-excerpt' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'title_container_margin',
			[
				'label' => esc_html__('Margin', 'topper-pack'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .topppa-product-title-and-excerpt' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		// Title Text Shadow
		$this->start_controls_section(
			'title_text_shadow',
			[
				'label' => esc_html__('Title Text Shadow', 'topper-pack'),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'show_title' => 'yes',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'title_text_shadow',
				'selector' => '{{WRAPPER}} .topppa-product-title, {{WRAPPER}} .topppa-product-title a',
			]
		);

		$this->end_controls_section();

		// Title Hover Effects
		$this->start_controls_section(
			'title_hover_effects',
			[
				'label' => esc_html__('Title Hover Effects', 'topper-pack'),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'show_title' => 'yes',
					'title_link_type!' => 'none',
				],
			]
		);

		$this->add_control(
			'title_hover_animation',
			[
				'label' => esc_html__('Hover Animation', 'topper-pack'),
				'type' => Controls_Manager::HOVER_ANIMATION,
			]
		);

		$this->add_control(
			'title_hover_transition',
			[
				'label' => esc_html__('Transition Duration', 'topper-pack'),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 0.3,
				],
				'range' => [
					'px' => [
						'max' => 3,
						'step' => 0.1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .topppa-product-title a' => 'transition: all {{SIZE}}s',
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
		$options  = ['' => esc_html__('Select Product', 'topper-pack')];

		if (!is_wp_error($products)) {
			foreach ($products as $product) {
				$options[$product->ID] = $product->post_title;
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
		$settings = $this->get_settings_for_display();
		$product_id = '';

		// Check if we're in theme builder
		$is_theme_builder = \Elementor\Plugin::$instance->editor->is_edit_mode(); // phpcs:ignore WordPress.NamingConventions.ValidVariableName.UsedPropertyNotSnakeCase

		// Get current product ID if on a product page
		if (is_product() && !$is_theme_builder) {
			global $product;
			if ($product) {
				$product_id = $product->get_id();
			}
		}

		// Determine Title
		$title = '';
		if (!empty($settings['show_title']) && $settings['show_title'] === 'yes') {
			switch ($settings['title_source']) {
				case 'custom':
					$title = !empty($settings['custom_title']) ? $settings['custom_title'] : '';
					break;
				case 'specific':
					if (!empty($settings['specific_product'])) {
						$specific_product = wc_get_product($settings['specific_product']);
						$title = $specific_product ? $specific_product->get_name() : '';
					}
					break;
				default: // 'default'
					if ($product_id) {
						$product = wc_get_product($product_id);
						$title = $product ? $product->get_name() : '';
					} elseif ($is_theme_builder) {
						// Show dummy title in theme builder
						$title = esc_html__('Sample Product Title', 'topper-pack');
					}
					break;
			}
		}

		// Determine Title Link
		$title_link = '';
		if (!empty($settings['title_link_type'])) {
			switch ($settings['title_link_type']) {
				case 'default':
					if ($product_id) {
						$title_link = get_permalink($product_id);
					} elseif ($is_theme_builder) {
						$title_link = '#'; // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited
					}
					break;
				case 'custom':
					if (!empty($settings['custom_title_link']['url'])) {
						$title_link = esc_url($settings['custom_title_link']['url']);
					}
					break;
					// 'none' case doesn't need handling - link remains empty
			}
		}

		// Determine Excerpt
		$excerpt = '';
		if (!empty($settings['show_excerpt']) && $settings['show_excerpt'] === 'yes') {
			switch ($settings['excerpt_source']) {
				case 'custom':
					$excerpt = !empty($settings['custom_excerpt']) ? $settings['custom_excerpt'] : '';
					break;
				case 'specific':
					if (!empty($settings['specific_product_excerpt'])) {
						$specific_product = wc_get_product($settings['specific_product_excerpt']);
						$excerpt = $specific_product ? $specific_product->get_short_description() : '';
					}
					break;
				default: // 'default'
					if ($product_id) {
						$product = wc_get_product($product_id);
						$excerpt = $product ? $product->get_short_description() : '';
					} elseif ($is_theme_builder) {
						// Show dummy excerpt in theme builder
						$excerpt = esc_html__('This is a sample product description. It will be replaced with the actual product description when viewing a real product page.', 'topper-pack');
					}
					break;
			}
		}

		// Output
		echo '<div class="topppa-product-title-and-excerpt">';

		// Title output
		if (!empty($settings['show_title']) && $settings['show_title'] === 'yes' && $title) {
			if ($title_link) {
				$target = !empty($settings['custom_title_link']['is_external']) ? ' target="_blank"' : '';
				$nofollow = !empty($settings['custom_title_link']['nofollow']) ? ' rel="nofollow"' : '';
				$custom_attr = !empty($settings['custom_title_link']['custom_attributes']) ? $settings['custom_title_link']['custom_attributes'] : '';
				echo '<h2 class="topppa-product-title"><a href="' . esc_url($title_link) . '"' . esc_attr($target) . esc_attr($nofollow) . esc_attr($custom_attr) . '>' . esc_html($title) . '</a></h2>';
			} else {
				echo '<h2 class="topppa-product-title">' . esc_html($title) . '</h2>';
			}
		}

		// Excerpt output
		if (!empty($settings['show_excerpt']) && $settings['show_excerpt'] === 'yes' && $excerpt) {
			echo '<div class="topppa-product-excerpt">' . wp_kses_post(wpautop($excerpt)) . '</div>';
		}

		echo '</div>';
	}
}
