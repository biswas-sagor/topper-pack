<?php

use \TopperPack\Includes\Controls\Controls_Manager as TopperPack_Controls_Manager;

if (! defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}

/**
 * Elementor topppa Header Info Widget.
 *
 * Elementor widget that inserts an embbedable content into the page, from any given URL.
 *
 * @since 1.0.0
 */
class TOPPPA_Header_Info_Widget extends \Elementor\Widget_Base {

	/**
	 * Get widget name.
	 *
	 * Retrieve Header Info widget widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'topppa_header_info';
	}

	/**
	 * Get widget title.
	 *
	 * Retrieve Header Info widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget title.
	 */
	public function get_title() {
		return TOPPPA_EPWB . esc_html__('Header Info', 'topper-pack');
	}

	/**
	 * Get widget icon.
	 *
	 * Retrieve Header Info widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-info-circle-o';
	}

	/**
	 * Get widget categories.
	 *
	 * Retrieve the list of categories the Header Info widget belongs to.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return array Widget categories.
	 */
	public function get_categories() {
		return ['topper-pack'];
	}

	/**
	 * Get widget keywords.
	 *
	 * Retrieve the list of keywords the Header Info widget belongs to.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return array Widget keywords.
	 */
	public function get_keywords() {
		return ['topppa', 'widget', 'header', 'info', 'topperpack'];
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
	public function get_custom_help_url() {
		return 'https://doc.topperpack.com/docs/service-widgets/header-info/';
	}

	/**
	 * Register Header Info widget controls.
	 *
	 * Add input fields to allow the user to customize the widget settings.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function register_controls() {

		// <========================> topppa LOGO OPTIONS <========================>
		$this->start_controls_section(
			'topppa_header_info_options',
			[
				'label' => esc_html__('Header Info', 'topper-pack'),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'topppa_hi_info_styles',
			[
				'label' => esc_html__('Info Styles', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'style_one',
				'options' => [
					'style_one' => esc_html__('Style One', 'topper-pack'),
					'style_two' => esc_html__('Style Two', 'topper-pack'),
					'style_three' => esc_html__('Style Three', 'topper-pack'),
					'style_four' => esc_html__('Style Four', 'topper-pack'),
					'style_five' => esc_html__('Style Five', 'topper-pack'),
					'style_six' => esc_html__('Style Six', 'topper-pack'),
				],
			]
		);
		$this->add_control(
			'info_divider',
			[
				'label' => esc_html__('Divider', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'none',
				'options' => [
					'none' => esc_html__('Hide', 'topper-pack'),
					'block' => esc_html__('Show', 'topper-pack'),
				],
				'selectors' => [
					'{{WRAPPER}} .topppa-header-info-item::after' => 'display: {{VALUE}}',
					'{{WRAPPER}} .topppa-header-info-item.item-v4:not(:last-child)::after' => 'display: {{VALUE}}',
				],
			]
		);
		$this->add_responsive_control(
			'topppa_hi_box_a_border_color',
			[
				'label' => esc_html__('Color', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .topppa-header-info-item::after' => 'background: {{VALUE}}',
					'{{WRAPPER}} .topppa-header-info-item.item-v4:not(:last-child)::after' => 'background: {{VALUE}}',
				],
				'condition' => [
					'info_divider' => 'block'
				]
			]
		);
		$this->add_responsive_control(
			'topppa_hi_box_a_border_width',
			[
				'label' => esc_html__('Width', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px', '%', 'em', 'rem', 'custom'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .topppa-header-info-item:not(:last-child)::after' => 'width: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'info_divider' => 'block'
				]
			]
		);

		$repeater = new \Elementor\Repeater();
		$repeater->add_control(
			'topppa_hi_icon',
			[
				'label' => esc_html__('Icon', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::ICONS,
				'default' => [
					'value' => 'fas fa-map-marker-alt',
					'library' => 'fa-solid',
				],
			]
		);

		$repeater->add_control(
			'topppa_hi_label',
			[
				'label' => esc_html__('Label', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__('Location', 'topper-pack'),
				'label_block' => true,
			]
		);

		$repeater->add_control(
			'topppa_hi_details',
			[
				'label' => esc_html__('Info', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::WYSIWYG,
				'default' => esc_html__('55 Main Street, USA', 'topper-pack'),
			]
		);

		$this->add_control(
			'topppa_hi_lists',
			[
				'label'   => esc_html__('Info List', 'topper-pack'),
				'type'    => \Elementor\Controls_Manager::REPEATER,
				'fields'  => $repeater->get_controls(),
				'default' => [
					[
						'topppa_hi_details' => '55 Main Street, USA',
						'topppa_hi_icon' => [
							'value' => 'fas fa-map-marker-alt',
							'library' => 'fa-solid',
						],
					],
				],
				'title_field' => '{{{ topppa_hi_details }}}',
			]
		);

		$this->end_controls_section();

		// <========================> BOX STYLES <========================>
		$this->start_controls_section(
			'topppa_hi_box_styles',
			[
				'label' => esc_html__('Info Box', 'topper-pack'),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_responsive_control(
			'topppa_hi_box_direction',
			[
				'label' => esc_html__('Info Direction', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'row',
				'options' => [
					'row' => esc_html__('Row', 'topper-pack'),
					'column' => esc_html__('Column', 'topper-pack'),
				],
				'selectors' => [
					'{{WRAPPER}} .topppa-header-info-wrapper' => 'flex-direction: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'topppa_hi_c_align',
			[
				'label' => esc_html__('Alignment', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'options' => [
					'start' => [
						'title' => esc_html__('Left', 'topper-pack'),
						'icon' => 'eicon-order-start',
					],
					'center' => [
						'title' => esc_html__('Center', 'topper-pack'),
						'icon' => 'eicon-h-align-center',
					],
					'end' => [
						'title' => esc_html__('Right', 'topper-pack'),
						'icon' => 'eicon-order-end',
					],
				],
				'toggle' => true,
				'selectors' => [
					'{{WRAPPER}} .topppa-header-info-wrapper' => 'align-items: {{VALUE}};',
				],
				'condition' => [
					'topppa_hi_box_direction' => 'column'
				]
			]
		);

		$this->add_responsive_control(
			'topppa_hi_r_align',
			[
				'label' => esc_html__('Alignment', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'options' => [
					'start' => [
						'title' => esc_html__('Left', 'topper-pack'),
						'icon' => 'eicon-align-start-v',
					],
					'center' => [
						'title' => esc_html__('Center', 'topper-pack'),
						'icon' => 'eicon-align-center-v',
					],
					'end' => [
						'title' => esc_html__('Right', 'topper-pack'),
						'icon' => 'eicon-align-end-v',
					],
				],
				'toggle' => true,
				'selectors' => [
					'{{WRAPPER}} .topppa-header-info-wrapper' => 'align-items: {{VALUE}};',
				],
				'condition' => [
					'topppa_hi_box_direction' => 'row'
				]
			]
		);
		$this->add_responsive_control(
			'topppa_hi_gap',
			[
				'label' => esc_html__('Gap', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px', '%', 'em', 'rem', 'custom'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .topppa-header-info-wrapper' => 'gap: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name'     => 'topppa_hi_box_bg',
				'label'    => esc_html__('Background', 'topper-pack'),
				'types'    => ['classic', 'gradient'],
				'selector' => '{{WRAPPER}} .topppa-header-info-item',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'topppa_hi_box_border2',
				'selector' => '{{WRAPPER}} .topppa-header-info-item:not(:last-child)',
			]
		);
		$this->add_responsive_control(
			'topppa_hi_item_border_radius',
			[
				'label' => esc_html__('Border Radius', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .topppa-header-info-item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'topppa_hi_box_shadow',
				'label'    => esc_html__('Box Shadow', 'topper-pack'),
				'selector' => '{{WRAPPER}} .topppa-header-info-item',
			]
		);

		$this->add_responsive_control(
			'topppa_hi_box_margin',
			[
				'label'      => esc_html__('Margin', 'topper-pack'),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors'  => [
					'{{WRAPPER}} .topppa-header-info-item' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'topppa_hi_box_padding',
			[
				'label'      => esc_html__('Padding', 'topper-pack'),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors'  => [
					'{{WRAPPER}} .topppa-header-info-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();

		// <========================> topppa HEADER INFO ICON STYLES <========================>
		$this->start_controls_section(
			'topppa_hi_item_icon',
			[
				'label' => esc_html__('Info Icon', 'topper-pack'),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_responsive_control(
			'topppa_icon_position',
			[
				'label' => esc_html__('Icon Alignment', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'options' => [
					'start' => [
						'title' => esc_html__('Left', 'topper-pack'),
						'icon' => 'eicon-align-start-v',
					],
					'center' => [
						'title' => esc_html__('Center', 'topper-pack'),
						'icon' => 'eicon-align-center-h',
					],
					'end' => [
						'title' => esc_html__('Right', 'topper-pack'),
						'icon' => 'eicon-align-end-v',
					],
				],
				'toggle' => true,
				'selectors' => [
					'{{WRAPPER}} .topppa-header-info-item' => 'align-items: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'topppa_hi_item_icon_min_width',
			[
				'label' => esc_html__('Min Width', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px', '%', 'em', 'rem', 'custom'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .topppa-header-info-icon' => 'min-width: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'topppa_hi_info_styles' => ['style_two', 'style_three']
				]
			]
		);

		$this->add_responsive_control(
			'topppa_hi_item_icon_width',
			[
				'label' => esc_html__('Width', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px', '%', 'em', 'rem', 'custom'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .topppa-header-info-icon' => 'width: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'topppa_hi_info_styles' => ['style_two', 'style_three']
				]
			]
		);

		$this->add_responsive_control(
			'topppa_hi_item_icon_height',
			[
				'label' => esc_html__('Height', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px', '%', 'em', 'rem', 'custom'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .topppa-header-info-icon' => 'height: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'topppa_hi_info_styles' => ['style_two', 'style_three']
				]
			]
		);

		$this->add_responsive_control(
			'topppa_hi_item_icon_gap',
			[
				'label' => esc_html__('Gap', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px', '%', 'em', 'rem', 'custom'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .topppa-header-info-item' => 'gap: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'topppa_hi_item_icon_background',
				'types' => ['classic', 'gradient', 'video'],
				'selector' => '{{WRAPPER}} .topppa-header-info-icon',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'topppa_hi_item_icon_border',
				'selector' => '{{WRAPPER}} .topppa-header-info-icon',
			]
		);

		$this->add_responsive_control(
			'topppa_hi_item_icon_border_radius',
			[
				'label' => esc_html__('Border Radius', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .topppa-header-info-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'topppa_hi_item_icon_typo',
				'selector' => '{{WRAPPER}} .topppa-header-info-icon',
			]
		);

		$this->add_responsive_control(
			'topppa_hi_item_icon_color',
			[
				'label'     => esc_html__('Color', 'topper-pack'),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .topppa-header-info-icon' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_responsive_control(
			'topppa_hi_item_icon_margin',
			[
				'label' => esc_html__('Margin', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em', 'rem', 'custom'],
				'selectors' => [
					'{{WRAPPER}} .topppa-header-info-icon' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'topppa_hi_item_icon_padding',
			[
				'label' => esc_html__('Padding', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em', 'rem', 'custom'],
				'selectors' => [
					'{{WRAPPER}} .topppa-header-info-icon' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		// <======> SVG OPTIONS <======>
		$this->add_control(
			'topppa_hi_item_svg_icon',
			[
				'label' => esc_html__('SVG Styles', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'topppa_hi_item_svg_color',
			[
				'label' => esc_html__('SVG Color', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .topppa-header-info-icon svg path' => 'fill: {{VALUE}}',
				],
			]
		);

		$this->add_responsive_control(
			'topppa_hi_item_svg_height',
			[
				'label' => esc_html__('Height', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px', '%', 'em', 'rem', 'custom'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .topppa-header-info-icon' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'topppa_hi_item_svg_width',
			[
				'label' => esc_html__('Width', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px', '%', 'em', 'rem', 'custom'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .topppa-header-info-icon' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		// <========================> topppa HEADER INFO LABEL STYLES <========================>
		$this->start_controls_section(
			'topppa_hi_info_label',
			[
				'label' => esc_html__('Info Label', 'topper-pack'),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'topppa_hi_info_label_typo',
				'selector' => '{{WRAPPER}} .topppa-header-label',
			]
		);
		$this->add_responsive_control(
			'topppa_hi_info_label_color',
			[
				'label'     => esc_html__('Color', 'topper-pack'),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .topppa-header-label' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_responsive_control(
			'topppa_hi_info_label_margin',
			[
				'label' => esc_html__('Margin', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em', 'rem', 'custom'],
				'selectors' => [
					'{{WRAPPER}} .topppa-header-label' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'topppa_hi_info_label_padding',
			[
				'label' => esc_html__('Padding', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em', 'rem', 'custom'],
				'selectors' => [
					'{{WRAPPER}} .topppa-header-label' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		// <========================> topppa HEADER INFO STYLES <========================>
		$this->start_controls_section(
			'topppa_hi_info_box',
			[
				'label' => esc_html__('Info Details', 'topper-pack'),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'topppa_hi_info_typo',
				'selector' => '{{WRAPPER}} .topppa-header-info',
			]
		);
		$this->add_responsive_control(
			'topppa_hi_info_color',
			[
				'label'     => esc_html__('Color', 'topper-pack'),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .topppa-header-info' => 'color: {{VALUE}}',
					'{{WRAPPER}} .topppa-header-info a' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_responsive_control(
			'topppa_hi_info_hcolor',
			[
				'label'     => esc_html__('Hover Color', 'topper-pack'),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .topppa-header-info a:hover' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_responsive_control(
			'topppa_hi_info_margin',
			[
				'label' => esc_html__('Margin', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em', 'rem', 'custom'],
				'selectors' => [
					'{{WRAPPER}} .topppa-header-info' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'topppa_hi_info_padding',
			[
				'label' => esc_html__('Padding', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em', 'rem', 'custom'],
				'selectors' => [
					'{{WRAPPER}} .topppa-header-info' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();
	}

	/**
	 * Render logo widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();
		$allowed_html = [
			'a'      => array(
				'href'   => array(),
				'target' => array(),
				'title'  => array(),
				'rel'    => array(),
			),
			'strong' => array(),
			'small'  => array(),
			'span'   => array(
				'style' => array(),
			),
			'em'     => array(),
			'ul'     => array(),
			'ol'     => array(),
			'li'     => array(),
			'br'     => array(),
			'img'    => array(
				'src'    => array(),
				'title'  => array(),
				'alt'    => array(),
				'width'  => array(),
				'height' => array(),
				'class'  => array(),
			),
			'h1'     => array(),
			'h2'     => array(),
			'h3'     => array(),
			'h4'     => array(),
			'h5'     => array(),
			'h6'     => array(),
		];

		$style_classes = [
			'style_two' => 'item-v2',
			'style_three' => 'item-v3',
			'style_four' => 'item-v4',
			'style_five' => 'item-v5',
			'style_six' => 'item-v6',
		];
		// Get the class name based on the selected style or fallback to an empty string.
		$class = isset($style_classes[$settings['topppa_hi_info_styles']]) ? $style_classes[$settings['topppa_hi_info_styles']] : '';

		if (!empty($settings['topppa_hi_lists']) && is_array($settings['topppa_hi_lists'])) : ?>
			<div class="topppa-header-info-wrapper">
				<?php foreach ($settings['topppa_hi_lists'] as $list) : ?>
					<div class="topppa-header-info-item<?php echo $class ? ' ' . esc_attr($class) : ''; ?>">
						<?php if (!empty($list['topppa_hi_icon']['value'])) : ?>
							<div class="topppa-header-info-icon">
								<?php \Elementor\Icons_Manager::render_icon($list['topppa_hi_icon'], ['aria-hidden' => 'true']); ?>
							</div>
						<?php endif; ?>

						<div class="topppa-header-info-details-wrapper">
							<?php if ($settings['topppa_hi_info_styles'] !== 'style_one' && $settings['topppa_hi_info_styles'] !== 'style_four') : ?>
								<div class="topppa-header-label">
									<?php echo esc_html($list['topppa_hi_label']); ?>
								</div>
							<?php endif; ?>

							<?php if (!empty($list['topppa_hi_details'])) : ?>
								<div class="topppa-header-info">
									<?php echo wp_kses($list['topppa_hi_details'], $allowed_html); ?>
								</div>
							<?php endif; ?>
						</div>
					</div>
				<?php endforeach; ?>
			</div>

<?php endif;
	}
}
