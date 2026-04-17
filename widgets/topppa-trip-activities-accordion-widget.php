<?php

use TopperPack\Trait_Loader\Global_Component_Loader;
use \TopperPack\Includes\Controls\Controls_Manager as TopperPack_Controls_Manager;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

/**
 * Elementor topppa Accordion Service Widget.
 *
 * Elementor widget that inserts an embbedable content into the page, from any given URL.
 *
 * @since 1.0.0
 */
class TOPPPA_Trip_Activities_Accordion_Widget extends \Elementor\Widget_Base {
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
        return 'topppa_trip_activities_accordion_widget';
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
        return TOPPPA_EPWB . esc_html__('Trip Activities Accordion', 'topper-pack');
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
        return ['topppa', 'widget', 'Activities Accordion', 'Trip', 'Activities', 'topperpack'];
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
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );
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
        $this->add_control(
            'cat_name',
            [
                'label' => esc_html__('Select Category', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::SELECT2,
                'label_block' => true,
                'multiple' => true,
                'options' => $this->category_list(),
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
                'label' => esc_html__('Trips Count Label', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Listing', 'topper-pack'),
                'condition' => [
                    'enable_trip_counts' => 'yes',
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
                    'h1' => esc_html__('H1', 'topper-pack'),
                    'h2' => esc_html__('H2', 'topper-pack'),
                    'h3' => esc_html__('H3', 'topper-pack'),
                    'h4' => esc_html__('H4', 'topper-pack'),
                    'h5' => esc_html__('H5', 'topper-pack'),
                    'h6' => esc_html__('H6', 'topper-pack'),
                    'p' => esc_html__('P', 'topper-pack'),
                    'span' => esc_html__('span', 'topper-pack'),
                    'div' => esc_html__('Div', 'topper-pack'),
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
                'label' => esc_html__('Description Length ', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'min' => 1,
                'max' => 50,
                'step' => 1,
                'default' => 12,
                'condition' => [
                    'enable_description' => 'yes',
                ],
            ]
        );
        $this->add_control(
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

        $this->add_control(
            'active_item_number',
            [
                'label' => esc_html__('Active Item Number', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'min' => 1,
                'step' => 1,
                'default' => 1,
                'description' => esc_html__('1 = First item, 2 = Second item, etc.', 'topper-pack'),
            ]
        );

        $this->end_controls_section();
        $this->start_controls_section(
            'content_box_options',
            [
                'label' => esc_html__('Box Style', 'topper-pack'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
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
                    '{{WRAPPER}} .trip-activities-accordion-container .trip-activities-accordion-item' => 'text-align: {{VALUE}};',
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
                    '{{WRAPPER}} .trip-activities-accordion-container' => 'flex-direction: {{VALUE}};',
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
                    '{{WRAPPER}} .trip-activities-accordion-container .trip-activities-accordion-item.active' => 'flex: {{SIZE}};',
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
                    '{{WRAPPER}} .trip-activities-accordion-container' => 'gap: {{SIZE}}{{UNIT}};',
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
                'selectors' => [
                    '{{WRAPPER}} .trip-activities-accordion-container .trip-activities-accordion-item' => 'min-height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'box_backgrounds',
                'label' => esc_html__('Background', 'topper-pack'),
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .trip-activities-accordion-container .trip-activities-accordion-item::before',
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'box_border',
                'label' => esc_html__('Border', 'topper-pack'),
                'selector' => '{{WRAPPER}} .trip-activities-accordion-container .trip-activities-accordion-item',

            ]
        );
        $this->add_responsive_control(
            'box_border_radius',
            [
                'label' => esc_html__('Border Radius', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .trip-activities-accordion-container .trip-activities-accordion-item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'box_shadow',
                'selector' => '{{WRAPPER}} .trip-activities-accordion-container .trip-activities-accordion-item',
            ]
        );

        $this->add_responsive_control(
            'box_margin',
            [
                'label' => esc_html__('Margin', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .trip-activities-accordion-container .trip-activities-accordion-item' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                    '{{WRAPPER}} .trip-activities-accordion-container .trip-activities-accordion-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
            'content_count_tab',
            [
                'label' => esc_html__('Count', 'topper-pack'),
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'count_typo',
                'label' => __('Typography', 'topper-pack'),
                'selector' => ' {{WRAPPER}} .trip-activities-accordion-item .trip-activities-accordion-count',
            ]
        );

        $this->add_responsive_control(
            'count_color',
            [
                'label' => esc_html__('Color', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .trip-activities-accordion-item .trip-activities-accordion-count' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'count_margin',
            [
                'label' => esc_html__('Margin', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .trip-activities-accordion-item .trip-activities-accordion-count' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'count_padding',
            [
                'label' => esc_html__('Padding', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .trip-activities-accordion-item .trip-activities-accordion-count' => 'Padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_tab();
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
                'selector' => ' {{WRAPPER}} .trip-activities-accordion-title ',
            ]
        );

        $this->add_responsive_control(
            'title_color',
            [
                'label' => esc_html__('Color', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .trip-activities-accordion-title' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .trip-activities-accordion-title a' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'title_hover_color',
            [
                'label' => esc_html__('Hover Color', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .trip-activities-accordion-title a:hover' => 'color: {{VALUE}};',

                ],
            ]
        );

        $this->add_responsive_control(
            'title_margin',
            [
                'label' => esc_html__('Margin', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .trip-activities-accordion-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'title_padding',
            [
                'label' => esc_html__('Padding', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .trip-activities-accordion-title' => 'Padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                'name' => 'short_desc_typo',
                'label' => __('Typography', 'topper-pack'),
                'selector' => '{{WRAPPER}} .trip-activities-accordion-description',
            ]
        );

        $this->add_responsive_control(
            'short_desc_color',
            [
                'label' => esc_html__('Color', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .trip-activities-accordion-description' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'short_desc_margin',
            [
                'label' => esc_html__('Margin', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .trip-activities-accordion-description' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'short_desc_padding',
            [
                'label' => esc_html__('Padding', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .trip-activities-accordion-description' => 'Padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
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

        $items_count = $settings['items_count'];
        $selected_categories = !empty($settings['cat_name']) ? $settings['cat_name'] : [];

        $args = [
            'taxonomy' => 'activities',
            'number' => $items_count,
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

        // 👉 Nth active item
        $active_item = !empty($settings['active_item_number'])
            ? intval($settings['active_item_number'])
            : 1;

        $index = 1; // 1-based index
        $uniqueId = 'topppa-accordion-' . esc_attr($this->get_id());
?>

        <div id="<?php echo esc_attr($uniqueId); ?>" class="trip-activities-accordion-container" data-trigger="<?php echo esc_attr($settings['accordion_show_options']); ?>">
            <?php foreach ($terms as $term):
                $term_link = get_term_link($term);
                $term_name = esc_html($term->name);
                $term_count = intval($term->count);

                $description = get_term_meta($term->term_id, 'wte-shortdesc-textarea', true);

                $image_id_array = get_term_meta($term->term_id, 'category-image-id', true);
                $image_id = is_array($image_id_array) ? reset($image_id_array) : $image_id_array;
                $image_url = $image_id ? wp_get_attachment_image_url($image_id, 'full') : '';
            ?>

                <div class="panel trip-activities-accordion-item 
                <?php if ($index === $active_item) {
                    echo 'active';
                } ?>"
                    <?php if ($image_url): ?>
                    style="background-image:url('<?php echo esc_url($image_url); ?>');"
                    <?php endif; ?>>
                    <?php if ($settings['enable_trip_counts'] === 'yes'): ?>
                        <div class="trip-activities-accordion-count">
                            <span><?php echo esc_html($term_count); ?></span>
                            <?php echo esc_html($settings['trip_count']); ?>
                        </div>
                    <?php endif; ?>
                    <<?php echo esc_attr($settings['title_tag']); ?> class="trip-activities-accordion-title">
                        <a href="<?php echo esc_url($term_link); ?>">
                            <?php echo esc_html($term_name); ?>
                        </a>
                    </<?php echo esc_attr($settings['title_tag']); ?>>
                    <?php if ($settings['enable_description'] === 'yes'): ?>
                        <?php if (!empty($description)): ?>
                            <div class="trip-activities-accordion-des">
                                <?php echo esc_html(wp_trim_words($description, $settings['dec_length'])); ?>
                            </div>
                        <?php endif; ?>
                    <?php endif; ?>

                </div>
            <?php
                $index++;
            endforeach; ?>
        </div>
<?php
    }
}
