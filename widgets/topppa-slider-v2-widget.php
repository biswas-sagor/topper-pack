<?php

/**
 * Elementor topppa Slider Widget.
 *
 * @package TopperPack
 * @since 1.0.0
 */

use TopperPack\Trait_Loader\Global_Component_Loader;
use \TopperPack\Includes\Controls\Controls_Manager as TopperPack_Controls_Manager;

if (! defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

/**
 * Class TOPPPA_Slider_Widget
 *
 * @package TopperPack
 * @since 1.0.0
 */
class TOPPPA_Slider_V2_Widget extends \Elementor\Widget_Base {

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
        return 'topppa_slider_v2_widget';
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
        return TOPPPA_EPWB . esc_html__('Slider V2', 'topper-pack');
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
        return ['topppa', 'widget', 'slider V2', 'topperpack'];
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
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->topppa_get_global_button_effects_controls();

        $repeater = new \Elementor\Repeater();
        $repeater->add_control(
            'image',
            [
                'label' => esc_html__('Background Image', 'topper-pack'),
                'type'  => \Elementor\Controls_Manager::MEDIA,
            ]
        );
        $repeater->add_control(
            'title',
            [
                'label'   => esc_html__('Title', 'topper-pack'),
                'type'    => \Elementor\Controls_Manager::WYSIWYG,
                'default' => esc_html__('Christmas Eve Easter Sunrise Good Friday', 'topper-pack'),
            ]
        );

        $repeater->add_control(
            'enable_desc',
            [
                'label'        => esc_html__('Enable Description', 'topper-pack'),
                'type'         => \Elementor\Controls_Manager::SWITCHER,
                'label_on'     => esc_html__('Show', 'topper-pack'),
                'label_off'    => esc_html__('Hide', 'topper-pack'),
                'return_value' => 'yes',
                'default'      => 'yes',
            ]
        );

        $repeater->add_control(
            'desc',
            [
                'label'     => esc_html__('Description', 'topper-pack'),
                'type'      => \Elementor\Controls_Manager::TEXTAREA,
                'default'   => esc_html__('We envision a world where every child has access to quality education...', 'topper-pack'),
                'condition' => ['enable_desc' => 'yes'],
                'rows'      => 10,
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
                'separator' => 'before',
            ]
        );
        $repeater->add_control(
            'button_text',
            [
                'label'     => esc_html__('Button Text', 'topper-pack'),
                'type'      => \Elementor\Controls_Manager::TEXT,
                'default'   => esc_html__('Discover More', 'topper-pack'),
                'condition' => ['enable_button' => 'yes'],
            ]
        );

        $repeater->add_control(
            'button_link',
            [
                'label'       => esc_html__('Button URL', 'topper-pack'),
                'type'        => \Elementor\Controls_Manager::URL,
                'placeholder' => esc_html__('https://your-link.com', 'topper-pack'),
                'label_block' => true,
                'default'     => [
                    'url'         => '',
                    'is_external' => true,
                    'nofollow'    => true,
                ],
                'condition'   => ['enable_button' => 'yes'],
            ]
        );
        $repeater->add_control(
            'enable_icon',
            [
                'label' => esc_html__('Enable Button Icon', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', 'topper-pack'),
                'label_off' => esc_html__('Hide', 'topper-pack'),
                'return_value' => 'yes',
                'default' => 'no',
                'separator' => 'before',
                'condition'   => ['enable_button' => 'yes'],
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
                    'enable_icon' => 'yes'
                ]
            ]
        );
        $repeater->add_control(
            'topppa_button_image',
            [
                'label' => esc_html__('Button Image', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::MEDIA,
            ]
        );

        $this->add_control(
            'sliders',
            [
                'label'       => esc_html__('Slides', 'topper-pack'),
                'type'        => \Elementor\Controls_Manager::REPEATER,
                'fields'      => $repeater->get_controls(),
                'default'     => [
                    [
                        'title'          => esc_html__('Christmas Eve Easter Sunrise Good Friday', 'topper-pack'),
                    ],
                    [
                        'title'          => esc_html__('Join Us for Meaningful Celebrations', 'topper-pack'),
                    ],
                    [
                        'title'          => esc_html__('Discover the Joy of Togetherness', 'topper-pack'),
                    ],
                ],
                'title_field' => '{{{ title }}}',
            ]
        );
        $this->add_control(
            'slider_note',
            [
                'type' => \Elementor\Controls_Manager::RAW_HTML,
                'raw'  => esc_html__('Place at least 3 items on the slider.', 'topper-pack'),
                'content_classes' => 'elementor-descriptor',
            ]
        );

        $this->end_controls_section();
        $this->start_controls_section(
            'slider_content_options',
            [
                'label' => __('Slider Options', 'topper-pack'),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
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
            ]
        );

        $this->add_control(
            'enable_arrow',
            [
                'label'        => esc_html__('Arrows', 'topper-pack'),
                'type'         => \Elementor\Controls_Manager::SWITCHER,
                'label_on'     => esc_html__('On', 'topper-pack'),
                'label_off'    => esc_html__('Off', 'topper-pack'),
                'return_value' => 'yes',
                'default'      => 'yes',
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
                ],
            ]
        );
        $this->end_controls_section();
        $this->start_controls_section(
            'home_slider_options',
            [
                'label' => __('Slider Options', 'topper-pack'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_responsive_control(
            'background_position',
            [
                'label'     => esc_html__('Background Position', 'topper-pack'),
                'type'      => \Elementor\Controls_Manager::SELECT,
                'default'   => 'center center',
                'options'   => [
                    'top'      => esc_html__('Top', 'topper-pack'),
                    'top left'      => esc_html__('Top Left', 'topper-pack'),
                    'top center'    => esc_html__('Top Center', 'topper-pack'),
                    'top right'     => esc_html__('Top Right', 'topper-pack'),
                    'center'   => esc_html__('Center', 'topper-pack'),
                    'center left'   => esc_html__('Center Left', 'topper-pack'),
                    'center center' => esc_html__('Center Center', 'topper-pack'),
                    'center right'  => esc_html__('Center Right', 'topper-pack'),
                    'bottom'   => esc_html__('Bottom', 'topper-pack'),
                    'bottom left'   => esc_html__('Bottom Left', 'topper-pack'),
                    'bottom center' => esc_html__('Bottom Center', 'topper-pack'),
                    'bottom right'  => esc_html__('Bottom Right', 'topper-pack'),
                ],
                'selectors' => [
                    '{{WRAPPER}} .tpp-slider-v2-carousel .tpp-item' => 'background-position: {{VALUE}}',
                ],
            ]
        );
        $this->add_responsive_control(
            'slider_height',
            [
                'label' => __('Slider Height (px)', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 300,
                        'max' => 1400,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .tpp-slider-v2-carousel' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'content_width',
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
                    '{{WRAPPER}} .tpp-slider-v2-carousel .slider-v2-column' => 'flex:0 0 {{SIZE}}%;max-width: {{SIZE}}%;',
                ],
            ]
        );

        $this->add_responsive_control(
            'text_align',
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
                    '{{WRAPPER}} .tpp-slider-v2-carousel .tpp-content' => 'text-align: {{VALUE}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'box_margin',
            [
                'label'      => esc_html__('Margin', 'topper-pack'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .tpp-slider-v2-carousel .tpp-content' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'box_padding',
            [
                'label'      => esc_html__('Padding', 'topper-pack'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .tpp-slider-v2-carousel .tpp-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
        // =============================================//
        // ========= SLIDER CONTENT STYLE START ========//
        // =============================================//


        // Subtitle Style
        $this->start_controls_section(
            'slider_content_style',
            [
                'label' => esc_html__('Slider Content Style', 'topper-pack'),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->start_controls_tabs(
            'slider_content_tabs'
        );

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
                    {{WRAPPER}} .tpp-slider-v2-carousel .tpp-content .tpp-title',
            ]
        );
        $this->add_control(
            'title_tag',
            [
                'label'       => esc_html__('HTML Tag', 'topper-pack'),
                'description' => esc_html__('Add HTML Tag for Small Title', 'topper-pack'),
                'type'        => \Elementor\Controls_Manager::SELECT,
                'default'     => 'h2',
                'options'     => [
                    'h1'   => esc_html__('H1', 'topper-pack'),
                    'h2'   => esc_html__('H2', 'topper-pack'),
                    'h3'   => esc_html__('H3', 'topper-pack'),
                    'h4'   => esc_html__('H4', 'topper-pack'),
                    'h5'   => esc_html__('H5', 'topper-pack'),
                    'h6'   => esc_html__('H6', 'topper-pack'),
                    'p'    => esc_html__('P', 'topper-pack'),
                    'span' => esc_html__('span', 'topper-pack'),
                    'div'  => esc_html__('Div', 'topper-pack'),
                ],
            ]
        );
        $this->add_control(
            'title_color',
            [
                'label'       => esc_html__('Color', 'topper-pack'),
                'type'        => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tpp-slider-v2-carousel .tpp-content .tpp-title' => 'color: {{VALUE}};',
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
                    '{{WRAPPER}} .tpp-slider-v2-carousel .tpp-content .tpp-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                    '{{WRAPPER}} .tpp-slider-v2-carousel .tpp-content .tpp-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_tab();
        $this->start_controls_tab(
            'Description_style',
            [
                'label' => esc_html__('Des', 'topper-pack'),
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'dec_typo',
                'label' => esc_html__('Typography', 'topper-pack'),
                'selector' => '{{WRAPPER}} .tpp-slider-v2-carousel .tpp-content .tpp-des',
            ]
        );
        $this->add_responsive_control(
            'dec_color',
            [
                'label' => esc_html__('Color', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tpp-slider-v2-carousel .tpp-content .tpp-des' => 'color: {{VALUE}}',
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
                    '{{WRAPPER}} .tpp-slider-v2-carousel .tpp-content .tpp-des' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                    '{{WRAPPER}} .tpp-slider-v2-carousel .tpp-content .tpp-des' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();
        // <========================> BUTTON STYLES <========================>
        $this->start_controls_section(
            'topppa_btn_style',
            [
                'label' => esc_html__('Button Style', 'topper-pack'),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'button_and_image_gap',
            [
                'label' => esc_html__('Button Content Gap', 'topper-pack'),
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
                    '{{WRAPPER}} .slider-v1-buttom-area' => 'gap: {{SIZE}}{{UNIT}};',
                ],
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
                'selector' => '{{WRAPPER}} .slider-btn-wrapper .topppa-btn',
            ]
        );

        $this->add_responsive_control(
            'topppa_btn_color',
            [
                'label'     => esc_html__('Color', 'topper-pack'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .slider-btn-wrapper .topppa-btn' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .slider-btn-wrapper .topppa-btn span' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'topppa_btn_background',
                'types' => ['classic', 'gradient', 'video'],
                'selector' => '{{WRAPPER}} .slider-btn-wrapper .topppa-btn',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name'     => 'topppa_btn_border',
                'label'    => esc_html__('Border', 'topper-pack'),
                'selector' => '{{WRAPPER}} .slider-btn-wrapper .topppa-btn',
            ]
        );

        $this->add_responsive_control(
            'topppa_btn_border_radius',
            [
                'label'      => esc_html__('Border Radius', 'topper-pack'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .slider-btn-wrapper .topppa-btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'topppa_btn_box_shadow',
                'label'    => esc_html__('Shadow', 'topper-pack'),
                'selector' => '{{WRAPPER}} .slider-btn-wrapper .topppa-btn',
            ]
        );

        $this->add_control(
            'topppa_btn_icon_styles',
            [
                'label' => esc_html__('Icon Styles', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->add_responsive_control(
            'topppa_btn_icon_gap',
            [
                'label'      => esc_html__('Icon Gap', 'topper-pack'),
                'type'       => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range'      => [
                    'px' => [
                        'min'  => 0,
                        'max'  => 100,
                        'step' => 1,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .slider-btn-wrapper .topppa-btn' => 'gap: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'topppa_btn_icon_width',
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
                    '{{WRAPPER}} .slider-btn-wrapper .topppa-btn .btn-icon' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'topppa_btn_icon_height',
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
                    '{{WRAPPER}} .slider-btn-wrapper .topppa-btn .btn-icon' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'topppa_btn_icon_content_typography',
                'selector' => '{{WRAPPER}} .slider-btn-wrapper .topppa-btn .btn-icon',
            ]
        );
        $this->add_responsive_control(
            'topppa_btn_icon_color',
            [
                'label' => esc_html__('Icon Color', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .topppa-btn-wrapper .topppa-btn .btn-icon' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'topppa_btn_icon_bg',
                'types' => ['classic', 'gradient', 'video'],
                'selector' => '{{WRAPPER}} .slider-btn-wrapper .topppa-btn .btn-icon',
            ]
        );
        $this->add_responsive_control(
            'topppa_btn_icon_border_radius',
            [
                'label' => esc_html__('Border Radius', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .slider-btn-wrapper .topppa-btn .btn-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'topppa_btn_margin',
            [
                'label'      => esc_html__('Margin', 'topper-pack'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .slider-btn-wrapper .topppa-btn' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                    '{{WRAPPER}} .slider-btn-wrapper .topppa-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                'selector' => '{{WRAPPER}} .slider-btn-wrapper .topppa-btn:hover',
            ]
        );

        $this->add_responsive_control(
            'topppa_btn_color_hover',
            [
                'label'     => esc_html__('Color', 'topper-pack'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .slider-btn-wrapper .topppa-btn:hover' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .slider-btn-wrapper .topppa-btn:hover span' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'topppa_btn_background_hover',
                'types' => ['classic', 'gradient', 'video'],
                'selector' => '{{WRAPPER}} .slider-btn-wrapper .topppa-btn:hover',
                'condition' => [
                    'topppa_btn_styles' => ['style_three', 'style_six', 'style_seven']
                ]
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'topppa_btn_background_hover2',
                'types' => ['classic', 'gradient', 'video'],
                'selector' => '{{WRAPPER}} .slider-btn-wrapper .topppa-btn::before, {{WRAPPER}} .slider-btn-wrapper .topppa-btn::after',
                'condition' => [
                    'topppa_btn_styles!' => ['style_three', 'style_six', 'style_seven', 'style_twelve'],
                ]
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name'     => 'topppa_btn_border_hover',
                'label'    => esc_html__('Border', 'topper-pack'),
                'selector' => '{{WRAPPER}} .slider-btn-wrapper .topppa-btn:hover',
            ]
        );

        $this->add_responsive_control(
            'topppa_btn_border_radius_hover',
            [
                'label'      => esc_html__('Border Radius', 'topper-pack'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .slider-btn-wrapper .topppa-btn:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'topppa_btn_box_shadow_hover',
                'label'    => esc_html__('Shadow', 'topper-pack'),
                'selector' => '{{WRAPPER}} .slider-btn-wrapper .topppa-btn:hover',
            ]
        );

        $this->add_control(
            'topppa_btn_icon_hstyles',
            [
                'label' => esc_html__('Icon Styles', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->add_responsive_control(
            'topppa_btn_icon_hcolor',
            [
                'label' => esc_html__('Icon Color', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .topppa-btn-wrapper .topppa-btn:hover .btn-icon' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'topppa_btn_icon_hbgcolor',
                'types' => ['classic', 'gradient', 'video'],
                'selector' => '{{WRAPPER}} .slider-btn-wrapper .topppa-btn:hover .btn-icon',
                'condition' => [
                    'topppa_btn_styles!' => 'style_eight'
                ]
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'topppa_btn_icon_hbgcolor2',
                'types' => ['classic', 'gradient', 'video'],
                'selector' => '{{WRAPPER}} .slider-btn-wrapper .topppa-btn .btn-icon::before',
                'condition' => [
                    'topppa_btn_styles' => 'style_eight'
                ]
            ]
        );
        $this->add_responsive_control(
            'topppa_btn_icon_hborder_radius',
            [
                'label' => esc_html__('Border Radius', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .slider-btn-wrapper .topppa-btn:hover .btn-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                        'max' => 1000,
                        'step' => 5,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .tpp-slider-v2-carousel .tpp-arrows' => 'gap: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'arrow_typography',
                'selector' => '{{WRAPPER}} .tpp-slider-v2-carousel .tpp-arrows button',
            ]
        );
        $this->add_responsive_control(
            'arrow_height',
            [
                'label'      => esc_html__('Height', 'topper-pack'),
                'type'       => \Elementor\Controls_Manager::SLIDER,
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
                'selectors'  => [
                    '{{WRAPPER}} .tpp-slider-v2-carousel .tpp-arrows button' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'arrow_width',
            [
                'label'      => esc_html__('width', 'topper-pack'),
                'type'       => \Elementor\Controls_Manager::SLIDER,
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
                'selectors'  => [
                    '{{WRAPPER}} .tpp-slider-v2-carousel .tpp-arrows button' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'arrow_min_width',
            [
                'label'      => esc_html__('Min width', 'topper-pack'),
                'type'       => \Elementor\Controls_Manager::SLIDER,
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
                'selectors'  => [
                    '{{WRAPPER}} .tpp-slider-v2-carousel .tpp-arrows button' => 'min-width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'custom_top_position',
            [
                'label' => esc_html__('Bottom Position Y', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'vh'], // Units you want
                'range' => [
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                    ],
                    'vh' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'unit' => '%',
                ],
                'selectors' => [
                    '{{WRAPPER}} .tpp-slider-v2-carousel .tpp-arrows' => 'bottom: {{SIZE}}{{UNIT}};',
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
                'label'     => esc_html__('Color', 'topper-pack'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tpp-slider-v2-carousel .tpp-arrows button' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'arrow_background',
                'label' => esc_html__('Background', 'topper-pack'),
                'types' => ['classic', 'gradient', 'video'],
                'selector' => '{{WRAPPER}} .tpp-slider-v2-carousel .tpp-arrows button',
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
                'label'      => esc_html__('Background Blur', 'topper-pack'),
                'type'       => \Elementor\Controls_Manager::SLIDER,
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
                'selectors'  => [
                    '{{WRAPPER}} .tpp-slider-v2-carousel .tpp-arrows button' => 'backdrop-filter: blur({{SIZE}}{{UNIT}});',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name'     => 'arrow_border',
                'label'    => esc_html__('Border', 'topper-pack'),
                'selector' => '{{WRAPPER}} .tpp-slider-v2-carousel .tpp-arrows button',
            ]
        );
        $this->add_responsive_control(
            'arrow_border_radius',
            [
                'label'      => esc_html__('Border Radius', 'topper-pack'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .tpp-slider-v2-carousel .tpp-arrows button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                'label'     => esc_html__('Hover Color', 'topper-pack'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tpp-slider-v2-carousel .tpp-arrows button:hover' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'arrow_background_hover',
                'label' => esc_html__('Background', 'topper-pack'),
                'types' => ['classic', 'gradient', 'video'],
                'selector' => '{{WRAPPER}} .tpp-slider-v2-carousel .tpp-arrows button:hover',
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
                'label'      => esc_html__('Background Blur', 'topper-pack'),
                'type'       => \Elementor\Controls_Manager::SLIDER,
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
                'selectors'  => [
                    '{{WRAPPER}} .tpp-slider-v2-carousel .tpp-arrows button:hover' => 'backdrop-filter: blur({{SIZE}}{{UNIT}});',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name'     => 'arrow_border_hover',
                'label'    => esc_html__('Border', 'topper-pack'),
                'selector' => '{{WRAPPER}} .tpp-slider-v2-carousel .tpp-arrows button:hover',
            ]
        );
        $this->add_responsive_control(
            'arrow_border_radius_hover',
            [
                'label'      => esc_html__('Border Radius', 'topper-pack'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .tpp-slider-v2-carousel .tpp-arrows button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->add_responsive_control(
            'arrow_Margin',
            [
                'label'      => esc_html__('Margin', 'topper-pack'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .slider-arrow-wrp' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'arrow_padding',
            [
                'label'      => esc_html__('Padding', 'topper-pack'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .slider-arrow-wrp' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
        ];

        $button_classes = [
            'style_one' => 'style-one',
            'style_two' => 'style-two',
            'style_three' => 'style-three',
            'style_four' => 'style-four',
            'style_five' => 'style-five',
            'style_six' => 'style-six',
            'style_seven' => 'style-seven',
            'style_eight' => 'style-eight',
            'style_nine' => 'style-nine',
            'style_ten' => 'style-ten',
            'style_eleven' => 'style-eleven',
            'style_twelve' => 'style-twelve',
            'style_thirteen' => 'style-thirteen',
            'style_fourteen' => 'style-fourteen',
            'style_fifteen' => 'style-fifteen',
        ];
        // Get the class name based on the selected style or fallback to an empty string.
        $btn_class = isset($button_classes[$settings['topppa_btn_styles']]) ? $button_classes[$settings['topppa_btn_styles']] : '';
        ob_start();
?>

        <div class="tpp-slider-v2-carousel"
            data-auto-loop="<?php echo esc_attr($settings['enable_slider_auto_loop']); ?>"
            data-slide-speed="<?php echo !empty($settings['slide_speed']) ? esc_attr($settings['slide_speed']) : 5000; ?>"
            data-slider-speed="<?php echo !empty($settings['slider_speed']) ? esc_attr($settings['slider_speed']) : 2000; ?>"
            data-enable-arrow="<?php echo esc_attr($settings['enable_arrow']); ?>">
            <div class="tpp-list">
                <?php foreach ($settings['sliders'] as $i => $item) : ?>
                    <div class="tpp-item" data-index="<?php echo esc_attr($i); ?>" style="background-image:url(<?php echo esc_url(wp_get_attachment_image_url($item['image']['id'], 'full')); ?>)">
                        <div class="topper-pack-table">
                            <div class="topper-pack-table-cell">
                                <div class="container">
                                    <div class="row">
                                        <div class="slider-v2-column col-xl-8 col-lg-9 col-md-12">
                                            <div class="tpp-content">
                                                <div class="tpp-title"><?php echo wp_kses($item['title'], $allowed_html); ?></div>
                                                <?php if ($item['enable_desc'] === 'yes') : ?>
                                                    <div class="tpp-des"><?php echo esc_html($item['desc']); ?></div>
                                                <?php endif; ?>

                                                <?php if ($item['enable_button'] === 'yes' && !empty($item['button_text'])) : ?>
                                                    <div class="slider-v1-buttom-area">
                                                        <?php
                                                        $target = $item['button_link']['is_external'] ? ' target="_blank"' : '';
                                                        $nofollow = $item['button_link']['nofollow'] ? ' rel="nofollow"' : '';
                                                        $custom_attr = !empty($item['button_link']['custom_attributes']) ? $item['button_link']['custom_attributes'] : '';
                                                        ?>
                                                        <div class="topppa-btn-wrapper slider-btn-wrapper <?php echo esc_attr($btn_class); ?>">
                                                            <a href="<?php echo esc_url($item['button_link']['url']); ?>" <?php echo esc_attr($target) . esc_attr($nofollow) . esc_attr($custom_attr); ?> class="topppa-btn">
                                                                <span class="top-btn-text top-btn-text-v3">
                                                                    <?php echo esc_html($item['button_text']); ?>
                                                                </span>
                                                                <?php if ($btn_class === 'style-three') : ?>
                                                                    <span class="bottom-btn-text bottom-btn-text-v3">
                                                                        <?php echo esc_html($item['button_text']); ?>
                                                                    </span>
                                                                <?php endif; ?>
                                                                <?php if (!empty($item['enable_icon']) && $item['enable_icon'] === 'yes' && !empty($item['btn_icon'])) : ?>
                                                                    <div class="btn-icon">
                                                                        <?php \Elementor\Icons_Manager::render_icon($item['btn_icon'], ['aria-hidden' => 'true']); ?>
                                                                    </div>
                                                                <?php endif; ?>
                                                            </a>
                                                        </div>
                                                        <?php if (! empty($item['topppa_button_image']['id'])) : ?>
                                                            <div class="tp-slider-btn-img">
                                                                <?php echo wp_get_attachment_image($item['topppa_button_image']['id'], 'full'); ?>
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
                <?php endforeach; ?>
            </div>

            <?php if ($settings['enable_arrow'] === 'yes') : ?>
                <div class="tpp-arrows">
                    <button class="tpp-prev">
                        <?php \Elementor\Icons_Manager::render_icon($settings['left_arrow_icon'], ['aria-hidden' => 'true']); ?>
                    </button>
                    <button class="tpp-next">
                        <?php \Elementor\Icons_Manager::render_icon($settings['right_arrow_icon'], ['aria-hidden' => 'true']); ?>
                    </button>
                </div>
            <?php endif; ?>
        </div>
<?php
    }
}