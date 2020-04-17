<section class="entry-content">
	<?php if ( has_post_thumbnail() ) { the_post_thumbnail('medium', array( 'class' => 'float-left pr-2 pb-1' )); } ?>
	<?php the_content(); ?>
	<div class="entry-links">
		<?php wp_link_pages( );?>
	</div>
</section>