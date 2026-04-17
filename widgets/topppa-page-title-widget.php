<?php
use TopperPack\Trait_Loader\Global_Component_Loader;
use \TopperPack\Includes\Controls\Controls_Manager as TopperPack_Controls_Manager;
use \TopperPack\Includes\Utilities;
if (! defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

/**
 * Elementor topppa Page Title Widget.
 *
 * Elementor widget that inserts an embbedable content into the page, from any given URL.
 *
 * @since 1.0.0
 */
class TOPPPA_Page_Title_Widget extends \Elementor\Widget_Base {

    /**
     * Global Component Loader
     *
     * @package TopperPack
     */
    use Global_Component_Loader;

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
        return 'topppa_page_title';
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
        return TOPPPA_EPWB . esc_html__('Page Title', 'topper-pack');
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
        return 'eicon-archive-title';
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
        return ['topppa', 'widget', 'title', 'page', 'topperpack'];
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
        return 'https://doc.topperpack.com/docs/general-widgets/page-title/';
    }


    public function topppa_page_title_text_effect_control() {
        $this->add_control(
            'text_effect',
            [
                'label' => esc_html__('Text Effect', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'none',
                'options' => [
                    'none' => esc_html__('None', 'topper-pack'),
                    'gradient' => esc_html__('Gradient', 'topper-pack'),
                    'pro_glossy' => esc_html__('Glossy (Pro)', 'topper-pack'),
                ],
            ]
        );
        Utilities::upgrade_pro_notice( 
            $this, 
            \Elementor\Controls_Manager::RAW_HTML, 
            'topppa_page_title_widget',
            'text_effect',
            ['pro_glossy']
        );
    }
    /**
     * Register Page Title Widget controls.
     *
     * Add input fields to allow the user to customize the widget settings.
     *
     * @since 1.0.0
     * @access protected
     */
    protected function register_controls() {

        $this->start_controls_section(
            'page_title_options',
            [
                'label' => esc_html__('Page Title', 'topper-pack'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_control(
            'page_link',
            [
                'label' => esc_html__('Link', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'none',
                'options' => [
                    'custom' => esc_html__('Custom', 'topper-pack'),
                    'default' => esc_html__('Default', 'topper-pack'),
                    'none' => esc_html__('None', 'topper-pack'),
                ],
            ]
        );
        $this->add_control(
            'page_custom_link',
            [
                'label' => esc_html__('Link', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::URL,
                'placeholder' => esc_html__('https://your-link.com', 'topper-pack'),
                'options' => ['url', 'is_external', 'nofollow'],
                'label_block' => true,
                'dynamic' => [
                    'active' => true,
                ],
                'default' => [
                    'url' => get_home_url(),
                ],
                'condition' => [
                    'page_link' => 'custom',
                ],
            ]
        );

        $this->topppa_global_title_tag();

        $this->add_responsive_control(
            'page_align',
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
                'default' => 'left',
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .topppa-page-title-wrapper' => 'text-align: {{VALUE}};',
                ],
            ]
        );
        $this->topppa_page_title_text_effect_control();
        $this->add_control(
            'gradient_start_color',
            [
                'label' => esc_html__('Gradient Start Color', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#ff7e5f',
                'condition' => [
                    'text_effect' => ['gradient', 'glossy'],
                ],
            ]
        );

        $this->add_control(
            'gradient_end_color',
            [
                'label' => esc_html__('Gradient End Color', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#feb47b',
                'condition' => [
                    'text_effect' => ['gradient', 'glossy'],
                ],
            ]
        );
        $this->add_control(
            'gradient_position',
            [
                'label' => esc_html__('Position', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => -200,
                        'max' => 200,
                        'step' => 0.5,
                    ],
                ],
                'condition' => [
                    'text_effect' => 'gradient',
                ],
            ]
        );
        $this->add_control(
            'glossy_position',
            [
                'label' => esc_html__('Position', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'bottom',
                'options' => [
                    'bottom' => esc_html__('Default', 'topper-pack'),
                    'left'  => esc_html__('Left', 'topper-pack'),
                    'right' => esc_html__('Right', 'topper-pack'),
                    'top' => esc_html__('Top', 'topper-pack'),
                    'bottom' => esc_html__('Bottom', 'topper-pack'),
                ],
                'condition' => [
                    'text_effect' => 'glossy',
                ],
            ]
        );
        $this->end_controls_section();
        $this->start_controls_section(
            'page_title_css',
            [
                'label' => esc_html__('Title', 'topper-pack'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'content_typography',
                'selector' => '{{WRAPPER}} .topppa-page-title',
            ]
        );
        $this->add_responsive_control(
            'text_color',
            [
                'label' => esc_html__('Text Color', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .topppa-page-title' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Text_Shadow::get_type(),
            [
                'name' => 'text_shadow',
                'selector' => '{{WRAPPER}} .topppa-page-title',
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Text_Stroke::get_type(),
            [
                'name' => 'text_stroke',
                'selector' => '{{WRAPPER}} .topppa-page-title',
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Css_Filter::get_type(),
            [
                'name' => 'custom_css_filters',
                'selector' => '{{WRAPPER}} .topppa-page-title',
            ]
        );

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
        $title = wp_kses_post(get_the_title());

        $heading_tag = !empty($settings['title_tag']) ? esc_attr($settings['title_tag']) : 'h2';

        if ('none' !== $settings['page_link']) {
            $url = ('custom' === $settings['page_link'] && !empty($settings['page_custom_link']['url']))
                ? esc_url($settings['page_custom_link']['url'])
                : get_permalink();
            // translators: %s is the URL
            $title = sprintf('<a href="%s">%s</a>', $url, $title); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
        }

        $effect_class = !empty($settings['text_effect']) ? 'effect-' . esc_attr($settings['text_effect']) : '';
        $effect_style = '';

        if ('gradient' === $settings['text_effect']) {
            $gradient_start = !empty($settings['gradient_start_color']) ? esc_attr($settings['gradient_start_color']) : '#ff7e5f';
            $gradient_end = !empty($settings['gradient_end_color']) ? esc_attr($settings['gradient_end_color']) : '#feb47b';
            $gradient_deg = !empty($settings['gradient_position']['size']) ? esc_attr($settings['gradient_position']['size']) : '90';
            $effect_style = "background: linear-gradient({$gradient_deg}deg, {$gradient_start}, {$gradient_end}); -webkit-background-clip: text; -webkit-text-fill-color: transparent;";
        }
        if ( topppa_can_use_premium_features() && 'glossy' === ($settings['text_effect'] ?? 'none')) {
            $glossy_start = !empty($settings['gradient_start_color']) ? esc_attr($settings['gradient_start_color']) : '#ffffff';
            $glossy_end = !empty($settings['gradient_end_color']) ? esc_attr($settings['gradient_end_color']) : '#bbbbbb';
            $glossy_position = !empty($settings['glossy_position']) ? esc_attr($settings['glossy_position']) : 'bottom';

            $effect_style = "background: linear-gradient(to {$glossy_position}, {$glossy_start} 30%, {$glossy_end} 70%);
                             -webkit-background-clip: text;
                             -webkit-text-fill-color: transparent;";
        }

        echo '<div class="topppa-page-title-wrapper elementor-widget-heading">';
        // translators: %1$s is the heading tag, %2$s is the effect class, %3$s is the effect style, %4$s is the title
        echo sprintf(
            '<%1$s class="topppa-page-title topppa-page-title %2$s" style="%3$s">%4$s</%1$s>',
            esc_attr($heading_tag),
            esc_attr($effect_class),
            esc_attr($effect_style),
            wp_kses_post($title)
        );
        echo '</div>';
    }
}