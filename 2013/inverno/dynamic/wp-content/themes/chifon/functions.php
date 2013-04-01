<?php 

$t_url = get_template_directory_uri();

function t_url() {
	global $t_url;
	echo $t_url;
}

/* Setup */

add_action( 'after_setup_theme', 'my_setup' );

function my_setup() {
	add_image_size( 'lookbook', 311, 482, true );
}

/* Scripts */

add_action( 'wp_enqueue_scripts', 'my_scripts' );

function my_scripts() {
	global $t_url;
	
	wp_deregister_script( 'jquery' );
	//wp_register_script( 'jquery', 'http://code.jquery.com/jquery-1.9.1.min.js', array(), null, true );
	wp_register_script( 'jquery', 'http://code.jquery.com/jquery-1.9.1.min.js', array(), null, true );
	wp_register_script( 'jquery-migrate', 'http://code.jquery.com/jquery-migrate-1.1.1.min.js', array( 'jquery' ), null, true );
	wp_enqueue_script( 'jquery' );
	wp_enqueue_script( 'jquery-migrate' );
	
	//wp_enqueue_script( 'jquery-migrate', "http://code.jquery.com/jquery-migrate-1.1.1.min.js", array( 'jquery' ), null, true );
	//if ( is_page( array( 'lookbook', 'clipping' ) ) )
	//	wp_enqueue_script( 'fancybox', "{$t_url}/js/fancybox/jquery.fancybox.pack.js", array( 'jquery' ), false, true );
	//wp_enqueue_script( 'jqmask', "{$t_url}/js/jquery.mask.min.js", array( 'jquery' ), false, true );
	//wp_enqueue_script( 'interface', "{$t_url}/js/interface.js", array( 'jquery' ), filemtime( TEMPLATEPATH . '/js/interface.js' ), true );
	wp_enqueue_script( 'interface', '/min/?g=chifon-js', array( 'jquery' ), filemtime( TEMPLATEPATH . '/js/interface.js' ), true );
}

/* Menu */

add_action( 'init', 'custom_navigation_menus' );

function custom_navigation_menus() {
	$locations = array(
		'header_menu' => 'Menu Principal',
		'collection_menu' => 'Coleção',
	);

	register_nav_menus( $locations );
}

/* Admin */

if ( ! isset( $content_width ) )
	$content_width = 660;

add_action( 'wp_dashboard_setup', 'remove_dashboard_widgets' );

function remove_dashboard_widgets() {
	remove_meta_box( 'dashboard_browser_nag', 'dashboard', 'normal' );
	remove_meta_box( 'dashboard_right_now', 'dashboard', 'normal' );
	remove_meta_box( 'dashboard_recent_comments', 'dashboard', 'normal' );
	remove_meta_box( 'dashboard_incoming_links', 'dashboard', 'normal' );
	remove_meta_box( 'dashboard_plugins', 'dashboard', 'normal' );
	remove_meta_box( 'dashboard_quick_press', 'dashboard', 'side' );
	remove_meta_box( 'dashboard_recent_drafts', 'dashboard', 'side' );
	//remove_meta_box( 'dashboard_primary', 'dashboard', 'side' );
	//remove_meta_box( 'dashboard_secondary', 'dashboard', 'side' );
} 

/* Ajax */

add_filter( 'page_link', 'get_page_redirect_link', 10, 2 );

function get_page_redirect_link( $url, $pageID ) {
	if ( $redirect = get_field( '_yoast_wpseo_redirect', $pageID ) )
		return $redirect;
	return $url;
}

function is_ajax() {
	if ( ! empty( $_SERVER['HTTP_X_REQUESTED_WITH'] ) && strtolower( $_SERVER['HTTP_X_REQUESTED_WITH'] ) == 'xmlhttprequest' && ! empty( $_GET['ajax'] ) )
		return true;
	return false;
}

function json_content() {
	$json = ob_get_contents();
	ob_end_clean();

	global $post, $t_url;
	$image = '';
	if ( is_front_page() )
		$image = "{$t_url}/img/img-inverno.jpg";
	elseif ( is_page( 'a-marca' ) )
		$image = "{$t_url}/img/img-marca.jpg";
	elseif ( is_page( 'clipping' ) )
		$image = "{$t_url}/img/img-clipping.jpg";
	elseif ( is_page( 'contato' ) )
		$image = "{$t_url}/img/img-contato.jpg";
	elseif ( is_page( 'lojas' ) )
		$image = "{$t_url}/img/img-lojas-big.jpg";
	elseif ( is_page( array( 'trabalhe-conosco', 'club-chifon' ) ) )
		$image = "{$t_url}/img/img-trabalhe.jpg";

	echo json_encode( array(
		'ID' => $post->ID,
		'image' => $image,
		'slug' => is_front_page() ? 'home' : $post->post_name,
		'post_content' => $json,
	) );
}
