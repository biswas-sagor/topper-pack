<?php
/**
 * Template Library Import
 *
 * @package Topper Pack
 * @since 1.0.0
 */
namespace TopperPack\Includes\Templates_Library;

defined( 'ABSPATH' ) || die();

use \Elementor\Core\Common\Modules\Ajax\Module as Ajax;
use \Elementor\Plugin;
use \TopperPack\Includes\Templates_Library\TOPPPA_Templates_Api;

class TOPPPA_Templates_Import {
    private static $instance = null;

    protected static $template = null;

    public function load() {
        add_action( 'elementor/ajax/register_actions', array( $this, 'ajax_actions' ) );
    }

    public function ajax_actions( Ajax $ajax ) {
        $ajax->register_ajax_action( 'get_topppa_template_data', function ( $data ) {
            if ( !current_user_can( 'edit_posts' ) ) {
                throw new \Exception( esc_html__( 'Access Denied', 'topper-pack' ) );
            }

            if ( !empty( $data['editor_post_id'] ) ) {
                $editor_post_id = absint( $data['editor_post_id'] );

                if ( !get_post( $editor_post_id ) ) {
                    throw new \Exception( esc_html__( 'Post not found', 'topper-pack' ) );
                }
                Plugin::$instance->db->switch_to_post( $editor_post_id );
            }

            if ( empty( $data['template_id'] ) ) {
                throw new \Exception( esc_html__( 'Template id missing', 'topper-pack' ) );
            }
            
            // Check if this is a pro template
            $template_id = $data['template_id'];
            if ($this->is_pro_template($template_id) && !topppa_can_use_premium_features()) {
                // Return a custom response instead of throwing an exception
                return [
                    'success' => false,
                    'data' => [
                        'message' => 'pro_demo_locked',
                        'title' => esc_html__('Pro Demo Locked', 'topper-pack'),
                        'description' => esc_html__('This is a premium template. Please upgrade to Pro to unlock this template and many more premium features.', 'topper-pack')
                    ]
                ];
            }
            
            return self::get_template_data( $data );
        } );
    }
    
    /**
     * Check if template is pro based on template ID
     */
    private function is_pro_template($template_id) {
        // Decode the template ID to get the path
        $decoded_id = base64_decode($template_id);
        
        // Check if the path contains _pro
        if (strpos($decoded_id, '_pro') !== false) {
            return true;
        }
        
        return false;
    }

    public static function get_template_data( array $args ) {
        $template = self::template_library();
        return $template->get_data( $args );
    }

    public static function template_library() {
        if ( is_null( self::$template ) ) {
            self::$template = new TOPPPA_Templates_Api();
        }
        return self::$template;
    }

    public static function instance() {
        if ( is_null( self::$instance ) ) {
            self::$instance = new self();
        }
        return self::$instance;
    }
}