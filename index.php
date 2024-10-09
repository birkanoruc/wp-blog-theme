<?php get_header(); ?>
    <main id="primary" class="site-main">
        <?php
            if (have_posts()) :

                if (is_home() && !is_front_page()) :
                    if (!empty(single_post_title('', false))) :
                        umag_breadcrumb(get_the_post_thumbnail_url(), single_post_title('', false));
                    endif;
                endif;


                ?>
                <section class="archive-post-area mt-30">
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-12 col-xl-8">
                                <div class="archive-posts-area bg-white p-30 mb-30 box-shadow">
                                    <?php
                                        while (have_posts()) {
                                            the_post();
                                            get_template_part('template-parts/feeds/feed', 'archive');
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
                    </div>
                </section>
            <?php
            else :
                get_template_part('template-parts/feed', 'none');
            endif;
        ?>
    </main>
<?php
    get_footer();
