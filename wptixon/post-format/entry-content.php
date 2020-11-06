<div class="entry-summary clearfix">
    <?php if ( is_single() ) {
        the_content();
    } else {
        if ( get_theme_mod( 'blog_intro_en', true ) ) { 
            if ( get_theme_mod( 'blog_post_text_limit', 280 ) ) {
                $textlimit = get_theme_mod( 'blog_post_text_limit', 280 );
                echo wptixon_excerpt_max_charlength($textlimit);
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
    ?>

</div> <!-- //.entry-summary -->