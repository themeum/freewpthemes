<?php get_header(); 
if(get_theme_mod('sidebar_single', true)){
        $col = '8';
    }else{
        $col = '12';
    }
?>
    <section id="main">
        <?php if(has_post_thumbnail()) : ?>
        <div class="blog-single-top-img text-center">
            <?php the_post_thumbnail(); ?>
        </div>
        <?php endif; ?>
        
        <div class="container single-wrapper-content">
            <div class="row">
                <div id="content" class="site-content col-md-<?php echo esc_attr($col); ?> blog-content-wrapper" role="main">
                    <?php if ( have_posts() ) :  ?> 
                        <?php while ( have_posts() ) : the_post(); ?>
                            <?php get_template_part( 'post-format/content', get_post_format() ); ?>   
                        <?php endwhile; ?>    
                    <?php else: ?>
                    <?php get_template_part( 'post-format/content', 'none' ); ?>
                    <?php endif; ?>
                    <div class="clearfix"></div>
                </div> <!-- #content -->
                <?php if(get_theme_mod('sidebar_single', true)){
                    get_sidebar();
                } ?>
            </div> <!-- .row -->
        </div> <!-- .container -->
    </section> <!-- #main -->
<?php get_footer();