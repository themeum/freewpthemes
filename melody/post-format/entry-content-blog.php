<!-- Single Page content -->
<div class="entry-summary clearfix">
    <?php 
        if ( is_single() ) {
            the_content();
        }
        wp_link_pages( array(
            'before'      => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'melody' ) . '</span>',
            'after'       => '</div>',
            'link_before' => '<span>',
            'link_after'  => '</span>',
        ) );
    ?>
</div> <!-- //.entry-summary -->
<div class="row single-social-share">
    
    <?php if ( get_theme_mod( 'blog_tags_single', true ) && get_the_tag_list() ) { ?>
        <div class="col-md-7 single-tag">
            <?php echo get_the_tag_list(); ?>
        </div>
    <?php } ?>
    <div class="col-md-5 text-md-right">
        <span class="d-inline-block single-share-text"><?php echo esc_attr__( 'Share', 'melody' ); ?></span>
        <span class="d-inline-block"><?php get_template_part( 'post-format/social-buttons' ); ?></span>
    </div>
</div>

<?php if ( is_single() ) { ?>
    <?php if ( get_theme_mod( 'post_nav_en', true ) ) { ?>
        <div class="clearfix post-navigation">
            <?php
                $prev_post = get_previous_post();
                $next_post = get_next_post();
            ?>
            <?php if ( !empty( $prev_post ) || !empty( $next_post ) ): ?>
                <!-- Blog next/pre post -->
                <div class="blog-post-review-content row clearfix">  
                    <div class="blog-post-review-pre col-md-4">
                        <?php if ( !empty( $prev_post ) ): ?>
                            <a href="<?php echo get_permalink( $prev_post->ID ); ?>">
                                <h5><?php esc_html_e("Previous",'melody'); ?></h5>
                                <i class="fa fa-angle-left"></i> 
                                <?php echo melody_max_charlength(28, $prev_post->post_title); ?>
                            </a>
                        <?php endif; ?>
                    </div>

                    <div class="blog-post-review-next col-md-4 ml-auto">
                        <?php
                            if (!empty( $next_post )): ?>
                            <a href="<?php echo get_permalink( $next_post->ID ); ?>">
                                <h5><?php esc_html_e("Next",'melody') ?></h5>
                                <?php echo melody_max_charlength(28, $next_post->post_title); ?>
                                <i class="fa fa-angle-right"></i>
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endif; ?>
        </div> <!-- .post-navigation -->
    <?php } ?>  
<?php } ?>


<div class="single-author-meta">
    <div class="media">
      <div class="thm-author-img" title="Written by <?php echo get_the_author_meta('display_name'); ?>" data-toggle="tooltip">
            <?php echo get_avatar( get_the_author_meta( 'ID' ) , 90 ); ?>
        </div>
      <div class="media-body">
        <div class="row">
            <div class="col-md-6 col-12 single-user-info">
                <a href="<?php the_permalink(); ?>"><h4 class="mt-0"> <?php the_author_posts_link(); ?></h4></a>
                </a>
                <?php
                    echo get_the_author_meta('description'); 
                ?>
            </div>
            <div class="col-md-6 col-12 text-right">
                <?php $user_follow = get_the_author_meta('follow'); ?>
                <a href="<?php echo $user_follow; ?>" class="btn btn-follow" target="_blank"><?php echo esc_attr__( 'Follow', 'melody' );; ?></a>
            </div>
        </div>
      </div>
    </div>
</div>

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
