<?php

use \TopperPack\Includes\Controls\Controls_Manager as TopperPack_Controls_Manager;

if (! defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}

/**
 * Elementor topppa Testimonail Widget.
 *
 * Elementor widget that inserts an embbedable content into the page, from any given URL.
 *
 * @since 1.0.0
 */
class TOPPPA_Testimonial_Widget extends \Elementor\Widget_Base {
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
		return 'topppa_testimonial';
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
		return TOPPPA_EPWB . esc_html__('Testimonial', 'topper-pack');
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
		return 'eicon-blockquote';
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
		return ['topppa', 'widget', 'testimonial', 'info', 'topperpack'];
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
		return 'https://doc.topperpack.com/docs/testimonial-widgets/testimonial/';
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
		return 'https://topperpack.com/assets/widgets/testimonial-widget/';
	}

	/**
	 * Register Testimonail widget controls.
	 *
	 * Add input fields to allow the user to customize the widget settings.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function register_controls() {
		$base_url = $this->get_custom_image_url();
		// <========================> topppa LOGO OPTIONS <========================>
		$this->start_controls_section(
			'testimonail_content',
			[
				'label' => esc_html__('Testimonail Select Style', 'topper-pack'),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'topppa_testimonail_styles',
			[
				'label' => esc_html__('Choose Style', 'topper-pack'),
				'type' => TopperPack_Controls_Manager::IMAGECHOOSE,
				'default' => 'style_one',
				'options' => [
					'style_one' => [
						'title' => esc_html__('Style 1', 'topper-pack'),
						'imagelarge' => $base_url . 'style-1.jpg',
						'imagesmall' => $base_url . 'style-1.jpg',
						'width' => '100%',
					],
					'style_two' => [
						'title' => esc_html__('Style 2', 'topper-pack'),
						'imagelarge' => $base_url . 'style-2.jpg',
						'imagesmall' => $base_url . 'style-2.jpg',
						'width' => '100%',
					],
					'style_three' => [
						'title' => esc_html__('Style 3', 'topper-pack'),
						'imagelarge' => $base_url . 'style-3.jpg',
						'imagesmall' => $base_url . 'style-3.jpg',
						'width' => '100%',
					],
					'style_four' => [
						'title' => esc_html__('Style 4', 'topper-pack'),
						'imagelarge' => $base_url . 'style-4.jpg',
						'imagesmall' => $base_url . 'style-4.jpg',
						'width' => '100%',
					],
					'style_five' => [
						'title' => esc_html__('Style 5', 'topper-pack'),
						'imagelarge' => $base_url . 'style-5.jpg',
						'imagesmall' => $base_url . 'style-5.jpg',
						'width' => '100%',
					],
					'style_six' => [
						'title' => esc_html__('Style 6', 'topper-pack'),
						'imagelarge' => $base_url . 'style-6.jpg',
						'imagesmall' => $base_url . 'style-6.jpg',
						'width' => '100%',
					],
				],
			]
		);
		$this->end_controls_section();
		$this->start_controls_section(
			'topppa_tstimonial_content',
			[
				'label' => esc_html__('Testimonial Content', 'topper-pack'),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);


		$repeater = new \Elementor\Repeater();
		$repeater->add_control(
			'elable_testimonial_top',
			[
				'label' => esc_html__('Enable Rating', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Show', 'topper-pack'),
				'label_off' => esc_html__('Hide', 'topper-pack'),
				'return_value' => 'yes',
				'default' => 'no',
			]
		);
		$repeater->add_control(
			'select_testimonial_top',
			[
				'label' => esc_html__('Select Top Content', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SELECT2,
				'label_block' => true,
				'multiple' => true,
				'options' => [
					'select_icon'  => esc_html__('Icon', 'topper-pack'),
					'select_logo' => esc_html__('Logo', 'topper-pack'),
					'select_rating' => esc_html__('Rating', 'topper-pack'),
					'label' => esc_html__('Label', 'topper-pack'),
				],
				'default' => ['select_icon', 'select_logo'],
				'condition' => [
					'elable_testimonial_top' => 'yes',
				]
			]
		);
		// ... existing code ...
		$repeater->add_control(
			'testimonial_top_label',
			[
				'label' => esc_html__('Top Content Label', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => '',
				'placeholder' => esc_html__('Enter label for top content', 'topper-pack'),
				'condition' => [
					'elable_testimonial_top' => 'yes',
				],
			]
		);
		// ... existing code ...
		$repeater->add_control(
			'quote_icon',
			[
				'label'   => esc_html__('Icon', 'topper-pack'),
				'type'    => \Elementor\Controls_Manager::ICONS,
				'condition' => [
					'select_testimonial_top' => 'select_icon',
					'elable_testimonial_top' => 'yes',
				]
			]
		);
		$repeater->add_control(
			'logo',
			[
				'label'   => esc_html__('Testimonial Logo', 'topper-pack'),
				'type'    => \Elementor\Controls_Manager::MEDIA,
				'condition' => [
					'select_testimonial_top' => 'select_logo',
					'elable_testimonial_top' => 'yes',
				]
			]
		);
		$repeater->add_control(
			'testimonial_rating',
			[
				'label' => __('Rating', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'range' => [
					'px' => [
						'min' => 1,
						'max' => 5,
						'step' => .5,
					],
				],
				'default' => [
					'size' => 5,
				],
				'condition' => [
					'select_testimonial_top' => 'select_rating',
					'elable_testimonial_top' => 'yes',
				],
			]
		);
		$repeater->add_control(
			'enable_decimal',
			[
				'label' => esc_html__('Show Decimal', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Show', 'topper-pack'),
				'label_off' => esc_html__('Hide', 'topper-pack'),
				'return_value' => 'yes',
				'default' => 'yes',
				'condition' => [
					'select_testimonial_top' => 'select_rating',
					'elable_testimonial_top' => 'yes',
				],
			]
		);
		$repeater->add_control(
			'image',
			[
				'label'   => esc_html__('Testimonial Image', 'topper-pack'),
				'type'    => \Elementor\Controls_Manager::MEDIA,
			]
		);

		$repeater->add_control(
			'name',
			[
				'label'       => esc_html__('Name', 'topper-pack'),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'default'     => esc_html__('Marvin McKinney', 'topper-pack'),
				'label_block' => true,
			]
		);

		$repeater->add_control(
			'designation',
			[
				'label'       => esc_html__('Designation', 'topper-pack'),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'default'     => esc_html__('CFO', 'topper-pack'),
				'label_block' => true,
			]
		);
		$repeater->add_control(
			'description',
			[
				'label' => esc_html__('Description', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::WYSIWYG,
				'default' => esc_html__('Deforestation, and climate change, have led to a decline in biodiversity and negative impacts on ecosystems. Ecologists use a variety of methods, such as field observations, experiments, and modeling, to study the complex interactions between .', 'topper-pack'),
				'label_block' => true,
				'separator' => 'before',
			]
		);
		$repeater->add_control(
			'elable_rating',
			[
				'label' => esc_html__('Enable Rating', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Show', 'topper-pack'),
				'label_off' => esc_html__('Hide', 'topper-pack'),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);
		$repeater->add_control(
			'testimonial_bottom_rating',
			[
				'label' => __('Rating', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'range' => [
					'px' => [
						'min' => 1,
						'max' => 5,
						'step' => .5,
					],
				],
				'default' => [
					'size' => 5,
				],
				'condition' => [
					'elable_rating' => 'yes',
				],
			]
		);
		$this->add_control(
			'repeater_list',
			[
				'label'       => esc_html__('Repeater List', 'topper-pack'),
				'type'        => \Elementor\Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'default'     => [
					[
						'name'        => esc_html__('Wilhum Alexs', 'topper-pack'),
						'designation' => esc_html__('CFO/Founder', 'topper-pack'),
					],
					[
						'name'        => esc_html__('David Smith', 'topper-pack'),
						'designation' => esc_html__('CFO/Founder', 'topper-pack'),
					],
				],
				'title_field' => '{{{ name }}}',
			]
		);

		$this->add_control(
			'elable_shape',
			[
				'label' => esc_html__('Enable Shape', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Show', 'topper-pack'),
				'label_off' => esc_html__('Hide', 'topper-pack'),
				'return_value' => 'yes',
				'default' => 'no',
				'condition' => [
					'topppa_testimonail_styles' => 'style_one',
				],
			]
		);
		$this->add_responsive_control(
			'shape_after_color',
			[
				'label' => esc_html__('After Color', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .testimonial-item-box.shape:before' => 'background-color: {{VALUE}}',
				],
				'condition' => [
					'elable_shape' => 'yes',
					'topppa_testimonail_styles' => 'style_one',
				],
			]
		);
		$this->add_responsive_control(
			'shape_before_color',
			[
				'label' => esc_html__('Before Color', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .testimonial-item-box.shape:after' => 'background-color: {{VALUE}}',
				],
				'condition' => [
					'elable_shape' => 'yes',
					'topppa_testimonail_styles' => 'style_one',
				],
			]
		);
		$this->add_control(
			'content_section',
			[
				'label' => __('Slider Options', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_control(
			'enable_slider',
			[
				'label' => esc_html__('Enable Slider', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Yes', 'topper-pack'),
				'label_off' => esc_html__('No', 'topper-pack'),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);
		$this->add_control(
			'enable_slider_auto_loop',
			[
				'label' => esc_html__('Enable Auto Loop', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Yes', 'topper-pack'),
				'label_off' => esc_html__('No', 'topper-pack'),
				'return_value' => 'yes',
				'default' => 'yes',
				'condition' => [
					'enable_slider' => 'yes',
				],
			]
		);

		$this->add_control(
			'enable_rtl',
			[
				'label' => esc_html__('Enable RTL', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Yes', 'topper-pack'),
				'label_off' => esc_html__('No', 'topper-pack'),
				'return_value' => 'yes',
				'default' => 'no',
				'condition' => [
					'enable_slider' => 'yes',
				],
			]
		);

		$this->add_control(
			'slide_show_lagrge_item',
			[
				'label' => esc_html__('Items to display on Large Devices', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'min' => 1,
				'max' => 6,
				'step' => 1,
				'default' => 2,
				'condition' => [
					'enable_slider' => 'yes',
				],
			]
		);
		$this->add_control(
			'slide_show_teblet_item',
			[
				'label' => esc_html__('Items to display on Teblet Devices', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'min' => 1,
				'max' => 6,
				'step' => 1,
				'default' => 2,
				'condition' => [
					'enable_slider' => 'yes',
				],
			]
		);
		$this->add_control(
			'slide_show_mobile_item',
			[
				'label' => esc_html__('Items to display on Mobile Devices', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'min' => 1,
				'max' => 6,
				'step' => 1,
				'default' => 1,
				'condition' => [
					'enable_slider' => 'yes',
				],
			]
		);
		$this->add_control(
			'slide_show_extra_mobile_item',
			[
				'label' => esc_html__('Items to display on Small Mobile Devices', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'min' => 1,
				'max' => 6,
				'step' => 1,
				'default' => 1,
				'condition' => [
					'enable_slider' => 'yes',
				],
			]
		);
		$this->add_control(
			'slider_space_between',
			[
				'label'   => __('Space Between Slides (px)', 'topper-pack'),
				'type'    => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
						'step' => 1,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 24,
				],
				'condition' => [
					'enable_slider' => 'yes',
				],
			]
		);
		$this->add_control(
			'slide_speed',
			[
				'label' => esc_html__('Slide Speed (ms)', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'min' => 100,
				'max' => 10000,
				'step' => 100,
				'default' => 2000,
				'condition' => [
					'enable_slider' => 'yes',
				],
			]
		);

		$this->add_control(
			'slider_speed',
			[
				'label' => esc_html__('Slider Transition Speed (ms)', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'min' => 100,
				'max' => 5000,
				'step' => 100,
				'default' => 600,
				'condition' => [
					'enable_slider' => 'yes',
				],
			]
		);
		$this->add_control(
			'enable_dote',
			[
				'label'        => esc_html__('Enable Dots', 'topper-pack'),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => esc_html__('On', 'topper-pack'),
				'label_off'    => esc_html__('Off', 'topper-pack'),
				'return_value' => 'yes',
				'default'      => 'no',
				'condition' => [
					'enable_slider' => 'yes',
				],
			]
		);
		$this->add_control(
			'enable_arrow',
			[
				'label'        => esc_html__('Enable Arrow', 'topper-pack'),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => esc_html__('On', 'topper-pack'),
				'label_off'    => esc_html__('Off', 'topper-pack'),
				'return_value' => 'yes',
				'default'      => 'yes',
				'condition' => [
					'enable_slider' => 'yes',
				],
			]
		);
		$this->add_control(
			'style_arrow_type',
			[
				'label' => esc_html__('Select Arrow Type', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'options' => [
					'text' => [
						'title' => esc_html__('Default', 'topper-pack'),
						'icon' => 'eicon-animation-text',
					],
					'arrow_icons' => [
						'title' => esc_html__('Icon', 'topper-pack'),
						'icon' => 'eicon-info-circle',
					],
				],
				'default' => 'text',
				'condition' => [
					'enable_slider' => 'yes',
				],
			]
		);
		$this->add_control(
			'default_arrow_notice',
			[
				'type' => \Elementor\Controls_Manager::ALERT,
				'alert_type' => 'success',
				'content' => esc_html__('Default Arrow', 'topper-pack'),
				'condition' => [
					'enable_arrow' => 'yes',
					'enable_slider' => 'yes',
					'style_arrow_type' => 'text',
				]
			]
		);
		$this->add_control(
			'left_arrow_icon',
			[
				'label' => esc_html__('Left Arrow Icon', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::ICONS,
				'default' => [
					'value' => 'fas fa-arrow-left',
					'library' => 'fa-solid',
				],
				'condition' => [
					'enable_arrow' => 'yes',
					'enable_slider' => 'yes',
					'style_arrow_type' => 'arrow_icons',
				],
			]
		);
		$this->add_control(
			'right_arrow_icon',
			[
				'label' => esc_html__('RIght Arrwo Icon', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::ICONS,
				'default' => [
					'value' => 'fas fa-arrow-right',
					'library' => 'fa-solid',
				],
				'condition' => [
					'enable_arrow' => 'yes',
					'enable_slider' => 'yes',
					'style_arrow_type' => 'arrow_icons',
				],
			]
		);
		$this->add_control(
			'xl_col',
			[
				'label' => esc_html__('Columns on Extra Large Devices', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => [
					'col-xl-2' => esc_html__('6 Columns', 'topper-pack'),
					'col-xl-3' => esc_html__('4 Columns', 'topper-pack'),
					'col-xl-4' => esc_html__('3 Columns', 'topper-pack'),
					'col-xl-6' => esc_html__('2 Columns', 'topper-pack'),
					'col-xl-12' => esc_html__('1 Columns', 'topper-pack'),
				],
				'default' => 'col-xl-6',
				'condition' => [
					'enable_slider!' => 'yes',
				],
			]
		);

		$this->add_control(
			'lg_col',
			[
				'label' => esc_html__('Columns on Teblet Devices', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => [
					'col-lg-2' => esc_html__('6 Columns', 'topper-pack'),
					'col-lg-3' => esc_html__('4 Columns', 'topper-pack'),
					'col-lg-4' => esc_html__('3 Columns', 'topper-pack'),
					'col-lg-6' => esc_html__('2 Columns', 'topper-pack'),
					'col-lg-12' => esc_html__('1 Columns', 'topper-pack'),
				],
				'default' => 'col-lg-6',
				'condition' => [
					'enable_slider!' => 'yes',
				],
			]
		);

		$this->add_control(
			'md-col',
			[
				'label' => esc_html__('Columns on Mobile', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => [
					'col-md-2' => esc_html__('6 Columns', 'topper-pack'),
					'col-md-3' => esc_html__('4 Columns', 'topper-pack'),
					'col-md-4' => esc_html__('3 Columns', 'topper-pack'),
					'col-md-6' => esc_html__('2 Columns', 'topper-pack'),
					'col-md-12' => esc_html__('1 Columns', 'topper-pack'),
				],
				'default' => 'col-md-12',
				'condition' => [
					'enable_slider!' => 'yes',
				],
			]
		);
		$this->end_controls_section();

		//========================================//
		//========= Testimonial BOX style Start==========//
		//========================================//
		$this->start_controls_section(
			'box_style',
			[
				'label' => esc_html__('Box Style', 'topper-pack'),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_responsive_control(
			'box_align',
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
					'{{WRAPPER}} .testimonial-item-box' => 'text-align: {{VALUE}};',
					'{{WRAPPER}} .testimonial-v3 .testimonial-author-info-area' => 'justify-content: {{VALUE}};',
				],
			]
		);

		$this->start_controls_tabs(
			'box_tabs'
		);
		$this->start_controls_tab(
			'box_normal_tab',
			[
				'label' => esc_html__('Normal', 'topper-pack'),
			]
		);
		$this->add_responsive_control(
			'background_css_blur',
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
					'{{WRAPPER}} .testimonial-item-box' => 'backdrop-filter: blur({{SIZE}}{{UNIT}});',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name'     => 'box_backgrounds',
				'label'    => esc_html__('Background', 'topper-pack'),
				'types'    => ['classic', 'gradient'],
				'selector' => '{{WRAPPER}} .testimonial-item-box',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name'     => 'box_border',
				'label'    => esc_html__('Border', 'topper-pack'),
				'selector' => '{{WRAPPER}} .testimonial-item-box',
			]
		);
		$this->add_responsive_control(
			'box_border_radius',
			[
				'label'      => esc_html__('Border Radius', 'topper-pack'),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors'  => [
					'{{WRAPPER}} .testimonial-item-box' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'box_shadow',
				'label'    => esc_html__('Box Shadow', 'topper-pack'),
				'selector' => '{{WRAPPER}} .testimonial-item-box',
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
		$this->end_controls_tab();
		$this->start_controls_tab(
			'box_hover_tab',
			[
				'label' => esc_html__('Hover', 'topper-pack'),
				'condition' => [
					'topppa_testimonail_styles!' => 'style_two',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name'     => 'box_backgrounds_hover',
				'label'    => esc_html__('Background', 'topper-pack'),
				'types'    => ['classic', 'gradient'],
				'selector' => '{{WRAPPER}} .testimonial-item-box:hover',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'box_shadow_hover',
				'label'    => esc_html__('Box Shadow', 'topper-pack'),
				'selector' => '{{WRAPPER}} .testimonial-item-box:hover',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name'     => 'box_border_hover',
				'label'    => esc_html__('Border', 'topper-pack'),
				'selector' => '{{WRAPPER}} .testimonial-item-box:hover',
			]
		);

		$this->add_responsive_control(
			'box_border_radius_hover',
			[
				'label'      => esc_html__('Border Radius', 'topper-pack'),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors'  => [
					'{{WRAPPER}} .testimonial-item-box:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->add_responsive_control(
			'box_margin',
			[
				'label'      => esc_html__('Margin', 'topper-pack'),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors'  => [
					'{{WRAPPER}} .testimonial-item-box' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'box_padding',
			[
				'label'      => esc_html__('Padding', 'topper-pack'),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors'  => [
					'{{WRAPPER}} .testimonial-item-box' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'testimonial_top_style',
			[
				'label' => esc_html__('Testimonial Top Style', 'topper-pack'),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_responsive_control(
			'content_direction',
			[
				'label' => esc_html__('Content Direction', 'topper-pack'),
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
					'{{WRAPPER}} .testimonial-item-box .testimonial-top-area' => 'flex-direction: {{VALUE}};',
				],
			]
		);
		$this->start_controls_tabs(
			'testimonial_top_tabs'
		);
		$this->start_controls_tab(
			'testimonial_top_icon',
			[
				'label' => esc_html__('Icon', 'topper-pack'),
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'testimonial_top_typo',
				'label' => esc_html__('Typography', 'topper-pack'),
				'selector' => '{{WRAPPER}} .testimonial-item-box .testimonial-quit',
			]
		);
		$this->add_responsive_control(
			'testimonial_top_color',
			[
				'label' => esc_html__('Color', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .testimonial-item-box .testimonial-quit' => 'color: {{VALUE}}',
					'{{WRAPPER}} .testimonial-item-box .testimonial-quit svg path' => 'fill: {{VALUE}}',
				],
			]
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'testimonial_top_logo',
			[
				'label' => esc_html__('Logo', 'topper-pack'),
			]
		);
		$this->add_responsive_control(
			'logo_height',
			[
				'label' => esc_html__('Height', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px', '%', 'em', 'rem', 'custom'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 400,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default' => [
					'unit' => 'px',
				],
				'selectors' => [
					'{{WRAPPER}} .testimonial-logo img' => 'height: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .testimonial-quit img' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'logo_width',
			[
				'label' => esc_html__('Width', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px', '%', 'em', 'rem', 'custom'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 400,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .testimonial-logo img' => 'width: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .testimonial-quit img' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'logo_border',
				'selector' => '{{WRAPPER}} .testimonial-logo img,{{WRAPPER}} .testimonial-quit img',
			]
		);
		$this->add_responsive_control(
			'logo_border_radius',
			[
				'label' => esc_html__('Border Radius', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .testimonial-quit img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .testimonial-logo img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_tab();

		$this->start_controls_tab(
			'testimonial_top_ratting',
			[
				'label' => esc_html__('Rating', 'topper-pack'),
				'condition' => [
					'topppa_testimonail_styles!' => ['style_four'],
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'testimonial_ratting_typo',
				'label' => esc_html__('Typography', 'topper-pack'),
				'selector' => '{{WRAPPER}} .testimonial-top-area .testimonial-rating',
			]
		);
		$this->add_responsive_control(
			'testimonial_ratting_color',
			[
				'label' => esc_html__('Color', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .testimonial-top-area .testimonial-rating' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_responsive_control(
			'testimonial_ratting_text_color',
			[
				'label' => esc_html__('Text Color', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .testimonial-top-area .testimonial-rating span' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_responsive_control(
			'one_rating_icon_gap',
			[
				'label' => esc_html__('Gap', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px', '%', 'em', 'rem', 'custom'],
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
					'{{WRAPPER}} .testimonial-item-box .testimonial-rating i' => 'margin-right: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_tab();

		$this->start_controls_tab(
			'testimonial_top_label',
			[
				'label' => esc_html__('Label', 'topper-pack'),
				'condition' => [
					'topppa_testimonail_styles!' => ['style_four'],
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'testi_top_label_typo',
				'label' => esc_html__('Typography', 'topper-pack'),
				'selector' => '{{WRAPPER}} .testimonial-top-label',
			]
		);
		$this->add_responsive_control(
			'testi_top_label_color',
			[
				'label' => esc_html__('Color', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .testimonial-top-label' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'testi_top_label_border',
				'selector' => '{{WRAPPER}} .testimonial-top-label',
			]
		);
		$this->add_responsive_control(
			'testi_top_label_border_radius',
			[
				'label' => esc_html__('Border Radius', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .testimonial-top-label' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->add_responsive_control(
			'testimonial_top_box_margin',
			[
				'label'      => esc_html__('Margin', 'topper-pack'),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors'  => [
					'{{WRAPPER}} .testimonial-top-area' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'topppa_testimonail_styles' => ['style_one', 'style_two', 'style_three'],
				],
			]
		);
		$this->add_responsive_control(
			'testimonial_top_box_padding',
			[
				'label'      => esc_html__('Padding', 'topper-pack'),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors'  => [
					'{{WRAPPER}} .testimonial-top-area' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'topppa_testimonail_styles' => ['style_one', 'style_two', 'style_three'],
				],
			]
		);

		$this->add_control(
			'icon_position_x',
			[
				'label' => __('Horizontal Position (X)', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px', '%'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 500,
					],
					'%' => [
						'min' => -100,
						'max' => 100,
					],
				],
				'default' => [
					'unit' => 'px',
				],
				'selectors' => [
					'{{WRAPPER}} .testimonial-img .testimonial-quit' => 'left: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'topppa_testimonail_styles!' => ['style_one', 'style_two', 'style_three'],
				],

			]
		);

		$this->add_control(
			'icon_position_y',
			[
				'label' => __('Vertical Position (Y)', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px', '%'],
				'range' => [
					'px' => [
						'min' => -500,
						'max' => 500,
					],
					'%' => [
						'min' => -100,
						'max' => 100,
					],
				],
				'default' => [
					'unit' => 'px',
				],
				'selectors' => [
					'{{WRAPPER}} .testimonial-img .testimonial-quit' => 'top: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'topppa_testimonail_styles!' => ['style_one', 'style_two', 'style_three'],
				],

			]
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'testimonial_content_options',
			[
				'label' => esc_html__('Testimonial Content Style', 'topper-pack'),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->start_controls_tabs(
			'testimonial_tabs'
		);

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
				'selector' => '{{WRAPPER}} .testimonial-description-area',
			]
		);
		$this->add_responsive_control(
			'dec_color',
			[
				'label' => esc_html__('Color', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .testimonial-description-area' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_responsive_control(
			'dec_color_hover',
			[
				'label' => esc_html__('Link Hover Color', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .testimonial-description-area a:hover' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'dec_border',
				'selector' => '{{WRAPPER}} .testimonial-description-area',
			]
		);
		$this->add_responsive_control(
			'dec_margin',
			[
				'label' => esc_html__('Margin', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .testimonial-description-area' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .testimonial-description-area' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_tab();

		$this->start_controls_tab(
			'style_reatting_tab',
			[
				'label' => esc_html__('Rating', 'topper-pack'),
				'condition' => [
					'topppa_testimonail_styles' => ['style_three', 'style_four', 'style_five', 'style_six'],
				],
			]
		);
		$this->add_responsive_control(
			'client_ratting_gap',
			[
				'label' => esc_html__('Content Gap', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 50,
						'step' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .testimonial-wrapper .testimonial-rating-text' => 'gap: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'reatting_icon_color',
			[
				'label' => esc_html__('Color', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .testimonial-wrapper .testimonial-rating-text' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'reatting_text_typo',
				'label' => esc_html__('Typography', 'topper-pack'),
				'selector' => '{{WRAPPER}} .testimonial-wrapper .testimonial-rating-text',
			]
		);
		$this->add_responsive_control(
			'reatting_icon_margin',
			[
				'label'      => esc_html__('Margin', 'topper-pack'),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors'  => [
					'{{WRAPPER}} .testimonial-wrapper .testimonial-rating-text' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'reatting_icon_padding',
			[
				'label'      => esc_html__('Padding', 'topper-pack'),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors'  => [
					'{{WRAPPER}} .testimonial-wrapper .testimonial-rating-text' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();
		$this->start_controls_section(
			'testi_content',
			[
				'label' => esc_html__('Client Info Style', 'topper-pack'),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_responsive_control(
			'client_content_gap',
			[
				'label' => esc_html__('Content Gap', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
						'step' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .testimonial-wrapper .testimonial-author-info' => 'gap: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name'     => 'client_box_backgrounds',
				'label'    => esc_html__('Background', 'topper-pack'),
				'types'    => ['classic', 'gradient'],
				'selector' => '{{WRAPPER}} .testimonial-v2 .testimonial-author-info-area',
				'condition' => [
					'topppa_testimonail_styles' => 'style_two',
				]
			]
		);
		$this->add_responsive_control(
			'client_box_margin',
			[
				'label'      => esc_html__('Margin', 'topper-pack'),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors'  => [
					'{{WRAPPER}} .testimonial-v2 .testimonial-author-info-area' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'topppa_testimonail_styles' => 'style_two',
				]
			]
		);
		$this->add_responsive_control(
			'client_box_padding',
			[
				'label'      => esc_html__('Padding', 'topper-pack'),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors'  => [
					'{{WRAPPER}} .testimonial-v2 .testimonial-author-info-area' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'topppa_testimonail_styles' => 'style_two',
				]
			]
		);
		$this->start_controls_tabs(
			'testi_content_tabs'
		);
		$this->start_controls_tab(
			'style_image_tab',
			[
				'label' => esc_html__('Image', 'topper-pack'),
			]
		);
		$this->add_responsive_control(
			'Image_height',
			[
				'label' => esc_html__('Height', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px', '%', 'em', 'rem', 'custom'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 600,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default' => [
					'unit' => 'px',
				],
				'selectors' => [
					'{{WRAPPER}} .testimonial-wrapper .testimonial-img > img' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'Image_width',
			[
				'label' => esc_html__('Width', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px', '%', 'em', 'rem', 'custom'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 600,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .testimonial-wrapper .testimonial-img > img' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'min_Image_width',
			[
				'label' => esc_html__('Min Width', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px', '%', 'em', 'rem', 'custom'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 600,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default' => [
					'unit' => 'px',
				],
				'selectors' => [
					'{{WRAPPER}} .testimonial-wrapper .testimonial-img > img' => 'min-width: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'image_border',
				'selector' => '{{WRAPPER}} .testimonial-wrapper .testimonial-img > img',
			]
		);
		$this->add_responsive_control(
			'image_border_radius',
			[
				'label' => esc_html__('Border Radius', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .testimonial-wrapper .testimonial-img > img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .testimonial-wrapper .testimonial-img > img' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .testimonial-wrapper .testimonial-img > img' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'testi_name_tab',
			[
				'label' => esc_html__('Name', 'topper-pack'),
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'testi_name_typo',
				'selector' => '{{WRAPPER}} .testimonial-wrapper .testimonial-author-name',
			]
		);
		$this->add_responsive_control(
			'testi_name_color',
			[
				'label'     => esc_html__('Color', 'topper-pack'),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .testimonial-wrapper .testimonial-author-name' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_responsive_control(
			'testi_name_Margin',
			[
				'label'      => esc_html__('Margin', 'topper-pack'),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors'  => [
					'{{WRAPPER}} .testimonial-wrapper .testimonial-author-name' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'testi_name_padding',
			[
				'label'      => esc_html__('Padding', 'topper-pack'),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors'  => [
					'{{WRAPPER}} .testimonial-wrapper .testimonial-author-name' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'testi_designation_tab',
			[
				'label' => esc_html__('Designation', 'topper-pack'),
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'testi_designation_typo',
				'selector' => '{{WRAPPER}} .testimonial-wrapper .testimonial-author-designation',
			]
		);
		$this->add_responsive_control(
			'testi_designation_color',
			[
				'label'     => esc_html__('Color', 'topper-pack'),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .testimonial-wrapper .testimonial-author-designation' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_responsive_control(
			'testi_designation_Margin',
			[
				'label'      => esc_html__('Margin', 'topper-pack'),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors'  => [
					'{{WRAPPER}} .testimonial-wrapper .testimonial-author-designation' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'testi_designation_padding',
			[
				'label'      => esc_html__('Padding', 'topper-pack'),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors'  => [
					'{{WRAPPER}} testimonial-wrapper .testimonial-author-designation' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'client_ratting_section',
			[
				'label' => __('Ratting Style Options', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => [
					'topppa_testimonail_styles' => ['style_one', 'style_two'],
				],
			]
		);
		$this->add_responsive_control(
			'client_reatting_icon_color',
			[
				'label' => esc_html__('Ratting Color', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .testimonial-author-designation .testimonial-rating-text' => 'color: {{VALUE}}',
				],
				'condition' => [
					'topppa_testimonail_styles' => ['style_one', 'style_two'],
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'client_reatting_text_typo',
				'label' => esc_html__('Ratting Typography', 'topper-pack'),
				'selector' => '{{WRAPPER}} .testimonial-author-designation .testimonial-rating-text',
				'condition' => [
					'topppa_testimonail_styles' => ['style_one', 'style_two'],
				],
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();
		$this->start_controls_section(
			'arrow_content_option',
			[
				'label' => esc_html__('Arrow Style Option', 'topper-pack'),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
				'condition' => [
					'enable_arrow' => 'yes',
					'enable_slider' => 'yes',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'arrow_typography',
				'selector' => '{{WRAPPER}} .testimonial-wrapper .testimonial-v1-arrow .button',
			]
		);
		$this->add_responsive_control(
			'arrow_box_align',
			[
				'label' => esc_html__('Alignment', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'options' => [
					'flex-start' => [
						'title' => esc_html__('Left', 'topper-pack'),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => esc_html__('Center', 'topper-pack'),
						'icon' => 'eicon-text-align-center',
					],
					'flex-end' => [
						'title' => esc_html__('Right', 'topper-pack'),
						'icon' => 'eicon-text-align-right',
					],
				],
				'toggle' => true,
				'selectors' => [
					'{{WRAPPER}} .testimonial-wrapper .testimonial-v1-arrow' => 'justify-content: {{VALUE}};',
				],
			]
		);
		$this->add_responsive_control(
			'arrow_gap',
			[
				'label'      => esc_html__('Gap', 'topper-pack'),
				'type'       => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px', '%', 'custom'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 300,
						'step' => 1,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .testimonial-wrapper .testimonial-v1-arrow' => 'gap: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'arrow_height',
			[
				'label' => esc_html__('Height', 'topper-pack'),
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
					'{{WRAPPER}} .testimonial-wrapper .testimonial-v1-arrow .button' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'arrow_width',
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
					'{{WRAPPER}} .testimonial-wrapper .testimonial-v1-arrow .button' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);


		$this->start_controls_tabs(
			'arrow_style_tabs'
		);
		$this->start_controls_tab(
			'arrow_normal_tabs',
			[
				'label' => __('Normal', 'topper-pack'),
			]
		);
		$this->add_responsive_control(
			'arrow_color',
			[
				'label'     => esc_html__('Color', 'topper-pack'),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .testimonial-wrapper .testimonial-v1-arrow .button' => 'color: {{VALUE}}',
					'{{WRAPPER}} .testimonial-wrapper .testimonial-v1-arrow .button svg path' => 'fill: {{VALUE}}',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'arrow_background',
				'label' => esc_html__('Background', 'topper-pack'),
				'types' => ['classic', 'gradient', 'video'],
				'selector' => '{{WRAPPER}} .testimonial-wrapper .testimonial-v1-arrow .button',
				'fields_options' => [
					'background' => [
						'label' => esc_html__('Background', 'topper-pack'),
						'default' => 'classic',
					],
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name'     => 'arrow_border',
				'label'    => esc_html__('Border', 'topper-pack'),
				'selector' => '{{WRAPPER}} .testimonial-wrapper .testimonial-v1-arrow .button',
			]
		);
		$this->add_responsive_control(
			'arrow_border_radius',
			[
				'label'      => esc_html__('Border Radius', 'topper-pack'),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors'  => [
					'{{WRAPPER}} .testimonial-wrapper .testimonial-v1-arrow' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'arrow_hover_tabs',
			[
				'label' => __('Hover', 'topper-pack'),
			]
		);
		$this->add_responsive_control(
			'arrow_color_hover',
			[
				'label'     => esc_html__('Hover Color', 'topper-pack'),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .testimonial-wrapper .testimonial-v1-arrow .button:hover' => 'color: {{VALUE}}',
					'{{WRAPPER}} .testimonial-wrapper .testimonial-v1-arrow .button:hover svg path' => 'fill: {{VALUE}}',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'arrow_background_hover',
				'label' => esc_html__('Background', 'topper-pack'),
				'types' => ['classic', 'gradient', 'video'],
				'selector' => '{{WRAPPER}} .testimonial-wrapper .testimonial-v1-arrow .button:hover',
				'fields_options' => [
					'background' => [
						'label' => esc_html__('Background', 'topper-pack'),
						'default' => 'classic',
					],
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name'     => 'arrow_border_hover',
				'label'    => esc_html__('Border', 'topper-pack'),
				'selector' => '{{WRAPPER}} .testimonial-wrapper .testimonial-v1-arrow .button:hover,',
			]
		);
		$this->add_responsive_control(
			'arrow_border_radius_hover',
			[
				'label'      => esc_html__('Border Radius', 'topper-pack'),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors'  => [
					'{{WRAPPER}} .testimonial-wrapper .testimonial-v1-arrow .button:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->add_responsive_control(
			'arrow_Margin',
			[
				'label'      => esc_html__('Margin', 'topper-pack'),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors'  => [
					'{{WRAPPER}} .testimonial-wrapper .testimonial-v1-arrow .button' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'arrow_padding',
			[
				'label'      => esc_html__('Padding', 'topper-pack'),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors'  => [
					'{{WRAPPER}} .testimonial-wrapper .testimonial-v1-arrow .button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();
		$this->start_controls_section(
			'dote_content_option',
			[
				'label' => esc_html__('Dots Style', 'topper-pack'),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
				'condition' => [
					'enable_dote' => 'yes',
					'enable_slider' => 'yes',
				],
			]
		);
		$this->add_responsive_control(
			'dote_gap',
			[
				'label'      => esc_html__('Gap', 'topper-pack'),
				'type'       => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px', '%', 'custom'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 300,
						'step' => 1,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .topppa-dote-pagination' => 'gap: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'dote_align',
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
					'flex-end' => [
						'title' => esc_html__('Right', 'topper-pack'),
						'icon' => 'eicon-justify-end-h',
					],
				],
				'toggle' => true,
				'selectors' => [
					'{{WRAPPER}} .topppa-dote-pagination' => 'justify-content: {{VALUE}};',
				],
			]
		);
		$this->add_responsive_control(
			'dote_height',
			[
				'label'      => esc_html__('Height', 'topper-pack'),
				'type'       => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px', '%', 'custom'],
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
				'default' => [
					'unit' => 'px',
				],
				'selectors'  => [
					'{{WRAPPER}} .swiper-pagination-bullets span.swiper-pagination-bullet' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'dote_width',
			[
				'label'      => esc_html__('Width', 'topper-pack'),
				'type'       => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px', '%', 'custom'],
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
				'default' => [
					'unit' => 'px',
				],
				'selectors'  => [
					'{{WRAPPER}} .swiper-pagination-bullets span.swiper-pagination-bullet' => 'Width: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'dote_background',
				'label' => esc_html__('Background', 'topper-pack'),
				'types' => ['classic', 'gradient', 'video'],
				'selector' => '{{WRAPPER}} .topppa-dote-pagination span',
				'fields_options' => [
					'background' => [
						'label' => esc_html__('Background', 'topper-pack'),
						'default' => 'classic',
					],
				],
			]
		);
		$this->add_responsive_control(
			'dote_opacity',
			[
				'label' => esc_html__('Opacity', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1,
						'step' => .1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .topppa-dote-pagination span' => 'opacity: {{SIZE}};',
				],
			]
		);
		$this->add_responsive_control(
			'dote_scale',
			[
				'label' => esc_html__('Border Scale', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default' => [
					'size' => 1,
				],
				'selectors' => [
					'{{WRAPPER}} .topppa-dote-pagination .swiper-pagination-bullet:after' => 'transform: translate(-50%, -50%) scale({{SIZE}});',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name'     => 'dote_border',
				'label'    => esc_html__('Border', 'topper-pack'),
				'selector' => '{{WRAPPER}} .topppa-dote-pagination .swiper-pagination-bullet:after',
			]
		);
		$this->add_responsive_control(
			'dote_border_radius',
			[
				'label'      => esc_html__('Border Radius', 'topper-pack'),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors'  => [
					'{{WRAPPER}} .topppa-dote-pagination .swiper-pagination-bullet:after' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'active_styles',
			[
				'label' => esc_html__('Active Styles', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_responsive_control(
			'position_x',
			[
				'label' => esc_html__('Postition X', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px', '%', 'em', 'rem', 'custom'],
				'range' => [
					'px' => [
						'min' => -200,
						'max' => 500,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .topppa-dote-pagination .swiper-pagination-bullet:after' => 'left: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'position_y',
			[
				'label' => esc_html__('Postition Y', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px', '%', 'em', 'rem', 'custom'],
				'range' => [
					'px' => [
						'min' => -200,
						'max' => 500,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .topppa-dote-pagination .swiper-pagination-bullet:after' => 'top: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'active_dote_height',
			[
				'label'      => esc_html__('Height', 'topper-pack'),
				'type'       => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px', '%', 'custom'],
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
				'default' => [
					'unit' => 'px',
				],
				'selectors'  => [
					'{{WRAPPER}} .swiper-pagination-bullets span.swiper-pagination-bullet-active' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'active_dote_width',
			[
				'label'      => esc_html__('Width', 'topper-pack'),
				'type'       => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px', '%', 'custom'],
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
				'default' => [
					'unit' => 'px',
				],
				'selectors'  => [
					'{{WRAPPER}} .swiper-pagination-bullets span.swiper-pagination-bullet-active' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'active_dote_background',
				'label' => esc_html__('Background', 'topper-pack'),
				'types' => ['classic', 'gradient', 'video'],
				'selector' => '{{WRAPPER}} .topppa-dote-pagination .swiper-pagination-bullet-active',
				'fields_options' => [
					'background' => [
						'label' => esc_html__('Background', 'topper-pack'),
						'default' => 'classic',
					],
				],
			]
		);
		$this->add_responsive_control(
			'dote_active_opacity',
			[
				'label' => esc_html__('Opacity', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1,
						'step' => .1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .topppa-dote-pagination .swiper-pagination-bullet-active' => 'opacity: {{SIZE}};',
				],
			]
		);
		$this->add_responsive_control(
			'dote_ascale',
			[
				'label' => esc_html__('Border Scale', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default' => [
					'size' => 1,
				],
				'selectors' => [
					'{{WRAPPER}} .topppa-dote-pagination .swiper-pagination-bullet-active:after' => 'transform: translate(-50%, -50%) scale({{SIZE}});',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name'     => 'active_dote_border',
				'label'    => esc_html__('Border', 'topper-pack'),
				'selector' => '{{WRAPPER}} .topppa-dote-pagination .swiper-pagination-bullet-active:after',
			]
		);
		$this->add_responsive_control(
			'active_dote_border_radius',
			[
				'label'      => esc_html__('Border Radius', 'topper-pack'),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors'  => [
					'{{WRAPPER}} .topppa-dote-pagination .swiper-pagination-bullet-active:after' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'dote_Margin',
			[
				'label'      => esc_html__('Margin', 'topper-pack'),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors'  => [
					'{{WRAPPER}} .topppa-dote-pagination' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'dote_padding',
			[
				'label'      => esc_html__('Padding', 'topper-pack'),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors'  => [
					'{{WRAPPER}} .topppa-dote-pagination' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
	protected function rating_render($value = '') {
		$ratefull = '<i class="fas fa-star"></i>';
		$ratehalf = '<i class="fas fa-star-half-alt"></i>';
		$rateO = '<i class="far fa-star"></i>';
		if ($value > 4.75) {
			return $ratefull . $ratefull . $ratefull . $ratefull . $ratefull;
		} elseif ($value <= 4.75 && $value > 4.25) {
			return $ratefull . $ratefull . $ratefull . $ratefull . $ratehalf;
		} elseif ($value <= 4.25 && $value > 3.75) {
			return $ratefull . $ratefull . $ratefull . $ratefull . $rateO;
		} elseif ($value <= 3.75 && $value > 3.25) {
			return $ratefull . $ratefull . $ratefull . $ratehalf . $rateO;
		} elseif ($value <= 3.25 && $value > 2.75) {
			return $ratefull . $ratefull . $ratefull . $rateO . $rateO;
		} elseif ($value <= 2.75 && $value > 2.25) {
			return $ratefull . $ratefull . $ratehalf . $rateO . $rateO;
		} elseif ($value <= 2.25 && $value > 1.75) {
			return $ratefull . $ratefull . $rateO . $rateO . $rateO;
		} elseif ($value <= 1.75 && $value > 1.25) {
			return $ratefull . $ratehalf . $rateO . $rateO . $rateO;
		} elseif ($value <= 1.25) {
			return $ratefull . $rateO . $rateO . $rateO . $rateO;
		}
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		$SliderId = wp_rand(21241, 53256); // phpcs:ignore WordPress.WP.AlternativeFunctions.rand_rand
		$allowed_html = [
			'a'      => ['href' => []],
			'br'     => [],
			'em'     => [],
			'strong' => [],
		];
		// multiple shadow
		$box_shadow = '';

		if ('yes' === $settings['enable_double_shadow']) {

			$shadow1 = $settings['shadow1'];
			$shadow2 = $settings['shadow2'];

			$css_shadow1 = "{$shadow1['horizontal']}px {$shadow1['vertical']}px {$shadow1['blur']}px {$shadow1['spread']}px {$shadow1['color']}";
			$css_shadow2 = "{$shadow2['horizontal']}px {$shadow2['vertical']}px {$shadow2['blur']}px {$shadow2['spread']}px {$shadow2['color']}";

			$box_shadow = $css_shadow1 . ', ' . $css_shadow2;
		}

		$shape = $settings['elable_shape'] == 'yes' ? 'shape' : '';
		$select_class = $settings['topppa_testimonail_styles'];
		$select_class = [
			'style_one' => 'one',
			'style_two' => 'two',
			'style_three' => 'three',
			'style_four' => 'four',
			'style_five' => 'five',
			'style_six' => 'six',
		];
		$select_style = $settings['topppa_testimonail_styles'];
		$style_classes = [
			'style_one' => '',
			'style_two' => 'testimonial-v2',
			'style_three' => 'testimonial-v3',
			'style_four' => 'testimonial-v4',
			'style_five' => 'testimonial-v5',
			'style_six' => 'testimonial-v6',
		];
		$select_class = isset($select_class[$settings['topppa_testimonail_styles']]) ? $select_class[$settings['topppa_testimonail_styles']] : '';
		$class = isset($style_classes[$settings['topppa_testimonail_styles']]) ? $style_classes[$settings['topppa_testimonail_styles']] : '';
		if ($settings['enable_slider'] == 'yes') {
			$column = 'testmonial-slide-item';
		} else {
			$column = $settings['xl_col'] . ' ' . $settings['lg_col'] . ' ' . $settings['md-col'];
		}
?>

		<div class="testimonial-wrapper  <?php echo esc_attr($select_class); ?>">
			<?php if ($settings["enable_arrow"] == 'yes') : ?>
				<div class="testimonial-v1-arrow">
					<div class="testimonial-prev topppa-brand-logo-button-prev-<?php echo esc_attr($SliderId); ?> button">
						<?php
						if ($settings['style_arrow_type'] === 'text') {
							echo esc_html__('Prev', 'topper-pack');
						} elseif ($settings['style_arrow_type'] === 'arrow_icons') {
							\Elementor\Icons_Manager::render_icon($settings['left_arrow_icon'], ['aria-hidden' => 'true']);
						}
						?>
					</div>
					<div class="testimonial-next button topppa-brand-logo-button-next-<?php echo esc_attr($SliderId); ?> ">
						<?php
						if ($settings['style_arrow_type'] === 'text') {
							echo esc_html__('Next', 'topper-pack');
						} elseif ($settings['style_arrow_type'] === 'arrow_icons') {
							\Elementor\Icons_Manager::render_icon($settings['right_arrow_icon'], ['aria-hidden' => 'true']);
						}
						?>
					</div>
				</div>
			<?php endif; ?>
			<div class="<?php echo esc_attr($settings['enable_slider'] === 'yes' ? 'swiper topppa-swiper-slider topppa-swiper-slider-' . $SliderId : 'no-slide'); ?>"
				<?php if ($settings['enable_slider'] === 'yes') : ?>
				data-slides-per-view="<?php echo esc_attr($settings['slide_show_lagrge_item']); ?>"
				data-space-between="<?php echo esc_attr($settings['slider_space_between']['size']); ?>"
				data-auto-loop="<?php echo esc_attr($settings['enable_slider_auto_loop']); ?>"
				data-slide-speed="<?php echo esc_attr($settings['slide_speed']); ?>"
				data-slider-speed="<?php echo esc_attr($settings['slider_speed']); ?>"
				data-enable-dote="<?php echo esc_attr($settings['enable_dote']); ?>"
				data-enable-arrow="<?php echo esc_attr($settings['enable_arrow']); ?>"
				data-large-items="<?php echo esc_attr($settings['slide_show_lagrge_item']); ?>"
				data-tablet-items="<?php echo esc_attr($settings['slide_show_teblet_item']); ?>"
				data-mobile-items="<?php echo esc_attr($settings['slide_show_mobile_item']); ?>"
				data-extra-mobile-items="<?php echo esc_attr($settings['slide_show_extra_mobile_item']); ?>"
				data-enable-rtl="<?php echo esc_attr($settings['enable_rtl']); ?>"
				<?php endif; ?>>
				<div class="<?php echo esc_attr($settings['enable_slider'] === 'yes' ? 'swiper-wrapper' : 'row'); ?>">
					<?php foreach ($settings['repeater_list'] as $item) :
						$testi_top = $item['select_testimonial_top'] ?? [];
						$default_item = ['select_icon', 'select_logo'];
						$testi_top = (empty($testi_top) || !is_array($testi_top)) ? $default_item : $testi_top;
					?>
						<div class="<?php echo esc_attr($settings['enable_slider'] === 'yes' ? 'swiper-slide' : $column); ?>">
								<div class="testimonial-item-box <?php echo esc_attr($shape . ' ' . $class); ?>"
									style="<?php echo !empty($box_shadow) ? 'box-shadow:' . esc_attr($box_shadow) . ';' : ''; ?>">

									<?php if (in_array($settings['topppa_testimonail_styles'], ['style_one', 'style_two', 'style_three', 'style_five', 'style_six'])) : ?>
										<?php if ($item['elable_testimonial_top'] === 'yes' && (!empty($item['quote_icon']['value']) || !empty($item['logo']['id']) || !empty($item['testimonial_top_label']) || !empty($item['testimonial_rating']['size']))) : ?>
											<div class="testimonial-top-area">
												<?php foreach ($testi_top as $top_item) : ?>
													<?php if ($top_item === 'select_icon') : ?>
														<div class="testimonial-quit">
															<?php \Elementor\Icons_Manager::render_icon($item['quote_icon'], ['aria-hidden' => 'true']); ?>
														</div>
													<?php elseif ($top_item === 'select_logo') : ?>
														<div class="testimonial-logo">
															<?php echo wp_get_attachment_image($item['logo']['id'], 'thumbnail'); ?>
														</div>
													<?php elseif ($top_item === 'select_rating') : ?>
														<div class="testimonial-rating">

															<?php
															// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- Already escaped by elementor
															echo $this->rating_render($item['testimonial_rating']['size']); ?>
															<?php if ($item['enable_decimal'] === 'yes') : ?>
																<span><?php echo esc_html($item['testimonial_rating']['size']); ?></span>
															<?php endif; ?>
														</div>
													<?php elseif ($top_item === 'label' && !empty($item['testimonial_top_label'])) : ?>
														<div class="testimonial-top-label">
															<?php echo esc_html($item['testimonial_top_label']); ?>
														</div>
													<?php endif; ?>
												<?php endforeach; ?>
											</div>
										<?php endif; ?>

										<div class="testimonial-description-area">
											<?php echo wp_kses($item['description'], $allowed_html); ?>
										</div>

										<div class="testimonial-author-info-area">
											<div class="testimonial-author-info">
												<?php if (!empty($item['image']['id'])) : ?>
													<div class="testimonial-img">
														<?php echo wp_get_attachment_image($item['image']['id'], 'thumbnail'); ?>
													</div>
												<?php endif; ?>

												<div class="testimonial-author-content">
													<?php if ($settings['topppa_testimonail_styles'] === 'style_five' && $item['elable_rating'] === 'yes') : ?>
														<div class="testimonial-rating-text">
															<?php echo $this->rating_render($item['testimonial_bottom_rating']['size']); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- Already escaped by elementor 
															?>
														</div>
													<?php endif; ?>
													<div class="testimonial-author-name">
														<?php echo esc_html($item['name']); ?>
													</div>
													<div class="testimonial-author-designation">
														<?php echo esc_html($item['designation']); ?>
														<?php if (in_array($settings['topppa_testimonail_styles'], ['style_one', 'style_two'], true) && $item['elable_rating'] === 'yes') : ?>
															<span class="testimonial-rating-text">
																<i class="fas fa-star"></i>
																<?php echo esc_html($item['testimonial_bottom_rating']['size']); ?>.0 (<?php echo esc_html__('Review', 'topper-pack'); ?>)
															</span>
														<?php endif; ?>
													</div>
												</div>
											</div>
											<?php if (!empty($item['elable_rating']) && $item['elable_rating'] === 'yes') : ?>
												<?php if (in_array($settings['topppa_testimonail_styles'], ['style_six', 'style_three'])) : ?>
													<div class="testimonial-rating-text">
														<?php
														if (!empty($item['testimonial_bottom_rating']['size'])) {
															// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- Already escaped by elementor
															echo $this->rating_render($item['testimonial_bottom_rating']['size']);
														}
														?>
													</div>
												<?php endif; ?>
											<?php endif; ?>
										</div>
									<?php endif; ?>

									<?php if (in_array($settings['topppa_testimonail_styles'], ['style_four'])) : ?>
										<?php if (!empty($item['image']['id'])) : ?>
											<div class="testimonial-img">
												<?php echo wp_get_attachment_image($item['image']['id'], 'thumbnail'); ?>
												<?php if ($item['elable_testimonial_top'] === 'yes') : ?>
													<div class="testimonial-quit">
														<?php foreach ($testi_top as $top_item) : ?>
															<?php if ($top_item === 'select_icon') : ?>
																<?php \Elementor\Icons_Manager::render_icon($item['quote_icon'], ['aria-hidden' => 'true']); ?>
															<?php elseif ($top_item === 'select_logo') : ?>
																<?php echo wp_get_attachment_image($item['logo']['id'], 'thumbnail'); ?>
															<?php elseif ($top_item === 'select_rating') : ?>
																<span><?php echo $this->rating_render($item['testimonial_rating']['size']); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- Already escaped by elementor 
																		?></span>
															<?php endif; ?>
														<?php endforeach; ?>
													</div>
												<?php endif; ?>
											</div>
										<?php endif; ?>
										<div class="testimonial-content">
											<?php if (!empty($item['name'])) : ?>
												<div class="testimonial-author-name">
													<?php echo esc_html($item['name']); ?>
												</div>
											<?php endif; ?>

											<?php if (!empty($item['designation'])) : ?>
												<div class="testimonial-author-designation">
													<?php echo esc_html($item['designation']); ?>
												</div>
											<?php endif; ?>

											<?php if (!empty($settings['topppa_testimonail_styles']) && $settings['topppa_testimonail_styles'] === 'style_four' && !empty($item['elable_rating']) && $item['elable_rating'] === 'yes' && !empty($item['testimonial_bottom_rating']['size'])) : ?>
												<div class="testimonial-rating-text">
													<?php echo $this->rating_render($item['testimonial_bottom_rating']['size']); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- Already escaped by elementor 
													?>
												</div>
											<?php endif; ?>

											<?php if (!empty($settings['topppa_testimonail_styles']) && $settings['topppa_testimonail_styles'] === 'style_four' && !empty($item['description'])) : ?>
												<div class="testimonial-description-area">
													<?php echo wp_kses($item['description'], $allowed_html); ?>
												</div>
											<?php endif; ?>

										</div>
									<?php endif; ?>

								</div>
							</div>
						<?php endforeach; ?>
						</div>
				</div>
				<?php if ($settings['enable_dote'] === 'yes') { ?>
					<div class="testimonial-v1-pagination topppa-dote-pagination topppa-topppa-dote-pagination-<?php echo esc_attr($SliderId); ?> "></div>
				<?php } ?>
			</div>
	<?php
	}
}
