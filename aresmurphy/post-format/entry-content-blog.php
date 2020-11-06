<!-- Single Page content -->
<div class="entry-summary clearfix">
    <?php if ( is_single() ) {
        the_content();
    } else {
        if ( get_theme_mod( 'blog_intro_en', true ) ) { 
            if ( get_theme_mod( 'blog_post_text_limit', 280 ) ) {
                $textlimit = get_theme_mod( 'blog_post_text_limit', 280 );
                echo aresmurphy_excerpt_max_charlength($textlimit);
            } else {
                the_content();
            }
            if ( get_theme_mod( 'blog_continue_en', true ) ) { 
                if ( get_theme_mod( 'blog_continue', 'Read More' ) ) {
                    $continue = esc_html( get_theme_mod( 'blog_continue', 'Read More' ) );
                    echo '<p class="wrap-btn-style"><a class="btn btn-primary" href="'.get_permalink().'">'. $continue .'</a></p>';

                } 
            }  
        }    
    } 

    wp_link_pages( array(
        'before'      => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'aresmurphy' ) . '</span>',
        'after'       => '</div>',
        'link_before' => '<span>',
        'link_after'  => '</span>',
    ) );
    ?>

    <div class="entry-footer clearfix">
        <?php 
        if ( has_tag() ) {?>
            <div class="tags">
                <span><?php esc_html_e('Tag : ', 'aresmurphy') ?></span>
                <?php the_tags(' ',' '); ?>
            </div>
        <?php }?>
        <?php
            if ( get_theme_mod( 'blog_comment', true ) ) {
                if ( ! post_password_required() && ( comments_open() || get_comments_number() ) ){
                    echo '<div class="comment">'; ?>
                    <?php comments_popup_link( '<span class="leave-reply">' . esc_html__( 'Comment 0', 'aresmurphy' ) . '</span>', esc_html__( '1 Comment', 'aresmurphy' ), esc_html__( 'Comments %', 'aresmurphy' ) );
                    echo '</div>';
                }
            }
        ?>
        <!-- Social Buttons -->
        <?php get_template_part( 'post-format/social-buttons' ); ?>
    </div>

    <?php if ( is_single() ) { ?>
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
                            <a href="<?php echo get_permalink( $prev_post->ID ); ?>"><span class="previous-post"><i class="fa fa-long-arrow-left"></i> <?php esc_html_e("Previous",'aresmurphy'); ?></span><?php echo $prev_post->post_title ?></a>
                            <?php endif ?>
                        </div>

                        <div class="blog-post-review-next">
                            <?php
                            if (!empty( $next_post )): ?>
                            <a href="<?php echo get_permalink( $next_post->ID ); ?>"><span class="next-post"><?php esc_html_e("Next",'aresmurphy') ?> <i class="fa fa-long-arrow-right"></i></span><?php echo $next_post->post_title; ?></a>
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
            if ( get_theme_mod( 'blog_single_comment_en', true ) ) {
                if ( comments_open() || get_comments_number() ) {
                    comments_template();
                }
            }
        ?>
    <?php } ?>  

</div> <!-- //.entry-summary -->



