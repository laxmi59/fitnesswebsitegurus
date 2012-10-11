<?php
/**
 * Template Name: 	thank you
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package WordPress
 * @subpackage Twenty_Eleven
 * @since Twenty Eleven 1.0
 */

get_header(); ?>  
		<div id="primary"> 	 
		 
			<div id="content" role="main" class="thanks">

				<?php while ( have_posts() ) : the_post(); ?> 
			
				 
			 <?php 
if ( has_post_thumbnail() ) { // check if the post has a Post Thumbnail assigned to it.
  the_post_thumbnail();
} 
?>
<?php the_content(); ?>

				<?php endwhile; // end of the loop. ?>
 
  
			</div><!-- #content -->
		</div><!-- #primary -->

<?php get_footer(); ?>
