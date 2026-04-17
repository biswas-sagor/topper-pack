<?php

use \TopperPack\Includes\Controls\Controls_Manager as TopperPack_Controls_Manager;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

/**
 * Elementor topppa Team Widget.
 *
 * Elementor widget that inserts an embbedable content into the page, from any given URL.
 *
 * @since 1.0.0
 */
class TOPPPA_Team_Widget extends \Elementor\Widget_Base {

    /**
     * Get widget name.
     *
     * Retrieve Team widget widget name.
     *
     * @since 1.0.0
     * @access public
     * @return string Widget name.
     */
    public function get_name() {
        return 'topppa_team';
    }

    /**
     * Get widget title.
     *
     * Retrieve Team widget title.
     *
     * @since 1.0.0
     * @access public
     * @return string Widget title.
     */
    public function get_title() {
        return TOPPPA_EPWB . esc_html__('Team', 'topper-pack');
    }

    /**
     * Get widget icon.
     *
     * Retrieve Team widget icon.
     *
     * @since 1.0.0
     * @access public
     * @return string Widget icon.
     */
    public function get_icon() {
        return 'eicon-user-circle-o';
    }

    /**
     * Get widget categories.
     *
     * Retrieve the list of categories the Team widget belongs to.
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
     * Retrieve the list of keywords the Team widget belongs to.
     *
     * @since 1.0.0
     * @access public
     * @return array Widget keywords.
     */
    public function get_keywords() {
        return ['topppa', 'widget', 'team', 'topperpack'];
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
        return 'https://doc.topperpack.com/docs/team-widgets/team/';
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
        return 'https://topperpack.com/assets/widgets/team-widget/';
    }

    /**
     * Get CPT Builder created post types
     *
     * @return array Post types created by CPT Builder
     */
    private function get_cpt_builder_post_types() {
        $saved_cpts = get_option('topppa_custom_post_types', array());
        $post_types = array();
        $post_types['custom'] = esc_html__('Custom', 'topper-pack');
        if (empty($saved_cpts)) {
            return $post_types;
        }
        foreach ($saved_cpts as $cpt_key => $cpt) {
            if (isset($cpt['slug']) && isset($cpt['label'])) {
                $post_types[$cpt['slug']] = $cpt['label'];
            }
        }
        return $post_types;
    }

    /**
     * Get all CPT meta fields for initial load
     *
     * @return array
     */
    private function get_all_cpt_meta_fields() {
        $saved_cpts = get_option('topppa_custom_post_types', array());
        $all_fields = array();
        $all_fields[''] = esc_html__('Select a meta field', 'topper-pack');
        foreach ($saved_cpts as $cpt_key => $cpt) {
            if (isset($cpt['meta']) && is_array($cpt['meta'])) {
                foreach ($cpt['meta'] as $meta_key => $meta) {
                    if (isset($meta['field_name']) && isset($meta['field_type'])) {
                        if ($meta['field_type'] !== 'icon') {
                            $field_label = !empty($meta['field_label']) ? $meta['field_label'] : $meta['field_name'];
                            $all_fields[$meta_key] = $field_label . ' (Individual)';
                        }
                    } elseif (isset($meta['fields']) && is_array($meta['fields'])) {
                        foreach ($meta['fields'] as $field_index => $field) {
                            if (isset($field['field_name']) && isset($field['field_type'])) {
                                if ($field['field_type'] !== 'icon') {
                                    $field_key = $meta_key . '_field_' . $field['field_name'];
                                    $field_label = !empty($field['field_label']) ? $field['field_label'] : $field['field_name'];
                                    $group_label = isset($meta['label']) ? $meta['label'] : 'Group';
                                    $all_fields[$field_key] = $field_label . ' (' . $group_label . ')';
                                }
                            }
                        }
                    }
                }
            }
        }
        return $all_fields;
    }
    /**
     * Get CPT meta fields that are icon type for social media
     *
     * @return array
     */
    private function get_cpt_social_icon_fields() {
        $saved_cpts = get_option('topppa_custom_post_types', array());
        $social_fields = array();
        $social_fields[''] = esc_html__('Select an icon meta field', 'topper-pack');
        foreach ($saved_cpts as $cpt_key => $cpt) {
            if (isset($cpt['meta']) && is_array($cpt['meta'])) {
                foreach ($cpt['meta'] as $meta_key => $meta) {
                    if (isset($meta['fields']) && is_array($meta['fields'])) {
                        foreach ($meta['fields'] as $field_index => $field) {
                            if (isset($field['field_type']) && $field['field_type'] === 'icon') {
                                $field_key = $meta_key;
                                $field_label = !empty($meta['label']) ? $meta['label'] : 'Social Group';
                                $social_fields[$field_key] = $field_label . ' (Icon Group)';
                                break;
                            }
                        }
                    }
                    // Check if this is an individual icon field
                    elseif (isset($meta['field_type']) && $meta['field_type'] === 'icon') {
                        $field_label = !empty($meta['field_label']) ? $meta['field_label'] : $meta['field_name'];
                        $social_fields[$meta_key] = $field_label . ' (Individual Icon)';
                    }
                }
            }
        }

        return $social_fields;
    }
    /**
     * Register Team Widget 1 widget controls.
     *
     * Add input fields to allow the user to customize the widget settings.
     *
     * @since 1.0.0
     * @access protected
     */
    protected function register_controls() {
        $base_url = $this->get_custom_image_url();
        // <========================> topppa Team OPTIONS <========================>
        $this->start_controls_section(
            'topppa_content_style',
            [
                'label' => esc_html__('Team Styles', 'topper-pack'),
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
                        'imagelarge' => $base_url . 'style-1.jpg',
                        'imagesmall' => $base_url . 'style-1.jpg',
                        'width' => '100%',
                    ],
                    'style_two' => [
                        'title' => esc_html__('Style 2', 'topper-pack'),
                        'imagelarge' => $base_url . 'style-2.jpg',
                        'imagesmall' => $base_url . 'style-2.jpg',
                        'width' => '100%',
                    ],
                    'style_three' => [
                        'title' => esc_html__('Style 3', 'topper-pack'),
                        'imagelarge' => $base_url . 'style-3.jpg',
                        'imagesmall' => $base_url . 'style-3.jpg',
                        'width' => '100%',
                    ],
                    'style_four' => [
                        'title' => esc_html__('Style 4', 'topper-pack'),
                        'imagelarge' => $base_url . 'style-4.jpg',
                        'imagesmall' => $base_url . 'style-4.jpg',
                        'width' => '100%',
                    ],
                    'style_five' => [
                        'title' => esc_html__('Style 5', 'topper-pack'),
                        'imagelarge' => $base_url . 'style-5.jpg',
                        'imagesmall' => $base_url . 'style-5.jpg',
                        'width' => '100%',
                    ],
                    'style_six' => [
                        'title' => esc_html__('Style 6', 'topper-pack'),
                        'imagelarge' => $base_url . 'style-6.jpg',
                        'imagesmall' => $base_url . 'style-6.jpg',
                        'width' => '100%',
                    ],
                    'style_seven' => [
                        'title' => esc_html__('Style 7', 'topper-pack'),
                        'imagelarge' => $base_url . 'style-7.jpg',
                        'imagesmall' => $base_url . 'style-7.jpg',
                        'width' => '100%',
                    ],
                    'style_eight' => [
                        'title' => esc_html__('Style 8', 'topper-pack'),
                        'imagelarge' => $base_url . 'style-8.jpg',
                        'imagesmall' => $base_url . 'style-8.jpg',
                        'width' => '100%',
                    ],
                    'style_nine' => [
                        'title' => esc_html__('Style 9', 'topper-pack'),
                        'imagelarge' => $base_url . 'style-9.jpg',
                        'imagesmall' => $base_url . 'style-9.jpg',
                        'width' => '100%',
                    ],
                    'style_ten' => [
                        'title' => esc_html__('Style 10', 'topper-pack'),
                        'imagelarge' => $base_url . 'style-10.jpg',
                        'imagesmall' => $base_url . 'style-10.jpg',
                        'width' => '100%',
                    ],
                    'style_eleven' => [
                        'title' => esc_html__('Style 11', 'topper-pack'),
                        'imagelarge' => $base_url . 'style-11.jpg',
                        'imagesmall' => $base_url . 'style-11.jpg',
                        'width' => '100%',
                    ],
                    'style_twelve' => [
                        'title' => esc_html__('Style 12', 'topper-pack'),
                        'imagelarge' => $base_url . 'style-12.jpg',
                        'imagesmall' => $base_url . 'style-12.jpg',
                        'width' => '100%',
                    ],
                    'style_thirteen' => [
                        'title' => esc_html__('Style 13', 'topper-pack'),
                        'imagelarge' => $base_url . 'style-13.jpg',
                        'imagesmall' => $base_url . 'style-13.jpg',
                        'width' => '100%',
                    ],
                    'style_fourteen' => [
                        'title' => esc_html__('Style 14', 'topper-pack'),
                        'imagelarge' => $base_url . 'style-14.jpg',
                        'imagesmall' => $base_url . 'style-14.jpg',
                        'width' => '100%',
                    ],
                    'style_fifteen' => [
                        'title' => esc_html__('Style 15', 'topper-pack'),
                        'imagelarge' => $base_url . 'style-15.jpg',
                        'imagesmall' => $base_url . 'style-15.jpg',
                        'width' => '100%',
                    ],
                    'style_sixteen' => [
                        'title' => esc_html__('Style 16', 'topper-pack'),
                        'imagelarge' => $base_url . 'style-16.jpg',
                        'imagesmall' => $base_url . 'style-16.jpg',
                        'width' => '100%',
                    ],
                ],
            ]
        );
        $this->end_controls_section();
        $this->start_controls_section(
            'query_options',
            [
                'label' => esc_html__('Team Content Option', 'topper-pack'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );
        $cpt_post_types = $this->get_cpt_builder_post_types();
        $default_post_type = 'custom';
        $this->add_control(
            'post_type',
            [
                'label' => esc_html__('Post Type', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => $default_post_type,
                'options' => $cpt_post_types,
                'description' => esc_html__('Select a post type created by CPT Builder or choose Custom.', 'topper-pack'),
            ]
        );
        $this->add_control(
            'posts_per_page',
            [
                'label' => esc_html__('Display Items', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'min' => -1,
                'max' => 100,
                'step' => 1,
                'default' => -1,
                'condition' => [
                    'post_type!' => 'custom',
                ],
            ]
        );
        $this->add_control(
            'show_designation',
            [
                'label' => esc_html__('Enable Single Meta Field', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', 'topper-pack'),
                'label_off' => esc_html__('Hide', 'topper-pack'),
                'return_value' => 'yes',
                'default' => 'yes',
                'condition' => [
                    'post_type!' => 'custom',
                ],
            ]
        );
        $this->add_control(
            'cpt_meta_single_field',
            [
                'label' => esc_html__('Select Meta Field', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => '',
                'options' => $this->get_all_cpt_meta_fields(),
                'description' => esc_html__('Select a meta field to display( like for designation).', 'topper-pack'),
                'condition' => [
                    'show_designation' => 'yes',
                    'post_type!' => 'custom',
                ],
            ]
        );
        $this->add_control(
            'social_options',
            [
                'label' => esc_html__('Social Media Options', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
                'condition' => [
                    'post_type!' => 'custom',
                ],
            ]
        );

        $this->add_control(
            'enable_cpt_social_icons',
            [
                'label' => esc_html__('Use CPT Meta Icons', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'topper-pack'),
                'label_off' => esc_html__('No', 'topper-pack'),
                'return_value' => 'yes',
                'default' => 'no',
                'description' => esc_html__('Enable to use meta icons from CPT meta fields( like for social media icons).', 'topper-pack'),
                'condition' => [
                    'post_type!' => 'custom',
                ],
            ]
        );

        $this->add_control(
            'cpt_social_meta_field',
            [
                'label' => esc_html__('Select Icon Meta Field', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => '',
                'options' => $this->get_cpt_social_icon_fields(),
                'description' => esc_html__('Select a meta field that contains icons.', 'topper-pack'),
                'condition' => [
                    'enable_cpt_social_icons' => 'yes',
                    'post_type!' => 'custom',
                ],
            ]
        );
        $this->add_control(
            'cpt_social_meta_field_not_found',
            [
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $social_repeater = new \Elementor\Repeater();
        $social_repeater->add_control(
            'social_icon',
            [
                'label' => esc_html__('Social Icon', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::ICONS,
            ]
        );
        $social_repeater->add_control(
            'social_url',
            [
                'label' => esc_html__('Social URL', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::URL,
                'placeholder' => 'https://example.com',
            ]
        );
        $repeater = new \Elementor\Repeater();
        $repeater->add_control(
            'team_image',
            [
                'label' => esc_html__('Choose Image', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::MEDIA,
            ]
        );
        $repeater->add_control(
            'team_name',
            [
                'label' => esc_html__('Name', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Jhon Artstel', 'topper-pack'),
                'label_block' => true,
            ]
        );
        $repeater->add_control(
            'team_stitle',
            [
                'label' => esc_html__('Designation', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Web Developer', 'topper-pack'),
            ]
        );
        $repeater->add_control(
            'show_description',
            [
                'label' => esc_html__('Show Description', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', 'topper-pack'),
                'label_off' => esc_html__('Hide', 'topper-pack'),
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );
        $repeater->add_control(
            'team_description',
            [
                'label' => esc_html__('Description', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::WYSIWYG,
                'default' => esc_html__('Add Description Here', 'topper-pack'),
                'condition' => [
                    'show_description' => 'yes'
                ]
            ]
        );
        $repeater->add_control(
            'team_socials',
            [
                'label' => esc_html__('Social Icons', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $social_repeater->get_controls(),
                'title_field' => '{{{ social_icon.value }}}',
                'default' => [
                    [
                        'social_icon' => [
                            'value' => 'fab fa-facebook-f',
                            'library' => 'fa-brands',
                        ],
                        'social_url' => [
                            'url' => '#',
                        ],
                    ],
                    [
                        'social_icon' => [
                            'value' => 'fab fa-twitter',
                            'library' => 'fa-brands',
                        ],
                        'social_url' => [
                            'url' => '#',
                        ],
                    ],
                    [
                        'social_icon' => [
                            'value' => 'fab fa-linkedin-in',
                            'library' => 'fa-brands',
                        ],
                        'social_url' => [
                            'url' => '#',
                        ],
                    ],
                ],
            ]
        );
        $this->add_control(
            'repeater_list',
            [
                'label' => esc_html__('Repeater List', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'team_name' => esc_html__('Wilhum Alexs', 'topper-pack'),
                        'team_stitle' => esc_html__('CFO/Founder', 'topper-pack'),
                    ],
                    [
                        'team_name' => esc_html__('David Smith', 'topper-pack'),
                        'team_stitle' => esc_html__('CFO/Founder', 'topper-pack'),
                    ],
                ],
                'title_field' => '{{{ team_name }}}',
                'condition' => [
                    'post_type' => 'custom',
                ],
            ]
        );
        $this->add_control(
            'enable_socil_icons',
            [
                'label' => esc_html__('Enable Social Icon', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', 'topper-pack'),
                'label_off' => esc_html__('Hide', 'topper-pack'),
                'return_value' => 'yes',
                'default' => 'yes',
                'condition' => [
                    'post_type' => 'custom',
                ],
            ]
        );
        $this->add_control(
            'html_tag',
            [
                'label' => esc_html__('Title HTML Tag', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'h4',
                'options' => [
                    'h1' => esc_html__('H1', 'topper-pack'),
                    'h2' => esc_html__('H2', 'topper-pack'),
                    'h3' => esc_html__('H3', 'topper-pack'),
                    'h4' => esc_html__('H4', 'topper-pack'),
                    'h5' => esc_html__('H5', 'topper-pack'),
                    'h6' => esc_html__('H6', 'topper-pack'),
                    'p' => esc_html__('P', 'topper-pack'),
                    'span' => esc_html__('span', 'topper-pack'),
                    'div' => esc_html__('Div', 'topper-pack'),
                ],
            ]
        );
        $this->add_control(
            'title_length',
            [
                'label' => esc_html__('Title Lanth ', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'min' => 1,
                'max' => 40,
                'step' => 1,
                'default' => 4,
                'condition' => [
                    'enable_description' => 'yes',
                    'post_type!' => 'custom',
                ],
            ]
        );

        $this->add_control(
            'enable_description',
            [
                'label' => esc_html__('Enable Description', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', 'topper-pack'),
                'label_off' => esc_html__('Hide', 'topper-pack'),
                'return_value' => 'yes',
                'default' => 'yes',
                'condition' => [
                    'topppa_content_select_styles' => ['style_fourteen', 'style_fifteen'],
                    'post_type!' => 'custom',
                ],
            ]
        );
        $this->add_control(
            'description_lanth',
            [
                'label' => esc_html__('Content Lanth ', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'min' => 1,
                'max' => 80,
                'step' => 1,
                'default' => 15,
                'condition' => [
                    'enable_description' => 'yes',
                    'post_type!' => 'custom',
                ],
            ]
        );
        $this->add_control(
            'post_img_anim',
            [
                'label' => esc_html__('Image Animation', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'anim_one',
                'options' => [
                    'none' => esc_html__('None', 'topper-pack'),
                    'anim_one' => esc_html__('Anim One', 'topper-pack'),
                    'anim_two' => esc_html__('Anim Two', 'topper-pack'),
                    'anim_three' => esc_html__('Anim Three', 'topper-pack'),
                    'anim_rotate' => esc_html__('Anim Rotate', 'topper-pack'),
                ],
                'condition' => [
                    'topppa_content_select_styles!' => ['style_eight', 'style_ten'],
                ],
            ]
        );
        $this->add_responsive_control(
            'anim_bg_color',
            [
                'label' => esc_html__('Color', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .image-anim' => 'background-color: {{VALUE}}',
                ],
                'condition' => [
                    'topppa_content_select_styles!' => ['style_eight', 'style_ten'],
                ],
            ]
        );
        $this->end_controls_section();

        $this->start_controls_section(
            'content_options',
            [
                'label' => esc_html__('Team Slider Option', 'topper-pack'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_control(
            'enable_slider',
            [
                'label' => esc_html__('Enable Slider', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'topper-pack'),
                'label_off' => esc_html__('No', 'topper-pack'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );
        $this->add_control(
            'enable_slider_auto_loop',
            [
                'label' => esc_html__('Enable Auto Loop', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'topper-pack'),
                'label_off' => esc_html__('No', 'topper-pack'),
                'return_value' => 'yes',
                'default' => 'yes',
                'condition' => [
                    'enable_slider' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'enable_rtl',
            [
                'label' => esc_html__('Enable RTL', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'topper-pack'),
                'label_off' => esc_html__('No', 'topper-pack'),
                'return_value' => 'yes',
                'default' => 'no',
                'condition' => [
                    'enable_slider' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'slide_show_lagrge_item',
            [
                'label' => esc_html__('Items to display on Large Devices', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'min' => 1,
                'max' => 6,
                'step' => 1,
                'default' => 2,
                'condition' => [
                    'enable_slider' => 'yes',
                ],
            ]
        );
        $this->add_control(
            'slide_show_teblet_item',
            [
                'label' => esc_html__('Items to display on Teblet Devices', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'min' => 1,
                'max' => 6,
                'step' => 1,
                'default' => 2,
                'condition' => [
                    'enable_slider' => 'yes',
                ],
            ]
        );
        $this->add_control(
            'slide_show_mobile_item',
            [
                'label' => esc_html__('Items to display on Mobile Devices', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'min' => 1,
                'max' => 6,
                'step' => 1,
                'default' => 1,
                'condition' => [
                    'enable_slider' => 'yes',
                ],
            ]
        );
        $this->add_control(
            'slide_show_extra_mobile_item',
            [
                'label' => esc_html__('Items to display on Small Mobile Devices', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'min' => 1,
                'max' => 6,
                'step' => 1,
                'default' => 1,
                'condition' => [
                    'enable_slider' => 'yes',
                ],
            ]
        );
        $this->add_control(
            'slider_space_between',
            [
                'label' => __('Space Between Slides (px)', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                        'step' => 1,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 24,
                ],
                'condition' => [
                    'enable_slider' => 'yes',
                ],
            ]
        );
        $this->add_control(
            'slide_speed',
            [
                'label' => esc_html__('Slide Speed (ms)', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'min' => 100,
                'max' => 10000,
                'step' => 100,
                'default' => 2000,
                'condition' => [
                    'enable_slider' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'slider_speed',
            [
                'label' => esc_html__('Slider Transition Speed (ms)', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'min' => 100,
                'max' => 5000,
                'step' => 100,
                'default' => 600,
                'condition' => [
                    'enable_slider' => 'yes',
                ],
            ]
        );
        $this->add_control(
            'enable_dote',
            [
                'label' => esc_html__('Enable Dote', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('On', 'topper-pack'),
                'label_off' => esc_html__('Off', 'topper-pack'),
                'return_value' => 'yes',
                'default' => 'no',
                'condition' => [
                    'enable_slider' => 'yes',
                ],
            ]
        );
        $this->add_control(
            'xl_col',
            [
                'label' => esc_html__('Columns on Large Devices', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    'col-xl-2' => esc_html__('6 Columns', 'topper-pack'),
                    'col-xl-3' => esc_html__('4 Columns', 'topper-pack'),
                    'col-xl-4' => esc_html__('3 Columns', 'topper-pack'),
                    'col-xl-6' => esc_html__('2 Columns', 'topper-pack'),
                    'col-xl-12' => esc_html__('1 Columns', 'topper-pack'),
                ],
                'default' => 'col-xl-4',
                'condition' => [
                    'enable_slider!' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'lg_col',
            [
                'label' => esc_html__('Columns on Desktop', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    'col-lg-2' => esc_html__('6 Columns', 'topper-pack'),
                    'col-lg-3' => esc_html__('4 Columns', 'topper-pack'),
                    'col-lg-4' => esc_html__('3 Columns', 'topper-pack'),
                    'col-lg-6' => esc_html__('2 Columns', 'topper-pack'),
                    'col-lg-12' => esc_html__('1 Columns', 'topper-pack'),
                ],
                'default' => 'col-lg-4',
                'condition' => [
                    'enable_slider!' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'desktop_col',
            [
                'label' => esc_html__('Columns on Teb', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    'col-md-2' => esc_html__('6 Columns', 'topper-pack'),
                    'col-md-3' => esc_html__('4 Columns', 'topper-pack'),
                    'col-md-4' => esc_html__('3 Columns', 'topper-pack'),
                    'col-md-6' => esc_html__('2 Columns', 'topper-pack'),
                    'col-md-12' => esc_html__('1 Columns', 'topper-pack'),
                ],
                'default' => 'col-md-6',
                'condition' => [
                    'enable_slider!' => 'yes',
                ],
            ]
        );
        $this->end_controls_section();
        $this->start_controls_section(
            'box_css_options',
            [
                'label' => esc_html__('Box Style Option', 'topper-pack'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_responsive_control(
            'box_display',
            [
                'label' => esc_html__('Display Style', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => '',
                'options' => [
                    '' => esc_html__('Default', 'topper-pack'),
                    'flex' => esc_html__('Flex', 'topper-pack'),
                ],
                'selectors' => [
                    '{{WRAPPER}} .topppa-team-v1-item' => 'display: {{VALUE}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'content_box_direction',
            [
                'label' => esc_html__('Direction', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'none',
                'options' => [
                    'none' => esc_html__('None', 'topper-pack'),
                    'row' => esc_html__('Row', 'topper-pack'),
                    'row-reverse' => esc_html__('Row Reverse', 'topper-pack'),
                    'column' => esc_html__('Column', 'topper-pack'),
                    'column-reverse' => esc_html__('Column Reverse', 'topper-pack'),
                ],
                'selectors' => [
                    '{{WRAPPER}} .topppa-team-v1-item' => 'flex-direction: {{VALUE}};',
                ],
                'condition' => [
                    'box_display' => 'flex',
                ]
            ]
        );
        $this->add_responsive_control(
            'content_box_align',
            [
                'label' => esc_html__('Alignment', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'start' => [
                        'title' => esc_html__('Start', 'topper-pack'),
                        'icon' => 'eicon-v-align-top',
                    ],
                    'center' => [
                        'title' => esc_html__('Center', 'topper-pack'),
                        'icon' => 'eicon-v-align-middle',
                    ],
                    'end' => [
                        'title' => esc_html__('End', 'topper-pack'),
                        'icon' => 'eicon-v-align-bottom',
                    ],
                ],
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .topppa-team-v1-item' => 'align-items: {{VALUE}};',
                ],
                'condition' => [
                    'box_display' => 'flex',
                ]
            ]
        );
        $this->add_responsive_control(
            'content_box_jalign',
            [
                'label' => esc_html__('Alignment', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'start' => [
                        'title' => esc_html__('Left', 'topper-pack'),
                        'icon' => 'eicon-align-start-h',
                    ],
                    'center' => [
                        'title' => esc_html__('Center', 'topper-pack'),
                        'icon' => 'eicon-align-center-h',
                    ],
                    'end' => [
                        'title' => esc_html__('Right', 'topper-pack'),
                        'icon' => 'eicon-align-end-h',
                    ],
                ],
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .topppa-team-v1-item' => 'justify-content: {{VALUE}};',
                    '{{WRAPPER}} .topppa-team-v1-item' => 'text-align: {{VALUE}};',
                ],
                'condition' => [
                    'box_display' => 'flex',
                    'content_box_direction' => ['column', 'column-reverse']
                ]
            ]
        );
        $this->add_responsive_control(
            'content_box_gap',
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
                    '{{WRAPPER}} .topppa-team-v1-item' => 'gap: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'box_display' => 'flex',
                ]
            ]
        );
        $this->add_responsive_control(
            'box_width',
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
                    '{{WRAPPER}} .topppa-team-v1-item' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'box_height2',
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
                    '{{WRAPPER}} .topppa-team-v1-item' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->start_controls_tabs(
            'box_tab'
        );
        $this->start_controls_tab(
            'box_style_option',
            [
                'label' => __('Box', 'topper-pack'),
            ]
        );
        $this->add_responsive_control(
            'box_alignment',
            [
                'label' => __('Alignment', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => __('Left', 'topper-pack'),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => __('Center', 'topper-pack'),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title' => __('Right', 'topper-pack'),
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .topppa-team-v1-content-area' => 'text-align: {{VALUE}}',
                    '{{WRAPPER}} .topppa-team-v1-wrapper.team-v2 .topppa-team-v1-item .topppa-team-v1-content .topppa-team-v1-social-item ul' => 'justify-content: {{VALUE}}',
                ],
            ]
        );
        $this->add_responsive_control(
            'box_height',
            [
                'label' => esc_html__('Height', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
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
                    '{{WRAPPER}} .topppa-team-v1-item' => 'height: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'topppa_content_select_styles' => ['style_one', 'style_three', 'style_twelve'],
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'box_bg',
                'label' => esc_html__('Background', 'topper-pack'),
                'types' => ['classic', 'gradient', 'video'],
                'selector' => '{{WRAPPER}} .topppa-team-v1-item,{{WRAPPER}} .topppa-team-v1-wrapper.team-v3 .topppa-team-v1-item .topppa-team-v1-content',
                'condition' => [
                    'topppa_content_select_styles!' => 'style_one',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'box_shadow',
                'label' => esc_html__('Box Shadow', 'topper-pack'),
                'selector' => '{{WRAPPER}} .topppa-team-v1-item',
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'box_border',
                'label' => esc_html__('Border', 'topper-pack'),
                'selector' => '{{WRAPPER}} .topppa-team-v1-item',
            ]
        );
        $this->add_responsive_control(
            'box_radius',
            [
                'label' => esc_html__('image Radius', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .topppa-team-v1-item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'box_margin',
            [
                'label' => esc_html__('Margin', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .topppa-team-v1-item' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                    '{{WRAPPER}} .topppa-team-v1-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'topppa_content_select_styles!' => ['style_three', 'style_fourteen'],
                ],
            ]
        );
        $this->add_responsive_control(
            'inner_box_padding2',
            [
                'label' => esc_html__('Padding', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .topppa-team-v1-item .topppa-team-v1-content-area' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'topppa_content_select_styles' => ['style_three', 'style_fourteen'],
                ],
            ]
        );
        $this->end_controls_tab();
        $this->start_controls_tab(
            'box_style_option_hover',
            [
                'label' => __('Hover', 'topper-pack'),
                'condition' => [
                    'topppa_content_select_styles' => ['style_two', 'style_seven', 'style_fourteen', 'style_fifteen'],
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'box_bg_hover',
                'label' => esc_html__('Background', 'topper-pack'),
                'types' => ['classic', 'gradient', 'video'],
                'selector' => '{{WRAPPER}} .topppa-team-v1-item:hover',
                'condition' => [
                    'topppa_content_select_styles!' => 'style_one',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'box_shadow_hover',
                'label' => esc_html__('Box Shadow', 'topper-pack'),
                'selector' => '{{WRAPPER}} .topppa-team-v1-item:hover',
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'box_border_hover',
                'label' => esc_html__('Border', 'topper-pack'),
                'selector' => '{{WRAPPER}} .topppa-team-v1-item:hover',
            ]
        );
        $this->add_responsive_control(
            'box_radius_hover',
            [
                'label' => esc_html__('image Radius', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .topppa-team-v1-item:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_tab();
        $this->start_controls_tab(
            'inner_box_tab',
            [
                'label' => __('Content Box', 'topper-pack'),
                'condition' => [
                    'topppa_content_select_styles!' => ['style_two', 'style_three', 'style_seven', 'style_eight', 'style_ten', 'style_eleven', 'style_fourteen', 'style_fifteen'],
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'inner_box_bg',
                'label' => esc_html__('Background', 'topper-pack'),
                'types' => ['classic', 'gradient', 'video'],
                'selector' => '{{WRAPPER}} .topppa-team-v1-item .topppa-team-v1-content-area',
            ]
        );
        $this->add_responsive_control(
            'inner_box_after_bg',
            [
                'label' => esc_html__('Aafter Color', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .topppa-team-v1-wrapper .topppa-team-v1-item .topppa-team-v1-content-area:after' => 'background-color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'inner_box_shadow',
                'label' => esc_html__('Box Shadow', 'topper-pack'),
                'selector' => '{{WRAPPER}} .topppa-team-v1-item .topppa-team-v1-content-area',
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'inner_box_border',
                'label' => esc_html__('Border', 'topper-pack'),
                'selector' => '{{WRAPPER}} .topppa-team-v1-item .topppa-team-v1-content-area',
            ]
        );
        $this->add_responsive_control(
            'inner_box_radius',
            [
                'label' => esc_html__('image Radius', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .topppa-team-v1-item .topppa-team-v1-content-area' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'inner_box_margin',
            [
                'label' => esc_html__('Margin', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .topppa-team-v1-item .topppa-team-v1-content-area' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                    '{{WRAPPER}} .topppa-team-v1-item .topppa-team-v1-content-area' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_tab();
        $this->start_controls_tab(
            'inner_box_tab_hover',
            [
                'label' => __('Content Hover Box', 'topper-pack'),
                'condition' => [
                    'topppa_content_select_styles' => ['style_six', 'style_sixteen'],
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'inner_box_bg_hover',
                'label' => esc_html__('Background', 'topper-pack'),
                'types' => ['classic', 'gradient', 'video'],
                'selector' => '{{WRAPPER}} .topppa-team-v1-item:hover .topppa-team-v1-content-area',
            ]
        );
        $this->add_responsive_control(
            'inner_box_after_bg_hover',
            [
                'label' => esc_html__('Aafter Color', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .topppa-team-v1-wrapper .topppa-team-v1-item .topppa-team-v1-content-area:before' => 'background-color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'inner_box_shadow_hover',
                'label' => esc_html__('Box Shadow', 'topper-pack'),
                'selector' => '{{WRAPPER}} .topppa-team-v1-item:hover  .topppa-team-v1-content-area',
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'inner_box_border_hover',
                'label' => esc_html__('Border', 'topper-pack'),
                'selector' => '{{WRAPPER}} .topppa-team-v1-item:hover .topppa-team-v1-content-area',
            ]
        );
        $this->add_responsive_control(
            'inner_box_radius_hover',
            [
                'label' => esc_html__('image Radius', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .topppa-team-v1-item:hover .topppa-team-v1-content-area' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'inner_box_margin_hover',
            [
                'label' => esc_html__('Margin', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .topppa-team-v1-item:hover .topppa-team-v1-content-area' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'inner_box_padding_hover',
            [
                'label' => esc_html__('Padding', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .topppa-team-v1-item:hover .topppa-team-v1-content-area' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();

        $this->start_controls_section(
            'content_box_style',
            [
                'label' => esc_html__('Content Style Option', 'topper-pack'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_responsive_control(
            'content_gap_style_15',
            [
                'label' => esc_html__('Content Gap', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                        'step' => 1,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .topppa-team-v1-wrapper .topppa-team-v1-item' => 'gap: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'topppa_content_select_styles!' => ['style_fifteen'],
                ],
            ]
        );
        $this->add_responsive_control(
            'image_border_color_style8',
            [
                'label' => esc_html__('Border Color (Style 8)', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .topppa-team-v1-wrapper.team-v8 .topppa-team-v1-item .topppa-team-v1-img:after' => 'border-color: {{VALUE}}',
                ],
                'condition' => [
                    'topppa_content_select_styles' => 'style_eight',
                ],
            ]
        );
        $this->add_control(
            'content_flex_direction',
            [
                'label' => esc_html__('Flex Direction', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'row' => [
                        'title' => esc_html__('Row', 'topper-pack'),
                        'icon' => 'eicon-h-align-left', // horizontal
                    ],
                    'column' => [
                        'title' => esc_html__('Column', 'topper-pack'),
                        'icon' => 'eicon-v-align-top', // vertical
                    ],
                    'row-reverse' => [
                        'title' => esc_html__('Row Reverse', 'topper-pack'),
                        'icon' => 'eicon-h-align-right', // horizontal reversed
                    ],
                    'column-reverse' => [
                        'title' => esc_html__('Column Reverse', 'topper-pack'),
                        'icon' => 'eicon-v-align-bottom', // vertical reversed
                    ],
                ],
                'toggle' => false,
                'selectors' => [
                    '{{WRAPPER}} .topppa-team-v1-wrapper .topppa-team-v1-content-wrap' => 'flex-direction: {{VALUE}};',
                ],
            ]
        );
        $this->start_controls_tabs(
            'content_box_tabs'
        );
        $this->start_controls_tab(
            'subtitle_style_options',
            [
                'label' => esc_html__('Stitle', 'topper-pack'),
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'subtitle_title_typo',
                'label' => __('Typography', 'topper-pack'),
                'selector' => '{{WRAPPER}} .topppa-team-v1-wrapper .topppa-team-v1-item .topppa-team-v1-stitle',
            ]
        );

        $this->add_responsive_control(
            'subtitle_color',
            [
                'label' => esc_html__('Color', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .topppa-team-v1-wrapper .topppa-team-v1-item .topppa-team-v1-stitle' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'subtitle_color_hover',
            [
                'label' => esc_html__('Hover Color', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .topppa-team-v1-wrapper .topppa-team-v1-item:hover .topppa-team-v1-stitle' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'topppa_content_select_styles' => ['style_six', 'style_seven', 'style_fifteen', 'style_sixteen'],
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'stitle_background',
                'types' => ['classic', 'gradient', 'video'],
                'selector' => '{{WRAPPER}} .topppa-team-v1-wrapper .topppa-team-v1-item .topppa-team-v1-stitle::before',
                'condition' => [
                    'topppa_content_select_styles' => ['style_eleven'],
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'stitle_border',
                'label' => esc_html__('Border', 'topper-pack'),
                'selector' => '{{WRAPPER}} .topppa-team-v1-wrapper .topppa-team-v1-item .topppa-team-v1-stitle',
            ]
        );
        $this->add_responsive_control(
            'stitle_border_radius',
            [
                'label' => esc_html__('Border Radius', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .topppa-team-v1-wrapper.team-v11 .topppa-team-v1-item .topppa-team-v1-stitle::before' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'topppa_content_select_styles' => ['style_eleven'],
                ],
            ]
        );
        $this->add_responsive_control(
            'subtitle_margin',
            [
                'label' => esc_html__('Margin', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .topppa-team-v1-wrapper .topppa-team-v1-item .topppa-team-v1-stitle' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'subtitle_padding',
            [
                'label' => esc_html__('Padding', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .topppa-team-v1-wrapper .topppa-team-v1-item .topppa-team-v1-stitle' => 'Padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_tab();

        $this->start_controls_tab(
            'title_style_options',
            [
                'label' => esc_html__('Title', 'topper-pack'),
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'title_typo',
                'label' => __('Typography', 'topper-pack'),
                'selector' => '{{WRAPPER}} .topppa-team-v1-wrapper .topppa-team-v1-item .topppa-team-v1-title',
            ]
        );
        $this->add_responsive_control(
            'title_color',
            [
                'label' => esc_html__('Color', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .topppa-team-v1-wrapper .topppa-team-v1-item .topppa-team-v1-title a' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .topppa-team-v1-wrapper .topppa-team-v1-item .topppa-team-v1-title' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'title_color_hover',
            [
                'label' => esc_html__('Hover Color', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .topppa-team-v1-wrapper .topppa-team-v1-item .topppa-team-v1-title a:hover' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'topppa_content_select_styles!' => ['style_six', 'style_seven', 'style_fifteen', 'style_sixteen'],
                ],
            ]
        );
        $this->add_responsive_control(
            'title_b_color_hover',
            [
                'label' => esc_html__('Hover Color', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .topppa-team-v1-wrapper .topppa-team-v1-item:hover .topppa-team-v1-title a' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'topppa_content_select_styles' => ['style_six', 'style_seven', 'style_fifteen', 'style_sixteen'],
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'title_background',
                'types' => ['classic', 'gradient', 'video'],
                'selector' => '{{WRAPPER}} .topppa-team-v1-wrapper .topppa-team-v1-item .topppa-team-v1-title::before',
                'condition' => [
                    'topppa_content_select_styles' => ['style_eleven'],
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'title_bg_hover_color',
                'label' => esc_html__('Background Hover Color', 'topper-pack'),
                'types' => ['classic', 'gradient', 'video'],
                'selector' => '{{WRAPPER}} .topppa-team-v1-item .topppa-team-v1-title:hover',
                'fields_options' => [
                    'background' => [
                        'label' => esc_html__('Background Hover Color', 'topper-pack'),
                        'default' => 'classic',
                    ],
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'content_title_border',
                'selector' => '{{WRAPPER}} .topppa-team-v1-wrapper.team-v11 .topppa-team-v1-item .topppa-team-v1-title::before',
                'condition' => [
                    'topppa_content_select_styles' => ['style_eleven'],
                ],
            ]
        );
        $this->add_responsive_control(
            'content_title_border_radius',
            [
                'label' => esc_html__('Border Radius', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .topppa-team-v1-wrapper.team-v11 .topppa-team-v1-item .topppa-team-v1-title::before' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'topppa_content_select_styles' => ['style_eleven'],
                ],
            ]
        );
        $this->add_responsive_control(
            'title_margin',
            [
                'label' => esc_html__('Margin', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .topppa-team-v1-wrapper .topppa-team-v1-item .topppa-team-v1-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'title_padding',
            [
                'label' => esc_html__('Padding', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .topppa-team-v1-wrapper .topppa-team-v1-item .topppa-team-v1-title' => 'Padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_tab();
        $this->start_controls_tab(
            'des_style_options',
            [
                'label' => esc_html__('Description', 'topper-pack'),
                'condition' => [
                    'topppa_content_select_styles' => ['style_fourteen', 'style_fifteen'],
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'des_typo',
                'label' => __('Typography', 'topper-pack'),
                'selector' => '{{WRAPPER}} .topppa-team-v1-wrapper .topppa-team-v1-des',
            ]
        );
        $this->add_responsive_control(
            'des_color',
            [
                'label' => esc_html__('Color', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .topppa-team-v1-wrapper .topppa-team-v1-des' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'des_color_hover',
            [
                'label' => esc_html__('Hover Color', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .topppa-team-v1-wrapper .topppa-team-v1-item:hover .topppa-team-v1-des' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'topppa_content_select_styles' => ['style_fifteen'],
                ],
            ]
        );

        $this->add_responsive_control(
            'des_margin',
            [
                'label' => esc_html__('Margin', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .topppa-team-v1-wrapper .topppa-team-v1-des' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'des_padding',
            [
                'label' => esc_html__('Padding', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .topppa-team-v1-wrapper .topppa-team-v1-des' => 'Padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_tab();
        $this->start_controls_tab(
            'style_image_tab',
            [
                'label' => esc_html__('Image', 'topper-pack'),
                'condition' => [
                    'topppa_content_select_styles!' => ['style_one', 'style_three', 'style_ten', 'style_twelve', 'style_thirteen'],
                ],
            ]
        );
        $this->add_responsive_control(
            'image_bg_before_color',
            [
                'label' => esc_html__('Before Color', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .topppa-team-v1-wrapper .topppa-team-v1-item .topppa-team-v1-img::before' => 'background-color: {{VALUE}}',
                ],
                'condition' => [
                    'topppa_content_select_styles' => ['style_eight', 'style_fourteen'],
                ],
            ]
        );
        $this->add_responsive_control(
            'image_bg_after_color',
            [
                'label' => esc_html__('After Color', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .topppa-team-v1-wrapper .topppa-team-v1-item .topppa-team-v1-img::after' => 'border-color: {{VALUE}}',
                ],
                'condition' => [
                    'topppa_content_select_styles' => ['style_fourteen'],
                ],
            ]
        );

        $this->add_responsive_control(
            'Image_height',
            [
                'label' => esc_html__('Height', 'topper-pack'),
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
                'default' => [
                    'unit' => 'px',
                ],
                'selectors' => [
                    '{{WRAPPER}} .topppa-team-v1-wrapper .topppa-team-v1-item .topppa-team-v1-img' => 'height: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'topppa_content_select_styles!' => ['style_twelve'],
                ],
            ]
        );
        $this->add_control(
            'hover_blur_amount',
            [
                'label' => esc_html__('Hover Blur Amount (px)', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 20,
                        'step' => 1,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 3,
                ],
                'selectors' => [
                    '{{WRAPPER}} .topppa-team-v1-wrapper.team-v11 .topppa-team-v1-item:hover .topppa-team-v1-img img' => 'filter: blur({{SIZE}}{{UNIT}});',
                ],
            ]
        );
        $this->add_control(
            'hover_filter_image',
            [
                'label' => esc_html__('Hover Filter (%)', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['%'],
                'range' => [
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                        'step' => 1,
                    ],
                ],
                'default' => [
                    'unit' => '%',
                    'size' => 30,
                ],
                'selectors' => [
                    '{{WRAPPER}} .topppa-team-v1-wrapper .topppa-team-v1-item:hover .topppa-team-v1-img img' => 'filter: grayscale({{SIZE}}{{UNIT}}) sepia({{SIZE}}{{UNIT}});',
                ],
            ]
        );

        $this->add_responsive_control(
            'Image_width',
            [
                'label' => esc_html__('Width', 'topper-pack'),
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
                'default' => [
                    'unit' => 'px',
                ],
                'selectors' => [
                    '{{WRAPPER}} .topppa-team-v1-wrapper .topppa-team-v1-item .topppa-team-v1-img' => 'width: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'topppa_content_select_styles' => ['style_seven', 'style_eight', 'style_fifteen'],
                ],
            ]
        );
        $this->add_responsive_control(
            'min_Image_width',
            [
                'label' => esc_html__('Min Width', 'topper-pack'),
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
                'default' => [
                    'unit' => 'px',
                ],
                'selectors' => [
                    '{{WRAPPER}} .topppa-team-v1-wrapper .topppa-team-v1-item .topppa-team-v1-img' => 'min-width: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'topppa_content_select_styles' => ['style_fifteen'],
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'image_border',
                'selector' => '{{WRAPPER}} .topppa-team-v1-wrapper .topppa-team-v1-item .topppa-team-v1-img',
            ]
        );
        $this->add_responsive_control(
            'image_border_radius',
            [
                'label' => esc_html__('Border Radius', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .topppa-team-v1-wrapper .topppa-team-v1-item .topppa-team-v1-img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .topppa-team-v1-wrapper.team-v8 .topppa-team-v1-item .topppa-team-v1-img img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'image_margin',
            [
                'label' => esc_html__('Margin', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .topppa-team-v1-wrapper .topppa-team-v1-item .topppa-team-v1-img' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'image_padding',
            [
                'label' => esc_html__('Padding', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .topppa-team-v1-wrapper .topppa-team-v1-item .topppa-team-v1-img' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_tab();
        $this->start_controls_tab(
            'style_image_tab2',
            [
                'label' => esc_html__('Image', 'topper-pack'),
                'condition' => [
                    'topppa_content_select_styles' => ['style_ten'],
                ],
            ]
        );
        $this->add_responsive_control(
            'Image_height2',
            [
                'label' => esc_html__('Height', 'topper-pack'),
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
                'default' => [
                    'unit' => 'px',
                ],
                'selectors' => [
                    '{{WRAPPER}} .topppa-team-v1-wrapper .topppa-team-v1-item .topppa-team-v1-img img' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'Image_width2',
            [
                'label' => esc_html__('Width', 'topper-pack'),
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
                'default' => [
                    'unit' => 'px',
                ],
                'selectors' => [
                    '{{WRAPPER}} .topppa-team-v1-wrapper .topppa-team-v1-item .topppa-team-v1-img img' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'image_border2',
                'selector' => '{{WRAPPER}} .topppa-team-v1-wrapper .topppa-team-v1-item .topppa-team-v1-img img',
            ]
        );
        $this->add_responsive_control(
            'image_border_radius2',
            [
                'label' => esc_html__('Border Radius', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .topppa-team-v1-wrapper .topppa-team-v1-item .topppa-team-v1-img img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'image_margin2',
            [
                'label' => esc_html__('Margin', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .topppa-team-v1-wrapper .topppa-team-v1-item .topppa-team-v1-img img' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'image_padding2',
            [
                'label' => esc_html__('Padding', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .topppa-team-v1-wrapper .topppa-team-v1-item .topppa-team-v1-img img' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();
        $this->start_controls_section(
            'social_icon_box_css',
            [
                'label' => esc_html__('Social Icon Style', 'topper-pack'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'social_icon_box_bg',
                'label' => esc_html__('Background', 'topper-pack'),
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .topppa-team-v1-wrapper .topppa-team-v1-item .topppa-team-v1-social-item ul',
                'condition' => [
                    'topppa_content_select_styles!' => ['style_one', 'style_two', 'style_three', 'style_four', 'style_seven', 'style_eight', 'style_nine', 'style_ten', 'style_eleven', 'style_twelve', 'style_fourteen', 'style_fifteen', 'style_sixteen'],
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'social_icon_box_border',
                'selector' => '{{WRAPPER}} .topppa-team-v1-wrapper .topppa-team-v1-item .topppa-team-v1-social-item ul',
                'condition' => [
                    'topppa_content_select_styles!' => ['style_one', 'style_three', 'style_four', 'style_seven', 'style_eight', 'style_nine', 'style_ten', 'style_eleven', 'style_twelve', 'style_fourteen', 'style_sixteen'],
                ],
            ]
        );
        $this->add_responsive_control(
            'social_icon_box_border_radius',
            [
                'label' => esc_html__('Border Radius', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .topppa-team-v1-wrapper .topppa-team-v1-item .topppa-team-v1-social-item ul' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',

                ],
                'condition' => [
                    'topppa_content_select_styles!' => ['style_one', 'style_two', 'style_three', 'style_four', 'style_seven', 'style_eight', 'style_nine', 'style_ten', 'style_eleven', 'style_twelve', 'style_fourteen', 'style_sixteen'],
                ],
            ]
        );
        $this->add_responsive_control(
            'social_icon_box_margin',
            [
                'label' => esc_html__('Margin', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .topppa-team-v1-wrapper .topppa-team-v1-item .topppa-team-v1-social-item ul' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'topppa_content_select_styles!' => ['style_eight', 'style_nine', 'style_eleven', 'style_twelve', 'style_fourteen', 'style_sixteen'],
                ],
            ]
        );
        $this->add_responsive_control(
            'social_icon_box_padding',
            [
                'label' => esc_html__('Padding', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .topppa-team-v1-wrapper .topppa-team-v1-item .topppa-team-v1-social-item ul' => 'Padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'topppa_content_select_styles!' => ['style_eight', 'style_nine', 'style_eleven', 'style_twelve', 'style_fourteen', 'style_sixteen'],
                ],
            ]
        );
        $this->add_responsive_control(
            'social_icon_gap',
            [
                'label' => esc_html__('Icon Gap', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                        'step' => 1,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .topppa-team-v1-wrapper .topppa-team-v1-item .topppa-team-v1-social-item ul' => 'gap: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'topppa_content_select_styles!' => ['style_eight', 'style_nine', 'style_eleven', 'style_twelve', 'style_thirteen', 'style_fourteen', 'style_sixteen'],
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'social_icon_typo',
                'label' => esc_html__('Typography', 'topper-pack'),
                'selector' => '{{WRAPPER}} .topppa-team-v1-wrapper .topppa-team-v1-item .topppa-team-v1-social-item ul a',
            ]
        );
        $this->start_controls_tabs(
            'social_icon_tabs'
        );
        $this->start_controls_tab(
            'social_icon_tab_normal',
            [
                'label' => __('Normal', 'topper-pack'),
            ]
        );

        $this->add_responsive_control(
            'social_icon_color',
            [
                'label' => esc_html__('Color', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .topppa-team-v1-wrapper .topppa-team-v1-item .topppa-team-v1-social-item ul a' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'social_icon_bg',
                'types' => ['classic', 'gradient', 'video'],
                'selector' => '{{WRAPPER}} .topppa-team-v1-wrapper .topppa-team-v1-item .topppa-team-v1-social-item ul a',
            ]
        );
        $this->add_responsive_control(
            'social_icon_width',
            [
                'label' => esc_html__('Width', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 130,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .topppa-team-v1-wrapper .topppa-team-v1-item .topppa-team-v1-social-item ul a' => 'width: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'topppa_content_select_styles!' => ['style_eleven'],
                ],
            ]
        );
        $this->add_responsive_control(
            'social_icon_width2',
            [
                'label' => esc_html__('Width', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 130,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .topppa-team-v1-wrapper .topppa-team-v1-item:hover .topppa-team-v1-social-item ul a' => 'width: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'topppa_content_select_styles' => ['style_eleven'],
                ],
            ]
        );
        $this->add_responsive_control(
            'social_icon_height',
            [
                'label' => esc_html__('Height', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 130,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .topppa-team-v1-wrapper .topppa-team-v1-item .topppa-team-v1-social-item ul a' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'social_icon_border',
                'label' => esc_html__('Border', 'topper-pack'),
                'selector' => '{{WRAPPER}} .topppa-team-v1-wrapper .topppa-team-v1-item .topppa-team-v1-social-item ul a',
            ]
        );
        $this->add_responsive_control(
            'social_icon_radius',
            [
                'label' => esc_html__('Border Radius', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .topppa-team-v1-wrapper .topppa-team-v1-item .topppa-team-v1-social-item ul a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'social_icon_shadow',
                'label' => esc_html__('Shadow', 'topper-pack'),
                'selector' => '{{WRAPPER}} .topppa-team-v1-wrapper .topppa-team-v1-item .topppa-team-v1-social-item ul a',
            ]
        );
        $this->end_controls_tab();

        $this->start_controls_tab(
            'social_icon_tab_hover',
            [
                'label' => __('Hover', 'topper-pack'),
                'condition' => [
                    'topppa_content_select_styles!' => ['style_seven', 'style_fifteen'],
                ],
            ]
        );
        $this->add_responsive_control(
            'social_icon_hcolor',
            [
                'label' => esc_html__('Color', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .topppa-team-v1-wrapper .topppa-team-v1-item .topppa-team-v1-social-item ul a:hover' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'social_icon_hbg',
                'types' => ['classic', 'gradient', 'video'],
                'selector' => '{{WRAPPER}} .topppa-team-v1-wrapper .topppa-team-v1-item .topppa-team-v1-social-item ul a:hover',
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'social_icon_hborder',
                'label' => esc_html__('Border', 'topper-pack'),
                'selector' => '{{WRAPPER}} .topppa-team-v1-wrapper .topppa-team-v1-item .topppa-team-v1-social-item ul a:hover',
            ]
        );
        $this->add_responsive_control(
            'social_icon_hradius',
            [
                'label' => esc_html__('Border Radius', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .topppa-team-v1-wrapper .topppa-team-v1-item .topppa-team-v1-social-item ul a:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'social_icon_hshadow',
                'label' => esc_html__('Shadow', 'topper-pack'),
                'selector' => '{{WRAPPER}} .topppa-team-v1-wrapper .topppa-team-v1-item .topppa-team-v1-social-item ul a:hover',
            ]
        );
        $this->end_controls_tab();
        $this->start_controls_tab(
            'social_icon_tab_hover2',
            [
                'label' => __('Hover', 'topper-pack'),
                'condition' => [
                    'topppa_content_select_styles' => ['style_seven', 'style_fifteen'],
                ],
            ]
        );
        $this->add_responsive_control(
            'social_icon_hcolor2',
            [
                'label' => esc_html__('Color', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .topppa-team-v1-wrapper .topppa-team-v1-item:hover .topppa-team-v1-social-item ul a' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'social_icon_hbg2',
                'types' => ['classic', 'gradient', 'video'],
                'selector' => '{{WRAPPER}} .topppa-team-v1-wrapper .topppa-team-v1-item:hover .topppa-team-v1-social-item ul a',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'social_icon_hborder2',
                'label' => esc_html__('Border', 'topper-pack'),
                'selector' => '{{WRAPPER}} .topppa-team-v1-wrapper .topppa-team-v1-item:hover .topppa-team-v1-social-item ul a',
            ]
        );
        $this->add_responsive_control(
            'social_icon_hradius2',
            [
                'label' => esc_html__('Border Radius', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .topppa-team-v1-wrapper .topppa-team-v1-item:hover .topppa-team-v1-social-item ul a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'social_icon_hshadow2',
                'label' => esc_html__('Shadow', 'topper-pack'),
                'selector' => '{{WRAPPER}} .topppa-team-v1-wrapper .topppa-team-v1-item:hover .topppa-team-v1-social-item ul a',
            ]
        );
        $this->end_controls_tab();
        $this->start_controls_tab(
            'social_Static_icon_tab_normal',
            [
                'label' => __('Static Icon', 'topper-pack'),
                'condition' => [
                    'topppa_content_select_styles' => ['style_eight', 'style_nine', 'style_ten', 'style_thirteen'],
                ],
            ]
        );

        $this->add_responsive_control(
            'social_Static_icon_color',
            [
                'label' => esc_html__('Color', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .topppa-team-v1-wrapper .topppa-team-v1-item .topppa-team-v1-social-item .team-v1-social-share' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'social_Static_icon_bg',
                'types' => ['classic', 'gradient', 'video'],
                'selector' => '{{WRAPPER}} .topppa-team-v1-wrapper .topppa-team-v1-item .topppa-team-v1-social-item .team-v1-social-share',
            ]
        );
        $this->add_responsive_control(
            'social_Static_icon_width',
            [
                'label' => esc_html__('Width', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 130,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .topppa-team-v1-wrapper .topppa-team-v1-item .topppa-team-v1-social-item .team-v1-social-share' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'social_Static_icon_height',
            [
                'label' => esc_html__('Height', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 130,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .topppa-team-v1-wrapper .topppa-team-v1-item .topppa-team-v1-social-item .team-v1-social-share' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'social_Static_icon_border',
                'label' => esc_html__('Border', 'topper-pack'),
                'selector' => '{{WRAPPER}} .topppa-team-v1-wrapper .topppa-team-v1-item .topppa-team-v1-social-item .team-v1-social-share',
            ]
        );
        $this->add_responsive_control(
            'social_Static_icon_radius',
            [
                'label' => esc_html__('Border Radius', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .topppa-team-v1-wrapper .topppa-team-v1-item .topppa-team-v1-social-item .team-v1-social-share' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'social_Static_icon_shadow',
                'label' => esc_html__('Shadow', 'topper-pack'),
                'selector' => '{{WRAPPER}} .topppa-team-v1-wrapper .topppa-team-v1-item .topppa-team-v1-social-item .team-v1-social-share',
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->add_responsive_control(
            'social_icon_margin',
            [
                'label' => esc_html__('Margin', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .topppa-team-v1-wrapper .topppa-team-v1-item .topppa-team-v1-social-item ul a' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .topppa-team-v1-wrapper .topppa-team-v1-item .topppa-team-v1-social-item ul button.team-v1-social-share' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'social_icon_padding',
            [
                'label' => esc_html__('Padding', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .topppa-team-v1-wrapper .topppa-team-v1-item .topppa-team-v1-social-item ul a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .topppa-team-v1-wrapper .topppa-team-v1-item .topppa-team-v1-social-item ul button.team-v1-social-share' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();
        $this->start_controls_section(
            'dote_content_option',
            [
                'label' => esc_html__('Dots Style', 'topper-pack'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                'condition' => [
                    'enable_dote' => 'yes',
                    'enable_slider' => 'yes',
                ],
            ]
        );
        $this->add_responsive_control(
            'dote_gap',
            [
                'label' => esc_html__('Gap', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'custom'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 300,
                        'step' => 1,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .topppa-dote-pagination' => 'gap: {{SIZE}}{{UNIT}};',
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 24,
                ],
            ]
        );
        $this->add_responsive_control(
            'dote_align',
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
                ],
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .topppa-dote-pagination' => 'justify-content: {{VALUE}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'dote_height',
            [
                'label' => esc_html__('Height', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'custom'],
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
                'default' => [
                    'unit' => 'px',
                ],
                'selectors' => [
                    '{{WRAPPER}} .swiper-pagination-bullets span.swiper-pagination-bullet' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'dote_width',
            [
                'label' => esc_html__('Width', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'custom'],
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
                'default' => [
                    'unit' => 'px',
                ],
                'selectors' => [
                    '{{WRAPPER}} .swiper-pagination-bullets span.swiper-pagination-bullet' => 'Width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'dote_background',
                'label' => esc_html__('Background', 'topper-pack'),
                'types' => ['classic', 'gradient', 'video'],
                'selector' => '{{WRAPPER}} .topppa-dote-pagination span',
                'fields_options' => [
                    'background' => [
                        'label' => esc_html__('Background', 'topper-pack'),
                        'default' => 'classic',
                    ],
                ],
            ]
        );
        $this->add_responsive_control(
            'dote_opacity',
            [
                'label' => esc_html__('Opacity', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1,
                        'step' => .1,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .topppa-dote-pagination span' => 'opacity: {{SIZE}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'dote_scale',
            [
                'label' => esc_html__('Border Scale', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'size' => 1,
                ],
                'selectors' => [
                    '{{WRAPPER}} .topppa-dote-pagination .swiper-pagination-bullet:after' => 'transform: translate(-50%, -50%) scale({{SIZE}});',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'dote_border',
                'label' => esc_html__('Border', 'topper-pack'),
                'selector' => '{{WRAPPER}} .topppa-dote-pagination .swiper-pagination-bullet:after',
            ]
        );
        $this->add_responsive_control(
            'dote_border_radius',
            [
                'label' => esc_html__('Border Radius', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .topppa-dote-pagination .swiper-pagination-bullet:after' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'active_styles',
            [
                'label' => esc_html__('Active Styles', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->add_responsive_control(
            'position_x',
            [
                'label' => esc_html__('Postition X', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'range' => [
                    'px' => [
                        'min' => -200,
                        'max' => 500,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .topppa-dote-pagination .swiper-pagination-bullet:after' => 'left: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'position_y',
            [
                'label' => esc_html__('Postition Y', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'range' => [
                    'px' => [
                        'min' => -200,
                        'max' => 500,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .topppa-dote-pagination .swiper-pagination-bullet:after' => 'top: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'active_dote_height',
            [
                'label' => esc_html__('Height', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'custom'],
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
                'default' => [
                    'unit' => 'px',
                ],
                'selectors' => [
                    '{{WRAPPER}} .swiper-pagination-bullets span.swiper-pagination-bullet-active' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'active_dote_width',
            [
                'label' => esc_html__('Width', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'custom'],
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
                'default' => [
                    'unit' => 'px',
                ],
                'selectors' => [
                    '{{WRAPPER}} .swiper-pagination-bullets span.swiper-pagination-bullet-active' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'active_dote_background',
                'label' => esc_html__('Background', 'topper-pack'),
                'types' => ['classic', 'gradient', 'video'],
                'selector' => '{{WRAPPER}} .topppa-dote-pagination .swiper-pagination-bullet-active',
                'fields_options' => [
                    'background' => [
                        'label' => esc_html__('Background', 'topper-pack'),
                        'default' => 'classic',
                    ],
                ],
            ]
        );
        $this->add_responsive_control(
            'dote_active_opacity',
            [
                'label' => esc_html__('Opacity', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1,
                        'step' => .1,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .topppa-dote-pagination .swiper-pagination-bullet-active' => 'opacity: {{SIZE}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'dote_ascale',
            [
                'label' => esc_html__('Border Scale', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'size' => 1,
                ],
                'selectors' => [
                    '{{WRAPPER}} .topppa-dote-pagination .swiper-pagination-bullet-active:after' => 'transform: translate(-50%, -50%) scale({{SIZE}});',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'active_dote_border',
                'label' => esc_html__('Border', 'topper-pack'),
                'selector' => '{{WRAPPER}} .topppa-dote-pagination .swiper-pagination-bullet-active:after',
            ]
        );
        $this->add_responsive_control(
            'active_dote_border_radius',
            [
                'label' => esc_html__('Border Radius', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .topppa-dote-pagination .swiper-pagination-bullet-active:after' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'dote_Margin',
            [
                'label' => esc_html__('Margin', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .topppa-dote-pagination' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'dote_padding',
            [
                'label' => esc_html__('Padding', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .topppa-dote-pagination' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();
    }



    protected function render() {
        $settings = $this->get_settings_for_display();
        $allowed_html = [
            'a' => ['href' => []],
            'br' => [],
            'em' => [],
            'strong' => [],
        ];
        $style_classes = [
            'style_one' => 'team-v1',
            'style_two' => 'team-v2',
            'style_three' => 'team-v3',
            'style_four' => 'team-v4',
            'style_five' => 'team-v5',
            'style_six' => 'team-v6',
            'style_seven' => 'team-v7',
            'style_eight' => 'team-v8',
            'style_nine' => 'team-v9',
            'style_ten' => 'team-v10',
            'style_eleven' => 'team-v11',
            'style_twelve' => 'team-v12',
            'style_thirteen' => 'team-v13',
            'style_fourteen' => 'team-v14',
            'style_fifteen' => 'team-v15',
            'style_sixteen' => 'team-v16',
        ];
        $animations = [
            'anim_one' => 'image-anim1',
            'anim_rotate' => 'image-anim1 v2',
            'anim_two' => 'image-anim2',
            'anim_three' => 'image-anim3'
        ];

        $class = isset($settings['topppa_content_select_styles']) && isset($style_classes[$settings['topppa_content_select_styles']])
            ? $style_classes[$settings['topppa_content_select_styles']]
            : '';
        $SliderId = wp_rand(31241, 63256); // phpcs:ignore WordPress.WP.AlternativeFunctions.rand_rand
        $column = $settings['xl_col'] . ' ' . $settings['lg_col'] . ' ' . $settings['desktop_col'];
        $args = array(
            'post_type' => $settings['post_type'],
            'posts_per_page' => $settings['posts_per_page'],
            'post_status' => 'publish'
        );
        $query = new \WP_Query($args);
?>
        <div class="topppa-team-v1-wrapper <?php echo esc_attr($class); ?>">
            <div class="swiper topppa-swiper-slider topppa-swiper-slider-<?php echo esc_attr($SliderId); ?>" <?php if ($settings['enable_slider'] === 'yes'): ?>
                data-slides-per-view="<?php echo esc_attr($settings['slide_show_lagrge_item']); ?>"
                data-space-between="<?php echo esc_attr($settings['slider_space_between']['size']); ?>"
                data-auto-loop="<?php echo esc_attr($settings['enable_slider_auto_loop']); ?>"
                data-slide-speed="<?php echo esc_attr($settings['slide_speed']); ?>"
                data-slider-speed="<?php echo esc_attr($settings['slider_speed']); ?>"
                data-enable-dote="<?php echo esc_attr($settings['enable_dote']); ?>"
                data-large-items="<?php echo esc_attr($settings['slide_show_lagrge_item']); ?>"
                data-tablet-items="<?php echo esc_attr($settings['slide_show_teblet_item']); ?>"
                data-mobile-items="<?php echo esc_attr($settings['slide_show_mobile_item']); ?>"
                data-extra-mobile-items="<?php echo esc_attr($settings['slide_show_extra_mobile_item']); ?>"
                data-enable-rtl="<?php echo esc_attr($settings['enable_rtl']); ?>" <?php endif; ?>>
                <div class="<?php echo esc_attr($settings['enable_slider'] === 'yes' ? 'swiper-wrapper' : 'row'); ?>">
                    <?php if ($settings['post_type'] === 'custom'): ?>
                        <?php foreach ($settings['repeater_list'] as $item): ?>
                            <div class="<?php echo esc_attr($settings['enable_slider'] === 'yes' ? 'swiper-slide' : $column); ?>">
                                <div class="topppa-team-v1-item">
                                    <div class="topppa-team-v1-img">
                                        <?php if (!in_array($settings['topppa_content_select_styles'], ['style_eight', 'style_ten'])): ?>
                                            <?php if (!empty($animations[$settings['post_img_anim']])): ?>
                                                <span
                                                    class="image-anim <?php echo esc_attr($animations[$settings['post_img_anim']]); ?>"></span>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                        <?php echo wp_get_attachment_image($item['team_image']['id'], 'full'); ?>
                                        <?php if ($settings['enable_socil_icons'] == 'yes'):  ?>
                                            <?php if (in_array($settings['topppa_content_select_styles'], ['style_five', 'style_six', 'style_eight', 'style_nine', 'style_ten', 'style_eleven', 'style_fourteen', 'style_sixteen'])): ?>
                                                <div class="topppa-team-v1-social-item">
                                                    <?php if (in_array($settings['topppa_content_select_styles'], ['style_eight', 'style_nine', 'style_ten', 'style_fourteen'])): ?>
                                                        <button class="team-v1-social-share"><i class="fas fa-plus"></i></button>
                                                    <?php endif ?>
                                                    <ul>
                                                        <?php foreach ($item['team_socials'] as $social): ?>
                                                            <li>
                                                                <a href="<?php echo esc_url($social['social_url']['url']); ?>" target="_blank"
                                                                    rel="noopener" class="team-v1-social-icon">
                                                                    <?php \Elementor\Icons_Manager::render_icon($social['social_icon'], ['aria-hidden' => 'true']); ?>
                                                                </a>
                                                            </li>
                                                        <?php endforeach; ?>
                                                    </ul>
                                                </div>
                                            <?php endif ?>
                                        <?php endif ?>
                                    </div>
                                    <div class="topppa-team-v1-content">
                                        <div class="topppa-team-v1-content-area">
                                            <div class="topppa-team-v1-content-wrap">
                                                <?php if (!empty($item['team_name'])): ?>
                                                    <<?php echo esc_attr($settings['html_tag']); ?> class="topppa-team-v1-title">
                                                        <?php echo esc_html($item['team_name']); ?>
                                                    </<?php echo esc_attr($settings['html_tag']); ?>>
                                                <?php endif; ?>
                                                <?php if (!empty($item['team_stitle'])): ?>
                                                    <div class="topppa-team-v1-stitle">
                                                        <?php echo esc_html($item['team_stitle']); ?>
                                                    </div>
                                                <?php endif; ?>
                                                <?php
                                                if ($item['show_description'] == 'yes'):
                                                    $show_description = isset($settings['show_description']) ? $settings['show_description'] : 'yes';
                                                    if (
                                                        in_array($settings['topppa_content_select_styles'], ['style_fourteen', 'style_fifteen']) &&
                                                        $show_description === 'yes'
                                                    ): ?>
                                                        <div class="topppa-team-v1-des">
                                                            <?php echo wp_kses($item['team_description'], $allowed_html); ?>
                                                        </div>
                                                    <?php endif; ?>
                                                <?php endif; ?>
                                            </div>
                                            <?php if (in_array($settings['topppa_content_select_styles'], ['style_one', 'style_two', 'style_three', 'style_four', 'style_seven', 'style_twelve', 'style_thirteen', 'style_fifteen'])): ?>
                                                <?php if ($settings['enable_socil_icons'] == 'yes'):  ?>
                                                    <div class="topppa-team-v1-social-item">
                                                        <?php if (in_array($settings['topppa_content_select_styles'], ['style_twelve', 'style_thirteen'])): ?>
                                                            <button class="team-v1-social-share"><i class="fas fa-plus"></i></button>
                                                        <?php endif ?>
                                                        <ul>
                                                            <?php foreach ($item['team_socials'] as $social): ?>
                                                                <li>
                                                                    <a href="<?php echo esc_url($social['social_url']['url']); ?>" target="_blank"
                                                                        rel="noopener" class="team-v1-social-icon">
                                                                        <?php \Elementor\Icons_Manager::render_icon($social['social_icon'], ['aria-hidden' => 'true']); ?>
                                                                    </a>
                                                                </li>
                                                            <?php endforeach; ?>
                                                        </ul>
                                                    </div>
                                                <?php endif ?>
                                            <?php endif ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <?php if ($query->have_posts()): ?>
                            <?php while ($query->have_posts()):
                                $query->the_post(); ?>
                                <div class="<?php echo esc_attr($settings['enable_slider'] === 'yes' ? 'swiper-slide' : $column); ?>">
                                    <div class="topppa-team-v1-item">
                                        <div class="topppa-team-v1-img">
                                            <?php if (!in_array($settings['topppa_content_select_styles'], ['style_eight', 'style_ten'])) {
                                                if (!empty($animations[$settings['post_img_anim']])) {
                                                    echo '<span class="image-anim ' . esc_attr($animations[$settings['post_img_anim']]) . '"></span>';
                                                }
                                            } ?>
                                            <?php if (has_post_thumbnail()) {
                                                the_post_thumbnail('full');
                                            } ?>
                                            <?php
                                            if (in_array($settings['topppa_content_select_styles'], ['style_five', 'style_six', 'style_eight', 'style_nine', 'style_ten', 'style_eleven', 'style_fourteen', 'style_sixteen'])) {
                                                if ('yes' === $settings['enable_cpt_social_icons'] && !empty($settings['cpt_social_meta_field'])) {
                                                    $meta_values = get_post_meta(get_the_ID(), 'topppa_cpt_post_meta', true);
                                                    $social_field_key = $settings['cpt_social_meta_field'];
                                                    echo '<div class="topppa-team-v1-social-item">';
                                                    if (in_array($settings['topppa_content_select_styles'], ['style_eight', 'style_nine', 'style_ten', 'style_fourteen'])) {
                                                        echo '<button class="team-v1-social-share"><i class="fas fa-plus"></i></button>';
                                                    }
                                                    echo '<ul>';
                                                    if (is_array($meta_values)) {
                                                        foreach ($meta_values as $meta_key => $meta_value) {
                                                            if (strpos($meta_key, $social_field_key) !== false && is_array($meta_value)) {
                                                                foreach ($meta_value as $social_group) {
                                                                    if (is_array($social_group)) {
                                                                        foreach ($social_group as $field_name => $field_data) {
                                                                            if (is_array($field_data) && isset($field_data['icon']) && !empty($field_data['icon'])) {
                                                                                $icon_class = $field_data['icon'];
                                                                                $icon_url = $field_data['icon_url'] ?? '#';

                                                                                echo '<li>';
                                                                                echo '<a href="' . esc_url($icon_url) . '" target="_blank" rel="noopener" class="team-v1-social-icon">';
                                                                                echo '<i class="' . esc_attr($icon_class) . '"></i>';
                                                                                echo '</a>';
                                                                                echo '</li>';
                                                                            }
                                                                        }
                                                                    }
                                                                }
                                                                break;
                                                            }
                                                        }
                                                    }
                                                    echo '</ul>';
                                                    echo '</div>';
                                                }
                                            }
                                            ?>
                                        </div>
                                        <div class="topppa-team-v1-content">
                                            <div class="topppa-team-v1-content-area">
                                                <div class="topppa-team-v1-content-wrap">
                                                    <?php
                                                    $meta_values = get_post_meta(get_the_ID(), 'topppa_cpt_post_meta', true);
                                                    ?>
                                                    <<?php echo esc_attr($settings['html_tag']); ?> class="topppa-team-v1-title">
                                                        <a href="<?php the_permalink(); ?>">
                                                            <?php echo wp_trim_words(get_the_title(), $settings['title_length']); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
                                                            ?>
                                                        </a>
                                                    </<?php echo esc_attr($settings['html_tag']); ?>>
                                                    <?php
                                                    if ('yes' === $settings['show_designation'] && 'custom' !== $settings['post_type']) {

                                                        $selected_field = $settings['cpt_meta_single_field'] ?? '';
                                                        $selected_field = trim($selected_field);
                                                        $invalid_values = ['', '0', 'null', 'undefined', 'select', 'none', 'select a meta field'];
                                                        if (!empty($selected_field) && !in_array(strtolower($selected_field), $invalid_values)) {
                                                            $available_fields = $this->get_all_cpt_meta_fields();

                                                            if (isset($available_fields[$selected_field])) {
                                                                $meta_values = get_post_meta(get_the_ID(), 'topppa_cpt_post_meta', true);
                                                                $field_value = '';

                                                                if (is_array($meta_values) && !empty($meta_values)) {

                                                                    // Check if this is a grouped field (contains '_field_')
                                                                    if (strpos($selected_field, '_field_') !== false) {
                                                                        $parts = explode('_field_', $selected_field);
                                                                        $group_id = $parts[0];
                                                                        $field_name = $parts[1];

                                                                        if (!empty($group_id) && !empty($field_name)) {
                                                                            foreach ($meta_values as $meta_key => $meta_value) {
                                                                                if (strpos($meta_key, $group_id) !== false && is_array($meta_value)) {
                                                                                    foreach ($meta_value as $group_data) {
                                                                                        if (is_array($group_data) && isset($group_data[$field_name])) {
                                                                                            $field_data = $group_data[$field_name];

                                                                                            if (is_array($field_data) && isset($field_data['field_value'])) {
                                                                                                $field_value = $field_data['field_value'];
                                                                                            } else {
                                                                                                $field_value = $field_data;
                                                                                            }
                                                                                            break 2;
                                                                                        }
                                                                                    }
                                                                                }
                                                                            }
                                                                        }
                                                                    } else {
                                                                        // Individual field
                                                                        foreach ($meta_values as $meta_key => $meta_value) {
                                                                            if (strpos($meta_key, $selected_field) !== false) {
                                                                                if (is_array($meta_value)) {
                                                                                    foreach ($meta_value as $index => $value) {
                                                                                        if (is_array($value) && isset($value['field_value'])) {
                                                                                            $potential_value = trim($value['field_value']);
                                                                                            if (!empty($potential_value) && !in_array(strtolower($potential_value), $invalid_values)) {
                                                                                                $field_value = $potential_value;
                                                                                                break;
                                                                                            }
                                                                                        } elseif (!is_array($value)) {
                                                                                            $potential_value = trim($value);
                                                                                            if (!empty($potential_value) && !in_array(strtolower($potential_value), $invalid_values)) {
                                                                                                $field_value = $potential_value;
                                                                                                break;
                                                                                            }
                                                                                        }
                                                                                    }
                                                                                } else {
                                                                                    $potential_value = trim($meta_value);
                                                                                    if (!empty($potential_value) && !in_array(strtolower($potential_value), $invalid_values)) {
                                                                                        $field_value = $potential_value;
                                                                                    }
                                                                                }
                                                                                break;
                                                                            }
                                                                        }
                                                                    }

                                                                    // Display the field value if found and valid
                                                                    if (!empty($field_value) && !is_array($field_value) && trim($field_value) !== '' && !in_array(strtolower(trim($field_value)), $invalid_values)) {
                                                                        echo "<div class='topppa-team-v1-stitle'>";
                                                                        echo esc_html(trim($field_value));
                                                                        echo "</div>";
                                                                    }
                                                                }
                                                            }
                                                        }
                                                    }
                                                    ?>
                                                    <?php if (in_array($settings['topppa_content_select_styles'], ['style_fourteen', 'style_fifteen'])): ?>
                                                        <?php if ($settings['enable_description'] == 'yes'): ?>
                                                            <div class="topppa-team-v1-des">
                                                                <?php echo wp_trim_words(get_the_excerpt(), $settings['description_lanth']); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
                                                                ?>
                                                            </div>
                                                        <?php endif ?>
                                                    <?php endif; ?>
                                                </div>
                                                <?php if (in_array($settings['topppa_content_select_styles'], ['style_one', 'style_two', 'style_three', 'style_four', 'style_seven', 'style_twelve', 'style_thirteen', 'style_fifteen'])) {
                                                    if ('yes' === $settings['enable_cpt_social_icons'] && !empty($settings['cpt_social_meta_field'])) {
                                                        $meta_values = get_post_meta(get_the_ID(), 'topppa_cpt_post_meta', true);
                                                        $social_field_key = $settings['cpt_social_meta_field'];

                                                        if (is_array($meta_values)) {
                                                            echo '<div class="topppa-team-v1-social-item">';
                                                            if (in_array($settings['topppa_content_select_styles'], haystack: ['style_twelve', 'style_thirteen'])) {
                                                                echo '<button class="team-v1-social-share"><i class="fas fa-plus"></i></button>';
                                                            }
                                                            echo '<ul>';
                                                            foreach ($meta_values as $meta_key => $meta_value) {
                                                                if (strpos($meta_key, $social_field_key) !== false && is_array($meta_value)) {
                                                                    foreach ($meta_value as $social_group) {
                                                                        if (is_array($social_group)) {
                                                                            foreach ($social_group as $field_name => $field_data) {
                                                                                if (is_array($field_data) && isset($field_data['icon']) && !empty($field_data['icon'])) {
                                                                                    $icon_class = $field_data['icon'];
                                                                                    $icon_url = $field_data['icon_url'] ?? '#';
                                                                                    echo '<li>';
                                                                                    echo '<a href="' . esc_url($icon_url) . '" target="_blank" rel="noopener" class="team-v1-social-icon">';
                                                                                    echo '<i class="' . esc_attr($icon_class) . '"></i>';
                                                                                    echo '</a>';
                                                                                    echo '</li>';
                                                                                }
                                                                            }
                                                                        }
                                                                    }
                                                                    break;
                                                                }
                                                            }
                                                            echo '</ul>';
                                                            echo '</div>';
                                                        }
                                                    }
                                                } ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endwhile; ?>
                            <?php wp_reset_postdata(); ?>
                        <?php endif; ?>
                    <?php endif; ?>
                </div>
            </div>
            <?php if ($settings['enable_dote'] === 'yes') { ?>
                <div
                    class="team-v1-pagination topppa-dote-pagination topppa-topppa-dote-pagination-<?php echo esc_attr($SliderId); ?>">
                </div>
            <?php } ?>
        </div>
<?php
    }
}
