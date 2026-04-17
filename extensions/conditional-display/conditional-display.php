<?php
/**
 * Conditional Display Extension
 *
 * @package Topper Pack
 * @since 1.0.0
 */

namespace TopperPack\Extensions;

use TopperPack\Extensions\TOPPPA_Conditional_Display_Handler;

use Elementor\Repeater;
use Elementor\Controls_Manager;

require_once TOPPPA_EXTENSIONS_PATH . 'conditional-display/handler.php';

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class TOPPPA_Conditional_Display {
	public function __construct() {
		add_action( 'elementor/element/section/section_advanced/after_section_end', array( $this, 'register_controls' ), 10 );
		add_action( 'elementor/element/column/section_advanced/after_section_end', array( $this, 'register_controls' ), 10 );
		add_action( 'elementor/element/common/_section_style/after_section_end', array( $this, 'register_controls' ), 10 );
        add_action( 'elementor/element/container/section_layout/after_section_end', array( $this, 'register_controls' ), 10 );
	}

	public function register_controls( $element ) {

		$element->start_controls_section(
			'section_topppa_conditional_display',
			array(
				'tab'   => Controls_Manager::TAB_ADVANCED,
				'label' => '<span class="topppa-extension-badge"></span>' . __('Conditional Display', 'topper-pack'),
			)
		);

		$controls_obj = new TOPPPA_Conditional_Display_Handler();

		$options = $controls_obj::$conditions;

		$options = apply_filters( 'topppa_conditional_display', $options );

		$element->add_control(
			'topppa_conditional_display_switcher',
			array(
				'label'              => __( 'Enable Conditional Display', 'topper-pack' ),
				'type'               => Controls_Manager::SWITCHER,
				'return_value'       => 'yes',
				'render_type'        => 'template',
				'prefix_class'       => 'topppa-conditional-display-',
				'frontend_available' => true,
			)
		);

		$element->add_control(
			'topppa_display_action',
			array(
				'label'     => __( 'Action', 'topper-pack' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'show',
				'options'   => array(
					'show' => __( 'Show Element', 'topper-pack' ),
					'hide' => __( 'Hide Element', 'topper-pack' ),
				),
				'condition' => array(
					'topppa_conditional_display_switcher' => 'yes',
				),
			)
		);

		$element->add_control(
			'topppa_display_when',
			array(
				'label'     => __( 'Display When', 'topper-pack' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'any',
				'options'   => array(
					'all' => __( 'All Conditions Are Met', 'topper-pack' ),
					'any' => __( 'Any Condition is Met', 'topper-pack' ),
				),
				'condition' => array(
					'topppa_conditional_display_switcher' => 'yes',
				),
			)
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'topppa_condition_key',
			array(
				'label'       => __( 'Type', 'topper-pack' ),
				'type'        => Controls_Manager::SELECT,
				'groups'      => $options,
				'default'     => 'browser',
				'label_block' => true,
			)
		);

		$repeater->add_control(
			'topppa_condition_operator',
			array(
				'type'        => Controls_Manager::SELECT,
				'default'     => 'is',
				'label_block' => true,
				'options'     => array(
					'is'  => __( 'Is', 'topper-pack' ),
					'not' => __( 'Is Not', 'topper-pack' ),
				),
			)
		);

		$controls_obj->topppa_add_repeater_compare_controls( $repeater );

		$should_apply = apply_filters( 'topppa_conditional_display_values', true );

		$values = $repeater->get_controls();

		$element->add_control(
			'topppa_condition_repeater',
			array(
				'label'         => __( 'Conditions', 'topper-pack' ),
				'type'          => Controls_Manager::REPEATER,
				'label_block'   => true,
				'fields'        => $values,
				'title_field'   => '<# print( topppa_condition_key.replace(/_/g, " ").split(" ").map((s) => s.charAt(0).toUpperCase() + s.substring(1)).join(" ")) #>',
				'prevent_empty' => false,
				'condition'     => array(
					'topppa_conditional_display_switcher' => 'yes',
				),
			)
		);

		$element->end_controls_section();
	}
}

new TOPPPA_Conditional_Display();
