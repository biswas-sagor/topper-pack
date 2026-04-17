<?php

use \TopperPack\Includes\Controls\Controls_Manager as TopperPack_Controls_Manager;

if (! defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

/**
 * Elementor TOPPPA Audio Widget.
 *
 * Elementor widget that inserts an embbedable content into the page, from any given URL.
 *
 * @since 1.0.0
 */
class TOPPPA_Trip_Module_v2_Widget extends \Elementor\Widget_Base {

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
        return 'trip-module-v2';
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
        return TOPPPA_EPWB . esc_html__('Trip Module V2', 'topper-pack');
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
        return 'eicon-headphones';
    }

    /**
     * Get widget categories.
     *
     * Retrieve the list of categories the audio widget belongs to.
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
     * Retrieve the list of keywords the audio widget belongs to.
     *
     * @since 1.0.0
     * @access public
     * @return array Widget keywords.
     */
    public function get_keywords() {
        return ['topppa', 'widget', 'Trip Module', 'travel', 'topperpack'];
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
        return 'https://doc.topperpack.com/docs/post-widgets/audio-player/';
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
        return 'https://topperpack.com/assets/widgets/audio-player-widget/';
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
        $this->start_controls_section(
            'topppa_content_style',
            [
                'label' => esc_html__('TP Trip Options', 'topper-pack'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_control(
            'select_style',
            [
                'label' => esc_html__('Select Style', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'style_one',
                'options' => [
                    'style_one' => esc_html__('Style One', 'topper-pack'),
                    'style_two' => esc_html__('Style Two', 'topper-pack'),
                    'style_three' => esc_html__('Style Three', 'topper-pack'),
                ],
            ]
        );
        $this->add_control(
            'posts_per_page',
            [
                'label' => esc_html__('Number of Trips', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'default' => 3,
            ]
        );
        $this->add_control(
            'enable_icon',
            [
                'label'        => esc_html__('Enable Icon', 'topper-pack'),
                'type'         => \Elementor\Controls_Manager::SWITCHER,
                'label_on'     => esc_html__('Show', 'topper-pack'),
                'label_off'    => esc_html__('Hide', 'topper-pack'),
                'return_value' => 'yes',
                'default'      => 'yes',
                'condition' => [
                    'select_style' => 'style_three',
                ],
            ]
        );
        $this->add_control(
            'image_icon',
            [
                'label' => esc_html__('Icon', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::ICONS,
                'default' => [
                    'value' => 'far fa-eye',
                    'library' => 'solid',
                ],
                'condition' => [
                    'enable_icon' => 'yes',
                    'select_style' => 'style_three',
                ],
            ]
        );
        $this->add_control(
            'enable_meta',
            [
                'label' => esc_html__('Enable Meta', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', 'topper-pack'),
                'label_off' => esc_html__('Hide', 'topper-pack'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );
        $this->add_control(
            'enable_meta_icon',
            [
                'label' => esc_html__('Enable Meta Icon', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', 'topper-pack'),
                'label_off' => esc_html__('Hide', 'topper-pack'),
                'return_value' => 'yes',
                'default' => 'yes',
                'condition' => [
                    'enable_meta' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'select_trip_meta',
            [
                'label'       => esc_html__('Trip Meta Fields', 'topper-pack'),
                'type'        => \Elementor\Controls_Manager::SELECT,
                'label_block' => true,
                'multiple'    => true,
                'options'     => [
                    'destination'   => esc_html__('Destination', 'topper-pack'),
                    'activity'   => esc_html__('Activities', 'topper-pack'),
                    'trip-types' => esc_html__('Trip Type', 'topper-pack'),
                ],
                'default'     => 'destination',
                'condition' => [
                    'enable_meta' => 'yes',
                ],
            ]
        );
        $this->add_control(
            'enable_price',
            [
                'label' => esc_html__('Enable Price', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', 'topper-pack'),
                'label_off' => esc_html__('Hide', 'topper-pack'),
                'return_value' => 'yes',
                'default' => 'no',
                'condition' => [
                    'select_style' => 'style_two',
                ],
            ]
        );
        $this->add_control(
            'pricing_text',
            [
                'label'     => esc_html__('Pricing Text', 'topper-pack'),
                'type'      => \Elementor\Controls_Manager::TEXT,
                'default'   => esc_html__('ticket', 'topper-pack'),
                'condition' => [
                    'enable_price' => 'yes',
                    'select_style' => 'style_two',
                ],
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
                    'h1'  => esc_html__('H1', 'topper-pack'),
                    'h2'  => esc_html__('H2', 'topper-pack'),
                    'h3'  => esc_html__('H3', 'topper-pack'),
                    'h4'  => esc_html__('H4', 'topper-pack'),
                    'h5'  => esc_html__('H5', 'topper-pack'),
                    'h6'  => esc_html__('H6', 'topper-pack'),
                    'p'  => esc_html__('P', 'topper-pack'),
                    'span'  => esc_html__('span', 'topper-pack'),
                    'div'  => esc_html__('Div', 'topper-pack'),
                ],
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
                'condition' => [
                    'select_style!' => 'style_three',
                ],
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
                    'select_style!' => 'style_three',
                ],
            ]
        );
        $this->add_control(
            'button_text',
            [
                'label'     => esc_html__('Button Text', 'topper-pack'),
                'type'      => \Elementor\Controls_Manager::TEXT,
                'default'   => esc_html__('Book Now', 'topper-pack'),
                'condition' => [
                    'enable_button' => 'yes',
                    'select_style!' => 'style_three',
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

                'condition'   => [
                    'enable_button' => 'yes',
                    'select_style!' => 'style_three',
                ],
            ]
        );
        $this->add_control(
            'btn_icon',
            [
                'label'   => esc_html__('Button Icon', 'topper-pack'),
                'type'    => \Elementor\Controls_Manager::ICONS,
                'separator' => 'before',
                'default' => [
                    'value'   => 'fas fa-arrow-right',
                    'library' => 'fa-solid',
                ],
                'condition' => [
                    'enable_button' => 'yes',
                    'enable_button_icon' => 'yes',
                    'select_style!' => 'style_three',
                ]
            ]
        );

        $this->end_controls_section();
        $this->start_controls_section(
            'additional_info',
            [
                'label' => esc_html__('Additional Info', 'topper-pack'),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_responsive_control(
            'select_layout',
            [
                'label' => esc_html__('Style Layout', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'grid',
                'options' => [
                    'grid' => esc_html__('Grid', 'topper-pack'),
                    'slider' => esc_html__('Slider', 'topper-pack'),
                ],
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
                    'select_layout' => 'slider',
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
                    'select_layout' => 'slider',
                ],
            ]
        );

        $this->add_control(
            'slide_show_lagrge_item',
            [
                'label' => esc_html__('Display on Large Devices', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'min' => 1,
                'max' => 6,
                'step' => 1,
                'default' => 3,
                'condition' => [
                    'select_layout' => 'slider',
                ],
            ]
        );
        $this->add_control(
            'slide_show_teblet_item',
            [
                'label' => esc_html__('Display on Teblet Devices', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'min' => 1,
                'max' => 6,
                'step' => 1,
                'default' => 3,
                'condition' => [
                    'select_layout' => 'slider',
                ],
            ]
        );
        $this->add_control(
            'slide_show_mobile_item',
            [
                'label' => esc_html__('Display on Mobile Devices', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'min' => 1,
                'max' => 6,
                'step' => 1,
                'default' => 2,
                'condition' => [
                    'select_layout' => 'slider',
                ],
            ]
        );
        $this->add_control(
            'slide_show_extra_mobile_item',
            [
                'label' => esc_html__('Display on Small Devices', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'min' => 1,
                'max' => 6,
                'step' => 1,
                'default' => 1,
                'condition' => [
                    'select_layout' => 'slider',
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
                    'select_layout' => 'slider',
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
                    'select_layout' => 'slider',
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
                    'select_layout' => 'slider',
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
                    'select_layout' => 'slider',
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
                    'select_layout' => 'slider',
                ],
            ]
        );
        $this->add_control(
            'select_arrow',
            [
                'label' => esc_html__('Arrow Styles', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'arrow_one',
                'options' => [
                    'arrow_one' => esc_html__('Style One', 'topper-pack'),
                    'arrow_two' => esc_html__('Style Two', 'topper-pack'),
                ],
                'condition' => [
                    'enable_arrow' => 'yes',
                    'select_layout' => 'slider',
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
                    'select_layout' => 'slider',
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
                    'select_layout' => 'slider',
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
                    'select_layout' => 'slider',
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
                    'select_layout' => 'slider',
                    'style_arrow_type' => 'arrow_icons',
                ],
            ]
        );
        $this->add_control(
            'xl_col',
            [
                'label' => esc_html__('Extra Large Devices', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    'col-xl-2' => esc_html__('6 Columns', 'topper-pack'),
                    'col-xl-3' => esc_html__('4 Columns', 'topper-pack'),
                    'col-xl-4' => esc_html__('3 Columns', 'topper-pack'),
                    'col-xl-6' => esc_html__('2 Columns', 'topper-pack'),
                    'col-xl-12' => esc_html__('1 Columns', 'topper-pack'),
                ],
                'default' => 'col-xl-4',
                'condition' => [
                    'select_layout' => 'grid',
                ],
            ]
        );

        $this->add_control(
            'lg_col',
            [
                'label' => esc_html__('Teblet Devices', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    'col-lg-2' => esc_html__('6 Columns', 'topper-pack'),
                    'col-lg-3' => esc_html__('4 Columns', 'topper-pack'),
                    'col-lg-4' => esc_html__('3 Columns', 'topper-pack'),
                    'col-lg-6' => esc_html__('2 Columns', 'topper-pack'),
                    'col-lg-12' => esc_html__('1 Columns', 'topper-pack'),
                ],
                'default' => 'col-lg-4',
                'condition' => [
                    'select_layout' => 'grid',
                ],
            ]
        );

        $this->add_control(
            'md-col',
            [
                'label' => esc_html__('Mobile Devices', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    'col-md-2' => esc_html__('6 Columns', 'topper-pack'),
                    'col-md-3' => esc_html__('4 Columns', 'topper-pack'),
                    'col-md-4' => esc_html__('3 Columns', 'topper-pack'),
                    'col-md-6' => esc_html__('2 Columns', 'topper-pack'),
                    'col-md-12' => esc_html__('1 Columns', 'topper-pack'),
                ],
                'default' => 'col-md-6',
                'condition' => [
                    'select_layout' => 'grid',
                ],
            ]
        );
        $this->end_controls_section();
        // <==========>
        // <==========> BOX STYLES <==========>

        $this->start_controls_section(
            'box_styles',
            [
                'label' => esc_html__('Box Style', 'topper-pack'),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_responsive_control(
            'content_box_align',
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
                    '{{WRAPPER}} .topppa-trip-v2-item .topppa-trip-v2-content' => 'text-align: {{VALUE}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'box_height',
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
                'default' => [
                    'unit' => 'px',
                ],
                'selectors' => [
                    '{{WRAPPER}} .topppa-trip-v2-item ' => 'height: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'select_style!' => 'style_four',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'box_border',
                'label' => esc_html__('Border', 'topper-pack'),
                'selector' => '{{WRAPPER}} .topppa-trip-v2-item',
            ]
        );
        $this->add_responsive_control(
            'box_radius',
            [
                'label' => esc_html__('Border Radius', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .topppa-trip-v2-item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'box_shadow',
                'label' => esc_html__('Box Shadow', 'topper-pack'),
                'selector' => '{{WRAPPER}} .topppa-trip-v2-item',
            ]
        );
        $this->add_responsive_control(
            'box_margin',
            [
                'label' => esc_html__('Margin', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .topppa-trip-v2-item' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                    '{{WRAPPER}} .topppa-trip-v2-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'select_style!' => ['style_one', 'style_two'],
                ],
            ]
        );
        $this->add_responsive_control(
            'box1_padding',
            [
                'label' => esc_html__('Padding', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .topppa-trip-v2-item .topppa-trip-v2-content-area' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'select_style' => ['style_one', 'style_two'],
                ],
            ]
        );
        $this->end_controls_section();

        $this->start_controls_section(
            'inner_box_styles',
            [
                'label' => esc_html__('Innre Box Style', 'topper-pack'),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
                'condition' => [
                    'select_style' => ['style_one', 'style_two'],
                ],
            ]
        );
        $this->add_responsive_control(
            'content_bottom',
            [
                'label' => esc_html__('Content Bottom', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'range' => [
                    'px' => [
                        'min' => -500,
                        'max' => 500,
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
                    '{{WRAPPER}} .topppa-trip-v2-item .topppa-trip-v2-content' => 'bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'after_bg_color',
            [
                'label' => esc_html__('After Bg Color', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .topppa-trip-v2-item .topppa-trip-v2-content::after' => 'background-color: {{VALUE}}',
                ],
                'condition' => [
                    'select_style' => 'style_two',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'after_bg_shadow',
                'selector' => '{{WRAPPER}} .topppa-trip-v2-item .topppa-trip-v2-content::after',
                'condition' => [
                    'select_style' => 'style_two',
                ],
            ]
        );
        $this->start_controls_tabs(
            'style_tabs'
        );

        $this->start_controls_tab(
            'style_normal_tab',
            [
                'label' => esc_html__('Normal', 'topper-pack'),
            ]
        );
        $this->add_responsive_control(
            'background_css_blur',
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
                    '{{WRAPPER}} .topppa-trip-v2-content' => 'backdrop-filter: blur({{SIZE}}{{UNIT}});',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'inner_box_bg',
                'label' => esc_html__('Background', 'topper-pack'),
                'types' => ['classic', 'gradient', 'video'],
                'selector' => '{{WRAPPER}} .topppa-trip-v2-content',
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'inner_box_border',
                'label' => esc_html__('Border', 'topper-pack'),
                'selector' => '{{WRAPPER}} .topppa-trip-v2-content',
            ]
        );
        $this->add_responsive_control(
            'inner_box_radius',
            [
                'label' => esc_html__('Border Radius', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .topppa-trip-v2-content' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'inner_box_shadow',
                'label' => esc_html__('Box Shadow', 'topper-pack'),
                'selector' => '{{WRAPPER}} .topppa-trip-v2-content',
            ]
        );
        $this->add_responsive_control(
            'inner_box_padding',
            [
                'label' => esc_html__('Padding', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .topppa-trip-v2-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_tab();

        $this->start_controls_tab(
            'style_hover_tab',
            [
                'label' => esc_html__('Hover', 'topper-pack'),
            ]
        );
        $this->add_responsive_control(
            'background_css_blur_hover',
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
                    '{{WRAPPER}} .topppa-trip-v2-item-wrp .topppa-trip-v2-item:hover .topppa-trip-v2-content' => 'backdrop-filter: blur({{SIZE}}{{UNIT}});',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'inner_box_bg_hover',
                'label' => esc_html__('Background', 'topper-pack'),
                'types' => ['classic', 'gradient', 'video'],
                'selector' => '{{WRAPPER}} .topppa-trip-v2-item-wrp .topppa-trip-v2-item:hover .topppa-trip-v2-content',
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'inner_box_border_hover',
                'label' => esc_html__('Border', 'topper-pack'),
                'selector' => '{{WRAPPER}} .topppa-trip-v2-item-wrp .topppa-trip-v2-item:hover .topppa-trip-v2-content',
            ]
        );
        $this->add_responsive_control(
            'inner_box_radius_hover',
            [
                'label' => esc_html__('Border Radius', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .topppa-trip-v2-item-wrp .topppa-trip-v2-item:hover .topppa-trip-v2-content' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'inner_box_shadow_hover',
                'label' => esc_html__('Box Shadow', 'topper-pack'),
                'selector' => '{{WRAPPER}} .topppa-trip-v2-item-wrp .topppa-trip-v2-item:hover .topppa-trip-v2-content',
            ]
        );
        $this->add_responsive_control(
            'inner_box_padding_hover',
            [
                'label' => esc_html__('Padding', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .topppa-trip-v2-item-wrp .topppa-trip-v2-item:hover .topppa-trip-v2-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->add_responsive_control(
            'inner_box_margin',
            [
                'label' => esc_html__('Margin', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .topppa-trip-v2-item-wrp .topppa-trip-v2-item .topppa-trip-v2-content' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();
        $this->start_controls_section(
            'content_styles_option',
            [
                'label' => esc_html__('Content Style', 'topper-pack'),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'content_background_css_blur',
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
                    '{{WRAPPER}} .topppa-trip-v2-item .topppa-trip-v2-content-area' => 'backdrop-filter: blur({{SIZE}}{{UNIT}});',
                ],
                'condition' => [
                    'select_style' => ['style_three'],
                ],
            ]
        );
        $this->add_responsive_control(
            'content_box_bg',
            [
                'label' => esc_html__('Background Color', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .topppa-trip-v2-item .topppa-trip-v2-content-area' => 'background-color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'content_box_border',
                'label' => esc_html__('Border', 'topper-pack'),
                'selector' => '{{WRAPPER}} .topppa-trip-v2-item .topppa-trip-v2-content-area',
                'condition' => [
                    'select_style' => ['style_three'],
                ],
            ]
        );
        $this->add_responsive_control(
            'content_box_radius',
            [
                'label' => esc_html__('Border Radius', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .topppa-trip-v2-item .topppa-trip-v2-content-area' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'select_style' => ['style_three'],
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'content_box_shadow',
                'label' => esc_html__('Box Shadow', 'topper-pack'),
                'selector' => '{{WRAPPER}} .topppa-trip-v2-item .topppa-trip-v2-content-area',
                'condition' => [
                    'select_style' => ['style_three'],
                ],
            ]
        );
        $this->add_responsive_control(
            'content_box_margin_style_three',
            [
                'label' => esc_html__('Margin', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .topppa-trip-v2-item .topppa-trip-v2-content-area' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'select_style' => 'style_three',
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
                    '{{WRAPPER}} .topppa-trip-v2-item .topppa-trip-v2-content-area' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'select_style' => ['style_three'],
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
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'title_typo',
                'selector' => '{{WRAPPER}} .topppa-trip-v2-item .topppa-trip-v2-title',
            ]
        );
        $this->add_responsive_control(
            'title_color',
            [
                'label'     => esc_html__('Color', 'topper-pack'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .topppa-trip-v2-item .topppa-trip-v2-title' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .topppa-trip-v2-item .topppa-trip-v2-title a' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_responsive_control(
            'title_hcolor',
            [
                'label'     => esc_html__('Hover Color', 'topper-pack'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .topppa-trip-v2-item .topppa-trip-v2-title a:hover' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'select_style!' => 'style_one',
                ],
            ]
        );
        $this->add_responsive_control(
            'title_hcolor1',
            [
                'label'     => esc_html__('Hover Color', 'topper-pack'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .topppa-trip-v2-item:hover .topppa-trip-v2-title a' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'select_style' => 'style_one',
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
                    '{{WRAPPER}} .topppa-trip-v2-item .topppa-trip-v2-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                    '{{WRAPPER}} .topppa-trip-v2-item .topppa-trip-v2-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_tab();
        $this->start_controls_tab(
            'style_meta_tab',
            [
                'label' => esc_html__('Meta', 'topper-pack'),
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'meta_typo',
                'selector' => '{{WRAPPER}} .topppa-trip-v2-item .topppa-trip-v2-meta',
            ]
        );
        $this->add_responsive_control(
            'meta_color',
            [
                'label'     => esc_html__('Color', 'topper-pack'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .topppa-trip-v2-item .topppa-trip-v2-meta a' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .topppa-trip-v2-item .topppa-trip-v2-meta span' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_responsive_control(
            'meta_hover_color',
            [
                'label'     => esc_html__('Hover Color', 'topper-pack'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .topppa-trip-v2-item .topppa-trip-v2-meta a:hover' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'select_style!' => 'style_one',
                ],
            ]
        );
        $this->add_responsive_control(
            'meta_hcolor',
            [
                'label'     => esc_html__('Hover Color', 'topper-pack'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .topppa-trip-v2-item:hover .topppa-trip-v2-meta a' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .topppa-trip-v2-item:hover .topppa-trip-v2-meta span' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'select_style' => 'style_one',
                ],
            ]
        );
        $this->add_responsive_control(
            'meta_padding',
            [
                'label'      => esc_html__('Padding', 'topper-pack'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .topppa-trip-v2-item .topppa-trip-v2-meta' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'meta_margin',
            [
                'label'      => esc_html__('Margin', 'topper-pack'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .topppa-trip-v2-item .topppa-trip-v2-meta' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();
        // <==========>
        // <==========> TITLE STYLES <==========>

        $this->start_controls_section(
            'pricing_styles',
            [
                'label' => esc_html__('Pricing Style', 'topper-pack'),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->start_controls_tabs(
            'pricing_style_tabs'
        );

        $this->start_controls_tab(
            'pricing_tab',
            [
                'label' => esc_html__('Pricing', 'topper-pack'),
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'pricing_typography',
                'selector' => '{{WRAPPER}} .topppa-trip-v2-item .topppa-trip-price-v2-holder span',
            ]
        );
        $this->add_responsive_control(
            'pricing_color',
            [
                'label' => esc_html__('Color', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .topppa-trip-v2-item .topppa-trip-price-v2-holder span' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->end_controls_tab();

        $this->start_controls_tab(
            'pricing_text_tab',
            [
                'label' => esc_html__('Text', 'topper-pack'),
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'pricing_text_typography',
                'selector' => '{{WRAPPER}} .topppa-trip-v2-item .topppa-trip-price-v2-holder .topppa-trip-price-v2-text',
            ]
        );
        $this->add_responsive_control(
            'pricing_text_color',
            [
                'label' => esc_html__('Color', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .topppa-trip-v2-item .topppa-trip-price-v2-holder .topppa-trip-price-v2-text' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->add_responsive_control(
            'pricing_margin',
            [
                'label'      => esc_html__('Margin', 'topper-pack'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .topppa-trip-price-v2-holder' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'pricing_padding',
            [
                'label'      => esc_html__('Padding', 'topper-pack'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .topppa-trip-price-v2-holder' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();
        $this->start_controls_section(
            'icon_styles',
            [
                'label' => esc_html__('Icon Style', 'topper-pack'),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
                'condition' => [
                    'enable_icon' => 'yes',
                    'select_style' => 'style_three',
                ],
            ]
        );

        $this->add_responsive_control(
            'icon_height',
            [
                'label' => esc_html__('Height', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
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
                    '{{WRAPPER}} .topppa-trip-v2-item .topppa-trip-v2-image .trip-popup-icon' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'icon_width',
            [
                'label' => esc_html__('Width', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
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
                    '{{WRAPPER}} .topppa-trip-v2-item .topppa-trip-v2-image .trip-popup-icon' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'icon_typo',
                'selector' => '{{WRAPPER}} .topppa-trip-v2-item .topppa-trip-v2-image .trip-popup-icon',
            ]
        );
        $this->add_responsive_control(
            'icon_color',
            [
                'label'     => esc_html__('Color', 'topper-pack'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .topppa-trip-v2-item .topppa-trip-v2-image .trip-popup-icon' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .topppa-trip-v2-item .topppa-trip-v2-image .trip-popup-icon svg path' => 'fill: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'icon_bg_color',
                'types' => ['classic', 'gradient', 'video'],
                'selector' => '{{WRAPPER}} .topppa-trip-v2-item .topppa-trip-v2-image .trip-popup-icon',
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'icon_border',
                'selector' => '{{WRAPPER}} .topppa-trip-v2-item .topppa-trip-v2-image .trip-popup-icon',
            ]
        );
        $this->add_responsive_control(
            'icon_border_radius',
            [
                'label' => esc_html__('Border Radius', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .topppa-trip-v2-item .topppa-trip-v2-image .trip-popup-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'icon_box_shadow',
                'selector' => '{{WRAPPER}} .topppa-trip-v2-item .topppa-trip-v2-image .trip-popup-icon',
            ]
        );
        $this->add_responsive_control(
            'icon_margin',
            [
                'label'      => esc_html__('Margin', 'topper-pack'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .topppa-trip-v2-item .topppa-trip-v2-image .trip-popup-icon' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'icon_padding',
            [
                'label'      => esc_html__('Padding', 'topper-pack'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .topppa-trip-v2-item .topppa-trip-v2-image .trip-popup-icon' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();
        // <========================> BUTTON STYLES <========================>
        $this->start_controls_section(
            'topppa_btn_style',
            [
                'label' => esc_html__('Button Style', 'topper-pack'),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
                'condition' => [
                    'enable_button' => 'yes',
                    'select_style!' => 'style_three',
                ]
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
                'name'     => 'topppa_btn_typo',
                'selector' => '{{WRAPPER}} .topppa-trip-v2-button .topppa-btn',
            ]
        );

        $this->add_responsive_control(
            'topppa_btn_color',
            [
                'label'     => esc_html__('Color', 'topper-pack'),
                'type'      => \Elementor\Controls_Manager::COLOR,
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
                'name'     => 'topppa_btn_border',
                'label'    => esc_html__('Border', 'topper-pack'),
                'selector' => '{{WRAPPER}} .topppa-trip-v2-button .topppa-btn',
            ]
        );

        $this->add_responsive_control(
            'topppa_btn_border_radius',
            [
                'label'      => esc_html__('Border Radius', 'topper-pack'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .topppa-trip-v2-button .topppa-btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'topppa_btn_box_shadow',
                'label'    => esc_html__('Shadow', 'topper-pack'),
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
                'label'      => esc_html__('Margin', 'topper-pack'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .topppa-trip-v2-button .topppa-btn' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                'name'     => 'topppa_btn_typography_hover',
                'selector' => '{{WRAPPER}} .topppa-trip-v2-button .topppa-btn:hover',
            ]
        );

        $this->add_responsive_control(
            'topppa_btn_color_hover',
            [
                'label'     => esc_html__('Color', 'topper-pack'),
                'type'      => \Elementor\Controls_Manager::COLOR,
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
                'name'     => 'topppa_btn_border_hover',
                'label'    => esc_html__('Border', 'topper-pack'),
                'selector' => '{{WRAPPER}} .topppa-trip-v2-button .topppa-btn:hover',
            ]
        );

        $this->add_responsive_control(
            'topppa_btn_border_radius_hover',
            [
                'label'      => esc_html__('Border Radius', 'topper-pack'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .topppa-trip-v2-button .topppa-btn:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'topppa_btn_box_shadow_hover',
                'label'    => esc_html__('Shadow', 'topper-pack'),
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
            'dote_scale',
            [
                'label' => esc_html__('Border Scale', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'size' => 1,
                ],
                'selectors' => [
                    '{{WRAPPER}} .topppa-dote-pagination .swiper-pagination-bullet:after' => 'transform: translate(-50%, -50%) scale({{SIZE}});',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name'     => 'dote_border',
                'label'    => esc_html__('Border', 'topper-pack'),
                'selector' => '{{WRAPPER}} .topppa-dote-pagination .swiper-pagination-bullet:after',
            ]
        );
        $this->add_responsive_control(
            'dote_border_radius',
            [
                'label'      => esc_html__('Border Radius', 'topper-pack'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .topppa-dote-pagination .swiper-pagination-bullet:after' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'active_styles',
            [
                'label' => esc_html__('Active Styles', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->add_responsive_control(
            'position_x',
            [
                'label' => esc_html__('Postition X', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'range' => [
                    'px' => [
                        'min' => -200,
                        'max' => 500,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .topppa-dote-pagination .swiper-pagination-bullet:after' => 'left: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'position_y',
            [
                'label' => esc_html__('Postition Y', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'range' => [
                    'px' => [
                        'min' => -200,
                        'max' => 500,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .topppa-dote-pagination .swiper-pagination-bullet:after' => 'top: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'active_dote_height',
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
                    '{{WRAPPER}} .swiper-pagination-bullets span.swiper-pagination-bullet-active' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'active_dote_width',
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
                    '{{WRAPPER}} .swiper-pagination-bullets span.swiper-pagination-bullet-active' => 'width: {{SIZE}}{{UNIT}};',
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
                        'label' => esc_html__('Background', 'topper-pack'),
                        'default' => 'classic',
                    ],
                ],
            ]
        );
        $this->add_responsive_control(
            'dote_active_opacity',
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
                    '{{WRAPPER}} .topppa-dote-pagination .swiper-pagination-bullet-active' => 'opacity: {{SIZE}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'dote_ascale',
            [
                'label' => esc_html__('Border Scale', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'size' => 1,
                ],
                'selectors' => [
                    '{{WRAPPER}} .topppa-dote-pagination .swiper-pagination-bullet-active:after' => 'transform: translate(-50%, -50%) scale({{SIZE}});',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name'     => 'active_dote_border',
                'label'    => esc_html__('Border', 'topper-pack'),
                'selector' => '{{WRAPPER}} .topppa-dote-pagination .swiper-pagination-bullet-active:after',
            ]
        );
        $this->add_responsive_control(
            'active_dote_border_radius',
            [
                'label'      => esc_html__('Border Radius', 'topper-pack'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .topppa-dote-pagination .swiper-pagination-bullet-active:after' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
        $this->start_controls_section(
            'arrow_content_option',
            [
                'label' => esc_html__('Arrow Style Option', 'topper-pack'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                'condition' => [
                    'enable_arrow' => 'yes',
                    'select_layout' => 'slider',
                ],
            ]
        );
        $this->add_responsive_control(
            'arrow_gap',
            [
                'label'      => esc_html__('Gap', 'topper-pack'),
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
                    '{{WRAPPER}} .topppa-slider-arrow-wrp' => 'gap: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'arrow_align',
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
                    '{{WRAPPER}} .topppa-slider-arrow-wrp' => 'justify-content: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'arrow_typography',
                'selector' => '{{WRAPPER}} .topppa-slider-arrow-wrp .button',
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
                    '{{WRAPPER}} .topppa-slider-arrow-wrp .button' => 'height: {{SIZE}}{{UNIT}};',
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
                    '{{WRAPPER}} .topppa-slider-arrow-wrp .button' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'arrow_top',
            [
                'label' => esc_html__('Top', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'range' => [
                    'px' => [
                        'min' => -300,
                        'max' => 300,
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
                    '{{WRAPPER}} .topppa-slider-arrow-wrp.arrow-two' => 'top: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'select_arrow' => 'arrow_two'
                ]
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
                    '{{WRAPPER}} .topppa-slider-arrow-wrp .button' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .topppa-slider-arrow-wrp .button svg path' => 'fill: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'arrow_background',
                'label' => esc_html__('Background', 'topper-pack'),
                'types' => ['classic', 'gradient', 'video'],
                'selector' => '{{WRAPPER}} .topppa-slider-arrow-wrp .button',
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
                'selector' => '{{WRAPPER}} .topppa-slider-arrow-wrp .button',
            ]
        );
        $this->add_responsive_control(
            'arrow_border_radius',
            [
                'label'      => esc_html__('Border Radius', 'topper-pack'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .topppa-slider-arrow-wrp .button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                    '{{WRAPPER}} .topppa-slider-arrow-wrp .button:hover' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .topppa-slider-arrow-wrp .button:hover svg path' => 'fill: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'arrow_background_hover',
                'label' => esc_html__('Background', 'topper-pack'),
                'types' => ['classic', 'gradient', 'video'],
                'selector' => '{{WRAPPER}} .topppa-slider-arrow-wrp .button:hover',
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
                'selector' => '{{WRAPPER}} .topppa-slider-arrow-wrp .button:hover,',
            ]
        );
        $this->add_responsive_control(
            'arrow_border_radius_hover',
            [
                'label'      => esc_html__('Border Radius', 'topper-pack'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .topppa-slider-arrow-wrp .button:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                    '{{WRAPPER}} .topppa-slider-arrow-wrp' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                    '{{WRAPPER}} .topppa-slider-arrow-wrp' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();
    }
    /**
     * Render widget output on the frontend.
     *
     * Written in PHP and used to Category.
     *
     * @since 1.0.0
     * @access protected
     */

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
        $args = [
            'post_type'      => 'trip',
            'posts_per_page' => $settings['posts_per_page'],
        ];
        $query = new \WP_Query($args);
        $SliderId = wp_rand(1241, 3256);
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
        $select_arrow = [
            'arrow_one' => 'arrow-one',
            'arrow_two' => 'arrow-two',
        ];
        $style_clas = [
            'style_one' => 'style-one',
            'style_two' => 'style-two',
            'style_three' => 'style-three',
        ];
        if ($settings['select_layout'] == 'slider') {
            $column = 'topppa-trip-v2-slider';
        } else {
            $column = $settings['xl_col'] . ' ' . $settings['lg_col'] . ' ' . $settings['md-col'];
        }
        $btn_class = isset($button_classes[$settings['topppa_btn_styles']]) ? $button_classes[$settings['topppa_btn_styles']] : '';
        $arrow = isset($select_arrow[$settings['select_arrow']]) ? $select_arrow[$settings['select_arrow']] : '';
        $class = isset($style_clas[$settings['select_style']]) ? $style_clas[$settings['select_style']] : '';
?>
        <div class="topppa-trip-v2-item-wrp <?php echo esc_attr($class); ?>">
            <?php if ($settings['enable_arrow'] === 'yes' && $settings['select_layout'] === 'slider') : ?>
                <div class="container">
                    <div class="topppa-slider-arrow-wrp <?php echo esc_attr($arrow); ?>">
                        <?php if ($settings['style_arrow_type'] === 'text') : ?>
                            <div class="topppa-arrow-prev topppa-brand-logo-button-prev-<?php echo esc_attr($SliderId); ?> button">
                                <?php echo esc_html__('Prev', 'topper-pack'); ?>
                            </div>
                            <div class="topppa-arrow-next topppa-brand-logo-button-next-<?php echo esc_attr($SliderId); ?> button">
                                <?php echo esc_html__('Next', 'topper-pack'); ?>
                            </div>
                        <?php else : ?>
                            <div class="topppa-arrow-prev topppa-brand-logo-button-prev-<?php echo esc_attr($SliderId); ?> button">
                                <?php \Elementor\Icons_Manager::render_icon($settings['left_arrow_icon'], ['aria-hidden' => 'true']); ?>
                            </div>
                            <div class="topppa-arrow-next topppa-brand-logo-button-next-<?php echo esc_attr($SliderId); ?> button">
                                <?php \Elementor\Icons_Manager::render_icon($settings['right_arrow_icon'], ['aria-hidden' => 'true']); ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endif; ?>
            <div class="<?php echo esc_attr(
                            ($settings['select_layout'] === 'slider' ? 'swiper topppa-swiper-slider' : 'no-slide') . ' topppa-swiper-slider-' . $SliderId
                        ); ?>"
                <?php if ($settings['select_layout'] === 'slider') : ?>
                data-slides-per-view="<?php echo esc_attr($settings['slide_show_lagrge_item']); ?>"
                data-space-between="<?php echo esc_attr($settings['slider_space_between']['size']); ?>"
                data-auto-loop="<?php echo esc_attr($settings['enable_slider_auto_loop']); ?>"
                data-slide-speed="<?php echo esc_attr($settings['slide_speed']); ?>"
                data-slider-speed="<?php echo esc_attr($settings['slider_speed']); ?>"
                data-enable-dote="<?php echo esc_attr($settings['enable_dote']); ?>"
                data-enable-arrow="<?php echo esc_attr($settings['enable_arrow']); ?>"
                data-large-items="<?php echo esc_attr($settings['slide_show_lagrge_item']); ?>"
                data-tablet-items="<?php echo esc_attr($settings['slide_show_teblet_item']); ?>"
                data-mobile-items="<?php echo esc_attr($settings['slide_show_mobile_item']); ?>"
                data-extra-mobile-items="<?php echo esc_attr($settings['slide_show_extra_mobile_item']); ?>"
                data-enable-rtl="<?php echo esc_attr($settings['enable_rtl']); ?>"
                <?php endif; ?>>
                <div class="<?php echo esc_attr($settings['select_layout'] === 'slider' ? 'swiper-wrapper' : 'row'); ?>">
                    <?php if ($query->have_posts()) : ?>
                        <?php while ($query->have_posts()) : $query->the_post();
                            $trip_id = get_the_ID();
                            $location = function_exists('wte_get_the_tax_term_list') ? wte_get_the_tax_term_list(get_the_ID(), 'destination', '', ', ', '') : '';
                            $activities = function_exists('wte_get_the_tax_term_list') ? wte_get_the_tax_term_list(get_the_ID(), 'activities', '', ', ', '') : '';
                            $trip_type = function_exists('wte_get_the_tax_term_list') ? wte_get_the_tax_term_list(get_the_ID(), 'trip_types', '', ', ', '') : '';
                            $location = is_wp_error($location) ? '' : $location;
                            $activities = is_wp_error($activities) ? '' : $activities;
                            $trip_type = is_wp_error($trip_type) ? '' : $trip_type;
                            // Price Handling
                            $meta = function_exists('wte_trip_get_trip_rest_metadata') ? wte_trip_get_trip_rest_metadata($trip_id) : null;
                            $price_html = '';
                            $discount_html = '';
                            $actual_price_html = '';

                            if (isset($meta->price)) {
                                $regular_price    = $meta->price;
                                $sale_price       = $meta->has_sale ? $meta->sale_price : $meta->price;
                                $discount_percent = $meta->has_sale ? $meta->discount_percent : 0;

                                $price_html        = wte_esc_price(wte_get_formated_price_html($regular_price));
                                $actual_price_html = wte_esc_price(wte_get_formated_price_html($sale_price));

                                if ($meta->has_sale && $discount_percent) {
                                    $discount_html = (float) $discount_percent . '% Off';
                                }
                            }
                        ?>
                            <div class="<?php echo esc_attr($settings['select_layout'] === 'slider' ? 'swiper-slide' : $column); ?>">
                                <div class="topppa-trip-v2-item">
                                    <?php if (has_post_thumbnail()) : ?>
                                        <div class="topppa-trip-v2-image">
                                            <?php the_post_thumbnail('full'); ?>
                                            <?php if ($settings['select_style'] === 'style_three') : ?>
                                                <?php if ($settings['enable_icon'] === 'yes') : ?>
                                                    <?php
                                                    $thumbnail_url = get_the_post_thumbnail_url(get_the_ID(), 'large');
                                                    if ($thumbnail_url) :
                                                    ?>
                                                        <a class="popup-image trip-popup-icon" href="<?php echo esc_url($thumbnail_url); ?>" data-elementor-open-lightbox="no">
                                                            <?php \Elementor\Icons_Manager::render_icon($settings['image_icon'], ['aria-hidden' => 'true']); ?>
                                                        </a>
                                                    <?php endif; ?>
                                                <?php endif; ?>
                                            <?php endif; ?>

                                        </div>
                                    <?php endif; ?>

                                    <div class="topppa-trip-v2-content-area">
                                        <div class="topppa-trip-v2-content">
                                            <<?php echo esc_attr($settings['title_tag']); ?> class="topppa-trip-v2-title">
                                                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                            </<?php echo esc_attr($settings['title_tag']); ?>>

                                            <?php if ($settings['enable_meta'] === 'yes') : ?>
                                                <div class="topppa-trip-v2-meta">
                                                    <?php if (!empty($settings['select_trip_meta'])) :
                                                        $selected_meta = is_array($settings['select_trip_meta']) ? $settings['select_trip_meta'] : [$settings['select_trip_meta']];
                                                    ?>
                                                        <?php if (in_array('destination', $selected_meta)) : ?>
                                                            <?php if ($settings['enable_meta_icon'] === 'yes') : ?>
                                                                <span><i class="fas fa-map-marker-alt" aria-hidden="true"></i></span>
                                                            <?php endif; ?>
                                                            <?php echo wp_kses_post($location); ?>
                                                        <?php endif; ?>

                                                        <?php if (in_array('activity', $selected_meta)) : ?>
                                                            <?php if ($settings['enable_meta_icon'] === 'yes') : ?>
                                                                <span><i class="fas fa-hiking" aria-hidden="true"></i></span>
                                                            <?php endif; ?>
                                                            <?php echo wp_kses_post($activities); ?>
                                                        <?php endif; ?>

                                                        <?php if (in_array('trip-types', $selected_meta)) : ?>
                                                            <?php if ($settings['enable_meta_icon'] === 'yes') : ?>
                                                                <span><i class="fas fa-map" aria-hidden="true"></i></span>
                                                            <?php endif; ?>
                                                            <?php echo wp_kses_post($trip_type); ?>
                                                        <?php endif; ?>

                                                    <?php endif; ?>
                                                </div>
                                            <?php endif; ?>
                                            <?php if ($settings['enable_price'] == 'yes') : ?>
                                                <div class="topppa-trip-price-v2-holder">
                                                    <?php echo esc_html($actual_price_html); ?>
                                                    <span class="topppa-trip-price-v2-text">/<?php echo esc_html($settings['pricing_text']) ?></span>
                                                </div>
                                            <?php endif; ?>
                                            <?php if ($settings['select_style'] !== 'style_three') : ?>
                                                <?php if ($settings['enable_button'] === 'yes') : ?>
                                                    <div class="topppa-btn-wrapper topppa-trip-v2-button <?php echo esc_attr($btn_class); ?>">
                                                        <a href="<?php the_permalink(); ?>" class="topppa-btn">
                                                            <span class="top-btn-text top-btn-text-v3">
                                                                <?php echo esc_html($settings['button_text']); ?>
                                                            </span>

                                                            <?php if ($btn_class === 'style-three') : ?>
                                                                <span class="bottom-btn-text bottom-btn-text-v3">
                                                                    <?php echo esc_html($settings['button_text']); ?>
                                                                </span>
                                                            <?php endif; ?>

                                                            <?php if (!empty($settings['enable_button_icon']) && $settings['enable_button_icon'] === 'yes' && !empty($settings['btn_icon'])) : ?>
                                                                <div class="btn-icon">
                                                                    <?php \Elementor\Icons_Manager::render_icon($settings['btn_icon'], ['aria-hidden' => 'true']); ?>
                                                                </div>
                                                            <?php endif; ?>
                                                        </a>
                                                    </div>
                                                <?php endif; ?>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endwhile; ?>
                        <?php wp_reset_postdata(); ?>
                    <?php else : ?>
                        <p>No trips found.</p>
                    <?php endif; ?>
                </div>
            </div>
            <?php if ($settings['enable_dote'] === 'yes') : ?>
                <div class="topppa-dote-pagination topppa-dote-pagination topppa-topppa-dote-pagination-<?php echo esc_attr($SliderId); ?>"></div>
            <?php endif; ?>
        </div>
<?php
    }
}