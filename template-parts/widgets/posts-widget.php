<!-- Single Blog Post -->
<article <?php post_class('single-blog-post d-flex'); ?> id="posts_widget-<?php the_ID(); ?>" >
    <div class="post-thumbnail">
        <?php the_post_thumbnail('umag_posts_widget'); ?>
    </div>
    <div class="post-content">
        <a href="<?= get_the_permalink() ?>" class="post-title"><?php the_title() ?></a>
        <div class="post-meta d-flex justify-content-between">
            <?= umag_post_meta() ?>
        </div>
    </div>
</article>