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
	  	add_action( 'edit_form_after_title', 					array( $this, 'servizio_add_descrizione_titolo' ) );
		add_filter( 'enter_title_here', 						array( $this, 'servizio_change_title_text' ) );
		add_filter( 'rwmb_meta_boxes',                          array( $this, 'servizi_mbox_destinazione' ) );
		add_action( 'add_meta_boxes',							array( $this, 'servizi_add_custom_box' ) );
		add_action( 'save_post',      							array( $this, 'save_metabox' ), 10, 2 );
/*       add_filter( 'manage_posts_columns',     				array( $this, 'Colonne_FAQ_Intestazioni' ) );
        add_action( 'manage_posts_custom_column',   			array( $this, 'Colonne_FAQ_Contenuti' ) );
        add_filter( 'post_updated_messages',    				array( $this, 'messages' ) );
        add_filter( 'post_updated_messages',       				array( $this, 'messages' ) );
		add_action( 'admin_menu', 								array( $this, 'add_faq_metabox' ) );
        add_shortcode( 'FAQ',                       			array( $this, 'visualizza_faq' ) );
*/     }
		function servizi_add_custom_box()
		{
	        add_meta_box(
	            'Servizio_destinazione',    			// Unique ID
	            'Dati del Servizio',  					// Box title
	            array($this , 'servizi_destinazione'),  // Content callback, must be of type callable
	            'servizio'	               				// Post type
	        );
		}
 
	 function servizi_destinazione( $post ) {
		// Add nonce for security and authentication.
		wp_nonce_field( 'servizio_destinazione_nonce_action', 'servizio_nonce' );

		// Retrieve an existing value from the database.
		$servizio_link_servizio = get_post_meta( $post->ID, 'servizio_link_servizio', true );
		$servizio_link_descrizione = get_post_meta( $post->ID, 'servizio_link_descrizione', true );
		$servizio_attivazione_servizio = get_post_meta( $post->ID, 'servizio_attivazione_servizio', true );
		$servizio_codice_ipa = get_post_meta( $post->ID, 'servizio_codice_ipa', true );

		// Set default values.
		if( empty( $servizio_link_servizio ) ) $servizio_link_servizio = 'https://';
		if( empty( $servizio_link_descrizione ) ) $servizio_link_descrizione = 'https://';
		if( empty( $servizio_attivazione_servizio ) ) $servizio_attivazione_servizio = '';
		if( empty( $servizio_codice_ipa ) ) $servizio_codice_ipa = '';

		// Form fields.?>
		<table class="form-table">
			<tr>
				<th>
					<label for="servizio_attivazione_servizio" class="servizio_attivazione_servizio"><?php _e( 'Stato del Servizio', 'wpscuola' );?></label>
				</th>
				<td>
					<input type="checkbox" id="servizio_attivazione_servizio" name="servizio_attivazione_servizio" class="" value="on" <?php echo ($servizio_attivazione_servizio=="si"?"checked":"");?> > 
					<span class="description"><?php _e( 'Selezionare per attivare il Servizio.', 'wpscuola' );?></span>
				</td>
			</tr>
			<tr>
				<th>
					<label for="servizio_link_servizio" class=""> <?php _e( 'URL di eroragione del Servizio', 'wpscuola' );?> </label>
				</th>
				<td>
					<input type="text" id="servizio_link_servizio" name="servizio_link_servizio" class="" placeholder="<?php esc_attr_e( 'https://', 'wpscuola' );?>" value="<?php esc_attr_e( $servizio_link_servizio );?>" style="width:90%;">
				</td>
			</tr>
			<tr>
				<th>
					<label for="servizio_link_descrizione" class="servizio_link_descrizione"><?php  _e( 'URL di descrizione del Servizio', 'wpscuola' );?></label>
				</th>
				<td>
					<input type="text" id="servizio_link_descrizione" name="servizio_link_descrizione" class="" placeholder="<?php  esc_attr_e( 'https://', 'wpscuola' );?>" value="<?php esc_attr_e( $servizio_link_descrizione );?>" style="width:90%;">
				</td>
			</tr>
			<tr>
				<th>
					<label for="servizio_codice_ipa" class=""> <?php _e( 'Codice IPA', 'wpscuola' );?> </label>
				</th>
				<td>
					<input type="text" id="servizio_codice_ipa" name="servizio_codice_ipa" class="" placeholder="<?php esc_attr_e( '', 'wpscuola' );?>" value="<?php esc_attr_e( $servizio_codice_ipa );?>">
					<span class="description"><?php _e( 'Codice Indice dei domicili digitali della Pubblica Amministrazione (https://indicepa.gov.it/).', 'wpscuola' );?></span>
				</td>
			</tr>
		</table>
<?PHP	}
 
 	public function save_metabox( $post_id, $post ) {

		if ( ! isset( $_POST['servizio_nonce'] ) )
			return;

		// Add nonce for security and authentication.
		$nonce_name   = $_POST['servizio_nonce'];
		$nonce_action = 'servizio_destinazione_nonce_action';

		// Check if a nonce is set.
		// Check if a nonce is valid.
		if ( ! wp_verify_nonce( $nonce_name, $nonce_action ) )
			return;

		// Check if the user has permissions to save data.
		if ( ! current_user_can( 'edit_post', $post_id ) )
			return;

		// Check if it's not an autosave.
		if ( wp_is_post_autosave( $post_id ) )
			return;

		// Check if it's not a revision.
		if ( wp_is_post_revision( $post_id ) )
			return;
		// Sanitize user input.
		$servizio_link_servizio = isset( $_POST[ 'servizio_link_servizio' ] ) ? sanitize_text_field( $_POST[ 'servizio_link_servizio' ] ) : '';
		$servizio_link_descrizione = isset( $_POST[ 'servizio_link_descrizione' ] ) ? sanitize_text_field( $_POST[ 'servizio_link_descrizione' ] ) : '';
		$servizio_attivazione_servizio = isset( $_POST[ 'servizio_attivazione_servizio' ] ) ? 'si' : 'no';
		$servizio_codice_ipa = isset( $_POST[ 'servizio_codice_ipa' ] ) ? sanitize_text_field( $_POST[ 'servizio_codice_ipa' ] ) : '';
		// Update the meta field in the database.
		update_post_meta( $post_id, 'servizio_link_servizio', 			$servizio_link_servizio );
		update_post_meta( $post_id, 'servizio_link_descrizione', 		$servizio_link_descrizione );
		update_post_meta( $post_id, 'servizio_attivazione_servizio',	$servizio_attivazione_servizio );
		update_post_meta( $post_id, 'servizio_codice_ipa', 				$servizio_codice_ipa );

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
		'show_in_rest' 			=> true,
		'supports'          	=> array( 'title', 'editor', 'revisions', 'thumbnail'),
	);
	register_post_type( 'servizio', $args );

	$labels = array(
		'name'                       => _x( 'Tipi di Servizio', 'Taxonomy General Name', 'wpscuola' ),
		'singular_name'              => _x( 'Tipo di Servizio', 'Taxonomy Singular Name', 'wpscuola' ),
		'menu_name'                  => __( 'Tipi di Servizio', 'wpscuola' ),
		'all_items'                  => __( 'Tutti i tipi di Servizio', 'wpscuola' ),
		'parent_item'                => __( 'Tipo di Servizio padre', 'wpscuola' ),
		'parent_item_colon'          => __( 'Tipo di Servizio padre', 'wpscuola' ),
		'new_item_name'              => __( 'Nuovo Tipo di Servizio', 'wpscuola' ),
		'add_new_item'               => __( 'Aggiungi nuovo Tipo di Servizio', 'wpscuola' ),
		'edit_item'                  => __( 'Modifica Tipo di Servizio', 'wpscuola' ),
		'update_item'                => __( 'Aggiorna Tipo di Servizio', 'wpscuola' ),
		'view_item'                  => __( 'Visualizza Tipo di Servizio', 'wpscuola' ),
		'separate_items_with_commas' => __( 'Separere i Tipi di Servizio con le virgole', 'wpscuola' ),
		'add_or_remove_items'        => __( 'Aggiungi o Rimuovi Tipi di Servizio', 'wpscuola' ),
		'choose_from_most_used'      => __( 'Seleziona tra i Tipi di Servizio magiornamente utilizzati', 'wpscuola' ),
		'popular_items'              => __( 'Tipi di Servizo più popolari', 'wpscuola' ),
		'search_items'               => __( 'Cerca Tipo di Servizio', 'wpscuola' ),
		'not_found'                  => __( 'Tipo di Servizio non trovato', 'wpscuola' ),
		'no_terms'                   => __( 'Nessun Tipo di Servizio', 'wpscuola' ),
		'items_list'                 => __( 'Elenco Tipi di Servizio', 'wpscuola' ),
		'items_list_navigation'      => __( 'Naviga nella Lista dei Tipi di Servizio', 'wpscuola' ),
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => true,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => true,
		'show_in_rest'               => true,
	);
	register_taxonomy( 'tiposervizio', array( 'servizio' ), $args );

}
/**
 * Aggiungo label sotto il titolo
 */
		function servizio_change_title_text( $title ){
		     $screen = get_current_screen();
		  
		     if  ( 'servizio' == $screen->post_type ) {
		          $title = __('Inserisci il Nome del Servizio', 'wpscuola' );
		     }
		  
		     return $title;
		}

	function servizio_add_descrizione_titolo($post) {
		if($post->post_type == "servizio"){
			_e('<span><em>il <strong>Titolo</strong> &egrave; il <strong>Nome del Servizio</strong>.<br /><br />', 'wpscuola' );
			_e('<span style="font-size: 23px;font-weight: 400;margin: 0;padding: 9px 0 4px 0;line-height: 1.3;">Descrizione del Servizio</span>', 'wpscuola' );
		}
	}
}