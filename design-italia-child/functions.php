<?php
/**
 * design-italia-child  funzioni tema figlio 
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package design-italia-child
 */
  /* UPDATER THEME VERSION */

require 'inc/theme-update-checker.php';
$update_checker = new ThemeUpdateChecker(
    'design-italia-child',
    'https://raw.githubusercontent.com/ignazios/design-italia-child/master/design-italia-child.json');

 if ( function_exists( 'add_theme_support' ) ) { 
    add_image_size( 'img-wrapper-thumb', 660, 300, true);
 }

register_nav_menus(array(
	'menu-footer-ente'  => __( 'Footer Menu Ente', 'wppa' ),
	'menu-footer-legale'  => __( 'Footer Menu Legale', 'wppa' ),
	'menu-footer-secondo'  => __( 'Footer Menu secondo', 'wppa' ),
));
/**
* Inserisce nell'Head della pagina le librerie degli Script ed i fogli di Stile
*/
add_action('wp_head',	"desigitalia_child_Head");
function desigitalia_child_Head(){
	$Regole="";
	if (!is_admin_bar_showing ()) {
//		$Regole=".sticky .it-header-navbar-wrapper, #myHeader{margin-top: 0!important;padding-top:0;}";
		$Regole=".sticky{margin-top: 0!important;padding-top:0;}";
	}else{
		$Regole="@media screen and (min-width: 600px){
	.sticky {
	    margin-top: 25px;
	}
}
@media screen and (min-width: 600px) and (max-width: 782px){
	.sticky {
	    margin-top: 45px;
	}
}
@media screen and (max-width: 599px){
	.sticky {
	    margin-top: 0;
	}
}";
	}
	?>
	<!-- Custom <head> content -->
		<style type="text/css">				
			#content {background-color:#<?php echo get_theme_mod( 'background_color' ); ?>;}
			<?php echo $Regole; ?>
    		.my-bg-primary { background-color: <?php echo get_theme_mod( 'wppa_head_color', "#0066cc" ); ?>; }
    		@media (min-width:1200px) {
		     .it-list-wrapper .it-list a:hover {
		         color: <?php echo get_theme_mod( 'wppa_link_color', "#0066cc" ); ?>;
		    }
 }   
	    </style>
	<?php 	
}

add_action( 'admin_enqueue_scripts', 	        'Admin_Enqueue_Scripts');
function Admin_Enqueue_Scripts( $hook_suffix ) {
//	var_dump($hook_suffix);wp_die();
}
add_action( 'admin_enqueue_scripts', 'carica_stili_parent_admin' );
function carica_stili_parent_admin() {
    wp_enqueue_style('scuola_fonts_Awesome', get_template_directory_uri() . '-child/font/css/all.css');
}
add_action('wp_enqueue_scripts', 	'carica_script_parent');
function carica_script_parent() {
    wp_enqueue_style('parent-style', get_template_directory_uri() . '-child/style.css');
    wp_enqueue_style('USRLo_fonts_Awesome', get_template_directory_uri() . '-child/font/css/all.css');
	wp_enqueue_script('PopperScript', get_template_directory_uri().'-child/js/popper.min.js', array('jquery'),null ,true );
//	wp_enqueue_script('BootstrapScript', get_template_directory_uri().'-child/js/bootstrap.min.js', array('jquery'),null ,true );
 //   wp_enqueue_script('DesignItaliaScript', get_template_directory_uri().'-child/js/bootstrap-italia.min.js', array('jquery'),null ,true );
    wp_enqueue_script('DesignItaliaBundleScript', get_template_directory_uri().'-child/js/bootstrap-italia.bundle.min.js', array('jquery'),null ,true );
	wp_enqueue_script('DesignItaliaChild', get_template_directory_uri().'-child/js/Public.js', array('jquery'),null ,true );
	if (is_front_page()) {
		wp_enqueue_script( 'Scuola-image_hover_effects_JS', get_stylesheet_directory_uri() . '/js/production.min.js' );
		wp_enqueue_style('Scuola-image_hover_effects_CSS', get_stylesheet_directory_uri() . '/css/image_hover_effects.css');	
//		wp_enqueue_script( 'Scuola-Js-carousel', get_stylesheet_directory_uri() . '/owlcarousel/owl.carousel.js' );
//    	wp_enqueue_style('Scuola-CSS-carousel', get_stylesheet_directory_uri() . '/owlcarousel/assets/owl.carousel.min.css');
//		wp_enqueue_style('Scuola-carousel-theme', get_stylesheet_directory_uri() . '/owlcarousel/assets/owl.theme.default.min.css');	
//		wp_enqueue_script('ScuolaCarousel', get_template_directory_uri().'-child/js/owlcarousel.js', array('jquery'),null,true );
	}
}
if ( !class_exists( 'SimplePie' ) ) {

	class Registry_FixSimplePieErrors {

	    static public $sFilePath = __FILE__; 
	    static public $sDirPath  = '';
	    
	    static public function setUp() {
	        self::$sDirPath = dirname( self::$sFilePath );
	    }
	}

Registry_FixSimplePieErrors::setUp();

include( dirname( __FILE__ ) . '/inc/class-simplepie.php' );
}
/**
* Abilita la gestione dei link Old Style
*/
add_filter( 'pre_option_link_manager_enabled', '__return_true' );

/**
* Gestione dei Widgets personalizzati per il tema Child
* 
* @return
*/
require (get_template_directory() . '-child/widget/widget.php' ); 

add_action( 'widgets_init', 'Scuola_Register_Widget' );
function Scuola_Register_Widget(){
	register_widget( 'Articoli' );
	register_widget( 'Articoli_Griglia' );
	register_widget( 'Trasparenza' );
//	register_widget( 'GalleriaLinks' );
	register_widget( 'Feed_RSS' );
	if(class_exists("EM_Event")){
		register_widget( 'my_EM_Widget_Calendar' );
	}
	if(get_theme_mod('scuola_servizi_attiva')){
		register_widget( 'Servizi' );
	}
	if(function_exists("at_sezioni_shtc")){
		register_widget( 'my_ATWidget' );	
	}
	if(get_theme_mod("scuola_circolari_attiva")){
		register_widget( 'CircolariScuola' );
	}
	if (function_exists('register_sidebar')) {
		if(class_exists("EM_Event")){
			register_sidebar(array(
				'name' => __('Event Sidebar Widget Area', 'wppa') ,
				'id' => 'event-widget-area',
				'description'   => __( 'Widget area che compare nella sidebar degli eventi.', 'wppa' ),
				'before_widget' => '<div id="%1$s" class="widget-container shadow p-2 %2$s">',
				'after_widget' => "</div>",
				'before_title' => '<h3 class="widget-title">',
				'after_title' => '</h3>',
			));
		}
		if(function_exists("at_sezioni_shtc")){
			register_sidebar(array(
				'name' => __('Amministrazione Trasparente', 'wppa') ,
				'id' => 'amm-trasparente-widget-area',
				'description'   => __( 'Widget area visibile solo nelle pagine dell\'Amministrazione Trasparente.', 'wppa' ),
				'before_widget' => '<div id="%1$s" class="widget-container shadow p-2 %2$s">',
				'after_widget' => "</div>",
				'before_title' => '<h3 class="widget-title">',
				'after_title' => '</h3>',
			));
		}
	}
}
/**
* Inclusione librerie dei Widget
*/
require get_template_directory() . '-child/widget/widget_calendario.php';
require get_template_directory() . '-child/widget/widget_feedRSS.php';
require get_template_directory() . '-child/widget/widget_trasparenza.php';
require get_template_directory() . '-child/widget/widget_articoli.php';
require get_template_directory() . '-child/widget/widget_articoli_griglia.php';
if(get_theme_mod('scuola_servizi_attiva')){
	require get_template_directory() . '-child/widget/widget_servizi.php';
}
if(function_exists("at_sezioni_shtc")){
	require get_template_directory() . '-child/widget/widget_AT.php';
}
if(get_theme_mod("scuola_circolari_attiva")){
	require get_template_directory() . '-child/widget/widget_circolari.php';
}

/**
* Inclusione Moduli del tema
*/
if(get_theme_mod('scuola_faq_attiva')){ 
	require get_template_directory() . '-child/plugins/faq/scuola_faq.php';
	$my_faq=new ScuolaFAQ();
}
if(get_theme_mod('scuola_servizi_attiva')){
	require get_template_directory() . '-child/plugins/servizi/scuola_servizi.php';
	$my_servizi=new ScuolaServizi();
}
if(get_theme_mod('scuola_circolari_attiva')){
	require get_template_directory() . '-child/plugins/gestione-circolari/GestioneCircolari.php';
}
/**
* Inclusione libreria per la personalizzazione delle impostazioni del tema
*/
require get_template_directory() . '-child/inc/customizer.php';
/**
* Inclusione libreria per la personalizzazione dell'elenco delle categorie
*/
require get_template_directory() . '-child/inc/my_class-walker-category.php';

function calc_NumArticoliMA($ArchivioDate){
	$Dati=array();
	foreach ($ArchivioDate as $Data) {
		$Dati[$Data->Anno]=(isset($Dati[$Data->Anno])?$Dati[$Data->Anno]:0)+$Data->NumArt;
	}
	return $Dati;
}
if (function_exists("at_sezioni_shtc")){
	remove_shortcode('at-sezioni');
	function my_at_sezioni_shtc($atts) {
	    ob_start();
	    include( get_stylesheet_directory()."/plugins/amministrazione-trasparente/shortcodes/shortcodes-sezioni.php");
	    $atshortcode = ob_get_clean();
	    return $atshortcode;
	} add_shortcode('at-sezioni', 'my_at_sezioni_shtc');
}
if (function_exists("at_sezioni_shtc")){
	remove_shortcode('at-search');
	function my_at_search_shtc($atts)  {
	    ob_start();
	    include( get_stylesheet_directory()."/plugins/amministrazione-trasparente/shortcodes/shortcodes-search.php");
	    $atshortcode = ob_get_clean();
	    return $atshortcode;
	} add_shortcode('at-search', 'my_at_search_shtc');	
}
function get_MenuSocial($ulID="menu-social",$ulClass="nav",$liClass="menu-item"){?>
	<ul id="<?php echo $ulID;?>" class="<?php echo $ulClass;?>">
	<?php if (get_theme_mod('scuola_social_facebook')){?>
		<li class="<?php echo $liClass;?>">
			<a href="<?php echo get_theme_mod('scuola_social_facebook');?>" target="_blank"><i class="fab fa-facebook-f"></i> <span class="sr-only"> link al canale Facebook</span></a>
		</li>
	<?php }
		if (get_theme_mod('scuola_social_twitter')){?>
		<li class="<?php echo $liClass;?>">
			<a href="<?php echo get_theme_mod('scuola_social_twitter');?>" target="_blank"><i class="fab fa-twitter"></i> <span class="sr-only"> link al canale Twitter</span></a>
		</li>
	<?php }		
		if (get_theme_mod('scuola_social_youtube')){?>
		<li class="<?php echo $liClass;?>">
			<a href="<?php echo get_theme_mod('scuola_social_youtube');?>" target="_blank"><i class="fab fa-youtube"></i> <span class="sr-only"> link al canale YouTube</span></a>
		</li>
	<?php }		
		if (get_theme_mod('scuola_social_instagram')){?>
		<li class="<?php echo $liClass;?>">
			<a href="<?php echo get_theme_mod('scuola_social_instagram');?>" target="_blank"><i class="fab fa-instagram"></i> <span class="sr-only"> link al canale Instagram</span></a>
		</li>
	<?php }		
		if (get_theme_mod('scuola_social_telegram')){?>
		<li class="<?php echo $liClass;?>">
			<a href="<?php echo get_theme_mod('scuola_social_telegram');?>" target="_blank"><i class="fab fa-telegram-plane"></i> <span class="sr-only"> link al canale Telegram</span></a>
		</li>
	<?php }		
		if (get_theme_mod('scuola_social_linkedin')){?>
		<li class="<?php echo $liClass;?>">
			<a href="<?php echo get_theme_mod('scuola_social_linkedin');?>" target="_blank"><i class="fab fa-linkedin-in"></i> <span class="sr-only"> link al canale LinkedIn</span></a>
		</li>
	<?php }?>
	</ul>
<?php
}