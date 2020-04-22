<?php
$Id
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
   <head>
      <meta charset="<?php bloginfo( 'charset' ); ?>" />
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <?php wp_head(); ?>
   </head>
   <body <?php body_class(); ?>>
<?php	if(get_theme_mod('scuola_cookies_attiva')){ ?>
		<div class="cookiebar">
		    <p><?php echo (get_theme_mod('scuola_cookies_testoMSG')!=""?get_theme_mod('scuola_cookies_testoMSG'):"Questo sito utilizza cookie tecnici, analytics e di terze parti. <br>Proseguendo nella navigazione accetti l’utilizzo dei cookie.");?></p>
		    <div class="cookiebar-buttons">
		        <a href="<?php echo get_permalink(get_theme_mod('scuola_cookies_pulsSXlink'));?>" class="cookiebar-btn"><?php echo get_theme_mod('scuola_cookies_pulsSXText');?></a>
		        <button data-accept="cookiebar" class="cookiebar-btn cookiebar-confirm"><?php echo get_theme_mod('scuola_cookies_accettaText');?><span class="sr-only"> i cookies</span></button>
		    </div>
		</div>
 <?php }?>
	<div class="skiplinks">
		<a class="sr-only sr-only-focusable" href="#main">Vai al contenuto principale</a>
	  	<a class="sr-only sr-only-focusable" href="#footer">Vai al footer</a>
	</div>
    <div id="wrapper" class="hfeed">
    	<header id="header" class="" role="banner">
         <div class="it-header-wrapper">
           <div class="it-header-slim-wrapper" id="header-superiore">
             <div class="container">
               <div class="row">
                 <div class="col">
                   <div class="it-header-slim-wrapper-content">
                     <a class="d-lg-block navbar-brand" href="<?php echo get_theme_mod('Scuola_AmmAfferente_URL');?>" alt="<?php echo "Sito ".get_theme_mod('Scuola_AmmAfferente_Nome');?>" title="<?php echo "Sito ".get_theme_mod('Scuola_AmmAfferente_Nome');?>" target="_blank"> 
                        <img class="header-slim-img" alt="" src="<?php echo wp_get_attachment_url(get_theme_mod('Scuola_AmmAfferente_Logo')); ?>">
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
							    $custom_logo_id = get_theme_mod( 'custom_logo' );
                              	$logo = wp_get_attachment_image_src( $custom_logo_id , 'full' );
							    if(FALSE!== $logo){
							    	$ImgLogo=esc_url( $logo[0] );
								} else {
									$ImgLogo=get_template_directory_uri() . '-child/img/logoStato.png';
						        } ?>
								<img class="icon" src="<?php echo $ImgLogo;?>" alt="<?php echo esc_html( get_bloginfo( 'name' ) );?>">
                           <div class="it-brand-text">
                             <h2 class="no_toc"><?php echo esc_html( get_bloginfo( 'name' ) ); ?></h2>
                             <h3 class="no_toc d-none d-md-block"><?php bloginfo( 'description' ); ?></h3>
                           </div>
                         </a>
                       </div>
                       <div class="it-right-zone d-none d-md-flex">
                         <div class="it-socials d-none d-md-flex ml-0">
                           <?php //wp_nav_menu( array( 'theme_location' => 'menu-social', 'container' => 'ul', 'menu_class' => 'nav')); 
                           		get_MenuSocial("menu-social","nav","menu-item")?>
                         </div>
                         <div class="it-search-wrapper ml-0">
			           <?php 
			                get_search_form(); ?>
                         </div>
                       </div>
                     </div>
                   </div>
                 </div>
               </div>
             </div>

             <div id="sub-header-menu" class="it-header-navbar-wrapper">
               <nav class="menu-main" role="navigation">
               <div class="container-fluid">
                 <div class="row">
                 	<div class="col-2">
	                 	<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_html( get_bloginfo( 'name' ) ); ?>" rel="home">
	                 		<img class="icon icona_piccola" src="<?php echo $ImgLogo;?>" alt="<?php echo esc_html( get_bloginfo( 'name' ) );?>">
	                 	</a>
                 	</div>
                    <div class="col-10">
                     <input type="checkbox" id="show-menu-main" role="button">
                     <label for="show-menu-main" class="show-menu-main">Menu</label>
 					   <?php
					   if ( has_nav_menu( 'menu-main' ) ) {
						   wp_nav_menu(array( 'theme_location' => 'menu-main', 'container' => 'ul', 'menu_class' => 'nav' ));
					   }
					   if ( has_nav_menu( 'mega-main' ) ) {
						   wp_nav_menu(array( 'theme_location' => 'mega-main', 'container' => 'ul', 'menu_class' => 'nav mega-menu' ));
					   } ?>      
					 	<div class="no_toc title_sticky"><?php echo esc_html( get_bloginfo( 'name' ) ); ?>
	                	</div>          
					</div>
                 </div>
               </div>
               </nav>
             </div>

           </div>
         </div>
         </header>
		<section id="main">
			<section id="breadcrumbs" role="main" class="container-fluid">
			   <div class="container-fluid">
			      <div class="row">
				      <div class="col-md-12">
		         		<?php if(function_exists('bcn_display') And !is_front_page()){
	        					bcn_display();
	    						}
	    				?>
					  </div>
				  </div>
				</div>
			</section>
        	<div id="container-fluid" class="null">
