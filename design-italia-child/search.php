<?php get_header();

function sum_ArtAnno($ArchivioDate,$Anno){
	$TotPost=0;
	foreach($ArchivioDate[$Anno] as $Mese=>$CountArt)
		$TotPost=$TotPost+$CountArt;
	return $TotPost;
}
function my_get_archives()
{
	global $query_string;
	wp_parse_str( $query_string, $search_query );
//	echo "<pre>";var_dump($search_query);echo "<\pre>";
	unset($search_query["year"]);
	unset($search_query["monthnum"]);
	$TestoSearch=$search_query["s"];
	$search_query["nopaging"]=true;
	$search_query["orderby"]="date";
	$search = new WP_Query( $search_query );
	$Posts=$search->get_posts();
	$ArchivioDate=array();
	foreach($Posts as $Post){
		$Anno=date("Y",strtotime($Post->post_date));
		$Mese=(int) date("m",strtotime($Post->post_date));
		if(isset($ArchivioDate[$Anno][$Mese])){
			$ArchivioDate[$Anno][$Mese]=$ArchivioDate[$Anno][$Mese]+1;
		}else{
			$ArchivioDate[$Anno][$Mese]=1;
		}
			
	}
//	echo "<pre>";var_dump($ArchivioDate);echo "<\pre>";wp_die();
	wp_reset_query();
	wp_reset_postdata();
	$mesi = array(1=>'Gennaio', 'Febbraio', 'Marzo', 'Aprile', 'Maggio', 'Giugno', 'Luglio', 'Agosto', 'Settembre', 'Ottobre', 'Novembre','Dicembre');
	$Result="";

	$CAnno=0;
	foreach ($ArchivioDate as $Anno=>$Data ) {
//		echo $Anno."<br />";
		foreach($Data as $Mese=>$CountArt){
//			echo $Mese."<br />";
			if ($CAnno!=$Anno){
				if ($CAnno!=0) {
					$Result.='			</ul>
					</li>';
				}
				$Result.='
				<li>
						<div class="row">
							<div class="col-9 p-0 mb-0">
								<a class="list-item large" href="'.esc_url(home_url('/')).$Anno.'/?s='.$TestoSearch.'">
									<span class="m-0">'.$Anno.'</span>
								</a>						
							</div>
							<div class="col-1 m-0">
								<span class="badge badge-pill badge-primary text-white">'.sum_ArtAnno($ArchivioDate,$Anno).'</span>
							</div>
							<div class="col-2 p-0">
							<a class="list-item" href="'."#S".$Anno.'M'.$Mese.'" data-toggle="collapse" aria-expanded="false" aria-controls="S'.$Anno.'M'.$Mese.'">
							<i class="fas fa-angle-down fa-2x"></i>
								</a>
							</div>
						</div>

						<ul class="link-sublist collapse" id="S'.$Anno.'M'.$Mese.'">';
				$CAnno=$Anno;
			}
			$Result.='
					<li>
						<a class="list-item subele pl-0" href="'.esc_url(home_url('/')).$Anno."/".$Mese.'/?s='.$TestoSearch.'">
							<div class="row">
								<div class="col-10">	
									<span class="m-0">'.$mesi[$Mese].'</span>
								</div>
								<div class="col-2 m-0">
									<span class="badge badge-pill badge-primary text-white">'.$CountArt.'</span>
								</div>
							</div>
						</a>
					</li>';	
		}		  			
	}
	return $Result;
}

if ( have_posts() And (strlen( trim(get_search_query()))) >= 1){
	$SearchOk=TRUE;
}else{
	$SearchOk=FALSE;
}
?>
<section id="content" role="main" class="container-fluid">
   <div class="container-fluid affix-parent">
      <div class="row">
      	<div class="col d-flex justify-content-center pagesearch">
           <?php if ( !$SearchOk ) : ?>
           <header class="header mt-5">
                  <h3 class='entry-title'><?php printf( __(  'Inserisci un termine per la ricerca: ', 'wppa' ) ); ?></h3>
            <?php $IDForm="mysearchformPage";
                  $IDButton="mysearchsubmitPage";
                  get_search_form(); ?>
            </header>
            </div>
        </div>
           	<div class="row  mb-5">
 		  		<div class="col d-flex justify-content-center">
           				<div class="callout callout-highlight danger">
  							<div class="callout-title">
  								<i class="fas fa-info-circle"></i> Attenzione
  							</div>
  							<p>Non sono stati trovati contenuti con i parametri indicati</p>
						</div>
				</div>
			</div>
          <?php else : ?> 
            <header class="header mt-5">
                 <h3 class='entry-title'><?php _e( 'Inserisci un termine per la ricerca: ', 'wppa' ); ?></h3>
           <?php $IDForm="mysearchformPage";
                  $IDButton="mysearchsubmitPage";
                  get_search_form(); ?>
            </header>
          </div>
          <div class="row">
 		  <div class="col-12 col-lg-9">
		  	<div class="container">
                 <hr class="mt-5">
 		  <?php	while ( have_posts() )
			  : the_post(); ?>
		  		<?php get_template_part( 'template-parts/section', 'art_list-item' ); ?>
		  		<?php endwhile; ?>
		  	</div>
		  <?php get_template_part( 'nav', 'below' ); ?>

		  </div>
		  <div class="col-12 col-lg-3">
			  <div class="link-list-wrapper p-1 affix-top">
					<div class="link-list-wrapper shadow p-1 mt-5">
						<h4 class="TitoloArchivio">Data di Pubblicazione</h4>
						<ul class="link-list" id="ListaCategorieData">				
							<?php echo my_get_archives(); ?>
						</ul>
					</div>
				</div>
		  </div>
		  <?php endif; ?>     
	</div>
	</div>
</section>

<?php get_footer(); ?>