<?php

use \TopperPack\Includes\Controls\Controls_Manager as TopperPack_Controls_Manager;
use Elementor\Controls_Manager;
use Elementor\Widget_Base;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Text_Shadow;

class TOPPPA_WeForm_Widget extends Widget_Base {

    public function get_name() {
        return 'topppa-weform';
    }

    public function get_title() {
        return TOPPPA_EPWB . esc_html__('WeForms', 'topper-pack');
    }

    public function get_icon() {
        return 'eicon-form-horizontal';
    }

	public function get_categories() {
		return ['topper-pack'];
	}

    public function get_keywords() {
        return ['topppa', 'widget', 'weform', 'form', 'topperpack'];
    }

    public function get_custom_help_url() {
        return 'https://doc.topperpack.com/docs/form-widgets/weforms/';
    }

    protected function register_controls() {
        // Content Section
        $this->start_controls_section(
            'topppa_weform_content_section',
            [
                'label' => esc_html__('Form', 'topper-pack'),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'topppa_weform_form_id',
            [
                'label' => esc_html__('Select Form', 'topper-pack'),
                'type' => Controls_Manager::SELECT,
                'label_block' => true,
                'options' => $this->get_weforms(),
                'default' => '', // Changed from '0' to ''
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'form_heading',
            [
                'label' => esc_html__('Form Heading', 'topper-pack'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'form_heading_typo',
                'selector' => '{{WRAPPER}} .topppa-weform-container .wpuf-section-title',
            ]
        );
        $this->add_responsive_control(
            'form_heading_color',
            [
                'label'     => esc_html__('Color', 'topper-pack'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .topppa-weform-container .wpuf-section-title' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_responsive_control(
            'form_heading_margin',
            [
                'label'      => esc_html__('Margin', 'topper-pack'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .topppa-weform-container .wpuf-section-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'form_heading_padding',
            [
                'label'      => esc_html__('Padding', 'topper-pack'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .topppa-weform-container .wpuf-section-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();

        // Fields Style Section
        $this->start_controls_section(
            'topppa_weform__section_fields_style',
            [
                'label' => esc_html__('Fields', 'topper-pack'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'topppa_weform_large_field_width',
            [
                'label' => esc_html__('Input Width', 'topper-pack'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'default' => [
                    'unit' => '%',
                    'size' => 100
                ],
                'range' => [
                    '%' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                    'px' => [
                        'min' => 1,
                        'max' => 800,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .wpuf-form-add.wpuf-style ul.wpuf-form li .wpuf-fields input[type="text"],
                    {{WRAPPER}} .wpuf-form-add.wpuf-style ul.wpuf-form li .wpuf-fields input[type="password"],
                    {{WRAPPER}} .wpuf-form-add.wpuf-style ul.wpuf-form li .wpuf-fields input[type="email"],
                    {{WRAPPER}} .wpuf-form-add.wpuf-style ul.wpuf-form li .wpuf-fields input[type="url"],
                    {{WRAPPER}} .wpuf-form-add.wpuf-style ul.wpuf-form li .wpuf-fields input[type="number"],
                    {{WRAPPER}} .wpuf-form-add.wpuf-style ul.wpuf-form .wpuf-fields textarea' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'topppa_weform_field_margin',
            [
                'label' => esc_html__('Margin', 'topper-pack'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .wpuf-fields input:not(.weforms_submit_btn)' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                    '{{WRAPPER}} .wpuf-form-add.wpuf-style ul.wpuf-form .wpuf-fields textarea' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'topppa_weform_field_padding',
            [
                'label' => esc_html__('Padding', 'topper-pack'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .wpuf-fields input:not(.weforms_submit_btn)' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                    '{{WRAPPER}} .wpuf-form-add.wpuf-style ul.wpuf-form .wpuf-fields textarea' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'topppa_weform_field_border_radius',
            [
                'label' => esc_html__('Border Radius', 'topper-pack'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .wpuf-fields input:not(.weforms_submit_btn), {{WRAPPER}} .wpuf-fields textarea' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'topppa_weform_field_typography',
                'label' => esc_html__('Typography', 'topper-pack'),
                'selector' => '{{WRAPPER}} .wpuf-form-add.wpuf-style ul.wpuf-form .wpuf-fields input:not(.weforms_submit_btn), .wpuf-form-add.wpuf-style ul.wpuf-form .wpuf-fields textarea',
            ]
        );

        $this->add_control(
            'topppa_weform_field_textcolor',
            [
                'label' => esc_html__('Input Text Color', 'topper-pack'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .wpuf-form-add.wpuf-style ul.wpuf-form .wpuf-fields input:not(.weforms_submit_btn), {{WRAPPER}} .wpuf-form-add.wpuf-style ul.wpuf-form .wpuf-fields textarea' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'topppa_weform_field_placeholder_color',
            [
                'label' => esc_html__('Input Placeholder Color', 'topper-pack'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} ::-webkit-input-placeholder' => 'color: {{VALUE}};',
                    '{{WRAPPER}} ::-moz-placeholder' => 'color: {{VALUE}};',
                    '{{WRAPPER}} ::-ms-input-placeholder' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->start_controls_tabs('topppa_weform_tabs_field_state');

        $this->start_controls_tab(
            'topppa_weform_tab_field_normal',
            [
                'label' => esc_html__('Normal', 'topper-pack'),
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'topppa_weform_field_border',
                'selector' => '{{WRAPPER}} .wpuf-form-add.wpuf-style ul.wpuf-form .wpuf-fields input:not(.weforms_submit_btn), {{WRAPPER}} .wpuf-form-add.wpuf-style ul.wpuf-form .wpuf-fields textarea',
                'fields_options' => [
                    'border' => [
                        'default' => 'solid',
                    ],
                    'width' => [
                        'default' => [
                            'top' => 1,
                            'right' => 1,
                            'bottom' => 1,
                            'left' => 1,
                            'unit' => 'px',
                        ],
                    ],
                    'color' => [
                        'default' => '#cccccc',
                    ],
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'topppa_weform_field_box_shadow',
                'selector' => '{{WRAPPER}} .wpuf-form-add.wpuf-style ul.wpuf-form .wpuf-fields input:not(.weforms_submit_btn), {{WRAPPER}} .wpuf-form-add.wpuf-style ul.wpuf-form .wpuf-fields textarea',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'topppa_weform_field_bg_color',
                'types' => ['classic', 'gradient', 'video'],
                'selector' => '{{WRAPPER}} .wpuf-form-add.wpuf-style ul.wpuf-form .wpuf-fields input:not(.weforms_submit_btn), {{WRAPPER}} .wpuf-form-add.wpuf-style ul.wpuf-form .wpuf-fields textarea',
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'topppa_weform_tab_field_focus',
            [
                'label' => esc_html__('Focus', 'topper-pack'),
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'topppa_weform_field_focus_border',
                'selector' => '{{WRAPPER}} .wpuf-form-add.wpuf-style ul.wpuf-form .wpuf-fields input:focus:not(.weforms_submit_btn), {{WRAPPER}} .wpuf-form-add.wpuf-style ul.wpuf-form .wpuf-fields textarea:focus',
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'topppa_weform_field_focus_box_shadow',
                'selector' => '{{WRAPPER}} .wpuf-form-add.wpuf-style ul.wpuf-form .wpuf-fields input:focus:not(.weforms_submit_btn), {{WRAPPER}} .wpuf-form-add.wpuf-style ul.wpuf-form .wpuf-fields textarea:focus',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'topppa_weform_field_focus_bg_color',
                'types' => ['classic', 'gradient', 'video'],
                'selector' => '{{WRAPPER}} .wpuf-form-add.wpuf-style ul.wpuf-form .wpuf-fields input:focus:not(.weforms_submit_btn), {{WRAPPER}} .wpuf-form-add.wpuf-style ul.wpuf-form .wpuf-fields textarea:focus',
            ]
        );

        $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->end_controls_section();

        // Label Style Section
        $this->start_controls_section(
            'topppa_weform_form-label',
            [
                'label' => esc_html__('Label', 'topper-pack'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'topppa_weform_label_margin',
            [
                'label' => esc_html__('Margin', 'topper-pack'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} ul.wpuf-form.form-label-above li .wpuf-label' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'topppa_weform_label_padding',
            [
                'label' => esc_html__('Padding', 'topper-pack'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} ul.wpuf-form.form-label-above li .wpuf-label' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'topppa_weform_hr3',
            [
                'type' => Controls_Manager::DIVIDER,
                'style' => 'thick',
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'topppa_weform_label_typography',
                'label' => esc_html__('Label Typography', 'topper-pack'),
                'selector' => '{{WRAPPER}} .wpuf-label label, {{WRAPPER}} .wpuf-form-sub-label',
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'topppa_weform_desc_typography',
                'label' => esc_html__('Help Text Typography', 'topper-pack'),
                'selector' => '{{WRAPPER}} .wpuf-fields .wpuf-help',
            ]
        );

        $this->add_control(
            'topppa_weform_label_color',
            [
                'label' => esc_html__('Label Text Color', 'topper-pack'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .wpuf-label label, {{WRAPPER}} .wpuf-form-sub-label' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'topppa_weform_requered_label',
            [
                'label' => esc_html__('Required Label Color', 'topper-pack'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .wpuf-label .required' => 'color: {{VALUE}} !important',
                ],
            ]
        );

        $this->add_control(
            'topppa_weform_desc_color',
            [
                'label' => esc_html__('Help Text Color', 'topper-pack'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .wpuf-fields .wpuf-help' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_section();

        // Submit Button Style Section
        $this->start_controls_section(
            'topppa_weform_submit',
            [
                'label' => esc_html__('Button', 'topper-pack'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'topppa_weform_submit_btn_width',
            [
                'label' => esc_html__('Button Full Width?', 'topper-pack'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'topper-pack'),
                'label_off' => esc_html__('No', 'topper-pack'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_responsive_control(
            'topppa_weform_button_width',
            [
                'label' => esc_html__('Button Width', 'topper-pack'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'condition' => [
                    'topppa_weform_submit_btn_width' => 'yes'
                ],
                'default' => [
                    'unit' => '%',
                    'size' => 100
                ],
                'range' => [
                    '%' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                    'px' => [
                        'min' => 1,
                        'max' => 800,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .wpuf-form-add.wpuf-style ul.wpuf-form .wpuf-submit .weforms_submit_btn' => 'display: block; width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'topppa_weform_submit_btn_position',
            [
                'label' => esc_html__('Button Position', 'topper-pack'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => esc_html__('Left', 'topper-pack'),
                        'icon' => 'eicon-h-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__('Center', 'topper-pack'),
                        'icon' => 'eicon-h-align-center',
                    ],
                    'right' => [
                        'title' => esc_html__('Right', 'topper-pack'),
                        'icon' => 'eicon-h-align-right',
                    ],
                ],
                'condition' => [
                    'topppa_weform_submit_btn_width' => ''
                ],
                'desktop_default' => 'left',
                'toggle' => false,
                'selectors' => [
                    '{{WRAPPER}} .wpuf-form-add.wpuf-style ul.wpuf-form .wpuf-submit' => 'text-align: {{Value}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'topppa_weform_submit_margin',
            [
                'label' => esc_html__('Margin', 'topper-pack'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .wpuf-form-add.wpuf-style ul.wpuf-form .wpuf-submit input[type=submit]' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'topppa_weform_submit_padding',
            [
                'label' => esc_html__('Padding', 'topper-pack'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .wpuf-form-add.wpuf-style ul.wpuf-form .wpuf-submit input[type=submit]' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'topppa_weform_submit_typography',
                'selector' => '{{WRAPPER}} .wpuf-form-add.wpuf-style ul.wpuf-form .wpuf-submit input[type=submit]',
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'topppa_weform_submit_border',
                'selector' => '{{WRAPPER}} .wpuf-form-add.wpuf-style ul.wpuf-form .wpuf-submit input[type=submit]',
            ]
        );

        $this->add_control(
            'topppa_weform_submit_border_radius',
            [
                'label' => esc_html__('Border Radius', 'topper-pack'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .wpuf-form-add.wpuf-style ul.wpuf-form .wpuf-submit input[type=submit]' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'topppa_weform_submit_box_shadow',
                'selector' => '{{WRAPPER}} .wpuf-form-add.wpuf-style ul.wpuf-form .wpuf-submit input[type=submit]',
            ]
        );

        $this->add_group_control(
            Group_Control_Text_Shadow::get_type(),
            [
                'name' => 'topppa_weform_submit_text_shadow',
                'selector' => '{{WRAPPER}} .wpuf-form-add.wpuf-style ul.wpuf-form .wpuf-submit input[type=submit]',
            ]
        );

        $this->add_control(
            'topppa_weform_hr4',
            [
                'type' => Controls_Manager::DIVIDER,
                'style' => 'thick',
            ]
        );

        $this->start_controls_tabs('topppa_weform_tabs_button_style');

        $this->start_controls_tab(
            'topppa_weform_tab_button_normal',
            [
                'label' => esc_html__('Normal', 'topper-pack'),
            ]
        );

        $this->add_control(
            'topppa_weform_submit_color',
            [
                'label' => esc_html__('Text Color', 'topper-pack'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .wpuf-form-add.wpuf-style ul.wpuf-form .wpuf-submit input[type=submit]' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'topppa_weform_submit_bg_color',
                'types' => ['classic', 'gradient', 'video'],
                'selector' => '{{WRAPPER}} .wpuf-form-add.wpuf-style ul.wpuf-form .wpuf-submit input[type=submit]',
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'topppa_weform_tab_button_hover',
            [
                'label' => esc_html__('Hover', 'topper-pack'),
            ]
        );

        $this->add_control(
            'topppa_weform_submit_hover_color',
            [
                'label' => esc_html__('Text Color', 'topper-pack'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .wpuf-form-add.wpuf-style ul.wpuf-form .wpuf-submit input[type=submit]:hover, {{WRAPPER}} .wpuf-form-add.wpuf-style ul.wpuf-form .wpuf-submit input[type=submit]:focus' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'background',
                'types' => ['classic', 'gradient', 'video'],
                'selector' => '{{WRAPPER}} .wpuf-form-add.wpuf-style ul.wpuf-form .wpuf-submit input[type=submit]:hover, {{WRAPPER}} .wpuf-form-add.wpuf-style ul.wpuf-form .wpuf-submit input[type=submit]:focus',
            ]
        );

        $this->add_control(
            'topppa_weform_submit_hover_border_color',
            [
                'label' => esc_html__('Border Color', 'topper-pack'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .wpuf-form-add.wpuf-style ul.wpuf-form .wpuf-submit input[type=submit]:hover, {{WRAPPER}} .wpuf-form-add.wpuf-style ul.wpuf-form .wpuf-submit input[type=submit]:focus' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->end_controls_section();
    }

    protected function get_weforms() {
        $forms = [];

        if (class_exists('WeForms')) {
            $we_forms = get_posts([
                'post_type' => 'wpuf_contact_form',
                'post_status' => 'publish',
                'posts_per_page' => -1,
            ]);

            if (!empty($we_forms)) {
                $forms[''] = esc_html__('Select a Form', 'topper-pack'); // Changed key from 0 to ''
                foreach ($we_forms as $form) {
                    $forms[$form->ID] = $form->post_title;
                }
            } else {
                $forms[''] = esc_html__('No WeForms Found', 'topper-pack');
            }
        } else {
            $forms[''] = esc_html__('WeForms Not Installed', 'topper-pack');
        }

        return $forms;
    }

    protected function render() {
        $settings = $this->get_settings_for_display();

        if (!class_exists('WeForms')) {
            echo '<div class="elementor-alert elementor-alert-warning">';
            echo esc_html__('WeForms is not installed or activated!', 'topper-pack');
            echo '</div>';
            return;
        }

        if (empty($settings['topppa_weform_form_id'])) {
            echo '<div class="elementor-alert elementor-alert-info">';
            echo esc_html__('Please select a WeForm!', 'topper-pack');
            echo '</div>';
            return;
        }

        echo '<div class="topppa-weform-container">';
        echo do_shortcode('[weforms id="' . absint($settings['topppa_weform_form_id']) . '"]');
        echo '</div>';
    }
}