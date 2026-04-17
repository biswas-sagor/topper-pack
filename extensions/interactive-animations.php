<?php
/**
 * Interactive Animations Extension
 *
 * @package Topper Pack
 * @since 1.0.0
 */

namespace TopperPack\Extensions;

use \Elementor\Controls_Manager;
use \Elementor\Element_Base;

if (!defined('ABSPATH')) exit;

class TOPPPA_Interactive_Animations {

	public function __construct() {
		// Add controls to sections, containers and widgets
		add_action('elementor/element/section/section_advanced/after_section_end', [$this, 'add_controls']);
		add_action('elementor/element/container/section_layout/after_section_end', [$this, 'add_controls']);
		add_action('elementor/element/common/_section_style/after_section_end', [$this, 'add_controls']);

		// Enqueue assets
		add_action('elementor/frontend/after_enqueue_scripts', [$this, 'enqueue_assets']);

		// Apply animations
		add_action('elementor/frontend/before_render', [$this, 'before_render']);
	}

	public function enqueue_assets() {
		wp_enqueue_script(
			'topppa-interactive-animations',
			plugins_url('/assets/js/extensions/interactive-animations.min.js', dirname(__FILE__)),
			['jquery', 'elementor-frontend'],
			'1.0.0',
			true
		);

		wp_enqueue_style(
			'topppa-interactive-animations',
			plugins_url('/assets/css/extensions/topppa-interactive-animations.css', dirname(__FILE__)),
			[],
			'1.0.0'
		);
	}

	public function before_render($element) {
		$settings = $element->get_settings();

		if (!empty($settings['topppa_interactive_animations_enable'])) {
			$element->add_render_attribute('_wrapper', [
				'class' => 'topppa-interactive-animations',
				'data-animation-type' => $settings['topppa_interactive_animations_type'] ?? 'fade',
				'data-animation-duration' => $settings['topppa_interactive_animations_duration']['size'] ?? 1000,
				'data-animation-delay' => $settings['topppa_interactive_animations_delay']['size'] ?? 0,
				'data-animation-trigger' => $settings['topppa_interactive_animations_trigger'] ?? 'scroll',
				'data-animation-offset' => $settings['topppa_interactive_animations_offset']['size'] ?? 80,
				'data-animation-easing' => $settings['topppa_interactive_animations_easing'] ?? 'ease',
				'data-animation-repeat' => $settings['topppa_interactive_animations_repeat'] ?? 'no',
				'data-animation-mirror' => $settings['topppa_interactive_animations_mirror'] ?? 'no',
				'data-animation-once' => $settings['topppa_interactive_animations_once'] ?? 'yes'
			]);
		}
	}

	public function add_controls($element) {
		$element->start_controls_section(
			'topppa_interactive_animations_section',
			[
				'tab' => Controls_Manager::TAB_ADVANCED,
				'label' => '<span class="topppa-extension-badge"></span>' . __('Advanced Animations', 'topper-pack'),
			]
		);

		$element->add_control(
			'topppa_interactive_animations_enable',
			[
				'label' => __('Enable Animations', 'topper-pack'),
				'type' => Controls_Manager::SWITCHER,
				'frontend_available' => true,
				'render_type' => 'ui'
			]
		);

		$element->add_control(
			'topppa_interactive_animations_type',
			[
				'label' => __('Animation Type', 'topper-pack'),
				'type' => Controls_Manager::SELECT,
				'default' => 'fade',
				'options' => [
					'fade' => __('Fade', 'topper-pack'),
					'slide-up' => __('Slide Up', 'topper-pack'),
					'slide-down' => __('Slide Down', 'topper-pack'),
					'slide-left' => __('Slide Left', 'topper-pack'),
					'slide-right' => __('Slide Right', 'topper-pack'),
					'zoom-in' => __('Zoom In', 'topper-pack'),
					'zoom-out' => __('Zoom Out', 'topper-pack'),
					'flip-x' => __('Flip X', 'topper-pack'),
					'flip-y' => __('Flip Y', 'topper-pack'),
					'rotate' => __('Rotate', 'topper-pack'),
					'bounce' => __('Bounce', 'topper-pack'),
					'bounce-anim' => __('Bounce Animation', 'topper-pack'),
					'spinner' => __('Spinner', 'topper-pack')
				],
				'condition' => [
					'topppa_interactive_animations_enable' => 'yes'
				]
			]
		);

		$element->add_control(
			'topppa_interactive_animations_trigger',
			[
				'label' => __('Trigger', 'topper-pack'),
				'type' => Controls_Manager::SELECT,
				'default' => 'scroll',
				'options' => [
					'scroll' => __('On Scroll', 'topper-pack'),
					'hover' => __('On Hover', 'topper-pack'),
					'click' => __('On Click', 'topper-pack'),
					'load' => __('On Page Load', 'topper-pack')
				],
				'condition' => [
					'topppa_interactive_animations_enable' => 'yes'
				]
			]
		);

		$element->add_control(
			'topppa_interactive_animations_duration',
			[
				'label' => __('Duration (ms)', 'topper-pack'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['ms'],
				'range' => [
					'ms' => [
						'min' => 100,
						'max' => 5000,
						'step' => 100
					]
				],
				'default' => [
					'unit' => 'ms',
					'size' => 1000
				],
				'condition' => [
					'topppa_interactive_animations_enable' => 'yes'
				]
			]
		);

		$element->add_control(
			'topppa_interactive_animations_delay',
			[
				'label' => __('Delay (ms)', 'topper-pack'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['ms'],
				'range' => [
					'ms' => [
						'min' => 0,
						'max' => 5000,
						'step' => 100
					]
				],
				'default' => [
					'unit' => 'ms',
					'size' => 0
				],
				'condition' => [
					'topppa_interactive_animations_enable' => 'yes'
				]
			]
		);

		$element->add_control(
			'topppa_interactive_animations_offset',
			[
				'label' => __('Scroll Offset (%)', 'topper-pack'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['%'],
				'range' => [
					'%' => [
						'min' => 0,
						'max' => 100,
						'step' => 1
					]
				],
				'default' => [
					'unit' => '%',
					'size' => 80
				],
				'condition' => [
					'topppa_interactive_animations_enable' => 'yes',
					'topppa_interactive_animations_trigger' => 'scroll'
				]
			]
		);

		$element->add_control(
			'topppa_interactive_animations_easing',
			[
				'label' => __('Easing', 'topper-pack'),
				'type' => Controls_Manager::SELECT,
				'default' => 'ease',
				'options' => [
					'ease' => __('Ease', 'topper-pack'),
					'ease-in' => __('Ease In', 'topper-pack'),
					'ease-out' => __('Ease Out', 'topper-pack'),
					'ease-in-out' => __('Ease In Out', 'topper-pack'),
					'linear' => __('Linear', 'topper-pack'),
					'cubic-bezier' => __('Cubic Bezier', 'topper-pack')
				],
				'condition' => [
					'topppa_interactive_animations_enable' => 'yes'
				]
			]
		);

		$element->add_control(
			'topppa_interactive_animations_repeat',
			[
				'label' => __('Repeat Animation', 'topper-pack'),
				'type' => Controls_Manager::SELECT,
				'default' => 'no',
				'options' => [
					'yes' => __('Yes', 'topper-pack'),
					'no' => __('No', 'topper-pack')
				],
				'condition' => [
					'topppa_interactive_animations_enable' => 'yes',
					'topppa_interactive_animations_once!' => 'yes',
					'topppa_interactive_animations_trigger!' => 'load'
				]
			]
		);

		$element->add_control(
			'topppa_interactive_animations_mirror',
			[
				'label' => __('Mirror Animation', 'topper-pack'),
				'type' => Controls_Manager::SELECT,
				'default' => 'no',
				'options' => [
					'yes' => __('Yes', 'topper-pack'),
					'no' => __('No', 'topper-pack')
				],
				'condition' => [
					'topppa_interactive_animations_enable' => 'yes',
					'topppa_interactive_animations_trigger' => 'hover'
				]
			]
		);

		$element->add_control(
			'topppa_interactive_animations_once',
			[
				'label' => __('Animate Once', 'topper-pack'),
				'type' => Controls_Manager::SELECT,
				'default' => 'yes',
				'options' => [
					'yes' => __('Yes', 'topper-pack'),
					'no' => __('No', 'topper-pack')
				],
				'condition' => [
					'topppa_interactive_animations_enable' => 'yes',
					'topppa_interactive_animations_repeat!' => 'yes',
					'topppa_interactive_animations_trigger' => 'scroll'
				]
			]
		);

		$element->end_controls_section();
	}
}

new TOPPPA_Interactive_Animations();
