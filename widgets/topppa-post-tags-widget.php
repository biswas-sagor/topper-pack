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
class TOPPPA_Post_Tags_Widget extends \Elementor\Widget_Base {

    /**
     * Cached taxonomies for post types
     */
    private $cached_taxonomies = [];

    /**
     * Constructor to register AJAX handlers and scripts
     */
    public function __construct($data = [], $args = null) {
        parent::__construct($data, $args);
    }

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
        return 'topppa_post_tags';
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
        return TOPPPA_EPWB . esc_html__('Post Tags/Categories', 'topper-pack');
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
        return 'eicon-meta-data';
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
        return ['topppa', 'widget', 'tag', 'category', 'post', 'topperpack'];
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
        return 'https://doc.topperpack.com/docs/general-widgets/post-tags/';
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
            'tags_section',
            [
                'label' => esc_html__('Tags Options', 'topper-pack'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        // Post Type dropdown
        $post_types = $this->get_available_post_types();
        $this->add_control(
            'post_type',
            [
                'label' => esc_html__('Select Post Type', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'post',
                'options' => $post_types,
            ]
        );

        // Create taxonomy dropdowns for each post type
        $this->add_taxonomy_controls($post_types);

        // Add common controls
        $this->add_common_controls();

        $this->end_controls_section();

        /**
         * start additional section
         *
         * @since 1.0.0
         * @access protected
         */
        $this->start_controls_section(
            'additional_section',
            [
                'label' => esc_html__('Additional Options', 'topper-pack'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_responsive_control(
            'item_dissrection',
            [
                'label' => esc_html__('Item Dissrection', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    '' => esc_html__('Default', 'topper-pack'),
                    'row' => esc_html__('Row', 'topper-pack'),
                    'column' => esc_html__('Column', 'topper-pack'),
                    'row-reverse'  => esc_html__('Row Reverse', 'topper-pack'),
                    'column-reverse' => esc_html__('Column Reverse', 'topper-pack'),
                ],
                'selectors' => [
                    '{{WRAPPER}} .topppa-post-tags-wrapper  .topppa-post-tag-item,{{WRAPPER}} .topppa-post-tags-wrapper .topppa-post-tag-inner' => 'flex-direction: {{VALUE}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'item_align',
            [
                'label' => esc_html__('Item Align', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'flex-start' => [
                        'title' => esc_html__('Left', 'topper-pack'),
                        'icon' => 'eicon-align-start-h',
                    ],
                    'center' => [
                        'title' => esc_html__('Center', 'topper-pack'),
                        'icon' => 'eicon-align-center-h',
                    ],
                    'flex-end' => [
                        'title' => esc_html__('Right', 'topper-pack'),
                        'icon' => 'eicon-align-end-h',
                    ],
                    'stretch' => [
                        'title' => esc_html__('Stretch', 'topper-pack'),
                        'icon' => 'eicon-justify-space-between-h',
                    ],
                    'baseline' => [
                        'title' => esc_html__('Baseline', 'topper-pack'),
                        'icon' => 'eicon-undo',
                    ],
                ],
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .topppa-post-tags-wrapper  .topppa-post-tag-item,{{WRAPPER}} .topppa-post-tags-wrapper .topppa-post-tag-inner' => 'align-items: {{VALUE}};',
                ],
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
            'general_style',
            [
                'label' => esc_html__('General Style', 'topper-pack'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'item_gap',
            [
                'label' => esc_html__('Item Gap', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                        'step' => 5,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .topppa-post-tag-item' => 'gap: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'item_width',
            [
                'label' => esc_html__('Item Width', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => '',
                'options' => [
                    '' => esc_html__('Default', 'topper-pack'),
                    'auto' => esc_html__('Auto', 'topper-pack'),
                    'fit-content'  => esc_html__('Fit Content', 'topper-pack'),
                    'max-content' => esc_html__('Max Content', 'topper-pack'),
                    'min-content' => esc_html__('Min Content', 'topper-pack'),
                    'custom' => esc_html__('Custom', 'topper-pack'),
                ],
                'selectors' => [
                    '{{WRAPPER}} .topppa-post-tag-inner .topppa-post-tag-item' => 'width: {{VALUE}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'custom_width',
            [
                'label' => esc_html__('Custom Width', 'topper-pack'),
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
                    'unit' => '%',
                    'size' => 100,
                ],
                'selectors' => [
                    '{{WRAPPER}} .topppa-post-tag-inner .topppa-post-tag-item' => 'width: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'item_width' => 'custom',
                ],
            ]
        );
        $this->add_responsive_control(
            'box_margin',
            [
                'label' => esc_html__('Box Margin', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} .topppa-post-tag-inner' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'box_padding',
            [
                'label' => esc_html__('Box Padding', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} .topppa-post-tag-inner' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
        $this->start_controls_section(
            'title_style',
            [
                'label' => esc_html__('Title Style', 'topper-pack'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_responsive_control(
            'title_color',
            [
                'label' => esc_html__('Title Color', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .topppa-post-tag-title' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'selector' => '{{WRAPPER}} .topppa-post-tag-title',
            ]
        );
        $this->add_responsive_control(
            'title_gap',
            [
                'label' => esc_html__('Title Gap', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                        'step' => 5,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .topppa-post-tags-wrapper .topppa-post-tag-inner' => 'gap: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();
        $this->start_controls_section(
            'item_style',
            [
                'label' => esc_html__('Item Style', 'topper-pack'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'item_typography',
                'selector' => '{{WRAPPER}} .topppa-post-tag-item a',
            ]
        );
        $this->add_responsive_control(
            'item_margin',
            [
                'label' => esc_html__('Margin', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} .topppa-post-tag-item a' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'item_padding',
            [
                'label' => esc_html__('Padding', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} .topppa-post-tag-item a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
        $this->add_responsive_control(
            'item_color',
            [
                'label' => esc_html__('Text Color', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .topppa-post-tag-item a' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'item_background',
                'types' => ['classic', 'gradient', 'video'],
                'selector' => '{{WRAPPER}} .topppa-post-tag-item a',
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'item_border',
                'selector' => '{{WRAPPER}} .topppa-post-tag-item a',
            ]
        );
        $this->add_responsive_control(
            'border_radius',
            [
                'label' => esc_html__('Border Radius', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} .topppa-post-tag-item a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'item_box_shadow',
                'selector' => '{{WRAPPER}} .topppa-post-tag-item a',
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'style_hover_tab',
            [
                'label' => esc_html__('Hover', 'topper-pack'),
            ]
        );
        $this->add_responsive_control(
            'item_hover_color',
            [
                'label' => esc_html__('Text Color', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .topppa-post-tag-item a:hover' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'item_hover_background',
                'types' => ['classic', 'gradient', 'video'],
                'selector' => '{{WRAPPER}} .topppa-post-tag-item a:hover',
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'item_hover_border',
                'selector' => '{{WRAPPER}} .topppa-post-tag-item a:hover',
            ]
        );
        $this->add_responsive_control(
            'item_hover_border_radius',
            [
                'label' => esc_html__('Border Radius', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} .topppa-post-tag-item a:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'item_hover_box_shadow',
                'selector' => '{{WRAPPER}} .topppa-post-tag-item a:hover',
            ]
        );
        $this->end_controls_tab();

        $this->end_controls_tabs();
        $this->end_controls_section();
    }

    /**
     * Add taxonomy controls for each post type
     *
     * @param array $post_types Available post types
     */
    private function add_taxonomy_controls($post_types) {
        foreach ($post_types as $post_type_key => $post_type_label) {
            $taxonomies = $this->get_post_type_taxonomies($post_type_key);

            if (empty($taxonomies)) {
                continue; // Skip if no taxonomies
            }

            $this->add_control(
                'taxonomy_' . $post_type_key,
                [
                    'label' => esc_html__('Taxonomy Type', 'topper-pack'),
                    'type' => \Elementor\Controls_Manager::SELECT,
                    'default' => array_key_first($taxonomies),
                    'options' => $taxonomies,
                    'condition' => [
                        'post_type' => $post_type_key,
                    ],
                ]
            );
        }
    }

    /**
     * Add common widget controls
     */
    private function add_common_controls() {
        $this->add_control(
            'show_label',
            [
                'label' => esc_html__('Show Label', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'default' => 'yes',
            ]
        );
        $this->add_control(
            'custom_label',
            [
                'label' => esc_html__('Custom Label', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => '',
                'condition' => [
                    'show_label' => 'yes',
                ],
            ]
        );
        $this->add_control(
            'show_icon',
            [
                'label' => esc_html__('Show Icon', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'icon',
            [
                'label' => esc_html__('Icon', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::ICONS,
                'default' => [
                    'value' => 'fas fa-tag',
                    'library' => 'fa-solid',
                ],
                'condition' => [
                    'show_icon' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'show_count',
            [
                'label' => esc_html__('Show Count', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'default' => 'no',
            ]
        );

        $this->add_control(
            'max_items',
            [
                'label' => esc_html__('Maximum Items', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'default' => 0,
                'min' => 0,
                'description' => esc_html__('Set 0 to show all items', 'topper-pack'),
            ]
        );

        $this->add_control(
            'note',
            [
                'label' => esc_html__('This Default Content is for the Elementor Editor for easy to edit the style.', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
    }

    /**
     * Get available post types for selection.
     * 
     * @return array Array of post types
     */
    private function get_available_post_types() {
        static $cached_post_types = null;

        // Return cached result if available
        if ($cached_post_types !== null) {
            return $cached_post_types;
        }

        $post_types = get_post_types(['public' => true], 'objects');
        $exclude = ['elementor_library', 'e-floating-buttons', 'topppa-theme-builder', 'attachment']; // phpcs:ignore WordPressVIPMinimum.Performance.WPQueryParams.PostNotIn_exclude

        $options = [];
        foreach ($post_types as $post_type) {
            if (!in_array($post_type->name, $exclude)) {
                $options[$post_type->name] = $post_type->label;
            }
        }

        $cached_post_types = $options;
        return $options;
    }

    /**
     * Get post type specific taxonomies.
     * 
     * @param string $post_type Post type name
     * @return array Taxonomies for the post type
     */
    private function get_post_type_taxonomies($post_type) {
        // Return from cache if available
        if (isset($this->cached_taxonomies[$post_type])) {
            return $this->cached_taxonomies[$post_type];
        }

        if (empty($post_type)) {
            $post_type = 'post';
        }

        $taxonomies = get_object_taxonomies($post_type, 'objects');
        $options = [];

        foreach ($taxonomies as $taxonomy) {
            if ($taxonomy->show_ui) {
                $options[$taxonomy->name] = $taxonomy->label;
            }
        }

        // If no taxonomies found, provide defaults
        if (empty($options)) {
            if ($post_type === 'post') {
                $options = [
                    'category' => __('Categories', 'topper-pack'),
                    'post_tag' => __('Tags', 'topper-pack')
                ];
            }
        }

        // Cache the result
        $this->cached_taxonomies[$post_type] = $options;

        return $options;
    }

    /**
     * Render the widget in Elementor editor
     */
    private function render_editor_content($settings) {
        $post_type = $settings['post_type'];
        $taxonomy_key = 'taxonomy_' . $post_type;
        $taxonomy = !empty($settings[$taxonomy_key]) ? $settings[$taxonomy_key] : 'post_tag';

        echo '<div class="topppa-post-tags-wrapper">';
        echo '<div class="topppa-post-tag-inner">';

        if ($settings['show_label'] === 'yes') {
            echo '<div class="topppa-post-tag-title">';

            // Check if custom label is provided
            if (!empty($settings['custom_label'])) {
                $label = $settings['custom_label'];
            } else {
                $taxonomy_obj = get_taxonomy($taxonomy);
                $label = $taxonomy_obj ? $taxonomy_obj->label : __('Tags', 'topper-pack');
            }

            echo '<span>' . esc_html($label) . ':</span>';
            echo '</div>';
        }

        echo '<div class="topppa-post-tag-item">';

        // Demo tags with icons and count
        $demo_tags = ['Design', 'Development', 'WordPress'];
        foreach ($demo_tags as $tag) {
            echo '<a href="#">';

            if ($settings['show_icon'] === 'yes') {
                \Elementor\Icons_Manager::render_icon($settings['icon'], ['aria-hidden' => 'true']);
            }

            echo esc_html($tag);

            if ($settings['show_count'] === 'yes') {
                echo '<span class="tag-count">(5)</span>';
            }

            echo '</a>';
        }

        echo '</div>';
        echo '</div>';
        echo '</div>';
    }

    /**
     * Render front-end content
     */
    private function render_frontend_content($settings) {
        // Get the selected post type and corresponding taxonomy
        $post_type = $settings['post_type'];
        $taxonomy_key = 'taxonomy_' . $post_type;
        $taxonomy = !empty($settings[$taxonomy_key]) ? $settings[$taxonomy_key] : 'post_tag';

        // Get current post data
        $current_post_id = get_the_ID();
        $current_post_type = get_post_type($current_post_id);

        // Exit if not matching the selected post type
        if ($current_post_type !== $post_type) {
            return;
        }

        // Check if the taxonomy exists for this post type
        if (!taxonomy_exists($taxonomy) || !is_object_in_taxonomy($current_post_type, $taxonomy)) {
            return;
        }

        // Get terms for the current post
        $terms = get_the_terms($current_post_id, $taxonomy);

        // Exit if no terms or error
        if (!$terms || is_wp_error($terms) || empty($terms)) {
            return;
        }

        // Apply max items limit if set
        if ($settings['max_items'] > 0) {
            $terms = array_slice($terms, 0, $settings['max_items']);
        }

        // Get taxonomy label (custom or default)
        if (!empty($settings['custom_label'])) {
            $taxonomy_label = $settings['custom_label'];
        } else {
            // Get taxonomy object for label
            $taxonomy_obj = get_taxonomy($taxonomy);
            $taxonomy_label = $taxonomy_obj ? $taxonomy_obj->labels->name : '';
        }

        // Output the terms
        echo '<div class="topppa-post-tags-wrapper">';
        echo '<div class="topppa-post-tag-inner">';

        if ($settings['show_label'] === 'yes') {
            echo '<div class="topppa-post-tag-title">';
            echo '<span>' . esc_html($taxonomy_label) . ':</span>';
            echo '</div>';
        }

        echo '<div class="topppa-post-tag-item">';
        foreach ($terms as $term) {
            echo '<a href="' . esc_url(get_term_link($term)) . '">';

            if ($settings['show_icon'] === 'yes') {
                \Elementor\Icons_Manager::render_icon($settings['icon'], ['aria-hidden' => 'true']);
            }

            echo esc_html($term->name);

            if ($settings['show_count'] === 'yes') {
                echo '<span class="tag-count">(' . esc_html($term->count) . ')</span>';
            }

            echo '</a>';
        }
        echo '</div>';

        echo '</div>';
        echo '</div>';
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

        // Handle Elementor editor mode differently
        if (\Elementor\Plugin::$instance->editor->is_edit_mode()) {
            $this->render_editor_content($settings);
            return;
        }

        // Render the actual front-end content
        $this->render_frontend_content($settings);
    }
}