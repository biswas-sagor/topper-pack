<?php
use TopperPack\Trait_Loader\Global_Component_Loader;
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
class TOPPPA_Hotspot_Widget extends \Elementor\Widget_Base {

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
        return 'topppa_hotspot_widget';
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
        return TOPPPA_EPWB . esc_html__('Hotspot', 'topper-pack');
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
        return 'eicon-image-hotspot';
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
        return ['topppa', 'widget', 'hotspot', 'topperpack'];
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
        return 'https://doc.topperpack.com/docs/general-widgets/hotspot/';
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

        // <========================>
        // <========================> topppa COUNTER STYLES <========================>
        $this->start_controls_section(
            'hotspot_content_options',
            [
                'label' => esc_html__('Hotspot Content', 'topper-pack'),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_control(
            'image',
            [
                'label' => esc_html__('Choose Image', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::MEDIA,
            ]
        );
        $this->add_responsive_control(
            'background_position',
            [
                'label'     => esc_html__('Background Position', 'topper-pack'),
                'type'      => \Elementor\Controls_Manager::SELECT,
                'default'   => 'center center',
                'options'   => [
                    'top'      => esc_html__('Top', 'topper-pack'),
                    'top left'      => esc_html__('Top Left', 'topper-pack'),
                    'top center'    => esc_html__('Top Center', 'topper-pack'),
                    'top right'     => esc_html__('Top Right', 'topper-pack'),
                    'center'   => esc_html__('Center', 'topper-pack'),
                    'center left'   => esc_html__('Center Left', 'topper-pack'),
                    'center center' => esc_html__('Center Center', 'topper-pack'),
                    'center right'  => esc_html__('Center Right', 'topper-pack'),
                    'bottom'   => esc_html__('Bottom', 'topper-pack'),
                    'bottom left'   => esc_html__('Bottom Left', 'topper-pack'),
                    'bottom center' => esc_html__('Bottom Center', 'topper-pack'),
                    'bottom right'  => esc_html__('Bottom Right', 'topper-pack'),
                ],
                'selectors' => [
                    '{{WRAPPER}} .topppa-hotspot-map' => 'background-position: {{VALUE}}',
                ],
            ]
        );

        $this->add_responsive_control(
            'background_size',
            [
                'label'     => esc_html__('Background Size', 'topper-pack'),
                'type'      => \Elementor\Controls_Manager::SELECT,
                'default'   => 'cover',
                'options'   => [
                    'cover'      => esc_html__('Cover', 'topper-pack'),
                    'contain'    => esc_html__('Contain', 'topper-pack'),
                    'auto'       => esc_html__('Auto', 'topper-pack'),
                    '100% 100%'  => esc_html__('100% 100%', 'topper-pack'),
                ],
                'selectors' => [
                    '{{WRAPPER}} .topppa-hotspot-map' => 'background-size: {{VALUE}}',
                ],
            ]
        );

        $this->add_responsive_control(
            'background_repeat',
            [
                'label'     => esc_html__('Background Repeat', 'topper-pack'),
                'type'      => \Elementor\Controls_Manager::SELECT,
                'default'   => 'no-repeat',
                'options'   => [
                    'no-repeat' => esc_html__('No Repeat', 'topper-pack'),
                    'repeat'    => esc_html__('Repeat', 'topper-pack'),
                    'repeat-x'  => esc_html__('Repeat X', 'topper-pack'),
                    'repeat-y'  => esc_html__('Repeat Y', 'topper-pack'),
                ],
                'selectors' => [
                    '{{WRAPPER}} .topppa-hotspot-map' => 'background-repeat: {{VALUE}}',
                ],
            ]
        );
        $this->topppa_global_title_tag();
        // Add repeater for multiple hotspots
        $repeater = new \Elementor\Repeater();
        $repeater->add_control(
            'enable_icon',
            [
                'label' => esc_html__('Enable Icon', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'default' => 'no',
            ]
        );
        $repeater->add_control(
            'icon',
            [
                'label' => esc_html__('Icon', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::ICONS,
                'condition' => [
                    'enable_icon' => 'yes',
                ],
            ]
        );
        $repeater->add_control(
            'hotspot_title',
            [
                'label' => esc_html__('Title', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Popup Box', 'topper-pack'),
            ]
        );

        $repeater->add_control(
            'hotspot_content',
            [
                'label' => esc_html__('Content', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => esc_html__('Lorem ipsum dolor sit amet, consectetur adipisicing elit.', 'topper-pack'),
            ]
        );

        $repeater->add_control(
            'hotspot_link',
            [
                'label' => esc_html__('Button Link', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::URL,
                'placeholder' => esc_html__('https://your-link.com', 'topper-pack'),
                'show_external' => true,
                'default' => [
                    'url' => '#',
                    'is_external' => false,
                    'nofollow' => false,
                ],
            ]
        );

        $repeater->add_control(
            'hotspot_position',
            [
                'label' => esc_html__('Hotspot Position', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['%'],
                'allowed_dimensions' => ['top', 'left'],
            ]
        );

        $repeater->add_control(
            'is_active',
            [
                'label' => esc_html__('Active by Default', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'topper-pack'),
                'label_off' => esc_html__('No', 'topper-pack'),
                'return_value' => 'yes',
                'default' => 'no',
                'description' => esc_html__('Enable to show this hotspot as active by default', 'topper-pack'),
            ]
        );

        $this->add_control(
            'hotspots',
            [
                'label' => esc_html__('Hotspots', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'hotspot_title' => esc_html__('Popup Title', 'topper-pack'),
                        'hotspot_content' => esc_html__('Lorem ipsum dolor sit amet, consectetur adipisicing elit.', 'topper-pack'),
                    ],
                ],
                'title_field' => '{{{ hotspot_title }}}',
            ]
        );

        $this->end_controls_section();

        // Style Section - Hotspot Markers
        $this->start_controls_section(
            'section_style_markers',
            [
                'label' => esc_html__('Hotspot Markers', 'topper-pack'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'marder_typography',
                'selector' => '{{WRAPPER}} .topppa-hotspot-box .topppa-hotspot-item .topppa-hotspot-marker .topppa-hotspot-number',
            ]
        );
        $this->add_control(
            'marker_size',
            [
                'label' => esc_html__('Marker Size', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 10,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .topppa-hotspot-box .topppa-hotspot-item .topppa-hotspot-marker' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'box_height_size',
            [
                'label' => esc_html__('Image Height', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'rem'], // Added % and rem
                'range' => [
                    'px' => [
                        'min' => 10,
                        'max' => 1000,
                    ],
                    '%' => [
                        'min' => 10,
                        'max' => 100,
                    ],
                    'rem' => [
                        'min' => 10,
                        'max' => 100,
                        'step' => 1,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .topppa-hotspot-box .topppa-hotspot-map' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'marker_number_background',
                'types' => ['classic', 'gradient', 'video'],
                'selector' => '{{WRAPPER}} .topppa-hotspot-box .topppa-hotspot-item .topppa-hotspot-marker .topppa-hotspot-number',
            ]
        );
        $this->add_control(
            'marker_number_color',
            [
                'label' => esc_html__('Color', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .topppa-hotspot-box .topppa-hotspot-item .topppa-hotspot-marker .topppa-hotspot-number' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'marker_number_border',
                'selector' => '{{WRAPPER}} .topppa-hotspot-box .topppa-hotspot-item .topppa-hotspot-marker .topppa-hotspot-number',
            ]
        );
        $this->add_responsive_control(
            'marker_number_border_radius',
            [
                'label' => esc_html__('Border Radius', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .topppa-hotspot-box .topppa-hotspot-item .topppa-hotspot-marker .topppa-hotspot-number' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .topppa-hotspot-box .topppa-hotspot-item .topppa-hotspot-marker .topppa-hotspot-ripple' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'marker_number_shadow',
                'selector' => '{{WRAPPER}} .topppa-hotspot-box .topppa-hotspot-item .topppa-hotspot-marker .topppa-hotspot-number',
            ]
        );
        $this->add_control(
            'enable_ripple',
            [
                'label' => esc_html__('Enable Ripple', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'topper-pack'),
                'label_off' => esc_html__('No', 'topper-pack'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );
        $this->add_control(
            'ripple_color',
            [
                'label' => esc_html__('Ripple Color', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .topppa-hotspot-box .topppa-hotspot-item .topppa-hotspot-marker .topppa-hotspot-ripple' => 'background-color: {{VALUE}};',
                ],
                'condition' => [
                    'enable_ripple' => 'yes',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'ripple_border',
                'label' => esc_html__('Border', 'topper-pack'),
                'selector' => '{{WRAPPER}} .topppa-hotspot-ripple',
                'condition' => [
                    'enable_ripple' => 'yes',
                ],
            ]

        );
        $this->end_controls_section();

        // Style Section - Content Box
        $this->start_controls_section(
            'section_style_content',
            [
                'label' => esc_html__('Content Box', 'topper-pack'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_responsive_control(
            'content_box_align',
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
                    '{{WRAPPER}} .topppa-hotspot-content-box' => 'text-align: {{VALUE}};',
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
                    '{{WRAPPER}} .topppa-hotspot-box .topppa-hotspot-content-box' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'content_background_color',
            [
                'label' => esc_html__('Background Color', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .topppa-hotspot-content-box' => 'background-color: {{VALUE}};',
                    '{{WRAPPER}} .topppa-hotspot-box .topppa-hotspot-content-box:after' => 'border-top-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'content_padding',
            [
                'label' => esc_html__('Padding', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .topppa-hotspot-content-box' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'content_border_border',
                'selector' => '{{WRAPPER}} .topppa-hotspot-content-box',
            ]
        );
        $this->add_control(
            'content_border_radius',
            [
                'label' => esc_html__('Border Radius', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .topppa-hotspot-content-box' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'content_box_shadow',
                'selector' => '{{WRAPPER}} .topppa-hotspot-content-box',
            ]
        );
        $this->start_controls_tabs('content_box_tabs');

        // Content Box Normal Tab
        $this->start_controls_tab(
            'content_title_normal',
            [
                'label' => esc_html__('Title', 'topper-pack'),
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'selector' => '{{WRAPPER}} .topppa-hotspot-box .topppa-hotspot-item .topppa-hotspot-content-box .topppa-hotspot-title',
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label' => esc_html__('Color', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .topppa-hotspot-box .topppa-hotspot-item .topppa-hotspot-content-box .topppa-hotspot-title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'title_margin',
            [
                'label' => esc_html__('Margin', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .topppa-hotspot-box .topppa-hotspot-item .topppa-hotspot-content-box .topppa-hotspot-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_tab();

        // Content Box Hover Tab
        $this->start_controls_tab(
            'section_style_description',
            [
                'label' => esc_html__('Description', 'topper-pack'),
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'description_typography',
                'selector' => '{{WRAPPER}} .topppa-hotspot-box .topppa-hotspot-item .topppa-hotspot-content-box .topppa-hotspot-description',
            ]
        );

        $this->add_control(
            'description_color',
            [
                'label' => esc_html__('Color', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .topppa-hotspot-box .topppa-hotspot-item .topppa-hotspot-content-box .topppa-hotspot-description' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'description_margin',
            [
                'label' => esc_html__('Margin', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .topppa-hotspot-box .topppa-hotspot-item .topppa-hotspot-content-box .topppa-hotspot-description' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
        // Get the class name based on the selected style or fallback to an empty string.

        // Check if any hotspot is set to active
        $has_active = false;
        if (!empty($settings['hotspots'])) {
            foreach ($settings['hotspots'] as $item) {
                if (isset($item['is_active']) && $item['is_active'] === 'yes') {
                    $has_active = true;
                    break;
                }
            }
        }
?>
        <div class="topppa-hotspot-box">
            <div class="topppa-hotspot-map" style="background-image:url(<?php echo esc_url(wp_get_attachment_image_url($settings['image']['id'], 'full')); ?>)">
                <?php
                if (!empty($settings['hotspots'])) {
                    foreach ($settings['hotspots'] as $index => $item) {
                        $hotspot_id = 'hotspot-' . $this->get_id() . '-' . $index;

                        // Generate inline style
                        $position_style = '';
                        if (
                            isset($item['hotspot_position']['top'], $item['hotspot_position']['left']) &&
                            $item['hotspot_position']['top'] !== '' &&
                            $item['hotspot_position']['left'] !== ''
                        ) {
                            $top = floatval($item['hotspot_position']['top']) . '%';
                            $left = floatval($item['hotspot_position']['left']) . '%';
                            $position_style = 'top: ' . $top . '; left: ' . $left . ';';
                        }

                        // Determine if this hotspot should be active
                        $active_class = '';
                        if (isset($item['is_active']) && $item['is_active'] === 'yes') {
                            $active_class = 'active';
                        }
                ?>
                        <div class="topppa-hotspot-item map-item<?php echo esc_attr($index + 1); ?>" <?php if ($position_style) echo 'style="' . esc_attr($position_style) . '"'; ?>>
                            <div class="topppa-hotspot-marker marker<?php echo esc_attr($index + 1); ?>">
                                <?php if ($settings['enable_ripple'] === 'yes') : ?>
                                    <span class="topppa-hotspot-ripple"></span>
                                <?php endif; ?>
                                <span class="topppa-hotspot-number">
                                    <?php if ($item['enable_icon'] === 'yes') : ?>
                                        <?php \Elementor\Icons_Manager::render_icon($item['icon'], ['aria-hidden' => 'true']); ?>
                                    <?php else : ?>
                                        <?php echo esc_html($index + 1); ?>
                                    <?php endif; ?>
                                </span>
                            </div>
                            <div id="<?php echo esc_attr($hotspot_id); ?>" class="topppa-hotspot-content-box <?php echo esc_attr($active_class); ?>">
                                <?php if (!empty($item['hotspot_title'])) : ?>
                                    <<?php echo esc_attr($settings['title_tag'] ?? 'h2'); ?> class="topppa-hotspot-title"><?php echo esc_html($item['hotspot_title']); ?></<?php echo esc_attr($settings['title_tag'] ?? 'h2'); ?>>
                                <?php endif; ?>
                                <?php if (!empty($item['hotspot_content'])) : ?>
                                    <div class="topppa-hotspot-description"><?php echo esc_html($item['hotspot_content']); ?></div>
                                <?php endif; ?>
                            </div>
                        </div>
                <?php
                    }
                }
                ?>
            </div>
        </div>


<?php
    }
}