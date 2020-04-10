<?php get_header();
//var_dump($_SERVER);

function my_get_tags_archives()
{
	global $wpdb, $wp_locale;
	$mesi = array(1=>'Gennaio', 'Febbraio', 'Marzo', 'Aprile', 'Maggio', 'Giugno', 'Luglio', 'Agosto', 'Settembre', 'Ottobre', 'Novembre','Dicembre');
	$Result="";
	
	$tagID = get_term_by('slug', get_query_var('tag'), 'post_tag');
//	echo get_query_var('tag');var_dump($tagID);
	if (!isset($tagID)) {
		return "";
	}
	$Sql = "SELECT YEAR(post_date) AS `Anno`, MONTH(post_date) AS `Mese`, count(DISTINCT ID) as NumArt
FROM $wpdb->posts, $wpdb->term_taxonomy, $wpdb->term_relationships
WHERE $wpdb->posts.post_status = 'publish'
AND $wpdb->posts.post_type = 'post'
AND $wpdb->term_taxonomy.term_id =".$tagID->term_id."
AND $wpdb->posts.ID = $wpdb->term_relationships.object_id
AND $wpdb->term_taxonomy.term_taxonomy_id = $wpdb->term_relationships.term_taxonomy_id
GROUP BY YEAR(post_date), MONTH(post_date)
ORDER BY post_date DESC";
	//		echo "<br />".$Sql;exit;
	$ArchivioDate = $wpdb->get_results($Sql);
	$Anno=0;
	$ArticoliAnni=calc_NumArticoliMA($ArchivioDate);
	foreach ($ArchivioDate as $Data) {
		$Des=$mesi[$Data->Mese]." ".$Data->Anno." (".$Data->NumArt.")";
		if ($Anno!=$Data->Anno){
			if ($Anno!=0) {
				$Result.='			</ul>
				</li>';
			}
			$Result.='
			<li>
				<div class="row">
					<div class="col-1">
						<a class="list-item" href="'."#Tag".get_query_var('tag').'M'.$Data->Mese.'" data-toggle="collapse" aria-expanded="false" aria-controls="Tag'.get_query_var('tag').'M'.$Data->Mese.'">
							<i class="fas fa-angle-down espandi align-middle"></i>
						</a>					
					</div>
					<div class="col-9 mb-0">
						<a class="list-item large" href="'.esc_url(home_url('/')).$Data->Anno."/?tag=".get_query_var('tag').'">
							<span class="m-0">'.$Data->Anno.'</span>
						</a>						
					</div>
					<div class="col-2 m-0 p-0">
						<span class="badge badge-pill badge-primary text-white">'.$ArticoliAnni[$Data->Anno].'</span>
					</div>
		  		</div>			
				<ul class="link-sublist collapse" id="Tag'.get_query_var('tag').'M'.$Data->Mese.'">';
			$Anno=$Data->Anno;
		}
		$Result.='
					<li>
						<a class="list-item subele pl-0" href="'.esc_url(home_url('/')).$Data->Anno."/".$Data->Mese."/?tag=".get_query_var('tag').'">
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
function count_PostTag($IDTag){
	$tag = get_tag($IDTag);
	return $tag->count;
}
$Args=array('hide_empty'=> 0,
   			'echo'         => 1,
    		'title_li'		=>"");
$Tags=get_tags($Args);

?>
<section id="content" role="main" class="container-fluid">
   <div class="container-fluid">
      <div class="row">
		  <div class="col-12 col-lg-9">

		  	<header class="header">
		  		<h3 class="entry-title">Articoli con Tag: <?php single_cat_title(); ?></h3>
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
			  <div id="archcat" class="container">
				  <div class="link-list-wrapper shadow p-1">
				  	<div class="row">
						<div class="col-1">
							<a class="list-item" href="#ListaTag" data-toggle="collapse" aria-expanded="false" aria-controls="ListaTag">
								<i class="fas fa-angle-down espandi align-middle"></i>
							</a>
						</div>
						<div class="col-11 mb-0">
							<h4 class="TitoloArchivio">Etichette</h4>
						</div>
					</div> 
					<ul class="link-list collapse" id="ListaTag">
		<?php foreach($Tags as $Tag) :?>
				  		<li>
							<div class="row">
								<div class="col-10 p-0 mb-0">
								  <a class="list-item medium pl-2" href="<?php echo get_tag_link($Tag->term_id); ?>" style="line-height: 1.5em;">
									<span class="m-0"><?php echo $Tag->name; ?></span>
								 </a>
								</div>
	 							<div class="col-2 m-0 p-0">
									<span class="badge badge-pill badge-primary text-white"><?php echo count_PostTag($Tag->term_id); ?></span>
								</div>
	 					  	</div>						
 					  	</li>
		<?php endforeach;?>
				  	</ul>
			   	</div>		  
				<div class="link-list-wrapper shadow p-1 mt-3">
				  	<div class="row">
						<div class="col-1 align-middle">
							<a class="list-item" href="#ListaTagData" data-toggle="collapse" aria-expanded="false" aria-controls="ListaTagData">
								<i class="fas fa-angle-down espandi align-middle"></i>
							</a>
						</div>
						<div class="col-11 mb-0">
							<h4 class="TitoloArchivio">Data di Pubblicazione</h4>
						</div>
					 </div> 
					<ul class="link-list collapse" id="ListaTagData">				
						<?php echo my_get_tags_archives(); ?>
					</ul>
				</div>
			</div>
		  </div>     
		</div>
	</div>
</section>

<?php get_footer(); ?>