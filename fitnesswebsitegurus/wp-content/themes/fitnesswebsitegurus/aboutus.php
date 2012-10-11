<?php
/**
 * Template Name: 	aboutus
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
  <div id="content" role="main" class="aboutus">
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
    <img src="<?php bloginfo( 'template_url' ); ?>/images/about-quote-image.png" style='margin: auto; display: block;'  />
    <ul>
     <li class="about-quote1">
    <p>Are you a personal trainer that has fallen on tough times because of today's sagging economy?</p>
      </li>
      <li>
         <img src="<?php bloginfo( 'template_url' ); ?>/images/about-image.png" class="f-left mr10" />    
        
        <p> <span>Or maybe</span> 	    you're simply looking to expand your business and give yourself a competitive edge in a high demand field?  Look no further.  We at Fitness Website Gurus can get your name out there, where it needs to be.  Over 1.5 million million people each month are searching diligently for personal trainers.  The problem is, most personal trainers don't have  the  proper  marketing  campaign  in  place, which is why you stand to benefit a great deal by associating with Fitness Website Gurus.  For each client, our team of web development experts executes a multi-phase planning process, designs a custom website suited for your business, and then puts those ideas into effect in a big way.</p> 
      </li>
      <li>
     <img src="<?php bloginfo( 'template_url' ); ?>/images/about-image2.png" class="f-right" />  
        
        <p><span>What good</span> is having a fitness website with all the bells and whistles if it can't be found easily online and if no one visits it. We address this problem by using the latest and most innovative search engine optimization techniques that we seamlessly integrate into your website. If they somehow do visit your site, what then do you want them to do? Do u want them to just surf through your website as if there just browsing or window shopping, or do you want them, to not only be impressed by your website, but would you not rather they more importantly are lead to take the action of converting them from merely just a visitor but to an actual paying client. Our websites are specifically designed to convert web traffic into leads, leads into new clients, and clients into revenue. We help you succeed, grow your business, and make money. We offer Professionally designed and developed websites custom tailored for your industry. Its the Best Solution at the Best Price. At fitness website guru's your online success is our business. Get started today.</p>
 
      </li> 
      <li class="about-quote2">
     <p>No matter what content you provide us, we can make your website professional and sleek, with a streamlined interface and navigable links.</p>
      </li>
    </ul>
     <img src="<?php bloginfo( 'template_url' ); ?>/images/about-quote-image2.png" style="display: block; margin: -34px auto 0; "    />
  </div>
  <!-- #content -->
</div>
<!-- #primary -->
<?php get_footer(); ?>
