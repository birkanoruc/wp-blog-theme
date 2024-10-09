<!-- Single Blog Post -->
<article <?php post_class('hero-blog-post bg-img bg-overlay'); ?> id="home-slider-<?php the_ID(); ?>" style="background-image: url(<?= get_the_post_thumbnail_url(get_the_ID(), 'full'); ?>);">
    <div class="container h-100">
        <div class="row h-100 align-items-center">
            <div class="col-12">
            <!-- Post Contetnt -->
                <div class="post-content text-center">
                    <div class="post-meta" data-animation="fadeInUp" data-delay="100ms">
                        <a href="<?= get_the_permalink() ?>"><?php the_category(' ') ?></a>

                        <a href="#"><?= get_the_date() ?></a>
                    </div>
                <a href="<?php the_permalink() ?>" class="post-title" data-animation="fadeInUp" data-delay="300ms"><?php the_title() ?></a>
                <?php if('video' === get_post_format()): ?>
                <a href="<?php the_permalink() ?>" class="video-play" data-animation="bounceIn" data-delay="500ms"><i class="fa fa-play"></i></a>
                <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</article>