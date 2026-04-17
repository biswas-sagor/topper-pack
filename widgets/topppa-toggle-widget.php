<?php

use TopperPack\Trait_Loader\Global_Component_Loader;
use \TopperPack\Includes\Controls\Controls_Manager as TopperPack_Controls_Manager;
use \TopperPack\Includes\Utilities;

if (! defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}

/**
 * Elementor TOPPPA Toggle Widget.
 *
 * Elementor widget that inserts an embbedable content into the page, from any given URL.
 *
 * @since 1.0.0
 */
class TOPPPA_Toggle_Widget extends \Elementor\Widget_Base {
	use Global_Component_Loader;

	/**
	 * Get widget name.
	 *
	 * Retrieve Logo widget widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'topppa_toggle';
	}

	/**
	 * Get widget title.
	 *
	 * Retrieve Logo widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget title.
	 */
	public function get_title() {
		return TOPPPA_EPWB . esc_html__('Toggle', 'topper-pack');
	}

	/**
	 * Get widget icon.
	 *
	 * Retrieve Logo widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-toggle';
	}

	/**
	 * Get widget categories.
	 *
	 * Retrieve the list of categories the Logo widget belongs to.
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
	 * Retrieve the list of keywords the Logo widget belongs to.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return array Widget keywords.
	 */
	public function get_keywords() {
		return ['topppa', 'widget', 'toggle', 'topperpack', 'toggle widget', 'toggle button', 'tab button'];
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
		return 'https://doc.topperpack.com/docs/general-widgets/toggle-widget/';
	}

	public function topppa_heading_after_before_line() {
		$this->add_control(
			'select_separator',
			[
				'label' => esc_html__('Select Separator', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => '',
				'options' => [
					'' => esc_html__('Default ', 'topper-pack'),
					'pro_icon' => esc_html__('Icon (Pro)', 'topper-pack'),
					'line' => esc_html__('Line', 'topper-pack'),
				],
				'condition' => [
					'enable_after_before' => 'yes',
				],
			]
		);
		Utilities::upgrade_pro_notice(
			$this,
			\Elementor\Controls_Manager::RAW_HTML,
			'topppa_headingt_widget',
			'select_separator',
			['pro_icon']
		);
	}

	/**
	 * Elementor Templates List
	 * return array
	 */
	public function topppa_elementor_template() {
		$templates = \Elementor\Plugin::instance()->templates_manager->get_source('local')->get_items();
		$types     = array();
		if (empty($templates)) {
			$template_lists = ['0' => __('No Saved Templates.', 'topper-pack')];
		} else {
			$template_lists = ['0' => __('Select Template', 'topper-pack')];
			foreach ($templates as $template) {
				$template_lists[$template['template_id']] = $template['title'] . ' (' . $template['type'] . ')';
			}
		}
		return $template_lists;
	}

	/**
	 * Register Logo Widget 1 widget controls.
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
				'label' => esc_html__('Content Option', 'topper-pack'),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
				'condition' => [
					'enable_top_heading' => 'yes'
				]
			]
		);

		$this->add_control(
			'enable_after_before',
			[
				'label' => esc_html__('Show After Before', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Show', 'topper-pack'),
				'label_off' => esc_html__('Hide', 'topper-pack'),
				'return_value' => 'yes',
				'default' => 'no',
			]
		);
		$this->topppa_heading_after_before_line([
			'enable_after_before' => true,
		]);

		$this->add_control(
			'stitle',
			[
				'label'   => esc_html__('Small Title', 'topper-pack'),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__('Why Choose Us?', 'topper-pack'),
				'label_block' => true,
			]
		);
		$this->add_control(
			'title',
			[
				'label'       => esc_html__('Title', 'topper-pack'),
				'type'        => \Elementor\Controls_Manager::WYSIWYG,
				'default' => esc_html__('Service We Can Provide', 'topper-pack'),
				'dynamic'     => [
					'active' => true,
				],
				'description' => esc_html__('If you want to use a gradient color in the middle of the text, use the strong tag', 'topper-pack'),
			]
		);

		$this->topppa_global_title_tag();

		$this->add_control(
			'enable_description',
			[
				'label' => esc_html__('Enable Description', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Show', 'topper-pack'),
				'label_off' => esc_html__('Hide', 'topper-pack'),
				'default' => 'yes',

			]
		);
		$this->add_control(
			'description',
			[
				'label'       => esc_html__('Description', 'topper-pack'),
				'type'        => \Elementor\Controls_Manager::WYSIWYG,
				'dynamic'     => [
					'active' => true,
				],
				'separator' => 'before',
				'condition' => [
					'enable_description' => 'yes',
				],
			]
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'topppa_toggle_options',
			[
				'label' => esc_html__('Toggle', 'topper-pack'),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'enable_top_heading',
			[
				'label' => esc_html__('Enable Heading', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Show', 'topper-pack'),
				'label_off' => esc_html__('Hide', 'topper-pack'),
				'return_value' => 'yes',
				'default' => 'no',
			]
		);
		$repeater = new \Elementor\Repeater();
		$repeater->add_control(
			'active_toggle',
			[
				'label' => esc_html__('Active Toggle', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Yes', 'topper-pack'),
				'label_off' => esc_html__('No', 'topper-pack'),
				'return_value' => 'yes',
				'default' => 'no',
			]
		);
		$repeater->add_control(
			'title',
			[
				'label' => esc_html__('Title', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__('Toggle Title', 'topper-pack'),
				'dynamic' => [
					'active' => true,
				],
			]
		);
		$repeater->add_control(
			'enable_icon',
			[
				'label' => esc_html__('Enable Icon', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Yes', 'topper-pack'),
				'label_off' => esc_html__('No', 'topper-pack'),
				'return_value' => 'yes',
				'default' => 'no',
			]
		);
		$repeater->add_control(
			'icon',
			[
				'label' => esc_html__('Icon', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::ICONS,
				'default' => [
					'value' => 'fas fa-circle',
					'library' => 'fa-solid',
				],
				'condition' => [
					'enable_icon' => 'yes',
				],
			]
		);
		$repeater->add_control(
			'template_id',
			[
				'label' => esc_html__('Select Template', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => esc_html__('Select Template', 'topper-pack'),
				'options'   => $this->topppa_elementor_template(),
			]
		);
		$repeater->add_control(
			'custom_attributes',
			[
				'label' => esc_html__('Custom Attributes', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Yes', 'topper-pack'),
				'label_off' => esc_html__('No', 'topper-pack'),
				'return_value' => 'yes',
				'default' => 'no',
			]
		);
		$repeater->add_control(
			'custom_attributes_text',
			[
				'label' => esc_html__('Custom Attributes', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'placeholder' => esc_html__('example: purchase=buy now', 'topper-pack'),
				'label_block' => true,
				'condition' => [
					'custom_attributes' => 'yes',
				],
			]
		);
		$this->add_control(
			'toggle_list',
			[
				'label'   => esc_html__('Toggle List', 'topper-pack'),
				'type'    => \Elementor\Controls_Manager::REPEATER,
				'fields'  => $repeater->get_controls(),
				'default' => [
					[
						'active_toggle' => 'yes',
						'title' => esc_html__('Monthly', 'topper-pack'),
					],
					[
						'active_toggle' => 'no',
						'title' => esc_html__('Yearly', 'topper-pack'),
					],
				],
				'title_field' => '{{{ title }}}',
			]
		);
		$this->end_controls_section();

		// Style Tab - Small Title
		$this->start_controls_section(
			'top_heading_box',
			[
				'label' => esc_html__('Heading Box', 'topper-pack'),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
				'condition' => [
					'enable_top_heading' => 'yes'
				]
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
					'{{WRAPPER}} .topppa-toggle-wrapper .top-wrapper' => 'flex-direction: {{VALUE}};',
				],
			]
		);
		$this->add_responsive_control(
			'content_width',
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
					'unit' => '%',
					'size' => 50,
				],
				'selectors' => [
					'{{WRAPPER}} .topppa-toggle-wrapper .top-wrapper .top-heading' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'top_heading_gap',
			[
				'label' => esc_html__('Gap', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px', '%', 'em', 'rem', 'custom'],
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
					'{{WRAPPER}} .topppa-toggle-wrapper .top-wrapper' => 'gap: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'top_heading_position',
			[
				'label'     => __('Justify Content', 'topper-pack'),
				'type'      => \Elementor\Controls_Manager::CHOOSE,
				'options'   => [
					'flex-start' => [
						'title' => __('Left', 'topper-pack'),
						'icon'  => 'eicon-h-align-left',
					],
					'center' => [
						'title' => __('Center', 'topper-pack'),
						'icon'  => 'eicon-h-align-center',
					],
					'flex-end' => [
						'title' => __('Right', 'topper-pack'),
						'icon'  => 'eicon-h-align-right',
					],
					'space-between' => [
						'title' => __('Space Between', 'topper-pack'),
						'icon'  => 'eicon-justify-space-between-h',
					],
				],
				'toggle'    => true,
				'selectors' => [
					'{{WRAPPER}} .topppa-toggle-wrapper .top-wrapper' => 'justify-content: {{VALUE}}',
				],
			]
		);

		$this->add_responsive_control(
			'top_heading_aligment',
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
					'{{WRAPPER}} .topppa-toggle-wrapper .top-wrapper' => 'text-align: {{VALUE}}',
				],
			]
		);
		$this->add_responsive_control(
			'top_heading_align_items',
			[
				'label' => esc_html__('Align Items', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'options' => [
					'flex-start' => [
						'title' => esc_html__('Top', 'topper-pack'),
						'icon' => 'eicon-v-align-top',
					],
					'center' => [
						'title' => esc_html__('Middle', 'topper-pack'),
						'icon' => 'eicon-v-align-middle',
					],
					'flex-end' => [
						'title' => esc_html__('Bottom', 'topper-pack'),
						'icon' => 'eicon-v-align-bottom',
					],
				],
				'toggle' => true,
				'selectors' => [
					'{{WRAPPER}} .topppa-toggle-wrapper .top-wrapper' => 'align-items: {{VALUE}};',
				],
			]
		);
		$this->add_responsive_control(
			'top_heading_margin',
			[
				'label' => esc_html__('Margin', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em', 'rem', 'custom'],
				'selectors' => [
					'{{WRAPPER}} .topppa-toggle-wrapper .top-wrapper' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'top_heading_padding',
			[
				'label' => esc_html__('Padding', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em', 'rem', 'custom'],
				'selectors' => [
					'{{WRAPPER}} .topppa-toggle-wrapper .top-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'subtitle_style_options',
			[
				'label' => esc_html__('Subtitle Style', 'topper-pack'),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
				'condition' => [
					'enable_top_heading' => 'yes'
				]
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
				'name'     => 'subtitle_box_bg',
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
					'{{WRAPPER}} .topppa-section-small-title.icons span' => 'color: {{VALUE}};',
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
					'{{WRAPPER}} .topppa-section-small-title.icons span' => 'font-size: {{SIZE}}{{UNIT}};',
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
		$this->end_controls_section();

		// Style Tab - Main Title
		$this->start_controls_section(
			'section_style',
			[
				'label' => esc_html__('Title Style', 'topper-pack'),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
				'condition' => [
					'enable_top_heading' => 'yes'
				]
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
		$this->end_controls_section();

		$this->start_controls_section(
			'description_options',
			[
				'label' => esc_html__('Description Style', 'topper-pack'),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
				'condition' => [
					'enable_description' => 'yes',
					'enable_top_heading' => 'yes'
				],
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
		$this->end_controls_section();

		/**
		 * start style section
		 *
		 * @since 1.0.0
		 * @access protected
		 */
		$this->start_controls_section(
			'toggle_style_options',
			[
				'label' => esc_html__('Menu Section', 'topper-pack'),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_responsive_control(
			'box_width',
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
					'{{WRAPPER}} .topppa-toggle-wrapper .topppa-toggle-tab-menu' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'box_bg',
				'types' => ['classic', 'gradient', 'video'],
				'selector' => '{{WRAPPER}} .topppa-toggle-wrapper .topppa-toggle-tab-menu',
			]
		);
		$this->add_responsive_control(
			'item_alignment2',
			[
				'label'     => __('Justify Content', 'topper-pack'),
				'type'      => \Elementor\Controls_Manager::CHOOSE,
				'options'   => [
					'flex-start'    => [
						'title' => __('Left', 'topper-pack'),
						'icon'  => 'eicon-h-align-left',
					],
					'center'  => [
						'title' => __('Center', 'topper-pack'),
						'icon'  => 'eicon-h-align-center',
					],
					'flex-end'   => [
						'title' => __('Right', 'topper-pack'),
						'icon'  => 'eicon-h-align-right',
					],
				],
				'toggle'    => true,
				'selectors' => [
					'{{WRAPPER}} .topppa-toggle-wrapper .top-wrapper' => 'justify-content: {{VALUE}}',
				],
				'condition' => [
					'enable_top_heading!' => 'yes'
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
					'{{WRAPPER}} .topppa-toggle-wrapper .topppa-toggle-tab-menu ul' => 'justify-content: {{VALUE}};',
				]
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'border',
				'selector' => '{{WRAPPER}} .topppa-toggle-wrapper .topppa-toggle-tab-menu',
			]
		);
		$this->add_responsive_control(
			'box_radius',
			[
				'label' => esc_html__('Box Radius', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em', 'rem', 'custom'],
				'selectors' => [
					'{{WRAPPER}} .topppa-toggle-wrapper .topppa-toggle-tab-menu' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'box_shadow',
				'selector' => '{{WRAPPER}} .topppa-toggle-wrapper .topppa-toggle-tab-menu',
			]
		);
		$this->add_responsive_control(
			'box_margin',
			[
				'label' => esc_html__('Margin', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em', 'rem', 'custom'],
				'selectors' => [
					'{{WRAPPER}} .topppa-toggle-wrapper .topppa-toggle-tab-menu' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .topppa-toggle-wrapper .topppa-toggle-tab-menu' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();

		/**
		 * start button style section
		 *
		 * @since 1.0.0
		 * @access protected
		 */
		$this->start_controls_section(
			'button_style_options',
			[
				'label' => esc_html__('Button Style', 'topper-pack'),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'button_typography',
				'selector' => '{{WRAPPER}} .topppa-toggle-wrapper .topppa-toggle-tab-menu ul li button',
			]
		);
		$this->add_responsive_control(
			'button_margin',
			[
				'label' => esc_html__('Margin', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em', 'rem', 'custom'],
				'selectors' => [
					'{{WRAPPER}} .topppa-toggle-wrapper .topppa-toggle-tab-menu ul li button' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'button_padding',
			[
				'label' => esc_html__('Padding', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em', 'rem', 'custom'],
				'selectors' => [
					'{{WRAPPER}} .topppa-toggle-wrapper .topppa-toggle-tab-menu ul li button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'button_gap',
			[
				'label' => esc_html__('Button Gap', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px', '%', 'em', 'rem', 'custom'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 50,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .topppa-toggle-wrapper .topppa-toggle-tab-menu ul' => 'gap: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->start_controls_tabs(
			'button_style_tabs'
		);

		$this->start_controls_tab(
			'button_style_normal_tab',
			[
				'label' => esc_html__('Normal', 'topper-pack'),
			]
		);
		$this->add_responsive_control(
			'button_text_color',
			[
				'label' => esc_html__('Text Color', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .topppa-toggle-wrapper .topppa-toggle-tab-menu ul li button' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'button_bg',
				'types' => ['classic', 'gradient', 'video'],
				'selector' => '{{WRAPPER}} .topppa-toggle-wrapper .topppa-toggle-tab-menu ul li button',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'button_border',
				'selector' => '{{WRAPPER}} .topppa-toggle-wrapper .topppa-toggle-tab-menu ul li button',
			]
		);
		$this->add_responsive_control(
			'button_border_radius',
			[
				'label' => esc_html__('Button Radius', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em', 'rem', 'custom'],
				'selectors' => [
					'{{WRAPPER}} .topppa-toggle-wrapper .topppa-toggle-tab-menu ul li button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'button_shadow',
				'selector' => '{{WRAPPER}} .topppa-toggle-wrapper .topppa-toggle-tab-menu ul li button',
			]
		);
		$this->add_control(
			'icon_style_options_note',
			[
				'label' => esc_html__('Icon Options', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'after',
			]
		);
		$this->add_responsive_control(
			'button_icon_size',
			[
				'label' => esc_html__('Icon Size', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px', '%', 'em', 'rem', 'custom'],
				'selectors' => [
					'{{WRAPPER}} .topppa-toggle-wrapper .topppa-toggle-tab-menu ul li button i' => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .topppa-toggle-wrapper .topppa-toggle-tab-menu ul li button svg' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'button_icon_color',
			[
				'label' => esc_html__('Icon Color', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .topppa-toggle-wrapper .topppa-toggle-tab-menu ul li button i' => 'color: {{VALUE}}',
					'{{WRAPPER}} .topppa-toggle-wrapper .topppa-toggle-tab-menu ul li button svg' => 'fill: {{VALUE}}',
				],
			]
		);
		$this->add_responsive_control(
			'button_icon_gap',
			[
				'label' => esc_html__('Icon Gap', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 20,
						'step' => 1,
					]
				],
				'selectors' => [
					'{{WRAPPER}} .topppa-toggle-wrapper .topppa-toggle-tab-menu ul li button' => 'gap: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'button_icon_position',
			[
				'label' => esc_html__('Icon Position', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'options' => [
					'row-reverse' => [
						'title' => esc_html__('Left', 'topper-pack'),
						'icon' => 'eicon-h-align-left',
					],
					'column-reverse' => [
						'title' => esc_html__('Top', 'topper-pack'),
						'icon' => 'eicon-v-align-top',
					],
					'row' => [
						'title' => esc_html__('Right', 'topper-pack'),
						'icon' => 'eicon-h-align-right',
					],
					'column' => [
						'title' => esc_html__('Bottom', 'topper-pack'),
						'icon' => 'eicon-v-align-bottom',
					],
				],
				'default' => 'row',
				'toggle' => true,
				'selectors' => [
					'{{WRAPPER}} .topppa-toggle-wrapper .topppa-toggle-tab-menu ul li button' => 'flex-direction: {{VALUE}};',
				],
			]
		);
		$this->end_controls_tab();

		$this->start_controls_tab(
			'button_style_hover_tab',
			[
				'label' => esc_html__('Hover', 'topper-pack'),
			]
		);
		$this->add_responsive_control(
			'button_text_color_hover',
			[
				'label' => esc_html__('Text Color', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .topppa-toggle-wrapper .topppa-toggle-tab-menu ul li button:hover' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'button_bg_hover',
				'types' => ['classic', 'gradient', 'video'],
				'selector' => '{{WRAPPER}} .topppa-toggle-wrapper .topppa-toggle-tab-menu ul li button:hover',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'button_border_hover',
				'selector' => '{{WRAPPER}} .topppa-toggle-wrapper .topppa-toggle-tab-menu ul li button:hover',
			]
		);
		$this->add_responsive_control(
			'button_border_radius_hover',
			[
				'label' => esc_html__('Button Radius', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em', 'rem', 'custom'],
				'selectors' => [
					'{{WRAPPER}} .topppa-toggle-wrapper .topppa-toggle-tab-menu ul li button:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'button_shadow_hover',
				'selector' => '{{WRAPPER}} .topppa-toggle-wrapper .topppa-toggle-tab-menu ul li button:hover',
			]
		);
		$this->add_control(
			'icon_style_options_note_hover',
			[
				'label' => esc_html__('Icon Options', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'after',
			]
		);
		$this->add_responsive_control(
			'button_icon_color_hover',
			[
				'label' => esc_html__('Icon Color', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .topppa-toggle-wrapper .topppa-toggle-tab-menu ul li button i:hover' => 'color: {{VALUE}}',
					'{{WRAPPER}} .topppa-toggle-wrapper .topppa-toggle-tab-menu ul li button svg:hover' => 'fill: {{VALUE}}',
				],
			]
		);
		$this->end_controls_tab();

		// New: Active Tab (only .active selectors)
		$this->start_controls_tab(
			'button_style_active_tab',
			[
				'label' => esc_html__('Active', 'topper-pack'),
			]
		);
		$this->add_responsive_control(
			'button_text_color_active',
			[
				'label' => esc_html__('Text Color', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .topppa-toggle-wrapper .topppa-toggle-tab-menu ul li button.active' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'button_bg_active',
				'types' => ['classic', 'gradient', 'video'],
				'selector' => '{{WRAPPER}} .topppa-toggle-wrapper .topppa-toggle-tab-menu ul li button.active',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'button_border_active',
				'selector' => '{{WRAPPER}} .topppa-toggle-wrapper .topppa-toggle-tab-menu ul li button.active',
			]
		);
		$this->add_responsive_control(
			'button_border_radius_active',
			[
				'label' => esc_html__('Button Radius', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em', 'rem', 'custom'],
				'selectors' => [
					'{{WRAPPER}} .topppa-toggle-wrapper .topppa-toggle-tab-menu ul li button.active' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'button_shadow_active',
				'selector' => '{{WRAPPER}} .topppa-toggle-wrapper .topppa-toggle-tab-menu ul li button.active',
			]
		);
		$this->add_control(
			'icon_style_options_note_active',
			[
				'label' => esc_html__('Icon Options', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'after',
			]
		);
		$this->add_responsive_control(
			'button_icon_color_active',
			[
				'label' => esc_html__('Icon Color', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .topppa-toggle-wrapper .topppa-toggle-tab-menu ul li button.active i' => 'color: {{VALUE}}',
					'{{WRAPPER}} .topppa-toggle-wrapper .topppa-toggle-tab-menu ul li button.active svg' => 'fill: {{VALUE}}',
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
		$unique = wp_rand(1000, 9999);

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
		// Your widget output here
?>
		<div class="topppa-toggle-wrapper">
			<div class="top-wrapper">
				<?php if ('yes' === $settings['enable_top_heading']) : ?>
					<div class="top-heading">
						<?php if (!empty($settings['stitle'])) : ?>
							<div class="topppa-section-small-title <?php echo esc_attr($class); ?>" <?php echo esc_attr($class); ?>" style="box-shadow: <?php echo esc_attr($box_shadow); ?>;">
								<?php if (isset($settings['ricon']) && !empty($settings['ricon']['value'])) : ?>
									<span><?php \Elementor\Icons_Manager::render_icon($settings['ricon'], ['aria-hidden' => 'true']); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- Already escaped by elementor 
											?></span>
								<?php endif; ?>
								<?php echo esc_html($settings['stitle']); ?>
								<?php if (isset($settings['licon']) && !empty($settings['licon']['value'])) : ?>
									<span><?php \Elementor\Icons_Manager::render_icon($settings['licon'], ['aria-hidden' => 'true']); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- Already escaped by elementor 
											?></span>
								<?php endif; ?>
							</div>
						<?php endif ?>

						<?php if (!empty($settings['title'])) : ?>
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
							</<?php echo esc_attr($settings['title_tag'] ?? 'h2'); ?>>
						<?php endif; ?>

						<?php if (!empty($settings['description']) && $settings['enable_description'] == 'yes') : ?>
							<div class="topppa-section-description">
								<?php echo wp_kses($settings['description'], $allowed_html); ?>
							</div>
						<?php endif; ?>
					</div>
				<?php endif; ?>

				<div class="topppa-toggle-tab-menu">
					<ul class="nav nav-pills" id="topppa-toggle-tab<?php echo esc_attr($unique); ?>" role="tablist">
						<?php $count = 0;
						foreach ($settings['toggle_list'] as $toggle) : $count++; ?>
							<li class="nav-item" role="presentation">
								<button class="nav-link <?php echo esc_attr($toggle['active_toggle'] === 'yes' ? 'active' : ''); ?>" id="topppa-toggle-tab-<?php echo esc_attr($unique . $count); ?>" data-bs-toggle="pill" data-bs-target="#topppa-toggle-content-tab-<?php echo esc_attr($unique . $count); ?>" type="button" role="tab" aria-controls="topppa-toggle-content-tab-<?php echo esc_attr($unique . $count); ?>" aria-selected="true" <?php echo esc_attr($toggle['custom_attributes'] === 'yes' ? ' ' . $toggle['custom_attributes_text'] . '' : ''); ?>><?php echo esc_html($toggle['title']); ?>
									<?php if ('yes' === $toggle['enable_icon']) {
										\Elementor\Icons_Manager::render_icon($toggle['icon'], ['aria-hidden' => 'true']); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- Already escaped by elementor 
									} ?>
								</button>
							</li>
						<?php endforeach; ?>
					</ul>
				</div>
			</div>

			<div class="tab-content" id="topppa-toggle-tabContent<?php echo esc_attr($unique); ?>">
				<?php $count = 0;
				foreach ($settings['toggle_list'] as $toggle) : $count++; ?>
					<div class="tab-pane fade <?php echo esc_attr($toggle['active_toggle'] === 'yes' ? 'show active' : ''); ?>" id="topppa-toggle-content-tab-<?php echo esc_attr($unique . $count); ?>" role="tabpanel" aria-labelledby="topppa-toggle-tab-<?php echo esc_attr($unique . $count); ?>">
						<?php if ($toggle['template_id'] != '0') : ?>
							<?php echo \Elementor\Plugin::instance()->frontend->get_builder_content_for_display($toggle['template_id']); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- Already escaped by elementor 
							?>
						<?php endif; ?>
					</div>
				<?php endforeach; ?>
			</div>
		</div>
<?php
	}
}
