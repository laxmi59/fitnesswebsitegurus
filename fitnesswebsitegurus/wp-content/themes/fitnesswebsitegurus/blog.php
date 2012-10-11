<?php
/**
 * Template Name: 	Blog
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
		<div id="primary"> 	 
	
		 
			<div id="content" role="main" class="blog">
                <div class="gray-corner topLeft"></div>
                <div class="gray-corner topRight"></div>
                <div class="gray-corner bottomLeft"></div>
                <div class="gray-corner bottomRight"></div> 
				<?php while ( have_posts() ) : the_post(); ?>
					<h1 class="entry-title"><?php the_title(); ?></h1>
					<div  class="blue-grd">
                    <div class="blue-corner topLeft"></div>
                    <div class="blue-corner topRight"></div>
                    <div class="blue-corner bottomLeft"></div>
                    <div class="blue-corner bottomRight"></div> 
					<?php the_content(); ?>    
					</div>
				<?php endwhile; // end of the loop. ?>
 
  <div class="blog">
<ul>
	<?php
    $args=array(
      'post_type' => 'post',
      'post_status' => 'publish',
	  'orderby'         => 'post_date',
	  'order'           => 'DESC',
      );
    $my_query = null;
    $my_query = new WP_Query($args);
    if( $my_query->have_posts() ) {
      echo '';
      while ($my_query->have_posts()) : $my_query->the_post(); 
	  $autor_id = get_the_author_ID();
			$autor_name = get_the_author_meta('user_nicename', $autor_id);
	  ?>
      <li><h3><span class="postdate"><?php  echo "<span class='month'>".get_the_time('F',get_the_ID())." </span><span class='day'>".get_the_time('j',get_the_ID())."</span><span class='year'>".get_the_time('Y',get_the_ID())."</span>";  ?></span><a class="sidebar" href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3><div  class="blog-content-frame"> <div  class="article-content"><a class="featured-img" href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>"><?php 
if ( has_post_thumbnail() ) { // check if the post has a Post Thumbnail assigned to it.
  the_post_thumbnail();
} 
?></a><span class="postedby"><?php  echo "Posted by ".$autor_name."";  ?></span><?php the_excerpt(); ?>  <!-- a href="<?php echo get_permalink($post->ID);?>" class="readmore">Read More</a--></div></div></li>
       <?php
      endwhile;
    }
wp_reset_query();
?>
<!-- then the pagination links -->
<?php previous_posts_link( 'Newer posts &rarr;' ); ?>&nbsp;&nbsp;&nbsp;<?php next_posts_link( '&larr; Older posts' ); ?>
</ul></div>
			</div><!-- #content -->
		</div><!-- #primary -->

<?php get_footer(); ?>
