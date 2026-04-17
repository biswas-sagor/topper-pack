<?php
/**
 * Ready Site Importer Class
 * Handles importing complete websites from server
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

class TOPPPA_Ready_Site_Importer {
    
    private $default_server_url = 'https://import.topperpack.com/readysite/';
    
    public function __construct() {
        add_action('admin_menu', array($this, 'add_ready_site_menu'));
        add_action('admin_enqueue_scripts', array($this, 'enqueue_scripts'));
        add_action('wp_ajax_topppa_fetch_ready_sites', array($this, 'fetch_ready_sites'));
        add_action('wp_ajax_topppa_fetch_categories', array($this, 'fetch_categories'));
        add_action('wp_ajax_topppa_import_ready_site', array($this, 'import_ready_site'));
    }
    
    /**
     * Get the server URL with filters for customization
     */
    private function get_server_url() {
        return apply_filters('topppa_ready_sites_server_url', $this->default_server_url);
    }
    
    /**
     * Get API key for server authentication
     */
    private function get_api_key() {
        return apply_filters('topppa_ready_sites_api_key', 'CuuqfD7vHlO+Q71A+3AxKEcFNmzd40kgVT6wB5Z+x5E=');
    }
    
    /**
     * Add Ready Sites submenu
     */
    public function add_ready_site_menu() {
        add_submenu_page(
            'topper-pack',
            'Ready Sites',
            'Ready Sites',
            'manage_options',
            'topppa-ready-sites',
            array($this, 'ready_site_page')
        );
    }
    
    /**
     * Enqueue scripts and styles
     */
    public function enqueue_scripts($hook) {
        if ($hook !== 'topper-pack_page_topppa-ready-sites') {
            return;
        }
        
        wp_enqueue_script(
            'topppa-ready-sites',
            TOPPPA_URL . 'admin/assets/js/topppa-ready-sites.min.js',
            array('jquery'),
            TOPPPA_VER,
            true
        );
        
        wp_enqueue_style(
            'topppa-ready-sites',
            TOPPPA_URL . 'admin/assets/css/topppa-ready-sites.css',
            array(),
            TOPPPA_VER
        );
        
        wp_localize_script('topppa-ready-sites', 'topppaReadySites', array(
            'ajaxurl' => admin_url('admin-ajax.php'),
            'nonce' => wp_create_nonce('topppa_ready_sites_nonce'),
            'plugin_url' => TOPPPA_URL
        ));
    }
    
    /**
     * Ready Sites page content
     */
    public function ready_site_page() {
        ?>
        <div class="topppa-readysite">
            <h1 class="wp-heading-inline"><?php esc_html_e( 'Welcome to Topper Pack Ready Sites', 'topper-pack' ); ?></h1>
            <p class="description">
                <?php echo wp_kses_post(
                    __( 'Import complete websites with content, settings, and Elementor configurations. <br> <strong style="color: #ff0000;">Note: please click the refresh button if you don\'t see the content.</strong>', 'topper-pack' )
                ); ?>
            </p>
            
            <div class="topppa-readysite-header">
                <div class="topppa-readysite-filters-row">
                    <!-- Combined Filters -->
                    <div class="topppa-readysite-filter-group">
                        <!-- Version Dropdown -->
                        <div class="topppa-filter-dropdown">
                            <select id="topppa-version-filter" class="topppa-filter-select">
                                <option value="all" selected><?php esc_html_e( 'All Versions', 'topper-pack' ); ?></option>
                                <option value="free"><?php esc_html_e( 'Free Only', 'topper-pack' ); ?></option>
                                <option value="pro"><?php esc_html_e( 'Pro Only', 'topper-pack' ); ?></option>
                            </select>
                </div>
                
                        <!-- Category Tabs -->
                        <div class="topppa-readysite-filter-tabs" id="topppa-readysite-filter-tabs">
                            <!-- Categories will be loaded here via AJAX -->
                            <button class="topppa-readysite-filter-tab active" data-category="all" data-base-text="<?php esc_attr__( 'All Sites', 'topper-pack' ); ?>"><?php esc_html_e( 'All Sites', 'topper-pack' ); ?></button>
                        </div>
                    </div>
                    
                    <!-- Search Box and Refresh Button -->
                    <div style="display: flex; align-items: center; gap: 12px;">
                        <div class="topppa-readysite-search-box">
                            <input type="text" id="topppa-readysite-search" placeholder="<?php esc_attr__( 'Search sites...', 'topper-pack' ); ?>" />
                            <span class="dashicons dashicons-search"></span>
                        </div>
                        
                        <div class="topppa-readysite-refresh-btn">
                            <button type="button" id="topppa-readysite-refresh" class="button" title="Refresh sites data">
                                <span class="dashicons dashicons-update"></span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="topppa-readysite-loading" id="topppa-readysite-loading">
                <div class="topppa-readysite-spinner"></div>
                <p><?php esc_html_e( 'Loading ready sites...', 'topper-pack' ); ?></p>
            </div>
            
            <div class="topppa-readysite-sites-grid" id="topppa-readysite-sites-grid">
                <!-- Sites will be loaded here via AJAX -->
            </div>
            
            <!-- Pagination -->
            <div class="topppa-readysite-pagination" id="topppa-readysite-pagination" style="display: none;">
                <div class="topppa-pagination-info" id="topppa-pagination-info"></div>
                <div class="topppa-pagination-controls"></div>
            </div>
            
            <div class="topppa-readysite-no-results" id="topppa-readysite-no-results" style="display: none;">
                <div class="topppa-readysite-no-results-icon">🔍</div>
                <h3><?php esc_html_e( 'No sites found', 'topper-pack' ); ?></h3>
                <p><?php esc_html_e( 'Try adjusting your search or filter criteria.', 'topper-pack' ); ?></p>
            </div>
        </div>
        
        <!-- Import Modal -->
        <div id="topppa-readysite-import-modal" class="topppa-readysite-modal" style="display: none;">
            <div class="topppa-readysite-modal-content">
                <div class="topppa-readysite-modal-header">
                    <h2 id="topppa-readysite-modal-title"><?php esc_html_e( 'Import Ready Site', 'topper-pack' ); ?></h2>
                    <span class="topppa-readysite-modal-close">&times;</span>
                </div>
                
                <div class="topppa-readysite-modal-body">
                    <div class="topppa-readysite-preview">
                        <img id="topppa-readysite-modal-image" src="" alt="" />
                        <div class="topppa-readysite-info">
                            <h3 id="topppa-readysite-modal-site-title"></h3>
                            <p id="topppa-readysite-modal-description"></p>
                            <div class="topppa-readysite-modal-category">
                                <span class="category-label"><?php esc_html_e( 'Category:', 'topper-pack' ); ?></span>
                                <span id="topppa-readysite-modal-category"></span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="topppa-readysite-import-options">
                        <h4><?php esc_html_e( 'Import Options', 'topper-pack' ); ?></h4>
                        <label class="topppa-readysite-checkbox">
                            <input type="checkbox" id="topppa-readysite-content-option" checked />
                            <span class="topppa-readysite-checkmark"></span>
                            <?php esc_html_e( 'Import content (posts, pages, media)', 'topper-pack' ); ?>
                        </label>
                        
                        <label class="topppa-readysite-checkbox">
                            <input type="checkbox" id="topppa-readysite-settings-option" checked />
                            <span class="topppa-readysite-checkmark"></span>
                            <?php esc_html_e( 'Import plugin settings', 'topper-pack' ); ?>
                        </label>
                        
                        <label class="topppa-readysite-checkbox">
                            <input type="checkbox" id="topppa-readysite-elementor-option" checked />
                            <span class="topppa-readysite-checkmark"></span>
                            <?php esc_html_e( 'Import Elementor settings', 'topper-pack' ); ?>
                        </label>
                    </div>
                    
                    <div class="topppa-readysite-import-info">
                        <span class="dashicons dashicons-info"></span>
                        <strong><?php esc_html_e( 'Note:', 'topper-pack' ); ?></strong> <?php esc_html_e( 'This will import the selected ready site components into your WordPress installation.', 'topper-pack' ); ?>
                    </div>
                </div>
                
                <div class="topppa-readysite-modal-footer">
                    <button type="button" class="button" id="topppa-readysite-modal-cancel"><?php esc_html_e( 'Cancel', 'topper-pack' ); ?></button>
                    <button type="button" class="button button-primary" id="topppa-readysite-start-import"><?php esc_html_e( 'Start Import', 'topper-pack' ); ?></button>
                </div>
            </div>
        </div>
        
        <!-- Progress Modal -->
        <div id="topppa-readysite-progress-modal" class="topppa-readysite-modal" style="display: none;">
            <div class="topppa-readysite-modal-content">
                <div class="topppa-readysite-modal-header">
                   <h2><?php esc_html_e( 'Importing Ready Demo Site', 'topper-pack' ); ?></h2>
                </div>
                
                <div class="topppa-readysite-modal-body">
                    <div class="topppa-readysite-progress-container">
                        <div class="topppa-readysite-progress-bar">
                            <div class="topppa-readysite-progress-fill" id="topppa-readysite-progress-fill"></div>
                        </div>
                        <div class="topppa-readysite-progress-text" id="topppa-readysite-progress-text"><?php esc_html_e( 'Preparing import...', 'topper-pack' ); ?></div>
                    </div>
                    
                    <div class="topppa-readysite-import-steps" id="topppa-readysite-import-steps">
                        <!-- Import steps will be shown here -->
                    </div>
                </div>
            </div>
        </div>
        <?php
    }
    
    /**
     * Fetch ready sites via AJAX
     */
    public function fetch_ready_sites() {
        check_ajax_referer('topppa_ready_sites_nonce', 'nonce');
        
        if (!current_user_can('manage_options')) {
            wp_send_json_error('Unauthorized');
        }
        
        $category = sanitize_text_field(wp_unslash($_POST['category'] ?? ''));
        
        // Build API URL with cache-busting parameters
        $api_url = $this->get_server_url() . 'list.php';
        $params = array();
        
        // Add API key for authentication
        $params['api_key'] = $this->get_api_key();
        
        if (!empty($category)) {
            $params['category'] = urlencode($category);
        }
        
        // Add cache-busting parameters
        $params['t'] = time(); // Current timestamp
        $params['v'] = TOPPPA_VER; // Plugin version
        $params['r'] = wp_generate_password(8, false); // Random string
        
        // Build query string
        if (!empty($params)) {
            $api_url .= '?' . http_build_query($params);
        }
        
        // Fetch from your server API with retry logic and better timeout
        $response = null;
        $max_attempts = 3;
        
        for ($attempt = 1; $attempt <= $max_attempts; $attempt++) {
            $response = wp_remote_get($api_url, array(
                'timeout' => 45 + ($attempt * 15), // Increase timeout each attempt
                'sslverify' => ($attempt === 1), // Try SSL first, then disable
                'httpversion' => '1.1',
                'blocking' => true,
                'headers' => array(
                    'User-Agent' => 'TopperPack/' . TOPPPA_VER . ' (Attempt ' . $attempt . ')',
                    'Cache-Control' => 'no-cache, no-store, must-revalidate',
                    'Pragma' => 'no-cache',
                    'Expires' => '0'
                )
            ));
            
            // If successful, break out of retry loop
            if (!is_wp_error($response)) {
                break;
            }
            
            $error_message = $response->get_error_message();
            
            // If it's a connection error and we have more attempts, retry
            if (strpos($error_message, 'cURL error') !== false && $attempt < $max_attempts) {
                sleep(2 * $attempt); // Wait before retry
                continue;
            }
            
            // If it's not a connection error or we're out of attempts, break
            break;
        }
        
        // Handle API errors with proper error messages
        if (is_wp_error($response)) {
            // Return error message instead of fallback
            wp_send_json_error('Server connection failed: ' . $response->get_error_message());
            return;
        }
        
        $response_code = wp_remote_retrieve_response_code($response);
        if ($response_code !== 200) {
            // Return error message instead of fallback
            wp_send_json_error('Server returned error code: ' . $response_code);
            return;
        }
        
        // Parse response
        $body = wp_remote_retrieve_body($response);
        $response_data = json_decode($body, true);
        
        if (!is_array($response_data)) {
            wp_send_json_error('Invalid server response format');
            return;
        }
        
        // Extract sites array from server response
        $sites = isset($response_data['sites']) && is_array($response_data['sites']) 
            ? $response_data['sites'] 
            : $response_data;
        
        // Process each site to detect free/pro status
        $processed_sites = array();
        foreach ($sites as $site) {
            $processed_site = $this->process_site_data($site);
            $processed_sites[] = $processed_site;
        }
        
        wp_send_json_success($processed_sites);
    }
    
    /**
     * Process site data to detect free/pro status and standardize format
     */
    private function process_site_data($site) {
        // Ensure site is an array
        if (!is_array($site)) {
            return $site;
        }
        
        // Default values
        $defaults = array(
            'id' => '',
            'title' => '',
            'description' => '',
            'category' => '',
            'preview_image' => '',
            'demo_url' => '#',
            'is_pro' => false
        );
        
        $site = array_merge($defaults, $site);
        
        // Detect free/pro status from multiple sources
        $is_pro = false;
        
        // Method 1: Check if server provides type or license_type
        if (isset($site['type'])) {
            $is_pro = (strtolower($site['type']) === 'pro');
        } elseif (isset($site['license_type'])) {
            $is_pro = (strtolower($site['license_type']) === 'pro');
        } elseif (isset($site['is_pro'])) {
            $is_pro = (bool) $site['is_pro'];
        }
        
        // Method 2: Check folder path structure
        if (!$is_pro && isset($site['path'])) {
            $is_pro = (strpos($site['path'], '/pro/') !== false);
        }
        
        // Method 3: Check download URL or source path
        if (!$is_pro) {
            $url_fields = array('download_url', 'source_url', 'zip_url', 'preview_image');
            foreach ($url_fields as $field) {
                if (isset($site[$field]) && strpos($site[$field], '/pro/') !== false) {
                    $is_pro = true;
                    break;
                }
            }
        }
        
        // Method 4: Check site ID for pro indicator (specific pattern matching)
        if (!$is_pro && isset($site['id'])) {
            $id_lower = strtolower($site['id']);
            // Only mark as pro if it contains specific pro patterns with separators
            $pro_patterns = array(
                '/^pro[-_]/',           // starts with pro- or pro_
                '/[-_]pro$/',           // ends with -pro or _pro
                '/[-_]pro[-_]/',        // contains -pro- or _pro_
                '/^pro$/',              // exactly "pro"
            );
            
            foreach ($pro_patterns as $pattern) {
                if (preg_match($pattern, $id_lower)) {
                    $is_pro = true;
                    break;
                }
            }
        }
        
        // Method 5: Check category for pro indicator (smart detection)
        if (!$is_pro && isset($site['category'])) {
            $category_lower = strtolower(trim($site['category']));
            
            // Only mark as pro if category is EXACTLY one of these specific pro indicators
            // This prevents false positives from any category containing "pro"
            $exact_pro_indicators = array(
                'pro',
                'premium', 
                'premium sites',
                'pro sites', 
                'premium demos',
                'pro demos',
                'premium templates',
                'pro templates'
            );
            
            if (in_array($category_lower, $exact_pro_indicators)) {
                $is_pro = true;
            }
            // All other categories (including "non-profit", "professional", etc.) are treated as free
        }
        
        // Set the final is_pro status
        $site['is_pro'] = $is_pro;
        
        // Add access control information
        $site['can_access'] = !$is_pro || $this->can_access_pro_demos();
        $site['access_level'] = $site['can_access'] ? 'granted' : 'denied';
        
        // Ensure preview image has fallback
        if (empty($site['preview_image'])) {
            $site['preview_image'] = TOPPPA_URL . 'assets/images/fallback.webp';
        }
        
        return $site;
    }
    
    /**
     * Fetch available categories via AJAX
     */
    public function fetch_categories() {
        check_ajax_referer('topppa_ready_sites_nonce', 'nonce');
        
        if (!current_user_can('manage_options')) {
            wp_send_json_error('Unauthorized');
        }
        
        // Build API URL for sites (we'll extract categories from sites data) with cache-busting
        $api_url = $this->get_server_url() . 'list.php';
        
        // Add cache-busting parameters
        $params = array(
            'api_key' => $this->get_api_key(), // API key for authentication
            't' => time(), // Current timestamp
            'v' => TOPPPA_VER, // Plugin version
            'r' => wp_generate_password(8, false) // Random string
        );
        
        $api_url .= '?' . http_build_query($params);
        
        // Fetch from your server API with cache-busting headers
        $response = wp_remote_get($api_url, array(
            'timeout' => 30,
            'headers' => array(
                'User-Agent' => 'TopperPack/' . TOPPPA_VER,
                'Cache-Control' => 'no-cache, no-store, must-revalidate',
                'Pragma' => 'no-cache',
                'Expires' => '0'
            )
        ));
        
        // Handle API errors with proper error messages
        if (is_wp_error($response)) {
            // Return error message instead of fallback
            wp_send_json_error('Server connection failed: ' . $response->get_error_message());
            return;
        }
        
        $response_code = wp_remote_retrieve_response_code($response);
        if ($response_code !== 200) {
            // Return error message instead of fallback
            wp_send_json_error('Server returned error code: ' . $response_code);
            return;
        }
        
        // Parse response
        $body = wp_remote_retrieve_body($response);
        $response_data = json_decode($body, true);
        
        if (!is_array($response_data)) {
            // Return error message instead of fallback
            wp_send_json_error('Invalid server response format');
            return;
        }
        
        // Extract sites array from server response
        $sites = isset($response_data['sites']) && is_array($response_data['sites']) 
            ? $response_data['sites'] 
            : $response_data;
        
        // Extract categories from sites data
        $categories = array();
        $category_counts = array();
        
        foreach ($sites as $site) {
            if (!empty($site['category'])) {
                $category = strtolower($site['category']);
                if (!isset($category_counts[$category])) {
                    $category_counts[$category] = 0;
                }
                $category_counts[$category]++;
            }
        }
        
        // Build categories response
        $response_categories = array();
        
        // Always include "all" as the first option
        $response_categories[] = array(
            'id' => 'all',
            'name' => 'All Sites',
            'count' => count($sites)
        );
        
        // Add actual categories with counts
        foreach ($category_counts as $category => $count) {
            $response_categories[] = array(
                'id' => $category,
                'name' => ucfirst($category),
                'count' => $count
            );
        }
        
        wp_send_json_success($response_categories);
    }
    
    /**
     * Import ready site via AJAX
     */
    public function import_ready_site() {
        check_ajax_referer('topppa_ready_sites_nonce', 'nonce');
        
        if (!current_user_can('manage_options')) {
            wp_send_json_error('Unauthorized');
        }
        
        // Validate required site_id parameter
        $site_id = sanitize_text_field(wp_unslash($_POST['site_id'] ?? ''));
        if (empty($site_id)) {
            // translators: 1: Site ID is required
            wp_send_json_error('Site ID is required');
        }
        
        // Validate site_id format (alphanumeric, hyphens, underscores only)
        if (!preg_match('/^[a-zA-Z0-9_-]+$/', $site_id)) {
            // translators: 1: Invalid site ID format
            wp_send_json_error('Invalid site ID format');
        }
        
        // Check if this is a pro demo and user has access
        if ($this->is_pro_site($site_id) && !$this->can_access_pro_demos()) {
            // translators: 1: This is a Pro demo. Please activate Topper Pack Pro and your license to access premium demos.
            wp_send_json_error('This is a Pro demo. Please activate Topper Pack Pro and your license to access premium demos.');
        }
        
        // Sanitize and validate options
        $options = array(
            'import_content' => filter_var(wp_unslash($_POST['import_content'] ?? false), FILTER_VALIDATE_BOOLEAN), //WordPress.Security.ValidatedSanitizedInput.MissingUnslash
            'import_settings' => filter_var(wp_unslash($_POST['import_settings'] ?? false), FILTER_VALIDATE_BOOLEAN), //WordPress.Security.ValidatedSanitizedInput.MissingUnslash
            'import_elementor' => filter_var(wp_unslash($_POST['import_elementor'] ?? false), FILTER_VALIDATE_BOOLEAN) //WordPress.Security.ValidatedSanitizedInput.MissingUnslash
        );
        
        // Ensure at least one import option is selected
        if (!$options['import_content'] && !$options['import_settings'] && !$options['import_elementor']) {
            // translators: 1: At least one import option must be selected
            wp_send_json_error('At least one import option must be selected');
        }
        
        try {
            $result = $this->perform_ready_site_import($site_id, $options);
            wp_send_json_success($result);
        } catch (Exception $e) {
            wp_send_json_error('Internal error: ' . $e->getMessage());
        }
    }
    
    /**
     * Check system requirements and dependencies
     */
    private function check_system_requirements() {
        $critical_errors = array();
        $warnings = array();
        
        // Check if required constants are defined
        if (!defined('TOPPPA_PATH') || !defined('TOPPPA_VER')) {
            // translators: 1: Plugin constants not properly defined
            $critical_errors[] = 'Plugin constants not properly defined';
        }
        
        // Check if upload directory is writable
        $upload_dir = wp_upload_dir();
        if (!empty($upload_dir['error'])) {
            // translators: 1: Upload directory error:
            $critical_errors[] = 'Upload directory error: ' . $upload_dir['error'];
        }
        
        // Check available disk space (require at least 100MB)
        if (function_exists('disk_free_space')) {
            $free_space = disk_free_space($upload_dir['basedir']);
            if ($free_space !== false && $free_space < 100 * 1024 * 1024) {
                // translators: 1: Insufficient disk space (requires at least 100MB)
                $critical_errors[] = 'Insufficient disk space (requires at least 100MB)';
            }
        }
        
        // Check if required PHP extensions are loaded (CRITICAL - must have these)
        $required_extensions = array('json', 'libxml', 'zip');
        foreach ($required_extensions as $extension) {
            if (!extension_loaded($extension)) {
                // translators: 1: Required PHP extension not loaded:
                $critical_errors[] = "Required PHP extension not loaded: {$extension}";
            }
        }
        
        // Try to increase execution time if possible (non-critical, just a warning)
        $max_execution_time = ini_get('max_execution_time');
        if ($max_execution_time > 0 && $max_execution_time < 300) {
            // Try to increase execution time programmatically
            @set_time_limit(300); // Suppress errors if not allowed
            $new_time = ini_get('max_execution_time');
            
            // Only warn if we couldn't increase it and it's still low
            if ($new_time > 0 && $new_time < 60) {
                $warnings[] = sprintf(
                    // translators: %d: Current max execution time in seconds
                    esc_html__('Low max execution time (%d seconds). Import may take longer or require multiple attempts.', 'topper-pack'),
                    $new_time
                );
            }
        }
        
        // Try to increase memory limit if possible (non-critical, just a warning)
        $memory_limit = wp_convert_hr_to_bytes(ini_get('memory_limit'));
        if ($memory_limit > 0 && $memory_limit < 256 * 1024 * 1024) {
            // Try to increase memory limit programmatically
            @ini_set('memory_limit', '256M'); // Suppress errors if not allowed
            $new_memory = wp_convert_hr_to_bytes(ini_get('memory_limit'));
            
            // Only warn if we couldn't increase it and it's still very low
            if ($new_memory > 0 && $new_memory < 128 * 1024 * 1024) {
                $warnings[] = sprintf(
                    // translators: %s: Current memory limit
                    esc_html__('Low memory limit (%s). Large imports may fail.', 'topper-pack'),
                    size_format($new_memory)
                );
            }
        }
        
        // Only throw exception for critical errors that prevent import
        if (!empty($critical_errors)) {
            // translators: 1: System requirements not met:
            throw new Exception(esc_html__('System requirements not met: ', 'topper-pack') . esc_html(implode(', ', $critical_errors)));
        }
        
        // Log warnings but don't block import
        if (!empty($warnings)) {
            // Log warnings for debugging but allow import to proceed
        }
        
        return true;
    }
    
    /**
     * Perform the actual ready site import
     */
    private function perform_ready_site_import($site_id, $options) {
        // Check system requirements first
        $this->check_system_requirements();
        
        $import_steps = array();
        
        // Import content (XML) - optional, continue if fails
        if ($options['import_content']) {
            try {
                $xml_result = $this->import_wordpress_xml($site_id);
                if ($xml_result['success']) {
                    $import_steps[] = '✓ Content imported: ' . $xml_result['message'];
                } else {
                    $import_steps[] = '⚠ Content import skipped: ' . $xml_result['message'];
                }
                                    } catch (Exception $e) {
            $import_steps[] = '⚠ Content import failed: ' . $e->getMessage();
        } catch (Error $e) {
            $import_steps[] = '⚠ Content import failed: ' . $e->getMessage();
        }
        }
        
        // Import plugin settings (JSON)
        if ($options['import_settings']) {
            try {
                $settings_result = $this->import_plugin_settings($site_id);
                if ($settings_result['success']) {
                    $import_steps[] = '✓ Plugin settings imported: ' . $settings_result['message'];
                } else {
                    $import_steps[] = '⚠ Plugin settings import failed: ' . $settings_result['message'];
                }
            } catch (Exception $e) {
                $import_steps[] = '⚠ Plugin settings import failed: ' . $e->getMessage();
            } catch (Error $e) {
                $import_steps[] = '⚠ Plugin settings import failed: ' . $e->getMessage();
            }
        }
        
        // Import Elementor settings
        if ($options['import_elementor']) {
            try {
                $elementor_result = $this->import_elementor_settings($site_id);
                if ($elementor_result['success']) {
                    $import_steps[] = '✓ Elementor settings imported: ' . $elementor_result['message'];
                } else {
                    $import_steps[] = '⚠ Elementor import skipped: ' . $elementor_result['message'];
                }
            } catch (Exception $e) {
                $import_steps[] = '⚠ Elementor import failed: ' . $e->getMessage();
            } catch (Error $e) {
                $import_steps[] = '⚠ Elementor import failed: ' . $e->getMessage();
            }
        }
        
        // Count successful imports
        $successful_imports = 0;
        $total_attempted = 0;
        
        foreach ($import_steps as $step) {
            if (strpos($step, '✓') === 0) {
                $successful_imports++;
            }
            $total_attempted++;
        }
        
        // Set up front page and blog page after content import
        if ($options['import_content'] && $successful_imports > 0) {
            try {
                $page_setup_result = $this->setup_front_and_blog_pages();
                if (!empty($page_setup_result['message'])) {
                    $import_steps[] = $page_setup_result['success'] ? '✓ ' . $page_setup_result['message'] : '⚠ ' . $page_setup_result['message'];
                    if ($page_setup_result['success']) {
                        $successful_imports++;
                    }
                    $total_attempted++;
                }
            } catch (Exception $e) {
                $import_steps[] = '⚠ Page setup failed: ' . $e->getMessage();
                $total_attempted++;
            }
        }
        
        // CRITICAL: Perform post-import optimization to prevent slow first loads (silent)
        if ($successful_imports > 0) {
            try {
                $optimization_result = $this->optimize_site_after_import($options);
                // Note: Optimization runs silently - no user-facing messages added
                // This keeps the UI clean while still providing performance benefits
            } catch (Exception $e) {
                // Log optimization errors but don't show to user
            }
        }
        
        if ($successful_imports > 0) {
            $message = "Ready site import completed! ({$successful_imports}/{$total_attempted} components imported)";
        } else {
            $message = esc_html__('Ready site import failed. Please check the error messages above.', 'topper-pack');
        }
        
        return array(
            'message' => $message,
            'steps' => $import_steps,
            'success' => $successful_imports > 0
        );
    }
    
    /**
     * Optimize site after import to prevent slow first loads
     */
    private function optimize_site_after_import($import_options) {
        $optimizations = array();
        
        try {
            // 1. Flush rewrite rules to ensure URLs work correctly
            flush_rewrite_rules();
            $optimizations[] = 'URL rewrite rules flushed';
            
            // 2. Optimize database tables
            $this->optimize_database_after_import();
            $optimizations[] = 'Database optimized';
            
            // 3. Clear and warm up all caches properly
            $this->clear_and_warm_caches();
            $optimizations[] = 'Caches cleared and warmed';
            
            // 4. Optimize autoloaded options
            $this->optimize_autoloaded_options();
            $optimizations[] = 'Autoloaded options optimized';
            
            // 5. Pre-generate critical CSS files if Elementor was imported
            if ($import_options['import_elementor']) {
                $this->pregenerate_elementor_assets();
                $optimizations[] = 'Elementor assets pre-generated';
            }
            
            // 6. Warm up the homepage to trigger any lazy loading processes
            $this->warm_up_homepage();
            $optimizations[] = 'Homepage warmed up';
            
            // 7. Clear any remaining temporary data
            $this->cleanup_temporary_data();
            $optimizations[] = 'Temporary data cleaned';
            
            return array(
                'success' => true,
                'message' => 'Site optimization completed: ' . implode(', ', $optimizations)
            );
            
        } catch (Exception $e) {
            return array(
                'success' => false,
                'message' => 'Site optimization failed: ' . $e->getMessage()
            );
        }
    }
    
    /**
     * Optimize database after import
     */
    private function optimize_database_after_import() {
        global $wpdb;
        
        try {
            // phpcs:disable WordPress.DB.DirectDatabaseQuery.DirectQuery, WordPress.DB.DirectDatabaseQuery.NoCaching
            $wpdb->query("DELETE pm1 FROM {$wpdb->postmeta} pm1 
                         INNER JOIN {$wpdb->postmeta} pm2 
                         WHERE pm1.meta_id > pm2.meta_id 
                         AND pm1.post_id = pm2.post_id 
                         AND pm1.meta_key = pm2.meta_key 
                         AND pm1.meta_value = pm2.meta_value");
            
            // Update post modified dates to trigger cache invalidation
            $wpdb->query("UPDATE {$wpdb->posts} SET post_modified = NOW(), post_modified_gmt = UTC_TIMESTAMP() WHERE post_type IN ('page', 'post', 'elementor_library')");
            
            // Clean up orphaned postmeta
            $wpdb->query("DELETE pm FROM {$wpdb->postmeta} pm LEFT JOIN {$wpdb->posts} p ON pm.post_id = p.ID WHERE p.ID IS NULL");
            
            // Clean up expired transients (MySQL-compatible approach)
            $wpdb->query("DELETE FROM {$wpdb->options} WHERE option_name LIKE '_transient_timeout_%' AND option_value < UNIX_TIMESTAMP()");
            
            // Clean up orphaned transients using a two-step approach to avoid MySQL limitation
            $orphaned_transients = $wpdb->get_col("
                SELECT t.option_name 
                FROM {$wpdb->options} t 
                LEFT JOIN {$wpdb->options} tt ON tt.option_name = CONCAT('_transient_timeout_', SUBSTRING(t.option_name, 12))
                WHERE t.option_name LIKE '_transient_%' 
                AND t.option_name NOT LIKE '_transient_timeout_%'
                AND tt.option_name IS NULL
            ");
            
            if (!empty($orphaned_transients)) {
                // Delete orphaned transients using individual prepared statements
                foreach ($orphaned_transients as $transient) {
                    $wpdb->query($wpdb->prepare(
                        "DELETE FROM {$wpdb->options} WHERE option_name = %s",
                        $transient
                    ));
                }
            }
            
            // Optimize tables
            $wpdb->query("OPTIMIZE TABLE {$wpdb->posts}");
            $wpdb->query("OPTIMIZE TABLE {$wpdb->postmeta}");
            $wpdb->query("OPTIMIZE TABLE {$wpdb->options}");
            // phpcs:enable WordPress.DB.DirectDatabaseQuery.DirectQuery, WordPress.DB.DirectDatabaseQuery.NoCaching
            
        } catch (Exception $e) {
            
        }
    }
    
    /**
     * Clear and warm up all caches properly
     */
    private function clear_and_warm_caches() {
        // Clear WordPress object cache
        wp_cache_flush();
        
        // Clear WordPress transients
        delete_transient('topppa_template_cache');
        delete_transient('topppa_settings_cache');
        
        // Clear popular caching plugins
        $this->clear_page_caches();
        
        // Clear OPcache if available
        if (function_exists('opcache_reset')) {
            opcache_reset();
        }
        
        // Clear Elementor caches more efficiently
        if (class_exists('Elementor\Plugin')) {
            // Clear only essential Elementor caches
            delete_transient('elementor_remote_info_api_data_' . (defined('ELEMENTOR_VERSION') ? ELEMENTOR_VERSION : ''));
            delete_transient('elementor_get_template_library');
            
            // Clear files manager cache
            if (isset(\Elementor\Plugin::$instance->files_manager)) {
                \Elementor\Plugin::$instance->files_manager->clear_cache();
            }
        }
        
        // Warm up critical caches by making internal requests
        $this->warm_critical_caches();
    }
    
    /**
     * Warm up critical caches
     */
    private function warm_critical_caches() {
        // Warm up options cache by loading commonly used options
        $critical_options = array(
            'stylesheet',
            'template',
            'active_plugins',
            'show_on_front',
            'page_on_front',
            'page_for_posts'
        );
        
        foreach ($critical_options as $option) {
            get_option($option);
        }
        
        // Warm up taxonomy cache
        get_categories(array('hide_empty' => false));
        get_tags(array('hide_empty' => false));
    }
    
    /**
     * Optimize autoloaded options to prevent slow queries
     */
    private function optimize_autoloaded_options() {
        global $wpdb;
        
        try {
            // phpcs:disable WordPress.DB.DirectDatabaseQuery.DirectQuery, WordPress.DB.DirectDatabaseQuery.NoCaching
            // Get all autoloaded options and their sizes
            $autoloaded_options = $wpdb->get_results(
                "SELECT option_name, LENGTH(option_value) as option_size 
                 FROM {$wpdb->options} 
                 WHERE autoload = 'yes' 
                 ORDER BY option_size DESC"
            );
            
            // Options that should NOT be autoloaded (too large or not frequently used)
            $no_autoload_patterns = array(
                'widget_',
                'theme_mods_',
                '_transient_',
                '_site_transient_',
                'recovery_mode_',
                'auto_updater.',
                'dismissed_wp_pointers',
                'elementor_editor_upgrade_',
                'elementor_tracker_',
                'elementor_remote_'
            );
            
            $optimized_count = 0;
            
            foreach ($autoloaded_options as $option) {
                // Skip options larger than 100KB - they shouldn't be autoloaded
                if ($option->option_size > 100000) {
                    $wpdb->update(
                        $wpdb->options,
                        array('autoload' => 'no'),
                        array('option_name' => $option->option_name)
                    );
                    $optimized_count++;
                    continue;
                }
                
                // Check if option matches patterns that shouldn't be autoloaded
                foreach ($no_autoload_patterns as $pattern) {
                    if (strpos($option->option_name, $pattern) !== false) {
                        $wpdb->update(
                            $wpdb->options,
                            array('autoload' => 'no'),
                            array('option_name' => $option->option_name)
                        );
                        $optimized_count++;
                        break;
                    }
                }
            }
            // phpcs:enable WordPress.DB.DirectDatabaseQuery.DirectQuery, WordPress.DB.DirectDatabaseQuery.NoCaching
            
            // Clear options cache to reload optimized autoload settings
            wp_cache_delete('alloptions', 'options');
            
        } catch (Exception $e) {
            // Log autoload optimization errors but don't fail the import
            
        }
    }
    
    /**
     * Pre-generate Elementor assets to avoid first-load delays
     */
    private function pregenerate_elementor_assets() {
        if (!class_exists('Elementor\Plugin')) {
            return;
        }
        
        try {
            // Get the active kit ID
            $kit_id = get_option('elementor_active_kit');
            
            if ($kit_id) {
                // Generate kit CSS
                if (class_exists('Elementor\Core\Files\CSS\Post')) {
                    $kit_css_file = new \Elementor\Core\Files\CSS\Post($kit_id);
                    $kit_css_file->update();
                }
                
                // Generate global CSS
                if (class_exists('Elementor\Core\Files\CSS\Global_CSS')) {
                    $global_css = new \Elementor\Core\Files\CSS\Global_CSS('global.css');
                    $global_css->update();
                }
            }
            
            // Pre-generate CSS for front page and blog page
            $front_page_id = get_option('page_on_front');
            $blog_page_id = get_option('page_for_posts');
            
            foreach (array($front_page_id, $blog_page_id) as $page_id) {
                if ($page_id && class_exists('Elementor\Core\Files\CSS\Post')) {
                    $page_css_file = new \Elementor\Core\Files\CSS\Post($page_id);
                    $page_css_file->update();
                }
            }
            
        } catch (Exception $e) {
          
        }
    }
    
    /**
     * Warm up the homepage to trigger any lazy loading processes
     */
    private function warm_up_homepage() {
        try {
            // Make an internal request to the homepage
            $homepage_url = home_url('/');
            
            $response = wp_remote_get($homepage_url, array(
                'timeout' => 30,
                'sslverify' => false,
                'user-agent' => 'TopperPack Import Optimizer',
                'blocking' => true
            ));
            
            // Also warm up the admin area for faster subsequent loads
            $admin_url = admin_url('admin.php?page=topper-pack');
            wp_remote_get($admin_url, array(
                'timeout' => 15,
                'sslverify' => false,
                'user-agent' => 'TopperPack Import Optimizer',
                'blocking' => false  // Non-blocking for admin
            ));
            
        } catch (Exception $e) {
           
        }
    }
    
    /**
     * Clean up temporary data after import
     */
    private function cleanup_temporary_data() {
        // Clean up temporary import files
        $upload_dir = wp_upload_dir();
        $temp_pattern = $upload_dir['path'] . '/ready-site-import*';
        
        foreach (glob($temp_pattern) as $temp_file) {
            if (is_file($temp_file)) {
                wp_delete_file($temp_file);
            }
        }
        
        // Clean up temporary options
        delete_option('topppa_import_in_progress');
        delete_transient('topppa_import_status');
        
        // Clean up old import logs
        global $wpdb;
        $cutoff_time = time() - 86400;
        // phpcs:disable WordPress.DB.DirectDatabaseQuery.DirectQuery, WordPress.DB.DirectDatabaseQuery.NoCaching
        $wpdb->query($wpdb->prepare(
            "DELETE FROM {$wpdb->options} WHERE option_name LIKE %s AND option_name < %s",
            'topppa_import_log_%',
            'topppa_import_log_' . $cutoff_time
        ));
        // phpcs:enable WordPress.DB.DirectDatabaseQuery.DirectQuery, WordPress.DB.DirectDatabaseQuery.NoCaching	
    }
    
    /**
     * Import WordPress XML content
     */
    private function import_wordpress_xml($site_id) {
        		// Download XML file from server with retry for connection reset errors
		$xml_url = $this->get_server_url() . 'download.php?site_id=' . urlencode($site_id) . '&type=xml&api_key=' . urlencode($this->get_api_key());
		
		$response = null;
		$max_attempts = 3;
		
		for ($attempt = 1; $attempt <= $max_attempts; $attempt++) {
			$response = wp_remote_get($xml_url, array(
				'timeout' => 45 + ($attempt * 15), // Increase timeout each attempt (XML files are larger)
				'sslverify' => ($attempt === 1), // Try SSL first, then disable
				'httpversion' => '1.1',
				'blocking' => true,
				'headers' => array(
					'User-Agent' => 'TopperPack/' . TOPPPA_VER . ' (Attempt ' . $attempt . ')'
				)
			));
			
			                        // If successful, break out of retry loop
            if (!is_wp_error($response)) {
                break;
            }
            
            $error_message = $response->get_error_message();
            
            // If it's a connection reset error and we have more attempts, retry
            if (strpos($error_message, 'cURL error 56') !== false && $attempt < $max_attempts) {
                sleep(3 * $attempt); // Wait before retry
                continue;
            }
			
			// If it's not a connection reset error or we're out of attempts, break
			break;
		}
        
        if (is_wp_error($response)) {
            throw new Exception(esc_html__('Failed to download XML content: ', 'topper-pack') . esc_html($response->get_error_message())); // WordPress.WP.I18n.NonSingularStringLiteralText
        }
        
        $xml_content = wp_remote_retrieve_body($response);
        
        if (empty($xml_content)) {
            throw new Exception(esc_html__('Downloaded XML content is empty', 'topper-pack')); // WordPress.WP.I18n.NonSingularStringLiteralText
        }
        
        // Validate content size (max 50MB)
        if (strlen($xml_content) > 50 * 1024 * 1024) {
            throw new Exception(esc_html__('XML content exceeds maximum allowed size', 'topper-pack')); // WordPress.WP.I18n.NonSingularStringLiteralText
        }
        
        // Basic XML validation
        libxml_use_internal_errors(true);
        $xml_check = simplexml_load_string($xml_content);
        if ($xml_check === false) {
            $errors = libxml_get_errors();
            $error_msg = !empty($errors) ? $errors[0]->message : esc_html__('Invalid XML format', 'topper-pack');
            throw new Exception(esc_html__('Invalid XML content: ', 'topper-pack') . esc_html(trim($error_msg)));
        }
        libxml_clear_errors();
        
        // Save to temporary file with better error handling
        $temp_file = wp_tempnam('ready-site-import.xml');
        if (!$temp_file || !file_put_contents($temp_file, $xml_content)) {
            throw new Exception(esc_html__('Failed to create temporary XML file', 'topper-pack')); // WordPress.WP.I18n.NonSingularStringLiteralText
        }
        
        try {
            // Enable SVG uploads temporarily for import
            add_filter('upload_mimes', array($this, 'enable_svg_uploads'));
            add_filter('wp_check_filetype_and_ext', array($this, 'fix_svg_mime_type'), 10, 5);
            
            // Try to load WordPress importer
            $importer_loaded = $this->load_wordpress_importer();
            
            if (!$importer_loaded) {
                // Skip XML import if importer not available
                return array('success' => false, 'message' => esc_html__('WordPress Importer plugin not found. Please install the WordPress Importer plugin from the WordPress admin dashboard (Tools → Import → WordPress) to import content.', 'topper-pack')); // WordPress.WP.I18n.NonSingularStringLiteralText
            }
            
            		// Verify our custom TOPPPA_Custom_Import class is available
		if (!class_exists('TOPPPA_Custom_Import')) {
			return array('success' => false, 'message' => esc_html__('TOPPPA_Custom_Import class not available even after loading importer', 'topper-pack')); // WordPress.WP.I18n.NonSingularStringLiteralText
		}
		
		$importer = new TOPPPA_Custom_Import();
            $importer->fetch_attachments = true;
            
            // Set import options for better compatibility
            $importer->max_wxr_version = 1.2; // Set to handle newer WXR versions
            
            // Capture any output/errors from the import process
            ob_start();
            
            // Store original error reporting level
            // phpcs:disable WordPress.PHP.DevelopmentFunctions.prevent_path_disclosure_error_reporting
            $original_error_reporting = error_reporting();
            error_reporting(E_ALL);
            // phpcs:enable WordPress.PHP.DevelopmentFunctions.prevent_path_disclosure_error_reporting
            
            // Call the import method and capture any errors
            try {
                $import_result = $importer->import($temp_file);
                $import_output = ob_get_clean();
            
                // Check if there were any import errors
                if (is_wp_error($import_result)) {
                    return array('success' => false, 'message' => esc_html__('XML import failed: ', 'topper-pack') . esc_html($import_result->get_error_message()));
                }
                
                // Check if any content was actually imported
                $imported_posts = get_posts(array(
                    'posts_per_page' => 1,
                    'post_status' => 'any',
                    'meta_key' => '_wxr_import_term',
                    'suppress_filters' => false
                ));
                
                if (empty($imported_posts)) {
                    // Try alternative check for recent posts
                    $recent_posts = get_posts(array(
                        'posts_per_page' => 5,
                        'post_status' => 'any',
                        'date_query' => array(
                            array(
                                'after' => '1 minute ago'
                            )
                        )
                    ));
                }
                
            } catch (Throwable $e) {
                $import_output = ob_get_clean();
                return array('success' => false, 'message' => esc_html__('XML import failed with exception: ', 'topper-pack') . esc_html($e->getMessage())); // WordPress.WP.I18n.NonSingularStringLiteralText
            } finally {
                // Restore error reporting
                // phpcs:disable WordPress.PHP.DevelopmentFunctions.prevent_path_disclosure_error_reporting
                error_reporting($original_error_reporting);
                // phpcs:enable WordPress.PHP.DevelopmentFunctions.prevent_path_disclosure_error_reporting
                
                // Remove SVG upload filters
                remove_filter('upload_mimes', array($this, 'enable_svg_uploads'));
                remove_filter('wp_check_filetype_and_ext', array($this, 'fix_svg_mime_type'), 10);
            }
            
            return array('success' => true, 'message' => esc_html__('XML content imported successfully', 'topper-pack'));
            
        } catch (Exception $e) {
            return array('success' => false, 'message' => esc_html__('XML import failed: ', 'topper-pack') . esc_html($e->getMessage())); // WordPress.WP.I18n.NonSingularStringLiteralText
        } finally {
            // Always cleanup temp file
            if (file_exists($temp_file)) {
                wp_delete_file($temp_file);
            }
        }
    }
    
    /**
     * Import plugin settings from JSON
     */
    private function import_plugin_settings($site_id) {
        		// Download JSON file from server with retry for connection reset errors
		$json_url = $this->get_server_url() . 'download.php?site_id=' . urlencode($site_id) . '&type=json&api_key=' . urlencode($this->get_api_key());
		
		$response = null;
		$max_attempts = 3;
		
		for ($attempt = 1; $attempt <= $max_attempts; $attempt++) {
			$response = wp_remote_get($json_url, array(
				'timeout' => 30 + ($attempt * 10), // Increase timeout each attempt
				'sslverify' => ($attempt === 1), // Try SSL first, then disable
				'httpversion' => '1.1',
				'blocking' => true,
				'headers' => array(
					'User-Agent' => 'TopperPack/' . TOPPPA_VER . ' (Attempt ' . $attempt . ')'
				)
			));
			
			                        // If successful, break out of retry loop
            if (!is_wp_error($response)) {
                break;
            }
            
            $error_message = $response->get_error_message();
            
            // If it's a connection reset error and we have more attempts, retry
            if (strpos($error_message, 'cURL error 56') !== false && $attempt < $max_attempts) {
                sleep(2 * $attempt); // Wait before retry
                continue;
            }
			
			// If it's not a connection reset error or we're out of attempts, break
			break;
		}
        
        if (is_wp_error($response)) {
            throw new Exception(
                esc_html__('Failed to download plugin settings: ', 'topper-pack') . esc_html($response->get_error_message()) // WordPress.WP.I18n.NonSingularStringLiteralText
            );
        }
        
        $json_content = wp_remote_retrieve_body($response);
        
        if (empty($json_content)) {
            throw new Exception(
                esc_html__('Downloaded JSON settings are empty', 'topper-pack')
            );
        }
        
        // Validate JSON size (max 10MB)
        if (strlen($json_content) > 10 * 1024 * 1024) {
            throw new Exception(
                esc_html__('JSON settings exceed maximum allowed size', 'topper-pack')
            );
        }
        
        // Validate JSON format
        $settings = json_decode($json_content, true);
        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new Exception(
                esc_html__('Invalid JSON format: ', 'topper-pack') . esc_html(json_last_error_msg())
            );
        }
        
        if (!is_array($settings)) {
            throw new Exception(
                esc_html__('Invalid JSON settings format - expected array', 'topper-pack')
            );
        }
        
        // Log the JSON structure for debugging
        // Processing plugin settings...
        
        // Import settings directly with correct option names
        $imported_count = 0;
        $errors = array();
        
        // Import widgets settings (save with original names)
        if (isset($settings['widgets']) && is_array($settings['widgets'])) {
            // Handle sidebars_widgets separately as it's critical for widget functionality
            if (isset($settings['widgets']['sidebars_widgets'])) {
                $sidebars_widgets = $settings['widgets']['sidebars_widgets'];
                if (is_array($sidebars_widgets)) {
                    $result = update_option('sidebars_widgets', $sidebars_widgets);
                    if ($result !== false) {
                        $imported_count++;
                    } else {
                        $errors[] = esc_html__('Failed to import sidebars widgets', 'topper-pack');
                    }
                }
                // Remove from widgets array to avoid duplicate processing
                unset($settings['widgets']['sidebars_widgets']);
            }
            
            // Import individual widget settings
            foreach ($settings['widgets'] as $widget_key => $widget_value) {
                // Skip sidebars_widgets as it's already handled above
                if ($widget_key === 'sidebars_widgets') {
                    continue;
                }
                
                // Use update_option to save the setting
                $result = update_option($widget_key, $widget_value);
                if ($result !== false) {
                    $imported_count++;
                } else {
                    // Check if option already exists with same value
                    $existing_value = get_option($widget_key);
                    if ($existing_value === $widget_value) {
                        $imported_count++; // Count as success if value is already correct
                    } else {
                        $errors[] = esc_html__('Failed to import widget: ', 'topper-pack') . esc_html($widget_key);
                    }
                }
            }
            
            // Flush widget cache after import
            wp_cache_delete('sidebars_widgets', 'options');
        }
        
        // Import extensions settings (save with original names)
        if (isset($settings['extensions']) && is_array($settings['extensions'])) {
            foreach ($settings['extensions'] as $extension_key => $extension_value) {
                // Validate extension exists before importing
                if ($this->is_valid_extension_setting($extension_key)) {
                    $result = update_option($extension_key, $extension_value);
                    if ($result !== false) {
                        $imported_count++;
                    } else {
                        // Check if option already exists with same value
                        $existing_value = get_option($extension_key);
                        if ($existing_value === $extension_value) {
                            $imported_count++; // Count as success if value is already correct
                        } else {
                            $errors[] = esc_html__('Failed to import extension: ', 'topper-pack') . esc_html($extension_key);
                        }
                    }
                } else {
                    // Skip invalid/unavailable extensions silently to avoid log spam
                    continue;
                }
            }
        }
        
        // Import features settings (save with original names)
        if (isset($settings['features']) && is_array($settings['features'])) {
            foreach ($settings['features'] as $feature_key => $feature_value) {
                // Validate feature exists before importing
                if ($this->is_valid_feature_setting($feature_key)) {
                    $result = update_option($feature_key, $feature_value);
                    if ($result !== false) {
                        $imported_count++;
                    } else {
                        // Check if option already exists with same value
                        $existing_value = get_option($feature_key);
                        if ($existing_value === $feature_value) {
                            $imported_count++; // Count as success if value is already correct
                        } else {
                            $errors[] = esc_html__('Failed to import feature: ', 'topper-pack') . esc_html($feature_key);
                        }
                    }
                } else {
                    // Skip invalid/unavailable features silently to avoid log spam
                    continue;
                }
            }
        }
        
        // Import custom settings (save with original names)
        if (isset($settings['custom_settings']) && is_array($settings['custom_settings'])) {
            foreach ($settings['custom_settings'] as $setting_key => $setting_value) {
                if (update_option($setting_key, $setting_value)) {
                    $imported_count++;
                } else {
                    $errors[] = esc_html__('Failed to import custom setting: ', 'topper-pack') . esc_html($setting_key);
                }
            }
        }
        
        // Import API settings
        if (isset($settings['api_settings']) && is_array($settings['api_settings'])) {
            $result = update_option('topppa_api_settings', $settings['api_settings']);
            if ($result !== false) {
                $imported_count++;
            } else {
                // Check if option already exists with same value
                $existing_value = get_option('topppa_api_settings');
                if ($existing_value === $settings['api_settings']) {
                    $imported_count++; // Count as success if value is already correct
                } else {
                    $errors[] = esc_html__('Failed to import API settings', 'topper-pack');
                }
            }
        }
        // Note: No error logged when API settings are empty to avoid unnecessary log spam
        
        $message = "Plugin settings imported: {$imported_count} options";
        if (!empty($errors)) {
            $message .= ' (with ' . count($errors) . ' errors)';
            // Only log critical errors (not unavailable extensions/features)
            $critical_errors = array_filter($errors, function($error) {
                return !preg_match('/Failed to import (extension|feature).*topppa_/', $error);
            });
            
            if (!empty($critical_errors)) {
              
            }
        }
        
        return array('success' => $imported_count > 0, 'message' => $message);
    }
    
    /**
     * Import Elementor settings
     */
    private function import_elementor_settings($site_id) {
        if (!class_exists('Elementor\Plugin')) {
            return array('success' => false, 'message' => esc_html__('Elementor not installed', 'topper-pack'));
        }
        
        		// Download Elementor settings from server with retry for connection reset errors
		$elementor_url = $this->get_server_url() . 'download.php?site_id=' . urlencode($site_id) . '&type=elementor&api_key=' . urlencode($this->get_api_key());
		
		$response = null;
		$max_attempts = 3;
		
		for ($attempt = 1; $attempt <= $max_attempts; $attempt++) {
			$response = wp_remote_get($elementor_url, array(
				'timeout' => 35 + ($attempt * 10), // Increase timeout each attempt
				'sslverify' => ($attempt === 1), // Try SSL first, then disable
				'httpversion' => '1.1',
				'blocking' => true,
				'headers' => array(
					'User-Agent' => 'TopperPack/' . TOPPPA_VER . ' (Attempt ' . $attempt . ')'
				)
			));
			
			            // If successful, break out of retry loop
            if (!is_wp_error($response)) {
                break;
            }
            
            $error_message = $response->get_error_message();
            
            // If it's a connection reset error and we have more attempts, retry
            if (strpos($error_message, 'cURL error 56') !== false && $attempt < $max_attempts) {
                sleep(2 * $attempt); // Wait before retry
                continue;
            }
			
			// If it's not a connection reset error or we're out of attempts, break
			break;
		}
        
        if (is_wp_error($response)) {
            return array('success' => false, 'message' => esc_html__('Failed to download Elementor settings: ', 'topper-pack') . esc_html($response->get_error_message()));
        }
        
        $elementor_content = wp_remote_retrieve_body($response);
        
        if (empty($elementor_content)) {
            return array('success' => false, 'message' => esc_html__('No Elementor settings available', 'topper-pack'));
        }
        
        // Validate JSON format
        $elementor_settings = json_decode($elementor_content, true);
        if (json_last_error() !== JSON_ERROR_NONE) {
            return array('success' => false, 'message' => esc_html__('Invalid Elementor settings format: ', 'topper-pack') . json_last_error_msg());
        }
        
        if (!is_array($elementor_settings) || empty($elementor_settings)) {
            return array('success' => false, 'message' => esc_html__('Elementor settings are empty or invalid', 'topper-pack'));
        }
        
        $imported_count = 0;
        $errors = array();
        $kit_id = null; // Initialize kit_id
        
        // Processing Elementor settings...
        
        // Handle new Elementor export format (site-settings.json)
        if (isset($elementor_settings['settings']) && is_array($elementor_settings['settings'])) {
            $settings = $elementor_settings['settings'];
            
            // Get or create an active kit
            $kit_id = $this->get_or_create_elementor_kit();
            
            if ($kit_id) {
                // Import settings directly to the kit post meta
                if ($this->import_settings_to_kit($kit_id, $settings)) {
                    $imported_count++;
                    
                    // Set the active kit
                    update_option('elementor_active_kit', $kit_id);
                    $imported_count++;
                } else {
                    $errors[] = esc_html__('Failed to import settings to kit', 'topper-pack');
                }
            } else {
                $errors[] = esc_html__('Failed to get or create Elementor kit', 'topper-pack');
            }
            
            // Note: Global Elementor settings are now handled within the kit import above
            // No need for duplicate global settings import
            
        } else {
            // Handle old format (flat key-value pairs)
            
            foreach ($elementor_settings as $option_name => $option_value) {
                // Only import Elementor-related options for security
                if (strpos($option_name, 'elementor_') === 0) {
                    // Validate option name
                    if (!preg_match('/^elementor_[a-zA-Z0-9_-]+$/', $option_name)) {
                        $errors[] = esc_html__('Invalid option name: ', 'topper-pack') . esc_html($option_name);
                        continue;
                    }
                    
                    // Sanitize option value
                    if (is_array($option_value) || is_object($option_value)) {
                        $option_value = $this->sanitize_elementor_data($option_value);
                    } else {
                        $option_value = sanitize_text_field($option_value);
                    }
                    
                    if (update_option($option_name, $option_value)) {
                        $imported_count++;
                    } else {
                        $errors[] = esc_html__('Failed to update option: ', 'topper-pack') . esc_html($option_name);
                    }
                }
            }
        }
        
        // Clear Elementor caches and regenerate CSS after import
        if ($imported_count > 0) {
            $this->refresh_elementor_after_import($kit_id);
        }
        
        $message = esc_html__('Elementor settings imported: ', 'topper-pack') . esc_html($imported_count) . esc_html__(' options', 'topper-pack');
        if (!empty($errors)) {
            $message .= ' (' . esc_html(count($errors)) . ' ' . esc_html__('errors', 'topper-pack') . ')';
        }
        
        return array('success' => $imported_count > 0, 'message' => $message);
    }
    
    /**
     * Get or create an Elementor kit
     */
    private function get_or_create_elementor_kit() {
        // Check if there's already an active kit
        $kit_id = get_option('elementor_active_kit');
        
        if ($kit_id && get_post($kit_id)) {
            return $kit_id;
        }
        
        // Create a new kit
        $kit_id = wp_insert_post(array(
            'post_title' => 'Imported Site Kit',
            'post_type' => 'elementor_library',
            'post_status' => 'publish',
            'meta_input' => array(
                '_elementor_template_type' => 'kit'
            )
        ));
        
        if (is_wp_error($kit_id)) {
            return false;
        }
        
        return $kit_id;
    }
    
    /**
     * Import settings to Elementor kit
     */
    private function import_settings_to_kit($kit_id, $settings) {
        try {
            // Prepare kit data structure - copy ALL settings from the JSON
            $kit_data = array();
            
            // Core Elementor settings - direct copy from JSON
            $core_settings = array(
                'template',
                'colors_enable_styleguide_preview',
                'system_colors',
                'custom_colors',
                'typography_enable_styleguide_preview', 
                'system_typography',
                'custom_typography',
                'default_generic_fonts',
                'page_title_selector',
                'activeItemIndex',
                'viewport_md',
                'viewport_lg',
                'container_width',
                'space_between_widgets',
                'stretched_section_container',
                'site_name',
                'site_description',
                'body_font_family',
                'body_font_size',
                'body_font_weight',
                'body_text_color',
                'body_line_height',
                'h1_font_family',
                'h1_font_size',
                'h1_font_weight',
                'h2_font_family',
                'h2_font_size',
                'h2_font_weight',
                'h3_font_family',
                'h3_font_size',
                'h3_font_weight',
                'h4_font_family',
                'h4_font_size',
                'h4_font_weight',
                'h5_font_family',
                'h5_font_size',
                'h5_font_weight',
                'h6_font_family',
                'h6_font_size',
                'h6_font_weight'
            );
            
            // Add all core settings that exist
            foreach ($core_settings as $setting_key) {
                if (isset($settings[$setting_key])) {
                    $kit_data[$setting_key] = $settings[$setting_key];
                }
            }
            
            // Add ALL remaining settings (including TOPPPA and other plugin settings)
            foreach ($settings as $key => $value) {
                if (!in_array($key, $core_settings) && !isset($kit_data[$key])) {
                    $kit_data[$key] = $value;
                }
            }
            
            // Store the complete kit data
            if (!empty($kit_data)) {
                // Store as Elementor kit settings
                update_post_meta($kit_id, '_elementor_page_settings', $kit_data);
                
                // Also store some settings as individual options for backward compatibility
                $global_options = array(
                    'elementor_container_width' => $kit_data['container_width'] ?? null,
                    'elementor_space_between_widgets' => $kit_data['space_between_widgets'] ?? null,
                    'elementor_page_title_selector' => $kit_data['page_title_selector'] ?? null,
                    'elementor_stretched_section_container' => $kit_data['stretched_section_container'] ?? null,
                    'elementor_viewport_md' => $kit_data['viewport_md'] ?? null,
                    'elementor_viewport_lg' => $kit_data['viewport_lg'] ?? null
                );
                
                foreach ($global_options as $option_name => $option_value) {
                    if ($option_value !== null) {
                    update_option($option_name, $option_value);
                    }
                }
                
                // Update Elementor meta data
                update_post_meta($kit_id, '_elementor_data', json_encode(array()));
                update_post_meta($kit_id, '_elementor_edit_mode', 'builder');
                update_post_meta($kit_id, '_elementor_template_type', 'kit');
                
                if (defined('ELEMENTOR_VERSION')) {
                    update_post_meta($kit_id, '_elementor_version', ELEMENTOR_VERSION);
                }
                
                return true;
            } else {
                return false;
            }
            
        } catch (Exception $e) {
            return false;
        }
    }
    
    /**
     * Refresh Elementor after settings import (optimized version)
     */
    private function refresh_elementor_after_import($kit_id = null) {
        if (!class_exists('Elementor\Plugin')) {
            return;
        }
        
        try {
            // Force Elementor to recognize the new kit first
            if ($kit_id) {
                // Ensure the active kit is set
                update_option('elementor_active_kit', $kit_id);
                
                // Clear kit-specific caches only
                if (class_exists('Elementor\Core\Kits\Manager')) {
                    delete_option('_elementor_cache_kit_' . $kit_id);
                    delete_transient('elementor_kit_css_' . $kit_id);
                    delete_transient('elementor_kit_settings_' . $kit_id);
                    delete_option('_elementor_kit_settings_' . $kit_id);
                }
            }
            
            // Clear only essential Elementor caches (not all)
            if (isset(\Elementor\Plugin::$instance->files_manager)) {
                \Elementor\Plugin::$instance->files_manager->clear_cache();
            }
            
            // Clear Elementor post CSS cache
            if (method_exists('\Elementor\Plugin', 'instance') && isset(\Elementor\Plugin::$instance->posts_css_manager)) {
                \Elementor\Plugin::$instance->posts_css_manager->clear_cache();
            }
            
            // Update Elementor version to trigger any necessary upgrades
            if (defined('ELEMENTOR_VERSION')) {
                update_option('elementor_version', ELEMENTOR_VERSION);
            }
            
            // Clear only essential transients
            delete_transient('elementor_kit_colors');
            delete_transient('elementor_kit_typography');
            delete_option('elementor_style_kit_updated');
            
            // Clear any plugin-specific caches
            delete_transient('topppa_elementor_settings_cache');
            
            // NOTE: CSS regeneration is now handled by the post-import optimization
            // This prevents the aggressive regeneration that was causing slow first loads
            
        } catch (Exception $e) {
            
        }
    }
    
    /**
     * Clear popular page caching plugins
     */
    private function clear_page_caches() {
        // WP Rocket
        if (function_exists('rocket_clean_domain')) {
            rocket_clean_domain();
        }
        
        // WP Super Cache
        if (function_exists('wp_cache_clear_cache')) {
            wp_cache_clear_cache();
        }
        
        // W3 Total Cache
        if (function_exists('w3tc_flush_all')) {
            w3tc_flush_all();
        }
        
        // WP Fastest Cache
        if (class_exists('WpFastestCache')) {
            $cache = new \WpFastestCache();
            if (method_exists($cache, 'deleteCache')) {
                $cache->deleteCache(true);
            }
        }
        
        // LiteSpeed Cache
        if (class_exists('LiteSpeed\Purge')) {
            \LiteSpeed\Purge::purge_all();
        }
        
        // Autoptimize
        if (class_exists('autoptimizeCache')) {
            \autoptimizeCache::clearall();
        }
    }
    
    /**
     * Load WordPress Importer plugin
     */
    private function load_wordpress_importer() {
        // If already loaded, return true
        if (class_exists('TOPPPA_Custom_Import')) {
            return true;
        }
        
        // Define WP_LOAD_IMPORTERS constant - required for WordPress Importer to load
        if (!defined('WP_LOAD_IMPORTERS')) {
            define('WP_LOAD_IMPORTERS', true);
        }
        
        // Load required WordPress import functions
        if (!function_exists('wp_import_handle_upload')) {
            require_once ABSPATH . 'wp-admin/includes/import.php';
        }
        
        // Load the base importer class first
        $base_importer = ABSPATH . 'wp-admin/includes/class-wp-importer.php';
        if (file_exists($base_importer)) {
            require_once $base_importer;
        }
        
        		// Load the original WordPress importer files
		$compat_file = TOPPPA_PATH . '/includes/import/compat.php';
		$importer_file = TOPPPA_PATH . '/includes/import/class-topppa-custom-import.php';
        
        // Load WordPress importer compatibility functions
        if (file_exists($compat_file)) {
            require_once $compat_file;
        }
        
        		// Load parsers in correct order
		$parser_files = array(
			TOPPPA_PATH . '/includes/import/parsers/class-topppa-wxr-parser.php',
			TOPPPA_PATH . '/includes/import/parsers/class-topppa-wxr-parser-simplexml.php',
			TOPPPA_PATH . '/includes/import/parsers/class-topppa-wxr-parser-xml.php',
			TOPPPA_PATH . '/includes/import/parsers/class-topppa-wxr-parser-regex.php'
		);
        
        foreach ($parser_files as $parser_file) {
            if (file_exists($parser_file)) {
                require_once $parser_file;
            }
        }
        
        // Load main importer class
        if (file_exists($importer_file)) {
            require_once $importer_file;
            
            // Check if the class is now available
            if (class_exists('TOPPPA_Custom_Import')) {
                return true;
            }
        }
        
        return false;
    }
    
    /**
     * Sanitize Elementor data recursively
     */
    private function sanitize_elementor_data($data) {
        if (is_array($data)) {
            return array_map(array($this, 'sanitize_elementor_data'), $data);
        } elseif (is_object($data)) {
            return (object) array_map(array($this, 'sanitize_elementor_data'), (array) $data);
        } elseif (is_string($data)) {
            // Allow HTML for Elementor content but sanitize
            return wp_kses_post($data);
        } else {
            return $data;
        }
    }
    
    /**
     * Enable SVG uploads for import
     */
    public function enable_svg_uploads($mimes) {
        // Only add the specific MIME types we need for import
        $additional_mimes = array(
            // Vector graphics
            'svg' => 'image/svg+xml',
            
            // Modern image formats
            'webp' => 'image/webp',
            'avif' => 'image/avif',
            'ico' => 'image/x-icon',
            
            // Font files
            'woff' => 'font/woff',
            'woff2' => 'font/woff2',
            'ttf' => 'font/ttf',
            'otf' => 'font/otf',
            'eot' => 'application/vnd.ms-fontobject',
            
            // Data files
            'json' => 'application/json'
        );
        
        // Merge only our specific types
        $mimes = array_merge($mimes, $additional_mimes);
        
        return $mimes;
    }

    /**
     * Fix SVG mime type for import
     */
    public function fix_svg_mime_type($data, $file, $filename, $mimes, $real_mime) {
        $file_ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
        
        // Handle SVG files
        if ($file_ext === 'svg') {
            $data['type'] = 'image/svg+xml';
            $data['ext'] = 'svg';
        }
        // Handle WebP files
        elseif ($file_ext === 'webp') {
            $data['type'] = 'image/webp';
            $data['ext'] = 'webp';
        }
        // Handle other file types
        elseif (in_array($file_ext, array('woff', 'woff2', 'ttf', 'otf', 'eot'))) {
            $data['type'] = 'font/' . $file_ext;
            $data['ext'] = $file_ext;
        }
        elseif ($file_ext === 'ico') {
            $data['type'] = 'image/x-icon';
            $data['ext'] = 'ico';
        }
        elseif ($file_ext === 'json') {
            $data['type'] = 'application/json';
            $data['ext'] = 'json';
        }
        
        return $data;
    }
    

    

    
    /**
     * Check if site ID indicates a pro demo
     */
    private function is_pro_site($site_id) {
        // Method 1: Check if site_id contains specific pro patterns (pro_, pro-, Pro_, Pro-)
        $id_lower = strtolower($site_id);
        
        // Only mark as pro if it contains specific pro patterns with separators
        $pro_patterns = array(
            '/^pro[-_]/',           // starts with pro- or pro_
            '/[-_]pro$/',           // ends with -pro or _pro
            '/[-_]pro[-_]/',        // contains -pro- or _pro_
            '/^pro$/',              // exactly "pro"
        );
        
        foreach ($pro_patterns as $pattern) {
            if (preg_match($pattern, $id_lower)) {
                return true;
            }
        }
        
        // Method 2: Check if site is in pro folder structure by making API call
        $api_url = $this->get_server_url() . 'list.php';
        $response = wp_remote_get($api_url, array('timeout' => 10));
        
        if (!is_wp_error($response) && wp_remote_retrieve_response_code($response) === 200) {
            $body = wp_remote_retrieve_body($response);
            $data = json_decode($body, true);
            
            if (is_array($data)) {
                $sites = isset($data['sites']) ? $data['sites'] : $data;
                
                foreach ($sites as $site) {
                    if (isset($site['id']) && $site['id'] === $site_id) {
                        return $this->process_site_data($site)['is_pro'];
                    }
                }
            }
        }
        
        return false;
    }
    
    /**
     * Check if user can access pro demos
     */
    private function can_access_pro_demos() {
        // Use existing premium features check
        return function_exists('topppa_can_use_premium_features') ? topppa_can_use_premium_features() : false;
    }
    

    
    /**
     * Set up front page and blog page after import
     */
    private function setup_front_and_blog_pages() {
        $messages = array();
        $setup_success = false;
        
        // Get all pages to see what we have
        $all_pages = get_posts(array(
            'post_type' => 'page',
            'post_status' => 'publish',
            'numberposts' => -1,
            'orderby' => 'menu_order',
            'order' => 'ASC'
        ));
        

        
        // Look for pages with slug "home" and "blog"
        $home_page = get_page_by_path('home');
        $blog_page = get_page_by_path('blog');
        
        // If no exact match, try some variations
        if (!$home_page) {
            $home_variations = array('homepage', 'front-page', 'index', 'main', 'welcome');
            foreach ($home_variations as $variation) {
                $home_page = get_page_by_path($variation);
                if ($home_page) break;
            }
        }
        
        // If still no home page, try to find by title
        if (!$home_page) {
            foreach ($all_pages as $page) {
                $title_lower = strtolower($page->post_title);
                if (in_array($title_lower, array('home', 'homepage', 'front page', 'main', 'welcome'))) {
                    $home_page = $page;
                    break;
                }
            }
        }
        
        if (!$blog_page) {
            $blog_variations = array('posts', 'news', 'articles', 'blog', 'journal');
            foreach ($blog_variations as $variation) {
                $blog_page = get_page_by_path($variation);
                if ($blog_page) break;
            }
        }
        
        // If still no blog page, try to find by title
        if (!$blog_page) {
            foreach ($all_pages as $page) {
                $title_lower = strtolower($page->post_title);
                if (in_array($title_lower, array('blog', 'posts', 'news', 'articles', 'journal'))) {
                    $blog_page = $page;
                    break;
                }
            }
        }
        
        // Set front page to static page
        if ($home_page) {
            update_option('show_on_front', 'page');
            update_option('page_on_front', $home_page->ID);
        
            $messages[] = sprintf(
                // translators: %s: Home page title.
                esc_html__('Set "%s" as front page', 'topper-pack'),
                esc_html($home_page->post_title)
            );
        
            $setup_success = true;
        } else {
            $messages[] = esc_html__('No "Home" page found to set as front page', 'topper-pack');
        }
        
        // Set blog page for posts
            if ($blog_page) {
                update_option('page_for_posts', $blog_page->ID);
                $messages[] = sprintf(
                    // translators: %s: Blog page title.
                    esc_html__('Set "%s" as blog page', 'topper-pack'),
                    esc_html($blog_page->post_title)
                );
                $setup_success = true;
            } else {
                $messages[] = esc_html__('No "Blog" page found to set as posts page', 'topper-pack');
            }
        
        $message = implode(', ', $messages);
        
        return array(
            'success' => $setup_success,
            'message' => $setup_success ? esc_html__('Page setup completed: ', 'topper-pack') . esc_html($message) : esc_html__('Page setup skipped: ', 'topper-pack') . esc_html($message)
        );
    }
    
    /**
     * Validate if an extension setting is valid for import
     */
    private function is_valid_extension_setting($extension_key) {
        // List of known valid extension settings
        $valid_extensions = array(
            'topppa_conditional_display',
            'topppa_cursor_effect',
            'topppa_custom_css',
            'topppa_grid_line',
            'pin_section',
            'topppa_scroll_to_top',
            'topppa_split_text_animation',
            'topppa_sticky_section',
            'topppa_tooltip_section',
            'topppa_wrapper_link',
            'topppa_container_hover_effects',
            'interactive_animations',
            'advanced_image_hover',
            'topppa_tooltip'
        );
        
        // Check if extension key is in the valid list
        if (in_array($extension_key, $valid_extensions)) {
            // Additional check: see if the extension file exists
            $extension_file_map = array(
                'topppa_conditional_display' => 'extensions/conditional-display/conditional-display.php',
                'topppa_cursor_effect' => 'extensions/cursor-effect.php',
                'topppa_custom_css' => 'extensions/custom-css.php',
                'topppa_grid_line' => 'extensions/grid-line.php',
                'pin_section' => 'extensions/pin-section.php',
                'topppa_scroll_to_top' => 'extensions/scroll-to-top/scroll-to-top.php',
                'topppa_split_text_animation' => 'extensions/split-text-animation.php',
                'topppa_sticky_section' => 'extensions/sticky-section.php',
                'topppa_tooltip_section' => 'extensions/tooltip-section.php',
                'topppa_wrapper_link' => 'extensions/wrapper-link.php',
                'topppa_container_hover_effects' => 'extensions/hover-effect.php',
                'interactive_animations' => 'extensions/interactive-animations.php',
                'topppa_tooltip' => 'extensions/tooltip.php'
            );
            
            if (isset($extension_file_map[$extension_key])) {
                $extension_file = TOPPPA_PATH . $extension_file_map[$extension_key];
                return file_exists($extension_file);
            }
            
            return true; // Default to true for known extensions without specific file check
        }
        
        return false;
    }
    
    /**
     * Validate if a feature setting is valid for import
     */
    private function is_valid_feature_setting($feature_key) {
        // List of known valid feature settings
        $valid_features = array(
            'topppa_assets_manager',
            'topppa_custom_icon',
            'topppa_smooth_scroller',
            'topppa_mega_menu',
            'topppa_template_library',
            'topppa_custom_font',
            'topppa_cpt_builder'
        );
        
        // Check if feature key is in the valid list
        if (in_array($feature_key, $valid_features)) {
            // Additional check: see if the feature file exists
            $feature_file_map = array(
                'topppa_custom_icon' => 'includes/custom-icon/init.php',
                'topppa_smooth_scroller' => 'includes/smooth-scroller/init.php',
                'topppa_mega_menu' => 'includes/mega-menu/init.php',
                'topppa_template_library' => 'includes/template-library/init.php'
            );
            
            if (isset($feature_file_map[$feature_key])) {
                $feature_file = TOPPPA_PATH . $feature_file_map[$feature_key];
                return file_exists($feature_file);
            }
            
            return true; // Default to true for known features without specific file check
        }
        
        return false;
    }
    
    /**
     * Validate if an API setting is valid for import
     */
    private function is_valid_api_setting($api_key) {
        // List of known valid API settings
        $valid_api_settings = array(
            'topppa_mailchimp_api_key',
            'topppa_google_maps_api_key',
            'topppa_recaptcha_site_key',
            'topppa_recaptcha_secret_key',
            'topppa_facebook_app_id',
            'topppa_twitter_api_key',
            'topppa_instagram_access_token'
        );
        
        // Allow any setting that starts with 'topppa_' and ends with '_api' or '_key'
        if (preg_match('/^topppa_.*(api|key)/', $api_key)) {
            return true;
        }
        
        // Check if API key is in the valid list
        return in_array($api_key, $valid_api_settings);
    }
}

// Initialize the ready site importer
new TOPPPA_Ready_Site_Importer();