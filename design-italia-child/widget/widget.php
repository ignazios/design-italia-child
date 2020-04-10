<?php
/****************************************************************************
 Widget Galleria
	   Titolo:	($title) Testo che viene visualizzato in Testa all'elenco degli articoli estratti
	Categoria:  ($categoria) Id della categoria dei link di cui creare la galleria
*/

class GalleriaLinks extends WP_Widget {

        function __construct() {
			parent::__construct (false, 'DesignItalia Galleria Link',
				array('classname' => 'GalleriaLinks',
				    'description' => 'Blocco Galleria serve per creare una galleria di link con Immagine, descrizione e link'));
        }

        function widget( $args, $instance ) {
        	extract($args);
//        	var_dump($args);
            $title = apply_filters('widget_title', $instance['titolo']);
            $idW=str_replace(" ","_",strtolower($instance['titolo']));
            $categoria=$instance['categoria'];
?>
<section id="<?php echo $title;?>">
<div class="container  mt-5">
	<div class="it-header-block">
	    <div class="it-header-block-title">
	      <h2 class="no_toc"><?php echo $title;?></h2>
	    </div>
	</div>
	<div class="row">
<?php 
			$Links=get_bookmarks("category=".$categoria);
			$Num=0;
			foreach($Links as $Link){
				if($Num<4){?>
		<div class="col-lg-3 col-sm-6 col-12">
			<figure class="overlay-wrapper">
				<img src="<?php echo $Link->link_image;?>" alt="Immagine" class="img-fluid">
				<figcaption class="overlay-panel">
					<a href="<?php echo $Link->link_url;?>" class="testo-bianco" title="<?php echo $Link->link_description;?>" target="<?php echo $Link->link_target;?>"><?php echo $Link->link_name;?></a>
				</figcaption>
			</figure>
		</div>					
<?php		$Num=$Num+1;	
				}
			}
			?>
			
	</div>	
</div>					  
</section>
<?php
        }

        function update( $new_instance, $old_instance ) {

            $instance = $old_instance;
            $instance['titolo'] = strip_tags($new_instance['titolo']);
	        $instance['categoria'] = strip_tags($new_instance['categoria']);
            return $instance;
        }

        function form( $instance ) {

           	$instance = wp_parse_args( (array) $instance, array( ) ); 
        	$titolo = ! empty( $instance['titolo'] ) ? $instance['titolo'] : esc_html__( 'Link', 'text_domain' );
        	$args=array('taxonomy' => 'link_category',
			    		'hide_empty' => false);
			$CatsLink = get_terms($args);
			$Elenco="<select id=\"".$this->get_field_id( 'categoria' )."\" name=\"".$this->get_field_name( 'categoria' )."\">
				<option value=\"\" >--------</option>";
			$Categoria=isset($instance["categoria"])?$instance["categoria"]:"";
			foreach ( $CatsLink as $CatLink ) {
				$Elenco.= "<option value=\"".$CatLink->term_id."\"";
				if($CatLink->term_id==(int)$Categoria){
					$Elenco.= " selected ";	
				}
				$Elenco.= " >".$CatLink->name."</option>";
			}
			$Elenco.="</select>";
?>
            <p>
                <label for="<?php echo $this->get_field_id( 'titolo' ); ?>">Titolo Sezione:</label>
                <input type="text" class="widefat" id="<?php echo $this->get_field_id( 'titolo' ); ?>" name="<?php echo $this->get_field_name( 'titolo' ); ?>" value="<?php echo esc_attr( $titolo ); ?>" />
            </p>
            <p>
                <label for="<?php echo $this->get_field_id( 'categoria' ); ?>">Categoria Link:</label><br />
<?php        
			echo $Elenco; 
?>
			</p>
<?php
        } 
    }	
/****************************************************************************
 Widget Blocchi
	   Titolo:	($title) Testo che viene visualizzato in Testa all'elenco degli articoli estratti
	  Blocchi:	($blocchi) Array di max 4 elementi di (Immagine,Testo,Link)
*/

class Blocchi extends WP_Widget {

        function __construct() {
			parent::__construct( false, 'DesignItalia Blocchi',
				array('classname' => 'Blocchi',
				    'description' => 'Blocco Grafica-Titolo con Link max 4 elementi') );
        }

        function widget( $args, $instance ) {
        	extract($args);
            $title = apply_filters('widget_title', $instance['titolo']);
            $bgkcolor=isset($instance['bgkcolor'])?$instance['bgkcolor']:"";
            $bgkcolorblocchi=isset($instance['bgkcolorblocchi'])?$instance['bgkcolorblocchi']:"";
            $colortit=isset($instance['colortit'])?$instance['colortit']:"";
            $colortitblocchi=isset($instance['colortitblocchi'])?$instance['colortitblocchi']:"";
 			$Blocchi=unserialize($instance['blocchi']);
 			$nBlocchi=0;
?>
	<div class="<?php echo $instance['bgkcolor'];?>" >
      <div class="u-layout-wide u-layoutCenter u-layout-withGutter <?php echo $instance['bgkcolor'];?>">
 <?php
			foreach($Blocchi as $Index=>$Valori){
				$D_SE=parse_url($Valori['Link']);
				$D_Me=parse_url(get_home_url());
				if( ($D_SE["scheme"]==$D_Me["scheme"] and
				    $D_SE["host"]==$D_Me["host"]) or
				    empty($D_SE['host'])){
				    $StileM="width:100%;";	
				    $StileA="";
				    $StileAC='';
				}else{
					$StileM="width:90%;";
					$StileA='style="font-size: 1.9em;font-weight: bold;text-decoration:none!important;"';
					$StileAC='class="'.$colortitblocchi.'" ';
				}
				if($Valori['Link'] !="" And $Valori['Img']!=""){
					$nBlocchi++;
					$indice='Blocco'.$Index;
					$$indice='	
	<div class="Grid-cell u-sizeFull u-md-size1of2 u-lg-size1of4">
		<div class="'.$bgkcolorblocchi.' u-margin-bottom-l u-borderRadius-m u-padding-all-m">
			<a href="'.$Valori['Link'].'" '.$StileAC.' '.$StileA.'><img src="'.$Valori['Img'].'" style="'.$StileM.'"/></a><br />
			<h2 id="'.str_replace(" ","_",strtolower($Valori['Titolo'])).'" class="'.$colortitblocchi.' ServiziTitle u-layout-centerLeft u-text-r-s">'.$Valori['Titolo'].'</h2>
		</div>
    </div>';
				}
			}
			if ($nBlocchi==0) return;
            if ( $title ) {
            	$before_title=str_replace("<h2 class=\"","<h2 class=\"u-text-h2 ",$before_title);
                echo $before_widget .str_replace("class=\"","class=\"". $colortit." ",$before_title) . $title . $after_title;
            }
			echo "<div class=\"Grid Grid--withGutter u-padding-left-l u-padding-right-l u-padding-bottom-xs u-padding-top-xs\">";
            for($i=0;$i<5;$i++){
            	$indice='Blocco'.$i;
				echo isset($$indice)?$$indice:"";
			}
			echo "</div>
	</div>
</div>";
        }

        function update( $new_instance, $old_instance ) {

            $instance = $old_instance;
            $instance['titolo'] = strip_tags($new_instance['titolo']);
            $Blocchi=array();
            for($i=1;$i<5;$i++){
			   $Blocchi[]=array("Img"=>isset($new_instance["Img$i"])?$new_instance["Img$i"]:"",
			                   "Link"=>isset($new_instance["Link$i"])?$new_instance["Link$i"]:"",
			                 "Titolo"=>isset($new_instance["Titolo$i"])?$new_instance["Titolo$i"]:"");
			}
            $instance['blocchi'] = strip_tags(serialize($Blocchi));
            $instance['bgkcolor']=strip_tags($new_instance['bgkcolor']);
            $instance['bgkcolorblocchi']=strip_tags($new_instance['bgkcolorblocchi']);
            $instance['colortit']=strip_tags($new_instance['colortit']);
            $instance['colortitblocchi']=strip_tags($new_instance['colortitblocchi']);   
            return $instance;
        }

        function form( $instance ) {
            $instance = wp_parse_args( (array) $instance, array( ) ); 
            $titolo = ! empty( $instance['titolo'] ) ? $instance['titolo'] : esc_html__( 'Servizi', 'text_domain' );
            if(isset($instance['blocchi'])){
            	$Blocchi=unserialize($instance['blocchi']);
			}else{
				$Blocchi=array( array("Img"=>"","Link"=>"","Titolo"=>""),
								array("Img"=>"","Link"=>"","Titolo"=>""),
								array("Img"=>"","Link"=>"","Titolo"=>""),
								array("Img"=>"","Link"=>"","Titolo"=>""));
			}
			$bgkcolor=isset($instance['bgkcolor'])?$instance['bgkcolor']:"";
            $bgkcolorblocchi=isset($instance['bgkcolorblocchi'])?$instance['bgkcolorblocchi']:"";
            $colortit=isset($instance['colortit'])?$instance['colortit']:"";
            $colortitblocchi=isset($instance['colortitblocchi'])?$instance['colortitblocchi']:"";
			$ColoriSfondo=array("u-background-black"=>"#000;",
								"u-background-white"=>"#fff;",
								"u-background-5"=>"#d9e6f2;",
								"u-background-10"=>"#adcceb;",
								"u-background-20"=>"#7db2e8;",
								"u-background-30"=>"#4799eb;",
								"u-background-40"=>"#127ae2;",
								"u-background-50"=>"#06c;",
								"u-background-60"=>"#0059b3;",
								"u-background-70"=>"#004c99;",
								"u-background-80"=>"#004080;",
								"u-background-90"=>"#036;",
								"u-background-95"=>"#00264d;",
								"u-background-teal-30"=>"#00c5ca;",
								"u-background-teal-50"=>"#65dcdf;",
								"u-background-teal-70"=>"#004a4d;",
								"u-background-grey-10"=>"#f5f5f0;",
								"u-background-grey-20"=>"#eee;",
								"u-background-grey-30"=>"#ddd;",
								"u-background-grey-40"=>"#a5abb0;",
								"u-background-grey-50"=>"#5a6772;",
								"u-background-grey-60"=>"#444e57;",
								"u-background-grey-80"=>"#30373d;",
								"u-background-grey-90"=>"#1c2024;");
 			$ColoriTesto= array("u-color-black"=>"#000;",
								"u-color-white"=>"#fff;",
								"u-color-5"=>"#d9e6f2;",
								"u-color-10"=>"#adcceb;",
								"u-color-20"=>"#7db2e8;",
								"u-color-30"=>"#4799eb;",
								"u-color-40"=>"#127ae2;",
								"u-color-50"=>"#06c;",
								"u-color-60"=>"#0059b3;",
								"u-color-70"=>"#004c99;",
								"u-color-80"=>"#004080;",
								"u-color-90"=>"#036;",
								"u-color-95"=>"#00264d;",
								"u-color-teal-30"=>"#00c5ca;",
								"u-color-teal-50"=>"#65dcdf;",
								"u-color-teal-70"=>"#004a4d;",
								"u-color-grey-10"=>"#f5f5f0;",
								"u-color-grey-20"=>"#eee;",
								"u-color-grey-30"=>"#ddd;",
								"u-color-grey-40"=>"#a5abb0;",
								"u-color-grey-50"=>"#5a6772;",
								"u-color-grey-60"=>"#444e57;",
								"u-color-grey-80"=>"#30373d;",
								"u-color-grey-90"=>"#1c2024;"); //var_dump($instance);
           ?>           

           <p>
                <label for="<?php echo $this->get_field_id( 'titolo' ); ?>">Titolo Sezione:</label>
                <input type="text" class="widefat" id="<?php echo $this->get_field_id( 'titolo' ); ?>" name="<?php echo $this->get_field_name( 'titolo' ); ?>" value="<?php echo esc_attr( $titolo ); ?>" />
            </p>
            <p>
        		<label for="<?php echo $this->get_field_id( 'bgkcolor' ); ?>">Colore di sfondo della sezione:</label><br />
				<select id="<?php echo $this->get_field_id( 'bgkcolor' ); ?>" name="<?php echo $this->get_field_name( 'bgkcolor' ); ?>">
<?php
		foreach($ColoriSfondo as $KColoreSfondo=>$ColoreSfondo){
			echo '<option value="'.$KColoreSfondo.'" style="background-color: '.$ColoreSfondo.'"';
			if($KColoreSfondo==$bgkcolor){
				echo " selected ";
			}
			echo'> '.$KColoreSfondo.' </option>';
		}
?>				</select><span style="background-color:<?php echo ($bgkcolor!=""?$ColoriSfondo[$bgkcolor]:"");?>;">&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;</span>
			</p>
            <p>
        		<label for="<?php echo $this->get_field_id( 'colortit' ); ?>">Colore del titolo della sezione:</label><br />
				<select id="<?php echo $this->get_field_id( 'colortit' ); ?>" name="<?php echo $this->get_field_name( 'colortit' ); ?>">
<?php
		foreach($ColoriTesto as $KColoreTesto=>$ColoreTesto){
			echo '<option value="'.$KColoreTesto.'" style="color: '.$ColoreTesto.'"';
			if($KColoreTesto==$colortit){
				echo " selected ";
			}
			echo'> '.$KColoreTesto.' </option>';
		}
?>				</select><span style="color:<?php echo ($colortit!=""?$ColoriTesto[$colortit]:"");?>;">&ensp;&ensp;Colore del testo</span>
			</p>
            <p>
        		<label for="<?php echo $this->get_field_id( 'bgkcolorblocchi' ); ?>">Colore di sfondo dei blocchi:</label><br />
				<select id="<?php echo $this->get_field_id( 'bgkcolorblocchi' ); ?>" name="<?php echo $this->get_field_name( 'bgkcolorblocchi' ); ?>">
<?php
		foreach($ColoriSfondo as $KColoreSfondo=>$ColoreSfondo){
			echo '<option value="'.$KColoreSfondo.'" style="background-color: '.$ColoreSfondo.';"';
			if($KColoreSfondo==$bgkcolorblocchi){
				echo " selected ";
			}
			echo'> '.$KColoreSfondo.' </option>';
		}
?>				</select><span style="background-color:<?php echo ($bgkcolorblocchi!=""?$ColoriSfondo[$bgkcolorblocchi]:"");?>;">&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;</span>	
			</p>			
            <p>
        		<label for="<?php echo $this->get_field_id( 'colortitblocchi' ); ?>">Colore del titolo dei blocchi:</label><br />
				<select id="<?php echo $this->get_field_id( 'colortitblocchi' ); ?>" name="<?php echo $this->get_field_name( 'colortitblocchi' ); ?>">
<?php
		foreach($ColoriTesto as $KColoreTesto=>$ColoreTesto){
			echo '<option value="'.$KColoreTesto.'" style="color: '.$ColoreTesto.'"';
			if($KColoreTesto==$colortitblocchi){
				echo " selected ";
			}
			echo'> '.$KColoreTesto.' </option>';
		}
?>				</select><span style="color:<?php echo ($colortitblocchi?$ColoriTesto[$colortitblocchi]:"");?>;">&ensp;&ensp;Colore del testo</span>
			</p>
     <div class="Servizi">
     	<h3>Blocco 1</h3>
        <label for="<?php echo $this->get_field_id( 'Img1' ); ?>">Immagine:</label>
		<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'Img1' );?>" name="<?php echo $this->get_field_name( 'Img1' );?>" value="<?php echo esc_attr($Blocchi[0]['Img']); ?>" />
     <br />
        <label for="<?php echo $this->get_field_id( 'Link1' );?>">Link:</label>
		<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'Link1' );?>" name="<?php echo $this->get_field_name( 'Link1' );?>" value="<?php echo esc_attr($Blocchi[0]['Link']); ?>" />
     <br />
        <label for="<?php echo $this->get_field_id( 'Titolo1' );?>">Titolo:</label>
		<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'Titolo1' );?>" name="<?php echo $this->get_field_name( 'Titolo1' );?>" value="<?php echo esc_attr($Blocchi[0]['Titolo']); ?>" />
     </div>

     <div class="Servizi">
     	<h3>Blocco 2</h3>
        <label for="<?php echo $this->get_field_id( 'Img2' ); ?>">Immagine:</label>
		<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'Img2' );?>" name="<?php echo $this->get_field_name( 'Img2' );?>" value="<?php echo esc_attr($Blocchi[1]['Img']); ?>" />
     <br />
        <label for="<?php echo $this->get_field_id( 'Link2' );?>">Link:</label>
		<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'Link2' );?>" name="<?php echo $this->get_field_name( 'Link2' );?>" value="<?php echo esc_attr($Blocchi[1]['Link']); ?>" />
     <br />
        <label for="<?php echo $this->get_field_id( 'Titolo2' );?>">Titolo:</label>
		<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'Titolo2' );?>" name="<?php echo $this->get_field_name( 'Titolo2' );?>" value="<?php echo esc_attr($Blocchi[1]['Titolo']); ?>" />
     </div>

     <div class="Servizi">
     	<h3>Blocco 3</h3>
        <label for="<?php echo $this->get_field_id( 'Img3' ); ?>">Immagine:</label>
		<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'Img3' );?>" name="<?php echo $this->get_field_name( 'Img3' );?>" value="<?php echo esc_attr($Blocchi[2]['Img']); ?>" />
     <br />
        <label for="<?php echo $this->get_field_id( 'Link3' );?>">Link:</label>
		<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'Link3' );?>" name="<?php echo $this->get_field_name( 'Link3' );?>" value="<?php echo esc_attr($Blocchi[2]['Link']); ?>" />
     <br />
        <label for="<?php echo $this->get_field_id( 'Titolo3' );?>">Titolo:</label>
		<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'Titolo3' );?>" name="<?php echo $this->get_field_name( 'Titolo3' );?>" value="<?php echo esc_attr($Blocchi[2]['Titolo']); ?>" />
     </div>
 
     <div class="Servizi">
     	<h3>Blocco 4</h3>
        <label for="<?php echo $this->get_field_id( 'Img4' ); ?>">Immagine:</label>
		<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'Img4' );?>" name="<?php echo $this->get_field_name( 'Img4' );?>" value="<?php echo esc_attr($Blocchi[3]['Img']); ?>" />
     <br />
        <label for="<?php echo $this->get_field_id( 'Link4' );?>">Link:</label>
		<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'Link4' );?>" name="<?php echo $this->get_field_name( 'Link4' );?>" value="<?php echo esc_attr($Blocchi[3]['Link']); ?>" />
     <br />
        <label for="<?php echo $this->get_field_id( 'Titolo4' );?>">Titolo:</label>
		<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'Titolo4' );?>" name="<?php echo $this->get_field_name( 'Titolo4' );?>" value="<?php echo esc_attr($Blocchi[3]['Titolo']); ?>" />
     </div>
      <?php
        }
    }


/****************************************************************************
 Widget Comunicazioni
	   Titolo:	($title) Testo che viene visualizzato in Testa all'elenco degli articoli estratti
*/

    class Comunicazioni extends WP_Widget {

        function __construct() {
			parent::__construct( false, 'DesignItalia Comunicazioni',
				array('classname' => 'Comunicazioni',
				    'description' => 'Blocco Comunicazioni due blocchi uno per le circolari ed uno per una categoria') );
        }

        function widget( $args, $instance ) {
 //       	var_dump($instance);
        	extract($args);
            $title = apply_filters('widget_title', $instance['titolo']);
            $bgkcolor=isset($instance['bgkcolor'])?$instance['bgkcolor']:"";
            $bgkcolorblocchi=isset($instance['bgkcolorblocchi'])?$instance['bgkcolorblocchi']:"";
            $colortit=isset($instance['colortit'])?$instance['colortit']:"";
            $colortitblocchi=isset($instance['colortitblocchi'])?$instance['colortitblocchi']:"";
            $bgkcolortitblocchi=isset($instance['bgkcolortitblocchi'])?$instance['bgkcolortitblocchi']:"";
 			$catprimoblocco=isset($instance['catprimoblocco'])?$instance['catprimoblocco']:"";
 			$catsecondoblocco=isset($instance['catsecondoblocco'])?$instance['catsecondoblocco']:"";
 			$numelementi=isset($instance['numelementi'])?$instance['numelementi']:"";
?>
	<div class="u-layoutCenter u-layout-withGutter u-padding-r-top <?php echo $instance['bgkcolor'];?>">
<?php
		echo $before_widget;
		if ( post_type_exists( 'circolari' ) ) {
			if (is_plugin_active(plugin_dir_path."gestione-circolari-groups")){
				echo "Gestione Circolari Groups";
			}else{
				$Circolari=get_ListaCircolari($numelementi);
				//var_dump($Circolari);
			}
		}	
		$args = array( 'cat' => $catsecondoblocco,
			   'posts_per_page'  => $numelementi,
			   'post_status' => (is_user_logged_in()? array('publish','private'):'publish'));
		$Articoli = get_posts( $args );	   
?>
	<div class="u-layout-medium u-layoutCenter">
<?php 
          if ( $title ) {
          		$before_title=str_replace("<h2 class=\"","<h2 class=\"u-text-h2 ".$colortit." ",$before_title);
                echo $before_title . $title . $after_title;
            }
?>
    	<div class="u-layout-wide u-layoutCenter u-layout-withGutter u-padding-r-top <?php echo $bgkcolor;?>">
    	<div class="Grid Grid--withGutter u-padding-all-xs">
			<div class="Grid-cell u-sizeFull u-md-size1of2 u-lg-size1of2">
				<div class="u-borderShadow-m u-borderRadius-l <?php echo $bgkcolorblocchi;?>">
					<h2 class="<?php echo $colortitblocchi." ".$bgkcolortitblocchi;?> u-padding-r-all">Circolari</h2>	    	 		
		<ul id="ListaCircolari" class="Linklist Linklist--padded u-text-r-xs">
<?php
if(isset($Circolari)){
	foreach($Circolari as $CircolareVis){
		echo "<li>".$CircolareVis['titolo']."
			<p class=\"u-textWeight-600;\">
			Del ".$CircolareVis['data'].($CircolareVis['numero']!=""?" Numero ".$CircolareVis['numero']."_".$CircolareVis['anno']:"")."<br />
		".$CircolareVis['tipo']." ".$CircolareVis['destinatari']." ".$CircolareVis['protezione']." ".$CircolareVis['firma']."</p>
		</li>";
	}
?>
		</ul>
<?php } ?>
				</div>
			</div>
			<div class="Grid-cell u-sizeFull u-md-size1of2 u-lg-size1of2">
				<div class="u-borderShadow-m u-borderRadius-l <?php echo $bgkcolorblocchi;?>">
					<h2 class="<?php echo $colortitblocchi." ".$bgkcolortitblocchi;?> u-padding-r-all">Avvisi</h2>	    	 		
		<ul id="ListaArticoli" class="Linklist Linklist--padded u-text-r-xs">
<?php
	foreach($Articoli as $Articolo){
		//var_dump($Articolo);
		echo "<li><a href=\"".get_permalink($Articolo->ID)."\">".$Articolo->post_title."</a>
			<p class=\"u-textWeight-600;\">
			Del ".IWP_FormatDataItaliano($Articolo->post_date)."<br />
		<span class=\"dashicons dashicons-admin-users\" style=\"font-size:1.5em;padding-right:1.4em;\"></span>".get_the_author_meta('display_name', $Articolo->post_author)."</span></p>
		</li>";
	}
?>
		</ul>
				</div>
	    	</div>
	    	</div>
		</div>
	</div>
</div>
<?php        }

        function update( $new_instance, $old_instance ) {
//var_dump($new_instance);wp_die();
            $instance = $old_instance;
            $instance['titolo'] = strip_tags($new_instance['titolo']);
            $instance['blocchi'] = strip_tags(serialize($Blocchi));
            $instance['bgkcolor']=strip_tags($new_instance['bgkcolor']);
            $instance['bgkcolorblocchi']=strip_tags($new_instance['bgkcolorblocchi']);
            $instance['colortit']=strip_tags($new_instance['colortit']);
            $instance['colortitblocchi']=strip_tags($new_instance['colortitblocchi']);   
            $instance['bgkcolortitblocchi']=strip_tags($new_instance['bgkcolortitblocchi']);

            $instance['catprimoblocco']=strip_tags($new_instance['catprimoblocco']);   
            $instance['catsecondoblocco']=strip_tags($new_instance['catsecondoblocco']);   
            $instance['numelementi']=strip_tags($new_instance['numelementi']);   

            return $instance;
        }

        function form( $instance ) {
            $instance = wp_parse_args( (array) $instance, array( ) ); 
            $titolo = ! empty( $instance['titolo'] ) ? $instance['titolo'] : esc_html__( 'Comunicazioni', 'text_domain' );
 			$catprimoblocco=isset($instance['catprimoblocco'])?$instance['catprimoblocco']:0;
 			$catsecondoblocco=isset($instance['catsecondoblocco'])?$instance['catsecondoblocco']:0;
			$bgkcolor=isset($instance['bgkcolor'])?$instance['bgkcolor']:"";
            $bgkcolorblocchi=isset($instance['bgkcolorblocchi'])?$instance['bgkcolorblocchi']:"";
            $colortit=isset($instance['colortit'])?$instance['colortit']:"";
            $colortitblocchi=isset($instance['colortitblocchi'])?$instance['colortitblocchi']:"";
            $bgkcolortitblocchi=isset($instance['bgkcolortitblocchi'])?$instance['bgkcolortitblocchi']:"";
            $numelementi=isset($instance['numelementi'])?$instance['numelementi']:5;
			$ColoriSfondo=array("u-background-black"=>"#000;",
								"u-background-white"=>"#fff;",
								"u-background-5"=>"#d9e6f2;",
								"u-background-10"=>"#adcceb;",
								"u-background-20"=>"#7db2e8;",
								"u-background-30"=>"#4799eb;",
								"u-background-40"=>"#127ae2;",
								"u-background-50"=>"#06c;",
								"u-background-60"=>"#0059b3;",
								"u-background-70"=>"#004c99;",
								"u-background-80"=>"#004080;",
								"u-background-90"=>"#036;",
								"u-background-95"=>"#00264d;",
								"u-background-teal-30"=>"#00c5ca;",
								"u-background-teal-50"=>"#65dcdf;",
								"u-background-teal-70"=>"#004a4d;",
								"u-background-grey-10"=>"#f5f5f0;",
								"u-background-grey-20"=>"#eee;",
								"u-background-grey-30"=>"#ddd;",
								"u-background-grey-40"=>"#a5abb0;",
								"u-background-grey-50"=>"#5a6772;",
								"u-background-grey-60"=>"#444e57;",
								"u-background-grey-80"=>"#30373d;",
								"u-background-grey-90"=>"#1c2024;");
 			$ColoriTesto= array("u-color-black"=>"#000;",
								"u-color-white"=>"#fff;",
								"u-color-5"=>"#d9e6f2;",
								"u-color-10"=>"#adcceb;",
								"u-color-20"=>"#7db2e8;",
								"u-color-30"=>"#4799eb;",
								"u-color-40"=>"#127ae2;",
								"u-color-50"=>"#06c;",
								"u-color-60"=>"#0059b3;",
								"u-color-70"=>"#004c99;",
								"u-color-80"=>"#004080;",
								"u-color-90"=>"#036;",
								"u-color-95"=>"#00264d;",
								"u-color-teal-30"=>"#00c5ca;",
								"u-color-teal-50"=>"#65dcdf;",
								"u-color-teal-70"=>"#004a4d;",
								"u-color-grey-10"=>"#f5f5f0;",
								"u-color-grey-20"=>"#eee;",
								"u-color-grey-30"=>"#ddd;",
								"u-color-grey-40"=>"#a5abb0;",
								"u-color-grey-50"=>"#5a6772;",
								"u-color-grey-60"=>"#444e57;",
								"u-color-grey-80"=>"#30373d;",
								"u-color-grey-90"=>"#1c2024;"); //var_dump($instance);
           ?>           

           <p>
                <label for="<?php echo $this->get_field_id( 'titolo' ); ?>">Titolo Sezione:</label>
                <input type="text" class="widefat" id="<?php echo $this->get_field_id( 'titolo' ); ?>" name="<?php echo $this->get_field_name( 'titolo' ); ?>" value="<?php echo esc_attr( $titolo ); ?>" />
            </p>
            <p>
        		<label for="<?php echo $this->get_field_id( 'bgkcolor' ); ?>">Colore di sfondo della sezione:</label><br />
				<select id="<?php echo $this->get_field_id( 'bgkcolor' ); ?>" name="<?php echo $this->get_field_name( 'bgkcolor' ); ?>">
<?php
		foreach($ColoriSfondo as $KColoreSfondo=>$ColoreSfondo){
			echo '<option value="'.$KColoreSfondo.'" style="background-color: '.$ColoreSfondo.'"';
			if($KColoreSfondo==$bgkcolor){
				echo " selected ";
			}
			echo'> '.$KColoreSfondo.' </option>';
		}
?>				</select><span style="background-color:<?php echo ($bgkcolor!=""?$ColoriSfondo[$bgkcolor]:"");?>;">&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;</span>
			</p>
            <p>
        		<label for="<?php echo $this->get_field_id( 'colortit' ); ?>">Colore del titolo della sezione:</label><br />
				<select id="<?php echo $this->get_field_id( 'colortit' ); ?>" name="<?php echo $this->get_field_name( 'colortit' ); ?>">
<?php
		foreach($ColoriTesto as $KColoreTesto=>$ColoreTesto){
			echo '<option value="'.$KColoreTesto.'" style="color: '.$ColoreTesto.'"';
			if($KColoreTesto==$colortit){
				echo " selected ";
			}
			echo'> '.$KColoreTesto.' </option>';
		}
?>				</select><span style="color:<?php echo ($colortit!=""?$ColoriTesto[$colortit]:"");?>;">&ensp;&ensp;Colore del testo</span>
			</p>
            <p>
        		<label for="<?php echo $this->get_field_id( 'bgkcolorblocchi' ); ?>">Colore di sfondo dei blocchi:</label><br />
				<select id="<?php echo $this->get_field_id( 'bgkcolorblocchi' ); ?>" name="<?php echo $this->get_field_name( 'bgkcolorblocchi' ); ?>">
<?php
		foreach($ColoriSfondo as $KColoreSfondo=>$ColoreSfondo){
			echo '<option value="'.$KColoreSfondo.'" style="background-color: '.$ColoreSfondo.';"';
			if($KColoreSfondo==$bgkcolorblocchi){
				echo " selected ";
			}
			echo'> '.$KColoreSfondo.' </option>';
		}
?>				</select><span style="background-color:<?php echo ($bgkcolorblocchi!=""?$ColoriSfondo[$bgkcolorblocchi]:"");?>;">&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;</span>	
			</p>			
            <p>
        		<label for="<?php echo $this->get_field_id( 'colortitblocchi' ); ?>">Colore del titolo dei blocchi:</label><br />
				<select id="<?php echo $this->get_field_id( 'colortitblocchi' ); ?>" name="<?php echo $this->get_field_name( 'colortitblocchi' ); ?>">
<?php
		foreach($ColoriTesto as $KColoreTesto=>$ColoreTesto){
			echo '<option value="'.$KColoreTesto.'" style="color: '.$ColoreTesto.'"';
			if($KColoreTesto==$colortitblocchi){
				echo " selected ";
			}
			echo'> '.$KColoreTesto.' </option>';
		}
?>				</select><span style="color:<?php echo ($colortitblocchi?$ColoriTesto[$colortitblocchi]:"");?>;">&ensp;&ensp;Colore del testo</span>
			</p>
           <p>
        		<label for="<?php echo $this->get_field_id( 'bgkcolortitblocchi' ); ?>">Colore di sfondo del titolo dei blocchi:</label><br />
				<select id="<?php echo $this->get_field_id( 'bgkcolortitblocchi' ); ?>" name="<?php echo $this->get_field_name( 'bgkcolortitblocchi' ); ?>">
<?php
		foreach($ColoriSfondo as $KColoreSfondo=>$ColoreSfondo){
			echo '<option value="'.$KColoreSfondo.'" style="background-color: '.$ColoreSfondo.'"';
			if($KColoreSfondo==$bgkcolortitblocchi){
				echo " selected ";
			}
			echo'> '.$KColoreSfondo.' </option>';
		}
?>				</select><span style="background-color:<?php echo ($bgkcolortitblocchi!=""?$ColoriSfondo[$bgkcolortitblocchi]:"");?>;">&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;</span>
			</p>
        <p>
            <label for="<?php echo $this->get_field_id( 'numelementi' ); ?>">N° elementi da visualizzare:</label>
            <input type="number" min="1" max="10" id="<?php echo $this->get_field_id( 'numelementi' ); ?>" name="<?php echo $this->get_field_name( 'numelementi' ); ?>" value="<?php echo $numelementi; ?>" />
        </p>
     <div class="Servizi">
    	<h3>Circolari</h3>
<?php
if ( post_type_exists( 'circolari' ) ) {
	echo "Gestite tramite il plugin ";
	if (is_plugin_active(plugin_dir_path."gestione-circolari-groups")){
		echo "Gestione Circolari Groups";
	}else{
		echo "Gestione Circolari";
	}
	echo '<input type="hidden" name="catprimoblocco" id="catprimoblocco" value="-1">';
}else{
?>
       <label for="<?php echo $this->get_field_id( 'Img1' ); ?>">Categoria:</label>
<?php  
	$args = array(
	'option_none_value'  => '-1',
	'orderby'            => 'name',
	'order'              => 'ASC',
	'show_count'         => 0,
	'hide_empty'         => FALSE,
	'child_of'           => 0,
	'echo'               => TRUE,
	'selected'           => $catprimoblocco,
	'name'               => $this->get_field_name('catprimoblocco'),
	'id'                 => $this->get_field_id('catprimoblocco'),
	'class'              => '',);
	wp_dropdown_categories( $args );
	} ?>
     </div>
     <div class="Servizi">
    	<h3>Altre Comunicazioni</h3>
    	<label for="<?php echo $this->get_field_id( 'Img1' ); ?>">Categoria:</label>
<?php  
	$args = array(
	'option_none_value'  => '-1',
	'orderby'            => 'name',
	'order'              => 'ASC',
	'show_count'         => 0,
	'hide_empty'         => FALSE,
	'child_of'           => 0,
	'echo'               => TRUE,
	'selected'           => $catsecondoblocco,
	'name'               => $this->get_field_name('catsecondoblocco'),
	'id'                 => $this->get_field_id('catsecondoblocco'),
	'class'              => '',);
	wp_dropdown_categories( $args );
?>
     </div>

      <?php
        }
    }		