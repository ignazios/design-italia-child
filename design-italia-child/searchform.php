<?php
echo '<form role="search" method="get" id="mysearchform" class="mysearchform" action="' . home_url( '/' ) . '" >
    <div>
    	<label class="screen-reader-text" for="s">Ricerca all\'interno del sito</label>
    	<input type="text" value="' . get_search_query() . '" name="s" id="s" />
    	<button type="submit" id="mysearchsubmit"><i class="fas fa-search"></i><span class="sr-only">Cerca</span></button>
    </div>
    </form>';
?>