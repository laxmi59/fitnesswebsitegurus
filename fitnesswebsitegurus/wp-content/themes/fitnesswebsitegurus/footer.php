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

	</div><!-- #main --><? if (is_page( 'idea-world') || is_page( 'idea-world-thank-you')) {  ?> <div class="pkgpage-shadow"></div><?php } ?>
	</div><!-- site-image -->
</div>
<? if (is_page( 'idea-world') || is_page( 'idea-world-thank-you')) {  ?>    <?php  } else { ?> 
<div class="footer-links" ><?php wp_nav_menu('theme_location=secondary'); ?>  </div><?php } ?>
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
&copy; 2002-<?php echo date('Y'); ?> by FitnessWebsiteGurus.com, All rights reserved. </div>
<div class="designbymig">Designed by <h2>MIG</h2></div>
<? if (is_page( 'idea-world') || is_page( 'idea-world-thank-you')) {  ?>    <?php  } else { ?>  
<div class="social-icons">
<a class="facebook" href="#"></a>
<a class="twitter" href="#"></a>
</div>
<?php } ?>
</div>

		 
	</footer><!-- #colophon -->
 <!-- #page -->

<?php wp_footer(); ?>

</body>
</html>