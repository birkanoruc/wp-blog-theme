<?php get_header(); ?>

<main id="primary" class="site-main">

    <?php
        umag_breadcrumb(get_the_post_thumbnail_url(), get_the_title());
        umag_breadcrumb_nav();
    ?>

    <section class="post-details-area container">

            <?php if ('video' === get_post_format()):
                $iframe = get_post_meta(get_the_ID(), 'video_iframe', true);
                if (!empty($iframe)) :
                    ?>
                    <section class="single-video-area bg-white mb-30 box-shadow">
                        <div class="row">
                            <div class="col-12">
                                <?= $iframe ?>
                            </div>
                        </div>
                    </section>
                <?php endif;
            endif;
            ?>

            <section class="row justify-content-center">
                <?php
                    while (have_posts()) :
                        the_post();
                        echo '<div class="col-12 col-xl-8">';
                        get_template_part('template-parts/posts/content', get_post_format());
                        echo '</div>';
                        echo '<div class="col-12 col-md-6 col-lg-5 col-xl-4">';
                        get_sidebar();
                        echo '</div>';
                    endwhile;
                ?>
            </section>

    </section>

</main>

<?php get_footer(); ?>
