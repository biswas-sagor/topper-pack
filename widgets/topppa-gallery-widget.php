<?php
use \TopperPack\Trait_Loader\Global_Component_Loader;
use \TopperPack\Includes\Controls\Controls_Manager as TopperPack_Controls_Manager;
use \TopperPack\Includes\Utilities;

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
class TOPPPA_Gallery_Widget extends \Elementor\Widget_Base {

    /**
     * Global Component Loader
     *
     * @package TopperPack
     * @since 1.0.0
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
        return 'topppa_gallery_widget';
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
        return TOPPPA_EPWB . esc_html__('Grid Gallery', 'topper-pack');
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
        return 'eicon-gallery-justified';
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
        return ['topppa', 'widget', 'Grid', 'Gallery', 'topperpack'];
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
        return 'https://doc.topperpack.com/docs/general-widgets/grid-gallery/';
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
        return 'https://topperpack.com/assets/widgets/gallery-widget/';
    }


    public function topppa_gallery_source() {
        $this->add_control(
            'gallery_source',
            [
                'label' => esc_html__('Gallery Source', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'manual',
                'options' => [
                    'manual' => esc_html__('Manual', 'topper-pack'),
                    'pro_dyn' => esc_html__('Dynamic (Pro)', 'topper-pack'),
                ],
            ]
        );
        Utilities::upgrade_pro_notice(
            $this,
            \Elementor\Controls_Manager::RAW_HTML,
            'topppa_gallery_widget',
            'gallery_source',
            ['pro_dyn']
        );
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

        $this->start_controls_section(
            'topppa_gallery_style_option',
            [
                'label' => esc_html__('Gallery Styles', 'topper-pack'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_control(
            'custom_note_alert',
            [
                'type' => \Elementor\Controls_Manager::ALERT,
                'alert_type' => 'warning',
                'heading' => esc_html__('Set images to size to maintain gallery compatibility.', 'topper-pack'),
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
                        'imagelarge' => $base_url . 'topppa-gallery.jpg',
                        'imagesmall' => $base_url . 'topppa-gallery.jpg',
                        'width'      => '100%',
                    ],
                    'style_three'      => [
                        'title'      => esc_html__('Style 3', 'topper-pack'),
                        'imagelarge' => $base_url . 'topppa-gallery-3.jpg',
                        'imagesmall' => $base_url . 'topppa-gallery-3.jpg',
                        'width'      => '100%',
                    ],
                    'style_four'      => [
                        'title'      => esc_html__('Style 4', 'topper-pack'),
                        'imagelarge' => $base_url . 'topppa-gallery-4.jpg',
                        'imagesmall' => $base_url . 'topppa-gallery-4.jpg',
                        'width'      => '100%',
                    ],
                    'style_five'      => [
                        'title'      => esc_html__('Style 5', 'topper-pack'),
                        'imagelarge' => $base_url . 'topppa-gallery-5.jpg',
                        'imagesmall' => $base_url . 'topppa-gallery-5.jpg',
                        'width'      => '100%',
                    ],
                    'style_six'      => [
                        'title'      => esc_html__('Style 6', 'topper-pack'),
                        'imagelarge' => $base_url . 'topppa-gallery-6.jpg',
                        'imagesmall' => $base_url . 'topppa-gallery-6.jpg',
                        'width'      => '100%',
                    ],
                ],
            ]
        );
        $this->end_controls_section();

        $this->start_controls_section(
            'gallery_content_options',
            [
                'label' => esc_html__('Gallery Content', 'topper-pack'),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->topppa_gallery_source();

        $this->add_responsive_control(
            'columns',
            [
                'label' => esc_html__('Columns', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => '4',
                'tablet_default' => '3',
                'mobile_default' => '2',
                'options' => [
                    '1' => '1',
                    '2' => '2',
                    '3' => '3',
                    '4' => '4',
                    '5' => '5',
                    '6' => '6',
                ],
                'selectors' => [
                    '{{WRAPPER}} .gallery-box' => 'grid-template-columns: repeat({{VALUE}}, 1fr);',
                ],
                'condition' => [
                    'topppa_content_styles_choose' => 'style_one',
                ],
            ]
        );
        $this->add_responsive_control(
            'row_height',
            [
                'label' => esc_html__('Row Height', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', 'vh', '%'],
                'range' => [
                    'px' => [
                        'min' => 100,
                        'max' => 500,
                        'step' => 10,
                    ],
                    'vh' => [
                        'min' => 10,
                        'max' => 100,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 10,
                        'max' => 100,
                        'step' => 1,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                ],
                'selectors' => [
                    '{{WRAPPER}} .gallery-item' => 'height: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'topppa_content_styles_choose' => 'style_one',
                ],
            ]
        );
        $this->add_control(
            'gallery_grid_rows',
            [
                'label' => esc_html__('Grid Rows', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'description' => esc_html__('Enter grid row heights separated by spaces, e.g., "repeat(3, 200px 200px 200px)".', 'topper-pack'),
                'placeholder' => 'repeat(3, 200px 200px 200px)',
                'selectors' => [
                    '{{WRAPPER}} .gallery-box' => 'grid-template-rows: {{VALUE}}',
                ],
                'condition' => [
                    'topppa_content_styles_choose!' => 'style_one',
                ],
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'image',
            [
                'label' => esc_html__('Choose Image', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::MEDIA,
            ]
        );

        $this->add_control(
            'gallery_item',
            [
                'label'       => esc_html__('Content', 'topper-pack'),
                'type'        => \Elementor\Controls_Manager::REPEATER,
                'fields'      => $repeater->get_controls(),
                'default'     => [
                    [
                        'image' => ['url' => ''],
                    ],
                ],
                'title_field' => '{{{ image.url ? "Image" : "No Image" }}}',
                'condition' => [
                    'gallery_source' => 'manual',
                ],
            ]
        );
        $this->end_controls_section();
        $this->start_controls_section(
            'image_option_content',
            [
                'label' => esc_html__('Gallery Option', 'topper-pack'),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_control(
            'image_size',
            [
                'label' => esc_html__('Image Size', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'large',
                'options' => [
                    'full' => esc_html__('Full', 'topper-pack'),
                    'large' => esc_html__('Large', 'topper-pack'),
                    'medium' => esc_html__('Medium', 'topper-pack'),
                    'thumbnail' => esc_html__('Thumbnail', 'topper-pack'),
                ],
            ]
        );
        $this->topppa_global_image_animation();

        $this->add_responsive_control(
            'anim_bg_color',
            [
                'label' => esc_html__('Animation Color', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .image-anim' => 'background-color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'enable_icon',
            [
                'label'        => esc_html__('Enable Icon', 'topper-pack'),
                'type'         => \Elementor\Controls_Manager::SWITCHER,
                'label_on'     => esc_html__('Show', 'topper-pack'),
                'label_off'    => esc_html__('Hide', 'topper-pack'),
                'return_value' => 'yes',
                'default'      => 'yes',
            ]
        );
        $this->add_control(
            'image_icon',
            [
                'label' => esc_html__('Icon', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::ICONS,
                'default' => [
                    'value' => 'far fa-eye',
                    'library' => 'solid',
                ],
                'condition' => [
                    'enable_icon' => 'yes',
                ],
            ]
        );
        $this->end_controls_section();
        $this->start_controls_section(
            'image_styles',
            [
                'label' => esc_html__('Image Style', 'topper-pack'),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_responsive_control(
            'image_box_gap',
            [
                'label' => esc_html__('Gap', 'topper-pack'),
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
                    '{{WRAPPER}} .gallery-box' => 'gap: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'img_height',
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
                    '{{WRAPPER}} .gallery-box img' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'background_css_blur',
            [
                'label'      => esc_html__('Background Blur', 'topper-pack'),
                'type'       => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .gallery-box .gallery-item .image-anim' => 'backdrop-filter: blur({{SIZE}}{{UNIT}});',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'image_box_border',
                'label' => esc_html__('Border', 'topper-pack'),
                'selector' => '{{WRAPPER}} .gallery-item',
            ]
        );
        $this->add_responsive_control(
            'image_box_radius',
            [
                'label' => esc_html__('Border Radius', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .gallery-item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'image_box_shadow',
                'label' => esc_html__('Box Shadow', 'topper-pack'),
                'selector' => '{{WRAPPER}} .gallery-item',
            ]
        );
        $this->add_responsive_control(
            'image_box_margin',
            [
                'label' => esc_html__('Margin', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .gallery-item' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'image_box_padding',
            [
                'label' => esc_html__('Padding', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .gallery-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();
        $this->start_controls_section(
            'icon_styles',
            [
                'label' => esc_html__('Icon Style', 'topper-pack'),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
                'condition' => [
                    'enable_icon' => 'yes',
                ],
            ]
        );

        $this->add_responsive_control(
            'icon_height',
            [
                'label' => esc_html__('Height', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 300,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .gallery-item .gallery-icon-btn' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'icon_width',
            [
                'label' => esc_html__('Width', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 300,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .gallery-item .gallery-icon-btn' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'icon_typo',
                'selector' => '{{WRAPPER}} .gallery-item .gallery-icon-btn',
            ]
        );
        $this->add_responsive_control(
            'icon_color',
            [
                'label'     => esc_html__('Color', 'topper-pack'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .gallery-item .gallery-icon-btn' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .gallery-item .gallery-icon-btn svg path' => 'fill: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'icon_bg_color',
                'types' => ['classic', 'gradient', 'video'],
                'selector' => '{{WRAPPER}} .gallery-item .gallery-icon-btn',
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'icon_border',
                'selector' => '{{WRAPPER}} .gallery-item .gallery-icon-btn',
            ]
        );
        $this->add_responsive_control(
            'icon_border_radius',
            [
                'label' => esc_html__('Border Radius', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .gallery-item .gallery-icon-btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'icon_box_shadow',
                'selector' => '{{WRAPPER}} .gallery-item .gallery-icon-btn',
            ]
        );
        $this->add_responsive_control(
            'icon_margin',
            [
                'label'      => esc_html__('Margin', 'topper-pack'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .gallery-item .gallery-icon-btn' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'icon_padding',
            [
                'label'      => esc_html__('Padding', 'topper-pack'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .gallery-item .gallery-icon-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
    protected function topppa_get_available_post_types() {
        $post_types = get_post_types(['public' => true], 'objects');
        $exclude = ['elementor_library', 'e-floating-buttons', 'topppa-theme-builder', 'attachment']; // phpcs:ignore WordPressVIPMinimum.Performance.WPQueryParams.PostNotIn_exclude
        $options = [];
        foreach ($post_types as $post_type) {
            if (!in_array($post_type->name, $exclude)) {
                $options[$post_type->name] = $post_type->label;
            }
        }
        return $options;
    }
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
            'style_one'    => 'gallery-v1',
            'style_three'    => 'gallery-v3',
            'style_four'    => 'gallery-v4',
            'style_five'    => 'gallery-v5',
            'style_six'    => 'gallery-v6',
        ];
        $animations = [
            'anim_one' => 'image-anim1',
            'anim_rotate' => 'image-anim1 v2',
            'anim_two' => 'image-anim2',
            'anim_three' => 'image-anim3'
        ];
        // Get the class name based on the selected style or fallback to an empty string.
        $class = isset($style_classes[$settings['topppa_content_styles_choose']]) ? $style_classes[$settings['topppa_content_styles_choose']] : '';
        // Your widget output here
?>
        <div class="gallery-box <?php echo esc_attr($class); ?>" data-elementor-lightbox="no">
            <?php
            if ('dynamic' === ($settings['gallery_source'] ?? 'manual')) {
                // Dynamic gallery from post type
                $args = array(
                    'post_type' => $settings['post_type'] ?? 'post',
                    'posts_per_page' => $settings['posts_per_page'] ?? 6,
                    'post_status' => 'publish'
                );

                $query = new WP_Query($args);

                if ($query->have_posts()) :
                    while ($query->have_posts()) : $query->the_post();
                        $featured_image = get_post_thumbnail_id();
                        if ($featured_image) :
            ?>
                            <div class="gallery-item">
                                <?php if (!empty($animations[$settings['post_img_anim']])) : ?>
                                    <span class="image-anim <?php echo esc_attr($animations[$settings['post_img_anim']]); ?>"></span>
                                <?php endif; ?>
                                <?php
                                $image_size = isset($settings['image_size']) ? $settings['image_size'] : 'full';
                                echo wp_get_attachment_image($featured_image, $image_size);
                                ?>
                                <?php if ($settings['enable_icon'] === 'yes') : ?>
                                    <a class="popup-image gallery-icon-btn" href="<?php echo esc_url(get_the_post_thumbnail_url(get_the_ID(), 'full')); ?>">
                                        <?php \Elementor\Icons_Manager::render_icon($settings['image_icon'], ['aria-hidden' => 'true']); ?>
                                    </a>
                                <?php endif; ?>
                            </div>
                        <?php
                        endif;
                    endwhile;
                    wp_reset_postdata();
                else :
                    echo '<p>' . esc_html__('No posts found.', 'topper-pack') . '</p>';
                endif;
            } else {
                // Manual gallery
                if (!empty($settings['gallery_item']) && is_array($settings['gallery_item'])) :
                    foreach ($settings['gallery_item'] as $item) :
                        if (!empty($item['image']['id'])) :
                        ?>
                        <div class="gallery-item">
                            <?php if (!empty($animations[$settings['post_img_anim']])) : ?>
                                <span class="image-anim <?php echo esc_attr($animations[$settings['post_img_anim']]); ?>"></span>
                            <?php endif; ?>
                            <?php
                            $image_size = isset($settings['image_size']) ? $settings['image_size'] : 'full';
                            echo wp_get_attachment_image($item['image']['id'], $image_size);
                            ?>
                            <?php if ($settings['enable_icon'] === 'yes') : ?>
                                <a class="popup-image gallery-icon-btn" href="<?php echo esc_url($item['image']['url']); ?>" data-elementor-open-lightbox="no">
                                    <?php \Elementor\Icons_Manager::render_icon($settings['image_icon'], ['aria-hidden' => 'true']); ?>
                                </a>
                            <?php endif; ?>
                        </div>
                        <?php
                        endif;
                    endforeach;
                else :
                    echo '<p>' . esc_html__('No gallery items found. Please add some gallery items.', 'topper-pack') . '</p>';
                endif;
            }
            ?>
        </div>

        <?php if ($settings['enable_icon'] === 'yes') : ?>
            <script>
                jQuery(document).ready(function($) {
                    $('.gallery-box .popup-image').magnificPopup({
                        type: 'image',
                        gallery: {
                            enabled: true
                        },
                        mainClass: 'mfp-fade',
                        removalDelay: 160,
                        preloader: true,
                        image: {
                            verticalFit: true
                        }
                    });
                });
            </script>
        <?php endif; ?>
<?php
    }
}