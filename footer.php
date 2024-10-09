<footer id="colophon" class="site-footer footer-area">

    <section class="container">
        <div class="row">
            <?php
                $i = 0;
                if (is_active_sidebar('footer-1')) {
                    $i++;
                }
                if (is_active_sidebar('footer-2')) {
                    $i++;
                }
                if (is_active_sidebar('footer-3')) {
                    $i++;
                }
                if (is_active_sidebar('footer-4')) {
                    $i++;
                }

                if ($i > 0) { ?>

                    <?php if (is_active_sidebar('footer-1')) : ?>
                        <div class="col-12 col-sm-6 col-lg-<?= 12 / $i ?>">
                            <?php dynamic_sidebar('footer-1') ?>
                        </div>
                    <?php endif; ?>

                    <?php if (is_active_sidebar('footer-2')) : ?>
                        <div class="col-12 col-sm-6 col-lg-<?= 12 / $i ?>">
                            <?php dynamic_sidebar('footer-2') ?>
                        </div>
                    <?php endif; ?>

                    <?php if (is_active_sidebar('footer-3')) : ?>
                        <div class="col-12 col-sm-6 col-lg-<?= 12 / $i ?>">
                            <?php dynamic_sidebar('footer-3') ?>
                        </div>
                    <?php endif; ?>

                    <?php if (is_active_sidebar('footer-4')) : ?>
                        <div class="col-12 col-sm-6 col-lg-<?= 12 / $i ?>">
                            <?php dynamic_sidebar('footer-4') ?>
                        </div>
                    <?php endif; ?>

                    <?php
                }
            ?>
        </div>
    </section>

    <section class="copywrite-area">
        <div class="container">
            <div class="row">
                <div class="col-12 col-sm-6">
                    <p class="copywrite-text">
                        <?php
                            $footer_text = get_theme_mod('umag_footer_text', 'Copyright © 2023. All rights reserved | Birkanoruc.com.tr');
                            esc_html_e($footer_text, 'umag');
                        ?>
                    </p>
                </div>

                <div class="col-12 col-sm-6">
                    <?php
                        if (has_nav_menu('footer')) {
                            $nav_menu_args = array(
                                'theme_location' => 'footer',
                                'container' => false,
                                'depth' => 1,
                            );
                            echo '<nav class="footer-nav">';
                            wp_nav_menu($nav_menu_args);
                            echo '</nav>';
                        }
                    ?>
                </div>

            </div>
        </div>
    </section>

</footer>
</div>

<?php wp_footer(); ?>

</body>
</html>
