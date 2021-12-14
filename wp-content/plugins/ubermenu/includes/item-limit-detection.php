<?php

add_action( 'admin_notices',  'ubermenu_item_limit_notice' );

function ubermenu_count_menu_post_vars() {

	if( isset( $_POST['save_menu'] ) ){
		$count = 0;
		foreach( $_POST as $key => $arr ){
			//$count+= count( $arr );
			if( is_array( $arr ) ){
				$count+= count( $arr );
			}
			else $count++;
		}
		update_option( 'ubermenu-post-var-count' , $count );
	}
	else{
		$count = get_option( 'ubermenu-post-var-count' , 0 );
	}

	return $count;
}

function ubermenu_item_limit_notice(){

	$screen = get_current_screen();
	if( $screen->id != 'nav-menus' ) return;

	$var_count = ubermenu_count_menu_post_vars();

	//$var_count = 4900;

	$r = array(); //restrictors

	$r['suhosin_post_maxvars'] = ini_get( 'suhosin.post.max_vars' );
	$r['suhosin_request_maxvars'] = ini_get( 'suhosin.request.max_vars' );
	$r['max_input_vars'] = ini_get( 'max_input_vars' );


	//$r['max_input_vars'] = 1355;

	if( $r['suhosin_post_maxvars'] != '' ||
		$r['suhosin_request_maxvars'] != '' ||
		$r['max_input_vars'] != '' ){

		$message = array();

		if( ( $r['suhosin_post_maxvars'] != '' && $r['suhosin_post_maxvars'] != 0 && $r['suhosin_post_maxvars'] < 1000 ) ||
			( $r['suhosin_request_maxvars']!= '' && $r['suhosin_request_maxvars']!= 0 && $r['suhosin_request_maxvars'] < 1000 ) ){
			$message[] = __( "Your server is running Suhosin, and your current maxvars settings may limit the number of menu items you can save." , 'ubermenu' );
		}


		//150 ~ 10 left
		foreach( $r as $key => $val ){
			if( $val > 0 ){
				if( $val - $var_count < 150 ){
					$message[] = __( "You are approaching the post variable limit imposed by your server configuration.  Exceeding this limit may automatically delete menu items when you save.  Please increase your <strong>$key</strong> directive in php.ini.  <a target='_blank' href='http://goo.gl/8taSli'>More information and <strong>how to resolve it</strong></a>." , 'ubermenu' );
				}
			}
		}

		if( !empty( $message ) ):

		?>
		<div class="ubermenu-admin-notice ubermenu-admin-notice-warning ubermenu-admin-notice-menu-item-limit">
			<div class="ubermenu-admin-notice-icon"><i class="fas fa-exclamation-triangle"></i></div>
			<h3><a target="_blank" href="http://goo.gl/vttchn"><?php _e( 'Menu Item Limit Warning' , 'ubermenu' ); ?> <i class="fas fa-exclamation-triangle"></i></a></h3>
			<ul>
			<?php foreach( $message as $m ): ?>
				<li><?php echo $m; ?></li>
			<?php endforeach; ?>
			</ul>

			<table>

			<?php if( $r['max_input_vars'] != '' ): ?>
				<tr>
					<td class="um-td-150"><strong>max_input_vars</strong></td>
					<td><strong><?php echo $r['max_input_vars']; ?></strong></td>
					<td class="infotip">This is the current runtime max_input_vars value, which is controlled by your server configuration files.  You may need to restart your server for a new value set in your php.ini to appear here.</td>
				</tr>
			<?php endif; ?>

			<?php if( $r['suhosin_post_maxvars'] != '' ): ?>
				<tr>
					<td>suhosin.post.max_vars</td><td><?php echo $r['suhosin_post_maxvars']; ?></td>
				</tr>
			<?php endif; ?>

			<?php if( $r['suhosin_request_maxvars'] != '' ): ?>
				<tr>
					<td>suhosin.request.max_vars</td>
					<td><?php echo $r['suhosin_request_maxvars']; ?></td>
				</tr>
			<?php endif; ?>


				<tr>
					<td><?php _e( 'Last saved Item Variable Count' , 'ubermenu' ); ?></td>
					<td><?php echo $var_count; ?></td>
					<td class="infotip">This is the number of post variables in the last menu you saved (there are about 15 per menu item).</td>
				</tr>



				<?php
					if( $r['max_input_vars'] != '' ){
						$estimate = ( $r['max_input_vars'] - $var_count ) / 15;
						if( $estimate < 0 ) $estimate = 0;

						$limit = floor( $r['max_input_vars'] / 15 );
						?>

					<tr>
						<td><?php _e( 'Percent of Item Limit' , 'ubermenu' ); ?></td>
						<td><?php echo 100 * ( $var_count / $r['max_input_vars'] ); ?>%</td>
						<td class="infotip">How close you are to the limit percentage-wise.</td>
					</tr>

					<tr>
						<td><?php _e( 'Item Limit' , 'ubermenu' ); ?></td>
						<td><?php echo $limit; ?></td>
						<td class="infotip">Estimated maximum items you can add to your menu based on max_input_vars limit.  If you exceed the limit, WordPress may silently delete the menu items at the end of your menu.</td>
					</tr>
					<tr>
						<td><strong><?php _e( 'Estimated remaining menu items' , 'ubermenu' ); ?></strong></td>
						<td><strong><?php echo floor( $estimate ); ?></strong></td>
						<td class="infotip">You can add about this many more items before you hit the limit.</td>
					</tr>
				<?php
					};
				?>
			</table>

			<br/>Loaded configuration file on your server: <strong><?php echo php_ini_loaded_file(); ?></strong>

		</div>
		<?php endif;
	}
}
