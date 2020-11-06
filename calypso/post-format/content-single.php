<article id="post-<?php the_ID(); ?>" <?php post_class('calypso-post calypso-single-post single-content-flat'); ?>>
    <div class="thm-post-top">
        <?php if ( get_theme_mod( 'blog_date_single', true ) ): ?>
            <ul class="blog-post-meta clearfix secondary-font">
                <li>
                    <div class="blog-date-wrapper">
                        <a href="<?php the_permalink(); ?>">
                            <time datetime="<?php echo get_the_date('Y-m-d') ?>">
                                <?php echo get_the_date(); ?>
                            </time>
                        </a>
                    </div>
                </li>
            </ul>
        <?php endif; ?>
        <?php the_title( '<h2 class="content-item-title">', '</h2>' ); ?>
    </div> <!-- thm-post-top -->

    <?php 
        get_template_part('post-format/format');
    ?>

    <div class="entry-blog">
        <!-- Single Page content -->
        <div class="entry-summary clearfix">
            <?php 
                the_content();
                wp_link_pages( array(
                    'before'      => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'calypso' ) . '</span>',
                    'after'       => '</div>',
                    'link_before' => '<span>',
                    'link_after'  => '</span>',
                ) );
            ?>
        </div> <!-- //.entry-summary -->
        <!-- single-blog-meta -->
        <?php if ( get_theme_mod( 'blog_comment', true ) || get_theme_mod( 'blog_hit_single', true ) || get_theme_mod( 'blog_tags_single', true )): ?>
            <ul class="single-post-meta clearfix secondary-font">
                <?php if(get_theme_mod('blog_author_single', true)) { ?>
                    <li class="single-blog-author">
                        <?php echo get_avatar( get_the_author_meta( get_the_ID() ), 25 ); ?>
                        <span><?php the_author(); ?></span>
                    </li>
                <?php } ?>
                <?php if ( get_theme_mod( 'blog_category_single', true ) ){ ?>
                    <li>
                        <i class="calypso-icon calypso-price-tag"></i>
                        Category: 
                        <?php printf(esc_html__('%s', 'calypso'), get_the_category_list(', ')); ?>
                    </li>
                <?php } ?>
                <?php if ( get_theme_mod( 'blog_hit_single', true ) ) { ?>
                    <li>   
                        <i class="fa fa-eye"></i>
                        Views:
                        <span>
                        <?php
                            # blog Count Down
                            $visitor_count = get_post_meta( $post->ID, '_post_views_count', true);
                            if( $visitor_count == '' ){ $visitor_count = 0; }
                            if( $visitor_count >= 1000 ){
                                $visitor_count = round( ($visitor_count/1000), 2 );
                                $visitor_count = $visitor_count.'k';
                            }
                            echo esc_attr( $visitor_count );
                        ?></span>
                    </li>
                <?php } ?>
                <?php if ( get_theme_mod( 'blog_tags_single', true ) && get_the_tag_list() ) { ?>
                    <li>
                        <i class="calypso-icon calypso-price-tag"></i>
                        Tags:
                        <span></span><?php echo get_the_tag_list(' ',', ',''); ?>
                    </li>
                <?php } ?>
                <?php if ( get_theme_mod( 'blog_comment_single', true ) ) { ?>
                        <li>
                            <i class="calypso-icon calypso-chat2"></i>     
                            <span>  <?php comments_number( '0', '1', '%' ); ?><?php esc_html_e(' Comments', 'calypso') ?></span>
                        </li>
                <?php } ?>
            </ul>
        <?php endif; ?>
        <!-- /single-blog-meta -->
        <div class="row thm-post-navigation no-gutters heading-font">
            <div class="col-6">
                <?php previous_post_link('<span class="prev-post">%link</span>',esc_html__("Previous Post",'calypso')); ?>
            </div>
            <div class="col-6">
                <?php next_post_link('<span class="next-post ">%link</span>',esc_html__("Next Post",'calypso')); ?>
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
            
        <?php    if ( get_theme_mod( 'blog_single_comment_en', true ) ) {
                if ( comments_open() || get_comments_number() ) {
                    comments_template();
                }
            } ?>
        </div>

    </div> <!--/.entry-content-blog -->


</article>