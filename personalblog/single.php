<?php get_header(); ?>
<div class="container">
    <div class="row">
        <?php 
            if (isset( $_REQUEST['single-layout'])) {
              $singlelayout = esc_attr($_REQUEST['single-layout']);
            }else {
                $singlelayout = get_theme_mod( 'single_page_style', 'leftside' ); 
            }?>

            <?php if ( $singlelayout != 'fullwidth' ) { ?>
                <?php if ( $singlelayout == 'leftside' ) { ?>
                <div class="col-sm-8  pull-right">
                <?php } else{ ?>
                <div class="col-sm-8">
                <?php } ?>
                <?php if ( $singlelayout == 'rightside' ) { ?>
                <div class="content-grid right-side">
                <?php } else { ?>
                    <div class="content-grid">
                <?php }?>

            <?php } ?>

            <?php if ( $singlelayout == 'fullwidth' ) { ?>
                <div class="col-sm-12 col-md-8 col-md-offset-2"> 
                <?php } ?>

                <?php get_template_part('lib/header-content'); ?>
                <div id="content" class="site-content blog-content-wrapper" role="main">
                    <?php if ( have_posts() ) :  ?> 
                        <?php while ( have_posts() ) : the_post(); ?>
                            <?php get_template_part( 'post-format/content', get_post_format() ); ?>

                            <!-- User Information -->
                            <?php get_template_part( 'lib/user-profile' ); ?>
                            <?php get_template_part( 'lib/related-post' ); ?>
                            
                    <!-- Related Post end -->      
                    <?php
                        if ( comments_open() || get_comments_number() ) {
                            comments_template();
                        }
                    ?>
                    <?php endwhile; ?>    
                    <?php else: ?>
                    <?php get_template_part( 'post-format/content', 'none' ); ?>
                    <?php endif; ?>
                    <div class="clearfix"></div>
                </div> <!-- #content -->
            <?php if ( $singlelayout != 'fullwidth' ) { ?>
                </div> <!-- .content-grid -->
            <?php }?>
        </div> <!-- .col-sm-8 -->
        <?php if ( $singlelayout != 'fullwidth' ) { ?>
            <div id="sidebar" class="col-sm-4" role="complementary">
                <?php if ( $singlelayout == 'leftside' ) { ?>
                <aside class="widget-area">
                <?php } else { ?>
                <aside class="widget-area right-side">
                    <?php } ?>
                    <?php get_sidebar( );?> 
                </aside>
            </div> <!-- #sidebar -->
        <?php }?>    
    </div> <!-- .row -->
</div> <!-- .container -->
<?php get_footer(); ?>

