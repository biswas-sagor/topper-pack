<?php

use TopperPack\Trait_Loader\Global_Component_Loader;
use \TopperPack\Includes\Controls\Controls_Manager as TopperPack_Controls_Manager;

if (! defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}

/**
 * Elementor topppa Sticky Header Widget.
 *
 * Elementor widget that inserts an embbedable content into the page, from any given URL.
 *
 * @since 1.0.0
 */
class TOPPPA_Sticky_Header_Widget extends \Elementor\Widget_Base {

	/**
	 * Get widget name.
	 *
	 * Retrieve Sticky Header widget widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'topppa_sticky_header';
	}

	/**
	 * Get widget title.
	 *
	 * Retrieve Sticky Header widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget title.
	 */
	public function get_title() {
		return TOPPPA_EPWB . esc_html__('Topppa Sticky Header', 'topper-pack');
	}

	/**
	 * Get widget icon.
	 *
	 * Retrieve Sticky Header widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-heading';
	}

	/**
	 * Get widget categories.
	 *
	 * Retrieve the list of categories the Sticky Header widget belongs to.
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
	 * Retrieve the list of keywords the Sticky Header widget belongs to.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return array Widget keywords.
	 */
	public function get_keywords() {
		return ['topppa', 'widget', 'Sticky Header', 'topperpack'];
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
		return 'https://doc.topperpack.com/docs/header-footer-widgets/logo/';
	}
	/**
	 * Elementor Templates List
	 * return array
	 */
	public function topppa_elementor_template() {
		$templates = \Elementor\Plugin::instance()->templates_manager->get_source('local')->get_items();
		$types     = array();
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
	 * Register Sticky Header Widget 1 widget controls.
	 *
	 * Add input fields to allow the user to customize the widget settings.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function register_controls() {
		$this->start_controls_section(
			'content_options',
			[
				'label' => esc_html__('Content', 'topper-pack'),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		// --- Small Title ---
		$this->add_control(
			'enable_small_title',
			[
				'label' => esc_html__('Show Small Title', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Show', 'topper-pack'),
				'label_off' => esc_html__('Hide', 'topper-pack'),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);
		$this->add_control(
			'stitle',
			[
				'label'   => esc_html__('Small Title', 'topper-pack'),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__('Why Choose Us?', 'topper-pack'),
				'label_block' => true,
				'condition' => [
					'enable_small_title' => 'yes',
				],
			]
		);
		$this->add_control(
			'enable_after_before',
			[
				'label' => esc_html__('Show Separator', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Show', 'topper-pack'),
				'label_off' => esc_html__('Hide', 'topper-pack'),
				'return_value' => 'yes',
				'default' => 'no',
				'condition' => [
					'enable_small_title' => 'yes'
				]
			]
		);
		$this->add_control(
			'select_separator',
			[
				'label' => esc_html__('Select Separator', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => '',
				'options' => [
					'' => esc_html__('Default ', 'topper-pack'),
					'icon' => esc_html__('Icon', 'topper-pack'),
					'line' => esc_html__('Line', 'topper-pack'),
				],
				'condition' => [
					'enable_after_before' => 'yes',
				],
			]
		);
		$this->add_control(
			'ricon',
			[
				'label'   => esc_html__('Right Icon', 'topper-pack'),
				'type'    => \Elementor\Controls_Manager::ICONS,
				'default' => [
					'value' => 'far fa-dot-circle',
					'library' => 'fa-solid',
				],
				'condition' => [
					'select_separator' => 'icon',
					'enable_after_before' => 'yes',
				],
			]
		);
		$this->add_control(
			'licon',
			[
				'label'   => esc_html__('Left Icon', 'topper-pack'),
				'type'    => \Elementor\Controls_Manager::ICONS,
				'default' => [
					'value' => 'far fa-dot-circle',
					'library' => 'fa-solid',
				],
				'condition' => [
					'select_separator' => 'icon',
					'enable_after_before' => 'yes',
				],
			]
		);
		// --- Main Title ---
		$this->add_control(
			'enable_title',
			[
				'label' => esc_html__('Show Title', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Show', 'topper-pack'),
				'label_off' => esc_html__('Hide', 'topper-pack'),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);
		$this->add_control(
			'title',
			[
				'label'       => esc_html__('Main Title', 'topper-pack'),
				'type'        => \Elementor\Controls_Manager::WYSIWYG,
				'default'     => esc_html__('Service We Can Provide', 'topper-pack'),
				'dynamic'     => ['active' => true],
				'description' => esc_html__('Use <strong> tag for gradient color in the middle of the text.', 'topper-pack'),
				'condition'   => [
					'enable_title' => 'yes'
				]
			]
		);
		$this->add_control(
			'title_tag',
			[
				'label'   => __('Select Title Tag', 'topper-pack'),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'default' => 'h2',
				'options' => [
					'h1'   => __('H1', 'topper-pack'),
					'h2'   => __('H2', 'topper-pack'),
					'h3'   => __('H3', 'topper-pack'),
					'h4'   => __('H4', 'topper-pack'),
					'h5'   => __('H5', 'topper-pack'),
					'h6'   => __('H6', 'topper-pack'),
					'span' => __('Span', 'topper-pack'),
					'p'    => __('P', 'topper-pack'),
					'div'  => __('Div', 'topper-pack'),
				],
				'condition'   => [
					'enable_title' => 'yes'
				]
			]
		);
		$this->add_control(
			'elable_description',
			[
				'label' => esc_html__('Enable Description', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Show', 'topper-pack'),
				'label_off' => esc_html__('Hide', 'topper-pack'),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);
		$this->add_control(
			'description',
			[
				'label'       => esc_html__('Description', 'topper-pack'),
				'type'        => \Elementor\Controls_Manager::WYSIWYG,
				'default' => esc_html__('Use high-quality photos of clients (with permission) and design elements to make the testimonial section visually appealing  If possible, include', 'topper-pack'),
				'dynamic'     => [
					'active' => true,
				],
				'condition' => [
					'elable_description' => 'yes',
				]
			]
		);
		$this->add_control(
			'content_source',
			[
				'label' => esc_html__('Content Source', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_control(
			'topppa_advanced_tab_content_source',
			[
				'label' => esc_html__('Content Source', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'custom',
				'options' => [
					'custom'  => esc_html__('Content', 'topper-pack'),
					'elementor' => esc_html__('Template', 'topper-pack'),
				],
			]
		);
		$this->add_control(
			'template_id',
			[
				'label'     => __('Content Title', 'topper-pack'),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'default'   => '0',
				'options'   => $this->topppa_elementor_template(),
				'condition' => [
					'topppa_advanced_tab_content_source' => "elementor"
				],
				'separator' => 'before',
			]
		);
		$this->add_control(
			'template_description',
			[
				'label'       => esc_html__('Description', 'topper-pack'),
				'type'        => \Elementor\Controls_Manager::WYSIWYG,
				'default' => esc_html__('Use high-quality photos of clients (with permission) and design elements to make the testimonial section visually appealing  If possible, include', 'topper-pack'),
				'dynamic'     => [
					'active' => true,
				],
				'condition' => [
					'topppa_advanced_tab_content_source' => "custom"
				]
			]
		);
		$this->end_controls_section();
		$this->start_controls_section(
			'section_box',
			[
				'label' => esc_html__('Content Box Style', 'topper-pack'),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'lcontent_box_width',
			[
				'label' => esc_html__('Left Content Width', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['%', 'em', 'rem', 'custom'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1380,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .topppa-scroll-content-area' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'rcontent_box_width',
			[
				'label' => esc_html__('Right Content Width', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['%', 'em', 'rem', 'custom'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1380,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .topppa-scrol-image-area' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'section_box_aligment',
			[
				'label'     => __('Alignment', 'topper-pack'),
				'type'      => \Elementor\Controls_Manager::CHOOSE,
				'options'   => [
					'left'    => [
						'title' => __('Left', 'topper-pack'),
						'icon'  => 'eicon-text-align-left',
					],
					'center'  => [
						'title' => __('Center', 'topper-pack'),
						'icon'  => 'eicon-text-align-center',
					],
					'right'   => [
						'title' => __('Right', 'topper-pack'),
						'icon'  => 'eicon-text-align-left',
					],
				],
				'toggle'    => true,
				'selectors' => [
					'{{WRAPPER}} .topppa-scroll-content-area' => 'text-align: {{VALUE}}',
				],
			]
		);
		$this->add_responsive_control(
			'box_margin',
			[
				'label' => esc_html__('Margin', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em', 'rem', 'custom'],
				'selectors' => [
					'{{WRAPPER}} ..topppa-scroll-content-area' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'box_padding',
			[
				'label' => esc_html__('Padding', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em', 'rem', 'custom'],
				'selectors' => [
					'{{WRAPPER}} .topppa-scroll-content-area' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->start_controls_tabs(
			'content_style_tabs'
		);

		$this->start_controls_tab(
			'style_Subtitle_tab',
			[
				'label' => esc_html__('Subtitle', 'topper-pack'),
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'subtitle_title_typo',
				'label' => __('Typography', 'topper-pack'),
				'selector' => '{{WRAPPER}} .topppa-section-small-title',
			]
		);

		$this->add_responsive_control(
			'subtitle_color',
			[
				'label'       => esc_html__('Color', 'topper-pack'),
				'type'        => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .topppa-section-small-title' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name'     => 'box_bg',
				'label'    => esc_html__('Background', 'topper-pack'),
				'types'    => ['classic', 'gradient', 'video'],
				'selector' => '{{WRAPPER}} .topppa-section-small-title',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name'     => 'subtitle_border',
				'label'    => esc_html__('Border', 'topper-pack'),
				'selector' => '{{WRAPPER}} .topppa-section-small-title',
			]
		);
		$this->add_responsive_control(
			'subtitle_border_radius',
			[
				'label'      => esc_html__('Border Radius', 'topper-pack'),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors'  => [
					'{{WRAPPER}} .topppa-section-small-title' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'subtitle_shadow',
				'label'    => esc_html__('Box Shadow', 'topper-pack'),
				'selector' => '{{WRAPPER}} .topppa-section-small-title',
			]
		);

		$this->add_responsive_control(
			'subtitle_margin',
			[
				'label'      => esc_html__('Margin', 'topper-pack'),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors'  => [
					'{{WRAPPER}} .topppa-section-small-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'subtitle_padding',
			[
				'label'      => esc_html__('Padding', 'topper-pack'),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors'  => [
					'{{WRAPPER}} .topppa-section-small-title' => 'Padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'subtitle_separator',
			[
				'label' => __('Separator Settings', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => [
					'enable_after_before' => 'yes',
				],
			]
		);
		$this->add_control(
			'separator_color',
			[
				'label'     => esc_html__('Color', 'topper-pack'),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .topppa-section-small-title.line::before, {{WRAPPER}} .topppa-section-small-title.line::after' => 'background-color: {{VALUE}};',
				],
				'condition' => [
					'select_separator' => 'line',
					'enable_after_before' => 'yes',
				],
			]
		);

		$this->add_responsive_control(
			'separator_width',
			[
				'label'     => esc_html__('Width', 'topper-pack'),
				'type'      => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'range'     => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .topppa-section-small-title.line::before, {{WRAPPER}} .topppa-section-small-title.line::after' => 'width: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'select_separator' => 'line',
					'enable_after_before' => 'yes',
				],
			]
		);
		$this->add_responsive_control(
			'separator_height',
			[
				'label'     => esc_html__('Height', 'topper-pack'),
				'type'      => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'range'     => [
					'px' => [
						'min' => 0,
						'max' => 10,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .topppa-section-small-title.line::before, {{WRAPPER}} .topppa-section-small-title.line::after' => 'height: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'select_separator' => 'line',
					'enable_after_before' => 'yes',
				],
			]
		);

		$this->add_responsive_control(
			'separator_spacing',
			[
				'label'     => esc_html__('Spacing', 'topper-pack'),
				'type'      => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'range'     => [
					'px' => [
						'min' => 0,
						'max' => 50,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .topppa-section-small-title.line::before' => 'margin-right: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .topppa-section-small-title.line::after' => 'margin-left: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'select_separator' => 'line',
					'enable_after_before' => 'yes',
				],
			]
		);
		$this->add_control(
			'icon_color',
			[
				'label'     => esc_html__('Color', 'topper-pack'),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .topppa-section-small-title.icons .separator-icon' => 'color: {{VALUE}};',
				],
				'condition' => [
					'select_separator' => 'icon',
					'enable_after_before' => 'yes',
				],
			]
		);

		$this->add_responsive_control(
			'icon_size',
			[
				'label'     => esc_html__('Size', 'topper-pack'),
				'type'      => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'range'     => [
					'px' => [
						'min' => 0,
						'max' => 50,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .topppa-section-small-title.icons .separator-icon' => 'font-size: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'select_separator' => 'icon',
					'enable_after_before' => 'yes',
				],
			]
		);

		$this->add_responsive_control(
			'icon_spacing',
			[
				'label'     => esc_html__('Spacing', 'topper-pack'),
				'type'      => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'range'     => [
					'px' => [
						'min' => 0,
						'max' => 50,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .topppa-section-small-title.icons span:first-child' => 'margin-right: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .topppa-section-small-title.icons span:last-child' => 'margin-left: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'select_separator' => 'icon',
					'enable_after_before' => 'yes',
				],
			]
		);
		$this->end_controls_tab();

		$this->start_controls_tab(
			'style_Title_tab',
			[
				'label' => esc_html__('Title', 'topper-pack'),
			]
		);
		$this->add_control(
			'title_color',
			[
				'label'     => esc_html__('Title Color', 'topper-pack'),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .topppa-section-title' => 'color: {{VALUE}};',
				],
				'condition' => [
					'text_effect' => 'none',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'title_typography',
				'label'    => esc_html__('Typography', 'topper-pack'),
				'selector' => '{{WRAPPER}} .topppa-section-title',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'text_shadow',
				'selector' => '{{WRAPPER}} .topppa-section-title',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Text_Stroke::get_type(),
			[
				'name' => 'text_stroke',
				'selector' => '{{WRAPPER}} .topppa-section-title',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Css_Filter::get_type(),
			[
				'name' => 'custom_css_filters',
				'selector' => '{{WRAPPER}} .topppa-section-title',
			]
		);
		$this->add_control(
			'text_effect',
			[
				'label' => esc_html__('Text Effect', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'none',
				'options' => [
					'none' => esc_html__('None', 'topper-pack'),
					'gradient' => esc_html__('Gradient', 'topper-pack'),
				],
			]
		);
		$this->add_control(
			'gradient_start_color',
			[
				'label' => esc_html__('Color', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'condition' => [
					'text_effect' => 'gradient',
				],
			]
		);

		$this->add_control(
			'gradient_start_location',
			[
				'label' => esc_html__('Location', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['%'],
				'range' => [
					'%' => [
						'min' => 0,
						'max' => 100,
						'step' => 1,
					],
				],
				'default' => [
					'unit' => '%',
					'size' => 0,
				],
				'condition' => [
					'text_effect' => 'gradient',
				],
			]
		);

		$this->add_control(
			'gradient_end_color',
			[
				'label' => esc_html__('Second Color', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'condition' => [
					'text_effect' => 'gradient',
				],
			]
		);

		$this->add_control(
			'gradient_end_location',
			[
				'label' => esc_html__('Location', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['%'],
				'range' => [
					'%' => [
						'min' => 0,
						'max' => 100,
						'step' => 1,
					],
				],
				'default' => [
					'unit' => '%',
					'size' => 100,
				],
				'condition' => [
					'text_effect' => 'gradient',
				],
			]
		);

		$this->add_control(
			'gradient_type',
			[
				'label' => esc_html__('Type', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'linear',
				'options' => [
					'linear' => esc_html__('Linear', 'topper-pack'),
					'radial' => esc_html__('Radial', 'topper-pack'),
				],
				'condition' => [
					'text_effect' => 'gradient',
				],
			]
		);

		$this->add_control(
			'gradient_angle',
			[
				'label' => esc_html__('Angle', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['deg'],
				'range' => [
					'deg' => [
						'min' => 0,
						'max' => 360,
						'step' => 1,
					],
				],
				'default' => [
					'unit' => 'deg',
					'size' => 180,
				],
				'condition' => [
					'text_effect' => 'gradient',
					'gradient_type' => 'linear',
				],

			]
		);
		$this->add_control(
			'strong_heading',
			[
				'label' => esc_html__('Strong Tag Settings', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'strong_title_typography',
				'label'    => esc_html__('Typography', 'topper-pack'),
				'selector' => '{{WRAPPER}} .topppa-section-title strong',
				'separator' => 'before',

			]
		);
		$this->add_responsive_control(
			'strong_color',
			[
				'label' => esc_html__('Color', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .topppa-section-title strong' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'strong_box_bg',
				'label' => esc_html__('Background', 'topper-pack'),
				'types' => ['classic', 'gradient', 'video'],
				'selector' => '{{WRAPPER}} .topppa-section-title strong',
				'condition' => [
					'strong_gradient_effect' => 'none',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'strong_border',
				'selector' => '{{WRAPPER}} .topppa-section-title strong',
			]
		);
		$this->add_responsive_control(
			'strong_border_radius',
			[
				'label' => esc_html__('Border Radius', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .topppa-section-title strong' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'strong_gradient_effect',
			[
				'label' => esc_html__('Gradient Effect', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'none',
				'options' => [
					'none' => esc_html__('None', 'topper-pack'),
					'gradient' => esc_html__('Gradient', 'topper-pack'),
					'image' => esc_html__('Image', 'topper-pack'),
				],
			]
		);

		$this->add_control(
			'strong_image',
			[
				'label' => esc_html__('Image', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'condition' => [
					'strong_gradient_effect' => 'image',
				],
			]
		);

		$this->add_control(
			'strong_image_size',
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
					'strong_gradient_effect' => 'image',
				],
			]
		);

		$this->add_control(
			'strong_image_position',
			[
				'label' => esc_html__('Background Position', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'center center',
				'options' => [
					'center center' => esc_html__('Center Center', 'topper-pack'),
					'center left' => esc_html__('Center Left', 'topper-pack'),
					'center right' => esc_html__('Center Right', 'topper-pack'),
					'top center' => esc_html__('Top Center', 'topper-pack'),
					'top left' => esc_html__('Top Left', 'topper-pack'),
					'top right' => esc_html__('Top Right', 'topper-pack'),
					'bottom center' => esc_html__('Bottom Center', 'topper-pack'),
					'bottom left' => esc_html__('Bottom Left', 'topper-pack'),
					'bottom right' => esc_html__('Bottom Right', 'topper-pack'),
				],
				'selectors' => [
					'{{WRAPPER}} .topppa-section-title strong.topppa-strong-image' => 'background-position: {{VALUE}};',
				],
				'condition' => [
					'strong_gradient_effect' => 'image',
				],
			]
		);

		$this->add_control(
			'strong_image_repeat',
			[
				'label' => esc_html__('Background Repeat', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'no-repeat',
				'options' => [
					'no-repeat' => esc_html__('No Repeat', 'topper-pack'),
					'repeat' => esc_html__('Repeat', 'topper-pack'),
					'repeat-x' => esc_html__('Repeat X', 'topper-pack'),
					'repeat-y' => esc_html__('Repeat Y', 'topper-pack'),
				],
				'selectors' => [
					'{{WRAPPER}} .topppa-section-title strong.topppa-strong-image' => 'background-repeat: {{VALUE}};',
				],
				'condition' => [
					'strong_gradient_effect' => 'image',
				],
			]
		);

		$this->add_control(
			'strong_image_size_control',
			[
				'label' => esc_html__('Background Size', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'cover',
				'options' => [
					'auto' => esc_html__('Auto', 'topper-pack'),
					'cover' => esc_html__('Cover', 'topper-pack'),
					'contain' => esc_html__('Contain', 'topper-pack'),
				],
				'selectors' => [
					'{{WRAPPER}} .topppa-section-title strong.topppa-strong-image' => 'background-size: {{VALUE}};',
				],
				'condition' => [
					'strong_gradient_effect' => 'image',
				],
			]
		);

		$this->add_control(
			'strong_gradient_start_color',
			[
				'label' => esc_html__('Gradient Start Color', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'condition' => [
					'strong_gradient_effect' => 'gradient',
				],
			]
		);

		$this->add_control(
			'strong_gradient_end_color',
			[
				'label' => esc_html__('Gradient End Color', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'condition' => [
					'strong_gradient_effect' => 'gradient',
				],
			]
		);

		$this->add_control(
			'strong_gradient_type',
			[
				'label' => esc_html__('Gradient Type', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'linear',
				'options' => [
					'linear' => esc_html__('Linear', 'topper-pack'),
					'radial' => esc_html__('Radial', 'topper-pack'),
				],
				'condition' => [
					'strong_gradient_effect' => 'gradient',
				],
			]
		);

		$this->add_control(
			'strong_gradient_angle',
			[
				'label' => esc_html__('Gradient Angle', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['deg'],
				'range' => [
					'deg' => [
						'min' => 0,
						'max' => 360,
						'step' => 1,
					],
				],
				'default' => [
					'unit' => 'deg',
					'size' => 180,
				],
				'condition' => [
					'strong_gradient_effect' => 'gradient',
					'strong_gradient_type' => 'linear',
				],
			]
		);

		$this->add_control(
			'strong_gradient_start_location',
			[
				'label' => esc_html__('Gradient Start Location', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['%'],
				'range' => [
					'%' => [
						'min' => 0,
						'max' => 100,
						'step' => 1,
					],
				],
				'default' => [
					'unit' => '%',
					'size' => 0,
				],
				'condition' => [
					'strong_gradient_effect' => 'gradient',
				],
			]
		);

		$this->add_control(
			'strong_gradient_end_location',
			[
				'label' => esc_html__('Gradient End Location', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['%'],
				'range' => [
					'%' => [
						'min' => 0,
						'max' => 100,
						'step' => 1,
					],
				],
				'default' => [
					'unit' => '%',
					'size' => 100,
				],
				'condition' => [
					'strong_gradient_effect' => 'gradient',
				],
			]
		);
		$this->add_responsive_control(
			'title_margin',
			[
				'label' => esc_html__('Margin', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors' => [
					'{{WRAPPER}} .topppa-section-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'before',
			]
		);
		$this->add_responsive_control(
			'title_padding',
			[
				'label' => esc_html__('Padding', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors' => [
					'{{WRAPPER}} .topppa-section-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
				'name' => 'dec_typo',
				'label' => esc_html__('Typography', 'topper-pack'),
				'selector' => '{{WRAPPER}} .topppa-section-description',
			]
		);
		$this->add_responsive_control(
			'dec_color',
			[
				'label' => esc_html__('Color', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .topppa-section-description' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_responsive_control(
			'dec_margin',
			[
				'label' => esc_html__('Margin', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .topppa-section-description' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'dec_padding',
			[
				'label' => esc_html__('Padding', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .topppa-section-description' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();
		$this->start_controls_section(
			'template_body_text',
			[
				'label' => esc_html__('Template Body Text', 'topper-pack'),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
				'condition' => [
					'topppa_advanced_tab_content_source' => "custom"
				]
			]
		);
		$this->add_responsive_control(
			'template_body_text_align',
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
					'{{WRAPPER}} .topppa-scrol-template-body' => 'text-align: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'template_body_desc_typo',
				'selector' => '{{WRAPPER}} .topppa-scrol-template-body',
			]
		);
		$this->add_responsive_control(
			'template_body_desc_color',
			[
				'label'     => esc_html__('Color', 'topper-pack'),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .topppa-scrol-template-body' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_responsive_control(
			'template_body_desc_margin',
			[
				'label'      => esc_html__('Margin', 'topper-pack'),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors'  => [
					'{{WRAPPER}} .topppa-scrol-template-body' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'template_body_desc_padding',
			[
				'label'      => esc_html__('Padding', 'topper-pack'),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors'  => [
					'{{WRAPPER}} .topppa-scrol-template-body' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
		$allowed_html = wp_kses_allowed_html('post');
		unset($allowed_html['script'], $allowed_html['iframe'], $allowed_html['div'], $allowed_html['p']);
		$style_classes = [
			'icon' => 'icons',
			'line' => 'line',
		];
		$class = isset($settings['select_separator']) && isset($style_classes[$settings['select_separator']])
			? $style_classes[$settings['select_separator']]
			: '';

		$effect_class = !empty($settings['text_effect']) ? 'effect-' . esc_attr($settings['text_effect']) : '';
		$gradient_class = '';
		$strong_gradient_class = '';

		if ('gradient' === $settings['text_effect']) {
			$gradient_start = !empty($settings['gradient_start_color']) ? esc_attr($settings['gradient_start_color']) : '';
			$gradient_end = !empty($settings['gradient_end_color']) ? esc_attr($settings['gradient_end_color']) : '';
			$gradient_type = !empty($settings['gradient_type']) ? esc_attr($settings['gradient_type']) : 'linear';
			$gradient_angle = !empty($settings['gradient_angle']['size']) ? esc_attr($settings['gradient_angle']['size']) : '180';
			$start_location = !empty($settings['gradient_start_location']['size']) ? esc_attr($settings['gradient_start_location']['size']) : '0';
			$end_location = !empty($settings['gradient_end_location']['size']) ? esc_attr($settings['gradient_end_location']['size']) : '100';

			if (!empty($gradient_start) && !empty($gradient_end)) {
				$gradient_class = 'topppa-gradient-text topppa-gradient-' . $gradient_type;

				$unique_class = 'topppa-gradient-' . md5(esc_attr($gradient_start) . esc_attr($gradient_end) . esc_attr($gradient_angle) . esc_attr($start_location) . esc_attr($end_location));
				$gradient_class .= ' ' . esc_attr($unique_class);

				echo '<style>
                    .' . esc_attr($unique_class) . ' {
                        background-image: ' . ($gradient_type === 'linear' ?
					'linear-gradient(' . esc_attr($gradient_angle) . 'deg, ' . esc_attr($gradient_start) . ' ' . esc_attr($start_location) . '%, ' . esc_attr($gradient_end) . ' ' . esc_attr($end_location) . '%)' :
					'radial-gradient(' . esc_attr($gradient_start) . ' ' . esc_attr($start_location) . '%, ' . esc_attr($gradient_end) . ' ' . esc_attr($end_location) . '%)') . ';
                        color: ' . esc_attr($gradient_start) . ';
                    }
                </style>';
			}
		}

		// Handle strong tag gradient
		if ('gradient' === $settings['strong_gradient_effect']) {
			$strong_gradient_start = !empty($settings['strong_gradient_start_color']) ? esc_attr($settings['strong_gradient_start_color']) : '';
			$strong_gradient_end = !empty($settings['strong_gradient_end_color']) ? esc_attr($settings['strong_gradient_end_color']) : '';
			$strong_gradient_type = !empty($settings['strong_gradient_type']) ? esc_attr($settings['strong_gradient_type']) : 'linear';
			$strong_gradient_angle = !empty($settings['strong_gradient_angle']['size']) ? esc_attr($settings['strong_gradient_angle']['size']) : '180';
			$strong_start_location = !empty($settings['strong_gradient_start_location']['size']) ? esc_attr($settings['strong_gradient_start_location']['size']) : '0';
			$strong_end_location = !empty($settings['strong_gradient_end_location']['size']) ? esc_attr($settings['strong_gradient_end_location']['size']) : '100';

			if (!empty($strong_gradient_start) && !empty($strong_gradient_end)) {
				$strong_gradient_class = 'topppa-strong-gradient topppa-strong-gradient-' . esc_attr($strong_gradient_type);

				$unique_strong_class = 'topppa-strong-gradient-' . md5(esc_attr($strong_gradient_start) . esc_attr($strong_gradient_end) . esc_attr($strong_gradient_angle) . esc_attr($strong_start_location) . esc_attr($strong_end_location));
				$strong_gradient_class .= ' ' . esc_attr($unique_strong_class);

				echo '<style>
                    .' . esc_attr($unique_strong_class) . ' {
                        background-image: ' . ($strong_gradient_type === 'linear' ?
					'linear-gradient(' . esc_attr($strong_gradient_angle) . 'deg, ' . esc_attr($strong_gradient_start) . ' ' . esc_attr($strong_start_location) . '%, ' . esc_attr($strong_gradient_end) . ' ' . esc_attr($strong_end_location) . '%)' :
					'radial-gradient(' . esc_attr($strong_gradient_start) . ' ' . esc_attr($strong_start_location) . '%, ' . esc_attr($strong_gradient_end) . ' ' . esc_attr($strong_end_location) . '%)') . ';
                        color: ' . esc_attr($strong_gradient_start) . ';
                    }
                </style>';
			}
		} elseif ('image' === $settings['strong_gradient_effect'] && !empty($settings['strong_image']['url'])) {
			$strong_image_class = 'topppa-strong-image';
			$image_url = $settings['strong_image']['url'];

			// Add inline style only for the background image
			echo '<style>
                .topppa-strong-image {
                    background-image: url("' . esc_url($image_url) . '");
                }
            </style>';
		}

?>
		<div class="topppa-scroll-section">
			<div class="row align-items-start">
				<div class="col-lg-5 col-md-12 topppa-scroll-content-area">
					<?php if (!empty($settings['stitle']) && ('yes' === $settings['enable_small_title'])) : ?>
						<div class="topppa-section-small-title <?php echo esc_attr($class); ?>">
							<?php if (isset($settings['ricon']) && !empty($settings['ricon']['value'])) : ?>
								<span class="separator-icon"><?php \Elementor\Icons_Manager::render_icon($settings['ricon'], ['aria-hidden' => 'true']); ?>
								</span>
							<?php endif; ?>
							<?php echo esc_html($settings['stitle']); ?>
							<?php if (isset($settings['licon']) && !empty($settings['licon']['value'])) : ?>
								<span class="separator-icon">
									<?php \Elementor\Icons_Manager::render_icon($settings['licon'], ['aria-hidden' => 'true']); ?>
								</span>
							<?php endif; ?>
						</div>
					<?php endif ?>
					<?php if (!empty($settings['title']) && ('yes' === $settings['enable_title'])) : ?>
						<<?php echo esc_attr($settings['title_tag'] ?? 'h2'); ?> class="topppa-section-title <?php echo esc_attr($effect_class); ?> <?php echo esc_attr($gradient_class); ?>">
							<?php
							if (!empty($settings['title'])) {
								$title_content = $settings['title'];

								// If strong gradient is enabled, wrap strong tags with a span
								if ('gradient' === $settings['strong_gradient_effect'] && !empty($strong_gradient_class)) {
									$title_content = preg_replace(
										'/<strong>(.*?)<\/strong>/',
										'<strong class="' . esc_attr($strong_gradient_class) . '">$1</strong>',
										$title_content
									);
								} elseif ('image' === $settings['strong_gradient_effect'] && !empty($settings['strong_image']['url'])) {
									$title_content = preg_replace(
										'/<strong>(.*?)<\/strong>/',
										'<strong class="topppa-strong-image">$1</strong>',
										$title_content
									);
								}

								echo wp_kses($title_content, $allowed_html);
							}
							?>
							<?php if (topppa_can_use_premium_features() && 'yes' === ($settings['show_typewrite_title'] ?? 'no') && !empty($settings['typewrite_text'])) : ?>
								<?php
								$typewrite_texts = array_map(function ($settings) {
									return $settings['text'];
								}, $settings['typewrite_text']);
								$has_multiple_items = count($typewrite_texts) > 1;

								// Add typewrite gradient styles if enabled
								if ($settings['typewrite_gradient_enable'] === 'yes') {
									$typewrite_gradient_start = !empty($settings['typewrite_gradient_start_color']) ? esc_attr($settings['typewrite_gradient_start_color']) : '';
									$typewrite_gradient_end = !empty($settings['typewrite_gradient_end_color']) ? esc_attr($settings['typewrite_gradient_end_color']) : '';
									$typewrite_gradient_angle = !empty($settings['typewrite_gradient_angle']['size']) ? esc_attr($settings['typewrite_gradient_angle']['size']) : '90';

									if (!empty($typewrite_gradient_start) && !empty($typewrite_gradient_end)) {
										echo '<style>
                                        .topppa-section-title .topppa-section-wrap {
                                            background-image: linear-gradient(' . esc_attr($typewrite_gradient_angle) . 'deg, ' . esc_attr($typewrite_gradient_start) . ', ' . esc_attr($typewrite_gradient_end) . ');
                                            -webkit-background-clip: text;
                                            background-clip: text;
                                            -webkit-text-fill-color: transparent;
                                        }
                                    </style>';
									}
								}
								?>
								<span class="topppa-section-typewrite"
									data-period="<?php echo esc_attr($settings['typewrite_delay'] ?? 2000); ?>"
									data-speed="<?php echo esc_attr($settings['typewrite_speed'] ?? 100); ?>"
									data-cursor="<?php echo esc_attr($has_multiple_items ? $settings['typewrite_cursor'] : ''); ?>"
									data-type='<?php echo esc_attr(json_encode($typewrite_texts)); ?>'>
									<div class="topppa-section-wrap"></div>
								</span>
							<?php endif; ?>
						</<?php echo esc_attr($settings['title_tag'] ?? 'h2'); ?>>
					<?php endif; ?>
					<?php if (!empty($settings['description']) && $settings['elable_description'] == 'yes') : ?>
						<div class="topppa-section-description">
							<?php echo wp_kses($settings['description'], $allowed_html); ?>
						</div>
					<?php endif; ?>
				</div>
				<div class="col-lg-7 col-md-12 topppa-scrol-template-area">
					<div class="topppa-scrol-template-body">
						<?php if ($settings['topppa_advanced_tab_content_source'] == 'elementor' && !empty($settings['template_id'])) : ?>
							<?php echo \Elementor\Plugin::instance()->frontend->get_builder_content_for_display($settings['template_id']); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
							?>
						<?php else : ?>
							<?php echo wp_kses($settings['template_description'], $allowed_html); ?>
						<?php endif; ?>
					</div>
				</div>
			</div>
		</div>
<?php
	}
}