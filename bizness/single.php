<?php get_header(); 
$sidebarstyle = get_theme_mod('blog_single_sidebar', 'right'); 

if(get_theme_mod('sidebar_single', true)){
        $col = '8';
    }else{
        $col = '12';
    }

?>
    <section id="main">
    <?php get_template_part('lib/sub-header'); ?>
        <div class="container single-wrapper-content">
            <div class="row">
                <?php if($sidebarstyle == 'left' && get_theme_mod('sidebar_single', true)){
                    get_sidebar();
                } ?>
                <div id="content" class="site-content col-md-<?php echo $col; ?> blog-content-wrapper" role="main">
                    <?php if ( have_posts() ) :  ?> 
                        <?php while ( have_posts() ) : the_post(); ?>
                            <?php get_template_part( 'post-format/content', get_post_format() ); ?>   
                        <?php endwhile; ?>    
                    <?php else: ?>
                    <?php get_template_part( 'post-format/content', 'none' ); ?>
                    <?php endif; ?>
                    <div class="clearfix"></div>
                </div> <!-- #content -->
                <?php if($sidebarstyle == 'right' && get_theme_mod('sidebar_single', true)){
                    get_sidebar();
                } ?>
            </div> <!-- .row -->
        </div> <!-- .container -->
    </section> <!-- #main -->
<?php get_footer();