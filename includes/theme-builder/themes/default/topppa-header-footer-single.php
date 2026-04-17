<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
use TopperPack\Includes\Theme_Builder\TOPPPA_Theme_Builder;


@get_header();

TOPPPA_Theme_Builder::get_single_content();

@get_footer();

