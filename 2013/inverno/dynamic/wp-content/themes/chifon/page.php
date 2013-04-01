<?php is_ajax() ? ob_start() : get_header(); ?>
	<div id="body" class="cf">
<?php 	while( have_posts() ) : the_post(); ?>
		<article class="hentry">
			<h1 class="entry-title"><?php the_title(); ?></h1>
			<div class="entry-content">
				<?php the_content(); ?>
			</div>
		</article>
<?php 	endwhile; ?>
	</div>
<?php is_ajax() ? json_content() : get_footer(); ?>