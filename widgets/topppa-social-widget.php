<?php

use \TopperPack\Includes\Controls\Controls_Manager as TopperPack_Controls_Manager;

if (! defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}

/**
 * Elementor topppa Social Widget.
 *
 * Elementor widget that inserts an embbedable content into the page, from any given URL.
 *
 * @since 1.0.0
 */
class TOPPPA_Social_Widget extends \Elementor\Widget_Base {

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
		return 'topppa_social';
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
		return TOPPPA_EPWB . esc_html__('Social', 'topper-pack');
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
		return 'eicon-social-icons';
	}

	/**
	 * Get widget categories.
	 *
	 * Retrieve the list of categories the Social widget belongs to.
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
	 * Retrieve the list of keywords the Social widget belongs to.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return array Widget keywords.
	 */
	public function get_keywords() {
		return ['topppa', 'widget', 'social', 'topperpack'];
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
		return 'https://doc.topperpack.com/docs/header-footer-widgets/social';
	}

	/**
	 * Register widget controls.
	 *
	 * Add input fields to allow the user to customize the widget settings.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function register_controls() {

		// <========================> topppa SOCIAL OPTIONS <========================>
		$this->start_controls_section(
			'topppa_social_options',
			[
				'label' => esc_html__('topppa Social', 'topper-pack'),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
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
			]
		);
		$this->add_control(
			'social_share_titel',
			[
				'label' => esc_html__('Title', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__('Share', 'topper-pack'),
				'condition' => [
					'enable_title' => 'yes',
				],
			]
		);
		$repeater = new \Elementor\Repeater();
		$repeater->add_control(
			'social_label',
			[
				'label' => esc_html__('Label', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__('Facebook', 'topper-pack'),
			]
		);
		$repeater->add_control(
			'social_icon',
			[
				'label' => esc_html__('Icon', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::ICONS,
				'default' => [
					'value' => 'fab fa-facebook-f',
					'library' => 'solid',
				],
			]
		);

		$repeater->add_control(
			'topppa_icon_link',
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
			]
		);

		$this->add_control(
			'topppa_social_item',
			[
				'label'   => esc_html__('Icons List', 'topper-pack'),
				'type'    => \Elementor\Controls_Manager::REPEATER,
				'fields'  => $repeater->get_controls(),
				'default' => [
					[
						'topppa_icon_label' => esc_html__('Facebook', 'topper-pack'),
						'topppa_icon_link'  => '#',
						'social_icon' => [
							'value'   => 'fab fa-facebook-f',
							'library' => 'fa-regular',
						],
					],
					[
						'topppa_icon_label' => esc_html__('Twitter', 'topper-pack'),
						'topppa_icon_link'  => '#',
						'social_icon' => [
							'value'   => 'fab fa-twitter',
							'library' => 'fa-regular',
						],
					],
					[
						'topppa_icon_label' => esc_html__('Linkedin', 'topper-pack'),
						'topppa_icon_link'  => '#',
						'social_icon' => [
							'value'   => 'fab fa-linkedin-in',
							'library' => 'fa-regular',
						],
					],
					[
						'topppa_icon_label' => esc_html__('Instagram', 'topper-pack'),
						'topppa_icon_link'  => '#',
						'social_icon' => [
							'value'   => 'fab fa-instagram',
							'library' => 'fa-regular',
						],
					],
				],
				'title_field' => '{{{ topppa_icon_label }}}',
			]
		);
		$this->add_control(
			'hover_effect',
			[
				'label' => esc_html__('Hover Effect', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'float',
				'options' => [
					'none' => esc_html__('None', 'topper-pack'),
					'float' => esc_html__('Float', 'topper-pack'),
					'scale' => esc_html__('Scale', 'topper-pack'),
					'shake' => esc_html__('Shake', 'topper-pack'),
					'rotate' => esc_html__('Rotate', 'topper-pack'),
					'shine' => esc_html__('Shine', 'topper-pack'),
					'pulse' => esc_html__('Pulse', 'topper-pack'),
					'bounce' => esc_html__('Bounce', 'topper-pack'),
					'glitch' => esc_html__('Glitch', 'topper-pack'),
					'flip' => esc_html__('Flip', 'topper-pack'),
					'ripple' => esc_html__('Ripple', 'topper-pack'),
					'swing' => esc_html__('Swing', 'topper-pack'),
					'3d' => esc_html__('3D', 'topper-pack'),
					'neon' => esc_html__('Neon', 'topper-pack'),
					'reveal' => esc_html__('Reveal', 'topper-pack'),
					'bubble' => esc_html__('Bubble', 'topper-pack'),
				],
			]
		);
		$this->end_controls_section();

		// <========================> topppa SOCIAL STYLES <========================>
		$this->start_controls_section(
			'general_style',
			[
				'label' => esc_html__('General Style', 'topper-pack'),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_responsive_control(
			'item_space',
			[
				'label' => esc_html__('Item Space', 'topper-pack'),
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
					'{{WRAPPER}} .topppa-social-share .topppa-social-share-items' => 'gap: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'item_alignment',
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
				'default' => 'flex-start',
				'selectors' => [
					'{{WRAPPER}} .topppa-social-share' => 'justify-content: {{VALUE}};',
				],
			]
		);
		$this->add_responsive_control(
			'item_margin',
			[
				'label' => esc_html__('Margin', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em', 'rem', 'custom'],
				'selectors' => [
					'{{WRAPPER}} .topppa-social-share' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'item_padding',
			[
				'label' => esc_html__('Padding', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em', 'rem', 'custom'],
				'selectors' => [
					'{{WRAPPER}} .topppa-social-share' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'title_style',
			[
				'label' => esc_html__('Title Style', 'topper-pack'),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
				'condition' => [
					'enable_title' => 'yes',
				],
			]
		);
		$this->add_responsive_control(
			'title_color',
			[
				'label' => esc_html__('Color', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .topppa-social-title' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'selector' => '{{WRAPPER}} .topppa-social-title',
			]
		);
		$this->add_responsive_control(
			'title_gap',
			[
				'label' => esc_html__('Gap', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px', '%', 'em', 'rem', 'custom'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 50,
						'step' => 5,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .topppa-social-share' => 'gap: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'title_margin',
			[
				'label' => esc_html__('Margin', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em', 'rem', 'custom'],
				'selectors' => [
					'{{WRAPPER}} .topppa-social-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'title_padding',
			[
				'label' => esc_html__('Padding', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em', 'rem', 'custom'],
				'selectors' => [
					'{{WRAPPER}} .topppa-social-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();

		// Style Section
		$this->start_controls_section(
			'icon_style',
			[
				'label' => esc_html__('Icon Style', 'topper-pack'),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_responsive_control(
			'icon_position',
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
					'column' => [
						'title' => esc_html__('Top', 'topper-pack'),
						'icon' => 'eicon-v-align-top',
					],
					'column-reverse' => [
						'title' => esc_html__('Bottom', 'topper-pack'),
						'icon' => 'eicon-v-align-bottom',
					],
				],
				'toggle' => true,
				'selectors' => [
					'{{WRAPPER}} .topppa-social-share .topppa-social-share-items .topppa-share-item' => 'flex-direction: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'icon_alignment',
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
				'default' => 'center',
				'toggle' => true,
				'selectors' => [
					'{{WRAPPER}} .topppa-social-share .topppa-social-share-items .topppa-share-item' => 'justify-content: {{VALUE}};',
				],
			]
		);
		$this->add_responsive_control(
			'button_width',
			[
				'label' => esc_html__('Width', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px', '%', 'em', 'rem', 'custom'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 150,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .topppa-share-item' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'button_height',
			[
				'label' => esc_html__('Height', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px', '%', 'em', 'rem', 'custom'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 150,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .topppa-social-share .topppa-social-share-items .topppa-share-item' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'icon_gap',
			[
				'label' => esc_html__('Icon Gap', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px', '%', 'em', 'rem', 'custom'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 50,
						'step' => 5,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .topppa-social-share .topppa-social-share-items .topppa-share-item' => 'gap: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'icon_typography',
				'selector' => '{{WRAPPER}} .topppa-share-item',
			]
		);
		$this->add_responsive_control(
			'icon_margin',
			[
				'label' => esc_html__('Margin', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em', 'rem', 'custom'],
				'selectors' => [
					'{{WRAPPER}} .topppa-social-share .topppa-social-share-items .topppa-share-item' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'icon_padding',
			[
				'label' => esc_html__('Padding', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em', 'rem', 'custom'],
				'selectors' => [
					'{{WRAPPER}} .topppa-social-share .topppa-social-share-items .topppa-share-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->start_controls_tabs(
			'style_normal_tabs'
		);

		$this->start_controls_tab(
			'style_normal_tab',
			[
				'label' => esc_html__('Normal', 'topper-pack'),
			]
		);
		$this->add_responsive_control(
			'icon_color_normal',
			[
				'label' => esc_html__('Icon Color', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .topppa-share-item' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'icon_bg_normal',
				'types' => ['classic', 'gradient', 'video'],
				'selector' => '{{WRAPPER}} .topppa-share-item',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'icon_border_normal',
				'selector' => '{{WRAPPER}} .topppa-social-share .topppa-social-share-items .topppa-share-item',
			]
		);
		$this->add_responsive_control(
			'icon_radius_normal',
			[
				'label' => esc_html__('Radius', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px', '%', 'em', 'rem', 'custom'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
						'step' => 5,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .topppa-social-share .topppa-social-share-items .topppa-share-item' => 'border-radius: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'icon_box_shadow_normal',
				'selector' => '{{WRAPPER}} .topppa-share-item',
			]
		);
		$this->end_controls_tab();

		$this->start_controls_tab(
			'style_hover_tab',
			[
				'label' => esc_html__('Hover', 'topper-pack'),
			]
		);
		$this->add_responsive_control(
			'icon_color_hover',
			[
				'label' => esc_html__('Icon Color', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .topppa-share-item:hover' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'icon_bg_hover',
				'types' => ['classic', 'gradient', 'video'],
				'selector' => '{{WRAPPER}} .topppa-share-item:hover',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'icon_border_hover',
				'selector' => '{{WRAPPER}} .topppa-social-share .topppa-social-share-items .topppa-share-item:hover',
			]
		);
		$this->add_responsive_control(
			'icon_radius_hover',
			[
				'label' => esc_html__('Radius', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px', '%', 'em', 'rem', 'custom'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
						'step' => 5,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .topppa-social-share .topppa-social-share-items .topppa-share-item:hover' => 'border-radius: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'icon_box_shadow_hover',
				'selector' => '{{WRAPPER}} .topppa-share-item:hover',
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();
	}

	/**
	 * Render widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();
		// Your widget output here
?>


		<div class="topppa-social-share">
			<?php if (!empty($settings['social_share_titel'])) : ?>
				<div class="topppa-social-title"><?php echo esc_html($settings['social_share_titel']); ?></div>
			<?php endif; ?>

			<?php if (!empty($settings['topppa_social_item']) && is_array($settings['topppa_social_item'])) : ?>
				<div class="topppa-social-share-items">
					<?php foreach ($settings['topppa_social_item'] as $index => $item) :
						$has_link = !empty($item['topppa_icon_link']['url']);
						$link_key = 'topppa_title_link_' . $index;
						if ($has_link) {
							$this->add_link_attributes($link_key, $item['topppa_icon_link']);
						}
					?>
						<a <?php if ($has_link) $this->print_render_attribute_string($link_key); ?>
							class="topppa-share-item topppa-share-<?php echo esc_attr(strtolower($item['social_label'])); ?> hover-<?php echo esc_attr($settings['hover_effect']); ?>">
							<?php \Elementor\Icons_Manager::render_icon($item['social_icon'], ['aria-hidden' => 'true']); ?>
							<?php if (!empty($item['social_label'])) : ?>
								<span class="topppa-share-label">
									<?php echo esc_html($item['social_label']); ?>
								</span>
							<?php endif; ?>
						</a>
					<?php endforeach; ?>
				</div>
			<?php endif; ?>
		</div>
<?php
	}
}