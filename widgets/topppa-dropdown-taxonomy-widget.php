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
class TOPPPA_Dropdown_Taxonomy_Widget extends \Elementor\Widget_Base {

	/**
	 * Get widget name.
	 *
	 * Retrieve Dropdown Taxonomy widget widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'topppa_dropdown_taxonomy';
	}

	/**
	 * Get widget title.
	 *
	 * Retrieve Dropdown Taxonomy widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget title.
	 */
	public function get_title() {
		return TOPPPA_EPWB . esc_html__('Dropdown Taxonomy', 'topper-pack');
	}

	/**
	 * Get widget icon.
	 *
	 * Retrieve Dropdown Taxonomy widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-nav-menu';
	}

	/**
	 * Get widget categories.
	 *
	 * Retrieve the list of categories the Dropdown Taxonomy widget belongs to.
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
	 * Retrieve the list of keywords the Dropdown Taxonomy widget belongs to.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return array Widget keywords.
	 */
	public function get_keywords() {
		return ['topppa', 'widget', 'dropdown', 'taxonomy', 'topperpack', 'product taxonomy', 'category', 'tag', 'post taxonomy', 'custom taxonomy'];
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
		return 'https://doc.topperpack.com/docs/service-widgets/dropdown-taxonomy/';
	}

	/**
	 * Register Dropdown Taxonomy widget controls.
	 *
	 * Add input fields to allow the user to customize the widget settings.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function register_controls() {
		// Content Section
		$this->start_controls_section(
			'topppa_dropdown_taxonomy_content',
			[
				'label' => esc_html__('Content', 'topper-pack'),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'taxonomy',
			[
				'label' => esc_html__('Taxonomy', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'category',
				'options' => $this->get_all_taxonomies(),
				'description' => esc_html__('Select the taxonomy to display. All available taxonomies are shown below.', 'topper-pack'),
			]
		);

		$this->add_control(
			'placeholder_text',
			[
				'label' => esc_html__('Placeholder Text', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__('Shop By Categories', 'topper-pack'),
				'placeholder' => esc_html__('Enter placeholder text', 'topper-pack'),
			]
		);
		$this->add_control(
            'dropdown_icon',
            [
                'label' => esc_html__('Select Icon', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::ICONS,
                'default' => [
                    'value' => 'fas fa-bars',
                    'library' => 'fa-solid',
                ],
                'skin' => 'inline',
                'label_block' => false,
                'exclude_inline_options' => ['svg'],
				'condition' => [
					'display_type' => 'dropdown',
				],
            ]
        );
		$this->add_control(
			'show_count',
			[
				'label' => esc_html__('Show Count', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Yes', 'topper-pack'),
				'label_off' => esc_html__('No', 'topper-pack'),
				'return_value' => 'yes',
				'default' => 'no',
			]
		);

		$this->add_control(
			'hide_empty',
			[
				'label' => esc_html__('Hide Empty', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Yes', 'topper-pack'),
				'label_off' => esc_html__('No', 'topper-pack'),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->add_control(
			'show_hierarchy',
			[
				'label' => esc_html__('Show Hierarchy', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Yes', 'topper-pack'),
				'label_off' => esc_html__('No', 'topper-pack'),
				'return_value' => 'yes',
				'default' => 'no',
			]
		);
		$this->add_control(
			'only_parent',
			[
				'label' => esc_html__('Only Parent', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Yes', 'topper-pack'),
				'label_off' => esc_html__('No', 'topper-pack'),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);
		$this->add_control(
			'show_subcategory',
			[
				'label' => esc_html__('Show Subcategory', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Yes', 'topper-pack'),
				'label_off' => esc_html__('No', 'topper-pack'),
				'return_value' => 'yes',
				'default' => 'yes',
				'condition' => [
					'only_parent!' => 'yes',
				],
			]
		);
		$this->add_control(
			'orderby',
			[
				'label' => esc_html__('Order By', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'name',
				'options' => [
					'name' => esc_html__('Name', 'topper-pack'),
					'slug' => esc_html__('Slug', 'topper-pack'),
					'count' => esc_html__('Count', 'topper-pack'),
					'term_group' => esc_html__('Term Group', 'topper-pack'),
					'term_id' => esc_html__('Term ID', 'topper-pack'),
				],
			]
		);

		$this->add_control(
			'order',
			[
				'label' => esc_html__('Order', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'ASC',
				'options' => [
					'ASC' => esc_html__('Ascending', 'topper-pack'),
					'DESC' => esc_html__('Descending', 'topper-pack'),
				],
			]
		);

		$this->add_control(
			'include_terms',
			[
				'label' => esc_html__('Include Terms', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'description' => esc_html__('Enter term IDs separated by commas (e.g., 1,2,3)', 'topper-pack'),
				'placeholder' => esc_html__('1,2,3', 'topper-pack'),
			]
		);

		$this->add_control(
			'exclude_terms',
			[
				'label' => esc_html__('Exclude Terms', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'description' => esc_html__('Enter term IDs separated by commas (e.g., 1,2,3)', 'topper-pack'),
				'placeholder' => esc_html__('1,2,3', 'topper-pack'),
			]
		);

		$this->add_control(
			'parent_term',
			[
				'label' => esc_html__('Parent Term ID', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'description' => esc_html__('Show only child terms of this parent term', 'topper-pack'),
				'min' => 0,
			]
		);

		$this->add_control(
			'display_type',
			[
				'label' => esc_html__('Display Type', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'dropdown',
				'options' => [
					'dropdown' => esc_html__('Dropdown', 'topper-pack'),
					'show_all' => esc_html__('Show All', 'topper-pack'),
				],
			]
		);
		$this->add_control(
			'dropdown_behavior',
			[
				'label' => esc_html__('Dropdown Behavior', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'click',
				'options' => [
					'click' => esc_html__('Click to Show', 'topper-pack'),
					'hover' => esc_html__('Hover to Show', 'topper-pack'),
				],
				'description' => esc_html__('Choose how the dropdown list is triggered', 'topper-pack'),
				'condition' => [
					'display_type' => 'dropdown',
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
			'dropdown_taxonomy_trigger_style',
			[
				'label' => esc_html__('Dropdown Trigger', 'topper-pack'),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
				'condition' => [
					'display_type' => 'dropdown',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'dropdown_trigger_background',
				'types' => ['classic', 'gradient', 'video'],
				'selector' => '{{WRAPPER}} .topppa-dropdown-taxonomy .topppa-dropdown-trigger',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'dropdown_trigger_border',
				'selector' => '{{WRAPPER}} .topppa-dropdown-taxonomy .topppa-dropdown-trigger',
			]
		);
		$this->add_responsive_control(
			'dropdown_trigger_radius',
			[
				'label' => esc_html__('Radius', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em', 'rem', 'custom'],
				'selectors' => [
					'{{WRAPPER}} .topppa-dropdown-taxonomy .topppa-dropdown-trigger' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'dropdown_trigger_box_shadow',
				'selector' => '{{WRAPPER}} .topppa-dropdown-taxonomy .topppa-dropdown-trigger',
			]
		);
		$this->add_responsive_control(
			'dropdown_trigger_margin',
			[
				'label' => esc_html__('Margin', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em', 'rem', 'custom'],
				'selectors' => [
					'{{WRAPPER}} .topppa-dropdown-taxonomy .topppa-dropdown-trigger' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'dropdown_trigger_padding',
			[
				'label' => esc_html__('Padding', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em', 'rem', 'custom'],
				'selectors' => [
					'{{WRAPPER}} .topppa-dropdown-taxonomy .topppa-dropdown-trigger' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->start_controls_tabs(
			'dropdown_trigger_style_tabs'
		);

		$this->start_controls_tab(
			'dropdown_trigger_style_icon_tab',
			[
				'label' => esc_html__('Icon', 'topper-pack'),
			]
		);
		$this->add_responsive_control(
			'dropdown_trigger_icon_position',
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
					'{{WRAPPER}} .topppa-dropdown-taxonomy .topppa-dropdown-trigger' => 'flex-direction: {{VALUE}};',
				],
			]
		);
		$this->add_responsive_control(
			'dropdown_trigger_icon_color',
			[
				'label' => esc_html__('Color', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .topppa-dropdown-trigger-icon' => 'color: {{VALUE}}',
					'{{WRAPPER}} .topppa-dropdown-trigger-icon svg path' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_responsive_control(
			'dropdown_trigger_icon_size',
			[
				'label' => esc_html__('Size', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px', 'em', 'rem', 'custom'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
						'step' => 1,
					]
				],
				'selectors' => [
					'{{WRAPPER}} .topppa-dropdown-trigger-icon' => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .topppa-dropdown-trigger-icon svg' => 'width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'dropdown_trigger_icon_margin',
			[
				'label' => esc_html__('Margin', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em', 'rem', 'custom'],
				'selectors' => [
					'{{WRAPPER}} .topppa-dropdown-trigger-icon' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'dropdown_trigger_icon_padding',
			[
				'label' => esc_html__('Padding', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em', 'rem', 'custom'],
				'selectors' => [
					'{{WRAPPER}} .topppa-dropdown-trigger-icon' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_tab();

		$this->start_controls_tab(
			'dropdown_trigger_style_title_tab',
			[
				'label' => esc_html__('Title', 'topper-pack'),
			]
		);
		$this->add_responsive_control(
			'dropdown_trigger_title_color',
			[
				'label' => esc_html__('Color', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .topppa-dropdown-taxonomy .topppa-dropdown-trigger .topppa-trigger-text' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'dropdown_trigger_title_typography',
				'selector' => '{{WRAPPER}} .topppa-dropdown-taxonomy .topppa-dropdown-trigger .topppa-trigger-text',
			]
		);
		$this->add_responsive_control(
			'dropdown_trigger_title_margin',
			[
				'label' => esc_html__('Margin', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em', 'rem', 'custom'],
				'selectors' => [
					'{{WRAPPER}} .topppa-dropdown-taxonomy .topppa-dropdown-trigger .topppa-trigger-text' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'dropdown_trigger_title_padding',
			[
				'label' => esc_html__('Padding', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em', 'rem', 'custom'],
				'selectors' => [
					'{{WRAPPER}} .topppa-dropdown-taxonomy .topppa-dropdown-trigger .topppa-trigger-text' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_tab();

		$this->end_controls_tabs();
		$this->end_controls_section();

		/**
		 * start style section
		 *
		 * @since 1.0.0
		 * @access protected
		 */
		$this->start_controls_section(
			'list_dropdown_box_style',
			[
				'label' => esc_html__('Item Box', 'topper-pack'),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
				'condition' => [
					'display_type' => 'dropdown',
				],
			]
		);
		$this->add_responsive_control(
			'list_dropdown_box_position',
			[
				'label' => esc_html__('Position Top to Bottom', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px', '%', 'em', 'rem', 'custom'],
				'range' => [
					'px' => [
						'min' => -300,
						'max' => 300,
						'step' => 1,
					],
					'%' => [
						'min' => -100,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .topppa-dropdown-taxonomy .topppa-taxonomy-list' => 'top: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'list_dropdown_box_background',
				'types' => ['classic', 'gradient', 'video'],
				'selector' => '{{WRAPPER}} .topppa-dropdown-taxonomy .topppa-taxonomy-list',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'list_dropdown_box_border',
				'selector' => '{{WRAPPER}} .topppa-dropdown-taxonomy .topppa-taxonomy-list',
			]
		);
		$this->add_responsive_control(
			'list_dropdown_box_radius',
			[
				'label' => esc_html__('Radius', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em', 'rem', 'custom'],
				'selectors' => [
					'{{WRAPPER}} .topppa-dropdown-taxonomy .topppa-taxonomy-list' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'list_dropdown_box_box_shadow',
				'selector' => '{{WRAPPER}} .topppa-dropdown-taxonomy .topppa-taxonomy-list',
			]
		);
		$this->add_responsive_control(
			'list_dropdown_box_padding',
			[
				'label' => esc_html__('Padding', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em', 'rem', 'custom'],
				'selectors' => [
					'{{WRAPPER}} .topppa-dropdown-taxonomy .topppa-taxonomy-list' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();

		/**
		 * start item style section
		 *
		 * @since 1.0.0
		 * @access protected
		 */
		$this->start_controls_section(
			'item_all_show_box_style',
			[
				'label' => esc_html__('Item Box', 'topper-pack'),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
				'condition' => [
					'display_type' => 'show_all',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'item_all_show_box_background',
				'types' => ['classic', 'gradient', 'video'],
				'selector' => '{{WRAPPER}} .topppa-dropdown-taxonomy-widget.topppa-show-all-taxonomy',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'item_all_show_box_border',
				'selector' => '{{WRAPPER}} .topppa-dropdown-taxonomy-widget.topppa-show-all-taxonomy',
			]
		);
		$this->add_responsive_control(
			'item_all_show_box_radius',
			[
				'label' => esc_html__('Radius', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em', 'rem', 'custom'],
				'selectors' => [
					'{{WRAPPER}} .topppa-dropdown-taxonomy-widget.topppa-show-all-taxonomy' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'item_all_show_box_box_shadow',
				'selector' => '{{WRAPPER}} .topppa-dropdown-taxonomy-widget.topppa-show-all-taxonomy',
			]
		);
		$this->add_responsive_control(
			'item_all_show_box_margin',
			[
				'label' => esc_html__('Margin', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em', 'rem', 'custom'],
				'selectors' => [
					'{{WRAPPER}} .topppa-dropdown-taxonomy-widget.topppa-show-all-taxonomy' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'item_all_show_box_padding',
			[
				'label' => esc_html__('Padding', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em', 'rem', 'custom'],
				'selectors' => [
					'{{WRAPPER}} .topppa-dropdown-taxonomy-widget.topppa-show-all-taxonomy' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();

		/**
		 * start item style section
		 *
		 * @since 1.0.0
		 * @access protected
		 */
		$this->start_controls_section(
			'item_style',
			[
				'label' => esc_html__('Item List', 'topper-pack'),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_responsive_control(
			'list_item_margin',
			[
				'label' => esc_html__('Margin', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em', 'rem', 'custom'],
				'selectors' => [
					'{{WRAPPER}} .topppa-taxonomy-ul' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'list_item_padding',
			[
				'label' => esc_html__('Padding', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em', 'rem', 'custom'],
				'selectors' => [
					'{{WRAPPER}} .topppa-taxonomy-ul' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->start_controls_tabs(
			'list_item_style_tabs'
		);

		$this->start_controls_tab(
			'list_item_style_text_tab',
			[
				'label' => esc_html__('Text', 'topper-pack'),
			]
		);
		$this->add_responsive_control(
			'list_item_text_color',
			[
				'label' => esc_html__('Text Color', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .topppa-dropdown-taxonomy-widget .topppa-taxonomy-ul .topppa-taxonomy-item a' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_responsive_control(
			'list_item_text_hover_color',
			[
				'label' => esc_html__('Text Hover Color', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .topppa-dropdown-taxonomy-widget .topppa-taxonomy-ul .topppa-taxonomy-item a:hover' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'list_item_text_typography',
				'selector' => '{{WRAPPER}} .topppa-dropdown-taxonomy-widget .topppa-taxonomy-ul .topppa-taxonomy-item a',
			]
		);
		$this->add_responsive_control(
			'list_item_text_margin',
			[
				'label' => esc_html__('Margin', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em', 'rem', 'custom'],
				'selectors' => [
					'{{WRAPPER}} .topppa-dropdown-taxonomy-widget .topppa-taxonomy-ul .topppa-taxonomy-item a' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'list_item_text_padding',
			[
				'label' => esc_html__('Padding', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em', 'rem', 'custom'],
				'selectors' => [
					'{{WRAPPER}} .topppa-dropdown-taxonomy-widget .topppa-taxonomy-ul .topppa-taxonomy-item a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'list_item_text_border',
				'selector' => '{{WRAPPER}} .topppa-dropdown-taxonomy-widget .topppa-taxonomy-ul .topppa-taxonomy-item a',
			]
		);
		$this->end_controls_tab();

		$this->start_controls_tab(
			'list_item_style_number_tab',
			[
				'label' => esc_html__('Number', 'topper-pack'),
			]
		);
		$this->add_responsive_control(
			'list_item_number_color',
			[
				'label' => esc_html__( 'Text Color', 'topper-pack' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .topppa-dropdown-taxonomy-widget .topppa-taxonomy-ul .topppa-taxonomy-item a .topppa-term-count' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_responsive_control(
			'list_item_number_hover_color',
			[
				'label' => esc_html__( 'Text Color', 'topper-pack' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .topppa-dropdown-taxonomy-widget .topppa-taxonomy-ul .topppa-taxonomy-item a:hover .topppa-term-count' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_responsive_control(
			'list_item_number_size',
			[
				'label' => esc_html__( 'Font Size', 'topper-pack' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em', 'rem', 'custom' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
						'step' => 1,
					]
				],
				'selectors' => [
					'{{WRAPPER}} .topppa-dropdown-taxonomy-widget .topppa-taxonomy-ul .topppa-taxonomy-item a .topppa-term-count' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_tab();

		$this->end_controls_tabs();
		$this->end_controls_section();
	}

	/**
	 * Add dynamic control updates.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function add_dynamic_control_updates() {
		// This will be handled by JavaScript for dynamic taxonomy updates
	}

	/**
	 * Enqueue widget scripts and styles.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function get_script_depends() {
		return ['jquery'];
	}

	/**
	 * Enqueue widget styles.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function get_style_depends() {
		return [];
	}

	/**
	 * Get all available taxonomies.
	 *
	 * @since 1.0.0
	 * @access private
	 * @return array
	 */
	private function get_all_taxonomies() {
		$all_taxonomies = get_taxonomies([], 'objects');
		$options = [];

		// Taxonomies to exclude from the dropdown
		$excluded_taxonomies = [
			'nav_menu',
			'link_category',
			'post_format',           // Post formats (aside, gallery, etc.)
			'product_shipping_class' // WooCommerce shipping classes
		];

		// Group taxonomies by post type
		$grouped_taxonomies = [];

		foreach ($all_taxonomies as $taxonomy) {
			if ($taxonomy->public && !in_array($taxonomy->name, $excluded_taxonomies)) {
				$post_types = $taxonomy->object_type ?? [];

				foreach ($post_types as $post_type) {
					$post_type_obj = get_post_type_object($post_type);
					if ($post_type_obj) {
						$grouped_taxonomies[$post_type_obj->label][] = $taxonomy;
					}
				}
			}
		}

		// Create organized options with separators
		foreach ($grouped_taxonomies as $post_type_label => $taxonomies) {
			// Add post type separator
			$options['separator_' . sanitize_title($post_type_label)] = '── ' . $post_type_label . ' ──';

			// Add taxonomies for this post type
			foreach ($taxonomies as $taxonomy) {
				$options[$taxonomy->name] = $taxonomy->label;
			}
		}

		return $options;
	}

	/**
	 * Get available taxonomies for selected post type.
	 *
	 * @since 1.0.0
	 * @access private
	 * @return array
	 */
	private function get_taxonomies() {
		$settings = $this->get_settings_for_display();
		$post_type = $settings['post_type'] ?? 'post';

		return $this->get_taxonomies_for_post_type($post_type);
	}

	/**
	 * Get taxonomy terms based on settings.
	 *
	 * @since 1.0.0
	 * @access private
	 * @return array
	 */
	private function get_terms() {
		$settings = $this->get_settings_for_display();

		// Set default values to prevent undefined array key warnings
		$taxonomy = $settings['taxonomy'] ?? 'category';
		$hide_empty = $settings['hide_empty'] ?? 'yes';
		$orderby = $settings['orderby'] ?? 'name';
		$order = $settings['order'] ?? 'ASC';
		$show_hierarchy = $settings['show_hierarchy'] ?? 'no';
		$only_parent = $settings['only_parent'] ?? 'yes';
		$show_subcategory = $settings['show_subcategory'] ?? 'yes';

		// Check if a separator was selected (shouldn't happen, but just in case)
		if (strpos($taxonomy, 'separator_') === 0) {
			return [];
		}

		$args = [
			'taxonomy' => $taxonomy,
			'hide_empty' => $hide_empty === 'yes',
			'orderby' => $orderby,
			'order' => $order,
		];

		// Include specific terms
		if (!empty($settings['include_terms'])) {
			$include_ids = array_map('intval', explode(',', $settings['include_terms']));
			$args['include'] = $include_ids;
		}

		// Exclude specific terms
		if (!empty($settings['exclude_terms'])) {
			$exclude_ids = array_map('intval', explode(',', $settings['exclude_terms']));
			$args['exclude'] = $exclude_ids;
		}

		// Parent term
		if (!empty($settings['parent_term'])) {
			$args['parent'] = intval($settings['parent_term']);
		}

		// Show hierarchy
		if ($show_hierarchy === 'yes') {
			$args['hierarchical'] = true;
		}

		// Handle only parent terms
		if ($only_parent === 'yes') {
			$args['parent'] = 0; // Get only top-level terms
			return get_terms($args);
		}

		// Show subcategories - if enabled, get all terms including children recursively
		if ($show_subcategory === 'yes') {
			$args['parent'] = 0; // Get only top-level terms first
			$top_level_terms = get_terms($args);

			if (is_wp_error($top_level_terms)) {
				return $top_level_terms;
			}

			$all_terms = [];

			foreach ($top_level_terms as $term) {
				// Add the parent term
				$all_terms[] = $term;

				// Get all children recursively
				$this->get_all_children_recursive($term, $args, $all_terms);
			}

			return $all_terms;
		}

		return get_terms($args);
	}

	/**
	 * Recursively get all children of a term
	 *
	 * @since 1.0.0
	 * @access private
	 * @param object $parent_term The parent term
	 * @param array $args Query arguments
	 * @param array &$all_terms Reference to the array to store all terms
	 * @param int $level Current nesting level
	 */
	private function get_all_children_recursive($parent_term, $args, &$all_terms, $level = 1) {
		$child_args = $args;
		$child_args['parent'] = $parent_term->term_id;
		$child_terms = get_terms($child_args);

		if (!is_wp_error($child_terms) && !empty($child_terms)) {
			foreach ($child_terms as $child_term) {
				// Mark as child term for nested display
				$child_term->is_child = true;
				$child_term->parent_id = $parent_term->term_id;
				$child_term->level = $level; // Store the nesting level
				$all_terms[] = $child_term;

				// Recursively get children of this child
				$this->get_all_children_recursive($child_term, $args, $all_terms, $level + 1);
			}
		}
	}

	/**
	 * Recursively render nested children with proper indentation
	 *
	 * @since 1.0.0
	 * @access private
	 * @param array $terms All terms array
	 * @param int $parent_id Parent term ID
	 * @param string $show_count Whether to show count
	 * @param int $level Current nesting level
	 */
	private function render_nested_children($terms, $parent_id, $show_count, $level = 1) {
		foreach ($terms as $term) {
			if (isset($term->is_child) && $term->is_child && $term->parent_id === $parent_id) {
				$term_url = get_term_link($term);
				$padding_left = $level * 15; // 15px per level
?>
				<li class="topppa-taxonomy-item subcategory" data-term-slug="<?php echo esc_attr($term->slug); ?>" style="padding-left: <?php echo esc_attr($padding_left); ?>px;">
					<a href="<?php echo esc_url($term_url); ?>">
						<span class="topppa-term-name"><?php echo esc_html($term->name); ?></span>
						<?php if ($show_count === 'yes'): ?>
							<span class="topppa-term-count">(<?php echo esc_html($term->count); ?>)</span>
						<?php endif; ?>
					</a>
				</li>
		<?php
				// Recursively render children of this child
				$this->render_nested_children($terms, $term->term_id, $show_count, $level + 1);
			}
		}
	}

	/**
	 * Render dropdown taxonomy widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();

		// Set default values to prevent undefined array key warnings
		$taxonomy_name = $settings['taxonomy'] ?? 'category';
		$placeholder_text = $settings['placeholder_text'] ?? esc_html__('Select Category', 'topper-pack');
		$show_count = $settings['show_count'] ?? 'no';
		$display_type = $settings['display_type'] ?? 'dropdown';
		$dropdown_behavior = $settings['dropdown_behavior'] ?? 'click';
		$only_parent = $settings['only_parent'] ?? 'yes';
		$show_subcategory = $settings['show_subcategory'] ?? 'yes';

		// Get terms
		$terms = $this->get_terms();

		if (is_wp_error($terms) || empty($terms)) {
			return;
		}

		$taxonomy = get_taxonomy($taxonomy_name);
		if (!$taxonomy) {
			return;
		}

		$widget_id = 'topppa-dropdown-taxonomy-' . $this->get_id();

		?>
		<?php if ($display_type === 'dropdown'): ?>
			<div class="topppa-dropdown-taxonomy-widget topppa-dropdown-taxonomy" data-widget-id="<?php echo esc_attr($widget_id); ?>" data-behavior="<?php echo esc_attr($dropdown_behavior); ?>">
				<div class="topppa-dropdown-trigger">
					<div class="topppa-dropdown-trigger-icon">
						<?php \Elementor\Icons_Manager::render_icon($settings['dropdown_icon'], ['aria-hidden' => 'true']); ?>
					</div>
					<?php if (!empty($placeholder_text)): ?>
						<div class="topppa-trigger-text"><?php echo esc_html($placeholder_text); ?></div>
					<?php endif; ?>
				</div>
				<div class="topppa-taxonomy-list">
					<ul class="topppa-taxonomy-ul">
						<?php
						// If only parent is enabled, render all terms as simple list
						if ($only_parent === 'yes') {
							foreach ($terms as $term) {
								$term_url = get_term_link($term);
						?>
								<li class="topppa-taxonomy-item" data-term-slug="<?php echo esc_attr($term->slug); ?>">
									<a href="<?php echo esc_url($term_url); ?>">
										<span class="topppa-term-name"><?php echo esc_html($term->name); ?></span>
										<?php if ($show_count === 'yes'): ?>
											<span class="topppa-term-count">(<?php echo esc_html($term->count); ?>)</span>
										<?php endif; ?>
									</a>
								</li>
								<?php
							}
						} else {
							// Handle subcategory display with multiple levels
							$processed_parents = [];

							// First, render all parent terms (non-child terms)
							foreach ($terms as $term) {
								$is_child = isset($term->is_child) && $term->is_child;
								if (!$is_child) {
									$term_url = get_term_link($term);
								?>
									<li class="topppa-taxonomy-item parent-category" data-term-slug="<?php echo esc_attr($term->slug); ?>">
										<a href="<?php echo esc_url($term_url); ?>">
											<span class="topppa-term-name"><?php echo esc_html($term->name); ?></span>
											<?php if ($show_count === 'yes'): ?>
												<span class="topppa-term-count">(<?php echo esc_html($term->count); ?>)</span>
											<?php endif; ?>
										</a>
									</li>
									<?php

									// Check if this parent has children
									$has_children = false;
									foreach ($terms as $child_term) {
										if (isset($child_term->is_child) && $child_term->is_child && $child_term->parent_id === $term->term_id) {
											$has_children = true;
											break;
										}
									}

									// If it has children, render them
									if ($has_children) {
									?>
										<li class="topppa-subcategory-group">
											<ul class="topppa-subcategory-list">
												<?php
												// Render all children of this parent with proper nesting
												$this->render_nested_children($terms, $term->term_id, $show_count, 1);
												?>
											</ul>
										</li>
						<?php
									}
								}
							}
						}
						?>
					</ul>
				</div>
			</div>
		<?php else: ?>
			<div class="topppa-dropdown-taxonomy-widget topppa-show-all-taxonomy" data-widget-id="<?php echo esc_attr($widget_id); ?>">
				<?php if (!empty($placeholder_text)): ?>
					<div class="topppa-show-all-title"><?php echo esc_html($placeholder_text); ?></div>
				<?php endif; ?>
				<ul class="topppa-taxonomy-ul">
					<?php
					// If only parent is enabled, render all terms as simple list
					if ($only_parent === 'yes') {
						foreach ($terms as $term) {
							$term_url = get_term_link($term);
					?>
							<li class="topppa-taxonomy-item" data-term-slug="<?php echo esc_attr($term->slug); ?>">
								<a href="<?php echo esc_url($term_url); ?>">
									<span class="topppa-term-name"><?php echo esc_html($term->name); ?></span>
									<?php if ($show_count === 'yes'): ?>
										<span class="topppa-term-count">(<?php echo esc_html($term->count); ?>)</span>
									<?php endif; ?>
								</a>
							</li>
							<?php
						}
					} else {
						// Handle subcategory display with multiple levels
						$processed_parents = [];

						// First, render all parent terms (non-child terms)
						foreach ($terms as $term) {
							$is_child = isset($term->is_child) && $term->is_child;
							if (!$is_child) {
								$term_url = get_term_link($term);
							?>
								<li class="topppa-taxonomy-item parent-category" data-term-slug="<?php echo esc_attr($term->slug); ?>">
									<a href="<?php echo esc_url($term_url); ?>">
										<span class="topppa-term-name"><?php echo esc_html($term->name); ?></span>
										<?php if ($show_count === 'yes'): ?>
											<span class="topppa-term-count">(<?php echo esc_html($term->count); ?>)</span>
										<?php endif; ?>
									</a>
								</li>
								<?php

								// Check if this parent has children
								$has_children = false;
								foreach ($terms as $child_term) {
									if (isset($child_term->is_child) && $child_term->is_child && $child_term->parent_id === $term->term_id) {
										$has_children = true;
										break;
									}
								}

								// If it has children, render them
								if ($has_children) {
								?>
									<li class="topppa-subcategory-group">
										<ul class="topppa-subcategory-list">
											<?php
											// Render all children of this parent with proper nesting
											$this->render_nested_children($terms, $term->term_id, $show_count, 1);
											?>
										</ul>
									</li>
					<?php
								}
							}
						}
					}
					?>
				</ul>
			</div>
		<?php endif; ?>
<?php
	}
}