<?php
/**
 * Plugin Name: SiSviluppo_FAQ
 * Plugin URI:
 * Description: Plugin per la gestione di FAQs
 *
 * Version: 0.1
 *
 * License: GNU General Public License v2.0
 * License URI: http://www.opensource.org/licenses/gpl-license.php
 */

class ScuolaServizi {

/**
 * Definisce post type e tassonomie relative ai servizi
 */
 
    public function __construct() {
        $this->load_dependencies();

    }

    private function load_dependencies() {
    	add_action( 'init',  									array( $this, 'scuola_register_servizi' ) );
	  	add_action( 'edit_form_after_title', 					array( $this,'servizio_add_descrizione_titolo' ) );
		add_filter( 'enter_title_here', 						array( $this,'servizio_change_title_text' ) );

/*       add_filter( 'manage_posts_columns',     				array( $this, 'Colonne_FAQ_Intestazioni' ) );
        add_action( 'manage_posts_custom_column',   			array( $this, 'Colonne_FAQ_Contenuti' ) );
        add_filter( 'post_updated_messages',    				array( $this, 'messages' ) );
        add_filter( 'post_updated_messages',       				array( $this, 'messages' ) );
		add_action( 'admin_menu', 								array( $this, 'add_faq_metabox' ) );
        add_shortcode( 'FAQ',                       			array( $this, 'visualizza_faq' ) );
*/     }
		function servizio_change_title_text( $title ){
		     $screen = get_current_screen();
		  
		     if  ( 'servizio' == $screen->post_type ) {
		          $title = __('Inserisci il Nome del Servizio', 'wpscuola' );
		     }
		  
		     return $title;
		}
  
	function scuola_register_servizi() {

	$labels = array(
		'name'                  => _x( 'Servizi', 'Post Type General Name', 'wpscuola' ),
		'singular_name'         => _x( 'Servizio', 'Post Type Singular Name', 'wpscuola' ),
		'menu_name'             => __( 'Servizi', 'wpscuola' ),
		'name_admin_bar'        => __( 'Servizi', 'wpscuola' ),
		'archives'              => __( 'Archivio Servizi', 'wpscuola' ),
		'attributes'            => __( 'Attributi Servizio', 'wpscuola' ),
		'parent_item_colon'     => __( 'Servizio Padre:', 'wpscuola' ),
		'all_items'             => __( 'Tutti i Servizi', 'wpscuola' ),
		'add_new_item'          => __( 'Aggiungi nuovo Servizio', 'wpscuola' ),
		'add_new'               => __( 'Aggiungi Nuovo', 'wpscuola' ),
		'new_item'              => __( 'Nuovo Servizio', 'wpscuola' ),
		'edit_item'             => __( 'Modifica Servizio', 'wpscuola' ),
		'update_item'           => __( 'Aggiorna Servizio', 'wpscuola' ),
		'view_item'             => __( 'Visualizza Servizio', 'wpscuola' ),
		'view_items'            => __( 'Visualizza Servizi', 'wpscuola' ),
		'search_items'          => __( 'Cerca Servizio', 'wpscuola' ),
		'not_found'             => __( 'Servizio non trovato', 'wpscuola' ),
		'not_found_in_trash'    => __( 'Servizio non trovato nel cestino', 'wpscuola' ),
		'featured_image'        => __( 'Logo Servizio', 'wpscuola' ),
		'set_featured_image'    => __( 'Imposta Logo Servizio', 'wpscuola' ),
		'remove_featured_image' => __( 'Rimuovi Logo Servizio', 'wpscuola' ),
		'use_featured_image'    => __( 'Usa Logo Servizio', 'wpscuola' ),
		'insert_into_item'      => __( 'Inserisci nel Servizio', 'wpscuola' ),
		'uploaded_to_this_item' => __( 'Carica in questo Servizio', 'wpscuola' ),
		'items_list'            => __( 'Lista Servizi', 'wpscuola' ),
		'items_list_navigation' => __( 'Naviga la Lista dei Servizi', 'wpscuola' ),
		'filter_items_list'     => __( 'Filtra lista Servizi', 'wpscuola' ),
	);
	$args = array(
		'label'                 => __( 'Servizi', 'wpscuola' ),
		'description'           => __( "I servizi interni ed esterni della scuola.", 'wpscuola' ),
		'labels'                => $labels,
		'supports'              => false,
//		'taxonomies'            => array( 'category', 'post_tag' ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 21,
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => true,
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capability_type'       => 'page',
		'show_in_rest' => true,
		'supports'          	=> array( 'title', 'editor', 'revisions', 'thumbnail'),
	);
	register_post_type( 'servizio', $args );
}
/**
 * Aggiungo label sotto il titolo
 */
	function servizio_add_descrizione_titolo($post) {
		if($post->post_type == "servizio"){
			_e('<span><i>il <b>Titolo</b> &egrave; il <b>Nome del Servizio</b>.<br>', 'wpscuola' );
			_e('<h2>Descrizione del Servizio</h2>', 'wpscuola' );
		}
	}
}