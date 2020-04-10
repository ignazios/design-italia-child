<!DOCTYPE html>
<html <?php language_attributes(); ?>>
   <head>
      <meta charset="<?php bloginfo( 'charset' ); ?>" />
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <?php wp_head(); ?>
   </head>
   <body <?php body_class(); ?>>
      <div id="wrapper" class="hfeed">
         <header id="header" class="" role="banner">

         <div class="it-header-wrapper">
           <div class="it-header-slim-wrapper" id="header-superiore">
             <div class="container">
               <div class="row">
                 <div class="col">
                   <div class="it-header-slim-wrapper-content">
                     <a class="d-lg-block navbar-brand" href="https://www.miur.gov.it/web/guest/" target="_blank"> 
                        <img class="header-slim-img" alt="" src="<?php header_image(); ?>">
                     </a>
                	</div>
                </div>
                <div class="col">
                	<div class="it-header-slim-wrapper-content float-right">
					<?php
					 
						if(is_user_logged_in()){
							echo '<i class="fas fa-sign-out-alt pr-2"></i> ';
						}else{
							echo '<i class="fas fa-sign-in-alt pr-2"></i> ';
						}
						echo wp_loginout($_SERVER['REQUEST_URI'],FALSE );?>
					</div>
                 </div>
               </div>
             </div>
           </div>
           <div class="it-nav-wrapper" id="myHeader">
             <div class="it-header-center-wrapper">
               <div class="container">
                 <div class="row">
                   <div class="col-12">
                     <div class="it-header-center-content-wrapper">
                       <div class="it-brand-wrapper">
                         <a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_html( get_bloginfo( 'name' ) ); ?>" rel="home">
                           <?php 
    $LogoEnte=wp_get_attachment_url(get_theme_mod('Scuola_Logo_Scuola'));
    if(FALSE!== $LogoEnte){
    	echo'<img class="icon" src="'. $LogoEnte.'" alt="'. esc_html( get_bloginfo( 'name' ) ) .'">';
	} else {
        echo '<img class="icon" src="'. get_template_directory_uri() . '-child/img/logoStato.png' .'" alt="'. esc_html( get_bloginfo( 'name' ) ) .'">';
	               } 
                           ?>
                           <div class="it-brand-text">
                             <h2 class="no_toc"><?php echo esc_html( get_bloginfo( 'name' ) ); ?></h2>
                             <h3 class="no_toc d-none d-md-block"><?php bloginfo( 'description' ); ?></h3>
                           </div>
                         </a>
                       </div>
                       <div class="it-right-zone">
                         <div class="it-socials d-none d-md-flex">
                           <?php wp_nav_menu( array( 'theme_location' => 'menu-social', 'container' => 'ul', 'menu_class' => 'nav')); ?>
                         </div>
                         <div class="it-search-wrappernn">
                         <i class="fab fa-searchengin"></i>
                           <?php get_search_form(); ?>
                         </div>
                       </div>
                     </div>
                   </div>
                 </div>
               </div>
             </div>

             <div class="it-header-navbar-wrapper">
               <nav class="menu-main" role="navigation">
               <div class="container-fluid">
                 <div class="row">
                 	<div class="col-2">
                 		<img class="icon icona_piccola" src="<?php echo $LogoEnte;?>" alt="<?php echo esc_html( get_bloginfo( 'name' ) );?>">
                 	</div>
                    <div class="col-9">
                     <input type="checkbox" id="show-menu-main" role="button">
                     <label for="show-menu-main" class="show-menu-main">Menu</label>
					   <?php
					   if ( has_nav_menu( 'menu-main' ) ) {
						   wp_nav_menu(array( 'theme_location' => 'menu-main', 'container' => 'ul', 'menu_class' => 'nav' ));
					   }
					   if ( has_nav_menu( 'mega-main' ) ) {
						   wp_nav_menu(array( 'theme_location' => 'mega-main', 'container' => 'ul', 'menu_class' => 'nav mega-menu' ));
					   } ?>                   
					</div>
					<div class="col-1">
                 		<div class="it-search-wrappernn">
                           <form role="search" method="get" id="searchform-sticky" class="searchform searchform-sticky" action="<?php echo home_url( '/' );?>">
                           	<div>
                           		<input type="hidden" value="" name="s" id="s">
							    <input type="submit" id="searchsubmit" value="Cerca">
							</div>
						   </form>
						</div>
                 	</div>
                 </div>
               </div>
               </nav>
             </div>

           </div>
         </div>
         </header>
		<section id="breadcrumbs" role="main" class="container-fluid">
		   <div class="container-fluid">
		      <div class="row">
			      <div class="col-md-12">
	         		<?php if(function_exists('bcn_display')){
        					bcn_display();
    						}
    				?>
				  </div>
			  </div>
			</div>
		</section>
         <div id="container-fluid" class="null">