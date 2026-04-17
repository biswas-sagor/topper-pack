<?php
/**
 * Template Library
 *
 * @package Topper Pack
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
// templates
include( __DIR__ . '/templates/import.php');
include( __DIR__ . '/templates/init.php');
include( __DIR__ . '/templates/load.php');
include( __DIR__ . '/templates/api.php');

\TopperPack\Includes\Templates_Library\TOPPPA_Templates_Import::instance()->load();
\TopperPack\Includes\Templates_Library\TOPPPA_Templates_Load::instance()->load();
\TopperPack\Includes\Templates_Library\TOPPPA_Templates_Init::instance()->init();

if (!defined('TEMPLATE_LOGO_SRC')){
	define('TEMPLATE_LOGO_SRC', plugin_dir_url( __FILE__ ) . 'templates/assets/img/template_logo.png');
}