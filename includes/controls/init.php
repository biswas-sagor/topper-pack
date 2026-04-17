<?php
/**
 * Controls
 * @package Topper Pack
 * @since 1.0.0
 */
namespace TopperPack\Includes\Controls;

defined( 'ABSPATH' ) || exit;

class Init {

    public function __construct() {

        // Includes necessary files
        $this->include_files();

        // Initializing control hooks
        add_action( 'elementor/controls/register', array( $this, 'topppa_image_choose' ), 11 );
    }

    private function include_files() {

        $files = array(
            'controls/control-manager.php',
            'controls/image-choose.php',
        );

        foreach ( $files as $file ) {
            $path = TOPPPA_INC_PATH . $file;

            if ( file_exists( $path ) ) {
                include_once $path;
            }
        }
    }

    public function topppa_image_choose( $controls_manager ) {
        $controls_manager->register( new \TopperPack\Includes\Controls\Topppa_Image_Choose() );
    }

}

// initiate elementor custom controls
new \TopperPack\Includes\Controls\Init();