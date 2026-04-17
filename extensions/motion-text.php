<?php

/**
 * Motion Text Extension
 *
 * @package Topper Pack
 * @since 1.0.0
 */

namespace TopperPack\Extensions;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Element_Base;

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

class Motion_Text {

    /**
     * Constructor
     */
    public function __construct() {
        $this->init_hooks();
    }

    /**
     * Initialize hooks
     */
    private function init_hooks() {
        // Use very high priority to ensure our section appears last
        $priority = 999;

        // Hook into the end of all advanced sections to ensure consistent placement
        add_action('elementor/element/section/section_advanced/after_section_end', [$this, 'add_controls_section'], $priority, 2);
        add_action('elementor/element/column/section_advanced/after_section_end', [$this, 'add_controls_section'], $priority, 2);
        add_action('elementor/element/common/section_custom_css/after_section_end', [$this, 'add_controls_section'], $priority, 2);

        // For containers, hook after advanced sections
        add_action('elementor/element/container/section_advanced/after_section_end', [$this, 'add_controls_section'], $priority, 2);

        // For widgets, use a more specific hook that comes after all other advanced sections
        add_action('elementor/element/heading/section_advanced/after_section_end', [$this, 'add_controls_section'], $priority, 2);
        add_action('elementor/element/text-editor/section_advanced/after_section_end', [$this, 'add_controls_section'], $priority, 2);

        // Fallback for widgets that don't have specific advanced sections
        add_action('elementor/element/common/_section_responsive/after_section_end', [$this, 'add_controls_section'], $priority, 2);

        add_action('elementor/frontend/widget/before_render', [$this, 'apply_motion_text'], 10, 1);
        add_action('elementor/frontend/after_enqueue_scripts', [$this, 'enqueue_scripts']);
    }

    /**
     * Add controls section for containers
     *
     * @param Element_Base $element
     * @param array $args
     */
    public function add_controls_section_container($element, $args = []) {
        if (!$element instanceof Element_Base) {
            return;
        }

        // For containers, add after advanced section instead of layout
        $this->add_motion_controls($element);
    }

    /**
     * Add controls section
     *
     * @param Element_Base $element
     * @param array $args
     */
    public function add_controls_section($element, $args = []) {
        if (!$element instanceof Element_Base) {
            return;
        }

        $this->add_motion_controls($element);
    }

    /**
     * Add motion text controls to element
     *
     * @param Element_Base $element
     */
    private function add_motion_controls($element) {

        $element->start_controls_section(
            'topppa_motion_text',
            [
                'tab' => Controls_Manager::TAB_ADVANCED,
                'label' => '<span class="topppa-extension-badge"></span>' . esc_html__('Motion Text', 'topper-pack'),
            ]
        );

        // Enable/Disable control
        $element->add_control(
            'enable_motion_text',
            [
                'label' => esc_html__('Enable Motion Text', 'topper-pack'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'topper-pack'),
                'label_off' => esc_html__('No', 'topper-pack'),
                'return_value' => 'yes',
                'default' => '',
            ]
        );

        // Effect radius control
        $element->add_control(
            'motion_text_radius',
            [
                'label' => esc_html__('Effect Radius', 'topper-pack'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 50,
                        'max' => 300,
                        'step' => 10,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 100,
                ],
                'condition' => [
                    'enable_motion_text' => 'yes',
                ],
                'frontend_available' => true,
            ]
        );

        // Falloff type control
        $element->add_control(
            'motion_text_falloff',
            [
                'label' => esc_html__('Falloff Type', 'topper-pack'),
                'type' => Controls_Manager::SELECT,
                'default' => 'linear',
                'options' => [
                    'linear' => esc_html__('Linear', 'topper-pack'),
                    'exponential' => esc_html__('Exponential', 'topper-pack'),
                    'gaussian' => esc_html__('Gaussian', 'topper-pack'),
                ],
                'condition' => [
                    'enable_motion_text' => 'yes',
                ],
                'frontend_available' => true,
            ]
        );

        // Font weight from control
        $element->add_control(
            'motion_text_font_weight_from',
            [
                'label' => esc_html__('Font Weight (From)', 'topper-pack'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 100,
                        'max' => 1000,
                        'step' => 100,
                    ],
                ],
                'default' => [
                    'size' => 400,
                    'unit' => 'px',
                ],
                'condition' => [
                    'enable_motion_text' => 'yes',
                ],
                'frontend_available' => true,
            ]
        );

        // Font weight to control
        $element->add_control(
            'motion_text_font_weight_to',
            [
                'label' => esc_html__('Font Weight (To)', 'topper-pack'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 100,
                        'max' => 1000,
                        'step' => 100,
                    ],
                ],
                'default' => [
                    'size' => 1000,
                    'unit' => 'px',
                ],
                'condition' => [
                    'enable_motion_text' => 'yes',
                ],
                'frontend_available' => true,
            ]
        );

        // Optical size from control
        $element->add_control(
            'motion_text_optical_size_from',
            [
                'label' => esc_html__('Optical Size (From)', 'topper-pack'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 8,
                        'max' => 144,
                        'step' => 1,
                    ],
                ],
                'default' => [
                    'size' => 9,
                    'unit' => 'px',
                ],
                'condition' => [
                    'enable_motion_text' => 'yes',
                ],
                'frontend_available' => true,
            ]
        );

        // Optical size to control
        $element->add_control(
            'motion_text_optical_size_to',
            [
                'label' => esc_html__('Optical Size (To)', 'topper-pack'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 8,
                        'max' => 144,
                        'step' => 1,
                    ],
                ],
                'default' => [
                    'size' => 40,
                    'unit' => 'px',
                ],
                'condition' => [
                    'enable_motion_text' => 'yes',
                ],
                'frontend_available' => true,
            ]
        );

        $element->end_controls_section();
    }

    /**
     * Apply motion text attributes to element
     *
     * @param Element_Base $element
     */
    public function apply_motion_text($element) {
        if (!$element instanceof Element_Base) {
            return;
        }

        $settings = $element->get_settings_for_display();

        // Check if motion text is enabled
        if (!$this->is_motion_text_enabled($settings)) {
            return;
        }

        // Sanitize and get values
        $motion_data = $this->get_motion_text_data($settings);

        // Add render attributes
        $this->add_motion_attributes($element, $motion_data);
    }

    /**
     * Check if motion text is enabled
     *
     * @param array $settings
     * @return bool
     */
    private function is_motion_text_enabled($settings) {
        return !empty($settings['enable_motion_text']) && 'yes' === $settings['enable_motion_text'];
    }

    /**
     * Get motion text data from settings
     *
     * @param array $settings
     * @return array
     */
    private function get_motion_text_data($settings) {
        $defaults = [
            'radius' => 100,
            'falloff' => 'linear',
            'weight_from' => 400,
            'weight_to' => 1000,
            'opsz_from' => 9,
            'opsz_to' => 40,
        ];

        return [
            'radius' => $this->get_setting_value($settings, 'motion_text_radius', $defaults['radius']),
            'falloff' => $this->sanitize_falloff($this->get_setting_value($settings, 'motion_text_falloff', $defaults['falloff'])),
            'weight_from' => $this->sanitize_font_weight($this->get_setting_value($settings, 'motion_text_font_weight_from', $defaults['weight_from'])),
            'weight_to' => $this->sanitize_font_weight($this->get_setting_value($settings, 'motion_text_font_weight_to', $defaults['weight_to'])),
            'opsz_from' => $this->sanitize_optical_size($this->get_setting_value($settings, 'motion_text_optical_size_from', $defaults['opsz_from'])),
            'opsz_to' => $this->sanitize_optical_size($this->get_setting_value($settings, 'motion_text_optical_size_to', $defaults['opsz_to'])),
        ];
    }

    /**
     * Get setting value with fallback
     *
     * @param array $settings
     * @param string $key
     * @param mixed $default
     * @return mixed
     */
    private function get_setting_value($settings, $key, $default) {
        if (isset($settings[$key]['size'])) {
            return intval($settings[$key]['size']);
        }

        if (isset($settings[$key]) && is_string($settings[$key])) {
            return $settings[$key];
        }

        return $default;
    }

    /**
     * Sanitize falloff type
     *
     * @param string $falloff
     * @return string
     */
    private function sanitize_falloff($falloff) {
        $allowed_falloffs = ['linear', 'exponential', 'gaussian'];
        return in_array($falloff, $allowed_falloffs, true) ? $falloff : 'linear';
    }

    /**
     * Sanitize font weight
     *
     * @param int $weight
     * @return int
     */
    private function sanitize_font_weight($weight) {
        return max(100, min(1000, intval($weight)));
    }

    /**
     * Sanitize optical size
     *
     * @param int $size
     * @return int
     */
    private function sanitize_optical_size($size) {
        return max(8, min(144, intval($size)));
    }

    /**
     * Add motion attributes to element
     *
     * @param Element_Base $element
     * @param array $motion_data
     */
    private function add_motion_attributes($element, $motion_data) {
        $element->add_render_attribute('_wrapper', 'data-motion-text', 'true');
        $element->add_render_attribute('_wrapper', 'data-motion-radius', esc_attr($motion_data['radius']));
        $element->add_render_attribute('_wrapper', 'data-motion-falloff', esc_attr($motion_data['falloff']));
        $element->add_render_attribute('_wrapper', 'data-motion-weight-from', esc_attr($motion_data['weight_from']));
        $element->add_render_attribute('_wrapper', 'data-motion-weight-to', esc_attr($motion_data['weight_to']));
        $element->add_render_attribute('_wrapper', 'data-motion-opsz-from', esc_attr($motion_data['opsz_from']));
        $element->add_render_attribute('_wrapper', 'data-motion-opsz-to', esc_attr($motion_data['opsz_to']));
    }

    /**
     * Enqueue scripts and styles
     */
    public function enqueue_scripts() {
        // Only enqueue on frontend
        if (is_admin() || !defined('TOPPPA_ASSETS_URL') || !defined('TOPPPA_VER')) {
            return;
        }

        // Enqueue CSS with version and media type
        wp_enqueue_style(
            'topppa-motion-text',
            esc_url(TOPPPA_ASSETS_URL . 'css/extensions/topppa-motion-text.css'),
            [],
            esc_attr(TOPPPA_VER),
            'all'
        );
        
        // Enqueue JavaScript
        wp_enqueue_script(
            'topppa-motion-text',
            esc_url(TOPPPA_ASSETS_URL . 'js/extensions/topppa-motion-text.min.js'),
            [],
            esc_attr(TOPPPA_VER),
            true
        );
    }
}

// Initialize only if Elementor is loaded
if (class_exists('Elementor\Element_Base')) {
    new Motion_Text();
}