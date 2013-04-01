<?php 
/*
Template name: Lojas
*/
?>
<?php is_ajax() ? ob_start() : get_header(); ?>
	<div id="body" class="cf">
		<article class="hentry">
<?php 		while( have_posts() ) : the_post();
			$lojas = get_field( 'lojas' ); ?>
			<h1 class="entry-title">Lojas</h1>
			<div class="entry-content">
				<div class="info-box delivery">
					<?php the_content(); ?>
				</div>
				<div class="info-box">
					<div class="storesfilter">
						<h2 class="info-title">Selecione a loja</h2>
						<select id="lojas">
<?php 						foreach( $lojas as $i => $loja ) : ?>
							<option value="loja<?php echo $i+1; ?>"><?php echo $loja['nome']; ?></option>
<?php 						endforeach; ?>
						</select>
					</div>
<?php 				foreach( $lojas as $i => $loja ) : ?>
					<div id="loja<?php echo $i+1; ?>" class="loja">
					    <h2 class="info-title store-name"><?php echo $loja['nome']; ?></h2>
					    <p class="info-text"><?php 
					    $endereco = $loja['endereco'];
					    $endereco = str_replace( '[' , '<span>', $endereco );
					    $endereco = str_replace( ']' , '</span>', $endereco );
					    echo $endereco; ?></p>
					</div>
<?php 				endforeach; ?>
					<div id="map_canvas"></div>
				</div>
			</div>
<?php 		endwhile; ?>
		</article>
	</div>
<?php is_ajax() ? json_content() : get_footer(); ?>