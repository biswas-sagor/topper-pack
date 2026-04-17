<?php
use \TopperPack\Includes\Controls\Controls_Manager as TopperPack_Controls_Manager;

if (! defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

/**
 * Elementor topppa Page Title Widget.
 *
 * Elementor widget that inserts an embbedable content into the page, from any given URL.
 *
 * @since 1.0.0
 */
class TOPPPA_Post_Content_Widget extends \Elementor\Widget_Base {

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
        return 'topppa_post_content';
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
        return TOPPPA_EPWB . esc_html__('Post Content', 'topper-pack');
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
        return 'eicon-post-content';
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
        return ['topppa', 'widget', 'content', 'post', 'topperpack'];
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
        return 'https://doc.topperpack.com/docs/general-widgets/post-content/';
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
            'page_title_options',
            [
                'label' => esc_html__('Post Content', 'topper-pack'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_control(
            'post_content_type',
            [
                'label' => esc_html__('Post Content Type', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'content',
                'options' => [
                    'excerpt' => esc_html__('Excerpt', 'topper-pack'),
                    'content'  => esc_html__('Content', 'topper-pack'),
                ],
            ]
        );
        $this->add_control(
            'post_content_length',
            [
                'label' => esc_html__('Post Content Length', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'min' => 1,
                'max' => 100,
                'step' => 1,
                'default' => 10,
                'condition' => [
                    'post_content_type' => 'excerpt',
                ],
            ]
        );
        $this->add_control(
            'dot_symbol',
            [
                'label' => esc_html__('Dot Symbol', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('...', 'topper-pack'),
                'condition' => [
                    'post_content_type' => 'excerpt',
                ],
            ]
        );
        $this->add_control(
            'note',
            [
                'label' => esc_html__( 'This Default Content is for the Elementor Editor for easy to edit the style.', 'topper-pack' ),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->end_controls_section();

        /**
         * start style section
         *
         * @since 1.0.0
         * @access protected
         */
        $this->start_controls_section(
            'content_style',
            [
                'label' => esc_html__('Content Style', 'topper-pack'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'content_color',
            [
                'label' => esc_html__('Content Color', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .topppa-post-content,{{WRAPPER}} .topppa-post-content p' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'content_typography',
                'selector' => '{{WRAPPER}} .topppa-post-content,{{WRAPPER}} .topppa-post-content p',
            ]
        );
        $this->add_responsive_control(
            'plink_color',
            [
                'label' => esc_html__('Link Color', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .topppa-post-content a' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_responsive_control(
            'plink_hover_color',
            [
                'label' => esc_html__('Link Hover Color', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .topppa-post-content a:hover' => 'color: {{VALUE}}',
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
                    '{{WRAPPER}} .topppa-post-content' => 'text-align: {{VALUE}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'p_margin',
            [
                'label' => esc_html__('Paragraph Margin', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} .topppa-post-content p' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'p_padding',
            [
                'label' => esc_html__('Paragraph Padding', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} .topppa-post-content p' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();

        $this->start_controls_section(
            'heading_style',
            [
                'label' => esc_html__('Heading Style', 'topper-pack'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'h2_note',
            [
                'label' => esc_html__('H2 Style', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'h2_typography',
                'selector' => '{{WRAPPER}} .topppa-post-content h2',
            ]
        );
        $this->add_responsive_control(
            'h2_color',
            [
                'label' => esc_html__('H2 Color', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .topppa-post-content h2' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_responsive_control(
            'h2_margin',
            [
                'label' => esc_html__('H2 Margin', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} .topppa-post-content h2' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'h2_padding',
            [
                'label' => esc_html__('H2 Padding', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} .topppa-post-content h2' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'h3_note',
            [
                'label' => esc_html__('H3 Style', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'h3_typography',
                'selector' => '{{WRAPPER}} .topppa-post-content h3',
            ]
        );
        $this->add_responsive_control(
            'h3_color',
            [
                'label' => esc_html__('H3 Color', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .topppa-post-content h3' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_responsive_control(
            'h3_margin',
            [
                'label' => esc_html__('H3 Margin', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} .topppa-post-content h3' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'h3_padding',
            [
                'label' => esc_html__('H3 Padding', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} .topppa-post-content h3' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'h4_note',
            [
                'label' => esc_html__('H4 Style', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'h4_typography',
                'selector' => '{{WRAPPER}} .topppa-post-content h4',
            ]
        );
        $this->add_responsive_control(
            'h4_color',
            [
                'label' => esc_html__('H4 Color', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .topppa-post-content h4' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_responsive_control(
            'h4_margin',
            [
                'label' => esc_html__('H4 Margin', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} .topppa-post-content h4' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'h4_padding',
            [
                'label' => esc_html__('H4 Padding', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} .topppa-post-content h4' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'h5_note',
            [
                'label' => esc_html__('H5 Style', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'h5_typography',
                'selector' => '{{WRAPPER}} .topppa-post-content h5',
            ]
        );
        $this->add_responsive_control(
            'h5_color',
            [
                'label' => esc_html__('H5 Color', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .topppa-post-content h5' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_responsive_control(
            'h5_margin',
            [
                'label' => esc_html__('H5 Margin', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} .topppa-post-content h5' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'h5_padding',
            [
                'label' => esc_html__('H5 Padding', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} .topppa-post-content h5' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'h6_note',
            [
                'label' => esc_html__('H6 Style', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'h6_typography',
                'selector' => '{{WRAPPER}} .topppa-post-content h6',
            ]
        );
        $this->add_responsive_control(
            'h6_color',
            [
                'label' => esc_html__('H6 Color', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .topppa-post-content h6' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_responsive_control(
            'h6_margin',
            [
                'label' => esc_html__('H6 Margin', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} .topppa-post-content h6' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();

        $this->start_controls_section(
            'list_style',
            [
                'label' => esc_html__('List Style', 'topper-pack'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'list_typography',
                'selector' => '{{WRAPPER}} .topppa-post-content ul li, {{WRAPPER}} .topppa-post-content ol li',
            ]
        );

        $this->add_control(
            'list_color',
            [
                'label' => esc_html__('List Text Color', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .topppa-post-content ul li, {{WRAPPER}} .topppa-post-content ol li' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'list_marker_color',
            [
                'label' => esc_html__('List Marker Color', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .topppa-post-content ul li::marker' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .topppa-post-content ol li::marker' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_responsive_control(
            'list_margin',
            [
                'label' => esc_html__('List Margin', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .topppa-post-content ul, {{WRAPPER}} .topppa-post-content ol' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'list_item_spacing',
            [
                'label' => esc_html__('List Item Spacing', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', 'em'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 50,
                    ],
                    'em' => [
                        'min' => 0,
                        'max' => 5,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .topppa-post-content ul li:not(:last-child), {{WRAPPER}} .topppa-post-content ol li:not(:last-child)' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        // Link Styles Section
        $this->start_controls_section(
            'link_style',
            [
                'label' => esc_html__('Link Style', 'topper-pack'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->start_controls_tabs('link_style_tabs');

        // Normal State
        $this->start_controls_tab(
            'link_style_normal',
            [
                'label' => esc_html__('Normal', 'topper-pack'),
            ]
        );

        $this->add_control(
            'link_color',
            [
                'label' => esc_html__('Link Color', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .topppa-post-content a' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'link_typography',
                'selector' => '{{WRAPPER}} .topppa-post-content a',
            ]
        );

        $this->add_control(
            'link_decoration',
            [
                'label' => esc_html__('Text Decoration', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'none',
                'options' => [
                    'none' => esc_html__('None', 'topper-pack'),
                    'underline' => esc_html__('Underline', 'topper-pack'),
                    'overline' => esc_html__('Overline', 'topper-pack'),
                    'line-through' => esc_html__('Line Through', 'topper-pack'),
                ],
                'selectors' => [
                    '{{WRAPPER}} .topppa-post-content a' => 'text-decoration: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_tab();

        // Hover State
        $this->start_controls_tab(
            'link_style_hover',
            [
                'label' => esc_html__('Hover', 'topper-pack'),
            ]
        );

        $this->add_control(
            'link_hover_color',
            [
                'label' => esc_html__('Link Hover Color', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .topppa-post-content a:hover' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'link_hover_decoration',
            [
                'label' => esc_html__('Hover Text Decoration', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'underline',
                'options' => [
                    'none' => esc_html__('None', 'topper-pack'),
                    'underline' => esc_html__('Underline', 'topper-pack'),
                    'overline' => esc_html__('Overline', 'topper-pack'),
                    'line-through' => esc_html__('Line Through', 'topper-pack'),
                ],
                'selectors' => [
                    '{{WRAPPER}} .topppa-post-content a:hover' => 'text-decoration: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

        // Add Table Style Section
        $this->start_controls_section(
            'table_style',
            [
                'label' => esc_html__('Table Style', 'topper-pack'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        // Table Typography
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'table_typography',
                'label' => esc_html__('Table Typography', 'topper-pack'),
                'selector' => '{{WRAPPER}} .topppa-post-content table td, {{WRAPPER}} .topppa-post-content table th',
            ]
        );

        // Table Header Style
        $this->add_control(
            'table_header_heading',
            [
                'label' => esc_html__('Table Header', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'table_header_color',
            [
                'label' => esc_html__('Header Text Color', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .topppa-post-content table th' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'table_header_bg_color',
            [
                'label' => esc_html__('Header Background', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .topppa-post-content table th' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        // Table Cell Style
        $this->add_control(
            'table_cell_heading',
            [
                'label' => esc_html__('Table Cells', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'table_cell_color',
            [
                'label' => esc_html__('Cell Text Color', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .topppa-post-content table td' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'table_cell_bg_color',
            [
                'label' => esc_html__('Cell Background', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .topppa-post-content table td' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        // Table Border
        $this->add_control(
            'table_border_heading',
            [
                'label' => esc_html__('Table Border', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'table_border',
                'label' => esc_html__('Border', 'topper-pack'),
                'selector' => '{{WRAPPER}} .topppa-post-content table, {{WRAPPER}} .topppa-post-content th, {{WRAPPER}} .topppa-post-content td',
            ]
        );

        $this->add_responsive_control(
            'table_padding',
            [
                'label' => esc_html__('Cell Padding', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .topppa-post-content th, {{WRAPPER}} .topppa-post-content td' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        // Add Blockquote Style Section
        $this->start_controls_section(
            'blockquote_style',
            [
                'label' => esc_html__('Blockquote Style', 'topper-pack'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'blockquote_typography',
                'selector' => '{{WRAPPER}} .topppa-post-content blockquote',
            ]
        );

        $this->add_control(
            'blockquote_text_color',
            [
                'label' => esc_html__('Text Color', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .topppa-post-content blockquote' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'blockquote_border_color',
            [
                'label' => esc_html__('Border Color', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .topppa-post-content blockquote' => 'border-left-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'blockquote_border_width',
            [
                'label' => esc_html__('Border Width', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 20,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .topppa-post-content blockquote' => 'border-left-width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'blockquote_padding',
            [
                'label' => esc_html__('Padding', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .topppa-post-content blockquote' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'blockquote_margin',
            [
                'label' => esc_html__('Margin', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .topppa-post-content blockquote' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'blockquote_background',
                'types' => ['classic', 'gradient', 'video'],
                'selector' => '{{WRAPPER}} .topppa-post-content blockquote',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'blockquote_shadow',
                'selector' => '{{WRAPPER}} .topppa-post-content blockquote',
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

        echo '<div class="topppa-post-content">';

        if (\Elementor\Plugin::$instance->editor->is_edit_mode()) {
            // Demo content only visible in Elementor editor
            if ('content' === $settings['post_content_type']) {
                echo '
                <h2>Welcome to Content Styling Guide H2</h2>
                <p>' . esc_html__('This is a sample content to help you style your post elements. All text here is only visible in the Elementor editor.', 'topper-pack') . '</p>

                <h3>'.esc_html__('Text Formatting Examples H3', 'topper-pack').'</h3>
                <p>'.esc_html__('Here are different text formats:', 'topper-pack').' <strong>'.esc_html__('Bold text', 'topper-pack').'</strong>, <em>'.esc_html__('Italic text', 'topper-pack').'</em>, and <a href="#">'.esc_html__('Clickable Link', 'topper-pack').'</a>. '.esc_html__('You can style each of these elements separately.', 'topper-pack').'</p>

                <h4>'.esc_html__('Lists and Bullet Points H4', 'topper-pack').'</h4>
                <ul>
                    <li>'.esc_html__('Unordered list item with', 'topper-pack').' <a href="#">'.esc_html__('link example', 'topper-pack').'</a></li>
                    <li>'.esc_html__('List item with', 'topper-pack').' <strong>'.esc_html__('bold text', 'topper-pack').'</strong> '.esc_html__('styling', 'topper-pack').'</li>
                    <li>'.esc_html__('List item with', 'topper-pack').' <em>'.esc_html__('italic emphasis', 'topper-pack').'</em></li>
                </ul>

                <ol>
                    <li>'.esc_html__('First ordered list item', 'topper-pack').'</li>
                    <li>'.esc_html__('Second ordered list item', 'topper-pack').'</li>
                    <li>'.esc_html__('Third ordered list item', 'topper-pack').'</li>
                </ol>

                <h5>'.esc_html__('Blockquote Example H5', 'topper-pack').'</h5>
                <blockquote>
                    <p>'.esc_html__('This is a blockquote example. You can style its borders, background, and typography.', 'topper-pack').'</p>
                </blockquote>

                <h6>'.esc_html__('Table Formatting H6', 'topper-pack').'</h6>
                <table>
                    <thead>
                        <tr>
                            <th>'.esc_html__('Header 1', 'topper-pack').'</th>
                            <th>'.esc_html__('Header 2', 'topper-pack').'</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>'.esc_html__('Row 1, Cell 1', 'topper-pack').'</td>
                            <td>'.esc_html__('Row 1, Cell 2', 'topper-pack').'</td>
                        </tr>
                        <tr>
                            <td>'.esc_html__('Row 2, Cell 1', 'topper-pack').'</td>
                            <td>'.esc_html__('Row 2, Cell 2', 'topper-pack').'</td>
                        </tr>
                    </tbody>
                </table>

                <p>'.esc_html__('Additional text elements include', 'topper-pack').' <code>'.esc_html__('inline code', 'topper-pack').'</code> '.esc_html__('and horizontal rules:', 'topper-pack').'</p>
                <hr>
                <p>'.esc_html__('The content above demonstrates common elements you might use in your posts.', 'topper-pack').'</p>';
            } else {
                echo '
                <p>'.esc_html__('This is a sample excerpt text. It helps you style how your post excerpts will appear. This text is only visible in the Elementor editor and will be replaced with your actual excerpt on the frontend.', 'topper-pack').'</p>
                <p>'.esc_html__('Excerpts can contain', 'topper-pack').' <strong>'.esc_html__('formatted text', 'topper-pack').'</strong> '.esc_html__('and', 'topper-pack').' <a href="#">'.esc_html__('links', 'topper-pack').'</a> '.esc_html__('as well.', 'topper-pack').'</p>';
            }
        } else {
            // Real content on frontend
            if ('excerpt' === $settings['post_content_type']) {
                echo wp_kses_post(wp_trim_words(get_the_content(), $settings['post_content_length'], $settings['dot_symbol']));
            } else {
                the_content();
            }
        }
        echo '</div>';
    }
}