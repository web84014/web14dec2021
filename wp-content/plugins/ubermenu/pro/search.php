<?php
//<input type="submit" class="ubermenu-search-submit" value="&#xf002;" />
function ubermenu_searchbar( $placeholder = null , $post_type = '' , $search_field_id = 'ubermenu-search-field' , $search_label_sr = 'Search' , $button_text_sr = 'Search' , $autofocus = true ){
	if( is_null( $placeholder ) ){
		$placeholder = __( 'Search...' , 'ubermenu'  );
	}

	$toggle_icon_tag = ubermenu_op( 'icon_tag' , 'main' ); //just grab from the main config
	if( !$toggle_icon_tag ) $toggle_icon_tag = 'i';

	$text_input_classes = 'ubermenu-search-input';
	if( $autofocus ){
			$text_input_classes.= ' ubermenu-search-input-autofocus';
	}


	?>
	<!-- UberMenu Search Bar -->
	<div class="ubermenu-search">
		<form role="search" method="get" class="ubermenu-searchform" action="<?php echo home_url( '/' ); ?>">
			<label for="<?php echo $search_field_id; ?>">
				<span class="ubermenu-sr-only"><?php echo $search_label_sr; ?></span>
			</label>
			<input type="text" placeholder="<?php echo $placeholder; ?>" value="" name="s" class="<?php echo $text_input_classes; ?>" id="<?php echo $search_field_id; ?>"/>
			<?php if( $post_type ): ?>
			<input type="hidden" name="post_type" value="<?php echo $post_type; ?>" />
			<?php endif; ?>
			<button type="submit" class="ubermenu-search-submit">
				<<?php echo $toggle_icon_tag; ?> class="fas fa-search" title="Search" aria-hidden="true"></<?php echo $toggle_icon_tag; ?>>
				<span class="ubermenu-sr-only"><?php echo $button_text_sr; ?></span>
			</button>
		</form>
	</div>
	<!-- end .ubermenu-search -->
	<?php
}

function ubermenu_searchbar_shortcode( $atts , $content ){

	extract( shortcode_atts( array(
		'placeholder' => __( 'Search...' , 'ubermenu' ),
		'post_type'	=> '',
		'search_field_id' => 'ubermenu-search-field',
		'search_label_sr' => __( 'Search' , 'ubermenu' ),
		'button_text_sr' => __( 'Search' , 'ubermenu' ),
		'autofocus' => 'on'

	), $atts ) );

	$autofocus = $autofocus === 'on' ? true : false;

	ob_start();
	ubermenu_searchbar( $placeholder , $post_type , $search_field_id , $search_label_sr , $button_text_sr , $autofocus );
	$s = ob_get_clean();

	return $s;
}
add_shortcode( 'ubermenu-search' , 'ubermenu_searchbar_shortcode' );
