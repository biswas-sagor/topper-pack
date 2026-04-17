<?php

use \TopperPack\Includes\Controls\Controls_Manager as TopperPack_Controls_Manager;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

/**
 * Elementor topppa Page Title Widget.
 *
 * Elementor widget that inserts an embbedable content into the page, from any given URL.
 *
 * @since 1.0.0
 */
class Topppa_Hero_Banner_One_Widget extends \Elementor\Widget_Base {

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
        return 'topppa_hero_banner_one';
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
        return TOPPPA_EPWB . esc_html__('Hero Banner One', 'topper-pack');
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
        return 'eicon-share';
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
        return ['topppa', 'widget', 'hero', 'banner', 'topperpack'];
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
        return 'https://doc.topperpack.com/docs/general-widgets/post-share/';
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
            'content_section',
            [
                'label' => esc_html__('Hero Banner One Options', 'topper-pack'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_control(
            'background_image',
            [
                'label' => esc_html__('Background Image', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::MEDIA,
            ]
        );
        // Hero Title
        $this->add_control(
            'hero_title',
            [
                'label' => esc_html__('Hero Title', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('NFXE AGNECY', 'topper-pack'),
                'placeholder' => esc_html__('Enter hero title', 'topper-pack'),
                'label_block' => true,
            ]
        );
        $this->add_control(
            'title_tag',
            [
                'label' => esc_html__('HTML Tag', 'topper-pack'),
                'description' => esc_html__('Add HTML Tag For Title', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'h4',
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
        // Hero Description
        $this->add_control(
            'hero_description',
            [
                'label' => esc_html__('Hero Description', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => esc_html__('We are a creative agency crafting powerful branding, websites, and digital solutions that help businesses stand out and scale faster.', 'topper-pack'),
                'placeholder' => esc_html__('Enter hero description', 'topper-pack'),
                'rows' => 4,
                'label_block' => true,
            ]
        );

        // Hero Year
        $this->add_control(
            'hero_year',
            [
                'label' => esc_html__('Hero Year', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => '2026',
                'placeholder' => esc_html__('Enter year', 'topper-pack'),
            ]
        );

        $this->add_control(
            'enable_button',
            [
                'label' => esc_html__('Enable BUtton', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', 'topper-pack'),
                'label_off' => esc_html__('Hide', 'topper-pack'),
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );
        $this->add_control(
            'topppa_btn_styles',
            [
                'label' => esc_html__('Button Styles', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'style_one',
                'options' => [
                    'style_one' => esc_html__('Style One', 'topper-pack'),
                    'style_two' => esc_html__('Style Two', 'topper-pack'),
                    'style_three' => esc_html__('Style Three', 'topper-pack'),
                    'style_four' => esc_html__('Style Four', 'topper-pack'),
                    'style_five' => esc_html__('Style Five', 'topper-pack'),
                    'style_six' => esc_html__('Style Six', 'topper-pack'),
                    'style_seven' => esc_html__('Style Seven', 'topper-pack'),
                    'style_eight' => esc_html__('Style Eight', 'topper-pack'),
                    'style_nine' => esc_html__('Style Nine', 'topper-pack'),
                    'style_ten' => esc_html__('Style Ten', 'topper-pack'),
                    'style_eleven' => esc_html__('Style Eleven', 'topper-pack'),
                    'style_twelve' => esc_html__('Style Twelve', 'topper-pack'),
                    'style_thirteen' => esc_html__('Style Thirteen', 'topper-pack'),
                    'style_fourteen' => esc_html__('Style Fourteen', 'topper-pack'),
                    'style_fifteen' => esc_html__('Style Fifteen', 'topper-pack'),
                ],
                'condition' => [
                    'enable_button' => 'yes',
                ],
            ]
        );
        $this->add_control(
            'button_text',
            [
                'label' => esc_html__('Button Text', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Book Now', 'topper-pack'),
                'condition' => [
                    'enable_button' => 'yes',
                ],
            ]
        );
        $this->add_control(
            'enable_button_icon',
            [
                'label' => esc_html__('Enable Button Icon', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', 'topper-pack'),
                'label_off' => esc_html__('Hide', 'topper-pack'),
                'return_value' => 'yes',
                'default' => 'no',

                'condition' => [
                    'enable_button' => 'yes',
                ],
            ]
        );
        $this->add_control(
            'btn_icon',
            [
                'label' => esc_html__('Button Icon', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::ICONS,
                'separator' => 'before',
                'default' => [
                    'value' => 'fas fa-arrow-right',
                    'library' => 'fa-solid',
                ],
                'condition' => [
                    'enable_button' => 'yes',
                    'enable_button_icon' => 'yes',
                ]
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'images_section',
            [
                'label' => esc_html__('Images', 'topper-pack'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        // Hero Images
        $this->add_control(
            'hero_images',
            [
                'label' => esc_html__('Hero Images', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::GALLERY,
                'default' => [],
                'description' => esc_html__('Add images for the hero section', 'topper-pack'),
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'hero_banner_grid_overlay_style',
            [
                'label' => esc_html__('Grid Overlay Style', 'topper-pack'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_responsive_control(
            'reveal_background_color',
            [
                'label' => esc_html__('Reveal Background Color', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .hero-banner-one-bg-reveal' => 'background-color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'grid_line_color',
            [
                'label' => esc_html__('Grid Line Color', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .hero-banner-grid-overlay .v-line, {{WRAPPER}} .hero-banner-grid-overlay .h-line' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'vertical_line_width',
            [
                'label' => esc_html__('Vertical Width', 'topper-pack'),
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
                    '{{WRAPPER}} .hero-banner-grid-overlay .v-line' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'horizontal_line_height',
            [
                'label' => esc_html__('Horizontal Height', 'topper-pack'),
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
                    '{{WRAPPER}} .hero-banner-grid-overlay .h-line' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'grid_blur_effect',
            [
                'label' => esc_html__('Blur Effect', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 50,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .hero-banner-grid-overlay .v-line, {{WRAPPER}} .hero-banner-grid-overlay .h-line' => 'backdrop-filter: blur({{SIZE}}{{UNIT}});',
                ],
            ]
        );

        $this->end_controls_section();
        $this->start_controls_section(
            'hero_banner_content_style',
            [
                'label' => esc_html__('Content Style', 'topper-pack'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_responsive_control(
            'hero_content_margin',
            [
                'label' => esc_html__('Margin', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .hero-banner-one-content .hero-banner-one-content-top' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->start_controls_tabs(
            'content_style_tabs'
        );

        $this->start_controls_tab(
            'style_title_tab',
            [
                'label' => esc_html__('Title', 'topper-pack'),
            ]
        );
        $this->add_responsive_control(
            'title_text_align',
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
                    '{{WRAPPER}} .hero-banner-one-title' => 'text-align: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'hero_title_typography',
                'selector' => '{{WRAPPER}} .hero-banner-one-title',
            ]
        );

        $this->add_control(
            'hero_title_color',
            [
                'label' => esc_html__('Color', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .hero-banner-one-title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'hero_title_text_transform',
            [
                'label' => esc_html__('Text Transform', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'uppercase',
                'options' => [
                    'none' => esc_html__('None', 'topper-pack'),
                    'capitalize' => esc_html__('Capitalize', 'topper-pack'),
                    'uppercase' => esc_html__('Uppercase', 'topper-pack'),
                    'lowercase' => esc_html__('Lowercase', 'topper-pack'),
                ],
                'selectors' => [
                    '{{WRAPPER}} .hero-banner-one-title' => 'text-transform: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'hero_title_margin',
            [
                'label' => esc_html__('Margin', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .hero-banner-one-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'hero_title_padding',
            [
                'label' => esc_html__('Padding', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .hero-banner-one-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_tab();
        $this->start_controls_tab(
            'hero_banner_description_style',
            [
                'label' => esc_html__('Description', 'topper-pack'),
            ]
        );
        $this->add_responsive_control(
            'hero_description_alignment',
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
                'selectors' => [
                    '{{WRAPPER}} .hero-banner-one-desc' => 'text-align: {{VALUE}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'hero_description_width',
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
                    '{{WRAPPER}} .hero-banner-one-content .hero-banner-one-left' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'hero_description_typography',
                'selector' => '{{WRAPPER}} .hero-banner-one-desc',
            ]
        );

        $this->add_control(
            'hero_description_color',
            [
                'label' => esc_html__('Color', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .hero-banner-one-desc' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'hero_description_margin',
            [
                'label' => esc_html__('Margin', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .hero-banner-one-desc' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'hero_description_padding',
            [
                'label' => esc_html__('Padding', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .hero-banner-one-desc' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_tab();
        $this->start_controls_tab(
            'hero_banner_year_style',
            [
                'label' => esc_html__('Year', 'topper-pack'),
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'hero_year_typography',
                'selector' => '{{WRAPPER}} .hero-banner-one-year',
            ]
        );

        $this->add_control(
            'hero_year_color',
            [
                'label' => esc_html__('Color', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .hero-banner-one-year' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'hero_year_margin',
            [
                'label' => esc_html__('Margin', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .hero-banner-one-year' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'hero_year_padding',
            [
                'label' => esc_html__('Padding', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .hero-banner-one-year' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();
        $this->start_controls_section(
            'hero_banner_thumbnails_style',
            [
                'label' => esc_html__('Thumbnails Style', 'topper-pack'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'thumbnails_alignment',
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
                'selectors' => [
                    '{{WRAPPER}} .hero-banner-one-thumbs' => 'justify-content: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'thumbnail_width',
            [
                'label' => esc_html__('Width', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'em'],
                'range' => [
                    'px' => [
                        'min' => 20,
                        'max' => 100,
                    ],
                    '%' => [
                        'min' => 5,
                        'max' => 50,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .hero-banner-one-thumbs img' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'thumbnail_height',
            [
                'label' => esc_html__('Height', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'em'],
                'range' => [
                    'px' => [
                        'min' => 20,
                        'max' => 100,
                    ],
                    '%' => [
                        'min' => 5,
                        'max' => 50,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .hero-banner-one-thumbs img' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'thumbnail_border_color',
            [
                'label' => esc_html__('Border Color', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .hero-banner-one-thumbs img' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'thumbnail_border_width',
            [
                'label' => esc_html__('Border Width', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 10,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .hero-banner-one-thumbs img' => 'border-width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'thumbnail_spacing',
            [
                'label' => esc_html__('Spacing', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 20,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .hero-banner-one-thumbs' => 'gap: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'thumbnail_margin',
            [
                'label' => esc_html__('Margin', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .hero-banner-one-thumbs' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'thumbnail_padding',
            [
                'label' => esc_html__('Padding', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .hero-banner-one-thumbs' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
        $this->start_controls_section(
            'topppa_btn_style',
            [
                'label' => esc_html__('Button Style', 'topper-pack'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                'condition' => [
                    'enable_button' => 'yes',
                ]
            ]
        );

        $this->add_responsive_control(
            'topppa_btn_icon_gap',
            [
                'label' => esc_html__('Icon Gap', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                        'step' => 1,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .topppa-trip-v2-button .topppa-btn' => 'gap: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'topppa_show_icon' => 'yes'
                ]
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
                'name' => 'topppa_btn_typo',
                'selector' => '{{WRAPPER}} .topppa-trip-v2-button .topppa-btn',
            ]
        );

        $this->add_responsive_control(
            'topppa_btn_color',
            [
                'label' => esc_html__('Color', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .topppa-trip-v2-button .topppa-btn' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .topppa-trip-v2-button .topppa-btn span' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'topppa_btn_background',
                'types' => ['classic', 'gradient', 'video'],
                'selector' => '{{WRAPPER}} .topppa-trip-v2-button .topppa-btn',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'topppa_btn_border',
                'label' => esc_html__('Border', 'topper-pack'),
                'selector' => '{{WRAPPER}} .topppa-trip-v2-button .topppa-btn',
            ]
        );

        $this->add_responsive_control(
            'topppa_btn_border_radius',
            [
                'label' => esc_html__('Border Radius', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .topppa-trip-v2-button .topppa-btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'topppa_btn_box_shadow',
                'label' => esc_html__('Shadow', 'topper-pack'),
                'selector' => '{{WRAPPER}} .topppa-trip-v2-button .topppa-btn',
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
                    '{{WRAPPER}} .topppa-trip-v2-button .topppa-btn .btn-icon' => 'width: {{SIZE}}{{UNIT}};',
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
                    '{{WRAPPER}} .topppa-trip-v2-button .topppa-btn .btn-icon' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'topppa_btn_icon_content_typography',
                'selector' => '{{WRAPPER}} .topppa-trip-v2-button .topppa-btn .btn-icon',
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'topppa_btn_icon_bg',
                'types' => ['classic', 'gradient', 'video'],
                'selector' => '{{WRAPPER}} .topppa-trip-v2-button .topppa-btn .btn-icon',
            ]
        );
        $this->add_responsive_control(
            'topppa_btn_icon_border_radius',
            [
                'label' => esc_html__('Border Radius', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .topppa-trip-v2-button .topppa-btn .btn-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'topppa_btn_margin',
            [
                'label' => esc_html__('Margin', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .topppa-trip-v2-button .topppa-btn' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'topppa_btn_padding',
            [
                'label' => esc_html__('Padding', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .topppa-trip-v2-button .topppa-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                'name' => 'topppa_btn_typography_hover',
                'selector' => '{{WRAPPER}} .topppa-trip-v2-button .topppa-btn:hover',
            ]
        );

        $this->add_responsive_control(
            'topppa_btn_color_hover',
            [
                'label' => esc_html__('Color', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .topppa-trip-v2-button .topppa-btn:hover' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .topppa-trip-v2-button .topppa-btn:hover span' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'topppa_btn_background_hover',
                'types' => ['classic', 'gradient', 'video'],
                'selector' => '{{WRAPPER}} .topppa-trip-v2-button .topppa-btn:hover',
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
                'selector' => '{{WRAPPER}} .topppa-trip-v2-button .topppa-btn::before, {{WRAPPER}} .topppa-trip-v2-button .topppa-btn::after',
                'condition' => [
                    'topppa_btn_styles!' => ['style_three', 'style_six', 'style_seven', 'style_twelve'],
                ]
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'topppa_btn_border_hover',
                'label' => esc_html__('Border', 'topper-pack'),
                'selector' => '{{WRAPPER}} .topppa-trip-v2-button .topppa-btn:hover',
            ]
        );

        $this->add_responsive_control(
            'topppa_btn_border_radius_hover',
            [
                'label' => esc_html__('Border Radius', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .topppa-trip-v2-button .topppa-btn:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'topppa_btn_box_shadow_hover',
                'label' => esc_html__('Shadow', 'topper-pack'),
                'selector' => '{{WRAPPER}} .topppa-trip-v2-button .topppa-btn:hover',
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
            'topppa_btn_icon_hborder_radius',
            [
                'label' => esc_html__('Border Radius', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .topppa-trip-v2-button .topppa-btn:hover .btn-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'topppa_btn_icon_hbgcolor',
                'types' => ['classic', 'gradient', 'video'],
                'selector' => '{{WRAPPER}} .topppa-trip-v2-button .topppa-btn:hover .btn-icon',
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
                'selector' => '{{WRAPPER}} .topppa-trip-v2-button .topppa-btn:hover .btn-icon::before',
                'condition' => [
                    'topppa_btn_styles' => 'style_eight'
                ]
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();
    }

    /**
     * Render Hero Banner One widget output on the frontend.
     *
     * Written in PHP and used to generate the final HTML.
     *
     * @since 1.0.0
     * @access protected
     */
    protected function render() {
        $settings = $this->get_settings_for_display();

        $hero_title = $settings['hero_title'];
        $hero_description = $settings['hero_description'];
        $hero_year = $settings['hero_year'];
        $hero_images = $settings['hero_images'];
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
        $btn_class = isset($button_classes[$settings['topppa_btn_styles']]) ? $button_classes[$settings['topppa_btn_styles']] : '';

?>
        <section class="hero-banner-one" style="background-image:url(<?php echo esc_url(
                                                                            wp_get_attachment_image_url($settings['background_image']['id'], 'full')
                                                                        ); ?>)">

            <!-- background reveal -->
            <div class="hero-banner-one-bg-reveal"></div>

            <!-- grid overlay -->
            <div class="hero-banner-grid-overlay">
                <span class="v-line"></span>
                <span class="v-line"></span>
                <span class="v-line"></span>
                <span class="v-line"></span>
                <span class="v-line"></span>
                <span class="h-line"></span>
            </div>

            <div class="container-fluid">
                <div class="hero-banner-one-content">

                    <div class="hero-banner-one-content-top">
                        <div class="hero-banner-one-left">
                            <?php if (!empty($hero_images)): ?>
                                <div class="hero-banner-one-thumbs">
                                    <?php foreach ($hero_images as $image) {
                                        echo '<img src="' . esc_url(wp_get_attachment_url($image['id'])) . '">';
                                    } ?>
                                </div>
                            <?php endif; ?>

                            <div class="hero-banner-one-desc">
                                <?php echo wp_kses_post($hero_description); ?>
                            </div>
                        </div>
                        <div class="hero-banner-one-right">
                            <?php if (!empty($hero_year)): ?>
                                <span class="hero-banner-one-year"><?php echo esc_html($hero_year); ?></span>
                            <?php endif; ?>
                            <?php if ($settings['enable_button'] === 'yes'): ?>
                                <div class="topppa-btn-wrapper topppa-trip-v2-button <?php echo esc_attr($btn_class); ?>">
                                    <a href="<?php the_permalink(); ?>" class="topppa-btn">
                                        <span class="top-btn-text top-btn-text-v3">
                                            <?php echo esc_html($settings['button_text']); ?>
                                        </span>

                                        <?php if ($btn_class === 'style-three'): ?>
                                            <span class="bottom-btn-text bottom-btn-text-v3">
                                                <?php echo esc_html($settings['button_text']); ?>
                                            </span>
                                        <?php endif; ?>

                                        <?php if (!empty($settings['enable_button_icon']) && $settings['enable_button_icon'] === 'yes' && !empty($settings['btn_icon'])): ?>
                                            <div class="btn-icon">
                                                <?php \Elementor\Icons_Manager::render_icon($settings['btn_icon'], ['aria-hidden' => 'true']); ?>
                                            </div>
                                        <?php endif; ?>
                                    </a>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                    <<?php echo esc_attr($settings['title_tag']); ?> class="hero-banner-one-title">
                        <?php echo esc_html($hero_title); ?>
                    </<?php echo esc_attr($settings['title_tag']); ?>>

                </div>
            </div>
        </section>

<?php
    }
}
