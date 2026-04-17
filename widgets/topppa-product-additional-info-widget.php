<?php
use \TopperPack\Includes\Controls\Controls_Manager as TopperPack_Controls_Manager;
use \Elementor\Controls_Manager;
use \Elementor\Widget_Base;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

/**
 * Elementor Single Product Additional Information Widget.
 *
 * A widget that displays the additional information (attributes) of a single product.
 *
 * @since 1.0.0
 */
class TOPPPA_Product_Additional_Info_Widget extends Widget_Base {

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
        return 'topppa_single_product_additional_info';
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
        return TOPPPA_EPWB . esc_html__('Product Additional Info', 'topper-pack');
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
        return 'eicon-info-box';
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
        return ['single product', 'woocommerce', 'additional', 'information', 'topppa', 'topperpack'];
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
        return 'https://doc.topperpack.com/docs/woocommerce-widgets/product-additional-info/';
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
                'description' => esc_html__('Select a specific product to display its additional information.', 'topper-pack'),
            ]
        );

        $this->end_controls_section();

        // <==========>
        // <==========> TITLE STYLES <==========>

        $this->start_controls_section(
            'title_styles',
            [
                'label' => esc_html__('Title', 'topper-pack'),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'title_typo',
                'selector' => '{{WRAPPER}} .topppa-single-product-additional-info h2',
            ]
        );
        $this->add_responsive_control(
            'title_color',
            [
                'label'     => esc_html__('Color', 'topper-pack'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .topppa-single-product-additional-info h2' => 'color: {{VALUE}}',
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
                    '{{WRAPPER}} .topppa-single-product-additional-info h2' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                    '{{WRAPPER}} .topppa-single-product-additional-info h2' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();

        $this->start_controls_section(
            'info_styles',
            [
                'label' => esc_html__('Info Styles', 'topper-pack'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->start_controls_tabs(
            'additional_tabs'
        );

        $this->start_controls_tab(
            'additional_label_tab',
            [
                'label' => esc_html__('Label', 'topper-pack'),
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'label_typo',
                'selector' => '{{WRAPPER}} .topppa-single-product-additional-info th.woocommerce-product-attributes-item__label',
            ]
        );
        $this->add_responsive_control(
            'label_color',
            [
                'label'     => esc_html__('Color', 'topper-pack'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .topppa-single-product-additional-info th.woocommerce-product-attributes-item__label' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_responsive_control(
            'label_margin',
            [
                'label'      => esc_html__('Margin', 'topper-pack'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .topppa-single-product-additional-info th.woocommerce-product-attributes-item__label' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'label_padding',
            [
                'label'      => esc_html__('Padding', 'topper-pack'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .topppa-single-product-additional-info th.woocommerce-product-attributes-item__label' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_tab();

        $this->start_controls_tab(
            'additional_info_tab',
            [
                'label' => esc_html__('Info', 'topper-pack'),
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'info_typo',
                'selector' => '{{WRAPPER}} .topppa-single-product-additional-info .woocommerce-product-attributes-item__value',
            ]
        );
        $this->add_responsive_control(
            'info_color',
            [
                'label'     => esc_html__('Color', 'topper-pack'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .topppa-single-product-additional-info .woocommerce-product-attributes-item__value' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_responsive_control(
            'info_margin',
            [
                'label'      => esc_html__('Margin', 'topper-pack'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .topppa-single-product-additional-info .woocommerce-product-attributes-item__value' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'info_padding',
            [
                'label'      => esc_html__('Padding', 'topper-pack'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .topppa-single-product-additional-info .woocommerce-product-attributes-item__value' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();

        // Table Styles
        $this->start_controls_section(
            'table_styles',
            [
                'label' => esc_html__('Table', 'topper-pack'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'table_border',
                'label' => esc_html__('Border', 'topper-pack'),
                'selector' => '{{WRAPPER}} .topppa-single-product-additional-info table.woocommerce-product-attributes',
            ]
        );

        $this->add_responsive_control(
            'table_border_radius',
            [
                'label' => esc_html__('Border Radius', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .topppa-single-product-additional-info table.woocommerce-product-attributes' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'table_padding',
            [
                'label' => esc_html__('Padding', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .topppa-single-product-additional-info table.woocommerce-product-attributes' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'table_margin',
            [
                'label' => esc_html__('Margin', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .topppa-single-product-additional-info table.woocommerce-product-attributes' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'table_background',
                'label' => esc_html__('Background', 'topper-pack'),
                'types' => ['classic', 'gradient', 'video'],
                'selector' => '{{WRAPPER}} .topppa-single-product-additional-info table.woocommerce-product-attributes',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'table_box_shadow',
                'label' => esc_html__('Box Shadow', 'topper-pack'),
                'selector' => '{{WRAPPER}} .topppa-single-product-additional-info table.woocommerce-product-attributes',
            ]
        );

        $this->end_controls_section();

        // Table Row Styles
        $this->start_controls_section(
            'table_row_styles',
            [
                'label' => esc_html__('Table Row', 'topper-pack'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'row_border',
                'label' => esc_html__('Border', 'topper-pack'),
                'selector' => '{{WRAPPER}} .topppa-single-product-additional-info table.woocommerce-product-attributes tr',
            ]
        );

        $this->add_responsive_control(
            'row_padding',
            [
                'label' => esc_html__('Padding', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .topppa-single-product-additional-info table.woocommerce-product-attributes tr' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'row_background',
                'label' => esc_html__('Background', 'topper-pack'),
                'types' => ['classic', 'gradient', 'video'],
                'selector' => '{{WRAPPER}} .topppa-single-product-additional-info table.woocommerce-product-attributes tr',
            ]
        );

        $this->add_control(
            'row_background_hover',
            [
                'label' => esc_html__('Background Hover', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .topppa-single-product-additional-info table.woocommerce-product-attributes tr:hover' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_section();

        // Table Cell Styles
        $this->start_controls_section(
            'table_cell_styles',
            [
                'label' => esc_html__('Table Cell', 'topper-pack'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'cell_border',
                'label' => esc_html__('Border', 'topper-pack'),
                'selector' => '{{WRAPPER}} .topppa-single-product-additional-info table.woocommerce-product-attributes td, {{WRAPPER}} .topppa-single-product-additional-info table.woocommerce-product-attributes th',
            ]
        );

        $this->add_responsive_control(
            'cell_padding',
            [
                'label' => esc_html__('Padding', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .topppa-single-product-additional-info table.woocommerce-product-attributes td, {{WRAPPER}} .topppa-single-product-additional-info table.woocommerce-product-attributes th' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'cell_background',
                'label' => esc_html__('Background', 'topper-pack'),
                'types' => ['classic', 'gradient', 'video'],
                'selector' => '{{WRAPPER}} .topppa-single-product-additional-info table.woocommerce-product-attributes td, {{WRAPPER}} .topppa-single-product-additional-info table.woocommerce-product-attributes th',
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

        // If in theme builder, show dummy content
        if ($is_theme_builder) {
            echo '<div class="topppa-single-product-additional-info">';
            echo '<h2>' . esc_html__('Additional information', 'topper-pack') . '</h2>';
            echo '<table class="woocommerce-product-attributes shop_attributes">';
            echo '<tbody>';
            
            // Sample attributes
            $dummy_attributes = [
                'Dimensions' => '12 × 8 × 4 cm',
                'Weight' => '0.5 kg',
                'Color' => 'Black, White, Red',
                'Material' => 'Cotton, Polyester',
                'Size' => 'S, M, L, XL',
                'Brand' => 'Sample Brand',
                'SKU' => 'SKU123456',
                'Shipping' => 'Free shipping'
            ];

            foreach ($dummy_attributes as $label => $value) {
                echo '<tr class="woocommerce-product-attributes-item">';
                echo '<th class="woocommerce-product-attributes-item__label">' . esc_html($label) . '</th>';
                echo '<td class="woocommerce-product-attributes-item__value">' . esc_html($value) . '</td>';
                echo '</tr>';
            }

            echo '</tbody>';
            echo '</table>';
            echo '</div>';
            return;
        }

        // If still no product ID, show a warning
        if (!$product_id) {
            echo '<div class="elementor-alert elementor-alert-warning">';
            echo esc_html__('No product selected or no product found on this page.', 'topper-pack');
            echo '</div>';
            return;
        }

        // Get product object
        $product = wc_get_product($product_id);
        if (!$product) {
            echo '<div class="elementor-alert elementor-alert-warning">';
            echo esc_html__('Invalid product selected.', 'topper-pack');
            echo '</div>';
            return;
        }

        // Render the additional information section
        echo '<div class="topppa-single-product-additional-info">';

        // Display product attributes
        if ($product->has_attributes()) {
            wc_get_template('single-product/tabs/additional-information.php', ['product' => $product]);
        } else {
            echo '<p>' . esc_html__('No additional information available.', 'topper-pack') . '</p>';
        }

        echo '</div>';
    }
}