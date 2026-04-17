<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
/**
 * Add the main menu page and settings sub-page for the Topper Pack Widgets.
 */
add_action('admin_menu', 'topppa_add_main_and_settings_page');
function topppa_add_main_and_settings_page() {
    // Main parent menu titled "Topper Pack"
    add_menu_page(
        'Topper Pack',     // Page title
        'Topper Pack',     // Menu title
        'manage_options',    // Capability
        'topper-pack',     // Menu slug for parent
        'topppa_home_page',     // Callback function for the main page
        '',                  // Icon URL
        2                    // Menu position at the top
    );

    // Sub menu 
    add_submenu_page(
        'topper-pack',
        'Home',
        'Home',
        'manage_options',
        'topper-pack',
        'topppa_home_page'
    );

    add_submenu_page(
        'topper-pack',
        'Widgets',
        'Widgets',
        'manage_options',
        'topper-pack-widgets',
        'topppa_home_page'
    );

    add_submenu_page(
        'topper-pack',
        'Extensions',
        'Extensions',
        'manage_options',
        'topper-pack-extensions',
        'topppa_home_page'
    );

    add_submenu_page(
        'topper-pack',
        'API Settings',
        'API Settings',
        'manage_options',
        'topper-pack-api-settings',
        'topppa_home_page'
    );

    add_submenu_page(
        'topper-pack',
        'Extra Settings',
        'Extra Settings',
        'manage_options',
        'topper-pack-extra-settings',
        'topppa_home_page'
    );


    if ('yes' === get_option('topppa_cpt_builder')) {
        add_submenu_page(
            'topper-pack',
            'CPT builder',
            'CPT builder',
            'manage_options',
            'topper-pack-cpt-builder',
            'topppa_home_page'
        );
    }
}

/**
 * Enqueue admin scripts for AJAX functionality.
 */
add_action('admin_enqueue_scripts', 'topppa_enqueue_admin_scripts');
function topppa_enqueue_admin_scripts() {
    wp_enqueue_script('topppa-admin', plugin_dir_url(__FILE__) . 'assets/js/topppa-admin.min.js', ['jquery'], '1.0', true);

    // Enqueue import/export script on plugin admin pages
    $current_screen = get_current_screen();
    if ($current_screen && strpos($current_screen->id, 'topper-pack') !== false) {
        wp_enqueue_script('topppa-import-export', plugin_dir_url(__FILE__) . 'assets/js/topppa-import-export.min.js', ['jquery'], TOPPPA_VER, true);
    }

    // Localize AJAX variables for both scripts
    $ajax_data = ['ajax_url' => admin_url('admin-ajax.php'), 'topppa_nonce' => wp_create_nonce('topppa_settings_nonce')];
    wp_localize_script('topppa-admin', 'topppa_ajax', $ajax_data);

    // Also localize for import/export script if it's enqueued
    if ($current_screen && strpos($current_screen->id, 'topper-pack') !== false) {
        wp_localize_script('topppa-import-export', 'topppa_ajax', $ajax_data);
    }
}


/**
 * Enqueue admin style.
 */
add_action('admin_enqueue_scripts', 'topppa_enqueue_admin_styles');
function topppa_enqueue_admin_styles() {
    wp_enqueue_style('topppa-admin', plugin_dir_url(__FILE__) . 'assets/css/topppa-admin.css', [], TOPPPA_VER);

    // Enqueue import/export styles on plugin admin pages
    $current_screen = get_current_screen();
    if ($current_screen && strpos($current_screen->id, 'topper-pack') !== false) {
        wp_enqueue_style('topppa-import-export', plugin_dir_url(__FILE__) . 'assets/css/topppa-import-export.css', [], TOPPPA_VER);
    }
}


/**
 * Render the Topper Pack home page content with Dashboard and Widgets tabs.
 */
function topppa_home_page() {
?>
    <div class="topppa-dashboard-main">
        <!-- Vertical Tab navigation with Dashboard and Widgets tabs -->
        <div class="topppa-tab-wrapper">
            <div class="topppa-nav-left-sidebar-wrapper">
                <div class="topppa-admin-logo">
                    <img src="<?php echo esc_url(TOPPPA_ADMIN_URL . 'assets/images/logo.png'); ?>" alt="<?php echo esc_attr__('Topper Pack Addons', 'topper-pack'); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
                                                                                                        ?>">
                    <span class="topppa-version"><?php esc_html_e('v', 'topper-pack'); ?><?php echo esc_html(TOPPPA_VER); ?></span>
                </div>
                <div class="topppa-nav-tab-wrapper">
                    <a href="#topppa-dashboard" class="topppa-dashboard-tab topppa-nav-tab nav-tab nav-tab-active" data-tab="topppa-dashboard"><span class="dashicons dashicons-dashboard"></span> <?php esc_html_e('Dashboard', 'topper-pack'); ?></a>
                    <a href="#widgets" class="topppa-nav-tab topppa-widgets-tab nav-tab" data-tab="topppa-widgets"><span class="dashicons dashicons-screenoptions"></span><?php esc_html_e('Widgets', 'topper-pack'); ?></a>
                    <a href="#extensions" class="topppa-extensions-tab topppa-nav-tab nav-tab" data-tab="topppa-extensions"><span class="dashicons dashicons-text"></span> <?php esc_html_e('Extensions', 'topper-pack'); ?></a>

                    <?php if ('yes' === get_option('topppa_cpt_builder')) : ?>
                        <a href="#cpt-builder" class="topppa-cpt-builder-tab topppa-nav-tab nav-tab" data-tab="topppa-cpt-builder"><span class="dashicons dashicons-editor-insertmore"></span> <?php esc_html_e('CPT Builder', 'topper-pack'); ?></a>
                    <?php endif; ?>

                    <a href="#api-settings" class="topppa-api-settings-tab topppa-nav-tab nav-tab" data-tab="topppa-api-settings"><span class="dashicons dashicons-admin-links"></span> <?php esc_html_e('API Settings', 'topper-pack'); ?></a>
                    <a href="#extra-settings" class="topppa-extra-settings-tab topppa-nav-tab nav-tab" data-tab="topppa-extra-settings"><span class="dashicons dashicons-admin-settings"></span> <?php esc_html_e('Extra Settings', 'topper-pack'); ?></a>
                    <a href="#import-export" class="topppa-import-export-tab topppa-nav-tab nav-tab" data-tab="topppa-import-export"><span class="dashicons dashicons-migrate"></span> <?php esc_html_e('Import/Export', 'topper-pack'); ?></a>
                </div>
            </div>

            <div class="topppa-admin-body-section-start">
                <div class="topppa-admin-body-wrapper">
                    <!-- Dashboard Content Tab -->
                    <div id="topppa-dashboard" class="topppa-dashboard topppa-dashboard-global tab-content active">
                        <div class="topppa-admin-pace__mb50 topppa-dashboard-banner-wrapper" style="background-image: url(<?php echo esc_url(TOPPPA_ADMIN_URL . 'assets/images/desh-banner.jpg'); ?>)">
                            <div class="topppa-dashboard-banner-content-wrapper">
                                <div class="topppa-dashboard-banner-content">
                                    <h2><?php esc_html_e('Welcome To Topper Pack', 'topper-pack'); ?></h2>
                                    <p><?php esc_html_e('Unlock endless creativity and transform your ideas', 'topper-pack'); ?></p>
                                </div>
                                <div class="topppa-dashboard-banner-button">
                                    <a href="https://topperpack.com" target="_blank" class="topppa-banner-button topppa-dashboard-btn-global"><?php esc_html_e('Visit Our Profile', 'topper-pack'); ?></a>
                                </div>
                            </div>
                        </div>

                        <div class="topppa-admin-global-flx topppa-admin-info-box-wrapper">
                            <div class="topppa-admin-item__box topppa-admin-pace__py45">
                                <div class="topppa-admin-item__icon">
                                    <i class="icon-element eicon-facebook"></i>
                                </div>
                                <h3 class="topppa-admin-item__title"><?php esc_html_e('Join Us on Facebook', 'topper-pack'); ?></h3>
                                <p class="topppa-admin-item__dec"><?php esc_html_e('Connect with like-minded individuals, get the latest updates, share your experiences, and engage in meaningful conversations.', 'topper-pack'); ?></p>
                                <a href="https://www.facebook.com/themepul" target="_blank" class="topppa-admin-item__btn topppa-dashboard-btn-global"><?php esc_html_e('Join Our Page', 'topper-pack'); ?></a>
                            </div>
                            <div class="topppa-admin-item__box topppa-admin-pace__py45">
                                <div class="topppa-admin-item__icon">
                                    <i class="icon-element eicon-mail"></i>
                                </div>
                                <h3 class="topppa-admin-item__title"><?php esc_html_e('Need Help?', 'topper-pack'); ?></h3>
                                <p class="topppa-admin-item__dec"><?php esc_html_e('Have questions or need assistance? Our support team is here to help you every step of the way.', 'topper-pack'); ?></p>
                                <div class="topppa-admin-item__button">
                                    <a href="https://support.topperpack.com/" target="_blank" class="topppa-admin-item__btn topppa-dashboard-btn-global"><?php esc_html_e('Create A Ticket', 'topper-pack'); ?></a>
                                </div>
                            </div>
                            <div class="topppa-admin-item__box topppa-admin-pace__py45">
                                <div class="topppa-admin-item__icon">
                                    <i class="icon-element eicon-document-file"></i>
                                </div>
                                <h3 class="topppa-admin-item__title"><?php esc_html_e('Brows Help Articles', 'topper-pack'); ?></h3>
                                <p class="topppa-admin-item__dec"><?php esc_html_e('Explore detailed documentation and learn how to build your website effortlessly with Topper Pack Addons.', 'topper-pack'); ?></p>
                                <a href="https://doc.topperpack.com/" target="_blank" class="topppa-admin-item__btn topppa-dashboard-btn-global"><?php esc_html_e('Documentation', 'topper-pack'); ?></a>
                            </div>

                        </div>

                        <!-- Video Tutorial -->
                        <div class="topppa-admin-video-tutorial">
                            <div class="topppa-admin-pace__mt50 topppa-admin-video-tutorial__section">
                                <h3 class="topppa-admin-video-tutorial__title"><?php esc_html_e('Video Tutorial', 'topper-pack'); ?></h3>
                                <p class="topppa-admin-video-tutorial__dec"><?php esc_html_e('Quick and easy guide to mastering Topper Pack', 'topper-pack'); ?></p>
                            </div>
                            <div class="topppa-admin-global-flx">
                                <div class="topppa-admin-item__box">
                                    <div class="topppa-admin-item__video" style="position:relative;padding-bottom:56.25%;height:0;overflow:hidden;">
                                        <iframe src="https://www.youtube.com/embed/7Dx7dZ5VnyU?si=MCvkw3ClFoogvvrN"
                                            style="position:absolute;top:0;left:0;width:100%;height:100%;"
                                            frameborder="0" allowfullscreen></iframe>
                                    </div>
                                    <h3 class="topppa-admin-item__title">
                                        <a class="topppa-admin-video-tutorial__link"
                                            href="https://www.youtube.com/watch?v=7Dx7dZ5VnyU"
                                            target="_blank" rel="noopener">
                                            <?php esc_html_e('Add Scroll to Top Button in WordPress | Topper Pack + Elementor Tutorial', 'topper-pack'); ?>
                                        </a>
                                    </h3>
                                </div>

                                <div class="topppa-admin-item__box">
                                    <div class="topppa-admin-item__video" style="position:relative;padding-bottom:56.25%;height:0;overflow:hidden;">
                                        <iframe src="https://www.youtube.com/embed/pMyDIbF_D9E?si=d27gcHwOqimzM-BM"
                                            style="position:absolute;top:0;left:0;width:100%;height:100%;"
                                            frameborder="0" allowfullscreen></iframe>
                                    </div>
                                    <h3 class="topppa-admin-item__title">
                                        <a class="topppa-admin-video-tutorial__link"
                                            href="https://www.youtube.com/watch?v=pMyDIbF_D9E"
                                            target="_blank" rel="noopener">
                                            <?php esc_html_e('How to Add Smooth Scrolling in WordPress with Topper Pack Plugin (No Code Needed)', 'topper-pack'); ?>
                                        </a>
                                    </h3>
                                </div>

                                <div class="topppa-admin-item__box">
                                    <div class="topppa-admin-item__video" style="position:relative;padding-bottom:56.25%;height:0;overflow:hidden;">
                                        <iframe src="https://www.youtube.com/embed/GFR4DzS0vuo?si=qitLF2q7NUvEMtHS"
                                            style="position:absolute;top:0;left:0;width:100%;height:100%;"
                                            frameborder="0" allowfullscreen></iframe>
                                    </div>
                                    <h3 class="topppa-admin-item__title">
                                        <a class="topppa-admin-video-tutorial__link"
                                            href="https://www.youtube.com/watch?v=GFR4DzS0vuo"
                                            target="_blank" rel="noopener">
                                            <?php esc_html_e('Make Entire Sections Clickable in Elementor | Wrapper Link Tutorial (Topper Pack)', 'topper-pack'); ?>
                                        </a>
                                    </h3>
                                </div>
                            </div>
                            <div class="topppa-admin-allvideo topppa-admin-pace__my50 topppa-text-center">
                                <a href="https://www.youtube.com/playlist?list=PLC0wAyakuaDM-jqcIh5cP3mgijpop_TqT" target="_blank" class="topppa-dashboard-btn-global"><?php esc_html_e('View All Video', 'topper-pack'); ?></a>
                            </div>
                        </div>
                    </div>

                    <!-- Widgets Content Tab with settings form -->
                    <div id="topppa-widgets" class="topppa-admin-widge-section-wrapper topppa-dashboard-global tab-content">

                        <div class="topppa-admin-filter__wrapper">
                            <div class="topppa-admin-filter__inner">
                                <div class="topppa-admin-filter__inputbox">
                                    <input type="text" placeholder="Search widget" id="topppa-widget-search">
                                    <select class="topppa-widget-category-filter" name="topppa-widget-category-filter" id="topppa-widget-category-filter">
                                        <option value=""><?php esc_html_e('Filter By ', 'topper-pack'); ?></option>
                                        <option value="list"><?php esc_html_e('List', 'topper-pack'); ?></option>
                                        <option value="post"><?php esc_html_e('Post', 'topper-pack'); ?></option>
                                        <option value="carousel"><?php esc_html_e('Carousel', 'topper-pack'); ?></option>
                                        <option value="social"><?php esc_html_e('Social', 'topper-pack'); ?></option>
                                        <option value="shop"><?php esc_html_e('Shop', 'topper-pack'); ?></option>
                                    </select>
                                </div>

                                <div class="topppa-admin-filter__buttons">
                                    <!-- Buttons for Widgets -->
                                    <button type="button" class="topppa-dashboard-btn-global topppa-admin-filter-all-active-btn" id="topppa-toggle-all-widgets"><?php esc_html_e('Activate All', 'topper-pack'); ?></button>
                                    <button id="topppa-toggle-all-widgets-deactivate" type="button" class="topppa-dashboard-btn-global topppa-admin-filter-all-deactive-btn"><?php esc_html_e('Deactivate All', 'topper-pack'); ?></button>
                                </div>
                            </div>
                        </div>

                        <!-- Widgets Area -->
                        <form id="topppa-settings-form-1" class="topppa-admin-all-widgets-extension">
                            <div class="topppa-admin-widgets-list <?php echo esc_attr(class_exists('WooCommerce') ? '' : 'topppa-is-not-woo'); ?>">
                                <?php
                                function topppa_generate_widget($widget_name, $widget_id, $widget_category, $widget_title, $widget_type, $video_url = '', $demo_url = '') {

                                    $is_pro = ('pro' === $widget_type);
                                    $is_woo = ('shop' === $widget_category);
                                    $can_use_premium = topppa_can_use_premium_features();
                                    $woo_active = class_exists('WooCommerce');

                                    // Determine if the checkbox should be disabled
                                    $disabled = '';
                                    $title = '';

                                    if ($is_pro && !$can_use_premium) {
                                        $disabled = 'disabled';
                                        $title = topppa_get_premium_restriction_message();
                                    } elseif ($is_woo && !$woo_active) {
                                        $disabled = 'disabled';
                                        $title = __('WooCommerce is not installed or active', 'topper-pack');
                                    }

                                    if ($is_woo) {
                                        // For Woo (shop) widgets, default to 'no'
                                        $checked = checked(get_option($widget_id, 'no'), 'yes', false); // phpcs:ignore WordPress.Security.NonceVerification.Recommended
                                    } else {
                                        // For all other widgets, default to 'yes'
                                        $checked = checked(get_option($widget_id, 'yes'), 'yes', false);
                                    }
                                ?>
                                    <div data-widget-name="<?php echo esc_attr($widget_name); ?>" data-widget-category="<?php echo esc_attr($widget_category); ?>" id="<?php echo esc_attr($widget_id); ?>" class="topppa-widget-checkbox <?php echo esc_attr($widget_type . ' ' . ($can_use_premium ? '' : 'topppa-no-purchase') . ' ' . ($is_woo && !$woo_active ? 'topppa-woo-disabled' : '')); ?>">
                                        <div class="topppa-widget-extension-box">
                                            <div class="topppa-admin-widget-left">
                                                <h3><?php echo esc_html($widget_title, 'topper-pack'); ?></h3>
                                                <?php if ($is_woo && !$woo_active): ?>
                                                    <div class="topppa-woo-message">
                                                        <span class="topppa-woo-status"><?php esc_html_e('WooCommerce is not active', 'topper-pack'); ?></span>
                                                    </div>
                                                <?php endif; ?>
                                                <div class="topppa-demo-video">
                                                    <?php if (!empty($video_url)): ?>
                                                        <a href="<?php echo esc_url($video_url); ?>" target="_blank"><i class="icon-element eicon-youtube"></i><?php esc_html_e('Video', 'topper-pack'); ?></a>
                                                    <?php endif; ?>
                                                    <?php if (!empty($demo_url)): ?>
                                                        <a href="<?php echo esc_url($demo_url); ?>" target="_blank"><i class="icon-element eicon-link"></i><?php esc_html_e('Demo', 'topper-pack'); ?></a>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                            <div class="topppa-admin-widget-right">
                                                <label class="topppa-admin-switch">
                                                    <input type="checkbox"
                                                        name="<?php echo esc_attr($widget_id); ?>"
                                                        class="<?php echo esc_attr($widget_category . ' ' . $widget_type); ?>"
                                                        <?php echo wp_kses_post($checked); ?>
                                                        <?php echo wp_kses_post($disabled); ?>
                                                        title="<?php echo esc_attr($title); ?>">
                                                    <span class="slider"></span>
                                                </label>
                                            </div>
                                            <?php echo wp_kses_post(topppa_get_purchase_link($is_pro, $can_use_premium, '', false)); ?>
                                        </div>
                                    </div>
                                <?php
                                }

                                $widgets = [
                                    ['topppa-logo widget', 'topppa_logo_widget', 'list', 'Logo', 'free', '#', 'https://topperpack.com/site-logo/'],
                                    ['topppa-header-info widget', 'topppa_header_info_widget', 'list', 'Header Info', 'free', '#', 'https://topperpack.com/header-info/'],
                                    ['topppa-button widget', 'topppa_button_widget', 'list', 'Button', 'free', '#', 'https://topperpack.com/creative-button/'],
                                    ['topppa-social widget', 'topppa_social_widget', 'social', 'Social', 'free', '#', 'https://topperpack.com/social-icon/'],
                                    ['topppa-header-offcanvas widget', 'topppa_header_offcanvas_widget', 'list', 'Header Offcanvas', 'pro', '#', 'https://topperpack.com/header-offcanvas/'],
                                    ['topppa-header-menu widget', 'topppa_header_menu_widget', 'list', 'Nav Menu', 'free', '#', 'https://doc.topperpack.com/docs/header-footer-widgets/nav-menu/'],
                                    ['topppa-slider widget', 'topppa_slider_widget', 'list', 'Hero Slider', 'free', '#', 'https://topperpack.com/slider/'],
                                    ['topppa-service widget', 'topppa_service_widget', 'list', 'Service', 'free', '#', 'https://topperpack.com/service/'],
                                    ['topppa-service-v2 widget', 'topppa_service_v2_widget', 'list', 'Service V2', 'pro', '#', 'https://topperpack.com/service-two/'],
                                    ['topppa-service-v3 widget', 'topppa_service_v3_widget', 'list', 'Service V3', 'pro', '#', 'https://topperpack.com/service-three/'],
                                    ['topppa-counter widget', 'topppa_counter_widget', 'list', 'Counter', 'free', '#', 'https://topperpack.com/counter/'],
                                    ['topppa-testimonial widget', 'topppa_testimonial_widget', 'list', 'Testimonial', 'free', '#', 'https://topperpack.com/testimonial/'],
                                    ['topppa-testimonial-two widget', 'topppa_testimonial_two_widget', 'list', 'Testimonial Two', 'pro', '#', 'https://topperpack.com/testimonial-two/'],
                                    ['topppa-testimonial-three widget', 'topppa_testimonial_three_widget', 'list', 'Testimonial Three', 'pro', '#', 'https://topperpack.com/testimonial-three/'],
                                    ['topppa-testimonial-four widget', 'topppa_testimonial_four_widget', 'list', 'Testimonial Four', 'pro', '#', 'https://topperpack.com/testimonial-four/'],
                                    ['topppa-brand-logo widget', 'topppa_brand_logo_widget', 'list', 'Brand Logo', 'free', '#', 'https://topperpack.com/brand-logo/'],
                                    ['topppa-blog widget', 'topppa_blog_widget', 'list', 'Blog', 'free', '#', 'https://topperpack.com/blog-widget/'],
                                    ['topppa-list-item widget', 'topppa_list_item_widget', 'list', 'List Item', 'free', '#', 'https://topperpack.com/list-item/'],
                                    ['topppa-item-box widget', 'topppa_item_box_widget', 'list', 'Item Box', 'free', '#', 'https://topperpack.com/item-box/'],
                                    ['topppa-icon-box widget', 'topppa_icon_box_widget', 'list', 'Icon Box', 'free', '#', 'https://topperpack.com/icon-box/'],
                                    ['topppa-contact-form widget', 'topppa_contact_form_widget', 'list', 'Contact Form 7', 'free', '#', 'https://topperpack.com/contact-form-7/'],
                                    ['topppa-image widget', 'topppa_image_widget', 'list', 'Image', 'free', '#', 'https://topperpack.com/image-box/'],
                                    ['topppa-video-button widget', 'topppa_video_button_widget', 'list', 'Video Button', 'free', '#', 'https://topperpack.com/video-button/'],
                                    ['topppa-advanced-tab widget', 'topppa_advanced_tab_widget', 'list', 'Advanced Tab', 'free', '#', 'https://topperpack.com/advanced-tab/'],
                                    ['topppa-pricing-table widget', 'topppa_pricing_table_widget', 'list', 'Pricing Table', 'free', '#', 'https://topperpack.com/pricing-table/'],
                                    ['topppa-faq widget', 'topppa_faq_widget', 'list', 'Faq', 'free', '#', 'https://topperpack.com/faq/'],
                                    ['topppa-team widget', 'topppa_team_widget', 'list', 'Team', 'free', '#', 'https://topperpack.com/advanced-team/'],
                                    ['topppa-post-title widget', 'topppa_post_title_widget', 'post', 'Post Title', 'free', '#', 'https://doc.topperpack.com/docs/post-widgets/post-title/'],
                                    ['topppa-page-title widget', 'topppa_page_title_widget', 'post', 'Page Title', 'free', '#', 'https://doc.topperpack.com/docs/post-widgets/page-title/'],
                                    ['topppa-post-image widget', 'topppa_post_image_widget', 'post', 'Post Image', 'free', '#', 'https://doc.topperpack.com/docs/post-widgets/post-image/'],
                                    ['topppa-post-meta widget', 'topppa_post_meta_widget', 'post', 'Post Meta', 'free', '#', 'https://doc.topperpack.com/docs/post-widgets/post-meta/'],
                                    ['topppa-post-content widget', 'topppa_post_content_widget', 'post', 'Post Content', 'free', '#', 'https://doc.topperpack.com/docs/post-widgets/post-content/'],
                                    ['topppa-post-share widget', 'topppa_post_share_widget', 'post', 'Post Share', 'free', '#', 'https://doc.topperpack.com/docs/post-widgets/post-share/'],
                                    ['topppa-post-tags widget', 'topppa_post_tags_widget', 'post', 'Post Tags/Category', 'free', '#', 'https://doc.topperpack.com/docs/post-widgets/post-tags-category/'],
                                    ['topppa-post-navication widget', 'topppa_post_navication_widget', 'post', 'Post Navigation', 'pro', '#', 'https://doc.topperpack.com/docs/post-widgets/post-navigation/'],
                                    ['topppa-post-author-section widget', 'topppa_post_author_section_widget', 'post', 'Post Author Section', 'pro', '#', 'https://doc.topperpack.com/docs/post-widgets/post-author-section/'],
                                    ['topppa-post-comment widget', 'topppa_post_comment_widget', 'post', 'Post Comment Box', 'free', '#', 'https://doc.topperpack.com/docs/post-widgets/post-comment-box/'],
                                    ['topppa-sidebar-post widget', 'topppa_sidebar_post_widget', 'post', 'Sidebar Post', 'pro', '#', 'https://doc.topperpack.com/docs/post-widgets/sidebar-post/'],
                                    ['topppa-breadcrumb widget', 'topppa_breadcrumb_widget', 'list', 'Breadcrumb', 'free', '#', 'https://topperpack.com/breadcrumb/'],
                                    ['topppa-search-box widget', 'topppa_search_box_widget', 'post', 'Search Box', 'free', '#', 'https://topperpack.com/search-box/'],
                                    ['topppa-facebook-feed widget', 'topppa_facebook_feed_widget', 'social', 'Facebook Feed', 'pro', '#', 'https://doc.topperpack.com/docs/social-and-review-widgets/facebook-feed/'],
                                    ['topppa-twitter-feed-widget widget', 'topppa_twitter_feed_widget', 'social', 'Twitter Feed', 'pro', '#', 'https://doc.topperpack.com/docs/social-and-review-widgets/twitter-feed/'],
                                    ['topppa-instagram-feed widget', 'topppa_instagram_feed_widget', 'social', 'Instagram Feed', 'pro', '#', 'https://doc.topperpack.com/docs/social-and-review-widgets/instagram-feed/'],
                                    ['topppa-project-widget widget', 'topppa_project_widget', 'list', 'Project', 'pro', '#', 'https://topperpack.com/projects/'],

                                    ['topppa-project-v2-widget widget', 'topppa_project_v2_widget', 'list', 'Project V2', 'pro', '#', 'https://topperpack.com/projects/'],
                                    ['topppa-project-v3-widget widget', 'topppa_project_v3_widget', 'list', 'Project V3', 'pro', '#', 'https://topperpack.com/projects/'],

                                    ['topppa-flip-box-widget widget', 'topppa_flip_box_widget', 'list', 'Flip Box', 'free', '#', 'https://topperpack.com/flip-box/'],
                                    ['topppa-countdown-widget widget', 'topppa_countdown_widget', 'list', 'Countdown', 'free', '#', 'https://topperpack.com/count-down/'],
                                    ['topppa-gallery-widget widget', 'topppa_gallery_widget', 'list', 'Grid Gallery', 'free', '#', 'https://topperpack.com/gallery/'],
                                    ['topppa-hospot-widget widget', 'topppa_hotspot_widget', 'list', 'Hotspot', 'free', '#', 'https://topperpack.com/hotspot/'],
                                    ['topppa-timeline-widget widget', 'topppa_timeline_widget', 'list', 'Timeline', 'free', '#', 'https://topperpack.com/timeline-widget/'],
                                    ['topppa-shop-widget widget', 'topppa_shop_widget', 'shop', 'Shop', 'free', '#', 'https://topperpack.com/shop/'],
                                    ['topppa-product-thumbnail-widget widget', 'topppa_product_thumbnail_widget', 'shop', 'Product Thumbnail', 'free', '#', 'https://doc.topperpack.com/docs/woocommerce-widgets/product-thumbnail/'],
                                    ['topppa-product-price-widget widget', 'topppa_product_price_widget', 'shop', 'Product Price', 'free', '#', 'https://doc.topperpack.com/docs/woocommerce-widgets/product-price/'],
                                    ['topppa-product-rating-and-review-widget widget', 'topppa_product_rating_and_review_widget', 'shop', 'Product Rating/Review', 'free', '#', 'https://doc.topperpack.com/docs/woocommerce-widgets/product-rating-review/'],
                                    ['topppa-product-title-widget widget', 'topppa_product_title_widget', 'shop', 'Product Title/Excerpt', 'free', '#', 'https://doc.topperpack.com/docs/woocommerce-widgets/product-title-excerpt/'],
                                    ['topppa-product-cart-button-widget widget', 'topppa_product_cart_button_widget', 'shop', 'Product Cart Button', 'free', '#', 'https://doc.topperpack.com/docs/woocommerce-widgets/cart-button/'],
                                    ['topppa-product-mini-cart-button-widget widget', 'topppa_product_mini_cart_button_widget', 'shop', 'Product Mini Cart Button', 'free', '#', 'https://doc.topperpack.com/docs/woocommerce-widgets/product-mini-cart-button/'],
                                    ['topppa-product-categories-tags-widget widget', 'topppa_product_categories_tags_widget', 'shop', 'Product Category/Tag', 'free', '#', 'https://doc.topperpack.com/docs/woocommerce-widgets/product-category-tag/'],
                                    ['topppa-product-description-widget widget', 'topppa_product_description_widget', 'shop', 'Product Description', 'free', '#', 'https://doc.topperpack.com/docs/woocommerce-widgets/product-description/'],
                                    ['topppa-product-review-comment-widget widget', 'topppa_product_review_comment_widget', 'shop', 'Product Review/Comment', 'free', '#', 'https://doc.topperpack.com/docs/woocommerce-widgets/product-review-comment/'],
                                    ['topppa-product-cart-page-widget widget', 'topppa_product_cart_page_widget', 'shop', 'Product Cart Page', 'free', '#', 'https://doc.topperpack.com/docs/woocommerce-widgets/product-cart/'],
                                    ['topppa-product-additional-info-widget widget', 'topppa_product_additional_info_widget', 'shop', 'Product Additional Info', 'free', '#', 'https://doc.topperpack.com/docs/woocommerce-widgets/product-additional-info/'],
                                    ['topppa-product-checkout-page-widget widget', 'topppa_product_checkout_page_widget', 'shop', 'Product Checkout Page', 'free', '#', 'https://doc.topperpack.com/docs/woocommerce-widgets/product-checkout-page/'],
                                    ['topppa-accordion-image-widget widget', 'topppa_accordion_image_widget', 'list', 'Advance Accordion Image', 'free', '#', 'https://topperpack.com/accordion-image/'],
                                    ['topppa-progress-bar-widget widget', 'topppa_progress_bar_widget', 'list', 'Progress Bar', 'free', '#', 'https://topperpack.com/progress-bar/'],
                                    ['topppa-wp-forms-widget widget', 'topppa_wp_forms_widget', 'list', 'WP Form', 'free', '#', 'https://topperpack.com/wp-forms/'],
                                    ['topppa-mailchimp-widget widget', 'topppa_mailchimp_widget', 'list', 'Mailchimp', 'free', '#', 'https://topperpack.com/mailchimp/'],
                                    ['topppa-weform-widget widget', 'topppa_weform_widget', 'list', 'Weforms', 'free', '#', 'https://topperpack.com/we-forms/'],
                                    ['topppa-ninjaform-widget widget', 'topppa_ninjaform_widget', 'list', 'Ninja Form', 'pro', '#', 'https://topperpack.com/ninja-form/'],
                                    ['topppa-advance-review-widget widget', 'topppa_advance_review_widget', 'list', 'Advance Review', 'pro', '#', 'https://doc.topperpack.com/docs/social-and-review-widgets/advance-review/'],
                                    ['topppa-facebook-review-widget widget', 'topppa_facebook_review_widget', 'list', 'Facebook Review', 'pro', '#', 'https://doc.topperpack.com/docs/social-and-review-widgets/facebook-review/'],
                                    ['topppa-yelp-review-widget widget', 'topppa_yelp_review_widget', 'list', 'Yelp Review', 'pro', '#', 'https://doc.topperpack.com/docs/social-and-review-widgets/yelp-review/'],
                                    ['topppa-heading-widget widget', 'topppa_heading_widget', 'list', 'Advanced Heading', 'free', '#', 'https://topperpack.com/advance-heading/'],
                                    ['topppa-custom-carousel-widget widget', 'topppa_custom_carousel_widget', 'list', 'Custom Carousel', 'pro', '#', '#'],
                                    ['topppa-cpt-builder-meta-widget widget', 'topppa_cpt_builder_meta_widget', 'post', 'CPT Builder Meta', 'pro', '#', 'https://doc.topperpack.com/docs/custom-post-type-cpt-widgets/cpt-builder-meta/'],
                                    ['topppa-audio-player-widget widget', 'topppa_audio_player_widget', 'post', 'Audio Player', 'free', '#', 'https://topperpack.com/audio-player/'],
                                    ['topppa-image-slider-widget widget', 'topppa_image_slider_widget', 'post', 'Image Slider', 'free', '#', '#'],
                                    ['topppa-service-slider-widget widget', 'topppa_service_slider_widget', 'post', 'Service Slider', 'free', '#', '#'],
                                    ['topppa-toggle-widget widget', 'topppa_toggle_widget', 'post', 'Toggle', 'free', '#', '#'],
                                    ['topppa-trade-coin-widget widget', 'topppa_trade_coin_widget', 'post', 'Trade Coin', 'free', '#', '#'],
                                    ['topppa-data-table-widget widget', 'topppa_data_table_widget', 'post', 'Data Table', 'free', '#', '#'],

                                    // Trip widgets
                                    ['topppa-trip-taxonomy-module-widget widget', 'topppa_trip_taxonomy_module_widget', 'post', 'Trip Taxonomy Module', 'free', '#', '#'],
                                    ['topppa-trip-module-widget widget', 'topppa_trip_module_widget', 'post', 'Trip Module', 'free', '#', '#'],
                                    ['topppa-trip-search-widget widget', 'topppa_trip_search_widget', 'post', 'Trip Search', 'free', '#', '#'],
                                    ['topppa-trip-module-v2-widget widget', 'topppa_trip_module_v2_widget', 'post', 'Trip Module V2', 'free', '#', '#'],
                                    ['topppa-trip-activities-module-widget widget', 'topppa_trip_activities_module_widget', 'post', 'Trip Activities Module', 'free', '#', '#'],
                                    ['topppa-trip-destination-module-widget widget', 'topppa_trip_destination_module_widget', 'post', 'Trip Destination Module', 'free', '#', '#'],
                                    ['topppa-trip-types-module-widget widget', 'topppa_trip_types_module_widget', 'post', 'Trip Types Module', 'free', '#', '#'],
                                    ['topppa-trip-activities-taxonomy-widget widget', 'topppa_trip_activities_taxonomy_widget', 'post', 'Trip Activities Taxonomy', 'free', '#', '#'],
                                    ['topppa-trip-activities-grid-widget widget', 'topppa_trip_activities_grid_widget', 'post', 'Trip Activities Grid', 'free', '#', '#'],
                                    ['topppa-trip-destination-taxonomy-widget widget', 'topppa_trip_destination_taxonomy_widget', 'post', 'Trip Destination Taxonomy', 'free', '#', '#'],
                                    ['topppa-trip-types-taxonomy-widget widget', 'topppa_trip_types_taxonomy_widget', 'post', 'Trip Type Taxonomy', 'free', '#', '#'],
                                    ['topppa-trip-activities-tab-module-widget widget', 'topppa_trip_activities_tab_module_widget', 'post', 'Trip Activities Tab', 'free', '#', '#'],
                                    ['topppa-trip-types-tab-module-widget widget', 'topppa_trip_types_tab_module_widget', 'post', 'Trip Types Tab', 'free', '#', '#'],
                                    ['topppa-trip-destination-tab-module-widget widget', 'topppa_trip_destination_tab_module_widget', 'post', 'Trip Destination Tab', 'free', '#', '#'],
                                    ['topppa-trip-destination-tab-module-v2-widget widget', 'topppa_trip_destination_tab_v2_module_widget', 'post', 'Trip Destination Tab V2', 'free', '#', '#'],
                                    ['topppa-trip-destination-tab-module-v3-widget widget', 'topppa_trip_destination_tab_v3_module_widget', 'post', 'Trip Destination Tab V3', 'free', '#', '#'],
                                    ['topppa-trip-activities-accordion-widget widget', 'topppa_trip_activities_accordion_widget', 'post', 'Trip Activities Accordion', 'free', '#', '#'],
                                    // End Trip widgets
                                    ['topppa-dropdown-taxonomy-widget widget', 'topppa_dropdown_taxonomy_widget', 'post', 'Dropdown Taxonomy', 'free', '#', '#'],
                                    ['topppa-text-reveal-widget widget', 'topppa_text_reveal_widget', 'post', 'Text Reveal', 'free', '#', '#'],
                                    ['topppa-image-tab-widget widget', 'topppa_image_tab_widget', 'post', 'Image Tab', 'free', '#', '#'],
                                    ['topppa-slider-widget-v2 widget', 'topppa_slider_v2_widget', 'post', 'Slider V2', 'free', '#', '#'],
                                    ['topppa-slider-widget-v3 widget', 'topppa_slider_v3_widget', 'post', 'Slider V3', 'free', '#', '#'],
                                    ['topppa-marquee-widget widget', 'topppa_marquee_widget', 'post', 'Marquee', 'free', '#', '#'],
                                    ['topppa-vertical-marquee-widget widget', 'topppa_vertical_marquee_widget', 'post', 'Vertical Marquee', 'free', '#', '#'],
                                    ['topppa-animated-slider widget', 'topppa_animated_slider_widget', 'post', 'Animated Slider', 'free', '#', '#'],
                                    ['topppa-sticky-header widget', 'topppa_sticky_header_widget', 'post', 'Sticky Header', 'free', '#', '#'],
                                    ['topppa-accordion-service widget', 'topppa_accordion_service_widget', 'post', 'Accordion Service', 'free', '#', '#'],
                                    ['topppa-hero-banner-one widget', 'topppa_hero_banner_one_widget', 'post', 'Hero Banner One', 'free', '#', '#'],
                                ];

                                foreach ($widgets as $widget) {
                                    topppa_generate_widget($widget[0], $widget[1], $widget[2], $widget[3], $widget[4], $widget[5] ?? '', $widget[6] ?? '');
                                }
                                ?>
                            </div>
                            <button type="button" id="topppa-save-widget-settings" class="topppa-dashboard-btn-global topppa-save-widget-btn"><?php esc_html_e('Save Settings', 'topper-pack'); ?></button>
                            <p id="topppa-save-widget-settings-message"></p>
                        </form>
                    </div>
                    <!-- End of Widgets Area -->

                    <!-- Extensions Area -->
                    <div id="topppa-extensions" class="topppa-admin-widge-section-wrapper topppa-dashboard-global tab-content">
                        <div class="topppa-admin-filter__wrapper">
                            <div class="topppa-admin-filter__inner">
                                <div class="topppa-admin-filter__inputbox">
                                    <input type="text" placeholder="Search extension" id="topppa-extension-search">
                                    <select class="topppa-extension-category-filter" name="topppa-extension-category-filter" id="topppa-extension-category-filter">
                                        <option value=""><?php esc_html_e('Filter By ', 'topper-pack'); ?></option>
                                        <option value="list"><?php esc_html_e('List', 'topper-pack'); ?></option>
                                        <option value="post"><?php esc_html_e('Post', 'topper-pack'); ?></option>
                                        <option value="social"><?php esc_html_e('Social', 'topper-pack'); ?></option>
                                        <option value="carousel"><?php esc_html_e('Carousel', 'topper-pack'); ?></option>
                                    </select>
                                </div>
                                <div class="topppa-admin-filter__buttons">
                                    <!-- Buttons for Widgets -->
                                    <button type="button" class="topppa-dashboard-btn-global topppa-admin-filter-all-active-btn" id="topppa-toggle-all-extensions"><?php esc_html_e('Activate All', 'topper-pack'); ?></button>
                                    <button id="topppa-toggle-all-extensions-deactivate" type="button" class="topppa-dashboard-btn-global topppa-admin-filter-all-deactive-btn"><?php esc_html_e('Deactivate All', 'topper-pack'); ?></button>
                                </div>
                            </div>
                        </div>

                        <form id="topppa-settings-form-2" class="topppa-admin-all-widgets-extension">
                            <div class="topppa-admin-widgets-list">
                                <?php
                                function topppa_generate_extension($extension_name, $extension_id, $extension_category, $extension_title, $extension_type, $video_url = '', $demo_url = '') {
                                    $is_pro = ('pro' === $extension_type);
                                    $can_use_premium = topppa_can_use_premium_features();
                                    // Determine if the checkbox should be disabled
                                    $disabled = ($is_pro && !$can_use_premium) ? 'disabled' : '';

                                    // Determine if it should be checked
                                    $checked = checked(get_option($extension_id, 'yes'), 'yes', false);

                                    // Set title message based on specific condition
                                    $title = ($is_pro && !$can_use_premium) ? topppa_get_premium_restriction_message() : '';
                                ?>
                                    <div data-extension-name="<?php echo esc_attr($extension_name); ?>" data-extension-category="<?php echo esc_attr($extension_category); ?>" id="<?php echo esc_attr($extension_id); ?>" class="topppa-extension-checkbox <?php echo esc_attr($extension_type . ' ' . ($can_use_premium ? '' : 'topppa-no-purchase')); ?>">
                                        <div class="topppa-widget-extension-box">
                                            <div class="topppa-admin-widget-left">
                                                <h3><?php echo esc_html($extension_title, 'topper-pack'); ?></h3>
                                                <div class="topppa-demo-video">
                                                    <?php if (!empty($video_url)): ?>
                                                        <a href="<?php echo esc_url($video_url); ?>" target="_blank"><i class="icon-element eicon-youtube"></i><?php esc_html_e('Video', 'topper-pack'); ?></a>
                                                    <?php endif; ?>
                                                    <?php if (!empty($demo_url)): ?>
                                                        <a href="<?php echo esc_url($demo_url); ?>" target="_blank"><i class="icon-element eicon-link"></i><?php esc_html_e('Demo', 'topper-pack'); ?></a>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                            <div class="topppa-admin-widget-right">
                                                <label class="topppa-admin-switch">
                                                    <input type="checkbox"
                                                        name="<?php echo esc_attr($extension_id); ?>"
                                                        class="<?php echo esc_attr($extension_category . ' ' . $extension_type); ?>"
                                                        <?php echo wp_kses_post($checked); ?>
                                                        <?php echo wp_kses_post($disabled); ?>
                                                        title="<?php echo esc_attr($title); ?>">
                                                    <span class="slider"></span>
                                                </label>
                                            </div>
                                            <?php echo wp_kses_post(topppa_get_purchase_link($is_pro, $can_use_premium, '', false)); ?>
                                        </div>
                                    </div>
                                <?php
                                }

                                $extensions = [
                                    ['Sticky Section', 'topppa_sticky_section', '', 'Sticky Section', 'free', '#', 'https://topperpack.com/sticky-section/'],
                                    ['Grid Line', 'topppa_grid_line', '', 'Grid Line', 'pro', '#', 'https://topperpack.com/grid-line/'],
                                    ['Scroll To Top', 'topppa_scroll_to_top', '', 'Scroll To Top', 'free', 'https://www.youtube.com/watch?v=7Dx7dZ5VnyU', 'https://doc.topperpack.com/docs/extensions-guide/scroll-to-top/'],
                                    ['Custom CSS', 'topppa_custom_css', '', 'Custom CSS', 'free', '#', 'https://doc.topperpack.com/docs/extensions-guide/custom-css/'],
                                    ['Advanced Effects', 'topppa_container_hover_effects', '', 'Advanced Effects', 'free', '#', 'https://doc.topperpack.com/docs/extensions-guide/advanced-effects/'],
                                    ['Cursor Effects', 'topppa_cursor_effect', '', 'Cursor Effects', 'pro', '#', 'https://topperpack.com/cursor-effect/'],
                                    ['Split Text', 'topppa_split_text_animation', '', 'Split Text', 'pro', '#', 'https://topperpack.com/split-text/'],
                                    ['Advanced Animations', 'interactive_animations', '', 'Advanced Animations', 'free', '#', 'https://topperpack.com/advanced-image-hover/'],
                                    ['Advanced Image Animations', 'advanced_image_hover', '', 'Advanced Image Hover', 'pro', '#', 'https://topperpack.com/advanced-animation/'],
                                    ['Tooltip', 'topppa_tooltip_section', '', 'Tooltip', 'free', '#', 'https://topperpack.com/tooltip/'],
                                    ['Wrapper Link', 'topppa_wrapper_link', '', 'Wrapper Link', 'free', 'https://www.youtube.com/watch?v=GFR4DzS0vuo', 'https://topperpack.com/wrapper-link/'],
                                    ['Conditional Display', 'topppa_conditional_display', '', 'Conditional Display', 'free', '#', 'https://doc.topperpack.com/docs/extensions-guide/conditional-display/'],
                                    ['Pin Section', 'pin_section', '', 'Pin Section', 'pro', '#', 'https://doc.topperpack.com/docs/extensions-guide/pin-section/'],
                                    ['Reveal Animation', 'topppa_wow_animation', '', 'Reveal Animation', 'pro', '#', 'https://topperpack.com/advanced-animation/'],
                                    ['Reveal Effect', 'topppa_reveal_effect', '', 'Reveal Effect', 'pro', '#', 'https://topperpack.com/advanced-effect/'],
                                    ['Border Animation', 'topppa_border_animation', '', 'Border Animation', 'pro', '#', 'https://doc.topperpack.com/docs/extensions-guide/border-animation/'],
                                    ['Motion Text', 'topppa_motion_text', '', 'Motion Text', 'free', '#', 'https://doc.topperpack.com/docs/extensions-guide/motion-text/'],
                                    ['Dots Particle Animation', 'topppa_dots_particle_animation', '', 'Dots Particle Animation', 'free', '#', 'https://doc.topperpack.com/docs/extensions-guide/dots-particle-animation/'],
                                    ['Hover Image Viewer', 'topppa_hover_image_viewer', '', 'Hover Image Viewer', 'free', '#', 'https://topperpack.com/extensions-guide/hover-image-viewer/'],
                                ];

                                foreach ($extensions as $extension) {
                                    topppa_generate_extension($extension[0], $extension[1], $extension[2], $extension[3], $extension[4], $extension[5] ?? '', $extension[6] ?? '');
                                }
                                ?>
                            </div>
                            <button type="button" id="topppa-save-extension-settings" class="topppa-dashboard-btn-global topppa-save-widget-btn"><?php esc_html_e('Save Settings', 'topper-pack'); ?></button>
                            <p id="topppa-save-extension-settings-message"></p>
                        </form>
                    </div>
                    <!-- End of Extensions Area -->

                    <!-- CPT Builder Content Tab -->
                    <div id="topppa-cpt-builder" class="topppa-admin-widge-section-wrapper topppa-dashboard-global tab-content">
                        <form id="topppa-cpt-form" class="topppa-admin-all-widgets-extension topppa-cpt-builder-wrapper">
                            <div class="topppa-cpt-builder-group topppa-admin-global-flx topppa-admin-pace__mb50">
                                <div class="topppa-admin-item__box">
                                    <h3 class="topppa-admin-item__title topppa-admin-pace__mt0">
                                        <?php esc_html_e('Custom Post Type (CPT) Builder', 'topper-pack'); ?>
                                    </h3>
                                    <p class="topppa-admin-item__dec topppa-admin-pace__mb10 topppa-admin-pace__mt10">
                                        <?php esc_html_e('Build your custom post types with ease. Add fields, taxonomies, and more to create unique content types for your site.', 'topper-pack'); ?>
                                    </p>

                                    <!-- Add New CPT Button -->
                                    <?php if (topppa_can_use_premium_features()) : ?>
                                        <button type="button" id="add-new-cpt" class="topppa-dashboard-btn-global">
                                            <?php esc_html_e('Add New Post Type', 'topper-pack'); ?>
                                        </button>
                                    <?php endif; ?>

                                    <!-- CPT List Container -->
                                    <div id="cpt-list" class="topppa-cpt-list">
                                        <?php if (topppa_can_use_premium_features()) : ?>
                                            <?php
                                            $saved_cpts = get_option('topppa_custom_post_types', array());
                                            foreach ($saved_cpts as $cpt_key => $cpt) :
                                            ?>
                                                <div class="topppa-cpt-item" data-cpt-key="<?php echo esc_attr($cpt_key); ?>">
                                                    <div class="topppa-cpt-header">
                                                        <h4><?php echo esc_html($cpt['label']); ?></h4>
                                                        <div class="topppa-cpt-actions">
                                                            <button type="button" class="edit-cpt"><?php esc_html_e('Edit', 'topper-pack'); ?></button>
                                                            <button type="button" class="delete-cpt"><?php esc_html_e('Delete', 'topper-pack'); ?></button>
                                                        </div>
                                                    </div>
                                                    <div class="topppa-cpt-form" style="display: none;">
                                                        <!-- Basic Settings -->
                                                        <div class="topppa-cpt-section">
                                                            <h5><?php esc_html_e('Basic Settings', 'topper-pack'); ?></h5>
                                                            <div class="topppa-cpt-field-wrapper">
                                                                <div class="topppa-cpt-field-group">
                                                                    <div class="topppa-cpt-label-field">
                                                                        <label><?php esc_html_e('Post Type Name:', 'topper-pack'); ?></label>
                                                                        <input type="text"
                                                                            name="cpt[<?php echo esc_attr($cpt_key); ?>][label]"
                                                                            value="<?php echo esc_attr($cpt['label']); ?>"
                                                                            required>
                                                                    </div>
                                                                    <div class="topppa-cpt-label-field">
                                                                        <label><?php esc_html_e('Post Type Slug:', 'topper-pack'); ?></label>
                                                                        <input type="text"
                                                                            name="cpt[<?php echo esc_attr($cpt_key); ?>][slug]"
                                                                            value="<?php echo esc_attr($cpt['slug']); ?>"
                                                                            required>
                                                                    </div>
                                                                    <div class="topppa-cpt-label-field">
                                                                        <div class="topppa-cpt-icon-picker-wrapper">
                                                                            <input type="hidden"
                                                                                name="cpt[<?php echo esc_attr($cpt_key); ?>][icon]"
                                                                                value="<?php echo esc_attr($cpt['icon']); ?>"
                                                                                class="topppa-cpt-icon-input"
                                                                                required>
                                                                            <button type="button" class="topppa-cpt-icon-picker-button button"><?php esc_html_e('Choose Icon', 'topper-pack'); ?></button>
                                                                            <div class="topppa-cpt-icon-preview"><span class="dashicons <?php echo esc_attr($cpt['icon']); ?>"></span></div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <!-- Support Options -->
                                                        <div class="topppa-cpt-section">
                                                            <h5><?php esc_html_e('Supports', 'topper-pack'); ?></h5>
                                                            <div class="topppa-cpt-options">
                                                                <?php
                                                                $support_options = array(
                                                                    'title' => esc_html__('Title', 'topper-pack'),
                                                                    'editor' => esc_html__('Editor', 'topper-pack'),
                                                                    'page-attributes' => esc_html__('Page Attributes', 'topper-pack'),
                                                                    'thumbnail' => esc_html__('Featured Image', 'topper-pack'),
                                                                    'excerpt' => esc_html__('Excerpt', 'topper-pack'),
                                                                    'author' => esc_html__('Author', 'topper-pack'),
                                                                    'comments' => esc_html__('Comments', 'topper-pack'),
                                                                    'revisions' => esc_html__('Revisions', 'topper-pack'),
                                                                    'custom-fields' => esc_html__('Custom Fields', 'topper-pack')
                                                                );
                                                                foreach ($support_options as $value => $label) :
                                                                ?>
                                                                    <label>
                                                                        <input type="checkbox"
                                                                            name="cpt[<?php echo esc_attr($cpt_key); ?>][supports][]"
                                                                            value="<?php echo esc_attr($value); ?>"
                                                                            <?php checked(in_array($value, isset($cpt['supports']) ? $cpt['supports'] : array())); ?>>
                                                                        <?php echo esc_html($label); ?>
                                                                    </label>
                                                                <?php endforeach; ?>
                                                            </div>
                                                        </div>

                                                        <!-- Advanced Options -->
                                                        <div class="topppa-cpt-section">
                                                            <h5><?php esc_html_e('Advanced', 'topper-pack'); ?></h5>
                                                            <div class="topppa-cpt-options">
                                                                <?php
                                                                $support_options = array(
                                                                    'public' => esc_html__('Public', 'topper-pack'),
                                                                    'publicly_queryable' => esc_html__('Publicly Queryable', 'topper-pack'),
                                                                    'show_ui' => esc_html__('Show UI', 'topper-pack'),
                                                                    'show_in_menu' => esc_html__('Show in Menu', 'topper-pack'),
                                                                    'query_var' => esc_html__('Query Var', 'topper-pack'),
                                                                    'has_archive' => esc_html__('Has Archive', 'topper-pack'),
                                                                    'hierarchical' => esc_html__('Hierarchical', 'topper-pack')
                                                                );
                                                                foreach ($support_options as $value => $label) :
                                                                ?>
                                                                    <label>
                                                                        <input type="checkbox"
                                                                            name="cpt[<?php echo esc_attr($cpt_key); ?>][advanced][]"
                                                                            value="<?php echo esc_attr($value); ?>"
                                                                            <?php checked(in_array($value, isset($cpt['advanced']) ? $cpt['advanced'] : array())); ?>>
                                                                        <?php echo esc_html($label); ?>
                                                                    </label>
                                                                <?php endforeach; ?>
                                                            </div>
                                                        </div>

                                                        <!-- Taxonomies -->
                                                        <div class="topppa-cpt-section">
                                                            <h5><?php esc_html_e('Taxonomies', 'topper-pack'); ?></h5>
                                                            <div class="topppa-cpt-taxonomies-list">
                                                                <?php
                                                                if (!empty($cpt['taxonomies'])) :
                                                                    foreach ($cpt['taxonomies'] as $tax_key => $taxonomy) :
                                                                ?>
                                                                        <div class="topppa-cpt-taxonomy-item">
                                                                            <div class="topppa-taxonomy-fields">
                                                                                <div class="topppa-taxonomy-name">
                                                                                    <label><?php esc_html_e('Taxonomy Name:', 'topper-pack'); ?></label>
                                                                                    <input type="text"
                                                                                        name="cpt[<?php echo esc_attr($cpt_key); ?>][taxonomies][<?php echo esc_attr($tax_key); ?>][label]"
                                                                                        value="<?php echo esc_attr($taxonomy['label']); ?>"
                                                                                        class="topppa-taxonomy-name-input"
                                                                                        required>
                                                                                </div>
                                                                                <div class="topppa-taxonomy-slug">
                                                                                    <label><?php esc_html_e('Taxonomy Slug:', 'topper-pack'); ?></label>
                                                                                    <input type="text"
                                                                                        name="cpt[<?php echo esc_attr($cpt_key); ?>][taxonomies][<?php echo esc_attr($tax_key); ?>][slug]"
                                                                                        value="<?php echo esc_attr($taxonomy['slug']); ?>"
                                                                                        class="topppa-taxonomy-slug-input"
                                                                                        data-cpt-slug="<?php echo esc_attr($cpt['slug']); ?>"
                                                                                        required>
                                                                                </div>
                                                                            </div>
                                                                            <button type="button" class="topppa-cpt-remove-taxonomy"><?php esc_html_e('Remove', 'topper-pack'); ?></button>
                                                                        </div>
                                                                <?php
                                                                    endforeach;
                                                                endif;
                                                                ?>
                                                            </div>
                                                            <button type="button" class="topppa-cpt-add-taxonomy"><?php esc_html_e('Add Taxonomy', 'topper-pack'); ?></button>
                                                        </div>

                                                        <!-- Meta -->
                                                        <div class="topppa-cpt-section">
                                                            <h5><?php esc_html_e('Meta', 'topper-pack'); ?></h5>
                                                            <div class="topppa-cpt-meta-list">
                                                                <?php
                                                                if (!empty($cpt['meta'])) :
                                                                    foreach ($cpt['meta'] as $meta_key => $meta) :
                                                                ?>
                                                                        <div class="topppa-cpt-accordion-meta-group topppa-cpt-meta-item" data-cpt-key="<?php echo esc_attr($cpt_key); ?>">
                                                                            <!-- Accordion Header -->
                                                                            <div class="topppa-cpt-meta-accordion-header">
                                                                                <div class="topppa-cpt-meta-accordion-title">
                                                                                    <span class="topppa-meta-name-display"><?php echo esc_html($meta['label'] ?: 'Untitled Meta Group'); ?></span>
                                                                                </div>
                                                                                <div class="topppa-cpt-meta-accordion-toggle">
                                                                                    <span class="topppa-accordion-icon">−</span>
                                                                                </div>
                                                                            </div>

                                                                            <!-- Accordion Content -->
                                                                            <div class="topppa-cpt-meta-accordion-content">
                                                                                <div class="topppa-cpt-meta-name">
                                                                                    <label for="meta_name_<?php echo esc_attr($meta_key); ?>"><?php esc_html_e('Meta Name:', 'topper-pack'); ?></label>
                                                                                    <input type="text" id="meta_name_<?php echo esc_attr($meta_key); ?>"
                                                                                        name="cpt[<?php echo esc_attr($cpt_key); ?>][meta][<?php echo esc_attr($meta_key); ?>][label]"
                                                                                        value="<?php echo esc_attr($meta['label']); ?>"
                                                                                        class="topppa-meta-name-input" required>
                                                                                </div>

                                                                                <div class="topppa-cpt-meta-slug">
                                                                                    <label for="meta_slug_<?php echo esc_attr($meta_key); ?>"><?php esc_html_e('Meta Slug:', 'topper-pack'); ?></label>
                                                                                    <input type="text" id="meta_slug_<?php echo esc_attr($meta_key); ?>"
                                                                                        name="cpt[<?php echo esc_attr($cpt_key); ?>][meta][<?php echo esc_attr($meta_key); ?>][slug]"
                                                                                        value="<?php echo esc_attr($meta['slug']); ?>" required>
                                                                                </div>

                                                                                <div class="topppa-cpt-meta-fields">
                                                                                    <?php
                                                                                    if (!empty($meta['fields'])) :
                                                                                        foreach ($meta['fields'] as $field_index => $field) :

                                                                                            if (empty($field['field_name'])) {
                                                                                                continue;
                                                                                            }
                                                                                    ?>
                                                                                            <div class="topppa-cpt-meta-field-group <?php echo ($field['field_type'] === 'icon') ? 'topppa-hide-label' : ''; ?>">
                                                                                                <div class="topppa-cpt-meta-field-name">
                                                                                                    <label><?php esc_html_e('Field Name:', 'topper-pack'); ?></label>
                                                                                                    <input type="text"
                                                                                                        name="cpt[<?php echo esc_attr($cpt_key); ?>][meta][<?php echo esc_attr($meta_key . '_field_' . $field_index); ?>][field_name]"
                                                                                                        value="<?php echo esc_attr($field['field_name']); ?>" required>
                                                                                                </div>

                                                                                                <div class="topppa-cpt-meta-field-label <?php echo ($field['field_type'] === 'icon') ? 'topppa-hidden-for-icon' : ''; ?><?php echo (isset($field['show_label']) && $field['show_label'] === 'no') ? ' topppa-hidden-for-show-label' : ''; ?>" <?php echo ($field['field_type'] === 'icon') ? 'style="display: none;"' : ''; ?><?php echo (isset($field['show_label']) && $field['show_label'] === 'no') ? ' style="display: none;"' : ''; ?>>
                                                                                                    <label><?php esc_html_e('Field Label:', 'topper-pack'); ?></label>
                                                                                                    <input type="text"
                                                                                                        name="cpt[<?php echo esc_attr($cpt_key); ?>][meta][<?php echo esc_attr($meta_key . '_field_' . $field_index); ?>][field_label]"
                                                                                                        value="<?php echo esc_attr(isset($field['field_label']) ? $field['field_label'] : ''); ?>"
                                                                                                        placeholder="Auto-generated from field name">
                                                                                                </div>

                                                                                                <div class="topppa-cpt-meta-field-type">
                                                                                                    <label><?php esc_html_e('Field Type:', 'topper-pack'); ?></label>
                                                                                                    <select
                                                                                                        name="cpt[<?php echo esc_attr($cpt_key); ?>][meta][<?php echo esc_attr($meta_key . '_field_' . $field_index); ?>][field_type]"
                                                                                                        required class="topppa-field-type-select">
                                                                                                        <option value=""><?php esc_html_e('Select Type', 'topper-pack'); ?></option>
                                                                                                        <option value="text" <?php selected($field['field_type'], 'text'); ?>><?php esc_html_e('Text', 'topper-pack'); ?></option>
                                                                                                        <option value="text_editor" <?php selected($field['field_type'], 'text_editor'); ?>><?php esc_html_e('Text Editor', 'topper-pack'); ?></option>
                                                                                                        <option value="textarea" <?php selected($field['field_type'], 'textarea'); ?>><?php esc_html_e('Textarea', 'topper-pack'); ?></option>
                                                                                                        <option value="number" <?php selected($field['field_type'], 'number'); ?>><?php esc_html_e('Number', 'topper-pack'); ?></option>
                                                                                                        <option value="url" <?php selected($field['field_type'], 'url'); ?>><?php esc_html_e('URL', 'topper-pack'); ?></option>
                                                                                                        <option value="checkbox" <?php selected($field['field_type'], 'checkbox'); ?>><?php esc_html_e('Checkbox', 'topper-pack'); ?></option>
                                                                                                        <option value="image" <?php selected($field['field_type'], 'image'); ?>><?php esc_html_e('Image', 'topper-pack'); ?></option>
                                                                                                        <option value="gallery" <?php selected($field['field_type'], 'gallery'); ?>><?php esc_html_e('Gallery', 'topper-pack'); ?></option>
                                                                                                        <option value="icon" <?php selected($field['field_type'], 'icon'); ?>><?php esc_html_e('Icon', 'topper-pack'); ?></option>
                                                                                                        <option value="author_info" <?php selected($field['field_type'], 'author_info'); ?>><?php esc_html_e('Author Info', 'topper-pack'); ?></option>
                                                                                                        <option value="taxonomy" <?php selected($field['field_type'], 'taxonomy'); ?>><?php esc_html_e('Taxonomy', 'topper-pack'); ?></option>
                                                                                                    </select>
                                                                                                </div>

                                                                                                <!-- Field Options Container - Always Visible -->
                                                                                                <div class="topppa-cpt-meta-field-options-container">
                                                                                                    <!-- Show Label checkbox -->
                                                                                                    <div class="topppa-cpt-meta-field-show-label-inline <?php echo ($field['field_type'] === 'icon') ? 'topppa-hidden-for-icon' : ''; ?>">
                                                                                                        <label class="topppa-checkbox-inline">
                                                                                                            <input type="checkbox"
                                                                                                                name="cpt[<?php echo esc_attr($cpt_key); ?>][meta][<?php echo esc_attr($meta_key . '_field_' . $field_index); ?>][show_label]"
                                                                                                                value="yes"
                                                                                                                class="topppa-field-show-label-checkbox"
                                                                                                                <?php checked(isset($field['show_label']) && $field['show_label'] === 'yes'); ?>>
                                                                                                            <?php esc_html_e('Show Label', 'topper-pack'); ?>
                                                                                                        </label>
                                                                                                    </div>

                                                                                                    <?php
                                                                                                    // Hide Show Icon switch for icon, image, and gallery field types
                                                                                                    $hideShowIcon = in_array($field['field_type'], ['icon', 'image', 'gallery']);
                                                                                                    ?>

                                                                                                    <!-- Show Icon checkbox -->
                                                                                                    <div class="topppa-cpt-meta-field-show-icon-inline" <?php echo $hideShowIcon ? 'style="display: none;"' : ''; ?>>
                                                                                                        <label class="topppa-checkbox-inline">
                                                                                                            <input type="checkbox"
                                                                                                                name="cpt[<?php echo esc_attr($cpt_key); ?>][meta][<?php echo esc_attr($meta_key . '_field_' . $field_index); ?>][show_icon]"
                                                                                                                value="yes"
                                                                                                                class="topppa-field-show-icon-checkbox"
                                                                                                                <?php checked(isset($field['show_icon']) && $field['show_icon'] === 'yes'); ?>>
                                                                                                            <?php esc_html_e('Show Icon', 'topper-pack'); ?>
                                                                                                        </label>
                                                                                                    </div>
                                                                                                </div>

                                                                                                <?php if ($field_index > 0) : ?>
                                                                                                    <button type="button" class="topppa-cpt-remove-meta-field">-</button>
                                                                                                <?php endif; ?>
                                                                                            </div>
                                                                                    <?php
                                                                                        endforeach;
                                                                                    endif;
                                                                                    ?>
                                                                                </div>
                                                                                <div class="topppa-cpt-meta-options">
                                                                                    <div class="topppa-cpt-meta-repeater">
                                                                                        <input type="checkbox"
                                                                                            id="meta_repeater_<?php echo esc_attr($meta_key); ?>"
                                                                                            name="cpt[<?php echo esc_attr($cpt_key); ?>][meta][<?php echo esc_attr($meta_key); ?>][repeater]"
                                                                                            value="yes"
                                                                                            <?php checked(isset($meta['repeater']) && $meta['repeater'] === 'yes'); ?>
                                                                                            class="topppa-repeater-checkbox">
                                                                                        <label for="meta_repeater_<?php echo esc_attr($meta_key); ?>">
                                                                                            <?php esc_html_e('Repeater', 'topper-pack'); ?>
                                                                                        </label>
                                                                                    </div>
                                                                                </div>

                                                                                <button type="button" class="topppa-cpt-add-meta-field"><?php esc_html_e('Add Field', 'topper-pack'); ?></button>
                                                                                <button type="button" class="topppa-cpt-remove-meta"><?php esc_html_e('Remove Meta', 'topper-pack'); ?></button>
                                                                            </div>
                                                                            <!-- End Accordion Content -->
                                                                        </div>
                                                                <?php
                                                                    endforeach;
                                                                endif;
                                                                ?>
                                                            </div>
                                                            <button type="button" class="topppa-cpt-add-meta"><?php esc_html_e('Add Meta', 'topper-pack'); ?></button>
                                                        </div>

                                                    </div>
                                                </div>
                                            <?php endforeach; ?>
                                        <?php else : ?>
                                            <div class="topppa-cpt-item">
                                                <?php
                                                // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
                                                echo str_replace(
                                                    '</a>',
                                                    '<img src="' . esc_url(TOPPPA_ASSETS_URL . 'images/cpt-builder.jpg') . '" alt="' . esc_attr__('CPT Builder', 'topper-pack') . '"></a>',
                                                    topppa_get_purchase_link(true, null, ' ', false, '', 'topppa-cpt-item-pro') // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
                                                );
                                                // phpcs:enable WordPress.Security.EscapeOutput.OutputNotEscaped
                                                ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>

                                    <!-- Save Button -->
                                    <div>
                                        <button type="button" id="topppa-save-cpt-settings" class="topppa-dashboard-btn-global"><?php esc_html_e('Save Settings', 'topper-pack'); ?></button>
                                        <p id="topppa-save-cpt-builder-settings-message"></p>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>

                    <!-- API Content Tab with settings form -->
                    <?php if (topppa_can_use_premium_features() && defined('TOPPPA_PRO_PATH') && file_exists(TOPPPA_PRO_PATH . 'admin/api-settings.php')) {
                        require_once TOPPPA_PRO_ADMIN_PATH .  'api-settings.php';
                    } else {
                    ?>
                        <div id="topppa-api-settings" class="topppa-admin-widge-section-wrapper topppa-dashboard-global tab-content">
                            <?php
                            // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
                            echo str_replace(
                                '</a>',
                                '<img src="' . esc_url(TOPPPA_ASSETS_URL . 'images/api-settings.jpg') . '" alt="' . esc_attr__('API Settings', 'topper-pack') . '"></a>',
                                topppa_get_purchase_link(true, null, ' ', false, '', 'topppa-cpt-item-pro') // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
                            );
                            // phpcs:enable WordPress.Security.EscapeOutput.OutputNotEscaped
                            ?>
                        </div>
                    <?php
                    } ?>

                    <!-- Extra Settings Content Tab with settings form -->
                    <div id="topppa-extra-settings" class="topppa-admin-widge-section-wrapper topppa-dashboard-global tab-content">
                        <form id="topppa-settings-form-4" class="topppa-admin-all-widgets-extension">
                            <div class="topppa-admin-widgets-list">
                                <div data-extra-settings-name="Assets Manager" data-extra-settings-category="" id="topppa_assets_manager" class="topppa-extra-settings-checkbox">
                                    <div class="topppa-extra-settings-box topppa-widget-extension-box">
                                        <div class="topppa-admin-widget-left">
                                            <h3><?php esc_html_e('Assets Manager', 'topper-pack'); ?></h3>
                                            <p><?php esc_html_e('Enable this option to combine your JavaScript and CSS into a single file. Once activated, all widget CSS and JS will be merged for streamlined loading.', 'topper-pack'); ?></p>
                                            <div class="topppa-demo-video">
                                                <a href="" target="_blank"><i class="icon-element eicon-youtube"></i><?php esc_html_e('Video', 'topper-pack'); ?></a>
                                                <a href="" target="_blank"><i class="icon-element eicon-link"></i><?php esc_html_e('Demo', 'topper-pack'); ?></a>
                                            </div>
                                        </div>
                                        <div class="topppa-admin-widget-right">
                                            <label class="topppa-admin-switch">
                                                <input type="checkbox" name="topppa_assets_manager" <?php checked(get_option('topppa_assets_manager', 'yes'), 'yes'); ?>>
                                                <span class="slider"></span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div data-extra-settings-name="Smooth Scroller" data-extra-settings-category="" id="topppa_smooth_scroller" class="topppa-extra-settings-checkbox">
                                    <div class="topppa-extra-settings-box topppa-widget-extension-box">
                                        <div class="topppa-admin-widget-left">
                                            <h3><?php esc_html_e('Smooth Scroller', 'topper-pack'); ?></h3>
                                            <p><?php esc_html_e('Toggle this switch to enable the Smooth Scroller feature, enhancing user experience with visually appealing navigation.', 'topper-pack'); ?></p>
                                            <div class="topppa-demo-video">
                                                <a href="" target="_blank"><i class="icon-element eicon-youtube"></i><?php esc_html_e('Video', 'topper-pack'); ?></a>
                                                <a href="" target="_blank"><i class="icon-element eicon-link"></i><?php esc_html_e('Demo', 'topper-pack'); ?></a>
                                            </div>
                                        </div>
                                        <div class="topppa-admin-widget-right">
                                            <label class="topppa-admin-switch">
                                                <input type="checkbox" name="topppa_smooth_scroller" <?php checked(get_option('topppa_smooth_scroller', 'yes'), 'yes'); ?>>
                                                <span class="slider"></span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div data-extra-settings-name="Template Library (in Editor)" data-extra-settings-category="" id="topppa_template_library" class="topppa-extra-settings-checkbox">
                                    <div class="topppa-extra-settings-box topppa-widget-extension-box">
                                        <div class="topppa-admin-widget-left">
                                            <h3><?php esc_html_e('Template Library (in Editor)', 'topper-pack'); ?></h3>
                                            <p><?php esc_html_e('Enable this option to display the Topper Pack template library in your editor. Its a fantastic feature for enhancing your Elementor experience!', 'topper-pack'); ?></p>
                                            <div class="topppa-demo-video">
                                                <a href="" target="_blank"><i class="icon-element eicon-youtube"></i><?php esc_html_e('Video', 'topper-pack'); ?></a>
                                                <a href="" target="_blank"><i class="icon-element eicon-link"></i><?php esc_html_e('Demo', 'topper-pack'); ?></a>
                                            </div>
                                        </div>
                                        <div class="topppa-admin-widget-right">
                                            <label class="topppa-admin-switch">
                                                <input type="checkbox" name="topppa_template_library" <?php checked(get_option('topppa_template_library', 'yes'), 'yes'); ?>>
                                                <span class="slider"></span>
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <div data-extra-settings-name="Mega Menu" data-extra-settings-category="" id="topppa_mega_menu" class="topppa-extra-settings-checkbox">
                                    <div class="topppa-extra-settings-box topppa-widget-extension-box">
                                        <div class="topppa-admin-widget-left">
                                            <h3><?php esc_html_e('Mega Menu', 'topper-pack'); ?></h3>
                                            <p><?php esc_html_e('The Mega Menu by Topper Pack allows users to create organized, expansive menus with customizable layouts featuring images, columns, sliders, and icons.', 'topper-pack'); ?></p>
                                            <div class="topppa-demo-video">
                                                <a href="" target="_blank"><i class="icon-element eicon-youtube"></i><?php esc_html_e('Video', 'topper-pack'); ?></a>
                                                <a href="" target="_blank"><i class="icon-element eicon-link"></i><?php esc_html_e('Demo', 'topper-pack'); ?></a>
                                            </div>
                                        </div>
                                        <div class="topppa-admin-widget-right">
                                            <label class="topppa-admin-switch">
                                                <input type="checkbox" name="topppa_mega_menu" <?php checked(get_option('topppa_mega_menu', 'yes'), 'yes'); ?>>
                                                <span class="slider"></span>
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <div data-extra-settings-name="Custom Post Type Builder" data-extra-settings-category="" id="topppa_cpt_builder" class="topppa-extra-settings-checkbox">
                                    <div class="topppa-extra-settings-box topppa-widget-extension-box">
                                        <div class="topppa-admin-widget-left">
                                            <h3><?php esc_html_e('Custom Post Type Builder', 'topper-pack'); ?></h3>
                                            <p><?php esc_html_e('The Custom Post Type Builder by Topper Pack allows users to create organized, expansive menus with customizable layouts featuring images, columns, sliders, and icons.', 'topper-pack'); ?></p>
                                            <div class="topppa-demo-video">
                                                <a href="" target="_blank"><i class="icon-element eicon-youtube"></i><?php esc_html_e('Video', 'topper-pack'); ?></a>
                                                <a href="" target="_blank"><i class="icon-element eicon-link"></i><?php esc_html_e('Demo', 'topper-pack'); ?></a>
                                            </div>
                                        </div>
                                        <div class="topppa-admin-widget-right">
                                            <label class="topppa-admin-switch">
                                                <input type="checkbox" name="topppa_cpt_builder" <?php checked(get_option('topppa_cpt_builder', 'no'), 'yes'); ?>>
                                                <span class="slider"></span>
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <div data-extra-settings-name="Custom Icon" data-extra-settings-category="" id="topppa_custom_icon" class="topppa-extra-settings-checkbox">
                                    <div class="topppa-extra-settings-box topppa-widget-extension-box">
                                        <div class="topppa-admin-widget-left">
                                            <h3><?php esc_html_e('Custom Icon', 'topper-pack'); ?></h3>
                                            <p><?php esc_html_e('The Custom Icon by Topper Pack allows users to create organized, expansive menus with customizable layouts featuring images, columns, sliders, and icons.', 'topper-pack'); ?></p>
                                            <div class="topppa-demo-video">
                                                <a href="" target="_blank"><i class="icon-element eicon-youtube"></i><?php esc_html_e('Video', 'topper-pack'); ?></a>
                                                <a href="" target="_blank"><i class="icon-element eicon-link"></i><?php esc_html_e('Demo', 'topper-pack'); ?></a>
                                            </div>
                                        </div>
                                        <div class="topppa-admin-widget-right">
                                            <label class="topppa-admin-switch">
                                                <input type="checkbox" name="topppa_custom_icon" <?php checked(get_option('topppa_custom_icon', 'yes'), 'yes'); ?>>
                                                <span class="slider"></span>
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <div data-extra-settings-name="Custom Font" data-extra-settings-category="" id="topppa_custom_font" class="topppa-extra-settings-checkbox <?php echo !topppa_can_use_premium_features() ? 'pro topppa-no-purchase' : ''; ?>">
                                    <div class="topppa-extra-settings-box topppa-widget-extension-box">
                                        <div class="topppa-admin-widget-left">
                                            <h3><?php esc_html_e('Custom Font', 'topper-pack'); ?></h3>
                                            <p><?php esc_html_e('The Custom Font by Topper Pack allows users to create organized, expansive menus with customizable layouts featuring images, columns, sliders, and icons.', 'topper-pack'); ?></p>
                                            <div class="topppa-demo-video">
                                                <a href="" target="_blank"><i class="icon-element eicon-youtube"></i><?php esc_html_e('Video', 'topper-pack'); ?></a>
                                                <a href="" target="_blank"><i class="icon-element eicon-link"></i><?php esc_html_e('Demo', 'topper-pack'); ?></a>
                                            </div>
                                        </div>
                                        <div class="topppa-admin-widget-right">
                                            <label class="topppa-admin-switch">
                                                <input type="checkbox" <?php echo esc_attr(topppa_can_use_premium_features() ? '' : 'class=pro disabled'); ?> name="topppa_custom_font" <?php checked(get_option('topppa_custom_font', 'yes'), 'yes'); ?>>
                                                <span class="slider"></span>
                                            </label>
                                        </div>
                                        <?php echo wp_kses_post(topppa_get_purchase_link(!topppa_can_use_premium_features(), '', '', false)); ?>
                                    </div>
                                </div>

                            </div>
                            <button type="button" id="topppa-save-extra-settings" class="topppa-dashboard-btn-global topppa-save-widget-btn"><?php esc_html_e('Save Settings', 'topper-pack'); ?></button>
                            <p id="topppa-save-extra-settings-message"></p>
                        </form>
                    </div>

                    <!-- Import/Export Settings -->
                    <div id="topppa-import-export" class="topppa-admin-widge-section-wrapper topppa-dashboard-global tab-content">
                        <div class="topppa-admin-all-widgets-extension">
                            <div class="topppa-import-export-wrapper">
                                <h2 class="topppa-section-title"><?php esc_html_e('Import/Export Settings', 'topper-pack'); ?></h2>
                                <p class="topppa-section-description"><?php esc_html_e('Backup your plugin settings or import configuration from another site. All widgets, extensions, API settings, and other configurations will be included.', 'topper-pack'); ?></p>

                                <div class="topppa-import-export-sections">

                                    <div class="topppa-export-section">
                                        <div class="topppa-settings-section-header">
                                            <h3><?php esc_html_e('Export Settings', 'topper-pack'); ?></h3>
                                            <p><?php esc_html_e('Download your current plugin settings as a JSON file. This includes all widgets, extensions, features, API settings, and custom configurations.', 'topper-pack'); ?></p>
                                        </div>
                                        <div class="topppa-settings-section-content">
                                            <div class="topppa-export-info">
                                                <div class="topppa-info-grid">
                                                    <div class="topppa-info-item">
                                                        <strong><?php esc_html_e('Plugin Version:', 'topper-pack'); ?></strong>
                                                        <span><?php echo esc_html(TOPPPA_VER); ?></span>
                                                    </div>
                                                    <div class="topppa-info-item">
                                                        <strong><?php esc_html_e('WordPress Version:', 'topper-pack'); ?></strong>
                                                        <span><?php echo esc_html(get_bloginfo('version')); ?></span>
                                                    </div>
                                                    <div class="topppa-info-item">
                                                        <strong><?php esc_html_e('Elementor Version:', 'topper-pack'); ?></strong>
                                                        <span><?php echo defined('ELEMENTOR_VERSION') ? esc_html(ELEMENTOR_VERSION) : esc_html__('Not installed', 'topper-pack'); ?></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="topppa-export-actions">
                                                <button type="button" id="topppa-export-settings" class="topppa-dashboard-btn-global">
                                                    <span class="dashicons dashicons-download"></span>
                                                    <?php esc_html_e('Export Settings', 'topper-pack'); ?>
                                                </button>
                                                <p id="topppa-export-message" class="topppa-action-message"></p>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="topppa-import-section">
                                        <div class="topppa-settings-section-header">
                                            <h3><?php esc_html_e('Import Settings', 'topper-pack'); ?></h3>
                                            <p><?php esc_html_e('Upload a previously exported JSON settings file to restore your configuration. This will overwrite your current settings.', 'topper-pack'); ?></p>
                                        </div>
                                        <div class="topppa-settings-section-content">
                                            <div class="topppa-import-dropzone" id="topppa-import-dropzone">
                                                <div class="topppa-dropzone-content">
                                                    <span class="dashicons dashicons-upload"></span>
                                                    <p><?php esc_html_e('Drag & Drop your JSON file here or click to browse', 'topper-pack'); ?></p>
                                                    <input type="file" id="topppa-import-file" accept=".json" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; opacity: 0; cursor: pointer; z-index: 1;">
                                                    <button type="button" class="topppa-browse-file-btn topppa-dashboard-btn-global" id="topppa-browse-file">
                                                        <?php esc_html_e('Browse Files', 'topper-pack'); ?>
                                                    </button>
                                                </div>
                                            </div>
                                            <div class="topppa-import-actions" style="display: none;" id="topppa-import-actions">
                                                <div class="topppa-selected-file-info">
                                                    <span class="dashicons dashicons-media-document"></span>
                                                    <span id="topppa-selected-file-name"></span>
                                                    <button type="button" class="topppa-remove-file" id="topppa-remove-file">
                                                        <span class="dashicons dashicons-no"></span>
                                                    </button>
                                                </div>
                                                <div class="topppa-import-options">
                                                    <label class="topppa-import-option">
                                                        <input type="checkbox" id="topppa-backup-before-import" checked>
                                                        <?php esc_html_e('Create backup before import', 'topper-pack'); ?>
                                                    </label>
                                                </div>
                                                <button type="button" id="topppa-import-settings" class="topppa-dashboard-btn-global topppa-import-btn">
                                                    <span class="dashicons dashicons-upload"></span>
                                                    <?php esc_html_e('Import Settings', 'topper-pack'); ?>
                                                </button>
                                            </div>
                                            <p id="topppa-import-message" class="topppa-action-message"></p>
                                        </div>
                                    </div>

                                    <div class="topppa-reset-section">
                                        <div class="topppa-settings-section-header">
                                            <h3><?php esc_html_e('Reset Settings', 'topper-pack'); ?></h3>
                                            <p><?php esc_html_e('Reset all plugin settings to their default values. This action cannot be undone.', 'topper-pack'); ?></p>
                                        </div>
                                        <div class="topppa-settings-section-content">
                                            <div class="topppa-reset-warning">
                                                <div class="topppa-warning-box">
                                                    <span class="dashicons dashicons-warning"></span>
                                                    <strong><?php esc_html_e('Warning:', 'topper-pack'); ?></strong>
                                                    <?php esc_html_e('This will reset all plugin settings including widgets, extensions, API keys, and custom configurations. This action is irreversible.', 'topper-pack'); ?>
                                                </div>
                                            </div>
                                            <div class="topppa-reset-actions">
                                                <label class="topppa-reset-confirmation">
                                                    <input type="checkbox" id="topppa-confirm-reset">
                                                    <?php esc_html_e('I understand that this will reset all settings and cannot be undone', 'topper-pack'); ?>
                                                </label>
                                                <button type="button" id="topppa-reset-settings" class="topppa-dashboard-btn-global topppa-reset-btn" disabled>
                                                    <span class="dashicons dashicons-undo"></span>
                                                    <?php esc_html_e('Reset All Settings', 'topper-pack'); ?>
                                                </button>
                                            </div>
                                            <p id="topppa-reset-message" class="topppa-action-message"></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="topppa-copyright-wrapper"><?php esc_html_e('Copyrights by', 'topper-pack'); ?> <a href="https://topperpack.com" target="_blank"><?php esc_html_e('Topper Pack', 'topper-pack'); ?></a> <?php esc_html_e('All Rights Reserved.', 'topper-pack'); ?></div>
            </div>
        </div>
    </div>
<?php
}

/**
 * AJAX handler to save widget settings.
 */
add_action('wp_ajax_topppa_save_widget_settings', 'topppa_save_widget_settings');
function topppa_save_widget_settings() {
    if (!current_user_can('manage_options')) {
        wp_send_json_error('Unauthorized');
    }

    // List of widget options to update
    $widgets = [
        'topppa_logo_widget',
        'topppa_logo_widget',
        'topppa_header_info_widget',
        'topppa_button_widget',
        'topppa_social_widget',
        'topppa_header_offcanvas_widget',
        'topppa_header_menu_widget',
        'topppa_service_widget',
        'topppa_service_v2_widget',
        'topppa_service_v3_widget',
        'topppa_counter_widget',
        'topppa_testimonial_widget',
        'topppa_testimonial_two_widget',
        'topppa_testimonial_three_widget',
        'topppa_testimonial_four_widget',
        'topppa_brand_logo_widget',
        'topppa_blog_widget',
        'topppa_list_item_widget',
        'topppa_item_box_widget',
        'topppa_icon_box_widget',
        'topppa_contact_form_widget',
        'topppa_image_widget',
        'topppa_video_button_widget',
        'topppa_advanced_tab_widget',
        'topppa_pricing_table_widget',
        'topppa_faq_widget',
        'topppa_post_title_widget',
        'topppa_page_title_widget',
        'topppa_post_image_widget',
        'topppa_post_meta_widget',
        'topppa_post_content_widget',
        'topppa_team_widget',
        'topppa_project_widget',
        'topppa_project_v2_widget',
        'topppa_project_v3_widget',
        'topppa_shop_widget',
        'topppa_team_widget',
        'topppa_post_title_widget',
        'topppa_page_title_widget',
        'topppa_post_image_widget',
        'topppa_post_meta_widget',
        'topppa_post_content_widget',
        'topppa_post_share_widget',
        'topppa_post_tags_widget',
        'topppa_post_navication_widget',
        'topppa_post_author_section_widget',
        'topppa_post_comment_widget',
        'topppa_sidebar_post_widget',
        'topppa_search_box_widget',
        'topppa_breadcrumb_widget',
        'topppa_flip_box_widget',
        'topppa_slider_widget',
        'topppa_countdown_widget',
        'topppa_gallery_widget',
        'topppa_hotspot_widget',
        'topppa_timeline_widget',
        'topppa_product_thumbnail_widget',
        'topppa_product_price_widget',
        'topppa_product_rating_and_review_widget',
        'topppa_product_title_widget',
        'topppa_product_cart_button_widget',
        'topppa_product_categories_tags_widget',
        'topppa_product_description_widget',
        'topppa_product_additional_info_widget',
        'topppa_product_review_comment_widget',
        'topppa_product_cart_page_widget',
        'topppa_product_mini_cart_button_widget',
        'topppa_progress_bar_widget',
        'topppa_accordion_image_widget',
        'topppa_twitter_feed_widget',
        'topppa_facebook_feed_widget',
        'topppa_instagram_feed_widget',
        'topppa_product_checkout_page_widget',
        'topppa_wp_forms_widget',
        'topppa_mailchimp_widget',
        'topppa_weform_widget',
        'topppa_ninjaform_widget',
        'topppa_advance_review_widget',
        'topppa_facebook_review_widget',
        'topppa_yelp_review_widget',
        'topppa_heading_widget',
        'topppa_custom_carousel_widget',
        'topppa_cpt_builder_meta_widget',
        'topppa_audio_player_widget',
        'topppa_image_slider_widget',
        'topppa_service_slider_widget',
        'topppa_toggle_widget',
        'topppa_trade_coin_widget',
        'topppa_data_table_widget',
        // trip
        'topppa_trip_search_widget',
        'topppa_trip_taxonomy_module_widget',
        'topppa_trip_module_widget',
        'topppa_trip_module_v2_widget',
        'topppa_trip_activities_module_widget',
        'topppa_trip_destination_module_widget',
        'topppa_trip_types_module_widget',
        'topppa_trip_destination_taxonomy_widget',
        'topppa_trip_types_taxonomy_widget',
        'topppa_trip_activities_taxonomy_widget',
        'topppa_trip_activities_grid_widget',
        'topppa_trip_activities_tab_module_widget',
        'topppa_trip_destination_tab_module_widget',
        'topppa_trip_types_tab_module_widget',
        'topppa_trip_destination_tab_v2_module_widget',
        'topppa_trip_destination_tab_v3_module_widget',
        'topppa_trip_activities_accordion_widget',
        'topppa_dropdown_taxonomy_widget',
        'topppa_text_reveal_widget',
        'topppa_image_tab_widget',
        'topppa_slider_v2_widget',
        'topppa_slider_v3_widget',
        'topppa_marquee_widget',
        'topppa_vertical_marquee_widget',
        'topppa_animated_slider_widget',
        'topppa_sticky_header_widget',
        'topppa_accordion_service_widget',
        'topppa_hero_banner_one_widget',
    ];

    // Loop through widgets and update options only if the value has changed
    foreach ($widgets as $widget) {
        $new_value = isset($_POST[$widget]) && $_POST[$widget] === 'yes' ? 'yes' : 'no'; // phpcs:ignore WordPress.Security.NonceVerification.Missing
        $current_value = get_option($widget);

        // Only update if the value has changed
        if ($new_value !== $current_value) {
            update_option($widget, $new_value);
        }
    }

    wp_send_json_success('Settings saved successfully!');
}

/**
 * AJAX handler to save extension settings.
 */
add_action('wp_ajax_topppa_save_extension_settings', 'topppa_save_extension_settings');
function topppa_save_extension_settings() {
    if (!current_user_can('manage_options')) {
        wp_send_json_error('Unauthorized');
    }

    // List of extension options to update
    $extensions = [
        'topppa_sticky_section',
        'topppa_grid_line',
        'topppa_scroll_to_top',
        'topppa_custom_css',
        'topppa_wrapper_link',
        'topppa_conditional_display',
        'interactive_animations',
        'topppa_tooltip_section',
        'topppa_container_hover_effects',
        'topppa_cursor_effect',
        'topppa_split_text_animation',
        'topppa_wow_animation',
        'topppa_reveal_effect',
        'topppa_border_animation',
        'advanced_image_hover',
        'pin_section',
        'topppa_motion_text',
        'topppa_dots_particle_animation',
        'topppa_hover_image_viewer',
    ];

    // Loop through extensions and update options based on checkbox state
    foreach ($extensions as $extension) {
        $value = isset($_POST[$extension]) && $_POST[$extension] === 'yes' ? 'yes' : 'no'; // phpcs:ignore WordPress.Security.NonceVerification.Missing
        update_option($extension, $value);
    }

    wp_send_json_success('Settings saved successfully!');
}

/**
 * AJAX handler to save extra settings.
 */
add_action('wp_ajax_topppa_save_extra_settings', 'topppa_save_extra_settings');
function topppa_save_extra_settings() {
    if (!current_user_can('manage_options')) {
        wp_send_json_error('Unauthorized');
    }

    // List of extra settings to update
    $extra_settings = [
        'topppa_assets_manager',
        'topppa_smooth_scroller',
        'topppa_mega_menu',
        'topppa_template_library',
        'topppa_custom_icon',
        'topppa_custom_font',
        'topppa_cpt_builder'
    ];

    // Loop through extra settings and update options based on checkbox state
    foreach ($extra_settings as $setting) {
        $value = isset($_POST[$setting]) && $_POST[$setting] === 'yes' ? 'yes' : 'no'; // phpcs:ignore WordPress.Security.NonceVerification.Missing
        update_option($setting, $value);
    }

    wp_send_json_success('Settings saved successfully!');
}

// API Settings Handler
add_action('wp_ajax_topppa_save_api_settings', 'topppa_save_api_settings');
function topppa_save_api_settings() {
    if (!current_user_can('manage_options')) {
        wp_send_json_error('Unauthorized');
    }
    if (
        !isset($_POST['topppa_nonce']) ||
        !wp_verify_nonce(sanitize_text_field(wp_unslash($_POST['topppa_nonce'])), 'topppa_settings_nonce') // phpcs:ignore WordPress.Security.ValidatedSanitizedInput.MissingUnslash
    ) {
        wp_send_json_error('Invalid Nonce');
    }
    // Get the API key and other settings from the AJAX request
    $topppa_google_maps_api_key = isset($_POST['topppa_google_maps_api_key']) ? sanitize_text_field($_POST['topppa_google_maps_api_key']) : ''; // phpcs:ignore WordPress.Security.ValidatedSanitizedInput.MissingUnslash
    $topppa_facebook_id = isset($_POST['topppa_facebook_id']) ? sanitize_text_field($_POST['topppa_facebook_id']) : ''; // phpcs:ignore WordPress.Security.ValidatedSanitizedInput.MissingUnslash
    $topppa_facebook_token = isset($_POST['topppa_facebook_token']) ? sanitize_text_field($_POST['topppa_facebook_token']) : ''; // phpcs:ignore WordPress.Security.ValidatedSanitizedInput.MissingUnslash
    $topppa_recaptcha_site_key = isset($_POST['topppa_recaptcha_site_key']) ? sanitize_text_field($_POST['topppa_recaptcha_site_key']) : ''; // phpcs:ignore WordPress.Security.ValidatedSanitizedInput.MissingUnslash
    $topppa_recaptcha_secret_key = isset($_POST['topppa_recaptcha_secret_key']) ? sanitize_text_field($_POST['topppa_recaptcha_secret_key']) : ''; // phpcs:ignore WordPress.Security.ValidatedSanitizedInput.MissingUnslash
    $topppa_twitter_uname = isset($_POST['topppa_twitter_uname']) ? sanitize_text_field($_POST['topppa_twitter_uname']) : ''; // phpcs:ignore WordPress.Security.ValidatedSanitizedInput.MissingUnslash
    $topppa_twitter_key = isset($_POST['topppa_twitter_key']) ? sanitize_text_field($_POST['topppa_twitter_key']) : ''; // phpcs:ignore WordPress.Security.ValidatedSanitizedInput.MissingUnslash
    $topppa_twitter_secret_key = isset($_POST['topppa_twitter_secret_key']) ? sanitize_text_field($_POST['topppa_twitter_secret_key']) : ''; // phpcs:ignore WordPress.Security.ValidatedSanitizedInput.MissingUnslash
    $topppa_twitter_access_token = isset($_POST['topppa_twitter_access_token']) ? sanitize_text_field($_POST['topppa_twitter_access_token']) : ''; // phpcs:ignore WordPress.Security.ValidatedSanitizedInput.MissingUnslash
    $topppa_twitter_access_token_secret = isset($_POST['topppa_twitter_access_token_secret']) ? sanitize_text_field($_POST['topppa_twitter_access_token_secret']) : ''; // phpcs:ignore WordPress.Security.ValidatedSanitizedInput.MissingUnslash
    $topppa_mailchimp_id = isset($_POST['topppa_mailchimp_id']) ? sanitize_text_field($_POST['topppa_mailchimp_id']) : ''; // phpcs:ignore WordPress.Security.ValidatedSanitizedInput.MissingUnslash
    $topppa_mailchimp_key = isset($_POST['topppa_mailchimp_key']) ? sanitize_text_field($_POST['topppa_mailchimp_key']) : ''; // phpcs:ignore WordPress.Security.ValidatedSanitizedInput.MissingUnslash
    $topppa_instagram_app_id = isset($_POST['topppa_instagram_app_id']) ? sanitize_text_field($_POST['topppa_instagram_app_id']) : ''; // phpcs:ignore WordPress.Security.ValidatedSanitizedInput.MissingUnslash
    $topppa_instagram_app_secret = isset($_POST['topppa_instagram_app_secret']) ? sanitize_text_field($_POST['topppa_instagram_app_secret']) : ''; // phpcs:ignore WordPress.Security.ValidatedSanitizedInput.MissingUnslash
    $topppa_instagram_access_token = isset($_POST['topppa_instagram_access_token']) ? sanitize_text_field($_POST['topppa_instagram_access_token']) : ''; // phpcs:ignore WordPress.Security.ValidatedSanitizedInput.MissingUnslash

    // Save all settings to the WordPress options table (including empty values to allow clearing)
    update_option('topppa_google_maps_api_key', $topppa_google_maps_api_key);
    update_option('topppa_facebook_id', $topppa_facebook_id);
    update_option('topppa_facebook_token', $topppa_facebook_token);
    update_option('topppa_recaptcha_site_key', $topppa_recaptcha_site_key);
    update_option('topppa_recaptcha_secret_key', $topppa_recaptcha_secret_key);
    update_option('topppa_twitter_uname', $topppa_twitter_uname);
    update_option('topppa_twitter_key', $topppa_twitter_key);
    update_option('topppa_twitter_secret_key', $topppa_twitter_secret_key);
    update_option('topppa_twitter_access_token', $topppa_twitter_access_token);
    update_option('topppa_twitter_access_token_secret', $topppa_twitter_access_token_secret);
    update_option('topppa_mailchimp_id', $topppa_mailchimp_id);
    update_option('topppa_mailchimp_key', $topppa_mailchimp_key);
    update_option('topppa_instagram_app_id', $topppa_instagram_app_id);
    update_option('topppa_instagram_app_secret', $topppa_instagram_app_secret);
    update_option('topppa_instagram_access_token', $topppa_instagram_access_token);

    // Send a success response
    wp_send_json_success('Settings saved successfully!');
}

/**
 * AJAX handler to reset the setup wizard
 */
add_action('wp_ajax_topppa_reset_wizard', 'topppa_reset_wizard');
function topppa_reset_wizard() {
    if (!current_user_can('manage_options')) {
        wp_send_json_error('Unauthorized');
    }

    if (!wp_verify_nonce($_POST['nonce'], 'topppa_reset_wizard_nonce')) {
        wp_send_json_error('Invalid nonce');
    }

    // Reset wizard completion status
    delete_option('topper_pack_wizard_completed');
    update_option('topper_pack_show_wizard', 'yes');

    // Clear any cached data
    delete_transient('topper_pack_wizard_state');
    wp_cache_delete('topper_pack_wizard_redirect', 'options');

    wp_send_json_success('Wizard reset successfully. You will be redirected to the setup wizard.');
}
