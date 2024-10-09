<article <?php post_class(); ?> id="single-post-<?php the_ID() ?>">
	<div class="post-details-content bg-white mb-30 p-30 box-shadow">
		<div class="blog-content">
			<h4 class="post-title"><?php the_title('<div class="section-heading"><h5>','</h5></div>') ?></h4>
			<div class="entry-content">
				<?php the_content() ?>
			</div>
		</div>
	</div>
	<?php
		if ( comments_open() || get_comments_number() ) :comments_template();
		endif;
	?>

</article>