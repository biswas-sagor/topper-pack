<?php
/**
 * Import functionality initialization
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

/**
 * Initialize import functionality
 */
function topppa_init_import_functionality() {
    // Initialize Ready Site Importer
    if (class_exists('TOPPPA_Ready_Site_Importer')) {
        new TOPPPA_Ready_Site_Importer();
    }
}

// Hook into admin_init to ensure all WordPress functions are available
add_action('admin_init', 'topppa_init_import_functionality');

/**
 * Check if WordPress importer functionality is available
 */
function topppa_is_wordpress_importer_available() {
    return class_exists('TOPPPA_Custom_Import');
}

/**
 * Get WordPress importer instance
 */
function topppa_get_wordpress_importer() {
    if (topppa_is_wordpress_importer_available()) {
        return new TOPPPA_Custom_Import();
    }
    return null;
} 