<?php
/**
 * Custom CSS Extension
 *
 * @package Topper Pack
 * @since 1.0.0
 */

namespace TopperPack\Extensions;

// If this file is called directly, abort.
defined('ABSPATH') || exit;

use Elementor\Controls_Manager;
use Elementor\Controls_Stack;
use Elementor\Core\DynamicTags\Dynamic_CSS;
use Elementor\Plugin as Elementor_Plugin;

class TOPPPA_Custom_CSS {
    function __construct() {
        add_action('elementor/element/common/_section_responsive/after_section_end', [$this, 'topppa_register_controls'], 10, 2);
        add_action('elementor/element/section/_section_responsive/after_section_end', [$this, 'topppa_register_controls'], 10, 2);
        add_action('elementor/element/column/_section_responsive/after_section_end', [$this, 'topppa_register_controls'], 10, 2);

        add_action('elementor/element/container/_section_responsive/after_section_end', [$this, 'topppa_register_controls'], 10, 2);

        add_action('elementor/element/parse_css', [$this, 'add_post_css'], 10, 2);
        add_action('elementor/css-file/post/parse', [$this, 'add_page_settings_css']);

        add_action('elementor/frontend/after_enqueue_scripts', [$this, 'topppa_add_custom_css_for_editor']);
    }

    public function topppa_register_controls(Controls_Stack $element, $section_id) {

        if (!current_user_can('edit_pages') && !current_user_can('unfiltered_html')) {
            return;
        }

        $element->start_controls_section(
            'topppa_custom_css',
            [
                'label' => '<span class="topppa-extension-badge"></span>' . __('Custom CSS', 'topper-pack'),
                'tab' => Controls_Manager::TAB_ADVANCED,
            ]
        );

        $element->start_controls_tabs(
            'style_tabs'
        );

        $element->start_controls_tab(
            'topppa_custom_css_desktop',
            [
                'label' => '<span class="eicon-device-desktop" title="' . esc_html__('Desktop', 'topper-pack') . '"></span>',
            ]
        );

        $element->add_control(
            'topppa_custom_css_title_desktop',
            [
                'label' => esc_html__('Custom CSS', 'topper-pack'),
                'type' => Controls_Manager::HEADING,
            ]
        );

        $element->add_control(
            'topppa_custom_css_css_desktop',
            [
                'label' => esc_html__('Custom CSS', 'topper-pack'),
                'type' => Controls_Manager::CODE,
                'language' => 'css',
                'render_type' => 'ui',
                'show_label' => false,
                'separator' => 'none',
            ]
        );

        $element->end_controls_tab();

        $element->start_controls_tab(
            'topppa_custom_css_tablet',
            [
                'label' => '<span class="eicon-device-tablet" title="' . esc_html__('Tablet', 'topper-pack') . '"></span>',
            ]
        );

        $element->add_control(
            'topppa_custom_css_title_tablet',
            [
                'label' => esc_html__('Custom CSS (Tablet)', 'topper-pack'),
                'type' => Controls_Manager::HEADING,
            ]
        );

        $element->add_control(
            'topppa_custom_css_css_tablet',
            [
                'type' => Controls_Manager::CODE,
                'label' => esc_html__('Custom CSS (Tablet)', 'topper-pack'),
                'language' => 'css',
                'render_type' => 'ui',
                'show_label' => false,
                'separator' => 'none',
            ]
        );

        $element->end_controls_tab();


        $element->start_controls_tab(
            'topppa_custom_css_mobile',
            [
                'label' => '<span class="eicon-device-mobile" title="' . esc_html__('Mobile', 'topper-pack') . '"></span>',
            ]
        );

        $element->add_control(
            'topppa_custom_css_title_mobile',
            [
                'label' => esc_html__('Custom CSS (Mobile)', 'topper-pack'),
                'type' => Controls_Manager::HEADING,
            ]
        );

        $element->add_control(
            'topppa_custom_css_css_mobile',
            [
                'type' => Controls_Manager::CODE,
                'label' => esc_html__('Custom CSS (Mobile)', 'topper-pack'),
                'language' => 'css',
                'render_type' => 'ui',
                'show_label' => false,
                'separator' => 'none',
            ]
        );

        $element->end_controls_tab();
        $element->end_controls_tabs();

        $element->add_control(
            'topppa_custom_css_description',
            [
                'raw' => esc_html__('Use "selector" to target wrapper element. Examples:<br>selector {color: red;} // For main element<br>selector .child-element {margin: 10px;} // For child element<br>.my-class {text-align: center;} // Or use any custom selector', 'topper-pack'),
                'type' => Controls_Manager::RAW_HTML,
                'content_classes' => 'elementor-descriptor',
            ]
        );

        $element->add_control(
            'topppa_custom_css_notice',
            [
                'type' => Controls_Manager::RAW_HTML,
                'raw' => esc_html__('If the CSS is not reflecting in the editor panel or frontend, you need to write a more specific CSS selector.', 'topper-pack'),
                'content_classes' => 'elementor-panel-alert elementor-panel-alert-info',
            ]
        );

        $element->end_controls_section();
    }

    public function add_post_css($post_css, $element) {
        if ($post_css instanceof Dynamic_CSS) {
            return;
        }

        $element_settings = $element->get_settings();

        $sanitize_css = $this->parse_css_to_remove_injecting_code($element_settings, $post_css->get_element_unique_selector($element));

        if (!empty($sanitize_css)) {
            $post_css->get_stylesheet()->add_raw_css($sanitize_css);
        }
    }

    public function add_page_settings_css($post_css) {

        $document = Elementor_Plugin::instance()->documents->get($post_css->get_post_id());

        $element_settings = $document->get_settings();

        $sanitize_css = $this->parse_css_to_remove_injecting_code($element_settings, $document->get_css_wrapper_selector());

        if (!empty($sanitize_css)) {
            $post_css->get_stylesheet()->add_raw_css($sanitize_css);
        }
    }

    public function parse_css_to_remove_injecting_code($element_settings, $unique_selector) {

        $custom_css = '';

        if (empty($element_settings['topppa_custom_css_css_desktop']) && empty($element_settings['topppa_custom_css_css_tablet']) && empty($element_settings['topppa_custom_css_css_mobile'])) {
            return '';
        }

        $custom_css_desktop = isset($element_settings['topppa_custom_css_css_desktop']) ? $element_settings['topppa_custom_css_css_desktop'] : '';
        $custom_css_tablet = isset($element_settings['topppa_custom_css_css_tablet']) ? $element_settings['topppa_custom_css_css_tablet'] : '';
        $custom_css_mobile = isset($element_settings['topppa_custom_css_css_mobile']) ? $element_settings['topppa_custom_css_css_mobile'] : '';

        if (empty($custom_css_desktop) && empty($custom_css_tablet) && empty($custom_css_mobile)) {
            return '';
        }

        $custom_css .= ((!empty($custom_css_desktop)) ? $custom_css_desktop : "");
        $custom_css .= ((!empty($custom_css_tablet)) ? " @media (max-width: 768px) { " . $custom_css_tablet . "}" : "");
        $custom_css .= ((!empty($custom_css_mobile)) ? " @media (max-width: 425px) { " . $custom_css_mobile . "}" : "");

        if (empty($custom_css)) {
            return '';
        }

        // $custom_css = str_replace('selector', $unique_selector, $custom_css);
        // $remove_tags_css = wp_kses($custom_css, []);

        return $custom_css;
    }

    public function get_script_depends() {
        return ['topppa-custom-css'];
    }

    public function topppa_add_custom_css_for_editor() {
        wp_enqueue_script(
            'topppa-custom-css',
            TOPPPA_ASSETS_URL . 'js/extensions/topppa-custom-css.min.js',
            ['elementor-frontend'],
            TOPPPA_VER,
            true
        );

        wp_localize_script(
            'topppa-custom-css',
            'modelData',
            array(
                'postID' => get_the_ID()
            )
        );
    }
}

new TOPPPA_Custom_CSS();
