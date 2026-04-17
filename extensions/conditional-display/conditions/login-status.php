<?php
/**
 * Login Status Condition
 *
 * @package Topper Pack
 * @since 1.0.0
 */

namespace TopperPack\Extensions\Conditional_Display\Conditions;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

use Elementor\Controls_Manager;

class Login_Status extends TOPPPA_Condition {

	public function topppa_control_options() {

		return array(
			'label'       => __( 'Value', 'topper-pack' ),
			'type'        => Controls_Manager::SELECT,
			'options'     => array(
				'logged' => __( 'Logged In', 'topper-pack' ),
			),
			'default'     => 'logged',
			'label_block' => true,
			'condition'   => array(
				'topppa_condition_key' => 'login_status',
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

		$condition_result = is_user_logged_in();

		return $this->topppa_final_result( $condition_result, $operator );
	}
}
