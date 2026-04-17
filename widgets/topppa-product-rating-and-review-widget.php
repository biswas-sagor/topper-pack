<?php
use \TopperPack\Includes\Controls\Controls_Manager as TopperPack_Controls_Manager;
use \Elementor\Controls_Manager;
use \Elementor\Widget_Base;

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}

/**
 * Elementor topppa Product Rating and Reviews Widget.
 *
 * Elementor widget that displays the product rating and reviews.
 *
 * @since 1.0.0
 */
class TOPPPA_Product_Rating_And_Reviews_Widget extends Widget_Base {

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
		return 'topppa_product_rating_and_reviews_widget';
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
		return TOPPPA_EPWB . esc_html__('Product Rating/Reviews', 'topper-pack');
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
		return 'eicon-product-rating';
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
	 * Get custom help URL.
	 *
	 * Retrieve a URL where the user can get more information about the widget.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget help URL.
	 */
	public function get_custom_help_url() {
		return 'https://doc.topperpack.com/docs/woocommerce-widgets/product-rating-review/';
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
		return ['product', 'rating', 'reviews', 'store', 'woocommerce','topppa', 'topperpack'];
	}

	/**
	 * Register Product Rating and Reviews Widget controls.
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
			'divider',
			[
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_control(
			'show_title',
			[
				'label'        => esc_html__('Show Title', 'topper-pack'),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__('Yes', 'topper-pack'),
				'label_off'    => esc_html__('No', 'topper-pack'),
				'return_value' => 'yes',
				'default'      => 'yes',
			]
		);
		$this->add_control(
			'review_title',
			[
				'label'       => esc_html__('Review Title', 'topper-pack'),
				'type'        => Controls_Manager::TEXT,
				'default'     => esc_html__('Customer Reviews', 'topper-pack'),
				'label_block' => true,
				'dynamic'     => [
					'active' => true,
				],
				'condition' => [
					'show_title' => 'yes'
				]
			]
		);
		$this->add_control(
			'divider2',
			[
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_control(
			'show_reviews',
			[
				'label'        => esc_html__('Show Reviews?', 'topper-pack'),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__('Yes', 'topper-pack'),
				'label_off'    => esc_html__('No', 'topper-pack'),
				'return_value' => 'yes',
				'default'      => 'yes',
			]
		);

		$this->add_control(
			'show_rating',
			[
				'label'        => esc_html__('Show Rating?', 'topper-pack'),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__('Yes', 'topper-pack'),
				'label_off'    => esc_html__('No', 'topper-pack'),
				'return_value' => 'yes',
				'default'      => 'yes',
			]
		);

		$this->add_control(
			'show_percentage',
			[
				'label'        => esc_html__('Show Percentage', 'topper-pack'),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__('Yes', 'topper-pack'),
				'label_off'    => esc_html__('No', 'topper-pack'),
				'return_value' => 'yes',
				'default'      => 'no',
				'condition'    => [
					'show_rating' => 'yes',
				],
			]
		);
		$this->add_control(
			'show_rating_count',
			[
				'label'        => esc_html__('Show Rating Count', 'topper-pack'),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__('Yes', 'topper-pack'),
				'label_off'    => esc_html__('No', 'topper-pack'),
				'return_value' => 'yes',
				'default'      => 'yes',
				'condition'    => [
					'show_rating' => 'yes',
				],
			]
		);
		$this->add_control(
			'show_author',
			[
				'label'        => esc_html__('Show Author', 'topper-pack'),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__('Yes', 'topper-pack'),
				'label_off'    => esc_html__('No', 'topper-pack'),
				'return_value' => 'yes',
				'default'      => 'yes',
			]
		);

		$this->add_control(
			'show_comment',
			[
				'label'        => esc_html__('Show Comments', 'topper-pack'),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__('Yes', 'topper-pack'),
				'label_off'    => esc_html__('No', 'topper-pack'),
				'return_value' => 'yes',
				'default'      => 'yes',
			]
		);
		$this->add_control(
			'show_date_time',
			[
				'label'        => esc_html__('Show Date Time', 'topper-pack'),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__('Yes', 'topper-pack'),
				'label_off'    => esc_html__('No', 'topper-pack'),
				'return_value' => 'yes',
				'default'      => 'yes',
			]
		);
		$this->end_controls_section();

		// <==========>
		// <==========> RATING STAR STYLES <==========>

		$this->start_controls_section(
			'rating_styles',
			[
				'label' => esc_html__('Rating Star', 'topper-pack'),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
				'condition' => [
					'show_rating' => 'yes',
				]
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'rating_typo',
				'selector' => '{{WRAPPER}} .topppa-product-rating .rating-stars .stars i',
			]
		);
		$this->add_responsive_control(
			'rating_color',
			[
				'label'     => esc_html__('Color', 'topper-pack'),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .topppa-product-rating .rating-stars .stars i' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_responsive_control(
			'rating_margin',
			[
				'label'      => esc_html__('Margin', 'topper-pack'),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors'  => [
					'{{WRAPPER}} .topppa-product-rating .rating-stars .stars i' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'rating_padding',
			[
				'label'      => esc_html__('Padding', 'topper-pack'),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors'  => [
					'{{WRAPPER}} .topppa-product-rating .rating-stars .stars i' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();

		// <==========>
		// <==========> REVIEW COUNT STYLES <==========>

		$this->start_controls_section(
			'review_count_styles',
			[
				'label' => esc_html__('Review Count', 'topper-pack'),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
				'condition' => [
					'show_rating_count' => 'yes',
				]
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'review_count_typo',
				'selector' => '{{WRAPPER}} .topppa-product-rating .rating-count',
			]
		);
		$this->add_responsive_control(
			'review_count_color',
			[
				'label'     => esc_html__('Color', 'topper-pack'),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .topppa-product-rating .rating-count' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_responsive_control(
			'review_count_margin',
			[
				'label'      => esc_html__('Margin', 'topper-pack'),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors'  => [
					'{{WRAPPER}} .topppa-product-rating .rating-count' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'review_count_padding',
			[
				'label'      => esc_html__('Padding', 'topper-pack'),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors'  => [
					'{{WRAPPER}} .topppa-product-rating .rating-count' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();

		// <==========>
		// <==========> REVIEW TITLE STYLES <==========>

		$this->start_controls_section(
			'review_title_styles',
			[
				'label' => esc_html__('Review Title', 'topper-pack'),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
				'condition' => [
					'show_title' => 'yes',
				]
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'review_title_typo',
				'selector' => '{{WRAPPER}} .topppa-product-reviews .review-title',
			]
		);
		$this->add_responsive_control(
			'review_title_color',
			[
				'label'     => esc_html__('Color', 'topper-pack'),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .topppa-product-reviews .review-title' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_responsive_control(
			'review_title_margin',
			[
				'label'      => esc_html__('Margin', 'topper-pack'),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors'  => [
					'{{WRAPPER}} .topppa-product-reviews .review-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'review_title_padding',
			[
				'label'      => esc_html__('Padding', 'topper-pack'),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors'  => [
					'{{WRAPPER}} .topppa-product-reviews .review-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();

		// <==========>
		// <==========> AUTHOR STYLES <==========>

		$this->start_controls_section(
			'author_styles',
			[
				'label' => esc_html__('Author', 'topper-pack'),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
				'condition' => [
					'show_author' => 'yes',
				]
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'author_typo',
				'selector' => '{{WRAPPER}} .review-item .review-author',
			]
		);
		$this->add_responsive_control(
			'author_color',
			[
				'label'     => esc_html__('Color', 'topper-pack'),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .review-item .review-author' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_responsive_control(
			'author_margin',
			[
				'label'      => esc_html__('Margin', 'topper-pack'),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors'  => [
					'{{WRAPPER}} .review-item .review-author' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'author_padding',
			[
				'label'      => esc_html__('Padding', 'topper-pack'),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors'  => [
					'{{WRAPPER}} .review-item .review-author' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();

		// <==========>
		// <==========> DATE STYLES <==========>

		$this->start_controls_section(
			'review_date_styles',
			[
				'label' => esc_html__('Date Title', 'topper-pack'),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
				'condition' => [
					'show_date_time' => 'yes',
				]
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'review_date_typo',
				'selector' => '{{WRAPPER}} .review-item .review-date',
			]
		);
		$this->add_responsive_control(
			'review_date_color',
			[
				'label'     => esc_html__('Color', 'topper-pack'),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .review-item .review-date' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_responsive_control(
			'review_date_margin',
			[
				'label'      => esc_html__('Margin', 'topper-pack'),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors'  => [
					'{{WRAPPER}} .review-item .review-date' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'review_date_padding',
			[
				'label'      => esc_html__('Padding', 'topper-pack'),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors'  => [
					'{{WRAPPER}} .review-item .review-date' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();

		// <==========>
		// <==========> COMMENT STYLES <==========>

		$this->start_controls_section(
			'review_content_styles',
			[
				'label' => esc_html__('Review Comment', 'topper-pack'),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
				'condition' => [
					'show_comment' => 'yes',
				]
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'review_content_typo',
				'selector' => '{{WRAPPER}} .review-item .review-content',
			]
		);
		$this->add_responsive_control(
			'review_content_color',
			[
				'label'     => esc_html__('Color', 'topper-pack'),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .review-item .review-content' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_responsive_control(
			'review_content_margin',
			[
				'label'      => esc_html__('Margin', 'topper-pack'),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors'  => [
					'{{WRAPPER}} .review-item .review-content' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'review_content_padding',
			[
				'label'      => esc_html__('Padding', 'topper-pack'),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors'  => [
					'{{WRAPPER}} .review-item .review-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();
	}

	/**
	 * Get all products.
	 *
	 * Retrieve all WooCommerce products for selection in the widget controls.
	 *
	 * @since 1.0.0
	 * @access protected
	 * @return array Product options.
	 */
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
	 * Render product rating and reviews widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();

		// Check if WooCommerce is installed and active
		if (!class_exists('WooCommerce')) {
			echo '<div class="elementor-alert elementor-alert-warning">';
			echo esc_html__('WooCommerce is not installed. Please install and activate WooCommerce to use this widget.', 'topper-pack');
			echo '</div>';
			return;
		}

		// Check if we're in theme builder
		$is_theme_builder = \Elementor\Plugin::$instance->editor->is_edit_mode();

		$product_id = '';

		// If a specific product is selected, use that
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

		// Display Reviews
		if ('yes' === $settings['show_reviews']) {
			if ($is_theme_builder) {
				$this->render_dummy_reviews($settings);
			} else {
				$product = wc_get_product($product_id);
				if (!$product) {
					echo '<div class="elementor-alert elementor-alert-warning">';
					echo esc_html__('Invalid product selected.', 'topper-pack');
					echo '</div>';
					return;
				}
				$this->render_reviews($product);
			}
		}
	}

	/**
	 * Render dummy reviews for theme builder.
	 *
	 * Display sample reviews when in theme builder.
	 *
	 * @since 1.0.0
	 * @access private
	 * @param array $settings Widget settings.
	 */
	private function render_dummy_reviews($settings) {
		$show_rating = $settings['show_rating'] === 'yes';
		$show_percentage = $settings['show_percentage'] === 'yes';
		$show_rating_count = $settings['show_rating_count'] === 'yes';
		$show_title = $settings['show_title'] === 'yes';
		$show_author = $settings['show_author'] === 'yes';
		$show_comment = $settings['show_comment'] === 'yes';
		$show_date_time = $settings['show_date_time'] === 'yes';
		$review_title = $settings['review_title'] ?: esc_html__('Customer Reviews', 'topper-pack');

		echo '<div class="topppa-product-rating-review">';

		// Show dummy rating
		if ($show_rating) {
			echo '<div class="topppa-product-rating">';
			$dummy_rating = 4.5; // Sample rating

			if ($show_percentage) {
				$rating_percentage = ($dummy_rating / 5) * 100;
				echo '<span class="rating-percentage">' . esc_html(round($rating_percentage, 2)) . '%</span>';
			} else {
				echo '<span class="rating-stars">' . wp_kses_post($this->generate_star_rating($dummy_rating)) . '</span>';
			}

			if ($show_rating_count) {
				echo '<span class="rating-count"> (' . esc_html__('12 reviews', 'topper-pack') . ')</span>';
			}

			echo '</div>';
		}

		// Show dummy reviews
		echo '<div class="topppa-product-reviews">';
		if ($show_title) {
			echo '<h4 class="review-title">' . esc_html($review_title) . '</h4>';
		}

		// Sample review 1
		echo '<div class="review-item">';
		if ($show_author) {
			echo '<p class="review-author"><strong>' . esc_html__('John Doe', 'topper-pack') . '</strong></p>';
		}
		if ($show_date_time) {
			echo '<p class="review-date">' . esc_html(date_i18n('F j, Y')) . '</p>';
		}
		if ($show_comment) {
			echo '<p class="review-content">' . esc_html__('Excellent product! The quality is outstanding and I am very satisfied with my purchase. Would definitely recommend to others.', 'topper-pack') . '</p>';
		}
		echo '</div>';

		// Sample review 2
		echo '<div class="review-item">';
		if ($show_author) {
			echo '<p class="review-author"><strong>' . esc_html__('Jane Smith', 'topper-pack') . '</strong></p>';
		}
		if ($show_date_time) {
			echo '<p class="review-date">' . esc_html(date_i18n('F j, Y', strtotime('-1 day'))) . '</p>';
		}
		if ($show_comment) {
			echo '<p class="review-content">' . esc_html__('Good product overall. The packaging could be improved, but the product itself meets expectations.', 'topper-pack') . '</p>';
		}
		echo '</div>';

		// Sample review 3
		echo '<div class="review-item">';
		if ($show_author) {
			echo '<p class="review-author"><strong>' . esc_html__('Mike Johnson', 'topper-pack') . '</strong></p>';
		}
		if ($show_date_time) {
			echo '<p class="review-date">' . esc_html(date_i18n('F j, Y', strtotime('-2 days'))) . '</p>';
		}
		if ($show_comment) {
			echo '<p class="review-content">' . esc_html__('Fast shipping and great customer service. The product is exactly as described.', 'topper-pack') . '</p>';
		}
		echo '</div>';

		echo '</div>'; // End topppa-product-reviews
		echo '</div>'; // End topppa-product-rating-review
	}

	/**
	 * Render star rating.
	 *
	 * Display the rating as stars.
	 *
	 * @since 1.0.0
	 * @access private
	 * @param float $rating Product rating.
	 */
	private function render_star_rating($rating) {
		if ($rating) {
			echo '<div class="topppa-product-rating">';
			echo wp_kses_post(wc_get_rating_html($rating)); // WooCommerce function to display star ratings
			echo '</div>';
		} else {
			echo '<div class="topppa-product-rating">';
			echo esc_html__('No rating available.', 'topper-pack');
			echo '</div>';
		}
	}

	/**
	 * Render percentage rating.
	 *
	 * Display the rating as percentage.
	 *
	 * @since 1.0.0
	 * @access private
	 * @param float $rating Product rating.
	 */
	private function render_percentage_rating($rating) {
		if ($rating) {
			$percentage = ($rating / 5) * 100;
			echo '<div class="topppa-product-rating">';
			echo '<div class="topppa-rating-percent" style="width: ' . esc_attr($percentage) . '%;">' . esc_html(number_format($percentage, 2)) . '%</div>';
			echo '</div>';
		} else {
			echo '<div class="topppa-product-rating">';
			echo esc_html__('No rating available.', 'topper-pack');
			echo '</div>';
		}
	}

	/**
	 * Generate star rating HTML.
	 *
	 * @param float $rating The product rating.
	 * @return string HTML for the star rating.
	 */
	private function generate_star_rating($rating) {
		$rating_html = '';
		if ($rating > 0) {
			// translators: %s is the rating
			$rating_html = '<div class="star-rating" role="img" aria-label="' . sprintf(esc_attr__('Rated %s out of 5', 'topper-pack'), $rating) . '">';
			// translators: %s is the rating
			$rating_html .= '<span style="width:' . (($rating / 5) * 100) . '%">' . sprintf(esc_html__('Rated %s out of 5', 'topper-pack'), $rating) . '</span>';
			$rating_html .= '</div>';
		}
		return $rating_html;
	}

	/**
	 * Render product reviews.
	 *
	 * Display the reviews for the product.
	 *
	 * @since 1.0.0
	 * @access private
	 * @param object $product WooCommerce product object.
	 */
	private function render_reviews($product) {
		$product_id = $product->get_id();

		// Get product rating and reviews
		$average_rating = $product->get_average_rating();
		$rating_count = $product->get_review_count();
		$reviews = get_comments([
			'post_id' => $product_id,
			'status'  => 'approve', // Only approved reviews
		]);

		// Get Elementor settings
		$settings = $this->get_settings_for_display();
		$show_rating = $settings['show_rating'] === 'yes';
		$show_reviews = $settings['show_reviews'] === 'yes';
		$show_percentage = $settings['show_percentage'] === 'yes';
		$show_rating_count = $settings['show_rating_count'] === 'yes';
		$show_title = $settings['show_title'] === 'yes';
		$show_author = $settings['show_author'] === 'yes';
		$show_comment = $settings['show_comment'] === 'yes';
		$show_date_time = $settings['show_date_time'] === 'yes';
		$review_title = $settings['review_title'] ?: esc_html__('Customer Reviews', 'topper-pack');

		echo '<div class="topppa-product-rating-review">';

		// Show rating if enabled and there is a rating
		if ($show_rating && $average_rating > 0) {
			echo '<div class="topppa-product-rating">';

			// Show percentage or stars
			if ($show_percentage) {
				$rating_percentage = ($average_rating / 5) * 100;
				echo '<span class="rating-percentage">' . esc_html(round($rating_percentage, 2)) . '%</span>';
			} else {
				echo '<span class="rating-stars">' . wp_kses_post($this->generate_star_rating($average_rating)) . '</span>';
			}

			// Show rating count if enabled
			if ($show_rating_count) {
				echo '<span class="rating-count"> (' . esc_html($rating_count) . ' ' . esc_html__('reviews', 'topper-pack') . ')</span>';
			}

			echo '</div>';
		}

		// Display product reviews if enabled
		if ($show_reviews) {
			if (!empty($reviews)) {
				echo '<div class="topppa-product-reviews">';
				if ($show_title) {
					echo '<h4 class="review-title">' . esc_html($review_title) . '</h4>';
				}

				foreach ($reviews as $review) {
					echo '<div class="review-item">';
					if ($show_author) {
						echo '<p class="review-author"><strong>' . esc_html($review->comment_author) . '</strong></p>';
					}
					if ($show_date_time) {
						echo '<p class="review-date">' . esc_html(date_i18n('F j, Y', strtotime($review->comment_date))) . '</p>';
					}
					if ($show_comment) {
						echo '<p class="review-content">' . esc_html($review->comment_content) . '</p>';
					}
					echo '</div>';
				}
				echo '</div>';
			} else {
				// Only show "No reviews available" message in Elementor editor
				if (\Elementor\Plugin::$instance->editor->is_edit_mode()) {
					echo '<div class="topppa-no-reviews">';
					echo esc_html__('No reviews available.', 'topper-pack');
					echo '</div>';
				}
			}
		}

		echo '</div>';
	}
}