<?php

use TopperPack\Trait_Loader\Global_Component_Loader;
use \TopperPack\Includes\Controls\Controls_Manager as TopperPack_Controls_Manager;
use \TopperPack\Includes\Utilities;

if (! defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

/**
 * Elementor Counter Info Widget.
 *
 * Elementor widget that inserts an embbedable content into the page, from any given URL.
 *
 * @since 1.0.0
 */
class TOPPPA_Heading_Widget extends \Elementor\Widget_Base {

    /**
     * Global Component Loader
     *
     * @package TopperPack
     * @since 1.0.0
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
        return 'topppa_headingt_widget';
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
        return TOPPPA_EPWB . esc_html__('Advance Heading', 'topper-pack');
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
        return 'eicon-heading';
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
        return ['topppa', 'widget', 'Heading', 'Title', 'Advance', 'topperpack'];
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
        return 'https://doc.topperpack.com/docs/general-widgets/advanced-heading/';
    }

    public function topppa_heading_after_before_line() {
        $this->add_control(
            'select_separator',
            [
                'label' => esc_html__('Select Separator', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => '',
                'options' => [
                    '' => esc_html__('Default ', 'topper-pack'),
                    'pro_icon' => esc_html__('Icon (Pro)', 'topper-pack'),
                    'line' => esc_html__('Line', 'topper-pack'),
                ],
                'condition' => [
                    'enable_after_before' => 'yes',
                ],
            ]
        );
        Utilities::upgrade_pro_notice(
            $this,
            \Elementor\Controls_Manager::RAW_HTML,
            'topppa_headingt_widget',
            'select_separator',
            ['pro_icon']
        );
    }

    public function topppa_typewriting_control() {
        $this->add_control(
            'show_typewrite_title',
            [
                'label' => esc_html__('Enable Typewrite Title', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', 'topper-pack'),
                'label_off' => esc_html__('Hide', 'topper-pack'),
                'return_value' => 'yes',
                'default' => 'no',

            ]
        );
        $this->add_control(
            'pro_preview',
            [
                'type' => \Elementor\Controls_Manager::RAW_HTML,
                'raw' => Utilities::upgrade_pro_image_notice('typewright.jpg'),
                'condition' => [
                    'show_typewrite_title' => 'yes',
                ],
            ]
        );
    }

    public function topppa_typewriting_style_control() {
        return;
    }

    /**
     * Register Counter widget controls.
     *
     * Add input fields to allow the user to customize the widget settings.
     *
     * @since 1.0.0
     * @access protected
     */
    protected function register_controls() {

        $this->start_controls_section(
            'content_options',
            [
                'label' => esc_html__('Content', 'topper-pack'),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        // --- Small Title ---
        $this->add_control(
            'enable_small_title',
            [
                'label' => esc_html__('Show Small Title', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', 'topper-pack'),
                'label_off' => esc_html__('Hide', 'topper-pack'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );
        $this->add_control(
            'stitle',
            [
                'label'   => esc_html__('Small Title', 'topper-pack'),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Why Choose Us?', 'topper-pack'),
                'label_block' => true,
                'condition' => [
                    'enable_small_title' => 'yes',
                ],
            ]
        );

        // --- Main Title ---
        $this->add_control(
            'enable_title',
            [
                'label' => esc_html__('Show Main Title', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', 'topper-pack'),
                'label_off' => esc_html__('Hide', 'topper-pack'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );
        $this->add_control(
            'title',
            [
                'label'       => esc_html__('Main Title', 'topper-pack'),
                'type'        => \Elementor\Controls_Manager::WYSIWYG,
                'default'     => esc_html__('Service We Can Provide', 'topper-pack'),
                'dynamic'     => ['active' => true],
                'description' => esc_html__('Use <strong> tag for gradient color in the middle of the text.', 'topper-pack'),
                'condition'   => [
                    'enable_title' => 'yes'
                ]
            ]
        );
        $this->topppa_global_title_tag();

        // --- Typewriter Effect (if present) ---
        $this->topppa_typewriting_control();

        // --- After/Before/Separator ---
        $this->add_control(
            'enable_after_before',
            [
                'label' => esc_html__('Show Separator', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', 'topper-pack'),
                'label_off' => esc_html__('Hide', 'topper-pack'),
                'return_value' => 'yes',
                'default' => 'no',
                'condition' => [
                    'enable_small_title' => 'yes'
                ]
            ]
        );
        $this->topppa_heading_after_before_line([
            'enable_after_before' => true,
        ]);

        // --- Description ---
        $this->add_control(
            'enable_description',
            [
                'label' => esc_html__('Show Description', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', 'topper-pack'),
                'label_off' => esc_html__('Hide', 'topper-pack'),
                'default' => 'yes',
            ]
        );
        $this->add_control(
            'description',
            [
                'label'       => esc_html__('Description', 'topper-pack'),
                'type'        => \Elementor\Controls_Manager::WYSIWYG,
                'dynamic'     => ['active' => true],
                'separator'   => 'before',
                'condition'   => [
                    'enable_description' => 'yes',
                ],
            ]
        );
        $this->end_controls_section();

        // Style Tab - Small Title
        $this->start_controls_section(
            'section_box',
            [
                'label' => esc_html__('Content Box Style', 'topper-pack'),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'content_box_width',
            [
                'label' => esc_html__('Content Width', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1380,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .topppa-section-title-content' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'content_box_position',
            [
                'label'     => __('Justify Content', 'topper-pack'),
                'type'      => \Elementor\Controls_Manager::CHOOSE,
                'options'   => [
                    'flex-start'    => [
                        'title' => __('Left', 'topper-pack'),
                        'icon'  => 'eicon-h-align-left',
                    ],
                    'center'  => [
                        'title' => __('Center', 'topper-pack'),
                        'icon'  => 'eicon-h-align-center',
                    ],
                    'flex-end'   => [
                        'title' => __('Right', 'topper-pack'),
                        'icon'  => 'eicon-h-align-right',
                    ],
                ],
                'toggle'    => true,
                'selectors' => [
                    '{{WRAPPER}} .topppa-section-title-wrapper' => 'justify-content: {{VALUE}}',
                ],
            ]
        );

        $this->add_responsive_control(
            'section_box_aligment',
            [
                'label'     => __('Alignment', 'topper-pack'),
                'type'      => \Elementor\Controls_Manager::CHOOSE,
                'options'   => [
                    'left'    => [
                        'title' => __('Left', 'topper-pack'),
                        'icon'  => 'eicon-text-align-left',
                    ],
                    'center'  => [
                        'title' => __('Center', 'topper-pack'),
                        'icon'  => 'eicon-text-align-center',
                    ],
                    'right'   => [
                        'title' => __('Right', 'topper-pack'),
                        'icon'  => 'eicon-text-align-left',
                    ],
                ],
                'toggle'    => true,
                'selectors' => [
                    '{{WRAPPER}} .topppa-section-title-content' => 'text-align: {{VALUE}}',
                ],
            ]
        );
        $this->end_controls_section();


        $this->start_controls_section(
            'subtitle_style_options',
            [
                'label' => esc_html__('Subtitle Style', 'topper-pack'),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
                'condition' => [
                    'enable_small_title' => 'yes'
                ]
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'subtitle_title_typo',
                'label' => __('Typography', 'topper-pack'),
                'selector' => '{{WRAPPER}} .topppa-section-small-title',
            ]
        );

        $this->add_responsive_control(
            'subtitle_color',
            [
                'label'       => esc_html__('Color', 'topper-pack'),
                'type'        => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .topppa-section-small-title' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name'     => 'box_bg',
                'label'    => esc_html__('Background', 'topper-pack'),
                'types'    => ['classic', 'gradient', 'video'],
                'selector' => '{{WRAPPER}} .topppa-section-small-title',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name'     => 'subtitle_border',
                'label'    => esc_html__('Border', 'topper-pack'),
                'selector' => '{{WRAPPER}} .topppa-section-small-title',
            ]
        );
        $this->add_responsive_control(
            'subtitle_border_radius',
            [
                'label'      => esc_html__('Border Radius', 'topper-pack'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .topppa-section-small-title' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'subtitle_shadow',
                'label'    => esc_html__('Box Shadow', 'topper-pack'),
                'selector' => '{{WRAPPER}} .topppa-section-small-title',
            ]
        );

        // multiple shadow
        $this->add_control(
            'enable_double_shadow',
            [
                'label'        => esc_html__('Enable Double Shadow', 'topper-pack'),
                'type'         => \Elementor\Controls_Manager::SWITCHER,
                'label_on'     => esc_html__('Yes', 'topper-pack'),
                'label_off'    => esc_html__('No', 'topper-pack'),
                'return_value' => 'yes',
                'default'      => 'no',
            ]
        );

        // Shadow #1
        $this->add_control(
            'shadow1',
            [
                'label'     => esc_html__('Shadow 1', 'topper-pack'),
                'type'      => \Elementor\Controls_Manager::BOX_SHADOW,
                'condition' => [
                    'enable_double_shadow' => 'yes',
                ],
                'selectors' => [],
            ]
        );

        // Shadow #2
        $this->add_control(
            'shadow2',
            [
                'label'     => esc_html__('Shadow 2', 'topper-pack'),
                'type'      => \Elementor\Controls_Manager::BOX_SHADOW,
                'condition' => [
                    'enable_double_shadow' => 'yes',
                ],
                'selectors' => [],
            ]
        );
        $this->add_responsive_control(
            'subtitle_margin',
            [
                'label'      => esc_html__('Margin', 'topper-pack'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .topppa-section-small-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'subtitle_padding',
            [
                'label'      => esc_html__('Padding', 'topper-pack'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .topppa-section-small-title' => 'Padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        // --- Subtitle Gradient Text ---
        $this->add_control(
            'subtitle_text_effect',
            [
                'label' => esc_html__('Text Effect', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'none',
                'options' => [
                    'none' => esc_html__('None', 'topper-pack'),
                    'gradient' => esc_html__('Gradient', 'topper-pack'),
                ],
            ]
        );

        $this->add_control(
            'subtitle_gradient_start_color',
            [
                'label' => esc_html__('Gradient Start Color', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'condition' => [
                    'subtitle_text_effect' => 'gradient',
                ],
            ]
        );

        $this->add_control(
            'subtitle_gradient_start_location',
            [
                'label' => esc_html__('Gradient Start Location', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['%'],
                'range' => [
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                        'step' => 1,
                    ],
                ],
                'default' => [
                    'unit' => '%',
                    'size' => 0,
                ],
                'condition' => [
                    'subtitle_text_effect' => 'gradient',
                ],
            ]
        );

        $this->add_control(
            'subtitle_gradient_end_color',
            [
                'label' => esc_html__('Gradient End Color', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'condition' => [
                    'subtitle_text_effect' => 'gradient',
                ],
            ]
        );

        $this->add_control(
            'subtitle_gradient_end_location',
            [
                'label' => esc_html__('Gradient End Location', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['%'],
                'range' => [
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                        'step' => 1,
                    ],
                ],
                'default' => [
                    'unit' => '%',
                    'size' => 100,
                ],
                'condition' => [
                    'subtitle_text_effect' => 'gradient',
                ],
            ]
        );

        $this->add_control(
            'subtitle_gradient_type',
            [
                'label' => esc_html__('Gradient Type', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'linear',
                'options' => [
                    'linear' => esc_html__('Linear', 'topper-pack'),
                    'radial' => esc_html__('Radial', 'topper-pack'),
                ],
                'condition' => [
                    'subtitle_text_effect' => 'gradient',
                ],
            ]
        );

        $this->add_control(
            'subtitle_gradient_angle',
            [
                'label' => esc_html__('Angle', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['deg'],
                'range' => [
                    'deg' => [
                        'min' => 0,
                        'max' => 360,
                        'step' => 1,
                    ],
                ],
                'default' => [
                    'unit' => 'deg',
                    'size' => 180,
                ],
                'condition' => [
                    'subtitle_text_effect' => 'gradient',
                    'subtitle_gradient_type' => 'linear',
                ],

            ]
        );
        $this->add_control(
            'subtitle_separator',
            [
                'label' => __('Separator Settings', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
                'condition' => [
                    'enable_after_before' => 'yes',
                ],
            ]
        );
        $this->add_control(
            'separator_color',
            [
                'label'     => esc_html__('Color', 'topper-pack'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .topppa-section-small-title.line::before, {{WRAPPER}} .topppa-section-small-title.line::after' => 'background-color: {{VALUE}};',
                ],
                'condition' => [
                    'select_separator' => 'line',
                    'enable_after_before' => 'yes',
                ],
            ]
        );

        $this->add_responsive_control(
            'separator_width',
            [
                'label'     => esc_html__('Width', 'topper-pack'),
                'type'      => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range'     => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .topppa-section-small-title.line::before, {{WRAPPER}} .topppa-section-small-title.line::after' => 'width: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'select_separator' => 'line',
                    'enable_after_before' => 'yes',
                ],
            ]
        );
        $this->add_responsive_control(
            'separator_height',
            [
                'label'     => esc_html__('Height', 'topper-pack'),
                'type'      => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range'     => [
                    'px' => [
                        'min' => 0,
                        'max' => 10,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .topppa-section-small-title.line::before, {{WRAPPER}} .topppa-section-small-title.line::after' => 'height: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'select_separator' => 'line',
                    'enable_after_before' => 'yes',
                ],
            ]
        );

        $this->add_responsive_control(
            'separator_spacing',
            [
                'label'     => esc_html__('Spacing', 'topper-pack'),
                'type'      => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range'     => [
                    'px' => [
                        'min' => 0,
                        'max' => 50,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .topppa-section-small-title.line::before' => 'margin-right: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .topppa-section-small-title.line::after' => 'margin-left: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'select_separator' => 'line',
                    'enable_after_before' => 'yes',
                ],
            ]
        );
        $this->add_control(
            'icon_color',
            [
                'label'     => esc_html__('Color', 'topper-pack'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .topppa-section-small-title.icons .separator-icon' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'select_separator' => 'icon',
                    'enable_after_before' => 'yes',
                ],
            ]
        );

        $this->add_responsive_control(
            'icon_size',
            [
                'label'     => esc_html__('Size', 'topper-pack'),
                'type'      => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range'     => [
                    'px' => [
                        'min' => 0,
                        'max' => 50,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .topppa-section-small-title.icons .separator-icon' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'select_separator' => 'icon',
                    'enable_after_before' => 'yes',
                ],
            ]
        );

        $this->add_responsive_control(
            'icon_spacing',
            [
                'label'     => esc_html__('Spacing', 'topper-pack'),
                'type'      => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range'     => [
                    'px' => [
                        'min' => 0,
                        'max' => 50,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .topppa-section-small-title.icons span:first-child' => 'margin-right: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .topppa-section-small-title.icons span:last-child' => 'margin-left: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'select_separator' => 'icon',
                    'enable_after_before' => 'yes',
                ],
            ]
        );
        $this->end_controls_section();
        // Style Tab - Main Title
        $this->start_controls_section(
            'section_style',
            [
                'label' => esc_html__('Title Style', 'topper-pack'),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
                'condition' => [
                    'enable_title' => 'yes'
                ]
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label'     => esc_html__('Title Color', 'topper-pack'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .topppa-section-title' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'text_effect' => 'none',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'title_typography',
                'label'    => esc_html__('Typography', 'topper-pack'),
                'selector' => '{{WRAPPER}} .topppa-section-title',
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Text_Shadow::get_type(),
            [
                'name' => 'text_shadow',
                'selector' => '{{WRAPPER}} .topppa-section-title',
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Text_Stroke::get_type(),
            [
                'name' => 'text_stroke',
                'selector' => '{{WRAPPER}} .topppa-section-title',
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Css_Filter::get_type(),
            [
                'name' => 'custom_css_filters',
                'selector' => '{{WRAPPER}} .topppa-section-title',
            ]
        );
        $this->add_control(
            'text_effect',
            [
                'label' => esc_html__('Text Effect', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'none',
                'options' => [
                    'none' => esc_html__('None', 'topper-pack'),
                    'gradient' => esc_html__('Gradient', 'topper-pack'),
                ],
            ]
        );


        $this->add_control(
            'gradient_start_color',
            [
                'label' => esc_html__('Color', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'condition' => [
                    'text_effect' => 'gradient',
                ],
            ]
        );

        $this->add_control(
            'gradient_start_location',
            [
                'label' => esc_html__('Location', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['%'],
                'range' => [
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                        'step' => 1,
                    ],
                ],
                'default' => [
                    'unit' => '%',
                    'size' => 0,
                ],
                'condition' => [
                    'text_effect' => 'gradient',
                ],
            ]
        );

        $this->add_control(
            'gradient_end_color',
            [
                'label' => esc_html__('Second Color', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'condition' => [
                    'text_effect' => 'gradient',
                ],
            ]
        );

        $this->add_control(
            'gradient_end_location',
            [
                'label' => esc_html__('Location', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['%'],
                'range' => [
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                        'step' => 1,
                    ],
                ],
                'default' => [
                    'unit' => '%',
                    'size' => 100,
                ],
                'condition' => [
                    'text_effect' => 'gradient',
                ],
            ]
        );

        $this->add_control(
            'gradient_type',
            [
                'label' => esc_html__('Type', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'linear',
                'options' => [
                    'linear' => esc_html__('Linear', 'topper-pack'),
                    'radial' => esc_html__('Radial', 'topper-pack'),
                ],
                'condition' => [
                    'text_effect' => 'gradient',
                ],
            ]
        );

        $this->add_control(
            'gradient_angle',
            [
                'label' => esc_html__('Angle', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['deg'],
                'range' => [
                    'deg' => [
                        'min' => 0,
                        'max' => 360,
                        'step' => 1,
                    ],
                ],
                'default' => [
                    'unit' => 'deg',
                    'size' => 180,
                ],
                'condition' => [
                    'text_effect' => 'gradient',
                    'gradient_type' => 'linear',
                ],

            ]
        );
        $this->add_control(
            'strong_heading',
            [
                'label' => esc_html__('Strong Tag Settings', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'strong_title_typography',
                'label'    => esc_html__('Typography', 'topper-pack'),
                'selector' => '{{WRAPPER}} .topppa-section-title strong',
                'separator' => 'before',

            ]
        );
        $this->add_responsive_control(
            'strong_color',
            [
                'label' => esc_html__('Color', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .topppa-section-title strong' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'strong_box_bg',
                'label' => esc_html__('Background', 'topper-pack'),
                'types' => ['classic', 'gradient', 'video'],
                'selector' => '{{WRAPPER}} .topppa-section-title strong',
                'condition' => [
                    'strong_gradient_effect' => 'none',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'strong_border',
                'selector' => '{{WRAPPER}} .topppa-section-title strong',
            ]
        );
        $this->add_responsive_control(
            'strong_border_radius',
            [
                'label' => esc_html__('Border Radius', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .topppa-section-title strong' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'strong_gradient_effect',
            [
                'label' => esc_html__('Gradient Effect', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'none',
                'options' => [
                    'none' => esc_html__('None', 'topper-pack'),
                    'gradient' => esc_html__('Gradient', 'topper-pack'),
                    'image' => esc_html__('Image', 'topper-pack'),
                ],
            ]
        );

        $this->add_control(
            'strong_image',
            [
                'label' => esc_html__('Image', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'condition' => [
                    'strong_gradient_effect' => 'image',
                ],
            ]
        );

        $this->add_control(
            'strong_image_size',
            [
                'label' => esc_html__('Image Size', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'full',
                'options' => [
                    'full' => esc_html__('Full', 'topper-pack'),
                    'large' => esc_html__('Large', 'topper-pack'),
                    'medium' => esc_html__('Medium', 'topper-pack'),
                    'thumbnail' => esc_html__('Thumbnail', 'topper-pack'),
                ],
                'condition' => [
                    'strong_gradient_effect' => 'image',
                ],
            ]
        );

        $this->add_control(
            'strong_image_position',
            [
                'label' => esc_html__('Background Position', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'center center',
                'options' => [
                    'center center' => esc_html__('Center Center', 'topper-pack'),
                    'center left' => esc_html__('Center Left', 'topper-pack'),
                    'center right' => esc_html__('Center Right', 'topper-pack'),
                    'top center' => esc_html__('Top Center', 'topper-pack'),
                    'top left' => esc_html__('Top Left', 'topper-pack'),
                    'top right' => esc_html__('Top Right', 'topper-pack'),
                    'bottom center' => esc_html__('Bottom Center', 'topper-pack'),
                    'bottom left' => esc_html__('Bottom Left', 'topper-pack'),
                    'bottom right' => esc_html__('Bottom Right', 'topper-pack'),
                ],
                'selectors' => [
                    '{{WRAPPER}} .topppa-section-title strong.topppa-strong-image' => 'background-position: {{VALUE}};',
                ],
                'condition' => [
                    'strong_gradient_effect' => 'image',
                ],
            ]
        );

        $this->add_control(
            'strong_image_repeat',
            [
                'label' => esc_html__('Background Repeat', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'no-repeat',
                'options' => [
                    'no-repeat' => esc_html__('No Repeat', 'topper-pack'),
                    'repeat' => esc_html__('Repeat', 'topper-pack'),
                    'repeat-x' => esc_html__('Repeat X', 'topper-pack'),
                    'repeat-y' => esc_html__('Repeat Y', 'topper-pack'),
                ],
                'selectors' => [
                    '{{WRAPPER}} .topppa-section-title strong.topppa-strong-image' => 'background-repeat: {{VALUE}};',
                ],
                'condition' => [
                    'strong_gradient_effect' => 'image',
                ],
            ]
        );

        $this->add_control(
            'strong_image_size_control',
            [
                'label' => esc_html__('Background Size', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'cover',
                'options' => [
                    'auto' => esc_html__('Auto', 'topper-pack'),
                    'cover' => esc_html__('Cover', 'topper-pack'),
                    'contain' => esc_html__('Contain', 'topper-pack'),
                ],
                'selectors' => [
                    '{{WRAPPER}} .topppa-section-title strong.topppa-strong-image' => 'background-size: {{VALUE}};',
                ],
                'condition' => [
                    'strong_gradient_effect' => 'image',
                ],
            ]
        );

        $this->add_control(
            'strong_gradient_start_color',
            [
                'label' => esc_html__('Gradient Start Color', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'condition' => [
                    'strong_gradient_effect' => 'gradient',
                ],
            ]
        );

        $this->add_control(
            'strong_gradient_end_color',
            [
                'label' => esc_html__('Gradient End Color', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'condition' => [
                    'strong_gradient_effect' => 'gradient',
                ],
            ]
        );

        $this->add_control(
            'strong_gradient_type',
            [
                'label' => esc_html__('Gradient Type', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'linear',
                'options' => [
                    'linear' => esc_html__('Linear', 'topper-pack'),
                    'radial' => esc_html__('Radial', 'topper-pack'),
                ],
                'condition' => [
                    'strong_gradient_effect' => 'gradient',
                ],
            ]
        );

        $this->add_control(
            'strong_gradient_angle',
            [
                'label' => esc_html__('Gradient Angle', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['deg'],
                'range' => [
                    'deg' => [
                        'min' => 0,
                        'max' => 360,
                        'step' => 1,
                    ],
                ],
                'default' => [
                    'unit' => 'deg',
                    'size' => 180,
                ],
                'condition' => [
                    'strong_gradient_effect' => 'gradient',
                    'strong_gradient_type' => 'linear',
                ],
            ]
        );

        $this->add_control(
            'strong_gradient_start_location',
            [
                'label' => esc_html__('Gradient Start Location', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['%'],
                'range' => [
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                        'step' => 1,
                    ],
                ],
                'default' => [
                    'unit' => '%',
                    'size' => 0,
                ],
                'condition' => [
                    'strong_gradient_effect' => 'gradient',
                ],
            ]
        );

        $this->add_control(
            'strong_gradient_end_location',
            [
                'label' => esc_html__('Gradient End Location', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['%'],
                'range' => [
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                        'step' => 1,
                    ],
                ],
                'default' => [
                    'unit' => '%',
                    'size' => 100,
                ],
                'condition' => [
                    'strong_gradient_effect' => 'gradient',
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
                    '{{WRAPPER}} .topppa-section-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator' => 'before',
            ]
        );
        $this->add_responsive_control(
            'title_padding',
            [
                'label' => esc_html__('Padding', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .topppa-section-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'typewirte_text_style',
            [
                'label' => __('Typewrite Settings', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
                'condition' => [
                    'show_typewrite_title' => 'yes',

                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'typewirte_text_typo',
                'label' => __('Typography', 'topper-pack'),
                'selector' => '{{WRAPPER}} .topppa-section-title .topppa-section-wrap',
                'condition' => [
                    'show_typewrite_title' => 'yes',

                ],
            ]
        );

        $this->add_control(
            'typewrite_gradient_enable',
            [
                'label' => esc_html__('Enable Gradient', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', 'topper-pack'),
                'label_off' => esc_html__('Hide', 'topper-pack'),
                'return_value' => 'yes',
                'default' => 'no',
                'condition' => [
                    'show_typewrite_title' => 'yes',

                ],
            ]
        );

        $this->add_control(
            'typewrite_gradient_start_color',
            [
                'label' => esc_html__('Gradient Start Color', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'condition' => [
                    'show_typewrite_title' => 'yes',
                    'typewrite_gradient_enable' => 'yes',

                ],
            ]
        );

        $this->add_control(
            'typewrite_gradient_end_color',
            [
                'label' => esc_html__('Gradient End Color', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'condition' => [
                    'show_typewrite_title' => 'yes',
                    'typewrite_gradient_enable' => 'yes',

                ],
            ]
        );

        $this->add_control(
            'typewrite_gradient_angle',
            [
                'label' => esc_html__('Gradient Angle', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['deg'],
                'range' => [
                    'deg' => [
                        'min' => 0,
                        'max' => 360,
                        'step' => 1,
                    ],
                ],
                'default' => [
                    'unit' => 'deg',
                    'size' => 90,
                ],
                'condition' => [
                    'show_typewrite_title' => 'yes',
                    'typewrite_gradient_enable' => 'yes',

                ],
            ]
        );
        $this->add_responsive_control(
            'typewirte_text_color',
            [
                'label'       => esc_html__('Color', 'topper-pack'),
                'type'        => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .topppa-section-title .topppa-section-wrap' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .topppa-section-title .topppa-section-cursor' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'typewrite_gradient_enable!' => 'yes',
                    'show_typewrite_title' => 'yes',

                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name'     => 'typewirte_text_bg',
                'label'    => esc_html__('Background', 'topper-pack'),
                'types'    => ['classic', 'gradient', 'video'],
                'selector' => '{{WRAPPER}} .topppa-section-title .topppa-section-typewrite',
                'condition' => [
                    'show_typewrite_title' => 'yes',

                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name'     => 'typewirte_text_border',
                'label'    => esc_html__('Border', 'topper-pack'),
                'selector' => '{{WRAPPER}} .topppa-section-title .topppa-section-typewrite',
                'condition' => [
                    'show_typewrite_title' => 'yes',

                ],
            ]
        );
        $this->add_responsive_control(
            'typewirte_text_border_radius',
            [
                'label'      => esc_html__('Border Radius', 'topper-pack'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .topppa-section-title .topppa-section-typewrite' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'show_typewrite_title' => 'yes',

                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'typewirte_text_shadow',
                'label'    => esc_html__('Box Shadow', 'topper-pack'),
                'selector' => '{{WRAPPER}} .topppa-section-title .topppa-section-wrap',
                'condition' => [
                    'show_typewrite_title' => 'yes',

                ],
            ]
        );
        $this->end_controls_section();

        $this->start_controls_section(
            'description_options',
            [
                'label' => esc_html__('Description Style', 'topper-pack'),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
                'condition' => [
                    'enable_description' => 'yes',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'dec_typo',
                'label' => esc_html__('Typography', 'topper-pack'),
                'selector' => '{{WRAPPER}} .topppa-section-description',
            ]
        );
        $this->add_responsive_control(
            'dec_color',
            [
                'label' => esc_html__('Color', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .topppa-section-description' => 'color: {{VALUE}}',
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
                    '{{WRAPPER}} .topppa-section-description' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                    '{{WRAPPER}} .topppa-section-description' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
        $allowed_html = wp_kses_allowed_html('post');
        unset($allowed_html['script'], $allowed_html['iframe'], $allowed_html['div'], $allowed_html['p']);
        $style_classes = [
            'icon' => 'icons',
            'line' => 'line',
        ];
        $class = isset($settings['select_separator']) && isset($style_classes[$settings['select_separator']])
            ? $style_classes[$settings['select_separator']]
            : '';

        // multiple shadow
        if ('yes' === $settings['enable_double_shadow']) {

            $shadow1 = $settings['shadow1'];
            $shadow2 = $settings['shadow2'];

            $css_shadow1 = "{$shadow1['horizontal']}px {$shadow1['vertical']}px {$shadow1['blur']}px {$shadow1['spread']}px {$shadow1['color']}";
            $css_shadow2 = "{$shadow2['horizontal']}px {$shadow2['vertical']}px {$shadow2['blur']}px {$shadow2['spread']}px {$shadow2['color']}";

            $box_shadow = $css_shadow1 . ', ' . $css_shadow2;
        } else {
            $box_shadow = 'none';
        }

        $effect_class = !empty($settings['text_effect']) ? 'effect-' . esc_attr($settings['text_effect']) : '';
        $gradient_class = '';
        $strong_gradient_class = '';

        // Data attributes and extra wrapper classes for JS-driven dynamic styles
        $data_attrs = '';
        $wrapper_extra_class = '';

        if ('gradient' === $settings['text_effect']) {
            $gradient_start = !empty($settings['gradient_start_color']) ? esc_attr($settings['gradient_start_color']) : '';
            $gradient_end = !empty($settings['gradient_end_color']) ? esc_attr($settings['gradient_end_color']) : '';
            $gradient_type = !empty($settings['gradient_type']) ? esc_attr($settings['gradient_type']) : 'linear';
            $gradient_angle = !empty($settings['gradient_angle']['size']) ? esc_attr($settings['gradient_angle']['size']) : '180';
            $start_location = !empty($settings['gradient_start_location']['size']) ? esc_attr($settings['gradient_start_location']['size']) : '0';
            $end_location = !empty($settings['gradient_end_location']['size']) ? esc_attr($settings['gradient_end_location']['size']) : '100';

            if (!empty($gradient_start) && !empty($gradient_end)) {
                $gradient_class = 'topppa-gradient-text topppa-gradient-' . $gradient_type;

                $unique_class = 'topppa-gradient-' . md5(esc_attr($gradient_start) . esc_attr($gradient_end) . esc_attr($gradient_angle) . esc_attr($start_location) . esc_attr($end_location));
                $gradient_class .= ' ' . esc_attr($unique_class);

                // Add data attributes for JS to create stylesheet rules
                $data_attrs .= ' data-gradient="yes"';
                $data_attrs .= ' data-gradient-class="' . esc_attr($unique_class) . '"';
                $data_attrs .= ' data-gradient-start="' . esc_attr($gradient_start) . '"';
                $data_attrs .= ' data-gradient-end="' . esc_attr($gradient_end) . '"';
                $data_attrs .= ' data-gradient-type="' . esc_attr($gradient_type) . '"';
                $data_attrs .= ' data-gradient-angle="' . esc_attr($gradient_angle) . '"';
                $data_attrs .= ' data-gradient-start-loc="' . esc_attr($start_location) . '"';
                $data_attrs .= ' data-gradient-end-loc="' . esc_attr($end_location) . '"';
            }
        }

        // Handle strong tag gradient
        if ('gradient' === $settings['strong_gradient_effect']) {
            $strong_gradient_start = !empty($settings['strong_gradient_start_color']) ? esc_attr($settings['strong_gradient_start_color']) : '';
            $strong_gradient_end = !empty($settings['strong_gradient_end_color']) ? esc_attr($settings['strong_gradient_end_color']) : '';
            $strong_gradient_type = !empty($settings['strong_gradient_type']) ? esc_attr($settings['strong_gradient_type']) : 'linear';
            $strong_gradient_angle = !empty($settings['strong_gradient_angle']['size']) ? esc_attr($settings['strong_gradient_angle']['size']) : '180';
            $strong_start_location = !empty($settings['strong_gradient_start_location']['size']) ? esc_attr($settings['strong_gradient_start_location']['size']) : '0';
            $strong_end_location = !empty($settings['strong_gradient_end_location']['size']) ? esc_attr($settings['strong_gradient_end_location']['size']) : '100';

            if (!empty($strong_gradient_start) && !empty($strong_gradient_end)) {
                $strong_gradient_class = 'topppa-strong-gradient topppa-strong-gradient-' . esc_attr($strong_gradient_type);

                $unique_strong_class = 'topppa-strong-gradient-' . md5(esc_attr($strong_gradient_start) . esc_attr($strong_gradient_end) . esc_attr($strong_gradient_angle) . esc_attr($strong_start_location) . esc_attr($strong_end_location));
                $strong_gradient_class .= ' ' . esc_attr($unique_strong_class);

                // Add data attributes for JS-driven strong gradient
                $data_attrs .= ' data-strong-gradient="yes"';
                $data_attrs .= ' data-strong-gradient-class="' . esc_attr($unique_strong_class) . '"';
                $data_attrs .= ' data-strong-gradient-start="' . esc_attr($strong_gradient_start) . '"';
                $data_attrs .= ' data-strong-gradient-end="' . esc_attr($strong_gradient_end) . '"';
                $data_attrs .= ' data-strong-gradient-type="' . esc_attr($strong_gradient_type) . '"';
                $data_attrs .= ' data-strong-gradient-angle="' . esc_attr($strong_gradient_angle) . '"';
                $data_attrs .= ' data-strong-gradient-start-loc="' . esc_attr($strong_start_location) . '"';
                $data_attrs .= ' data-strong-gradient-end-loc="' . esc_attr($strong_end_location) . '"';
            }
        } elseif ('image' === $settings['strong_gradient_effect'] && !empty($settings['strong_image']['url'])) {
            $strong_image_class = 'topppa-strong-image';
            $image_url = $settings['strong_image']['url'];

            // Use data attribute for JS to set background image
            $data_attrs .= ' data-strong-image-url="' . esc_url($image_url) . '"';
        }

        // Handle subtitle (small title) gradient text
        $subtitle_gradient_class = '';
        if ('gradient' === ($settings['subtitle_text_effect'] ?? 'none')) {
            $sub_start = !empty($settings['subtitle_gradient_start_color']) ? esc_attr($settings['subtitle_gradient_start_color']) : '';
            $sub_end = !empty($settings['subtitle_gradient_end_color']) ? esc_attr($settings['subtitle_gradient_end_color']) : '';
            $sub_type = !empty($settings['subtitle_gradient_type']) ? esc_attr($settings['subtitle_gradient_type']) : 'linear';
            $sub_angle = !empty($settings['subtitle_gradient_angle']['size']) ? esc_attr($settings['subtitle_gradient_angle']['size']) : '180';
            $sub_start_loc = !empty($settings['subtitle_gradient_start_location']['size']) ? esc_attr($settings['subtitle_gradient_start_location']['size']) : '0';
            $sub_end_loc = !empty($settings['subtitle_gradient_end_location']['size']) ? esc_attr($settings['subtitle_gradient_end_location']['size']) : '100';

            if (!empty($sub_start) && !empty($sub_end)) {
                $subtitle_gradient_class = 'topppa-subtitle-gradient topppa-subtitle-gradient-' . $sub_type;
                $unique_sub_class = 'topppa-subtitle-gradient-' . md5(esc_attr($sub_start) . esc_attr($sub_end) . esc_attr($sub_angle) . esc_attr($sub_start_loc) . esc_attr($sub_end_loc));
                $subtitle_gradient_class .= ' ' . esc_attr($unique_sub_class);

                $data_attrs .= ' data-sub-gradient="yes"';
                $data_attrs .= ' data-sub-gradient-class="' . esc_attr($unique_sub_class) . '"';
                $data_attrs .= ' data-sub-start="' . esc_attr($sub_start) . '"';
                $data_attrs .= ' data-sub-end="' . esc_attr($sub_end) . '"';
                $data_attrs .= ' data-sub-type="' . esc_attr($sub_type) . '"';
                $data_attrs .= ' data-sub-angle="' . esc_attr($sub_angle) . '"';
                $data_attrs .= ' data-sub-start-loc="' . esc_attr($sub_start_loc) . '"';
                $data_attrs .= ' data-sub-end-loc="' . esc_attr($sub_end_loc) . '"';
            }
        }

        // Add typewrite gradient data attributes early so JS can read them from the wrapper
        if (function_exists('topppa_can_use_premium_features') && topppa_can_use_premium_features() && 'yes' === ($settings['show_typewrite_title'] ?? 'no') && !empty($settings['typewrite_text']) && ($settings['typewrite_gradient_enable'] ?? '') === 'yes') {
            $typewrite_gradient_start = !empty($settings['typewrite_gradient_start_color']) ? esc_attr($settings['typewrite_gradient_start_color']) : '';
            $typewrite_gradient_end = !empty($settings['typewrite_gradient_end_color']) ? esc_attr($settings['typewrite_gradient_end_color']) : '';
            $typewrite_gradient_angle = !empty($settings['typewrite_gradient_angle']['size']) ? esc_attr($settings['typewrite_gradient_angle']['size']) : '90';

            if (!empty($typewrite_gradient_start) && !empty($typewrite_gradient_end)) {
                $data_attrs .= ' data-typewrite-gradient="yes"';
                $data_attrs .= ' data-typewrite-gradient-start="' . esc_attr($typewrite_gradient_start) . '"';
                $data_attrs .= ' data-typewrite-gradient-end="' . esc_attr($typewrite_gradient_end) . '"';
                $data_attrs .= ' data-typewrite-gradient-angle="' . esc_attr($typewrite_gradient_angle) . '"';
            }
        }

?>
        <div class="topppa-section-title-wrapper<?php echo !empty($wrapper_extra_class) ? esc_attr($wrapper_extra_class) : ''; ?>" <?php echo $data_attrs; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
                                                                                                                                    ?>>
            <div class="topppa-section-title-content">
                <?php if (!empty($settings['stitle']) && ('yes' === $settings['enable_small_title'])) : ?>
                    <div class="topppa-section-small-title <?php echo esc_attr($class); ?> <?php echo esc_attr($subtitle_gradient_class ?? ''); ?>" style="box-shadow: <?php echo esc_attr($box_shadow); ?>;">
                        <?php if (isset($settings['ricon']) && !empty($settings['ricon']['value'])) : ?>
                            <span class="separator-icon"><?php \Elementor\Icons_Manager::render_icon($settings['ricon'], ['aria-hidden' => 'true']); ?>
                            </span>
                        <?php endif; ?>
                        <?php echo esc_html($settings['stitle']); ?>
                        <?php if (isset($settings['licon']) && !empty($settings['licon']['value'])) : ?>
                            <span class="separator-icon">
                                <?php \Elementor\Icons_Manager::render_icon($settings['licon'], ['aria-hidden' => 'true']); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- Already escaped by elementor 
                                ?>
                            </span>
                        <?php endif; ?>
                    </div>
                <?php endif ?>
                <?php if (!empty($settings['title']) && ('yes' === $settings['enable_title'])) : ?>
                    <<?php echo esc_attr($settings['title_tag'] ?? 'h2'); ?> class="topppa-section-title <?php echo esc_attr($effect_class); ?> <?php echo esc_attr($gradient_class); ?>">
                        <?php
                        if (!empty($settings['title'])) {
                            $title_content = $settings['title'];

                            // If strong gradient is enabled, wrap strong tags with a span
                            if ('gradient' === $settings['strong_gradient_effect'] && !empty($strong_gradient_class)) {
                                $title_content = preg_replace(
                                    '/<strong>(.*?)<\/strong>/',
                                    '<strong class="' . esc_attr($strong_gradient_class) . '">$1</strong>',
                                    $title_content
                                );
                            } elseif ('image' === $settings['strong_gradient_effect'] && !empty($settings['strong_image']['url'])) {
                                $title_content = preg_replace(
                                    '/<strong>(.*?)<\/strong>/',
                                    '<strong class="topppa-strong-image">$1</strong>',
                                    $title_content
                                );
                            }

                            echo wp_kses($title_content, $allowed_html);
                        }
                        ?>
                        <?php if (topppa_can_use_premium_features() && 'yes' === ($settings['show_typewrite_title'] ?? 'no') && !empty($settings['typewrite_text'])) : ?>
                            <?php
                            $typewrite_texts = array_map(function ($item) {
                                return $item['text'];
                            }, $settings['typewrite_text']);
                            $has_multiple_items = count($typewrite_texts) > 1;

                            // Typewrite gradient attributes are handled earlier so JS can access them on the wrapper
                            ?>
                            <span class="topppa-section-typewrite"
                                data-period="<?php echo esc_attr($settings['typewrite_delay'] ?? 2000); ?>"
                                data-speed="<?php echo esc_attr($settings['typewrite_speed'] ?? 100); ?>"
                                data-cursor="<?php echo esc_attr($has_multiple_items ? $settings['typewrite_cursor'] : ''); ?>"
                                data-type='<?php echo esc_attr(json_encode($typewrite_texts));
                                            ?>'>
                                <div class="topppa-section-wrap"
                                    data-typewrite-wrap-gradient="yes"
                                    data-typewrite-wrap-gradient-start="<?php echo esc_attr(!empty($settings['typewrite_gradient_start_color']) ? $settings['typewrite_gradient_start_color'] : ''); ?>"
                                    data-typewrite-wrap-gradient-end="<?php echo esc_attr(!empty($settings['typewrite_gradient_end_color']) ? $settings['typewrite_gradient_end_color'] : ''); ?>"
                                    data-typewrite-wrap-gradient-angle="<?php echo esc_attr(!empty($settings['typewrite_gradient_angle']['size']) ? $settings['typewrite_gradient_angle']['size'] : '90'); ?>"></div>
                            </span>
                        <?php endif; ?>
                    </<?php echo esc_attr($settings['title_tag'] ?? 'h2'); ?>>
                <?php endif; ?>

                <?php if (!empty($settings['description']) && $settings['enable_description'] == 'yes') : ?>
                    <div class="topppa-section-description">
                        <?php echo wp_kses($settings['description'], $allowed_html); ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
<?php
    }

    public function get_script_depends() {
        return ['topppa-heading-widget'];
    }

    public function get_style_depends() {
        return ['topppa-heading-widget'];
    }
}
