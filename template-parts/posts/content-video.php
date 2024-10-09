<article <?php post_class('post-details-content bg-white mb-30 p-30 box-shadow'); ?> id="single-post-<?php the_ID() ?>">

    <figure class="blog-thumb mb-30">
        <?php umag_post_thumbnail(); ?>
    </figure>

    <section class="post-meta">
        <div class="row">
            <div class="col-7"><?php the_category(' / '); ?></div>
            <div class="col-5 text-right"><a href="<?php the_permalink(); ?>"><?= get_the_date() ?></a></div>
        </div>
    </section>

    <header>
        <span class="post-title"><?php the_title() ?></span>
    </header>

    <main class="entry-content">
        <?php the_content() ?>
    </main>


    <section class="post-meta-2">
        <div class="row align-items-center">
            <div class="col-7">
                <?= umag_post_meta() ?>
            </div>
            <div class="col-5 text-right">
                <?= umag_post_like_button() ?>
            </div>
        </div>
    </section>

    <section class="post-meta">
        <?php umag_posted_by(); ?>
        <?php umag_posted_on(); ?>
        <?php umag_updated_on(); ?>
        <?php umag_posted_in(); ?>
        <?php umag_posted_tags(); ?>
        <?php umag_posted_comment() ?>
        <?php umag_edit_post_link(); ?>
    </section>

    <?php if (!empty(get_theme_mod('umag_social_share_shortcode'))): ?>
        <section class="my-5">
            <?= do_shortcode(get_theme_mod('umag_social_share_shortcode')) ?>
        </section>
    <?php endif; ?>

    <?php if (get_theme_mod('umag_author_toggle', 'true')): ?>
        <section class="post-author d-flex align-items-center">
            <figure class="post-author-thumb">
                <?= get_avatar(get_the_author_meta('ID'), '80') ?>
            </figure>
            <div class="post-author-desc pl-4">
                <a href="<?= get_author_posts_url(get_the_author_meta('ID')) ?>"
                   class="author-name"><?= get_the_author_meta('display_name') ?></a>
                <?= wpautop(get_the_author_meta('description')) ?>
            </div>
        </section>
    <?php endif; ?>

</article>

<?php
    $args = array(
        'order' => 'DESC',
        'category__in' => wp_get_post_categories(get_the_ID()),
        'post_not_in' => array(get_the_ID()),
        'orderby' => 'rand',
        'posts_per_page' => 3,
        'tax_query' => array(
            array(
                'taxonomy' => 'post_format',
                'field' => 'slug',
                'terms' => array(
                    'post-format-video',
                ),
                'operator' => 'IN',

            ),
        ),
    );

    umag_related_post($args);

    if (comments_open() || get_comments_number()) : comments_template(); endif;
?>