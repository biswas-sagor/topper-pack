<?php

use \TopperPack\Includes\Controls\Controls_Manager as TopperPack_Controls_Manager;

if (! defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

/**
 * Elementor topppa Video Button Widget.
 *
 * Elementor widget that inserts an embbedable content into the page, from any given URL.
 *
 * @since 1.0.0
 */
class TOPPPA_Video_Button_Widget extends \Elementor\Widget_Base {

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
        return 'topppa_video_button';
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
        return TOPPPA_EPWB . esc_html__('Video Button', 'topper-pack');
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
        return 'eicon-play';
    }

    /**
     * Get widget categories.
     *
     * Retrieve the list of categories the Video Button widget belongs to.
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
     * Retrieve the list of keywords the Video Button widget belongs to.
     *
     * @since 1.0.0
     * @access public
     * @return array Widget keywords.
     */
    public function get_keywords() {
        return ['topppa', 'widget', 'video', 'button', 'topperpack'];
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
        return 'https://doc.topperpack.com/docs/video-button-widgets/video-button/';
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
        return 'https://topperpack.com/assets/widgets/video-button-widget/';
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
        $this->start_controls_section(
            'topper-pack_button_options',
            [
                'label' => esc_html__('Video Button', 'topper-pack'),
                'tab'    => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_control(
            'topppa_select_styles',
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
                        'title' => esc_html__('style 2', 'topper-pack'),
                        'imagelarge' => $base_url . 'style-2.png',
                        'imagesmall' => $base_url . 'style-2.png',
                        'width' => '100%',
                    ],
                    'style_three' => [
                        'title' => esc_html__('style 3', 'topper-pack'),
                        'imagelarge' => $base_url . 'style-3.png',
                        'imagesmall' => $base_url . 'style-3.png',
                        'width' => '100%',
                    ],
                ],
            ]
        );
        $this->add_control(
            'video_icon',
            [
                'label' => esc_html__('Icon', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::ICONS,
                'default' => [
                    'value' => 'fas fa-play',
                    'library' => 'fa-solid',
                ],
                'condition' => [
                    'topppa_select_styles' => ['style_one', 'style_three'],
                ],
            ]
        );
        $this->add_control(
            'video_link',
            [
                'label' => esc_html__('Link', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::URL,
                'default' => [
                    'url' => 'https://www.youtube.com/watch?v=GFR4DzS0vuo',
                    'is_external' => false,
                    'nofollow' => false,
                ],
                'label_block' => true,
            ]
        );
        $this->add_control(
            'image',
            [
                'label'   => esc_html__('Image', 'topper-pack'),
                'type'    => \Elementor\Controls_Manager::MEDIA,
                'condition' => [
                    'topppa_select_styles' => 'style_two',
                ],
            ]
        );
        $this->add_control(
            'button_text',
            [
                'label' => esc_html__('Button Text', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'placeholder' => esc_html__('Type your Button Text', 'topper-pack'),
                'default' => esc_html__('Watch The Video', 'topper-pack'),
                'label_block' => true,
            ]
        );
        $this->end_controls_section();

        $this->start_controls_section(
            'button_CSS_options',
            [
                'label' => esc_html__('Video Button CSS', 'topper-pack'),
                'tab'    => \Elementor\Controls_Manager::TAB_STYLE,
                'condition' => [
                    'topppa_select_styles' => 'style_one',
                ],
            ]

        );
        $this->add_responsive_control(
            'align',
            [
                'label' => __('Alignment', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => __('Left', 'topper-pack'),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => __('Center', 'topper-pack'),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title' => __('Right', 'topper-pack'),
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'default' => 'center',
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .topppa-video-icon-wrp' => 'text-align: {{VALUE}}',
                ],
            ]
        );
        $this->start_controls_tabs(
            'buttons_tabs'
        );
        $this->start_controls_tab(
            'buttons_tabs_normal',
            [
                'label' => __('Normal', 'topper-pack'),
            ]
        );
        $this->add_responsive_control(
            'video_icon_height',
            [
                'label' => esc_html__('Icon Height', 'topper-pack'),
                'type'  => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 300,
                        'step' => 1,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .topppa-video-icon-wrp .topppa-play-icon' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'video_icon_width',
            [
                'label' => esc_html__('Icon Width', 'topper-pack'),
                'type'  => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 300,
                        'step' => 1,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .topppa-video-icon-wrp .topppa-play-icon' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'video_icon_svg_size',
            [
                'label' => esc_html__('Icon SVG Size', 'topper-pack'),
                'type'  => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 300,
                        'step' => 1,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .topppa-video-icon-wrp .topppa-play-icon svg' => 'width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'buttons_Css_typos',
                'label' => esc_html__('Typography', 'topper-pack'),
                'selector' => '{{WRAPPER}} .topppa-video-icon-wrp .topppa-play-icon',
            ]
        );
        $this->add_responsive_control(
            'buttons_Css_ncolor',
            [
                'label' => esc_html__('Color', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .topppa-video-icon-wrp .topppa-play-icon' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .topppa-video-icon-wrp .topppa-play-icon svg path' => 'fill: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'buttons_Css_video_bg',
                'types' => ['classic', 'gradient', 'video'],
                'selector' => '{{WRAPPER}} .topppa-video-icon-wrp .topppa-play-icon',
            ]
        );
        $this->add_responsive_control(
            'buttons_css_blur',
            [
                'label'      => esc_html__('Background Blur', 'topper-pack'),
                'type'       => \Elementor\Controls_Manager::SLIDER,
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
                'selectors'  => [
                    '{{WRAPPER}} .topppa-video-icon-wrp .topppa-play-icon' => 'backdrop-filter: blur({{SIZE}}{{UNIT}});',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'buttons_Css_nborder',
                'label' => esc_html__('Border', 'topper-pack'),
                'selector' => '{{WRAPPER}} .topppa-video-icon-wrp .topppa-play-icon',
            ]
        );

        $this->add_responsive_control(
            'buttons_Css_nradisu',
            [
                'label' => esc_html__('Border Radius', 'topper-pack'),
                'type'  => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .topppa-video-icon-wrp .topppa-play-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .topppa-video-icon-wrp .topppa-play-icon:before' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .topppa-video-icon-wrp .topppa-play-icon:after' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'buttons_Css_nshadow',
                'label' => esc_html__('Shadow', 'topper-pack'),
                'selector' => '{{WRAPPER}} .topppa-video-icon-wrp .topppa-play-icon',
            ]
        );
        $this->end_controls_tab();

        $this->start_controls_tab(
            'buttons_tabs_hover',
            [
                'label' => __('Hover', 'topper-pack'),
            ]
        );
        $this->add_responsive_control(
            'buttons_Css_hcolor',
            [
                'label' => esc_html__('Color', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .topppa-video-icon-wrp .topppa-play-icon:hover' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .topppa-video-icon-wrp .topppa-play-icon:hover svg path' => 'fill: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'buttons_Css_nbg_h',
                'types' => ['classic', 'gradient', 'video'],
                'selector' => '{{WRAPPER}} .topppa-video-icon-wrp .topppa-play-icon:hover,{{WRAPPER}} .topppa-video-icon-wrp .topppa-play-icon > svg:hover',
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'buttons_Css_hborder',
                'label' => esc_html__('Border', 'topper-pack'),
                'selector' => '{{WRAPPER}} .topppa-video-icon-wrp .topppa-play-icon:hover,{{WRAPPER}} .topppa-video-icon-wrp .topppa-play-icon > svg:hover',
            ]
        );

        $this->add_responsive_control(
            'buttons_Css_hradisu',
            [
                'label' => esc_html__('Border Radius', 'topper-pack'),
                'type'  => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .topppa-video-icon-wrp .topppa-play-icon:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .topppa-video-icon-wrp .topppa-play-icon > svg:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .topppa-video-icon-wrp .topppa-play-icon:hover:before' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .topppa-video-icon-wrp .topppa-play-icon:hover:after' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'buttons_Css_hshadow',
                'label' => esc_html__('Shadow', 'topper-pack'),
                'selector' => '{{WRAPPER}} .topppa-video-icon-wrp .topppa-play-icon:hover,{{WRAPPER}} .topppa-video-icon-wrp .topppa-play-icon > svg:hover',
            ]
        );
        $this->end_controls_tab();
        $this->start_controls_tab(
            'after_effect',
            [
                'label' => __('After Effect', 'topper-pack'),
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'after_bg',
                'label' => esc_html__('Rippol Background', 'topper-pack'),
                'types' => ['classic', 'gradient', 'video'],
                'selector' => '{{WRAPPER}} .topppa-play-icon:before,{{WRAPPER}} .topppa-play-icon:after',
                'fields_options' => [
                    'background' => [
                        'label' => esc_html__('Rippol Background', 'topper-pack'),
                        'default' => 'classic',
                    ],
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'rippol_hover_background',
                'label' => esc_html__('Rippol Hover Background', 'topper-pack'),
                'types' => ['classic', 'gradient', 'video'],
                'selector' => '{{WRAPPER}} .topppa-play-icon:hover:before,{{WRAPPER}} .topppa-play-icon:hover:after',
                'fields_options' => [
                    'background' => [
                        'label' => esc_html__('Rippol Hover Background', 'topper-pack'),
                        'default' => 'classic',
                    ],
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'after_border',
                'label' => esc_html__('Border', 'topper-pack'),
                'selector' => '{{WRAPPER}} .topppa-play-icon:before,{{WRAPPER}} .topppa-play-icon:after',
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'after_shadow',
                'label' => esc_html__('Shadow', 'topper-pack'),
                'selector' => '{{WRAPPER}} .topppa-play-icon:before,{{WRAPPER}} .topppa-play-icon:after',
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->add_responsive_control(
            'button_CSS_margin',
            [
                'label' => esc_html__('Margin', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .topppa-video-icon-wrp .topppa-play-icon' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'button_CSS_padding',
            [
                'label' => esc_html__('Padding', 'topper-pack'),
                'type'  => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .topppa-video-icon-wrp .topppa-play-icon' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();
        $this->start_controls_section(
            'section_style_optiona',
            [
                'label' => esc_html__('Content Style Option', 'topper-pack'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                'condition' => [
                    'topppa_select_styles' => 'style_two',
                ],
            ]
        );
        $this->add_responsive_control(
            'content_width',
            [
                'label' => esc_html__('Content Widht', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 500,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .topppa-video-button2-wrapper input' => 'border-width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'label' => esc_html__('Typography', 'topper-pack'),
                'selector' => '{{WRAPPER}} .topppa-video-button2-wrapper .topppa-video-text>span::before  ,{{WRAPPER}} .topppa-video-button2-wrapper .topppa-video-text>span::after',
            ]
        );

        $this->add_control(
            'title_color_before',
            [
                'label' => esc_html__('Color', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .topppa-video-button2-wrapper .topppa-video-text>span::before' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'title_color_after',
            [
                'label' => esc_html__('After Color', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .topppa-video-button2-wrapper .topppa-video-text>span::after' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'border_width',
            [
                'label' => esc_html__('Border Widht', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 10,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .topppa-video-icon-wrp .topppa-video-button2-wrapper .topppa-video-text::before' => 'border-width: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .topppa-video-icon-wrp .topppa-video-button2-wrapper .topppa-video-text::after' => 'border-width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'border_color_before',
            [
                'label' => esc_html__('Border Before Color', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .topppa-video-icon-wrp .topppa-video-button2-wrapper .topppa-video-text::before' => 'border-color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'border_color_after',
            [
                'label' => esc_html__('Border After Color', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .topppa-video-icon-wrp .topppa-video-button2-wrapper .topppa-video-text::after' => 'border-color: {{VALUE}};',
                ],
            ]
        );
        $this->end_controls_section();
        $this->start_controls_section(
            'section_style_three_option',
            [
                'label' => esc_html__('Content Style Option', 'topper-pack'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                'condition' => [
                    'topppa_select_styles' => 'style_three',
                ],
            ]
        );
        $this->add_responsive_control(
            'video_icon3_height',
            [
                'label' => esc_html__('Icon Height', 'topper-pack'),
                'type'  => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 300,
                        'step' => 1,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .topppa-video-icon-wrp.style-three' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'video_icon3_width',
            [
                'label' => esc_html__('Icon Width', 'topper-pack'),
                'type'  => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 300,
                        'step' => 1,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .topppa-video-icon-wrp.style-three' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'text_color',
            [
                'label' => esc_html__('Text Color', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .your-class' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'video_icon3_background',
                'types' => ['classic', 'gradient', 'video'],
                'selector' => '{{WRAPPER}} .topppa-video-icon-wrp.style-three',
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'video_icon3_border',
                'selector' => '{{WRAPPER}} .topppa-video-icon-wrp.style-three',
            ]
        );
        $this->add_responsive_control(
            'video_icon3_border_radius',
            [
                'label' => esc_html__('Border Radius', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .topppa-video-icon-wrp.style-three' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'video_icon3_border_padding',
            [
                'label' => esc_html__('Padding', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} .topppa-video-icon-wrp.style-three .topppa-circle-text' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->start_controls_tabs(
            'video_icon3_style_tabs'
        );

        $this->start_controls_tab(
            'video_icon3_style_taxt_tab',
            [
                'label' => esc_html__('Text', 'topper-pack'),
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'video_icon3_text_typography',
                'selector' => '{{WRAPPER}} .topppa-video-icon-wrp.style-three .topppa-circle-text text',
            ]
        );
        $this->add_responsive_control(
            'video_icon3_text_color',
            [
                'label' => esc_html__('Text Color', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .topppa-video-icon-wrp.style-three .topppa-circle-text text' => 'fill: {{VALUE}}',
                ],
            ]
        );
        $this->end_controls_tab();

        $this->start_controls_tab(
            'video_icon3_style_icon_tab',
            [
                'label' => esc_html__('Icon', 'topper-pack'),
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'video_icon3_style_icon_typography',
                'selector' => '{{WRAPPER}} .topppa-video-icon-wrp.style-three .topppa-circle-icon',
            ]
        );
        $this->add_responsive_control(
            'video_icon3_style_icon_color',
            [
                'label' => esc_html__('Text Color', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .topppa-video-icon-wrp.style-three .topppa-circle-icon' => 'color: {{VALUE}}',
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
        $unique_id = wp_rand(1241, 3256); // phpcs:ignore WordPress.WP.AlternativeFunctions.rand_rand
        echo '
        <script>
        jQuery(document).ready(function($) {
            "use strict";
            $("#video-btn-' . esc_attr($unique_id) . '").magnificPopup({
                disableOn: 700,
                type: "iframe",
                mainClass: "mfp-fade",
                removalDelay: 160,
                preloader: false,
                fixedContentPos: false
            });
        });
        </script>';
        $style_classes = [
            'style_one' => 'style-one',
            'style_two' => 'style-two',
            'style_three' => 'style-three',
        ];
        $class = isset($style_classes[$settings['topppa_select_styles']]) ? $style_classes[$settings['topppa_select_styles']] : '';
?>

        <div class=" topppa-video-icon-wrp <?php echo esc_attr($class); ?>">
            <?php if ($settings['topppa_select_styles'] === 'style_one') : ?>
                <a href="<?php echo esc_url($settings['video_link']['url']); ?>" class="topppa-play-icon" id="video-btn-<?php echo esc_attr($unique_id); ?>" target="<?php echo esc_attr($settings['video_link']['is_external'] ? '_blank' : '_self'); ?>" rel="<?php echo esc_attr($settings['video_link']['nofollow'] ? 'nofollow' : ''); ?>" aria-label="<?php echo esc_attr('Watch the Video', 'topper-pack'); ?>">
                    <?php \Elementor\Icons_Manager::render_icon($settings['video_icon'], ['aria-hidden' => 'true']); ?>
                </a>
            <?php endif ?>
            <?php if ($settings['topppa_select_styles'] === 'style_two') : ?>
                <a href="<?php echo esc_url($settings['video_link']['url']); ?>" target="<?php echo esc_attr($settings['video_link']['is_external'] ? '_blank' : '_self'); ?>" rel="<?php echo esc_attr($settings['video_link']['nofollow'] ? 'nofollow' : ''); ?>" id="video-btn-<?php echo esc_attr($unique_id); ?>" aria-label="<?php echo esc_attr('Watch the Video', 'topper-pack'); ?>" class="topppa-video-button2-popup">
                    <div class="topppa-video-button2-wrapper">
                        <input type="checkbox">
                        <div class="topppa-video-image">
                            <?php echo wp_get_attachment_image($settings['image']['id'], 'thumbnail'); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
                            ?>
                        </div>
                        <div class="topppa-video-text">
                            <span data-text="<?php echo esc_attr($settings['button_text']) ?>"></span>
                        </div>
                    </div>
                </a>
            <?php endif ?>
            <?php if ($settings['topppa_select_styles'] === 'style_three') : ?>
                <div class="topppa-circle-text">
                    <svg viewBox="0 0 100 100">
                        <defs>
                            <path id="circlePath" d="M50,50 m-35,0 a35,35 0 1,1 70,0 a35,35 0 1,1 -70,0" />
                        </defs>
                        <text>
                            <textPath xlink:href="#circlePath">
                                <?php echo esc_html($settings['button_text']); ?>
                            </textPath>
                        </text>
                    </svg>
                </div>

                <!-- Add Link  -->
                <a href="<?php echo esc_url($settings['video_link']['url']); ?>" class="topppa-circle-icon" id="video-btn-<?php echo esc_attr($unique_id); ?>" target="<?php echo esc_attr($settings['video_link']['is_external'] ? '_blank' : '_self'); ?>" rel="<?php echo esc_attr($settings['video_link']['nofollow'] ? 'nofollow' : ''); ?>" aria-label="<?php echo esc_attr('Watch the Video', 'topper-pack'); ?>">
                    <?php \Elementor\Icons_Manager::render_icon($settings['video_icon'], ['aria-hidden' => 'true']); ?>
                </a>
            <?php endif ?>
        </div>
<?php
    }
}