<!-- Single Team Member -->
<article <?php post_class('single-team-member d-flex align-items-center'); ?> id="ourteam-<?php the_ID(); ?>">
    <div class="team-member-thumbnail">
        <?php the_post_thumbnail('umag_ourteam') ?>
        <div class="social-btn">
            <?php
                $facebook = get_post_meta(get_the_ID(), 'facebook', true);
                $twitter = get_post_meta(get_the_ID(), 'twitter', true);
                $linkedin = get_post_meta(get_the_ID(), 'linkedin', true);
                $job = get_post_meta(get_the_ID(), 'job', true);

                echo !empty($facebook) ? '<a href="' . esc_url($facebook) . '"><i class="fa fa-facebook" aria-hidden="true"></i></a>' : '';
                echo !empty($twitter) ? '<a href="' . esc_url($twitter) . '"><i class="fa fa-twitter" aria-hidden="true"></i></a>' : '';
                echo !empty($linkedin) ? '<a href="' . esc_url($linkedin) . '"><i class="fa fa-linkedin" aria-hidden="true"></i></a>' : '';
            ?>
        </div>
    </div>
    <div class="team-member-content">
        <?php the_title('<h6>','</h6>') ?>
        <?php echo !empty($job) ? '<span>'.esc_html($job).'</span>' : ''; ?>
        <p><?php the_content(); ?></p>
    </div>
</article>
