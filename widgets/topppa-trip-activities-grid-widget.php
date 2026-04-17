<?php

use \TopperPack\Includes\Controls\Controls_Manager as TopperPack_Controls_Manager;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

/**
 * Elementor TOPPPA Audio Widget.
 *
 * Elementor widget that inserts an embbedable content into the page, from any given URL.
 *
 * @since 1.0.0
 */
class TOPPPA_Trip_Activities_Grid_Widget extends \Elementor\Widget_Base {

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
        return 'trip-activities-grid-widget';
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
        return TOPPPA_EPWB . esc_html__('Trip Activities Grid', 'topper-pack');
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
        return ['topppa', 'widget', 'Trip Activities Grid', 'travel', 'topperpack'];
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
                'default' => esc_html__('Trips', 'topper-pack'),
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
        $this->end_controls_section();
        $this->start_controls_section(
            'box_styles',
            [
                'label' => esc_html__('Box Style', 'topper-pack'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_responsive_control(
            'bootstrap_gap',
            [
                'label' => esc_html__('Bootstrap Gap', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'g-4',
                'options' => [
                    'g-0' => esc_html__('None (g-0)', 'topper-pack'),
                    'g-1' => esc_html__('Extra Small (g-1)', 'topper-pack'),
                    'g-2' => esc_html__('Small (g-2)', 'topper-pack'),
                    'g-3' => esc_html__('Medium (g-3)', 'topper-pack'),
                    'g-4' => esc_html__('Large (g-4)', 'topper-pack'),
                    'g-5' => esc_html__('Extra Large (g-5)', 'topper-pack'),
                ],
                'description' => esc_html__('Bootstrap gap utility class for grid spacing', 'topper-pack'),
            ]
        );
        $this->add_responsive_control(
            'small_box_height',
            [
                'label' => esc_html__('Big Box Height', 'topper-pack'),
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
                    '{{WRAPPER}} .trip-activities-grid-widget .trip-activities-grid-card.trip-activities-grid-big ' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'big_box_height',
            [
                'label' => esc_html__('Small Box Height', 'topper-pack'),
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
                    '{{WRAPPER}} .trip-activities-grid-widget .trip-activities-grid-card' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'box_border',
                'label' => esc_html__('Border', 'topper-pack'),
                'selector' => '{{WRAPPER}} .trip-activities-grid-card',
            ]
        );
        $this->add_responsive_control(
            'box_radius',
            [
                'label' => esc_html__('Border Radius', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .trip-activities-grid-card' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'box_shadow',
                'label' => esc_html__('Box Shadow', 'topper-pack'),
                'selector' => '{{WRAPPER}} .trip-activities-grid-card',
            ]
        );
        $this->add_responsive_control(
            'box_margin',
            [
                'label' => esc_html__('Margin', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .trip-activities-grid-card' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'content_styles_option',
            [
                'label' => esc_html__('Content Style', 'topper-pack'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_responsive_control(
            'content_padding',
            [
                'label' => esc_html__('Padding', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .trip-activities-grid-widget .trip-activities-grid-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                'name' => 'title_typo',
                'selector' => '{{WRAPPER}} .trip-activities-grid-title',
            ]
        );
        $this->add_responsive_control(
            'title_color',
            [
                'label' => esc_html__('Color', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .trip-activities-grid-title' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .trip-activities-grid-title a' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_responsive_control(
            'title_hcolor',
            [
                'label' => esc_html__('Hover Color', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .trip-activities-grid-title a:hover' => 'color: {{VALUE}}',
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
                    '{{WRAPPER}} .trip-activities-grid-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                    '{{WRAPPER}} .trip-activities-grid-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_tab();
        $this->start_controls_tab(
            'style_stitle_tab',
            [
                'label' => esc_html__('Count', 'topper-pack'),
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'stitle_typo',
                'selector' => '{{WRAPPER}} .trip-activities-grid-trip-count',
            ]
        );
        $this->add_responsive_control(
            'stitle_color',
            [
                'label' => esc_html__('Color', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .trip-activities-grid-trip-count' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_responsive_control(
            'stitle_margin',
            [
                'label' => esc_html__('Margin', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .trip-activities-grid-trip-count' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'stitle_padding',
            [
                'label' => esc_html__('Padding', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .trip-activities-grid-trip-count' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
        $selected_categories = !empty($settings['cat_name']) ? $settings['cat_name'] : array();
        $bootstrap_gap = !empty($settings['bootstrap_gap']) ? $settings['bootstrap_gap'] : 'g-4';
        $args = [
            'taxonomy' => 'activities',
            'number' => 4,
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
?>
        <div class="trip-activities-grid-widget">
            <?php
            // Process terms in groups of 4 to maintain the layout structure
            $terms_count = count($terms);
            for ($i = 0; $i < $terms_count; $i += 4) {
                // Start a new row for each group of 4
            ?>
                <div class="row <?php echo esc_attr($bootstrap_gap); ?>">
                    <?php
                    // First item as a big card (col-lg-6)
                    if ($i < $terms_count) {
                        $term = $terms[$i];
                        $term_link = get_term_link($term);
                        $term_name = esc_html($term->name);
                        $image_id_array = get_term_meta($term->term_id, 'category-image-id', true);
                        $image_id = is_array($image_id_array) ? reset($image_id_array) : $image_id_array;
                        if (empty($image_id)) {
                            $image_id = $image_id_array; // fallback if not array
                        }
                        $image_url = $image_id ? wp_get_attachment_image_url($image_id, 'full') : '';
                        $image_alt = $image_id ? get_post_meta($image_id, '_wp_attachment_image_alt', true) : $term_name;
                    ?>
                        <div class="col-lg-6 col-md-12">
                            <div class="trip-activities-grid-card trip-activities-grid-big">
                                <?php if ($image_url): ?>
                                    <img src="<?php echo esc_url($image_url); ?>" alt="<?php echo esc_attr($image_alt); ?>" />
                                <?php endif; ?>
                                <div class="trip-activities-grid-content">
                                    <?php if ($settings['enable_trip_counts'] === 'yes'): ?>
                                        <span class="trip-activities-grid-trip-count">
                                            <?php echo esc_html('( ' . $term->count . ' ' . $settings['trip_count'] . ' )'); ?>
                                        </span>
                                    <?php endif; ?>
                                    <<?php echo esc_attr($settings['title_tag']); ?> class="trip-activities-grid-title">
                                        <a href="<?php echo esc_url($term_link); ?>">
                                            <?php echo esc_html($term_name); ?>
                                        </a>
                                    </<?php echo esc_attr($settings['title_tag']); ?>>
                                </div>
                            </div>
                        </div>

                        <!-- Right Side with remaining items -->
                        <div class="col-lg-6">
                            <div class="row <?php echo esc_attr($bootstrap_gap); ?>">
                                <?php
                                // Process next 3 terms for the right side (positions i+1, i+2, i+3)
                                for ($j = 1; $j <= 3; $j++) {
                                    $term_index = $i + $j;
                                    if ($term_index < $terms_count && isset($terms[$term_index])) {
                                        $next_term = $terms[$term_index];
                                        $next_term_link = get_term_link($next_term);
                                        $next_term_name = esc_html($next_term->name);
                                        $next_term_count = intval($next_term->count);
                                        $next_image_id_array = get_term_meta($next_term->term_id, 'category-image-id', true);
                                        $next_image_id = is_array($next_image_id_array) ? reset($next_image_id_array) : $next_image_id_array;
                                        if (empty($next_image_id)) {
                                            $next_image_id = $next_image_id_array; // fallback if not array
                                        }
                                        $next_image_url = $next_image_id ? wp_get_attachment_image_url($next_image_id, 'full') : '';
                                        $next_image_alt = $next_image_id ? get_post_meta($next_image_id, '_wp_attachment_image_alt', true) : $next_term_name;

                                        if ($j == 1) { // Full width item
                                ?>
                                            <div class="col-md-12">
                                                <div class="trip-activities-grid-card">
                                                    <?php if ($next_image_url): ?>
                                                        <img src="<?php echo esc_url($next_image_url); ?>"
                                                            alt="<?php echo esc_attr($next_image_alt); ?>" />
                                                    <?php endif; ?>
                                                    <div class="trip-activities-grid-content">
                                                        <?php if ($settings['enable_trip_counts'] === 'yes'): ?>
                                                            <span class="trip-activities-grid-trip-count">
                                                                <?php echo esc_html('( ' . $next_term_count . ' ' . $settings['trip_count'] . ' )'); ?>
                                                            </span>
                                                        <?php endif; ?>
                                                        <<?php echo esc_attr($settings['title_tag']); ?> class="trip-activities-grid-title">
                                                            <a href="<?php echo esc_url($next_term_link); ?>">
                                                                <?php echo esc_html($next_term_name); ?>
                                                            </a>
                                                        </<?php echo esc_attr($settings['title_tag']); ?>>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php
                                        } else { // Half width items
                                        ?>
                                            <div class="col-md-6">
                                                <div class="trip-activities-grid-card">
                                                    <?php if ($next_image_url): ?>
                                                        <img src="<?php echo esc_url($next_image_url); ?>"
                                                            alt="<?php echo esc_attr($next_image_alt); ?>" />
                                                    <?php endif; ?>
                                                    <div class="trip-activities-grid-content">
                                                        <?php if ($settings['enable_trip_counts'] === 'yes'): ?>
                                                            <span class="trip-activities-grid-trip-count">
                                                                <?php echo esc_html('( ' . $next_term_count . ' ' . $settings['trip_count'] . ' )'); ?>
                                                            </span>

                                                        <?php endif; ?>
                                                        <<?php echo esc_attr($settings['title_tag']); ?> class="trip-activities-grid-title">
                                                            <a href="<?php echo esc_url($next_term_link); ?>">
                                                                <?php echo esc_html($next_term_name); ?>
                                                            </a>
                                                        </<?php echo esc_attr($settings['title_tag']); ?>>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php
                                        }
                                    } else {
                                        if ($j == 1) { // Full width item
                                        ?>
                                            <div class="col-md-12">
                                                <div class="trip-activities-grid-card">
                                                    <div class="trip-activities-grid-content">
                                                        <span>&nbsp;</span>
                                                        <div class="placeholder-text">&nbsp;</div>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php
                                        } else { // Half width items
                                        ?>
                                            <div class="col-md-6">
                                                <div class="trip-activities-grid-card">
                                                    <div class="trip-activities-grid-content">
                                                        <span>&nbsp;</span>
                                                        <div class="placeholder-text">&nbsp;</div>
                                                    </div>
                                                </div>
                                            </div>
                                <?php
                                        }
                                    }
                                }
                                ?>
                            </div>
                        </div>
                    <?php }
                    // End the row div
                    ?>
                </div>
            <?php } // End of loop 
            ?>
        </div>
<?php
    }
}
