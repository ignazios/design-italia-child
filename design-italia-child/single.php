<?php get_header(); ?>
<section id="content" role="main" class="container-fluid">
   <div class="container-fluid">
      <div class="row">

      <div class="col-12 col-lg-9 pl-5 pr-5 pt-3">
		   <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<header>
					<h3 class="entry-title"><?php the_title(); ?></h3><?php edit_post_link(); ?>
					<div class="row metarticoli p-2">
								<i class="fas fa-calendar-alt pr-2"></i> <a href="<?php echo esc_url(home_url('/')).get_the_time('Y')."/".get_the_time('m');?>"><?php the_time('j M y'); ?></a>
								<i class="fas fa-user-edit pr-2 pl-1"></i> <a href="<?php echo esc_url(home_url('/'))."author/".get_the_author_meta('user_nicename');?>"><?php the_author_meta('display_name'); ?></a>
					</div>
					<div class="row metarticoli p-2">
<?php	    				$postcats = get_the_category();
							if ($postcats) :?>
								<i class="fas fa-hashtag pr-2" title="categorie"></i> <?php echo  get_the_category_list( " , ","",get_the_ID() ); ?>
<?php						endif;?>
					</div>
					<div class="row metarticoli p-2">
<?php				$posttags = get_the_tags ();
							if ($posttags) :?>
								<i class="fas fa-tags pr-2" title="tags"></i> <?php echo get_the_tag_list('<span class="listCatTag">',', ','</span>'); ?>
				<?php		endif;?>
					</div>	
				</header>
<?php if(get_the_excerpt()!=""): ?>
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
         <?php get_sidebar(); ?>
      </div>
      
      </div>
   </div>
</section>
<?php get_footer(); ?>