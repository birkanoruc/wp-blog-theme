<?php
get_header();
?>

	<main id="primary" class="site-main">

		<?php
		umag_breadcrumb(get_template_directory_uri().'/assets/img/bg-img/40.jpg',esc_html__('404 Not Found!', 'umag'));
		umag_breadcrumb_nav();
		?>

		<div class="mag-login-area py-5">
			<div class="container">
				<div class="row justify-content-center">
					<div class="col-12 col-lg-6">
						<div class="login-content bg-white p-30 box-shadow text-center">
							<h4 class="post-title"><div class="section-heading"><h5><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'umag' ); ?></h5></div></h4>
							<p><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'umag' ); ?></p>
							<img alt="404" src="<?= get_template_directory_uri().'/assets/img/404.png'; ?>">
							<a class="btn btn-info " href="<?= home_url('/') ?>"><?php esc_html_e('Go Home Page', 'umag'); ?>
							</a>
						</div>
					</div>
				</div>
			</div>
		</div>

	</main>

<?php
get_footer();
