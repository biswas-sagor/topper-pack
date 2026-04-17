<?php
/**
 * Utilities Class
 *
 * @package TopperPack
 */

namespace TopperPack\Includes;

use Elementor\Controls_Manager;

defined('ABSPATH') || exit;

/**
 * Utilities class for common functions
 */
class Utilities {

    /**
     * Generate upgrade notice image HTML content - dynamic image path
     */
    public static function upgrade_pro_image_notice( $image_name = '' ) {
        // Get upgrade URL
        $url = function_exists('topppa_get_dynamic_url') ? topppa_get_dynamic_url() : 'https://topperpack.com/pricing/';

        // Build image URL dynamically
        if (!empty($image_name)) {
            $image_url = TOPPPA_ASSETS_URL . 'images/pro/' . $image_name;
        } else {
            $image_url = TOPPPA_ASSETS_URL . 'images/fallback.webp';
        }

        return sprintf(
            '<div class="topppa-pro-image-wrapper" style="
                position: relative;
                display: inline-block;
                overflow: hidden;
                border-radius: 8px;
                cursor: pointer;
            ">
                <img src="%s" alt="Pro Feature" style="
                    max-width: 100%%;
                    height: auto;
                    display: block;
                    transition: all 0.3s ease;
                " />
                <div class="topppa-upgrade-overlay" style="
                    position: absolute;
                    top: 0;
                    left: 0;
                    right: 0;
                    bottom: 0;
                    background: rgba(0, 0, 0, 0.8);
                    display: flex;
                    flex-direction: column;
                    justify-content: center;
                    align-items: center;
                    opacity: 0;
                    transition: all 0.3s ease;
                    pointer-events: none;
                ">
                    <p style="
                        margin: 0 0 15px 0;
                        color: white;
                        font-size: 14px;
                        font-weight: 500;
                        text-align: center;
                        padding: 0 20px;
                    ">Pro Feature Available</p>
                    <a href="%s" target="_blank" style="
                        background: #667eea;
                        color: white;
                        padding: 10px 24px;
                        border-radius: 25px;
                        text-decoration: none;
                        font-weight: 600;
                        font-size: 13px;
                        display: inline-block;
                        transition: all 0.3s ease;
                        pointer-events: auto;
                    " onmouseover="this.style.background=\'#5a6fd8\'" onmouseout="this.style.background=\'#667eea\'">
                        %s →
                    </a>
                </div>
                <style>
                    .topppa-pro-image-wrapper:hover .topppa-upgrade-overlay {
                        opacity: 1 !important;
                        pointer-events: auto !important;
                    }
                    .topppa-pro-image-wrapper:hover img {
                        transform: scale(1.05) !important;
                    }
                </style>
            </div>',
            $image_url,
            $url,
            esc_html__('Upgrade to Pro', 'topper-pack')
        );
    }

    /**
     * Add upgrade to pro notice
     */
    public static function upgrade_pro_notice( $module, $controls_manager, $widget, $option, $condition = [] ) {
        // Check if user already has premium access
        if ( function_exists('topppa_can_use_premium_features') && topppa_can_use_premium_features() ) {
            return;
        }

        // Get upgrade URL with simple tracking
        $url = function_exists('topppa_get_dynamic_url') ? topppa_get_dynamic_url('widget_' . $widget) : 'https://topperpack.com/pricing/';
        
        // Add UTM parameters for tracking
        $url = add_query_arg([
            'utm_source' => 'plugin',
            'utm_medium' => 'widget',
            'utm_campaign' => $widget,
            'utm_content' => $option
        ], $url);

        // Add the notice with improved design
        $module->add_control(
            $option . '_pro_notice',
            [
                'raw' => sprintf(
                    '<div class="topppa-pro-upgrade-notice" style="
                        background: linear-gradient(135deg, #667eea 0%%, #764ba2 100%%);
                        color: white;
                        padding: 20px;
                        border-radius: 12px;
                        text-align: center;
                        margin: 15px 0;
                        box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);
                        border: none;
                        position: relative;
                        overflow: hidden;
                    ">
                        <div style="position: absolute; top: -50%%; right: -50%%; width: 100%%; height: 100%%; background: rgba(255,255,255,0.1); border-radius: 50%%; transform: rotate(45deg);"></div>
                        <div style="position: relative; z-index: 2;">
                            <div style="font-size: 24px; margin-bottom: 8px;">🚀</div>
                            <h4 style="margin: 0 0 8px 0; color: white; font-size: 16px; font-weight: 600;">Unlock Pro Features</h4>
                            <p style="margin: 0 0 16px 0; opacity: 0.9; font-size: 13px; line-height: 1.4;">This feature is available in the Pro version with advanced customization options!</p>
                            <a href="%s" target="_blank" onclick="topppaTrackClick(\'%s\', \'%s\')" style="
                                background: rgba(255,255,255,0.2);
                                color: white;
                                padding: 10px 24px;
                                border-radius: 25px;
                                text-decoration: none;
                                font-weight: 600;
                                font-size: 13px;
                                display: inline-block;
                                transition: all 0.3s ease;
                                border: 1px solid rgba(255,255,255,0.3);
                                backdrop-filter: blur(10px);
                            " onmouseover="this.style.background=\'rgba(255,255,255,0.3)\'; this.style.transform=\'translateY(-2px)\'" onmouseout="this.style.background=\'rgba(255,255,255,0.2)\'; this.style.transform=\'translateY(0)\'">
                                %s →
                            </a>
                        </div>
                    </div>',
                    $url,
                    $widget,
                    $option,
                    self::get_dynamic_link_text()
                ),
                'type' => $controls_manager,
                'content_classes' => 'topppa-pro-notice',
                'condition' => [
                    $option => $condition,
                ]
            ]
        );
    }

    /**
     * Get dynamic link text
     */
    private static function get_dynamic_link_text() {
        return esc_html__('Upgrade to Pro', 'topper-pack');
    }

    /**
     * Add simple tracking script
     */
    public static function add_simple_tracking() {
        if (!is_admin()) {
            return;
        }
        
        ?>
        <script>
        function topppaTrackClick(widget, option) {
            
            // Send to Google Analytics if available
            if (typeof gtag !== 'undefined') {
                gtag('event', 'upgrade_click', {
                    'widget_name': widget,
                    'option_name': option,
                    'source': 'elementor_widget'
                });
            }
        }
        </script>
        <?php
    }

    /**
     * Initialize simple tracking
     */
    public static function init_tracking() {
        add_action('admin_footer', [__CLASS__, 'add_simple_tracking']);
    }
} 