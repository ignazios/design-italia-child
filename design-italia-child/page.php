<?php
/**
* The template for displaying all pages
*
* This is the template that displays all pages by default.
* Please note that this is the WordPress construct of pages
* and that other 'pages' on your WordPress site may use a
* different template.
*
* @link https://codex.wordpress.org/Template_Hierarchy
*
* @package design-italia-child
*/
get_header(); 	
?>
<section id="content" role="main" class="container-fluid">
   <div class="container-fluid">
      <div class="row">

      <div class="col-lg-10 offset-lg-1">
         <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
         <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
            <header class="header">
               <h1 class="entry-title"><?php the_title(); ?></h1>
               <?php edit_post_link(); ?>
            </header>
             <?php get_template_part( 'entry','content' ) ;?>
         </article>
         <?php if ( ! post_password_required() ) comments_template( '', true ); ?>
         <?php endwhile; endif; ?>
      </div>
      </div>
   </div>
</section>
<?php get_footer(); ?>