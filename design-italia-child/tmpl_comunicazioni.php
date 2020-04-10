<?php 
/** 
* Template Name: Pagina Comunicazione
*
* This is the template that displays the home page.
* Please note that this is the WordPress construct of pages
* and that other 'pages' on your WordPress site may use a
* different template.
*
* @link https://codex.wordpress.org/Template_Hierarchy
*
* @package design-italia-child
*/
get_header();
//var_dump($_SERVER);
$mesi = array(1=>'Gennaio', 'Febbraio', 'Marzo', 'Aprile', 'Maggio', 'Giugno', 'Luglio', 'Agosto', 'Settembre', 'Ottobre', 'Novembre','Dicembre');

function my_get_archivesAnnoMese()
{
	global $wpdb, $wp_locale,$mesi;
	$Result="";
	$Sql = "SELECT YEAR(post_date) AS `Anno`, MONTH(post_date) AS `Mese`, count(DISTINCT ID) as NumArt
				FROM $wpdb->posts
				WHERE $wpdb->posts.post_status = 'publish'
				AND $wpdb->posts.post_type = 'post'
				GROUP BY YEAR(post_date), MONTH(post_date)
				ORDER BY post_date DESC";
	//		echo "<br />".$Sql;exit;
	$ArchivioDate = $wpdb->get_results($Sql);
	$Anno=0;
	$ArticoliAnni=calc_NumArticoliMA($ArchivioDate);
	foreach ($ArchivioDate as $Data) {
		$Link=esc_url(home_url('/')).$Data->Anno."/".$Data->Mese."/?cat=".get_query_var('cat');
		$Des=$mesi[$Data->Mese]." ".$Data->Anno." (".$Data->NumArt.")";
		if ($Anno!=$Data->Anno){
			if ($Anno!=0) {
				$Result.='			</ul>
				</li>';
			}
			$Result.='
			<li>
					<div class="row">
						<div class="col-9 p-0 mb-0">
							<a class="list-item large" href="'.esc_url(home_url('/')).$Data->Anno.'">
								<span class="m-0">'.$Data->Anno.'</span>
							</a>						
						</div>
						<div class="col-1 m-0">
							<span class="badge badge-pill badge-primary text-white">'.$ArticoliAnni[$Data->Anno].'</span>
						</div>
						<div class="col-2 p-0">
						<a class="list-item" href="#M'.$Data->Anno.$Data->Mese.'" data-toggle="collapse" aria-expanded="false" aria-controls="'.'M'.$Data->Anno.$Data->Mese.'">
						<i class="fas fa-angle-down fa-2x"></i>
							</a>
						</div>
					</div>

					<ul class="link-sublist collapse" id="M'.$Data->Anno.$Data->Mese.'">';
			$Anno=$Data->Anno	;
		}
		$Result.='
					<li>
						<a class="list-item subele pl-0" href="'.esc_url(home_url('/')).$Data->Anno."/".$Data->Mese.'">
							<div class="row">
								<div class="col-10">	
									<span class="m-0">'.$mesi[$Data->Mese].'</span>
								</div>
								<div class="col-2 m-0">
									<span class="badge badge-pill badge-primary text-white">'.$Data->NumArt.'</span>
								</div>
							</div>
						</a>
					</li>';			  			
	}
	return $Result;
}

function count_PostCategory($IDCategory){
	$category = get_category($IDCategory);
	return $category->category_count;
}
$CatePadre=wp_get_nav_menu_items("Comunicazioni");
/**
*  Categorie da escludere nelle comunicazioni da visualizzare.
* Parametro impostato nei parametri della Home Page
*/
$NoCategorie=get_theme_mod('ultime-comunicazioni_CatEscludere');
$CA=array();
$Escudere=false;
if($NoCategorie!=""){
	$InfoCatDaEscludere=explode(";",$NoCategorie);
	foreach($InfoCatDaEscludere as $InfoRiga){
		$Riga=explode(",",$InfoRiga);
		$CA[]=$Riga[0];
		if ($Riga[1])
			$CA=array_merge($CA,get_term_children(intval($Riga[0]),'category'));
	}
}
if (count($CA)>0){
	$Escudere=true;	
}
$PostMC=True;
$search_query=array("year"				=>date("Y"),
					"monthnum"			=>date("m"),
					"orderby"			=> "date",
					'category__not_in' 	=> $CA);
$Posts = new WP_Query( $search_query );
//echo "<pre>";var_dump($Posts);echo "<\pre>";
if($Posts->posts['post_count']==0){
	$search_query=array("posts_per_page"	=>10,
						"orderby"			=> "date",
						"category__not_in" 	=> $CA);
	$Posts = new WP_Query( $search_query );
	$PostMC=False;
}
?>
<section id="content" role="main" class="container-fluid">
   <div class="container-fluid">
      <div class="row">
		  <div class="col-12 col-lg-9">

		  	<header class="header">
		  		<?php //if ( '' != category_description() ) echo apply_filters( 'archive_meta', '<div class="archive-meta">' . category_description() . '</div>' ); ?>
		  		<h3 class="entry-title">Comunicazioni</h3>
		  	</header>
<?php	 	if(!$PostMC) :?>
		 		<div class="alert alert-warning" role="alert">
  			 		Nel mese corrente <strong>non ci sono ancora Comunicazioni</strong>. Verranno visualizzate le ultime 10 comunicazioni
				</div>
<?php	 	endif; ?>
		  	<div class="container">
<?php	  if ( $Posts->have_posts() )  :
		  	while ( $Posts->have_posts() )
			  : $Posts->the_post(); ?>
		  		<?php get_template_part( 'template-parts/section', 'art_list-item' ); 
			endwhile; 
	      endif;?>
		  	</div>
		  	<?php get_template_part( 'nav', 'below' ); ?>

		  </div>
		  <div class="col-12 col-lg-3">
		  <div class="link-list-wrapper shadow p-1">
			  <h4 class="TitoloArchivio">Argomenti</h4>
			  <ul class="link-list" id="ListaCategorie">
<?php foreach($CatePadre as $Categoria) :?>
		  		<li>
<?php	$CatFiglie=get_categories(array( 'parent' => $Categoria->object_id,'hide_empty'	=> False  ));
					  if (count($CatFiglie)==0):
?> 
						  <div class="row">
							  	<div class="col-9 p-0 mb-2">
								  <a class="list-item medium pl-2" href="<?php echo $Categoria->url; ?>">
 									<span class="m-0"><?php echo $Categoria->title; ?></span> 
 								  </a>
							  	</div>
							  <div class="col-1 m-0">
								  <span class="badge badge-pill badge-primary text-white m-0"><?php echo count_PostCategory($Categoria->object_id); ?></span>
							  </div>
							  	<div class="col-2 p-0">
							  	</div>
						 </div>
<?php 				  else : ?>	
						<div class="row">
							<div class="col-9 p-0 mb-0">
							  <a class="list-item medium pl-2" href="<?php echo $Categoria->url; ?>" style="line-height: 1.5em;">				  
								<span class="m-0"><?php echo $Categoria->title; ?></span>
							 </a>
							</div>
							<div class="col-1 m-0">
								<span class="badge badge-pill badge-primary text-white"><?php echo count_PostCategory($Categoria->object_id); ?></span>
							</div>
							<div class="col-2 p-0">
								<a class="list-item" href="#<?php echo $Categoria->object_id; ?>" data-toggle="collapse" aria-expanded="false" aria-controls="<?php echo $Categoria->object_id; ?>">							
								<i class="fas fa-angle-down fa-2x"></i>
								</a>
							</div>
  					  	</div>
			  			<ul class="link-sublist collapse" id="<?php echo $Categoria->object_id; ?>">
<?php	  foreach ($CatFiglie as $CategoriaFiglia) : ?>
							  <li>
		  						<a class="list-item subele pl-0" href="<?php echo get_term_link($CategoriaFiglia->term_id); ?>">
								  <div class="row">
								  	<div class="col-10">
								  		<span class="m-0"><?php echo $CategoriaFiglia->name; ?></span>
								  	</div>
									<div class="col-2 m-0">
										<span class="badge badge-pill badge-primary text-white"><?php echo count_PostCategory($CategoriaFiglia->term_id); ?></span>
									</div>
								  </div>
								</a>
		  					</li>
<?php 	  endforeach; ?>
		  			</ul>
<?php 	  			endif; ?>		  		
				</li>
<?php endforeach;?>
		  	</ul>
		   </div>		  
			<div class="link-list-wrapper shadow p-1 mt-3">
				<h4 class="TitoloArchivio">Data di Pubblicazione</h4>
				<ul class="link-list" id="ListaCategorieData">				
					<?php echo my_get_archivesAnnoMese(); ?>
				</ul>
			</div>
		  </div>     

	</div>
</section>

<?php get_footer(); ?>