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
class TOPPPA_Trip_Destination_Tab_V2_Module_Widget extends \Elementor\Widget_Base {

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
        return 'trip-Destination-tab-v2';
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
        return TOPPPA_EPWB . esc_html__('Trip Destination Tab V2', 'topper-pack');
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
        return ['topppa', 'widget', 'Trip Destination Tab V2', 'travel', 'topperpack'];
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
            'filter_item',
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
                    'filter_item' => 'catergory_item',
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
                    'filter_item' => 'catergory_item',
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
            'category_list',
            [
                'label' => esc_html__('Content Items', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'separator' => 'before',
                'fields' => $repeater->get_controls(),
                'title_field' => '{{{ cat_name }}}',
                'condition' => [
                    'filter_item' => 'catergory_item',
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
                'default' => 'yes',
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
                    'filter_item' => 'catergory_item',
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
                    '{{WRAPPER}} .topppa-trip-destination-v2-tab-menu-wrap .nav' => 'justify-content: {{VALUE}}',
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
                    '{{WRAPPER}} .topppa-trip-destination-v2-tab-menu-wrap .nav' => 'gap: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'tab_width',
            [
                'label'      => esc_html__('Width', 'topper-pack'),
                'type'       => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'custom'],
                'range'      => [
                    'px' => [
                        'min'  => 0,
                        'max'  => 1000,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'default'    => [
                    'unit' => '%',
                ],
                'selectors'  => [
                    '{{WRAPPER}} .topppa-trip-destination-v2-tab-menu-wrap' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'tab_box_alignment',
            [
                'label'     => __('Alignment', 'topper-pack'),
                'type'      => \Elementor\Controls_Manager::CHOOSE,
                'options'   => [
                    'margin-left:auto' => [
                        'title' => __('Left Auto', 'topper-pack'),
                        'icon'  => 'eicon-arrow-right',
                    ],
                    'margin:auto' => [
                        'title' => __('Center Auto', 'topper-pack'),
                        'icon'  => 'eicon-h-align-center',
                    ],
                    'margin-right:auto' => [
                        'title' => __('Right Auto', 'topper-pack'),
                        'icon'  => 'eicon-arrow-left',
                    ],

                ],
                'toggle'    => true,
                'selectors' => [
                    '{{WRAPPER}} .topppa-trip-destination-v2-tab-menu-wrap' => '{{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'tab_box_background',
                'types' => ['classic', 'gradient', 'video'],
                'selector' => '{{WRAPPER}} .topppa-trip-destination-v2-tab-menu-wrap .nav',
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'tab_box_border',
                'selector' => '{{WRAPPER}} .topppa-trip-destination-v2-tab-menu-wrap .nav',
            ]
        );
        $this->add_responsive_control(
            'tab_box_border_radius',
            [
                'label' => esc_html__('Border Radius', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .topppa-trip-destination-v2-tab-menu-wrap .nav' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                    '{{WRAPPER}} .topppa-trip-destination-v2-tab-menu-wrap .nav' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                    '{{WRAPPER}} .topppa-trip-destination-v2-tab-menu-wrap .nav' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->start_controls_tabs('menu_section_tabs');

        // Box Style Tab
        $this->start_controls_tab(
            'tab_menu_box',
            [
                'label' => esc_html__('Tab Style', 'topper-pack'),
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'tab_typography',
                'label'    => esc_html__('Typography', 'topper-pack'),
                'selector' => '{{WRAPPER}} .nav .nav-item .topppa-trip-destination-v2-tab-menu-btn',
            ]
        );
        $this->add_responsive_control(
            'tab_color',
            [
                'label'     => esc_html__('Color', 'topper-pack'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .nav .nav-item .topppa-trip-destination-v2-tab-menu-btn' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name'     => 'tab_backgrounds',
                'label'    => esc_html__('Background', 'topper-pack'),
                'types'    => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .nav .nav-item .topppa-trip-destination-v2-tab-menu-btn',
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name'     => 'tab_border',
                'label'    => esc_html__('Border', 'topper-pack'),
                'selector' => '{{WRAPPER}} .nav .nav-item .topppa-trip-destination-v2-tab-menu-btn',
            ]
        );
        $this->add_responsive_control(
            'tab_border_radius',
            [
                'label'      => esc_html__('Border Radius', 'topper-pack'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .nav .nav-item .topppa-trip-destination-v2-tab-menu-btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'tab_shadow',
                'label'    => esc_html__('Box Shadow', 'topper-pack'),
                'selector' => '{{WRAPPER}} .nav .nav-item .topppa-trip-destination-v2-tab-menu-btn',
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
                    '{{WRAPPER}} .nav .nav-item .topppa-trip-destination-v2-tab-menu-btn:hover' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .nav .nav-item .topppa-trip-destination-v2-tab-menu-btn.active' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name'     => 'active_tab_backgrounds',
                'label'    => esc_html__('Background', 'topper-pack'),
                'types'    => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .nav .nav-item .topppa-trip-destination-v2-tab-menu-btn.active, {{WRAPPER}} .nav .nav-item .topppa-trip-destination-v2-tab-menu-btn:hover',
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name'     => 'active_tab_border',
                'label'    => esc_html__('Border', 'topper-pack'),
                'selector' => '{{WRAPPER}} .nav .nav-item .topppa-trip-destination-v2-tab-menu-btn.active, {{WRAPPER}} .nav .nav-item .topppa-trip-destination-v2-tab-menu-btn:hover',
            ]
        );
        $this->add_responsive_control(
            'active_border_radius',
            [
                'label'      => esc_html__('Border Radius', 'topper-pack'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .nav .nav-item .topppa-trip-destination-v2-tab-menu-btn:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .nav .nav-item .topppa-trip-destination-v2-tab-menu-btn.active' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'active_tab_shadow',
                'label'    => esc_html__('Box Shadow', 'topper-pack'),
                'selector' => '{{WRAPPER}} .nav .nav-item .topppa-trip-destination-v2-tab-menu-btn.active, {{WRAPPER}} .nav .nav-item .topppa-trip-destination-v2-tab-menu-btn:hover',
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
                    '{{WRAPPER}} .nav .nav-item .topppa-trip-destination-v2-tab-menu-btn' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                    '{{WRAPPER}} .nav .nav-item .topppa-trip-destination-v2-tab-menu-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                'default' => 'center',
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .topppa-trip-destination-v2-item .topppa-trip-destination-v2-content' => 'text-align: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'box_bg',
                'label' => esc_html__('Background', 'topper-pack'),
                'types' => ['classic', 'gradient', 'video'],
                'selector' => '{{WRAPPER}} .topppa-trip-destination-v2-item .topppa-trip-destination-v2-content',
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'box_border',
                'label' => esc_html__('Border', 'topper-pack'),
                'selector' => '{{WRAPPER}} .topppa-trip-destination-v2-item .topppa-trip-destination-v2-content',
            ]
        );
        $this->add_responsive_control(
            'box_radius',
            [
                'label' => esc_html__('Border Radius', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .topppa-trip-destination-v2-item .topppa-trip-destination-v2-content' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'box_shadow',
                'label' => esc_html__('Box Shadow', 'topper-pack'),
                'selector' => '{{WRAPPER}} .topppa-trip-destination-v2-item .topppa-trip-destination-v2-content',
            ]
        );
        $this->add_responsive_control(
            'box_margin',
            [
                'label' => esc_html__('Margin', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .topppa-trip-destination-v2-item .topppa-trip-destination-v2-content-area' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                    '{{WRAPPER}} .topppa-trip-destination-v2-item .topppa-trip-destination-v2-content-area' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->start_controls_tabs(
            'card_content_style_tabs'
        );
        $this->start_controls_tab(
            'destinations_style_tab',
            [
                'label' => esc_html__('Destinations', 'topper-pack'),
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'destinations_typo',
                'selector' => '{{WRAPPER}} .topppa-trip-destination-v2-item .topppa-trip-destination-v2-location',
            ]
        );
        $this->add_responsive_control(
            'destinations_color',
            [
                'label'     => esc_html__('Color', 'topper-pack'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .topppa-trip-destination-v2-item .topppa-trip-destination-v2-location' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .topppa-trip-destination-v2-item .topppa-trip-destination-v2-location a' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_responsive_control(
            'destinations_hcolor',
            [
                'label'     => esc_html__('Hover Color', 'topper-pack'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .topppa-trip-destination-v2-item .topppa-trip-destination-v2-location a:hover' => 'color: {{VALUE}}',
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
                    '{{WRAPPER}} .topppa-trip-destination-v2-item .topppa-trip-destination-v2-location' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                    '{{WRAPPER}} .topppa-trip-destination-v2-item .topppa-trip-destination-v2-location' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_tab();
        $this->start_controls_tab(
            'destinations_icon_tab',
            [
                'label' => esc_html__('Icon', 'topper-pack'),
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'destinations_icon_typography',
                'selector' => '{{WRAPPER}} .topppa-trip-destination-v2-item .topppa-trip-destination-v2-location span',
            ]
        );
        $this->add_responsive_control(
            'destinations_icon_color',
            [
                'label' => esc_html__('Color', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .topppa-trip-destination-v2-item .topppa-trip-destination-v2-location span' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->end_controls_tab();
        $this->start_controls_tab(
            'destinations_image_tab',
            [
                'label' => esc_html__('Image', 'topper-pack'),
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
                    '{{WRAPPER}} .topppa-trip-destination-v2-item .topppa-trip-destination-v2-image' => 'height: {{SIZE}}{{UNIT}};',
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
                    '{{WRAPPER}} .topppa-trip-destination-v2-item .topppa-trip-destination-v2-image img' => 'object-fit: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name'     => 'image_border',
                'label'    => esc_html__('Border', 'topper-pack'),
                'selector' => '{{WRAPPER}} .topppa-trip-destination-v2-item .topppa-trip-destination-v2-image',
            ]
        );
        $this->add_responsive_control(
            'image_border_radius',
            [
                'label'      => esc_html__('Border Radius', 'topper-pack'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .topppa-trip-destination-v2-item .topppa-trip-destination-v2-image' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'image_shadow',
                'selector' => '{{WRAPPER}} .topppa-trip-destination-v2-item .topppa-trip-destination-v2-image',
            ]
        );
        $this->add_responsive_control(
            'image_margin',
            [
                'label'      => esc_html__('Margin', 'topper-pack'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .topppa-trip-destination-v2-item .topppa-trip-destination-v2-image' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                    '{{WRAPPER}} .topppa-trip-destination-v2-item .topppa-trip-destination-v2-image' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();


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
                'selector' => '{{WRAPPER}} .topppa-trip-destination-v2-item .topppa-trip-destination-v2-price-holder span',
            ]
        );
        $this->add_responsive_control(
            'pricing_color',
            [
                'label' => esc_html__('Color', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .topppa-trip-destination-v2-item .topppa-trip-destination-v2-price-holder span' => 'color: {{VALUE}}',
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
                'selector' => '{{WRAPPER}} .topppa-trip-destination-v2-item .topppa-trip-destination-v2-price-holder .topppa-trip-destination-v2-tpice-text',
            ]
        );
        $this->add_responsive_control(
            'pricing_text_color',
            [
                'label' => esc_html__('Color', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .topppa-trip-destination-v2-item .topppa-trip-destination-v2-price-holder .topppa-trip-destination-v2-tpice-text' => 'color: {{VALUE}}',
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
                    '{{WRAPPER}} .topppa-trip-destination-v2-price-holder' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                    '{{WRAPPER}} .topppa-trip-destination-v2-price-holder' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
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
        $item_cats = (!empty($settings['category_list'])) ? $settings['category_list'] : [];

        $args_options = [];

        if ($settings["filter_item"] === 'catergory_item' && !empty($item_cats)) {
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
?>
        <div class="topppa-trip-destination-v2-tab-wrapper">
            <?php if ($settings["filter_item"] === 'catergory_item' && $settings["enable_top_menu"] === 'yes') : ?>
                <div class="container">
                    <div class="topppa-trip-destination-v2-tab-menu-wrap">
                        <ul class="nav topppa-trip-destination-v2-tab-menu" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link topppa-trip-destination-v2-tab-menu-btn active" data-bs-toggle="tab" data-bs-target="#all-<?php echo esc_attr($unique); ?>" type="button" role="tab" aria-selected="true">
                                    <?php echo esc_html($settings['all_item']); ?>
                                </button>
                            </li>
                            <?php foreach ($item_cats as $item_cat):
                                if (!empty($item_cat['cat_name'])):
                                    $term = get_term_by('slug', $item_cat['cat_name'], 'activities');
                                    if ($term && !is_wp_error($term)):
                            ?>
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link topppa-trip-destination-v2-tab-menu-btn"
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
                                    $location = function_exists('wte_get_the_tax_term_list') ? wte_get_the_tax_term_list($trip_id, 'destination', '', ', ', '') : '';
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
                                        <div class="topppa-trip-destination-v2-item">
                                            <?php if (has_post_thumbnail()) : ?>
                                                <div class="topppa-trip-destination-v2-image">
                                                    <?php the_post_thumbnail('full'); ?>
                                                </div>
                                            <?php endif; ?>
                                            <div class="topppa-trip-destination-v2-content-area">
                                                <div class="topppa-trip-destination-v2-content">
                                                    <?php if (!empty($location)) : ?>
                                                        <div class="topppa-trip-destination-v2-location">
                                                            <?php if ($settings['enable_title_icon'] == 'yes') : ?>
                                                                <span> <i aria-hidden="true" class="fas fa-map-marker-alt"></i> </span>
                                                            <?php endif; ?>
                                                            <?php echo wp_kses_post($location); ?>
                                                        </div>
                                                    <?php endif; ?>
                                                    <?php if ($settings['enable_price'] == 'yes') : ?>
                                                        <div class="topppa-trip-destination-v2-price-holder">
                                                            <?php echo wp_kses_post($actual_price_html); ?>
                                                            <span class="topppa-trip-destination-v2-tpice-text">/<?php echo esc_html($settings['pricing_text']) ?></span>
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
                                                    <div class="topppa-trip-destination-v2-item">
                                                        <?php if (has_post_thumbnail()) : ?>
                                                            <div class="topppa-trip-destination-v2-image">
                                                                <?php the_post_thumbnail('full'); ?>
                                                            </div>
                                                        <?php endif; ?>
                                                        <div class="topppa-trip-destination-v2-content-area">
                                                            <div class="topppa-trip-destination-v2-content">
                                                            <?php
                                                                // Set $location for each post in category tab
                                                                $trip_id = get_the_ID();
                                                                $location = function_exists('wte_get_the_tax_term_list') ? wte_get_the_tax_term_list($trip_id, 'destination', '', ', ', '') : '';
                                                                ?>
                                                                <?php if (!empty($location)) : ?>
                                                                    <div class="topppa-trip-destination-v2-location">
                                                                        <?php if ($settings['enable_title_icon'] == 'yes') : ?>
                                                                            <span> <i aria-hidden="true" class="fas fa-map-marker-alt"></i> </span>
                                                                        <?php endif; ?>
                                                                        <?php echo wp_kses_post($location); ?>
                                                                    </div>
                                                                <?php endif; ?>
                                                                <?php if ($settings['enable_price'] == 'yes') : ?>
                                                                    <div class="topppa-trip-destination-v2-price-holder">
                                                                        <?php echo wp_kses_post($actual_price_html); ?>
                                                                        <span class="topppa-trip-destination-v2-tpice-text">/<?php echo esc_html($settings['pricing_text']) ?></span>
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
