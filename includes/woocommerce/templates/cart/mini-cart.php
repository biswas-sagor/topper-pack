<?php
/**
 * Topppa Mini Cart Template
 *
 * Custom mini-cart template for Topppa Product Mini Cart Button Widget.
 * This template overrides the default WooCommerce mini cart to provide
 * better integration with the Topppa widget styling and functionality.
 *
 * @package TopperPack
 * @version 1.0.0
 */

defined( 'ABSPATH' ) || exit;

do_action( 'woocommerce_before_mini_cart' ); ?>

<?php if ( WC()->cart && ! WC()->cart->is_empty() ) : ?>

	<ul class="woocommerce-mini-cart cart_list product_list_widget topppa-mini-cart-list <?php echo esc_attr( $args['list_class'] ?? '' ); ?>">
		<?php
		do_action( 'woocommerce_before_mini_cart_contents' );

		foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
			$_product   = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
			$product_id = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );

			if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_widget_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
				$product_name      = apply_filters( 'woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key );
				$thumbnail         = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image( 'woocommerce_gallery_thumbnail' ), $cart_item, $cart_item_key );
				$product_price     = apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key );
				$product_permalink = apply_filters( 'woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '', $cart_item, $cart_item_key );
				?>
				<li class="woocommerce-mini-cart-item topppa-mini-cart-item <?php echo esc_attr( apply_filters( 'woocommerce_mini_cart_item_class', 'mini_cart_item', $cart_item, $cart_item_key ) ); ?>">
					<div class="topppa-mini-cart-item-content">
						<div class="topppa-mini-cart-item-image">
							<?php if ( empty( $product_permalink ) ) : ?>
								<?php echo $thumbnail; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
							<?php else : ?>
								<a href="<?php echo esc_url( $product_permalink ); ?>" class="topppa-mini-cart-item-link">
									<?php echo $thumbnail; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
								</a>
							<?php endif; ?>
						</div>
						
						<div class="topppa-mini-cart-item-details">
							<div class="topppa-mini-cart-item-name">
								<?php if ( empty( $product_permalink ) ) : ?>
									<?php echo wp_kses_post( $product_name ); ?>
								<?php else : ?>
									<a href="<?php echo esc_url( $product_permalink ); ?>" class="topppa-mini-cart-item-link">
										<?php echo wp_kses_post( $product_name ); ?>
									</a>
								<?php endif; ?>
							</div>
							
							<?php echo wc_get_formatted_cart_item_data( $cart_item ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
							
							<div class="topppa-mini-cart-item-meta">
								<span class="topppa-mini-cart-item-quantity">
									<?php echo apply_filters( 'woocommerce_widget_cart_item_quantity', sprintf( '%s &times; %s', $cart_item['quantity'], $product_price ), $cart_item, $cart_item_key ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
								</span>
							</div>
						</div>
						
						<div class="topppa-mini-cart-item-remove">
							<?php
							echo apply_filters( // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
								'woocommerce_cart_item_remove_link',
								sprintf(
									'<a role="button" href="%s" class="remove remove_from_cart_button topppa-mini-cart-remove" aria-label="%s" data-product_id="%s" data-cart_item_key="%s" data-product_sku="%s" data-success_message="%s" title="%s">
										<svg width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
											<path d="M9 3L3 9M3 3L9 9" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
										</svg>
									</a>',
									esc_url( wc_get_cart_remove_url( $cart_item_key ) ),
									/* translators: %s is the product name */
									esc_attr( sprintf( __( 'Remove %s from cart', 'topper-pack' ), wp_strip_all_tags( $product_name ) ) ),
									esc_attr( $product_id ),
									esc_attr( $cart_item_key ),
									esc_attr( $_product->get_sku() ),
									/* translators: %s is the product name */
									esc_attr( sprintf( __( '&ldquo;%s&rdquo; has been removed from your cart', 'topper-pack' ), wp_strip_all_tags( $product_name ) ) ),
									esc_attr__( 'Remove item', 'topper-pack' )
								),
								$cart_item_key
							);
							?>
						</div>
					</div>
				</li>
				<?php
			}
		}

		do_action( 'woocommerce_mini_cart_contents' );
		?>
	</ul>

	<div class="woocommerce-mini-cart__footer topppa-mini-cart-footer">
		<div class="woocommerce-mini-cart__total topppa-mini-cart-total">
			<?php
			/**
			 * Hook: woocommerce_widget_shopping_cart_total.
			 *
			 * @hooked woocommerce_widget_shopping_cart_subtotal - 10
			 */
			do_action( 'woocommerce_widget_shopping_cart_total' );
			?>
		</div>

		<?php do_action( 'woocommerce_widget_shopping_cart_before_buttons' ); ?>

		<div class="woocommerce-mini-cart__buttons topppa-mini-cart-buttons">
			<?php do_action( 'woocommerce_widget_shopping_cart_buttons' ); ?>
		</div>

		<?php do_action( 'woocommerce_widget_shopping_cart_after_buttons' ); ?>
	</div>

<?php else : ?>

	<div class="woocommerce-mini-cart__empty topppa-mini-cart-empty">
		<div class="topppa-mini-cart-empty-icon">
			<svg width="48" height="48" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
				<path d="M3 3H5L5.4 5M7 13H17L21 5H5.4M7 13L5.4 5M7 13L4.7 15.3C4.3 15.7 4.6 16.5 5.1 16.5H17M17 13V17C17 18.1 16.1 19 15 19H9C7.9 19 7 18.1 7 17V13M17 13H7" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
			</svg>
		</div>
		<p class="woocommerce-mini-cart__empty-message topppa-mini-cart-empty-message">
			<?php esc_html_e( 'Your cart is empty', 'topper-pack' ); ?>
		</p>
		<?php if ( wc_get_page_permalink( 'shop' ) ) : ?>
			<a href="<?php echo esc_url( wc_get_page_permalink( 'shop' ) ); ?>" class="topppa-mini-cart-empty-button">
				<?php esc_html_e( 'Continue Shopping', 'topper-pack' ); ?>
			</a>
		<?php endif; ?>
	</div>

<?php endif; ?>

<?php do_action( 'woocommerce_after_mini_cart' ); ?>
