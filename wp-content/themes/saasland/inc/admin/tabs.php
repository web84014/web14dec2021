<?php

?>
<nav class="lqd-dsd-menubard">

	<span class="lqd-dsd-logo">
		<img src="<?php echo SAASLAND_DIR_IMG.'/logo_sticky_retina.png'; ?>" alt="<?php echo esc_attr( $theme->name ); ?>">
		<?php printf( '<span class="lqd-v">%s</span>', $theme->version ); ?>
	</span>

    <ul class="lqd-dsd-menu">
        <li class="<?php saasland_helper()->active_tab('saasland'); ?>">
            <a href="">
                <span><?php esc_html_e( 'Dashboard', 'saasland' ); ?></span>
            </a>
        </li>
        <li class="">
            <a href="">
                <span><?php esc_html_e( 'Install Plugins', 'saasland' ); ?></span>
            </a>
        </li>
        <li class="">
            <a href="">
                <span><?php esc_html_e( 'Import Demo', 'saasland' ); ?></span>
            </a>
        </li>
        <li class="">
            <a href="">
                <span><?php esc_html_e( 'Support', 'saasland' ); ?></span>
            </a>
        </li>
    </ul>

</nav> <!-- /.lqd-dsd-menubard -->