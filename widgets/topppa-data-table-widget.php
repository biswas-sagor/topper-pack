<?php

use \TopperPack\Includes\Controls\Controls_Manager as TopperPack_Controls_Manager;

if (! defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}

/**
 * Elementor topppa Data Table Widget.
 *
 * Elementor widget that creates a dynamic data table with customizable headers and rows.
 *
 * @since 1.0.0
 */
class TOPPPA_Data_Table_Widget extends \Elementor\Widget_Base {

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
		return 'topppa_data_table';
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
		return TOPPPA_EPWB . esc_html__('Data Table', 'topper-pack');
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
		return 'eicon-table';
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
		return ['topppa', 'widget', 'data', 'table', 'topperpack'];
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
		return 'https://doc.topperpack.com/docs/general-widgets/data-table/';
	}

	/**
	 * Register Data Table widget controls.
	 *
	 * Add input fields to allow the user to customize the widget settings.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function register_controls() {

		// Table Head Section
		$this->start_controls_section(
			'topppa_table_head_section',
			[
				'label' => esc_html__('Table Head', 'topper-pack'),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$head_repeater = new \Elementor\Repeater();

		$head_repeater->start_controls_tabs('head_content_tabs');

		$head_repeater->start_controls_tab(
			'head_content_tab',
			[
				'label' => esc_html__('Content', 'topper-pack'),
			]
		);

		$head_repeater->add_control(
			'head_title',
			[
				'label' => esc_html__('Title', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__('Column Title', 'topper-pack'),
				'dynamic' => [
					'active' => true,
				],
			]
		);

		$head_repeater->add_control(
			'head_col_span',
			[
				'label' => esc_html__('Col Span', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'min' => 1,
				'max' => 20,
				'step' => 1,
				'default' => 1,
			]
		);

		$head_repeater->add_control(
			'head_enable_icon',
			[
				'label' => esc_html__('Enable Icon', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Show', 'topper-pack'),
				'label_off' => esc_html__('Hide', 'topper-pack'),
				'return_value' => 'yes',
				'default' => 'no',
			]
		);

		$head_repeater->add_control(
			'head_icon',
			[
				'label' => esc_html__('Icon', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::ICONS,
				'default' => [
					'value' => 'fas fa-check',
					'library' => 'fa-solid',
				],
				'condition' => [
					'head_enable_icon' => 'yes',
				],
			]
		);

		$head_repeater->end_controls_tab();

		$head_repeater->start_controls_tab(
			'head_style_tab',
			[
				'label' => esc_html__('Style', 'topper-pack'),
			]
		);

		$head_repeater->add_responsive_control(
			'head_text_color',
			[
				'label' => esc_html__('Text Color', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}}' => 'color: {{VALUE}};',
				],
			]
		);

		$head_repeater->add_responsive_control(
			'head_bg_color',
			[
				'label' => esc_html__('Background Color', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}}' => 'background-color: {{VALUE}};',
				],
			]
		);
		$head_repeater->add_responsive_control(
			'head_border_color',
			[
				'label' => esc_html__('Border Color', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}}' => 'border-color: {{VALUE}};',
				],
			]
		);
		$head_repeater->add_control(
			'head_icon_note',
			[
				'label' => esc_html__('Icon Style', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => [
					'head_enable_icon' => 'yes',
				],
			]
		);
		$head_repeater->add_responsive_control(
			'head_icon_color',
			[
				'label' => esc_html__('Icon Color', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}} .topppa-table-header-content .topppa-header-icon' => 'color: {{VALUE}};',
					'{{WRAPPER}} {{CURRENT_ITEM}} .topppa-table-header-content .topppa-header-icon svg' => 'fill: {{VALUE}};',
				],
				'condition' => [
					'head_enable_icon' => 'yes',
				],
			]
		);
		$head_repeater->end_controls_tab();
		$head_repeater->end_controls_tabs();

		$this->add_control(
			'table_head_list',
			[
				'label' => esc_html__('Table Headers', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $head_repeater->get_controls(),
				'default' => [
					[
						'head_title' => esc_html__('Name', 'topper-pack'),
					],
					[
						'head_title' => esc_html__('Email', 'topper-pack'),
					],
					[
						'head_title' => esc_html__('Phone', 'topper-pack'),
					],
				],
				'title_field' => '{{{ head_title }}}',
			]
		);

		$this->add_responsive_control(
			'head_alignment',
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
				'default' => 'left',
				'selectors' => [
					'{{WRAPPER}} .topppa-data-table thead th' => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'head_icon_position',
			[
				'label' => esc_html__('Icon Position', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'options' => [
					'row' => [
						'title' => esc_html__('Left', 'topper-pack'),
						'icon' => 'eicon-h-align-left',
					],
					'column' => [
						'title' => esc_html__('Top', 'topper-pack'),
						'icon' => 'eicon-v-align-top',
					],
					'row-reverse' => [
						'title' => esc_html__('Right', 'topper-pack'),
						'icon' => 'eicon-h-align-right',
					],
					'column-reverse' => [
						'title' => esc_html__('Bottom', 'topper-pack'),
						'icon' => 'eicon-v-align-bottom',
					],
				],
				'default' => 'row',
				'toggle' => false,
				'selectors' => [
					'{{WRAPPER}} .topppa-data-table .topppa-table-header-content' => 'flex-direction: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();

		// Table Row Section
		$this->start_controls_section(
			'topppa_table_row_section',
			[
				'label' => esc_html__('Table Row', 'topper-pack'),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$row_repeater = new \Elementor\Repeater();

		$row_repeater->add_control(
			'row_type',
			[
				'label' => esc_html__('Row/Column', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'row',
				'options' => [
					'row' => esc_html__('Row', 'topper-pack'),
					'column' => esc_html__('Column', 'topper-pack'),
				],
			]
		);

		$row_repeater->start_controls_tabs('row_content_tabs');

		$row_repeater->start_controls_tab(
			'row_content_tab',
			[
				'label' => esc_html__('Content', 'topper-pack'),
				'condition' => [
					'row_type' => 'column',
				],
			]
		);

		$row_repeater->add_control(
			'cell_title',
			[
				'label' => esc_html__('Title', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__('Cell Content', 'topper-pack'),
				'dynamic' => [
					'active' => true,
				],
				'condition' => [
					'row_type' => 'column',
				],
			]
		);

		$row_repeater->add_control(
			'cell_link',
			[
				'label' => esc_html__('Link', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::URL,
				'placeholder' => esc_html__('https://example.com', 'topper-pack'),
				'dynamic' => [
					'active' => true,
				],
				'condition' => [
					'row_type' => 'column',
				],
			]
		);

		$row_repeater->add_control(
			'cell_col_span',
			[
				'label' => esc_html__('Col Span', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'min' => 1,
				'max' => 20,
				'step' => 1,
				'default' => 1,
				'condition' => [
					'row_type' => 'column',
				],
			]
		);

		$row_repeater->add_control(
			'cell_row_span',
			[
				'label' => esc_html__('Row Span', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'min' => 1,
				'max' => 20,
				'step' => 1,
				'default' => 1,
				'condition' => [
					'row_type' => 'column',
				],
			]
		);

		$row_repeater->add_control(
			'cell_enable_icon',
			[
				'label' => esc_html__('Enable Icon', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Show', 'topper-pack'),
				'label_off' => esc_html__('Hide', 'topper-pack'),
				'return_value' => 'yes',
				'default' => 'no',
				'condition' => [
					'row_type' => 'column',
				],
			]
		);

		$row_repeater->add_control(
			'cell_icon',
			[
				'label' => esc_html__('Icon', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::ICONS,
				'default' => [
					'value' => 'fas fa-check',
					'library' => 'fa-solid',
				],
				'condition' => [
					'row_type' => 'column',
					'cell_enable_icon' => 'yes',
				],
			]
		);

		$row_repeater->end_controls_tab();

		$row_repeater->start_controls_tab(
			'row_style_tab',
			[
				'label' => esc_html__('Style', 'topper-pack'),
				'condition' => [
					'row_type' => 'column',
				],
			]
		);

		$row_repeater->add_responsive_control(
			'cell_text_color',
			[
				'label' => esc_html__('Text Color', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}}' => 'color: {{VALUE}};',
				],
				'condition' => [
					'row_type' => 'column',
				],
			]
		);

		$row_repeater->add_responsive_control(
			'cell_bg_color',
			[
				'label' => esc_html__('Background Color', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}}' => 'background-color: {{VALUE}};',
				],
				'condition' => [
					'row_type' => 'column',
				],
			]
		);
		$row_repeater->add_responsive_control(
			'cell_border_color',
			[
				'label' => esc_html__('Border Color', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}}' => 'border-color: {{VALUE}};',
				],
				'condition' => [
					'row_type' => 'column',
				],
			]
		);
		$row_repeater->add_control(
			'cell_icon_note',
			[
				'label' => esc_html__('Icon Style', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => [
					'cell_enable_icon' => 'yes',
					'row_type' => 'column',
				],
			]
		);
		$row_repeater->add_responsive_control(
			'cell_icon_color',
			[
				'label' => esc_html__('Icon Color', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}} .topppa-table-cell-content .topppa-cell-icon' => 'color: {{VALUE}};',
					'{{WRAPPER}} {{CURRENT_ITEM}} .topppa-table-cell-content .topppa-cell-icon svg' => 'fill: {{VALUE}};',
				],
				'condition' => [
					'cell_enable_icon' => 'yes',
					'row_type' => 'column',
				],
			]
		);
		$row_repeater->end_controls_tab();
		$row_repeater->end_controls_tabs();

		$this->add_control(
			'table_row_list',
			[
				'label' => esc_html__('Table Data', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $row_repeater->get_controls(),
				'default' => [
					[
						'cell_title' => esc_html__('Row 1', 'topper-pack'),
						'row_type' => 'row',
					],
					[
						'cell_title' => esc_html__('Devin Smith', 'topper-pack'),
						'row_type' => 'column',
					],
					[
						'cell_title' => esc_html__('john.doe@example.com', 'topper-pack'),
						'row_type' => 'column',
					],
					[
						'cell_title' => esc_html__('123-456-7890', 'topper-pack'),
						'row_type' => 'column',
					],
					[
						'cell_title' => esc_html__('Row 2', 'topper-pack'),
						'row_type' => 'row',
					],
					[
						'cell_title' => esc_html__('John Doe', 'topper-pack'),
						'row_type' => 'column',
					],
					[
						'cell_title' => esc_html__('jane.smith@example.com', 'topper-pack'),
						'row_type' => 'column',
					],
					[
						'cell_title' => esc_html__('987-654-3210', 'topper-pack'),
						'row_type' => 'column',
					],
				],
				'title_field' => '<# if ( row_type == "row" ) { #>Row Start<# } else { #>{{{ cell_title }}}<# } #>',
			]
		);

		$this->add_responsive_control(
			'row_alignment',
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
				'default' => 'left',
				'selectors' => [
					'{{WRAPPER}} .topppa-data-table tbody td' => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'row_icon_position',
			[
				'label' => esc_html__('Icon Position', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'options' => [
					'row' => [
						'title' => esc_html__('Left', 'topper-pack'),
						'icon' => 'eicon-h-align-left',
					],
					'column' => [
						'title' => esc_html__('Top', 'topper-pack'),
						'icon' => 'eicon-v-align-top',
					],
					'row-reverse' => [
						'title' => esc_html__('Right', 'topper-pack'),
						'icon' => 'eicon-h-align-right',
					],
					'column-reverse' => [
						'title' => esc_html__('Bottom', 'topper-pack'),
						'icon' => 'eicon-v-align-bottom',
					],
				],
				'default' => 'row',
				'toggle' => false,
				'selectors' => [
					'{{WRAPPER}} .topppa-data-table .topppa-table-cell-content' => 'flex-direction: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();

		// Table Style Section
		$this->start_controls_section(
			'topppa_table_style_section',
			[
				'label' => esc_html__('Table Style', 'topper-pack'),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'table_width',
			[
				'label' => esc_html__('Table Width', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px', '%'],
				'range' => [
					'px' => [
						'min' => 300,
						'max' => 2000,
					],
					'%' => [
						'min' => 10,
						'max' => 100,
					],
				],
				'default' => [
					'unit' => '%',
					'size' => 100,
				],
				'selectors' => [
					'{{WRAPPER}} .topppa-data-table' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'table_border',
				'selector' => '{{WRAPPER}} .topppa-data-table',
			]
		);

		$this->add_responsive_control(
			'table_border_radius',
			[
				'label' => esc_html__('Border Radius', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors' => [
					'{{WRAPPER}} .topppa-data-table' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'table_box_shadow',
				'selector' => '{{WRAPPER}} .topppa-data-table',
			]
		);

		$this->end_controls_section();

		// Header Style Section
		$this->start_controls_section(
			'topppa_header_style_section',
			[
				'label' => esc_html__('Header Style', 'topper-pack'),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'header_typography',
				'selector' => '{{WRAPPER}} .topppa-data-table thead th',
			]
		);

		$this->add_control(
			'header_text_color',
			[
				'label' => esc_html__('Text Color', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .topppa-data-table thead th' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'header_background',
				'types' => ['classic', 'gradient', 'video'],
				'selector' => '{{WRAPPER}} .topppa-data-table thead th',
			]
		);

		$this->add_responsive_control(
			'header_padding',
			[
				'label' => esc_html__('Padding', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors' => [
					'{{WRAPPER}} .topppa-data-table thead th' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'header_border',
				'selector' => '{{WRAPPER}} .topppa-data-table thead th',
			]
		);

		$this->add_control(
			'header_icon_notes',
			[
				'label' => esc_html__('Icon Style', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_responsive_control(
			'header_icon_color',
			[
				'label' => esc_html__('Icon Color', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .topppa-data-table thead th .topppa-table-header-content .topppa-header-icon' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_responsive_control(
			'header_icon_size',
			[
				'label' => esc_html__('Icon Size', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px', 'em', 'rem', 'custom'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 50,
						'step' => 1,
					]
				],
				'selectors' => [
					'{{WRAPPER}} .topppa-data-table thead th .topppa-table-header-content .topppa-header-icon' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);
		
		$this->add_control(
			'svg_icon_note',
			[
				'label' => esc_html__( 'SVG Icon Style', 'topper-pack' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_responsive_control(
			'header_icon_svg_color',
			[
				'label' => esc_html__( 'SVG Icon Color', 'topper-pack' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .topppa-data-table thead th .topppa-table-header-content .topppa-header-icon svg' => 'fill: {{VALUE}}',
				],
			]
		);
		$this->add_responsive_control(
			'header_icon_svg_size',
			[
				'label' => esc_html__( 'SVG Icon Size', 'topper-pack' ),
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
					'{{WRAPPER}} .topppa-data-table thead th .topppa-table-header-content .topppa-header-icon svg' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();

		// Body Style Section
		$this->start_controls_section(
			'topppa_body_style_section',
			[
				'label' => esc_html__('Body Style', 'topper-pack'),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'body_typography',
				'selector' => '{{WRAPPER}} .topppa-data-table tbody td',
			]
		);

		$this->add_control(
			'body_text_color',
			[
				'label' => esc_html__('Text Color', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .topppa-data-table tbody td' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'body_background',
				'types' => ['classic', 'gradient', 'video'],
				'selector' => '{{WRAPPER}} .topppa-data-table tbody td',
			]
		);

		$this->add_responsive_control(
			'body_padding',
			[
				'label' => esc_html__('Padding', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors' => [
					'{{WRAPPER}} .topppa-data-table tbody td' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'body_border',
				'selector' => '{{WRAPPER}} .topppa-data-table tbody td',
			]
		);

		// Stripe Background
		$this->add_control(
			'stripe_heading',
			[
				'label' => esc_html__('Stripe Background', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'enable_stripe',
			[
				'label' => esc_html__('Enable Stripe', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Yes', 'topper-pack'),
				'label_off' => esc_html__('No', 'topper-pack'),
				'return_value' => 'yes',
				'default' => 'no',
			]
		);

		$this->add_control(
			'stripe_odd_color',
			[
				'label' => esc_html__('Odd Row Color', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .topppa-data-table tbody tr:nth-child(odd) td' => 'background-color: {{VALUE}};',
				],
				'condition' => [
					'enable_stripe' => 'yes',
				],
			]
		);

		$this->add_control(
			'stripe_even_color',
			[
				'label' => esc_html__('Even Row Color', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .topppa-data-table tbody tr:nth-child(even) td' => 'background-color: {{VALUE}};',
				],
				'condition' => [
					'enable_stripe' => 'yes',
				],
			]
		);

		$this->add_control(
			'cell_icon_notes',
			[
				'label' => esc_html__('Icon Style', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_responsive_control(
			'cell_icon_color',
			[
				'label' => esc_html__('Icon Color', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .topppa-data-table tbody td .topppa-table-cell-content .topppa-cell-icon' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_responsive_control(
			'cell_icon_size',
			[
				'label' => esc_html__('Icon Size', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px', 'em', 'rem', 'custom'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 50,
						'step' => 1,
					]
				],
				'selectors' => [
					'{{WRAPPER}} .topppa-data-table tbody td .topppa-table-cell-content .topppa-cell-icon' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);
		
		$this->add_control(
			'cell_svg_icon_note',
			[
				'label' => esc_html__( 'SVG Icon Style', 'topper-pack' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_responsive_control(
			'cell_icon_svg_color',
			[
				'label' => esc_html__( 'SVG Icon Color', 'topper-pack' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .topppa-data-table tbody td .topppa-table-cell-content .topppa-cell-icon svg' => 'fill: {{VALUE}}',
				],
			]
		);
		$this->add_responsive_control(
			'cell_icon_svg_size',
			[
				'label' => esc_html__( 'SVG Icon Size', 'topper-pack' ),
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
					'{{WRAPPER}} .topppa-data-table tbody td .topppa-table-cell-content .topppa-cell-icon svg' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();
	}

	/**
	 * Helper function to generate table structure
	 */
	private function get_table_structure($settings) {
		$headers = $settings['table_head_list'] ?? [];
		$rows = $settings['table_row_list'] ?? [];

		// Group items into rows based on row_type
		$table_rows = [];
		$current_row = [];

		foreach ($rows as $index => $item) {
			// If this is a "row" type and we already have items in current_row, save the current row
			if ($item['row_type'] === 'row' && !empty($current_row)) {
				$table_rows[] = $current_row;
				$current_row = [];
			}

			// Only add "column" type items to the row (skip "row" type as they are just row indicators)
			if ($item['row_type'] === 'column') {
				$current_row[] = $item;
			}
		}

		// Add the last row if it has content
		if (!empty($current_row)) {
			$table_rows[] = $current_row;
		}

		return [
			'headers' => $headers,
			'rows' => $table_rows
		];
	}

	/**
	 * Render cell content with icon and link support
	 */
	private function render_cell_content($item, $cell_class = '') {
		$has_link = !empty($item['cell_link']['url']);
		$has_icon = !empty($item['cell_enable_icon']) && $item['cell_enable_icon'] === 'yes' && !empty($item['cell_icon']['value']);

		if ($has_link) {
			echo '<a href="' . esc_url($item['cell_link']['url']) . '"';
			if ($item['cell_link']['is_external']) {
				echo ' target="_blank"';
			}
			if ($item['cell_link']['nofollow']) {
				echo ' rel="nofollow"';
			}
			echo ' class="' . esc_attr($cell_class) . '">';
		}

		if ($has_icon) {
			echo '<span class="topppa-cell-icon">';
			\Elementor\Icons_Manager::render_icon($item['cell_icon'], ['aria-hidden' => 'true']);
			echo '</span>';
		}

		if (!empty($item['cell_title'])) {
			echo '<span class="topppa-cell-text">' . esc_html($item['cell_title']) . '</span>';
		}

		if ($has_link) {
			echo '</a>';
		}
	}

	/**
	 * Render header cell content
	 */
	private function render_header_content($item) {
		$has_icon = !empty($item['head_enable_icon']) && $item['head_enable_icon'] === 'yes' && !empty($item['head_icon']['value']);

		if ($has_icon) {
			echo '<span class="topppa-header-icon">';
			\Elementor\Icons_Manager::render_icon($item['head_icon'], ['aria-hidden' => 'true']);
			echo '</span>';
		}

		if (!empty($item['head_title'])) {
			echo '<span class="topppa-header-text">' . esc_html($item['head_title']) . '</span>';
		}
	}

	/**
	 * Render Data Table widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();
		$table_data = $this->get_table_structure($settings);
		$stripe_class = $settings['enable_stripe'] === 'yes' ? 'topppa-stripe-enabled' : '';

?>
		<div class="topppa-data-table-widget">
			<div class="topppa-data-table-widget-inner">
				<table class="topppa-data-table <?php echo esc_attr($stripe_class); ?>">
					<?php if (!empty($table_data['headers'])) : ?>
						<thead>
							<tr>
								<?php foreach ($table_data['headers'] as $index => $header) :
									$header_class = 'elementor-repeater-item-' . $header['_id'];
									$colspan = !empty($header['head_col_span']) ? $header['head_col_span'] : 1;
								?>
									<th class="<?php echo esc_attr($header_class); ?>" colspan="<?php echo esc_attr($colspan); ?>">
										<div class="topppa-table-header-content">
											<?php $this->render_header_content($header); ?>
										</div>
									</th>
								<?php endforeach; ?>
							</tr>
						</thead>
					<?php endif; ?>

					<?php if (!empty($table_data['rows'])) : ?>
						<tbody>
							<?php foreach ($table_data['rows'] as $row_index => $row) : ?>
								<tr>
									<?php foreach ($row as $cell_index => $cell) :
										$cell_class = 'elementor-repeater-item-' . $cell['_id'];
										$colspan = !empty($cell['cell_col_span']) ? $cell['cell_col_span'] : 1;
										$rowspan = !empty($cell['cell_row_span']) ? $cell['cell_row_span'] : 1;
									?>
										<td class="<?php echo esc_attr($cell_class); ?>"
											colspan="<?php echo esc_attr($colspan); ?>"
											rowspan="<?php echo esc_attr($rowspan); ?>">
											<div class="topppa-table-cell-content">
												<?php $this->render_cell_content($cell, 'topppa-cell-content'); ?>
											</div>
										</td>
									<?php endforeach; ?>
								</tr>
							<?php endforeach; ?>
						</tbody>
					<?php endif; ?>
				</table>
			</div>
		</div>
<?php
	}
}