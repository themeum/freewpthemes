<!-- Single Page content -->
<div class="entry-summary clearfix">
    <?php 
        if ( is_single() ) {
            the_content();
        }
        wp_link_pages( array(
            'before'      => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'rhino' ) . '</span>',
            'after'       => '</div>',
            'link_before' => '<span>',
            'link_after'  => '</span>',
        ) );

        get_template_part( 'post-format/social-buttons' );
    ?>
</div> <!-- //.entry-summary -->

<?php if ( is_single() ) { ?>  
    <div class="post-controller row">   
        <div class="single-pre col-6">
            <?php previous_post_link('<span class="previous-post pull-left fa fa-angle-left">%link</span>',esc_html__("Prev",'rhino')); ?>
        </div>

        <div class="single-next col-6">
            <?php next_post_link('<span class="next-post pull-right fa fa-angle-right">%link</span>',esc_html__("Next",'rhino')); ?>
        </div>
    </div>
 <?php } ?>

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

<div class="post-comment-area">
    
<?php    if ( get_theme_mod( 'blog_single_comment_en', true ) ) {
        if ( comments_open() || get_comments_number() ) {
            comments_template();
        }
    } ?>
</div>


    <?php
?>