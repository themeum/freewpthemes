<?php get_header(); ?>

<?php get_template_part('lib/sub-header')?>
<section id="main" class="generic-padding">
    <div class="container">
        <?php
            $enable_sidebar = get_theme_mod('blog_sidebar', true);
            $active_sidebar = is_active_sidebar( 'sidebar' );
        ?>
            <div class="row">
                <?php if($active_sidebar) { ?>
                <div id="content" class="site-content col-md-<?php echo esc_attr($enable_sidebar ? '8' : '12'); ?>" role="main">
                <?php } else{?>
                <div id="content" class="site-content col-md-<?php echo esc_attr($enable_sidebar ? '12' : '12'); ?>" role="main">
                <?php }?>
                    <div class="row">
                        <?php
                        if ( have_posts() ) {
                            while ( have_posts() ) : the_post(); ?>
                                <div class="separator-wrapper col-md-<?php echo esc_attr(get_theme_mod( 'blog_column', 12 ));?>">
                                    <?php get_template_part( 'post-format/content', get_post_format() ); ?>
                                </div>
                            <?php
                            endwhile;
                            echo "<div class='col-12 text-center'>".get_the_posts_pagination(array(
                                'mid_size' => 2,
                                'prev_text' => __( '<i class="fa fa-angle-left"></i>', 'wpestate' ),
                                'next_text' => __( '<i class="fa fa-angle-right"></i>', 'wpestate' )
                            ))."</div>";
                        } else {
                            get_template_part( 'post-format/content', 'none' );
                        }
                        ?>
                    </div>
                </div><!-- content//column -->
                <?php if($enable_sidebar) get_sidebar(); ?>
            </div> <!--row-->
    </div> <!-- .container --> 
</section> <!-- #main -->

<?php get_footer();