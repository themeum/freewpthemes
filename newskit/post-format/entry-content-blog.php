<!-- Single Page content -->
<div class="entry-summary clearfix">
    <?php 
        if ( is_single() ) {
            the_content();
        }
        wp_link_pages( array(
            'before'      => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'newskit' ) . '</span>',
            'after'       => '</div>',
            'link_before' => '<span>',
            'link_after'  => '</span>',
        ) );
    ?>
    <div class="single-social-share">
        <?php get_template_part( 'post-format/social-buttons' ); ?>
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
    } ?>

<div class="usehlhdkjs">
    <?php if ( get_theme_mod( 'blog_single_comment_en', true ) ) {
        if ( comments_open() || get_comments_number() ) {
            comments_template();
        }
    } ?>
</div>
