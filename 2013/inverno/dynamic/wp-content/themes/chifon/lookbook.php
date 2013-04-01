<?php 
/*
Template name: Lookbook
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

			<div class="entry-content">
<?php 			$images = get_field( 'gallery' );
				if ( $images ) : ?>
				<ul class="slider">
<?php 				foreach( $images as $img ) : ?>
					<li class="slide"><a href="<?php echo $img['sizes']['large']; ?>" class="fancybox fancybox.image" rel="fancy"><?php 
					echo wp_get_attachment_image( $img['id'], 'lookbook' ); ?><span></span></a></li>
<?php 				endforeach; ?>
				</ul>
<?php 			endif; ?>

			</div>
		</article>
	</div>
<?php is_ajax() ? json_content() : get_footer(); ?>