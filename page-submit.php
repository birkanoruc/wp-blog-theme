<?php
    /**
     * Template Name: Submit Page
     * Template Post Type: page
     */
    get_header();
    umag_breadcrumb(get_the_post_thumbnail_url(), get_the_title());
    umag_breadcrumb_nav();
?>

<section class="video-submit-area container">
    <div class="row justify-content-center">
        <div class="col-12 col-lg-8">
            <div class="video-submit-content mb-50 p-30 bg-white box-shadow">
                <div class="section-heading">
                    <h5><?php esc_html_e('Please Fill in the Information', 'umag'); ?></h5>
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

                <?php if (is_user_logged_in()): ?>
                    <div class="video-info mt-30">
                        <form class="post-submit">
                            <div class="form-group">
                                <label
                                    for="umag-thumbnail"><?php esc_html_e('Add Thumbnail Image', 'umag'); ?></label>
                                <input type="file" class="form-control-file" name="umag-thumbnail"
                                       id="umag-thumbnail">
                            </div>
                            <div class="form-group">
                                <label for="umag-title"><?php esc_html_e('Title', 'umag'); ?></label>
                                <input type="text" class="form-control" name="umag-title" id="umag-title" required>
                            </div>
                            <div class="form-group">
                                <label for="umag-content"><?php esc_html_e('Content', 'umag'); ?></label>
                                <?php wp_editor('', 'umag-content'); ?>
                            </div>
                            <div class="form-group">
                                <label for="umag-tags"><?php esc_html_e('Tags*', 'umag'); ?></label>
                                <input type="text" class="form-control" name="umag-tags" id="umag-tags">
                                <small><?php esc_html_e('Separate tags with commas!', 'umag'); ?></small>
                            </div>
                            <div class="form-group">
                                <label for="umag-category"><?php esc_html_e('Category', 'umag'); ?></label>
                                <select name="umag-category" id="umag-category" class="form-control">
                                    <?php
                                        $cats = get_categories();
                                        foreach ($cats as $cat) {
                                            echo '<option value="' . $cat->term_id . '">' . $cat->name . '</option>';
                                        }
                                    ?>
                                </select>
                            </div>
                            <button type="submit" class="btn mag-btn mt-30"><i class="fa fa-cloud-upload mr-2"></i>
                                <?php esc_html_e('Upload Content', 'umag'); ?>
                            </button>
                            <?php wp_nonce_field('submit_action', 'submit_field'); ?>
                        </form>
                    </div>
                <?php else: ?>
                    <div class="alert alert-success mt-4" role="alert">
                        <?php $login_link = get_page_link(get_theme_mod('umag_login_page')); ?>
                        <?php printf(/* translators: %s: login url */ __('You must be logged in to submit an article. <a href="%s">Login</a>.'), $login_link); ?>
                    </div>
                <?php
                endif; ?>
            </div>
        </div>
    </div>
</section>

<?php get_footer() ?>
