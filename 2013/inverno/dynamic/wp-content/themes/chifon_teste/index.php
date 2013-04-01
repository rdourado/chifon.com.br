<?php 
/*
Template name: Início
*/
?>
<?php get_header(); $lookID = get_page_by_path( 'colecao/lookbook' ); ?>
	<div id="body" class="cf">
		<div class="facebook-like-box">
			<div class="fb-like-box" data-href="https://www.facebook.com/ChifonOficial" data-width="292" data-height="260" data-show-faces="true" data-stream="true" data-border-color="#ffffff" data-header="false"></div>
		</div>
		<div class="highlight">
			<!-- <a href="<?php echo get_permalink( $lookID ); ?>"> -->
				<h2 class="hl-title">
					<img src="<?php t_url(); ?>/img/txt-lookbook.png?1" alt="Lookbook">
				</h2>
				<img src="<?php t_url(); ?>/img/img-lookbook.jpg" alt="" class="hl-image" width="622" height="264">
			<!-- </a> -->
		</div>
	</div>
<?php get_footer(); ?>