<article <?php post_class('col-12 col-md-6 col-lg-4'); ?> id="related-post-<?php the_ID(); ?>">
    <div class="single-blog-post style-4 mb-30">
        <div class="post-thumbnail">
            <?php umag_post_thumbnail(); ?>
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
            <a href="<?php the_permalink(); ?>" class="post-title"><?php the_title() ?></a>
            <div class="post-meta d-flex">
                <?= umag_post_meta() ?>
            </div>
        </div>
    </div>
</article>
