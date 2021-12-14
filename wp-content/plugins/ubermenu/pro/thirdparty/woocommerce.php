<?php

//Cart info shortcode
add_shortcode( 'ubermenu_woocommerce_cart_info' , 'ubermenu_woocommerce_cart_info_shortcode' );
function ubermenu_woocommerce_cart_info_shortcode( $args , $data ){

  global $woocommerce;

  if( !function_exists( 'WC' ) ) return '<!-- WooCommerce not found -->';

  $atts = shortcode_atts( array(
		'count' => 'on',
    'count_label' => 'item',
    'count_label_plural' => 'items',
    'show_count_label' => 'on',
    'divider' => ' - ',
    'total' => 'on',
    'empty' => false,
	), $args, 'ubermenu_woocommerce_cart_info' );

  $info = '';
  $count = WC()->cart->get_cart_contents_count();

  if( $atts['empty'] !== false && $count === 0 ){
    $info =  $atts['empty'];
  }

  else{
    if( $atts['count'] === 'on' ){

      $label = '';
      if( $atts['show_count_label'] === 'on' ){
        $label = ' <span class="ubermenu-wc-cart-count-label">'. ($count === 1 ? $atts['count_label'] : $atts['count_label_plural']).'</span>';
      }
      $info.= '<span class="ubermenu-wc-cart-count"><span class="ubermenu-wc-cart-count-value">'.$count.'</span>'.$label.'</span>';
    }

    if( $atts['count'] === 'on' && $atts['total'] === 'on' ){
      $info .= '<span class="ubermenu-wc-cart-divider">'.$atts['divider'].'</span>';
    }

    if( $atts['total'] === 'on' ){
      $info .= '<span class="ubermenu-wc-cart-total">'.WC()->cart->get_cart_total().'</span>';
    }
  }

  $info = '<span class="ubermenu-wc-cart-info">'.$info.'</span>';

  return $info;
}

//Cart URL shortcode
add_shortcode( 'ubermenu_woocommerce_cart_url' , 'ubermenu_woocommerce_cart_url_shortcode' );
function ubermenu_woocommerce_cart_url_shortcode(){
  if( function_exists( 'wc_get_cart_url' ) ) return esc_url(wc_get_cart_url());
  return '';
}


//Cart fragments sent via AJAX when cart is updated
add_filter( 'woocommerce_add_to_cart_fragments', 'iconic_cart_count_fragments', 10, 1 );
function iconic_cart_count_fragments( $fragments ) {
  if( !function_exists( 'WC' ) ) return $fragments;

  $fragments['.ubermenu-wc-cart-count-value'] = '<span class="ubermenu-wc-cart-count-value">' . WC()->cart->get_cart_contents_count() . '</span>';
  $fragments['.ubermenu-wc-cart-total'] = '<span class="ubermenu-wc-cart-total">' . WC()->cart->get_cart_total() . '</span>';

  return $fragments;
}
