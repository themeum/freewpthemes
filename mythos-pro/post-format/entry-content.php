<div class="entry-summary clearfix">
    <?php 
        if ( is_single() ) {
            the_content();
        } else {
            if ( get_theme_mod( 'blog_intro_en', true ) ) { 
                if ( get_theme_mod( 'blog_post_text_limit', 220 ) ) {
                    $textlimit = get_theme_mod( 'blog_post_text_limit', 220 );
                    if (get_theme_mod( 'blog_intro_text_en', true )) {
                        echo wp_kses_post(mythos_excerpt_max_charlength($textlimit));
                    }
                } else {
                    the_content();
                }
                if ( get_theme_mod( 'blog_continue_en', true ) ) { 
                    if ( get_theme_mod( 'blog_continue', 'Read More' ) ) {
                        $continue = esc_html( get_theme_mod( 'blog_continue', 'Read More' ) );
                        echo '<p class="wrap-btn-style"><a class="btn btn-style" href="'.esc_url(get_permalink()).'">'. esc_html($continue) .' <i class="fas fa-long-arrow-alt-right"></i></a></p>';
                    } 
                }
                
            }
        } 
    ?>
</div> <!-- //.entry-summary -->