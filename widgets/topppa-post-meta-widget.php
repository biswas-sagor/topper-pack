<?php

use \TopperPack\Includes\Controls\Controls_Manager as TopperPack_Controls_Manager;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

/**
 * Elementor topppa Post Image Widget.
 */
class TOPPPA_Post_meta_Widget extends \Elementor\Widget_Base {

    public function get_name() {
        return 'topppa_post_meta';
    }

    public function get_title() {
        return TOPPPA_EPWB . esc_html__('Post / CPT Meta', 'topper-pack');
    }

    public function get_icon() {
        return 'eicon-image';
    }

    public function get_categories() {
        return ['topper-pack'];
    }

    public function get_keywords() {
        return ['topppa', 'widget', 'meta', 'category', 'metabox', 'post', 'cpt', 'topperpack'];
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
		return 'https://doc.topperpack.com/docs/general-widgets/post-meta/';
	}

    protected function register_controls() {

        $this->start_controls_section(
            'post_meta_options',
            [
                'label' => esc_html__('Post / CPT Meta', 'topper-pack'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'post_type',
            [
                'label' => esc_html__('Select Post Type', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'post',
                'options' => $this->topppa_get_available_post_types(),
            ]
        );
        $info = new \Elementor\Repeater();
        $info->add_control(
            'type',
            [
                'label' => esc_html__('Type', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'author',
                'options' => [
                    'author' => esc_html__('Author', 'topper-pack'),
                    'date' => esc_html__('Date', 'topper-pack'),
                    'time' => esc_html__('Time', 'topper-pack'),
                    'comments' => esc_html__('Comments', 'topper-pack'),
                    'taxonomy' => esc_html__('Taxonomy', 'topper-pack'),
                ],
            ]
        );
        // Author info
        $info->add_control(
            'name_type',
            [
                'label' => __('Name Type', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'nickname',
                'options' => [
                    'nickname' => __('Nickname', 'topper-pack'),
                    'user_nicename' => __('Username', 'topper-pack'),
                    'display_name' => __('Display Name', 'topper-pack'),
                    'first_name' => __('First Name', 'topper-pack'),
                    'last_name' => __('Last Name', 'topper-pack'),
                    'full_name' => __('Full Name', 'topper-pack'),
                ],
                'condition' => [
                    'type' => 'author',
                ],
            ]
        );
        $info->add_control(
            'taxonomy',
            [
                'label' => __('Taxonomy', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::SELECT2,
                'label_block' => true,
                'default' => [],
                'options' => $this->getTaxonomies(),
                'condition' => [
                    'type' => 'taxonomy',
                ],
            ]
        );
        $info->add_control(
            'disply_taxonomy',
            [
                'label' => esc_html__('Display Taxonomy', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'min' => 1,
                'max' => 20,
                'step' => 1,
                'default' => 1,
                'condition' => [
                    'type' => 'taxonomy',
                ],
            ]
        );

        $info->add_control(
            'show_icon',
            [
                'label' => __('Show Icon', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'default' => 'yes',
                'label_on' => __('Yes', 'topper-pack'),
                'label_off' => __('No', 'topper-pack'),
                'return_value' => 'yes',
            ]
        );
        $info->add_control(
            'show_avatar',
            [
                'label' => __('Show Avatar', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'default' => '',
                'label_on' => __('Yes', 'topper-pack'),
                'label_off' => __('No', 'topper-pack'),
                'return_value' => 'yes',
                'condition' => [
                    'show_icon' => 'yes',
                    'type' => 'author',
                ],
            ]
        );
        $info->add_control(
            'icon',
            [
                'label' => __('Icon', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::ICONS,
                'condition' => [
                    'show_icon' => 'yes',
                    'show_avatar' => '',
                ],
            ]
        );
        $info->add_control(
            'show_link_author',
            [
                'label' => __('Show Link', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'default' => '',
                'label_on' => __('Yes', 'topper-pack'),
                'label_off' => __('No', 'topper-pack'),
                'return_value' => 'yes',
                'condition' => [
                    'type' => 'author',
                ],
            ]
        );

        $info->add_control(
            'show_link_taxonomy',
            [
                'label' => __('Show Link', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'default' => '',
                'label_on' => __('Yes', 'topper-pack'),
                'label_off' => __('No', 'topper-pack'),
                'return_value' => 'yes',
                'condition' => [
                    'type' => 'taxonomy',
                ],
            ]
        );
        $info->add_control(
            'show_link_comments',
            [
                'label' => __('Link to comments', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'default' => '',
                'label_on' => __('Yes', 'topper-pack'),
                'label_off' => __('No', 'topper-pack'),
                'return_value' => 'yes',
                'condition' => [
                    'type' => 'comments',
                ],
            ]
        );
        $info->add_control(
            'text_before',
            [
                'label' => __('Before', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => '',
            ]
        );
        $info->add_control(
            'text_after',
            [
                'label' => __('After', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => '',
            ]
        );


        $this->add_control(
            'lists',
            [
                'label'   => esc_html__('Logo List', 'topper-pack'),
                'type'    => \Elementor\Controls_Manager::REPEATER,
                'fields'  => $info->get_controls(),
                'title_field' => '<span style="text-transform: capitalize;">{{{ type }}}</span>',
                'default' => [
                    [
                        'type' => 'author',
                        'icon' => [
                            'value' => 'fas fa-user',
                            'library' => 'fa-solid',
                        ]
                    ],
                    [
                        'type' => 'date',
                        'icon' => [
                            'value' => 'fas fa-calendar',
                            'library' => 'fa-solid',
                        ]
                    ],
                    [
                        'type' => 'comments',
                        'icon' => [
                            'value' => 'fas fa-comment',
                            'library' => 'fa-solid',
                        ]
                    ],
                ],
            ]
        );
        $this->end_controls_section();

        $this->start_controls_section(
            'genarel_style',
            [
                'label' => esc_html__('General', 'topper-pack'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_responsive_control(
            'item_space',
            [
                'label' => esc_html__('Item Space', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
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
                'selectors' => [
                    '{{WRAPPER}} .topppa-post-meta__wrapper' => 'gap: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'icon_space',
            [
                'label' => esc_html__('Icon Space', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
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
                'selectors' => [
                    '{{WRAPPER}} .topppa-post-meta__item' => 'gap: {{SIZE}}{{UNIT}};',
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
                    '{{WRAPPER}} .topppa-post-meta__wrapper' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                    '{{WRAPPER}} .topppa-post-meta__wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'align',
            [
                'label' => esc_html__('Alignment', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'flex-start' => [
                        'title' => esc_html__('Left', 'topper-pack'),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__('Center', 'topper-pack'),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'flex-end' => [
                        'title' => esc_html__('Right', 'topper-pack'),
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'default' => 'flex-start',
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .topppa-post-meta__wrapper' => 'justify-content: {{VALUE}};',
                ],
            ]
        );
        $this->end_controls_section();
        $this->start_controls_section(
            'avastar_style  ',
            [
                'label' => esc_html__('Avatar', 'topper-pack'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_responsive_control(
            'avatar_size',
            [
                'label' => esc_html__('Size', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
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
                'selectors' => [
                    '{{WRAPPER}} .topppa-post-meta__icon img' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'avastar_radius',
            [
                'label' => esc_html__('Radius', 'topper-pack'),
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
                'default' => [
                    'unit' => '%',
                    'size' => 50,
                ],
                'selectors' => [
                    '{{WRAPPER}} .topppa-post-meta__icon img' => 'border-radius: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();
        $this->start_controls_section(
            'text_style',
            [
                'label' => esc_html__('Text', 'topper-pack'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'text_typography',
                'label' => esc_html__('Typography', 'topper-pack'),
            ]
        );
        $this->add_responsive_control(
            'text_color',
            [
                'label' => esc_html__('Text Color', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .topppa-post-meta__content' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_responsive_control(
            'link_color',
            [
                'label' => esc_html__('Link Color', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .topppa-post-meta__content a' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_responsive_control(
            'link_hover_color',
            [
                'label' => esc_html__('Link Hover Color', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .topppa-post-meta__content a:hover' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->end_controls_section();
        $this->start_controls_section(
            'before_style',
            [
                'label' => esc_html__('Before Text', 'topper-pack'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'before_typography',
                'label' => esc_html__('Typography', 'topper-pack'),
            ]
        );
        $this->add_responsive_control(
            'before_color',
            [
                'label' => esc_html__('Text Color', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .topppa-post-meta__before' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->end_controls_section();
        $this->start_controls_section(
            'after_style',
            [
                'label' => esc_html__('After Text', 'topper-pack'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'after_typography',
                'label' => esc_html__('Typography', 'topper-pack'),
            ]
        );
        $this->add_responsive_control(
            'after_color',
            [
                'label' => esc_html__('Text Color', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .topppa-post-meta__after' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->end_controls_section();
        $this->start_controls_section(
            'icon_style',
            [
                'label' => esc_html__('Icon', 'topper-pack'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_responsive_control(
            'icon_width',
            [
                'label' => esc_html__('icon Width', 'topper-pack'),
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
                    '{{WRAPPER}} .topppa-post-meta__icon' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'icon_color',
            [
                'label' => esc_html__('Color', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .topppa-post-meta__icon' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'icon_bg_color',
                'types' => ['classic', 'gradient', 'video'],
                'selector' => '{{WRAPPER}} .topppa-post-meta__icon',
            ]
        );
        $this->add_responsive_control(
            'icon_size',
            [
                'label' => esc_html__('Size', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                        'step' => 1,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .topppa-post-meta__icon' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'icon_margin',
            [
                'label' => esc_html__('Margin', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} .topppa-post-meta__icon' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'icon_padding',
            [
                'label' => esc_html__('Padding', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} .topppa-post-meta__icon' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'icon_radius',
            [
                'label' => esc_html__('Radius', 'topper-pack'),
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
                    '{{WRAPPER}} .topppa-post-meta__icon' => 'border-radius: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'icon_align',
            [
                'label' => esc_html__('Alignment', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'flex-start' => [
                        'title' => esc_html__('Left', 'topper-pack'),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__('Center', 'topper-pack'),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'flex-end' => [
                        'title' => esc_html__('Right', 'topper-pack'),
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'default' => 'flex-start',
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .topppa-post-meta__icon' => 'justify-content: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'icon_shadow',
                'selector' => '{{WRAPPER}} .topppa-post-meta__icon',
            ]
        );
        $this->end_controls_section();
    }
    protected function getTaxonomies() {
        $taxonomies = get_taxonomies([
            'show_in_nav_menus' => true,
        ], 'objects');

        $options = [
            '' => __('Select', 'topper-pack'),
        ];

        foreach ($taxonomies as $taxonomy) {
            $options[$taxonomy->name] = $taxonomy->label;
        }

        return $options;
    }
    /**
     * Get available post types for selection.
     */
    protected function topppa_get_available_post_types() {
        $post_types = get_post_types(['public' => true], 'objects');
        $exclude = ['elementor_library', 'e-floating-buttons', 'topppa-theme-builder', 'attachment']; // phpcs:ignore WordPressVIPMinimum.Performance.WPQueryParams.PostNotIn_exclude

        $options = [];
        foreach ($post_types as $post_type) {
            if (!in_array($post_type->name, $exclude)) {
                $options[$post_type->name] = $post_type->label;
            }
        }
        return $options;
    }


    protected function render() {
        $settings = $this->get_settings_for_display();
        $post_type = $settings['post_type'];
        $lists = $settings['lists'];

        // Get the latest post of the selected post type
        $query = new WP_Query([
            'post_type' => $post_type,
            'posts_per_page' => 1,
        ]);

        if ($query->have_posts()) {
            $query->the_post();
            global $post;

            echo '<div class="topppa-post-meta__wrapper">';

            foreach ($lists as $item) {
                echo '<div class="topppa-post-meta__item">';

                // Show icon if enabled
                if ($item['show_icon'] === 'yes') {
                    echo '<div class="topppa-post-meta__icon">';
                    if ($item['type'] === 'author' && $item['show_avatar'] === 'yes') {
                        echo get_avatar(get_the_author_meta('ID'), 96);
                    } elseif (!empty($item['icon']['value'])) {
                        \Elementor\Icons_Manager::render_icon($item['icon'], ['aria-hidden' => 'true']);
                    }
                    echo '</div>';
                }

                // Show before text
                if (!empty($item['text_before'])) {
                    echo '<div class="topppa-post-meta__before">' . esc_html($item['text_before']) . '</div>';
                }

                echo '<div class="topppa-post-meta__content">';

                // Handle different types of meta
                switch ($item['type']) {
                    case 'author':
                        $author_id = get_the_author_meta('ID');
                        $author_name = $this->get_author_name($author_id, $item['name_type']);
                        if ($item['show_link_author'] === 'yes') {
                            echo '<a href="' . esc_url(get_author_posts_url($author_id)) . '">' . esc_html($author_name) . '</a>';
                        } else {
                            echo esc_html($author_name);
                        }
                        break;

                    case 'date':
                        echo esc_html(get_the_date());
                        break;

                    case 'time':
                        echo esc_html(get_the_time());
                        break;

                    case 'comments':
                        $comments_number = get_comments_number();
                        if ($item['show_link_comments'] === 'yes') {
                            echo '<a href="' . esc_url(get_comments_link()) . '">' . esc_html($comments_number) . ' ' . esc_html(_n('Comment', 'Comments', $comments_number, 'topper-pack')) . '</a>';
                        } else {
                            echo esc_html($comments_number) . ' ' . esc_html(_n('Comment', 'Comments', $comments_number, 'topper-pack'));
                        }
                        break;

                    case 'taxonomy':
                        if (!empty($item['taxonomy'])) {
                            $terms = get_the_terms($post->ID, $item['taxonomy']);
                            if ($terms && !is_wp_error($terms)) {
                                $term_links = array();
                                // Get the display limit from settings
                                $display_limit = $item['disply_taxonomy'];
                                // Slice the terms array to limit the number of terms
                                $terms = array_slice($terms, 0, $display_limit);

                                foreach ($terms as $term) {
                                    if ($item['show_link_taxonomy'] === 'yes') {
                                        $term_links[] = '<a href="' . esc_url(get_term_link($term)) . '">' . esc_html($term->name) . '</a>';
                                    } else {
                                        $term_links[] = esc_html($term->name);
                                    }
                                }
                                echo wp_kses_post(implode(', ', $term_links));
                            }
                        }
                        break;
                }

                echo '</div>';

                // Show after text
                if (!empty($item['text_after'])) {
                    echo '<div class="topppa-post-meta__after">' . esc_html($item['text_after']) . '</div>';
                }

                echo '</div>';
            }

            echo '</div>';
        }
        wp_reset_postdata();
    }

    /**
     * Get author name based on name type
     */
    private function get_author_name($author_id, $name_type) {
        switch ($name_type) {
            case 'nickname':
                return get_the_author_meta('nickname', $author_id);
            case 'user_nicename':
                return get_the_author_meta('user_nicename', $author_id);
            case 'display_name':
                return get_the_author_meta('display_name', $author_id);
            case 'first_name':
                return get_the_author_meta('first_name', $author_id);
            case 'last_name':
                return get_the_author_meta('last_name', $author_id);
            case 'full_name':
                // translators: %s is the first name, %s is the last name
                return sprintf(
                    '%s %s',
                    get_the_author_meta('first_name', $author_id),
                    get_the_author_meta('last_name', $author_id)
                );
            default:
                return get_the_author_meta('display_name', $author_id);
        }
    }
}
