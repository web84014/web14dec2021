<section class="erp_customer_logo_area">
    <div class="container">
        <div class="hosting_title erp_title text-center">
            <?php if ( !empty( $settings['title'] ) ) : ?>
                <<?php echo $title_tag; ?> class="sassland_erp_color"><?php echo wp_kses_post( $settings['title'] ) ?></<?php echo $title_tag; ?>>
            <?php endif; ?>
            <?php if ( !empty( $settings['subtitle'] ) ) : ?>
                <?php echo wp_kses_post( wpautop( $settings['subtitle'] ) ) ?>
            <?php endif; ?>
        </div>
        <ul class="list-unstyled animation_inner">
            <?php
            if ( !empty( $settings['logos'] ) ) {
                $delay = 0.1;
                foreach ( $settings['logos'] as $logo ) {
                    ?>
                    <li class="wow slideInnew2" data-wow-delay="<?php echo esc_attr( $delay) ?>s">
                        <img src="<?php echo esc_url( $logo['logo']['url'] ) ?>" alt="<?php echo esc_attr( $logo['alt_text'] ) ?>">
                    </li>
                    <?php
                    $delay = $delay + 0.1;
                }
            }
            ?>
        </ul>
        <?php if ( !empty( $settings['btn_label'] ) ) : ?>
            <div class="text-center">
                <a href="<?php echo esc_url( $settings['btn_url']['url']) ?>" class="er_btn"
                    <?php saasland_is_external( $settings['btn_url'] ) ?>>
                    <?php echo esc_html( $settings['btn_label'] ) ?>
                </a>
            </div>
        <?php endif; ?>
    </div>
</section>