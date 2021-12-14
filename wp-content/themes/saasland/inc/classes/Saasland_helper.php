<?php
class Saasland_helper {

    /**
     * Hold an instance of Saasland_helper class.
     * @var Saasland_helper
     */
    protected static $instance = null;

    /**
     * Main Saasland_helper instance.
     * @return Saasland_helper - Main instance.
     */
    public static function instance() {

        if (null == self::$instance) {
            self::$instance = new Saasland_helper();
        }

        return self::$instance;
    }

    /**
     * [ajax_url description]
     * @method ajax_url
     * @return [type]   [description]
     */
    public function ajax_url() {
        return admin_url( 'admin-ajax.php', 'relative' );
    }
    
    public function get_current_page_id() {

        global $post;
        $page_id = false;
        $object_id = is_null($post) ? get_queried_object_id() : $post->ID;

        // If we're on search page, set to false
        if ( is_search() ) {
            $page_id = false;
        }
        // If we're not on a singular post, set to false
        if ( ! is_singular() ) {
            $page_id = false;
        }
        // Use the $object_id if available
        if ( ! is_home() && ! is_front_page() && ! is_archive() && isset( $object_id ) ) {
            $page_id = $object_id;
        }
        // if we're on front-page
        if ( ! is_home() && is_front_page() && isset( $object_id ) ) {
            $page_id = $object_id;
        }
        // if we're on posts-page
        if ( is_home() && ! is_front_page() ) {
            $page_id = get_option( 'page_for_posts' );
        }
        // The woocommerce shop page
        if ( class_exists( 'WooCommerce' ) && ( is_shop() || is_tax( 'product_cat' ) || is_tax( 'product_tag' ) ) ) {
            if ( $shop_page = wc_get_page_id( 'shop' ) ) {
                $page_id = $shop_page;
            }
        }
        // if in the loop
        if ( in_the_loop() ) {
            $page_id = get_the_ID();
        }

        return $page_id;
    }

    /**
     * [get_theme_name description]
     * @method get_theme_name
     * @return [type]         [description]
     */
    public function get_current_theme() {
        $current_theme = wp_get_theme();
        if ( $current_theme->parent_theme ) {
            $template_dir  = basename( get_template_directory() );
            $current_theme = wp_get_theme( $template_dir );
        }
        return $current_theme;
    }

    public function logo() {
        $opt = get_option( 'saasland_opt' );
        $split_logo = is_page_template('page-split.php') ? 'logo' : '';
        ?>
        <a class="navbar-brand sticky_logo <?php echo esc_attr($split_logo) ?>" href="<?php echo esc_url(home_url( '/')) ?>">
            <?php
            if (isset($opt['main_logo']['url'])) {
                $reverse_logo = function_exists( 'get_field' ) ? get_field( 'reverse_logo' ) : '';
                $error_img_select = !empty($opt['error_img_select']) ? $opt['error_img_select'] : '1';
                $is_blog_sticky_logo = isset($opt['is_blog_sticky_logo']) ? $opt['is_blog_sticky_logo'] : '';
                if ($reverse_logo || (is_home() && $is_blog_sticky_logo == '1') || ($error_img_select == '2' && is_404())) {
                    // Normal Logo
                    $main_logo = isset($opt['sticky_logo'] ['url']) ? $opt['sticky_logo'] ['url'] : '';
                    $retina_logo = isset($opt['retina_sticky_logo'] ['url']) ? $opt['retina_sticky_logo'] ['url'] : '';
                    // Sticky Logo
                    $sticky_logo = isset($opt['sticky_logo'] ['url']) ? $opt['sticky_logo'] ['url'] : '';
                    $retina_sticky_logo = isset($opt['retina_sticky_logo'] ['url']) ? $opt['retina_sticky_logo'] ['url'] : '';
                } else {
                    // Normal Logo
                    $main_logo = isset($opt['main_logo'] ['url']) ? $opt['main_logo'] ['url'] : '';
                    $retina_logo = isset($opt['retina_logo'] ['url']) ? $opt['retina_logo'] ['url'] : '';
                    // Sticky Logo
                    $sticky_logo = isset($opt['sticky_logo'] ['url']) ? $opt['sticky_logo'] ['url'] : '';
                    $retina_sticky_logo = isset($opt['retina_sticky_logo'] ['url']) ? $opt['retina_sticky_logo'] ['url'] : '';
                }
                $logo_srcset = !empty($retina_logo) ?  "srcset='$retina_logo 2x'" : '';
                $logo_srcset_sticky = !empty($retina_sticky_logo) ?  "srcset='$retina_sticky_logo 2x'" : '';
                ?>
                <img class="main_logo_img" src="<?php echo esc_url($main_logo); ?>" <?php echo wp_kses_post($logo_srcset) ?> alt="<?php bloginfo( 'name' ); ?>">
                <img class="sticky_logo_img" src="<?php echo esc_url($sticky_logo); ?>" <?php echo wp_kses_post($logo_srcset_sticky) ?> alt="<?php bloginfo( 'name' ); ?>">
                <?php
            } else {
                echo '<h3>' . get_bloginfo( 'name' ) . '</h3>';
            }
            ?>
        </a>
        <?php
    }
}

/**
 * Main instance of Saasland_helper.
 *
 * Returns the main instance of Saasland_helper to prevent the need to use globals.
 *
 * @return Saasland_helper
 */
function saasland_helper() {
    return Saasland_helper::instance();
}