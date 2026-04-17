<?php
/**
 * Topper Pack Setup Wizard
 *
 * @package Topper Pack
 * @since 1.0.0
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

class TopperPack_Setup_Wizard {
    
    private $current_step = 'welcome';
    private $steps = ['welcome', 'widgets', 'features', 'bepro', 'congrats'];
    private $user_type = 'normal';
    
    public function __construct() {
        add_action('admin_menu', array($this, 'add_wizard_page'));
        add_action('admin_enqueue_scripts', array($this, 'enqueue_assets'));
        add_action('wp_ajax_topper_pack_save_wizard_data', array($this, 'save_wizard_data'));
        add_action('admin_init', array($this, 'maybe_redirect_to_wizard'));
        add_action('admin_init', array($this, 'handle_wizard_access'));
        
        // Hide admin notices on wizard page using WordPress hooks
        add_action('admin_init', array($this, 'hide_admin_notices_hooks'));
    }
    
    public function add_wizard_page() {
        if (!$this->is_wizard_completed()) {
            add_menu_page(
                __('Topper Pack Setup', 'topper-pack'),
                __('Topper Pack Setup', 'topper-pack'),
                'manage_options',
                'topper-pack-wizard',
                array($this, 'wizard_page'),
                'dashicons-admin-plugins',
                100
            );
        }
    }
    
    public function wizard_page() {
        // Double-check if wizard should be accessible
        if ($this->is_wizard_completed() || get_option('topper_pack_show_wizard') !== 'yes') {
            echo '<script>window.location.href = "' . esc_url(admin_url('admin.php?page=topper-pack')) . '";</script>';
            return;
        }
        
        if (isset($_GET['action']) && $_GET['action'] === 'complete') {
            if (wp_verify_nonce($_GET['nonce'], 'complete_wizard')) {
                $this->complete_wizard();
                echo '<script>window.location.href = "' . esc_url(admin_url('admin.php?page=topper-pack')) . '";</script>';
                return;
            }
        }
        
        if (isset($_GET['action']) && $_GET['action'] === 'skip') {
            if (wp_verify_nonce($_GET['nonce'], 'skip_wizard')) {
                $this->complete_wizard();
                echo '<script>window.location.href = "' . esc_url(admin_url('admin.php?page=topper-pack')) . '";</script>';
                return;
            }
        }
        
        if (isset($_GET['action']) && $_GET['action'] === 'reset' && current_user_can('manage_options')) {
            $this->reset_wizard();
            echo '<script>window.location.href = "' . esc_url(admin_url('admin.php?page=topper-pack-wizard')) . '";</script>';
            return;
        }
        
        if (isset($_GET['action']) && $_GET['action'] === 'force_reset' && current_user_can('manage_options')) {
            $this->force_reset_all_widget_options();
            $this->reset_wizard();
            echo '<script>window.location.href = "' . esc_url(admin_url('admin.php?page=topper-pack-wizard&reset_cache=true')) . '";</script>';
            return;
        }
        
        $this->current_step = isset($_GET['step']) ? sanitize_text_field($_GET['step']) : 'welcome';
        ?>
        <div class="wrap topppa-wizard">
            <div class="topppa-wizard-container">
                <div class="topppa-wizard-progress">
                    <?php foreach ($this->steps as $index => $step): ?>
                        <div class="topppa-progress-step <?php echo esc_attr($this->get_step_class($step, $index)); ?>">
                            <span class="topppa-step-number"><?php echo esc_html($index + 1); ?></span>
                            <span class="topppa-step-title"><?php echo esc_html($this->get_step_title($step)); ?></span>
                        </div>
                        <?php if ($index < count($this->steps) - 1): ?>
                            <div class="topppa-progress-arrow">>></div>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </div>
                
                <div class="topppa-wizard-content">
                    <?php $this->load_step_template($this->current_step); ?>
                </div>
            </div>
        </div>
        <?php
    }
    
    private function get_step_class($step, $index) {
        $current_index = array_search($this->current_step, $this->steps);
        
        if ($index < $current_index) {
            return 'completed';
        } elseif ($index == $current_index) {
            return 'active';
        } else {
            return 'pending';
        }
    }
    
    private function get_step_title($step) {
        $titles = [
            'welcome' => esc_html__('Welcome', 'topper-pack'),
            'widgets' => esc_html__('Widgets', 'topper-pack'),
            'features' => esc_html__('Features', 'topper-pack'),
            'bepro' => esc_html__('Be a Pro!', 'topper-pack'),
            'congrats' => esc_html__('Congrats', 'topper-pack')
        ];
        
        return isset($titles[$step]) ? $titles[$step] : ucfirst($step);
    }
    
    private function load_step_template($step) {
        $template_file = TOPPPA_INC_PATH . 'setup-wizard/templates/wizard-' . $step . '.php';
        
        if (file_exists($template_file)) {
            include $template_file;
        } else {
            echo '<div class="wizard-error">Step template not found: ' . esc_html($step) . '</div>';
        }
    }
    
    public function enqueue_assets($hook) {
        if ($hook !== 'toplevel_page_topper-pack-wizard') {
            return;
        }
        
        if (!defined('TOPPPA_WIZARD_MODE')) {
            define('TOPPPA_WIZARD_MODE', true);
        }
        
        wp_enqueue_style('topper-pack-wizard', TOPPPA_INC_URL . 'setup-wizard/assets/wizard.css', array(), TOPPPA_VER);
        wp_enqueue_script('topper-pack-wizard', TOPPPA_INC_URL . 'setup-wizard/assets/wizard.js', array('jquery'), TOPPPA_VER, true);
        
        wp_localize_script('topper-pack-wizard', 'topppaWizardData', array(
            'ajax_url' => esc_url(admin_url('admin-ajax.php')),
            'nonce' => wp_create_nonce('topper_pack_wizard_nonce'),
            'current_step' => $this->current_step,
            'widgets' => $this->get_widgets_data(),
            'extensions' => $this->get_features_data(),
            'dashboard_url' => esc_url(admin_url('admin.php?page=topper-pack')),
            'strings' => array(
                'saving' => esc_html__('Saving...', 'topper-pack'),
                'saved' => esc_html__('Saved!', 'topper-pack'),
                'error' => esc_html__('Error occurred!', 'topper-pack')
            )
        ));
    }
    
    private function get_dashboard_widgets() {
        $widgets = [
            ['topppa-logo widget', 'topppa_logo_widget', 'list', 'Logo', 'free' ],
            ['topppa-header-info widget', 'topppa_header_info_widget', 'list', 'Header Info', 'free'],
            ['topppa-button widget', 'topppa_button_widget', 'list', 'Button', 'free'],
            ['topppa-social widget', 'topppa_social_widget', 'social', 'Social', 'free'],
            ['topppa-header-offcanvas widget', 'topppa_header_offcanvas_widget', 'list', 'Header Offcanvas', 'pro'],
            ['topppa-header-menu widget', 'topppa_header_menu_widget', 'list', 'Nav Menu', 'free'],
            ['topppa-slider widget', 'topppa_slider_widget', 'list', 'Hero Slider', 'free'],
            ['topppa-service widget', 'topppa_service_widget', 'list', 'Service', 'free'],
            ['topppa-service-v2 widget', 'topppa_service_v2_widget', 'list', 'Service V2', 'pro'],
            ['topppa-service-v3 widget', 'topppa_service_v3_widget', 'list', 'Service V3', 'pro'],
            ['topppa-counter widget', 'topppa_counter_widget', 'list', 'Counter', 'free'],
            ['topppa-testimonial widget', 'topppa_testimonial_widget', 'list', 'Testimonial', 'free'],
            ['topppa-testimonial-two widget', 'topppa_testimonial_two_widget', 'list', 'Testimonial Two', 'pro'],
            ['topppa-testimonial-three widget', 'topppa_testimonial_three_widget', 'list', 'Testimonial Three', 'pro'],
            ['topppa-testimonial-four widget', 'topppa_testimonial_four_widget', 'list', 'Testimonial Four', 'pro'],
            ['topppa-brand-logo widget', 'topppa_brand_logo_widget', 'list', 'Brand Logo', 'free'],
            ['topppa-blog widget', 'topppa_blog_widget', 'list', 'Blog', 'free'],
            ['topppa-list-item widget', 'topppa_list_item_widget', 'list', 'List Item', 'free'],
            ['topppa-item-box widget', 'topppa_item_box_widget', 'list', 'Item Box', 'free'],
            ['topppa-icon-box widget', 'topppa_icon_box_widget', 'list', 'Icon Box', 'free'],
            ['topppa-contact-form widget', 'topppa_contact_form_widget', 'list', 'Contact Form 7', 'free'],
            ['topppa-image widget', 'topppa_image_widget', 'list', 'Image', 'free'],
            ['topppa-video-button widget', 'topppa_video_button_widget', 'list', 'Video Button', 'free'],
            ['topppa-advanced-tab widget', 'topppa_advanced_tab_widget', 'list', 'Advanced Tab', 'free'],
            ['topppa-pricing-table widget', 'topppa_pricing_table_widget', 'list', 'Pricing Table', 'free'],
            ['topppa-faq widget', 'topppa_faq_widget', 'list', 'Faq', 'free'],
            ['topppa-team widget', 'topppa_team_widget', 'list', 'Team', 'free'],
            ['topppa-post-title widget', 'topppa_post_title_widget', 'post', 'Post Title', 'free'],
            ['topppa-page-title widget', 'topppa_page_title_widget', 'post', 'Page Title', 'free'],
            ['topppa-post-image widget', 'topppa_post_image_widget', 'post', 'Post Image', 'free'],
            ['topppa-post-meta widget', 'topppa_post_meta_widget', 'post', 'Post Meta', 'free'],
            ['topppa-post-content widget', 'topppa_post_content_widget', 'post', 'Post Content', 'free'],
            ['topppa-post-share widget', 'topppa_post_share_widget', 'post', 'Post Share', 'free'],
            ['topppa-post-tags widget', 'topppa_post_tags_widget', 'post', 'Post Tags/Category', 'free'],
            ['topppa-post-navication widget', 'topppa_post_navication_widget', 'post', 'Post Navigation', 'pro'],
            ['topppa-post-author-section widget', 'topppa_post_author_section_widget', 'post', 'Post Author Section', 'pro'],
            ['topppa-post-comment widget', 'topppa_post_comment_widget', 'post', 'Post Comment Box', 'free'],
            ['topppa-sidebar-post widget', 'topppa_sidebar_post_widget', 'post', 'Sidebar Post', 'pro'],
            ['topppa-breadcrumb widget', 'topppa_breadcrumb_widget', 'list', 'Breadcrumb', 'free'],
            ['topppa-search-box widget', 'topppa_search_box_widget', 'post', 'Search Box', 'free'],
            ['topppa-facebook-feed widget', 'topppa_facebook_feed_widget', 'social', 'Facebook Feed', 'pro'],
            ['topppa-twitter-feed-widget widget', 'topppa_twitter_feed_widget', 'social', 'Twitter Feed', 'pro'],
            ['topppa-instagram-feed widget', 'topppa_instagram_feed_widget', 'social', 'Instagram Feed', 'pro'],
            ['topppa-project-widget widget', 'topppa_project_widget', 'list', 'Project', 'pro'],
            ['topppa-project-v2-widget widget', 'topppa_project_v2_widget', 'list', 'Project V2', 'pro'],
            ['topppa-flip-box-widget widget', 'topppa_flip_box_widget', 'list', 'Flip Box', 'free'],
            ['topppa-countdown-widget widget', 'topppa_countdown_widget', 'list', 'Countdown', 'free'],
            ['topppa-gallery-widget widget', 'topppa_gallery_widget', 'list', 'Grid Gallery', 'free'],
            ['topppa-hospot-widget widget', 'topppa_hotspot_widget', 'list', 'Hotspot', 'free'],
            ['topppa-timeline-widget widget', 'topppa_timeline_widget', 'list', 'Timeline', 'free'],
            ['topppa-shop-widget widget', 'topppa_shop_widget', 'shop', 'Shop', 'free'],
            ['topppa-product-thumbnail-widget widget', 'topppa_product_thumbnail_widget', 'shop', 'Product Thumbnail', 'free'],
            ['topppa-product-price-widget widget', 'topppa_product_price_widget', 'shop', 'Product Price', 'free'],
            ['topppa-product-rating-and-review-widget widget', 'topppa_product_rating_and_review_widget', 'shop', 'Product Rating/Review', 'free'],
            ['topppa-product-title-widget widget', 'topppa_product_title_widget', 'shop', 'Product Title/Excerpt', 'free'],
            ['topppa-product-cart-button-widget widget', 'topppa_product_cart_button_widget', 'shop', 'Product Cart Button', 'free'],
            ['topppa-product-categories-tags-widget widget', 'topppa_product_categories_tags_widget', 'shop', 'Product Category/Tag', 'free'],
            ['topppa-product-description-widget widget', 'topppa_product_description_widget', 'shop', 'Product Description', 'free'],
            ['topppa-product-review-comment-widget widget', 'topppa_product_review_comment_widget', 'shop', 'Product Review/Comment', 'free'],
            ['topppa-product-cart-page-widget widget', 'topppa_product_cart_page_widget', 'shop', 'Product Cart Page', 'free'],
            ['topppa-product-additional-info-widget widget', 'topppa_product_additional_info_widget', 'shop', 'Product Additional Info', 'free'],
            ['topppa-product-checkout-page-widget widget', 'topppa_product_checkout_page_widget', 'shop', 'Product Checkout Page', 'free'],
            ['topppa-accordion-image-widget widget', 'topppa_accordion_image_widget', 'list', 'Advance Accordion Image', 'free'],
            ['topppa-progress-bar-widget widget', 'topppa_progress_bar_widget', 'list', 'Progress Bar', 'free'],
            ['topppa-wp-forms-widget widget', 'topppa_wp_forms_widget', 'list', 'WP Form', 'free'],
            ['topppa-mailchimp-widget widget', 'topppa_mailchimp_widget', 'list', 'Mailchimp', 'free'],
            ['topppa-weform-widget widget', 'topppa_weform_widget', 'list', 'Weforms', 'free'],
            ['topppa-ninjaform-widget widget', 'topppa_ninjaform_widget', 'list', 'Ninja Form', 'pro'],
            ['topppa-advance-review-widget widget', 'topppa_advance_review_widget', 'list', 'Advance Review', 'pro'],
            ['topppa-facebook-review-widget widget', 'topppa_facebook_review_widget', 'list', 'Facebook Review', 'pro'],
            ['topppa-yelp-review-widget widget', 'topppa_yelp_review_widget', 'list', 'Yelp Review', 'pro'],
            ['topppa-heading-widget widget', 'topppa_heading_widget', 'list', 'Advanced Heading', 'free'],
            ['topppa-custom-carousel-widget widget', 'topppa_custom_carousel_widget', 'list', 'Custom Carousel', 'pro'],
            ['topppa-cpt-builder-meta-widget widget', 'topppa_cpt_builder_meta_widget', 'post', 'CPT Builder Meta', 'pro'],
            ['topppa-audio-player-widget widget', 'topppa_audio_player_widget', 'post', 'Audio Player', 'free'],
            ['topppa-image-slider-widget widget', 'topppa_image_slider_widget', 'post', 'Image Slider', 'free'],
            ['topppa-service-slider-widget widget', 'topppa_service_slider_widget', 'post', 'Service Slider', 'free'],
            ['topppa-toggle-widget widget', 'topppa_toggle_widget', 'post', 'Toggle', 'free'],
            ['topppa-trade-coin-widget widget', 'topppa_trade_coin_widget', 'post', 'Trade Coin', 'free'],
            ['topppa-trip-taxonomy-module-widget widget', 'topppa_trip_taxonomy_module_widget', 'post', 'Trip Taxonomy Module', 'free'],
            ['topppa-trip-module-widget widget', 'topppa_trip_module_widget', 'post', 'Trip Module', 'free'],
            ['topppa-trip-module-v2-widget widget', 'topppa_trip_module_v2_widget', 'post', 'Trip Module V2', 'free'],
            ['topppa-trip-search-widget widget', 'topppa_trip_search_widget', 'post', 'Trip Search', 'free'],
            ['topppa-data-table-widget widget', 'topppa_data_table_widget', 'post', 'Data Table', 'free'],
        ];
        
        return $widgets;
    }
    
    private function get_dashboard_extensions() {
        $extensions = [
            ['Assets Manager', 'topppa_assets_manager', '', 'Assets Manager', 'free'],
            ['Smooth Scroller', 'topppa_smooth_scroller', '', 'Smooth Scroller', 'free'],
            ['Template Library (in Editor)', 'topppa_template_library', '', 'Template Library (in Editor)', 'free'],
            ['Mega Menu', 'topppa_mega_menu', '', 'Mega Menu', 'free'],
            ['Custom Post Type Builder', 'topppa_cpt_builder', '', 'Custom Post Type Builder', 'pro'],
            ['Custom Icon', 'topppa_custom_icon', '', 'Custom Icon', 'free'],
            ['Custom Font', 'topppa_custom_font', '', 'Custom Font', 'pro'],
            ['Sticky Section', 'topppa_sticky_section', '', 'Sticky Section', 'free'],
            ['Grid Line', 'topppa_grid_line', '', 'Grid Line', 'free'],
            ['Scroll to Top', 'topppa_scroll_to_top', '', 'Scroll to Top', 'free'],
            ['Custom CSS', 'topppa_custom_css', '', 'Custom CSS', 'free'],
            ['Container Hover Effects', 'topppa_container_hover_effects', '', 'Container Hover Effects', 'free'],
            ['Cursor Effect', 'topppa_cursor_effect', '', 'Cursor Effect', 'free'],
            ['Split Text Animation', 'topppa_split_text_animation', '', 'Split Text Animation', 'free'],
            ['Interactive Animations', 'interactive_animations', '', 'Interactive Animations', 'free'],
            ['Advanced Image Hover', 'advanced_image_hover', '', 'Advanced Image Hover', 'free'],
            ['Tooltip Section', 'topppa_tooltip_section', '', 'Tooltip Section', 'free'],
            ['Wrapper Link', 'topppa_wrapper_link', '', 'Wrapper Link', 'free'],
            ['Conditional Display', 'topppa_conditional_display', '', 'Conditional Display', 'free'],
            ['Pin Section', 'pin_section', '', 'Pin Section', 'free'],
            ['WOW Animation', 'topppa_wow_animation', '', 'WOW Animation', 'free'],
            ['Reveal Effect', 'topppa_reveal_effect', '', 'Reveal Effect', 'free'],
        ];
        
        return $extensions;
    }
    
    /**
     * Check if the pro plugin is installed, active, and properly licensed
     */
    private function is_pro_plugin_installed() {
        if (function_exists('topppa_can_use_premium_features') && topppa_can_use_premium_features()) {
            return true;
        }
        
        if (class_exists('TopperPack_Pro')) {
            if (method_exists('TopperPack_Pro', 'is_license_valid') && TopperPack_Pro::is_license_valid()) {
                return true;
            }
            
            if (method_exists('TopperPack_Pro', 'is_active') && TopperPack_Pro::is_active()) {
                return true;
            }
            
            $license_key = get_option('topper_pack_pro_license_key');
            $license_status = get_option('topper_pack_pro_license_status');
            
            if ($license_key && $license_status === 'valid') {
                return true;
            }
        }
        
        if (function_exists('topppa_pro_is_active') && topppa_pro_is_active()) {
            return true;
        }
        
        if (function_exists('topppa_pro_is_licensed') && topppa_pro_is_licensed()) {
            return true;
        }
        
        $pro_plugin_path = WP_PLUGIN_DIR . '/topper-pack-pro/topper-pack-pro.php';
        if (file_exists($pro_plugin_path)) {
            $active_plugins = get_option('active_plugins');
            foreach ($active_plugins as $plugin) {
                if (strpos($plugin, 'topper-pack-pro') !== false) {
                    $license_key = get_option('topper_pack_pro_license_key');
                    $license_status = get_option('topper_pack_pro_license_status');
                    
                    if ($license_key && $license_status === 'valid') {
                        return true;
                    }
                    
                    return true;
                }
            }
        }
        
        return false;
    }
    
    public function get_widgets_data() {
        $widgets = $this->get_dashboard_widgets();
        $is_pro_installed = $this->is_pro_plugin_installed();
        
        // Define default enabled widgets
        $default_enabled_widgets = [
            'topppa_logo_widget',
            'topppa_header_info_widget',
            'topppa_button_widget',
            'topppa_social_widget',
            'topppa_header_menu_widget',
            'topppa_slider_widget',
            'topppa_service_widget',
            'topppa_counter_widget',
            'topppa_testimonial_widget',
            'topppa_brand_logo_widget',
            'topppa_blog_widget',
            'topppa_list_item_widget',
            'topppa_item_box_widget',
            'topppa_icon_box_widget',
            'topppa_image_widget',
            'topppa_advanced_tab_widget',
            'topppa_pricing_table_widget',
            'topppa_faq_widget',
            'topppa_team_widget',
            'topppa_flip_box_widget',
            'topppa_countdown_widget',
            'topppa_timeline_widget',
            'topppa_image_slider_widget',
            'topppa_contact_form_widget',
            'topppa_video_button_widget',
            'topppa_breadcrumb_widget',
            'topppa_search_box_widget',
            'topppa_accordion_image_widget',
            'topppa_progress_bar_widget',
            'topppa_heading_widget',
            'topppa_toggle_widget',
            
        ];
        
        $widgets_data = [];
        foreach ($widgets as $widget) {
            $widget_id = $widget[1];
            $widget_title = $widget[3];
            $widget_type = $widget[4];
            
            $show_toggle = ($widget_type === 'free' || ($widget_type === 'pro' && $is_pro_installed));
            
            // Check if widget should be enabled by default
            $is_default_enabled = in_array($widget_id, $default_enabled_widgets);
            $current_option = get_option($widget_id, $is_default_enabled ? 'yes' : 'no');
            
            $widgets_data[$widget_id] = [
                'title' => $widget_title,
                'is_pro' => ($widget_type === 'pro'),
                'is_pro_installed' => $is_pro_installed,
                'show_toggle' => $show_toggle,
                'is_active' => ($show_toggle ? ($current_option === 'yes') : false),
                // translators: %s is the widget title
                'description' => sprintf(__('Widget for %s', 'topper-pack'), $widget_title)
            ];
        }
        
        return $widgets_data;
    }
    
    public function get_features_data() {
        $extensions = $this->get_dashboard_extensions();
        $is_pro_installed = $this->is_pro_plugin_installed();
        
        // Define default enabled features
        $default_enabled_features = [
            'topppa_assets_manager',
            'topppa_template_library',
            'topppa_mega_menu',
            'topppa_custom_icon',
            'topppa_scroll_to_top',
            'topppa_grid_line',
        ];
        
        $features_data = [];
        foreach ($extensions as $extension) {
            $extension_id = $extension[1];
            $extension_title = $extension[3];
            $extension_type = $extension[4];
            
            $show_toggle = ($extension_type === 'free' || ($extension_type === 'pro' && $is_pro_installed));
            
            // Check if feature should be enabled by default
            $is_default_enabled = in_array($extension_id, $default_enabled_features);
            $current_option = get_option($extension_id, $is_default_enabled ? 'yes' : 'no');
            
            $features_data[$extension_id] = [
                'title' => $extension_title,
                'is_pro' => ($extension_type === 'pro'),
                'is_pro_installed' => $is_pro_installed,
                'show_toggle' => $show_toggle,
                'is_active' => ($show_toggle ? ($current_option === 'yes') : false),
                // translators: %s is the extension title
                'description' => sprintf(__('Extension for %s', 'topper-pack'), $extension_title)
            ];
        }
        
        return $features_data;
    }
    
    public function save_wizard_data() {
        if (!wp_doing_ajax()) {
            wp_die(esc_html__('Invalid request.', 'topper-pack'));
        }
        
        header('Content-Type: application/json');
        
        check_ajax_referer('topper_pack_wizard_nonce', 'nonce');
        
        if (!current_user_can('manage_options')) {
            wp_send_json_error(esc_html__('You do not have sufficient permissions to access this page.', 'topper-pack'));
        }
        
        $data = $_POST['data'] ?? [];
        $step = sanitize_text_field($_POST['step'] ?? '');
        
        try {
            switch ($step) {
                case 'congrats':
                    $this->save_wizard_selections();
                    $this->complete_wizard();
                    wp_send_json_success(array(
                        'status' => 200,
                        'message' => esc_html__('Wizard completed successfully!', 'topper-pack'),
                        'redirect_url' => admin_url('admin.php?page=topper-pack')
                    ));
                    break;
                    
                case 'skip':
                    $this->complete_wizard();
                    wp_send_json_success(array(
                        'status' => 200,
                        'message' => esc_html__('Wizard skipped successfully!', 'topper-pack'),
                        'redirect_url' => admin_url('admin.php?page=topper-pack')
                    ));
                    break;
                    
                default:
                    wp_send_json_error(esc_html__('Invalid step.', 'topper-pack'));
                    break;
            }
        } catch (Exception $e) {
            wp_send_json_error(esc_html__('Error completing wizard: ', 'topper-pack') . $e->getMessage());
        }
    }
    
    private function save_wizard_selections() {
        $selected_widgets = isset($_POST['selected_widgets']) ? $_POST['selected_widgets'] : [];
        $selected_extensions = isset($_POST['selected_extensions']) ? $_POST['selected_extensions'] : [];
        
        if (empty($selected_widgets) && empty($selected_extensions)) {
            $wizard_state = get_transient('topper_pack_wizard_state');
            if ($wizard_state) {
                $selected_widgets = $wizard_state['widgets'] ?? [];
                $selected_extensions = $wizard_state['extensions'] ?? [];
            }
        }
        
        $this->save_widgets_to_plugin($selected_widgets);
        $this->save_extensions_to_plugin($selected_extensions);
    }
    
    private function save_widgets_to_plugin($selected_widgets) {
        $widgets_data = $this->get_widgets_data();
        $is_pro_installed = $this->is_pro_plugin_installed();
        
        foreach ($widgets_data as $widget_slug => $widget_data) {
            if ($widget_data['is_pro'] && !$is_pro_installed) {
                continue;
            }
            
            if (in_array($widget_slug, $selected_widgets)) {
                update_option($widget_slug, 'yes');
            } else {
                $current_value = get_option($widget_slug, 'yes');
                if ($current_value === 'yes') {
                    update_option($widget_slug, 'no');
                }
            }
        }
    }
    
    private function save_extensions_to_plugin($selected_extensions) {
        $extensions_data = $this->get_features_data();
        $is_pro_installed = $this->is_pro_plugin_installed();
        
        foreach ($extensions_data as $extension_slug => $extension_data) {
            if ($extension_data['is_pro'] && !$is_pro_installed) {
                continue;
            }
            
            if (in_array($extension_slug, $selected_extensions)) {
                update_option($extension_slug, 'yes');
            } else {
                $current_value = get_option($extension_slug, 'yes');
                if ($current_value === 'yes') {
                    update_option($extension_slug, 'no');
                }
            }
        }
    }
    
    private function complete_wizard() {
        update_option('topper_pack_wizard_completed', 'yes');
        delete_option('topper_pack_show_wizard');
        update_option('topppa_custom_post_types', array());
        
        flush_rewrite_rules();
        wp_cache_delete('topper_pack_wizard_redirect', 'options');
        delete_transient('topper_pack_wizard_state');
        wp_cache_flush();
        
        return true;
    }
    
    private function is_wizard_completed() {
        $completed = get_option('topper_pack_wizard_completed');
        $show_wizard = get_option('topper_pack_show_wizard');
        
        return ($completed === 'yes' && $show_wizard !== 'yes');
    }
    
    public function reset_wizard() {
        delete_option('topper_pack_wizard_completed');
        update_option('topper_pack_show_wizard', 'yes');
        
        // Clear all wizard-related caches and transients
        delete_transient('topper_pack_wizard_state');
        wp_cache_delete('topper_pack_wizard_redirect', 'options');
        wp_cache_flush();
        
        // Clear browser localStorage by adding a cache-busting parameter
        if (isset($_GET['reset_cache']) && $_GET['reset_cache'] === 'true') {
            // This will force JavaScript to reload defaults
            add_action('admin_footer', function() {
                echo '<script>
                    if (typeof localStorage !== "undefined") {
                        localStorage.removeItem("topppa_selected_widgets");
                        localStorage.removeItem("topppa_selected_extensions");
                    }
                </script>';
            });
        }
    }
    
    public function force_reset_all_widget_options() {
        // Get all widgets and extensions
        $widgets = $this->get_dashboard_widgets();
        $extensions = $this->get_dashboard_extensions();
        
        // Define default enabled widgets (same as in get_widgets_data)
        $default_enabled_widgets = [
            'topppa_logo_widget',
            'topppa_header_info_widget',
            'topppa_button_widget',
            'topppa_social_widget',
            'topppa_header_menu_widget',
            'topppa_slider_widget',
            'topppa_service_widget',
            'topppa_counter_widget',
            'topppa_testimonial_widget',
            'topppa_brand_logo_widget',
            'topppa_blog_widget',
            'topppa_list_item_widget',
            'topppa_item_box_widget',
            'topppa_icon_box_widget',
            'topppa_image_widget',
            'topppa_advanced_tab_widget',
            'topppa_pricing_table_widget',
            'topppa_faq_widget',
            'topppa_team_widget',
            'topppa_flip_box_widget',
            'topppa_countdown_widget',
            'topppa_timeline_widget',
            'topppa_image_slider_widget',
            'topppa_contact_form_widget',
            'topppa_video_button_widget',
            'topppa_breadcrumb_widget',
            'topppa_search_box_widget',
            'topppa_accordion_image_widget',
            'topppa_progress_bar_widget',
            'topppa_heading_widget',
            'topppa_toggle_widget',
        ];
        
        // Define default enabled features
        $default_enabled_features = [
            'topppa_assets_manager',
            'topppa_template_library',
            'topppa_mega_menu',
            'topppa_custom_icon',
            'topppa_scroll_to_top',
            'topppa_grid_line',
        ];
        
        // Reset all widget options
        foreach ($widgets as $widget) {
            $widget_id = $widget[1];
            $is_default_enabled = in_array($widget_id, $default_enabled_widgets);
            update_option($widget_id, $is_default_enabled ? 'yes' : 'no');
        }
        
        // Reset all extension options
        foreach ($extensions as $extension) {
            $extension_id = $extension[1];
            $is_default_enabled = in_array($extension_id, $default_enabled_features);
            update_option($extension_id, $is_default_enabled ? 'yes' : 'no');
        }
        
        // Clear all caches
        wp_cache_flush();
        delete_transient('topper_pack_wizard_state');
        
        return true;
    }
    
    public function maybe_redirect_to_wizard() {
        if (isset($_GET['step']) && $_GET['step'] === 'congrats') {
            return;
        }
        
        if (isset($_GET['page']) && strpos($_GET['page'], 'topper-pack') === 0) {
            return;
        }
        
        if ($this->is_wizard_completed()) {
            return;
        }
        
        if (get_option('topper_pack_show_wizard') === 'yes') {
            if (!isset($_GET['page']) || $_GET['page'] !== 'topper-pack-wizard') {
                add_action('admin_footer', function() {
                    echo '<script>window.location.href = "' . esc_url(admin_url('admin.php?page=topper-pack-wizard')) . '";</script>';
                });
                return;
            }
        }
    }
    
    public function handle_wizard_access() {
        // Check if someone is trying to access the wizard page directly
        if (isset($_GET['page']) && $_GET['page'] === 'topper-pack-wizard') {
            // If wizard is completed, redirect to main dashboard
            if ($this->is_wizard_completed()) {
                wp_redirect(admin_url('admin.php?page=topper-pack'));
                exit;
            }
            
            // If wizard should not be shown, redirect to main dashboard
            if (get_option('topper_pack_show_wizard') !== 'yes') {
                wp_redirect(admin_url('admin.php?page=topper-pack'));
                exit;
            }
        }
    }
    
    /**
     * Hide WordPress admin notices on the wizard page using WordPress hooks
     */
    public function hide_admin_notices_hooks() {
        // Only hide notices on the wizard page
        if (!isset($_GET['page']) || $_GET['page'] !== 'topper-pack-wizard') {
            return;
        }
        
        // Remove all admin notices
        remove_all_actions('admin_notices');
        remove_all_actions('all_admin_notices');
        
        // Remove specific plugin notices
        remove_all_actions('wp_rocket_notice');
        remove_all_actions('one_click_demo_import_notice');
        
        // Remove theme notices
        remove_all_actions('theme_notices');
        
        // Remove plugin update notices
        remove_all_actions('plugin_notices');
        
        // Remove any other common notice hooks
        remove_all_actions('admin_notices');
        remove_all_actions('network_admin_notices');
        remove_all_actions('user_admin_notices');
        
        // Clear any stored notices
        if (function_exists('wp_clear_admin_notices')) {
            wp_clear_admin_notices();
        }
        
        // Remove notice actions from specific plugins
        global $wp_filter;
        if (isset($wp_filter['admin_notices'])) {
            unset($wp_filter['admin_notices']);
        }
        if (isset($wp_filter['all_admin_notices'])) {
            unset($wp_filter['all_admin_notices']);
        }
    }
    
    public static function init() {
        new self();
    }
}

TopperPack_Setup_Wizard::init(); 