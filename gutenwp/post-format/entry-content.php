<?php if ( is_single() ) { ?>
    <div class="blog-single-wrap">
        <div class="entry-headder">
            <h2 class="entry-title blog-entry-title">
                <a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a>
            </h2>
        </div>
        <div class="entry-blog-meta">
            <ul>
                <?php if (get_theme_mod('blog_single_author', true)): ?>
                    <li class="author-by">
                        <?php echo get_avatar( get_the_author_meta( 'ID' ) , 50 );?>
                        <span class="author">By <?php the_author_posts_link() ?></span> 
                    </li>
                <?php endif ?>

                <?php if (get_theme_mod('blog_single_date', true)): ?>
                    <li class="author-by">
                        <span><?php echo get_the_date(); ?></span>
                    </li>
                <?php endif ?>
                
                <?php if(get_theme_mod('blog_single_comment', true)) : ?>
                    <li class="comments">
                        <?php comments_number( '0', '1', '%' ); ?>
                    </li>
                <?php endif; ?>
                <?php if(get_theme_mod('blog_single_category', true)) : ?>
                    <li class="cat-list">
                        <?php if(get_the_category_list()) : ?>
                        <?php endif; ?>
                        <?php printf(esc_html__('%s', 'gutenwp'), get_the_category_list(', ')); ?>
                    </li> 
                <?php endif; ?>      
                <?php if(get_theme_mod('blog_single_tag', true)) : ?>
                    <li class="tag-list">
                        <?php if(get_the_tag_list()) : ?>
                        <?php endif; ?>
                        <?php echo get_the_tag_list('',', ',''); ?>
                    </li>
                <?php endif; ?>
            </ul>
        </div> <!--/.entry-meta -->
    </div>
    
    <?php $blog_single_style = get_theme_mod('blog_single_style', 'true'); ?>
    <?php if ($blog_single_style == 'blogstyle2') { ?>
        <?php if ( has_post_thumbnail() ) { ?>
            <div class="image-wrap">
    
                <?php get_template_part( 'post-format/social-button2' ); ?>

                <a href="<?php the_permalink(); ?>" rel="bookmark">
                    <?php the_post_thumbnail('blog-medium', array('class' => 'img-responsive'));?>
                </a>
            </div>
        <?php } ?>
    <?php } ?>


<?php } ?>
<div class="clearfix"></div>

<div class="entry-summary clearfix">
    <?php 
        if ( is_single() ) {
            the_content();
        } else {
            if ( get_theme_mod( 'blog_intro_en', true ) ) { 
                if ( get_theme_mod( 'blog_post_text_limit', 150 ) ) {
                    $textlimit = get_theme_mod( 'blog_post_text_limit', 150 );
                    echo gutenwp_excerpt_max_charlength($textlimit);
                } else {
                    the_content();
                }
            }
        } 
        wp_link_pages( array(
            'before'      => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'gutenwp' ) . '</span>',
            'after'       => '</div>',
            'link_before' => '<span>',
            'link_after'  => '</span>',
        ) ); 
    ?>

    <?php if(is_single()) { ?>
        <div class="guten-intro-cat">
            <div class="row">
                <div class="col-md-6">
                    <div class="gutenwp-cat">
                        <?php esc_html_e('Category: ', 'gutenwp') ?>
                        <?php echo get_the_category_list(', '); ?>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="gutenwp-social">
                        <?php get_template_part( 'post-format/social-buttons' ); ?>
                    </div>
                </div>
            </div>
        </div>


        <div class="guten_user_info">
            <?php echo get_avatar( get_the_author_meta( 'ID' ) , 50 );?>
            <span class="author"><?php esc_html_e('Written By', 'gutenwp'); ?></span>
            <span class="username"><?php the_author_posts_link() ?></span>
            <p><?php the_author_meta('description'); ?></p>
        </div>

        <!-- Blog next/pre post -->
        <div class="col-md-12 blog-arrow-gutenwp">
            <div class="blog-change-arrow-section">
                <div class="row">
                    <div class="blog-post-review-pre col-md-6">
                        <?php $prev_posts = get_previous_post();  
                        if (!empty( $prev_posts )): ?>
                            <a href="<?php echo get_permalink( $prev_posts->ID ); ?>">
                                <span class="arrow-button-left1">
                                    <?php 
                                        if ( !empty( $prev_posts ) ): 
                                        $post_thumbnail_id = get_post_thumbnail_id( $prev_posts );
                                        if ( $post_thumbnail_id ) {
                                            $img = wp_get_attachment_image( $post_thumbnail_id, 'gutenwp-thumb', false);
                                            echo $img;
                                        }
                                        endif; 
                                    ?>
                                </span>
                                <span class="arrow-button-left">
                                    <p class="prev"><?php esc_html_e('Previous post', 'gutenwp') ?></p>
                                    <p><?php echo mb_strimwidth($prev_posts->post_title, 0, 80, ''); ?></p>
                                </span>
                            </a>
                        <?php endif ?>
                    </div>

                    <div class="blog-post-review-next col-md-6">
                        <?php $next_post = get_next_post();
                        if (!empty( $next_post )): ?>
                        <a href="<?php echo get_permalink( $next_post->ID ); ?>">
                            <span class="arrow-button-right1">
                                <p class="next"><?php esc_html_e('Next post', 'gutenwp') ?></p>
                                <p><?php echo mb_strimwidth($next_post->post_title, 0, 80, ''); ?></p>
                            </span>
                            <span class="arrow-button-right2">
                            <?php 
                                if ( !empty( $next_post ) ): 
                                $post_thumbnail_id = get_post_thumbnail_id( $next_post );
                                if ( $post_thumbnail_id ) {
                                    $img = wp_get_attachment_image( $post_thumbnail_id, 'gutenwp-thumb', false);
                                    echo $img;
                                }
                                endif; 
                            ?>
                            </span>
                        </a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Next/Previous Post -->
        
        <?php
            if ( get_theme_mod( 'blog_single_comment_en', true ) ) {
                if ( comments_open() || get_comments_number() ) {
                    comments_template();
                }
            }
        ?>
    <?php } ?>
</div> <!-- //.entry-summary -->



