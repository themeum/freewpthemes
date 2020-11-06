<!-- Single Page content -->
<div class="entry-summary clearfix">
    <?php if ( is_single() ) {
        the_content();
    } else {
        if ( get_theme_mod( 'blog_intro_en', true ) ) { 
            if ( get_theme_mod( 'blog_post_text_limit', 280 ) ) {
                $textlimit = get_theme_mod( 'blog_post_text_limit', 280 );
                echo starterpro_excerpt_max_charlength($textlimit);
            } else {
                the_content();
            }
            if ( get_theme_mod( 'blog_continue_en', true ) ) { 
                if ( get_theme_mod( 'blog_continue', 'Read More' ) ) {
                    $continue = esc_html( get_theme_mod( 'blog_continue', 'Read More' ) );
                    echo '<p class="wrap-btn-style"><a class="btn btn-style" href="'.get_permalink().'">'. $continue .'</a></p>';

                } 
            }  
        }    
        # blog comments
        if ( get_theme_mod( 'blog_comment', true ) ) {
            if ( ! post_password_required() && ( comments_open() || get_comments_number() ) ){
                echo '<p class="meta-comment">';
                echo '<i class="fa fa-comment-o" aria-hidden="true"></i>'; ?>
                <?php comments_popup_link( '<span class="leave-reply">' . esc_html__( '0', 'starterpro' ) . '</span>', esc_html__( '1', 'starterpro' ), esc_html__( '%', 'starterpro' ) );
                echo '</p>';
            }
        }

        # blog Count Down
        if ( get_theme_mod( 'blog_hit', true ) ) {
            # Blog Count Down
            $visitor_count = get_post_meta( $post->ID, '_post_views_count', true);
            if( $visitor_count == '' ){ $visitor_count = 0; }
            if( $visitor_count >= 1000 ){
                $visitor_count = round( ($visitor_count/1000), 2 );
                $visitor_count = $visitor_count.'k';
            }

            echo '<p class="view-count">';
            echo '<i class="fa fa-heart-o" aria-hidden="true"></i>'; ?>
            <?php echo esc_attr( $visitor_count ); 
            echo '</p>'; 
        }
    } 

    wp_link_pages( array(
        'before'      => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'starterpro' ) . '</span>',
        'after'       => '</div>',
        'link_before' => '<span>',
        'link_after'  => '</span>',
    ) );
    ?>

    <div class="social-activities">
        <?php if ( is_single() ) {?>
            <?php if ( get_theme_mod( 'blog_tags', true ) ) { ?>
                    <?php if( the_tags() ) { ?>
                    <div class="post-meta-info-list-in tags-in">
                    <i class="fa fa-tags"></i>
                        <?php the_tags(' ', ', ', '<br />'); ?>
                    </div>
                <?php } ?>    
            <?php } ?> 

            <!-- Social Buttons -->

            <?php 
                if( get_theme_mod( 'blog_social_share', true )){
                    get_template_part( 'post-format/social-buttons' ); 
              
                } ?>


            <?php
                # blog Count Down
                if ( get_theme_mod( 'blog_hit', true ) ) {
                    $visitor_count = get_post_meta( $post->ID, '_post_views_count', true);
                    if( $visitor_count == '' ){ $visitor_count = 0; }
                    if( $visitor_count >= 1000 ){
                        $visitor_count = round( ($visitor_count/1000), 2 );
                        $visitor_count = $visitor_count.'k';
                    }

                    echo '<p class="view-count">';
                    echo '<i class="fa fa-heart-o" aria-hidden="true"></i>'; ?>
                    <?php echo esc_attr( $visitor_count ); 
                    echo '</p>';
                }
            ?>

        <?php } ?> 
    </div>
</div> <!-- //.entry-summary -->
<div class="entry-content-border"></div>



