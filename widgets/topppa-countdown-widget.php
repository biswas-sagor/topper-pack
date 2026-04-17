<?php

use \TopperPack\Includes\Controls\Controls_Manager as TopperPack_Controls_Manager;

if (! defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

/**
 * Elementor Counter Info Widget.
 *
 * Elementor widget that inserts an embbedable content into the page, from any given URL.
 *
 * @since 1.0.0
 */
class TOPPPA_Countdown_Widget extends \Elementor\Widget_Base {

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
        return 'topppa_countdown_widget';
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
        return TOPPPA_EPWB . esc_html__('Countdown', 'topper-pack');
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
        return 'eicon-countdown';
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
        return ['topppa', 'widget', 'countdown', 'topperpack'];
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
        return 'https://doc.topperpack.com/docs/service-widgets/countdown/';
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
		return 'https://topperpack.com/assets/widgets/countdown-widget/';
	}

    /**
     * Register Counter widget controls.
     *
     * Add input fields to allow the user to customize the widget settings.
     *
     * @since 1.0.0
     * @access protected
     */
    protected function register_controls() {
        $base_url = $this->get_custom_image_url();
        // <========================>
        // <========================> topppa COUNTER STYLES <========================>

        $this->start_controls_section(
            'topppa_content_style_option',
            [
                'label' => esc_html__('Countdown Styles', 'topper-pack'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_control(
            'topppa_content_styles_choose',
            [
                'label' => esc_html__('Choose Style', 'topper-pack'),
                'type' => TopperPack_Controls_Manager::IMAGECHOOSE,
                'default' => 'style_one',
                'options' => [
                    'style_one'      => [
                        'title'      => esc_html__('Style 1', 'topper-pack'),
                        'imagelarge' => $base_url . 'topppa-countdown.jpg',
                        'imagesmall' => $base_url . 'topppa-countdown.jpg',
                        'width'      => '100%',
                    ],
                    'style_two'      => [
                        'title'      => esc_html__('Style 2', 'topper-pack'),
                        'imagelarge' => $base_url . 'topppa-countdown-2.jpg',
                        'imagesmall' => $base_url . 'topppa-countdown-2.jpg',
                        'width'      => '100%',
                    ],
                    'style_three'    => [
                        'title'      => esc_html__('Style 3', 'topper-pack'),
                        'imagelarge' => $base_url . 'topppa-countdown-3.jpg',
                        'imagesmall' => $base_url . 'topppa-countdown-3.jpg',
                        'width'      => '100%',
                    ],
                    'style_four'     => [
                        'title'      => esc_html__('Style 4', 'topper-pack'),
                        'imagelarge' => $base_url . 'topppa-countdown-4.jpg',
                        'imagesmall' => $base_url . 'topppa-countdown-4.jpg',
                        'width'      => '100%',
                    ],
                ],
            ]
        );
        $this->end_controls_section();

        $this->start_controls_section(
            'countdown_options',
            [
                'label' => esc_html__('Countdown', 'topper-pack'),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_control(
            'tp_cd_due_date',
            [
                'label' => esc_html__('Date', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DATE_TIME,
            ]
        );
        $this->add_responsive_control(
            'box_jalign',
            [
                'label' => esc_html__('Alignment', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'flex-start' => [
                        'title' => esc_html__('Left', 'topper-pack'),
                        'icon' => 'eicon-justify-start-h',
                    ],
                    'center' => [
                        'title' => esc_html__('Center', 'topper-pack'),
                        'icon' => 'eicon-justify-center-h',
                    ],
                    'flex-end' => [
                        'title' => esc_html__('Right', 'topper-pack'),
                        'icon' => 'eicon-justify-end-h',
                    ],
                    'space-between' => [
                        'title' => esc_html__('Between', 'topper-pack'),
                        'icon' => 'eicon-justify-space-between-h',
                    ],
                    'space-around' => [
                        'title' => esc_html__('Around', 'topper-pack'),
                        'icon' => 'eicon-justify-space-around-h',
                    ],
                    'space-evenly' => [
                        'title' => esc_html__('Evenly', 'topper-pack'),
                        'icon' => 'eicon-justify-space-evenly-h',
                    ],
                ],
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .countdown-box .countdown-list' => 'justify-content: {{VALUE}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'box_gap',
            [
                'label' => esc_html__('Gap', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
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
                'default' => [
                    'unit' => 'px',
                    'size' => 20,
                ],
                'selectors' => [
                    '{{WRAPPER}} .countdown-box .countdown-list' => 'gap: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();
        $this->start_controls_section(
            'box_styles',
            [
                'label' => esc_html__('Box Style', 'topper-pack'),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
                'condition' => [
                    'topppa_content_styles_choose' => 'style_two',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'box_bg',
                'label' => esc_html__('Background', 'topper-pack'),
                'types' => ['classic', 'gradient', 'video'],
                'selector' => '{{WRAPPER}} .countdown-box .countdown-list',
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'box_border',
                'label' => esc_html__('Border', 'topper-pack'),
                'selector' => '{{WRAPPER}} .countdown-box .countdown-list',
            ]
        );
        $this->add_responsive_control(
            'box_radius',
            [
                'label' => esc_html__('Border Radius', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .countdown-box .countdown-list' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'box_shadow',
                'label' => esc_html__('Box Shadow', 'topper-pack'),
                'selector' => '{{WRAPPER}} .countdown-box .countdown-list',
            ]
        );
        $this->add_responsive_control(
            'box_margin',
            [
                'label' => esc_html__('Margin', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .countdown-box .countdown-list' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'box_padding',
            [
                'label' => esc_html__('Margin', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .countdown-box .countdown-list' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();
        $this->start_controls_section(
            'content_box_styles',
            [
                'label' => esc_html__('Content Box', 'topper-pack'),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
                'condition' => [
                    'topppa_content_styles_choose!' => 'style_two',
                ],
            ]
        );
        $this->add_responsive_control(
            'content_box_height',
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
                    '{{WRAPPER}} .countdown-box .countdown-message' => 'height: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .countdown-box .countdown-item' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'content_box_width',
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
                    '{{WRAPPER}} .countdown-box .countdown-message' => 'width: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .countdown-box .countdown-item' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'content_box_bg_color',
                'types' => ['classic', 'gradient', 'video'],
                'selector' => '{{WRAPPER}} .countdown-box .countdown-message,{{WRAPPER}} .countdown-box .countdown-item',
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'content_box_border',
                'selector' => '{{WRAPPER}} .countdown-box .countdown-message,{{WRAPPER}} .countdown-box .countdown-item',
            ]
        );
        $this->add_responsive_control(
            'content_box_border_radius',
            [
                'label' => esc_html__('Border Radius', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .countdown-box .countdown-item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .countdown-box .countdown-message' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'content_box_box_shadow',
                'selector' => '{{WRAPPER}} .countdown-box .countdown-message,{{WRAPPER}} .countdown-box .countdown-item',
            ]
        );
        $this->add_responsive_control(
            'content_box_margin',
            [
                'label'      => esc_html__('Margin', 'topper-pack'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .countdown-box .countdown-message' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .countdown-box .countdown-item' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'content_box_padding',
            [
                'label'      => esc_html__('Padding', 'topper-pack'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .countdown-box .countdown-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .countdown-box .countdown-message' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();

        $this->start_controls_section(
            'countdown_content_styles',
            [
                'label' => esc_html__('Countdown Content', 'topper-pack'),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_responsive_control(
            'content_position',
            [
                'label' => esc_html__('Content Position', 'topper-pack'),
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
                    '{{WRAPPER}} .countdown-box .countdown-item' => 'flex-direction: {{VALUE}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'box_countdown_content_gap',
            [
                'label' => esc_html__('Gap', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
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
                    '{{WRAPPER}} .countdown-box .countdown-item' => 'gap: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->start_controls_tabs(
            'countdown_content_style_tabs'
        );

        $this->start_controls_tab(
            'countdown_number_tab',
            [
                'label' => esc_html__('Number', 'topper-pack'),
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'countdown_number_typo',
                'selector' => '{{WRAPPER}} .countdown-box .countdown-item .countdown-number',
            ]
        );
        $this->add_responsive_control(
            'countdown_number_color',
            [
                'label'     => esc_html__('Color', 'topper-pack'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .countdown-box .countdown-item .countdown-number' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'countdown_number_background',
                'types' => ['classic', 'gradient', 'video'],
                'selector' => '{{WRAPPER}} .countdown-box .countdown-item .countdown-number',
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'countdown_number_border',
                'selector' => '{{WRAPPER}} .countdown-box .countdown-item .countdown-number',
            ]
        );
        $this->add_responsive_control(
            'countdown_number_margin',
            [
                'label'      => esc_html__('Margin', 'topper-pack'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .countdown-box .countdown-item .countdown-number' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'countdown_number_padding',
            [
                'label'      => esc_html__('Padding', 'topper-pack'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .countdown-box .countdown-item .countdown-number' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_tab();

        $this->start_controls_tab(
            'countdown_text_tab',
            [
                'label' => esc_html__('Text', 'topper-pack'),
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'countdown_text_typo',
                'selector' => '{{WRAPPER}} .countdown-box .countdown-item .countdown-text,{{WRAPPER}} .countdown-box .countdown-message .countdown-text',
            ]
        );
        $this->add_responsive_control(
            'countdown_text_color',
            [
                'label'     => esc_html__('Color', 'topper-pack'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .countdown-box .countdown-item .countdown-text' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .countdown-box .countdown-message .countdown-text' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'countdown_text_background',
                'types' => ['classic', 'gradient', 'video'],
                'selector' => '{{WRAPPER}} .countdown-box .countdown-item .countdown-text,{{WRAPPER}} .countdown-box .countdown-message .countdown-text',
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'countdown_text_border',
                'selector' => '{{WRAPPER}} .countdown-box .countdown-item .countdown-text,{{WRAPPER}} .countdown-box .countdown-message .countdown-text',
            ]
        );
        $this->add_responsive_control(
            'countdown_text_margin',
            [
                'label'      => esc_html__('Margin', 'topper-pack'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .countdown-box .countdown-item .countdown-text' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .countdown-box .countdown-message .countdown-text' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'countdown_text_padding',
            [
                'label'      => esc_html__('Padding', 'topper-pack'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .countdown-box .countdown-item .countdown-text' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .countdown-box .countdown-message .countdown-text' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();
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
        $allowed_html = [
            'a' => [
                'href'   => [],
                'title'  => [],
                'target' => [],
            ],
            'p'      => [],
            'br'     => [],
            'strong' => [],
            'em'     => [],
        ];

        $style_classes = [
            'style_one'    => 'countdown-v1',
            'style_two'    => 'countdown-v2',
            'style_three'  => 'countdown-v3',
            'style_four'   => 'countdown-v4',
        ];
        // Get the class name based on the selected style or fallback to an empty string.
        $class = isset($style_classes[$settings['topppa_content_styles_choose']]) ? $style_classes[$settings['topppa_content_styles_choose']] : '';
        // Your widget output here
?>
        <div class="countdown-box <?php echo esc_attr($class); ?>">
            <div class="countdown-list" data-offer-date="<?php echo esc_attr(gmdate('Y-m-d\TH:i:s\Z', strtotime($settings['tp_cd_due_date']))); ?>">
                <div class="countdown-item">
                    <span class="countdown-number day"><?php echo esc_html( '00', 'topper-pack' ); ?></span>
                    <span class="countdown-text"><?php echo esc_html( 'Days', 'topper-pack' ); ?></span>
                </div>
                <div class="countdown-item">
                    <span class="countdown-number hour"><?php echo esc_html( '00', 'topper-pack' ); ?></span>
                    <span class="countdown-text"><?php echo esc_html( 'Hours', 'topper-pack' ); ?></span>
                </div>
                <div class="countdown-item">
                    <span class="countdown-number minute"><?php echo esc_html( '00', 'topper-pack' ); ?></span>
                    <span class="countdown-text"><?php echo esc_html( 'Minutes', 'topper-pack' ); ?></span>
                </div>
                <div class="countdown-item">
                    <span class="countdown-number seconds"><?php echo esc_html( '00', 'topper-pack' ); ?></span>
                    <span class="countdown-text"><?php echo esc_html( 'Seconds', 'topper-pack' ); ?></span>
                </div>
                <div class="countdown-message" style="display: none;">
                    <span class="countdown-text"><?php echo esc_html( 'Expired', 'topper-pack' ); ?></span>
                </div>
            </div>
        </div>
<?php
    }
}