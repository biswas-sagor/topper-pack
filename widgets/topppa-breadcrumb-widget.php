<?php

use \TopperPack\Includes\Controls\Controls_Manager as TopperPack_Controls_Manager;

if (! defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

/**
 * Elementor topppa Page Title Widget.
 *
 * Elementor widget that inserts an embbedable content into the page, from any given URL.
 *
 * @since 1.0.0
 */
class TOPPPA_Breadcrumb_Widget extends \Elementor\Widget_Base {

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
        return 'topppa_breadcrumb';
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
        return TOPPPA_EPWB . esc_html__('Breadcrumb', 'topper-pack');
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
        return 'eicon-archive-title';
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
        return ['topppa', 'breadcrumb', 'topper-pack', 'widget'];
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
        return 'https://doc.topperpack.com/docs/hero-banner-widgets/breadcrumb/';
    }

    /**
     * Register Page Title Widget controls.
     *
     * Add input fields to allow the user to customize the widget settings.
     *
     * @since 1.0.0
     * @access protected
     */
    protected function register_controls() {
        $this->start_controls_section(
            'breadcrumb_section',
            [
                'label' => esc_html__('Breadcrumb Options', 'topper-pack'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_control(
            'select_style',
            [
                'label' => esc_html__('Select Style', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'default',
                'options' => [
                    'default' => esc_html__('Default', 'topper-pack'),
                    'underlined' => esc_html__('Underlined Heading', 'topper-pack'),
                    'line-separator' => esc_html__('Line Separator', 'topper-pack'),
                    'dot-separator' => esc_html__('Dot Separator', 'topper-pack'),
                    'boxed-items' => esc_html__('Boxed Items', 'topper-pack'),
                    'sidebar' => esc_html__('Sidebar Style', 'topper-pack'),
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'before_background',
                'types' => ['classic', 'gradient', 'video'],
                'selector' => '{{WRAPPER}} .topppa-breadcrumb.topppa-breadcrumb-sidebar .topppa-breadcrumb__title:before, {{WRAPPER}} .topppa-breadcrumb.topppa-breadcrumb-underlined .topppa-breadcrumb__title:after, {{WRAPPER}} .topppa-breadcrumb-sidebar .topppa-breadcrumb__title:before',
                'condition' => [
                    'select_style' => ['underlined', 'line-separator', 'sidebar'],
                ],
            ]
        );
        $this->add_control(
            'select_title',
            [
                'label' => esc_html__('Select Title', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'default',
                'options' => [
                    'none' => esc_html__('None', 'topper-pack'),
                    'default'  => esc_html__('Default', 'topper-pack'),
                    'custom' => esc_html__('Custom', 'topper-pack'),
                ],
            ]
        );
        $this->add_control(
            'title_tag',
            [
                'label' => esc_html__('Title HTML Tag', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    'h1' => esc_html__('H1', 'topper-pack'),
                    'h2' => esc_html__('H2', 'topper-pack'),
                    'h3' => esc_html__('H3', 'topper-pack'),
                    'h4' => esc_html__('H4', 'topper-pack'),
                    'h5' => esc_html__('H5', 'topper-pack'),
                    'h6' => esc_html__('H6', 'topper-pack'),
                ],
                'default' => 'h1',
                'condition' => [
                    'select_title!' => 'none',
                ],
            ]
        );
        $this->add_control(
            'breadcrumb_title',
            [
                'label' => esc_html__('Title', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Breadcrumb', 'topper-pack'),
                'dynamic' => [
                    'active' => true,
                ],
                'condition' => [
                    'select_title' => 'custom',
                ],
            ]
        );
        $this->add_control(
            'enable_breadcrumb',
            [
                'label' => esc_html__('Enable Breadcrumb', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'default' => 'yes',
                'return_value' => 'yes',
            ]
        );
        $this->add_control(
            'breadcrumb_home_text',
            [
                'label' => esc_html__('Home Text', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Home', 'topper-pack'),
                'condition' => [
                    'enable_breadcrumb' => 'yes',
                ],
            ]
        );
        $this->add_control(
            'breadcrumb_home_icon',
            [
                'label' => esc_html__('Home Icon', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::ICONS,
                'default' => [
                    'value' => 'fas fa-home',
                    'library' => 'fa-solid',
                ],
                'condition' => [
                    'enable_breadcrumb' => 'yes'
                ],
            ]
        );
        $this->add_control(
            'breadcrumb_icon',
            [
                'label' => esc_html__('Separator Icon', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::ICONS,
                'default' => [
                    'value' => 'fas fa-angle-right',
                    'library' => 'fa-solid',
                ],
                'recommended' => [
                    'fa-solid' => [
                        'angle-right',
                        'angle-left',
                    ],
                    'fa-regular' => [
                        'angle-right',
                        'angle-left',
                    ],
                ],
                'condition' => [
                    'enable_breadcrumb' => 'yes',
                    'select_style!' => ['line-separator', 'dot-separator'],
                ],
            ]
        );

        $this->add_control(
            'show_category',
            [
                'label' => esc_html__('Show Category', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'default' => 'yes',
                'return_value' => 'yes',
                'description' => esc_html__('Show category in breadcrumb navigation', 'topper-pack'),
                'condition' => [
                    'enable_breadcrumb' => 'yes',
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
            'layout_style',
            [
                'label' => esc_html__('Layout', 'topper-pack'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_responsive_control(
            'gap',
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
                    '{{WRAPPER}} .topppa-breadcrumb__wrapper' => 'gap: {{SIZE}}{{UNIT}};',
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
                    '{{WRAPPER}} .topppa-breadcrumb__wrapper' => 'flex-direction: {{VALUE}};',
                ],
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
                    'stretch' => [
                        'title' => esc_html__('Stretch', 'topper-pack'),
                        'icon' => 'eicon-align-stretch-h',
                    ],
                    'baseline' => [
                        'title' => esc_html__('Baseline', 'topper-pack'),
                        'icon' => 'eicon-wordart',
                    ],
                ],
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .topppa-breadcrumb__wrapper' => 'align-items: {{VALUE}};',
                ],
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
                    '{{WRAPPER}} .topppa-breadcrumb__wrapper' => 'justify-content: {{VALUE}};',
                ],
                'condition' => [
                    'flex_direction' => ['row', 'row-reverse'],
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
                    '{{WRAPPER}} .topppa-breadcrumb__wrapper' => 'align-content: {{VALUE}};',
                ],
                'condition' => [
                    'flex_direction' => ['column', 'column-reverse'],
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'box_background',
                'types' => ['classic', 'gradient', 'video'],
                'selector' => '{{WRAPPER}} .topppa-breadcrumb__wrapper',
            ]
        );
        $this->add_responsive_control(
            'box_margin',
            [
                'label' => esc_html__('Margin', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} .topppa-breadcrumb__wrapper' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                    '{{WRAPPER}} .topppa-breadcrumb__wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'box_border',
                'selector' => '{{WRAPPER}} .topppa-breadcrumb__wrapper',
            ]
        );
        $this->add_responsive_control(
            'box_radius',
            [
                'label' => esc_html__('Radius', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} .topppa-breadcrumb__wrapper' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'box_shadow',
                'selector' => '{{WRAPPER}} .topppa-breadcrumb__wrapper',
            ]
        );
        $this->end_controls_section();


        /**
         * start Title Style Section
         *
         * @since 1.0.0
         * @access protected
         */

        $this->start_controls_section(
            'section_title_style',
            [
                'label' => esc_html__('Title Style', 'topper-pack'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                'condition' => [
                    'select_title!' => 'none',
                ],
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label' => esc_html__('Color', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .topppa-breadcrumb__title-text' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'selector' => '{{WRAPPER}} .topppa-breadcrumb__title-text',
            ]
        );
        $this->add_responsive_control(
            'title_align',
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
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .topppa-breadcrumb__title-text' => 'text-align: {{VALUE}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'title_margin',
            [
                'label' => esc_html__('Margin', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .topppa-breadcrumb__title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'title_padding',
            [
                'label' => esc_html__('Padding', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .topppa-breadcrumb__title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();

        /**
         * start Breadcrumb Style Section
         *
         * @since 1.0.0
         * @access protected
         */
        $this->start_controls_section(
            'section_breadcrumb_style',
            [
                'label' => esc_html__('Breadcrumb Style', 'topper-pack'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                'condition' => [
                    'enable_breadcrumb' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'breadcrumb_text_color',
            [
                'label' => esc_html__('Text Color', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .topppa-breadcrumb__list-item a' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'breadcrumb_text_hover_color',
            [
                'label' => esc_html__('Text Hover Color', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .topppa-breadcrumb__list-item a:hover' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'bg_one',
                'label' => esc_html__('BG', 'topper-pack'),
                'types' => ['classic', 'gradient', 'video'],
                'selector' => '{{WRAPPER}} topppa-breadcrumb-boxed-items .topppa-breadcrumb__list-item',
                'fields_options' => [
                    'background' => [
                        'label' => esc_html__('Box BG', 'topper-pack'),
                    ],
                ],
                'condition' => [
                    'select_style' => 'boxed-items',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'bg_two',
                'label' => esc_html__('Active BG', 'topper-pack'),
                'types' => ['classic', 'gradient', 'video'],
                'selector' => '{{WRAPPER}} .topppa-breadcrumb.topppa-breadcrumb-boxed-items .topppa-breadcrumb__list-item:last-child',
                'fields_options' => [
                    'background' => [
                        'label' => esc_html__('Active BG', 'topper-pack'),
                    ],
                ],
                'condition' => [
                    'select_style' => 'boxed-items',
                ],
            ]
        );
        $this->add_control(
            'breadcrumb_active_color',
            [
                'label' => esc_html__('Active Item Color', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .topppa-breadcrumb__list-item:last-child' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'separator_color',
            [
                'label' => esc_html__('Separator Color', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .topppa-breadcrumb-separator' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'breadcrumb_typography',
                'selector' => '{{WRAPPER}} .topppa-breadcrumb__list-item',
            ]
        );

        $this->add_responsive_control(
            'breadcrumb_space_between',
            [
                'label' => esc_html__('Space Between', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', 'em'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 50,
                    ],
                    'em' => [
                        'min' => 0,
                        'max' => 5,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .topppa-breadcrumb-separator' => 'margin: 0 {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'home_icon_color',
            [
                'label' => esc_html__('Home Icon Color', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .topppa-breadcrumb__list-item:first-child a i' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .topppa-breadcrumb__list-item:first-child a svg' => 'fill: {{VALUE}};',
                ],
                'condition' => [
                    'enable_breadcrumb' => 'yes',
                ],
            ]
        );
        $this->add_responsive_control(
            'list_align',
            [
                'label' => esc_html__('justify Content', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'flex-start' => [
                        'title' => esc_html__('Left', 'topper-pack'),
                        'icon' => 'eicon-align-start-h',
                    ],
                    'center' => [
                        'title' => esc_html__('Center', 'topper-pack'),
                        'icon' => 'eicon-align-center-h',
                    ],
                    'flex-end' => [
                        'title' => esc_html__('Right', 'topper-pack'),
                        'icon' => 'eicon-align-end-h',
                    ],
                ],
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .topppa-breadcrumb__list-items' => 'justify-content: {{VALUE}}',
                ],
            ]
        );
        $this->add_responsive_control(
            'list_text_align',
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
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .topppa-breadcrumb__list-items' => 'text-align: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'Breadcrumb_main_area_background',
                'types' => ['classic', 'gradient', 'video'],
                'selector' => '{{WRAPPER}} .topppa-breadcrumb__list-items',
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'Breadcrumb_main_area_border',
                'selector' => '{{WRAPPER}} .topppa-breadcrumb__list-items',
            ]
        );
        $this->add_responsive_control(
            'Breadcrumb_main_area_border_radius',
            [
                'label' => esc_html__('Border Radius', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .topppa-breadcrumb__list-items' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'Breadcrumb_main_area_padding',
            [
                'label' => esc_html__('Padding', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} .topppa-breadcrumb__list-items' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();
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

        // Hide all content on home page
        if (is_front_page()) {
            return;
        }

        // Prepare classes for the main wrapper
        $breadcrumb_classes = ['topppa-breadcrumb'];

        // Additional style class from style selector
        if ($settings['select_style'] !== 'default') {
            $breadcrumb_classes[] = 'topppa-breadcrumb-' . $settings['select_style'];
        }
        $breadcrumb_class = implode(' ', $breadcrumb_classes);
?>
        <div class="<?php echo esc_attr($breadcrumb_class); ?>">
            <div class="topppa-breadcrumb__wrapper">

                <?php if ($settings['select_title'] !== 'none'): ?>
                    <div class="topppa-breadcrumb__title">
                        <?php
                        $tag = $settings['title_tag'];
                        $title_text = '';

                        if ($settings['select_title'] === 'custom' && !empty($settings['breadcrumb_title'])) {
                            $title_text = wp_kses_post($settings['breadcrumb_title']);
                        } else {
                            // Default title based on current page
                            if (function_exists('is_woocommerce') && is_woocommerce()) {
                                ob_start();
                                woocommerce_page_title();
                                $title_text = ob_get_clean();
                            } elseif (is_archive()) {
                                ob_start();
                                the_archive_title();
                                $title_text = ob_get_clean();
                            } elseif (is_search()) {
                                $title_text = esc_html__('Search Results', 'topper-pack');
                            } elseif (is_singular()) {
                                $title_text = get_the_title();
                            } else {
                                ob_start();
                                wp_title('');
                                $title_text = ob_get_clean();
                            }
                        }

                        // Ensure proper tag formatting
                        echo '<' . esc_attr($tag) . ' class="topppa-breadcrumb__title-text">' . wp_kses_post($title_text) . '</' . esc_attr($tag) . '>';
                        ?>
                    </div>
                <?php endif; ?>

                <?php
                // Show breadcrumb list if breadcrumb is enabled, but hide on blog listing page
                if ($settings['enable_breadcrumb'] === 'yes' && !is_home()):
                ?>
                    <div class="topppa-breadcrumb__list">
                        <ul class="topppa-breadcrumb__list-items">

                            <?php
                            // Home link
                            $home_text = !empty($settings['breadcrumb_home_text']) ? $settings['breadcrumb_home_text'] : esc_html__('Home', 'topper-pack');
                            ?>
                            <li class="topppa-breadcrumb__list-item">
                                <a href="<?php echo esc_url(home_url('/')); ?>">
                                    <?php
                                    if (!empty($settings['breadcrumb_home_icon']['value'])) {
                                        \Elementor\Icons_Manager::render_icon($settings['breadcrumb_home_icon'], ['aria-hidden' => 'true']);
                                    }
                                    ?>
                                    <?php echo esc_html($home_text); ?>
                                </a>
                            </li>

                            <?php
                            // Icon
                            $breadcrumb_icon = '';
                            if (!empty($settings['breadcrumb_icon']['value'])) {
                                ob_start();
                                \Elementor\Icons_Manager::render_icon($settings['breadcrumb_icon'], ['aria-hidden' => 'true']);
                                $breadcrumb_icon = '<span class="topppa-breadcrumb-separator">' . ob_get_clean() . '</span>';
                            } else {
                                $breadcrumb_icon = '<span class="topppa-breadcrumb-separator">/</span>';
                            }

                            // WooCommerce Breadcrumbs
                            if (function_exists('is_woocommerce') && (is_woocommerce() || is_cart() || is_checkout() || is_account_page())) {

                                // Shop page
                                if (function_exists('wc_get_page_id')) {
                                    $shop_page_id = wc_get_page_id('shop');
                                    if ($shop_page_id > 0 && (!is_shop() || is_search())) {
                                        echo wp_kses_post($breadcrumb_icon);
                            ?>
                                        <li class="topppa-breadcrumb__list-item">
                                            <a href="<?php echo esc_url(get_permalink($shop_page_id)); ?>"><?php echo esc_html(get_the_title($shop_page_id)); ?></a>
                                        </li>
                                        <?php
                                    }

                                    // Product Category or Tag
                                    if (is_product_category() || is_product_tag() || is_tax('product_brand')) {
                                        echo wp_kses_post($breadcrumb_icon);
                                        $current_term = get_queried_object();

                                        // Handle parent categories
                                        if (is_product_category() && $current_term && $current_term->parent) {
                                            $parent_terms = $this->get_woo_parent_terms($current_term->term_id, 'product_cat');
                                            foreach ($parent_terms as $parent_term) {
                                        ?>
                                                <li class="topppa-breadcrumb__list-item">
                                                    <a href="<?php echo esc_url(get_term_link($parent_term)); ?>"><?php echo esc_html($parent_term->name); ?></a>
                                                </li>
                                        <?php
                                                echo wp_kses_post($breadcrumb_icon);
                                            }
                                        }

                                        // Current category/tag
                                        ?>
                                        <li class="topppa-breadcrumb__list-item"><?php echo esc_html($current_term->name); ?></li>
                                        <?php
                                    }

                                    // Product Detail
                                    elseif (is_product()) {
                                        global $post;
                                        $terms = wp_get_post_terms($post->ID, 'product_cat');
                                        if (!empty($terms) && !is_wp_error($terms)) {
                                            $main_term = apply_filters('topppa_woo_main_product_category', $terms[0]);

                                            // Add parent categories if any
                                            if ($main_term->parent) {
                                                $parent_terms = $this->get_woo_parent_terms($main_term->term_id, 'product_cat');
                                                foreach ($parent_terms as $parent_term) {
                                                    echo wp_kses_post($breadcrumb_icon);
                                        ?>
                                                    <li class="topppa-breadcrumb__list-item">
                                                        <a href="<?php echo esc_url(get_term_link($parent_term)); ?>"><?php echo esc_html($parent_term->name); ?></a>
                                                    </li>
                                            <?php
                                                }
                                            }

                                            // Add direct category
                                            echo wp_kses_post($breadcrumb_icon);
                                            ?>
                                            <li class="topppa-breadcrumb__list-item">
                                                <a href="<?php echo esc_url(get_term_link($main_term)); ?>"><?php echo esc_html($main_term->name); ?></a>
                                            </li>
                                        <?php
                                        }

                                        // Add product title
                                        echo wp_kses_post($breadcrumb_icon);
                                        ?>
                                        <li class="topppa-breadcrumb__list-item"><?php echo wp_kses_post(get_the_title()); ?></li>
                                    <?php
                                    }

                                    // Cart, Checkout, Account pages
                                    elseif (is_cart() || is_checkout() || is_account_page()) {
                                        echo wp_kses_post($breadcrumb_icon);
                                    ?>
                                        <li class="topppa-breadcrumb__list-item"><?php echo wp_kses_post(get_the_title()); ?></li>
                                    <?php
                                    }

                                    // Shop archive
                                    elseif (is_shop()) {
                                        echo wp_kses_post($breadcrumb_icon);
                                    ?>
                                        <li class="topppa-breadcrumb__list-item"><?php echo wp_kses_post(get_the_title($shop_page_id)); ?></li>
                                <?php
                                    }
                                }
                            }
                            // Regular WordPress Breadcrumbs
                            elseif (is_category()) {
                                echo wp_kses_post($breadcrumb_icon);
                                ?>
                                <li class="topppa-breadcrumb__list-item"><?php echo single_cat_title('', false); ?></li>
                            <?php
                            } elseif (is_tax()) {
                                echo wp_kses_post($breadcrumb_icon);
                                $term = get_term_by('slug', get_query_var('term'), get_query_var('taxonomy'));
                            ?>
                                <li class="topppa-breadcrumb__list-item"><?php echo wp_kses_post($term->name); ?></li>
                            <?php
                            } elseif (is_tag()) {
                                echo wp_kses_post($breadcrumb_icon);
                            ?>
                                <li class="topppa-breadcrumb__list-item"><?php echo single_tag_title('', false); ?></li>
                            <?php
                            } elseif (is_author()) {
                                echo wp_kses_post($breadcrumb_icon);
                            ?>
                                <li class="topppa-breadcrumb__list-item"><?php echo get_the_author(); ?></li>
                            <?php
                            } elseif (is_search()) {
                                echo wp_kses_post($breadcrumb_icon);
                            ?>
                                <li class="topppa-breadcrumb__list-item"><?php echo esc_html__('Search Results', 'topper-pack'); ?></li>
                            <?php
                            } elseif (is_404()) {
                                echo wp_kses_post($breadcrumb_icon);
                            ?>
                                <li class="topppa-breadcrumb__list-item"><?php echo esc_html__('404 Not Found', 'topper-pack'); ?></li>
                                <?php
                            } elseif (is_singular()) {
                                // For posts, pages, and custom post types
                                $post_type = get_post_type();

                                if ($post_type === 'post' && $settings['show_category'] === 'yes') {
                                    // Add category for posts
                                    $categories = get_the_category();
                                    if (!empty($categories)) {
                                        echo wp_kses_post($breadcrumb_icon);
                                ?>
                                        <li class="topppa-breadcrumb__list-item">
                                            <a href="<?php echo esc_url(get_category_link($categories[0]->term_id)); ?>"><?php echo esc_html($categories[0]->name); ?></a>
                                        </li>
                                    <?php
                                    }
                                } elseif ($post_type !== 'page' && $post_type !== 'post') {
                                    // Custom post type (but not regular posts)
                                    $post_type_obj = get_post_type_object($post_type);
                                    if ($post_type_obj) {
                                        echo wp_kses_post($breadcrumb_icon);
                                    ?>
                                        <li class="topppa-breadcrumb__list-item">
                                            <a href="<?php echo esc_url(get_post_type_archive_link($post_type)); ?>"><?php echo esc_html($post_type_obj->labels->name); ?></a>
                                        </li>
                                <?php
                                    }
                                }

                                // Add post/page title
                                echo wp_kses_post($breadcrumb_icon);
                                ?>
                                <li class="topppa-breadcrumb__list-item"><?php echo wp_kses_post(get_the_title()); ?></li>
                                <?php
                            } elseif (is_archive()) {
                                echo wp_kses_post($breadcrumb_icon);
                                if (is_day()) {
                                ?>
                                    <li class="topppa-breadcrumb__list-item"><?php echo wp_kses_post(get_the_date()); ?></li>
                                <?php
                                } elseif (is_month()) {
                                ?>
                                    <li class="topppa-breadcrumb__list-item"><?php echo wp_kses_post(get_the_date('F Y')); ?></li>
                                <?php
                                } elseif (is_year()) {
                                ?>
                                    <li class="topppa-breadcrumb__list-item"><?php echo wp_kses_post(get_the_date('Y')); ?></li>
                                <?php
                                } else {
                                ?>
                                    <li class="topppa-breadcrumb__list-item"><?php echo wp_kses_post(post_type_archive_title('', false)); ?></li>
                            <?php
                                }
                            }
                            ?>
                        </ul>
                    </div>
                <?php endif; ?>

            </div>
        </div>
<?php
    }

    /**
     * Get WooCommerce parent terms in hierarchical order
     *
     * @since 1.0.0
     * @access protected
     * @param int $term_id The term ID
     * @param string $taxonomy The taxonomy name
     * @return array The parent terms
     */
    protected function get_woo_parent_terms($term_id, $taxonomy) {
        $parent_terms = array();
        $term = get_term($term_id, $taxonomy);

        if ($term && !is_wp_error($term) && $term->parent) {
            $parent = get_term($term->parent, $taxonomy);
            if ($parent && !is_wp_error($parent)) {
                $parent_terms = $this->get_woo_parent_terms($parent->term_id, $taxonomy);
                $parent_terms[] = $parent;
            }
        }

        return $parent_terms;
    }
}