<?php
    if (post_password_required()) {
        return;
    }
?>
<?php

    if (have_comments()) :
        ?>
        <div id="comments" class="comments-area comment_area clearfix bg-white mb-30 p-30 box-shadow">
            <!-- Section Title -->
            <div class="section-heading">
                <h5 class="comments-title">
                    <?php
                        $umag_comment_count = get_comments_number();
                        if ('1' === $umag_comment_count) {
                            printf(
                            /* translators: 1: title. */
                                esc_html__('One thought on &ldquo;%1$s&rdquo;', 'umag'),
                                '<span>' . wp_kses_post(get_the_title()) . '</span>'
                            );
                        } else {
                            printf(
                            /* translators: 1: comment count number, 2: title. */
                                esc_html(_nx('%1$s thought on &ldquo;%2$s&rdquo;', '%1$s thoughts on &ldquo;%2$s&rdquo;', $umag_comment_count, 'comments title', 'umag')),
                                number_format_i18n($umag_comment_count), // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
                                '<span>' . wp_kses_post(get_the_title()) . '</span>'
                            );
                        }
                    ?>
                </h5><!-- .comments-title -->
            </div>

            <ol class="comment-list">
                <?php
                    wp_list_comments(
                        array(
                            'style' => 'ol',
                            'short_ping' => true,
                            'callback' => 'umag_comment_template',
                            'avatar_size' => 70,
                        )
                    );
                ?>
            </ol><!-- .comment-list -->

            <?php
                umag_comment_pagination();
            ?>
        </div><!-- #comments -->
    <?php
    endif; // Check for have_comments().
?>


<div class="post-a-comment-area bg-white mb-30 p-30 box-shadow clearfix">

    <div class="contact-form-area">
        <?php
            if (!comments_open()) :
                ?>
                <div class="alert alert-danger m-0"><p
                        class="no-comments"><?php esc_html_e('Comments are closed.', 'umag'); ?></p></div>
            <?php
            endif;
            $required = get_option('require_name_email') ? ' required' : '';

            $commenter = wp_get_current_commenter();
            $commenter = !empty($commenter['comment_author_email']) ? ' checked="checked"' : '';

            $author_value = !empty($commenter['comment_author']) ? ' value="' . $commenter['comment_author'] . '"' : '';
            $author_email_value = !empty($commenter['comment_author_email']) ? ' value="' . $commenter['comment_author_email'] . '"' : '';
            $author_url_value = !empty($commenter['comment_author_url']) ? ' value="' . $commenter['comment_author_url'] . '"' : '';


            $cookies = '<div class="row"><div class="col-12"><div class="custom-control custom-checkbox">';
            $cookies .= '<input type="checkbox" class="custom-control-input" id="wp-comment-cookies-consent" name="wp-comment-cookies-consent" value="yes"' . $commenter . '>';
            $cookies .= '<label class="custom-control-label" for="wp-comment-cookies-consent">' . esc_html__('Save my name, email, and website in this browser for the next time I comment.') . '</label>';
            $cookies .= '</div></div></div>';

            $author = '<div class="row">';
            $author .= '<div class="col-12 col-lg-6">';
            $author .= '<input ' . $author_value . ' type="text" class="form-control" id="name" name="author" placeholder="' . esc_attr__('Your Name*', 'umag') . '"' . $required . '>';
            $author .= '</div>';

            $email = '<div class="col-12 col-lg-6">';
            $email .= '<input ' . $author_email_value . ' type="email" class="form-control" id="email" name="email"  placeholder="' . esc_attr__('Your Email*', 'umag') . '"' . $required . '>';
            $email .= '</div>';

            $url = '<div class="col-12 col-lg-6">';
            $url .= '<input ' . $author_url_value . ' type="url" class="form-control" id="url" name="url"  placeholder="' . esc_attr__('Your Website*', 'umag') . '"' . $required . '>';
            $url .= '</div>';
            $url .= '</div>';

            $comment_field = '<div class="row">';
            $comment_field .= '<div class="col-12">';
            $comment_field .= '<textarea class="form-control" id="comment" name="comment" cols="30" rows="10" placeholder="' . esc_attr__('Comment*', 'umag') . '" required></textarea>';
            $comment_field .= '</div>';
            $comment_field .= '</div>';

            $args = array(
                'fields' => array(
                    'author' => $author,
                    'email' => $email,
                    'url' => $url,
                    'cookies' => $cookies,
                ),
                'comment_field' => $comment_field,
                'class_submit' => 'btn mag-btn mt-30',
                'title_reply_before' => '<div class="section-heading"><h5>',
                'title_reply_after' => '</h5></div>',
            );

            comment_form($args); ?>

    </div>
</div>
