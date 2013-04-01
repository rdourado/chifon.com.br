<?php 
/*
Template name: Contato
*/
?>
<?php get_header(); ?>
	<div id="body" class="cf">
<?php 	while( have_posts() ) : the_post(); ?>
		<article class="hentry">
			<h1 class="entry-title"><?php the_title(); ?></h1>
			<div class="entry-content cf">
				<div class="first-form"><?php insert_cform( '3' ); ?></div>
				<div class="second-form"><?php insert_cform( '4' ); ?></div>
			</div>
		</article>
<?php 	endwhile; ?>
	</div>
<?php get_footer(); ?>