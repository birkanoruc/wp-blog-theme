<!-- Single Trending Post -->
<article <?php post_class('single-trending-post'); ?> id="home-widget-1-<?php the_ID(); ?>" >
    <?php the_post_thumbnail('umag_home_widget_1'); ?>
    <div class="post-content">
        <?php
        foreach (get_the_category() as $cat)
        {
            echo '<a href="'. get_category_link($cat->term_id) .'" class="post-cata">'.$cat->name.'</a>';
        }
        ?>

        <a href="<?= get_the_permalink() ?>" class="post-title"><?php the_title() ?></a>
    </div>
</article>