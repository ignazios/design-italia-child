<?php 
get_header();
//var_dump($_SERVER);
 ?>
<section id="content" role="main" class="container-fluid">
   <div class="container-fluid">
      <div class="row">
		  <div class="col-12 col-lg-9 pl-3">
		  	<header class="header">
		  		<?php //if ( '' != category_description() ) echo apply_filters( 'archive_meta', '<div class="archive-meta">' . category_description() . '</div>' ); ?>
		  		<h3 class="entry-title">Documenti Trasparenza: <?php echo $Mese." ".$Anno; ?></h3>
		  	</header>
		  	<div class="container">
		  		<?php
		  if (have_posts() )
			  :
		  while ( have_posts() )
			  : the_post(); ?>
		  		<?php get_template_part( 'template-parts/section', 'art_list-item' ); ?>
		  		<?php endwhile; endif; ?>
		  	</div>
		  	<?php get_template_part( 'nav', 'below' ); ?>

		  </div>
	      <div class="col-lg-3">
	         <?php dynamic_sidebar( 'amm-trasparente-widget-area' ); ?>
	      </div>
		</div>
	</div>
</section>

<?php get_footer(); ?>