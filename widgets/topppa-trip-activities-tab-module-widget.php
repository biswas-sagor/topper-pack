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
class TOPPPA_Trip_Activities_Tab_Module_Widget extends \Elementor\Widget_Base {

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
        return 'trip-activities-tab-module';
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
        return TOPPPA_EPWB . esc_html__('Trip Activities Tab', 'topper-pack');
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
        return 'eicon-library-grid';
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
        return ['topppa', 'widget', 'Trip Activities Tab', 'travel', 'topperpack'];
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
                'label' => esc_html__('Trip Tab Options', 'topper-pack'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'select_donation_item',
            [
                'label' => esc_html__('Select Filter', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'all_item',
                'options' => [
                    'all_item' => esc_html__('All Item', 'topper-pack'),
                    'catergory_item' => esc_html__('Category Item', 'topper-pack'),
                ],
            ]
        );

        $this->add_control(
            'enable_top_menu',
            [
                'label' => esc_html__('Enable Menu', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', 'topper-pack'),
                'label_off' => esc_html__('Hide', 'topper-pack'),
                'return_value' => 'yes',
                'default' => 'yes',
                'condition' => [
                    'select_donation_item' => 'catergory_item',
                ],
            ]
        );

        $this->add_control(
            'all_item',
            [
                'label' => esc_html__('Text', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('All', 'topper-pack'),
                'dynamic' => ['active' => true],
                'condition' => [
                    'enable_top_menu' => 'yes',
                    'select_donation_item' => 'catergory_item',
                ],
            ]
        );

        $this->add_control(
            'disply_item',
            [
                'label' => esc_html__('Display Item', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'default' => 6,
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'cat_name',
            [
                'label' => esc_html__('Select Category', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => $this->category_list(),
            ]
        );

        $repeater->add_control(
            'disply_item',
            [
                'label' => __('Display Item', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'default' => 3,
            ]
        );
        $repeater->add_control(
            'cat_icon',
            [
                'label' => esc_html__('Icon', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::ICONS,
                'default' => [
                    'value' => 'fas fa-circle',
                    'library' => 'fa-solid',
                ],
            ]
        );
        $this->add_control(
            'course_cat',
            [
                'label' => esc_html__('Content Items', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'separator' => 'before',
                'fields' => $repeater->get_controls(),
                'title_field' => '{{{ cat_name }}}',
                'condition' => [
                    'select_donation_item' => 'catergory_item',
                ],
            ]
        );
        $this->add_control(
            'enable_location_meta',
            [
                'label' => esc_html__('Enable Location', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', 'topper-pack'),
                'label_off' => esc_html__('Hide', 'topper-pack'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );
        $this->add_control(
            'enable_trip_meta',
            [
                'label' => esc_html__('Enable Meta', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', 'topper-pack'),
                'label_off' => esc_html__('Hide', 'topper-pack'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );
        // Meta select control
        $this->add_control(
            'trip_meta',
            [
                'label'       => esc_html__('Trip Meta Fields', 'topper-pack'),
                'type'        => \Elementor\Controls_Manager::SELECT2,
                'label_block' => true,
                'multiple'    => true,
                'options'     => [
                    'destination' => esc_html__('Destination', 'topper-pack'),
                    'duration'    => esc_html__('Duration', 'topper-pack'),
                    'difficulty'  => esc_html__('Difficulty', 'topper-pack'),
                    'group-size'  => esc_html__('Group Size', 'topper-pack'),
                    'activities'  => esc_html__('Activities', 'topper-pack'),
                    'trip-types'  => esc_html__('Trip Type', 'topper-pack'),
                ],
                'default'     => ['duration', 'group-size', 'activities'],
                'condition'   => [
                    'enable_trip_meta' => 'yes',
                ],
            ]
        );
        $this->add_control(
            'title_length',
            [
                'label' => esc_html__('Title Length', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'min' => 3,
                'max' => 100,
                'step' => 1,
                'default' => 6,
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
                'default' => 'yes',
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
                ],
            ]
        );
        $this->add_control(
            'enable_discount_value',
            [
                'label' => esc_html__('Enable Discount', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', 'topper-pack'),
                'label_off' => esc_html__('Hide', 'topper-pack'),
                'return_value' => 'yes',
                'default' => 'yes',
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
                'default' => 'yes',
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
                'default'   => esc_html__('Book Now', 'topper-pack'),
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
            'enable_container',
            [
                'label' => esc_html__('Enable Container', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', 'topper-pack'),
                'label_off' => esc_html__('Hide', 'topper-pack'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'desktop_col',
            [
                'label' => esc_html__('Columns On Desktop', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'col-xl-4',
                'options' => [
                    'col-xl-12' => esc_html__('1 Column', 'topper-pack'),
                    'col-xl-6' => esc_html__('2 Column', 'topper-pack'),
                    'col-xl-4' => esc_html__('3 Column', 'topper-pack'),
                    'col-xl-3' => esc_html__('4 Column', 'topper-pack'),
                ],
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'ipadpro_col',
            [
                'label' => esc_html__('Columns On Ipad Pro', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'col-lg-6',
                'options' => [
                    'col-lg-12' => esc_html__('1 Column', 'topper-pack'),
                    'col-lg-6' => esc_html__('2 Column', 'topper-pack'),
                    'col-lg-4' => esc_html__('3 Column', 'topper-pack'),
                    'col-lg-3' => esc_html__('4 Column', 'topper-pack'),
                ],
            ]
        );

        $this->add_control(
            'tab_col',
            [
                'label' => esc_html__('Columns On Tablet', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'col-md-6',
                'options' => [
                    'col-md-12' => esc_html__('1 Column', 'topper-pack'),
                    'col-md-6' => esc_html__('2 Column', 'topper-pack'),
                    'col-md-4' => esc_html__('3 Column', 'topper-pack'),
                    'col-md-3' => esc_html__('4 Column', 'topper-pack'),
                ],
            ]
        );

        $this->end_controls_section();
        $this->start_controls_section(
            'tab_content_style_CSS',
            [
                'label' => esc_html__('Menu Content Style', 'topper-pack'),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
                'condition' => [
                    'enable_top_menu' => 'yes',
                    'select_donation_item' => 'catergory_item',
                ],
            ]
        );

        // Alignment Control
        $this->add_responsive_control(
            'tab_alignment',
            [
                'label'     => __('Alignment', 'topper-pack'),
                'type'      => \Elementor\Controls_Manager::CHOOSE,
                'options'   => [
                    'flex-start'   => [
                        'title' => __('Left', 'topper-pack'),
                        'icon'  => 'eicon-justify-start-h',
                    ],
                    'center' => [
                        'title' => __('Center', 'topper-pack'),
                        'icon'  => 'eicon-justify-center-h',
                    ],
                    'space-evenly' => [
                        'title' => __('Space Evenly', 'topper-pack'),
                        'icon'  => 'eicon-justify-space-around-h',
                    ],
                    'space-between' => [
                        'title' => __('Space Between', 'topper-pack'),
                        'icon'  => 'eicon-justify-space-between-h',
                    ],
                    'flex-end'  => [
                        'title' => __('Right', 'topper-pack'),
                        'icon'  => 'eicon-justify-end-h',
                    ],
                ],
                'toggle'    => true,
                'selectors' => [
                    '{{WRAPPER}} .topppa-trip-tab-menu-wrap .nav' => 'justify-content: {{VALUE}}',
                ],
            ]
        );

        // Gap Control
        $this->add_responsive_control(
            'tab_gap',
            [
                'label'      => esc_html__('Gap', 'topper-pack'),
                'type'       => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'custom'],
                'range'      => [
                    'px' => [
                        'min'  => 0,
                        'max'  => 150,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'default'    => [
                    'unit' => 'px',
                ],
                'selectors'  => [
                    '{{WRAPPER}} .topppa-trip-tab-menu-wrap .nav' => 'gap: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'tab_box_background',
                'types' => ['classic', 'gradient', 'video'],
                'selector' => '{{WRAPPER}} .topppa-trip-tab-menu-wrap .nav',
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'tab_box_border',
                'selector' => '{{WRAPPER}} .topppa-trip-tab-menu-wrap .nav',
            ]
        );
        $this->add_responsive_control(
            'tab_box_border_radius',
            [
                'label' => esc_html__('Border Radius', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .topppa-trip-tab-menu-wrap .nav' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        // Margin Control
        $this->add_responsive_control(
            'tab_margin',
            [
                'label'      => esc_html__('Margin', 'topper-pack'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .topppa-trip-tab-menu-wrap .nav' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        // Padding Control
        $this->add_responsive_control(
            'tab_padding',
            [
                'label'      => esc_html__('Padding', 'topper-pack'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .topppa-trip-tab-menu-wrap .nav' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->start_controls_tabs('menu_section_tabs');

        // Box Style Tab
        $this->start_controls_tab(
            'tab_menu_box',
            [
                'label' => esc_html__('Box Style', 'topper-pack'),
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'tab_typography',
                'label'    => esc_html__('Typography', 'topper-pack'),
                'selector' => '{{WRAPPER}} .nav .nav-item .topppa-trip-tab-menu-btn',
            ]
        );
        $this->add_responsive_control(
            'tab_color',
            [
                'label'     => esc_html__('Color', 'topper-pack'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .nav .nav-item .topppa-trip-tab-menu-btn' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name'     => 'tab_backgrounds',
                'label'    => esc_html__('Background', 'topper-pack'),
                'types'    => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .nav .nav-item .topppa-trip-tab-menu-btn',
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name'     => 'tab_border',
                'label'    => esc_html__('Border', 'topper-pack'),
                'selector' => '{{WRAPPER}} .nav .nav-item .topppa-trip-tab-menu-btn',
            ]
        );
        $this->add_responsive_control(
            'tab_border_radius',
            [
                'label'      => esc_html__('Border Radius', 'topper-pack'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .nav .nav-item .topppa-trip-tab-menu-btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'tab_shadow',
                'label'    => esc_html__('Box Shadow', 'topper-pack'),
                'selector' => '{{WRAPPER}} .nav .nav-item .topppa-trip-tab-menu-btn',
            ]
        );
        $this->end_controls_tab();

        // Active Style Tab
        $this->start_controls_tab(
            'active_tab',
            [
                'label' => esc_html__('Active Style', 'topper-pack'),
            ]
        );
        $this->add_responsive_control(
            'tab_active_color',
            [
                'label'     => esc_html__('Active Color', 'topper-pack'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .nav .nav-item .topppa-trip-tab-menu-btn:hover' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .nav .nav-item .topppa-trip-tab-menu-btn.active' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name'     => 'active_tab_backgrounds',
                'label'    => esc_html__('Background', 'topper-pack'),
                'types'    => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .nav .nav-item .topppa-trip-tab-menu-btn.active, {{WRAPPER}} .nav .nav-item .topppa-trip-tab-menu-btn:hover',
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name'     => 'active_tab_border',
                'label'    => esc_html__('Border', 'topper-pack'),
                'selector' => '{{WRAPPER}} .nav .nav-item .topppa-trip-tab-menu-btn.active, {{WRAPPER}} .nav .nav-item .topppa-trip-tab-menu-btn:hover',
            ]
        );
        $this->add_responsive_control(
            'active_border_radius',
            [
                'label'      => esc_html__('Border Radius', 'topper-pack'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .nav .nav-item .topppa-trip-tab-menu-btn:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .nav .nav-item .topppa-trip-tab-menu-btn.active' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'active_tab_shadow',
                'label'    => esc_html__('Box Shadow', 'topper-pack'),
                'selector' => '{{WRAPPER}} .nav .nav-item .topppa-trip-tab-menu-btn.active, {{WRAPPER}} .nav .nav-item .topppa-trip-tab-menu-btn:hover',
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->add_responsive_control(
            'active_tab_margin',
            [
                'label'      => esc_html__('Margin', 'topper-pack'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .nav .nav-item .topppa-trip-tab-menu-btn' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        // Active Tab Padding
        $this->add_responsive_control(
            'active_tab_padding',
            [
                'label'      => esc_html__('Padding', 'topper-pack'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .nav .nav-item .topppa-trip-tab-menu-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
            'box_direction',
            [
                'label' => esc_html__('Direction', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    'row' => esc_html__('Row', 'topper-pack'),
                    'row-reverse' => esc_html__('Row Reverse', 'topper-pack'),
                    'column' => esc_html__('Column', 'topper-pack'),
                    'column-reverse' => esc_html__('Column Reverse', 'topper-pack'),
                ],
                'selectors' => [
                    '{{WRAPPER}} .topppa-trip-item' => 'flex-direction: {{VALUE}};',
                ],
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
                        'icon' => 'eicon-align-start-h',
                    ],
                    'center' => [
                        'title' => esc_html__('Center', 'topper-pack'),
                        'icon' => 'eicon-align-center-h',
                    ],
                    'right' => [
                        'title' => esc_html__('Right', 'topper-pack'),
                        'icon' => 'eicon-align-end-h',
                    ],
                ],
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .topppa-trip-item' => 'align-items: {{VALUE}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'box_gap',
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
                    '{{WRAPPER}} .topppa-trip-item' => 'gap: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->start_controls_tabs(
            'box_style_tabs'
        );

        $this->start_controls_tab(
            'box_style_normal_tab',
            [
                'label' => esc_html__('Normal', 'topper-pack'),
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'box_bg',
                'label' => esc_html__('Background', 'topper-pack'),
                'types' => ['classic', 'gradient', 'video'],
                'selector' => '{{WRAPPER}} .topppa-trip-item',
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'box_border',
                'label' => esc_html__('Border', 'topper-pack'),
                'selector' => '{{WRAPPER}} .topppa-trip-item',
            ]
        );
        $this->add_responsive_control(
            'box_radius',
            [
                'label' => esc_html__('Border Radius', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .topppa-trip-item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'box_shadow',
                'label' => esc_html__('Box Shadow', 'topper-pack'),
                'selector' => '{{WRAPPER}} .topppa-trip-item',
            ]
        );
        $this->end_controls_tab();

        $this->start_controls_tab(
            'box_style_hover_tab',
            [
                'label' => esc_html__('Hover', 'topper-pack'),
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'box_bg_hover',
                'label' => esc_html__('Background', 'topper-pack'),
                'types' => ['classic', 'gradient', 'video'],
                'selector' => '{{WRAPPER}} .topppa-trip-item:hover',
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'box_border_hover',
                'label' => esc_html__('Border', 'topper-pack'),
                'selector' => '{{WRAPPER}} .topppa-trip-item:hover',
            ]
        );
        $this->add_responsive_control(
            'box_radius_hover',
            [
                'label' => esc_html__('Border Radius', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .topppa-trip-item:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'box_shadow_hover',
                'label' => esc_html__('Box Shadow', 'topper-pack'),
                'selector' => '{{WRAPPER}} .topppa-trip-item:hover',
            ]
        );
        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->add_responsive_control(
            'box_margin',
            [
                'label' => esc_html__('Margin', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .topppa-trip-item' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                    '{{WRAPPER}} .topppa-trip-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'inner_box_padding',
            [
                'label' => esc_html__('Inner Box Padding', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .topppa-trip-item .topppa-trip-content-area' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
        // <==========>
        // <==========> IMAGE STYLES <==========>

        $this->start_controls_section(
            'image_style',
            [
                'label' => esc_html__('Image Style', 'topper-pack'),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_responsive_control(
            'image_height',
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
                    '{{WRAPPER}} .topppa-trip-item .topppa-trip-image' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'image_width',
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
                    '{{WRAPPER}} .topppa-trip-item .topppa-trip-image' => 'width: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'box_direction' => ['row', 'row-reverse'],
                ],
            ]
        );
        $this->add_responsive_control(
            'min_image_width',
            [
                'label'      => esc_html__('Min Width', 'topper-pack'),
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
                    '{{WRAPPER}} .topppa-trip-item .topppa-trip-image' => 'min-width: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'box_direction' => ['row', 'row-reverse'],
                ],
            ]
        );
        $this->add_responsive_control(
            'image_object',
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
                    '{{WRAPPER}} .topppa-trip-item .topppa-trip-image img' => 'object-fit: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name'     => 'image_border',
                'label'    => esc_html__('Border', 'topper-pack'),
                'selector' => '{{WRAPPER}} .topppa-trip-item .topppa-trip-image',
            ]
        );
        $this->add_responsive_control(
            'image_border_radius',
            [
                'label'      => esc_html__('Border Radius', 'topper-pack'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .topppa-trip-item .topppa-trip-image' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'image_shadow',
                'selector' => '{{WRAPPER}} .topppa-trip-item .topppa-trip-image',
            ]
        );
        $this->add_responsive_control(
            'image_margin',
            [
                'label'      => esc_html__('Margin', 'topper-pack'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .topppa-trip-item .topppa-trip-image' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'image_padding',
            [
                'label'      => esc_html__('Padding', 'topper-pack'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .topppa-trip-item .topppa-trip-image' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();
        $this->start_controls_section(
            'card_content_style',
            [
                'label' => esc_html__('Content Style', 'topper-pack'),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->start_controls_tabs(
            'card_content_style_tabs'
        );
        $this->start_controls_tab(
            'title_style_tab',
            [
                'label' => esc_html__('Title', 'topper-pack'),
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'title_typo',
                'selector' => '{{WRAPPER}} .topppa-trip-item .topppa-trip-title',
            ]
        );
        $this->add_responsive_control(
            'title_color',
            [
                'label'     => esc_html__('Color', 'topper-pack'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .topppa-trip-item .topppa-trip-title a' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_responsive_control(
            'title_hcolor',
            [
                'label'     => esc_html__('Hover Color', 'topper-pack'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .topppa-trip-item .topppa-trip-title a:hover' => 'color: {{VALUE}}',
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
                    '{{WRAPPER}} .topppa-trip-item .topppa-trip-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                    '{{WRAPPER}} .topppa-trip-item .topppa-trip-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_tab();
        $this->start_controls_tab(
            'destinations_style_tab',
            [
                'label' => esc_html__('Destinations', 'topper-pack'),
                'condition' => [
                    'enable_location_meta' => 'yes',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'destinations_typo',
                'selector' => '{{WRAPPER}} .topppa-trip-item .topppa-trip-location',
            ]
        );
        $this->add_responsive_control(
            'destinations_color',
            [
                'label'     => esc_html__('Color', 'topper-pack'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .topppa-trip-item .topppa-trip-location' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .topppa-trip-item .topppa-trip-location a' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_responsive_control(
            'destinations_hcolor',
            [
                'label'     => esc_html__('Hover Color', 'topper-pack'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .topppa-trip-item .topppa-trip-location a:hover' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_responsive_control(
            'destinations_margin',
            [
                'label'      => esc_html__('Margin', 'topper-pack'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .topppa-trip-item .topppa-trip-location' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'destinations_padding',
            [
                'label'      => esc_html__('Padding', 'topper-pack'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .topppa-trip-item .topppa-trip-location' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_tab();
        $this->start_controls_tab(
            'style_desc_tab',
            [
                'label' => esc_html__('Description', 'topper-pack'),
                'condition' => [
                    'enable_description' => 'yes',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'desc_typo',
                'selector' => '{{WRAPPER}} .topppa-trip-description',
            ]
        );
        $this->add_responsive_control(
            'desc_color',
            [
                'label'     => esc_html__('Color', 'topper-pack'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .topppa-trip-description' => 'color: {{VALUE}}',
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
                    '{{WRAPPER}} .topppa-trip-description' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                    '{{WRAPPER}} .topppa-trip-description' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();
        // <==========>
        // <==========> BOX STYLES <==========>

        $this->start_controls_section(
            'meta_styles',
            [
                'label' => esc_html__('Meta Style', 'topper-pack'),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_responsive_control(
            'meta_gap',
            [
                'label' => esc_html__('Gap', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                        'step' => 1,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .topppa-trip-item .topppa-trip-meta ul' => 'gap: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'meta_typography',
                'selector' => '{{WRAPPER}} .topppa-trip-item .topppa-trip-meta ul li',
            ]
        );

        $this->add_responsive_control(
            'meta_color',
            [
                'label' => esc_html__('Text Color', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .topppa-trip-item .topppa-trip-meta ul li' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'meta_bg',
                'label' => esc_html__('Background', 'topper-pack'),
                'types' => ['classic', 'gradient', 'video'],
                'selector' => '{{WRAPPER}} .topppa-trip-item .topppa-trip-meta ul',
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'meta_border',
                'label' => esc_html__('Border', 'topper-pack'),
                'selector' => '{{WRAPPER}} .topppa-trip-item .topppa-trip-meta ul',
            ]
        );
        $this->add_responsive_control(
            'meta_radius',
            [
                'label' => esc_html__('Border Radius', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .topppa-trip-item .topppa-trip-meta ul' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'meta_shadow',
                'label' => esc_html__('Box Shadow', 'topper-pack'),
                'selector' => '{{WRAPPER}} .topppa-trip-item .topppa-trip-meta ul',
            ]
        );

        $this->add_responsive_control(
            'meta_border_gap',
            [
                'label' => esc_html__('Border Gap', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                        'step' => 1,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .topppa-trip-item .topppa-trip-meta ul li' => 'padding-right: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'meta_border_colorss',
            [
                'label' => esc_html__('Border Color', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .topppa-trip-item .topppa-trip-meta ul li' => 'border-color: {{VALUE}}',
                ],
            ]
        );
        $this->add_responsive_control(
            'meta_margin',
            [
                'label' => esc_html__('Margin', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .topppa-trip-item .topppa-trip-meta ul' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'meta_padding',
            [
                'label' => esc_html__('Padding', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .topppa-trip-item .topppa-trip-meta ul' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
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
                'selector' => '{{WRAPPER}} .topppa-trip-item .topppa-trip-buttom-area .topppa-trip-price-holder span',
            ]
        );
        $this->add_responsive_control(
            'pricing_color',
            [
                'label' => esc_html__('Color', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .topppa-trip-item .topppa-trip-buttom-area .topppa-trip-price-holder span' => 'color: {{VALUE}}',
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
                'selector' => '{{WRAPPER}} .topppa-trip-item .topppa-trip-buttom-area .topppa-trip-price-holder .topppa-trip-tpice-text',
            ]
        );
        $this->add_responsive_control(
            'pricing_text_color',
            [
                'label' => esc_html__('Color', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .topppa-trip-item .topppa-trip-buttom-area .topppa-trip-price-holder .topppa-trip-tpice-text' => 'color: {{VALUE}}',
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
                    '{{WRAPPER}} .topppa-trip-price-holder' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                    '{{WRAPPER}} .topppa-trip-price-holder' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();
        $this->start_controls_section(
            'discount_styles',
            [
                'label' => esc_html__('Discount', 'topper-pack'),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'discount_typo',
                'selector' => '{{WRAPPER}} .topppa-trip-item .topppa-trip-image .topppa-trip-badge_discount',
            ]
        );
        $this->add_responsive_control(
            'discount_color',
            [
                'label'     => esc_html__('Color', 'topper-pack'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .topppa-trip-item .topppa-trip-image .topppa-trip-badge_discount' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'discount_background',
                'types' => ['classic', 'gradient', 'video'],
                'selector' => '{{WRAPPER}} .topppa-trip-item .topppa-trip-image .topppa-trip-badge_discount',
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'discount_border',
                'selector' => '{{WRAPPER}} .topppa-trip-item .topppa-trip-image .topppa-trip-badge_discount',
            ]
        );
        $this->add_responsive_control(
            'discount_border_radius',
            [
                'label' => esc_html__('Border Radius', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .topppa-trip-item .topppa-trip-image .topppa-trip-badge_discount' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'discount_shadow',
                'selector' => '{{WRAPPER}} .topppa-trip-item .topppa-trip-image .topppa-trip-badge_discount',
            ]
        );
        $this->add_responsive_control(
            'discount_margin',
            [
                'label'      => esc_html__('Margin', 'topper-pack'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .topppa-trip-item .topppa-trip-image .topppa-trip-badge_discount' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'discount_padding',
            [
                'label'      => esc_html__('Padding', 'topper-pack'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .topppa-trip-item .topppa-trip-image .topppa-trip-badge_discount' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                    '{{WRAPPER}} .topppa-trip-button .topppa-btn' => 'gap: {{SIZE}}{{UNIT}};',
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
                'selector' => '{{WRAPPER}} .topppa-trip-button .topppa-btn',
            ]
        );

        $this->add_responsive_control(
            'topppa_btn_color',
            [
                'label'     => esc_html__('Color', 'topper-pack'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .topppa-trip-button .topppa-btn' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .topppa-trip-button .topppa-btn span' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'topppa_btn_background',
                'types' => ['classic', 'gradient', 'video'],
                'selector' => '{{WRAPPER}} .topppa-trip-button .topppa-btn',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name'     => 'topppa_btn_border',
                'label'    => esc_html__('Border', 'topper-pack'),
                'selector' => '{{WRAPPER}} .topppa-trip-button .topppa-btn',
            ]
        );

        $this->add_responsive_control(
            'topppa_btn_border_radius',
            [
                'label'      => esc_html__('Border Radius', 'topper-pack'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .topppa-trip-button .topppa-btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'topppa_btn_box_shadow',
                'label'    => esc_html__('Shadow', 'topper-pack'),
                'selector' => '{{WRAPPER}} .topppa-trip-button .topppa-btn',
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
                    '{{WRAPPER}} .topppa-trip-button .topppa-btn .btn-icon' => 'width: {{SIZE}}{{UNIT}};',
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
                    '{{WRAPPER}} .topppa-trip-button .topppa-btn .btn-icon' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'topppa_btn_icon_content_typography',
                'selector' => '{{WRAPPER}} .topppa-trip-button .topppa-btn .btn-icon',
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'topppa_btn_icon_bg',
                'types' => ['classic', 'gradient', 'video'],
                'selector' => '{{WRAPPER}} .topppa-trip-button .topppa-btn .btn-icon',
            ]
        );
        $this->add_responsive_control(
            'topppa_btn_icon_border_radius',
            [
                'label' => esc_html__('Border Radius', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .topppa-trip-button .topppa-btn .btn-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                    '{{WRAPPER}} .topppa-trip-button .topppa-btn' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                    '{{WRAPPER}} .topppa-trip-button .topppa-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                'selector' => '{{WRAPPER}} .topppa-trip-button .topppa-btn:hover',
            ]
        );

        $this->add_responsive_control(
            'topppa_btn_color_hover',
            [
                'label'     => esc_html__('Color', 'topper-pack'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .topppa-trip-button .topppa-btn:hover' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .topppa-trip-button .topppa-btn:hover span' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'topppa_btn_background_hover',
                'types' => ['classic', 'gradient', 'video'],
                'selector' => '{{WRAPPER}} .topppa-trip-button .topppa-btn:hover',
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
                'selector' => '{{WRAPPER}} .topppa-trip-button .topppa-btn::before, {{WRAPPER}} .topppa-trip-button .topppa-btn::after',
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
                'selector' => '{{WRAPPER}} .topppa-trip-button .topppa-btn:hover',
            ]
        );

        $this->add_responsive_control(
            'topppa_btn_border_radius_hover',
            [
                'label'      => esc_html__('Border Radius', 'topper-pack'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .topppa-trip-button .topppa-btn:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'topppa_btn_box_shadow_hover',
                'label'    => esc_html__('Shadow', 'topper-pack'),
                'selector' => '{{WRAPPER}} .topppa-trip-button .topppa-btn:hover',
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
                    '{{WRAPPER}} .topppa-trip-button .topppa-btn:hover .btn-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'topppa_btn_icon_hbgcolor',
                'types' => ['classic', 'gradient', 'video'],
                'selector' => '{{WRAPPER}} .topppa-trip-button .topppa-btn:hover .btn-icon',
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
                'selector' => '{{WRAPPER}} .topppa-trip-button .topppa-btn .btn-icon::before',
                'condition' => [
                    'topppa_btn_styles' => 'style_eight'
                ]
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();
    }

    protected function category_list() {
        $terms = get_terms(array('taxonomy' => 'activities'));
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
        $column = $settings['desktop_col'] . ' ' . $settings['ipadpro_col'] . ' ' . $settings['tab_col'];
        $container = ($settings['enable_container'] === 'yes') ? 'container' : 'container-fluid';
        $unique = wp_rand(1000, 9999999);

        $query_args = [
            'post_type' => 'trip',
            'posts_per_page' => $settings['disply_item'],
            'meta_key' => '_thumbnail_id',
        ];

        // Get selected categories for filtering
        $item_cats = $settings['course_cat'];
        $args_options = [];

        if ($settings["select_donation_item"] === 'catergory_item' && !empty($item_cats)) {
            foreach ($item_cats as $item_cat) {
                if (!empty($item_cat['cat_name'])) {
                    $term = get_term_by('slug', $item_cat['cat_name'], 'activities');
                    if ($term && !is_wp_error($term)) {
                        $args_options[] = $term->term_id;
                    }
                }
            }

            if (!empty($args_options)) {
                $query_args['tax_query'] = [
                    [
                        'taxonomy' => 'activities',
                        'terms' => $args_options,
                    ],
                ];
            }
        }

        $query = new WP_Query($query_args);
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
        <div class="topppa-trip-tab-wrapper">
            <?php if ($settings["select_donation_item"] === 'catergory_item' && $settings["enable_top_menu"] === 'yes') : ?>
                <div class="container">
                    <div class="topppa-trip-tab-menu-wrap">
                        <ul class="nav topppa-trip-tab-menu" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link topppa-trip-tab-menu-btn active" data-bs-toggle="tab" data-bs-target="#all-<?php echo esc_attr($unique); ?>" type="button" role="tab" aria-selected="true">
                                    <?php echo esc_html($settings['all_item']); ?>
                                </button>
                            </li>
                            <?php foreach ($item_cats as $item_cat):
                                if (!empty($item_cat['cat_name'])):
                                    $term = get_term_by('slug', $item_cat['cat_name'], 'activities');
                                    if ($term && !is_wp_error($term)):
                            ?>
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link topppa-trip-tab-menu-btn"
                                                data-bs-toggle="tab"
                                                data-bs-target="#<?php echo esc_attr($term->slug); ?>"
                                                type="button" role="tab">
                                                <?php \Elementor\Icons_Manager::render_icon($item_cat['cat_icon'], ['aria-hidden' => 'true']); ?>
                                                <?php echo esc_html($term->name); ?>
                                            </button>
                                        </li>
                            <?php endif;
                                endif;
                            endforeach; ?>
                        </ul>
                    </div>
                </div>
            <?php endif; ?>

            <div class="<?php echo esc_attr($container); ?>">
                <div class="tab-content" id="myTabContent-<?php echo esc_attr($unique); ?>">
                    <!-- All Items Tab -->
                    <div class="tab-pane fade show active" id="all-<?php echo esc_attr($unique); ?>">
                        <div class="tab-container">
                            <div class="row">
                                <?php while ($query->have_posts()) : $query->the_post();
                                    $trip_id = get_the_ID();
                                    $location = function_exists('wte_get_the_tax_term_list') ? wte_get_the_tax_term_list($trip_id, 'activities', '', ', ', '') : '';
                                    $meta = function_exists('wte_trip_get_trip_rest_metadata') ? wte_trip_get_trip_rest_metadata($trip_id) : null;
                                    // Price Handling
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
                                    <div class="<?php echo esc_attr($column); ?>">

                                        <div class="topppa-trip-item">
                                            <?php if (has_post_thumbnail()) : ?>
                                                <div class="topppa-trip-image">
                                                    <?php the_post_thumbnail('full'); ?>
                                                    <?php if ($settings['enable_discount_value'] == 'yes') : ?>
                                                        <?php if (!empty($discount_html)) : ?>
                                                            <div class="topppa-trip-badge_discount">
                                                                <?php echo esc_html($discount_html); ?>
                                                            </div>
                                                        <?php endif; ?>
                                                    <?php endif; ?>
                                                </div>
                                            <?php endif; ?>
                                            <div class="topppa-trip-content-area">
                                                <<?php echo esc_attr($settings['title_tag']); ?> class="topppa-trip-title">
                                                    <a href="<?php the_permalink(); ?>"><?php echo wp_kses_post(wp_trim_words(get_the_title(), $settings['title_length'], '')); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></a>
                                                </<?php echo esc_attr($settings['title_tag']); ?>>
                                                <?php if ($settings['enable_location_meta'] === 'yes') : ?>
                                                    <?php if (!empty($location)) : ?>
                                                        <div class="topppa-trip-location">
                                                            <span> <i aria-hidden="true" class="fas fa-hiking"></i> </span>
                                                            <?php echo wp_kses_post($location); ?>
                                                        </div>
                                                    <?php endif; ?>
                                                <?php endif; ?>
                                                <?php if ($settings['enable_trip_meta'] === 'yes') : ?>
                                                    <div class="topppa-trip-meta">
                                                        <ul>
                                                            <?php
                                                            // Get selected trip meta fields from Elementor widget settings
                                                            $selected_meta_fields = $settings['trip_meta'] ?? [];
                                                            // Trip Meta: Destination
                                                            if (in_array('destination', $selected_meta_fields)) {
                                                                echo '<li> <i class="fas fa-map-marker-alt"></i>';
                                                                $terms = get_the_terms(get_the_ID(), 'destination');
                                                                if (!empty($terms) && !is_wp_error($terms)) {
                                                                    foreach ($terms as $term) {
                                                                        echo esc_html($term->name);
                                                                    }
                                                                } else {
                                                                    echo esc_html__('No destination found.', 'topper-pack');
                                                                }
                                                                echo '</li>';
                                                            }
                                                            // Trip Meta: Duration
                                                            if (in_array('duration', $selected_meta_fields)) {
                                                                echo '<li> <i class="far fa-clock"></i>';
                                                                $trip_setting_serialized = get_post_meta(get_the_ID(), 'wp_travel_engine_setting', true);
                                                                $trip_settings = maybe_unserialize($trip_setting_serialized);
                                                                $days = isset($trip_settings['trip_duration']) ? (int) $trip_settings['trip_duration'] : 0;
                                                                $nights = isset($trip_settings['trip_duration_nights']) ? (int) $trip_settings['trip_duration_nights'] : 0;
                                                                $unit = isset($trip_settings['trip_duration_unit']) ? $trip_settings['trip_duration_unit'] : 'days';

                                                                if ($days || $nights) {
                                                                    if ($days) {
                                                                        echo esc_html($days . ' ' . ucfirst($unit));
                                                                    }
                                                                    if ($nights) {
                                                                        echo ' ' . esc_html($nights . ' Nights');
                                                                    }
                                                                } else {
                                                                    echo esc_html__('Not Available', 'topper-pack');
                                                                }
                                                                echo '</li>';
                                                            }

                                                            // Trip Meta: Difficulty
                                                            if (in_array('difficulty', $selected_meta_fields)) {
                                                                echo '<li> <i class="far fa-life-ring"></i>';
                                                                $terms = get_the_terms(get_the_ID(), 'difficulty');
                                                                if (!empty($terms) && !is_wp_error($terms)) {
                                                                    foreach ($terms as $term) {
                                                                        echo esc_html($term->name);
                                                                    }
                                                                } else {
                                                                    echo esc_html__('Not found.', 'topper-pack');
                                                                }
                                                                echo '</li>';
                                                            }
                                                            // Trip Meta: Group Size
                                                            if (in_array('group-size', $selected_meta_fields)) {
                                                                echo '<li> <i class="fas fa-users"></i>';
                                                                $min_pax = get_post_meta(get_the_ID(), '_s_min_pax', true);
                                                                $max_pax = get_post_meta(get_the_ID(), '_s_max_pax', true);

                                                                if ($min_pax || $max_pax) {
                                                                    if ($min_pax && $max_pax) {
                                                                        echo esc_html($min_pax) . ' - ' . esc_html($max_pax);
                                                                    } elseif ($max_pax) {
                                                                        echo esc_html__('Up to', 'topper-pack') . ' ' . esc_html($max_pax);
                                                                    } elseif ($min_pax) {
                                                                        echo esc_html__('Minimum', 'topper-pack') . ' ' . esc_html($min_pax);
                                                                    }
                                                                } else {
                                                                    echo esc_html__('Not found.', 'topper-pack');
                                                                }
                                                                echo '</li>';
                                                            }

                                                            // Trip Meta: Activities
                                                            if (in_array('activities', $selected_meta_fields)) {
                                                                echo '<li> <i class="fas fa-hiking"></i>';
                                                                $terms = get_the_terms(get_the_ID(), 'activities');
                                                                if (!empty($terms) && !is_wp_error($terms)) {
                                                                    echo esc_html(implode(', ', wp_list_pluck($terms, 'name')));
                                                                } else {
                                                                    echo esc_html__('No activities.', 'topper-pack');
                                                                }
                                                                echo '</li>';
                                                            }
                                                            // Trip Meta: Trip Types
                                                            if (in_array('trip-types', $selected_meta_fields)) {
                                                                echo '<li> <i class="fas fa-map"></i>';
                                                                $terms = get_the_terms(get_the_ID(), 'trip_types');
                                                                if (!empty($terms) && !is_wp_error($terms)) {
                                                                    $trip_types = wp_list_pluck($terms, 'name');
                                                                    echo esc_html(implode(', ', $trip_types));
                                                                } else {
                                                                    echo esc_html__('No trip type.', 'topper-pack');
                                                                }
                                                                echo '</li>';
                                                            }
                                                            ?>
                                                        </ul>
                                                    </div>
                                                <?php endif; ?>
                                                <?php if ($settings['enable_description'] == 'yes') : ?>
                                                    <div class="topppa-trip-description"> <?php echo wp_kses_post(wp_trim_words(get_the_content(), $settings['dec_length'])); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></div>
                                                <?php endif; ?>
                                                <div class="topppa-trip-buttom-area">
                                                    <?php if ($settings['enable_price'] == 'yes') : ?>
                                                        <div class="topppa-trip-price-holder">
                                                            <?php echo wp_kses_post($actual_price_html); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
                                                            <span class="topppa-trip-tpice-text">/<?php echo esc_html($settings['pricing_text']) ?></span>
                                                        </div>
                                                    <?php endif; ?>
                                                    <?php if ($settings['enable_button'] === 'yes') : ?>
                                                        <div class="topppa-btn-wrapper topppa-trip-button <?php echo esc_attr($btn_class); ?>">
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
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                <?php endwhile;
                                wp_reset_postdata(); ?>
                            </div>
                        </div>
                    </div>

                    <!-- Category Tabs -->
                    <?php foreach ($item_cats as $item_cat):
                        if (!empty($item_cat['cat_name'])):
                            $term = get_term_by('slug', $item_cat['cat_name'], 'activities');
                            if ($term && !is_wp_error($term)):
                                $term_query = new WP_Query([
                                    'post_type' => 'trip',
                                    'posts_per_page' => $item_cat['disply_item'],
                                    'tax_query' => [[
                                        'taxonomy' => 'activities',
                                        'terms' => $term->term_id,
                                    ]],
                                    'meta_key' => '_thumbnail_id',
                                ]);
                    ?>
                                <div class="tab-pane fade" id="<?php echo esc_attr($term->slug); ?>">
                                    <div class="tab-container">
                                        <div class="row">
                                            <?php while ($term_query->have_posts()) : $term_query->the_post(); ?>
                                                <div class="<?php echo esc_attr($column); ?>">
                                                    <div class="topppa-trip-item">
                                                        <?php if (has_post_thumbnail()) : ?>
                                                            <div class="topppa-trip-image">
                                                                <?php the_post_thumbnail('full'); ?>
                                                                <?php if ($settings['enable_discount_value'] == 'yes') : ?>
                                                                    <?php if (!empty($discount_html)) : ?>
                                                                        <div class="topppa-trip-badge_discount">
                                                                            <?php echo esc_html($discount_html); ?>
                                                                        </div>
                                                                    <?php endif; ?>
                                                                <?php endif; ?>
                                                            </div>
                                                        <?php endif; ?>
                                                        <div class="topppa-trip-content-area">
                                                            <<?php echo esc_attr($settings['title_tag']); ?> class="topppa-trip-title">
                                                                <a href="<?php the_permalink(); ?>"><?php echo wp_kses_post(wp_trim_words(get_the_title(), $settings['title_length'], '')); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></a>
                                                            </<?php echo esc_attr($settings['title_tag']); ?>>
                                                            <?php
                                                            // Set $location for each post in category tab
                                                            $trip_id = get_the_ID();
                                                            $location = function_exists('wte_get_the_tax_term_list') ? wte_get_the_tax_term_list($trip_id, 'activities', '', ', ', '') : '';
                                                            ?>
                                                            <?php if ($settings['enable_location_meta'] === 'yes') : ?>
                                                                <?php if (!empty($location)) : ?>
                                                                    <div class="topppa-trip-location">
                                                                        <span> <i aria-hidden="true" class="fas fa-hiking"></i> </span>
                                                                        <?php echo wp_kses_post($location); ?>
                                                                    </div>
                                                                <?php endif; ?>
                                                            <?php endif; ?>
                                                            <?php if ($settings['enable_trip_meta'] === 'yes') : ?>
                                                                <div class="topppa-trip-meta">
                                                                    <ul>
                                                                        <?php
                                                                        // Get selected trip meta fields from Elementor widget settings
                                                                        $selected_meta_fields = $settings['trip_meta'] ?? [];
                                                                        // Trip Meta: Destination
                                                                        if (in_array('destination', $selected_meta_fields)) {
                                                                            echo '<li> <i class="fas fa-map-marker-alt"></i>';
                                                                            $terms = get_the_terms(get_the_ID(), 'destination');
                                                                            if (!empty($terms) && !is_wp_error($terms)) {
                                                                                foreach ($terms as $term) {
                                                                                    echo esc_html($term->name);
                                                                                }
                                                                            } else {
                                                                                echo esc_html__('No destination found.', 'topper-pack');
                                                                            }
                                                                            echo '</li>';
                                                                        }
                                                                        // Trip Meta: Duration
                                                                        if (in_array('duration', $selected_meta_fields)) {
                                                                            echo '<li> <i class="far fa-clock"></i>';
                                                                            $trip_setting_serialized = get_post_meta(get_the_ID(), 'wp_travel_engine_setting', true);
                                                                            $trip_settings = maybe_unserialize($trip_setting_serialized);
                                                                            $days = isset($trip_settings['trip_duration']) ? (int) $trip_settings['trip_duration'] : 0;
                                                                            $nights = isset($trip_settings['trip_duration_nights']) ? (int) $trip_settings['trip_duration_nights'] : 0;
                                                                            $unit = isset($trip_settings['trip_duration_unit']) ? $trip_settings['trip_duration_unit'] : 'days';

                                                                            if ($days || $nights) {
                                                                                if ($days) {
                                                                                    echo esc_html($days . ' ' . ucfirst($unit));
                                                                                }
                                                                                if ($nights) {
                                                                                    echo ' ' . esc_html($nights . ' Nights');
                                                                                }
                                                                            } else {
                                                                                echo esc_html__('Not Available', 'topper-pack');
                                                                            }
                                                                            echo '</li>';
                                                                        }

                                                                        // Trip Meta: Difficulty
                                                                        if (in_array('difficulty', $selected_meta_fields)) {
                                                                            echo '<li> <i class="far fa-life-ring"></i>';
                                                                            $terms = get_the_terms(get_the_ID(), 'difficulty');
                                                                            if (!empty($terms) && !is_wp_error($terms)) {
                                                                                foreach ($terms as $term) {
                                                                                    echo esc_html($term->name);
                                                                                }
                                                                            } else {
                                                                                echo esc_html__('Not found.', 'topper-pack');
                                                                            }
                                                                            echo '</li>';
                                                                        }
                                                                        // Trip Meta: Group Size
                                                                        if (in_array('group-size', $selected_meta_fields)) {
                                                                            echo '<li> <i class="fas fa-users"></i>';
                                                                            $min_pax = get_post_meta(get_the_ID(), '_s_min_pax', true);
                                                                            $max_pax = get_post_meta(get_the_ID(), '_s_max_pax', true);

                                                                            if ($min_pax || $max_pax) {
                                                                                if ($min_pax && $max_pax) {
                                                                                    echo esc_html($min_pax) . ' - ' . esc_html($max_pax);
                                                                                } elseif ($max_pax) {
                                                                                    echo esc_html__('Up to', 'topper-pack') . ' ' . esc_html($max_pax);
                                                                                } elseif ($min_pax) {
                                                                                    echo esc_html__('Minimum', 'topper-pack') . ' ' . esc_html($min_pax);
                                                                                }
                                                                            } else {
                                                                                echo esc_html__('Not found.', 'topper-pack');
                                                                            }
                                                                            echo '</li>';
                                                                        }

                                                                        // Trip Meta: Activities
                                                                        if (in_array('activities', $selected_meta_fields)) {
                                                                            echo '<li> <i class="fas fa-hiking"></i>';
                                                                            $terms = get_the_terms(get_the_ID(), 'activities');
                                                                            if (!empty($terms) && !is_wp_error($terms)) {
                                                                                echo esc_html(implode(', ', wp_list_pluck($terms, 'name')));
                                                                            } else {
                                                                                echo esc_html__('No activities.', 'topper-pack');
                                                                            }
                                                                            echo '</li>';
                                                                        }
                                                                        // Trip Meta: Trip Types
                                                                        if (in_array('trip-types', $selected_meta_fields)) {
                                                                            echo '<li> <i class="fas fa-map"></i>';
                                                                            $terms = get_the_terms(get_the_ID(), 'trip_types');
                                                                            if (!empty($terms) && !is_wp_error($terms)) {
                                                                                $trip_types = wp_list_pluck($terms, 'name');
                                                                                echo esc_html(implode(', ', $trip_types));
                                                                            } else {
                                                                                echo esc_html__('No trip type.', 'topper-pack');
                                                                            }
                                                                            echo '</li>';
                                                                        }
                                                                        ?>
                                                                    </ul>
                                                                </div>
                                                            <?php endif; ?>
                                                            <?php if ($settings['enable_description'] == 'yes') : ?>
                                                                <div class="topppa-trip-description"> <?php echo wp_kses_post(wp_trim_words(get_the_content(), $settings['dec_length'])); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></div>
                                                            <?php endif; ?>
                                                            <div class="topppa-trip-buttom-area">
                                                                <?php if ($settings['enable_price'] == 'yes') : ?>
                                                                    <div class="topppa-trip-price-holder">
                                                                        <?php echo wp_kses_post($actual_price_html); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
                                                                        <span class="topppa-trip-tpice-text">/<?php echo esc_html($settings['pricing_text']) ?></span>
                                                                    </div>
                                                                <?php endif; ?>
                                                                <?php if ($settings['enable_button'] === 'yes') : ?>
                                                                    <div class="topppa-btn-wrapper topppa-trip-button <?php echo esc_attr($btn_class); ?>">
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
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php endwhile;
                                            wp_reset_postdata(); ?>
                                        </div>
                                    </div>
                                </div>
                    <?php endif;
                        endif;
                    endforeach; ?>
                </div>
            </div>
        </div>
<?php
    }
}
