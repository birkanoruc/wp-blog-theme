<article <?php post_class('single-youtube-channel d-flex'); ?> id="video-posts-widget-<?php the_ID() ?>">
    <div class="youtube-channel-thumbnail">
        <?php the_post_thumbnail('umag_posts_widget'); ?>
    </div>
    <div class="youtube-channel-content">
        <a href="<?= get_the_permalink() ?>" class="channel-title"><?php the_title() ?></a>
        <a href="<?= get_the_permalink() ?>" class="btn subscribe-btn"><i class="fa fa-play-circle-o" aria-hidden="true"></i> <?php esc_html_e('Subscribe', 'umag') ?></a>
    </div>
</article>