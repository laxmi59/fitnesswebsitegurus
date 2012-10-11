<?php
/**
 * The Template for displaying all single posts.
 *
 * @package WordPress
 * @subpackage Twenty_Eleven
 * @since Twenty Eleven 1.0
 */

get_header(); ?>
<?php get_sidebar(); ?>
		<div id="primary">
			<div id="content" role="main" class="blog btopmargin">
			               <div class="gray-corner topLeft"></div>
                <div class="gray-corner topRight"></div>
                <div class="gray-corner bottomLeft"></div>
                <div class="gray-corner bottomRight"></div> 
<div class="blog">
<ul>
 	<?php while ( have_posts() ) : the_post(); ?> 
			<li style="margin: 0px;">	<h3><span class="postdate"><?php  echo "<span class='month'>".get_the_time('F',get_the_ID())." </span><span class='day'>".get_the_time('j',get_the_ID())."</span><span class='year'>".get_the_time('Y',get_the_ID())."</span>";  ?></span><?php the_title(); ?></h3><div  class="blog-content-frame"> <div  class="article-content"> <?php the_content(); ?>  <!-- a href="<?php echo get_permalink($post->ID);?>" class="readmore">Read More</a--></div></div> 
 
  
					<?php comments_template( '', true ); ?>
	</li>
				<?php endwhile; // end of the loop. ?>
		</ul>
			</div><!-- #content -->
			</div><!-- #content -->
		</div><!-- #primary -->

<?php get_footer(); ?>