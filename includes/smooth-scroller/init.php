<?php
/**
 * @package Topper Pack
 * @since 1.0.0
 */

namespace TopperPack\Includes\Smooth_Scroller;

if (! defined('ABSPATH')) {
	exit;
}

class TOPPPA_Smooth_Scroller {

	public function __construct() {
		add_action('wp_enqueue_scripts', [$this, 'enqueue_scripts'], 99999);
	}

	public function enqueue_scripts() {
		wp_register_script('lenis', TOPPPA_INC_URL . 'smooth-scroller/assets/js/lenis.min.js', ['gsap'], TOPPPA_VER, true);
		wp_register_style('lenis', TOPPPA_INC_URL . 'smooth-scroller/assets/js/lenis.min.css', [], TOPPPA_VER);
		wp_register_script('topppa-smooth-scroller', TOPPPA_INC_URL . 'smooth-scroller/assets/js/topppa-smooth-scroller.js', ['jquery-core', 'lenis'], TOPPPA_VER, true);

		// Styles
		wp_enqueue_style('lenis');

		// Scripts
		wp_enqueue_script('lenis');
		wp_enqueue_script('topppa-smooth-scroller');
	}
}

new TOPPPA_Smooth_Scroller();
