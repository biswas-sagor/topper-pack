<?php

/**
 * Elementor topppa Slider Widget.
 *
 * @package TopperPack
 * @since 1.0.0
 */

use TopperPack\Trait_Loader\Global_Component_Loader;
use \TopperPack\Includes\Controls\Controls_Manager as TopperPack_Controls_Manager;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

/**
 * Class TOPPPA_Slider_Widget
 *
 * @package TopperPack
 * @since 1.0.0
 */
class TOPPPA_Slider_V3_Widget extends \Elementor\Widget_Base {

    /**
     * Global Component Loader
     *
     * @package TopperPack
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
        return 'topppa_slider_v3_widget';
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
        return TOPPPA_EPWB . esc_html__('Slider V3', 'topper-pack');
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
        return 'eicon-gallery-justified';
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
        return ['topppa', 'widget', 'slider V3', 'topperpack'];
    }

    /**
     * Register widget scripts.
     *
     * @since 1.0.0
     * @access public
     * @return array Widget scripts.
     */
    public function get_script_depends() {
        return ['swiper', 'gsap', 'topppa-swiper-script', 'topppa-slider-v3-widget'];
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
        return 'https://doc.topperpack.com/docs/hero-banner-widgets/hero-slider/';
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
            'slider_option',
            [
                'label' => esc_html__('Slider Content', 'topper-pack'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new \Elementor\Repeater();
        $repeater->add_control(
            'image',
            [
                'label' => esc_html__('Background Image', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::MEDIA,
            ]
        );

        $repeater->add_control(
            'slide_subtitle',
            [
                'label' => esc_html__('Small Title', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Welcome To Our Company', 'topper-pack'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'title',
            [
                'label' => esc_html__('Title', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::WYSIWYG,
                'default' => esc_html__('Christmas Eve Easter Sunrise Good Friday', 'topper-pack'),
            ]
        );

        $repeater->add_control(
            'enable_desc',
            [
                'label' => esc_html__('Enable Description', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', 'topper-pack'),
                'label_off' => esc_html__('Hide', 'topper-pack'),
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );

        $repeater->add_control(
            'desc',
            [
                'label' => esc_html__('Description', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => esc_html__('We envision a world where every child has access to quality education..', 'topper-pack'),
                'condition' => ['enable_desc' => 'yes'],
                'rows' => 10,
            ]
        );
        $repeater->add_control(
            'enable_buttom_area',
            [
                'label' => esc_html__('Enable Buttom Area', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', 'topper-pack'),
                'label_off' => esc_html__('Hide', 'topper-pack'),
                'return_value' => 'yes',
                'default' => 'yes',
                'separator' => 'before',
            ]
        );
        $repeater->add_control(
            'award_winning_heading',
            [
                'label' => esc_html__('Award Winning Settings', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'after',
                'condition' => [
                    'enable_buttom_area' => 'yes'
                ],
            ]
        );
        $repeater->add_control(
            'enable_award_badge',
            [
                'label' => esc_html__('Enable Award Badge', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', 'topper-pack'),
                'label_off' => esc_html__('Hide', 'topper-pack'),
                'return_value' => 'yes',
                'default' => 'yes',
                'separator' => 'before',
                'condition' => [
                    'enable_buttom_area' => 'yes'
                ],
            ]
        );
        $repeater->add_control(
            'award_badge_text',
            [
                'label' => esc_html__('Award Badge Text', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Award Winning', 'topper-pack'),
                'label_block' => true,
                'condition' => [
                    'enable_award_badge' => 'yes',
                    'enable_buttom_area' => 'yes'
                ],
            ]
        );
        $repeater->add_control(
            'award_badge_des_text',
            [
                'label' => esc_html__('Award Badge Description', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('300+ Travel Agency', 'topper-pack'),
                'label_block' => true,
                'condition' => [
                    'enable_award_badge' => 'yes',
                    'enable_buttom_area' => 'yes'
                ],
            ]
        );

        $repeater->add_control(
            'social_proof',
            [
                'label' => esc_html__('Social Proof', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'after',
                'condition' => [
                    'enable_buttom_area' => 'yes'
                ],
            ]
        );
        $repeater->add_control(
            'enable_social_proof_badge',
            [
                'label' => esc_html__('Enable Social Proof ', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', 'topper-pack'),
                'label_off' => esc_html__('Hide', 'topper-pack'),
                'return_value' => 'yes',
                'default' => 'yes',
                'separator' => 'before',
                'condition' => [
                    'enable_buttom_area' => 'yes'
                ],
            ]
        );

        $repeater->add_control(
            'social_proof_image',
            [
                'label' => esc_html__('Social Proof Image', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'condition' => [
                    'enable_buttom_area' => 'yes',
                    'enable_social_proof_badge' => 'yes',
                ],
            ]
        );

        $repeater->add_control(
            'social_proof_title',
            [
                'label' => esc_html__('Social Proof Text', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Satisfy Customer', 'topper-pack'),
                'label_block' => true,
                'condition' => [
                    'enable_buttom_area' => 'yes',
                    'enable_social_proof_badge' => 'yes',
                ],
            ]
        );
        $repeater->add_control(
            'social_proof_review',
            [
                'label' => esc_html__('Social Proof Rating', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('4.9(10k Review)', 'topper-pack'),
                'label_block' => true,
                'condition' => [
                    'enable_buttom_area' => 'yes',
                    'enable_social_proof_badge' => 'yes',
                ],
            ]
        );
        $this->add_control(
            'sliders',
            [
                'label' => esc_html__('Slides', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'slide_subtitle' => esc_html__('Welcoming and Inclusive', 'topper-pack'),
                        'title' => esc_html__('Christmas Eve Easter Sunrise Good Friday', 'topper-pack'),
                    ],
                    [
                        'slide_subtitle' => esc_html__('A Community for Everyone', 'topper-pack'),
                        'title' => esc_html__('Join Us for Meaningful Celebrations', 'topper-pack'),
                    ],
                    [
                        'slide_subtitle' => esc_html__('Hope and Faith', 'topper-pack'),
                        'title' => esc_html__('Discover the Joy of Togetherness', 'topper-pack'),
                    ],
                ],
                'title_field' => '{{{ slide_subtitle }}}',
            ]
        );
        $this->add_control(
            'title_tag',
            [
                'label' => esc_html__('HTML Tag', 'topper-pack'),
                'description' => esc_html__('Add HTML Tag for Small Title', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'h2',
                'options' => [
                    'h1' => esc_html__('H1', 'topper-pack'),
                    'h2' => esc_html__('H2', 'topper-pack'),
                    'h3' => esc_html__('H3', 'topper-pack'),
                    'h4' => esc_html__('H4', 'topper-pack'),
                    'h5' => esc_html__('H5', 'topper-pack'),
                    'h6' => esc_html__('H6', 'topper-pack'),
                    'p' => esc_html__('P', 'topper-pack'),
                    'span' => esc_html__('span', 'topper-pack'),
                    'div' => esc_html__('Div', 'topper-pack'),
                ],
            ]
        );
        $this->end_controls_section();
        $this->start_controls_section(
            'slider_content_options',
            [
                'label' => __('Slider Options', 'topper-pack'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_control(
            'enable_slider',
            [
                'label' => esc_html__('Slider', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'topper-pack'),
                'label_off' => esc_html__('No', 'topper-pack'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );
        $this->add_control(
            'enable_slider_auto_loop',
            [
                'label' => esc_html__('Auto Loop', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'topper-pack'),
                'label_off' => esc_html__('No', 'topper-pack'),
                'return_value' => 'yes',
                'default' => 'yes',
                'condition' => [
                    'enable_slider' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'enable_rtl',
            [
                'label' => esc_html__('RTL Mode', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'topper-pack'),
                'label_off' => esc_html__('No', 'topper-pack'),
                'return_value' => 'yes',
                'default' => 'no',
                'condition' => [
                    'enable_slider' => 'yes',
                ],
            ]
        );
        $this->add_control(
            'slider_space_between',
            [
                'label' => __('Spacing (px)', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                        'step' => 1,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 24,
                ],
                'condition' => [
                    'enable_slider' => 'yes',
                ],
            ]
        );
        $this->add_control(
            'slide_speed',
            [
                'label' => esc_html__('Autoplay Delay (ms)', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'min' => 100,
                'max' => 10000,
                'step' => 100,
                'default' => 3000,
                'condition' => [
                    'enable_slider' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'slider_speed',
            [
                'label' => esc_html__('Transition Speed (ms)', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'min' => 100,
                'max' => 5000,
                'step' => 100,
                'default' => 600,
                'condition' => [
                    'enable_slider' => 'yes',
                ],
            ]
        );
        $this->add_control(
            'enable_dots',
            [
                'label' => esc_html__('Dots', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('On', 'topper-pack'),
                'label_off' => esc_html__('Off', 'topper-pack'),
                'return_value' => 'yes',
                'default' => 'no',
                'condition' => [
                    'enable_slider' => 'yes',
                ],
            ]
        );
        $this->add_control(
            'enable_arrow',
            [
                'label' => esc_html__('Arrows', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('On', 'topper-pack'),
                'label_off' => esc_html__('Off', 'topper-pack'),
                'return_value' => 'yes',
                'default' => 'yes',
                'condition' => [
                    'enable_slider' => 'yes',
                ],
            ]
        );
        $this->add_control(
            'style_arrow_type',
            [
                'label' => esc_html__('Select Arrow Type', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'text' => [
                        'title' => esc_html__('Default', 'topper-pack'),
                        'icon' => 'eicon-animation-text',
                    ],
                    'arrow_icons' => [
                        'title' => esc_html__('Icon', 'topper-pack'),
                        'icon' => 'eicon-info-circle',
                    ],
                ],
                'default' => 'arrow_icons',
                'condition' => [
                    'enable_slider' => 'yes',
                    'enable_arrow' => 'yes',
                ],
            ]
        );
        $this->add_control(
            'default_arrow_notice',
            [
                'type' => \Elementor\Controls_Manager::ALERT,
                'alert_type' => 'success',
                'content' => esc_html__('Default Arrow', 'topper-pack'),
                'condition' => [
                    'enable_arrow' => 'yes',
                    'enable_slider' => 'yes',
                    'style_arrow_type' => 'text',
                ]
            ]
        );
        $this->add_control(
            'left_arrow_icon',
            [
                'label' => esc_html__('Left Arrow Icon', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::ICONS,
                'default' => [
                    'value' => 'fas fa-arrow-left',
                    'library' => 'fa-solid',
                ],
                'condition' => [
                    'enable_arrow' => 'yes',
                    'enable_slider' => 'yes',
                    'style_arrow_type' => 'arrow_icons',
                ],
            ]
        );
        $this->add_control(
            'right_arrow_icon',
            [
                'label' => esc_html__('RIght Arrwo Icon', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::ICONS,
                'default' => [
                    'value' => 'fas fa-arrow-right',
                    'library' => 'fa-solid',
                ],
                'condition' => [
                    'enable_arrow' => 'yes',
                    'enable_slider' => 'yes',
                    'style_arrow_type' => 'arrow_icons',
                ],
            ]
        );
        $this->end_controls_section();
        $this->start_controls_section(
            'home_slider_options',
            [
                'label' => __('Slider Box Style', 'topper-pack'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_responsive_control(
            'background_position',
            [
                'label' => esc_html__('Background Position', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'center center',
                'options' => [
                    'top' => esc_html__('Top', 'topper-pack'),
                    'top left' => esc_html__('Top Left', 'topper-pack'),
                    'top center' => esc_html__('Top Center', 'topper-pack'),
                    'top right' => esc_html__('Top Right', 'topper-pack'),
                    'center' => esc_html__('Center', 'topper-pack'),
                    'center left' => esc_html__('Center Left', 'topper-pack'),
                    'center center' => esc_html__('Center Center', 'topper-pack'),
                    'center right' => esc_html__('Center Right', 'topper-pack'),
                    'bottom' => esc_html__('Bottom', 'topper-pack'),
                    'bottom left' => esc_html__('Bottom Left', 'topper-pack'),
                    'bottom center' => esc_html__('Bottom Center', 'topper-pack'),
                    'bottom right' => esc_html__('Bottom Right', 'topper-pack'),
                ],
                'selectors' => [
                    '{{WRAPPER}} .slider-v3-wrapper .slider-v3-item-bg' => 'background-position: {{VALUE}}',
                ],
            ]
        );

        $this->add_responsive_control(
            'slider_content_width',
            [
                'label' => __('Content Column Width (%)', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['%'],
                'range' => [
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],

                'selectors' => [
                    '{{WRAPPER}} .slider-v3-wrapper .slider-v3-column' => 'flex:0 0 {{SIZE}}%;max-width: {{SIZE}}%;',
                ],
            ]
        );

        $this->add_responsive_control(
            'slider_content_align',
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
                    '{{WRAPPER}} .slider-v3-wrapper .slider-v3-content-box' => 'text-align: {{VALUE}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'box_background_before_blur',
            [
                'label' => esc_html__('Background Before Blur', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                        'step' => 1,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                ],
                'selectors' => [
                    '{{WRAPPER}} .slider-v3-wrapper .slider-v3-content-box' => 'backdrop-filter: blur({{SIZE}}{{UNIT}});',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'content_box_box_bg',
                'label' => esc_html__('Background', 'topper-pack'),
                'types' => ['classic', 'gradient', 'video'],
                'selector' => '{{WRAPPER}} .slider-v3-wrapper .slider-v3-content-box',
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'content_box_border',
                'label' => esc_html__('Border', 'topper-pack'),
                'selector' => '{{WRAPPER}} .slider-v3-wrapper .slider-v3-content-box',
            ]
        );
        $this->add_responsive_control(
            'content_box_radius',
            [
                'label' => esc_html__('Border Radius', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .slider-v3-wrapper .slider-v3-content-box' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'content_box_box_shadow',
                'label' => esc_html__('Box Shadow', 'topper-pack'),
                'selector' => '{{WRAPPER}} .slider-v3-wrapper .slider-v3-content-box',
            ]
        );
        $this->add_responsive_control(
            'slider_content_margin',
            [
                'label' => esc_html__('Margin', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .slider-v3-wrapper .slider-v3-content-box' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'slider_content_padding',
            [
                'label' => esc_html__('Padding', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .slider-v3-wrapper .slider-v3-content-box' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
        $this->start_controls_section(
            'slider_content_style',
            [
                'label' => esc_html__('Slider Content Style', 'topper-pack'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->start_controls_tabs(
            'slider_content_tabs'
        );
        $this->start_controls_tab(
            'small_title_style',
            [
                'label' => esc_html__('Small Title', 'topper-pack'),
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'small_title_typo',
                'label' => __('Typography', 'topper-pack'),
                'selector' => '{{WRAPPER}} .slider-v3-content-box .slider-v3-stitle',
            ]
        );
        $this->add_control(
            'small_title_color',
            [
                'label' => esc_html__('Color', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .slider-v3-content-box .slider-v3-stitle' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'small_title_margin',
            [
                'label' => esc_html__('Margin', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .slider-v3-content-box .slider-v3-stitle' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'small_title_padding',
            [
                'label' => esc_html__('Padding', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .slider-v3-content-box .slider-v3-stitle' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_tab();
        $this->start_controls_tab(
            'title_style',
            [
                'label' => esc_html__('Title', 'topper-pack'),
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'title_typo',
                'label' => __('Typography', 'topper-pack'),
                'selector' => '
                    {{WRAPPER}} .slider-v3-content-box .slider-v3-title',
            ]
        );
        $this->add_control(
            'title_color',
            [
                'label' => esc_html__('Color', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .slider-v3-content-box .slider-v3-title' => 'color: {{VALUE}};',
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
                    '{{WRAPPER}} .slider-v3-content-box .slider-v3-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                    '{{WRAPPER}} .slider-v3-content-box .slider-v3-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_tab();
        $this->start_controls_tab(
            'Description_style',
            [
                'label' => esc_html__('Description', 'topper-pack'),
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'dec_typo',
                'label' => esc_html__('Typography', 'topper-pack'),
                'selector' => '{{WRAPPER}} .slider-v3-content-box .slider-v3-des',
            ]
        );
        $this->add_responsive_control(
            'dec_color',
            [
                'label' => esc_html__('Color', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .slider-v3-content-box .slider-v3-des' => 'color: {{VALUE}}',
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
                    '{{WRAPPER}} .slider-v3-content-box .slider-v3-des' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                    '{{WRAPPER}} .slider-v3-content-box .slider-v3-des' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();
        $this->start_controls_section(
            'award_winning_style',
            [
                'label' => esc_html__('Award Winning Style', 'topper-pack'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->start_controls_tabs(
            'award_winning_tabs'
        );
        $this->start_controls_tab(
            'award_winning_title_style',
            [
                'label' => esc_html__('Title', 'topper-pack'),
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'award_winning_title_typo',
                'label' => __('Typography', 'topper-pack'),
                'selector' => '
                    {{WRAPPER}} .slider-v3-content-box .slider-v3-award-social-wrap .slider-v3-award-box .slider-v3-award-title',
            ]
        );
        $this->add_control(
            'award_winning_title_color',
            [
                'label' => esc_html__('Color', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .slider-v3-content-box .slider-v3-award-social-wrap .slider-v3-award-box .slider-v3-award-title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'award_winning_title_margin',
            [
                'label' => esc_html__('Margin', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .slider-v3-content-box .slider-v3-award-social-wrap .slider-v3-award-box .slider-v3-award-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'award_winning_title_padding',
            [
                'label' => esc_html__('Padding', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .slider-v3-content-box .slider-v3-award-social-wrap .slider-v3-award-box .slider-v3-award-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_tab();
        $this->start_controls_tab(
            'award_winning_title_description',
            [
                'label' => esc_html__('Description', 'topper-pack'),
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'award_winning_dec_typo',
                'label' => esc_html__('Typography', 'topper-pack'),
                'selector' => '{{WRAPPER}} .slider-v3-content-box .slider-v3-award-social-wrap .slider-v3-award-box .slider-v3-award-des',
            ]
        );
        $this->add_responsive_control(
            'award_winning_dec_color',
            [
                'label' => esc_html__('Color', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .slider-v3-content-box .slider-v3-award-social-wrap .slider-v3-award-box .slider-v3-award-des' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_responsive_control(
            'award_winning_dec_margin',
            [
                'label' => esc_html__('Margin', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .slider-v3-content-box .slider-v3-award-social-wrap .slider-v3-award-box .slider-v3-award-des' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'award_winning_dec_padding',
            [
                'label' => esc_html__('Padding', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .slider-v3-content-box .slider-v3-award-social-wrap .slider-v3-award-box .slider-v3-award-des' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();
        $this->start_controls_section(
            'social_proof_style',
            [
                'label' => esc_html__('Social Proof Style', 'topper-pack'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_responsive_control(
            'social_proof_gap',
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
                    '{{WRAPPER}} .slider-v3-content-box .slider-v3-award-social-wrap .slider-v3-social-proof' => 'gap: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->start_controls_tabs(
            'social_proof_tabs'
        );
        $this->start_controls_tab(
            'social_proof_image_style',
            [
                'label' => esc_html__('Image', 'topper-pack'),
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
                        'max' => 600,
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
                    '{{WRAPPER}} .slider-v3-content-box .slider-v3-award-social-wrap .slider-v3-avatar-group' => 'height: {{SIZE}}{{UNIT}};',
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
                        'max' => 600,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .slider-v3-content-box .slider-v3-award-social-wrap .slider-v3-avatar-group' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'max_Image_width',
            [
                'label' => esc_html__('Max Width', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 600,
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
                    '{{WRAPPER}} .slider-v3-content-box .slider-v3-award-social-wrap .slider-v3-avatar-group' => 'max-width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'image_border',
                'selector' => '{{WRAPPER}} .slider-v3-content-box .slider-v3-award-social-wrap .slider-v3-avatar-group',
            ]
        );
        $this->add_responsive_control(
            'image_border_radius',
            [
                'label' => esc_html__('Border Radius', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .slider-v3-content-box .slider-v3-award-social-wrap .slider-v3-avatar-group' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                    '{{WRAPPER}} .slider-v3-content-box .slider-v3-award-social-wrap .slider-v3-avatar-group' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                    '{{WRAPPER}} .slider-v3-content-box .slider-v3-award-social-wrap .slider-v3-avatar-group' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_tab();
        $this->start_controls_tab(
            'social_proof_title_style',
            [
                'label' => esc_html__('Title', 'topper-pack'),
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'social_proof_title_typo',
                'label' => __('Typography', 'topper-pack'),
                'selector' => '
                    {{WRAPPER}} .slider-v3-content-box .slider-v3-award-social-wrap .slider-v3-proof-content .slider-v3-proof-title',
            ]
        );
        $this->add_control(
            'social_proof_title_color',
            [
                'label' => esc_html__('Color', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .slider-v3-content-box .slider-v3-award-social-wrap .slider-v3-proof-content .slider-v3-proof-title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'social_proof_title_margin',
            [
                'label' => esc_html__('Margin', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .slider-v3-content-box .slider-v3-award-social-wrap .slider-v3-proof-content .slider-v3-proof-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'social_proof_title_padding',
            [
                'label' => esc_html__('Padding', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .slider-v3-content-box .slider-v3-award-social-wrap .slider-v3-proof-content .slider-v3-proof-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_tab();
        $this->start_controls_tab(
            'social_proof_description_style',
            [
                'label' => esc_html__('Review', 'topper-pack'),
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'social_proof_description_typo',
                'label' => esc_html__('Typography', 'topper-pack'),
                'selector' => '{{WRAPPER}} .slider-v3-content-box .slider-v3-award-social-wrap .slider-v3-proof-content .slider-v3-proof-review',
            ]
        );
        $this->add_responsive_control(
            'social_proof_description_color',
            [
                'label' => esc_html__('Color', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .slider-v3-content-box .slider-v3-award-social-wrap .slider-v3-proof-content .slider-v3-proof-review' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_responsive_control(
            'social_proof_description_margin',
            [
                'label' => esc_html__('Margin', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .slider-v3-content-box .slider-v3-award-social-wrap .slider-v3-proof-content .slider-v3-proof-review' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'social_proof_description_padding',
            [
                'label' => esc_html__('Padding', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .slider-v3-content-box .slider-v3-award-social-wrap .slider-v3-proof-content .slider-v3-proof-review' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();
        $this->start_controls_section(
            'arrow_content_option',
            [
                'label' => esc_html__('Arrow Style Option', 'topper-pack'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                'condition' => [
                    'enable_arrow' => 'yes',
                ],
            ]
        );
        $this->add_responsive_control(
            'arrow_gap',
            [
                'label' => esc_html__('Gap', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 500,
                        'step' => 5,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .slider-v3-wrapper .slider-v3-arrow-wrp' => 'gap: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'arrow_typography',
                'selector' => '{{WRAPPER}} .slider-v3-wrapper .slider-v3-arrow-wrp .button',
            ]
        );
        $this->add_responsive_control(
            'arrow_height',
            [
                'label' => esc_html__('Height', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'custom'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 300,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .slider-v3-wrapper .slider-v3-arrow-wrp .button' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'arrow_width',
            [
                'label' => esc_html__('width', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'custom'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 300,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .slider-v3-wrapper .slider-v3-arrow-wrp .button' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'arrow_min_width',
            [
                'label' => esc_html__('Min width', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'custom'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 300,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .slider-v3-wrapper .slider-v3-arrow-wrp .button' => 'min-width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->start_controls_tabs(
            'arrow_style_tabs'
        );
        $this->start_controls_tab(
            'arrow_normal_tabs',
            [
                'label' => __('Normal', 'topper-pack'),
            ]
        );
        $this->add_responsive_control(
            'arrow_color',
            [
                'label' => esc_html__('Color', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .slider-v3-wrapper .slider-v3-arrow-wrp .button' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'arrow_background',
                'label' => esc_html__('Background', 'topper-pack'),
                'types' => ['classic', 'gradient', 'video'],
                'selector' => '{{WRAPPER}} .slider-v3-wrapper .slider-v3-arrow-wrp .button',
                'fields_options' => [
                    'background' => [
                        'label' => esc_html__('Background', 'topper-pack'),
                        'default' => 'classic',
                    ],
                ],
            ]
        );
        $this->add_responsive_control(
            'arrow_blur',
            [
                'label' => esc_html__('Background Blur', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                        'step' => 1,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 0, // Set the default size to 10px
                ],
                'selectors' => [
                    '{{WRAPPER}} .slider-v3-wrapper .slider-v3-arrow-wrp .button' => 'backdrop-filter: blur({{SIZE}}{{UNIT}});',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'arrow_border',
                'label' => esc_html__('Border', 'topper-pack'),
                'selector' => '{{WRAPPER}} .slider-v3-wrapper .slider-v3-arrow-wrp .button',
            ]
        );
        $this->add_responsive_control(
            'arrow_border_radius',
            [
                'label' => esc_html__('Border Radius', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .slider-v3-wrapper .slider-v3-arrow-wrp .button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_tab();
        $this->start_controls_tab(
            'arrow_hover_tabs',
            [
                'label' => __('Hover', 'topper-pack'),
            ]
        );
        $this->add_responsive_control(
            'arrow_color_hover',
            [
                'label' => esc_html__('Hover Color', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .slider-v3-wrapper .slider-v3-arrow-wrp .button:hover' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'arrow_background_hover',
                'label' => esc_html__('Background', 'topper-pack'),
                'types' => ['classic', 'gradient', 'video'],
                'selector' => '{{WRAPPER}} .slider-v3-wrapper .slider-v3-arrow-wrp .button:hover',
                'fields_options' => [
                    'background' => [
                        'label' => esc_html__('Background', 'topper-pack'),
                        'default' => 'classic',
                    ],
                ],
            ]
        );
        $this->add_responsive_control(
            'arrow_blur_hover',
            [
                'label' => esc_html__('Background Blur', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                        'step' => 1,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 0, // Set the default size to 10px
                ],
                'selectors' => [
                    '{{WRAPPER}} .slider-v3-wrapper .slider-v3-arrow-wrp .button:hover' => 'backdrop-filter: blur({{SIZE}}{{UNIT}});',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'arrow_border_hover',
                'label' => esc_html__('Border', 'topper-pack'),
                'selector' => '{{WRAPPER}} .slider-v3-wrapper .slider-v3-arrow-wrp .button:hover',
            ]
        );
        $this->add_responsive_control(
            'arrow_border_radius_hover',
            [
                'label' => esc_html__('Border Radius', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .slider-v3-wrapper .slider-v3-arrow-wrp .button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_tab();
        $this->start_controls_tab(
            'arrow_active_tabs',
            [
                'label' => __('Active', 'topper-pack'),
            ]
        );
        $this->add_responsive_control(
            'arrow_color_active',
            [
                'label'     => esc_html__('Color', 'topper-pack'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .slider-v3-wrapper .slider-v3-arrow-wrp .slider-next.button' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .slider-v3-wrapper .slider-v3-arrow-wrp .slider-next.button svg path' => 'fill: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'arrow_background_active',
                'label' => esc_html__('Background', 'topper-pack'),
                'types' => ['classic', 'gradient', 'video'],
                'selector' => '{{WRAPPER}} .slider-v3-wrapper .slider-v3-arrow-wrp .slider-next.button',
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
                'name'     => 'arrow_border_active',
                'label'    => esc_html__('Border', 'topper-pack'),
                'selector' => '{{WRAPPER}} .slider-v3-wrapper .slider-v3-arrow-wrp .slider-next.button',
            ]
        );

        $this->add_control(
            'arrow_active_hover_styles',
            [
                'label' => esc_html__('Hover Styles', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->add_responsive_control(
            'arrow_color_active_hover',
            [
                'label'     => esc_html__('Color', 'topper-pack'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .slider-v3-wrapper .slider-v3-arrow-wrp .slider-next.button:hover' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .slider-v3-wrapper .slider-v3-arrow-wrp .slider-next.button:hover svg path' => 'fill: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'arrow_background_active_hover',
                'label' => esc_html__('Background', 'topper-pack'),
                'types' => ['classic', 'gradient', 'video'],
                'selector' => '{{WRAPPER}} .slider-v3-wrapper .slider-v3-arrow-wrp .slider-next.button:hover',
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
                'name'     => 'arrow_border_active_hover',
                'label'    => esc_html__('Border', 'topper-pack'),
                'selector' => '{{WRAPPER}} .slider-v3-wrapper .slider-v3-arrow-wrp .slider-next.button:hover',
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();
        $this->start_controls_section(
            'dote_content_option',
            [
                'label' => esc_html__('Dots Style', 'topper-pack'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                'condition' => [
                    'enable_dots' => 'yes',
                ],
            ]
        );
        $this->add_responsive_control(
            'dote_gap',
            [
                'label' => esc_html__('Gap', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'custom'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 300,
                        'step' => 1,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .topppa-dote-pagination' => 'gap: {{SIZE}}{{UNIT}};',
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 24,
                ],
            ]
        );
        $this->add_responsive_control(
            'dote_align',
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
                    '{{WRAPPER}} .topppa-dote-pagination' => 'justify-content: {{VALUE}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'dote_height',
            [
                'label' => esc_html__('Height', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::SLIDER,
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
                'selectors' => [
                    '{{WRAPPER}} .swiper-pagination-bullets span.swiper-pagination-bullet' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'dote_width',
            [
                'label' => esc_html__('Width', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::SLIDER,
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
                'selectors' => [
                    '{{WRAPPER}} .swiper-pagination-bullets span.swiper-pagination-bullet' => 'Width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->start_controls_tabs(
            'dots_style_tabs'
        );
        $this->start_controls_tab(
            'dots_normal_tabs',
            [
                'label' => __('Normal', 'topper-pack'),
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'dote_background',
                'label' => esc_html__('Background', 'topper-pack'),
                'types' => ['classic', 'gradient', 'video'],
                'selector' => '{{WRAPPER}} .topppa-dote-pagination span',
                'fields_options' => [
                    'background' => [
                        'label' => esc_html__('Background', 'topper-pack'),
                        'default' => 'classic',
                    ],
                ],
            ]
        );
        $this->add_responsive_control(
            'dote_opacity',
            [
                'label' => esc_html__('Opacity', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1,
                        'step' => .1,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .topppa-dote-pagination span' => 'opacity: {{SIZE}};',
                ],
            ]
        );
        $this->end_controls_tab();
        $this->start_controls_tab(
            'dots_active_tabs',
            [
                'label' => __('Active', 'topper-pack'),
            ]
        );
        $this->add_responsive_control(
            'active_dote_width',
            [
                'label' => esc_html__('Active Width', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::SLIDER,
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
                'selectors' => [
                    '{{WRAPPER}} .swiper-pagination-bullets span.swiper-pagination-bullet-active' => 'width: {{SIZE}}{{UNIT}} !important;',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'active_dote_background',
                'label' => esc_html__('Background', 'topper-pack'),
                'types' => ['classic', 'gradient', 'video'],
                'selector' => '{{WRAPPER}} .topppa-dote-pagination .swiper-pagination-bullet-active',
                'fields_options' => [
                    'background' => [
                        'label' => esc_html__('Active Background', 'topper-pack'),
                        'default' => 'classic',
                    ],
                ],
            ]
        );
        $this->add_responsive_control(
            'dote_active_opacity',
            [
                'label' => esc_html__('Active Opacity', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1,
                        'step' => .1,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .topppa-dote-pagination .swiper-pagination-bullet-active' => 'opacity: {{SIZE}};',
                ],
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->add_responsive_control(
            'dots_border_radius_hover',
            [
                'label' => esc_html__('Border Radius', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .topppa-dote-pagination span.swiper-pagination-bullet' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'dote_Margin',
            [
                'label' => esc_html__('Margin', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .topppa-dote-pagination' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'dote_padding',
            [
                'label' => esc_html__('Padding', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .topppa-dote-pagination' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
        $allowed_html = [
            'a' => [
                'href' => [],
                'title' => [],
                'target' => [],
            ],
            'br' => [],
            'strong' => [],
            'em' => [],
            'span' => [
                'style' => [],
            ],
        ];
        $SliderId = wp_rand(1241, 3256); // phpcs:ignore WordPress.WP.AlternativeFunctions.rand_rand
        ob_start();
?>

        <div class="slider-v3-wrapper">
            <div class="swiper topppa-swiper-slider topppa-swiper-slider-<?php echo esc_attr($SliderId); ?>" <?php if ($settings['enable_slider'] === 'yes'): ?>
                data-space-between="<?php echo esc_attr($settings['slider_space_between']['size']); ?>"
                data-auto-loop="<?php echo esc_attr($settings['enable_slider_auto_loop']); ?>"
                data-slide-speed="<?php echo esc_attr($settings['slide_speed']); ?>"
                data-slider-speed="<?php echo esc_attr($settings['slider_speed']); ?>"
                data-enable-dote="<?php echo esc_attr($settings['enable_dots']); ?>"
                data-enable-arrow="<?php echo esc_attr($settings['enable_arrow']); ?>" data-slides-per-view="1"
                data-large-items="1" data-tablet-items="1" data-mobile-items="1" data-extra-mobile-items="1"
                data-enable-rtl="<?php echo esc_attr($settings['enable_rtl']); ?>" <?php endif; ?>>
                <div class="swiper-wrapper">
                    <?php foreach ($settings['sliders'] as $item): ?>
                        <div class="swiper-slide animeslide-slide">
                            <div class="slider-v3-item-bg"
                                style="background-image:url(<?php echo esc_url(wp_get_attachment_image_url($item['image']['id'], 'full')); ?>)">
                                <div class="topper-pack-table">
                                    <div class="topper-pack-table-cell">
                                        <div class="container-fluid">
                                            <div class="row">
                                                <div class="slider-v3-column col-xl-6 col-lg-9 col-md-12">
                                                    <div class="slider-v3-content-box">
                                                        <?php if (!empty($item['slide_subtitle'])): ?>
                                                            <div class="slider-v3-stitle">
                                                                <?php echo esc_html($item['slide_subtitle']); ?>
                                                            </div>
                                                        <?php endif; ?>

                                                        <<?php echo esc_attr($settings['title_tag']); ?> class="slider-v3-title">
                                                            <?php echo wp_kses($item['title'], $allowed_html); ?>
                                                        </<?php echo esc_attr($settings['title_tag']); ?>>

                                                        <?php if ($item['enable_desc'] === 'yes'): ?>
                                                            <div class="slider-v3-des">
                                                                <?php echo esc_html($item['desc']); ?>
                                                            </div>
                                                        <?php endif; ?>

                                                        <?php if (isset($item['enable_buttom_area']) && $item['enable_buttom_area'] === 'yes'): ?>
                                                            <div class="slider-v3-award-social-wrap">

                                                                <?php if (isset($item['enable_award_badge']) && $item['enable_award_badge'] === 'yes'): ?>
                                                                    <div class="slider-v3-award-box">
                                                                        <?php if (!empty($item['award_badge_text'])): ?>
                                                                            <div class="slider-v3-award-title">
                                                                                <?php echo esc_html($item['award_badge_text']); ?>
                                                                            </div>
                                                                        <?php endif; ?>
                                                                        <?php if (!empty($item['award_badge_des_text'])): ?>
                                                                            <div class="slider-v3-award-des">
                                                                                <?php echo esc_html($item['award_badge_des_text']); ?>
                                                                            </div>
                                                                        <?php endif; ?>
                                                                    </div>
                                                                <?php endif; ?>

                                                                <?php if (isset($item['enable_social_proof_badge']) && $item['enable_social_proof_badge'] === 'yes'): ?>
                                                                    <div class="slider-v3-social-proof">
                                                                        <?php if (!empty($item['social_proof_image']['url'])): ?>
                                                                            <div class="slider-v3-avatar-group">
                                                                                <img src="<?php echo esc_url($item['social_proof_image']['url']); ?>"
                                                                                    alt="<?php echo esc_attr($item['social_proof_image']['alt'] ?? ''); ?>">
                                                                            </div>
                                                                        <?php endif; ?>
                                                                        <div class="slider-v3-proof-content">
                                                                            <?php if (!empty($item['social_proof_title'])): ?>
                                                                                <div class="slider-v3-proof-title">
                                                                                    <?php echo esc_html($item['social_proof_title']); ?>
                                                                                </div>
                                                                            <?php endif; ?>
                                                                            <?php if (!empty($item['social_proof_review'])): ?>
                                                                                <div class="slider-v3-proof-review">
                                                                                    <?php echo esc_html($item['social_proof_review']); ?>
                                                                                </div>
                                                                            <?php endif; ?>
                                                                        </div>
                                                                    </div>
                                                                <?php endif; ?>
                                                            </div>
                                                        <?php endif; ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <?php if ('yes' === $settings['enable_dots']): ?>
                <div
                    class="slider-v3-pagination topppa-dote-pagination topppa-topppa-dote-pagination-<?php echo esc_attr($SliderId); ?>">
                </div>
            <?php endif; ?>
            <?php if ('yes' === $settings['enable_arrow']): ?>
                <div class="slider-v3-arrow-wrp">
                    <?php if ('text' === $settings['style_arrow_type']): ?>
                        <div class="slider-prev button topppa-brand-logo-button-prev-<?php echo esc_attr($SliderId); ?>">
                            <?php echo esc_html__('Prev', 'topper-pack'); ?>
                        </div>
                        <div class="slider-next button topppa-brand-logo-button-next-<?php echo esc_attr($SliderId); ?>">
                            <?php echo esc_html__('Next', 'topper-pack'); ?>
                        </div>
                    <?php elseif ('arrow_icons' === $settings['style_arrow_type']): ?>
                        <div class="slider-prev button topppa-brand-logo-button-prev-<?php echo esc_attr($SliderId); ?>">
                            <?php if (!empty($settings['left_arrow_icon'])) {
                                \Elementor\Icons_Manager::render_icon($settings['left_arrow_icon'], ['aria-hidden' => 'true']);
                            } ?>
                        </div>
                        <div class="slider-next button topppa-brand-logo-button-next-<?php echo esc_attr($SliderId); ?>">
                            <?php if (!empty($settings['right_arrow_icon'])) {
                                \Elementor\Icons_Manager::render_icon($settings['right_arrow_icon'], ['aria-hidden' => 'true']);
                            } ?>
                        </div>
                    <?php endif; ?>
                </div>
            <?php endif; ?>


        </div>
<?php
    }
}
