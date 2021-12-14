<?php

function ubermenu_register_icons( $group , $iconmap ){
	_UBERMENU()->register_icons( $group, $iconmap );
}

function ubermenu_deregister_icons( $group ){
	_UBERMENU()->deregister_icons( $group );
}
function ubermenu_get_registered_icons(){
	return _UBERMENU()->get_registered_icons();
}
function ubermenu_get_icon_ops(){

	$icons = ubermenu_get_registered_icons();

	$icon_select = array( '' => array( 'title' => 'None' ) );

	foreach( $icons as $icon_group => $group ){

		$iconmap = $group['iconmap'];
		$prefix = isset( $group['class_prefix'] ) ? $group['class_prefix'] : '';

		foreach( $iconmap as $icon_class => $icon ){

			$icon_select[$prefix.$icon_class] = $icon; //$icon['title']; //ucfirst( str_replace( '-' , ' ' , str_replace( 'icon-' , '' , $icon_class ) ) );

		}

	}

	return $icon_select;
}

function ubermenu_register_default_icons(){

	// ubermenu_register_icons( 'font-awesome' , array(
	// 	'title' => 'Font Awesome',
	// 	'class_prefix' => 'fa ',
	// 	'iconmap' => ubermenu_get_icons()
	// ));

	ubermenu_register_icons( 'font-awesome-solid' , array(
		'title' => 'Font Awesome',
		'class_prefix' => 'fas ',
		'iconmap' => ubermenu_get_icons()
	));

	ubermenu_register_icons( 'font-awesome-regular' , array(
		'title' => 'Font Awesome Regular',
		'class_prefix' => 'far ',
		'iconmap' => ubermenu_get_icons_regular()
	));

	ubermenu_register_icons( 'font-awesome-brands' , array(
		'title' => 'Font Awesome Brands',
		'class_prefix' => 'fab ',
		'iconmap' => ubermenu_get_icons_brands()
	));

}

function ubermenu_get_icons_brands(){
	$icons = array(
		'fa-twitter-square'	=>	array(
			'title'	=>	'Twitter Square',
		),
		'fa-facebook-square'	=>	array(
			'title'	=>	'Facebook Square',
		),
		'fa-twitter'	=>	array(
			'title'	=>	'Twitter',
		),
		'fa-facebook'	=>	array(
			'title'	=>	'Facebook',
		),
		'fa-github'	=>	array(
			'title'	=>	'Github',
		),
		'fa-github-alt'	=>	array(
			'title'	=>	'Github Alt',
		),
		'fa-github-square'	=>	array(
			'title'	=>	'Github Square',
		),
		'fa-pinterest'	=>	array(
			'title'	=>	'Pinterest',
		),
		'fa-pinterest-square'	=>	array(
			'title'	=>	'Pinterest Square',
		),
		'fa-pinterest-p'	=>	array(
			'title'	=>	'Pinterest P',
		),
		'fa-google-plus-square'	=>	array(
			'title'	=>	'Google Plus Square',
		),
		'fa-google-plus'	=>	array(
			'title'	=>	'Google Plus',
		),
		'fa-google-plus-g'	=>	array(
			'title'	=>	'Google Plus',
		),

		'fa-linkedin'	=>	array(
			'title'	=>	'Linkedin',
		),
		'fa-linkedin-in'	=>	array(
			'title'	=>	'Linkedin',
		),


		'fa-youtube-square'	=>	array(
			'title'	=>	'Youtube Square',
		),
		'fa-youtube'	=>	array(
			'title'	=>	'Youtube',
		),
		'fa-stack-overflow'	=>	array(
			'title'	=>	'Stack Overflow',
		),
		'fa-instagram'	=>	array(
			'title'	=>	'Instagram',
		),
		'fa-flickr'	=>	array(
			'title'	=>	'Flickr',
		),
		'fa-bitbucket'	=>	array(
			'title'	=>	'Bitbucket',
		),
		'fa-bitbucket'	=>	array(
			'title'	=>	'Bitbucket',
		),
		'fa-tumblr'	=>	array(
			'title'	=>	'Tumblr',
		),
		'fa-tumblr-square'	=>	array(
			'title'	=>	'Tumblr Square',
		),
		'fa-dribbble'	=>	array(
			'title'	=>	'Dribbble',
		),
		'fa-skype'	=>	array(
			'title'	=>	'Skype',
		),
		'fa-foursquare'	=>	array(
			'title'	=>	'Foursquare',
		),
		'fa-gratipay'	=>	array(
			'title'	=>	'Gittip / Gratipay',
		),
		'fa-vimeo-square'	=>	array(
			'title'	=>	'Vimeo Square',
		),
		'fa-vimeo-v'	=>	array(
			'title'	=>	'Vimeo V',
		),

		'fa-linkedin'	=>	array(
			'title'	=>	'LinkedIn',
		),


		//Since 3.4
		'fa-500px' => array(
			'title' => '500px',
		),
		'fa-amazon'	=> array(
			'title'	=> 'Amazon',
		),
		'fa-behance'	=> array(
			'title'	=> 'Behance',
		),
		'fa-behance-square'	=> array(
			'title'	=> 'Behance Square',
		),
		'fa-codepen'	=> array(
			'title'	=> 'CodePen',
		),
		'fa-delicious'	=> array(
			'title'	=> 'Delicious',
		),
		'fa-dribbble-square'	=> array(
			'title'	=> 'Dribble Square',
		),
		'fa-etsy'	=> array(
			'title'	=> 'Etsy',
		),
		'fa-goodreads'	=> array(
			'title'	=> 'Good Reads',
		),
		'fa-kickstarter'	=>	array(
			'title'	=>	'Kickstarter',
		),
		'fa-kickstarter-k'	=>	array(
			'title'	=>	'Kickstarter',
		),
		'fa-lastfm'	=>	array(
			'title'	=>	'LastFM',
		),
		'fa-lastfm-square'	=>	array(
			'title'	=>	'LastFM Square',
		),
		'fa-medium'	=>	array(
			'title'	=>	'Medium',
		),
		'fa-medium-m'	=>	array(
			'title'	=>	'M',
		),
		'fa-slack'	=>	array(
			'title'	=>	'Slack',
		),
		'fa-slack-hash'	=>	array(
			'title'	=>	'Slack Hash',
		),
		'fa-snapchat-square'	=>	array(
			'title'	=>	'Snapchat',
		),
		'fa-soundcloud'	=>	array(
			'title'	=>	'Soundcloud',
		),
		'fa-spotify'	=>	array(
			'title'	=>	'Spotify',
		),
		'fa-whatsapp'	=>	array(
			'title'	=>	'WhatsApp',
		),
		'fa-wordpress'	=>	array(
			'title'	=>	'WordPress',
		),
		'fa-wordpress-simple'	=>	array(
			'title'	=>	'WordPress Simple',
		),



	);
	return $icons;
}

function ubermenu_get_icons(){

	$icons = array(
		'fa-bars'	=> 	array(
			'title'	=> 	'Bars',
		),
		'fa-music'	=>	array(
			'title'	=>	'Music',
		),
		'fa-search'	=>	array(
			'title'	=>	'Search',
		),
		'fa-cog'	=>	array(
			'title'	=>	'Gear / Cog',
		),


		'fa-film'	=>	array(
			'title'	=>	'Film',
		),
		'fa-home'	=>	array(
			'title'	=>	'Home',
		),
		'fa-download'	=>	array(
			'title'	=>	'Download',
		),

		'fa-lock'	=>	array(
			'title'	=>	'Lock',
		),

		'fa-headphones'	=>	array(
			'title'	=>	'Headphones',
		),

		'fa-book'	=>	array(
			'title'	=>	'Book',
		),

		'fa-camera'	=>	array(
			'title'	=>	'Camera',
		),

		'fa-video'	=>	array(
			'title'	=>	'Video Camera',
		),

		'fa-pencil-alt'	=>	array(
			'title'	=>	'Pencil (Alt)',
		),
		'fa-map-marker-alt'	=>	array(
			'title'	=>	'Map Marker (Alt)',
		),

		'fa-desktop'	=>	array(
			'title'	=>	'Desktop',
		),
		'fa-laptop'	=>	array(
			'title'	=>	'Laptop',
		),
		'fa-tablet-alt'	=>	array(
			'title'	=>	'Tablet (Alt)',
		),
		'fa-mobile-alt'	=>	array(
			'title'	=>	'Mobile (Alt)',
		),


		'fa-shopping-cart'	=>	array(
			'title'	=>	'Shopping Cart',
		),

		'fa-sign-out-alt'	=>	array(
			'title'	=>	'Sign Out (Alt)',
		),

		'fa-sign-in-alt'	=>	array(
			'title'	=>	'Sign In Alt',
		),
		'fa-phone'	=>	array(
			'title'	=>	'Phone',
		),
		'fa-phone-square'	=>	array(
			'title'	=>	'Phone Square',
		),



		'fa-rss'	=> array(
			'title'	=> 'RSS',
		),

		'fa-envelope'	=>	array(
			'title'	=>	'Envelope',
		),
		'fa-user'	=>	array(
			'title'	=>	'User',
		),
		'fa-bookmark'	=>	array(
			'title'	=>	'Bookmark',
		),
		'fa-image'	=>	array(
			'title'	=>	'Picture / Image',
		),
		'fa-calendar-alt'	=>	array(
			'title'	=>	'Calendar (Alt)',
		),

		'fa-angle-down' => array(
			'title' => 'Angle Down',
		),
		'fa-angle-left' => array(
			'title' => 'Angle Left',
		),
		'fa-angle-right' => array(
			'title' => 'Angle Right',
		),
		'fa-angle-up' => array(
			'title' => 'Angle Up',
		),

		'fa-bicycle' => array(
			'title' => 'Bicycle',
		),
		'fa-bus' => array(
			'title' => 'Bus',
		),
		'fa-car' => array(
			'title' => 'Car',
		),
		'fa-motorcycle' => array(
			'title' => 'Motorcycle',
		),
		'fa-plane' => array(
			'title' => 'Plane',
		),
		'fa-truck' => array(
			'title' => 'Truck',
		),


		'fa-bomb' => array(
			'title' => 'Bomb',
		),
		'fa-briefcase' => array(
			'title' => 'Briefcase',
		),


		'fa-check' => array(
			'title' => 'Check',
		),
		'fa-cloud' => array(
			'title' => 'Cloud',
		),
		'fa-cloud-download-alt' => array(
			'title' => 'Cloud Download',
		),
		'fa-coffee' => array(
			'title' => 'Coffee',
		),
		'fa-copyright' => array(
			'title' => 'Copyright',
		),
		'fa-credit-card' => array(
			'title' => 'Credit Card',
		),
		'fa-exclamation-triangle' => array(
			'title' => 'Exclamation Triangle Warning',
		),
		'fa-file' => array(
			'title' => 'File',
		),
		'fa-heart' => array(
			'title' => 'Heart',
		),

		'fa-star' => array(
			'title' => 'Star',
		),


	);

	return $icons;
}

/*
 * Original FA4 icons that were included, now in FA5 they are in the 'far' set
 */
function ubermenu_get_icons_regular(){

	// $is = ubermenu_get_icons();
	// foreach( $is as $name => $data ){
	// 	$name = substr( $name , 3 );
	// 	$prefix = ubermenu_fa5free_prefix_map( $name );
	// 	//echo '<br/>'.$prefix;
	// 	if( $prefix != 'fas' ) echo '<br/>'.$name;
	// }

	$icons = array(
		'fa-envelope'	=>	array(
			'title'	=>	'Envelope',
		),
		'fa-user'	=>	array(
			'title'	=>	'User',
		),
		'fa-bookmark'	=>	array(
			'title'	=>	'Bookmark',
		),
		'fa-image'	=>	array(
			'title'	=>	'Picture / Image',
		),
		'fa-calendar-alt'	=>	array(
			'title'	=>	'Calendar (Alt)',
		),
	);

	return $icons;
}





function ubermenu_get_meta_value_by_key( $meta_key, $limit = 1 ){
    global $wpdb;
    if (1 == $limit)
        return $value = $wpdb->get_var( $wpdb->prepare("SELECT meta_value, post_id FROM $wpdb->postmeta WHERE meta_key = %s LIMIT 1" , $meta_key) );
    else
        return $value = $wpdb->get_results( $wpdb->prepare("SELECT meta_value, post_id FROM $wpdb->postmeta WHERE meta_key = %s LIMIT %d" , $meta_key,$limit) );
}



/*
 * This function maps Font Awesome 4 icons to their Font Awesome 5 counterparts
 *   input: 'fa fa-address-book-o'
 *   output: 'far fa-address-book', or false if no change needed
 *
 * Function can be used as a hotfix conversion if needed
 */
function ubermenu_fa5_convert( $fa4icon_class , $return_unchanged_icon_class = false ){

	if( ubermenu_op( 'convert_fa4_to_fa5' , 'general' ) == 'off' ){
		if( $return_unchanged_icon_class ) return $fa4icon_class;
		else return false;
	}

  $icon_name = substr( $fa4icon_class , 6 );

  $icon_name_conversion = array(
    'address-book-o' => array(
  				  'fa5_name'	=> 'address-book',
  				  'fa5_prefix'	=> 'far' ),
    'address-card-o' => array(
    				'fa5_name'	=> 'address-card',
    				'fa5_prefix'	=> 'far' ),
    'area-chart' => array(
    				'fa5_name'	=> 'chart-area',
    				'fa5_prefix'	=> 'fas' ),
    'arrow-circle-o-down' => array(
    				'fa5_name'	=> 'arrow-alt-circle-down',
    				'fa5_prefix'	=> 'far' ),
    'arrow-circle-o-left' => array(
    				'fa5_name'	=> 'arrow-alt-circle-left',
    				'fa5_prefix'	=> 'far' ),
    'arrow-circle-o-right' => array(
    				'fa5_name'	=> 'arrow-alt-circle-right',
    				'fa5_prefix'	=> 'far' ),
    'arrow-circle-o-up' => array(
    				'fa5_name'	=> 'arrow-alt-circle-up',
    				'fa5_prefix'	=> 'far' ),
    'arrows-alt' => array(
    				'fa5_name'	=> 'expand-arrows-alt',
    				'fa5_prefix'	=> 'fas' ),
    'arrows-h' => array(
    				'fa5_name'	=> 'arrows-alt-h',
    				'fa5_prefix'	=> 'fas' ),
    'arrows-v' => array(
    				'fa5_name'	=> 'arrows-alt-v',
    				'fa5_prefix'	=> 'fas' ),
    'arrows' => array(
    				'fa5_name'	=> 'arrows-alt',
    				'fa5_prefix'	=> 'fas' ),
    'asl-interpreting' => array(
    				'fa5_name'	=> 'american-sign-language-interpreting',
    				'fa5_prefix'	=> 'fas' ),
    'automobile' => array(
    				'fa5_name'	=> 'car',
    				'fa5_prefix'	=> 'fas' ),
    'bank' => array(
    				'fa5_name'	=> 'university',
    				'fa5_prefix'	=> 'fas' ),
    'bar-chart-o' => array(
    				'fa5_name'	=> 'chart-bar',
    				'fa5_prefix'	=> 'far' ),
    'bar-chart' => array(
    				'fa5_name'	=> 'chart-bar',
    				'fa5_prefix'	=> 'far' ),
    'bathtub' => array(
    				'fa5_name'	=> 'bath',
    				'fa5_prefix'	=> 'fas' ),
    'battery-0' => array(
    				'fa5_name'	=> 'battery-empty',
    				'fa5_prefix'	=> 'fas' ),
    'battery-1' => array(
    				'fa5_name'	=> 'battery-quarter',
    				'fa5_prefix'	=> 'fas' ),
    'battery-2' => array(
    				'fa5_name'	=> 'battery-half',
    				'fa5_prefix'	=> 'fas' ),
    'battery-3' => array(
    				'fa5_name'	=> 'battery-three-quarters',
    				'fa5_prefix'	=> 'fas' ),
    'battery-4' => array(
    				'fa5_name'	=> 'battery-full',
    				'fa5_prefix'	=> 'fas' ),
    'battery' => array(
    				'fa5_name'	=> 'battery-full',
    				'fa5_prefix'	=> 'fas' ),
    'bell-o' => array(
    				'fa5_name'	=> 'bell',
    				'fa5_prefix'	=> 'far' ),
    'bell-slash-o' => array(
    				'fa5_name'	=> 'bell-slash',
    				'fa5_prefix'	=> 'far' ),
    'bitbucket-square' => array(
    				'fa5_name'	=> 'bitbucket',
    				'fa5_prefix'	=> 'fab' ),
    'bitcoin' => array(
    				'fa5_name'	=> 'btc',
    				'fa5_prefix'	=> 'fab' ),
    'bookmark-o' => array(
    				'fa5_name'	=> 'bookmark',
    				'fa5_prefix'	=> 'far' ),
    'building-o' => array(
    				'fa5_name'	=> 'building',
    				'fa5_prefix'	=> 'far' ),
    'cab' => array(
    				'fa5_name'	=> 'taxi',
    				'fa5_prefix'	=> 'fas' ),
    'calendar-check-o' => array(
    				'fa5_name'	=> 'calendar-check',
    				'fa5_prefix'	=> 'far' ),
    'calendar-minus-o' => array(
    				'fa5_name'	=> 'calendar-minus',
    				'fa5_prefix'	=> 'far' ),
    'calendar-o' => array(
    				'fa5_name'	=> 'calendar',
    				'fa5_prefix'	=> 'far' ),
    'calendar-plus-o' => array(
    				'fa5_name'	=> 'calendar-plus',
    				'fa5_prefix'	=> 'far' ),
    'calendar-times-o' => array(
    				'fa5_name'	=> 'calendar-times',
    				'fa5_prefix'	=> 'far' ),
    'calendar' => array(
    				'fa5_name'	=> 'calendar-alt',
    				'fa5_prefix'	=> 'fas' ),
    'caret-square-o-down' => array(
    				'fa5_name'	=> 'caret-square-down',
    				'fa5_prefix'	=> 'far' ),
    'caret-square-o-left' => array(
    				'fa5_name'	=> 'caret-square-left',
    				'fa5_prefix'	=> 'far' ),
    'caret-square-o-right' => array(
    				'fa5_name'	=> 'caret-square-right',
    				'fa5_prefix'	=> 'far' ),
    'caret-square-o-up' => array(
    				'fa5_name'	=> 'caret-square-up',
    				'fa5_prefix'	=> 'far' ),
    'cc' => array(
    				'fa5_name'	=> 'closed-captioning',
    				'fa5_prefix'	=> 'far' ),
    'chain-broken' => array(
    				'fa5_name'	=> 'unlink',
    				'fa5_prefix'	=> 'fas' ),
    'chain' => array(
    				'fa5_name'	=> 'link',
    				'fa5_prefix'	=> 'fas' ),
    'check-circle-o' => array(
    				'fa5_name'	=> 'check-circle',
    				'fa5_prefix'	=> 'far' ),
    'check-square-o' => array(
    				'fa5_name'	=> 'check-square',
    				'fa5_prefix'	=> 'far' ),
    'circle-o-notch' => array(
    				'fa5_name'	=> 'circle-notch',
    				'fa5_prefix'	=> 'fas' ),
    'circle-o' => array(
    				'fa5_name'	=> 'circle',
    				'fa5_prefix'	=> 'far' ),
    'circle-thin' => array(
    				'fa5_name'	=> 'circle',
    				'fa5_prefix'	=> 'far' ),
    'clock-o' => array(
    				'fa5_name'	=> 'clock',
    				'fa5_prefix'	=> 'far' ),
    'close' => array(
    				'fa5_name'	=> 'times',
    				'fa5_prefix'	=> 'fas' ),
    'cloud-download' => array(
    				'fa5_name'	=> 'cloud-download-alt',
    				'fa5_prefix'	=> 'fas' ),
    'cloud-upload' => array(
    				'fa5_name'	=> 'cloud-upload-alt',
    				'fa5_prefix'	=> 'fas' ),
    'cny' => array(
    				'fa5_name'	=> 'yen-sign',
    				'fa5_prefix'	=> 'fas' ),
    'code-fork' => array(
    				'fa5_name'	=> 'code-branch',
    				'fa5_prefix'	=> 'fas' ),
    'comment-o' => array(
    				'fa5_name'	=> 'comment',
    				'fa5_prefix'	=> 'far' ),
    'commenting-o' => array(
    				'fa5_name'	=> 'comment-alt',
    				'fa5_prefix'	=> 'far' ),
    'commenting' => array(
    				'fa5_name'	=> 'comment-alt',
    				'fa5_prefix'	=> 'fas' ),
    'comments-o' => array(
    				'fa5_name'	=> 'comments',
    				'fa5_prefix'	=> 'far' ),
    'credit-card-alt' => array(
    				'fa5_name'	=> 'credit-card',
    				'fa5_prefix'	=> 'fas' ),
    'cutlery' => array(
    				'fa5_name'	=> 'utensils',
    				'fa5_prefix'	=> 'fas' ),
    'dashboard' => array(
    				'fa5_name'	=> 'tachometer-alt',
    				'fa5_prefix'	=> 'fas' ),
    'deafness' => array(
    				'fa5_name'	=> 'deaf',
    				'fa5_prefix'	=> 'fas' ),
    'dedent' => array(
    				'fa5_name'	=> 'outdent',
    				'fa5_prefix'	=> 'fas' ),
    'diamond' => array(
    				'fa5_name'	=> 'gem',
    				'fa5_prefix'	=> 'far' ),
    'dollar' => array(
    				'fa5_name'	=> 'dollar-sign',
    				'fa5_prefix'	=> 'fas' ),
    'dot-circle-o' => array(
    				'fa5_name'	=> 'dot-circle',
    				'fa5_prefix'	=> 'far' ),
    'drivers-license-o' => array(
    				'fa5_name'	=> 'id-card',
    				'fa5_prefix'	=> 'far' ),
    'drivers-license' => array(
    				'fa5_name'	=> 'id-card',
    				'fa5_prefix'	=> 'fas' ),
    'eercast' => array(
    				'fa5_name'	=> 'sellcast',
    				'fa5_prefix'	=> 'fab' ),
    'envelope-o' => array(
    				'fa5_name'	=> 'envelope',
    				'fa5_prefix'	=> 'far' ),
    'envelope-open-o' => array(
    				'fa5_name'	=> 'envelope-open',
    				'fa5_prefix'	=> 'far' ),
    'eur' => array(
    				'fa5_name'	=> 'euro-sign',
    				'fa5_prefix'	=> 'fas' ),
    'euro' => array(
    				'fa5_name'	=> 'euro-sign',
    				'fa5_prefix'	=> 'fas' ),
    'exchange' => array(
    				'fa5_name'	=> 'exchange-alt',
    				'fa5_prefix'	=> 'fas' ),
    'external-link-square' => array(
    				'fa5_name'	=> 'external-link-square-alt',
    				'fa5_prefix'	=> 'fas' ),
    'external-link' => array(
    				'fa5_name'	=> 'external-link-alt',
    				'fa5_prefix'	=> 'fas' ),
    'eyedropper' => array(
    				'fa5_name'	=> 'eye-dropper',
    				'fa5_prefix'	=> 'fas' ),
    'fa' => array(
    				'fa5_name'	=> 'font-awesome',
    				'fa5_prefix'	=> 'fab' ),
    'facebook-f' => array(
    				'fa5_name'	=> 'facebook-f',
    				'fa5_prefix'	=> 'fab' ),
    'facebook-official' => array(
    				'fa5_name'	=> 'facebook',
    				'fa5_prefix'	=> 'fab' ),
    'facebook' => array(
    				'fa5_name'	=> 'facebook-f',
    				'fa5_prefix'	=> 'fab' ),
    'feed' => array(
    				'fa5_name'	=> 'rss',
    				'fa5_prefix'	=> 'fas' ),
    'file-archive-o' => array(
    				'fa5_name'	=> 'file-archive',
    				'fa5_prefix'	=> 'far' ),
    'file-audio-o' => array(
    				'fa5_name'	=> 'file-audio',
    				'fa5_prefix'	=> 'far' ),
    'file-code-o' => array(
    				'fa5_name'	=> 'file-code',
    				'fa5_prefix'	=> 'far' ),
    'file-excel-o' => array(
    				'fa5_name'	=> 'file-excel',
    				'fa5_prefix'	=> 'far' ),
    'file-image-o' => array(
    				'fa5_name'	=> 'file-image',
    				'fa5_prefix'	=> 'far' ),
    'file-movie-o' => array(
    				'fa5_name'	=> 'file-video',
    				'fa5_prefix'	=> 'far' ),
    'file-o' => array(
    				'fa5_name'	=> 'file',
    				'fa5_prefix'	=> 'far' ),
    'file-pdf-o' => array(
    				'fa5_name'	=> 'file-pdf',
    				'fa5_prefix'	=> 'far' ),
    'file-photo-o' => array(
    				'fa5_name'	=> 'file-image',
    				'fa5_prefix'	=> 'far' ),
    'file-picture-o' => array(
    				'fa5_name'	=> 'file-image',
    				'fa5_prefix'	=> 'far' ),
    'file-powerpoint-o' => array(
    				'fa5_name'	=> 'file-powerpoint',
    				'fa5_prefix'	=> 'far' ),
    'file-sound-o' => array(
    				'fa5_name'	=> 'file-audio',
    				'fa5_prefix'	=> 'far' ),
    'file-text-o' => array(
    				'fa5_name'	=> 'file-alt',
    				'fa5_prefix'	=> 'far' ),
    'file-text' => array(
    				'fa5_name'	=> 'file-alt',
    				'fa5_prefix'	=> 'fas' ),
    'file-video-o' => array(
    				'fa5_name'	=> 'file-video',
    				'fa5_prefix'	=> 'far' ),
    'file-word-o' => array(
    				'fa5_name'	=> 'file-word',
    				'fa5_prefix'	=> 'far' ),
    'file-zip-o' => array(
    				'fa5_name'	=> 'file-archive',
    				'fa5_prefix'	=> 'far' ),
    'files-o' => array(
    				'fa5_name'	=> 'copy',
    				'fa5_prefix'	=> 'far' ),
    'flag-o' => array(
    				'fa5_name'	=> 'flag',
    				'fa5_prefix'	=> 'far' ),
    'flash' => array(
    				'fa5_name'	=> 'bolt',
    				'fa5_prefix'	=> 'fas' ),
    'floppy-o' => array(
    				'fa5_name'	=> 'save',
    				'fa5_prefix'	=> 'far' ),
    'folder-o' => array(
    				'fa5_name'	=> 'folder',
    				'fa5_prefix'	=> 'far' ),
    'folder-open-o' => array(
    				'fa5_name'	=> 'folder-open',
    				'fa5_prefix'	=> 'far' ),
    'frown-o' => array(
    				'fa5_name'	=> 'frown',
    				'fa5_prefix'	=> 'far' ),
    'futbol-o' => array(
    				'fa5_name'	=> 'futbol',
    				'fa5_prefix'	=> 'far' ),
    'gbp' => array(
    				'fa5_name'	=> 'pound-sign',
    				'fa5_prefix'	=> 'fas' ),
    'ge' => array(
    				'fa5_name'	=> 'empire',
    				'fa5_prefix'	=> 'fab' ),
    'gear' => array(
    				'fa5_name'	=> 'cog',
    				'fa5_prefix'	=> 'fas' ),
    'gears' => array(
    				'fa5_name'	=> 'cogs',
    				'fa5_prefix'	=> 'fas' ),
    'gittip' => array(
    				'fa5_name'	=> 'gratipay',
    				'fa5_prefix'	=> 'fab' ),
    'glass' => array(
    				'fa5_name'	=> 'glass-martini',
    				'fa5_prefix'	=> 'fas' ),
    'google-plus-circle' => array(
    				'fa5_name'	=> 'google-plus',
    				'fa5_prefix'	=> 'fab' ),
    'google-plus-official' => array(
    				'fa5_name'	=> 'google-plus',
    				'fa5_prefix'	=> 'fab' ),
    'google-plus' => array(
    				'fa5_name'	=> 'google-plus-g',
    				'fa5_prefix'	=> 'fab' ),
    'group' => array(
    				'fa5_name'	=> 'users',
    				'fa5_prefix'	=> 'fas' ),
    'hand-grab-o' => array(
    				'fa5_name'	=> 'hand-rock',
    				'fa5_prefix'	=> 'far' ),
    'hand-lizard-o' => array(
    				'fa5_name'	=> 'hand-lizard',
    				'fa5_prefix'	=> 'far' ),
    'hand-o-down' => array(
    				'fa5_name'	=> 'hand-point-down',
    				'fa5_prefix'	=> 'far' ),
    'hand-o-left' => array(
    				'fa5_name'	=> 'hand-point-left',
    				'fa5_prefix'	=> 'far' ),
    'hand-o-right' => array(
    				'fa5_name'	=> 'hand-point-right',
    				'fa5_prefix'	=> 'far' ),
    'hand-o-up' => array(
    				'fa5_name'	=> 'hand-point-up',
    				'fa5_prefix'	=> 'far' ),
    'hand-paper-o' => array(
    				'fa5_name'	=> 'hand-paper',
    				'fa5_prefix'	=> 'far' ),
    'hand-peace-o' => array(
    				'fa5_name'	=> 'hand-peace',
    				'fa5_prefix'	=> 'far' ),
    'hand-pointer-o' => array(
    				'fa5_name'	=> 'hand-pointer',
    				'fa5_prefix'	=> 'far' ),
    'hand-rock-o' => array(
    				'fa5_name'	=> 'hand-rock',
    				'fa5_prefix'	=> 'far' ),
    'hand-scissors-o' => array(
    				'fa5_name'	=> 'hand-scissors',
    				'fa5_prefix'	=> 'far' ),
    'hand-spock-o' => array(
    				'fa5_name'	=> 'hand-spock',
    				'fa5_prefix'	=> 'far' ),
    'hand-stop-o' => array(
    				'fa5_name'	=> 'hand-paper',
    				'fa5_prefix'	=> 'far' ),
    'handshake-o' => array(
    				'fa5_name'	=> 'handshake',
    				'fa5_prefix'	=> 'far' ),
    'hard-of-hearing' => array(
    				'fa5_name'	=> 'deaf',
    				'fa5_prefix'	=> 'fas' ),
    'hdd-o' => array(
    				'fa5_name'	=> 'hdd',
    				'fa5_prefix'	=> 'far' ),
    'header' => array(
    				'fa5_name'	=> 'heading',
    				'fa5_prefix'	=> 'fas' ),
    'heart-o' => array(
    				'fa5_name'	=> 'heart',
    				'fa5_prefix'	=> 'far' ),
    'hospital-o' => array(
    				'fa5_name'	=> 'hospital',
    				'fa5_prefix'	=> 'far' ),
    'hotel' => array(
    				'fa5_name'	=> 'bed',
    				'fa5_prefix'	=> 'fas' ),
    'hourglass-1' => array(
    				'fa5_name'	=> 'hourglass-start',
    				'fa5_prefix'	=> 'fas' ),
    'hourglass-2' => array(
    				'fa5_name'	=> 'hourglass-half',
    				'fa5_prefix'	=> 'fas' ),
    'hourglass-3' => array(
    				'fa5_name'	=> 'hourglass-end',
    				'fa5_prefix'	=> 'fas' ),
    'hourglass-o' => array(
    				'fa5_name'	=> 'hourglass',
    				'fa5_prefix'	=> 'far' ),
    'id-card-o' => array(
    				'fa5_name'	=> 'id-card',
    				'fa5_prefix'	=> 'far' ),
    'ils' => array(
    				'fa5_name'	=> 'shekel-sign',
    				'fa5_prefix'	=> 'fas' ),
    'image' => array(
    				'fa5_name'	=> 'image',
    				'fa5_prefix'	=> 'far' ),
    'inr' => array(
    				'fa5_name'	=> 'rupee-sign',
    				'fa5_prefix'	=> 'fas' ),
    'institution' => array(
    				'fa5_name'	=> 'university',
    				'fa5_prefix'	=> 'fas' ),
    'intersex' => array(
    				'fa5_name'	=> 'transgender',
    				'fa5_prefix'	=> 'fas' ),
    'jpy' => array(
    				'fa5_name'	=> 'yen-sign',
    				'fa5_prefix'	=> 'fas' ),
    'keyboard-o' => array(
    				'fa5_name'	=> 'keyboard',
    				'fa5_prefix'	=> 'far' ),
    'krw' => array(
    				'fa5_name'	=> 'won-sign',
    				'fa5_prefix'	=> 'fas' ),
    'legal' => array(
    				'fa5_name'	=> 'gavel',
    				'fa5_prefix'	=> 'fas' ),
    'lemon-o' => array(
    				'fa5_name'	=> 'lemon',
    				'fa5_prefix'	=> 'far' ),
    'level-down' => array(
    				'fa5_name'	=> 'level-down-alt',
    				'fa5_prefix'	=> 'fas' ),
    'level-up' => array(
    				'fa5_name'	=> 'level-up-alt',
    				'fa5_prefix'	=> 'fas' ),
    'life-bouy' => array(
    				'fa5_name'	=> 'life-ring',
    				'fa5_prefix'	=> 'far' ),
    'life-buoy' => array(
    				'fa5_name'	=> 'life-ring',
    				'fa5_prefix'	=> 'far' ),
    'life-saver' => array(
    				'fa5_name'	=> 'life-ring',
    				'fa5_prefix'	=> 'far' ),
    'lightbulb-o' => array(
    				'fa5_name'	=> 'lightbulb',
    				'fa5_prefix'	=> 'far' ),
    'line-chart' => array(
    				'fa5_name'	=> 'chart-line',
    				'fa5_prefix'	=> 'fas' ),
    'linkedin-square' => array(
    				'fa5_name'	=> 'linkedin',
    				'fa5_prefix'	=> 'fab' ),
    'linkedin' => array(
    				'fa5_name'	=> 'linkedin-in',
    				'fa5_prefix'	=> 'fab' ),
    'long-arrow-down' => array(
    				'fa5_name'	=> 'long-arrow-alt-down',
    				'fa5_prefix'	=> 'fas' ),
    'long-arrow-left' => array(
    				'fa5_name'	=> 'long-arrow-alt-left',
    				'fa5_prefix'	=> 'fas' ),
    'long-arrow-right' => array(
    				'fa5_name'	=> 'long-arrow-alt-right',
    				'fa5_prefix'	=> 'fas' ),
    'long-arrow-up' => array(
    				'fa5_name'	=> 'long-arrow-alt-up',
    				'fa5_prefix'	=> 'fas' ),
    'mail-forward' => array(
    				'fa5_name'	=> 'share',
    				'fa5_prefix'	=> 'fas' ),
    'mail-reply-all' => array(
    				'fa5_name'	=> 'reply-all',
    				'fa5_prefix'	=> 'fas' ),
    'mail-reply' => array(
    				'fa5_name'	=> 'reply',
    				'fa5_prefix'	=> 'fas' ),
    'map-marker' => array(
    				'fa5_name'	=> 'map-marker-alt',
    				'fa5_prefix'	=> 'fas' ),
    'map-o' => array(
    				'fa5_name'	=> 'map',
    				'fa5_prefix'	=> 'far' ),
    'meanpath' => array(
    				'fa5_name'	=> 'font-awesome',
    				'fa5_prefix'	=> 'fab' ),
    'meh-o' => array(
    				'fa5_name'	=> 'meh',
    				'fa5_prefix'	=> 'far' ),
    'minus-square-o' => array(
    				'fa5_name'	=> 'minus-square',
    				'fa5_prefix'	=> 'far' ),
    'mobile-phone' => array(
    				'fa5_name'	=> 'mobile-alt',
    				'fa5_prefix'	=> 'fas' ),
    'mobile' => array(
    				'fa5_name'	=> 'mobile-alt',
    				'fa5_prefix'	=> 'fas' ),
    'money' => array(
    				'fa5_name'	=> 'money-bill-alt',
    				'fa5_prefix'	=> 'far' ),
    'moon-o' => array(
    				'fa5_name'	=> 'moon',
    				'fa5_prefix'	=> 'far' ),
    'mortar-board' => array(
    				'fa5_name'	=> 'graduation-cap',
    				'fa5_prefix'	=> 'fas' ),
    'navicon' => array(
    				'fa5_name'	=> 'bars',
    				'fa5_prefix'	=> 'fas' ),
    'newspaper-o' => array(
    				'fa5_name'	=> 'newspaper',
    				'fa5_prefix'	=> 'far' ),
    'paper-plane-o' => array(
    				'fa5_name'	=> 'paper-plane',
    				'fa5_prefix'	=> 'far' ),
    'paste' => array(
    				'fa5_name'	=> 'clipboard',
    				'fa5_prefix'	=> 'far' ),
    'pause-circle-o' => array(
    				'fa5_name'	=> 'pause-circle',
    				'fa5_prefix'	=> 'far' ),
    'pencil-square-o' => array(
    				'fa5_name'	=> 'edit',
    				'fa5_prefix'	=> 'far' ),
    'pencil-square' => array(
    				'fa5_name'	=> 'pen-square',
    				'fa5_prefix'	=> 'fas' ),
    'pencil' => array(
    				'fa5_name'	=> 'pencil-alt',
    				'fa5_prefix'	=> 'fas' ),
    'photo' => array(
    				'fa5_name'	=> 'image',
    				'fa5_prefix'	=> 'far' ),
    'picture-o' => array(
    				'fa5_name'	=> 'image',
    				'fa5_prefix'	=> 'far' ),
    'pie-chart' => array(
    				'fa5_name'	=> 'chart-pie',
    				'fa5_prefix'	=> 'fas' ),
    'play-circle-o' => array(
    				'fa5_name'	=> 'play-circle',
    				'fa5_prefix'	=> 'far' ),
    'plus-square-o' => array(
    				'fa5_name'	=> 'plus-square',
    				'fa5_prefix'	=> 'far' ),
    'question-circle-o' => array(
    				'fa5_name'	=> 'question-circle',
    				'fa5_prefix'	=> 'far' ),
    'ra' => array(
    				'fa5_name'	=> 'rebel',
    				'fa5_prefix'	=> 'fab' ),
    'refresh' => array(
    				'fa5_name'	=> 'sync',
    				'fa5_prefix'	=> 'fas' ),
    'remove' => array(
    				'fa5_name'	=> 'times',
    				'fa5_prefix'	=> 'fas' ),
    'reorder' => array(
    				'fa5_name'	=> 'bars',
    				'fa5_prefix'	=> 'fas' ),
    'repeat' => array(
    				'fa5_name'	=> 'redo',
    				'fa5_prefix'	=> 'fas' ),
    'resistance' => array(
    				'fa5_name'	=> 'rebel',
    				'fa5_prefix'	=> 'fab' ),
    'rmb' => array(
    				'fa5_name'	=> 'yen-sign',
    				'fa5_prefix'	=> 'fas' ),
    'rotate-left' => array(
    				'fa5_name'	=> 'undo',
    				'fa5_prefix'	=> 'fas' ),
    'rotate-right' => array(
    				'fa5_name'	=> 'redo',
    				'fa5_prefix'	=> 'fas' ),
    'rouble' => array(
    				'fa5_name'	=> 'ruble-sign',
    				'fa5_prefix'	=> 'fas' ),
    'rub' => array(
    				'fa5_name'	=> 'ruble-sign',
    				'fa5_prefix'	=> 'fas' ),
    'ruble' => array(
    				'fa5_name'	=> 'ruble-sign',
    				'fa5_prefix'	=> 'fas' ),
    'rupee' => array(
    				'fa5_name'	=> 'rupee-sign',
    				'fa5_prefix'	=> 'fas' ),
    's15' => array(
    				'fa5_name'	=> 'bath',
    				'fa5_prefix'	=> 'fas' ),
    'scissors' => array(
    				'fa5_name'	=> 'cut',
    				'fa5_prefix'	=> 'fas' ),
    'send-o' => array(
    				'fa5_name'	=> 'paper-plane',
    				'fa5_prefix'	=> 'far' ),
    'send' => array(
    				'fa5_name'	=> 'paper-plane',
    				'fa5_prefix'	=> 'fas' ),
    'share-square-o' => array(
    				'fa5_name'	=> 'share-square',
    				'fa5_prefix'	=> 'far' ),
    'shekel' => array(
    				'fa5_name'	=> 'shekel-sign',
    				'fa5_prefix'	=> 'fas' ),
    'sheqel' => array(
    				'fa5_name'	=> 'shekel-sign',
    				'fa5_prefix'	=> 'fas' ),
    'shield' => array(
    				'fa5_name'	=> 'shield-alt',
    				'fa5_prefix'	=> 'fas' ),
    'sign-in' => array(
    				'fa5_name'	=> 'sign-in-alt',
    				'fa5_prefix'	=> 'fas' ),
    'sign-out' => array(
    				'fa5_name'	=> 'sign-out-alt',
    				'fa5_prefix'	=> 'fas' ),
    'signing' => array(
    				'fa5_name'	=> 'sign-language',
    				'fa5_prefix'	=> 'fas' ),
    'sliders' => array(
    				'fa5_name'	=> 'sliders-h',
    				'fa5_prefix'	=> 'fas' ),
    'smile-o' => array(
    				'fa5_name'	=> 'smile',
    				'fa5_prefix'	=> 'far' ),
    'snowflake-o' => array(
    				'fa5_name'	=> 'snowflake',
    				'fa5_prefix'	=> 'far' ),
    'soccer-ball-o' => array(
    				'fa5_name'	=> 'futbol',
    				'fa5_prefix'	=> 'far' ),
    'sort-alpha-asc' => array(
    				'fa5_name'	=> 'sort-alpha-down',
    				'fa5_prefix'	=> 'fas' ),
    'sort-alpha-desc' => array(
    				'fa5_name'	=> 'sort-alpha-up',
    				'fa5_prefix'	=> 'fas' ),
    'sort-amount-asc' => array(
    				'fa5_name'	=> 'sort-amount-down',
    				'fa5_prefix'	=> 'fas' ),
    'sort-amount-desc' => array(
    				'fa5_name'	=> 'sort-amount-up',
    				'fa5_prefix'	=> 'fas' ),
    'sort-asc' => array(
    				'fa5_name'	=> 'sort-up',
    				'fa5_prefix'	=> 'fas' ),
    'sort-desc' => array(
    				'fa5_name'	=> 'sort-down',
    				'fa5_prefix'	=> 'fas' ),
    'sort-numeric-asc' => array(
    				'fa5_name'	=> 'sort-numeric-down',
    				'fa5_prefix'	=> 'fas' ),
    'sort-numeric-desc' => array(
    				'fa5_name'	=> 'sort-numeric-up',
    				'fa5_prefix'	=> 'fas' ),
    'spoon' => array(
    				'fa5_name'	=> 'utensil-spoon',
    				'fa5_prefix'	=> 'fas' ),
    'square-o' => array(
    				'fa5_name'	=> 'square',
    				'fa5_prefix'	=> 'far' ),
    'star-half-empty' => array(
    				'fa5_name'	=> 'star-half',
    				'fa5_prefix'	=> 'far' ),
    'star-half-full' => array(
    				'fa5_name'	=> 'star-half',
    				'fa5_prefix'	=> 'far' ),
    'star-half-o' => array(
    				'fa5_name'	=> 'star-half',
    				'fa5_prefix'	=> 'far' ),
    'star-o' => array(
    				'fa5_name'	=> 'star',
    				'fa5_prefix'	=> 'far' ),
    'sticky-note-o' => array(
    				'fa5_name'	=> 'sticky-note',
    				'fa5_prefix'	=> 'far' ),
    'stop-circle-o' => array(
    				'fa5_name'	=> 'stop-circle',
    				'fa5_prefix'	=> 'far' ),
    'sun-o' => array(
    				'fa5_name'	=> 'sun',
    				'fa5_prefix'	=> 'far' ),
    'support' => array(
    				'fa5_name'	=> 'life-ring',
    				'fa5_prefix'	=> 'far' ),
    'tablet' => array(
    				'fa5_name'	=> 'tablet-alt',
    				'fa5_prefix'	=> 'fas' ),
    'tachometer' => array(
    				'fa5_name'	=> 'tachometer-alt',
    				'fa5_prefix'	=> 'fas' ),
    'television' => array(
    				'fa5_name'	=> 'tv',
    				'fa5_prefix'	=> 'fas' ),
    'thermometer-0' => array(
    				'fa5_name'	=> 'thermometer-empty',
    				'fa5_prefix'	=> 'fas' ),
    'thermometer-1' => array(
    				'fa5_name'	=> 'thermometer-quarter',
    				'fa5_prefix'	=> 'fas' ),
    'thermometer-2' => array(
    				'fa5_name'	=> 'thermometer-half',
    				'fa5_prefix'	=> 'fas' ),
    'thermometer-3' => array(
    				'fa5_name'	=> 'thermometer-three-quarters',
    				'fa5_prefix'	=> 'fas' ),
    'thermometer-4' => array(
    				'fa5_name'	=> 'thermometer-full',
    				'fa5_prefix'	=> 'fas' ),
    'thermometer' => array(
    				'fa5_name'	=> 'thermometer-full',
    				'fa5_prefix'	=> 'fas' ),
    'thumb-tack' => array(
    				'fa5_name'	=> 'thumbtack',
    				'fa5_prefix'	=> 'fas' ),
    'thumbs-o-down' => array(
    				'fa5_name'	=> 'thumbs-down',
    				'fa5_prefix'	=> 'far' ),
    'thumbs-o-up' => array(
    				'fa5_name'	=> 'thumbs-up',
    				'fa5_prefix'	=> 'far' ),
    'ticket' => array(
    				'fa5_name'	=> 'ticket-alt',
    				'fa5_prefix'	=> 'fas' ),
    'times-circle-o' => array(
    				'fa5_name'	=> 'times-circle',
    				'fa5_prefix'	=> 'far' ),
    'times-rectangle-o' => array(
    				'fa5_name'	=> 'window-close',
    				'fa5_prefix'	=> 'far' ),
    'times-rectangle' => array(
    				'fa5_name'	=> 'window-close',
    				'fa5_prefix'	=> 'fas' ),
    'toggle-down' => array(
    				'fa5_name'	=> 'caret-square-down',
    				'fa5_prefix'	=> 'far' ),
    'toggle-left' => array(
    				'fa5_name'	=> 'caret-square-left',
    				'fa5_prefix'	=> 'far' ),
    'toggle-right' => array(
    				'fa5_name'	=> 'caret-square-right',
    				'fa5_prefix'	=> 'far' ),
    'toggle-up' => array(
    				'fa5_name'	=> 'caret-square-up',
    				'fa5_prefix'	=> 'far' ),
    'trash-o' => array(
    				'fa5_name'	=> 'trash-alt',
    				'fa5_prefix'	=> 'far' ),
    'trash' => array(
    				'fa5_name'	=> 'trash-alt',
    				'fa5_prefix'	=> 'fas' ),
    'try' => array(
    				'fa5_name'	=> 'lira-sign',
    				'fa5_prefix'	=> 'fas' ),
    'turkish-lira' => array(
    				'fa5_name'	=> 'lira-sign',
    				'fa5_prefix'	=> 'fas' ),
    'unsorted' => array(
    				'fa5_name'	=> 'sort',
    				'fa5_prefix'	=> 'fas' ),
    'usd' => array(
    				'fa5_name'	=> 'dollar-sign',
    				'fa5_prefix'	=> 'fas' ),
    'user-circle-o' => array(
    				'fa5_name'	=> 'user-circle',
    				'fa5_prefix'	=> 'far' ),
    'user-o' => array(
    				'fa5_name'	=> 'user',
    				'fa5_prefix'	=> 'far' ),
    'vcard-o' => array(
    				'fa5_name'	=> 'address-card',
    				'fa5_prefix'	=> 'far' ),
    'vcard' => array(
    				'fa5_name'	=> 'address-card',
    				'fa5_prefix'	=> 'fas' ),
    'video-camera' => array(
    				'fa5_name'	=> 'video',
    				'fa5_prefix'	=> 'fas' ),
    'vimeo' => array(
    				'fa5_name'	=> 'vimeo-v',
    				'fa5_prefix'	=> 'fab' ),
    'volume-control-phone' => array(
    				'fa5_name'	=> 'phone-volume',
    				'fa5_prefix'	=> 'fas' ),
    'warning' => array(
    				'fa5_name'	=> 'exclamation-triangle',
    				'fa5_prefix'	=> 'fas' ),
    'wechat' => array(
    				'fa5_name'	=> 'weixin',
    				'fa5_prefix'	=> 'fab' ),
    'wheelchair-alt' => array(
    				'fa5_name'	=> 'accessible-icon',
    				'fa5_prefix'	=> 'fab' ),
    'window-close-o' => array(
    				'fa5_name'	=> 'window-close',
    				'fa5_prefix'	=> 'far' ),
    'won' => array(
    				'fa5_name'	=> 'won-sign',
    				'fa5_prefix'	=> 'fas' ),
    'y-combinator-square' => array(
    				'fa5_name'	=> 'hacker-news',
    				'fa5_prefix'	=> 'fab' ),
    'yc-square' => array(
    				'fa5_name'	=> 'hacker-news',
    				'fa5_prefix'	=> 'fab' ),
    'yc' => array(
    				'fa5_name'	=> 'y-combinator',
    				'fa5_prefix'	=> 'fab' ),
    'yen' => array(
    				'fa5_name'	=> 'yen-sign',
    				'fa5_prefix'	=> 'fas' ),
    'youtube-play' => array(
    				'fa5_name'	=> 'youtube',
    				'fa5_prefix'	=> 'fab' ),
    'youtube-square' => array(
    				'fa5_name'	=> 'youtube',
    				'fa5_prefix'	=> 'fab' )
  );

  //First, does the name need to be converted?
  if( isset( $icon_name_conversion[$icon_name] ) ){
    return $icon_name_conversion[$icon_name]['fa5_prefix']. ' fa-'.$icon_name_conversion[$icon_name]['fa5_name'];
  }
  //If the name stays the same, we still need to update the prefix
  else{
    //replace 'fa' with 'fas' or 'fab' or 'far'
		$new_prefix = ubermenu_fa5free_prefix_map( $icon_name );
		if( $new_prefix ){
    	return $new_prefix . ' fa-'.$icon_name;
		}
  }

  if( $return_unchanged_icon_class ) return $fa4icon_class;

  return false;
}

function ubermenu_fa5free_prefix_map( $icon_name ){
  $map = array(
    '500px' => 'fab',
    'accessible-icon' => 'fab',
    'accusoft' => 'fab',
    'address-book' => 'fas',
    'address-book' => 'far',
    'address-card' => 'fas',
    'address-card' => 'far',
    'adjust' => 'fas',
    'adn' => 'fab',
    'adversal' => 'fab',
    'affiliatetheme' => 'fab',
    'algolia' => 'fab',
    'align-center' => 'fas',
    'align-justify' => 'fas',
    'align-left' => 'fas',
    'align-right' => 'fas',
    'amazon' => 'fab',
    'amazon-pay' => 'fab',
    'ambulance' => 'fas',
    'american-sign-language-interpreting' => 'fas',
    'amilia' => 'fab',
    'anchor' => 'fas',
    'android' => 'fab',
    'angellist' => 'fab',
    'angle-double-down' => 'fas',
    'angle-double-left' => 'fas',
    'angle-double-right' => 'fas',
    'angle-double-up' => 'fas',
    'angle-down' => 'fas',
    'angle-left' => 'fas',
    'angle-right' => 'fas',
    'angle-up' => 'fas',
    'angrycreative' => 'fab',
    'angular' => 'fab',
    'app-store' => 'fab',
    'app-store-ios' => 'fab',
    'apper' => 'fab',
    'apple' => 'fab',
    'apple-pay' => 'fab',
    'archive' => 'fas',
    'arrow-alt-circle-down' => 'fas',
    'arrow-alt-circle-down' => 'far',
    'arrow-alt-circle-left' => 'fas',
    'arrow-alt-circle-left' => 'far',
    'arrow-alt-circle-right' => 'fas',
    'arrow-alt-circle-right' => 'far',
    'arrow-alt-circle-up' => 'fas',
    'arrow-alt-circle-up' => 'far',
    'arrow-circle-down' => 'fas',
    'arrow-circle-left' => 'fas',
    'arrow-circle-right' => 'fas',
    'arrow-circle-up' => 'fas',
    'arrow-down' => 'fas',
    'arrow-left' => 'fas',
    'arrow-right' => 'fas',
    'arrow-up' => 'fas',
    'arrows-alt' => 'fas',
    'arrows-alt-h' => 'fas',
    'arrows-alt-v' => 'fas',
    'assistive-listening-systems' => 'fas',
    'asterisk' => 'fas',
    'asymmetrik' => 'fab',
    'at' => 'fas',
    'audible' => 'fab',
    'audio-description' => 'fas',
    'autoprefixer' => 'fab',
    'avianex' => 'fab',
    'aviato' => 'fab',
    'aws' => 'fab',
    'backward' => 'fas',
    'balance-scale' => 'fas',
    'ban' => 'fas',
    'bandcamp' => 'fab',
    'barcode' => 'fas',
    'bars' => 'fas',
    'baseball-ball' => 'fas',
    'basketball-ball' => 'fas',
    'bath' => 'fas',
    'battery-empty' => 'fas',
    'battery-full' => 'fas',
    'battery-half' => 'fas',
    'battery-quarter' => 'fas',
    'battery-three-quarters' => 'fas',
    'bed' => 'fas',
    'beer' => 'fas',
    'behance' => 'fab',
    'behance-square' => 'fab',
    'bell' => 'fas',
    'bell' => 'far',
    'bell-slash' => 'fas',
    'bell-slash' => 'far',
    'bicycle' => 'fas',
    'bimobject' => 'fab',
    'binoculars' => 'fas',
    'birthday-cake' => 'fas',
    'bitbucket' => 'fab',
    'bitcoin' => 'fab',
    'bity' => 'fab',
    'black-tie' => 'fab',
    'blackberry' => 'fab',
    'blind' => 'fas',
    'blogger' => 'fab',
    'blogger-b' => 'fab',
    'bluetooth' => 'fab',
    'bluetooth-b' => 'fab',
    'bold' => 'fas',
    'bolt' => 'fas',
    'bomb' => 'fas',
    'book' => 'fas',
    'bookmark' => 'fas',
    'bookmark' => 'far',
    'bowling-ball' => 'fas',
    'braille' => 'fas',
    'briefcase' => 'fas',
    'btc' => 'fab',
    'bug' => 'fas',
    'building' => 'fas',
    'building' => 'far',
    'bullhorn' => 'fas',
    'bullseye' => 'fas',
    'buromobelexperte' => 'fab',
    'bus' => 'fas',
    'buysellads' => 'fab',
    'calculator' => 'fas',
    'calendar' => 'fas',
    'calendar' => 'far',
    'calendar-alt' => 'fas',
    'calendar-alt' => 'far',
    'calendar-check' => 'fas',
    'calendar-check' => 'far',
    'calendar-minus' => 'fas',
    'calendar-minus' => 'far',
    'calendar-plus' => 'fas',
    'calendar-plus' => 'far',
    'calendar-times' => 'fas',
    'calendar-times' => 'far',
    'camera' => 'fas',
    'camera-retro' => 'fas',
    'car' => 'fas',
    'caret-down' => 'fas',
    'caret-left' => 'fas',
    'caret-right' => 'fas',
    'caret-square-down' => 'fas',
    'caret-square-down' => 'far',
    'caret-square-left' => 'fas',
    'caret-square-left' => 'far',
    'caret-square-right' => 'fas',
    'caret-square-right' => 'far',
    'caret-square-up' => 'fas',
    'caret-square-up' => 'far',
    'caret-up' => 'fas',
    'cart-arrow-down' => 'fas',
    'cart-plus' => 'fas',
    'cc-amazon-pay' => 'fab',
    'cc-amex' => 'fab',
    'cc-apple-pay' => 'fab',
    'cc-diners-club' => 'fab',
    'cc-discover' => 'fab',
    'cc-jcb' => 'fab',
    'cc-mastercard' => 'fab',
    'cc-paypal' => 'fab',
    'cc-stripe' => 'fab',
    'cc-visa' => 'fab',
    'centercode' => 'fab',
    'certificate' => 'fas',
    'chart-area' => 'fas',
    'chart-bar' => 'fas',
    'chart-bar' => 'far',
    'chart-line' => 'fas',
    'chart-pie' => 'fas',
    'check' => 'fas',
    'check-circle' => 'fas',
    'check-circle' => 'far',
    'check-square' => 'fas',
    'check-square' => 'far',
    'chess' => 'fas',
    'chess-bishop' => 'fas',
    'chess-board' => 'fas',
    'chess-king' => 'fas',
    'chess-knight' => 'fas',
    'chess-pawn' => 'fas',
    'chess-queen' => 'fas',
    'chess-rook' => 'fas',
    'chevron-circle-down' => 'fas',
    'chevron-circle-left' => 'fas',
    'chevron-circle-right' => 'fas',
    'chevron-circle-up' => 'fas',
    'chevron-down' => 'fas',
    'chevron-left' => 'fas',
    'chevron-right' => 'fas',
    'chevron-up' => 'fas',
    'child' => 'fas',
    'chrome' => 'fab',
    'circle' => 'fas',
    'circle' => 'far',
    'circle-notch' => 'fas',
    'clipboard' => 'fas',
    'clipboard' => 'far',
    'clock' => 'fas',
    'clock' => 'far',
    'clone' => 'fas',
    'clone' => 'far',
    'closed-captioning' => 'fas',
    'closed-captioning' => 'far',
    'cloud' => 'fas',
    'cloud-download-alt' => 'fas',
    'cloud-upload-alt' => 'fas',
    'cloudscale' => 'fab',
    'cloudsmith' => 'fab',
    'cloudversify' => 'fab',
    'code' => 'fas',
    'code-branch' => 'fas',
    'codepen' => 'fab',
    'codiepie' => 'fab',
    'coffee' => 'fas',
    'cog' => 'fas',
    'cogs' => 'fas',
    'columns' => 'fas',
    'comment' => 'fas',
    'comment' => 'far',
    'comment-alt' => 'fas',
    'comment-alt' => 'far',
    'comments' => 'fas',
    'comments' => 'far',
    'compass' => 'fas',
    'compass' => 'far',
    'compress' => 'fas',
    'connectdevelop' => 'fab',
    'contao' => 'fab',
    'copy' => 'fas',
    'copy' => 'far',
    'copyright' => 'fas',
    'copyright' => 'far',
    'cpanel' => 'fab',
    'creative-commons' => 'fab',
    'credit-card' => 'fas',
    'credit-card' => 'far',
    'crop' => 'fas',
    'crosshairs' => 'fas',
    'css3' => 'fab',
    'css3-alt' => 'fab',
    'cube' => 'fas',
    'cubes' => 'fas',
    'cut' => 'fas',
    'cuttlefish' => 'fab',
    'd-and-d' => 'fab',
    'dashcube' => 'fab',
    'database' => 'fas',
    'deaf' => 'fas',
    'delicious' => 'fab',
    'deploydog' => 'fab',
    'deskpro' => 'fab',
    'desktop' => 'fas',
    'deviantart' => 'fab',
    'digg' => 'fab',
    'digital-ocean' => 'fab',
    'discord' => 'fab',
    'discourse' => 'fab',
    'dochub' => 'fab',
    'docker' => 'fab',
    'dollar-sign' => 'fas',
    'dot-circle' => 'fas',
    'dot-circle' => 'far',
    'download' => 'fas',
    'draft2digital' => 'fab',
    'dribbble' => 'fab',
    'dribbble-square' => 'fab',
    'dropbox' => 'fab',
    'drupal' => 'fab',
    'dyalog' => 'fab',
    'earlybirds' => 'fab',
    'edge' => 'fab',
    'edit' => 'fas',
    'edit' => 'far',
    'eject' => 'fas',
    'elementor' => 'fab',
    'ellipsis-h' => 'fas',
    'ellipsis-v' => 'fas',
    'ember' => 'fab',
    'empire' => 'fab',
    'envelope' => 'fas',
    'envelope' => 'far',
    'envelope-open' => 'fas',
    'envelope-open' => 'far',
    'envelope-square' => 'fas',
    'envira' => 'fab',
    'eraser' => 'fas',
    'erlang' => 'fab',
    'ethereum' => 'fab',
    'etsy' => 'fab',
    'euro-sign' => 'fas',
    'exchange-alt' => 'fas',
    'exclamation' => 'fas',
    'exclamation-circle' => 'fas',
    'exclamation-triangle' => 'fas',
    'expand' => 'fas',
    'expand-arrows-alt' => 'fas',
    'expeditedssl' => 'fab',
    'external-link-alt' => 'fas',
    'external-link-square-alt' => 'fas',
    'eye' => 'fas',
    'eye-dropper' => 'fas',
    'eye-slash' => 'fas',
    'eye-slash' => 'far',
    'facebook' => 'fab',
    'facebook-f' => 'fab',
    'facebook-messenger' => 'fab',
    'facebook-square' => 'fab',
    'fast-backward' => 'fas',
    'fast-forward' => 'fas',
    'fax' => 'fas',
    'female' => 'fas',
    'fighter-jet' => 'fas',
    'file' => 'fas',
    'file' => 'far',
    'file-alt' => 'fas',
    'file-alt' => 'far',
    'file-archive' => 'fas',
    'file-archive' => 'far',
    'file-audio' => 'fas',
    'file-audio' => 'far',
    'file-code' => 'fas',
    'file-code' => 'far',
    'file-excel' => 'fas',
    'file-excel' => 'far',
    'file-image' => 'fas',
    'file-image' => 'far',
    'file-pdf' => 'fas',
    'file-pdf' => 'far',
    'file-powerpoint' => 'fas',
    'file-powerpoint' => 'far',
    'file-video' => 'fas',
    'file-video' => 'far',
    'file-word' => 'fas',
    'file-word' => 'far',
    'film' => 'fas',
    'filter' => 'fas',
    'fire' => 'fas',
    'fire-extinguisher' => 'fas',
    'firefox' => 'fab',
    'first-order' => 'fab',
    'firstdraft' => 'fab',
    'flag' => 'fas',
    'flag' => 'far',
    'flag-checkered' => 'fas',
    'flask' => 'fas',
    'flickr' => 'fab',
    'flipboard' => 'fab',
    'fly' => 'fab',
    'folder' => 'fas',
    'folder' => 'far',
    'folder-open' => 'fas',
    'folder-open' => 'far',
    'font' => 'fas',
    'font-awesome' => 'fab',
    'font-awesome-alt' => 'fab',
    'font-awesome-flag' => 'fab',
    'fonticons' => 'fab',
    'fonticons-fi' => 'fab',
    'football-ball' => 'fas',
    'fort-awesome' => 'fab',
    'fort-awesome-alt' => 'fab',
    'forumbee' => 'fab',
    'forward' => 'fas',
    'foursquare' => 'fab',
    'free-code-camp' => 'fab',
    'freebsd' => 'fab',
    'frown' => 'fas',
    'frown' => 'far',
    'futbol' => 'fas',
    'futbol' => 'far',
    'gamepad' => 'fas',
    'gavel' => 'fas',
    'gem' => 'fas',
    'gem' => 'far',
    'genderless' => 'fas',
    'get-pocket' => 'fab',
    'gg' => 'fab',
    'gg-circle' => 'fab',
    'gift' => 'fas',
    'git' => 'fab',
    'git-square' => 'fab',
    'github' => 'fab',
    'github-alt' => 'fab',
    'github-square' => 'fab',
    'gitkraken' => 'fab',
    'gitlab' => 'fab',
    'gitter' => 'fab',
    'glass-martini' => 'fas',
    'glide' => 'fab',
    'glide-g' => 'fab',
    'globe' => 'fas',
    'gofore' => 'fab',
    'golf-ball' => 'fas',
    'goodreads' => 'fab',
    'goodreads-g' => 'fab',
    'google' => 'fab',
    'google-drive' => 'fab',
    'google-play' => 'fab',
    'google-plus' => 'fab',
    'google-plus-g' => 'fab',
    'google-plus-square' => 'fab',
    'google-wallet' => 'fab',
    'graduation-cap' => 'fas',
    'gratipay' => 'fab',
    'grav' => 'fab',
    'gripfire' => 'fab',
    'grunt' => 'fab',
    'gulp' => 'fab',
    'h-square' => 'fas',
    'hacker-news' => 'fab',
    'hacker-news-square' => 'fab',
    'hand-lizard' => 'fas',
    'hand-lizard' => 'far',
    'hand-paper' => 'fas',
    'hand-paper' => 'far',
    'hand-peace' => 'fas',
    'hand-peace' => 'far',
    'hand-point-down' => 'fas',
    'hand-point-down' => 'far',
    'hand-point-left' => 'fas',
    'hand-point-left' => 'far',
    'hand-point-right' => 'fas',
    'hand-point-right' => 'far',
    'hand-point-up' => 'fas',
    'hand-point-up' => 'far',
    'hand-pointer' => 'fas',
    'hand-pointer' => 'far',
    'hand-rock' => 'fas',
    'hand-rock' => 'far',
    'hand-scissors' => 'fas',
    'hand-scissors' => 'far',
    'hand-spock' => 'fas',
    'hand-spock' => 'far',
    'handshake' => 'fas',
    'handshake' => 'far',
    'hashtag' => 'fas',
    'hdd' => 'fas',
    'hdd' => 'far',
    'heading' => 'fas',
    'headphones' => 'fas',
    'heart' => 'fas',
    'heart' => 'far',
    'heartbeat' => 'fas',
    'hips' => 'fab',
    'hire-a-helper' => 'fab',
    'history' => 'fas',
    'hockey-puck' => 'fas',
    'home' => 'fas',
    'hooli' => 'fab',
    'hospital' => 'fas',
    'hospital' => 'far',
    'hotjar' => 'fab',
    'hourglass' => 'fas',
    'hourglass' => 'far',
    'hourglass-end' => 'fas',
    'hourglass-half' => 'fas',
    'hourglass-start' => 'fas',
    'houzz' => 'fab',
    'html5' => 'fab',
    'hubspot' => 'fab',
    'i-cursor' => 'fas',
    'id-badge' => 'fas',
    'id-badge' => 'far',
    'id-card' => 'fas',
    'id-card' => 'far',
    'image' => 'fas',
    'image' => 'far',
    'images' => 'fas',
    'images' => 'far',
    'imdb' => 'fab',
    'inbox' => 'fas',
    'indent' => 'fas',
    'industry' => 'fas',
    'info' => 'fas',
    'info-circle' => 'fas',
    'instagram' => 'fab',
    'internet-explorer' => 'fab',
    'ioxhost' => 'fab',
    'italic' => 'fas',
    'itunes' => 'fab',
    'itunes-note' => 'fab',
    'jenkins' => 'fab',
    'joget' => 'fab',
    'joomla' => 'fab',
    'js' => 'fab',
    'js-square' => 'fab',
    'jsfiddle' => 'fab',
    'key' => 'fas',
    'keyboard' => 'fas',
    'keyboard' => 'far',
    'keycdn' => 'fab',
    'kickstarter' => 'fab',
    'kickstarter-k' => 'fab',
    'korvue' => 'fab',
    'language' => 'fas',
    'laptop' => 'fas',
    'laravel' => 'fab',
    'lastfm' => 'fab',
    'lastfm-square' => 'fab',
    'leaf' => 'fas',
    'leanpub' => 'fab',
    'lemon' => 'fas',
    'lemon' => 'far',
    'less' => 'fab',
    'level-down-alt' => 'fas',
    'level-up-alt' => 'fas',
    'life-ring' => 'fas',
    'life-ring' => 'far',
    'lightbulb' => 'fas',
    'lightbulb' => 'far',
    'line' => 'fab',
    'link' => 'fas',
    'linkedin' => 'fab',
    'linkedin-in' => 'fab',
    'linode' => 'fab',
    'linux' => 'fab',
    'lira-sign' => 'fas',
    'list' => 'fas',
    'list-alt' => 'fas',
    'list-alt' => 'far',
    'list-ol' => 'fas',
    'list-ul' => 'fas',
    'location-arrow' => 'fas',
    'lock' => 'fas',
    'lock-open' => 'fas',
    'long-arrow-alt-down' => 'fas',
    'long-arrow-alt-left' => 'fas',
    'long-arrow-alt-right' => 'fas',
    'long-arrow-alt-up' => 'fas',
    'low-vision' => 'fas',
    'lyft' => 'fab',
    'magento' => 'fab',
    'magic' => 'fas',
    'magnet' => 'fas',
    'male' => 'fas',
    'map' => 'fas',
    'map' => 'far',
    'map-marker' => 'fas',
    'map-marker-alt' => 'fas',
    'map-pin' => 'fas',
    'map-signs' => 'fas',
    'mars' => 'fas',
    'mars-double' => 'fas',
    'mars-stroke' => 'fas',
    'mars-stroke-h' => 'fas',
    'mars-stroke-v' => 'fas',
    'maxcdn' => 'fab',
    'medapps' => 'fab',
    'medium' => 'fab',
    'medium-m' => 'fab',
    'medkit' => 'fas',
    'medrt' => 'fab',
    'meetup' => 'fab',
    'meh' => 'fas',
    'meh' => 'far',
    'mercury' => 'fas',
    'microchip' => 'fas',
    'microphone' => 'fas',
    'microphone-slash' => 'fas',
    'microsoft' => 'fab',
    'minus' => 'fas',
    'minus-circle' => 'fas',
    'minus-square' => 'fas',
    'minus-square' => 'far',
    'mix' => 'fab',
    'mixcloud' => 'fab',
    'mizuni' => 'fab',
    'mobile' => 'fas',
    'mobile-alt' => 'fas',
    'modx' => 'fab',
    'monero' => 'fab',
    'money-bill-alt' => 'fas',
    'money-bill-alt' => 'far',
    'moon' => 'fas',
    'moon' => 'far',
    'motorcycle' => 'fas',
    'mouse-pointer' => 'fas',
    'music' => 'fas',
    'napster' => 'fab',
    'neuter' => 'fas',
    'newspaper' => 'fas',
    'newspaper' => 'far',
    'nintendo-switch' => 'fab',
    'node' => 'fab',
    'node-js' => 'fab',
    'npm' => 'fab',
    'ns8' => 'fab',
    'nutritionix' => 'fab',
    'object-group' => 'fas',
    'object-group' => 'far',
    'object-ungroup' => 'fas',
    'object-ungroup' => 'far',
    'odnoklassniki' => 'fab',
    'odnoklassniki-square' => 'fab',
    'opencart' => 'fab',
    'openid' => 'fab',
    'opera' => 'fab',
    'optin-monster' => 'fab',
    'osi' => 'fab',
    'outdent' => 'fas',
    'page4' => 'fab',
    'pagelines' => 'fab',
    'paint-brush' => 'fas',
    'palfed' => 'fab',
    'paper-plane' => 'fas',
    'paper-plane' => 'far',
    'paperclip' => 'fas',
    'paragraph' => 'fas',
    'paste' => 'fas',
    'patreon' => 'fab',
    'pause' => 'fas',
    'pause-circle' => 'fas',
    'pause-circle' => 'far',
    'paw' => 'fas',
    'paypal' => 'fab',
    'pen-square' => 'fas',
    'pencil-alt' => 'fas',
    'percent' => 'fas',
    'periscope' => 'fab',
    'phabricator' => 'fab',
    'phoenix-framework' => 'fab',
    'phone' => 'fas',
    'phone-square' => 'fas',
    'phone-volume' => 'fas',
    'php' => 'fab',
    'pied-piper' => 'fab',
    'pied-piper-alt' => 'fab',
    'pied-piper-pp' => 'fab',
    'pinterest' => 'fab',
    'pinterest-p' => 'fab',
    'pinterest-square' => 'fab',
    'plane' => 'fas',
    'play' => 'fas',
    'play-circle' => 'fas',
    'play-circle' => 'far',
    'playstation' => 'fab',
    'plug' => 'fas',
    'plus' => 'fas',
    'plus-circle' => 'fas',
    'plus-square' => 'fas',
    'plus-square' => 'far',
    'podcast' => 'fas',
    'pound-sign' => 'fas',
    'power-off' => 'fas',
    'print' => 'fas',
    'product-hunt' => 'fab',
    'pushed' => 'fab',
    'puzzle-piece' => 'fas',
    'python' => 'fab',
    'qq' => 'fab',
    'qrcode' => 'fas',
    'question' => 'fas',
    'question-circle' => 'fas',
    'question-circle' => 'far',
    'quidditch' => 'fas',
    'quinscape' => 'fab',
    'quora' => 'fab',
    'quote-left' => 'fas',
    'quote-right' => 'fas',
    'random' => 'fas',
    'ravelry' => 'fab',
    'react' => 'fab',
    'rebel' => 'fab',
    'recycle' => 'fas',
    'red-river' => 'fab',
    'reddit' => 'fab',
    'reddit-alien' => 'fab',
    'reddit-square' => 'fab',
    'redo' => 'fas',
    'redo-alt' => 'fas',
    'registered' => 'fas',
    'registered' => 'far',
    'rendact' => 'fab',
    'renren' => 'fab',
    'reply' => 'fas',
    'reply-all' => 'fas',
    'replyd' => 'fab',
    'resolving' => 'fab',
    'retweet' => 'fas',
    'road' => 'fas',
    'rocket' => 'fas',
    'rocketchat' => 'fab',
    'rockrms' => 'fab',
    'rss' => 'fas',
    'rss-square' => 'fas',
    'ruble-sign' => 'fas',
    'rupee-sign' => 'fas',
    'safari' => 'fab',
    'sass' => 'fab',
    'save' => 'fas',
    'save' => 'far',
    'schlix' => 'fab',
    'scribd' => 'fab',
    'search' => 'fas',
    'search-minus' => 'fas',
    'search-plus' => 'fas',
    'searchengin' => 'fab',
    'sellcast' => 'fab',
    'sellsy' => 'fab',
    'server' => 'fas',
    'servicestack' => 'fab',
    'share' => 'fas',
    'share-alt' => 'fas',
    'share-alt-square' => 'fas',
    'share-square' => 'fas',
    'share-square' => 'far',
    'shekel-sign' => 'fas',
    'shield-alt' => 'fas',
    'ship' => 'fas',
    'shirtsinbulk' => 'fab',
    'shopping-bag' => 'fas',
    'shopping-basket' => 'fas',
    'shopping-cart' => 'fas',
    'shower' => 'fas',
    'sign-in-alt' => 'fas',
    'sign-language' => 'fas',
    'sign-out-alt' => 'fas',
    'signal' => 'fas',
    'simplybuilt' => 'fab',
    'sistrix' => 'fab',
    'sitemap' => 'fas',
    'skyatlas' => 'fab',
    'skype' => 'fab',
    'slack' => 'fab',
    'slack-hash' => 'fab',
    'sliders-h' => 'fas',
    'slideshare' => 'fab',
    'smile' => 'fas',
    'smile' => 'far',
    'snapchat' => 'fab',
    'snapchat-ghost' => 'fab',
    'snapchat-square' => 'fab',
    'snowflake' => 'fas',
    'snowflake' => 'far',
    'sort' => 'fas',
    'sort-alpha-down' => 'fas',
    'sort-alpha-up' => 'fas',
    'sort-amount-down' => 'fas',
    'sort-amount-up' => 'fas',
    'sort-down' => 'fas',
    'sort-numeric-down' => 'fas',
    'sort-numeric-up' => 'fas',
    'sort-up' => 'fas',
    'soundcloud' => 'fab',
    'space-shuttle' => 'fas',
    'speakap' => 'fab',
    'spinner' => 'fas',
    'spotify' => 'fab',
    'square' => 'fas',
    'square' => 'far',
    'square-full' => 'fas',
    'stack-exchange' => 'fab',
    'stack-overflow' => 'fab',
    'star' => 'fas',
    'star' => 'far',
    'star-half' => 'fas',
    'star-half' => 'far',
    'staylinked' => 'fab',
    'steam' => 'fab',
    'steam-square' => 'fab',
    'steam-symbol' => 'fab',
    'step-backward' => 'fas',
    'step-forward' => 'fas',
    'stethoscope' => 'fas',
    'sticker-mule' => 'fab',
    'sticky-note' => 'fas',
    'sticky-note' => 'far',
    'stop' => 'fas',
    'stop-circle' => 'fas',
    'stop-circle' => 'far',
    'stopwatch' => 'fas',
    'strava' => 'fab',
    'street-view' => 'fas',
    'strikethrough' => 'fas',
    'stripe' => 'fab',
    'stripe-s' => 'fab',
    'studiovinari' => 'fab',
    'stumbleupon' => 'fab',
    'stumbleupon-circle' => 'fab',
    'subscript' => 'fas',
    'subway' => 'fas',
    'suitcase' => 'fas',
    'sun' => 'fas',
    'sun' => 'far',
    'superpowers' => 'fab',
    'superscript' => 'fas',
    'supple' => 'fab',
    'sync' => 'fas',
    'sync-alt' => 'fas',
    'table' => 'fas',
    'table-tennis' => 'fas',
    'tablet' => 'fas',
    'tablet-alt' => 'fas',
    'tachometer-alt' => 'fas',
    'tag' => 'fas',
    'tags' => 'fas',
    'tasks' => 'fas',
    'taxi' => 'fas',
    'telegram' => 'fab',
    'telegram-plane' => 'fab',
    'tencent-weibo' => 'fab',
    'terminal' => 'fas',
    'text-height' => 'fas',
    'text-width' => 'fas',
    'th' => 'fas',
    'th-large' => 'fas',
    'th-list' => 'fas',
    'themeisle' => 'fab',
    'thermometer-empty' => 'fas',
    'thermometer-full' => 'fas',
    'thermometer-half' => 'fas',
    'thermometer-quarter' => 'fas',
    'thermometer-three-quarters' => 'fas',
    'thumbs-down' => 'fas',
    'thumbs-down' => 'far',
    'thumbs-up' => 'fas',
    'thumbs-up' => 'far',
    'thumbtack' => 'fas',
    'ticket-alt' => 'fas',
    'times' => 'fas',
    'times-circle' => 'fas',
    'times-circle' => 'far',
    'tint' => 'fas',
    'toggle-off' => 'fas',
    'toggle-on' => 'fas',
    'trademark' => 'fas',
    'train' => 'fas',
    'transgender' => 'fas',
    'transgender-alt' => 'fas',
    'trash' => 'fas',
    'trash-alt' => 'fas',
    'trash-alt' => 'far',
    'tree' => 'fas',
    'trello' => 'fab',
    'tripadvisor' => 'fab',
    'trophy' => 'fas',
    'truck' => 'fas',
    'tty' => 'fas',
    'tumblr' => 'fab',
    'tumblr-square' => 'fab',
    'tv' => 'fas',
    'twitch' => 'fab',
    'twitter' => 'fab',
    'twitter-square' => 'fab',
    'typo3' => 'fab',
    'uber' => 'fab',
    'uikit' => 'fab',
    'umbrella' => 'fas',
    'underline' => 'fas',
    'undo' => 'fas',
    'undo-alt' => 'fas',
    'uniregistry' => 'fab',
    'universal-access' => 'fas',
    'university' => 'fas',
    'unlink' => 'fas',
    'unlock' => 'fas',
    'unlock-alt' => 'fas',
    'untappd' => 'fab',
    'upload' => 'fas',
    'usb' => 'fab',
    'user' => 'fas',
    'user' => 'far',
    'user-circle' => 'fas',
    'user-circle' => 'far',
    'user-md' => 'fas',
    'user-plus' => 'fas',
    'user-secret' => 'fas',
    'user-times' => 'fas',
    'users' => 'fas',
    'ussunnah' => 'fab',
    'utensil-spoon' => 'fas',
    'utensils' => 'fas',
    'vaadin' => 'fab',
    'venus' => 'fas',
    'venus-double' => 'fas',
    'venus-mars' => 'fas',
    'viacoin' => 'fab',
    'viadeo' => 'fab',
    'viadeo-square' => 'fab',
    'viber' => 'fab',
    'video' => 'fas',
    'vimeo' => 'fab',
    'vimeo-square' => 'fab',
    'vimeo-v' => 'fab',
    'vine' => 'fab',
    'vk' => 'fab',
    'vnv' => 'fab',
    'volleyball-ball' => 'fas',
    'volume-down' => 'fas',
    'volume-off' => 'fas',
    'volume-up' => 'fas',
    'vuejs' => 'fab',
    'weibo' => 'fab',
    'weixin' => 'fab',
    'whatsapp' => 'fab',
    'whatsapp-square' => 'fab',
    'wheelchair' => 'fas',
    'whmcs' => 'fab',
    'wifi' => 'fas',
    'wikipedia-w' => 'fab',
    'window-close' => 'fas',
    'window-close' => 'far',
    'window-maximize' => 'fas',
    'window-maximize' => 'far',
    'window-minimize' => 'fas',
    'window-minimize' => 'far',
    'window-restore' => 'fas',
    'window-restore' => 'far',
    'windows' => 'fab',
    'won-sign' => 'fas',
    'wordpress' => 'fab',
    'wordpress-simple' => 'fab',
    'wpbeginner' => 'fab',
    'wpexplorer' => 'fab',
    'wpforms' => 'fab',
    'wrench' => 'fas',
    'xbox' => 'fab',
    'xing' => 'fab',
    'xing-square' => 'fab',
    'y-combinator' => 'fab',
    'yahoo' => 'fab',
    'yandex' => 'fab',
    'yandex-international' => 'fab',
    'yelp' => 'fab',
    'yen-sign' => 'fas',
    'yoast' => 'fab',
    'youtube' => 'fab',
    'youtube-square' => 'fab',
  );

  return isset( $map[$icon_name] ) ? $map[$icon_name] : false;
}
