<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id=main div and all content after
 *
 * @package WordPress
 * @subpackage Twenty_Eleven
 * @since Twenty Eleven 1.0
 */
?>

	</div><!-- #main -->
	</div><!-- site-image -->
</div> 
	 <div class="footer-links" ><?php wp_nav_menu('theme_location=traffic'); ?>  </div>
	<footer id="colophon" role="contentinfo">

			<?php
				/* A sidebar in the footer? Yep. You can can customize
				 * your footer with three columns of widgets.
				 */
				if ( ! is_404() )
					get_sidebar( 'footer' );
			?>
 		
<div class="copyright-area">
<div class="copyright">
&copy; 2002-2011 by FitnessWebsiteGurus.com, All rights reserved. </div>
<div class="designbymig">Designed by <h2>MIG</h2></div>
<div class="social-icons">
<a class="facebook" href="#"></a>
<a class="twitter" href="#"></a>
</div>
</div>

		 
	</footer><!-- #colophon -->
 <!-- #page -->

<?php wp_footer(); ?>

</body>
</html>