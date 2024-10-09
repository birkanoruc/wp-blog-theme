<article <?php post_class('single-catagory-post d-flex flex-wrap'); ?> id="archive-post-<?php the_ID(); ?>">

    <div class="post-thumbnail bg-img" style="background-image: url(<?php the_post_thumbnail_url('full'); ?>);">
        <?php if('video' === get_post_format()): ?>
            <a href="<?php the_permalink() ?>" class="video-play"><i class="fa fa-play"></i></a>
        <?php endif; ?>
    </div>

    <div class="post-content">
        <div class="post-meta">
            <a href="<?php the_permalink() ?>" class="post-date"><?= get_the_date() ?></a>
            <?php the_category(' / '); ?>
        </div>
        <a href="<?php the_permalink(); ?>" class="post-title"><?php the_title() ?></a>
        <!-- Post Meta -->
        <div class="post-meta-2">
            <?= umag_post_meta() ?>
        </div>
        <p>
        <?= wp_trim_words(get_the_content(), 15) ?>
        </p>
    </div>

</article>