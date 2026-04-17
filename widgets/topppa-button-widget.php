<?php

use TopperPack\Trait_Loader\Global_Component_Loader;
use \TopperPack\Includes\Controls\Controls_Manager as TopperPack_Controls_Manager;

if (! defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}

/**
 * Elementor TOPPPA Header Info Widget.
 *
 * Elementor widget that inserts an embbedable content into the page, from any given URL.
 *
 * @since 1.0.0
 */
class TOPPPA_Button_Widget extends \Elementor\Widget_Base {

	/**
	 * Global Component Trait
	 *
	 * @package TopperPack
	 */
	use Global_Component_Loader;
	/**
	 * Get widget name.
	 *
	 * Retrieve Button widget widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'topppa_button';
	}

	/**
	 * Get widget title.
	 *
	 * Retrieve Button widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget title.
	 */
	public function get_title() {
		return TOPPPA_EPWB . esc_html__('Button', 'topper-pack');
	}

	/**
	 * Get widget icon.
	 *
	 * Retrieve Button widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-button';
	}

	/**
	 * Get widget categories.
	 *
	 * Retrieve the list of categories the Button widget belongs to.
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
	 * Retrieve the list of keywords the Button widget belongs to.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return array Widget keywords.
	 */
	public function get_keywords() {
		return ['topppa', 'widget', 'button', 'btn', 'topperpack'];
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
		return 'https://doc.topperpack.com/docs/general-widgets/creative-button/';
	}

	/**
	 * Register Header Info widget controls.
	 *
	 * Add input fields to allow the user to customize the widget settings.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function register_controls() {

		$this->start_controls_section(
			'topppa_btn_options',
			[
				'label' => esc_html__('Button', 'topper-pack'),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->topppa_get_global_button_effects_controls();

		$this->add_control(
			'topppa_btn_text',
			[
				'label'       => esc_html__('Button Text', 'topper-pack'),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'default'     => esc_html__('Meet With Us', 'topper-pack'),
				'label_block' => true,
				'dynamic' => [
					'active' => true,
				],
			]
		);

		$this->add_control(
			'topppa_btn_link',
			[
				'label'       => esc_html__('Link', 'topper-pack'),
				'type'        => \Elementor\Controls_Manager::URL,
				'placeholder' => esc_html__('https://your-link.com', 'topper-pack'),
				'options'     => ['url', 'is_external', 'nofollow'],
				'default'     => [
					'url'         => '',
					'is_external' => true,
					'nofollow'    => true,
					// 'custom_attributes' => '',
				],
				'label_block' => true,
				'dynamic' => [
					'active' => true,
				],
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
					'{{WRAPPER}} .topppa-btn-wrapper .topppa-btn' => 'flex-direction: {{VALUE}};',
				],
				'condition' => [
					'topppa_show_icon' => 'yes'
				]
			]
		);

		$this->end_controls_section();

		// <========================> BUTTON STYLES <========================>
		$this->start_controls_section(
			'topppa_btn_style',
			[
				'label' => esc_html__('Button', 'topper-pack'),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_responsive_control(
			'topppa_btn_width',
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
					'{{WRAPPER}} .topppa-btn-wrapper .topppa-btn' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'button_text_align',
			[
				'label' => esc_html__('Text Alignment', 'topper-pack'),
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
					'{{WRAPPER}} .topppa-btn-wrapper .topppa-btn' => 'justify-content: {{VALUE}};',
				],
			]
		);
		$this->add_responsive_control(
			'button_align',
			[
				'label' => esc_html__('Button Alignment', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => esc_html__('Left', 'topper-pack'),
						'icon' => 'eicon-align-start-h',
					],
					'center' => [
						'title' => esc_html__('Center', 'topper-pack'),
						'icon' => 'eicon-align-center-v',
					],
					'right' => [
						'title' => esc_html__('Right', 'topper-pack'),
						'icon' => 'eicon-align-end-h',
					],
				],
				'toggle' => true,
				'selectors' => [
					'{{WRAPPER}} .topppa-btn-wrapper' => 'text-align: {{VALUE}};',
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
				'name'     => 'topppa_btn_typo',
				'selector' => '{{WRAPPER}} .topppa-btn-wrapper .topppa-btn',
			]
		);

		$this->add_responsive_control(
			'topppa_btn_color',
			[
				'label'     => esc_html__('Color', 'topper-pack'),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .topppa-btn-wrapper .topppa-btn' => 'color: {{VALUE}}',
					'{{WRAPPER}} .topppa-btn-wrapper .topppa-btn span' => 'color: {{VALUE}}',
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
				'name'     => 'topppa_btn_border',
				'label'    => esc_html__('Border', 'topper-pack'),
				'selector' => '{{WRAPPER}} .topppa-btn-wrapper .topppa-btn',
			]
		);

		$this->add_responsive_control(
			'topppa_btn_border_radius',
			[
				'label'      => esc_html__('Border Radius', 'topper-pack'),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors'  => [
					'{{WRAPPER}} .topppa-btn-wrapper .topppa-btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'topppa_btn_box_shadow',
				'label'    => esc_html__('Shadow', 'topper-pack'),
				'selector' => '{{WRAPPER}} .topppa-btn-wrapper .topppa-btn',
			]
		);

		$this->add_responsive_control(
			'topppa_btn_margin',
			[
				'label'      => esc_html__('Margin', 'topper-pack'),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors'  => [
					'{{WRAPPER}} .topppa-btn-wrapper .topppa-btn' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'topppa_btn_padding',
			[
				'label'      => esc_html__('Padding', 'topper-pack'),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors'  => [
					'{{WRAPPER}} .topppa-btn-wrapper .topppa-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'topppa_btn_icon_styles',
			[
				'label' => esc_html__('Icon Styles', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => [
					'topppa_show_icon' => 'yes'
				]
			]
		);
		$this->add_responsive_control(
			'topppa_btn_icon_gap',
			[
				'label'      => esc_html__('Icon Gap', 'topper-pack'),
				'type'       => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px', '%'],
				'range'      => [
					'px' => [
						'min'  => 0,
						'max'  => 100,
						'step' => 1,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .topppa-btn-wrapper .topppa-btn' => 'gap: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'topppa_show_icon' => 'yes'
				]
			]
		);
		$this->add_responsive_control(
			'topppa_btn_icon_color',
			[
				'label' => esc_html__('Icon Color', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .topppa-btn-wrapper .topppa-btn .btn-icon' => 'color: {{VALUE}}',
				],
				'condition' => [
					'topppa_show_icon' => 'yes'
				]
			]
		);
		$this->add_responsive_control(
			'topppa_btn_svg_icon_color',
			[
				'label' => esc_html__('SVG Color', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .topppa-btn-wrapper .topppa-btn .btn-icon svg path' => 'fill: {{VALUE}}',
				],
				'condition' => [
					'topppa_show_icon' => 'yes'
				]
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
				'condition' => [
					'topppa_show_icon' => 'yes'
				]
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
				'condition' => [
					'topppa_show_icon' => 'yes'
				]
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
					'{{WRAPPER}} .topppa-btn-wrapper .topppa-btn .btn-icon' => 'font-size: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'topppa_show_icon' => 'yes'
				]
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'topppa_btn_icon_bg',
				'types' => ['classic', 'gradient', 'video'],
				'exclude' => ['video', 'image'],
				'selector' => '{{WRAPPER}} .topppa-btn-wrapper .topppa-btn .btn-icon',
				'condition' => [
					'topppa_show_icon' => 'yes'
				]
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
				'condition' => [
					'topppa_show_icon' => 'yes'
				]
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
				'name'     => 'topppa_btn_typography_hover',
				'selector' => '{{WRAPPER}} .topppa-btn-wrapper .topppa-btn:hover',
			]
		);

		$this->add_responsive_control(
			'topppa_btn_color_hover',
			[
				'label'     => esc_html__('Color', 'topper-pack'),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .topppa-btn-wrapper .topppa-btn:hover' => 'color: {{VALUE}}',
					'{{WRAPPER}} .topppa-btn-wrapper .topppa-btn:hover span' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_responsive_control(
			'topppa_btn_icon_hsvg_icon_color',
			[
				'label' => esc_html__('SVG Color', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .topppa-btn-wrapper .topppa-btn:hover .btn-icon svg path' => 'fill: {{VALUE}}',
				],
				'condition' => [
					'topppa_show_icon' => 'yes'
				]
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'topppa_btn_background_hover2',
				'types' => ['classic', 'gradient', 'video'],
				'selector' => '{{WRAPPER}} .topppa-btn-wrapper .topppa-btn::before,{{WRAPPER}} .topppa-btn-wrapper .topppa-btn::after ',
				'condition' => [
					'topppa_btn_styles!' => ['style_three', 'style_six', 'style_seven', 'style_twelve'],
				]
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'topppa_btn_v2background',
				'label' => esc_html__('Secondary BG', 'topper-pack'),
				'types' => ['classic', 'gradient', 'video'],
				'selector' => '{{WRAPPER}} .topppa-btn-wrapper .topppa-btn:hover',
				'fields_options' => [
					'background' => [
						'label' => esc_html__('Secondary BG', 'topper-pack'),
					],
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name'     => 'topppa_btn_border_hover',
				'label'    => esc_html__('Border', 'topper-pack'),
				'selector' => '{{WRAPPER}} .topppa-btn-wrapper .topppa-btn:hover',
			]
		);

		$this->add_responsive_control(
			'topppa_btn_border_radius_hover',
			[
				'label'      => esc_html__('Border Radius', 'topper-pack'),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors'  => [
					'{{WRAPPER}} .topppa-btn-wrapper .topppa-btn:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'topppa_btn_box_shadow_hover',
				'label'    => esc_html__('Shadow', 'topper-pack'),
				'selector' => '{{WRAPPER}} .topppa-btn-wrapper .topppa-btn:hover',
			]
		);

		$this->add_control(
			'topppa_btn_icon_hstyles',
			[
				'label' => esc_html__('Icon Styles', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => [
					'topppa_show_icon' => 'yes'
				]
			]
		);
		$this->add_responsive_control(
			'topppa_btn_icon_hcolor',
			[
				'label' => esc_html__('Icon Color', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .topppa-btn-wrapper .topppa-btn:hover .btn-icon' => 'color: {{VALUE}}',
				],
				'condition' => [
					'topppa_show_icon' => 'yes'
				]
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
				'condition' => [
					'topppa_show_icon' => 'yes'
				]
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'topppa_btn_icon_hbgcolor2',
				'types' => ['classic', 'gradient', 'video'],
				'selector' => '{{WRAPPER}} .topppa-btn-wrapper .topppa-btn .btn-icon::before',
				'condition' => [
					'topppa_btn_styles' => 'style_eight',
					'topppa_show_icon' => 'yes'
				]
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'topppa_btn_icon_hbgcolor',
				'label' => esc_html__('Hover Background 2', 'topper-pack'),
				'types' => ['classic', 'gradient', 'video'],
				'selector' => '{{WRAPPER}} .topppa-btn-wrapper .topppa-btn:hover .btn-icon',
				'fields_options' => [
					'background' => [
						'label' => esc_html__('Hover Background 2', 'topper-pack'),
					],
				],
				'condition' => [
					'topppa_show_icon' => 'yes'
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
			'a'      => ['href' => [], 'title' => []],
			'br'     => [],
			'em'     => [],
			'strong' => [],
		];

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
		$class = isset($style_classes[$settings['topppa_btn_styles']]) ? $style_classes[$settings['topppa_btn_styles']] : '';
		// Your widget output here
?>
		<div class="topppa-btn-wrapper <?php echo esc_attr($class); ?>">
			<?php if (!empty($settings['topppa_btn_link']['url'])) {
				$this->add_link_attributes('topppa_btn_link', $settings['topppa_btn_link']);
			} ?>
			<a <?php echo $this->get_render_attribute_string('topppa_btn_link'); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- Already escaped by elementor 
				?> class="topppa-btn">

				<span class="top-btn-text top-btn-text-v3"><?php echo esc_html($settings['topppa_btn_text']) ?></span>
				<?php if ($class === 'style-three') : ?>
					<span class="bottom-btn-text bottom-btn-text-v3"><?php echo esc_html($settings['topppa_btn_text']) ?></span>
				<?php endif; ?>

				<?php if ($settings['topppa_show_icon'] == 'yes') : ?>
					<div class="btn-icon">
						<?php if (!empty($settings['topppa_btn_icon'])) : ?>
							<?php \Elementor\Icons_Manager::render_icon($settings['topppa_btn_icon'], ['aria-hidden' => 'true']); ?>
						<?php endif; ?>
					</div>
				<?php endif; ?>
			</a>
		</div>
<?php
	}
}
