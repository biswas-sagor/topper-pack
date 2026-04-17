<?php
/**
 * Conditional Display Handler
 *
 * @package Topper Pack
 * @since 1.0.0
 */

namespace TopperPack\Extensions;

use Elementor\Controls_Manager;
use Elementor\Repeater;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class TOPPPA_Conditional_Display_Handler {

	public static $conditions_classes = array();

	public static $conditions_keys = array();

	public static $conditions = array();

	protected $conditions_results_holder = array();

	public function __construct() {

		$this->topppa_init_conditions();
		$this->topppa_conditions_classes();

		$is_edit_mode = \Elementor\Plugin::$instance->editor->is_edit_mode();

		if ( ! $is_edit_mode ) {
			$this->topppa_actions();
		}
	}

	public function topppa_init_conditions() {

		static::$conditions = array(
			'system'    => array(
				'label'   => __( 'System', 'topper-pack' ),
				'options' => array(
					'browser'          => __( 'Browser', 'topper-pack' ),
				),
			),
			'userdata'  => array(
				'label'   => __( 'User', 'topper-pack' ),
				'options' => array(
					'login_status'   => __( 'Login Status', 'topper-pack' ),
					'user_role'      => __( 'Role', 'topper-pack' ),
				),
			),
		);
	}

	public function topppa_conditions_classes() {

		self::$conditions_keys = apply_filters(
			'topppa_conditional_display_keys',
			array(
				'browser',
				'login_status',
				'user_role',
			)
		);

		include_once TOPPPA_EXTENSIONS_PATH . 'conditional-display/conditions/condition.php';

		foreach ( self::$conditions_keys as $condition_key ) {

			$file_name = str_replace( '_', '-', strtolower( $condition_key ) );

			if ( file_exists( TOPPPA_EXTENSIONS_PATH . 'conditional-display/conditions/' . $file_name . '.php' ) ) {
				include_once TOPPPA_EXTENSIONS_PATH . 'conditional-display/conditions/' . $file_name . '.php';
			}

			$class_name = str_replace( '-', ' ', $condition_key );
			$class_name = str_replace( ' ', '', ucwords( $class_name ) );
			$class_name = __NAMESPACE__ . '\Conditional_Display\Conditions\\' . $class_name;

			if ( class_exists( $class_name ) ) {
				static::$conditions_classes[ $condition_key ] = new $class_name();
			}
		}
	}

	public function topppa_actions() {
		add_filter( 'elementor/frontend/widget/should_render', array( $this, 'topppa_should_render' ), 10, 2 );
		add_filter( 'elementor/frontend/column/should_render', array( $this, 'topppa_should_render' ), 10, 2 );
		add_filter( 'elementor/frontend/section/should_render', array( $this, 'topppa_should_render' ), 10, 2 );
		add_filter( 'elementor/frontend/container/should_render', array( $this, 'topppa_should_render' ), 10, 2 );
	}

	public function topppa_add_repeater_compare_controls( $repeater ) {

		foreach ( static::$conditions_classes as $condition_class_name => $condition_obj ) {

			$control_id = 'topppa_condition_' . $condition_class_name;

			$repeater->add_control(
				$control_id,
				$condition_obj->topppa_control_options()
			);
		}
	}

	public function topppa_should_render( $render, $element ) {

		$settings = $element->get_settings_for_display();

		if ( 'yes' === $element->get_settings_for_display('topppa_conditional_display_switcher') ) {

			$element_id      = $element->get_id();
			$conditions_list = $settings['topppa_condition_repeater'];
			$action          = $settings['topppa_display_action'];

			$this->topppa_condition_results( $settings, $element_id, $conditions_list );

			return $this->topppa_check_visiblity( $element_id, $settings['topppa_display_when'], $action );

		}

		return $render;
	}

	protected function topppa_condition_results( $settings, $element_id, $lists = array() ) {

		if ( ! $lists ) {
			return;
		}

		foreach ( $lists as $key => $list ) {

			if ( ! in_array( $list['topppa_condition_key'], self::$conditions_keys, true ) ) {
				continue;
			}

			$class    = static::$conditions_classes[ $list['topppa_condition_key'] ];
			$operator = $list['topppa_condition_operator'];
			$item_key = 'topppa_condition_' . $list['topppa_condition_key'];
			$value    = isset( $list[ $item_key ] ) ? $list[ $item_key ] : '';

			$compare_val = isset( $list[ 'topppa_condition_val' . $list['topppa_condition_key'] ] ) ? $list[ 'topppa_condition_val' . $list['topppa_condition_key'] ] : '';

			$id        = $item_key . '_' . $list['_id'];

			$this->conditions_results_holder[ $element_id ][ $id ] = $class->topppa_compare_value( $settings, $operator, $value, $compare_val );
		}
	}

	public function topppa_check_visiblity( $element_id, $relation, $action ) {
		$result = true;

		if ( ! array_key_exists( $element_id, $this->conditions_results_holder ) ) {
			return;
		}

		if ( 'all' === $relation ) {

			$result = in_array( false, $this->conditions_results_holder[ $element_id ], true ) ? false : true;
		} else {

			$result = in_array( true, $this->conditions_results_holder[ $element_id ], true ) ? true : false;
		}

		if ( ( 'show' === $action && $result ) || ( 'hide' === $action && false === $result ) ) {
			$render = true;
		} elseif ( ( 'show' === $action && false === $result ) || ( 'hide' === $action && $result ) ) {

			$render = false;
		}

		return $render;
	}
}