<?php
/****************************************************************************
 Widget Trasparenza
	   Titolo:	($title) Testo che viene visualizzato in Testa all'elenco degli articoli estratti
	  Pagina Amministrazione trasparente:	($urlAT)  Link alla pagina amministrazione trasparente
	           Pagina Albo Atti Correnti:	($urlAAC) Link alla pagina dell'albo atti correnti
	            Pagina Albo Atti Scaduti:	($urlAAS) Link alla pagina dell'albo atti storico
	  			   Pagina Accesso Civico:	($urlAC)  Link alla pagina dell'accesso civico
	  			              Pagina URP:	($urlURP) Link alla pagina dell'Ufficio relazioni con il pubblico
*/

class Trasparenza extends WP_Widget {

        function __construct() {
			parent::__construct( false, 'Scuola Trasparenza',
				array('classname' => 'Trasparenza',
				    'description' => 'Blocco Trasparenza Amministrazione Trasparente - Albo Pretorio - Accesso Civico - Ufficio Relazioni Con il Pubblico') );
        }

        function widget( $args, $instance ) {
        	extract($args);
            $title = apply_filters('widget_title', $instance['titolo']);
            $Is_AT=(isset($instance['AT']) And $instance['AT']!="");
            $Link_AT=(isset($instance['LAT']) And $instance['LAT']!="");
            $Is_AAC=(isset($instance['AAC']) And $instance['AAC']!="");
            $Link_AP=(isset($instance['LAP']) And $instance['LAP']!="");
            $Is_AAS=(isset($instance['AAS']) And $instance['AAS']!="");
            $Is_AC=(isset($instance['AC']) And $instance['AC']!="");
            $Is_URP=(isset($instance['URP']) And $instance['URP']!="");
            if( !$Is_AT And !$Link_AT And !$Link_AP And !$Is_AAC AND !$Is_AAS AND !$Is_AC AND !$Is_URP){
	            	return;
			}
?>
<section id="trasp_<?php echo $args['widget_id'];?>"  class="home-widget container ">
<?php 
            echo $args['before_widget'];
            if ( $title ) {
                echo $args['before_title'] . $title . $args['after_title'];
            } ?>   
  <div class="row d-flex justify-content-center" >
    <div class="col-lg-4 col-sm-6 col-12 m-2 p-5 bg-primary rounded text-center">
    	<a href="<?php echo $instance['AT'];?>" class="lead testo-bianco">Amministrazione Trasparente</a>
    </div>
    <div class="col-lg-3 col-sm-6 col-12 m-2">
    	  <div class="row mb-2 h-48">
		    <div class="col p-2 bg-primary rounded text-center">
				<a href="<?php echo $instance['URP']; ?>" class="lead testo-bianco" >URP</a>
			</div>
		  </div>
		  <div class="row h-48 pb-1">
		    <div class="col p-2 bg-primary rounded text-center">
		    	<a href="<?php echo $instance['AC'];?>" class="lead testo-bianco" >Accesso Civico</a>
		    </div>
		  </div> 	
    </div>
    <div class="col-lg-4 col-sm-6 col-12 m-2 p-5 bg-primary rounded text-center">
		<a href="<?php echo $instance['AAC']; ?>" class="lead testo-bianco" >Albo OnLine</a>
    </div>
  </div>
<?php   echo $args['after_widget']; ?>
</section>
<?php
        }

		function make_List_Pages($Pages,$Id,$Name,$Default){
			$Pagine="<select id=\"".$Id."\" name=\"".$Name."\">
		<option value=\"\" >--------</option>";
			foreach ( $Pages as $Pagina ) {
				$Url=get_permalink($Pagina->ID);
				$Pagine.= "<option value=\"".$Url."\"";
				if($Url==$Default){
					$Pagine.= " selected ";	
				}
				$Pagine.= " >".$Pagina->post_title."</option>";
			}
			$Pagine.="</select>";
			return $Pagine; 
		}
		
        function update( $new_instance, $old_instance ) {

            $instance = $old_instance;
            $instance['titolo'] = strip_tags($new_instance['titolo']);
            $instance['AT'] = strip_tags($new_instance['AT']);
            $instance['LAT'] = strip_tags($new_instance['LAT']);
            $instance['LAP'] = strip_tags($new_instance['LAP']);
            $instance['AAC'] = strip_tags($new_instance['AAC']);
            $instance['AAS'] = strip_tags($new_instance['AAS']);
            $instance['AC'] = strip_tags($new_instance['AC']);
            $instance['URP'] = strip_tags($new_instance['URP']);
            return $instance;
        }

        function form( $instance ) {

            $instance = wp_parse_args( (array) $instance, array( ) ); 
            $titolo = ! empty( $instance['titolo'] ) ? $instance['titolo'] : esc_html__( 'Servizi', 'text_domain' );
            $args = array(
			'post_status' => 'publish',
			'sort_order' => 'asc',
			'sort_column' => 'post_date'
			);		
            $Pagine=get_pages( $args );
            $ElencoAT=$this->make_List_Pages($Pagine,$this->get_field_id( 'AT' ),$this->get_field_name( 'AT' ),! empty( $instance['AT'] ) ? $instance['AT'] :"");
        	$Link_AT=$instance['LAT'];
           	$Link_AP=$instance['LAP'];
            $ElencoAAC=$this->make_List_Pages($Pagine,$this->get_field_id( 'AAC' ),$this->get_field_name( 'AAC' ),! empty( $instance['AAC'] ) ? $instance['AAC'] :"");
            $ElencoAAS=$this->make_List_Pages($Pagine,$this->get_field_id( 'AAS' ),$this->get_field_name( 'AAS' ),! empty( $instance['AAS'] ) ? $instance['AAS'] :"");
            $ElencoAC=$this->make_List_Pages($Pagine,$this->get_field_id( 'AC' ),$this->get_field_name( 'AC' ),! empty( $instance['AC'] ) ? $instance['AC'] :"");
            $ElencoURP=$this->make_List_Pages($Pagine,$this->get_field_id( 'URP' ),$this->get_field_name( 'URP' ),! empty( $instance['URP'] ) ? $instance['URP'] :"");
            ?>

            <p>
                <label for="<?php echo $this->get_field_id( 'titolo' ); ?>">Titolo Sezione:</label>
                <input type="text" class="widefat" id="<?php echo $this->get_field_id( 'titolo' ); ?>" name="<?php echo $this->get_field_name( 'titolo' ); ?>" value="<?php echo esc_attr( $titolo ); ?>" />
            </p>
            <p>
			    <label for="<?php echo $this->get_field_id( 'AT' );?>">Pagina Amministrazione Trasparente:</label><br />
           		<?php echo $ElencoAT; ?>
            </p>
            <p>
			    <label for="<?php echo $this->get_field_id( 'LAT' );?>">Link Esterno Amministrazione Trasparente:</label><br />
           		<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'LAT' ); ?>" name="<?php echo $this->get_field_name( 'LAT' ); ?>" value="<?php echo esc_attr( $Link_AT ); ?>" />
            </p>
           <p>
			    <label for="<?php echo $this->get_field_id( 'LAP' );?>">Link Esterno Albo OnLine:</label><br />
           		<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'LAP' ); ?>" name="<?php echo $this->get_field_name( 'LAP' ); ?>" value="<?php echo esc_attr( $Link_AP ); ?>" />
            </p>
           <p>
			    <label for="<?php echo $this->get_field_id( 'AAC' );?>">Pagina Albo Atti Correnti:</label><br />
           		<?php echo $ElencoAAC; ?>
            </p>
           <p>
			    <label for="<?php echo $this->get_field_id( 'AAS' );?>">Pagina Albo Atti Storico:</label><br />
           		<?php echo $ElencoAAS; ?>
            </p>
           <p>
			    <label for="<?php echo $this->get_field_id( 'AC' );?>">Pagina Accesso Civico:</label><br />
           		<?php echo $ElencoAC; ?>
            </p>
           <p>
			    <label for="<?php echo $this->get_field_id( 'URP' );?>">Pagina Ufficio Relazioni con il Pubblico:</label><br />
           		<?php echo $ElencoURP; ?>
            </p>
      <?php
        }
    }