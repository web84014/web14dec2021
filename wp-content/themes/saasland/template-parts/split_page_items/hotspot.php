<div class="split_banner height">
    <div class="square one"></div>
    <div class="square two"></div>
    <div class="intro">
        <div class="app_img">
            <div class="square three"></div>
            <?php
            $hotspot_i = 1;
            while ( have_rows( 'hotspots' ) ) : the_row();
                $pointer_image = get_sub_field( 'pointer_image' );
                switch( $hotspot_i ) {
                    case 1:
                        $hotspot_ci = 'one';
                        break;
                    case 2:
                        $hotspot_ci = 'two';
                        break;
                    case 3:
                        $hotspot_ci = 'three';
                        break;
                    default:
                        $hotspot_ci = $hotspot_i;
                        break;
                }
                ?>
                <div class="dot dot_<?php echo esc_attr($hotspot_ci); ?> wow fadeIn" data-wow-delay="0.5s"><span class="dot1"></span><span class="dot2"></span></div>
                <img class="text_bg <?php echo esc_attr($hotspot_ci); ?> wow fadeInLeft" data-wow-delay="0.5s" src="<?php echo esc_url($pointer_image['url']) ?>" alt="<?php echo esc_attr( 'alt' ) ?>">
                <?php
                ++ $hotspot_i;
            endwhile;
            ?>
            <?php
            $featured_image = get_sub_field( 'featured_image' );
            if ( $featured_image['url'] ) : ?>
                <img class="wow fadeIn phone_img" data-wow-delay="1ms" src="<?php echo esc_url($featured_image['url']) ?>" alt="<?php echo esc_attr($featured_image['alt']) ?>">
            <?php endif; ?>
        </div>
    </div>
</div>