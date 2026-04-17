<?php

use \TopperPack\Includes\Controls\Controls_Manager as TopperPack_Controls_Manager;
use Elementor\Controls_Manager;

if (! defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}

/**
 * Elementor Counter Info Widget.
 *
 * Elementor widget that inserts an embbedable content into the page, from any given URL.
 *
 * @since 1.0.0
 */
class TOPPPA_Trade_Coin_Widget extends \Elementor\Widget_Base {

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
		return 'topppa_trade_coin';
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
		return TOPPPA_EPWB . esc_html__('Trade Coin', 'topper-pack');
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
		return 'eicon-sort-amount-desc';
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
		return ['topppa', 'widget', 'trade', 'coin', 'topperpack'];
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
		return 'https://doc.topperpack.com/docs/trade-widgets/trade-coin/';
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
		// <========================>
		// <========================> TOPPPA COUNTER STYLES <========================>

		$this->start_controls_section(
			'topppa_trade_coin_content',
			[
				'label' => esc_html__('Trade Content', 'topper-pack'),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'enable_bar_animation',
			[
				'label' => esc_html__('Enable Bar Animation', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Show', 'topper-pack'),
				'label_off' => esc_html__('Hide', 'topper-pack'),
				'return_value' => 'yes',
				'default' => 'yes',
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
			'coin_name',
			[
				'label'       => esc_html__('Coin Name', 'topper-pack'),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'default'     => esc_html__('BTC Coin', 'topper-pack'),
				'label_block' => true,
			]
		);

		$this->add_control(
			'coin_amount_prefix',
			[
				'label'       => esc_html__('Amount Prefix', 'topper-pack'),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'default'     => '$',
				'label_block' => true,
				'placeholder' => esc_html__('e.g., $, €, ₹', 'topper-pack'),
			]
		);

		$this->add_control(
			'coin_amount',
			[
				'label'       => esc_html__('Coin Amount', 'topper-pack'),
				'type'        => \Elementor\Controls_Manager::NUMBER,
				'default'     => 500,
				'label_block' => true,
			]
		);

		$this->add_control(
			'coin_amount_suffix',
			[
				'label'       => esc_html__('Amount Suffix', 'topper-pack'),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'default'     => 'M',
				'label_block' => true,
				'placeholder' => esc_html__('e.g., M, K, B', 'topper-pack'),
			]
		);
		$this->add_control(
			'percent',
			[
				'label' => __('Percentage', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['%'],
				'range' => [
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default' => [
					'unit' => '%',
					'size' => 80,
				],
				'condition' => [
					'enable_bar_animation' => 'yes'
				]
			]
		);

		$this->add_control(
			'coin_description',
			[
				'label' => esc_html__('Description', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::WYSIWYG,
				'default' => esc_html__('Coin real-time price, % change, chart sparkline', 'topper-pack'),
				'label_block' => true,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'enable_button',
			[
				'label' => esc_html__('Enable Button', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Show', 'topper-pack'),
				'label_off' => esc_html__('Hide', 'topper-pack'),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->add_control(
			'enable_btn_icon',
			[
				'label' => esc_html__('Show Icon', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Show', 'topper-pack'),
				'label_off' => esc_html__('Hide', 'topper-pack'),
				'return_value' => 'yes',
				'default' => 'no',
				'condition'     => [
					'enable_button' => 'yes',
				]
			]
		);
		$this->add_control(
			'topppa_btn_icon',
			[
				'label' => esc_html__('Button Icon', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::ICONS,
				'default' => [
					'value' => '',
					'library' => 'fa-solid',
				],
				'condition' => [
					'enable_button' => 'yes',
					'enable_btn_icon' => 'yes',
				],
			]
		);
		$this->add_control(
			'btn_text',
			[
				'label'       => esc_html__('Button Text', 'topper-pack'),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'default'     => esc_html__('Trade Now', 'topper-pack'),
				'label_block' => true,
				'condition'     => [
					'enable_button' => 'yes',
				]
			]
		);
		$this->add_control(
			'btn_link',
			[
				'label'         => __('Link', 'topper-pack'),
				'type'          => \Elementor\Controls_Manager::URL,
				'placeholder'   => __('https://your-link.com', 'topper-pack'),
				'show_external' => true,
				'default'       => [
					'url'         => '',
					'is_external' => true,
					'nofollow'    => true,
				],
				'dynamic'       => [
					'active' => true,
				],
				'condition'     => [
					'enable_button' => 'yes',
				],
			]
		);

		$this->add_control(
			'enable_button_two',
			[
				'label' => esc_html__('Enable Button Two', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Show', 'topper-pack'),
				'label_off' => esc_html__('Hide', 'topper-pack'),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->add_control(
			'enable_btn_two_icon',
			[
				'label' => esc_html__('Show Icon', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Show', 'topper-pack'),
				'label_off' => esc_html__('Hide', 'topper-pack'),
				'return_value' => 'yes',
				'default' => 'no',
				'condition'     => [
					'enable_button_two' => 'yes',
				]
			]
		);
		$this->add_control(
			'topppa_btn_two_icon',
			[
				'label' => esc_html__('Button Two Icon', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::ICONS,
				'default' => [
					'value' => '',
					'library' => 'fa-solid',
				],
				'condition' => [
					'enable_button_two' => 'yes',
					'enable_btn_two_icon' => 'yes',
				],
			]
		);
		$this->add_control(
			'btn_two_text',
			[
				'label'       => esc_html__('Button Text', 'topper-pack'),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'default'     => esc_html__('Market', 'topper-pack'),
				'label_block' => true,
				'condition'     => [
					'enable_button_two' => 'yes',
				]
			]
		);
		$this->add_control(
			'btn_two_link',
			[
				'label'         => __('Link', 'topper-pack'),
				'type'          => \Elementor\Controls_Manager::URL,
				'placeholder'   => __('https://your-link.com', 'topper-pack'),
				'show_external' => true,
				'default'       => [
					'url'         => '',
					'is_external' => true,
					'nofollow'    => true,
				],
				'dynamic'       => [
					'active' => true,
				],
				'condition'     => [
					'enable_button_two' => 'yes',
				],
			]
		);

		$this->end_controls_section();

		// <==========>
		// <==========> BOX STYLES <==========>

		$this->start_controls_section(
			'box_styles',
			[
				'label' => esc_html__('Box', 'topper-pack'),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'box_bg',
				'label' => esc_html__('Background', 'topper-pack'),
				'types' => ['classic', 'gradient', 'video'],
				'selector' => '{{WRAPPER}} .trade-coin-box',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'box_border',
				'label' => esc_html__('Border', 'topper-pack'),
				'selector' => '{{WRAPPER}} .trade-coin-box',
			]
		);
		$this->add_responsive_control(
			'box_radius',
			[
				'label' => esc_html__('Border Radius', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .trade-coin-box' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'box_shadow',
				'label' => esc_html__('Box Shadow', 'topper-pack'),
				'selector' => '{{WRAPPER}} .trade-coin-box',
			]
		);
		$this->add_responsive_control(
			'box_margin',
			[
				'label' => esc_html__('Margin', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .trade-coin-box' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .trade-coin-box' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();

		// <==========>
		// <==========> CONTENT STYLES <==========>
		$this->start_controls_section(
			'content_style_tab_start',
			[
				'label' => esc_html__('Content', 'topper-pack'),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		$this->start_controls_tabs(
			'content_style_tabs'
		);

		$this->start_controls_tab(
			'style_icon_tab',
			[
				'label' => esc_html__('Icon', 'topper-pack'),
			]
		);
		$this->add_responsive_control(
			'trade_icon_height',
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
					'{{WRAPPER}} .trade-coin-box .trade-coin-wrapper .coin-name-icon' => 'height: {{SIZE}}{{UNIT}};',
				],
			],
		);
		$this->add_responsive_control(
			'trade_icon_width',
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
					'{{WRAPPER}} .trade-coin-box .trade-coin-wrapper .coin-name-icon' => 'width: {{SIZE}}{{UNIT}};',
				],
			],
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'trade_icon_typo',
				'selector' => '{{WRAPPER}} .trade-coin-box .trade-coin-wrapper .coin-name-icon',
			],
		);
		$this->add_responsive_control(
			'trade_icon_color',
			[
				'label'     => esc_html__('Icon Color', 'topper-pack'),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .trade-coin-box .trade-coin-wrapper .coin-name-icon' => 'color: {{VALUE}}',
				],
			],
		);
		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'trade_icon_bg',
				'types' => ['classic', 'gradient', 'video'],
				'selector' => '{{WRAPPER}} .trade-coin-box .trade-coin-wrapper .coin-name-icon',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name'     => 'trade_icon_border',
				'label'    => esc_html__('Border', 'topper-pack'),
				'selector' => '{{WRAPPER}} .trade-coin-box .trade-coin-wrapper .coin-name-icon',
			],
		);
		$this->add_responsive_control(
			'trade_icon_border_radius',
			[
				'label'      => esc_html__('Border Radius', 'topper-pack'),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors'  => [
					'{{WRAPPER}} .trade-coin-box .trade-coin-wrapper .coin-name-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			],
		);
		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'trade_icon_shadow',
				'selector' => '{{WRAPPER}} .trade-coin-box .trade-coin-wrapper .coin-name-icon',
			],
		);
		$this->end_controls_tab();

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
				'selector' => '{{WRAPPER}} .trade-coin-box .trade-coin-wrapper .coin-name',
			]
		);
		$this->add_responsive_control(
			'title_color',
			[
				'label'     => esc_html__('Color', 'topper-pack'),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .trade-coin-box .trade-coin-wrapper .coin-name' => 'color: {{VALUE}}',
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
					'{{WRAPPER}} .trade-coin-box .trade-coin-wrapper .coin-name' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .trade-coin-box .trade-coin-wrapper .coin-name' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();

		// <==========>
		// <==========> AMOUNT STYLES <==========>

		$this->start_controls_section(
			'amount_styles',
			[
				'label' => esc_html__('Amount', 'topper-pack'),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'amount_typo',
				'selector' => '{{WRAPPER}} .trade-coin-box .coin-amount-wrapper .amount',
			]
		);
		$this->add_responsive_control(
			'amount_color',
			[
				'label'     => esc_html__('Color', 'topper-pack'),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .trade-coin-box .coin-amount-wrapper .amount' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_responsive_control(
			'amount_margin',
			[
				'label'      => esc_html__('Margin', 'topper-pack'),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors'  => [
					'{{WRAPPER}} .trade-coin-box .coin-amount-wrapper .amount' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'amount_padding',
			[
				'label'      => esc_html__('Padding', 'topper-pack'),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors'  => [
					'{{WRAPPER}} .trade-coin-box .coin-amount-wrapper .amount' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();

		// <==========>
		// <==========> DESCRIPTION STYLES <==========>

		$this->start_controls_section(
			'description_styles',
			[
				'label' => esc_html__('Description', 'topper-pack'),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'description_typo',
				'selector' => '{{WRAPPER}} .trade-coin-box .description',
			]
		);
		$this->add_responsive_control(
			'description_color',
			[
				'label'     => esc_html__('Color', 'topper-pack'),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .trade-coin-box .description' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_responsive_control(
			'description_margin',
			[
				'label'      => esc_html__('Margin', 'topper-pack'),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors'  => [
					'{{WRAPPER}} .trade-coin-box .description' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'description_padding',
			[
				'label'      => esc_html__('Padding', 'topper-pack'),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors'  => [
					'{{WRAPPER}} .trade-coin-box .description' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();

		// <==========>
		// <==========> IMAGE STYLES <==========>

		$this->start_controls_section(
			'trade_img_style',
			[
				'label' => esc_html__('Image', 'topper-pack'),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
				'condition' => [
					'icon_box_options' => 'image'
				]
			]
		);
		$this->add_responsive_control(
			'trade_img_height',
			[
				'label'      => esc_html__('Height', 'topper-pack'),
				'type'       => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px', '%', 'custom'],
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
				'selectors'  => [
					'{{WRAPPER}} .trade-coin-box .box-icon-wrapper img' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'trade_img_width',
			[
				'label'      => esc_html__('Width', 'topper-pack'),
				'type'       => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px', '%', 'custom'],
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
				'selectors'  => [
					'{{WRAPPER}} .trade-coin-box .box-icon-wrapper img' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'trade_img_object',
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
					'{{WRAPPER}} .trade-coin-box .box-icon-wrapper img' => 'object-fit: {{VALUE}}',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name'     => 'trade_img_border',
				'label'    => esc_html__('Border', 'topper-pack'),
				'selector' => '{{WRAPPER}} .trade-coin-box .box-icon-wrapper img',
			]
		);
		$this->add_responsive_control(
			'trade_img_border_radius',
			[
				'label'      => esc_html__('Border Radius', 'topper-pack'),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors'  => [
					'{{WRAPPER}} .trade-coin-box .box-icon-wrapper img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'trade_img_shadow',
				'selector' => '{{WRAPPER}} .trade-coin-box .coin-amount-wrapper .amount',
			]
		);
		$this->add_responsive_control(
			'trade_img_margin',
			[
				'label'      => esc_html__('Margin', 'topper-pack'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors'  => [
					'{{WRAPPER}} .trade-coin-box .box-icon-wrapper img' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'trade_img_padding',
			[
				'label'      => esc_html__('Padding', 'topper-pack'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors'  => [
					'{{WRAPPER}} .trade-coin-box .box-icon-wrapper img' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();

		// <==========>
		// <==========> BAR STYLES <==========>

		$this->start_controls_section(
			'bar_box_css',
			[
				'label' => esc_html__('Bar', 'topper-pack'),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'bar_height_box',
			[
				'label' => esc_html__('Box Height', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SLIDER,
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
				'selectors' => [
					'{{WRAPPER}} .trade-coin-box .coin-amount-wrapper .static-bar-wrapper .static-bar' => 'height: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .trade-coin-box .coin-amount-wrapper .static-bar-wrapper .static-bar-active' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'bar_bg',
				'label' => esc_html__('Background', 'topper-pack'),
				'types' => ['classic', 'gradient', 'video'],
				'selector' => '{{WRAPPER}} .trade-coin-box .coin-amount-wrapper .skillbar, {{WRAPPER}} .trade-coin-box .coin-amount-wrapper .static-bar-wrapper .static-bar',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'bar_shadow',
				'label' => esc_html__('Box Shadow', 'topper-pack'),
				'selector' => '{{WRAPPER}} .trade-coin-box .coin-amount-wrapper .skillbar , {{WRAPPER}} .trade-coin-box .coin-amount-wrapper .static-bar-wrapper .static-bar',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'bar_border',
				'label' => esc_html__('Border', 'topper-pack'),
				'selector' => '{{WRAPPER}} .trade-coin-box .coin-amount-wrapper .skillbar , {{WRAPPER}} .trade-coin-box .coin-amount-wrapper .static-bar-wrapper .static-bar',
			]
		);
		$this->add_control(
			'inner_bar',
			[
				'label' => esc_html__('Inner Progress Bar', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'bar_color',
				'label' => esc_html__('Inner Box Color', 'topper-pack'),
				'types' => ['classic', 'gradient', 'video'],
				'selector' => '{{WRAPPER}} .trade-coin-box .coin-amount-wrapper .skillbar .count-bar, {{WRAPPER}} .trade-coin-box .coin-amount-wrapper .static-bar-wrapper .static-bar-active',
				'fields_options' => [
					'background' => [
						'label' => esc_html__('Background', 'topper-pack'),
						'default' => 'classic',
					],
				],
			]
		);
		$this->add_responsive_control(
			'bar_border_radius',
			[
				'label'      => esc_html__('Border Radius', 'topper-pack'),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'separator' => 'before',
				'selectors'  => [
					'{{WRAPPER}} .trade-coin-box .coin-amount-wrapper .skillbar .count-bar' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .trade-coin-box .coin-amount-wrapper .skillbar' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .trade-coin-box .coin-amount-wrapper .static-bar-wrapper .static-bar-active' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'bar_margin',
			[
				'label' => esc_html__('Margin', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .trade-coin-box .coin-amount-wrapper .skillbar' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .trade-coin-box .coin-amount-wrapper .static-bar-wrapper .static-bar-active' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'bar_padding',
			[
				'label' => esc_html__('Padding', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .trade-coin-box .coin-amount-wrapper .skillbar' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .trade-coin-box .coin-amount-wrapper .static-bar-wrapper .static-bar-active' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();

		// Button Style Section
		$this->start_controls_section(
			'topppa_btn_style',
			[
				'label' => esc_html__('Button', 'topper-pack'),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_responsive_control(
			'button_flex_direction',
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
					'{{WRAPPER}} .trade-coin-box .btn-wrapper' => 'flex-direction: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'button_row_align_items',
			[
				'label' => esc_html__('Align Items', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'options' => [
					'flex-start' => [
						'title' => esc_html__('Start', 'topper-pack'),
						'icon' => 'eicon-h-align-left',
					],
					'center' => [
						'title' => esc_html__('Center', 'topper-pack'),
						'icon' => 'eicon-h-align-center',
					],
					'flex-end' => [
						'title' => esc_html__('End', 'topper-pack'),
						'icon' => 'eicon-h-align-right',
					],
				],
				'default' => '',
				'toggle' => true,
				'label_block' => true,
				'selectors' => [
					'{{WRAPPER}} .trade-coin-box .btn-wrapper' => 'align-items: {{VALUE}};',
				],
			]
		);
		$this->add_responsive_control(
			'btn_gap',
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
				'default' => [
					'unit' => 'px',
					'size' => 10,
				],
				'selectors' => [
					'{{WRAPPER}} .trade-coin-box .btn-wrapper' => 'gap: {{SIZE}}{{UNIT}};',
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
					'{{WRAPPER}} .trade-coin-box .topppa-btn-wrapper .btn-one .topppa-btn' => 'gap: {{SIZE}}{{UNIT}};',
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
				'selector' => '{{WRAPPER}} .trade-coin-box .topppa-btn-wrapper .btn-one .topppa-btn',
			]
		);

		$this->add_responsive_control(
			'topppa_btn_color',
			[
				'label'     => esc_html__('Color', 'topper-pack'),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .trade-coin-box .topppa-btn-wrapper .btn-one .topppa-btn' => 'color: {{VALUE}}',
					'{{WRAPPER}} .trade-coin-box .topppa-btn-wrapper .btn-one .topppa-btn span' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'topppa_btn_background',
				'types' => ['classic', 'gradient', 'video'],
				'selector' => '{{WRAPPER}} .trade-coin-box .topppa-btn-wrapper .btn-one .topppa-btn',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name'     => 'topppa_btn_border',
				'label'    => esc_html__('Border', 'topper-pack'),
				'selector' => '{{WRAPPER}} .trade-coin-box .topppa-btn-wrapper .btn-one .topppa-btn',
			]
		);

		$this->add_responsive_control(
			'topppa_btn_border_radius',
			[
				'label'      => esc_html__('Border Radius', 'topper-pack'),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors'  => [
					'{{WRAPPER}} .trade-coin-box .topppa-btn-wrapper .btn-one .topppa-btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'topppa_btn_box_shadow',
				'label'    => esc_html__('Shadow', 'topper-pack'),
				'selector' => '{{WRAPPER}} .trade-coin-box .topppa-btn-wrapper .btn-one .topppa-btn',
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
					'{{WRAPPER}} .trade-coin-box .topppa-btn-wrapper .btn-one .topppa-btn .btn-icon' => 'width: {{SIZE}}{{UNIT}};',
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
					'{{WRAPPER}} .trade-coin-box .topppa-btn-wrapper .btn-one .topppa-btn .btn-icon' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'topppa_btn_icon_content_typography',
				'selector' => '{{WRAPPER}} .trade-coin-box .topppa-btn-wrapper .btn-one .topppa-btn .btn-icon',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'topppa_btn_icon_bg',
				'types' => ['classic', 'gradient', 'video'],
				'selector' => '{{WRAPPER}} .trade-coin-box .topppa-btn-wrapper .btn-one .topppa-btn .btn-icon',
			]
		);
		$this->add_responsive_control(
			'topppa_btn_icon_border_radius',
			[
				'label' => esc_html__('Border Radius', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .trade-coin-box .topppa-btn-wrapper .btn-one .topppa-btn .btn-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .trade-coin-box .topppa-btn-wrapper .btn-one .topppa-btn' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .trade-coin-box .topppa-btn-wrapper .btn-one .topppa-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
				'selector' => '{{WRAPPER}} .trade-coin-box .topppa-btn-wrapper .btn-one .topppa-btn:hover',
			]
		);

		$this->add_responsive_control(
			'topppa_btn_color_hover',
			[
				'label'     => esc_html__('Color', 'topper-pack'),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .trade-coin-box .topppa-btn-wrapper .btn-one .topppa-btn:hover' => 'color: {{VALUE}}',
					'{{WRAPPER}} .trade-coin-box .topppa-btn-wrapper .btn-one .topppa-btn:hover span' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'topppa_btn_background_hover',
				'types' => ['classic', 'gradient', 'video'],
				'selector' => '{{WRAPPER}} .trade-coin-box .topppa-btn-wrapper .btn-one .topppa-btn:hover',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name'     => 'topppa_btn_border_hover',
				'label'    => esc_html__('Border', 'topper-pack'),
				'selector' => '{{WRAPPER}} .trade-coin-box .topppa-btn-wrapper .btn-one .topppa-btn:hover',
			]
		);

		$this->add_responsive_control(
			'topppa_btn_border_radius_hover',
			[
				'label'      => esc_html__('Border Radius', 'topper-pack'),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors'  => [
					'{{WRAPPER}} .trade-coin-box .topppa-btn-wrapper .btn-one .topppa-btn:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'topppa_btn_box_shadow_hover',
				'label'    => esc_html__('Shadow', 'topper-pack'),
				'selector' => '{{WRAPPER}} .trade-coin-box .topppa-btn-wrapper .btn-one .topppa-btn:hover',
			]
		);

		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();

		// Button Two Style Section
		$this->start_controls_section(
			'topppa_btn_style_two',
			[
				'label' => esc_html__('Button Two', 'topper-pack'),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'topppa_btn_two_icon_gap',
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
					'{{WRAPPER}} .trade-coin-box .topppa-btn-wrapper .btn-two .topppa-btn' => 'gap: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'topppa_show_icon' => 'yes'
				]
			]
		);

		$this->start_controls_tabs(
			'topppa_btn_two_content_tabs'
		);

		$this->start_controls_tab(
			'topppa_btn_two_normal',
			[
				'label' => __('Normal', 'topper-pack'),
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'topppa_btn_two_typo',
				'selector' => '{{WRAPPER}} .trade-coin-box .topppa-btn-wrapper .btn-two .topppa-btn',
			]
		);

		$this->add_responsive_control(
			'topppa_btn_two_color',
			[
				'label'     => esc_html__('Color', 'topper-pack'),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .trade-coin-box .topppa-btn-wrapper .btn-two .topppa-btn' => 'color: {{VALUE}}',
					'{{WRAPPER}} .trade-coin-box .topppa-btn-wrapper .btn-two .topppa-btn span' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'topppa_btn_two_background',
				'types' => ['classic', 'gradient', 'video'],
				'selector' => '{{WRAPPER}} .trade-coin-box .topppa-btn-wrapper .btn-two .topppa-btn',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name'     => 'topppa_btn_two_border',
				'label'    => esc_html__('Border', 'topper-pack'),
				'selector' => '{{WRAPPER}} .trade-coin-box .topppa-btn-wrapper .btn-two .topppa-btn',
			]
		);

		$this->add_responsive_control(
			'topppa_btn_two_border_radius',
			[
				'label'      => esc_html__('Border Radius', 'topper-pack'),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors'  => [
					'{{WRAPPER}} .trade-coin-box .topppa-btn-wrapper .btn-two .topppa-btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'topppa_btn_two_box_shadow',
				'label'    => esc_html__('Shadow', 'topper-pack'),
				'selector' => '{{WRAPPER}} .trade-coin-box .topppa-btn-wrapper .btn-two .topppa-btn',
			]
		);

		$this->add_control(
			'topppa_btn_two_icon_styles',
			[
				'label' => esc_html__('Icon Styles', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'topppa_btn_two_icon_width',
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
					'{{WRAPPER}} .trade-coin-box .topppa-btn-wrapper .btn-two .topppa-btn .btn-icon' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'topppa_btn_two_icon_height',
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
					'{{WRAPPER}} .trade-coin-box .topppa-btn-wrapper .btn-two .topppa-btn .btn-icon' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'topppa_btn_two_icon_content_typography',
				'selector' => '{{WRAPPER}} .trade-coin-box .topppa-btn-wrapper .btn-two .topppa-btn .btn-icon',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'topppa_btn_icon_two_bg',
				'types' => ['classic', 'gradient', 'video'],
				'selector' => '{{WRAPPER}} .trade-coin-box .topppa-btn-wrapper .btn-two .topppa-btn .btn-icon',
			]
		);
		$this->add_responsive_control(
			'topppa_btn_two_icon_border_radius',
			[
				'label' => esc_html__('Border Radius', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .trade-coin-box .topppa-btn-wrapper .btn-two .topppa-btn .btn-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'topppa_btn_two_margin',
			[
				'label'      => esc_html__('Margin', 'topper-pack'),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors'  => [
					'{{WRAPPER}} .trade-coin-box .topppa-btn-wrapper .btn-two .topppa-btn' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'topppa_btn_two_padding',
			[
				'label'      => esc_html__('Padding', 'topper-pack'),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors'  => [
					'{{WRAPPER}} .trade-coin-box .topppa-btn-wrapper .btn-two .topppa-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'topppa_btn_two_hover',
			[
				'label' => __('Hover', 'topper-pack'),
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'topppa_btn_two_typography_hover',
				'selector' => '{{WRAPPER}} .trade-coin-box .topppa-btn-wrapper .btn-two .topppa-btn:hover',
			]
		);

		$this->add_responsive_control(
			'topppa_btn_two_color_hover',
			[
				'label'     => esc_html__('Color', 'topper-pack'),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .trade-coin-box .topppa-btn-wrapper .btn-two .topppa-btn:hover' => 'color: {{VALUE}}',
					'{{WRAPPER}} .trade-coin-box .topppa-btn-wrapper .btn-two .topppa-btn:hover span' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'topppa_btn_two_background_hover',
				'types' => ['classic', 'gradient', 'video'],
				'selector' => '{{WRAPPER}} .trade-coin-box .topppa-btn-wrapper .btn-two .topppa-btn:hover',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name'     => 'topppa_btn_two_border_hover',
				'label'    => esc_html__('Border', 'topper-pack'),
				'selector' => '{{WRAPPER}} .trade-coin-box .topppa-btn-wrapper .btn-two .topppa-btn:hover',
			]
		);

		$this->add_responsive_control(
			'topppa_btn_two_border_radius_hover',
			[
				'label'      => esc_html__('Border Radius', 'topper-pack'),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors'  => [
					'{{WRAPPER}} .trade-coin-box .topppa-btn-wrapper .btn-two .topppa-btn:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'topppa_btn_two_box_shadow_hover',
				'label'    => esc_html__('Shadow', 'topper-pack'),
				'selector' => '{{WRAPPER}} .trade-coin-box .topppa-btn-wrapper .btn-two .topppa-btn:hover',
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
			'a'      => ['href' => []],
			'br'     => [],
			'em'     => [],
			'strong' => [],
		];
?>
		<div class="trade-coin-wrapper">
			<div class="row">
				<div>
					<div class="trade-coin-box">
						<div class="trade-coin-wrapper">
							<div class="coin-name-icon">
								<?php if ($settings['icon_box_options'] !== 'none'): ?>
									<div class="box-icon-wrapper">
										<?php if ($settings['icon_box_options'] == 'icon') : ?>
											<div class="box-icon">
												<?php \Elementor\Icons_Manager::render_icon($settings['icon_box_icons'], ['aria-hidden' => 'true']); ?>
											</div>
										<?php endif; ?>
										<?php if (! empty($settings['icon_box_image']) && $settings['icon_box_options'] === 'image') : ?>
											<?php echo wp_get_attachment_image($settings['icon_box_image']['id'], 'thumbnail'); ?>
										<?php endif; ?>
									</div>
								<?php endif; ?>
							</div>
							<div class="coin-name">
								<?php echo esc_html($settings['coin_name']); ?>
							</div>
						</div>
						<div class="coin-amount-wrapper">
							<div class="amount">
								<?php
								$coin_amount = is_numeric($settings['coin_amount']) ? floatval($settings['coin_amount']) : 0;
								$prefix = !empty($settings['coin_amount_prefix']) ? $settings['coin_amount_prefix'] : '';
								$suffix = !empty($settings['coin_amount_suffix']) ? $settings['coin_amount_suffix'] : '';
								?>
								<span class="coin-amount-count"
									data-amount="<?php echo esc_attr($coin_amount); ?>"
									data-prefix="<?php echo esc_attr($prefix); ?>"
									data-suffix="<?php echo esc_attr($suffix); ?>">
									<?php echo esc_html($prefix . number_format($coin_amount) . $suffix); ?>
								</span>
							</div>
							<div class="bar">
								<?php if ('yes' === $settings['enable_bar_animation']) : ?>
									<div class="bar-wrapper">
										<?php $unique_id = uniqid('skill_'); ?>
										<div class="bar-item" id="<?php echo esc_attr($unique_id); ?>">
											<div class="skillbar" data-percent="<?php echo esc_attr($settings['percent']['size']); ?>%">
												<div class="count-bar"></div>
											</div>
										</div>
									</div>
								<?php else: ?>
									<div class="static-bar-wrapper">
										<div class="static-bar"></div>
										<div class="static-bar-active"></div>
									</div>
								<?php endif; ?>
							</div>
						</div>
						<div class="description">
							<?php echo wp_kses((string) ($settings['coin_description'] ?? ''), $allowed_html); ?>
						</div>
						<div class="btn-wrapper topppa-btn-wrapper">
							<?php if (!empty($settings['enable_button']) && $settings['enable_button'] === 'yes'): ?>
								<div class="btn-one">
									<a href="<?php echo esc_url($settings['btn_link']['url'] ?? '#'); ?>"
										<?php if (!empty($settings['btn_link']['is_external'])) echo 'target="_blank"'; ?>
										<?php if (!empty($settings['btn_link']['nofollow'])) echo 'rel="nofollow"'; ?>
										class="topppa-btn">
										<?php
										if (!empty($settings['enable_btn_icon']) && $settings['enable_btn_icon'] === 'yes' && !empty($settings['topppa_btn_icon'])) {
											\Elementor\Icons_Manager::render_icon($settings['topppa_btn_icon'], ['aria-hidden' => 'true']);
										}
										echo esc_html($settings['btn_text']);
										?>
									</a>
								</div>
							<?php endif; ?>
							<?php if (!empty($settings['enable_button_two']) && $settings['enable_button_two'] === 'yes'): ?>
								<div class="btn-two">
									<a href="<?php echo esc_url($settings['btn_two_link']['url'] ?? '#'); ?>"
										<?php if (!empty($settings['btn_two_link']['is_external'])) echo 'target="_blank"'; ?>
										<?php if (!empty($settings['btn_two_link']['nofollow'])) echo 'rel="nofollow"'; ?>
										class="topppa-btn">
										<?php
										if (!empty($settings['enable_btn_two_icon']) && $settings['enable_btn_two_icon'] === 'yes' && !empty($settings['topppa_btn_two_icon'])) {
											\Elementor\Icons_Manager::render_icon($settings['topppa_btn_two_icon'], ['aria-hidden' => 'true']);
										}
										echo esc_html($settings['btn_two_text']);
										?>
									</a>
								</div>
							<?php endif; ?>
						</div>
					</div>
				</div>
			</div>
		</div>
<?php
	}
}
