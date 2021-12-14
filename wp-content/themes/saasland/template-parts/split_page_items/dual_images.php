<?php
$image_01 = get_sub_field( 'image_01' );
$image_02 = get_sub_field( 'image_02' );
?>
<div class="split_banner height">
    <div class="border_shap one"></div>
    <div class="border_shap two"></div>
    <div class="square four"></div>
    <div class="intro">
        <div class="spliet_slider_img">
            <?php echo wp_get_attachment_image( $image_01, 'full', false, array( 'class' =>'phone_one' ) ); ?>
            <?php echo wp_get_attachment_image( $image_02, 'full', false, array( 'class' =>'phone_two' ) ); ?>
        </div>
    </div>
</div>