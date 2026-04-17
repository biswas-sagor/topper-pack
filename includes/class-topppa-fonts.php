<?php

/**
 * Fonts Handler
 *
 * @package Topper Pack
 * @since 1.0.0
 */

namespace TopperPack;

if (! defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

/**
 * Fonts Handler Class
 */
class TOPPPA_Fonts {

    /**
     * Instance
     *
     * @access private
     * @static
     *
     * @var TOPPPA_Fonts The single instance of the class.
     */
    private static $_instance = null;

    /**
     * Instance
     *
     * Ensures only one instance of the class is loaded or can be loaded.
     *
     * @access public
     * @static
     *
     * @return TOPPPA_Fonts An instance of the class.
     */
    public static function instance() {
        if (is_null(self::$_instance)) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    /**
     * Constructor
     */
    public function __construct() {
        add_action('wp_enqueue_scripts', [$this, 'register_fonts']);
        add_action('admin_enqueue_scripts', [$this, 'register_fonts']);
    }

    /**
     * Register fonts
     *
     * @return void
     */
    public function register_fonts() {
        // Register Google Fonts
        $google_fonts = [
            'Hanken Grotesk' => [
                'family' => 'Hanken+Grotesk:ital,wght@0,100..900;1,100..900',
                'display' => 'swap',
            ],
            'Outfit' => [
                'family' => 'Outfit:wght@100..900',
                'display' => 'swap',
            ],
        ];

        // Build Google Fonts URL
        $google_fonts_url = $this->get_google_fonts_url($google_fonts);
        // Register and enqueue Google Fonts
        if (! empty($google_fonts_url)) {
            wp_register_style(
                'topppa-google-fonts',
                $google_fonts_url,
                [],
                TOPPPA_VER
            );
            wp_enqueue_style('topppa-google-fonts');
        }

        // Add preconnect for Google Fonts
        add_action('wp_head', [$this, 'add_preconnect'], 1);
    }

    /**
     * Get Google Fonts URL
     *
     * @param array $fonts Array of font data.
     * @return string Google Fonts URL.
     */
    private function get_google_fonts_url($fonts) {
        if (empty($fonts)) {
            return '';
        }

        $font_families = [];
        $font_display = 'swap';

        foreach ($fonts as $font_name => $font_data) {
            $font_families[] = $font_data['family'];
            $font_display = $font_data['display'];
        }

        $font_families = array_unique($font_families);
        $query_args = [
            'family' => implode('&family=', $font_families),
            'display' => $font_display,
        ];

        return add_query_arg($query_args, 'https://fonts.googleapis.com/css2');
    }

    /**
     * Add preconnect for Google Fonts
     *
     * @return void
     */
    public function add_preconnect() {
?>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<?php
    }
}

// Initialize the class
TOPPPA_Fonts::instance();
