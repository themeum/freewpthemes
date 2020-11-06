<!-- Single Page content -->
<div class="entry-summary clearfix">
    <?php 
        if ( is_single() ) {
            the_content();
        }
        wp_link_pages( array(
            'before'      => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'wpestate' ) . '</span>',
            'after'       => '</div>',
            'link_before' => '<span>',
            'link_after'  => '</span>',
        ) );
    ?>
    <div class="post-share-tag">
        <?php if(get_the_tag_list()) :?>
        <div class="d-inline-block">
            <div class="post-single-tag">
                <strong><?php echo esc_html__('Tags:', 'wpestate') ?></strong>
                <?php echo get_the_tag_list(' ',''); ?>
            </div>
        </div>
        <?php endif; ?>

        <?php if(function_exists('wpestate_social_share') && get_theme_mod('blog_social_share', false)) : ?>
        <div class="d-inline-block float-right">
            <?php echo wpestate_social_share(); ?>
        </div>
        <?php endif; ?>
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

<div class="post-comment-area">
    
<?php    if ( get_theme_mod( 'blog_single_comment_en', true ) ) {
        if ( comments_open() || get_comments_number() ) {
            comments_template();
        }
    } ?>
</div>