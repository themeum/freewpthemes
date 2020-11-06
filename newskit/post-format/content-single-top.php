<div class="thm-post-content">
    <?php if ( get_theme_mod( 'blog_category_single', true ) ): ?>
        <?php if(get_theme_mod( 'blog_category_single', true )) { ?>
            <div class="meta-category secondary-font">
                <?php printf(esc_html__('%s', 'newskit'), get_the_category_list(' ')); ?>
            </div>
        <?php } ?>
    <?php endif; ?>
    <?php the_title( '<h2 class="content-item-title"><a href="'.get_the_permalink().'">', '</a></h2>' ); ?>
    <?php if ( get_theme_mod( 'blog_comment', true ) || get_theme_mod( 'blog_hit_single', true ) || get_theme_mod( 'blog_tags_single', true )): ?>
        <div class="post-single-share-meta">
            <ul class="blog-post-meta clearfix col-md-8 d-inline-block">

                <?php if ( get_theme_mod( 'blog_author_single', true ) ) { ?>
                    <li>
                        <div class="blog-author">
                            <a href="<?php the_permalink(); ?>"><i class="fa fa-user"></i> <?php the_author_posts_link(); ?></a>
                        </div>
                    </li>
                <?php } ?>

                <?php if ( get_theme_mod( 'blog_date_single', true ) ) { ?>
                    <li>
                        <div class="blog-date-wrapper">
                            <a href="<?php the_permalink(); ?>"><time datetime="<?php echo get_the_date('Y-m-d') ?>"><i class="fa fa-calendar"></i> <?php echo get_the_date(); ?></time></a>
                        </div>
                    </li>
                <?php } ?>
                <?php if ( get_theme_mod( 'blog_hit_single', true ) ) { ?>
                    <li>   <span>
                        <?php
                            # blog Count Down
                            $visitor_count = get_post_meta( $post->ID, '_post_views_count', true);
                            if( $visitor_count == '' ){ $visitor_count = 0; }
                            if( $visitor_count >= 1000 ){
                                $visitor_count = round( ($visitor_count/1000), 2 );
                                $visitor_count = $visitor_count.'k';
                            }
                            echo '<i class="fa fa-eye" aria-hidden="true"></i>'; ?>
                            <?php echo esc_attr( $visitor_count );
                        ?></span>
                    </li>
                <?php } ?>
                <?php if ( get_theme_mod( 'blog_tags_single', true ) && get_the_tag_list() ) { ?>
                    <li><span><i class="fa fa-tags"></i></span><?php echo get_the_tag_list(' ',', ',''); ?></li>
                <?php } ?>
                <?php if ( get_theme_mod( 'blog_comment_single', true ) ) { ?>
                        <li><span>  <i class="fa fa-comments-o"></i> <?php comments_number( '0', '1', '%' ); ?><?php esc_html_e(' Comments', 'newskit') ?></span></li>
                <?php } ?>
            </ul>
            <div class="single-social-share d-inline-block float-right">
                <?php get_template_part( 'post-format/social-buttons' ); ?>
            </div>
        </div>
    <?php endif; ?>
</div>