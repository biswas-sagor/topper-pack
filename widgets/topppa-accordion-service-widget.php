<?php

use TopperPack\Trait_Loader\Global_Component_Loader;
use \TopperPack\Includes\Controls\Controls_Manager as TopperPack_Controls_Manager;

if (! defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

/**
 * Elementor topppa Accordion Service Widget.
 *
 * Elementor widget that inserts an embbedable content into the page, from any given URL.
 *
 * @since 1.0.0
 */
class TOPPPA_Accordion_Service_Widget extends \Elementor\Widget_Base {
    /**
     * Global Component Trait
     *
     * @package TopperPack
     */
    use Global_Component_Loader;
    /**
     * Get widget name.
     *
     * Retrieve Accordion Service widget widget name.
     *
     * @since 1.0.0
     * @access public
     * @return string Widget name.
     */
    public function get_name() {
        return 'topppa_accordion_service';
    }

    /**
     * Get widget title.
     *
     * Retrieve Accordion Service widget title.
     *
     * @since 1.0.0
     * @access public
     * @return string Widget title.
     */
    public function get_title() {
        return TOPPPA_EPWB . esc_html__('Accordion Service', 'topper-pack');
    }

    /**
     * Get widget icon.
     *
     * Retrieve Accordion Service widget icon.
     *
     * @since 1.0.0
     * @access public
     * @return string Widget icon.
     */
    public function get_icon() {
        return 'eicon-heading';
    }

    /**
     * Get widget categories.
     *
     * Retrieve the list of categories the Accordion Service widget belongs to.
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
     * Retrieve the list of keywords the Accordion Service widget belongs to.
     *
     * @since 1.0.0
     * @access public
     * @return array Widget keywords.
     */
    public function get_keywords() {
        return ['topppa', 'widget', 'Accordion Service', 'topperpack'];
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
        return 'https://doc.topperpack.com/docs/header-footer-widgets/logo/';
    }

    /**
     * Register Accordion Service Widget 1 widget controls.
     *
     * Add input fields to allow the user to customize the widget settings.
     *
     * @since 1.0.0
     * @access protected
     */
    protected function register_controls() {

        $this->start_controls_section(
            'topppa_accordionl_options',
            [
                'label' => esc_html__('topppa Accordion', 'topper-pack'),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->topppa_get_global_button_effects_controls();
        $this->add_control(
            'accordion_show_options',
            [
                'label' => esc_html__('Interaction Type', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'click',
                'options' => [
                    'click' => esc_html__('Click', 'topper-pack'),
                    'hover' => esc_html__('Hover', 'topper-pack'),
                ],
            ]
        );

        $repeater = new \Elementor\Repeater();
        $repeater->add_control(
            'is_active',
            [
                'label' => esc_html__('Active by Default', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'topper-pack'),
                'label_off' => esc_html__('No', 'topper-pack'),
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );
        $repeater->add_control(
            'enable_icon',
            [
                'label' => esc_html__('Enable Icon', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'topper-pack'),
                'label_off' => esc_html__('No', 'topper-pack'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );
        $repeater->add_control(
            'icon',
            [
                'label' => esc_html__('Icon', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::ICONS,
                'default' => [
                    'value' => 'fas fa-circle',
                    'library' => 'fa-solid',
                ],
                'condition' => [
                    'enable_icon' => 'yes',
                ],
            ]
        );
        $repeater->add_control(
            'title',
            [
                'label'       => esc_html__('Title', 'topper-pack'),
                'type'        => \Elementor\Controls_Manager::WYSIWYG,
                'default'     => esc_html__('Marvin McKinney', 'topper-pack'),
            ]
        );
        $repeater->add_control(
            'description',
            [
                'label'       => esc_html__('Short Description', 'topper-pack'),
                'type'        => \Elementor\Controls_Manager::TEXTAREA,
                'rows'        => 10,
                'default'     => esc_html__('oday,s digital landscape, having versatile and flexible website theme is essential for achieving a professional', 'topper-pack'),
                'label_block' => true,
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
            'enable_button_icon',
            [
                'label' => esc_html__('Enable Button', 'topper-pack'),
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
                    'enable_button_icon' => 'yes'
                ]
            ]
        );
        $this->add_control(
            'topppa_accordion_img_item',
            [
                'label'   => esc_html__('Accordion Image', 'topper-pack'),
                'type'    => \Elementor\Controls_Manager::REPEATER,
                'fields'  => $repeater->get_controls(),
                'default'     => [
                    [
                        'title'        => esc_html__('Healing Smiles', 'topper-pack'),
                        'is_active'    => 'yes',
                    ],
                    [
                        'title'        => esc_html__('Together We Care', 'topper-pack'),
                        'is_active'    => 'no',
                    ],
                    [
                        'title'        => esc_html__('Community Events', 'topper-pack'),
                        'is_active'    => 'no',
                    ],
                ],
                'title_field' => '{{{ title }}}',
            ]
        );
        $this->add_control(
            'title_tag',
            [
                'label' => esc_html__('HTML Tag', 'topper-pack'),
                'description' => esc_html__('Add HTML Tag For Small Title', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'h2',
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
            'dec_length',
            [
                'label'   => esc_html__('Content Length ', 'topper-pack'),
                'type'    => \Elementor\Controls_Manager::NUMBER,
                'min'     => 1,
                'max'     => 100,
                'step'    => 1,
                'default' => 12,
            ]
        );
        $this->end_controls_section();
        $this->start_controls_section(
            'content_box_options',
            [
                'label' => esc_html__('Box Style', 'topper-pack'),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_responsive_control(
            'content_box_alignment',
            [
                'label' => esc_html__('Content Alignment', 'topper-pack'),
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
                    '{{WRAPPER}} .accordion-service-container .accordion-service-item' => 'text-align: {{VALUE}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'flex_direction',
            [
                'label' => esc_html__('Flex Direction', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'row',
                'options' => [
                    'row' => esc_html__('Row', 'topper-pack'),
                    'column' => esc_html__('Column', 'topper-pack'),
                ],
                'selectors' => [
                    '{{WRAPPER}} .accordion-service-container' => 'flex-direction: {{VALUE}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'item_flex',
            [
                'label' => esc_html__('Item Flex', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => [''],
                'range' => [
                    '' => [
                        'min' => 0,
                        'max' => 10,
                        'step' => 0.1,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .accordion-service-container .accordion-service-item.active' => 'flex: {{SIZE}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'box_gap',
            [
                'label' => esc_html__('Item Gap', 'topper-pack'),
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
                    '{{WRAPPER}} .accordion-service-container' => 'gap: {{SIZE}}{{UNIT}};',
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
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name'     => 'box_backgrounds',
                'label'    => esc_html__('Background', 'topper-pack'),
                'types'    => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .accordion-service-container .accordion-service-item',
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name'     => 'box_border',
                'label'    => esc_html__('Border', 'topper-pack'),
                'selector' => '{{WRAPPER}} .accordion-service-container .accordion-service-item',

            ]
        );
        $this->add_responsive_control(
            'box_border_radius',
            [
                'label'      => esc_html__('Border Radius', 'topper-pack'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .accordion-service-container .accordion-service-item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'box_shadow',
                'selector' => '{{WRAPPER}} .accordion-service-container .accordion-service-item',
            ]
        );
        $this->end_controls_tab();

        $this->start_controls_tab(
            'style_hover_tab',
            [
                'label' => esc_html__('Hover', 'topper-pack'),
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name'     => 'box_backgrounds_hover',
                'label'    => esc_html__('Background', 'topper-pack'),
                'types'    => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .accordion-service-container .accordion-service-item:hover',
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name'     => 'box_border_hover',
                'label'    => esc_html__('Border', 'topper-pack'),
                'selector' => '{{WRAPPER}} .accordion-service-container .accordion-service-item:hover',

            ]
        );
        $this->add_responsive_control(
            'box_border_radius_hover',
            [
                'label'      => esc_html__('Border Radius', 'topper-pack'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .accordion-service-container .accordion-service-item:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'box_shadow_hover',
                'selector' => '{{WRAPPER}} .accordion-service-container .accordion-service-item:hover',
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
                    '{{WRAPPER}} .accordion-service-container .accordion-service-item' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                    '{{WRAPPER}} .accordion-service-container .accordion-service-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );



        $this->end_controls_section();
        $this->start_controls_section(
            'content_style_option',
            [
                'label' => esc_html__('Content Style', 'topper-pack'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->start_controls_tabs(
            'content_box_tabs'
        );
        $this->start_controls_tab(
            'content_title_tab',
            [
                'label' => esc_html__('Title', 'topper-pack'),
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'title_typo',
                'label' => __('Typography', 'topper-pack'),
                'selector' => ' {{WRAPPER}} .accordion-service-title ',
            ]
        );

        $this->add_responsive_control(
            'title_color',
            [
                'label'       => esc_html__('Color', 'topper-pack'),
                'type'        => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .accordion-service-title' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .accordion-service-title a' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'title_hover_color',
            [
                'label'       => esc_html__('Hover Color', 'topper-pack'),
                'type'        => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .accordion-service-title a:hover' => 'color: {{VALUE}};',

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
                    '{{WRAPPER}} .accordion-service-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                    '{{WRAPPER}} .accordion-service-title' => 'Padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_tab();
        $this->start_controls_tab(
            'content_short_description_tab',
            [
                'label' => esc_html__('Short Desc', 'topper-pack'),
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'subtitle_title_typo',
                'label' => __('Typography', 'topper-pack'),
                'selector' => '{{WRAPPER}} .accordion-service-description',
            ]
        );

        $this->add_responsive_control(
            'subtitle_color',
            [
                'label'       => esc_html__('Color', 'topper-pack'),
                'type'        => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .accordion-service-description' => 'color: {{VALUE}};',
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
                    '{{WRAPPER}} .accordion-service-description' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                    '{{WRAPPER}} .accordion-service-description' => 'Padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();
        $this->start_controls_section(
            'topppa_btn_style',
            [
                'label' => esc_html__('Button Style', 'topper-pack'),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
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
                    '{{WRAPPER}} .topppa-btn-wrapper .topppa-btn' => 'flex-direction: {{VALUE}};',
                ],
                'condition' => [
                    'topppa_show_icon' => 'yes'
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
                    '{{WRAPPER}} .topppa-btn-wrapper .topppa-btn' => 'gap: {{SIZE}}{{UNIT}};',
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
                'selector' => '{{WRAPPER}} .topppa-btn-wrapper .topppa-btn',
            ]
        );

        $this->add_responsive_control(
            'topppa_btn_color',
            [
                'label'     => esc_html__('Color', 'topper-pack'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .topppa-btn-wrapper .topppa-btn' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .topppa-btn-wrapper .topppa-btn span' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'topppa_btn_background',
                'types' => ['classic', 'gradient', 'video'],
                'selector' => '{{WRAPPER}} .topppa-btn-wrapper .topppa-btn',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name'     => 'topppa_btn_border',
                'label'    => esc_html__('Border', 'topper-pack'),
                'selector' => '{{WRAPPER}} .topppa-btn-wrapper .topppa-btn',
            ]
        );

        $this->add_responsive_control(
            'topppa_btn_border_radius',
            [
                'label'      => esc_html__('Border Radius', 'topper-pack'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .topppa-btn-wrapper .topppa-btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'topppa_btn_box_shadow',
                'label'    => esc_html__('Shadow', 'topper-pack'),
                'selector' => '{{WRAPPER}} .topppa-btn-wrapper .topppa-btn',
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
                    '{{WRAPPER}} .topppa-btn-wrapper .topppa-btn .btn-icon' => 'width: {{SIZE}}{{UNIT}};',
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
                    '{{WRAPPER}} .topppa-btn-wrapper .topppa-btn .btn-icon' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'topppa_btn_icon_content_typography',
                'selector' => '{{WRAPPER}} .topppa-btn-wrapper .topppa-btn .btn-icon',
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'topppa_btn_icon_bg',
                'types' => ['classic', 'gradient', 'video'],
                'selector' => '{{WRAPPER}} .topppa-btn-wrapper .topppa-btn .btn-icon',
            ]
        );
        $this->add_responsive_control(
            'topppa_btn_icon_border_radius',
            [
                'label' => esc_html__('Border Radius', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .topppa-btn-wrapper .topppa-btn .btn-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                    '{{WRAPPER}} .topppa-btn-wrapper .topppa-btn' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                    '{{WRAPPER}} .topppa-btn-wrapper .topppa-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                'selector' => '{{WRAPPER}} .topppa-btn-wrapper .topppa-btn:hover',
            ]
        );

        $this->add_responsive_control(
            'topppa_btn_color_hover',
            [
                'label'     => esc_html__('Color', 'topper-pack'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .topppa-btn-wrapper .topppa-btn:hover' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .topppa-btn-wrapper .topppa-btn:hover span' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'topppa_btn_background_hover',
                'types' => ['classic', 'gradient', 'video'],
                'selector' => '{{WRAPPER}} .topppa-btn-wrapper .topppa-btn:hover',
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
                'selector' => '{{WRAPPER}} .topppa-btn-wrapper .topppa-btn::before,{{WRAPPER}} .topppa-btn-wrapper .topppa-btn::after ',
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
                'selector' => '{{WRAPPER}} .topppa-btn-wrapper .topppa-btn:hover',
            ]
        );

        $this->add_responsive_control(
            'topppa_btn_border_radius_hover',
            [
                'label'      => esc_html__('Border Radius', 'topper-pack'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .topppa-btn-wrapper .topppa-btn:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'topppa_btn_box_shadow_hover',
                'label'    => esc_html__('Shadow', 'topper-pack'),
                'selector' => '{{WRAPPER}} .topppa-btn-wrapper .topppa-btn:hover',
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
                    '{{WRAPPER}} .topppa-btn-wrapper .topppa-btn:hover .btn-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'topppa_btn_icon_hbgcolor',
                'types' => ['classic', 'gradient', 'video'],
                'selector' => '{{WRAPPER}} .topppa-btn-wrapper .topppa-btn:hover .btn-icon',
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
                'selector' => '{{WRAPPER}} .topppa-btn-wrapper .topppa-btn .btn-icon::before',
                'condition' => [
                    'topppa_btn_styles' => 'style_eight'
                ]
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();

        $this->start_controls_section(
            'accrodion_icon_style',
            [
                'label' => esc_html__('Icon Styles', 'topper-pack'),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'topppa_service_icon_anim',
            [
                'label' => esc_html__('Icon anim', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'none',
                'options' => [
                    'none' => esc_html__('None', 'topper-pack'),
                    'bounce' => esc_html__('Bounce', 'topper-pack'),
                    'flip' => esc_html__('Flip', 'topper-pack'),
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'accrodion_icon_typo',
                'selector' => '{{WRAPPER}} .accordion-service-container .accordion-service-item .topppa-accordion-service-icon',
            ]
        );
        $this->add_responsive_control(
            'accrodion_icon_height',
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
                    '{{WRAPPER}} .accordion-service-container .accordion-service-item .topppa-accordion-service-icon' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'accrodion_icon_width',
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
                    '{{WRAPPER}} .accordion-service-container .accordion-service-item .topppa-accordion-service-icon' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->start_controls_tabs(
            'accrodion_icon_tabs'
        );
        $this->start_controls_tab(
            'accrodion_icon_tab',
            [
                'label' => esc_html__('Normal', 'topper-pack'),
            ]
        );
        $this->add_responsive_control(
            'accrodion_icon_color',
            [
                'label'     => esc_html__('Icon Color', 'topper-pack'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .accordion-service-container .accordion-service-item .topppa-accordion-service-icon' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .accordion-service-container .accordion-service-item .topppa-accordion-service-icon svg path' => 'fill: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'accrodion_icon_bg',
                'types' => ['classic', 'gradient', 'video'],
                'selector' => '{{WRAPPER}} .accordion-service-container .accordion-service-item .topppa-accordion-service-icon',
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name'     => 'accrodion_icon_border',
                'label'    => esc_html__('Border', 'topper-pack'),
                'selector' => '{{WRAPPER}} .accordion-service-container .accordion-service-item .topppa-accordion-service-icon',
            ]
        );
        $this->add_responsive_control(
            'accrodion_icon_border_radius',
            [
                'label'      => esc_html__('Border Radius', 'topper-pack'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .accordion-service-container .accordion-service-item .topppa-accordion-service-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'accrodion_icon_shadow',
                'selector' => '{{WRAPPER}} .accordion-service-container .accordion-service-item .topppa-accordion-service-icon',
            ]
        );
        $this->end_controls_tab();

        $this->start_controls_tab(
            'accrodion_icon_hover_tab',
            [
                'label' => esc_html__('Hover', 'topper-pack'),
            ]
        );
        $this->add_responsive_control(
            'accrodion_icon_color_hover',
            [
                'label'     => esc_html__('Color', 'topper-pack'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .accordion-service-container .accordion-service-item:hover .topppa-accordion-service-icon' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .accordion-service-container .accordion-service-item:hover .topppa-accordion-service-icon svg path' => 'fill: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'accrodion_icon_hover_bg',
                'types' => ['classic', 'gradient', 'video'],
                'selector' => '{{WRAPPER}} .accordion-service-container .accordion-service-item:hover .topppa-accordion-service-icon',
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name'     => 'accrodion_icon_hover_border',
                'label'    => esc_html__('Border', 'topper-pack'),
                'selector' => '{{WRAPPER}} .accordion-service-container .accordion-service-item:hover .topppa-accordion-service-icon',
            ]
        );
        $this->add_responsive_control(
            'accrodion_icon_border_hover_radius',
            [
                'label'      => esc_html__('Border Radius', 'topper-pack'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .accordion-service-container .accordion-service-item:hover .topppa-accordion-service-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'accrodion_icon_shadow_hover',
                'selector' => '{{WRAPPER}} .accordion-service-container .accordion-service-item:hover .topppa-accordion-service-icon',
            ]
        );

        $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->add_responsive_control(
            'accrodion_icon_margin',
            [
                'label' => esc_html__('Margin', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} .accordion-service-container .accordion-service-item .topppa-accordion-service-icon' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'accrodion_icon_padding',
            [
                'label' => esc_html__('Padding', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} .accordion-service-container .accordion-service-item .topppa-accordion-service-icon' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
        $uniqueId = 'topppa-accordion-' . esc_attr($this->get_id());
        $settings = $this->get_settings_for_display();
        $btn_class = isset($button_classes[$settings['topppa_btn_styles']]) ? $button_classes[$settings['topppa_btn_styles']] : '';
        $dec_length = isset($settings['dec_length']) ? intval($settings['dec_length']) : 12;
?>
        <div id="<?php echo esc_attr($uniqueId); ?>" class="accordion-service-container" data-trigger="<?php echo esc_attr($settings['accordion_show_options']); ?>" data-dec-length="<?php echo esc_attr($dec_length); ?>">
            <?php foreach ($settings['topppa_accordion_img_item'] as $item):
                $active_class = (isset($item['is_active']) && $item['is_active'] === 'yes') ? 'active' : '';
            ?>
                <div class="panel accordion-service-item <?php echo esc_attr($active_class); ?>">
                    <?php if ($item['enable_icon'] === 'yes'): ?>
                        <div class="topppa-accordion-service-icon <?php echo esc_attr($settings['topppa_service_icon_anim']); ?>">
                            <?php \Elementor\Icons_Manager::render_icon($item['icon'], ['aria-hidden' => 'true']); ?>
                        </div>
                    <?php endif; ?>
                    <<?php echo esc_attr($settings['title_tag']); ?> class="accordion-service-title">
                        <?php echo wp_kses($item['title'], $allowed_html); ?>
                    </<?php echo esc_attr($settings['title_tag']); ?>>
                    <div class="accordion-service-description">
                        <?php echo esc_html($item['description']); ?>
                    </div>

                    <?php if ($item['enable_button'] === 'yes' && !empty($item['button_text'])) : ?>
                        <?php
                        $target = !empty($item['button_link']['is_external']) ? ' target="_blank"' : '';
                        $nofollow = !empty($item['button_link']['nofollow']) ? ' rel="nofollow"' : '';
                        $custom_attr = !empty($item['button_link']['custom_attributes']) ? $item['button_link']['custom_attributes'] : '';
                        ?>
                        <div class="topppa-btn-wrapper <?php echo esc_attr($btn_class); ?>">
                            <a href="<?php echo esc_url($item['button_link']['url']); ?>" <?php echo esc_attr($target); ?><?php echo esc_attr($nofollow); ?><?php echo esc_attr($custom_attr); ?> class="topppa-btn">
                                <span class="top-btn-text top-btn-text-v3">
                                    <?php echo esc_html($item['button_text']); ?>
                                </span>
                                <?php if ($btn_class === 'style-three') : ?>
                                    <span class="bottom-btn-text bottom-btn-text-v3">
                                        <?php echo esc_html($item['button_text']); ?>
                                    </span>
                                <?php endif; ?>
                                <?php if (!empty($item['enable_button_icon']) && $item['enable_button_icon'] === 'yes' && !empty($item['btn_icon'])) : ?>
                                    <div class="btn-icon">
                                        <?php \Elementor\Icons_Manager::render_icon($item['btn_icon'], ['aria-hidden' => 'true']);
                                        ?>
                                    </div>
                                <?php endif; ?>
                            </a>
                        </div>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        </div>
<?php
    }
}
