<?php
/**
 * Template Library Init
 *
 * @package Topper Pack
 * @since 1.0.0
 */
namespace TopperPack\Includes\Templates_Library;

defined('ABSPATH') || die();

class TOPPPA_Templates_Init {
    private static $instance = null;

    public static function url() {
        return trailingslashit(plugin_dir_url(__FILE__));
    }

    public static function dir() {
        return trailingslashit(plugin_dir_path(__FILE__));
    }

    public static function version() {
        return '1.0.0';
    }

    public function init() {

        add_action(
            'wp_enqueue_scripts',
            function () {
                wp_enqueue_style("topppa-el-template-front", self::url() . 'assets/css/template-frontend.min.css', ['elementor-frontend'], self::version());
            }
        );

        add_action(
            'elementor/editor/after_enqueue_scripts',
            function () {
                wp_enqueue_style("topppa-load-template-editor", self::url() . 'assets/css/template-library.min.css', ['elementor-editor'], self::version());
                wp_enqueue_script("topppa-load-template-editor", self::url() . 'assets/js/template-library.min.js', ['elementor-editor'], self::version(), true);

                $localize_data = [
                    'templateLogo' => TEMPLATE_LOGO_SRC,
                    'i18n'         => [
                        'templatesEmptyTitle'       => esc_html__('No Templates Found', 'topper-pack'),
                        'templatesEmptyMessage'     => esc_html__('Try different category or sync for new templates.', 'topper-pack'),
                        'templatesNoResultsTitle'   => esc_html__('No Results Found', 'topper-pack'),
                        'templatesNoResultsMessage' => esc_html__('Please make sure your search is spelled correctly or try a different words.', 'topper-pack'),
                    ],
                    'tab_style'    => json_encode(self::get_tabs()),
                    'default_tab'  => 'section',
                    'upgrade_url'  => 'https://topperpack.com/pricing/',
                    'tracking_source' => 'template_library',
                    'has_pro_access' => function_exists('topppa_can_use_premium_features') ? topppa_can_use_premium_features() : false,
                ];
                wp_localize_script(
                    'topppa-load-template-editor',
                    'topppaEditor',
                    $localize_data
                );
            },
            999
        );

        // Add CSS for pro template styling
        add_action('elementor/editor/after_enqueue_styles', function () {
            // CSS moved to template-library.min.css
        }, 999);
        
        // Also add CSS to wp_head for better compatibility
        add_action('wp_head', function () {
            // CSS moved to template-library.min.css
        });
        
        // Simple JavaScript for pro template system
        add_action('elementor/editor/footer', function () {
            // JavaScript moved to template-library.min.js
        });
    }

    public static function get_tabs() {
        return apply_filters('topppa_editor/templates_tabs', [
            'section' => ['title' => 'Blocks'],
            'page'    => ['title' => 'Templates'],
            'header' => ['title' => 'Header Templates'],
            'footer'    => ['title' => 'Footer Templates'],
        ]);
    }
    
    public static function instance() {
        if (is_null(self::$instance)) {
            self::$instance = new self();
        }
        return self::$instance;
    }
}