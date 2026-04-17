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
class TOPPPA_Trip_Types_Taxonomy_Widget extends \Elementor\Widget_Base {

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
        return 'trip-types-taxonomy';
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
        return TOPPPA_EPWB . esc_html__('Trip Types Taxonomy', 'topper-pack');
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
        return 'eicon-shape';
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
        return ['topppa', 'widget', 'Trip Types Taxonomy', 'travel', 'topperpack'];
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
                'label' => esc_html__('Content Option', 'topper-pack'),
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
                    'style_four' => esc_html__('Style Four', 'topper-pack'),
                    'style_five' => esc_html__('Style Five', 'topper-pack'),
                    'style_six' => esc_html__('Style Six', 'topper-pack'),
                    'style_seven' => esc_html__('Style Seven', 'topper-pack'),
                ],
            ]
        );
        $this->add_control(
            'cat_name',
            [
                'label'       => esc_html__('Select Category', 'topper-pack'),
                'type'        => \Elementor\Controls_Manager::SELECT2,
                'label_block' => true,
                'multiple'    => true,
                'options'     => $this->category_list(), // ক্যাটাগরি লিস্ট ফাংশন
            ]
        );

        $this->add_control(
            'enable_icon',
            [
                'label' => esc_html__('Enable Icon', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', 'topper-pack'),
                'label_off' => esc_html__('Hide', 'topper-pack'),
                'return_value' => 'yes',
                'default' => 'yes',
                'condition' => [
                    'select_style' => 'style_three',
                ]
            ]
        );
        $this->add_control(
            'icon',
            [
                'label'   => esc_html__('Icon', 'topper-pack'),
                'type'    => \Elementor\Controls_Manager::ICONS,
                'default' => [
                    'value'   => 'fas fa-map-marker-alt',
                    'library' => 'fa-solid',
                ],
                'condition' => [
                    'enable_icon' => 'yes',
                    'select_style' => 'style_three',
                ]
            ]
        );
        $this->add_control(
            'items_count',
            [
                'label' => esc_html__('Number of Items', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'default' => 4,
                'min' => 1,
                'max' => 50,
            ]
        );
        $this->add_control(
            'enable_trip_counts',
            [
                'label' => esc_html__('Show Trip Counts', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', 'topper-pack'),
                'label_off' => esc_html__('Hide', 'topper-pack'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );
        $this->add_control(
            'trip_count',
            [
                'label'   => esc_html__('Trips Count Label', 'topper-pack'),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Listing', 'topper-pack'),
                'condition' => [
                    'enable_trip_counts' => 'yes',
                ],
            ]
        );
        $this->add_control(
            'enable_title_icon',
            [
                'label' => esc_html__('Enable Title Icon', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', 'topper-pack'),
                'label_off' => esc_html__('Hide', 'topper-pack'),
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );
        $this->add_control(
            'title_icon',
            [
                'label'   => esc_html__('Title Icon', 'topper-pack'),
                'type'    => \Elementor\Controls_Manager::ICONS,
                'default' => [
                    'value'   => 'fas fa-map-marker-alt',
                    'library' => 'fa-solid',
                ],
                'condition' => [
                    'enable_title_icon' => 'yes',
                ]
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
            'enable_description',
            [
                'label' => esc_html__('Enable Description', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', 'topper-pack'),
                'label_off' => esc_html__('Hide', 'topper-pack'),
                'return_value' => 'yes',
                'default' => 'no',
                'condition' => [
                    'select_style!' => 'style_seven',
                ],
            ]
        );
        $this->add_control(
            'dec_length',
            [
                'label'   => esc_html__('Description Length ', 'topper-pack'),
                'type'    => \Elementor\Controls_Manager::NUMBER,
                'min'     => 1,
                'max'     => 50,
                'step'    => 1,
                'default' => 12,
                'condition' => [
                    'enable_description' => 'yes',
                    'select_style!' => 'style_seven',
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
                'label'     => esc_html__('Button Text', 'topper-pack'),
                'type'      => \Elementor\Controls_Manager::TEXT,
                'default'   => esc_html__('View All', 'topper-pack'),
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

                'condition'   => ['enable_button' => 'yes'],
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
                    'enable_button_icon' => 'yes'
                ]
            ]
        );
        $this->add_control(
            'enable_button_two',
            [
                'label' => esc_html__('Enable Button Two', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', 'topper-pack'),
                'label_off' => esc_html__('Hide', 'topper-pack'),
                'return_value' => 'yes',
                'default' => 'no',
                'separator' => 'before',
                'condition' => [
                    'select_style' => 'style_four',
                ]
            ]
        );
        $this->add_control(
            'btn_two_icon',
            [
                'label'   => esc_html__('Button Icon', 'topper-pack'),
                'type'    => \Elementor\Controls_Manager::ICONS,
                'default' => [
                    'value'   => 'fas fa-arrow-right',
                    'library' => 'fa-solid',
                ],
                'condition' => [
                    'enable_button_two' => 'yes',
                    'select_style' => 'style_four',
                ]
            ]
        );

        $this->add_control(
            'content_section',
            [
                'label' => __('Slider Options', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
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
                'default' => 'no',
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
            'slide_show_lagrge_item',
            [
                'label' => esc_html__('Display on Large Devices', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'min' => 1,
                'max' => 6,
                'step' => 1,
                'default' => 3,
                'condition' => [
                    'enable_slider' => 'yes',
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
                    'enable_slider' => 'yes',
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
                    'enable_slider' => 'yes',
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
            'select_arrow',
            [
                'label' => esc_html__('Arrow Styles', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'style_one',
                'options' => [
                    'arrow_one' => esc_html__('Style One', 'topper-pack'),
                    'arrow_two' => esc_html__('Style Two', 'topper-pack'),
                ],
                'condition' => [
                    'enable_arrow' => 'yes',
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
                    'enable_slider!' => 'yes',
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
                    'enable_slider!' => 'yes',
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
                    'enable_slider!' => 'yes',
                ],
            ]
        );
        $this->end_controls_section();
        $this->start_controls_section(
            'box_styles',
            [
                'label' => esc_html__('Box Style', 'topper-pack'),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
                'condition' => [
                    'select_style!' => 'style_seven',
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
                    '{{WRAPPER}} .topppa-trip-taxonomy-item ' => 'height: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'select_style!' => 'style_four',
                ],
            ]
        );
        $this->add_responsive_control(
            'service_slider_box_border_color',
            [
                'label' => esc_html__('After Border Color', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .style-four .swiper-slide.swiper-slide-next::before' => 'background-color: {{VALUE}}',
                    '{{WRAPPER}} .style-four .swiper-slide.swiper-slide-next::after' => 'background-color: {{VALUE}}',
                ],
                'condition' => [
                    'select_style' => 'style_four',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'box_border',
                'label' => esc_html__('Border', 'topper-pack'),
                'selector' => '{{WRAPPER}} .topppa-trip-taxonomy-item',
            ]
        );
        $this->add_responsive_control(
            'box_radius',
            [
                'label' => esc_html__('Border Radius', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .topppa-trip-taxonomy-item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'box_shadow',
                'label' => esc_html__('Box Shadow', 'topper-pack'),
                'selector' => '{{WRAPPER}} .topppa-trip-taxonomy-item',
            ]
        );
        $this->add_responsive_control(
            'box_margin',
            [
                'label' => esc_html__('Margin', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .topppa-trip-taxonomy-item' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                    '{{WRAPPER}} .topppa-trip-taxonomy-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();
        // <==========>
        // <==========> BOX STYLES <==========>

        $this->start_controls_section(
            'inner_box_styles',
            [
                'label' => esc_html__('Innre Box Style', 'topper-pack'),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
                'condition' => [
                    'select_style' => ['style_one', 'style_two', 'style_five'],
                ],
            ]
        );
        $this->add_responsive_control(
            'content_ text_align',
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
                    '{{WRAPPER}} .topppa-trip-taxonomy-content-area' => 'text-align: {{VALUE}};',
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
                    '{{WRAPPER}} .topppa-trip-taxonomy-content-area' => 'bottom: {{SIZE}}{{UNIT}};',
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
                    '{{WRAPPER}} .topppa-trip-taxonomy-content' => 'backdrop-filter: blur({{SIZE}}{{UNIT}});',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'inner_box_bg',
                'label' => esc_html__('Background', 'topper-pack'),
                'types' => ['classic', 'gradient', 'video'],
                'selector' => '{{WRAPPER}} .topppa-trip-taxonomy-content',
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'inner_box_border',
                'label' => esc_html__('Border', 'topper-pack'),
                'selector' => '{{WRAPPER}} .topppa-trip-taxonomy-content',
            ]
        );
        $this->add_responsive_control(
            'inner_box_radius',
            [
                'label' => esc_html__('Border Radius', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .topppa-trip-taxonomy-content' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'inner_box_shadow',
                'label' => esc_html__('Box Shadow', 'topper-pack'),
                'selector' => '{{WRAPPER}} .topppa-trip-taxonomy-content',
            ]
        );
        $this->add_responsive_control(
            'inner_box_padding',
            [
                'label' => esc_html__('Padding', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .topppa-trip-taxonomy-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                    '{{WRAPPER}} .topppa-trip-taxonomy-item:hover .topppa-trip-taxonomy-content' => 'backdrop-filter: blur({{SIZE}}{{UNIT}});',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'inner_box_bg_hover',
                'label' => esc_html__('Background', 'topper-pack'),
                'types' => ['classic', 'gradient', 'video'],
                'selector' => '{{WRAPPER}} .topppa-trip-taxonomy-item:hover .topppa-trip-taxonomy-content',
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'inner_box_border_hover',
                'label' => esc_html__('Border', 'topper-pack'),
                'selector' => '{{WRAPPER}} .topppa-trip-taxonomy-item:hover .topppa-trip-taxonomy-content',
            ]
        );
        $this->add_responsive_control(
            'inner_box_radius_hover',
            [
                'label' => esc_html__('Border Radius', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .topppa-trip-taxonomy-item:hover .topppa-trip-taxonomy-content' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'inner_box_shadow_hover',
                'label' => esc_html__('Box Shadow', 'topper-pack'),
                'selector' => '{{WRAPPER}} .topppa-trip-taxonomy-item:hover .topppa-trip-taxonomy-content',
            ]
        );
        $this->add_responsive_control(
            'inner_box_padding_hover',
            [
                'label' => esc_html__('Padding', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .topppa-trip-taxonomy-item:hover .topppa-trip-taxonomy-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                    '{{WRAPPER}} .topppa-trip-taxonomy-content' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                    '{{WRAPPER}} .style-three .topppa-trip-taxonomy-content-area' => 'text-align: {{VALUE}};',
                    '{{WRAPPER}} .topppa-trip-taxonomy-content-area' => 'text-align: {{VALUE}};',
                    '{{WRAPPER}} .topppa-trip-texonomy-bottom' => 'justify-content: {{VALUE}};',
                ],
                'condition' => [
                    'select_style' => ['style_three', 'style_four', 'style_six'],

                ],
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
                    '{{WRAPPER}} .topppa-trip-taxonomy-item .topppa-trip-taxonomy-content-area' => 'backdrop-filter: blur({{SIZE}}{{UNIT}});',
                ],
                'condition' => [
                    'select_style' => ['style_three', 'style_six'],
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'content_box_bg',
                'label' => esc_html__('Background', 'topper-pack'),
                'types' => ['classic', 'gradient', 'video'],
                'selector' => '{{WRAPPER}} .topppa-trip-taxonomy-item .topppa-trip-taxonomy-content-area',
                'condition' => [
                    'select_style' => ['style_three', 'style_six'],
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'content_box_border',
                'label' => esc_html__('Border', 'topper-pack'),
                'selector' => '{{WRAPPER}} .topppa-trip-taxonomy-item .topppa-trip-taxonomy-content-area',
                'condition' => [
                    'select_style' => ['style_three', 'style_six'],
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
                    '{{WRAPPER}} .topppa-trip-taxonomy-item .topppa-trip-taxonomy-content-area' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'select_style' => ['style_three', 'style_six'],
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'content_box_shadow',
                'label' => esc_html__('Box Shadow', 'topper-pack'),
                'selector' => '{{WRAPPER}} .topppa-trip-taxonomy-item .topppa-trip-taxonomy-content-area',
                'condition' => [
                    'select_style' => ['style_three', 'style_six'],
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
                    '{{WRAPPER}} .topppa-trip-taxonomy-wrp.style-three .topppa-trip-taxonomy-content' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'select_style' => 'style_three',
                ],
            ]
        );
        $this->add_responsive_control(
            'content_box_margin_style',
            [
                'label' => esc_html__('Margin', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .topppa-trip-taxonomy-item .topppa-trip-taxonomy-content-area' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'select_style!' => 'style_three',
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
                    '{{WRAPPER}} .topppa-trip-taxonomy-item .topppa-trip-taxonomy-content-area' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'select_style' => ['style_three', 'style_six'],
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
                'selector' => '{{WRAPPER}} .topppa-trip-taxonomy-title',
            ]
        );
        $this->add_responsive_control(
            'title_color',
            [
                'label'     => esc_html__('Color', 'topper-pack'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .topppa-trip-taxonomy-title' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .topppa-trip-taxonomy-title a' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_responsive_control(
            'title_hcolor',
            [
                'label'     => esc_html__('Hover Color', 'topper-pack'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .topppa-trip-taxonomy-title a:hover' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'select_style!' => 'style_five',
                ],
            ]
        );
        $this->add_responsive_control(
            'title_hcolor1',
            [
                'label'     => esc_html__('Hover Color', 'topper-pack'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .topppa-trip-taxonomy-item:hover .topppa-trip-taxonomy-title a' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'select_style' => 'style_five',
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
                    '{{WRAPPER}} .topppa-trip-taxonomy-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                    '{{WRAPPER}} .topppa-trip-taxonomy-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_tab();
        $this->start_controls_tab(
            'style_stitle_tab',
            [
                'label' => esc_html__('Stitle', 'topper-pack'),
                'condition' => [
                    'enable_trip_counts' => 'yes',
                    'select_style!' => 'style_three',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'stitle_typo',
                'selector' => '{{WRAPPER}} .topppa-trip-taxonomy-stitle',
            ]
        );
        $this->add_responsive_control(
            'stitle_color',
            [
                'label'     => esc_html__('Color', 'topper-pack'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .topppa-trip-taxonomy-stitle' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_responsive_control(
            'stitle_hover_color',
            [
                'label'     => esc_html__('Hover Color', 'topper-pack'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .topppa-trip-taxonomy-item:hover .topppa-trip-taxonomy-stitle' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'select_style' => 'style_five',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'stitle_background',
                'types' => ['classic', 'gradient', 'video'],
                'selector' => '{{WRAPPER}} .topppa-trip-taxonomy-stitle',
                'condition' => [
                    'select_style' => 'style_six',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'stitle_border',
                'selector' => '{{WRAPPER}} .topppa-trip-taxonomy-stitle',
                'condition' => [
                    'select_style' => 'style_six',
                ],
            ]
        );
        $this->add_responsive_control(
            'stitle_border_radius',
            [
                'label' => esc_html__('Border Radius', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .topppa-trip-taxonomy-stitle' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'select_style' => 'style_six',
                ],
            ]
        );
        $this->add_responsive_control(
            'stitle_margin',
            [
                'label'      => esc_html__('Margin', 'topper-pack'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .topppa-trip-taxonomy-stitle' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'stitle_padding',
            [
                'label'      => esc_html__('Padding', 'topper-pack'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .topppa-trip-taxonomy-stitle' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_tab();
        $this->start_controls_tab(
            'style_title_icon_tab',
            [
                'label' => esc_html__('Icon', 'topper-pack'),
                'condition' => [
                    'enable_title_icon' => 'yes',
                ]
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'title_icon_typo',
                'selector' => '{{WRAPPER}} .topppa-trip-taxonomy-title span',
            ]
        );
        $this->add_responsive_control(
            'title_icon_color',
            [
                'label'     => esc_html__('Color', 'topper-pack'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .topppa-trip-taxonomy-title span' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_responsive_control(
            'title_icon_hcolor',
            [
                'label'     => esc_html__('Hover Color', 'topper-pack'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .topppa-trip-taxonomy-item:hover .topppa-trip-taxonomy-title span' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'select_style' => 'style_five',
                ],
            ]
        );
        $this->add_responsive_control(
            'title_icon_padding',
            [
                'label'      => esc_html__('Padding', 'topper-pack'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .topppa-trip-taxonomy-title span' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_tab();
        $this->start_controls_tab(
            'style_description_tab',
            [
                'label' => esc_html__('Description', 'topper-pack'),
                'condition' => [
                    'enable_description' => 'yes',
                    'select_style!' => 'style_seven',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'desc_typo',
                'selector' => '{{WRAPPER}} .topppa-trip-taxonomy-content-area .topppa-trip-taxonomy-des',
            ]
        );
        $this->add_responsive_control(
            'desc_color',
            [
                'label'     => esc_html__('Color', 'topper-pack'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .topppa-trip-taxonomy-content-area .topppa-trip-taxonomy-des' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_responsive_control(
            'desc_hcolor',
            [
                'label'     => esc_html__('Hover Color', 'topper-pack'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .topppa-trip-taxonomy-item:hover .topppa-trip-taxonomy-des' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'select_style' => 'style_five',
                ],
            ]
        );
        $this->add_responsive_control(
            'desc_padding',
            [
                'label'      => esc_html__('Padding', 'topper-pack'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .topppa-trip-taxonomy-content-area .topppa-trip-taxonomy-des' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'desc_margin',
            [
                'label'      => esc_html__('Margin', 'topper-pack'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .topppa-trip-taxonomy-content-area .topppa-trip-taxonomy-des' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();
        // <==========>
        // <==========> IMAGE STYLES <==========>

        $this->start_controls_section(
            'tp_image_style',
            [
                'label' => esc_html__('Image Style', 'topper-pack'),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
                'condition' => [
                    'select_style' => ['style_four', 'style_seven'],
                ],
            ]
        );
        $this->add_responsive_control(
            'tp_image_height',
            [
                'label'      => esc_html__('Height', 'topper-pack'),
                'type'       => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'custom'],
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
                'selectors'  => [
                    '{{WRAPPER}} .topppa-trip-taxonomy-item .topppa-trip-taxonomy-img' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'tp_image_width',
            [
                'label'      => esc_html__('Width', 'topper-pack'),
                'type'       => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'custom'],
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
                    'unit' => '%',
                ],
                'selectors'  => [
                    '{{WRAPPER}} .topppa-trip-taxonomy-item .topppa-trip-taxonomy-img' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'tp_image_object',
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
                    '{{WRAPPER}} .topppa-trip-taxonomy-item .topppa-trip-taxonomy-img' => 'object-fit: {{VALUE}}',
                ],
            ]
        );
        $this->add_responsive_control(
            'tp_image_after_color',
            [
                'label' => esc_html__('After Bg Color', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .topppa-trip-taxonomy-item .topppa-trip-taxonomy-img:after' => 'background-color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name'     => 'tp_image_border',
                'label'    => esc_html__('Border', 'topper-pack'),
                'selector' => '{{WRAPPER}} .topppa-trip-taxonomy-item .topppa-trip-taxonomy-img',
            ]
        );
        $this->add_responsive_control(
            'tp_image_border_radius',
            [
                'label'      => esc_html__('Border Radius', 'topper-pack'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .topppa-trip-taxonomy-item .topppa-trip-taxonomy-img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'tp_image_shadow',
                'selector' => '{{WRAPPER}} .topppa-trip-taxonomy-item .topppa-trip-taxonomy-img',
            ]
        );
        $this->add_responsive_control(
            'tp_image_margin',
            [
                'label'      => esc_html__('Margin', 'topper-pack'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .topppa-trip-taxonomy-item .topppa-trip-taxonomy-img' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'tp_image_padding',
            [
                'label'      => esc_html__('Padding', 'topper-pack'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .topppa-trip-taxonomy-item .topppa-trip-taxonomy-img' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();
        $this->start_controls_section(
            'icon_styles',
            [
                'label' => esc_html__('Trip List Style', 'topper-pack'),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
                'condition' => [
                    'select_style' => ['style_three'],
                ]
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
                    '{{WRAPPER}} .topppa-trip-taxonomy-wrp .topppa-trip-taxonomy-stitle' => 'height: {{SIZE}}{{UNIT}};',
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
                    '{{WRAPPER}} .topppa-trip-taxonomy-wrp .topppa-trip-taxonomy-stitle' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'icon_background_css_blur',
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
                    '{{WRAPPER}} .topppa-trip-taxonomy-wrp .topppa-trip-taxonomy-stitle' => 'backdrop-filter: blur({{SIZE}}{{UNIT}});',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'icon_typo',
                'label'    => esc_html__('Text Typography', 'topper-pack'),
                'selector' => '{{WRAPPER}} .topppa-trip-taxonomy-wrp .topppa-trip-taxonomy-stitle',
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'count_number_typo',
                'label'    => esc_html__('Count Number Typography', 'topper-pack'),
                'selector' => '{{WRAPPER}} .topppa-trip-taxonomy-wrp .topppa-trip-taxonomy-stitle span',
            ]
        );
        $this->add_responsive_control(
            'icon_color',
            [
                'label'     => esc_html__('Color', 'topper-pack'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .topppa-trip-taxonomy-wrp .topppa-trip-taxonomy-stitle' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'icon_bg_color',
                'types' => ['classic', 'gradient', 'video'],
                'selector' => '{{WRAPPER}} .topppa-trip-taxonomy-wrp .topppa-trip-taxonomy-stitle',
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'icon_border',
                'selector' => '{{WRAPPER}} .topppa-trip-taxonomy-wrp .topppa-trip-taxonomy-stitle',
            ]
        );
        $this->add_responsive_control(
            'icon_border_radius',
            [
                'label' => esc_html__('Border Radius', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .topppa-trip-taxonomy-wrp .topppa-trip-taxonomy-stitle' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'icon_box_shadow',
                'selector' => '{{WRAPPER}} .topppa-trip-taxonomy-wrp .topppa-trip-taxonomy-stitle',
            ]
        );
        $this->add_responsive_control(
            'icon_margin',
            [
                'label'      => esc_html__('Margin', 'topper-pack'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .topppa-trip-taxonomy-wrp .topppa-trip-taxonomy-stitle' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                    '{{WRAPPER}} .topppa-trip-taxonomy-wrp .topppa-trip-taxonomy-stitle' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                    'enable_button' => 'yes'
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
                    '{{WRAPPER}} .slider-btn-wrapper .topppa-btn' => 'gap: {{SIZE}}{{UNIT}};',
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
                'selector' => '{{WRAPPER}} .slider-btn-wrapper .topppa-btn:hover .btn-icon::before',
                'condition' => [
                    'topppa_btn_styles' => 'style_eight'
                ]
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();
        // <==========>
        // <=================> ICON STYLES <=================>
        $this->start_controls_section(
            'tp_icon_btn_style',
            [
                'label' => esc_html__('Icon Button Style', 'topper-pack'),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
                'condition' => [
                    'select_style' => 'style_four',
                    'enable_button_two' => 'yes'

                ]
            ],
        );
        $this->add_responsive_control(
            'tp_icon_btn_height',
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
                    '{{WRAPPER}} .topppa-trip-taxonomy-img .topppa-trip-taxonomy-button-two' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ],
        );
        $this->add_responsive_control(
            'tp_icon_btn_width',
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
                    '{{WRAPPER}} .topppa-trip-taxonomy-img .topppa-trip-taxonomy-button-two' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ],
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'tp_icon_btn_typo',
                'selector' => '{{WRAPPER}} .topppa-trip-taxonomy-img .topppa-trip-taxonomy-button-two',
            ],
        );
        $this->start_controls_tabs(
            'tp_icon_btn_tabs',
        );
        $this->start_controls_tab(
            'tp_icon_btn_tab',
            [
                'label' => esc_html__('Normal', 'topper-pack'),
            ],
        );
        $this->add_responsive_control(
            'tp_icon_btn_color',
            [
                'label'     => esc_html__('Icon Color', 'topper-pack'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .topppa-trip-taxonomy-img .topppa-trip-taxonomy-button-two' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .topppa-trip-taxonomy-img .topppa-trip-taxonomy-button-two svg path' => 'fill: {{VALUE}}',
                ],
            ],
        );
        $this->add_responsive_control(
            'tp_icon_btn_bg',
            [
                'label' => esc_html__('BG Color', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .topppa-trip-taxonomy-img .topppa-trip-taxonomy-button-two' => 'background-color: {{VALUE}}',
                ],
            ],
        );
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name'     => 'tp_icon_btn_border',
                'label'    => esc_html__('Border', 'topper-pack'),
                'selector' => '{{WRAPPER}} .topppa-trip-taxonomy-img .topppa-trip-taxonomy-button-two',
            ],
        );
        $this->add_responsive_control(
            'tp_icon_btn_border_radius',
            [
                'label'      => esc_html__('Border Radius', 'topper-pack'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .topppa-trip-taxonomy-img .topppa-trip-taxonomy-button-two' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ],
        );
        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'tp_icon_btn_shadow',
                'selector' => '{{WRAPPER}} .topppa-trip-taxonomy-img .topppa-trip-taxonomy-button-two',
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
            'tp_svg_icon_height',
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
                    '{{WRAPPER}} .topppa-trip-taxonomy-img .topppa-trip-taxonomy-button-two svg' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ],
        );
        $this->add_responsive_control(
            'tp_svg_icon_width',
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
                    '{{WRAPPER}} .topppa-trip-taxonomy-img .topppa-trip-taxonomy-button-two svg' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ],
        );
        $this->end_controls_tab();
        // <==========> ICON HOVER STYLES <==========>

        $this->start_controls_tab(
            'tp_icon_btn_hover_tab',
            [
                'label' => esc_html__('Hover', 'topper-pack'),
            ]
        );
        $this->add_responsive_control(
            'tp_icon_btn_color_hover',
            [
                'label'     => esc_html__('Color', 'topper-pack'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .topppa-trip-taxonomy-img .topppa-trip-taxonomy-button-two:hover' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .topppa-trip-taxonomy-img .topppa-trip-taxonomy-button-two:hover svg path' => 'fill: {{VALUE}}',
                ],
            ]
        );
        $this->add_responsive_control(
            'tp_icon_btn_hover_bg',
            [
                'label' => esc_html__('BG Color', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .topppa-trip-taxonomy-img .topppa-trip-taxonomy-button-two:hover' => 'background-color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name'     => 'tp_icon_btn_hover_border',
                'label'    => esc_html__('Border', 'topper-pack'),
                'selector' => '{{WRAPPER}} .topppa-trip-taxonomy-img .topppa-trip-taxonomy-button-two:hover',
            ]
        );
        $this->add_responsive_control(
            'tp_icon_btn_border_hover_radius',
            [
                'label'      => esc_html__('Border Radius', 'topper-pack'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .topppa-trip-taxonomy-img .topppa-trip-taxonomy-button-two:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'tp_icon_btn_shadow_hover',
                'selector' => '{{WRAPPER}} .topppa-trip-taxonomy-img .topppa-trip-taxonomy-button-two:hover',
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->add_responsive_control(
            'tp_icon_btn_margin',
            [
                'label' => esc_html__('Margin', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} .topppa-trip-taxonomy-img .topppa-trip-taxonomy-button-two' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'tp_icon_btn_padding',
            [
                'label' => esc_html__('Padding', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} .topppa-trip-taxonomy-img .topppa-trip-taxonomy-button-two' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                    'enable_slider' => 'yes',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'arrow_typography',
                'selector' => '{{WRAPPER}} .service-slider-arrow .button',
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
                    '{{WRAPPER}} .service-slider-arrow .button' => 'height: {{SIZE}}{{UNIT}};',
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
                    '{{WRAPPER}} .service-slider-arrow .button' => 'width: {{SIZE}}{{UNIT}};',
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
                    '{{WRAPPER}} .service-slider-arrow.arrow-two' => 'gap: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'select_arrow' => 'arrow_two'
                ]
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
                    '{{WRAPPER}} .service-slider-arrow.arrow-two' => 'top: {{SIZE}}{{UNIT}};',
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
                    '{{WRAPPER}} .service-slider-arrow .button' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .service-slider-arrow .button svg path' => 'fill: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'arrow_background',
                'label' => esc_html__('Background', 'topper-pack'),
                'types' => ['classic', 'gradient', 'video'],
                'selector' => '{{WRAPPER}} .service-slider-arrow .button',
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
                'selector' => '{{WRAPPER}} .service-slider-arrow .button',
            ]
        );
        $this->add_responsive_control(
            'arrow_border_radius',
            [
                'label'      => esc_html__('Border Radius', 'topper-pack'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .service-slider-arrow .button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                    '{{WRAPPER}} .service-slider-arrow .button:hover' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .service-slider-arrow .button:hover svg path' => 'fill: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'arrow_background_hover',
                'label' => esc_html__('Background', 'topper-pack'),
                'types' => ['classic', 'gradient', 'video'],
                'selector' => '{{WRAPPER}} .service-slider-arrow .button:hover',
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
                'selector' => '{{WRAPPER}} .service-slider-arrow .button:hover,',
            ]
        );
        $this->add_responsive_control(
            'arrow_border_radius_hover',
            [
                'label'      => esc_html__('Border Radius', 'topper-pack'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .service-slider-arrow .button:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                    '{{WRAPPER}} .service-slider-arrow .button' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                    '{{WRAPPER}} .service-slider-arrow .button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
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
    protected function category_list() {
        $terms = get_terms(array('taxonomy' => 'trip_types'));
        $term_array = array();
        if (!empty($terms) && !is_wp_error($terms)) {
            foreach ($terms as $term) {
                $term_array[$term->slug] = $term->name;
            }
        }
        return $term_array;
    }
    protected function render() {
        $settings = $this->get_settings_for_display();
        $items_count = $settings['items_count'];
        $selected_categories = !empty($settings['cat_name']) ? $settings['cat_name'] : array();
        $args = [
            'taxonomy'   => 'trip_types',
            'number'     => $items_count,
            'hide_empty' => true,
        ];
        if (!empty($selected_categories)) {
            $args['slug'] = $selected_categories;
        }
        $terms = get_terms($args);

        if (empty($terms) || is_wp_error($terms)) {
            echo '<p>' . esc_html__('No terms found.', 'topper-pack') . '</p>';
            return;
        }
        $SliderId = wp_rand(1241, 3256);
        if ($settings['enable_slider'] == 'yes') {
            $column = 'topppa-trip-tex-slider';
        } else {
            $column = $settings['xl_col'] . ' ' . $settings['lg_col'] . ' ' . $settings['md-col'];
        }
        $allowed_html = [
            'a'      => ['href' => []],
            'br'     => [],
            'em'     => [],
            'strong' => [],
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
        $style_clas = [
            'style_one' => 'style-one',
            'style_two' => 'style-two',
            'style_three' => 'style-three',
            'style_four' => 'style-four',
            'style_five' => 'style-five',
            'style_six' => 'style-six',
            'style_seven' => 'style-seven',
        ];
        $select_arrow = [
            'arrow_one' => 'arrow-one',
            'arrow_two' => 'arrow-two',
        ];
        $btn_class = isset($button_classes[$settings['topppa_btn_styles']]) ? $button_classes[$settings['topppa_btn_styles']] : '';
        $class = isset($style_clas[$settings['select_style']]) ? $style_clas[$settings['select_style']] : '';
        $arrow = isset($select_arrow[$settings['select_arrow']]) ? $select_arrow[$settings['select_arrow']] : '';
?>
        <div class="topppa-trip-taxonomy-wrp <?php echo esc_attr($class); ?>">
            <div class="<?php echo esc_attr(
                            ($settings['enable_slider'] === 'yes' ? 'swiper topppa-swiper-slider' : 'no-slide') . ' topppa-swiper-slider-' . $SliderId
                        ); ?>"
                <?php if ($settings['enable_slider'] === 'yes') : ?>
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
                <div class="<?php echo esc_attr($settings['enable_slider'] === 'yes' ? 'swiper-wrapper' : 'row'); ?>">
                    <?php foreach ($terms as $term) :
                        $term_link  = get_term_link($term);
                        $term_name  = esc_html($term->name);
                        $term_count = intval($term->count);
                        $description = get_term_meta($term->term_id, 'wte-shortdesc-textarea', true);
                        $image_id_array = get_term_meta($term->term_id, 'category-image-id', true);
                        $image_id = is_array($image_id_array) ? reset($image_id_array) : $image_id_array;
                        if (empty($image_id)) {
                            $image_id = $image_id_array; // fallback if not array
                        }
                        $image_url = $image_id ? wp_get_attachment_image_url($image_id, 'full') : '';

                    ?>
                        <div class="<?php echo esc_attr($settings['enable_slider'] === 'yes' ? 'swiper-slide' : $column); ?>">
                            <div class="topppa-trip-taxonomy-item">
                                <?php if ($image_url) : ?>
                                    <div class="topppa-trip-taxonomy-img">
                                        <img src="<?php echo esc_url($image_url); ?>" alt="<?php echo esc_attr($term_name); ?>" />
                                        <?php if ($settings['select_style'] === 'style_four' && $settings['enable_button_two'] === 'yes') : ?>
                                            <a href="<?php echo esc_url($term_link); ?>" class="topppa-trip-taxonomy-button-two">
                                                <?php \Elementor\Icons_Manager::render_icon($settings['btn_two_icon'], ['aria-hidden' => 'true']); ?>
                                            </a>
                                        <?php endif; ?>
                                        <?php if ($settings['select_style'] === 'style_seven' && $settings['enable_button'] === 'yes') : ?>
                                            <div class="topppa-trip-taxonomy-button">
                                                <div class="topppa-btn-wrapper slider-btn-wrapper <?php echo esc_attr($btn_class); ?>">
                                                    <a href="<?php echo esc_url($term_link); ?>" class="topppa-btn">
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
                                            </div>
                                        <?php endif; ?>

                                    </div>
                                <?php endif; ?>
                                <div class="topppa-trip-taxonomy-content">
                                    <?php if (
                                        $settings['select_style'] === 'style_three' &&
                                        $settings['enable_trip_counts'] === 'yes'
                                    ) : ?>
                                        <div class="topppa-trip-taxonomy-stitle">
                                            <span><?php echo esc_html($term_count); ?></span>
                                            <?php echo esc_html($settings['trip_count']); ?>
                                        </div>
                                    <?php endif; ?>

                                    <div class="topppa-trip-taxonomy-content-area">
                                        <?php if (
                                            $settings['select_style'] !== 'style_seven' &&
                                            $settings['select_style'] !== 'style_six' &&
                                            $settings['select_style'] !== 'style_three' &&
                                            $settings['enable_trip_counts'] === 'yes'
                                        ) : ?>
                                            <div class="topppa-trip-taxonomy-stitle">
                                                <?php echo esc_html($settings['trip_count']); ?>
                                                <?php echo esc_html($term_count); ?>
                                            </div>
                                        <?php endif; ?>

                                        <<?php echo esc_attr($settings['title_tag']); ?> class="topppa-trip-taxonomy-title">
                                            <?php if ($settings['enable_title_icon'] === 'yes') : ?>
                                                <span>
                                                    <?php \Elementor\Icons_Manager::render_icon($settings['title_icon'], ['aria-hidden' => 'true']); ?>
                                                </span>
                                            <?php endif; ?>
                                            <a href="<?php echo esc_url($term_link); ?>">
                                                <?php echo esc_html($term_name); ?>
                                            </a>
                                        </<?php echo esc_attr($settings['title_tag']); ?>>
                                        <?php if ($settings['select_style'] === 'style_seven') : ?>
                                            <?php if ($settings['enable_trip_counts'] === 'yes') : ?>
                                                <div class="topppa-trip-taxonomy-stitle">
                                                    ( <?php echo esc_html($settings['trip_count']); ?>
                                                    <?php echo esc_html($term_count); ?>)
                                                </div>
                                            <?php endif; ?>
                                        <?php endif; ?>

                                        <?php if ($settings['select_style'] !== 'style_seven') : ?>
                                            <?php if ($settings['enable_description'] === 'yes' && !empty($description)) : ?>
                                                <div class="topppa-trip-taxonomy-des">
                                                    <?php echo esc_html($description); ?>
                                                </div>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                        <?php if ($settings['select_style'] !== 'style_seven') : ?>
                                            <div class="topppa-trip-texonomy-bottom">
                                                <?php if ($settings['select_style'] === 'style_six' && $settings['enable_trip_counts'] === 'yes') : ?>
                                                    <div class="topppa-trip-taxonomy-stitle">
                                                        <?php echo esc_html($settings['trip_count']); ?>
                                                        <?php echo esc_html($term_count); ?>
                                                    </div>
                                                <?php endif; ?>

                                                <?php if ($settings['enable_button'] === 'yes') : ?>
                                                    <div class="topppa-trip-taxonomy-button">
                                                        <div class="topppa-btn-wrapper slider-btn-wrapper <?php echo esc_attr($btn_class); ?>">
                                                            <a href="<?php echo esc_url($term_link); ?>" class="topppa-btn">
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
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <?php if ($settings['enable_dote'] === 'yes') : ?>
                <div class="topppa-dote-pagination topppa-dote-pagination topppa-topppa-dote-pagination-<?php echo esc_attr($SliderId); ?>"></div>
            <?php endif; ?>

            <?php if ($settings['enable_arrow'] === 'yes' && $settings['enable_slider'] === 'yes') : ?>
                <div class="service-slider-arrow <?php echo esc_attr($arrow); ?>">
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
            <?php endif; ?>
        </div>

        <script>
            jQuery(document).ready(function($) {
                "use strict";
                const boxes = document.querySelectorAll('.topppa-trip-taxonomy-item');
                boxes.forEach(box => {
                    box.addEventListener('mouseenter', () => {
                        boxes.forEach(b => b.classList.remove('active'));
                        box.classList.add('active');
                    });
                });
            });
        </script>
<?php
    }
}