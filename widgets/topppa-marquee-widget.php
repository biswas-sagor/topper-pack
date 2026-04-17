<?php

use \TopperPack\Includes\Controls\Controls_Manager as TopperPack_Controls_Manager;
use \TopperPack\Includes\Utilities;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

/**
 * Elementor topppa marquee Widget.
 *
 * Elementor widget that inserts an embbedable content into the page, from any given URL.
 *
 * @since 1.0.0
 */
class TOPPPA_Marquee_Widget extends \Elementor\Widget_Base
{

    /**
     * Get widget name.
     *
     * Retrieve marquee widget widget name.
     *
     * @since 1.0.0
     * @access public
     * @return string Widget name.
     */
    public function get_name()
    {
        return 'topppa_marquee';
    }

    /**
     * Get widget title.
     *
     * Retrieve marquee widget title.
     *
     * @since 1.0.0
     * @access public
     * @return string Widget title.
     */
    public function get_title()
    {
        return TOPPPA_EPWB . esc_html__('Marquee', 'topper-pack');
    }

    /**
     * Get widget icon.
     *
     * Retrieve marquee widget icon.
     *
     * @since 1.0.0
     * @access public
     * @return string Widget icon.
     */
    public function get_icon()
    {
        return 'eicon-accordion';
    }

    /**
     * Get widget categories.
     *
     * Retrieve the list of categories the marquee widget belongs to.
     *
     * @since 1.0.0
     * @access public
     * @return array Widget categories.
     */
    public function get_categories()
    {
        return ['topper-pack'];
    }

    /**
     * Get widget keywords.
     *
     * Retrieve the list of keywords the marquee widget belongs to.
     *
     * @since 1.0.0
     * @access public
     * @return array Widget keywords.
     */
    public function get_keywords()
    {
        return ['topppa', 'widget', 'marquee', 'accordion', 'topperpack'];
    }

    /**
     * Register widget scripts.
     *
     * @since 1.0.0
     * @access public
     * @return array Widget scripts.
     */
    public function get_script_depends()
    {
        return ['topppa-marquee-widget'];
    }

    /**
     * Register widget styles.
     *
     * @since 1.0.0
     * @access public
     * @return array Widget styles.
     */
    public function get_style_depends()
    {
        return ['topppa-marquee-widget'];
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
    public function get_custom_help_url()
    {
        return 'https://doc.topperpack.com/docs/service-widgets/marquee/';
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
    public function get_custom_image_url()
    {
        return 'https://topperpack.com/assets/widgets/faq-widget/';
    }
    /**
     * Register marquee Widget 1 widget controls.
     *
     * Add input fields to allow the user to customize the widget settings.
     *
     * @since 1.0.0
     * @access protected
     */
    protected function register_controls()
    {
        $this->start_controls_section(
            'topppa_marquee_options',
            [
                'label' => esc_html__('Marquee Options', 'topper-pack'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_control(
            'marquee_style',
            [
                'label' => esc_html__('Select Marquee Style', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'text',
                'options' => [
                    'text' => esc_html__('Text', 'topper-pack'),
                    'image' => esc_html__('Image', 'topper-pack'),
                ],
            ]
        );
        $this->add_control(
            'marquee_content',
            [
                'label' => esc_html__('Marquee Text', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::WYSIWYG,
                'default' => esc_html__('Creating a marquee-like scrolling effect using CSS involves using CSS animations.', 'topper-pack'),
                'condition' => [
                    'marquee_style' => 'text',
                ],
            ]
        );
        $this->add_control(
            'topppa_marquee_speed',
            [
                'label' => esc_html__('Speed (seconds)', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'min' => 1,
                'max' => 300,
                'step' => 1,
                'condition' => [
                    'marquee_style' => 'text',
                ],
            ]
        );

        $this->add_control(
            'topppa_marquee_image_speed',
            [
                'label' => esc_html__('Image Speed (pixels)', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'min' => 1,
                'max' => 20,
                'step' => 0.5,
                'default' => 1,
                'condition' => [
                    'marquee_style' => 'image',
                ],
            ]
        );
        $repeater = new \Elementor\Repeater();
        $repeater->add_control(
            'select_options',
            [
                'label' => esc_html__('Icon Type', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'label_block' => false,
                'options' => [
                    'icon' => [
                        'title' => esc_html__('Icon', 'topper-pack'),
                        'icon' => 'fa fa-paint-brush',
                    ],
                    'image' => [
                        'title' => esc_html__('Image', 'topper-pack'),
                        'icon' => 'fa fa-image',
                    ],
                ],
                'default' => 'image',
            ]
        );
        $repeater->add_control(
            'logo_img',
            [
                'label' => __('Choose Logo', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'condition' => [
                    'select_options' => 'image',
                ],
            ]
        );
        $repeater->add_control(
            'logo_icon',
            [
                'label' => esc_html__('Icon', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::ICONS,
                'default' => [
                    'value' => 'fas fa-map-marker-alt',
                    'library' => 'fa-solid',
                ],
                'condition' => [
                    'select_options' => 'icon',
                ],
            ]
        );
        $this->add_control(
            'image_item',
            [
                'label' => esc_html__('Logo List', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'logo_img' => '',
                    ],
                ],
                'title_field' => '{{{ logo_img.url ? "Image" : "No Image" }}}',
                'condition' => [
                    'marquee_style' => 'image',
                ],
            ]

        );
        $this->end_controls_section();
        $this->start_controls_section(
            'style_image_tab',
            [
                'label' => esc_html__('Image Style', 'topper-pack'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                'condition' => [
                    'marquee_style' => ['image', 'icon'],
                ],
            ]
        );
        $this->add_responsive_control(
            'image_align',
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
                    '{{WRAPPER}} .topppa-marquee-wrapper .topppa-marquee-image' => 'text-align: {{VALUE}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'Image_width',
            [
                'label' => esc_html__('Width', 'topper-pack'),
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
                'selectors' => [
                    '{{WRAPPER}} .topppa-marquee-wrapper .topppa-marquee-image' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'item_gap',
            [
                'label' => esc_html__('Gap', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'custom'],
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
                'default' => [
                    'unit' => 'px',
                ],
                'selectors' => [
                    '{{WRAPPER}} .topppa-marquee-wrapper .marquee-inner' => 'gap: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'Image_height',
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
                'selectors' => [
                    '{{WRAPPER}} .topppa-marquee-wrapper .topppa-marquee-image' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'image_object',
            [
                'label' => esc_html__('Object Fit', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'cover',
                'options' => [
                    'fill' => esc_html__('Fill', 'topper-pack'),
                    'contain' => esc_html__('Contain', 'topper-pack'),
                    'cover' => esc_html__('Cover', 'topper-pack'),
                    'none' => esc_html__('none', 'topper-pack'),
                ],
                'selectors' => [
                    '{{WRAPPER}} .topppa-marquee-wrapper .topppa-marquee-image img' => 'object-fit: {{VALUE}}',
                ],
            ]
        );
        $this->start_controls_tabs(
            'image_style_tabs'
        );

        $this->start_controls_tab(
            'image_style_normal_tab',
            [
                'label' => esc_html__('Normal', 'topper-pack'),
            ]
        );
        $this->add_responsive_control(
            'image_color',
            [
                'label' => esc_html__('Color', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .topppa-marquee-wrapper .topppa-marquee-image svg path' => 'fill: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'label' => esc_html__('Image Background', 'topper-pack'),
                'name' => 'image_background',
                'types' => ['classic', 'gradient', 'video'],
                'selector' => '{{WRAPPER}} .topppa-marquee-wrapper .topppa-marquee-image',

            ]
        );
        $this->add_control(
            'grayscale',
            [
                'label' => esc_html__('Grayscale', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => [''],  // empty unit for decimal
                'range' => [
                    '' => [
                        'min' => 0,
                        'max' => 1,
                        'step' => 0.1,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .topppa-marquee-wrapper .marquee-inner .topppa-marquee-image img' => 'filter: grayscale({{SIZE}});',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'image_border1',
                'selector' => '{{WRAPPER}} .topppa-marquee-wrapper .topppa-marquee-image',
            ]
        );
        $this->end_controls_tab();

        $this->start_controls_tab(
            'image_style_hover_tab',
            [
                'label' => esc_html__('Hover', 'topper-pack'),
            ]
        );
        $this->add_responsive_control(
            'image_hover_color',
            [
                'label' => esc_html__('Hover Color', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .topppa-marquee-wrapper .topppa-marquee-image:hover svg path' => 'fill: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'label' => esc_html__('Image Background', 'topper-pack'),
                'name' => 'image_background_hover',
                'types' => ['classic', 'gradient', 'video'],
                'selector' => '{{WRAPPER}} .topppa-marquee-wrapper .topppa-marquee-image:hover',

            ]
        );
        $this->add_control(
            'hover_grayscale',
            [
                'label' => esc_html__('Hover Grayscale', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => [''],  // empty unit for decimal
                'range' => [
                    '' => [
                        'min' => 0,
                        'max' => 1,
                        'step' => 0.1,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .topppa-marquee-wrapper .marquee-inner .topppa-marquee-image:hover img' => 'filter: grayscale({{SIZE}});',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'image_border_hover',
                'selector' => '{{WRAPPER}} .topppa-marquee-wrapper .topppa-marquee-image:hover',
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'image_border',
                'selector' => '{{WRAPPER}} .topppa-marquee-wrapper .topppa-marquee-image',
            ]
        );
        $this->add_responsive_control(
            'image_border_radius',
            [
                'label' => esc_html__('Border Radius', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .topppa-marquee-wrapper .topppa-marquee-image' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'image_margin',
            [
                'label' => esc_html__('Margin', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .topppa-marquee-wrapper .topppa-marquee-image' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'image_padding',
            [
                'label' => esc_html__('Padding', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .topppa-marquee-wrapper .topppa-marquee-image' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();
        $this->start_controls_section(
            'topppa_marquee_style_controls',
            [
                'label' => esc_html__('Text Style', 'topper-pack'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                'condition' => [
                    'marquee_style' => 'text',
                ],


            ]
        );
        $this->add_control(
            'topppa_marquee_text_color',
            [
                'label' => esc_html__('Text Color', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .topppa-marquee-text' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'topppa_marquee_typography',
                'selector' => '{{WRAPPER}} .topppa-marquee-text',
            ]
        );
        $this->add_responsive_control(
            'topppa_marquee_margin',
            [
                'label' => esc_html__('Margin', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .topppa-marquee-text' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'topppa_marquee_padding',
            [
                'label' => esc_html__('Padding', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .topppa-marquee-text' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();
    }

    /**
     * Render faq widget output on the frontend.
     *
     * Written in PHP and used to generate the final HTML.
     *
     * @since 1.0.0
     * @access protected
     */
    protected function render()
    {
        $settings = $this->get_settings_for_display();
        $allowed_html = wp_kses_allowed_html('post');
        unset($allowed_html['script'], $allowed_html['iframe'], $allowed_html['div'], $allowed_html['p']);

        // Get speed and visible images from settings
        $speed = !empty($settings['topppa_marquee_speed']) ? floatval($settings['topppa_marquee_speed']) : 50;
        $image_speed = !empty($settings['topppa_marquee_image_speed']) ? floatval($settings['topppa_marquee_image_speed']) : 1;

        // Generate unique ID for this instance
        $unique_id = 'topppa-marquee-' . $this->get_id();

        ?>
        <div class="topppa-marquee-wrapper" id="<?php echo esc_attr($unique_id); ?>"
            style="--topppa-marquee-speed: <?php echo esc_attr($speed); ?>s;"
            data-image-speed="<?php echo esc_attr($image_speed); ?>">

            <?php if ($settings['marquee_style'] == 'text'): ?>
                <div class="topppa-marquee-text">
                    <?php echo wp_kses($settings['marquee_content'], $allowed_html); ?>
                </div>
            <?php endif; ?>
            <?php if ($settings['marquee_style'] == 'image'): ?>
                <div class="marquee-inner">
                    <?php foreach ($settings['image_item'] as $logo): ?>
                        <div class="topppa-marquee-image ratio-1x1">
                            <?php
                            if (!empty($logo['select_options'])) {
                                if ($logo['select_options'] === 'image' && !empty($logo['logo_img']['id'])) {
                                    echo wp_get_attachment_image($logo['logo_img']['id'], 'full');
                                } elseif ($logo['select_options'] === 'icon' && !empty($logo['logo_icon'])) {
                                    \Elementor\Icons_Manager::render_icon($logo['logo_icon'], ['aria-hidden' => 'true']);
                                } else {
                                    echo '<p>' . esc_html__('No logo found', 'topper-pack') . '</p>';
                                }
                            }

                            ?>
                        </div>

                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
        <?php
    }
}