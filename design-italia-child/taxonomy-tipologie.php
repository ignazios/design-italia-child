<?php get_header();?>
<section id="content" role="main" class="container-fluid">
   <div class="container-fluid">
      <div class="row">
		  <div class="col-12 col-lg-9 pl-3">
		  	<header class="header">
		  		<h4 class="entry-title">Documenti sezione : <?php echo single_cat_title( '', false ) ; ?></h4>
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