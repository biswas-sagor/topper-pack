<?php

namespace TopperPack\Extensions;

use Elementor\Controls_Manager;

if (!defined('ABSPATH'))
	exit;

class TOPPPA_Hover_Image_Viewer {

	public function __construct() {

		add_action(
			'elementor/element/container/section_layout/after_section_end',
			[$this, 'add_controls']
		);

		add_action(
			'elementor/frontend/container/before_render',
			[$this, 'before_render']
		);

		add_action(
			'elementor/frontend/after_enqueue_scripts',
			[$this, 'enqueue_scripts']
		);
	}

	public function add_controls($element) {

		$element->start_controls_section(
			'topppa_hover_image_viewer',
			[
				'label' => '<span class="topppa-extension-badge"></span>' . __('Hover Image Viewer', 'topper-pack'),
				'tab' => Controls_Manager::TAB_ADVANCED,
			]
		);

		$element->add_control(
			'enable_hover_image',
			[
				'label' => __('Enable Hover Image', 'topper-pack'),
				'type' => Controls_Manager::SWITCHER,
			]
		);

		$element->add_control(
			'hover_image',
			[
				'label' => __('Hover Image', 'topper-pack'),
				'type' => Controls_Manager::MEDIA,
				'condition' => [
					'enable_hover_image' => 'yes',
				],
			]
		);

		$element->add_responsive_control(
			'hover_position',
			[
				'label' => __('Image Position', 'topper-pack'),
				'type' => Controls_Manager::SELECT,
				'default' => 'center',
				'options' => [
					'left' => __('Left', 'topper-pack'),
					'right' => __('Right', 'topper-pack'),
					'top' => __('Top', 'topper-pack'),
					'bottom' => __('Bottom', 'topper-pack'),
					'center' => __('Center', 'topper-pack'),
				],
				'condition' => [
					'enable_hover_image' => 'yes',
				],
			]
		);

		$element->add_responsive_control(
			'hover_size',
			[
				'label' => __('Image Size', 'topper-pack'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px'],
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
				'condition' => [
					'enable_hover_image' => 'yes',
				],
			]
		);

		// TOP offsets
		$element->add_responsive_control(
			'top_offset_x',
			[
				'label' => __('Top Offset X', 'topper-pack'),
				'type' => Controls_Manager::NUMBER,
				'default' => 0,
				'condition' => ['hover_position' => 'top'],
			]
		);

		$element->add_responsive_control(
			'top_offset_y',
			[
				'label' => __('Top Offset Y', 'topper-pack'),
				'type' => Controls_Manager::NUMBER,
				'default' => 0,
				'condition' => ['hover_position' => 'top'],
			]
		);

		// BOTTOM offsets
		$element->add_responsive_control(
			'bottom_offset_x',
			[
				'label' => __('Bottom Offset X', 'topper-pack'),
				'type' => Controls_Manager::NUMBER,
				'default' => 0,
				'condition' => ['hover_position' => 'bottom'],
			]
		);

		$element->add_responsive_control(
			'bottom_offset_y',
			[
				'label' => __('Bottom Offset Y', 'topper-pack'),
				'type' => Controls_Manager::NUMBER,
				'default' => 0,
				'condition' => ['hover_position' => 'bottom'],
			]
		);

		// LEFT offsets
		$element->add_responsive_control(
			'left_offset_x',
			[
				'label' => __('Left Offset X', 'topper-pack'),
				'type' => Controls_Manager::NUMBER,
				'default' => 0,
				'condition' => ['hover_position' => 'left'],
			]
		);

		$element->add_responsive_control(
			'left_offset_y',
			[
				'label' => __('Left Offset Y', 'topper-pack'),
				'type' => Controls_Manager::NUMBER,
				'default' => 0,
				'condition' => ['hover_position' => 'left'],
			]
		);

		// RIGHT offsets
		$element->add_responsive_control(
			'right_offset_x',
			[
				'label' => __('Right Offset X', 'topper-pack'),
				'type' => Controls_Manager::NUMBER,
				'default' => 0,
				'condition' => ['hover_position' => 'right'],
			]
		);

		$element->add_responsive_control(
			'right_offset_y',
			[
				'label' => __('Right Offset Y', 'topper-pack'),
				'type' => Controls_Manager::NUMBER,
				'default' => 0,
				'condition' => ['hover_position' => 'right'],
			]
		);

		// CENTER offsets
		$element->add_responsive_control(
			'center_offset_x',
			[
				'label' => __('Center Offset X', 'topper-pack'),
				'type' => Controls_Manager::NUMBER,
				'default' => 0,
				'condition' => ['hover_position' => 'center'],
			]
		);

		$element->add_responsive_control(
			'center_offset_y',
			[
				'label' => __('Center Offset Y', 'topper-pack'),
				'type' => Controls_Manager::NUMBER,
				'default' => 0,
				'condition' => ['hover_position' => 'center'],
			]
		);
		$element->end_controls_section();
	}

	public function before_render($element) {

		$s = $element->get_settings_for_display();

		if (empty($s['enable_hover_image']) || empty($s['hover_image']['url'])) {
			return;
		}

		// Get responsive position values
		$position_desktop = $s['hover_position'] ?? 'center';
		$position_tablet = $s['hover_position_tablet'] ?? $position_desktop;
		$position_mobile = $s['hover_position_mobile'] ?? $position_tablet;

		$element->add_render_attribute('_wrapper', [
			'class' => 'topppa-hover-image-container',
			'data-image' => esc_url($s['hover_image']['url']),
			'data-position' => $position_desktop,
			'data-position-tablet' => $position_tablet,
			'data-position-mobile' => $position_mobile,

			// ✅ Elementor responsive defaults
			'data-size-desktop' => $s['hover_size']['size'] ?? 220,
			'data-size-tablet' => $s['hover_size_tablet']['size'] ?? '',
			'data-size-mobile' => $s['hover_size_mobile']['size'] ?? '',

			'data-unit' => 'px',

			// Desktop offsets
			'data-left-x' => $s['left_offset_x'] ?? 0,
			'data-left-y' => $s['left_offset_y'] ?? 0,
			'data-right-x' => $s['right_offset_x'] ?? 0,
			'data-right-y' => $s['right_offset_y'] ?? 0,
			'data-top-x' => $s['top_offset_x'] ?? 0,
			'data-top-y' => $s['top_offset_y'] ?? 0,
			'data-bottom-x' => $s['bottom_offset_x'] ?? 0,
			'data-bottom-y' => $s['bottom_offset_y'] ?? 0,
			'data-center-x' => $s['center_offset_x'] ?? 0,
			'data-center-y' => $s['center_offset_y'] ?? 0,

			// Tablet offsets
			'data-left-x-tablet' => $s['left_offset_x_tablet'] ?? '',
			'data-left-y-tablet' => $s['left_offset_y_tablet'] ?? '',
			'data-right-x-tablet' => $s['right_offset_x_tablet'] ?? '',
			'data-right-y-tablet' => $s['right_offset_y_tablet'] ?? '',
			'data-top-x-tablet' => $s['top_offset_x_tablet'] ?? '',
			'data-top-y-tablet' => $s['top_offset_y_tablet'] ?? '',
			'data-bottom-x-tablet' => $s['bottom_offset_x_tablet'] ?? '',
			'data-bottom-y-tablet' => $s['bottom_offset_y_tablet'] ?? '',
			'data-center-x-tablet' => $s['center_offset_x_tablet'] ?? '',
			'data-center-y-tablet' => $s['center_offset_y_tablet'] ?? '',

			// Mobile offsets
			'data-left-x-mobile' => $s['left_offset_x_mobile'] ?? '',
			'data-left-y-mobile' => $s['left_offset_y_mobile'] ?? '',
			'data-right-x-mobile' => $s['right_offset_x_mobile'] ?? '',
			'data-right-y-mobile' => $s['right_offset_y_mobile'] ?? '',
			'data-top-x-mobile' => $s['top_offset_x_mobile'] ?? '',
			'data-top-y-mobile' => $s['top_offset_y_mobile'] ?? '',
			'data-bottom-x-mobile' => $s['bottom_offset_x_mobile'] ?? '',
			'data-bottom-y-mobile' => $s['bottom_offset_y_mobile'] ?? '',
			'data-center-x-mobile' => $s['center_offset_x_mobile'] ?? '',
			'data-center-y-mobile' => $s['center_offset_y_mobile'] ?? '',
		]);
	}

	public function enqueue_scripts() {
		wp_enqueue_script(
			'topppa-hover-image',
			TOPPPA_URL . 'assets/js/extensions/topppa-hover-image-viewer.min.js',
			['jquery'],
			TOPPPA_VER,
			true
		);
	}
}

new TOPPPA_Hover_Image_Viewer();
