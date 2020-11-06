<?php get_header(); ?>

<section id="main">
    <?php if ( have_posts() ) :  ?> 
        <?php while ( have_posts() ) : the_post(); ?>
            <?php get_template_part( 'post-format/content', get_post_format() ); ?>  
        <?php endwhile; ?> 
    <?php else: ?>
        <?php get_template_part( 'post-format/content', 'none' ); ?>
    <?php endif; ?>
    <div class="clearfix"></div>

	<!-- Related post -->
	<?php get_template_part( 'lib/related-post', 'none' ); ?>
    
	<!-- Short enable/ Instragram or mailchimp -->
	<?php get_template_part( 'lib/gutenwp-shortcode', 'none' ); ?>
	
</section> <!-- .container -->
<?php get_footer();