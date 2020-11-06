<div class="entry-summary clearfix">
    <?php 
    if ( is_single() ) {
        the_content();
    } else {
        if ( get_theme_mod( 'blog_intro_en', true ) ) { 
            if ( get_theme_mod( 'blog_post_text_limit', 220 ) ) {
                $textlimit = get_theme_mod( 'blog_post_text_limit', 220 );
                if (get_theme_mod( 'blog_intro_text_en', true )) {
                    echo melody_max_charlength( $textlimit, get_the_excerpt() );
                }
            } else {
                the_content();
            }
            if ( get_theme_mod( 'blog_continue_en', true ) ) { 
                if ( get_theme_mod( 'blog_continue', 'Read More' ) ) {
                    $continue = esc_html( get_theme_mod( 'blog_continue', 'Read More' ) );
                    echo '<p class="wrap-btn-style"><a class="btn btn-style" href="'.get_permalink().'">'. $continue .' <i class="fa fa-chevron-right" aria-hidden="true"></i></a></p>';
                } 
            }
            get_template_part( 'post-format/social-buttons' );
        }
    } 
    ?>
</div> <!-- //.entry-summary -->