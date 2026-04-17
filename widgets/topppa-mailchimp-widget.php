<?php
use \TopperPack\Includes\Controls\Controls_Manager as TopperPack_Controls_Manager;
use \Elementor\Controls_Manager;
use \Elementor\Widget_Base;
use \Elementor\Group_Control_Typography;
use \Elementor\Icons_Manager;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

class TOPPPA_Mailchimp_Widget extends Widget_Base {

    public function get_name() {
        return 'topppa_mailchimp_form';
    }

    public function get_title() {
        return TOPPPA_EPWB . esc_html__('Mailchimp Form', 'topper-pack');
    }

    public function get_icon() {
        return 'eicon-mail';
    }

	public function get_categories() {
		return ['topper-pack'];
	}

    public function get_keywords() {
        return ['topppa', 'widget', 'mailchimp', 'form', 'subscription', 'email', 'topperpack'];
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
		return 'https://doc.topperpack.com/docs/forms-widgets/mailchimp/';
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
            'double_opt_in',
            [
                'label' => esc_html__('Double Opt-in', 'topper-pack'),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'no',
            ]
        );

        $this->add_control(
            'success_message',
            [
                'label' => esc_html__('Success Message', 'topper-pack'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Successfully subscribed!', 'topper-pack'),
            ]
        );

        $this->add_control(
            'show_name_fields',
            [
                'label' => esc_html__('Show Name Fields', 'topper-pack'),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'no',
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'show_input_labels',
            [
                'label' => esc_html__('Show Input Labels', 'topper-pack'),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'no',
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'first_name_label',
            [
                'label' => esc_html__('First Name Label', 'topper-pack'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('First Name', 'topper-pack'),
                'condition' => [
                    'show_name_fields' => 'yes',
                    'show_input_labels' => 'yes'
                ],
            ]
        );

        $this->add_control(
            'last_name_label',
            [
                'label' => esc_html__('Last Name Label', 'topper-pack'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Last Name', 'topper-pack'),
                'condition' => [
                    'show_name_fields' => 'yes',
                    'show_input_labels' => 'yes'
                ],
            ]
        );

        $this->add_control(
            'email_label',
            [
                'label' => esc_html__('Email Label', 'topper-pack'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Email Address', 'topper-pack'),
                'condition' => [
                    'show_input_labels' => 'yes'
                ],
            ]
        );

        $this->add_control(
            'first_name_placeholder',
            [
                'label' => esc_html__('First Name Placeholder', 'topper-pack'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('First Name', 'topper-pack'),
                'condition' => ['show_name_fields' => 'yes'],
            ]
        );

        $this->add_control(
            'last_name_placeholder',
            [
                'label' => esc_html__('Last Name Placeholder', 'topper-pack'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Last Name', 'topper-pack'),
                'condition' => ['show_name_fields' => 'yes'],
            ]
        );

        $this->add_control(
            'email_placeholder',
            [
                'label' => esc_html__('Email Placeholder', 'topper-pack'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Your email address', 'topper-pack'),
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'submit_text',
            [
                'label' => esc_html__('Submit Button Text', 'topper-pack'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Subscribe', 'topper-pack'),
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'form_style',
            [
                'label' => esc_html__('Form Style', 'topper-pack'),
                'type' => Controls_Manager::SELECT,
                'default' => 'inline',
                'options' => [
                    'inline'    => esc_html__('Inline', 'topper-pack'),
                    'full_width' => esc_html__('Full Width', 'topper-pack'),
                ],
            ]
        );
        $this->add_responsive_control(
            'gap',
            [
                'label' => esc_html__('gap', 'topper-pack'),
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
                'default' => [
                    'unit' => 'px',
                    'size' => 10,
                ],
                'selectors' => [
                    '{{WRAPPER}} .topppa-mailchimp-form .topppa-form-fields.topppa-inline-form' => 'gap: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'form_style' => 'inline'
                ]
            ]
        );

        $this->end_controls_section();

        // Style Section: Labels
        $this->start_controls_section(
            'label_style_section',
            [
                'label' => esc_html__('Labels', 'topper-pack'),
                'tab'   => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'show_input_labels' => 'yes'
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'label_typography',
                'selector' => '{{WRAPPER}} .topppa-form-label',
            ]
        );

        $this->add_control(
            'label_color',
            [
                'label'     => esc_html__('Text Color', 'topper-pack'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .topppa-form-label' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'label_margin',
            [
                'label'      => esc_html__('Margin', 'topper-pack'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px'],
                'selectors'  => [
                    '{{WRAPPER}} .topppa-form-label' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        // Style Section: Inputs
        // Style Section: Inputs
        $this->start_controls_section(
            'input_style_section',
            [
                'label' => esc_html__('Inputs', 'topper-pack'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        // Typography
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'input_typography',
                'selector' => '{{WRAPPER}} .topppa-form-input',
            ]
        );

        // Text Color
        $this->add_responsive_control(
            'input_color',
            [
                'label' => esc_html__('Text Color', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .topppa-form-input' => 'color: {{VALUE}};',
                ],
            ]
        );

        // Placeholder Color
        $this->add_responsive_control(
            'input_placeholder_color',
            [
                'label' => esc_html__('Placeholder Color', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .topppa-form-input::placeholder' => 'color: {{VALUE}};',
                ],
            ]
        );

        // Background
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name'     => 'input_background_color',
                'types'    => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .topppa-form-input',
            ]
        );

        // Border
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name'     => 'input_border',
                'selector' => '{{WRAPPER}} .topppa-form-input',
            ]
        );

        // Border Radius
        $this->add_responsive_control(
            'input_border_radius',
            [
                'label' => esc_html__('Border Radius', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .topppa-form-input' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        // Margin
        $this->add_responsive_control(
            'input_margin',
            [
                'label' => esc_html__('Margin', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem'],
                'selectors' => [
                    '{{WRAPPER}} .topppa-form-input' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        // Padding
        $this->add_responsive_control(
            'input_padding',
            [
                'label'      => esc_html__('Padding', 'topper-pack'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px'],
                'selectors'  => [
                    '{{WRAPPER}} .topppa-form-input' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        // Divider: Focus & Active States
        $this->add_control(
            'input_focus_heading',
            [
                'label'     => esc_html__('Focus & Active State', 'topper-pack'),
                'type'      => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        // Focus Text Color
        $this->add_responsive_control(
            'input_focus_color',
            [
                'label' => esc_html__('Text Color (Focus)', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .topppa-form-input:focus' => 'color: {{VALUE}};',
                ],
            ]
        );

        // Focus Placeholder Color
        $this->add_responsive_control(
            'input_focus_placeholder_color',
            [
                'label' => esc_html__('Placeholder Color (Focus)', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .topppa-form-input:focus::placeholder' => 'color: {{VALUE}};',
                ],
            ]
        );

        // Focus Background
        $this->add_responsive_control(
            'input_focus_bg',
            [
                'label' => esc_html__('Background (Focus)', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .topppa-form-input:focus' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        // Focus Border
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name'     => 'input_focus_border',
                'label'    => esc_html__('Border (Focus)', 'topper-pack'),
                'selector' => '{{WRAPPER}} .topppa-form-input:focus',
            ]
        );

        $this->end_controls_section();


        // Style Section: Submit Button
        $this->start_controls_section(
            'submit_style_section',
            [
                'label' => esc_html__('Submit Button', 'topper-pack'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'submit_align',
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
                    '{{WRAPPER}} .topppa-mailchimp-form .topppa-form-fields.topppa-inline-form .topppa-form-field' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'submit_box_width',
            [
                'label' => esc_html__('Box Width', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->add_responsive_control(
            'submit_box_max_width',
            [
                'label' => esc_html__('Max Width', 'topper-pack'),
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
                    '{{WRAPPER}} .topppa-mailchimp-form .topppa-form-fields.topppa-inline-form .topppa-form-field:last-child' => 'max-width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'submit_box_field_width',
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
                    '{{WRAPPER}} .topppa-mailchimp-form .topppa-form-fields.topppa-inline-form .topppa-form-field:last-child' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'more_options',
            [
                'label' => esc_html__('Button Width', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->add_responsive_control(
            'submit_width',
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
                    '{{WRAPPER}} .topppa-mailchimp-form .topppa-submit-button' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'submit_typography',
                'selector' => '{{WRAPPER}} .topppa-submit-button',
            ]
        );

        // Start Normal and Hover tabs
        $this->start_controls_tabs('submit_style_tabs');

        // Normal Tab
        $this->start_controls_tab(
            'submit_style_normal',
            [
                'label' => esc_html__('Normal', 'topper-pack'),
            ]
        );

        $this->add_control(
            'submit_color',
            [
                'label'     => esc_html__('Text Color', 'topper-pack'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .topppa-submit-button' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'submit_background_color',
                'types' => ['classic', 'gradient', 'video'],
                'selector' => '{{WRAPPER}} .topppa-submit-button',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'submit_border',
                'selector' => '{{WRAPPER}} .topppa-submit-button',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'submit_box_shadow',
                'selector' => '{{WRAPPER}} .topppa-submit-button',
            ]
        );

        $this->end_controls_tab();

        // Hover Tab
        $this->start_controls_tab(
            'submit_style_hover',
            [
                'label' => esc_html__('Hover', 'topper-pack'),
            ]
        );

        $this->add_control(
            'submit_hover_color',
            [
                'label'     => esc_html__('Text Color', 'topper-pack'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .topppa-submit-button:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'submit_hover_background_color',
                'types' => ['classic', 'gradient', 'video'],
                'selector' => '{{WRAPPER}} .topppa-submit-button:hover',
            ]
        );

        $this->add_control(
            'submit_hover_border_color',
            [
                'label'     => esc_html__('Border Color', 'topper-pack'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .topppa-submit-button:hover' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'submit_hover_box_shadow',
                'selector' => '{{WRAPPER}} .topppa-submit-button:hover',
            ]
        );

        $this->add_control(
            'submit_hover_animation',
            [
                'label' => esc_html__('Hover Animation', 'topper-pack'),
                'type' => Controls_Manager::HOVER_ANIMATION,
            ]
        );
        $this->add_responsive_control(
            'enable_button_transform',
            [
                'label' => esc_html__('Transform', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'translateY(-2px)',
                'options' => [
                    'translateY(-2px)' => esc_html__('Default', 'topper-pack'),
                    'unset' => esc_html__('None', 'topper-pack'),
                ],
                'selectors' => [
                    '{{WRAPPER}} .topppa-mailchimp-form .topppa-submit-button:hover' => 'transform: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'submit_hover_transition',
            [
                'label' => esc_html__('Transition Duration', 'topper-pack'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0.1,
                        'max' => 2,
                        'step' => 0.1,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .topppa-submit-button' => 'transition: all {{SIZE}}s;',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();
        $this->add_responsive_control(
            'submit_margin',
            [
                'label'      => esc_html__('Margin', 'topper-pack'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'separator' => 'before',
                'selectors'  => [
                    '{{WRAPPER}} .topppa-submit-button' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'submit_padding',
            [
                'label'      => esc_html__('Padding', 'topper-pack'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'separator' => 'before',
                'selectors'  => [
                    '{{WRAPPER}} .topppa-submit-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        // Button Border Radius
        $this->add_control(
            'submit_border_radius',
            [
                'label'      => esc_html__('Border Radius', 'topper-pack'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .topppa-submit-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function get_mailchimp_lists() {
        $options = ['' => esc_html__('Select List', 'topper-pack')];
        $api_key = 'YOUR_MAILCHIMP_API_KEY'; // Replace with secure retrieval
        if (!$api_key) return $options;

        $server = explode('-', $api_key)[1] ?? '';
        if (!$server) return $options;

        $url = "https://{$server}.api.mailchimp.com/3.0/lists";
        $response = wp_remote_get($url, [
            'headers' => [
                'Authorization' => 'apikey ' . $api_key,
                'Content-Type'  => 'application/json',
            ],
        ]);

        if (!is_wp_error($response) && is_array($response)) {
            $body = json_decode($response['body'], true);
            if (isset($body['lists']) && is_array($body['lists'])) {
                foreach ($body['lists'] as $list) {
                    $options[$list['id']] = $list['name'];
                }
            }
        }
        return $options;
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        $form_class = $settings['form_style'] === 'inline' ? 'topppa-inline-form' : 'topppa-full-width-form';
        $animation_class = (!empty($settings['submit_hover_animation']) && $settings['submit_hover_animation'] !== 'none')
            ? 'elementor-animation-' . $settings['submit_hover_animation']
            : '';


?>
        <div class="topppa-mailchimp-form">
            <form method="post" class="topppa-mailchimp"
                data-success-message="<?php echo esc_attr($settings['success_message']); ?>">
                <div class="topppa-message"></div>
                <input type="hidden" name="double_opt_in" value="<?php echo esc_attr($settings['double_opt_in']); ?>">
                <?php wp_nonce_field('topppa_mailchimp_subscribe', 'topppa_mailchimp_nonce'); ?>

                <div class="topppa-form-fields <?php echo esc_attr($form_class); ?>">
                    <?php if ($settings['show_name_fields'] === 'yes'): ?>
                        <div class="topppa-form-field">
                            <?php if ($settings['show_input_labels'] === 'yes'): ?>
                                <label class="topppa-form-label"><?php echo esc_html($settings['first_name_label']); ?></label>
                            <?php endif; ?>
                            <input type="text" name="first_name" class="topppa-form-input" placeholder="<?php echo esc_attr($settings['first_name_placeholder']); ?>" required>
                        </div>
                        <div class="topppa-form-field">
                            <?php if ($settings['show_input_labels'] === 'yes'): ?>
                                <label class="topppa-form-label"><?php echo esc_html($settings['last_name_label']); ?></label>
                            <?php endif; ?>
                            <input type="text" name="last_name" class="topppa-form-input" placeholder="<?php echo esc_attr($settings['last_name_placeholder']); ?>" required>
                        </div>
                    <?php endif; ?>

                    <div class="topppa-form-field">
                        <?php if ($settings['show_input_labels'] === 'yes'): ?>
                            <label class="topppa-form-label"><?php echo esc_html($settings['email_label']); ?></label>
                        <?php endif; ?>
                        <input type="email" name="email" class="topppa-form-input" placeholder="<?php echo esc_attr($settings['email_placeholder']); ?>" required>
                    </div>

                    <div class="topppa-form-field">
                        <button type="submit" class="topppa-submit-button <?php echo esc_attr($animation_class); ?>">
                            <?php echo esc_html($settings['submit_text']); ?>
                        </button>

                    </div>
                </div>
            </form>
        </div>

        <script>
            jQuery(document).ready(function($) {
                $('.topppa-mailchimp').on('submit', function(e) {
                    e.preventDefault();
                    var $form = $(this);
                    var listId = $form.data('list-id');
                    var successMessage = $form.data('success-message');
                    var doubleOptIn = $form.find('input[name="double_opt_in"]').val() === 'yes';
                    var data = $form.serialize();

                    $.ajax({
                        url: '<?php echo esc_url(admin_url('admin-ajax.php')); ?>',
                        type: 'POST',
                        data: {
                            action: 'topppa_mailchimp_subscribe',
                            list_id: listId,
                            form_data: data,
                            double_opt_in: doubleOptIn,
                            topppa_mailchimp_nonce: $form.find('input[name="topppa_mailchimp_nonce"]').val()
                        },
                        success: function(response) {
                            var $message = $form.find('.topppa-message');
                            $message.removeClass('success error');
                            if (response.success) {
                                $message.addClass('success').text(successMessage);
                            } else {
                                $message.addClass('error').text(response.data.message || 'An error occurred.');
                            }
                        },
                        error: function() {
                            $form.find('.topppa-message').addClass('error').text('Request failed.');
                        }
                    });
                });
            });
        </script>
<?php
    }

    public static function handle_mailchimp_subscribe() {
        // Verify nonce first
        if (!isset($_POST['topppa_mailchimp_nonce']) || !wp_verify_nonce(wp_unslash($_POST['topppa_mailchimp_nonce']), 'topppa_mailchimp_subscribe')) { // phpcs:ignore WordPress.Security.ValidatedSanitizedInput.InputNotSanitized
            wp_send_json_error(['message' => 'Security verification failed']);
        }

        // Validate and sanitize inputs
        if (!isset($_POST['list_id'])) {
            wp_send_json_error(['message' => 'List ID is required']);
        }
        
        $list_id = sanitize_text_field(wp_unslash($_POST['list_id']));
        
        $form_data = [];
        if (isset($_POST['form_data'])) {
            parse_str(sanitize_text_field(wp_unslash($_POST['form_data'])), $form_data);
        }
        
        $double_opt_in = false;
        if (isset($_POST['double_opt_in'])) {
            $double_opt_in = sanitize_text_field(wp_unslash($_POST['double_opt_in'])) === 'yes';
        }
        
        $api_key = 'YOUR_MAILCHIMP_API_KEY'; // Replace with secure retrieval
        $server = explode('-', $api_key)[1] ?? '';

        if (!$list_id || !$server) {
            wp_send_json_error(['message' => 'Invalid list ID or API key']);
        }

        $url = "https://{$server}.api.mailchimp.com/3.0/lists/{$list_id}/members";
        $email = sanitize_email($form_data['email']);
        $body = [
            'email_address' => $email,
            'status' => $double_opt_in ? 'pending' : 'subscribed',
            'merge_fields' => [
                'FNAME' => sanitize_text_field($form_data['first_name'] ?? ''),
                'LNAME' => sanitize_text_field($form_data['last_name'] ?? ''),
            ],
        ];

        $response = wp_remote_post($url, [
            'headers' => [
                'Authorization' => 'apikey ' . $api_key,
                'Content-Type'  => 'application/json',
            ],
            'body' => json_encode($body),
        ]);

        if (is_wp_error($response)) {
            wp_send_json_error(['message' => $response->get_error_message()]);
        }

        $response_code = wp_remote_retrieve_response_code($response);
        $response_body = json_decode(wp_remote_retrieve_body($response), true);

        if ($response_code == 200) {
            wp_send_json_success();
        } else {
            wp_send_json_error(['message' => $response_body['detail'] ?? 'Subscription failed']);
        }
    }
}

// Register AJAX handler in your plugin's main file
add_action('wp_ajax_topppa_mailchimp_subscribe', ['TOPPPA_Wp_Forms_Widget', 'handle_mailchimp_subscribe']);
add_action('wp_ajax_nopriv_topppa_mailchimp_subscribe', ['TOPPPA_Wp_Forms_Widget', 'handle_mailchimp_subscribe']);