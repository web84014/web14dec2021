<?php

/*
 * Maps
 */
function ubermenu_google_maps( $atts ){

	//Enqueue the API
	// wp_enqueue_script( 'google-maps' );
	ubermenu_enqueue_script( 'google-maps' );

	extract(shortcode_atts(array(
		'lat'		=>	0,
		'lng'		=>	0,
		'address'	=>	'',
		'zoom' 		=> 	15,
		'title'		=>	'',
		'width'		=>	'100%',
		'height'	=>	'200px'
	), $atts));

	$html = '
	<div class="ubermenu-map-canvas" data-lat="'.$lat.'" data-lng="'.$lng.'" ';
	if( !empty( $address ) ) $html.= 'data-address="'.$address.'" ';
	$html.= 'data-zoom="'.$zoom.'" ';
	if( !empty( $title ) ) $html.= 'data-maptitle="'.$title.'" ';
	$html.=	'style="height:'.$height.'; width:'.$width.'"';
	$html.= '></div>';

	return $html;
}
add_shortcode( 'ubermenu-map' , 'ubermenu_google_maps' );
