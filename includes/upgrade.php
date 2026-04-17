<?php 
/**
 * Upgrade and Pro Feature Helper Functions
 *
 * @package Topper Pack
 * @since 1.0.0
 */

if (! defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}

/**
 * Check Topper Pack Pro installed and activated correctly
 */
if (!function_exists('is_topperpack_pro_installed')) {
    function is_topperpack_pro_installed()
    {
        $file_path         = 'topper-pack-pro/topper-pack-pro.php';
        $installed_plugins = get_plugins();

        return isset($installed_plugins[$file_path]);
    }
}

/**
 * Check if Topper Pack Pro is active
 */
if (!function_exists('is_topperpack_pro_active')) {
    function is_topperpack_pro_active()
    {
        if (!function_exists('is_plugin_active')) {
            require_once ABSPATH . 'wp-admin/includes/plugin.php';
        }

        return is_plugin_active('topper-pack-pro/topper-pack-pro.php');
    }
}

/**
 * =====================================
 * THEME LICENSE HELPER FUNCTIONS
 * =====================================
 * These functions provide the priority system for feature access
 */

/**
 * Check if user can use premium features using Theme License first, then Freemius logic
 */
if (!function_exists('topppa_can_use_premium_features')) {
    function topppa_can_use_premium_features()
    {
        // First priority: Check theme license using helper function
        if (function_exists('topppa_is_theme_license_active') && topppa_is_theme_license_active()) {
            return true; // Theme license provides premium access
        }
        
        // Second priority: Use Freemius logic if available
        if (function_exists('tpp_fs') && tpp_fs()->is_registered()) {
            return tpp_fs()->can_use_premium_code__premium_only();
        }
        
        // Fallback to current logic
        return is_topperpack_pro_installed() && is_topperpack_pro_active();
    }
}

/**
 * Get premium feature restriction message using Theme License first, then Freemius logic
 */
if (!function_exists('topppa_get_premium_restriction_message')) {
    function topppa_get_premium_restriction_message()
    {
        // If theme license is active, no restriction
        if (function_exists('topppa_is_theme_license_active') && topppa_is_theme_license_active()) {
            return '';
        }
        
        // Use Freemius logic if available
        if (function_exists('tpp_fs') && tpp_fs()->is_registered()) {
            if (!tpp_fs()->is_premium()) {
                return 'This is a Pro feature. Please upgrade to Pro version.';
            } elseif (!tpp_fs()->is_plan_or_trial('professional')) {
                return 'This is a Pro feature. Please upgrade your plan.';
            } else {
                return 'This is a Pro feature. Please activate your license.';
            }
        }
        
        // Fallback titles
        if (!is_topperpack_pro_installed()) {
            return 'This is a Pro feature. Please install the Pro Pack.';
        } else {
            return 'This is a Pro feature. Please activate the Pro Pack.';
        }
    }
}

/**
 * Generate purchase link for pro features
 */
if (!function_exists('topppa_get_purchase_link')) {
    function topppa_get_purchase_link($is_pro = true, $can_use_premium = null, $link_text = 'Purchase', $show_icon = true, $custom_url = '', $additional_classes = '', $tracking_source = '')
    {
        // If $can_use_premium is not provided, get it automatically
        if ($can_use_premium === null) {
            $can_use_premium = topppa_can_use_premium_features();
        }
        
        // Only show link for pro features when user doesn't have premium access
        if (!$is_pro || $can_use_premium) {
            return '';
        }
        
        // Get dynamic URL or use custom/default
        if (!empty($custom_url)) {
            $url = $custom_url;
        } elseif (function_exists('topppa_get_dynamic_url')) {
            $url = topppa_get_dynamic_url($tracking_source);
        } else {
            $url = 'https://topperpack.com/pricing/';
        }
        
        // Add UTM tracking parameters
        $tracking_params = [
            'utm_source' => 'plugin',
            'utm_medium' => 'purchase_link',
            'utm_campaign' => !empty($tracking_source) ? $tracking_source : 'general',
            'utm_content' => sanitize_title($link_text)
        ];
        
        $url = add_query_arg($tracking_params, $url);
        
        // Build the icon
        $icon = $show_icon ? '<i class="icon-element eicon-cart"></i>' : '';
        
        // Build additional classes
        $classes = 'topppa-purchase-link' . (!empty($additional_classes) ? ' ' . $additional_classes : '');
        
        // Add tracking click event
        $onclick = sprintf("topppaTrackClick('%s', '%s')", 
            !empty($tracking_source) ? $tracking_source : 'purchase_link', 
            sanitize_title($link_text)
        );
        
        // Generate the link
        return sprintf(
            '<a href="%s" target="_blank" class="%s" onclick="%s">%s%s</a>',
            esc_url($url),
            esc_attr($classes),
            esc_attr($onclick),
            $icon,
            esc_html($link_text)
        );
    }
}

/**
 * =====================================
 * UPGRADE MENU SYSTEM
 * =====================================
 * Simple upgrade menu functionality for free users
 */

/**
 * Simple upgrade menu - only for free users
 */
function topppa_add_upgrade_menu() {
    if (function_exists('tpp_fs') && !tpp_fs()->is_premium()) {
        global $submenu;
        $submenu['topper-pack'][] = array(
            'Upgrade to Pro',
            'manage_options', 
            'https://topperpack.com/pricing/'
        );
    }
}
add_action('admin_menu', 'topppa_add_upgrade_menu', 99999999);

/**
 * Reorder menu to put upgrade at bottom
 */
function topppa_reorder_upgrade_menu() {
    if (function_exists('tpp_fs') && !tpp_fs()->is_premium()) {
        global $submenu;
        if (isset($submenu['topper-pack'])) {
            $upgrade_item = null;
            $other_items = array();
            
            // Find and separate the upgrade menu item
            foreach ($submenu['topper-pack'] as $key => $item) {
                if (isset($item[0]) && strpos($item[0], 'Upgrade') !== false) {
                    $upgrade_item = $item;
                } else {
                    $other_items[] = $item;
                }
            }
            
            // Rebuild menu with upgrade at the bottom
            if ($upgrade_item) {
                $submenu['topper-pack'] = $other_items;
                $submenu['topper-pack'][] = $upgrade_item;
            }
        }
    }
}
add_action('admin_head', 'topppa_reorder_upgrade_menu');

/**
 * Style the upgrade menu link
 */
function topppa_upgrade_menu_style() {
    if (function_exists('tpp_fs') && !tpp_fs()->is_premium()) {
        ?>
        <script>
        jQuery(document).ready(function($) {
            $('a[href="https://topperpack.com/pricing/"]').attr('target', '_blank').css({
                'color': '#00d084',
                'font-weight': 'bold'
            });
        });
        </script>
        <?php
    }
}
add_action('admin_footer', 'topppa_upgrade_menu_style');



/**
 * =====================================
 * PLUGIN ACTION LINKS
 * =====================================
 * Add settings and pro links to plugins page
 */

/**
 * Add settings and pro links to plugins page
 */
function topppa_add_settings_link($links) {
    // Create new links array
    $new_links = array();
    
    // Add Get Pro link first
    $new_links[] = '<a href="https://topperpack.com/pricing/" target="_blank" style="color: #d63638; font-weight: 600;">' . __('Get Pro', 'topper-pack') . '</a>';
    
    // Add Settings link
    $new_links[] = '<a href="' . admin_url('admin.php?page=topper-pack') . '">' . __('Settings', 'topper-pack') . '</a>';
    
    // Add all existing links
    foreach ($links as $link) {
        $new_links[] = $link;
    }
    
    return $new_links;
}

// Add settings link to plugin action links
add_filter('plugin_action_links_' . plugin_basename(TOPPPA__FILE__), 'topppa_add_settings_link');

/**
 * =====================================
 * PLUGIN ACTIVATION FUNCTIONS
 * =====================================
 * Handle plugin activation and default settings
 */

// Plugin activation hook to redirect to setup wizard
function topppa_plugin_activation() {
    // Only show wizard if it hasn't been completed before
    $wizard_completed = get_option('topper_pack_wizard_completed');
    if ($wizard_completed !== 'yes') {
        update_option('topper_pack_show_wizard', 'yes');
    }
    
    // Initialize custom post types array
    update_option('topppa_custom_post_types', array());
    
    // Set default widget and extension states to 'yes'
    topppa_set_default_widget_states();
    topppa_set_default_extension_states();
    
    // Flush rewrite rules
    flush_rewrite_rules();
}

// Function to set default widget states
function topppa_set_default_widget_states() {
    try {
        // Load the wizard class to get widget data
        if (!class_exists('TopperPack_Setup_Wizard')) {
            require_once TOPPPA_INC_PATH . 'setup-wizard/wizard.php';
        }
        
        $wizard = new TopperPack_Setup_Wizard();
        $widgets_data = $wizard->get_widgets_data();
        
        foreach ($widgets_data as $widget_id => $widget) {
            // Only set default for free widgets, not PRO ones
            if (!$widget['is_pro']) {
                // Only set if not already set
                if (get_option($widget_id) === false) {
                    update_option($widget_id, 'yes');
                }
            }
        }
    } catch (Exception $e) {
        // Log error but don't break activation
       
    }
}

// Function to set default extension states
function topppa_set_default_extension_states() {
    try {
        // Load the wizard class to get extension data
        if (!class_exists('TopperPack_Setup_Wizard')) {
            require_once TOPPPA_INC_PATH . 'setup-wizard/wizard.php';
        }
        
        $wizard = new TopperPack_Setup_Wizard();
        $extensions_data = $wizard->get_features_data();
        
        foreach ($extensions_data as $extension_id => $extension) {
            // Only set default for free extensions, not PRO ones
            if (!$extension['is_pro']) {
                // Only set if not already set
                if (get_option($extension_id) === false) {
                    update_option($extension_id, 'yes');
                }
            }
        }
    } catch (Exception $e) {
        // Log error but don't break activation
        
    }
}

register_activation_hook(TOPPPA__FILE__, 'topppa_plugin_activation');
