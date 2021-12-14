<?php
/**
 * Display single product reviews (comments)
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product-reviews.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 4.3.0
 */

defined( 'ABSPATH' ) || exit;

global $product;

if ( ! comments_open() ) {
    return;
}

?>

    <h6 class="f_p f_500 f_size_18 mb_20 f_p"><?php
        if ( get_option( 'woocommerce_enable_review_rating' ) === 'yes' && ( $count = $product->get_review_count() ) ) {
            /* translators: 1: reviews count 2: product name */
            printf( esc_html( _n( '%1$s review for %2$s', '%1$s reviews for %2$s', $count, 'saasland' ) ), esc_html( $count ), '<span>' . get_the_title() . '</span>' );
        } else {
            _e( 'Reviews', 'saasland' );
        }
        ?>
    </h6>
    <ul class="comment-box list-unstyled mb_60">
        <?php
        wp_list_comments(
            apply_filters(
                'woocommerce_product_review_list_args',
                array( 'callback' => 'saasland_woocommerce_comments' )
            ),
            get_comments(array(
                'post_id' => get_the_ID(),
            ))
        );
        ?>
    </ul>


<?php
if ( get_option( 'woocommerce_review_rating_verification_required' ) === 'no' || wc_customer_bought_product( '', get_current_user_id(), $product->get_id() ) ) : ?>
    <div class="car_get_quote_content comments_form">
        <?php
        $commenter = wp_get_current_commenter();

        $comment_form = array(
            'title_reply_to'       => esc_html__( 'Leave a Reply to %s', 'saasland' ),
            'title_reply'          => have_comments() ? __( 'Add your Review', 'saasland' ) : sprintf( __( 'Be the first to review &ldquo;%s&rdquo;', 'saasland' ), get_the_title() ),
            'title_reply_before'   => '<h2 class="f_500 f_p f_size_18 mb_20">',
            'title_reply_after'    => '</h2>',
            'comment_notes_after'  => '',
            'fields'               => array(
                'author' => '<div class="col-md-6 form-group">
                                <input type="text" name="author" class="form-control" placeholder="'.esc_attr__( 'Name *', 'saasland' ).'" value="'.esc_attr( $commenter['comment_author'] ).'" aria-required="true" required>
                             </div>',
                'email'  => '<div class="col-md-6 form-group">
                                <input name="email" type="text" class="form-control" placeholder="'.esc_attr__( 'Email *', 'saasland' ).'" value="'.esc_attr( $commenter['comment_author_email'] ).'" aria-required="true" required>
                             </div>',
            ),
            'label_submit'  => esc_html__( 'Submit', 'saasland' ),
            'logged_in_as'  => '',
            'comment_field' => '',
            'class_form'    => 'get_quote_form row',
            'class_submit'  => 'agency_banner_btn',
            'id_submit'     => 'submit-btn'
        );

        if ( $account_page_url = wc_get_page_permalink( 'myaccount' ) ) {
            $comment_form['must_log_in'] = '<p class="must-log-in">' . sprintf( __( 'You must be <a href="%s">logged in</a> to post a review.', 'saasland' ), esc_url( $account_page_url ) ) . '</p>';
        }

        $comment_form['comment_field'] .= '
            <div class="col-md-12 form-group mb-0"> 
                <textarea id="comment-field" class="form-control message" placeholder="'.esc_attr__( 'Your Review', 'saasland' ).'" rows="5" name="comment" aria-required="true" required></textarea>
            </div>';

        if ( get_option( 'woocommerce_enable_review_rating' ) === 'yes' ) {
            $comment_form['comment_field'] .= '
                <div class="comment-form-rating mt_30">
                    <span>' . esc_html__( 'Your rating:', 'saasland' ) . '</span>
                    <select name="rating" id="rating" aria-required="true" required>
                        <option value="">' . esc_html__( 'Rate&hellip;', 'saasland' ) . '</option>
                        <option value="5">' . esc_html__( 'Perfect', 'saasland' ) . '</option>
                        <option value="4">' . esc_html__( 'Good', 'saasland' ) . '</option>
                        <option value="3">' . esc_html__( 'Average', 'saasland' ) . '</option>
                        <option value="2">' . esc_html__( 'Not that bad', 'saasland' ) . '</option>
                        <option value="1">' . esc_html__( 'Very poor', 'saasland' ) . '</option>
                    </select>
                </div>';
        }

        comment_form( apply_filters( 'woocommerce_product_review_comment_form_args', $comment_form ) );
        ?>
    </div>
<?php else : ?>

    <p class="woocommerce-verification-required"><?php _e( 'Only logged in customers who have purchased this product may leave a review.', 'saasland' ); ?></p>

<?php endif; ?>