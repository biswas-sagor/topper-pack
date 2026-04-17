<?php
/**
 * Helper
 *
 * @package Topper Pack
 * @since 1.0.0
 */
namespace TopperPack\Includes;

use Elementor\Plugin;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class TOPPPA_Helper {

    public static function get_template_content( $title, $id = false ) {

		$frontend = Plugin::$instance->frontend;

		$custom_temp = apply_filters( 'topppa_temp_id', false );

		if ( $custom_temp ) {
			$id = $title = $custom_temp;
		}

		if ( ! $id ) {
			$id = $this->get_id_by_title( $title );

			if ( ! $id ) {
				// To replace the &#8211; in templates names with dash.
				$decoded_title = html_entity_decode( $title );
				$id            = $this->get_id_by_title( $decoded_title );
			}

			$id = apply_filters( 'wpml_object_id', $id, 'elementor_library', true );
		} else {
			$id = $title;
		}

		$template_content = $frontend->get_builder_content_for_display( $id, true );

		return $template_content;
	}

    public static function get_id_by_title( $title ) {

		if ( empty( $title ) ) {
			return;
		}

		$args = array(
			'post_type'        => 'elementor_library',
			'post_status'      => 'publish',
			'posts_per_page'   => 1,
			'title'            => $title,
			//'suppress_filters' => true, // phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_suppress_filters
		);

		$query = new \WP_Query( $args );

		$post_id = '';

		if ( $query->have_posts() ) {
			$post_id = $query->post->ID;
			wp_reset_postdata();
		}

		return $post_id;
	}

    public static function get_all_breakpoints( $type = 'assoc' ) {

		$devices = array(
			'desktop' => esc_html__( 'Desktop', 'topper-pack' ),
			'tablet'  => esc_html__( 'Tablet', 'topper-pack' ),
			'mobile'  => esc_html__( 'Mobile', 'topper-pack' ),
		);

		$method_available = method_exists( Plugin::$instance->breakpoints, 'has_custom_breakpoints' );

		if ( ( defined( 'ELEMENTOR_VERSION' ) && version_compare( ELEMENTOR_VERSION, '3.4.0', '>' ) ) && $method_available ) {

			if ( Plugin::$instance->breakpoints->has_custom_breakpoints() ) {
				$devices = array_merge(
					$devices,
					array(
						'widescreen'   => esc_html__( 'Widescreen', 'topper-pack' ),
						'laptop'       => esc_html__( 'Laptop', 'topper-pack' ),
						'tablet_extra' => esc_html__( 'Tablet Extra', 'topper-pack' ),
						'mobile_extra' => esc_html__( 'Mobile Extra', 'topper-pack' ),
					)
				);
			}
		}

		if ( 'keys' === $type ) {
			$devices = array_keys( $devices );
		}

		return $devices;
	}

	public static function topppa_get_taxonomies( $object = 'product', $skip_terms = false ) {
		$all_taxonomies  = get_object_taxonomies( $object );
		$taxonomies_list = array();
		foreach ( $all_taxonomies as $taxonomy_data ) {
			$taxonomy = get_taxonomy( $taxonomy_data );
			if ( $skip_terms === true ) {
				if ( ( $taxonomy->show_ui ) && ( 'pa_' !== substr( $taxonomy_data, 0, 3 ) ) ) {
					$taxonomies_list[ $taxonomy_data ] = $taxonomy->label;
				}
			} else {
				if ( $taxonomy->show_ui ) {
					$taxonomies_list[ $taxonomy_data ] = $taxonomy->label;
				}
			}
		}
		return $taxonomies_list;
	}
}

new TOPPPA_Helper();
