<?php get_header(); ?>
<section id="content" role="main" class="container-fluid">
   <div class="container-fluid">
      <div class="row">

      <div class="col-12 col-lg-9 pl-3">
		   <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<header>
					<h3 class="entry-title"><?php the_title(); ?></h3><?php edit_post_link(); ?>
					<div class="row metarticoli">
								<i class="fas fa-calendar-alt pr-2"></i> <a href="<?php echo esc_url(home_url('/')).get_the_time('Y')."/".get_the_time('m');?>"><?php the_time('j M y'); ?></a>
								<i class="fas fa-user-edit pr-2 pl-1"></i> <a href="<?php echo esc_url(home_url('/'))."author/".get_the_author_meta('user_nicename');?>"><?php the_author_meta('display_name'); ?></a>
					</div>	
				</header>
<?php if($post->post_excerpt!=""): ?>
				<section class="entry-summary">
					<div class="callout mycallout">
  						<div class="callout-title">Riassunto</div>
  						<?php the_excerpt(); ?>
					</div>
				</section>				
<?php endif;
				get_template_part( 'entry','content' ) ; ?>
			</article>	   
		   <?php if ( ! post_password_required() ) comments_template( '', true ); ?>
		   <?php endwhile; endif; ?>
	   </div>
      <div class="col-lg-3">
         <?php dynamic_sidebar( 'amm-trasparente-widget-area' ); ?>
      </div>
      
      </div>
   </div>
</section>
<?php get_footer(); ?>