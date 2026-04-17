<?php
/**
 * @package Topper Pack
 * @since 1.0.0
 */
namespace TopperPack\Traits;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

trait Singleton {
    private static $instance;
    public static function instance() {
        if (!self::$instance) {
            self::$instance = new self();
        }
        return self::$instance;
    }
}
