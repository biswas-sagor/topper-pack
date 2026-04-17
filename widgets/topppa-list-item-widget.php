<?php

use TopperPack\Trait_Loader\Global_Component_Loader;
use \TopperPack\Includes\Controls\Controls_Manager as TopperPack_Controls_Manager;
use \TopperPack\Includes\Utilities;

if (! defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}

/**
 * Elementor topppa List Item Widget.
 *
 * Elementor widget that inserts an embbedable content into the page, from any given URL.
 *
 * @since 1.0.0
 */
class TOPPPA_List_Item_Widget extends \Elementor\Widget_Base {
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
		return 'topppa_list_item';
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
		return TOPPPA_EPWB . esc_html__('Advanced List Item', 'topper-pack');
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
		return 'eicon-bullet-list';
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
		return ['topppa', 'widget', 'post', 'advanced', 'list', 'item', 'topperpack'];
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
		return 'https://doc.topperpack.com/docs/general-widgets/list-item/';
	}

	public function topppa_list_item_badge_control($repeater) {

		$repeater->add_control(
			'enable_item_badge',
			[
				'label' => esc_html__('Enable Badge', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Show', 'topper-pack'),
				'label_off' => esc_html__('Hide', 'topper-pack'),
				'return_value' => 'yes',
				'default' => 'no',
			]
		);
		$repeater->add_control(
			'pro_preview',
			[
				'type' => \Elementor\Controls_Manager::RAW_HTML,
				'raw' => Utilities::upgrade_pro_image_notice('list-badge.jpg'),
				'condition' => [
					'enable_item_badge' => 'yes',
				]
			]
		);
	}

	public function topppa_list_item_tooltip_control($repeater) {
		$repeater->add_control(
			'enable_tooltip',
			[
				'label' => esc_html__('Enable Tooltip', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Show', 'topper-pack'),
				'label_off' => esc_html__('Hide', 'topper-pack'),
				'return_value' => 'yes',
				'default' => 'no',
			]
		);
		$repeater->add_control(
			'pro_preview2',
			[
				'type' => \Elementor\Controls_Manager::RAW_HTML,
				'raw' => Utilities::upgrade_pro_image_notice('list-tooltip.jpg'),
				'condition' => [
					'enable_tooltip' => 'yes',
				]
			]
		);
	}

	public function topppa_list_item_badge_style() {
		return;
	}
	/**
	 * Register List Item Widget controls.
	 *
	 * Add input fields to allow the user to customize the widget settings.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function register_controls() {

		//<=========>
		//<=========> CONTENT TAB START <========>
		$this->start_controls_section(
			'topppa_list_item_options',
			[
				'label' => __('List Item', 'topper-pack'),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		$this->topppa_global_title_tag();
		$this->add_control(
			'hover_badge_animation',
			[
				'label' => esc_html__('Badge Hover Animation', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Show', 'topper-pack'),
				'label_off' => esc_html__('Hide', 'topper-pack'),
				'return_value' => 'yes',
				'default' => 'no',
			]
		);

		$repeater = new \Elementor\Repeater();
		$repeater->add_control(
			'item_icon_note',
			[
				'label' => esc_html__('Icon Options', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'after',
			]
		);
		$repeater->add_control(
			'enable_item_icon',
			[
				'label' => esc_html__('Enable Icon', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Show', 'topper-pack'),
				'label_off' => esc_html__('Hide', 'topper-pack'),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);
		$repeater->add_control(
			'style_type',
			[
				'label' => esc_html__(' List Type', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'options' => [
					'icon' => [
						'title' => esc_html__('Icon', 'topper-pack'),
						'icon' => 'eicon-info-circle',
					],
					'number' => [
						'title' => esc_html__('Number', 'topper-pack'),
						'icon' => 'eicon-number-field',
					],
					'image' => [
						'title' => esc_html__('Image', 'topper-pack'),
						'icon' => 'fa fa-image',
					],
				],
				'default' => 'icon',
				'condition' => [
					'enable_item_icon' => 'yes',
				]
			]
		);
		$repeater->add_control(
			'topppa_number',
			[
				'label'       => esc_html__('Number', 'topper-pack'),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'default'     => esc_html__('01', 'topper-pack'),
				'condition' => [
					'style_type' => 'number',
					'enable_item_icon' => 'yes',
				]
			]
		);
		$repeater->add_control(
			'topppa_item_icon',
			[
				'label' => esc_html__('Icon', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::ICONS,
				'default' => [
					'value' => 'fas fa-check-circle',
					'library' => 'fa-solid',
				],
				'condition' => [
					'style_type' => 'icon',
					'enable_item_icon' => 'yes',
				]
			]
		);
		$repeater->add_control(
			'topppa_item_image',
			[
				'label' => esc_html__('Image', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'condition' => [
					'style_type' => 'image',
					'enable_item_icon' => 'yes',
				]
			]
		);
		$repeater->add_control(
			'topppa_item_image_size',
			[
				'label' => esc_html__('Image Size', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'full',
				'options' => [
					'full' => esc_html__('Full', 'topper-pack'),
					'large' => esc_html__('Large', 'topper-pack'),
					'medium' => esc_html__('Medium', 'topper-pack'),
					'thumbnail' => esc_html__('Thumbnail', 'topper-pack'),
				],
				'condition' => [
					'style_type' => 'image',
					'enable_item_icon' => 'yes',
				]
			]
		);
		$repeater->add_control(
			'item_badge_note',
			[
				'label' => esc_html__('Badge Options', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'after',
			]
		);

		$repeater->add_control(
			'list_item_note',
			[
				'label' => esc_html__('List Item', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$repeater->add_control(
			'topppa_item_title',
			[
				'label' => __('Title', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__('Ultimate Technology Support', 'topper-pack'),
				'label_block' => true,
				'dynamic' => [
					'active' => true,
				],
			]
		);
		$repeater->add_control(
			'topppa_title_link',
			[
				'label' => __('Link', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::URL,
				'placeholder' => __('https://your-link.com', 'topper-pack'),
				'show_external' => true,
				'default' => [
					'url' => '',
					'is_external' => true,
					'nofollow' => true,
					'custom_attributes' => '',
				],
				'dynamic' => [
					'active' => true,
				],
			]
		);

		$this->topppa_list_item_badge_control($repeater);
		$this->topppa_list_item_tooltip_control($repeater);

		$this->add_control(
			'list_item',
			[
				'label' => __('List Item', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'topppa_item_title' => esc_html__('Regulatory compliance assistance', 'topper-pack'),
					],
					[
						'topppa_item_title' => esc_html__('Assistance Compliance Regulatory', 'topper-pack'),
					],
				],
				'title_field' => '{{{ topppa_item_title }}}',
			]
		);

		/**
		 * Start Additional Settings
		 *
		 * @since 1.0.0
		 * @access protected
		 */

		$this->add_control(
			'additional_settings_note',
			[
				'label' => esc_html__('Additional Settings', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'after',
			]
		);
		$this->add_responsive_control(
			'wrapper_gap',
			[
				'label' => esc_html__('Item Gap', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px', 'em', 'rem'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
						'step' => 5,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .topppa-list-item-wrapper' => 'gap: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'flex_direction',
			[
				'label' => esc_html__('Flex Direction', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'column',
				'options' => [
					'row' => esc_html__('Row', 'topper-pack'),
					'row-reverse' => esc_html__('Row Reverse', 'topper-pack'),
					'column' => esc_html__('Column', 'topper-pack'),
					'column-reverse' => esc_html__('Column Reverse', 'topper-pack'),
				],
				'selectors' => [
					'{{WRAPPER}} .topppa-list-item-wrapper' => 'flex-direction: {{VALUE}};',
				],
			]
		);
		$this->add_responsive_control(
			'row_flex_wrap',
			[
				'label' => esc_html__('Flex Wrap', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'options' => [
					'nowrap' => [
						'title' => esc_html__('No Wrap', 'topper-pack'),
						'icon' => 'eicon-navigation-horizontal',
					],
					'wrap' => [
						'title' => esc_html__('Wrap', 'topper-pack'),
						'icon' => 'eicon-gallery-grid',
					],
				],
				'default' => 'nowrap',
				'toggle' => true,
				'selectors' => [
					'{{WRAPPER}} .topppa-list-item-wrapper' => 'flex-wrap: {{VALUE}};',
				],
				'condition' => [
					'flex_direction' => ['row', 'row-reverse']
				]
			]
		);

		$this->add_responsive_control(
			'justify_content',
			[
				'label' => esc_html__('Justify Content', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'options' => [
					'center' => [
						'title' => esc_html__('Center', 'topper-pack'),
						'icon' => 'eicon-justify-center-h',
					],
					'flex-start' => [
						'title' => esc_html__('Left', 'topper-pack'),
						'icon' => 'eicon-justify-start-h',
					],
					'flex-end' => [
						'title' => esc_html__('Right', 'topper-pack'),
						'icon' => 'eicon-justify-end-h',
					],
					'space-between' => [
						'title' => esc_html__('Space Between', 'topper-pack'),
						'icon' => 'eicon-justify-space-between-h',
					],
					'space-around' => [
						'title' => esc_html__('Space Around', 'topper-pack'),
						'icon' => 'eicon-justify-space-around-h',
					],
					'space-evenly' => [
						'title' => esc_html__('Space Evenly', 'topper-pack'),
						'icon' => 'eicon-justify-space-evenly-h',
					],
				],
				'default' => 'center',
				'toggle' => true,
				'label_block' => true,
				'selectors' => [
					'{{WRAPPER}} .topppa-list-item-wrapper' => 'justify-content: {{VALUE}};',
				],
				'condition' => [
					'flex_direction' => ['row', 'row-reverse']
				]
			]
		);

		$this->add_responsive_control(
			'align_items',
			[
				'label' => esc_html__('Align Items', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'options' => [
					'center' => [
						'title' => esc_html__('Center', 'topper-pack'),
						'icon' => 'eicon-align-center-h',
					],
					'flex-start' => [
						'title' => esc_html__('Left', 'topper-pack'),
						'icon' => 'eicon-align-start-h',
					],
					'flex-end' => [
						'title' => esc_html__('Right', 'topper-pack'),
						'icon' => 'eicon-align-end-h',
					],
					'stretch' => [
						'title' => esc_html__('Stretch', 'topper-pack'),
						'icon' => 'eicon-align-stretch-h',
					],
				],
				'default' => 'flex-start',
				'toggle' => true,
				'selectors' => [
					'{{WRAPPER}} .topppa-list-item-wrapper' => 'align-items: {{VALUE}};',
				],
				'condition' => [
					'flex_direction' => ['column', 'column-reverse']
				]
			]
		);
		$this->end_controls_section();

		/**
		 * Start Box Styles
		 *
		 * @since 1.0.0
		 * @access protected
		 */

		$this->start_controls_section(
			'box_styles',
			[
				'label' => esc_html__('Box Style', 'topper-pack'),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
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
			'box_width',
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
					'{{WRAPPER}} .topppa-list-item-wrapper .topppa-list-item' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'box_direction',
			[
				'label' => esc_html__('Direction', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => '',
				'options' => [
					'' => esc_html__('None', 'topper-pack'),
					'row' => esc_html__('Row', 'topper-pack'),
					'row-reverse' => esc_html__('Row Reverse', 'topper-pack'),
					'column' => esc_html__('Column', 'topper-pack'),
					'column-reverse' => esc_html__('Column Reverse', 'topper-pack'),
				],
				'selectors' => [
					'{{WRAPPER}} .topppa-list-item' => 'flex-direction: {{VALUE}};',
				],
			]
		);
		$this->add_responsive_control(
			'box_align',
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
				'default' => 'center',
				'toggle' => true,
				'selectors' => [
					'{{WRAPPER}} .topppa-list-item' => 'align-items: {{VALUE}};',
				],
				'condition' => [
					'box_direction' => ['column', 'column-reverse']
				]
			]
		);
		$this->add_responsive_control(
			'box_jalign',
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
				'default' => 'center',
				'toggle' => true,
				'selectors' => [
					'{{WRAPPER}} .topppa-list-item' => 'justify-content: {{VALUE}};',
				],
				'condition' => [
					'box_direction' => ['row', 'row-reverse']
				]
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
					'default' => [
						'unit' => 'px',
						'size' => 15,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .topppa-list-item' => 'gap: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'box_bg',
				'label' => esc_html__('Background', 'topper-pack'),
				'types' => ['classic', 'gradient', 'video'],
				'selector' => '{{WRAPPER}} .topppa-list-item',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'box_border',
				'label' => esc_html__('Border', 'topper-pack'),
				'selector' => '{{WRAPPER}} .topppa-list-item',
			]
		);
		$this->add_responsive_control(
			'box_radius',
			[
				'label' => esc_html__('Border Radius', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .topppa-list-item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'box_shadow',
				'label' => esc_html__('Box Shadow', 'topper-pack'),
				'selector' => '{{WRAPPER}} .topppa-list-item',
			]
		);
		$this->end_controls_tab();

		$this->start_controls_tab(
			'style_hover_tab',
			[
				'label' => esc_html__('Hover', 'topper-pack'),
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'box_hbg',
				'label' => esc_html__('Background', 'topper-pack'),
				'types' => ['classic', 'gradient', 'video'],
				'selector' => '{{WRAPPER}} .topppa-list-item:hover',
			]
		);
		$this->add_responsive_control(
			'box_htext',
			[
				'label' => esc_html__('Hover Text Color', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .topppa-list-item-wrapper .topppa-list-item:hover .item-title, {{WRAPPER}} .topppa-list-item-wrapper .topppa-list-item:hover .item-title a' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_responsive_control(
			'box_hicon',
			[
				'label' => esc_html__('Hover Icon Color', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .topppa-list-item-wrapper .topppa-list-item:hover .item-icon' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'box_hborder',
				'label' => esc_html__('Border', 'topper-pack'),
				'selector' => '{{WRAPPER}} .topppa-list-item:hover',
			]
		);
		$this->add_responsive_control(
			'box_hradius',
			[
				'label' => esc_html__('Border Radius', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .topppa-list-item:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'box_hshadow',
				'label' => esc_html__('Box Shadow', 'topper-pack'),
				'selector' => '{{WRAPPER}} .topppa-list-item:hover',
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->add_responsive_control(
			'box_margin',
			[
				'label' => esc_html__('Margin', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .topppa-list-item' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .topppa-list-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();

		/**
		 * Start Icon Styles
		 *
		 * @since 1.0.0
		 * @access protected
		 */

		$this->start_controls_section(
			'icon_styles',
			[
				'label' => esc_html__('Icon', 'topper-pack'),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'icon_size',
				'selector' => '{{WRAPPER}} .topppa-list-item .item-icon',
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
						'max' => 200,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .topppa-list-item .item-icon' => 'width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'icon_color',
			[
				'label' => esc_html__('Color', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .topppa-list-item .item-icon' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'icon_bg_color',
				'types' => ['classic', 'gradient', 'video'],
				'exclude' => ['video', 'image'], // phpcs:ignore WordPressVIPMinimum.Performance.WPQueryParams.PostNotIn_exclude
				'selector' => '{{WRAPPER}} .topppa-list-item .item-icon',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'icon_border',
				'selector' => '{{WRAPPER}} .topppa-list-item .item-icon',
			]
		);
		$this->add_responsive_control(
			'icon_radius',
			[
				'label' => esc_html__('Radius', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em', 'rem', 'custom'],
				'selectors' => [
					'{{WRAPPER}} .topppa-list-item .item-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'icon_shadow',
				'selector' => '{{WRAPPER}} .topppa-list-item .item-icon',
			]
		);

		$this->add_responsive_control(
			'icon_margin',
			[
				'label' => esc_html__('Margin', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em', 'rem', 'custom'],
				'selectors' => [
					'{{WRAPPER}} .topppa-list-item .item-icon' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'icon_padding',
			[
				'label' => esc_html__('Padding', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em', 'rem', 'custom'],
				'selectors' => [
					'{{WRAPPER}} .topppa-list-item .item-icon' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'icon_svg_style_note',
			[
				'label' => esc_html__('SVG icon style', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'after',
				'description' => esc_html__('This option is only available for SVG icon.', 'topper-pack'),
			]
		);
		$this->add_responsive_control(
			'icon_svg_width',
			[
				'label' => esc_html__('Icon Size', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px', '%', 'em', 'rem', 'custom'],
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
				'selectors' => [
					'{{WRAPPER}} .topppa-list-item .item-icon svg' => 'width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'icon_svg_color',
			[
				'label' => esc_html__('Icon Color', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .topppa-list-item .item-icon svg' => 'fill: {{VALUE}}',
				],
			]
		);
		$this->add_responsive_control(
			'icon_svg_stroke_width',
			[
				'label' => esc_html__('Stroke Size', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px', '%', 'em', 'rem', 'custom'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 10,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 1,
				],
				'selectors' => [
					'{{WRAPPER}} .topppa-list-item .item-icon svg' => 'stroke-width: {{SIZE}}{{UNIT}}',
				],
			]
		);
		$this->add_responsive_control(
			'icon_svg_stroke_color',
			[
				'label' => esc_html__('Stroke color', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .topppa-list-item .item-icon svg' => 'stroke: {{VALUE}}',
				],
			]
		);
		$this->end_controls_section();

		/**
		 * Start Title Styles
		 *
		 * @since 1.0.0
		 * @access protected
		 */

		$this->start_controls_section(
			'title_styles',
			[
				'label' => esc_html__('Title', 'topper-pack'),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'title_typo',
				'selector' => '{{WRAPPER}} .topppa-list-item .item-title',
			]
		);
		$this->add_responsive_control(
			'title_color',
			[
				'label'     => esc_html__('Color', 'topper-pack'),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'default'   => '#7B7E86',
				'selectors' => [
					'{{WRAPPER}} .topppa-list-item .item-title' => 'color: {{VALUE}}',
					'{{WRAPPER}} .topppa-list-item .item-title a' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_responsive_control(
			'title_hcolor',
			[
				'label'     => esc_html__('Hover Color', 'topper-pack'),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .topppa-list-item .item-title a:hover' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_responsive_control(
			'title_margin',
			[
				'label'      => esc_html__('Margin', 'topper-pack'),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'default' => [
					'top' => '0',
					'right' => '0',
					'bottom' => '0',
					'left' => '0',
					'unit' => 'px',
				],
				'selectors'  => [
					'{{WRAPPER}} .topppa-list-item .item-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .topppa-list-item .item-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();

		/**
		 * Badge Styles - Pro Feature
		 *
		 * @since 1.0.0
		 * @access protected
		 */
		$this->topppa_list_item_badge_style();
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
		// HTML Tag
		$html_tag = isset($settings['title_tag']) ? $settings['title_tag'] : 'h3';
?>
		<div class="topppa-list-item-wrapper">
			<?php if (!empty($settings['list_item'])) : ?>
				<?php foreach ($settings['list_item'] as $index => $item) : ?>
					<?php
					$has_icon = !empty($item['enable_item_icon']);
					$has_link = !empty($item['topppa_title_link']['url']);
					$has_badge = !empty($item['enable_item_badge']) && 'yes' === ($item['enable_item_badge'] ?? 'no');
					$title_classes = 'item-title' . ($has_link ? ' has-link' : '');
					$hover_animation_class = !empty($settings['hover_badge_animation']) && $settings['hover_badge_animation'] === 'yes' ? 'hover-anim' : 'no-anim';

					if ($has_link) {
						$link_key = 'topppa_title_link_' . $index;
						$this->add_link_attributes($link_key, $item['topppa_title_link']);
					}
					?>
					<div class="topppa-list-item elementor-repeater-item-<?php echo esc_attr($item['_id']) ?>  <?php echo esc_attr(($item['enable_tooltip'] ?? 'no') === 'yes' ? 'active' : ''); ?>">
						<?php if ($has_icon) : ?>
							<div class="item-icon">
								<?php if ($item['style_type'] === 'icon') : ?>
									<?php \Elementor\Icons_Manager::render_icon($item['topppa_item_icon'], ['aria-hidden' => 'true']); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- Already escaped by elementor 
									?>
								<?php elseif ($item['style_type'] === 'number') : ?>
									<?php echo esc_html($item['topppa_number']); ?>
								<?php elseif ($item['style_type'] === 'image' && !empty($item['topppa_item_image']['id'])) : ?>
									<?php
									$img_size = !empty($item['topppa_item_image_size']) ? $item['topppa_item_image_size'] : 'full';
									echo wp_get_attachment_image($item['topppa_item_image']['id'], $img_size, false, [
										'alt' => esc_attr($item['topppa_item_title'] ?? 'List Item Image'),
										'class' => 'topppa-list-item-image',
									]);
									?>
								<?php endif; ?>
							</div>
						<?php endif; ?>

						<?php if (!empty($item['topppa_item_title'])) : ?>
							<div class="item-title-wrapper">
								<<?php echo esc_attr($html_tag); ?> class="<?php echo esc_attr($title_classes) . ' ' . esc_attr($hover_animation_class); ?>">
									<?php if ($has_link) : ?>
										<a <?php $this->print_render_attribute_string($link_key); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- Already escaped by elementor 
											?>>
										<?php endif; ?>

										<?php echo esc_html($item['topppa_item_title']); ?>

										<?php if (topppa_can_use_premium_features() && $has_badge) : ?>
											<span class="item-badge">
												<?php if (!empty($item['item_badge_one'])) : ?>
													<small class="badge--one"><?php echo esc_html($item['item_badge_one']); ?></small>
												<?php endif; ?>
												<?php if (!empty($item['item_badge_two'])) : ?>
													<small class="badge--two"><?php echo esc_html($item['item_badge_two']); ?></small>
												<?php endif; ?>
											</span>
										<?php endif; ?>

										<?php if ($has_link) : ?>
										</a>
									<?php endif; ?>
								</<?php echo esc_attr($html_tag); ?>>
							</div>
						<?php endif; ?>
						<?php if (topppa_can_use_premium_features() && 'yes' === ($item['enable_tooltip'] ?? 'no')) : ?>
							<div class="list-tooltip-content">
								<?php echo esc_html($item['tooltip_text']); ?>
							</div>
						<?php endif; ?>
					</div>
				<?php endforeach; ?>
			<?php endif; ?>
		</div>
<?php
	}
}
