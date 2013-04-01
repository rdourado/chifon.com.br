<?php 
/*
Template name: Coleção
*/
?>
<?php is_ajax() ? ob_start() : get_header(); ?>
	<div id="body" class="cf">
		<article class="hentry">
			<h1 class="entry-title">Coleção</h1>
			<?php 
			wp_nav_menu( array(
				'theme_location'  => 'collection_menu',
				'container'       => 'nav', 
				'container_class' => 'entry-nav', 
				'menu_class'      => 'entry-menu',
				'fallback_cb'     => '',
				'depth'           => 1,
			) ); 
			?>

<?php 		while( have_posts() ) : the_post(); ?>
			<div class="entry-content">
				<?php the_content(); ?>
			</div>
<?php 		endwhile; ?>
		</article>
	</div>
<?php is_ajax() ? json_content() : get_footer(); ?>