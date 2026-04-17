<?php
/**
 * Wrapper Link Extension
 *
 * @package Topper Pack
 * @since 1.0.0
 */

namespace TopperPack\Extensions;

use Elementor\Controls_Manager;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

class TOPPPA_Wrapper_link_Extension {
    public function __construct() {
        add_action( 'elementor/element/container/section_layout/after_section_end', [ $this, 'topppa_register_wrapper_link_controls' ], 10, 1 );
		add_action( 'elementor/element/section/section_advanced/after_section_end', [ $this, 'topppa_register_wrapper_link_controls' ], 10, 1 );
		add_action( 'elementor/element/column/section_advanced/after_section_end', [ $this, 'topppa_register_wrapper_link_controls' ], 10, 1 );
		add_action( 'elementor/element/common/_section_style/after_section_end', [ $this, 'topppa_register_wrapper_link_controls' ], 10, 1 );

		add_action( 'elementor/frontend/before_render', [ $this, 'topppa_apply_wrapper_link_settings' ], 1 );

    }

    // Add Sticky Controls
    public function topppa_register_wrapper_link_controls($element) {
        $element->start_controls_section(
            'topppa_wrapper_link',
            [
                'label' => '<span class="topppa-extension-badge"></span>' . __('Wrapper Link', 'topper-pack'),
                'tab' => \Elementor\Controls_Manager::TAB_ADVANCED,
            ]
        );

        $element->add_control(
            'topppa_enable_wrapper_link',
            [
                'label' => __('Enable Wrapper Link', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
            ]
        );

        $element->add_control(
			'topppa_element_link',
			[
				'label'       => __( 'Link', 'topper-pack' ),
				'type'        => Controls_Manager::URL,
				'dynamic'     => [
					'active' => true,
				],
				'placeholder' => 'https://example.com',
                'condition' => [
                    'topppa_enable_wrapper_link' => 'yes',
                ],
			]
		);

        $element->end_controls_section();
    }

    public function topppa_apply_wrapper_link_settings( $element ) {
        $settings = $element->get_settings_for_display( 'topppa_element_link' );

        // Ensure URL is set and escape it properly
        if ( ! empty( $settings['url'] ) ) {
            $settings['url'] = esc_url( $settings['url'] );
            unset( $settings['custom_attributes'] );

            // Add data attribute and style to the wrapper element
            $element->add_render_attribute( '_wrapper', [
                'data-topppa-element-link' => json_encode( $settings ),
                'style' => 'cursor: pointer',
            ]);
        }
    }

}

// Initialize the extension
new TOPPPA_Wrapper_link_Extension();
