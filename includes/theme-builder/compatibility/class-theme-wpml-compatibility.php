<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use TopperPack\Traits\Singleton;

/**
 * Set up WPML Compatibiblity Class.
 */
class HF_WPML_Compatibility {
	use Singleton;

	private function __construct() {
		add_filter( 'topppa_hfe_get_settings_type_header', array( $this, 'get_wpml_object' ) );
		add_filter( 'topppa_hfe_get_settings_type_footer', array( $this, 'get_wpml_object' ) );
		add_filter( 'topppa_hfe_render_template_id', array( $this, 'get_wpml_object' ) );
	}

	public function get_wpml_object( $id ) {
		$translated_id = apply_filters( 'wpml_object_id', $id );

		if ( defined( 'POLYLANG_BASENAME' ) ) {

			if ( null === $translated_id ) {
				return $id;
			} else {
				return $translated_id;
			}
		}

		if ( null === $translated_id ) {
			$translated_id = '';
		}

		return $translated_id;
	}
}

HF_WPML_Compatibility::instance();
