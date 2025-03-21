<?php
/**
 * WooCommerce - Product Images
 *
 * @package PA
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // If this file is called directly, abort.
}

global $post, $product, $woocommerce;

?>
<div class="premium-woo-qv-image-slider flexslider">

    <?php if( $product->is_on_sale() ) : ?>
        <div class="premium-qv-badge">
            <div class="corner">
                <span><?php echo esc_html( __('Sale!', 'premium-addons-for-elementor') ); ?></span>
            </div>
        </div>
    <?php endif; ?>
	<div class="premium-woo-qv-slides slides">
	<?php
	if ( has_post_thumbnail() ) {
		$attachment_ids = $product->get_gallery_image_ids();
		$props          = wc_get_product_attachment_props( get_post_thumbnail_id(), $post );
		$image          = get_the_post_thumbnail(
			$post->ID,
			'shop_single',
			array(
				'title' => $props['title'],
				'alt'   => $props['alt'],
			)
		);
		printf(
			'<li class="woocommerce-product-gallery__image">%s</li>',
			wp_kses_post( $image )
		);

		if ( $attachment_ids ) {
			$loop = 0;

			foreach ( $attachment_ids as $attachment_id ) {

				$props = wc_get_product_attachment_props( $attachment_id, $post );

				if ( ! $props['url'] ) {
					continue;
				}

				echo wp_kses_post(
					sprintf(
						'<li>%s</li>',
						wp_get_attachment_image( $attachment_id, 'shop_single', 0, $props )
					)
				);

				++$loop;
			}
		}
	} else {

		printf( '<li><img src="%s" alt="%s" /></li>', wp_kses_post( wc_placeholder_img_src() ), esc_html( __( 'Placeholder', 'premium-addons-for-elementor' ) ) );
	}
	?>
	</div>
</div>
