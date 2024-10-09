<?php
    /**
     * Template Name: Login Page
     * Template Post Type: page
     */
    get_header();
    umag_breadcrumb(get_the_post_thumbnail_url(), get_the_title());
    umag_breadcrumb_nav();
?>

<!-- ##### Login Area Start ##### -->
<div class="mag-login-area py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-6">
                <div class="login-content bg-white p-30 box-shadow">
                    <!-- Section Title -->
                    <div class="section-heading">
                        <h5><?php esc_html_e('Please Login', 'umag'); ?></h5>
                    </div>

                    <div>
                        <?php
                            if (have_posts()) {
                                while (have_posts()) {
                                    the_post();
                                    the_content();
                                }
                            }
                        ?>
                    </div>
                    <?php if (!is_user_logged_in()): ?>
                        <form method="post" class="login-form">
                            <div class="form-group">
                                <input id="email" name="email" type="email" class="form-control"
                                       placeholder="<?php esc_html_e('Email', 'umag'); ?>" required>
                            </div>
                            <div class="form-group">
                                <input id="password" name="password" type="password" class="form-control"
                                       placeholder="<?php esc_html_e('Password', 'umag'); ?>" required>
                            </div>
                            <div class="form-group">
                                <div class="custom-control custom-checkbox mr-sm-2">
                                    <input type="checkbox" class="custom-control-input" id="remember" name="remember">
                                    <label class="custom-control-label"
                                           for="remember"><?php esc_html_e('Remember Me', 'umag'); ?></label>
                                </div>
                            </div>
                            <button type="submit"
                                    class="btn mag-btn mt-30"><?php esc_html_e('Login', 'umag'); ?></button>
                            <?php wp_nonce_field('login_action', 'login_field') ?>
                        </form>
                    <?php else: ?>
                        <div class="alert alert-success mt-4" role="alert">
                            <?php printf(/* translators: %s: logout url */ __('You are already logged in. <a href="%s">Logout</a>.'), wp_logout_url(home_url('/'))); ?>
                        </div>
                    <?php
                    endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- ##### Login Area End ##### -->
<?php get_footer() ?>
