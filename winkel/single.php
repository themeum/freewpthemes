<?php get_header(); ?>
    <?php get_template_part('lib/sub-header'); ?>
    <section id="main">
        <div class="container single-wrapper-content">
            <div class="row">
                <div id="content" class="post-box site-content col-md-12 blog-content-wrapper" role="main">
                    <?php if ( have_posts() ) :  ?> 
                        <?php while ( have_posts() ) : the_post(); ?>
                            <?php get_template_part( 'post-format/content', get_post_format() ); ?>   
                        <?php endwhile; ?>    
                    <?php else: ?>
                    <?php get_template_part( 'post-format/content', 'none' ); ?>
                    <?php endif; ?>
                    <div class="clearfix"></div>
                </div> <!-- #content -->
                <?php //get_sidebar( ); ?>
            </div> <!-- .row -->
        </div> <!-- .container -->
    </section> <!-- #main -->
<?php get_footer();