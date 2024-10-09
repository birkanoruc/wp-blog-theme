<!-- Single Featured Post -->
<article <?php post_class('single-featured-post'); ?> id="home-widget-2-<?php the_ID(); ?>" >
    <!-- Thumbnail -->
    <div class="post-thumbnail mb-50">
        <?php the_post_thumbnail('umag_home_widget_2'); ?>
        <?php if('video' === get_post_format()): ?>
            <a href="<?php the_permalink() ?>" class="video-play"><i class="fa fa-play"></i></a>
        <?php endif; ?>
    </div>
    <!-- Post Contetnt -->
    <div class="post-content">
        <div class="post-meta">
            <a href="<?php the_permalink() ?>"><?= get_the_date() ?></a>
            <?php the_category('/'); ?>
        </div>
        <a href="<?= get_the_permalink() ?>" class="post-title"><?php the_title() ?></a>
        <?= wp_trim_words(get_the_content(), 30) ?>
    </div>
    <!-- Post Share Area -->
    <div class="post-share-area d-flex align-items-center justify-content-between">
        <!-- Post Meta -->
        <div class="post-meta pl-3">
        <?= umag_post_meta() ?>
        </div>
        <!-- Share Info -->
        <div class="share-info">
            <a href="#" class="sharebtn"><i class="fa fa-share-alt" aria-hidden="true"></i></a>
            <!-- All Share Buttons -->
            <div class="all-share-btn d-flex">
                <?= umag_share_buttons() ?>
            </div>
        </div>
    </div>
</article>