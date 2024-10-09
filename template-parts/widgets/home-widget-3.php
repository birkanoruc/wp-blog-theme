<article <?php post_class('single-blog-post style-4'); ?> id="home-widget-3-<?php the_ID(); ?>">
    <div class="post-thumbnail">
        <?php the_post_thumbnail('umag_home_widget_3'); ?>
        <?php if('video' === get_post_format()): ?>
            <a href="<?php the_permalink() ?>" class="video-play"><i class="fa fa-play"></i></a>
            <?php
            $video_duration = get_post_meta(get_the_ID(), 'video_duration', true);
            if(!empty($video_duration)){
                ?>
                <span class="video-duration"><?= esc_html($video_duration) ?></span>
                <?php
            }
            ?>
        <?php endif; ?>
    </div>
    <div class="post-content">
        <a href="<?= get_the_permalink() ?>" class="post-title"><?php the_title() ?></a>
        <div class="post-meta d-flex justify-content-between">
            <?= umag_post_meta() ?>
        </div>
    </div>
</article>