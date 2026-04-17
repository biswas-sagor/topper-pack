<?php

use \TopperPack\Includes\Controls\Controls_Manager as TopperPack_Controls_Manager;
use \Elementor\Controls_Manager;
use \Elementor\Widget_Base;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

/**
 * Elementor Product Review and Comment Widget.
 *
 * A widget that allows users to submit reviews and comments on a WooCommerce product single page.
 *
 * @since 1.0.0
 */
class TOPPPA_Product_Review_Comment_Widget extends Widget_Base {

    /**
     * Get widget name.
     *
     * Retrieve the widget name.
     *
     * @since 1.0.0
     * @access public
     * @return string Widget name.
     */
    public function get_name() {
        return 'topppa_product_review_comment';
    }

    /**
     * Get widget title.
     *
     * Retrieve the widget title.
     *
     * @since 1.0.0
     * @access public
     * @return string Widget title.
     */
    public function get_title() {
        return TOPPPA_EPWB . esc_html__('Product Review/Comment', 'topper-pack');
    }

    /**
     * Get widget icon.
     *
     * Retrieve the widget icon.
     *
     * @since 1.0.0
     * @access public
     * @return string Widget icon.
     */
    public function get_icon() {
        return 'eicon-review';
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
        return ['product', 'review', 'comment', 'woocommerce', 'topppa', 'topperpack'];
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
		return 'https://doc.topperpack.com/docs/woocommerce-widgets/product-review-comment/';
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
        // Content Section
        $this->start_controls_section(
            'content_section',
            [
                'label' => esc_html__('Settings', 'topper-pack'),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );
        // Title for Review Section
        $this->add_control(
            'review_section_title',
            [
                'label'       => esc_html__('Review Section Title', 'topper-pack'),
                'type'        => Controls_Manager::TEXT,
                'default'     => esc_html__('Reviews', 'topper-pack'),
                'placeholder' => esc_html__('Enter the title for the review section', 'topper-pack'),
            ]
        );

        $this->end_controls_section();

        // <==========>
        // <==========> BOX STYLES <==========>

        $this->start_controls_section(
            'box_styles',
            [
                'label' => esc_html__('Input Box', 'topper-pack'),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'box_bg',
                'label' => esc_html__('Background', 'topper-pack'),
                'types' => ['classic', 'gradient', 'video'],
                'selector' => '{{WRAPPER}} .topppa-product-review-comment form#commentform',
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'box_border',
                'label' => esc_html__('Border', 'topper-pack'),
                'selector' => '{{WRAPPER}} .topppa-product-review-comment form#commentform',
            ]
        );
        $this->add_responsive_control(
            'box_radius',
            [
                'label' => esc_html__('Border Radius', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .topppa-product-review-comment form#commentform' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'box_shadow',
                'label' => esc_html__('Box Shadow', 'topper-pack'),
                'selector' => '{{WRAPPER}} .topppa-product-review-comment form#commentform',
            ]
        );
        $this->add_responsive_control(
            'box_margin',
            [
                'label' => esc_html__('Margin', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .topppa-product-review-comment form#commentform' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                    '{{WRAPPER}} .topppa-product-review-comment form#commentform' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'title_typo',
                'selector' => '{{WRAPPER}} .topppa-product-review-title',
            ]
        );
        $this->add_responsive_control(
            'title_color',
            [
                'label'     => esc_html__('Color', 'topper-pack'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .topppa-product-review-title' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_responsive_control(
            'title_margin',
            [
                'label'      => esc_html__('Margin', 'topper-pack'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .topppa-product-review-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'title_padding',
            [
                'label'      => esc_html__('Padding', 'topper-pack'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .topppa-product-review-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();

        // <==========>
        // <==========> TITLE STYLES <==========>

        $this->start_controls_section(
            'logged_in_styles',
            [
                'label' => esc_html__('Logged In Text', 'topper-pack'),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'logged_in_typo',
                'selector' => '{{WRAPPER}} .p.logged-in-as, .topppa-product-review-comment div#respond, .topppa-product-review-comment article',
            ]
        );
        $this->add_responsive_control(
            'logged_in_color',
            [
                'label'     => esc_html__('Color', 'topper-pack'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .p.logged-in-as, .topppa-product-review-comment div#respond, .topppa-product-review-comment article' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_responsive_control(
            'logged_in_link',
            [
                'label'     => esc_html__('Link Color', 'topper-pack'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .p.logged-in-as a, .topppa-product-review-comment div#respond a, .topppa-product-review-comment article a' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_responsive_control(
            'logged_in_linkh',
            [
                'label'     => esc_html__('Link Hover', 'topper-pack'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .p.logged-in-as a:hover, .topppa-product-review-comment div#respond a:hover, .topppa-product-review-comment article a:hover' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_responsive_control(
            'logged_in_margin',
            [
                'label'      => esc_html__('Margin', 'topper-pack'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .p.logged-in-as, .topppa-product-review-comment div#respond, .topppa-product-review-comment article' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'logged_in_padding',
            [
                'label'      => esc_html__('Padding', 'topper-pack'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .p.logged-in-as, .topppa-product-review-comment div#respond, .topppa-product-review-comment article' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();

        // <==========>
        // <==========> TITLE STYLES <==========>

        $this->start_controls_section(
            'input_styles',
            [
                'label' => esc_html__('Input', 'topper-pack'),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_responsive_control(
            'input_height',
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
                    '{{WRAPPER}} .topppa-product-review-comment .comment-form-author input#author, .topppa-product-review-comment .comment-form-author input#email, .topppa-product-review-comment .comment-form-author input#url, .topppa-product-review-comment .comment-form-email input#author, .topppa-product-review-comment .comment-form-email input#email, .topppa-product-review-comment .comment-form-email input#url, .topppa-product-review-comment .comment-form-url input#author, .topppa-product-review-comment .comment-form-url input#email, .topppa-product-review-comment .comment-form-url input#url, .topppa-product-review-comment form textarea, .topppa-product-review-comment form .comment-form-comment textarea, .woocommerce .topppa-product-review-comment #review_form #respond textarea' => 'height: {{SIZE}}{{UNIT}}; !important',
                ],
            ]
        );
        $this->add_responsive_control(
            'input_width',
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
                    '{{WRAPPER}} .topppa-product-review-comment .comment-form-author input#author, .topppa-product-review-comment .comment-form-author input#email, .topppa-product-review-comment .comment-form-author input#url, .topppa-product-review-comment .comment-form-email input#author, .topppa-product-review-comment .comment-form-email input#email, .topppa-product-review-comment .comment-form-email input#url, .topppa-product-review-comment .comment-form-url input#author, .topppa-product-review-comment .comment-form-url input#email, .topppa-product-review-comment .comment-form-url input#url, .topppa-product-review-comment form textarea, .topppa-product-review-comment form textarea' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'input_typography',
                'selector' => '{{WRAPPER}} .topppa-product-review-comment .comment-form-author input#author, .topppa-product-review-comment .comment-form-author input#email, .topppa-product-review-comment .comment-form-author input#url, .topppa-product-review-comment .comment-form-email input#author, .topppa-product-review-comment .comment-form-email input#email, .topppa-product-review-comment .comment-form-email input#url, .topppa-product-review-comment .comment-form-url input#author, .topppa-product-review-comment .comment-form-url input#email, .topppa-product-review-comment .comment-form-url input#url, .topppa-product-review-comment form textarea, .topppa-product-review-comment form textarea',
            ]
        );
        $this->add_responsive_control(
            'input_color',
            [
                'label' => esc_html__('Color', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .topppa-product-review-comment .comment-form-author input#author, .topppa-product-review-comment .comment-form-author input#email, .topppa-product-review-comment .comment-form-author input#url, .topppa-product-review-comment .comment-form-email input#author, .topppa-product-review-comment .comment-form-email input#email, .topppa-product-review-comment .comment-form-email input#url, .topppa-product-review-comment .comment-form-url input#author, .topppa-product-review-comment .comment-form-url input#email, .topppa-product-review-comment .comment-form-url input#url, .topppa-product-review-comment form textarea, .topppa-product-review-comment form textarea' => 'color: {{VALUE}}',
                ],
            ]
        );
        $selectors = [
            '{{WRAPPER}} .topppa-product-review-comment .comment-form-author input#author',
            '{{WRAPPER}} .topppa-product-review-comment .comment-form-author input#email',
            '{{WRAPPER}} .topppa-product-review-comment .comment-form-author input#url',
            '{{WRAPPER}} .topppa-product-review-comment .comment-form-email input#author',
            '{{WRAPPER}} .topppa-product-review-comment .comment-form-email input#email',
            '{{WRAPPER}} .topppa-product-review-comment .comment-form-email input#url',
            '{{WRAPPER}} .topppa-product-review-comment .comment-form-url input#author',
            '{{WRAPPER}} .topppa-product-review-comment .comment-form-url input#email',
            '{{WRAPPER}} .topppa-product-review-comment .comment-form-url input#url',
            '{{WRAPPER}} .topppa-product-review-comment form textarea'
        ];

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'background',
                'types' => ['classic', 'gradient', 'video'],
                'selector' => implode(', ', $selectors),
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'input_border',
                'selector' => '{{WRAPPER}} .topppa-product-review-comment .comment-form-author input#author, .topppa-product-review-comment .comment-form-author input#email, .topppa-product-review-comment .comment-form-author input#url, .topppa-product-review-comment .comment-form-email input#author, .topppa-product-review-comment .comment-form-email input#email, .topppa-product-review-comment .comment-form-email input#url, .topppa-product-review-comment .comment-form-url input#author, .topppa-product-review-comment .comment-form-url input#email, .topppa-product-review-comment .comment-form-url input#url, .topppa-product-review-comment form textarea, .topppa-product-review-comment form textarea',
            ]
        );
        $this->add_responsive_control(
            'input_border_radius',
            [
                'label' => esc_html__('Border Radius', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .topppa-product-review-comment .comment-form-author input#author, .topppa-product-review-comment .comment-form-author input#email, .topppa-product-review-comment .comment-form-author input#url, .topppa-product-review-comment .comment-form-email input#author, .topppa-product-review-comment .comment-form-email input#email, .topppa-product-review-comment .comment-form-email input#url, .topppa-product-review-comment .comment-form-url input#author, .topppa-product-review-comment .comment-form-url input#email, .topppa-product-review-comment .comment-form-url input#url, .topppa-product-review-comment form textarea, .topppa-product-review-comment form textarea' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'input_margin',
            [
                'label' => esc_html__('Margin', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} .topppa-product-review-comment .comment-form-author input#author, .topppa-product-review-comment .comment-form-author input#email, .topppa-product-review-comment .comment-form-author input#url, .topppa-product-review-comment .comment-form-email input#author, .topppa-product-review-comment .comment-form-email input#email, .topppa-product-review-comment .comment-form-email input#url, .topppa-product-review-comment .comment-form-url input#author, .topppa-product-review-comment .comment-form-url input#email, .topppa-product-review-comment .comment-form-url input#url, .topppa-product-review-comment form textarea, .topppa-product-review-comment form textarea' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'input_padding',
            [
                'label' => esc_html__('Padding', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} .topppa-product-review-comment .comment-form-author input#author, .topppa-product-review-comment .comment-form-author input#email, .topppa-product-review-comment .comment-form-author input#url, .topppa-product-review-comment .comment-form-email input#author, .topppa-product-review-comment .comment-form-email input#email, .topppa-product-review-comment .comment-form-email input#url, .topppa-product-review-comment .comment-form-url input#author, .topppa-product-review-comment .comment-form-url input#email, .topppa-product-review-comment .comment-form-url input#url, .topppa-product-review-comment form textarea, .topppa-product-review-comment form textarea' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();

        // <========================> BOX STYLES <========================>
        $this->start_controls_section(
            'topppa_btn_style',
            [
                'label' => esc_html__('Button', 'topper-pack'),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
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
                'selector' => '{{WRAPPER}} .topppa-product-review-comment .woocommerce-Reviews .comment-respond .form-submit input[type=submit]',
            ]
        );

        $this->add_responsive_control(
            'topppa_btn_color',
            [
                'label'     => esc_html__('Color', 'topper-pack'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .topppa-product-review-comment .woocommerce-Reviews .comment-respond .form-submit input[type=submit]' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'topppa_btn_background',
                'types' => ['classic', 'gradient', 'video'],
                'selector' => '{{WRAPPER}} .topppa-product-review-comment .woocommerce-Reviews .comment-respond .form-submit input[type=submit]',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name'     => 'topppa_btn_border',
                'label'    => esc_html__('Border', 'topper-pack'),
                'selector' => '{{WRAPPER}} .topppa-product-review-comment .woocommerce-Reviews .comment-respond .form-submit input[type=submit]',
            ]
        );

        $this->add_responsive_control(
            'topppa_btn_border_radius',
            [
                'label'      => esc_html__('Border Radius', 'topper-pack'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .topppa-product-review-comment .woocommerce-Reviews .comment-respond .form-submit input[type=submit]' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'topppa_btn_box_shadow',
                'label'    => esc_html__('Shadow', 'topper-pack'),
                'selector' => '{{WRAPPER}} .topppa-product-review-comment .woocommerce-Reviews .comment-respond .form-submit input[type=submit]',
            ]
        );

        $this->add_responsive_control(
            'topppa_btn_margin',
            [
                'label'      => esc_html__('Margin', 'topper-pack'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .topppa-product-review-comment .woocommerce-Reviews .comment-respond .form-submit input[type=submit]' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                    '{{WRAPPER}} .topppa-product-review-comment .woocommerce-Reviews .comment-respond .form-submit input[type=submit]' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                'name'     => 'topppa_btn_typography_hover',
                'selector' => '{{WRAPPER}} .topppa-product-review-comment .woocommerce-Reviews .comment-respond .form-submit input[type=submit]:hover',
            ]
        );

        $this->add_responsive_control(
            'topppa_btn_color_hover',
            [
                'label'     => esc_html__('Color', 'topper-pack'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .topppa-product-review-comment .woocommerce-Reviews .comment-respond .form-submit input[type=submit]:hover' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'topppa_btn_background_hover',
                'types' => ['classic', 'gradient', 'video'],
                'selector' => '{{WRAPPER}} .topppa-product-review-comment .woocommerce-Reviews .comment-respond .form-submit input[type=submit]:hover',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name'     => 'topppa_btn_border_hover',
                'label'    => esc_html__('Border', 'topper-pack'),
                'selector' => '{{WRAPPER}} .topppa-product-review-comment .woocommerce-Reviews .comment-respond .form-submit input[type=submit]:hover',
            ]
        );

        $this->add_responsive_control(
            'topppa_btn_border_radius_hover',
            [
                'label'      => esc_html__('Border Radius', 'topper-pack'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .topppa-product-review-comment .woocommerce-Reviews .comment-respond .form-submit input[type=submit]:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'topppa_btn_box_shadow_hover',
                'label'    => esc_html__('Shadow', 'topper-pack'),
                'selector' => '{{WRAPPER}} .topppa-product-review-comment .woocommerce-Reviews .comment-respond .form-submit input[type=submit]:hover',
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

        // Check if WooCommerce is active
        if (!class_exists('WooCommerce')) {
            echo '<div class="elementor-alert elementor-alert-warning">';
            echo esc_html__('WooCommerce is not installed. Please install and activate WooCommerce to use this widget.', 'topper-pack');
            echo '</div>';
            return;
        }

        // Check if we're in theme builder
        $is_theme_builder = \Elementor\Plugin::$instance->editor->is_edit_mode();

        // Get the current product ID
        $product_id = '';
        if (!$is_theme_builder && is_product()) {
            $product_id = get_the_ID();
        }

        // Render the review section
        echo '<div class="topppa-product-review-comment topppa-btn-wrapper">';
        echo '<h3 class="topppa-product-review-title">' . esc_html($settings['review_section_title']) . '</h3>';

        if ($is_theme_builder) {
            // Show dummy reviews in theme builder
            echo '<div class="topppa-dummy-reviews">';
            
            // Sample review 1
            echo '<div class="review">';
            echo '<div class="comment_container">';
            echo '<div class="comment-text">';
            echo '<div class="star-rating" role="img" aria-label="Rated 5.00 out of 5"><span style="width:100%">Rated <strong class="rating">5.00</strong>'.esc_html__('out of 5','topper-pack').'</span></div>';
            echo '<p class="meta">';
            echo '<strong class="woocommerce-review__author">'.esc_html__('John Doe','topper-pack').'</strong> <span class="woocommerce-review__dash">-</span> <time class="woocommerce-review__published-date">' . esc_html( date_i18n( 'F j, Y' ) ) . '</time>';
            echo '</p>';
            echo '<div class="description"><p>'.esc_html__('This is a sample review. The product quality is excellent and I am very satisfied with my purchase. Would definitely recommend!','topper-pack').'</p></div>';
            echo '</div>';
            echo '</div>';
            echo '</div>';

            // Sample review 2
            echo '<div class="review">';
            echo '<div class="comment_container">';
            echo '<div class="comment-text">';
            echo '<div class="star-rating" role="img" aria-label="Rated 4.00 out of 5"><span style="width:80%">Rated <strong class="rating">4.00</strong>'.esc_html__('out of 5','topper-pack').'</span></div>';
            echo '<p class="meta">';
            echo '<strong class="woocommerce-review__author">'.esc_html__('Jane Smith','topper-pack').'</strong> <span class="woocommerce-review__dash">-</span> <time class="woocommerce-review__published-date">' . esc_html( date_i18n( 'F j, Y' ) ) . '</time>';
            echo '</p>';
            echo '<div class="description"><p>'.esc_html__('Another sample review. Good product overall, but could use some improvements in packaging.','topper-pack').'</p></div>';
            echo '</div>';
            echo '</div>';
            echo '</div>';

            echo '</div>'; // End dummy reviews

            // Show dummy review form
            echo '<div id="respond" class="comment-respond">';
            echo '<h3 id="reply-title" class="comment-reply-title">' . esc_html__('Add a review', 'topper-pack') . '</h3>';
            echo '<form action="#" method="post" id="commentform" class="comment-form">';
            echo '<div class="topppa-review-rating">';
            echo '<label for="rating">' . esc_html__('Your rating', 'topper-pack') . '</label>';
            echo '<select name="rating" id="rating" required>';
            echo '<option value="">' . esc_html__('Rate&hellip;', 'topper-pack') . '</option>';
            echo '<option value="5">' . esc_html__('Perfect', 'topper-pack') . '</option>';
            echo '<option value="4">' . esc_html__('Good', 'topper-pack') . '</option>';
            echo '<option value="3">' . esc_html__('Average', 'topper-pack') . '</option>';
            echo '<option value="2">' . esc_html__('Not that bad', 'topper-pack') . '</option>';
            echo '<option value="1">' . esc_html__('Very poor', 'topper-pack') . '</option>';
            echo '</select>';
            echo '</div>';
            echo '<p class="comment-form-comment">';
            echo '<textarea id="comment" name="comment" cols="45" rows="8" placeholder="' . esc_attr__('Your review *', 'topper-pack') . '" required></textarea>';
            echo '</p>';
            echo '<p class="form-submit">';
            echo '<button type="submit" class="submit topppa-btn">' . esc_html__('Submit Review', 'topper-pack') . '</button>';
            echo '</p>';
            echo '</form>';
            echo '</div>';
        } else {
            // Check if there are reviews
            if (get_comments_number($product_id) > 0) {
                // Display existing reviews but prevent duplicate form
                add_filter('woocommerce_product_review_comment_form_args', function ($comment_form) {
                    $comment_form['title_reply'] = ''; // Remove the default "Add a review" title
                    return $comment_form;
                });
                comments_template();
            } else {
                // Display "No reviews yet" message
                echo '<p class="topppa-no-reviews">' . esc_html__('There are no reviews yet.', 'topper-pack') . '</p>';

                // Display the "Be the first to review" message
                echo '<p class="topppa-be-first-review">';
                // translators: %s is the product title.
                echo sprintf(esc_html__('Be the first to review &ldquo;%s&rdquo;', 'topper-pack'), get_the_title($product_id)); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
                echo '</p>';

                // Display our custom review form only when there are no reviews
                if (comments_open($product_id)) {
                    comment_form([
                        'title_reply'   => '', 
                        'comment_field' => '
                            <div class="topppa-review-rating">
                                <label for="rating">' . esc_html__('Your rating', 'topper-pack') . '</label>
                                <select name="rating" id="rating" required>
                                    <option value="">' . esc_html__('Rate&hellip;', 'topper-pack') . '</option>
                                    <option value="5">' . esc_html__('Perfect', 'topper-pack') . '</option>
                                    <option value="4">' . esc_html__('Good', 'topper-pack') . '</option>
                                    <option value="3">' . esc_html__('Average', 'topper-pack') . '</option>
                                    <option value="2">' . esc_html__('Not that bad', 'topper-pack') . '</option>
                                    <option value="1">' . esc_html__('Very poor', 'topper-pack') . '</option>
                                </select>
                            </div>
                            <p class="comment-form-comment">
                                <textarea id="comment" name="comment" cols="45" rows="8" placeholder="' . esc_attr__('Your review *', 'topper-pack') . '" required></textarea>
                            </p>',
                        'submit_button' => '<button type="submit" class="submit topppa-btn">' . esc_html__('Submit Review', 'topper-pack') . '</button>',
                    ], $product_id);
                }
            }
        }

        echo '</div>';
    }
}
