<div class="entry-summary clearfix">
    <?php 
    if ( is_single() ) {
        the_content();
    } else {
        if ( get_theme_mod( 'blog_intro_en', true ) ) { 
            if ( get_theme_mod( 'blog_post_text_limit', 150 ) ) {
                $textlimit = get_theme_mod( 'blog_post_text_limit', 150 );
                if (get_theme_mod( 'blog_intro_text_en', true )) {
                    echo rhino_excerpt_max_charlength($textlimit);
                }
            } else {
                the_content();
            }
            if ( get_theme_mod( 'blog_continue_en', true ) ) { 
                if ( get_theme_mod( 'blog_continue', 'Read More' ) ) {
                    $continue = esc_html( get_theme_mod( 'blog_continue', 'Read More' ) );
                    echo '<p class="wrap-btn-style"><a class="btn btn-style" href="'.get_permalink().'">'. $continue .' <i class="fa fa-long-arrow-right" aria-hidden="true"></i></a></p>';
                } 
            }
            
        }
    } 
    ?>
</div> <!-- //.entry-summary -->