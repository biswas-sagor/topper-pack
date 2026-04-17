<?php

use \TopperPack\Includes\Controls\Controls_Manager as TopperPack_Controls_Manager;

if (! defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

/**
 * Elementor topppa Audio Widget.
 *
 * Elementor widget that inserts an embbedable content into the page, from any given URL.
 *
 * @since 1.0.0
 */
class TOPPPA_Audio_Player_Widget extends \Elementor\Widget_Base {

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
        return 'topppa_audio_player';
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
        return TOPPPA_EPWB . esc_html__('Audio Player', 'topper-pack');
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
        return 'eicon-headphones';
    }

    /**
     * Get widget categories.
     *
     * Retrieve the list of categories the audio widget belongs to.
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
     * Retrieve the list of keywords the audio widget belongs to.
     *
     * @since 1.0.0
     * @access public
     * @return array Widget keywords.
     */
    public function get_keywords() {
        return ['topppa', 'widget', 'Audion Player', 'topperpack'];
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
        return 'https://doc.topperpack.com/docs/post-widgets/audio-player/';
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
        return 'https://topperpack.com/assets/widgets/audio-player-widget/';
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

        $base_url = $this->get_custom_image_url();

        $this->start_controls_section(
            'topppa_content_style',
            [
                'label' => esc_html__('Audio Styles', 'topper-pack'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_control(
            'topppa_content_select_styles',
            [
                'label' => esc_html__('Choose Style', 'topper-pack'),
                'type' => TopperPack_Controls_Manager::IMAGECHOOSE,
                'default' => 'style_one',
                'options' => [
                    'style_one' => [
                        'title' => esc_html__('Style 1', 'topper-pack'),
                        'imagelarge' => $base_url . 'style-1.png',
                        'imagesmall' => $base_url . 'style-1.png',
                        'width' => '100%',
                    ],
                ],
            ]
        );
        $this->end_controls_section();
        $this->start_controls_section(
            'topppa_audio_options',
            [
                'label' => esc_html__('topppa Audio Player', 'topper-pack'),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_control(
            'audio_file',
            [
                'label' => esc_html__('Audio File', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'media_type' => 'audio',
            ]
        );
        $this->add_control(
            'image',
            [
                'label' => esc_html__('Choose Image', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::MEDIA,
            ]
        );
        $this->end_controls_section();

        // <========================> topppa Audio STYLES <========================>
        $this->start_controls_section(
            'box_styles',
            [
                'label' => esc_html__('Box Style', 'topper-pack'),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_responsive_control(
            'image_height',
            [
                'label' => esc_html__('Image Height', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 800,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .topppa-audio-player .player .imgbx' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name'     => 'box_border',
                'label'    => esc_html__('Border', 'topper-pack'),
                'selector' => '{{WRAPPER}} .topppa-audio-player .player',
            ]
        );
        $this->add_responsive_control(
            'box_radius',
            [
                'label'      => esc_html__('Border Radius', 'topper-pack'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .topppa-audio-player .player' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'box_shadow',
                'label'    => esc_html__('Box Shadow', 'topper-pack'),
                'selector' => '{{WRAPPER}} .topppa-audio-player .player',
            ]
        );
        $this->add_responsive_control(
            'box_margin',
            [
                'label'      => esc_html__('Margin', 'topper-pack'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .topppa-audio-player .player' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'box_padding',
            [
                'label'      => esc_html__('Padding', 'topper-pack'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .topppa-audio-player .player' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_tab();
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
        <div class="topppa-audio-player">
            <?php if ($settings['audio_file']['url']) :
                $audio_url = esc_url($settings['audio_file']['url']);
            ?>
                <div class="player">
                    <div class="imgbx">
                        <?php echo wp_get_attachment_image($settings['image']['id'], 'full'); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
                    </div>
                    <audio controls>
                        <source src="<?php echo esc_url($audio_url); ?>" type="audio/mpeg">
                    </audio>
                </div>
            <?php endif; ?>
        </div>
    <?php
    }
}
