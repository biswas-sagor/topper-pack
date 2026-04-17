<?php
/**
 * Tooltip Extension
 *
 * @package Topper Pack
 * @since 1.0.0
 */

namespace TopperPack\Extensions;
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Element_Base;

class Tooltip_Extension {

    public function __construct() {
        add_action('elementor/element/common/_section_style/after_section_end', [$this, 'add_controls_section'], 10);
        add_action('elementor/frontend/widget/before_render', [$this, 'apply_tooltip'], 10);
        add_action('elementor/frontend/after_enqueue_scripts', [$this, 'enqueue_scripts']);
    }

    public function add_controls_section($element) {
        $element->start_controls_section(
            'topppa_tooltip_section',
            [
                'tab' => Controls_Manager::TAB_ADVANCED,
                'label' => '<span class="topppa-extension-badge"></span>' . __('Tooltip', 'topper-pack'),
            ]
        );

        // Enable Tooltip
        $element->add_control(
            'tooltip_enable',
            [
                'label' => __('Enable Tooltip', 'topper-pack'),
                'type' => Controls_Manager::SWITCHER,
                'return_value' => 'yes',
                'default' => '',
            ]
        );

        // Content Tab
        $element->add_control(
            'tooltip_content_heading',
            [
                'label' => __('Content', 'topper-pack'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
                'condition' => ['tooltip_enable' => 'yes'],
            ]
        );

        $element->add_control(
            'tooltip_text',
            [
                'label' => __('Tooltip Text', 'topper-pack'),
                'type' => Controls_Manager::TEXTAREA,
                'default' => __('Tooltip text goes here', 'topper-pack'),
                'condition' => ['tooltip_enable' => 'yes'],
            ]
        );

        // Behavior Tab
        $element->add_control(
            'tooltip_behavior_heading',
            [
                'label' => __('Behavior', 'topper-pack'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
                'condition' => ['tooltip_enable' => 'yes'],
            ]
        );

        $element->add_control(
            'tooltip_position',
            [
                'label' => __('Position', 'topper-pack'),
                'type' => Controls_Manager::SELECT,
                'default' => 'top',
                'options' => [
                    'top' => __('Top', 'topper-pack'),
                    'top-start' => __('Top Start', 'topper-pack'),
                    'top-end' => __('Top End', 'topper-pack'),
                    'right' => __('Right', 'topper-pack'),
                    'right-start' => __('Right Start', 'topper-pack'),
                    'right-end' => __('Right End', 'topper-pack'),
                    'bottom' => __('Bottom', 'topper-pack'),
                    'bottom-start' => __('Bottom Start', 'topper-pack'),
                    'bottom-end' => __('Bottom End', 'topper-pack'),
                    'left' => __('Left', 'topper-pack'),
                    'left-start' => __('Left Start', 'topper-pack'),
                    'left-end' => __('Left End', 'topper-pack'),
                ],
                'condition' => ['tooltip_enable' => 'yes'],
            ]
        );

        $element->add_control(
            'tooltip_arrow',
            [
                'label' => __('Show Arrow', 'topper-pack'),
                'type' => Controls_Manager::SWITCHER,
                'return_value' => 'yes',
                'default' => 'yes',
                'condition' => ['tooltip_enable' => 'yes'],
            ]
        );

        $element->add_control(
            'tooltip_follow_cursor',
            [
                'label' => __('Follow Cursor', 'topper-pack'),
                'type' => Controls_Manager::SELECT,
                'default' => 'false',
                'options' => [
                    'false' => __('Disabled', 'topper-pack'),
                    'true' => __('Enabled', 'topper-pack'),
                    'initial' => __('Initial Position', 'topper-pack'),
                    'horizontal' => __('Horizontal Only', 'topper-pack'),
                    'vertical' => __('Vertical Only', 'topper-pack'),
                ],
                'condition' => ['tooltip_enable' => 'yes'],
            ]
        );

        // Animation Tab
        $element->add_control(
            'tooltip_animation_heading',
            [
                'label' => __('Animation', 'topper-pack'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
                'condition' => ['tooltip_enable' => 'yes'],
            ]
        );

        $element->add_control(
            'tooltip_animation',
            [
                'label' => __('Animation', 'topper-pack'),
                'type' => Controls_Manager::SELECT,
                'default' => 'fade',
                'options' => [
                    'fade' => __('Fade', 'topper-pack'),
                    'shift-away' => __('Shift Away', 'topper-pack'),
                    'shift-toward' => __('Shift Toward', 'topper-pack'),
                    'scale' => __('Scale', 'topper-pack'),
                    'perspective' => __('Perspective', 'topper-pack'),
                    'none' => __('None', 'topper-pack'),
                ],
                'condition' => ['tooltip_enable' => 'yes'],
            ]
        );

        $element->add_control(
            'tooltip_animation_duration',
            [
                'label' => __('Duration (ms)', 'topper-pack'),
                'type' => Controls_Manager::NUMBER,
                'default' => 300,
                'min' => 0,
                'max' => 1000,
                'step' => 10,
                'condition' => [
                    'tooltip_enable' => 'yes',
                    'tooltip_animation!' => 'none',
                ],
            ]
        );

        $element->add_control(
            'tooltip_animation_delay',
            [
                'label' => __('Delay (ms)', 'topper-pack'),
                'type' => Controls_Manager::NUMBER,
                'default' => 0,
                'min' => 0,
                'max' => 1000,
                'step' => 10,
                'condition' => [
                    'tooltip_enable' => 'yes',
                    'tooltip_animation!' => 'none',
                ],
            ]
        );

        // Style Tab
        $element->add_control(
            'tooltip_style_heading',
            [
                'label' => __('Style', 'topper-pack'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
                'condition' => ['tooltip_enable' => 'yes'],
            ]
        );

        $element->add_control(
            'tooltip_style',
            [
                'label' => __('Preset Style', 'topper-pack'),
                'type' => Controls_Manager::SELECT,
                'description' => __('Select a predefined tooltip style or choose "Custom" to apply your own styling.', 'topper-pack'),
                'default' => 'default',
                'options' => [
                    'default' => __('Default', 'topper-pack'),
                    'light' => __('Light', 'topper-pack'),
                    'dark' => __('Dark', 'topper-pack'),
                    'primary' => __('Primary', 'topper-pack'),
                    'custom' => __('Custom', 'topper-pack'),
                ],
                'condition' => ['tooltip_enable' => 'yes'],
            ]
        );

        // Typography
        $element->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'tooltip_typography',
                'label' => __('Typography', 'topper-pack'),
                'selector' => '.tippy-box[data-theme~="topperpack-tooltip"]',
                'condition' => [
                    'tooltip_enable' => 'yes',
                    'tooltip_style' => 'custom',
                ],
            ]
        );

        // Text Color
        $element->add_control(
            'tooltip_text_color',
            [
                'label' => __('Text Color', 'topper-pack'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '.tippy-box[data-theme~="topperpack-tooltip"]' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'tooltip_enable' => 'yes',
                    'tooltip_style' => 'custom',
                ],
            ]
        );

        // Background
        $element->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'tooltip_background',
                'label' => __('Background', 'topper-pack'),
                'types' => ['classic', 'gradient', 'video'],
                'selector' => '.tippy-box[data-theme~="topperpack-tooltip"]',
                'condition' => [
                    'tooltip_enable' => 'yes',
                    'tooltip_style' => 'custom',
                ],
            ]
        );

        // Border
        $element->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'tooltip_border',
                'label' => __('Border', 'topper-pack'),
                'selector' => '.tippy-box[data-theme~="topperpack-tooltip"]',
                'condition' => [
                    'tooltip_enable' => 'yes',
                    'tooltip_style' => 'custom',
                ],
            ]
        );

        // Border Radius
        $element->add_control(
            'tooltip_border_radius',
            [
                'label' => __('Border Radius', 'topper-pack'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '.tippy-box[data-theme~="topperpack-tooltip"]' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'tooltip_enable' => 'yes',
                    'tooltip_style' => 'custom',
                ],
            ]
        );

        // Box Shadow
        $element->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'tooltip_box_shadow',
                'label' => __('Box Shadow', 'topper-pack'),
                'selector' => '.tippy-box[data-theme~="topperpack-tooltip"]',
                'condition' => [
                    'tooltip_enable' => 'yes',
                    'tooltip_style' => 'custom',
                ],
            ]
        );

        // Padding
        $element->add_control(
            'tooltip_padding',
            [
                'label' => __('Padding', 'topper-pack'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '.tippy-box[data-theme~="topperpack-tooltip"]' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'tooltip_enable' => 'yes',
                    'tooltip_style' => 'custom',
                ],
            ]
        );

        // Arrow Color
        $element->add_control(
            'tooltip_arrow_color',
            [
                'label' => __('Arrow Color', 'topper-pack'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '.tippy-box[data-theme~="topperpack-tooltip"] .tippy-arrow' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'tooltip_enable' => 'yes',
                    'tooltip_style' => 'custom',
                    'tooltip_arrow' => 'yes',
                ],
            ]
        );

        $element->end_controls_section();
    }

    public function apply_tooltip($element) {
        $settings = $element->get_settings_for_display();

        if ('yes' === $settings['tooltip_enable']) {
            $element->add_render_attribute('_wrapper', 'class', 'topppa-tooltip-element');

            $tooltip_theme = ($settings['tooltip_style'] === 'custom')
                ? 'topperpack-tooltip'
                : 'topperpack-' . $settings['tooltip_style'];

            $element->add_render_attribute('_wrapper', [
                'data-topppa-tooltip' => '',
                'data-topppa-tooltip-text' => esc_attr($settings['tooltip_text']),
                'data-topppa-tooltip-pos' => esc_attr($settings['tooltip_position']),
                'data-topppa-tooltip-theme' => $tooltip_theme,
                'data-topppa-tooltip-animation' => esc_attr($settings['tooltip_animation']),
                'data-topppa-tooltip-animation-duration' => esc_attr($settings['tooltip_animation_duration']),
                'data-topppa-tooltip-animation-delay' => esc_attr($settings['tooltip_animation_delay']),
                'data-topppa-tooltip-arrow' => $settings['tooltip_arrow'] === 'yes' ? 'true' : 'false',
                'data-topppa-tooltip-follow-cursor' => esc_attr($settings['tooltip_follow_cursor']),
                'data-topppa-tooltip-interactive' => 'true',
            ]);

            // Add editor-specific class
            if (\Elementor\Plugin::$instance->editor->is_edit_mode()) {
                $element->add_render_attribute('_wrapper', 'class', 'topppa-tooltip-editor-mode');
            }
        }
    }

    public function enqueue_scripts() {
        wp_enqueue_style(
            'tippy-animations',
            plugins_url('/assets/vendor/tippy/tippy-all-animation.css', dirname(__FILE__)),
            [],
            '1.0.0'
        );

        wp_enqueue_script(
            'popper-min',
            plugins_url('/assets/vendor/tippy/popper.min.js', dirname(__FILE__)),
            [],
            '3.12.5',
            true
        );

        wp_enqueue_script(
            'tippy',
            plugins_url('/assets/vendor/tippy/tippy.js', dirname(__FILE__)),
            [],
            '3.12.5',
            true
        );
    }
}

new \TopperPack\Extensions\Tooltip_Extension();
