<?php

use \TopperPack\Includes\Controls\Controls_Manager as TopperPack_Controls_Manager;

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}

/**
 * Elementor topppa Service Info Widget.
 *
 * Elementor widget that inserts an embbedable content into the page, from any given URL.
 *
 * @since 1.0.0
 */
class TOPPPA_Service_Widget extends \Elementor\Widget_Base {

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
		return 'topppa_service';
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
		return TOPPPA_EPWB . esc_html__('Service', 'topper-pack');
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
		return 'eicon-info-box';
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
		return ['topppa', 'widget', 'service', 'topperpack'];
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
		return 'https://doc.topperpack.com/docs/service-widgets/service/';
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
		return 'https://topperpack.com/assets/widgets/service-widget/';
	}

	/**
	 * Register Service widget controls.
	 *
	 * Add input fields to allow the user to customize the widget settings.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function register_controls() {
		$base_url = $this->get_custom_image_url();

		$this->start_controls_section(
			'topppa_service_style',
			[
				'label' => esc_html__('Styles', 'topper-pack'),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'topppa_service_styles',
			[
				'label' => esc_html__('Choose Style', 'topper-pack'),
				'type' => TopperPack_Controls_Manager::IMAGECHOOSE,
				'default' => 'style_one',
				'options' => [
					'style_one' => [
						'title' => esc_html__('Style 1', 'topper-pack'),
						'imagelarge' => $base_url . 'topppa-service-1.jpg',
						'imagesmall' => $base_url . 'topppa-service-1.jpg',
						'width' => '100%',
					],
					'style_two' => [
						'title' => esc_html__('style 2', 'topper-pack'),
						'imagelarge' => $base_url . 'topppa-service-2.jpg',
						'imagesmall' => $base_url . 'topppa-service-2.jpg',
						'width' => '100%',
					],
					'style_three' => [
						'title' => esc_html__('Style 3', 'topper-pack'),
						'imagelarge' => $base_url . 'topppa-service-3.jpg',
						'imagesmall' => $base_url . 'topppa-service-3.jpg',
						'width' => '100%',
					],
					'style_four' => [
						'title' => esc_html__('Style 4', 'topper-pack'),
						'imagelarge' => $base_url . 'topppa-service-4.jpg',
						'imagesmall' => $base_url . 'topppa-service-4.jpg',
						'width' => '100%',
					],
					'style_five' => [
						'title' => esc_html__('Style 5', 'topper-pack'),
						'imagelarge' => $base_url . 'topppa-service-5.jpg',
						'imagesmall' => $base_url . 'topppa-service-5.jpg',
						'width' => '100%',
					],
					'style_six' => [
						'title' => esc_html__('Style 6', 'topper-pack'),
						'imagelarge' => $base_url . 'topppa-service-6.jpg',
						'imagesmall' => $base_url . 'topppa-service-6.jpg',
						'width' => '100%',
					],
					'style_seven' => [
						'title' => esc_html__('Style 7', 'topper-pack'),
						'imagelarge' => $base_url . 'topppa-service-7.jpg',
						'imagesmall' => $base_url . 'topppa-service-7.jpg',
						'width' => '100%',
					],
					'style_eight' => [
						'title' => esc_html__('Style 8', 'topper-pack'),
						'imagelarge' => $base_url . 'topppa-service-8.jpg',
						'imagesmall' => $base_url . 'topppa-service-8.jpg',
						'width' => '100%',
					],
					'style_nine' => [
						'title' => esc_html__('Style 9', 'topper-pack'),
						'imagelarge' => $base_url . 'topppa-service-9.jpg',
						'imagesmall' => $base_url . 'topppa-service-9.jpg',
						'width' => '100%',
					],
					'style_ten' => [
						'title' => esc_html__('Style 10', 'topper-pack'),
						'imagelarge' => $base_url . 'topppa-service-10.jpg',
						'imagesmall' => $base_url . 'topppa-service-10.jpg',
						'width' => '100%',
					],
					'style_eleven' => [
						'title' => esc_html__('Style 11', 'topper-pack'),
						'imagelarge' => $base_url . 'topppa-service-11.jpg',
						'imagesmall' => $base_url . 'topppa-service-11.jpg',
						'width' => '100%',
					],
				],
			]
		);
		$this->end_controls_section();

		// <========================> topppa SERVICE STYLES <========================>
		$this->start_controls_section(
			'topppa_service_content',
			[
				'label' => esc_html__('Service Content', 'topper-pack'),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'topppa_service_icon_anim',
			[
				'label' => esc_html__('Icon anim', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'anim_one',
				'options' => [
					'anim_one' => esc_html__('Bounce', 'topper-pack'),
					'anim_two' => esc_html__('Flip', 'topper-pack'),
				],
			]
		);

		$this->add_control(
			'show_topppa_service_color_shape',
			[
				'label' => esc_html__('Color Shape', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'absolute',
				'options' => [
					'absolute' => esc_html__('Color', 'topper-pack'),
					'unset' => esc_html__('None', 'topper-pack'),
				],
				'selectors' => [
					'{{WRAPPER}} .topppa-service-box::before' => 'position: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'topppa_service_color_shape',
			[
				'label' => esc_html__('Color', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .topppa-service-box::before' => 'background: {{VALUE}}',
				],
				'condition' => [
					'show_topppa_service_color_shape' => 'absolute',
				],
			]
		);
		$this->add_control(
			'topppa_service_color_shape2',
			[
				'label' => esc_html__('Color 2', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .topppa-service-box::after' => 'background: {{VALUE}}',
				],
				'condition' => [
					'show_topppa_service_color_shape' => 'absolute',
					'topppa_service_styles' => 'style_eleven'
				],
			]
		);

		$this->add_control(
			'show_topppa_service_shape',
			[
				'label' => esc_html__('Image Shape', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Show', 'topper-pack'),
				'label_off' => esc_html__('Hide', 'topper-pack'),
				'return_value' => 'yes',
				'default' => 'no',
			]
		);

		$this->add_control(
			'enable_spin',
			[
				'label' => esc_html__('Enable Spin?', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Yes', 'topper-pack'),
				'label_off' => esc_html__('No', 'topper-pack'),
				'return_value' => 'yes',
				'default' => 'no',
				'condition' => [
					'show_topppa_service_shape' => 'yes',
				],
			]
		);

		$this->add_control(
			'topppa_service_shape_image',
			[
				'label' => esc_html__('Image Shape', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'condition' => [
					'show_topppa_service_shape' => 'yes',
				],
			]
		);

		$repeater = new \Elementor\Repeater();
		$repeater->add_control(
			'show_count',
			[
				'label' => esc_html__('Show Count', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Show', 'topper-pack'),
				'label_off' => esc_html__('Hide', 'topper-pack'),
				'return_value' => 'yes',
				'default' => 'no',
			]
		);
		$repeater->add_control(
			'topppa_service_count',
			[
				'label' => esc_html__('Count', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__('01', 'topper-pack'),
				'condition' => [
					'show_count' => 'yes',
				],
			]
		);
		$repeater->add_control(
			'divider',
			[
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'after',
			]
		);
		$repeater->add_control(
			'topppa_service_icon',
			[
				'label' => esc_html__('Icon', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::ICONS,
				'default' => [
					'value' => 'fas fa-university',
					'library' => 'fa-solid',
				],
			]
		);
		$repeater->add_control(
			'divider2',
			[
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'after',
			]
		);
		$repeater->add_control(
			'show_subtitle',
			[
				'label' => esc_html__('Show Sub Title', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Show', 'topper-pack'),
				'label_off' => esc_html__('Hide', 'topper-pack'),
				'return_value' => 'yes',
				'default' => 'no',
			]
		);
		$repeater->add_control(
			'topppa_service_subtitle',
			[
				'label' => esc_html__('Healthier Life', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__('IT Management Service', 'topper-pack'),
				'label_block' => true,
				'condition' => [
					'show_subtitle' => 'yes',
				],
			]
		);
		$repeater->add_control(
			'divider3',
			[
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'after',
			]
		);
		$repeater->add_control(
			'topppa_service_title',
			[
				'label' => esc_html__('Title', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__('IT Management Service', 'topper-pack'),
				'label_block' => true,
			]
		);
		$repeater->add_control(
			'enable_service_title_link',
			[
				'label' => esc_html__('Enable Title Link', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Show', 'topper-pack'),
				'label_off' => esc_html__('Hide', 'topper-pack'),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);
		$repeater->add_control(
			'service_title_link',
			[
				'label' => esc_html__('Title Link', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::URL,
				'options' => ['url', 'is_external', 'nofollow'],
				'label_block' => true,
				'condition' => [
					'enable_service_title_link' => 'yes',
				],
				'default' => [
					'url' => '',
					'is_external' => true,
					'nofollow' => true,
				],
			]
		);
		$repeater->add_control(
			'divider4',
			[
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'after',
			]
		);
		$repeater->add_control(
			'show_description',
			[
				'label' => esc_html__('Show Description', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Show', 'topper-pack'),
				'label_off' => esc_html__('Hide', 'topper-pack'),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);
		$repeater->add_control(
			'topppa_service_description',
			[
				'label' => esc_html__('Description', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::WYSIWYG,
				'default' => esc_html__('Completely implement highly efficient process improvements. engage highly value before progressive data.', 'topper-pack'),
				'condition' => [
					'show_description' => 'yes',
				]
			]
		);
		$repeater->add_control(
			'divider6',
			[
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'after',
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
				'default' => 'yes',
			]
		);

		$repeater->add_control(
			'topppa_enable_services_btn_icon',
			[
				'label' => esc_html__('Show Icon', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Show', 'topper-pack'),
				'label_off' => esc_html__('Hide', 'topper-pack'),
				'return_value' => 'yes',
				'default' => 'no',
				'condition' => [
					'enable_button' => 'yes',
				]
			]
		);
		$repeater->add_control(
			'topppa_service_btn_icon',
			[
				'label' => esc_html__('Botton Icon', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::ICONS,
				'default' => [
					'value' => 'fas fa-arrow-right',
					'library' => 'fa-solid',
				],
				'condition' => [
					'enable_button' => 'yes',
					'topppa_enable_services_btn_icon' => 'yes'
				]
			]
		);
		$repeater->add_control(
			'btn_text',
			[
				'label' => esc_html__('Button Text', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__('Read More', 'topper-pack'),
				'label_block' => true,
				'condition' => [
					'enable_button' => 'yes',
				]
			]
		);
		$repeater->add_control(
			'link',
			[
				'label' => __('Link', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::URL,
				'placeholder' => __('https://your-link.com', 'topper-pack'),
				'show_external' => true,
				'default' => [
					'url' => '',
					'is_external' => true,
					'nofollow' => true,
				],
				'dynamic' => [
					'active' => true,
				],
				'condition' => [
					'enable_button' => 'yes',
				],
			]
		);
		$this->add_control(
			'topppa_service_items',
			[
				'label' => esc_html__('Repeater List', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'topppa_service_title' => esc_html__('Development Services', 'topper-pack'),
						'topppa_service_description' => esc_html__('Completely implement highly efficient process improvements. engage highly value before progressive data.', 'topper-pack'),
					],
				],
				'title_field' => '{{{ topppa_service_title }}}',
			]
		);
		$this->add_control(
			'service_more_options',
			[
				'label' => esc_html__('Necessary Options', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_control(
			'desktop_col',
			[
				'label' => esc_html__('Columns On Desktop', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'col-xl-12',
				'options' => [
					'col-xl-12' => esc_html__('1 Column', 'topper-pack'),
					'col-xl-6' => esc_html__('2 Column', 'topper-pack'),
					'col-xl-4' => esc_html__('3 Column', 'topper-pack'),
					'col-xl-3' => esc_html__('4 Column', 'topper-pack'),
				],
			]
		);
		$this->add_control(
			'ipadpro_col',
			[
				'label' => esc_html__('Columns On Ipad Pro', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'col-lg-12',
				'options' => [
					'col-lg-12' => esc_html__('1 Column', 'topper-pack'),
					'col-lg-6' => esc_html__('2 Column', 'topper-pack'),
					'col-lg-4' => esc_html__('3 Column', 'topper-pack'),
					'col-lg-3' => esc_html__('4 Column', 'topper-pack'),
				],
			]
		);
		$this->add_control(
			'tab_col',
			[
				'label' => esc_html__('Columns On Tablet', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'col-md-12',
				'options' => [
					'col-md-12' => esc_html__('1 Column', 'topper-pack'),
					'col-md-6' => esc_html__('2 Column', 'topper-pack'),
					'col-md-4' => esc_html__('3 Column', 'topper-pack'),
					'col-md-3' => esc_html__('4 Column', 'topper-pack'),
				],
			]
		);
		$this->end_controls_section();

		// <==========>
		// <==========> BOX STYLES <==========>

		$this->start_controls_section(
			'service_box_styles',
			[
				'label' => esc_html__('Box', 'topper-pack'),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_responsive_control(
			'box_overflow',
			[
				'label' => esc_html__('Overflow', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'visible',
				'options' => [
					'visible' => esc_html__('Default', 'topper-pack'),
					'hidden' => esc_html__('Hidden', 'topper-pack'),
				],
				'selectors' => [
					'{{WRAPPER}} .topppa-service-box' => 'overflow: {{VALUE}};',
				],
			]
		);
		$this->add_responsive_control(
			'service_box_align',
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
					'{{WRAPPER}} .topppa-service-box' => 'text-align: {{VALUE}};',
				],
			]
		);

		// multiple shadow
		$this->add_control(
			'enable_double_shadow',
			[
				'label' => esc_html__('Enable Double Shadow', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Yes', 'topper-pack'),
				'label_off' => esc_html__('No', 'topper-pack'),
				'return_value' => 'yes',
				'default' => 'no',
			]
		);

		// Shadow #1
		$this->add_control(
			'shadow1',
			[
				'label' => esc_html__('Shadow 1', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::BOX_SHADOW,
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
				'label' => esc_html__('Shadow 2', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::BOX_SHADOW,
				'condition' => [
					'enable_double_shadow' => 'yes',
				],
				'selectors' => [],
			]
		);

		$this->start_controls_tabs(
			'service_box_style_tabs'
		);

		$this->start_controls_tab(
			'style_normal_tab',
			[
				'label' => esc_html__('Normal', 'topper-pack'),
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'service_box_bg',
				'label' => esc_html__('Background', 'topper-pack'),
				'types' => ['classic', 'gradient'],
				'selector' => '{{WRAPPER}} .topppa-service-box',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'service_box_border',
				'label' => esc_html__('Border', 'topper-pack'),
				'selector' => '{{WRAPPER}} .topppa-service-box',
			]
		);
		$this->add_responsive_control(
			'service_box_radius',
			[
				'label' => esc_html__('Border Radius', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .topppa-service-box' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'service_box_shadow',
				'label' => esc_html__('Box Shadow', 'topper-pack'),
				'selector' => '{{WRAPPER}} .topppa-service-box',
			]
		);
		$this->add_responsive_control(
			'service_box_margin',
			[
				'label' => esc_html__('Margin', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .topppa-service-box' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'service_box_padding',
			[
				'label' => esc_html__('Padding', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .topppa-service-box' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_tab();

		$this->start_controls_tab(
			'service_box_style_hover_tab',
			[
				'label' => esc_html__('Hover', 'topper-pack'),
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'service_box_hbg',
				'label' => esc_html__('Background', 'topper-pack'),
				'types' => ['classic', 'gradient'],
				'selector' => '{{WRAPPER}} .topppa-service-box:hover',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'service_box_hborder',
				'label' => esc_html__('Border', 'topper-pack'),
				'selector' => '{{WRAPPER}} .topppa-service-box:hover',
			]
		);
		$this->add_responsive_control(
			'service_box_hradius',
			[
				'label' => esc_html__('Border Radius', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .topppa-service-box:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'service_box_hshadow',
				'label' => esc_html__('Box Shadow', 'topper-pack'),
				'selector' => '{{WRAPPER}} .topppa-service-box:hover',
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();

		// <=================> ICON STYLES <=================>
		$this->start_controls_section(
			'service_social_icon_style',
			[
				'label' => esc_html__('Icon', 'topper-pack'),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->start_controls_tabs(
			'service_icon_tabs'
		);
		$this->start_controls_tab(
			'service_icon_tab',
			[
				'label' => esc_html__('Normal', 'topper-pack'),
			]
		);
		$this->add_responsive_control(
			'service_icon_height',
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
					'{{WRAPPER}} .topppa-service-box .topppa-service-icon' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'service_icon_width',
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
					'{{WRAPPER}} .topppa-service-box .topppa-service-icon' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'service_icon_typo',
				'selector' => '{{WRAPPER}} .topppa-service-box .topppa-service-icon',
			]
		);
		$this->add_responsive_control(
			'service_icon_color',
			[
				'label' => esc_html__('Icon Color', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .topppa-service-box .topppa-service-icon' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'service_icon_bg',
				'types' => ['classic', 'gradient', 'video'],
				'selector' => '{{WRAPPER}} .topppa-service-box .topppa-service-icon',
			]
		);
		// multiple shadow
		$this->add_control(
			'enable_icon_double_shadow',
			[
				'label' => esc_html__('Enable Double Shadow', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Yes', 'topper-pack'),
				'label_off' => esc_html__('No', 'topper-pack'),
				'return_value' => 'yes',
				'default' => 'no',
			]
		);

		// Shadow #1
		$this->add_control(
			'icon_shadow1',
			[
				'label' => esc_html__('Shadow 1', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::BOX_SHADOW,
				'condition' => [
					'enable_icon_double_shadow' => 'yes',
				],
				'selectors' => [],
			]
		);

		// Shadow #2
		$this->add_control(
			'icon_shadow2',
			[
				'label' => esc_html__('Shadow 2', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::BOX_SHADOW,
				'condition' => [
					'enable_icon_double_shadow' => 'yes',
				],
				'selectors' => [],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'service_icon_border',
				'label' => esc_html__('Border', 'topper-pack'),
				'selector' => '{{WRAPPER}} .topppa-service-box .topppa-service-icon',
			]
		);
		$this->add_responsive_control(
			'service_icon_border_radius',
			[
				'label' => esc_html__('Border Radius', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .topppa-service-box .topppa-service-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'service_icon_shadow',
				'selector' => '{{WRAPPER}} .topppa-service-box .topppa-service-icon',
			]
		);

		$this->add_control(
			'svg_styles',
			[
				'label' => esc_html__('SVG Styles', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_responsive_control(
			'service_svg_color',
			[
				'label' => esc_html__('Color', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .topppa-service-box .topppa-service-icon svg path' => 'fill: {{VALUE}}',
				],
			]
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
					'{{WRAPPER}} .topppa-service-box .topppa-service-icon svg' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
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
					'{{WRAPPER}} .topppa-service-box .topppa-service-icon svg' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_tab();

		$this->start_controls_tab(
			'service_icon_hover_tab',
			[
				'label' => esc_html__('Hover', 'topper-pack'),
			]
		);
		$this->add_responsive_control(
			'service_icon_color_hover',
			[
				'label' => esc_html__('Color', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .topppa-service-box:hover .topppa-service-icon' => 'color: {{VALUE}}',

				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'service_icon_hover_bg',
				'types' => ['classic', 'gradient', 'video'],
				'selector' => '{{WRAPPER}} .topppa-service-box:hover .topppa-service-icon',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'service_icon_hover_border',
				'label' => esc_html__('Border', 'topper-pack'),
				'selector' => '{{WRAPPER}} .topppa-service-box:hover .topppa-service-icon',
			]
		);
		$this->add_responsive_control(
			'service_icon_border_hover_radius',
			[
				'label' => esc_html__('Border Radius', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .topppa-service-box:hover .topppa-service-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'service_icon_shadow_hover',
				'selector' => '{{WRAPPER}} .topppa-service-box:hover .topppa-service-icon',
			]
		);

		$this->add_control(
			'hsvg_styles',
			[
				'label' => esc_html__('SVG Styles', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_responsive_control(
			'service_hsvg_color',
			[
				'label' => esc_html__('Color', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .topppa-service-box:hover .topppa-service-icon svg path' => 'fill: {{VALUE}}',
				],
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->add_responsive_control(
			'service_icon_margin',
			[
				'label' => esc_html__('Margin', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em', 'rem', 'custom'],
				'selectors' => [
					'{{WRAPPER}} .topppa-service-icon' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'service_icon_padding',
			[
				'label' => esc_html__('Padding', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em', 'rem', 'custom'],
				'selectors' => [
					'{{WRAPPER}} .topppa-service-icon' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();

		// <=================> SERVICE CONTENT STYLES <=================>
		$this->start_controls_section(
			'service_content',
			[
				'label' => esc_html__('Card Content', 'topper-pack'),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->start_controls_tabs(
			'service_content_style_tabs'
		);
		$this->start_controls_tab(
			'service_title_style_tab',
			[
				'label' => esc_html__('Title', 'topper-pack'),
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'service_title_typo',
				'selector' => '{{WRAPPER}} .topppa-service-box .topppa-service-title',
			]
		);
		$this->add_responsive_control(
			'service_title_color',
			[
				'label' => esc_html__('Color', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .topppa-service-box .topppa-service-title' => 'color: {{VALUE}}',
					'{{WRAPPER}} .topppa-service-box .topppa-service-title a' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_responsive_control(
			'service_title_hcolor',
			[
				'label' => esc_html__('Hover Color', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .topppa-service-box:hover .topppa-service-title a, {{WRAPPER}} .topppa-service-box:hover .topppa-service-title' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_responsive_control(
			'service_title_margin',
			[
				'label' => esc_html__('Margin', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .topppa-service-box .topppa-service-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'service_title_padding',
			[
				'label' => esc_html__('Padding', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .topppa-service-box .topppa-service-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_tab();

		$this->start_controls_tab(
			'service_subtitle_style_tab',
			[
				'label' => esc_html__('Sub Title', 'topper-pack'),
			]
		);
		$this->add_responsive_control(
			'show_dot',
			[
				'label' => esc_html__('Display Dot', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'block',
				'options' => [
					'none' => esc_html__('Hide', 'topper-pack'),
					'block' => esc_html__('Show', 'topper-pack'),
				],
				'selectors' => [
					'{{WRAPPER}} .topppa-service-box .topppa-service-subtitle::before' => 'display: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'sub_title_dot_bg',
				'types' => ['classic', 'gradient', 'video'],
				'selector' => '{{WRAPPER}} .topppa-service-box .topppa-service-subtitle::before',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'service_subtitle_typo',
				'selector' => '{{WRAPPER}} .topppa-service-box .topppa-service-subtitle',
			]
		);
		$this->add_responsive_control(
			'service_subtitle_color',
			[
				'label' => esc_html__('Color', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .topppa-service-box .topppa-service-subtitle' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_responsive_control(
			'service_subtitle_hcolor',
			[
				'label' => esc_html__('Hover Color', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .topppa-service-box:hover .topppa-service-subtitle' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_responsive_control(
			'service_subtitle_margin',
			[
				'label' => esc_html__('Margin', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .topppa-service-box .topppa-service-subtitle' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'service_subtitle_padding',
			[
				'label' => esc_html__('Padding', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .topppa-service-box .topppa-service-subtitle' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_tab();

		$this->start_controls_tab(
			'service_desc_style_tab',
			[
				'label' => esc_html__('Description', 'topper-pack'),
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'service_desc_typo',
				'selector' => '{{WRAPPER}} .topppa-service-box .topppa-service-desc',
			]
		);
		$this->add_responsive_control(
			'service_desc_color',
			[
				'label' => esc_html__('Color', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .topppa-service-box .topppa-service-desc' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_responsive_control(
			'service_desc_hcolor',
			[
				'label' => esc_html__('Hover Color', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .topppa-service-box:hover .topppa-service-desc' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_responsive_control(
			'service_desc_margin',
			[
				'label' => esc_html__('Margin', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .topppa-service-box .topppa-service-desc' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'service_desc_padding',
			[
				'label' => esc_html__('Padding', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .topppa-service-box .topppa-service-desc' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();

		// <==========>
		// <==========> SERVICE COUNT STYLES <==========>

		$this->start_controls_section(
			'service_count_styles',
			[
				'label' => esc_html__('Count', 'topper-pack'),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_responsive_control(
			'service_count_display',
			[
				'label' => esc_html__('Display', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'block',
				'options' => [
					'block' => esc_html__('Default', 'topper-pack'),
					'inline-flex' => esc_html__('Inline Flex', 'topper-pack'),
				],
				'selectors' => [
					'{{WRAPPER}} .topppa-service-box .topppa-service-count' => 'display: {{VALUE}};',
				],
			]
		);
		$this->add_responsive_control(
			'service_count_height',
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
					'{{WRAPPER}} .topppa-service-box .topppa-service-count' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'service_count_width',
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
					'{{WRAPPER}} .topppa-service-box .topppa-service-count' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'service_count_typo',
				'selector' => '{{WRAPPER}} .topppa-service-box .topppa-service-count',
			]
		);
		$this->add_responsive_control(
			'service_count_color',
			[
				'label' => esc_html__('Color', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .topppa-service-box .topppa-service-count' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_responsive_control(
			'service_count_hcolor',
			[
				'label' => esc_html__('Hover Color', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .topppa-service-box:hover .topppa-service-count' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'service_count_background',
				'types' => ['classic', 'gradient', 'video'],
				'selector' => '{{WRAPPER}} .topppa-service-box .topppa-service-count',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'service_count_hbackground',
				'label' => esc_html__('Hover Background', 'topper-pack'),
				'types' => ['classic'],
				'selector' => '{{WRAPPER}} .topppa-service-box:hover .topppa-service-count',
				'fields_options' => [
					'background' => [
						'label' => esc_html__('Hover Background', 'topper-pack'),
					],
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'service_count_border',
				'selector' => '{{WRAPPER}} .topppa-service-box .topppa-service-count',
			]
		);
		$this->add_responsive_control(
			'service_count_border_radius',
			[
				'label' => esc_html__('Border Radius', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .topppa-service-box .topppa-service-count' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'service_count_margin',
			[
				'label' => esc_html__('Margin', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .topppa-service-box .topppa-service-count' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'service_count_padding',
			[
				'label' => esc_html__('Padding', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .topppa-service-box .topppa-service-count' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();

		// <=================> SERVICE BUTTON STYLES <=================>
		$this->start_controls_section(
			'service_btn_styles',
			[
				'label' => esc_html__('Button', 'topper-pack'),
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
					'{{WRAPPER}} .topppa-service-box .topppa-service-btn' => 'flex-direction: {{VALUE}};',
				],
			]
		);
		$this->add_responsive_control(
			'service_btn_icon_gap',
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
					'{{WRAPPER}} .topppa-service-box .topppa-service-btn' => 'gap: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'topppa_enable_services_btn_icon' => 'yes'
				]
			]
		);

		$this->start_controls_tabs(
			'service_btn_tabs'
		);
		$this->start_controls_tab(
			'service_btn_normal',
			[
				'label' => __('Normal', 'topper-pack'),
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'service_btn_typo',
				'label' => esc_html__('Typography', 'topper-pack'),
				'selector' => '{{WRAPPER}} .topppa-service-box .topppa-service-btn',
			]
		);
		$this->add_responsive_control(
			'service_btn_ncolor',
			[
				'label' => esc_html__('Color', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .topppa-service-box .topppa-service-btn' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'service_btn_nbg',
				'types' => ['classic', 'gradient', 'video'],
				'selector' => '{{WRAPPER}} .topppa-service-box .topppa-service-btn',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'service_btn_nborder',
				'label' => esc_html__('Border', 'topper-pack'),
				'selector' => '{{WRAPPER}} .topppa-service-box .topppa-service-btn',
			]
		);
		$this->add_responsive_control(
			'service_btn_nradius',
			[
				'label' => esc_html__('Border Radius', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .topppa-service-box .topppa-service-btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'service_btn_nshadow',
				'label' => esc_html__('Shadow', 'topper-pack'),
				'selector' => '{{WRAPPER}} .topppa-service-box .topppa-service-btn',
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
			'topppa_btn_icon_color',
			[
				'label' => esc_html__('Icon Color', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .topppa-service-box .topppa-service-btn span' => 'color: {{VALUE}}',
				],
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
						'max' => 300,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .topppa-service-box .topppa-service-btn span' => 'width: {{SIZE}}{{UNIT}};',
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
						'max' => 300,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .topppa-service-box .topppa-service-btn span' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'topppa_btn_icon_size',
			[
				'label' => esc_html__('Size', 'topper-pack'),
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
					'{{WRAPPER}} .topppa-service-box .topppa-service-btn span' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'topppa_btn_icon_bg',
				'types' => ['classic', 'gradient', 'video'],
				'exclude' => ['video', 'image'],
				'selector' => '{{WRAPPER}} .topppa-service-box .topppa-service-btn span',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'topppa_btn_icon_border',
				'selector' => '{{WRAPPER}} .topppa-service-box .topppa-service-btn span',
			]
		);
		$this->add_responsive_control(
			'topppa_btn_icon_border_radius',
			[
				'label' => esc_html__('Border Radius', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .topppa-service-box .topppa-service-btn span' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_tab();

		$this->start_controls_tab(
			'buttons_tabs_hover',
			[
				'label' => __('Hover', 'topper-pack'),
			]
		);
		$this->add_responsive_control(
			'service_btn_hcolor',
			[
				'label' => esc_html__('Color', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .topppa-service-box:hover .topppa-service-btn' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'service_btn_hbg',
				'types' => ['classic', 'gradient', 'video'],
				'selector' => '{{WRAPPER}} .topppa-service-box:hover .topppa-service-btn',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'service_btn_hborder',
				'label' => esc_html__('Border', 'topper-pack'),
				'selector' => '{{WRAPPER}} .topppa-service-box:hover .topppa-service-btn',
			]
		);
		$this->add_responsive_control(
			'service_btn_hradius',
			[
				'label' => esc_html__('Border Radius', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .topppa-service-box:hover .topppa-service-btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'service_btn_hshadow',
				'label' => esc_html__('Shadow', 'topper-pack'),
				'selector' => '{{WRAPPER}} .topppa-service-box:hover .topppa-service-btn',
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
			'topppa_btn_icon_hcolor',
			[
				'label' => esc_html__('Icon Color', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .topppa-service-box:hover .topppa-service-btn span ' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'topppa_btn_icon_hbgcolor',
				'types' => ['classic', 'gradient', 'video'],
				'selector' => '{{WRAPPER}} .topppa-service-box:hover .topppa-service-btn span',
			]
		);

		$this->add_responsive_control(
			'topppa_btn_icon_hborder_radius',
			[
				'label' => esc_html__('Border Radius', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .topppa-service-box:hover .topppa-service-btn span' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'topppa_show_icon' => 'yes'
				]
			]
		);

		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->add_responsive_control(
			'service_btn_margin',
			[
				'label' => esc_html__('Margin', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em', 'rem', 'custom'],
				'selectors' => [
					'{{WRAPPER}} .topppa-service-box .topppa-service-btn' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'before',
			]
		);
		$this->add_responsive_control(
			'service_btn_padding',
			[
				'label' => esc_html__('Padding', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em', 'rem', 'custom'],
				'selectors' => [
					'{{WRAPPER}} .topppa-service-box .topppa-service-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();

		// <==========>
		// <==========> SHAPE STYLES <==========>

		$this->start_controls_section(
			'shape_styles',
			[
				'label' => esc_html__('Shape', 'topper-pack'),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_responsive_control(
			'wrapper_width',
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
					'{{WRAPPER}} .topppa-service-box .topppa-service-box-shape' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'position_left',
			[
				'label' => esc_html__('Position Left', 'topper-pack'),
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
					'{{WRAPPER}} .topppa-service-box .topppa-service-box-shape' => 'left: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'position_right',
			[
				'label' => esc_html__('Position Right', 'topper-pack'),
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
					'{{WRAPPER}} .topppa-service-box .topppa-service-box-shape' => 'right: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'position_top',
			[
				'label' => esc_html__('Position Top', 'topper-pack'),
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
					'{{WRAPPER}} .topppa-service-box .topppa-service-box-shape' => 'top: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'position_bottom',
			[
				'label' => esc_html__('Position Bottom', 'topper-pack'),
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
					'{{WRAPPER}} .topppa-service-box .topppa-service-box-shape' => 'bottom: {{SIZE}}{{UNIT}};',
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
		$column = $settings['desktop_col'] . ' ' . $settings['ipadpro_col'] . ' ' . $settings['tab_col'];
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

		// multiple shadow
		if ('yes' === $settings['enable_icon_double_shadow']) {

			$icon_shadow1 = $settings['icon_shadow1'];
			$icon_shadow2 = $settings['icon_shadow2'];

			$icon_css_shadow1 = "{$icon_shadow1['horizontal']}px {$icon_shadow1['vertical']}px {$icon_shadow1['blur']}px {$icon_shadow1['spread']}px {$icon_shadow1['color']}";
			$icon_css_shadow2 = "{$icon_shadow2['horizontal']}px {$icon_shadow2['vertical']}px {$icon_shadow2['blur']}px {$icon_shadow2['spread']}px {$icon_shadow2['color']}";

			$icon_box_shadow = $icon_css_shadow1 . ', ' . $icon_css_shadow2;
		} else {
			$icon_box_shadow = 'none';
		}

		$style_classes = [
			'style_one' => '',
			'style_two' => 'topppa-service-box-v2',
			'style_three' => 'topppa-service-box-v3',
			'style_four' => 'topppa-service-box-v4',
			'style_five' => 'topppa-service-box-v5',
			'style_six' => 'topppa-service-box-v6',
			'style_seven' => 'topppa-service-box-v7',
			'style_eight' => 'topppa-service-box-v8',
			'style_nine' => 'topppa-service-box-v9',
			'style_ten' => 'topppa-service-box-v10',
			'style_eleven' => 'topppa-service-box-v11'
		];
		$class = isset($style_classes[$settings['topppa_service_styles']]) ? $style_classes[$settings['topppa_service_styles']] : '';
?>

		<div class="topppa-service-wrapper">
			<div class="row">
				<?php if (!empty($settings['topppa_service_items'])): ?>
					<?php foreach ($settings['topppa_service_items'] as $item): ?>
						<div class="<?php echo esc_attr($column); ?>">
							<div class="topppa-service-box <?php echo esc_attr($class); ?>"
								style="box-shadow: <?php echo esc_attr($box_shadow); ?>;">

								<?php if ($settings['topppa_service_styles'] === 'style_four'): ?>
									<div class="topppa-service-circle-wrap">
										<div class="circle-shape"></div>
									</div>
								<?php endif; ?>

								<?php // Check if the shape should be displayed and style is 'style_three'
								if ($settings['show_topppa_service_shape'] === 'yes'): ?>
									<div
										class="topppa-service-box-shape <?php echo esc_attr(('yes' === $settings['enable_spin'] ? 'spin' : 'no-spin')); ?>">
										<?php echo wp_get_attachment_image($settings['topppa_service_shape_image']['id'], 'full'); ?>
									</div>
								<?php endif; ?>

								<?php if (!empty($item['topppa_service_icon']['value'])): ?>
									<div class="topppa-service-icon <?php echo esc_attr($settings['topppa_service_icon_anim'] === 'anim_two' ? 'flip' : 'bounce'); ?>"
										style="box-shadow: <?php echo esc_attr($icon_box_shadow); ?>;">
										<?php \Elementor\Icons_Manager::render_icon($item['topppa_service_icon'], ['aria-hidden' => 'true']); ?>
									</div>
								<?php endif; ?>

								<?php if ($item['show_subtitle'] === 'yes'): ?>
									<div class="topppa-service-subtitle">
										<?php echo esc_html($item['topppa_service_subtitle']); ?>
									</div>
								<?php endif; ?>

								<?php if (!empty($item['topppa_service_title'])): ?>
									<h5 class="topppa-service-title">
										<?php if (!empty($item['enable_service_title_link']) && $item['enable_service_title_link'] === 'yes'):
											$turl = !empty($item['service_title_link']['url']) ? $item['service_title_link']['url'] : '#';
											$ttarget = !empty($item['service_title_link']['is_external']) ? ' target="_blank"' : '';
											$tnofollow = !empty($item['service_title_link']['nofollow']) ? ' rel="nofollow"' : '';
											$tcustom_attr = !empty($item['service_title_link']['custom_attributes']) ? $item['service_title_link']['custom_attributes'] : '';
										?>
											<a href="<?php echo esc_url($turl); ?>" <?php echo esc_attr($ttarget); ?><?php echo esc_attr($tnofollow); ?><?php echo esc_attr($tcustom_attr); ?>>
											<?php endif; ?>
											<?php echo esc_html($item['topppa_service_title']); ?>
											<?php if (!empty($item['enable_service_title_link']) && $item['enable_service_title_link'] === 'yes'): ?>
											</a>
										<?php endif; ?>
									</h5>
								<?php endif; ?>

								<?php if (!empty($item['topppa_service_description']) && $item['show_description'] === 'yes'): ?>
									<div class="topppa-service-desc">
										<?php echo wp_kses($item['topppa_service_description'], $allowed_html); ?>
									</div>
								<?php endif; ?>


								<?php if (!empty($item['enable_button']) && $item['enable_button'] === 'yes'):
									$burl = !empty($item['link']['url']) ? $item['link']['url'] : '#';
									$btarget = !empty($item['link']['is_external']) ? ' target="_blank"' : '';
									$bnofollow = !empty($item['link']['nofollow']) ? ' rel="nofollow"' : '';
									$bcustom_attr = !empty($item['link']['custom_attributes']) ? $item['link']['custom_attributes'] : '';
								?>
									<a href="<?php echo esc_url($burl); ?>" <?php echo esc_attr($btarget); ?><?php echo esc_attr($bnofollow); ?><?php echo esc_attr($bcustom_attr); ?> class="topppa-service-btn">
										<?php echo esc_html($item['btn_text']); ?>
										<?php if (!empty($item['topppa_enable_services_btn_icon']) && $item['topppa_enable_services_btn_icon'] === 'yes' && !empty($item['topppa_service_btn_icon'])): ?>
											<span class="service-btn-icon">
												<?php \Elementor\Icons_Manager::render_icon($item['topppa_service_btn_icon'], ['aria-hidden' => 'true']); ?>
											</span>
										<?php endif; ?>
									</a>
								<?php endif; ?>

								<?php if ($item['show_count'] === 'yes'): ?>
									<span class="topppa-service-count">
										<?php echo esc_html($item['topppa_service_count']); ?>
									</span>
								<?php endif; ?>

							</div>
						</div>
					<?php endforeach; ?>
				<?php endif; ?>
			</div>
		</div>

<?php
	}
}
