<?php 
/*
Template name: Clipping
*/
?>
<?php get_header(); ?>
	<div id="body" class="cf">
		<article class="hentry">
<?php 		while( have_posts() ) : the_post();
			$clipping = get_field( 'clipping' );
			$index = $_GET['clip'] ? $_GET['clip'] : 0; ?>
			<h1 class="entry-title">Clipping <small id="current"><?php echo $clipping[$index]['mes']; ?></small></h1>
			<div class="filter">
				<label for="months">Selecione o mês</label>
				<select id="months" data-action="<?php echo get_permalink(); ?>">
<?php 				foreach( $clipping as $i => $clip ) : ?>
					<option value="<?php echo $i; ?>"<?php 
					if ($i == $index) echo ' selected="selected"'; 
					?>><?php echo $clip['mes']; ?></option>
<?php 				endforeach; ?>
				</select>
			</div>
			<div class="entry-content">
<?php 			$clip = $clipping[$index]; ?>
				<ul id="<?php echo sanitize_title( $clip['mes'] ); ?>" class="clips slider">
<?php 				foreach( $clip['imagens'] as $img ) : ?>
					<li class="clip slide"><a href="<?php 
					echo $img['sizes']['large']; ?>" class="fancybox fancybox.image" rel="<?php 
					echo sanitize_title( $clip['mes'] ); ?>"><?php 
					echo wp_get_attachment_image( $img['id'], 'lookbook' ); 
					?><span></span></a></li>
<?php 				endforeach; ?>
				</ul>
			</div>
<?php 		endwhile; ?>
		</article>
	</div>
<?php get_footer(); ?>