<?php get_header(); ?>
<section id="main">
    <?php get_template_part('lib/sub-header')?>
    <div class="container">
        <div class="row">
            <div id="content" class="site-content col-sm-9 blog-content-wrapper" role="main">
                <?php if ( have_posts() ) :  ?> 

                    <?php while ( have_posts() ) : the_post(); ?>
                
                        <?php get_template_part( 'post-format/content', get_post_format() ); ?>

                         <?php if ( get_theme_mod( 'post_nav_en', true ) ) { ?>

                            <div class="clearfix post-navigation">
                                <div class="single-pre">
                                <?php previous_post_link('<span class="previous-post pull-left fa fa-long-arrow-left">%link</span>',esc_html__("Previous",'starterpro')); ?>
                                </div>

                                <div class="single-next">
                                <?php next_post_link('<span class="next-post pull-right fa fa-long-arrow-right">%link</span>',esc_html__("Next",'starterpro')); ?>
                                </div>

                                <!-- Blog next/pre post -->
                                <div class="blog-post-review-content">  
                                    <div class="blog-post-review-pre">
                                        <?php 
                                            $prev_post = get_previous_post();
                                            if ( !empty( $prev_post ) ): 
                                            $post_thumbnail_id = get_post_thumbnail_id( $prev_post );
                                            if ( $post_thumbnail_id ) {
                                                $img = wp_get_attachment_image( $post_thumbnail_id, 'thumbnail', false);
                                                echo $img;
                                            }
                                        ?>
                                        <a href="<?php echo $prev_post->guid ?>"><?php echo $prev_post->post_title ?></a>
                                        <?php endif ?>
                                    </div>

                                    <div class="blog-post-review-next">
                                        <?php $next_post = get_next_post();
                                        if (!empty( $next_post )): ?>
                                        <a href="<?php echo get_permalink( $next_post->ID ); ?>"><?php echo $next_post->post_title; ?></a>
                                        <?php
                                            $post_thumbnail_id = get_post_thumbnail_id( $next_post );
                                            if ( $post_thumbnail_id ) {
                                                $img = wp_get_attachment_image( $post_thumbnail_id, 'thumbnail', false);
                                                echo $img;
                                            }
                                        ?>
                                        <?php endif; ?>
                                    </div>
                                </div>

                            </div> <!-- .post-navigation -->
                            
                        <?php } ?>  

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

                        <?php
                            if ( get_theme_mod( 'blog_single_comment_en', true ) ) {
                                if ( comments_open() || get_comments_number() ) {
                                    comments_template();
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