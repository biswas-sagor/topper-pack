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
class TOPPPA_Product_Mini_Cart_Button_Widget extends Widget_Base {

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
        return 'topppa_product_mini_cart_button_widget';
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
        return TOPPPA_EPWB . esc_html__('Product Mini Cart Button', 'topper-pack');
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
        return ['product', 'mini cart', 'button', 'woocommerce', 'topppa', 'topperpack', 'cart', 'mini cart button', 'header cart'];
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
        return 'https://doc.topperpack.com/docs/woocommerce-widgets/product-mini-cart-button/';
    }


    protected function register_controls() {
        $this->start_controls_section(
            'content_section',
            [
                'label' => esc_html__('Settings', 'topper-pack'),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_control(
            'cart_icon',
            [
                'label' => esc_html__('Select Icon', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::ICONS,
                'default' => [
                    'value' => 'fas fa-shopping-cart',
                    'library' => 'fa-solid',
                ],
                'recommended' => [
                    'fa-solid' => [
                        'shopping-cart',
                        'shopping-basket',
                        'shopping-bag',
                        'cart-plus',
                        'cart-arrow-down',
                    ],
                ],
                'skin' => 'inline',
                'label_block' => false,
                'exclude_inline_options' => ['svg'],
            ]
        );
        $this->add_control(
            'select_type',
            [
                'label' => esc_html__('Select Type', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'text',
                'options' => [
                    'none' => esc_html__('None', 'topper-pack'),
                    'price' => esc_html__('Price', 'topper-pack'),
                    'text' => esc_html__('Text', 'topper-pack'),
                ],
            ]
        );
        $this->add_control(
            'cart_text',
            [
                'label' => esc_html__('Cart Text', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Cart', 'topper-pack'),
                'condition' => [
                    'select_type' => 'text',
                ],
            ]
        );
        $this->add_control(
            'text_position',
            [
                'label' => esc_html__('Text/Price Position', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'row' => [
                        'title' => esc_html__('Left', 'topper-pack'),
                        'icon' => 'eicon-h-align-left',
                    ],
                    'row-reverse' => [
                        'title' => esc_html__('Right', 'topper-pack'),
                        'icon' => 'eicon-h-align-right',
                    ],
                    'column' => [
                        'title' => esc_html__('Top', 'topper-pack'),
                        'icon' => 'eicon-v-align-top',
                    ],
                    'column-reverse' => [
                        'title' => esc_html__('Bottom', 'topper-pack'),
                        'icon' => 'eicon-v-align-bottom',
                    ],
                ],
                'default' => 'row',
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .topppa-mini-cart-wrapper .topppa-mini-cart-button' => 'flex-direction: {{VALUE}};',
                ],
                'condition' => [
                    'select_type!' => 'none',
                ],
            ]
        );
        $this->add_control(
            'select_content',
            [
                'label' => esc_html__('Select Content', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'dropdown',
                'options' => [
                    'none' => esc_html__('None', 'topper-pack'),
                    'dropdown'  => esc_html__('Dropdown', 'topper-pack'),
                    'sidebar' => esc_html__('Sidebar', 'topper-pack'),
                ],
                'separator' => 'before',
            ]
        );
        $this->add_control(
            'content_action_type',
            [
                'label' => esc_html__('Content Action', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'hover',
                'options' => [
                    'click' => esc_html__('Click', 'topper-pack'),
                    'hover' => esc_html__('Hover', 'topper-pack'),
                ],
                'condition' => [
                    'select_content!' => 'none',
                ],
            ]
        );
        $this->add_control(
            'content_header_title',
            [
                'label' => esc_html__('Static Title', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Shopping Cart', 'topper-pack'),
                'placeholder' => esc_html__('Type your title here', 'topper-pack'),
                'condition' => [
                    'select_content!' => 'none',
                ],
            ]
        );
        $this->end_controls_section();

        /**
         * start style section
         *
         * @since 1.0.0
         * @access protected
         */
        $this->start_controls_section(
            'box_style',
            [
                'label' => esc_html__('Box', 'topper-pack'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->start_controls_tabs(
            'box_style_tabs'
        );

        $this->start_controls_tab(
            'box_style_normal_tab',
            [
                'label' => esc_html__('Normal', 'topper-pack'),
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'box_background',
                'types' => ['classic', 'gradient', 'video'],
                'selector' => '{{WRAPPER}} .topppa-mini-cart-wrapper .topppa-mini-cart-button',
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'box_border',
                'selector' => '{{WRAPPER}} .topppa-mini-cart-wrapper .topppa-mini-cart-button',
            ]
        );
        $this->add_responsive_control(
            'box_radius',
            [
                'label' => esc_html__('Radius', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} .topppa-mini-cart-wrapper .topppa-mini-cart-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'box_shadow',
                'label' => esc_html__('Shadow', 'topper-pack'),
                'selector' => '{{WRAPPER}} .topppa-mini-cart-wrapper .topppa-mini-cart-button',
            ]
        );
        $this->add_responsive_control(
            'box_margin',
            [
                'label' => esc_html__('Margin', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} .topppa-mini-cart-wrapper .topppa-mini-cart-button' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'box_padding',
            [
                'label' => esc_html__('Padding', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} .topppa-mini-cart-wrapper .topppa-mini-cart-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_tab();

        $this->start_controls_tab(
            'box_style_hover_tab',
            [
                'label' => esc_html__('Hover', 'topper-pack'),
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'box_background_hover',
                'types' => ['classic', 'gradient', 'video'],
                'selector' => '{{WRAPPER}} .topppa-mini-cart-wrapper .topppa-mini-cart-button:hover',
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'box_border_hover',
                'selector' => '{{WRAPPER}} .topppa-mini-cart-wrapper .topppa-mini-cart-button:hover',
            ]
        );
        $this->add_responsive_control(
            'box_radius_hover',
            [
                'label' => esc_html__('Radius', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} .topppa-mini-cart-wrapper .topppa-mini-cart-button:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'box_shadow_hover',
                'label' => esc_html__('Shadow', 'topper-pack'),
                'selector' => '{{WRAPPER}} .topppa-mini-cart-wrapper .topppa-mini-cart-button:hover',
            ]
        );
        $this->end_controls_tab();

        $this->end_controls_tabs();
        $this->end_controls_section();

        /**
         * start style section
         *
         * @since 1.0.0
         * @access protected
         */
        $this->start_controls_section(
            'icon_style',
            [
                'label' => esc_html__('Icon', 'topper-pack'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_responsive_control(
            'icon_color',
            [
                'label' => esc_html__('Icon Color', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .topppa-mini-cart-wrapper .topppa-mini-cart-button .topppa-mini-cart-icon' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .topppa-mini-cart-wrapper .topppa-mini-cart-button .topppa-mini-cart-icon svg path' => 'fill: {{VALUE}}',
                ],
            ]
        );
        $this->add_responsive_control(
            'icon_hover_color',
            [
                'label' => esc_html__('Icon Hover Color', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .topppa-mini-cart-wrapper .topppa-mini-cart-button:hover .topppa-mini-cart-icon' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .topppa-mini-cart-wrapper .topppa-mini-cart-button:hover .topppa-mini-cart-icon svg path' => 'fill: {{VALUE}}',
                ],
            ]
        );
        $this->add_responsive_control(
            'icon_size',
            [
                'label' => esc_html__('Icon Size', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', 'em', 'rem', 'custom'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 300,
                        'step' => 1,
                    ]
                ],
                'selectors' => [
                    '{{WRAPPER}} .topppa-mini-cart-wrapper .topppa-mini-cart-button .topppa-mini-cart-icon' => 'font-size: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .topppa-mini-cart-wrapper .topppa-mini-cart-button .topppa-mini-cart-icon svg' => 'width: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .topppa-mini-cart-wrapper .topppa-mini-cart-button .topppa-mini-cart-icon svg' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'icon_gap',
            [
                'label' => esc_html__('Icon Gap', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', 'em', 'rem', 'custom'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 300,
                        'step' => 1,
                    ]
                ],
                'selectors' => [
                    '{{WRAPPER}} .topppa-mini-cart-wrapper .topppa-mini-cart-button' => 'gap: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'icon_margin',
            [
                'label' => esc_html__('Icon Margin', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} .topppa-mini-cart-wrapper .topppa-mini-cart-button .topppa-mini-cart-icon' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'icon_padding',
            [
                'label' => esc_html__('Icon Padding', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} .topppa-mini-cart-wrapper .topppa-mini-cart-button .topppa-mini-cart-icon' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'numner_style_note',
            [
                'label' => esc_html__('Number Style', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->add_responsive_control(
            'number_color',
            [
                'label' => esc_html__('Number Color', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .topppa-mini-cart-wrapper .topppa-mini-cart-button .topppa-mini-cart-count' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_responsive_control(
            'number_hover_color',
            [
                'label' => esc_html__('Number Hover Color', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .topppa-mini-cart-wrapper .topppa-mini-cart-button:hover .topppa-mini-cart-count' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_responsive_control(
            'number_background_color',
            [
                'label' => esc_html__('Number Background Color', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .topppa-mini-cart-wrapper .topppa-mini-cart-button .topppa-mini-cart-count' => 'background-color: {{VALUE}}',
                ],
            ]
        );
        $this->add_responsive_control(
            'number_hover_background_color',
            [
                'label' => esc_html__('Number Hover Background Color', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .topppa-mini-cart-wrapper .topppa-mini-cart-button:hover .topppa-mini-cart-count' => 'background-color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'number_typography',
                'selector' => '{{WRAPPER}} .topppa-mini-cart-wrapper .topppa-mini-cart-button .topppa-mini-cart-count',
            ]
        );
        $this->add_responsive_control(
            'number_radius',
            [
                'label' => esc_html__('Number Radius', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} .topppa-mini-cart-wrapper .topppa-mini-cart-button .topppa-mini-cart-count' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'number_width',
            [
                'label' => esc_html__('Number Width', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
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
                'selectors' => [
                    '{{WRAPPER}} .topppa-mini-cart-wrapper .topppa-mini-cart-button .topppa-mini-cart-count' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'number_height',
            [
                'label' => esc_html__('Number Height', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
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
                'selectors' => [
                    '{{WRAPPER}} .topppa-mini-cart-wrapper .topppa-mini-cart-button .topppa-mini-cart-count' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'number_position_Y',
            [
                'label' => esc_html__('Number Position Y', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'range' => [
                    'px' => [
                        'min' => -330,
                        'max' => 300,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => -100,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .topppa-mini-cart-wrapper .topppa-mini-cart-button .topppa-mini-cart-count' => 'top: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'number_position_X',
            [
                'label' => esc_html__('Number Position X', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'range' => [
                    'px' => [
                        'min' => -300,
                        'max' => 300,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => -100,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .topppa-mini-cart-wrapper .topppa-mini-cart-button .topppa-mini-cart-count' => 'right: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'number_margin',
            [
                'label' => esc_html__('Margin', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} .topppa-mini-cart-wrapper .topppa-mini-cart-button .topppa-mini-cart-count' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'number_padding',
            [
                'label' => esc_html__('Padding', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} .topppa-mini-cart-wrapper .topppa-mini-cart-button .topppa-mini-cart-count' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();

        /**
         * start style section
         *
         * @since 1.0.0
         * @access protected
         */
        $this->start_controls_section(
            'text_price_style_section',
            [
                'label' => esc_html__('Text/Price', 'topper-pack'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                'condition' => [
                    'select_type!' => 'none',
                ],
            ]
        );
        $this->add_responsive_control(
            'text_price_color',
            [
                'label' => esc_html__('Color', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .topppa-mini-cart-button .topppa-mini-cart-text' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .topppa-mini-cart-button .topppa-mini-cart-price' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_responsive_control(
            'text_price_hover_color',
            [
                'label' => esc_html__('Hover Color', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .topppa-mini-cart-wrapper .topppa-mini-cart-button:hover .topppa-mini-cart-text' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .topppa-mini-cart-wrapper .topppa-mini-cart-button:hover .topppa-mini-cart-price' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'text_price_typography',
                'selector' => '{{WRAPPER}} .topppa-mini-cart-button .topppa-mini-cart-text,{{WRAPPER}} .topppa-mini-cart-button .topppa-mini-cart-price',
            ]
        );

        $this->add_responsive_control(
            'text_price_margin',
            [
                'label' => esc_html__('Margin', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} .topppa-mini-cart-button .topppa-mini-cart-text' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .topppa-mini-cart-button .topppa-mini-cart-price' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'text_price_padding',
            [
                'label' => esc_html__('Padding', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} .topppa-mini-cart-button .topppa-mini-cart-text' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .topppa-mini-cart-button .topppa-mini-cart-price' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();

        /**
         * start dropdown style section
         *
         * @since 1.0.0
         * @access protected
         */
        $this->start_controls_section(
            'dropdown_style_box_section',
            [
                'label' => esc_html__('Dropdown Box', 'topper-pack'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                'condition' => [
                    'select_content' => 'dropdown',
                ],

            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'dropdown_box_background',
                'types' => ['classic', 'gradient', 'video'],
                'selector' => '{{WRAPPER}} .topppa-mini-cart-wrapper .topppa-cart-dropdown-wrap',
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'dropdown_box_border',
                'selector' => '{{WRAPPER}} .topppa-mini-cart-wrapper .topppa-cart-dropdown-wrap',
            ]
        );
        $this->add_responsive_control(
            'dropdown_box_radius',
            [
                'label' => esc_html__('Radius', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} .topppa-mini-cart-wrapper .topppa-cart-dropdown-wrap' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'dropdown_box_shadow',
                'selector' => '{{WRAPPER}} .topppa-mini-cart-wrapper .topppa-cart-dropdown-wrap',
            ]
        );
        $this->add_responsive_control(
            'dropdown_box_margin',
            [
                'label' => esc_html__('Margin', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} .topppa-mini-cart-wrapper .topppa-cart-dropdown-wrap' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'dropdown_box_padding',
            [
                'label' => esc_html__('Padding', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} .topppa-mini-cart-wrapper .topppa-cart-dropdown-wrap' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();

        /**
         * start sidebar style section
         *
         * @since 1.0.0
         * @access protected
         */
        $this->start_controls_section(
            'sidebar_style_box_section',
            [
                'label' => esc_html__('Sidebar Box', 'topper-pack'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                'condition' => [
                    'select_content' => 'sidebar',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'sidebar_box_background',
                'types' => ['classic', 'gradient', 'video'],
                'selector' => '{{WRAPPER}} .topppa-mini-cart-wrapper .topppa-mini-cart-sidebar.topppa-show .topppa-mini-cart-content',
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'sidebar_box_border',
                'selector' => '{{WRAPPER}} .topppa-mini-cart-wrapper .topppa-mini-cart-sidebar.topppa-show .topppa-mini-cart-content',
            ]
        );
        $this->add_responsive_control(
            'sidebar_box_radius',
            [
                'label' => esc_html__('Radius', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} .topppa-mini-cart-wrapper .topppa-mini-cart-sidebar.topppa-show .topppa-mini-cart-content' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'sidebar_box_shadow',
                'selector' => '{{WRAPPER}} .topppa-mini-cart-wrapper .topppa-mini-cart-sidebar.topppa-show .topppa-mini-cart-content',
            ]
        );
        $this->add_responsive_control(
            'sidebar_box_margin',
            [
                'label' => esc_html__('Margin', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} .topppa-mini-cart-wrapper .topppa-mini-cart-sidebar.topppa-show .topppa-mini-cart-content' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'sidebar_box_padding',
            [
                'label' => esc_html__('Padding', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} .topppa-mini-cart-wrapper .topppa-mini-cart-sidebar.topppa-show .topppa-mini-cart-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();


        /**
         * start header style section
         *
         * @since 1.0.0
         * @access protected
         */
        $this->start_controls_section(
            'content_header_style_section',
            [
                'label' => esc_html__('Content Header', 'topper-pack'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_responsive_control(
            'content_heading_color',
            [
                'label' => esc_html__('Heading Color', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .topppa-mini-cart-wrapper .topppa-mini-cart-content .topppa-mini-cart-header h4' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'content_heading_typography',
                'selector' => '{{WRAPPER}} .topppa-mini-cart-wrapper .topppa-mini-cart-content .topppa-mini-cart-header h4',
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'content_heading_border',
                'selector' => '{{WRAPPER}} .topppa-mini-cart-wrapper .topppa-mini-cart-content .topppa-mini-cart-header',
            ]
        );
        $this->add_responsive_control(
            'content_heading_margin',
            [
                'label' => esc_html__('Margin', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} .topppa-mini-cart-wrapper .topppa-mini-cart-content .topppa-mini-cart-header h4' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'content_heading_padding',
            [
                'label' => esc_html__('Padding', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} .topppa-mini-cart-wrapper .topppa-mini-cart-content .topppa-mini-cart-header h4' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'content_heading_alignment',
            [
                'label' => esc_html__('Alignment', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'row' => [
                        'title' => esc_html__('Left', 'topper-pack'),
                        'icon' => 'eicon-h-align-left',
                    ],
                    'row-reverse' => [
                        'title' => esc_html__('Right', 'topper-pack'),
                        'icon' => 'eicon-h-align-right',
                    ],
                ],
                'default' => 'row',
                'toggle' => false,
                'selectors' => [
                    '{{WRAPPER}} .topppa-mini-cart-wrapper .topppa-mini-cart-content .topppa-mini-cart-header' => 'flex-direction: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'content_header_close_button_style_section',
            [
                'label' => esc_html__('Close Button', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->add_responsive_control(
            'content_close_button_color',
            [
                'label' => esc_html__('Close Button Color', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .topppa-mini-cart-wrapper .topppa-mini-cart-content .topppa-mini-cart-header .topppa-mini-cart-close' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_responsive_control(
            'content_close_button_hover_color',
            [
                'label' => esc_html__('Close Button Hover Color', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .topppa-mini-cart-wrapper .topppa-mini-cart-content .topppa-mini-cart-header .topppa-mini-cart-close:hover' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_responsive_control(
            'content_close_button_size',
            [
                'label' => esc_html__('Close Button Size', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'separator' => 'after',
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
                'selectors' => [
                    '{{WRAPPER}} .topppa-mini-cart-wrapper .topppa-mini-cart-content .topppa-mini-cart-header .topppa-mini-cart-close' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();
        /**
         * start dropdown items style section
         *
         * @since 1.0.0
         * @access protected
         */
        $this->start_controls_section(
            'content_items_style_section',
            [
                'label' => esc_html__('Content Items', 'topper-pack'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_responsive_control(
            'content_item_margin',
            [
                'label' => esc_html__('Margin', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} .topppa-mini-cart-wrapper .woocommerce-mini-cart.cart_list.product_list_widget.topppa-mini-cart-list .topppa-mini-cart-item' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'content_item_padding',
            [
                'label' => esc_html__('Padding', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} .topppa-mini-cart-wrapper .woocommerce-mini-cart.cart_list.product_list_widget.topppa-mini-cart-list .topppa-mini-cart-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->start_controls_tabs(
            'content_item_style_tabs'
        );

        $this->start_controls_tab(
            'content_item_style_img_tab',
            [
                'label' => esc_html__('Image', 'topper-pack'),
            ]
        );
        $this->add_responsive_control(
            'content_item_img_width',
            [
                'label' => esc_html__('Width', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                        'step' => 1,
                    ]
                ],
                'selectors' => [
                    '{{WRAPPER}} .topppa-mini-cart-wrapper .woocommerce-mini-cart.cart_list.product_list_widget.topppa-mini-cart-list .topppa-mini-cart-item .topppa-mini-cart-item-image' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'content_item_img_height',
            [
                'label' => esc_html__('Height', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                        'step' => 1,
                    ],
                ],
                'separator' => 'after',
                'selectors' => [
                    '{{WRAPPER}} .topppa-mini-cart-wrapper .woocommerce-mini-cart.cart_list.product_list_widget.topppa-mini-cart-list .topppa-mini-cart-item .topppa-mini-cart-item-image' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'content_item_img_border',
                'selector' => '{{WRAPPER}} .topppa-mini-cart-wrapper .woocommerce-mini-cart.cart_list.product_list_widget.topppa-mini-cart-list .topppa-mini-cart-item .topppa-mini-cart-item-image',
            ]
        );
        $this->add_responsive_control(
            'content_item_img_radius',
            [
                'label' => esc_html__('Radius', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} .topppa-mini-cart-wrapper .woocommerce-mini-cart.cart_list.product_list_widget.topppa-mini-cart-list .topppa-mini-cart-item .topppa-mini-cart-item-image' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'content_item_img_shadow',
                'selector' => '{{WRAPPER}} .topppa-mini-cart-wrapper .woocommerce-mini-cart.cart_list.product_list_widget.topppa-mini-cart-list .topppa-mini-cart-item .topppa-mini-cart-item-image',
            ]
        );
        $this->add_responsive_control(
            'content_item_img_margin',
            [
                'label' => esc_html__('Margin', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} .topppa-mini-cart-wrapper .woocommerce-mini-cart.cart_list.product_list_widget.topppa-mini-cart-list .topppa-mini-cart-item .topppa-mini-cart-item-image' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'content_item_img_padding',
            [
                'label' => esc_html__('Padding', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} .topppa-mini-cart-wrapper .woocommerce-mini-cart.cart_list.product_list_widget.topppa-mini-cart-list .topppa-mini-cart-item .topppa-mini-cart-item-image' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_tab();

        $this->start_controls_tab(
            'content_item_style_title_tab',
            [
                'label' => esc_html__('Title', 'topper-pack'),
            ]
        );
        $this->add_responsive_control(
            'content_item_title_color',
            [
                'label' => esc_html__('Color', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .topppa-mini-cart-wrapper .woocommerce-mini-cart.cart_list.product_list_widget.topppa-mini-cart-list .topppa-mini-cart-item .topppa-mini-cart-item-details .topppa-mini-cart-item-name .topppa-mini-cart-item-link' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_responsive_control(
            'content_item_title_hover_color',
            [
                'label' => esc_html__('Hover Color', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .topppa-mini-cart-wrapper .woocommerce-mini-cart.cart_list.product_list_widget.topppa-mini-cart-list .topppa-mini-cart-item .topppa-mini-cart-item-details .topppa-mini-cart-item-name .topppa-mini-cart-item-link:hover' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'content_item_title_typography',
                'selector' => '{{WRAPPER}} .topppa-mini-cart-wrapper .woocommerce-mini-cart.cart_list.product_list_widget.topppa-mini-cart-list .topppa-mini-cart-item .topppa-mini-cart-item-details .topppa-mini-cart-item-name .topppa-mini-cart-item-link',
            ]
        );
        $this->add_responsive_control(
            'content_item_title_margin',
            [
                'label' => esc_html__('Margin', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} .topppa-mini-cart-wrapper .woocommerce-mini-cart.cart_list.product_list_widget.topppa-mini-cart-list .topppa-mini-cart-item .topppa-mini-cart-item-details .topppa-mini-cart-item-name' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'content_item_title_padding',
            [
                'label' => esc_html__('Padding', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} .topppa-mini-cart-wrapper .woocommerce-mini-cart.cart_list.product_list_widget.topppa-mini-cart-list .topppa-mini-cart-item .topppa-mini-cart-item-details .topppa-mini-cart-item-name' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_tab();

        $this->start_controls_tab(
            'content_item_style_price_tab',
            [
                'label' => esc_html__('Price', 'topper-pack'),
            ]
        );
        $this->add_responsive_control(
            'content_item_price_color',
            [
                'label' => esc_html__('Color', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .topppa-mini-cart-wrapper .woocommerce-mini-cart.cart_list.product_list_widget.topppa-mini-cart-list .topppa-mini-cart-item .topppa-mini-cart-item-details .topppa-mini-cart-item-meta .topppa-mini-cart-item-quantity' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'content_item_price_typography',
                'selector' => '{{WRAPPER}} .topppa-mini-cart-wrapper .woocommerce-mini-cart.cart_list.product_list_widget.topppa-mini-cart-list .topppa-mini-cart-item .topppa-mini-cart-item-details .topppa-mini-cart-item-meta .topppa-mini-cart-item-quantity',
            ]
        );
        $this->add_responsive_control(
            'content_item_price_margin',
            [
                'label' => esc_html__('Margin', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} .topppa-mini-cart-wrapper .woocommerce-mini-cart.cart_list.product_list_widget.topppa-mini-cart-list .topppa-mini-cart-item .topppa-mini-cart-item-details .topppa-mini-cart-item-meta .topppa-mini-cart-item-quantity' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'content_item_price_padding',
            [
                'label' => esc_html__('Padding', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} .topppa-mini-cart-wrapper .woocommerce-mini-cart.cart_list.product_list_widget.topppa-mini-cart-list .topppa-mini-cart-item .topppa-mini-cart-item-details .topppa-mini-cart-item-meta .topppa-mini-cart-item-quantity' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_tab();

        $this->start_controls_tab(
            'content_item_style_remove_tab',
            [
                'label' => esc_html__('Remove', 'topper-pack'),
            ]
        );
        $this->add_responsive_control(
            'content_item_remove_color',
            [
                'label' => esc_html__('Color', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .topppa-mini-cart-wrapper .woocommerce-mini-cart.cart_list.product_list_widget.topppa-mini-cart-list .topppa-mini-cart-item .topppa-mini-cart-item-remove .topppa-mini-cart-remove' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_responsive_control(
            'content_item_remove_size',
            [
                'label' => esc_html__('Font Size', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', 'em', 'rem', 'custom'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                        'step' => 1,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .topppa-mini-cart-wrapper .woocommerce-mini-cart.cart_list.product_list_widget.topppa-mini-cart-list .topppa-mini-cart-item .topppa-mini-cart-item-remove .topppa-mini-cart-remove' => 'font-size: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .topppa-mini-cart-wrapper .woocommerce-mini-cart.cart_list.product_list_widget.topppa-mini-cart-list .topppa-mini-cart-item .topppa-mini-cart-item-remove .topppa-mini-cart-remove svg' => 'width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'content_item_remove_margin',
            [
                'label' => esc_html__('Margin', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} .topppa-mini-cart-wrapper .woocommerce-mini-cart.cart_list.product_list_widget.topppa-mini-cart-list .topppa-mini-cart-item .topppa-mini-cart-item-remove .topppa-mini-cart-remove' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'content_item_remove_padding',
            [
                'label' => esc_html__('Padding', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} .topppa-mini-cart-wrapper .woocommerce-mini-cart.cart_list.product_list_widget.topppa-mini-cart-list .topppa-mini-cart-item .topppa-mini-cart-item-remove .topppa-mini-cart-remove' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();

        /**
         * start sub total style section
         *
         * @since 1.0.0
         * @access protected
         */
        $this->start_controls_section(
            'sub_total_style_section',
            [
                'label' => esc_html__('Sub Total', 'topper-pack'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_responsive_control(
            'sub_total_margin',
            [
                'label' => esc_html__('Margin', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} .topppa-mini-cart-wrapper .topppa-mini-cart-content .widget_shopping_cart_content .woocommerce-mini-cart__total' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'sub_total_padding',
            [
                'label' => esc_html__('Padding', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} .topppa-mini-cart-wrapper .topppa-mini-cart-content .widget_shopping_cart_content .woocommerce-mini-cart__total' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'sub_total_border',
                'selector' => '{{WRAPPER}} .topppa-mini-cart-wrapper .topppa-mini-cart-content .widget_shopping_cart_content .woocommerce-mini-cart__total',
            ]
        );
        $this->add_responsive_control(
            'sub_total_align',
            [
                'label' => esc_html__('Alignment', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'row' => [
                        'title' => esc_html__('Left', 'topper-pack'),
                        'icon' => 'eicon-h-align-left',
                    ],
                    'row-reverse' => [
                        'title' => esc_html__('Right', 'topper-pack'),
                        'icon' => 'eicon-h-align-right',
                    ],
                ],
                'default' => 'row',
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .topppa-mini-cart-wrapper .topppa-mini-cart-content .widget_shopping_cart_content .woocommerce-mini-cart__total' => 'flex-direction: {{VALUE}};',
                ],
            ]
        );
        $this->start_controls_tabs(
            'sub_total_style_tabs'
        );

        $this->start_controls_tab(
            'sub_total_style_text_tab',
            [
                'label' => esc_html__('Title', 'topper-pack'),
            ]
        );
        $this->add_responsive_control(
            'sub_total_text_color',
            [
                'label' => esc_html__('Text Color', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .topppa-mini-cart-wrapper .topppa-mini-cart-content .widget_shopping_cart_content .woocommerce-mini-cart__total strong' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'sub_total_text_typography',
                'selector' => '{{WRAPPER}} .topppa-mini-cart-wrapper .topppa-mini-cart-content .widget_shopping_cart_content .woocommerce-mini-cart__total strong',
            ]
        );
        $this->add_responsive_control(
            'sub_total_text_margin',
            [
                'label' => esc_html__('Margin', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} .topppa-mini-cart-wrapper .topppa-mini-cart-content .widget_shopping_cart_content .woocommerce-mini-cart__total strong' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'sub_total_text_padding',
            [
                'label' => esc_html__('Padding', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} .topppa-mini-cart-wrapper .topppa-mini-cart-content .widget_shopping_cart_content .woocommerce-mini-cart__total strong' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_tab();

        $this->start_controls_tab(
            'sub_total_style_price_tab',
            [
                'label' => esc_html__('Price', 'topper-pack'),
            ]
        );
        $this->add_responsive_control(
            'sub_total_price_color',
            [
                'label' => esc_html__('Price Color', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .topppa-mini-cart-wrapper .topppa-mini-cart-content .widget_shopping_cart_content .woocommerce-mini-cart__total .woocommerce-Price-amount.amount' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'sub_total_price_typography',
                'selector' => '{{WRAPPER}} .topppa-mini-cart-wrapper .topppa-mini-cart-content .widget_shopping_cart_content .woocommerce-mini-cart__total .woocommerce-Price-amount.amount',
            ]
        );
        $this->add_responsive_control(
            'sub_total_price_margin',
            [
                'label' => esc_html__('Margin', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} .topppa-mini-cart-wrapper .topppa-mini-cart-content .widget_shopping_cart_content .woocommerce-mini-cart__total .woocommerce-Price-amount.amount' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'sub_total_price_padding',
            [
                'label' => esc_html__('Padding', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} .topppa-mini-cart-wrapper .topppa-mini-cart-content .widget_shopping_cart_content .woocommerce-mini-cart__total .woocommerce-Price-amount.amount' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_tab();

        $this->end_controls_tabs();
        $this->end_controls_section();

        /**
         * start Button style section
         *
         * @since 1.0.0
         * @access protected
         */
        $this->start_controls_section(
            'button_style_section',
            [
                'label' => esc_html__('Button', 'topper-pack'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'button_typography',
                'selector' => '{{WRAPPER}} .topppa-mini-cart-wrapper .topppa-mini-cart-content .widget_shopping_cart_content .woocommerce-mini-cart__buttons .button',
            ]
        );

        $this->add_responsive_control(
            'button_flex_direction',
            [
                'label' => esc_html__('Flex Direction', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'row' => [
                        'title' => esc_html__('Row', 'topper-pack'),
                        'icon' => 'eicon-h-align-row',
                    ],
                    'column' => [
                        'title' => esc_html__('Column', 'topper-pack'),
                        'icon' => 'eicon-h-align-column',
                    ],
                ],
                'default' => 'column',
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .topppa-mini-cart-wrapper .topppa-mini-cart-content .widget_shopping_cart_content .woocommerce-mini-cart__buttons' => 'flex-direction: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'button_justify_content',
            [
                'label' => esc_html__('Justify Content', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'flex-start' => [
                        'title' => esc_html__('Center', 'topper-pack'),
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
                        'title' => esc_html__('Column', 'topper-pack'),
                        'icon' => 'eicon-justify-space-between-h',
                    ],
                    'space-around' => [
                        'title' => esc_html__('Column', 'topper-pack'),
                        'icon' => 'eicon-justify-space-around-h',
                    ],
                    'space-evenly' => [
                        'title' => esc_html__('Column', 'topper-pack'),
                        'icon' => 'eicon-justify-space-evenly-h',
                    ],
                ],
                'default' => 'center',
                'toggle' => true,
                'label_block' => true,
                'condition' => [
                    'button_flex_direction' => ['row'],
                ],
                'selectors' => [
                    '{{WRAPPER}} .topppa-mini-cart-wrapper .topppa-mini-cart-content .widget_shopping_cart_content .woocommerce-mini-cart__buttons' => 'justify-content: {{VALUE}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'button_gap',
            [
                'label' => esc_html__('Gap', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', 'em', 'rem', 'custom'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                        'step' => 1,
                    ]
                ],
                'selectors' => [
                    '{{WRAPPER}} .topppa-mini-cart-wrapper .topppa-mini-cart-content .widget_shopping_cart_content .woocommerce-mini-cart__buttons' => 'gap: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'button_width',
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
                    '{{WRAPPER}} .topppa-mini-cart-wrapper .topppa-mini-cart-content .widget_shopping_cart_content .woocommerce-mini-cart__buttons .button' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'button_margin',
            [
                'label' => esc_html__('Margin', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} .topppa-mini-cart-wrapper .topppa-mini-cart-content .widget_shopping_cart_content .woocommerce-mini-cart__buttons .button' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'button_padding',
            [
                'label' => esc_html__('Padding', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} .topppa-mini-cart-wrapper .topppa-mini-cart-content .widget_shopping_cart_content .woocommerce-mini-cart__buttons .button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->start_controls_tabs(
            'button_style_tabs'
        );

        $this->start_controls_tab(
            'button_style_cart_tab',
            [
                'label' => esc_html__('Cart', 'topper-pack'),
            ]
        );
        $this->add_responsive_control(
            'cart_button_color',
            [
                'label' => esc_html__('Color', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .topppa-mini-cart-wrapper .topppa-mini-cart-content .widget_shopping_cart_content .woocommerce-mini-cart__buttons .button.wc-forward' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'cart_button_background',
                'types' => ['classic', 'gradient', 'video'],
                'selector' => '{{WRAPPER}} .topppa-mini-cart-wrapper .topppa-mini-cart-content .widget_shopping_cart_content .woocommerce-mini-cart__buttons .button.wc-forward',
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'cart_button_border',
                'selector' => '{{WRAPPER}} .topppa-mini-cart-wrapper .topppa-mini-cart-content .widget_shopping_cart_content .woocommerce-mini-cart__buttons .button.wc-forward',
            ]
        );
        $this->add_responsive_control(
            'cart_button_radius',
            [
                'label' => esc_html__('Radius', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} .topppa-mini-cart-wrapper .topppa-mini-cart-content .widget_shopping_cart_content .woocommerce-mini-cart__buttons .button.wc-forward' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'cart_button_shadow',
                'selector' => '{{WRAPPER}} .topppa-mini-cart-wrapper .topppa-mini-cart-content .widget_shopping_cart_content .woocommerce-mini-cart__buttons .button.wc-forward',
            ]
        );
        $this->add_control(
            'cart_button_hover_options',
            [
                'label' => esc_html__('Hover Options', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->add_responsive_control(
            'cart_button_color_hover',
            [
                'label' => esc_html__('Color', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .topppa-mini-cart-wrapper .topppa-mini-cart-content .widget_shopping_cart_content .woocommerce-mini-cart__buttons .button.wc-forward:hover' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'cart_button_background_hover',
                'types' => ['classic', 'gradient', 'video'],
                'selector' => '{{WRAPPER}} .topppa-mini-cart-wrapper .topppa-mini-cart-content .widget_shopping_cart_content .woocommerce-mini-cart__buttons .button.wc-forward:hover',
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'cart_button_border_hover',
                'selector' => '{{WRAPPER}} .topppa-mini-cart-wrapper .topppa-mini-cart-content .widget_shopping_cart_content .woocommerce-mini-cart__buttons .button.wc-forward:hover',
            ]
        );
        $this->add_responsive_control(
            'cart_button_radius_hover',
            [
                'label' => esc_html__('Radius', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} .topppa-mini-cart-wrapper .topppa-mini-cart-content .widget_shopping_cart_content .woocommerce-mini-cart__buttons .button.wc-forward:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'cart_button_shadow_hover',
                'selector' => '{{WRAPPER}} .topppa-mini-cart-wrapper .topppa-mini-cart-content .widget_shopping_cart_content .woocommerce-mini-cart__buttons .button.wc-forward:hover',
            ]
        );
        $this->end_controls_tab();

        $this->start_controls_tab(
            'button_style_checkout_tab',
            [
                'label' => esc_html__('Checkout', 'topper-pack'),
            ]
        );
        $this->add_responsive_control(
            'checkout_button_color',
            [
                'label' => esc_html__('Color', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .topppa-mini-cart-wrapper .topppa-mini-cart-content .widget_shopping_cart_content .woocommerce-mini-cart__buttons .button.checkout' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'checkout_button_background',
                'types' => ['classic', 'gradient', 'video'],
                'selector' => '{{WRAPPER}} .topppa-mini-cart-wrapper .topppa-mini-cart-content .widget_shopping_cart_content .woocommerce-mini-cart__buttons .button.checkout',
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'checkout_button_border',
                'selector' => '{{WRAPPER}} .topppa-mini-cart-wrapper .topppa-mini-cart-content .widget_shopping_cart_content .woocommerce-mini-cart__buttons .button.checkout',
            ]
        );
        $this->add_responsive_control(
            'checkout_button_radius',
            [
                'label' => esc_html__('Radius', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} .topppa-mini-cart-wrapper .topppa-mini-cart-content .widget_shopping_cart_content .woocommerce-mini-cart__buttons .button.checkout' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'checkout_button_shadow',
                'selector' => '{{WRAPPER}} .topppa-mini-cart-wrapper .topppa-mini-cart-content .widget_shopping_cart_content .woocommerce-mini-cart__buttons .button.checkout',
            ]
        );
        $this->add_control(
            'checkout_button_hover_options',
            [
                'label' => esc_html__('Hover Options', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->add_responsive_control(
            'checkout_button_color_hover',
            [
                'label' => esc_html__('Color', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .topppa-mini-cart-wrapper .topppa-mini-cart-content .widget_shopping_cart_content .woocommerce-mini-cart__buttons .button.checkout:hover' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'checkout_button_background_hover',
                'types' => ['classic', 'gradient', 'video'],
                'selector' => '{{WRAPPER}} .topppa-mini-cart-wrapper .topppa-mini-cart-content .widget_shopping_cart_content .woocommerce-mini-cart__buttons .button.checkout:hover',
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'checkout_button_border_hover',
                'selector' => '{{WRAPPER}} .topppa-mini-cart-wrapper .topppa-mini-cart-content .widget_shopping_cart_content .woocommerce-mini-cart__buttons .button.checkout:hover',
            ]
        );
        $this->add_responsive_control(
            'checkout_button_radius_hover',
            [
                'label' => esc_html__('Radius', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} .topppa-mini-cart-wrapper .topppa-mini-cart-content .widget_shopping_cart_content .woocommerce-mini-cart__buttons .button.checkout:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'checkout_button_shadow_hover',
                'selector' => '{{WRAPPER}} .topppa-mini-cart-wrapper .topppa-mini-cart-content .widget_shopping_cart_content .woocommerce-mini-cart__buttons .button.checkout:hover',
            ]
        );
        $this->end_controls_tab();

        $this->end_controls_tabs();
        $this->end_controls_section();

        /**
         * start empty button style section
         *
         * @since 1.0.0
         * @access protected
         */
        $this->start_controls_section(
            'empty_button_style_section',
            [
                'label' => esc_html__('Empty Button', 'topper-pack'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'empty_button_typography',
                'selector' => '{{WRAPPER}} .topppa-mini-cart-empty .topppa-mini-cart-empty-button',
            ]
        );
        $this->add_responsive_control(
            'empty_button_margin',
            [
                'label' => esc_html__('Margin', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} .topppa-mini-cart-empty .topppa-mini-cart-empty-button' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'empty_button_padding',
            [
                'label' => esc_html__('Padding', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} .topppa-mini-cart-empty .topppa-mini-cart-empty-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->start_controls_tabs(
            'empty_button_style_tabs'
        );

        $this->start_controls_tab(
            'empty_button_style_normal_tab',
            [
                'label' => esc_html__('Normal', 'topper-pack'),
            ]
        );
        $this->add_responsive_control(
            'empty_button_text_color',
            [
                'label' => esc_html__('Text Color', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .topppa-mini-cart-empty .topppa-mini-cart-empty-button' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'empty_button_background',
                'types' => ['classic', 'gradient', 'video'],
                'selector' => '{{WRAPPER}} .topppa-mini-cart-empty .topppa-mini-cart-empty-button',
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'empty_button_border',
                'selector' => '{{WRAPPER}} .topppa-mini-cart-empty .topppa-mini-cart-empty-button',
            ]
        );
        $this->add_responsive_control(
            'empty_button_radius',
            [
                'label' => esc_html__('Radius', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} .topppa-mini-cart-empty .topppa-mini-cart-empty-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'empty_button_shadow',
                'selector' => '{{WRAPPER}} .topppa-mini-cart-empty .topppa-mini-cart-empty-button',
            ]
        );
        $this->end_controls_tab();

        $this->start_controls_tab(
            'empty_button_style_hover_tab',
            [
                'label' => esc_html__('Hover', 'topper-pack'),
            ]
        );
        $this->add_responsive_control(
            'empty_button_text_color_hover',
            [
                'label' => esc_html__('Text Color', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .topppa-mini-cart-empty .topppa-mini-cart-empty-button:hover' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'empty_button_background_hover',
                'types' => ['classic', 'gradient', 'video'],
                'selector' => '{{WRAPPER}} .topppa-mini-cart-empty .topppa-mini-cart-empty-button:hover',
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'empty_button_border_hover',
                'selector' => '{{WRAPPER}} .topppa-mini-cart-empty .topppa-mini-cart-empty-button:hover',
            ]
        );
        $this->add_responsive_control(
            'empty_button_radius_hover',
            [
                'label' => esc_html__('Radius', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} .topppa-mini-cart-empty .topppa-mini-cart-empty-button:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'empty_button_shadow_hover',
                'selector' => '{{WRAPPER}} .topppa-mini-cart-empty .topppa-mini-cart-empty-button:hover',
            ]
        );
        $this->end_controls_tab();

        $this->end_controls_tabs();
        $this->end_controls_section();
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

        // Store settings in transient so fragment class can access them
        set_transient('topppa_mini_cart_settings', $settings, 300); // 5 minutes


        // Make sure WC is fully loaded
        if (!function_exists('WC') || !WC()->cart) {
            return;
        }

        $cart_count = WC()->cart->get_cart_contents_count();
        $cart_total = WC()->cart ? WC()->cart->get_cart_total() : '0';

        // Cart button classes
        $button_classes = ['topppa-mini-cart-button'];
        if ($settings['select_content'] !== 'none') {
            $button_classes[] = 'topppa-cart-' . $settings['content_action_type'];
        }
?>
        <div class="topppa-mini-cart-wrapper">
            <div class="topppa-cart-button-wrap">
                <a class="<?php echo esc_attr(implode(' ', $button_classes)); ?> topppa-cart-contents">
                    <?php if (!empty($settings['cart_icon']['value'])) : ?>
                        <span class="topppa-mini-cart-icon">
                            <?php \Elementor\Icons_Manager::render_icon($settings['cart_icon'], ['aria-hidden' => 'true']); ?>
                            <span class="topppa-mini-cart-count"><?php echo esc_html($cart_count); ?></span>
                        </span>
                    <?php endif; ?>
                    <?php if ($settings['select_type'] === 'text' && !empty($settings['cart_text'])): ?>
                        <span class="topppa-mini-cart-text"><?php echo esc_html($settings['cart_text']); ?></span>
                    <?php elseif ($settings['select_type'] === 'price'): ?>
                        <span class="topppa-mini-cart-price"><?php echo wp_kses_post($cart_total); ?></span>
                    <?php endif; ?>
                </a>
            </div>

            <?php if ($settings['select_content'] === 'dropdown'): ?>
                <div class="topppa-cart-dropdown-wrap">
                    <div class="topppa-mini-cart-content">
                        <?php if (!empty($settings['content_header_title'])): ?>
                            <div class="topppa-mini-cart-header">
                                <h4><?php echo esc_html($settings['content_header_title']); ?></h4>
                                <button class="topppa-mini-cart-close">&times;</button>
                            </div>
                        <?php endif; ?>
                        <div class="widget_shopping_cart_content">
                            <?php woocommerce_mini_cart(); ?>
                        </div>
                    </div>
                </div>
            <?php elseif ($settings['select_content'] === 'sidebar'): ?>
                <div class="topppa-mini-cart-sidebar">
                    <div class="topppa-mini-cart-content">
                        <?php if (!empty($settings['content_header_title'])): ?>
                            <div class="topppa-mini-cart-header">
                                <h4><?php echo esc_html($settings['content_header_title']); ?></h4>
                                <button class="topppa-mini-cart-close">&times;</button>
                            </div>
                        <?php endif; ?>
                        <div class="widget_shopping_cart_content">
                            <?php woocommerce_mini_cart(); ?>
                        </div>
                    </div>
                    <div class="topppa-mini-cart-overlay"></div>
                </div>
            <?php endif; ?>
        </div>
<?php
    }
}
