<?php

use \TopperPack\Includes\Controls\Controls_Manager as TopperPack_Controls_Manager;

if (! defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}

/**
 * Elementor Text Reveal Widget.
 *
 * Elementor widget that inserts text reveal animation into the page.
 *
 * @since 1.0.0
 */
class TOPPPA_Text_Reveal_Widget extends \Elementor\Widget_Base {

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
		return 'TOPPPA_Text_Reveal_Widget';
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
		return TOPPPA_EPWB . esc_html__('Text Reveal', 'topper-pack');
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
		return 'eicon-text-reveal';
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
		return ['topppa', 'widget', 'Text Reveal', 'text', 'topperpack', 'animation'];
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
		return 'https://doc.topperpack.com/docs/general-widgets/text-reveal/';
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
		return 'https://topperpack.com/assets/widgets/text-reveal-widget/';
	}

	/**
	 * Get script dependencies.
	 *
	 * Retrieve the list of script dependencies the widget requires.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return array Widget scripts dependencies.
	 */
	public function get_script_depends() {
		return ['topppa-text-reveal-widget'];
	}

	/**
	 * Get style dependencies.
	 *
	 * Retrieve the list of style dependencies the widget requires.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return array Widget styles dependencies.
	 */
	public function get_style_depends() {
		return ['topppa-text-reveal-widget'];
	}

	/**
	 * Register Text Reveal widget controls.
	 *
	 * Add input fields to allow the user to customize the widget settings.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function register_controls() {
		$base_url = $this->get_custom_image_url();

		// Content Section
		$this->start_controls_section(
			'content_section',
			[
				'label' => esc_html__('Content', 'topper-pack'),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'widget_info',
			[
				'type' => \Elementor\Controls_Manager::RAW_HTML,
				'raw' => esc_html__('This widget creates a text reveal animation effect. The text will be revealed as the user scrolls.', 'topper-pack'),
				'content_classes' => 'elementor-panel-alert elementor-panel-alert-info',
			]
		);

		// Text Content
		$this->add_control(
			'text_content',
			[
				'label' => esc_html__('Text Content', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'default' => 'AMAZING EXPERIENCES',
				'placeholder' => esc_html__('Enter your text here', 'topper-pack'),
				'label_block' => true,
			]
		);

		// Background Type
		$this->add_control(
			'background_type',
			[
				'label' => esc_html__('Background Type', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'color',
				'options' => [
					'color' => esc_html__('Color', 'topper-pack'),
					'gradient' => esc_html__('Gradient', 'topper-pack'),
					'image' => esc_html__('Image', 'topper-pack'),
				],
			]
		);

		// Background Color
		$this->add_control(
			'background_color',
			[
				'label' => esc_html__('Background Color', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#ffffff',
				'condition' => [
					'background_type' => 'color',
				],
			]
		);

		// Gradient Colors
		$this->add_control(
			'gradient_color_1',
			[
				'label' => esc_html__('Gradient Color 1', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#2c3e50',
				'condition' => [
					'background_type' => 'gradient',
				],
			]
		);

		$this->add_control(
			'gradient_color_2',
			[
				'label' => esc_html__('Gradient Color 2', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#34495e',
				'condition' => [
					'background_type' => 'gradient',
				],
			]
		);

		// Background Image
		$this->add_control(
			'background_image',
			[
				'label' => esc_html__('Background Image', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'condition' => [
					'background_type' => 'image',
				],
			]
		);

		// Reveal Color
		$this->add_control(
			'reveal_color',
			[
				'label' => esc_html__('Reveal Color', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#333333',
			]
		);

		// Text Color
		$this->add_control(
			'text_color',
			[
				'label' => esc_html__('Text Color', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#333333',
			]
		);

		// Text Opacity
		$this->add_control(
			'text_opacity',
			[
				'label' => esc_html__('Text Opacity', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['%'],
				'range' => [
					'%' => [
						'min' => 0,
						'max' => 100,
						'step' => 1,
					],
				],
				'default' => [
					'unit' => '%',
					'size' => 20,
				],
			]
		);

		// Text Alignment
		$this->add_control(
			'text_alignment',
			[
				'label' => esc_html__('Text Alignment', 'topper-pack'),
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
				'toggle' => true,
			]
		);

		$this->end_controls_section();

		// Style Section
		$this->start_controls_section(
			'style_section',
			[
				'label' => esc_html__('Style', 'topper-pack'),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		// Section Height
		$this->add_control(
			'section_height',
			[
				'label' => esc_html__('Section Height', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['vh', 'px'],
				'range' => [
					'vh' => [
						'min' => 30,
						'max' => 100,
					],
					'px' => [
						'min' => 300,
						'max' => 1200,
					],
				],
				'default' => [
					'unit' => 'vh',
					'size' => 100,
				],
			]
		);

		// Text Typography
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'text_typography',
				'selector' => '{{WRAPPER}} .topppa-text-area h1',
				'default' => [
					'font_family' => 'Montserrat',
					'font_weight' => '600',
				],
			]
		);

		// Animation Settings
		$this->add_control(
			'heading_animation',
			[
				'label' => esc_html__('Animation', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'animation_duration',
			[
				'label' => esc_html__('Animation Duration', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['s'],
				'range' => [
					's' => [
						'min' => 0.1,
						'max' => 5,
						'step' => 0.1,
					],
				],
				'default' => [
					'unit' => 's',
					'size' => 0.1,
				],
			]
		);

		$this->add_control(
			'animation_delay',
			[
				'label' => esc_html__('Text Delay', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['%'],
				'range' => [
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default' => [
					'unit' => '%',
					'size' => 40,
				],
			]
		);

		$this->end_controls_section();
	}

	/**
	 * Render Text Reveal widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();
		$widget_id = $this->get_id();

		// Get settings
		$text_content = isset($settings['text_content']) ? $settings['text_content'] : 'AMAZING EXPERIENCES';
		$section_height = isset($settings['section_height']) ? $settings['section_height']['size'] . $settings['section_height']['unit'] : '100vh';
		$animation_duration = isset($settings['animation_duration']) ? $settings['animation_duration']['size'] : 0.1;
		$animation_delay = isset($settings['animation_delay']) ? $settings['animation_delay']['size'] : 40;
		$text_alignment = isset($settings['text_alignment']) ? $settings['text_alignment'] : 'left';
		$reveal_color = isset($settings['reveal_color']) ? $settings['reveal_color'] : '#333333';
		$text_color = isset($settings['text_color']) ? $settings['text_color'] : '#333333';
		$text_opacity = isset($settings['text_opacity']) ? $settings['text_opacity']['size'] : 20;

		// Handle background based on type
		$background_style = '';
		if ($settings['background_type'] === 'gradient') {
			$background_style = 'background: linear-gradient(135deg, ' . esc_attr($settings['gradient_color_1']) . ' 0%, ' . esc_attr($settings['gradient_color_2']) . ' 100%);';
		} elseif ($settings['background_type'] === 'image' && !empty($settings['background_image']['url'])) {
			$background_style = 'background-image: url(' . esc_url($settings['background_image']['url']) . '); background-size: cover; background-position: center;';
		} elseif ($settings['background_type'] === 'color' && !empty($settings['background_color'])) {
			$background_style = 'background-color: ' . esc_attr($settings['background_color']) . ';';
		}
		
		// Convert text color to RGBA with specified opacity
		$text_color_rgba = $this->convert_to_rgba_with_alpha($text_color, $text_opacity / 100);
?>

		<!-- Text Reveal Animation HTML -->
		<div class="topppa-text-reveal topppa-text-reveal-<?php echo esc_attr($widget_id); ?>">
			<div
				class="topppa-reveal-section topppa-reveal-section-<?php echo esc_attr($widget_id); ?>"
				data-duration="<?php echo esc_attr($animation_duration); ?>"
				data-delay="<?php echo esc_attr($animation_delay); ?>"
				data-height="<?php echo esc_attr($section_height); ?>"
				style="<?php echo esc_attr($background_style); ?>">
				<div class="topppa-text-area topppa-text-area-<?php echo esc_attr($widget_id); ?>" style="text-align: <?php echo esc_attr($text_alignment); ?>;">
					<h1 style="--reveal-color: <?php echo esc_attr($reveal_color); ?>; color: <?php echo esc_attr($text_color_rgba); ?>;"><?php echo esc_html($text_content); ?></h1>
				</div>
			</div>
		</div>

<?php
	}
	
	/**
	 * Convert color to RGBA with specified alpha
	 *
	 * @param string $color The color value
	 * @param float $alpha The alpha value (0.0 to 1.0)
	 * @return string RGBA color value
	 */
	private function convert_to_rgba_with_alpha($color, $alpha) {
		// If already RGBA, extract RGB values and apply new alpha
		if (preg_match('/^rgba\(\s*(\d+)\s*,\s*(\d+)\s*,\s*(\d+)\s*,\s*([0-9.]+)\s*\)$/', $color, $matches)) {
			return 'rgba(' . $matches[1] . ', ' . $matches[2] . ', ' . $matches[3] . ', ' . $alpha . ')';
		}
		
		// If RGB, convert to RGBA with specified alpha
		if (preg_match('/^rgb\(\s*(\d+)\s*,\s*(\d+)\s*,\s*(\d+)\s*\)$/', $color, $matches)) {
			return 'rgba(' . $matches[1] . ', ' . $matches[2] . ', ' . $matches[3] . ', ' . $alpha . ')';
		}
		
		// If hex color, convert to RGBA with specified alpha
		if (preg_match('/^#([a-f0-9]{6}|[a-f0-9]{3})$/i', $color)) {
			return $this->hex_to_rgba($color, $alpha);
		}
		
		// If it's a named color or other format, return with specified alpha
		return 'rgba(51, 51, 51, ' . $alpha . ')';
	}
	
	/**
	 * Convert hex color to RGBA
	 *
	 * @param string $hex The hex color value
	 * @param float $alpha The alpha value (0.0 to 1.0)
	 * @return string RGBA color value
	 */
	private function hex_to_rgba($hex, $alpha) {
		$hex = ltrim($hex, '#');
		
		if (strlen($hex) == 3) {
			$r = hexdec(str_repeat(substr($hex, 0, 1), 2));
			$g = hexdec(str_repeat(substr($hex, 1, 1), 2));
			$b = hexdec(str_repeat(substr($hex, 2, 1), 2));
		} else {
			$r = hexdec(substr($hex, 0, 2));
			$g = hexdec(substr($hex, 2, 2));
			$b = hexdec(substr($hex, 4, 2));
		}
		
		return 'rgba(' . $r . ', ' . $g . ', ' . $b . ', ' . $alpha . ')';
	}
}