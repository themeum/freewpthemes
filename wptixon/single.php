<?php get_header(); ?>
<section id="main">
    <?php get_template_part('lib/sub-header')?>
    <div class="container">
        <div class="row">
            <div id="content" class="site-content col-sm-12 blog-content-wrapper" role="main">
                <?php if ( have_posts() ) :  ?> 

                    <?php while ( have_posts() ) : the_post(); ?>
                
                        <?php get_template_part( 'post-format/content', get_post_format() ); ?>

                         <?php if ( get_theme_mod( 'post_nav_en', true ) ) { ?>

                            <div class="clearfix post-navigation">
                                
                                <?php
                                    $prev_post = get_previous_post();
                                    $next_post = get_next_post();
                                ?>

                                <?php if ( !empty( $prev_post ) || !empty( $next_post ) ): ?>
                                    <!-- Blog next/pre post -->
                                    <div class="blog-post-review-content clearfix">  
                                        <div class="blog-post-review-pre">
                                            <?php 
                                                
                                                if ( !empty( $prev_post ) ): 
                                                $post_thumbnail_id = get_post_thumbnail_id( $prev_post );
                                                if ( $post_thumbnail_id ) {
                                                    $img = wp_get_attachment_image( $post_thumbnail_id, 'thumbnail', false);
                                                    echo $img;
                                                }
                                            ?>
                                            <a href="<?php echo get_permalink( $prev_post->ID ); ?>"><span class="previous-post pull-left"><i class="fa fa-long-arrow-left"></i> <?php esc_html_e("Previous",'wptixon'); ?></span><br /><?php echo $prev_post->post_title ?></a>
                                            <?php endif ?>
                                        </div>

                                        <div class="blog-post-review-next">
                                            <?php
                                            if (!empty( $next_post )): ?>
                                            <a href="<?php echo get_permalink( $next_post->ID ); ?>"><span class="next-post pull-right"><?php esc_html_e("Next",'wptixon') ?> <i class="fa fa-long-arrow-right"></i></span><br /><?php echo $next_post->post_title; ?></a>
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
                                <?php endif; ?>

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
            <?php //get_sidebar(); ?>
        </div> <!-- .row -->
        </div> <!-- .container -->
    </section> <!-- #main -->

<?php get_footer();