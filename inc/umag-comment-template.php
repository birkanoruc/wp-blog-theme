<?php
    /**
     * Security Code To Block Access On Browser
     */
    if (!defined('ABSPATH')) {
        die();
    }

    function umag_comment_template($comment, $args, $depth)
    {
        ?>
        <!-- Single Comment Area -->
    <li <?php comment_class('single_comment_area') ?> id="comment-<?php comment_ID(); ?>">
        <!-- Comment Content -->
        <div class="comment-content d-flex">
            <!-- Comment Author -->
            <div class="comment-author">
                <?= get_avatar($comment->comment_author_email, $args['avatar_size']) ?>
            </div>
            <!-- Comment Meta -->
            <div class="comment-meta">
                <a href="<?= get_comment_link($comment->comment_ID) ?>" class="comment-date"><?php
                        printf( /*translators: %1$s: comment date %2$s: comment time*/ esc_html__('%1$s -%2$s', 'umag'), get_comment_date(), get_comment_time())
                    ?></a>
                <h6><?= get_comment_author_link() ?></h6>
                <?php if($comment->comment_approved === '0'): ?>
                    <div class="alert alert-warning" role="alert">
                        <?php esc_html_e('We are waiting for your comment approval.', 'umag') ?>
                    </div>
                <?php endif; ?>
                <?php comment_text() ?>
                <div class="d-flex align-items-center">
                    <?php if(umag_comment_like_button()): ?>
                    <span class="mr-2"><?= umag_comment_like_button() ?></span>
                    <?php endif; ?>
                    <?php
                        comment_reply_link(
                            array_merge($args, array(
                                'depth' => $depth,
                                'max_depth' => $args['max_depth'],
                            ))
                        );
                    ?>
                </div>
            </div>
        </div>
        <?php
    }

    function umag_reply_link_class($result)
    {
        $search = "class='comment-reply-link";
        $replace = "class='comment-repky-link reply";
        $result = str_replace($search,$replace,$result);
        return $result;
    }

    add_filter('comment_reply_link', 'umag_reply_link_class');