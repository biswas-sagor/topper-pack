<?php

use \TopperPack\Includes\Controls\Controls_Manager as TopperPack_Controls_Manager;
use \Elementor\Controls_Manager;
use \Elementor\Widget_Base;

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}

/**
 * Elementor topppa Product Add to Cart Button Widget.
 *
 * Elementor widget that displays an "Add to Cart" button for a specific product.
 *
 * @since 1.0.0
 */
class TOPPPA_Product_Cart_Button_Widget extends Widget_Base {

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
		return 'topppa_product_add_to_cart_button';
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
		return TOPPPA_EPWB . esc_html__('Product Cart Button', 'topper-pack');
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
		return 'eicon-cart';
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
		return ['product', 'add to cart', 'button', 'woocommerce', 'shop', 'topppa', 'topperpack'];
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
		return 'https://doc.topperpack.com/docs/woocommerce-widgets/cart-button/';
	}

	/**
	 * Register Product Add to Cart Button Widget controls.
	 *
	 * Add input fields to allow the user to customize the widget settings.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function register_controls() {
		// Content Section
		$this->start_controls_section(
			'content_section',
			[
				'label' => esc_html__('Settings', 'topper-pack'),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);
		// Enable Specific Product Selection
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

		// Select Product (Conditional)
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

		// Button Text
		$this->add_control(
			'button_text',
			[
				'label'       => esc_html__('Button Text', 'topper-pack'),
				'type'        => Controls_Manager::TEXT,
				'default'     => esc_html__('Add to Cart', 'topper-pack'),
				'placeholder' => esc_html__('Enter button text', 'topper-pack'),
			]
		);

		// Add Static Button Control
		$this->add_control(
			'use_static_button',
			[
				'label'        => esc_html__('Use Static Button?', 'topper-pack'),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__('Yes', 'topper-pack'),
				'label_off'    => esc_html__('No', 'topper-pack'),
				'return_value' => 'yes',
				'default'      => '',
			]
		);

		// Add Total Price Display Control
		$this->add_control(
			'show_total_price',
			[
				'label'        => esc_html__('Show Quantity & Total Price?', 'topper-pack'),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__('Yes', 'topper-pack'),
				'label_off'    => esc_html__('No', 'topper-pack'),
				'return_value' => 'yes',
				'default'      => 'no',
				'separator'    => 'before',
			]
		);

		$this->add_control(
			'total_price_format',
			[
				'label'       => esc_html__('Price Format', 'topper-pack'),
				'type'        => Controls_Manager::SELECT,
				'default'     => 'x{quantity} = {total}',
				'options'     => [
					'x{quantity} = {total}' => esc_html__('x6 = $60', 'topper-pack'),
					'{quantity} x {price} = {total}' => esc_html__('6 x $10 = $60', 'topper-pack'),
					'{total}' => esc_html__('Total: $60', 'topper-pack'),
					'{title}: x{quantity} = {total}' => esc_html__('Product Title: x6 = $60', 'topper-pack'),
				],
				'condition'   => [
					'show_total_price' => 'yes',
				],
			]
		);

		$this->end_controls_section();

		// <==========> BOX STYLES <==========>

		$this->start_controls_section(
			'box_styles',
			[
				'label' => esc_html__('Box', 'topper-pack'),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_responsive_control(
			'box_display',
			[
				'label' => esc_html__('Display Style', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => '',
				'options' => [
					'' => esc_html__('Default', 'topper-pack'),
					'flex' => esc_html__('Flex', 'topper-pack'),
				],
				'selectors' => [
					'{{WRAPPER}} .topppa-add-to-cart-with-options form.cart' => 'display: {{VALUE}};',
				],
			]
		);
		$this->add_responsive_control(
			'content_box_direction',
			[
				'label' => esc_html__('Direction', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'none',
				'options' => [
					'none' => esc_html__('None', 'topper-pack'),
					'row' => esc_html__('Row', 'topper-pack'),
					'row-reverse' => esc_html__('Row Reverse', 'topper-pack'),
					'column'  => esc_html__('Column', 'topper-pack'),
					'column-reverse' => esc_html__('Column Reverse', 'topper-pack'),
				],
				'selectors' => [
					'{{WRAPPER}} .topppa-add-to-cart-with-options form.cart' => 'flex-direction: {{VALUE}};',
				],
				'condition' => [
					'box_display' => 'flex',
				]
			]
		);
		$this->add_responsive_control(
			'content_box_align',
			[
				'label' => esc_html__('Alignment', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'options' => [
					'start' => [
						'title' => esc_html__('Start', 'topper-pack'),
						'icon' => 'eicon-v-align-top',
					],
					'center' => [
						'title' => esc_html__('Center', 'topper-pack'),
						'icon' => 'eicon-v-align-middle',
					],
					'end' => [
						'title' => esc_html__('End', 'topper-pack'),
						'icon' => 'eicon-v-align-bottom',
					],
				],
				'toggle' => true,
				'selectors' => [
					'{{WRAPPER}} .topppa-add-to-cart-with-options form.cart' => 'align-items: {{VALUE}};',
				],
				'condition' => [
					'box_display' => 'flex',
				]
			]
		);
		$this->add_responsive_control(
			'content_box_jalign',
			[
				'label' => esc_html__('Alignment', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'options' => [
					'start' => [
						'title' => esc_html__('Left', 'topper-pack'),
						'icon' => 'eicon-align-start-h',
					],
					'center' => [
						'title' => esc_html__('Center', 'topper-pack'),
						'icon' => 'eicon-align-center-h',
					],
					'end' => [
						'title' => esc_html__('Right', 'topper-pack'),
						'icon' => 'eicon-align-end-h',
					],
				],
				'toggle' => true,
				'selectors' => [
					'{{WRAPPER}} .topppa-add-to-cart-with-options form.cart' => 'justify-content: {{VALUE}};',
					'{{WRAPPER}} .topppa-add-to-cart-with-options form.cart' => 'text-align: {{VALUE}};',
				],
				'condition' => [
					'box_display' => 'flex',
					'content_box_direction' => ['column', 'column-reverse']
				]
			]
		);
		$this->add_responsive_control(
			'content_box_gap',
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
					'{{WRAPPER}} .topppa-add-to-cart-with-options form.cart' => 'gap: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'box_display' => 'flex',
				]
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'box_bg',
				'label' => esc_html__('Background', 'topper-pack'),
				'types' => ['classic', 'gradient', 'video'],
				'selector' => '{{WRAPPER}} .topppa-add-to-cart-with-options form.cart',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'box_border',
				'label' => esc_html__('Border', 'topper-pack'),
				'selector' => '{{WRAPPER}} .topppa-add-to-cart-with-options form.cart',
			]
		);
		$this->add_responsive_control(
			'box_radius',
			[
				'label' => esc_html__('Border Radius', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .topppa-add-to-cart-with-options form.cart' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'box_shadow',
				'label' => esc_html__('Box Shadow', 'topper-pack'),
				'selector' => '{{WRAPPER}} .topppa-add-to-cart-with-options form.cart',
			]
		);
		$this->add_responsive_control(
			'box_margin',
			[
				'label' => esc_html__('Margin', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .topppa-add-to-cart-with-options form.cart' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .topppa-add-to-cart-with-options form.cart' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();

		// Form Input
		$this->start_controls_section(
			'quantity_input',
			[
				'label' => __('Quantity Input', 'topper-pack'),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_responsive_control(
			'quantity_input_height',
			[
				'label'     => __('Height', 'topper-pack'),
				'type'      => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px', '%'],
				'range'      => [
					'px' => [
						'min'  => 0,
						'max'  => 1000,
						'step' => 1,
					],
					'%'  => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .topppa-add-to-cart-with-options .input-text.qty.text'   => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'quantity_input_width',
			[
				'label'      => __('Width', 'topper-pack'),
				'type'       => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px', '%'],
				'range'      => [
					'px' => [
						'min'  => 0,
						'max'  => 1000,
						'step' => 1,
					],
					'%'  => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .topppa-add-to-cart-with-options .quantity'   => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'quantity_input_bg',
				'types' => ['classic', 'gradient', 'video'],
				'selector' => '{{WRAPPER}} .topppa-add-to-cart-with-options .input-text.qty.text',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'quantity_input_typography',
				'selector' => '{{WRAPPER}} .topppa-add-to-cart-with-options .input-text.qty.text',
			]
		);
		$this->add_responsive_control(
			'quantity_input_text_color',
			[
				'label'     => __('Color', 'topper-pack'),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .topppa-add-to-cart-with-options .input-text.qty.text'   => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_responsive_control(
			'quantity_input_placeholder_color',
			[
				'label'     => __('Placeholder Color', 'topper-pack'),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .topppa-add-to-cart-with-options .input-text.qty.text::-webkit-input-placeholder'   => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'quantity_input_border',
				'selector' => '{{WRAPPER}} .topppa-add-to-cart-with-options .input-text.qty.text',
			]
		);
		$this->add_responsive_control(
			'quantity_input_border_radius',
			[
				'label'     => __('Border Radius', 'topper-pack'),
				'type'      => \Elementor\Controls_Manager::DIMENSIONS,
				'selectors' => [
					'{{WRAPPER}} .topppa-add-to-cart-with-options .input-text.qty.text'   => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
				],
				'separator' => 'before',
			]
		);
		$this->add_responsive_control(
			'quantity_input_padding',
			[
				'label'      => __('Padding', 'topper-pack'),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors'  => [
					'{{WRAPPER}} .topppa-add-to-cart-with-options .input-text.qty.text'   => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'quantity_input_margin',
			[
				'label'      => __('Margin', 'topper-pack'),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors'  => [
					'{{WRAPPER}} .topppa-add-to-cart-with-options .input-text.qty.text'   => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();

		// <==========>
		// <==========> TITLE STYLES <==========>

		$this->start_controls_section(
			'select_styles',
			[
				'label' => esc_html__('Select Style', 'topper-pack'),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'topppa_select_typography',
				'selector' => '{{WRAPPER}} .woocommerce div.product .topppa-add-to-cart-with-options form.cart .variations select',
			]
		);
		$this->add_responsive_control(
			'topppa_select_color',
			[
				'label' => esc_html__('Color', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .woocommerce div.product .topppa-add-to-cart-with-options form.cart .variations select' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'topppa_select_background',
				'types' => ['classic', 'gradient', 'video'],
				'selector' => '{{WRAPPER}} .woocommerce div.product .topppa-add-to-cart-with-options form.cart .variations select',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'topppa_select_border',
				'selector' => '{{WRAPPER}} .woocommerce div.product .topppa-add-to-cart-with-options form.cart .variations select',
			]
		);
		$this->add_responsive_control(
			'topppa_select_border_radius',
			[
				'label' => esc_html__('Border Radius', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .woocommerce div.product .topppa-add-to-cart-with-options form.cart .variations select' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'topppa_select_margin',
			[
				'label' => esc_html__('Margin', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em', 'rem', 'custom'],
				'selectors' => [
					'{{WRAPPER}} .woocommerce div.product .topppa-add-to-cart-with-options form.cart .variations select' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'topppa_select_padding',
			[
				'label' => esc_html__('Padding', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em', 'rem', 'custom'],
				'selectors' => [
					'{{WRAPPER}} .woocommerce div.product .topppa-add-to-cart-with-options form.cart .variations select' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();

		// Form Input
		$this->start_controls_section(
			'topppa_variation_input',
			[
				'label' => __('Variable Input', 'topper-pack'),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'topppa_variation_typography',
				'selector' => '{{WRAPPER}} .topppa-add-to-cart-with-options .variations_form .variations label',
			]
		);
		$this->add_responsive_control(
			'topppa_variation_color',
			[
				'label' => esc_html__('Color', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .topppa-add-to-cart-with-options .variations_form .variations label' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_responsive_control(
			'topppa_variation_margin',
			[
				'label' => esc_html__('Margin', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em', 'rem', 'custom'],
				'selectors' => [
					'{{WRAPPER}} .topppa-add-to-cart-with-options .variations_form .variations label' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'topppa_variation_padding',
			[
				'label' => esc_html__('Padding', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em', 'rem', 'custom'],
				'selectors' => [
					'{{WRAPPER}} .topppa-add-to-cart-with-options .variations_form .variations label' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'dividers',
			[
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_responsive_control(
			'topppa_variation_input_height',
			[
				'label'     => __('Height', 'topper-pack'),
				'type'      => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px', '%'],
				'range'      => [
					'px' => [
						'min'  => 0,
						'max'  => 1000,
						'step' => 1,
					],
					'%'  => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .topppa-add-to-cart-with-options .variations_form .variations select, .woocommerce .topppa-add-to-cart-with-options select#pa_size, .woocommerce .topppa-add-to-cart-with-options select#pa_color'   => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'topppa_variation_input_width',
			[
				'label'      => __('Width', 'topper-pack'),
				'type'       => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px', '%'],
				'range'      => [
					'px' => [
						'min'  => 0,
						'max'  => 100,
						'step' => 1,
					],
					'%'  => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .topppa-add-to-cart-with-options .variations_form .variations select, .woocommerce .topppa-add-to-cart-with-options select#pa_size, .woocommerce .topppa-add-to-cart-with-options select#pa_color'   => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'topppa_variation_input_bg',
				'types' => ['classic', 'gradient', 'video'],
				'selector' => '{{WRAPPER}} .topppa-add-to-cart-with-options .variations_form .variations select',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'topppa_variation_input_typography',
				'selector' => '{{WRAPPER}} .topppa-add-to-cart-with-options .variations_form .variations select, .woocommerce .topppa-add-to-cart-with-options select#pa_size, .woocommerce .topppa-add-to-cart-with-options select#pa_color',
			]
		);
		$this->add_responsive_control(
			'topppa_variation_input_text_color',
			[
				'label'     => __('Color', 'topper-pack'),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .topppa-add-to-cart-with-options .variations_form .variations select'   => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'topppa_variation_input_border',
				'selector' => '{{WRAPPER}} .topppa-add-to-cart-with-options .variations_form .variations select, .woocommerce .topppa-add-to-cart-with-options select#pa_size, .woocommerce .topppa-add-to-cart-with-options select#pa_color',
			]
		);
		$this->add_responsive_control(
			'topppa_variation_input_border_radius',
			[
				'label'     => __('Border Radius', 'topper-pack'),
				'type'      => \Elementor\Controls_Manager::DIMENSIONS,
				'selectors' => [
					'{{WRAPPER}} .topppa-add-to-cart-with-options .variations_form .variations select, .woocommerce .topppa-add-to-cart-with-options select#pa_size, .woocommerce .topppa-add-to-cart-with-options select#pa_color'   => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
				],
				'separator' => 'before',
			]
		);
		$this->add_responsive_control(
			'topppa_variation_input_padding',
			[
				'label'      => __('Padding', 'topper-pack'),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors'  => [
					'{{WRAPPER}} .topppa-add-to-cart-with-options .variations_form .variations select, .woocommerce .topppa-add-to-cart-with-options select#pa_size, .woocommerce .topppa-add-to-cart-with-options select#pa_color'   => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'topppa_variation_input_margin',
			[
				'label'      => __('Margin', 'topper-pack'),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors'  => [
					'{{WRAPPER}} .topppa-add-to-cart-with-options .variations_form .variations select, .woocommerce .topppa-add-to-cart-with-options select#pa_size, .woocommerce .topppa-add-to-cart-with-options select#pa_color'   => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();

		// <========================> BOX STYLES <========================>
		$this->start_controls_section(
			'topppa_btn_style',
			[
				'label' => esc_html__('Cart Button', 'topper-pack'),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
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
				'selector' => '{{WRAPPER}} .topppa-add-to-cart-button, {{WRAPPER}} .topppa-add-to-cart-button.button.alt.topppa-btn',
			]
		);

		$this->add_responsive_control(
			'topppa_btn_color',
			[
				'label'     => esc_html__('Color', 'topper-pack'),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .topppa-add-to-cart-button, {{WRAPPER}} .topppa-add-to-cart-button.button.alt.topppa-btn' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'topppa_btn_background',
				'types' => ['classic', 'gradient', 'video'],
				'selector' => '{{WRAPPER}} .topppa-add-to-cart-button, {{WRAPPER}} .topppa-add-to-cart-button.button.alt.topppa-btn',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name'     => 'topppa_btn_border',
				'label'    => esc_html__('Border', 'topper-pack'),
				'selector' => '{{WRAPPER}} .topppa-add-to-cart-button, {{WRAPPER}} .topppa-add-to-cart-button.button.alt.topppa-btn',
			]
		);

		$this->add_responsive_control(
			'topppa_btn_border_radius',
			[
				'label'      => esc_html__('Border Radius', 'topper-pack'),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors'  => [
					'{{WRAPPER}} .topppa-add-to-cart-button, {{WRAPPER}} .topppa-add-to-cart-button.button.alt.topppa-btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'topppa_btn_box_shadow',
				'label'    => esc_html__('Shadow', 'topper-pack'),
				'selector' => '{{WRAPPER}} .topppa-add-to-cart-button, {{WRAPPER}} .topppa-add-to-cart-button.button.alt.topppa-btn',
			]
		);
		$this->add_responsive_control(
			'topppa_btn_margin',
			[
				'label'      => esc_html__('Margin', 'topper-pack'),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors'  => [
					'{{WRAPPER}} .topppa-add-to-cart-button, {{WRAPPER}} .topppa-add-to-cart-button.button.alt.topppa-btn' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .topppa-add-to-cart-button, {{WRAPPER}} .topppa-add-to-cart-button.button.alt.topppa-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
				'selector' => '{{WRAPPER}} .topppa-add-to-cart-button:hover, {{WRAPPER}} .topppa-add-to-cart-button.button.alt.topppa-btn:hover',
			]
		);

		$this->add_responsive_control(
			'topppa_btn_color_hover',
			[
				'label'     => esc_html__('Color', 'topper-pack'),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .topppa-add-to-cart-button:hover, {{WRAPPER}} .topppa-add-to-cart-button.button.alt.topppa-btn:hover' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'topppa_btn_background_hover',
				'types' => ['classic', 'gradient', 'video'],
				'selector' => '{{WRAPPER}} .topppa-add-to-cart-button:hover, {{WRAPPER}} .topppa-add-to-cart-button.button.alt.topppa-btn:hover',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name'     => 'topppa_btn_border_hover',
				'label'    => esc_html__('Border', 'topper-pack'),
				'selector' => '{{WRAPPER}} .topppa-add-to-cart-button:hover, {{WRAPPER}} .topppa-add-to-cart-button.button.alt.topppa-btn:hover',
			]
		);

		$this->add_responsive_control(
			'topppa_btn_border_radius_hover',
			[
				'label'      => esc_html__('Border Radius', 'topper-pack'),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors'  => [
					'{{WRAPPER}} .topppa-add-to-cart-button:hover, {{WRAPPER}} .topppa-add-to-cart-button.button.alt.topppa-btn:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'topppa_btn_box_shadow_hover',
				'label'    => esc_html__('Shadow', 'topper-pack'),
				'selector' => '{{WRAPPER}} .topppa-add-to-cart-button:hover, {{WRAPPER}} .topppa-add-to-cart-button.button.alt.topppa-btn:hover',
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();

		// Add Total Price Styles
		$this->start_controls_section(
			'total_price_styles',
			[
				'label' => esc_html__('Quantity & Price', 'topper-pack'),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
				'condition' => [
					'show_total_price' => 'yes',
				],
			]
		);
		$this->add_responsive_control(
			'total_price_display',
			[
				'label' => esc_html__('Display', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'inherit',
				'options' => [
					'inherit' => esc_html__('Default', 'topper-pack'),
					'flex' => esc_html__('Flex', 'topper-pack'),
				],
				'selectors' => [
					'{{WRAPPER}} .topppa-total-price' => 'display: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'total_price_flex_direction',
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
					'{{WRAPPER}} .topppa-total-price' => 'flex-direction: {{VALUE}};',
				],
				'condition' => [
					'total_price_display' => 'flex',
				]
			]
		);
		$this->add_responsive_control(
			'total_price_align_items',
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
				],
				'toggle' => true,
				'selectors' => [
					'{{WRAPPER}} .topppa-total-price' => 'align-items: {{VALUE}};',
				],
				'condition' => [
					'total_price_display' => 'flex',
				]
			]
		);
		$this->add_responsive_control(
			'total_price_justify_content',
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
					'{{WRAPPER}} .topppa-total-price' => 'justify-content: {{VALUE}};',
				],
				'condition' => [
					'total_price_display' => 'flex',
				]
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
				],
				'toggle' => true,
				'selectors' => [
					'{{WRAPPER}} .topppa-total-price' => 'align-content: {{VALUE}};',
				],
				'condition' => [
					'total_price_display' => 'flex',
				]
			]
		);
		$this->add_responsive_control(
			'total_price_gap',
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
					'{{WRAPPER}} .topppa-total-price' => 'gap: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'total_price_display' => 'flex',
				]
			]
		);

		$this->add_control(
			'total_price_more_options',
			[
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'total_price_box_bg',
				'label' => esc_html__('Background', 'topper-pack'),
				'types' => ['classic', 'gradient', 'video'],
				'selector' => '{{WRAPPER}} .topppa-total-price',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'total_price_box_border',
				'label' => esc_html__('Border', 'topper-pack'),
				'selector' => '{{WRAPPER}} .topppa-total-price',
			]
		);
		$this->add_responsive_control(
			'total_price_box_radius',
			[
				'label' => esc_html__('Border Radius', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .topppa-total-price' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'total_price_box_shadow',
				'label' => esc_html__('Box Shadow', 'topper-pack'),
				'selector' => '{{WRAPPER}} .topppa-total-price',
			]
		);
		$this->add_responsive_control(
			'total_price_box_margin',
			[
				'label' => esc_html__('Margin', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .topppa-total-price' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'total_price_box_padding',
			[
				'label' => esc_html__('Padding', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .topppa-total-price' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->start_controls_tabs(
			'total_price_style_tabs'
		);

		$this->start_controls_tab(
			'total_price_style_normal_tab',
			[
				'label' => esc_html__('Title', 'topper-pack'),
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'total_price_typography',
				'selector' => '{{WRAPPER}} .topppa-price-title-wrapper',
			]
		);

		$this->add_responsive_control(
			'total_price_color',
			[
				'label'     => esc_html__('Color', 'topper-pack'),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .topppa-price-title-wrapper' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_responsive_control(
			'total_price_margin',
			[
				'label'      => esc_html__('Margin', 'topper-pack'),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors'  => [
					'{{WRAPPER}} .topppa-price-title-wrapper' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'total_price_padding',
			[
				'label'      => esc_html__('Padding', 'topper-pack'),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors'  => [
					'{{WRAPPER}} .topppa-price-title-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'price_content_styles',
			[
				'label' => esc_html__('Content', 'topper-pack'),
			]
		);
		$this->add_control(
			'price_content_box',
			[
				'label' => esc_html__('Content Box', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_responsive_control(
			'price_content_display',
			[
				'label' => esc_html__('Display', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'inherit',
				'options' => [
					'inherit' => esc_html__('Default', 'topper-pack'),
					'flex' => esc_html__('Flex', 'topper-pack'),
				],
				'selectors' => [
					'{{WRAPPER}} .topppa-price-quantity-container' => 'display: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'price_content_flex_direction',
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
					'{{WRAPPER}} .topppa-price-quantity-container' => 'flex-direction: {{VALUE}};',
				],
				'condition' => [
					'price_content_display' => 'flex',
				]
			]
		);
		$this->add_responsive_control(
			'price_content_align_items',
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
				],
				'toggle' => true,
				'selectors' => [
					'{{WRAPPER}} .topppa-price-quantity-container' => 'align-items: {{VALUE}};',
				],
				'condition' => [
					'price_content_display' => 'flex',
				]
			]
		);
		$this->add_responsive_control(
			'price_content_justify_content',
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
					'{{WRAPPER}} .topppa-price-quantity-container' => 'justify-content: {{VALUE}};',
				],
				'condition' => [
					'price_content_display' => 'flex',
				]
			]
		);
		$this->add_responsive_control(
			'price_content_content',
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
					'{{WRAPPER}} .topppa-price-quantity-container' => 'align-content: {{VALUE}};',
				],
				'condition' => [
					'price_content_display' => 'flex',
				]
			]
		);
		$this->add_responsive_control(
			'price_content_gap',
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
					'{{WRAPPER}} .topppa-price-quantity-container' => 'gap: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'price_content_display' => 'flex',
				]
			]
		);

		$this->add_control(
			'price_quantity',
			[
				'label' => esc_html__('Price', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'price_content_typography',
				'selector' => '{{WRAPPER}} .topppa-price-quantity-container',
			]
		);

		$this->add_responsive_control(
			'price_content_color',
			[
				'label'     => esc_html__('Color', 'topper-pack'),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .topppa-price-quantity-container' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_responsive_control(
			'price_content_margin',
			[
				'label'      => esc_html__('Margin', 'topper-pack'),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors'  => [
					'{{WRAPPER}} .topppa-price-quantity-container' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'price_content_padding',
			[
				'label'      => esc_html__('Padding', 'topper-pack'),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors'  => [
					'{{WRAPPER}} .topppa-price-quantity-container' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'quantity_content',
			[
				'label' => esc_html__('Quantity', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'quantity_typography',
				'selector' => '{{WRAPPER}} .topppa-quantity-wrapper',
			]
		);

		$this->add_responsive_control(
			'quantity_color',
			[
				'label'     => esc_html__('Color', 'topper-pack'),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .topppa-quantity-wrapper' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_responsive_control(
			'quantity_margin',
			[
				'label'      => esc_html__('Margin', 'topper-pack'),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors'  => [
					'{{WRAPPER}} .topppa-quantity-wrapper' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'quantity_padding',
			[
				'label'      => esc_html__('Padding', 'topper-pack'),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors'  => [
					'{{WRAPPER}} .topppa-quantity-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
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
	 * Render product add to cart button widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();

		// Check if WooCommerce is active
		if (!class_exists('WooCommerce')) {
			echo '<div class="elementor-alert elementor-alert-warning">';
			echo esc_html__('WooCommerce is not installed. Please install and activate WooCommerce to use this widget.', 'topper-pack');
			echo '</div>';
			return;
		}

		// Check if we're in theme builder
		$is_theme_builder = \Elementor\Plugin::$instance->editor->is_edit_mode();

		// Button text
		$button_text = $settings['button_text'] ? $settings['button_text'] : esc_html__('Add to Cart', 'topper-pack');

		// Render the form with quantity selector and product options
		echo '<div class="topppa-add-to-cart-with-options topppa-btn-wrapper">';

		// Always show the same structure for consistency between editor and frontend
		$product_id = '';
		$product = null;

		if (!$is_theme_builder) {
			// Get product ID
			if (!empty($settings['use_selected_product']) && !empty($settings['selected_product'])) {
				$product_id = $settings['selected_product'];
			} elseif (is_product()) {
				global $product;
				if ($product) {
					$product_id = $product->get_id();
				}
			}
		}

		// Use dummy product in theme builder or when no product is available
		if ($is_theme_builder || !$product_id) {
			// Create a dummy product for theme builder
			if (!class_exists('WC_Product')) {
				echo '<div class="elementor-alert elementor-alert-warning">';
				echo esc_html__('WooCommerce is not installed. Please install and activate WooCommerce to use this widget.', 'topper-pack');
				echo '</div>';
				return;
			}

			$product = new WC_Product();
			$product->set_name('Dummy Product');
			$product->set_price(10);
			$product->set_id(0);
			$product_id = 0;
		} else {
			$product = wc_get_product($product_id);
			if (!$product) {
				echo '<div class="elementor-alert elementor-alert-warning">';
				echo esc_html__('Invalid product selected.', 'topper-pack');
				echo '</div>';
				return;
			}
		}

		if ($product->is_type('variable')) {
			// Variable product
			$attributes = $product->get_variation_attributes();
			$available_variations = $product->get_available_variations();
			$default_attributes = $product->get_default_attributes();

			echo '<form class="variations_form cart" method="post" enctype="multipart/form-data" data-product_id="' . absint($product->get_id()) . '" data-product_variations="' . htmlspecialchars(wp_json_encode($available_variations)) . '">'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

			// Variations dropdown
			foreach ($attributes as $attribute_name => $options) {
				$attribute_label = wc_attribute_label($attribute_name);
				$attribute_id = wc_attribute_taxonomy_id_by_name($attribute_name);
				$attribute_taxonomy = $attribute_id ? wc_get_attribute($attribute_id) : null;

				echo '<div class="variations">';
				echo '<label for="' . esc_attr(sanitize_title($attribute_name)) . '">' . esc_html($attribute_label) . '</label>';
				echo '<select id="' . esc_attr(sanitize_title($attribute_name)) . '" 
							 name="attribute_' . esc_attr(sanitize_title($attribute_name)) . '" 
							 data-attribute_name="attribute_' . esc_attr(sanitize_title($attribute_name)) . '">';
				echo '<option value="">' . esc_html__('Choose an option', 'topper-pack') . '</option>';

				if ($attribute_taxonomy) {
					$terms = wc_get_product_terms($product->get_id(), $attribute_name, array('fields' => 'all'));
					foreach ($terms as $term) {
						$selected = isset($default_attributes[$attribute_name]) && $default_attributes[$attribute_name] === $term->slug ? 'selected' : '';
						echo '<option value="' . esc_attr($term->slug) . '" ' . $selected . '>' . esc_html(apply_filters('woocommerce_variation_option_name', $term->name)) . '</option>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
					}
				} else {
					foreach ($options as $option) {
						$selected = isset($default_attributes[$attribute_name]) && $default_attributes[$attribute_name] === $option ? 'selected' : '';
						echo '<option value="' . esc_attr($option) . '" ' . $selected . '>' . esc_html(apply_filters('woocommerce_variation_option_name', $option)) . '</option>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
					}
				}
				echo '</select>';
				echo '</div>';
			}

			// Reset variations link
			echo '<div class="reset_variations">';
			echo '<a class="reset_variations" href="#">' . esc_html__('Clear', 'topper-pack') . '</a>';
			echo '</div>';

			// Check if product has a price
			$product_price = $product->get_price();
			$has_price = is_numeric($product_price) && (float) $product_price > 0;

			// Display total price if enabled and product has a price
			if ($settings['show_total_price'] === 'yes' && $has_price) {
				$format = !empty($settings['total_price_format']) ? $settings['total_price_format'] : 'x{quantity} = {total}';
				$price = is_numeric($product_price) ? (float) $product_price : 0;
				$quantity = 1;
				$total = $price * $quantity;

				// Format price using WooCommerce formatting
				$formatted_price = wc_price($price);
				$formatted_total = wc_price($total);

				echo '<div class="topppa-total-price" data-price="' . esc_attr($product_price) . '" data-format="' . esc_attr($format) . '">';

				// Format based on selected format
				switch ($format) {
					case 'x{quantity} = {total}':
						echo '<span class="topppa-quantity-wrapper">x' . esc_html($quantity) . '</span>';
						echo '<span class="topppa-price-wrapper">' . wp_kses_post($formatted_total) . '</span>';
						break;
					case '{quantity} x {price} = {total}':
						echo '<span class="topppa-quantity-wrapper">' . esc_html($quantity) . ' x ' . wp_kses_post($formatted_price) . '</span>';
						echo '<span class="topppa-price-wrapper">= ' . wp_kses_post($formatted_total) . '</span>';
						break;
					case '{total}':
						echo '<span class="topppa-price-wrapper">' . wp_kses_post($formatted_total) . '</span>';
						break;
					case '{title}: x{quantity} = {total}':
						// For the title format, we don't need to update the title text as it's already set
						// Just update the quantity and price
						$totalElement . find('.topppa-quantity-wrapper') . text('x' + quantity);
						$totalElement . find('.topppa-price-wrapper') . html(formattedTotal);
						break;
				}

				echo '</div>';
			}

			// Show quantity input and cart button only if product has a price
			if ($has_price) {
				// Quantity input and cart button wrapper
				echo '<div class="topppa-quantity-cart-wrapper">';
				echo '<div class="quantity">';
				echo '<label class="screen-reader-text" for="quantity_' . esc_attr($product_id) . '">' . esc_html__('Quantity', 'topper-pack') . '</label>';
				echo '<input type="number" id="quantity_' . esc_attr($product_id) . '" class="input-text qty text topppa-quantity-input" name="quantity" value="1" min="1" data-product-price="' . esc_attr($product_price) . '" />';
				echo '</div>';

				// Add to Cart button
				echo '<button type="submit" class="topppa-add-to-cart-button button alt toppa-btn">' . esc_html($button_text) . '</button>';
				echo '</div>';

				echo '<input type="hidden" name="add-to-cart" value="' . absint($product->get_id()) . '" />';
				echo '<input type="hidden" name="product_id" value="' . absint($product->get_id()) . '" />';
				echo '<input type="hidden" name="variation_id" class="variation_id" value="0" />';
			}

			// Enqueue WooCommerce variation script
			wp_enqueue_script('wc-add-to-cart-variation');

			// Add custom script to handle variation selection
?>
			<script type="text/javascript">
				jQuery(document).ready(function($) {
					var $form = $('.variations_form');

					// Initialize variation form
					$form.wc_variation_form();

					// Handle variation selection
					$form.on('woocommerce_variation_has_changed', function() {
						var variation_id = $form.find('input[name="variation_id"]').val();
						if (variation_id) {
							$form.find('.topppa-add-to-cart-button').prop('disabled', false);
						} else {
							$form.find('.topppa-add-to-cart-button').prop('disabled', true);
						}
					});

					// Initial state
					$form.find('.topppa-add-to-cart-button').prop('disabled', true);
				});

				// Handle quantity changes for variable products
				$('.variations_form .topppa-quantity-input').on('input change', function() {
					var $input = $(this);
					var quantity = parseInt($input.val()) || 1;
					var price = parseFloat($input.data('product-price')) || 0;
					var $totalElement = $input.closest('.topppa-add-to-cart-with-options').find('.topppa-total-price');
					var format = $totalElement.data('format') || 'x{quantity} = {total}';

					// Calculate total
					var total = quantity * price;

					// Check if price is valid before calculation
					if (isNaN(price) || price <= 0) {
						total = 0;
					}

					// Format price using WooCommerce format
					var formattedTotal = '<span class="woocommerce-Price-amount amount"><bdi>' + total.toFixed(2) + '<span class="woocommerce-Price-currencySymbol"><?php echo esc_js(get_woocommerce_currency_symbol()); ?></span></bdi></span>';

					// Update quantity and price wrappers based on format
					switch (format) {
						case 'x{quantity} = {total}':
							$totalElement.find('.topppa-quantity-wrapper').text('x' + quantity);
							$totalElement.find('.topppa-price-wrapper').html(formattedTotal);
							break;
						case '{quantity} x {price} = {total}':
							var formattedPrice = '<span class="woocommerce-Price-amount amount"><bdi>' + price.toFixed(2) + '<span class="woocommerce-Price-currencySymbol"><?php echo esc_js(get_woocommerce_currency_symbol()); ?></span></bdi></span>';
							// Check if price is valid before formatting
							if (isNaN(price) || price <= 0) {
								formattedPrice = '';
							}
							$totalElement.find('.topppa-quantity-wrapper').html(quantity + ' x ' + formattedPrice);
							$totalElement.find('.topppa-price-wrapper').html('= ' + formattedTotal);
							break;
						case '{total}':
							$totalElement.html(formattedTotal);
							break;
						case '{title}: x{quantity} = {total}':
							$totalElement.find('.topppa-price-title-wrapper').text($totalElement.closest('.topppa-add-to-cart-with-options').find('.topppa-product-title').text());
							$totalElement.find('.topppa-quantity-wrapper').text('x' + quantity);
							$totalElement.find('.topppa-price-wrapper').html(formattedTotal);
							break;
					}
				});
			</script>
		<?php
		} else {
			// Simple product
			echo '<form class="cart" method="post" enctype="multipart/form-data">';

			// Check if product has a price
			$product_price = $product->get_price();
			$has_price = is_numeric($product_price) && (float) $product_price > 0;

			// Display total price if enabled and product has a price
			if ($settings['show_total_price'] === 'yes' && $has_price) {
				$format = !empty($settings['total_price_format']) ? $settings['total_price_format'] : 'x{quantity} = {total}';
				$price = is_numeric($product_price) ? (float) $product_price : 0;
				$quantity = 1;
				$total = $price * $quantity;

				// Format price using WooCommerce formatting
				$formatted_price = wc_price($price);
				$formatted_total = wc_price($total);

				echo '<div class="topppa-total-price" data-price="' . esc_attr($product_price) . '" data-format="' . esc_attr($format) . '">';

				// Format based on selected format
				switch ($format) {
					case 'x{quantity} = {total}':
						echo '<span class="topppa-quantity-wrapper">x' . esc_html($quantity) . '</span>';
						echo '<span class="topppa-price-wrapper">' . wp_kses_post($formatted_total) . '</span>';
						break;
					case '{quantity} x {price} = {total}':
						echo '<span class="topppa-quantity-wrapper">' . esc_html($quantity) . ' x ' . wp_kses_post($formatted_price) . '</span>';
						echo '<span class="topppa-price-wrapper">= ' . wp_kses_post($formatted_total) . '</span>';
						break;
					case '{total}':
						echo '<span class="topppa-price-wrapper">' . wp_kses_post($formatted_total) . '</span>';
						break;
					case '{title}: x{quantity} = {total}':
						echo '<div class="topppa-price-title-wrapper">' . esc_html($product->get_name()) . '</div>';
						echo '<div class="topppa-price-quantity-container">';
						echo '<span class="topppa-quantity-wrapper">x' . esc_html($quantity) . '</span>';
						echo '<span class="topppa-price-wrapper">' . wp_kses_post($formatted_total) . '</span>';
						echo '</div>';
						break;
				}

				echo '</div>';
			}

			// Show quantity input and cart button only if product has a price
			if ($has_price) {
				// Quantity input and cart button wrapper
				echo '<div class="topppa-quantity-cart-wrapper">';
				echo '<div class="quantity">';
				echo '<label class="screen-reader-text" for="quantity_' . esc_attr($product_id) . '">' . esc_html__('Quantity', 'topper-pack') . '</label>';
				echo '<input type="number" id="quantity_' . esc_attr($product_id) . '" class="input-text qty text topppa-quantity-input" name="quantity" value="1" min="1" data-product-price="' . esc_attr($product_price) . '" />';
				echo '</div>';

				echo '<button type="submit" name="add-to-cart" value="' . esc_attr($product_id) . '" class="topppa-add-to-cart-button button alt toppa-btn">' . esc_html($button_text) . '</button>';
				echo '</div>';
			}

			echo '</form>';
		}

		echo '</div>';

		// Add JavaScript for dynamic price calculation
		if ($settings['show_total_price'] === 'yes') {
		?>
			<script type="text/javascript">
				jQuery(document).ready(function($) {
					// Handle quantity changes
					$('.topppa-quantity-input').on('input change', function() {
						var $input = $(this);
						var quantity = parseInt($input.val()) || 1;
						var price = parseFloat($input.data('product-price')) || 0;
						var $totalElement = $input.closest('.topppa-add-to-cart-with-options').find('.topppa-total-price');
						var format = $totalElement.data('format') || 'x{quantity} = {total}';

						// Calculate total
						var total = quantity * price;

						// Check if price is valid before calculation
						if (isNaN(price) || price <= 0) {
							total = 0;
						}

						// Format price using WooCommerce format
						var formattedTotal = '<span class="woocommerce-Price-amount amount"><bdi>' + total.toFixed(2) + '<span class="woocommerce-Price-currencySymbol"><?php echo esc_js(get_woocommerce_currency_symbol()); ?></span></bdi></span>';

						// Update quantity and price wrappers based on format
						switch (format) {
							case 'x{quantity} = {total}':
								$totalElement.find('.topppa-quantity-wrapper').text('x' + quantity);
								$totalElement.find('.topppa-price-wrapper').html(formattedTotal);
								break;
							case '{quantity} x {price} = {total}':
								var formattedPrice = '<span class="woocommerce-Price-amount amount"><bdi>' + price.toFixed(2) + '<span class="woocommerce-Price-currencySymbol"><?php echo esc_js(get_woocommerce_currency_symbol()); ?></span></bdi></span>';
								// Check if price is valid before formatting
								if (isNaN(price) || price <= 0) {
									formattedPrice = '';
								}
								$totalElement.find('.topppa-quantity-wrapper').html(quantity + ' x ' + formattedPrice);
								$totalElement.find('.topppa-price-wrapper').html('= ' + formattedTotal);
								break;
							case '{total}':
								$totalElement.html(formattedTotal);
								break;
							case '{title}: x{quantity} = {total}':
								// For the title format, we don't need to update the title text as it's already set
								// Just update the quantity and price
								$totalElement.find('.topppa-quantity-wrapper').text('x' + quantity);
								$totalElement.find('.topppa-price-wrapper').html(formattedTotal);
								break;
						}
					});
				});
			</script>
<?php
		}
	}
}
