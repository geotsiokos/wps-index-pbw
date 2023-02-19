<?php
/**
 * Plugin Name: WPS Indexer Perfect Brands for WooCommerce
 * Plugin URI: https://www.itthinx.com
 * Description: Index brands from Perfect Brands WooCommerce in WPS plugin 
 * Version: 1.0.0
 * Author: itthinx
 * Author URI: https://www.netpad.gr
 */

if ( !defined( 'ABSPATH' ) ) {
	exit;
}

class WPS_Indexer_Pbw {

	public static function boot() {
		add_filter( 'woocommerce_product_search_indexer_filter_content', array( __CLASS__, 'woocommerce_product_search_indexer_filter_content' ), 10, 3 );
	}

	public static function woocommerce_product_search_indexer_filter_content( $content, $context, $post_id ) {
		if ( $context === 'post_content' ) {
			$term_values = '';
			$pwb_brands = wp_get_post_terms( $post_id, 'pwb-brand' );
			if ( is_array( $pwb_brands ) ) {
				foreach ( $pwb_brands as $brand ) {
					$term_values .= ' ' . $brand->name . ' ' . $brand->slug;
				}
			}

			if ( strlen( $term_values ) > 1 ) {
				$content .= ' ' . $term_values;
			}
		}
		return $content;
	}
}
WPS_Indexer_Pbw::boot();