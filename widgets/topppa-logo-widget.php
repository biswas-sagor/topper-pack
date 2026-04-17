<?php

use \TopperPack\Includes\Controls\Controls_Manager as TopperPack_Controls_Manager;

if (! defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}

/**
 * Elementor topppa Logo Widget.
 *
 * Elementor widget that inserts an embbedable content into the page, from any given URL.
 *
 * @since 1.0.0
 */
class TOPPPA_Logo_Widget extends \Elementor\Widget_Base {

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
		return 'topppa_logo';
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
		return TOPPPA_EPWB . esc_html__('Logo', 'topper-pack');
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
		return 'eicon-logo';
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
		return ['topppa', 'widget', 'logo', 'topperpack'];
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
	 * Register Logo Widget 1 widget controls.
	 *
	 * Add input fields to allow the user to customize the widget settings.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function register_controls() {

		// <========================> topppa LOGO OPTIONS <========================>
		$this->start_controls_section(
			'topppa_logo_options',
			[
				'label' => esc_html__('Logo', 'topper-pack'),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'topppa_logo_styles',
			[
				'label' => esc_html__('Logo Styles', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'style_one',
				'options' => [
					'style_one' => esc_html__('Style One', 'topper-pack'),
					'style_two' => esc_html__('Style Two', 'topper-pack'),
					'style_three' => esc_html__('Style Three', 'topper-pack'),
					'style_four' => esc_html__('Style Four', 'topper-pack'),
				],
			]
		);

		$this->add_control(
			'topppa_logo_shape_one',
			[
				'label' => esc_html__('Shape One', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::ICONS,
				'condition' => [
					'topppa_logo_styles' =>  'style_three'
				]
			]
		);

		$this->add_control(
			'topppa_logo_shape_two',
			[
				'label' => esc_html__('Shape Two', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::ICONS,
				'condition' => [
					'topppa_logo_styles' =>  'style_three'
				]
			]
		);

		$this->add_control(
			'topppa_select_logo',
			[
				'label' => esc_html__('Select Logo', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'default',
				'options' => [
					'default' => esc_html__('Default', 'topper-pack'),
					'custom' => esc_html__('Custom Logo', 'topper-pack'),
				],
			]
		);

		$this->add_control(
			'topppa_logo',
			[
				'label' => esc_html__('Choose Logo', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'condition' => [
					'topppa_select_logo' => 'custom',
				],
			]
		);

		$this->end_controls_section();

		// <========================> topppa LOGO STYLES <========================>
		$this->start_controls_section(
			'topppa_logo_style',
			[
				'label' => esc_html__('Logo', 'topper-pack'),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'topppa_logo_shape_color',
			[
				'label' => esc_html__('Shape One', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .topppa-logo-shape' => 'background-color: {{VALUE}}',
				],
				'condition' => [
					'topppa_logo_styles' => 'style_two',
				],
			]
		);

		$this->add_responsive_control(
			'topppa_logo_shape_two_color',
			[
				'label' => esc_html__('Shape Two', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .topppa-logo-shape-v2' => 'background-color: {{VALUE}}',
				],
				'condition' => [
					'topppa_logo_styles' => 'style_two',
				],
			]
		);

		$this->add_responsive_control(
			'topppa_logo_shape_tcolor',
			[
				'label' => esc_html__('Shape One', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .topppa-shape-img svg path' => 'fill: {{VALUE}}',
				],
				'condition' => [
					'topppa_logo_styles' => 'style_three',
				],
			]
		);

		$this->add_responsive_control(
			'topppa_logo_shape_tcolor2',
			[
				'label' => esc_html__('Shape Two', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .topppa-shape-img-v2 svg path' => 'fill: {{VALUE}}',
				],
				'condition' => [
					'topppa_logo_styles' => 'style_three',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'topppa_logo_text_typo',
				'selector' => '{{WRAPPER}} .topppa-logo-wrapper a',
				'condition' => [
					'topppa_select_logo' => 'default'
				]
			]
		);

		$this->add_responsive_control(
			'topppa_logo_text_color',
			[
				'label'     => esc_html__('Color', 'topper-pack'),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .topppa-logo-wrapper a' => 'color: {{VALUE}}',
				],
				'condition' => [
					'topppa_select_logo!' => 'custom',
				],
			]
		);

		$this->add_responsive_control(
			'topppa_logo_text_hcolor',
			[
				'label'     => esc_html__('Hover Color', 'topper-pack'),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .topppa-logo-wrapper a:hover' => 'color: {{VALUE}}',
				],
				'condition' => [
					'topppa_select_logo!' => 'custom',
				],
			]
		);

		$this->add_responsive_control(
			'topppa_logo_align',
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
					'{{WRAPPER}} .topppa-logo-wrapper' => 'text-align: {{VALUE}};',
				],
				'condition' => [
					'topppa_logo_styles!' => 'style_four',
				],
			]
		);

		$this->add_responsive_control(
			'topppa_logo_width',
			[
				'label' => esc_html__('Width', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px', '%', 'em', 'rem'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 500,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}}  .topppa-logo-wrapper a img' => 'width: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'topppa_select_logo' => 'custom',
					'topppa_logo_styles!' => 'style_four',
				],
			]
		);

		$this->add_responsive_control(
			'topppa_logo_height',
			[
				'label' => esc_html__('Height', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px', '%', 'em', 'rem'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 500,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .topppa-logo-wrapper a img' => 'height: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'topppa_select_logo' => 'custom',
					'topppa_logo_styles!' => 'style_four',
				],
			]
		);

		$this->add_responsive_control(
			'topppa_object_fit',
			[
				'label' => esc_html__('Object Fit', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'none',
				'options' => [
					'fill'  => esc_html__('Fill', 'topper-pack'),
					'contain' => esc_html__('Contain', 'topper-pack'),
					'cover' => esc_html__('Cover', 'topper-pack'),
					'none' => esc_html__('None', 'topper-pack'),
				],
				'selectors' => [
					'{{WRAPPER}} .topppa-logo-wrapper a img' => 'object-fit: {{VALUE}};',
				],
				'condition' => [
					'topppa_select_logo' => 'custom',

				],

			]
		);
		$this->add_responsive_control(
			'topppa_logo_margin',
			[
				'label' => esc_html__('Margin', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em', 'rem', 'custom'],
				'selectors' => [
					'{{WRAPPER}} .topppa-logo-wrapper a img' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'topppa_logo_styles!' => 'style_four',
				],
			]
		);
		$this->add_responsive_control(
			'topppa_logo_padding',
			[
				'label' => esc_html__('Padding', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em', 'rem', 'custom'],
				'selectors' => [
					'{{WRAPPER}} .topppa-logo-wrapper a img' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'topppa_logo_styles!' => 'style_four',
				],
			]
		);
		$this->add_responsive_control(
			'logo_box_height',
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
					'{{WRAPPER}} .topppa-logo-wrapper' => 'height: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'topppa_logo_styles' => 'style_four',
				],
			]
		);
		$this->add_responsive_control(
			'logo_box_width',
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
					'{{WRAPPER}} .topppa-logo-wrapper' => 'width: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'topppa_logo_styles' => 'style_four',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'logo_box_background',
				'types' => ['classic', 'gradient', 'video'],
				'selector' => '{{WRAPPER}} .topppa-logo-wrapper',
				'condition' => [
					'topppa_logo_styles' => 'style_four',
				],
			]
		);
		$this->add_responsive_control(
			'logo_box_radiuss',
			[
				'label' => esc_html__('Border Radius', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .topppa-logo-wrapper' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
					'condition' => [
					'topppa_logo_styles' => 'style_four',
				],
			]
		);
		$this->add_responsive_control(
			'logo_box_margin',
			[
				'label' => esc_html__('Margin', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em', 'rem', 'custom'],
				'selectors' => [
					'{{WRAPPER}} .topppa-logo-wrapper' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'topppa_logo_styles' => 'style_four',
				],
			]
		);
		$this->add_responsive_control(
			'logo_box_padding',
			[
				'label' => esc_html__('Padding', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em', 'rem', 'custom'],
				'selectors' => [
					'{{WRAPPER}} .topppa-logo-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'topppa_logo_styles' => 'style_four',
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
		$style_class = [
			'style_one' => 'style-one',
			'style_two' => 'style-two',
			'style_three' => 'style-three',
			'style_four' => 'style-four',
		];
		$class = isset($style_class[$settings['topppa_logo_styles']]) ? $style_class[$settings['topppa_logo_styles']] : '';
?>
		<div class="topppa-logo-wrapper <?php echo esc_attr($class); ?>">

			<?php if ($settings['topppa_logo_styles'] == 'style_two') : ?>
				<span class="topppa-logo-shape"></span>
				<span class="topppa-logo-shape-v2"></span>
			<?php endif; ?>

			<?php if ($settings['topppa_logo_styles'] == 'style_three') : ?>
				<span class="topppa-shape-img"><?php \Elementor\Icons_Manager::render_icon($settings['topppa_logo_shape_one'], ['aria-hidden' => 'true']); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- Already escaped by elementor 
											?></span>
				<span class="topppa-shape-img-v2"><?php \Elementor\Icons_Manager::render_icon($settings['topppa_logo_shape_two'], ['aria-hidden' => 'true']); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- Already escaped by elementor 
												?></span>
			<?php endif; ?>

			<?php if ($settings['topppa_select_logo'] === 'custom') : ?>
				<a href="<?php echo esc_url(home_url('/')); ?>">
					<?php
					$logo_alt = get_post_meta($settings['topppa_logo']['id'], '_wp_attachment_image_alt', true);
					$logo_title = get_the_title($settings['topppa_logo']['id']);
					?>
					<?php echo wp_get_attachment_image($settings['topppa_logo']['id'], 'full', false, array(
						'alt' => esc_attr($logo_alt),
						'title' => esc_attr($logo_title),
					)); ?>
				</a>
			<?php elseif (has_custom_logo()) : ?>
				<?php the_custom_logo(); ?>
			<?php else : ?>
				<h2>
					<a href="<?php echo esc_url(home_url('/')); ?>" rel="home">
						<?php esc_html(bloginfo('name')); ?>
					</a>
				</h2>
			<?php endif; ?>
		</div>
<?php
	}
}