<?php

use \TopperPack\Includes\Controls\Controls_Manager as TopperPack_Controls_Manager;
use \Elementor\Controls_Manager;
use \Elementor\Widget_Base;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

/**
 * Elementor Product Categories and Tags Widget.
 *
 * A widget that displays product categories and/or tags with separate controls for each.
 *
 * @since 1.0.0
 */
class TOPPPA_Product_Categories_Tags_Widget extends Widget_Base {

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
        return 'topppa_product_categories_tags';
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
        return TOPPPA_EPWB . esc_html__('Product Categories & Tags', 'topper-pack');
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
        return 'eicon-tags';
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
        return ['product', 'categories', 'tags', 'woocommerce', 'shop', 'topppa', 'topperpack'];
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
		return 'https://doc.topperpack.com/docs/woocommerce-widgets/product-category-tag/';
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
        // Content Section - Categories
        $this->start_controls_section(
            'categories_section',
            [
                'label' => esc_html__('Categories', 'topper-pack'),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );
        // Enable Categories
        $this->add_control(
            'enable_categories',
            [
                'label'        => esc_html__('Enable Categories', 'topper-pack'),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => esc_html__('Yes', 'topper-pack'),
                'label_off'    => esc_html__('No', 'topper-pack'),
                'return_value' => 'yes',
                'default'      => 'yes',
            ]
        );
        $this->add_control(
            'show_label',
            [
                'label' => esc_html__('Show Title', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', 'topper-pack'),
                'label_off' => esc_html__('Hide', 'topper-pack'),
                'return_value' => 'yes',
                'default' => 'yes',
                'condition' => [
                    'enable_categories' => 'yes',
                ],
            ]
        );
        $this->add_control(
            'show_comma_in_categories',
            [
                'label' => esc_html__('Show Comma Between Categories', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'topper-pack'),
                'label_off' => esc_html__('No', 'topper-pack'),
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );

        $this->add_control(
            'title_tag',
            [
                'label' => esc_html__('HTML Tag', 'topper-pack'),
                'description' => esc_html__('Add HTML Tag For Small Title', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'h3',
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
                'condition' => [
                    'show_label' => 'yes',
                    'enable_categories' => 'yes',
                ],
            ]
        );
        $this->add_control(
            'category_label',
            [
                'label' => esc_html__('Label', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Categories', 'topper-pack'),
                'condition' => [
                    'show_label' => 'yes',
                    'enable_categories' => 'yes',
                ],
            ]
        );
        // Number of Categories
        $this->add_control(
            'categories_number',
            [
                'label'     => esc_html__('Number of Categories', 'topper-pack'),
                'type'      => Controls_Manager::NUMBER,
                'default'   => 5,
                'condition' => [
                    'enable_categories' => 'yes',
                ],
            ]
        );

        // Categories Order By
        $this->add_control(
            'categories_order_by',
            [
                'label'     => esc_html__('Order By', 'topper-pack'),
                'type'      => Controls_Manager::SELECT,
                'default'   => 'name',
                'options'   => [
                    'name'  => esc_html__('Name', 'topper-pack'),
                    'count' => esc_html__('Count', 'topper-pack'),
                    'id'    => esc_html__('ID', 'topper-pack'),
                ],
                'condition' => [
                    'enable_categories' => 'yes',
                ],
            ]
        );

        // Categories Order
        $this->add_control(
            'categories_order',
            [
                'label'     => esc_html__('Order', 'topper-pack'),
                'type'      => Controls_Manager::SELECT,
                'default'   => 'ASC',
                'options'   => [
                    'ASC'  => esc_html__('Ascending', 'topper-pack'),
                    'DESC' => esc_html__('Descending', 'topper-pack'),
                ],
                'condition' => [
                    'enable_categories' => 'yes',
                ],
            ]
        );

        $this->end_controls_section();

        // Content Section - Tags
        $this->start_controls_section(
            'tags_section',
            [
                'label' => esc_html__('Tags', 'topper-pack'),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );
        // Enable Tags
        $this->add_control(
            'enable_tags',
            [
                'label'        => esc_html__('Enable Tags', 'topper-pack'),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => esc_html__('Yes', 'topper-pack'),
                'label_off'    => esc_html__('No', 'topper-pack'),
                'return_value' => 'yes',
                'default'      => 'no',
            ]
        );
        $this->add_control(
            'show_tag_label',
            [
                'label' => esc_html__('Show Label', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', 'topper-pack'),
                'label_off' => esc_html__('Hide', 'topper-pack'),
                'return_value' => 'yes',
                'default' => 'yes',
                'condition' => [
                    'enable_tags' => 'yes',
                ],
            ]
        );
        $this->add_control(
            'tag_label',
            [
                'label' => esc_html__('Label', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Categories', 'topper-pack'),
                'condition' => [
                    'show_tag_label' => 'yes',
                    'enable_tags' => 'yes',
                ],
            ]
        );
        // Number of Tags
        $this->add_control(
            'tags_number',
            [
                'label'     => esc_html__('Number of Tags', 'topper-pack'),
                'type'      => Controls_Manager::NUMBER,
                'default'   => 5,
                'condition' => [
                    'enable_tags' => 'yes',
                ],
            ]
        );

        // Tags Order By
        $this->add_control(
            'tags_order_by',
            [
                'label'     => esc_html__('Order By', 'topper-pack'),
                'type'      => Controls_Manager::SELECT,
                'default'   => 'name',
                'options'   => [
                    'name'  => esc_html__('Name', 'topper-pack'),
                    'count' => esc_html__('Count', 'topper-pack'),
                    'id'    => esc_html__('ID', 'topper-pack'),
                ],
                'condition' => [
                    'enable_tags' => 'yes',
                ],
            ]
        );

        // Tags Order
        $this->add_control(
            'tags_order',
            [
                'label'     => esc_html__('Order', 'topper-pack'),
                'type'      => Controls_Manager::SELECT,
                'default'   => 'ASC',
                'options'   => [
                    'ASC'  => esc_html__('Ascending', 'topper-pack'),
                    'DESC' => esc_html__('Descending', 'topper-pack'),
                ],
                'condition' => [
                    'enable_tags' => 'yes',
                ],
            ]
        );

        $this->end_controls_section();

        // Content Section - SKU
        $this->start_controls_section(
            'sku_section',
            [
                'label' => esc_html__('SKU', 'topper-pack'),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        // Enable SKU
        $this->add_control(
            'enable_sku',
            [
                'label'        => esc_html__('Enable SKU', 'topper-pack'),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => esc_html__('Yes', 'topper-pack'),
                'label_off'    => esc_html__('No', 'topper-pack'),
                'return_value' => 'yes',
                'default'      => 'no',
            ]
        );

        // Show SKU Label
        $this->add_control(
            'show_sku_label',
            [
                'label'        => esc_html__('Show SKU Label', 'topper-pack'),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => esc_html__('Yes', 'topper-pack'),
                'label_off'    => esc_html__('No', 'topper-pack'),
                'return_value' => 'yes',
                'default'      => 'yes',
                'condition'    => [
                    'enable_sku' => 'yes',
                ],
            ]
        );

        // SKU Label Text
        $this->add_control(
            'sku_label',
            [
                'label'     => esc_html__('SKU Label', 'topper-pack'),
                'type'      => Controls_Manager::TEXT,
                'default'   => esc_html__('SKU:', 'topper-pack'),
                'condition' => [
                    'enable_sku'      => 'yes',
                    'show_sku_label'   => 'yes',
                ],
            ]
        );

        // Number of SKUs to Display
        $this->add_control(
            'sku_number',
            [
                'label'     => esc_html__('Number of SKUs', 'topper-pack'),
                'type'      => Controls_Manager::NUMBER,
                'default'   => 5,
                'condition' => [
                    'enable_sku' => 'yes',
                ],
            ]
        );

        // SKU Order By
        $this->add_control(
            'sku_order_by',
            [
                'label'     => esc_html__('Order By', 'topper-pack'),
                'type'      => Controls_Manager::SELECT,
                'default'   => 'meta_value',
                'options'   => [
                    'meta_value' => esc_html__('SKU', 'topper-pack'), // phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_meta_value
                    'date'      => esc_html__('Date', 'topper-pack'),
                    'title'     => esc_html__('Title', 'topper-pack'),
                ],
                'condition' => [
                    'enable_sku' => 'yes',
                ],
            ]
        );

        // SKU Order
        $this->add_control(
            'sku_order',
            [
                'label'     => esc_html__('Order', 'topper-pack'),
                'type'      => Controls_Manager::SELECT,
                'default'   => 'ASC',
                'options'   => [
                    'ASC'  => esc_html__('Ascending', 'topper-pack'),
                    'DESC' => esc_html__('Descending', 'topper-pack'),
                ],
                'condition' => [
                    'enable_sku' => 'yes',
                ],
            ]
        );

        $this->end_controls_section();

        // Style Section
        $this->start_controls_section(
            'style_section',
            [
                'label' => esc_html__('Box', 'topper-pack'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_responsive_control(
            'display_control',
            [
                'label' => esc_html__('Display Style', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'flex',
                'options' => [
                    '' => esc_html__('Default', 'topper-pack'),
                    'flex' => esc_html__('Inline', 'topper-pack'),
                ],
                'selectors' => [
                    '{{WRAPPER}} .topppa-categories-wrapper' => 'display: {{VALUE}};',
                    '{{WRAPPER}} .topppa-tags-wrapper' => 'display: {{VALUE}};',
                    '{{WRAPPER}} .topppa-sku-wrapper' => 'display: {{VALUE}};',
                    '{{WRAPPER}} .topppa-categories-wrapper ul' => 'display: {{VALUE}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'topppa_hi_c_align',
            [
                'label' => esc_html__('Alignment', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'start' => [
                        'title' => esc_html__('Left', 'topper-pack'),
                        'icon' => 'eicon-v-align-top',
                    ],
                    'center' => [
                        'title' => esc_html__('Center', 'topper-pack'),
                        'icon' => 'eicon-v-align-middle',
                    ],
                    'end' => [
                        'title' => esc_html__('Right', 'topper-pack'),
                        'icon' => 'eicon-v-align-bottom',
                    ],
                ],
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .topppa-categories-wrapper' => 'align-items: {{VALUE}};',
                    '{{WRAPPER}} .topppa-tags-wrapper' => 'align-items: {{VALUE}};',
                    '{{WRAPPER}} .topppa-sku-wrapper' => 'align-items: {{VALUE}};',
                ],
                'condition' => [
                    'display_control' => 'flex'
                ]
            ]
        );
        $this->add_responsive_control(
            'gap',
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
                    'size' => 20,
                ],
                'selectors' => [
                    '{{WRAPPER}} .topppa-categories-wrapper' => 'gap: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .topppa-tags-wrapper' => 'gap: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .topppa-sku-wrapper' => 'gap: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();

        // <==========> ITEM STYLES <==========>

        $this->start_controls_section(
            'box_styles',
            [
                'label' => esc_html__('Item', 'topper-pack'),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_responsive_control(
            'box_display',
            [
                'label' => esc_html__('Display Style', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => '',
                'options' => [
                    '' => esc_html__('Default', 'topper-pack'),
                    'flex' => esc_html__('Flex', 'topper-pack'),
                ],
                'selectors' => [
                    '{{WRAPPER}} .topppa-product-categories-tags .topppa-categories-list-wrapper, .topppa-product-categories-tags .topppa-tags-list-wrapper ul' => 'display: {{VALUE}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'content_box_direction',
            [
                'label' => esc_html__('Direction', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'none',
                'options' => [
                    'none' => esc_html__('None', 'topper-pack'),
                    'row' => esc_html__('Row', 'topper-pack'),
                    'row-reverse' => esc_html__('Row Reverse', 'topper-pack'),
                    'column'  => esc_html__('Column', 'topper-pack'),
                    'column-reverse' => esc_html__('Column Reverse', 'topper-pack'),
                ],
                'selectors' => [
                    '{{WRAPPER}} .topppa-product-categories-tags .topppa-categories-list-wrapper, .topppa-product-categories-tags .topppa-tags-list-wrapper ul' => 'flex-direction: {{VALUE}};',
                ],
                'condition' => [
                    'box_display' => 'flex',
                ]
            ]
        );
        $this->add_responsive_control(
            'content_box_align',
            [
                'label' => esc_html__('Alignment', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'start' => [
                        'title' => esc_html__('Start', 'topper-pack'),
                        'icon' => 'eicon-v-align-top',
                    ],
                    'center' => [
                        'title' => esc_html__('Center', 'topper-pack'),
                        'icon' => 'eicon-v-align-middle',
                    ],
                    'end' => [
                        'title' => esc_html__('End', 'topper-pack'),
                        'icon' => 'eicon-v-align-bottom',
                    ],
                ],
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .topppa-product-categories-tags .topppa-categories-list-wrapper, .topppa-product-categories-tags .topppa-tags-list-wrapper ul' => 'align-items: {{VALUE}};',
                ],
                'condition' => [
                    'box_display' => 'flex',
                ]
            ]
        );
        $this->add_responsive_control(
            'content_box_jalign',
            [
                'label' => esc_html__('Alignment', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'start' => [
                        'title' => esc_html__('Left', 'topper-pack'),
                        'icon' => 'eicon-align-start-h',
                    ],
                    'center' => [
                        'title' => esc_html__('Center', 'topper-pack'),
                        'icon' => 'eicon-align-center-h',
                    ],
                    'end' => [
                        'title' => esc_html__('Right', 'topper-pack'),
                        'icon' => 'eicon-align-end-h',
                    ],
                ],
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .topppa-product-categories-tags .topppa-categories-list-wrapper, .topppa-product-categories-tags .topppa-tags-list-wrapper ul' => 'justify-content: {{VALUE}};',
                    '{{WRAPPER}} .topppa-product-categories-tags .topppa-categories-list-wrapper, .topppa-product-categories-tags .topppa-tags-list-wrapper ul' => 'text-align: {{VALUE}};',
                ],
                'condition' => [
                    'box_display' => 'flex',
                    'content_box_direction' => ['column', 'column-reverse']
                ]
            ]
        );
        $this->add_responsive_control(
            'content_box_gap',
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
                    '{{WRAPPER}} .topppa-product-categories-tags .topppa-categories-list-wrapper, .topppa-product-categories-tags .topppa-tags-list-wrapper ul' => 'gap: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'box_display' => 'flex',
                ]
            ]
        );

        $this->start_controls_tabs(
            'item_style_tabs'
        );

        $this->start_controls_tab(
            'item_cat_tab',
            [
                'label' => esc_html__('Category', 'topper-pack'),
                'condition' => [
                    'enable_categories' => 'yes'
                ]
            ]
        );
        $this->add_control(
            'divider1',
            [
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'label_typo',
                'selector' => '{{WRAPPER}} .topppa-product-categories-tags .topppa-categories-wrapper .topppa-meta-label',
            ]
        );
        $this->add_responsive_control(
            'cat_color',
            [
                'label' => esc_html__('Color', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .topppa-product-categories-tags .topppa-categories-list-wrapper a' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_responsive_control(
            'cat_hcolor',
            [
                'label' => esc_html__('Hover Color', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .topppa-product-categories-tags .topppa-categories-list-wrapper a:hover' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'cat_bg',
                'types' => ['classic', 'gradient', 'video'],
                'selector' => '{{WRAPPER}} .topppa-product-categories-tags .topppa-categories-list-wrapper a',
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'cat_border',
                'label' => esc_html__('Border', 'topper-pack'),
                'selector' => '{{WRAPPER}} .topppa-product-categories-tags .topppa-categories-list-wrapper a, {{WRAPPER}} .topppa-product-categories-tags .topppa-tags-list-wrapper ul li a',
            ]
        );
        $this->add_responsive_control(
            'cat_radius',
            [
                'label' => esc_html__('Border Radius', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .topppa-product-categories-tags .topppa-categories-list-wrapper a, {{WRAPPER}} .topppa-product-categories-tags .topppa-tags-list-wrapper ul li a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'cat_shadow',
                'label' => esc_html__('Box Shadow', 'topper-pack'),
                'selector' => '{{WRAPPER}} .topppa-product-categories-tags .topppa-categories-list-wrapper a, {{WRAPPER}} .topppa-product-categories-tags .topppa-tags-list-wrapper ul li a',
            ]
        );
        $this->add_responsive_control(
            'cat_margin',
            [
                'label' => esc_html__('Margin', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .topppa-product-categories-tags .topppa-categories-list-wrapper a, {{WRAPPER}} .topppa-product-categories-tags .topppa-tags-list-wrapper ul li a' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'cat_padding',
            [
                'label' => esc_html__('Padding', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .topppa-product-categories-tags .topppa-categories-list-wrapper a, {{WRAPPER}} .topppa-product-categories-tags .topppa-tags-list-wrapper ul li a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_tab();

        $this->start_controls_tab(
            'item_tag_tab',
            [
                'label' => esc_html__('Tags', 'topper-pack'),
                'condition' => [
                    'enable_tags' => 'yes'
                ]
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'tags_label_typography',
                'selector' => '{{WRAPPER}} .topppa-product-categories-tags .topppa-tags-wrapper .topppa-meta-label',
            ]
        );
        $this->add_responsive_control(
            'tags_label_color',
            [
                'label' => esc_html__('Color', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .topppa-product-categories-tags .topppa-tags-wrapper .topppa-meta-label' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'divider2',
            [
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->add_responsive_control(
            'tag_color',
            [
                'label' => esc_html__('Color', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .topppa-product-categories-tags .topppa-tags-list-wrapper ul li a' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_responsive_control(
            'tag_hcolor',
            [
                'label' => esc_html__('Hover Color', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .topppa-product-categories-tags .topppa-tags-list-wrapper ul li a:hover' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'tags_bg',
                'types' => ['classic', 'gradient', 'video'],
                'selector' => '{{WRAPPER}} .topppa-product-categories-tags .topppa-tags-list-wrapper ul li a',
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'tags_border',
                'label' => esc_html__('Border', 'topper-pack'),
                'selector' => '{{WRAPPER}} .topppa-product-categories-tags .topppa-tags-list-wrapper ul li a',
            ]
        );
        $this->add_responsive_control(
            'tags_radius',
            [
                'label' => esc_html__('Border Radius', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .topppa-product-categories-tags .topppa-tags-list-wrapper ul li a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'tags_shadow',
                'label' => esc_html__('Box Shadow', 'topper-pack'),
                'selector' => '{{WRAPPER}} .topppa-product-categories-tags .topppa-tags-list-wrapper ul li a',
            ]
        );
        $this->add_responsive_control(
            'tags_margin',
            [
                'label' => esc_html__('Margin', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .topppa-product-categories-tags .topppa-tags-list-wrapper ul li a' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'tags_padding',
            [
                'label' => esc_html__('Padding', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .topppa-product-categories-tags .topppa-tags-list-wrapper ul li a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_tab();

        $this->start_controls_tab(
            'item_sku_tab',
            [
                'label' => esc_html__('Sku', 'topper-pack'),
                'condition' => [
                    'enable_sku' => 'yes'
                ]
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'sku_label_typography',
                'selector' => '{{WRAPPER}} .topppa-product-categories-tags .topppa-sku-wrapper .topppa-meta-label',
            ]
        );
        $this->add_responsive_control(
            'sku_label_color',
            [
                'label' => esc_html__('Color', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .topppa-product-categories-tags .topppa-sku-wrapper .topppa-meta-label' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'divider3',
            [
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->add_responsive_control(
            'sku_color',
            [
                'label' => esc_html__('Color', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .topppa-product-categories-tags .topppa-sku-wrapper ul li' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'sku_bg',
                'types' => ['classic', 'gradient', 'video'],
                'selector' => '{{WRAPPER}} .topppa-product-categories-tags .topppa-sku-wrapper ul li',
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'sku_border',
                'label' => esc_html__('Border', 'topper-pack'),
                'selector' => '{{WRAPPER}} .topppa-product-categories-tags .topppa-sku-wrapper ul li',
            ]
        );
        $this->add_responsive_control(
            'sku_radius',
            [
                'label' => esc_html__('Border Radius', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .topppa-product-categories-tags .topppa-sku-wrapper ul li' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'sku_shadow',
                'label' => esc_html__('Box Shadow', 'topper-pack'),
                'selector' => '{{WRAPPER}} .topppa-product-categories-tags .topppa-sku-wrapper ul li',
            ]
        );
        $this->add_responsive_control(
            'sku_margin',
            [
                'label' => esc_html__('Margin', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .topppa-product-categories-tags .topppa-sku-wrapper ul li' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'sku_padding',
            [
                'label' => esc_html__('Padding', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .topppa-product-categories-tags .topppa-sku-wrapper ul li' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();
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
    protected function render() {
        $settings = $this->get_settings_for_display();

        // Check if WooCommerce is active
        if (!class_exists('WooCommerce')) {
            echo '<div class="elementor-alert elementor-alert-warning">';
            echo esc_html__('WooCommerce is not installed. Please install and activate WooCommerce to use this widget.', 'topper-pack');
            echo '</div>';
            return;
        }

        echo '<div class="topppa-product-categories-tags">';

        // Display Categories
        if ($settings['enable_categories'] === 'yes') {
            $categories_args = [
                'taxonomy'   => 'product_cat',
                'number'     => $settings['categories_number'],
                'orderby'    => $settings['categories_order_by'],
                'order'      => $settings['categories_order'],
                'hide_empty' => true,
            ];

            $categories = get_terms($categories_args);

            if (!is_wp_error($categories) && !empty($categories)) {
                echo '<div class="topppa-categories-wrapper">'; // Original wrapper

                if (!empty($settings['show_label']) && $settings['show_label'] === 'yes') {
                    $title = !empty($settings['category_label']) ? $settings['category_label'] : esc_html__('Categories', 'topper-pack');
                    $tag   = !empty($settings['title_tag']) ? tag_escape($settings['title_tag']) : 'h3';
                    $class = 'topppa-meta-label';

                    echo '<' . esc_attr($tag) . ' class="' . esc_attr($class) . '">' . esc_html($title) . '</' . esc_attr($tag) . '>';
                }

                // New wrapper for categories list
                echo '<div class="topppa-categories-list-wrapper">';


                // Check if comma should be enabled between categories
                $show_comma = !empty($settings['show_comma_in_categories']) && $settings['show_comma_in_categories'] === 'yes';

                // Prepare category names
                $category_names = [];
                foreach ($categories as $category) {
                    $category_names[] = '<a href="' . esc_url(get_term_link($category)) . '">' . esc_html($category->name) . '</a>';
                }

                // Output categories with or without commas
                if ($show_comma) {
                    echo esc_html(implode(', ', $category_names)); 
                } else {
                    echo esc_html(implode(' ', $category_names));
                }

                echo '</div>'; // Close the categories list wrapper
                echo '</div>'; // Close the original wrapper
            } else {
                echo '<div class="topppa-categories-wrapper">';
                echo esc_html__('No categories found.', 'topper-pack');
                echo '</div>';
            }
        }

        // Display Tags
        if ($settings['enable_tags'] === 'yes') {
            $tags_args = [
                'taxonomy'   => 'product_tag',
                'number'     => $settings['tags_number'],
                'orderby'    => $settings['tags_order_by'],
                'order'      => $settings['tags_order'],
                'hide_empty' => true,
            ];
            $tags = get_terms($tags_args);
            if (!is_wp_error($tags) && !empty($tags)) {
                echo '<div class="topppa-tags-wrapper">'; // Original wrapper

                if (!empty($settings['show_tag_label']) && $settings['show_tag_label'] === 'yes') {
                    $title = !empty($settings['tag_label']) ? $settings['tag_label'] : esc_html__('Tags', 'topper-pack');
                    $tag   = !empty($settings['title_tag']) ? tag_escape($settings['title_tag']) : 'h3';

                    // Add a class to the title tag
                    $class = 'topppa-meta-label';

                    echo '<' . esc_attr($tag) . ' class="' . esc_attr($class) . '">' . esc_html($title) . '</' . esc_attr($tag) . '>';
                }

                // New wrapper for tags list
                echo '<div class="topppa-tags-list-wrapper">';

                // Display tags
                echo '<ul>';




                foreach ($tags as $tag) {
                    echo '<li><a href="' . esc_url(get_term_link($tag)) . '">' . esc_html($tag->name) . '</a></li>';
                }
                echo '</ul>';

                echo '</div>'; // Close the tags list wrapper
                echo '</div>'; // Close the original wrapper
            } else {
                echo '<div class="topppa-tags-wrapper">';
                echo esc_html__('No tags found.', 'topper-pack');
                echo '</div>';
            }
        }

        // Display SKUs
        if ($settings['enable_sku'] === 'yes') {
            $sku_args = [

                'post_type'      => 'product',
                'posts_per_page' => $settings['sku_number'],
                'meta_key'      => '_sku', // phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_meta_key
                'orderby'       => $settings['sku_order_by'],
                'order'         => $settings['sku_order'],
            ];

            $products = new \WP_Query($sku_args);

            if ($products->have_posts()) {
                echo '<div class="topppa-sku-wrapper">';

                if (!empty($settings['show_sku_label']) && $settings['show_sku_label'] === 'yes') {
                    $title = !empty($settings['sku_label']) ? $settings['sku_label'] : esc_html__('SKU:', 'topper-pack');
                    $tag   = !empty($settings['title_tag']) ? tag_escape($settings['title_tag']) : 'h3';

                    $class = 'topppa-meta-label';

                    echo '<' . esc_attr($tag) . ' class="' . esc_attr($class) . '">' . esc_html($title) . '</' . esc_attr($tag) . '>';
                }

                echo '<ul>';
                while ($products->have_posts()) {
                    $products->the_post();
                    global $product;
                    $sku = $product->get_sku();
                    if (!empty($sku)) {
                        echo '<li>' . esc_html($sku) . '</li>';
                    }
                }
                echo '</ul>';

                echo '</div>';

                wp_reset_postdata();
            } else {
                echo '<div class="topppa-sku-wrapper">';
                echo esc_html__('No SKUs found.', 'topper-pack');
                echo '</div>';
            }
        }
        echo '</div>';
    }
}
