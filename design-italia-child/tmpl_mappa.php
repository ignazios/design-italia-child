<?php
/** 
* Template Name: Mappa (Child)
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
?>
<section id="content" role="main">
   	<div class="container" id="Mappa">
		<div class="row">
			<div class="col-lg-4 col-md-12">
				<h2>Pagine</h2>
				<div class="it-list-wrapper">
  					<ul class="it-list">
  						<?php wp_list_pages (array("sort_column" 	=>"post_title",
  												   "title_li" 	 	=>"",
  												   "link_before"	=> "<div class=\"it-right-zone\"><span class=\"text\">",
  												   "link_after"		=> "</span></div>")); ?>
	                </ul>
	            </div>
			</div>
			<div class="col-lg-4 col-md-12">
				<h2>Categorie</h2>
				<div class="it-list-wrapper">
  					<ul class="it-list">
  						<?php 
  						echo my_wp_list_categories( array('hide_empty'         => 0,
    														 'echo'         => 1,
    														 'taxonomy'     => 'category',
    														 'title_li'		=>"",
    														 'hierarchical'  =>1,
  												   "link_before"	=> "<div class=\"it-right-zone\"><span class=\"text\">",
  												   "link_after"		=> "</span>",
  												   "link_close"		=> "</div>",
  												   "count_before"	=> "<span class=\"it-multiple\"><span class=\"metadata\">",
  												   "count_after"		=> "</span></span>",
     														 'show_count' 	=> 1));
 									?>
	                </ul>
	            </div>
			</div>	
			<div class="col-lg-4 col-md-12">
				<h2>Tag</h2>
				<div class="it-list-wrapper">
  					<ul class="it-list">
  						<?php wp_tag_cloud(array("show_count"	=>1,
  												 "smallest"		=>10,
  												 "largest"		=>18,
												 "link_before"	=> "<div class=\"it-right-zone\"><span class=\"text\">",
										   		 "link_after"	=> "</span></div>")); ?>
					</ul>
	            </div>
			</div>
		</div>
	</div>	
</section>
<?php	
get_footer();