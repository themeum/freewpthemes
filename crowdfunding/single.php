<?php get_header(); 
global $themeum_options;
?>
<div id="content" class="site-content" role="main">
    <?php if ( have_posts() ) :  ?> 
        <?php while ( have_posts() ) : the_post(); ?>
            <?php get_template_part( 'post-format/content', get_post_format() ); ?>
            <div class="container">
                <div class="entry-summary">
                    <?php if ( is_single() ) {
                        the_content();
                    }
                    wp_link_pages( array(
                        'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'crowdfunding' ) . '</span>',
                        'after'       => '</div>',
                        'link_before' => '<span>',
                        'link_after'  => '</span>',
                    ) ); ?>
                </div> <!-- //.entry-summary -->
                <?php  if (isset($themeum_options['blog-social']) && $themeum_options['blog-social'] ){
                        if(is_single()) {
                            get_template_part( 'post-format/social-buttons' );
                    }
                } ?>
                <?php get_template_part( 'post-format/user-profile' ); ?> 
                <?php
                    if ( comments_open() || get_comments_number() ) {
                        if ( isset($themeum_options['blog-single-comment-en']) && $themeum_options['blog-single-comment-en'] ) {
                           comments_template();
                        }
                    }
                ?>
            </div>
        <?php endwhile; ?>
    <?php else: ?>
        <?php get_template_part( 'post-format/content', 'none' ); ?>
    <?php endif; ?>
    <div class="clearfix"></div>
</div>

<?php get_footer();