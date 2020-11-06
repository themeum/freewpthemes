<?php get_header(); ?>
<section id="main">
   <?php  if ( get_theme_mod( 'disable_sub_header', true ) ) {
       get_template_part('lib/sub-header');
    }?>
    <div class="container">
        <div class="row">
            <div id="content" class="site-content col-sm-9 blog-content-single" role="main">
                <?php if ( have_posts() ) :  ?> 

                    <?php while ( have_posts() ) : the_post(); ?>
                        <?php get_template_part( 'post-format/content', get_post_format() ); ?>
                        <?php
                            if ( is_singular( 'post' ) ){
                                $count_post = esc_attr( get_post_meta( $post->ID, '_post_views_count', true) );
                                if( $count_post == ''){
                                    $count_post = 1;
                                    add_post_meta( $post->ID, '_post_views_count', $count_post);
                                }else{
                                    $count_post = (int)$count_post + 1;
                                    update_post_meta( $post->ID, '_post_views_count', $count_post);
                                }
                            }
                        ?>
                <?php endwhile; ?>    
                <?php else: ?>
                <?php get_template_part( 'post-format/content', 'none' ); ?>
                <?php endif; ?>

                <div class="clearfix"></div>
            </div> <!-- #content -->
            <?php get_sidebar(); ?>
        </div> <!-- .row -->
        </div> <!-- .container -->
    </section> <!-- #main -->

<?php get_footer();