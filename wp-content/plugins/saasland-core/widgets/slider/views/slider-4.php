<?php
wp_enqueue_style( 'saasland-digital-agency' );
$per_page   = !empty( $settings['posts_per_page'] ) ? $settings['posts_per_page'] : '10';
$order      = isset( $settings['portfolio_order'] ) ? $settings['portfolio_order'] : 'ASC';
$exclude    = !empty( $settings['portfolio_exclude'] ) ? wp_parse_id_list( $settings['portfolio_exclude'] ) : '';
$args = array(
    'posts_per_page' => $per_page,
    'post_type'      => 'portfolio',
    'post_status'    => 'publish',
    'orderby'        => 'post_type',
    'exclude'        => $exclude,
    'order'          => $order
);
$portfolios_posts = get_posts( $args ); ?>

<section class="slider_section">
    <div class="container">
        <div id="main_product_slider" class="main_product_slider carousel slide" data-ride="carousel">
            <div class="carousel-inner">
                <?php
                if ( is_array( $portfolios_posts ) ) {
                    $inc = 0;
                    foreach ( $portfolios_posts as $port_img ){
                        $active = $inc == 1 ? 'active' : ''; ?>
                        <div class="carousel-item <?php echo esc_attr( $active ) ?>">
                            <a class="main_product_item" href="<?php the_permalink(); ?>">
                                <?php
                                echo get_the_post_thumbnail( $port_img->ID, 'saasland_1170x675' );
                                ?>
                            </a>
                        </div>
                        <?php
                        $inc++;
                    }
                }
                ?>
            </div>
            <a class="carousel-control-prev" href="#main_product_slider" role="button" data-slide="prev">
                <span><i class="arrow_left"></i></span>
            </a>
            <a class="carousel-control-next" href="#main_product_slider" role="button" data-slide="next">
                <span><i class="arrow_right"></i></span>
            </a>
            <ul class="carousel-indicators">
                <?php
                if( is_array( $portfolios_posts ) ){
                    $slide_data = 0;
                    foreach ( $portfolios_posts as $portfolio_title ){
                        $active_class = $slide_data == 1 ? 'active' : ''; ?>
                        <li data-target="#main_product_slider" title="<?php echo esc_attr( $portfolio_title->post_title ) ?>" data-slide-to="<?php echo $slide_data++; ?>" class="<?php echo esc_attr( $active_class ) ?>"><?php saaslandCore_limit_latter( $portfolio_title->post_title, 10, '' ); ?></li>
                        <?php
                    }
                }
                ?>
            </ul>
        </div>
    </div>
</section>
