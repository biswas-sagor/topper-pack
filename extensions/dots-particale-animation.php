<?php

/**
 * Dots Particle Animation Extension
 *
 * @package Topper Pack
 * @since 1.1.0
 */

namespace TopperPack\Extensions;

use \Elementor\Controls_Manager;
use \Elementor\Element_Base;

if (!defined('ABSPATH')) exit;

class TOPPPA_Dots_Particle_Animation {

	public function __construct() {
		// Add dots particle animation controls to containers
		add_action('elementor/element/container/section_layout/after_section_end', [$this, 'add_container_dots_particle_controls'], 10);
		
		// Add dots particle animation controls to sections (for backward compatibility)
		add_action('elementor/element/section/section_advanced/after_section_end', [$this, 'add_container_dots_particle_controls'], 10);

		// Add editor scripts
		add_action('elementor/editor/after_enqueue_scripts', [$this, 'enqueue_editor_scripts']);

		// Add .topppa-dots-particle-animation class if enabled
		add_action('elementor/frontend/container/before_render', [$this, 'add_dots_particle_class_if_enabled'], 10);
		add_action('elementor/frontend/section/before_render', [$this, 'add_dots_particle_class_if_enabled'], 10);

		// Enqueue dots particle animation CSS and JS
		add_action('elementor/frontend/after_enqueue_styles', [$this, 'enqueue_styles']);
		add_action('elementor/frontend/after_enqueue_scripts', [$this, 'enqueue_scripts']);
	}

	public function enqueue_styles() {
		wp_enqueue_style(
			'topppa-dots-particle-animation',
			TOPPPA_ASSETS_URL . 'css/extensions/topppa-dots-particle-animation.css',
			[],
			TOPPPA_VER
		);
	}

	public function enqueue_scripts() {
		wp_enqueue_script(
			'topppa-dots-particle-animation',
			TOPPPA_ASSETS_URL . 'js/extensions/topppa-dots-particle-animation.min.js',
			['jquery'],
			TOPPPA_VER,
			true
		);
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

	public function add_container_dots_particle_controls($element) {
		$element->start_controls_section(
			'topppa_container_dots_particle_animation',
			[
				'label' => '<span class="topppa-extension-badge"></span>' . __('Dots Particle Animation', 'topper-pack'),
				'tab'   => Controls_Manager::TAB_ADVANCED,
			]
		);

		$element->add_control(
			'topppa_dots_particle_switch',
			[
				'label' => __('Enable Dots Particle Animation', 'topper-pack'),
				'type'  => Controls_Manager::SWITCHER,
				'frontend_available' => true,
			]
		);

		$element->add_control(
			'topppa_dots_particle_note',
			[
				'type'            => Controls_Manager::RAW_HTML,
				'raw'             => __("Add animated dots particle effect to this container.", 'topper-pack'),
				'content_classes' => 'elementor-panel-alert elementor-panel-alert-info',
				'condition' => [
					'topppa_dots_particle_switch' => 'yes',
				]
			]
		);

		$element->add_responsive_control(
			'topppa_dots_particle_position',
			[
				'label' => __('Position', 'topper-pack'),
				'type' => Controls_Manager::SELECT,
				'default' => 'absolute',
				'options' => [
					'absolute' => __('Absolute', 'topper-pack'),
					'fixed' => __('Fixed', 'topper-pack'),
				],
				'selectors' => [
					'{{WRAPPER}} .topppa-dots-particle-canvas' => 'position: {{VALUE}};',
				],
				'condition' => [
					'topppa_dots_particle_switch' => 'yes',
				]
			]
		);

		$element->add_control(
			'topppa_dots_particle_zindex',
			[
				'label' => __('Z-Index', 'topper-pack'),
				'type' => Controls_Manager::NUMBER,
				'min' => -10,
				'max' => 1000,
				'step' => 1,
				'default' => 0,
				'selectors' => [
					'{{WRAPPER}} .topppa-dots-particle-canvas' => 'z-index: {{VALUE}};',
				],
				'condition' => [
					'topppa_dots_particle_switch' => 'yes',
				]
			]
		);

		$element->add_control(
			'topppa_dots_particle_count',
			[
				'label' => __('Particle Count', 'topper-pack'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [''],
				'range' => [
					'' => [
						'min' => 10,
						'max' => 500,
						'step' => 10,
					],
				],
				'default' => [
					'unit' => '',
					'size' => 50,
				],
				'condition' => [
					'topppa_dots_particle_switch' => 'yes',
				]
			]
		);

		$element->add_control(
			'topppa_dots_particle_size',
			[
				'label' => __('Particle Size', 'topper-pack'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'range' => [
					'px' => [
						'min' => 1,
						'max' => 20,
						'step' => 1,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 3,
				],
				'condition' => [
					'topppa_dots_particle_switch' => 'yes',
				]
			]
		);

		$element->add_control(
			'topppa_dots_particle_speed',
			[
				'label' => __('Animation Speed', 'topper-pack'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [''],
				'range' => [
					'' => [
						'min' => 0.1,
						'max' => 5,
						'step' => 0.1,
					],
				],
				'default' => [
					'unit' => '',
					'size' => 1,
				],
				'condition' => [
					'topppa_dots_particle_switch' => 'yes',
				]
			]
		);

		$element->add_control(
			'topppa_dots_particle_color',
			[
				'label' => __('Particle Color', 'topper-pack'),
				'type' => Controls_Manager::COLOR,
				'default' => '#000000',
				'condition' => [
					'topppa_dots_particle_switch' => 'yes',
					'topppa_dots_particle_style!' => 'snow',
				]
			]
		);

		$element->add_control(
			'topppa_dots_snow_color',
			[
				'label' => __('Snow Color', 'topper-pack'),
				'type' => Controls_Manager::COLOR,
				'default' => '#ffffff',
				'condition' => [
					'topppa_dots_particle_switch' => 'yes',
					'topppa_dots_particle_style' => 'snow',
				]
			]
		);

		$element->add_control(
			'topppa_dots_particle_connect_distance',
			[
				'label' => __('Connection Distance', 'topper-pack'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 200,
						'step' => 5,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 100,
				],
				'condition' => [
					'topppa_dots_particle_switch' => 'yes',
					'topppa_dots_particle_style!' => 'snow',
				]
			]
		);

		$element->add_control(
			'topppa_dots_particle_connect_color',
			[
				'label' => __('Connection Line Color', 'topper-pack'),
				'type' => Controls_Manager::COLOR,
				'default' => '#000000',
				'condition' => [
					'topppa_dots_particle_switch' => 'yes',
					'topppa_dots_particle_style!' => 'snow',
				]
			]
		);

		$element->add_control(
			'topppa_dots_particle_connect_width',
			[
				'label' => __('Connection Line Width', 'topper-pack'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'range' => [
					'px' => [
						'min' => 0.1,
						'max' => 5,
						'step' => 0.1,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 1,
				],
				'condition' => [
					'topppa_dots_particle_switch' => 'yes',
					'topppa_dots_particle_style!' => 'snow',
				]
			]
		);

		$element->add_control(
			'topppa_dots_particle_opacity',
			[
				'label' => __('Particle Opacity', 'topper-pack'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [''],
				'range' => [
					'' => [
						'min' => 0,
						'max' => 1,
						'step' => 0.05,
					],
				],
				'default' => [
					'unit' => '',
					'size' => 0.5,
				],
				'condition' => [
					'topppa_dots_particle_switch' => 'yes',
				]
			]
		);

		$element->add_control(
			'topppa_dots_particle_style',
			[
				'label' => __('Particle Style', 'topper-pack'),
				'type' => Controls_Manager::SELECT,
				'default' => 'circle',
				'options' => [
					'circle' => __('Circle', 'topper-pack'),
					'square' => __('Square', 'topper-pack'),
					'triangle' => __('Triangle', 'topper-pack'),
					'heart' => __('Heart', 'topper-pack'),
					'star' => __('Star', 'topper-pack'),
					'snow' => __('Snow', 'topper-pack'),
				],
				'condition' => [
					'topppa_dots_particle_switch' => 'yes',
				]
			]
		);

		$element->end_controls_section();
	}

	public function add_dots_particle_class_if_enabled($element) {
		$settings = $element->get_settings_for_display();
		
		if (!empty($settings['topppa_dots_particle_switch']) && $settings['topppa_dots_particle_switch'] === 'yes') {
			$element->add_render_attribute('_wrapper', 'class', 'topppa-dots-particle-animation');
			
			// Add data attributes for the animation settings
			$data_attributes = [
				'count' => !empty($settings['topppa_dots_particle_count']['size']) ? $settings['topppa_dots_particle_count']['size'] : 50,
				'size' => !empty($settings['topppa_dots_particle_size']['size']) ? $settings['topppa_dots_particle_size']['size'] : 3,
				'speed' => !empty($settings['topppa_dots_particle_speed']['size']) ? $settings['topppa_dots_particle_speed']['size'] : 1,
				'color' => !empty($settings['topppa_dots_particle_color']) ? $settings['topppa_dots_particle_color'] : '#000000',
				'snow-color' => !empty($settings['topppa_dots_snow_color']) ? $settings['topppa_dots_snow_color'] : '#ffffff',
				'connect-distance' => !empty($settings['topppa_dots_particle_connect_distance']['size']) ? $settings['topppa_dots_particle_connect_distance']['size'] : 100,
				'connect-color' => !empty($settings['topppa_dots_particle_connect_color']) ? $settings['topppa_dots_particle_connect_color'] : '#000000',
				'connect-width' => !empty($settings['topppa_dots_particle_connect_width']['size']) ? $settings['topppa_dots_particle_connect_width']['size'] : 1,
				'opacity' => !empty($settings['topppa_dots_particle_opacity']['size']) ? $settings['topppa_dots_particle_opacity']['size'] : 0.5,
				'style' => !empty($settings['topppa_dots_particle_style']) ? $settings['topppa_dots_particle_style'] : 'circle',
			];
			
			foreach ($data_attributes as $key => $value) {
				$element->add_render_attribute('_wrapper', 'data-particle-' . $key, $value);
			}
		}
	}


}

new TOPPPA_Dots_Particle_Animation();