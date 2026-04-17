<?php
use \TopperPack\Includes\Controls\Controls_Manager as TopperPack_Controls_Manager;
use \TopperPack\Includes\Utilities;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

/**
 * Elementor topppa Post Image Widget.
 */
class TOPPPA_Post_comment_Widget extends \Elementor\Widget_Base {

    public function get_name() {
        return 'topppa_post_comment';
    }

    public function get_title() {
        return TOPPPA_EPWB . esc_html__('Post Comment Box', 'topper-pack');
    }

    public function get_icon() {
        return 'eicon-comments';
    }

    public function get_categories() {
        return ['topper-pack'];
    }

    public function get_keywords() {
        return ['topppa', 'widget', 'comment', 'post', 'comments', 'topperpack'];
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
		return 'https://doc.topperpack.com/docs/general-widgets/post-comment-box/';
	}

    public function topppa_comment_style_list_control() {
        $this->add_control(
            'comment_style',
            [
                'label' => esc_html__('Comment Style', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'default',
                'options' => [
                    'default' => esc_html__('Default Modern', 'topper-pack'),
                    'cards' => esc_html__('Cards', 'topper-pack'),
                    'pro_1' => esc_html__('Thread Style(Pro)', 'topper-pack'),
                    'pro_2' => esc_html__('Chat Bubbles(Pro)', 'topper-pack'),
                    'pro_3' => esc_html__('Flat Design(Pro)', 'topper-pack'),
                    'pro_4' => esc_html__('Material Design(Pro)', 'topper-pack'),
                    'pro_5' => esc_html__('Bordered Style(Pro)', 'topper-pack'),
                    'pro_6' => esc_html__('Classic WordPress(Pro)', 'topper-pack'),
                ],
            ]
        );
        Utilities::upgrade_pro_notice( 
            $this, 
            \Elementor\Controls_Manager::RAW_HTML, 
            'topppa_post_comment',
            'comment_style',
            ['pro_1', 'pro_2', 'pro_3', 'pro_4', 'pro_5', 'pro_6']
        );
    }

    public function topppa_comment_form_style_list_control() {
        $this->add_control(
            'form_style',
            [
                'label' => esc_html__('Form Style', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'default',
                'options' => [
                    'default' => esc_html__('Default', 'topper-pack'),
                    'boxed' => esc_html__('Boxed', 'topper-pack'),
                    'pro_1' => esc_html__('Outlined(Pro)', 'topper-pack'),
                    'pro_2' => esc_html__('Refined Minimal(Pro)', 'topper-pack'),
                    'pro_3' => esc_html__('Material Design(Pro)', 'topper-pack'),
                    'pro_4' => esc_html__('Floating Labels(Pro)', 'topper-pack'),
                    'pro_5' => esc_html__('Underlined Fields(Pro)', 'topper-pack'),
                    'pro_6' => esc_html__('Rounded Style(Pro)', 'topper-pack'),
                ],
            ]
        );
        Utilities::upgrade_pro_notice( 
            $this, 
            \Elementor\Controls_Manager::RAW_HTML, 
            'topppa_post_comment',
            'form_style',
            ['pro_1', 'pro_2', 'pro_3', 'pro_4', 'pro_5', 'pro_6']
        );
    }

    protected function register_controls() {
        $this->start_controls_section(
            'post_comment_options',
            [
                'label' => esc_html__('Post Comment Box', 'topper-pack'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        // Post Type Selection - KEEPING THIS CONTROL
        $this->add_control(
            'post_type',
            [
                'label' => esc_html__('Select Post Type', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'post',
                'options' => $this->topppa_get_available_post_types(),
            ]
        );

        // Style Controls for Comments
        $this->topppa_comment_style_list_control();


        // Style Controls for Forms
        $this->topppa_comment_form_style_list_control();

        // ADDED: Toggle control for "No comments" message
        $this->add_control(
            'show_no_comments_message',
            [
                'label' => esc_html__('Show "No Comments" Message', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', 'topper-pack'),
                'label_off' => esc_html__('Hide', 'topper-pack'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );
        // Style Controls for Messages
        $this->add_control(
            'message_style',
            [
                'label' => esc_html__('Message Style', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'default',
                'options' => [
                    'default' => esc_html__('Default', 'topper-pack'),
                    'alert' => esc_html__('Alert', 'topper-pack'),
                    'simple' => esc_html__('Simple', 'topper-pack'),
                    'boxed' => esc_html__('Boxed with Icon', 'topper-pack'),
                ],
                'condition' => [
                    'show_no_comments_message' => 'yes',
                ],
            ]
        );

        $this->end_controls_section();
        // <==========>
        // <==========> BOX STYLES <==========>

        $this->start_controls_section(
            'box_styles',
            [
                'label' => esc_html__('Box Style', 'topper-pack'),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->start_controls_tabs(
            'style_box_tabs'
        );

        $this->start_controls_tab(
            'style_main_box_tab',
            [
                'label' => esc_html__('Main Box', 'topper-pack'),
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'box_bg',
                'label' => esc_html__('Background', 'topper-pack'),
                'types' => ['classic', 'gradient', 'video'],
                'selector' => '{{WRAPPER}} .topppa-post-comment-widget .topppa-comments-area .topppa-comments-list .comment',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'box_border',
                'label' => esc_html__('Border', 'topper-pack'),
                'selector' => '{{WRAPPER}} .topppa-post-comment-widget .topppa-comments-area .topppa-comments-list .comment',
            ]
        );
        $this->add_responsive_control(
            'box_radius',
            [
                'label' => esc_html__('Border Radius', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .topppa-post-comment-widget .topppa-comments-area .topppa-comments-list .comment' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'box_shadow',
                'label' => esc_html__('Box Shadow', 'topper-pack'),
                'selector' => '{{WRAPPER}} .topppa-post-comment-widget .topppa-comments-area .topppa-comments-list .comment',
            ]
        );
        $this->add_responsive_control(
            'box_margin',
            [
                'label' => esc_html__('Margin', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .topppa-post-comment-widget .topppa-comments-area .topppa-comments-list .comment' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                    '{{WRAPPER}} .topppa-post-comment-widget .topppa-comments-area .topppa-comments-list .comment' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_tab();

        $this->start_controls_tab(
            'style_inner_tab',
            [
                'label' => esc_html__('Inner Box', 'topper-pack'),
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'inner_box_bg',
                'label' => esc_html__('Background', 'topper-pack'),
                'types' => ['classic', 'gradient', 'video'],
                'selector' => '{{WRAPPER}} .topppa-post-comment-widget .topppa-comments-area .topppa-comments-list .comment.child',
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'inner_box_border',
                'label' => esc_html__('Border', 'topper-pack'),
                'selector' => '{{WRAPPER}} .topppa-post-comment-widget .topppa-comments-area .topppa-comments-list .comment.child',
            ]
        );
        $this->add_responsive_control(
            'inner_box_radius',
            [
                'label' => esc_html__('Border Radius', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .topppa-post-comment-widget .topppa-comments-area .topppa-comments-list .comment.child' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'inner_box_shadow',
                'label' => esc_html__('Box Shadow', 'topper-pack'),
                'selector' => '{{WRAPPER}} .topppa-post-comment-widget .topppa-comments-area .topppa-comments-list .comment.child',
            ]
        );
        $this->add_responsive_control(
            'inner_box_margin',
            [
                'label' => esc_html__('Margin', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .topppa-post-comment-widget .topppa-comments-area .topppa-comments-list .comment.child' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'inner_box_padding',
            [
                'label' => esc_html__('Padding', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .topppa-post-comment-widget .topppa-comments-area .topppa-comments-list .comment.child' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();
        $this->start_controls_section(
            'topppa_content_style',
            [
                'label' => esc_html__('Content Style', 'topper-pack'),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->start_controls_tabs(
            'tabs_content_tabs'
        );
        $this->start_controls_tab(
            'tabs_image_tab',
            [
                'label' => esc_html__('Image', 'topper-pack'),
            ]
        );
        $this->add_responsive_control(
            'image_height',
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
                    '{{WRAPPER}} .topppa-post-comment-widget .topppa-comments-area .topppa-comments-list .comment .comment-author img' => 'height: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .topppa-post-comment-widget .topppa-comments-area .topppa-comments-list .comment .avatar' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'image_width',
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
                    '{{WRAPPER}} .topppa-post-comment-widget .topppa-comments-area .topppa-comments-list .comment .comment-author img' => 'width: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .topppa-post-comment-widget .topppa-comments-area .topppa-comments-list .comment .avatar' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'min_image_width',
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
                    '{{WRAPPER}} .topppa-post-comment-widget .topppa-comments-area .topppa-comments-list .comment .comment-author img' => 'min-width: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .topppa-post-comment-widget .topppa-comments-area .topppa-comments-list .comment .avatar' => 'min-width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'object',
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
                    '{{WRAPPER}} .topppa-post-comment-widget .topppa-comments-area .topppa-comments-list .comment .comment-author img' => 'object-fit: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name'     => 'image_border',
                'label'    => esc_html__('Border', 'topper-pack'),
                'selector' => '{{WRAPPER}} .topppa-post-comment-widget .topppa-comments-area .topppa-comments-list .comment .comment-author img',
            ]
        );
        $this->add_responsive_control(
            'image_border_radius',
            [
                'label'      => esc_html__('Border Radius', 'topper-pack'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .topppa-post-comment-widget .topppa-comments-area .topppa-comments-list .comment .comment-author img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'image_box_shadow',
                'label' => esc_html__('Box Shadow', 'topper-pack'),
                'selector' => '{{WRAPPER}} .topppa-post-comment-widget .topppa-comments-area .topppa-comments-list .comment .comment-author img',
            ]
        );
        $this->add_responsive_control(
            'image_margin',
            [
                'label'      => esc_html__('Margin', 'topper-pack'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .topppa-post-comment-widget .topppa-comments-area .topppa-comments-list .comment .comment-author img' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'image_padding',
            [
                'label'      => esc_html__('Padding', 'topper-pack'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .topppa-post-comment-widget .topppa-comments-area .topppa-comments-list .comment .comment-author img' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_tab();
        $this->start_controls_tab(
            'title_tab',
            [
                'label' => esc_html__('Title', 'topper-pack'),
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'title_typo',
                'label' => __('Typography', 'topper-pack'),
                'selector' => ' {{WRAPPER}} .topppa-post-comment-widget .comment-author cite.fn,{{WRAPPER}} .topppa-post-comment-widget .topppa-comments-area .comment-meta .comment-author .fn',
            ]
        );
        $this->add_responsive_control(
            'title_color',
            [
                'label'       => esc_html__('Color', 'topper-pack'),
                'type'        => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .topppa-post-comment-widget .comment-author cite.fn' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .topppa-post-comment-widget .topppa-comments-area .comment-meta .comment-author .fn' => 'color: {{VALUE}};',
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
                    '{{WRAPPER}} .topppa-post-comment-widget .comment-author cite.fn' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .topppa-post-comment-widget .topppa-comments-area .comment-meta .comment-author .fn' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                    '{{WRAPPER}} .topppa-post-comment-widget .comment-author cite.fn' => 'Padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .topppa-post-comment-widget .topppa-comments-area .comment-meta .comment-author .fn' => 'Padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'short_title_style',
            [
                'label' => esc_html__('Short Text Style', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'short_text_typo',
                'label' => __('Typography', 'topper-pack'),
                'selector' => ' {{WRAPPER}} .topppa-post-comment-widget .topppa-comments-area .comment-author span.says,{{WRAPPER}} .topppa-post-comment-widget .topppa-comments-area .topppa-comments-list .comment .comment-meta .comment-author .says',
            ]
        );
        $this->add_responsive_control(
            'short_text_color',
            [
                'label'       => esc_html__('Color', 'topper-pack'),
                'type'        => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .topppa-post-comment-widget .topppa-comments-area .comment-author span.says' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .topppa-post-comment-widget .topppa-comments-area .topppa-comments-list .comment .comment-meta .comment-author .says' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'short_text_margin',
            [
                'label'      => esc_html__('Margin', 'topper-pack'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .topppa-post-comment-widget .topppa-comments-area .comment-author span.says' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .topppa-post-comment-widget .topppa-comments-area .topppa-comments-list .comment .comment-meta .comment-author .says' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'short_text_padding',
            [
                'label'      => esc_html__('Padding', 'topper-pack'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .topppa-post-comment-widget .topppa-comments-area .comment-author span.says' => 'Padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .topppa-post-comment-widget .topppa-comments-area .topppa-comments-list .comment .comment-meta .comment-author .says' => 'Padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_tab();
        $this->start_controls_tab(
            'datetime_tab',
            [
                'label' => esc_html__('Datetime', 'topper-pack'),
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'datetime_typo',
                'selector' => '{{WRAPPER}} .topppa-post-comment-widget .topppa-comments-area .topppa-comments-list .comment .comment-meta .comment-metadata',
            ]
        );
        $this->add_responsive_control(
            'datetime_color',
            [
                'label'     => esc_html__('Color', 'topper-pack'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .topppa-post-comment-widget .topppa-comments-area .topppa-comments-list .comment .comment-meta .comment-metadata' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_responsive_control(
            'datetime_margin',
            [
                'label'      => esc_html__('Margin', 'topper-pack'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .topppa-post-comment-widget .topppa-comments-area .topppa-comments-list .comment .comment-meta .comment-metadata' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'datetime_padding',
            [
                'label'      => esc_html__('Padding', 'topper-pack'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .topppa-post-comment-widget .topppa-comments-area .topppa-comments-list .comment .comment-meta .comment-metadata' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->start_controls_tabs(
            'tabs_content_tabss'
        );
        $this->start_controls_tab(
            'desc_tab',
            [
                'label' => esc_html__('Description', 'topper-pack'),
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'desc_typo',
                'label' => __('Typography', 'topper-pack'),
                'selector' => ' {{WRAPPER}} .topppa-comments-area .comment .comment-content',
            ]
        );
        $this->add_responsive_control(
            'desc_color',
            [
                'label'       => esc_html__('Color', 'topper-pack'),
                'type'        => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .topppa-comments-area .comment .comment-content' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'desc_background',
            [
                'label'       => esc_html__('Background Color', 'topper-pack'),
                'type'        => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .topppa-comments-area .comment .comment-content' => 'background-color: {{VALUE}};',
                    '{{WRAPPER}} .topppa-comments-area .comment .comment-content:before' => 'border-right-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'desc_margin',
            [
                'label'      => esc_html__('Margin', 'topper-pack'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .topppa-comments-area .comment .comment-content' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'desc_padding',
            [
                'label'      => esc_html__('Padding', 'topper-pack'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .topppa-comments-area .comment .comment-content' => 'Padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_tab();
        $this->start_controls_tab(
            'reply_button_tab',
            [
                'label' => esc_html__('Button', 'topper-pack'),
            ]
        );
        $this->add_responsive_control(
            'reply_button_typo',
            [
                'label' => esc_html__('Typography', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                        'step' => 1,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .topppa-post-comment-widget .topppa-comments-area .topppa-comments-list .comment .reply a.comment-reply-link' => 'font-size: {{SIZE}}{{UNIT}}!important',
                ],
            ]
        );
        $this->add_responsive_control(
            'reply_button_color',
            [
                'label'     => esc_html__('Color', 'topper-pack'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .topppa-post-comment-widget .topppa-comments-area .topppa-comments-list .comment .reply a.comment-reply-link' => 'color: {{VALUE}} !important',
                ],
            ]
        );

        $this->add_responsive_control(
            'reply_button_hcolor',
            [
                'label'     => esc_html__('Hover Color', 'topper-pack'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .topppa-post-comment-widget .topppa-comments-area .topppa-comments-list .comment .reply a.comment-reply-link:hover' => 'color: {{VALUE}} !important',
                ],
            ]
        );
        $this->add_responsive_control(
            'reply_button_bg',
            [
                'label'     => esc_html__('Background Color', 'topper-pack'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .topppa-post-comment-widget .topppa-comments-area .topppa-comments-list .comment .reply a.comment-reply-link' => 'background-color: {{VALUE}} !important',
                ],
            ]
        );

        $this->add_responsive_control(
            'reply_button_bg_hcolor',
            [
                'label'     => esc_html__('Background Hover Color', 'topper-pack'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .topppa-post-comment-widget .topppa-comments-area .topppa-comments-list .comment .reply a.comment-reply-link:hover' => 'background-color: {{VALUE}} !important',
                ],
            ]
        );
        $this->add_responsive_control(
            'reply_button_border_color',
            [
                'label'     => esc_html__('Border Color', 'topper-pack'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .topppa-post-comment-widget .topppa-comments-area .topppa-comments-list .comment .reply a.comment-reply-link' => 'border-color: {{VALUE}} !important',
                ],
            ]
        );
        $this->add_responsive_control(
            'reply_button_radius',
            [
                'label' => esc_html__('Border Radius', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .topppa-post-comment-widget .topppa-comments-area .topppa-comments-list .comment .reply a.comment-reply-link' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important',
                ],
            ]
        );
        $this->add_responsive_control(
            'reply_button_margin',
            [
                'label' => esc_html__('Margin', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .topppa-post-comment-widget .topppa-comments-area .topppa-comments-list .comment .reply a.comment-reply-link' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important',
                ],
            ]
        );
        $this->add_responsive_control(
            'reply_button_padding',
            [
                'label' => esc_html__('Padding', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .topppa-post-comment-widget .topppa-comments-area .topppa-comments-list .comment .reply a.comment-reply-link' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important',
                ],
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();
        $this->start_controls_section(
            'pagination_content_option',
            [
                'label' => esc_html__('Pagination Style Option', 'topper-pack'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'pagination_typography',
                'selector' => '{{WRAPPER}} .topppa-post-comment-widget .topppa-comments-area .topppa-comments-pagination .page-numbers',
            ]
        );
        $this->add_responsive_control(
            'pagination_box_Margin',
            [
                'label'      => esc_html__('Margin', 'topper-pack'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .testimonial-v2-wrapper .testi-v2-arrow' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'topppa_testimonail_styles' => 'style_five',
                ],
            ]
        );
        $this->start_controls_tabs(
            'pagination_style_tabs'
        );
        $this->start_controls_tab(
            'pagination_normal_tabs',
            [
                'label' => __('Normal', 'topper-pack'),
            ]
        );
        $this->add_responsive_control(
            'pagination_color',
            [
                'label'     => esc_html__('Color', 'topper-pack'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .topppa-post-comment-widget .topppa-comments-area .topppa-comments-pagination .page-numbers' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'pagination_background',
                'label' => esc_html__('Background', 'topper-pack'),
                'types' => ['classic', 'gradient', 'video'],
                'selector' => '{{WRAPPER}} .topppa-post-comment-widget .topppa-comments-area .topppa-comments-pagination .page-numbers',
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
                'name'     => 'pagination_border',
                'label'    => esc_html__('Border', 'topper-pack'),
                'selector' => '{{WRAPPER}} .topppa-post-comment-widget .topppa-comments-area .topppa-comments-pagination .page-numbers',
            ]
        );
        $this->add_responsive_control(
            'pagination_border_radius',
            [
                'label'      => esc_html__('Border Radius', 'topper-pack'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .topppa-post-comment-widget .topppa-comments-area .topppa-comments-pagination .page-numbers' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_tab();
        $this->start_controls_tab(
            'pagination_hover_tabs',
            [
                'label' => __('Active', 'topper-pack'),
            ]
        );
        $this->add_responsive_control(
            'pagination_color_hover',
            [
                'label'     => esc_html__('Hover Color', 'topper-pack'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .comments-pagination .nav-links a:hover:not(.current)' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .topppa-post-comment-widget .topppa-comments-area .topppa-comments-pagination .page-numbers.current' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'pagination_background_hover',
                'label' => esc_html__('Background', 'topper-pack'),
                'types' => ['classic', 'gradient', 'video'],
                'selector' => '{{WRAPPER}} .topppa-post-comment-widget .topppa-comments-area .topppa-comments-pagination .page-numbers.current',
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
                'name'     => 'pagination_border_hover',
                'label'    => esc_html__('Border', 'topper-pack'),
                'selector' => '{{WRAPPER}} .topppa-post-comment-widget .topppa-comments-area .topppa-comments-pagination .page-numbers.current',
            ]
        );
        $this->add_responsive_control(
            'pagination_border_radius_hover',
            [
                'label'      => esc_html__('Border Radius', 'topper-pack'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .topppa-post-comment-widget .topppa-comments-area .topppa-comments-pagination .page-numbers.current' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->add_responsive_control(
            'pagination_Margin',
            [
                'label'      => esc_html__('Margin', 'topper-pack'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .topppa-post-comment-widget .topppa-comments-area .topppa-comments-pagination' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'pagination_padding',
            [
                'label'      => esc_html__('Padding', 'topper-pack'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .topppa-post-comment-widget .topppa-comments-area .topppa-comments-pagination' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();
        $this->start_controls_section(
            'form_box_styles',
            [
                'label' => esc_html__('Form Box Style', 'topper-pack'),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->start_controls_tabs(
            'form_style_box_tabs'
        );

        $this->start_controls_tab(
            'form_style_main_box_tab',
            [
                'label' => esc_html__('Main Box', 'topper-pack'),
            ]
        );


        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'form_box_bg',
                'label' => esc_html__('Background', 'topper-pack'),
                'types' => ['classic', 'gradient', 'video'],
                'selector' => '{{WRAPPER}} .topppa-post-comment-widget .topppa-comments-area .topppa-comments-listcomment, {{WRAPPER}} .topppa-post-comment-widget .comment-respond',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'form_box_border',
                'label' => esc_html__('Border', 'topper-pack'),
                'selector' => '{{WRAPPER}} .topppa-post-comment-widget .topppa-comments-area .topppa-comments-listcomment, {{WRAPPER}} .topppa-post-comment-widget .comment-respond',
            ]
        );
        $this->add_responsive_control(
            'form_box_radius',
            [
                'label' => esc_html__('Border Radius', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .topppa-post-comment-widget .topppa-comments-area .topppa-comments-listcomment' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .topppa-post-comment-widget .comment-respond' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'form_box_shadow',
                'label' => esc_html__('Box Shadow', 'topper-pack'),
                'selector' => '{{WRAPPER}} .topppa-post-comment-widget .topppa-comments-area .topppa-comments-listcomment, {{WRAPPER}} .topppa-post-comment-widget .comment-respond',
            ]
        );
        $this->add_responsive_control(
            'form_box_margin',
            [
                'label' => esc_html__('Margin', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .topppa-post-comment-widget .topppa-comments-area .topppa-comments-listcomment' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .topppa-post-comment-widget .comment-respond' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'form_box_padding',
            [
                'label' => esc_html__('Padding', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .topppa-post-comment-widget .topppa-comments-area .topppa-comments-listcomment' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .topppa-post-comment-widget .comment-respond' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_tab();

        $this->start_controls_tab(
            'form_style_inner_tab',
            [
                'label' => esc_html__('Inner Box', 'topper-pack'),
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'form_inner_box_bg',
                'label' => esc_html__('Background', 'topper-pack'),
                'types' => ['classic', 'gradient', 'video'],
                'selector' => '{{WRAPPER}} .topppa-post-comment-widget .topppa-comments-area .topppa-comments-list .commentchild,{{WRAPPER}} .topppa-post-comment-widget .comment-respond .comment-respond',
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'form_inner_box_border',
                'label' => esc_html__('Border', 'topper-pack'),
                'selector' => '{{WRAPPER}} .topppa-post-comment-widget .topppa-comments-area .topppa-comments-list .commentchild,{{WRAPPER}} .topppa-post-comment-widget .comment-respond .comment-respond',
            ]
        );
        $this->add_responsive_control(
            'form_inner_box_radius',
            [
                'label' => esc_html__('Border Radius', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .topppa-post-comment-widget .topppa-comments-area .topppa-comments-list .commentchild' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .topppa-post-comment-widget .comment-respond .comment-respond' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'form_inner_box_shadow',
                'label' => esc_html__('Box Shadow', 'topper-pack'),
                'selector' => '{{WRAPPER}} .topppa-post-comment-widget .comment-respond .comment-respond',
            ]
        );
        $this->add_responsive_control(
            'form_inner_box_margin',
            [
                'label' => esc_html__('Margin', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .topppa-post-comment-widget .topppa-comments-area .topppa-commendts-list .commentchild' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .topppa-post-comment-widget .comment-respond .comment-respond' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'form_inner_box_padding',
            [
                'label' => esc_html__('Padding', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .topppa-post-comment-widget .topppa-comments-area .topppa-comments-list .commedntchild' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .topppa-post-comment-widget .comment-respond .comment-respond' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();
        $this->start_controls_section(
            'form_content_styles',
            [
                'label' => esc_html__('Form Content Style', 'topper-pack'),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->start_controls_tabs(
            'forem_content_style_tabs'
        );

        $this->start_controls_tab(
            'form_content_style_normal_tab',
            [
                'label' => esc_html__('Title', 'topper-pack'),
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'form_title_typo',
                'selector' => '{{WRAPPER}} .topppa-post-comment-widget .comment-respond .comment-reply-title',
            ]
        );
        $this->add_responsive_control(
            'form_title_color',
            [
                'label'     => esc_html__('Color', 'topper-pack'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .topppa-post-comment-widget .comment-respond .comment-reply-title' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'form_title_border',
                'selector' => '{{WRAPPER}} .topppa-post-comment-widget .comment-respond .comment-reply-title',
            ]
        );
        $this->add_responsive_control(
            'form_title_margin',
            [
                'label'      => esc_html__('Margin', 'topper-pack'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .topppa-post-comment-widget .comment-respond .comment-reply-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'form_title_padding',
            [
                'label'      => esc_html__('Padding', 'topper-pack'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .topppa-post-comment-widget .comment-respond .comment-reply-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_tab();

        $this->start_controls_tab(
            'form_text_style_tab',
            [
                'label' => esc_html__('Text', 'topper-pack'),
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'form_desc_typo',
                'selector' => '{{WRAPPER}} .topppa-post-comment-widget .topppa-comments-area .comment-respond .comment-form .comment-notes',
            ]
        );
        $this->add_responsive_control(
            'form_desc_color',
            [
                'label'     => esc_html__('Color', 'topper-pack'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .topppa-post-comment-widget .topppa-comments-area .comment-respond .comment-form .comment-notes' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_responsive_control(
            'form_desc_margin',
            [
                'label'      => esc_html__('Margin', 'topper-pack'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .topppa-post-comment-widget .topppa-comments-area .comment-respond .comment-form .comment-notes' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'form_desc_padding',
            [
                'label'      => esc_html__('Padding', 'topper-pack'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .topppa-post-comment-widget .topppa-comments-area .comment-respond .comment-form .comment-notes' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->start_controls_tabs(
            'form_input_tabs'
        );

        $this->start_controls_tab(
            'form_input_tab',
            [
                'label' => esc_html__('Input', 'topper-pack'),
            ]
        );
        $this->add_responsive_control(
            'input_bg_color',
            [
                'label' => esc_html__('Text Color', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .topppa-post-comment-widget .comment-respond .comment-form input[type=text]' => 'background-color: {{VALUE}}',
                    '{{WRAPPER}} .topppa-post-comment-widget .comment-respond .comment-form input[type=email]' => 'background-color: {{VALUE}}',
                    '{{WRAPPER}} .topppa-post-comment-widget .comment-respond .comment-form input[type=url]' => 'background-color: {{VALUE}}',
                    '{{WRAPPER}} .topppa-post-comment-widget .comment-respond .comment-form textarea' => 'background-color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'input_border',
                'label' => esc_html__('Border', 'topper-pack'),
                'selector' => '{{WRAPPER}} .topppa-post-comment-widget .comment-respond .comment-form input[type=text],{{WRAPPER}} .topppa-post-comment-widget .comment-respond .comment-form input[type=email],{{WRAPPER}} .topppa-post-comment-widget .comment-respond .comment-form input[type=url],{{WRAPPER}} .topppa-post-comment-widget .comment-respond .comment-form textarea',
            ]
        );
        $this->add_responsive_control(
            'input_radius',
            [
                'label' => esc_html__('Border Radius', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .topppa-post-comment-widget .comment-respond .comment-form input[type=text]' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .topppa-post-comment-widget .comment-respond .comment-form input[type=email]' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .topppa-post-comment-widget .comment-respond .comment-form input[type=url]' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .topppa-post-comment-widget .comment-respond .comment-form textarea' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'input_shadow',
                'label' => esc_html__('Box Shadow', 'topper-pack'),
                'selector' => '{{WRAPPER}} .topppa-post-comment-widget .comment-respond .comment-form input[type=text],{{WRAPPER}} .topppa-post-comment-widget .comment-respond .comment-form input[type=email],{{WRAPPER}} .topppa-post-comment-widget .comment-respond .comment-form input[type=url],{{WRAPPER}} .topppa-post-comment-widget .comment-respond .comment-form textarea',
            ]
        );
        $this->add_responsive_control(
            'input_margin',
            [
                'label' => esc_html__('Margin', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .topppa-post-comment-widget .comment-respond .comment-form input[type=text]' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .topppa-post-comment-widget .comment-respond .comment-form input[type=email]' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .topppa-post-comment-widget .comment-respond .comment-form input[type=url]' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .topppa-post-comment-widget .comment-respond .comment-form textarea' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'input_padding',
            [
                'label' => esc_html__('Padding', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],

                'selectors' => [
                    '{{WRAPPER}} .topppa-post-comment-widget .comment-respond .comment-form input[type=text]' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .topppa-post-comment-widget .comment-respond .comment-form input[type=email]' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .topppa-post-comment-widget .comment-respond .comment-form input[type=url]' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .topppa-post-comment-widget .comment-respond .comment-form textarea' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_tab();

        $this->start_controls_tab(
            'form_label_tab',
            [
                'label' => esc_html__('Label', 'topper-pack'),
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'form_label_typo',
                'selector' => '{{WRAPPER}} .topppa-post-comment-widget .topppa-comments-area .comment-respond .comment-form label',
            ]
        );
        $this->add_responsive_control(
            'form_label_color',
            [
                'label'     => esc_html__('Color', 'topper-pack'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .topppa-post-comment-widget .topppa-comments-area .comment-respond .comment-form label' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_responsive_control(
            'form_label_border_color',
            [
                'label'     => esc_html__('Border Color', 'topper-pack'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .topppa-post-comment-widget .topppa-comments-area .comment-respond .comment-form label' => 'border-color: {{VALUE}}',
                ],
            ]
        );
        $this->add_responsive_control(
            'form_label_margin',
            [
                'label'      => esc_html__('Margin', 'topper-pack'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .topppa-post-comment-widget .topppa-comments-area .comment-respond .comment-form label' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'form_label_padding',
            [
                'label'      => esc_html__('Padding', 'topper-pack'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .topppa-post-comment-widget .topppa-comments-area .comment-respond .comment-form label' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_tab();
        $this->start_controls_tab(
            'form_button_tab',
            [
                'label' => esc_html__('Button', 'topper-pack'),
            ]
        );
        $this->add_responsive_control(
            'from_button_typo',
            [
                'label' => esc_html__('Typography', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                        'step' => 1,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .topppa-post-comment-widget .comment-respond .comment-form .form-submit .submit' => 'font-size: {{SIZE}}{{UNIT}}!important',
                ],
            ]
        );
        $this->add_responsive_control(
            'from_button_color',
            [
                'label'     => esc_html__('Color', 'topper-pack'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .topppa-post-comment-widget .comment-respond .comment-form .form-submit .submit' => 'color: {{VALUE}} !important',
                ],
            ]
        );

        $this->add_responsive_control(
            'from_button_hcolor',
            [
                'label'     => esc_html__('Hover Color', 'topper-pack'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .topppa-post-comment-widget .comment-respond .comment-form .form-submit .submit:hover' => 'color: {{VALUE}} !important',
                ],
            ]
        );
        $this->add_responsive_control(
            'from_button_bg',
            [
                'label'     => esc_html__('Background Color', 'topper-pack'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .topppa-post-comment-widget .comment-respond .comment-form .form-submit .submit' => 'background-color: {{VALUE}} !important',
                ],
            ]
        );

        $this->add_responsive_control(
            'from_button_bg_hcolor',
            [
                'label'     => esc_html__('Background Hover Color', 'topper-pack'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .topppa-post-comment-widget .comment-respond .comment-form .form-submit .submit:hover' => 'background-color: {{VALUE}} !important',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'from_button_border',
                'selector' => '{{WRAPPER}} .topppa-post-comment-widget .comment-respond .comment-form .form-submit .submit',
            ]
        );
        $this->add_responsive_control(
            'from_button_radius',
            [
                'label' => esc_html__('Border Radius', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .topppa-post-comment-widget .comment-respond .comment-form .form-submit .submit' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important',
                ],
            ]
        );
        $this->add_responsive_control(
            'from_button_margin',
            [
                'label' => esc_html__('Margin', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .topppa-post-comment-widget .comment-respond .comment-form .form-submit .submit' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important',
                ],
            ]
        );
        $this->add_responsive_control(
            'from_button_padding',
            [
                'label' => esc_html__('Padding', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .topppa-post-comment-widget .comment-respond .comment-form .form-submit .submit' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important',
                ],
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();
    }
    protected function render() {
        $settings = $this->get_settings_for_display();
        $comment_style = $settings['comment_style'] ?? 'default';
        $form_style = $settings['form_style'] ?? 'default';
        $message_style = $settings['message_style'] ?? 'default';
        $post_type = $settings['post_type'] ?? 'post';

        // Check if we're in Elementor editor
        $is_editor = \Elementor\Plugin::$instance->editor->is_edit_mode();

        echo '<div class="topppa-post-comment-widget">';

        // Always show sample comments in editor
        if ($is_editor) {
            $this->render_sample_comments($comment_style, $form_style, $message_style);
        } else {
            // For frontend, get current post
            $post_id = get_the_ID();
            $post = get_post($post_id);

            if (!$post) {
                echo '<div class="topppa-no-comments-message message-style-' . esc_attr($message_style) . '">' .
                    esc_html__('No valid post found.', 'topper-pack') .
                    '</div>';
                echo '</div>';
                return;
            }

            // Check if post type matches the selected type
            if (get_post_type($post_id) !== $post_type) {
                echo '<div class="topppa-no-comments-message message-style-' . esc_attr($message_style) . '">' .
                    esc_html__('This content is not of the selected post type.', 'topper-pack') .
                    '</div>';
                echo '</div>';
                return;
            }

            // Save original post data
            $orig_post = $GLOBALS['post'];

            // Set current post for comment functions
            $GLOBALS['post'] = $post;
            setup_postdata($post);

            // Display actual comments
            $this->render_real_comments($post_id, $comment_style, $form_style, $message_style);

            // Restore original post data
            $GLOBALS['post'] = $orig_post;
            wp_reset_postdata();
        }

        echo '</div>';
    }

    /**
     * Render sample comments for Elementor editor
     */
    private function render_sample_comments($comment_style, $form_style, $message_style) {
        // Start comment section
        echo '<div class="topppa-comments-area">';

        // Sample comments list with WordPress classes
        echo '<div class="topppa-comments-list style-' . esc_attr($comment_style) . '">';

        // Parent comment - exact WordPress structure
        echo '<div id="comment-1" class="comment byuser comment-author-admin bypostauthor even thread-even depth-1 comment parent">';
        echo '<div class="comment-meta">';
        echo '<div class="comment-author vcard">';
        echo '<img alt="" src="' . esc_url(plugins_url('assets/images/fallback.webp', dirname(__FILE__))) . '" class="avatar avatar-60 photo" height="60" width="60" decoding="async" />'; // phpcs:ignore PluginCheck.CodeAnalysis.ImageFunctions.NonEnqueuedImage
        echo '<cite class="fn">' . esc_html__('John Doe', 'topper-pack') . '</cite> <span class="says">' . esc_html__('says:', 'topper-pack') . '</span>';
        echo '</div>';
        echo '<div class="comment-metadata">';
        echo '<time datetime="2023-06-15T10:30:00+00:00">June 15, 2023 at 10:30 am</time>';
        echo ' <span class="edit-link"><a class="comment-edit-link" href="#">' . esc_html__('(Edit)', 'topper-pack') . '</a></span>';
        echo '</div>';
        echo '</div>';
        echo '<div class="comment-content">';
        echo '<p>' . esc_html__('This is a sample parent comment for styling purposes. You can edit various comment styles using the widget controls.', 'topper-pack') . '</p>';
        echo '</div>';
        echo '<div class="reply">';
        echo '<a rel="nofollow" class="comment-reply-link" href="#" data-commentid="1" data-postid="1" data-belowelement="comment-1" data-respondelement="respond" data-replyto="Reply to John Doe">' . esc_html__('Reply', 'topper-pack') . '</a>';
        echo '</div>';

        // Nested comment (child)
        echo '<div id="comment-2" class="comment byuser comment-author-admin bypostauthor odd alt depth-2 comment child">';
        echo '<div class="comment-meta">';
        echo '<div class="comment-author vcard">';
        echo '<img alt="" src="' . esc_url(plugins_url('assets/images/fallback.webp', dirname(__FILE__))) . '" class="avatar avatar-60 photo" height="60" width="60" decoding="async" />'; // phpcs:ignore PluginCheck.CodeAnalysis.ImageFunctions.NonEnqueuedImage
        echo '<cite class="fn">' . esc_html__('Jane Smith', 'topper-pack') . '</cite> <span class="says">' . esc_html__('says:', 'topper-pack') . '</span>';
        echo '</div>';
        echo '<div class="comment-metadata">';
        echo '<time datetime="2023-06-15T11:15:00+00:00">June 15, 2023 at 11:15 am</time>';
        echo ' <span class="edit-link"><a class="comment-edit-link" href="#">(Edit)</a></span>';
        echo '</div>';
        echo '</div>';
        echo '<div class="comment-content">';
        echo '<p>' . esc_html__('This is a sample reply comment to demonstrate nested styling for the comments thread.', 'topper-pack') . '</p>';
        echo '</div>';
        echo '<div class="reply">';
        echo '<a rel="nofollow" class="comment-reply-link" href="#" data-commentid="2" data-postid="1" data-belowelement="comment-2" data-respondelement="respond" data-replyto="'.esc_attr__('Reply to Jane Smith', 'topper-pack').'">' . esc_html__('Reply', 'topper-pack') . '</a>';
        echo '</div>';
        echo '</div><!-- #comment-## -->';

        echo '</div><!-- #comment-## -->';

        // Second parent comment
        echo '<div id="comment-3" class="comment byuser comment-author-admin bypostauthor even thread-odd thread-alt depth-1 comment parent">';
        echo '<div class="comment-meta">';
        echo '<div class="comment-author vcard">';
        echo '<img alt="" src="' . esc_url(plugins_url('assets/images/fallback.webp', dirname(__FILE__))) . '" class="avatar avatar-60 photo" height="60" width="60" decoding="async" />'; // phpcs:ignore PluginCheck.CodeAnalysis.ImageFunctions.NonEnqueuedImage
        echo '<cite class="fn">' . esc_html__('Alex Johnson', 'topper-pack') . '</cite> <span class="says">' . esc_html__('says:', 'topper-pack') . '</span>';
        echo '</div>';
        echo '<div class="comment-metadata">';
        echo '<time datetime="2023-06-16T09:45:00+00:00">' . esc_html__('June 16, 2023 at 9:45 am', 'topper-pack') . '</time>';
        echo ' <span class="edit-link"><a class="comment-edit-link" href="#">' . esc_html__('(Edit)', 'topper-pack') . '</a></span>';
        echo '</div>';
        echo '</div>';
        echo '<div class="comment-content">';
        echo '<p>' . esc_html__('This is another sample comment to demonstrate multiple comments styling.', 'topper-pack') . '</p>';
        echo '<p>' . esc_html__('It includes multiple paragraphs to show how larger comments appear.', 'topper-pack') . '</p>';
        echo '</div>';
        echo '<div class="reply">';
        echo '<a rel="nofollow" class="comment-reply-link" href="#" data-commentid="3" data-postid="1" data-belowelement="comment-3" data-respondelement="respond" data-replyto="'.esc_attr__('Reply to Alex Johnson', 'topper-pack').'">' . esc_html__('Reply', 'topper-pack') . '</a>';
        echo '</div>';
        echo '</div><!-- #comment-## -->';

        echo '</div>'; // End comments list

        // Comment pagination (sample) with WordPress classes
        echo '<div class="topppa-comments-pagination navigation">';
        echo '<div class="nav-links">';
        echo '<span aria-current="page" class="page-numbers current">1</span>';
        echo '<a class="page-numbers" href="#">' . esc_html__('2', 'topper-pack') . '</a>';
        echo '<a class="next page-numbers" href="#">&raquo;</a>';
        echo '</div>';
        echo '</div>';

        // Sample comment form with WordPress structure
        echo '<div class="comment-respond form-style-' . esc_attr($form_style) . '">';
        echo '<div id="respond" class="comment-respond">';
        echo '<h3 id="reply-title" class="comment-reply-title">' . esc_html__('Leave a Comment', 'topper-pack') . ' <small><a rel="nofollow" id="cancel-comment-reply-link" href="#" style="display:none;">' . esc_html__('Cancel reply', 'topper-pack') . '</a></small></h3>';
        echo '<form id="commentform" class="comment-form form-style-' . esc_attr($form_style) . '">';
        echo '<p class="comment-notes">' . esc_html__('Your email address will not be published. Required fields are marked', 'topper-pack') . ' <span class="required">*</span></p>';

        echo '<p class="comment-form-comment">';
        echo '<label for="comment">' . esc_html__('Comment', 'topper-pack') . ' <span class="required">*</span></label>';
        echo '<textarea id="comment" name="comment" cols="45" rows="8" required></textarea>';
        echo '</p>';

        echo '<p class="comment-form-author">';
        echo '<label for="author">' . esc_html__('Name', 'topper-pack') . ' <span class="required">*</span></label>';
        echo '<input id="author" name="author" type="text" size="30" required />';
        echo '</p>';

        echo '<p class="comment-form-email">';
        echo '<label for="email">' . esc_html__('Email', 'topper-pack') . ' <span class="required">*</span></label>';
        echo '<input id="email" name="email" type="email" size="30" required />';
        echo '</p>';

        echo '<p class="comment-form-url">';
        echo '<label for="url">' . esc_html__('Website', 'topper-pack') . '</label>';
        echo '<input id="url" name="url" type="url" size="30" />';
        echo '</p>';

        echo '<p class="comment-form-cookies-consent">';
        echo '<input id="wp-comment-cookies-consent" name="wp-comment-cookies-consent" type="checkbox" value="yes" />';
        echo '<label for="wp-comment-cookies-consent">' . esc_html__('Save my name, email, and website in this browser for the next time I comment.', 'topper-pack') . '</label>';
        echo '</p>';

        echo '<p class="form-submit wp-block-button">';
        echo '<input name="submit" type="submit" id="submit" class="submit wp-block-button__link wp-element-button" value="' . esc_html__('Post Comment', 'topper-pack') . '" />';
        echo '</p>';
        echo '</form>';
        echo '</div>'; // End #respond
        echo '</div>'; // End comment-respond
        echo '</div>'; // End comments area
    }

    /**
     * Render real comments for front-end
     */
    private function render_real_comments($post_id, $comment_style, $form_style, $message_style) {
        // Get the message toggle setting
        $settings = $this->get_settings_for_display();
        $show_no_comments_message = $settings['show_no_comments_message'] ?? 'yes';

        // Check if comments are open
        if (comments_open($post_id) || get_comments_number($post_id)) {
            // Start comment section
            echo '<div class="topppa-comments-area">';

            // Get comments for the current post
            $comments = get_comments([
                'post_id' => $post_id,
                'status'  => 'approve',
            ]);

            // Display comments list with the style class
            echo '<div class="topppa-comments-list style-' . esc_attr($comment_style) . '">';

            $comment_count = count($comments);

            if ($comment_count > 0) {
                // Only show title when there are comments
                echo '<h3 class="topppa-comments-title">';
                if ($comment_count === 1) {
                    echo esc_html__('1 Comment', 'topper-pack');
                } else {
                   // translators: %s is the number of comments.
                    $comments_text = sprintf(
                        // translators: %s is the number of comments.
                        _n('%s Comment', '%s Comments', $comment_count, 'topper-pack'),
                        number_format_i18n($comment_count) // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
                    );
                    echo esc_html($comments_text);
                }
                echo '</h3>';

                // Use a custom callback to apply our styling
                wp_list_comments([
                    'style'       => 'div',
                    'short_ping'  => true,
                    'avatar_size' => 60,
                    'callback'    => function ($comment, $args, $depth) {
                        $this->custom_comment_callback($comment, $args, $depth);
                    },
                ], $comments);
            } else {
                // Only show "No comments" message if the toggle is set to 'yes'
                if ($show_no_comments_message === 'yes') {
                    echo '<div class="topppa-no-comments-message message-style-' . esc_attr($message_style) . '">' .
                        esc_html__('No comments yet. Be the first to leave a comment!', 'topper-pack') .
                        '</div>';
                }
            }
            echo '</div>';

            // Display comment pagination if needed
            if (get_comment_pages_count() > 1 && get_option('page_comments')) {
                echo '<div class="topppa-comments-pagination">';
                paginate_comments_links([
                    'prev_text' => '&laquo;',
                    'next_text' => '&raquo;',
                ]);
                echo '</div>';
            }

            // Display comment form with selected style class
            echo '<div class="comment-respond form-style-' . esc_attr($form_style) . '">';

            // Apply custom styling to comment form fields
            add_filter('comment_form_defaults', function ($defaults) use ($form_style) {
                // Add our style class to the form
                $defaults['class_form'] = 'comment-form form-style-' . esc_attr($form_style);
                return $defaults;
            });

            comment_form([
                'title_reply' => esc_html__('Leave a Comment', 'topper-pack'),
                'label_submit' => esc_html__('Post Comment', 'topper-pack'),
            ], $post_id);

            echo '</div>';

            echo '</div>';
        } else {
            echo '<div class="topppa-no-comments-message message-style-' . esc_attr($message_style) . '">' .
                esc_html__('Comments are closed for this post.', 'topper-pack') .
                '</div>';
        }
    }

    /**
     * Custom comment callback to apply our styling
     */
    private function custom_comment_callback($comment, $args, $depth) {
        $tag = ('div' === $args['style']) ? 'div' : 'li';

        // Build comment classes
        $comment_classes = 'comment';
        if ($this->get_comment_depth($comment) > 1) {
            $comment_classes .= ' child';
        } else {
            $comment_classes .= ' parent';
        }

?>
        <<?php echo esc_attr($tag); ?> id="comment-<?php comment_ID(); ?>" <?php comment_class($comment_classes, $comment); ?>>
            <div class="comment-meta">
                <div class="comment-author vcard">
                    <?php echo get_avatar($comment, $args['avatar_size']); ?>
                    <cite class="fn"><?php echo esc_html(comment_author($comment)); ?></cite> <span class="says"><?php echo esc_html__('says:', 'topper-pack'); ?></span>
                </div>
                <div class="comment-metadata">
                    <time datetime="<?php echo esc_attr(comment_time('c')); ?>">
                        <?php
                        echo esc_html(comment_date('', $comment));
                        echo ' ' . esc_html__('at', 'topper-pack') . ' ';
                        echo esc_html(comment_time('', $comment));
                        ?>
                    </time>
                    <?php edit_comment_link(esc_html__('(Edit)', 'topper-pack'), ' <span class="edit-link">', '</span>'); ?>
                </div>
            </div>

            <div class="comment-content">
                <?php echo wp_kses_post(comment_text($comment)); ?>
            </div>

            <div class="reply">
                <?php
                comment_reply_link(
                    array_merge(
                        $args,
                        array(
                            'reply_text' => esc_html__('Reply', 'topper-pack'),
                            'depth'      => $depth,
                            'max_depth'  => $args['max_depth'],
                        )
                    ),
                    $comment
                );
                ?>
            </div>
        </<?php echo esc_attr($tag); ?>>
    <?php
    }

    /**
     * Get comment depth
     */
    private function get_comment_depth($comment) {
        $depth = 1;
        $parent_id = $comment->comment_parent;

        while ($parent_id > 0) {
            $depth++;
            $parent = get_comment($parent_id);
            $parent_id = $parent->comment_parent;
        }

        return $depth;
    }

    /**
     * Helper function to get available post types for dropdown
     */
    protected function topppa_get_available_post_types() {
        $post_types = get_post_types(['public' => true], 'objects');
        $exclude = ['elementor_library', 'e-floating-buttons', 'topppa-theme-builder', 'attachment']; // phpcs:ignore WordPressVIPMinimum.Performance.WPQueryParams.PostNotIn_exclude

        $options = [];
        foreach ($post_types as $post_type => $object) {
            // Skip excluded post types
            if (in_array($post_type, $exclude)) continue;

            $options[$post_type] = $object->labels->singular_name;
        }

        return $options;
    }
}