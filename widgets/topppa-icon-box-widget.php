<?php

use \TopperPack\Includes\Controls\Controls_Manager as TopperPack_Controls_Manager;
use Elementor\Controls_Manager;

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}

/**
 * Elementor topppa List Item Widget.
 *
 * Elementor widget that inserts an embbedable content into the page, from any given URL.
 *
 * @since 1.0.0
 */
class TOPPPA_Icon_Box_Widget extends \Elementor\Widget_Base {

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
		return 'topppa_icon_box';
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
		return TOPPPA_EPWB . esc_html__('Icon Box', 'topper-pack');
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
		return ['topppa', 'widget', 'icon', 'box', 'topperpack'];
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
		return 'https://doc.topperpack.com/docs/general-widgets/icon-box/';
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
		return 'https://topperpack.com/assets/widgets/icon-box-widget/';
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
		$base_url = $this->get_custom_image_url();

		$this->start_controls_section(
			'topppa_icon_box_style',
			[
				'label' => esc_html__('Styles', 'topper-pack'),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'topppa_icon_box_styles',
			[
				'label' => esc_html__('Choose Style', 'topper-pack'),
				'type' => TopperPack_Controls_Manager::IMAGECHOOSE,
				'default' => 'style_one',
				'options' => [
					'style_one' => [
						'title' => esc_html__('Style 1', 'topper-pack'),
						'imagelarge' => $base_url . 'topppa-icon-box.jpg',
						'imagesmall' => $base_url . 'topppa-icon-box.jpg',
						'width' => '100%',
					],
					'style_two' => [
						'title' => esc_html__('style 2', 'topper-pack'),
						'imagelarge' => $base_url . 'topppa-icon-box-2.jpg',
						'imagesmall' => $base_url . 'topppa-icon-box-2.jpg',
						'width' => '100%',
					],
					'style_three' => [
						'title' => esc_html__('Style 3', 'topper-pack'),
						'imagelarge' => $base_url . 'topppa-icon-box-3.jpg',
						'imagesmall' => $base_url . 'topppa-icon-box-3.jpg',
						'width' => '100%',
					],
					'style_four' => [
						'title' => esc_html__('Style 4', 'topper-pack'),
						'imagelarge' => $base_url . 'topppa-icon-box-3.jpg',
						'imagesmall' => $base_url . 'topppa-icon-box-3.jpg',
						'width' => '100%',
					],
				],
			]
		);
		$this->end_controls_section();

		// <========================> CONTENT TAB START <========================>
		$this->start_controls_section(
			'topppa_icon_box',
			[
				'label' => esc_html__('Icon Box', 'topper-pack'),
			]
		);
		$this->add_responsive_control(
			'anim_color',
			[
				'label' => esc_html__('Animation Color', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .icon-box-item.style-three::before' => 'background-color: {{VALUE}}',
				],
				'condition' => [
					'topppa_icon_box_styles' => 'style_three',
				]
			]
		);
		$this->add_control(
			'enable_badge_one',
			[
				'label' => esc_html__('Badge One', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Show', 'topper-pack'),
				'label_off' => esc_html__('Hide', 'topper-pack'),
				'return_value' => 'yes',
				'default' => 'no',
				'condition' => [
					'topppa_icon_box_styles!' => 'style_four',
				],
			]
		);
		$this->add_control(
			'badge_title',
			[
				'label' => esc_html__('Badge Title', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__('Popular', 'topper-pack'),
				'condition' => [
					'enable_badge_one' => 'yes',
					'topppa_icon_box_styles!' => 'style_four',
				]
			]
		);

		$this->add_control(
			'enable_badge_two',
			[
				'label' => esc_html__('Enable Badge Two', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Show', 'topper-pack'),
				'label_off' => esc_html__('Hide', 'topper-pack'),
				'return_value' => 'yes',
				'default' => 'no',
				'condition' => [
					'topppa_icon_box_styles!' => 'style_four',
				],
			]
		);
		$this->add_control(
			'badge_two_title',
			[
				'label' => esc_html__('Badge Title', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__('Popular', 'topper-pack'),
				'condition' => [
					'enable_badge_two' => 'yes',
					'topppa_icon_box_styles!' => 'style_four',
				]
			]
		);
		$this->add_control(
			'enable_pro_badge',
			[
				'label' => esc_html__('Set BG Color?', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Show', 'topper-pack'),
				'label_off' => esc_html__('Hide', 'topper-pack'),
				'return_value' => 'yes',
				'default' => 'yes',
				'condition' => [
					'enable_badge_two' => 'yes',
					'topppa_icon_box_styles!' => 'style_four',
				]
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
			]
		);
		$this->add_control(
			'icon_box_options',
			[
				'label' => esc_html__('Icon Type', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'label_block' => false,
				'options' => [
					'none' => [
						'title' => esc_html__('None', 'topper-pack'),
						'icon' => 'fa fa-ban',
					],
					'icon' => [
						'title' => esc_html__('Icon', 'topper-pack'),
						'icon' => 'fa fa-paint-brush',
					],
					'image' => [
						'title' => esc_html__('Image', 'topper-pack'),
						'icon' => 'fa fa-image',
					],
					'text' => [
						'title' => esc_html__('Text', 'topper-pack'),
						'icon' => 'fa fa-font',
					],
				],
				'default' => 'icon',
			]
		);

		$this->add_control(
			'icon_box_icons',
			[
				'label' => esc_html__('Icon', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::ICONS,
				'default' => [
					'value' => 'fas fa-star',
					'library' => 'fa-solid',
				],
				'label_block' => true,
				'condition' => [
					'icon_box_options' => 'icon',
				]
			]
		);

		$this->add_control(
			'icon_box_text',
			[
				'label' => esc_html__('Title', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__('Title', 'topper-pack'),
				'condition' => [
					'icon_box_options' => 'text',
				]
			]
		);

		$this->add_control(
			'icon_box_image',
			[
				'label' => esc_html__('Choose Image', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'condition' => [
					'icon_box_options' => 'image',
				]
			]
		);
		$this->add_control(
			'icon_box_image_size',
			[
				'label' => esc_html__('Image Size', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'thumbnail',
				'options' => [
					'thumbnail' => esc_html__('Thumbnail', 'topper-pack'),
					'medium' => esc_html__('Medium', 'topper-pack'),
					'medium_large' => esc_html__('Medium Large', 'topper-pack'),
					'large' => esc_html__('Large', 'topper-pack'),
					'full' => esc_html__('Full', 'topper-pack'),
				],
				'condition' => [
					'icon_box_options' => 'image',
				],
			]
		);

		$this->add_control(
			'icon_box_title',
			[
				'label' => esc_html__('Title ', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'dynamic' => [
					'active' => true,
				],
				'default' => esc_html__('Project Discussion', 'topper-pack'),
				'placeholder' => esc_html__('Enter your title', 'topper-pack'),
				'label_block' => true,
				'separator' => 'before',
			]
		);
		$this->add_control(
			'enable_title_link',
			[
				'label' => esc_html__('Enable Title Link', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Show', 'topper-pack'),
				'label_off' => esc_html__('Hide', 'topper-pack'),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);
		$this->add_control(
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
				],
				'dynamic' => [
					'active' => true,
				],
				'condition' => [
					'enable_title_link' => 'yes',
				],
			]
		);

		$this->add_control(
			'enable_icon_desc',
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
			'icon_box_desc',
			[
				'label' => esc_html__('Content', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'dynamic' => [
					'active' => true,
				],
				'default' => esc_html__('Extensible for web iterate process before meta services impact with olisticly enable client.', 'topper-pack'),
				'placeholder' => esc_html__('Enter your description', 'topper-pack'),
				'separator' => 'none',
				'rows' => 10,
				'show_label' => false,
				'condition' => [
					'enable_icon_desc' => 'yes'
				]
			]
		);

		$this->add_control(
			'enable_count',
			[
				'label' => esc_html__('Enable Count', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Show', 'topper-pack'),
				'label_off' => esc_html__('Hide', 'topper-pack'),
				'return_value' => 'yes',
				'default' => 'no',
				'condition' => [
					'icon_box_options' => ['icon', 'image'],
				]
			]
		);
		$this->add_control(
			'icon_box_count',
			[
				'label' => esc_html__('Count', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__('01', 'topper-pack'),
				'condition' => [
					'enable_count' => 'yes',
					'icon_box_options' => ['icon', 'image'],
				]
			]
		);

		$this->end_controls_section();

		// <========================> topppa BUTTON OPTIONS <========================>
		$this->start_controls_section(
			'topppa_btn_options',
			[
				'label' => esc_html__('topppa Button', 'topper-pack'),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'enable_box_btn',
			[
				'label' => esc_html__('Enable Button', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Show', 'topper-pack'),
				'label_off' => esc_html__('Hide', 'topper-pack'),
				'return_value' => 'yes',
				'default' => 'no',
			]
		);

		$this->add_control(
			'topppa_btn_styles',
			[
				'label' => esc_html__('Button Styles', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'style_one',
				'options' => [
					'style_one' => esc_html__('Style One', 'topper-pack'),
					'style_two' => esc_html__('Style Two', 'topper-pack'),
					'style_three' => esc_html__('Style Three', 'topper-pack'),
					'style_four' => esc_html__('Style Four', 'topper-pack'),
					'style_five' => esc_html__('Style Five', 'topper-pack'),
					'style_six' => esc_html__('Style Six', 'topper-pack'),
					'style_seven' => esc_html__('Style Seven', 'topper-pack'),
					'style_eight' => esc_html__('Style Eight', 'topper-pack'),
					'style_nine' => esc_html__('Style Nine', 'topper-pack'),
					'style_ten' => esc_html__('Style Ten', 'topper-pack'),
					'style_eleven' => esc_html__('Style Eleven', 'topper-pack'),
					'style_twelve' => esc_html__('Style Twelve', 'topper-pack'),
					'style_thirteen' => esc_html__('Style Thirteen', 'topper-pack'),
					'style_fourteen' => esc_html__('Style Fourteen', 'topper-pack'),
					'style_fifteen' => esc_html__('Style Fifteen', 'topper-pack'),
				],
				'condition' => [
					'enable_box_btn' => 'yes',
				]
			]
		);

		$this->add_control(
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
					'enable_box_btn' => 'yes',
				]
			]
		);

		$this->add_control(
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
					'enable_box_btn' => 'yes',
				]
			]
		);

		$this->add_control(
			'topppa_show_icon',
			[
				'label' => esc_html__('Show Icon', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Show', 'topper-pack'),
				'label_off' => esc_html__('Hide', 'topper-pack'),
				'return_value' => 'yes',
				'default' => 'no',
				'condition' => [
					'enable_box_btn' => 'yes',
				]
			]
		);

		$this->add_control(
			'topppa_btn_icon',
			[
				'label' => esc_html__('Icon', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::ICONS,
				'default' => [
					'value' => 'fas fa-arrow-right',
					'library' => 'fa-solid',
				],
				'condition' => [
					'enable_box_btn' => 'yes',
					'topppa_show_icon' => 'yes'
				]
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
					'{{WRAPPER}} .topppa-icon-bx-btn-wrapper .topppa-btn' => 'flex-direction: {{VALUE}};',
				],
				'condition' => [
					'enable_box_btn' => 'yes',
					'topppa_show_icon' => 'yes'
				]
			]
		);

		$this->end_controls_section();

		// <==========>
		// <==========> BOX STYLES <==========>

		$this->start_controls_section(
			'box_styles',
			[
				'label' => esc_html__('Box Style', 'topper-pack'),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
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
					'{{WRAPPER}} .icon-box-item' => 'flex-direction: {{VALUE}};',
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
					'{{WRAPPER}} .icon-box-item' => 'align-items: {{VALUE}};',
					'{{WRAPPER}} .box-icon-text-content' => 'text-align: {{VALUE}};',
				],
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
					'{{WRAPPER}} .icon-box-item' => 'justify-content: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'backdrop_blur',
			[
				'label' => esc_html__('Backdrop Blur', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .icon-box-item' =>
					'-webkit-backdrop-filter: blur({{SIZE}}{{UNIT}}); backdrop-filter: blur({{SIZE}}{{UNIT}});',
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
					'{{WRAPPER}} .icon-box-item' => 'gap: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->start_controls_tabs(
			'box_style_tabs'
		);
		$this->start_controls_tab(
			'box_style_normal_tab',
			[
				'label' => esc_html__('Normal', 'topper-pack'),
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'box_bg',
				'label' => esc_html__('Background', 'topper-pack'),
				'types' => ['classic', 'gradient', 'video'],
				'selector' => '{{WRAPPER}} .icon-box-item',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'box_border',
				'label' => esc_html__('Border', 'topper-pack'),
				'selector' => '{{WRAPPER}} .icon-box-item',
			]
		);
		$this->add_responsive_control(
			'box_radius',
			[
				'label' => esc_html__('Border Radius', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .icon-box-item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'box_box_shadow',
				'label' => esc_html__('Box Shadow', 'topper-pack'),
				'selector' => '{{WRAPPER}} .icon-box-item',
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

		$this->end_controls_tab();
		$this->start_controls_tab(
			'box_style_hover_tab',
			[
				'label' => esc_html__('Hover', 'topper-pack'),
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'box_bg_hover',
				'label' => esc_html__('Background', 'topper-pack'),
				'types' => ['classic', 'gradient', 'video'],
				'selector' => '{{WRAPPER}} .icon-box-item:hover',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'box_border_hover',
				'label' => esc_html__('Border', 'topper-pack'),
				'selector' => '{{WRAPPER}} .icon-box-item:hover',
			]
		);
		$this->add_responsive_control(
			'box_radius_hover',
			[
				'label' => esc_html__('Border Radius', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .icon-box-item:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'box_box_shadow_hover',
				'label' => esc_html__('Box Shadow', 'topper-pack'),
				'selector' => '{{WRAPPER}} .icon-box-item:hover',
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
					'{{WRAPPER}} .icon-box-item' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .icon-box-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'anim_positions_controls',
			[
				'label' => esc_html__('Position Controls', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => [
					'topppa_icon_box_styles' => 'style_three',
				],
			]
		);
		$this->add_responsive_control(
			'anim_position_left_right',
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
					'{{WRAPPER}} .icon-box-item.style-three::before' => 'left: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'topppa_icon_box_styles' => 'style_three'
				]
			]
		);
		$this->add_responsive_control(
			'anim_position_right_left',
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
					'{{WRAPPER}} .icon-box-item.style-three::before' => 'right: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'topppa_icon_box_styles' => 'style_three'
				]
			]
		);
		$this->add_responsive_control(
			'anim_position_top_bottom',
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
					'{{WRAPPER}} .icon-box-item.style-three::before' => 'top: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'topppa_icon_box_styles' => 'style_three'
				]
			]
		);

		$this->add_responsive_control(
			'anim_position_bottom_top',
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
					'{{WRAPPER}} .icon-box-item.style-three::before' => 'bottom: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'topppa_icon_box_styles' => 'style_three'
				]
			]
		);
		$this->end_controls_section();

		// <==========>
		// <==========> BADGE ONE STYLES <==========>

		$this->start_controls_section(
			'badge_styles',
			[
				'label' => esc_html__('Badge One', 'topper-pack'),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
				'condition' => [
					'enable_badge_one' => 'yes',
					'topppa_icon_box_styles!' => 'style_four',
				]
			]
		);
		$this->add_responsive_control(
			'badge_one_width',
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
					'unit' => 'px',
					'size' => 200,
				],
				'selectors' => [
					'{{WRAPPER}} .icon-box-item .box-badge' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'badge_one_typo',
				'selector' => '{{WRAPPER}} .icon-box-item .box-badge',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'badge_one_background',
				'types' => ['classic', 'gradient', 'video'],
				'selector' => '{{WRAPPER}} .icon-box-item .box-badge',
			]
		);
		$this->add_responsive_control(
			'badge_one_color',
			[
				'label' => esc_html__('Text Color', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .icon-box-item .box-badge' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_responsive_control(
			'badge_one_margin',
			[
				'label' => esc_html__('Margin', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .icon-box-item .box-badge' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'badge_one_padding',
			[
				'label' => esc_html__('Padding', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .icon-box-item .box-badge' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'badge_one_positions_controls',
			[
				'label' => esc_html__('Position Controls', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_responsive_control(
			'badge_one_position_left_right',
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
					'{{WRAPPER}} .icon-box-item .box-badge' => 'left: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'badge_one_position_right_left',
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
					'{{WRAPPER}} .icon-box-item .box-badge' => 'right: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'badge_one_position_top_bottom',
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
					'{{WRAPPER}} .icon-box-item .box-badge' => 'top: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'badge_one_position_bottom_top',
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
					'{{WRAPPER}} .icon-box-item .box-badge' => 'bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();

		// <==========>
		// <==========> BADGE TWO STYLES <==========>

		$this->start_controls_section(
			'badge_two_styles',
			[
				'label' => esc_html__('Badge Two', 'topper-pack'),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
				'condition' => [
					'enable_badge_two' => 'yes',
					'topppa_icon_box_styles!' => 'style_four',
				]
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'badge_two_typo',
				'selector' => '{{WRAPPER}} .icon-box-item .box-badge-v2.bg',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'badge_two_background',
				'types' => ['classic', 'gradient', 'video'],
				'selector' => '{{WRAPPER}} .icon-box-item .box-badge-v2.bg',
			]
		);
		$this->add_responsive_control(
			'badge_two_color',
			[
				'label' => esc_html__('Text Color', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .icon-box-item .box-badge-v2.bg' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_responsive_control(
			'badge_two_margin',
			[
				'label' => esc_html__('Margin', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .icon-box-item .box-badge-v2.bg' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'badge_two_padding',
			[
				'label' => esc_html__('Padding', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .icon-box-item .box-badge-v2.bg' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'badge_two_positions_controls',
			[
				'label' => esc_html__('Position Controls', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_responsive_control(
			'badge_two_position_left_right',
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
					'{{WRAPPER}} .icon-box-item .box-badge-v2' => 'left: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'badge_two_position_right_left',
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
					'{{WRAPPER}} .icon-box-item .box-badge-v2' => 'right: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'badge_two_position_top_bottom',
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
					'{{WRAPPER}} .icon-box-item .box-badge-v2' => 'top: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'badge_two_position_bottom_top',
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
					'{{WRAPPER}} .icon-box-item .box-badge-v2' => 'bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();

		// <==========>
		// <==========> ICON STYLES <==========>

		$this->start_controls_section(
			'icon_styles',
			[
				'label' => esc_html__('Icon', 'topper-pack'),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
				'condition' => [
					'icon_box_options' => 'icon',
				]
			]
		);
		$this->add_responsive_control(
			'icon_bborder_color',
			[
				'label' => esc_html__('Border Color', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .icon-box-item.style-two .box-icon::before' => 'border-color: {{VALUE}}',
				],
				'condition' => [
					'topppa_icon_box_styles' => 'style_two'
				]
			]
		);
		$this->add_responsive_control(
			'icon_hbborder_color',
			[
				'label' => esc_html__('Hover Border Color', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .icon-box-item.style-two:hover .box-icon::before' => 'border-color: {{VALUE}}',
				],
				'condition' => [
					'topppa_icon_box_styles' => 'style_two'
				]
			]
		);
		$this->add_responsive_control(
			'icon_height',
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
					'{{WRAPPER}} .icon-box-item .box-icon-wrapper .box-icon' => 'height: {{SIZE}}{{UNIT}};',
				],
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
						'max' => 1000,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .icon-box-item .box-icon-wrapper .box-icon' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'icon_min_width',
			[
				'label' => esc_html__('Min Width', 'topper-pack'),
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
					'{{WRAPPER}} .icon-box-item .box-icon-wrapper .box-icon' => 'min-width: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'icon_typo',
				'selector' => '{{WRAPPER}} .icon-box-item .box-icon-wrapper .box-icon',
			]
		);
		$this->start_controls_tabs(
			'icon_style_tabs'
		);
		$this->start_controls_tab(
			'icon_style_normal_tab',
			[
				'label' => esc_html__('Normal', 'topper-pack'),
			]
		);

		$this->add_responsive_control(
			'icon_color',
			[
				'label' => esc_html__('Color', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .icon-box-item .box-icon-wrapper .box-icon' => 'color: {{VALUE}}',
					'{{WRAPPER}} .icon-box-item .box-icon-wrapper .box-icon svg path' => 'fill: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'icon_bg_color',
				'types' => ['classic', 'gradient', 'video'],
				'selector' => '{{WRAPPER}} .icon-box-item .box-icon-wrapper .box-icon',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'icon_border',
				'selector' => '{{WRAPPER}} .icon-box-item .box-icon-wrapper .box-icon',
			]
		);
		$this->add_responsive_control(
			'icon_border_radius',
			[
				'label' => esc_html__('Border Radius', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .icon-box-item .box-icon-wrapper .box-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'icon_box_shadow',
				'selector' => '{{WRAPPER}} .icon-box-item .box-icon-wrapper .box-icon',
			]
		);
		$this->add_responsive_control(
			'svg_color',
			[
				'label' => esc_html__('SVG Color', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .icon-box-item .box-icon-wrapper .box-icon svg path' => 'fill: {{VALUE}}',
				],
			]
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'icon_style_hover_tab',
			[
				'label' => esc_html__('Hover', 'topper-pack'),
			]
		);
		$this->add_responsive_control(
			'icon_hcolor',
			[
				'label' => esc_html__('Hover Color', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .icon-box-item:hover .box-icon-wrapper .box-icon' => 'color: {{VALUE}}',
					'{{WRAPPER}} .icon-box-item:hover .box-icon-wrapper .box-icon svg path' => 'fill: {{VALUE}}',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'icon_bg_color_hover',
				'types' => ['classic', 'gradient', 'video'],
				'selector' => '{{WRAPPER}} .icon-box-item:hover .box-icon-wrapper .box-icon',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'icon_border_hover',
				'selector' => '{{WRAPPER}} .icon-box-item:hover .box-icon-wrapper .box-icon',
			]
		);
		$this->add_responsive_control(
			'icon_border_radius2',
			[
				'label' => esc_html__('Border Radius', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .icon-box-item:hover .box-icon-wrapper .box-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'icon_box_shadow_hover',
				'selector' => '{{WRAPPER}} .icon-box-item:hover .box-icon-wrapper .box-icon',
			]
		);
		$this->add_responsive_control(
			'svg_hcolor',
			[
				'label' => esc_html__('SVG Color', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .icon-box-item:hover .box-icon-wrapper .box-icon svg path' => 'fill: {{VALUE}}',
				],
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->add_responsive_control(
			'icon_margin',
			[
				'label' => esc_html__('Margin', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .icon-box-item .box-icon-wrapper .box-icon' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .icon-box-item .box-icon-wrapper .box-icon' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();


		// <==========>
		// <==========> LABEL STYLES <==========>

		$this->start_controls_section(
			'box_label_styles',
			[
				'label' => esc_html__('Label', 'topper-pack'),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
				'condition' => [
					'icon_box_options' => 'text',
				]
			]
		);
		$this->add_responsive_control(
			'box_label_color',
			[
				'label' => esc_html__('Border Color', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .icon-box-item.style-two .box-icon::before' => 'border-color: {{VALUE}}',
				],
				'condition' => [
					'topppa_icon_box_styles' => 'style_two'
				]
			]
		);
		$this->add_responsive_control(
			'box_label_hcolor',
			[
				'label' => esc_html__('Hover Border Color', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .icon-box-item.style-two:hover .box-icon::before' => 'border-color: {{VALUE}}',
				],
				'condition' => [
					'topppa_icon_box_styles' => 'style_two'
				]
			]
		);
		$this->add_responsive_control(
			'box_label_height',
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
					'{{WRAPPER}} .icon-box-item .box-icon-wrapper .box-icon.text' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'box_label_width',
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
					'{{WRAPPER}} .icon-box-item .box-icon-wrapper .box-icon.text' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'box_label_min_width',
			[
				'label' => esc_html__('Min Width', 'topper-pack'),
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
					'{{WRAPPER}} .icon-box-item .box-icon-wrapper .box-icon.text' => 'min-width: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'box_label_typo',
				'selector' => '{{WRAPPER}} .icon-box-item .box-icon-wrapper .box-icon.text',
			]
		);
		$this->start_controls_tabs(
			'box_label_style_tabs'
		);
		$this->start_controls_tab(
			'box_label_style_normal_tab',
			[
				'label' => esc_html__('Normal', 'topper-pack'),
			]
		);

		$this->add_responsive_control(
			'box_label_text_color',
			[
				'label' => esc_html__('Color', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .icon-box-item .box-icon-wrapper .box-icon.text' => 'color: {{VALUE}}',
					'{{WRAPPER}} .icon-box-item .box-icon-wrapper .box-icon.text svg path' => 'fill: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'box_label_bg_color',
				'types' => ['classic', 'gradient', 'video'],
				'selector' => '{{WRAPPER}} .icon-box-item .box-icon-wrapper .box-icon.text',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'box_label_border',
				'selector' => '{{WRAPPER}} .icon-box-item .box-icon-wrapper .box-icon.text',
			]
		);
		$this->add_responsive_control(
			'box_label_border_radius',
			[
				'label' => esc_html__('Border Radius', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .icon-box-item .box-icon-wrapper .box-icon.text' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'box_label_box_shadow',
				'selector' => '{{WRAPPER}} .icon-box-item .box-icon-wrapper .box-icon.text',
			]
		);
		$this->end_controls_tab();

		$this->start_controls_tab(
			'box_label_style_hover_tab',
			[
				'label' => esc_html__('Hover', 'topper-pack'),
			]
		);
		$this->add_responsive_control(
			'box_label_text_hcolor',
			[
				'label' => esc_html__('Hover Color', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .icon-box-item:hover .box-icon-wrapper .box-icon.text' => 'color: {{VALUE}}',
					'{{WRAPPER}} .icon-box-item:hover .box-icon-wrapper .box-icon.text svg path' => 'fill: {{VALUE}}',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'box_label_bg_color_hover',
				'types' => ['classic', 'gradient', 'video'],
				'selector' => '{{WRAPPER}} .icon-box-item:hover .box-icon-wrapper .box-icon.text',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'box_label_border_hover',
				'selector' => '{{WRAPPER}} .icon-box-item:hover .box-icon-wrapper .box-icon.text',
			]
		);
		$this->add_responsive_control(
			'box_label_border_radius2',
			[
				'label' => esc_html__('Border Radius', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .icon-box-item:hover .box-icon-wrapper .box-icon.text' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'box_label_box_shadow_hover',
				'selector' => '{{WRAPPER}} .icon-box-item:hover .box-icon-wrapper .box-icon.text',
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->add_responsive_control(
			'box_label_margin',
			[
				'label' => esc_html__('Margin', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .icon-box-item .box-icon-wrapper .box-icon.text' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'box_label_padding',
			[
				'label' => esc_html__('Padding', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .icon-box-item .box-icon-wrapper .box-icon.text' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();

		// <==========>
		// <==========> IMAGE STYLES <==========>

		$this->start_controls_section(
			'card_img_style',
			[
				'label' => esc_html__('Image', 'topper-pack'),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
				'condition' => [
					'icon_box_options' => 'image',
				]
			]
		);
		$this->add_responsive_control(
			'card_img_height',
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
					'{{WRAPPER}} .box-icon-wrapper img' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'card_img_width',
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
					'{{WRAPPER}} .box-icon-wrapper img' => 'width: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .box-icon-wrapper' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'card_img_min_width',
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
					'{{WRAPPER}} .box-icon-wrapper img' => 'min-width: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .box-icon-wrapper' => 'min-width: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'card_img_object',
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
					'{{WRAPPER}} .box-icon-wrapper img' => 'object-fit: {{VALUE}}',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'card_img_border',
				'label' => esc_html__('Border', 'topper-pack'),
				'selector' => '{{WRAPPER}} .box-icon-wrapper img',
			]
		);
		$this->add_responsive_control(
			'card_img_border_radius',
			[
				'label' => esc_html__('Border Radius', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .box-icon-wrapper img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'card_img_shadow',
				'selector' => '{{WRAPPER}} .box-icon-wrapper img',
			]
		);
		$this->add_responsive_control(
			'card_img_margin',
			[
				'label' => esc_html__('Margin', 'topper-pack'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .box-icon-wrapper' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'card_img_padding',
			[
				'label' => esc_html__('Padding', 'topper-pack'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .box-icon-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();

		// <==========>
		// <==========> COUNT STYLES <==========>

		$this->start_controls_section(
			'icon_count_styles',
			[
				'label' => esc_html__('Count', 'topper-pack'),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
				'condition' => [
					'enable_count' => 'yes',
					'icon_box_options' => ['icon', 'image'],
				]
			]
		);
		$this->add_responsive_control(
			'icon_count_height',
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
				'default' => [
					'unit' => 'px',
				],
				'selectors' => [
					'{{WRAPPER}} .icon-box-item .box-icon-wrapper .box-icon-count' => 'height: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .topppa-icon-box-wrapper .box-icon-count' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'icon_count_width',
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
					'unit' => 'px',
				],
				'selectors' => [
					'{{WRAPPER}} .icon-box-item .box-icon-wrapper .box-icon-count' => 'width: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .topppa-icon-box-wrapper .box-icon-count' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'icon_count_min_width',
			[
				'label' => esc_html__('Min Width', 'topper-pack'),
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
					'{{WRAPPER}} .icon-box-item .box-icon-wrapper .box-icon-count' => 'min-width: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .topppa-icon-box-wrapper .box-icon-count' => 'min-width: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'icon_count_typo',
				'selector' => '{{WRAPPER}} .icon-box-item .box-icon-wrapper .box-icon-count,{{WRAPPER}} .topppa-icon-box-wrapper .box-icon-count',
			]
		);
		$this->add_responsive_control(
			'icon_count_color',
			[
				'label' => esc_html__('Color', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .icon-box-item .box-icon-wrapper .box-icon-count' => 'color: {{VALUE}}',
					'{{WRAPPER}} .topppa-icon-box-wrapper .box-icon-count' => 'color: {{VALUE}}',
					'{{WRAPPER}} .icon-box-item .box-icon-wrapper .box-icon-count svg path' => 'fill: {{VALUE}}',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'icon_count_bg_color',
				'types' => ['classic', 'gradient', 'video'],
				'selector' => '{{WRAPPER}} .icon-box-item .box-icon-wrapper .box-icon-count, .topppa-icon-box-wrapper .box-icon-count',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'icon_count_border',
				'selector' => '{{WRAPPER}} .icon-box-item .box-icon-wrapper .box-icon-count, .topppa-icon-box-wrapper .box-icon-count',
			]
		);
		$this->add_responsive_control(
			'icon_count_border_radius',
			[
				'label' => esc_html__('Border Radius', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .icon-box-item .box-icon-wrapper .box-icon-count, .topppa-icon-box-wrapper .box-icon-count' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'icon_count_box_shadow',
				'selector' => '{{WRAPPER}} .icon-box-item .box-icon-wrapper .box-icon-count , .topppa-icon-box-wrapper .box-icon-count',
			]
		);
		$this->add_responsive_control(
			'icon_count_margin',
			[
				'label' => esc_html__('Margin', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .icon-box-item .box-icon-wrapper .box-icon-count' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .topppa-icon-box-wrapper .box-icon-count' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'icon_count_padding',
			[
				'label' => esc_html__('Padding', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .icon-box-item .box-icon-wrapper .box-icon-count' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .topppa-icon-box-wrapper .box-icon-count' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();

		// <==========>
		// <==========> TITLE STYLES <==========>

		$this->start_controls_section(
			'title_styles',
			[
				'label' => esc_html__('Title', 'topper-pack'),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'title_typo',
				'selector' => '{{WRAPPER}} .icon-box-item .box-title',
			]
		);
		$this->add_responsive_control(
			'title_color',
			[
				'label' => esc_html__('Color', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .icon-box-item .box-title' => 'color: {{VALUE}}',
					'{{WRAPPER}} .icon-box-item .box-title a' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_responsive_control(
			'title_hcolor',
			[
				'label' => esc_html__('Hover Color', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .icon-box-item .box-title a:hover' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_responsive_control(
			'box_title_hcolor',
			[
				'label' => esc_html__('Box Hover Color', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .icon-box-item:hover .box-title a' => 'color: {{VALUE}}',
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
					'{{WRAPPER}} .icon-box-item .box-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .icon-box-item .box-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();

		// <==========>
		// <==========> DESCRIPTION STYLES <==========>

		$this->start_controls_section(
			'desc_styles',
			[
				'label' => esc_html__('Description', 'topper-pack'),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
				'condition' => [
					'enable_icon_desc' => 'yes'
				]
			]
		);
		$this->add_responsive_control(
			'desc_max_width',
			[
				'label' => esc_html__('Max Width', 'topper-pack'),
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
					'{{WRAPPER}} .icon-box-item .box-desc' => 'max-width: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'desc_typo',
				'selector' => '{{WRAPPER}} .topppa-icon-box-wrapper .box-desc',
			]
		);
		$this->add_responsive_control(
			'desc_color',
			[
				'label' => esc_html__('Color', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .topppa-icon-box-wrapper .box-desc' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_responsive_control(
			'desc_color_hover',
			[
				'label' => esc_html__('Color Hover', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .topppa-icon-box-wrapper .icon-box-item:hover .box-desc' => 'color: {{VALUE}}',
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
					'{{WRAPPER}} .topppa-icon-box-wrapper .box-desc' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .topppa-icon-box-wrapper .box-desc' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();
		// <========================> BUTTON STYLES <========================>
		$this->start_controls_section(
			'topppa_btn_style',
			[
				'label' => esc_html__('Button', 'topper-pack'),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
				'condition' => [
					'enable_box_btn' => 'yes'
				]
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
					'{{WRAPPER}} .topppa-icon-bx-btn-wrapper .topppa-btn' => 'gap: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'topppa_show_icon' => 'yes'
				]
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
				'selector' => '{{WRAPPER}} .topppa-icon-bx-btn-wrapper .topppa-btn',
			]
		);

		$this->add_responsive_control(
			'topppa_btn_color',
			[
				'label' => esc_html__('Color', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .topppa-icon-bx-btn-wrapper .topppa-btn' => 'color: {{VALUE}}',
					'{{WRAPPER}} .topppa-icon-bx-btn-wrapper .topppa-btn span' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'topppa_btn_background',
				'types' => ['classic', 'gradient', 'video'],
				'selector' => '{{WRAPPER}} .topppa-icon-bx-btn-wrapper .topppa-btn',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'topppa_btn_border',
				'label' => esc_html__('Border', 'topper-pack'),
				'selector' => '{{WRAPPER}} .topppa-icon-bx-btn-wrapper .topppa-btn',
			]
		);

		$this->add_responsive_control(
			'topppa_btn_border_radius',
			[
				'label' => esc_html__('Border Radius', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .topppa-icon-bx-btn-wrapper .topppa-btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'topppa_btn_box_shadow',
				'label' => esc_html__('Shadow', 'topper-pack'),
				'selector' => '{{WRAPPER}} .topppa-icon-bx-btn-wrapper .topppa-btn',
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
					'{{WRAPPER}} .topppa-icon-bx-btn-wrapper .topppa-btn .btn-icon' => 'width: {{SIZE}}{{UNIT}};',
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
					'{{WRAPPER}} .topppa-icon-bx-btn-wrapper .topppa-btn .btn-icon' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'topppa_btn_icon_content_typography',
				'selector' => '{{WRAPPER}} .topppa-icon-bx-btn-wrapper .topppa-btn .btn-icon',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'topppa_btn_icon_bg',
				'types' => ['classic', 'gradient', 'video'],
				'selector' => '{{WRAPPER}} .topppa-icon-bx-btn-wrapper .topppa-btn .btn-icon',
			]
		);
		$this->add_responsive_control(
			'topppa_btn_icon_border_radius',
			[
				'label' => esc_html__('Border Radius', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .topppa-icon-bx-btn-wrapper .topppa-btn .btn-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .topppa-icon-bx-btn-wrapper .topppa-btn' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .topppa-icon-bx-btn-wrapper .topppa-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
				'selector' => '{{WRAPPER}} .topppa-icon-bx-btn-wrapper .topppa-btn:hover',
			]
		);

		$this->add_responsive_control(
			'topppa_btn_color_hover',
			[
				'label' => esc_html__('Color', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .topppa-icon-bx-btn-wrapper .topppa-btn:hover' => 'color: {{VALUE}}',
					'{{WRAPPER}} .topppa-icon-bx-btn-wrapper .topppa-btn:hover span' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'topppa_btn_background_hover',
				'types' => ['classic', 'gradient', 'video'],
				'selector' => '{{WRAPPER}} .topppa-icon-bx-btn-wrapper .topppa-btn:hover',
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
				'selector' => '{{WRAPPER}} .topppa-icon-bx-btn-wrapper .topppa-btn::before,{{WRAPPER}} .topppa-icon-bx-btn-wrapper .topppa-btn::after ',
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
				'selector' => '{{WRAPPER}} .topppa-icon-bx-btn-wrapper .topppa-btn:hover',
			]
		);

		$this->add_responsive_control(
			'topppa_btn_border_radius_hover',
			[
				'label' => esc_html__('Border Radius', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .topppa-icon-bx-btn-wrapper .topppa-btn:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'topppa_btn_box_shadow_hover',
				'label' => esc_html__('Shadow', 'topper-pack'),
				'selector' => '{{WRAPPER}} .topppa-icon-bx-btn-wrapper .topppa-btn:hover',
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
					'{{WRAPPER}} .topppa-icon-bx-btn-wrapper .topppa-btn:hover .btn-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'topppa_btn_icon_hbgcolor',
				'types' => ['classic', 'gradient', 'video'],
				'selector' => '{{WRAPPER}} .topppa-icon-bx-btn-wrapper .topppa-btn:hover .btn-icon',
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
				'selector' => '{{WRAPPER}} .topppa-icon-bx-btn-wrapper .topppa-btn .btn-icon::before',
				'condition' => [
					'topppa_btn_styles' => 'style_eight'
				]
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
		// Button Style Classes
		$style_classes = [
			'style_one' => 'style-one',
			'style_two' => 'style-two',
			'style_three' => 'style-three',
			'style_four' => 'style-four',
			'style_five' => 'style-five',
			'style_six' => 'style-six',
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

		$class = isset($style_classes[$settings['topppa_icon_box_styles']]) ? $style_classes[$settings['topppa_icon_box_styles']] : '';
		$btn_class = isset($style_classes[$settings['topppa_btn_styles']]) ? $style_classes[$settings['topppa_btn_styles']] : '';
		// HTML Tag
		$html_tag = isset($settings['html_tag']) ? $settings['html_tag'] : 'h3';
?>

		<div class="topppa-icon-box-wrapper">
			<?php if ($settings['enable_count'] === 'yes' && $settings['topppa_icon_box_styles'] === 'style_three'): ?>
				<div class="box-icon-count"><?php echo esc_html($settings['icon_box_count']); ?></div>
			<?php endif; ?>

			<div class="icon-box-item <?php echo esc_attr($class); ?>"
				style="box-shadow: <?php echo esc_attr($box_shadow); ?>;">
				<?php if ($settings['topppa_icon_box_styles'] !== 'style_four'): ?>
					<?php if (!empty($settings['badge_title']) && isset($settings['enable_badge_one']) && $settings['enable_badge_one'] === 'yes'): ?>
						<div class="box-badge"><?php echo esc_html($settings['badge_title']); ?></div>
					<?php endif; ?>

					<?php if ($settings['enable_badge_two'] === 'yes'): ?>
						<div class="box-badge-v2 <?php echo esc_attr($settings['enable_pro_badge'] === 'yes' ? 'bg' : 'bg-v2'); ?>">
							<?php echo esc_html($settings['badge_two_title']); ?>
						</div>
					<?php endif; ?>
				<?php endif; ?>
				<?php if ($settings['icon_box_options'] !== 'none'): ?>
					<div class="box-icon-wrapper">
						<?php if (
							$settings['enable_count'] === 'yes'
							&& in_array($settings['topppa_icon_box_styles'], ['style_one', 'style_two'])
						): ?>
							<div class="box-icon-count"><?php echo esc_html($settings['icon_box_count']); ?></div>
						<?php endif; ?>

						<?php if ($settings['icon_box_options'] == 'icon'): ?>
							<div class="box-icon">
								<?php \Elementor\Icons_Manager::render_icon($settings['icon_box_icons'], ['aria-hidden' => 'true']); ?>
							</div>
						<?php endif; ?>

						<?php if ($settings['icon_box_options'] == 'text'): ?>
							<div class="box-icon text">
								<?php echo esc_html($settings['icon_box_text']); ?>
							</div>
						<?php endif; ?>

						<?php
						$image_size = !empty($settings['icon_box_image_size']) ? $settings['icon_box_image_size'] : 'thumbnail';
						if (
							!empty($settings['icon_box_image']) &&
							is_array($settings['icon_box_image']) &&
							!empty($settings['icon_box_image']['id'])
						) {
							echo wp_get_attachment_image($settings['icon_box_image']['id'], $image_size);
						}
						?>
					</div>
				<?php endif; ?>

				<div class="box-icon-text-content">
					<?php if (!empty($settings['icon_box_title'])): ?>
						<<?php echo esc_html($html_tag); ?> class="box-title
							<?php echo ($settings['enable_title_link'] === 'yes' && !empty($settings['topppa_title_link']['url'])) ? ' has-link' : ''; ?>">
							<?php if ($settings['enable_title_link'] === 'yes' && !empty($settings['topppa_title_link']['url'])): ?>
								<?php $this->add_link_attributes('topppa_title_link', $settings['topppa_title_link']); ?>
								<a <?php $this->print_render_attribute_string('topppa_title_link'); ?>>
									<?php echo esc_html($settings['icon_box_title']); ?>
								</a>
							<?php else: ?>
								<?php echo esc_html($settings['icon_box_title']); ?>
							<?php endif; ?>
						</<?php echo esc_html($html_tag); ?>>
					<?php endif; ?>

					<?php if ($settings['enable_icon_desc'] === 'yes' && !empty($settings['icon_box_desc'])): ?>
						<div class="box-desc desc-color">
							<?php echo wp_kses($settings['icon_box_desc'], $allowed_html); ?>
						</div>
					<?php endif; ?>
					<?php if ($settings['enable_box_btn'] === 'yes'): ?>
						<div class="topppa-btn-wrapper topppa-icon-bx-btn-wrapper <?php echo esc_attr($btn_class); ?>">
							<?php if (!empty($settings['topppa_btn_link']['url'])) {
								$this->add_link_attributes('topppa_btn_link', $settings['topppa_btn_link']);
							} ?>
							<a <?php echo $this->get_render_attribute_string('topppa_btn_link'); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- Already escaped by elementor 
								?> class="topppa-btn">

								<span class="top-btn-text top-btn-text-v3 "><?php echo esc_html($settings['topppa_btn_text']) ?></span>
								<?php if ($class === 'style-three'): ?>
									<span
										class="bottom-btn-text bottom-btn-text-v3"><?php echo esc_html($settings['topppa_btn_text']) ?></span>
								<?php endif; ?>

								<?php if ($settings['topppa_show_icon'] == 'yes'): ?>
									<div class="btn-icon">
										<?php if (!empty($settings['topppa_btn_icon'])): ?>
											<?php \Elementor\Icons_Manager::render_icon($settings['topppa_btn_icon'], ['aria-hidden' => 'true']); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- Already escaped by elementor 
											?>
										<?php endif; ?>
									</div>
								<?php endif; ?>
							</a>
						</div>
					<?php endif; ?>
				</div>
				<?php if ($settings['enable_count'] === 'yes' && $settings['topppa_icon_box_styles'] == 'style_four'): ?>
					<div class="box-icon-count"><?php echo esc_html($settings['icon_box_count']); ?></div>
				<?php endif; ?>
			</div>
		</div>
<?php
	}
}
