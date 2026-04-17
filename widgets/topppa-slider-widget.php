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
class TOPPPA_Slider_Widget extends \Elementor\Widget_Base {

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
        return 'topppa_slider_widget';
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
        return TOPPPA_EPWB . esc_html__('Slider', 'topper-pack');
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
        return ['topppa', 'widget', 'slider', 'topperpack'];
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
     * Get custom URL for image.
     *
     * Retrieve a URL where the user can get more information about the image.
     *
     * @since 1.0.0
     * @access public
     * @return string Widget image URL.
     */
    public function get_custom_image_url() {
        return 'https://topperpack.com/assets/widgets/icon-box-widget/';
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
        $base_url = $this->get_custom_image_url();

        $this->start_controls_section(
            'topppa_slider_styles_options',
            [
                'label' => esc_html__('Styles', 'topper-pack'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_control(
            'topppa_slider_styles',
            [
                'label' => esc_html__('Choose Style', 'topper-pack'),
                'type' => TopperPack_Controls_Manager::IMAGECHOOSE,
                'default' => 'style_one',
                'options' => [
                    'style_one' => [
                        'title' => esc_html__('Style 1', 'topper-pack'),
                        'imagelarge' => $base_url . 'topppa-slider1.jpg',
                        'imagesmall' => $base_url . 'topppa-slider1.jpg',
                        'width' => '100%',
                    ],
                    'style_two' => [
                        'title' => esc_html__('Style 2', 'topper-pack'),
                        'imagelarge' => $base_url . 'topppa-slider2.jpg',
                        'imagesmall' => $base_url . 'topppa-slider2.jpg',
                        'width' => '100%',
                    ],
                    'style_three' => [
                        'title' => esc_html__('Style 3', 'topper-pack'),
                        'imagelarge' => $base_url . 'topppa-slider3.jpg',
                        'imagesmall' => $base_url . 'topppa-slider3.jpg',
                        'width' => '100%',
                    ],
                ],
            ]
        );
        $this->end_controls_section();

        $this->start_controls_section(
            'slider_option',
            [
                'label' => esc_html__('Slider Content', 'topper-pack'),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->topppa_get_global_button_effects_controls();

        $this->add_control(
            'content_shape_img',
            [
                'label' => esc_html__('Content Shape', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::MEDIA,
            ]
        );

        $this->add_control(
            'content_stroke_title',
            [
                'label' => esc_html__('Stroke Title', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => esc_html__('Clean Services', 'topper-pack'),
                'condition' => [
                    'topppa_slider_styles' => 'style_three',
                ],
            ]
        );

        $repeater = new \Elementor\Repeater();
        $repeater->add_control(
            'image',
            [
                'label' => esc_html__('Background Image', 'topper-pack'),
                'type'  => \Elementor\Controls_Manager::MEDIA,
            ]
        );

        $repeater->add_control(
            'slide_subtitle',
            [
                'label'       => esc_html__('Small Title', 'topper-pack'),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => esc_html__('Welcome To Our Company', 'topper-pack'),
                'label_block' => true,
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
                'default' => 'no',
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
            'enable_video_icon',
            [
                'label'        => esc_html__('Enable Video Icon', 'topper-pack'),
                'type'         => \Elementor\Controls_Manager::SWITCHER,
                'label_on'     => esc_html__('Show', 'topper-pack'),
                'label_off'    => esc_html__('Hide', 'topper-pack'),
                'return_value' => 'yes',
                'default'      => 'no',
                'separator' => 'before',
                'condition' => [
                    'enable_button' => 'yes'
                ],
            ]
        );

        $repeater->add_control(
            'video_icon',
            [
                'label'     => esc_html__('Video Icon', 'topper-pack'),
                'type'      => \Elementor\Controls_Manager::ICONS,
                'default'   => [
                    'value'   => 'fas fa-play',
                    'library' => 'fa-solid',
                ],
                'condition' => [
                    'enable_button' => 'yes',
                    'enable_video_icon' => 'yes'
                ],
            ]
        );

        $repeater->add_control(
            'video_link',
            [
                'label'       => esc_html__('Video URL', 'topper-pack'),
                'type'        => \Elementor\Controls_Manager::URL,
                'label_block' => true,
                'default'     => [
                    'url'         => 'https://www.youtube.com/watch?v=yfFYBo0jtF0',
                    'is_external' => false,
                    'nofollow'    => false,
                ],
                'condition'   => [
                    'enable_button' => 'yes',
                    'enable_video_icon' => 'yes'
                ],
            ]
        );
        $repeater->add_control(
            'video_button_text',
            [
                'label' => esc_html__('Title', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Watch Video', 'topper-pack'),
                'condition'   => [
                    'enable_button' => 'yes',
                    'enable_video_icon' => 'yes'
                ],
            ]
        );
        $repeater->add_responsive_control(
            'video_button_position',
            [
                'label' => esc_html__('Video Button Position', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'right',
                'options' => [
                    'right' => esc_html__('Default', 'topper-pack'),
                    'left' => esc_html__('Inline', 'topper-pack'),
                ],
            ]
        );
        $repeater->add_control(
            'contact_info_switch',
            [
                'label' => esc_html__('Show Contact Information', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', 'topper-pack'),
                'label_off' => esc_html__('Hide', 'topper-pack'),
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );
        $repeater->add_control(
            'contact_info_icon',
            [
                'label' => esc_html__('Icon', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::ICONS,
                'default' => [
                    'value' => 'fas fa-phone-alt',
                    'library' => 'fa-solid',
                ],
                'condition' => [
                    'contact_info_switch' => 'yes'
                ]
            ]
        );
        $repeater->add_control(
            'contact_info_details',
            [
                'label' => esc_html__('Details', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::WYSIWYG,
                'default' => esc_html__('+024 32 369514', 'topper-pack'),
                'condition' => [
                    'contact_info_switch' => 'yes'
                ]
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
                        'slide_subtitle' => esc_html__('Welcoming and Inclusive', 'topper-pack'),
                        'title'          => esc_html__('Christmas Eve Easter Sunrise Good Friday', 'topper-pack'),
                    ],
                    [
                        'slide_subtitle' => esc_html__('A Community for Everyone', 'topper-pack'),
                        'title'          => esc_html__('Join Us for Meaningful Celebrations', 'topper-pack'),
                    ],
                    [
                        'slide_subtitle' => esc_html__('Hope and Faith', 'topper-pack'),
                        'title'          => esc_html__('Discover the Joy of Togetherness', 'topper-pack'),
                    ],
                ],
                'title_field' => '{{{ slide_subtitle }}}',
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
            'slide_show_lagrge_item',
            [
                'label' => esc_html__('Items (Large )', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'min' => 1,
                'max' => 6,
                'step' => 1,
                'default' => 1,
                'condition' => [
                    'enable_slider' => 'yes',
                ],
            ]
        );
        $this->add_control(
            'slide_show_teblet_item',
            [
                'label' => esc_html__('Items (Tabel)', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'min' => 1,
                'max' => 6,
                'step' => 1,
                'default' => 1,
                'condition' => [
                    'enable_slider' => 'yes',
                ],
            ]
        );
        $this->add_control(
            'slide_show_mobile_item',
            [
                'label' => esc_html__('Items (Mobile)', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'min' => 1,
                'max' => 6,
                'step' => 1,
                'default' => 1,
                'condition' => [
                    'enable_slider' => 'yes',
                ],
            ]
        );
        $this->add_control(
            'slide_show_extra_mobile_item',
            [
                'label' => esc_html__('Items (Small Mobile)', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'min' => 1,
                'max' => 6,
                'step' => 1,
                'default' => 1,
                'condition' => [
                    'enable_slider' => 'yes',
                ],
            ]
        );
        $this->add_control(
            'slider_space_between',
            [
                'label'   => __('Spacing (px)', 'topper-pack'),
                'type'    => \Elementor\Controls_Manager::SLIDER,
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
                'default' => 2000,
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
                'label'        => esc_html__('Dots', 'topper-pack'),
                'type'         => \Elementor\Controls_Manager::SWITCHER,
                'label_on'     => esc_html__('On', 'topper-pack'),
                'label_off'    => esc_html__('Off', 'topper-pack'),
                'return_value' => 'yes',
                'default'      => 'no',
                'condition' => [
                    'enable_slider' => 'yes',
                ],
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
                    '{{WRAPPER}} .slider-v1-item-bg' => 'background-position: {{VALUE}}',
                ],
            ]
        );
        $this->add_responsive_control(
            'background_before_blur',
            [
                'label'      => esc_html__('Background Before Blur', 'topper-pack'),
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
                    '{{WRAPPER}} .slider-v1-item-bg:before' => 'backdrop-filter: blur({{SIZE}}{{UNIT}});',
                ],
            ]
        );

        $this->add_responsive_control(
            'image_background_before_color',
            [
                'label' => esc_html__('Background Before Color', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .slider-v1-item-bg:before' => 'background-color: {{VALUE}}',
                ],
            ]
        );
        $this->add_responsive_control(
            'slider_height',
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
                    '{{WRAPPER}} .slider-v1-item-bg' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'content_width',
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
                    '{{WRAPPER}} .slider-v1-column' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'content_text_align',
            [
                'label'       => esc_html__('Content Align', 'topper-pack'),
                'type'        => \Elementor\Controls_Manager::CHOOSE,
                'label_block' => false,

                'options' => [
                    'left' => [
                        'title' => __('Left', 'topper-pack'),
                        'icon'  => 'eicon-justify-start-h',
                    ],

                    'center' => [
                        'title' => __('Center', 'topper-pack'),
                        'icon'  => 'eicon-justify-center-h',
                    ],

                    'right' => [
                        'title' => __('Right', 'topper-pack'),
                        'icon'  => 'eicon-justify-end-h',
                    ],
                ],

                'devices' => ['desktop', 'tablet', 'mobile'],

                'selectors' => [
                    '{{WRAPPER}} .slider-v1-item-bg .row' => 'justify-content: {{VALUE}};text-align: {{VALUE}};',
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
                    '{{WRAPPER}} .slider-v1-content-box' => 'text-align: {{VALUE}};',
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
                    '{{WRAPPER}} .slider-v1-content-box' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                    '{{WRAPPER}} .slider-v1-content-box' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
        // =============================================//
        // ========= SLIDER CONTENT STYLE START ========//
        // =============================================//

        $this->start_controls_section(
            'slider_content_style',
            [
                'label' => esc_html__('Slider Content Style', 'topper-pack'),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'stroke_title_style_heading',
            [
                'label' => esc_html__('Stroke Title Style', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'content_typography',
                'selector' => '{{WRAPPER}} .slider-v1-wrapper.style-three .stroke-text',
            ]
        );

        $this->add_responsive_control(
            'stroke_title_position_X',
            [
                'label' => esc_html__('Ripple Position X', 'topper-pack'),
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
                    '{{WRAPPER}} .slider-v1-wrapper.style-three .stroke-text' => 'left: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'stroke_title_position_Y',
            [
                'label' => esc_html__('Ripple Position Y', 'topper-pack'),
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
                    '{{WRAPPER}} .slider-v1-wrapper.style-three .stroke-text' => 'bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'more_options1',
            [
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'backdrop_blur',
            [
                'label' => esc_html__('Backdrop Blur', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .slider-v1-wrapper.style-two .slider-v1-column' =>
                    '-webkit-backdrop-filter: blur({{SIZE}}{{UNIT}}); backdrop-filter: blur({{SIZE}}{{UNIT}});',
                    '{{WRAPPER}} .slider-v1-wrapper.style-three .slider-column' =>
                    '-webkit-backdrop-filter: blur({{SIZE}}{{UNIT}}); backdrop-filter: blur({{SIZE}}{{UNIT}});',
                ],
            ]
        );

        $this->add_responsive_control(
            'content_max_width',
            [
                'label' => esc_html__('Max Width', 'topper-pack'),
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
                    '{{WRAPPER}} .slider-v1-wrapper.style-two .slider-v1-column' => 'max-width: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .slider-v1-wrapper.style-three .slider-column' => 'max-width: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'topppa_slider_styles!' => 'style_one',
                ],
            ]
        );

        $this->add_responsive_control(
            'content__width',
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
                    '{{WRAPPER}} .slider-v1-wrapper.style-two .slider-v1-column' => 'width: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .slider-v1-wrapper.style-three .slider-column' => 'width: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'topppa_slider_styles!' => 'style_one',
                ],
            ]
        );

        $this->add_responsive_control(
            'ripple_shape_position_X',
            [
                'label' => esc_html__('Ripple Position X', 'topper-pack'),
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
                'default' => [
                    'unit' => '%',
                    'size' => 50,
                ],
                'selectors' => [
                    '{{WRAPPER}} .slider-v1-wrapper.style-three .row .tp-ripple-anim' => 'left: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'ripple_shape_position_Y',
            [
                'label' => esc_html__('Ripple Position Y', 'topper-pack'),
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
                'default' => [
                    'unit' => '%',
                    'size' => 33,
                ],
                'selectors' => [
                    '{{WRAPPER}} .slider-v1-wrapper.style-three .row .tp-ripple-anim' => 'top: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'content_box_text_align',
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
                'default' => 'center',
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .slider-v1-wrapper .slider-v1-column' => 'text-align: {{VALUE}};',
                    '{{WRAPPER}} .slider-v1-wrapper.style-three .slider-column' => 'text-align: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'content_box_box_bg',
                'label' => esc_html__('Background', 'topper-pack'),
                'types' => ['classic', 'gradient', 'video'],
                'selector' => '{{WRAPPER}} .slider-v1-wrapper .slider-v1-column, {{WRAPPER}} .slider-v1-wrapper.style-three .slider-column',
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'content_box_border',
                'label' => esc_html__('Border', 'topper-pack'),
                'selector' => '{{WRAPPER}} .slider-v1-wrapper .slider-v1-column, {{WRAPPER}} .slider-v1-wrapper.style-three .slider-column',
            ]
        );
        $this->add_responsive_control(
            'content_box_radius',
            [
                'label' => esc_html__('Border Radius', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .slider-v1-wrapper .slider-v1-column, {{WRAPPER}} .slider-v1-wrapper.style-three .slider-column' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'content_box_box_shadow',
                'label' => esc_html__('Box Shadow', 'topper-pack'),
                'selector' => '{{WRAPPER}} .slider-v1-wrapper .slider-v1-column, {{WRAPPER}} .slider-v1-wrapper.style-three .slider-column',
            ]
        );
        $this->add_responsive_control(
            'content_box_margin',
            [
                'label' => esc_html__('Margin', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .slider-v1-wrapper .slider-v1-column, {{WRAPPER}} .slider-v1-wrapper.style-three .slider-column' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'content_box_padding',
            [
                'label' => esc_html__('Padding', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .slider-v1-wrapper .slider-v1-column, {{WRAPPER}} .slider-v1-wrapper.style-three .slider-column' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->start_controls_tabs(
            'slider_content_tabs'
        );
        $this->add_control(
            'dot_enable',
            [
                'label'        => esc_html__('Enable Dots?', 'topper-pack'),
                'type'         => \Elementor\Controls_Manager::SWITCHER,
                'label_on'     => esc_html__('Show', 'topper-pack'),
                'label_off'    => esc_html__('Hide', 'topper-pack'),
                'return_value' => 'yes',
                'default'      => 'yes',
                'selectors'    => [
                    '{{WRAPPER}} .slider-v1-content-box .slider-v1-stitle::after, {{WRAPPER}} .slider-v1-content-box .slider-v1-stitle::before' => '{{VALUE}}',
                ],
                'selectors_dictionary' => [
                    'yes' => 'display: none;',
                    ''    => 'display: block;', // empty string = OFF
                ],
            ]
        );
        $this->start_controls_tab(
            'small_title',
            [
                'label' => esc_html__('Small Title', 'topper-pack'),
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'subtitle_title_typo',
                'label' => __('Typography', 'topper-pack'),
                'selector' => '{{WRAPPER}} .slider-v1-stitle',
            ]
        );

        $this->add_control(
            'subtitle_color',
            [
                'label'       => esc_html__('Color', 'topper-pack'),
                'type'        => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .slider-v1-stitle' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'subtitle_before_color',
            [
                'label'       => esc_html__('Befor Color', 'topper-pack'),
                'type'        => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .slider-v1-stitle::before' => 'background-color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'subtitle_after_color',
            [
                'label'       => esc_html__('After Color', 'topper-pack'),
                'type'        => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .slider-v1-stitle::after' => 'background-color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'subtitle_background',
                'types' => ['classic', 'gradient', 'video'],
                'selector' => '{{WRAPPER}} .slider-v1-stitle',
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'subtitle_border',
                'selector' => '{{WRAPPER}} .slider-v1-stitle',
            ]
        );
        $this->add_responsive_control(
            'subtitle_border_radius',
            [
                'label' => esc_html__('Border Radius', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .slider-v1-stitle' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'subtitle_margin',
            [
                'label'      => esc_html__('Margin', 'topper-pack'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .slider-v1-stitle' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                    '{{WRAPPER}} .slider-v1-stitle' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                    {{WRAPPER}} .slider-v1-title',
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
                    '{{WRAPPER}} .slider-v1-title' => 'color: {{VALUE}};',
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
                    '{{WRAPPER}} .slider-v1-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                    '{{WRAPPER}} .slider-v1-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                'selector' => '{{WRAPPER}} .slider-v1-des',
            ]
        );
        $this->add_responsive_control(
            'dec_color',
            [
                'label' => esc_html__('Color', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .slider-v1-des' => 'color: {{VALUE}}',
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
                    '{{WRAPPER}} .slider-v1-des' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                    '{{WRAPPER}} .slider-v1-des' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                'label' => esc_html__('Button', 'topper-pack'),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_responsive_control(
            'wrapper_gap',
            [
                'label' => esc_html__('Wrapper Gap', 'topper-pack'),
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
                    '{{WRAPPER}} .slider-v1-content-box .slider-v1-buttom-area' => 'gap: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'topppa_btn_icon_position',
            [
                'label' => esc_html__('Icon Position', 'topper-pack'),
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
                    '{{WRAPPER}} .slider-btn-wrapper .topppa-btn' => 'flex-direction: {{VALUE}};',
                ],
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
        $this->add_responsive_control(
            'topppa_btn_icon_svg_color',
            [
                'label' => esc_html__('SVG Color', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .topppa-btn-wrapper .topppa-btn .btn-icon svg path' => 'fill: {{VALUE}}',
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
        $this->add_responsive_control(
            'topppa_btn_icon_svg_hcolor',
            [
                'label' => esc_html__('SVG Color', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .topppa-btn-wrapper .topppa-btn:hover .btn-icon svg path' => 'fill: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'topppa_btn_icon_hbgcolor',
                'types' => ['classic', 'gradient', 'video'],
                'selector' => '{{WRAPPER}} .slider-btn-wrapper .topppa-btn .btn-icon',
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
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'topppa_btn_icon_hbg2color',
                'label' => esc_html__('Hover Background 2', 'topper-pack'),
                'types' => ['classic', 'gradient', 'video'],
                'selector' => '{{WRAPPER}} .slider-btn-wrapper .topppa-btn:hover .btn-icon',
                'fields_options' => [
                    'background' => [
                        'label' => esc_html__('Hover Background 2', 'topper-pack'),
                    ],
                ],
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

        // Contact Info
        $this->start_controls_section(
            'contact_info',
            [
                'label' => esc_html__('Contact Info', 'topper-pack'),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_responsive_control(
            'contact_info_gap',
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
                'default' => [
                    'unit' => 'px',
                    'size' => 10,
                ],
                'selectors' => [
                    '{{WRAPPER}} .slider-v1-wrapper .slider-column .slider-v1-buttom-area .slider-contact-info-wrapper' => 'gap: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->start_controls_tabs(
            'contact_info_style_tabs'
        );
        $this->start_controls_tab(
            'info_icon_tab',
            [
                'label' => esc_html__('Title', 'topper-pack'),
            ]
        );
        $this->add_responsive_control(
            'info_icon_width',
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
                    '{{WRAPPER}} .slider-v1-wrapper .slider-column .slider-v1-buttom-area .info-icon' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'info_icon_height',
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
                    '{{WRAPPER}} .slider-v1-wrapper .slider-column .slider-v1-buttom-area .info-icon' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'info_icon_content_typography',
                'selector' => '{{WRAPPER}} .slider-v1-wrapper .slider-column .slider-v1-buttom-area .info-icon',
            ]
        );
        $this->add_responsive_control(
            'info_icon_color',
            [
                'label' => esc_html__('Icon Color', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .slider-v1-wrapper .slider-column .slider-v1-buttom-area .info-icon' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'info_icon_bg',
                'types' => ['classic', 'gradient', 'video'],
                'selector' => '{{WRAPPER}} .slider-v1-wrapper .slider-column .slider-v1-buttom-area .info-icon',
            ]
        );
        $this->add_responsive_control(
            'info_icon_border_radius',
            [
                'label' => esc_html__('Border Radius', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .slider-v1-wrapper .slider-column .slider-v1-buttom-area .info-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'info_icon_margin',
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
            'info_icon_padding',
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
            'info_details_tab',
            [
                'label' => esc_html__('Info Details', 'topper-pack'),
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'info_details_typo',
                'selector' => '{{WRAPPER}} .slider-v1-wrapper .slider-column .slider-v1-buttom-area .topppa-header-info',
            ]
        );
        $this->add_responsive_control(
            'info_details_color',
            [
                'label'     => esc_html__('Color', 'topper-pack'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .slider-v1-wrapper .slider-column .slider-v1-buttom-area .topppa-header-info' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_responsive_control(
            'info_details_link_color',
            [
                'label'     => esc_html__('Link Color', 'topper-pack'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .slider-v1-wrapper .slider-column .slider-v1-buttom-area .topppa-header-info a' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_responsive_control(
            'info_details_link_hcolor',
            [
                'label'     => esc_html__('Link Hover', 'topper-pack'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .slider-v1-wrapper .slider-column .slider-v1-buttom-area .topppa-header-info a:hover' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_responsive_control(
            'info_details_margin',
            [
                'label'      => esc_html__('Margin', 'topper-pack'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .slider-v1-wrapper .slider-column .slider-v1-buttom-area .topppa-header-info' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'info_details_padding',
            [
                'label'      => esc_html__('Padding', 'topper-pack'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .slider-v1-wrapper .slider-column .slider-v1-buttom-area .topppa-header-info' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();

        $this->start_controls_section(
            'video_button_CSS_options',
            [
                'label' => esc_html__('Video Button CSS', 'topper-pack'),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,

            ]
        );
        $this->add_responsive_control(
            'video_align',
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
                    '{{WRAPPER}} .slider-v1-video-wrp' => 'text-align: {{VALUE}}',
                ],
            ]
        );
        $this->add_responsive_control(
            'video_button_gap',
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
                    '{{WRAPPER}} .slider-v1-video-icon' => 'gap: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->start_controls_tabs(
            'video_buttons_tabs'
        );
        $this->start_controls_tab(
            'video_buttons_tabs_normal',
            [
                'label' => __('Normal', 'topper-pack'),
            ]
        );
        $this->add_responsive_control(
            'video_video_icon_height',
            [
                'label' => esc_html__('Icon Height', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 300,
                        'step' => 1,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .slider-v1-video-icon .topppa-play-icon' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'video_video_icon_width',
            [
                'label' => esc_html__('Icon Width', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 300,
                        'step' => 1,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .slider-v1-video-icon .topppa-play-icon' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'video_buttons_Css_typos',
                'label' => esc_html__('Typography', 'topper-pack'),
                'selector' => '{{WRAPPER}} .slider-v1-video-icon .topppa-play-icon',
            ]
        );
        $this->add_responsive_control(
            'video_buttons_Css_ncolor',
            [
                'label' => esc_html__('Color', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .slider-v1-video-icon .topppa-play-icon' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'video_buttons_Css_video_bg',
                'types' => ['classic', 'gradient', 'video'],
                'selector' => '{{WRAPPER}} .slider-v1-video-icon .topppa-play-icon',
            ]
        );
        $this->add_responsive_control(
            'video_buttons_css_blur',
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
                    '{{WRAPPER}} .slider-v1-video-icon .topppa-play-icon' => 'backdrop-filter: blur({{SIZE}}{{UNIT}});',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'video_buttons_Css_nborder',
                'label' => esc_html__('Border', 'topper-pack'),
                'selector' => '{{WRAPPER}} .slider-v1-video-icon .topppa-play-icon',
            ]
        );

        $this->add_responsive_control(
            'video_buttons_Css_nradisu',
            [
                'label' => esc_html__('Border Radius', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .slider-v1-video-icon .topppa-play-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .slider-v1-video-icon .topppa-play-icon:before' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .slider-v1-video-icon .topppa-play-icon:after' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'video_buttons_Css_nshadow',
                'label' => esc_html__('Shadow', 'topper-pack'),
                'selector' => '{{WRAPPER}} .slider-v1-video-icon .topppa-play-icon',
            ]
        );

        $this->add_control(
            'video_text',
            [
                'label' => esc_html__('Video Text', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'video_texttypography',
                'selector' => '{{WRAPPER}} .slider-v1-video-icon .video-text',
            ]
        );
        $this->add_responsive_control(
            'video_text_hcolor',
            [
                'label' => esc_html__('Text Color', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .slider-v1-video-icon .video-text' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_responsive_control(
            'video_text_margin',
            [
                'label' => esc_html__('Margin', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} .slider-v1-video-icon .video-text' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'video_text_padding',
            [
                'label' => esc_html__('Padding', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} .slider-v1-video-icon .video-text' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_tab();

        $this->start_controls_tab(
            'video_buttons_tabs_hover',
            [
                'label' => __('Hover', 'topper-pack'),
            ]
        );
        $this->add_responsive_control(
            'video_buttons_Css_hcolor',
            [
                'label' => esc_html__('Color', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .slider-v1-video-icon .topppa-play-icon:hover' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'video_buttons_Css_nbg_h',
                'types' => ['classic', 'gradient', 'video'],
                'selector' => '{{WRAPPER}} .slider-v1-video-icon .topppa-play-icon:hover',
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'video_buttons_Css_hborder',
                'label' => esc_html__('Border', 'topper-pack'),
                'selector' => '{{WRAPPER}} .slider-v1-video-icon .topppa-play-icon:hover',
            ]
        );

        $this->add_responsive_control(
            'video_buttons_Css_hradisu',
            [
                'label' => esc_html__('Border Radius', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .slider-v1-video-icon .topppa-play-icon:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .slider-v1-video-icon .topppa-play-icon:hover:before' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .slider-v1-video-icon .topppa-play-icon:hover:after' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'video_buttons_Css_hshadow',
                'label' => esc_html__('Shadow', 'topper-pack'),
                'selector' => '{{WRAPPER}} .slider-v1-video-icon .topppa-play-icon:hover',
            ]
        );

        $this->add_responsive_control(
            'video_text_color',
            [
                'label' => esc_html__('Text Color', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .slider-v1-video-icon:hover .video-text' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->end_controls_tab();
        $this->start_controls_tab(
            'video_after_effect',
            [
                'label' => __('After Effect', 'topper-pack'),
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'video_after_bg',
                'label' => esc_html__('Background', 'topper-pack'),
                'types' => ['classic', 'gradient', 'video'],
                'selector' => '{{WRAPPER}} .slider-v1-video-icon .topppa-play-icon:before,{{WRAPPER}} .slider-v1-video-icon .topppa-play-icon:after',
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'video_after_border',
                'label' => esc_html__('Border', 'topper-pack'),
                'selector' => '{{WRAPPER}} .slider-v1-video-icon .topppa-play-icon:before,{{WRAPPER}} .slider-v1-video-icon .topppa-play-icon:after',
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'video_after_shadow',
                'label' => esc_html__('Shadow', 'topper-pack'),
                'selector' => '{{WRAPPER}} .slider-v1-video-icon .topppa-play-icon:before,{{WRAPPER}} .slider-v1-video-icon .topppa-play-icon:after',
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->add_responsive_control(
            'video_button_CSS_margin',
            [
                'label' => esc_html__('Margin', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .slider-v1-video-icon .topppa-play-icon' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'video_button_CSS_padding',
            [
                'label' => esc_html__('Padding', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .slider-v1-video-icon .topppa-play-icon' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();

        // SLIDER DOTS STYLES
        $this->start_controls_section(
            'dote_content_option',
            [
                'label' => esc_html__('Dote Style Option', 'topper-pack'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                'condition' => [
                    'enable_dots' => 'yes',
                ],
            ]
        );
        $this->add_responsive_control(
            'dote_gap',
            [
                'label'      => esc_html__('Gap', 'topper-pack'),
                'type'       => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'custom'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 300,
                        'step' => 1,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .slider-v1-pagination' => 'gap: {{SIZE}}{{UNIT}};',
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
        $this->start_controls_tabs(
            'style_dote_tabs'
        );

        $this->start_controls_tab(
            'style_dote_normal_tab',
            [
                'label' => esc_html__('Normal', 'topper-pack'),
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
            'dote_border_color',
            [
                'label' => esc_html__('Border Color', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .topppa-dote-pagination .swiper-pagination-bullet:after' => 'border-color: {{VALUE}}',
                ],
            ]
        );
        $this->end_controls_tab();

        $this->start_controls_tab(
            'style_dote_hover_tab',
            [
                'label' => esc_html__('Active', 'topper-pack'),
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'dote_background_active',
                'label' => esc_html__('Background', 'topper-pack'),
                'types' => ['classic', 'gradient', 'video'],
                'selector' => '{{WRAPPER}} .swiper-pagination-bullets .swiper-pagination-bullet.swiper-pagination-bullet-active',
                'fields_options' => [
                    'background' => [
                        'label' => esc_html__('Background', 'topper-pack'),
                        'default' => 'classic',
                    ],
                ],
            ]
        );
        $this->add_responsive_control(
            'dote_border_color_active',
            [
                'label' => esc_html__('Border Color', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .swiper-pagination-bullets .swiper-pagination-bullet.swiper-pagination-bullet-active:after' => 'border-color: {{VALUE}}',
                ],
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->add_responsive_control(
            'dote_border_radius',
            [
                'label'      => esc_html__('Border Radius', 'topper-pack'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .topppa-dote-pagination span' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .topppa-dote-pagination .swiper-pagination-bullet:after' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'dote_Margin',
            [
                'label'      => esc_html__('Margin', 'topper-pack'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .topppa-dote-pagination' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
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
            'arrow_wrapper_mwidth',
            [
                'label' => esc_html__('Max Width', 'topper-pack'),
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
                    '{{WRAPPER}} .slider-v1-wrapper .slider-arrow-wrp' => 'max-width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'arrow_wrapper_width',
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
                    '{{WRAPPER}} .slider-v1-wrapper .slider-arrow-wrp' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'more_options',
            [
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'arrow_typography',
                'selector' => '{{WRAPPER}} .slider-arrow-wrp .button',
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
                    '{{WRAPPER}} .slider-arrow-wrp .button' => 'height: {{SIZE}}{{UNIT}};',
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
                    '{{WRAPPER}} .slider-arrow-wrp .button' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'custom_top_position',
            [
                'label' => esc_html__('Top Position', 'topper-pack'),
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
                    '{{WRAPPER}} .slider-v1-wrapper .slider-arrow-wrp' => 'top: {{SIZE}}{{UNIT}};',
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
                    '{{WRAPPER}} .slider-arrow-wrp .button' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'arrow_background',
                'label' => esc_html__('Background', 'topper-pack'),
                'types' => ['classic', 'gradient', 'video'],
                'selector' => '{{WRAPPER}} .slider-arrow-wrp .button',
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
                    '{{WRAPPER}} .slider-arrow-wrp .button' => 'backdrop-filter: blur({{SIZE}}{{UNIT}});',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name'     => 'arrow_border',
                'label'    => esc_html__('Border', 'topper-pack'),
                'selector' => '{{WRAPPER}} .slider-arrow-wrp .button',
            ]
        );
        $this->add_responsive_control(
            'arrow_border_radius',
            [
                'label'      => esc_html__('Border Radius', 'topper-pack'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .slider-arrow-wrp .button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                    '{{WRAPPER}} .slider-arrow-wrp .button:hover' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'arrow_background_hover',
                'label' => esc_html__('Background', 'topper-pack'),
                'types' => ['classic', 'gradient', 'video'],
                'selector' => '{{WRAPPER}} .slider-arrow-wrp .button:hover',
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
                    '{{WRAPPER}} .slider-arrow-wrp .button:hover' => 'backdrop-filter: blur({{SIZE}}{{UNIT}});',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name'     => 'arrow_border_hover',
                'label'    => esc_html__('Border', 'topper-pack'),
                'selector' => '{{WRAPPER}} .slider-arrow-wrp .button:hover',
            ]
        );
        $this->add_responsive_control(
            'arrow_border_radius_hover',
            [
                'label'      => esc_html__('Border Radius', 'topper-pack'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .slider-arrow-wrp .button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
    public function get_script_depends() {
        return ['topppa-slider-widget'];
    }

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

        $style_classes = [
            'style_one' => 'style-one',
            'style_two' => 'style-two',
            'style_three' => 'style-three',
            'style_four' => 'style-four',
            'style_five' => 'style-five',
            'style_six' => 'style-six',
        ];
        // Get the class name based on the selected style or fallback to an empty string.
        $class = isset($style_classes[$settings['topppa_slider_styles']]) ? $style_classes[$settings['topppa_slider_styles']] : '';
        $btn_class = isset($button_classes[$settings['topppa_btn_styles']]) ? $button_classes[$settings['topppa_btn_styles']] : '';
        $SliderId = wp_rand(1241, 3256); // phpcs:ignore WordPress.WP.AlternativeFunctions.rand_rand
        ob_start();
        // Your widget output here
?>

        <div class="slider-v1-wrapper <?php echo esc_attr($class); ?>">
            <?php
            $class = $class ?? '';
            if (!empty($settings['content_stroke_title']) && $class === 'style-three') :
            ?>
                <div class="stroke-text">
                    <?php echo esc_html($settings['content_stroke_title']); ?>
                </div>
            <?php endif; ?>


            <div class="swiper topppa-swiper-slider topppa-swiper-slider-<?php echo esc_attr($SliderId); ?>"
                <?php if ($settings['enable_slider'] === 'yes') : ?>
                data-slides-per-view="<?php echo esc_attr($settings['slide_show_lagrge_item']); ?>"
                data-space-between="<?php echo esc_attr($settings['slider_space_between']['size']); ?>"
                data-auto-loop="<?php echo esc_attr($settings['enable_slider_auto_loop']); ?>"
                data-slide-speed="<?php echo esc_attr($settings['slide_speed']); ?>"
                data-slider-speed="<?php echo esc_attr($settings['slider_speed']); ?>"
                data-enable-dote="<?php echo esc_attr($settings['enable_dots']); ?>"
                data-enable-arrow="<?php echo esc_attr($settings['enable_arrow']); ?>"
                data-large-items="<?php echo esc_attr($settings['slide_show_lagrge_item']); ?>"
                data-tablet-items="<?php echo esc_attr($settings['slide_show_teblet_item']); ?>"
                data-mobile-items="<?php echo esc_attr($settings['slide_show_mobile_item']); ?>"
                data-extra-mobile-items="<?php echo esc_attr($settings['slide_show_extra_mobile_item']); ?>"
                data-enable-rtl="<?php echo esc_attr($settings['enable_rtl']); ?>"
                <?php endif; ?>>
                <div class="swiper-wrapper">
                    <?php foreach ($settings['sliders'] as $item) : ?>
                        <div class="swiper-slide animeslide-slide">
                            <div class="slider-v1-item-bg" style="background-image:url(<?php echo esc_url(wp_get_attachment_image_url($item['image']['id'], 'full')); ?>)">
                                <div class="topper-pack-table">
                                    <div class="topper-pack-table-cell">
                                        <div class="container">
                                            <div class="row">
                                                <div class="tp-ripple-anim">
                                                    <i class="fa-solid fa-circle"></i>
                                                </div>
                                                <?php if ($class !== 'style-three') : ?>
                                                    <div class="slider-v1-column col-xl-8 col-lg-9 col-md-12">
                                                        <div class="content-shape">
                                                            <?php echo wp_get_attachment_image($settings['content_shape_img']['id'], 'full');; ?>
                                                        </div>
                                                        <div class="slider-v1-content-box">
                                                            <?php if (!empty($item['slide_subtitle'])) : ?>
                                                                <div class="slider-v1-stitle" data-animate="bottom">
                                                                    <?php echo esc_html($item['slide_subtitle']); ?>
                                                                </div>
                                                            <?php endif; ?>

                                                            <<?php echo esc_attr($settings['title_tag']); ?> data-animate="bottom" class="button-underline slider-v1-title">
                                                                <?php echo wp_kses($item['title'], $allowed_html); ?>
                                                            </<?php echo esc_attr($settings['title_tag']); ?>>

                                                            <?php if ($item['enable_desc'] === 'yes') : ?>
                                                                <div data-animate="bottom" class="slider-v1-des">
                                                                    <?php echo esc_html($item['desc']); ?>
                                                                </div>
                                                            <?php endif; ?>

                                                            <?php if ($item['enable_button'] === 'yes' && !empty($item['button_text'])) : ?>
                                                                <div class="slider-v1-buttom-area" data-animate="bottom">
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

                                                                    <?php if ($item['contact_info_switch'] === 'yes'): ?>
                                                                        <div class="slider-contact-info-wrapper">
                                                                            <div class="info-icon">
                                                                                <?php \Elementor\Icons_Manager::render_icon($item['contact_info_icon'], ['aria-hidden' => 'true']); ?>
                                                                            </div>

                                                                            <div class="info-details-wrapper">
                                                                                <div class="topppa-header-info">
                                                                                    <?php echo wp_kses($item['contact_info_details'], $allowed_html); ?>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    <?php endif; ?>

                                                                    <?php if ($item['video_button_position'] === 'left') : ?>
                                                                        <?php if ($item['enable_video_icon'] === 'yes' && !empty($item['video_link']['url'])) : ?>
                                                                            <div class="slider-v1-video-icon" data-animate="bottom">
                                                                                <a href="<?php echo esc_url($item['video_link']['url']); ?>" class="topppa-play-icon toppa-video-btn">
                                                                                    <?php \Elementor\Icons_Manager::render_icon($item['video_icon'], ['aria-hidden' => 'true']); ?>
                                                                                </a>
                                                                                <?php if (!empty($item['video_button_text'])) : ?>
                                                                                    <span class="video-text"><?php echo esc_html($item['video_button_text']); ?></span>
                                                                                <?php endif; ?>
                                                                            </div>
                                                                        <?php endif; ?>
                                                                    <?php endif; ?>
                                                                </div>
                                                            <?php endif; ?>
                                                        </div>
                                                    </div>
                                                    <?php if ($item['video_button_position'] === 'right') : ?>
                                                        <?php if ($item['enable_video_icon'] === 'yes' && !empty($item['video_link']['url'])) : ?>
                                                            <div class="col-xl-4 col-lg-3 col-md-12 slider-v1-video-wrp">
                                                                <div class="slider-v1-video-icon" data-animate="bottom">
                                                                    <a href="<?php echo esc_url($item['video_link']['url']); ?>" class="play-icon toppa-video-btn">
                                                                        <?php \Elementor\Icons_Manager::render_icon($item['video_icon'], ['aria-hidden' => 'true']); ?>
                                                                    </a>
                                                                    <span class="video-text"><?php echo esc_html($item['video_button_text']); ?></span>
                                                                </div>
                                                            </div>
                                                        <?php endif; ?>
                                                    <?php endif; ?>

                                                    <!-- Slider Style Three -->
                                                <?php else: ?>
                                                    <div class="slider-column col-xl-6 col-lg-6 col-md-12">
                                                        <div class="content-shape">
                                                            <?php echo wp_get_attachment_image($settings['content_shape_img']['id'], 'full');; ?>
                                                        </div>
                                                        <div class="slider-v1-content-box">
                                                            <?php if (!empty($item['slide_subtitle'])) : ?>
                                                                <div class="slider-v1-stitle" data-animate="bottom">
                                                                    <?php echo esc_html($item['slide_subtitle']); ?>
                                                                </div>
                                                            <?php endif; ?>

                                                            <<?php echo esc_attr($settings['title_tag']); ?> data-animate="bottom" class="button-underline slider-v1-title">
                                                                <?php echo wp_kses($item['title'], $allowed_html); ?>
                                                            </<?php echo esc_attr($settings['title_tag']); ?>>

                                                            <?php if ($item['enable_desc'] === 'yes') : ?>
                                                                <div data-animate="bottom" class="slider-v1-des">
                                                                    <?php echo esc_html($item['desc']); ?>
                                                                </div>
                                                            <?php endif; ?>

                                                            <?php if ($item['enable_button'] === 'yes' && !empty($item['button_text'])) : ?>
                                                                <div class="slider-v1-buttom-area" data-animate="bottom">
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

                                                                    <?php if ($item['contact_info_switch'] === 'yes'): ?>
                                                                        <div class="slider-contact-info-wrapper">
                                                                            <div class="info-icon">
                                                                                <?php \Elementor\Icons_Manager::render_icon($item['contact_info_icon'], ['aria-hidden' => 'true']); ?>
                                                                            </div>

                                                                            <div class="info-details-wrapper">
                                                                                <div class="topppa-header-info">
                                                                                    <?php echo wp_kses($item['contact_info_details'], $allowed_html); ?>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    <?php endif; ?>

                                                                    <?php if ($item['video_button_position'] === 'left') : ?>
                                                                        <?php if ($item['enable_video_icon'] === 'yes' && !empty($item['video_link']['url'])) : ?>
                                                                            <div class="slider-v1-video-icon" data-animate="bottom">
                                                                                <a href="<?php echo esc_url($item['video_link']['url']); ?>" class="topppa-play-icon toppa-video-btn">
                                                                                    <?php \Elementor\Icons_Manager::render_icon($item['video_icon'], ['aria-hidden' => 'true']); ?>
                                                                                </a>
                                                                                <?php if (!empty($item['video_button_text'])) : ?>
                                                                                    <span class="video-text"><?php echo esc_html($item['video_button_text']); ?></span>
                                                                                <?php endif; ?>
                                                                            </div>
                                                                        <?php endif; ?>
                                                                    <?php endif; ?>
                                                                </div>
                                                            <?php endif; ?>
                                                        </div>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <?php if ('yes' === $settings['enable_dots']) : ?>
                <div class="slider-v1-pagination topppa-dote-pagination topppa-topppa-dote-pagination-<?php echo esc_attr($SliderId); ?>"></div>
            <?php endif; ?>
            <?php if ('yes' === $settings['enable_arrow']) : ?>
                <div class="slider-arrow-wrp">
                    <div class="slider-prev button topppa-brand-logo-button-prev-<?php echo esc_attr($SliderId); ?>">
                        <?php
                        if ($settings['style_arrow_type'] === 'text') {
                            echo esc_attr('Prev');
                        } elseif ($settings['style_arrow_type'] === 'arrow_icons') {
                            \Elementor\Icons_Manager::render_icon($settings['left_arrow_icon'], ['aria-hidden' => 'true']);
                        }
                        ?>
                    </div>
                    <div class="slider-next button topppa-brand-logo-button-next-<?php echo esc_attr($SliderId); ?>">
                        <?php
                        if ($settings['style_arrow_type'] === 'text') {
                            echo esc_attr('Next');
                        } elseif ($settings['style_arrow_type'] === 'arrow_icons') {
                            \Elementor\Icons_Manager::render_icon($settings['right_arrow_icon'], ['aria-hidden' => 'true']);
                        }
                        ?>
                    </div>
                </div>
            <?php endif; ?>
        </div>
<?php
    }
}
