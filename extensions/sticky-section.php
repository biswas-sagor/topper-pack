<?php
/**
 * Sticky Section Extension
 *
 * @package Topper Pack
 * @since 1.0.0
 */

namespace TopperPack\Extensions;

use Elementor\Controls_Manager;
use Elementor\Element_Base;
use Elementor\Plugin;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

class TOPPPA_Advanced_Sticky_Handler {
    public function __construct() {
        add_action('elementor/element/section/section_background/after_section_end', [$this, 'topppa_register_sticky_controls'], 10);
        add_action('elementor/section/print_template', [$this, 'topppa_print_sticky_template'], 10, 2);
        add_action('elementor/frontend/section/before_render', [$this, 'topppa_before_sticky_render'], 10, 1);

        // FLEXBOX Container Support
        add_action('elementor/element/container/section_layout/after_section_end', [$this, 'topppa_register_sticky_controls'], 10);
        add_action('elementor/container/print_template', [$this, 'topppa_print_sticky_template'], 10, 2);
        add_action('elementor/frontend/container/before_render', [$this, 'topppa_before_sticky_render'], 10, 1);
    }

    public function topppa_register_sticky_controls($element) {
        if (('section' === $element->get_name() || 'container' === $element->get_name())) {

            $element->start_controls_section(
                'topppa_advanced_sticky_section_controls',
                [
                    'tab' => Controls_Manager::TAB_ADVANCED,
                    'label' => '<span class="topppa-extension-badge"></span>' . __('Advanced Sticky Element', 'topper-pack'),
                ]
            );

            $element->add_control(
                'topppa_advanced_sticky_enable',
                [
                    'type' => Controls_Manager::SWITCHER,
                    'label' => esc_html__('Activate Sticky Behavior', 'topper-pack'),
                    'default' => 'no',
                    'return_value' => 'yes',
                    'prefix_class' => 'topppa-sticky-section-',
                    'render_type' => 'template',
                ]
            );

            $element->add_control(
                'topppa_sticky_device_settings',
                [
                    'label' => esc_html__('Device Compatibility', 'topper-pack'),
                    'label_block' => true,
                    'type' => Controls_Manager::SELECT2,
                    'default' => ['desktop_sticky'],
                    'options' => $this->topppa_get_sticky_breakpoints(),
                    'multiple' => true,
                    'separator' => 'before',
                    'condition' => [
                        'topppa_advanced_sticky_enable' => 'yes'
                    ],
                ]
            );
            
            $element->add_control(
                'topppa_sticky_position_behavior',
                [
                    'label' => __('Positioning Method', 'topper-pack'),
                    'type' => Controls_Manager::SELECT,
                    'default' => 'sticky',
                    'options' => [
                        'sticky' => __('Scroll Activated', 'topper-pack'),
                        'fixed' => __('Always Fixed', 'topper-pack'),
                    ],
                    'render_type' => 'template',
                    'condition' => [
                        'topppa_advanced_sticky_enable' => 'yes'
                    ],
                ]
            );
            
            $element->add_control(
                'topppa_sticky_relation_type',
                [
                    'label' => __('Sticky Positioning', 'topper-pack'),
                    'type' => Controls_Manager::SELECT,
                    'default' => 'sticky',
                    'options' => [
                        'sticky' => __('Sticky', 'topper-pack'),
                        'fixed' => __('Fixed', 'topper-pack'),
                    ],
                    'render_type' => 'template',
                    'condition' => [
                        'topppa_advanced_sticky_enable' => 'yes',
                        'topppa_sticky_position_behavior' => 'sticky'
                    ],
                ]
            );
            
            $element->add_control(
                'topppa_sticky_anchor_location',
                [
                    'label' => __('Anchor Position', 'topper-pack'),
                    'type' => Controls_Manager::SELECT,
                    'default' => 'top',
                    'render_type' => 'template',
                    'options' => [
                        'top' => __('Top Edge', 'topper-pack'),
                        'bottom' => __('Bottom Edge', 'topper-pack'),
                    ],
                    'selectors' => [
                        '{{WRAPPER}}' => 'top: auto; bottom: auto; {{VALUE}}: {{topppa_sticky_distance_offset.VALUE}}px;',
                    ],
                    'condition' => [
                        'topppa_advanced_sticky_enable' => 'yes'
                    ]
                ]
            );
            
            $element->add_responsive_control(
                'topppa_sticky_distance_offset',
                [
                    'label' => __('Distance Spacing', 'topper-pack'),
                    'type' => Controls_Manager::NUMBER,
                    'min' => 0,
                    'max' => 500,
                    'required' => true,
                    'frontend_available' => true,
                    'render_type' => 'template',
                    'default' => 0,
                    'widescreen_default' => 0,
                    'laptop_default' => 0,
                    'tablet_extra_default' => 0,
                    'tablet_default' => 0,
                    'mobile_extra_default' => 0,
                    'mobile_default' => 0,
                    'selectors' => [
                        '{{WRAPPER}}' => 'top: auto; bottom: auto; {{topppa_sticky_anchor_location.VALUE}}: {{VALUE}}px;',
                        '{{WRAPPER}} + .topppa-hidden-header' => 'top: {{VALUE}}px;',
                        '{{WRAPPER}} + .topppa-hidden-header-flex' => 'top: {{VALUE}}px;'
                    ],
                    'condition' => [
                        'topppa_advanced_sticky_enable' => 'yes'
                    ],
                ]
            );
                
            $element->add_control(
                'topppa_sticky_layer_index',
                [
                    'label' => esc_html__('Layer Priority', 'topper-pack'),
                    'type' => Controls_Manager::NUMBER,
                    'min' => -99,
                    'max' => 99999,
                    'step' => 1,
                    'default' => 10,
                    'selectors' => [
                        '{{WRAPPER}}' => 'z-index: {{VALUE}};',
                        '.topppa-hidden-header' => 'z-index: {{VALUE}};',
                        '.topppa-hidden-header-flex' => 'z-index: {{VALUE}};'
                    ],
                    'condition' => [
                        'topppa_advanced_sticky_enable' => 'yes'
                    ],
                    'render_type' => 'template'
                ]
            );

            // Replace with Section Controls
            $element->add_control(
                'topppa_replacement_section_heading',
                [
                    'label' => __('Section Substitution', 'topper-pack'),
                    'type' => Controls_Manager::HEADING,
                    'separator' => 'before',
                    'condition' => [
                        'topppa_advanced_sticky_enable' => 'yes',
                    ],
                ]
            );

            $element->add_control(
                'topppa_enable_section_replacement',
                [
                    'label' => __('Activate Element Swap', 'topper-pack'),
                    'type' => Controls_Manager::SWITCHER,
                    'description' => __('When activated, this element will swap with the following element during sticky mode.', 'topper-pack'),
                    'condition' => [
                        'topppa_advanced_sticky_enable' => 'yes',
                    ],
                ]
            );

            $element->add_control(
                'topppa_replacement_visibility_devices',
                [
                    'label' => __('Swap Element Display', 'topper-pack'),
                    'type' => Controls_Manager::SELECT2,
                    'multiple' => true,
                    'options' => [
                        'desktop' => __('Desktop', 'topper-pack'),
                        'tablet' => __('Tablet', 'topper-pack'),
                        'mobile' => __('Mobile', 'topper-pack'),
                    ],
                    'default' => ['desktop', 'tablet', 'mobile'],
                    'condition' => [
                        'topppa_advanced_sticky_enable' => 'yes',
                        'topppa_enable_section_replacement' => 'yes',
                    ],
                ]
            );

            // Animation Controls
            $element->add_control(
                'topppa_sticky_motion_heading',
                [
                    'label' => __('Motion Effects', 'topper-pack'),
                    'type' => Controls_Manager::HEADING,
                    'separator' => 'before',
                    'condition' => [
                        'topppa_advanced_sticky_enable' => 'yes',
                    ],
                ]
            );

            $element->add_control(
                'topppa_sticky_motion_type',
                [
                    'label' => __('Transition Style', 'topper-pack'),
                    'type' => Controls_Manager::SELECT,
                    'default' => 'slide',
                    'options' => [
                        'none' => __('No Effect', 'topper-pack'),
                        'slide' => __('Slide Motion', 'topper-pack'),
                        'fade' => __('Fade Effect', 'topper-pack'),
                    ],
                    'condition' => [
                        'topppa_advanced_sticky_enable' => 'yes',
                    ],
                ]
            );

            $element->add_control(
                'topppa_sticky_motion_duration',
                [
                    'label' => __('Transition Speed (ms)', 'topper-pack'),
                    'type' => Controls_Manager::NUMBER,
                    'default' => 500,
                    'min' => 100,
                    'max' => 2000,
                    'step' => 100,
                    'condition' => [
                        'topppa_advanced_sticky_enable' => 'yes',
                        'topppa_sticky_motion_type!' => 'none',
                    ],
                ]
            );

            $element->add_control(
                'topppa_sticky_motion_easing',
                [
                    'label' => __('Motion Timing', 'topper-pack'),
                    'type' => Controls_Manager::SELECT,
                    'default' => 'ease-in-out',
                    'options' => [
                        'ease' => __('Natural', 'topper-pack'),
                        'ease-in' => __('Accelerate', 'topper-pack'),
                        'ease-out' => __('Decelerate', 'topper-pack'),
                        'ease-in-out' => __('Smooth', 'topper-pack'),
                        'linear' => __('Constant', 'topper-pack'),
                    ],
                    'condition' => [
                        'topppa_advanced_sticky_enable' => 'yes',
                        'topppa_sticky_motion_type!' => 'none',
                    ],
                ]
            );

            // Hide/Show Controls
            $element->add_control(
                'topppa_scroll_behavior_heading',
                [
                    'label' => __('Scroll Response', 'topper-pack'),
                    'type' => Controls_Manager::HEADING,
                    'separator' => 'before',
                    'condition' => [
                        'topppa_advanced_sticky_enable' => 'yes',
                    ],
                ]
            );

            $element->add_control(
                'topppa_enable_scroll_hide',
                [
                    'label' => __('Auto-Hide on Downward Scroll', 'topper-pack'),
                    'type' => Controls_Manager::SWITCHER,
                    'label_on' => __('Yes', 'topper-pack'),
                    'label_off' => __('No', 'topper-pack'),
                    'return_value' => 'yes',
                    'default' => 'no',
                    'condition' => [
                        'topppa_advanced_sticky_enable' => 'yes',
                    ],
                ]
            );

            $element->add_control(
                'topppa_breakpoint_settings',
                [
                    'label' => __('Breakpoints', 'topper-pack'),
                    'type' => \Elementor\Controls_Manager::HIDDEN,
                    'default' => get_option('elementor_experiment-additional_custom_breakpoints'),
                    'condition' => [
                        'topppa_advanced_sticky_enable' => 'yes'
                    ]
                ]
            );

            $element->add_control(
                'topppa_active_breakpoint_list',
                [
                    'label' => __('Active Breakpoints', 'topper-pack'),
                    'type' => \Elementor\Controls_Manager::HIDDEN,
                    'default' => $this->topppa_get_active_sticky_breakpoints(),
                    'condition' => [
                        'topppa_advanced_sticky_enable' => 'yes'
                    ]
                ]
            );

            $element->end_controls_section();
        }
    }

    public function topppa_get_sticky_breakpoints() {
        $active_breakpoints = [];
        foreach (\Elementor\Plugin::$instance->breakpoints->get_active_breakpoints() as $key => $value) {
            $breakpoint_name = ucwords(preg_replace('/_/i', ' ', $key));
            $active_breakpoints[$key . '_sticky'] = esc_html($breakpoint_name);
        }

        // translators: 1: Desktop
        $active_breakpoints['desktop_sticky'] = esc_html__('Desktop', 'topper-pack');
        // translators: 1: Active breakpoints
        return $active_breakpoints;
    }

    public function topppa_get_active_sticky_breakpoints() {
        $active_breakpoints = [];

        foreach ($this->topppa_get_sticky_breakpoints() as $key => $value) {
            array_push($active_breakpoints, $key);
        }

        return $active_breakpoints;
    }
    
    public function topppa_before_sticky_render($element) {
        if ($element->get_name() !== 'section' && $element->get_name() !== 'container') {
            return;
        }
        
        $settings = $element->get_settings_for_display();

        if ($settings['topppa_advanced_sticky_enable'] !== 'yes') return;

        $allowed_positions = ['top', 'bottom']; // Define allowed positions
        $position_location = $settings['topppa_sticky_anchor_location'];

        if (!in_array($position_location, $allowed_positions)) {
            $position_location = 'top';
        } else {
            $position_location = sanitize_text_field($position_location);
        }
        
        if ($settings['topppa_advanced_sticky_enable'] === 'yes') {
            $element->add_render_attribute('_wrapper', [
                'data-topppa-sticky-section' => $settings['topppa_advanced_sticky_enable'],
                'data-topppa-position-type' => $settings['topppa_sticky_position_behavior'],
                'data-topppa-position-offset' => $settings['topppa_sticky_distance_offset'],
                'data-topppa-position-location' => $position_location,
                'data-topppa-sticky-devices' => $settings['topppa_sticky_device_settings'],
                'data-topppa-custom-breakpoints' => $settings['topppa_breakpoint_settings'],
                'data-topppa-active-breakpoints' => $this->topppa_get_active_sticky_breakpoints(),
                'data-topppa-z-index' => $settings['topppa_sticky_layer_index'],
                'data-topppa-sticky-type' => isset($settings['topppa_sticky_relation_type']) ? $settings['topppa_sticky_relation_type'] : '',
                'data-topppa-replace-header' => isset($settings['topppa_enable_section_replacement']) ? $settings['topppa_enable_section_replacement'] : '',
                'data-topppa-replace-devices' => isset($settings['topppa_replacement_visibility_devices']) ? implode(',', $settings['topppa_replacement_visibility_devices']) : '',
                'data-topppa-sticky-animation' => isset($settings['topppa_sticky_motion_type']) ? $settings['topppa_sticky_motion_type'] : 'slide',
                'data-topppa-animation-duration' => isset($settings['topppa_sticky_motion_duration']) ? $settings['topppa_sticky_motion_duration'] . 'ms' : '500ms',
                'data-topppa-animation-easing' => isset($settings['topppa_sticky_motion_easing']) ? $settings['topppa_sticky_motion_easing'] : 'ease-in-out',
                'data-topppa-sticky-hide' => isset($settings['topppa_enable_scroll_hide']) ? $settings['topppa_enable_scroll_hide'] : '',
            ]);
        }
    }

    public function topppa_print_sticky_template($template, $widget) {
        if ($widget->get_name() !== 'section' && $widget->get_name() !== 'container') {
            return $template;
        }

        ob_start();

        ?>

        <# if ( 'yes' === settings.topppa_advanced_sticky_enable) { #>
            <# if ( 'top' !== settings.topppa_sticky_anchor_location && 'bottom' !== settings.topppa_sticky_anchor_location ) {
                settings.topppa_sticky_anchor_location = 'top';
            } #>

            <div class="topppa-sticky-section-yes-editor" data-topppa-z-index={{{settings.topppa_sticky_layer_index}}} data-topppa-sticky-section={{{settings.topppa_advanced_sticky_enable}}} data-topppa-position-type={{{settings.topppa_sticky_position_behavior}}} data-topppa-position-offset={{{settings.topppa_sticky_distance_offset}}} data-topppa-position-location={{{settings.topppa_sticky_anchor_location}}} data-topppa-sticky-devices={{{settings.topppa_sticky_device_settings}}} data-topppa-custom-breakpoints={{{settings.topppa_breakpoint_settings}}} data-topppa-active-breakpoints={{{settings.topppa_active_breakpoint_list}}} data-topppa-sticky-type={{{settings.topppa_sticky_relation_type}}} data-topppa-replace-header={{{settings.topppa_enable_section_replacement}}} data-topppa-replace-devices={{{settings.topppa_replacement_visibility_devices}}} data-topppa-sticky-animation={{{settings.topppa_sticky_motion_type}}} data-topppa-animation-duration={{{settings.topppa_sticky_motion_duration}}} data-topppa-animation-easing={{{settings.topppa_sticky_motion_easing}}} data-topppa-sticky-hide={{{settings.topppa_enable_scroll_hide}}}></div>
            
            <# if ( 'yes' === settings.topppa_enable_section_replacement ) { #>
                <style>
                    .elementor-element-{{{ view.model.id }}} + .elementor-element,
                    .elementor-element-{{{ view.model.id }}} + .e-con,
                    .elementor-element-{{{ view.model.id }}} + [data-element_type="container"] {
                        display: none !important;
                    }
                </style>
            <# } #>
        <# } #>

        <?php
        
        $sticky_content = ob_get_contents();
        ob_end_clean();

        return $template . $sticky_content;
    }
}

// Initialize the extension
new TOPPPA_Advanced_Sticky_Handler();