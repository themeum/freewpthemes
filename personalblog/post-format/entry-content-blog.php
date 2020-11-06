<!-- Single Page content -->
<div class="entry-content clearfix">
    <?php if ( is_single() ) { ?>
        <div class="single-entry-content">
            <?php the_content();?>
        </div>
    <?php } else {
         if ( get_theme_mod( 'blog_intro_en', true ) ) { 
            if ( get_theme_mod( 'blog_post_text_limit', 330 ) ) {
                $textlimit = get_theme_mod( 'blog_post_text_limit', 330 );
                echo personalblog_excerpt_max_charlength($textlimit);
            } else {
                echo  the_content();
            }
            if ( get_theme_mod( 'blog_continue_en', true ) ) { 
                if ( get_theme_mod( 'blog_continue', 'Continue reading...' ) ) {
                    $continue = esc_html( get_theme_mod( 'blog_continue', 'Continue reading...' ) );
                    echo '<div class="meta-content-limit"></div>';
                    echo '<p class="wrap-btn-style"><a class="btn btn-style" href="'.get_permalink().'">'. $continue .'</a></p>';

                } 
            }  
        } 
    } 
    wp_link_pages( array(
        'before'      => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'personalblog' ) . '</span>',
        'after'       => '</div>',
        'link_before' => '<span>',
        'link_after'  => '</span>',
    ) );
    ?>
    <div class="social-activities"> 
        <?php if ( is_single() ) { ?>
            <div class="single meta-content-limit"></div>
        <?php } ?>

        <?php if(get_theme_mod( 'blog_single_share', true ) ){

         get_template_part( 'post-format/social-buttons' );}

          ?>
        

        <?php if ( is_single() ) { ?>  
            <div class="post-content-wrapper-controller">   
                <div class="single-pre">
                    <?php previous_post_link('<span class="previous-post pull-left fa fa-angle-left">%link</span>',esc_html__("Previous Article",'personalblog')); ?>
                </div>

                <div class="single-next">
                    <?php next_post_link('<span class="next-post pull-right fa fa-angle-right">%link</span>',esc_html__("Next Article",'personalblog')); ?>
                </div>
            </div>
         <?php } ?>


    </div>
</div> <!-- //.entry-summary -->
