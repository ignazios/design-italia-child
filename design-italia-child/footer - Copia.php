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

<footer id="footer" role="contentinfo">
	<section>
		<div class="it-footer-small-prints clearfix" id="Ente">
			<div class="container">
		  		<div class="row">
		  			<div class="col-sm-12 col-md-4 col-lg-3 ">
            			<div class="it-brand-wrapper">
			              <a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_html( get_bloginfo( 'name' ) ); ?>" rel="home">
				               <?php 
			   					 $Logo=wp_get_attachment_url(get_theme_mod('Scuola_Logo_Scuola'));
									if (FALSE!== $Logo) {
										echo'<img class="icon" src="'. $Logo.'" alt="'. esc_html( get_bloginfo( 'name' ) ) .'">';
									} else {
								        echo '<img class="icon" src="'. get_template_directory_uri() . '-child/img/logoStato.png' .'" alt="'. esc_html( get_bloginfo( 'name' ) ) .'">';
				               }
				               
							   $Ente=get_parametriEnte(); ?>
			                <div class="it-brand-text">
			                  <h4><?php echo esc_html( get_bloginfo( 'name' ) ); ?></h4>
			                  <h5><?php bloginfo( 'description' ); ?></h5>
			                </div>
			              </a>
			            </div>
						  <div class="it-brand-text">
						  <ul>
						  	<li><?php echo stripslashes($Ente['indirizzo']); ?></li>
						  	<li>Tel: <?php echo stripslashes($Ente['telefono']); ?></li>
						  	<li>PEO: <?php echo stripslashes($Ente['PEO']); ?></li>
						  	<li>PEC: <?php echo stripslashes($Ente['PEC']); ?></li>
						  	<li>Codice <acronym title="Area Organizzativa Omogene">AOO</acronym>: <?php echo stripslashes($Ente['CAOO']); ?></li>	
						  	<li>Codice Fiscale: <?php echo stripslashes($Ente['CF']); ?></li>
						  	<li>Codice <acronym title="Indice delle Pubbliche Amministrazioni">Ipa</acronym>: <?php echo stripslashes($Ente['CIPA']); ?></li>
						  	<li>Codice univoco per la fatturazione elettronica: <?php echo stripslashes($Ente['CFA']); ?></li>
						  </ul>
						  </div>
			          </div>
				<div class="col-sm-12 col-md-4 col-lg-3 ">
					<div class="it-brand-wrapper nav">
					<?php
						if ( has_nav_menu( 'menu-footer-ente' ) ) {
							$locations = get_nav_menu_locations();
							$menu = get_term( $locations["menu-footer-ente"], 'nav_menu' );
						?>
						<h3><?php echo $menu->name; ?></h3><?php
						wp_nav_menu(array( 'theme_location' => 'menu-footer-ente', 'container' => 'ul', 'menu_class' => 'nav' ));
					} ?>
					</div>
				</div>
				<div class="col-sm-12 col-md-4 col-lg-3 ">
					<div class="it-brand-wrapper">
						<?php
						if ( has_nav_menu( 'menu-footer' ) ) {
							$locations = get_nav_menu_locations();
							$menu = get_term( $locations["menu-footer"], 'nav_menu' );
?>					<h3><?php echo $menu->name;?></h3><?php
						wp_nav_menu(array( 'theme_location' => 'menu-footer', 'container' => 'ul', 'menu_class' => 'nav' ));
						}?>
					</div>
				</div>
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
 
  <div class="it-footer-small-prints clearfix">
   <div class="container">
   	<div class="row">
			<div class="col-md text-right copyright">
				<small>
				<?php $cur_theme = wp_get_theme();?>
 Sito realizzato con <a href="htts://www.wordpress.org" target="_blank">Wordpress</a> tema <?php echo $cur_theme->Name; ?> realizzato da <a href="<?php echo $cur_theme->AuthorURI; ?>"><?php echo $cur_theme->Author; ?></a> basato sul tema <a href="<?php echo $cur_theme->ThemeURI; ?>" target="_blank">Design Italia</a> <?php echo sprintf( __( '%1$s %2$s %3$s', 'wppa' ), '&copy;', date( 'Y' ), esc_html( get_bloginfo( 'name' ) ) ); ?></small>
			</div>
   		
   	</div>
	</div>
  </div>
                      <?php if ( has_nav_menu( 'menu-language' ) ) { 
                        echo '<div class="header-slim-right-zone">';
                        echo '<label for="show-menu-lingua" class="show-menu-lingua">&#8942;</label><input type="checkbox" id="show-menu-lingua" role="button">';
                        wp_nav_menu(array( 'theme_location' => 'menu-language', 'container' => 'ul', 'menu_class' => 'nav float-right' ));
                        echo '</div>';
                     } ?>
</footer>

</div>
<?php wp_footer(); ?>
</body>
</html>