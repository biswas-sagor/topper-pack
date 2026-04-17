<?php

use \TopperPack\Includes\Controls\Controls_Manager as TopperPack_Controls_Manager;
use \TopperPack\Includes\Utilities;

if (! defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

/**
 * Elementor topppa Brand Logo Widget.
 *
 * Elementor widget that inserts an embbedable content into the page, from any given URL.
 *
 * @since 1.0.0
 */
class TOPPPA_Brand_Logo_Widget extends \Elementor\Widget_Base {

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
        return 'topppa_brand_logo';
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
        return TOPPPA_EPWB . esc_html__('Brand Logo', 'topper-pack');
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
        return 'eicon-blockquote';
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
        return ['topppa', 'widget', 'brand', 'logo', 'info'];
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
        return 'https://doc.topperpack.com/docs/service-widgets/brand-logo/';
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
        return 'https://topperpack.com/assets/widgets/brand-logo-widget/';
    }

    /**
     * Get widget script dependencies.
     *
     * Retrieve the list of script dependencies the widget requires.
     *
     * @since 1.0.0
     * @access public
     *
     * @return array Widget scripts dependencies.
     */
    public function get_script_depends() {
        return [ 'swiper', 'topppa-swiper-script' ];
    }

    /**
     * Get widget style dependencies.
     *
     * Retrieve the list of style dependencies the widget requires.
     *
     * @since 1.0.0
     * @access public
     *
     * @return array Widget style dependencies.
     */
    public function get_style_depends() {
        return [ 'swiper' ];
    }

    public function topppa_brand_logo_hover_effect() {
        $this->add_control(
            'select_hover_effect',
            [
                'label' => esc_html__('Select Hover Effect', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    'none' => esc_html__('None', 'topper-pack'),
                    'left' => esc_html__('Left to Right', 'topper-pack'),
                    'right' => esc_html__('Right to Left', 'topper-pack'),
                    'pro_top' => esc_html__('Top to Bottom (Pro)', 'topper-pack'),
                    'pro_bottom' => esc_html__('Bottom to Top (Pro)', 'topper-pack'),
                    'pro_zoom-in' => esc_html__('Zoom In (Pro)', 'topper-pack'),
                    'pro_zoom-out' => esc_html__('Zoom Out (Pro)', 'topper-pack'),
                    'pro_rotate' => esc_html__('Rotate (Pro)', 'topper-pack'),
                    'pro_swing' => esc_html__('Swing (Pro)', 'topper-pack'),
                ],
                'default' => 'none',
            ]
        );
        Utilities::upgrade_pro_notice( 
            $this, 
            \Elementor\Controls_Manager::RAW_HTML, 
            'topppa_brand_logo',
            'select_hover_effect',
            ['pro_top', 'pro_bottom', 'pro_zoom-in', 'pro_zoom-out', 'pro_rotate', 'pro_swing']
        );
    }


    /**
     * Register Brand Logo widget controls.
     *
     * Add input fields to allow the user to customize the widget settings.
     *
     * @since 1.0.0
     * @access protected
     */
    protected function register_controls() {

        $base_url = $this->get_custom_image_url();

        $this->start_controls_section(
            'content_select_style_content',
            [
                'label' => esc_html__('Brand Logo Select Style', 'topper-pack'),
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
                        'imagelarge' => $base_url . 'style-1.jpg',
                        'imagesmall' => $base_url . 'style-1.jpg',
                        'width' => '100%',
                    ],
                    'style_two' => [
                        'title' => esc_html__('Style 2', 'topper-pack'),
                        'imagelarge' => $base_url . 'style-2.jpg',
                        'imagesmall' => $base_url . 'style-2.jpg',
                        'width' => '100%',
                    ],
                ],
            ]
        );
        $this->end_controls_section();
        $this->start_controls_section(
            'topppa_content_options',
            [
                'label' => esc_html__('Brand Logo Content', 'topper-pack'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_control(
            'important_note',
            [
                'type' => \Elementor\Controls_Manager::ALERT,
                'alert_type' => 'warning',
                'content' => esc_html__('Keeping the logo height consistent is very important to keep the design consistent.', 'topper-pack'),
            ]
        );
        $repeater = new \Elementor\Repeater();
        $repeater->add_control(
            'style_type',
            [
                'label' => esc_html__('Logo Type', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'img' => [
                        'title' => esc_html__('Image', 'topper-pack'),
                        'icon' => 'eicon-image-bold',
                    ],
                    'icon' => [
                        'title' => esc_html__('Icon', 'topper-pack'),
                        'icon' => 'eicon-info-circle',
                    ],
                ],
                'default' => 'img',
            ]
        );

        $repeater->add_control(
            'logo',
            [
                'label' => esc_html__('Image Icon', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'condition' => [
                    'style_type' => 'img',
                ]
            ]
        );

        $repeater->add_control(
            'title',
            [
                'label'       => esc_html__('Title', 'topper-pack'),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => esc_html__('Fundraising Event', 'topper-pack'),
                'label_block' => true,
                'condition' => [
                    'style_type' => 'icon',
                ]
            ]
        );
        $repeater->add_control(
            'enable_icon',
            [
                'label'        => esc_html__('Enable Icon', 'topper-pack'),
                'type'         => \Elementor\Controls_Manager::SWITCHER,
                'label_on'     => esc_html__('Show', 'topper-pack'),
                'label_off'    => esc_html__('Hide', 'topper-pack'),
                'return_value' => 'yes',
                'default'      => 'no',
                'condition' => [
                    'style_type' => 'icon',
                ]
            ]
        );
        $repeater->add_control(
            'icon',
            [
                'label' => esc_html__('Icon', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::ICONS,
                'condition' => [
                    'enable_icon' => 'yes',
                    'style_type' => 'icon',
                ]
            ]
        );
        $repeater->add_control(
            'enable_link',
            [
                'label'        => esc_html__('Enable Link', 'topper-pack'),
                'type'         => \Elementor\Controls_Manager::SWITCHER,
                'label_on'     => esc_html__('Show', 'topper-pack'),
                'label_off'    => esc_html__('Hide', 'topper-pack'),
                'return_value' => 'yes',
                'default'      => 'yes',
            ]
        );
        $repeater->add_control(
            'img_link',
            [
                'label'       => esc_html__('Link', 'topper-pack'),
                'type'        => \Elementor\Controls_Manager::URL,
                'placeholder' => esc_html__('https://your-link.com', 'topper-pack'),
                'options'     => ['url', 'is_external', 'nofollow'],
                'default'     => [
                    'url'         => '',
                    'is_external' => true,
                    'nofollow'    => true,
                ],
                'label_block' => true,
                'condition' => [
                    'enable_link' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'item',
            [
                'label'       => esc_html__('Content', 'topper-pack'),
                'type'        => \Elementor\Controls_Manager::REPEATER,
                'fields'      => $repeater->get_controls(),
                'default'     => [
                    [
                        'logo' => '',
                    ],
                ],
                'title_field' => '{{{ logo.url ? "Image" : "No Image" }}}',
            ]
        );

        $this->topppa_brand_logo_hover_effect();

        $this->add_responsive_control(
            'box_after_color',
            [
                'label'     => esc_html__('After Color', 'topper-pack'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .brand-logo-wrapper.logo-v2 .brand-logo-item .brand-logo::before' => 'background: {{VALUE}}',
                ],
                'condition' => [
                    'select_hover_effect!' => 'none',
                ],
            ]
        );
        $this->add_control(
            'enable_slider',
            [
                'label' => esc_html__('Enable Slider', 'topper-pack'),
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
                'label' => esc_html__('Enable Auto Loop', 'topper-pack'),
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
                'label' => esc_html__('Enable RTL', 'topper-pack'),
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
            'slide_show_large_item',
            [
                'label' => esc_html__('Items to display on Large Devices', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'min' => 1,
                'max' => 50,
                'step' => 1,
                'default' => 5,
                'condition' => [
                    'enable_slider' => 'yes',
                ],
            ]
        );
        $this->add_control(
            'slide_show_tablet_item',
            [
                'label' => esc_html__('Items to display on Tablet Devices', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'min' => 1,
                'max' => 50,
                'step' => 1,
                'default' => 4,
                'condition' => [
                    'enable_slider' => 'yes',
                ],
            ]
        );
        $this->add_control(
            'slide_show_mobile_item',
            [
                'label' => esc_html__('Items to display on Mobile Devices', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'min' => 1,
                'max' => 50,
                'step' => 1,
                'default' => 2,
                'condition' => [
                    'enable_slider' => 'yes',
                ],
            ]
        );
        $this->add_control(
            'slide_show_extra_mobile_item',
            [
                'label' => esc_html__('Items to display on Small Mobile Devices', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'min' => 1,
                'max' => 50,
                'step' => 1,
                'default' => 2,
                'condition' => [
                    'enable_slider' => 'yes',
                ],
            ]
        );
        $this->add_control(
            'slider_space_between',
            [
                'label'   => __('Space Between Slides (px)', 'topper-pack'),
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
                'label' => esc_html__('Slide Speed (ms)', 'topper-pack'),
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
                'label' => esc_html__('Slider Transition Speed (ms)', 'topper-pack'),
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
            'enable_dote',
            [
                'label'        => esc_html__('Enable Dote', 'topper-pack'),
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
                'label'        => esc_html__('Enable Arrow', 'topper-pack'),
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
                'default' => 'text',
                'condition' => [
                    'enable_slider' => 'yes',
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
                'label' => esc_html__('Right Arrow Icon', 'topper-pack'),
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
        $this->add_control(
            'xl_col',
            [
                'label' => esc_html__('Columns on Extra Large Devices', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    'col-xl-2' => esc_html__('2 Columns', 'topper-pack'),
                    'col-xl-3' => esc_html__('3 Columns', 'topper-pack'),
                    'col-xl-4' => esc_html__('4 Columns', 'topper-pack'),
                    'col-xl-6' => esc_html__('6 Columns', 'topper-pack'),
                    'col-xl-12' => esc_html__('12 Columns', 'topper-pack'),
                ],
                'default' => 'col-xl-3',
                'condition' => [
                    'enable_slider!' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'lg_col',
            [
                'label' => esc_html__('Columns on Large Devices', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    'col-lg-2' => esc_html__('2 Columns', 'topper-pack'),
                    'col-lg-3' => esc_html__('3 Columns', 'topper-pack'),
                    'col-lg-4' => esc_html__('4 Columns', 'topper-pack'),
                    'col-lg-6' => esc_html__('6 Columns', 'topper-pack'),
                    'col-lg-12' => esc_html__('12 Columns', 'topper-pack'),
                ],
                'default' => 'col-lg-4',
                'condition' => [
                    'enable_slider!' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'desktop_col',
            [
                'label' => esc_html__('Columns on Desktop', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    'col-md-2' => esc_html__('2 Columns', 'topper-pack'),
                    'col-md-3' => esc_html__('3 Columns', 'topper-pack'),
                    'col-md-4' => esc_html__('4 Columns', 'topper-pack'),
                    'col-md-6' => esc_html__('6 Columns', 'topper-pack'),
                    'col-md-12' => esc_html__('12 Columns', 'topper-pack'),
                ],
                'default' => 'col-md-6',
                'condition' => [
                    'enable_slider!' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'ipadpro_col',
            [
                'label' => esc_html__('Columns on Tablet', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    'col-sm-2' => esc_html__('2 Columns', 'topper-pack'),
                    'col-sm-3' => esc_html__('3 Columns', 'topper-pack'),
                    'col-sm-4' => esc_html__('4 Columns', 'topper-pack'),
                    'col-sm-6' => esc_html__('6 Columns', 'topper-pack'),
                    'col-sm-12' => esc_html__('12 Columns', 'topper-pack'),
                ],
                'default' => 'col-sm-6',
                'condition' => [
                    'enable_slider!' => 'yes',
                ],
            ]
        );
        $this->end_controls_section();
        $this->start_controls_section(
            'content_box_style',
            [
                'label' => esc_html__('Box Style', 'topper-pack'),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
                'condition' => [
                    'topppa_content_select_styles' => 'style_two',
                ],
            ]
        );
        $this->add_responsive_control(
            'content_box_align',
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
                    '{{WRAPPER}} .brand-logo-item .brand-logo' => 'justify-content: {{VALUE}};',
                ],

            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name'     => 'content_box_border',
                'label'    => esc_html__('Border', 'topper-pack'),
                'selector' => '{{WRAPPER}} .brand-logo-wrapper.logo-v2 .row',
            ]
        );
        $this->add_responsive_control(
            'content_box_radius',
            [
                'label'      => esc_html__('Border Radius', 'topper-pack'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .brand-logo-wrapper.logo-v2 .row' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'content_box_shadow',
                'label'    => esc_html__('Box Shadow', 'topper-pack'),
                'selector' => '{{WRAPPER}} .brand-logo-wrapper.logo-v2 .row',
            ]
        );
        $this->end_controls_section();
        $this->start_controls_section(
            'box_style',
            [
                'label' => esc_html__('Content Style', 'topper-pack'),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'box_align',
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
                    '{{WRAPPER}} .brand-logo-item .brand-logo' => 'text-align: {{VALUE}};',
                ],
                'condition' => [
                    'topppa_content_select_styles' => 'style_one',
                ],
            ]
        );
        $this->add_responsive_control(
            'icon_gap',
            [
                'label' => esc_html__('Icon Gap', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .brand-logo-item .brand-logo span' => 'margin-right: {{SIZE}}{{UNIT}}',
                ],
                'separator' => 'before',
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'title_typo',
                'label' => __('Typography', 'topper-pack'),
                'selector' => '{{WRAPPER}} .brand-logo-item .brand-logo',
            ]
        );
        $this->start_controls_tabs(
            'content_tabs'
        );
        $this->start_controls_tab(
            'content_tab',
            [
                'label' => esc_html__('Normal', 'topper-pack'),
            ]
        );
        $this->add_responsive_control(
            'title_color',
            [
                'label'     => esc_html__('Color', 'topper-pack'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .brand-logo-item .brand-logo' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .brand-logo-item .brand-logo svg path' => 'fill: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name'     => 'box_backgrounds',
                'label'    => esc_html__('Background', 'topper-pack'),
                'types'    => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .brand-logo-item .brand-logo',
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name'     => 'box_border',
                'label'    => esc_html__('Border', 'topper-pack'),
                'selector' => '{{WRAPPER}} .brand-logo-item .brand-logo',
            ]
        );
        $this->add_responsive_control(
            'box_border_radius',
            [
                'label'      => esc_html__('Border Radius', 'topper-pack'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .brand-logo-item .brand-logo' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'box_shadow',
                'label'    => esc_html__('Box Shadow', 'topper-pack'),
                'selector' => '{{WRAPPER}} .brand-logo-item .brand-logo',
            ]
        );
        $this->end_controls_tab();
        $this->start_controls_tab(
            'content_hover_tab',
            [
                'label' => esc_html__('Hover', 'topper-pack'),
            ]
        );
        $this->add_responsive_control(
            'title_color_hover',
            [
                'label'     => esc_html__('Hover Color', 'topper-pack'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .brand-logo-item .brand-logo:hover' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name'     => 'box_hover_backgrounds',
                'label'    => esc_html__('Background', 'topper-pack'),
                'types'    => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .brand-logo-item .brand-logo:hover',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name'     => 'box_border_hover',
                'label'    => esc_html__('Border', 'topper-pack'),
                'selector' => '{{WRAPPER}} .brand-logo-item .brand-logo:hover',
            ]
        );
        $this->add_responsive_control(
            'box_border_radius_radius',
            [
                'label'      => esc_html__('Border Radius', 'topper-pack'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .brand-logo-item .brand-logo:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->add_responsive_control(
            'box_margin',
            [
                'label'      => esc_html__('Margin', 'topper-pack'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .brand-logo-item .brand-logo' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                    '{{WRAPPER}} .brand-logo-item .brand-logo' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();
        // <==========>
        // <==========> IMAGE STYLES <==========>

        $this->start_controls_section(
            'brand_img_style',
            [
                'label' => esc_html__('Logo', 'topper-pack'),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_responsive_control(
            'brand_img_height',
            [
                'label'      => esc_html__('Height', 'topper-pack'),
                'type'       => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'custom'],
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
                'selectors'  => [
                    '{{WRAPPER}} .brand-logo-wrapper .brand-logo-item .brand-logo img' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'brand_img_width',
            [
                'label'      => esc_html__('Width', 'topper-pack'),
                'type'       => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'custom'],
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
                'selectors'  => [
                    '{{WRAPPER}} .brand-logo-wrapper .brand-logo-item .brand-logo img' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'brand_img_object',
            [
                'label' => esc_html__('Object Fit', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'cover',
                'options' => [
                    'fill'  => esc_html__('Fill', 'topper-pack'),
                    'contain' => esc_html__('Contain', 'topper-pack'),
                    'cover' => esc_html__('Cover', 'topper-pack'),
                    'none' => esc_html__('None', 'topper-pack'),
                ],
                'selectors' => [
                    '{{WRAPPER}} .brand-logo-wrapper .brand-logo-item .brand-logo img' => 'object-fit: {{VALUE}}',
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
                    'enable_slider' => 'yes',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'arrow_typography',
                'selector' => '{{WRAPPER}} .brand-logo-wrapper .brand-logo-arrow .button',
            ]
        );
        $this->add_responsive_control(
            'arrow_height',
            [
                'label' => esc_html__('Height', 'topper-pack'),
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
                    '{{WRAPPER}} .brand-logo-wrapper .brand-logo-arrow .button' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'arrow_width',
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
                    '{{WRAPPER}} .brand-logo-wrapper .brand-logo-arrow .button' => 'width: {{SIZE}}{{UNIT}};',
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
                    '{{WRAPPER}} .brand-logo-wrapper .brand-logo-arrow .button' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .brand-logo-wrapper .brand-logo-arrow .button svg path' => 'fill: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'arrow_background',
                'label' => esc_html__('Background', 'topper-pack'),
                'types' => ['classic', 'gradient', 'video'],
                'selector' => '{{WRAPPER}} .brand-logo-wrapper .brand-logo-arrow .button',
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
                'name'     => 'arrow_border',
                'label'    => esc_html__('Border', 'topper-pack'),
                'selector' => '{{WRAPPER}} .brand-logo-wrapper .brand-logo-arrow .button',
            ]
        );
        $this->add_responsive_control(
            'arrow_border_radius',
            [
                'label'      => esc_html__('Border Radius', 'topper-pack'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .brand-logo-wrapper .brand-logo-arrow' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                    '{{WRAPPER}} .brand-logo-wrapper .brand-logo-arrow .button:hover' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .brand-logo-wrapper .brand-logo-arrow .button:hover svg path' => 'fill: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'arrow_background_hover',
                'label' => esc_html__('Background', 'topper-pack'),
                'types' => ['classic', 'gradient', 'video'],
                'selector' => '{{WRAPPER}} .brand-logo-wrapper .brand-logo-arrow .button:hover',
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
                'name'     => 'arrow_border_hover',
                'label'    => esc_html__('Border', 'topper-pack'),
                'selector' => '{{WRAPPER}} .brand-logo-wrapper .brand-logo-arrow .button:hover'
            ]
        );
        $this->add_responsive_control(
            'arrow_border_radius_hover',
            [
                'label'      => esc_html__('Border Radius', 'topper-pack'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .brand-logo-wrapper .brand-logo-arrow .button:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                    '{{WRAPPER}} .brand-logo-wrapper .brand-logo-arrow .button' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                    '{{WRAPPER}} .brand-logo-wrapper .brand-logo-arrow .button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();
        
        $this->start_controls_section(
			'dote_content_option',
			[
				'label' => esc_html__('Dots Style', 'topper-pack'),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
				'condition' => [
					'enable_dote' => 'yes',
					'enable_slider' => 'yes',
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
                    '{{WRAPPER}} .topppa-dote-pagination' => 'gap: {{SIZE}}{{UNIT}};',
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 14,
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
                    '{{WRAPPER}} .swiper-pagination-bullets span.swiper-pagination-bullet' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'dote_width',
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
                    '{{WRAPPER}} .swiper-pagination-bullets span.swiper-pagination-bullet' => 'Width: {{SIZE}}{{UNIT}};',
                ],
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
        $this->add_responsive_control(
            'active_dote_width',
            [
                'label'      => esc_html__('Active Width', 'topper-pack'),
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
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'dote_border',
                'selector' => '{{WRAPPER}} .swiper-pagination-bullets span.swiper-pagination-bullet',
            ]
        );
        $this->add_responsive_control(
            'dote_border_radius',
            [
                'label' => esc_html__('Border Radius', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .swiper-pagination-bullets span.swiper-pagination-bullet' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
        $this->add_responsive_control(
            'dote_padding',
            [
                'label'      => esc_html__('Padding', 'topper-pack'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
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
            'a'      => ['href' => []],
            'br'     => [],
            'em'     => [],
            'strong' => [],
        ];
        $style_classes = [
            'style_one' => 'logo-v1',
            'style_two' => 'logo-v2',
        ];

        $class = isset($settings['topppa_content_select_styles']) && isset($style_classes[$settings['topppa_content_select_styles']])
            ? $style_classes[$settings['topppa_content_select_styles']]
            : '';

        $SliderId = wp_rand(12141, 32256); // phpcs:ignore WordPress.WP.AlternativeFunctions.rand_rand
        $column = esc_attr(($settings['xl_col'] ?? '') . ' ' . ($settings['lg_col'] ?? '') . ' ' . ($settings['desktop_col'] ?? '') . ' ' . ($settings['ipadpro_col'] ?? ''));
?>
        <div class="brand-logo-wrapper <?php echo esc_attr($class); ?>">
            <?php if ($settings['enable_slider'] === 'yes') : ?>
                <div class="swiper topppa-swiper-slider topppa-swiper-slider-<?php echo esc_attr($SliderId); ?>"
                    data-slides-per-view="<?php echo esc_attr($settings['slide_show_large_item'] ?? 5); ?>"
                    data-space-between="<?php echo esc_attr($settings['slider_space_between']['size'] ?? 24); ?>"
                    data-auto-loop="<?php echo esc_attr($settings['enable_slider_auto_loop'] ?? 'yes'); ?>"
                    data-slide-speed="<?php echo esc_attr($settings['slide_speed'] ?? 2000); ?>"
                    data-slider-speed="<?php echo esc_attr($settings['slider_speed'] ?? 600); ?>"
                    data-enable-dote="<?php echo esc_attr($settings['enable_dote'] ?? 'no'); ?>"
                    data-enable-arrow="<?php echo esc_attr($settings['enable_arrow'] ?? 'yes'); ?>"
                    data-large-items="<?php echo esc_attr($settings['slide_show_large_item'] ?? 5); ?>"
                    data-tablet-items="<?php echo esc_attr($settings['slide_show_tablet_item'] ?? 4); ?>"
                    data-mobile-items="<?php echo esc_attr($settings['slide_show_mobile_item'] ?? 2); ?>"
                    data-extra-mobile-items="<?php echo esc_attr($settings['slide_show_extra_mobile_item'] ?? 2); ?>"
                    data-enable-rtl="<?php echo esc_attr($settings['enable_rtl'] ?? 'no'); ?>">
            <?php else: ?>
                <div class="no-slider">
            <?php endif; ?>
            <div class="<?php echo esc_attr($settings['enable_slider'] === 'yes' ? 'swiper-wrapper' : 'row'); ?>">
                <?php foreach ($settings['item'] as $logo): ?>
                    <div class="<?php echo esc_attr($settings['enable_slider'] === 'yes' ? 'swiper-slide' : $column); ?>">
                        <div class="brand-logo-item ">
                            <?php if ($logo['enable_link'] === 'yes' && !empty($logo['img_link']['url'])) {
                                $url = $logo['img_link']['url'];
                                $target = !empty($logo['img_link']['is_external']) ? ' target="_blank"' : '';
                                $nofollow = !empty($logo['img_link']['nofollow']) ? ' rel="nofollow"' : '';
                                $custom_attr = !empty($logo['img_link']['custom_attributes']) ? esc_attr($logo['img_link']['custom_attributes']) : '';
                            ?>
                                <a href="<?php echo esc_url($url); ?>" class="brand-logo <?php echo esc_attr($settings['select_hover_effect']); ?>" <?php echo esc_attr($target) . esc_attr($nofollow) . ' ' . esc_attr($custom_attr); ?>>
                                    <?php if ($logo['enable_icon'] === 'yes' && !empty($logo['icon']['value'])): ?>
                                        <span>
                                            <?php \Elementor\Icons_Manager::render_icon($logo['icon'], ['aria-hidden' => 'true']); ?>
                                        </span>
                                    <?php endif; ?>
                                    <?php
                                    echo ($logo['style_type'] === 'img')
                                        ? wp_get_attachment_image($logo['logo']['id'], 'full')
                                        : esc_html($logo['title'] ?? '');
                                    ?>
                                </a>
                            <?php } else { ?>
                                <div class="brand-logo <?php echo esc_attr($settings['select_hover_effect']); ?>">
                                    <?php if ($logo['enable_icon'] === 'yes' && !empty($logo['icon']['value'])): ?>
                                        <span>
                                            <?php \Elementor\Icons_Manager::render_icon($logo['icon'], ['aria-hidden' => 'true']); ?>
                                        </span>
                                    <?php endif; ?>
                                    <?php
                                    echo ($logo['style_type'] === 'img')
                                        ? wp_get_attachment_image($logo['logo']['id'], 'full')
                                        : esc_html($logo['title'] ?? '');
                                    ?>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            <?php if ($settings['enable_arrow'] === 'yes' && $settings['enable_slider'] === 'yes') : ?>
                <div class="brand-logo-arrow">
                    <?php if ($settings['style_arrow_type'] === 'text') : ?>
                        <div class="topppa-arrow-prev topppa-brand-logo-button-prev-<?php echo esc_attr($SliderId); ?> button"><?php echo esc_html__('Prev', 'topper-pack'); ?></div>
                        <div class="topppa-arrow-next topppa-brand-logo-button-next-<?php echo esc_attr($SliderId); ?> button"><?php echo esc_html__('Next', 'topper-pack'); ?></div>
                    <?php else : ?>
                        <div class="topppa-arrow-prev topppa-brand-logo-button-prev-<?php echo esc_attr($SliderId); ?> button">
                            <?php \Elementor\Icons_Manager::render_icon($settings['left_arrow_icon'], ['aria-hidden' => 'true']); ?>
                        </div>
                        <div class="topppa-arrow-next topppa-brand-logo-button-next-<?php echo esc_attr($SliderId); ?> button">
                            <?php \Elementor\Icons_Manager::render_icon($settings['right_arrow_icon'], ['aria-hidden' => 'true']); ?>
                        </div>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
            <?php if ($settings['enable_dote'] === 'yes' && $settings['enable_slider'] === 'yes') : ?>
                <div class="topppa-topppa-dote-pagination-<?php echo esc_attr($SliderId); ?> topppa-dote-pagination"></div>
            <?php endif; ?>
        </div>
<?php
    }
}
