<?php if ( ! is_active_sidebar( 'sidebar-1' ) ) : return; endif; ?>

<aside id="secondary" class="widget-area sidebar-area bg-white mb-30 box-shadow">
	<?php dynamic_sidebar( 'sidebar-1' ); ?>
</aside>
