<?php

use Elementor\Group_Control_Image_Size;
use Elementor\Controls_Manager;
use Elementor\Widget_Base;
use Elementor\Utils;
use TopperPack\Includes\Controls\Controls_Manager as TopperPack_Controls_Manager;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

/**
 * Elementor topppa Image Widget.
 *
 * Elementor widget that inserts an embeddable content into the page, from any given URL.
 *
 * @since 1.0.0
 */
class TOPPPA_Image_Tab_Widget extends Widget_Base {

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
        return 'topppa_image_tab_widget';
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
        return TOPPPA_EPWB . esc_html__('Image Tab', 'topper-pack');
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
        return 'eicon-image';
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
        return ['topppa', 'widget', 'image Tab', 'media', 'topperpack'];
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
        return 'https://doc.topperpack.com/docs/general-widgets/image/';
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
        return 'https://topperpack.com/assets/widgets/image-widget/';
    }

    /**
     * Register Image Widget controls.
     *
     * Add input fields to allow the user to customize the widget settings.
     *
     * @since 1.0.0
     * @access protected
     */
    protected function register_controls() {

        $this->start_controls_section(
            'topppa_images',
            [
                'label' => esc_html__('Image Tab', 'topper-pack'),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );
        $repeater = new \Elementor\Repeater();
        $repeater->add_control(
            'tpp_image',
            [
                'label' => esc_html__('Choose Image', 'topper-pack'),
                'type' => Controls_Manager::MEDIA,
            ]
        );
        $repeater->add_control(
            'tpp_image_width',
            [
                'label' => esc_html__('Image Width', 'topper-pack'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'em'],
                'range' => [
                    'px' => ['min' => 1, 'max' => 2000],
                    '%' => ['min' => 1, 'max' => 100],
                    'em' => ['min' => 0.1, 'max' => 50],
                ],
                'default' => [
                    'unit' => 'px',
                ],
            ]
        );
        $repeater->add_control(
            'tpp_image_height',
            [
                'label' => esc_html__('Image Height', 'topper-pack'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'em'],
                'range' => [
                    'px' => ['min' => 1, 'max' => 2000],
                    '%' => ['min' => 1, 'max' => 100],
                    'em' => ['min' => 0.1, 'max' => 50],
                ],
                'default' => [
                    'unit' => 'px',
                ],
            ]
        );
        $repeater->add_control(
            'tp_content',
            [
                'label' => esc_html__('content', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::WYSIWYG,
                'default' => esc_html__('Your Trusted Travel Companion – Exploring the World, One Destination at a Time with  and Personalized Adventures.', 'topper-pack'),
                'placeholder' => esc_html__('Type your content here', 'topper-pack'),
            ]
        );
        $this->add_control(
            'tpp_image_tab',
            [
                'label'   => esc_html__('Item', 'topper-pack'),
                'type'    => \Elementor\Controls_Manager::REPEATER,
                'fields'  => $repeater->get_controls(),
                'default' => [
                    [
                        'tpp_image' => '',
                    ],
                ],
                'title_field' => '{{{ tpp_image.url ? "Image" : "No Image" }}}',
            ]
        );

        $this->add_control(
            'tpp_default_active_tab',
            [
                'label' => esc_html__('Default Active Tab', 'topper-pack'),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'default' => 0,
                'description' => esc_html__('Set which image tab is active by default (0 = first tab).', 'topper-pack'),
                'condition' => [
                    'tpp_image_tab!' => ''
                ],
            ]
        );

        $this->end_controls_section();

        // Style Controls for Image (Avatar)
        $this->start_controls_section(
            'tpp_image_style_section',
            [
                'label' => esc_html__('Image', 'topper-pack'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'tpp_avatar_border',
                'selector' => '{{WRAPPER}} .tpp-image-tab-wrapper .tpp-image-tab-avatar.active img',
            ]
        );
        $this->add_control(
            'tpp_avatar_border_radius',
            [
                'label' => esc_html__('Border Radius', 'topper-pack'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range' => [
                    'px' => ['min' => 0, 'max' => 100],
                    '%' => ['min' => 0, 'max' => 50],
                ],
                'selectors' => [
                    '{{WRAPPER}} .tpp-image-tab-wrapper .tpp-image-tab-avatar img' => 'border-radius: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'tpp_avatar_box_shadow',
                'selector' => '{{WRAPPER}} .tpp-image-tab-wrapper .tpp-image-tab-avatar img',
            ]
        );
        $this->add_responsive_control(
            'tpp_avatar_box_padding',
            [
                'label' => esc_html__('Padding', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} .tpp-image-tab-wrapper .tpp-image-tab-avatar.active img' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();

        // Style Controls for Description (Content)
        $this->start_controls_section(
            'tpp_content_style_section',
            [
                'label' => esc_html__('Description', 'topper-pack'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'tpp_content_color',
            [
                'label' => esc_html__('Text Color', 'topper-pack'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tpp-image-tab-content' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'tpp_content_typography',
                'selector' => '{{WRAPPER}} .tpp-image-tab-content',
            ]
        );
        $this->add_responsive_control(
            'tpp_content_margin',
            [
                'label' => esc_html__('Margin', 'topper-pack'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .tpp-image-tab-content' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'tpp_content_padding',
            [
                'label' => esc_html__('Padding', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} .tpp-image-tab-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
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
        $allowed_html = wp_kses_allowed_html('post');
        unset($allowed_html['script'], $allowed_html['iframe'], $allowed_html['div'], $allowed_html['p']);
        $widget_id = 'tpp-image-tab-' . $this->get_id();
        $count = !empty($settings['tpp_image_tab']) ? count($settings['tpp_image_tab']) : 0;
        $default_active = isset($settings['tpp_default_active_tab']) ? intval($settings['tpp_default_active_tab']) : 0;
?>
        <div class="tpp-image-tab-wrapper" id="<?php echo esc_attr($widget_id); ?>">
            <?php if (!empty($settings['tpp_image_tab'])) : ?>
                <div class="tpp-image-tab-arc">
                    <?php foreach ($settings['tpp_image_tab'] as $index => $item) : ?>
                        <?php 
                            $image_url = !empty($item['tpp_image']['url']) ? $item['tpp_image']['url'] : ''; 
                            $img_style = '';
                            if (!empty($item['tpp_image_width']['size'])) {
                                $unit = !empty($item['tpp_image_width']['unit']) ? $item['tpp_image_width']['unit'] : 'px';
                                $img_style .= 'width:' . esc_attr($item['tpp_image_width']['size']) . $unit . ';';
                            }
                            if (!empty($item['tpp_image_height']['size'])) {
                                $unit = !empty($item['tpp_image_height']['unit']) ? $item['tpp_image_height']['unit'] : 'px';
                                $img_style .= 'height:' . esc_attr($item['tpp_image_height']['size']) . $unit . ';object-fit:cover;';
                            }
                        ?>
                        <div class="tpp-image-tab-arc-item tpp-image-tab-arc-item-<?php echo esc_attr($index); ?><?php echo $index === $default_active ? ' active' : ''; ?>" data-index="<?php echo esc_attr($index); ?>">
                            <div <?php echo $img_style ? ' style="' . esc_attr($img_style) . '"' : ''; ?> class="tpp-image-tab-avatar<?php echo $index === $default_active ? ' active' : ''; ?>">
                                <img src="<?php echo esc_url($image_url); ?>" alt="Tab Image <?php echo esc_attr($index + 1); ?>">
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
                <div class="tpp-image-tab-contents">
                    <?php foreach ($settings['tpp_image_tab'] as $index => $item) : ?>
                        <div class="tpp-image-tab-content<?php echo $index === $default_active ? ' active' : ''; ?>" data-index="<?php echo esc_attr($index); ?>">
                            <?php if (!empty($item['tp_content'])) : ?>
                                <?php echo wp_kses($item['tp_content'], $allowed_html); ?>
                            <?php endif; ?>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php else : ?>
                <p><?php esc_html_e('No items added. Please add items in the widget settings.', 'topper-pack'); ?></p>
            <?php endif; ?>
        </div>
<?php
    }
}