<?php
use TopperPack\Trait_Loader\Global_Component_Loader;
use \TopperPack\Includes\Controls\Controls_Manager as TopperPack_Controls_Manager;
use \TopperPack\Includes\Utilities;
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

/**
 * Elementor topppa Post Image Widget.
 */
class TOPPPA_Search_Box_Widget extends \Elementor\Widget_Base {

    /**
     * Global Component Loader
     *
     * @package TopperPack
     * @since 1.0.0
     */
    use Global_Component_Loader;

    public function get_name() {
        return 'topppa_search_box';
    }

    public function get_title() {
        return TOPPPA_EPWB . esc_html__('Search Box', 'topper-pack');
    }

    public function get_icon() {
        return 'eicon-search';
    }

    public function get_categories() {
        return ['topper-pack'];
    }

    public function get_keywords() {
        return ['topppa', 'widget', 'search', 'box', 'topperpack'];
    }

    public function get_custom_help_url() {
        return 'https://doc.topperpack.com/docs/general-widgets/search-box/';
    }

    public function topppa_search_by_post_type() {
        $this->add_control(
			'pro_preview',
			[
				'type' => \Elementor\Controls_Manager::RAW_HTML,
				'raw' => Utilities::upgrade_pro_image_notice('search-box-widget.jpg'),
			]
		);
    }

    protected function register_controls() {

        /**
         * start Search Box Section
         *
         * @since 1.0.0
         * @access protected
         */
        $this->start_controls_section(
            'search_box_options',
            [
                'label' => esc_html__('Search Box', 'topper-pack'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_control(
            'select_search_box',
            [
                'label' => esc_html__('Select Search Style', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'default',
                'options' => [
                    'default' => esc_html__('Default', 'topper-pack'),
                    'style-1' => esc_html__('Style 1', 'topper-pack'),
                    'style-2' => esc_html__('Style 2', 'topper-pack'),
                    'style-3' => esc_html__('Style 3', 'topper-pack'),
                    'style-4' => esc_html__('Style 4', 'topper-pack'),
                    'custom' => esc_html__('Custom', 'topper-pack'),
                ],
            ]
        );
        $this->add_control(
            'show_title',
            [
                'label' => esc_html__('Show Title', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', 'topper-pack'),
                'label_off' => esc_html__('Hide', 'topper-pack'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );
       
        $this->topppa_global_title_tag(
            ['show_title' => 'yes']
        );

        $this->add_control(
            'placeholder',
            [
                'label' => esc_html__('Placeholder', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Search', 'topper-pack'),
            ]
        );
        $this->add_control(
            'button_style',
            [
                'label' => esc_html__('Button Style', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'icon',
                'options' => [
                    'icon' => esc_html__('Icon', 'topper-pack'),
                    'text' => esc_html__('Text', 'topper-pack'),
                ],
            ]
        );
        $this->add_control(
            'icon',
            [
                'label' => esc_html__('Icon', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::ICONS,
                'default' => [
                    'value' => 'fas fa-search',
                    'library' => 'fa-solid',
                ],
                'recommended' => [
                    'fa-solid' => [
                        'search',
                        'search-plus',
                        'search-minus',
                    ],
                    'fa-regular' => [
                        'search',
                        'search-plus',
                        'search-minus',
                    ],
                ],
                'condition' => [
                    'button_style' => 'icon',
                ],
            ]
        );
        $this->add_control(
            'button_text',
            [
                'label' => esc_html__('Button Text', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Search', 'topper-pack'),
                'placeholder' => esc_html__('Type your title here', 'topper-pack'),
                'condition' => [
                    'button_style' => 'text',
                ],
            ]
        );
        $this->topppa_search_by_post_type();
        $this->end_controls_section();

        /**
         * start style section
         *
         * @since 1.0.0
         * @access protected
         */
        $this->start_controls_section(
            'general_section',
            [
                'label' => esc_html__('General', 'topper-pack'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_responsive_control(
            'button_position',
            [
                'label' => esc_html__('Button Position', 'topper-pack'),
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
                ],
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .topppa-search-box__form .topppa-search-box__input-group' => 'flex-direction: {{VALUE}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'box_margin',
            [
                'label' => esc_html__('Margin', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} .topppa-search-box__wrapper' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'box_padding',
            [
                'label' => esc_html__('Padding', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} .topppa-search-box__wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'box_border',
                'selector' => '{{WRAPPER}} .topppa-search-box__wrapper',
            ]
        );
        $this->add_responsive_control(
            'box_radius',
            [
                'label' => esc_html__('Radius', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} .topppa-search-box__wrapper' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'box_shadow',
                'selector' => '{{WRAPPER}} .topppa-search-box__wrapper',
            ]
        );

        $this->end_controls_section();

        /**
         * start title style section
         *
         * @since 1.0.0
         * @access protected
         */
        $this->start_controls_section(
            'title_section_style',
            [
                'label' => esc_html__('Title', 'topper-pack'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_responsive_control(
            'title_color',
            [
                'label' => esc_html__('Text Color', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .topppa-search-box__title-text' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'selector' => '{{WRAPPER}} .topppa-search-box__title-text',
            ]
        );
        $this->add_responsive_control(
            'title_align',
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
                    '{{WRAPPER}} .topppa-search-box__title' => 'text-align: {{VALUE}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'title_margin',
            [
                'label' => esc_html__('Margin', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} .topppa-search-box__title-text' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'title_padding',
            [
                'label' => esc_html__('Padding', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} .topppa-search-box__title-text' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        /**
         * start input style section
         *
         * @since 1.0.0
         * @access protected
         */
        $this->start_controls_section(
            'input_style',
            [
                'label' => esc_html__('Input', 'topper-pack'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_responsive_control(
            'input_color',
            [
                'label' => esc_html__('Text Color', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .topppa-search-input' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_responsive_control(
            'placeholder_color',
            [
                'label' => esc_html__('Placeholder Color', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .topppa-search-input::placeholder' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'input_background_color',
                'types' => ['classic', 'gradient', 'video'],
                'selector' => '{{WRAPPER}} .topppa-search-box__form',
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'input_typography',
                'selector' => '{{WRAPPER}} .topppa-search-input',
            ]
        );
        $this->add_responsive_control(
            'input_m_height',
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
                    '{{WRAPPER}} .topppa-search-input' => 'max-height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'input_border',
                'selector' => '{{WRAPPER}} .topppa-search-box__form',
            ]
        );
        $this->add_responsive_control(
            'input_radius',
            [
                'label' => esc_html__('Radius', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} .topppa-search-box__form' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'input_box_shadow',
                'selector' => '{{WRAPPER}} .topppa-search-box__form',
            ]
        );
        $this->add_responsive_control(
            'input_margin',
            [
                'label' => esc_html__('Margin', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} .topppa-search-box__form .topppa-search-input' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'input_padding',
            [
                'label' => esc_html__('Padding', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} .topppa-search-box__form .topppa-search-input' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();

        /**
         * start style section
         *
         * @since 1.0.0
         * @access protected
         */
        $this->start_controls_section(
            'category_style',
            [
                'label' => esc_html__('Category', 'topper-pack'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                'condition' => [
                    'show_category_filter' => 'yes',
                ],
            ]
        );
        $this->add_responsive_control(
            'category_text_color',
            [
                'label' => esc_html__('Text Color', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .topppa-search-box__category select' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'category_typography',
                'selector' => '{{WRAPPER}} .topppa-search-box__category select',
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'category_background_color',
                'types' => ['classic', 'gradient', 'video'],
                'selector' => '{{WRAPPER}} .topppa-search-box__category',
            ]
        );
        $this->add_responsive_control(
            'category_width',
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
                    '{{WRAPPER}} .topppa-search-box__form .topppa-search-box__category' => 'min-width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'category_border',
                'selector' => '{{WRAPPER}} .topppa-search-box__category',
            ]
        );
        $this->add_responsive_control(
            'category_radius',
            [
                'label' => esc_html__('Radius', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} .topppa-search-box__category' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'category_box_shadow',
                'selector' => '{{WRAPPER}} .topppa-search-box__category select',
            ]
        );
        $this->add_responsive_control(
            'category_margin',
            [
                'label' => esc_html__('Margin', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} .topppa-search-box__category' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'category_padding',
            [
                'label' => esc_html__('Padding', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} .topppa-search-box__category select' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();

        /**
         * start button style section
         *
         * @since 1.0.0
         * @access protected
         */
        $this->start_controls_section(
            'button_style_controls',
            [
                'label' => esc_html__('Button', 'topper-pack'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_responsive_control(
            'button_width',
            [
                'label' => esc_html__('Width', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                        'step' => 5,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .topppa-search-box__button' => 'min-width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'button_text_color',
            [
                'label' => esc_html__('Text Color', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .topppa-search-box__button' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_responsive_control(
            'button_hover_text_color',
            [
                'label' => esc_html__('Hover Text Color', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .topppa-search-box__button:hover' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'button_background_color',
                'types' => ['classic', 'gradient', 'video'],
                'selector' => '{{WRAPPER}} .topppa-search-box__button',
            ]
        );
        $this->add_responsive_control(
            'button_hover_background_color',
            [
                'label' => esc_html__('Hover Background Color', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .topppa-search-box__button:hover' => 'background-color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'button_typography',
                'selector' => '{{WRAPPER}} .topppa-search-box__button',
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'button_border',
                'selector' => '{{WRAPPER}} .topppa-search-box__button',
            ]
        );
        $this->add_responsive_control(
            'button_radius',
            [
                'label' => esc_html__('Radius', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} .topppa-search-box__button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'button_box_shadow',
                'selector' => '{{WRAPPER}} .topppa-search-box__button',
            ]
        );
        $this->add_responsive_control(
            'button_margin',
            [
                'label' => esc_html__('Margin', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} .topppa-search-box__button' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'button_padding',
            [
                'label' => esc_html__('Padding', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} .topppa-search-box__button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    /**
     * Get available post types
     * 
     * @return array
     */
    protected function get_post_types() {
        $post_types = get_post_types(['public' => true], 'objects');
        $options = ['all' => esc_html__('All', 'topper-pack')];

        foreach ($post_types as $post_type) {
            if ($post_type->name !== 'attachment') {
                $options[$post_type->name] = $post_type->label;
            }
        }
        return $options;
    }

    /**
     * Get available taxonomies
     * 
     * @return array
     */
    protected function get_taxonomies() {
        $taxonomies = get_taxonomies(['public' => true], 'objects');
        $options = ['' => esc_html__('None', 'topper-pack')];

        foreach ($taxonomies as $taxonomy) {
            $options[$taxonomy->name] = $taxonomy->label;
        }

        return $options;
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        $search_style = $settings['select_search_box'];
        $button_style = $settings['button_style'];
        $post_type = $settings['search_post_type'] ?? 'all';
        $taxonomy = $settings['search_taxonomy'] ?? '';
        $show_category = isset($settings['show_category_filter']) && $settings['show_category_filter'] === 'yes';

        // Generate a unique ID for this search box instance
        $search_id = 'topppa-search-' . $this->get_id();

        $wrapper_class = 'topppa-search-box__wrapper topppa-search-box--' . esc_attr($search_style);

        echo '<div class="' . esc_attr($wrapper_class) . '" id="' . esc_attr($search_id) . '">';

        if ( 'yes' === ($settings['show_title'] ?? 'yes') ) {
            echo '<div class="topppa-search-box__title">';
            echo '<' . esc_attr($settings['title_tag'] ?? 'h3') . ' class="topppa-search-box__title-text">' . esc_html($settings['title'] ?? '') . '</' . esc_attr($settings['title_tag'] ?? 'h3') . '>';
            echo '</div>';
        }

        echo '<form role="search" method="get" class="topppa-search-box__form" action="' . esc_url(home_url('/')) . '">';

        // Add hidden fields for post type filtering
        if ($post_type && $post_type !== 'all') {
            echo '<input type="hidden" name="post_type" value="' . esc_attr($post_type) . '">';
        }

        echo '<div class="topppa-search-box__input-group">';

        // Add category dropdown if enabled
        if ( topppa_can_use_premium_features() && $show_category) {
            // Get appropriate taxonomy for the selected post type
            $taxonomy_name = 'category'; // Default for posts

            if ($post_type !== 'all' && $post_type !== 'post') {
                // Get taxonomies for this post type
                $taxonomies = get_object_taxonomies($post_type, 'objects');
                if (!empty($taxonomies)) {
                    // Use the first hierarchical taxonomy, or the first taxonomy if none are hierarchical
                    $found_taxonomy = null;
                    foreach ($taxonomies as $tax) {
                        if ($tax->hierarchical) {
                            $found_taxonomy = $tax->name;
                            break;
                        }
                    }
                    if (!$found_taxonomy && !empty($taxonomies)) {
                        $first_tax = reset($taxonomies);
                        $found_taxonomy = $first_tax->name;
                    }
                    if ($found_taxonomy) {
                        $taxonomy_name = $found_taxonomy;
                    }
                }
            }

            // Get terms for the appropriate taxonomy
            $terms = get_terms([
                'taxonomy' => $taxonomy_name,
                'orderby' => 'name',
                'order' => 'ASC',
                'hide_empty' => true,
            ]);

            if (!empty($terms) && !is_wp_error($terms)) {
                echo '<div class="topppa-search-box__category">';
                echo '<select name="' . esc_attr($taxonomy_name) . '">';
                echo '<option value="">' . esc_html($settings['category_label']) . '</option>';

                foreach ($terms as $term) {
                    // Safely get and sanitize the taxonomy parameter
                    $current_taxonomy_value = '';
                    if (isset($_GET[$taxonomy_name])) { // phpcs:ignore WordPress.Security.NonceVerification.Recommended
                        $current_taxonomy_value = sanitize_text_field(wp_unslash($_GET[$taxonomy_name])); // phpcs:ignore WordPress.Security.NonceVerification.Recommended
                    }
                    
                    $selected = ($current_taxonomy_value === $term->slug) ? 'selected' : '';
                    echo '<option value="' . esc_attr($term->slug) . '" ' . esc_attr($selected) . '>';
                    echo esc_html($term->name);
                    echo '</option>';
                }

                echo '</select>';
                echo '</div>';
            }
        }

        echo '<div class="topppa-search-box__input-wrap">';
        echo '<input type="text" name="s" class="topppa-search-input" placeholder="' . esc_attr($settings['placeholder']) . '" value="' . get_search_query() . '">';
        echo '</div>';

        echo '<button type="submit" class="topppa-search-box__button">';

        if ($button_style === 'icon' && !empty($settings['icon']['value'])) {
            \Elementor\Icons_Manager::render_icon($settings['icon'], ['aria-hidden' => 'true']);
        } else {
            echo esc_html($settings['button_text']);
        }

        echo '</button>';

        echo '</div>'; // Close input-group

        echo '</form>';

        echo '</div>';
    }
}