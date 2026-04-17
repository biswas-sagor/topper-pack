<?php

use \TopperPack\Includes\Controls\Controls_Manager as TopperPack_Controls_Manager;
use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Image_Size;

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}

/**
 * Elementor topppa Pricing Table Widget.
 *
 * Elementor widget that inserts an embbedable content into the page, from any given URL.
 *
 * @since 1.0.0
 */
class TOPPPA_Product_Thumbnail_Widget extends \Elementor\Widget_Base {

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
		return 'topppa_product_thumbnail_widtget';
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
		return TOPPPA_EPWB . esc_html__('Product Thumbnail', 'topper-pack');
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
		return 'eicon-gallery-justified';
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
		return ['topppa', 'widget', 'product', 'store', 'product', 'topperpack', 'thumbnail'];
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
		return 'https://doc.topperpack.com/docs/woocommerce-widgets/product-thumbnail/';
	}

	/**
	 * Register Pricing Table Widget controls.
	 *
	 * Add input fields to allow the user to customize the widget settings.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function register_controls() {
		$this->start_controls_section(
			'content_section',
			[
				'label' => esc_html__('Settings', 'topper-pack'),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'enable_zoom_effect',
			[
				'label' => esc_html__('Enable Zoom View', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Show', 'topper-pack'),
				'label_off' => esc_html__('Hide', 'topper-pack'),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);
		$this->add_control(
			'use_selected_product',
			[
				'label'        => esc_html__('Select Specific Product?', 'topper-pack'),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__('Yes', 'topper-pack'),
				'label_off'    => esc_html__('No', 'topper-pack'),
				'return_value' => 'yes',
				'default'      => '',
			]
		);
		$this->add_control(
			'selected_product',
			[
				'label'     => esc_html__('Select Product', 'topper-pack'),
				'type'      => Controls_Manager::SELECT,
				'options'   => $this->get_all_products(),
				'default'   => '',
				'condition' => [
					'use_selected_product' => 'yes',
				],
			]
		);
		$this->add_control(
			'enable_link',
			[
				'label'        => esc_html__('Link to Product Page?', 'topper-pack'),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__('Yes', 'topper-pack'),
				'label_off'    => esc_html__('No', 'topper-pack'),
				'return_value' => 'yes',
				'default'      => '',
			]
		);
		$this->add_control(
			'link_target',
			[
				'label'     => esc_html__('Link Target', 'topper-pack'),
				'type'      => Controls_Manager::SELECT,
				'options'   => [
					'_self'  => esc_html__('Same Tab', 'topper-pack'),
					'_blank' => esc_html__('New Tab', 'topper-pack'),
				],
				'default'   => '_self',
				'condition' => [
					'enable_link' => 'yes',
				],
			]
		);
		$this->add_control(
			'alt_text',
			[
				'label'       => esc_html__('Custom Alt Text', 'topper-pack'),
				'type'        => Controls_Manager::TEXT,
				'placeholder' => esc_html__('Enter alt text...', 'topper-pack'),
			]
		);
		$this->add_control(
			'lazy_load',
			[
				'label'        => esc_html__('Enable Lazy Loading?', 'topper-pack'),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__('Yes', 'topper-pack'),
				'label_off'    => esc_html__('No', 'topper-pack'),
				'return_value' => 'yes',
				'default'      => 'yes',
			]
		);
		$this->add_control(
			'placeholder_image',
			[
				'label' => esc_html__('Placeholder Image', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'description' => esc_html__('This image will be shown in theme builder when no product is selected.', 'topper-pack'),
			]
		);
		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name'      => 'thumbnail_size',
				'default'   => 'full',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'style_section',
			[
				'label' => esc_html__('Style', 'topper-pack'),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_responsive_control(
			'thumbnail_width',
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
					'{{WRAPPER}} .product-thumbnail img' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'thumbnail_height',
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
					'{{WRAPPER}} .product-thumbnail img' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'thumbnail_object_fit',
			[
				'label'     => esc_html__('Object Fit', 'topper-pack'),
				'type'      => Controls_Manager::SELECT,
				'options'   => [
					'cover'    => esc_html__('Cover', 'topper-pack'),
					'contain'  => esc_html__('Contain', 'topper-pack'),
					'fill'     => esc_html__('Fill', 'topper-pack'),
					'none'     => esc_html__('None', 'topper-pack'),
				],
				'selectors' => [
					'{{WRAPPER}} .product-thumbnail img' => 'object-fit: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'thumbnail_border',
				'selector' => '{{WRAPPER}} .product-thumbnail img',
			]
		);
		$this->add_control(
			'thumbnail_border_radius',
			[
				'label' => esc_html__('Border Radius', 'topper-pack'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors' => [
					'{{WRAPPER}} .product-thumbnail img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'thumbnail_box_shadow',
				'selector' => '{{WRAPPER}} .product-thumbnail img',
			]
		);
		$this->end_controls_section();
	}
	protected function get_all_products() {
		$products = get_posts(['post_type' => 'product', 'numberposts' => -1]);
		$options  = [];
		if (!is_wp_error($products)) {
			foreach ($products as $product) {
				$options[$product->ID] = $product->post_title;
			}
		}
		return $options;
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

		if (!class_exists('WooCommerce')) {
			echo '<div class="elementor-alert elementor-alert-warning">';
			echo esc_html__('WooCommerce is not installed. Please install and activate WooCommerce to use this widget.', 'topper-pack');
			echo '</div>';
			return;
		}

		// Check if we're in theme builder
		$is_theme_builder = \Elementor\Plugin::$instance->editor->is_edit_mode();

		$settings    = $this->get_settings_for_display();
		$product_id  = '';

		if (!empty($settings['use_selected_product']) && !empty($settings['selected_product'])) {
			$product_id = $settings['selected_product'];
		} elseif (is_product() && !$is_theme_builder) {
			global $product;
			if ($product) {
				$product_id = $product->get_id();
			}
		}

		// If no product selected and not in theme builder, show warning
		if (!$product_id && !$is_theme_builder) {
			echo '<div class="elementor-alert elementor-alert-warning">';
			echo esc_html__('No product available.', 'topper-pack');
			echo '</div>';
			return;
		}

		$img_size    = $settings['thumbnail_size_size'] ?: 'full';
		$lazy        = !empty($settings['lazy_load']) ? 'loading="lazy"' : '';
		$img_class   = !empty($settings['custom_class']) ? esc_attr($settings['custom_class']) : '';
		$link_target = !empty($settings['link_target']) ? esc_attr($settings['link_target']) : '_self';
		$zoom_class  = ('yes' === $settings['enable_zoom_effect']) ? 'product-thumbnail-zoom' : '';

		echo '<div class="product-thumbnail ' . esc_attr($zoom_class) . '">';

		if ($is_theme_builder) {
			// Show placeholder image in theme builder
			$placeholder_url = !empty($settings['placeholder_image']['url']) ? $settings['placeholder_image']['url'] : '';
			$alt_text = esc_html__('Product Image', 'topper-pack');
			
			if (!empty($settings['enable_link'])) {
				echo '<a href="#" target="' . esc_attr($link_target) . '">';
			}

			echo '<img src="' . esc_url($placeholder_url) . '" alt="' . esc_attr($alt_text) . '" class="img-responsive ' . esc_attr($img_class) . '" ' . esc_attr($lazy) . '>'; // phpcs:ignore PluginCheck.CodeAnalysis.ImageFunctions.NonEnqueuedImage

			if (!empty($settings['enable_link'])) {
				echo '</a>';
			}
		} else {
			$product = wc_get_product($product_id);

			if (!$product) {
				echo '<div class="elementor-alert elementor-alert-warning">';
				echo esc_html__('Invalid product selected.', 'topper-pack');
				echo '</div>';
				return;
			}
			$alt_text = !empty($settings['alt_text']) ? esc_attr($settings['alt_text']) : esc_attr($product->get_name());
			$product_url = get_permalink($product_id);

			if (!empty($settings['enable_link'])) {
				echo '<a href="' . esc_url($product_url) . '" target="' . esc_attr($link_target) . '">';
			}
			echo wp_get_attachment_image($product->get_image_id(), $img_size, false, [
				'alt'   => $alt_text,
				'class' => 'img-responsive ' . $img_class,
				$lazy
			]);
			if (!empty($settings['enable_link'])) {
				echo '</a>';
			}
		}
		echo '</div>';
	}
}