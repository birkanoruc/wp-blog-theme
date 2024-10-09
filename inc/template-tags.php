<?php

    if (!function_exists('umag_posted_on')) :
        /**
         * Prints HTML with meta information for the current post-date/time.
         */
        function umag_posted_on()
        {
            $time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time>';

            $time_string = sprintf(
                $time_string,
                esc_attr(get_the_date(DATE_W3C)),
                esc_html(get_the_date()),
            );

            $posted_on = sprintf(
            /* translators: %s: post date. */
                esc_html_x('Posted on %s', 'post date', 'umag'),
                '<a href="' . esc_url(get_permalink()) . '" rel="bookmark">' . $time_string . '</a>'
            );

            echo '<span class="posted-on d-block">' . $posted_on . '</span>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

        }
    endif;

    if (!function_exists('umag_updated_on')):
        /**
         * Prints HTML with meta information for the current update post-date/time.
         */
        function umag_updated_on()
        {
            $time_string = '<time class="updated" datetime="%1$s">%2$s</time>';
            if (get_the_time('U') !== get_the_modified_time('U')) {
                $time_string = '<time class="updated" datetime="%1$s">%2$s</time>';
            }

            $time_string = sprintf(
                $time_string,
                esc_attr(get_the_modified_date(DATE_W3C)),
                esc_html(get_the_modified_date())
            );

            $updated_on = sprintf(
            /* translators: %s: post update date. */
                esc_html_x('Updated on %s', 'post update date', 'umag'),
                '<a href="' . esc_url(get_permalink()) . '" rel="bookmark">' . $time_string . '</a>'
            );

            echo '<span class="updated-on d-block">' . $updated_on . '</span>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
        }

    endif;

    if (!function_exists('umag_posted_by')) :
        /**
         * Prints HTML with meta information for the current author.
         */
        function umag_posted_by()
        {
            $byline = sprintf(
            /* translators: %s: post author. */
                esc_html_x('Posted by %s', 'post author', 'umag'),
                '<span class="author vcard"><a class="url fn n" href="' . esc_url(get_author_posts_url(get_the_author_meta('ID'))) . '">' . esc_html(get_the_author()) . '</a></span>'
            );

            echo '<span class="byline d-block"> ' . $byline . '</span>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
        }
    endif;

    if (!function_exists('umag_posted_in')):
        /**
         * Prints HTML with meta information for the categories.
         */
        function umag_posted_in()
        {
            // Hide category and tag text for pages.
            if ('post' === get_post_type()) {
                /* translators: used between list items, there is a space after the comma */
                $categories_list = get_the_category_list(esc_html__(' / ', 'umag'));
                if ($categories_list) {
                    /* translators: 1: list of categories. */
                    printf('<span class="cat-links d-block">' . esc_html__('Posted in %1$s', 'umag') . '</span>', $categories_list); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
                }
            }
        }
    endif;

    if (!function_exists('umag_posted_tags')):
        /**
         * Prints HTML with meta information for the tags.
         */
        function umag_posted_tags()
        {
            /* translators: used between list items, there is a space after the comma */
            $tags_list = get_the_tag_list('', esc_html_x(', ', 'list item separator', 'umag'));
            if ($tags_list) {
                /* translators: 1: list of tags. */
                printf('<span class="tags-links d-block">' . esc_html__('Tagged %1$s', 'umag') . '</span>', $tags_list); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
            }
        }
    endif;

    if (!function_exists('umag_posted_comment')):
        /**
         * Prints HTML with meta information for the comments.
         */
        function umag_posted_comment()
        {
            if (is_single() && !post_password_required() && (comments_open() || get_comments_number())) {
                echo '<span class="comments-link d-block">';
                comments_popup_link(
                    sprintf(
                        wp_kses(
                        /* translators: %s: post title */
                            __('Leave a Comment<span class="screen-reader-text"> on %s</span>', 'umag'),
                            array(
                                'span' => array(
                                    'class' => array(),
                                ),
                            )
                        ),
                        wp_kses_post(get_the_title())
                    )
                );
                echo '</span>';
            }
        }
    endif;

    if (!function_exists('umag_edit_post_link')):
        /**
         * Prints HTML with meta information for the edit post link.
         */
        function umag_edit_post_link()
        {
            edit_post_link(
                sprintf(
                    wp_kses(
                    /* translators: %s: Name of current post. Only visible to screen readers */
                        __('Edit <span class="screen-reader-text">%s</span>', 'umag'),
                        array(
                            'span' => array(
                                'class' => array(),
                            ),
                        )
                    ),
                    wp_kses_post(get_the_title())
                ),
                '<span class="edit-link d-block">',
                '</span>'
            );
        }
    endif;

    if (!function_exists('umag_post_thumbnail')) :
        /**
         * Displays an optional post thumbnail.
         *
         * Wraps the post thumbnail in an anchor element on index views, or a div
         * element when on single views.
         */
        function umag_post_thumbnail()
        {
            if (post_password_required() || is_attachment() || !has_post_thumbnail()) {
                return;
            }

            if (is_singular()) :
                ?>

                <div class="post-thumbnail">
                    <?php the_post_thumbnail(); ?>
                </div><!-- .post-thumbnail -->

            <?php else : ?>

                <a class="post-thumbnail" href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1">
                    <?php
                        the_post_thumbnail(
                            'post-thumbnail',
                            array(
                                'alt' => the_title_attribute(
                                    array(
                                        'echo' => false,
                                    )
                                ),
                            )
                        );
                    ?>
                </a>

            <?php
            endif; // End is_singular().
        }
    endif;

    if (!function_exists('wp_body_open')) :
        /**
         * Shim for sites older than 5.2.
         *
         * @link https://core.trac.wordpress.org/ticket/12563
         */
        function wp_body_open()
        {
            do_action('wp_body_open');
        }
    endif;

    if (!function_exists('umag_header_search')) {
        function umag_header_search()
        {
            $umag_header_search_placeholder = get_theme_mod('umag_header_search_placeholder', 'Search and hit enter...');
            if (!empty($umag_header_search_placeholder)) {
                ?>
                <section class="top-search-area">
                    <form action="<?= home_url('/') ?>" method="get">
                        <input type="search" name="s" id="topSearch"
                               placeholder="<?= esc_attr($umag_header_search_placeholder) ?>"
                               value="<?= get_search_query() ?>" required>
                        <button type="submit" class="btn"><i class="fa fa-search" aria-hidden="true"></i></button>
                    </form>
                </section>
                <?php
            }
        }
    }

    if (!function_exists('umag_header_button')) {
        function umag_header_button()
        {
            $umag_header_button_text = get_theme_mod('umag_header_button_text', 'Submit Video');
            $umag_header_button_link = get_theme_mod('umag_header_button_link', '#');
            $umag_header_button_icon = get_theme_mod('umag_header_button_icon', 'fa-cloud-upload');
            if (!empty($umag_header_button_text)) {
                ?>
                <a href="<?= esc_url($umag_header_button_link) ?>" class="submit-video"><span><i
                            class="fa <?= esc_attr($umag_header_button_icon) ?>"></i></span> <span
                        class="video-text"><?= esc_html($umag_header_button_text) ?></span></a>
                <?php
            }
        }
    }

    if (!function_exists('umag_header_icon')) {
        function umag_header_icon()
        {
            $umag_header_icon = get_theme_mod('umag_header_icon', 'fa-user');
            $umag_header_icon_link = get_theme_mod('umag_header_icon_link', '#');

            if (!empty($umag_header_icon)) {
                ?>
                <a href="<?= esc_url($umag_header_icon_link) ?>" class="login-btn"><i
                        class="fa <?= esc_attr($umag_header_icon) ?>" aria-hidden="true"></i></a>
                <?php
            }
        }
    }

    if (!function_exists('umag_header_nav_menu')) {
        function umag_header_nav_menu()
        {
            if (has_nav_menu('primary')) {
                $nav_menu_args = array(
                    'menu' => 'primary',
                    'theme_location' => 'primary',
                    'container_class' => 'classynav',
                );
                wp_nav_menu($nav_menu_args);
            } else {
                /* En basit derecede giriş yapmış kullanıcı kontrolü */
                if (current_user_can('manage_options')) {
                    printf( /* translators: %s: Yeni Menü Ekle Linki */
                        __('<span class="classynav-info">Primary Menu is null. <a href="%s">Create New Menu </a></span>', 'umag'), admin_url() . 'nav-menus.php');
                }
            }
        }
    }

    if (!function_exists('umag_header_nav_logo')) {
        function umag_header_nav_logo()
        {
            ?>
            <a href="<?= home_url('/') ?>" class="nav-brand">
                <?php
                    $custom_logo_id = get_theme_mod('custom_logo');
                    $logo = wp_get_attachment_image_src($custom_logo_id, 'full');
                    if (has_custom_logo()) {
                        echo '<img src="' . esc_url($logo[0]) . '" alt="' . get_bloginfo('name') . '">';
                    } else {
                        echo '<h1>' . get_bloginfo('name') . '</h1>';
                    }
                ?>
            </a>
            <?php
        }
    }

    if (!function_exists('umag_preloader')) {
        function umag_preloader()
        {
            if (true == get_theme_mod('umag_preloader_toggle', true)) {
                ?>
                <div class="preloader d-flex align-items-center justify-content-center">
                    <div class="spinner">
                        <div class="double-bounce1"></div>
                        <div class="double-bounce2"></div>
                    </div>
                </div>
                <?php
            }
        }
    }

    if (!function_exists('umag_post_views')) {
        function umag_post_views()
        {
            if (function_exists('the_views')) {
                return apply_filters('umag_post_views_filter', the_views(false));
            }
            return apply_filters('umag_post_views_filter', false);
        }
    }


    if (!function_exists('umag_post_like_count')) {
        function umag_post_like_count()
        {
            if (function_exists('wp_ulike')) {
                return apply_filters('umag_post_like_count_filter', wp_ulike_get_post_likes(get_the_ID()));
            }
            return apply_filters('umag_post_like_count_filter', false);
        }
    }

    if (!function_exists('umag_post_like_button')) {
        function umag_post_like_button()
        {
            if (function_exists('wp_ulike')) {
                return apply_filters('umag_post_like_button', wp_ulike('put'));
            }
            return apply_filters('umag_post_like_count_filter', false);
        }
    }

    if (!function_exists('umag_comment_like_button')) {
        function umag_comment_like_button()
        {
            if (function_exists('wp_ulike_comments')) {
                return apply_filters('umag_comment_like_button', wp_ulike_comments('put'));
            }
            return apply_filters('umag_comment_like_button', false);
        }
    }

    if (!function_exists('umag_share_buttons')) {
        function umag_share_buttons()
        {
            ob_start();
            ?>
            <a href="#" class="facebook" data-sharer="facebook" data-url="<?php the_permalink() ?>"><i
                    class="fa fa-facebook" aria-hidden="true"></i></a>
            <a href="#" class="twitter" data-sharer="twitter" data-url="<?php the_permalink() ?>"
               data-title="<?php the_title() ?>"><i class="fa fa-twitter" aria-hidden="true"></i></a>
            <?php
            return ob_get_clean();
        }
    }

    if (!function_exists('umag_post_meta')) {
        function umag_post_meta()
        {
            ob_start();
            if (umag_post_views() === 0 || umag_post_views() > 0): ?>
                <div class="d-inline-block"><a href="#"><i class="fa fa-eye"
                                                           aria-hidden="true"></i> <?= esc_html(umag_post_views()) ?>
                    </a>
                </div>
            <?php endif;
            if (umag_post_like_count() === 0 || umag_post_like_count() > 0): ?>
                <div class="d-inline-block"><a href="#"><i class="fa fa-thumbs-o-up"
                                                           aria-hidden="true"></i> <?= esc_html(umag_post_like_count()) ?>
                    </a></div>
            <?php endif; ?>
            <div class="d-inline-block"><a href="<?= get_the_permalink() . '#respond'; ?>"><i class="fa fa-comments-o"
                                                                                              aria-hidden="true"></i> <?= get_comments_number() ?>
                </a></div>
            <?php
            return ob_get_clean();
        }
    }

    if (!function_exists('umag_post_like_button')) {
        function umag_post_like_button()
        {
            if (function_exists('wp-ulike')) {
                return apply_filters('umag_post_like_button', wp_ulike('put'));
            }

            return apply_filters('umag_post_like_button', false);
        }
    }

    if (!function_exists('umag_breadcrumb')) {
        function umag_breadcrumb($thumbnail_url = '', $title = '')
        {
            ?>
            <section class="breadcrumb-area bg-img bg-overlay"
                     style="background-image: url(<?= esc_url($thumbnail_url) ?>);">
                <div class="container h-100">
                    <div class="row h-100 align-items-center">
                        <div class="col-12">
                            <div class="breadcrumb-content">
                                <h1>
                                    <?= $title; ?>
                                </h1>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <?php
        }
    }

    if (!function_exists('umag_breadcrumb_nav')) {
        function umag_breadcrumb_nav()
        {
            ?>
            <section class="mag-breadcrumb py-5">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <?php
                                /* === OPTIONS === */
                                $text['home'] = esc_html__('Home', 'umag');
                                $text['category'] = esc_html__('Archive by Category "%s"', 'umag');
                                $text['search'] = esc_html__('Search Results for "%s" Query', 'umag');
                                $text['tag'] = esc_html__('Posts Tagged "%s"', 'umag');
                                $text['author'] = esc_html__('Articles Posted by %s', 'umag');
                                $text['404'] = esc_html__('Error 404', 'umag');
                                $text['page'] = esc_html__('Page %s', 'umag');
                                $text['cpage'] = esc_html__('Comment Page %s', 'umag');

                                $wrap_before = '<nav class="breadcrumbs" aria-label="breadcrumb" itemscope itemtype="http://schema.org/BreadcrumbList"><ol class="breadcrumb">';
                                $wrap_after = '</ol></nav>';
                                $sep = '';
                                $before = '<li class="breadcrumb-item active" aria-current="page"><span class="breadcrumbs__current">';
                                $after = '</span></li>';

                                $show_on_home = 0;
                                $show_home_link = 1;
                                $show_current = 1;
                                $show_last_sep = 1;

                                global $post;
                                $home_url = home_url('/');
                                $link = '<li class="breadcrumb-item"><span itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">';
                                $link .= '<a class="breadcrumbs__link" href="%1$s" itemprop="item"><span itemprop="name">%2$s</span></a>';
                                $link .= '<meta itemprop="position" content="%3$s" />';
                                $link .= '</span></li>';
                                $parent_id = ($post) ? $post->post_parent : '';
                                $home_link = sprintf($link, $home_url, $text['home'], 1);

                                if (is_home() || is_front_page()) {

                                    if ($show_on_home) echo $wrap_before . $home_link . $wrap_after;

                                } else {

                                    $position = 0;

                                    echo $wrap_before;

                                    if ($show_home_link) {
                                        $position += 1;
                                        echo $home_link;
                                    }

                                    if (is_category()) {
                                        $parents = get_ancestors(get_query_var('cat'), 'category');
                                        foreach (array_reverse($parents) as $cat) {
                                            $position += 1;
                                            if ($position > 1) echo $sep;
                                            echo sprintf($link, get_category_link($cat), get_cat_name($cat), $position);
                                        }
                                        if (get_query_var('paged')) {
                                            $position += 1;
                                            $cat = get_query_var('cat');
                                            echo $sep . sprintf($link, get_category_link($cat), get_cat_name($cat), $position);
                                            echo $sep . $before . sprintf($text['page'], get_query_var('paged')) . $after;
                                        } else {
                                            if ($show_current) {
                                                if ($position >= 1) echo $sep;
                                                echo $before . sprintf($text['category'], single_cat_title('', false)) . $after;
                                            } elseif ($show_last_sep) echo $sep;
                                        }

                                    } elseif (is_search()) {
                                        if (get_query_var('paged')) {
                                            $position += 1;
                                            if ($show_home_link) echo $sep;
                                            echo sprintf($link, $home_url . '?s=' . get_search_query(), sprintf($text['search'], get_search_query()), $position);
                                            echo $sep . $before . sprintf($text['page'], get_query_var('paged')) . $after;
                                        } else {
                                            if ($show_current) {
                                                if ($position >= 1) echo $sep;
                                                echo $before . sprintf($text['search'], get_search_query()) . $after;
                                            } elseif ($show_last_sep) echo $sep;
                                        }

                                    } elseif (is_year()) {
                                        if ($show_home_link && $show_current) echo $sep;
                                        if ($show_current) echo $before . get_the_time('Y') . $after;
                                        elseif ($show_home_link && $show_last_sep) echo $sep;

                                    } elseif (is_month()) {
                                        if ($show_home_link) echo $sep;
                                        $position += 1;
                                        echo sprintf($link, get_year_link(get_the_time('Y')), get_the_time('Y'), $position);
                                        if ($show_current) echo $sep . $before . get_the_time('F') . $after;
                                        elseif ($show_last_sep) echo $sep;

                                    } elseif (is_day()) {
                                        if ($show_home_link) echo $sep;
                                        $position += 1;
                                        echo sprintf($link, get_year_link(get_the_time('Y')), get_the_time('Y'), $position) . $sep;
                                        $position += 1;
                                        echo sprintf($link, get_month_link(get_the_time('Y'), get_the_time('m')), get_the_time('F'), $position);
                                        if ($show_current) echo $sep . $before . get_the_time('d') . $after;
                                        elseif ($show_last_sep) echo $sep;

                                    } elseif (is_single() && !is_attachment()) {
                                        if (get_post_type() != 'post') {
                                            $position += 1;
                                            $post_type = get_post_type_object(get_post_type());
                                            if ($position > 1) echo $sep;
                                            echo sprintf($link, get_post_type_archive_link($post_type->name), $post_type->labels->name, $position);
                                            if ($show_current) echo $sep . $before . get_the_title() . $after;
                                            elseif ($show_last_sep) echo $sep;
                                        } else {
                                            $cat = get_the_category();
                                            $catID = $cat[0]->cat_ID;
                                            $parents = get_ancestors($catID, 'category');
                                            $parents = array_reverse($parents);
                                            $parents[] = $catID;
                                            foreach ($parents as $cat) {
                                                $position += 1;
                                                if ($position > 1) echo $sep;
                                                echo sprintf($link, get_category_link($cat), get_cat_name($cat), $position);
                                            }
                                            if (get_query_var('cpage')) {
                                                $position += 1;
                                                echo $sep . sprintf($link, get_permalink(), get_the_title(), $position);
                                                echo $sep . $before . sprintf($text['cpage'], get_query_var('cpage')) . $after;
                                            } else {
                                                if ($show_current) echo $sep . $before . get_the_title() . $after;
                                                elseif ($show_last_sep) echo $sep;
                                            }
                                        }

                                    } elseif (is_post_type_archive()) {
                                        $post_type = get_post_type_object(get_post_type());
                                        if (get_query_var('paged')) {
                                            $position += 1;
                                            if ($position > 1) echo $sep;
                                            echo sprintf($link, get_post_type_archive_link($post_type->name), $post_type->label, $position);
                                            echo $sep . $before . sprintf($text['page'], get_query_var('paged')) . $after;
                                        } else {
                                            if ($show_home_link && $show_current) echo $sep;
                                            if ($show_current) echo $before . $post_type->label . $after;
                                            elseif ($show_home_link && $show_last_sep) echo $sep;
                                        }

                                    } elseif (is_attachment()) {
                                        $parent = get_post($parent_id);
                                        $cat = get_the_category($parent->ID);
                                        $catID = $cat[0]->cat_ID;
                                        $parents = get_ancestors($catID, 'category');
                                        $parents = array_reverse($parents);
                                        $parents[] = $catID;
                                        foreach ($parents as $cat) {
                                            $position += 1;
                                            if ($position > 1) echo $sep;
                                            echo sprintf($link, get_category_link($cat), get_cat_name($cat), $position);
                                        }
                                        $position += 1;
                                        echo $sep . sprintf($link, get_permalink($parent), $parent->post_title, $position);
                                        if ($show_current) echo $sep . $before . get_the_title() . $after;
                                        elseif ($show_last_sep) echo $sep;

                                    } elseif (is_page() && !$parent_id) {
                                        if ($show_home_link && $show_current) echo $sep;
                                        if ($show_current) echo $before . get_the_title() . $after;
                                        elseif ($show_home_link && $show_last_sep) echo $sep;

                                    } elseif (is_page() && $parent_id) {
                                        $parents = get_post_ancestors(get_the_ID());
                                        foreach (array_reverse($parents) as $pageID) {
                                            $position += 1;
                                            if ($position > 1) echo $sep;
                                            echo sprintf($link, get_page_link($pageID), get_the_title($pageID), $position);
                                        }
                                        if ($show_current) echo $sep . $before . get_the_title() . $after;
                                        elseif ($show_last_sep) echo $sep;

                                    } elseif (is_tag()) {
                                        if (get_query_var('paged')) {
                                            $position += 1;
                                            $tagID = get_query_var('tag_id');
                                            echo $sep . sprintf($link, get_tag_link($tagID), single_tag_title('', false), $position);
                                            echo $sep . $before . sprintf($text['page'], get_query_var('paged')) . $after;
                                        } else {
                                            if ($show_home_link && $show_current) echo $sep;
                                            if ($show_current) echo $before . sprintf($text['tag'], single_tag_title('', false)) . $after;
                                            elseif ($show_home_link && $show_last_sep) echo $sep;
                                        }

                                    } elseif (is_author()) {
                                        $author = get_userdata(get_query_var('author'));
                                        if (get_query_var('paged')) {
                                            $position += 1;
                                            echo $sep . sprintf($link, get_author_posts_url($author->ID), sprintf($text['author'], $author->display_name), $position);
                                            echo $sep . $before . sprintf($text['page'], get_query_var('paged')) . $after;
                                        } else {
                                            if ($show_home_link && $show_current) echo $sep;
                                            if ($show_current) echo $before . sprintf($text['author'], $author->display_name) . $after;
                                            elseif ($show_home_link && $show_last_sep) echo $sep;
                                        }

                                    } elseif (is_404()) {
                                        if ($show_home_link && $show_current) echo $sep;
                                        if ($show_current) echo $before . $text['404'] . $after;
                                        elseif ($show_last_sep) echo $sep;

                                    } elseif (has_post_format() && !is_singular()) {
                                        if ($show_home_link && $show_current) echo $sep;
                                        echo get_post_format_string(get_post_format());
                                    }

                                    echo $wrap_after;

                                }
                            ?>
                        </div>
                    </div>
                </div>
            </section>
            <?php
        }
    }

    if (!function_exists('umag_comment_pagination')) {
        function umag_comment_pagination()
        {

            $args = array(
                'type' => 'list',
                'echo' => false,
            );

            $links = paginate_comments_links($args);

            $search = array("class='page-numbers", '<li>', 'page-numbers', 'current');
            $replace = array("class='page-numbers pagination", '<li class="page-item">', 'page-numbers page-link', 'current page-link');

            $links = str_replace($search, $replace, $links ?? '');

            echo $links;
        }
    }

    if (!function_exists('umag_archive_pagination')) {
        function umag_archive_pagination()
        {
            $args = array(
                'type' => 'list',
            );
            $links = paginate_links($args);

            if ($links !== null) {
                $search = array("class='page-numbers", "<li>", 'page-numbers"', 'current');
                $replace = array("class='page-numbers pagination", "<li class='page-item'>", 'page-numbers page-link"', 'current page-link');

                $links = str_replace($search, $replace, $links);

                echo $links;
            }
        }
    }

    if (!function_exists('umag_related_post')):
        function umag_related_post($args)
        {
            $query = new WP_Query($args);
            if (get_theme_mod('umag_related_post_toggle', true) && $query->have_posts()): ?>

                <section class="related-post-area bg-white mb-30 px-30 pt-30 box-shadow">
                    <div class="section-heading">
                        <h5><?php esc_html_e('Related Post', 'umag') ?></h5>
                    </div>
                    <div class="row">
                        <?php
                            while ($query->have_posts()) {
                                $query->the_post();
                                get_template_part('template-parts/feeds/feed', 'related');
                            }
                        ?>
                    </div>
                </section>

            <?php endif;
            wp_reset_postdata();
        }
    endif;
