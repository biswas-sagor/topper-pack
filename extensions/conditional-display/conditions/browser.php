<?php
/**
 * Browser Condition
 *
 * @package Topper Pack
 * @since 1.0.0
 */

namespace TopperPack\Extensions\Conditional_Display\Conditions;

use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class Browser extends TOPPPA_Condition {
	public function topppa_control_options() {

		return array(
			'label'       => __( 'Value', 'topper-pack' ),
			'type'        => Controls_Manager::SELECT2,
			'default'     => 'chrome',
			'label_block' => true,
			'options'     => array(
				'opera'   => __( 'Opera', 'topper-pack' ),
				'edge'    => __( 'Microsoft Edge', 'topper-pack' ),
				'chrome'  => __( 'Google Chrome', 'topper-pack' ),
				'safari'  => __( 'Safari', 'topper-pack' ),
				'firefox' => __( 'Mozilla Firefox', 'topper-pack' ),
				'ie'      => __( 'Internet Explorer', 'topper-pack' ),
			),
			'multiple'    => true,
			'condition'   => array(
				'topppa_condition_key' => 'browser',
			),
		);
	}

	public function topppa_compare_value( $settings, $operator, $value, $compare_val ) {

		$user_agent = isset( $_SERVER['HTTP_USER_AGENT'] ) ? sanitize_text_field( wp_unslash( $_SERVER['HTTP_USER_AGENT'] ) ) : '';

		$user_agent = $this->topppa_browser_name( $user_agent );

		$condition_result = is_array( $value ) && ! empty( $value ) ? in_array( $user_agent, $value, true ) : $value === $user_agent;

		return $this->topppa_final_result( $condition_result, $operator );
	}

	public function topppa_final_result( $condition_result, $operator ) {

		if ( 'is' === $operator ) {
			return true === $condition_result;
		} else {
			return true !== $condition_result;
		}
	}

	private static function topppa_browser_name( $user_agent ) {

		if ( strpos( $user_agent, 'Opera' ) || strpos( $user_agent, 'OPR/' ) ) {
			return 'opera';
		} elseif ( strpos( $user_agent, 'Edg' ) || strpos( $user_agent, 'Edge' ) ) {
			return 'edge';
		} elseif ( strpos( $user_agent, 'Chrome' ) ) {
			return 'chrome';
		} elseif ( strpos( $user_agent, 'Safari' ) ) {
			return 'safari';
		} elseif ( strpos( $user_agent, 'Firefox' ) ) {
			return 'firefox';
		} elseif ( strpos( $user_agent, 'MSIE' ) || strpos( $user_agent, 'Trident/7' ) ) {
			return 'ie';
		}
	}
}
