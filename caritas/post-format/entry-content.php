<div class="entry-summary clearfix">
    <?php 
    if ( is_single() ) {
        ?>
            <div class="entry-summary clearfix">
                <?php
                the_content();
                wp_link_pages( array(
                    'before'      => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'caritas' ) . '</span>',
                    'after'       => '</div>',
                    'link_before' => '<span>',
                    'link_after'  => '</span>',
                ) );

                echo get_the_tag_list('<div class="entry_tags">', '', '</div>');
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
                    echo caritas_excerpt_max_charlength($textlimit);
                }
            } else {
                the_content();
            }
            
        }
    } 
    ?>
</div> <!-- //.entry-summary -->