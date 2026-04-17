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
class TOPPPA_Post_Share_Widget extends \Elementor\Widget_Base {

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
        return 'topppa_post_share';
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
        return TOPPPA_EPWB . esc_html__('Post Share', 'topper-pack');
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
        return 'eicon-share';
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
        return ['topppa', 'widget', 'share', 'post', 'topperpack'];
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
        return 'https://doc.topperpack.com/docs/general-widgets/post-share/';
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
            'content_section',
            [
                'label' => esc_html__('Share Options', 'topper-pack'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_control(
            'share_title',
            [
                'label' => esc_html__('Title', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Share', 'topper-pack'),
            ]
        );
        $this->add_control(
            'share_media',
            [
                'label' => esc_html__('Share Media', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::SELECT2,
                'label_block' => true,
                'multiple' => true,
                'options' => [
                    'facebook' => esc_html__('Facebook', 'topper-pack'),
                    'twitter' => esc_html__('Twitter', 'topper-pack'),
                    'linkedin' => esc_html__('LinkedIn', 'topper-pack'),
                    'pinterest' => esc_html__('Pinterest', 'topper-pack'),
                    'email' => esc_html__('Email', 'topper-pack'),
                    'whatsapp' => esc_html__('WhatsApp', 'topper-pack'),
                    'telegram' => esc_html__('Telegram', 'topper-pack'),
                    'reddit' => esc_html__('Reddit', 'topper-pack'),
                ],
                'default' => ['facebook', 'twitter', 'linkedin'],
            ]
        );

        $this->add_control(
            'show_label',
            [
                'label' => esc_html__('Show Label', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', 'topper-pack'),
                'label_off' => esc_html__('Hide', 'topper-pack'),
                'default' => 'yes',
            ]
        );
        $this->add_control(
            'enable_official_color',
            [
                'label' => esc_html__('Official Colors', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'topper-pack'),
                'label_off' => esc_html__('No', 'topper-pack'),
                'default' => 'yes',
            ]
        );
        $this->add_control(
            'hover_effect',
            [
                'label' => esc_html__('Hover Effect', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'float',
                'options' => [
                    'none' => esc_html__('None', 'topper-pack'),
                    'float' => esc_html__('Float', 'topper-pack'),
                    'scale' => esc_html__('Scale', 'topper-pack'),
                    'shake' => esc_html__('Shake', 'topper-pack'),
                    'rotate' => esc_html__('Rotate', 'topper-pack'),
                    'shine' => esc_html__('Shine', 'topper-pack'),
                    'pulse' => esc_html__('Pulse', 'topper-pack'),
                    'bounce' => esc_html__('Bounce', 'topper-pack'),
                    'glitch' => esc_html__('Glitch', 'topper-pack'),
                    'flip' => esc_html__('Flip', 'topper-pack'),
                    'ripple' => esc_html__('Ripple', 'topper-pack'),
                    'swing' => esc_html__('Swing', 'topper-pack'),
                    '3d' => esc_html__('3D', 'topper-pack'),
                    'neon' => esc_html__('Neon', 'topper-pack'),
                    'reveal' => esc_html__('Reveal', 'topper-pack'),
                    'bubble' => esc_html__('Bubble', 'topper-pack'),
                ],
            ]
        );
        $this->end_controls_section();

        $this->start_controls_section(
            'general_style',
            [
                'label' => esc_html__('General Style', 'topper-pack'),
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
                        'max' => 50,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .topppa-post-share .topppa-share-items' => 'gap: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'item_alignment',
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
                'selectors' => [
                    '{{WRAPPER}} .topppa-post-share' => 'justify-content: {{VALUE}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'item_margin',
            [
                'label' => esc_html__('Margin', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} .topppa-post-share' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                    '{{WRAPPER}} .topppa-post-share' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                'label' => esc_html__('Color', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .topppa-share-title' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'selector' => '{{WRAPPER}} .topppa-share-title',
            ]
        );
        $this->add_responsive_control(
            'title_gap',
            [
                'label' => esc_html__('Gap', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 50,
                        'step' => 5,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .topppa-post-share' => 'gap: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'title_margin',
            [
                'label' => esc_html__('Margin', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} .topppa-share-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'title_padding',
            [
                'label' => esc_html__('Padding', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} .topppa-share-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();

        // Style Section
        $this->start_controls_section(
            'icon_style',
            [
                'label' => esc_html__('Icon Style', 'topper-pack'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_responsive_control(
            'icon_alignment',
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
                'default' => 'center',
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .topppa-post-share .topppa-share-items .topppa-share-item' => 'justify-content: {{VALUE}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'button_width',
            [
                'label' => esc_html__('Width', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 150,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .topppa-share-item' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'button_height',
            [
                'label' => esc_html__('Height', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 150,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .topppa-post-share .topppa-share-items .topppa-share-item' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'button_border',
                'selector' => '{{WRAPPER}} .topppa-post-share .topppa-share-items .topppa-share-item',
            ]
        );
        $this->add_responsive_control(
            'button_radius',
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
                    '{{WRAPPER}} .topppa-post-share .topppa-share-items .topppa-share-item' => 'border-radius: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'button_box_shadow',
                'selector' => '{{WRAPPER}} .topppa-share-item',
            ]
        );

        $this->add_responsive_control(
            'icon_size',
            [
                'label' => esc_html__('Icon Size', 'topper-pack'),
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
                    '{{WRAPPER}} .topppa-share-item' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'icon_color',
            [
                'label' => esc_html__('Icon Color', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .topppa-share-item' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'enable_official_color!' => 'yes',
                ],
            ]
        );
        $this->add_responsive_control(
            'icon_hcolor',
            [
                'label' => esc_html__('Icon Hover Color', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .topppa-share-item:hover' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'enable_official_color!' => 'yes',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'icon_bg',
                'types' => ['classic', 'gradient', 'video'],
                'selector' => '{{WRAPPER}} .topppa-share-item',
                'condition' => [
                    'enable_official_color!' => 'yes',
                ],
            ]
        );
        $this->add_responsive_control(
            'icon_hbg',
            [
                'label' => esc_html__('Background Hover Color', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .topppa-share-item:hover' => 'background-color: {{VALUE}}',
                ],
                'condition' => [
                    'enable_official_color!' => 'yes',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'label_typography',
                'selector' => '{{WRAPPER}} .topppa-share-label',
                'condition' => [
                    'show_label' => 'yes',
                ],
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

        // Get current post URL and title
        $post_url = get_permalink();
        $post_title = get_the_title();

        $share_urls = [
            'facebook' => 'https://www.facebook.com/sharer/sharer.php?u=' . urlencode($post_url),
            'twitter' => 'https://twitter.com/intent/tweet?url=' . urlencode($post_url) . '&text=' . urlencode($post_title),
            'linkedin' => 'https://www.linkedin.com/shareArticle?mini=true&url=' . urlencode($post_url) . '&title=' . urlencode($post_title),
            'pinterest' => 'https://pinterest.com/pin/create/button/?url=' . urlencode($post_url) . '&description=' . urlencode($post_title),
            'email' => 'mailto:?subject=' . urlencode($post_title) . '&body=' . urlencode($post_url),
            'whatsapp' => 'https://api.whatsapp.com/send?text=' . urlencode($post_title . ' ' . $post_url),
            'telegram' => 'https://t.me/share/url?url=' . urlencode($post_url) . '&text=' . urlencode($post_title),
            'reddit' => 'https://reddit.com/submit?url=' . urlencode($post_url) . '&title=' . urlencode($post_title),
        ];

        $share_icons = [
            'facebook' => 'fab fa-facebook-f',
            'twitter' => 'fab fa-twitter',
            'linkedin' => 'fab fa-linkedin-in',
            'pinterest' => 'fab fa-pinterest-p',
            'email' => 'fas fa-envelope',
            'whatsapp' => 'fab fa-whatsapp',
            'telegram' => 'fab fa-telegram-plane',
            'reddit' => 'fab fa-reddit-alien',
        ];

        $class = 'topppa-post-share';
        if ($settings['enable_official_color'] !== 'yes') {
            $class .= ' custom-color';
        }

        echo '<div class="' . esc_attr($class) . '">';

        if (!empty($settings['share_title'])) {
            echo '<div class="topppa-share-title">' . esc_html($settings['share_title']) . '</div>';
        }
        echo '<div class="topppa-share-items">';
        if (!empty($settings['share_media'])) {
            foreach ($settings['share_media'] as $media) {
                $share_url = $share_urls[$media] ?? '#';
                $icon_class = $share_icons[$media] ?? '';

                echo '<a href="' . esc_url($share_url) . '" class="topppa-share-item topppa-share-' . esc_attr($media) . ' hover-' . esc_attr($settings['hover_effect']) . '" target="_blank" rel="noopener noreferrer">';
                echo '<i class="' . esc_attr($icon_class) . '"></i>';
                if ('yes' === $settings['show_label']) {
                    echo '<span class="topppa-share-label">' . esc_html(ucfirst($media)) . '</span>';
                }
                echo '</a>';
            }
        }
        echo '</div>';
        echo '</div>';
    }
}
