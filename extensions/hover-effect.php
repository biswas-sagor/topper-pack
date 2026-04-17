<?php

/**
 * Hover Effect Extension
 *
 * @package Topper Pack
 * @since 1.0.0
 */

namespace TopperPack\Extensions;

use \Elementor\Controls_Manager;
use \Elementor\Element_Base;
use \Elementor\Group_Control_Background;

if (!defined('ABSPATH')) exit;

class TOPPPA_Widget_Hover_Effects {

	public function __construct() {
		// Add hover controls to all widgets
		add_action('elementor/element/common/_section_style/after_section_end', [$this, 'add_widget_hover_controls'], 10);

		// Add editor scripts
		add_action('elementor/editor/after_enqueue_scripts', [$this, 'enqueue_editor_scripts']);

		// Add .topppa-hover-effect class if gradient bg enabled
		add_action('elementor/frontend/widget/before_render', [$this, 'add_hover_effect_class_if_gradient_enabled'], 10);

		// Enqueue hover effect CSS
		add_action('elementor/frontend/after_enqueue_styles', [$this, 'enqueue_scripts']);
	}

	public function enqueue_editor_scripts() {
		wp_add_inline_script('elementor-editor', '
            jQuery(window).on("elementor/frontend/init", function() {
                elementor.on("preview:loaded", function() {
                    elementor.reloadPreview();
                });
            });
        ');
	}

	public function add_widget_hover_controls($element) {
		$element->start_controls_section(
			'topppa_widget_hover_effects',
			[
				'label' => '<span class="topppa-extension-badge"></span>' . __('Advanced Effect', 'topper-pack'),
				'tab'   => Controls_Manager::TAB_ADVANCED,
			]
		);

		$element->add_control(
			'topppa_hover_effect_switch',
			[
				'label' => __('Enable Hover Effect', 'topper-pack'),
				'type'  => Controls_Manager::SWITCHER,
				'frontend_available' => true,
			]
		);

		$element->add_control(
			'topppa_hover_effect_enable_note',
			[
				'type'            => Controls_Manager::RAW_HTML,
				'raw'             => __("Enabling this option will disable Elementor's Transform feature within the Elementor Editor.", 'topper-pack'),
				'content_classes' => 'elementor-panel-alert elementor-panel-alert-info',
			]
		);

		$element->start_controls_tabs(
			'topppa_hover_effect',
			[
				'condition' => [
					'topppa_hover_effect_switch' => 'yes',
				]
			]
		);

		// Normal Tab
		$element->start_controls_tab(
			'topppa_hover_effect_normal_tab',
			[
				'label' => esc_html__('Normal', 'topper-pack'),
				'condition' => [
					'topppa_hover_effect_switch' => 'yes',
				]
			]
		);

		// Opacity
		$element->add_control(
			'topppa_hover_effect_opacity_popover',
			[
				'label'              => __('Opacity', 'topper-pack'),
				'type'               => Controls_Manager::POPOVER_TOGGLE,
				'return_value'       => 'yes',
				'condition' => [
					'topppa_hover_effect_switch' => 'yes',
				]
			]
		);

		$element->start_popover();
		$element->add_control(
			'topppa_hover_effect_opacity',
			[
				'label'              => __('Opacity', 'topper-pack'),
				'type'               => Controls_Manager::SLIDER,
				'default' => [
					'size' => 0.8,
				],
				'range' => [
					'px' => [
						'max'  => 1,
						'step' => 0.01,
					],
				],
				'condition' => [
					'topppa_hover_effect_opacity_popover' => 'yes',
				],
				'selectors' => [
					'{{WRAPPER}}' => 'opacity: {{SIZE}};',
				],
			]
		);
		$element->end_popover();

		// Background (Normal)
		$element->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'topppa_hover_effect_bg',
				'label' => __('Background', 'topper-pack'),
				'types' => ['classic', 'gradient', 'video'],
				'selector' => '{{WRAPPER}}',
				'condition' => [
					'topppa_hover_effect_switch' => 'yes',
				],
			]
		);

		// Filter
		$element->add_control(
			'topppa_hover_effect_filter_popover',
			[
				'label'              => __('Filter', 'topper-pack'),
				'type'               => Controls_Manager::POPOVER_TOGGLE,
				'return_value'       => 'yes',
				'condition' => [
					'topppa_hover_effect_switch' => 'yes',
				]
			]
		);

		$element->start_popover();

		// Blur
		$element->add_control(
			'topppa_hover_effect_blur_is_on',
			[
				'label' => __('Blur', 'topper-pack'),
				'type'  => Controls_Manager::SWITCHER,
				'condition' => [
					'topppa_hover_effect_filter_popover' => 'yes',
				],
			]
		);

		$element->add_control(
			'topppa_hover_effect_blur',
			[
				'label'              => __('Value', 'topper-pack'),
				'type'               => Controls_Manager::SLIDER,
				'default' => [
					'size' => 1,
				],
				'range' => [
					'px' => [
						'max'  => 10,
						'step' => 0.5,
					],
				],
				'condition' => [
					'topppa_hover_effect_blur_is_on'     => 'yes',
					'topppa_hover_effect_filter_popover' => 'yes',
				],
				'selectors' => [
					'{{WRAPPER}}' => 'filter: blur({{SIZE}}px);',
				],
			]
		);

		// Contrast
		$element->add_control(
			'topppa_hover_effect_contrast_is_on',
			[
				'label' => __('Contrast', 'topper-pack'),
				'type'  => Controls_Manager::SWITCHER,
				'condition' => [
					'topppa_hover_effect_filter_popover' => 'yes',
				],
			]
		);

		$element->add_control(
			'topppa_hover_effect_contrast',
			[
				'label'              => __('Value', 'topper-pack'),
				'type'               => Controls_Manager::SLIDER,
				'default' => [
					'size' => 80,
				],
				'range' => [
					'%' => [
						'max'  => 1000,
						'step' => 10,
					],
				],
				'condition' => [
					'topppa_hover_effect_contrast_is_on' => 'yes',
					'topppa_hover_effect_filter_popover' => 'yes',
				],
				'selectors' => [
					'{{WRAPPER}}' => 'filter: contrast({{SIZE}}%);',
				],
			]
		);

		// Grayscale
		$element->add_control(
			'topppa_hover_effect_grayscale_is_on',
			[
				'label' => __('Grayscale', 'topper-pack'),
				'type'  => Controls_Manager::SWITCHER,
				'condition' => [
					'topppa_hover_effect_filter_popover' => 'yes',
				],
			]
		);

		$element->add_control(
			'topppa_hover_effect_grayscale',
			[
				'label'              => __('Value', 'topper-pack'),
				'type'               => Controls_Manager::SLIDER,
				'default' => [
					'size' => 40,
				],
				'range' => [
					'%' => [
						'max'  => 100,
						'step' => 10,
					],
				],
				'condition' => [
					'topppa_hover_effect_grayscale_is_on' => 'yes',
					'topppa_hover_effect_filter_popover'  => 'yes',
				],
				'selectors' => [
					'{{WRAPPER}}' => 'filter: grayscale({{SIZE}}%);',
				],
			]
		);

		// Invert
		$element->add_control(
			'topppa_hover_effect_invert_is_on',
			[
				'label' => __('Invert', 'topper-pack'),
				'type'  => Controls_Manager::SWITCHER,
				'condition' => [
					'topppa_hover_effect_filter_popover' => 'yes',
				],
			]
		);

		$element->add_control(
			'topppa_hover_effect_invert',
			[
				'label'              => __('Value', 'topper-pack'),
				'type'               => Controls_Manager::SLIDER,
				'default' => [
					'size' => 70,
				],
				'range' => [
					'%' => [
						'max'  => 100,
						'step' => 10,
					],
				],
				'condition' => [
					'topppa_hover_effect_invert_is_on'   => 'yes',
					'topppa_hover_effect_filter_popover' => 'yes',
				],
				'selectors' => [
					'{{WRAPPER}}' => 'filter: invert({{SIZE}}%);',
				],
			]
		);

		// Saturate
		$element->add_control(
			'topppa_hover_effect_saturate_is_on',
			[
				'label' => __('Saturate', 'topper-pack'),
				'type'  => Controls_Manager::SWITCHER,
				'condition' => [
					'topppa_hover_effect_filter_popover' => 'yes',
				],
			]
		);

		$element->add_control(
			'topppa_hover_effect_saturate',
			[
				'label'              => __('Value', 'topper-pack'),
				'type'               => Controls_Manager::SLIDER,
				'default' => [
					'size' => 50,
				],
				'range' => [
					'%' => [
						'max'  => 1000,
						'step' => 10,
					],
				],
				'condition' => [
					'topppa_hover_effect_saturate_is_on' => 'yes',
					'topppa_hover_effect_filter_popover' => 'yes',
				],
				'selectors' => [
					'{{WRAPPER}}' => 'filter: saturate({{SIZE}}%);',
				],
			]
		);

		// Sepia
		$element->add_control(
			'topppa_hover_effect_sepia_is_on',
			[
				'label' => __('Sepia', 'topper-pack'),
				'type'  => Controls_Manager::SWITCHER,
				'condition' => [
					'topppa_hover_effect_filter_popover' => 'yes',
				],
			]
		);

		$element->add_control(
			'topppa_hover_effect_sepia',
			[
				'label'              => __('Value', 'topper-pack'),
				'type'               => Controls_Manager::SLIDER,
				'default' => [
					'size' => 50,
				],
				'range' => [
					'%' => [
						'max'  => 100,
						'step' => 10,
					],
				],
				'condition' => [
					'topppa_hover_effect_sepia_is_on'    => 'yes',
					'topppa_hover_effect_filter_popover' => 'yes',
				],
				'selectors' => [
					'{{WRAPPER}}' => 'filter: sepia({{SIZE}}%);',
				],
			]
		);
		$element->end_popover();

		// General Settings
		$element->add_control(
			'topppa_hover_effect_general_settings_heading',
			[
				'label'     => __('General Settings', 'topper-pack'),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => [
					'topppa_hover_effect_switch' => 'yes',
				]
			]
		);

		// Duration
		$element->add_control(
			'topppa_hover_effect_general_settings_duration',
			[
				'label'     => __('Duration (ms)', 'topper-pack'),
				'type'      => Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'min'  => 0,
						'max'  => 10000,
						'step' => 100,
					],
				],
				'default'   => [
					'size' => 1000,
				],
				'condition' => [
					'topppa_hover_effect_switch' => 'yes',
				],
				'selectors' => [
					'{{WRAPPER}}' => 'transition-duration: {{SIZE}}ms;',
				],
			]
		);

		// Transition Property
		$element->add_control(
			'topppa_hover_effect_transition_property',
			[
				'label' => __('Transition Property', 'topper-pack'),
				'type' => Controls_Manager::SELECT,
				'default' => 'all',
				'options' => [
					'all' => __('All', 'topper-pack'),
					'background' => __('Background', 'topper-pack'),
					'color' => __('Color', 'topper-pack'),
					'opacity' => __('Opacity', 'topper-pack'),
					'transform' => __('Transform', 'topper-pack'),
					'box-shadow' => __('Box Shadow', 'topper-pack'),
					'border' => __('Border', 'topper-pack'),
					'custom' => __('Custom', 'topper-pack'),
				],
				'condition' => [
					'topppa_hover_effect_switch' => 'yes',
				],
				'selectors' => [
					'{{WRAPPER}}' => 'transition-property: {{VALUE}};',
				],
			]
		);

		// Transition Timing Function
		$element->add_control(
			'topppa_hover_effect_transition_timing',
			[
				'label' => __('Transition Timing Function', 'topper-pack'),
				'type' => Controls_Manager::SELECT,
				'default' => 'ease',
				'options' => [
					'ease' => __('Ease', 'topper-pack'),
					'linear' => __('Linear', 'topper-pack'),
					'ease-in' => __('Ease In', 'topper-pack'),
					'ease-out' => __('Ease Out', 'topper-pack'),
					'ease-in-out' => __('Ease In Out', 'topper-pack'),
					'cubic-bezier(0.4, 0, 0.2, 1)' => __('Cubic Bezier', 'topper-pack'),
				],
				'condition' => [
					'topppa_hover_effect_switch' => 'yes',
				],
				'selectors' => [
					'{{WRAPPER}}' => 'transition-timing-function: {{VALUE}};',
				],
			]
		);

		$element->end_controls_tab();

		// Hover Tab
		$element->start_controls_tab(
			'topppa_hover_effect_hover_tab',
			[
				'label' => esc_html__('Hover', 'topper-pack'),
				'condition' => [
					'topppa_hover_effect_switch' => 'yes',
				]
			]
		);

		// Opacity Hover
		$element->add_control(
			'topppa_hover_effect_opacity_popover_hover',
			[
				'label'              => __('Opacity', 'topper-pack'),
				'type'               => Controls_Manager::POPOVER_TOGGLE,
				'return_value'       => 'yes',
				'condition' => [
					'topppa_hover_effect_switch' => 'yes',
				]
			]
		);

		$element->start_popover();
		$element->add_control(
			'topppa_hover_effect_opacity_hover',
			[
				'label'              => __('Opacity', 'topper-pack'),
				'type'               => Controls_Manager::SLIDER,
				'default' => [
					'size' => 1,
				],
				'range' => [
					'px' => [
						'max'  => 1,
						'step' => 0.01,
					],
				],
				'condition' => [
					'topppa_hover_effect_opacity_popover_hover' => 'yes',
				],
				'selectors' => [
					'{{WRAPPER}}:hover' => 'opacity: {{SIZE}} !important;',
				],
			]
		);
		$element->end_popover();

		// Background (Hover)
		$element->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'topppa_hover_effect_bg_hover',
				'label' => __('Background (Hover)', 'topper-pack'),
				'types' => ['classic', 'gradient', 'video'],
				'selector' => '{{WRAPPER}}:hover',
				'condition' => [
					'topppa_hover_effect_switch' => 'yes',
				],
			]
		);

		// Filter Hover
		$element->add_control(
			'topppa_hover_effect_filter_hover_popover',
			[
				'label'              => __('Filter', 'topper-pack'),
				'type'               => Controls_Manager::POPOVER_TOGGLE,
				'return_value'       => 'yes',
				'condition' => [
					'topppa_hover_effect_switch' => 'yes',
				]
			]
		);

		$element->start_popover();

		// Blur Hover
		$element->add_control(
			'topppa_hover_effect_blur_hover_is_on',
			[
				'label' => __('Blur', 'topper-pack'),
				'type'  => Controls_Manager::SWITCHER,
				'condition' => [
					'topppa_hover_effect_filter_hover_popover' => 'yes',
				]
			]
		);

		$element->add_control(
			'topppa_hover_effect_blur_hover',
			[
				'label'              => __('Value', 'topper-pack'),
				'type'               => Controls_Manager::SLIDER,
				'size_units'         => ['px'],
				'default' => [
					'size' => 0,
				],
				'range' => [
					'px' => [
						'max'  => 10,
						'step' => 0.5,
					],
				],
				'condition' => [
					'topppa_hover_effect_blur_hover_is_on'     => 'yes',
					'topppa_hover_effect_filter_hover_popover' => 'yes',
				],
				'selectors' => [
					'{{WRAPPER}}:hover' => 'filter: blur({{SIZE}}px);',
				],
			]
		);

		// Contrast Hover
		$element->add_control(
			'topppa_hover_effect_contrast_hover_is_on',
			[
				'label' => __('Contrast', 'topper-pack'),
				'type'  => Controls_Manager::SWITCHER,
				'condition' => [
					'topppa_hover_effect_filter_hover_popover' => 'yes',
				],
			]
		);

		$element->add_control(
			'topppa_hover_effect_contrast_hover',
			[
				'label'              => __('Value', 'topper-pack'),
				'type'               => Controls_Manager::SLIDER,
				'size_units'         => ['%'],
				'default' => [
					'unit' => '%',
					'size' => 100,
				],
				'range' => [
					'%' => [
						'max'  => 1000,
						'step' => 10,
					],
				],
				'condition' => [
					'topppa_hover_effect_contrast_hover_is_on' => 'yes',
					'topppa_hover_effect_filter_hover_popover' => 'yes',
				],
				'selectors' => [
					'{{WRAPPER}}:hover' => 'filter: contrast({{SIZE}}%);',
				],
			]
		);

		// Grayscale Hover
		$element->add_control(
			'topppa_hover_effect_grayscale_hover_is_on',
			[
				'label' => __('Grayscale', 'topper-pack'),
				'type'  => Controls_Manager::SWITCHER,
				'condition' => [
					'topppa_hover_effect_filter_hover_popover' => 'yes',
				],
			]
		);

		$element->add_control(
			'topppa_hover_effect_grayscale_hover',
			[
				'label'              => __('Value', 'topper-pack'),
				'type'               => Controls_Manager::SLIDER,
				'size_units'         => ['%'],
				'default' => [
					'unit' => '%',
					'size' => 0,
				],
				'range' => [
					'%' => [
						'max'  => 100,
						'step' => 10,
					],
				],
				'condition' => [
					'topppa_hover_effect_grayscale_hover_is_on' => 'yes',
					'topppa_hover_effect_filter_hover_popover'  => 'yes',
				],
				'selectors' => [
					'{{WRAPPER}}:hover' => 'filter: grayscale({{SIZE}}%);',
				],
			]
		);

		// Invert Hover
		$element->add_control(
			'topppa_hover_effect_invert_hover_is_on',
			[
				'label' => __('Invert', 'topper-pack'),
				'type'  => Controls_Manager::SWITCHER,
				'condition' => [
					'topppa_hover_effect_filter_hover_popover' => 'yes',
				],
			]
		);

		$element->add_control(
			'topppa_hover_effect_invert_hover',
			[
				'label'              => __('Value', 'topper-pack'),
				'type'               => Controls_Manager::SLIDER,
				'size_units'         => ['%'],
				'default' => [
					'unit' => '%',
					'size' => 0,
				],
				'range' => [
					'%' => [
						'max'  => 100,
						'step' => 10,
					],
				],
				'condition' => [
					'topppa_hover_effect_invert_hover_is_on'   => 'yes',
					'topppa_hover_effect_filter_hover_popover' => 'yes',
				],
				'selectors' => [
					'{{WRAPPER}}:hover' => 'filter: invert({{SIZE}}%);',
				],
			]
		);

		// Saturate Hover
		$element->add_control(
			'topppa_hover_effect_saturate_hover_is_on',
			[
				'label' => __('Saturate', 'topper-pack'),
				'type'  => Controls_Manager::SWITCHER,
				'condition' => [
					'topppa_hover_effect_filter_hover_popover' => 'yes',
				],
			]
		);

		$element->add_control(
			'topppa_hover_effect_saturate_hover',
			[
				'label'              => __('Value', 'topper-pack'),
				'type'               => Controls_Manager::SLIDER,
				'size_units'         => ['%'],
				'default' => [
					'unit' => '%',
					'size' => 100,
				],
				'range' => [
					'%' => [
						'max'  => 1000,
						'step' => 10,
					],
				],
				'condition' => [
					'topppa_hover_effect_saturate_hover_is_on' => 'yes',
					'topppa_hover_effect_filter_hover_popover' => 'yes',
				],
				'selectors' => [
					'{{WRAPPER}}:hover' => 'filter: saturate({{SIZE}}%);',
				],
			]
		);

		// Sepia Hover
		$element->add_control(
			'topppa_hover_effect_sepia_hover_is_on',
			[
				'label' => __('Sepia', 'topper-pack'),
				'type'  => Controls_Manager::SWITCHER,
				'condition' => [
					'topppa_hover_effect_filter_hover_popover' => 'yes',
				],
			]
		);

		$element->add_control(
			'topppa_hover_effect_sepia_hover',
			[
				'label'              => __('Value', 'topper-pack'),
				'type'               => Controls_Manager::SLIDER,
				'default' => [
					'size' => 0,
				],
				'range' => [
					'%' => [
						'max'  => 100,
						'step' => 10,
					],
				],
				'condition' => [
					'topppa_hover_effect_sepia_hover_is_on'    => 'yes',
					'topppa_hover_effect_filter_hover_popover' => 'yes',
				],
				'selectors' => [
					'{{WRAPPER}}:hover' => 'filter: sepia({{SIZE}}%);',
				],
			]
		);
		$element->end_popover();

		// General Settings
		$element->add_control(
			'topppa_hover_effect_general_settings_hover_heading',
			[
				'label'     => __('General Settings', 'topper-pack'),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => [
					'topppa_hover_effect_switch' => 'yes',
				]
			]
		);

		// Duration Hover
		$element->add_control(
			'topppa_hover_effect_general_settings_hover_duration',
			[
				'label'     => __('Duration (ms)', 'topper-pack'),
				'type'      => Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'min'  => 0,
						'max'  => 10000,
						'step' => 100,
					],
				],
				'default'   => [
					'unit' => 'px',
					'size' => 1000,
				],
				'condition' => [
					'topppa_hover_effect_switch' => 'yes',
				],
				'selectors' => [
					'{{WRAPPER}}:hover' => 'transition-duration: {{SIZE}}ms;',
				],
			]
		);

		// Transition Property Hover
		$element->add_control(
			'topppa_hover_effect_transition_property_hover',
			[
				'label' => __('Transition Property (Hover)', 'topper-pack'),
				'type' => Controls_Manager::SELECT,
				'default' => 'all',
				'options' => [
					'all' => __('All', 'topper-pack'),
					'background' => __('Background', 'topper-pack'),
					'color' => __('Color', 'topper-pack'),
					'opacity' => __('Opacity', 'topper-pack'),
					'transform' => __('Transform', 'topper-pack'),
					'box-shadow' => __('Box Shadow', 'topper-pack'),
					'border' => __('Border', 'topper-pack'),
					'custom' => __('Custom', 'topper-pack'),
				],
				'condition' => [
					'topppa_hover_effect_switch' => 'yes',
				],
				'selectors' => [
					'{{WRAPPER}}:hover' => 'transition-property: {{VALUE}};',
				],
			]
		);

		// Transition Timing Function Hover
		$element->add_control(
			'topppa_hover_effect_transition_timing_hover',
			[
				'label' => __('Transition Timing Function (Hover)', 'topper-pack'),
				'type' => Controls_Manager::SELECT,
				'default' => 'ease',
				'options' => [
					'ease' => __('Ease', 'topper-pack'),
					'linear' => __('Linear', 'topper-pack'),
					'ease-in' => __('Ease In', 'topper-pack'),
					'ease-out' => __('Ease Out', 'topper-pack'),
					'ease-in-out' => __('Ease In Out', 'topper-pack'),
					'cubic-bezier(0.4, 0, 0.2, 1)' => __('Cubic Bezier', 'topper-pack'),
				],
				'condition' => [
					'topppa_hover_effect_switch' => 'yes',
				],
				'selectors' => [
					'{{WRAPPER}}:hover' => 'transition-timing-function: {{VALUE}};',
				],
			]
		);

		$element->end_controls_tab();
		$element->end_controls_tabs();

		$element->add_control(
			'enable_gradient_bg',
			[
				'label' => esc_html__('Enable Gradient BG', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Show', 'topper-pack'),
				'label_off' => esc_html__('Hide', 'topper-pack'),
				'return_value' => 'yes',
				'default' => 'no',
			]
		);
		$element->add_control(
			'more_options',
			[
				'label' => esc_html__('Gradient BG', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::HEADING,
				'description' => esc_html__('Use Gradient Background Here With Transition', 'topper-pack'),
				'separator' => 'before',
				'condition' => [
					'enable_gradient_bg' => 'yes'
				]
			]
		);
		$element->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'psudo_background',
				'types' => ['classic', 'gradient', 'video'],
				'selector' => '{{WRAPPER}}::before',
				'condition' => [
					'enable_gradient_bg' => 'yes'
				]
			]
		);
		$element->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'hover_ef_border',
				'selector' => '{{WRAPPER}}',
			]
		);
		$element->add_responsive_control(
			'hover_ef_border_radius',
			[
				'label' => esc_html__('Border Radius', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}}' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$element->add_responsive_control(
			'hover_ef_margin',
			[
				'label' => esc_html__('Margin', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em', 'rem', 'custom'],
				'selectors' => [
					'{{WRAPPER}}' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$element->add_responsive_control(
			'hover_ef_padding',
			[
				'label' => esc_html__('Padding', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em', 'rem', 'custom'],
				'selectors' => [
					'{{WRAPPER}}' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$element->add_responsive_control(
			'border_style',
			[
				'label' => esc_html__('Border Style', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => '',
				'options' => [
					'' => esc_html__('Default', 'topper-pack'),
					'visible' => esc_html__('Visible', 'topper-pack'),
					'hidden' => esc_html__('Hidden', 'topper-pack'),
					'scroll' => esc_html__('Scroll', 'topper-pack'),
					'auto' => esc_html__('Auto', 'topper-pack'),
				],
				'selectors' => [
					'{{WRAPPER}}' => 'overflow: {{VALUE}};',
				],
			]
		);

		// Overflow Controls
		$element->add_responsive_control(
			'hover_ef_overflow',
			[
				'label' => esc_html__('Overflow', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => [
					'' => esc_html__('Default', 'topper-pack'),
					'visible' => esc_html__('Visible', 'topper-pack'),
					'hidden' => esc_html__('Hidden', 'topper-pack'),
					'scroll' => esc_html__('Scroll', 'topper-pack'),
					'auto' => esc_html__('Auto', 'topper-pack'),
				],
				'default' => '',
				'selectors' => [
					'{{WRAPPER}}' => 'overflow: {{VALUE}};',
				],
			]
		);
		$element->end_controls_section();
	}

	public function add_hover_effect_class_if_gradient_enabled($element) {
		$settings = $element->get_settings_for_display();
		if (!empty($settings['enable_gradient_bg']) && $settings['enable_gradient_bg'] === 'yes') {
			$element->add_render_attribute('_wrapper', 'class', 'topppa-hover-effect');
		}
	}

	public function enqueue_scripts() {
		wp_enqueue_style(
			'hover-effect',
			plugins_url('/assets/css/extensions/topppa-hover-effect.css', dirname(__FILE__)),
			[],
			'1.0.0'
		);
	}
}

new TOPPPA_Widget_Hover_Effects();