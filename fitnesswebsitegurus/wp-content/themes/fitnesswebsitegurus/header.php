<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package WordPress
 * @subpackage Twenty_Eleven
 * @since Twenty Eleven 1.0
 */
?><!DOCTYPE html>
<!--[if IE 6]>
<html id="ie6" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 7]>
<html id="ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html id="ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 6) | !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width" />
<title><?php
	/*
	 * Print the <title> tag based on what is being viewed.
	 */
	global $page, $paged;

	wp_title( '|', true, 'right' );

	// Add the blog name.
	bloginfo( 'name' );

	// Add the blog description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		echo " | $site_description";

	// Add a page number if necessary:
	if ( $paged >= 2 || $page >= 2 )
		echo ' | ' . sprintf( __( 'Page %s', 'twentyeleven' ), max( $paged, $page ) );

	?></title>
<link rel="profile" href="https://gmpg.org/xfn/11" />
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<!--[if lt IE 9]>
<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js" type="text/javascript"></script>
<![endif]-->
<?php
	/* We add some JavaScript to pages with the comment form
	 * to support sites with threaded comments (when in use).
	 */
	if ( is_singular() && get_option( 'thread_comments' ) )
		wp_enqueue_script( 'comment-reply' );

	/* Always have wp_head() just before the closing </head>
	 * tag of your theme, or you will break many plugins, which
	 * generally use this hook to add elements to <head> such
	 * as styles, scripts, and meta tags.
	 */
	wp_head();
?>
<script type="text/javascript" src="<?php bloginfo( 'template_url' ); ?>/js/jquery-1.4.2.min.js"></script>
<script type="text/javascript" src="<?php bloginfo( 'template_url' ); ?>/js/coin-slider.min.js"></script>
 <link rel="stylesheet" href="<?php bloginfo( 'template_url' ); ?>/coin-slider-styles.css" type="text/css" />


</head>

<body <?php body_class(); ?>>
<header id="branding" role="banner">
	<hgroup>
		<h1 id="site-title"><span><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"></a></span><span id="site-title1"><?php if (is_page( 'npti') || is_page( 'npti-thank-you') ){ ?><a href="http://www.nptifitness.com/"><img src="http://fitnesswebsitegurus.com/wp-content/uploads/2012/09/npti.png"><?php } ?></a></span></h1> 
		<? if (is_page( 'idea-world') || is_page( 'order') || is_page( 'idea-world-thank-you') ) {  ?> <div class="idea-world"></div> <?php  } else if(!is_page('partners') && !is_page('npti') && !is_page( 'npti-thank-you')) { ?><div class="phone"></div>  <?php } ?>
	<? if (is_page( 'idea-world') || is_page( 'partners') || is_page( 'order') ||  is_page( 'apps') || is_page( 'idea-world-thank-you') || is_page( 'npti') || is_page( 'npti-thank-you')) { echo ''; } else { ?>
		<div class="getstarted-form"><div class="shadow"></div>
      <h2>Get A Free Consultation </h2> 
      <h3>Fill out your information below and get a 100% free consultation </h3>
      <ul>
        <li class="name">
          <label>Name</label>
          <input type="text" name="textfield" id="textfield">
        </li>
        <li class="email">
          <label>Email Address</label>
          <input type="text" name="textfield2" id="textfield2">
        </li> 
        <li class="ph">
          <label>Phone Number</label>
          <input type="text" name="textfield4" id="textfield4" class="no1">  <input type="text" name="textfield5" id="textfield5" class="no2">  <input type="text" name="textfield3" id="textfield3" class="no3">
        </li> 
        <li>
          <input type="submit" name="button" id="button"  class="button" value="Submit">
        </li>
      </ul>
    </div>  <?}?> 
			</hgroup> 
 <? if (is_page( 'idea-world') || is_page( 'partners') || is_page( 'npti') || is_page( 'npti-thank-you') || is_page( 'order') || is_page( 'idea-world-thank-you') ) {  ?>    <?php  } else { ?> 
 
			<nav id="access" role="navigation">
				<h3 class="assistive-text"><?php _e( 'Main menu', 'twentyeleven' ); ?></h3>
				<?php /*  Allow screen readers / text browsers to skip the navigation menu and get right to the good stuff. */ ?>
				<div class="skip-link"><a class="assistive-text" href="#content" title="<?php esc_attr_e( 'Skip to primary content', 'twentyeleven' ); ?>"><?php _e( 'Skip to primary content', 'twentyeleven' ); ?></a></div>
				<div class="skip-link"><a class="assistive-text" href="#secondary" title="<?php esc_attr_e( 'Skip to secondary content', 'twentyeleven' ); ?>"><?php _e( 'Skip to secondary content', 'twentyeleven' ); ?></a></div>
				<?php /* Our navigation menu.  If one isn't filled out, wp_nav_menu falls back to wp_page_menu. The menu assiged to the primary position is the one used. If none is assigned, the menu with the lowest ID is used. */ ?>
				<?php wp_nav_menu( array( 'theme_location' => 'primary' ) ); ?>
			
			</nav><!-- #access -->
            <?php } ?>
	</header><!-- #branding -->
<div class="site-image">
<div id="page" class="hfeed">
<div id="main">
<?php if(is_front_page()){ ?>
<div class="banner-form">
  <div class="banner-form-area">
    <div class="banner-area">
      <div id="coin-slider"> 
        <a href="#"> <img src="<?php bloginfo( 'template_url' ); ?>/images/slide1.png" alt="1.5 Million People Each Month Are Searching For A Personal Trainer" style="width:631px;height:342px;"  /> </a> <a href="#"> <img src="<?php bloginfo( 'template_url' ); ?>/images/slide2.png" alt="Potential Clients Will Judge You Based On Your Website" style="width:631px;height:342px;" /> </a> <a href="#"> <img src="<?php bloginfo( 'template_url' ); ?>/images/slide3.png" alt="Do It the Right Way and let the Fitness Website Gurus Do It For You!" style="width:631px;height:342px;" /> </a> </div>
    </div>
     
    <script type="text/javascript">
	    $(document).ready(function() {
	        $('#coin-slider').coinslider({ width: 631, height:332,  navigation: true, delay: 10000 });
	    });
	</script>
  </div>
</div>
<?php } ?>
