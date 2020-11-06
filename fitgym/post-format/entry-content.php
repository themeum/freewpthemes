<div class="entry-summary clearfix">
    <?php 
    if ( is_single() ) {
        ?>
            <div class="entry-summary clearfix">
                <?php
                the_content();
                wp_link_pages( array(
                    'before'      => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'fitgym' ) . '</span>',
                    'after'       => '</div>',
                    'link_before' => '<span>',
                    'link_after'  => '</span>',
                ) );

                get_template_part( 'post-format/social-buttons' );
                ?>
            </div> <!-- //.entry-summary -->
            <div class="usehlhdkjs">

                <?php    if ( get_theme_mod( 'blog_single_comment_en', true ) ) {
                    if ( comments_open() || get_comments_number() ) {
                        comments_template();
                    }
                } ?>
            </div>
        <?php
    } else {
        if ( get_theme_mod( 'blog_intro_en', true ) ) { 
            if ( get_theme_mod( 'blog_post_text_limit', 220 ) ) {
                $textlimit = get_theme_mod( 'blog_post_text_limit', 220 );
                if (get_theme_mod( 'blog_intro_text_en', true )) {
                    echo fitgym_excerpt_max_charlength($textlimit);
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