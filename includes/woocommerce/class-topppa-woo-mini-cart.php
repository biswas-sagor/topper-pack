<?php
/**
 * Topppa Mini Cart Handler (OOP style)
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
if ( ! class_exists( 'Topppa_Mini_Cart' ) ) {

    class Topppa_Mini_Cart {

        public function __construct() {
            // Hook fragment refresh
            add_filter( 'woocommerce_add_to_cart_fragments', [ $this, 'cart_link_fragment' ] );
        }

        /**
         * Fragment callback for AJAX cart refresh.
         *
         * @param array $fragments
         * @return array
         */
        public function cart_link_fragment( $fragments ) {
            ob_start();
            $this->cart_link();
            $fragments['a.topppa-cart-contents'] = ob_get_clean();
            return $fragments;
        }

        /**
         * Render the cart link markup.
         * This should match the widget structure exactly.
         *
         * @return void
         */
        public function cart_link() {
            $item_count_text = is_object( WC()->cart ) ? WC()->cart->get_cart_contents_count() : '';
            
            // Get settings from widget or use defaults
            $settings = $this->get_widget_settings();
            
            // Generate button classes
            $button_classes = ['topppa-mini-cart-button'];
            if ($settings['select_content'] !== 'none') {
                $button_classes[] = 'topppa-cart-' . $settings['content_action_type'];
            }
            ?>
            <a class="<?php echo esc_attr(implode(' ', $button_classes)); ?> topppa-cart-contents" href="<?php echo esc_url(wc_get_cart_url()); ?>" title="<?php esc_attr_e('View your shopping cart', 'topper-pack'); ?>">
                <span class="topppa-mini-cart-icon">
                    <?php $this->render_icon($settings['cart_icon']); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
                    <span class="topppa-mini-cart-count"><?php echo esc_html($item_count_text); ?></span>
                </span>
                <?php if ($settings['select_type'] === 'text' && !empty($settings['cart_text'])): ?>
                    <span class="topppa-mini-cart-text"><?php echo esc_html($settings['cart_text']); ?></span>
                <?php elseif ($settings['select_type'] === 'price'): ?>
                    <span class="topppa-mini-cart-price"><?php echo wp_kses_post(WC()->cart->get_cart_total()); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span>
                <?php endif; ?>
            </a>
            <?php
        }

        /**
         * Render icon properly for both Elementor and fallback.
         *
         * @param array $icon_data
         * @return void
         */
        private function render_icon($icon_data) {
            // Handle different icon data formats
            if (is_array($icon_data)) {
                if (isset($icon_data['value']) && !empty($icon_data['value'])) {
                    // Elementor icon format
                    if (class_exists('\Elementor\Icons_Manager') && isset($icon_data['library'])) {
                        \Elementor\Icons_Manager::render_icon($icon_data, ['aria-hidden' => 'true']);
                    } else {
                        // Fallback to simple icon
                        echo '<i class="' . esc_attr($icon_data['value']) . '" aria-hidden="true"></i>';
                    }
                } else {
                    // Default cart icon
                    echo '<i class="fas fa-shopping-cart" aria-hidden="true"></i>';
                }
            } else {
                // String format
                echo '<i class="' . esc_attr($icon_data) . '" aria-hidden="true"></i>';
            }
        }

        /**
         * Get settings from widget or use defaults.
         *
         * @return array
         */
        private function get_widget_settings() {
            // Get settings from transient
            $transient_settings = get_transient('topppa_mini_cart_settings');
            
            // Use widget settings if available, otherwise use defaults
            if (!empty($transient_settings) && is_array($transient_settings)) {
                // Ensure we have all required settings
                return wp_parse_args($transient_settings, $this->get_default_settings());
            }
            
            // Try to get settings from global as fallback
            global $topppa_mini_cart_settings;
            if (!empty($topppa_mini_cart_settings) && is_array($topppa_mini_cart_settings)) {
                return wp_parse_args($topppa_mini_cart_settings, $this->get_default_settings());
            }
            
            // Fallback defaults
            return $this->get_default_settings();
        }

        /**
         * Get default settings.
         *
         * @return array
         */
        private function get_default_settings() {
            return [
                'cart_icon' => [
                    'value' => 'fas fa-shopping-cart',
                    'library' => 'fa-solid'
                ],
                'select_type' => 'text',
                'cart_text' => 'Cart',
                'select_content' => 'dropdown',
                'content_action_type' => 'hover'
            ];
        }
    }

    // Initialize the class
    new Topppa_Mini_Cart();
}
