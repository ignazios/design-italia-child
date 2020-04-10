<?php
/*
 * ### SEZIONE Ufficio Stampa ###
 * Mostra una sezione su due colonne con le comunicazioni dell'ufficio stampa.

 *
 */
?>
<section  id="Ufficio_Stampa">
	<div class="container shadow clearfix">
		<h2 class="u-text-h2 pt-3 pl-2">Ufficio stampa</h2>
	   	<div class="row">
	  	 	<div class="col-12 col-lg-6">
<?php
    $ArticoloEvidenza 	 = get_theme_mod('UfficioStampa_comunicato_evidenza');
    $CategoriaComunicati = get_theme_mod('UfficioStampa_ComunicatiStampa');
    $CategoriaFocus		 = get_theme_mod('UfficioStampa_Focus');
    $limit				 = get_theme_mod('UfficioStampa_Focus');
	$Param = array('cat' 			=> $CategoriaComunicati, 
				   'numberposts'	=> $limit);
	$ComunicatiStampa = get_posts($Param);
	$Param = array('cat' 			=> $CategoriaFocus, 
				   'numberposts'	=> $limit);
	$Focus = get_posts($Param);
	$Evidenza=get_post($ArticoloEvidenza);
	$PermaLinkEvidenza=get_permalink($Evidenza->ID);
	$ImgEvidenzaDati=get_the_post_thumbnail($Evidenza->ID);
	$TestoArticoloEvidenza=apply_filters( 'the_content', $Evidenza->post_content );
?>
			    <div class="it-single-slide-wrapper">
			      <a href="<?php echo $PermaLinkEvidenza;?>">
			        <div class="img-responsive-wrapper">
			          <div class="img-responsive">
			            <div class="img-wrapper">
			            	<?php echo get_the_post_thumbnail($Evidenza->ID);?>" title="
			            </div>
			          </div>
			        </div>
			      </a>
			      <div>
			        <div class="card-wrapper">
			          <div class="card">
			            <div class="card-body">
			              <h3 class="Titolo"><a href="<?php echo $PermaLinkEvidenza;?>"><?php echo $Evidenza->post_title;?></a></h3>
			            	<p class="text-muted"><i class="fas fa-calendar-alt"></i> <?php date($Evidenza->post_date,'j M y');?> <i class="fas fa-user-edit"></i> <?php get_the_author_meta( 'display_name' , $Evidenza->ID);?>
			            	</p>
		              		<?php echo $TestoArticoloEvidenza;?>
			              <a class="read-more" href="<?php echo $PermaLinkEvidenza;?>">
			                <i class="fas fa-link p-1"></i> <span class="text">Leggi la notizia </span>
			              </a>
			            </div>
			          </div>
			        </div>
			      </div>
				</div>	
			</div>	
	  		<div class="col-12 col-lg-6">
				<div id="UfficioStampa" class="collapse-div collapse-background-active" role="tablist">
				  <div class="collapse-header" id="headingA1">
				    <button data-toggle="collapse" data-target="#Comunicati" aria-expanded="false" aria-controls="Comunicati" class="ButtonUF">
				      Comunicati Stampa
				    </button>
				  </div>
				  <div id="Comunicati" class="collapse" role="tabpanel" aria-labelledby="headingA1" data-parent="#UfficioStampa">
				    <div class="collapse-body border border-primary rounded-bottom">
						<ul class="link-sublist" id="ComunicatiStampa">
<?php 
	if($ComunicatiStampa){
		foreach ( $ComunicatiStampa as $post ) :
        	setup_postdata( $post ); ?>
        					<li>
        						<i class="fas fa-calendar-alt"></i> <?php the_time('j M y');?> 
       							<a class="list-item" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
        					</li>
<?php	
		endforeach;
		wp_reset_postdata();
	}?>
						</ul>
				    </div>
				  </div>
				  <div class="collapse-header" id="headingA2">
				    <button data-toggle="collapse" data-target="#Focus" aria-expanded="false" aria-controls="Focus" class="ButtonUF">
				      Focus
				    </button>
				  </div>
				  <div id="Focus" class="collapse" role="tabpanel" aria-labelledby="headingA2" data-parent="#UfficioStampa">
				    <div class="collapse-body border border-primary rounded-bottom">
						<ul class="link-sublist" id="FocusComunicazioni">
<?php 
	if($Focus){
		foreach ( $Focus as $post ) :
        	setup_postdata( $post ); ?>
        					<li>
        						<i class="fas fa-calendar-alt"></i> <?php the_time('j M y');?> 
       							<a class="list-item" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
        					</li>
<?php	
		endforeach;
		wp_reset_postdata();
	}?>
						</ul>
				    </div>
				  </div>
				</div>
			</div>
		</div>
	</div>
</section>
