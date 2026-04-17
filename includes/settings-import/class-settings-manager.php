<?php
/**
 * Settings Import/Export Manager
 *
 * @package Topper Pack
 * @since 1.0.0
 */

namespace TopperPack\Includes\Settings_Import;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

/**
 * Class Settings_Manager
 * 
 * Handles import/export of all plugin settings including widgets, extensions, and configurations
 */
class Settings_Manager {

    /**
     * Plugin option prefix
     */
    const OPTION_PREFIX = 'topppa_';

    /**
     * Constructor
     */
    public function __construct() {
        // Define plugin paths for dynamic scanning
        $this->define_plugin_paths();
        
        add_action('wp_ajax_topppa_export_settings', [$this, 'ajax_export_settings']);
        add_action('wp_ajax_topppa_import_settings', [$this, 'ajax_import_settings']);
        add_action('wp_ajax_topppa_reset_settings', [$this, 'ajax_reset_settings']);
    }

    /**
     * Get all plugin settings grouped by category
     * 
     * @return array
     */
    public function get_all_settings() {
        $settings = [
            'export_info' => [
                'plugin_version' => TOPPPA_VER,
                'export_date' => current_time('Y-m-d H:i:s'),
                'site_url' => get_site_url(),
                'wp_version' => get_bloginfo('version'),
                'elementor_version' => defined('ELEMENTOR_VERSION') ? ELEMENTOR_VERSION : 'Not installed'
            ],
            'widgets' => $this->get_widget_settings(),
            'extensions' => $this->get_extension_settings(),
            'features' => $this->get_feature_settings(),
            'api_settings' => $this->get_api_settings(),
            'custom_settings' => $this->get_custom_settings()
        ];

        return apply_filters('topppa_export_settings', $settings);
    }

    /**
     * Get widget settings dynamically from plugin configuration
     * 
     * @return array
     */
    private function get_widget_settings() {
        $widget_settings = [];
        
        // Get widget IDs from the plugin registration array
        $widget_ids = $this->get_registered_widget_ids();
        
        foreach ($widget_ids as $widget_id) {
            $widget_settings[$widget_id] = get_option($widget_id, 'no');
        }

        return $widget_settings;
    }

    /**
     * Get extension settings dynamically from plugin configuration
     * 
     * @return array
     */
    private function get_extension_settings() {
        $extension_settings = [];
        
        // Get extension IDs from the plugin registration
        $extension_ids = $this->get_registered_extension_ids();
        
        foreach ($extension_ids as $extension_id) {
            $extension_settings[$extension_id] = get_option($extension_id, 'no');
        }

        return $extension_settings;
    }

    /**
     * Get feature settings dynamically from plugin configuration
     * 
     * @return array
     */
    private function get_feature_settings() {
        $feature_settings = [];
        
        // Get feature IDs from the plugin registration
        $feature_ids = $this->get_registered_feature_ids();
        
        foreach ($feature_ids as $feature_id) {
            $feature_settings[$feature_id] = get_option($feature_id, 'no');
        }

        return $feature_settings;
    }

    /**
     * Get registered widget IDs from the plugin's widget configuration
     * 
     * @return array
     */
    private function get_registered_widget_ids() {
        // Try to get from the plugin class if available
        if (class_exists('\TopperPack\Plugin')) {
            $reflection = new \ReflectionClass('\TopperPack\Plugin');
            if ($reflection->hasMethod('get_widget_configuration')) {
                $plugin_instance = \TopperPack\Plugin::instance();
                return array_keys($plugin_instance->get_widget_configuration());
            }
        }

        // Dynamic approach: scan database for widget options
        return $this->get_dynamic_widget_ids();
    }

    /**
     * Get registered extension IDs from the plugin's extension configuration
     * 
     * @return array
     */
    private function get_registered_extension_ids() {
        // Try to get from the plugin class if available
        if (class_exists('\TopperPack\Plugin')) {
            $reflection = new \ReflectionClass('\TopperPack\Plugin');
            if ($reflection->hasMethod('get_extension_configuration')) {
                $plugin_instance = \TopperPack\Plugin::instance();
                return array_keys($plugin_instance->get_extension_configuration());
            }
        }

        // Dynamic approach: scan database for extension options
        return $this->get_dynamic_extension_ids();
    }

    /**
     * Get registered feature IDs from the plugin's feature configuration
     * 
     * @return array
     */
    private function get_registered_feature_ids() {
        // Dynamic approach: scan for feature options
        return $this->get_dynamic_feature_ids();
    }

    /**
     * Dynamically detect widget IDs from database and file system
     * 
     * @return array
     */
    private function get_dynamic_widget_ids() {
        $widget_ids = [];

        // Method 1: Scan database for widget options
        $db_widget_ids = $this->scan_database_for_widgets();
        
        // Method 2: Scan widget files directory
        $file_widget_ids = $this->scan_widget_files();
        
        // Method 3: Get from existing dashboard arrays (if available)
        $dashboard_widget_ids = $this->extract_widget_ids_from_dashboard();

        // Merge all sources and remove duplicates
        $widget_ids = array_unique(array_merge($db_widget_ids, $file_widget_ids, $dashboard_widget_ids));

        // Allow filtering for extensibility
        return apply_filters('topppa_registered_widget_ids', $widget_ids);
    }

    /**
     * Dynamically detect extension IDs from database and plugin structure
     * 
     * @return array
     */
    private function get_dynamic_extension_ids() {
        $extension_ids = [];

        // Method 1: Scan database for extension options
        $db_extension_ids = $this->scan_database_for_extensions();
        
        // Method 2: Scan extensions directory
        $file_extension_ids = $this->scan_extension_files();
        
        // Method 3: Get from existing dashboard arrays (if available)
        $dashboard_extension_ids = $this->extract_extension_ids_from_dashboard();

        // Merge all sources and remove duplicates
        $extension_ids = array_unique(array_merge($db_extension_ids, $file_extension_ids, $dashboard_extension_ids));

        // Allow filtering for extensibility
        return apply_filters('topppa_registered_extension_ids', $extension_ids);
    }

    /**
     * Dynamically detect feature IDs from database and plugin structure
     * 
     * @return array
     */
    private function get_dynamic_feature_ids() {
        $feature_ids = [];

        // Method 1: Scan database for feature options
        $db_feature_ids = $this->scan_database_for_features();
        
        // Method 2: Scan includes directory for feature folders
        $file_feature_ids = $this->scan_feature_files();

        // Merge all sources and remove duplicates
        $feature_ids = array_unique(array_merge($db_feature_ids, $file_feature_ids));

        // Allow filtering for extensibility
        return apply_filters('topppa_registered_feature_ids', $feature_ids);
    }

    /**
     * Scan database for widget options
     * 
     * @return array
     */
    private function scan_database_for_widgets() {
        $widget_ids = [];
        $all_options = $this->get_all_topppa_options();

        foreach ($all_options as $option_name => $option_value) {
            // Widget options typically end with '_widget'
            if (preg_match('/^topppa_.*_widget$/', $option_name)) {
                $widget_ids[] = $option_name;
            }
        }

        return $widget_ids;
    }

    /**
     * Scan widget files directory to detect available widgets
     * 
     * @return array
     */
    private function scan_widget_files() {
        $widget_ids = [];
        
        // Scan free plugin widgets
        if (defined('TOPPPA_WIDGETS_PATH') && is_dir(TOPPPA_WIDGETS_PATH)) {
            $widget_files = glob(TOPPPA_WIDGETS_PATH . 'topppa-*-widget.php');
            
            foreach ($widget_files as $file) {
                $filename = basename($file, '.php');
                // Convert filename to option name: topppa-logo-widget.php -> topppa_logo_widget
                $widget_id = str_replace('-', '_', $filename);
                $widget_ids[] = $widget_id;
            }
        }

        // Scan pro plugin widgets (if available)
        if (defined('TOPPPA_PRO_WIDGETS_PATH') && is_dir(TOPPPA_PRO_WIDGETS_PATH)) {
            $pro_widget_files = glob(TOPPPA_PRO_WIDGETS_PATH . 'topppa-*-widget*.php');
            
            foreach ($pro_widget_files as $file) {
                $filename = basename($file, '.php');
                
                // Handle different pro widget naming patterns
                if (strpos($filename, '-pro') !== false) {
                    // Pro version of lite widget: topppa-blog-widget-pro.php -> topppa_blog_widget
                    $widget_id = str_replace(['-pro', '-'], ['', '_'], $filename);
                } else {
                    // Exclusive pro widget: topppa-project-widget.php -> topppa_project_widget
                    $widget_id = str_replace('-', '_', $filename);
                }
                
                $widget_ids[] = $widget_id;
            }
        }

        return array_unique($widget_ids);
    }

    /**
     * Scan database for extension options
     * 
     * @return array
     */
    private function scan_database_for_extensions() {
        $extension_ids = [];
        $all_options = $this->get_all_topppa_options();

        // Known extension patterns (Free + Pro)
        $extension_patterns = [
            '/^topppa_.*_section$/',      // e.g., topppa_sticky_section, topppa_tooltip_section
            '/^topppa_.*_effect$/',       // e.g., topppa_cursor_effect, topppa_reveal_effect (Pro)
            '/^topppa_.*_animation$/',    // e.g., topppa_split_text_animation (Pro), topppa_wow_animation (Pro)
            '/^topppa_custom_css$/',      // topppa_custom_css
            '/^topppa_scroll_to_top$/',   // topppa_scroll_to_top
            '/^topppa_wrapper_link$/',    // topppa_wrapper_link
            '/^topppa_conditional_display$/', // topppa_conditional_display
            '/^topppa_grid_line$/',       // topppa_grid_line (Pro)
            '/^interactive_animations$/', // interactive_animations (legacy name)
            '/^topppa_reveal_effect$/',   // topppa_reveal_effect (Pro)
            '/^topppa_split_text_animation$/', // topppa_split_text_animation (Pro)
            '/^topppa_wow_animation$/',   // topppa_wow_animation (Pro)
        ];

        foreach ($all_options as $option_name => $option_value) {
            // Skip widget and feature options
            if (preg_match('/^topppa_.*_widget$/', $option_name) || 
                in_array($option_name, ['topppa_custom_icon', 'topppa_smooth_scroller', 'topppa_mega_menu', 'topppa_template_library', 'topppa_cpt_builder'])) {
                continue;
            }

            // Check against extension patterns
            foreach ($extension_patterns as $pattern) {
                if (preg_match($pattern, $option_name)) {
                    $extension_ids[] = $option_name;
                    break;
                }
            }
        }

        return $extension_ids;
    }

    /**
     * Scan extensions directory for available extensions
     * 
     * @return array
     */
    private function scan_extension_files() {
        $extension_ids = [];
        
        // Scan free plugin extensions
        if (defined('TOPPPA_EXTENSIONS_PATH') && is_dir(TOPPPA_EXTENSIONS_PATH)) {
            $this->scan_extension_directory(TOPPPA_EXTENSIONS_PATH, $extension_ids);
        }

        // Scan pro plugin extensions (if available)
        if (defined('TOPPPA_PRO_EXTENSIONS_PATH') && is_dir(TOPPPA_PRO_EXTENSIONS_PATH)) {
            $this->scan_extension_directory(TOPPPA_PRO_EXTENSIONS_PATH, $extension_ids);
        }

        return array_unique($extension_ids);
    }

    /**
     * Helper method to scan a single extension directory
     * 
     * @param string $extensions_path
     * @param array &$extension_ids
     * @return void
     */
    private function scan_extension_directory($extensions_path, &$extension_ids) {
        // Scan for PHP files and directories in extensions folder
        $extension_files = array_merge(
            glob($extensions_path . '*.php'),
            glob($extensions_path . '*/', GLOB_ONLYDIR)
        );

        foreach ($extension_files as $file) {
            $basename = basename($file, '.php');
            
            // Convert filename to option name
            if (is_dir($file)) {
                // Directory: scroll-to-top/ -> topppa_scroll_to_top
                $extension_id = 'topppa_' . str_replace('-', '_', rtrim($basename, '/'));
            } else {
                // File: custom-css.php -> topppa_custom_css
                $extension_id = 'topppa_' . str_replace('-', '_', $basename);
            }

            // Special cases for known extensions
            $extension_mapping = [
                'topppa_interactive_animations' => 'interactive_animations',
                'topppa_hover_effect' => 'topppa_container_hover_effects',
                'topppa_wow_animation' => 'topppa_wow_animation', // Pro extension
            ];

            if (isset($extension_mapping[$extension_id])) {
                $extension_id = $extension_mapping[$extension_id];
            }

            $extension_ids[] = $extension_id;
        }
    }

    /**
     * Scan database for feature options
     * 
     * @return array
     */
    private function scan_database_for_features() {
        $feature_ids = [];
        $all_options = $this->get_all_topppa_options();

        // Known feature option names (Free + Pro)
        $known_features = [
            // Free features
            'topppa_assets_manager',      // Assets Manager - combine JS/CSS files
            'topppa_custom_icon',         // Custom Icon feature
            'topppa_smooth_scroller',     // Smooth Scroller feature
            'topppa_mega_menu',           // Mega Menu feature  
            'topppa_template_library',    // Template Library (In Editor)
            'topppa_theme_builder',       // Theme Builder (Free feature)
            // Pro features  
            'topppa_custom_font',         // Custom Font feature (Pro)
            'topppa_cpt_builder',         // Custom Post Type Builder (Pro)
        ];

        foreach ($known_features as $feature) {
            if (isset($all_options[$feature])) {
                $feature_ids[] = $feature;
            }
        }

        return $feature_ids;
    }

    /**
     * Scan includes directory for feature folders
     * 
     * @return array
     */
    private function scan_feature_files() {
        $feature_ids = [];
        
        // Scan free plugin features
        if (defined('TOPPPA_INC_PATH') && is_dir(TOPPPA_INC_PATH)) {
            $this->scan_feature_directory(TOPPPA_INC_PATH, $feature_ids);
        }

        // Scan pro plugin features (if available)
        if (defined('TOPPPA_PRO_INC_PATH') && is_dir(TOPPPA_PRO_INC_PATH)) {
            $this->scan_pro_feature_directory(TOPPPA_PRO_INC_PATH, $feature_ids);
        }

        // Check for CPT builder (can be in either plugin)
        if (get_option('topppa_cpt_builder') !== false) {
            $feature_ids[] = 'topppa_cpt_builder';
        }

        return array_unique($feature_ids);
    }

    /**
     * Helper method to scan free plugin features directory
     * 
     * @param string $includes_path
     * @param array &$feature_ids
     * @return void
     */
    private function scan_feature_directory($includes_path, &$feature_ids) {
        // Look for feature directories with init.php files
        $feature_dirs = [
            'custom-icon' => 'topppa_custom_icon',
            'smooth-scroller' => 'topppa_smooth_scroller',
            'mega-menu' => 'topppa_mega_menu',
            'template-library' => 'topppa_template_library',
            'theme-builder' => 'topppa_theme_builder', // Theme builder is a free feature
        ];
        
        // Assets manager is a general plugin feature, not a separate directory
        if (get_option('topppa_assets_manager') !== false) {
            $feature_ids[] = 'topppa_assets_manager';
        }

        foreach ($feature_dirs as $dir => $option_name) {
            $feature_path = $includes_path . $dir . '/init.php';
            if (file_exists($feature_path)) {
                $feature_ids[] = $option_name;
            }
        }
    }

    /**
     * Helper method to scan pro plugin features directory
     * 
     * @param string $pro_includes_path
     * @param array &$feature_ids
     * @return void
     */
    private function scan_pro_feature_directory($pro_includes_path, &$feature_ids) {
        // Look for pro feature directories with init.php files
        $pro_feature_dirs = [
            'cpt-builder' => 'topppa_cpt_builder',
            'custom-font' => 'topppa_custom_font',
            // theme-builder removed - it's actually a free feature
        ];

        foreach ($pro_feature_dirs as $dir => $option_name) {
            $feature_path = $pro_includes_path . $dir . '/init.php';
            if (file_exists($feature_path)) {
                $feature_ids[] = $option_name;
            }
        }
    }

    /**
     * Extract widget IDs from dashboard arrays (if function exists)
     * 
     * @return array
     */
    private function extract_widget_ids_from_dashboard() {
        $widget_ids = [];

        // Try to get from dashboard configuration via reflection or hooks
        if (function_exists('topppa_get_dashboard_widget_config')) {
            $config = topppa_get_dashboard_widget_config();
            if (is_array($config)) {
                foreach ($config as $widget) {
                    if (isset($widget[1])) { // widget[1] is the option name
                        $widget_ids[] = $widget[1];
                    }
                }
            }
        }

        return $widget_ids;
    }

    /**
     * Extract extension IDs from dashboard arrays (if function exists)
     * 
     * @return array
     */
    private function extract_extension_ids_from_dashboard() {
        $extension_ids = [];

        // Try to get from dashboard configuration via reflection or hooks
        if (function_exists('topppa_get_dashboard_extension_config')) {
            $config = topppa_get_dashboard_extension_config();
            if (is_array($config)) {
                foreach ($config as $extension) {
                    if (isset($extension[1])) { // extension[1] is the option name
                        $extension_ids[] = $extension[1];
                    }
                }
            }
        }

        return $extension_ids;
    }

    /**
     * Get all options that start with 'topppa_' prefix
     * 
     * @return array
     */
    private function get_all_topppa_options() {
        global $wpdb;
        
        // phpcs:disable WordPress.DB.DirectDatabaseQuery.DirectQuery, WordPress.DB.DirectDatabaseQuery.NoCaching
        // Get all options that start with 'topppa_'
        $results = $wpdb->get_results(
            $wpdb->prepare(
                "SELECT option_name, option_value FROM {$wpdb->options} WHERE option_name LIKE %s",
                'topppa_%'
            ),
            ARRAY_A
        );
        // phpcs:enable WordPress.DB.DirectDatabaseQuery.DirectQuery, WordPress.DB.DirectDatabaseQuery.NoCaching

        $options = [];
        if ($results) {
            foreach ($results as $row) {
                $options[$row['option_name']] = maybe_unserialize($row['option_value']);
            }
        }

        return $options;
    }

    /**
     * Define plugin paths for dynamic scanning
     * 
     * @return void
     */
    private function define_plugin_paths() {
        $plugin_root = dirname(dirname(dirname(__FILE__))); // Go up to topper-pack root
        
        // Free plugin paths
        if (!defined('TOPPPA_WIDGETS_PATH')) {
            define('TOPPPA_WIDGETS_PATH', $plugin_root . '/widgets/');
        }
        
        if (!defined('TOPPPA_EXTENSIONS_PATH')) {
            define('TOPPPA_EXTENSIONS_PATH', $plugin_root . '/extensions/');
        }
        
        if (!defined('TOPPPA_INC_PATH')) {
            define('TOPPPA_INC_PATH', $plugin_root . '/includes/');
        }

        // Pro plugin paths (if pro plugin exists)
        $pro_plugin_root = dirname(dirname(dirname(dirname(__FILE__)))) . '/topper-pack-pro';
        
        if (is_dir($pro_plugin_root)) {
            if (!defined('TOPPPA_PRO_WIDGETS_PATH')) {
                define('TOPPPA_PRO_WIDGETS_PATH', $pro_plugin_root . '/widgets/');
            }
            
            if (!defined('TOPPPA_PRO_EXTENSIONS_PATH')) {
                define('TOPPPA_PRO_EXTENSIONS_PATH', $pro_plugin_root . '/extensions/');
            }
            
            if (!defined('TOPPPA_PRO_INC_PATH')) {
                define('TOPPPA_PRO_INC_PATH', $pro_plugin_root . '/includes/');
            }
        }
    }

    /**
     * Get API settings (Free + Pro)
     * 
     * @return array
     */
    private function get_api_settings() {
        $api_settings = [];
        
        // All API settings from both free and pro plugins
        $all_api_settings = [
            // Google Maps API
            'topppa_google_maps_api_key',
            
            // Facebook API (Pro)
            'topppa_facebook_id',
            'topppa_facebook_token',
            'topppa_facebook_app_id', // Legacy
            
            // reCAPTCHA (Pro)
            'topppa_recaptcha_site_key',
            'topppa_recaptcha_secret_key',
            
            // Twitter API (Pro)
            'topppa_twitter_uname',
            'topppa_twitter_key',
            'topppa_twitter_secret_key',
            'topppa_twitter_access_token',
            'topppa_twitter_access_token_secret',
            'topppa_twitter_api_key', // Legacy
            
            // Mailchimp API (Pro)
            'topppa_mailchimp_key',
            'topppa_mailchimp_id',
            'topppa_mailchimp_api_key', // Legacy
            
            // Instagram API (Pro)
            'topppa_instagram_app_id',
            'topppa_instagram_app_secret',
            'topppa_instagram_access_token',
        ];

        foreach ($all_api_settings as $setting) {
            $value = get_option($setting, '');
            if (!empty($value)) {
                $api_settings[$setting] = $value;
            }
        }

        // Also get any options that start with topppa_api_
        $all_options = wp_load_alloptions();
        foreach ($all_options as $option_name => $option_value) {
            if (strpos($option_name, 'topppa_api_') === 0) {
                $api_settings[$option_name] = $option_value;
            }
        }

        return $api_settings;
    }

    /**
     * Get custom/miscellaneous settings
     * 
     * EXPORTS: User preferences like topppa_assets_manager, custom configurations
     * EXCLUDES: Cache data, template library data, session data, logs for optimal file size
     * 
     * @return array
     */
    private function get_custom_settings() {
        $custom_settings = [];
        
        // Get all topppa_ prefixed options
        $all_topppa_options = $this->get_all_topppa_options();
        
        // Get covered options to exclude them
        $covered_options = array_merge(
            array_keys($this->get_widget_settings()),
            array_keys($this->get_extension_settings()),
            array_keys($this->get_feature_settings()),
            array_keys($this->get_api_settings())
        );

        // Options to exclude from export (cache data, library data, temporary data)
        $excluded_options = [
            'tpp_fs_api_cache',     // Freemius cache
            'tpp_fs_accounts',      // Freemius accounts 
            'topppa_library_info',     // Template library cache data (HUGE - not user settings)
            'topppa_library_cache',    // Template library cache
            'topppa_library_last_update', // Library update timestamp
            'topppa_remote_templates', // Remote template cache
            'topppa_template_cache',   // Template cache data
            'topppa_import_logs',      // Import operation logs
            'topppa_temp_data',        // Temporary data
            'topppa_session_data'      // Session data
        ];

        foreach ($all_topppa_options as $option_name => $option_value) {
            if (!in_array($option_name, $covered_options) &&
                !in_array($option_name, $excluded_options)) {
                $custom_settings[$option_name] = $option_value;
            }
        }

        return $custom_settings;
    }

    /**
     * Export settings to JSON
     * 
     * @return string JSON string
     */
    public function export_settings() {
        $settings = $this->get_all_settings();
        return wp_json_encode($settings, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }

    /**
     * Import settings from JSON
     * 
     * @param string $json_data JSON string
     * @return array Result with success status and message
     */
    public function import_settings($json_data) {
        // Decode JSON
        $settings = json_decode($json_data, true);
        
        if (json_last_error() !== JSON_ERROR_NONE) {
            return [
                'success' => false,
                'message' => __('Invalid JSON format: ', 'topper-pack') . json_last_error_msg()
            ];
        }

        // Validate settings structure
        $validation = $this->validate_import_data($settings);
        if (!$validation['valid']) {
            return [
                'success' => false,
                'message' => $validation['message']
            ];
        }

        // Track import results
        $import_results = [
            'widgets' => 0,
            'extensions' => 0,
            'features' => 0,
            'api_settings' => 0,
            'custom_settings' => 0,
            'skipped' => 0
        ];

        // Import each category
        if (isset($settings['widgets'])) {
            $import_results['widgets'] = $this->import_category_settings($settings['widgets']);
        }

        if (isset($settings['extensions'])) {
            $import_results['extensions'] = $this->import_category_settings($settings['extensions']);
        }

        if (isset($settings['features'])) {
            $import_results['features'] = $this->import_category_settings($settings['features']);
        }

        if (isset($settings['api_settings'])) {
            $import_results['api_settings'] = $this->import_category_settings($settings['api_settings']);
        }

        if (isset($settings['custom_settings'])) {
            $import_results['custom_settings'] = $this->import_category_settings($settings['custom_settings']);
        }

        // Clear any relevant caches
        wp_cache_flush();
        
        do_action('topppa_settings_imported', $settings, $import_results);

        $total_imported = array_sum(array_filter($import_results, 'is_numeric'));
        return [
            'success' => true,
            'message' => sprintf(
                // translators: %1$d: total settings, %2$d: widgets, %3$d: extensions, %4$d: features, %5$d: API settings, %6$d: custom settings.
                __('Successfully imported %1$d settings. Widgets: %2$d, Extensions: %3$d, Features: %4$d, API Settings: %5$d, Custom: %6$d', 'topper-pack'),
                $total_imported,
                $import_results['widgets'],
                $import_results['extensions'],
                $import_results['features'],
                $import_results['api_settings'],
                $import_results['custom_settings']
            ),
            'details' => $import_results
        ];
    }

    /**
     * Import settings for a specific category
     * 
     * @param array $category_settings
     * @return int Number of settings imported
     */
    private function import_category_settings($category_settings) {
        $imported_count = 0;
        
        foreach ($category_settings as $option_name => $option_value) {
            if ($this->is_safe_to_import($option_name)) {
                update_option($option_name, $option_value);
                $imported_count++;
            }
        }

        return $imported_count;
    }

    /**
     * Validate import data structure
     * 
     * @param array $settings
     * @return array
     */
    private function validate_import_data($settings) {
        if (!is_array($settings)) {
            return [
                'valid' => false,
                // translators: Settings data must be an array.
                'message' => __('Settings data must be an array.', 'topper-pack')
            ];
        }

        // Check if it's a Topper Pack export
        if (!isset($settings['export_info'])) {
            return [
                'valid' => false,
                // translators: This does not appear to be a Topper Pack settings export file.
                'message' => __('This does not appear to be a Topper Pack settings export file.', 'topper-pack')
            ];
        }

        // Version compatibility check (optional warning)
        if (isset($settings['export_info']['plugin_version']) && 
            version_compare($settings['export_info']['plugin_version'], TOPPPA_VER, '>')) {
            // This is just a warning, not a blocking error
        }

        return [
            'valid' => true,
            // translators: Settings file is valid.
            'message' => __('Settings file is valid.', 'topper-pack')
        ];
    }

    /**
     * Check if option is safe to import
     * 
     * @param string $option_name
     * @return bool
     */
    private function is_safe_to_import($option_name) {
        // Blacklist certain options for security and performance
        $blacklisted_options = [
            // Freemius data
            'tpp_fs_api_cache',
            'tpp_fs_accounts',
            // License keys - security
            'topppa_license_key',
            'topppa_pro_license_key',
            // Cache and library data - performance (these should not be imported)
            'topppa_library_info',         // Template library cache data (HUGE)
            'topppa_library_cache',        // Template library cache
            'topppa_library_last_update',  // Library update timestamp
            'topppa_remote_templates',     // Remote template cache
            'topppa_template_cache',       // Template cache data
            'topppa_import_logs',          // Import operation logs
            'topppa_temp_data',            // Temporary data
            'topppa_session_data',         // Session data
            // Other cache data
            'topppa_transient_cache',
            'topppa_api_cache'
        ];

        if (in_array($option_name, $blacklisted_options)) {
            return false;
        }

        // Only allow topppa_ prefixed options
        if (strpos($option_name, self::OPTION_PREFIX) !== 0) {
            return false;
        }

        return true;
    }

    /**
     * Reset all plugin settings to defaults
     * 
     * @return array
     */
    public function reset_all_settings() {
        $all_settings = $this->get_all_settings();
        $reset_count = 0;

        // Reset each category
        foreach (['widgets', 'extensions', 'features', 'api_settings', 'custom_settings'] as $category) {
            if (isset($all_settings[$category])) {
                foreach (array_keys($all_settings[$category]) as $option_name) {
                    if ($this->is_safe_to_import($option_name)) {
                        delete_option($option_name);
                        $reset_count++;
                    }
                }
            }
        }

        wp_cache_flush();
        
        do_action('topppa_settings_reset');

        return [
            'success' => true,
            // translators: %d: number of settings reset.
            'message' => sprintf(__('Successfully reset %d settings to defaults.', 'topper-pack'), $reset_count),
            'count' => $reset_count
        ];
    }

    /**
     * AJAX handler for exporting settings
     */
    public function ajax_export_settings() {
        // Verify nonce
        if (!isset($_POST['nonce']) || !wp_verify_nonce(sanitize_text_field(wp_unslash($_POST['nonce'])), 'topppa_settings_nonce')) {
            // translators: Security check failed.
            wp_die(esc_html__('Security check failed.', 'topper-pack'));
        }

        // Check capabilities
        if (!current_user_can('manage_options')) {
            // translators: You do not have permission to perform this action.
            wp_die(esc_html__('You do not have permission to perform this action.', 'topper-pack'));
        }

        try {
            $json_data = $this->export_settings();
            
            wp_send_json_success([
                'data' => $json_data,
                'filename' => 'topper-pack-settings-' . gmdate('Y-m-d-H-i-s') . '.json'
            ]);
        } catch (Exception $e) {
            wp_send_json_error([
                // translators: Export failed: %s
                'message' => __('Export failed: ', 'topper-pack') . $e->getMessage()
            ]);
        }
    }

    /**
     * AJAX handler for importing settings
     */
    public function ajax_import_settings() {
        // Verify nonce
        if (!isset($_POST['nonce']) || !wp_verify_nonce(sanitize_text_field(wp_unslash($_POST['nonce'])), 'topppa_settings_nonce')) {
            wp_die(esc_html__('Security check failed.', 'topper-pack'));
        }

        // Check capabilities
        if (!current_user_can('manage_options')) {
            wp_die(esc_html__('You do not have permission to perform this action.', 'topper-pack'));
        }

        if (!isset($_POST['settings_data'])) {
            wp_send_json_error([
                // translators: No settings data provided.
                'message' => __('No settings data provided.', 'topper-pack')
            ]);
        }

        try {
            $result = $this->import_settings(sanitize_textarea_field(wp_unslash($_POST['settings_data'])));
            
            if ($result['success']) {
                wp_send_json_success($result);
            } else {
                wp_send_json_error($result);
            }
        } catch (Exception $e) {
            wp_send_json_error([
                // translators: Import failed: %s
                'message' => __('Import failed: ', 'topper-pack') . $e->getMessage()
            ]);
        }
    }

    /**
     * AJAX handler for resetting settings
     */
    public function ajax_reset_settings() {
        // Verify nonce
        if (!isset($_POST['nonce']) || !wp_verify_nonce(sanitize_text_field(wp_unslash($_POST['nonce'])), 'topppa_settings_nonce')) {
            // translators: Security check failed.
            wp_die(esc_html__('Security check failed.', 'topper-pack'));
        }

        // Check capabilities
        if (!current_user_can('manage_options')) {
            // translators: You do not have permission to perform this action.
            wp_die(esc_html__('You do not have permission to perform this action.', 'topper-pack'));
        }

        try {
            $result = $this->reset_all_settings();
            wp_send_json_success($result);
        } catch (Exception $e) {
            wp_send_json_error([
                // translators: Reset failed: %s
                'message' => __('Reset failed: ', 'topper-pack') . $e->getMessage()
            ]);
        }
    }
}

// Initialize the settings manager
new Settings_Manager(); 