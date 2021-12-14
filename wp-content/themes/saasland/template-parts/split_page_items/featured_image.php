<div class="split_banner height">
    <div class="square one"></div>
    <div class="square two"></div>
    <div class="intro">
        <div class="app_img">
            <div class="square three"></div>
            <?php
            $image = get_sub_field( 'featured_image' );
            ?>
            <img class="wow fadeInRight" data-wow-delay="1ms" src="<?php echo esc_url($image['url']) ?>" alt="<?php echo esc_attr($image['alt']) ?>">
        </div>
    </div>
</div>
