<?php
/**
 * Global Component Loader Trait
 *
 * @package TopperPack
 */

namespace TopperPack\Trait_Loader;

defined('ABSPATH') || exit;

if ( ! trait_exists(__NAMESPACE__ . '\Global_Component_Loader') ) {
	if ( trait_exists('TopperPack_Pro\Traits\Pro_Global_Component') ) {
		 trait Global_Component_Loader {
			 use \TopperPack_Pro\Traits\Pro_Global_Component;
		 }
	} else {
		 trait Global_Component_Loader {
			 use \TopperPack\Traits\Global_Component;
		 }
	}
}
