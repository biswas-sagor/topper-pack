<?php

/**
 * Elementor topppa Service Slider Widget.
 *
 * @package TopperPack
 * @since 1.0.0
 */

use TopperPack\Trait_Loader\Global_Component_Loader;
use \TopperPack\Includes\Controls\Controls_Manager as TopperPack_Controls_Manager;
use \TopperPack\Includes\Utilities;

if (! defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}

/**
 * Elementor topppa Service Slider Widget.
 *
 * @package TopperPack
 * @since 1.0.0
 */
class TOPPPA_Service_Slider_Widget extends \Elementor\Widget_Base {

	/**
	 * Global Component Loader
	 *
	 * @package TopperPack
	 */
	use Global_Component_Loader;

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
		return 'topppa_service_slider';
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
		return TOPPPA_EPWB . esc_html__('Service Slider', 'topper-pack');
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
		return 'eicon-slides';
	}

	/**
	 * Get widget categories.
	 *
	 * Retrieve the list of categories the Service Slider widget belongs to.
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
	 * Retrieve the list of keywords the Service Slider widget belongs to.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return array Widget keywords.
	 */
	public function get_keywords() {
		return ['topppa', 'widget', 'Service', 'slider', 'topperpack'];
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
		return 'https://doc.topperpack.com/docs/header-footer-widgets/social';
	}

	public function topppa_service_slider_space_between() {
		$this->add_control(
			'pro_preview',
			[
				'type' => \Elementor\Controls_Manager::RAW_HTML,
				'raw' => Utilities::upgrade_pro_image_notice('service-slider.jpg'),
			]
		);
	}

	/**
	 * Register widget controls.
	 *
	 * Add input fields to allow the user to customize the widget settings.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function register_controls() {

		// <========================> topppa Service Slider OPTIONS <========================>
		$this->start_controls_section(
			'topppa_service_slider_options',
			[
				'label' => esc_html__('topppa Service Slider', 'topper-pack'),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'select_style',
			[
				'label' => esc_html__('Select Style', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'style_one',
				'options' => [
					'style_one' => esc_html__('Style One', 'topper-pack'),
					'style_two' => esc_html__('Style Two', 'topper-pack'),
					'style_three' => esc_html__('Style Three', 'topper-pack'),
					'style_four' => esc_html__('Style Four', 'topper-pack'),
					'style_five' => esc_html__('Style five', 'topper-pack'),
				],
			]
		);
		$repeater = new \Elementor\Repeater();
		$repeater->add_control(
			'image',
			[
				'label'   => esc_html__('Image', 'topper-pack'),
				'type'    => \Elementor\Controls_Manager::MEDIA,
			]
		);
		$repeater->add_control(
			'stitle',
			[
				'label' => esc_html__('Small Title', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__('12 Listing', 'topper-pack'),
			]
		);

		$repeater->add_control(
			'title_icon',
			[
				'label'   => esc_html__('Icon', 'topper-pack'),
				'type'    => \Elementor\Controls_Manager::ICONS,
				'default' => [
					'value'   => 'fas fa-map-marker-alt',
					'library' => 'fa-solid',
				],
			]
		);
		$repeater->add_control(
			'title',
			[
				'label' => esc_html__('Title', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__('Santorini, Greece', 'topper-pack'),
				'label_block' => true,
			]
		);
		$repeater->add_control(
			'enable_title_link',
			[
				'label' => esc_html__('Enable Title Link', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Show', 'topper-pack'),
				'label_off' => esc_html__('Hide', 'topper-pack'),
				'return_value' => 'yes',
				'default' => 'no',
			]
		);
		$repeater->add_control(
			'title_link',
			[
				'label'       => esc_html__('Title URL', 'topper-pack'),
				'type'        => \Elementor\Controls_Manager::URL,
				'placeholder' => esc_html__('https://your-link.com', 'topper-pack'),
				'label_block' => true,
				'default'     => [
					'url'         => '',
					'is_external' => true,
					'nofollow'    => true,
				],
				'condition'   => ['enable_title_link' => 'yes'],
			]
		);
		$repeater->add_control(
			'enable_description',
			[
				'label' => esc_html__('Enable Description', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Show', 'topper-pack'),
				'label_off' => esc_html__('Hide', 'topper-pack'),
				'return_value' => 'yes',
				'default' => 'no',
			]
		);
		$repeater->add_control(
			'topppa_service_slider_desc',
			[
				'label' => esc_html__('Description', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::WYSIWYG,
				'default' => esc_html__('Magnis vel tortor faucibus, tempor tellus nostra sociis euismod gravida', 'topper-pack'),
				'condition' => [
					'enable_description' => 'yes'
				]
			]
		);
		$repeater->add_control(
			'enable_button',
			[
				'label' => esc_html__('Enable Button', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Show', 'topper-pack'),
				'label_off' => esc_html__('Hide', 'topper-pack'),
				'return_value' => 'yes',
				'default' => 'no',
			]
		);
		$repeater->add_control(
			'button_text',
			[
				'label'     => esc_html__('Button Text', 'topper-pack'),
				'type'      => \Elementor\Controls_Manager::TEXT,
				'default'   => esc_html__('Discover More', 'topper-pack'),
				'condition' => ['enable_button' => 'yes'],
			]
		);

		$repeater->add_control(
			'button_link',
			[
				'label'       => esc_html__('Button URL', 'topper-pack'),
				'type'        => \Elementor\Controls_Manager::URL,
				'placeholder' => esc_html__('https://your-link.com', 'topper-pack'),
				'label_block' => true,
				'default'     => [
					'url'         => '',
					'is_external' => true,
					'nofollow'    => true,
				],
				'condition'   => ['enable_button' => 'yes'],
			]
		);
		$repeater->add_control(
			'enable_icon',
			[
				'label' => esc_html__('Enable Button Icon', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Show', 'topper-pack'),
				'label_off' => esc_html__('Hide', 'topper-pack'),
				'return_value' => 'yes',
				'default' => 'no',
				'separator' => 'before',
				'condition'   => ['enable_button' => 'yes'],
			]
		);
		$repeater->add_control(
			'btn_icon',
			[
				'label'   => esc_html__('Button Icon', 'topper-pack'),
				'type'    => \Elementor\Controls_Manager::ICONS,
				'default' => [
					'value'   => 'fas fa-arrow-right',
					'library' => 'fa-solid',
				],
				'condition' => [
					'enable_button' => 'yes',
					'enable_icon' => 'yes'
				]
			]
		);
		$repeater->add_control(
			'enable_button_two',
			[
				'label' => esc_html__('Enable Button Two', 'topper-pack'),
				'description'   => esc_html__('This button will only work in style Four', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Show', 'topper-pack'),
				'label_off' => esc_html__('Hide', 'topper-pack'),
				'return_value' => 'yes',
				'default' => 'no',
				'separator' => 'before',
			]
		);
		$repeater->add_control(
			'btn_two_icon',
			[
				'label'   => esc_html__('Button Icon', 'topper-pack'),
				'type'    => \Elementor\Controls_Manager::ICONS,
				'default' => [
					'value'   => 'fas fa-arrow-right',
					'library' => 'fa-solid',
				],
				'condition' => [
					'enable_button_two' => 'yes'
				]
			]
		);
		$repeater->add_control(
			'btn_two_link',
			[
				'label'       => esc_html__('Button URL', 'topper-pack'),
				'type'        => \Elementor\Controls_Manager::URL,
				'placeholder' => esc_html__('https://your-link.com', 'topper-pack'),
				'label_block' => true,
				'default'     => [
					'url'         => '',
					'is_external' => true,
					'nofollow'    => true,
				],
				'condition' => [
					'enable_button_two' => 'yes'
				]
			]
		);
		$this->add_control(
			'topppa_slider_item',
			[
				'label'   => esc_html__('Slider Item', 'topper-pack'),
				'type'    => \Elementor\Controls_Manager::REPEATER,
				'fields'  => $repeater->get_controls(),
				'default' => [
					[
						'title' => esc_html__('Santorini, Greece', 'topper-pack'),
					],
					[
						'title' => esc_html__('Santorini, Greece', 'topper-pack'),
					],

				],
				'title_field' => '{{{ title }}}',
			]
		);
		$this->add_control(
			'title_tag',
			[
				'label' => esc_html__('HTML Tag', 'topper-pack'),
				'description' => esc_html__('Add HTML Tag For Title', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'h4',
				'options' => [
					'h1'  => esc_html__('H1', 'topper-pack'),
					'h2'  => esc_html__('H2', 'topper-pack'),
					'h3'  => esc_html__('H3', 'topper-pack'),
					'h4'  => esc_html__('H4', 'topper-pack'),
					'h5'  => esc_html__('H5', 'topper-pack'),
					'h6'  => esc_html__('H6', 'topper-pack'),
					'p'  => esc_html__('P', 'topper-pack'),
					'span'  => esc_html__('span', 'topper-pack'),
					'div'  => esc_html__('Div', 'topper-pack'),
				],
			]
		);
		$this->topppa_get_global_button_effects_controls();

		$this->add_control(
			'content_section',
			[
				'label' => __('Slider Options', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_control(
			'enable_rtl',
			[
				'label' => esc_html__('Enable RTL', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Yes', 'topper-pack'),
				'label_off' => esc_html__('No', 'topper-pack'),
				'return_value' => 'yes',
				'default' => 'no',
				'condition' => [
					'enable_slider' => 'yes',
				],
			]
		);
		$this->add_control(
			'enable_slider',
			[
				'label' => esc_html__('Enable Slider', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Yes', 'topper-pack'),
				'label_off' => esc_html__('No', 'topper-pack'),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);
		$this->add_control(
			'enable_slider_auto_loop',
			[
				'label' => esc_html__('Enable Auto Loop', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Yes', 'topper-pack'),
				'label_off' => esc_html__('No', 'topper-pack'),
				'return_value' => 'yes',
				'default' => 'yes',
				'condition' => [
					'enable_slider' => 'yes',
				],
			]
		);

		$this->add_control(
			'slide_show_lagrge_item',
			[
				'label' => esc_html__('Display on Large Devices', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'min' => 1,
				'max' => 6,
				'step' => 1,
				'default' => 3,
				'condition' => [
					'enable_slider' => 'yes',
				],
			]
		);
		$this->add_control(
			'slide_show_teblet_item',
			[
				'label' => esc_html__('Display on Teblet Devices', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'min' => 1,
				'max' => 6,
				'step' => 1,
				'default' => 3,
				'condition' => [
					'enable_slider' => 'yes',
				],
			]
		);
		$this->add_control(
			'slide_show_mobile_item',
			[
				'label' => esc_html__('Display on Mobile Devices', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'min' => 1,
				'max' => 6,
				'step' => 1,
				'default' => 2,
				'condition' => [
					'enable_slider' => 'yes',
				],
			]
		);
		$this->add_control(
			'slide_show_extra_mobile_item',
			[
				'label' => esc_html__('Display on Small Devices', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'min' => 1,
				'max' => 6,
				'step' => 1,
				'default' => 1,
				'condition' => [
					'enable_slider' => 'yes',
				],
			]
		);
		$this->add_control(
			'slider_space_between',
			[
				'label'   => __('Space Between Slides (px)', 'topper-pack'),
				'type'    => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
						'step' => 1,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 24,
				],
				'condition' => [
					'enable_slider' => 'yes',
				],
			]
		);

		$this->topppa_service_slider_space_between();

		$this->add_control(
			'xl_col',
			[
				'label' => esc_html__('Extra Large Devices', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => [
					'col-xl-2' => esc_html__('6 Columns', 'topper-pack'),
					'col-xl-3' => esc_html__('4 Columns', 'topper-pack'),
					'col-xl-4' => esc_html__('3 Columns', 'topper-pack'),
					'col-xl-6' => esc_html__('2 Columns', 'topper-pack'),
					'col-xl-12' => esc_html__('1 Columns', 'topper-pack'),
				],
				'default' => 'col-xl-4',
				'condition' => [
					'enable_slider!' => 'yes',
				],
			]
		);

		$this->add_control(
			'lg_col',
			[
				'label' => esc_html__('Teblet Devices', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => [
					'col-lg-2' => esc_html__('6 Columns', 'topper-pack'),
					'col-lg-3' => esc_html__('4 Columns', 'topper-pack'),
					'col-lg-4' => esc_html__('3 Columns', 'topper-pack'),
					'col-lg-6' => esc_html__('2 Columns', 'topper-pack'),
					'col-lg-12' => esc_html__('1 Columns', 'topper-pack'),
				],
				'default' => 'col-lg-4',
				'condition' => [
					'enable_slider!' => 'yes',
				],
			]
		);

		$this->add_control(
			'md-col',
			[
				'label' => esc_html__('Mobile Devices', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => [
					'col-md-2' => esc_html__('6 Columns', 'topper-pack'),
					'col-md-3' => esc_html__('4 Columns', 'topper-pack'),
					'col-md-4' => esc_html__('3 Columns', 'topper-pack'),
					'col-md-6' => esc_html__('2 Columns', 'topper-pack'),
					'col-md-12' => esc_html__('1 Columns', 'topper-pack'),
				],
				'default' => 'col-md-6',
				'condition' => [
					'enable_slider!' => 'yes',
				],
			]
		);
		$this->end_controls_section();
		// <==========>
		// <==========> BOX STYLES <==========>

		$this->start_controls_section(
			'box_styles',
			[
				'label' => esc_html__('Box Style', 'topper-pack'),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_responsive_control(
			'box_height',
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
				'default' => [
					'unit' => 'px',
				],
				'selectors' => [
					'{{WRAPPER}} .topppa-service-slider-item ' => 'height: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'select_style' => ['style_one', 'style_two', 'style_three'],
				],
			]
		);
		$this->add_responsive_control(
			'service_slider_box_border_color',
			[
				'label' => esc_html__('After Border Color', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .style-four .swiper-slide.swiper-slide-next::before' => 'background-color: {{VALUE}}',
					'{{WRAPPER}} .style-four .swiper-slide.swiper-slide-next::after' => 'background-color: {{VALUE}}',
				],
				'condition' => [
					'select_style' => 'style_four',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'box_background',
				'types' => ['classic', 'gradient', 'video'],
				'selector' => '{{WRAPPER}} .topppa-service-slider-item',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'box_border',
				'label' => esc_html__('Border', 'topper-pack'),
				'selector' => '{{WRAPPER}} .topppa-service-slider-item',
			]
		);
		$this->add_responsive_control(
			'box_radius',
			[
				'label' => esc_html__('Border Radius', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .topppa-service-slider-item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'box_shadow',
				'label' => esc_html__('Box Shadow', 'topper-pack'),
				'selector' => '{{WRAPPER}} .topppa-service-slider-item',
			]
		);
		$this->add_control(
			'box_hover_style',
			[
				'label' => esc_html__('Box Hover Style', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => [
					'select_style' => 'style_five',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'box_hover_background',
				'label' => esc_html__('Hover Background', 'topper-pack'),
				'types' => ['classic', 'gradient', 'video'],
				'selector' => '{{WRAPPER}} .topppa-service-slider-item:hover',
				'condition' => [
					'select_style' => 'style_five',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'box_hover_border',
				'label' => esc_html__('Hover Border', 'topper-pack'),
				'selector' => '{{WRAPPER}} .topppa-service-slider-item:hover',
				'condition' => [
					'select_style' => 'style_five',
				],
			]
		);
		$this->add_responsive_control(
			'box_hover_radius',
			[
				'label' => esc_html__('Hover Border Radius', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .topppa-service-slider-item:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'select_style' => 'style_five',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'box_hover_shadow',
				'label' => esc_html__('Hover Box Shadow', 'topper-pack'),
				'selector' => '{{WRAPPER}} .topppa-service-slider-item:hover',
				'condition' => [
					'select_style' => 'style_five',
				],
			]
		);
		$this->add_responsive_control(
			'box_margin',
			[
				'label' => esc_html__('Margin', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .topppa-service-slider-item' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'before',
			]
		);
		$this->add_responsive_control(
			'box_padding',
			[
				'label' => esc_html__('Padding', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .topppa-service-slider-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();
		// <==========>
		// <==========> BOX STYLES <==========>

		$this->start_controls_section(
			'inner_box_styles',
			[
				'label' => esc_html__('Innre Box Style', 'topper-pack'),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
				'condition' => [
					'select_style' => ['style_one', 'style_two'],
				],
			]
		);
		$this->add_responsive_control(
			'content_ text_align',
			[
				'label' => esc_html__('Alignment', 'topper-pack'),
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
				'toggle' => true,
				'selectors' => [
					'{{WRAPPER}} .topppa-service-slider-content-area' => 'text-align: {{VALUE}};',
				],
			]
		);
		$this->add_responsive_control(
			'content_bottom',
			[
				'label' => esc_html__('Content Bottom', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px', '%', 'em', 'rem', 'custom'],
				'range' => [
					'px' => [
						'min' => -500,
						'max' => 500,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default' => [
					'unit' => 'px',
				],
				'selectors' => [
					'{{WRAPPER}} .topppa-service-slider-content-area' => 'bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->start_controls_tabs(
			'style_tabs'
		);

		$this->start_controls_tab(
			'style_normal_tab',
			[
				'label' => esc_html__('Normal', 'topper-pack'),
			]
		);
		$this->add_responsive_control(
			'background_css_blur',
			[
				'label'      => esc_html__('Background Blur', 'topper-pack'),
				'type'       => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px', '%'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .topppa-service-slider-content' => 'backdrop-filter: blur({{SIZE}}{{UNIT}});',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'inner_box_bg',
				'label' => esc_html__('Background', 'topper-pack'),
				'types' => ['classic', 'gradient', 'video'],
				'selector' => '{{WRAPPER}} .topppa-service-slider-content',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'inner_box_border',
				'label' => esc_html__('Border', 'topper-pack'),
				'selector' => '{{WRAPPER}} .topppa-service-slider-content',
			]
		);
		$this->add_responsive_control(
			'inner_box_radius',
			[
				'label' => esc_html__('Border Radius', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .topppa-service-slider-content' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'inner_box_shadow',
				'label' => esc_html__('Box Shadow', 'topper-pack'),
				'selector' => '{{WRAPPER}} .topppa-service-slider-content',
			]
		);
		$this->add_responsive_control(
			'inner_box_padding',
			[
				'label' => esc_html__('Padding', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .topppa-service-slider-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_tab();

		$this->start_controls_tab(
			'style_hover_tab',
			[
				'label' => esc_html__('Hover', 'topper-pack'),
			]
		);
		$this->add_responsive_control(
			'background_css_blur_hover',
			[
				'label'      => esc_html__('Background Blur', 'topper-pack'),
				'type'       => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px', '%'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .topppa-service-slider-item:hover .topppa-service-slider-content' => 'backdrop-filter: blur({{SIZE}}{{UNIT}});',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'inner_box_bg_hover',
				'label' => esc_html__('Background', 'topper-pack'),
				'types' => ['classic', 'gradient', 'video'],
				'selector' => '{{WRAPPER}} .topppa-service-slider-item:hover .topppa-service-slider-content',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'inner_box_border_hover',
				'label' => esc_html__('Border', 'topper-pack'),
				'selector' => '{{WRAPPER}} .topppa-service-slider-item:hover .topppa-service-slider-content',
			]
		);
		$this->add_responsive_control(
			'inner_box_radius_hover',
			[
				'label' => esc_html__('Border Radius', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .topppa-service-slider-item:hover .topppa-service-slider-content' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'inner_box_shadow_hover',
				'label' => esc_html__('Box Shadow', 'topper-pack'),
				'selector' => '{{WRAPPER}} .topppa-service-slider-item:hover .topppa-service-slider-content',
			]
		);
		$this->add_responsive_control(
			'inner_box_padding_hover',
			[
				'label' => esc_html__('Padding', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .topppa-service-slider-item:hover .topppa-service-slider-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_responsive_control(
			'inner_box_margin',
			[
				'label' => esc_html__('Margin', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .topppa-service-slider-content' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);


		$this->end_controls_section();
		$this->start_controls_section(
			'content_styles_option',
			[
				'label' => esc_html__('Content Style', 'topper-pack'),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'content_box_align',
			[
				'label' => esc_html__('Alignment', 'topper-pack'),
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
				'toggle' => true,
				'selectors' => [
					'{{WRAPPER}} .topppa-service-slider .topppa-service-slider-content' => 'text-align: {{VALUE}};',
				],
				'condition' => [
					'select_style' => ['style_three', 'style_four'],

				],
			]
		);
		$this->add_responsive_control(
			'content_background_css_blur',
			[
				'label'      => esc_html__('Background Blur', 'topper-pack'),
				'type'       => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px', '%'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .topppa-service-slider .topppa-service-slider-content-area' => 'backdrop-filter: blur({{SIZE}}{{UNIT}});',
				],
				'condition' => [
					'select_style' => 'style_three',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'content_box_bg',
				'label' => esc_html__('Background', 'topper-pack'),
				'types' => ['classic', 'gradient', 'video'],
				'selector' => '{{WRAPPER}} .topppa-service-slider .topppa-service-slider-content-area',
				'condition' => [
					'select_style' => 'style_three',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'content_box_border',
				'label' => esc_html__('Border', 'topper-pack'),
				'selector' => '{{WRAPPER}} .topppa-service-slider .topppa-service-slider-content-area',
				'condition' => [
					'select_style' => 'style_three',
				],
			]
		);
		$this->add_responsive_control(
			'content_box_radius',
			[
				'label' => esc_html__('Border Radius', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .topppa-service-slider .topppa-service-slider-content-area' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'select_style' => 'style_three',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'content_box_shadow',
				'label' => esc_html__('Box Shadow', 'topper-pack'),
				'selector' => '{{WRAPPER}} .topppa-service-slider .topppa-service-slider-content-area',
				'condition' => [
					'select_style' => 'style_three',
				],
			]
		);
		$this->add_responsive_control(
			'content_box_margin',
			[
				'label' => esc_html__('Margin', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .topppa-service-slider .topppa-service-slider-content' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'select_style' => 'style_three',
				],
			]
		);
		$this->add_responsive_control(
			'content_box_padding',
			[
				'label' => esc_html__('Padding', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .topppa-service-slider .topppa-service-slider-content-area' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'select_style' => ['style_three', 'style_five'],
				],
			]
		);

		$this->start_controls_tabs(
			'content_style_tabs'
		);
		$this->start_controls_tab(
			'style_title_tab',
			[
				'label' => esc_html__('Title', 'topper-pack'),
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'title_typo',
				'selector' => '{{WRAPPER}} .topppa-service-slider-title',
			]
		);
		$this->add_responsive_control(
			'title_color',
			[
				'label'     => esc_html__('Color', 'topper-pack'),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .topppa-service-slider-title' => 'color: {{VALUE}}',
					'{{WRAPPER}} .topppa-service-slider-title a' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_responsive_control(
			'title_hcolor',
			[
				'label'     => esc_html__('Hover Color', 'topper-pack'),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .topppa-service-slider-title a:hover' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_responsive_control(
			'title_margin',
			[
				'label'      => esc_html__('Margin', 'topper-pack'),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors'  => [
					'{{WRAPPER}} .topppa-service-slider-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'title_padding',
			[
				'label'      => esc_html__('Padding', 'topper-pack'),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors'  => [
					'{{WRAPPER}} .topppa-service-slider-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'style_stitle_tab',
			[
				'label' => esc_html__('Stitle', 'topper-pack'),
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'stitle_typo',
				'selector' => '{{WRAPPER}} .topppa-service-slider-stitle',
			]
		);
		$this->add_responsive_control(
			'stitle_color',
			[
				'label'     => esc_html__('Color', 'topper-pack'),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .topppa-service-slider-stitle' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_responsive_control(
			'stitle_margin',
			[
				'label'      => esc_html__('Margin', 'topper-pack'),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors'  => [
					'{{WRAPPER}} .topppa-service-slider-stitle' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'stitle_padding',
			[
				'label'      => esc_html__('Padding', 'topper-pack'),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors'  => [
					'{{WRAPPER}} .topppa-service-slider-stitle' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_tab();
		$this->start_controls_tab(
			'style_title_icon_tab',
			[
				'label' => esc_html__('Icon', 'topper-pack'),
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'title_icon_typo',
				'selector' => '{{WRAPPER}} .topppa-service-slider-title span',
			]
		);
		$this->add_responsive_control(
			'title_icon_color',
			[
				'label'     => esc_html__('Color', 'topper-pack'),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .topppa-service-slider-title span' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_responsive_control(
			'title_icon_padding',
			[
				'label'      => esc_html__('Padding', 'topper-pack'),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors'  => [
					'{{WRAPPER}} .topppa-service-slider-title span' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'style_description_tab',
			[
				'label' => esc_html__('Description', 'topper-pack'),

			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'desc_typo',
				'selector' => '{{WRAPPER}} .topppa-service-slider-content-area .topppa-service-slider-des',
			]
		);
		$this->add_responsive_control(
			'desc_color',
			[
				'label'     => esc_html__('Color', 'topper-pack'),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .topppa-service-slider-content-area .topppa-service-slider-des' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_responsive_control(
			'desc_padding',
			[
				'label'      => esc_html__('Padding', 'topper-pack'),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors'  => [
					'{{WRAPPER}} .topppa-service-slider-content-area .topppa-service-slider-des' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'desc_margin',
			[
				'label'      => esc_html__('Margin', 'topper-pack'),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors'  => [
					'{{WRAPPER}} .topppa-service-slider-content-area .topppa-service-slider-des' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();
		// <==========>
		// <==========> IMAGE STYLES <==========>

		$this->start_controls_section(
			'service_slider_img_style',
			[
				'label' => esc_html__('Image Style', 'topper-pack'),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
				'condition' => [
					'select_style' => ['style_four', 'style_five']
				],
			]
		);
		$this->add_responsive_control(
			'service_slider_img_height',
			[
				'label'      => esc_html__('Height', 'topper-pack'),
				'type'       => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px', '%', 'custom'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 800,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default' => [
					'unit' => 'px',
				],
				'selectors'  => [
					'{{WRAPPER}} .topppa-service-slider-item .topppa-service-slider-img' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'service_slider_img_width',
			[
				'label'      => esc_html__('Width', 'topper-pack'),
				'type'       => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px', '%', 'custom'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 800,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default' => [
					'unit' => '%',
				],
				'selectors'  => [
					'{{WRAPPER}} .topppa-service-slider-item .topppa-service-slider-img' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'service_slider_img_object',
			[
				'label' => esc_html__('Object Fit', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'cover',
				'options' => [
					'fill'  => esc_html__('Fill', 'topper-pack'),
					'contain' => esc_html__('Contain', 'topper-pack'),
					'cover' => esc_html__('Cover', 'topper-pack'),
					'none' => esc_html__('None', 'topper-pack'),
				],
				'selectors' => [
					'{{WRAPPER}} .topppa-service-slider-item .topppa-service-slider-img' => 'object-fit: {{VALUE}}',
				],
			]
		);
		$this->add_responsive_control(
			'service_slider_img_after_color',
			[
				'label' => esc_html__('After Bg Color', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .topppa-service-slider-item .topppa-service-slider-img:after' => 'background-color: {{VALUE}}',
				],
				'condition' => [
					'select_style' => ['style_four',]
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name'     => 'service_slider_img_border',
				'label'    => esc_html__('Border', 'topper-pack'),
				'selector' => '{{WRAPPER}} .topppa-service-slider-item .topppa-service-slider-img',
			]
		);
		$this->add_responsive_control(
			'service_slider_img_border_radius',
			[
				'label'      => esc_html__('Border Radius', 'topper-pack'),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors'  => [
					'{{WRAPPER}} .topppa-service-slider-item .topppa-service-slider-img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'service_slider_img_shadow',
				'selector' => '{{WRAPPER}} .topppa-service-slider-item .topppa-service-slider-img',
			]
		);
		$this->add_responsive_control(
			'service_slider_img_margin',
			[
				'label'      => esc_html__('Margin', 'topper-pack'),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors'  => [
					'{{WRAPPER}} .topppa-service-slider-item .topppa-service-slider-img' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'service_slider_img_padding',
			[
				'label'      => esc_html__('Padding', 'topper-pack'),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors'  => [
					'{{WRAPPER}} .topppa-service-slider-item .topppa-service-slider-img' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();
		$this->start_controls_section(
			'icon_styles',
			[
				'label' => esc_html__('Icon Style', 'topper-pack'),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
				'condition' => [
					'select_style' => ['style_three', 'style_four'],
				]
			]
		);

		$this->add_responsive_control(
			'icon_height',
			[
				'label' => esc_html__('Height', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px', '%', 'em', 'rem', 'custom'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 300,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .topppa-service-slider .topppa-service-slider-icon' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'icon_width',
			[
				'label' => esc_html__('Width', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px', '%', 'em', 'rem', 'custom'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 300,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .topppa-service-slider .topppa-service-slider-icon' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'icon_background_css_blur',
			[
				'label'      => esc_html__('Background Blur', 'topper-pack'),
				'type'       => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px', '%'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .topppa-service-slider .topppa-service-slider-icon' => 'backdrop-filter: blur({{SIZE}}{{UNIT}});',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'icon_typo',
				'selector' => '{{WRAPPER}} .topppa-service-slider .topppa-service-slider-icon',
			]
		);

		$this->start_controls_tabs(
			'icon_style_tabs'
		);
		$this->start_controls_tab(
			'icon_style_normal_tab',
			[
				'label' => esc_html__('Normal', 'topper-pack'),
			]
		);

		$this->add_responsive_control(
			'icon_color',
			[
				'label'     => esc_html__('Color', 'topper-pack'),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .topppa-service-slider .topppa-service-slider-icon' => 'color: {{VALUE}}',
					'{{WRAPPER}} .topppa-service-slider .topppa-service-slider-icon svg path' => 'fill: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'icon_bg_color',
				'types' => ['classic', 'gradient', 'video'],
				'selector' => '{{WRAPPER}} .topppa-service-slider .topppa-service-slider-icon',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'icon_border',
				'selector' => '{{WRAPPER}} .topppa-service-slider .topppa-service-slider-icon',
			]
		);
		$this->add_responsive_control(
			'icon_border_radius',
			[
				'label' => esc_html__('Border Radius', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .topppa-service-slider .topppa-service-slider-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'icon_box_shadow',
				'selector' => '{{WRAPPER}} .topppa-service-slider .topppa-service-slider-icon',
			]
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'icon_style_hover_tab',
			[
				'label' => esc_html__('Hover', 'topper-pack'),
			]
		);
		$this->add_responsive_control(
			'icon_hcolor',
			[
				'label'     => esc_html__('Hover Color', 'topper-pack'),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .icon-box-item:hover .box-icon-wrapper .box-icon' => 'color: {{VALUE}}',
					'{{WRAPPER}} .icon-box-item:hover .box-icon-wrapper .box-icon svg path' => 'fill: {{VALUE}}',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'icon_bg_color_hover',
				'types' => ['classic', 'gradient', 'video'],
				'selector' => '{{WRAPPER}} .icon-box-item:hover .box-icon-wrapper .box-icon',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'icon_border_hover',
				'selector' => '{{WRAPPER}} .icon-box-item:hover .box-icon-wrapper .box-icon',
			]
		);
		$this->add_responsive_control(
			'icon_border_radius2',
			[
				'label' => esc_html__('Border Radius', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .icon-box-item:hover .box-icon-wrapper .box-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'icon_box_shadow_hover',
				'selector' => '{{WRAPPER}} .icon-box-item:hover .box-icon-wrapper .box-icon',
			]
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'icon_text_style_tab',
			[
				'label' => esc_html__('Text', 'topper-pack'),
				'condition' => [
					'select_style' => ['style_three', 'style_four'],
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'icon_typo2',
				'label'      => esc_html__('Text Typography', 'topper-pack'),
				'selector' => '{{WRAPPER}} .topppa-service-slider .topppa-service-slider-icon span',
			]
		);
		$this->add_responsive_control(
			'icon_text_color',
			[
				'label' => esc_html__('Text Color', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .topppa-service-slider .topppa-service-slider-icon span' => 'color: {{VALUE}}',
				],
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->add_responsive_control(
			'icon_margin',
			[
				'label'      => esc_html__('Margin', 'topper-pack'),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors'  => [
					'{{WRAPPER}} .topppa-service-slider .topppa-service-slider-icon' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'icon_padding',
			[
				'label'      => esc_html__('Padding', 'topper-pack'),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors'  => [
					'{{WRAPPER}} .topppa-service-slider .topppa-service-slider-icon' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();
		// <========================> BUTTON STYLES <========================>
		$this->start_controls_section(
			'topppa_btn_style',
			[
				'label' => esc_html__('Button Style', 'topper-pack'),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'topppa_btn_icon_gap',
			[
				'label'      => esc_html__('Icon Gap', 'topper-pack'),
				'type'       => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px', '%'],
				'range'      => [
					'px' => [
						'min'  => 0,
						'max'  => 100,
						'step' => 1,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .slider-btn-wrapper .topppa-btn' => 'gap: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'topppa_show_icon' => 'yes'
				]
			]
		);

		$this->start_controls_tabs(
			'topppa_btn_content_tabs'
		);

		$this->start_controls_tab(
			'topppa_btn_normal',
			[
				'label' => __('Normal', 'topper-pack'),
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'topppa_btn_typo',
				'selector' => '{{WRAPPER}} .slider-btn-wrapper .topppa-btn',
			]
		);

		$this->add_responsive_control(
			'topppa_btn_color',
			[
				'label'     => esc_html__('Color', 'topper-pack'),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .slider-btn-wrapper .topppa-btn' => 'color: {{VALUE}}',
					'{{WRAPPER}} .slider-btn-wrapper .topppa-btn span' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'topppa_btn_background',
				'types' => ['classic', 'gradient', 'video'],
				'selector' => '{{WRAPPER}} .slider-btn-wrapper .topppa-btn',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name'     => 'topppa_btn_border',
				'label'    => esc_html__('Border', 'topper-pack'),
				'selector' => '{{WRAPPER}} .slider-btn-wrapper .topppa-btn',
			]
		);

		$this->add_responsive_control(
			'topppa_btn_border_radius',
			[
				'label'      => esc_html__('Border Radius', 'topper-pack'),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors'  => [
					'{{WRAPPER}} .slider-btn-wrapper .topppa-btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'topppa_btn_box_shadow',
				'label'    => esc_html__('Shadow', 'topper-pack'),
				'selector' => '{{WRAPPER}} .slider-btn-wrapper .topppa-btn',
			]
		);

		$this->add_control(
			'topppa_btn_icon_styles',
			[
				'label' => esc_html__('Icon Styles', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'topppa_btn_icon_width',
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
					'{{WRAPPER}} .slider-btn-wrapper .topppa-btn .btn-icon' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'topppa_btn_icon_height',
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
					'{{WRAPPER}} .slider-btn-wrapper .topppa-btn .btn-icon' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'topppa_btn_icon_content_typography',
				'selector' => '{{WRAPPER}} .slider-btn-wrapper .topppa-btn .btn-icon',
			]
		);
		$this->add_responsive_control(
			'topppa_btn_icon_color',
			[
				'label' => esc_html__('Color', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .slider-btn-wrapper .topppa-btn .btn-icon' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'topppa_btn_icon_bg',
				'types' => ['classic', 'gradient', 'video'],
				'selector' => '{{WRAPPER}} .slider-btn-wrapper .topppa-btn .btn-icon',
			]
		);
		$this->add_responsive_control(
			'topppa_btn_icon_border_radius',
			[
				'label' => esc_html__('Border Radius', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .slider-btn-wrapper .topppa-btn .btn-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'topppa_btn_hover',
			[
				'label' => __('Hover', 'topper-pack'),
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'topppa_btn_typography_hover',
				'selector' => '{{WRAPPER}} .slider-btn-wrapper .topppa-btn:hover',
			]
		);

		$this->add_responsive_control(
			'topppa_btn_color_hover',
			[
				'label'     => esc_html__('Color', 'topper-pack'),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .slider-btn-wrapper .topppa-btn:hover' => 'color: {{VALUE}}',
					'{{WRAPPER}} .slider-btn-wrapper .topppa-btn:hover span' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'topppa_btn_background_hover',
				'types' => ['classic', 'gradient', 'video'],
				'selector' => '{{WRAPPER}} .slider-btn-wrapper .topppa-btn:hover',
				'condition' => [
					'topppa_btn_styles' => ['style_three', 'style_six', 'style_seven']
				]
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'topppa_btn_background_hover2',
				'types' => ['classic', 'gradient', 'video'],
				'selector' => '{{WRAPPER}} .slider-btn-wrapper .topppa-btn::before, {{WRAPPER}} .slider-btn-wrapper .topppa-btn::after',
				'condition' => [
					'topppa_btn_styles!' => ['style_three', 'style_six', 'style_seven', 'style_twelve'],
				]
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name'     => 'topppa_btn_border_hover',
				'label'    => esc_html__('Border', 'topper-pack'),
				'selector' => '{{WRAPPER}} .slider-btn-wrapper .topppa-btn:hover',
			]
		);

		$this->add_responsive_control(
			'topppa_btn_border_radius_hover',
			[
				'label'      => esc_html__('Border Radius', 'topper-pack'),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors'  => [
					'{{WRAPPER}} .slider-btn-wrapper .topppa-btn:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'topppa_btn_box_shadow_hover',
				'label'    => esc_html__('Shadow', 'topper-pack'),
				'selector' => '{{WRAPPER}} .slider-btn-wrapper .topppa-btn:hover',
			]
		);

		$this->add_control(
			'topppa_btn_icon_hstyles',
			[
				'label' => esc_html__('Icon Styles', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_responsive_control(
			'topppa_btn_icon_hover_color',
			[
				'label' => esc_html__('Hover Color', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .slider-btn-wrapper .topppa-btn:hover .btn-icon' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'topppa_btn_icon_hbgcolor',
				'types' => ['classic', 'gradient', 'video'],
				'selector' => '{{WRAPPER}} .slider-btn-wrapper .topppa-btn:hover .btn-icon',
				'condition' => [
					'topppa_btn_styles!' => 'style_eight'
				]
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'topppa_btn_icon_hbgcolor2',
				'types' => ['classic', 'gradient', 'video'],
				'selector' => '{{WRAPPER}} .slider-btn-wrapper .topppa-btn .btn-icon::before',
				'condition' => [
					'topppa_btn_styles' => 'style_eight'
				]
			]
		);
		$this->add_responsive_control(
			'topppa_btn_icon_hborder_radius',
			[
				'label' => esc_html__('Border Radius', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .slider-btn-wrapper .topppa-btn:hover .btn-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->add_responsive_control(
			'topppa_btn_margin',
			[
				'label'      => esc_html__('Margin', 'topper-pack'),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors'  => [
					'{{WRAPPER}} .slider-btn-wrapper .topppa-btn' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'topppa_btn_padding',
			[
				'label'      => esc_html__('Padding', 'topper-pack'),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors'  => [
					'{{WRAPPER}} .slider-btn-wrapper .topppa-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();
		// <==========>
		// <=================> ICON STYLES <=================>
		$this->start_controls_section(
			'service_icon_btn_style',
			[
				'label' => esc_html__('Icon Button Style', 'topper-pack'),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
				'condition' => [
					'select_style' => 'style_four'
				]
			],
		);
		$this->add_responsive_control(
			'service_icon_btn_height',
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
					'{{WRAPPER}} .topppa-service-slider-img .topppa-service-slider-button-two' => 'height: {{SIZE}}{{UNIT}};',
				],
			],
		);
		$this->add_responsive_control(
			'service_icon_btn_width',
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
					'{{WRAPPER}} .topppa-service-slider-img .topppa-service-slider-button-two' => 'width: {{SIZE}}{{UNIT}};',
				],
			],
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'service_icon_btn_typo',
				'selector' => '{{WRAPPER}} .topppa-service-slider-img .topppa-service-slider-button-two',
			],
		);
		$this->start_controls_tabs(
			'service_icon_btn_tabs',
		);
		$this->start_controls_tab(
			'service_icon_btn_tab',
			[
				'label' => esc_html__('Normal', 'topper-pack'),
			],
		);
		$this->add_responsive_control(
			'service_icon_btn_color',
			[
				'label'     => esc_html__('Icon Color', 'topper-pack'),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .topppa-service-slider-img .topppa-service-slider-button-two' => 'color: {{VALUE}}',
					'{{WRAPPER}} .topppa-service-slider-img .topppa-service-slider-button-two svg path' => 'fill: {{VALUE}}',
				],
			],
		);
		$this->add_responsive_control(
			'service_icon_btn_bg',
			[
				'label' => esc_html__('BG Color', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .topppa-service-slider-img .topppa-service-slider-button-two' => 'background-color: {{VALUE}}',
				],
			],
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name'     => 'service_icon_btn_border',
				'label'    => esc_html__('Border', 'topper-pack'),
				'selector' => '{{WRAPPER}} .topppa-service-slider-img .topppa-service-slider-button-two',
			],
		);
		$this->add_responsive_control(
			'service_icon_btn_border_radius',
			[
				'label'      => esc_html__('Border Radius', 'topper-pack'),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors'  => [
					'{{WRAPPER}} .topppa-service-slider-img .topppa-service-slider-button-two' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			],
		);
		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'service_icon_btn_shadow',
				'selector' => '{{WRAPPER}} .topppa-service-slider-img .topppa-service-slider-button-two',
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
			'service_svg_height',
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
					'{{WRAPPER}} .topppa-service-slider-img .topppa-service-slider-button-two svg' => 'height: {{SIZE}}{{UNIT}};',
				],
			],
		);
		$this->add_responsive_control(
			'service_svg_width',
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
					'{{WRAPPER}} .topppa-service-slider-img .topppa-service-slider-button-two svg' => 'width: {{SIZE}}{{UNIT}};',
				],
			],
		);
		$this->end_controls_tab();
		// <==========> ICON HOVER STYLES <==========>

		$this->start_controls_tab(
			'service_icon_btn_hover_tab',
			[
				'label' => esc_html__('Hover', 'topper-pack'),
			]
		);
		$this->add_responsive_control(
			'service_icon_btn_color_hover',
			[
				'label'     => esc_html__('Color', 'topper-pack'),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .topppa-service-slider-img .topppa-service-slider-button-two:hover' => 'color: {{VALUE}}',
					'{{WRAPPER}} .topppa-service-slider-img .topppa-service-slider-button-two:hover svg path' => 'fill: {{VALUE}}',
				],
			]
		);
		$this->add_responsive_control(
			'service_icon_btn_hover_bg',
			[
				'label' => esc_html__('BG Color', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .topppa-service-slider-img .topppa-service-slider-button-two:hover' => 'background-color: {{VALUE}}',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name'     => 'service_icon_btn_hover_border',
				'label'    => esc_html__('Border', 'topper-pack'),
				'selector' => '{{WRAPPER}} .topppa-service-slider-img .topppa-service-slider-button-two:hover',
			]
		);
		$this->add_responsive_control(
			'service_icon_btn_border_hover_radius',
			[
				'label'      => esc_html__('Border Radius', 'topper-pack'),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors'  => [
					'{{WRAPPER}} .topppa-service-slider-img .topppa-service-slider-button-two:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'service_icon_btn_shadow_hover',
				'selector' => '{{WRAPPER}} .topppa-service-slider-img .topppa-service-slider-button-two:hover',
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->add_responsive_control(
			'service_icon_btn_margin',
			[
				'label' => esc_html__('Margin', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em', 'rem', 'custom'],
				'selectors' => [
					'{{WRAPPER}} .topppa-service-slider-img .topppa-service-slider-button-two' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'service_icon_btn_padding',
			[
				'label' => esc_html__('Padding', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em', 'rem', 'custom'],
				'selectors' => [
					'{{WRAPPER}} .topppa-service-slider-img .topppa-service-slider-button-two' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'dote_content_option',
			[
				'label' => esc_html__('Dots Style', 'topper-pack'),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
				'condition' => [
					'enable_dote' => 'yes',
					'enable_slider' => 'yes',
				],
			]
		);
		$this->add_responsive_control(
			'dote_gap',
			[
				'label'      => esc_html__('Gap', 'topper-pack'),
				'type'       => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px', '%', 'custom'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 300,
						'step' => 1,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .topppa-dote-pagination' => 'gap: {{SIZE}}{{UNIT}};',
				],
				'default' => [
					'unit' => 'px',
					'size' => 24,
				],
			]
		);
		$this->add_responsive_control(
			'dote_align',
			[
				'label' => esc_html__('Alignment', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'options' => [
					'flex-start' => [
						'title' => esc_html__('Left', 'topper-pack'),
						'icon' => 'eicon-justify-start-h',
					],
					'center' => [
						'title' => esc_html__('Center', 'topper-pack'),
						'icon' => 'eicon-justify-center-h',
					],
					'flex-end' => [
						'title' => esc_html__('Right', 'topper-pack'),
						'icon' => 'eicon-justify-end-h',
					],
				],
				'toggle' => true,
				'selectors' => [
					'{{WRAPPER}} .topppa-dote-pagination' => 'justify-content: {{VALUE}};',
				],
			]
		);
		$this->add_responsive_control(
			'dote_height',
			[
				'label'      => esc_html__('Height', 'topper-pack'),
				'type'       => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px', '%', 'custom'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default' => [
					'unit' => 'px',
				],
				'selectors'  => [
					'{{WRAPPER}} .swiper-pagination-bullets span.swiper-pagination-bullet' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'dote_width',
			[
				'label'      => esc_html__('Width', 'topper-pack'),
				'type'       => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px', '%', 'custom'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default' => [
					'unit' => 'px',
				],
				'selectors'  => [
					'{{WRAPPER}} .swiper-pagination-bullets span.swiper-pagination-bullet' => 'Width: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'dote_background',
				'label' => esc_html__('Background', 'topper-pack'),
				'types' => ['classic', 'gradient', 'video'],
				'selector' => '{{WRAPPER}} .topppa-dote-pagination span',
				'fields_options' => [
					'background' => [
						'label' => esc_html__('Background', 'topper-pack'),
						'default' => 'classic',
					],
				],
			]
		);
		$this->add_responsive_control(
			'dote_opacity',
			[
				'label' => esc_html__('Opacity', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1,
						'step' => .1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .topppa-dote-pagination span' => 'opacity: {{SIZE}};',
				],
			]
		);
		$this->add_responsive_control(
			'dote_scale',
			[
				'label' => esc_html__('Border Scale', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default' => [
					'size' => 1,
				],
				'selectors' => [
					'{{WRAPPER}} .topppa-dote-pagination .swiper-pagination-bullet:after' => 'transform: translate(-50%, -50%) scale({{SIZE}});',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name'     => 'dote_border',
				'label'    => esc_html__('Border', 'topper-pack'),
				'selector' => '{{WRAPPER}} .topppa-dote-pagination .swiper-pagination-bullet:after',
			]
		);
		$this->add_responsive_control(
			'dote_border_radius',
			[
				'label'      => esc_html__('Border Radius', 'topper-pack'),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors'  => [
					'{{WRAPPER}} .topppa-dote-pagination .swiper-pagination-bullet:after' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'active_styles',
			[
				'label' => esc_html__('Active Styles', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_responsive_control(
			'position_x',
			[
				'label' => esc_html__('Postition X', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px', '%', 'em', 'rem', 'custom'],
				'range' => [
					'px' => [
						'min' => -200,
						'max' => 500,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .topppa-dote-pagination .swiper-pagination-bullet:after' => 'left: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'position_y',
			[
				'label' => esc_html__('Postition Y', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px', '%', 'em', 'rem', 'custom'],
				'range' => [
					'px' => [
						'min' => -200,
						'max' => 500,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .topppa-dote-pagination .swiper-pagination-bullet:after' => 'top: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'active_dote_height',
			[
				'label'      => esc_html__('Height', 'topper-pack'),
				'type'       => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px', '%', 'custom'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default' => [
					'unit' => 'px',
				],
				'selectors'  => [
					'{{WRAPPER}} .swiper-pagination-bullets span.swiper-pagination-bullet-active' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'active_dote_width',
			[
				'label'      => esc_html__('Width', 'topper-pack'),
				'type'       => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px', '%', 'custom'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default' => [
					'unit' => 'px',
				],
				'selectors'  => [
					'{{WRAPPER}} .swiper-pagination-bullets span.swiper-pagination-bullet-active' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'active_dote_background',
				'label' => esc_html__('Background', 'topper-pack'),
				'types' => ['classic', 'gradient', 'video'],
				'selector' => '{{WRAPPER}} .topppa-dote-pagination .swiper-pagination-bullet-active',
				'fields_options' => [
					'background' => [
						'label' => esc_html__('Background', 'topper-pack'),
						'default' => 'classic',
					],
				],
			]
		);
		$this->add_responsive_control(
			'dote_active_opacity',
			[
				'label' => esc_html__('Opacity', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1,
						'step' => .1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .topppa-dote-pagination .swiper-pagination-bullet-active' => 'opacity: {{SIZE}};',
				],
			]
		);
		$this->add_responsive_control(
			'dote_ascale',
			[
				'label' => esc_html__('Border Scale', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default' => [
					'size' => 1,
				],
				'selectors' => [
					'{{WRAPPER}} .topppa-dote-pagination .swiper-pagination-bullet-active:after' => 'transform: translate(-50%, -50%) scale({{SIZE}});',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name'     => 'active_dote_border',
				'label'    => esc_html__('Border', 'topper-pack'),
				'selector' => '{{WRAPPER}} .topppa-dote-pagination .swiper-pagination-bullet-active:after',
			]
		);
		$this->add_responsive_control(
			'active_dote_border_radius',
			[
				'label'      => esc_html__('Border Radius', 'topper-pack'),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors'  => [
					'{{WRAPPER}} .topppa-dote-pagination .swiper-pagination-bullet-active:after' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'dote_Margin',
			[
				'label'      => esc_html__('Margin', 'topper-pack'),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors'  => [
					'{{WRAPPER}} .topppa-dote-pagination' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'dote_padding',
			[
				'label'      => esc_html__('Padding', 'topper-pack'),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors'  => [
					'{{WRAPPER}} .topppa-dote-pagination' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'arrow_content_option',
			[
				'label' => esc_html__('Arrow Style Option', 'topper-pack'),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
				'condition' => [
					'enable_arrow' => 'yes',
					'enable_slider' => 'yes',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'arrow_typography',
				'selector' => '{{WRAPPER}} .service-slider-arrow .button',
			]
		);
		$this->add_responsive_control(
			'arrow_height',
			[
				'label' => esc_html__('Height', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px', '%', 'em', 'rem', 'custom'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 200,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .service-slider-arrow .button' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'arrow_width',
			[
				'label' => esc_html__('Width', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px', '%', 'em', 'rem', 'custom'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 200,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .service-slider-arrow .button' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);


		$this->start_controls_tabs(
			'arrow_style_tabs'
		);
		$this->start_controls_tab(
			'arrow_normal_tabs',
			[
				'label' => __('Normal', 'topper-pack'),
			]
		);
		$this->add_responsive_control(
			'arrow_color',
			[
				'label'     => esc_html__('Color', 'topper-pack'),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .service-slider-arrow .button' => 'color: {{VALUE}}',
					'{{WRAPPER}} .service-slider-arrow .button svg path' => 'fill: {{VALUE}}',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'arrow_background',
				'label' => esc_html__('Background', 'topper-pack'),
				'types' => ['classic', 'gradient', 'video'],
				'selector' => '{{WRAPPER}} .service-slider-arrow .button',
				'fields_options' => [
					'background' => [
						'label' => esc_html__('Background', 'topper-pack'),
						'default' => 'classic',
					],
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name'     => 'arrow_border',
				'label'    => esc_html__('Border', 'topper-pack'),
				'selector' => '{{WRAPPER}} .service-slider-arrow .button',
			]
		);
		$this->add_responsive_control(
			'arrow_border_radius',
			[
				'label'      => esc_html__('Border Radius', 'topper-pack'),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors'  => [
					'{{WRAPPER}} .service-slider-arrow .brand-logo-arrow' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'arrow_hover_tabs',
			[
				'label' => __('Hover', 'topper-pack'),
			]
		);
		$this->add_responsive_control(
			'arrow_color_hover',
			[
				'label'     => esc_html__('Hover Color', 'topper-pack'),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .service-slider-arrow .button:hover' => 'color: {{VALUE}}',
					'{{WRAPPER}} .service-slider-arrow .button:hover svg path' => 'fill: {{VALUE}}',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'arrow_background_hover',
				'label' => esc_html__('Background', 'topper-pack'),
				'types' => ['classic', 'gradient', 'video'],
				'selector' => '{{WRAPPER}} .service-slider-arrow .button:hover',
				'fields_options' => [
					'background' => [
						'label' => esc_html__('Background', 'topper-pack'),
						'default' => 'classic',
					],
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name'     => 'arrow_border_hover',
				'label'    => esc_html__('Border', 'topper-pack'),
				'selector' => '{{WRAPPER}} .service-slider-arrow .button:hover,',
			]
		);
		$this->add_responsive_control(
			'arrow_border_radius_hover',
			[
				'label'      => esc_html__('Border Radius', 'topper-pack'),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors'  => [
					'{{WRAPPER}} .service-slider-arrow .button:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->add_responsive_control(
			'arrow_Margin',
			[
				'label'      => esc_html__('Margin', 'topper-pack'),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors'  => [
					'{{WRAPPER}} .service-slider-arrow .button' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'arrow_padding',
			[
				'label'      => esc_html__('Padding', 'topper-pack'),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors'  => [
					'{{WRAPPER}} .service-slider-arrow .button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();
	}

	/**
	 * Render widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();
		// Your widget output here
		$SliderId = wp_rand(1241, 3256); // phpcs:ignore WordPress.WP.AlternativeFunctions.rand_rand
		$allowed_html = [
			'a'      => ['href' => []],
			'br'     => [],
			'em'     => [],
			'strong' => [],
		];
		if ($settings['enable_slider'] == 'yes') {
			$column = 'service-slide-item';
		} else {
			$column = $settings['xl_col'] . ' ' . $settings['lg_col'] . ' ' . $settings['md-col'];
		}
		$button_classes = [
			'style_one' => 'style-one',
			'style_two' => 'style-two',
			'style_three' => 'style-three',
			'style_four' => 'style-four',
			'style_five' => 'style-five',
			'style_six' => 'style-six',
			'style_seven' => 'style-seven',
			'style_eight' => 'style-eight',
			'style_nine' => 'style-nine',
			'style_ten' => 'style-ten',
			'style_eleven' => 'style-eleven',
			'style_twelve' => 'style-twelve',
			'style_thirteen' => 'style-thirteen',
			'style_fourteen' => 'style-fourteen',
			'style_fifteen' => 'style-fifteen',
		];
		$btn_class = isset($button_classes[$settings['topppa_btn_styles']]) ? $button_classes[$settings['topppa_btn_styles']] : '';
		$style_clas = [
			'style_one' => 'style-one',
			'style_two' => 'style-two',
			'style_three' => 'style-three',
			'style_four' => 'style-four',
			'style_five' => 'style-five',
		];
		$class = isset($style_clas[$settings['select_style']]) ? $style_clas[$settings['select_style']] : '';
?>
		<div class="topppa-service-slider <?php echo esc_attr($class); ?>">
			<div class="<?php echo esc_attr(
							($settings['enable_slider'] === 'yes' ? 'swiper topppa-swiper-slider' : 'no-slide') . ' topppa-swiper-slider-' . $SliderId
						); ?>"
				<?php if ($settings['enable_slider'] === 'yes') : ?>
				data-slides-per-view="<?php echo esc_attr($settings['slide_show_lagrge_item']); ?>"
				data-space-between="<?php echo esc_attr($settings['slider_space_between']['size']); ?>"
				data-auto-loop="<?php echo esc_attr($settings['enable_slider_auto_loop']); ?>"
				data-slide-speed="<?php echo esc_attr($settings['slide_speed'] ?? 2000); ?>"
				data-slider-speed="<?php echo esc_attr($settings['slider_speed'] ?? 600); ?>"
				data-enable-dote="<?php echo esc_attr($settings['enable_dote'] ?? 'no'); ?>"
				data-enable-arrow="<?php echo esc_attr($settings['enable_arrow'] ?? 'yes'); ?>"
				data-large-items="<?php echo esc_attr($settings['slide_show_lagrge_item']); ?>"
				data-tablet-items="<?php echo esc_attr($settings['slide_show_teblet_item']); ?>"
				data-mobile-items="<?php echo esc_attr($settings['slide_show_mobile_item']); ?>"
				data-extra-mobile-items="<?php echo esc_attr($settings['slide_show_extra_mobile_item']); ?>"
				data-enable-rtl="<?php echo esc_attr($settings['enable_rtl']); ?>"
				<?php endif; ?>>
				<div class="<?php echo esc_attr($settings['enable_slider'] === 'yes' ? 'swiper-wrapper' : 'row'); ?>">
					<?php foreach ($settings['topppa_slider_item'] as $index => $item) : ?>
						<div class="<?php echo esc_attr($settings['enable_slider'] === 'yes' ? 'swiper-slide' : $column); ?>">
							<div class="topppa-service-slider-item <?php echo $index === 1 ? 'active' : ''; ?>">
								<div class="topppa-service-slider-img">
									<?php echo wp_get_attachment_image($item['image']['id'], 'full'); ?>
									<?php if ($item['enable_button_two'] === 'yes' && $settings['select_style'] === 'style_four') :
										$target      = $item['btn_two_link']['is_external'] ? ' target="_blank"' : '';
										$nofollow    = $item['btn_two_link']['nofollow'] ? ' rel="nofollow"' : '';
										$custom_attr = !empty($item['btn_two_link']['custom_attributes']) ? $item['btn_two_link']['custom_attributes'] : '';
									?>
										<a href="<?php echo esc_url($item['btn_two_link']['url']); ?>" class="topppa-service-slider-button-two"
											<?php echo esc_attr($target . $nofollow . $custom_attr); ?>>
											<?php \Elementor\Icons_Manager::render_icon($item['btn_two_icon'], ['aria-hidden' => 'true']); ?>
										</a>
									<?php endif; ?>
								</div>

								<div class="topppa-service-slider-content">
									<!-- Style Three Icon -->
									<?php if ($settings['select_style'] === 'style_three') : ?>
										<div class="topppa-service-slider-icon">
											<?php \Elementor\Icons_Manager::render_icon($item['title_icon'], ['aria-hidden' => 'true']); ?>
										</div>
									<?php endif; ?>
									<div class="topppa-service-slider-content-area">

										<?php if (!empty($item['stitle'])) : ?>
											<div class="topppa-service-slider-stitle">
												<?php echo esc_html($item['stitle']); ?>
											</div>
										<?php endif; ?>

										<<?php echo esc_attr($settings['title_tag']); ?> class="topppa-service-slider-title">
											<?php if (! empty($item['title_icon'])) : ?>
												<span>
													<?php \Elementor\Icons_Manager::render_icon($item['title_icon'], ['aria-hidden' => 'true']); ?>
												</span>
											<?php endif; ?>
											<?php if ($item['enable_title_link'] === 'yes' && !empty($item['title_link']['url'])) : ?>
												<?php
												$target = $item['title_link']['is_external'] ? ' target="_blank"' : '';
												$nofollow = $item['title_link']['nofollow'] ? ' rel="nofollow"' : '';
												$custom_attr = !empty($item['title_link']['custom_attributes']) ? $item['title_link']['custom_attributes'] : '';
												?>
												<a href="<?php echo esc_url($item['title_link']['url']); ?>" <?php echo esc_attr($target . $nofollow . $custom_attr); ?>>
													<?php echo esc_html($item['title']); ?>
												</a>
											<?php else : ?>
												<?php echo esc_html($item['title']); ?>
											<?php endif; ?>
										</<?php echo esc_attr($settings['title_tag']); ?>>

										<?php if ($item['enable_description'] === 'yes' && !empty($item['topppa_service_slider_desc'])) : ?>
											<div class="topppa-service-slider-des">
												<?php echo wp_kses($item['topppa_service_slider_desc'], $allowed_html); ?>
											</div>
										<?php endif; ?>
										<?php if ($item['enable_button'] === 'yes' && !empty($item['button_text'])) : ?>
											<?php
											$target      = $item['button_link']['is_external'] ? ' target="_blank"' : '';
											$nofollow    = $item['button_link']['nofollow'] ? ' rel="nofollow"' : '';
											$custom_attr = !empty($item['button_link']['custom_attributes']) ? $item['button_link']['custom_attributes'] : '';
											?>
											<div class="topppa-service-slider-button">
												<div class="topppa-btn-wrapper slider-btn-wrapper <?php echo esc_attr($btn_class); ?>">
													<a href="<?php echo esc_url($item['button_link']['url']); ?>"
														<?php echo esc_attr($target . $nofollow . $custom_attr); ?>
														class="topppa-btn">
														<span class="top-btn-text top-btn-text-v3">
															<?php echo esc_html($item['button_text']); ?>
														</span>

														<?php if ($btn_class === 'style-three') : ?>
															<span class="bottom-btn-text bottom-btn-text-v3">
																<?php echo esc_html($item['button_text']); ?>
															</span>
														<?php endif; ?>

														<?php if (!empty($item['enable_icon']) && $item['enable_icon'] === 'yes' && !empty($item['btn_icon'])) : ?>
															<div class="btn-icon">
																<?php \Elementor\Icons_Manager::render_icon($item['btn_icon'], ['aria-hidden' => 'true']); ?>
															</div>
														<?php endif; ?>
													</a>
												</div>
											</div>
										<?php endif; ?>
									</div>
								</div>

							</div>
						</div>
					<?php endforeach; ?>

				</div>
			</div>

			<?php if ('yes' === ($settings['enable_dote'] ?? 'no') && $settings['enable_slider'] === 'yes') : ?>
				<div class="service-slider-pagination topppa-dote-pagination topppa-topppa-dote-pagination-<?php echo esc_attr($SliderId); ?>"></div>
			<?php endif; ?>

			<?php if ('yes' === ($settings['enable_arrow'] ?? 'yes') && 'yes' === $settings['enable_slider']) : ?>
				<div class="service-slider-arrow">
					<?php if ('text' === ($settings['style_arrow_type'] ?? 'text')) : ?>
						<div class="topppa-arrow-prev topppa-brand-logo-button-prev-<?php echo esc_attr($SliderId); ?> button">
							<?php echo esc_html__('Prev', 'topper-pack'); ?>
						</div>
						<div class="topppa-arrow-next topppa-brand-logo-button-next-<?php echo esc_attr($SliderId); ?> button">
							<?php echo esc_html__('Next', 'topper-pack'); ?>
						</div>
					<?php else : ?>
						<div class="topppa-arrow-prev topppa-brand-logo-button-prev-<?php echo esc_attr($SliderId); ?> button">
							<?php \Elementor\Icons_Manager::render_icon($settings['left_arrow_icon'], ['aria-hidden' => 'true']); ?>
						</div>
						<div class="topppa-arrow-next topppa-brand-logo-button-next-<?php echo esc_attr($SliderId); ?> button">
							<?php \Elementor\Icons_Manager::render_icon($settings['right_arrow_icon'], ['aria-hidden' => 'true']); ?>
						</div>
					<?php endif; ?>
				</div>
			<?php endif; ?>
		</div>
<?php
	}
}