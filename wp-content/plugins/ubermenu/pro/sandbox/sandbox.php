<?php
function ubermenu_sandbox_url(){
  return site_url( '?ubermenu-sandbox=_' );
}
function ubermenu_sandbox_rewrites() {
    add_rewrite_rule( '^ubermenu-sandbox/?', 'index.php?ubermenu-sandbox=main', 'top' );
}
add_action( 'init', 'ubermenu_sandbox_rewrites' );

function ubermenu_sandbox_query_vars( $vars ) {
  $vars[] = 'ubermenu-sandbox';
  return $vars;
}
add_filter( 'query_vars', 'ubermenu_sandbox_query_vars' );

function ubermenu_sandbox_standalone_path( $wp_query ) {

  if( !function_exists( 'wp_get_current_user' ) ) return; // something is calling this too early

  //Admins only
  if( !current_user_can( 'manage_options' ) ){
    return;
  }


  if ( $wp_query->is_main_query() && get_query_var( 'ubermenu-sandbox', false ) ) {

    //Gotta clear out the custom prefix and re-register the non-prefixed styles if there is a prefix set
    if( ubermenu_op( 'custom_prefix' , 'general' ) ){
      add_filter( 'ubermenu_op' , 'ubermenu_sandbox_eliminate_prefix' , 10 , 3 );
      add_action( 'wp_head' , 'ubermenu_sandbox_eliminate_prefix_customizer_styles' );
      _UBERMENU()->deregister_skins();
      ubermenu_register_skins();
      ubermenu_register_skins_pro();
      if( function_exists( 'ubermenu_skins_flat_register_ubermenu_skins' ) ){
        ubermenu_skins_flat_register_ubermenu_skins(); //TODO make this more generic to work with any skins pack
      }
    }

    ubermenu_sandbox_load_assets();

    add_action('wp_print_scripts', 'ubermenu_sandbox_remove_all_scripts', 999 );
    add_action('wp_print_styles', 'ubermenu_sandbox_remove_all_styles', 999);

    ubermenu_sandbox_interface();

  }
}
add_action( 'parse_query', 'ubermenu_sandbox_standalone_path' );


function ubermenu_sandbox_interface(){

  $config = get_query_var( 'ubermenu-sandbox' );
  //stylesheet

  //script

?>
<!doctype html>
<html>
  <head>
    <title>UberMenu Sandbox Viewer (Alpha)</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php

    wp_head();
    ?>
  </head>
  <body>
    <div class="container">
      <h1>UberMenu Sandbox (Alpha) <a target="_blank" title="Click to learn more" href="https://sevenspark.com/docs/ubermenu-3/sandbox">?</a></h1>

      <form id="ubermenu-sandbox-preview-form">

        <div class="ums-form-group ums-form-group-assign">
          <label class="ums-form-group-label">Assign menu by</label>
          <label><input type="radio" name="assignment" value="menu" /> Menu</label>
          <label><input type="radio" name="assignment" value="theme_location" checked /> Theme Location</label>
        </div>

        <div class="ums-form-group  ums-form-group-menu ums-form-group-disabled">
          <label class="ums-form-group-label">Menu</label>
          <select>
            <?php
            $menus = get_terms('nav_menu');
            foreach( $menus as $menu ){
              echo "<option value='$menu->term_id'>$menu->name</option>";
            }
            ?>
          </select>
        </div>

        <div class="ums-form-group ums-form-group-theme_loc">
          <label class="ums-form-group-label">Theme Location</label>
          <?php
          $menus = get_registered_nav_menus();
          if( empty( $menus ) ){
            echo 'no registerd theme locations';
          }
          else{
            ?>
            <select>
              <?php
              foreach ( $menus as $location => $description ) {
                echo "<option value='$location'>$description [$location]</option>";
              }
              ?>
            </select>
            <?php
          }
          ?>
        </div>

        <div class="ums-form-group ums-form-group-config">
          <label class="ums-form-group-label">UberMenu Configuration</label>
          <select>
            <option value="main">Main UberMenu Configuration</option>
            <?php
              $configs = ubermenu_get_menu_instances(false);
              foreach( $configs as $_config ){
                ?>
                  <option value="<?php echo $_config; ?>">+<?php echo $_config; ?></option>
                <?php
              }
              ?>
          </select>
        </div>

        <input type="hidden" name="ubermenu-sandbox" value="main" />

        <div class="ums-form-group ums-form-group-config">
          <label class="ums-form-group-label">View result</label>
          <button>View Menu</button>
        </div>

      </form>

      <div id="ubermenu-sandbox-menu-preview">
        <div class="ums-hint">Select options above to load a menu preview</div>
        <?php
          //ubermenu( $config , array( 'theme_location' => 'primary' ) );
        ?>
      </div>

    </div>

    <div class="loading">
      <div class="sk-folding-cube">
        <div class="sk-cube1 sk-cube"></div>
        <div class="sk-cube2 sk-cube"></div>
        <div class="sk-cube4 sk-cube"></div>
        <div class="sk-cube3 sk-cube"></div>
      </div>
    </div>

  <?php

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

    wp_enqueue_script( 'google-maps', $gmaps_uri , array( 'jquery' ), null , true );

    wp_print_footer_scripts();

  ?>

  </body>
  </html>

<?php
exit;
}


function ubermenu_sandbox_load_assets(){

  // ubermenu_load_assets();
  // ubermenu_pro_load_assets();


  wp_enqueue_style( 'ubermenu-sandbox' , UBERMENU_URL . '/pro/sandbox/sandbox.css' );
  wp_enqueue_script( 'ubermenu-sandbox' , UBERMENU_URL . '/pro/sandbox/sandbox.js' , array( 'jquery' ) , UBERMENU_VERSION, true );
  wp_localize_script( 'ubermenu-sandbox', 'ubermenu_sandbox_ajax', array(
      'ajax_url' => admin_url( 'admin-ajax.php' ),
      'security' => wp_create_nonce( 'ubermenu-sandbox' ),
    )
  );


}

/*
 * Remove all JS that isn't UberMenu
 */
function ubermenu_sandbox_remove_all_scripts() {
    global $wp_scripts;
    //uberp($wp_scripts->queue);
    foreach( $wp_scripts->queue as $i => $script ){
      //if( $script == 'google-maps' ) continue;
      if( strpos( $script , 'ubermenu' ) !== 0 ){
        unset( $wp_scripts->queue[$i] );
        //echo $script."<br/>";
      }
    }
    //uberp($wp_scripts->queue);
    //$wp_scripts->queue = array();
}


/*
 * Remove all CSS that isn't UberMenu
 */
function ubermenu_sandbox_remove_all_styles() {
    global $wp_styles;
    //uberp($wp_styles->queue);
    foreach( $wp_styles->queue as $i => $sheet ){
      if( strpos( $sheet , 'ubermenu' ) !== 0 ){
        unset( $wp_styles->queue[$i] );
      }
    }
    //uberp($wp_styles->queue);
    //$wp_styles->queue = array();

}

function ubermenu_sandbox_eliminate_prefix( $val , $option , $section ){
  if( $section == 'general' && $option == 'custom_prefix' ){
    $val = '';
  }
  return $val;
}

function ubermenu_sandbox_eliminate_prefix_customizer_styles(){
  echo '<style>'.ubermenu_generate_custom_styles().'</style>';
}



//AJAX

add_action( 'wp_ajax_ubermenu_sandbox_preview', 'ubermenu_sandbox_preview' );

function ubermenu_sandbox_preview() {

  check_ajax_referer( 'ubermenu-sandbox' , 'security' );

  $assign = isset( $_POST['assign'] ) ? sanitize_text_field( $_POST['assign'] ) : '';
  $menu = isset( $_POST['menu'] ) ? sanitize_text_field( $_POST['menu'] ) : '';
  $theme_loc = isset( $_POST['theme_location'] ) ? sanitize_text_field( $_POST['theme_location'] ) : '';
  $config = isset( $_POST['config'] ) ? sanitize_text_field( $_POST['config'] ) : '';

  $args = array();
  switch( $assign ){
    case 'menu' :
      $args['menu'] = $menu;
      break;
    case 'theme_location':
      $args['theme_location'] = $theme_loc;
      break;

  }
  ubermenu( $config , $args );

	wp_die(); // this is required to terminate immediately and return a proper response
}
