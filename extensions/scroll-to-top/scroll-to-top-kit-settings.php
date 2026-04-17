<?php
/**
 * Scroll to Top Extension Kit Settings
 *
 * @package Topper Pack
 * @since 1.0.0
 */

namespace TopperPack\Extensions;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
use Elementor\Controls_Manager;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Core\Kits\Documents\Tabs\Tab_Base;
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;

class TOPPPA_Scroll_To_Top_Extension_Kit_Setings extends Tab_Base {

	public function get_id() {
		return 'topppa-scroll-to-top-kit-settings';
	}

	public function get_title() {
		return __('TOPPPA Scroll to Top', 'topper-pack' );
	}

	public function get_icon() {
		return 'eicon-v-align-top';
	}

	public function get_help_url() {
		return '';
	}

	public function get_group() {
		return 'settings';
	}

	protected function register_tab_controls() {
		$this->start_controls_section(
			'topppa_scroll_to_top_kit_section',
			[
				'tab'   => 'topppa-scroll-to-top-kit-settings',
				'label' => __( 'Scroll to Top', 'topper-pack' ),
			]
		);

		$this->add_control(
			'topppa_scroll_to_top_global',
			[
				'type'      => Controls_Manager::SWITCHER,
				'label'     => __( 'Enable Scroll To Top', 'topper-pack' ),
				'default'   => '',
				'label_on'  => __( 'Show', 'topper-pack' ),
				'label_off' => __( 'Hide', 'topper-pack' ),
			]
		);

		// TODO: For Pro 3.6.0, convert this to the breakpoints utility method introduced in core 3.5.0.
		$breakpoints    = \Elementor\Plugin::instance()->breakpoints->get_active_breakpoints();
		$device_default = [];
		foreach ( $breakpoints as $breakpoint_key => $breakpoint ) {
			$device_default[ $breakpoint_key . '_default' ] = 'yes';
		}
		$device_default['desktop_default'] = 'yes';
		$this->add_responsive_control(
			'topppa_scroll_to_top_responsive_visibility',
			array_merge(
				[
					'type'                 => Controls_Manager::SWITCHER,
					'label'                => __( 'Responsive Visibility', 'topper-pack' ),
					'default'              => 'yes',
					'return_value'         => 'yes',
					'label_on'             => __( 'Show', 'topper-pack' ),
					'label_off'            => __( 'Hide', 'topper-pack' ),
					'selectors_dictionary' => [
						''    => 'visibility: hidden; opacity: 0;',
						'yes' => 'visibility: visible; opacity: 1;',
					],
					'selectors'            => [
						'body[data-elementor-device-mode="widescreen"] .topppa-scroll-to-top-wrap,
						body[data-elementor-device-mode="widescreen"] .topppa-scroll-to-top-wrap.edit-mode,
						body[data-elementor-device-mode="widescreen"] .topppa-scroll-to-top-wrap.single-page-off' => '{{VALUE}}',

						'body[data-elementor-device-mode="desktop"] .topppa-scroll-to-top-wrap,
						body[data-elementor-device-mode="desktop"] .topppa-scroll-to-top-wrap.edit-mode,
						body[data-elementor-device-mode="desktop"] .topppa-scroll-to-top-wrap.single-page-off' => '{{VALUE}}',

						'body[data-elementor-device-mode="laptop"] .topppa-scroll-to-top-wrap,
						body[data-elementor-device-mode="laptop"] .topppa-scroll-to-top-wrap.edit-mode,
						body[data-elementor-device-mode="laptop"] .topppa-scroll-to-top-wrap.single-page-off' => '{{VALUE}}',

						'body[data-elementor-device-mode="tablet_extra"] .topppa-scroll-to-top-wrap,
						body[data-elementor-device-mode="tablet_extra"] .topppa-scroll-to-top-wrap.edit-mode,
						body[data-elementor-device-mode="tablet_extra"] .topppa-scroll-to-top-wrap.single-page-off' => '{{VALUE}}',

						'body[data-elementor-device-mode="tablet"] .topppa-scroll-to-top-wrap,
						body[data-elementor-device-mode="tablet"] .topppa-scroll-to-top-wrap.edit-mode,
						body[data-elementor-device-mode="tablet"] .topppa-scroll-to-top-wrap.single-page-off' => '{{VALUE}}',

						'body[data-elementor-device-mode="mobile_extra"] .topppa-scroll-to-top-wrap,
						body[data-elementor-device-mode="mobile_extra"] .topppa-scroll-to-top-wrap.edit-mode,
						body[data-elementor-device-mode="mobile_extra"] .topppa-scroll-to-top-wrap.single-page-off' => '{{VALUE}}',

						'body[data-elementor-device-mode="mobile"] .topppa-scroll-to-top-wrap,
						body[data-elementor-device-mode="mobile"] .topppa-scroll-to-top-wrap.edit-mode,
						body[data-elementor-device-mode="mobile"] .topppa-scroll-to-top-wrap.single-page-off' => '{{VALUE}}',
					],
					'condition'            => [
						'topppa_scroll_to_top_global' => 'yes',
					],
				],
				$device_default
			)
		);

		$this->add_control(
			'topppa_scroll_to_top_position_text',
			[
				'label'       => esc_html__( 'Position', 'topper-pack' ),
				'type'        => Controls_Manager::SELECT,
				'default'     => 'bottom-right',
				'label_block' => false,
				'options'     => [
					'bottom-left'  => esc_html__( 'Bottom Left', 'topper-pack' ),
					'bottom-right' => esc_html__( 'Bottom Right', 'topper-pack' ),
				],
				'separator'   => 'before',
				'condition'   => [
					'topppa_scroll_to_top_global' => 'yes',
				],
			]
		);

		$this->add_control(
			'topppa_scroll_to_top_position_bottom',
			[
				'label'      => __( 'Bottom', 'topper-pack' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => ['px', 'em', '%'],
				'range'      => [
					'px' => [
						'min'  => 0,
						'max'  => 1000,
						'step' => 1,
					],
					'em' => [
						'min'  => 0,
						'max'  => 50,
						'step' => 1,
					],
					'%'  => [
						'min'  => 0,
						'max'  => 100,
						'step' => 1,
					],
				],
				'selectors'  => [
					'.topppa-scroll-to-top-wrap .topppa-scroll-to-top-button' => 'bottom: {{SIZE}}{{UNIT}}',
				],
				'condition'  => [
					'topppa_scroll_to_top_global' => 'yes',
				],
			]
		);

		$this->add_control(
			'topppa_scroll_to_top_position_left',
			[
				'label'      => __( 'Left', 'topper-pack' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => ['px', 'em', '%'],
				'range'      => [
					'px' => [
						'min'  => 0,
						'max'  => 1000,
						'step' => 1,
					],
					'em' => [
						'min'  => 0,
						'max'  => 50,
						'step' => 1,
					],
					'%'  => [
						'min'  => 0,
						'max'  => 100,
						'step' => 1,
					],
				],
				'selectors'  => [
					'.topppa-scroll-to-top-button' => 'left: 15px',
					'.topppa-scroll-to-top-wrap .topppa-scroll-to-top-button' => 'left: {{SIZE}}{{UNIT}}',
				],
				'condition'  => [
					'topppa_scroll_to_top_global'        => 'yes',
					'topppa_scroll_to_top_position_text' => 'bottom-left',
				],
			]
		);

		$this->add_control(
			'topppa_scroll_to_top_position_right',
			[
				'label'      => __( 'Right', 'topper-pack' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => ['px', 'em', '%'],
				'range'      => [
					'px' => [
						'min'  => 0,
						'max'  => 1000,
						'step' => 1,
					],
					'em' => [
						'min'  => 0,
						'max'  => 50,
						'step' => 1,
					],
					'%'  => [
						'min'  => 0,
						'max'  => 100,
						'step' => 1,
					],
				],
				'selectors'  => [
					'.topppa-scroll-to-top-wrap .topppa-scroll-to-top-button' => 'right: {{SIZE}}{{UNIT}}',
				],
				'condition'  => [
					'topppa_scroll_to_top_global'        => 'yes',
					'topppa_scroll_to_top_position_text' => 'bottom-right',
				],
			]
		);

		$this->add_control(
			'topppa_scroll_to_top_button_width',
			[
				'label'      => __( 'Width', 'topper-pack' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'range'      => [
					'px' => [
						'min'  => 0,
						'max'  => 1000,
						'step' => 1,
					],
				],
				'selectors'  => [
					'.topppa-scroll-to-top-wrap .topppa-scroll-to-top-button' => 'width: {{SIZE}}{{UNIT}};',
				],
				'separator'  => 'before',
				'condition'  => [
					'topppa_scroll_to_top_global' => 'yes',
				],
			]
		);

		$this->add_control(
			'topppa_scroll_to_top_button_height',
			[
				'label'      => __( 'Height', 'topper-pack' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'range'      => [
					'px' => [
						'min'  => 0,
						'max'  => 1000,
						'step' => 1,
					],
				],
				'selectors'  => [
					'.topppa-scroll-to-top-wrap .topppa-scroll-to-top-button' => 'height: {{SIZE}}{{UNIT}};',
				],
				'condition'  => [
					'topppa_scroll_to_top_global' => 'yes',
				],
			]
		);

		$this->add_control(
			'topppa_scroll_to_top_z_index',
			[
				'label'      => __( 'Z Index', 'topper-pack' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'range'      => [
					'px' => [
						'min'  => 0,
						'max'  => 9999,
						'step' => 10,
					],
				],
				'selectors'  => [
					'.topppa-scroll-to-top-wrap .topppa-scroll-to-top-button' => 'z-index: {{SIZE}}',
				],
				'condition'  => [
					'topppa_scroll_to_top_global' => 'yes',
				],
			]
		);

		$this->add_control(
			'topppa_scroll_to_top_button_opacity',
			[
				'label'     => __( 'Opacity', 'topper-pack' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'min'  => 0,
						'max'  => 1,
						'step' => 0.01,
					],
				],
				'selectors' => [
					'.topppa-scroll-to-top-wrap .topppa-scroll-to-top-button' => 'opacity: {{SIZE}};',
				],
				'condition' => [
					'topppa_scroll_to_top_global' => 'yes',
				],
			]
		);

		$this->add_control(
			'topppa_scroll_to_top_media_type',
			[
				'label'          => __( 'Media Type', 'topper-pack' ),
				'type'           => Controls_Manager::CHOOSE,
				'label_block'    => false,
				'options'        => [
					'icon'  => [
						'title' => __( 'Icon', 'topper-pack' ),
						'icon'  => 'eicon-star',
					],
					'image' => [
						'title' => __( 'Image', 'topper-pack' ),
						'icon'  => 'eicon-image',
					],
					'text'  => [
						'title' => __( 'Text', 'topper-pack' ),
						'icon'  => 'eicon-animation-text',
					],
				],
				'default'        => 'icon',
				'separator'      => 'before',
				'toggle'         => false,
				'style_transfer' => true,
				'condition'      => [
					'topppa_scroll_to_top_global' => 'yes',
				],
			]
		);

		$this->add_control(
			'topppa_scroll_to_top_button_icon',
			[
				'label'      => esc_html__( 'Icon', 'topper-pack' ),
				'type'       => Controls_Manager::ICONS,
				'show_label' => false,
				'default'    => [
					'value'   => 'fas fa-chevron-up',
					'library' => 'fa-solid',
				],
				'condition'  => [
					'topppa_scroll_to_top_global'     => 'yes',
					'topppa_scroll_to_top_media_type' => 'icon',
				],
			]
		);

		$this->add_control(
			'topppa_scroll_to_top_button_image',
			[
				'label'      => __( 'Image', 'topper-pack' ),
				'type'       => Controls_Manager::MEDIA,
				'show_label' => false,
				'dynamic'    => [
					'active' => true,
				],
				'condition'  => [
					'topppa_scroll_to_top_global'     => 'yes',
					'topppa_scroll_to_top_media_type' => 'image',
				],
			]
		);

		$this->add_control(
			'topppa_scroll_to_top_button_text',
			[
				'label'       => __( 'Text', 'topper-pack' ),
				'type'        => Controls_Manager::TEXT,
				'show_label'  => false,
				'label_block' => true,
				'default'     => 'Top',
				'condition'   => [
					'topppa_scroll_to_top_global'     => 'yes',
					'topppa_scroll_to_top_media_type' => 'text',
				],
			]
		);

		$this->add_control(
			'topppa_scroll_to_top_button_icon_size',
			[
				'label'      => __( 'Size', 'topper-pack' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'range'      => [
					'px' => [
						'min'  => 0,
						'max'  => 100,
						'step' => 1,
					],
				],
				'selectors'  => [
					'.topppa-scroll-to-top-wrap .topppa-scroll-to-top-button i' => 'font-size: {{SIZE}}{{UNIT}};',
					'.topppa-scroll-to-top-wrap .topppa-scroll-to-top-button img' => 'height: {{SIZE}}{{UNIT}};width: {{SIZE}}{{UNIT}};',
				],
				'condition'  => [
					'topppa_scroll_to_top_global'      => 'yes',
					'topppa_scroll_to_top_media_type!' => 'text',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'      => 'topppa_scroll_to_top_button_text_typo',
				'global' => [
					'default' => Global_Typography::TYPOGRAPHY_TEXT,
				],
				'selector'  => '.topppa-scroll-to-top-wrap .topppa-scroll-to-top-button span',
				'condition' => [
					'topppa_scroll_to_top_global'     => 'yes',
					'topppa_scroll_to_top_media_type' => 'text',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'      => 'topppa_scroll_to_top_button_border',
				'exclude'   => ['color'], // phpcs:ignore WordPressVIPMinimum.Performance.WPQueryParams.PostNotIn_exclude
				'selector'  => '{{WRAPPER}} .topppa-scroll-to-top-wrap .topppa-scroll-to-top-button',
				'condition' => [
					'topppa_scroll_to_top_global' => 'yes',
				],
			]
		);

		$this->start_controls_tabs(
			'topppa_scroll_to_top_tabs',
			[
				'separator' => 'before',
				'condition' => [
					'topppa_scroll_to_top_global' => 'yes',
				],
			]
		);

		$this->start_controls_tab(
			'topppa_scroll_to_top_tab_normal',
			[
				'label'     => __( 'Normal', 'topper-pack' ),
				'condition' => [
					'topppa_scroll_to_top_global' => 'yes',
				],
			]
		);

		$this->add_control(
			'topppa_scroll_to_top_button_icon_color',
			[
				'label'     => __( 'Color', 'topper-pack' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'.topppa-scroll-to-top-wrap .topppa-scroll-to-top-button i' => 'color: {{VALUE}}',
					'.topppa-scroll-to-top-wrap .topppa-scroll-to-top-button span' => 'color: {{VALUE}}',
				],
				'condition' => [
					'topppa_scroll_to_top_global'      => 'yes',
					'topppa_scroll_to_top_media_type!' => 'image',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'      => 'topppa_scroll_to_top_button_bg_color',
				'types'     => [ 'classic', 'gradient' ],
				'exclude'   => [ 'image' ], // phpcs:ignore WordPressVIPMinimum.Performance.WPQueryParams.PostNotIn_exclude
				'selector'  => '.topppa-scroll-to-top-wrap .topppa-scroll-to-top-button',
				'condition' => [
					'topppa_scroll_to_top_global' => 'yes',
				],
			]
		);

		$this->add_control(
			'topppa_scroll_to_top_button_border_color',
			[
				'label'     => __( 'Border Color', 'topper-pack' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'.topppa-scroll-to-top-wrap .topppa-scroll-to-top-button' => 'border-color: {{VALUE}}',
				],
				'condition' => [
					'topppa_scroll_to_top_global' => 'yes',
					'topppa_scroll_to_top_button_border_border!' => '',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'topppa_scroll_to_top_tab_hover',
			[
				'label'     => __( 'Hover', 'topper-pack' ),
				'condition' => [
					'topppa_scroll_to_top_global' => 'yes',
				],
			]
		);

		$this->add_control(
			'topppa_scroll_to_top_button_icon_hvr_color',
			[
				'label'     => __( 'Color', 'topper-pack' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'.topppa-scroll-to-top-wrap .topppa-scroll-to-top-button:hover i' => 'color: {{VALUE}}',
					'.topppa-scroll-to-top-wrap .topppa-scroll-to-top-button:hover span' => 'color: {{VALUE}}',
				],
				'condition' => [
					'topppa_scroll_to_top_global'      => 'yes',
					'topppa_scroll_to_top_media_type!' => 'image',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'      => 'topppa_scroll_to_top_button_bg_hvr_color',
				'types'     => [ 'classic', 'gradient' ],
				'exclude'   => [ 'image' ], // phpcs:ignore WordPressVIPMinimum.Performance.WPQueryParams.PostNotIn_exclude
				'selector'  => '.topppa-scroll-to-top-wrap .topppa-scroll-to-top-button:hover',
				'condition' => [
					'topppa_scroll_to_top_global' => 'yes',
				],
			]
		);

		$this->add_control(
			'topppa_scroll_to_top_button_hvr_border_color',
			[
				'label'     => __( 'Border Color', 'topper-pack' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'.topppa-scroll-to-top-wrap .topppa-scroll-to-top-button:hover' => 'border-color: {{VALUE}}',
				],
				'condition' => [
					'topppa_scroll_to_top_global' => 'yes',
					'topppa_scroll_to_top_button_border_border!' => '',
				],
			]
		);

		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->add_control(
			'topppa_scroll_to_top_button_border_radius',
			[
				'label'      => __( 'Border Radius', 'topper-pack' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px'],
				'selectors'  => [
					'.topppa-scroll-to-top-wrap .topppa-scroll-to-top-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator'  => 'before',
				'condition'  => [
					'topppa_scroll_to_top_global' => 'yes',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'      => 'topppa_scroll_to_top_button_box_shadow',
				'exclude'   => [ 'box_shadow_position' ], // phpcs:ignore WordPressVIPMinimum.Performance.WPQueryParams.PostNotIn_exclude
				'selector'  => '.topppa-scroll-to-top-wrap .topppa-scroll-to-top-button',
				'condition' => [
					'topppa_scroll_to_top_global' => 'yes',
				],
			]
		);

		$this->end_controls_section();
	}
}
