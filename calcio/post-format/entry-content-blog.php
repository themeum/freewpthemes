<!-- Single Page content -->
<div class="entry-summary clearfix">
    <?php if ( is_single() ) {
        the_content();
    }else {
             if ( get_theme_mod( 'blog_intro_en', true ) ) { 
                if ( get_theme_mod( 'blog_post_text_limit', 150 ) ) {
                    $textlimit = get_theme_mod( 'blog_post_text_limit', 150 );
                    echo calcio_excerpt_max_charlength($textlimit);
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
    } 
    wp_link_pages( array(
        'before'      => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'calcio' ) . '</span>',
        'after'       => '</div>',
        'link_before' => '<span>',
        'link_after'  => '</span>',
    ) );
?>
    
    <?php if ( is_single() ) { ?>
        <?php if ( get_theme_mod( 'blog_tags', true ) ) { ?>
            <?php if( has_tag() ){ ?>
                <div class="clearfix"></div>
                <div class="post-meta-info-list">
                    <i class="fa fa-tags"></i>
                    <?php the_tags(' ', ', ', '<br />'); ?>         
                </div>
            <?php } ?>
        <?php } ?>  

        <?php if(get_theme_mod( 'blog_single_share', false )){ ?>
            <div class="single-bottom-share">
                <?php get_template_part( 'post-format/social-buttons' ); ?>
            </div>
        <?php } ?>

    <?php } ?>

</div> <!-- .entry-summary -->