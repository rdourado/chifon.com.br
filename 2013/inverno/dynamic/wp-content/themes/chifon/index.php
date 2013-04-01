<?php 
/*
Template name: Início
*/
$lookID = get_page_by_path( 'colecao/lookbook' );
?>
<?php is_ajax() ? ob_start() : get_header(); ?>
	<div id="body" class="cf">
		<div class="facebook-like-box">
			<iframe src="//www.facebook.com/plugins/likebox.php?href=https%3A%2F%2Fwww.facebook.com%2FChifonOficial&amp;width=292&amp;height=260&amp;show_faces=false&amp;colorscheme=light&amp;stream=true&amp;border_color=%23ffffff&amp;header=false&amp;appId=472574189476629" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:292px; height:260px;" allowTransparency="true"></iframe>
		</div>
		<div class="highlight">
			<a href="<?php echo get_permalink( $lookID ); ?>">
				<h2 class="hl-title">
					<img src="<?php t_url(); ?>/img/txt-lookbook.png?3" alt="Lookbook">
				</h2>
				<img src="<?php t_url(); ?>/img/img-lookbook.jpg" alt="" class="hl-image" width="622" height="264">
			</a>
		</div>
	</div>
<?php is_ajax() ? json_content() : get_footer(); ?>