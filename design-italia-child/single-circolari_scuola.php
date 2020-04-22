<?php 
	get_header(); 
?>
<section id="content" role="main" class="container-fluid">
   <div class="container-fluid">
      <div class="row">

      <div class="col-12 pl-5 pr-5 pt-3">
<?php 	if ( have_posts() ) : 
			while ( have_posts() ) : the_post();
		   		$ID_post=get_the_ID();
				$numero=get_post_meta($ID_post, "_numero",TRUE);
				$anno=get_post_meta($ID_post, "_anno",TRUE);
				$Elenco=GetEencoDestinatari($ID_post);
 ?>
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<header>
					<h3 class="entry-title"><?php the_title(); ?></h3><?php edit_post_link(); ?>
					<div class="metarticoli">
						<p>
							<i class="fas fa-calendar-alt pr-1"></i> <?php the_time('j M y'); ?> 
							<i class="fas fa-ticket-alt pl-2 pr-1"></i> <?php echo $numero."_".$anno;?>
							<i class="fas fa-user-edit pl-2 pr-1"></i> <a href="<?php echo esc_url(home_url('/'))."author/".get_the_author_meta('user_nicename');?>"><?php the_author_meta('display_name'); ?></a>
						</p>
						<p>
							<i class="fa fa-users pr-1" aria-hidden="true"></i> <?php echo $Elenco;?>
				            <?php	if (Is_Circolare_Da_Firmare($ID_post)){?>
				            	  <span class="card-firma pl-2 pr-1">
							<?php		if (!Is_Circolare_Firmata($ID_post)) {
											$ngiorni=Get_scadenzaCircolare($ID_post,"",True);					
											if(Is_Circolare_Scaduta($ID_post)){
												echo' <i class="fa fa-pencil" aria-hidden="true" style="color:red;"></i> Scaduta e non Firmata ';						
											}else{
												switch ($ngiorni){
													case -1:							
														$entro="";							
														break;													
													case 0:
														$entro="entro OGGI";
														break;
													case 1:
														$entro="entro DOMANI";
														break;
													default:
														$entro="entro $ngiorni giorni";
														break;
												}
												$sign=get_post_meta($ID_post, "_sign",TRUE);
												if ($sign!="Firma")
													$Tipo="Esprimere adesione $entro";
												else
													$Tipo="Firmare $entro";
												echo' <i class="fa fa-pencil" aria-hidden="true" style="color:red;"></i> '.$Tipo;	
										}			
									}else{
										echo' <i class="fa fa-pencil" aria-hidden="true" style="color:blue;"></i> Firmata';				
									}?>
								</span>
						<?php }?>
						</p>
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
       </div>
   </div>
</section>
<?php get_footer(); ?>