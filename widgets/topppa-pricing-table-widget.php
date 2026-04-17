<?php

/**
 * Elementor TOPPPA Pricing Table Widget.
 *
 * @package TopperPack
 * @since 1.0.0
 */

use TopperPack\Trait_Loader\Global_Component_Loader;
use \TopperPack\Includes\Controls\Controls_Manager as TopperPack_Controls_Manager;

if (! defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}

/**
 * Class TOPPPA_Pricing_Table_Widget
 *
 * @package TopperPack
 * @since 1.0.0
 */
class TOPPPA_Pricing_Table_Widget extends \Elementor\Widget_Base {

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
		return 'topppa_pricing_table';
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
		return TOPPPA_EPWB . esc_html__('Pricing Table', 'topper-pack');
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
		return 'eicon-price-table';
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
		return ['topppa', 'widget', 'pricing', 'table', 'topperpack'];
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
		return 'https://doc.topperpack.com/docs/general-widgets/pricing-table/';
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
		return 'https://topperpack.com/assets/widgets/pricing-widget/';
	}

	/**
	 * Register Pricing Table Widget controls.
	 *
	 * Add input fields to allow the user to customize the widget settings.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function register_controls() {

		$base_url = $this->get_custom_image_url();

		$this->start_controls_section(
			'topppa_blog_style',
			[
				'label' => esc_html__('Styles', 'topper-pack'),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'main_box_display',
			[
				'label' => esc_html__('Shape', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'block',
				'options' => [
					'block' => esc_html__('Enable', 'topper-pack'),
					'none' => esc_html__('Disable', 'topper-pack'),
				],
				'selectors' => [
					'{{WRAPPER}} .topppa-pricing-wrapper .topppa-pricing-amount::before' => 'display: {{VALUE}};',
					'{{WRAPPER}} .topppa-pricing-wrapper .topppa-pricing-amount::after' => 'display: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'topppa_styles',
			[
				'label' => esc_html__('Choose Style', 'topper-pack'),
				'type' => TopperPack_Controls_Manager::IMAGECHOOSE,
				'default' => 'style_one',
				'options' => [
					'style_one' => [
						'title' => esc_html__('Style 1', 'topper-pack'),
						'imagelarge' => $base_url . 'topppa-pricing-1.jpg',
						'imagesmall' => $base_url . 'topppa-pricing-1.jpg',
						'width' => '100%',
					],
					'style_two' => [
						'title' => esc_html__('style 2', 'topper-pack'),
						'imagelarge' => $base_url . 'topppa-pricing-2.jpg',
						'imagesmall' => $base_url . 'topppa-pricing-2.jpg',
						'width' => '100%',
					],
					'style_three' => [
						'title' => esc_html__('Style 3', 'topper-pack'),
						'imagelarge' => $base_url . 'topppa-pricing-3.jpg',
						'imagesmall' => $base_url . 'topppa-pricing-3.jpg',
						'width' => '100%',
					],
					'style_four' => [
						'title' => esc_html__('Style 4', 'topper-pack'),
						'imagelarge' => $base_url . 'topppa-pricing-4.jpg',
						'imagesmall' => $base_url . 'topppa-pricing-4.jpg',
						'width' => '100%',
					],
					'style_five' => [
						'title' => esc_html__('Style 5', 'topper-pack'),
						'imagelarge' => $base_url . 'topppa-pricing-5-l.jpg',
						'imagesmall' => $base_url . 'topppa-pricing-5-s.jpg',
						'width' => '100%',
					],
				],
			]
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'pricing_price_options',
			[
				'label' => esc_html__('Price', 'topper-pack'),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'icon_box_options',
			[
				'label'       => esc_html__('Icon Type', 'topper-pack'),
				'type'        => \Elementor\Controls_Manager::CHOOSE,
				'label_block' => false,
				'options'     => [
					'none' => [
						'title' => esc_html__('None', 'topper-pack'),
						'icon'  => 'fa fa-ban',
					],
					'icon' => [
						'title' => esc_html__('Icon', 'topper-pack'),
						'icon'  => 'fa fa-paint-brush',
					],
					'image' => [
						'title' => esc_html__('Image', 'topper-pack'),
						'icon'  => 'fa fa-image',
					],
				],
				'default'       => 'icon',
			]
		);

		$this->add_control(
			'icon_box_icons',
			[
				'label' => esc_html__('Header Icon', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::ICONS,
				'default' => [
					'value' => 'fas fa-star',
					'library' => 'fa-solid',
				],
				'label_block' => true,
				'condition' => [
					'icon_box_options' => 'icon',
				]
			]
		);
		$this->add_control(
			'enable_icon_shape',
			[
				'label' => esc_html__('Icon Shape', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'none',
				'options' => [
					'none' => esc_html__('Hide', 'topper-pack'),
					'block' => esc_html__('Show', 'topper-pack'),
				],
				'selectors' => [
					'{{WRAPPER}} .topppa-pricing-wrapper .pricing-icon::before' => 'display: {{VALUE}};',
				],
				'condition' => [
					'icon_box_options' => 'icon',
				]
			]
		);
		$this->add_control(
			'icon_box_image',
			[
				'label' => esc_html__('Choose Image', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'condition' => [
					'icon_box_options' => 'image',
				]
			]
		);
		$this->add_control(
			'price_label',
			[
				'label' => esc_html__('Price Label', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__('/Month', 'topper-pack'),
			]
		);
		$this->add_control(
			'price',
			[
				'label' => esc_html__('Price', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__('$10.00', 'topper-pack'),
			]
		);
		$this->end_controls_section();

		// <==========>
		// <==========> IMAGE STYLES <==========>

		$this->start_controls_section(
			'pricing_title_options',
			[
				'label' => esc_html__('Title', 'topper-pack'),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'title',
			[
				'label' => esc_html__('Title', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__('Basic Plan', 'topper-pack'),
			]
		);
		$this->add_control(
			'enable_small_title',
			[
				'label' => esc_html__('Enable Small Title', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Show', 'topper-pack'),
				'label_off' => esc_html__('Hide', 'topper-pack'),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);
		$this->add_control(
			'small_title',
			[
				'label' => esc_html__('Small Title', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__('Starter Package', 'topper-pack'),
				'condition' => [
					'enable_small_title' => 'yes'
				]
			]
		);

		$this->topppa_global_title_tag();

		$this->end_controls_section();

		$this->start_controls_section(
			'pricing_content_options',
			[
				'label' => esc_html__('Content', 'topper-pack'),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'enable_content',
			[
				'label' => esc_html__('Show Content', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Show', 'topper-pack'),
				'label_off' => esc_html__('Hide', 'topper-pack'),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);
		$repeater = new \Elementor\Repeater();
		$repeater->add_control(
			'disable_offer',
			[
				'label' => esc_html__('Want to disable?', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Show', 'topper-pack'),
				'label_off' => esc_html__('Hide', 'topper-pack'),
				'return_value' => 'yes',
				'default' => 'no',
			]
		);
		$repeater->add_control(
			'content',
			[
				'label' => esc_html__('Description', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::WYSIWYG,
				'default' => esc_html__('Ad Management', 'topper-pack'),
			]
		);
		$repeater->add_control(
			'icon',
			[
				'label' => esc_html__('Icon', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::ICONS,
				'default' => [
					'value' => 'fas fa-check-circle',
					'library' => 'fa-solid',
				],
			]
		);
		$this->add_control(
			'lists',
			[
				'label'   => esc_html__('List', 'topper-pack'),
				'type'    => \Elementor\Controls_Manager::REPEATER,
				'fields'  => $repeater->get_controls(),
				'default' => [
					[
						'content' => esc_html__('Cyber Analytics', 'topper-pack'),
					],
					[
						'content' => esc_html__('24/7 Consultant Service', 'topper-pack'),
					],
					[
						'content' => esc_html__('Great Customer Support', 'topper-pack'),
					],
				],
				'title_field' => '{{{ content }}}',
			]
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'pricing_button_options',
			[
				'label' => esc_html__('Button', 'topper-pack'),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->topppa_get_global_button_effects_controls();

		$this->add_control(
			'topppa_btn_text',
			[
				'label'       => esc_html__('Button Text', 'topper-pack'),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'default'     => esc_html__('Meet With Us', 'topper-pack'),
				'label_block' => true,
				'dynamic' => [
					'active' => true,
				],
			]
		);

		$this->add_control(
			'topppa_btn_link',
			[
				'label'       => esc_html__('Link', 'topper-pack'),
				'type'        => \Elementor\Controls_Manager::URL,
				'placeholder' => esc_html__('https://your-link.com', 'topper-pack'),
				'options'     => ['url', 'is_external', 'nofollow'],
				'default'     => [
					'url'         => '',
					'is_external' => true,
					'nofollow'    => true,
					// 'custom_attributes' => '',
				],
				'label_block' => true,
				'dynamic' => [
					'active' => true,
				],
			]
		);

		$this->add_control(
			'topppa_show_icon',
			[
				'label' => esc_html__('Show Icon', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Show', 'topper-pack'),
				'label_off' => esc_html__('Hide', 'topper-pack'),
				'return_value' => 'yes',
				'default' => 'no',
			]
		);

		$this->add_control(
			'topppa_btn_icon',
			[
				'label' => esc_html__('Icon', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::ICONS,
				'default' => [
					'value' => 'fas fa-arrow-right',
					'library' => 'fa-solid',
				],
				'condition' => [
					'topppa_show_icon' => 'yes'
				]
			]
		);
		$this->end_controls_section();

		// <==========>
		// <==========> BOX STYLES <==========>

		$this->start_controls_section(
			'main_box_styles',
			[
				'label' => esc_html__('Box', 'topper-pack'),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_responsive_control(
			'box_display',
			[
				'label' => esc_html__('Display Style', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => '',
				'options' => [
					'' => esc_html__('Default', 'topper-pack'),
					'flex' => esc_html__('Flex', 'topper-pack'),
				],
				'selectors' => [
					'{{WRAPPER}} .topppa-pricing-wrapper .topppa-pricing-box' => 'display: {{VALUE}};',
				],
			]
		);
		$this->add_responsive_control(
			'content_box_direction',
			[
				'label' => esc_html__('Direction', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'none',
				'options' => [
					'none' => esc_html__('None', 'topper-pack'),
					'row' => esc_html__('Row', 'topper-pack'),
					'row-reverse' => esc_html__('Row Reverse', 'topper-pack'),
					'column'  => esc_html__('Column', 'topper-pack'),
					'column-reverse' => esc_html__('Column Reverse', 'topper-pack'),
				],
				'selectors' => [
					'{{WRAPPER}} .topppa-pricing-wrapper .topppa-pricing-box' => 'flex-direction: {{VALUE}};',
				],
				'condition' => [
					'box_display' => 'flex',
				]
			]
		);
		$this->add_responsive_control(
			'content_box_align',
			[
				'label' => esc_html__('Alignment', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'options' => [
					'start' => [
						'title' => esc_html__('Start', 'topper-pack'),
						'icon' => 'eicon-v-align-top',
					],
					'center' => [
						'title' => esc_html__('Center', 'topper-pack'),
						'icon' => 'eicon-v-align-middle',
					],
					'end' => [
						'title' => esc_html__('End', 'topper-pack'),
						'icon' => 'eicon-v-align-bottom',
					],
				],
				'toggle' => true,
				'selectors' => [
					'{{WRAPPER}} .topppa-pricing-wrapper .topppa-pricing-box' => 'align-items: {{VALUE}};',
				],
				'condition' => [
					'box_display' => 'flex',
				]
			]
		);
		$this->add_responsive_control(
			'content_box_jalign',
			[
				'label' => esc_html__('Alignment', 'topper-pack'),
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
					'{{WRAPPER}} .topppa-pricing-wrapper .topppa-pricing-box' => 'justify-content: {{VALUE}};',
					'{{WRAPPER}} .topppa-pricing-wrapper .topppa-pricing-box' => 'text-align: {{VALUE}};',
				],
				'condition' => [
					'box_display' => 'flex',
					'content_box_direction' => ['column', 'column-reverse']
				]
			]
		);
		$this->add_responsive_control(
			'content_box_gap',
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
					'{{WRAPPER}} .topppa-pricing-wrapper .topppa-pricing-box' => 'gap: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'box_display' => 'flex',
				]
			]
		);
		$this->add_responsive_control(
			'text_align',
			[
				'label' => esc_html__('Alignment', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'options' => [
					'start' => [
						'title' => esc_html__('Left', 'topper-pack'),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => esc_html__('Center', 'topper-pack'),
						'icon' => 'eicon-text-align-center',
					],
					'end' => [
						'title' => esc_html__('Right', 'topper-pack'),
						'icon' => 'eicon-text-align-right',
					],
				],
				'default' => 'center',
				'toggle' => true,
				'selectors' => [
					'{{WRAPPER}} .topppa-pricing-wrapper' => 'text-align: {{VALUE}};',
					'{{WRAPPER}} .topppa-pricing-amount-box' => 'text-align: {{VALUE}};',
					'{{WRAPPER}} .topppa-pricing-wrapper .topppa-price-title' => 'text-align: {{VALUE}};',
					'{{WRAPPER}} .topppa-pricing-wrapper .pricing-small-title' => 'text-align: {{VALUE}};',
					'{{WRAPPER}} .topppa-pricing-amount-box' => 'align-items: {{VALUE}};',
					'{{WRAPPER}} .topppa-pricing-wrapper .topppa-pricing-amount' => 'align-items: {{VALUE}};',
					'{{WRAPPER}} .topppa-pricing-wrapper .topppa-pricing-content ul li' => 'justify-content: {{VALUE}};',
					'{{WRAPPER}} .topppa-pricing-amount-box' => 'justify-content: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'main_box_bg',
				'label' => esc_html__('Background', 'topper-pack'),
				'types' => ['classic', 'gradient', 'video'],
				'selector' => '{{WRAPPER}} .topppa-pricing-wrapper',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'main_box_border',
				'label' => esc_html__('Border', 'topper-pack'),
				'selector' => '{{WRAPPER}} .topppa-pricing-wrapper',
			]
		);
		$this->add_responsive_control(
			'main_box_radius',
			[
				'label' => esc_html__('Border Radius', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .topppa-pricing-wrapper' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'main_box_shadow',
				'label' => esc_html__('Box Shadow', 'topper-pack'),
				'selector' => '{{WRAPPER}} .topppa-pricing-wrapper',
			]
		);
		// multiple shadow
		$this->add_control(
			'enable_double_shadow',
			[
				'label'        => esc_html__('Enable Double Shadow', 'topper-pack'),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => esc_html__('Yes', 'topper-pack'),
				'label_off'    => esc_html__('No', 'topper-pack'),
				'return_value' => 'yes',
				'default'      => 'no',
			]
		);

		// Shadow #1
		$this->add_control(
			'shadow1',
			[
				'label'     => esc_html__('Shadow 1', 'topper-pack'),
				'type'      => \Elementor\Controls_Manager::BOX_SHADOW,
				'condition' => [
					'enable_double_shadow' => 'yes',
				],
				'selectors' => [],
			]
		);

		// Shadow #2
		$this->add_control(
			'shadow2',
			[
				'label'     => esc_html__('Shadow 2', 'topper-pack'),
				'type'      => \Elementor\Controls_Manager::BOX_SHADOW,
				'condition' => [
					'enable_double_shadow' => 'yes',
				],
				'selectors' => [],
			]
		);
		$this->add_responsive_control(
			'main_box_margin',
			[
				'label' => esc_html__('Margin', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .topppa-pricing-wrapper' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'main_box_padding',
			[
				'label' => esc_html__('Padding', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .topppa-pricing-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();

		// <==========>
		// <==========> PACKAGE AMOUNT BOX STYLES <==========>

		$this->start_controls_section(
			'box_styles',
			[
				'label' => esc_html__('Package Amount Box', 'topper-pack'),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_responsive_control(
			'box_width',
			[
				'label' => esc_html__('Max Width', 'topper-pack'),
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
					'{{WRAPPER}} .topppa-pricing-wrapper .topppa-pricing-amount' => 'max-width: {{SIZE}}{{UNIT}};',
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
					'{{WRAPPER}} .topppa-pricing-wrapper .topppa-pricing-amount' => 'gap: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'box_bg',
				'label' => esc_html__('Background', 'topper-pack'),
				'types' => ['classic', 'gradient', 'video'],
				'selector' => '{{WRAPPER}} .topppa-pricing-wrapper .topppa-pricing-amount',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'box_border',
				'label' => esc_html__('Border', 'topper-pack'),
				'selector' => '{{WRAPPER}} .topppa-pricing-wrapper .topppa-pricing-amount',
			]
		);
		$this->add_responsive_control(
			'box_radius',
			[
				'label' => esc_html__('Border Radius', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .topppa-pricing-wrapper .topppa-pricing-amount' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'box_shadow',
				'label' => esc_html__('Box Shadow', 'topper-pack'),
				'selector' => '{{WRAPPER}} .topppa-pricing-wrapper .topppa-pricing-amount',
			]
		);

		$this->add_control(
			'pricing_month',
			[
				'label' => esc_html__('Pricing & Month', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'pricing_month_bg',
				'label' => esc_html__('Background', 'topper-pack'),
				'types' => ['classic', 'gradient', 'video'],
				'selector' => '{{WRAPPER}} .topppa-pricing-wrapper .topppa-pricing-amount .topppa-pricing-amount-box',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'pricing_month_border',
				'label' => esc_html__('Border', 'topper-pack'),
				'selector' => '{{WRAPPER}} .topppa-pricing-wrapper .topppa-pricing-amount .topppa-pricing-amount-box',
			]
		);
		$this->add_responsive_control(
			'pricing_month_radius',
			[
				'label' => esc_html__('Border Radius', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .topppa-pricing-wrapper .topppa-pricing-amount .topppa-pricing-amount-box' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'pricing_month_shadow',
				'label' => esc_html__('Box Shadow', 'topper-pack'),
				'selector' => '{{WRAPPER}} .topppa-pricing-wrapper .topppa-pricing-amount .topppa-pricing-amount-box',
			]
		);

		$this->add_control(
			'content_box_order',
			[
				'label' => esc_html__('Content Position Order', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_control(
			'title_order',
			[
				'label' => esc_html__('Title Order', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'min' => 1,
				'max' => 10,
				'step' => 1,
				'description' => esc_html__('The higher number will place at the top of all items.', 'topper-pack'),
				'selectors' => [
					'{{WRAPPER}} .topppa-pricing-wrapper .topppa-price-title' => 'order: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'small_title_order',
			[
				'label' => esc_html__('Small Order', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'min' => 1,
				'max' => 10,
				'step' => 1,
				'selectors' => [
					'{{WRAPPER}} .topppa-pricing-wrapper .pricing-small-title' => 'order: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'duration_order',
			[
				'label' => esc_html__('Price Duration Order', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'min' => 1,
				'max' => 10,
				'step' => 1,
				'selectors' => [
					'{{WRAPPER}} .topppa-pricing-wrapper .topppa-pricing-amount .topppa-pricing-amount-box' => 'order: {{VALUE}};',
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
					'{{WRAPPER}} .topppa-pricing-wrapper .topppa-pricing-amount' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .topppa-pricing-wrapper .topppa-pricing-amount' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();

		// <==========>
		// <=================> ICON STYLES <=================>
		$this->start_controls_section(
			'pricing_icon_style',
			[
				'label' => esc_html__('Icon', 'topper-pack'),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
				'condition' => [
					'icon_box_options' => 'icon'
				]
			],
		);
		$this->add_responsive_control(
			'pricing_icon_align',
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
				'default' => 'center',
				'toggle' => true,
				'selectors' => [
					'{{WRAPPER}} .topppa-pricing-wrapper .pricing-icon' => 'justify-content: {{VALUE}};',
				],
			]
		);
		$this->add_responsive_control(
			'pricing_icon_height',
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
					'{{WRAPPER}} .topppa-pricing-wrapper .pricing-icon' => 'height: {{SIZE}}{{UNIT}};',
				],
			],
		);
		$this->add_responsive_control(
			'pricing_icon_width',
			[
				'label' => esc_html__('Width', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px', '%', 'em', 'rem', 'custom'],
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
					'{{WRAPPER}} .topppa-pricing-wrapper .pricing-icon' => 'width: {{SIZE}}{{UNIT}};',
				],
			],
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'pricing_icon_typo',
				'selector' => '{{WRAPPER}} .topppa-pricing-wrapper .pricing-icon',
			],
		);
		$this->add_responsive_control(
			'pricing_icon_color',
			[
				'label'     => esc_html__('Icon Color', 'topper-pack'),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .topppa-pricing-wrapper .pricing-icon' => 'color: {{VALUE}}',
				],
			],
		);
		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'pricing_icon_bg',
				'types' => ['classic', 'gradient', 'video'],
				'selector' => '{{WRAPPER}} .topppa-pricing-wrapper .pricing-icon',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name'     => 'pricing_icon_border',
				'label'    => esc_html__('Border', 'topper-pack'),
				'selector' => '{{WRAPPER}} .topppa-pricing-wrapper .pricing-icon',
			],
		);
		$this->add_responsive_control(
			'pricing_icon_border_radius',
			[
				'label'      => esc_html__('Border Radius', 'topper-pack'),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors'  => [
					'{{WRAPPER}} .topppa-pricing-wrapper .pricing-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			],
		);
		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'pricing_icon_shadow',
				'selector' => '{{WRAPPER}} .topppa-pricing-wrapper .pricing-icon',
			],
		);
		$this->add_responsive_control(
			'pricing_icon_margin',
			[
				'label' => esc_html__('Margin', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em', 'rem', 'custom'],
				'selectors' => [
					'{{WRAPPER}} .topppa-pricing-wrapper .pricing-icon' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'pricing_icon_padding',
			[
				'label' => esc_html__('Padding', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em', 'rem', 'custom'],
				'selectors' => [
					'{{WRAPPER}} .topppa-pricing-wrapper .pricing-icon' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'icon_shape_styles',
			[
				'label' => esc_html__('Icon Shape', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => [
					'enable_icon_shape' => 'block',
				]
			]
		);
		$this->add_responsive_control(
			'icon_shape_position_x',
			[
				'label' => esc_html__('Position X', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px', '%', 'em', 'rem', 'custom'],
				'range' => [
					'px' => [
						'min' => -1000,
						'max' => 1000,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .topppa-pricing-wrapper .pricing-icon::before' => 'right: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'enable_icon_shape' => 'block',
				]
			]
		);
		$this->add_responsive_control(
			'icon_shape_position_y',
			[
				'label' => esc_html__('Position Y', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px', '%', 'em', 'rem', 'custom'],
				'range' => [
					'px' => [
						'min' => -1000,
						'max' => 1000,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .topppa-pricing-wrapper .pricing-icon::before' => 'bottom: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'enable_icon_shape' => 'block',
				]
			]
		);
		$this->add_responsive_control(
			'icon_shape_height',
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
					'size' => 140,
				],
				'selectors' => [
					'{{WRAPPER}} .topppa-pricing-wrapper .pricing-icon::before' => 'height: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'enable_icon_shape' => 'block',
				]
			]
		);
		$this->add_responsive_control(
			'icon_shape_width',
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
				'default' => [
					'unit' => 'px',
					'size' => 140,
				],
				'selectors' => [
					'{{WRAPPER}} .topppa-pricing-wrapper .pricing-icon::before' => 'width: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'enable_icon_shape' => 'block',
				]
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'icon_shape_background',
				'types' => ['classic', 'gradient', 'video'],
				'selector' => '{{WRAPPER}} .topppa-pricing-wrapper .pricing-icon::before',
				'condition' => [
					'enable_icon_shape' => 'block',
				]
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'icon_shape_border',
				'selector' => '{{WRAPPER}} .topppa-pricing-wrapper .pricing-icon::before',
				'condition' => [
					'enable_icon_shape' => 'block',
				]
			]
		);
		$this->add_responsive_control(
			'icon_shape_border_radius',
			[
				'label' => esc_html__('Border Radius', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .topppa-pricing-wrapper .pricing-icon::before' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'enable_icon_shape' => 'block',
				]
			]
		);
		$this->end_controls_section();

		// <==========>
		// <==========> Pricing and Duration styles <==========>

		$this->start_controls_section(
			'price_box_styles',
			[
				'label' => esc_html__('Price & Duration', 'topper-pack'),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_responsive_control(
			'price_width',
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
					'{{WRAPPER}} .topppa-pricing-amount-box' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'price_height',
			[
				'label' => esc_html__('Price Height', 'topper-pack'),
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
					'{{WRAPPER}} .topppa-pricing-amount-box' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'price_direction',
			[
				'label' => esc_html__('Direction', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'options' => [
					'column' => [
						'title' => esc_html__('Column', 'topper-pack'),
						'icon' => 'eicon-v-align-top',
					],
					'column-reverse' => [
						'title' => esc_html__('Column Reverse', 'topper-pack'),
						'icon' => 'eicon-v-align-bottom',
					],
					'row' => [
						'title' => esc_html__('Row', 'topper-pack'),
						'icon' => 'eicon-h-align-right',
					],
					'row-reverse' => [
						'title' => esc_html__('Row Reverse', 'topper-pack'),
						'icon' => 'eicon-h-align-left',
					],
				],
				'toggle' => true,
				'selectors' => [
					'{{WRAPPER}} .topppa-pricing-amount-box' => 'flex-direction: {{VALUE}};',
				],
			]
		);
		$this->add_responsive_control(
			'price_gap',
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
					'{{WRAPPER}} .topppa-pricing-wrapper .topppa-pricing-amount-box' => 'gap: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'main_box_align',
			[
				'label' => esc_html__('Alignment', 'topper-pack'),
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
					'{{WRAPPER}} .topppa-pricing-wrapper .topppa-pricing-amount-box' => 'align-items: {{VALUE}};',
				],
			]
		);
		$this->add_responsive_control(
			'tab_menu_box_align',
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
					'space-between' => [
						'title' => esc_html__('Space Between', 'topper-pack'),
						'icon' => 'eicon-justify-space-between-h',
					],
					'space-around' => [
						'title' => esc_html__('Space Between', 'topper-pack'),
						'icon' => 'eicon-justify-space-around-h',
					],
					'flex-end' => [
						'title' => esc_html__('Right', 'topper-pack'),
						'icon' => 'eicon-justify-end-h',
					],
				],
				'toggle' => true,
				'selectors' => [
					'{{WRAPPER}} .topppa-pricing-wrapper .topppa-pricing-amount-box' => 'justify-content: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'price_border',
				'selector' => '{{WRAPPER}} .topppa-pricing-wrapper .topppa-pricing-amount-box',
			]
		);
		$this->add_responsive_control(
			'price_border_radius',
			[
				'label' => esc_html__('Border Radius', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .topppa-pricing-wrapper .topppa-pricing-amount-box' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'price_background',
				'types' => ['classic', 'gradient', 'video'],
				'selector' => '{{WRAPPER}} .topppa-pricing-wrapper .topppa-pricing-amount-box',
			]
		);
		$this->start_controls_tabs(
			'price_style_tabs'
		);

		$this->start_controls_tab(
			'price_style_tab',
			[
				'label' => esc_html__('Price', 'topper-pack'),
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'price_typo',
				'selector' => '{{WRAPPER}} .topppa-pricing-wrapper .topppa-pricing-amount .topppa-pricing-amount-box, .topppa-pricing-wrapper.five .topppa-table-price',
			]
		);
		$this->add_responsive_control(
			'price_color',
			[
				'label'     => esc_html__('Color', 'topper-pack'),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .topppa-pricing-wrapper .topppa-pricing-amount .topppa-pricing-amount-box, .topppa-pricing-wrapper.five .topppa-table-price' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_responsive_control(
			'price_margin',
			[
				'label'      => esc_html__('Margin', 'topper-pack'),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors'  => [
					'{{WRAPPER}} .topppa-pricing-wrapper .topppa-pricing-amount .topppa-pricing-amount-box, .topppa-pricing-wrapper.five .topppa-table-price' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'price_padding',
			[
				'label'      => esc_html__('Padding', 'topper-pack'),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors'  => [
					'{{WRAPPER}} .topppa-pricing-wrapper .topppa-pricing-amount .topppa-pricing-amount-box, .topppa-pricing-wrapper.five .topppa-table-price' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_tab();

		$this->start_controls_tab(
			'label_style_tab',
			[
				'label' => esc_html__('Label', 'topper-pack'),
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'label_typo',
				'selector' => '{{WRAPPER}} .topppa-pricing-wrapper .topppa-price-title',
			]
		);
		$this->add_responsive_control(
			'label_color',
			[
				'label'     => esc_html__('Color', 'topper-pack'),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .topppa-pricing-wrapper .topppa-price-title' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_responsive_control(
			'label_margin',
			[
				'label'      => esc_html__('Margin', 'topper-pack'),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors'  => [
					'{{WRAPPER}} .topppa-pricing-wrapper .topppa-price-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'label_padding',
			[
				'label'      => esc_html__('Padding', 'topper-pack'),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors'  => [
					'{{WRAPPER}} .topppa-pricing-wrapper .topppa-price-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'small_label',
			[
				'label' => esc_html__('Small Label', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_responsive_control(
			'small_label_max_width',
			[
				'label' => esc_html__('Max Width', 'topper-pack'),
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
					'{{WRAPPER}} .topppa-pricing-wrapper .pricing-small-title' => 'max-width: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'small_label_typo',
				'selector' => '{{WRAPPER}} .topppa-pricing-wrapper .pricing-small-title',
			]
		);
		$this->add_responsive_control(
			'small_label_color',
			[
				'label'     => esc_html__('Color', 'topper-pack'),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .topppa-pricing-wrapper .pricing-small-title' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_responsive_control(
			'small_label_margin',
			[
				'label'      => esc_html__('Margin', 'topper-pack'),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors'  => [
					'{{WRAPPER}} .topppa-pricing-wrapper .pricing-small-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'small_label_padding',
			[
				'label'      => esc_html__('Padding', 'topper-pack'),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors'  => [
					'{{WRAPPER}} .topppa-pricing-wrapper .pricing-small-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_tab();

		$this->start_controls_tab(
			'price_month_tab',
			[
				'label' => esc_html__('Month', 'topper-pack'),
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'price_month_typo',
				'selector' => '{{WRAPPER}} .topppa-pricing-wrapper .topppa-pricing-amount .topppa-pricing-amount-box span, .topppa-pricing-wrapper.five .topppa-pricing-amount-box span',
			]
		);
		$this->add_responsive_control(
			'price_month_color',
			[
				'label'     => esc_html__('Color', 'topper-pack'),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .topppa-pricing-wrapper .topppa-pricing-amount .topppa-pricing-amount-box span, .topppa-pricing-wrapper.five .topppa-pricing-amount-box span' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_responsive_control(
			'price_month_margin',
			[
				'label'      => esc_html__('Margin', 'topper-pack'),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors'  => [
					'{{WRAPPER}} .topppa-pricing-wrapper .topppa-pricing-amount .topppa-pricing-amount-box span, .topppa-pricing-wrapper.five .topppa-pricing-amount-box span' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'price_month_padding',
			[
				'label'      => esc_html__('Padding', 'topper-pack'),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors'  => [
					'{{WRAPPER}} .topppa-pricing-wrapper .topppa-pricing-amount .topppa-pricing-amount-box span. , .topppa-pricing-wrapper.five .topppa-pricing-amount-box span' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();

		// <==========>
		// <==========> CONTENT LSIT STYLES <==========>

		$this->start_controls_section(
			'content_styles',
			[
				'label' => esc_html__('Content Box', 'topper-pack'),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_responsive_control(
			'content_gap',
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
					'{{WRAPPER}} .topppa-pricing-wrapper .topppa-pricing-content ul li' => 'gap: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'p_content_order',
			[
				'label' => esc_html__('Content', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'min' => 1,
				'max' => 10,
				'step' => 1,
				'description' => esc_html__('The higher number will place at the top of all items.', 'topper-pack'),
				'selectors' => [
					'{{WRAPPER}} .topppa-pricing-content ul' => 'order: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'p_conetnt_button_order',
			[
				'label' => esc_html__('Button', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'min' => 1,
				'max' => 10,
				'step' => 1,
				'selectors' => [
					'{{WRAPPER}} .topppa-pricing-content .topppa-btn-wrapper' => 'order: {{VALUE}};',
				],
			]
		);
		$this->add_responsive_control(
			'content_padding',
			[
				'label' => esc_html__('Padding', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em', 'rem', 'custom'],
				'selectors' => [
					'{{WRAPPER}} .topppa-pricing-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'content_margin',
			[
				'label' => esc_html__('Margin', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em', 'rem', 'custom'],
				'selectors' => [
					'{{WRAPPER}} .topppa-pricing-content' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'content_list',
			[
				'label' => esc_html__('Content List', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'content_border',
				'selector' => '{{WRAPPER}} .topppa-pricing-wrapper .topppa-pricing-content ul',
			]
		);
		$this->add_responsive_control(
			'content_border_radius',
			[
				'label' => esc_html__('Border Radius', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .topppa-pricing-wrapper .topppa-pricing-content ul' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'content_list_box_margin',
			[
				'label' => esc_html__('List Box Margin', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em', 'rem', 'custom'],
				'selectors' => [
					'{{WRAPPER}} .topppa-pricing-wrapper .topppa-pricing-content ul' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'content_list_box_padding',
			[
				'label' => esc_html__('List Box Padding', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em', 'rem', 'custom'],
				'selectors' => [
					'{{WRAPPER}} .topppa-pricing-wrapper .topppa-pricing-content ul' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'content_listitem_margin',
			[
				'label' => esc_html__('List Margin', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em', 'rem', 'custom'],
				'selectors' => [
					'{{WRAPPER}} .topppa-pricing-wrapper .topppa-pricing-content ul li' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'content_listitem_padding',
			[
				'label' => esc_html__('List Padding', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em', 'rem', 'custom'],
				'selectors' => [
					'{{WRAPPER}} .topppa-pricing-wrapper .topppa-pricing-content ul li' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->start_controls_tabs(
			'style_tabs'
		);

		$this->start_controls_tab(
			'style_normal_tab',
			[
				'label' => esc_html__('Icon', 'topper-pack'),
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'content_icon_typo',
				'selector' => '{{WRAPPER}} .topppa-pricing-wrapper .topppa-pricing-content ul li .pricing-list-icon',
			]
		);
		$this->add_responsive_control(
			'content_icon_color',
			[
				'label'     => esc_html__('Color', 'topper-pack'),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .topppa-pricing-wrapper .topppa-pricing-content ul li .pricing-list-icon' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_responsive_control(
			'disable_content_icon_color',
			[
				'label'     => esc_html__('Disable Color', 'topper-pack'),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .topppa-pricing-wrapper .topppa-pricing-content ul li .pricing-list-icon.disable' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_responsive_control(
			'content_icon_padding',
			[
				'label' => esc_html__('Padding', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em', 'rem', 'custom'],
				'selectors' => [
					'{{WRAPPER}} .topppa-pricing-wrapper .topppa-pricing-content ul li .pricing-list-icon' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'content_icon_margin',
			[
				'label' => esc_html__('Margin', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em', 'rem', 'custom'],
				'selectors' => [
					'{{WRAPPER}} .topppa-pricing-wrapper .topppa-pricing-content ul li .pricing-list-icon' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_tab();

		$this->start_controls_tab(
			'style_hover_tab',
			[
				'label' => esc_html__('Content', 'topper-pack'),
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'content_list_typo',
				'selector' => '{{WRAPPER}} .topppa-pricing-wrapper .topppa-pricing-content ul li .pricing-list-info',
			]
		);
		$this->add_responsive_control(
			'content_list_color',
			[
				'label'     => esc_html__('Color', 'topper-pack'),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .topppa-pricing-wrapper .topppa-pricing-content ul li .pricing-list-info' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_responsive_control(
			'disable_content_list_color',
			[
				'label'     => esc_html__('Disable Color', 'topper-pack'),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .topppa-pricing-wrapper .topppa-pricing-content ul li .pricing-list-info.disable' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_responsive_control(
			'content_list_padding',
			[
				'label' => esc_html__('Padding', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em', 'rem', 'custom'],
				'selectors' => [
					'{{WRAPPER}} .topppa-pricing-wrapper .topppa-pricing-content ul li .pricing-list-info' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'content_list_margin',
			[
				'label' => esc_html__('Margin', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em', 'rem', 'custom'],
				'selectors' => [
					'{{WRAPPER}} .topppa-pricing-wrapper .topppa-pricing-content ul li .pricing-list-info' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();

		// <========================> BUTTON STYLES <========================>
		$this->start_controls_section(
			'topppa_btn_style',
			[
				'label' => esc_html__('Button', 'topper-pack'),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'topppa_btn_icon_position',
			[
				'label' => esc_html__('Icon Position', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'options' => [
					'row' => [
						'title' => esc_html__('Left', 'topper-pack'),
						'icon' => 'eicon-h-align-left',
					],
					'row-reverse' => [
						'title' => esc_html__('Right', 'topper-pack'),
						'icon' => 'eicon-h-align-right',
					],
				],
				'default' => 'row',
				'toggle' => true,
				'selectors' => [
					'{{WRAPPER}} .pricing-btn-wrapper .topppa-btn' => 'flex-direction: {{VALUE}};',
				],
				'condition' => [
					'topppa_show_icon' => 'yes'
				]
			]
		);
		$this->add_responsive_control(
			'topppa_btn_width',
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
					'{{WRAPPER}} .topppa-pricing-content' => 'width: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .pricing-btn-wrapper .topppa-btn' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'topppa_btn_align',
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
					'{{WRAPPER}} .pricing-btn-wrapper .topppa-btn' => 'justify-content: {{VALUE}};',
				],
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
					'{{WRAPPER}} .pricing-btn-wrapper .topppa-btn' => 'gap: {{SIZE}}{{UNIT}};',
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
				'selector' => '{{WRAPPER}} .pricing-btn-wrapper .topppa-btn',
			]
		);

		$this->add_responsive_control(
			'topppa_btn_color',
			[
				'label'     => esc_html__('Color', 'topper-pack'),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .pricing-btn-wrapper .topppa-btn' => 'color: {{VALUE}}',
					'{{WRAPPER}} .pricing-btn-wrapper .topppa-btn span' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'topppa_btn_background',
				'types' => ['classic', 'gradient', 'video'],
				'selector' => '{{WRAPPER}} .pricing-btn-wrapper .topppa-btn',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name'     => 'topppa_btn_border',
				'label'    => esc_html__('Border', 'topper-pack'),
				'selector' => '{{WRAPPER}} .pricing-btn-wrapper .topppa-btn',
			]
		);

		$this->add_responsive_control(
			'topppa_btn_border_radius',
			[
				'label'      => esc_html__('Border Radius', 'topper-pack'),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors'  => [
					'{{WRAPPER}} .pricing-btn-wrapper .topppa-btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'topppa_btn_box_shadow',
				'label'    => esc_html__('Shadow', 'topper-pack'),
				'selector' => '{{WRAPPER}} .pricing-btn-wrapper .topppa-btn',
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
					'{{WRAPPER}} .pricing-btn-wrapper .topppa-btn .btn-icon' => 'width: {{SIZE}}{{UNIT}};',
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
					'{{WRAPPER}} .pricing-btn-wrapper .topppa-btn .btn-icon' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'topppa_btn_icon_content_typography',
				'selector' => '{{WRAPPER}} .pricing-btn-wrapper .topppa-btn .btn-icon',
			]
		);
		$this->add_responsive_control(
			'topppa_btn_icon_color',
			[
				'label' => esc_html__('Icon Color', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .topppa-btn-wrapper .topppa-btn .btn-icon' => 'color: {{VALUE}}',
				],
				'condition' => [
					'topppa_show_icon' => 'yes'
				]
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'topppa_btn_icon_bg',
				'types' => ['classic', 'gradient', 'video'],
				'selector' => '{{WRAPPER}} .pricing-btn-wrapper .topppa-btn .btn-icon',
			]
		);
		$this->add_responsive_control(
			'topppa_btn_icon_border_radius',
			[
				'label' => esc_html__('Border Radius', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .pricing-btn-wrapper .topppa-btn .btn-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'topppa_btn_margin',
			[
				'label'      => esc_html__('Margin', 'topper-pack'),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors'  => [
					'{{WRAPPER}} .pricing-btn-wrapper .topppa-btn' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'topppa_btn_padding',
			[
				'label'      => esc_html__('Padding', 'topper-pack'),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors'  => [
					'{{WRAPPER}} .pricing-btn-wrapper .topppa-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
				'selector' => '{{WRAPPER}} .pricing-btn-wrapper .topppa-btn:hover',
			]
		);

		$this->add_responsive_control(
			'topppa_btn_color_hover',
			[
				'label'     => esc_html__('Color', 'topper-pack'),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .pricing-btn-wrapper .topppa-btn:hover' => 'color: {{VALUE}}',
					'{{WRAPPER}} .pricing-btn-wrapper .topppa-btn:hover span' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'topppa_btn_background_hover',
				'types' => ['classic', 'gradient', 'video'],
				'selector' => '{{WRAPPER}} .pricing-btn-wrapper .topppa-btn:hover',
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
				'selector' => '{{WRAPPER}} .pricing-btn-wrapper .topppa-btn::before,{{WRAPPER}} .pricing-btn-wrapper .topppa-btn::after ',
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
				'selector' => '{{WRAPPER}} .pricing-btn-wrapper .topppa-btn:hover',
			]
		);

		$this->add_responsive_control(
			'topppa_btn_border_radius_hover',
			[
				'label'      => esc_html__('Border Radius', 'topper-pack'),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors'  => [
					'{{WRAPPER}} .pricing-btn-wrapper .topppa-btn:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'topppa_btn_box_shadow_hover',
				'label'    => esc_html__('Shadow', 'topper-pack'),
				'selector' => '{{WRAPPER}} .pricing-btn-wrapper .topppa-btn:hover',
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
			'topppa_btn_icon_hborder_radius',
			[
				'label' => esc_html__('Border Radius', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .pricing-btn-wrapper .topppa-btn:hover .btn-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'topppa_btn_icon_hbgcolor',
				'types' => ['classic', 'gradient', 'video'],
				'selector' => '{{WRAPPER}} .pricing-btn-wrapper .topppa-btn:hover .btn-icon',
				'condition' => [
					'topppa_btn_styles!' => 'style_eight'
				]
			]
		);
		$this->add_responsive_control(
			'topppa_btn_icon_hcolor',
			[
				'label' => esc_html__('Icon Color', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .pricing-btn-wrapper .topppa-btn:hover .btn-icon' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'topppa_btn_icon_hbgcolor1',
				'types' => ['classic', 'gradient', 'video'],
				'selector' => '{{WRAPPER}} .pricing-btn-wrapper .topppa-btn .btn-icon::before',
				'condition' => [
					'topppa_btn_styles' => 'style_eight',
					'topppa_show_icon' => 'yes'
				]
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'topppa_btn_icon_hbgcolor2',
				'label' => esc_html__('New Hover Background', 'topper-pack'),
				'types' => ['classic', 'gradient', 'video'],
				'selector' => '{{WRAPPER}} .pricing-btn-wrapper .topppa-btn:hover .btn-icon',
				'fields_options' => [
					'background' => [
						'label' => esc_html__('New Hover Background', 'topper-pack'),
					],
				],
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
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
			'a' => [
				'href' => [],
				'title' => [],
				'target' => [],
			],
			'br' => [],
			'strong' => [],
			'em' => [],
		];
		// multiple shadow
		if ('yes' === $settings['enable_double_shadow']) {

			$shadow1 = $settings['shadow1'];
			$shadow2 = $settings['shadow2'];

			$css_shadow1 = "{$shadow1['horizontal']}px {$shadow1['vertical']}px {$shadow1['blur']}px {$shadow1['spread']}px {$shadow1['color']}";
			$css_shadow2 = "{$shadow2['horizontal']}px {$shadow2['vertical']}px {$shadow2['blur']}px {$shadow2['spread']}px {$shadow2['color']}";

			$box_shadow = $css_shadow1 . ', ' . $css_shadow2;
		} else {
			$box_shadow = 'none';
		}

		$style_classes = [
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
		// Get the class name based on the selected style or fallback to an empty string.
		$class = isset($style_classes[$settings['topppa_styles']]) ? $style_classes[$settings['topppa_styles']] : '';
		$btn_class = isset($style_classes[$settings['topppa_btn_styles']]) ? $style_classes[$settings['topppa_btn_styles']] : '';
		$html_tag = isset($settings['html_tag']) ? $settings['html_tag'] : 'h3';
?>

		<?php if ($settings['topppa_styles'] !== 'style_five'): ?>
			<div class="topppa-pricing-wrapper <?php echo esc_attr($class); ?>" style="box-shadow: <?php echo esc_attr($box_shadow); ?>;">
				<div class="pricing-sidebox-one"></div>
				<div class="pricing-sidebox-two"></div>
				<div class="topppa-pricing-box">

					<div class="topppa-pricing-amount">

						<?php if ($settings['icon_box_options'] === 'icon') : ?>
							<div class="pricing-icon">
								<?php \Elementor\Icons_Manager::render_icon($settings['icon_box_icons'], ['aria-hidden' => 'true']); ?>
							</div>
						<?php endif; ?>

						<?php if ($settings['icon_box_options'] === 'image') : ?>
							<div class="pricing-image">
								<?php echo wp_get_attachment_image($settings['icon_box_image']['id'], 'full'); ?>
							</div>
						<?php endif; ?>

						<?php if ($settings['title']) : ?>
							<<?php echo esc_attr($settings['title_tag']); ?> class="topppa-price-title"><?php echo esc_html($settings['title']); ?></<?php echo esc_attr($settings['title_tag']); ?>>
						<?php endif; ?>

						<?php if ('yes' === $settings['enable_small_title']) : ?>
							<div class="pricing-small-title">
								<?php echo esc_html($settings['small_title']); ?>
							</div>
						<?php endif; ?>

						<div class="topppa-pricing-amount-box">
							<?php if (!empty($settings['price'])) : ?>
								<div class="topppa-table-price"><?php echo esc_html($settings['price']); ?></div>
							<?php endif; ?>
							<?php if (!empty($settings['price_label'])) {
								echo '<span>' . wp_kses($settings['price_label'], $allowed_html) . '</span>';
							} ?>

						</div>
					</div>

					<div class="topppa-pricing-content">
						<?php if ($settings['enable_content'] === 'yes') : ?>
							<?php if (!empty($settings['lists'])) : ?>
								<ul>
									<?php foreach ($settings['lists'] as $list) : ?>
										<li>
											<?php if (!empty($list['icon'])) : ?>
												<div class="pricing-list-icon <?php echo esc_attr($list['disable_offer'] === 'yes' ? 'disable' : ''); ?>"><?php \Elementor\Icons_Manager::render_icon($list['icon'], ['aria-hidden' => 'true']); ?></div>
											<?php endif; ?>
											<div class="pricing-list-info <?php echo esc_attr($list['disable_offer'] === 'yes' ? 'disable' : ''); ?>">
												<?php echo wp_kses($list['content'], $allowed_html); ?>
											</div>
										</li>
									<?php endforeach; ?>
								</ul>
							<?php endif; ?>
						<?php endif; ?>

						<div class="topppa-btn-wrapper pricing-btn-wrapper <?php echo esc_attr($btn_class); ?>">
							<?php if (!empty($settings['topppa_btn_link']['url'])) {
								$this->add_link_attributes('topppa_btn_link', $settings['topppa_btn_link']);
							} ?>
							<a <?php echo $this->get_render_attribute_string('topppa_btn_link'); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- Already escaped by elementor 
								?> class="topppa-btn">

								<span class="top-btn-text top-btn-text-v3 "><?php echo esc_html($settings['topppa_btn_text']) ?></span>
								<?php if ($btn_class === 'style-three') : ?>
									<span class="bottom-btn-text bottom-btn-text-v3"><?php echo esc_html($settings['topppa_btn_text']) ?></span>
								<?php endif; ?>

								<?php if ($settings['topppa_show_icon'] == 'yes') : ?>
									<div class="btn-icon">
										<?php if (!empty($settings['topppa_btn_icon'])) : ?>
											<?php \Elementor\Icons_Manager::render_icon($settings['topppa_btn_icon'], ['aria-hidden' => 'true']); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- Already escaped by elementor 
											?>
										<?php endif; ?>
									</div>
								<?php endif; ?>
							</a>
						</div>
					</div>
				</div>
			</div>

			<!-- STYLE FIVE -->
		<?php else : ?>

			<div class="topppa-pricing-wrapper five" style="box-shadow: <?php echo esc_attr($box_shadow); ?>;">
				<div class="pricing-sidebox-one"></div>
				<div class="pricing-sidebox-two"></div>
				<div class="topppa-pricing-box">

					<div class="topppa-pricing-amount">

						<?php if ($settings['icon_box_options'] === 'icon') : ?>
							<div class="pricing-icon">
								<?php \Elementor\Icons_Manager::render_icon($settings['icon_box_icons'], ['aria-hidden' => 'true']); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- Already escaped by elementor 
								?>
							</div>
						<?php endif; ?>

						<?php if ($settings['icon_box_options'] === 'image') : ?>
							<div class="pricing-image">
								<?php echo wp_get_attachment_image($settings['icon_box_image']['id'], 'full'); ?>
							</div>
						<?php endif; ?>

						<?php if ($settings['title']) : ?>
							<<?php echo esc_attr($settings['title_tag']); ?> class="topppa-price-title"><?php echo esc_html($settings['title']); ?></<?php echo esc_attr($settings['title_tag']); ?>>
						<?php endif; ?>

					</div>

					<div class="topppa-pricing-content">
						<?php if ($settings['enable_content'] === 'yes') : ?>
							<?php if (!empty($settings['lists'])) : ?>
								<ul>
									<?php foreach ($settings['lists'] as $list) : ?>
										<li>
											<?php if (!empty($list['icon'])) : ?>
												<div class="pricing-list-icon <?php echo esc_attr($list['disable_offer'] === 'yes' ? 'disable' : ''); ?>"><?php \Elementor\Icons_Manager::render_icon($list['icon'], ['aria-hidden' => 'true']); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- Already escaped by elementor 
																																							?></div>
											<?php endif; ?>
											<div class="pricing-list-info <?php echo esc_attr($list['disable_offer'] === 'yes' ? 'disable' : ''); ?>">
												<?php echo wp_kses($list['content'], $allowed_html); ?>
											</div>
										</li>
									<?php endforeach; ?>
								</ul>
							<?php endif; ?>
						<?php endif; ?>

						<div class="pricing-package">
							<div class="topppa-pricing-amount-box">
								<?php if (!empty($settings['price'])) : ?>
									<div class="topppa-table-price"><?php echo esc_html($settings['price']); ?></div>
								<?php endif; ?>
								<?php if (!empty($settings['price_label'])) {
									echo '<span>' . wp_kses($settings['price_label'], $allowed_html) . '</span>';
								} ?>

							</div>
							<?php if ('yes' === $settings['enable_small_title']) : ?>
								<div class="pricing-small-title">
									<?php echo esc_html($settings['small_title']); ?>
								</div>
							<?php endif; ?>
						</div>

						<div class="topppa-btn-wrapper pricing-btn-wrapper <?php echo esc_attr($btn_class); ?>">
							<?php if (!empty($settings['topppa_btn_link']['url'])) {
								$this->add_link_attributes('topppa_btn_link', $settings['topppa_btn_link']);
							} ?>
							<a <?php echo $this->get_render_attribute_string('topppa_btn_link'); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- Already escaped by elementor 
								?> class="topppa-btn">

								<span class="top-btn-text top-btn-text-v3 "><?php echo esc_html($settings['topppa_btn_text']) ?></span>
								<?php if ($btn_class === 'style-three') : ?>
									<span class="bottom-btn-text bottom-btn-text-v3"><?php echo esc_html($settings['topppa_btn_text']) ?></span>
								<?php endif; ?>

								<?php if ($settings['topppa_show_icon'] == 'yes') : ?>
									<div class="btn-icon">
										<?php if (!empty($settings['topppa_btn_icon'])) : ?>
											<?php \Elementor\Icons_Manager::render_icon($settings['topppa_btn_icon'], ['aria-hidden' => 'true']); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- Already escaped by elementor 
											?>
										<?php endif; ?>
									</div>
								<?php endif; ?>
							</a>
						</div>
					</div>
				</div>
			</div>
		<?php endif; ?>
<?php
	}
}
