<?php

add_action( 'plugins_loaded' , 'ubermenu_load_gutenberg_block' );
function ubermenu_load_gutenberg_block(){
	if( function_exists( 'register_block_type' ) ){
		include_once( 'gutenberg/gutenberg.php' );
	}
}

add_action( 'plugins_loaded' , 'ubermenu_load_textdomain' );
function ubermenu_load_textdomain(){
	load_plugin_textdomain( 'ubermenu' , false , UBERMENU_BASEDIR.'/languages' );
}


add_filter( 'wp' , 'ubermenu_wp_actions' );
function ubermenu_wp_actions(){

	//Exclude UberMenu Advanced Items from other menus
	if( ubermenu_op( 'exclude_advanced_ubermenu_items' , 'general' ) === 'on' ){
		add_filter( 'wp_nav_menu_objects' , 'ubermenu_exclude_advanced_items' , 20, 2 );
	}

}

function ubermenu_register_style( $handle , $src = '', $deps = array() , $ver = false , $media = 'all' ){
	_UBERMENU()->register_stylesheet( $handle , $src , $deps , $ver , $media );
}
function ubermenu_enqueue_style( $handle , $src = '', $deps = array() , $ver = false , $media = 'all' ){
	_UBERMENU()->load_stylesheet( $handle , $src , $deps , $ver , $media );
}
function ubermenu_register_script( $handle , $src = '', $deps = array() , $ver = false , $in_footer = false ){
	_UBERMENU()->register_script( $handle , $src , $deps , $ver , $in_footer );
}
function ubermenu_enqueue_script( $handle , $src = '', $deps = array() , $ver = false , $in_footer = false ){
	_UBERMENU()->load_script( $handle , $src , $deps , $ver , $in_footer );
}

function ubermenu_load_assets(){

	$assets = UBERMENU_URL . 'assets/';

	//Load Core UberMenu CSS unless disabled
	if( ubermenu_op( 'load_ubermenu_css' , 'general' ) != 'off' ){
		wp_register_style( 'ubermenu' , $assets.'css/ubermenu.min.css' , false , UBERMENU_VERSION );

		//wp_enqueue_style( 'ubermenu' );
		ubermenu_enqueue_style( 'ubermenu' );
	}

	//Load Required Skins
	$instances = ubermenu_get_menu_instances( true );
	foreach( $instances as $instance ){
		$skin = ubermenu_op( 'skin' , $instance );
		ubermenu_enqueue_skin( $skin );
	}

	//
	//Font Awesome
	//

	//Font Awesome CSSFonts
	$load_fa_solid = 				ubermenu_op( 'load_fontawesome_fontcss_solid' , 'general' ) !== 'off';
	$load_fa_brands = 			ubermenu_op( 'load_fontawesome_fontcss_brands' , 'general' ) !== 'off';
	$load_fa_regular = 			ubermenu_op( 'load_fontawesome_fontcss_regular' , 'general' ) !== 'off';
	$load_fa_core = 				$load_fa_solid || $load_fa_brands || $load_fa_regular;
	$load_fa_all = 					$load_fa_solid && $load_fa_brands && $load_fa_regular;


	if( $load_fa_all )				ubermenu_enqueue_style( 'ubermenu-font-awesome-all' , 	UBERMENU_URL .'assets/fontawesome/css/all.min.css' , false , false );
	else{
		if( $load_fa_core ) 		ubermenu_enqueue_style( 'ubermenu-font-awesome-core' , 	UBERMENU_URL .'assets/fontawesome/css/fontawesome.min.css' , false , false );
		if( $load_fa_solid ) 		ubermenu_enqueue_style( 'ubermenu-font-awesome-solid' , UBERMENU_URL .'assets/fontawesome/css/solid.min.css' , false , false );
		if( $load_fa_brands ) 	ubermenu_enqueue_style( 'ubermenu-font-awesome-brands' , UBERMENU_URL .'assets/fontawesome/css/brands.min.css' , false , false );
		if( $load_fa_regular ) 	ubermenu_enqueue_style( 'ubermenu-font-awesome-regular' , UBERMENU_URL .'assets/fontawesome/css/regular.min.css' , false , false );
	}

	//Font Awesome SVG
	$load_fasvg_solid = 		ubermenu_op( 'load_fontawesome_svg_solid' , 'general' ) !== 'off';
	$load_fasvg_brands = 		ubermenu_op( 'load_fontawesome_svg_brands' , 'general' ) !== 'off';
	$load_fasvg_regular = 	ubermenu_op( 'load_fontawesome_svg_regular' , 'general' ) !== 'off';
	$load_fasvg_core = 			$load_fasvg_solid || $load_fasvg_brands || $load_fasvg_regular;
	$load_fasvg_all = 			$load_fasvg_solid && $load_fasvg_brands && $load_fasvg_regular;

	if( $load_fasvg_all )		ubermenu_enqueue_script( 'ubermenu-font-awesome-js-all' , UBERMENU_URL.'assets/fontawesome/js/all.min.js' , false , false , false );
	else{
		if( $load_fasvg_solid ) 	ubermenu_enqueue_script( 'ubermenu-font-awesome-js-solid' , UBERMENU_URL.'assets/fontawesome/js/solid.min.js' , false , false , false );
		if( $load_fasvg_brands ) 	ubermenu_enqueue_script( 'ubermenu-font-awesome-js-brands' , UBERMENU_URL.'assets/fontawesome/js/brands.min.js' , false , false , false );
		if( $load_fasvg_regular ) ubermenu_enqueue_script( 'ubermenu-font-awesome-js-regular' , UBERMENU_URL.'assets/fontawesome/js/regular.min.js' , false , false , false );
		//Core needs to be loaded last
		if( $load_fasvg_core ) 		ubermenu_enqueue_script( 'ubermenu-font-awesome-js-core' , UBERMENU_URL.'assets/fontawesome/js/fontawesome.min.js' , false , false , false );
	}

	//Font Awesome 4 shim
	if( ubermenu_op( 'load_fontawesome4_shim' , 'general' ) == 'on' ){
		//wp_enqueue_script( 'ubermenu-font-awesome4-shim' , UBERMENU_URL.'assets/fontawesome/svg/js/fa-v4-shims.min.js' , false , false , false );
		ubermenu_enqueue_script( 'ubermenu-font-awesome4-shim' , UBERMENU_URL.'assets/fontawesome/js/v4-shims.min.js' , false , false , false );
	}
	add_filter( 'script_loader_tag', 'ubermenu_fontawesome_defer', 10, 2 );


	// if( ubermenu_op( 'load_fontawesome' , 'general' ) != 'off' ){
	// 	//font awesome 4
	// 	//wp_enqueue_style( 'ubermenu-font-awesome' , $assets.'css/fontawesome/css/font-awesome.min.css' , false , '4.3' );
	//
	// 	//wp_enqueue_style( 'ubermenu-font-awesome' , 'https://use.fontawesome.com/releases/v5.0.7/css/all.css' , false );
	//
	// 	//font awesome 5
	// 	//wp_enqueue_style( 'ubermenu-font-awesome' , 'https://use.fontawesome.com/releases/v5.0.7/css/all.css' , false );
	// 	wp_enqueue_script( 'ubermenu-font-awesome-js' , UBERMENU_URL.'assets/fontawesome/svg/js/fontawesome-all.min.js' , false , false , false );
	// 	add_filter( 'script_loader_tag', 'ubermenu_fontawesome_defer', 10, 2 );

	// }




	//Custom Stylesheet
	if( ubermenu_op( 'load_custom_css' , 'general' ) == 'on' ){
		ubermenu_enqueue_style( 'ubermenu-custom-stylesheet' , UBERMENU_URL.'custom/custom.css' , false , UBERMENU_VERSION );
	}



	//jQuery
	ubermenu_enqueue_script( 'jquery' );

	//Google Maps
	if( ubermenu_op( 'load_google_maps' , 'general' ) == 'on' ){
		//Google Maps API
    $gmaps_uri = '//maps.googleapis.com/maps/api/js';

    $query_params = array();

    //API Key
    $api_key = trim( ubermenu_op( 'google_maps_api_key' , 'general' ) );
    if( $api_key ){
      $query_params['key'] = $api_key;
    }

    //Language
    $language = trim( ubermenu_op( 'google_maps_language' , 'general' ) );
    if( $language ){
      $query_params['language'] = $language;
    }

    //Region
    $region = trim( ubermenu_op( 'google_maps_region' , 'general' ) );
    if( $region ){
      $query_params['region'] = $region;
    }

    $query = http_build_query( $query_params );

    $gmaps_uri.= '?'.$query;

    ubermenu_register_script( 'google-maps', $gmaps_uri , array( 'jquery' ), null , true );
	}

	//UberMenu JS
	if( SCRIPT_DEBUG ){
		ubermenu_enqueue_script( 'ubermenu' , $assets.'js/ubermenu.js' , array( 'jquery' ) , UBERMENU_VERSION , UBERMENU_JS_IN_FOOTER );
	}
	else{
		ubermenu_enqueue_script( 'ubermenu' , $assets.'js/ubermenu.min.js' , array( 'jquery' ) , UBERMENU_VERSION , UBERMENU_JS_IN_FOOTER );
	}

	$responsive_breakpoint = intval( ubermenu_op( 'responsive_breakpoint', 'general' ) );
	if( $responsive_breakpoint == 0 ) $responsive_breakpoint = 959;

	// $config_data = array();
	// $configs = ubermenu_get_menu_instances(true);
	// foreach( $configs as $config_id ){
	// 	$config_data[$config_id] = array(
	// 		//add data here
	// 	);
	// }

	$localized_data = array(
		'remove_conflicts'	=> ubermenu_op( 'remove_conflicts' , 'general' ),
		'reposition_on_load'=> ubermenu_op( 'reposition_on_load' , 'general' ),
		'intent_delay'		=> ubermenu_op( 'intent_delay' , 'general' ),
		'intent_interval'	=> ubermenu_op( 'intent_interval' , 'general' ),
		'intent_threshold'	=> ubermenu_op( 'intent_threshold' , 'general' ),
		'scrollto_offset'	=> ubermenu_op( 'scrollto_offset' , 'general' ),
		'scrollto_duration'	=> ubermenu_op( 'scrollto_duration' , 'general' ),
		'responsive_breakpoint' => $responsive_breakpoint,
		'accessible'		=> ubermenu_op( 'accessible', 'general' ),
		'retractor_display_strategy' => ubermenu_op( 'retractor_display_strategy' , 'general' ),
		'touch_off_close'	=> ubermenu_op( 'touch_off_close' , 'general' ),
		'submenu_indicator_close_mobile' => ubermenu_op( 'submenu_indicator_close_mobile' , 'general' ),
		'collapse_after_scroll'	=> ubermenu_op( 'collapse_after_scroll' , 'general' ),
		'v'					=> UBERMENU_VERSION,
		'configurations'	=> ubermenu_get_menu_instances(true),
		'ajax_url' 			=> admin_url( 'admin-ajax.php' ),
		'plugin_url'		=> UBERMENU_URL,
		'disable_mobile' 	=> ubermenu_op( 'disable_mobile' , 'main' ),	//just for troubleshooting
		'prefix_boost'	=> ubermenu_op( 'custom_prefix' , 'general' ),

		//accessibility
		'aria_role_navigation'	=> ubermenu_op( 'aria_role_navigation' , 'general' ),
		'aria_nav_label'	=> ubermenu_op( 'aria_nav_label' , 'general' ),
		'aria_expanded' => ubermenu_op( 'aria_expanded' , 'general' ),
		'aria_hidden'	=> ubermenu_op( 'aria_hidden' , 'general' ),
		'aria_controls' => ubermenu_op( 'aria_controls' , 'general' ),
		'aria_responsive_toggle' => ubermenu_op( 'aria_responsive_toggle' , 'general' ),
		'icon_tag' => ubermenu_op( 'icon_tag', 'main' ), // grab from main since no global

		//info
		'theme_locations' => get_registered_nav_menus(),

		//configs
		//'configs' => $config_data,
	);

	$localized_data = apply_filters( 'ubermenu_json_data' , $localized_data );

	wp_localize_script( 'ubermenu' , 'ubermenu_data' , $localized_data );

	//Custom JS
	if( ubermenu_op( 'load_custom_js' , 'general' ) == 'on' ){
		ubermenu_enqueue_script( 'ubermenu-custom' , UBERMENU_URL.'custom/custom.js' , array( 'jquery' ) , UBERMENU_VERSION , UBERMENU_JS_IN_FOOTER );
	}


	//wp_register_script( 'ubermenu-customizer' , $assets . 'admin/assets/customizer.js' , array( 'jquery' ) , UBERMENU_VERSION , true );
}
add_action( 'wp_enqueue_scripts' , 'ubermenu_load_assets' , 21 );


function ubermenu_fontawesome_defer( $tag, $handle ) {
    if( 'ubermenu-font-awesome-js-all' === $handle || 'ubermenu-font-awesome-js-solid' === $handle || 'ubermenu-font-awesome-js-brands' === $handle || 'ubermenu-font-awesome4-shim' === $handle ) {
        $tag = str_replace( ' src', ' defer src', $tag );
    }
    return $tag;
}

function ubermenu_inject_custom_css(){
	echo '<style id="ubermenu-custom-generated-css">';
	//echo ubermenu_generate_custom_styles();
	echo ubermenu_get_custom_styles();

	global $is_IE;
	if( $is_IE ){
		echo "\n@media \\0screen { .ubermenu .ubermenu-image { width: auto } } /* Prevent height distortion in IE8. */\n";
	}
	echo "\n</style>";
}
add_action( 'wp_head' , 'ubermenu_inject_custom_css' );


function ubermenu_get_skin_ops(){

	$registered_skins = _UBERMENU()->get_skins();
	if( !is_array( $registered_skins ) ) return array();
	$ops = array();
	foreach( $registered_skins as $id => $skin ){
		$ops[$id] = $skin['title'];
	}
	return $ops;

}
function ubermenu_register_skin( $id, $title, $path , $classes = '' ){
	_UBERMENU()->register_skin( $id , $title , $path , $classes );
}

add_action( 'init' , 'ubermenu_register_skins' );
function ubermenu_register_skins(){

	$main = UBERMENU_URL . 'assets/css/skins/';
	//Custom prefix booster
	if( ubermenu_op( 'custom_prefix' , 'general' ) ){
		$uploads_url = wp_upload_dir();
		$uploads_url = trailingslashit( $uploads_url['baseurl'] );
		$main = $uploads_url . 'ubermenu/';
	}

	ubermenu_register_skin( 'none' , 'None (Disabled - provide your own custom skin)' , '' );

	ubermenu_register_skin( 'minimal' , 'Minimal base (for customizing)' , $main.'minimal.css' );

	ubermenu_register_skin( 'grey-white' , 'Black &amp; White' , $main.'blackwhite.css' );
	ubermenu_register_skin( 'black-white-2' , 'Black &amp; White 2.0' , $main.'blackwhite2.css' , 'ubermenu-has-border' );
	ubermenu_register_skin( 'vanilla' , 'Vanilla' , $main.'vanilla.css' );
	ubermenu_register_skin( 'vanilla-bar' , 'Vanilla Bar' , $main.'vanilla_bar.css' , 'ubermenu-has-border' );

}


function ubermenu_enqueue_skin( $skin ){
	ubermenu_enqueue_style( 'ubermenu-'.$skin );
}


function ubermenu_init_actions(){
	add_action( 'ubermenu_register_icons' , 'ubermenu_register_default_icons' , 10 );
	do_action( 'ubermenu_register_icons' );
}
add_action( 'after_setup_theme' , 'ubermenu_init_actions' , 20 );

function ubermenu_setup_easy_integration(){
	if( ubermenu_op( 'ubermenu_theme_location' , 'general' ) == 'on' ){
		register_nav_menu( 'ubermenu' , 'UberMenu [Easy Integration]' );
	}
}
add_action( 'init' , 'ubermenu_setup_easy_integration' );


function ubermenu_get_menu_instances( $main = false ){
	$instances = get_option( UBERMENU_MENU_INSTANCES , array() );

	if( $main ){
		$instances[] = 'main';
	}

	return $instances;
}


function ubermenu_get_nav_menu_ops(){
	$menus = wp_get_nav_menus( array('orderby' => 'name') );
	$m = array( '_none' => 'Select Menu' );
	foreach( $menus as $menu ){
		$m[$menu->term_id] = $menu->name;
	}
	return $m;
}

function ubermenu_get_theme_location_ops(){
	$locs = get_registered_nav_menus();
	//$default = array( '_none' => 'Select Theme Location or use Menu Setting' );
	//$locs = array_unshift( $default, $locs );
	//$locs = $default + $locs;

	$menus = get_nav_menu_locations();
	foreach( $locs as $loc_id => $loc_name ){

		if( isset( $menus[$loc_id] ) && $menus[$loc_id] ){
			$locs[$loc_id].= ' <span class="ubermenu-assigned"><strong>' . wp_get_nav_menu_object( $menus[$loc_id] )->name .'</strong></span>';
		}
		else{
			$locs[$loc_id].= ' <span class="ubermenu-assigned ubermenu-assigned-none">No menu assigned</span>';
		}
	}

	return $locs;
}




/*
 * By Instance
 *
 * $integration_type - 'api' or 'auto'
 */
function ubermenu_get_nav_menu_args( $args , $integration_type , $config_id = 0 ){

	if( isset( $args['uber_segment'] ) ) return $args; //Ignore segments

	$theme_location = '';
	$nav_menu_id = 0;
	$strict_mode = ubermenu_op( 'strict_mode' , 'general' ) == 'off' ? false : true;

	//Determine theme_location
	//Determine config_id (if not passed)
	//Determine nav_menu_id
	switch( $integration_type ){


		case 'auto':

			//Is it UberMenu?

			//Check for assigned Theme Location

			//For automatic integration, if there is no theme_location, we can't do anything
			if( $strict_mode && ( !isset( $args['theme_location'] ) || !$args['theme_location'] ) ){
				return $args;
			}

			//Determine Menu Instance ID by theme_location
			if( isset( $args['theme_location'] ) && $args['theme_location'] ){
				$theme_location = $args['theme_location'];
				$config_id = ubermenu_get_menu_instance_by_theme_location( $theme_location );
			}
			//[Non-strict mode] If there is no theme location at this point, we must have
			//strict mode disabled.  Therefore, default to Main instance
			else{
				$config_id = 'main';

				//However, in this case we require a 'menu' param to be passed
				if( isset( $args['menu'] ) && $args['menu'] ){
					$nav_menu_id = $args['menu'];
				}
				//If we don't have a theme location or menu parameter, the menu is indetermined
				else{
					$nav_menu_id = '_undetermined_';
				}
			}

			//If this theme location is not activated, ignore it
			if( !$config_id ) return $args;

			//Find nav_menu_id
			//look up the ID based on the theme location, assuming it exists

			if( $theme_location && has_nav_menu( $theme_location ) ){
				$menus = get_nav_menu_locations();
				$nav_menu_id = $menus[$theme_location];
			}

			//Check that we're on the right theme location instance
			if( $theme_location ){
				//Count this theme location instance
				_UBERMENU()->count_theme_location( $theme_location );

				//Determine what instance we're targeting
				$target_instance = ubermenu_op( 'theme_location_instance' , $config_id );
				if( is_numeric( $target_instance ) ){
					$target_instance = (int) $target_instance;
				}
				else if( $target_instance == '' ){
					$target_instance = 0;
				}
				else{
					ubermenu_admin_notice( __( 'Theme Location Instance should be an integer or leave blank.  Defaulting to 0.' , 'ubermenu' ) );
					$target_instance = 0;
				}

				//If we're not targeting all instances
				if( $target_instance > 0 ){

					//Check that the target theme location instance is the current theme location instance
					//If it isn't, then ignore
					if( $target_instance !== _UBERMENU()->get_theme_location_count( $theme_location ) ){
						return $args;
					}
				}

				//Ignore Mobile?
				if( ubermenu_op( 'disable_mobile' , $config_id ) == 'on' && ubermenu_is_mobile() ){
					return $args;
				}
			}

			break;


		case 'api':

			//instance_id
			if( $config_id != 'main' ){
				$instances = ubermenu_get_menu_instances();
				if( array_search( $config_id , $instances ) === false ){
					$notice = '<strong>'.$config_id.'</strong> '. __( 'is not a valid Configuration ID.  Please pass a valid Configuration ID to the ubermenu() function.' , 'ubermenu' );
					ubermenu_admin_notice( $notice );
				}
			}

			//Always UberMenu
			$theme_location = ( isset( $args['theme_location'] ) && $args['theme_location'] )
								? $args['theme_location'] : 0;


			//If a Menu ID was passed in the args, use that
			if( isset( $args['menu'] ) && $args['menu'] ){
				$nav_menu_id = $args['menu'];
			}
			//No Menu ID was passed, get the assigned menu based on the instance
			else{
				$_menu_id = ubermenu_op( 'nav_menu_id' , $config_id );

				if( $_menu_id  && $_menu_id != '_none' ){
					$nav_menu_id = $_menu_id;
				}
				else{
					//No menu passed, no menu assigned, try the theme location
					if( $theme_location && has_nav_menu( $theme_location ) ){
						$menus = get_nav_menu_locations();
						$nav_menu_id = $menus[$theme_location];
					}
				}

				//Setup args
				if( $nav_menu_id ){
					$args['menu'] = $nav_menu_id;	//TODO ...
				}
			}

			//Don't know what the nav menu ID is still
			if( !$nav_menu_id ){
				if( !$theme_location ) $args['theme_location'] = '__um_undetermined__';
			}

			//If a theme location was used, count it.  But we don't care if this is the target
			//or not, since the API was used
			if( $theme_location ){
				_UBERMENU()->count_theme_location( $theme_location );
			}

			break;

	}




	//Allow filtering to a different Configuration at this point
	$config_id = apply_filters( 'ubermenu_configuration_id' , $config_id , $args );


	//UL attributes - since we can't add anything to the nav tag
	$ul_atts = array();

	//Menu title is used for the aria-label on the nav tag, but this can be filtered
	$menu_title = apply_filters( 'ubermenu_menu_title' , wp_get_nav_menu_object( $nav_menu_id )->name , $nav_menu_id , $config_id , $args );
	$ul_atts['data-title'] = $menu_title;

	//Walk the array
	array_walk( $ul_atts , function( &$val , $att ) {
		//$ul_atts_str.= $att.'='.$val.' ';
		$val = "$att=\"$val\"";
	});
	//Combine the values
	$ul_atts_str = ' '.implode( ' ' , $ul_atts );	//beginning space is important

	//Basics
	$args['container_class'] 	= 'ubermenu ubermenu-nojs';
	$args['menu_class']			= 'ubermenu-nav';
	$args['walker']				= new UberMenuWalker;
	$args['uber_instance']		= $config_id;
	$args['fallback_cb']		= 'ubermenu_fallback_cb';
	$args['depth']				= 0;
	$args['items_wrap']			= '<ul id="%1$s" class="%2$s"'.$ul_atts_str.'>%3$s</ul>';
	$args['link_before']		= '';
	$args['link_after']			= '';
	$args['uber_integration_type'] = $integration_type;


	//Make sure nav menu ID is a string so that it can be used as part of the ID
	if( is_object( $nav_menu_id ) ){
		if( isset( $nav_menu_id->term_id ) ){
			$nav_menu_id = $nav_menu_id->term_id;
		}
		else{
			$nav_menu_id = '_bad_id_';
		}
	}

	//ID
	$args['container_id']		= 'ubermenu-'.$config_id.'-'.$nav_menu_id;
	if( $theme_location ){
		$args['container_id'].='-'.sanitize_key( $theme_location );
		$theme_location_count = _UBERMENU()->get_theme_location_count( $theme_location );
		if( $theme_location_count > 1 ){
			$args['container_id'].= '-'.$theme_location_count;
		}
	}


	//Inner ID
	if( !isset( $args['menu_id'] ) || !$args['menu_id'] || $integration_type == 'auto' ){
		$args['menu_id']		= 'ubermenu-nav-'.$config_id.'-'.$nav_menu_id;
		if( $theme_location ) $args['menu_id'].='-'.sanitize_key( $theme_location );
	}

	//Cache
	$args['menu_cache_key']		= "|uber|$config_id|$nav_menu_id|$theme_location";	//For WP Menu Cache Plugin

	//Container
	$args['container']			= ubermenu_op( 'container_tag' , $config_id ); // . ' role="navigation"';

	//Menu Instance ID
	$args['container_class'].= ' ubermenu-'.$config_id;

	//Menu ID
	$args['container_class'].= ' ubermenu-menu-'.$nav_menu_id;

	//Theme Location
	if( $theme_location ){
		$args['container_class'].= ' ubermenu-loc-'.sanitize_title( $theme_location );
	}

	//Responsive
	if( ubermenu_op( 'responsive' , $config_id ) == 'on' ){
		$args['container_class'].= ' ubermenu-responsive';

		if( ubermenu_op( 'responsive_columns' , $config_id ) == 1 ){
			$args['container_class'].= ' ubermenu-responsive-single-column';
		}

		if( ubermenu_op( 'responsive_submenu_columns' , $config_id ) == 1 ){
			$args['container_class'].= ' ubermenu-responsive-single-column-subs';
		}

		$breakpoint = ubermenu_op( 'responsive_breakpoint' , 'general' );
		if( !$breakpoint ){
			$breakpoint = 'default';
		}
		else{
			$breakpoint = intval( $breakpoint );
		}
		$args['container_class'].= ' ubermenu-responsive-'.$breakpoint;
	}

	//Responsive no collapse
	if( ubermenu_op( 'responsive_collapse' , $config_id ) == 'off' ){
		$args['container_class'].= ' ubermenu-responsive-nocollapse';
	}
	else{
		$args['container_class'].= ' ubermenu-responsive-collapse';
	}

	//Orientation
	$orientation = ubermenu_op( 'orientation' , $config_id ) == 'vertical' ? 'vertical' : 'horizontal';
	$args['container_class'].= ' ubermenu-'.$orientation;

	//Transition
	$transition = ubermenu_op( 'transition' , $config_id );
	$args['container_class'].= ' ubermenu-transition-'.$transition;

	//Trigger
	$trigger = ubermenu_op( 'trigger' , $config_id );
	$args['container_class'].= ' ubermenu-trigger-'.$trigger;

	//Skin
	$skin = ubermenu_op( 'skin' , $config_id );
	$args['container_class'].= ' ubermenu-skin-'.$skin;
	$args['container_class'].= ' '._UBERMENU()->get_skin_classes( $skin );	//echo '[[['._UBERMENU()->get_skin_classes( $skin ).']]]';

	//Menu Bar Alignment
	$bar_align = ubermenu_op( 'bar_align' , $config_id );
	$args['container_class'].= ' ubermenu-bar-align-'.$bar_align;

	//Menu Item Alignment
	$items_align = ubermenu_op( 'items_align' , $config_id );
	$args['container_class'].= ' ubermenu-items-align-'.$items_align;

	//Menu Item Vertical Alignment
	// $items_align_vertical = ubermenu_op( 'items_align_vertical' , $config_id );
	// if( $items_align_vertical != 'bottom' ){
	// 	$args['container_class'].= ' ubermenu-items-align-'.$items_align_vertical;
	// }

	//Inner Menu Center
	if( ubermenu_op( 'bar_inner_center' , $config_id ) == 'on' ){
		$args['container_class'].= ' ubermenu-bar-inner-center';
	}

	//Submenu Bound
	if( ubermenu_op( 'bound_submenus' , $config_id ) == 'on' || ubermenu_op( 'orientation' , $config_id ) == 'vertical' ){
		$args['container_class'].= ' ubermenu-bound';
	}
	else if( ubermenu_op( 'bound_submenus' , $config_id ) == 'inner' ){
		$args['container_class'].= ' ubermenu-bound-inner';
	}

	//Submenu Scrolling
	if( $transition != 'slide' && ubermenu_op( 'submenu_scrolling' , $config_id ) != 'on' ){
		$args['container_class'].= ' ubermenu-disable-submenu-scroll';
	}


	//Force Current Submenus
	if( ubermenu_op( 'force_current_submenus' , $config_id ) == 'on' ){
		$args['container_class'].= ' ubermenu-force-current-submenu';
	}

	//Invert Submenus
	if( ubermenu_op( 'invert_submenus' , $config_id ) == 'on' ){
		$args['container_class'].= ' ubermenu-invert';
	}



	//Submenu Background Image Hiding
	if( ubermenu_op( 'submenu_background_image_reponsive_hide' , $config_id ) == 'on' ){
		$args['container_class'].= ' ubermenu-hide-bkgs';
	}

	//Responsive Collapse //responsive_collapse
	//$args['container_class'].= ' ubermenu-collapse';

	//Submenu Indicators
	if( ubermenu_op( 'display_submenu_indicators', $config_id ) == 'on' ){
		$args['container_class'].= ' ubermenu-sub-indicators';
	}

	//Submenu indicator alignment/position
	if( ubermenu_op( 'style_align_submenu_indicator' , $config_id ) == 'text' ){
		$args['container_class'].= ' ubermenu-sub-indicators-align-text';
	}

	//Retractors
	if( ubermenu_op( 'retractor_display_strategy' , 'general' ) == 'responsive' ){
		$args['container_class'].= ' ubermenu-retractors-responsive';
	}

	//Icon Display
	if( ubermenu_op( 'icon_display' , $config_id ) == 'inline' ){
		$args['container_class'].= ' ubermenu-icons-inline';
	}


	//Submenu indicator close button
	if( ubermenu_op( 'submenu_indicator_close_mobile' , 'general' ) !== 'off' ){
		$args['container_class'].= ' ubermenu-submenu-indicator-closes';
	}


	//Accessibility - handled in JS only now
	// if( ubermenu_op( 'accessible' , 'general' ) == 'on' ){
	// 	$args['container_class'].= ' ubermenu-accessible';
	// }

	//Don't allow class filtering
	if( ubermenu_op( 'disable_class_filtering' , 'general' ) == 'on' ) remove_all_filters( 'nav_menu_css_class' );

	//$args['container_class'].= ' ubermenu-pad-submenus';

	//Set the Current Instance for Reference
	_UBERMENU()->set_current_config( $config_id );

	return apply_filters( 'ubermenu_nav_menu_args' , $args , $config_id );
}

//add_filter( 'wp_nav_menu_container_allowedtags', 'ubermenu_allowed_nav_tags' );
function ubermenu_allowed_nav_tags( $tags ){
	$tags[] = 'nav role="navigation"';
	$tags[] = 'div role="navigation"';
	return $tags;
}

function ubermenu_fallback_cb( $args ){
	//up( $args );

	$notice = __( 'No menu to display.' , 'ubermenu' );

	if( isset( $args['theme_location'] ) ){
		$theme_location = $args['theme_location'];

		if( $theme_location == '__um_undetermined__' ){
			$instance = $args['uber_instance'];
			$notice .= ' Please either <a target="_blank" href="'.admin_url('themes.php?page=ubermenu-settings#ubermenu_'.$instance ).'">assign a default menu to the <strong>'.$instance.'</strong> menu instance</a>, or pass it a Menu ID via the API';
		}
		else{
			$locs = get_registered_nav_menus();
			if( isset( $locs[$theme_location] ) ){
				$theme_loc_name = $locs[$theme_location];
				$notice = 'Please <a target="_blank" href="'.admin_url( 'nav-menus.php?action=locations' ).'">assign a menu</a> to the <strong>'.$theme_loc_name.'</strong> theme location.';
			}
		}
	}

	ubermenu_admin_notice( $notice );
}


function ubermenu_get_menu_instance_by_theme_location( $theme_location ){

	//Check Main
	$auto_theme_locations = ubermenu_op( 'auto_theme_location' , 'main' );
	if( is_array( $auto_theme_locations ) ){
		foreach( $auto_theme_locations as $loc ){
			if( $theme_location == $loc ){
				return 'main';
			}
		}
	}


	//Check Instances
	$instances = ubermenu_get_menu_instances();

	foreach( $instances as $config_id ){
		$auto_theme_locations = ubermenu_op( 'auto_theme_location' , $config_id );

		if( is_array( $auto_theme_locations ) ){
			foreach( $auto_theme_locations as $loc ){
				if( $theme_location == $loc ){
					return $config_id;
				}
			}
		}
	}

	return false;
}

function ubermenu_automatic_integration_filter( $args ){
	//Only do auto-integrate if this menu hasn't already been handled
	if( !isset( $args['uber_integration_type'] ) ){
		$args = ubermenu_get_nav_menu_args( $args , 'auto' );
	}
	return $args;
}
add_filter( 'wp_nav_menu_args' , 'ubermenu_automatic_integration_filter' , 1000 );


function ubermenu_force_filter( $args ){

	if( ubermenu_op( 'force_filter' , 'general' ) == 'on' ){
		//For main UberMenus
		if( isset( $args['uber_integration_type'] ) ){
			$args = ubermenu_get_nav_menu_args( $args , $args['uber_integration_type'] , $args['uber_instance'] );
		}
		//For menu segments, replace altered arguments with original array
		else if( isset( $args['uber_segment'] ) ){
			if( isset( $args['uber_segment_args'] ) ) $args = $args['uber_segment_args'];
		}
	}
	return $args;
}
add_filter( 'wp_nav_menu_args' , 'ubermenu_force_filter' , 100000 );


function ubermenu_prevent_menu_item_class_filtering(){
	if( ubermenu_op( 'disable_class_filters' ) ){
		remove_all_filters( 'nav_menu_css_class' );
	}
}
//add_action( 'wp_head' , 'ubermenu_prevent_menu_item_class_filtering' );

function ubermenu_direct_injection_registration(){
	if( ubermenu_op( 'direct_inject' , 'main' ) == 'on' ){
		register_nav_menu( 'ubermenu-direct-inject' , __( 'UberMenu [Direct Injection]' , 'ubermenu' ) );
	}
}
add_action( 'init' , 'ubermenu_direct_injection_registration' );

function ubermenu_direct_injection(){
	if( ubermenu_op( 'direct_inject' , 'main' ) == 'on' ){
		if( has_nav_menu( 'ubermenu-direct-inject' ) ){
			ubermenu( 'main' , array( 'theme_location' => 'ubermenu-direct-inject' ) );
		}
		else{
			echo '<div class="ubermenu ubermenu-loc-ubermenu-direct-inject">';
			ubermenu_admin_notice( 'Please <a target="_blank" href="'.admin_url( 'nav-menus.php?action=locations' ).'">assign a menu</a> to the <strong>UberMenu [Direct Injection]</strong> theme location' );
			echo '</div>';
		}
	}
}
add_action( 'wp_footer' , 'ubermenu_direct_injection' );

function ubermenu_skipnav_filter( $nav_menu , $args ){
	//Add to UberMenu, ignore segments
	if( isset( $args->uber_instance ) && !isset( $args->uber_segment ) ){
	//up( $args );

		if( ubermenu_op( 'skip_navigation' , 'general' ) == 'on' ){

			$skipnav_target_id = $args->container_id.'-skipnav';

			$skipnav = '<a href="#'.$skipnav_target_id.'" class="ubermenu-skipnav ubermenu-sr-only ubermenu-sr-only-focusable">'.__( 'Skip Navigation', 'ubermenu' ).'</a>';

			$skipnav_target = '<span id="'.$skipnav_target_id.'"></span>';

			$nav_menu = $skipnav . $nav_menu . $skipnav_target;
		}
	}
	return $nav_menu;
}
add_filter( 'wp_nav_menu' , 'ubermenu_skipnav_filter' , 11, 2 );

function ubermenu_responsive_toggle_filter( $nav_menu , $args ){
	//Add to UberMenu, ignore segments
	if( isset( $args->uber_instance ) && !isset( $args->uber_segment ) ){
	//up( $args );

		$ubermenu_responsive = ubermenu_op( 'responsive' , $args->uber_instance ) == 'on';
		$ubermenu_responsive_toggle = ubermenu_op( 'responsive_toggle' , $args->uber_instance ) == 'on';

		if( $ubermenu_responsive && $ubermenu_responsive_toggle ){

			$toggle_content = ubermenu_op( 'responsive_toggle_content' , $args->uber_instance );
			$toggle_tag = ubermenu_op( 'responsive_toggle_tag' , $args->uber_instance );
			$toggle_content_align = ubermenu_op( 'responsive_toggle_content_alignment' , $args->uber_instance );
			$toggle_align = ubermenu_op( 'responsive_toggle_alignment' , $args->uber_instance );
			$toggle_close_icon = ubermenu_op( 'responsive_toggle_close_icon' , $args->uber_instance );
			$toggle_classes = ubermenu_op( 'responsive_collapse', $args->uber_instance ) == 'off' ? 'ubermenu-responsive-toggle-open' : '';
			$toggle_args = array(
				'toggle_content'	=> $toggle_content,
				'tag'				=> $toggle_tag,
				'content_align'		=> $toggle_content_align,
				'align'				=> $toggle_align,
				'close_icon'	=> $toggle_close_icon,
				'classes'			=> $toggle_classes,
			);
			if( isset( $args->theme_location ) ) $toggle_args['theme_location'] = $args->theme_location;
			$ubermenu_toggle = ubermenu_toggle( $args->container_id , $args->uber_instance , false , $toggle_args);

			$nav_menu = $ubermenu_toggle . $nav_menu;
		}
		else{
			$responsive_status = '';
			if( !$ubermenu_responsive_toggle ){
				$responsive_status.= '[UberMenu Responsive Toggle Disabled] ';
			}
			if( !$ubermenu_responsive ){
				$responsive_status.= '[UberMenu Responsive Menu Disabled] ';
			}
			if( $responsive_status ) $nav_menu = '<!-- '.$responsive_status.'--> '.$nav_menu;
		}
	}
	return $nav_menu;
}
add_filter( 'wp_nav_menu' , 'ubermenu_responsive_toggle_filter' , 10, 2 );


/*
 * Add HTML comments around menu, optionally add content before menu
 */
function ubermenu_before_wp_nav_menu( $nav_menu, $args ){

	if( isset( $args->uber_segment ) ) return $nav_menu; //Ignore segments

	if( isset( $args->uber_instance ) ){

		$theme_loc = isset( $args->theme_location ) ? $args->theme_location : '';

		$nav_menu = "\n<!-- UberMenu [Configuration:$args->uber_instance] [Theme Loc:$theme_loc] [Integration:$args->uber_integration_type] -->\n". $nav_menu . "\n<!-- End UberMenu -->\n";

		//uberp( $args );
		$config_id = $args->uber_instance;

		$before = $after = '';

		$before_content = ubermenu_op( 'content_before_nav' , $args->uber_instance );
		if( $before_content ){
			$before = '<!-- UberMenu Content Before -->';
			$before.= do_shortcode( $before_content );
			$before.= '<!-- End UberMenu Content Before -->';
		}

		$nav_menu = $before . $nav_menu . $after;

	}

	return $nav_menu;
}
add_filter( 'wp_nav_menu', 'ubermenu_before_wp_nav_menu' , 20 , 2 );






function ubermenu_get_post_parent_ops( $ops = array() ){

	if( ubermenu_op( 'autocomplete_disable', 'general' ) == 'on' ){
		$ops[999] = __( 'Autocomplete disabled in Control Panel.  Please enter ID manually' , 'ubermenu' );
		return $ops;
	}

	$post_types = get_post_types( array(
		'public'		=> true,
		'hierarchical' 	=> true,
	));

	$max_posts = ubermenu_op( 'autocomplete_max_post_results', 'general' );
	if( !$max_posts ) $max_posts = 100;


	$post_args = array(
		'post_type'	=> $post_types,
		'posts_per_page' => $max_posts,
	);

	//WPML
	if( defined('ICL_SITEPRESS_VERSION') ){
		$post_args['suppress_filters'] = false;
	}

	$posts = get_posts( $post_args );

	foreach( $posts as $post ){
		$ops[$post->ID] = $post->post_title;
	}

	return $ops;

}


function ubermenu_get_author_ops(){

	$ops = array();

	if( ubermenu_op( 'dynamic_authors_disable', 'general' ) == 'on' ){
		$ops[999] = __( '[Authors selection disabled via Control Panel]' , 'ubermenu' );
		return $ops;
	}

	$authors = get_users( array(
		'who'	=> 'authors'
	));;

	foreach( $authors as $author ){
		$ops[$author->ID] = $author->data->display_name;
		//up( $author->data->display_name , 2 );
	}

	return $ops;
}


function ubermenu_get_post_type_ops(){
	$post_types = get_post_types(
		array(
			'public'	=> true,
		),
		'objects'
	);

	unset( $post_types['attachment'] );

	$ops = array();
	//up( $post_types );
	foreach( $post_types as $id => $type ){
		$ops[$id] = $type->label;
	}
	return $ops;
}

function ubermenu_get_term_ops_by_tax( $tax , $ops = array() ){

	if( ubermenu_op( 'autocomplete_disable', 'general' ) == 'on' ){
		$ops[999] = __( 'Autocomplete disabled in Control Panel.  Please enter ID manually' , 'ubermenu' );
		return $ops;
	}

	if( !is_array( $tax ) ) $tax = array( $tax );

	$max_terms = ubermenu_op( 'autocomplete_max_term_results', 'general' ); //for performance
	if( !$max_terms ) $max_terms = 100;

	$terms = get_terms( $tax ,
		array(
			'number'	=> $max_terms,
			'hide_empty'=> false,
		));

	foreach( $terms as $id => $term ){
		$ops[$term->term_id] = $term->name;
	}

	return $ops;
}



function ubermenu_get_taxonomy_ops(){
	$taxonomies = get_taxonomies(
		array(
			'public'	=> true,
		),
		'objects'
	);

	$ops = array();

	foreach( $taxonomies as $id => $tax ){
		$ops[$id] = $tax->label;
	}

	return $ops;
}


function ubermenu_get_term_ops( $ops = array() ){
	//trigger_error( "Simulating Autocomplete memory exception" , E_USER_ERROR );
	if( ubermenu_op( 'autocomplete_disable', 'general' ) == 'on' ){
		$ops[999] = __( 'Autocomplete disabled in Control Panel.  Please enter ID manually' , 'ubermenu' );
		return $ops;
	}

	$taxonomies = ubermenu_get_taxonomies();

	$max_terms = ubermenu_op( 'autocomplete_max_term_results', 'general' ); //for performance
	if( !$max_terms ) $max_terms = 100;

	$terms = get_terms( $taxonomies ,
		array(
			'number'	=> $max_terms,
			'hide_empty'=> false,
		));

	//$ops = array();

	foreach( $terms as $id => $term ){
		$ops[$term->term_id] = $term->name;
	}

	/* Stress Test
	for( $k = count( $terms )+1 ; $k < count( $terms ) + 1000 ; $k ++ ){
		if( $k % 6 == 0 ){
			$ops[$k] = 'Frogs';
		}
		else if( $k % 5 == 0 ){
			$ops[$k] = 'Lions';
		}
		else if( $k % 4 == 0 ){
			$ops[$k] = 'Aardvarks';
		}
		else if( $k % 3 == 0 ){
			$ops[$k] = 'Antelope';
		}
		else if( $k % 2 == 0 ){
			$ops[$k] = 'Puppies';
		}
		else $ops[$k] = 'Cat'.$k;
	}
	*/

	return $ops;
}

function ubermenu_get_taxonomies(){
	return get_taxonomies(
		array(
			'public'	=> true,
		)
	);
}


function ubermenu_get_image( $img_id = false , $post_id = false , $data = false , $args = array() ){

	extract( wp_parse_args( $args , array(
		'img_size'		=> 'inherit',
		'img_w'			=> '',
		'img_h'			=> '',
		'default_img' 	=> false,
	)));

	$config_id = _UBERMENU()->get_current_config();


	//Image
	$img = '';

	//If post is set, but img is not, get featured image
	if( !$img_id && $post_id ){
		$thumb_id = get_post_thumbnail_id( $post_id );
		if( $thumb_id ) $img_id = $thumb_id;
	}

	if( !$img_id ){
		$img_id = $default_img;
	}

	if( $img_id ){
		$atts = array();

		$atts['class'] = 'ubermenu-image';

		//Determine size of image to get
		if( $img_size == 'inherit' ){
			$img_size = ubermenu_op( 'image_size' , $config_id );
		}

		//echo '['.$img_size.']';
		$atts['class'].= ' ubermenu-image-size-'.$img_size;

		//Get the reight image file
		$img_src = wp_get_attachment_image_src( $img_id , $img_size );
		$atts['src']	= $img_src[0];



		//Apply natural dimensions if not already set
		if( ubermenu_op( 'image_set_dimensions' , $config_id ) ){
			if( $img_w == '' && $img_h == '' ){
				$img_w = $img_src[1];
				$img_h = $img_src[2];
			}
		}

		//Default dimensions if not natural
		if( !$img_w ){
			$img_w = ubermenu_op( 'image_width' , $config_id );
			$img_h = ubermenu_op( 'image_height' , $config_id );
		}



		//Add dimensions as attributes, with pixel units if missing
		if( $img_w ){
			//if( is_numeric( $img_w ) ) $img_w.='px';	//Should always be numeric only, no units
			$atts['width']	= $img_w;
		}
		if( $img_h ){
			//if( is_numeric( $img_h ) ) $img_h.='px';	//Should always be numeric only, no units
			$atts['height'] = $img_h;
		}

		//Add 'alt' & 'title'
		$meta = get_post_custom( $img_id );
		$alt = isset( $meta['_wp_attachment_image_alt'] ) ? $meta['_wp_attachment_image_alt'][0] : '';	//Alt field
		$title = '';

		if( $alt == '' ){
			$title = get_the_title( $img_id );
			$alt = $title;
		}
		$atts['alt'] = $alt;

		if( ubermenu_op( 'image_title_attribute' , $config_id ) == 'on' ){
			if( $title == '' ) $title = get_the_title( $img_id );
			$atts['title'] = $title;
		}

		//Build attributes string
		$attributes = '';
		foreach( $atts as $name => $val ){
			$attributes.= $name . '="'. esc_attr( $val ) .'" ';
		}

		$img = "<img $attributes />";
		//$img = "<span class='ubermenu-image'><img $attributes /></span>";

		if( $data ){
			$data = array();
			$data['img'] = $img;
			$data['w']	= $img_w;
			$data['h']	= $img_h;
			$data['atts'] = $atts;
			return $data;
		}
	}

	return $img;
}

function ubermenu_item_save_inherit_featured_image( $item_id , $setting , $val , &$saved_settings ){

	if( $val == 'cache' ){

		//Determine Featured Image
		$post_id = get_post_meta( $item_id , '_menu_item_object_id' , true );
		$thumb_id = get_post_thumbnail_id( $post_id );

		//Assign Featured Image
		$saved_settings['item_image'] = $thumb_id;
		update_post_meta( $item_id , UBERMENU_MENU_ITEM_META_KEY , $saved_settings );

	}
}


function ubermenu_display_retractors(){
	//echo ubermenu_op( 'retractor_display_strategy' , 'general' );
	switch( ubermenu_op( 'retractor_display_strategy' , 'general' ) ){
		case 'responsive':
			return true;
		case 'mobile':
			return ubermenu_is_mobile( 'display_retractors' );
		case 'touch':
			return true;
		default:
			return true;
	}
	return true;
}


function ubermenu_is_mobile( $scenario = false ){
	return apply_filters( 'ubermenu_is_mobile' , wp_is_mobile() , $scenario );
}


/** Term Splitting in WordPress 4.2 **/
add_action( 'split_shared_term', 'ubermenu_split_shared_term', 10, 4 );
function ubermenu_split_shared_term( $term_id, $new_term_id, $term_taxonomy_id, $taxonomy ){
	global $wpdb;
	$uber_meta = $wpdb->get_results(
		$wpdb->prepare( "SELECT post_id , meta_value FROM $wpdb->postmeta where meta_key = %s AND meta_value IN( %s , %s )", '_ubermenu_custom_item_type' , 'dynamic_terms' , 'dynamic_posts' )
	);

	//echo count( $uber_meta );

	foreach( $uber_meta as $meta ){
		$meta->post_id;
		//$meta->meta_value; //dynamic_terms or dynamic_posts

		$m = get_post_meta( $meta->post_id , UBERMENU_MENU_ITEM_META_KEY , true );

		if( $meta->meta_value == 'dynamic_terms' ){

			$update = false;

			//Only if $taxonomy is checked
			if( isset( $m['dt_taxonomy'] ) && in_array( $taxonomy , $m['dt_taxonomy'] ) ){

				if( isset( $m['dt_parent'] ) && $m['dt_parent'] ){
					if( $m['dt_parent'] == $term_id ){
						$m['dt_parent'] = $new_term_id;
						$update = true;
					}
				}
				if( isset( $m['dt_child_of'] ) && $m['dt_child_of'] ){
					if( $m['dt_child_of'] == $term_id ){
						$m['dt_child_of'] = $new_term_id;
						$update = true;
					}
				}
				if( isset( $m['dt_exclude'] ) && $m['dt_exclude'] ){
					$exclude_list = explode( ',' , $m['dt_exclude'] );
					if( in_array( $term_id , $exclude_list ) ){
						foreach( $exclude_list as $k => $val ){
							if( $val == $term_id ){
								$exclude_list[$k] = $new_term_id;
							}
						}
						$m['dt_exclude'] = implode( ',' , $exclude_list );
						$update = true;
					}
				}

				if( $update ){
					update_post_meta( $meta->post_id , UBERMENU_MENU_ITEM_META_KEY , $m );
					//uberp( $m , 3 );
				}
			}
		}
		else if( $meta->meta_value == 'dynamic_posts' ){

			//just check dp_{$taxonomy}
			$tax_setting = 'dp_'.$taxonomy;
			if( isset( $m[$tax_setting] ) && $m[$tax_setting]){
				if( $m[$tax_setting] == $term_id ){
					$m[$tax_setting] = $new_term_id;
					update_post_meta( $meta->post_id , UBERMENU_MENU_ITEM_META_KEY , $m );
					//uberp( $m , 3 );
				}
			}

		}

	}
}

//Term Split Tests
//do_action( 'split_shared_term', 100 , 200 , 300 , 'location' );
//do_action( 'split_shared_term', 50 , 150 , 250 , 'category' );





/* Allow HTML descriptions */
/* Off by default because it will fill all descriptions with the post content.
remove_filter( 'nav_menu_description', 'strip_tags' );
add_filter( 'wp_setup_nav_menu_item', 'ubermenu_allow_description_html' );
function ubermenu_allow_description_html( $menu_item ) {
     $menu_item->description = apply_filters( 'nav_menu_description', $menu_item->post_content );
     return $menu_item;
}
*/



/** Admin Notices **/
function ubermenu_user_is_admin(){
	return current_user_can( 'manage_options' );
}

function ubermenu_admin_notice( $content , $echo = true ){
	//$showtips = false;

	if( ubermenu_op( 'admin_notices' , 'general' ) == 'on' ){
		if( ubermenu_user_is_admin() ){
			$notice = '<div class="ubermenu-admin-notice"><i class="ubermenu-admin-notice-icon fas fa-lightbulb"></i>'.$content.'</div>';

			if( $echo ) echo $notice;
			return $notice;
		}
	}

}
function ubermenu_is_pro(){
	if( !defined( 'UBERMENU_PRO' ) ){
		return false;
	}
	if( !UBERMENU_PRO ){
		return false;
	}

	//We're in pro, now check for Lite Mode
	//We don't use ubermenu_op because that function needs to check this function
	//when getting defaults, so it would create an infinite loop and the universe would implode
	$general_settings = get_option( UBERMENU_PREFIX.'general' , false );

	//No settings, Pro Mode
	if( $general_settings === false ){
		return true;
	}
	if( isset( $general_settings['lite_mode'] ) ){
		//If lite mode, pro is false
		if( $general_settings['lite_mode']  == 'on' ){
			return false;
		}
	}
	return true;
}



function ubermenu_get_support_url(){
	return _UBERMENU()->get_support_url();
}

// function ubermenu_get_support_url(){
// 	$url = UBERMENU_SUPPORT_URL;

// 	$data = array();

// 	$data['src']			= 'ubermenu_plugin';
// 	$data['product_id']		= 1;

// 	//Site Data
// 	$data['site_url'] 		= get_site_url();
// 	$data['version']		= UBERMENU_VERSION;
// 	$data['timezone']		= get_option('timezone_string');

// 	//Theme Data
// 	$theme = wp_get_theme();
// 	//uberp( $theme , 3 );
// 	$data['theme']			= $theme->get( 'Name' );
// 	$data['theme_link']		= '<a target="_blank" href="'.$theme->get( 'ThemeURI' ).'">'. $theme->get( 'Name' ). ' v'.$theme->get( 'Version' ).' by ' . $theme->get( 'Author' ).'</a>';
// 	$data['theme_slug']		= isset( $theme->stylesheet ) ? $theme->stylesheet : '';
// 	$data['theme_parent']	= $theme->get( 'Template' );

// 	//User Data
// 	$current_user = wp_get_current_user();
// 	if( $current_user ){
// 		if( $current_user->user_firstname ){
// 			$data['first_name']		= $current_user->user_firstname;
// 		}
// 		if( $current_user->user_firstname ){
// 			$data['last_name']		= $current_user->user_lastname;
// 		}
// 		if( $current_user ){
// 			$data['email']			= $current_user->user_email;
// 		}
// 	}
// 	//$data['email']			= get_bloginfo( 'admin_email' );


// 	//License Data
// 	if( $license_code = ubermenu_op( 'purchase_code' , 'updates' ) ){
// 		$data['license_code']	= $license_code;
// 	}
// 	if( $envato_username = ubermenu_op( 'envato_username' , 'updates' ) ){
// 		$data['envato_username'] = $envato_username;
// 	}

// 	$query = http_build_query( $data );

// 	return "$url?$query";
// }


/** DEBUGGING **/


function uberp( $d , $depth = 1 ){
	echo '<pre>';
	//print_r( $d );
	echo UMVarDumper::dump( $d , $depth );
	echo '</pre>';
}

class UMVarDumper
{
        private static $_objects;
        private static $_output;
        private static $_depth;

        /**
         * Converts a variable into a string representation.
         * This method achieves the similar functionality as var_dump and print_r
         * but is more robust when handling complex objects such as PRADO controls.
         * @param mixed variable to be dumped
         * @param integer maximum depth that the dumper should go into the variable. Defaults to 10.
         * @return string the string representation of the variable
         */
        public static function dump($var,$depth=10,$highlight=false)
        {
                self::$_output='';
                self::$_objects=array();
                self::$_depth=$depth;
                self::dumpInternal($var,0);
                if($highlight)
                {
                        $result=highlight_string("<?php\n".self::$_output,true);
                        return preg_replace('/&lt;\\?php<br \\/>/','',$result,1);
                }
                else
                        return self::$_output;
        }

        private static function dumpInternal($var,$level)
        {
                switch(gettype($var))
                {
                        case 'boolean':
                                self::$_output.=$var?'true':'false';
                                break;
                        case 'integer':
                                self::$_output.="$var";
                                break;
                        case 'double':
                                self::$_output.="$var";
                                break;
                        case 'string':
                                self::$_output.="'$var'";
                                break;
                        case 'resource':
                                self::$_output.='{resource}';
                                break;
                        case 'NULL':
                                self::$_output.="null";
                                break;
                        case 'unknown type':
                                self::$_output.='{unknown}';
                                break;
                        case 'array':
                                if(self::$_depth<=$level)
                                        self::$_output.='array(...)';
                                else if(empty($var))
                                        self::$_output.='array()';
                                else
                                {
                                        $keys=array_keys($var);
                                        $spaces=str_repeat(' ',$level*4);
                                        self::$_output.="array\n".$spaces.'(';
                                        foreach($keys as $key)
                                        {
                                                self::$_output.="\n".$spaces."    [$key] => ";
                                                self::$_output.=self::dumpInternal($var[$key],$level+1);
                                        }
                                        self::$_output.="\n".$spaces.')';
                                }
                                break;
                        case 'object':
                                if(($id=array_search($var,self::$_objects,true))!==false)
                                        self::$_output.=get_class($var).'#'.($id+1).'(...)';
                                else if(self::$_depth<=$level)
                                        self::$_output.=get_class($var).'(...)';
                                else
                                {
                                        $id=array_push(self::$_objects,$var);
                                        $className=get_class($var);
                                        $members=(array)$var;
                                        $keys=array_keys($members);
                                        $spaces=str_repeat(' ',$level*4);
                                        self::$_output.="$className#$id\n".$spaces.'(';
                                        foreach($keys as $key)
                                        {
                                                $keyDisplay=strtr(trim($key),array("\0"=>':'));
                                                self::$_output.="\n".$spaces."    [$keyDisplay] => ";
                                                self::$_output.=self::dumpInternal($members[$key],$level+1);
                                        }
                                        self::$_output.="\n".$spaces.')';
                                }
                                break;
                }
        }
}

//Usage:
//$profiler = new UMProfiler();	//before
//$profiler->output( "Name of Object" );  //after

class UMProfiler{

	var $mem_before;
	var $mem_peak_before;
	var $mem_after;
	var $mem_peak_after;
	var $mem_diff;
	var $mem_peak_diff;


	function __construct(){
		$this->mem_before = memory_get_usage();
		$this->mem_peak_before = memory_get_peak_usage();
	}

	function terminate(){
		$this->mem_after = memory_get_usage();
		$this->mem_peak_after = memory_get_peak_usage();

		$this->mem_diff = $this->mem_after - $this->mem_before;
		$this->mem_peak_diff = $this->mem_peak_after - $this->mem_peak_before;


	}

	function output( $label , $threshold = 0 ){

		$this->terminate();

		if( !current_user_can( 'manage_options' ) ) return;

		if( $this->mem_peak_diff >= $threshold ){

			echo '<div class="profiler-item">'.$label.'</div>';
			echo '<div class="profiler-data">';

			if( $this->mem_peak_diff > 0 ){
				echo '<div class="profiler-data-segment">';
				echo '[Peak: ' .umbytes( $this->mem_peak_diff ) .']';
				echo '</div>';

				echo '<div class="profiler-data-segment">';
				echo '[Net: ' . umbytes( $this->mem_diff ) .']';
				echo '</div>';
			}
			else{
				echo '[Peak: 0]';
			}


			global $_bytes; //, $_bytes_peak;
			//$_bytes_peak+= $this->mem_peak_diff;
			$_bytes+= $this->mem_diff;
			echo '<div class="profiler-data-segment">Total: ' . umbytes( $_bytes ).'</div>';
			echo '<div class="profiler-data-segment">Peak: ' . umbytes( $this->mem_peak_after ).'</div>';

			echo '</div>';
		}

	}
}

function umbytes($size, $precision = 2){
	$base = log($size) / log(1024);
	$suffixes = array('', 'k', 'M', 'G', 'T');
	return round(pow(1024, $base - floor($base)), $precision) . $suffixes[floor($base)];
}




/*
 * Add compatibility with Conditional Menus by Themify
 */
add_filter( 'conditional_menus_theme_location', 'ubermenu_restore_conditional_menus_theme_location' , 10 , 3 );
function ubermenu_restore_conditional_menus_theme_location( $theme_loc , $new_menu, $args ){
   //uberp( $args );
   return $args['theme_location'];
}




/*
 * The strategy is to find all the UberMenu items, remove them, and move their children up a level
 *
 * 1. Make a map of parent > child relationships
 * 2. Determine which items are UberMenu advanced items.
 *    - Take the children of these items, and change their parent IDs to that of the UberMenu item
 *    - Mark the UberMenu item for deletion by recording their index
 * 3. Remove the UberMenu items by unsetting their indexes.
 *    - We can't do it simultaneuously in step 2, as that would alter the index and break the algorithm
 *
 * Note: if there is an UberMenu top level item with children, all those children will become top level items
 *    - One option would be to have a "disable child items that would become top level items" setting.
 */
function ubermenu_exclude_advanced_items( $sorted_menu_items, $args ) {

//uberp( $sorted_menu_items , 3 );

  if( is_admin() ) return $sorted_menu_items;

  //Ignore UberMenu and ShiftNav
  if( isset( $args->uber_instance ) ||
			isset( $args->shiftnav ) ){
    return $sorted_menu_items;
  }

  //uberp( $items ,3 );
  $items = $sorted_menu_items;
  //uberp( $args );

  $child_map = array(); //$parent => array of children

  //First we have to track parents
  foreach ( $items as $index => $item ) {
    $parent_id = $item->menu_item_parent;
    $item_id = $item->ID;

    if( !isset( $child_map[$parent_id] ) ){
      $child_map[$parent_id] = array();
    }
    $child_map[$parent_id][] = array( 'id'  => $item_id , 'index' => $index );
  }

  //uberp( $child_map , 3 );

  $index_trash = array();

  //Now search for UberMenu items, but keep all the indexes intact
  foreach ( $items as $index => $item ) {
    if( $item->object == 'ubermenu-custom' ){

      //Does this item have children?
      if( isset( $child_map[$item->ID] ) ){
        //Send the kiddos to grandma's house
        foreach( $child_map[$item->ID] as $k => $child_data ){
          //Update items
          $items[$child_data['index']]->menu_item_parent = $item->menu_item_parent;
          //Update child map - no, if we do that we break this loop
          //$child_map[$item->menu_item_parent]
        }
      }

      //Keep track of indexes to unset
      $index_trash[] = $index;
      //unset( $items[$key] );
    }
  }

  //Finally, remove all items that are from UberMenu
  foreach( $index_trash as $k => $index ){
    unset( $items[$index] );
  }


  //uberp( $item );
    //if ( $item->object_id == 168 ) unset( $items[$key] );

  return $items;
}



/* Theme Template Backtrace */
add_action( 'wp' , function() {
	if( current_user_can( 'manage_options' ) && ubermenu_op( 'theme_template_backtrace' , 'general' ) === 'on' ){
		add_filter( 'wp_nav_menu' , 'ubermenu_theme_template_backtrace' , 100 , 2 );
	}
});

function ubermenu_theme_template_backtrace( $nav_menu , $args ){
  if( !isset( $args->uber_segment ) ){ //ignore menu segments
      //uberp( $args );
      $backtrace = debug_backtrace();
      //uberp( $backtrace , 3 );


      $html = '<strong>Theme Template Backtrace: wp_nav_menu() call</strong><ul>';
      foreach( $backtrace as $step ){
        if( $step['file'] && strpos( $step['file'] , 'wp-content/themes' ) !== false ){
          $html.= '<li>'.$step['file'].'</li>';
        }
      }
      $html.= '</ul>';

      ubermenu_admin_notice( $html );
  }
  return $nav_menu;
}
