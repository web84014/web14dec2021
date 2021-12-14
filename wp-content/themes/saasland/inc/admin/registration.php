<?php
$register = new Saasland_register_theme;
$purchase_code_status = trim( get_option( 'saasland_purchase_code_status' ) );
if ( $purchase_code_status == 'valid' ) {
    $license_status = 'success';
} elseif ( $purchase_code_status == 'invalid' ) {
    $license_status = 'failed';
} elseif ( $purchase_code_status == '' ) {
    $license_status = '';
}

?>
<div class="dt-dsb-box dt-theme-register-box">

	<div class="dt-box-head <?php echo esc_attr($license_status) ?>">
        <?php $register->messages(); ?>
	</div><!-- /.lqd-dsd-box-head -->

	<?php $register->form(); ?>
	
	<div class="dt-box-foot">
		<a href="https://help.market.envato.com/hc/en-us/articles/202822600-Where-Is-My-Purchase-Code-" target="_blank">
            <?php esc_html_e( 'Where can find purchase code!', 'saasland' ); ?>
        </a>
	</div><!-- /.lqd-dsd-box-foot -->	

</div><!-- /.lqd-dsd-register-box -->