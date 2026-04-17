<?php

use \TopperPack\Includes\Controls\Controls_Manager as TopperPack_Controls_Manager;

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
class TOPPPA_Progress_Bar_Widget extends \Elementor\Widget_Base {

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
        return 'TOPPPA_Progress_Bar_Widget';
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
        return TOPPPA_EPWB . esc_html__('Progress Bar', 'topper-pack');
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
        return 'eicon-skill-bar';
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
        return ['topppa', 'widget', 'Progress Bar', 'skill', 'topperpack'];
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
        return 'https://doc.topperpack.com/docs/general-widgets/progress-bar/';
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
        return 'https://topperpack.com/assets/widgets/progress-bar-widget/';
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
        $base_url = $this->get_custom_image_url();
        $this->start_controls_section(
            'content_options',
            [
                'label' => esc_html__('Progress Bar Content', 'topper-pack'),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_control(
            'topppa_content_select_styles',
            [
                'label' => esc_html__('Choose Style', 'topper-pack'),
                'type' => TopperPack_Controls_Manager::IMAGECHOOSE,
                'default' => 'style_one',
                'options' => [
                    'style_one' => [
                        'title' => esc_html__('Style 1', 'topper-pack'),
                        'imagelarge' => $base_url . 'style-1.png',
                        'imagesmall' => $base_url . 'style-1.png',
                        'width' => '100%',
                    ],
                    'style_two' => [
                        'title' => esc_html__('Style 2', 'topper-pack'),
                        'imagelarge' => $base_url . 'style-2.png',
                        'imagesmall' => $base_url . 'style-2.png',
                        'width' => '100%',
                    ],
                    'style_three' => [
                        'title' => esc_html__('Style 3', 'topper-pack'),
                        'imagelarge' => $base_url . 'style-3.jpg',
                        'imagesmall' => $base_url . 'style-3.jpg',
                        'width' => '100%',
                    ],
                ],
            ]
        );
        $this->add_control(
            'title',
            [
                'label'       => __('Title', 'topper-pack'),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => 'Business Security',
                'label_block' => true,
            ]
        );
        $this->add_control(
            'percent',
            [
                'label' => __('Percentage', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['%'],
                'range' => [
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'unit' => '%',
                    'size' => 80,
                ],
            ]
        );
        $this->add_control(
            'number_position',
            [
                'label' => __('Number Position', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    'static' => __('Static', 'topper-pack'),
                    'moving' => __('Moving', 'topper-pack'),
                ],
                'default' => 'static',
                'description' => __('Select how the number should be positioned.', 'topper-pack'),
            ]
        );

        $this->end_controls_section();
        $this->start_controls_section(
            'skill_box_css',
            [
                'label' => esc_html__('Progress Bar', 'topper-pack'),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_responsive_control(
            'box_width',
            [
                'label' => esc_html__('Width', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range' => [
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'unit' => '%',
                ],
                'selectors' => [
                    '{{WRAPPER}} .topppa-skills-wrapper .skillbar-item' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'alignment',
            [
                'label' => __('Alignment', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => __('Left', 'topper-pack'),
                        'icon' => 'eicon-long-arrow-left',
                    ],
                    'right' => [
                        'title' => __('Right', 'topper-pack'),
                        'icon' => 'eicon-long-arrow-right',
                    ],
                ],
                'default' => 'left',
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .topppa-skills-wrapper .skillbar-item' => 'text-align: {{VALUE}}',
                ],
            ]
        );

        $this->add_responsive_control(
            'number_align',
            [
                'label' => __('Number Alignment', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => __('Left', 'topper-pack'),
                        'icon' => 'eicon-long-arrow-left',
                    ],
                    'right' => [
                        'title' => __('Right', 'topper-pack'),
                        'icon' => 'eicon-long-arrow-right',
                    ],
                ],
                'toggle' => true,
                'default' => 'left',
                'selectors_dictionary' => [
                    'left'  => 'left: 0;right:auto',
                    'right' => 'right:0',
                ],
                'selectors' => [
                    '{{WRAPPER}} .skillbar .skill-percent-count-wrap' => '{{VALUE}}',
                ],
                'condition' => [
                    'alignment' => 'right',
                ],
            ]
        );
        $this->add_responsive_control(
            'height_box',
            [
                'label' => esc_html__('Box Height', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
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
                    '{{WRAPPER}} .topppa-skills-wrapper .skillbar-item .skillbar' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'box_bg',
                'label' => esc_html__('Background', 'topper-pack'),
                'types' => ['classic', 'gradient', 'video'],
                'selector' => '{{WRAPPER}} .topppa-skills-wrapper .skillbar-item .skillbar',
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'box_shadow',
                'label' => esc_html__('Box Shadow', 'topper-pack'),
                'selector' => '{{WRAPPER}} .topppa-skills-wrapper .skillbar-item .skillbar',
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'box_border',
                'label' => esc_html__('Border', 'topper-pack'),
                'selector' => '{{WRAPPER}} .topppa-skills-wrapper .skillbar-item .skillbar',
            ]
        );
        $this->add_control(
            'inner_Progress_bar',
            [
                'label' => esc_html__('Inner Progress Bar', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'inner_box_color',
                'label' => esc_html__('Inner Box Color', 'topper-pack'),
                'types' => ['classic', 'gradient', 'video'],
                'selector' => '{{WRAPPER}} .topppa-skills-wrapper .skillbar-item .skillbar .count-bar',
                'fields_options' => [
                    'background' => [
                        'label' => esc_html__('Background', 'topper-pack'),
                        'default' => 'classic',
                    ],
                ],
            ]
        );
        $this->add_responsive_control(
            'box_border_radius',
            [
                'label'      => esc_html__('Border Radius', 'topper-pack'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'separator' => 'before',
                'selectors'  => [
                    '{{WRAPPER}} .topppa-skills-wrapper .skillbar-item .skillbar .count-bar' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .topppa-skills-wrapper .skillbar-item .skillbar' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                    '{{WRAPPER}} .topppa-skills-wrapper .skillbar-item .skillbar' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                    '{{WRAPPER}} .topppa-skills-wrapper .skillbar-item .skillbar' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();
        $this->start_controls_section(
            'skill_content_css',
            [
                'label' => esc_html__('Content', 'topper-pack'),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->start_controls_tabs(
            'skill_content_tab'
        );
        $this->start_controls_tab(
            'skill_title_tab',
            [
                'label' => __('Title', 'topper-pack'),
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'title_typo',
                'label' => esc_html__('Typography', 'topper-pack'),
                'selector' => '{{WRAPPER}}  .skill-title,{{WRAPPER}}  .topppa-skills-wrapper.progress-v2 .skillbar-item .skillbar span.skill-title',
            ]
        );
        $this->add_responsive_control(
            'title_color',
            [
                'label' => esc_html__('Title Color', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .skill-title' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .topppa-skills-wrapper.progress-v2 .skillbar-item .skillbar span.skill-title' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_responsive_control(
            'title_margin',
            [
                'label' => esc_html__('Margin', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .skill-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .topppa-skills-wrapper.progress-v2 .skillbar-item .skillbar span.skill-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'title_padding',
            [
                'label' => esc_html__('Padding', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .skill-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .topppa-skills-wrapper.progress-v2 .skillbar-item .skillbar span.skill-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_tab();

        $this->start_controls_tab(
            'skill_number_tab',
            [
                'label' => __('Number', 'topper-pack'),
                'condition' => [
                    'topppa_content_select_styles' => ['style_one', 'style_two']
                ]
            ]
        );
        $this->add_responsive_control(
            'number_color',
            [
                'label' => esc_html__('Number Color', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .skill-percent-count-wrap' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .count-bar span' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'number_tyoo',
                'label' => esc_html__('Typography', 'topper-pack'),
                'selector' => '{{WRAPPER}} .skill-percent-count-wrap,{{WRAPPER}} .count-bar span',
            ]
        );
        $this->add_responsive_control(
            'number_margin',
            [
                'label' => esc_html__('Margin', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .skill-percent-count-wrap' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .count-bar span' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'number_padding',
            [
                'label' => esc_html__('Padding', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .skill-percent-count-wrap' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .count-bar span' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_tab();

        // only for style three
        $this->start_controls_tab(
            'skill_number_tab_3',
            [
                'label' => __('Number', 'topper-pack'),
                'condition' => [
                    'topppa_content_select_styles' => 'style_three'
                ]
            ]
        );
        $this->add_responsive_control(
            'number_color_3',
            [
                'label' => esc_html__('Number Color', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .topppa-skills-wrapper.progress-v3 .skillbar-item .skillbar .count-bar span' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'number_tyoo_3',
                'label' => esc_html__('Typography', 'topper-pack'),
                'selector' => '{{WRAPPER}} .topppa-skills-wrapper.progress-v3 .skillbar-item .skillbar .count-bar span,{{WRAPPER}} .count-bar span',
            ]
        );
        $this->add_responsive_control(
            'number_margin_3',
            [
                'label' => esc_html__('Margin', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .topppa-skills-wrapper.progress-v3 .skillbar-item .skillbar .count-bar span' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'number_padding_3',
            [
                'label' => esc_html__('Padding', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .topppa-skills-wrapper.progress-v3 .skillbar-item .skillbar .count-bar span' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_tab();

        $this->start_controls_tab(
            'skill_percent_tab_3',
            [
                'label' => __('Percent', 'topper-pack'),
                'condition' => [
                    'topppa_content_select_styles' => 'style_three'
                ]
            ]
        );
        $this->add_responsive_control(
            'percent_color_3',
            [
                'label' => esc_html__('Color', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .topppa-skills-wrapper.progress-v3 .percent' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'percent_tyoo_3',
                'label' => esc_html__('Typography', 'topper-pack'),
                'selector' => '{{WRAPPER}} .topppa-skills-wrapper.progress-v3 .percent,{{WRAPPER}} .count-bar span',
            ]
        );
        $this->add_responsive_control(
            'percent_margin_3',
            [
                'label' => esc_html__('Margin', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .topppa-skills-wrapper.progress-v3 .percent' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'percent_padding_3',
            [
                'label' => esc_html__('Padding', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .topppa-skills-wrapper.progress-v3 .percent' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();

        // <==========>
        // <==========> BOX STYLES <==========>

        $this->start_controls_section(
            'number_box_styles',
            [
                'label' => esc_html__('Number Box', 'topper-pack'),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
                'condition' => [
                    'topppa_content_select_styles' => 'style_three'
                ]
            ]
        );
        $this->add_responsive_control(
            'number_box_width',
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
                    '{{WRAPPER}} .topppa-skills-wrapper.progress-v3 .skillbar .count-bar span::before' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'number_box_height',
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
                    '{{WRAPPER}} .topppa-skills-wrapper.progress-v3 .skillbar .count-bar span::before' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'number_box_bg',
                'label' => esc_html__('Background', 'topper-pack'),
                'types' => ['classic', 'gradient', 'video'],
                'selector' => '{{WRAPPER}} .topppa-skills-wrapper.progress-v3 .skillbar .count-bar span::before',
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'number_box_border',
                'label' => esc_html__('Border', 'topper-pack'),
                'selector' => '{{WRAPPER}} .topppa-skills-wrapper.progress-v3 .skillbar .count-bar span::before',
            ]
        );
        $this->add_responsive_control(
            'number_box_radius',
            [
                'label' => esc_html__('Border Radius', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .topppa-skills-wrapper.progress-v3 .skillbar .count-bar span::before' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'number_box_shadow',
                'label' => esc_html__('Box Shadow', 'topper-pack'),
                'selector' => '{{WRAPPER}} .topppa-skills-wrapper.progress-v3 .skillbar .count-bar span::before',
            ]
        );
        $this->add_responsive_control(
            'position_y',
            [
                'label' => esc_html__('Position Y', 'topper-pack'),
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
                'default' => [
                    'unit' => '%',
                    'size' => 50,
                ],
                'selectors' => [
                    '{{WRAPPER}} .topppa-skills-wrapper.progress-v3 .skillbar .count-bar span::before' => 'top: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'number_box_margin',
            [
                'label' => esc_html__('Margin', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .topppa-skills-wrapper.progress-v3 .skillbar .count-bar span::before' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'number_box_padding',
            [
                'label' => esc_html__('Padding', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .topppa-skills-wrapper.progress-v3 .skillbar .count-bar span::before' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
        // Your widget output here
        $style_classes = [
            'style_one' => '',
            'style_two' => 'progress-v2',
            'style_three' => 'progress-v2 progress-v3',
        ];

        $class = isset($settings['topppa_content_select_styles']) && isset($style_classes[$settings['topppa_content_select_styles']])
            ? $style_classes[$settings['topppa_content_select_styles']]
            : '';
?>
        <div class="topppa-skills-main-wrapper">
            <div class="topppa-skills-wrapper <?php echo esc_attr($class); ?>">
                <?php $unique_id = uniqid('skill_'); ?>
                <div class="skillbar-item" id="<?php echo esc_attr($unique_id); ?>">
                    <?php if ($settings['topppa_content_select_styles'] == 'style_one') : ?>
                        <div class="skill-title"><?php echo esc_html($settings['title']); ?></div>
                    <?php endif; ?>
                    <div class="skillbar" data-percent="<?php echo esc_attr($settings['percent']['size']); ?>%">
                        <?php if ($settings['topppa_content_select_styles'] == 'style_two') : ?>
                            <span class="skill-title">
                                <?php echo esc_html($settings['title']); ?>
                            </span>
                        <?php endif; ?>

                        <?php if ($settings['number_position'] == 'static') : ?>
                            <div class="skill-percent-count-wrap">
                                <span class="skill-percent-count"><?php echo esc_html($settings['percent']['size']); ?></span>%
                            </div>
                        <?php endif; ?>
                        <div class="count-bar">
                            <?php if ($settings['number_position'] == 'moving' && ($settings['topppa_content_select_styles'] !== 'style_three')) : ?>
                                <span> <?php echo esc_html($settings['percent']['size']); ?>%</span>
                            <?php endif; ?>

                            <?php if ($settings['topppa_content_select_styles'] == 'style_three') : ?>
                                <div class="count-wrapper">
                                    <span class="skill-percent-count"><?php echo esc_html($settings['percent']['size']); ?></span>
                                    <div class="percent">%</div>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script>
            (function($) {
                "use strict";
                $(document).ready(function() {
                    $(".skillbar-item").each(function() {
                        var $this = $(this);
                        var uniqueId = $this.attr("id"); // Unique ID সংগ্রহ

                        $("#" + uniqueId + " .skillbar").appear(function() {
                            $("#" + uniqueId + " .count-bar").animate({
                                width: $("#" + uniqueId + " .skillbar").attr("data-percent")
                            }, 3000);

                            // Counter animation for each unique skillbar
                            $("#" + uniqueId + " .skill-percent-count").prop('Counter', 0).animate({
                                Counter: $("#" + uniqueId + " .skill-percent-count").text()
                            }, {
                                duration: 3000,
                                easing: 'swing',
                                step: function(now) {
                                    $(this).text(Math.ceil(now));
                                }
                            });
                        });
                    });
                });
            })(jQuery);
        </script>
<?php
    }
}