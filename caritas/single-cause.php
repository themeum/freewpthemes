<?php get_header();


?>
    <section id="main">
        <?php get_template_part('lib/sub-header'); ?>
        <div class="main-body-inner">
            <div class="container single-wrapper-content">
                <div class="row">
                    <div id="content" class="site-content col-12" role="main">
                        <?php if ( have_posts() ) :  ?>
                            <?php while ( have_posts() ) : the_post(); ?>
                                <?php get_template_part( 'post-format/content-cause', get_post_format() ); ?>
                            <?php endwhile; ?>
                        <?php else: ?>
                            <?php get_template_part( 'post-format/content', 'none' ); ?>
                        <?php endif; ?>
                        <div class="clearfix"></div>
                    </div> <!-- #content -->
                </div> <!-- .row -->
            </div> <!-- .container -->
        </div>
    </section> <!-- #main -->
<?php get_footer();