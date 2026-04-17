<?php

use \TopperPack\Includes\Controls\Controls_Manager as TopperPack_Controls_Manager;
use Elementor\Controls_Manager;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

/**
 * Elementor WooCommerce Cart Widget.
 *
 * Elementor widget that displays the WooCommerce cart using the [woocommerce_cart] shortcode
 * or a custom shortcode provided by the user.
 *
 * @since 1.0.0
 */
class TOPPPA_Product_Cart_Page_Widget extends \Elementor\Widget_Base {

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
        return 'woocommerce_cart_widget';
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
        return TOPPPA_EPWB .  esc_html__('WooCommerce Cart', 'topper-pack');
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
        return ['woocommerce-elements'];
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
		return 'https://doc.topperpack.com/docs/woocommerce-widgets/cart-page/';
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
        return ['woocommerce', 'cart', 'checkout', 'shop', 'topppa', 'topperpack'];
    }

    /**
     * Register widget controls.
     *
     * Add input fields to allow the user to customize the widget settings.
     *
     * @since 1.0.0
     * @access protected
     */
    protected function register_controls() {
        // Start the content section
        $this->start_controls_section(
            'section_content',
            [
                'label' => esc_html__('Content', 'topper-pack'),
            ]
        );
        $this->add_control(
            'use_custom_shortcode',
            [
                'label' => esc_html__('Use Custom Shortcode?', 'topper-pack'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'topper-pack'),
                'label_off' => esc_html__('No', 'topper-pack'),
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );
        $this->add_control(
            'custom_shortcode',
            [
                'label' => esc_html__('Custom Shortcode', 'topper-pack'),
                'type' => Controls_Manager::TEXT,
                'default' => '',
                'placeholder' => esc_html__('Enter your custom shortcode here', 'topper-pack'),
                'condition' => [
                    'use_custom_shortcode' => 'yes',
                ],
            ]
        );
        $this->end_controls_section();

        // <==========>
        // <==========> BOX STYLES <==========>

        $this->start_controls_section(
            'box_styles',
            [
                'label' => esc_html__('Main Box', 'topper-pack'),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
                'condition' => [
                    'use_custom_shortcode!' => 'yes'
                ]
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'box_bg',
                'label' => esc_html__('Background', 'topper-pack'),
                'types' => ['classic', 'gradient', 'video'],
                'selector' => '{{WRAPPER}} table.shop_table.shop_table_responsive.cart.woocommerce-cart-form__contents',
            ]
        );
        $this->add_responsive_control(
            'box_color',
            [
                'label' => esc_html__('Default Border Color', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .woocommerce-cart-form tbody,
                    .woocommerce-cart-form td,
                    .woocommerce-cart-form tfoot,
                    .woocommerce-cart-form th,
                    .woocommerce-cart-form thead,
                    .woocommerce-cart-form tr,
                    .cart-collaterals td,
                    .cart-collaterals tfoot,
                    .cart-collaterals th,
                    .cart-collaterals tr,
                    .cart-collaterals thead,
                    .woocommerce-cart-form tbody,
                    .woocommerce table.shop_table' => 'border-color: {{VALUE}} !important',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'box_border',
                'label' => esc_html__('Border', 'topper-pack'),
                'selector' => '{{WRAPPER}} .woocommerce-cart-form tbody,
                    .woocommerce-cart-form td,
                    .woocommerce-cart-form tfoot,
                    .woocommerce-cart-form th,
                    .woocommerce-cart-form thead,
                    .cart-collaterals td,
                    .cart-collaterals tfoot,
                    .cart-collaterals th,
                    .cart-collaterals tr,
                    .cart-collaterals thead,
                    .woocommerce-cart-form tr',
            ]
        );
        $this->add_responsive_control(
            'box_radius',
            [
                'label' => esc_html__('Border Radius', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} table.shop_table.shop_table_responsive.cart.woocommerce-cart-form__contents, table.shop_table.shop_table_responsive' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'box_shadow',
                'label' => esc_html__('Box Shadow', 'topper-pack'),
                'selector' => '{{WRAPPER}} table.shop_table.shop_table_responsive.cart.woocommerce-cart-form__contents, table.shop_table.shop_table_responsive',
            ]
        );
        $this->end_controls_section();

        // <==========>
        // <==========> LABELS STYLES <==========>

        $this->start_controls_section(
            'product_labels_styles',
            [
                'label' => esc_html__('Top Labels', 'topper-pack'),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
                'condition' => [
                    'use_custom_shortcode!' => 'yes'
                ]
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'product_labels_typo',
                'selector' => '{{WRAPPER}} table.shop_table.shop_table_responsive.cart.woocommerce-cart-form__contents .product-name,
                                table.shop_table.shop_table_responsive.cart.woocommerce-cart-form__contents .product-price,
                                table.shop_table.shop_table_responsive.cart.woocommerce-cart-form__contents .product-quantity,
                                table.shop_table.shop_table_responsive.cart.woocommerce-cart-form__contents .product-subtotal',
            ]
        );
        $this->add_responsive_control(
            'product_labels_color',
            [
                'label'     => esc_html__('Color', 'topper-pack'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} table.shop_table.shop_table_responsive.cart.woocommerce-cart-form__contents .product-name,
                        table.shop_table.shop_table_responsive.cart.woocommerce-cart-form__contents .product-price,
                        table.shop_table.shop_table_responsive.cart.woocommerce-cart-form__contents .product-quantity,
                        table.shop_table.shop_table_responsive.cart.woocommerce-cart-form__contents .product-subtotal' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_responsive_control(
            'product_labels_margin',
            [
                'label'      => esc_html__('Margin', 'topper-pack'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} table.shop_table.shop_table_responsive.cart.woocommerce-cart-form__contents thead th' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'product_labels_padding',
            [
                'label'      => esc_html__('Padding', 'topper-pack'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} table.shop_table.shop_table_responsive.cart.woocommerce-cart-form__contents thead th' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();

        // <==========>
        // <==========> IMAGE STYLES <==========>

        $this->start_controls_section(
            'cart_img_style',
            [
                'label' => esc_html__('Product Thumbnail', 'topper-pack'),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
                'condition' => [
                    'use_custom_shortcode!' => 'yes'
                ]
            ]
        );
        $this->add_responsive_control(
            'cart_img_height',
            [
                'label'      => esc_html__('Height', 'topper-pack'),
                'type'       => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'custom'],
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
                'selectors'  => [
                    '{{WRAPPER}} .woocommerce-cart-form__cart-item.cart_item .product-thumbnail img' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'cart_img_width',
            [
                'label'      => esc_html__('Width', 'topper-pack'),
                'type'       => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'custom'],
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
                'selectors'  => [
                    '{{WRAPPER}} .woocommerce-cart-form__cart-item.cart_item .product-thumbnail img' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'cart_img_object',
            [
                'label' => esc_html__('Object Fit', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'cover',
                'options' => [
                    'fill'  => esc_html__('Fill', 'topper-pack'),
                    'contain' => esc_html__('Contain', 'topper-pack'),
                    'cover' => esc_html__('Cover', 'topper-pack'),
                    'none' => esc_html__('None', 'topper-pack'),
                ],
                'selectors' => [
                    '{{WRAPPER}} .woocommerce-cart-form__cart-item.cart_item .product-thumbnail img' => 'object-fit: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name'     => 'cart_img_border',
                'label'    => esc_html__('Border', 'topper-pack'),
                'selector' => '{{WRAPPER}} .woocommerce-cart-form__cart-item.cart_item .product-thumbnail img',
            ]
        );
        $this->add_responsive_control(
            'cart_img_border_radius',
            [
                'label'      => esc_html__('Border Radius', 'topper-pack'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .woocommerce-cart-form__cart-item.cart_item .product-thumbnail img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'cart_img_shadow',
                'selector' => '{{WRAPPER}} .woocommerce-cart-form__cart-item.cart_item .product-thumbnail img',
            ]
        );
        $this->add_responsive_control(
            'cart_img_margin',
            [
                'label'      => esc_html__('Margin', 'topper-pack'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .woocommerce-cart-form__cart-item.cart_item .product-thumbnail' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'cart_img_padding',
            [
                'label'      => esc_html__('Padding', 'topper-pack'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .woocommerce-cart-form__cart-item.cart_item .product-thumbnail' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();

        // <==========>
        // <==========> TITLE STYLES <==========>

        $this->start_controls_section(
            'title_styles',
            [
                'label' => esc_html__('Product Title', 'topper-pack'),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
                'condition' => [
                    'use_custom_shortcode!' => 'yes'
                ]
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'title_typo',
                'selector' => '{{WRAPPER}} .woocommerce-cart-form__cart-item.cart_item .product-name a',
            ]
        );
        $this->add_responsive_control(
            'title_color',
            [
                'label'     => esc_html__('Color', 'topper-pack'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .woocommerce-cart-form__cart-item.cart_item .product-name a' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_responsive_control(
            'title_hcolor',
            [
                'label'     => esc_html__('Hover Color', 'topper-pack'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .woocommerce-cart-form__cart-item.cart_item .product-name a:hover' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_responsive_control(
            'title_margin',
            [
                'label'      => esc_html__('Margin', 'topper-pack'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .woocommerce-cart-form__cart-item.cart_item .product-name a' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'title_padding',
            [
                'label'      => esc_html__('Padding', 'topper-pack'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .woocommerce-cart-form__cart-item.cart_item .product-name a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();

        // <==========>
        // <==========> SINGLE PRODUCT PRICE STYLES <==========>

        $this->start_controls_section(
            'single_product_price_styles',
            [
                'label' => esc_html__('Single Product Price', 'topper-pack'),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
                'condition' => [
                    'use_custom_shortcode!' => 'yes'
                ]
            ]
        );
        $this->start_controls_tabs(
            'single_product_price_tabs'
        );

        $this->start_controls_tab(
            'single_product_price_normal_tab',
            [
                'label' => esc_html__('Price', 'topper-pack'),
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'price_typo',
                'selector' => '{{WRAPPER}} .woocommerce-cart-form__cart-item.cart_item .product-price',
            ]
        );
        $this->add_responsive_control(
            'price_color',
            [
                'label'     => esc_html__('Color', 'topper-pack'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .woocommerce-cart-form__cart-item.cart_item .product-price' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_responsive_control(
            'price_margin',
            [
                'label'      => esc_html__('Margin', 'topper-pack'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .woocommerce-cart-form__cart-item.cart_item .product-price' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'price_padding',
            [
                'label'      => esc_html__('Padding', 'topper-pack'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .woocommerce-cart-form__cart-item.cart_item .product-price' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_tab();

        $this->start_controls_tab(
            'single_product_price_subtotal_tab',
            [
                'label' => esc_html__('Subtotal', 'topper-pack'),
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'subtotal_price_typo',
                'selector' => '{{WRAPPER}} .woocommerce-cart-form__cart-item.cart_item .product-subtotal',
            ]
        );
        $this->add_responsive_control(
            'subtotal_price_color',
            [
                'label'     => esc_html__('Color', 'topper-pack'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .woocommerce-cart-form__cart-item.cart_item .product-subtotal' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_responsive_control(
            'subtotal_price_margin',
            [
                'label'      => esc_html__('Margin', 'topper-pack'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .woocommerce-cart-form__cart-item.cart_item .product-subtotal' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'subtotal_price_padding',
            [
                'label'      => esc_html__('Padding', 'topper-pack'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .woocommerce-cart-form__cart-item.cart_item .product-subtotal' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();

        // <==========> QUANTITY INPUT STYLES <==========>
        $this->start_controls_section(
            'topppa_cart_input',
            [
                'label' => __('Quantity Input', 'topper-pack'),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
                'condition' => [
                    'use_custom_shortcode!' => 'yes'
                ]
            ]
        );
        $this->add_responsive_control(
            'topppa_cart_input_height',
            [
                'label'     => __('Height', 'topper-pack'),
                'type'      => \Elementor\Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'max' => 150,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .woocommerce-cart-form__cart-item.cart_item  .quantity .qty'   => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'topppa_cart_input_width',
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
                    '{{WRAPPER}} .woocommerce-cart-form__cart-item.cart_item  .quantity .qty'   => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'topppa_cart_input_bg',
                'types' => ['classic', 'gradient', 'video'],
                'selector' => '{{WRAPPER}} .woocommerce-cart-form__cart-item.cart_item .quantity .qty',
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'topppa_cart_input_typography',
                'selector' => '{{WRAPPER}} .woocommerce-cart-form__cart-item.cart_item  .quantity .qty',
            ]
        );
        $this->add_responsive_control(
            'topppa_cart_input_text_color',
            [
                'label'     => __('Color', 'topper-pack'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .woocommerce-cart-form__cart-item.cart_item  .quantity .qty'   => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'topppa_cart_input_placeholder_color',
            [
                'label'     => __('Placeholder Color', 'topper-pack'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .woocommerce-cart-form__cart-item.cart_item  .quantity .qty::-webkit-input-placeholder'   => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'topppa_cart_input_border',
                'selector' => '{{WRAPPER}} .woocommerce-cart-form__cart-item.cart_item  .quantity .qty',
            ]
        );
        $this->add_responsive_control(
            'topppa_cart_input_border_radius',
            [
                'label'     => __('Border Radius', 'topper-pack'),
                'type'      => \Elementor\Controls_Manager::DIMENSIONS,
                'selectors' => [
                    '{{WRAPPER}} .woocommerce-cart-form__cart-item.cart_item  .quantity .qty'   => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                ],
                'separator' => 'before',
            ]
        );
        $this->add_responsive_control(
            'topppa_cart_input_padding',
            [
                'label'      => __('Padding', 'topper-pack'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .woocommerce-cart-form__cart-item.cart_item  .quantity .qty'   => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'topppa_cart_input_margin',
            [
                'label'      => __('Margin', 'topper-pack'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .woocommerce-cart-form__cart-item.cart_item  .quantity .qty'   => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();

        // <==========>
        // <==========> ICON STYLES <==========>

        $this->start_controls_section(
            'product_remove_button_styles',
            [
                'label' => esc_html__('Proudct Remove Button', 'topper-pack'),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
                'condition' => [
                    'use_custom_shortcode!' => 'yes'
                ]
            ]
        );
        $this->add_responsive_control(
            'product_remove_button_height',
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
                    '{{WRAPPER}} .woocommerce-cart-form__cart-item.cart_item a.remove' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'product_remove_button_width',
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
                    '{{WRAPPER}} .woocommerce-cart-form__cart-item.cart_item a.remove' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'product_remove_button_typo',
                'selector' => '{{WRAPPER}} .woocommerce-cart-form__cart-item.cart_item a.remove',
            ]
        );
        $this->add_responsive_control(
            'product_remove_button_color',
            [
                'label'     => esc_html__('Color', 'topper-pack'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .woocommerce-cart-form__cart-item.cart_item a.remove' => 'color: {{VALUE}} !important',
                ],
            ]
        );
        $this->add_responsive_control(
            'product_remove_button_hcolor',
            [
                'label'     => esc_html__('Hover Color', 'topper-pack'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .woocommerce-cart-form__cart-item.cart_item a.remove:hover' => 'color: {{VALUE}} !important',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'product_remove_button_bg_color',
                'types' => ['classic', 'gradient', 'video'],
                'selector' => '{{WRAPPER}} .woocommerce-cart-form__cart-item.cart_item a.remove',
            ]
        );
        $this->add_responsive_control(
            'product_remove_button_hbg_color',
            [
                'label' => esc_html__('Hover BG', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .woocommerce-cart-form__cart-item.cart_item a.remove:hover' => 'background: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'product_remove_button_border',
                'selector' => '{{WRAPPER}} .woocommerce-cart-form__cart-item.cart_item a.remove',
            ]
        );
        $this->add_responsive_control(
            'product_remove_button_border_radius',
            [
                'label' => esc_html__('Border Radius', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .woocommerce-cart-form__cart-item.cart_item a.remove' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'product_remove_button_box_shadow',
                'selector' => '{{WRAPPER}} .woocommerce-cart-form__cart-item.cart_item a.remove',
            ]
        );
        $this->add_responsive_control(
            'product_remove_button_margin',
            [
                'label'      => esc_html__('Margin', 'topper-pack'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .woocommerce-cart-form__cart-item.cart_item a.remove' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'product_remove_button_padding',
            [
                'label'      => esc_html__('Padding', 'topper-pack'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .woocommerce-cart-form__cart-item.cart_item a.remove' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();

        $this->start_controls_section(
            'coupon_styles',
            [
                'label' => esc_html__('Coupon', 'topper-pack'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                'condition' => [
                    'use_custom_shortcode!' => 'yes'
                ]
            ]
        );
        $this->start_controls_tabs(
            'coupon_tabs'
        );

        $this->start_controls_tab(
            'coupon_normal_tab',
            [
                'label' => esc_html__('Input', 'topper-pack'),
            ]
        );
        $this->add_responsive_control(
            'coupon_input_height',
            [
                'label'     => __('Height', 'topper-pack'),
                'type'      => \Elementor\Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'max' => 150,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} table.shop_table.shop_table_responsive.cart.woocommerce-cart-form__contents input#coupon_code'   => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'coupon_input_width',
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
                    '{{WRAPPER}} table.shop_table.shop_table_responsive.cart.woocommerce-cart-form__contents input#coupon_code'   => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'coupon_input_bg',
                'types' => ['classic', 'gradient', 'video'],
                'selector' => '{{WRAPPER}} table.shop_table.shop_table_responsive.cart.woocommerce-cart-form__contents input#coupon_code',
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'coupon_input_typography',
                'selector' => '{{WRAPPER}} table.shop_table.shop_table_responsive.cart.woocommerce-cart-form__contents input#coupon_code',
            ]
        );
        $this->add_responsive_control(
            'coupon_input_text_color',
            [
                'label'     => __('Color', 'topper-pack'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} table.shop_table.shop_table_responsive.cart.woocommerce-cart-form__contents input#coupon_code'   => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'coupon_input_placeholder_color',
            [
                'label'     => __('Placeholder Color', 'topper-pack'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} table.shop_table.shop_table_responsive.cart.woocommerce-cart-form__contents input#coupon_code::-webkit-input-placeholder'   => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'coupon_input_border',
                'selector' => '{{WRAPPER}} table.shop_table.shop_table_responsive.cart.woocommerce-cart-form__contents input#coupon_code',
            ]
        );
        $this->add_responsive_control(
            'coupon_input_border_radius',
            [
                'label'     => __('Border Radius', 'topper-pack'),
                'type'      => \Elementor\Controls_Manager::DIMENSIONS,
                'selectors' => [
                    '{{WRAPPER}} table.shop_table.shop_table_responsive.cart.woocommerce-cart-form__contents input#coupon_code'   => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                ],
                'separator' => 'before',
            ]
        );
        $this->add_responsive_control(
            'coupon_input_padding',
            [
                'label'      => __('Padding', 'topper-pack'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} table.shop_table.shop_table_responsive.cart.woocommerce-cart-form__contents input#coupon_code'   => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'coupon_input_margin',
            [
                'label'      => __('Margin', 'topper-pack'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} table.shop_table.shop_table_responsive.cart.woocommerce-cart-form__contents input#coupon_code'   => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_tab();

        $this->start_controls_tab(
            'coupon_hover_tab',
            [
                'label' => esc_html__('Button', 'topper-pack'),
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'coupon_button_typo',
                'selector' => '{{WRAPPER}} table.shop_table.shop_table_responsive.cart.woocommerce-cart-form__contents .actions .coupon button.button.wp-element-button',
            ]
        );

        $this->add_responsive_control(
            'coupon_button_color',
            [
                'label'     => esc_html__('Color', 'topper-pack'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} table.shop_table.shop_table_responsive.cart.woocommerce-cart-form__contents .actions .coupon button.button.wp-element-button' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_responsive_control(
            'coupon_button_hcolor',
            [
                'label'     => esc_html__('Hover Color', 'topper-pack'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} table.shop_table.shop_table_responsive.cart.woocommerce-cart-form__contents .actions .coupon button.button.wp-element-button:hover' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'coupon_button_background',
                'types' => ['classic', 'gradient', 'video'],
                'selector' => '{{WRAPPER}} table.shop_table.shop_table_responsive.cart.woocommerce-cart-form__contents .actions .coupon button.button.wp-element-button',
            ]
        );
        $this->add_responsive_control(
            'coupon_button_hbackground',
            [
                'label' => esc_html__('Hover BG', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} table.shop_table.shop_table_responsive.cart.woocommerce-cart-form__contents .actions .coupon button.button.wp-element-button:hover' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name'     => 'coupon_button_border',
                'label'    => esc_html__('Border', 'topper-pack'),
                'selector' => '{{WRAPPER}} table.shop_table.shop_table_responsive.cart.woocommerce-cart-form__contents .actions .coupon button.button.wp-element-button',
            ]
        );

        $this->add_responsive_control(
            'coupon_button_border_radius',
            [
                'label'      => esc_html__('Border Radius', 'topper-pack'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} table.shop_table.shop_table_responsive.cart.woocommerce-cart-form__contents .actions .coupon button.button.wp-element-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'coupon_button_box_shadow',
                'label'    => esc_html__('Shadow', 'topper-pack'),
                'selector' => '{{WRAPPER}} table.shop_table.shop_table_responsive.cart.woocommerce-cart-form__contents .actions .coupon button.button.wp-element-button',
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();

        $this->start_controls_section(
            'cart_update_button',
            [
                'label' => esc_html__('Update Button', 'topper-pack'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                'condition' => [
                    'use_custom_shortcode!' => 'yes'
                ]
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'update_button_typo',
                'selector' => '{{WRAPPER}} table.shop_table.shop_table_responsive.cart.woocommerce-cart-form__contents .actions .coupon button.button.wp-element-button',
            ]
        );

        $this->add_responsive_control(
            'update_button_color',
            [
                'label'     => esc_html__('Color', 'topper-pack'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} table.shop_table.shop_table_responsive.cart.woocommerce-cart-form__contents .actions>button.button.wp-element-button' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_responsive_control(
            'update_button_hcolor',
            [
                'label'     => esc_html__('Hover Color', 'topper-pack'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} table.shop_table.shop_table_responsive.cart.woocommerce-cart-form__contents .actions>button.button.wp-element-button:hover' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'update_button_background',
                'types' => ['classic', 'gradient', 'video'],
                'selector' => '{{WRAPPER}} table.shop_table.shop_table_responsive.cart.woocommerce-cart-form__contents .actions>button.button.wp-element-button',
            ]
        );
        $this->add_responsive_control(
            'update_button_hbackground',
            [
                'label' => esc_html__('Hover BG', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} table.shop_table.shop_table_responsive.cart.woocommerce-cart-form__contents .actions>button.button.wp-element-button:hover' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name'     => 'update_button_border',
                'label'    => esc_html__('Border', 'topper-pack'),
                'selector' => '{{WRAPPER}} table.shop_table.shop_table_responsive.cart.woocommerce-cart-form__contents .actions>button.button.wp-element-button',
            ]
        );

        $this->add_responsive_control(
            'update_button_border_radius',
            [
                'label'      => esc_html__('Border Radius', 'topper-pack'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} table.shop_table.shop_table_responsive.cart.woocommerce-cart-form__contents .actions>button.button.wp-element-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'update_button_box_shadow',
                'label'    => esc_html__('Shadow', 'topper-pack'),
                'selector' => '{{WRAPPER}} table.shop_table.shop_table_responsive.cart.woocommerce-cart-form__contents .actions>button.button.wp-element-button',
            ]
        );
        $this->end_controls_section();

        // <==========>
        // <==========> BOX STYLES <==========>

        $this->start_controls_section(
            'total_box_styles',
            [
                'label' => esc_html__('Total Box', 'topper-pack'),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
                'condition' => [
                    'use_custom_shortcode!' => 'yes'
                ]
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'total_box_bg',
                'label' => esc_html__('Background', 'topper-pack'),
                'types' => ['classic', 'gradient', 'video'],
                'selector' => '{{WRAPPER}} .cart-collaterals',
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'total_box_border',
                'label' => esc_html__('Border', 'topper-pack'),
                'selector' => '{{WRAPPER}} .cart-collaterals',
            ]
        );
        $this->add_responsive_control(
            'total_box_radius',
            [
                'label' => esc_html__('Border Radius', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .cart-collaterals' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_box_Shadow::get_type(),
            [
                'name' => 'total_box_shadow',
                'label' => esc_html__('Box Shadow', 'topper-pack'),
                'selector' => '{{WRAPPER}} .cart-collaterals',
            ]
        );
        $this->add_responsive_control(
            'total_box_margin',
            [
                'label' => esc_html__('Margin', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .cart-collaterals' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'total_box_padding',
            [
                'label' => esc_html__('Padding', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .cart-collaterals' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();

        // <==========>
        // <==========> TOTAL STYLES <==========>
        $this->start_controls_section(
            'total_content',
            [
                'label' => esc_html__('Total Content', 'topper-pack'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                'condition' => [
                    'use_custom_shortcode!' => 'yes'
                ]
            ]
        );
        $this->start_controls_tabs(
            'total_content_tabs'
        );

        $this->start_controls_tab(
            'total_content_subtotal_tab',
            [
                'label' => esc_html__('Sub Total', 'topper-pack'),
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'total_content_subtotal_typo',
                'selector' => '{{WRAPPER}} .cart_totals .shop_table .cart-subtotal th',
            ]
        );
        $this->add_responsive_control(
            'total_content_subtotal_color',
            [
                'label'     => esc_html__('Color', 'topper-pack'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .cart_totals .shop_table .cart-subtotal th' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'sbtotal_price',
            [
                'label' => esc_html__('Subtotal Amount', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'total_content_total_typo',
                'selector' => '{{WRAPPER}} .cart_totals .shop_table .cart-subtotal td span.woocommerce-Price-amount.amount',
            ]
        );
        $this->add_responsive_control(
            'total_content_total_color',
            [
                'label'     => esc_html__('Color', 'topper-pack'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .cart_totals .shop_table .cart-subtotal td span.woocommerce-Price-amount.amount' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_responsive_control(
            'total_content_total_margin',
            [
                'label'      => esc_html__('Margin', 'topper-pack'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .cart_totals .shop_table .cart-subtotal th' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'total_content_total_padding',
            [
                'label'      => esc_html__('Padding', 'topper-pack'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .cart_totals .shop_table .cart-subtotal th' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_tab();

        $this->start_controls_tab(
            'total_label_tab',
            [
                'label' => esc_html__('Total', 'topper-pack'),
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'total_label_typo',
                'selector' => '{{WRAPPER}} .cart_totals .shop_table .order-total th',
            ]
        );
        $this->add_responsive_control(
            'total_label_color',
            [
                'label'     => esc_html__('Color', 'topper-pack'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .cart_totals .shop_table .order-total th' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'total_price',
            [
                'label' => esc_html__('Total Amount', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'total_price_typo',
                'selector' => '{{WRAPPER}} .cart_totals .shop_table .order-total td span.woocommerce-Price-amount.amount',
            ]
        );
        $this->add_responsive_control(
            'total_price_color',
            [
                'label'     => esc_html__('Color', 'topper-pack'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .cart_totals .shop_table .order-total td span.woocommerce-Price-amount.amount' => 'color: {{VALUE}}',
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
                    '{{WRAPPER}} .cart_totals .shop_table .order-total th' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                    '{{WRAPPER}} .cart_totals .shop_table .order-total th' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_tab();

        $this->start_controls_tab(
            'total_content_total_btn_tab',
            [
                'label' => esc_html__('Button', 'topper-pack'),
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'total_content_total_btn_typo',
                'selector' => '{{WRAPPER}} .wc-proceed-to-checkout .checkout-button',
            ]
        );
        $this->add_responsive_control(
            'total_content_total_btn_color',
            [
                'label'     => esc_html__('Color', 'topper-pack'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .wc-proceed-to-checkout .checkout-button' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_responsive_control(
            'total_content_total_btn_hcolor',
            [
                'label'     => esc_html__('Hover Color', 'topper-pack'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .wc-proceed-to-checkout .checkout-button:hover' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'total_content_total_btn_background',
                'types' => ['classic', 'gradient', 'video'],
                'selector' => '{{WRAPPER}} .wc-proceed-to-checkout .checkout-button',
            ]
        );
        $this->add_responsive_control(
            'total_content_total_btn_hbackground',
            [
                'label' => esc_html__('Hover BG', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .wc-proceed-to-checkout .checkout-button:hover' => 'background-color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name'     => 'total_content_total_btn_border',
                'label'    => esc_html__('Border', 'topper-pack'),
                'selector' => '{{WRAPPER}} .wc-proceed-to-checkout .checkout-button',
            ]
        );
        $this->add_responsive_control(
            'total_content_total_btn_border_radius',
            [
                'label'      => esc_html__('Border Radius', 'topper-pack'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .wc-proceed-to-checkout .checkout-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'total_content_total_btn_box_shadow',
                'label'    => esc_html__('Shadow', 'topper-pack'),
                'selector' => '{{WRAPPER}} .wc-proceed-to-checkout .checkout-button',
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();

        // Empty Cart Message Styles
        $this->start_controls_section(
            'empty_cart_styles',
            [
                'label' => esc_html__('Empty Cart Message', 'topper-pack'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                'condition' => [
                    'use_custom_shortcode!' => 'yes'
                ]
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'empty_cart_typography',
                'selector' => '{{WRAPPER}} .woocommerce-info, {{WRAPPER}} .cart-empty.woocommerce-info',
            ]
        );

        $this->add_responsive_control(
            'empty_cart_color',
            [
                'label' => esc_html__('Text Color', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .woocommerce-info, {{WRAPPER}} .cart-empty.woocommerce-info' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'empty_cart_background',
                'types' => ['classic', 'gradient', 'video'],
                'selector' => '{{WRAPPER}} .woocommerce-info, {{WRAPPER}} .cart-empty.woocommerce-info',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'empty_cart_border',
                'selector' => '{{WRAPPER}} .woocommerce-info, {{WRAPPER}} .cart-empty.woocommerce-info',
            ]
        );

        $this->add_responsive_control(
            'empty_cart_border_radius',
            [
                'label' => esc_html__('Border Radius', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .woocommerce-info, {{WRAPPER}} .cart-empty.woocommerce-info' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'empty_cart_padding',
            [
                'label' => esc_html__('Padding', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .woocommerce-info, {{WRAPPER}} .cart-empty.woocommerce-info' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'empty_cart_margin',
            [
                'label' => esc_html__('Margin', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .woocommerce-info, {{WRAPPER}} .cart-empty.woocommerce-info' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        // Return to Shop Button Styles
        $this->start_controls_section(
            'return_to_shop_styles',
            [
                'label' => esc_html__('Return to Shop Button', 'topper-pack'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                'condition' => [
                    'use_custom_shortcode!' => 'yes'
                ]
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'return_to_shop_typography',
                'selector' => '{{WRAPPER}} .return-to-shop .button',
            ]
        );

        $this->start_controls_tabs('return_to_shop_tabs');

        $this->start_controls_tab(
            'return_to_shop_normal',
            [
                'label' => esc_html__('Normal', 'topper-pack'),
            ]
        );

        $this->add_responsive_control(
            'return_to_shop_color',
            [
                'label' => esc_html__('Text Color', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .return-to-shop .button' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'return_to_shop_background',
                'types' => ['classic', 'gradient', 'video'],
                'selector' => '{{WRAPPER}} .return-to-shop .button',
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'return_to_shop_hover',
            [
                'label' => esc_html__('Hover', 'topper-pack'),
            ]
        );

        $this->add_responsive_control(
            'return_to_shop_hover_color',
            [
                'label' => esc_html__('Text Color', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .return-to-shop .button:hover' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'return_to_shop_hover_background',
                'types' => ['classic', 'gradient', 'video'],
                'selector' => '{{WRAPPER}} .return-to-shop .button:hover',
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'return_to_shop_border',
                'selector' => '{{WRAPPER}} .return-to-shop .button',
                'separator' => 'before',
            ]
        );

        $this->add_responsive_control(
            'return_to_shop_border_radius',
            [
                'label' => esc_html__('Border Radius', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .return-to-shop .button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'return_to_shop_padding',
            [
                'label' => esc_html__('Padding', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .return-to-shop .button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'return_to_shop_margin',
            [
                'label' => esc_html__('Margin', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .return-to-shop .button' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'return_to_shop_box_shadow',
                'selector' => '{{WRAPPER}} .return-to-shop .button',
            ]
        );

        $this->end_controls_section();
    }

    /**
     * Render widget output on the frontend.
     *
     * Written in PHP and used to generate the final HTML.
     *
     * @since 1.0.0
     * @access protected
     */
    protected function render() {
        // Check if WooCommerce is active.
        if (!class_exists('WooCommerce')) {
            echo '<div class="elementor-alert elementor-alert-warning">';
            echo esc_html__('WooCommerce is not installed. Please install and activate WooCommerce to use this widget.', 'topper-pack');
            echo '</div>';
            return;
        }

        // Get widget settings
        $settings = $this->get_settings_for_display();

        // Determine which shortcode to use
        if ('yes' === $settings['use_custom_shortcode'] && !empty($settings['custom_shortcode'])) {
            // Use the custom shortcode provided by the user
            echo do_shortcode($settings['custom_shortcode']);
        } else {
            // Use the default WooCommerce cart shortcode
            echo do_shortcode('[woocommerce_cart]');
        }
    }
}
