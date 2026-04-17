<?php

use \TopperPack\Includes\Controls\Controls_Manager as TopperPack_Controls_Manager;
use \TopperPack\Includes\Utilities;

if (! defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

/**
 * Elementor topppa Faq Widget.
 *
 * Elementor widget that inserts an embbedable content into the page, from any given URL.
 *
 * @since 1.0.0
 */
class TOPPPA_Faq_Widget extends \Elementor\Widget_Base {

    /**
     * Get widget name.
     *
     * Retrieve Faq widget widget name.
     *
     * @since 1.0.0
     * @access public
     * @return string Widget name.
     */
    public function get_name() {
        return 'topppa_faq';
    }

    /**
     * Get widget title.
     *
     * Retrieve Faq widget title.
     *
     * @since 1.0.0
     * @access public
     * @return string Widget title.
     */
    public function get_title() {
        return TOPPPA_EPWB . esc_html__('Faq', 'topper-pack');
    }

    /**
     * Get widget icon.
     *
     * Retrieve Faq widget icon.
     *
     * @since 1.0.0
     * @access public
     * @return string Widget icon.
     */
    public function get_icon() {
        return 'eicon-accordion';
    }

    /**
     * Get widget categories.
     *
     * Retrieve the list of categories the Faq widget belongs to.
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
     * Retrieve the list of keywords the Faq widget belongs to.
     *
     * @since 1.0.0
     * @access public
     * @return array Widget keywords.
     */
    public function get_keywords() {
        return ['topppa', 'widget', 'faq', 'accordion', 'topperpack'];
    }

    /**
     * Elementor Templates List
     * return array
     */
    public function topppa_elementor_template() {
        $templates = \Elementor\Plugin::instance()->templates_manager->get_source('local')->get_items();
        $types     = array();
        if (empty($templates)) {
            $template_lists = ['0' => __('Do not Saved Templates.', 'topper-pack')];
        } else {
            $template_lists = ['0' => __('Select Template', 'topper-pack')];
            foreach ($templates as $template) {
                $template_lists[$template['template_id']] = $template['title'] . ' (' . $template['type'] . ')';
            }
        }
        return $template_lists;
    }


    public function topppa_faq_content_source_control($repeater) {
        $repeater->add_control(
            'topppa_faq_content_source',
            [
                'label' => esc_html__('Content Source', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'custom',
                'options' => [
                    'custom'  => esc_html__('Content', 'topper-pack'),
                    'pro_faq_content_source' => esc_html__('Elementor Template (Pro)', 'topper-pack'),
                ],
                'separator' => 'before',
            ]
        );
        Utilities::upgrade_pro_notice(
            $repeater,
            \Elementor\Controls_Manager::RAW_HTML,
            'topppa_faq',
            'topppa_faq_content_source',
            ['pro_faq_content_source']
        );
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
        return 'https://doc.topperpack.com/docs/service-widgets/faq/';
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
        return 'https://topperpack.com/assets/widgets/faq-widget/';
    }
    /**
     * Register Faq Widget 1 widget controls.
     *
     * Add input fields to allow the user to customize the widget settings.
     *
     * @since 1.0.0
     * @access protected
     */
    protected function register_controls() {
        $base_url = $this->get_custom_image_url();
        // <========================> topppa FAQ OPTIONS <========================>
        $this->start_controls_section(
            'topppa_service_style',
            [
                'label' => esc_html__('Faq Styles', 'topper-pack'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_control(
            'topppa_faq_styles',
            [
                'label' => esc_html__('Choose Style', 'topper-pack'),
                'type' => TopperPack_Controls_Manager::IMAGECHOOSE,
                'default' => '',
                'options' => [
                    '' => [
                        'title' => esc_html__('Style 1', 'topper-pack'),
                        'imagelarge' => $base_url . 'faq1.jpg',
                        'imagesmall' => $base_url . 'faq1.jpg',
                        'width' => '100%',
                    ],
                    'style_two' => [
                        'title' => esc_html__('Style 2', 'topper-pack'),
                        'imagelarge' => $base_url . 'faq2.jpg',
                        'imagesmall' => $base_url . 'faq2.jpg',
                        'width' => '100%',
                    ],
                    'style_three' => [
                        'title' => esc_html__('Style 3', 'topper-pack'),
                        'imagelarge' => $base_url . 'faq3.jpg',
                        'imagesmall' => $base_url . 'faq3.jpg',
                        'width' => '100%',
                    ],
                    'style_four' => [
                        'title' => esc_html__('Style 4', 'topper-pack'),
                        'imagelarge' => $base_url . 'faq4.jpg',
                        'imagesmall' => $base_url . 'faq4.jpg',
                        'width' => '100%',
                    ],
                ],
            ]
        );
        $this->end_controls_section();
        $this->start_controls_section(
            'topppa_faq_options',
            [
                'label' => esc_html__('topppa Faq', 'topper-pack'),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'text_type',
            [
                'label' => esc_html__('Text Type', 'topper-pack'),
                'type'    => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'text' => [
                        'title' => esc_html__('Text', 'topper-pack'),
                        'icon' => 'eicon-number-field',
                    ],
                    'icon' => [
                        'title' => esc_html__('Icon', 'topper-pack'),
                        'icon' => 'eicon-info-circle',
                    ],
                ],
                'default' => 'text',
            ]
        );

        $repeater->add_control(
            'icon',
            [
                'label' => esc_html__('Icon', 'topper-pack'),
                'type'    => \Elementor\Controls_Manager::ICONS,
                'condition' => [
                    'text_type' => 'icon',
                ],
            ]
        );

        $repeater->add_control(
            'number',
            [
                'label'       => esc_html__('Number', 'topper-pack'),
                'type'          => \Elementor\Controls_Manager::TEXT,
                'condition'   => [
                    'text_type' => 'text',
                ],
            ]
        );
        $repeater->add_control(
            'faq_active',
            [
                'label'        => esc_html__('Active FAQ', 'topper-pack'),
                'type'         => \Elementor\Controls_Manager::SWITCHER,
                'label_on'     => esc_html__('Show', 'topper-pack'),
                'label_off'    => esc_html__('Hide', 'topper-pack'),
                'return_value' => 'yes',
                'default'      => 'no',
            ]
        );
        $repeater->add_control(
            'faq_title',
            [
                'label'       => esc_html__('Title', 'topper-pack'),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => esc_html__('How much time do I need to volunteer?', 'topper-pack'),
                'label_block' => true,
            ]
        );
        $this->topppa_faq_content_source_control($repeater);

        $repeater->add_control(
            'more_options',
            [
                'type'      => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
                'condition' => [
                    'topppa_faq_content_source' => 'custom',
                ],
            ]
        );
        $repeater->add_control(
            'style_type',
            [
                'label' => esc_html__('Text Type', 'topper-pack'),
                'type'    => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'des' => [
                        'title' => esc_html__('Text', 'topper-pack'),
                        'icon' => 'eicon-animation-text',
                    ],
                    'img' => [
                        'title' => esc_html__('Image', 'topper-pack'),
                        'icon' => 'eicon-image-rollover',
                    ],
                ],
                'default' => 'des',
                'condition' => [
                    'topppa_faq_content_source' => 'custom',
                ],
            ]
        );
        $repeater->add_control(
            'faq_content',
            [
                'label'      => esc_html__('Content', 'topper-pack'),
                'type'       => \Elementor\Controls_Manager::WYSIWYG,
                'show_label' => false,
                'condition'   => [
                    'topppa_faq_content_source' => 'custom',
                    'style_type' => 'des',
                ],
            ]
        );
        $repeater->add_control(
            'faq_image',
            [
                'label' => esc_html__('Choose Image', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'condition' => [
                    'topppa_faq_content_source' => 'custom',
                    'style_type' => 'img',
                ],
            ]
        );
        $this->add_control(
            'faqs',
            [
                'label'          => esc_html__('FAQ List', 'topper-pack'),
                'type'           => \Elementor\Controls_Manager::REPEATER,
                'fields'         => $repeater->get_controls(),
                'default'        => [
                    [
                        'faq_active'  => 'yes',
                        'faq_title'   => esc_html__('What Is The Design Process For Branding?', 'topper-pack'),
                        'topppa_faq_content_source' => 'custom',
                        'faq_content' => esc_html__('Progressively communicate flexible human capital with best-of-breed schemas. Completely develop 2.0 infrastructures via bleeding-edge opportunities. Completely initiate world-class leadership skills via fully tested applications. Objectively seize dynamic e-services and accurate markets.', 'topper-pack'),
                    ],
                    [
                        'faq_active'  => 'no',
                        'faq_title'   => esc_html__('How Much Does Logo Design Services Cost?', 'topper-pack'),
                        'topppa_faq_content_source' => 'custom',
                        'faq_content' => esc_html__('Progressively communicate flexible human capital with best-of-breed schemas. Completely develop 2.0 infrastructures via bleeding-edge opportunities. Completely initiate world-class leadership skills via fully tested applications. Objectively seize dynamic e-services and accurate markets.', 'topper-pack'),
                    ],
                    [
                        'faq_active'  => 'no',
                        'faq_title'   => esc_html__('How Long Will It Take To Complete My Project?', 'topper-pack'),
                        'topppa_faq_content_source' => 'custom',
                        'faq_content' => esc_html__('Progressively communicate flexible human capital with best-of-breed schemas. Completely develop 2.0 infrastructures via bleeding-edge opportunities. Completely initiate world-class leadership skills via fully tested applications. Objectively seize dynamic e-services and accurate markets.', 'topper-pack'),
                    ],
                    [
                        'faq_active'  => 'no',
                        'faq_title'   => esc_html__('What Is Included In A Round Of Revisions?', 'topper-pack'),
                        'topppa_faq_content_source' => 'custom',
                        'faq_content' => esc_html__('Progressively communicate flexible human capital with best-of-breed schemas. Completely develop 2.0 infrastructures via bleeding-edge opportunities. Completely initiate world-class leadership skills via fully tested applications. Objectively seize dynamic e-services and accurate markets.', 'topper-pack'),
                    ],
                ],
                'title_field' => '{{{ faq_title }}}',
            ]
        );
        $this->end_controls_section();

        // <========================> topppa FAQ STYLES <========================>
        $this->start_controls_section(
            'topppa_faq_style',
            [
                'label' => esc_html__('Faq Style', 'topper-pack'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'faq_css_title_box_background',
                'types' => ['classic', 'gradient', 'video'],
                'selector' => '{{WRAPPER}} .faq-accordion .accordion-item',
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name'     => 'faq_css_title_box_border',
                'label'    => esc_html__('Border', 'topper-pack'),
                'selector' => '{{WRAPPER}} .faq-accordion .accordion-item',
            ]
        );

        $this->add_responsive_control(
            'faq_css_title_box_radius',
            [
                'label'      => esc_html__('Border Radius', 'topper-pack'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .faq-accordion .accordion-item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'faq_css_title_box_shoadow',
                'label'    => esc_html__('Shadow', 'topper-pack'),
                'selector' => '{{WRAPPER}} .faq-accordion .accordion-item',
            ]
        );
        // multiple shadow
        $this->add_control(
            'enable_double_shadow',
            [
                'label'        => esc_html__('Enable Double Shadow', 'topper-pack'),
                'type'         => \Elementor\Controls_Manager::SWITCHER,
                'label_on'     => esc_html__('Yes', 'topper-pack'),
                'label_off'    => esc_html__('No', 'topper-pack'),
                'return_value' => 'yes',
                'default'      => 'no',
            ]
        );

        // Shadow #1
        $this->add_control(
            'shadow1',
            [
                'label'     => esc_html__('Shadow 1', 'topper-pack'),
                'type'      => \Elementor\Controls_Manager::BOX_SHADOW,
                'condition' => [
                    'enable_double_shadow' => 'yes',
                ],
                'selectors' => [],
            ]
        );

        // Shadow #2
        $this->add_control(
            'shadow2',
            [
                'label'     => esc_html__('Shadow 2', 'topper-pack'),
                'type'      => \Elementor\Controls_Manager::BOX_SHADOW,
                'condition' => [
                    'enable_double_shadow' => 'yes',
                ],
                'selectors' => [],
            ]
        );
        $this->add_responsive_control(
            'faq_css_title_margin',
            [
                'label'      => esc_html__('Margin', 'topper-pack'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .faq-accordion .accordion-item' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->start_controls_tabs(
            'content_tabs'
        );

        $this->start_controls_tab(
            'style_title_tab',
            [
                'label' => esc_html__('Title', 'topper-pack'),
            ]
        );
        $this->add_responsive_control(
            'gap_control',
            [
                'label'      => esc_html__('Gap Option', 'topper-pack'),
                'type'       =>  \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['%', 'px'], // Set '%' as the first unit
                'range'      => [
                    '%' => [
                        'min'  => 0,
                        'max'  => 100,
                        'step' => 1,
                    ],
                ],
                'default'    => [
                    'unit' => 'px', // Set default unit to '%'
                ],
                'selectors'  => [
                    '{{WRAPPER}} .faq-accordion .accordion-button span' => 'margin-right: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'faq_css_title_typo',
                'label'    => esc_html__('Typography', 'topper-pack'),
                'selector' => '{{WRAPPER}} .faq-accordion .accordion-button',
            ]
        );
        $this->add_responsive_control(
            'faq_css_title_color',
            [
                'label'     => esc_html__('Title Color', 'topper-pack'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .faq-accordion .accordion-button' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_responsive_control(
            'faq_css_number_color',
            [
                'label'     => esc_html__('Number Color', 'topper-pack'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .faq-accordion .accordion-button span' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'faq_css_title_background',
                'types' => ['classic', 'gradient', 'video'],
                'selector' => '{{WRAPPER}} .faq-accordion .accordion-button',
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name'     => 'faq_css_title_border',
                'label'    => esc_html__('Border', 'topper-pack'),
                'selector' => '{{WRAPPER}} .faq-accordion .accordion-button',
            ]
        );
        $this->add_responsive_control(
            'faq_css_title_radius',
            [
                'label'      => esc_html__('Border Radius', 'topper-pack'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .faq-accordion .accordion-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'faq_css_title_shoadow',
                'label'    => esc_html__('Shadow', 'topper-pack'),
                'selector' => '{{WRAPPER}} .faq-accordion .accordion-button',
            ]
        );
        $this->end_controls_tab();
        $this->start_controls_tab(
            'style_hover_tab',
            [
                'label' => esc_html__('Active', 'topper-pack'),
            ]
        );
        $this->add_responsive_control(
            'active_color',
            [
                'label' => esc_html__('Text Color', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .accordion-header .accordion-button:not(.collapsed)' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_responsive_control(
            'faq_active_css_number_color',
            [
                'label'     => esc_html__('Number Color', 'topper-pack'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .accordion-header .accordion-button:not(.collapsed) span' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'faq_css_box_bg_active',
                'types' => ['classic', 'gradient', 'video'],
                'selector' => '{{WRAPPER}} .accordion-header .accordion-button:not(.collapsed)',
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'faq_css_box_border',
                'selector' => '{{WRAPPER}} .accordion-header .accordion-button:not(.collapsed)',
            ]
        );
        $this->add_responsive_control(
            'faq_css_box_border_radius',
            [
                'label' => esc_html__('Border Radius', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .accordion-header .accordion-button:not(.collapsed)' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'after_border_width',
            [
                'label'      => esc_html__('Border Width', 'topper-pack'),
                'type'       => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['%', 'px'], // Set '%' as the first unit
                'range'      => [
                    '%' => [
                        'min'  => 0,
                        'max'  => 100,
                        'step' => 1,
                    ],
                ],
                'default'    => [
                    'unit' => '%', // Set default unit to '%'
                ],
                'selectors'  => [
                    '{{WRAPPER}} .accordion-header .accordion-button:not(.collapsed):before' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'after_border_color',
            [
                'label'     => esc_html__('Border Color', 'topper-pack'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .accordion-header .accordion-button:not(.collapsed):before' => 'background-color: {{VALUE}}',
                ],
            ]
        );
        $this->add_responsive_control(
            'after__margin',
            [
                'label' => esc_html__('Active Margin', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} .accordion-header .accordion-button:not(.collapsed)' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'after__padding',
            [
                'label' => esc_html__('Active Padding', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} .accordion-header .accordion-button:not(.collapsed)' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->add_responsive_control(
            'faq_css_title_padding',
            [
                'label'      => esc_html__('Padding', 'topper-pack'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .faq-accordion .accordion-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        // ===================================================
        $this->start_controls_tabs(
            'description_tabs'
        );

        $this->start_controls_tab(
            'style_description_tab',
            [
                'label' => esc_html__('Description', 'topper-pack'),
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
                    '{{WRAPPER}} .faq-accordion .accordion-body img' => 'height: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'topppa_faq_styles' => 'style_three',
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
                    '{{WRAPPER}} .faq-accordion .accordion-body img' => 'width: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'topppa_faq_styles' => 'style_three',
                ],
            ]
        );
        $this->add_responsive_control(
            'img_object',
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
                    '{{WRAPPER}} .faq-accordion .accordion-body img' => 'object-fit: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'faq_css_dec_typo',
                'label'    => esc_html__('Typography', 'topper-pack'),
                'selector' => '{{WRAPPER}} .faq-accordion .accordion-body',
            ]
        );
        $this->add_responsive_control(
            'faq_css_dec_color',
            [
                'label'     => esc_html__('Color', 'topper-pack'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .faq-accordion .accordion-body' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'body_bg_color',
                'types' => ['classic', 'gradient', 'video'],
                'selector' => '{{WRAPPER}} .faq-accordion .accordion-body',
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name'     => 'body_border',
                'label'    => esc_html__('Border', 'topper-pack'),
                'selector' => '{{WRAPPER}} .faq-accordion .accordion-body',
            ]
        );
        $this->add_responsive_control(
            'body_border_radius',
            [
                'label' => esc_html__('Border Radius', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .faq-accordion .accordion-body' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .faq-accordion .accordion-body img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'faq_css_dec_margin',
            [
                'label'      => esc_html__('Margin', 'topper-pack'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .faq-accordion .accordion-body' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'faq_css_dec_padding',
            [
                'label'      => esc_html__('Padding', 'topper-pack'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .faq-accordion .accordion-body' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();

        // <==========>
        // <==========> TITLE STYLES <==========>

        $this->start_controls_section(
            'count_styles',
            [
                'label' => esc_html__('Number Count', 'topper-pack'),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_responsive_control(
            'position_Y',
            [
                'label' => esc_html__('Position Y', 'topper-pack'),
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
                    '{{WRAPPER}} .faq-accordion .accordion-button span' => 'bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'count_typo',
                'selector' => '{{WRAPPER}} .faq-accordion .accordion-button span',
            ]
        );
        $this->add_responsive_control(
            'count_color',
            [
                'label'     => esc_html__('Color', 'topper-pack'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .faq-accordion .accordion-button span' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_responsive_control(
            'count_margin',
            [
                'label'      => esc_html__('Margin', 'topper-pack'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .faq-accordion .accordion-button span' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'count_padding',
            [
                'label'      => esc_html__('Padding', 'topper-pack'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .faq-accordion .accordion-button span' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();

        $this->start_controls_section(
            'icon_css',
            [
                'label' => __('Icon Style', 'topper-pack'),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'icon_typo',
                'label'    => esc_html__('Typography', 'topper-pack'),
                'selector' => '{{WRAPPER}} .faq-accordion .accordion-button::after',
            ]
        );
        $this->add_responsive_control(
            'icon_height',
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
                'selectors'  => [
                    '{{WRAPPER}} .accordion-header .accordion-button:after' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'icon_width',
            [
                'label'      => esc_html__('width', 'topper-pack'),
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
                'selectors'  => [
                    '{{WRAPPER}} .accordion-header .accordion-button:after' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->start_controls_tabs(
            'icon_tabs'
        );

        $this->start_controls_tab(
            'normal_icon_tab',
            [
                'label' => esc_html__('Normal', 'topper-pack'),
            ]
        );
        $this->add_responsive_control(
            'icon_color',
            [
                'label'     => esc_html__('Color', 'topper-pack'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .faq-accordion .accordion-button::after' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'background',
                'types' => ['classic', 'gradient', 'video'],
                'selector' => '{{WRAPPER}} .faq-accordion .accordion-button::after',
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'border',
                'selector' => '{{WRAPPER}} .faq-accordion .accordion-button::after',
            ]
        );
        $this->add_responsive_control(
            'border_radius',
            [
                'label' => esc_html__('Border Radius', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .faq-accordion .accordion-button::after' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_tab();

        $this->start_controls_tab(
            'active_icon_tab',
            [
                'label' => esc_html__('Active', 'topper-pack'),
            ]
        );
        $this->add_responsive_control(
            'icon_color_active',
            [
                'label'     => esc_html__('Icon Active Color', 'topper-pack'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .accordion-header .accordion-button:not(.collapsed)::after' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'active_icon_background',
                'types' => ['classic', 'gradient', 'video'],
                'selector' => '{{WRAPPER}} .accordion-header .accordion-button:not(.collapsed)::after',
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'active_icon_border',
                'selector' => '{{WRAPPER}} .accordion-header .accordion-button:not(.collapsed)::after',
            ]
        );
        $this->add_responsive_control(
            'active_icon_border_radius',
            [
                'label' => esc_html__('Border Radius', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .accordion-header .accordion-button:not(.collapsed)::after' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->add_responsive_control(
            'faq_icon_margin',
            [
                'label'      => esc_html__('Margin', 'topper-pack'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .accordion-header .accordion-button:after' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'faq_icon_padding',
            [
                'label'      => esc_html__('Padding', 'topper-pack'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .accordion-header .accordion-button:after' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();
    }

    /**
     * Render faq widget output on the frontend.
     *
     * Written in PHP and used to generate the final HTML.
     *
     * @since 1.0.0
     * @access protected
     */
    protected function render() {
        $settings = $this->get_settings_for_display();
        $rand = wp_rand(1111, 9999);
        $allowed_html = array(
            'span'  => array('style' => array()),
            'a'     => array(
                'href'   => array(),
                'target' => array(),
                'title'  => array(),
                'rel'    => array(),
            ),
            'strong' => array(),
            'small'  => array(),
            'i'      => array(),
            'br'     => array(),
        );
        // multiple shadow
        if ('yes' === $settings['enable_double_shadow']) {

            $shadow1 = $settings['shadow1'];
            $shadow2 = $settings['shadow2'];

            $css_shadow1 = "{$shadow1['horizontal']}px {$shadow1['vertical']}px {$shadow1['blur']}px {$shadow1['spread']}px {$shadow1['color']}";
            $css_shadow2 = "{$shadow2['horizontal']}px {$shadow2['vertical']}px {$shadow2['blur']}px {$shadow2['spread']}px {$shadow2['color']}";

            $box_shadow = $css_shadow1 . ', ' . $css_shadow2;
        } else {
            $box_shadow = 'none';
        }

        if (!isset($settings['faqs']) || !is_array($settings['faqs'])) {
            return;
        }
        $faq_style = '';
        if ($settings['topppa_faq_styles'] === 'style_two') {
            $faq_style = 'faq2';
        } elseif ($settings['topppa_faq_styles'] === 'style_three') {
            $faq_style = 'faq3';
        } elseif ($settings['topppa_faq_styles'] === 'style_four') {
            $faq_style = 'faq4';
        }
?>
        <div class="topppa-faq-wrapper">
            <div class="accordion faq-accordion <?php echo esc_attr($faq_style); ?>" id="topppa-faq-accordion-<?php echo esc_attr($rand); ?>">
                <?php $count = 0;
                foreach ($settings['faqs'] as $item): $count++;
                    $active = ($item['faq_active'] === 'yes') ? '' : 'collapsed';
                    $show = ($item['faq_active'] === 'yes') ? 'show' : '';
                    $aria_expanded = ($active === 'collapsed') ? 'false' : 'true';
                ?>
                    <div class="accordion-item" style="box-shadow: <?php echo esc_attr($box_shadow); ?>;">
                        <h5 class="accordion-header" id="topppa-faq-<?php echo esc_attr($rand . $count) ?>">
                            <button class="accordion-button <?php echo esc_attr($active); ?>" type="button"
                                data-bs-toggle="collapse"
                                data-bs-target="#topppa-faq-item-<?php echo esc_attr($rand . $count) ?>"
                                aria-expanded="<?php echo esc_attr($aria_expanded); ?>"
                                aria-controls="topppa-faq-item-<?php echo esc_attr($rand . $count) ?>">
                                <?php if (!empty($item['text_type']) && $item['text_type'] === 'icon' && !empty($item['icon']['value'])) : ?>
                                    <span>
                                        <?php \Elementor\Icons_Manager::render_icon($item['icon'], ['aria-hidden' => 'true']); ?>
                                    </span>
                                <?php elseif (!empty($item['text_type']) && $item['text_type'] === 'text' && !empty($item['number'])) : ?>
                                    <span>
                                        <?php echo esc_html($item['number']); ?>
                                    </span>
                                <?php endif; ?>

                                <?php echo wp_kses($item['faq_title'], $allowed_html); ?>
                            </button>
                        </h5>
                        <div id="topppa-faq-item-<?php echo esc_attr($rand . $count) ?>"
                            class="accordion-collapse collapse <?php echo esc_attr($show); ?>"
                            aria-labelledby="topppa-faq-item-<?php echo esc_attr($rand . $count) ?>"
                            data-bs-parent="#topppa-faq-accordion-<?php echo esc_attr($rand); ?>">
                            <div class="accordion-body">
                                <?php
                                if (topppa_can_use_premium_features() && 'elementor' === ($item['topppa_faq_content_source'] ?? 'custom') && !empty($item['template_id'])) {
                                    echo \Elementor\Plugin::instance()->frontend->get_builder_content_for_display($item['template_id']); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- Already escaped by elementor
                                } else {
                                    if (!empty($item['style_type']) && $item['style_type'] === 'des') {
                                        echo wp_kses($item['faq_content'], $allowed_html);
                                    } elseif (!empty($item['style_type']) && $item['style_type'] === 'img' && !empty($item['faq_image'])) {
                                        echo wp_get_attachment_image($item['faq_image']['id'], 'full');
                                    }
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
<?php
    }
}
