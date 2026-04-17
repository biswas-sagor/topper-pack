<?php

use \TopperPack\Includes\Controls\Controls_Manager as TopperPack_Controls_Manager;
use \TopperPack\Includes\Utilities;

if (! defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

/**
 * Elementor topppa Social Widget.
 *
 * Elementor widget that inserts an embbedable content into the page, from any given URL.
 *
 * @since 1.0.0
 */
class TOPPPA_Timeline_Widget extends \Elementor\Widget_Base {

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
        return 'topppa_timeline_widget';
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
        return TOPPPA_EPWB . esc_html__('Timeline', 'topper-pack');
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
        return 'eicon-time-line';
    }

    /**
     * Get widget categories.
     *
     * Retrieve the list of categories the Social widget belongs to.
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
     * Retrieve the list of keywords the Social widget belongs to.
     *
     * @since 1.0.0
     * @access public
     * @return array Widget keywords.
     */
    public function get_keywords() {
        return ['topppa', 'widget', 'timeline', 'topperpack'];
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
        return 'https://doc.topperpack.com/docs/timeline-widgets/timeline/';
    }

    public function topppa_timeline_animation($repeater) {
        $repeater->add_control(
            'select_animation',
            [
                'label' => esc_html__('Animation', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'none',
                'options' => [
                    'none' => esc_html__('None', 'topper-pack'),
                    'animate-left' => esc_html__('Left', 'topper-pack'),
                    'animate-right' => esc_html__('Right', 'topper-pack'),
                    'pro-bottom' => esc_html__('Bottom(Pro)', 'topper-pack'),
                    'pro-fade' => esc_html__('Fade(Pro)', 'topper-pack'),
                    'pro-zoom' => esc_html__('Zoom(Pro)', 'topper-pack'),
                    'pro-rotate' => esc_html__('Rotate(Pro)', 'topper-pack'),
                    'pro-flip' => esc_html__('Flip(Pro)', 'topper-pack'),
                    'pro-scale' => esc_html__('Scale(Pro)', 'topper-pack'),
                    'pro-bounce' => esc_html__('Bounce(Pro)', 'topper-pack'),
                ],
            ]
        );
        Utilities::upgrade_pro_notice(
            $repeater,
            \Elementor\Controls_Manager::RAW_HTML,
            'topppa_timeline_widget',
            'select_animation',
            ['pro-bottom', 'pro-fade', 'pro-zoom', 'pro-rotate', 'pro-flip', 'pro-scale', 'pro-bounce']
        );
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
        return 'https://topperpack.com/assets/widgets/timeline-widget/';
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
        $base_url = $this->get_custom_image_url();
        // Content Section
        $this->start_controls_section(
            'topppa_content_style',
            [
                'label' => esc_html__('Timeline Styles', 'topper-pack'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
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
                        'imagelarge' => $base_url . 'style-3.png',
                        'imagesmall' => $base_url . 'style-3.png',
                        'width' => '100%',
                    ],
                    'style_four' => [
                        'title' => esc_html__('Style 4', 'topper-pack'),
                        'imagelarge' => $base_url . 'style-3.png',
                        'imagesmall' => $base_url . 'style-3.png',
                        'width' => '100%',
                    ],
                    'style_five' => [
                        'title' => esc_html__('Style 5', 'topper-pack'),
                        'imagelarge' => $base_url . 'style-3.png',
                        'imagesmall' => $base_url . 'style-3.png',
                        'width' => '100%',
                    ],

                ],
            ]
        );
        $this->end_controls_section();
        $this->start_controls_section(
            'content_section',
            [
                'label' => esc_html__('Timeline Content', 'topper-pack'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new \Elementor\Repeater();
        $this->topppa_timeline_animation($repeater);

        $repeater->add_control(
            'tl_icon',
            [
                'label' => esc_html__('Timeline Icon', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::ICONS,
            ]
        );
        $repeater->add_control(
            'enable_image',
            [
                'label' => esc_html__('Enable Image', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', 'topper-pack'),
                'label_off' => esc_html__('Hide', 'topper-pack'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $repeater->add_control(
            'image',
            [
                'label' => esc_html__('Image', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'condition' => [
                    'enable_image' => 'yes',
                ],
            ]
        );
        $repeater->add_control(
            'badge_text',
            [
                'label' => esc_html__('Badge Text', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('2024', 'topper-pack'),
            ]
        );

        $repeater->add_control(
            'title',
            [
                'label' => esc_html__('Title', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Timeline Title', 'topper-pack'),
                'label_block' => true,
            ]
        );
        $repeater->add_control(
            'description',
            [
                'label'      => esc_html__('Description', 'topper-pack'),
                'type'       => \Elementor\Controls_Manager::WYSIWYG,
                'show_label' => false,
                'default' => esc_html__('Timeline description goes here...', 'topper-pack'),
            ]
        );
        $repeater->add_control(
            'enable_content_button',
            [
                'label' => esc_html__('Enable Content Button', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', 'topper-pack'),
                'label_off' => esc_html__('Hide', 'topper-pack'),
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );
        $repeater->add_control(
            'enable_button',
            [
                'label' => esc_html__('Enable Button', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', 'topper-pack'),
                'label_off' => esc_html__('Hide', 'topper-pack'),
                'return_value' => 'yes',
                'default' => 'yes',
                'condition' => [
                    'enable_content_button' => 'yes',
                ]
            ]
        );
        $repeater->add_control(
            'button_text',
            [
                'label'       => esc_html__('Button Text', 'topper-pack'),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => esc_html__('Read More', 'topper-pack'),
                'label_block' => true,
                'condition'     => [
                    'enable_button' => 'yes',
                    'enable_content_button' => 'yes',
                ]
            ]
        );
        $repeater->add_control(
            'button_link',
            [
                'label'         => __('Link', 'topper-pack'),
                'type'          => \Elementor\Controls_Manager::URL,
                'placeholder'   => __('https://your-link.com', 'topper-pack'),
                'show_external' => true,
                'default'       => [
                    'url'         => '',
                    'is_external' => true,
                    'nofollow'    => true,
                ],
                'dynamic'       => [
                    'active' => true,
                ],
                'condition'     => [
                    'enable_button' => 'yes',
                    'enable_content_button' => 'yes',
                ],
            ]
        );
        $repeater->add_control(
            'btn_icon',
            [
                'label'   => esc_html__('Button Icon', 'topper-pack'),
                'type'    => \Elementor\Controls_Manager::ICONS,
                'default' => [
                    'value'   => 'fas fa-arrow-right',
                    'library' => 'fa-solid',
                ],
                'condition' => [
                    'enable_button' => 'yes',
                    'enable_content_button' => 'yes',
                ]
            ]
        );
        $repeater->add_control(
            'date',
            [
                'label' => esc_html__('Date', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('01.04.2025', 'topper-pack'),
                'placeholder' => esc_html__('01.04.2025', 'topper-pack'),
                'condition' => [
                    'enable_content_button' => 'yes',
                ]
            ]
        );
        $this->add_control(
            'timeline_items',
            [
                'label' => esc_html__('Timeline Items', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'badge_text' => esc_html__('One', 'topper-pack'),
                        'title' => esc_html__('Planning & Design', 'topper-pack'),
                        'description' => esc_html__('We bring your vision to life by coding, integrating, and testing features, ensuring performance, scalability, and security...', 'topper-pack'),
                    ],
                    [
                        'badge_text' => esc_html__('Two', 'topper-pack'),
                        'title' => esc_html__('Deployment & Maintenance', 'topper-pack'),
                        'description' => esc_html__('We bring your vision to life by coding, integrating, and testing features, ensuring performance, scalability, and security...', 'topper-pack'),
                    ],
                    [
                        'badge_text' => esc_html__('Three', 'topper-pack'),
                        'title' => esc_html__('Quality Assurance & Testing', 'topper-pack'),
                        'description' => esc_html__('We bring your vision to life by coding, integrating, and testing features, ensuring performance, scalability, and security..', 'topper-pack'),
                    ],
                ],
                'title_field' => '{{{ title }}}',
            ]
        );

        $this->end_controls_section();

        // Style Section - Timeline Line
        $this->start_controls_section(
            'section_style_line',
            [
                'label' => esc_html__('Timeline Line', 'topper-pack'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'line_bg_background',
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .topppa-timeline-wrapper.timeline-v3 .topppa-timeline-line,{{WRAPPER}} .topppa-timeline-wrapper.timeline-v5:before',
                'fields_options' => [
                    'background' => [
                        'label' => esc_html__('Line Background', 'topper-pack'),
                        'default' => 'classic',
                    ],
                ],
                'condition' => [
                    'topppa_content_select_styles' => ['style_three', 'style_five']
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'line_color',
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .topppa-timeline-wrapper ul li',
                'fields_options' => [
                    'background' => [
                        'label' => esc_html__('Line Background', 'topper-pack'),
                        'default' => 'classic',
                    ],
                ],
                'condition' => [
                    'topppa_content_select_styles' => ['style_one', 'style_two', 'style_four'],
                ],
            ]
        );

        $this->add_control(
            'line_width',
            [
                'label' => esc_html__('Line Width', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', 'rem'],
                'range' => [
                    'px' => [
                        'min' => 1,
                        'max' => 10,
                    ],
                    'rem' => [
                        'min' => 0.1,
                        'max' => 1,
                    ],
                ],
                'default' => [
                    'unit' => 'rem',
                ],
                'selectors' => [
                    '{{WRAPPER}} .topppa-timeline-wrapper ul li' => 'width: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .topppa-timeline-wrapper.timeline-v3 .topppa-timeline-line' => 'width: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'topppa_content_select_styles!' => ['style_five']
                ],
            ]
        );
        $this->add_control(
            'line_width_style_five',
            [
                'label' => esc_html__('Line Width', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', 'rem'],
                'range' => [
                    'px' => [
                        'min' => 1,
                        'max' => 10,
                    ],
                    'rem' => [
                        'min' => 0.1,
                        'max' => 1,
                    ],
                ],
                'default' => [
                    'unit' => 'rem',
                ],
                'selectors' => [
                    '{{WRAPPER}} .topppa-timeline-wrapper:before' => 'width: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'topppa_content_select_styles' => ['style_five']
                ],
            ]
        );

        $this->end_controls_section();

        // Style Section - Timeline Dots
        $this->start_controls_section(
            'section_style_dots',
            [
                'label' => esc_html__('Timeline Dots', 'topper-pack'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                'condition' => [
                    'topppa_content_select_styles' => ['style_one', 'style_two', 'style_four', 'style_five'],
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'dot_color',
                'types' => ['classic', 'gradient', 'video'],
                'selector' => '{{WRAPPER}} .topppa-timeline-wrapper ul li:before, {{WRAPPER}} .topppa-timeline-wrapper ul li:after',
            ]
        );
        $this->add_control(
            'dot_hover_color',
            [
                'label' => esc_html__('Dot Hover Color', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .topppa-timeline-wrapper ul li:hover:before' => 'background: {{VALUE}};',
                ],
                'condition' => [
                    'topppa_content_select_styles' => ['style_four'],
                ],
            ]
        );
        $this->add_control(
            'dot_size',
            [
                'label' => esc_html__('Dot Size', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', 'rem'],
                'range' => [
                    'px' => [
                        'min' => 8,
                        'max' => 50,
                    ],
                    'rem' => [
                        'min' => 0.5,
                        'max' => 3,
                    ],
                ],
                'default' => [
                    'unit' => 'rem',
                ],
                'selectors' => [
                    '{{WRAPPER}} .topppa-timeline-wrapper ul li:before' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'dot_border_width',
            [
                'label' => esc_html__('Line Width', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 150,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .topppa-timeline-wrapper ul li:after' => 'width: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'topppa_content_select_styles!' => ['style_four', 'style_five'],
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'dote_box_border',
                'selector' => '{{WRAPPER}} .topppa-timeline-wrapper ul li:before',
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'dote_box_shadow',
                'selector' => '{{WRAPPER}} .topppa-timeline-wrapper ul li:before',
            ]
        );
        $this->end_controls_section();
        $this->start_controls_section(
            'section_style_badge',
            [
                'label' => esc_html__('Badge Style', 'topper-pack'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                'condition' => [
                    'topppa_content_select_styles' => 'style_three',
                ],
            ]
        );
        $this->add_responsive_control(
            'topppa_badge_align',
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
                    '{{WRAPPER}} .topppa-timeline-wrapper.timeline-v3 .topppa-timeline-item .topppa-timeline-number' => 'justify-content: {{VALUE}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'topppa_badge_height',
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
                    '{{WRAPPER}} .topppa-timeline-wrapper.timeline-v3 .topppa-timeline-item .topppa-timeline-number' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'topppa_badge_width',
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
                    '{{WRAPPER}} .topppa-timeline-wrapper.timeline-v3 .topppa-timeline-item .topppa-timeline-number' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'inside_dot',
            [
                'label' => esc_html__('Inside Dot', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->add_responsive_control(
            'topppa_badge_inside_height',
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
                    '{{WRAPPER}} .topppa-timeline-wrapper.timeline-v3 .topppa-timeline-item .topppa-timeline-number::after' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'topppa_badge_inside_width',
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
                    '{{WRAPPER}} .topppa-timeline-wrapper.timeline-v3 .topppa-timeline-item .topppa-timeline-number::after' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'line_translate_x',
            [
                'label' => esc_html__('Line Translate X', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'vw'],
                'range' => [
                    'px' => [
                        'min' => -500,
                        'max' => 500,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => -100,
                        'max' => 100,
                        'step' => 1,
                    ],
                    'vw' => [
                        'min' => -100,
                        'max' => 100,
                        'step' => 1,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .topppa-timeline-wrapper.timeline-v3 .topppa-timeline-line' => 'transform: translateX({{SIZE}}{{UNIT}});',
                ],
            ]
        );


        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'topppa_timeline_number_typo',
                'label'    => esc_html__('Typography', 'topper-pack'),
                'selector' => '{{WRAPPER}} .topppa-timeline-wrapper.timeline-v3 .topppa-timeline-item .topppa-timeline-number',
            ]
        );
        $this->add_responsive_control(
            'topppa_timeline_number_color',
            [
                'label'     => esc_html__('Number Color', 'topper-pack'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .topppa-timeline-wrapper.timeline-v3 .topppa-timeline-item .topppa-timeline-number' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'topppa_badge_background',
                'label' => esc_html__('Background', 'topper-pack'),
                'types' => ['classic', 'gradient', 'video'],
                'selector' => '{{WRAPPER}} .topppa-timeline-wrapper.timeline-v3 .topppa-timeline-item .topppa-timeline-number',
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
                'name'     => 'topppa_badge_border',
                'label'    => esc_html__('Border', 'topper-pack'),
                'selector' => '{{WRAPPER}} .topppa-timeline-wrapper.timeline-v3 .topppa-timeline-item .topppa-timeline-number',
            ]
        );
        $this->add_responsive_control(
            'topppa_badge_border_radius',
            [
                'label'      => esc_html__('Border Radius', 'topper-pack'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .topppa-timeline-wrapper.timeline-v3 .topppa-timeline-item .topppa-timeline-number' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'topppa_badge_Margin',
            [
                'label'      => esc_html__('Margin', 'topper-pack'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .topppa-timeline-wrapper.timeline-v3 .topppa-timeline-item .topppa-timeline-number' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'topppa_badge_padding',
            [
                'label'      => esc_html__('Padding', 'topper-pack'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .topppa-timeline-wrapper.timeline-v3 .topppa-timeline-item .topppa-timeline-number' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        //dots styles
        $this->add_control(
            'badge_dots',
            [
                'label' => esc_html__('Badge Dots', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->add_responsive_control(
            'badge_dots_width',
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
                    '{{WRAPPER}} .topppa-timeline-wrapper.timeline-v3 .topppa-timeline-item .topppa-timeline-number::after' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'badge_dots_height',
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
                    '{{WRAPPER}} .topppa-timeline-wrapper.timeline-v3 .topppa-timeline-item .topppa-timeline-number::after' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'badge_dots_background',
                'types' => ['classic', 'gradient', 'video'],
                'selector' => '{{WRAPPER}} .topppa-timeline-wrapper.timeline-v3 .topppa-timeline-item .topppa-timeline-number::after',
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'badge_dots_border',
                'selector' => '{{WRAPPER}} .topppa-timeline-wrapper.timeline-v3 .topppa-timeline-item .topppa-timeline-number::after',
            ]
        );
        $this->add_responsive_control(
            'badge_dots_border_radius',
            [
                'label' => esc_html__('Border Radius', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .topppa-timeline-wrapper.timeline-v3 .topppa-timeline-item .topppa-timeline-number::after' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();

        // Style Section - Content Box
        $this->start_controls_section(
            'section_style_content',
            [
                'label' => esc_html__('Content Box', 'topper-pack'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        // Box Layout
        $this->add_responsive_control(
            'content_width',
            [
                'label' => esc_html__('Width', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'range' => [
                    'px' => [
                        'min' => 200,
                        'max' => 1000,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 10,
                        'max' => 100,
                    ],
                    'rem' => [
                        'min' => 10,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'unit' => 'rem',
                ],
                'selectors' => [
                    '{{WRAPPER}} .topppa-timeline-content' => 'width: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'topppa_content_select_styles' => ['style_one', 'style_two'],
                ],
            ]
        );
        $this->add_responsive_control(
            'content_box_position',
            [
                'label' => esc_html__('Content Box Even Position', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'range' => [
                    'px' => [
                        'min' => -1000, // Allow negative values for left positioning
                        'max' => 1000,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => -100, // Allow negative percentage values
                        'max' => 100,
                    ],
                    'rem' => [
                        'min' => -100, // Allow negative rem values
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'unit' => 'rem',
                ],
                'selectors' => [
                    '{{WRAPPER}} .topppa-timeline-wrapper ul li:nth-child(even) .topppa-timeline-content' => 'left: {{SIZE}}{{UNIT}};', // Apply dynamic left position
                ],
                'condition' => [
                    'topppa_content_select_styles' => ['style_one', 'style_two'],
                ],
            ]
        );
        $this->add_responsive_control(
            'margin_bottom',
            [
                'label' => esc_html__('Content Box Gap', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 800,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .topppa-timeline-wrapper.timeline-v3 .topppa-timeline-item' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .topppa-timeline-wrapper.timeline-v5 ul li' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'topppa_content_select_styles' => ['style_three', 'style_five']
                ],
            ]
        );

        $this->add_responsive_control(
            'content_alignment',
            [
                'label' => esc_html__('Content Alignment', 'topper-pack'),
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
                'selectors' => [
                    '{{WRAPPER}} .topppa-timeline-content' => 'text-align: {{VALUE}};',
                ],
            ]
        );
        // Border
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'content_border',
                'label' => esc_html__('Border', 'topper-pack'),
                'selector' => '{{WRAPPER}} .topppa-timeline-content',
            ]
        );

        // Border Radius
        $this->add_responsive_control(
            'content_border_radius',
            [
                'label' => esc_html__('Border Radius', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .topppa-timeline-content' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        // Padding
        $this->add_responsive_control(
            'content_padding',
            [
                'label' => esc_html__('Padding', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', 'rem', '%'],
                'selectors' => [
                    '{{WRAPPER}} .topppa-timeline-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        // Margin
        $this->add_responsive_control(
            'content_margin',
            [
                'label' => esc_html__('Margin', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', 'rem', '%'],
                'selectors' => [
                    '{{WRAPPER}} .topppa-timeline-content' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'content_hover_heading',
            [
                'label' => esc_html__('Hover Effects', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->start_controls_tabs('content_hover_tabs');

        // Normal State
        $this->start_controls_tab(
            'content_normal_tab',
            [
                'label' => esc_html__('Normal', 'topper-pack'),
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'content_normal_background',
                'types' => ['classic', 'gradient', 'video'],
                'selector' => '{{WRAPPER}} .topppa-timeline-content',
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'content_box_shadow',
                'label' => esc_html__('Box Shadow', 'topper-pack'),
                'selector' => '{{WRAPPER}} .topppa-timeline-content',
            ]
        );

        $this->end_controls_tab();

        // Hover State
        $this->start_controls_tab(
            'content_hover_tab',
            [
                'label' => esc_html__('Hover', 'topper-pack'),
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'content_hover_background',
                'types' => ['classic', 'gradient', 'video'],
                'selector' => '{{WRAPPER}} .topppa-timeline-wrapper ul li .topppa-timeline-content::after',
            ]
        );

        $this->add_control(
            'content_hover_border_color',
            [
                'label' => esc_html__('Border Color', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .topppa-timeline-content:hover' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'content_hover_box_shadow',
                'label' => esc_html__('Box Shadow', 'topper-pack'),
                'selector' => '{{WRAPPER}} .topppa-timeline-content:hover',
            ]
        );

        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();
        $this->start_controls_section(
            'section_style_optiona',
            [
                'label' => esc_html__('Content Style Option', 'topper-pack'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->start_controls_tabs('content_tabs');

        $this->start_controls_tab(
            'content_title_tab',
            [
                'label' => esc_html__('Title', 'topper-pack'),
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'label' => esc_html__('Typography', 'topper-pack'),
                'selector' => '{{WRAPPER}} .topppa-timeline-title',
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label' => esc_html__('Color', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .topppa-timeline-title' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'title_bg_hover_color',
            [
                'label' => esc_html__('Hover Color', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .topppa-timeline-wrapper ul li .topppa-timeline-content:hover .topppa-timeline-title' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'title_background',
                'types' => ['classic', 'gradient', 'video'],
                'selector' => '{{WRAPPER}} .topppa-timeline-title',
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'title_border',
                'selector' => '{{WRAPPER}} .topppa-timeline-title',
            ]
        );
        $this->add_responsive_control(
            'title_border_radius',
            [
                'label' => esc_html__('Border Radius', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .topppa-timeline-title' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'topppa_title_hover_styles',
            [
                'label' => esc_html__('Hover Style', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
                'condition' => [
                    'topppa_content_select_styles' => ['style_four'],
                ],
            ]
        );
        $this->add_control(
            'title_hover_color',
            [
                'label' => esc_html__('Color', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .topppa-timeline-content:hover .topppa-timeline-title' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'topppa_content_select_styles' => ['style_four'],
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'title_hover_background',
                'types' => ['classic', 'gradient', 'video'],
                'selector' => '{{WRAPPER}} .topppa-timeline-content:hover .topppa-timeline-title',
                'condition' => [
                    'topppa_content_select_styles' => ['style_four'],
                ],
            ]
        );
        $this->add_responsive_control(
            'title_padding',
            [
                'label' => esc_html__('Padding', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} .topppa-timeline-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator' => 'before',
            ]
        );
        $this->add_responsive_control(
            'title_margin',
            [
                'label' => esc_html__('Margin', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} .topppa-timeline-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_tab();

        // Hover State
        $this->start_controls_tab(
            'content_description_tab',
            [
                'label' => esc_html__('Description', 'topper-pack'),
            ]
        );
        $this->add_responsive_control(
            'description_width',
            [
                'label' => esc_html__('Width', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 800,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .topppa-timeline-wrapper.timeline-v3 .topppa-timeline-item .topppa-timeline-description' => 'max-width: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .topppa-timeline-wrapper .topppa-timeline-description' => 'max-width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'description_typography',
                'label' => esc_html__('Typography', 'topper-pack'),
                'selector' => '{{WRAPPER}} .topppa-timeline-description',
            ]
        );

        $this->add_control(
            'description_color',
            [
                'label' => esc_html__('Color', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .topppa-timeline-description' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'description_hcolor',
            [
                'label' => esc_html__('Hover Color', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .topppa-timeline-wrapper ul li .topppa-timeline-content:hover .topppa-timeline-description' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'description_border',
                'selector' => '{{WRAPPER}} .topppa-timeline-description',
            ]
        );
        $this->add_responsive_control(
            'description_padding',
            [
                'label' => esc_html__('Padding', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} .topppa-timeline-description' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'description_margin',
            [
                'label' => esc_html__('Margin', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} .topppa-timeline-description' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_tab();
        $this->start_controls_tab(
            'content_date_tab',
            [
                'label' => esc_html__('Date', 'topper-pack'),
                'condition' => [
                    'topppa_content_select_styles' => ['style_three'],
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'date_typo',
                'selector' => '{{WRAPPER}} .topppa-timeline-date',
            ]
        );
        $this->add_responsive_control(
            'date_color',
            [
                'label'     => esc_html__('Color', 'topper-pack'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .topppa-timeline-date' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_responsive_control(
            'date_margin',
            [
                'label'      => esc_html__('Margin', 'topper-pack'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .topppa-timeline-date' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'date_padding',
            [
                'label'      => esc_html__('Padding', 'topper-pack'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .topppa-timeline-date' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_tab();
        $this->start_controls_tab(
            'content_badge_tab',
            [
                'label' => esc_html__('Badge', 'topper-pack'),
                'condition' => [
                    'topppa_content_select_styles!' => ['style_three'],
                ],
            ]
        );
        $this->add_responsive_control(
            'badge_position',
            [
                'label' => esc_html__('Position', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    'static' => esc_html__('Static', 'topper-pack'),
                    'absolute' => esc_html__('Absolute', 'topper-pack'),
                    'relative' => esc_html__('Relative', 'topper-pack'),
                ],
                'selectors' => [
                    '{{WRAPPER}} .topppa-timeline-wrapper .topppa-timeline-badge' => 'position: {{VALUE}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'badge_left',
            [
                'label' => esc_html__('Left', 'topper-pack'),
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
                    '{{WRAPPER}} .topppa-timeline-wrapper .topppa-timeline-badge' => 'left: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'badge_position!' => 'static'
                ]
            ]
        );
        $this->add_responsive_control(
            'badge_right',
            [
                'label' => esc_html__('Right', 'topper-pack'),
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
                    '{{WRAPPER}} .topppa-timeline-wrapper .topppa-timeline-badge' => 'right: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'badge_position!' => 'static'
                ]
            ]
        );
        $this->add_responsive_control(
            'badge_top',
            [
                'label' => esc_html__('Top', 'topper-pack'),
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
                    '{{WRAPPER}} .topppa-timeline-wrapper .topppa-timeline-badge' => 'top: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'badge_position!' => 'static'
                ]
            ]
        );
        $this->add_responsive_control(
            'badge_bottom',
            [
                'label' => esc_html__('Bottom', 'topper-pack'),
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
                    '{{WRAPPER}} .topppa-timeline-wrapper .topppa-timeline-badge' => 'bottom: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'badge_position!' => 'static'
                ]
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'badge_typography',
                'label' => esc_html__('Typography', 'topper-pack'),
                'selector' => '{{WRAPPER}} .topppa-timeline-wrapper .topppa-timeline-badge',
            ]
        );
        $this->add_control(
            'badge_color',
            [
                'label' => esc_html__('Text Color', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .topppa-timeline-wrapper .topppa-timeline-badge' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'badge_hcolor',
            [
                'label' => esc_html__('Hover Color', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .topppa-timeline-wrapper ul li .topppa-timeline-content:hover .topppa-timeline-badge' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'badge_background',
                'types' => ['classic', 'gradient', 'video'],
                'selector' => '{{WRAPPER}} .topppa-timeline-wrapper .topppa-timeline-badge',
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'badge_border',
                'selector' => '{{WRAPPER}} .topppa-timeline-wrapper .topppa-timeline-badge',
            ]
        );
        $this->add_responsive_control(
            'badge_border_radius',
            [
                'label' => esc_html__('Border Radius', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .topppa-timeline-wrapper .topppa-timeline-badge' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'badge_shadow',
                'label'    => esc_html__('Box Shadow', 'topper-pack'),
                'selector' => '{{WRAPPER}} .topppa-timeline-wrapper .topppa-timeline-badge',
            ]
        );
        $this->add_control(
            'topppa_badge_hover_styles',
            [
                'label' => esc_html__('Hover Style', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
                'condition' => [
                    'topppa_content_select_styles' => ['style_four'],
                ],
            ]
        );
        $this->add_control(
            'badge_hover_color',
            [
                'label' => esc_html__('Color', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .topppa-timeline-content:hover .topppa-timeline-badge' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'topppa_content_select_styles' => ['style_four'],
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'badge_hover_background',
                'types' => ['classic', 'gradient', 'video'],
                'selector' => '{{WRAPPER}} .topppa-timeline-content:hover .topppa-timeline-badge',
                'condition' => [
                    'topppa_content_select_styles' => ['style_four'],
                ],
            ]
        );
        $this->add_responsive_control(
            'badge_padding',
            [
                'label' => esc_html__('Padding', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} .topppa-timeline-wrapper .topppa-timeline-badge' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator' => 'before',
            ]
        );
        $this->add_responsive_control(
            'badge_margin',
            [
                'label' => esc_html__('Margin', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} .topppa-timeline-wrapper .topppa-timeline-badge' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_tab();
        $this->start_controls_tab(
            'style_image_tab',
            [
                'label' => esc_html__('Image', 'topper-pack'),
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'label' => esc_html__('Image Background', 'topper-pack'),
                'name' => 'image_background',
                'types' => ['classic', 'gradient', 'video'],
                'selector' => '{{WRAPPER}} .topppa-timeline-wrapper.timeline-v3 .topppa-timeline-item .topppa-timeline-image-image,{{WRAPPER}} .topppa-timeline-wrapper ul li .topppa-timeline-content .topppa-timeline-image-image',

            ]
        );
        $this->add_responsive_control(
            'Image_height',
            [
                'label' => esc_html__('Height', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 800,
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
                    '{{WRAPPER}} .topppa-timeline-wrapper.timeline-v3 .topppa-timeline-item .topppa-timeline-image-image' => 'height: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .topppa-timeline-wrapper ul li .topppa-timeline-content .topppa-timeline-image-image' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'Image_width',
            [
                'label' => esc_html__('Width', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 800,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .topppa-timeline-wrapper.timeline-v3 .topppa-timeline-item .topppa-timeline-image-image' => 'width: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .topppa-timeline-wrapper ul li .topppa-timeline-content .topppa-timeline-image-image' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'min_Image_width',
            [
                'label' => esc_html__('Min Width', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 800,
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
                    '{{WRAPPER}} .topppa-timeline-wrapper.timeline-v3 .topppa-timeline-item .topppa-timeline-image-image' => 'min-width: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .topppa-timeline-wrapper ul li .topppa-timeline-content .topppa-timeline-image-image' => 'min-width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'image_object',
            [
                'label'     => esc_html__('Object Fit', 'topper-pack'),
                'type'      => \Elementor\Controls_Manager::SELECT,
                'default'   => 'cover',
                'options'   => [
                    'fill'    => esc_html__('Fill', 'topper-pack'),
                    'contain' => esc_html__('Contain', 'topper-pack'),
                    'cover'   => esc_html__('Cover', 'topper-pack'),
                    'none'    => esc_html__('none', 'topper-pack'),
                ],
                'selectors' => [
                    '{{WRAPPER}} .topppa-timeline-wrapper.timeline-v3 .topppa-timeline-item .topppa-timeline-image-image img' => 'object-fit: {{VALUE}}',
                    '{{WRAPPER}} .topppa-timeline-wrapper ul li .topppa-timeline-content .topppa-timeline-image-image img' => 'object-fit: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'image_border',
                'selector' => '{{WRAPPER}} .topppa-timeline-wrapper.timeline-v3 .topppa-timeline-item .topppa-timeline-image-image,{{WRAPPER}} .topppa-timeline-wrapper ul li .topppa-timeline-content .topppa-timeline-image-image',
            ]
        );
        $this->add_responsive_control(
            'image_border_radius',
            [
                'label' => esc_html__('Border Radius', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .topppa-timeline-wrapper.timeline-v3 .topppa-timeline-item .topppa-timeline-image-image' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .topppa-timeline-wrapper ul li .topppa-timeline-content .topppa-timeline-image-image' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'image_margin',
            [
                'label' => esc_html__('Margin', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .topppa-timeline-wrapper.timeline-v3 .topppa-timeline-item .topppa-timeline-image-image' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .topppa-timeline-wrapper ul li .topppa-timeline-content .topppa-timeline-image-image' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'image_padding',
            [
                'label' => esc_html__('Padding', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .topppa-timeline-wrapper.timeline-v3 .topppa-timeline-item .topppa-timeline-image-image' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .topppa-timeline-wrapper ul li .topppa-timeline-content .topppa-timeline-image-image' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();

        // <==========>
        // <=================> ICON STYLES <=================>
        $this->start_controls_section(
            'service_icon_style',
            [
                'label' => esc_html__('Icon', 'topper-pack'),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ],
        );

        $this->add_responsive_control(
            'service_icon_height',
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
                    '{{WRAPPER}} .topppa-timeline-wrapper ul li .topppa-timeline-content .timeline-icon' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ],
        );
        $this->add_responsive_control(
            'service_icon_width',
            [
                'label' => esc_html__('Width', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range' => [
                    'px' => [
                        'min' => 20,
                        'max' => 300,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .topppa-timeline-wrapper ul li .topppa-timeline-content .timeline-icon' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ],
        );
        $this->add_responsive_control(
            'service_icon_size',
            [
                'label' => esc_html__('Size', 'topper-pack'),
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
                    '{{WRAPPER}} .topppa-timeline-wrapper ul li .topppa-timeline-content .timeline-icon' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'service_icon_color',
            [
                'label'     => esc_html__('Icon Color', 'topper-pack'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .topppa-timeline-wrapper ul li .topppa-timeline-content .timeline-icon' => 'color: {{VALUE}}',
                ],
            ],
        );
        $this->add_responsive_control(
            'service_icon_hover_color',
            [
                'label'     => esc_html__('Hover Color', 'topper-pack'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .topppa-timeline-wrapper ul li .topppa-timeline-content:hover .timeline-icon' => 'color: {{VALUE}}',
                ],
            ],
        );
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'background',
                'types' => ['classic', 'gradient', 'video'],
                'selector' => '{{WRAPPER}} .topppa-timeline-wrapper ul li .topppa-timeline-content .timeline-icon',
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'hover_icon_background',
                'label' => esc_html__('Hover Background', 'topper-pack'),
                'types' => ['classic', 'gradient', 'video'],
                'selector' => '{{WRAPPER}} .topppa-timeline-wrapper ul li .topppa-timeline-content:hover .timeline-icon',
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
                'name'     => 'service_icon_border',
                'label'    => esc_html__('Border', 'topper-pack'),
                'selector' => '{{WRAPPER}} .topppa-timeline-wrapper ul li .topppa-timeline-content .timeline-icon',
            ],
        );
        $this->add_responsive_control(
            'service_icon_border_radius',
            [
                'label'      => esc_html__('Border Radius', 'topper-pack'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .topppa-timeline-wrapper ul li .topppa-timeline-content .timeline-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ],
        );
        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'service_icon_shadow',
                'selector' => '{{WRAPPER}} .topppa-timeline-wrapper ul li .topppa-timeline-content .timeline-icon',
            ],
        );
        $this->add_control(
            'svg_styles',
            [
                'label' => esc_html__('SVG Styles', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ],
        );
        $this->add_responsive_control(
            'service_svg_color',
            [
                'label' => esc_html__('Color', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .topppa-timeline-wrapper ul li .topppa-timeline-content .timeline-icon svg path' => 'fill: {{VALUE}}',
                ],
            ],
        );
        $this->add_responsive_control(
            'service_svg_hcolor',
            [
                'label' => esc_html__('Hover Color', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .topppa-timeline-wrapper ul li .topppa-timeline-content:hover .timeline-icon svg path' => 'fill: {{VALUE}}',
                ],
            ],
        );
        $this->add_responsive_control(
            'service_svg_height',
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
                    '{{WRAPPER}} .topppa-timeline-wrapper ul li .topppa-timeline-content .timeline-icon svg' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ],
        );
        $this->add_responsive_control(
            'service_svg_width',
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
                    '{{WRAPPER}} .topppa-timeline-wrapper ul li .topppa-timeline-content .timeline-icon svg' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ],
        );
        $this->end_controls_section();

        $this->start_controls_section(
            'content_bottom_style',
            [
                'label' => esc_html__('Content Bottom Style', 'topper-pack'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_responsive_control(
            'button_align',
            [
                'label' => esc_html__('Alignment', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'flex-start' => [
                        'title' => esc_html__('Left', 'topper-pack'),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__('Center', 'topper-pack'),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'flex-end' => [
                        'title' => esc_html__('Right', 'topper-pack'),
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .topppa-timeline-wrapper ul li .topppa-timeline-content .topppa-timeline-bottom-area' => 'justify-content: {{VALUE}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'content_bottom_margin',
            [
                'label' => esc_html__('Margin', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} .topppa-timeline-wrapper ul li .topppa-timeline-bottom-area' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'topppa_content_select_styles!' => ['style_three'],
                ],
            ]
        );
        $this->start_controls_tabs(
            'content_bottom_style_tabs'
        );

        $this->start_controls_tab(
            'content_bottom_style_Button_tab',
            [
                'label' => esc_html__('Button', 'topper-pack'),
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'topppa_btn_typo',
                'selector' => '{{WRAPPER}} .topppa-timeline-btn-wrap .topppa-timeline-btn',
            ]
        );

        $this->add_responsive_control(
            'topppa_btn_color',
            [
                'label'     => esc_html__('Color', 'topper-pack'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .topppa-timeline-btn-wrap .topppa-timeline-btn' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'topppa_btn_background',
                'types' => ['classic', 'gradient', 'video'],
                'selector' => '{{WRAPPER}} .topppa-timeline-btn-wrap .topppa-timeline-btn',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name'     => 'topppa_btn_border',
                'label'    => esc_html__('Border', 'topper-pack'),
                'selector' => '{{WRAPPER}} .topppa-timeline-btn-wrap .topppa-timeline-btn',
            ]
        );

        $this->add_responsive_control(
            'topppa_btn_border_radius',
            [
                'label'      => esc_html__('Border Radius', 'topper-pack'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .topppa-timeline-btn-wrap .topppa-timeline-btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'topppa_btn_box_shadow',
                'label'    => esc_html__('Shadow', 'topper-pack'),
                'selector' => '{{WRAPPER}} .topppa-timeline-btn-wrap .topppa-timeline-btn',
            ]
        );
        $this->add_control(
            'topppa_btn_hover_styles',
            [
                'label' => esc_html__('Hover Styles', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->add_responsive_control(
            'topppa_btn_color_hover',
            [
                'label'     => esc_html__('Color', 'topper-pack'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .topppa-timeline-btn-wrap .topppa-timeline-btn:hover' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'topppa_btn_background_hover',
                'types' => ['classic', 'gradient', 'video'],
                'selector' => '{{WRAPPER}} .topppa-timeline-btn-wrap .topppa-timeline-btn:hover',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name'     => 'topppa_btn_border_hover',
                'label'    => esc_html__('Border', 'topper-pack'),
                'selector' => '{{WRAPPER}} .topppa-timeline-btn-wrap .topppa-timeline-btn:hover',
            ]
        );

        $this->add_responsive_control(
            'topppa_btn_margin',
            [
                'label'      => esc_html__('Margin', 'topper-pack'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .topppa-timeline-btn-wrap .topppa-timeline-btn' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator' => 'before',
            ]
        );

        $this->add_responsive_control(
            'topppa_btn_padding',
            [
                'label'      => esc_html__('Padding', 'topper-pack'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .topppa-timeline-btn-wrap .topppa-timeline-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'content_bottom_style_date_tab',
            [
                'label' => esc_html__('Date', 'topper-pack'),
                'condition' => [
                    'topppa_content_select_styles!' => ['style_three'],
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'content_bottom_date_typo',
                'selector' => '{{WRAPPER}} .topppa-timeline-date',
            ]
        );
        $this->add_responsive_control(
            'content_bottom_date_color',
            [
                'label'     => esc_html__('Color', 'topper-pack'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .topppa-timeline-date' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_responsive_control(
            'content_bottom_date_margin',
            [
                'label'      => esc_html__('Margin', 'topper-pack'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .topppa-timeline-date' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'content_bottom_date_padding',
            [
                'label'      => esc_html__('Padding', 'topper-pack'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .topppa-timeline-date' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();
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
        $settings = $this->get_settings_for_display();
        $style_classes = [
            'style_one' => 'timeline-v1',
            'style_two' => 'timeline-v2',
            'style_three' => 'timeline-v3',
            'style_four' => 'timeline-v4',
            'style_five' => 'timeline-v5',
        ];
        $allowed_html = array(
            'span'  => array('style' => array()),
            'a'     => array(
                'href'   => array(),
                'target' => array(),
                'title'  => array(),
                'rel'    => array(),
            ),
            'ul' => array(),
            'ol' => array(),
            'li' => array(),
            'strong' => array(),
            'small'  => array(),
            'i'      => array(),
            'br'     => array(),
        );
        $class = isset($settings['topppa_content_select_styles']) && isset($style_classes[$settings['topppa_content_select_styles']])
            ? $style_classes[$settings['topppa_content_select_styles']]
            : '';
?>
        <div class="topppa-timeline-wrapper <?php echo esc_attr($class); ?>">
            <?php if ($settings['topppa_content_select_styles'] == 'style_one' || $settings['topppa_content_select_styles'] == 'style_two' || $settings['topppa_content_select_styles'] == 'style_four' || $settings['topppa_content_select_styles'] == 'style_five') : ?>
                <ul>
                    <?php foreach ($settings['timeline_items'] as $item) : ?>
                        <li>
                            <?php if ($settings['topppa_content_select_styles'] == 'style_five') : ?>
                                <?php if (!empty($item['badge_text'])) : ?>
                                    <div class="topppa-timeline-badge">
                                        <?php echo esc_html($item['badge_text']); ?>
                                    </div>
                                <?php endif; ?>
                            <?php endif; ?>
                            <div class="topppa-timeline-content <?php echo esc_attr($item['select_animation'] == 'none' ? '' : 'animation-box ' . $item['select_animation']); ?>">

                                <?php if (!empty($item['tl_icon']['value'])) : ?>
                                    <div class="timeline-icon">
                                        <?php \Elementor\Icons_Manager::render_icon($item['tl_icon'], ['aria-hidden' => 'true']); ?>
                                    </div>
                                <?php endif; ?>
                                <?php if ($settings['topppa_content_select_styles'] !== 'style_five') : ?>
                                    <?php if (!empty($item['badge_text'])) : ?>
                                        <span class="topppa-timeline-badge"><?php echo esc_html($item['badge_text']); ?></span>
                                    <?php endif; ?>
                                <?php endif; ?>

                                <?php if (!empty($item['title'])) : ?>
                                    <h3 class="topppa-timeline-title"><?php echo esc_html($item['title']); ?></h3>
                                <?php endif; ?>

                                <?php if (!empty($item['description'])) : ?>
                                    <div class="topppa-timeline-description">
                                        <?php echo wp_kses($item['description'], $allowed_html); ?>
                                    </div>
                                <?php endif; ?>
                                <?php if ($item['enable_image'] == 'yes') : ?>
                                    <?php if (!empty($item['image']['url'])) : ?>
                                        <div class="topppa-timeline-image-image">
                                            <?php echo wp_get_attachment_image($item['image']['id'], 'full', false, array(
                                                'alt' => esc_attr($item['title']),
                                            )); ?>
                                        </div>
                                    <?php endif; ?>
                                <?php endif; ?>
                                <?php if ($item['enable_content_button'] == 'yes') : ?>
                                    <div class="topppa-timeline-bottom-area">
                                        <?php if (!empty($item['date'])) : ?>
                                            <div class="topppa-timeline-date">
                                                <?php echo esc_html($item['date']); ?>
                                            </div>
                                        <?php endif; ?>
                                        <?php if ($item['enable_button'] === 'yes' && !empty($item['button_text'])) : ?>
                                            <div class="topppa-timeline-btn-wrap">
                                                <?php
                                                $target = $item['button_link']['is_external'] ? ' target="_blank"' : '';
                                                $nofollow = $item['button_link']['nofollow'] ? ' rel="nofollow"' : '';
                                                $custom_attr = !empty($item['button_link']['custom_attributes']) ? $item['button_link']['custom_attributes'] : '';
                                                ?>
                                                <a href="<?php echo esc_url($item['button_link']['url']); ?>" <?php echo esc_attr($target) . esc_attr($nofollow) . esc_attr($custom_attr); ?> class="topppa-timeline-btn">
                                                    <?php echo esc_html($item['button_text']); ?>
                                                    <?php if (!empty($item['btn_icon']['value'])) : ?>
                                                        <?php \Elementor\Icons_Manager::render_icon($item['btn_icon'], ['aria-hidden' => 'true']); ?>
                                                    <?php endif; ?>
                                                </a>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                <?php endif; ?>
                            </div>

                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>
            <?php if ($settings['topppa_content_select_styles'] == 'style_three') : ?>
                <div class="topppa-timeline-line"></div>
                <?php foreach ($settings['timeline_items'] as $item) : ?>
                    <div class="topppa-timeline-item animation-box <?php echo esc_attr($item['select_animation'] == 'none' ? '' : $item['select_animation']); ?>">
                        <?php if (!empty($item['badge_text'])) : ?>
                            <div class="topppa-timeline-number"><?php echo esc_html($item['badge_text']); ?></div>
                        <?php endif; ?>
                        <div class="topppa-timeline-content">
                            <?php if ($item['enable_content_button'] == 'yes') : ?>
                                <?php if (!empty($item['date'])) : ?>
                                    <div class="topppa-timeline-date">
                                        <?php echo esc_html($item['date']); ?>
                                    </div>
                                <?php endif; ?>
                            <?php endif; ?>
                            <?php if (!empty($item['title'])) : ?>
                                <h3 class="topppa-timeline-title"><?php echo esc_html($item['title']); ?></h3>
                            <?php endif; ?>
                            <?php if (!empty($item['description'])) : ?>
                                <div class="topppa-timeline-description">
                                    <?php echo wp_kses($item['description'], $allowed_html); ?>
                                </div>
                            <?php endif; ?>
                            <?php if ($item['enable_content_button'] == 'yes') : ?>
                                <div class="topppa-timeline-bottom-area">
                                    <?php if ($item['enable_button'] === 'yes' && !empty($item['button_text'])) : ?>
                                        <div class="topppa-timeline-btn-wrap">
                                            <?php
                                            $target = $item['button_link']['is_external'] ? ' target="_blank"' : '';
                                            $nofollow = $item['button_link']['nofollow'] ? ' rel="nofollow"' : '';
                                            $custom_attr = !empty($item['button_link']['custom_attributes']) ? $item['button_link']['custom_attributes'] : '';
                                            ?>
                                            <a href="<?php echo esc_url($item['button_link']['url']); ?>" <?php echo esc_attr($target) . esc_attr($nofollow) . esc_attr($custom_attr); ?> class="topppa-timeline-btn">
                                                <?php echo esc_html($item['button_text']); ?>
                                                <?php if (!empty($item['btn_icon']['value'])) : ?>
                                                    <?php \Elementor\Icons_Manager::render_icon($item['btn_icon'], ['aria-hidden' => 'true']); ?>
                                                <?php endif; ?>
                                            </a>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            <?php endif; ?>
                        </div>
                        <?php if ($item['enable_image'] == 'yes') : ?>
                            <?php if (!empty($item['image']['url'])) : ?>
                                <div class="topppa-timeline-image-image">
                                    <?php echo wp_get_attachment_image($item['image']['id'], 'full', false, array(
                                        'alt' => esc_attr($item['title']),
                                    )); ?>
                                </div>
                            <?php endif; ?>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
<?php
    }
}
