<?php
/**
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
<?php get_sidebar(); ?>
		<div id="primary" class="subpages">
			
			<div id="content" role="main">
				<div class="gray-corner topLeft"></div>
                <div class="gray-corner topRight"></div>
                <div class="gray-corner bottomLeft"></div>
                <div class="gray-corner bottomRight"></div> 

				<?php while ( have_posts() ) : the_post(); ?>

					<?php get_template_part( 'content', 'page' ); ?>
 
				<?php endwhile; // end of the loop. ?>

			</div><!-- #content -->
		</div><!-- #primary -->

<?php get_footer(); ?>