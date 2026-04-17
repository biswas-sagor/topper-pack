<?php

use Elementor\Group_Control_Image_Size;
use Elementor\Controls_Manager;
use Elementor\Widget_Base;
use Elementor\Utils;
use TopperPack\Includes\Controls\Controls_Manager as TopperPack_Controls_Manager;

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}

/**
 * Elementor topppa Image Widget.
 *
 * Elementor widget that inserts an embeddable content into the page, from any given URL.
 *
 * @since 1.0.0
 */
class TOPPPA_Image_Widget extends Widget_Base {

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
		return 'topppa_image_widget';
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
		return TOPPPA_EPWB . esc_html__('Image', 'topper-pack');
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
		return 'eicon-image';
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
		return ['topppa', 'widget', 'image', 'media', 'topperpack'];
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
		return 'https://doc.topperpack.com/docs/general-widgets/image/';
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
		return 'https://topperpack.com/assets/widgets/image-widget/';
	}

	/**
	 * Register Image Widget controls.
	 *
	 * Add input fields to allow the user to customize the widget settings.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function register_controls() {

		$base_url = $this->get_custom_image_url();

		$this->start_controls_section(
			'topppa_styles_img',
			[
				'label' => esc_html__('Styles', 'topper-pack'),
				'tab' => Controls_Manager::TAB_CONTENT,
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
						'title' => esc_html__('style 3', 'topper-pack'),
						'imagelarge' => $base_url . 'topppa-service-3.jpg',
						'imagesmall' => $base_url . 'topppa-service-3.jpg',
						'width' => '100%',
					],
					'style_four' => [
						'title' => esc_html__('style 4', 'topper-pack'),
						'imagelarge' => $base_url . 'topppa-service-4.jpg',
						'imagesmall' => $base_url . 'topppa-service-4.jpg',
						'width' => '100%',
					],
					'style_five' => [
						'title' => esc_html__('style 5', 'topper-pack'),
						'imagelarge' => $base_url . 'topppa-service-5.jpg',
						'imagesmall' => $base_url . 'topppa-service-5.jpg',
						'width' => '100%',
					],
					'style_six' => [
						'title' => esc_html__('style 6', 'topper-pack'),
						'imagelarge' => $base_url . 'topppa-service-6.jpg',
						'imagesmall' => $base_url . 'topppa-service-6.jpg',
						'width' => '100%',
					],
					'style_seven' => [
						'title' => esc_html__('style 7', 'topper-pack'),
						'imagelarge' => $base_url . 'topppa-service-7.jpg',
						'imagesmall' => $base_url . 'topppa-service-7.jpg',
						'width' => '100%',
					],
					'style_eight' => [
						'title' => esc_html__('style 8', 'topper-pack'),
						'imagelarge' => $base_url . 'topppa-service-8.jpg',
						'imagesmall' => $base_url . 'topppa-service-8.jpg',
						'width' => '100%',
					],
				],
			]
		);
		$this->end_controls_section();

		// <==========>
		// <==========> IMAGE CONTENT TAB <==========>

		$this->start_controls_section(
			'topppa_images',
			[
				'label' => esc_html__('Image', 'topper-pack'),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->start_controls_tabs(
			'image_tabs'
		);

		$this->start_controls_tab(
			'image_left_tab',
			[
				'label' => esc_html__('Left', 'topper-pack'),
			]
		);
		$this->add_responsive_control(
			'image_display4',
			[
				'label' => esc_html__('Image Visiblity', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => '',
				'options' => [
					'' => esc_html__('Default', 'topper-pack'),
					'block' => esc_html__('Show', 'topper-pack'),
					'none' => esc_html__('Hide', 'topper-pack'),
				],
				'description' => esc_html('Optimized for responsive design. Use this option to manage any extra spacing around the image.', 'topper-pack'),
				'selectors' => [
					'{{WRAPPER}} .topppa-img-wrapper .left-image' => 'display: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'enable_left_all_image_wrapper',
			[
				'label' => esc_html__('Enable All Image', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Show', 'topper-pack'),
				'label_off' => esc_html__('Hide', 'topper-pack'),
				'return_value' => 'yes',
				'default' => 'yes',
				'condition' => [
					'topppa_styles' => ['style_one', 'style_two', 'style_three', 'style_four', 'style_five', 'style_six', 'style_seven'],
				],
			]
		);
		$this->add_responsive_control(
			'small_image_box_direction',
			[
				'label' => esc_html__('Image Direction', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => '',
				'options' => [
					'' => esc_html__('Default', 'topper-pack'),
					'row' => esc_html__('Row', 'topper-pack'),
					'row-reverse' => esc_html__('Row Reverse', 'topper-pack'),
					'column' => esc_html__('Column', 'topper-pack'),
					'column-reverse' => esc_html__('Column Reverse', 'topper-pack'),
				],
				'selectors' => [
					'{{WRAPPER}} .topppa-img-wrapper .left-image' => 'flex-direction: {{VALUE}};',
				],
				'condition' => [
					'enable_left_all_image_wrapper' => 'yes',
					'topppa_styles' => ['style_one', 'style_two', 'style_three', 'style_four', 'style_five', 'style_six', 'style_seven'],
				],
			]
		);
		$this->add_responsive_control(
			'small_image_gap',
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
					'{{WRAPPER}} .topppa-img-wrapper .left-image' => 'gap: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'enable_left_all_image_wrapper' => 'yes',
					'topppa_styles' => ['style_one', 'style_two', 'style_three', 'style_four', 'style_five', 'style_six', 'style_seven'],
				],
			]
		);
		$this->add_control(
			'image_divider',
			[
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => [
					'enable_left_all_image_wrapper' => 'yes',
					'topppa_styles' => ['style_one', 'style_two', 'style_three', 'style_four', 'style_five', 'style_six', 'style_seven'],
				],
			]
		);
		$this->add_control(
			'enable_image_one',
			[
				'label' => esc_html__('Enable Image', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Show', 'topper-pack'),
				'label_off' => esc_html__('Hide', 'topper-pack'),
				'return_value' => 'yes',
				'default' => 'yes',
				'condition' => [
					'enable_left_all_image_wrapper' => 'yes',
					'topppa_styles' => ['style_one', 'style_two', 'style_three', 'style_four', 'style_five', 'style_six', 'style_seven'],
				],
			]
		);
		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name' => 'topppa_image_thumb_one',
				'default' => 'medium',
				'separator' => 'none',
				'condition' => [
					'enable_image_one' => 'yes',
					'enable_left_all_image_wrapper' => 'yes',
					'topppa_styles' => ['style_one', 'style_two', 'style_three', 'style_four', 'style_five', 'style_six', 'style_seven'],
				],
			]
		);
		$this->add_control(
			'image_one',
			[
				'label' => esc_html__('Choose Image', 'topper-pack'),
				'type' => Controls_Manager::MEDIA,
				'condition' => [
					'enable_image_one' => 'yes',
					'enable_left_all_image_wrapper' => 'yes',
					'topppa_styles' => ['style_one', 'style_two', 'style_three', 'style_four', 'style_five', 'style_six', 'style_seven'],
				],
			]
		);
		$this->add_control(
			'divider',
			[
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => [
					'enable_left_all_image_wrapper' => 'yes',
					'topppa_styles' => ['style_one', 'style_two'],
				],
			]
		);
		$this->add_control(
			'enable_image_two',
			[
				'label' => esc_html__('Enable Image', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Show', 'topper-pack'),
				'label_off' => esc_html__('Hide', 'topper-pack'),
				'return_value' => 'yes',
				'default' => 'yes',
				'condition' => [
					'enable_left_all_image_wrapper' => 'yes',
					'topppa_styles' => ['style_one', 'style_two'],
				],
			]
		);
		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name' => 'topppa_image_thumb_two',
				'default' => 'large',
				'separator' => 'none',
				'condition' => [
					'enable_image_two' => 'yes',
					'enable_left_all_image_wrapper' => 'yes',
					'topppa_styles' => ['style_one', 'style_two'],
				],
			]
		);
		$this->add_control(
			'image_two',
			[
				'label' => esc_html__('Choose Image', 'topper-pack'),
				'type' => Controls_Manager::MEDIA,
				'condition' => [
					'enable_image_two' => 'yes',
					'enable_left_all_image_wrapper' => 'yes',
					'topppa_styles' => ['style_one', 'style_two'],
				],
			]
		);
		$this->end_controls_tab();

		$this->start_controls_tab(
			'image_right_tab',
			[
				'label' => esc_html__('Right', 'topper-pack'),
			]
		);
		$this->add_responsive_control(
			'image_display5',
			[
				'label' => esc_html__('Image Visiblity', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => '',
				'options' => [
					'' => esc_html__('Default', 'topper-pack'),
					'block' => esc_html__('Show', 'topper-pack'),
					'none' => esc_html__('Hide', 'topper-pack'),
				],
				'description' => esc_html('Optimized for responsive design. Use this option to manage any extra spacing around the image.', 'topper-pack'),
				'selectors' => [
					'{{WRAPPER}} .topppa-img-wrapper .right-image' => 'display: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'enable_right_image_wrapper',
			[
				'label' => esc_html__('Enable All Image', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Show', 'topper-pack'),
				'label_off' => esc_html__('Hide', 'topper-pack'),
				'return_value' => 'yes',
				'default' => 'yes',
				'condition' => [
					'topppa_styles' => ['style_one', 'style_two', 'style_three', 'style_four', 'style_five', 'style_six', 'style_seven', 'style_eight'],
				],
			]
		);
		$this->add_responsive_control(
			'large_image_box_direction',
			[
				'label' => esc_html__('Image Direction', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => '',
				'options' => [
					'' => esc_html__('Default', 'topper-pack'),
					'row' => esc_html__('Row', 'topper-pack'),
					'row-reverse' => esc_html__('Row Reverse', 'topper-pack'),
					'column' => esc_html__('Column', 'topper-pack'),
					'column-reverse' => esc_html__('Column Reverse', 'topper-pack'),
				],
				'selectors' => [
					'{{WRAPPER}} .topppa-img-wrapper .right-image' => 'flex-direction: {{VALUE}};',
				],
				'condition' => [
					'enable_right_image_wrapper' => 'yes',
					'topppa_styles' => ['style_one', 'style_two', 'style_three', 'style_four', 'style_five', 'style_six', 'style_seven', 'style_eight'],
				],
			]
		);
		$this->add_responsive_control(
			'large_image_gap',
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
					'{{WRAPPER}} .topppa-img-wrapper .right-image' => 'gap: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'enable_right_image_wrapper' => 'yes',
					'topppa_styles' => ['style_one', 'style_two', 'style_three', 'style_four', 'style_five', 'style_six', 'style_seven', 'style_eight'],
				],
			]
		);
		$this->add_control(
			'right_img_divider',
			[
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'after',
				'condition' => [
					'enable_right_image_wrapper' => 'yes',
					'topppa_styles' => ['style_one', 'style_two', 'style_three', 'style_four', 'style_five', 'style_six', 'style_seven', 'style_eight'],
				],
			]
		);

		$this->add_control(
			'enable_image_three',
			[
				'label' => esc_html__('Enable Image', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Show', 'topper-pack'),
				'label_off' => esc_html__('Hide', 'topper-pack'),
				'return_value' => 'yes',
				'default' => 'yes',
				'condition' => [
					'enable_right_image_wrapper' => 'yes',
					'topppa_styles' => ['style_one', 'style_two', 'style_three', 'style_four', 'style_five', 'style_six', 'style_seven', 'style_eight'],
				],
			]
		);
		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name' => 'topppa_image_thumb_three',
				'default' => 'full',
				'separator' => 'none',
				'condition' => [
					'enable_right_image_wrapper' => 'yes',
					'enable_image_three' => 'yes',
					'topppa_styles' => ['style_one', 'style_two', 'style_three', 'style_four', 'style_five', 'style_six', 'style_seven', 'style_eight'],
				],
			]
		);
		$this->add_control(
			'image_three',
			[
				'label' => esc_html__('Choose Image', 'topper-pack'),
				'type' => Controls_Manager::MEDIA,
				'condition' => [
					'enable_right_image_wrapper' => 'yes',
					'enable_image_three' => 'yes',
					'topppa_styles' => ['style_one', 'style_two', 'style_three', 'style_four', 'style_five', 'style_six', 'style_seven', 'style_eight'],
				],
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();

		$this->start_controls_section(
			'image_counter',
			[
				'label' => esc_html__('Counter', 'topper-pack'),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
				'condition' => [
					'topppa_styles' => ['style_three', 'style_four', 'style_seven', 'style_eight'],
				],
			]
		);
		$this->add_control(
			'enable_counter',
			[
				'label' => esc_html__('Enable Counter', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Show', 'topper-pack'),
				'label_off' => esc_html__('Hide', 'topper-pack'),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);
		$this->add_control(
			'enable_counter_icon',
			[
				'label' => esc_html__('Enable Icon', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Show', 'topper-pack'),
				'label_off' => esc_html__('Hide', 'topper-pack'),
				'return_value' => 'yes',
				'default' => 'yes',
				'condition' => [
					'enable_counter' => 'yes',
				],
			]
		);
		$this->add_control(
			'icon',
			[
				'label' => esc_html__('Icon', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::ICONS,
				'default' => [
					'value' => 'fas fa-award',
					'library' => 'fa-solid',
				],
				'condition' => [
					'enable_counter' => 'yes',
					'enable_counter_icon' => 'yes',
				],
			]
		);
		$this->add_control(
			'topppa_counter_number',
			[
				'label' => esc_html__('Number', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'min' => 1,
				'max' => 10000000,
				'step' => 1,
				'default' => 15,
				'condition' => [
					'enable_counter' => 'yes',
				],
			]
		);
		$this->add_control(
			'topppa_counter_symble',
			[
				'label' => esc_html__('Symble', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__('K', 'topper-pack'),
				'condition' => [
					'enable_counter' => 'yes',
				],
			]
		);
		$this->add_control(
			'topppa_counter_speed',
			[
				'label' => esc_html__('Counter Speed', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'min' => 500,
				'max' => 15000,
				'step' => 100,
				'default' => 1000,
				'condition' => [
					'enable_counter' => 'yes',
				],
			]
		);
		$this->add_control(
			'topppa_counter_text',
			[
				'label' => esc_html__('Text', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__('Years Of Experience', 'topper-pack'),
				'condition' => [
					'enable_counter' => 'yes',
				],
			]
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'image_shapes',
			[
				'label' => esc_html__('Shapes', 'topper-pack'),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
				'condition' => [
					'topppa_styles' => ['style_six', 'style_eight'],
				],
			]
		);
		$this->add_control(
			'enable_shapes',
			[
				'label' => esc_html__('Enable Shapes', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Show', 'topper-pack'),
				'label_off' => esc_html__('Hide', 'topper-pack'),
				'return_value' => 'yes',
				'default' => 'yes',
				'condition' => [
					'topppa_styles' => ['style_six'],
				],
			]
		);
		$this->add_control(
			'enable_image_shape',
			[
				'label' => esc_html__('Enable Shape One', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Show', 'topper-pack'),
				'label_off' => esc_html__('Hide', 'topper-pack'),
				'return_value' => 'yes',
				'default' => 'yes',
				'condition' => [
					'enable_shapes' => 'yes',
					'topppa_styles' => ['style_six'],
				]
			]
		);
		$this->add_control(
			'image_shape_one',
			[
				'label' => esc_html__('Shape One', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'condition' => [
					'enable_shapes' => 'yes',
					'enable_image_shape' => 'yes',
					'topppa_styles' => ['style_six'],
				]
			]
		);
		$this->add_control(
			'enable_image_shape_two',
			[
				'label' => esc_html__('Enable Shape Two', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Show', 'topper-pack'),
				'label_off' => esc_html__('Hide', 'topper-pack'),
				'return_value' => 'yes',
				'default' => 'yes',
				'condition' => [
					'enable_shapes' => 'yes',
				]
			]
		);
		$this->add_control(
			'image_shape_two',
			[
				'label' => esc_html__('Shape Two', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'condition' => [
					'enable_shapes' => 'yes',
					'enable_image_shape_two' => 'yes'
				]
			]
		);
		$this->end_controls_section();

		// <==========>
		// <==========> BOX STYLES <==========>

		$this->start_controls_section(
			'image_box_styles',
			[
				'label' => esc_html__('Box', 'topper-pack'),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_responsive_control(
			'image_box_direction',
			[
				'label' => esc_html__('Direction', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => '',
				'options' => [
					'' => esc_html__('Default', 'topper-pack'),
					'row' => esc_html__('Row', 'topper-pack'),
					'row-reverse' => esc_html__('Row Reverse', 'topper-pack'),
					'column' => esc_html__('Column', 'topper-pack'),
					'column-reverse' => esc_html__('Column Reverse', 'topper-pack'),
				],
				'selectors' => [
					'{{WRAPPER}} .topppa-img-wrapper' => 'flex-direction: {{VALUE}};',
				],
			]
		);
		$this->add_responsive_control(
			'image_box_align',
			[
				'label' => esc_html__('Alignment', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => esc_html__('Left', 'topper-pack'),
						'icon' => 'eicon-align-start-h',
					],
					'center' => [
						'title' => esc_html__('Center', 'topper-pack'),
						'icon' => 'eicon-align-center-h',
					],
					'right' => [
						'title' => esc_html__('Right', 'topper-pack'),
						'icon' => 'eicon-align-end-h',
					],
				],
				'toggle' => true,
				'selectors' => [
					'{{WRAPPER}} .topppa-img-wrapper' => 'align-items: {{VALUE}};',
				],
			]
		);
		$this->add_responsive_control(
			'image_box_gap',
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
					'{{WRAPPER}} .topppa-img-wrapper' => 'gap: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'image_box_bg',
				'label' => esc_html__('Background', 'topper-pack'),
				'types' => ['classic', 'gradient', 'video'],
				'selector' => '{{WRAPPER}} .topppa-img-wrapper',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'image_box_border',
				'label' => esc_html__('Border', 'topper-pack'),
				'selector' => '{{WRAPPER}} .topppa-img-wrapper',
			]
		);
		$this->add_responsive_control(
			'image_box_radius',
			[
				'label' => esc_html__('Border Radius', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .topppa-img-wrapper' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'image_box_shadow',
				'label' => esc_html__('Box Shadow', 'topper-pack'),
				'selector' => '{{WRAPPER}} .topppa-img-wrapper',
			]
		);
		$this->add_responsive_control(
			'image_box_margin',
			[
				'label' => esc_html__('Margin', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .topppa-img-wrapper' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'image_box_padding',
			[
				'label' => esc_html__('Padding', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .topppa-img-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();

		// <==========>
		// <==========> IMAGE STYLES <==========>

		$this->start_controls_section(
			'left_img_style',
			[
				'label' => esc_html__('Image', 'topper-pack'),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
				'condition' => [
					'enable_image_one' => 'yes',
					'enable_left_all_image_wrapper' => 'yes',
					'topppa_styles' => ['style_one', 'style_two', 'style_three', 'style_four', 'style_five', 'style_six', 'style_seven'],
				],
			]
		);
		$this->add_control(
			'image_z_index',
			[
				'label' => esc_html__('Z Index', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'min' => -50,
				'max' => 10000000,
				'step' => 1,
				'selectors' => [
					'{{WRAPPER}} .topppa-img-wrapper .left-image' => 'z-index: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'image_display',
			[
				'label' => esc_html__('Image Visiblity', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'block',
				'options' => [
					'block' => esc_html__('Show', 'topper-pack'),
					'none' => esc_html__('Hide', 'topper-pack'),
				],
				'selectors' => [
					'{{WRAPPER}} .left-image .img-1' => 'display: {{VALUE}};',
				],
			]
		);
		$this->add_responsive_control(
			'left_img_height',
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
					'{{WRAPPER}} .left-image .img-1 img' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'left_img_width',
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
					'{{WRAPPER}} .left-image .img-1 img' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'left_img_min_width',
			[
				'label'      => esc_html__('Min Width', 'topper-pack'),
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
					'{{WRAPPER}} .left-image .img-1 img' => 'min-width: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'left_img_positions_controls',
			[
				'label' => esc_html__('Position Controls', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_responsive_control(
			'left_img_positions',
			[
				'label' => esc_html__('Position', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => '',
				'options' => [
					'' => esc_html__('Select Position', 'topper-pack'),
					'unset' => esc_html__('None', 'topper-pack'),
					'relative' => esc_html__('Relative', 'topper-pack'),
					'absolute'  => esc_html__('Absolute', 'topper-pack'),
				],
				'selectors' => [
					'{{WRAPPER}} .topppa-img-wrapper .left-image' => 'position: {{VALUE}};',
				],
			]
		);
		$this->add_responsive_control(
			'left_img_position_left_right',
			[
				'label' => esc_html__('Left To Right', 'topper-pack'),
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
					'{{WRAPPER}} .topppa-img-wrapper .left-image' => 'left: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'left_img_positions' => ['relative', 'absolute'],
				],
			]
		);
		$this->add_responsive_control(
			'left_img_position_right_left',
			[
				'label' => esc_html__('Right To Left', 'topper-pack'),
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
					'{{WRAPPER}} .topppa-img-wrapper .left-image' => 'right: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'left_img_positions' => ['relative', 'absolute'],
				],
			]
		);
		$this->add_responsive_control(
			'left_img_position_top_bottom',
			[
				'label' => esc_html__('Top To Bottom', 'topper-pack'),
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
					'{{WRAPPER}} .topppa-img-wrapper .left-image' => 'top: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'left_img_positions' => ['relative', 'absolute'],
				],
			]
		);

		$this->add_responsive_control(
			'left_img_position_bottom_top',
			[
				'label' => esc_html__('Bottom To Top', 'topper-pack'),
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
					'{{WRAPPER}} .topppa-img-wrapper .left-image' => 'bottom: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'left_img_positions' => ['relative', 'absolute'],
				],
			]
		);
		$this->add_responsive_control(
			'left_img_z_index',
			[
				'label' => esc_html__('Z Index', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => -100,
						'max' => 1000,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .topppa-img-wrapper .left-image' => 'z-index: {{SIZE}};',
				],
				'condition' => [
					'left_img_positions' => ['relative', 'absolute'],
				],
			]
		);
		$this->add_control(
			'pos_divider4',
			[
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_responsive_control(
			'left_img_object',
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
					'{{WRAPPER}} .left-image .img-1 img' => 'object-fit: {{VALUE}}',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name'     => 'left_img_border',
				'label'    => esc_html__('Border', 'topper-pack'),
				'selector' => '{{WRAPPER}} .left-image .img-1 img',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name'     => 'left_img_border2',
				'label'    => esc_html__('Border Radius 2', 'topper-pack'),
				'selector' => '{{WRAPPER}} .left-image .img-1',
			]
		);
		$this->add_responsive_control(
			'left_img_border_radius',
			[
				'label'      => esc_html__('Border Radius', 'topper-pack'),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors'  => [
					'{{WRAPPER}} .left-image .img-1 img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'left_img_shadow',
				'selector' => '{{WRAPPER}} .left-image .img-1',
			]
		);
		$this->add_responsive_control(
			'left_img_margin',
			[
				'label'      => esc_html__('Margin', 'topper-pack'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors'  => [
					'{{WRAPPER}} .left-image .img-1' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'left_img_padding',
			[
				'label'      => esc_html__('Padding', 'topper-pack'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors'  => [
					'{{WRAPPER}} .left-image .img-1' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();

		// <==========>
		// <==========> LEFT IMAGE 2 STYLES <==========>

		$this->start_controls_section(
			'left_img_v2_style',
			[
				'label' => esc_html__('Image Two', 'topper-pack'),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
				'condition' => [
					'enable_image_two' => 'yes',
					'enable_left_all_image_wrapper' => 'yes',
					'topppa_styles' => ['style_one', 'style_two'],
				],
			]
		);
		$this->add_control(
			'image_z_index2',
			[
				'label' => esc_html__('Z Index', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'min' => -50,
				'max' => 10000000,
				'step' => 1,
				'selectors' => [
					'{{WRAPPER}} .left-image .img-2' => 'z-index: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'image_display2',
			[
				'label' => esc_html__('Image Visiblity', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'block',
				'options' => [
					'block' => esc_html__('Show', 'topper-pack'),
					'none' => esc_html__('Hide', 'topper-pack'),
				],
				'selectors' => [
					'{{WRAPPER}} .left-image .img-2' => 'display: {{VALUE}};',
				],
			]
		);
		$this->add_responsive_control(
			'left_img_v2_height',
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
					'{{WRAPPER}} .left-image .img-2 img' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'left_img_v2_width',
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
					'{{WRAPPER}} .left-image .img-2 img' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'left_img2_min_width',
			[
				'label'      => esc_html__('Min Width', 'topper-pack'),
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
					'{{WRAPPER}} .left-image .img-2 img' => 'min-width: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'left_img_v2_positions_controls',
			[
				'label' => esc_html__('Position Controls', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_responsive_control(
			'left_img_v2_positions',
			[
				'label' => esc_html__('Position', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => '',
				'options' => [
					'' => esc_html__('Select Position', 'topper-pack'),
					'unset' => esc_html__('None', 'topper-pack'),
					'relative' => esc_html__('Relative', 'topper-pack'),
					'absolute'  => esc_html__('Absolute', 'topper-pack'),
				],
				'selectors' => [
					'{{WRAPPER}} .left-image' => 'position: {{VALUE}};',
				],
			]
		);
		$this->add_responsive_control(
			'left_img_v2_position_left_right',
			[
				'label' => esc_html__('Left To Right', 'topper-pack'),
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
					'{{WRAPPER}} .left-image' => 'left: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'left_img_v2_positions' => ['relative', 'absolute'],
				],
			]
		);
		$this->add_responsive_control(
			'left_img_v2_position_right_left',
			[
				'label' => esc_html__('Right To Left', 'topper-pack'),
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
					'{{WRAPPER}} .left-image' => 'right: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'left_img_v2_positions' => ['relative', 'absolute'],
				],
			]
		);
		$this->add_responsive_control(
			'left_img_v2_position_top_bottom',
			[
				'label' => esc_html__('Top To Bottom', 'topper-pack'),
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
					'{{WRAPPER}} .left-image' => 'top: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'left_img_v2_positions' => ['relative', 'absolute'],
				],
			]
		);

		$this->add_responsive_control(
			'left_img_v2_position_bottom_top',
			[
				'label' => esc_html__('Bottom To Top', 'topper-pack'),
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
					'{{WRAPPER}} .left-image' => 'bottom: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'left_img_v2_positions' => ['relative', 'absolute'],
				],
			]
		);
		$this->add_responsive_control(
			'left_img_v2_z_index',
			[
				'label' => esc_html__('Z Index', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => -100,
						'max' => 1000,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .left-image' => 'z-index: {{SIZE}};',
				],
				'condition' => [
					'left_img_v2_positions' => ['relative', 'absolute'],
				],
			]
		);
		$this->add_control(
			'pos_divider3',
			[
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_responsive_control(
			'left_img_v2_object',
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
					'{{WRAPPER}} .left-image .img-2 img' => 'object-fit: {{VALUE}}',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name'     => 'left_img_v2_border',
				'label'    => esc_html__('Border', 'topper-pack'),
				'selector' => '{{WRAPPER}} .left-image .img-2 img',
			]
		);
		$this->add_responsive_control(
			'left_img_v2_border_radius',
			[
				'label'      => esc_html__('Border Radius', 'topper-pack'),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors'  => [
					'{{WRAPPER}} .left-image .img-2 img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'left_img_v2_shadow',
				'selector' => '{{WRAPPER}} .left-image .img-2',
			]
		);
		$this->add_responsive_control(
			'left_img_v2_margin',
			[
				'label'      => esc_html__('Margin', 'topper-pack'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors'  => [
					'{{WRAPPER}} .left-image .img-2' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'left_img_v2_padding',
			[
				'label'      => esc_html__('Padding', 'topper-pack'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors'  => [
					'{{WRAPPER}} .left-image .img-2' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();

		// <==========>
		// <==========> IMAGE STYLES <==========>

		$this->start_controls_section(
			'img_three_style',
			[
				'label' => esc_html__('Image Three', 'topper-pack'),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
				'condition' => [
					'enable_right_image_wrapper' => 'yes',
					'enable_image_three' => 'yes',
					'topppa_styles' => ['style_one', 'style_two', 'style_three', 'style_four', 'style_five', 'style_six', 'style_seven', 'style_eight'],
				],
			]
		);
		$this->add_control(
			'image_z_index3',
			[
				'label' => esc_html__('Z Index', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'min' => -50,
				'max' => 10000000,
				'step' => 1,
				'selectors' => [
					'{{WRAPPER}} .topppa-img-wrapper .right-image' => 'z-index: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'image_display3',
			[
				'label' => esc_html__('Image Visiblity', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'block',
				'options' => [
					'block' => esc_html__('Show', 'topper-pack'),
					'none' => esc_html__('Hide', 'topper-pack'),
				],
				'selectors' => [
					'{{WRAPPER}} .topppa-img-wrapper .img-3' => 'display: {{VALUE}};',
				],
			]
		);
		$this->add_responsive_control(
			'img_three_height',
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
					'{{WRAPPER}} .topppa-img-wrapper .img-3 img' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'img_three_width',
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
					'{{WRAPPER}} .topppa-img-wrapper .img-3 img' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'img_three_min_width',
			[
				'label'      => esc_html__('Min Width', 'topper-pack'),
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
					'{{WRAPPER}} .topppa-img-wrapper .img-3 img' => 'min-width: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'img_three_rotate',
			[
				'label' => esc_html__('Rotation Angle', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['deg'], // Ensure only "deg" is allowed
				'range' => [
					'deg' => [
						'min' => -360,
						'max' => 360,
						'step' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .topppa-img-wrapper .img-3' => 'transform: rotate({{SIZE}}deg);',
				],
			]
		);

		$this->add_control(
			'img_three_v2_positions_controls',
			[
				'label' => esc_html__('Position Controls', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_responsive_control(
			'img_three_v2_positions',
			[
				'label' => esc_html__('Position', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => '',
				'options' => [
					'' => esc_html__('Select Position', 'topper-pack'),
					'unset' => esc_html__('None', 'topper-pack'),
					'relative' => esc_html__('Relative', 'topper-pack'),
					'absolute'  => esc_html__('Absolute', 'topper-pack'),
				],
				'selectors' => [
					'{{WRAPPER}} .topppa-img-wrapper .right-image' => 'position: {{VALUE}};',
				],
			]
		);
		$this->add_responsive_control(
			'img_three_v2_position_left_right',
			[
				'label' => esc_html__('Left To Right', 'topper-pack'),
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
					'{{WRAPPER}} .topppa-img-wrapper .right-image' => 'left: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'img_three_v2_positions' => ['relative', 'absolute'],
				],
			]
		);
		$this->add_responsive_control(
			'img_three_v2_position_right_left',
			[
				'label' => esc_html__('Right To Left', 'topper-pack'),
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
					'{{WRAPPER}} .topppa-img-wrapper .right-image' => 'right: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'img_three_v2_positions' => ['relative', 'absolute'],
				],
			]
		);
		$this->add_responsive_control(
			'img_three_v2_position_top_bottom',
			[
				'label' => esc_html__('Top To Bottom', 'topper-pack'),
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
					'{{WRAPPER}} .topppa-img-wrapper .right-image' => 'top: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'img_three_v2_positions' => ['relative', 'absolute'],
				],
			]
		);

		$this->add_responsive_control(
			'img_three_v2_position_bottom_top',
			[
				'label' => esc_html__('Bottom To Top', 'topper-pack'),
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
					'{{WRAPPER}} .topppa-img-wrapper .right-image' => 'bottom: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'img_three_v2_positions' => ['relative', 'absolute'],
				],
			]
		);
		$this->add_responsive_control(
			'img_three_v2_z_index',
			[
				'label' => esc_html__('Z Index', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => -100,
						'max' => 1000,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .topppa-img-wrapper .right-image' => 'z-index: {{SIZE}};',
				],
				'condition' => [
					'img_three_v2_positions' => ['relative', 'absolute'],
				],
			]
		);
		$this->add_control(
			'pos_divider2',
			[
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_responsive_control(
			'img_three_object',
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
					'{{WRAPPER}} .topppa-img-wrapper .img-3 img' => 'object-fit: {{VALUE}}',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name'     => 'img_three_border',
				'label'    => esc_html__('Border', 'topper-pack'),
				'selector' => '{{WRAPPER}} .topppa-img-wrapper .img-3 img',
			]
		);
		$this->add_responsive_control(
			'img_three_border_radius',
			[
				'label'      => esc_html__('Border Radius', 'topper-pack'),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors'  => [
					'{{WRAPPER}} .topppa-img-wrapper .img-3 img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'img_three_shadow',
				'selector' => '{{WRAPPER}} .topppa-img-wrapper .img-3 img',
			]
		);
		$this->add_responsive_control(
			'img_three_margin',
			[
				'label'      => esc_html__('Margin', 'topper-pack'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors'  => [
					'{{WRAPPER}} .topppa-img-wrapper .img-3 img' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'img_three_padding',
			[
				'label'      => esc_html__('Padding', 'topper-pack'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors'  => [
					'{{WRAPPER}} .topppa-img-wrapper .img-3 img' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();

		// <==========>
		// <==========> COUNTER STYLES <==========>
		$this->start_controls_section(
			'image_counter_styles',
			[
				'label' => esc_html__('Counter', 'topper-pack'),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
				'condition' => [
					'enable_counter' => 'yes',
					'topppa_styles' => ['style_three', 'style_four', 'style_seven', 'style_eight'],
				]
			]
		);
		$this->add_responsive_control(
			'counter_display2',
			[
				'label' => esc_html__('Counter Visiblity', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'block',
				'options' => [
					'block' => esc_html__('Show', 'topper-pack'),
					'none' => esc_html__('Hide', 'topper-pack'),
				],
				'selectors' => [
					'{{WRAPPER}} .topppa-img-wrapper .topppa-image-counter' => 'display: {{VALUE}};',
				],
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
						'icon' => 'eicon-align-start-h',
					],
					'center' => [
						'title' => esc_html__('Center', 'topper-pack'),
						'icon' => 'eicon-align-center-h',
					],
					'right' => [
						'title' => esc_html__('Right', 'topper-pack'),
						'icon' => 'eicon-align-end-h',
					],
				],
				'toggle' => true,
				'selectors' => [
					'{{WRAPPER}} .topppa-img-wrapper .topppa-image-counter' => 'text-align: {{VALUE}};',
				],
				'condition' => [
					'counter_display2' => 'block'
				]
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'box_bg',
				'label' => esc_html__('Background', 'topper-pack'),
				'types' => ['classic', 'gradient', 'video'],
				'selector' => '{{WRAPPER}} .topppa-img-wrapper .topppa-image-counter',
				'condition' => [
					'counter_display2' => 'block'
				]
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'box_border',
				'label' => esc_html__('Border', 'topper-pack'),
				'selector' => '{{WRAPPER}} .topppa-img-wrapper .topppa-image-counter',
				'condition' => [
					'counter_display2' => 'block'
				]
			]
		);
		$this->add_responsive_control(
			'box_radius',
			[
				'label' => esc_html__('Border Radius', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .topppa-img-wrapper .topppa-image-counter' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'counter_display2' => 'block'
				]
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'box_shadow',
				'label' => esc_html__('Box Shadow', 'topper-pack'),
				'selector' => '{{WRAPPER}} .topppa-img-wrapper .topppa-image-counter',
				'condition' => [
					'counter_display2' => 'block'
				]
			]
		);
		$this->add_responsive_control(
			'box_margin',
			[
				'label' => esc_html__('Margin', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .topppa-img-wrapper .topppa-image-counter' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'counter_display2' => 'block'
				]
			]
		);
		$this->add_responsive_control(
			'box_padding',
			[
				'label' => esc_html__('Padding', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .topppa-img-wrapper .topppa-image-counter' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'counter_display2' => 'block'
				]
			]
		);

		$this->add_control(
			'count_v2_positions_controls',
			[
				'label' => esc_html__('Position Controls', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => [
					'counter_display2' => 'block'
				]
			]
		);
		$this->add_responsive_control(
			'count_v2_positions',
			[
				'label' => esc_html__('Position', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => '',
				'options' => [
					'' => esc_html__('Select Position', 'topper-pack'),
					'unset' => esc_html__('None', 'topper-pack'),
					'relative' => esc_html__('Relative', 'topper-pack'),
					'absolute'  => esc_html__('Absolute', 'topper-pack'),
				],
				'selectors' => [
					'{{WRAPPER}} .topppa-img-wrapper .topppa-image-counter' => 'position: {{VALUE}};',
				],
				'condition' => [
					'counter_display2' => 'block'
				]
			]
		);
		$this->add_responsive_control(
			'count_v2_position_left_right',
			[
				'label' => esc_html__('Left To Right', 'topper-pack'),
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
					'{{WRAPPER}} .topppa-img-wrapper .topppa-image-counter' => 'left: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'count_v2_positions' => ['relative', 'absolute'],
					'counter_display2' => 'block'
				],
			]
		);
		$this->add_responsive_control(
			'count_v2_position_right_left',
			[
				'label' => esc_html__('Right To Left', 'topper-pack'),
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
					'{{WRAPPER}} .topppa-img-wrapper .topppa-image-counter' => 'right: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'count_v2_positions' => ['relative', 'absolute'],
					'counter_display2' => 'block'
				],
			]
		);
		$this->add_responsive_control(
			'count_v2_position_top_bottom',
			[
				'label' => esc_html__('Top To Bottom', 'topper-pack'),
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
					'{{WRAPPER}} .topppa-img-wrapper .topppa-image-counter' => 'top: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'count_v2_positions' => ['relative', 'absolute'],
					'counter_display2' => 'block'
				],
			]
		);
		$this->add_responsive_control(
			'count_v2_position_bottom_top',
			[
				'label' => esc_html__('Bottom To Top', 'topper-pack'),
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
					'{{WRAPPER}} .topppa-img-wrapper .topppa-image-counter' => 'bottom: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'count_v2_positions' => ['relative', 'absolute'],
					'counter_display2' => 'block'
				],
			]
		);
		$this->add_responsive_control(
			'count_v2_z_index',
			[
				'label' => esc_html__('Z Index', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => -100,
						'max' => 1000,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .topppa-img-wrapper .topppa-image-counter' => 'z-index: {{SIZE}};',
				],
				'condition' => [
					'count_v2_positions' => ['relative', 'absolute'],
					'counter_display2' => 'block'
				],
			]
		);

		$this->start_controls_tabs(
			'counter_content_style_tabs'
		);
		$this->start_controls_tab(
			'title_style_tab',
			[
				'label' => esc_html__('Title', 'topper-pack'),
				'condition' => [
					'counter_display2' => 'block'
				]
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'title_typo',
				'selector' => '{{WRAPPER}} .topppa-img-wrapper .counter-number',
				'condition' => [
					'counter_display2' => 'block'
				]
			]
		);
		$this->add_responsive_control(
			'title_color',
			[
				'label'     => esc_html__('Color', 'topper-pack'),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .topppa-img-wrapper .counter-number' => 'color: {{VALUE}}',
				],
				'condition' => [
					'counter_display2' => 'block'
				]
			]
		);
		$this->add_responsive_control(
			'title_margin',
			[
				'label'      => esc_html__('Margin', 'topper-pack'),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors'  => [
					'{{WRAPPER}} .topppa-img-wrapper .counter-number' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'counter_display2' => 'block'
				]
			]
		);
		$this->add_responsive_control(
			'title_padding',
			[
				'label'      => esc_html__('Padding', 'topper-pack'),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors'  => [
					'{{WRAPPER}} .topppa-img-wrapper .counter-number' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'counter_display2' => 'block'
				]
			]
		);
		$this->end_controls_tab();

		$this->start_controls_tab(
			'style_desc_tab',
			[
				'label' => esc_html__('Description', 'topper-pack'),
				'condition' => [
					'counter_display2' => 'block'
				]
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'desc_typo',
				'selector' => '{{WRAPPER}} .topppa-img-wrapper .topppa-image-counter .count-text',
				'condition' => [
					'counter_display2' => 'block'
				]
			]
		);
		$this->add_responsive_control(
			'desc_color',
			[
				'label'     => esc_html__('Color', 'topper-pack'),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .topppa-img-wrapper .topppa-image-counter .count-text' => 'color: {{VALUE}}',
				],
				'condition' => [
					'counter_display2' => 'block'
				]
			]
		);
		$this->add_responsive_control(
			'desc_margin',
			[
				'label'      => esc_html__('Margin', 'topper-pack'),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors'  => [
					'{{WRAPPER}} .topppa-img-wrapper .topppa-image-counter .count-text' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'counter_display2' => 'block'
				]
			]
		);
		$this->add_responsive_control(
			'desc_padding',
			[
				'label'      => esc_html__('Padding', 'topper-pack'),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors'  => [
					'{{WRAPPER}} .topppa-img-wrapper .topppa-image-counter .count-text' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'counter_display2' => 'block'
				]
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();

		$this->start_controls_section(
			'image_shapes_styles',
			[
				'label' => esc_html__('Shapes', 'topper-pack'),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
				'condition' => [
					'enable_shapes' => 'yes',
					'topppa_styles' => ['style_six', 'style_eight'],
				]
			]
		);
		$this->start_controls_tabs(
			'shapes_style_tabs'
		);

		$this->start_controls_tab(
			'style_shape_one_tab',
			[
				'label' => esc_html__('Shape', 'topper-pack'),
				'condition' => [
					'enable_image_shape' => 'yes',
					'topppa_styles' => 'style_six',
				]
			]
		);
		$this->add_control(
			'image_shape_positions_controls',
			[
				'label' => esc_html__('Position Controls', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::HEADING,
			]
		);
		$this->add_responsive_control(
			'image_shape_positions',
			[
				'label' => esc_html__('Position', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => '',
				'options' => [
					'' => esc_html__('Select Position', 'topper-pack'),
					'unset' => esc_html__('None', 'topper-pack'),
					'relative' => esc_html__('Relative', 'topper-pack'),
					'absolute'  => esc_html__('Absolute', 'topper-pack'),
				],
				'selectors' => [
					'{{WRAPPER}} .topppa-img-wrapper .image-shape' => 'position: {{VALUE}};',
				],
			]
		);
		$this->add_responsive_control(
			'image_shape_position_left_right',
			[
				'label' => esc_html__('Left To Right', 'topper-pack'),
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
					'{{WRAPPER}} .topppa-img-wrapper .image-shape' => 'left: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'image_shape_positions' => ['relative', 'absolute'],
				],
			]
		);
		$this->add_responsive_control(
			'image_shape_position_right_left',
			[
				'label' => esc_html__('Right To Left', 'topper-pack'),
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
					'{{WRAPPER}} .topppa-img-wrapper .image-shape' => 'right: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'image_shape_positions' => ['relative', 'absolute'],
				],
			]
		);
		$this->add_responsive_control(
			'image_shape_position_top_bottom',
			[
				'label' => esc_html__('Top To Bottom', 'topper-pack'),
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
					'{{WRAPPER}} .topppa-img-wrapper .image-shape' => 'top: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'image_shape_positions' => ['relative', 'absolute'],
				],
			]
		);
		$this->add_responsive_control(
			'image_shape_position_bottom_top',
			[
				'label' => esc_html__('Bottom To Top', 'topper-pack'),
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
					'{{WRAPPER}} .topppa-img-wrapper .image-shape' => 'bottom: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'image_shape_positions' => ['relative', 'absolute'],
				],
			]
		);
		$this->add_responsive_control(
			'image_shape_z_index',
			[
				'label' => esc_html__('Z Index', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => -100,
						'max' => 1000,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .topppa-img-wrapper .image-shape' => 'z-index: {{SIZE}};',
				],
				'condition' => [
					'image_shape_positions' => ['relative', 'absolute'],
				],
			]
		);
		$this->end_controls_tab();

		$this->start_controls_tab(
			'image_shape_two_style',
			[
				'label' => esc_html__('Shape Two', 'topper-pack'),
				'condition' => [
					'enable_image_shape_two' => 'yes'
				]
			]
		);
		$this->add_control(
			'image_shape_two_positions_controls',
			[
				'label' => esc_html__('Position Controls', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::HEADING,
			]
		);
		$this->add_responsive_control(
			'image_shape_two_positions',
			[
				'label' => esc_html__('Position', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => '',
				'options' => [
					'' => esc_html__('Select Position', 'topper-pack'),
					'unset' => esc_html__('None', 'topper-pack'),
					'relative' => esc_html__('Relative', 'topper-pack'),
					'absolute'  => esc_html__('Absolute', 'topper-pack'),
				],
				'selectors' => [
					'{{WRAPPER}} .topppa-img-wrapper .image-shape-two' => 'position: {{VALUE}};',
				],
			]
		);
		$this->add_responsive_control(
			'image_shape_two_position_left_right',
			[
				'label' => esc_html__('Left To Right', 'topper-pack'),
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
					'{{WRAPPER}} .topppa-img-wrapper .image-shape-two' => 'left: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'image_shape_two_positions' => ['relative', 'absolute'],
				],
			]
		);
		$this->add_responsive_control(
			'image_shape_two_position_right_left',
			[
				'label' => esc_html__('Right To Left', 'topper-pack'),
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
					'{{WRAPPER}} .topppa-img-wrapper .image-shape-two' => 'right: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'image_shape_two_positions' => ['relative', 'absolute'],
				],
			]
		);
		$this->add_responsive_control(
			'image_shape_two_position_top_bottom',
			[
				'label' => esc_html__('Top To Bottom', 'topper-pack'),
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
					'{{WRAPPER}} .topppa-img-wrapper .image-shape-two' => 'top: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'image_shape_two_positions' => ['relative', 'absolute'],
				],
			]
		);
		$this->add_responsive_control(
			'image_shape_two_position_bottom_top',
			[
				'label' => esc_html__('Bottom To Top', 'topper-pack'),
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
					'{{WRAPPER}} .topppa-img-wrapper .image-shape-two' => 'bottom: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'image_shape_two_positions' => ['relative', 'absolute'],
				],
			]
		);
		$this->add_responsive_control(
			'image_shape_two_z_index',
			[
				'label' => esc_html__('Z Index', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => -100,
						'max' => 1000,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .topppa-img-wrapper .image-shape-two' => 'z-index: {{SIZE}};',
				],
				'condition' => [
					'image_shape_two_positions' => ['relative', 'absolute'],
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

		$style_classes = [
			'style_one' => 'style-one',
			'style_two' => 'style-two',
			'style_three' => 'style-three',
			'style_four' => 'style-four',
			'style_five' => 'style-five',
			'style_six' => 'style-six',
			'style_seven' => 'style-seven',
			'style_eight' => 'style-eight',
		];

		// Get the class name based on the selected style or fallback to an empty string.
		$class = isset($style_classes[$settings['topppa_styles']]) ? $style_classes[$settings['topppa_styles']] : '';

		// Generate image HTML using Group_Control_Image_Size for each image
		$image_one_html   = '';
		$image_two_html   = '';
		$image_three_html = '';

		if (!empty($settings['image_one']['url']) && $settings['enable_image_one'] === 'yes') {
			$image_one_html = Group_Control_Image_Size::get_attachment_image_html($settings, 'topppa_image_thumb_one', 'image_one');
		}

		if (!empty($settings['image_two']['url']) && $settings['enable_image_two'] === 'yes') {
			$image_two_html = Group_Control_Image_Size::get_attachment_image_html($settings, 'topppa_image_thumb_two', 'image_two');
		}

		if (!empty($settings['image_three']['url']) && $settings['enable_image_three'] === 'yes' && $settings['enable_right_image_wrapper'] === 'yes') {
			$image_three_html = Group_Control_Image_Size::get_attachment_image_html($settings, 'topppa_image_thumb_three', 'image_three');
		}
?>

		<div class="topppa-img-wrapper <?php echo esc_attr($class); ?>">
			<?php if ($settings['enable_shapes'] === 'yes' && in_array($settings['topppa_styles'], ['style_six', 'style_eight'])) : ?>
				<?php if ($settings['enable_image_shape'] === 'yes' && !empty($settings['image_shape_one']['id']) && in_array($settings['topppa_styles'], ['style_six', 'style_eight'])) : ?>
					<span class="image-shape">
						<?php echo wp_get_attachment_image($settings['image_shape_one']['id'], 'full'); ?>
					</span>
				<?php endif; ?>

				<?php if ($settings['enable_image_shape_two'] === 'yes' && !empty($settings['image_shape_two']['id']) && $settings['topppa_styles'] === 'style_eight') : ?>
					<span class="image-shape-two">
						<?php echo wp_get_attachment_image($settings['image_shape_two']['id'], 'full'); ?>
					</span>
				<?php endif; ?>
			<?php endif; ?>


			<?php if ($settings['enable_left_all_image_wrapper'] === 'yes') : ?>
				<div class="left-image">
					<?php if (!empty($image_one_html) && in_array($settings['topppa_styles'], ['style_one', 'style_two', 'style_three', 'style_four', 'style_five', 'style_six', 'style_seven'])) : ?>
						<div class="img-1">
							<?php echo wp_kses_post($image_one_html); ?>
						</div>
					<?php endif; ?>

					<?php if (!empty($image_two_html) && in_array($settings['topppa_styles'], ['style_one', 'style_two'])) : ?>
						<div class="img-2">
							<?php echo wp_kses_post($image_two_html); ?>
						</div>
					<?php endif; ?>
				</div>
			<?php endif; ?>

			<?php if ($settings['enable_right_image_wrapper'] === 'yes'): ?>
				<div class="right-image">
					<?php if (!empty($image_three_html) && in_array($settings['topppa_styles'], ['style_one', 'style_two', 'style_three', 'style_four', 'style_five', 'style_six', 'style_seven', 'style_eight'])) : ?>
						<div class="img-3">
							<?php echo wp_kses_post($image_three_html); ?>
						</div>
					<?php endif; ?>
				</div>
			<?php endif; ?>

			<?php if ($settings['enable_counter'] === 'yes' && in_array($settings['topppa_styles'], ['style_three', 'style_four', 'style_seven', 'style_eight'])) : ?>

				<div class="topppa-image-counter counter-number-wrp">
					<div class="counter-content-wrp">
						<?php if ($settings['enable_counter_icon'] === 'yes' && !empty($settings['icon'])) : ?>
							<div class="counter-icon">
								<?php \Elementor\Icons_Manager::render_icon($settings['icon'], ['aria-hidden' => 'true']); ?>
							</div>
						<?php endif; ?>

						<div class="count-number">
							<div class="counter-number" data-to="<?php echo esc_attr($settings['topppa_counter_number']); ?>" data-speed="<?php echo esc_attr($settings['topppa_counter_speed']); ?>">
								<?php echo esc_html($settings['topppa_counter_number']); ?>

								<?php if (!empty($settings['topppa_counter_symble'])) : ?>
									<span class="counter-symble"><?php echo esc_html($settings['topppa_counter_symble']); ?></span>
								<?php endif; ?>
							</div>
							<div class="count-text">
								<?php echo esc_html($settings['topppa_counter_text']); ?>
							</div>
						</div>
					</div>
				</div>
			<?php endif; ?>
		</div>
<?php
	}
}