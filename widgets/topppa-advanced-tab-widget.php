<?php

/**
 * Elementor topppa Advanced Tab Widget.
 *
 * @package TopperPack
 * @since 1.0.0
 */

use TopperPack\Trait_Loader\Global_Component_Loader;
use \TopperPack\Includes\Controls\Controls_Manager as TopperPack_Controls_Manager;

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}

/**
 * Elementor topppa Advanced Tab Widget.
 *
 * Elementor widget that inserts an embbedable content into the page, from any given URL.
 *
 * @since 1.0.0
 */
class TOPPPA_Advanced_Tab_Widget extends \Elementor\Widget_Base
{

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
	public function get_name()
	{
		return 'topppa_advanced_tab';
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
	public function get_title()
	{
		return TOPPPA_EPWB . esc_html__('Advanced Tab', 'topper-pack');
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
	public function get_icon()
	{
		return 'eicon-call-to-action';
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
	public function get_categories()
	{
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
	public function get_keywords()
	{
		return ['topppa', 'widget', 'advanced', 'tab', 'topperpack'];
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
	public function get_custom_help_url()
	{
		return 'https://doc.topperpack.com/docs/general-widgets/advanced-tab/';
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
	public function get_custom_image_url()
	{
		return 'https://topperpack.com/assets/widgets/advanced-tab-widget/';
	}

	/**
	 * Elementor Templates List
	 * return array
	 */
	public function topppa_elementor_template()
	{
		$templates = \Elementor\Plugin::instance()->templates_manager->get_source('local')->get_items();
		$types = array();
		if (empty($templates)) {
			$template_lists = ['0' => __('Do not Saved Templates.', 'topper-pack')];
		} else {
			$template_lists = ['0' => __('Select Template', 'topper-pack')];
			foreach ($templates as $template) {
				$template_lists[$template['template_id']] = $template['title'] . ' (' . $template['type'] . ')';
			}
		}
		return $template_lists;
	}

	/**
	 * Register Advanced Tab Widget controls.
	 *
	 * Add input fields to allow the user to customize the widget settings.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function register_controls()
	{

		$base_url = $this->get_custom_image_url();

		$this->start_controls_section(
			'topppa_blog_style',
			[
				'label' => esc_html__('Styles', 'topper-pack'),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
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
						'imagelarge' => $base_url . 'topppa-advanced-tab-1.jpg',
						'imagesmall' => $base_url . 'topppa-advanced-tab-1.jpg',
						'width' => '100%',
					],
					'style_two' => [
						'title' => esc_html__('style 2', 'topper-pack'),
						'imagelarge' => $base_url . 'topppa-advanced-tab-2.jpg',
						'imagesmall' => $base_url . 'topppa-advanced-tab-2.jpg',
						'width' => '100%',
					],
					'style_three' => [
						'title' => esc_html__('Style 3', 'topper-pack'),
						'imagelarge' => $base_url . 'topppa-advanced-tab-3.jpg',
						'imagesmall' => $base_url . 'topppa-advanced-tab-3.jpg',
						'width' => '100%',
					],
					'style_four' => [
						'title' => esc_html__('Style 4', 'topper-pack'),
						'imagelarge' => $base_url . 'topppa-advanced-tab-4.jpg',
						'imagesmall' => $base_url . 'topppa-advanced-tab-4.jpg',
						'width' => '100%',
					],
				],
			]
		);
		$this->end_controls_section();

		//=======================================//
		//======= CONTENT TAB START ============//
		//=====================================//
		$this->start_controls_section(
			'topppa_tabs_options',
			[
				'label' => esc_html__('Tabs Content Option', 'topper-pack'),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->topppa_get_global_button_effects_controls();
		$this->add_control(
			'html_tag',
			[
				'label' => esc_html__('Title HTML Tag', 'topper-pack'),
				'description' => esc_html__('Add HTML Tag For Title', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'h3',
				'options' => [
					'h1' => esc_html__('H1', 'topper-pack'),
					'h2' => esc_html__('H2', 'topper-pack'),
					'h3' => esc_html__('H3', 'topper-pack'),
					'h4' => esc_html__('H4', 'topper-pack'),
					'h5' => esc_html__('H5', 'topper-pack'),
					'h6' => esc_html__('H6', 'topper-pack'),
					'p' => esc_html__('P', 'topper-pack'),
					'span' => esc_html__('span', 'topper-pack'),
					'div' => esc_html__('Div', 'topper-pack'),
				],
				'condition' => [
					'enable_sub_title' => 'yes',
				],
			]
		);
		$repeater = new \Elementor\Repeater();
		$repeater->add_control(
			'advanced_tabs_active',
			[
				'label' => esc_html__('Keep this tab open?', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Yes', 'topper-pack'),
				'label_off' => esc_html__('No', 'topper-pack'),
				'return_value' => 'yes',
				'default' => 'no',
			]
		);
		$repeater->add_control(
			'enable_button_bg',
			[
				'label' => esc_html__('Enable Button BG', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Show', 'topper-pack'),
				'label_off' => esc_html__('Hide', 'topper-pack'),
				'return_value' => 'yes',
				'default' => 'no',
				'separator' => 'before',
			]
		);
		$repeater->add_control(
			'button_image',
			[
				'label' => esc_html__('Button BG Image', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'separator' => 'before',
				'condition' => [
					'enable_button_bg' => 'yes',
				],
			]
		);
		$repeater->add_control(
			'advanced_tabs_title',
			[
				'label' => esc_html__('Title', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'label_block' => true,
			]
		);
		$repeater->add_control(
			'advanced_tabs_stitle',
			[
				'label' => esc_html__('Sub Title', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'label_block' => true,
			]
		);

		$repeater->add_control(
			'advanced_tabs_icon',
			[
				'label' => esc_html__('Icon', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::ICONS,
			]
		);
		$repeater->add_control(
			'topppa_advanced_tab_content_source',
			[
				'label' => esc_html__('Content Source', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'custom',
				'options' => [
					'custom' => esc_html__('Content', 'topper-pack'),
					'elementor' => esc_html__('Template', 'topper-pack'),
				],
				'separator' => 'before',
			]
		);
		$repeater->add_control(
			'template_id',
			[
				'label' => __('Content Title', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => '0',
				'options' => $this->topppa_elementor_template(),
				'condition' => [
					'topppa_advanced_tab_content_source' => "elementor"
				],
				'separator' => 'before',
			]
		);
		$repeater->add_control(
			'image',
			[
				'label' => esc_html__('Image', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'condition' => [
					'topppa_advanced_tab_content_source' => 'custom',
				],
				'separator' => 'before',
			]
		);
		$repeater->add_control(
			'enable_content_box',
			[
				'label' => esc_html__('Enable Content Box', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Show', 'topper-pack'),
				'label_off' => esc_html__('Hide', 'topper-pack'),
				'return_value' => 'yes',
				'default' => 'yes',
				'condition' => [
					'topppa_advanced_tab_content_source' => 'custom',
				],
			]
		);
		$repeater->add_control(
			'tab_title',
			[
				'label' => esc_html__('Content', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'rows' => 5,
				'default' => esc_html__('Our Destination', 'topper-pack'),
				'condition' => [
					'topppa_advanced_tab_content_source' => 'custom',
					'enable_content_box' => 'yes',
				],
			]
		);
		$repeater->add_control(
			'tab_desc',
			[
				'label' => esc_html__('Description', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::WYSIWYG,
				'rows' => 10,
				'default' => esc_html__('Our transportation division offers reliable and efficient solutions for all your transportation needs. Whether you are shipping goods domestically or services internationally.', 'topper-pack'),
				'condition' => [
					'topppa_advanced_tab_content_source' => 'custom',
					'enable_content_box' => 'yes',
				],
			]
		);


		$repeater->add_control(
			'button_divider',
			[
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => [
					'topppa_advanced_tab_content_source' => 'custom',
					'enable_content_box' => 'yes',
				],
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
				'condition' => [
					'topppa_advanced_tab_content_source' => 'custom',
					'enable_content_box' => 'yes',
				],
			]
		);

		$repeater->add_control(
			'topppa_btn_text',
			[
				'label' => esc_html__('Button Text', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__('Meet With Us', 'topper-pack'),
				'label_block' => true,
				'dynamic' => [
					'active' => true,
				],
				'condition' => [
					'topppa_advanced_tab_content_source' => 'custom',
					'enable_content_box' => 'yes',
					'enable_button' => 'yes',
				],
			]
		);

		$repeater->add_control(
			'topppa_btn_link',
			[
				'label' => esc_html__('Link', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::URL,
				'placeholder' => esc_html__('https://your-link.com', 'topper-pack'),
				'options' => ['url', 'is_external', 'nofollow'],
				'default' => [
					'url' => '',
					'is_external' => true,
					'nofollow' => true,
					// 'custom_attributes' => '',
				],
				'label_block' => true,
				'dynamic' => [
					'active' => true,
				],
				'condition' => [
					'topppa_advanced_tab_content_source' => 'custom',
					'enable_content_box' => 'yes',
					'enable_button' => 'yes',
				],
			]
		);

		$repeater->add_control(
			'topppa_show_icon',
			[
				'label' => esc_html__('Show Icon', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Show', 'topper-pack'),
				'label_off' => esc_html__('Hide', 'topper-pack'),
				'return_value' => 'yes',
				'default' => 'no',
				'condition' => [
					'topppa_advanced_tab_content_source' => 'custom',
					'enable_content_box' => 'yes',
					'enable_button' => 'yes',
				],
			]
		);

		$repeater->add_control(
			'topppa_btn_icon',
			[
				'label' => esc_html__('Icon', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::ICONS,
				'default' => [
					'value' => 'fas fa-arrow-right',
					'library' => 'fa-solid',
				],
				'condition' => [
					'topppa_advanced_tab_content_source' => 'custom',
					'enable_content_box' => 'yes',
					'enable_button' => 'yes',
					'topppa_show_icon' => 'yes'
				],
			]
		);
		$this->add_control(
			'advanced_tab_items',
			[
				'label' => esc_html__('Tabs', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'advanced_tabs_title' => 'Computer',
						'topppa_advanced_tab_content_source' => '',
					],
					[
						'advanced_tabs_title' => 'Transportation',
						'topppa_advanced_tab_content_source' => '',
					],
					[
						'advanced_tabs_title' => 'Artificial',
						'topppa_advanced_tab_content_source' => '',
					],
					[
						'advanced_tabs_title' => 'Automation',
						'topppa_advanced_tab_content_source' => '',
					],
				],
				'title_field' => '{{{ advanced_tabs_title }}}',
			]
		);
		$this->end_controls_section();

		// <==========>
		// <==========> BOX STYLES <==========>

		$this->start_controls_section(
			'main_box_styles',
			[
				'label' => esc_html__('Tab Menu Box', 'topper-pack'),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'enable_container',
			[
				'label' => esc_html__('Enable Container', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Show', 'topper-pack'),
				'label_off' => esc_html__('Hide', 'topper-pack'),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);
		$this->add_responsive_control(
			'main_box_direction',
			[
				'label' => esc_html__('Direction', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'options' => [
					'row' => [
						'title' => esc_html__('Row', 'topper-pack'),
						'icon' => 'eicon-h-align-left',
					],
					'row-reverse' => [
						'title' => esc_html__('Row Reverse', 'topper-pack'),
						'icon' => 'eicon-h-align-right',
					],
					'column' => [
						'title' => esc_html__('Column', 'topper-pack'),
						'icon' => 'eicon-v-align-top',
					],
					'column-reverse' => [
						'title' => esc_html__('Column Reverse', 'topper-pack'),
						'icon' => 'eicon-v-align-bottom',
					],
				],
				'toggle' => false,
				'selectors' => [
					'{{WRAPPER}} .advanced-tabs-wrapper' => 'flex-direction: {{VALUE}};',
				],
				'condition' => [
					'topppa_styles' => 'style_two',
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
					'{{WRAPPER}} .advanced-tabs-wrapper' => 'align-items: {{VALUE}};',
				],
				'condition' => [
					'topppa_styles' => 'style_two',
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
					'{{WRAPPER}} .advanced-tabs-wrapper .topppa-advanced-tabs-menu' => 'justify-content: {{VALUE}};',
				],
				'condition' => [
					'topppa_styles!' => 'style_two',
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
						'max' => 500,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .advanced-tabs-wrapper' => 'gap: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'topppa_styles' => 'style_two',
				],
			]
		);
		$this->add_responsive_control(
			'tab_box_width',
			[
				'label' => esc_html__('Box Width', 'topper-pack'),
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
					'{{WRAPPER}} .advanced-tabs-wrapper .topppa-advanced-tabs-menu' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'box_bg',
				'label' => esc_html__('Background', 'topper-pack'),
				'types' => ['classic', 'gradient'],
				'selector' => '{{WRAPPER}} .advanced-tabs-wrapper .topppa-advanced-tabs-menu',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'box_border',
				'label' => esc_html__('Border', 'topper-pack'),
				'selector' => '{{WRAPPER}} .advanced-tabs-wrapper .topppa-advanced-tabs-menu',
			]
		);
		$this->add_responsive_control(
			'tabs_border_radius',
			[
				'label' => esc_html__('Border Radius', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .advanced-tabs-wrapper .topppa-advanced-tabs-menu' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->start_controls_tabs(
			'circle_section_tabs'

		);
		$this->start_controls_tab(
			'circle_active_tab',
			[
				'label' => esc_html__('circle Active Style', 'topper-pack'),
				'condition' => [
					'topppa_styles' => 'style_four',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'Inner_circle_bg',
				'label' => esc_html__('Background', 'topper-pack'),
				'types' => ['classic', 'gradient'],
				'selector' => '{{WRAPPER}} .advanced-tabs-wrapper.style-four .nav .nav-item .nav-link.active::after',
				'condition' => [
					'topppa_styles' => 'style_four',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'Inner_circle__border',
				'label' => esc_html__('Border', 'topper-pack'),
				'selector' => '{{WRAPPER}} .advanced-tabs-wrapper.style-four .nav .nav-item .nav-link::after',
				'condition' => [
					'topppa_styles' => 'style_four',
				],
			]
		);
		$this->add_responsive_control(
			'Inner_circle__radius',
			[
				'label' => esc_html__('Border Radius', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .advanced-tabs-wrapper.style-four .nav .nav-item .nav-link::after' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'topppa_styles' => 'style_four',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'Inner_circle__shadow',
				'label' => esc_html__('Shadow', 'topper-pack'),
				'selector' => '{{WRAPPER}} .advanced-tabs-wrapper.style-four .nav .nav-item .nav-link::after',
				'condition' => [
					'topppa_styles' => 'style_four',
				],
			]
		);

		$this->end_controls_tab();
		$this->start_controls_tab(
			'circle_style',
			[
				'label' => esc_html__('circle Style', 'topper-pack'),
				'condition' => [
					'topppa_styles' => 'style_four',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'circle_bg',
				'label' => esc_html__('Background', 'topper-pack'),
				'types' => ['classic', 'gradient'],
				'selector' => '{{WRAPPER}} .advanced-tabs-wrapper.style-four .nav .nav-item .nav-link:before',
				'condition' => [
					'topppa_styles' => 'style_four',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'circle__border',
				'label' => esc_html__('Border', 'topper-pack'),
				'selector' => '{{WRAPPER}} .advanced-tabs-wrapper.style-four .nav .nav-item .nav-link:before',
				'condition' => [
					'topppa_styles' => 'style_four',
				],
			]
		);
		$this->add_responsive_control(
			'circle__radius',
			[
				'label' => esc_html__('Border Radius', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .advanced-tabs-wrapper.style-four .nav .nav-item .nav-link:before' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'topppa_styles' => 'style_four',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'circle__shadow',
				'label' => esc_html__('Shadow', 'topper-pack'),
				'selector' => '{{WRAPPER}} .advanced-tabs-wrapper.style-four .nav .nav-item .nav-link:before',
				'condition' => [
					'topppa_styles' => 'style_four',
				],
			]

		);
		$this->end_controls_tabs();
		$this->end_controls_tab();
		$this->add_responsive_control(
			'box_margin',
			[
				'label' => esc_html__('Margin', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .advanced-tabs-wrapper .advanced-tabs-buttons' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .advanced-tabs-wrapper .topppa-advanced-tabs-menu' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();

		//===================================//
		//========= TAB MENU STYLE ========//
		//=================================//
		$this->start_controls_section(
			'tab_menu',
			[
				'label' => esc_html__('Tab Menu Item', 'topper-pack'),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_responsive_control(
			'menu_box_width',
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
					'{{WRAPPER}} .advanced-tabs-buttons' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'tab_manu_direction',
			[
				'label' => esc_html__('Direction', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'options' => [
					'row' => [
						'title' => esc_html__('Row', 'topper-pack'),
						'icon' => 'eicon-h-align-left',
					],
					'row-reverse' => [
						'title' => esc_html__('Row Reverse', 'topper-pack'),
						'icon' => 'eicon-h-align-right',
					],
					'column' => [
						'title' => esc_html__('Column', 'topper-pack'),
						'icon' => 'eicon-v-align-top',
					],
					'column-reverse' => [
						'title' => esc_html__('Column Reverse', 'topper-pack'),
						'icon' => 'eicon-v-align-bottom',
					],
				],
				'toggle' => false,
				'selectors' => [
					'{{WRAPPER}} .advanced-tabs-wrapper li.nav-item .nav-link' => 'flex-direction: {{VALUE}};',
				],
			]
		);
		$this->add_responsive_control(
			'tab_menu_align',
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
					'{{WRAPPER}} .advanced-tabs-wrapper li.nav-item .nav-link' => 'align-items: {{VALUE}};',
					'{{WRAPPER}} .advanced-tabs-wrapper li.nav-item .nav-link' => 'text-align: {{VALUE}};',
				],
			]
		);
		$this->add_responsive_control(
			'menu_gap',
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
					'{{WRAPPER}} .advanced-tabs-wrapper .topppa-advanced-tabs-menu' => 'gap: {{SIZE}}{{UNIT}};',
				],

			]
		);
		$this->add_responsive_control(
			'tab_after_border_color',
			[
				'label' => esc_html__('Border Color', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .advanced-tabs-wrapper.style-three .advanced-tabs-buttons .topppa-advanced-tabs-menu::after' => 'background-color: {{VALUE}}',
				],
				'condition' => [
					'topppa_styles' => 'style_three',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'box_menu_bg',
				'label' => esc_html__('Background', 'topper-pack'),
				'types' => ['classic', 'gradient'],
				'selector' => '{{WRAPPER}} .advanced-tabs-wrapper li.nav-item',
				'condition' => [
					'topppa_styles!' => ['style_two', 'style_three'],
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'box_menu_border',
				'label' => esc_html__('Border', 'topper-pack'),
				'selector' => '{{WRAPPER}} .advanced-tabs-wrapper li.nav-item',
				'condition' => [
					'topppa_styles!' => ['style_two', 'style_three'],
				],
			]
		);
		$this->add_responsive_control(
			'tabs_menu_border_radius',
			[
				'label' => esc_html__('Border Radius', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .advanced-tabs-wrapper li.nav-item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'topppa_styles!' => ['style_two', 'style_three'],
				],
			]
		);
		$this->add_responsive_control(
			'tabs_menu_margin',
			[
				'label' => esc_html__('Margin', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em', 'rem', 'custom'],
				'selectors' => [
					'{{WRAPPER}} .advanced-tabs-wrapper li.nav-item' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'topppa_styles!' => ['style_two', 'style_three'],
				],
			]
		);
		$this->add_responsive_control(
			'tabs_menu_padding',
			[
				'label' => esc_html__('Padding', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em', 'rem', 'custom'],
				'selectors' => [
					'{{WRAPPER}} .advanced-tabs-wrapper li.nav-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'topppa_styles!' => ['style_two', 'style_three'],
				],
			]
		);
		$this->start_controls_tabs(
			'style_tabs'
		);

		$this->start_controls_tab(
			'style_normal_tab',
			[
				'label' => esc_html__('Tab Normal', 'topper-pack'),
			]
		);
		$this->add_responsive_control(
			'tad_after_dote_color',
			[
				'label' => esc_html__('Dot Color', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .advanced-tabs-wrapper.style-two .topppa-advanced-tabs-menu li .nav-link::after' => 'background-color: {{VALUE}}',
				],
				'condition' => [
					'topppa_styles' => 'style_two',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'tad_menu_typo',
				'selector' => '{{WRAPPER}} .advanced-tabs-wrapper li.nav-item .nav-link',
			]
		);
		$this->add_responsive_control(
			'tad_menu_color',
			[
				'label' => esc_html__('Color', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .advanced-tabs-wrapper li.nav-item .nav-link' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'tad_menu_bg',
				'types' => ['classic', 'gradient', 'video'],
				'selector' => '{{WRAPPER}} .advanced-tabs-wrapper li.nav-item .nav-link',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'tad_menu_border',
				'label' => esc_html__('Border', 'topper-pack'),
				'selector' => '{{WRAPPER}} .advanced-tabs-wrapper li.nav-item .nav-link',
			]
		);
		$this->add_responsive_control(
			'ad_tabs_menu_border_radius2',
			[
				'label' => esc_html__('Border Radius', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .advanced-tabs-wrapper li.nav-item .nav-link' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'tab_menu_shadow',
				'selector' => '{{WRAPPER}} .advanced-tabs-wrapper li.nav-item .nav-link',
			]
		);
		$this->end_controls_tab();

		$this->start_controls_tab(
			'tabs_menu_tab',
			[
				'label' => esc_html__('Tab Hover/Active', 'topper-pack'),
			]
		);
		$this->add_responsive_control(
			'active_tad_after_dote_color',
			[
				'label' => esc_html__('Active Dot Color', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .advanced-tabs-wrapper.style-two .topppa-advanced-tabs-menu li .nav-link.active::after' => 'background-color: {{VALUE}}',
				],
				'condition' => [
					'topppa_styles' => 'style_two',
				],
			]
		);
		$this->add_responsive_control(
			'active_tad_menu_color',
			[
				'label' => esc_html__('Text Color', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .advanced-tabs-wrapper li.nav-item .nav-link.active, .advanced-tabs-wrapper li.nav-item .nav-link:hover' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'active_ad_menu_bg',
				'types' => ['classic', 'gradient', 'video'],
				'selector' => '{{WRAPPER}} .advanced-tabs-wrapper li.nav-item .nav-link.active, .advanced-tabs-wrapper li.nav-item .nav-link:hover',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'tad_menu_border_active',
				'label' => esc_html__('Border', 'topper-pack'),
				'selector' => '{{WRAPPER}} .advanced-tabs-wrapper li.nav-item .nav-link.active, .advanced-tabs-wrapper li.nav-item .nav-link:hover',
			]
		);
		$this->add_responsive_control(
			'tad_tabs_menu_active_border_radius2',
			[
				'label' => esc_html__('Border Radius', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .advanced-tabs-wrapper li.nav-item .nav-link.active, .advanced-tabs-wrapper li.nav-item .nav-link:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'tab_menu_shadow_active',
				'selector' => '{{WRAPPER}} .advanced-tabs-wrapper li.nav-item .nav-link.active, .advanced-tabs-wrapper li.nav-item .nav-link:hover',
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->add_responsive_control(
			'tad_menu_padding',
			[
				'label' => esc_html__('Padding', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em', 'rem', 'custom'],
				'selectors' => [
					'{{WRAPPER}} .advanced-tabs-wrapper li.nav-item .nav-link' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'tad_menu_margin',
			[
				'label' => esc_html__('Margin', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em', 'rem', 'custom'],
				'selectors' => [
					'{{WRAPPER}} .advanced-tabs-wrapper li.nav-item .nav-link' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->start_controls_tabs(
			'style_menu_content_tabs'
		);

		$this->start_controls_tab(
			'style_menu_subtitle_tab',
			[
				'label' => esc_html__('Sub Title', 'topper-pack'),
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'stitle_typo',
				'selector' => '{{WRAPPER}} .advanced-tabs-wrapper li.nav-item .nav-link .topppa-tab-memu-content-stitle',
			]
		);
		$this->add_responsive_control(
			'stitle_color',
			[
				'label' => esc_html__('Color', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .advanced-tabs-wrapper li.nav-item .nav-link .topppa-tab-memu-content-stitle' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_responsive_control(
			'stitle_hcolor',
			[
				'label' => esc_html__('Active/Hover Color', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .advanced-tabs-wrapper li.nav-item .nav-link.active .topppa-tab-memu-content-stitle' => 'color: {{VALUE}}',
					'{{WRAPPER}} .advanced-tabs-wrapper li.nav-item .nav-link:hover .topppa-tab-memu-content-stitle' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_responsive_control(
			'stitle_margin',
			[
				'label' => esc_html__('Margin', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .advanced-tabs-wrapper li.nav-item .nav-link .topppa-tab-memu-content-stitle' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'stitle_padding',
			[
				'label' => esc_html__('Padding', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .advanced-tabs-wrapper li.nav-item .nav-link .topppa-tab-memu-content-stitle' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'icon_style_tab',
			[
				'label' => esc_html__('Icon', 'topper-pack'),
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'icon_typo',
				'selector' => '{{WRAPPER}} .advanced-tabs-wrapper li.nav-item .topppa-tab-memu-icon',
			]
		);
		$this->add_responsive_control(
			'icon_color',
			[
				'label' => esc_html__('Color', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .advanced-tabs-wrapper li.nav-item .topppa-tab-memu-icon' => 'color: {{VALUE}}',
					'{{WRAPPER}} .advanced-tabs-wrapper li.nav-item .topppa-tab-memu-icon svg path' => 'fill: {{VALUE}}',
				],
			]
		);
		$this->add_responsive_control(
			'icon_hover_color',
			[
				'label' => esc_html__('Color', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .advanced-tabs-wrapper li.nav-item .nav-link:hover .topppa-tab-memu-icon' => 'color: {{VALUE}}',
					'{{WRAPPER}} .advanced-tabs-wrapper li.nav-item .nav-link.active .topppa-tab-memu-icon' => 'color: {{VALUE}}',
					'{{WRAPPER}} .advanced-tabs-wrapper li.nav-item .nav-link:hover .topppa-tab-memu-icon svg path' => 'fill: {{VALUE}}',
					'{{WRAPPER}} .advanced-tabs-wrapper li.nav-item .nav-link.active .topppa-tab-memu-icon svg path' => 'fill: {{VALUE}}',
				],
			]
		);
		$this->add_responsive_control(
			'icon_margin',
			[
				'label' => esc_html__('Margin', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .advanced-tabs-wrapper li.nav-item .topppa-tab-memu-icon' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'icon_padding',
			[
				'label' => esc_html__('Padding', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .advanced-tabs-wrapper li.nav-item .topppa-tab-memu-icon' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->end_controls_section();

		//========================================//
		//============  CONTENT STYLE ===========//
		//=======================================//
		$this->start_controls_section(
			'content_section',
			[
				'label' => esc_html__('Tab Content', 'topper-pack'),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'main_box_gap',
			[
				'label' => esc_html__('Gap', 'topper-pack'),
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
					'{{WRAPPER}} .advanced-tabs-wrapper .advanced-tab-content' => 'gap: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'main_box_background',
				'types' => ['classic', 'gradient', 'video'],
				'selector' => '{{WRAPPER}} .advanced-tabs-wrapper .advanced-tab-content',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'main_box_border',
				'selector' => '{{WRAPPER}} .advanced-tabs-wrapper .advanced-tab-content',
			]
		);
		$this->add_responsive_control(
			'main_box_border_radius',
			[
				'label' => esc_html__('Border Radius', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .advanced-tabs-wrapper .advanced-tab-content' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'main_box_shadow',
				'selector' => '{{WRAPPER}} .advanced-tabs-wrapper .advanced-tab-content',
			]
		);
		$this->add_responsive_control(
			'tab_content_margin',
			[
				'label' => esc_html__('Margin', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em', 'rem', 'custom'],
				'selectors' => [
					'{{WRAPPER}} .advanced-tabs-wrapper .advanced-tab-content' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'padding',
			[
				'label' => esc_html__('Padding', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em', 'rem', 'custom'],
				'selectors' => [
					'{{WRAPPER}} .advanced-tabs-wrapper .advanced-tab-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->start_controls_tabs(
			'tabs_content_tabs'
		);
		$this->start_controls_tab(
			'tabs_image_tab',
			[
				'label' => esc_html__('Image', 'topper-pack'),
			]
		);
		$this->add_responsive_control(
			'image_height',
			[
				'label' => esc_html__('Height', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SLIDER,
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
				'selectors' => [
					'{{WRAPPER}} .custom-image .tab-custom-image' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'image_width',
			[
				'label' => esc_html__('Width', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SLIDER,
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
				'selectors' => [
					'{{WRAPPER}} .custom-image .tab-custom-image' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'min_image_width',
			[
				'label' => esc_html__('Min Width', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SLIDER,
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
				'selectors' => [
					'{{WRAPPER}} .custom-image .tab-custom-image' => 'min-width: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'object',
			[
				'label' => esc_html__('Object Fit', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'cover',
				'options' => [
					'fill' => esc_html__('Fill', 'topper-pack'),
					'contain' => esc_html__('Contain', 'topper-pack'),
					'cover' => esc_html__('Cover', 'topper-pack'),
					'none' => esc_html__('None', 'topper-pack'),
				],
				'selectors' => [
					'{{WRAPPER}} .custom-image .tab-custom-image img' => 'object-fit: {{VALUE}}',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'image_border',
				'label' => esc_html__('Border', 'topper-pack'),
				'selector' => '{{WRAPPER}} .custom-image .tab-custom-image',
			]
		);
		$this->add_responsive_control(
			'image_border_radius',
			[
				'label' => esc_html__('Border Radius', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .custom-image .tab-custom-image img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'image_margin',
			[
				'label' => esc_html__('Margin', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .custom-image .tab-custom-image' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'image_padding',
			[
				'label' => esc_html__('Padding', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .custom-image .tab-custom-image' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'title_tab',
			[
				'label' => esc_html__('Title', 'topper-pack'),
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'title_typo',
				'label' => __('Typography', 'topper-pack'),
				'selector' => ' {{WRAPPER}} .advanced-tabs-wrapper .advanced-tab-content .advanced-tab-custom-content .advanced-tab-title',
			]
		);
		$this->add_responsive_control(
			'title_color',
			[
				'label' => esc_html__('Color', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .advanced-tabs-wrapper .advanced-tab-content .advanced-tab-custom-content .advanced-tab-title' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_responsive_control(
			'title_margin',
			[
				'label' => esc_html__('Margin', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .advanced-tabs-wrapper .advanced-tab-content .advanced-tab-custom-content .advanced-tab-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'title_padding',
			[
				'label' => esc_html__('Padding', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .advanced-tabs-wrapper .advanced-tab-content .advanced-tab-custom-content .advanced-tab-title' => 'Padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_tab();

		$this->start_controls_tab(
			'content_tab',
			[
				'label' => esc_html__('Description', 'topper-pack'),
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'desc_typo',
				'label' => __('Typography', 'topper-pack'),
				'selector' => ' {{WRAPPER}} .advanced-tab-desc',
			]
		);
		$this->add_responsive_control(
			'desc_color',
			[
				'label' => esc_html__('Color', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .advanced-tab-desc' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_responsive_control(
			'desc_margin',
			[
				'label' => esc_html__('Margin', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .advanced-tab-desc' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'desc_padding',
			[
				'label' => esc_html__('Padding', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .advanced-tab-desc' => 'Padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'list_styles',
			[
				'label' => esc_html__('List Styles', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_responsive_control(
			'list_margin_top',
			[
				'label' => esc_html__('Gap', 'topper-pack'),
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
					'{{WRAPPER}} .advanced-tabs-wrapper .advanced-tab-content .advanced-tab-custom-content .advanced-tab-desc ul' => 'margin-top: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'list_typo',
				'selector' => '{{WRAPPER}} .advanced-tabs-wrapper .advanced-tab-content .advanced-tab-custom-content .advanced-tab-desc ul li',
			]
		);
		$this->add_responsive_control(
			'list_color',
			[
				'label' => esc_html__('Color', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .advanced-tabs-wrapper .advanced-tab-content .advanced-tab-custom-content .advanced-tab-desc ul li' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_responsive_control(
			'list_margin',
			[
				'label' => esc_html__('Margin', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em', 'rem', 'custom'],
				'selectors' => [
					'{{WRAPPER}} .advanced-tabs-wrapper .advanced-tab-content .advanced-tab-custom-content .advanced-tab-desc ul li' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'list_padding',
			[
				'label' => esc_html__('Padding', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em', 'rem', 'custom'],
				'selectors' => [
					'{{WRAPPER}} .advanced-tabs-wrapper .advanced-tab-content .advanced-tab-custom-content .advanced-tab-desc ul li' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();

		// <========================> BOX STYLES <========================>
		$this->start_controls_section(
			'topppa_btn_style',
			[
				'label' => esc_html__('Button Style', 'topper-pack'),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
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
					'{{WRAPPER}} .topppa-btn-wrapper .topppa-btn' => 'flex-direction: {{VALUE}};',
				],
			]
		);
		$this->add_responsive_control(
			'topppa_btn_icon_gap',
			[
				'label' => esc_html__('Icon Gap', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px', '%'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
						'step' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .topppa-btn-wrapper .topppa-btn' => 'gap: {{SIZE}}{{UNIT}};',
				],
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
				'name' => 'topppa_btn_typo',
				'selector' => '{{WRAPPER}} .topppa-btn-wrapper .topppa-btn',
			]
		);

		$this->add_responsive_control(
			'topppa_btn_color',
			[
				'label' => esc_html__('Color', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .topppa-btn-wrapper .topppa-btn' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'topppa_btn_background',
				'types' => ['classic', 'gradient', 'video'],
				'selector' => '{{WRAPPER}} .topppa-btn-wrapper .topppa-btn',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'topppa_btn_border',
				'label' => esc_html__('Border', 'topper-pack'),
				'selector' => '{{WRAPPER}} .topppa-btn-wrapper .topppa-btn',
			]
		);

		$this->add_responsive_control(
			'topppa_btn_border_radius',
			[
				'label' => esc_html__('Border Radius', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .topppa-btn-wrapper .topppa-btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'topppa_btn_box_shadow',
				'label' => esc_html__('Shadow', 'topper-pack'),
				'selector' => '{{WRAPPER}} .topppa-btn-wrapper .topppa-btn',
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
					'{{WRAPPER}} .topppa-btn-wrapper .topppa-btn .btn-icon' => 'width: {{SIZE}}{{UNIT}};',
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
					'{{WRAPPER}} .topppa-btn-wrapper .topppa-btn .btn-icon' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'topppa_btn_icon_content_typography',
				'selector' => '{{WRAPPER}} .topppa-btn-wrapper .topppa-btn .btn-icon',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'topppa_btn_icon_bg',
				'types' => ['classic', 'gradient', 'video'],
				'selector' => '{{WRAPPER}} .topppa-btn-wrapper .topppa-btn .btn-icon',
			]
		);
		$this->add_responsive_control(
			'topppa_btn_icon_border_radius',
			[
				'label' => esc_html__('Border Radius', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .topppa-btn-wrapper .topppa-btn .btn-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'topppa_btn_margin',
			[
				'label' => esc_html__('Margin', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .topppa-btn-wrapper .topppa-btn' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'topppa_btn_padding',
			[
				'label' => esc_html__('Padding', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .topppa-btn-wrapper .topppa-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
				'name' => 'topppa_btn_typography_hover',
				'selector' => '{{WRAPPER}} .topppa-btn-wrapper .topppa-btn:hover',
			]
		);

		$this->add_responsive_control(
			'topppa_btn_color_hover',
			[
				'label' => esc_html__('Color', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .topppa-btn-wrapper .topppa-btn:hover' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'topppa_btn_background_hover',
				'types' => ['classic', 'gradient', 'video'],
				'selector' => '{{WRAPPER}} .topppa-btn-wrapper .topppa-btn:hover',
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
				'selector' => '{{WRAPPER}} .topppa-btn-wrapper .topppa-btn::before, {{WRAPPER}} .topppa-btn-wrapper .topppa-btn::after',
				'condition' => [
					'topppa_btn_styles!' => ['style_three', 'style_six', 'style_seven', 'style_twelve'],
				]
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'topppa_btn_border_hover',
				'label' => esc_html__('Border', 'topper-pack'),
				'selector' => '{{WRAPPER}} .topppa-btn-wrapper .topppa-btn:hover',
			]
		);

		$this->add_responsive_control(
			'topppa_btn_border_radius_hover',
			[
				'label' => esc_html__('Border Radius', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .topppa-btn-wrapper .topppa-btn:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'topppa_btn_box_shadow_hover',
				'label' => esc_html__('Shadow', 'topper-pack'),
				'selector' => '{{WRAPPER}} .topppa-btn-wrapper .topppa-btn:hover',
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
					'{{WRAPPER}} .topppa-btn-wrapper .topppa-btn:hover .btn-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'topppa_btn_icon_hbgcolor',
				'types' => ['classic', 'gradient', 'video'],
				'selector' => '{{WRAPPER}} .topppa-btn-wrapper .topppa-btn:hover .btn-icon',
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
				'selector' => '{{WRAPPER}} .topppa-btn-wrapper .topppa-btn .btn-icon::before',
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
	protected function render()
	{
		$settings = $this->get_settings_for_display();
		$allowed_html = wp_kses_allowed_html('post');
		unset($allowed_html['script'], $allowed_html['iframe'], $allowed_html['div'], $allowed_html['p']);
		// HTML Tag
		$html_tag = isset($settings['html_tag']) ? $settings['html_tag'] : 'h3';
		$unique = wp_rand(350, 540); // phpcs:ignore WordPress.WP.AlternativeFunctions.rand_rand

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
		<div class="advanced-tabs-wrapper <?php echo esc_attr($class); ?>">
			<div class="advanced-tabs-buttons">
				<div class="<?php echo esc_attr($settings['enable_container'] == 'yes' ? 'container' : 'container-fluid'); ?>">
					<ul class="nav nav-tabs topppa-advanced-tabs-menu" id="advanced_tab<?php echo esc_attr($unique); ?>"
						role="tablist">
						<?php $count = 0;
						foreach ($settings['advanced_tab_items'] as $tablist):
							$count++;
							$enable_bg = !empty($tablist['enable_button_bg']) && $tablist['enable_button_bg'] === 'yes';
							$button_image = !empty($tablist['button_image']['id']) ? esc_url(wp_get_attachment_image_url($tablist['button_image']['id'], 'full')) : '';
							$active_class = !empty($tablist['advanced_tabs_active']) && $tablist['advanced_tabs_active'] === 'yes' ? 'active' : '';
							?>
							<li class="nav-item" role="presentation">
								<button id="advanced-tab-<?php echo esc_attr($unique . $count); ?>"
									class="nav-link <?php echo esc_attr($active_class); ?>" data-bs-toggle="tab"
									data-bs-target="#topppa-advanced-tab-body-<?php echo esc_attr($unique . $count); ?>"
									type="button" role="tab"
									aria-controls="topppa-advanced-tab-body-<?php echo esc_attr($unique . $count); ?>"
									aria-selected="true" <?php if ($enable_bg && $button_image): ?>
										style="background-image: url(<?php echo esc_url($button_image); ?>);" <?php endif; ?>>
									<?php if (!empty($tablist['advanced_tabs_icon']['value'])): ?>
										<span class="topppa-tab-memu-icon">
											<?php \Elementor\Icons_Manager::render_icon($tablist['advanced_tabs_icon'], ['aria-hidden' => 'true']); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- Already escaped by elementor 
															?>
										</span>
									<?php endif; ?>
									<span class="topppa-tab-memu-content">
										<?php if (!empty($tablist['advanced_tabs_title'])): ?>
											<span
												class="topppa-tab-memu-content-title"><?php echo esc_html($tablist['advanced_tabs_title']); ?></span>
										<?php endif; ?>
										<?php if (!empty($tablist['advanced_tabs_stitle'])): ?>
											<span
												class="topppa-tab-memu-content-stitle"><?php echo esc_html($tablist['advanced_tabs_stitle']); ?></span>
										<?php endif; ?>
									</span>

								</button>
							</li>
						<?php endforeach; ?>
					</ul>
				</div>
			</div>

			<div class="advanced-tabs-content-wrapper">
				<div class="tab-content" id="topppa_advanced_tab_content<?php echo esc_attr($unique); ?>">
					<?php $count = 0;
					foreach ($settings['advanced_tab_items'] as $tablist):
						$count++;
						$active_class = $tablist['advanced_tabs_active'] == 'yes' ? 'show active' : '';
						$image_class = !empty($tablist['image']['url']) ? 'custom-image' : '';
						?>
						<div class="tab-pane fade <?php echo esc_attr($active_class); ?>"
							id="topppa-advanced-tab-body-<?php echo esc_attr($unique . $count); ?>" role="tabpanel"
							aria-labelledby="advanced-tab-<?php echo esc_attr($unique . $count); ?>">
							<?php if ($tablist['topppa_advanced_tab_content_source'] == 'elementor' && !empty($tablist['template_id'])): ?>
								<?php echo \Elementor\Plugin::instance()->frontend->get_builder_content_for_display($tablist['template_id']); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- Already escaped by elementor 
												?>
							<?php else: ?>
								<div class="advanced-tab-content <?php echo esc_attr($image_class); ?>">
									<?php if (!empty($tablist['image']['url'])): ?>
										<div class="tab-custom-image">
											<?php echo wp_get_attachment_image($tablist['image']['id'], 'full'); ?>
										</div>
									<?php endif; ?>

									<?php if ($tablist['enable_content_box'] == 'yes'): ?>
										<div class="advanced-tab-custom-content">
											<?php if (!empty($tablist['tab_title'])): ?>
												<<?php echo esc_attr($html_tag); ?> class="advanced-tab-title">
													<?php echo esc_html($tablist['tab_title']); ?>
												</<?php echo esc_attr($html_tag); ?>>
											<?php endif; ?>

											<?php if (!empty($tablist['tab_desc'])): ?>
												<div class="advanced-tab-desc">
													<?php echo wp_kses_post($tablist['tab_desc'], $allowed_html); ?>
												</div>
											<?php endif; ?>

											<?php if ($tablist['enable_button'] == 'yes' && !empty($tablist['topppa_btn_text'])): ?>
												<div class="topppa-btn-wrapper <?php echo esc_attr($btn_class); ?>">
													<?php if (!empty($tablist['topppa_btn_link']['url'])): ?>
														<?php $this->add_link_attributes('topppa_btn_link', $tablist['topppa_btn_link']); ?>
													<?php endif; ?>
													<a <?php echo $this->get_render_attribute_string('topppa_btn_link'); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- Already escaped by elementor 
																			?> class="topppa-btn">
														<span class="top-btn-text top-btn-text-v3">
															<?php echo esc_html($tablist['topppa_btn_text']); ?>
														</span>
														<?php if ($class === 'style_three'): ?>
															<span class="bottom-btn-text bottom-btn-text-v3">
																<?php echo esc_html($tablist['topppa_btn_text']); ?>
															</span>
														<?php endif; ?>

														<?php if ($tablist['topppa_show_icon'] == 'yes' && !empty($tablist['topppa_btn_icon'])): ?>
															<div class="btn-icon">
																<?php \Elementor\Icons_Manager::render_icon($tablist['topppa_btn_icon'], ['aria-hidden' => 'true']); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- Already escaped by elementor 
																							?>
															</div>
														<?php endif; ?>
													</a>
												</div>
											<?php endif; ?>
										</div>
									<?php endif; ?>
								</div>
							<?php endif; ?>
						</div>
					<?php endforeach; ?>
				</div>
			</div>
		</div>
		<?php
	}
}
