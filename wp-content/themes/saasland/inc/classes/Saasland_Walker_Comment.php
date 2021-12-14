<?php
/**
 * Custom comment walker for this theme.
 *
 * @package WordPress
 * @subpackage Twenty_Twenty
 * @since 1.0.0
 */

if ( ! class_exists( 'Saasland_Walker_Comment' ) ) {
    /**
     * CUSTOM COMMENT WALKER
     * A custom walker for comments, based on the walker in Twenty Nineteen.
     */
    class Saasland_Walker_Comment extends Walker_Comment {

        /**
         * Outputs a comment in the HTML5 format.
         *
         * @see wp_list_comments()
         * @see https://developer.wordpress.org/reference/functions/get_comment_author_url/
         * @see https://developer.wordpress.org/reference/functions/get_comment_author/
         * @see https://developer.wordpress.org/reference/functions/get_avatar/
         * @see https://developer.wordpress.org/reference/functions/get_comment_reply_link/
         * @see https://developer.wordpress.org/reference/functions/get_edit_comment_link/
         *
         * @param WP_Comment $comment Comment to display.
         * @param int        $depth   Depth of the current comment.
         * @param array      $args    An array of arguments.
         */
        protected function html5_comment( $comment, $depth, $args ) {

            ?>
            <<?php echo ( 'div' === $args['style'] ) ? 'div' : 'li'; //phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- static output ?> id="comment-<?php comment_ID(); ?>" <?php comment_class( $this->has_children ? 'post_comment has_children' : 'post_comment', $comment ); ?>>
            <div class="media post_author_two">
                <?php
                if (get_avatar($comment)) {
                    echo get_avatar($comment, 70, null, null, array( 'class'=> 'img_rounded'));
                }
                ?>
                <div class="media-body">
                    <div class="comment_info">
                        <h3> <?php comment_author(); ?> </h3>
                        <div class="comment-date"> <?php comment_date(get_option( 'date_format')); ?> </div>
                    </div>
                    <?php comment_reply_link(array_merge( $args, array( 'reply_text' => 'Reply' . '<i class="arrow_right"></i>', 'depth' => $depth, 'max_depth' => $args['max_depth']))); ?>

                    <?php if ( '0' === $comment->comment_approved ) : ?>
                        <em> <?php esc_html_e( 'Your comment is awaiting moderation.', 'saasland' ) ?></em><br />
                    <?php endif; ?>
                    <?php comment_text(); ?>
                </div>
            </div>
            <?php
        }
    }
}
