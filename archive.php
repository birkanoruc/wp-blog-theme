<?php get_header(); ?>

    <main id="primary" class="site-main">


        <?php
            $bg_id = get_term_meta(get_queried_object_id(), 'cat_image', true);
            umag_breadcrumb(wp_get_attachment_image_url($bg_id, "full"), get_the_archive_title());
            umag_breadcrumb_nav();
        ?>

        <section class="archive-post-area container">
                <div class="row justify-content-center">
                    <div class="col-12 col-xl-8">
                        <div class="archive-posts-area bg-white p-30 mb-30 box-shadow">
                            <?php
                                if (have_posts()) {
                                    while (have_posts()) {
                                        the_post();
                                        get_template_part('template-parts/feeds/feed', 'archive');
                                    }
                                } else {
                                    get_template_part('template-parts/feeds/feed', 'none');
                                }
                            ?>
                            <nav>
                                <?php umag_archive_pagination(); ?>
                            </nav>
                        </div>
                    </div>

                    <div class="col-12 col-md-6 col-lg-5 col-xl-4">
                        <?php get_sidebar() ?>
                    </div>
                </div>
        </section>

    </main>
<?php
    get_footer();
