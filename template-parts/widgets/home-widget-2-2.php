<!-- Single Blog Post -->
<article <?php post_class('single-blog-post d-flex style-3'); ?> id="home-widget-2-2-<?php the_ID(); ?>" >
    <div class="post-thumbnail">
        <?php the_post_thumbnail('umag_home_widget_2_2'); ?>
    </div>
    <div class="post-content">
        <a href="<?= get_the_permalink() ?>" class="post-title"><?php the_title() ?></a>
        <div class="post-meta d-flex justify-content-between">
            <?= umag_post_meta() ?>
        </div>
    </div>
</article>