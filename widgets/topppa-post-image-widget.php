<?php

use \TopperPack\Includes\Controls\Controls_Manager as TopperPack_Controls_Manager;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

/**
 * Elementor topppa Post Image Widget.
 */
class TOPPPA_Post_image_Widget extends \Elementor\Widget_Base {

    public function get_name() {
        return 'topppa_post_image';
    }

    public function get_title() {
        return TOPPPA_EPWB . esc_html__('Post / CPT Image', 'topper-pack');
    }

    public function get_icon() {
        return 'eicon-image';
    }

    public function get_categories() {
        return ['topper-pack'];
    }

    public function get_keywords() {
        return ['topppa', 'widget', 'image', 'featured', 'post', 'cpt', 'topperpack'];
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
        return 'https://doc.topperpack.com/docs/general-widgets/post-image/';
    }

    protected function register_controls() {

        $this->start_controls_section(
            'post_image_options',
            [
                'label' => esc_html__('Post / CPT Image', 'topper-pack'),
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
        $this->add_control(
            'image_size',
            [
                'label' => esc_html__('Image Size', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'large',
                'options' => $this->topppa_get_available_image_sizes(),
            ]
        );
        $this->add_control(
            'custom_width',
            [
                'label' => esc_html__('Custom Width (px)', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'min' => 10,
                'max' => 3000,
                'step' => 1,
                'condition' => [
                    'image_size' => 'custom',
                ],
            ]
        );

        $this->add_control(
            'custom_height',
            [
                'label' => esc_html__('Custom Height (px)', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'min' => 10,
                'max' => 3000,
                'step' => 1,
                'condition' => [
                    'image_size' => 'custom',
                ],
            ]
        );

        $this->add_responsive_control(
            'image_alignment',
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
                'default' => 'center',
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .topppa-post-image-wrapper' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'caption',
            [
                'label' => esc_html__('Caption', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'none',
                'options' => [
                    'none' => esc_html__('None', 'topper-pack'),
                    'attachment'  => esc_html__('Attachment', 'topper-pack'),
                    'custom' => esc_html__('Custom', 'topper-pack'),
                ],
            ]
        );
        $this->add_control(
            'caption_custom',
            [
                'label' => esc_html__('Custom Caption', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'placeholder' => esc_html__('Custom Caption here', 'topper-pack'),
                'condition' => [
                    'caption' => 'custom',
                ],
            ]
        );
        $this->add_control(
            'links',
            [
                'label' => esc_html__('Link', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'none',
                'options' => [
                    'none' => esc_html__('None', 'topper-pack'),
                    'media'  => esc_html__('Media File', 'topper-pack'),
                    'plink' => esc_html__('Post Link', 'topper-pack'),
                    'custom' => esc_html__('Custom URL', 'topper-pack'),
                ],
            ]
        );
        $this->add_control(
            'custom_link',
            [
                'label' => esc_html__('Custom URL', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::URL,
                'placeholder' => esc_html__('https://your-link.com', 'topper-pack'),
                'options' => ['url', 'is_external', 'nofollow'],
                'default' => [
                    'url' => '',
                    'is_external' => true,
                    'nofollow' => true,
                    // 'custom_attributes' => '',
                ],
                'label_block' => true,
                'condition' => [
                    'links' => 'custom',
                ],
            ]
        );
        $this->add_control(
            'lightbox',
            [
                'label' => esc_html__('Light Box', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'none',
                'options' => [
                    'none' => esc_html__('No', 'topper-pack'),
                    'yes'  => esc_html__('yes', 'topper-pack'),
                ],
                'condition' => [
                    'links' => 'media',
                ],
            ]
        );
        $this->add_control(
            'more_options',
            [
                'label' => esc_html__('This is a placeholder image visible only in the editor. Please set a featured image for the post.', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->end_controls_section();
        $this->start_controls_section(
            'image_box_style',
            [
                'label' => esc_html__('Image', 'topper-pack'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_responsive_control(
            'width',
            [
                'label' => esc_html__('Width', 'topper-pack'),
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
                    '{{WRAPPER}} .topppa-post-image-wrapper img' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'height',
            [
                'label' => esc_html__('Height', 'topper-pack'),
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
                    '{{WRAPPER}} .topppa-post-image-wrapper img' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'tp_image_object',
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
                    '{{WRAPPER}} .topppa-post-image-wrapper img' => 'object-fit: {{VALUE}}',
                ],
            ]
        );
        $this->add_responsive_control(
            'margin',
            [
                'label' => esc_html__('Margin', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} .topppa-post-image-wrapper img' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'padding',
            [
                'label' => esc_html__('Padding', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} .topppa-post-image-wrapper img' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'border',
                'selector' => '{{WRAPPER}} .topppa-post-image-wrapper img',
            ]
        );
        $this->add_responsive_control(
            'border_radius',
            [
                'label' => esc_html__('Border Radius', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} .topppa-post-image-wrapper img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'box_shadow',
                'selector' => '{{WRAPPER}} .topppa-post-image-wrapper img',
            ]
        );
        $this->end_controls_section();
        $this->start_controls_section(
            'caption_style',
            [
                'label' => esc_html__('Caption', 'topper-pack'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'caption_typo',
                'selector' => '{{WRAPPER}} .topppa-post-image-wrapper figcaption',
            ]
        );

        $this->add_responsive_control(
            'caption_color',
            [
                'label' => esc_html__('Text Color', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .topppa-post-image-wrapper figcaption' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'caption_bg',
                'types' => ['classic', 'gradient', 'video'],
                'selector' => '{{WRAPPER}} .topppa-post-image-wrapper figcaption',
            ]
        );
        $this->add_responsive_control(
            'caption_margin',
            [
                'label' => esc_html__('Margin', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} .topppa-post-image-wrapper figcaption' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'caption_padding',
            [
                'label' => esc_html__('Padding', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} .topppa-post-image-wrapper figcaption' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'caption_align',
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
                    '{{WRAPPER}} .topppa-post-image-wrapper figcaption' => 'text-align: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'caption_border',
                'selector' => '{{WRAPPER}} .topppa-post-image-wrapper figcaption',
            ]
        );
        $this->add_responsive_control(
            'caption_radius',
            [
                'label' => esc_html__('Border Radius', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} .topppa-post-image-wrapper figcaption' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();
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
    private function topppa_get_available_image_sizes() {
        global $_wp_additional_image_sizes;

        $sizes = [
            'thumbnail' => esc_html__('Thumbnail', 'topper-pack'),
            'medium' => esc_html__('Medium', 'topper-pack'),
            'large' => esc_html__('Large', 'topper-pack'),
            'full' => esc_html__('Full', 'topper-pack'),
        ];

        $additional_sizes = get_intermediate_image_sizes();

        foreach ($additional_sizes as $size) {
            if (!isset($sizes[$size])) {
                $sizes[$size] = ucfirst(str_replace('_', ' ', $size));
            }
        }

        $sizes['custom'] = esc_html__('Custom Size', 'topper-pack');

        return $sizes;
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        $post_type = $settings['post_type'];
        $is_editor = \Elementor\Plugin::$instance->editor->is_edit_mode();

        $post_id = get_the_ID();

        if (is_singular()) {
            $current_post = get_post($post_id);
            if ($current_post && $current_post->post_type === $post_type) {
                $post = $current_post;
            }
        }

        // If not on a matching singular post, get the latest post of the selected type
        if (!isset($post)) {
            $query = new WP_Query([
                'post_type' => $post_type,
                'posts_per_page' => 1,
            ]);

            if ($query->have_posts()) {
                $query->the_post();
                $post = get_post();
            }
        }

        // Start the image wrapper
        echo '<div class="topppa-post-image-wrapper">';

        if (isset($post) && has_post_thumbnail($post->ID)) {
            $image_size = $settings['image_size'];

            // Handle custom image size
            if ($image_size === 'custom' && !empty($settings['custom_width']) && !empty($settings['custom_height'])) {
                $image_size = [$settings['custom_width'], $settings['custom_height']];
            }

            $image_html = get_the_post_thumbnail($post->ID, $image_size, ['class' => 'topppa-featured-image']);

            if ('none' !== $settings['caption']) {
                echo '<figure class="wp-caption">';
            }

            // Handle the link functionality
            if ('media' === $settings['links']) {
                // Get the URL for the featured image (media file)
                $image_link = wp_get_attachment_url(get_post_thumbnail_id($post->ID));

                // Apply Lightbox if enabled
                $lightbox_attr = ('yes' === $settings['lightbox']) ? 'data-elementor-open-lightbox="yes"' : 'data-elementor-open-lightbox="no"';

                echo '<a href="' . esc_url($image_link) . '" class="topppa-lightbox-image" ' . esc_attr($lightbox_attr) . '>' . wp_kses_post($image_html) . '</a>';
            } elseif ('custom' === $settings['links'] && !empty($settings['custom_link']['url'])) {
                if (! empty($settings['custom_link']['url'])) {
                    $this->add_link_attributes('custom_link', $settings['custom_link']);
                }
                ?>
                <a <?php $this->print_render_attribute_string('custom_link'); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- Already escaped by elementor 
                    ?>><?php echo wp_kses_post($image_html); ?></a>
                <?php
            } elseif ('plink' === $settings['links']) {
                echo '<a href="' . esc_url(get_permalink()) . '">' . wp_kses_post($image_html) . '</a>';
            } else {
                echo wp_kses_post($image_html);
            }

            if ('attachment' === $settings['caption']) {
                echo '<figcaption>' . esc_html(get_the_post_thumbnail_caption()) . '</figcaption>';
            } elseif ('custom' === $settings['caption'] && !empty($settings['caption_custom'])) {
                echo '<figcaption>' . esc_html($settings['caption_custom']) . '</figcaption>';
            }

            if ('none' !== $settings['caption']) {
                echo '</figure>';
            }
        } elseif ($is_editor) {
            echo '<img src="' . esc_url(plugins_url('assets/images/fallback.webp', dirname(__FILE__))) . '" class="topppa-featured-image editor-placeholder" alt="' . esc_attr__('Placeholder Image', 'topper-pack') . '">'; // phpcs:ignore PluginCheck.CodeAnalysis.ImageFunctions.NonEnqueuedImage
        }
        echo '</div>';
        if (isset($query)) {
            wp_reset_postdata();
        }
    }
}