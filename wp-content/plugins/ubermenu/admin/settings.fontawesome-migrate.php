<?php
function ubermenu_fa4_to_fa5_panel(){

	?>
	<div class="wrap ubermenu-wrap">

		<?php settings_errors(); ?>

		<h2><strong>UberMenu</strong> Font Awesome 4 to 5 Migration <span class="ubermenu-version">v<?php echo UBERMENU_VERSION; ?></span></h2>

    <?php //The actual update
    if( isset( $_GET['convert'] ) ){
      ubermenu_update_fa4_icon_classes();
    }
    else{
      //Update check - search the DB for FA4 icons
      ubermenu_check_fa4_icon_update();
    }
    ?>


		<br/>
		<br/>

		<?php ubermenu_admin_back_to_settings_button(); ?>

	</div>
	<?php
}

function ubermenu_check_fa4_icon_update(){
  $icons = ubermenu_find_fa4_icon_classes();
  if( count( $icons ) ){

    ?>
    <form>
      <input type="hidden" name="page" value="ubermenu-settings" />
      <input type="hidden" name="do" value="fa4_to_fa5" />
      <input type="hidden" name="convert" value="fa4_to_fa5" />
      <?php wp_nonce_field( 'ubermenu-control-panel-do' , 'ubermenu_nonce' ); ?>

      <br/>

      <input class="button button-primary" type="submit" value="Convert Font Awesome 4 Icons to Font Awesome 5" />
    </form>
    <?php

    echo '<p>'.__( 'The following Font Awesome 4 icons have been found and will be updated as displayed below.  Please click the button above to begin the conversion process.' , 'ubermenu' ).'</p>';
    ubermenu_icons_conversion_table( $icons );
  }
  else{
    echo '<p>'.__('No icon conversions necessary', 'ubermenu' ).'</p>';
  }
}


function ubermenu_icons_conversion_table( $icons ){
  echo "<table class='ubermenu-table'><tr><th>".__('Menu Item', 'ubermenu' )."</th><th>".__('Font Awesome 4', 'ubermenu' )."</th><th>".__('Font Awesome 5', 'ubermenu' )."</th><th></th></tr>";
  foreach( $icons as $item_id => $icon_data ){
    extract($icon_data);
    echo "<tr><td>$item_id</td><td>$fa4</td><td>$fa5</td><td><i class='$fa5'</td></tr>";
  }
  echo "</table>";
}


function ubermenu_find_fa4_icon_classes(){
	//Gather all UberMenu menu item meta settings
  $metas = ubermenu_get_meta_value_by_key( UBERMENU_MENU_ITEM_META_KEY , 3000 ); //Limit to 3000 menu items for sanity

  $icons = array();

  //For each menu item
  foreach( $metas as $meta ){

		//Get the menu item ID and its settings as an array
    $menu_item_id = $meta->post_id;
    $menu_item_settings = unserialize($meta->meta_value);

    //If an icon is set on this menu item, process it
    if( isset( $menu_item_settings['icon'] ) && $menu_item_settings['icon'] ){

      //Find out the new class for this icon
      $new_icon_class = ubermenu_fa5_convert( $menu_item_settings['icon'] , false );

      //If the icon class has changed (it always has, because of new prefixes), update it
      if( $new_icon_class ){
        //echo '['.$menu_item_id . ' :: ' .$menu_item_settings['icon'] . '::' . $new_icon_class . ']'. '<br/>';
        $icons[$menu_item_id] = array( 'fa5' => $new_icon_class , 'fa4' => $menu_item_settings['icon'] );
      }
    }
  }

  return $icons;
}
function ubermenu_update_fa4_icon_classes(){

  //Gather all UberMenu menu item meta settings
  $metas = ubermenu_get_meta_value_by_key( UBERMENU_MENU_ITEM_META_KEY , 3000 ); //Limit to 3000 menu items for sanity
  $icons = array();

  //For each menu item
  foreach( $metas as $meta ){

		//Get the menu item ID and its settings as an array
    $menu_item_id = $meta->post_id;
    $menu_item_settings = unserialize($meta->meta_value);

    //If an icon is set on this menu item, process it
    if( isset( $menu_item_settings['icon'] ) && $menu_item_settings['icon'] ){

      //Find out the new class for this icon
      $new_icon_class = ubermenu_fa5_convert( $menu_item_settings['icon'] , false );

      //If the icon class has changed (it always has, because of new prefixes), update it
      if( $new_icon_class ){
        //echo '['.$menu_item_id . ' :: ' .$menu_item_settings['icon'] . '::' . $new_icon_class . ']'. '<br/>';

        $icons[$menu_item_id] = array( 'fa5' => $new_icon_class , 'fa4' => $menu_item_settings['icon'] );

        $menu_item_settings['icon_fa4'] = $menu_item_settings['icon']; // Save off the old value just in case
        $menu_item_settings['icon'] = $new_icon_class; // set the new icon class

				//uberp($menu_item_settings);
        update_post_meta( $menu_item_id , UBERMENU_MENU_ITEM_META_KEY , $menu_item_settings ); //update the settings for this menu item

        $count++;
      }
    }
  }

  echo '<p>'.__( 'Conversion results' , 'ubermenu' ).'</p>';
  if( count( $icons ) ){
    echo '<h3><i class="fas fa-check"></i> '.count( $icons ) . ' '.__('Icons Updated').':</h3>';
    ubermenu_icons_conversion_table( $icons );
  }
  else{
    echo '<h3>'.__( 'No icons found to update' , 'ubermenu' ).'</h3>';
  }
  //add_settings_error( 'ubermenu-fa4tofa5' , 'conversion-complete' , $count .' icons updated' , 'updated' );
}
//add_action( 'wp_head' , 'test_um_update_fa4icons' );
function test_um_update_fa4icons(){
	ubermenu_update_fa4_icon_classes();
}
