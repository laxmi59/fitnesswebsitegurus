<?php
/**
 * The Sidebar containing the main widget area.
 *
 * @package WordPress
 * @subpackage Twenty_Eleven
 * @since Twenty Eleven 1.0
 */

$options = twentyeleven_get_theme_options();
$current_layout = $options['theme_layout'];

if ( 'content' != $current_layout ) :
?>
		<div id="secondary" class="widget-area" role="complementary">
					<?php if ( ! dynamic_sidebar( 'sidebar-1' ) ) : ?> 
			
				<aside id="meta" class="widget">  
				     
					<div class="ourwork">	
					<h2>Our Work</h2>
						 <ul>
						  <li><img src="<?php bloginfo('template_url'); ?>/images/template1.png"></li>
						  <li><img src="<?php bloginfo('template_url'); ?>/images/template2.png"></li>
						  <li><img src="<?php bloginfo('template_url'); ?>/images/template3.png"></li> 
						 </ul>  
						</div> 
				</aside>
 

 

			<?php endif; // end sidebar widget area ?>
		</div><!-- #secondary .widget-area -->
<?php endif; ?>