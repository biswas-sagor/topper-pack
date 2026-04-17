<?php

use \TopperPack\Includes\Controls\Controls_Manager as TopperPack_Controls_Manager;

if (! defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}

/**
 * Elementor topppa Contact Form Widget.
 *
 * Elementor widget that inserts an embbedable content into the page, from any given URL.
 *
 * @since 1.0.0
 */
class TOPPPA_Contact_Form_Widget extends \Elementor\Widget_Base {

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
		return 'topppa_contact_form7_widget';
		return 'topppa_contact_form7';
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
		return TOPPPA_EPWB . esc_html__('Contact Form', 'topper-pack');
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
		return 'eicon-mail';
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
		return ['topppa', 'widget', 'contact', 'form', 'topperpack'];
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
		return 'https://doc.topperpack.com/docs/service-widgets/contact-form/';
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
		return 'https://topperpack.com/assets/widgets/contact-form-widget/';
	}

	public function topppa_ctf7_forms() {
		$formlist = array();
		$forms_args = array('posts_per_page' => -1, 'post_type' => 'wpcf7_contact_form');
		$forms = get_posts($forms_args);
		if ($forms) {
			foreach ($forms as $form) {
				$formlist[$form->ID] = $form->post_title;
			}
		} else {
			$formlist['0'] = __('Form not found', 'topper-pack');
		}
		return $formlist;
	}

	/**
	 * Register Contact Form Widget controls.
	 *
	 * Add input fields to allow the user to customize the widget settings.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function register_controls() {
		$base_url = $this->get_custom_image_url();
		// <========================> topppa SERVICE STYLES <========================>

		$this->start_controls_section(
			'topppa_style_img',
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
						'imagelarge' => $base_url . 'topppa-contact-form-1.jpg',
						'imagesmall' => $base_url . 'topppa-contact-form-1.jpg',
						'width' => '100%',
					],
					'style_two' => [
						'title' => esc_html__('style 2', 'topper-pack'),
						'imagelarge' => $base_url . 'topppa-contact-form-2.jpg',
						'imagesmall' => $base_url . 'topppa-contact-form-2.jpg',
						'width' => '100%',
					],
					'style_three' => [
						'title' => esc_html__('style 3', 'topper-pack'),
						'imagelarge' => $base_url . 'topppa-contact-form-3.jpg',
						'imagesmall' => $base_url . 'topppa-contact-form-3.jpg',
						'width' => '100%',
					],
					'style_four' => [
						'title' => esc_html__('style 4', 'topper-pack'),
						'imagelarge' => $base_url . 'topppa-contact-form-4.jpg',
						'imagesmall' => $base_url . 'topppa-contact-form-4.jpg',
						'width' => '100%',
					],
				],
			]
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'topppa_ctf7_options',
			[
				'label' => esc_html__('Contact Form', 'topper-pack'),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'topppa_ctf7_id',
			[
				'label'       => __('Select Form', 'topper-pack'),
				'type'        => \Elementor\Controls_Manager::SELECT,
				'label_block' => true,
				'options'     => $this->topppa_ctf7_forms(),
				'default'     => '0',
			]
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'form_top_contents',
			[
				'label' => esc_html__('Form Contents', 'topper-pack'),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'enable_title_box',
			[
				'label' => esc_html__('Enable Title Box', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Show', 'topper-pack'),
				'label_off' => esc_html__('Hide', 'topper-pack'),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);
		$this->add_control(
			'enable_sub_title',
			[
				'label' => esc_html__('Enable Sub Title', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Show', 'topper-pack'),
				'label_off' => esc_html__('Hide', 'topper-pack'),
				'return_value' => 'yes',
				'default' => 'no',
				'condition' => [
					'enable_title_box' => 'yes',
				],
			]
		);
		$this->add_control(
			'form_sub_title',
			[
				'label' => esc_html__('Sub Title', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__('Talk to us', 'topper-pack'),
				'condition' => [
					'enable_sub_title' => 'yes',
					'enable_title_box' => 'yes',
				],
			]
		);

		$this->add_control(
			'enable_title',
			[
				'label' => esc_html__('Enable Title', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Show', 'topper-pack'),
				'label_off' => esc_html__('Hide', 'topper-pack'),
				'return_value' => 'yes',
				'default' => 'yes',
				'condition' => [
					'enable_title_box' => 'yes',
				],
			]
		);
		$this->add_control(
			'html_tag',
			[
				'label' => esc_html__('Title HTML Tag', 'topper-pack'),
				'description' => esc_html__('Add HTML Tag For Title', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'h3',
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
				'condition' => [
					'enable_title' => 'yes',
					'enable_title_box' => 'yes',
				],
			]
		);
		$this->add_control(
			'form_title',
			[
				'label' => esc_html__('Title', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::WYSIWYG,
				'default' => esc_html__('Do you have any question? ', 'topper-pack'),
				'condition' => [
					'enable_title' => 'yes',
					'enable_title_box' => 'yes',
				],
			]
		);

		$this->add_control(
			'enable_form_description',
			[
				'label' => esc_html__('Enable Description', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Show', 'topper-pack'),
				'label_off' => esc_html__('Hide', 'topper-pack'),
				'return_value' => 'yes',
				'default' => 'yes',
				'condition' => [
					'enable_title_box' => 'yes',
				],
			]
		);
		$this->add_control(
			'form_description',
			[
				'label' => esc_html__('Description', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'rows' => 10,
				'default' => esc_html__('Ecology is crucial for our understanding of the natural world, and is becoming increasingly important as human activities, such as pollution, deforestation, and climate change, have led to a decline', 'topper-pack'),
				'condition' => [
					'enable_form_description' => 'yes',
					'enable_title_box' => 'yes',
				],
			]
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'topppa_ctf7_box',
			[
				'label' => __('Form Box', 'topper-pack'),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'topppa_ctf7_box_blur',
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
					'{{WRAPPER}} .topppa-contact-form7' => 'backdrop-filter: blur({{SIZE}}{{UNIT}});',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name'     => 'topppa_ctf7_box_bg',
				'label'    => __('Background', 'topper-pack'),
				'types'    => ['classic', 'gradient'],
				'selector' => '{{WRAPPER}} .topppa-contact-form7',
			]
		);
		$this->add_responsive_control(
			'topppa_ctf7_box_align',
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
						'icon'  => 'eicon-text-align-right',
					],
				],
				'selectors' => [
					'{{WRAPPER}} .topppa-cf-section-title-wrapper' => 'text-align: {{VALUE}};',
				],
				'default'   => 'left',
				'separator' => 'before',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'topppa_ctf7_box_border',
				'selector' => '{{WRAPPER}} .topppa-contact-form7',
			]
		);
		$this->add_responsive_control(
			'topppa_ctf7_box_border_radius',
			[
				'label' => esc_html__('Border Radius', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .topppa-contact-form7' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'topppa_ctf7_box_shadow',
				'selector' => '{{WRAPPER}} .topppa-contact-form7',
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
			'topppa_ctf7_box_padding',
			[
				'label'      => __('Padding', 'topper-pack'),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors'  => [
					'{{WRAPPER}} .topppa-contact-form7' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'topppa_ctf7_box_margin',
			[
				'label'      => __('Margin', 'topper-pack'),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors'  => [
					'{{WRAPPER}} .topppa-contact-form7' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();

		// sub title
		$this->start_controls_section(
			'form_subtitle_style',
			[
				'label' => esc_html__('Sub Title', 'topper-pack'),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
				'condition' => [
					'enable_sub_title' => 'yes'
				]
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'sub_title_typo',
				'selector' => '{{WRAPPER}} .topppa-cf-section-title-wrapper .section-sub-title',
			]
		);
		$this->add_responsive_control(
			'sub_title_color',
			[
				'label'     => esc_html__('Color', 'topper-pack'),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .topppa-cf-section-title-wrapper .section-sub-title' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_responsive_control(
			'sub_title_margin',
			[
				'label'      => esc_html__('Margin', 'topper-pack'),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors'  => [
					'{{WRAPPER}} .topppa-cf-section-title-wrapper .section-sub-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'sub_title_padding',
			[
				'label'      => esc_html__('Padding', 'topper-pack'),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors'  => [
					'{{WRAPPER}} .topppa-cf-section-title-wrapper .section-sub-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();

		// title
		$this->start_controls_section(
			'form_title_style',
			[
				'label' => esc_html__('Title', 'topper-pack'),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
				'condition' => [
					'enable_title' => 'yes'
				]
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'section_title_typo',
				'selector' => '{{WRAPPER}} .topppa-cf-section-title-wrapper .section-title',
			]
		);
		$this->add_responsive_control(
			'section_title_color',
			[
				'label'     => esc_html__('Color', 'topper-pack'),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .topppa-cf-section-title-wrapper .section-title' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_responsive_control(
			'section_title_margin',
			[
				'label'      => esc_html__('Margin', 'topper-pack'),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors'  => [
					'{{WRAPPER}} .topppa-cf-section-title-wrapper .section-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'section_title_padding',
			[
				'label'      => esc_html__('Padding', 'topper-pack'),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors'  => [
					'{{WRAPPER}} .topppa-cf-section-title-wrapper .section-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();

		// description
		$this->start_controls_section(
			'form_description_style',
			[
				'label' => esc_html__('Description', 'topper-pack'),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
				'condition' => [
					'enable_form_description' => 'yes'
				]
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'section_desc_typo',
				'selector' => '{{WRAPPER}} .section-desc',
			]
		);
		$this->add_responsive_control(
			'section_desc_color',
			[
				'label'     => esc_html__('Color', 'topper-pack'),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .section-desc' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_responsive_control(
			'section_desc_margin',
			[
				'label'      => esc_html__('Margin', 'topper-pack'),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors'  => [
					'{{WRAPPER}} .section-desc' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'section_desc_padding',
			[
				'label'      => esc_html__('Padding', 'topper-pack'),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors'  => [
					'{{WRAPPER}} .section-desc' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();

		// Form Input
		$this->start_controls_section(
			'topppa_ctf7_input',
			[
				'label' => __('Form Input', 'topper-pack'),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_responsive_control(
			'topppa_ctf7_box_align_input',
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
						'icon'  => 'eicon-text-align-right',
					],
				],
				'selectors' => [
					'{{WRAPPER}} .topppa-contact-form7 input, .topppa-contact-form7 textarea, .topppa-contact-form7 select' => 'text-align: {{VALUE}};',
				],
				'default'   => 'left',
				'separator' => 'before',
			]
		);
		$this->add_responsive_control(
			'topppa_ctf7_input_height',
			[
				'label'     => __('Height', 'topper-pack'),
				'type'      => \Elementor\Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'max' => 150,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap input[type*="text"]'   => 'height: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap input[type*="email"]'  => 'height: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap input[type*="url"]'    => 'height: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap input[type*="number"]' => 'height: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap input[type*="tel"]'    => 'height: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap input[type*="date"]'   => 'height: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap .wpcf7-select'         => 'height: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap textarea'         => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'topppa_ctf7_input_width',
			[
				'label'      => __('Width', 'topper-pack'),
				'type'       => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px', '%'],
				'range'      => [
					'px' => [
						'min'  => 0,
						'max'  => 100,
						'step' => 1,
					],
					'%'  => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default' => [
					'unit' => '%',
					'size' => 100,
				],
				'selectors'  => [
					'{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap input[type*="text"]'   => 'width: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap input[type*="email"]'  => 'width: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap input[type*="url"]'    => 'width: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap input[type*="number"]' => 'width: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap input[type*="tel"]'    => 'width: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap input[type*="date"]'   => 'width: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap .wpcf7-select'         => 'width: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap textarea'              => 'width: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .topppa-contact-form7 label'                                   => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'topppa_ctf7_input_bg',
				'types' => ['classic', 'gradient', 'video'],
				'selector' => '{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap input[type*="text"], {{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap input[type*="email"], {{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap input[type*="url"] , {{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap input[type*="number"],{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap input[type*="tel"], {{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap input[type*="date"], {{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap .wpcf7-select, {{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap textarea',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'topppa_ctf7_input_typography',
				'selector' => '{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap input[type*="text"], {{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap input[type*="email"], {{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap input[type*="url"], {{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap input[type*="number"], {{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap input[type*="tel"], {{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap input[type*="date"], {{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap .wpcf7-select , {{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap textarea',
			]
		);
		$this->add_responsive_control(
			'topppa_ctf7_input_text_color',
			[
				'label'     => __('Color', 'topper-pack'),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap input[type*="text"]'   => 'color: {{VALUE}};',
					'{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap input[type*="email"]'  => 'color: {{VALUE}};',
					'{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap input[type*="url"]'    => 'color: {{VALUE}};',
					'{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap input[type*="number"]' => 'color: {{VALUE}};',
					'{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap input[type*="tel"]'    => 'color: {{VALUE}};',
					'{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap input[type*="date"]'   => 'color: {{VALUE}};',
					'{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap .wpcf7-select'         => 'color: {{VALUE}};',
					'{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap textarea'         => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_responsive_control(
			'topppa_ctf7_input_placeholder_color',
			[
				'label'     => __('Placeholder Color', 'topper-pack'),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap input[type*="text"]::-webkit-input-placeholder'   => 'color: {{VALUE}};',
					'{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap input[type*="text"]::-moz-placeholder'            => 'color: {{VALUE}};',
					'{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap input[type*="text"]:-ms-input-placeholder'        => 'color: {{VALUE}};',
					'{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap input[type*="email"]::-webkit-input-placeholder'  => 'color: {{VALUE}};',
					'{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap input[type*="email"]::-moz-placeholder'           => 'color: {{VALUE}};',
					'{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap input[type*="email"]:-ms-input-placeholder'       => 'color: {{VALUE}};',
					'{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap input[type*="url"]::-webkit-input-placeholder'    => 'color: {{VALUE}};',
					'{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap input[type*="url"]::-moz-placeholder'             => 'color: {{VALUE}};',
					'{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap input[type*="url"]:-ms-input-placeholder'         => 'color: {{VALUE}};',
					'{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap input[type*="number"]::-webkit-input-placeholder' => 'color: {{VALUE}};',
					'{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap input[type*="number"]::-moz-placeholder'          => 'color: {{VALUE}};',
					'{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap input[type*="number"]:-ms-input-placeholder'      => 'color: {{VALUE}};',
					'{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap input[type*="tel"]::-webkit-input-placeholder'    => 'color: {{VALUE}};',
					'{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap input[type*="tel"]::-moz-placeholder'             => 'color: {{VALUE}};',
					'{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap input[type*="tel"]:-ms-input-placeholder'         => 'color: {{VALUE}};',
					'{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap input[type*="date"]::-webkit-input-placeholder'   => 'color: {{VALUE}};',
					'{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap input[type*="date"]::placeholder'                 => 'color: {{VALUE}};',
					'{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap textarea::placeholder'                            => 'color: {{VALUE}};',
					'{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap input[type*="date"]:-ms-input-placeholder'        => 'color: {{VALUE}};',
					'{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap .wpcf7-select'                                    => 'color: {{VALUE}};',
					'{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap input[type*="date"]'   => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'calendar_icon_invert',
			[
				'label' => __('Calendar Icon Invert', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [''],
				'range' => [
					'' => [
						'min' => 0,
						'max' => 1,
						'step' => 0.1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} input[type="date"]::-webkit-calendar-picker-indicator' => 'filter: invert({{SIZE}});',
				],
			]
		);
		$this->add_responsive_control(
			'input_option_color',
			[
				'label' => esc_html__('Select Option Color', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} select.form-select option' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_responsive_control(
			'input_option_bg_color',
			[
				'label' => esc_html__('Select Option Background Color', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} select.form-select option' => 'background-color: {{VALUE}}',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name'     => 'topppa_ctf7_input_border',
				'label'    => __('Border', 'topper-pack'),
				'selector' => '{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap input[type*="text"], {{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap input[type*="email"], {{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap input[type*="url"], {{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap input[type*="number"], {{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap input[type*="tel"], {{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap input[type*="date"], {{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap .wpcf7-select , {{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap textarea',
			]
		);
		$this->add_responsive_control(
			'topppa_ctf7_input_border_radius',
			[
				'label'     => __('Border Radius', 'topper-pack'),
				'type'      => \Elementor\Controls_Manager::DIMENSIONS,
				'selectors' => [
					'{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap input[type*="text"]'   => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
					'{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap input[type*="email"]'  => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
					'{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap input[type*="url"]'    => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
					'{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap input[type*="number"]' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
					'{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap input[type*="tel"]'    => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
					'{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap input[type*="date"]'   => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
					'{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap .wpcf7-select'         => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
					'{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap textarea'              => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
				],
				'separator' => 'before',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'topppa_ctf7_input_box_shadow',
				'selector' => '{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap input[type*="text"], {{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap input[type*="email"], {{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap input[type*="url"], {{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap input[type*="number"], {{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap input[type*="tel"], {{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap input[type*="date"], {{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap .wpcf7-select , {{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap textarea',
			]
		);
		$this->add_responsive_control(
			'topppa_ctf7_input_padding',
			[
				'label'      => __('Padding', 'topper-pack'),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors'  => [
					'{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap input[type*="text"]'   => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap input[type*="email"]'  => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap input[type*="url"]'    => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap input[type*="number"]' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap input[type*="tel"]'    => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap input[type*="date"]'   => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap .wpcf7-select'         => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap textarea'              => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'topppa_ctf7_input_margin',
			[
				'label'      => __('Margin', 'topper-pack'),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors'  => [
					'{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap input[type*="text"]'   => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap input[type*="email"]'  => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap input[type*="url"]'    => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap input[type*="number"]' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap input[type*="tel"]'    => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap input[type*="date"]'   => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap .wpcf7-select'         => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap textarea'              => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();

		// <==========>
		// <==========> FORM LABEL STYLES <==========>

		$this->start_controls_section(
			'title_styles',
			[
				'label' => esc_html__('Form Label', 'topper-pack'),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'title_typo',
				'selector' => '{{WRAPPER}} .topppa-contact-form7 label',
			]
		);
		$this->add_responsive_control(
			'title_color',
			[
				'label'     => esc_html__('Color', 'topper-pack'),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .topppa-contact-form7 label' => 'color: {{VALUE}}',
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
					'{{WRAPPER}} .topppa-contact-form7 label' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .topppa-contact-form7 label' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'topppa_ctf7_textarea',
			[
				'label' => esc_html__('Textarea CSS', 'topper-pack'),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_responsive_control(
			'topppa_ctf7_textarea_height',
			[
				'label'     => esc_html__('Height', 'topper-pack'),
				'type'      => \Elementor\Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'max' => 500,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap textarea' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'topppa_ctf7_textarea_width',
			[
				'label'      => esc_html__('Width', 'topper-pack'),
				'type'       => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px', '%'],
				'range'      => [
					'px' => [
						'min'  => 0,
						'max'  => 800,
						'step' => 1,
					],
					'%'  => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap textarea' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'topppa_ctf7_textarea_background',
			[
				'label'     => esc_html__('Background Color', 'topper-pack'),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap textarea' => 'background-color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'topppa_ctf7_textarea_typography',
				'selector' => '{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap textarea',
			]
		);
		$this->add_responsive_control(
			'topppa_ctf7_textarea_text_color',
			[
				'label'     => esc_html__('Text Color', 'topper-pack'),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap textarea' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_responsive_control(
			'topppa_ctf7_textarea_placeholder_color',
			[
				'label'     => esc_html__('Placeholder Color', 'topper-pack'),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap textarea::-webkit-input-placeholder' => 'color: {{VALUE}};',
					'{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap textarea::-moz-placeholder'          => 'color: {{VALUE}};',
					'{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap textarea:-ms-input-placeholder'      => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name'     => 'topppa_ctf7_textarea_border',
				'label'    => esc_html__('Border', 'topper-pack'),
				'selector' => '{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap textarea',
			]
		);
		$this->add_responsive_control(
			'topppa_ctf7_textarea_border_radius',
			[
				'label'     => esc_html__('Border Radius', 'topper-pack'),
				'type'      => \Elementor\Controls_Manager::DIMENSIONS,
				'selectors' => [
					'{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap textarea' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
				],
				'separator' => 'before',
			]
		);
		$this->add_responsive_control(
			'topppa_ctf7_textarea_padding',
			[
				'label'      => esc_html__('Padding', 'topper-pack'),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors'  => [
					'{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap textarea' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator'  => 'before',
			]
		);
		$this->add_responsive_control(
			'topppa_ctf7_textarea_margin',
			[
				'label'      => esc_html__('Margin', 'topper-pack'),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors'  => [
					'{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap textarea' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator'  => 'before',
			]
		);
		$this->end_controls_section();

		// Form Button
		$this->start_controls_section(
			'topppa_ctf7_button',
			[
				'label' => __('Form Button', 'topper-pack'),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_responsive_control(
			'topppa_ctf7_button_position',
			[
				'label' => esc_html__('Position', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'options' => [
					'static' => [
						'title' => esc_html__('Static', 'topper-pack'),
						'icon' => 'eicon-editor-list-ul',
					],
					'relative' => [
						'title' => esc_html__('Relative', 'topper-pack'),
						'icon' => 'eicon-theme-builder',
					],
					'absolute' => [
						'title' => esc_html__('Absolute', 'topper-pack'),
						'icon' => 'eicon-wordart',
					],
				],
				'default' => 'absolute',
				'toggle' => true,
				'selectors_dictionary' => [
					'static'   => 'position: static;',
					'relative' => 'position: relative;',
					'absolute' => 'position: absolute;',
				],
				'selectors' => [
					'{{WRAPPER}} .topppa-contact-form7 button, {{WRAPPER}} .topppa-contact-form7 input[type=submit]' => '{{VALUE}}',
				],
				'condition' => [
					'topppa_styles' => ['style_three', 'style_four'],
				],
			]
		);

		$this->add_responsive_control(
			'btn_x_position',
			[
				'label' => esc_html__('X Position', 'topper-pack'),
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
				'selectors' => [
					'{{WRAPPER}} .topppa-contact-form7 button' => 'right: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .topppa-contact-form7 input[type=submit]' => 'right: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'topppa_styles' => ['style_three', 'style_four'],
					'topppa_ctf7_button_position!' => 'static'
				],
			]
		);
		$this->add_responsive_control(
			'btn_y_position',
			[
				'label' => esc_html__('Y Position', 'topper-pack'),
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
				'selectors' => [
					'{{WRAPPER}} .topppa-contact-form7 button' => 'top: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .topppa-contact-form7 input[type=submit]' => 'top: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'topppa_styles' => ['style_three', 'style_four'],
					'topppa_ctf7_button_position!' => 'static'
				],
			]
		);
		$this->add_responsive_control(
			'topppa_ctf7_gap',
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
					'{{WRAPPER}} .topppa-contact-form7 button, {{WRAPPER}} .topppa-contact-form7 input[type=submit]' => 'gap: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'topppa_ctf7_button_align',
			[
				'label' => esc_html__('Alignment', 'topper-pack'),
				'type'  => \Elementor\Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => esc_html__('Left', 'topper-pack'),
						'icon'  => 'eicon-text-align-left',
					],
					'center' => [
						'title' => esc_html__('Center', 'topper-pack'),
						'icon'  => 'eicon-text-align-center',
					],
					'right' => [
						'title' => esc_html__('Right', 'topper-pack'),
						'icon'  => 'eicon-text-align-right',
					],
				],
				'default' => 'center',
				'toggle'  => true,
				'selectors' => [
					'{{WRAPPER}} .topppa-contact-form7 button' => 'text-align: {{VALUE}} !important;',
					'{{WRAPPER}} .topppa-contact-form7 input[type=submit]' => 'text-align: {{VALUE}} !important;',
				],
			]
		);

		$this->add_responsive_control(
			'topppa_ctf7_btn_height',
			[
				'label'     => __('Height', 'topper-pack'),
				'type'      => \Elementor\Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'max' => 170,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .topppa-contact-form7 button' => 'height: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .topppa-contact-form7 input[type=submit]' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'topppa_ctf7_btn_width',
			[
				'label'      => __('Width', 'topper-pack'),
				'type'       => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px', '%'],
				'range'      => [
					'px' => [
						'min'  => 0,
						'max'  => 100,
						'step' => 1,
					],
					'%'  => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .topppa-contact-form7 button' => 'width: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .topppa-contact-form7 input[type=submit]' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'button_center_using_margin',
			[
				'label' => esc_html__('Button Align', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'unset',
				'options' => [
					'' => esc_html__('Unset', 'topper-pack'),
					'auto' => esc_html__('Center', 'topper-pack'),
				],
				'description' => esc_html__('Use this option to center the button when a custom width is applied.', 'topper-pack'),
				'selectors' => [
					'{{WRAPPER}} .topppa-contact-form7 button' => 'margin: {{VALUE}};',
					'{{WRAPPER}} .topppa-contact-form7 input[type=submit]' => 'margin: {{VALUE}};',
				],
			]
		);
		$this->start_controls_tabs('topppa_ctf7_btn_tabs');
		$this->start_controls_tab(
			'topppa_ctf7_btn_normal_tab',
			[
				'label' => __('Normal', 'topper-pack'),
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'topppa_ctf7_btn_typography',
				'selector' => '{{WRAPPER}} .topppa-contact-form7 button, {{WRAPPER}} .topppa-contact-form7 input[type=submit]',
			]
		);
		$this->add_responsive_control(
			'topppa_ctf7_btn_text_color',
			[
				'label'     => __('Color', 'topper-pack'),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .topppa-contact-form7 button' => 'color: {{VALUE}};',
					'{{WRAPPER}} .topppa-contact-form7 input[type=submit]' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'topppa_ctf7_btn_bg_color',
				'types' => ['classic', 'gradient', 'video'],
				'selector' => '{{WRAPPER}} .topppa-contact-form7 button, {{WRAPPER}} .topppa-contact-form7 input[type=submit]',
			]
		);
		$this->add_responsive_control(
			'topppa_ctf7_btn_padding',
			[
				'label'      => __('Padding', 'topper-pack'),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors'  => [
					'{{WRAPPER}} .topppa-contact-form7 button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .topppa-contact-form7 input[type=submit]' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'topppa_ctf7_btn_margin',
			[
				'label'      => __('Margin', 'topper-pack'),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors'  => [
					'{{WRAPPER}} .topppa-contact-form7 button' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .topppa-contact-form7 input[type=submit]' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name'     => 'topppa_ctf7_btn_border',
				'label'    => __('Border', 'topper-pack'),
				'selector' => '{{WRAPPER}} .topppa-contact-form7 button, .topppa-contact-form7 input[type=submit]',
			]
		);
		$this->add_responsive_control(
			'topppa_ctf7_btn_border_radius',
			[
				'label'     => __('Border Radius', 'topper-pack'),
				'type'      => \Elementor\Controls_Manager::DIMENSIONS,
				'selectors' => [
					'{{WRAPPER}} .topppa-contact-form7 button' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
					'{{WRAPPER}} .topppa-contact-form7 input[type=submit]' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
				],
				'separator' => 'before',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'topppa_ctf7_btn_box_shadow',
				'label'    => __('Box Shadow', 'topper-pack'),
				'selector' => '{{WRAPPER}} .topppa-contact-form7 button, {{WRAPPER}} .topppa-contact-form7 input[type=submit]',
			]
		);
		$this->end_controls_tab();

		$this->start_controls_tab(
			'topppa_ctf7_btn_hover_tab',
			[
				'label' => __('Hover', 'topper-pack'),
			]
		);
		$this->add_responsive_control(
			'topppa_ctf7_btnhover_text_color',
			[
				'label'     => __('Color', 'topper-pack'),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .topppa-contact-form7 button:hover' => 'color: {{VALUE}};',
					'{{WRAPPER}} .topppa-contact-form7 input[type=submit]:hover' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'header_btn_hbg',
				'types' => ['classic', 'gradient', 'video'],
				'selector' => '{{WRAPPER}} .topppa-contact-form7 button:hover, {{WRAPPER}} .topppa-contact-form7 input[type=submit]:hover',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name'     => 'topppa_ctf7_btnhover_border',
				'label'    => __('Border', 'topper-pack'),
				'selector' => '{{WRAPPER}} .topppa-contact-form7 button:hover, {{WRAPPER}} .topppa-contact-form7 input[type=submit]:hover',
			]
		);
		$this->add_responsive_control(
			'topppa_ctf7_btn_border_hradius',
			[
				'label'     => __('Border Radius', 'topper-pack'),
				'type'      => \Elementor\Controls_Manager::DIMENSIONS,
				'selectors' => [
					'{{WRAPPER}} .topppa-contact-form7 button:hover' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
					'{{WRAPPER}} .topppa-contact-form7 input[type=submit]:hover' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
				],
				'separator' => 'before',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'topppa_ctf7_btn_box_hshadow',
				'label'    => __('Box Shadow', 'topper-pack'),
				'selector' => '{{WRAPPER}} .topppa-contact-form7 button:hover, {{WRAPPER}} .topppa-contact-form7 input[type=submit]:hover',
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
		$id = $this->get_id();
		$this->add_render_attribute('shortcode', 'id', $settings['topppa_ctf7_id']);
		// translators: %s is the contact form ID
		$shortcode = sprintf('[contact-form-7 %s]', $this->get_render_attribute_string('shortcode'));

		$style_classes = [
			'style_one' => 'style-one',
			'style_two' => 'style-two',
			'style_three' => 'style-three',
			'style_four' => 'style-four',
		];
		// Get the class name based on the selected style or fallback to an empty string.
		$class = isset($style_classes[$settings['topppa_styles']]) ? $style_classes[$settings['topppa_styles']] : '';
		// HTML Tag
		$html_tag = isset($settings['html_tag']) ? $settings['html_tag'] : 'h3';
?>
		<div class="topppa-contact-form7 <?php echo esc_attr($class); ?>" style="box-shadow: <?php echo esc_attr($box_shadow); ?>;">

			<?php if ('yes' === $settings['enable_title_box']) : ?>
				<div class="topppa-cf-section-title-wrapper">

					<?php if ($settings['enable_sub_title'] === 'yes'): ?>
						<div class="section-sub-title">
							<?php echo wp_kses_post($settings['form_sub_title']); ?>
						</div>
					<?php endif; ?>

					<?php if ($settings['enable_title'] === 'yes'): ?>
						<<?php echo esc_html($html_tag); ?> class="section-title">
							<?php echo wp_kses($settings['form_title'], $allowed_html); ?>
						</<?php echo esc_html($html_tag); ?>>
					<?php endif; ?>

					<?php if ($settings['enable_form_description'] === 'yes'): ?>
						<div class="section-desc">
							<?php echo wp_kses_post($settings['form_description']); ?>
						</div>
					<?php endif; ?>
				</div>
			<?php endif; ?>
			<?php
			if (!empty($settings['topppa_ctf7_id'])) {
				$form_html = do_shortcode('[contact-form-7 id="' . esc_attr($settings['topppa_ctf7_id']) . '"]');
				$form_html = preg_replace('#<p>\s*</p>#', '', $form_html);
				echo $form_html; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			} else {
				echo '<div class="form_no_select">' . esc_html__('Please Select contact form.', 'topper-pack') . '</div>';
			}
			?>

		</div>
<?php
	}
}
