<?php
/**
 * Plugin Name: Topper Pack
 * Plugin URI: https://topperpack.com/
 * Description: Supercharge your WordPress site with 100+ Elementor widgets, WooCommerce tools, CPT & theme builders, ready site import, and pro-level controls.
 * Version:     1.2.1
 * Author:      Themepul
 * Author URI:  https://themepul.com/
 * License:     GPLv3 or later
 * License URI: https://www.gnu.org/licenses/gpl-3.0.html
 * Text Domain: topper-pack
 * Domain Path: /languages
 * Requires Plugins: elementor
 * Elementor tested up to: 3.34.4
 * Elementor Pro tested up to: 3.34.4
 * Requires at least: 5.0
 * Tested up to: 6.9
 */

if (! defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}
/**
 * Don't remove this function, it is essential for the
 * `function_exists` CALL ABOVE TO PROPERLY WORK.
 */
function topppa_is_theme_license_active() {
    $license_status = get_option('themepul_license_status', '');
    $is_active = ($license_status === 'active');

    // Enhanced check: verify current theme matches licensed theme (with child theme support)
    if ($is_active) {
        $licensed_theme = get_option('themepul_theme_name', '');
        $current_theme_obj = wp_get_theme();
        $current_theme = $current_theme_obj->get('Name');
        
        if (!empty($licensed_theme)) {
            // Check if current theme is a child theme
            $parent_theme = $current_theme_obj->parent();
            $parent_theme_name = $parent_theme ? $parent_theme->get('Name') : '';
            
            // Normalize theme names for comparison (case-insensitive)
            $licensed_theme_norm = strtolower(trim($licensed_theme));
            $current_theme_norm = strtolower(trim($current_theme));
            $parent_theme_norm = strtolower(trim($parent_theme_name));
            
            // License is valid if it matches current theme OR parent theme (for child themes)
            $theme_matches = (
                $licensed_theme_norm === $current_theme_norm ||
                (!empty($parent_theme_norm) && $licensed_theme_norm === $parent_theme_norm)
            );
            
            if (!$theme_matches) {
                $is_active = false;
            }
        }
    }

    return $is_active;
}

$is_theme_license_active = topppa_is_theme_license_active();

if (!$is_theme_license_active) {
    // Load Freemius normally for plugin-only customers
    if (function_exists('tpp_fs')) {
        tpp_fs()->set_basename(false, __FILE__);
    } else {

        if (! function_exists('tpp_fs')) {
            // Create a helper function for easy SDK access.
            function tpp_fs() {
                global $tpp_fs;

                if (! isset($tpp_fs)) {
                    // Include Freemius SDK.
                    require_once dirname(__FILE__) . '/freemius/start.php';

                    // Determine the correct first path based on wizard completion status
                    $first_path = 'admin.php?page=topper-pack';
                    $wizard_completed = get_option('topper_pack_wizard_completed');
                    if ($wizard_completed !== 'yes') {
                        $first_path = 'admin.php?page=topper-pack-wizard';
                    }

                    $tpp_fs = fs_dynamic_init(array(
                        'id'                  => '19640',
                        'slug'                => 'topper-pack',
                        'premium_slug'        => 'topper-pack-pro',
                        'type'                => 'plugin',
                        'public_key'          => 'pk_898b0ef398c81975d74ace3e30bcd',
                        'is_premium'          => false,
                        'is_premium_only'     => false,
                        'premium_suffix'      => 'Pro',
                        'is_org_compliant'    => true,
                        // If your plugin is a serviceware, set this option to false.
                        'has_premium_version' => true,
                        'has_addons'          => false,
                        'has_paid_plans'      => true,
                        'menu'                => array(
                            'slug'           => 'topper-pack',
                            'first-path'     => $first_path,
                            'contact'    => false,
                            'support'    => false,
                            'pricing'    => false,
                            'account'    => false,
                        ),
                    ));
                }

                return $tpp_fs;
            }

            // Init Freemius.
            tpp_fs();
            tpp_fs()->add_filter('deactivate_on_activation', '__return_false');
            tpp_fs()->add_filter('hide_freemius_powered_by', '__return_true');

            // Add filter to dynamically set first path based on wizard status
            tpp_fs()->add_filter('fs_default_options', function ($options) {
                $wizard_completed = get_option('topper_pack_wizard_completed');
                if ($wizard_completed === 'yes') {
                    $options['menu']['first-path'] = 'admin.php?page=topper-pack';
                } else {
                    $options['menu']['first-path'] = 'admin.php?page=topper-pack-wizard';
                }
                return $options;
            });

            // Signal that SDK was initiated.
            do_action('tpp_fs_loaded');
        }
    }
}
// If theme license is active, Freemius is completely bypassed (no initialization)

// Pre Define
define( 'TOPPPA_VER', '1.2.1' );
define( 'TOPPPA__FILE__', __FILE__ );
define( 'TOPPPA_DIR', plugin_dir_path( __FILE__ ) );

define( 'TOPPPA_PNAME', basename( dirname( TOPPPA__FILE__ ) ) );
define( 'TOPPPA_PBNAME', plugin_basename( TOPPPA__FILE__ ) );
define( 'TOPPPA_PATH', plugin_dir_path( TOPPPA__FILE__ ) );
define( 'TOPPPA_URL', plugins_url( '/', TOPPPA__FILE__ ) );
define( 'TOPPPA_ADMIN_PATH', TOPPPA_PATH . 'admin/' );
define( 'TOPPPA_ADMIN_URL', TOPPPA_URL . 'admin/' );
define( 'TOPPPA_ADMIN_ASSETS_PATH', TOPPPA_PATH . 'admin/assets/' );
define( 'TOPPPA_ADMIN_ASSETS_URL', TOPPPA_URL . 'admin/assets/' );
define( 'TOPPPA_WIDGETS_PATH', TOPPPA_PATH . 'widgets/' );
define( 'TOPPPA_EXTENSIONS_PATH', TOPPPA_PATH . 'extensions/' );
define( 'TOPPPA_ASSETS_URL', TOPPPA_URL . 'assets/' );
define( 'TOPPPA_ASSETS_PATH', TOPPPA_PATH . 'assets/' );
define( 'TOPPPA_WIDGETS_URL', TOPPPA_URL . 'widgets/' );
define( 'TOPPPA_EXTENSIONS_URL', TOPPPA_URL . 'extensions/' );
define( 'TOPPPA_INC_PATH', TOPPPA_PATH . 'includes/' );
define( 'TOPPPA_INC_URL', TOPPPA_URL . 'includes/' );

define( 'TOPPPA_EPWB', '<span class="topppa-elementor-panel-widget-badge"></span>' );


// Load setup wizard early
require_once TOPPPA_INC_PATH . 'setup-wizard/wizard.php';
function topppa_plugin_loaded() {
    // Load plugin file
    require_once(TOPPPA_INC_PATH . 'plugin.php');

    // Run the plugin
    \TopperPack\Plugin::instance();
}
add_action('plugins_loaded', 'topppa_plugin_loaded');

// Include upgrade and helper functions
require_once(TOPPPA_INC_PATH . 'upgrade.php');