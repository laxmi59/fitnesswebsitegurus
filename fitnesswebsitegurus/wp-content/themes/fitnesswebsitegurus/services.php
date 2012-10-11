<?php
/**
 * Template Name: 	services
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
 
get_header();  
get_sidebar(); ?>

<div id="primary">
  <div id="content" role="main" class="services">
  			<div class="gray-corner topLeft"></div>
                <div class="gray-corner topRight"></div>
                <div class="gray-corner bottomLeft"></div>
                <div class="gray-corner bottomRight"></div> 
    <header class="entry-header">
      <h1 class="entry-title">
        <?php the_title(); ?>
      </h1>
    </header>
    <!-- .entry-header -->
    <ul>
      <li>
        <h2><img src="<?php bloginfo( 'template_url' ); ?>/images/cwd-image.png" class="f-right" /><img src="<?php bloginfo( 'template_url' ); ?>/images/cwd-icon.png" class="f-left" /> Custom Web Design </h2>
        
        <p> <span>Our team</span> consists of some of the most talented and creative web designers out there. Our methods are guaranteed to improve your image and get people to take notice. We always strive to be innovators, and that's why you do not have to worry about your website being drab or mundane. Whatever you can imagine, we can design. It's that simple with Fitness Website Gurus.</p>
      </li>
      <li>
        <h2><img src="<?php bloginfo( 'template_url' ); ?>/images/tmp-image.png" class="f-right" /><img src="<?php bloginfo( 'template_url' ); ?>/images/tmp-icon.png" class="f-left" /> Templates </h2>
        
        <p> <span>No matter what website style you require, </span> we can craft a basic, conversion-oriented template and take it from there. So don&rsquo;t hesitate, get in touch with us today and see how we can assist you with all of  your website needs, all you need to do is add your own personal content and you're ready to jump start your own website! 
      </li>
      <li>
        <h2><img src="<?php bloginfo( 'template_url' ); ?>/images/wd-image.png" class="f-right" /><img src="<?php bloginfo( 'template_url' ); ?>/images/wd-icon.png" class="f-left" /> Web Development </h2>
        
        <p> <span>Design is important, </span> but without a strong backbone, it&rsquo;s merely eye candy. Web development is that backbone. From widgets to flash integration, our goal is to make things functional and reliable so that your website&rsquo;s visitors are happy. A poorly developed webpage just smacks of unprofessionalism, and that&rsquo;s the last thing you want. Our staff has extensive experience and has worked on countless projects, as our testimonials attest to. With us, you&rsquo;re in good hands.
        <ul>
          <li> E-commerce solutions</li>
          <li> Customer reviews/testimonials</li>
          <li> Customer opt-in measures</li>
          <li> Widgets</li>
          <li> Flash integration</li>
        </ul>
      </li>
      <li>
        <h2><img src="<?php bloginfo( 'template_url' ); ?>/images/mrk-image.png" class="f-right" /><img src="<?php bloginfo( 'template_url' ); ?>/images/mrk-icon.png" class="f-left" /> Marketing </h2>
        
        <p> <span> We want to get your name out there </span> by establishing your brand and vastly increasing your company&rsquo;s web presence.  To do so, we use effective techniques such as advanced search engine optimization (SEO), which will consistently generate hits for your website.
      </li>
    </ul>
  </div>
  <!-- #content -->
</div>
<!-- #primary -->
<?php get_footer(); ?>
