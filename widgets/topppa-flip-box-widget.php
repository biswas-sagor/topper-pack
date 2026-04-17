<?php
/**
 * Elementor topppa Flip Box Widget.
 *
 * @package TopperPack
 * @since 1.0.0
 */

use TopperPack\Trait_Loader\Global_Component_Loader;
use \TopperPack\Includes\Controls\Controls_Manager as TopperPack_Controls_Manager;
use \TopperPack\Includes\Utilities;

if (! defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

/**
 * Class TOPPPA_Flip_Box_Widget
 *
 * @package TopperPack
 * @since 1.0.0
 */
class TOPPPA_Flip_Box_Widget extends \Elementor\Widget_Base {

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
        return 'topppa_flip_box';
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
        return TOPPPA_EPWB . esc_html__('Flip Box', 'topper-pack');
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
        return 'eicon-flip-box';
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
        return ['topppa', 'widget', 'flip', 'box', 'topperpack'];
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
        return 'https://doc.topperpack.com/docs/general-widgets/flip-box/';
    }


    public function topppa_flip_action_type() {
        $this->add_control(
            'choose_type',
            [
                'label' => esc_html__('Choose Type', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'hover' => [
                        'title' => esc_html__('Hover', 'topper-pack'),
                        'icon' => 'eicon-button',
                    ],
                    'pro_type' => [
                        'title' => esc_html__('Click (Pro)', 'topper-pack'),
                        'icon' => 'eicon-click',
                    ],
                ],
                'default' => 'hover',
                'toggle' => true,
            ]
        );
        Utilities::upgrade_pro_notice( 
            $this, 
            \Elementor\Controls_Manager::RAW_HTML, 
            'topppa_flip_box',
            'choose_type',
            ['pro_type']
        );
    }

    public function topppa_flip_animation() {
        $this->add_control(
            'flip_animation',
            [
                'label' => esc_html__('Flip Animation', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    'flip' => esc_html__('Flip Horizontal', 'topper-pack'),
                    'flip-vertical' => esc_html__('Flip Vertical', 'topper-pack'),
                    'slide-left' => esc_html__('Slide Left', 'topper-pack'),
                    'slide-right' => esc_html__('Slide Right', 'topper-pack'),
                    'slide-up' => esc_html__('Slide Up', 'topper-pack'),
                    'slide-down' => esc_html__('Slide Down', 'topper-pack'),
                    'zoom-in' => esc_html__('Zoom In', 'topper-pack'),
                    'zoom-out' => esc_html__('Zoom Out', 'topper-pack'),
                    'fade' => esc_html__('Fade', 'topper-pack'),
                    'pro_rotate_x' => esc_html__('Rotate X (Pro)', 'topper-pack'),
                    'pro_rotate_y' => esc_html__('Rotate Y (Pro)', 'topper-pack'),
                    'pro_rotate_z' => esc_html__('Rotate Z (Pro)', 'topper-pack'),
                    'pro_tilt' => esc_html__('Tilt (Pro)', 'topper-pack'),
                    'pro_page_turn' => esc_html__('Page Turn (Pro)', 'topper-pack'),
                    'pro_morph' => esc_html__('Morphing Shape (Pro)', 'topper-pack'),
                    'pro_elastic' => esc_html__('Elastic Reveal (Pro)', 'topper-pack'),
                    'pro_shatter' => esc_html__('Shatter Effect (Pro)', 'topper-pack'),
                    'pro_origami' => esc_html__('Origami Fold (Pro)', 'topper-pack'),
                    'pro_door' => esc_html__('Door Open (Pro)', 'topper-pack'),
                    'pro_celestial_swirl' => esc_html__('Celestial Swirl (Pro)', 'topper-pack'),
                    'pro_gravity_bounce' => esc_html__('Gravity Bounce (Pro)', 'topper-pack'),
                    'pro_hyperwave_flow' => esc_html__('Hyperwave Flow (Pro)', 'topper-pack'),
                    'pro_3d_prism' => esc_html__('3D Prism (Pro)', 'topper-pack'),
                    'pro_3d_cylinder' => esc_html__('3D Cylinder (Pro)', 'topper-pack'),
                    'pro_3d_cascade' => esc_html__('3D Cascade (Pro)', 'topper-pack'),
                    'pro_3d_helix' => esc_html__('3D Helix (Pro)', 'topper-pack'),
                    'pro_3d_pyramid' => esc_html__('3D Pyramid (Pro)', 'topper-pack'),
                    'pro_3d_carousel' => esc_html__('3D Carousel (Pro)', 'topper-pack'),
                    'pro_3d_accordion' => esc_html__('3D Accordion (Pro)', 'topper-pack'),
                ],
                'default' => 'flip',
            ]
        );
        Utilities::upgrade_pro_notice( 
            $this, 
            \Elementor\Controls_Manager::RAW_HTML, 
            'topppa_flip_box',
            'flip_animation',
            ['pro_rotate_x', 'pro_rotate_y', 'pro_rotate_z', 'pro_tilt', 'pro_page_turn', 'pro_morph', 'pro_elastic', 'pro_shatter', 'pro_origami', 'pro_door', 'pro_celestial_swirl', 'pro_gravity_bounce', 'pro_hyperwave_flow', 'pro_3d_prism', 'pro_3d_cylinder', 'pro_3d_cascade', 'pro_3d_helix', 'pro_3d_pyramid', 'pro_3d_carousel', 'pro_3d_accordion']
        );
    }

    public function topppa_flip_box_link_control() {
        $this->add_control(
            'select_link',
            [
                'label' => esc_html__('Select Link', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'none',
                'options' => [
                    'none' => esc_html__('None', 'topper-pack'),
                    'pro_link'  => esc_html__('Box Link (Pro)', 'topper-pack'),
                    'title_link' => esc_html__('Title Link', 'topper-pack'),
                ],
            ]
        );
        Utilities::upgrade_pro_notice( 
            $this, 
            \Elementor\Controls_Manager::RAW_HTML, 
            'topppa_flip_box',
            'select_link',
            ['pro_link']
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
        /**
         * start content section
         *
         * @since 1.0.0
         * @access protected
         */
        $this->start_controls_section(
            'content_section',
            [
                'label' => esc_html__('Content Options', 'topper-pack'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );
        
        $this->topppa_get_global_button_effects_controls();

        $this->topppa_flip_action_type();
        $this->topppa_flip_animation();

        /**
         * start content tab
         *
         * @since 1.0.0
         * @access protected
         */
        $this->start_controls_tabs(
            'content_tabs'
        );
        /**
         * start front tab
         *
         * @since 1.0.0
         * @access protected
         */
        $this->start_controls_tab(
            'content_front_tab',
            [
                'label' => esc_html__('Front', 'topper-pack'),
            ]
        );
        $this->add_control(
            'front_content_type',
            [
                'label' => esc_html__('Content Type', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'content',
                'options' => [
                    'content' => esc_html__('Content', 'topper-pack'),
                    'elementor' => esc_html__('Saved Template', 'topper-pack'),
                ],
            ]
        );
        $this->add_control(
            'front_template_id',
            [
                'label'     => __('Content Template', 'topper-pack'),
                'type'      => \Elementor\Controls_Manager::SELECT,
                'default'   => '0',
                'options'   => $this->topppa_elementor_template(),
                'condition' => [
                    'front_content_type' => "elementor"
                ],
                'separator' => 'before',
            ]
        );
        $this->add_control(
            'front_icon_type',
            [
                'label' => esc_html__('Icon Type', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'icon',
                'options' => [
                    '' => esc_html__('None', 'topper-pack'),
                    'icon' => esc_html__('Icon', 'topper-pack'),
                    'image' => esc_html__('Image', 'topper-pack'),
                ],
                'condition' => [
                    'front_content_type' => 'content',
                ],
            ]
        );
        $this->add_control(
            'front_image',
            [
                'label' => esc_html__('Choose Image', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'condition' => [
                    'front_content_type' => 'content',
                    'front_icon_type' => 'image',
                ],
            ]
        );
        $this->add_control(
            'front_icon',
            [
                'label' => esc_html__('Icon', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::ICONS,
                'default' => [
                    'value' => 'fas fa-circle',
                    'library' => 'fa-solid',
                ],
                'recommended' => [
                    'fa-solid' => [
                        'circle',
                        'dot-circle',
                        'square-full',
                    ],
                    'fa-regular' => [
                        'circle',
                        'dot-circle',
                        'square-full',
                    ],
                ],
                'condition' => [
                    'front_content_type' => 'content',
                    'front_icon_type' => 'icon',
                ],
            ]
        );
        $this->add_control(
            'front_title',
            [
                'label' => esc_html__('Title', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Front End Title here', 'topper-pack'),
                'label_block' => true,
                'condition' => [
                    'front_content_type' => 'content',
                ],
            ]
        );
        $this->add_control(
            'front_title_tag',
            [
                'label' => esc_html__('Title HTML Tag', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    'h1' => esc_html__('H1', 'topper-pack'),
                    'h2' => esc_html__('H2', 'topper-pack'),
                    'h3' => esc_html__('H3', 'topper-pack'),
                    'h4' => esc_html__('H4', 'topper-pack'),
                    'h5' => esc_html__('H5', 'topper-pack'),
                    'h6' => esc_html__('H6', 'topper-pack'),
                ],
                'default' => 'h2',
                'condition' => [
                    'front_content_type' => 'content',
                ],
            ]
        );
        $this->add_control(
            'front_description',
            [
                'label' => esc_html__('Description', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::WYSIWYG,
                'default' => esc_html__('Front End Description here', 'topper-pack'),
                'condition' => [
                    'front_content_type' => 'content',
                ],
            ]
        );
        $this->add_control(
            'front_button_enable',
            [
                'label' => esc_html__('Button Enable', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', 'topper-pack'),
                'label_off' => esc_html__('Hide', 'topper-pack'),
                'return_value' => 'yes',
                'default' => 'yes',
                'condition' => [
                    'front_content_type' => 'content',
                ],
            ]
        );
        $this->add_control(
            'front_button_text',
            [
                'label' => esc_html__('Button Text', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Read More', 'topper-pack'),
                'condition' => [
                    'front_button_enable' => 'yes',
                    'front_content_type' => 'content',
                ],
            ]
        );
        $this->add_control(
            'front_button_url',
            [
                'label' => esc_html__('Link', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::URL,
                'placeholder' => esc_html__('https://your-link.com', 'topper-pack'),
                'options' => ['url', 'is_external', 'nofollow'],
                'default' => [
                    'url' => '',
                    'is_external' => true,
                    'nofollow' => true,
                    // 'custom_attributes' => '',
                ],
                'condition' => [
                    'front_button_enable' => 'yes',
                    'front_content_type' => 'content',
                ],
                'label_block' => true,
            ]
        );
        $this->end_controls_tab();

        /**
         * start back tab
         *
         * @since 1.0.0
         * @access protected
         */
        $this->start_controls_tab(
            'content_back_tab',
            [
                'label' => esc_html__('Back', 'topper-pack'),
            ]
        );
        $this->add_control(
            'back_content_type',
            [
                'label' => esc_html__('Content Type', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'content',
                'options' => [
                    'content' => esc_html__('Content', 'topper-pack'),
                    'elementor' => esc_html__('Saved Template', 'topper-pack'),
                ],
            ]
        );
        $this->add_control(
            'back_template_id',
            [
                'label'     => __('Content Template', 'topper-pack'),
                'type'      => \Elementor\Controls_Manager::SELECT,
                'default'   => '0',
                'options'   => $this->topppa_elementor_template(),
                'condition' => [
                    'back_content_type' => "elementor"
                ],
                'separator' => 'before',
            ]
        );
        $this->add_control(
            'back_icon_type',
            [
                'label' => esc_html__('Icon Type', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'icon',
                'options' => [
                    '' => esc_html__('None', 'topper-pack'),
                    'icon' => esc_html__('Icon', 'topper-pack'),
                    'image' => esc_html__('Image', 'topper-pack'),
                ],
                'condition' => [
                    'back_content_type' => 'content',
                ],
            ]
        );
        $this->add_control(
            'back_image',
            [
                'label' => esc_html__('Choose Image', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'condition' => [
                    'back_content_type' => 'content',
                    'back_icon_type' => 'image',
                ],
            ]
        );
        $this->add_control(
            'back_icon',
            [
                'label' => esc_html__('Icon', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::ICONS,
                'default' => [
                    'value' => 'fas fa-circle',
                    'library' => 'fa-solid',
                ],
                'recommended' => [
                    'fa-solid' => [
                        'circle',
                        'dot-circle',
                        'square-full',
                    ],
                    'fa-regular' => [
                        'circle',
                        'dot-circle',
                        'square-full',
                    ],
                ],
                'condition' => [
                    'back_content_type' => 'content',
                    'back_icon_type' => 'icon',
                ],
            ]
        );
        $this->add_control(
            'back_title',
            [
                'label' => esc_html__('Title', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Back End Title here', 'topper-pack'),
                'label_block' => true,
                'condition' => [
                    'back_content_type' => 'content',
                ],
            ]
        );
        $this->add_control(
            'back_title_tag',
            [
                'label' => esc_html__('Title HTML Tag', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    'h1' => esc_html__('H1', 'topper-pack'),
                    'h2' => esc_html__('H2', 'topper-pack'),
                    'h3' => esc_html__('H3', 'topper-pack'),
                    'h4' => esc_html__('H4', 'topper-pack'),
                    'h5' => esc_html__('H5', 'topper-pack'),
                    'h6' => esc_html__('H6', 'topper-pack'),
                ],
                'default' => 'h2',
                'condition' => [
                    'back_content_type' => 'content',
                ],
            ]
        );
        $this->add_control(
            'back_description',
            [
                'label' => esc_html__('Description', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::WYSIWYG,
                'default' => esc_html__('Back End Description here', 'topper-pack'),
                'condition' => [
                    'back_content_type' => 'content',
                ],
            ]
        );
        $this->add_control(
            'back_button_enable',
            [
                'label' => esc_html__('Button Enable', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', 'topper-pack'),
                'label_off' => esc_html__('Hide', 'topper-pack'),
                'return_value' => 'yes',
                'default' => 'yes',
                'condition' => [
                    'back_content_type' => 'content',
                ],
            ]
        );
        $this->add_control(
            'back_button_text',
            [
                'label' => esc_html__('Button Text', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Read More', 'topper-pack'),
                'condition' => [
                    'back_button_enable' => 'yes',
                    'back_content_type' => 'content',
                ],
            ]
        );
        $this->add_control(
            'back_button_url',
            [
                'label' => esc_html__('Link', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::URL,
                'placeholder' => esc_html__('https://your-link.com', 'topper-pack'),
                'options' => ['url', 'is_external', 'nofollow'],
                'default' => [
                    'url' => '',
                    'is_external' => true,
                    'nofollow' => true,
                    // 'custom_attributes' => '',
                ],
                'condition' => [
                    'back_button_enable' => 'yes',
                    'back_content_type' => 'content',
                ],
                'label_block' => true,
            ]
        );
        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

        /**
         * start style section
         *
         * @since 1.0.0
         * @access protected
         */
        $this->start_controls_section(
            'link_section',
            [
                'label' => esc_html__('Link', 'topper-pack'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->topppa_flip_box_link_control();
        
        $this->add_control(
            'links',
            [
                'label' => esc_html__('Link', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::URL,
                'placeholder' => esc_html__('https://your-link.com', 'topper-pack'),
                'options' => ['url', 'is_external', 'nofollow'],
                'default' => [
                    'url' => '',
                    'is_external' => true,
                    'nofollow' => true,
                ],
                'label_block' => true,
                'condition' => [
                    'select_link' => ['box_link', 'title_link'],
                ],
            ]
        );
        $this->end_controls_section();

        /**
         * start Front Style section
         *
         * @since 1.0.0
         * @access protected
         */
        $this->start_controls_section(
            'layout_style_section',
            [
                'label' => esc_html__('Layout Style', 'topper-pack'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_responsive_control(
            'flip_height',
            [
                'label' => esc_html__('Height', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                        'step' => 5,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .topppa-flip-box' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'radius',
            [
                'label' => esc_html__('Radius', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} .topppa-flip-box' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .topppa-flip-box-front' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .topppa-flip-box-back' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'front_padding',
            [
                'label' => esc_html__('Padding', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} .topppa-flip-box .topppa-flip-box-items' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'box_shadow',
                'selector' => '{{WRAPPER}} .topppa-flip-box',
            ]
        );
        $this->start_controls_tabs(
            'layout_style_tabs'
        );
        $this->start_controls_tab(
            'layout_style_front_tab',
            [
                'label' => esc_html__('Front Layout', 'topper-pack'),
            ]
        );
        $this->add_responsive_control(
            'front_justify_content',
            [
                'label' => esc_html__('Justify Content', 'topper-pack'),
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
                'default' => 'center',
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .topppa-flip-box .topppa-flip-box-front' => 'justify-content: {{VALUE}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'front_align_items',
            [
                'label' => esc_html__('Align Items', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'flex-start' => [
                        'title' => esc_html__('Top', 'topper-pack'),
                        'icon' => 'eicon-v-align-top',
                    ],
                    'center' => [
                        'title' => esc_html__('Center', 'topper-pack'),
                        'icon' => 'eicon-v-align-middle',
                    ],
                    'flex-end' => [
                        'title' => esc_html__('Bottom', 'topper-pack'),
                        'icon' => 'eicon-v-align-bottom',
                    ],
                ],
                'default' => 'center',
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .topppa-flip-box .topppa-flip-box-front' => 'align-items: {{VALUE}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'front_text_align',
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
                'default' => 'center',
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .topppa-flip-box .topppa-flip-box-front' => 'text-align: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'front_background',
                'types' => ['classic', 'gradient', 'video'],
                'selector' => '{{WRAPPER}} .topppa-flip-box .topppa-flip-box-front',
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'front_border',
                'label' => esc_html__('Border', 'topper-pack'),
                'selector' => '{{WRAPPER}} .topppa-flip-box .topppa-flip-box-front',
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'front_box_shadow',
                'selector' => '{{WRAPPER}} .topppa-flip-box .topppa-flip-box-front',
            ]
        );

        $this->add_control(
            'front_overlay_note',
            [
                'label' => esc_html__('Overlay Options', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'front_overlay_background',
                'types' => ['classic', 'gradient', 'video'],
                'selector' => '{{WRAPPER}} .topppa-flip-box .topppa-flip-box-front .topppa-front-overlay',
            ]
        );
        $this->add_responsive_control(
            'front_overlay_blend_mode',
            [
                'label' => esc_html__('Blend Mode', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'normal',
                'options' => [
                    'normal' => esc_html__('Normal', 'topper-pack'),
                    'multiply'  => esc_html__('Multiply', 'topper-pack'),
                    'screen' => esc_html__('Screen', 'topper-pack'),
                    'overlay' => esc_html__('Overlay', 'topper-pack'),
                    'darken' => esc_html__('Darken', 'topper-pack'),
                    'lighten' => esc_html__('Lighten', 'topper-pack'),
                    'color-dodge' => esc_html__('Color Dodge', 'topper-pack'),
                    'color-burn' => esc_html__('Color Burn', 'topper-pack'),
                    'hard-light' => esc_html__('Hard Light', 'topper-pack'),
                    'soft-light' => esc_html__('Soft Light', 'topper-pack'),
                    'difference' => esc_html__('Difference', 'topper-pack'),
                    'exclusion' => esc_html__('Exclusion', 'topper-pack'),
                    'hue' => esc_html__('Hue', 'topper-pack'),
                    'saturation' => esc_html__('Saturation', 'topper-pack'),
                    'color' => esc_html__('Color', 'topper-pack'),
                    'luminosity' => esc_html__('Luminosity', 'topper-pack'),
                ],
                'selectors' => [
                    '{{WRAPPER}} .topppa-flip-box .topppa-flip-box-front .topppa-front-overlay' => 'mix-blend-mode: {{VALUE}};',
                ],
            ]
        );
        $this->end_controls_tab();

        $this->start_controls_tab(
            'layout_style_back_tab',
            [
                'label' => esc_html__('Back Layout', 'topper-pack'),
            ]
        );

        $this->add_responsive_control(
            'back_justify_content',
            [
                'label' => esc_html__('Justify Content', 'topper-pack'),
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
                'default' => 'center',
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .topppa-flip-box .topppa-flip-box-back' => 'justify-content: {{VALUE}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'back_align_items',
            [
                'label' => esc_html__('Align Items', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'flex-start' => [
                        'title' => esc_html__('Top', 'topper-pack'),
                        'icon' => 'eicon-v-align-top',
                    ],
                    'center' => [
                        'title' => esc_html__('Center', 'topper-pack'),
                        'icon' => 'eicon-v-align-middle',
                    ],
                    'flex-end' => [
                        'title' => esc_html__('Bottom', 'topper-pack'),
                        'icon' => 'eicon-v-align-bottom',
                    ],
                ],
                'default' => 'center',
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .topppa-flip-box .topppa-flip-box-back' => 'align-items: {{VALUE}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'back_text_align',
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
                'default' => 'center',
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .topppa-flip-box .topppa-flip-box-back' => 'text-align: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'back_background',
                'types' => ['classic', 'gradient', 'video'],
                'selector' => '{{WRAPPER}} .topppa-flip-box .topppa-flip-box-back',
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'back_border',
                'label' => esc_html__('Border', 'topper-pack'),
                'selector' => '{{WRAPPER}} .topppa-flip-box .topppa-flip-box-back',
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'back_box_shadow',
                'selector' => '{{WRAPPER}} .topppa-flip-box .topppa-flip-box-back',
            ]
        );

        $this->add_control(
            'back_overlay_note',
            [
                'label' => esc_html__('Overlay Options', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'back_overlay_background',
                'types' => ['classic', 'gradient', 'video'],
                'selector' => '{{WRAPPER}} .topppa-flip-box .topppa-flip-box-back .topppa-back-overlay',
            ]
        );
        $this->add_responsive_control(
            'back_overlay_blend_mode',
            [
                'label' => esc_html__('Blend Mode', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'normal',
                'options' => [
                    'normal' => esc_html__('Normal', 'topper-pack'),
                    'multiply'  => esc_html__('Multiply', 'topper-pack'),
                    'screen' => esc_html__('Screen', 'topper-pack'),
                    'overlay' => esc_html__('Overlay', 'topper-pack'),
                    'darken' => esc_html__('Darken', 'topper-pack'),
                    'lighten' => esc_html__('Lighten', 'topper-pack'),
                    'color-dodge' => esc_html__('Color Dodge', 'topper-pack'),
                    'color-burn' => esc_html__('Color Burn', 'topper-pack'),
                    'hard-light' => esc_html__('Hard Light', 'topper-pack'),
                    'soft-light' => esc_html__('Soft Light', 'topper-pack'),
                    'difference' => esc_html__('Difference', 'topper-pack'),
                    'exclusion' => esc_html__('Exclusion', 'topper-pack'),
                    'hue' => esc_html__('Hue', 'topper-pack'),
                    'saturation' => esc_html__('Saturation', 'topper-pack'),
                    'color' => esc_html__('Color', 'topper-pack'),
                    'luminosity' => esc_html__('Luminosity', 'topper-pack'),
                ],
                'selectors' => [
                    '{{WRAPPER}} .topppa-flip-box .topppa-flip-box-back .topppa-back-overlay' => 'mix-blend-mode: {{VALUE}};',
                ],
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();

        /**
         * start Front Style section
         *
         * @since 1.0.0
         * @access protected
         */

        $this->start_controls_section(
            'front_style_section',
            [
                'label' => esc_html__('Front Content Style', 'topper-pack'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->start_controls_tabs(
            'front_style_tabs'
        );
        $this->start_controls_tab(
            'front_style_title_tab',
            [
                'label' => esc_html__('Title', 'topper-pack'),
            ]
        );
        $this->add_responsive_control(
            'front_title_color',
            [
                'label' => esc_html__('Text Color', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .topppa-flip-box .topppa-flip-box-front .topppa-flip-title .topppa-flip-front-box-title-text' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .topppa-flip-box .topppa-flip-box-front .topppa-flip-title .topppa-flip-front-box-title-text a' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_responsive_control(
            'front_title_link_color',
            [
                'label' => esc_html__('Hover Color', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .topppa-flip-box .topppa-flip-box-front .topppa-flip-title .topppa-flip-front-box-title-text a:hover' => 'color: {{VALUE}}',
                ],
                'description' => esc_html__('This color will be applied to the link when it is hovered.', 'topper-pack'),
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'front_title_typography',
                'selector' => '{{WRAPPER}} .topppa-flip-box .topppa-flip-box-front .topppa-flip-title .topppa-flip-front-box-title-text',
            ]
        );
        $this->add_responsive_control(
            'front_title_margin',
            [
                'label' => esc_html__('Margin', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} .topppa-flip-box .topppa-flip-box-front .topppa-flip-title .topppa-flip-front-box-title-text' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'front_title_padding',
            [
                'label' => esc_html__('Padding', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} .topppa-flip-box .topppa-flip-box-front .topppa-flip-title .topppa-flip-front-box-title-text' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_tab();

        $this->start_controls_tab(
            'front_style_description_tab',
            [
                'label' => esc_html__('Description', 'topper-pack'),
            ]
        );
        $this->add_responsive_control(
            'front_description_color',
            [
                'label' => esc_html__('Text Color', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .topppa-flip-box .topppa-flip-box-front .topppa-flip-description,{{WRAPPER}} .topppa-flip-box .topppa-flip-box-front .topppa-flip-description p' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'front_description_typography',
                'selector' => '{{WRAPPER}} .topppa-flip-box .topppa-flip-box-front .topppa-flip-description,{{WRAPPER}} .topppa-flip-box .topppa-flip-box-front .topppa-flip-description p',
            ]
        );
        $this->add_responsive_control(
            'front_description_margin',
            [
                'label' => esc_html__('Margin', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} .topppa-flip-box .topppa-flip-box-front .topppa-flip-description' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'front_description_padding',
            [
                'label' => esc_html__('Padding', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} .topppa-flip-box .topppa-flip-box-front .topppa-flip-description' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_tab();
        $this->start_controls_tab(
            'front_style_icon_tab',
            [
                'label' => esc_html__('Icon', 'topper-pack'),
                'condition' => [
                    'front_icon_type' => 'icon',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'front_icon_size',
                'selector' => '{{WRAPPER}} .topppa-flip-box .topppa-flip-box-front .topppa-flip-box-icon',

            ]
        );
        $this->add_responsive_control(
            'front_icon_color',
            [
                'label' => esc_html__('Text Color', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .topppa-flip-box .topppa-flip-box-front .topppa-flip-box-icon' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .topppa-flip-box .topppa-flip-box-front .topppa-flip-box-icon svg path' => 'fill: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'front_icon_background',
                'types' => ['classic', 'gradient', 'video'],
                'selector' => '{{WRAPPER}} .topppa-flip-box .topppa-flip-box-front .topppa-flip-box-icon',
            ]
        );
        $this->add_responsive_control(
            'front_icon_width',
            [
                'label' => esc_html__('Box Width', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                        'step' => 5,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .topppa-flip-box .topppa-flip-box-front .topppa-flip-box-icon' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'front_icon_height',
            [
                'label' => esc_html__('Height', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                        'step' => 5,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .topppa-flip-box .topppa-flip-box-front .topppa-flip-box-icon' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'front_icon_border',
                'selector' => '{{WRAPPER}} .topppa-flip-box .topppa-flip-box-front .topppa-flip-box-icon',
            ]
        );
        $this->add_responsive_control(
            'front_icon_radius',
            [
                'label' => esc_html__('Radius', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} .topppa-flip-box .topppa-flip-box-front .topppa-flip-box-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'front_icon_box_shadow',
                'selector' => '{{WRAPPER}} .topppa-flip-box .topppa-flip-box-front .topppa-flip-box-icon',

            ]
        );
        $this->add_responsive_control(
            'front_icon_margin',
            [
                'label' => esc_html__('Margin', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} .topppa-flip-box .topppa-flip-box-front .topppa-flip-box-icon' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'front_icon_padding',
            [
                'label' => esc_html__('Padding', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} .topppa-flip-box .topppa-flip-box-front .topppa-flip-box-icon' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_tab();

        $this->start_controls_tab(
            'front_style_image_tab',
            [
                'label' => esc_html__('Image', 'topper-pack'),
                'condition' => [
                    'front_icon_type' => 'image',
                ],

            ]
        );
        $this->add_responsive_control(
            'front_image_max_width',
            [
                'label' => esc_html__('Max Width', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 600,
                        'step' => 5,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .topppa-flip-box .topppa-flip-box-front .topppa-flip-box-icon img' => 'max-width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'front_image_width',
            [
                'label' => esc_html__('Width', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 600,
                        'step' => 5,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .topppa-flip-box .topppa-flip-box-front .topppa-flip-box-icon img' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'front_image_height',
            [
                'label' => esc_html__('Height', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 600,
                        'step' => 5,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .topppa-flip-box .topppa-flip-box-front .topppa-flip-box-icon img' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'front_image_border',
                'selector' => '{{WRAPPER}} .topppa-flip-box .topppa-flip-box-front .topppa-flip-box-icon img',
            ]
        );
        $this->add_responsive_control(
            'front_image_radius',
            [
                'label' => esc_html__('Radius', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} .topppa-flip-box .topppa-flip-box-front .topppa-flip-box-icon img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'front_image_box_shadow',
                'selector' => '{{WRAPPER}} .topppa-flip-box .topppa-flip-box-front .topppa-flip-box-icon img',

            ]
        );
        $this->add_responsive_control(
            'front_image_margin',
            [
                'label' => esc_html__('Margin', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} .topppa-flip-box .topppa-flip-box-front .topppa-flip-box-icon' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'front_image_padding',
            [
                'label' => esc_html__('Padding', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} .topppa-flip-box .topppa-flip-box-front .topppa-flip-box-icon' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_tab();


        $this->start_controls_tab(
            'front_style_button_tab',
            [
                'label' => esc_html__('Button', 'topper-pack'),
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'front_button_typography',
                'selector' => '{{WRAPPER}} .topppa-flip-box-front .topppa-flip-btn-wrapper .topppa-btn',
            ]
        );
        $this->add_responsive_control(
            'front_button_color',
            [
                'label' => esc_html__('Color', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .topppa-flip-box-front .topppa-flip-btn-wrapper .topppa-btn' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'front_button_background',
                'types' => ['classic', 'gradient', 'video'],
                'selector' => '{{WRAPPER}} .topppa-flip-box-front .topppa-flip-btn-wrapper .topppa-btn',
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'front_button_border',
                'selector' => '{{WRAPPER}} .topppa-flip-box-front .topppa-flip-btn-wrapper .topppa-btn',
            ]
        );
        $this->add_responsive_control(
            'front_button_radius',
            [
                'label' => esc_html__('Radius', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} .topppa-flip-box-front .topppa-flip-btn-wrapper .topppa-btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'front_button_box_shadow',
                'selector' => '{{WRAPPER}} .topppa-flip-box-front .topppa-flip-btn-wrapper .topppa-btn',
            ]
        );
        $this->add_responsive_control(
            'front_button_padding',
            [
                'label' => esc_html__('Padding', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} .topppa-flip-box-front .topppa-flip-btn-wrapper .topppa-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'front_button_options_note',
            [
                'label' => esc_html__('Hover Options', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_responsive_control(
            'front_button_hover_color',
            [
                'label' => esc_html__('Color', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .topppa-flip-box-front .topppa-flip-btn-wrapper .topppa-btn:hover' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .topppa-flip-box-front .topppa-flip-btn-wrapper .topppa-btn:hover span' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'front_button_hover_background',
                'types' => ['classic', 'gradient', 'video'],
                'selector' => '{{WRAPPER}} .topppa-flip-box-front .topppa-flip-btn-wrapper .topppa-btn:hover',
                'condition' => [
                    'topppa_btn_styles' => ['style_three', 'style_six', 'style_seven']
                ]
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'front_button_hover_background2',
                'types' => ['classic', 'gradient', 'video'],
                'selector' => '{{WRAPPER}} .topppa-flip-box-front .topppa-flip-btn-wrapper .topppa-btn::before,{{WRAPPER}} .topppa-flip-box-front .topppa-flip-btn-wrapper .topppa-btn::after ',
                'condition' => [
                    'topppa_btn_styles!' => ['style_three', 'style_six', 'style_seven', 'style_twelve'],
                ]
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'front_button_hover_border',
                'selector' => '{{WRAPPER}} .topppa-flip-box-front .topppa-flip-btn-wrapper .topppa-btn:hover',
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'front_button_hover_box_shadow',
                'selector' => '{{WRAPPER}} .topppa-flip-box-front .topppa-flip-btn-wrapper .topppa-btn:hover',
            ]
        );
        $this->add_responsive_control(
            'front_button_hover_radius',
            [
                'label' => esc_html__('Radius', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} .topppa-flip-box-front .topppa-flip-btn-wrapper .topppa-btn:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();
        $this->end_controls_section();

        /**
         * start Front Style section
         *
         * @since 1.0.0
         * @access protected
         */
        $this->start_controls_section(
            'back_style_section',
            [
                'label' => esc_html__('Back Content Style', 'topper-pack'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->start_controls_tabs(
            'back_style_tabs'
        );

        $this->start_controls_tab(
            'back_style_title_tab',
            [
                'label' => esc_html__('Title', 'topper-pack'),
            ]
        );
        $this->add_responsive_control(
            'back_title_color',
            [
                'label' => esc_html__('Text Color', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .topppa-flip-box .topppa-flip-box-back .topppa-flip-title .topppa-flip-back-box-title-text' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .topppa-flip-box .topppa-flip-box-back .topppa-flip-title .topppa-flip-back-box-title-text a' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_responsive_control(
            'back_title_link_color',
            [
                'label' => esc_html__('Hover Color', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .topppa-flip-box .topppa-flip-box-back .topppa-flip-title .topppa-flip-back-box-title-text a:hover' => 'color: {{VALUE}}',
                ],
                'description' => esc_html__('This color will be applied to the link when it is hovered.', 'topper-pack'),
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'back_title_typography',
                'selector' => '{{WRAPPER}} .topppa-flip-box .topppa-flip-box-back .topppa-flip-title .topppa-flip-back-box-title-text',
            ]
        );
        $this->add_responsive_control(
            'back_title_margin',
            [
                'label' => esc_html__('Margin', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} .topppa-flip-box .topppa-flip-box-back .topppa-flip-title .topppa-flip-back-box-title-text' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'back_title_padding',
            [
                'label' => esc_html__('Padding', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} .topppa-flip-box .topppa-flip-box-back .topppa-flip-title .topppa-flip-back-box-title-text' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_tab();

        $this->start_controls_tab(
            'back_style_description_tab',
            [
                'label' => esc_html__('Description', 'topper-pack'),
            ]
        );
        $this->add_responsive_control(
            'back_description_color',
            [
                'label' => esc_html__('Text Color', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .topppa-flip-box .topppa-flip-box-back .topppa-flip-description,{{WRAPPER}} .topppa-flip-box .topppa-flip-box-back .topppa-flip-description p' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'back_description_typography',
                'selector' => '{{WRAPPER}} .topppa-flip-box .topppa-flip-box-back .topppa-flip-description,{{WRAPPER}} .topppa-flip-box .topppa-flip-box-back .topppa-flip-description p',
            ]
        );
        $this->add_responsive_control(
            'back_description_margin',
            [
                'label' => esc_html__('Margin', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} .topppa-flip-box .topppa-flip-box-back .topppa-flip-description' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'back_description_padding',
            [
                'label' => esc_html__('Padding', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} .topppa-flip-box .topppa-flip-box-back .topppa-flip-description' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_tab();

        $this->start_controls_tab(
            'back_style_icon_tab',
            [
                'label' => esc_html__('Icon', 'topper-pack'),
                'condition' => [
                    'back_icon_type' => 'icon',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'back_icon_size',
                'selector' => '{{WRAPPER}} .topppa-flip-box .topppa-flip-box-back .topppa-flip-box-icon',

            ]
        );
        $this->add_responsive_control(
            'back_icon_color',
            [
                'label' => esc_html__('Text Color', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .topppa-flip-box .topppa-flip-box-back .topppa-flip-box-icon' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .topppa-flip-box .topppa-flip-box-back .topppa-flip-box-icon svg path' => 'fill: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'back_icon_background',
                'types' => ['classic', 'gradient', 'video'],
                'selector' => '{{WRAPPER}} .topppa-flip-box .topppa-flip-box-back .topppa-flip-box-icon',
            ]
        );
        $this->add_responsive_control(
            'back_icon_width',
            [
                'label' => esc_html__('Width', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                        'step' => 5,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .topppa-flip-box .topppa-flip-box-back .topppa-flip-box-icon' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'back_icon_height',
            [
                'label' => esc_html__('Height', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                        'step' => 5,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .topppa-flip-box .topppa-flip-box-back .topppa-flip-box-icon' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'back_icon_border',
                'selector' => '{{WRAPPER}} .topppa-flip-box .topppa-flip-box-back .topppa-flip-box-icon',

            ]
        );
        $this->add_responsive_control(
            'back_icon_radius',
            [
                'label' => esc_html__('Radius', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} .topppa-flip-box .topppa-flip-box-back .topppa-flip-box-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'back_icon_box_shadow',
                'selector' => '{{WRAPPER}} .topppa-flip-box .topppa-flip-box-back .topppa-flip-box-icon',

            ]
        );
        $this->add_responsive_control(
            'back_icon_margin',
            [
                'label' => esc_html__('Margin', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} .topppa-flip-box .topppa-flip-box-back .topppa-flip-box-icon' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'back_icon_padding',
            [
                'label' => esc_html__('Padding', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} .topppa-flip-box .topppa-flip-box-back .topppa-flip-box-icon' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'back_style_image_tab',
            [
                'label' => __('Image', 'topper-pack'),
                'condition' => [
                    'back_icon_type' => 'image',
                ],
            ]
        );
        $this->add_responsive_control(
            'back_image_max_width',
            [
                'label' => esc_html__('Max Width', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                        'step' => 5,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .topppa-flip-box .topppa-flip-box-back .topppa-flip-box-icon img' => 'max-width: {{SIZE}}{{UNIT}};',
                ],

            ]
        );
        $this->add_responsive_control(
            'back_image_width',
            [
                'label' => esc_html__('Width', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                        'step' => 5,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .topppa-flip-box .topppa-flip-box-back .topppa-flip-box-icon img' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'back_image_height',
            [
                'label' => esc_html__('Height', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                        'step' => 5,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .topppa-flip-box .topppa-flip-box-back .topppa-flip-box-icon img' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'back_image_border',
                'selector' => '{{WRAPPER}} .topppa-flip-box .topppa-flip-box-back .topppa-flip-box-icon img',

            ]
        );
        $this->add_responsive_control(
            'back_image_radius',
            [
                'label' => esc_html__('Radius', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} .topppa-flip-box .topppa-flip-box-back .topppa-flip-box-icon img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'back_image_box_shadow',
                'selector' => '{{WRAPPER}} .topppa-flip-box .topppa-flip-box-back .topppa-flip-box-icon img',
            ]
        );
        $this->add_responsive_control(
            'back_image_margin',
            [
                'label' => esc_html__('Margin', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} .topppa-flip-box .topppa-flip-box-back .topppa-flip-box-icon' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'back_image_padding',
            [
                'label' => esc_html__('Padding', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} .topppa-flip-box .topppa-flip-box-back .topppa-flip-box-icon' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();

        // <========================> BUTTON STYLES <========================>
        $this->start_controls_section(
            'topppa_btn_style',
            [
                'label' => esc_html__('Back Button Style', 'topper-pack'),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'topppa_btn_icon_gap',
            [
                'label'      => esc_html__('Icon Gap', 'topper-pack'),
                'type'       => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range'      => [
                    'px' => [
                        'min'  => 0,
                        'max'  => 100,
                        'step' => 1,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .topppa-flip-box-back .topppa-flip-btn-wrapper .topppa-btn' => 'gap: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'topppa_show_icon' => 'yes'
                ]
            ]
        );

        $this->start_controls_tabs(
            'topppa_btn_content_tabs'
        );

        $this->start_controls_tab(
            'topppa_btn_normal',
            [
                'label' => __('Normal', 'topper-pack'),
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'topppa_btn_typo',
                'selector' => '{{WRAPPER}} .topppa-flip-box-back .topppa-flip-btn-wrapper .topppa-btn',
            ]
        );

        $this->add_responsive_control(
            'topppa_btn_color',
            [
                'label'     => esc_html__('Color', 'topper-pack'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .topppa-flip-box-back .topppa-flip-btn-wrapper .topppa-btn' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .topppa-flip-box-back .topppa-flip-btn-wrapper .topppa-btn span' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'topppa_btn_background',
                'types' => ['classic', 'gradient', 'video'],
                'selector' => '{{WRAPPER}} .topppa-flip-box-back .topppa-flip-btn-wrapper .topppa-btn',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name'     => 'topppa_btn_border',
                'label'    => esc_html__('Border', 'topper-pack'),
                'selector' => '{{WRAPPER}} .topppa-flip-box-back .topppa-flip-btn-wrapper .topppa-btn',
            ]
        );

        $this->add_responsive_control(
            'topppa_btn_border_radius',
            [
                'label'      => esc_html__('Border Radius', 'topper-pack'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .topppa-flip-box-back .topppa-flip-btn-wrapper .topppa-btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'topppa_btn_box_shadow',
                'label'    => esc_html__('Shadow', 'topper-pack'),
                'selector' => '{{WRAPPER}} .topppa-flip-box-back .topppa-flip-btn-wrapper .topppa-btn',
            ]
        );

        $this->add_control(
            'topppa_btn_icon_styles',
            [
                'label' => esc_html__('Icon Styles', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_responsive_control(
            'topppa_btn_icon_width',
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
                    '{{WRAPPER}} .topppa-flip-box-back .topppa-flip-btn-wrapper .topppa-btn .btn-icon' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'topppa_btn_icon_height',
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
                    '{{WRAPPER}} .topppa-flip-box-back .topppa-flip-btn-wrapper .topppa-btn .btn-icon' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'topppa_btn_icon_content_typography',
                'selector' => '{{WRAPPER}} .topppa-flip-box-back .topppa-flip-btn-wrapper .topppa-btn .btn-icon',
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'topppa_btn_icon_bg',
                'types' => ['classic', 'gradient', 'video'],
                'selector' => '{{WRAPPER}} .topppa-flip-box-back .topppa-flip-btn-wrapper .topppa-btn .btn-icon',
            ]
        );
        $this->add_responsive_control(
            'topppa_btn_icon_border_radius',
            [
                'label' => esc_html__('Border Radius', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .topppa-flip-box-back .topppa-flip-btn-wrapper .topppa-btn .btn-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'topppa_btn_margin',
            [
                'label'      => esc_html__('Margin', 'topper-pack'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .topppa-flip-box-back .topppa-flip-btn-wrapper .topppa-btn' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'topppa_btn_padding',
            [
                'label'      => esc_html__('Padding', 'topper-pack'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .topppa-flip-box-back .topppa-flip-btn-wrapper .topppa-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'topppa_btn_hover',
            [
                'label' => __('Hover', 'topper-pack'),
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'topppa_btn_typography_hover',
                'selector' => '{{WRAPPER}} .topppa-flip-box-back .topppa-flip-btn-wrapper .topppa-btn:hover',
            ]
        );

        $this->add_responsive_control(
            'topppa_btn_color_hover',
            [
                'label'     => esc_html__('Color', 'topper-pack'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .topppa-flip-box-back .topppa-flip-btn-wrapper .topppa-btn:hover' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .topppa-flip-box-back .topppa-flip-btn-wrapper .topppa-btn:hover span' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'topppa_btn_background_hover',
                'types' => ['classic', 'gradient', 'video'],
                'selector' => '{{WRAPPER}} .topppa-flip-box-back .topppa-flip-btn-wrapper .topppa-btn:hover',
                'condition' => [
                    'topppa_btn_styles' => ['style_three', 'style_six', 'style_seven']
                ]
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'topppa_btn_background_hover2',
                'types' => ['classic', 'gradient', 'video'],
                'selector' => '{{WRAPPER}} .topppa-flip-box-back .topppa-flip-btn-wrapper .topppa-btn::before,{{WRAPPER}} .topppa-flip-box-back .topppa-flip-btn-wrapper .topppa-btn::after ',
                'condition' => [
                    'topppa_btn_styles!' => ['style_three', 'style_six', 'style_seven', 'style_twelve'],
                ]
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name'     => 'topppa_btn_border_hover',
                'label'    => esc_html__('Border', 'topper-pack'),
                'selector' => '{{WRAPPER}} .topppa-flip-box-back .topppa-flip-btn-wrapper .topppa-btn:hover',
            ]
        );

        $this->add_responsive_control(
            'topppa_btn_border_radius_hover',
            [
                'label'      => esc_html__('Border Radius', 'topper-pack'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .topppa-flip-box-back .topppa-flip-btn-wrapper .topppa-btn:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'topppa_btn_box_shadow_hover',
                'label'    => esc_html__('Shadow', 'topper-pack'),
                'selector' => '{{WRAPPER}} .topppa-flip-box-back .topppa-flip-btn-wrapper .topppa-btn:hover',
            ]
        );

        $this->add_control(
            'topppa_btn_icon_hstyles',
            [
                'label' => esc_html__('Icon Styles', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_responsive_control(
            'topppa_btn_icon_hborder_radius',
            [
                'label' => esc_html__('Border Radius', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .topppa-flip-box-back .topppa-flip-btn-wrapper .topppa-btn:hover .btn-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'topppa_btn_icon_hbgcolor',
                'types' => ['classic', 'gradient', 'video'],
                'selector' => '{{WRAPPER}} .topppa-flip-box-back .topppa-flip-btn-wrapper .topppa-btn:hover .btn-icon',
                'condition' => [
                    'topppa_btn_styles!' => 'style_eight'
                ]
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'topppa_btn_icon_hbgcolor2',
                'types' => ['classic', 'gradient', 'video'],
                'selector' => '{{WRAPPER}} .topppa-flip-box-back .topppa-flip-btn-wrapper .topppa-btn .btn-icon::before',
                'condition' => [
                    'topppa_btn_styles' => 'style_eight'
                ]
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();
    }

    /**
     * Optimized template retrieval function with caching
     */
    public function topppa_elementor_template() {
        // Use static caching to avoid multiple DB queries
        static $template_lists = null;

        if ($template_lists === null) {
            $templates = \Elementor\Plugin::instance()->templates_manager->get_source('local')->get_items();

            if (empty($templates)) {
                $template_lists = ['0' => __('No Saved Templates', 'topper-pack')];
            } else {
                $template_lists = ['0' => __('Select Template', 'topper-pack')];
                foreach ($templates as $template) {
                    $template_lists[$template['template_id']] = $template['title'] . ' (' . $template['type'] . ')';
                }
            }
        }

        return $template_lists;
    }

    /**
     * Render the widget output on the frontend
     */
    protected function render() {
        $settings = $this->get_settings_for_display();
        $allowed_html = [
            'a' => [
                'href' => [],
                'title' => [],
                'target' => [],
            ],
            'br' => [],
            'strong' => [],
            'em' => [],
        ];

        $style_classes = [
            'style_one' => 'style-one',
            'style_two' => 'style-two',
            'style_three' => 'style-three',
            'style_four' => 'style-four',
            'style_five' => 'style-five',
            'style_six' => 'style-six',
            'style_seven' => 'style-seven',
            'style_eight' => 'style-eight',
            'style_nine' => 'style-nine',
            'style_ten' => 'style-ten',
            'style_eleven' => 'style-eleven',
            'style_twelve' => 'style-twelve',
            'style_thirteen' => 'style-thirteen',
            'style_fourteen' => 'style-fourteen',
            'style_fifteen' => 'style-fifteen',
        ];
        // Get the class name based on the selected style or fallback to an empty string.
        $class = isset($style_classes[$settings['topppa_btn_styles']]) ? $style_classes[$settings['topppa_btn_styles']] : '';

        // Setup link attributes
        if (!empty($settings['links']['url']) && $settings['select_link'] !== 'none') {
            $this->add_link_attributes('links', $settings['links']);
        }
        if (!empty($settings['front_button_url']['url']) && $settings['front_button_enable'] === 'yes') {
            $this->add_link_attributes('front_button_url', $settings['front_button_url']);
        }
        if (!empty($settings['back_button_url']['url']) && $settings['back_button_enable'] === 'yes') {
            $this->add_link_attributes('back_button_url', $settings['back_button_url']);
        }

        // CSS classes for animation and type
        $classes = ['topppa-flip-box'];

        if (!empty($settings['flip_animation'])) {
            $classes[] = 'topppa-flip-' . $settings['flip_animation'];
        }

        $classes[] = ($settings['choose_type'] === 'click') ? 'topppa-flip-trigger-click' : 'topppa-flip-trigger-hover';
        $class_string = implode(' ', array_filter($classes));

        // Check if box link is enabled
        $has_box_link = 'box_link' === ($settings['select_link'] ?? 'none') && !empty($settings['links']['url']);
?>
        <?php if ($has_box_link) : ?>
            <a <?php echo $this->get_render_attribute_string('links'); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- Already escaped by elementor ?> class="topppa-flip-box-link">
            <?php endif; ?>
            <div class="<?php echo esc_attr($class_string); ?>">
                <div class="topppa-flip-box-inner">
                    <!-- Front -->
                    <div class="topppa-flip-box-front topppa-flip-box-items">
                        <div class="topppa-front-overlay"></div>
                        <div class="topppa-flip-box-content">
                            <?php if (!empty($settings['front_icon_type'])) : ?>
                                <div class="topppa-flip-box-icon">
                                    <?php if ($settings['front_icon_type'] === 'icon' && !empty($settings['front_icon']['value'])) : ?>
                                        <?php \Elementor\Icons_Manager::render_icon($settings['front_icon'], ['aria-hidden' => 'true']); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- Already escaped by elementor ?>
                                    <?php elseif ($settings['front_icon_type'] === 'image' && !empty($settings['front_image']['url'])) : ?>
                                        <?php echo wp_get_attachment_image($settings['front_image']['id'], 'full', false, array(
                                            'alt' => esc_attr($settings['front_title']),
                                        )); ?>
                                    <?php endif; ?>
                                </div>
                            <?php endif; ?>

                            <?php if (!empty($settings['front_title'])) : ?>
                                <div class="topppa-flip-title">
                                    <<?php echo esc_attr($settings['front_title_tag']); ?> class="topppa-flip-front-box-title-text">
                                        <?php if (!$has_box_link && $settings['select_link'] === 'title_link' && !empty($settings['links']['url'])) : ?>
                                            <a <?php echo $this->get_render_attribute_string('links'); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- Already escaped by elementor ?> class="topppa-flip-front-title-link">
                                            <?php endif; ?>

                                            <?php echo esc_html($settings['front_title']); ?>

                                            <?php if (!$has_box_link && $settings['select_link'] === 'title_link' && !empty($settings['links']['url'])) : ?>
                                            </a>
                                        <?php endif; ?>
                                    </<?php echo esc_attr($settings['front_title_tag']); ?>>
                                </div>
                            <?php endif; ?>

                            <?php if (!empty($settings['front_description'])) : ?>
                                <div class="topppa-flip-description">
                                    <?php echo wp_kses($settings['front_description'], $allowed_html); ?>
                                </div>
                            <?php endif; ?>

                            <?php if ($settings['front_button_enable'] === 'yes' && !empty($settings['front_button_text'])) : ?>
                                <div class="topppa-btn-wrapper topppa-flip-btn-wrapper <?php echo !empty($class) ? esc_attr($class) : ''; ?>">
                                    <?php if (!$has_box_link) : ?>
                                        <a class="topppa-btn" <?php echo $this->get_render_attribute_string('front_button_url'); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- Already escaped by elementor ?>>
                                            <?php echo esc_html($settings['front_button_text']); ?>
                                        </a>
                                    <?php else : ?>
                                        <span class="topppa-btn"><?php echo esc_html($settings['front_button_text']); ?></span>
                                    <?php endif; ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>

                    <!-- Back -->
                    <div class="topppa-flip-box-back topppa-flip-box-items">
                        <div class="topppa-back-overlay"></div>
                        <div class="topppa-flip-box-content">
                            <?php if (!empty($settings['back_icon_type'])) : ?>
                                <div class="topppa-flip-box-icon">
                                    <?php if ($settings['back_icon_type'] === 'icon' && !empty($settings['back_icon']['value'])) : ?>
                                        <?php \Elementor\Icons_Manager::render_icon($settings['back_icon'], ['aria-hidden' => 'true']); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- Already escaped by elementor ?>
                                    <?php elseif ($settings['back_icon_type'] === 'image' && !empty($settings['back_image']['url'])) : ?>
                                        <?php echo wp_get_attachment_image($settings['back_image']['id'], 'full', false, array(
                                            'alt' => esc_attr($settings['back_title']),
                                        )); ?>
                                    <?php endif; ?>
                                </div>
                            <?php endif; ?>

                            <?php if (!empty($settings['back_title'])) : ?>
                                <div class="topppa-flip-title">
                                    <<?php echo esc_attr($settings['back_title_tag']); ?> class="topppa-flip-back-box-title-text">
                                        <?php if (!$has_box_link && $settings['select_link'] === 'title_link' && !empty($settings['links']['url'])) : ?>
                                            <a <?php echo $this->get_render_attribute_string('links'); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- Already escaped by elementor ?> class="topppa-flip-back-title-link">
                                            <?php endif; ?>

                                            <?php echo esc_html($settings['back_title']); ?>

                                            <?php if (!$has_box_link && $settings['select_link'] === 'title_link' && !empty($settings['links']['url'])) : ?>
                                            </a>
                                        <?php endif; ?>
                                    </<?php echo esc_attr($settings['back_title_tag']); ?>>
                                </div>
                            <?php endif; ?>

                            <?php if (!empty($settings['back_description'])) : ?>
                                <div class="topppa-flip-description">
                                    <?php echo wp_kses_post($settings['back_description']); ?>
                                </div>
                            <?php endif; ?>

                            <?php if ($settings['back_button_enable'] === 'yes' && !empty($settings['back_button_text'])) : ?>
                                <div class="topppa-btn-wrapper topppa-flip-btn-wrapper <?php echo !empty($class) ? esc_attr($class) : ''; ?>">
                                    <?php if (!$has_box_link) : ?>
                                        <a class="topppa-btn" <?php echo $this->get_render_attribute_string('back_button_url'); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- Already escaped by elementor ?>>
                                            <?php echo esc_html($settings['back_button_text']); ?>
                                        </a>
                                    <?php else : ?>
                                        <span class="topppa-btn"><?php echo esc_html($settings['back_button_text']); ?></span>
                                    <?php endif; ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
            <?php if ($has_box_link) : ?>
            </a>
        <?php endif; ?>
<?php
    }
}