<?php
    /**
     * Template Name: Home Page
     * Template Post Type: page
     */
    get_header();

    if (get_theme_mod('umag_home_slider_toggle', true)):

        $home_slider_args = array(
            'order' => 'DESC',
            'posts_per_page' => get_theme_mod('umag_home_slider_count', 3),
            'category__in' => get_theme_mod('umag_home_slider_select_categories', array()),
        );

        $home_slider_select_order = get_theme_mod('umag_home_slider_select_order', 'date');

        if ('date' === $home_slider_select_order) {
            $home_slider_args['orderby'] = 'date';
        } else if ('rand' === $home_slider_select_order) {
            $home_slider_args['orderby'] = 'rand';
        } else if ('comment_count' === $home_slider_select_order) {
            $home_slider_args['orderby'] = 'comment_count';
        }

        $home_slider = new WP_Query($home_slider_args);

        if ($home_slider->have_posts()) {
            ?>
            <div class="hero-area owl-carousel">
                <?php
                    while ($home_slider->have_posts()) {
                        $home_slider->the_post();
                        get_template_part('template-parts/widgets/home', 'slider');
                    }
                ?>
            </div>
            <?php
        } else {
            /* En basit derecede giriş yapmış kullanıcı kontrolü */
            if (current_user_can('manage_options')) {
                printf( /* translators: %s: Yeni Yazı Ekle Linki */
                    __('<div class="alert alert-danger" role="alert">Post is null. <a href="%s">Create Post </a></div>', 'umag'), admin_url() . 'post-new.php');
            }
        }
        wp_reset_postdata();

    endif;
?>

    <section class="mag-posts-area d-flex flex-wrap">

        <?php if (is_active_sidebar('home-left-sidebar')): ?>
            <div class="post-sidebar-area left-sidebar mt-30 mb-30 bg-white box-shadow">
                <?php dynamic_sidebar('home-left-sidebar'); ?>
            </div>
        <?php endif; ?>

        <div class="mag-posts-content mt-30 mb-30 p-30 box-shadow">
            <?php
                if (get_theme_mod('umag_home_widget_1_toggle', true)):
                    $home_widget_1_args = array(
                        'order' => 'DESC',
                        'posts_per_page' => get_theme_mod('umag_home_widget_1_count', 3),
                        'category__in' => get_theme_mod('umag_home_widget_1_select_categories', array()),
                    );

                    $home_widget_1_select_order = get_theme_mod('umag_home_widget_1_select_order', 'date');

                    if ('date' === $home_widget_1_select_order) {
                        $home_widget_1_args['orderby'] = 'date';
                    } else if ('rand' === $home_widget_1_select_order) {
                        $home_widget_1_args['orderby'] = 'rand';
                    } else if ('comment_count' === $home_widget_1_select_order) {
                        $home_widget_1_args['orderby'] = 'comment_count';
                    }

                    $home_widget_1 = new WP_Query($home_widget_1_args);

                    if ($home_widget_1->have_posts()) {
                        ?>
                        <div class="trending-now-posts mb-30">
                            <!-- Section Title -->
                            <div class="section-heading">
                                <h5><?= get_theme_mod('umag_home_widget_1_title', 'Trending Now') ?></h5>
                            </div>

                            <div class="trending-post-slides owl-carousel">
                                <?php
                                    while ($home_widget_1->have_posts()) {
                                        $home_widget_1->the_post();
                                        get_template_part('template-parts/widgets/home-widget', '1');
                                    }
                                ?>
                            </div>
                        </div>
                        <?php
                    } else {
                        /* En basit derecede giriş yapmış kullanıcı kontrolü */
                        if (current_user_can('manage_options')) {
                            printf( /* translators: %s: Yeni Yazı Ekle Linki */
                                __('<div class="alert alert-danger" role="alert">Post is null. <a href="%s">Create Post </a></div>', 'umag'), admin_url() . 'post-new.php');
                        }
                    }
                    wp_reset_postdata();
                endif;
            ?>

            <?php
                if (get_theme_mod('umag_home_widget_2_toggle', true)):
                    $home_widget_2_args = array(
                        'order' => 'DESC',
                        'posts_per_page' => get_theme_mod('umag_home_widget_2_count', 3),
                        'category__in' => get_theme_mod('umag_home_widget_2_select_categories', array()),
                    );

                    $home_widget_2_select_order = get_theme_mod('umag_home_widget_2_select_order', 'date');

                    if ('date' === $home_widget_2_select_order) {
                        $home_widget_2_args['orderby'] = 'date';
                    } else if ('rand' === $home_widget_2_select_order) {
                        $home_widget_2_args['orderby'] = 'rand';
                    } else if ('comment_count' === $home_widget_2_select_order) {
                        $home_widget_2_args['orderby'] = 'comment_count';
                    }

                    $home_widget_2 = new WP_Query($home_widget_2_args);
                    if ($home_widget_2->have_posts()) {
                        ?>
                        <!-- Feature Video Posts Area -->
                        <div class="feature-video-posts mb-30">
                            <!-- Section Title -->
                            <div class="section-heading">
                                <h5><?= get_theme_mod('umag_home_widget_2_title', 'Featured Videos') ?></h5>
                            </div>

                            <div class="featured-video-posts">
                                <div class="row">
                                    <?php
                                        $i = 0;
                                        while ($home_widget_2->have_posts()) {
                                            $i++;
                                            $home_widget_2->the_post();
                                            if ($i === 1) {
                                                echo '<div class="col-12 col-lg-7">';
                                                get_template_part('template-parts/widgets/home-widget', '2');
                                                echo '</div>';
                                            } elseif ($i === 2) {
                                                echo '<div class="col-12 col-lg-5">';
                                                echo '<div class="featured-video-posts-slide owl-carousel">';
                                            }

                                            if ($i % 5 === 2) {
                                                echo '<div class="single--slide">';
                                            }

                                            if ($i > 1) {
                                                get_template_part('template-parts/widgets/home-widget-2', '2');
                                            }

                                            if (($i > 1) && ($i % 5 === 1)) {
                                                echo '</div>';
                                            } elseif (($i > 1) && ($i % 5 !== 1) && ($i === $home_widget_2->post_count)) {
                                                echo '</div>';
                                            }

                                            if ($i > 1 && $i === $home_widget_2->post_count) {
                                                echo '</div>';
                                                echo '</div>';
                                            }

                                        }
                                    ?>
                                </div>
                            </div>
                        </div>
                        <?php
                    } else {
                        /* En basit derecede giriş yapmış kullanıcı kontrolü */
                        if (current_user_can('manage_options')) {
                            printf( /* translators: %s: Yeni Yazı Ekle Linki */
                                __('<div class="alert alert-danger" role="alert">Post is null. <a href="%s">Create Post </a></div>', 'umag'), admin_url() . 'post-new.php');
                        }
                    }
                    wp_reset_postdata();
                endif;
            ?>

            <?php
                if (get_theme_mod('umag_home_widget_3_toggle', true)):
                    $home_widget_3_args = array(
                        'order' => 'DESC',
                        'posts_per_page' => get_theme_mod('umag_home_widget_3_count', 3),
                        'category__in' => get_theme_mod('umag_home_widget_3_select_categories', array()),
                    );

                    $home_widget_3_select_order = get_theme_mod('umag_home_widget_3_select_order', 'date');

                    if ('date' === $home_widget_3_select_order) {
                        $home_widget_3_args['orderby'] = 'date';
                    } else if ('rand' === $home_widget_3_select_order) {
                        $home_widget_3_args['orderby'] = 'rand';
                    } else if ('comment_count' === $home_widget_3_select_order) {
                        $home_widget_3_args['orderby'] = 'comment_count';
                    }

                    $home_widget_3 = new WP_Query($home_widget_3_args);
                    if ($home_widget_3->have_posts()) {
                        ?>

                        <!-- Most Viewed Videos -->
                        <div class="most-viewed-videos mb-30">
                            <!-- Section Title -->
                            <div class="section-heading">
                                <h5><?= get_theme_mod('umag_home_widget_3_title', 'Most Viewed Videos') ?></h5>
                            </div>

                            <div class="most-viewed-videos-slide owl-carousel">
                                <?php
                                    while ($home_widget_3->have_posts()) {
                                        $home_widget_3->the_post();
                                        get_template_part('template-parts/widgets/home-widget', '3');
                                    }
                                ?>
                            </div>
                        </div>

                        <?php
                    } else {
                        /* En basit derecede giriş yapmış kullanıcı kontrolü */
                        if (current_user_can('manage_options')) {
                            printf( /* translators: %s: Yeni Yazı Ekle Linki */
                                __('<div class="alert alert-danger" role="alert">Post is null. <a href="%s">Create Post </a></div>', 'umag'), admin_url() . 'post-new.php');
                        }
                    }
                    wp_reset_postdata();
                endif;
            ?>

            <?php
                if (get_theme_mod('umag_home_widget_4_toggle', true)):
                    $home_widget_4_args = array(
                        'order' => 'DESC',
                        'posts_per_page' => get_theme_mod('umag_home_widget_2_count', 3),
                        'category__in' => get_theme_mod('umag_home_widget_2_select_categories', array()),
                    );

                    $home_widget_4_select_order = get_theme_mod('umag_home_widget_4_select_order', 'date');

                    if ('date' === $home_widget_4_select_order) {
                        $home_widget_4_args['orderby'] = 'date';
                    } else if ('rand' === $home_widget_4_select_order) {
                        $home_widget_4_args['orderby'] = 'rand';
                    } else if ('comment_count' === $home_widget_4_select_order) {
                        $home_widget_4_args['orderby'] = 'comment_count';
                    }

                    $home_widget_4 = new WP_Query($home_widget_4_args);
                    if ($home_widget_2->have_posts()) {
                        ?>
                        <!-- Sports Videos -->
                        <div class="sports-videos-area">
                            <!-- Section Title -->
                            <div class="section-heading">
                                <h5><?= get_theme_mod('umag_home_widget_4_title', 'Sports Videos') ?></h5>
                            </div>

                            <div class="sports-videos-slides owl-carousel mb-30">
                                <?php
                                    while ($home_widget_4->have_posts()) {
                                        $home_widget_4->the_post();
                                        get_template_part('template-parts/widgets/home-widget', '4');
                                    }
                                ?>
                            </div>
                        </div>
                        <?php
                    } else {
                        /* En basit derecede giriş yapmış kullanıcı kontrolü */
                        if (current_user_can('manage_options')) {
                            printf( /* translators: %s: Yeni Yazı Ekle Linki */
                                __('<div class="alert alert-danger" role="alert">Post is null. <a href="%s">Create Post </a></div>', 'umag'), admin_url() . 'post-new.php');
                        }
                    }
                    wp_reset_postdata();
                endif;
            ?>
        </div>

        <?php if (is_active_sidebar('home-right-sidebar')): ?>
            <div class="post-sidebar-area right-sidebar mt-30 mb-30 box-shadow">
                <?php dynamic_sidebar('home-right-sidebar'); ?>
            </div>
        <?php endif; ?>
    </section>
<?php
    get_footer();
?>