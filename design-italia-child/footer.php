<div class="mx-auto text-center pb-3" style="width: 200px;">
  <a href="#" aria-hidden="true" data-attribute="back-to-top">
    <i class="fas fa-arrow-circle-up fa-3x"></i>
  </a>
</div>
<div class="clear"></div>
</div>

<script>
window.onscroll = function() {myFunction()};

var header = document.getElementById("myHeader");
var container = document.getElementById("container-fluid");
var sticky = header.offsetTop;

function myFunction() {
  if (window.pageYOffset > sticky) {
    header.classList.add("sticky");
    container.classList.add("stickycontainer");
  } else {
    header.classList.remove("sticky");
    container.classList.remove("stickycontainer");
  }
}
</script>
<footer class="it-footer" id="footer">
  <div class="it-footer-main">
    <div class="container">
      <section>
        <div class="row clearfix">
          <div class="col-sm-12">
            <div class="it-brand-wrapper">
              <a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_html( get_bloginfo( 'name' ) ); ?>" rel="home">
		               <?php 
	   					 $Logo=wp_get_attachment_url(get_theme_mod('Scuola_Logo_Scuola'));
							if (FALSE!== $Logo) {
								echo'<img class="icon" src="'. $Logo.'" alt="'. esc_html( get_bloginfo( 'name' ) ) .'">';
							} else {
						        echo '<img class="icon" src="'. get_template_directory_uri() . '-child/img/logoStato.png' .'" alt="'. esc_html( get_bloginfo( 'name' ) ) .'">';
		               }?>
	                <div class="it-brand-text">
	                  <h4><?php echo esc_html( get_bloginfo( 'name' ) ); ?></h4>
	                  <h5><?php bloginfo( 'description' ); ?></h5>
	                </div>
	              </a>
            </div>
          </div>
        </div>
         <div class="row">
          <div class="col-lg-3 col-md-6 col-sm-6 pb-2">
            <h4><i class="fas fa-info-circle"></i> Informazioni</h4>
            <div class="link-list-wrapper">
			  <ul class="footer-list link-list clearfix">
                <li><?php echo get_theme_mod('Scuola_Amministrazione_Indirizzo'); ?></li>
                <li><?php echo get_theme_mod('Scuola_Amministrazione_CAP'); ?>, <?php echo get_theme_mod('Scuola_Amministrazione_Citta'); ?></li>
                <li>C.M. <?php echo get_theme_mod('Scuola_Amministrazione_CM'); ?></li>
                <li>C.F. <?php echo get_theme_mod('Scuola_Amministrazione_CFPA'); ?></li>
                <?php echo (get_theme_mod('Scuola_Amministrazione_PIVA')!=""?"<li>P.Iva ".get_theme_mod('Scuola_Amministrazione_PIVA')."</li>":""); ?></li>
                Cod. Univoco <?php echo get_theme_mod('Scuola_Amministrazione_CodUni');	
				if(get_theme_mod('scuola_mappa_attiva')){?>
				<li> 
				<?php if(get_theme_mod('scuola_mappa_frame')){
					echo get_theme_mod('scuola_mappa_frame');
					  }else{?> 
				<i class="fas fa-map-marked-alt"></i> <a href="<?php echo get_theme_mod('scuola_mappa_link'); ?>" target="_blank" title="Mappa con la geolocalizzazione dell'Istituto" class="d-inline"><?php echo get_theme_mod('scuola_mappa_titolo'); ?></a>
				<?php }?>
				</li>
		  <?php }?>
			  </ul>
            </div>
          </div>
          <div class="col-lg-3 col-md-6 col-sm-6 pb-2">
            <h4><i class="fas fa-address-book"></i> Recapiti</h4>
            <div class="link-list-wrapper">
              <ul class="footer-list link-list clearfix">
          <?php if (get_theme_mod('Scuola_Amministrazione_DesTelefono')!=""){
	          		echo "<li>".get_theme_mod('Scuola_Amministrazione_DesTelefono');
	          		if (get_theme_mod('Scuola_Amministrazione_Telefono')!=""){
	          			echo "<br />".get_theme_mod('Scuola_Amministrazione_Telefono');
          			}
          			echo "</li>";
				}	
         		if (get_theme_mod('Scuola_Amministrazione_DesTelefono2')!=""){
          			echo "<li>".get_theme_mod('Scuola_Amministrazione_DesTelefono2');
          			if (get_theme_mod('Scuola_Amministrazione_Telefono2')!=""){
          				echo "<br />".get_theme_mod('Scuola_Amministrazione_Telefono2');
          			}
          			echo "</li>";
				}
        		if (get_theme_mod('Scuola_Amministrazione_DesTelefono3')!=""){
          			echo "<li>".get_theme_mod('Scuola_Amministrazione_DesTelefono3');
          			if (get_theme_mod('Scuola_Amministrazione_Telefono3')!=""){
          				echo "<br />".get_theme_mod('Scuola_Amministrazione_Telefono3');
          			}
          			echo "</li>";
				}
        		if (get_theme_mod('Scuola_Amministrazione_DesTelefono4')!=""){
          			echo "<li>".get_theme_mod('Scuola_Amministrazione_DesTelefono4');
          			if (get_theme_mod('Scuola_Amministrazione_Telefono4')!=""){
          				echo "<br />".get_theme_mod('Scuola_Amministrazione_Telefono4');
          			}
          			echo "</li>";
         		}?>
            	</ul>
            </div>
          </div>
          <div class="col-lg-3 col-md-6 col-sm-6 pb-2">
            <h4><i class="fas fa-at"></i> Mail</h4>
            <div class="link-list-wrapper">
              <ul class="footer-list link-list clearfix">
       <?php	if (get_theme_mod('Scuola_Amministrazione_Email')!=""){
          			echo "<li><a href=\"".get_theme_mod('Scuola_Amministrazione_Email')."\">".get_theme_mod('Scuola_Amministrazione_Email')."</a>
          				  </li>";
         		}
 				if (get_theme_mod('Scuola_Amministrazione_Email2')!=""){
          			echo "<li><a href=\"".get_theme_mod('Scuola_Amministrazione_Email2')."\">".get_theme_mod('Scuola_Amministrazione_Email2')."</a>
          				  </li>";            
         		}
 				if (get_theme_mod('Scuola_Amministrazione_PEC')!=""){
          			echo "<li><a href=\"".get_theme_mod('Scuola_Amministrazione_PEC')."\">".get_theme_mod('Scuola_Amministrazione_PEC')."</a>
          				  </li>";          
         		}?>
          	 </ul>
            </div>
          </div>
          <div class="col-lg-3 col-md-6 col-sm-6">
		<?php
			if ( has_nav_menu( 'menu-footer-ente' ) ) {
				$locations = get_nav_menu_locations();
				$menu = get_term( $locations["menu-footer-ente"], 'nav_menu' );
			?>
			<h4><?php echo htmlspecialchars_decode($menu->name); ?></h4><?php
			wp_nav_menu(array( 'theme_location' => 'menu-footer-ente', 'container' => 'ul', 'menu_class' => 'footer-list link-list clearfix' ));
		} ?>          
          </div>
        </div>
      </section>
      <section class="py-4 border-white border-top">
        <div class="row">
          <div class="col-lg-4 col-md-4 pb-2">
  		<?php
			if ( has_nav_menu( 'menu-footer' ) ) {
				$locations = get_nav_menu_locations();
				$menu = get_term( $locations["menu-footer"], 'nav_menu' );
			?>
			<h4><?php echo htmlspecialchars_decode($menu->name); ?></h4><?php
			wp_nav_menu(array( 'theme_location' => 'menu-footer', 'container' => 'ul', 'menu_class' => 'footer-list link-list clearfix' ));
		} ?>   
          </div>
          <div class="col-lg-4 col-md-4 pb-2">
  		<?php
			if ( has_nav_menu( 'menu-footer-secondo' ) ) {
				$locations = get_nav_menu_locations();
				$menu = get_term( $locations["menu-footer-secondo"], 'nav_menu' );
			?>
			<h4><?php echo htmlspecialchars_decode($menu->name); ?></h4><?php
			wp_nav_menu(array( 'theme_location' => 'menu-footer-secondo', 'container' => 'ul', 'menu_class' => 'footer-list link-list clearfix' ));
		} ?>   
          </div>
          <div class="col-lg-4 col-md-4 pb-2">
            <div class="pb-2">
 		<?php
			if ( has_nav_menu( 'menu-social' ) ) {?>
              <h4><i class="fas fa-hashtag"></i> Seguici su</h4>
              <?php wp_nav_menu( array( 'theme_location' => 'menu-social', 'container' => 'ul', 'menu_class' => 'nav list-inline text-left social')); ?>
        <?php }?>
            </div>
           </div>
        </div>
      </section>
 
 		<?php if ( is_active_sidebar( 'footer-widget-area' ) ) : ?>
      <section>
        <div class="row">
				<div class="container-fluid widget-area">
				   <div class="row xoxo">
				      <?php dynamic_sidebar( 'footer-widget-area' ); ?>
				   </div>
				</div>
        </div>
      </section>
		<?php endif; ?>
		<?php if ( is_active_sidebar( 'footer-sub-widget-area' ) ) : ?>
      <section class="py-4 border-white border-top">
        <div class="row">
				<div class="container-fluid widget-area">
				   <div class="row xoxo">
				      <?php dynamic_sidebar( 'footer-sub-widget-area' ); ?>
				   </div>
				</div>
        </div>
      </section>
		<?php endif; ?>
 
    </div>
  </div>
  <div class="it-footer-small-prints clearfix">
    <div class="container">
		<div class="row">
			<div class="col-md">
		      <h3 class="sr-only">Sezione Legale</h3>
		      <?php wp_nav_menu( array( 'theme_location' => 'menu-footer-legale', 'container' => 'ul', 'menu_class' => 'nav it-footer-small-prints-list list-inline mb-0 d-flex flex-column flex-md-row', 'menu_id' =>"menu_legal")); ?>
		    </div>
			<div class="col-md text-right copyright">
				<small><?php echo sprintf( __( '%1$s %2$s %3$s', 'wppa' ), '<i class="far fa-copyright"></i>', date( 'Y' ), esc_html( get_bloginfo( 'name' ) ) ); ?></small>
			</div>
 		</div>	
    </div>
   	</div>
</footer>
<?php wp_footer(); ?>
</body>
</html>