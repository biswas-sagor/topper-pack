<?php
use \TopperPack\Includes\Controls\Controls_Manager as TopperPack_Controls_Manager;
use \Elementor\Controls_Manager;
use \Elementor\Widget_Base;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

/**
 * Elementor Product Description Widget.
 *
 * A widget that displays the short or long description of a single product.
 *
 * @since 1.0.0
 */
class TOPPPA_Product_Description_Widget extends Widget_Base {

    /**
     * Get widget name.
     *
     * Retrieve the widget name.
     *
     * @since 1.0.0
     * @access public
     * @return string Widget name.
     */
    public function get_name() {
        return 'topppa_product_description';
    }

    /**
     * Get widget title.
     *
     * Retrieve the widget title.
     *
     * @since 1.0.0
     * @access public
     * @return string Widget title.
     */
    public function get_title() {
        return TOPPPA_EPWB . esc_html__('Product Description', 'topper-pack');
    }

    /**
     * Get widget icon.
     *
     * Retrieve the widget icon.
     *
     * @since 1.0.0
     * @access public
     * @return string Widget icon.
     */
    public function get_icon() {
        return 'eicon-product-description';
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
        return ['product', 'description', 'short description', 'long description', 'woocommerce', 'topppa', 'topperpack'];
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
		return 'https://doc.topperpack.com/docs/woocommerce-widgets/product-description/';
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
        // Content Section
        $this->start_controls_section(
            'content_section',
            [
                'label' => esc_html__('Settings', 'topper-pack'),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        // Switch to Use Specific Product
        $this->add_control(
            'use_specific_product',
            [
                'label'        => esc_html__('Use Specific Product?', 'topper-pack'),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => esc_html__('Yes', 'topper-pack'),
                'label_off'    => esc_html__('No', 'topper-pack'),
                'return_value' => 'yes',
                'default'      => 'no',
            ]
        );

        // Select Product (Conditional)
        $this->add_control(
            'selected_product',
            [
                'label'       => esc_html__('Select Product', 'topper-pack'),
                'type'        => Controls_Manager::SELECT2,
                'label_block' => true,
                'options'     => $this->get_all_products(),
                'default'     => '',
                'condition'   => [
                    'use_specific_product' => 'yes',
                ],
                'description' => esc_html__('Select a specific product to display its description.', 'topper-pack'),
            ]
        );

        // Switch for Description Type
        $this->add_control(
            'description_type',
            [
                'label'   => esc_html__('Description Type', 'topper-pack'),
                'type'    => Controls_Manager::SELECT,
                'default' => 'short',
                'options' => [
                    'short' => esc_html__('Short Description', 'topper-pack'),
                    'long'  => esc_html__('Long Description', 'topper-pack'),
                ],
            ]
        );

        // Post Content Type
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

        // Post Content Length
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

        // Dot Symbol
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

        // Note for Editor
        $this->add_control(
            'note',
            [
                'label' => esc_html__('This Default Content is for the Elementor Editor for easy to edit the style.', 'topper-pack'),
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
                    '{{WRAPPER}} .topppa-product-description,{{WRAPPER}} .topppa-product-description p' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'content_typography',
                'selector' => '{{WRAPPER}} .topppa-product-description,{{WRAPPER}} .topppa-product-description p',
            ]
        );
        $this->add_responsive_control(
            'plink_color',
            [
                'label' => esc_html__('Link Color', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .topppa-product-description a' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_responsive_control(
            'plink_hover_color',
            [
                'label' => esc_html__('Link Hover Color', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .topppa-product-description a:hover' => 'color: {{VALUE}}',
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
                    '{{WRAPPER}} .topppa-product-description' => 'text-align: {{VALUE}};',
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
                    '{{WRAPPER}} .topppa-product-description p' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                    '{{WRAPPER}} .topppa-product-description p' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                'selector' => '{{WRAPPER}} .topppa-product-description h2',
            ]
        );
        $this->add_responsive_control(
            'h2_color',
            [
                'label' => esc_html__('H2 Color', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .topppa-product-description h2' => 'color: {{VALUE}}',
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
                    '{{WRAPPER}} .topppa-product-description h2' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                    '{{WRAPPER}} .topppa-product-description h2' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                'selector' => '{{WRAPPER}} .topppa-product-description h3',
            ]
        );
        $this->add_responsive_control(
            'h3_color',
            [
                'label' => esc_html__('H3 Color', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .topppa-product-description h3' => 'color: {{VALUE}}',
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
                    '{{WRAPPER}} .topppa-product-description h3' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                    '{{WRAPPER}} .topppa-product-description h3' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                'selector' => '{{WRAPPER}} .topppa-product-description h4',
            ]
        );
        $this->add_responsive_control(
            'h4_color',
            [
                'label' => esc_html__('H4 Color', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .topppa-product-description h4' => 'color: {{VALUE}}',
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
                    '{{WRAPPER}} .topppa-product-description h4' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                    '{{WRAPPER}} .topppa-product-description h4' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                'selector' => '{{WRAPPER}} .topppa-product-description h5',
            ]
        );
        $this->add_responsive_control(
            'h5_color',
            [
                'label' => esc_html__('H5 Color', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .topppa-product-description h5' => 'color: {{VALUE}}',
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
                    '{{WRAPPER}} .topppa-product-description h5' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                    '{{WRAPPER}} .topppa-product-description h5' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                'selector' => '{{WRAPPER}} .topppa-product-description h6',
            ]
        );
        $this->add_responsive_control(
            'h6_color',
            [
                'label' => esc_html__('H6 Color', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .topppa-product-description h6' => 'color: {{VALUE}}',
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
                    '{{WRAPPER}} .topppa-product-description h6' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                'selector' => '{{WRAPPER}} .topppa-product-description ul li, {{WRAPPER}} .topppa-product-description ol li',
            ]
        );

        $this->add_control(
            'list_color',
            [
                'label' => esc_html__('List Text Color', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .topppa-product-description ul li, {{WRAPPER}} .topppa-product-description ol li' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'list_marker_color',
            [
                'label' => esc_html__('List Marker Color', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .topppa-product-description ul li::marker' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .topppa-product-description ol li::marker' => 'color: {{VALUE}}',
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
                    '{{WRAPPER}} .topppa-product-description ul, {{WRAPPER}} .topppa-product-description ol' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                    '{{WRAPPER}} .topppa-product-description ul li:not(:last-child), {{WRAPPER}} .topppa-product-description ol li:not(:last-child)' => 'margin-bottom: {{SIZE}}{{UNIT}};',
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
                    '{{WRAPPER}} .topppa-product-description a' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'link_typography',
                'selector' => '{{WRAPPER}} .topppa-product-description a',
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
                    '{{WRAPPER}} .topppa-product-description a' => 'text-decoration: {{VALUE}}',
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
                    '{{WRAPPER}} .topppa-product-description a:hover' => 'color: {{VALUE}}',
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
                    '{{WRAPPER}} .topppa-product-description a:hover' => 'text-decoration: {{VALUE}}',
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
                'selector' => '{{WRAPPER}} .topppa-product-description table td, {{WRAPPER}} .topppa-product-description table th',
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
                    '{{WRAPPER}} .topppa-product-description table th' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'table_header_bg_color',
            [
                'label' => esc_html__('Header Background', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .topppa-product-description table th' => 'background-color: {{VALUE}};',
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
                    '{{WRAPPER}} .topppa-product-description table td' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'table_cell_bg_color',
            [
                'label' => esc_html__('Cell Background', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .topppa-product-description table td' => 'background-color: {{VALUE}};',
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
                'selector' => '{{WRAPPER}} .topppa-product-description table, {{WRAPPER}} .topppa-product-description th, {{WRAPPER}} .topppa-product-description td',
            ]
        );

        $this->add_responsive_control(
            'table_padding',
            [
                'label' => esc_html__('Cell Padding', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .topppa-product-description th, {{WRAPPER}} .topppa-product-description td' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                'selector' => '{{WRAPPER}} .topppa-product-description blockquote',
            ]
        );

        $this->add_control(
            'blockquote_text_color',
            [
                'label' => esc_html__('Text Color', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .topppa-product-description blockquote' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'blockquote_border_color',
            [
                'label' => esc_html__('Border Color', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .topppa-product-description blockquote' => 'border-left-color: {{VALUE}};',
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
                    '{{WRAPPER}} .topppa-product-description blockquote' => 'border-left-width: {{SIZE}}{{UNIT}};',
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
                    '{{WRAPPER}} .topppa-product-description blockquote' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                    '{{WRAPPER}} .topppa-product-description blockquote' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'blockquote_background',
                'types' => ['classic', 'gradient', 'video'],
                'selector' => '{{WRAPPER}} .topppa-product-description blockquote',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'blockquote_shadow',
                'selector' => '{{WRAPPER}} .topppa-product-description blockquote',
            ]
        );

        $this->end_controls_section();
    }

    /**
     * Get all products.
     *
     * Retrieve all WooCommerce products for selection in the widget controls.
     *
     * @since 1.0.0
     * @access protected
     * @return array Product options.
     */
    protected function get_all_products() {
        $products = get_posts(['post_type' => 'product', 'numberposts' => -1]);
        $options  = [];
        if (!is_wp_error($products)) {
            foreach ($products as $product) {
                $options[$product->ID] = $product->post_title;
            }
        }
        return $options;
    }

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

        // Check if WooCommerce is active
        if (!class_exists('WooCommerce')) {
            echo '<div class="elementor-alert elementor-alert-warning">';
            echo esc_html__('WooCommerce is not installed. Please install and activate WooCommerce to use this widget.', 'topper-pack');
            echo '</div>';
            return;
        }

        // Check if we're in theme builder
        $is_theme_builder = \Elementor\Plugin::$instance->editor->is_edit_mode();

        // Get the product ID
        $product_id = '';
        if ($settings['use_specific_product'] === 'yes') {
            $product_id = $settings['selected_product']; // Use selected product
        } elseif (is_product() && !$is_theme_builder) {
            $product_id = get_the_ID(); // Use current product
        }

        // If still no product ID and not in theme builder, show a warning
        if (!$product_id && !$is_theme_builder) {
            echo '<div class="elementor-alert elementor-alert-warning">';
            echo esc_html__('No product selected or no product found on this page.', 'topper-pack');
            echo '</div>';
            return;
        }

        echo '<div class="topppa-product-description">';

        if ($is_theme_builder) {
            // Show dummy content in theme builder
            if ($settings['description_type'] === 'short') {
                echo '<p>' . esc_html__('This is a sample short description for the product. It provides a brief overview of the product features and benefits. Perfect for quick product introductions.', 'topper-pack') . '</p>';
                echo '<p>' . esc_html__('Key features include:', 'topper-pack') . '</p>';
                echo '<ul>';
                echo '<li>' . esc_html__('High-quality materials', 'topper-pack') . '</li>';
                echo '<li>' . esc_html__('Easy to use', 'topper-pack') . '</li>';
                echo '<li>' . esc_html__('Durable construction', 'topper-pack') . '</li>';
                echo '<li>' . esc_html__('Modern design', 'topper-pack') . '</li>';
                echo '</ul>';
            } else {
                // Long description with more formatting examples
                echo '<h2>' . esc_html__('Product Overview', 'topper-pack') . '</h2>';
                echo '<p>' . esc_html__('This is a sample long description that demonstrates how your product description will look. It includes various formatting options and styling possibilities.', 'topper-pack') . '</p>';

                echo '<h3>' . esc_html__('Key Features', 'topper-pack') . '</h3>';
                echo '<ul>';
                echo '<li>' . esc_html__('Premium quality materials for lasting durability', 'topper-pack') . '</li>';
                echo '<li>' . esc_html__('Ergonomic design for maximum comfort', 'topper-pack') . '</li>';
                echo '<li>' . esc_html__('Advanced technology integration', 'topper-pack') . '</li>';
                echo '<li>' . esc_html__('Easy maintenance and cleaning', 'topper-pack') . '</li>';
                echo '</ul>';

                echo '<h3>' . esc_html__('Technical Specifications', 'topper-pack') . '</h3>';
                echo '<table>';
                echo '<tr><th>' . esc_html__('Feature', 'topper-pack') . '</th><th>' . esc_html__('Specification', 'topper-pack') . '</th></tr>';
                echo '<tr><td>' . esc_html__('Material', 'topper-pack') . '</td><td>' . esc_html__('Premium Grade', 'topper-pack') . '</td></tr>';
                echo '<tr><td>' . esc_html__('Dimensions', 'topper-pack') . '</td><td>' . esc_html__('10" x 5" x 2"', 'topper-pack') . '</td></tr>';
                echo '<tr><td>' . esc_html__('Weight', 'topper-pack') . '</td><td>' . esc_html__('2.5 lbs', 'topper-pack') . '</td></tr>';
                echo '</table>';

                echo '<h3>' . esc_html__('Care Instructions', 'topper-pack') . '</h3>';
                echo '<blockquote>';
                echo '<p>' . esc_html__('For optimal performance and longevity, follow these care instructions carefully. Regular maintenance will ensure your product remains in excellent condition.', 'topper-pack') . '</p>';
                echo '</blockquote>';

                echo '<h4>' . esc_html__('Warranty Information', 'topper-pack') . '</h4>';
                echo '<p>' . esc_html__('This product comes with a comprehensive warranty covering manufacturing defects and workmanship. Please refer to the warranty card for complete details.', 'topper-pack') . '</p>';

                echo '<h4>' . esc_html__('Additional Information', 'topper-pack') . '</h4>';
                echo '<p>' . esc_html__('For more information about this product, please visit our <a href="#">support page</a> or contact our customer service team.', 'topper-pack') . '</p>';
            }
        } else {
            // Get product object
            $product = wc_get_product($product_id);
            if (!$product) {
                echo '<div class="elementor-alert elementor-alert-warning">';
                echo esc_html__('Invalid product selected.', 'topper-pack');
                echo '</div>';
                return;
            }

            // Get the description based on the selected type
            $description_type = $settings['description_type'];
            $description = '';

            if ($description_type === 'short') {
                $description = $product->get_short_description(); // Get short description
            } else {
                $description = $product->get_description(); // Get long description
            }

            // Render the product description or a message if description is not available
            if (!empty($description)) {
                if ('excerpt' === $settings['post_content_type']) {
                    echo wp_kses_post(wp_trim_words($description, $settings['post_content_length'], $settings['dot_symbol']));
                } else {
                    echo wp_kses_post($description);
                }
            } else {
                echo '<div class="elementor-alert elementor-alert-info">';
                echo esc_html__('No description available for this product.', 'topper-pack');
                echo '</div>';
            }
        }

        echo '</div>';
    }
}