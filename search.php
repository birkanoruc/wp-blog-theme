<?php get_header(); ?>

    <main id="primary" class="site-main">

        <?php
            umag_breadcrumb(get_template_directory_uri() . '/assets/img/search.jpg', sprintf(esc_html__('Search results for: %s', 'umag'), get_search_query()));
            umag_breadcrumb_nav();
        ?>

        <section class="archive-post-area container">
            <div class="row justify-content-center">
                <section class="archive-posts-area bg-white p-30 mb-30 box-shadow col-12 col-xl-8">
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
                </section>

                <section class="col-12 col-md-6 col-lg-5 col-xl-4">
                    <?php get_sidebar() ?>
                </section>
            </div>
        </section>

    </main>
<?php
    get_footer();
