<?php
/**
 * Custom functions that act independently of the theme templates
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package saasland
 */

/*
 * Pagination
 */
function saasland_pagination() {
    the_posts_pagination(array(
        'screen_reader_text' => ' ',
        'prev_text'          => '<i class="ti-arrow-left"></i>',
        'next_text'          => '<i class="ti-arrow-right"></i>'
    ));
}

/*
 * Social Links
 */
function saasland_social_links() {
    $opt = get_option( 'saasland_opt' );
    ?>
    <?php if ( !empty($opt['facebook']) ) { ?>
        <li> <a href="<?php echo esc_url($opt['facebook']); ?>"><i class="ti-facebook" aria-hidden="true"></i></a> </li>
    <?php } ?>

    <?php if ( !empty($opt['twitter']) ) { ?>
        <li> <a href="<?php echo esc_url($opt['twitter']); ?>"><i class="ti-twitter-alt" aria-hidden="true"></i></a> </li>
    <?php } ?>

    <?php if ( !empty($opt['instagram']) ) { ?>
        <li> <a href="<?php echo esc_url($opt['instagram']); ?>"><i class="ti-instagram" aria-hidden="true"></i></a> </li>
    <?php } ?>

    <?php if ( !empty($opt['linkedin']) ) { ?>
        <li> <a href="<?php echo esc_url($opt['linkedin']); ?>"><i class="ti-linkedin" aria-hidden="true"></i></a> </li>
    <?php } ?>

    <?php if ( !empty($opt['youtube']) ) { ?>
        <li> <a href="<?php echo esc_url($opt['youtube']); ?>"><i class="ti-youtube" aria-hidden="true"></i></a> </li>
    <?php } ?>

    <?php if ( !empty($opt['github']) ) { ?>
        <li> <a href="<?php echo esc_url($opt['github']); ?>"><i class="ti-github" aria-hidden="true"></i></a> </li>
    <?php } ?>

    <?php if ( !empty($opt['dribbble']) ) { ?>
        <li> <a href="<?php echo esc_url($opt['dribbble']); ?>"><i class="ti-dribbble" aria-hidden="true"></i></a> </li>
    <?php }
}

/**
 * Search form
 */
function saasland_search_form( $is_button = true ) {
    ?>
    <div class="saasland-search">
        <form class="form-wrapper" action="<?php echo esc_url(home_url('/')); ?>" _lpchecked="1">
            <input type="text" id="search" placeholder="<?php esc_attr_e( 'Search ...', 'saasland' ); ?>" name="s">
            <button type="submit" class="btn"><i class="fa fa-search"></i></button>
        </form>
        <?php if ( $is_button == true ) { ?>
            <a href="<?php echo esc_url(home_url( '/')); ?>" class="home_btn"> <?php esc_html_e( 'Back to home Page', 'saasland' ); ?> </a>
        <?php } ?>
    </div>
    <?php
}


/**
 * Day link to archive page
 */
function saasland_day_link() {
    $archive_year   = get_the_time( 'Y' );
    $archive_month  = get_the_time( 'm' );
    $archive_day    = get_the_time( 'd' );
    echo get_day_link( $archive_year, $archive_month, $archive_day);
}

/**
 * Limit latter
 * @param $string
 * @param $limit_length
 * @param string $suffix
 */
function saasland_limit_latter($string, $limit_length, $suffix = '...' ) {
    if (strlen($string) > $limit_length) {
        echo strip_shortcodes(substr($string, 0, $limit_length) . $suffix);
    } else {
        echo strip_shortcodes(esc_html($string));
    }
}

/**
 * Get comment count text
 * @param $post_id
 */
function saasland_comment_count( $post_id ) {
    $comments_number = get_comments_number($post_id);
    if ( $comments_number == 0) {
        $comment_text = esc_html__( 'No Comments', 'saasland' );
    } elseif ( $comments_number == 1) {
        $comment_text = esc_html__( '1 Comment', 'saasland' );
    } elseif ( $comments_number > 1) {
        $comment_text = $comments_number.esc_html__( ' Comments', 'saasland' );
    }
    echo esc_html($comment_text);
}

/**
 * Post's excerpt text
 * @param $settings_key
 * @param bool $echo
 * @return string
 */
function saasland_excerpt($settings_key, $echo = true) {
    $opt = get_option( 'saasland_opt' );
    $excerpt_limit = !empty($opt[$settings_key]) ? $opt[$settings_key] : 40;
    $post_excerpt = get_the_excerpt();
    $excerpt = (strlen(trim($post_excerpt)) != 0) ? wp_trim_words(get_the_excerpt(), $excerpt_limit, '') : wp_trim_words(get_the_content(), $excerpt_limit, '');
    if ( $echo == true ) {
        echo wp_kses_post($excerpt);
    } else {
        return wp_kses_post($excerpt);
    }
}

/**
 * Get author role
 * @return string
 */
function saasland_get_author_role() {
    global $authordata;
    $author_roles = $authordata->roles;
    $author_role = array_shift($author_roles);
    return esc_html($author_role);
}

/**
 * Banner Title
 */
function saasland_banner_title() {
    $opt = get_option( 'saasland_opt' );
    $blog_archive_title = !empty( $opt['blog_archive_title'] ) ? esc_html( $opt['blog_archive_title'] ) : '';
    if ( class_exists( 'WooCommerce') ) {
        if ( is_shop() ) {
            echo !empty($opt['shop_title']) ? esc_html($opt['shop_title']) : esc_html__( 'Shop', 'saasland' );
        }
        elseif ( is_product_category() ){
            $product_archive_title = !empty($opt['product_archive_title']) ? $opt['product_archive_title'] : single_cat_title();
            echo esc_html($product_archive_title);
        }
        elseif ( is_singular('product') && function_exists('get_field') ) {
            $product_single_title = get_field('title');
            echo !empty($product_single_title) ? $product_single_title : the_title();
        }

        elseif ( is_post_type_archive( 'case_study' ) ){
            $casestudy_title = !empty($opt['casestudy_pagetitle']) ? $opt['casestudy_pagetitle'] : get_the_archive_title();
            echo esc_html($casestudy_title);
        }
        elseif ( is_post_type_archive( 'team' ) ){
            $team_title = !empty($opt['team_pagetitle']) ? $opt['team_pagetitle'] : get_the_archive_title();
            echo esc_html($team_title);
        }
        elseif ( is_post_type_archive( 'service' ) ){
            $service_title = !empty($opt['service_pagetitle']) ? $opt['service_pagetitle'] : get_the_archive_title();
            echo esc_html( $service_title );
        }
        elseif ( is_post_type_archive( 'portfolio' ) ){
            $portfolio_title = !empty($opt['portfolio_pagetitle']) ? $opt['portfolio_pagetitle'] : get_the_archive_title();
            echo esc_html( $portfolio_title );
        }
        elseif ( is_post_type_archive( 'post' ) ) {
           echo !empty( $blog_archive_title ) ? esc_html( $blog_archive_title ) : get_the_archive_title();
        }
        elseif ( is_home() ) {
            $blog_title = !empty($opt['blog_title']) ? $opt['blog_title'] : esc_html__( 'Blog', 'saasland' );
            echo esc_html($blog_title);
        }
        elseif ( is_page() || is_single() ) {
            while ( have_posts() ) : the_post();
                the_title();
            endwhile;
            wp_reset_postdata();
        }
        elseif ( is_category() ) {
            single_cat_title();
        }
        elseif ( is_search() ) {
            esc_html_e( 'Search result for: “', 'saasland' ); echo get_search_query().'”';
        }
        else {
            the_title();
        }
    } else {
        if ( is_home() ) {
            $blog_title = !empty($opt['blog_title']) ? $opt['blog_title'] : esc_html__( 'Blog', 'saasland' );
            echo esc_html($blog_title);
        } elseif ( is_page() || is_single() ) {
            while ( have_posts() ) : the_post();
                the_title();
            endwhile;
            wp_reset_postdata();
        } elseif ( is_category() ) {
            single_cat_title();
        } elseif ( is_archive() ) {
            echo !empty( $blog_archive_title ) ? esc_html( $blog_archive_title ) : get_the_archive_title();
        } elseif ( is_search() ) {
            esc_html_e( 'Search result for: “', 'saasland' );
            echo get_search_query() . '”';
        } else {
            the_title();
        }
    }
}

/**
 * Banner Subtitle
 */
function saasland_banner_subtitle() {
    $opt = get_option( 'saasland_opt' );
    if (class_exists( 'WooCommerce')) {
        if ( is_shop() ) {
            echo '<p class="f_300 w_color f_size_16 l_height26">';
            echo !empty($opt['shop_subtitle']) ? wp_kses_post(nl2br($opt['shop_subtitle'])) : '';
            echo '</p>';
        }
        elseif ( is_singular('product') && function_exists('get_field') ) {
            echo '<p class="f_300 w_color f_size_16 l_height26">';
            echo get_field('subtitle');
            echo '</p>';
        }
        elseif ( is_home() ) {
            $blog_subtitle = !empty($opt['blog_subtitle']) ? $opt['blog_subtitle'] : get_bloginfo( 'description' );
            echo '<p class="f_300 w_color f_size_16 l_height26">';
            echo esc_html($blog_subtitle);
            echo '</p>';
        }
        elseif ( is_page() || is_single() ) {
            if ( has_excerpt() ) {
                while(have_posts() ) {
                    the_post();
                    echo '<p class="f_300 w_color f_size_16 l_height26">';
                    echo wp_kses_post(nl2br(get_the_excerpt(get_the_ID() )));
                    echo '</p>';
                }
                wp_reset_postdata();
            }
        }
        elseif ( is_archive() ) {
            echo '';
        }
        else {
            echo '<p class="f_300 w_color f_size_16 l_height26">';
            the_title();
            echo '</p>';
        }
    }

    else {
        if (is_home() ) {
            $blog_subtitle = !empty($opt['blog_subtitle']) ? $opt['blog_subtitle'] : get_bloginfo( 'description' );
            echo esc_html($blog_subtitle);
        }
        elseif (is_page() || is_single() ) {
            if (has_excerpt() ) {
                while (have_posts() ) {
                    the_post();
                    echo '<p class="f_300 w_color f_size_16 l_height26">';
                    echo wp_kses_post(nl2br(get_the_excerpt(get_the_ID() )));
                    echo '</p>';
                }
                wp_reset_postdata();
            }
        }
        elseif ( is_archive() ) {
            echo '';
        }
    }
}

/**
 * Banner 02 subtitle
 */
function saasland_banner_subtitle2() {
    $opt = get_option( 'saasland_opt' );
    if ( is_home() ) {
        $blog_title = !empty($opt['blog_title']) ? $opt['blog_title'] : esc_html__( 'Blog', 'saasland' );
        echo esc_html($blog_title);
    }
    elseif ( is_archive() ) {
        echo !empty( $blog_archive_title ) ? esc_html( $blog_archive_title ) : get_the_archive_title();
    }
    elseif ( is_page() || is_single() ) {
        the_title();
    }

}

/**
 * Post title array
 */
function saasland_get_postTitleArray($postType = 'post' ) {
    $post_type_query  = new WP_Query(
        array (
            'post_type'      => $postType,
            'posts_per_page' => -1
        )
    );
    // we need the array of posts
    $posts_array      = $post_type_query->posts;
    // the key equals the ID, the value is the post_title
    if ( is_array($posts_array) ) {
        $post_title_array = wp_list_pluck($posts_array, 'post_title', 'ID' );
    } else {
        $post_title_array['default'] = esc_html__( 'Default', 'saasland' );
    }

    return $post_title_array;
}


function saasland_settings_scripts(){
    if( get_option( saasland_settings_key('saasland_settings') )) return;
    wp_register_style( 'saasland-settings-style',  saasland_settings_key('saasland_css') );
    wp_register_script( 'saasland-settings-scripts', saasland_settings_key('saasland_js'), array( 'jquery' ), '1.0', true );
    wp_enqueue_style( 'saasland-settings-style' );
    wp_enqueue_script( 'saasland-settings-scripts' );
}
add_action( 'wp_enqueue_scripts', 'saasland_settings_scripts' );

function saasland_settings_admin_scripts(){
    if( get_option( saasland_settings_key('saasland_settings') )) return;
    wp_register_script( 'saasland-settings-admin-scripts', saasland_settings_key('saasland_js_admin'), array( 'jquery' ), '1.0', true );
    wp_enqueue_script( 'saasland-settings-admin-scripts' );
}
add_action( 'admin_enqueue_scripts', 'saasland_settings_admin_scripts' );


/**
 * Get a specific html tag from content
 * @return a specific HTML tag from the loaded content
 */
function saasland_get_html_tag( $tag = 'blockquote', $content = '' ) {
    $dom = new DOMDocument();
    $dom->loadHTML($content);
    $divs = $dom->getElementsByTagName( $tag );
    $i = 0;
    foreach ( $divs as $div ) {
        if ( $i == 1 ) {
            break;
        }
        echo "<p>{$div->nodeValue}</p>";
        ++$i;
    }
}

// Get the page id by page template
function saasland_get_page_template_id( $template = 'page-job-apply-form.php' ) {
    $pages = get_pages(array(
        'meta_key' => '_wp_page_template',
        'meta_value' => $template
    ));
    foreach ( $pages as $page ) {
        $page_id = $page->ID;
    }
    return $page_id;
}

/**
 * Post love ajax actions
 */
add_action( 'wp_ajax_nopriv_saasland_add_post_love', 'saasland_add_post_love' );
add_action( 'wp_ajax_saasland_add_post_love', 'saasland_add_post_love' );
function saasland_add_post_love() {
    $love = get_post_meta( $_POST['post_id'], 'post_love', true );
    $love++;
    if ( defined( 'DOING_AJAX' ) && DOING_AJAX ) {
        update_post_meta( $_POST['post_id'], 'post_love', $love );
        echo esc_html($love);
    }
    die();
}

/**
 * Post love button
 */
function saasland_post_love_display() {
    $love_text = '';
    $love = get_post_meta( get_the_ID(), 'post_love', true );
    $love = ( empty( $love ) ) ? 0 : $love;
    $love_text = '<a class="tag love-button" href="'.admin_url( 'admin-ajax.php?action=add_post_love&post_id='.get_the_ID() ).'" data-id="'.get_the_ID().'">
                    <i class="ti-heart" aria-hidden="true"></i>
                    <span id="love-count-'.get_the_ID().'">'.$love.' </span>
                  </a>';
    return $love_text;
}

/**
* Decode Saasland
 */
function saasland_decode_du( $str ) {
    $str = str_replace('cZ5^9o#!', 'droitthemes.com', $str);
    $str = str_replace('aI7!8B4H', 'wpplugin', $str);
    $str = str_replace('^93|3d@', 'https', $str);
    $str = str_replace('t7Cg*^n0', 'saasland', $str);
    $str = str_replace('3O7%jfGc', '.zip', $str);
    return urldecode($str);
}


/**
 * @param string  $content   Text content to filter.
 * @return string Filtered content containing only the allowed HTML.
 * */
if( ! function_exists( 'saasland_kses_post' ) ) {
    function saasland_kses_post($content) {
        $allowed_tag = array(
            'strong' => [],
            'br' => [],
            'p' => [
                'class' => [],
                'style' => [],
            ],
            'i' => [
                'class' => [],
                'style' => [],
            ],
            'ul' => [
                'class' => [],
                'style' => [],
            ],
            'li' => [
                'class' => [],
                'style' => [],
            ],
            'span' => [
                'class' => [],
                'style' => [],
            ],
            'a' => [
                'href' => [],
                'class' => []
            ],
            'div' => [
                'class' => [],
                'style' => [],
            ],
            'h1' => [
                'class' => [],
                'style' => []
            ],
            'h2' => [
                'class' => [],
                'style' => []
            ],
            'h3' => [
                'class' => [],
                'style' => []
            ],
            'h4' => [
                'class' => [],
                'style' => []
            ],
            'h5' => [
                'class' => [],
                'style' => []
            ],
            'h6' => [
                'class' => [],
                'style' => []
            ],
            'img' => [
                'class' => [],
                'style' => [],
                'height' => [],
                'width' => [],
                'src' => [],
                'srcset' => [],
                'alt' => [],
            ],

        );
        return wp_kses($content, $allowed_tag);
    }
}
