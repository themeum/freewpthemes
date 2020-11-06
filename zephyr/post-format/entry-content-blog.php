<!-- Single Page content -->
<div class="entry-summary clearfix">
    <?php 
        if ( is_single() ) {
            the_content();
        }
        wp_link_pages( array(
            'before'      => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'zephyr' ) . '</span>',
            'after'       => '</div>',
            'link_before' => '<span>',
            'link_after'  => '</span>',
        ) ); 

        # Blog Count Down
        $visitor_count = get_post_meta( $post->ID, '_post_views_count', true);
        if( $visitor_count == '' ){ $visitor_count = 0; }
        if( $visitor_count >= 1000 ){
            $visitor_count = round( ($visitor_count/1000), 2 );
            $visitor_count = $visitor_count.'k';
        } ?>

        

    
        <div class="single-social-share row">
            <div class="col-md-6"><?php get_template_part( 'post-format/social-buttons' ); ?></div>
            <div class="col-md-6">
                <span class="view-count"><i class="fa fa-heart" aria-hidden="true"></i>
                <?php echo esc_attr( $visitor_count ); ?>
                </span>
            </div>
        </div>



        
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
    }
?>

<div class="blog-comments-section">
    
<?php    if ( get_theme_mod( 'blog_single_comment_en', true ) ) {
        if ( comments_open() || get_comments_number() ) {
            comments_template();
        }
    } ?>
</div>


    <?php
?>