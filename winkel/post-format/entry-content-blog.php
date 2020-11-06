<!-- Single Page content -->
<div class="entry-summary clearfix">
    <?php 
        if ( is_single() ) {
            the_content();
        }
        wp_link_pages( array(
            'before'      => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'winkel' ) . '</span>',
            'after'       => '</div>',
            'link_before' => '<span>',
            'link_after'  => '</span>',
        ) );
    ?>
</div> <!-- //.entry-summary -->

 <?php
    if ( is_singular( 'post' ) ){
        $count_post = esc_attr( get_post_meta( $post->ID, '_post_views_count', true) );
        if( $count_post == ''){
            $count_post = 1;
            add_post_meta( $post->ID, '_post_views_count', $count_post);
        }else{
            $count_post = (int)$count_post + 1;
            update_post_meta( $post->ID, '_post_views_count', $count_post);
        }
    } ?>

    <?php if ( is_single() ) { ?>  
        <div class="post-content-wrapper-controller">   
            <div class="single-pre">
                <?php previous_post_link('<span class="previous-post pull-left">%link</span>',esc_html__("PREV",'winkel')); ?>
            </div>

            <div class="single-next">
                <?php next_post_link('<span class="next-post pull-right">%link</span>',esc_html__("NEXT",'winkel')); ?>
            </div>
        </div>
    <?php } ?>


<div class="usehlhdkjs">
    
<?php    if ( get_theme_mod( 'blog_single_comment_en', true ) ) {
        if ( comments_open() || get_comments_number() ) {
            comments_template();
        }
    } ?>
</div>
