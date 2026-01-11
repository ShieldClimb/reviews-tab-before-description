<?php

/**
 * Plugin Name: ShieldClimb – Move Reviews Tab Before Description for WooCommerce
 * Plugin URI: https://shieldclimb.com/free-woocommerce-plugins/reviews-tab-before-description/
 * Description: Move Reviews Tab Before Description for WooCommerce to boost trust, increase conversions, and get a Shopify-like product page.
 * Version: 1.0.3
 * Requires Plugins: woocommerce
 * Requires at least: 5.8
 * Tested up to: 6.9
 * WC requires at least: 5.8
 * WC tested up to: 10.4.3
 * Requires PHP: 7.2
 * Author: shieldclimb.com
 * Author URI: https://shieldclimb.com/
 * License: GPLv2 or later
 * License URI: https://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

add_filter( 'woocommerce_product_tabs', 'shieldclimb_reviews_tab_before_description', 1000 );
 
function shieldclimb_reviews_tab_before_description( $tabs ) {
      global $product, $post;
 
      $new_tabs = array();
 
      if ( comments_open() ) {
            $new_tabs['reviews'] = $tabs['reviews'];
            unset( $tabs['reviews'] );
 
            if ( $post->post_content ) {
                  $new_tabs['description'] = $tabs['description'];
                  unset( $tabs['description'] );
            }
 
            if ( $product && ( $product->has_attributes() || apply_filters( 'shieldclimb_product_enable_dimensions_display', $product->has_weight() || $product->has_dimensions() ) ) ) {
                  $new_tabs['additional_information'] = $tabs['additional_information'];
                  unset( $tabs['additional_information'] );
            }
 
            $tabs = array_merge( $new_tabs, $tabs );
      }
 
      return $tabs;
}

?>