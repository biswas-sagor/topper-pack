<?php

use \TopperPack\Includes\Controls\Controls_Manager as TopperPack_Controls_Manager;
use \Elementor\Controls_Manager;
use \Elementor\Widget_Base;
use \Elementor\Group_Control_Typography;
use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Box_Shadow;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

class TOPPPA_Wp_Forms_Widget extends Widget_Base {

    public function get_name() {
        return 'wp_form';
    }

    public function get_title() {
        return TOPPPA_EPWB . esc_html__('WP Forms', 'topper-pack');
    }

    public function get_icon() {
        return 'eicon-form-horizontal';
    }

	public function get_categories() {
		return ['topper-pack'];
	}

    public function get_keywords() {
        return ['topppa', 'widget', 'wpform', 'contact', 'wpforms', 'topperpack'];
    }

    public function get_custom_help_url() {
        return 'https://doc.topperpack.com/docs/forms-widgets/wp-form/';
    }

    protected function register_controls() {
        // Content Section
        $this->start_controls_section(
            'content_section',
            [
                'label' => esc_html__('Form Settings', 'topper-pack'),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'form_id', // Changed to match render method
            [
                'label'       => esc_html__('Select Your Form', 'topper-pack'),
                'type'        => Controls_Manager::SELECT,
                'label_block' => true,
                'default'     => '',
                'options'     => $this->get_wpforms_list(),
            ]
        );

        $this->end_controls_section();

        // Style Section: Form Container
        $this->start_controls_section(
            'style_section',
            [
                'label' => esc_html__('Form Container', 'topper-pack'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'form_width',
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
                    '{{WRAPPER}} .topppa-wp-form-container' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'default_margin',
            [
                'label' => esc_html__('Default Margin', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} div.wpforms-container-full:not(:empty)' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'more_options',
            [
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_responsive_control(
            'form_padding',
            [
                'label'      => esc_html__('Padding', 'topper-pack'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .topppa-wp-form-container' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'form_margin',
            [
                'label' => esc_html__('Margin', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} .topppa-wp-form-container' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'form_background_color',
                'types' => ['classic', 'gradient', 'video'],
                'selector' => '{{WRAPPER}} .topppa-wp-form-container',
            ]
        );

        $this->end_controls_section();

        // Style Section: Labels
        $this->start_controls_section(
            'labels_style_section',
            [
                'label' => esc_html__('Labels', 'topper-pack'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'label_color',
            [
                'label'     => esc_html__('Text Color', 'topper-pack'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .topppa-wp-form-container .wpforms-field label' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'label_typography',
                'label'    => esc_html__('Typography', 'topper-pack'),
                'selector' => '{{WRAPPER}} .topppa-wp-form-container .wpforms-field label',
            ]
        );

        $this->end_controls_section();

        // Style Section: Input & Textarea
        $this->start_controls_section(
            'fields_style_section',
            [
                'label' => esc_html__('Input & Textarea', 'topper-pack'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'field_alignment',
            [
                'label'     => esc_html__('Alignment', 'topper-pack'),
                'type'      => Controls_Manager::CHOOSE,
                'options'   => [
                    'left'   => ['title' => esc_html__('Left', 'topper-pack'), 'icon' => 'eicon-text-align-left'],
                    'center' => ['title' => esc_html__('Center', 'topper-pack'), 'icon' => 'eicon-text-align-center'],
                    'right'  => ['title' => esc_html__('Right', 'topper-pack'), 'icon' => 'eicon-text-align-right'],
                ],
                'selectors' => [
                    '{{WRAPPER}} .topppa-wp-form-container .wpforms-field input:not([type=radio]):not([type=checkbox]):not([type=submit]):not([type=button]):not([type=image]):not([type=file]), {{WRAPPER}} .topppa-wp-form-container .wpforms-field textarea, {{WRAPPER}} .topppa-wp-form-container .wpforms-field select' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $this->start_controls_tabs('fields_style_tabs');

        $this->start_controls_tab(
            'fields_normal_tab',
            [
                'label' => esc_html__('Normal', 'topper-pack'),
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'field_background_color',
                'types' => ['classic', 'gradient', 'video'],
                'selector' => '{{WRAPPER}} .topppa-wp-form-container .wpforms-field input:not([type=radio]):not([type=checkbox]):not([type=submit]):not([type=button]):not([type=image]):not([type=file]), {{WRAPPER}} .topppa-wp-form-container .wpforms-field textarea, {{WRAPPER}} .topppa-wp-form-container .wpforms-field select',
            ]
        );

        $this->add_control(
            'field_text_color',
            [
                'label'     => esc_html__('Text Color', 'topper-pack'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .topppa-wp-form-container .wpforms-field input:not([type=radio]):not([type=checkbox]):not([type=submit]):not([type=button]):not([type=image]):not([type=file]), {{WRAPPER}} .topppa-wp-form-container .wpforms-field textarea, {{WRAPPER}} .topppa-wp-form-container .wpforms-field select' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'field_border',
                'selector' => '{{WRAPPER}} .topppa-wp-form-container .wpforms-field input:not([type=radio]):not([type=checkbox]):not([type=submit]):not([type=button]):not([type=image]):not([type=file]), {{WRAPPER}} .topppa-wp-form-container .wpforms-field textarea, {{WRAPPER}} .topppa-wp-form-container .wpforms-field select',
            ]
        );

        $this->add_control(
            'field_border_radius',
            [
                'label'      => esc_html__('Border Radius', 'topper-pack'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .topppa-wp-form-container .wpforms-field input:not([type=radio]):not([type=checkbox]):not([type=submit]):not([type=button]):not([type=image]):not([type=file]), {{WRAPPER}} .topppa-wp-form-container .wpforms-field textarea, {{WRAPPER}} .topppa-wp-form-container .wpforms-field select' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'field_padding',
            [
                'label'      => esc_html__('Padding', 'topper-pack'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .topppa-wp-form-container .wpforms-field input:not([type=radio]):not([type=checkbox]):not([type=submit]):not([type=button]):not([type=image]):not([type=file]), {{WRAPPER}} .topppa-wp-form-container .wpforms-field textarea, {{WRAPPER}} .topppa-wp-form-container .wpforms-field select' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'field_box_shadow',
                'selector' => '{{WRAPPER}} .topppa-wp-form-container .wpforms-field input:not([type=radio]):not([type=checkbox]):not([type=submit]):not([type=button]):not([type=image]):not([type=file]), {{WRAPPER}} .topppa-wp-form-container .wpforms-field textarea, {{WRAPPER}} .topppa-wp-form-container .wpforms-field select',
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'fields_focus_tab',
            [
                'label' => esc_html__('Focus', 'topper-pack'),
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'field_focus_background_color',
                'types' => ['classic', 'gradient', 'video'],
                'selector' => '{{WRAPPER}} .topppa-wp-form-container .wpforms-field input:focus, {{WRAPPER}} .topppa-wp-form-container .wpforms-field textarea:focus, {{WRAPPER}} .topppa-wp-form-container .wpforms-field select:focus',
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'field_focus_border',
                'selector' => '{{WRAPPER}} .topppa-wp-form-container .wpforms-field input:focus, {{WRAPPER}} .topppa-wp-form-container .wpforms-field textarea:focus, {{WRAPPER}} .topppa-wp-form-container .wpforms-field select:focus',
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'field_focus_box_shadow',
                'selector' => '{{WRAPPER}} .topppa-wp-form-container .wpforms-field input:focus, {{WRAPPER}} .topppa-wp-form-container .wpforms-field textarea:focus, {{WRAPPER}} .topppa-wp-form-container .wpforms-field select:focus',
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->add_responsive_control(
            'max_input_width',
            [
                'label'      => esc_html__('Input Max Width', 'topper-pack'),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range'      => [
                    'px' => ['min' => 0, 'max' => 1200],
                    '%'  => ['min' => 0, 'max' => 100],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .topppa-wp-form-container .wpforms-field input:not([type=radio]):not([type=checkbox]):not([type=submit]):not([type=button]):not([type=image]):not([type=file]), {{WRAPPER}} .topppa-wp-form-container .wpforms-field select, {{WRAPPER}} .wpforms-container .wpforms-field .wpforms-field-row' => 'max-width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'input_width',
            [
                'label'      => esc_html__('Input Width', 'topper-pack'),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range'      => [
                    'px' => ['min' => 0, 'max' => 1200],
                    '%'  => ['min' => 0, 'max' => 100],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .topppa-wp-form-container .wpforms-field input:not([type=radio]):not([type=checkbox]):not([type=submit]):not([type=button]):not([type=image]):not([type=file]), {{WRAPPER}} .topppa-wp-form-container .wpforms-field select, {{WRAPPER}} .wpforms-container .wpforms-field .wpforms-field-row' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'textarea_width',
            [
                'label'      => esc_html__('Textarea Width', 'topper-pack'),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range'      => [
                    'px' => ['min' => 0, 'max' => 1200],
                    '%'  => ['min' => 0, 'max' => 100],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .topppa-wp-form-container .wpforms-field textarea' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'textarea_height',
            [
                'label'      => esc_html__('Textarea Height', 'topper-pack'),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range'      => [
                    'px' => ['min' => 0, 'max' => 400],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .topppa-wp-form-container .wpforms-field textarea' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        // Style Section: Placeholder
        $this->start_controls_section(
            'placeholder_style_section',
            [
                'label' => esc_html__('Placeholder', 'topper-pack'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'placeholder_color',
            [
                'label'     => esc_html__('Text Color', 'topper-pack'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .topppa-wp-form-container .wpforms-field input::-webkit-input-placeholder, {{WRAPPER}} .topppa-wp-form-container .wpforms-field textarea::-webkit-input-placeholder' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .topppa-wp-form-container .wpforms-field input::-moz-placeholder, {{WRAPPER}} .topppa-wp-form-container .wpforms-field textarea::-moz-placeholder' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .topppa-wp-form-container .wpforms-field input:-ms-input-placeholder, {{WRAPPER}} .topppa-wp-form-container .wpforms-field textarea:-ms-input-placeholder' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .topppa-wp-form-container .wpforms-field input::placeholder, {{WRAPPER}} .topppa-wp-form-container .wpforms-field textarea::placeholder' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'placeholder_typography',
                'label'    => esc_html__('Typography', 'topper-pack'),
                'selector' => '{{WRAPPER}} .topppa-wp-form-container .wpforms-field input::placeholder, {{WRAPPER}} .topppa-wp-form-container .wpforms-field textarea::placeholder',
            ]
        );

        $this->end_controls_section();

        // Style Section: Submit Button
        $this->start_controls_section(
            'submit_button_style_section',
            [
                'label' => esc_html__('Submit Button', 'topper-pack'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'button_width_type',
            [
                'label'        => esc_html__('Width', 'topper-pack'),
                'type'         => Controls_Manager::SELECT,
                'default'      => 'custom',
                'options'      => [
                    'full-width' => esc_html__('Full Width', 'topper-pack'),
                    'custom'     => esc_html__('Custom', 'topper-pack'),
                ],
                'prefix_class' => 'wp-form-button-',
            ]
        );

        $this->add_responsive_control(
            'button_width',
            [
                'label'      => esc_html__('Width', 'topper-pack'),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range'      => [
                    'px' => ['min' => 0, 'max' => 1200],
                    '%'  => ['min' => 0, 'max' => 100],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .topppa-wp-form-container .wpforms-submit-container .wpforms-submit' => 'width: {{SIZE}}{{UNIT}};',
                ],
                'condition'  => [
                    'button_width_type' => 'custom',
                ],
            ]
        );

        $this->add_responsive_control(
            'button_alignment',
            [
                'label'     => esc_html__('Alignment', 'topper-pack'),
                'type'      => Controls_Manager::CHOOSE,
                'options'   => [
                    'left'   => ['title' => esc_html__('Left', 'topper-pack'), 'icon' => 'eicon-text-align-left'],
                    'center' => ['title' => esc_html__('Center', 'topper-pack'), 'icon' => 'eicon-text-align-center'],
                    'right'  => ['title' => esc_html__('Right', 'topper-pack'), 'icon' => 'eicon-text-align-right'],
                ],
                'selectors' => [
                    '{{WRAPPER}} .topppa-wp-form-container .wpforms-submit-container' => 'text-align: {{VALUE}};',
                    '{{WRAPPER}} .topppa-wp-form-container .wpforms-submit-container .wpforms-submit' => 'display: inline-block;',
                ],
                'condition' => [
                    'button_width_type' => 'custom',
                ],
            ]
        );

        $this->start_controls_tabs('button_style_tabs');

        $this->start_controls_tab(
            'button_normal_tab',
            [
                'label' => esc_html__('Normal', 'topper-pack'),
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'button_background_color',
                'types' => ['classic', 'gradient', 'video'],
                'selector' => '{{WRAPPER}} .topppa-wp-form-container .wpforms-submit-container .wpforms-submit',
            ]
        );

        $this->add_control(
            'button_text_color',
            [
                'label'     => esc_html__('Text Color', 'topper-pack'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .topppa-wp-form-container .wpforms-submit-container .wpforms-submit' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'button_typography',
                'label'    => esc_html__('Typography', 'topper-pack'),
                'selector' => '{{WRAPPER}} .topppa-wp-form-container .wpforms-submit-container .wpforms-submit',
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'button_border',
                'selector' => '{{WRAPPER}} .topppa-wp-form-container .wpforms-submit-container .wpforms-submit',
            ]
        );

        $this->add_control(
            'button_border_radius',
            [
                'label'      => esc_html__('Border Radius', 'topper-pack'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .topppa-wp-form-container .wpforms-submit-container .wpforms-submit' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'button_padding',
            [
                'label'      => esc_html__('Padding', 'topper-pack'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .topppa-wp-form-container .wpforms-submit-container .wpforms-submit' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'button_box_shadow',
                'selector' => '{{WRAPPER}} .topppa-wp-form-container .wpforms-submit-container .wpforms-submit',
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'button_hover_tab',
            [
                'label' => esc_html__('Hover', 'topper-pack'),
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'button_hover_background_color',
                'types' => ['classic', 'gradient', 'video'],
                'selector' => '{{WRAPPER}} .topppa-wp-form-container .wpforms-submit-container .wpforms-submit:hover',
            ]
        );

        $this->add_control(
            'button_hover_text_color',
            [
                'label'     => esc_html__('Text Color', 'topper-pack'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .topppa-wp-form-container .wpforms-submit-container .wpforms-submit:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'button_hover_border_color',
            [
                'label'     => esc_html__('Border Color', 'topper-pack'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .topppa-wp-form-container .wpforms-submit-container .wpforms-submit:hover' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

        // Style Section: Errors
        $this->start_controls_section(
            'errors_style_section',
            [
                'label' => esc_html__('Errors', 'topper-pack'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'error_text_color',
            [
                'label'     => esc_html__('Text Color', 'topper-pack'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .topppa-wp-form-container label.wpforms-error' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'error_field_border',
                'selector' => '{{WRAPPER}} .topppa-wp-form-container input.wpforms-error, {{WRAPPER}} .topppa-wp-form-container textarea.wpforms-error',
            ]
        );

        $this->end_controls_section();
    }

    protected function get_wpforms_list() {
        $forms = ['' => esc_html__('Select Form', 'topper-pack')];

        if (class_exists('WPForms')) {
            $wpforms = get_posts([
                'post_type'   => 'wpforms',
                'numberposts' => -1,
            ]);

            foreach ($wpforms as $form) {
                $forms[$form->ID] = $form->post_title;
            }
        }

        return $forms;
    }

    protected function render() {
        $settings = $this->get_settings_for_display();

        if (!class_exists('WPForms')) {
            echo '<div class="elementor-alert elementor-alert-warning">';
            echo esc_html__('WPForms is not installed. Please install and activate WPForms to use this widget.', 'topper-pack');
            echo '</div>';
            return;
        }

        if (empty($settings['form_id'])) {
            echo '<div class="elementor-alert elementor-alert-info">';
            echo esc_html__('Please select a form from the widget settings.', 'topper-pack');
            echo '</div>';
            return;
        }

        echo '<div class="topppa-wp-form-container">';
        echo do_shortcode('[wpforms id="' . esc_attr($settings['form_id']) . '"]');
        echo '</div>';
    }
}