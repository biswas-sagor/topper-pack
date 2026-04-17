<?php
/**
 * User Role Condition
 *
 * @package Topper Pack
 * @since 1.0.0
 */

namespace TopperPack\Extensions\Conditional_Display\Conditions;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

use Elementor\Controls_Manager;

class User_Role extends TOPPPA_Condition {

	public function topppa_control_options() {
		global $wp_roles;

		return array(
			'label'       => __( 'Value', 'topper-pack' ),
			'type'        => Controls_Manager::SELECT2,
			'label_block' => true,
			'default'     => array(),
			'options'     => $wp_roles->get_names(),
			'multiple'    => true,
			'condition'   => array(
				'topppa_condition_key' => 'user_role',
			),
		);
	}

	public function topppa_final_result( $condition_result, $operator ) {

		if ( 'is' === $operator ) {
			return true === $condition_result;
		} else {
			return true !== $condition_result;
		}
	}

	public function topppa_compare_value( $settings, $operator, $value, $compare_val ) {

		if ( ! is_user_logged_in() || empty( $value ) ) {
			return false;
		}

		$value = ! is_array( $value ) ? (array) $value : $value; // temp: to make sure it's an array.

		$user = wp_get_current_user();

		$condition_result = ! empty( array_intersect( $value, $user->roles ) ) ? true : false;

		return $this->topppa_final_result( $condition_result, $operator );
	}
}
