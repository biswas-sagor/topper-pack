<?php
/**
 * Template Library API
 *
 * @package Topper Pack
 * @since 1.0.0
 */
namespace TopperPack\Includes\Templates_Library;

use \Elementor\Plugin;
use \Elementor\TemplateLibrary\Source_Base;

if ( !defined( 'ABSPATH' ) ) {exit;}

class TOPPPA_Templates_Api extends Source_Base {

    const LIBRARY_OPTION_KEY = 'topppa_library_info';

    const LIBRARY_TIMESTAMP_CACHE_KEY = 'topppa_remote_update_timestamp';

    //Change Template link
    const API_INFO_URL = 'https://import.topperpack.com/';

    public function get_id() {
        return 'topppa-library';
    }

    public function get_title() {
        return esc_html__( 'TopperPack Library', 'topper-pack' );
    }

    public function register_data() {}

    public function get_items( $args = [] ) {
        $library_data = self::get_library_data();
        $templates = [];
        if ( !empty( $library_data['templates'] ) ) {
            foreach ( $library_data['templates'] as $template_data ) {
                $templates[] = $this->prepare_template( $template_data );
            }
        }
        return $templates;
    }

    public function get_tags() {
        $library_data = self::get_library_data();
        return ( !empty( $library_data['tags'] ) ? $library_data['tags'] : [] );
    }

    public function get_type_tags() {
        $library_data = self::get_library_data();
        return ( !empty( $library_data['type_tags'] ) ? $library_data['type_tags'] : [] );
    }

    private function prepare_template( array $template_data ) {
        // Check if this is a pro template
        $is_pro_template = $this->is_pro_template($template_data);
        
        // Check if server marked this template as restricted
        $is_restricted = isset($template_data['restricted']) && $template_data['restricted'];
        
        // If it's a restricted pro template, show restriction
        if ($is_restricted) {
            return $this->prepare_pro_restricted_template($template_data);
        }
        
        return [
            'template_id' => $template_data['template_id'],
            'title'       => $template_data['title'],
            'type'        => $template_data['type'],
            'thumbnail'   => $template_data['thumbnail'],
            'date'        => $template_data['modified'],
            'tags'        => $template_data['tags'],
            'url'         => $template_data['preview'],
            'liveurl'     => $template_data['liveurl'],
            'favorite'    => !empty( $template_data['template_id'] ),
            'is_pro'      => $is_pro_template,
        ];
    }
    
    /**
     * Check if template is pro based on data
     */
    private function is_pro_template($template_data) {
        // Check if server marked it as pro
        if (isset($template_data['is_pro']) && $template_data['is_pro']) {
            return true;
        }
        
        // Check title for pro badge
        if (isset($template_data['title']) && strpos($template_data['title'], 'PRO') !== false) {
            return true;
        }
        
        // Check tags for pro indicators
        if (isset($template_data['tags']) && is_array($template_data['tags'])) {
            foreach ($template_data['tags'] as $tag) {
                if (strpos($tag, '_pro') !== false) {
                    return true;
                }
            }
        }
        
        return false;
    }
    
    /**
     * Prepare pro template with restriction notice
     */
    private function prepare_pro_restricted_template($template_data) {
        return [
            'template_id' => $template_data['template_id'],
            'title'       => $template_data['title'],
            'type'        => $template_data['type'],
            'thumbnail'   => $template_data['thumbnail'],
            'date'        => $template_data['modified'],
            'tags'        => $template_data['tags'],
            'url'         => $template_data['preview'],
            'liveurl'     => $template_data['liveurl'],
            'favorite'    => false,
            'is_pro'      => true,
            'restricted'  => true,
            'restriction_message' => 'This is a Pro template. Upgrade to Pro to access this template.',
        ];
    }

    private static function request_library_data( $force_update = false ) {
        $data = get_option( self::LIBRARY_OPTION_KEY );

        $elementor_update_timestamp = get_option( '_transient_timeout_elementor_remote_info_api_data_' . ELEMENTOR_VERSION );
        $update_timestamp = get_transient( self::LIBRARY_TIMESTAMP_CACHE_KEY );

        if ( $force_update || false === $data || !$update_timestamp || $update_timestamp != $elementor_update_timestamp ) {
            $timeout = ( $force_update ) ? 25 : 8;

            // Get user's pro status using the main function that handles both Freemius and theme license
            $user_pro_status = 'free';
            
            // Check multiple conditions for pro access
            $has_pro_access = false;
            
            // Check if topppa_can_use_premium_features function exists and returns true
            if (function_exists('topppa_can_use_premium_features') && topppa_can_use_premium_features()) {
                $has_pro_access = true;
            }
            
            // Check if topper-pack-pro plugin is active
            if (function_exists('is_topperpack_pro_active') && is_topperpack_pro_active()) {
                $has_pro_access = true;
            }
            
            // Check if theme license is active
            if (function_exists('topppa_is_theme_license_active') && topppa_is_theme_license_active()) {
                $has_pro_access = true;
            }
            
            // Check if Freemius is available and user has premium access
            if (function_exists('tpp_fs') && tpp_fs()->is_registered() && tpp_fs()->can_use_premium_code__premium_only()) {
                $has_pro_access = true;
            }
            
            if ($has_pro_access) {
                $user_pro_status = 'professional';
            }

            $apiUrl = self::API_INFO_URL . '?' . http_build_query( [
                'action' => 'get_layouts',
                'tab'    => '',
                'user_pro_status' => $user_pro_status,
            ] );
            $response = wp_remote_get( $apiUrl, [
                'timeout' => $timeout,
            ] );

            if ( is_wp_error( $response ) || 200 !== (int) wp_remote_retrieve_response_code( $response ) ) {
                update_option( self::LIBRARY_OPTION_KEY, [] );
                return false;
            }

            $data = json_decode( wp_remote_retrieve_body( $response ), true );

            if ( empty( $data ) || !is_array( $data ) ) {
                update_option( self::LIBRARY_OPTION_KEY, [] );
                set_transient( self::LIBRARY_TIMESTAMP_CACHE_KEY, [], 2 * HOUR_IN_SECONDS );
                return false;
            }

            //Update when reload
            update_option( self::LIBRARY_OPTION_KEY, $data, 'yes' );
        }
        return $data;
    }

    public static function get_library_data( $force_update = false ) {
        self::request_library_data( $force_update );
        $library_data = get_option( self::LIBRARY_OPTION_KEY );
        if ( empty( $library_data ) ) {
            return [];
        }
        return $library_data;
    }

    public function get_item( $template_id ) {
        $templates = $this->get_items();

        return $templates[$template_id];
    }

    public function save_item( $template_data ) {
        return new \WP_Error( 'invalid_request', 'Cannot save template to a droit elementor addons library' );
    }

    public function update_item( $new_data ) {
        return new \WP_Error( 'invalid_request', 'Cannot update template to a droit elementor addons library' );
    }

    public function delete_template( $template_id ) {
        return new \WP_Error( 'invalid_request', 'Cannot delete template from a droit elementor addons library' );
    }

    public function export_template( $template_id ) {
        return new \WP_Error( 'invalid_request', 'Cannot export template from a droit elementor addons library' );
    }

    public static function request_template_data( $template_id ) {
        if ( empty( $template_id ) ) {
            return $template_id;
        }

        $body = [
            'site_lang'        => get_bloginfo( 'language' ),
            'home_url'         => trailingslashit( home_url() ),
            'template_version' => '1.0.0',
        ];

        $body_args = apply_filters( 'elementor/api/get_templates/body_args', $body );

        $apiUrl = self::API_INFO_URL . '?' . http_build_query( [
            'action' => 'get_layout_data',
            'id'     => $template_id,
        ] );

        $response = wp_remote_get(
            $apiUrl,
            [
                'body'    => $body_args,
                'timeout' => 10,
            ]
        );

        return wp_remote_retrieve_body( $response );
    }

    public function get_data( array $args, $context = 'display' ) {
        $data = self::request_template_data( $args['template_id'] );

        $data = json_decode( $data, true );
        if ( empty( $data ) || empty( $data['content'] ) ) {
            throw new \Exception( esc_html__( 'Template does not have any content', 'topper-pack' ) );
        }

        $data['content'] = $this->replace_elements_ids( $data['content'] );
        $data['content'] = $this->process_export_import_content( $data['content'], 'on_import' );

        $post_id = $args['editor_post_id'];
        $document = Plugin::$instance->documents->get( $post_id );
        if ( $document ) {
            $data['content'] = $document->get_elements_raw_data( $data['content'], true );
        }
        return $data;
    }
}