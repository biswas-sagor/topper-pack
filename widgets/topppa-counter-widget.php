<?php

use \TopperPack\Includes\Controls\Controls_Manager as TopperPack_Controls_Manager;

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}

/**
 * Elementor Counter Info Widget.
 *
 * Elementor widget that inserts an embbedable content into the page, from any given URL.
 *
 * @since 1.0.0
 */
class TOPPPA_Counter_Widget extends \Elementor\Widget_Base {

	/**
	 * Get widget name.
	 *
	 * Retrieve widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'topppa_counter_widget';
	}

	/**
	 * Get widget title.
	 *
	 * Retrieve widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget title.
	 */
	public function get_title() {
		return TOPPPA_EPWB . esc_html__('Counter', 'topper-pack');
	}

	/**
	 * Get widget icon.
	 *
	 * Retrieve widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-counter';
	}

	/**
	 * Get widget categories.
	 *
	 * Retrieve the list of categories the widget belongs to.
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
	 * Retrieve the list of keywords the widget belongs to.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return array Widget keywords.
	 */
	public function get_keywords() {
		return ['topppa', 'widget', 'counter', 'topperpack'];
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
		return 'https://doc.topperpack.com/docs/service-widgets/counter/';
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
	public function get_custom_image_url() {
		return 'https://topperpack.com/assets/widgets/counter-widget/';
	}

	/**
	 * Register Counter widget controls.
	 *
	 * Add input fields to allow the user to customize the widget settings.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function register_controls() {
		$base_url = $this->get_custom_image_url();

		$this->start_controls_section(
			'topppa_service_style',
			[
				'label' => esc_html__('Counter Styles', 'topper-pack'),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'topppa_service_styles',
			[
				'label' => esc_html__('Choose Style', 'topper-pack'),
				'type' => TopperPack_Controls_Manager::IMAGECHOOSE,
				'default' => 'style_one',
				'options' => [
					'style_one' => [
						'title' => esc_html__('Style 1', 'topper-pack'),
						'imagelarge' => $base_url . 'topppa-counter.jpg',
						'imagesmall' => $base_url . 'topppa-counter.jpg',
						'width' => '100%',
					],
					'style_two' => [
						'title' => esc_html__('Style 2', 'topper-pack'),
						'imagelarge' => $base_url . 'topppa-counter-2.jpg',
						'imagesmall' => $base_url . 'topppa-counter-2.jpg',
						'width' => '100%',
					],
					'style_three' => [
						'title' => esc_html__('Style 3', 'topper-pack'),
						'imagelarge' => $base_url . 'topppa-counter-3.jpg',
						'imagesmall' => $base_url . 'topppa-counter-3.jpg',
						'width' => '100%',
					],
					'style_four' => [
						'title' => esc_html__('Style 4', 'topper-pack'),
						'imagelarge' => $base_url . 'topppa-counter-4.jpg',
						'imagesmall' => $base_url . 'topppa-counter-4.jpg',
						'width' => '100%',
					],
					'style_five' => [
						'title' => esc_html__('Style 5', 'topper-pack'),
						'imagelarge' => $base_url . 'topppa-counter-5.jpg',
						'imagesmall' => $base_url . 'topppa-counter-5.jpg',
						'width' => '100%',
					],
					'style_six' => [
						'title' => esc_html__('Style 6', 'topper-pack'),
						'imagelarge' => $base_url . 'topppa-counter-6.jpg',
						'imagesmall' => $base_url . 'topppa-counter-6.jpg',
						'width' => '100%',
					],
					'style_seven' => [
						'title' => esc_html__('Style 7', 'topper-pack'),
						'imagelarge' => $base_url . 'topppa-counter-7.jpg',
						'imagesmall' => $base_url . 'topppa-counter-7.jpg',
						'width' => '100%',
					],
					'style_eight' => [
						'title' => esc_html__('Style 8', 'topper-pack'),
						'imagelarge' => $base_url . 'topppa-counter-8.jpg',
						'imagesmall' => $base_url . 'topppa-counter-8.jpg',
						'width' => '100%',
					],
					'style_nine' => [
						'title' => esc_html__('Style 9', 'topper-pack'),
						'imagelarge' => $base_url . 'topppa-counter-9.jpg',
						'imagesmall' => $base_url . 'topppa-counter-9.jpg',
						'width' => '100%',
					],
					'style_ten' => [
						'title' => esc_html__('Style 10', 'topper-pack'),
						'imagelarge' => $base_url . 'topppa-counter-9.jpg',
						'imagesmall' => $base_url . 'topppa-counter-9.jpg',
						'width' => '100%',
					],
					'style_eleven' => [
						'title' => esc_html__('Style 11', 'topper-pack'),
						'imagelarge' => $base_url . 'topppa-counter-9.jpg',
						'imagesmall' => $base_url . 'topppa-counter-9.jpg',
						'width' => '100%',
					],
					'style_twelve' => [
						'title' => esc_html__('Style 12', 'topper-pack'),
						'imagelarge' => $base_url . 'topppa-counter-9.jpg',
						'imagesmall' => $base_url . 'topppa-counter-9.jpg',
						'width' => '100%',
					],
				],
			]
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'counter_v1_options',
			[
				'label' => esc_html__('Counter', 'topper-pack'),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'topppa_counter_img',
			[
				'label' => esc_html__('Choose Image', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'condition' => [
					'topppa_service_styles' => ['style_eight', 'style_ten'],
				],
			]
		);
		$this->add_control(
			'bg_image_position',
			[
				'label' => esc_html__('Background Position', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'center center',
				'options' => [
					'left top' => esc_html__('Left Top', 'topper-pack'),
					'left center' => esc_html__('Left Center', 'topper-pack'),
					'left bottom' => esc_html__('Left Bottom', 'topper-pack'),
					'center top' => esc_html__('Center Top', 'topper-pack'),
					'center center' => esc_html__('Center Center', 'topper-pack'),
					'center bottom' => esc_html__('Center Bottom', 'topper-pack'),
					'right top' => esc_html__('Right Top', 'topper-pack'),
					'right center' => esc_html__('Right Center', 'topper-pack'),
					'right bottom' => esc_html__('Right Bottom', 'topper-pack'),
				],
				'selectors' => [
					'{{WRAPPER}} .topppa-counter-wrapper' => 'background-position: {{VALUE}};',
				],
				'condition' => [
					'topppa_service_styles' => 'style_ten',
				],
			]
		);
		$this->add_control(
			'background_size',
			[
				'label' => esc_html__('Background Size', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'cover',
				'options' => [
					'auto' => esc_html__('Auto', 'topper-pack'),
					'cover' => esc_html__('Cover', 'topper-pack'),
					'contain' => esc_html__('Contain', 'topper-pack'),
					'custom' => esc_html__('Custom', 'topper-pack'),
				],
				'selectors' => [
					'{{WRAPPER}} .topppa-counter-wrapper' => 'background-size: {{VALUE}};',
				],
				'condition' => [
					'topppa_service_styles' => 'style_ten',
				],
			]
		);

		$this->add_control(
			'topppa_counter_shape',
			[
				'label' => esc_html__('Choose Shape', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'condition' => [
					'topppa_service_styles' => 'style_five',
				],
			]
		);
		$this->add_control(
			'enable_icon',
			[
				'label' => esc_html__('Show Icon', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Show', 'topper-pack'),
				'label_off' => esc_html__('Hide', 'topper-pack'),
				'return_value' => 'yes',
				'default' => 'yes',
				'condition' => [
					'topppa_service_styles!' => ['style_ten', 'style_twelve'],
				],
			]
		);
		$this->add_control(
			'prefix_icon',
			[
				'label' => esc_html__('Prefix Icon', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::ICONS,
				'default' => [
					'value' => '',
					'library' => 'fa-solid',
				],
				'condition' => [
					'enable_icon' => 'yes',
					'topppa_service_styles!' => ['style_ten', 'style_twelve'],
				],
			]
		);
		$this->add_control(
			'topppa_counter_icon',
			[
				'label' => esc_html__('Icon', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::ICONS,
				'default' => [
					'value' => 'fas fa-image',
					'library' => 'fa-solid',
				],
				'condition' => [
					'topppa_service_styles' => ['style_one', 'style_three', 'style_five',],
					'enable_icon' => 'yes'
				],
			]
		);
		$this->add_control(
			'show_number',
			[
				'label' => esc_html__('Show Number', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Show', 'topper-pack'),
				'label_off' => esc_html__('Hide', 'topper-pack'),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);
		$this->add_control(
			'topppa_counter_number',
			[
				'label' => esc_html__('Number', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'min' => 1,
				'max' => 10000000,
				'step' => 1,
				'default' => 15,
			]
		);
		// Add prefix field for counter number
		$this->add_control(
			'topppa_counter_prefix',
			[
				'label' => esc_html__('Prefix', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => '',
				'condition' => [
					'topppa_service_styles!' => 'style_ten',
				],
			]
		);
		$this->add_control(
			'topppa_counter_symble',
			[
				'label' => esc_html__('Symble', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__('K', 'topper-pack'),
			]
		);
		$this->add_control(
			'topppa_counter_title',
			[
				'label' => esc_html__('Title', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'rows' => 6,
				'default' => esc_html__('Total Posts', 'topper-pack'),
			]
		);
		$this->add_control(
			'topppa_counter_desc',
			[
				'label' => esc_html__('Description', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'rows' => 6,
				'default' => esc_html__('Dui lobortis scelerisque magna curabitur duis purus platea massa accumsan', 'topper-pack'),
				'condition' => [
					'topppa_service_styles' => 'style_seven',
				],
			]
		);

		$this->add_control(
			'enable_number_bg_effect',
			[
				'label' => esc_html__('Enable Number Background Effect', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Show', 'topper-pack'),
				'label_off' => esc_html__('Hide', 'topper-pack'),
				'return_value' => 'yes',
				'default' => 'no',
				'condition' => [
					'topppa_service_styles' => 'style_twelve',
				],
			]
		);
		$this->add_control(
			'bg_image',
			[
				'label' => esc_html__('Image', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'condition' => [
					'enable_number_bg_effect' => 'yes',
					'topppa_service_styles' => 'style_twelve',
				],
			]
		);
		$this->add_control(
			'topppa_counter_speed',
			[
				'label' => esc_html__('Counter Speed', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'min' => 500,
				'max' => 15000,
				'step' => 100,
				'default' => 1000,
			]
		);
		$this->end_controls_section();

		// <==========>
		// <==========> BOX STYLES <==========>

		$this->start_controls_section(
			'box_styles',
			[
				'label' => esc_html__('Box Style', 'topper-pack'),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_responsive_control(
			'counter_boxwidth',
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
					'{{WRAPPER}} .topppa-counter-wrapper .counter-number-wrp' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'box_border_color_v2',
			[
				'label' => esc_html__('Border Color', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .topppa-counter-wrapper.counter-v2::after' => 'border-color: {{VALUE}}',
					'{{WRAPPER}} .topppa-counter-wrapper.counter-v7 .number-wrp' => 'border-color: {{VALUE}}',
				],
				'condition' => [
					'topppa_service_styles' => ['style_two', 'style_seven']
				],
			]
		);
		$this->add_responsive_control(
			'box_line_color',
			[
				'label' => esc_html__('Shape', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .topppa-counter-wrapper.counter-v4 .counter-line' => 'background-color: {{VALUE}}',
					'{{WRAPPER}} .topppa-counter-wrapper.counter-v5::before' => 'background-color: {{VALUE}}',
					'{{WRAPPER}} .topppa-counter-wrapper.counter-v6::before' => 'background-color: {{VALUE}}',
				],
				'condition' => [
					'topppa_service_styles' => ['style_four', 'style_five', 'style_six'],
				],
			]
		);
		$this->add_responsive_control(
			'box_shape_two_color',
			[
				'label' => esc_html__('Shape Two', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .topppa-counter-wrapper.counter-v6::after' => 'background-color: {{VALUE}}',
				],
				'condition' => [
					'topppa_service_styles' => 'style_six',
				],
			]
		);
		$this->add_responsive_control(
			'box_shape_two_b_color',
			[
				'label' => esc_html__('Shape Two Border', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .topppa-counter-wrapper.counter-v6::after' => 'border-color: {{VALUE}}',
				],
				'condition' => [
					'topppa_service_styles' => 'style_six',
				],
			]
		);
		$this->add_responsive_control(
			'box_direction',
			[
				'label' => esc_html__('Direction', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'none',
				'options' => [
					'none' => esc_html__('None', 'topper-pack'),
					'row' => esc_html__('Row', 'topper-pack'),
					'row-reverse' => esc_html__('Row Reverse', 'topper-pack'),
					'column' => esc_html__('Column', 'topper-pack'),
					'column-reverse' => esc_html__('Column Reverse', 'topper-pack'),
				],
				'selectors' => [
					'{{WRAPPER}} .topppa-counter-wrapper' => 'flex-direction: {{VALUE}};',
				],
			]
		);
		$this->add_responsive_control(
			'box_align',
			[
				'label' => esc_html__('Column Alignment', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'options' => [
					'start' => [
						'title' => esc_html__('Left', 'topper-pack'),
						'icon' => 'eicon-align-start-h',
					],
					'center' => [
						'title' => esc_html__('Center', 'topper-pack'),
						'icon' => 'eicon-align-center-h',
					],
					'end' => [
						'title' => esc_html__('Right', 'topper-pack'),
						'icon' => 'eicon-align-end-h',
					],
				],
				'default' => 'center',
				'toggle' => true,
				'selectors' => [
					'{{WRAPPER}} .topppa-counter-wrapper' => 'align-items: {{VALUE}};',
				],
				'condition' => [
					'box_direction' => ['column', 'column-reverse'],
				]
			]
		);
		$this->add_responsive_control(
			'box_jalign',
			[
				'label' => esc_html__('Row Alignment', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'options' => [
					'start' => [
						'title' => esc_html__('Left', 'topper-pack'),
						'icon' => 'eicon-align-start-h',
					],
					'center' => [
						'title' => esc_html__('Center', 'topper-pack'),
						'icon' => 'eicon-align-center-h',
					],
					'end' => [
						'title' => esc_html__('Right', 'topper-pack'),
						'icon' => 'eicon-align-end-h',
					],
				],
				'toggle' => true,
				'selectors' => [
					'{{WRAPPER}} .topppa-counter-wrapper' => 'justify-content: {{VALUE}};',
				],
				'condition' => [
					'box_direction' => ['row', 'row-reverse'],
				]
			]
		);
		$this->add_responsive_control(
			'box_text_align',
			[
				'label' => esc_html__('Text Alignment', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => esc_html__('Left', 'topper-pack'),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => esc_html__('Center', 'topper-pack'),
						'icon' => 'eicon-text-align-center',
					],
					'right' => [
						'title' => esc_html__('Right', 'topper-pack'),
						'icon' => 'eicon-text-align-right',
					],
				],
				'default' => 'left',
				'toggle' => true,
				'selectors' => [
					'{{WRAPPER}} .topppa-counter-wrapper' => 'text-align: {{VALUE}};',
				],
			]
		);
		$this->add_responsive_control(
			'box_gap',
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
					'{{WRAPPER}} .topppa-counter-wrapper .counter-number-wrp' => 'gap: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'topppa_service_styles!' => ['style_ten', 'style_eleven'],
				],
			]
		);
		$this->add_responsive_control(
			'box_height',
			[
				'label' => esc_html__('Box Height', 'topper-pack'),
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
					'{{WRAPPER}} .topppa-counter-wrapper.counter-v10 .counter-number-wrp' => 'height: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'topppa_service_styles' => 'style_ten',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'box_bg',
				'label' => esc_html__('Background', 'topper-pack'),
				'types' => ['classic', 'gradient'],
				'selector' => '{{WRAPPER}} .topppa-counter-wrapper',
				'condition' => [
					'topppa_service_styles!' => 'style_ten',
				],
			]
		);
		$this->add_responsive_control(
			'box_background_color',
			[
				'label' => esc_html__('Background Color', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .topppa-counter-wrapper.counter-v10:after' => 'background-color: {{VALUE}}',
				],
				'condition' => [
					'topppa_service_styles' => 'style_ten',
				],
			]
		);
		$this->add_responsive_control(
			'box_bg_color_hover',
			[
				'label' => esc_html__('Background Hover Color', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .topppa-counter-wrapper.counter-v10:hover::after' => 'background-color: {{VALUE}}',
				],
				'condition' => [
					'topppa_service_styles' => 'style_ten',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'box_border',
				'label' => esc_html__('Border', 'topper-pack'),
				'selector' => '{{WRAPPER}} .topppa-counter-wrapper',
			]
		);
		$this->add_responsive_control(
			'box_radius',
			[
				'label' => esc_html__('Border Radius', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .topppa-counter-wrapper' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'box_shadow',
				'label' => esc_html__('Box Shadow', 'topper-pack'),
				'selector' => '{{WRAPPER}} .topppa-counter-wrapper',
			]
		);
		$this->add_responsive_control(
			'box_margin',
			[
				'label' => esc_html__('Margin', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .topppa-counter-wrapper' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'box_padding',
			[
				'label' => esc_html__('Padding', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .topppa-counter-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();
		// <==========>
		// <=================> ICON STYLES <=================>
		$this->start_controls_section(
			'counter_icon_style',
			[
				'label' => esc_html__('Icon Style', 'topper-pack'),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
				'condition' => [
					'topppa_service_styles' => ['style_one', 'style_three', 'style_five', 'style_seven'],
					'enable_icon' => 'yes'
				],
			],
		);
		$this->start_controls_tabs(
			'counter_icon_tabs',
		);
		$this->start_controls_tab(
			'counter_icon_tab',
			[
				'label' => esc_html__('Normal', 'topper-pack'),
			],
		);
		$this->add_responsive_control(
			'counter_icon_height',
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
					'{{WRAPPER}} .topppa-counter-wrapper .counter-icon' => 'height: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .topppa-counter-wrapper .counter-number-wrp .counter-prefix-icon' => 'height: {{SIZE}}{{UNIT}};',
				],
			],
		);
		$this->add_responsive_control(
			'counter_icon_width',
			[
				'label' => esc_html__('Width', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px', '%'],
				'range' => [
					'px' => [
						'min' => 20,
						'max' => 300,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .topppa-counter-wrapper .counter-icon' => 'width: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .topppa-counter-wrapper .counter-number-wrp .counter-prefix-icon' => 'width: {{SIZE}}{{UNIT}};',
				],
			],
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'counter_icon_typo',
				'selector' => '{{WRAPPER}} .topppa-counter-wrapper .counter-icon, .topppa-counter-wrapper .counter-number-wrp .counter-prefix-icon',
			],
		);
		$this->add_responsive_control(
			'counter_icon_color',
			[
				'label' => esc_html__('Icon Color', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .topppa-counter-wrapper .counter-icon' => 'color: {{VALUE}}',
					'{{WRAPPER}} .topppa-counter-wrapper .counter-number-wrp .counter-prefix-icon' => 'color: {{SIZE}}{{UNIT}};',
				],
			],
		);
		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'counter_icon_bg',
				'types' => ['classic', 'gradient', 'video'],
				'selector' => '{{WRAPPER}} .topppa-counter-wrapper .counter-icon, .topppa-counter-wrapper .counter-number-wrp .counter-prefix-icon',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'counter_icon_border',
				'label' => esc_html__('Border', 'topper-pack'),
				'selector' => '{{WRAPPER}} .topppa-counter-wrapper .counter-icon, .topppa-counter-wrapper .counter-number-wrp .counter-prefix-icon',
			],
		);
		$this->add_responsive_control(
			'counter_icon_border_radius',
			[
				'label' => esc_html__('Border Radius', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .topppa-counter-wrapper .counter-icon, .topppa-counter-wrapper .counter-number-wrp .counter-prefix-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			],
		);
		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'counter_icon_shadow',
				'selector' => '{{WRAPPER}} .topppa-counter-wrapper .counter-icon, .topppa-counter-wrapper .counter-number-wrp .counter-prefix-icon',
			],
		);
		$this->add_control(
			'svg_styles',
			[
				'label' => esc_html__('SVG Styles', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			],
		);
		$this->add_responsive_control(
			'counter_svg_color',
			[
				'label' => esc_html__('Color', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .topppa-counter-wrapper .counter-icon svg path' => 'fill: {{VALUE}}',
					'{{WRAPPER}} .topppa-counter-wrapper .counter-number-wrp .counter-prefix-icon svg path' => 'fill: {{VALUE}}',
				],
			],
		);
		$this->add_responsive_control(
			'counter_svg_height',
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
					'{{WRAPPER}} .topppa-counter-wrapper .counter-icon svg' => 'height: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .topppa-counter-wrapper .counter-number-wrp .counter-prefix-icon' => 'height: {{SIZE}}{{UNIT}};',
				],
			],
		);
		$this->add_responsive_control(
			'counter_svg_width',
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
					'{{WRAPPER}} .topppa-counter-wrapper .counter-icon svg' => 'width: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .topppa-counter-wrapper .counter-number-wrp .counter-prefix-icon svg' => 'width: {{SIZE}}{{UNIT}};',
				],
			],
		);
		$this->end_controls_tab();
		// <==========> ICON HOVER STYLES <==========>

		$this->start_controls_tab(
			'counter_icon_hover_tab',
			[
				'label' => esc_html__('Hover', 'topper-pack'),
			]
		);
		$this->add_responsive_control(
			'counter_icon_color_hover',
			[
				'label' => esc_html__('Color', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .topppa-counter-wrapper:hover .counter-icon' => 'color: {{VALUE}}',
					'{{WRAPPER}} .topppa-counter-wrapper:hover .counter-number-wrp .counter-prefix-icon' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'counter_icon_hover_bg',
				'types' => ['classic', 'gradient', 'video'],
				'selector' => '{{WRAPPER}} .topppa-counter-wrapper:hover .counter-icon, .topppa-counter-wrapper:hover .counter-number-wrp .counter-prefix-icon',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'counter_icon_hover_border',
				'label' => esc_html__('Border', 'topper-pack'),
				'selector' => '{{WRAPPER}} .topppa-counter-wrapper:hover .counter-icon, .topppa-counter-wrapper:hover .counter-number-wrp .counter-prefix-icon',
			]
		);
		$this->add_responsive_control(
			'counter_icon_border_hover_radius',
			[
				'label' => esc_html__('Border Radius', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .topppa-counter-wrapper:hover .counter-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .topppa-counter-wrapper:hover .counter-number-wrp .counter-prefix-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'counter_icon_shadow_hover',
				'selector' => '{{WRAPPER}} .topppa-counter-wrapper:hover .counter-icon, .topppa-counter-wrapper:hover .counter-number-wrp .counter-prefix-icon',
			]
		);

		$this->add_control(
			'hsvg_styles',
			[
				'label' => esc_html__('SVG Styles', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_responsive_control(
			'counter_hsvg_color',
			[
				'label' => esc_html__('Color', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .topppa-counter-wrapper:hover .counter-icon svg path' => 'fill: {{VALUE}}',
					'{{WRAPPER}} .topppa-counter-wrapper:hover .counter-number-wrp .counter-prefix-icon svg path' => 'fill: {{VALUE}}',
				],
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->add_responsive_control(
			'counter_icon_margin',
			[
				'label' => esc_html__('Margin', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em', 'rem', 'custom'],
				'selectors' => [
					'{{WRAPPER}} .topppa-counter-wrapper .counter-icon' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .topppa-counter-wrapper .counter-number-wrp .counter-prefix-icon' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'counter_icon_padding',
			[
				'label' => esc_html__('Padding', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em', 'rem', 'custom'],
				'selectors' => [
					'{{WRAPPER}} .topppa-counter-wrapper .counter-icon' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .topppa-counter-wrapper .counter-number-wrp .counter-prefix-icon' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();

		// <==========>
		// <==========> TITLE STYLES <==========>

		$this->start_controls_section(
			'counter_title_styles',
			[
				'label' => esc_html__('Title', 'topper-pack'),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'counter_title_typo',
				'selector' => '{{WRAPPER}} .topppa-counter-wrapper .counter-number-wrp .counter-title',
			]
		);
		$this->add_responsive_control(
			'counter_title_display',
			[
				'label' => esc_html__('Display', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'block',
				'options' => [
					'block' => esc_html__('Block', 'topper-pack'),
					'flex' => esc_html__('Flex', 'topper-pack'),
				],
				'selectors' => [
					'{{WRAPPER}} .topppa-counter-wrapper .counter-number-wrp' => 'display: {{VALUE}};',
				],
				'condition' => [
					'topppa_service_styles!' => 'style_ten',
				],
			]
		);
		$this->add_responsive_control(
			'counter_title_flex_direction',
			[
				'label' => esc_html__('Flex Direction', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'row',
				'options' => [
					'row' => esc_html__('Row', 'topper-pack'),
					'row-reverse' => esc_html__('Row Reverse', 'topper-pack'),
					'column' => esc_html__('Column', 'topper-pack'),
					'column-reverse' => esc_html__('Column Reverse', 'topper-pack'),
				],
				'selectors' => [
					'{{WRAPPER}} .topppa-counter-wrapper .counter-number-wrp' => 'flex-direction: {{VALUE}};',
				],
				'condition' => [
					'counter_title_display' => 'flex',
					'topppa_service_styles!' => 'style_ten',
				],
			]
		);
		$this->add_responsive_control(
			'counter_title_align_items',
			[
				'label' => esc_html__('Align Items', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'stretch',
				'options' => [
					'stretch' => esc_html__('Stretch', 'topper-pack'),
					'flex-start' => esc_html__('Flex Start', 'topper-pack'),
					'center' => esc_html__('Center', 'topper-pack'),
					'flex-end' => esc_html__('Flex End', 'topper-pack'),
					'baseline' => esc_html__('Baseline', 'topper-pack'),
				],
				'selectors' => [
					'{{WRAPPER}} .topppa-counter-wrapper .counter-number-wrp' => 'align-items: {{VALUE}};',
				],
				'condition' => [
					'counter_title_display' => 'flex',
					'topppa_service_styles!' => 'style_ten',
				],
			]
		);
		$this->add_responsive_control(
			'counter_title_color',
			[
				'label' => esc_html__('Color', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .topppa-counter-wrapper .counter-number-wrp .counter-title' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_responsive_control(
			'counter_title_hcolor',
			[
				'label' => esc_html__('Hover Color', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .topppa-counter-wrapper:hover .counter-number-wrp .counter-title' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_responsive_control(
			'counter_title_margin',
			[
				'label' => esc_html__('Margin', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .topppa-counter-wrapper .counter-number-wrp .counter-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'counter_title_padding',
			[
				'label' => esc_html__('Padding', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .topppa-counter-wrapper .counter-number-wrp .counter-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();

		// <==========>
		// <==========> NUMBER STYLES <==========>

		$this->start_controls_section(
			'counter_number_styles',
			[
				'label' => esc_html__('Number', 'topper-pack'),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'counter_number_typo',
				'selector' => '{{WRAPPER}} .counter-number-wrp .number-wrp',
			]
		);
		$this->add_responsive_control(
			'counter_number_color',
			[
				'label' => esc_html__('Color', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .counter-number-wrp .number-wrp' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_responsive_control(
			'counter_number_hcolor',
			[
				'label' => esc_html__('Hover Color', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .topppa-counter-wrapper:hover .counter-number-wrp .number-wrp' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'counter_number_border',
				'selector' => '{{WRAPPER}} .counter-number-wrp .number-wrp',
			]
		);
		$this->add_responsive_control(
			'counter_number_margin',
			[
				'label' => esc_html__('Margin', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .counter-number-wrp .number-wrp' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'counter_number_padding',
			[
				'label' => esc_html__('Padding', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .counter-number-wrp .number-wrp' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'prefix_styles',
			[
				'label' => esc_html__('Prefix Styles', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => [
					'topppa_service_styles!' => ['style_ten', 'style_eleven'],
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'prefix_typo',
				'selector' => '{{WRAPPER}} .topppa-counter-wrapper .counter-number-wrp .counter-prefix',
				'condition' => [
					'topppa_service_styles!' => ['style_ten', 'style_eleven'],
				],
			]
		);
		$this->add_responsive_control(
			'prefix_color',
			[
				'label' => esc_html__('Color', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .topppa-counter-wrapper .counter-number-wrp .counter-prefix' => 'color: {{VALUE}}',
				],
				'condition' => [
					'topppa_service_styles!' => ['style_ten', 'style_eleven'],
				],
			]
		);
		$this->add_responsive_control(
			'prefix_hcolor',
			[
				'label' => esc_html__('Hover Color', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .topppa-counter-wrapper:hover .topppa-counter-wrapper .counter-number-wrp .counter-prefix' => 'color: {{VALUE}}',
				],
				'condition' => [
					'topppa_service_styles!' => ['style_ten', 'style_eleven'],
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'prefix_border',
				'selector' => '{{WRAPPER}} .topppa-counter-wrapper .counter-number-wrp .counter-prefix',
				'condition' => [
					'topppa_service_styles!' => ['style_ten', 'style_eleven'],
				],
			]
		);
		$this->add_responsive_control(
			'prefix_margin',
			[
				'label' => esc_html__('Margin', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .topppa-counter-wrapper .counter-number-wrp .counter-prefix' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'topppa_service_styles!' => ['style_ten', 'style_eleven'],
				],
			]
		);
		$this->add_responsive_control(
			'prefix_padding',
			[
				'label' => esc_html__('Padding', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .topppa-counter-wrapper .counter-number-wrp .counter-prefix' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'topppa_service_styles!' => ['style_ten', 'style_eleven'],
				],
			]
		);
		$this->add_control(
			'symble_styles',
			[
				'label' => esc_html__('Symbol Styles', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => [
					'topppa_service_styles' => ['style_twelve'],
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'symble_typo',
				'selector' => '{{WRAPPER}} .topppa-counter-wrapper.counter-v12 .counter-symble',
				'condition' => [
					'topppa_service_styles' => ['style_twelve'],
				],
			]
		);
		$this->add_responsive_control(
			'symble_color',
			[
				'label' => esc_html__('Color', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .topppa-counter-wrapper.counter-v12 .counter-symble' => 'color: {{VALUE}}',
				],
				'condition' => [
					'topppa_service_styles' => ['style_twelve'],
				],
			]
		);
		$this->add_responsive_control(
			'symble_margin',
			[
				'label' => esc_html__('Margin', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .topppa-counter-wrapper.counter-v12 .counter-symble' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'topppa_service_styles' => ['style_twelve'],
				],
			]
		);
		$this->end_controls_section();
		$this->start_controls_section(
			'counter_prefix_styles_styles',
			[
				'label' => esc_html__('Prefix Styles', 'topper-pack'),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
				'condition' => [
					'topppa_service_styles' => 'style_eleven'
				]
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'counter_prefix_typo',
				'selector' => '{{WRAPPER}} .topppa-counter-wrapper .counter-top-content span',
			]
		);
		$this->add_responsive_control(
			'counter_prefix_color',
			[
				'label' => esc_html__('Color', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .topppa-counter-wrapper .counter-top-content span' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_responsive_control(
			'counter_prefix_icon_color',
			[
				'label' => esc_html__('Icon Color', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .topppa-counter-wrapper .counter-top-content .counter-prefix-icon' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_responsive_control(
			'counter_prefix_hcolor',
			[
				'label' => esc_html__('Hover Color', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .topppa-counter-wrapper:hover .counter-top-content span' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'counter_prefix_border',
				'selector' => '{{WRAPPER}} .topppa-counter-wrapper .counter-top-content',
			]
		);
		$this->add_responsive_control(
			'counter_prefix_margin',
			[
				'label' => esc_html__('Margin', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .topppa-counter-wrapper .counter-top-content' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'counter_prefix_padding',
			[
				'label' => esc_html__('Padding', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .topppa-counter-wrapper .counter-top-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();
		// <==========>
		// <==========> DESCRIPTION STYLES <==========>

		$this->start_controls_section(
			'counter_desc_styles',
			[
				'label' => esc_html__('Description', 'topper-pack'),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
				'condition' => [
					'topppa_service_styles' => 'style_seven'
				]
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'counter_desc_typo',
				'selector' => '{{WRAPPER}} .topppa-counter-wrapper .counter-desc',
			]
		);
		$this->add_responsive_control(
			'counter_desc_color',
			[
				'label' => esc_html__('Color', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .topppa-counter-wrapper .counter-desc' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_responsive_control(
			'counter_desc_hcolor',
			[
				'label' => esc_html__('Hover Color', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .topppa-counter-wrapper:hover .counter-desc' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_responsive_control(
			'counter_desc_margin',
			[
				'label' => esc_html__('Margin', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .topppa-counter-wrapper .counter-desc' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'counter_desc_padding',
			[
				'label' => esc_html__('Padding', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .topppa-counter-wrapper .counter-desc' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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

		$counter_bg_style = ('yes' === $settings['enable_number_bg_effect'] && !empty($settings['bg_image']['id']))
			? 'background-image: url(' . esc_url(wp_get_attachment_image_url($settings['bg_image']['id'], 'full')) . ');'
			: '';
		$imgclass = ('yes' === $settings['enable_number_bg_effect']) ? 'has-bg' : '';
		$style_classes = [
			'style_one' => '',
			'style_two' => 'counter-v2',
			'style_three' => 'counter-v3',
			'style_four' => 'counter-v4',
			'style_five' => 'counter-v5',
			'style_six' => 'counter-v6',
			'style_seven' => 'counter-v7',
			'style_eight' => 'counter-v8',
			'style_nine' => 'counter-v9',
			'style_ten' => 'counter-v10',
			'style_eleven' => 'counter-v11',
			'style_twelve' => 'counter-v12'
		];
		// Get the class name based on the selected style or fallback to an empty string.
		$class = isset($style_classes[$settings['topppa_service_styles']]) ? $style_classes[$settings['topppa_service_styles']] : '';
		$image_url = !empty($settings['topppa_counter_img']['id'])
			? wp_get_attachment_image_url($settings['topppa_counter_img']['id'], 'full')
			: '';
?>

		<div class="topppa-counter-wrapper count-process <?php echo esc_attr($class); ?>" <?php if ($settings['topppa_service_styles'] === 'style_ten'):
																								if ($image_url): ?>
			style="background-image:url(<?php echo esc_url($image_url); ?>)" <?php endif;
																							endif;
																				?>>

			<?php if (in_array($settings['topppa_service_styles'], ['style_one', 'style_three', 'style_five']) && $settings['enable_icon'] === 'yes'): ?>
				<div class="counter-icon">
					<?php
					if (!empty($settings['topppa_counter_icon'])) {
						\Elementor\Icons_Manager::render_icon($settings['topppa_counter_icon'], ['aria-hidden' => 'true']);
					}
					?>
				</div>
			<?php endif; ?>

			<?php if ($settings['topppa_service_styles'] == 'style_eight'): ?>
				<div class="counter-img">
					<?php echo wp_get_attachment_image($settings['topppa_counter_img']['id'], 'full'); ?>
				</div>
			<?php endif; ?>

			<div class="counter-number-wrp">
				<?php if ($settings['topppa_service_styles'] == 'style_eleven'): ?>
					<?php if (!empty($settings['prefix_icon']['value']) || !empty($settings['topppa_counter_prefix'])): ?>
						<div class="counter-top-content">
							<?php if (!empty($settings['prefix_icon']['value'])): ?>
								<span class="counter-prefix-icon">
									<?php \Elementor\Icons_Manager::render_icon($settings['prefix_icon'], ['aria-hidden' => 'true']); ?>
								</span>
							<?php endif; ?>

							<?php if (!empty($settings['topppa_counter_prefix'])): ?>
								<span class="counter-prefix">
									<?php echo esc_html($settings['topppa_counter_prefix']); ?>
								</span>
							<?php endif; ?>
						</div>
					<?php endif; ?>

				<?php endif; ?>
				<div class="number-wrp">
					<?php if (!empty($settings['enable_icon']) && $settings['enable_icon'] === 'yes' && !empty($settings['prefix_icon']['value']) && ($settings['topppa_service_styles'] == 'style_seven')): ?>
						<span class="counter-prefix-icon">
							<?php \Elementor\Icons_Manager::render_icon($settings['prefix_icon'], ['aria-hidden' => 'true']); ?>
						</span>
					<?php endif; ?>
					<?php if (isset($settings['topppa_service_styles']) && $settings['topppa_service_styles'] !== 'style_eleven'): ?>
						<?php if (!empty($settings['topppa_counter_prefix'])): ?>
							<span class="counter-prefix">
								<?php echo esc_html($settings['topppa_counter_prefix']); ?>
							</span>
						<?php endif; ?>
					<?php endif; ?>


					<?php if ($settings['topppa_service_styles'] == 'style_five'): ?>
						<div class="shape-img">
							<?php echo wp_get_attachment_image($settings['topppa_counter_shape']['id'], 'full'); ?>
						</div>
					<?php endif; ?>

					<?php if ($settings['topppa_service_styles'] == 'style_four'): ?>
						<div class="counter-line"></div>
					<?php endif; ?>
					<?php if (!empty($settings['topppa_counter_number']) && 'yes' === $settings['show_number']): ?>
						<div class="counter-number <?php echo esc_attr($imgclass); ?>" <?php if (!empty($counter_bg_style)): ?>
							style="<?php echo esc_attr($counter_bg_style); ?>" <?php endif; ?>
							data-to="<?php echo esc_attr($settings['topppa_counter_number']); ?>"
							data-speed="<?php echo esc_attr($settings['topppa_counter_speed']); ?>">
							<?php echo esc_html($settings['topppa_counter_number']); ?>
						</div>

					<?php endif; ?>

					<?php if ($settings['topppa_service_styles'] == 'style_twelve'): ?>
						<?php if (!empty($settings['topppa_counter_title'])): ?>
							<h4 class="counter-title"><?php echo esc_html($settings['topppa_counter_title']); ?></h4>
						<?php endif; ?>
					<?php endif; ?>

					<?php if (!empty($settings['topppa_counter_symble'])): ?>
						<span class="counter-symble"><?php echo esc_html($settings['topppa_counter_symble']); ?></span>
					<?php endif; ?>
				</div>
				<?php if ($settings['topppa_service_styles'] !== 'style_twelve'): ?>
					<?php if (!empty($settings['topppa_counter_title'])): ?>
						<h4 class="counter-title"><?php echo esc_html($settings['topppa_counter_title']); ?></h4>
					<?php endif; ?>
				<?php endif; ?>

				<?php if ($settings['topppa_service_styles'] == 'style_seven'): ?>
					<div class="counter-desc"><?php echo esc_html($settings['topppa_counter_desc']); ?></div>
				<?php endif; ?>
			</div>
		</div>
<?php
	}
}
