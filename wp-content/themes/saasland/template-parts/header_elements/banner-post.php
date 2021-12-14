<?php
$opt = get_option( 'saasland_opt' );
$titlebar_align = !empty($opt['titlebar_align']) ? $opt['titlebar_align'] : 'center';

function saasland_post_bg_image() {
    $background_image = function_exists( 'get_field' ) ? get_field( 'banner_background_image' ) : '';
    if ($background_image) {
        echo 'style="background: url( ' . get_field( 'banner_background_image' ) . ' ) no-repeat scroll center 0 / cover;"';
    }else {
        echo '';
    }
}

$is_post_author = isset($opt['is_single_post_author']) ? $opt['is_single_post_author'] : '1';
$is_single_cats = isset($opt['is_single_cats']) ? $opt['is_single_cats'] : '1';
$is_single_comment_meta = isset($opt['is_single_comment_meta']) ? $opt['is_single_comment_meta'] : '1';
$is_single_post_meta = isset($opt['is_single_post_meta']) ? $opt['is_single_post_meta'] : '1';

while(have_posts()) : the_post();
    ?>
    <section class="blog_breadcrumb_area <?php echo esc_attr($titlebar_align) ?>" <?php saasland_post_bg_image(); ?>>
        <div class="background_overlay"></div>
        <div class="container">
            <div class="breadcrumb_content_two text-center">
                <?php if ( $is_single_cats == '1' ) :
                    if ( $is_single_post_meta == '1' ) : ?>
                        <h5> <?php the_category( ', ' ) ?> </h5>
                    <?php endif; ?>
                <?php endif; ?>
                <h1> <?php the_title() ?> </h1>
                <?php if ( $is_single_post_meta == '1' ) : ?>
                    <ol class="list-unstyled">
                        <?php if ( $is_post_author == '1' ) : ?>
                            <li> <?php esc_html_e( 'By', 'saasland' ) ?>
                                <a href="<?php echo get_author_posts_url(get_the_author_meta( 'ID')) ?>">
                                    <?php echo get_the_author(); ?>
                                </a>
                            </li>
                        <?php endif; ?>
                        <?php if ( $is_single_comment_meta == '1' ) : ?>
                            <li> <?php saasland_comment_count( get_the_ID() ) ?> </li>
                        <?php endif; ?>
                    </ol>
                <?php endif; ?>
            </div>
        </div>
    </section>
    <?php
endwhile;