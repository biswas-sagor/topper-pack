<?php
/**
 * Settings Import/Export Init
 *
 * @package Topper Pack
 * @since 1.0.0
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

// Load the Settings Manager class
require_once TOPPPA_INC_PATH . 'settings-import/class-settings-manager.php';

// Initialize the settings import/export functionality
function topppa_init_settings_import() {
    // Only load in admin
    if (!is_admin()) {
        return;
    }
    
    // Make sure the class is available
    if (!class_exists('TopperPack\Includes\Settings_Import\Settings_Manager')) {
        return;
    }
    
    // Initialize the settings manager
    new \TopperPack\Includes\Settings_Import\Settings_Manager();
}

// Hook into WordPress initialization
add_action('init', 'topppa_init_settings_import');

/**
 * Helper function to check if settings import/export is available
 * 
 * @return bool
 */
function topppa_is_settings_import_available() {
    return class_exists('TopperPack\Includes\Settings_Import\Settings_Manager');
}

/**
 * Helper function to get settings manager instance
 * 
 * @return \TopperPack\Includes\Settings_Import\Settings_Manager|null
 */
function topppa_get_settings_manager() {
    if (topppa_is_settings_import_available()) {
        return new \TopperPack\Includes\Settings_Import\Settings_Manager();
    }
    return null;
} 