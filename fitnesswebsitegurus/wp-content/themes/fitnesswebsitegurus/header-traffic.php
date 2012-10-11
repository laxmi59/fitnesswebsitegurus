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
<link rel="profile" href="http://gmpg.org/xfn/11" />
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
<script type="text/javascript" src="<?php bloginfo( 'template_url' ); ?>/js/validation.js"></script> 
</head>

<body <?php body_class(); ?>>
<header id="branding" role="banner">
			<hgroup>
				<h1 id="site-title"><span><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"></a></span></h1> 
				<div class="phone"></div>
				
				<?php while ( have_posts() ) : the_post(); ?>
					<div  class="traffic-content">
					<h1 class="entry-title"><?php the_title(); ?></h1> 
					
					<?php the_content(); ?>   
					</div> 
				<?php endwhile; // end of the loop. ?>
			 	<div class="getstarted-form  traffic-form"><div class="shadow"></div><div class="traffic-form-arrow"></div>
      <h2 class="traffic">GET A 100% FREE CONSULTATION By filling out this form, you can win a Mega Website Package ($997 Value)ABSOLUTELY FREE. </h2> 
	   <form name="contactForm" id="contactForm" onsubmit="return chkvalid();" action="/thanks/" method="post">
       <ul>
        <li class="name">
          <label>Name</label>
          <input type="text" name="FirstName" id="FirstName">
        </li>
        <li class="email">
          <label>Email Address</label>
          <input type="text" name="Email" id="Email">
        </li> 
        <li class="ph">
          <label>Phone Number</label>
		  <input type="text" onkeyup="validate_pphone(this.value,1,1); return numbersonly1(event, false,1)" style="width: 41px;" maxlength="3" value="<?=$_GET['pp1']?>" id="phone1" class="no1" name="pp1" />
                        -
                        <input type="text" onkeyup="validate_pphone(this.value,2,1);return numbersonly1(event, false,1)" style="width: 41px;" maxlength="3" value="<?=$_GET['pp2']?>" id="phone2" class="no1" name="pp2" />
                        -
                        <input type="text" onkeyup="return numbersonly1(event, false,1)" style="width: 47px;" maxlength="4" value="<?=$_GET['pp3']?>" id="phone3" class="no1" name="pp3" />
        </li> 
        <li>
          <input type="submit" name="button" id="button"  class="button mt15" value="Submit">
        </li>
      </ul>
	  </form>
    </div>  
			</hgroup> 
 
			<nav id="access" role="navigation">
				<h3 class="assistive-text"><?php _e( 'Main menu', 'twentyeleven' ); ?></h3>
				<?php /*  Allow screen readers / text browsers to skip the navigation menu and get right to the good stuff. */ ?>
				<div class="skip-link"><a class="assistive-text" href="#content" title="<?php esc_attr_e( 'Skip to primary content', 'twentyeleven' ); ?>"><?php _e( 'Skip to primary content', 'twentyeleven' ); ?></a></div>
				<div class="skip-link"><a class="assistive-text" href="#secondary" title="<?php esc_attr_e( 'Skip to secondary content', 'twentyeleven' ); ?>"><?php _e( 'Skip to secondary content', 'twentyeleven' ); ?></a></div>
				<?php /* Our navigation menu.  If one isn't filled out, wp_nav_menu falls back to wp_page_menu. The menu assiged to the primary position is the one used. If none is assigned, the menu with the lowest ID is used. */ ?>
				<?php wp_nav_menu( array( 'theme_location' => 'primary' ) ); ?>
			
			</nav><!-- #access -->
	</header><!-- #branding -->
<div class="site-image">
<div id="page" class="hfeed">
<div id="main"> 

