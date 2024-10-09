<?php get_header(); ?>

	<main id="primary" class="site-main">

		<?php
			umag_breadcrumb(get_the_post_thumbnail_url(),get_the_title());
			umag_breadcrumb_nav();
		?>

		<section class="post-details-area">
			<div class="container">
				<div class="row justify-content-center">
					<?php
						while (have_posts()) :
							the_post();
							echo '<div class="col-12 col-xl-8">';
							get_template_part('template-parts/content', get_post_type());
							echo '</div>';
							echo '<div class="col-12 col-md-6 col-lg-5 col-xl-4">';
							get_sidebar();
							echo '</div>';
						endwhile;
					?>
				</div>
			</div>
		</section>

	</main>

<?php get_footer(); ?>
