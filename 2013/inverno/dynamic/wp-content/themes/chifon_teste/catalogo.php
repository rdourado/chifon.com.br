<?php 
/*
Template name: Catálogo
*/
?>
<?php get_header(); ?>
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

			<div class="entry-content">
<?php 			$images = get_field( 'gallery' );
				if ( $images ) : ?>
				<div class="wide-viewport">
					<button class="wide-prev"></button><button class="wide-next"></button>
					<div class="wide-overview">
						<ul class="wide-slider">
<?php 						foreach( $images as $img ) : ?>
							<li class="slide"><?php 
							echo wp_get_attachment_image( $img['id'], 'full', false, array(
								'class' => $img['width'] < $img['height'] ? 'vertical' : 'horizontal'
							) ); 
							?></li>
<?php 						endforeach; ?>
						</ul>
					</div>
				</div>
<?php 			endif; ?>
			</div>
		</article>
	</div>
<?php get_footer(); ?>