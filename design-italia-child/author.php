<?php get_header(); 

$mesi = array(1=>'Gennaio', 'Febbraio', 'Marzo', 'Aprile', 'Maggio', 'Giugno', 'Luglio', 'Agosto', 'Settembre', 'Ottobre', 'Novembre','Dicembre');

function sum_ArtAnno($ArchivioDate,$Anno){
	$TotPost=0;
	foreach($ArchivioDate[$Anno] as $Mese=>$CountArt)
		$TotPost=$TotPost+$CountArt;
	return $TotPost;
}
function my_get_archives()
{
	global $query_string,$mesi;
	wp_parse_str( $query_string, $search_query );
//	echo "<pre>";var_dump($search_query);echo "<\pre>";
	unset($search_query["year"]);
	unset($search_query["monthnum"]);
	$search_query["nopaging"]=true;
	$search_query["orderby"]="date";
	$Autore=$search_query["author_name"];
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
								<a class="list-item large" href="'.esc_url(home_url('/')).$Anno.'/?author='.$Autore.'">
									<span class="m-0">'.$Anno.'</span>
								</a>						
							</div>
							<div class="col-1 m-0">
								<span class="badge badge-pill badge-primary text-white">'.sum_ArtAnno($ArchivioDate,$Anno).'</span>
							</div>
							<div class="col-2 p-0">
							<a class="list-item" href="'."#A".$Anno.'M'.$Mese.'" data-toggle="collapse" aria-expanded="false" aria-controls="A'.$Anno.'M'.$Mese.'">
							<i class="fas fa-angle-down fa-2x"></i>
								</a>
							</div>
						</div>

						<ul class="link-sublist collapse" id="A'.$Anno.'M'.$Mese.'">';
				$CAnno=$Anno;
			}
			$Result.='
					<li>
						<a class="list-item subele pl-0" href="'.esc_url(home_url('/')).$Anno."/".$Mese.'/?author='.$Autore.'">
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
?>
<section id="content" role="main" class="container-fluid">
   <div class="container-fluid">
      <div class="row">
		  <div class="col-12 col-lg-9">

		  	<header class="header">
		  		<h3 class="entry-title"><?php echo "Articoli di: ".get_the_author_meta("display_name"); ?></h3>
		  	</header>
		  	<div class="container">
		  		<?php
		  if ( have_posts() )
			  :
		  while ( have_posts() )
			  : the_post(); ?>
		  		<?php get_template_part( 'template-parts/section', 'art_list-item' ); ?>
		  		<?php endwhile; endif; ?>
		  	</div>
		  	<?php get_template_part( 'nav', 'below' ); ?>

		  </div>
		  <div class="col-12 col-lg-3">

		  </div>     
	</div>
	</div>
</section>

<?php get_footer(); ?>