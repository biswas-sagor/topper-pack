<?php
/**
 * Condition
 *
 * @package Topper Pack
 * @since 1.0.0
 */

namespace TopperPack\Extensions\Conditional_Display\Conditions;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

abstract class TOPPPA_Condition {
	public function topppa_control_options() {}
	public function topppa_compare_value( $settings, $operator, $value, $compare_val ) {}
}
