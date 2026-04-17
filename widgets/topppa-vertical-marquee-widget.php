<?php

use \TopperPack\Includes\Controls\Controls_Manager as TopperPack_Controls_Manager;
use \TopperPack\Includes\Utilities;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

/**
 * Elementor topppa vertical marquee Widget.
 *
 * Elementor widget that creates a vertical scrolling marquee effect.
 *
 * @since 1.0.0
 */
class TOPPPA_Vertical_Marquee_Widget extends \Elementor\Widget_Base
{

    /**
     * Get widget name.
     *
     * Retrieve vertical marquee widget name.
     *
     * @since 1.0.0
     * @access public
     * @return string Widget name.
     */
    public function get_name()
    {
        return 'topppa_vertical_marquee';
    }

    /**
     * Get widget title.
     *
     * Retrieve vertical marquee widget title.
     *
     * @since 1.0.0
     * @access public
     * @return string Widget title.
     */
    public function get_title()
    {
        return TOPPPA_EPWB . esc_html__('Vertical Marquee', 'topper-pack');
    }

    /**
     * Get widget icon.
     *
     * Retrieve vertical marquee widget icon.
     *
     * @since 1.0.0
     * @access public
     * @return string Widget icon.
     */
    public function get_icon()
    {
        return 'eicon-posts-carousel';
    }

    /**
     * Get widget categories.
     *
     * Retrieve the list of categories the vertical marquee widget belongs to.
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
     * Retrieve the list of keywords the vertical marquee widget belongs to.
     *
     * @since 1.0.0
     * @access public
     * @return array Widget keywords.
     */
    public function get_keywords()
    {
        return ['topppa', 'widget', 'vertical', 'marquee', 'scroll', 'topperpack'];
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
        return ['topppa-vertical-marquee-widget'];
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
        return ['topppa-vertical-marquee-widget'];
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
        return 'https://doc.topperpack.com/docs/service-widgets/vertical-marquee/';
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
        return 'https://topperpack.com/assets/widgets/vertical-marquee-widget/';
    }

    /**
     * Register vertical marquee Widget controls.
     *
     * Add input fields to allow the user to customize the widget settings.
     *
     * @since 1.0.0
     * @access protected
     */
    protected function register_controls()
    {
        $this->start_controls_section(
            'topppa_vertical_marquee_options',
            [
                'label' => esc_html__('Vertical Marquee Options', 'topper-pack'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );
        $repeater = new \Elementor\Repeater();
        $repeater->add_control(
            'marquee_content',
            [
                'label' => esc_html__('Marquee Text', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::WYSIWYG,
                'default' => esc_html__('Creating a vertical', 'topper-pack'),
            ]
        );
        $this->add_control(
            'content_item',
            [
                'label' => esc_html__('Marquee Items', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'marquee_content' => esc_html__('Vertical Marquee Item', 'topper-pack'),
                    ],
                ],
                'title_field' => '{{{ marquee_content }}}',
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
            ]
        );

        $this->end_controls_section();


        $this->start_controls_section(
            'topppa_vertical_marquee_style_controls',
            [
                'label' => esc_html__('Text Style', 'topper-pack'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_responsive_control(
            'content_gap',
            [
                'label' => esc_html__('Gap', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 500,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .vertical-marquee-wrapper .vertical-marquee-viewport .vertical-marquee-track' => 'gap: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'wrapper_width',
            [
                'label' => esc_html__('Width', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 500,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .vertical-marquee-wrapper' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'topppa_vertical_marquee_typography',
                'selector' => '{{WRAPPER}} .vertical-marquee-item',
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Text_Shadow::get_type(),
            [
                'name' => 'text_shadow',
                'selector' => '{{WRAPPER}} .vertical-marquee-item',
                'condition' => [
                    'topppa_vertical_marquee_use_gradient!' => 'yes',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Text_Stroke::get_type(),
            [
                'name' => 'text_stroke',
                'selector' => '{{WRAPPER}} .vertical-marquee-item',
            ]
        );
        $this->add_control(
            'topppa_vertical_marquee_use_gradient',
            [
                'label' => esc_html__('Use Gradient', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'topper-pack'),
                'label_off' => esc_html__('No', 'topper-pack'),
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );

        $this->add_control(
            'gradient_start_color',
            [
                'label' => esc_html__('Color', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'condition' => [
                    'topppa_vertical_marquee_use_gradient' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'gradient_start_location',
            [
                'label' => esc_html__('Location', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['%'],
                'range' => [
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                        'step' => 1,
                    ],
                ],
                'default' => [
                    'unit' => '%',
                    'size' => 0,
                ],
                'condition' => [
                    'topppa_vertical_marquee_use_gradient' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'gradient_end_color',
            [
                'label' => esc_html__('Second Color', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'condition' => [
                    'topppa_vertical_marquee_use_gradient' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'gradient_end_location',
            [
                'label' => esc_html__('Location', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['%'],
                'range' => [
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                        'step' => 1,
                    ],
                ],
                'default' => [
                    'unit' => '%',
                    'size' => 100,
                ],
                'condition' => [
                    'topppa_vertical_marquee_use_gradient' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'gradient_type',
            [
                'label' => esc_html__('Type', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'linear',
                'options' => [
                    'linear' => esc_html__('Linear', 'topper-pack'),
                    'radial' => esc_html__('Radial', 'topper-pack'),
                ],
                'condition' => [
                    'topppa_vertical_marquee_use_gradient' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'gradient_angle',
            [
                'label' => esc_html__('Angle', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['deg'],
                'range' => [
                    'deg' => [
                        'min' => 0,
                        'max' => 360,
                        'step' => 1,
                    ],
                ],
                'default' => [
                    'unit' => 'deg',
                    'size' => 180,
                ],
                'condition' => [
                    'topppa_vertical_marquee_use_gradient' => 'yes',
                    'gradient_type' => 'linear',
                ],

            ]
        );

        $this->add_responsive_control(
            'topppa_vertical_marquee_margin',
            [
                'label' => esc_html__('Margin', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .vertical-marquee-item' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'topppa_vertical_marquee_padding',
            [
                'label' => esc_html__('Padding', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .vertical-marquee-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();
    }

    /**
     * Render vertical marquee widget output on the frontend.
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

        // Get speed from settings
        $speed = !empty($settings['topppa_marquee_speed']) ? floatval($settings['topppa_marquee_speed']) : 10;

        // Generate unique ID for this instance
        $unique_id = 'topppa-vertical-marquee-' . $this->get_id();

        // Prepare style variables
        $style_vars = [];

        // Add gradient variables if enabled
        if (!empty($settings['topppa_vertical_marquee_use_gradient']) && $settings['topppa_vertical_marquee_use_gradient'] === 'yes') {
            $gradient_start_color = !empty($settings['gradient_start_color']) ? $settings['gradient_start_color'] : '#ffffff';
            $gradient_end_color = !empty($settings['gradient_end_color']) ? $settings['gradient_end_color'] : '#000000';

            // Gradient type
            $gradient_type = !empty($settings['gradient_type']) ? $settings['gradient_type'] : 'linear';

            if ($gradient_type === 'linear') {
                $angle = !empty($settings['gradient_angle']['size']) ? $settings['gradient_angle']['size'] : 180;
                $gradient_css = 'linear-gradient(' . $angle . 'deg, ' . $gradient_start_color . ', ' . $gradient_end_color . ')';
            } else {
                $gradient_css = 'radial-gradient(' . $gradient_start_color . ', ' . $gradient_end_color . ')';
            }

            $style_vars[] = '--topppa-vertical-marquee-gradient: ' . $gradient_css;
        } elseif (!empty($settings['topppa_vertical_marquee_text_color'])) {
            // Only add text color if gradient is not enabled
            $style_vars[] = '--topppa-vertical-marquee-text-color: ' . $settings['topppa_vertical_marquee_text_color'];
        }

        // Build style attribute
        $style_parts = ['--speed: ' . esc_attr($speed)];
        if (!empty($style_vars)) {
            $style_parts = array_merge($style_parts, $style_vars);
        }
        $style_attr = implode('; ', $style_parts);

        // Add class for gradient if enabled
        $wrapper_classes = ['vertical-marquee-wrapper'];
        if (!empty($settings['topppa_vertical_marquee_use_gradient']) && $settings['topppa_vertical_marquee_use_gradient'] === 'yes') {
            $wrapper_classes[] = 'has-gradient';
        }
        $wrapper_class_attr = implode(' ', $wrapper_classes);

        // Prepare gradient styles for text elements
        $text_style_attr = '';
        if (!empty($settings['topppa_vertical_marquee_use_gradient']) && $settings['topppa_vertical_marquee_use_gradient'] === 'yes') {
            $gradient_start_color = !empty($settings['gradient_start_color']) ? $settings['gradient_start_color'] : '#ffffff';
            $gradient_end_color = !empty($settings['gradient_end_color']) ? $settings['gradient_end_color'] : '#000000';

            // Gradient type
            $gradient_type = !empty($settings['gradient_type']) ? $settings['gradient_type'] : 'linear';

            if ($gradient_type === 'linear') {
                $angle = !empty($settings['gradient_angle']['size']) ? $settings['gradient_angle']['size'] : 180;
                $gradient_css = 'linear-gradient(' . $angle . 'deg, ' . $gradient_start_color . ', ' . $gradient_end_color . ')';
            } else {
                $gradient_css = 'radial-gradient(' . $gradient_start_color . ', ' . $gradient_end_color . ')';
            }

            $text_style_attr = 'background: ' . $gradient_css . '; -webkit-background-clip: text; background-clip: text; -webkit-text-fill-color: transparent;';
        }

        ?>
        <div class="<?php echo esc_attr($wrapper_class_attr); ?>" id="<?php echo esc_attr($unique_id); ?>"
            style="<?php echo esc_attr($style_attr); ?>">
            <div class="vertical-marquee-viewport">
                <div class="vertical-marquee-track" id="vertical-marquee-track-<?php echo esc_attr($this->get_id()); ?>">
                    <?php foreach ($settings['content_item'] as $item): ?>
                        <div class="vertical-marquee-item" <?php echo !empty($text_style_attr) ? ' style="' . esc_attr($text_style_attr) . '"' : ''; ?>>
                            <?php echo wp_kses($item['marquee_content'], $allowed_html); ?>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
        <?php
    }
}