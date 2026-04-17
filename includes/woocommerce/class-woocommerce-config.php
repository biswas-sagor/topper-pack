<?php
/**
 * WooCommerce Configuration
 *
 * Handles WooCommerce template overrides and customizations.
 *
 * @package TopperPack
 * @version 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

class Topppa_WooCommerce_Config {

    /**
     * Constructor
     */
    public function __construct() {
        add_action( 'init', [ $this, 'init' ] );
    }

    /**
     * Initialize WooCommerce configurations
     */
    public function init() {
        if ( ! class_exists( 'WooCommerce' ) ) {
            return;
        }

        // Override WooCommerce templates
        add_filter( 'woocommerce_locate_template', [ $this, 'locate_template' ], 10, 3 );
    }

    /**
     * Locate custom WooCommerce templates
     *
     * @param string $template
     * @param string $template_name
     * @param string $template_path
     * @return string
     */
    public function locate_template( $template, $template_name, $template_path ) {
        // Only override mini-cart template
        if ( 'cart/mini-cart.php' === $template_name ) {
            $plugin_template = TOPPPA_PATH . 'includes/woocommerce/templates/cart/mini-cart.php';
            
            if ( file_exists( $plugin_template ) ) {
                return $plugin_template;
            }
        }

        return $template;
    }
}

// Initialize the class
new Topppa_WooCommerce_Config();
