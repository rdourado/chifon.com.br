<!doctype html>
<html lang="pt-br">
<head>
	<meta charset="UTF-8">
	<title><?php wp_title(); ?></title>
	<link rel="stylesheet" href="/min/?g=chifon-css&amp;<?php echo filemtime( TEMPLATEPATH . '/style.css' ); ?>" media="screen">
	<!--[if lt IE 9]><link rel="stylesheet" href="<?php t_url(); ?>/ie8.css" media="screen"><![endif]-->
	<!--[if lt IE 9]><script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
	<!-- WP/ --><?php wp_head(); ?><!-- /WP -->
</head>
<body <?php body_class( "{$post->post_name} no-js" ); ?>>
	<div id="fb-root"></div>
	<script>(function(d, s, id) {
	  var js, fjs = d.getElementsByTagName(s)[0];
	  if (d.getElementById(id)) return;
	  js = d.createElement(s); js.id = id;
	  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=472574189476629";
	  fjs.parentNode.insertBefore(js, fjs);
	}(document, 'script', 'facebook-jssdk'));</script>

	<header id="head" class="cf">
<?php 	if ( is_front_page() ) : ?>
		<h1 id="logo"><a href="<?php echo home_url( '/' ); ?>"><img src="<?php t_url(); ?>/img/chifon.png" alt="Chifon" width="143" height="56"></a></h1>
		<img src="<?php t_url(); ?>/img/img-inverno.jpg" alt="" class="board" width="1280" height="534">
<?php 	else : ?>
		<div id="logo"><a href="<?php echo home_url( '/' ); ?>"><img src="<?php t_url(); ?>/img/chifon.png" alt="Chifon" width="143" height="56"></a></div>
<?php 	endif; ?>
		<nav id="nav">
			<?php 
			wp_nav_menu( array(
				'theme_location'  => 'header_menu',
				'container'       => false, 
				'menu_id'         => 'menu',
				'fallback_cb'     => '',
				'depth'           => 1,
			) ); 
			?>
			<form action="<?php echo home_url( '/wp-content/plugins/newsletter/do/subscribe.php' ) ?>" method="post" id="newsform" onsubmit="return newsletter_check(this)">
				<fieldset>
					<legend>Cadastre-se</legend>
					<input type="text" name="nn" id="nn" class="news-input newsletter-firstname" placeholder="nome" required aria-required="true" aria-label="Nome" value="nome" onfocus="if(this.value=='nome')this.value='';" onblur="if(this.value=='')this.value='nome';">
					<input type="email" name="ne" id="ne" class="news-input newsletter-email" placeholder="e-mail" required aria-required="true" aria-label="E-mail" value="e-mail" onfocus="if(this.value=='e-mail')this.value='';" onblur="if(this.value=='')this.value='e-mail';">
					<input type="text" name="np1" id="np1" class="news-input newsletter-profile newsletter-profile-1" placeholder="celular" required aria-required="true" aria-label="Celular" value="celular" onfocus="if(this.value=='celular')this.value='';" onblur="if(this.value=='')this.value='celular';">
					<input type="text" name="np2" id="np2" class="news-input newsletter-profile newsletter-profile-2" placeholder="aniversário dd/mm" required aria-required="true" aria-label="Aniversário" value="aniversário dd/mm" onfocus="if(this.value=='aniversário dd/mm')this.value='';" onblur="if(this.value=='')this.value='aniversário dd/mm';">
					<button type="submit" class="news-button">Enviar</button>
				</fieldset>
			</form>
		</nav>
		<ul class="social">
			<li class="social-item"><a href="http://www.facebook.com/ChifonOficial" target="_blank"><img src="<?php t_url(); ?>/img/icon-fb.png" alt="Facebook" width="17" height="16"></a></li>
			<li class="social-item"><a href="https://twitter.com/ChifonOficial" target="_blank"><img src="<?php t_url(); ?>/img/icon-tw.png" alt="Twitter" width="17" height="16"></a></li>
			<li class="social-item"><a href="http://www.youtube.com/user/chifonmodas" target="_blank"><img src="<?php t_url(); ?>/img/icon-yt.png" alt="Youtube" width="17" height="16"></a></li>
			<li class="social-item"><a href="http://statigr.am/lojaschifon" target="_blank"><img src="<?php t_url(); ?>/img/icon-ig.png" alt="Instagram" width="17" height="16"></a></li>
			<li class="social-item facebook-like"><div class="fb-like" data-href="https://www.facebook.com/ChifonOficial" data-send="false" data-layout="button_count" data-width="90" data-show-faces="false" data-font="arial"></div></li>
		</ul>
<?php 	if ( is_page( 'a-marca' ) ) : ?>
		<img src="<?php t_url(); ?>/img/img-marca.jpg" alt="" class="board" width="1280" height="300">
<?php 	elseif ( is_page( 'clipping' ) ) : ?>
		<img src="<?php t_url(); ?>/img/img-clipping.jpg" alt="" class="board" width="1280" height="300">
<?php 	elseif ( is_page( 'contato' ) ) : ?>
		<img src="<?php t_url(); ?>/img/img-contato.jpg" alt="" class="board" width="1280" height="300">
<?php 	elseif ( is_page( 'lojas' ) ) : ?>
		<img src="<?php t_url(); ?>/img/img-lojas-big.jpg" alt="" class="board" width="1280" height="300">
<?php 	elseif ( is_page( array( 'trabalhe-conosco', 'club-chifon' ) ) ) : ?>
		<img src="<?php t_url(); ?>/img/img-trabalhe.jpg" alt="" class="board" width="1280" height="300">
<?php 	endif; ?>
	</header>
