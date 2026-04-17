<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
use TopperPack\Includes\Theme_Builder\TOPPPA_Theme_Builder;


@get_header();

TOPPPA_Theme_Builder::get_archive_content();

@get_footer();

